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
                    <button class="bg-transparent border-0 reply-comment-btn" type="button" data-toggle="collapse" data-target="#childcomments{{$comment->id}}"
                            aria-expanded="false" aria-controls="collapseExample">
                        Reply
                    </button>
                    •
                    <span>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s.u', $comment->date)->format('M d H:i')}}</span>
                </div>
            </div>
            @each('partials.child_comment', $comment->comments, 'comment')
                <div class="row col-12 mt-3 justify-content-center align-items-center collapse" id="childcomments{{$comment->id}}">
                    <div class="dropdown-divider col-12 col-md-10 mx-auto mb-3 mt-2"></div>
                    <div class="col-12 col-md-10 d-flex flex-row align-items-center">
                        <img src="../assets/user.svg" class="rounded-circle rounded-circle border border-light mr-3"
                            width="30" height="30" />
                        <form class="position-relative w-100" action="#">
                            <textarea class="form-control position-relative w-100 pr-5" rows="1"
                                placeholder="Write a comment..." style="resize: none"></textarea>
                            <div
                                class="position-absolute submit-btn-wrapper d-flex justify-content-center align-items-center mr-1">
                                <button class="submit-btn" type="submit">
                                    <i class="fas fa-angle-double-right submit-comment-btn"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
        </div>
    </div>
</div>