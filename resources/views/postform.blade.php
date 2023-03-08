@include('layouts.header')
<div class="container px-4">
    <div class="card-header">
        <h4 class="">Add Post</h4>
    </div>
    <div class="rounded card-body  shadow-lg p-4 mb-4 bg-white">
        @if($errors->any())
            <div class="alert alert-danger">
                <span> Post Incomplete</span>
            </div>
        @endif
        <form action="{{$url}}" method="POST" enctype="multipart/form-data" >
            @csrf
            <div class="mb-3">
                <label >Book Name</label>
                <input type="text" name="name" class="form-control" value="{{$post !='' ? $post->name : ''}}">
                @error('name')
                <span style="color: red">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label>Author</label>
                <input type="text" name="author" class="form-control" value="{{$post !='' ? $post->author : ''}}">
                @error('author')
                <span style="color: red">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label >Summary</label>
                <textarea name="summary" rows="5" class="form-control" >{{$post !='' ? $post->summary : ''}}</textarea>
                @error('summary')
                <span style="color: red">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label >Image</label>
                <input type="file" name="image" class="form-control btn-sm">
                @error('image')
                <span style="color: red">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
               <button type="submit" class="btn btn-primary">{{$title}}</button>
            </div>
        </form>
    </div>
</div>

@include('layouts.footer')
