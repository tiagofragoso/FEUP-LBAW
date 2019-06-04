<p class="card-text mt-3">
    <strong>
    {{ $post->poll->title }}
    </strong>
</p>
<div class="container" data-id="{{$post->id}}">
    @foreach ($post->poll->pollOptions as $option)
    <div class="row align-items-center mb-2" data-id= "{{$option->id}}">
        <div class="input-group col-12 col-sm-8">
            <div class="input-group-prepend">
                <div class="input-group-text">
                    <input type="radio"  name="poll"
                        aria-label="" {{$post->selected_option == $option->id ? 'checked' : 'false'}}>
                </div>
            </div>
            <span type="text" class="form-control">
                {{$option->name}}
            </span>
        </div>
        <div
            class="col-12 col-sm-4 ml-5 ml-sm-0 mt-1 mt-sm-0 text-muted" id ="pollVotes" data-id = "{{$option->votes}}">
            {{$option->votes}} votes
        </div>
    </div> 
    @endforeach
</div>