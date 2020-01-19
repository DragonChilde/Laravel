<form action="{{route('test7')}}" method="post">
    <input type="text" name=""/>
    <!--添加CSRF验证-->
    <!--csrf_token()-->
   <!--  <input type="hidden" name="_token" value="{{csrf_token()}}"> -->
   <!--csrf_field()-->
  {{csrf_field()}}
    <input type="submit" name=""/>
</form>
