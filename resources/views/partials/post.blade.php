<div class="post-wrapper" data-id="{{$post->id}}">
<div class="row justify-content-center">
    <div class="card col-12 col-lg-9 mb-4 hover-shadow">
        <div class="row">
            <div class="col-12 col-md-10">
                <div class="py-3 px-0 px-md-3 w-100">
                    <div class="row">
                        <div class="col-12 d-flex flex-row">
                            <img src="../assets/user.svg" class="rounded-circle rounded-circle border border-light mr-2"
                                width="30" height="30" />
                            <div class="d-flex flex-column">
                                <p class="card-text mb-0">
                                    <a href="{{ url('/users/'.$post->author->id) }}" class="badge badge-secondary">
                                        {{$post->author->displayName()}}
                                    </a>
                                    @if ($post->type == 'Poll')
                                    created a
                                    <strong>poll</strong>.
                                    @elseif ($post->type == 'File')
                                    uploaded a
                                    <strong>file</strong>.
                                    @else
                                    created a
                                    <strong>post</strong>.
                                    @endif
                                </p>
                                <span class="post-date text-muted">
                                    {{  \Carbon\Carbon::createFromFormat('Y-m-d H:i:s.u', $post->date)->format('M d | H:i')}}
                                </span>
                            </div>
                        </div>
                    </div>
                    <p class="card-text mt-3">
                        {{$post->content}}
                    </p>
                    @if ($post->type == 'Poll')
                    @include('partials.poll', $post->poll)
                    @else
                    @if ($post->type == 'File')
                    @include('partials.file', $post->file)
                    @endif
                    @endif
                </div>
            </div>
            <div
                class="col-12 col-md-2 h-auto h-md-100 d-flex flex-row flex-md-column justify-content-center align-items-center pr-0 pl-0 pl-md-auto">
                <button type="button" class="btn btn-light w-100 h-100 flex-grow-2 like-post-btn" data-id="{{$post->id}}">
                <div class="w-100 h-100 d-flex flex-column align-items-center justify-content-center">
                        <i class=" {{$post['hasLike']== true ? 'fas': 'far'}} fa-thumbs-up"></i>
                        <span>{{$post->likes}}</span>
                    </div>
                </button>
                <button type="button" data-toggle="collapse" data-target="#comments{{$post->id}}" aria-expanded="false"
                    aria-controls="collapseExample" class="side-button btn btn-light w-100 h-100 flex-grow-2">
                    <div class="w-100 h-100 d-flex flex-column align-items-center justify-content-center">
                        <i class="far fa-comment-alt"></i>
                        <span>{{$post->comments}}</span>
                    </div>
                </button>
            </div>
        </div>
        <div class="row comment-section collapse mb-3 border-top border-light" id="comments{{$post->id}}">
            <div class="row col-12 mt-3 justify-content-center align-items-center">
                <div class="col-12 col-md-10 d-flex flex-row align-items-center">
                    <img src="../assets/user.svg" class="rounded-circle rounded-circle border border-light mr-3"
                        width="30" height="30" />
                    <form class="position-relative w-100" action="#">
                        <textarea class="form-control position-relative w-100 pr-5"å
                            rows="1" placeholder="Write a comment..." style="resize: none"></textarea>
                        <div
                            class="position-absolute submit-btn-wrapper d-flex justify-content-center align-items-center mr-1">
                            <button class="submit-btn" type="submit">
                                <i class="far fa-angle-double-right"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="dropdown-divider col-12 col-md-10 mx-auto my-3"></div>
            @each('partials.comment', $post->commentsContent, 'comment')
        </div>
    </div>
</div>
</div>