<a href="{{"/storage/".$post->file->file}}" download="{{$post->file->fileName}}" class="card-text mt-3 title-link">
    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1"><i class="far fa-file-alt"></i></span>
        </div>
        <div class="form-control">
            <strong> 
                {{$post->file->fileName}} 
            </strong>
        </div>
    </div>
</a>