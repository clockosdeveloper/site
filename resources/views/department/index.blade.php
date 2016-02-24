@extends('app')
@section('content')
<h1>{{trans('show.departments')}}</h1>
    <hr/>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">{{trans('app.position')}}</h3>
    </div>
    <div class="panel-body">

    </div>
</div>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">{{trans('app.permission')}}</h3>
    </div>
    <div class="panel-body">

    </div>
</div>
@endsection
@section('footer')
    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>
@endsection