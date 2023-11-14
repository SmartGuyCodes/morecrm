<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>QRStockingPOS | Registration Paywall Page</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/dist/css/adminlte.min.css">
</head>
<body class="hold-transition register-page">
<div class="">
  <div class="register-logo">
    <a href="/"><b>Control</b> My Stock</a>
  </div>

  <div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <!-- <div class="callout callout-info">
                <h5><i class="fas fa-info"></i> Note:</h5>
                This invoice has been enhanced for printing. Click the print button at the bottom of the invoice to print.
            </div> -->


            <!-- Main content -->
            <div class="invoice p-3 mb-3">
                <!-- title row -->
                <div class="row">
                <div class="col-12">
                    <h4>
                    <i class="fas fa-globe"></i> Control My Stock, Ltd.
                    <small class="float-right">Date: 2/10/2023</small>
                    </h4>
                </div>
                <!-- /.col -->
                </div>
                <!-- info row -->
                <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                    From
                    <address>
                    <strong>Control My Stock, Ltd.</strong><br>
                    Kenyatta Avenue<br>
                    Nairobi, P.O. Box 94107 - 00100<br>
                    Phone: (+254) 123-5432<br>
                    Email: info@comtrolmystock.com
                    </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                    To
                    <address>
                    <strong>Company name, Ltd</strong><br>
                    Wabera Street, Crystal Tower, Suite 600<br>
                    Nairobi, P.O. Box 4107 - 00100<br>
                    Phone: (_254) 539-1037<br>
                    Email: email@example.com
                    </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                    <b>Invoice #007612</b><br>
                    <br>
                    <b>Order ID:</b> 4F3S8J<br>
                    <b>Payment Due:</b> 2/22/2023<br>
                    <b>Account:</b> 968-34567
                </div>
                <!-- /.col -->
                </div>
                <!-- /.row -->

                <!-- Table row -->
                <div class="row">
                <div class="col-12 table-responsive">
                    <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Qty</th>
                        <th>Package</th>
                        <th>Account #</th>
                        <th>Description</th>
                        <th>Subtotal</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>1</td>
                        <td>Monthly</td>
                        <td>455-981-221</td>
                        <td>Monthly package subscription</td>
                        <td>KES 1,500.00</td>
                    </tr>
                    </tbody>
                    </table>
                </div>
                <!-- /.col -->
                </div>
                <!-- /.row -->

                <div class="row">
                <!-- accepted payments column -->
                <div class="col-6">
                    <p class="lead">Payment Method(s):</p>
                    <img src="/dist/img/credit/mpesa.jpeg" width="150" alt="Visa">
                    <!-- <img src="/dist/img/credit/mastercard.png" alt="Mastercard">
                    <img src="/dist/img/credit/american-express.png" alt="American Express">
                    <img src="/dist/img/credit/paypal2.png" alt="Paypal"> -->

                    <!-- <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                    Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem
                    plugg
                    dopplr jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.
                    </p> -->
                </div>
                <!-- /.col -->
                <div class="col-6">
                    <p class="lead">Amount Due 2/22/2023</p>

                    <div class="table-responsive">
                    <table class="table">
                        <tbody><tr>
                        <th style="width:50%">Subtotal:</th>
                        <td>KES 1,500.00</td>
                        </tr>
                        <tr>
                        <th>Tax (16%)</th>
                        <td>KES 240</td>
                        </tr>
                        <tr>
                        <th>Total:</th>
                        <td>KES 1,740.00</td>
                        </tr>
                    </tbody></table>
                    </div>
                </div>
                <!-- /.col -->
                </div>
                <!-- /.row -->

                <!-- this row will not appear when printing -->
                <div class="row no-print">
                <div class="col-12">
                    <!-- <a href="invoice-print.html" rel="noopener" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print</a> -->
                    <!-- <button type="button" class="btn btn-success float-right">
                        <i class="far fa-credit-card"></i> Submit
                        Payment
                    </button> -->
                    <a href="/verify-subscription" class="btn btn-success float-right">
                        <i class="far fa-credit-card"></i> Submit
                        Payment
                    </a>
                    <!-- <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                    <i class="fas fa-download"></i> Generate PDF
                    </button> -->
                </div>
                </div>
            </div>
            <!-- /.invoice -->
        </div><!-- /.col -->
    </div><!-- /.row -->
    </div>
</div>
<!-- /.register-box -->

<!-- jQuery -->
<script src="/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="/dist/js/adminlte.min.js"></script>
</body>
</html>
