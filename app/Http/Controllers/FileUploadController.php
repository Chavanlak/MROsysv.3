<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Repository\FileUploadRepository;
use Illuminate\Http\Request;

class FileUploadController extends Controller
{
    public static function createFile()
    {
        return view('upload');
    }
    //to ruploadfile client to sever
    public static function store(Request $req){
        $file = $req->file('file');
        $fileName = time().rand(1,100).'.'.$file->extension();
        $file->move(public_path('images'));
        return response()->json(['success'=> $fileName]);

        // return response()->json(['success'=>'File uploaded successfully', 'fileName' => $fileName]);

    }
    public static function uploadeFile(Request $req){
        $req->validate([
            'files' =>'required',
            'files.*' => 'required|mimes:jpg,jpeg,png,pdf|max:2048',

            // 'files.*' => 'require'|'mimes:jpg,jpeg,png,pdf|max:2048', // Adjust validation rules as needed
        ]);
        $files = [];
        if($req->hasFile('files')) {
            foreach ($req->file('files') as $file) {
                // $path = $file->store('uploads', 'public'); // Store in public/uploads directory
                // $files[] = $path; // Collect the paths of uploaded files
                $fileName = time().rand(1,100).'.'.$file->extension();
                $fileOGName = $file->getClientOriginalName();

                if ($file->move(public_path('uploads'), $fileName)) {
                    $files[] = $fileName;
                    File::create([
                        'fileName' => $fileName,
                        'fileOGName' => $fileOGName,

                    ]);
                }
            }
        }
        if(count($files) > 0) {
            return back()->with('success', 'Files uploaded successfully: ' . implode(', ', $files));
        }
        else{
            return back()->with(["failes",'No files were uploaded.']);
            // return back()->withErrors(['files' => 'No files were uploaded.']);
        }
                    // FileUploadRepository::UploadeFile($fileName,$fileOGName,$file->getSize(),public_path('uploads').'/'.$fileName);
                    // FileUploadRepository::UploadeFile($fileName,$fileOGName,$file->getSize(),public_path('uploads').'/'.$fileName);
        //         } else {
        //             return redirect()->back()->withErrors(['files' => 'Failed to upload file: ' . $file->getClientOriginalName()]);
        //         }
        //     }
        //     return redirect()->back()->with('success', 'Files uploaded successfully: ' . implode(', ', $files));
        // }
    }

    public static function uploadFile(Request $request)
    {
        // Validate the request
        $request->validate([
            'file' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048', // Adjust validation rules as needed
        ]);

        // Handle the file upload
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $path = $file->store('uploads', 'public'); // Store in public/uploads directory

            return redirect()->back()->with('success', 'File uploaded successfully: ' . $path);
        }

        return redirect()->back()->withErrors(['file' => 'No file was uploaded.']);
    }
    public static function showUploads()
    {
        // $files = \Storage::disk('public')->files('uploads'); // Get all files in the uploads directory
        // return view('uploads', ['files' => $files]);
    }
    public static function getallUploadFile(){
       $file = FileUploadRepository::gaetallFile();
    //    if($file->isEmpty()) {
    //         return redirect()->back()->with('error', 'No files found.');
    //     }
        return view('/fileupload',compact('file'));
    }
    public static function getFileById(Request $req){
        $files= FileUploadRepository::getFileById($req->file);
        // dd($files);
         //    if($file->isEmpty()) {
    //         return redirect()->back()->with('error', 'No files found.');
    //     }
        // return view('/fileupload',compact('file'));

        return redirect('/uploadfile')->with('success', 'File/s Uploaded Successfully');
    }
    // public static function savefile(Request $req){
    //     $file = FileUploadRepository::UploadeFile($req->FileUploadId,$req->Name,$req->Size,$req->Location);
    //     //   if($file->isEmpty()) {
    //     //     return redirect()->back()->with('error', 'No files found.');
    //     // }
    //     return view('/fileupload',compact('file'));
    //     // return redirect('/uploadfile')->with('success', 'File/s Uploaded Successfully');
    // }
    public function getPicturePathfromNotiRepairId($notirepairId){
        $picPathList = FileUploadRepository::getPicturebyNotiRepairId($notirepairId);
        return view('imglink.emaillink',compact('picPathList'));

    }
}
