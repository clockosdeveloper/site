@extends('app')
@section('stylesheet')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/min/dropzone.min.css" rel="stylesheet">
    <link  href="https://cdn.rawgit.com/fengyuanchen/cropper/v2.1.0/dist/cropper.min.css" rel="stylesheet">
@endsection
@section('content')
    @include('partials.profiles')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">{{trans('profile.change')}}</h3>
        </div>


    </div>
    <div id="drop">
        <form action="/profiles/avatar/upload" method="POST" class="dropzone" id="myAwesomeDropzone" style="border: #D9EDF7 1px solid">
            {{ csrf_field() }}
        </form>
    </div>
    <br/>
    <form action="/profiles/avatar/update" method="POST">
        <div class="form-group">
            {!! Form::submit(trans('profile.crop'), ['class' => 'btn btn-primary form-control','id' => 'confirm']) !!}
        </div>
        {{ csrf_field() }}
        <input type="hidden" name="x">
        <input type="hidden" name="y">
        <input type="hidden" name="w">
        <input type="hidden" name="h">
    </form>

@stop

@section('footer')
    <script src="https://cdn.rawgit.com/fengyuanchen/cropper/v2.1.0/dist/cropper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/min/dropzone.min.js"></script>
    <script>
        Dropzone.options.myAwesomeDropzone = {
            paramName: "file", // The name that will be used to transfer the file
            maxFilesize: 2, // MB
            maxFiles:1,
            dictMaxFilesExceeded:'头像只能上传一个',
            dictFallbackMessage:'你的游览器不支持拖拽上传，可以点击下面的上传按钮上传.支持jpg,png,gif格式，大小不要超过2M',
            dictDefaultMessage:'拖拽即可上传！支持jpg,png,gif格式，大小不要超过2M',
            dictFallbackText:'点击upload上传图片',
            dictRemoveFile:true,
            clickable:true,

            init: function () {
                this.on("complete", function () {
                    $.get('/profiles/avatar/link',function( data ) {
                        var link = '<div class="panel-body"><img src="'+data+'" id="image" alt="{{$user->username}}"></div>';
                        $(".panel-heading").after(link);
                        $('#image').cropper({
                            aspectRatio: 1 / 1,
                            viewMode:1,
                            crop: function(e) {
                                // Output the result data for cropping image.
                                $("input[name=x]").val(e.x);
                                $("input[name=y]").val(e.y);
                                $("input[name=w]").val(e.width);
                                $("input[name=h]").val(e.height);
                            }
                        });
                        $("#drop").html('<div class="form-group"><a href="/profiles/avatar/" class="btn btn-warning form-control">重新上传</a></div>');
                    });
                });
            }
        };

        $('.alert-info').delay(3000).slideUp(300);

    </script>
@stop