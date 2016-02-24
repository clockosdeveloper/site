<div class="form-group">
    {!! Form::label('title',trans('form.title')) !!}
    {!! Form::text('title', null, ['class' => 'form-control','required']) !!}
</div>

<div class="form-group" id="quest-types">
    {!! Form::label('type',trans('form.type')) !!}
    <div class="radio">
        <label>
            {!! Form::radio('type',  'ixd') !!}{{trans('form.ixd')}}
        </label>
        <label>
            {!! Form::radio('type',  'uid') !!}{{trans('form.uid')}}
        </label>
        <label>
            {!! Form::radio('type',  'program') !!}{{trans('form.program')}}
        </label>
        <label>
            {!! Form::radio('type',  'db') !!}{{trans('form.db')}}
        </label>
        <label>
            {!! Form::radio('type',  'algorithm') !!}{{trans('form.algorithm')}}
        </label>
        <label>
            {!! Form::radio('type',  'architect') !!}{{trans('form.architect')}}
        </label>
        <label>
            {!! Form::radio('type',  'optimize') !!}{{trans('form.optimize')}}
        </label>
        <label>
            {!! Form::radio('type',  'other') !!}{{trans('form.other')}}
        </label>
    </div>
    <div class="radio">
        <label>
            {!! Form::radio('type', 'test') !!}{{trans('form.test')}}
        </label>
        <label>
            {!! Form::radio('type',  'testing') !!}{{trans('form.testing')}}
        </label>
        <label>
            {!! Form::radio('type',  'merge') !!}{{trans('form.merge')}}
        </label>
        <label>
            {!! Form::radio('type', 'maintain') !!}{{trans('form.maintain')}}
        </label>
        <label>
            {!! Form::radio('type', 'network') !!}{{trans('form.network')}}
        </label>
        <label>
            {!! Form::radio('type',  'bug') !!}{{trans('form.bug')}}
        </label>
        <label>
            {!! Form::radio('type',  'security') !!}{{trans('form.security')}}
        </label>
        <label>
            {!! Form::radio('type',  'backup') !!}{{trans('form.backup')}}
        </label>
        <label>
            {!! Form::radio('type',  'statistics') !!}{{trans('form.statistics')}}
        </label>
        <label>
            {!! Form::radio('type',  'help') !!}{{trans('form.help')}}
        </label>
    </div>
    <div class="radio">
        <label>
            {!! Form::radio('type',  'essay') !!}{{trans('form.essay')}}
        </label>
        <label>
            {!! Form::radio('type',  'translation') !!}{{trans('form.translation')}}
        </label>
        <label>
            {!! Form::radio('type',  'material') !!}{{trans('form.material')}}
        </label>
        <label>
            {!! Form::radio('type',  'visual') !!}{{trans('form.visual')}}
        </label>
        <label>
            {!! Form::radio('type',  'slide') !!}{{trans('form.slide')}}
        </label>
        <label>
            {!! Form::radio('type',  'animation') !!}{{trans('form.animation')}}
        </label>
        <label>
            {!! Form::radio('type',  'video') !!}{{trans('form.video')}}
        </label>
        <label>
            {!! Form::radio('type',  'vocal') !!}{{trans('form.vocal')}}
        </label>
        <label>
            {!! Form::radio('type',  'music') !!}{{trans('form.music')}}
        </label>

    </div>
    <div class="radio">
        <label>
            {!! Form::radio('type',  'promote') !!}{{trans('form.promote')}}
        </label>
        <label>
            {!! Form::radio('type',  'present') !!}{{trans('form.present')}}
        </label>
        <label>
            {!! Form::radio('type',  'consult') !!}{{trans('form.consult')}}
        </label>
        <label>
            {!! Form::radio('type',  'law') !!}{{trans('form.law')}}
        </label>
        <label>
            {!! Form::radio('type',  'finance') !!}{{trans('form.finance')}}
        </label>
        <label>
            {!! Form::radio('type',  'capital') !!}{{trans('form.capital')}}
        </label>
        <label>
            {!! Form::radio('type',  'purchase') !!}{{trans('form.purchase')}}
        </label>
        <label>
            {!! Form::radio('type',  'service') !!}{{trans('form.service')}}
        </label>
        <label>
            {!! Form::radio('type',  'admin') !!}{{trans('form.admin')}}
        </label>
    </div>
</div>

