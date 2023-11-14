<!-- HEADER -->
@include('partials._client_header')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">'{{$company_name}}' Receivings</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Receivings</li>
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

            <!-- Main row -->
            <div class="row">
                <!-- Left col -->
                <section class="col-lg-12 connectedSortable">
                    <!-- Suppliers Table -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Receivings</h3>
                            <a href="/receive/{{$grn}}" class="btn btn-sm btn-primary float-right"><i class="fas fa-plus"></i> Receive</a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="receivings_tbl" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>GRN No.</th>
                                        <th>Supplier</th>
                                        <th>Receipt no.</th>
                                        <th>Department</th>
                                        <th>Time Received</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($receiving_listing as $receiving)
                                        <tr>
                                            <td>{{$receiving->receiving_grn}}</td>
                                            <td>{{$receiving->supplier_name}}</td>
                                            <td>{{$receiving->receiving_voucher_no}}</td>
                                            <td>{{$receiving->receiving_department}}</td>
                                            <td><span class="direct-chat-timestamp">{{$receiving->receiving_date_time}}</span></td>
                                            <td>
                                                <div class="btn-group">
                                                    {{-- <a href="/edit-receiving/{{$receiving->id}}" class="btn btn-warning"><i class="fas fa-edit"></i></a> --}}

                                                    <a href="#" class="btn btn-success" data-toggle="modal" data-target="#pay_now_{{$receiving->uuid}}_modal">Pay</a>
                                                    <div class="modal fade" id="pay_now_{{$receiving->uuid}}_modal">
                                                        <div class="modal-dialog modal-lg">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                <h4 class="modal-title"> Pay {{$receiving->supplier_name}}</h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <!-- form start -->
                                                                    <form action="/pay-receiving/{{$receiving->receiving_voucher_no}}" method="POST">
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
                                                                                <div class="col-lg-3">
                                                                                    <div class="form-group">
                                                                                        <label for="item_name">Invoice ID</label>
                                                                                        <input type="text" class="form-control" id="item_name" placeholder="" name="item_name" value="38734874" readonly>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-3">
                                                                                    <div class="form-group">
                                                                                        <label for="exampleInputEmail1">Total</label>
                                                                                        <input type="number" class="form-control" id="exampleInputEmail1" value="0" readonly>
                                                                                        {{-- <select class="form-control" name="item_type" required>
                                                                                            <option value="product">Product</option>
                                                                                            <option value="service">Service</option>
                                                                                        </select> --}}
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-3">
                                                                                    <div class="form-group">
                                                                                        <label for="item_category_id">Amount paid<span style="#ff0000">*</span></label>
                                                                                        <input type="number" class="form-control" id="exampleInputEmail1" value="0">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-3">
                                                                                    <div class="form-group">
                                                                                        <label for="item_location">Payment Mode</label>
                                                                                        <!-- <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email"> -->
                                                                                        <select id="item_location" name="item_location" class="form-control" required>
                                                                                            <option value="store">CASH</option>
                                                                                            <option value="counter">MPESA</option>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="item_description">Remarks</label>
                                                                                <!-- <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password"> -->
                                                                                <textarea class="form-control" id="item_description" name="item_description"> </textarea>
                                                                            </div>
                                                                        </div>
                                                                        <!-- /.card-body -->

                                                                        <div class="card-footer">
                                                                        <button type="submit" class="btn btn-primary float-right">PAY</button>
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

                                                    <a href="/receiving-profile/{{$receiving->uuid}}" class="btn btn-primary"><i class="fas fa-eye"></i></a>
                                                    {{-- <a href="/delete-receiving/{{$receiving->id}}" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a> --}}
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
                <!-- /.Left col -->
            </div>
            <!-- /.row (main row) -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>

<!-- FOOTER START -->
@include('partials._client_footer')
