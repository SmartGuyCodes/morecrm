<!-- /.content-wrapper -->
<footer class="main-footer">
            <strong>Copyright &copy; 2022 - {{ \Carbon\Carbon::now()->format('Y') }} 
                | <a href="https://www.{{$saas_name}}.com" target="_blank">www.{{$saas_name}}.com</a>
            </strong> |
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
            <b>Version</b> 1.0.0
            </div>
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
        </div>
        <!-- ./wrapper -->

        <!-- jQuery -->
        <script src="/plugins/jquery/jquery.min.js"></script>
        <!-- jQuery UI 1.11.4 -->
        <script src="/plugins/jquery-ui/jquery-ui.min.js"></script>
        <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
        <script>
        $.widget.bridge('uibutton', $.ui.button)
        </script>
        <!-- Bootstrap 4 -->
        <script src="/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- InputMask -->
        <script src="/plugins/moment/moment.min.js"></script>
        <script src="/plugins/inputmask/jquery.inputmask.min.js"></script>
        <!-- date-range-picker -->
        <script src="/plugins/daterangepicker/daterangepicker.js"></script>
        <!-- SweetAlert2 -->
        <script src="/plugins/sweetalert2/sweetalert2.min.js"></script>
        <!-- Toastr -->
        <script src="/plugins/toastr/toastr.min.js"></script>
        <!-- DataTables  & Plugins -->
        <script src="/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
        <script src="/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
        <script src="/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
        <script src="/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
        <script src="/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
        <script src="/plugins/jszip/jszip.min.js"></script>
        <script src="/plugins/pdfmake/pdfmake.min.js"></script>
        <script src="/plugins/pdfmake/vfs_fonts.js"></script>
        <script src="/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
        <script src="/plugins/datatables-buttons/js/buttons.print.min.js"></script>
        <script src="/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
        <!-- ChartJS -->
        <script src="/plugins/chart.js/Chart.min.js"></script>
        <!-- Sparkline -->
        <script src="/plugins/sparklines/sparkline.js"></script>
        <!-- JQVMap -->
        <script src="/plugins/jqvmap/jquery.vmap.min.js"></script>
        <script src="/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
        <!-- jQuery Knob Chart -->
        <script src="/plugins/jquery-knob/jquery.knob.min.js"></script>
        <!-- daterangepicker -->
        <script src="/plugins/moment/moment.min.js"></script>
        <script src="/plugins/daterangepicker/daterangepicker.js"></script>
        <!-- Tempusdominus Bootstrap 4 -->
        <script src="/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
        <!-- Summernote -->
        <script src="/plugins/summernote/summernote-bs4.min.js"></script>
        <!-- overlayScrollbars -->
        <script src="/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
        <!-- AdminLTE App -->
        <script src="/dist/js/adminlte.js"></script>
        <!-- AdminLTE for demo purposes -->
        <!-- <script src="/dist/js/demo.js"></script> -->
        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        <script src="/dist/js/pages/dashboard.js"></script>
        <!-- Page specific script -->
        <script>
            // Data tables
            $(function () {
                $("#category_tbl, #supplier_tbl, #items_tbl, #clients_tbl, #receivings_tbl, #requisitions_tbl, #stock_report_tbl, #unwarranted_goods_tbl, #staff_tbl").DataTable({
                "responsive": true, "lengthChange": false, "autoWidth": false,
                "buttons": ["excel", "print"] //"copy", "csv", "excel", "pdf", "print", "colvis"
                }).buttons().container().appendTo('#category_tbl_wrapper .col-md-6:eq(0), #supplier_tbl_wrapper .col-md-6:eq(0), #items_tbl_wrapper .col-md-6:eq(0)');

                $('#receiving_items_tbl').DataTable({
                    "paging": true,
                    "lengthChange": false,
                    "searching": false,
                    "ordering": true,
                    "info": true,
                    "autoWidth": false,
                    "responsive": true,
                });
            });

            //Date and time picker
            $('#item_expiry_date, #reservationdatetime, #requisition_date, #receiving_date_time, #start_date, #end_date').datetimepicker({ 
                icons: { time: 'far fa-clock' },
                format: 'YYYY-MM-DD hh:mm:ss', //2024-07-16 16:00:14
            });

            const fileInput = document.getElementById('item_image');
            const preview = document.getElementById('preview');

            fileInput.addEventListener('change', () => {
                const file = fileInput.files[0];
                const objectURL = URL.createObjectURL(file);

                preview.src = objectURL;
            });

            preview.addEventListener('load', () => {
                URL.revokeObjectURL(objectURL);
            });

            function delete_category_fxn(){
                var Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000
                });

                if (confirm("Are you sure?")) {
                    // alert("Category deleted!");
                    Toast.fire({
                        icon: 'success',
                        title: 'Category records deleted successfully'
                    })
                } else {
                    // alert("You pressed Cancel!");
                    Toast.fire({
                        icon: 'error',
                        title: 'Deletion cancelled!'
                    })
                }
            }

            function delete_supplier_fxn(){
                var Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000
                });

                if (confirm("Are you sure?")) {
                    // alert("Category deleted!");
                    Toast.fire({
                        icon: 'success',
                        title: 'Supplier records deleted successfully'
                    })
                } else {
                    // alert("You pressed Cancel!");
                    Toast.fire({
                        icon: 'error',
                        title: 'Deletion cancelled!'
                    })
                }
            }

            function delete_item_fxn(){
                var Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000
                });
                
                if (confirm("Are you sure?")) {
                    // alert("Category deleted!");
                    Toast.fire({
                        icon: 'success',
                        title: 'Item records deleted successfully'
                    })
                } else {
                    // alert("You pressed Cancel!");
                    Toast.fire({
                        icon: 'error',
                        title: 'Deletion cancelled!'
                    })
                }
            }
        </script>
    </body>
</html>