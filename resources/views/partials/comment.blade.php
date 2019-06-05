<div class="row col-12 comment align-items-start justify-content-center">
    <div class="col-12 col-md-10 d-flex flex-row">
        <a href="{{ url('/users/'.$comment->user->id)}}">
            <img src="../assets/user.svg" class="rounded-circle rounded-circle border border-light mr-3" width="30" height="30" />
        </a>
        <div class="w-100 d-flex flex-column">
            <div class="comment-wrapper d-flex flex-column w-100" data-id="{{$comment->id}}">
                <div class="comment-text px-3 py-2">
                    <span>
                        <a class="title-link mr-2" href="{{ url('/users/'.$comment->user->id)}}">
                            <span class=" author">{{$comment->user->displayName()}}</span>
                        </a>
                        {{$comment->content}}
                    </span>
                </div>
                <div class="comment-footer ml-3">
                    <span class="numberLikes"> {{$comment->likes}} </span>
                    <span> likes </span>
                    •
                    <button class="bg-transparent border-0 like-comment-btn">
                        @if(!$comment['hasLike']) Like
                        @else Liked
                        @endif
                    </button>
                    •
                    <span>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s.u', $comment->date)->format('M d H:i')}}</span>
                </div>
            </div>
            @each('partials.child_comment', $comment->comments, 'comment')
        </div>
    </div>
</div>