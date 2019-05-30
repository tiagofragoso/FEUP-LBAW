<div
    class="pl-1 mt-3 align-items-start d-flex flex-row">
    <img src="../assets/user.svg"
        class="rounded-circle rounded-circle border border-light mr-3"
        width="30" height="30" />
    <div
        class="comment-wrapper d-flex flex-column w-100">
        <div class="comment-text px-3 py-2">
            <span>
                <span class=" author mr-2">{{$comment->user->displayName()}}</span>
                {{$comment->content}}
            </span>
        </div>
        <div class="comment-footer ml-3">
            <span> {{$comment->likes}} </span>
            •
            <a href="#">Like</a>
            •
            <span>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s.u', $comment->date)->format('M d H:i')}}</span>
        </div>
    </div>
</div>