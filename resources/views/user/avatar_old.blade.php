@extends('app')
@section('stylesheet')
    <link  href="https://cdn.rawgit.com/fengyuanchen/cropper/v2.1.0/dist/cropper.min.css" rel="stylesheet">
@endsection
@section('content')
    @include('partials.profiles')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">更改头像</h3>
        </div>
        <div class="panel-body">
            <img src="{{session('avatar')}}" alt="{{$user->username}}" id="image">
        </div>
    </div>
    <div id="drop">
        <div class="form-group"><a href="/profiles/avatar/" class="btn btn-warning form-control">重新上传</a></div>
    </div>
    <br/>
    <form action="/profiles/avatar/update" method="POST">
        <div class="form-group">
            {!! Form::submit('修改', ['class' => 'btn btn-primary form-control','id' => 'confirm']) !!}
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
    <script>
        $('.alert-info').delay(3000).slideUp(300);
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

    </script>
@stop