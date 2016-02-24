@extends('app')
@section('content')
    @include('partials.profiles')
<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
    <div class="panel panel-default">
        <div class="panel-heading" role="tab" id="headingOne">
            <h4 class="panel-title">
                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    Programming Languages
                </a>
            </h4>
        </div>
        <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
            <div class="panel-body">
                @foreach($languages as $item)
                    <a href="#" class="more-skills" data-skillid="{{$item->id}}">
                        <img class="skill" src="{{\Clockos\Test::cdn($item->logo)}}" alt="{{$item->name}}" data-toggle="tooltip" data-placement="bottom" title="{{$item->name}}">
                    </a>
                @endforeach
            </div>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading" role="tab" id="headingTwo">
            <h4 class="panel-title">
                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    Visual & Auditory
                </a>
            </h4>
        </div>
        <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
            <div class="panel-body">
                @foreach($visuals as $item)
                    <a href="#" class="more-skills" data-skillid="{{$item->id}}">
                        <img class="skill" src="{{\Clockos\Test::cdn($item->logo)}}" alt="{{$item->name}}"  data-toggle="tooltip" data-placement="bottom" title="{{$item->name}}">
                    </a>
                @endforeach
            </div>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading" role="tab" id="headingThree">
            <h4 class="panel-title">
                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    Software Engineering & Maintenance
                </a>
            </h4>
        </div>
        <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
            <div class="panel-body">
                @foreach($maintenance as $item)
                    <a href="#" class="more-skills" data-skillid="{{$item->id}}">
                        <img class="skill" src="{{\Clockos\Test::cdn($item->logo)}}" alt="{{$item->name}}"  data-toggle="tooltip" data-placement="bottom" title="{{$item->name}}">
                    </a>
                @endforeach
            </div>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading" role="tab" id="headingFour">
            <h4 class="panel-title">
                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                    Consultant
                </a>
            </h4>
        </div>
        <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
            <div class="panel-body">
                @foreach($consultant as $item)
                    <a href="#" class="more-skills" data-skillid="{{$item->id}}">
                        <img class="skill" src="{{\Clockos\Test::cdn($item->logo)}}" alt="{{$item->name}}"  data-toggle="tooltip" data-placement="bottom" title="{{$item->name}}">
                    </a>
                @endforeach
            </div>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading" role="tab" id="headingFive">
            <h4 class="panel-title">
                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                    Operating
                </a>
            </h4>
        </div>
        <div id="collapseFive" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFive">
            <div class="panel-body">
                @foreach($operating as $item)
                    <a href="#" class="more-skills" data-skillid="{{$item->id}}">
                        <img class="skill" src="{{\Clockos\Test::cdn($item->logo)}}" alt="{{$item->name}}"  data-toggle="tooltip" data-placement="bottom" title="{{$item->name}}">
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="skill">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

@endsection

@section('footer')
<script>
    $(document).ready(function () {

       $('[data-toggle="tooltip"]').tooltip()

       $(".more-skills").on('click',function(){

           var id = $(this).data("skillid");
           var link = '/roles/skills/'+id;

           $.get( link,function( data ) {
               $('.modal-content').html(data);
           });

           $("#skill").modal();
       });

        var subskill='';

       $(document).on('click',"#confirm",function(){
           if(subskill){
               $("#confirm").hide();
               $("#alert-message,#sure,#cancel").show();
           }else{
               alert('请选择一项。');
           }

       });
        $(document).on('change','input[name="subskill"]',function()
        {
            subskill = $(this).val();
        });

    });
</script>
@endsection