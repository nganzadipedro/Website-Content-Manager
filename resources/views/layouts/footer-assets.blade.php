<!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
<script src="{{ asset('assets/template/src/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/template/src/plugins/src/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('assets/template/src/plugins/src/mousetrap/mousetrap.min.js') }}"></script>
<script src="{{ asset('assets/template/src/plugins/src/waves/waves.min.js') }}"></script>
<script src="{{ asset('assets/template/layouts/horizontal-dark-menu/app.js') }}"></script>

<script src="{{ asset('assets/template/src/plugins/src/global/vendors.min.js') }}"></script>
<script src="{{ asset('assets/template/src/assets/js/custom.js') }}"></script>
<!-- END GLOBAL MANDATORY SCRIPTS -->

<script src="{{ asset('assets/system/js/libs/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('assets/system/js/libs/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('assets/system/js/shared/functions.js') }}"></script>

<script>
    feather.replace();
</script>

@yield('script-aux')


<script>
    window.addEventListener('swal', function (e) {
        Swal.fire(e.detail);
        setTimeout(() => {
            window.location.reload();
        }, 5000);
    });

    window.addEventListener('swal2', function (e) {
        Swal.fire(e.detail);
    });

    window.addEventListener('closeModal', function (e) {
        $(".fecharModal").click();
    });
</script>