<!-- HEADER -->
@include('partials._client_header')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-8">
                <h1 class="m-0">'{{$company_name}}' Requisitions</h1>
            </div><!-- /.col -->
            <div class="col-sm-4">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Requisitions</li>
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
                <section class="col-lg-12 col-sm-12 connectedSortable">
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">New Requisition</h3>
                            </div>
                            <!-- /.card-header -->

                            @if (count($items_listing) > 0)
                                <!-- form start -->
                                <form action="/add-requisition" method="POST" >
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12">
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
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-4 col-sm-12">
                                                <div class="form-group">
                                                    <label for="requisition_title">Request Title<span style="color: #ff0000;">*</span></label>
                                                    <input type="text" class="form-control" id="requisition_title" name="requisition_title" placeholder="" required>
                                                    <input type="hidden" name="requisition_lpo_number" value="{{$requisition_lpo_number}}" class="form-control" id="" />
                                                    <!-- <textarea class="form-control"></textarea> -->
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-sm-12">
                                                <div class="form-group">
                                                    <label for="requisition_item_name">Item<span style="color: #ff0000;">*</span></label>
                                                    <select id="requisition_item_name" class="form-control" name="requisition_item_name" required>
                                                        @foreach ($items_listing as $i)
                                                            <option value="{{$i->item_name}}">{{$i->item_name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-sm-12">
                                                <div class="form-group">
                                                    <label for="requisition_item_stock_level">Item Stock Level<span style="color: #ff0000;">*</span></label>
                                                    <input type="number" class="form-control" id="requisition_item_stock_level" name="requisition_item_stock_level" placeholder="" required>
                                                    <!-- <textarea class="form-control"></textarea> -->
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6 col-sm-12">
                                                <div class="form-group">
                                                    <label for="requisition_urgency">Request urgency<span style="color: #ff0000;">*</span></label>
                                                    <select class="form-control" name="requisition_urgency" id="requisition_urgency" required>
                                                        <option value="high">High</option>
                                                        <option value="medium">Medium</option>
                                                        <option value="low">Low</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-sm-12">
                                                <div class="form-group">
                                                    <label for="requisition_quantity">Quantity<span style="color: #ff0000;">*</span></label>
                                                    <input id="requisition_quantity" type="number" class="form-control" id="requisition_quantity" name="requisition_quantity" placeholder="" required>
                                                    <!-- <textarea class="form-control"></textarea> -->
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6 col-sm-12">
                                                <div class="form-group">
                                                    <label for="requisition_date">Date<span style="color: #ff0000;">*</span></label>
                                                    <!-- <input type="text" class="form-control" id="exampleInputEmail1" placeholder=""> -->
                                                    <div class="input-group date" id="requisition_date" data-target-input="nearest">
                                                        <input type="text" name="requisition_date" class="form-control datetimepicker-input" data-target="#requisition_date" required>
                                                        <div class="input-group-append" data-target="#requisition_date" data-toggle="datetimepicker">
                                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-sm-12">
                                                <div class="form-group">
                                                    <label for="requisition_department">Department<span style="color: #ff0000;">*</span></label>
                                                    {{-- <input id="requisition_department" type="text" class="form-control" id="requisition_department" placeholder=""> --}}
                                                    <select id="requisition_department" name="requisition_department" class="form-control" required>
                                                        <option value="store">Store</option>
                                                        <option value="kitchen">Kitchen</option>
                                                        <option value="restaurant">Restaurant</option>
                                                    </select>
                                                    <!-- <textarea class="form-control"></textarea> -->
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-12 col-sm-12">
                                                <div class="form-group">
                                                    <label for="requisition_notes">Request Notes</label>
                                                    <textarea class="form-control" name="requisition_notes"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    <!-- /.card-body -->

                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary float-right">Submit</button>
                                    </div>
                                </form>
                            @else
                                <p style="text-align: center; padding: 3%;" class="card-title">Update your <a href="/item">items</a> listing</p>
                            @endif
                        </div>
                    </div>
                </section>
                <!-- /.Left col -->
            </div>
            <!-- /.row (New supplier row) -->

            <!-- Main row -->
            <div class="row">
                <!-- Right col -->
                <section class="col-lg-12 col-sm-12 connectedSortable">
                    <!-- Suppliers Table -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Requisitions</h3>
                            <!-- <a href="/new-supplier" class="btn btn-sm btn-primary float-right">Add New Supplier</a> -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="supplier_tbl" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        {{-- <th>#</th> --}}
                                        <th>LPO No.</th>
                                        <th>Request Title</th>
                                        <th>Item</th>
                                        <th>Requested quantity</th>
                                        <th>Item stock level</th>
                                        <th>Request urgency</th>
                                        <th>Department</th>
                                        <th>Status</th>
                                        <th>Time Requested</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($requisitions_listing as $r)
                                        <tr>
                                            {{-- <td><input type="checkbox"/></td> --}}
                                            <td>{{$r->requisition_lpo_number}}</td>
                                            <td>{{$r->requisition_title}}</td>
                                            <td>{{$r->requisition_item_name}}</td>
                                            <td>{{$r->requisition_quantity}}</td>
                                            <td>{{$r->requisition_item_stock_level}}</td>
                                            <td>{{$r->requisition_urgency}}</td>
                                            <td>{{$r->requisition_department}}</td>
                                            <td>{{$r->requisition_status}}</td>
                                            <td><span class="direct-chat-timestamp">{{$r->created_at}}</span></td>
                                            <td>
                                                <div class="btn-group">
                                                    {{-- <a href="#" class="btn btn-primary"><i class="fas fa-edit"></i></a> --}}
                                                    {{-- <a href="/supplier-profile" class="btn btn-primary">View</a> --}}
                                                    <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#edit_requisition_{{$r->id}}_modal"><i class="far fa-edit"></i></a>
                                                    <div class="modal fade" id="edit_requisition_{{$r->id}}_modal">
                                                        <div class="modal-dialog modal-lg">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                <h4 class="modal-title">Edit Requisition No.: <strong>{{$r->requisition_lpo_number}}</strong></h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <!-- form start -->
                                                                    <form action="/update-requisition/{{$r->id}}" method="POST">
                                                                        @csrf
                                                                        <div class="card-body">
                                                                            <div class="row">
                                                                                <div class="col-lg-6 col-sm-12">
                                                                                    <div class="form-group">
                                                                                        <label for="requisition_title">Request Title<span style="color: #ff0000;">*</span></label>
                                                                                        <input type="text" class="form-control" id="requisition_title" name="requisition_title"  value="{{$r->requisition_title}}" placeholder="" required>
                                                                                        <input type="hidden" name="requisition_lpo_number" value="{{$r->requisition_lpo_number}}" class="form-control" id="" value="{{$r->requisition_lpo_number}}"/>
                                                                                        <!-- <textarea class="form-control"></textarea> -->
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-6 col-sm-12">
                                                                                    <div class="form-group">
                                                                                        <label for="requisition_item_name">Item<span style="color: #ff0000;">*</span></label>
                                                                                        <select id="requisition_item_name" class="form-control" name="requisition_item_name" required>
                                                                                            <option value="{{$r->requisition_item_name}}">{{$r->requisition_item_name}}</option>
                                                                                            @foreach ($items_listing as $i)
                                                                                                <option value="{{$i->item_name}}">{{$i->item_name}}</option>
                                                                                            @endforeach
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-lg-6 col-sm-12">
                                                                                    <div class="form-group">
                                                                                        <label for="requisition_item_stock_level">Item Stock Level<span style="color: #ff0000;">*</span></label>
                                                                                        <input type="number" class="form-control" id="requisition_item_stock_level" name="requisition_item_stock_level" placeholder=""  value="{{$r->requisition_item_stock_level}}" required>
                                                                                        <!-- <textarea class="form-control"></textarea> -->
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-6 col-sm-12">
                                                                                    <div class="form-group">
                                                                                        <label for="requisition_urgency">Request urgency<span style="color: #ff0000;">*</span></label>
                                                                                        <select class="form-control" name="requisition_urgency" id="requisition_urgency" required>
                                                                                            <option value="{{$r->requisition_urgency}}">{{$r->requisition_urgency}}</option>
                                                                                            <option value="high">High</option>
                                                                                            <option value="medium">Medium</option>
                                                                                            <option value="low">Low</option>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-lg-6 col-sm-12">
                                                                                    <div class="form-group">
                                                                                        <label for="requisition_date">Date<span style="color: #ff0000;">*</span></label>
                                                                                        <!-- <input type="text" class="form-control" id="exampleInputEmail1" placeholder=""> -->
                                                                                        <div class="input-group date" id="requisition_date" data-target-input="nearest">
                                                                                            <input type="text" name="requisition_date" class="form-control datetimepicker-input" data-target="#requisition_date" value="{{$r->requisition_date}}" required>
                                                                                            <div class="input-group-append" data-target="#requisition_date" data-toggle="datetimepicker">
                                                                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-6 col-sm-12">
                                                                                    <div class="form-group">
                                                                                        <label for="requisition_department">Department<span style="color: #ff0000;">*</span></label>
                                                                                        {{-- <input id="requisition_department" type="text" class="form-control" id="requisition_department" placeholder=""> --}}
                                                                                        <select id="requisition_department" name="requisition_department" class="form-control" required>
                                                                                            <option value="{{$r->requisition_department}}">{{$r->requisition_department}}</option>
                                                                                            <option value="store">Store</option>
                                                                                            <option value="kitchen">Kitchen</option>
                                                                                            <option value="restaurant">Restaurant</option>
                                                                                        </select>
                                                                                        <!-- <textarea class="form-control"></textarea> -->
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-lg-6 col-sm-12">
                                                                                    <div class="form-group">
                                                                                        <label for="requisition_quantity">Quantity<span style="color: #ff0000;">*</span></label>
                                                                                        <input value="{{$r->requisition_quantity}}" id="requisition_quantity" type="number" class="form-control" id="requisition_quantity" name="requisition_quantity" placeholder="" required>
                                                                                        <!-- <textarea class="form-control"></textarea> -->
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-6 col-sm-12">
                                                                                    <div class="form-group">
                                                                                        <label for="requisition_urgency">Request Status<span style="color: #ff0000;">*</span></label>
                                                                                        <select class="form-control" name="requisition_status" id="requisition_status" required>
                                                                                            {{-- 'pending', 'approved', 'rejected' --}}
                                                                                            <option value="{{$r->requisition_status}}">{{$r->requisition_status}}</option>
                                                                                            <option value="pending">Pending</option>
                                                                                            <option value="approved">Approved</option>
                                                                                            <option value="rejected">Rejected</option>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="row">
                                                                                <div class="col-lg-12 col-sm-12">
                                                                                    <div class="form-group">
                                                                                        <label for="requisition_notes">Request Notes</label>
                                                                                        <textarea id="requisition_notes" class="form-control" name="requisition_notes">{{$r->requisition_notes}}</textarea>
                                                                                    </div>
                                                                                </div>
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
                                                    <a href="/delete-requisition/{{$r->id}}" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>
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
            <!-- /.row (main row) -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>

<!-- FOOTER START -->
@include('partials._client_footer')
