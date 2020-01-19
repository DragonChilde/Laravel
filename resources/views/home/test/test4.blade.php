@foreach($data as $key=>$item)
    id:{{$item->id}},name:{{$item->name}}<br/>
@endforeach

<hr/>
@if($day == 1)
    星期一
@elseif($day == 2)
    星期二
@elseif($day == 3)
    星期三
@elseif($day == 4)
    星期四
@elseif($day == 5)
    星期五
@elseif($day == 6)
    星期六
@else
    星期日
@endif
