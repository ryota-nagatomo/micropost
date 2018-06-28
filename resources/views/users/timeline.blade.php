@extends('layouts.app')

@section('content')
    @if (Auth::user()->id == $user->id)
        {!! Form::open(['route' => 'microposts.store', 'files' => true]) !!}
            <div class="form-group">
                {!! Form::textarea('content', old('content'), ['class' => 'form-control', 'rows' => '2']) !!}
                
                {!! Form::label('file', '画像アップロード', ['class' => 'control-label']) !!}
                {!! Form::file('file') !!}
                {!! Form::submit('Post', ['class' => 'btn btn-primary btn-block']) !!}
            </div>
        {!! Form::close() !!}
    @endif

    @include('microposts.microposts', ['user' => $user])
@endsection