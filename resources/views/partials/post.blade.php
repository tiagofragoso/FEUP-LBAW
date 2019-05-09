<div class="row justify-content-center">
        <div class="card col-12 col-lg-9 mb-4 hover-shadow">
            <div class="row">
                <div class="col-12 col-md-10">
                    <div class="py-3 px-0 px-md-3 w-100">
                        <div class="row">
                            <div class="col-12 d-flex flex-row">
                                <img src="../assets/user.svg"
                                    class="rounded-circle rounded-circle border border-light mr-2"
                                    width="30" height="30" />
                                <div class="d-flex flex-column">
                                    <p class="card-text mb-0">
                                        <a href="{{ url('/users/'.$post->author->id) }}" class="badge badge-secondary">
                                            {{$post->author->username}}
                                        </a>
                                        created a
                                        <strong>post</strong>.
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
                    </div>
                </div>
                <div
                    class="col-12 col-md-2 h-auto h-md-100 d-flex flex-row flex-md-column justify-content-center align-items-center pr-0 pl-0 pl-md-auto">
                    <button type="button"
                        class="btn btn-light w-100 h-100 flex-grow-2">
                        <div
                            class="w-100 h-100 d-flex flex-column align-items-center justify-content-center">
                            <i class="far fa-thumbs-up"></i>
                            <span>{{$post->likes}}</span>
                        </div>
                    </button>
                    <button type="button" data-toggle="collapse"
                        data-target="#comments1" aria-expanded="false"
                        aria-controls="collapseExample"
                        class="side-button btn btn-light w-100 h-100 flex-grow-2">
                        <div
                            class="w-100 h-100 d-flex flex-column align-items-center justify-content-center">
                            <i class="far fa-comment-alt"></i>
                            <span>{{$post->comments}}</span>
                        </div>
                    </button>
                </div>
            </div>
        </div>
    </div>