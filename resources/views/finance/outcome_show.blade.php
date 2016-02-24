@extends('app')
@section('stylesheet')
@endsection
@section('content')
    <div class="panel panel-default">
        <div class="panel-body">
            <h3 class="quest-title">{{$outcome->title}}[{{trans('finance.'.$outcome->state)}}]</h3>
            <hr/>
            <div class="col-md-6">
                <dl class="dl-horizontal">
                    <dt>{{trans('finance.provider')}}</dt>
                    <dd>{{$outcome->provider}}</dd>
                </dl>
                <dl class="dl-horizontal">
                    <dt>{{trans('finance.type')}}</dt>
                    <dd>{{trans('finance.'.$outcome->type)}}</dd>
                </dl>
                <dl class="dl-horizontal">
                    <dt>{{trans('finance.applier')}}</dt>
                    <dd><a href="/profiles/{{$outcome->user->id}}">{{$outcome->user->username}}</a></dd>
                </dl>
                <dl class="dl-horizontal">
                    <dt>{{trans('finance.apply_date')}}</dt>
                    <dd>{{$outcome->created_at->format('Y-m-d')}}</dd>
                </dl>
                @if($outcome->state>0)
                    <dl class="dl-horizontal">
                        <dt>{{trans('finance.checker')}}</dt>
                        <dd><a href="/profiles/{{$outcome->checker->id}}">{{$outcome->checker->username}}</a></dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt>{{trans('finance.check_date')}}</dt>
                        <dd>{{$outcome->updated_at->format('Y-m-d')}}</dd>
                    </dl>
                @endif
            </div>
            <div class="col-md-6">
                <dl class="dl-horizontal">
                    <dt>{{trans('finance.price')}}</dt>
                    <dd>{{Clockos\ChangeRate::toRmb($outcome->price)}}</dd>
                </dl>
                <dl class="dl-horizontal">
                    <dt>{{trans('finance.amount')}}</dt>
                    <dd>{{$outcome->amount}}</dd>
                </dl>
                <dl class="dl-horizontal">
                    <dt>{{trans('finance.unit_price')}}</dt>
                    <dd>{{Clockos\ChangeRate::toRmb($outcome->average)}}</dd>
                </dl>
                <dl class="dl-horizontal">
                    <dt>{{trans('finance.start')}}</dt>
                    <dd>{{$outcome->start->format('Y-m-d')}}</dd>
                </dl>
                <dl class="dl-horizontal">
                    <dt>{{trans('finance.end')}}</dt>
                    <dd>{{$outcome->end->format('Y-m-d')}}</dd>
                </dl>
            </div>
            <div class="quests-markdown col-md-12"><hr/>{!!$outcome->body!!}</div>
        </div>
    </div>

<div class="btn-group btn-group-justified col-lg-6" role="group" aria-label="...">
    @if($outcome->state==0)
        @can('update',$outcome)
            <a class="btn btn-danger" data-token="{{csrf_token()}}" href="/finance/outcome/{{$outcome->id}}" data-method="delete" data-confirm="{{trans('show.sure')}}">{{trans('doc.delete')}}</a>
        @endcan
        @can('check_outcome')
        <a class="btn btn-success" data-token="{{csrf_token()}}" href="/finance/outcome/grant/{{$outcome->id}}" data-method="put" data-confirm="{{trans('show.sure')}}">{{trans('finance.grant')}}</a>
        @endcan

    @endif
    @if($outcome->state==2)
        @can('check_outcome')
            <a class="btn btn-primary" data-token="{{csrf_token()}}" href="/finance/outcome/executed/{{$outcome->id}}" data-method="put" data-confirm="{{trans('show.sure')}}">{{trans('finance.executed')}}</a>
        @endcan
    @endif

</div>
@stop

@section('footer')
    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
            $('.quests-markdown table').addClass('table')
        })

        $(function() {

            var laravel = {
                initialize: function() {
                    this.methodLinks = $('a[data-method]');
                    this.token = $('a[data-token]');
                    this.registerEvents();
                },

                registerEvents: function() {
                    this.methodLinks.on('click', this.handleMethod);
                },

                handleMethod: function(e) {
                    var link = $(this);
                    var httpMethod = link.data('method').toUpperCase();
                    var form;

                    // If the data-method attribute is not PUT or DELETE,
                    // then we don't know what to do. Just ignore.
                    if ( $.inArray(httpMethod, ['PUT', 'DELETE']) === - 1 ) {
                        return;
                    }

                    // Allow user to optionally provide data-confirm="Are you sure?"
                    if ( link.data('confirm') ) {
                        if ( ! laravel.verifyConfirm(link) ) {
                            return false;
                        }
                    }

                    form = laravel.createForm(link);
                    form.submit();

                    e.preventDefault();
                },

                verifyConfirm: function(link) {
                    return confirm(link.data('confirm'));
                },

                createForm: function(link) {
                    var form =
                            $('<form>', {
                                'method': 'POST',
                                'action': link.attr('href')
                            });

                    var token =
                            $('<input>', {
                                'type': 'hidden',
                                'name': '_token',
                                'value': link.data('token')
                            });

                    var hiddenInput =
                            $('<input>', {
                                'name': '_method',
                                'type': 'hidden',
                                'value': link.data('method')
                            });

                    return form.append(token, hiddenInput)
                            .appendTo('body');
                }
            };

            laravel.initialize();
        });
    </script>
@endsection
