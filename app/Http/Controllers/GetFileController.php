<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\File;

class GetFileController extends Controller
{
    public function download(File $file)
    {

        header("Content-disposition: attachment; filename=".$file->filename);
        header("Content-type: ".$file->mime);
        readfile(storage_path('app/public/uploaded_files/'.$file->storedname));


    }
}
