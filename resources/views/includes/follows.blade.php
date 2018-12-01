@if(Auth::user()->id != $user->id)
    <?php $is_follow = false;?>
    @foreach ($follows as $follow)
        @if($follow->followed == $user->id)
            <?php $is_follow = true;?>
        @endif
    @endforeach

    @if($is_follow)
        <a href="{{Route('unfollow', ['follower' => Auth::user()->id, 'followed' => $user->id])}}" class="unfollow btn btn-outline-primary">Unfollow</a>
    @else
        <a href="{{Route('follow', ['follower' => Auth::user()->id, 'followed' => $user->id])}}" class="follow btn btn-primary">Follow</a>
    @endif
@endif