<!doctype html>
<html
  lang="en"
  class="layout-menu-fixed layout-menu-collapsed"
  dir="ltr"
  data-skin="default"
  data-assets-path="../../assets/"
  data-template="vertical-menu-template"
  data-bs-theme="dark">

@include('partials.head')

<body>

<div class="layout-wrapper layout-content-navbar">
  <div class="layout-container">

    <!-- Sidebar -->
    @include('partials.sidebar')

    <div class="layout-page">

     @include('partials.top-header')

      <!-- Content -->
      <div class="content-wrapper">
          @yield('content')
      </div>
      @include('partials.footer')

    </div>
  </div>

  <div class="layout-overlay layout-menu-toggle"></div>
  <div class="drag-target"></div>
</div>

<!-- JS -->
<script src="../../assets/vendor/libs/jquery/jquery.js"></script>
<script src="../../assets/vendor/libs/popper/popper.js"></script>
<script src="../../assets/vendor/js/bootstrap.js"></script>
<script src="../../assets/vendor/libs/node-waves/node-waves.js"></script>
<script src="../../assets/vendor/libs/@algolia/autocomplete-js.js"></script>
<script src="../../assets/vendor/libs/pickr/pickr.js"></script>
<script src="../../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
<script src="../../assets/vendor/libs/hammer/hammer.js"></script>
<script src="../../assets/vendor/libs/i18n/i18n.js"></script>
<script src="../../assets/vendor/js/menu.js"></script>

<script src="../../assets/vendor/libs/apex-charts/apexcharts.js"></script>
<script src="../../assets/vendor/libs/swiper/swiper.js"></script>
<script src="../../assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js"></script>

<script src="../../assets/js/main.js"></script>
<script src="../../assets/js/dashboards-analytics.js"></script>

{{-- In your layout blade file --}}
@vite(['resources/css/app.css', 'resources/js/app.js'])

<!-- Toastr Notifications -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        @if(session('success'))
            toastr.success("{{ session('success') }}");
        @endif

        @if(session('error'))
            toastr.error("{{ session('error') }}");
        @endif

        @if(session('warning'))
            toastr.warning("{{ session('warning') }}");
        @endif

        @if(session('info'))
            toastr.info("{{ session('info') }}");
        @endif
    });
</script>

</body>
</html>