@extends('layout')

@section('content')
    
<h1>{{ $details->name }}のページ</h1>

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
        <td><p>{{ $details->days }}日</p></td>
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
