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
<script src="{{ asset('assets/system/js/libs/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('assets/system/js/shared/functions.js') }}"></script>

@yield('script-aux')

<script defer>

    document.addEventListener('livewire:load', function () {

        window.addEventListener('swal', function (e) {
            Swal.fire(e.detail);
            setTimeout(() => {
                window.location.reload();
            }, 5000);
        });

        window.addEventListener('swal2', function (e) {
            Swal.fire(e.detail);
        });

        window.addEventListener('closeModal', function () {
            $(".fecharModal").click();
        });

    });
</script>