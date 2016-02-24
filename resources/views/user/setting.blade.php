@extends('app')

@section('content')
    <h1>{{trans('app.settings')}}</h1>
    <hr/>
    <div id="setting-msg"></div>
    <div class="panel panel-default">
        <div class="panel-heading">{{trans('setting.privacy')}}</div>
        <div class="panel-body">

            <div class="form-group">
                <input type="checkbox" data-setting="sponsor_code" class="settings-switch" {{Clockos\CheckedOrNot::setting('sponsor_code')}}>{{trans('profile.findbyemail')}}<br/>
            </div>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">{{trans_choice('app.notification',1)}}</div>
        <div class="panel-body">
            <div class="form-group">
                <input type="checkbox" data-setting="email_task_published" class="settings-switch" {{Clockos\CheckedOrNot::setting('email_task_published')}}>{{trans('setting.email_task_published')}}<br/>
            </div>
            <div class="form-group">
                <input type="checkbox" data-setting="email_found_me" class="settings-switch" {{Clockos\CheckedOrNot::setting('email_found_me')}}>{{trans('setting.email_found_me')}}<br/>
            </div>
        </div>
    </div>
@stop
@section('footer')
    <script>
        $(document).ready(function () {
            $(".settings-switch").on('change', function () {
                    $(".settings-switch").attr("disabled", true);
                    var setting = $(this).data('setting');
                    $.ajax({
                        url: '/setting/switch',
                        type: "post",
                        data: {'type': setting, '_token': '{{csrf_token()}}'},
                        success: function (data) {

                            $("#setting-msg").html('<span class="setting-success bg-success text-success">{{trans('setting.success')}}</span>');
                            $(".setting-success").delay(2000).slideUp(300);

                            $(".settings-switch").removeAttr("disabled");
                        }
                    });
            });
        });
    </script>
@endsection