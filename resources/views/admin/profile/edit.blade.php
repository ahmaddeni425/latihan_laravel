@extends('layouts.template')
@section('content.header', 'Profile')
@section('breadcrumb','Home')
@section('breadcrumb-active','Edit')
@section('datatable-style')
<link rel="stylesheet" href="{{asset('template')}}/plugins/summernote/summernote-bs4.min.css">
@endsection

@section('content')
      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Edit Profile</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
          </div>
        </div>
        <div class="card-body">
            <form action="{{route('admin.profile.update')}}" method="POST" enctype='multipart/form-data'>
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Name</label>
                <input value="{{$data->name}}" name="name" type="text" class="form-control border @error('name') border-danger @enderror" id="name" placeholder="name">
            @error('name')
            {{$message}}
            @enderror
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input value="{{$data->email}}" name="email" type="text" class="form-control border @error('email') border-danger @enderror" id="email" placeholder="email">
            @error('email')
            {{$message}}
            @enderror
            </div>
            <div class="form-group">
                <label>Address</label> {!! $data->address !!}
                <textarea id="summernote" name='address' placeholder="isi deskripsi bro">{{$data->address}}</textarea>
                @error('address')
                {{$message}}
                @enderror
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