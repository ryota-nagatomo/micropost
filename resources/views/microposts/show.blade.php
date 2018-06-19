@extends('layouts.app')

@section('content')
    <div class="row">
        <aside class="col-xs-4">
            <div class="panel panel-default" style="word-break:break-all;">
                <div class="panel-heading">
                    <h3 class="panel-title">{{ $micropost->user->name }}'s post <span style="font-size : 7pt">{!! link_to_route('users.show', 'View profile', ['id' => $micropost->user->id]) !!}</span></h3>
                </div>
                <div class="panel-body">
                    {{ $micropost->content }}
                </div>
                <div class="panel-footer">
                    <span class="text-muted">posted at {{ $micropost->created_at }}</span>
                </div>
            </div>
        </aside>
        <div class='col-xs-4'>
            <span class="glyphicon glyphicon-star"></span> {{$micropost->favorited()->count()}} by</a></span>
            <br><br>
            @if (count($users) > 0)
                @include('users.users', ['users' => $users])
            @endif
        </div>
    </div>
@endsection