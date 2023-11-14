<!-- HEADER -->
@include('partials._client_header')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">'{{$company_name}}' Suppliers</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Suppliers</li>
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
                                <h3 class="card-title">New Supplier</h3>
                            </div>
                            <!-- /.card-header -->

                            <!-- form start -->
                            <form action="/add-supplier" method="POST">
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
                                        <div class="col-lg-6 col-sm-12">
                                            <div class="form-group">
                                                <label for="company_name">Company Name<span style="color: #ff0000">*</span></label>
                                                <input type="text" class="form-control" id="company_name" name="company_name" placeholder="" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-sm-12">
                                            <div class="form-group">
                                                <label for="company_postal_address">Company Postal Address<span style="color: #ff0000">*</span></label>
                                                <input type="text" class="form-control" id="company_postal_address" name="company_postal_address" placeholder="" required>
                                                <!-- <textarea class="form-control"></textarea> -->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12 col-sm-12">
                                            <div class="form-group">
                                                <label for="company_physical_address">Company Physical Address<span style="color: #ff0000">*</span></label>
                                                <input type="text" class="form-control" id="company_physical_address" name="company_physical_address" placeholder="" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6 col-sm-12">
                                            <div class="form-group">
                                                <label for="company_email">Company Email<span style="color: #ff0000">*</span></label>
                                                <input type="email" class="form-control" id="company_email" name="company_email" placeholder="" required>
                                                <!-- <textarea class="form-control"></textarea> -->
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-sm-12">
                                            <div class="form-group">
                                                <label for="company_phone_no">Company Phone no.<span style="color: #ff0000">*</span></label>
                                                <input type="text" class="form-control" id="company_phone_no" name="company_phone_no" placeholder="" required>
                                                <!-- <textarea class="form-control"></textarea> -->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12 col-sm-12">
                                            <div class="form-group">
                                                <label for="company_contact_person">Company Contact person<span style="color: #ff0000">*</span></label>
                                                <input type="text" class="form-control" id="company_contact_person" name="company_contact_person" placeholder="" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6 col-sm-12">
                                            <div class="form-group">
                                                <label for="company_contact_person_email">Contact person email<span style="color: #ff0000">*</span></label>
                                                <input type="email" class="form-control" id="company_contact_person_email" name="company_contact_person_email" placeholder="" required>
                                                <!-- <textarea class="form-control"></textarea> -->
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-sm-12">
                                            <div class="form-group">
                                                <label for="company_contact_person_phone">Contact person Phone no.<span style="color: #ff0000">*</span></label>
                                                <input type="text" class="form-control" id="company_contact_person_phone" name="company_contact_person_phone" placeholder="" required>
                                                <!-- <textarea class="form-control"></textarea> -->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6 col-sm-12">
                                            <div class="form-group">
                                                <label for="supplier_balance">Supplier Balance<span style="color: #ff0000">*</span></label>
                                                <input type="number" class="form-control" id="supplier_balance" name="supplier_balance" value="0" required>
                                                <!-- <textarea class="form-control"></textarea> -->
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-sm-12">
                                            <div class="form-group">
                                                <label for="supplier_paid_balance">Supplier Paid Balance<span style="color: #ff0000">*</span></label>
                                                <input type="number" class="form-control" id="supplier_paid_balance" name="supplier_paid_balance" value="0" required>
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
                            <h3 class="card-title">Suppliers</h3>
                            <!-- <a href="/new-supplier" class="btn btn-sm btn-primary float-right">Add New Supplier</a> -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="supplier_tbl" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Company Name</th>
                                        <th>Company Email</th>
                                        <th>Status</th>
                                        <th>Time Added</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($suppliers as $sup)
                                        @if ($company_id == $sup->client_id)
                                            <tr>
                                                <td>SUP#{{$sup->id}}</td>
                                                <td>{{$sup->company_name}}</td>
                                                <td>{{$sup->company_email}}</td>
                                                <td>
                                                    <span class="btn btn-success">Active</span>
                                                </td>
                                                <td><span class="direct-chat-timestamp">{{$sup->created_at}}</span></td>
                                                <td>
                                                    <div class="btn-group">
                                                        <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#edit_supplier_{{$sup->id}}_modal"><i class="far fa-edit"></i></a>
                                                        <div class="modal fade" id="edit_supplier_{{$sup->id}}_modal">
                                                            <div class="modal-dialog modal-lg">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                    <h4 class="modal-title">'{{$sup->company_name}}' Supplier Profile</h4>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <!-- form start -->
                                                                        <form action="/update-supplier/{{$sup->id}}" method="POST">
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
                                                                                            <label for="company_name">Company Name<span style="color: #ff0000">*</span></label>
                                                                                            <input type="text" class="form-control" id="company_name" name="company_name" value="{{$sup->company_name}}">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-6">
                                                                                        <div class="form-group">
                                                                                            <label for="company_postal_address">Company Postal Address<span style="color: #ff0000">*</span></label>
                                                                                            <input type="text" class="form-control" id="company_postal_address" name="company_postal_address" value="{{$sup->company_postal_address}}">
                                                                                            <!-- <textarea class="form-control"></textarea> -->
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row">
                                                                                    <div class="col-12">
                                                                                        <div class="form-group">
                                                                                            <label for="company_physical_address">Company Physical Address<span style="color: #ff0000">*</span></label>
                                                                                            <input type="text" class="form-control" id="company_physical_address" name="company_physical_address" value="{{$sup->company_physical_address}}">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row">

                                                                                    <div class="col-6">
                                                                                        <div class="form-group">
                                                                                            <label for="company_email">Company Email<span style="color: #ff0000">*</span></label>
                                                                                            <input type="email" class="form-control" id="company_email" name="company_email" value="{{$sup->company_email}}">
                                                                                            <!-- <textarea class="form-control"></textarea> -->
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-6">
                                                                                        <div class="form-group">
                                                                                            <label for="company_phone_no">Company Phone no.<span style="color: #ff0000">*</span></label>
                                                                                            <input type="text" class="form-control" id="company_phone_no" name="company_phone_no" value="{{$sup->company_phone_no}}">
                                                                                            <!-- <textarea class="form-control"></textarea> -->
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row">
                                                                                    <div class="col-12">
                                                                                        <div class="form-group">
                                                                                            <label for="company_contact_person">Company Contact person<span style="color: #ff0000">*</span></label>
                                                                                            <input type="text" class="form-control" id="company_contact_person" name="company_contact_person" value="{{$sup->company_contact_person}}">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row">

                                                                                    <div class="col-6">
                                                                                        <div class="form-group">
                                                                                            <label for="company_contact_person_email">Contact person email<span style="color: #ff0000">*</span></label>
                                                                                            <input type="email" class="form-control" id="company_contact_person_email" name="company_contact_person_email"  value="{{$sup->company_contact_person_email}}">
                                                                                            <!-- <textarea class="form-control"></textarea> -->
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-6">
                                                                                        <div class="form-group">
                                                                                            <label for="company_contact_person_phone">Contact person Phone no.<span style="color: #ff0000">*</span></label>
                                                                                            <input type="text" class="form-control" id="company_contact_person_phone" name="company_contact_person_phone"  value="{{$sup->company_contact_person_phone}}">
                                                                                            <!-- <textarea class="form-control"></textarea> -->
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="row">
                                                                                    <div class="col-lg-6 col-sm-12">
                                                                                        <div class="form-group">
                                                                                            <label for="supplier_balance">Supplier Balance<span style="color: #ff0000">*</span></label>
                                                                                            <input type="number" class="form-control" id="supplier_balance" name="supplier_balance" value="0" readonly>
                                                                                            <!-- <textarea class="form-control"></textarea> -->
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-lg-6 col-sm-12">
                                                                                        <div class="form-group">
                                                                                            <label for="supplier_paid_balance">Supplier Paid Balance<span style="color: #ff0000">*</span></label>
                                                                                            <input type="number" class="form-control" id="supplier_paid_balance" name="supplier_paid_balance" value="0" readonly>
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
                                                        <a href="/delete-supplier/{{$sup->id}}" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endif
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
