<?php

namespace App\Http\Controllers\BackEnd;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Models\InteractiveSessionLesson;
use App\Models\UrlLectureLesson;
use App\Models\VideoLectureLesson;
use App\Models\ImageLectureLesson;
use App\Models\CourseDoctor;
use App\Models\Assignment;
use App\Models\Attachment;
use App\Models\Doctor;
use App\Models\Student;
use App\Models\Lesson;
use App\Models\Lecture;
use App\Models\Quize;
use Carbon\Carbon;
use Notification;
use SweetAlert;
use File;


class Lessons extends BackEndController
{

  public function __construct(Lesson $model)
    {
        parent::__construct($model);
        //$this->middleware(['role:manger']);
    }


    protected function relations_create_edit()
    {
       return [
           'courses'  => CourseDoctor::where('doctor_id', auth()->guard('doctor')->user()->id)->get(),
           'lectures'  => Lecture::where('doctor_id', Auth()->guard('doctor')->user()->id)->get(),
        ];
    }

  public function store(Request $request)
  {
        $data = $this->validate(request(), [
            'title'                 => 'required|string',
            'desc'                  => 'sometimes|string',
            'content'               => 'sometimes|string',
            'course_id'             => 'required',
            'lecture_id'            => 'required',
            'lesson_scheduling'     => 'sometimes|nullable',
            'lesson_image'          =>  validate_image(),
            'show_media'            => 'sometimes|nullable',
            'start_scheduling'      =>  'sometimes|nullable',
            'finish_scheduling'     =>  'sometimes|nullable',
            'theory_hour'           =>  'sometimes|nullable',
            'applied_hour'          =>  'sometimes|nullable',
        ]);

        $theory_hour = $request->theory_hour;
        $applied_hour = $request->applied_hour;
        $lesson_hour = (int) ($theory_hour + $applied_hour);
        $data['lesson_hour'] = $lesson_hour;
        $data['created_at'] = Carbon::now();
        $data['doctor_id'] =  Auth()->guard('doctor')->user()->id;

        //===== Start URL AND FILES AREA

        if(request()->hasFile('lesson_image'))
        {
            $file = $request->file('lesson_image');
            $imageName = $file->getClientOriginalName();
            $file->move(public_path('uploads/lessons/images'), $imageName);
            $data['lesson_image'] = $imageName;
        }

        if(request()->hasFile('lesson_video'))
        {
            $video = $request->file('lesson_video');
            $videoName = $video->getClientOriginalName();
            $video->move(public_path('uploads/lessons/videos'), $videoName);
            $data['lesson_video'] = $videoName;
        }
        //=== End

        switch ($request->input('action')) {
            case 'publish':
                $data['Lesson_status'] = 'publish';
                break;

            case 'draft':
                $data['Lesson_status'] = 'draft';
                break;

            case 'scheduling':
                $data['Lesson_status'] = 'scheduling';
                break;
            case 'save_add':
                $data['Lesson_status'] = 'draft';
                break;

            case 'advanced_edit':
                // Redirect to advanced edit
                break;
        }

       $id = $this->model::insertGetId($data);

       //=== Start Add Interactive Session
       if($request->has('url_session'))
       {
         InteractiveSessionLesson::create([
           'url_session' => $request->url_session,
           'lesson_id'  => $id,
         ]);
       }
       //=== End Add Interactive Session

            //==> Start Add Videos And Url Files

            //==> Start Add Images
            $file = array();

            if($files = $request->file('image'))
            {

                foreach($files as $file)
                {
                    $fileName = time().$file->getClientOriginalName();

                    $file->move(public_path('uploads/lessons/images'), $fileName);

                    $data_video = array(
                            'image'             => $fileName,
                            'lesson_id'        => $id,
                            'created_at'        => Carbon::now()
                        );

                    $insert_video[] = $data_video;

                }

                ImageLectureLesson::insert($insert_video);

            }


            //==> Start Add Videos
            $file = array();

            if($files = $request->file('video'))
            {

                foreach($files as $file)
                {
                    $fileName = time().$file->getClientOriginalName();

                    $file->move(public_path('uploads/lessons/videos'), $fileName);

                    $data_video = array(
                            'video'             => $fileName,
                            'lesson_id'        => $id,
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
                            'lesson_id'             => $id,
                            'created_at'             => Carbon::now()
                        );

                    $insert_url[] = $data_url;
                    UrlLectureLesson::insert($insert_url);
                }

            }



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
                            'course_id'             => $id,
                            'created_at'            => Carbon::now()
                        );

