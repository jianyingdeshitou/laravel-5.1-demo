<?php

namespace Post\Http\Controllers\Admin;

use Illuminate\Http\Request;

use Post\Http\Requests;
use Post\Http\Controllers\Controller;

use Post\Services\UploadsManager;
use Post\Http\Requests\UploadNewFolderRequest;
use Post\Http\Requests\UploadFileRequest;
use Illuminate\Support\Facades\File;

class UploadController extends Controller
{
    protected $manager;

    public function __construct(UploadsManager $manager)
    {
        $this->manager = $manager;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $folder = $request->get('folder');
        $data = $this->manager->folderInfo($folder);

        return view('admin.upload.index', $data);
    }


    public function viewFile(Request $request)
    {

        return response()->download(storage_path('uploads').'/test/Jellyfish.jpg',null,[],null);
    }

    /**
     * create folder
     *
     * @param UploadNewFolderRequest $request
     * @return $this
     */
    public function createFolder(UploadNewFolderRequest $request)
    {
        $newFolder = $request->get('new_folder');
        $folder = $request->get('folder') . '/' . $newFolder;

        $result = $this->manager->createDirectory($folder);

        if ($result === true) {
            return redirect()->back()->withSuccess("Folder '$newFolder' created.");
        }

        $error = $result ? : "An error occurred creating directory.";

        return redirect()->back()->withErrors([$error]);
    }

    /**
     * delete folder
     *
     * @param Request $request
     * @return $this
     */
    public function deleteFolder(Request $request)
    {
        $delFolder = $request->get('del_folder');
        $folder = $request->get('folder') . '/' . $delFolder;

        $result = $this->manager->deleteDirectory($folder);

        if ($result === true) {

            return redirect()->back()->withSuccess("Folder '$delFolder' deleted.");
        }

        $error = $result ? : "An error occurred deleting directory.";

        return redirect()->back()->withErrors([$error]);
    }

    /**
     * upload file
     *
     * @param UploadFileRequest $request
     * @return $this
     */
    public function uploadFile(UploadFileRequest $request)
    {
        $file = $_FILES['file'];
        $fileName = $request->get('file_name');
        $fileName = $fileName ? : $file['name'];
        $path = str_finish($request->get('folder'), '/') . $fileName;
        $content = File::get($file['tmp_name']);

        $result = $this->manager->saveFile($path, $content);

        if ($result === true) {
            return redirect()->back()->withSuccess("File '$fileName' uploaded.");
        }

        $error = $result ? : "An error occurred uploading file.";

        return redirect()->back()->withErrors([$error]);
    }

    /**
     * delete file
     *
     * @param Request $request
     * @return $this
     */
    public function deleteFile(Request $request)
    {
        $delFile = $request->get('del_file');
        $path = $request->get('folder') . '/' . $delFile;

        $result = $this->manager->deleteFile($path);

        if ($result === true) {

            return redirect()->back()->withSuccess("File '$delFile' deleted.");
        }

        $error = $result ? : "An error occurred deleting file.";

        return redirect()->back()->withErrors([$error]);
    }

}
