@extends('layout')

@section('content')
        <h1>一覧ページ</h1>
        <table class='table table-striped table-hover'>
            <tr>
                <th>山の名前</th><th>リンク</th>
            </tr>
            @foreach ($details as $detail)
                <tr>
                    <td>{{ $detail->name }}</td>
                    <td>
                        <a href={{ route('detail.detail', ['id' =>  $detail->id]) }}>
                            {{ $detail->name }}
                        </a>
                    </td>
                </tr>
            @endforeach
        </table>
@endsection