<div class="form-group">
    {!! Form::label('department_list',trans('form.departments')) !!}
    {!! Form::select('department_list[]', $departments, null , ['id' => 'department_list','class' => 'form-control','multiple','required']) !!}
</div>

<div class="form-group">
    {!! Form::label('skill_list',trans('form.skills')) !!}
    {!! Form::select('skill_list[]', $skills, null , ['id' => 'skill_list','class' => 'form-control','multiple','required']) !!}
</div>

<div class="form-group">
    {!! Form::label('quest_list',trans('form.quests')) !!}
    {!! Form::select('quest_list[]',[],null,['id' => 'quest-list','class' => 'form-control','multiple']) !!}
</div>
<div class="form-group">
    {!! Form::label('difficulty',trans('form.difficulty')) !!}
    {!! Form::select('difficulty',array('1' => trans('form.easy'), '2' =>trans('form.normal'),'3' =>trans('form.intermediate'), '4' =>trans('form.difficult'),'5' => trans('form.ultimate')),null,['class' => 'form-control'])!!}
</div>
<div class="form-group">
    {!! Form::label('stock',trans('form.stock')) !!}&nbsp;&nbsp;&nbsp;<span id="stock"></span>
    {!! Form::input('number','stock',null,['class' => 'form-control', 'data-placement' => 'bottom', 'data-toggle' => 'popover','title' => trans('form.hint'),'data-content'=>trans('form.hint-content'),'placeholder'=> trans('form.integer'),'required']) !!}
</div>
<div class="form-group">
    {!! Form::label('days',trans('form.estimated')) !!}
    {!! Form::input('number','days',null,['class' => 'form-control','placeholder'=> trans('form.integer'),'required']) !!}
</div>
<div class="form-group">
    {!! Form::label('min_level',trans('form.min_level')) !!}<a href="/quests/11" class="text-success"> !任务 显示有多少开发者的等级大于等于所需的最低等级</a>
    {!! Form::input('number','min_level',null,['class' => 'form-control','placeholder'=> trans('form.integer'),'required']) !!}
</div>


<div class="form-group">
    {!! Form::label('body',trans('form.details')).'(.md)' !!}
    {!! Form::textarea('body', null, ['class' => 'form-control','required', 'rows'=>"4"]) !!}
</div>

<div class="form-group">
    {!! Form::submit($submitButtonText, ['class' => 'btn btn-primary form-control']) !!}
</div>
<input type="hidden" id="quest-placeholder" value="{{trans('form.search')}}">
@section('footer')
    <script>

        $(document).ready(function(){
            $.fn.select2.defaults.set('language', 'cn');

            $('#department_list,#skill_list').select2([lang="cn"]);

            $('#quest-list').select2({
                lang: "zh",
                placeholder:$("#quest-placeholder").val(),
                multiple: true,
                ajax: {
                    url: "/search/quest",
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {
                            q: params.term, // search term
                            page: params.page
                        };
                    },

                        processResults: function (data, params) {
                            // parse the results into the format expected by Select2
                            // since we are using custom formatting functions we do not need to
                            // alter the remote JSON data, except to indicate that infinite
                            // scrolling can be used
                            params.page = params.page || 1;

                            return {
                                results: data.items,
                                pagination: {
                                    more: (params.page * 30) < data.total_count
                                }
                            };
                        },
                        cache: true
                    },
                    escapeMarkup: function (markup) { return markup; }, // let our custom formatter work
                    minimumInputLength: 1,
                    templateResult: formatQuest, // omitted for brevity, see the source of this page
                    templateSelection: formatQuestSelection,


            });

            function formatQuest(data) {
                return '<div>'+data.fullname+'</div>';
            };


            function formatQuestSelection(data) {
                return data.title;
            };


            $('input[name="stock"]').on('keyup change',function(){
                var now = Number({{$status->stock}});
                var wait = Number({{$status->stock_wait}});
                var stock = Number($(this).val());
                var total = now + stock;
                var total_max = wait + stock + now;
                var percentage = parseFloat((stock/total)*100).toFixed(4);
                var percentage_min = parseFloat((stock/total_max)*100).toFixed(4);
                $("#stock").html("{{trans('form.about')}}"+percentage_min+' ~ '+percentage+'%');
            });

            $('input[name="stock"]').on('focus', function () {
                $(this).popover('show');
            });

            $('input[name="stock"]').on('focusout',function() {
                $(this).popover('hide')
            });

        });
    </script>
@endsection