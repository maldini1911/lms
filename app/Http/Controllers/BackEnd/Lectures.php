<?php

namespace App\Http\Controllers\BackEnd;

use Illuminate\Http\Request;
use App\Models\LessonSession;
use App\Models\Doctor;
use App\Models\Student;
use App\Models\Lecture;
use App\Models\Course;
use App\Models\Attachment;
use App\Models\Assignment;
use App\Models\Quize;
use App\Models\UrlLectureLesson;
use App\Models\VideoLectureLesson;
use App\Models\ImageLectureLesson;
use App\Models\CourseDoctor;
use App\Models\InteractiveSessionLecture;
use App\Models\StudentTerm;
use Carbon\Carbon;
use Notification;
use SweetAlert;
use File;

class Lectures extends BackEndController
{

  public function __construct(Lecture $model)
    {
        parent::__construct($model);
    }


    protected function relations_create_edit()
    {
       return [
         'courses'  => CourseDoctor::where('doctor_id', auth()->guard('doctor')->user()->id)->get(),
       ];
    }

  public function store(Request $request)
  {

        $data = $this->validate(request(), [
            'title'                     => 'required|string',
            'desc'                      => 'sometimes|nullable|string',
            'content'                   => 'required|string',
            'course_id'                 => 'required',
            'lecture_scheduling'        => 'sometimes|nullable',
            'lecture_image'             =>  validate_image(),
            'show_media'                =>  'sometimes|nullable',
            'start_scheduling'          =>  'sometimes|nullable',
            'finish_scheduling'         =>  'sometimes|nullable',
            'theory_hour'               =>  'sometimes|nullable',
            'applied_hour'              =>  'sometimes|nullable',
        ]);

        $theory_hour = $request->theory_hour;
        $applied_hour = $request->applied_hour;
        $lecture_hour = (int) ($theory_hour + $applied_hour);
        $data['lecture_hour'] = $lecture_hour;
        $data['created_at'] = Carbon::now();
        $data['doctor_id'] =  Auth()->guard('doctor')->user()->id;


        if(request()->hasFile('lecture_image'))
        {
            $file = $request->file('lecture_image');
            $imageName = $file->getClientOriginalName();
            $file->move(public_path('uploads/lectures/images'), $imageName);
            $data['lecture_image'] = $imageName;

        }

        if(request()->hasFile('lecture_video'))
        {
            $video = $request->file('lecture_video');
            $videoName = $video->getClientOriginalName();
            $video->move(public_path('uploads/lectures/videos'), $videoName);
            $data['lecture_video'] = $videoName;
        }


        switch ($request->input('action')) {
            case 'publish':
                $data['lecture_status'] = 'publish';
                break;

            case 'draft':
                $data['lecture_status'] = 'draft';
                break;

            case 'scheduling':
                $data['lecture_status'] = 'scheduling';
                $data['start_scheduling']  = $request->start_scheduling;
                $data['finish_scheduling'] = $request->finish_scheduling;
                break;

            case 'save_new':
                $data['lecture_status'] = 'draft';
                break;

            case 'save_lesson':
                $data['lecture_status'] = 'draft';
                break;

            case 'advanced_edit':
                // Redirect to advanced edit
                break;
        }

        $id = $this->model::insertGetId($data);

        //==> Start Add Videos And Url Files


        //=== Start Add Interactive Session
        if($request->has('url_session') && $request->url_session != null)
        {
          InteractiveSessionLecture::create([
            'url_session' => $request->url_session,
            'lecture_id'  => $id,
          ]);
        }
        //=== End Add Interactive Session
        //==> Start Add Images
        $file = array();

        if($files = $request->file('image'))
        {

            foreach($files as $file)
            {
                $fileName = time().$file->getClientOriginalName();

                $file->move(public_path('uploads/lectures/images'), $fileName);

                $data_image = array(
                        'image'             => $fileName,
                        'lecture_id'        => $id,
                        'created_at'        => Carbon::now()
                    );

                $insert_image[] = $data_image;

            }

            ImageLectureLesson::insert($insert_image);

        }


        //==> Start Add Videos
        $file = array();

        if($files = $request->file('video'))
        {

            foreach($files as $file)
            {
                $fileName = time().$file->getClientOriginalName();

                $file->move(public_path('uploads/lectures/videos'), $fileName);

                $data_video = array(
                        'video'             => $fileName,
                        'lecture_id'        => $id,
                        'created_at'        => Carbon::now()
                    );

                $insert_video[] = $data_video;

            }

            VideoLectureLesson::insert($insert_video);

            }


        //======> URL
        if($request->has('url_youtube'))
        {
            $url = $request->input('url_youtube');

            for($count = 0; $count < count($url); $count++)
            {
                $url_new =  preg_replace("/\s*[a-zA-Z\/\/:\.]*youtube.com\/watch\?v=([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i","https://www.youtube.com/embed/$1 ", $url[$count]);
                $data_url = array(
                        'url'                    => $url_new,
                        'lecture_id'             => $id,
                        'created_at'             => Carbon::now()
                    );

                $insert_url[] = $data_url;
                UrlLectureLesson::insert($insert_url);
            }

        }


        //==> End Add Files And Url Files

        //===== Start Attachment Area
        if(request()->hasFile('file_name'))
        {
            $file = $request->file('file_name');
            $attachmentName = $file->getClientOriginalName();
            $file->move(public_path('uploads/attachments/'), $attachmentName);

            $file_type = $request->input('file_type');

                $data_attachment = array(
                        'file_name'             => $attachmentName,
                        'file_type'             => $file_type,
                        'lecture_id'             => $id,
                        'created_at'            => Carbon::now()
                    );

                $insert_attachment[] = $data_attachment;
                Attachment::insert($insert_attachment);
        }
        //===== End Attachment Area

        $term_course = Course::where('id', $request->course_id)->first();
        $term_id =  $term_course->term_id;
        //===> Send Notification
        $user = Student::whereHas('student_terms', function($query) use($term_id){
            $query->where('term_id', $term_id);
        })->get();

        $title = $request->title;
        $doctor = auth()->guard('doctor')->user()->name;

        if($data['lecture_status'] == 'publish')
        {
          $id_type = $id;
          $type = "lecture";
          Notification::send($user, new \App\Notifications\LecturesStudent($title, $doctor, $type, $id_type));
        }

        if($data['lecture_status'] == 'scheduling')
        {
          $type_scheduling = "lecture_scheduling";
          $scheduling = $request->start_scheduling;
          Notification::send($user, new \App\Notifications\LecturesSchedulingNotification($title, $doctor, $scheduling, $type_scheduling));
        }


        //====> Return View
        alert()->success(trans('admin.success'), 'Done');
        if($request->input('action') == "save_new")
        {
            return back();

        }elseif($request->input('action') == "save_lesson")
        {
            return redirect('doctors/lessons/create/'.$id);

        }else{

          return redirect()->route('lectures.index');

        }

  }

