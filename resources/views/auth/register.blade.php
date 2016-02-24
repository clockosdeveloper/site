@extends('app')

@section('content')
    <div class="container-fluid">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Join <span style="color: red">clockOS</span> Developers</div>
                <div class="panel-body">
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> {{trans('auth.input')}}<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/auth/register') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <div class="form-group">
                            <label class="col-md-4 control-label">{{trans('auth.email')}}</label>
                            <div class="col-md-4">
                                <input type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">{{trans('auth.password')}}</label>
                            <div class="col-md-4">
                                <input type="password" class="form-control" name="password" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">{{trans('auth.confirm')}}</label>
                            <div class="col-md-4">
                                <input type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-4 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    {{trans('auth.send')}}
                                </button>
                            </div>
                        </div>
                    </form>
                        <a class="btn btn-link" href="{{ url('/auth/login') }}">{{trans('auth.have')}}</a>
                </div>
            </div>
        </div>

    </div>
@endsection