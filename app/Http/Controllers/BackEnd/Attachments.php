<?php

namespace App\Http\Controllers\BackEnd;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attachment;
use File;

class Attachments extends Controller
{
    
 public function edit_attachment($id)
 {
     
    $row = Attachment::findOrFail($id)->first();
    
    return view('Admin.attachments.edit_attachment', compact('row'));
 }
 
 public function update_attachment(Request $request, $id)
 {
     
     //===== Start Attachment Area
    if(request()->hasFile('file_name'))
    {
        $attach = Attachment::find($id)->first();
        
        $file = $request->file('file_name');
        $attachmentName = $file->getClientOriginalName();
        $file->move(public_path('uploads/attachments/'), $attachmentName);
    
        File::delete(public_path('uploads/attachments/'.$attach->file_name));
        Attachment::find($id)->update([
            'file_name' =>  $attachmentName,
            'file_type' => $request->file_type,
            ]);
            
    }
    //===== End Attachment Area

    alert()->success(trans('admin.update'), 'Done');
    return back();
 }
 
 public function delete_attachment(Request $request, $id)
 {
     $delete = Attachment::find($id);
     $delete= $delete->delete();
     return back();
 }
      
}
