@extends('layout')

@section('content')
    <h1>{{$trek->name}}を編集する</h1>
    {{ Form::model($trek, ['route' => ['detail.update', $trek->id]]) }}
    <table class='table table-striped table-hover'>
        <tr>
            <td>
    <div class='form-group'>
        {{ Form::label('name', '山の名前:') }}</div>
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
            {{ Form::select('area', ['北海道','東北','関東','中部','関西','中国','四国','九州・沖縄']) }}
        </div>
    </td></tr>
    <tr><td>
    <div class='form-group'>
        {{ Form::label('difficulty', '登山難度:') }}</div>
    </td>
    <td>
        <div class='form-group'>
        {{ Form::text('difficulty', null) }}
    </div>
    </td></tr>
    <tr><td>
    <div class='form-group'>
        {{ Form::label('access', 'アクセス:') }}</div>
    </td>
    <td>
        <div class='form-group'>
        {{ Form::text('access', null) }}
    </div>
    </td></tr>
    <tr><td>
    <div class='form-group'>
        {{ Form::label('gear', '装備:') }}</div>
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
        {{ Form::text('days', null) }}
    </div>
    </td></tr>
</table>

    <div class="form-group">
        {{ Form::submit('更新する', ['class' => 'btn btn-outline-primary']) }}
    </div>
    {{ Form::close() }}

@endsection
