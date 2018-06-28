<ul class="media-list">
@foreach ($microposts as $micropost)
    <?php $user = $micropost->user; ?>
    <li class="media">
        <div class="media-left">
            <img class="media-object img-circle" src="{{ Gravatar::src($user->email, 50) }}" alt="">
        </div>
        <div class="media-body">
            <div>
                {!! link_to_route('users.show', $user->name, ['id' => $user->id]) !!} <span class="text-muted">posted at {{ $micropost->created_at }}</span>  <span class = "text-muted"><a href="{{ route('microposts.show', ['id' => $micropost->id]) }}"><span class="glyphicon glyphicon-heart-empty"></span> {{$micropost->favorited()->count()}}</a></span>
            </div>
            <div>
                <p>{!! nl2br(e($micropost->content)) !!} </p>
                <img src="{{ asset('storage/micropost/' . $micropost->file_name) }}" alt="" />
            </div>
            <div class='btn-inline'>
                <div class='btn-group'>
                    @include('micropost_user.favorites_button', ['user' => $user])
                </div>
                <div class='btn-group'>
                    @if (Auth::user()->id == $micropost->user_id)
                        {!! Form::open(['route' => ['microposts.destroy', $micropost->id], 'method' => 'delete']) !!}
                            <button type="submit" class="btn btn-original"><span class='glyphicon glyphicon-trash'></span></button>
                        {!! Form::close() !!}
                    @endif
                </div>
            </div>
        </div>
    </li>
@endforeach
</ul>
{!! $microposts->render() !!}