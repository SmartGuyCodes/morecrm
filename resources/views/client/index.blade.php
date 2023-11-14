<!-- HEADER -->
@include('partials._client_header')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-8">
                    <h1 class="m-0">'{{ $company_name }}' Dashboard</h1>
                </div><!-- /.col -->
                <div class="col-sm-4">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
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
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <!-- <p>Modules</p> -->
                <!-- <a class="btn btn-app bg-success" href="/suppliers">
                  <span class="badge bg-purple">11</span>
                  <i class="fas fa-users"></i> categories
                </a>
                <a class="btn btn-app bg-primary" href="/suppliers">
                  <span class="badge bg-purple">11</span>
                  <i class="fas fa-users"></i> Suppliers
                </a>
                <a class="btn btn-app bg-secondary" href="/item">
                  <span class="badge bg-success">300</span>
                  <i class="fas fa-barcode"></i> Items
                </a>
                <a class="btn btn-app bg-warning" href="/receive">
                  <span class="badge bg-info">12</span>
                  <i class="fas fa-envelope"></i> Receivings
                </a>
                <a class="btn btn-app bg-danger" href="/sale">
                  <span class="badge bg-teal">67</span>
                  <i class="fas fa-inbox"></i> Requisition
                </a> -->
                <!-- <a class="btn btn-app bg-success">
                  <span class="badge bg-purple">891</span>
                  <i class="fas fa-users"></i> Clients
                </a> -->
                <!-- <a class="btn btn-app bg-info">
                  <span class="badge bg-danger">531</span>
                  <i class="fas fa-heart"></i> Sale
                </a> -->
            </div>
        </div>
        <hr>
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>{{ $total_staff }}</h3>

                        <p>Users</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="/staff" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
            </div>
            <!-- /.row -->

            <hr>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>

<!-- FOOTER START -->
@include('partials._client_footer')
