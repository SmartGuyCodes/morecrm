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

            <!-- New Receiving row -->
            <div class="row">
                <div class="col-lg-8 col-sm-12">
                    <div class="card" >
                    <!-- /.box-header -->
                        <div class="card-body">
                            <br /> <br/>

                            <form action="/add-receiving-item"  method="POST">
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

                                <div class="row">

                                    <div class="col-4 col-sm-4 col-xs-12">
                                        <div class="form-group">
                                            <input type="hidden" name="receiving_grn" value="{{$uuid}}"/>
                                            <strong>Item:</strong>
                                            <select name="item_id" class="form-control" required>
                                                @foreach ($items as $i)
                                                    <option value="{{$i->id}}">{{$i->item_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>


                                    <div class="col-4 col-sm-4 col-xs-12">
                                        <div class="form-group">
                                            <strong>Qty:</strong>
                                            <input class="form-control" type="number" name="item_qty" value="1" min="1" placeholder="Qty" autocomplete="off" style="" required/>
                                        </div>
                                    </div>

                                    <div class="col-4 pull-right">
                                        <div class="form-group">
                                            {{-- <input type="hidden" name="createdAt" value="" /> --}}
                                            <button type="submit" class="btn btn-success form-control pull-right" >
                                                <i class="fa fa-plus"></i> Add Item
                                            </button>
                                        </div>
                                    </div>

                                    {{-- <div class="col-4 col-sm-4 col-xs-12">
                                        <div class="form-group">
                                            <strong>Discount:</strong>
                                            <input class="form-control" type="number" name="item_discount" value="0" autocomplete="off" style="" />
                                        </div>
                                    </div> --}}
                                </div>
                                <br/>

                                <div class="row">
                                </div>
                            </form>
                            <br>

                            <hr>

                            <div class="row">
                                <div class="col-12">
                                    <!-- Receivings items Table -->
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title">Receivings items</h3>
                                            <!-- <a href="/new-supplier" class="btn btn-sm btn-primary float-right">Add New Supplier</a> -->
                                        </div>
                                        <!-- /.card-header -->
                                        <div class="card-body">
                                            <table class="table table-bordered table-striped" id="receiving_items_tbl" style="width: 100%;">
                                                <thead>
                                                    <tr>
                                                    <th> Product Name </th>
                                                    <th> Price </th>
                                                    <th> Qty </th>
                                                    <th> Amount (KSh.) </th>
                                                    {{-- <th> Discount (KSh.) </th> --}}
                                                    <!-- <th> Profit (KSh.) </th> -->
                                                    <th> Action </th>
                                                    </tr>
                                                </thead>
                                                <!-- Get and fill invoice data here -->
                                                <tbody>
                                                    <!-- Loop throudh the invoice details here -->
                                                    <span style="display: none">
                                                        {{ $total_amount = 0 }}
                                                        {{ $totalAmount = 0 }}
                                                        {{ $receiving_products_qty = 0}}
                                                    </span>
                                                    @foreach ($received_items as $ri)
                                                        <tr>
                                                            <td> {{$ri->item_name}} </td>
                                                            <td> @money($ri->item_price)  </td>
                                                            <td> {{$ri->item_qty}}  </td>
                                                            <td> @money($total_amount = $ri->item_price *$ri->item_qty ) </td>
                                                            {{-- <td> total_discount </td> --}}
                                                            <td>
                                                                <a href="/delete_receiving_item/{{$ri->id}}">
                                                                    <button class="btn btn-mini btn-danger">
                                                                        {{-- <i class="fas fa-remove"></i> --}}
                                                                        <i class="fas fa-trash-alt"></i>
                                                                    </button>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                        <span style="display:none;">
                                                            {{ $totalAmount =  $totalAmount + $total_amount}}
                                                            {{ $receiving_products_qty = $receiving_products_qty + $ri->item_qty}}
                                                        </span>
                                                    @endforeach
                                                    <!-- ./End Loop -->
                                                    
                                                    <tr>
                                                        <th> </th>
                                                        <th>  </th>
                                                        <th>  </th>
                                                        <th> Total Amount (KSh.): </th>
                                                        {{-- <th> Total Discount (KSh.): </th> --}}
                                                        <!-- <th> Total Profit (KSh.): </th> -->
                                                        <th>  </th>
                                                        </tr>

                                                        <tr>
                                                        <th colspan="3">
                                                            <strong style="font-size: 12px; color: #222222;">Total:</strong>
                                                        </th>
                                                        <td colspan="1"><strong style="font-size: 12px; color: #222222;">
                                                            <!-- Get total sum of amount from the invoice items -->
                                                            @money($totalAmount)
                                                        </td>
                                                        {{-- <td colspan="1"><strong style="font-size: 12px; color: #222222;">
                                                            totalDiscount
                                                        </td> --}}
                                                        <!-- <td colspan="1"><strong style="font-size: 12px; color: #222222;"> -->
                                                            <!-- Get total sum of profits from the items in the invoice -->
                                                        <!-- </td> -->
                                                        {{-- <th></th> --}}
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->

                        <div class="card-footer">
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
                <!-- col-md-8 -->

                <!-- col-md-4 -->
                <div class="col-lg-4 col-sm-12">
                    <form action="/update-receiving/{{$uuid}}"  method="POST">
                        @csrf
                        <div class="card" >
                        <!-- /.box-header -->
                            <div class="card-body">
                                <div class="row">  

                                    <div class="col-sm-12 pull pull-left">
                                        <div class="form-group">
                                            <strong>Supplier Name<span style="color: #ff0000;">*</span></strong> 
                                            {{-- <input type="hidden" name="receiving_grn" value="{{$grn_form}}"/> --}}
                                            <select class="form-control" name="receiving_supplier_id" autocomplete="off" required>
                                                @foreach ($supplier_listing as $s)
                                                    <option value="{{$s->id}}">{{$s->company_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-12 pull pull-left">
                                        <div class="form-group">
                                            <strong>Receiving Date<span style="color: #ff0000;">*</span></strong>
                                            {{-- <input type="text" id="receiving_date_time" class="form-control" name="receiving_date_time " value="" autocomplete="off"> --}}
                                            <div class="input-group date" id="receiving_date_time" data-target-input="nearest">
                                                <input type="text" class="form-control datetimepicker-input" name="receiving_date_time" value="{{$receiving->receiving_date_time}}" data-target="#receiving_date_time" required>
                                                <div class="input-group-append" data-target="#receiving_date_time" data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-12 pull pull-left">
                                        <div class="form-group">
                                            <strong>Department<span style="color: #ff0000;">*</span></strong>
                                            <!-- <input type="text" id="receiving_mode" class="form-control" name="receiving_mode " value="" autocomplete="off"> -->
                                            <select class="form-control" name="receiving_department" required>
                                                <option value="{{$receiving->receiving_department}}">{{$receiving->receiving_department}}</option>
                                                <option value="store">Store</option>
                                                <option value="kitchen">Kitchen</option>
                                                <option value="restaurant">Restaurant</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-12 pull pull-left">
                                        <div class="form-group">
                                            <strong>Receiving Mode<span style="color: #ff0000;">*</span></strong>
                                            <!-- <input type="text" id="receiving_mode" class="form-control" name="receiving_mode " value="" autocomplete="off"> -->
                                            <select class="form-control" name="receiving_mode" required>
                                                <option value="{{$receiving->receiving_mode}}">{{$receiving->receiving_mode}}</option>
                                                <option value="receive">Receive</option>
                                                <option value="return">Return</option>
                                                {{-- <option value="requisition">Requisition</option> --}}
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12 col-xs-12 pull pull-left">
                                    <div class="form-group">
                                        <strong>Receiving Note</strong>
                                        <textarea  class="form-control" name="receiving_notes" autocomplete="off">{{$receiving->receiving_notes}}</textarea>
                                    </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12 col-xs-12 pull pull-left">
                                        <div class="form-group">
                                            <strong>Payment Method<span style="color: #ff0000;">*</span></strong> 
                                            <select class="form-control" name="payment_method" autocomplete="off" required>
                                                <option value="{{$receiving->payment_method}}">{{$receiving->payment_method}}</option>
                                                <option value="CASH">CASH</option>
                                                <option value="MPESA">MPESA</option>
                                                <option value="BANK">BANK</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-xs-12 pull pull-left">
                                        <div class="form-group">
                                            <strong>Total Amount Paid<span style="color: #ff0000;">*</span></strong>
                                            <input type="number" class="form-control" name="total_paid_amount " value="{{$receiving->total_paid_amount}}" autocomplete="off" required>
                                            <input type="hidden" value="{{$totalAmount}}" name="total_product_amount"/>
                                            <input type="hidden" value="{{$receiving_products_qty}}" name="receiving_products_qty"/>
                                        </div>
                                    </div>
                                    <div class="col-12 col-xs-12 pull pull-left">
                                        <div class="form-group">
                                            <strong>Total Balance Due:</strong>
                                            <input type="number" class="form-control" name="balance_due " value="{{$totalAmount - $receiving->total_paid_amount}}" autocomplete="off" readonly>
                                        </div>
                                    </div>
                                    <div class="col-12 col-xs-12 pull pull-left">
                                        <div class="form-group">
                                            <strong>Transaction Reference No.</strong>
                                            <input type="text" class="form-control" name="txn_ref " value="{{$receiving->txn_ref}}" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-12 col-xs-12 pull pull-left">
                                        <div class="form-group">
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-success"><i class="fa fa-plus"></i> Update Receiving</button>
                                <a href="/delete-receiving/{{$uuid}}" class="btn btn-danger"><i class="fas fa-trash-alt"></i> Delete</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.row (New supplier row) -->

            <!-- Main row -->
            <div class="row">
                <iframe src="/display-grn-pdf/{{$grn}}" style="height: 1000px; width: 100%;">Your browser isn't compatible</iframe>
            </div>
            <!-- /.row (main row) -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>

<!-- FOOTER START -->
@include('partials._client_footer')
