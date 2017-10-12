<?php

namespace App\Http\Controllers;

use Cloudder;
use App\File as File;
use Illuminate\Http\Request;

use App\Http\Requests;

class FilesController extends Controller
{
    /**
     * Upload File To Cloudder Cloude Storage
     * Save file name, clude url, and project_id to database
     *
     * @param [Request] $request [Form Submited Data]
     * @param [Project_id] $id [The Project Id]
     *
     * @return Reditect to from with a message
     */
    public function uploadAttachments(Request $request, $id)
    {
        $this->validate($request, [
            'file_name'     => 'required|mimes:jpeg,bmp,png,pdf|between:1,7000',
        ]);

        $filename     = $request->file('file_name')->getRealPath();

        Cloudder::upload($filename, null);
        list($width, $height) = getimagesize($filename);

        $fileUrl = Cloudder::show(Cloudder::getPublicId(), ["width" => $width, "height" => $height]);
        $this->saveUploads($request, $fileUrl, $id);

        return redirect()->back()->with('info', 'Your Attachment has been uploaded Successfully');
    }


    /**
     * Save File Information In Database
     *
     * @param [Request] $requeat [Requested Form]
     * @param [File clude url] $fileUrl [File Clude Url]
     * @param [Pjoject Id] $id
     *
     * @return sNothin to reutrn
     */
    private function saveUploads(Request $request, $fileUrl, $id)
    {
        $file = new File;
        $file->file_name  = $request->file('file_name')->getClientOriginalName();
        $file->file_url   = $fileUrl;
        $file->project_id = $id;

        $file->save();
    }

    /**
     * Delete One Project File From Database and
     * From Clude Storage
     *
     * @param  [Int] $projectId [Project Id]
     * @param  [Int] $fileId    [File Id]
     *
     * @return [Array]            [success messsage]
     */
    public function deleteOneProjectFile($projectId, $fileId)
    {

        //  Find The File From Database
        $file = File::where('id', $fileId)->where('project_id', $projectId)->first();

        // Extrect The Public ID Of The File
        $publicId = explode('/',$file->file_url);
        $publicId = explode('.', end($publicId));
        $publicId = current($publicId);

        // Delete From The Cloud Storage
        Cloudder::destroyImage($publicId);

        // Also Delete From Database
        File::where('id', $fileId)->where('project_id', $projectId)->delete();

        return ['msg'=>'success'];
    }

}
