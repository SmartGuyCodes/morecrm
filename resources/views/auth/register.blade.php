<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>BillSpack | Registration Page</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/dist/css/adminlte.min.css">
</head>
<body class="hold-transition register-page d-flex flex-column h-100">
    <header>
      <!-- Fixed navbar -->
      <nav class="navbar navbar-expand-md navbar-dark fixed-top">
        <a class="navbar-brand" href="#">Bills Pack</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Link</a>
            </li>
            <li class="nav-item">
              <a class="nav-link disabled">Disabled</a>
            </li>
          </ul>
          <form class="form-inline mt-2 mt-md-0">
            <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
          </form>
        </div>
      </nav>
    </header>

    <!-- Begin page content -->
    <main role="main" class="flex-shrink-0" style="margin-top: 3%;">
        <div class="container">

          <div class="row" style="margin-top: 6%;">
            <div class="col-lg-6 col-md-12">
              One of two columns
            </div>

            <div class="col-lg-6 col-md-12">
              <div class="">

                <div class="card" style="margin-top: 3%;">
                  <div class="card-body register-card-body">
                    <div class="register-logo">
                      <a href="/"><b>Bills</b>Pack</a>
                    </div>
                    <p class="login-box-msg">Enter your company information to subscribe</p>

                    <form action="#" method="post">
                      <div class="row">
                          <div class="col-lg-12">
                              <div class="form-group">
                                  <label class="col-form-label" for="inputSuccess">
                                      <!-- <i class="fas fa-check"></i> -->
                                      Subscription package
                                  </label>
                                  <!-- <input type="text" class="form-control is-valid" id="inputSuccess" placeholder="Enter ..."> -->
                                  <div class="form-check">
                                      <input class="form-check-input" type="radio" name="radio1">
                                      <label class="form-check-label">Monthly</label>
                                  </div>
                                  <div class="form-check">
                                      <input class="form-check-input" type="radio" name="radio1" checked="">
                                      <label class="form-check-label">Quarterly</label>
                                  </div>
                                  <div class="form-check">
                                      <input class="form-check-input" type="radio" name="radio1">
                                      <label class="form-check-label">Yearly</label>
                                  </div>
                              </div>
                          </div>
                      </div>

                      <div class="row">
                          <div class="col-lg-12">
                              <label class="col-form-label" for="inputSuccess">
                                  <!-- <i class="fas fa-check"></i> -->
                                  Company Name
                              </label>
                              <div class="input-group mb-3">
                                  <input type="text" class="form-control" placeholder="Full name">
                                  <div class="input-group-append">
                                      <div class="input-group-text">
                                      <span class="fas fa-user"></span>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>

                      <div class="row">
                          <div class="col-lg-6">
                              <label class="col-form-label" for="inputSuccess">
                                  <!-- <i class="fas fa-check"></i> -->
                                  Company Email
                              </label>
                              <div class="input-group mb-3">
                                  <input type="text" class="form-control" placeholder="">
                                  <div class="input-group-append">
                                      <div class="input-group-text">
                                      <span class="fas fa-at"></span>
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <div class="col-lg-6">
                              <label class="col-form-label" for="inputSuccess">
                                  <!-- <i class="fas fa-check"></i> -->
                                  Company Phone no.
                              </label>
                              <div class="input-group mb-3">
                                  <input type="text" class="form-control" placeholder="">
                                  <div class="input-group-append">
                                      <div class="input-group-text">
                                      <span class="fas fa-phone"></span>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>

                      <div class="row">
                          <div class="col-lg-12">
                              <label class="col-form-label" for="inputSuccess">
                                  <!-- <i class="fas fa-check"></i> -->
                                  Company Address
                              </label>
                              <div class="input-group mb-3">
                                  <!-- <input type="text" class="form-control" placeholder=""> -->
                                  <textarea class="form-control"></textarea>
                                  <div class="input-group-append">
                                      <div class="input-group-text">
                                      <span class="fas fa-map"></span>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>

                      <div class="row">
                          <div class="col-lg-6">
                              <label class="col-form-label" for="inputSuccess">
                                  <!-- <i class="fas fa-check"></i> -->
                                  Company Person
                              </label>
                              <div class="input-group mb-3">
                                  <input type="text" class="form-control" placeholder="">
                                  <div class="input-group-append">
                                      <div class="input-group-text">
                                      <span class="fas fa-user"></span>
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <div class="col-lg-6">
                              <label class="col-form-label" for="inputSuccess">
                                  <!-- <i class="fas fa-check"></i> -->
                                  Person Phone no.
                              </label>
                              <div class="input-group mb-3">
                                  <input type="tel" class="form-control" placeholder="" autocomplete="off">
                                  <div class="input-group-append">
                                      <div class="input-group-text">
                                      <span class="fas fa-phone"></span>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>

                      <div class="row">
                          <div class="col-lg-12">
                              <label class="col-form-label" for="inputSuccess">
                                  <!-- <i class="fas fa-check"></i> -->
                                  Password
                              </label>
                              <div class="input-group mb-3">
                                  <input type="password" class="form-control" placeholder="">
                                  <div class="input-group-append">
                                      <div class="input-group-text">
                                      <span class="fas fa-lock"></span>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>

                      <div class="row">
                          <div class="col-lg-12">
                              <label class="col-form-label" for="inputSuccess">
                                  <!-- <i class="fas fa-check"></i> -->
                                  Total Amount
                              </label>
                              <div class="input-group mb-3">
                                  <input type="text" class="form-control" value="0.00" readonly>
                                  <!-- <div class="input-group-append">
                                      <div class="input-group-text">
                                      <span class="fas fa-lock"></span>
                                      </div>
                                  </div> -->
                              </div>
                          </div>
                      </div>

                      

                      <!-- <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Full name">
                        <div class="input-group-append">
                          <div class="input-group-text">
                            <span class="fas fa-user"></span>
                          </div>
                        </div>
                      </div> -->
                      <!-- <div class="input-group mb-3">
                        <input type="email" class="form-control" placeholder="Email">
                        <div class="input-group-append">
                          <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                          </div>
                        </div>
                      </div>
                      <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Password">
                        <div class="input-group-append">
                          <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                          </div>
                        </div>
                      </div>
                      <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Retype password">
                        <div class="input-group-append">
                          <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                          </div>
                        </div>
                      </div> -->

                      <div class="row">
                        <div class="col-8">
                          <div class="icheck-primary">
                            <input type="checkbox" id="agreeTerms" name="terms" value="agree">
                            <label for="agreeTerms">
                            I agree to the <a href="#">terms</a>
                            </label>
                          </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                          <!-- <button type="submit" class="btn btn-primary btn-block">Next</button> -->
                          <a class="btn btn-primary btn-block" href="/subscription-paywall">
                              Next
                          </a>
                        </div>
                        <!-- /.col -->
                      </div>
                    </form>

                    <!-- <div class="social-auth-links text-center">
                      <p>- OR -</p>
                      <a href="#" class="btn btn-block btn-primary">
                        <i class="fab fa-facebook mr-2"></i>
                        Sign up using Facebook
                      </a>
                      <a href="#" class="btn btn-block btn-danger">
                        <i class="fab fa-google-plus mr-2"></i>
                        Sign up using Google+
                      </a>
                    </div> -->

                    <a href="/login" class="text-center">I already have a subscription</a>
                  </div>
                  <!-- /.form-box -->
                </div><!-- /.card -->
              </div>
              <!-- /.register-box -->
            </div>
          </div>
        </div>
    </main>

    <footer class="footer mt-auto py-3">
      <div class="container">
        <span class="text-muted">Bills pack &copy; 2023</span>
      </div>
    </footer>

  <!-- jQuery -->
  <script src="/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="/dist/js/adminlte.min.js"></script>
</body>
</html>
