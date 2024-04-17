<footer class="main-footer">
    <div>
        <div class="d-flex justify-content-center align-items-center ">
            <a href="{{ env('FACEBOOK') }}" class="icon mx-3">
                <i style="font-size: 60px;" class="fab fa-facebook"></i>
            </a>

            <a href="{{ env('TWITTER') }}" class="icon mx-3">
                <i style="font-size: 60px;" class="fab fa-twitter"></i>
            </a>

            <a href="{{ env('LINKEDIN') }}" class="icon mx-3">
                <i style="font-size: 60px;" class="fab fa-linkedin"></i>
            </a>

            <a href="{{ env('YOUTUBE') }}" class="icon mx-3">
                <i style="font-size: 60px;" class="fab fa-youtube"></i>
            </a>

            <a href="{{ env('INSTAGRAM') }}" class="icon mx-3">
                <i style="font-size: 60px;" class="fab fa-instagram"></i>
            </a>
        </div>
    </div>
    <div class="d-flex justify-content-center align-items-center ">
        {{ config('app.address') }}
    </div>
    <strong>Copyright &copy; {{ date('Y') }} <a href="">{{ config('app.name') }}</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
        <b>Pravicy policy</b>
        <b>Terms</b>
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
<script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('assets/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button) F
</script>
<!-- Bootstrap 4 -->
<script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>


<!-- jQuery Knob Chart -->
<script src="{{ asset('assets/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
<!-- daterangepicker -->
<script src="{{ asset('assets/plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('assets/plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<!-- Summernote -->
<script src="{{ asset('assets/plugins/summernote/summernote-bs4.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('assets/dist/js/adminlte.js') }}"></script>

<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ asset('assets/dist/js/pages/dashboard.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
</script>
@filamentScripts
</body>

</html>
