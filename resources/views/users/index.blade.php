@extends('layout')

@section('content')
    
<h1>{{ $users->name }}のページ</h1>

@if ($is_image)
<figure>
    <img src="/storage/profile_images/{{ Auth::id() }}.jpg" width="100px" height="100px">
    <figcaption>現在の画像</figcaption>
</figure>
@endif

<form method="POST" action="/users/{{ $user_id }}" enctype="multipart/form-data" >
    {{ csrf_field() }}
    <input type="file" name="photo">
    <input type="submit">
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
        <th>山の名前</th><th>リンク</th><th>投稿者</th>
    </tr>
    @foreach ($Treks as $Trek)
        <tr>
            <td>{{ $Trek->name }}</td>
            <td>
                <a href={{ route('detail.detail', ['id' =>  $Trek->id]) }}>
                    {{ $Trek->name }}
                </a>
            </td>
            <td>{{ $Trek->user->name }}</td>
        </tr>
    @endforeach
</table>


@endsection
