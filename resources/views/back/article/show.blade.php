@extends('back.layout.template')

@section('title','Detail Articles - Admin')

@section('content')

{{-- content --}}
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Detail Article</h1>
        
      </div>

      <div class="mt-3">


        <table class="table table-striped" id="dataTable">
            <tr>
                <th>Title</th>
                <td>:</td>
                <td>{{ $article->title }}</td>
            </tr>
            <tr>
                <th>Category</th>
                <td>:</td>
                <td>{{ $article->category->name }}</td>
            </tr>
            <tr>
                <th>Description</th>
                <td>:</td>
                <td>{!! $article->desc !!}</td>
            </tr>
            <tr>
                <th>Image</th>
                <td>:</td>
                <td>
                    <a href="{{ asset('storage/back/'.$article->img) }}" target="_blank" rel="noopener noreferrer">
                        <img src="{{ asset('storage/back/'.$article->img) }}" alt="" width="50%">
                    </a>
                </td>
            </tr>
            <tr>
                <th>Views</th>
                <td>:</td>
                <td>{{ $article->views }}x</td>
            </tr>
            <tr>
                <th>Status</th>
                <td>:</td>
                <td>
                    @if ($article->status == 1)
                        <span class="badge bg-success">Published</span>
                    @else
                        <span class="badge bg-danger">Private</span>
                    @endif
                </td>
            </tr>
            <tr>
                <th>Publish Date</th>
                <td>:</td>
                <td>{{ $article->publish_date }}</td>
            </tr>
        </table>
        <div class="float-end">
            <a href="{{ url('article') }}" class="btn btn-secondary">Back</a>
        </div>
      </div>

    </main>
 
 
@endsection

