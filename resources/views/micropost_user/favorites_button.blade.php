@if (Auth::user()->is_favoriting($micropost->id))
        {!! Form::open(['route' => ['user.unfavorite', $micropost->id], 'method' => 'delete']) !!}
            <button type="submit" class="btn btn-original"><span class='glyphicon glyphicon-heart color-pink'></span></button>
        {!! Form::close() !!}
    @else
        {!! Form::open(['route' => ['user.favorite', $micropost->id]]) !!}
            <button type="submit" class="btn btn-original"><span class='glyphicon glyphicon-heart-empty'></span></button>
        {!! Form::close() !!}
@endif