@extends('layouts.template')
@section('content.header', 'Post')
@section('breadcrumb','Home')
@section('breadcrumb-active','Post')
@section('datatable-style')
  <link rel="stylesheet" href="{{asset('template')}}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="{{asset('template')}}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="{{asset('template')}}/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
@endsection


@section('content')

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">List</h3>

          <div class="card-tools">
            <a href="{{route('user.post.create')}}" class="btn btn-sm btn-success">create</a>
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
              <i class="fas fa-times"></i>
            </button>
          </div>
        </div>



        <div class="card-body"> 
        <!-- filter -->
        <form action="{{route('user.post.index')}}" method="get">
            <div class="row mb-2">
            <div class="col-lg-3">
                <select name="status" id="status" class="form-control">
                <option value="">=== pilih status ===</option>
                <option value="waiting" @if(request()->status == 'waiting') selected @endif>Waiting</option>
                <option value="reject" @if(request()->status == 'reject') selected @endif>Reject</option>
                <option value="approve" @if(request()->status == 'approve') selected @endif>Approve</option>
                </select>
            </div>

            <div class="col-lg-6">
                <button type="submit" class="btn btn-md btn-info">Search</button>
            </div>
            </div>
        </form>

                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Title</th>
                    <th>Image</th>
                    <th>Status</th>
                    <th>Publish At</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($posts as $post)
                  <tr>
                    <td>{{$post->title}}</td>
                    <td>
                        <a href="{{asset('storage/post/'.$post->image)}}" target="_blank">
                            <img src="{{asset('storage/post/'.$post->image)}}" 
                            width="150" height="150" alt="{{$post->image}}">
                        </a>
                    </td>
                    <td>{{$post->status}}</td>
                    <td>{{$post->updated_at->format('Y-m-d')}}</td>
                    <td><a href="{{route('admin.post.edit',$post->id)}}">Edit</a> || 
                      <form action="{{route('admin.post.destroy', $post->id)}}" method="post">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-sm btn-danger">delete</button>
                    </form>  
                  
                  </td>
                  </tr>
                  @endforeach
                  </tfoot>
                </table>
              </div>
        <!-- /.card-body -->
        <div class="card-footer">
          Footer
        </div>
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->
@endsection

@section('datatable-script')
<script src="{{asset('template')}}/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{asset('template')}}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="{{asset('template')}}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{asset('template')}}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="{{asset('template')}}/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="{{asset('template')}}/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="{{asset('template')}}/plugins/jszip/jszip.min.js"></script>
<script src="{{asset('template')}}/plugins/pdfmake/pdfmake.min.js"></script>
<script src="{{asset('template')}}/plugins/pdfmake/vfs_fonts.js"></script>
<script src="{{asset('template')}}/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="{{asset('template')}}/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="{{asset('template')}}/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
  });
</script>
@endsection