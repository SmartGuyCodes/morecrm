<!-- HEADER -->
@include('partials._client_header')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-8">
                    <h1 class="m-0">'{{$company_name}}' Settings</h1>
                </div><!-- /.col -->
                <div class="col-sm-4">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Settings</li>
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
            <!-- Main row -->
            <div class="row">
                <!-- Left col -->
                <section class="col-lg-12 connectedSortable">
                    <div class="row">
                        <div class="col-12">
                            <!-- Custom Tabs -->
                            <div class="card">
                                <div class="card-header d-flex p-0">
                                    <h3 class="card-title p-3">General Settings</h3>
                                    <ul class="nav nav-pills ml-auto p-2">
                                        <li class="nav-item"><a class="nav-link active" href="#basic_settings" data-toggle="tab">Basic Settics</a></li>
                                        <li class="nav-item"><a class="nav-link" href="#payment_settings" data-toggle="tab">Payment Settings</a></li>
                                        <li class="nav-item"><a class="nav-link" href="#sms_settings" data-toggle="tab">SMS Settings</a></li>
                                        <li class="nav-item"><a class="nav-link" href="#email_settings" data-toggle="tab">Email Settings</a></li>
                                    </ul>
                                </div><!-- /.card-header -->
                                <div class="card-body">
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="basic_settings">
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
                                                        <label for="item_image">Company Logo<span style="color: #ff0000">*</span></label>
                                                        <input id="item_image" type="file" name="item_image" required/>
                                                        <br/>
                                                        <img id="preview" class="product-image" style="width:100px;"/>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-4">
                                                            <div class="form-group">
                                                                <label for="item_name">company_name<span style="color: #ff0000">*</span></label>
                                                                <input type="text" class="form-control" id="item_name" placeholder="" name="item_name" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <div class="form-group">
                                                                <label for="item_location">company_subscription_package</label>
                                                                <!-- <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email"> -->
                                                                <select id="item_location" name="item_location" class="form-control" required>
                                                                    <option value="monthly">Monthly</option>
                                                                    <option value="quarterly">Quarterly</option>
                                                                    <option value="yearly">Yearly</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <div class="form-group">
                                                                <label for="item_package_type">company_address<span style="color: #ff0000;">*</span></label>
                                                                <input type="text" class="form-control" id="item_package_type" placeholder="" name="item_package_type" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label for="item_quantity">company_email<span style="color: #ff0000">*</span></label>
                                                                <input type="number" class="form-control" id="item_quantity" name="item_quantity" placeholder="" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label for="item_reorder_level">company_phone<span style="color: #ff0000">*</span></label>
                                                                <input type="number" class="form-control" id="item_reorder_level" name="item_reorder_level" placeholder="" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label for="item_package_type">company_contact_person_nam<span style="color: #ff0000;">*</span></label>
                                                                <input type="text" class="form-control" id="item_package_type" placeholder="" name="item_package_type" required>
                                                            </div>
                                                        </div>
                                                        {{-- company_contact_person_nam --}}
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label for="item_batch_no">company_contact_person_phone<span style="color: #ff0000;">*</span></label>
                                                                <input type="number" class="form-control" id="item_batch_no" name="item_batch_no" placeholder="" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="item_description">Terms & Conditions</label>
                                                        <!-- <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password"> -->
                                                        <textarea class="form-control" id="item_description" name="item_description"></textarea>
                                                    </div>
                                                </div>
                                                <!-- /.card-body -->

                                                <div class="card-footer">
                                                    <button type="submit" class="btn btn-primary float-right">UPDATE</button>
                                                </div>
                                            </form>
                                        </div>
                                        <!-- /.tab-pane -->
                                        <div class="tab-pane" id="payment_settings">
                                            Payment Work in progress...
                                        </div>
                                        <!-- /.tab-pane -->
                                        <div class="tab-pane" id="sms_settings">
                                            SMS Work in progress...
                                        </div>
                                        <!-- /.tab-pane -->
                                        <div class="tab-pane" id="email_settings">
                                            Email  Work in progress...
                                        </div>
                                        <!-- /.tab-pane -->
                                    </div>
                                    <!-- /.tab-content -->
                                </div><!-- /.card-body -->
                            </div>
                            <!-- ./card -->
                        </div>
                        <!-- /.col -->
                    </div>
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
