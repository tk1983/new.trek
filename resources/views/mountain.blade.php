@extends('layout')

@section('content')
    
<h1>{{ $details->name }}のページ</h1>

<iframe id='map' src='https://www.google.com/maps/embed/v1/place?key=AIzaSyDTbRzLhZD6CbK8-By6-GpvpJyBfqvp_kQ&amp;q={{ $details->access }}'
    width='100%'
    height='320'
    frameborder='0'>
    </iframe>

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
            <a href={{ route('detail.index') }}>一覧に戻る</a>
            | <a href={{ route('detail.edit', ['id' => $trek->id])}}>編集</a>
        </div>
        {{ Form::open(['method' => 'delete', 'route' => ['detail.destroy', $trek->id]]) }}
            {{ Form::submit('削除') }}
        {{ Form::close() }}
@endsection
