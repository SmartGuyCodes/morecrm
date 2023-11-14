<!-- HEADER -->
@include('partials._client_header')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">'{{$company_name}}' Staff</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Staff</li>
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

            <!-- New supplier row -->
            <div class="row">
                <!-- Left col -->
                <section class="col-lg-6 col-sm-12 connectedSortable">
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">New Staff</h3>
                            </div>
                            <!-- /.card-header -->

                            <!-- form start -->
                            <form action="/add-staff" method="POST">
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
                                    <div class="row">
                                        <div class="col-lg-12 col-sm-12">
                                            <div class="form-group">
                                                <label for="company_name">Name<span style="color: #ff0000">*</span></label>
                                                <input type="text" class="form-control" id="company_name" name="name" placeholder="" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6 col-sm-12">
                                            <div class="form-group">
                                                <label for="company_email">Email<span style="color: #ff0000">*</span></label>
                                                <input type="email" class="form-control" id="company_email" name="email" placeholder="" required>
                                                <!-- <textarea class="form-control"></textarea> -->
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-sm-12">
                                            <div class="form-group">
                                                <label for="company_phone_no">Phone no.<span style="color: #ff0000">*</span></label>
                                                <input type="text" class="form-control" id="company_phone_no" name="phone" placeholder="" required>
                                                <!-- <textarea class="form-control"></textarea> -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary float-right">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </section>
                <!-- /.Left col -->

                <!-- Right col -->
                <section class="col-lg-6 col-sm-12 connectedSortable">
                    <!-- Suppliers Table -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Staff</h3>
                            <!-- <a href="/new-supplier" class="btn btn-sm btn-primary float-right">Add New Supplier</a> -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="supplier_tbl" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Time Added</th>
                                        <th>Send</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($staff as $s)
                                        <tr>
                                            <td>S#{{$s->id}}</td>
                                            <td>{{$s->name}}</td>
                                            <td>{{$s->email}}</td>
                                            <td>{{$s->phone}}</td>
                                            <td><span class="direct-chat-timestamp">{{$s->created_at}}</span></td>
                                            <td>
                                                {{-- <a href="/send-sms/{{ $s->phone }}" class="btn btn-warning"><i class="fas fa-envelope"></i></a> --}}
                                                <!-- Button trigger modal -->
                                                {{-- edit_supplier_{{$s->id}}_modal --}}
                                                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#sms_{{$s->id}}_Modal">
                                                    SMS
                                                </button>
                                                <!-- Modal -->
                                                <div class="modal fade" id="sms_{{$s->id}}_Modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Compose SMS</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <!-- form start -->
                                                            <form action="/send-sms/{{$s->phone}}" method="POST">
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
                                                                    <div class="row">

                                                                        <div class="col-12">
                                                                            <div class="form-group">
                                                                                <label for="company_email">Phone no.<span style="color: #ff0000">*</span></label>
                                                                                <input type="telephone" class="form-control" id="phone" name="phone" value="{{$s->phone}}" readonly>
                                                                                {{-- <textarea class="form-control" id="message" name="message" rows="6"></textarea> --}}
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-12">
                                                                            <div class="form-group">
                                                                                <label for="company_email">SMS Content<span style="color: #ff0000">*</span></label>
                                                                                {{-- <input type="email" class="form-control" id="company_email" name="email" value="{{$s->email}}"> --}}
                                                                                <textarea class="form-control" id="message" name="message" rows="6"></textarea>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- /.card-body -->

                                                                <div class="card-footer">
                                                                    <button type="submit" class="btn btn-block btn-primary float-right">Send</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <div class="modal-footer">
                                                        {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
                                                        {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
                                                        </div>
                                                    </div>
                                                    </div>
                                                </div>
                                                {{-- <a href="/send-email/{{ $s->email }}" class="btn btn-secondary"><i class="fas fa-envelope"></i></a> --}}
                                                
                                                <!-- EMAIL Button trigger modal -->
                                                <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#emailModal">
                                                    EMAIL
                                                </button>
                                                <!-- Modal -->
                                                <div class="modal fade" id="emailModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Compose Email Message</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <!-- form start -->
                                                            <form action="/send-email/{{$s->email}}" method="POST">
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
                                                                    <div class="row">

                                                                        <div class="col-12">
                                                                            <div class="form-group">
                                                                                <label for="company_email">Email Message<span style="color: #ff0000">*</span></label>
                                                                                {{-- <input type="email" class="form-control" id="company_email" name="email" value="{{$s->email}}"> --}}
                                                                                <textarea class="form-control" id="message" name="message" rows="6"></textarea>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- /.card-body -->

                                                                <div class="card-footer">
                                                                    <button type="submit" class="btn btn-block btn-primary float-right">Send</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <div class="modal-footer">
                                                            {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
                                                            {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
                                                        </div>
                                                    </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="btn-group">
                                                    <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#edit_supplier_{{$s->id}}_modal"><i class="far fa-edit"></i></a>
                                                    <div class="modal fade" id="edit_supplier_{{$s->id}}_modal" tabindex="-1">
                                                        <div class="modal-dialog modal-lg">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                <h4 class="modal-title">'{{$s->name}}' Staff Profile</h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <!-- form start -->
                                                                    <form action="/update-staff/{{$s->id}}" method="POST">
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
                                                                            <div class="row">
                                                                                <div class="col-6">
                                                                                    <div class="form-group">
                                                                                        <label for="company_name">Name<span style="color: #ff0000">*</span></label>
                                                                                        <input type="text" class="form-control" id="company_name" name="name" value="{{$s->name}}">
                                                                                    </div>
                                                                                </div>

                                                                                <div class="col-6">
                                                                                    <div class="form-group">
                                                                                        <label for="company_email">Company Email<span style="color: #ff0000">*</span></label>
                                                                                        <input type="email" class="form-control" id="company_email" name="email" value="{{$s->email}}">
                                                                                        <!-- <textarea class="form-control"></textarea> -->
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-6">
                                                                                    <div class="form-group">
                                                                                        <label for="company_phone_no">Phone no.<span style="color: #ff0000">*</span></label>
                                                                                        <input type="text" class="form-control" id="company_phone_no" name="phone" value="{{$s->phone}}">
                                                                                        <!-- <textarea class="form-control"></textarea> -->
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <!-- /.card-body -->

                                                                        <div class="card-footer">
                                                                            <button type="submit" class="btn btn-primary float-right">Submit</button>
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
                                                    <a href="/delete-staff/{{$s->id}}" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer clearfix">
                            <a onclick="history.go(-1)" href="javascript:void(0)" class="btn btn-sm btn-warning float-left">Back</a>
                            <!-- <a href="javascript:void(0)" class="btn btn-sm btn-secondary float-right">View All Suppliers</a> -->
                        </div>
                        <!-- /.card-footer -->
                    </div>
                    <!-- /.card -->
                </section>
                <!-- /.Right col -->
            </div>
            <!-- /.row (New supplier row) -->

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
