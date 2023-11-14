<!-- HEADER -->
@include('partials._client_header')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Hotel Name Ltd Supplier Profile</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Supplier Profile</li>
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
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Supplier Profile</h3>
                            </div>
                            <!-- /.card-header -->

                            <!-- form start -->
                            <form>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Supplier Name</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Supplier title" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Supplier Description</label>
                                        <!-- <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password"> -->
                                        <textarea class="form-control" readonly>Supplier description text</textarea>
                                    </div>
                                </div>
                                <!-- /.card-body -->

                                <!-- <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div> -->
                            </form>
                        </div>
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
