<!-- Libs JS -->
<script src="{{ asset('assets/new-template/dist/libs/apexcharts/dist/apexcharts.min.js?1692870487') }}" defer></script>
<script src="{{ asset('assets/new-template/dist/libs/jsvectormap/dist/js/jsvectormap.min.js?1692870487') }}" defer></script>
<script src="{{ asset('assets/new-template/dist/libs/jsvectormap/dist/maps/world.js?1692870487') }}" defer></script>
<script src="{{ asset('assets/new-template/dist/libs/jsvectormap/dist/maps/world-merc.js?1692870487') }}" defer></script>
<!-- Tabler Core -->
<script src="{{ asset('assets/new-template/dist/js/tabler.min.js?1692870487') }}" defer></script>
<script src="{{ asset('assets/new-template/dist/js/demo.min.js?1692870487') }}" defer></script>
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<script src="{{ asset('assets/system/js/libs/jquery/jquery.min.js') }}"></script>

<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>

<script src="{{ asset('assets/system/js/libs/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('assets/system/js/shared/functions.js') }}"></script>

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