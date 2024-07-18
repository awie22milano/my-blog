@extends('back.layout.template')

@section('title','Update Article - Admin')

@section('content')

{{-- content --}}
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 mb-5">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Update Article</h1>
      </div>

      <div class="mt-3">

        @if ($errors->any())
        <div class="mb-3">
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
        
        @endif

        <form action="{{ url('article/'.$article->id) }}" method="post" enctype="multipart/form-data">
            @method('PUT')
            @csrf

            <input type="hidden" name="oldImg" value="{{ $article->img }}">

            <div class="row">
                <div class="col-6">
                    <div class="mb-3">
                        <label for="title">Title</label>
                        <input type="text" name="title" id="title" class="form-control" value="{{ old('title',$article->title) }}">
                    </div>
                </div>
                <div class="col-6">
                    <div class="mb-3">
                        <label for="category_id">Category</label>
                        <select name="category_id" id="category_id" class="form-control">
                            @foreach ($categories as $item)
                                @if ($item->id == $article->category_id)
                                    <option value="{{ $item->id }}" selected>{{ $item->name }}</option>
                                @else
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="mb-3">
                    <label for="desc">Description</label>
                    <textarea name="desc" id="desc" cols="30" rows="10" class="form-control">{{ old('desc',$article->desc) }}</textarea>
                </div>
            </div>

            <div class="row">
                <div class="mb-3">
                    <label for="img">Image (Max. 2MB)</label>
                    <input type="file" name="img" id="img" class="form-control">
                    {{-- Gambar Baru --}}
                    <div class="mt-1">
                        <img src="{{ asset('storage/back/'.$article->img) }}" class="img-thumbnail img-preview" width="100px">
                    </div>

                </div>
            </div>

            <div class="row">
                <div class="col-6">
                    <div class="mb-3">
                        <label for="status">Status</label>
                        <select name="status" id="status" class="form-control">
                            <option value="0" {{ ($article->status == 0) ? 'selected' : null }}>Private</option>
                            <option value="1" {{ ($article->status == 1) ? 'selected' : null }}>Published</option>
                        </select>
                    </div>
                </div>
                <div class="col-6">
                    <div class="mb-3">
                        <label for="publish_date">Publish Date</label>
                        <input type="date" name="publish_date" id="publish_date" class="form-control" value="{{ old('publish_date',$article->publish_date) }}">
                    </div>
                </div>
            </div>

            <div class="float-end">
                <a href="{{ url('article') }}" class="btn btn-secondary">Back</a>
                <button type="submit" class="btn btn-success">Save</button>
            </div>
        </form>
      </div>

    </main>
 
 
@endsection

@push('js')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>

    <script>
        var options = {
            filebrowserImageBrowseUrl: '/laravel-filemanager?type:Images',
            filebrowserImageUploadUrl: '/laravel-filemanager/upload?type:Images&_token=',
            filebrowserBrowseUrl: '/laravel-filemanager?type:Files',
            filebrowserUploadUrl: '/laravel-filemanager/upload?type:Files&_token=',
            clipboardHandleImages: false
        }
    </script>

    <script>
        //ckeditor
        CKEDITOR.replace( 'desc' , options);

        //image preview
        $("#img").change(function() {
            previewImage(this);
        });

        function previewImage(input) {
            if(input.files && input.files[0]){
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('.img-preview').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endpush