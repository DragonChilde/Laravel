这是一个test3的blade模板页面<br/>
<!-- 在页面显示定义的参数 -->
{{$date}}{{$year}}

<!-- 在页面调用函数 -->
{{date('H:i:s',$timeStamp)}}
