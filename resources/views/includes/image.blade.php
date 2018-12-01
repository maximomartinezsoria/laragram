<div class="card mb-5">
    <div class="card-header card-header-home pb-2">
        <img src=" {{Route('user.image', ['image_path' => $image->user->image]) }} " class="profile-image float-left mr-2"/>
        <a href="{{Route('user.profile', ['id' => $image->user->id])}}" class="font-weight-bold">{{$image->user->username}}</a>
    </div>

    <div class="card-body card-body-home p-0">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        
        <img src=" {{Route('image.file', ['image_path' => $image->image_path])}} " />
    </div>

    <div class="card-footer">

        <?php $userlike = false; ?>
        @foreach ($image->likes as $like)
            @if ($like->user->id == Auth::user()->id)
                <?php $userlike = true; ?>
            @endif
        @endforeach
        
        @if ($userlike)
            <img src="{{asset('img/heart-red.png')}}" style="cursor:pointer;" class="btn-dislike" data-id="{{$image->id}}"/>
        @else
            <img src="{{asset('img/heart-black.png')}}" style="cursor:pointer;" class="btn-like" data-id="{{$image->id}}"/>
        @endif

        @if (\Auth::user()->id == $image->user->id)
            <i class="fas fa-trash-alt icons float-right ml-2 text-black" data-toggle="modal" data-target="#confirm"></i>
        @endif

        <div class="clearfix"></div>

        @include('includes/likes-count')

        <p class="mb-2"><span class="font-weight-bold">{{$image->user->username}}:</span> {{ $image->description }}</p>


        @if(count($image->comments) != 0)
            @foreach ($image->comments as $comment)
                <p class="mb-0 mt-0"><span class="font-weight-bold">{{$comment->user->username}}:</span> {{ $comment->content }}</p>                        
            @endforeach       
        @endif

        <p class="text-muted text-sm"><small>{{\FormatTime::LongTimeFilter($image->created_at)}}</small></p>
        <hr/>
        <form action=" {{Route('new.comment')}} " method="POST">
            @csrf
            <input type="hidden" value="{{$image->id}}" name="image_id"/>
            <input type="text" placeholder="Add a comment..." name="comment" class="form-control p-0 comment-form comments-input"/>
            @if ($errors->has('comment'))
                <span class="alert alert-danger" role="alert"><strong>{{ $errors->first('comment') }}</strong></span>
            @endif
        </form>
    </div>
</div>

@include('includes/modal')