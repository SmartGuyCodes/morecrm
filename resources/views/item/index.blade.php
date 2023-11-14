<!-- HEADER -->
@include('partials._client_header')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-8">
                <h1 class="m-0">'{{$company_name}}' Items</h1>
            </div><!-- /.col -->
            <div class="col-sm-4">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Items</li>
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

            <!-- New Item row -->
            <div class="row">
                <!-- Left col -->
                <section class="col-lg-12 col-sm-12 connectedSortable">
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">New Item</h3>
                            </div>
                            <!-- /.card-header -->

                            @if (count($company_categories) > 0 && count($company_suppliers) > 0)
                                {{-- <p class="card-title">Update your category and supplier listing</p> --}}
                                <!-- form start -->
                                <form action="/add-item" method="POST" enctype="multipart/form-data">
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
                                            <label for="item_image">Item image<span style="color: #ff0000">*</span></label>
                                            <input id="item_image" type="file" name="item_image" required/>
                                            <br/>
                                            <img id="preview" class="product-image" style="width:100px;"/>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label for="item_name">Item Name<span style="color: #ff0000">*</span></label>
                                                    <input type="text" class="form-control" id="item_name" placeholder="" name="item_name" required>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Item Type<span style="color: #ff0000">*</span></label>
                                                    <!-- <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email"> -->
                                                    <select class="form-control" name="item_type" required>
                                                        <option value="product">Product</option>
                                                        <option value="service">Service</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label for="item_category_id">Item Category<span style="#ff0000">*</span></label>
                                                    <!-- <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email"> -->
                                                    <select id="item_category_id" name="item_category_id" class="form-control" required>
                                                        @foreach ($company_categories as $company_cat)
                                                            {{-- @if ($company_id === $company_cat->client_id) --}}
                                                                <option value="{{$company_cat->id}}"> {{$company_cat->category_name}} </option>
                                                            {{-- @endif --}}
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label for="item_location">Item Location</label>
                                                    <!-- <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email"> -->
                                                    <select id="item_location" name="item_location" class="form-control" required>
                                                        <option value="store">Store</option>
                                                        <option value="kitchen">Kitchen</option>
                                                        <option value="restaurant">Restaurant</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label for="item_supplier_id">Item Supplier<span style="color: #ff0000;">*</span></label>
                                                    <!-- <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email"> -->
                                                    <select name="item_supplier_id" class="form-control" required>
                                                        {{-- <option>--Select item supplier--</option> --}}
                                                        @foreach ($company_suppliers as $company_sup)
                                                            @if ($company_id === $company_sup->client_id)
                                                                <option value="{{$company_sup->id}}">{{$company_sup->company_name}}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label for="item_quantity">Item Quantity<span style="color: #ff0000">*</span></label>
                                                    <input type="number" class="form-control" id="item_quantity" name="item_quantity" placeholder="" required>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label for="item_reorder_level">Re-order Level<span style="color: #ff0000">*</span></label>
                                                    <input type="number" class="form-control" id="item_reorder_level" name="item_reorder_level" placeholder="" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Wholesale Price<span style="color: #ff0000">*</span></label>
                                                    <!-- <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email"> -->
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">KES</span>
                                                        </div>
                                                        <input id="item_buying_price" type="text" class="form-control" name="item_buying_price" required>
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">.00</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4"> 
                                                <div class="form-group">
                                                    <label for="item_selling_price">Retail Price<span style="color: #ff0000">*</span></label>
                                                    <!-- <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email"> -->
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">KES</span>
                                                        </div>
                                                        <input id="item_selling_price" type="text" class="form-control" name="item_selling_price" required>
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">.00</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Sales taxes</label></label>
                                                    <!-- <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email"> -->
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input" id="item_catering_levy" name="item_catering_levy">
                                                        <label class="custom-control-label" for="item_catering_levy">Catering Levy(2%)</label>
                                                    </div>
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input" id="item_vat" name="item_vat">
                                                        <label class="custom-control-label" for="item_vat">VAT(16%)</label>
                                                    </div>
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input" id="item_excise_duty" name="item_excise_duty">
                                                        <label class="custom-control-label" for="item_excise_duty">Excise Duty(10%)</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label for="item_package_type">Item Package Type<span style="color: #ff0000;">*</span></label>
                                                    <input type="text" class="form-control" id="item_package_type" placeholder="" name="item_package_type" required>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label for="item_batch_no">Item Batch no.<span style="color: #ff0000;">*</span></label>
                                                    <input type="number" class="form-control" id="item_batch_no" name="item_batch_no" placeholder="" required>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label for="item_expiry_date">Expiry date<span style="color: #ff0000;">*</span></label>
                                                    {{-- <input type="text" class="form-control" id="item_expiry_date" name="item_expiry_date" placeholder="" required> --}}
                                                    <div class="input-group date" id="item_expiry_date" data-target-input="nearest">
                                                        <input type="text" class="form-control datetimepicker-input" data-target="#item_expiry_date" name="item_expiry_date">
                                                        <div class="input-group-append" data-target="#item_expiry_date" data-toggle="datetimepicker">
                                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="item_description">Item Description</label>
                                            <!-- <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password"> -->
                                            <textarea class="form-control" id="item_description" name="item_description"></textarea>
                                        </div>
                                    </div>
                                    <!-- /.card-body -->

                                    <div class="card-footer">
                                    <button type="submit" class="btn btn-primary float-right">ADD</button>
                                    </div>
                                </form>
                            @else
                                <p style="text-align: center; padding: 3%;" class="card-title">Update your <a href="/category">category</a> and <a href="/suppliers">supplier</a> listing</p>
                            @endif
                        </div>
                    </div>
                </section>
                <!-- /.Left col -->
            </div>
            <!-- /.row (new item row) -->

            <!-- Main row -->
            <div class="row">
                <!-- Right col -->
                <section class="col-lg-12 col-sm-12 connectedSortable">
                    <!-- Categories Table -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Items</h3>
                            <!-- <a href="/new-item" class="btn btn-sm btn-primary float-right">Add New Item</a> -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="items_tbl" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        {{-- <th>#</th> --}}
                                        <th>Item QR Code</th>
                                        {{-- <th>Item Image</th> --}}
                                        <th>Name</th>
                                        <th>Category</th>
                                        <th>Supplier</th>
                                        <th>Qty</th>
                                        <th>Re-Order Lvl</th>
                                        <th>Wholesale Price(KSh)</th>
                                        <th>Retail Price(KSh)</th>
                                        <th>Expiry Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($items as $it)
                                        @if ($it->client_id == $company_id)
                                            <tr>
                                                {{-- <td>P#{{$it->id}}</td> --}}
                                                <td>
                                                    <div id="qrcode_{{$it->id}}" style="width: 50px !important;"></div>
                                                    <script type="text/javascript">
                                                        // new QRCode(document.getElementById("qrcode_1"), "https://webisora.com");
                                                        var qrcode = new QRCode(document.getElementById("qrcode_{{$it->id}}"), {
                                                            text: "{{$it->id}}",
                                                            width: 50,
                                                            height: 50,
                                                            colorDark : "#5868bf",
                                                            colorLight : "#ffffff",
                                                            correctLevel : QRCode.CorrectLevel.H
                                                        });
                                                    </script>
                                                </td>
                                                {{-- <td>
                                                    <img src="{{ asset($it->item_image) }}" class="img-responsive" />
                                                    <img src="{{ asset('storage/app/public/items/1674029002.jpg') }}" class="img-responsive" alt="" />
                                                </td> --}}
                                                <td>{{$it->item_name}}</td>
                                                <td>{{$it->category_name}}</td>
                                                <td>{{$it->supplier_name}}</td>
                                                <td>{{$it->item_quantity}}</td>
                                                <td>{{$it->item_reorder_level}}</td>
                                                <td>
                                                    @money($it->item_buying_price)
                                                </td>
                                                <td>@money($it->item_selling_price)</td>
                                                <td><span class="direct-chat-timestamp">{{$it->item_expiry_date}}</span></td>
                                                <td>
                                                    <div class="btn-group">
                                                        <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#edit_item_{{$it->id}}_modal"><i class="far fa-edit"></i></a>
                                                        <div class="modal fade" id="edit_item_{{$it->id}}_modal">
                                                            <div class="modal-dialog modal-lg">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                    <h4 class="modal-title">'{{$it->item_name}}' Item Profile</h4>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <!-- form start -->
                                                                        <form action="/update-item/{{$it->id}}" method="POST">
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
                                                                                    <label for="exampleInputFile">Item image</label>
                                                                                    <input type="file" id="fileInput" accept="image/*" name="item_image"/>
                                                                                    <br/>
                                                                                    <img id="preview" class="product-image" style="width:100px;"/>
                                                                                </div>
                                                                                <div class="row">
                                                                                    <div class="col-lg-3">
                                                                                        <div class="form-group">
                                                                                            <label for="item_name">Item Name<span style="color: #ff0000">*</span></label>
                                                                                            <input type="text" class="form-control" id="item_name" placeholder="" name="item_name" value="{{$it->item_name}}" required>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-lg-3">
                                                                                        <div class="form-group">
                                                                                            <label for="exampleInputEmail1">Item Type<span style="color: #ff0000">*</span></label>
                                                                                            <!-- <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email"> -->
                                                                                            <select class="form-control" name="item_type" required>
                                                                                                <option value="product">Product</option>
                                                                                                <option value="service">Service</option>
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-lg-3">
                                                                                        <div class="form-group">
                                                                                            <label for="item_category_id">Item Category<span style="#ff0000">*</span></label>
                                                                                            <!-- <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email"> -->
                                                                                            <select id="item_category_id" name="item_category_id" class="form-control" required>
                                                                                                <option value="{{$it->item_category_id}}">Current: {{$it->category_name}}</option>
                                                                                                @foreach ($company_categories as $company_cat)
                                                                                                    @if ($company_id == $company_cat->client_id)
                                                                                                        <option value="{{$company_cat->id}}"> {{$company_cat->category_name}} </option>
                                                                                                    @endif
                                                                                                @endforeach
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-lg-3">
                                                                                        <div class="form-group">
                                                                                            <label for="item_location">Item Location</label>
                                                                                            <!-- <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email"> -->
                                                                                            <select id="item_location" name="item_location" class="form-control" required>
                                                                                                <option value="store">Store</option>
                                                                                                <option value="counter">Counter</option>
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row">
                                                                                    <div class="col-lg-4">
                                                                                        <div class="form-group">
                                                                                            <label for="item_supplier_id">Item Supplier<span style="color: #ff0000;">*</span></label>
                                                                                            <!-- <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email"> -->
                                                                                            <select name="item_supplier_id" class="form-control" required>
                                                                                                {{-- <option>--Select item supplier--</option> --}}
                                                                                                <option value="{{$it->item_supplier_id}}">Current: {{$it->supplier_name}}</option>
                                                                                                @foreach ($company_suppliers as $company_sup)
                                                                                                    @if ($company_id == $company_sup->client_id)
                                                                                                        <option value="{{$company_sup->id}}">{{$company_sup->company_name}}</option>
                                                                                                    @endif
                                                                                                @endforeach
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-lg-4">
                                                                                        <div class="form-group">
                                                                                            <label for="item_quantity">Item Quantity<span style="color: #ff0000">*</span></label>
                                                                                            <input type="number" class="form-control" id="item_quantity" name="item_quantity" value="{{$it->item_quantity}}" placeholder="" required>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-lg-4">
                                                                                        <div class="form-group">
                                                                                            <label for="item_reorder_level">Re-order Level<span style="color: #ff0000">*</span></label>
                                                                                            <input type="number" class="form-control" id="item_reorder_level" name="item_reorder_level" value="{{$it->item_reorder_level}}" placeholder="" required>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row">
                                                                                    <div class="col-lg-4">
                                                                                        <div class="form-group">
                                                                                            <label for="exampleInputEmail1">Wholesale Price<span style="color: #ff0000">*</span></label>
                                                                                            <!-- <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email"> -->
                                                                                            <div class="input-group">
                                                                                                <div class="input-group-prepend">
                                                                                                    <span class="input-group-text">KES</span>
                                                                                                </div>
                                                                                                <input id="item_buying_price" type="text" class="form-control" name="item_buying_price" value="{{$it->item_buying_price}}" required>
                                                                                                <div class="input-group-append">
                                                                                                    <span class="input-group-text">.00</span>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-lg-4"> 
                                                                                        <div class="form-group">
                                                                                            <label for="item_selling_price">Retail Price<span style="color: #ff0000">*</span></label>
                                                                                            <!-- <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email"> -->
                                                                                            <div class="input-group">
                                                                                                <div class="input-group-prepend">
                                                                                                    <span class="input-group-text">KES</span>
                                                                                                </div>
                                                                                                <input id="item_selling_price" type="text" class="form-control" name="item_selling_price" value="{{$it->item_selling_price}}" required>
                                                                                                <div class="input-group-append">
                                                                                                    <span class="input-group-text">.00</span>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-lg-4">
                                                                                        <div class="form-group">
                                                                                            <label for="exampleInputEmail1">Sales taxes</label></label>
                                                                                            <!-- <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email"> -->
                                                                                            <div class="custom-control custom-switch">
                                                                                                {{-- @if (isset({{$it->item_catering_levy}}) && {{$it->item_catering_levy == 1}})
                                                                                                    <input type="checkbox" class="custom-control-input" id="item_catering_levy" name="item_catering_levy" checked/>
                                                                                                @else
                                                                                                    <input type="checkbox" class="custom-control-input" id="item_catering_levy" name="item_catering_levy"/>
                                                                                                @endif --}}
                                                                                                <input type="checkbox" class="custom-control-input" id="item_catering_levy" name="item_catering_levy" {{ $it->item_catering_levy ? 'checked' : '' }}>
                                                                                                <label class="custom-control-label" for="item_catering_levy">Catering Levy(2%)</label>
                                                                                            </div>
                                                                                            <div class="custom-control custom-switch">
                                                                                                <input type="checkbox" class="custom-control-input" id="item_vat" name="item_vat" {{ $it->item_vat ? 'checked' : '' }}>
                                                                                                <label class="custom-control-label" for="item_vat">VAT(16%)</label>
                                                                                            </div>
                                                                                            <div class="custom-control custom-switch">
                                                                                                <input type="checkbox" class="custom-control-input" id="item_excise_duty" name="item_excise_duty" {{ $it->item_excise_duty ? 'checked' : '' }}>
                                                                                                <label class="custom-control-label" for="item_excise_duty">Excise Duty(10%)</label>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row">
                                                                                    <div class="col-lg-4">
                                                                                        <div class="form-group">
                                                                                            <label for="item_package_type">Item Package Type<span style="color: #ff0000;">*</span></label>
                                                                                            <input type="text" class="form-control" id="item_package_type" placeholder="" name="item_package_type" value="{{$it->item_package_type}}" required>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-lg-4">
                                                                                        <div class="form-group">
                                                                                            <label for="item_batch_no">Item Batch no.<span style="color: #ff0000;">*</span></label>
                                                                                            <input type="number" class="form-control" id="item_batch_no" name="item_batch_no" placeholder="" value="{{$it->item_batch_no}}" required>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-lg-4">
                                                                                        <div class="form-group">
                                                                                            <label for="item_expiry_date">Expiry date<span style="color: #ff0000;">*</span></label>
                                                                                            <input type="text" class="form-control" id="item_expiry_date" name="item_expiry_date" placeholder="" value="{{$it->item_expiry_date}}" required>

                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label for="item_description">Item Description</label>
                                                                                    <!-- <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password"> -->
                                                                                    <textarea class="form-control" id="item_description" name="item_description"> {{$it->item_description}}</textarea>
                                                                                </div>
                                                                            </div>
                                                                            <!-- /.card-body -->

                                                                            <div class="card-footer">
                                                                            <button type="submit" class="btn btn-primary float-right">UPDATE</button>
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
                                                        <a href="/delete-item/{{$it->id}}" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>
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
                            <!-- <a href="/new-item" class="btn btn-sm btn-info float-left">Add New Item</a> -->
                            <!-- <a href="javascript:void(0)" class="btn btn-sm btn-secondary float-right">View All Categories</a> -->
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
