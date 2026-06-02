<style>
/* Combined sticky top header*/
.top-header {
  position: sticky;
  top: 0;
  z-index: 1080; /* higher than content, lower than modals */
  background: var(--bs-body-bg);
}

/* Horizontal menu hover*/
.horizontal-menu {
  display: flex;
  gap: 1.25rem;
}

/* Menu item container */
.horizontal-menu .menu-item {
  position: relative;
}

/* Top‑level menu link */
.horizontal-menu .menu-link {
  display: flex;
  align-items: center;
  gap: 0.35rem;
  padding: 0.5rem 0.75rem;
  cursor: pointer;
  font-weight: 500;
  color: var(--bs-body-color);
  text-decoration: none;
}

/* Dropdown container */
.horizontal-menu .menu-sub {
  display: none;
  position: absolute;
  top: 100%;
  left: 0;
  min-width: 240px;
  background: var(--bs-body-bg);
  border-radius: 0.375rem;
  box-shadow: 0 0.5rem 1rem rgba(0,0,0,.15);
  z-index: 1085;
}

/* Hover behavior */
.horizontal-menu .menu-item:hover > .menu-sub {
  display: block;
}

/* Dropdown items */
.horizontal-menu .menu-sub a {
  display: block;
  padding: 0.5rem 1rem;
  color: var(--bs-body-color);
  text-decoration: none;
}

.horizontal-menu .menu-sub a:hover {
  background: var(--bs-secondary-bg);
}

</style>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- Title (only if page defines it) --}}
    @hasSection('title')
        <title>@yield('title')</title>
    @endif

    {{-- Meta description (only if page defines it) --}}
    @hasSection('description')
        <meta name="description" content="@yield('description')">
    @endif

    {{-- Meta keywords (only if page defines it) --}}
    @hasSection('keywords')
        <meta name="keywords" content="@yield('keywords')">
    @endif

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon/favicon.ico') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/fontawesome.css') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans&display=swap" rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/iconify-icons.css') }}">

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/node-waves/node-waves.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/pickr/pickr-themes.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/core.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}">

    <!-- Vendors -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/apex-charts/apex-charts.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/swiper/swiper.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/flag-icons.css') }}">

    <!-- Page CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/cards-advance.css') }}">

    <!-- Helpers -->
    <script src="{{ asset('assets/vendor/js/helpers.js') }}"></script>

    <!-- Config -->
    <script src="{{ asset('assets/js/config.js') }}"></script>

    {{-- Extra page-specific CSS --}}
    @stack('styles')
</head>
