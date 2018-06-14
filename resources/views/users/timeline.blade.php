@extends('layouts.app')

@section('content')
    @if (Auth::user()->id == $user->id)
        {!! Form::open(['route' => 'microposts.store']) !!}
            <div class="form-group">
                {!! Form::textarea('content', old('content'), ['class' => 'form-control', 'rows' => '2']) !!}
                {!! Form::submit('Post', ['class' => 'btn btn-primary btn-block']) !!}
            </div>
        {!! Form::close() !!}
    @endif

    @include('microposts.microposts', ['user' => $user])
@endsection