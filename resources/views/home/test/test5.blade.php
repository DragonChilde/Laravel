<link rel="stylesheet" type="text/css" href="/css/app.css">

<link rel="stylesheet" type="text/css" href="{{asset('css')}}/app.css">
@extends('home.test.parent')
@section('mainbody')
<div>
    这是文章内容
</div>
@endsection

@include('home.test.parent')