  public function update(Request $request, $id)
  {

        //dd($request->file('course_image'));

        $data = $this->validate(request(), [
            'title'                     => 'required|string',
            'desc'                      => 'sometimes|nullable|string',
            'content'                   => 'required|string',
            'course_id'                 => 'required',
            'lecture_scheduling'        => 'sometimes|nullable',
            'lecture_image'             =>  validate_image(),
            'show_media'                =>  'sometimes|nullable',
            'start_scheduling'          =>  'sometimes|nullable',
            'finish_scheduling'         =>  'sometimes|nullable',
            'theory_hour'               =>  'sometimes|nullable',
            'applied_hour'              =>  'sometimes|nullable',
        ]);


        $theory_hour = $request->theory_hour;
        $applied_hour = $request->applied_hour;
        $lecture_hour = (int) ($theory_hour + $applied_hour);
        $data['lecture_hour'] = $lecture_hour;

        $data['doctor_id'] =  Auth()->guard('doctor')->user()->id;
        $data['updated_at'] = Carbon::now();

    //===== Start URL AND FILES AREA
    $lecture = $this->model->find($id)->first();

    if(request()->hasFile('lecture_image'))
    {
        $file = $request->file('lecture_image');
        $imageName = $file->getClientOriginalName();
        $file->move(public_path('uploads/lectures/images'), $imageName);
        $data['lecture_image'] = $imageName;

        $image_path = public_path('uploads/lectures/images/'.$lecture->lecture_image);

        if(file_exists($image_path))
        {
            File::delete($image_path);
        }
    }

    if(request()->hasFile('course_video'))
    {

        $video = $request->file('lecture_video');
        $videoName = $video->getClientOriginalName();
        $video->move(public_path('uploads/lectures/videos'), $videoName);
        $data['lecture_video'] = $videoName;

        $video_path = public_path('uploads/lectures/videos/'.$lecture->lecture_video);

        if(file_exists($video_path))
        {
            File::delete($video_path);
        }
    }

    switch ($request->input('action')) {
        case 'publish':
            $data['lecture_status'] = 'publish';
            break;

        case 'draft':
            $data['lecture_status'] = 'draft';
            break;

        case 'scheduling':

            $data['lecture_status'] = 'scheduling';
            $data['date_scheduling'] = $request->course_scheduling;
            $data['start_scheduling']  = $request->start_scheduling;
            $data['finish_scheduling'] = $request->finish_scheduling;
            break;

        case 'save_new':
            $data['lecture_status'] = 'draft';
            break;

        case 'save_lesson':
            $data['lecture_status'] = 'draft';
            break;

        case 'advanced_edit':
            // Redirect to advanced edit
            break;
    }

    $this->model->findOrfail($id)->update($data);

    if($request->has('url_session'))
    {
      InteractiveSessionLecture::where('lecture_id', $id)->update([
        'url_session' => $request->url_session,
        'lecture_id'  => $id,
      ]);
    }


    //===> Start URL And Videos And Images

    //==> Start Add Images

    if($images = $request->file('image'))
    {

        foreach($images as $image)
        {
            $imageName = time().$image->getClientOriginalName();

            $image->move(public_path('uploads/lectures/images'), $imageName);

            $data_image = array(
                    'image'             => $imageName,
                    'lecture_id'        => $id,
                    'created_at'        => Carbon::now()
                );

            $insert_image[] = $data_image;

        }

        ImageLectureLesson::insert($insert_image);

    }


    //==> Start Add Videos
    $file = array();

    if($files = $request->file('video')){


        foreach($files as $file)
        {
            $fileName = time().$file->getClientOriginalName();

            $file->move(public_path('uploads/lectures/videos'), $fileName);

            $data_video = array(
                    'video'             => $fileName,
                    'lecture_id'        => $id,
                    'created_at'        => Carbon::now()
                );

            $insert_video[] = $data_video;

        }

        VideoLectureLesson::insert($insert_video);

        }


    //======> URL


    if($request->has('url_youtube'))
    {
        $url = $request->input('url_youtube');

        for($count = 0; $count < count($url); $count++)
        {
            $url_new =  preg_replace("/\s*[a-zA-Z\/\/:\.]*youtube.com\/watch\?v=([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i","https://www.youtube.com/embed/$1 ", $url[$count]);

            $data_url = array(
                    'url'                    => $url_new,
                    'lecture_id'             => $id,
                    'created_at'             => Carbon::now()
                );

            $insert_url[] = $data_url;

        }

        UrlLectureLesson::insert($insert_url);

    }
    //===> End URL And Videos



    //===== Start Attachment Area
    if(request()->hasFile('file_name'))
    {
        $file = $request->file('file_name');
        $attachmentName = $file->getClientOriginalName();
        $file->move(public_path('uploads/attachments/'), $attachmentName);

        $file_type = $request->input('file_type');

            $data_attachment = array(
                    'file_name'             => $attachmentName,
                    'file_type'             => $file_type,
                    'lecture_id'             => $id,
                    'created_at'            => Carbon::now()
                );

            $insert_attachment[] = $data_attachment;
            Attachment::insert($insert_attachment);
    }
    //===== End Attachment Area

    //====> Return View
    alert()->success(trans('admin.update'), 'Done');

    if($request->input('action') == "save_new")
    {
        return redirect()->route('lectures.create');

    }elseif($request->input('action') == "save_lesson")
    {
      return redirect('doctors/lessons/create/'.$id);

    }else{
        return redirect()->route('lectures.edit', ['id' => $id]);
    }

  }


