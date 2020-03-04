@extends('layout')

{{--
    フォームに関して
http://recipes.laravel.jp/recipe/224
属性を追加する場合は、第二引数に配列を利用しなければなりません
--}}
@section('content')
    <h1>新しく情報を登録する</h1>
    {{ Form::open(['route' => 'detail.store']) }}

    <table class='table table-striped table-hover'>
        <tr><td>
            画像:
    </td>
    <td>
        <div class="form-image_url">
            <input type="file" name="image_url"> 
        </div>
        </td></tr>
        <tr><td>
    <div class='form-group'>
        {{ Form::label('name', '山の名前:') }}</div>
        @if ($errors->has('name'))
        <span class="error">{{ $errors->first('name')}}</span>
        @endif
    </td>
    <td>
        <div class='form-group'>
        {{ Form::text('name', null) }}
    </div>
    </td></tr>
    <tr><td>
    <div class='form-group'>
        {{ Form::label('area', 'エリア:') }}</div>
    </td>
    <td>
        <div class='form-group'>
        {{ Form::select('area', ['北海道' => '北海道', '東北' => '東北', '関東' => '関東', '中部' => '中部', '関西' => '関西', '中国' => '中国', '四国' => '四国', '九州・沖縄' => '九州・沖縄']) }}
    </div>
    </td></tr>
    <tr><td>
    <div class='form-group'>
        {{ Form::label('difficulty', '登山難度:') }}</div>
        @if ($errors->has('difficulty'))
        <span class="error">{{ $errors->first('difficulty')}}</span>
        @endif
    </td>
    <td>
        <div class='form-group'>
        {{ Form::text('difficulty', null) }}
    </div>
    </td></tr>
    <tr><td>
    <div class='form-group'>
        {{ Form::label('access', 'アクセス:') }}</div>
        @if ($errors->has('access'))
        <span class="error">{{ $errors->first('access')}}</span>
        @endif
    </td>
    <td>
        <div class='form-group'>
        {{ Form::text('access', null) }}
    </div>
    </td></tr>
    <tr><td>
    <div class='form-group'>
        {{ Form::label('gear', '装備:') }}</div>
        @if ($errors->has('gear'))
        <span class="error">{{ $errors->first('gear')}}</span>
        @endif
    </td>
    <td>
        <div class='form-group'>
        {{ Form::text('gear', null) }}
    </div>
    </td></tr>
    <tr><td>
    <div class='form-group'>
        {{ Form::label('days', '日数:') }}</div>
    </td>
    <td>
        <div class='form-group'>
            {{ Form::select('days', ['日帰り' => '日帰り', '1泊2日' => '1泊2日', '2泊3日' => '2泊3日', '3泊4日' => '3泊4日', '4泊5日' => '4泊5日', 'その他' => 'その他']) }}
        </div>
    </td></tr>
</table>

    <div class="form-group">
        {{ Form::submit('新規作成する', ['class' => 'btn btn-outline-primary']) }}
    </div>
    {{ Form::close() }}

@endsection
