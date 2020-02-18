@extends('layout')

@section('content')
    <h1>新しく情報を登録する</h1>
    {{ Form::open(['route' => 'detail.store']) }}

    <div class='form-group'>
        {{ Form::label('name', '山の名前:') }}
        {{ Form::text('name', null) }}
    </div>
    <div class='form-group'>
        {{ Form::label('area', 'エリア:') }}
        {{ Form::text('area', null) }}
    </div>
    <div class='form-group'>
        {{ Form::label('difficulty', '登山難度:') }}
        {{ Form::text('difficulty', null) }}
    </div>
    <div class='form-group'>
        {{ Form::label('access', 'アクセス:') }}
        {{ Form::text('access', null) }}
    </div>
    <div class='form-group'>
        {{ Form::label('gear', '装備:') }}
        {{ Form::text('gear', null) }}
    </div>
    <div class='form-group'>
        {{ Form::label('days', '日数:') }}
        {{ Form::text('days', null) }}
    </div>
    <div class="form-group">
        {{ Form::submit('新規作成する', ['class' => 'btn btn-outline-primary']) }}
    </div>
    {{ Form::close() }}

@endsection