    public function show($id)
    {
        $rows = $this->model->where('subject_id', $id)->paginate(10);
        $titlePage = "Lecture";
        $routeName = "lectures";
        return view('Admin.lectures.index', compact('rows', 'routeName', 'titlePage'));
    }


     public function lecture_view($id)
    {

        $row = $this->model->where('id', $id)->first();
        $assignments = Assignment::where('doctor_id', auth()->guard('doctor')->user()->id)->get();
        $quizes = Quize::where('doctor_id', auth()->guard('doctor')->user()->id)->get();
        $titlePage = "lecture";
        $routeName = "lecture";
        $interactive_session = InteractiveSessionLecture::where('lecture_id', $id)->first();
        return view('Admin.lectures.show', compact('row', 'assignments', 'quizes', 'routeName', 'titlePage', 'interactive_session'));
    }

    public function lecture_attachment($id)
    {

        $row = Attachment::where('id', $id)->first();
        $titlePage = "Lecture";
        $routeName = "Lectures";
        return view('Admin.lectures.attachment', compact('row', 'routeName', 'titlePage'));
    }


    public function edit_url(Request $request, $id)
    {
        $url_new =  preg_replace("/\s*[a-zA-Z\/\/:\.]*youtube.com\/watch\?v=([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i","https://www.youtube.com/embed/$1 ", $request->url);

        UrlLectureLesson::find($id)->update(['url' => $url_new]);
        return back();
    }


