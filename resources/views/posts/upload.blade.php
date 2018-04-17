@extends('layout.adminheader')
@section('content')
<form action="upload" method="post" accept-charset="utf-8" enctype="multipart/form-data">
	{{csrf_field()}}
	<input type="file" name="images" value="" placeholder="">
	<button type="submit">thêm ảnh</button>
</form>
<a href="{{asset('facebook/callback')}}">Login FaceBook</a>

@endsection