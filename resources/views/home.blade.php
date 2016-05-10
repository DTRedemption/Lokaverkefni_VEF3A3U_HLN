@extends('layouts.layout')

@section('header')

    <link href="{{ url('https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/min/dropzone.min.css') }}" rel='stylesheet' type='text/css'>

@stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class = "uploadform">
                    <h1 class = "headertext">Anonymous File Upload</h1>

                {!! Form::open([ 'route' => [ 'files.store' ], 'files' => true, 'enctype' => 'multipart/form-data', 'class' => 'dropzone', 'id' => 'fileupload' ]) !!}
                {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@stop

@section('footer')
    <script src="{{ url('https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/min/dropzone.min.js') }}"></script>
    <script src="{{ url('https://cdn.jsdelivr.net/clipboard.js/1.5.10/clipboard.min.js') }}"></script>
    <script src="{{ asset('/js/clipboardjs-config.js') }}"></script>
    <script src="{{ asset('/js/dropzone-config.js')  }}"></script>


@stop
