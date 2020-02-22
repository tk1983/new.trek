@extends('layout')

@section('content')
        <h1>一覧ページ</h1>
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
        <div>
            <a href={{ route('detail.new') }} class='btn btn-outline-primary'>新しく登録</a>
        <div>
@endsection
