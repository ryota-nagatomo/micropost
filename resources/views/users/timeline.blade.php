@extends('layouts.app')

@section('content')
    @include('microposts.microposts', ['user' => $user])
@endsection