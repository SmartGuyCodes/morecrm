<!-- HEADER -->
@include('partials._client_header')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-8">
                    <h1 class="m-0">'{{$company_name}}' Suppliers List</h1>
                </div><!-- /.col -->
                <div class="col-sm-4">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Suppliers List</li>
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
                    <!-- Suppliers Table -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Suppliers List between {{$start_date}} & {{$end_date}}</h3>
                            <!-- <a href="/new-supplier" class="btn btn-sm btn-primary float-right">Add New Supplier</a> -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div >
                                <div class="bootstrap-iso">
                                    <form method="post" action="/filter-suppliers-list">
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
                                            <div class="col-md-4 col-sm-4 col-xs-12">
                                                <div class="form-group ">
                                                    <label class="control-label " for="start_date">
                                                    From
                                                    </label>
                                                    {{-- <input class="form-control" id="start_date" name="start_date" placeholder="YYYY-MM-DD" type="text" autocomplete="off" /> --}}
                                                    <div class="input-group date" id="start_date" data-target-input="nearest">
                                                        <input type="text" class="form-control datetimepicker-input" data-target="#start_date" name="start_date">
                                                        <div class="input-group-append" data-target="#start_date" data-toggle="datetimepicker">
                                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                        </div>
                                                    </div>
                                                </div> 
                                            </div>
                                            <div class="col-md-4 col-sm-4 col-xs-12">
                                                <div class="form-group ">
                                                    <label class="control-label " for="end_date">
                                                    To
                                                    </label>
                                                    {{-- <input class="form-control" id="end_date" name="end_date" placeholder="YYYY-MM-DD" type="text" autocomplete="off" /> --}}
                                                    <div class="input-group date" id="end_date" data-target-input="nearest">
                                                        <input type="text" class="form-control datetimepicker-input" data-target="#end_date" name="end_date">
                                                        <div class="input-group-append" data-target="#end_date" data-toggle="datetimepicker">
                                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-4 col-xs-12">
                                                <div class="form-group">
                                                    <div style="margin-top: 9%;">
                                                        <button class="btn btn-primary " name="submit" type="submit">
                                                            Search
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <iframe src="/suppliers-list-pdf-filtered/{{$start_date}}/{{$end_date}}" style="height: 1000px; width: 100%;">Your browser isn't compatible</iframe>
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
