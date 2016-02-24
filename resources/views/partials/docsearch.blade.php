<br/>
@foreach($items as $item)
    <a href="/docs/{{$item->permalink}}">{{Clockos\DualLang::lang($item->title,$item->entitle)}}</a><hr/>
@endforeach