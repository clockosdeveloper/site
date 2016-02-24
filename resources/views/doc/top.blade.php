<h1>{{trans('app.project')}}</h1>
<hr/>
<ul class="nav nav-tabs" style="margin-bottom: 15px">
    <li role="presentation"><a href="{{ url('/quests') }}">{{trans_choice('app.quest',2)}}</a></li>
    <li role="presentation"><a href="{{ url('/quests/my') }}">{{trans('show.my')}}</a></li>
    <li role="presentation" class="active"><a href="{{ url('/docs') }}">{{trans_choice('app.docs',2)}}</a></li>
</ul>
<div class="panel panel-default">
    <div class="panel-body">
        <br/>
        <div class="col-md-6">
            <div class="form-group">
                <form method = "POST" action = "/docsearch">
                    <div class="input-group">
                        {!! Form::text('term', null, ['class' => 'form-control','required']) !!}
                        <span class="input-group-btn">
                              {!! Form::submit(trans('app.search'), ['class' => 'btn btn-primary']) !!}
                          </span>
                    </div><!-- /input-group -->
                    {!! csrf_field() !!}
                </form>
            </div>
        </div>
        <div class="col-md-6">
            @can('edit_document')
            <div class="btn-group" role="group" aria-label="...">
                <a class="btn btn-primary btn-" href="/docs/create">{{trans('doc.create')}}</a>
            </div>
            @endcan
            &nbsp;&nbsp;&nbsp;&nbsp;{{trans('doc.number',['number'=>$number])}}
        </div>
    </div>
</div>