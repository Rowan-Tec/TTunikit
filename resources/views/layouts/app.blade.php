<!doctype html>
<html
  lang="en"
  class="layout-navbar-fixed layout-menu-fixed layout-compact"
  dir="ltr"
  data-skin="default"
  data-assets-path="../../assets/"
  data-template="vertical-menu-template"
  data-bs-theme="light">

@include('partials.head')

<body>

<div class="layout-wrapper layout-content-navbar">
  <div class="layout-container">

    <!-- Sidebar -->
    @include('partials.sidebar')

    <div class="layout-page">

      <!-- Navbar -->
      @include('partials.navbar')

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

</body>
</html>