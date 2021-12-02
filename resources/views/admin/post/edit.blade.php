@extends('layouts.template')
@section('content.header', 'Post')
@section('breadcrumb','Home')
@section('breadcrumb-active','Post')
@section('datatable-style')
<link rel="stylesheet" href="{{asset('template')}}/plugins/summernote/summernote-bs4.min.css">
@endsection

@section('content')
      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">List</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
              <i class="fas fa-times"></i>
            </button>
          </div>
        </div>
        <div class="card-body">
            <form action="{{route('admin.post.update',$data->id)}}" method="POST" enctype='multipart/form-data'>
            @csrf
            @method('put')
            <div class="form-group">
                <label for="title">Title</label>
                <input name="title" type="text" class="form-control border @error('title') border-danger @enderror" id="title" placeholder="Title" value="{{$data->title}}">
            </div>
            @error('title')
            {{$message}}
            @enderror
            <div class="form-group">
            <label>Select Status</label>
                <select class="form-control" name='status'>
                    <option value='waiting' @if($data->status == 'waiting') selected @endif >Waiting</option>
                    <option value='approve' @if($data->status == 'approve') selected @endif>Approve</option>
                    <option value='reject' @if($data->status == 'reject') selected @endif>Reject</option>
                </select>
            </div>
            <div class="form-group">
                <label>Description</label>
                <textarea id="summernote" name='description' placeholder="isi deskripsi bro">
                {{$data->description}}                           
                </textarea>
            </div> 
            @error('description')
            {{$message}}
            @enderror

            @if($data->image)
            <a href="{{asset('storage/post/'.$data->image)}}" target="_blank">lihat gambar</a>
            @endif

            <div class="form-group">
                <label for="image">Title</label>
                <input name="image" type="file" class="form-control" id="image" placeholder="Image">
            </div>
        
            <button type='submit' class='btn btn-md btn-success'>Submit</button>
            </div>
            </form>
        </div>
      <!-- /.card -->
@endsection

@section('datatable-script')
<script src="{{asset('template')}}/plugins/summernote/summernote-bs4.min.js"></script>

<script>
  $(function () {
    // Summernote
    $('#summernote').summernote()
    });
</script>
@endsection