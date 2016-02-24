@if($vary>0)
    <span class="
    @if(App::getLocale()=='zh')
            text-danger
    @else
            text-success
        @endif
    glyphicon glyphicon-arrow-up" aria-hidden="true"></span>
@endif
@if($vary<0)
    <span class="
    @if(App::getLocale()=='en')
        text-danger
    @else
        text-success
    @endif
    glyphicon glyphicon-arrow-down" aria-hidden="true"></span>
@endif
@if($vary==0)
    <span class="text-primary glyphicon glyphicon-minus" aria-hidden="true"></span>
@endif