                    $insert_attachment[] = $data_attachment;
                    Attachment::insert($insert_attachment);
            }
            //===== End Attachment Area

            //===> Send Notification
            $user = Student::where('term_id', auth()->guard('doctor')->user()->id)->get();
            $title = $request->title;
            $doctor = auth()->guard('doctor')->user()->name;
            if($data['lesson_status'] == 'publish')
            {
              $id_type = $id;
              $type = "lesson";
              Notification::send($user, new \App\Notifications\LecturesStudent($title, $doctor, $type, $id_type));
           }

           if($data['lesson_status'] == 'scheduling')
           {
             $type_scheduling = "lesson_scheduling";
             $scheduling = $request->start_scheduling;
             Notification::send($user, new \App\Notifications\LecturesSchedulingNotification($title, $doctor, $scheduling, $type_scheduling));
          }

        alert()->success(trans('admin.success'), 'Done');

        if($request->input('action') == 'save_add')
        {
          return back();
        }else{
            return redirect()->route('lessons.index');
        }

  }

  public function update(Request $request, $id)
  {

        $data = $this->validate(request(), [
            'title'                 => 'required|string',
            'desc'                  => 'sometimes|string',
            'content'               => 'sometimes|string',
            'course_id'             => 'required',
            'lecture_id'            => 'required',
            'lesson_scheduling'     => 'sometimes|nullable',
            'lesson_image'          =>  validate_image(),
            'show_media'            => 'sometimes|nullable',
            'start_scheduling'      =>  'sometimes|nullable',
            'finish_scheduling'     =>  'sometimes|nullable',
            'theory_hour'           =>  'sometimes|nullable',
            'applied_hour'          =>  'sometimes|nullable',
        ]);

        $theory_hour = $request->theory_hour;
        $applied_hour = $request->applied_hour;
        $lesson_hour = (int) ($theory_hour + $applied_hour);
        $data['lesson_hour'] = $lesson_hour;
        $data['created_at'] = Carbon::now();
        $data['doctor_id'] =  Auth()->guard('doctor')->user()->id;


        //===== Start URL AND FILES AREA
        $lesson = $this->model->find($id)->first();

        if(request()->hasFile('lesson_image'))
        {
            $file = $request->file('lesson_image');
            $imageName = $file->getClientOriginalName();
            $file->move(public_path('uploads/lessons/images'), $imageName);
            $data['lesson_image'] = $imageName;

            $image_path = public_path('uploads/lessons/images/'.$lesson->lessons_image);

            if(file_exists($image_path))
            {
                File::delete($image_path);
            }

        }

        if(request()->hasFile('lesson_video'))
        {

            $video = $request->file('lesson_video');
            $videoName = $video->getClientOriginalName();
            $video->move(public_path('uploads/lessons/videos'), $videoName);
            $data['lesson_video'] = $videoName;

            $video_path = public_path('uploads/lessons/videos/'.$lesson->lessons_video);

            if(file_exists( $video_path))
            {
                File::delete( $video_path);
            }
        }
        //=== End ===

        switch ($request->input('action')) {
            case 'publish':
                $data['lesson_status'] = 'publish';
                break;

            case 'draft':
                $data['lesson_status'] = 'draft';
                break;

            case 'scheduling':
                $data['lesson_status'] = 'scheduling';
                break;
            case 'save_add':
                $data['lesson_status'] = 'draft';
                break;

            case 'advanced_edit':
                // Redirect to advanced edit
                break;
        }


        $this->model->findOrfail($id)->update($data);

        if($request->has('url_session'))
        {
          InteractiveSessionLesson::where('lesson_id', $id)->update([
            'url_session' => $request->url_session,
            'lesson_id'  => $id,
          ]);
        }

        //===========================================================================

           //==> Start Add Videos And Url Files

        //==> Start Add Images
        $file = array();

        if($files = $request->file('image'))
        {

            foreach($files as $file)
            {
                $fileName = time().$file->getClientOriginalName();

                $file->move(public_path('uploads/lessons/images'), $fileName);

                $data_video = array(
                        'image'             => $fileName,
                        'lesson_id'        => $id,
                        'created_at'        => Carbon::now()
                    );

                $insert_video[] = $data_video;

            }

            ImageLectureLesson::insert($insert_video);

        }


        //==> Start Add Videos
        $file = array();

        if($files = $request->file('video'))
        {

            foreach($files as $file)
            {
                $fileName = time().$file->getClientOriginalName();

                $file->move(public_path('uploads/lessons/videos'), $fileName);

                $data_video = array(
                        'video'             => $fileName,
                        'lesson_id'        => $id,
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
                        'lesson_id'             => $id,
                        'created_at'             => Carbon::now()
                    );

                $insert_url[] = $data_url;
                UrlLectureLesson::insert($insert_url);
            }

        }


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
                        'lesson_id'             => $id,
                        'created_at'            => Carbon::now()
                    );

                $insert_attachment[] = $data_attachment;
                Attachment::insert($insert_attachment);
        }
        //===== End Attachment Area



        alert()->success(trans('admin.update'), 'Done');

        if($request->input('action') == 'save_new')
        {
          return redirect()->route('lessons.create');
        }else{
          return redirect()->route('lessons.edit', ['id' => $id]);
        }

    }

    public function show($id)
    {
        $rows = $this->model->where('lecture_id', $id)->paginate(10);
        $titlePage = "Lessons";
        $routeName = "Lessons";
        return view('Admin.lessons.index', compact('rows', 'routeName', 'titlePage'));
    }


    public function lesson_view($id)
    {

        $row = $this->model->where('id', $id)->first();
        $assignments = Assignment::where('doctor_id', auth()->guard('doctor')->user()->id)->get();
        $quizes = Quize::where('doctor_id', auth()->guard('doctor')->user()->id)->get();
        $titlePage = "Lessons";
        $routeName = "lessons";
        $interactive_session = InteractiveSessionLesson::where('lesson_id', $id)->first();
        return view('Admin.lessons.show', compact('row', 'assignments', 'quizes', 'routeName', 'titlePage'));
    }

    public function lesson_attachment($id)
    {

        $row = Attachment::where('id', $id)->first();
        $titlePage = "Lessons";
        $routeName = "Lessons";
        return view('Admin.lessons.attachment', compact('row', 'routeName', 'titlePage'));
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

        $file->move(public_path('uploads/lessons/videos'), $fileName);
        $video = VideoLectureLesson::find($id)->first();

        if($video)
        {
            $video_path = public_path('uploads/lessons/videos/'.$video->video);

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

        $file->move(public_path('uploads/lessons/images'), $fileName);

        //==== Delete Old Image
        $img = ImageLectureLesson::find($id)->first();

        if($img)
        {
            $image_path = public_path('uploads/lessons/images/'.$img->image);

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
