@extends('admin.admin_master')
@push('style')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css">
@endpush
@section('admin')
    <div class="main_content_iner overly_inner ">
        <div class="container-fluid p-0 ">
            <!-- page title  -->
            <div class="row">
                <div class="col-12">
                    <div class="page_title_box d-flex align-items-center justify-content-between">
                        <div class="page_title_left">
                            <h3 class="f_s_30 f_w_700 text_white">Edit Blog</h3>
                            <ol class="breadcrumb page_bradcam mb-0">
                                <li class="breadcrumb-item"><a href="javascript:void(0);">Sleek Admin </a></li>
                                <li class="breadcrumb-item active">Edit Blog</li>
                            </ol>
                        </div>
                        <a href="{{route('blog-category.index')}}" class="white_btn3">List Blog</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="py-12">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">Edit blog</div>
                            <div class="card-body">
                                <form action="{{route('blog-category.update',$category->id)}}" method="post">
                                    @csrf
                                    @method('put')
                                    <div class="form-group">
                                        <label for="exampleInputEmail1" class="form-label">Blog Category Name</label>
                                        <input type="text" name="name" class="form-control" value="{{$category->name}}">
                                    </div>

                                    <button type="submit" class="btn btn-primary">Add Blog Category</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        } );
    </script>
@endpush
