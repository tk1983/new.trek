@extends('layout')

@section('content')
    
<h1>{{ $details->name }}のページ</h1>

@if ($image_url)
<img src ="/{{ $image_url }}" width="800px" height="450px">
@endif

    <iframe src="https://maps.google.co.jp/maps?output=embed&q={{ $details->name }}"
        width='100%'
        height='320'
        frameborder='0'>
    </iframe>

{{--
    <div id="map" style="height: 320px; width: 80%; margin: 2rem auto 0;"></div>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDTbRzLhZD6CbK8-By6-GpvpJyBfqvp_kQ"></script>
<script type="text/javascript">
    var map = new google.maps.Map(document.getElementById('map'), {
        center: {
            lat: -34.397, //緯度を設定
            lng: 150.644 //経度を設定
        },
        zoom: 8 //地図のズームを設定
    });
</script>
--}}

@foreach ($treks as $trek) 
<div class="col-md-8 col-md-2 mx-auto">
    <div class="card-wrap">
      <div class="card">
<div class="card-body">
    <div class="row parts">
      <div id="like-icon-post-{{ $trek->id }}">
        @if ($trek->likedBy(Auth::user())->count() > 0)
          <a class="loved hide-text" data-remote="true" rel="nofollow" data-method="DELETE" href="/likes/{{ $trek->likedBy(Auth::user())->firstOrFail()->id }}">いいねを取り消す</a>
        @else
          <a class="love hide-text" data-remote="true" rel="nofollow" data-method="POST" href="/mountain/{{ $trek->id }}/likes">いいね</a>
        @endif
      </div>
      <a class="comment" href="#"></a>
    </div>
    <div id="like-text-post-{{ $trek->id }}">
    {{--  @include('post.like_text')  --}}
    </div>
    <div>
      <span><strong>{{ $trek->user->name }}</strong></span>
      <span>{{ $trek->caption }}</span>
    </div>
  </div>
</div>
</div>
</div>
  @endforeach

<table class='table table-striped table-hover'>
    <tr>
        <td>山の名前</td>
        <td><p>{{ $details->name }}</p></td>
    </tr>
    <tr>
        <td>エリア</td>
        <td><p>{{ $details->area }}</p></td>
    </tr>
    <tr>
        <td>登山難度</td>
        <td><p>{{ $details->difficulty }}</p></td>
    </tr>            
    <tr>
        <td>アクセス</td>
        <td><p>{{ $details->access }}</p></td>
    </tr>            
    <tr>
        <td>装備</td>
        <td><p>{{ $details->gear }}</p></td>
    </tr>
    <tr>
        <td>日数</td>
        <td><p>{{ $details->days }}</p></td>
</table>

        <div>
            <a href={{ route('detail.index') }} class='btn btn-outline-primary'>一覧に戻る</a>
            @auth
                @if ($details->user_id === $login_user_id)
            　|　 <a href={{ route('detail.edit', ['id' => $details->id])}} class='btn btn-outline-primary'>編集する</a>
        </div>
        {{ Form::open(['method' => 'delete', 'route' => ['detail.destroy', $details->id]]) }}
            {{ Form::submit('削除する', ['class' => 'btn btn-outline-primary'])}}
        {{ Form::close() }}
                @endif
            @endauth
<br>
<br>
@endsection
