    <!-- plugins:js -->
    <script src="{{ asset('assets/vendors/js/vendor.bundle.base.js') }}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="{{ asset('assets/vendors/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.cookie.js') }}" type="text/javascript"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{ asset('assets/js/off-canvas.js') }}"></script>
    <script src="{{ asset('assets/js/hoverable-collapse.js') }}"></script>
    {{-- <script src="{{ asset('assets/js/misc.js') }}"></script> --}}
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script>
        var changeStatusUrl = '{{ url('ajax/dashboard/changeStatus') }}';
        var changeStatusAllUrl = '{{ url('ajax/dashboard/changeStatusAll') }}';
    </script>
    <script src="{{ asset('assets/js/dashboard.js') }}"></script>
    <script src="{{ asset('assets/js/todolist.js') }}"></script>
    <script src="{{ asset('assets/library/location.js') }}"></script>
    <script src="{{ asset('assets/library/library.js') }}"></script>
    <script src="{{ asset('assets/js/file-upload.js') }}"></script>
