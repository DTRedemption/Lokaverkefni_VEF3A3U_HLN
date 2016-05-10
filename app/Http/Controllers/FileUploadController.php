<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Filesystem\Factory as Storage;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\DB;

class FileUploadController extends Controller {


    public function store( Storage $storage, Request $request )
    {
        if ( $request->isXmlHttpRequest() )
        {
            $file = $request->file('files');
            $timestamp = $this->getFormattedTimestamp();
            $savedFileName = $this->getSavedFileName( $timestamp, $file );
            $fileUploaded = $this->uploadFile( $file, $savedFileName, $storage );

            if ( $fileUploaded )
            {
                $fileid = uniqid();
                DB::table('fileinfo')->insert([
                    ['filename' => $file->getClientOriginalName(), 'filetype' => $file->getClientOriginalExtension(),
                     'mime' => $file->getMimeType(), 'filesize' => $file->getClientSize(),
                        'filepath' => storage_path('app/public/uploaded_files/' . $savedFileName),
                        'downloadid' => $fileid
                    ]
                ]);
                $data = [
                    'original_path' => ('http://hln.is/download/' . $fileid)
                ];
                return json_encode( $data, JSON_UNESCAPED_SLASHES );
            }
            return "uploading failed";
        }

    }


    public function uploadFile( $file, $fileFullName, $storage )
    {
        $filesystem = new Filesystem;
        return $storage->disk('files')->put( $fileFullName, $filesystem->get( $file ) );
    }


    protected function getFormattedTimestamp()
    {
        return str_replace( [' ', ':'], '-', Carbon::now()->toDateTimeString() );
    }


    protected function getSavedFileName($timestamp, $file)
    {
        return $timestamp . '-' . $file->getClientOriginalName();
    }
}
