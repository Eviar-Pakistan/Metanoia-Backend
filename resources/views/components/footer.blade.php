<!-- Wrapper End-->
<footer class="iq-footer">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6">
                        <ul class="list-inline mb-0">
                            <li class="list-inline-item"><a href="#">Privacy
                                    Policy</a></li>
                            <li class="list-inline-item"><a href="#">Terms of
                                    Use</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-6 text-right">
                        <span class="mr-1">
                            <script>
                                2024
                            </script>© PHYSIO-VR Developed By
                        </span> <a href="https://evolvsolution.com/" class=""><b>Evolv Solution</b></a>.
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
  <!-- Backend Bundle JavaScript -->
<script src="{{asset('public/assets/js/backend-bundle.min.js')}}"></script>
<!-- Table Treeview JavaScript -->
{{-- <script src="{{asset('public/assets/js/table-treeview.js')}}"></script> --}}
<!-- Chart Custom JavaScript -->
<script src="{{asset('public/assets/js/customizer.js')}}"></script>
<!-- Chart Custom JavaScript -->
<script async src="{{asset('public/assets/js/chart-custom.js')}}"></script>
<!-- DataTables  & Plugins -->
<script src="{{ url('public/assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ url('public/assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ url('public/assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ url('public/assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ url('public/assets/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ url('public/assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ url('public/assets/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ url('public/assets/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ url('public/assets/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ url('public/assets/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ url('public/assets/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ url('public/assets/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
<!-- app JavaScript -->
<script src="{{asset('public/assets/js/app.js')}}"></script>
{{-- <link href="https://cdn.datatables.net/1.11.6/css/jquery.dataTables.min.css" rel="stylesheet">
<script src="https://cdn.datatables.net/1.11.6/js/jquery.dataTables.min.js"></script> --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

@include('ajax')
@if(session('success'))
        <script>
            Swal.fire({
                title: 'Success!',
                text: '{{ session('success') }}',
                icon: 'success',
                showConfirmButton: false,
                timer: 1500
            });
        </script>
    @endif
    <script>
    $(document).ready(function() {
        $('#subscription_id').select2({
            placeholder: "Select Subscription",
            allowClear: true
        });
    });
</script>
@yield('script')
</body>

</html>
