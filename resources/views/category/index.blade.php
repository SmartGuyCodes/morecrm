<!-- HEADER -->
@include('partials._client_header')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-8">
                    <h1 class="m-0">'{{$company_name}}' Categories</h1>
                </div><!-- /.col -->
                <div class="col-sm-4">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Categories</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    @if (Session::has('success'))
                        <div class="alert alert-success text-[#16a34a]" role="alert">
                            {{ Session::get('success') }}
                        </div>
                    @endif
                    @if (Session::has('error'))
                        <div class="alert alert-success text-[#ff0000]" role="alert">
                            {{ Session::get('error') }}
                        </div>
                    @endif
                </div>
            </div>

            <!-- New Category row -->
            <div class="row">
                <!-- Left col -->
                <section class="col-lg-4 col-sm-12 connectedSortable">
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">New Category</h3>
                            </div>
                            <!-- /.card-header -->

                            <!-- form start -->
                            <form action="/add-category" method="POST">
                                @csrf
                                @if ($errors->any())
                                    <div class="alert alert-danger text-[#ff0000]">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="category_name">Category Name<span style="color: #ff0000;">*</span></label>
                                        <input type="text" class="form-control" id="category_name" placeholder="" name="category_name" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="category_description">Category Description</label>
                                        <!-- <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password"> -->
                                        <textarea id="category_description" class="form-control" name="category_description"></textarea>
                                    </div>
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </section>
                <!-- /.Left col -->
                <!-- Right col -->
                <section class="col-lg-8 col-sm-12 connectedSortable">
                    <!-- Categories Table -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Categories</h3>
                            <!-- <a href="/new-category" class="btn btn-sm btn-primary float-right">Add New Category</a> -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="category_tbl" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Time Added</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $cat)
                                    @if ($company_id == $cat->client_id)
                                        <tr>
                                            <td>CAT#{{$cat->id}}</td>
                                            <td>{{$cat->category_name}}</td>
                                            <td>{{$cat->category_description}}</td>
                                            <td><span class="direct-chat-timestamp">{{$cat->created_at}}</span></td>
                                            <td>
                                                <div class="btn-group">
                                                    <!-- <a href="/edit-category" class="btn btn-default">Edit</a> -->

                                                    <!-- <a href="/update-category/{{$cat->id}}" class="btn btn-primary"><i class="far fa-edit"></i></a> -->
                                                    <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#edit_category_{{$cat->id}}_modal"><i class="far fa-edit"></i></a>
                                                    <div class="modal fade" id="edit_category_{{$cat->id}}_modal">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                <h4 class="modal-title">'{{$cat->category_name}}' Profile</h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <!-- form start -->
                                                                    <form action="/update-category/{{$cat->id}}" method="POST">
                                                                        @csrf
                                                                        <div class="card-body">
                                                                            <div class="form-group">
                                                                                <label for="category_name">Category Name<span style="color: #ff0000;">*</span></label>
                                                                                <input type="text" class="form-control" id="category_name" placeholder="" name="category_name" value="{{$cat->category_name}}">
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="category_description">Category Description</label>
                                                                                <!-- <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password"> -->
                                                                                <textarea id="category_description" class="form-control" name="category_description">{{$cat->category_description}}</textarea>
                                                                            </div>
                                                                        </div>
                                                                        <!-- /.card-body -->

                                                                        <div class="card-footer">
                                                                            <button type="submit" class="btn btn-primary ">Submit</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                                <div class="modal-footer justify-content-between">
                                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                                                                </div>
                                                            </div>
                                                            <!-- /.modal-content -->
                                                        </div>
                                                        <!-- /.modal-dialog -->
                                                    </div>
                                                    <!-- /.modal -->
                                                    <!-- <a class="btn btn-danger" onclick="delete_category_fxn()">Delete</a> -->
                                                    <a href="/delete-category/{{$cat->id}}" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                            <!-- <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Time Added</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot> -->
                            </table>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer clearfix">
                            <a onclick="history.go(-1)" href="javascript:void(0)" class="btn btn-sm btn-warning float-left">Back</a>
                        </div>
                        <!-- /.card-footer -->
                    </div>
                    <!-- /.card -->
                </section>
                <!-- /.right col -->
            </div>
            <!-- /.row ( New Category row) -->

            <!-- Main row -->
            <div class="row">
            </div>
            <!-- /.row (main row) -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>

<!-- FOOTER START -->
@include('partials._client_footer')
