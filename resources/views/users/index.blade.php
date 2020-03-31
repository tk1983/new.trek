@extends('layout')

<style type="text/css">
.gorgias-loaded{
  padding: 0;
}
.bg-image {
  background-image: url('../../top.jpg');
  width: 100%;
  height: 100%;
  background-size: cover;
}
.bg-mask {
  height: 100%;
  background: rgba(255,255,255,0.5);
}
</style>

<div class="bg-image">
    <div class="bg-mask">

@section('content')
    
<br><br><br><br>
<h1>{{ $users->name }}のページ</h1>

@if ($is_image)
<figure>
    <img src="/storage/profile_images/{{ Auth::id() }}.jpg" width="100px" height="100px">
    <figcaption>現在のプロフィール画像</figcaption>
</figure>
@endif

<form method="POST" action="/users/{{ $user_id }}" enctype="multipart/form-data" >
    {{ csrf_field() }}
    <input class='btn btn-primary' type="file" name="photo">
    <input class='btn btn-primary' type="submit">
</form>

@if ($errors->any())
<div class="alert alert-danger">
    <ul>
    @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
    @endforeach
    </ul>
</div>
@endif

@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

<br>
<br>
<h1>過去の投稿一覧</h1>
<table class='table table-striped table-hover'>
    <tr>
        <th>山の名前</th><th>投稿者</th>
    </tr>
    @foreach ($Treks as $Trek)
        <tr>
            <td>
                <a href={{ route('detail.detail', ['id' =>  $Trek->id]) }}>
                    {{ $Trek->name }}
                </a>
            </td>
            <td>{{ $Trek->user->name }}</td>
        </tr>
    @endforeach
</table>
</div>
</div>

@endsection