    public function delete_url($id)
    {
        $row = UrlLectureLesson::find($id)->first();
        $row->delete();
        return back();
    }


    public function edit_video(Request $request, $id)
    {


        $file = $request->file('video');

        $fileName = time().$file->getClientOriginalName();

        $file->move(public_path('uploads/lectures/videos'), $fileName);
        $video = VideoLectureLesson::find($id)->first();

        if($video)
        {
            $video_path = public_path('uploads/lectures/videos/'.$video->video);

            if(file_exists($video_path))
            {
                File::delete($video_path);
            }
        }

        VideoLectureLesson::find($id)->update(['video' =>$fileName]);
        alert()->success(trans('admin.update'), 'Done');
        return back();
    }


    public function delete_video($id)
    {
        $row = VideoLectureLesson::find($id)->first();
        $row->delete();
        return back();
    }


    public function edit_image(Request $request, $id)
    {

        $this->validate(request(), ['image' => 'required|mimes:jpeg,jpg,png']);

        $file = $request->file('image');

        $fileName = time().$file->getClientOriginalName();

        $file->move(public_path('uploads/lectures/images'), $fileName);

        //==== Delete Old Image
        $img = ImageLectureLesson::find($id)->first();

        if($img)
        {
            $image_path = public_path('uploads/lectures/images/'.$img->image);

            if(file_exists($image_path))
            {
                File::delete($image_path);
            }

        }

        ImageLectureLesson::where('id', $id)->update(['image' => $fileName]);

        alert()->success(trans('admin.update'), 'Done');

        return back();
    }


    public function delete_image($id)
    {
        $row = ImageLectureLesson::find($id)->first();
        $row->delete();
        return back();
    }


    public function show_interactive_sessions()
    {
        return view('Admin.lectures.interactive_sessions');
    }

    public function store_interactive_sessions(Request $request)
    {
        Doctor::where('id', auth()->guard('doctor')->user()->id)->update(['interactive_sessions' => $request->interactive_sessions]);
        alert()->success(trans('admin.update'), 'Done');
        return back();
    }



    public function multi_delete()
    {

        if(is_array(request('item'))){

            $this->model->destroy(request('item'));

        }else{

            $this->model->find(request('item'))->delete();

        }

        return back();
    }


}

?>
