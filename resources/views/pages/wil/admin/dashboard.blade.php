
<!doctype html>

<html
  lang="en"
  class="layout-navbar-fixed layout-menu-fixed layout-compact"
  dir="ltr"
  data-skin="default"
  data-assets-path="../../assets/"
  data-template="vertical-menu-template"
  data-bs-theme="light">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

      {{-- 👇 Add this line --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Admin Dashboard</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../../assets/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&ampdisplay=swap"
      rel="stylesheet" />

    <link rel="stylesheet" href="../../assets/vendor/fonts/iconify-icons.css" />

    <!-- Core CSS -->
    <!-- build:css assets/vendor/css/theme.css  -->

    <link rel="stylesheet" href="../../assets/vendor/libs/node-waves/node-waves.css" />

    <link rel="stylesheet" href="../../assets/vendor/libs/pickr/pickr-themes.css" />

    <link rel="stylesheet" href="../../assets/vendor/css/core.css" />
    <link rel="stylesheet" href="../../assets/css/demo.css" />

    <!-- Vendors CSS -->

    <link rel="stylesheet" href="../../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <!-- endbuild -->

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="../../assets/vendor/js/helpers.js"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->

    <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
    <script src="../../assets/vendor/js/template-customizer.js"></script>

    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->

    <script src="../../assets/js/config.js"></script>
  </head>

  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->

        <aside id="layout-menu" class="layout-menu menu-vertical menu">
          <div class="app-brand demo">
            <a href="index.html" class="app-brand-link">
              <span class="app-brand-logo demo">
                <span class="text-primary">
                  <svg width="32" height="22" viewBox="0 0 32 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                      fill-rule="evenodd"
                      clip-rule="evenodd"
                      d="M0.00172773 0V6.85398C0.00172773 6.85398 -0.133178 9.01207 1.98092 10.8388L13.6912 21.9964L19.7809 21.9181L18.8042 9.88248L16.4951 7.17289L9.23799 0H0.00172773Z"
                      fill="currentColor" />
                    <path
                      opacity="0.06"
                      fill-rule="evenodd"
                      clip-rule="evenodd"
                      d="M7.69824 16.4364L12.5199 3.23696L16.5541 7.25596L7.69824 16.4364Z"
                      fill="#161616" />
                    <path
                      opacity="0.06"
                      fill-rule="evenodd"
                      clip-rule="evenodd"
                      d="M8.07751 15.9175L13.9419 4.63989L16.5849 7.28475L8.07751 15.9175Z"
                      fill="#161616" />
                    <path
                      fill-rule="evenodd"
                      clip-rule="evenodd"
                      d="M7.77295 16.3566L23.6563 0H32V6.88383C32 6.88383 31.8262 9.17836 30.6591 10.4057L19.7824 22H13.6938L7.77295 16.3566Z"
                      fill="currentColor" />
                  </svg>
                </span>
              </span>
              <span class="app-brand-text demo menu-text fw-bold ms-3">Vuexy</span>
            </a>

            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
              <i class="icon-base ti menu-toggle-icon d-none d-xl-block"></i>
              <i class="icon-base ti tabler-x d-block d-xl-none"></i>
            </a>
          </div>

          <div class="menu-inner-shadow"></div>

          <ul class="menu-inner py-1">
            <!-- Dashboards -->
            <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon icon-base ti tabler-smart-home"></i>
                <div data-i18n="Applications">Applications</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item">
                  <button class="menu-link border-0 bg-transparent w-100 text-start"
                       type="button"
                      data-bs-toggle="collapse"
                      data-bs-target="#appAvail">
                      <div data-i18n="Total Wil Application">Total Wil Application</div>
                 </button>
                </li>
                <li class="menu-item">
                  <button class="menu-link border-0 bg-transparent w-100 text-start"
                       type="button"
                      data-bs-toggle="collapse"
                      data-bs-target="#approvedApp">
                      <div data-i18n="Approved Applications">Approved Applications</div>
                 </button>   
                </li>
                <li class="menu-item">
                  <button class="menu-link border-0 bg-transparent w-100 text-start"
                       type="button"
                      data-bs-toggle="collapse"
                      data-bs-target="#rejectedApp">
                      <div data-i18n="Rejected Application">Rejected Application</div>
                 </button>
                </li>
                <li class="menu-item">
                  <button class="menu-link border-0 bg-transparent w-100 text-start"
                       type="button"
                      data-bs-toggle="collapse"
                      data-bs-target="#reviewApp">
                      <div data-i18n="Pending Reviews">Pending Reviews</div>
                 </button>
                </li>
              </ul>
            </li>

            <!-- Layouts -->
            <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon icon-base ti tabler-layout-sidebar"></i>
                <div data-i18n="Payments">Payments</div>
              </a>

              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="layouts-collapsed-menu.html" class="menu-link">
                    <div data-i18n="Settled Payment Students">Settled Payment Students</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="layouts-content-navbar.html" class="menu-link">
                    <div data-i18n="Unsettled Payment Students">Unsettled Payment Students</div>
                  </a>
                </li>
              </ul>
            </li>

            <!-- Front Pages -->
            <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon icon-base ti tabler-files"></i>
                <div data-i18n="User Management">User Management</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item">
                  <button class="menu-link border-0 bg-transparent w-100 text-start"
                      type="button"
                      data-bs-toggle="collapse"
                      data-bs-target="#viewUsers">
                      <div data-i18n="View Users">View Users</div>
                 </button>
                </li>
                <li class="menu-item">

       <button class="menu-link border-0 bg-transparent w-100 text-start"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#statsCard">

        <div data-i18n="Edit User Roles">
            Edit User Roles
        </div>

    </button>

</li>
              </ul>
            </li>

            <!-- Call Requests -->
<li class="menu-item">
  <a href="javascript:void(0);" class="menu-link menu-toggle">
    <i class="menu-icon icon-base ti tabler-phone-incoming"></i>
    <div data-i18n="Call Requests">Call Requests</div>
  </a>
  <ul class="menu-sub">
    <li class="menu-item">
      <button class="menu-link border-0 bg-transparent w-100 text-start"
           type="button"
          data-bs-toggle="collapse"
          data-bs-target="#callRequests">
          <div data-i18n="All Call Requests">All Call Requests</div>
     </button>
    </li>
  </ul>
</li>

  
          </ul>
        </aside>

        <div class="menu-mobile-toggler d-xl-none rounded-1">
          <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large text-bg-secondary p-2 rounded-1">
            <i class="ti tabler-menu icon-base"></i>
            <i class="ti tabler-chevron-right icon-base"></i>
          </a>
        </div>
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->

          <nav
            class="layout-navbar container-xxl navbar-detached navbar navbar-expand-xl align-items-center bg-navbar-theme"
            id="layout-navbar">
            <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
              <a class="nav-item nav-link px-0 me-xl-6" href="javascript:void(0)">
                <i class="icon-base ti tabler-menu-2 icon-md"></i>
              </a>
            </div>

            <div class="navbar-nav-right d-flex align-items-center justify-content-end" id="navbar-collapse">
              <!-- Search -->
              <div class="navbar-nav align-items-center">
                <div class="nav-item navbar-search-wrapper px-md-0 px-2 mb-0">
                  <a class="nav-item nav-link search-toggler d-flex align-items-center px-0" href="javascript:void(0);">
                    <span class="d-inline-block text-body-secondary fw-normal" id="autocomplete"></span>
                  </a>
                </div>
              </div>

              <!-- /Search -->

              <ul class="navbar-nav flex-row align-items-center ms-md-auto">
                <li class="nav-item dropdown-language dropdown">
                  <a
                    class="nav-link dropdown-toggle hide-arrow btn btn-icon btn-text-secondary rounded-pill"
                    href="javascript:void(0);"
                    data-bs-toggle="dropdown">
                    <i class="icon-base ti tabler-language icon-22px text-heading"></i>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                      <a class="dropdown-item" href="javascript:void(0);" data-language="en" data-text-direction="ltr">
                        <span>English</span>
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item" href="javascript:void(0);" data-language="fr" data-text-direction="ltr">
                        <span>French</span>
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item" href="javascript:void(0);" data-language="ar" data-text-direction="rtl">
                        <span>Arabic</span>
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item" href="javascript:void(0);" data-language="de" data-text-direction="ltr">
                        <span>German</span>
                      </a>
                    </li>
                  </ul>
                </li>
                <!--/ Language -->

                <!-- Style Switcher -->
                <li class="nav-item dropdown">
                  <a
                    class="nav-link dropdown-toggle hide-arrow btn btn-icon btn-text-secondary rounded-pill"
                    id="nav-theme"
                    href="javascript:void(0);"
                    data-bs-toggle="dropdown">
                    <i class="icon-base ti tabler-sun icon-22px theme-icon-active text-heading"></i>
                    <span class="d-none ms-2" id="nav-theme-text">Toggle theme</span>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="nav-theme-text">
                    <li>
                      <button
                        type="button"
                        class="dropdown-item align-items-center active"
                        data-bs-theme-value="light"
                        aria-pressed="false">
                        <span><i class="icon-base ti tabler-sun icon-22px me-3" data-icon="sun"></i>Light</span>
                      </button>
                    </li>
                    <li>
                      <button
                        type="button"
                        class="dropdown-item align-items-center"
                        data-bs-theme-value="dark"
                        aria-pressed="true">
                        <span
                          ><i class="icon-base ti tabler-moon-stars icon-22px me-3" data-icon="moon-stars"></i
                          >Dark</span
                        >
                      </button>
                    </li>
                    <li>
                      <button
                        type="button"
                        class="dropdown-item align-items-center"
                        data-bs-theme-value="system"
                        aria-pressed="false">
                        <span
                          ><i
                            class="icon-base ti tabler-device-desktop-analytics icon-22px me-3"
                            data-icon="device-desktop-analytics"></i
                          >System</span
                        >
                      </button>
                    </li>
                  </ul>
                </li>
                <!-- / Style Switcher-->

                <!-- Quick links  -->
                <li class="nav-item dropdown-shortcuts navbar-dropdown dropdown">
                  <a
                    class="nav-link dropdown-toggle hide-arrow btn btn-icon btn-text-secondary rounded-pill"
                    href="javascript:void(0);"
                    data-bs-toggle="dropdown"
                    data-bs-auto-close="outside"
                    aria-expanded="false">
                    <i class="icon-base ti tabler-layout-grid-add icon-22px text-heading"></i>
                  </a>
                  <div class="dropdown-menu dropdown-menu-end p-0">
                    <div class="dropdown-menu-header border-bottom">
                      <div class="dropdown-header d-flex align-items-center py-3">
                        <h6 class="mb-0 me-auto">Shortcuts</h6>
                        <a
                          href="javascript:void(0)"
                          class="dropdown-shortcuts-add py-2 btn btn-text-secondary rounded-pill btn-icon"
                          data-bs-toggle="tooltip"
                          data-bs-placement="top"
                          title="Add shortcuts"
                          ><i class="icon-base ti tabler-plus icon-20px text-heading"></i
                        ></a>
                      </div>
                    </div>
                    <div class="dropdown-shortcuts-list scrollable-container">
                      <div class="row row-bordered overflow-visible g-0">
                        <div class="dropdown-shortcuts-item col">
                          <span class="dropdown-shortcuts-icon rounded-circle mb-3">
                            <i class="icon-base ti tabler-calendar icon-26px text-heading"></i>
                          </span>
                          <a href="app-calendar.html" class="stretched-link">Calendar</a>
                          <small>Appointments</small>
                        </div>
                        <div class="dropdown-shortcuts-item col">
                          <span class="dropdown-shortcuts-icon rounded-circle mb-3">
                            <i class="icon-base ti tabler-file-dollar icon-26px text-heading"></i>
                          </span>
                          <a href="app-invoice-list.html" class="stretched-link">Invoice App</a>
                          <small>Manage Accounts</small>
                        </div>
                      </div>
                      <div class="row row-bordered overflow-visible g-0">
                        <div class="dropdown-shortcuts-item col">
                          <span class="dropdown-shortcuts-icon rounded-circle mb-3">
                            <i class="icon-base ti tabler-icon-26px text-heading"></i>
                          </span>
                          <a href="app-user-list.html" class="stretched-link">User App</a>
                          <small>Manage Users</small>
                        </div>
                        <div class="dropdown-shortcuts-item col">
                          <span class="dropdown-shortcuts-icon rounded-circle mb-3">
                            <i class="icon-base ti tabler-users icon-26px text-heading"></i>
                          </span>
                          <a href="app-access-roles.html" class="stretched-link">Role Management</a>
                          <small>Permission</small>
                        </div>
                      </div>
                      <div class="row row-bordered overflow-visible g-0">
                        <div class="dropdown-shortcuts-item col">
                          <span class="dropdown-shortcuts-icon rounded-circle mb-3">
                            <i class="icon-base ti tabler-device-desktop-analytics icon-26px text-heading"></i>
                          </span>
                          <a href="index.html" class="stretched-link">Dashboard</a>
                          <small>User Dashboard</small>
                        </div>
                        <div class="dropdown-shortcuts-item col">
                          <span class="dropdown-shortcuts-icon rounded-circle mb-3">
                            <i class="icon-base ti tabler-settings icon-26px text-heading"></i>
                          </span>
                          <a href="pages-account-settings-account.html" class="stretched-link">Setting</a>
                          <small>Account Settings</small>
                        </div>
                      </div>
                      <div class="row row-bordered overflow-visible g-0">
                        <div class="dropdown-shortcuts-item col">
                          <span class="dropdown-shortcuts-icon rounded-circle mb-3">
                            <i class="icon-base ti tabler-help-circle icon-26px text-heading"></i>
                          </span>
                          <a href="pages-faq.html" class="stretched-link">FAQs</a>
                          <small>FAQs & Articles</small>
                        </div>
                        <div class="dropdown-shortcuts-item col">
                          <span class="dropdown-shortcuts-icon rounded-circle mb-3">
                            <i class="icon-base ti tabler-square icon-26px text-heading"></i>
                          </span>
                          <a href="modal-examples.html" class="stretched-link">Modals</a>
                          <small>Useful Popups</small>
                        </div>
                      </div>
                    </div>
                  </div>
                </li>
                <!-- Quick links -->

                <!-- Notification -->
                <li class="nav-item dropdown-notifications navbar-dropdown dropdown me-3 me-xl-2">
    <a class="nav-link dropdown-toggle hide-arrow btn btn-icon btn-text-secondary rounded-pill"
        href="javascript:void(0);"
        data-bs-toggle="dropdown"
        data-bs-auto-close="outside"
        aria-expanded="false">
        <span class="position-relative">
            <i class="icon-base ti tabler-bell icon-22px text-heading"></i>
            @if(auth()->user()->unreadNotifications->count() > 0)
                <span class="badge rounded-pill bg-danger badge-dot badge-notifications border">
                    {{ auth()->user()->unreadNotifications->count() }}
                </span>
            @endif
        </span>
    </a>
    <ul class="dropdown-menu dropdown-menu-end p-0">
        <li class="dropdown-menu-header border-bottom">
            <div class="dropdown-header d-flex align-items-center py-3">
                <h6 class="mb-0 me-auto">Notifications</h6>
                <div class="d-flex align-items-center h6 mb-0">
                    @if(auth()->user()->unreadNotifications->count() > 0)
                        <span class="badge bg-label-primary me-2">
                            {{ auth()->user()->unreadNotifications->count() }} New
                        </span>
                        <a href="{{ route('admin.notifications.read') }}"
                            class="p-2 btn btn-icon"
                            data-bs-toggle="tooltip"
                            title="Mark all as read">
                            <i class="icon-base ti tabler-mail-opened text-heading"></i>
                        </a>
                    @endif
                </div>
            </div>
        </li>
        <li class="dropdown-notifications-list scrollable-container">
            <ul class="list-group list-group-flush">
                @forelse(auth()->user()->notifications->take(8) as $notification)
                <li class="list-group-item list-group-item-action dropdown-notifications-item
                    {{ $notification->read_at ? 'marked-as-read' : '' }}">
                    <div class="d-flex">
                        <div class="flex-shrink-0 me-3">
                            <div class="avatar">
                                <span class="avatar-initial rounded-circle
                                    bg-label-{{
                                        $notification->data['type'] === 'payment'     ? 'success' :
                                        ($notification->data['type'] === 'approved'   ? 'success' :
                                        ($notification->data['type'] === 'rejected'   ? 'danger'  :
                                        ($notification->data['type'] === 'application'? 'primary'  : 'info')))
                                    }}">
                                    <i class="icon-base ti {{
                                        $notification->data['type'] === 'payment'     ? 'tabler-credit-card' :
                                        ($notification->data['type'] === 'approved'   ? 'tabler-check'       :
                                        ($notification->data['type'] === 'rejected'   ? 'tabler-x'           :
                                        ($notification->data['type'] === 'application'? 'tabler-file'        : 'tabler-bell')))
                                    }}"></i>
                                </span>
                            </div>
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="small mb-1">{{ $notification->data['title'] }}</h6>
                            <small class="mb-1 d-block text-body">
                                {{ $notification->data['message'] }}
                            </small>
                            <small class="text-body-secondary">
                                {{ $notification->created_at->diffForHumans() }}
                            </small>
                        </div>
                        <div class="flex-shrink-0">
                        <form action="{{ route('notifications.delete', $notification->id) }}" method="POST">
                           @csrf
                           @method('DELETE')
                         <button class="btn btn-sm btn-icon text-danger" title="Delete">
                             ✖
                         </button>
                         </form>
                        </div>
                    </div>
                </li>
                @empty
                <li class="list-group-item text-center text-muted py-4">
                    No notifications yet.
                </li>
                @endforelse
            </ul>
        </li>
        <li class="border-top">
            <div class="d-grid p-4">
                <a class="btn btn-primary btn-sm" href="{{ route('admin.notifications.read') }}">
                    <small class="align-middle">Mark all as read</small>
                </a>
            </div>
        </li>
    </ul>
</li>
                <!--/ Notification -->

                <!-- User -->
                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                  <a
                    class="nav-link dropdown-toggle hide-arrow p-0"
                    href="javascript:void(0);"
                    data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                      <img src="../../assets/img/avatars/1.png" alt class="rounded-circle" />
                    </div>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                      <a class="dropdown-item mt-0" href="pages-account-settings-account.html">
                        <div class="d-flex align-items-center">
                          <div class="flex-shrink-0 me-2">
                            <div class="avatar avatar-online">
                              <img src="../../assets/img/avatars/1.png" alt class="rounded-circle" />
                            </div>
                          </div>
                          <div class="flex-grow-1">
                            <h6 class="mb-0">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</h6>
                            <small class="text-body-secondary">Admin</small>
                          </div>
                        </div>
                      </a>
                    </li>
                    <li>
                      <div class="dropdown-divider my-1 mx-n2"></div>
                    </li>
                    <li>
                      <a class="dropdown-item" href="pages-profile-user.html">
                        <i class="icon-base ti tabler-user me-3 icon-md"></i
                        ><span class="align-middle">My Profile</span>
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item" href="pages-account-settings-account.html">
                        <i class="icon-base ti tabler-settings me-3 icon-md"></i
                        ><span class="align-middle">Settings</span>
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item" href="pages-account-settings-billing.html">
                        <span class="d-flex align-items-center align-middle">
                          <i class="flex-shrink-0 icon-base ti tabler-file-dollar me-3 icon-md"></i
                          ><span class="flex-grow-1 align-middle">Billing</span>
                          <span class="flex-shrink-0 badge bg-danger d-flex align-items-center justify-content-center"
                            >4</span
                          >
                        </span>
                      </a>
                    </li>
                    <li>
                      <div class="dropdown-divider my-1 mx-n2"></div>
                    </li>
                    <li>
                      <a class="dropdown-item" href="pages-pricing.html">
                        <i class="icon-base ti tabler-currency-dollar me-3 icon-md"></i
                        ><span class="align-middle">Pricing</span>
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item" href="pages-faq.html">
                        <i class="icon-base ti tabler-question-mark me-3 icon-md"></i
                        ><span class="align-middle">FAQ</span>
                      </a>
                    </li>
                    <li>
                      <div class="d-grid px-2 pt-2 pb-1">
                        <form method="POST" action="{{ route('logout') }}">
    @csrf
    <a class="dropdown-item" href="#"
        onclick="event.preventDefault(); this.closest('form').submit();">
        <i class="icon-base ti tabler-power icon-md me-3"></i><span>Log Out</span>
    </a>
</form>
                      </div>
                    </li>
                  </ul>
                </li>
                <!--/ User -->
              </ul>
            </div>
          </nav>

          <!-- / Navbar -->

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">
            
              <!-- STATS-->
            <div class="card mb-6">
                <div class="card-widget-separator-wrapper">
                  <div class="card-body card-widget-separator">
                    <div class="row gy-4 gy-sm-1">
                      <!-- ROW ONE -->
                      <div class="col-sm-6 col-lg-4">
                        <div
                          class="d-flex justify-content-between align-items-center card-widget-1 border-end pb-4 pb-sm-0">
                          <div>
                            <h4 class="mb-0">{{ $appCount }}</h4>
                            <p class="mb-0">Wil Applications</p>
                          </div>
                          <div class="avatar me-sm-6">
                            <span class="avatar-initial rounded bg-label-secondary text-heading">
                              <i class="icon-base ti tabler-user icon-26px"></i>
                            </span>
                          </div>
                        </div>
                        <hr class="d-none d-sm-block d-lg-none me-6" />
                      </div>
                      <div class="col-sm-6 col-lg-4">
                        <div
                          class="d-flex justify-content-between align-items-center card-widget-2 border-end pb-4 pb-sm-0">
                          <div>
                            <h4 class="mb-0">{{ $approveCount }}</h4>
                            <p class="mb-0">Approved</p>
                          </div>
                          <div class="avatar me-lg-6">
                            <span class="avatar-initial rounded bg-label-secondary text-heading">
                               <i class="icon-base ti tabler-circle-check icon-26px" style="color:green;"></i>
                            </span>
                          </div>
                        </div>
                        <hr class="d-none d-sm-block d-lg-none" />
                      </div>
                      <div class="col-sm-6 col-lg-4">
                        <div
                          class="d-flex justify-content-between align-items-center border-end pb-4 pb-sm-0 card-widget-3">
                          <div>
                            <h4 class="mb-0">{{ $rejected }}</h4>
                            <p class="mb-0">Rejected</p>
                          </div>
                          <div class="avatar me-sm-6">
                            <span class="avatar-initial rounded bg-label-secondary text-heading">
                              <i class="icon-base ti tabler-x icon-26px" style="color:red;"></i>
                            </span>
                          </div>
                        </div>
                      </div>
                      <!--ROW TWO-->
                      <div class="col-sm-6 col-lg-4">
                        <div
                          class="d-flex justify-content-between align-items-center card-widget-1 border-end pb-4 pb-sm-0">
                          <div>
                            <h4 class="mb-0">{{ $totalStudents }}</h4>
                            <p class="mb-0">Users</p>
                          </div>
                          <div class="avatar me-sm-6">
                            <span class="avatar-initial rounded bg-label-secondary text-heading">
                              <i class="icon-base ti tabler-users icon-26px"></i>
                            </span>
                          </div>
                        </div>
                        <hr class="d-none d-sm-block d-lg-none me-6" />
                      </div>
                      <div class="col-sm-6 col-lg-4">
                        <div
                          class="d-flex justify-content-between align-items-center card-widget-1 border-end pb-4 pb-sm-0">
                          <div>
                            <h4 class="mb-0">{{ $underReview }}</h4>
                            <p class="mb-0">Under Review</p>
                          </div>
                          <div class="avatar me-sm-6">
                            <span class="avatar-initial rounded bg-label-secondary text-heading">
                              <i class="icon-base ti tabler-eye icon-26px"></i>
                            </span>
                          </div>
                        </div>
                        <hr class="d-none d-sm-block d-lg-none me-6" />
                      </div>
                      <div class="col-sm-6 col-lg-4">
                        <div
                          class="d-flex justify-content-between align-items-center card-widget-1 border-end pb-4 pb-sm-0">
                          <div>
                            <h4 class="mb-0">{{ $pendingPayment }}</h4>
                            <p class="mb-0">Pending Payment</p>
                          </div>
                          <div class="avatar me-sm-6">
                            <span class="avatar-initial rounded bg-label-secondary text-heading">
                              <i class="icon-base ti tabler-clock icon-26px"></i>
                            </span>
                          </div>
                        </div>
                        <hr class="d-none d-sm-block d-lg-none me-6" />
                      </div>
                      

                    </div>
                  </div>
                </div>
              </div>
              <!-- STATS -->

              

            
              <!-- Responsive Table For Users Available-->
<div class="collapse card" id="viewUsers">

  <h5 class="card-header">
    Users Table
  </h5>

  <div class="table-responsive text-nowrap">

    <table class="table">

      <thead>

        <tr class="text-nowrap">

          <th>#</th>
          <th>Full Name</th>
          <th>Surname</th>
          <th>Email</th>
          <th>Username</th>
          <th>Cellphone</th>
          <th>Gender</th>
          <th>Role</th>
          <th>Created</th>

        </tr>

      </thead>

      <tbody class="table-border-bottom-0">

        @forelse($users as $user)

          <tr>

            <th scope="row">
              {{ $loop->iteration }}
            </th>

            <td>{{ $user->first_name }}</td>

            <td>{{ $user->last_name }}</td>

            <td>{{ $user->email }}</td>

            <td>{{ $user->username }}</td>

            <td>{{ $user->cellphone }}</td>

            <td>{{ $user->gender }}</td>

            <td>

              <span class="badge bg-label-primary">
                {{ $user->role }}
              </span>

            </td>

            <td>
              {{ $user->created_at->format('d M Y') }}
            </td>

          </tr>

        @empty

          <tr>

            <td colspan="9" class="text-center">

              No users found

            </td>

          </tr>

        @endforelse

      </tbody>

    </table>

  </div>

</div>
<!--/ Responsive Table -->
<!-- Responsive Table For Applications Available-->
              <div class="collapse card" style="margin-top: 15px;" id="appAvail">
                <h5 class="card-header">ALL APPLICATIONS</h5>
                <div class="table-responsive text-nowrap">
                  <table class="table">
                    <thead>
                      <tr class="text-nowrap">
                        <th scope="row">
                         #
                       </th>
                        <th>APPLICATION ID</th>
                        <th>SURNAME</th>
                        <th>INSTITUTION</th>
                        <th>FIELD OF STUDY</th>
                        <th>FACULTY</th>
                        <th>STATUS</th>
                        <th>APPLICATION DATE</th>
                        <th>DOCUMENTS</th>
                        <th>ACTIONS</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                    @forelse($applications as $application)
                      <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $application->id }}</td>
                        <td>{{ $application->user->last_name }}
                             {{substr($application->user->first_name, 0, 1)}}</td>
                        <td>{{ $application->institution }}</td>
                        <td>{{ $application->field_of_study }}</td>
                        <td>{{ $application->faculty }}</td>
                        <td>{{ $application->status }}</td>
                        <td>{{ $application->created_at->format('d M Y') }}</td>
                        <td>

                             <a href="{{ route('document_review', $application->id) }}"
                               class="btn btn-sm btn-primary">

                                Review

                            </a>

                        </td>
                        <td>

  <div class="dropdown">

    <button type="button"
            class="btn p-0 dropdown-toggle hide-arrow"
            data-bs-toggle="dropdown">

      <i class="icon-base ti tabler-dots-vertical"></i>

    </button>

    <div class="dropdown-menu">

      <!-- Edit -->

      <a class="dropdown-item"
         href="{{ route('edit_application', $application->id) }}">

        <i class="icon-base ti tabler-pencil me-1"></i>

        Edit

      </a>

      <!-- Delete -->

      <form action="{{ route('destroy', $application->id)}}"
            method="POST">

        @csrf
        @method('DELETE')

        <button type="submit"
                class="dropdown-item text-danger"
                onclick="return confirm('Delete this application?')">

          <i class="icon-base ti tabler-trash me-1"></i>

          Delete

        </button>

         </form>

        </div>

      </div>

    </td>
                      </tr>
                      
                  @empty

                        <tr>

                         <td colspan="9" class="text-center">

                           No users found

                         </td>

                           </tr>

                   @endforelse
                    </tbody>
                  </table>
                </div>
              </div>
              <!--/ Responsive Table -->

 

              <!--/ Responsive Table -->
<!-- Responsive Table For Approved Applications-->
              <div class="collapse card" style="margin-top: 15px;" id="approvedApp">
                <h5 class="card-header">APPROVED APPLICATIONS</h5>
                <div class="table-responsive text-nowrap">
                  <table class="table">
                    <thead>
                      <tr class="text-nowrap">
                        <th scope="row">
                         #
                       </th>
                        <th>APPLICATION ID</th>
                        <th>SURNAME</th>
                        <th>INSTITUTION</th>
                        <th>FIELD OF STUDY</th>
                        <th>FACULTY</th>
                        <th>STATUS</th>
                        <th>APPLICATION DATE</th>
                        <th>DOCUMENTS</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                    @forelse($approvedApps as $approvedApp)
                      <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $approvedApp->id }}</td>
                        <td>{{ $approvedApp->user->last_name }}
                             {{substr($approvedApp->user->first_name, 0, 1)}}</td>
                        <td>{{ $approvedApp->institution }}</td>
                        <td>{{ $approvedApp->field_of_study }}</td>
                        <td>{{ $approvedApp->faculty }}</td>
                        <td>{{ $approvedApp->status }}</td>
                        <td>{{ $approvedApp->created_at->format('d M Y') }}</td>
                        <td>

                             <a href="{{ route('document_review', $application->id) }}"
                               class="btn btn-sm btn-primary">

                                Review

                            </a>

                        </td>
                      </tr>
                      
                  @empty

                        <tr>

                         <td colspan="9" class="text-center">

                           No approved applications found

                         </td>

                           </tr>

                   @endforelse
                    </tbody>
                  </table>
                </div>
              </div>
              <!--/ Responsive Table -->


              <!--/ Responsive Table -->
<!-- Responsive Table For Rejected Applications-->
              <div class="collapse   card" style="margin-top: 15px;" id="rejectedApp">
                <h5 class="card-header">REJECTED APPLICATIONS</h5>
                <div class="table-responsive text-nowrap">
                  <table class="table">
                    <thead>
                      <tr class="text-nowrap">
                        <th scope="row">
                         #
                       </th>
                        <th>APPLICATION ID</th>
                        <th>SURNAME</th>
                        <th>INSTITUTION</th>
                        <th>FIELD OF STUDY</th>
                        <th>FACULTY</th>
                        <th>STATUS</th>
                        <th>APPLICATION DATE</th>
                        <th>DOCUMENTS</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                    @forelse($rejectedApps as $rejectedApp)
                      <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $rejectedApp->id }}</td>
                        <td>{{ $rejectedApp->user->last_name }}
                             {{substr($rejectedApp->user->first_name, 0, 1)}}</td>
                        <td>{{ $rejectedApp->institution }}</td>
                        <td>{{ $rejectedApp->field_of_study }}</td>
                        <td>{{ $rejectedApp->faculty }}</td>
                        <td>{{ $rejectedApp->status }}</td>
                        <td>{{ $rejectedApp->created_at->format('d M Y') }}</td>
                        <td>

                             <a href="{{ route('document_review', $application->id) }}"
                               class="btn btn-sm btn-primary">

                                Review

                            </a>

                        </td>
                      </tr>
                      
                  @empty

                        <tr>

                         <td colspan="9" class="text-center">

                           No rejected applications found

                         </td>

                           </tr>

                   @endforelse
                    </tbody>
                  </table>
                </div>
              </div>
              <!--/ Responsive Table -->


              <!--/ Responsive Table -->
<!-- Responsive Table For Under Review Applications-->
              <div class="collapse card" style="margin-top: 15px;" id="reviewApp">
                <h5 class="card-header">UNDER REVIEW APPLICATIONS</h5>
                <div class="table-responsive text-nowrap">
                  <table class="table">
                    <thead>
                      <tr class="text-nowrap">
                        <th scope="row">
                         #
                       </th>
                        <th>APPLICATION ID</th>
                        <th>SURNAME</th>
                        <th>INSTITUTION</th>
                        <th>FIELD OF STUDY</th>
                        <th>FACULTY</th>
                        <th>STATUS</th>
                        <th>APPLICATION DATE</th>
                        <th>DOCUMENTS</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                    @forelse($reviewApps as $reviewApp)
                      <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $reviewApp->user_id }}</td>
                        <td>{{ $reviewApp->user->last_name }}
                             {{substr($reviewApp->user->first_name, 0, 1)}}</td>
                        <td>{{ $reviewApp->institution }}</td>
                        <td>{{ $reviewApp->field_of_study }}</td>
                        <td>{{ $reviewApp->faculty }}</td>
                        <td>{{ $reviewApp->status }}</td>
                        <td>{{ $reviewApp->created_at->format('d M Y') }}</td>
                        <td>

                             <a href="{{ route('document_review', $application->id) }}"
                               class="btn btn-sm btn-primary">

                                Review

                            </a>

                        </td>
                      </tr>
                      
                  @empty

                        <tr>

                         <td colspan="9" class="text-center">

                           No Under Review applications found

                         </td>

                           </tr>

                   @endforelse
                    </tbody>
                  </table>
                </div>
              </div>
              <!--/ Responsive Table -->



              <!-- Call Requests Table -->
<div class="collapse card" style="margin-top: 15px;" id="callRequests">
  <h5 class="card-header d-flex justify-content-between align-items-center">
    CALL REQUESTS
    <span class="badge bg-label-danger">
      {{ $pendingCallRequests }} Pending
    </span>
  </h5>
  <div class="table-responsive text-nowrap">
    <table class="table">
      <thead>
        <tr class="text-nowrap">
          <th>#</th>
          <th>NAME</th>
          <th>PHONE NUMBER</th>
          <th>STATUS</th>
          <th>REQUESTED AT</th>
          <th>CALLED AT</th>
          <th>ACTIONS</th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">
        @forelse($callRequests as $callRequest)
          <tr>
            <th scope="row">{{ $loop->iteration }}</th>
            <td>{{ $callRequest->name }}</td>
            <td>{{ $callRequest->phone }}</td>
            <td>
              <span class="badge bg-label-{{ 
                $callRequest->status === 'pending'   ? 'warning' : 
                ($callRequest->status === 'called'   ? 'success' : 'danger') 
              }}">
                {{ ucfirst($callRequest->status) }}
              </span>
            </td>
            <td>{{ $callRequest->created_at->format('d M Y H:i') }}</td>
            <td>{{ $callRequest->called_at ? $callRequest->called_at->format('d M Y H:i') : '—' }}</td>
            <td>
              @if($callRequest->status === 'pending')
                <form action="{{ route('admin.call-requests.mark-called', $callRequest->id) }}" method="POST">
                  @csrf
                  @method('PATCH')
                  <button type="submit" class="btn btn-sm btn-success">
                    <i class="icon-base ti tabler-phone-check me-1"></i> Mark as Called
                  </button>
                </form>
              @else
                <span class="text-muted">—</span>
              @endif
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="6" class="text-center">No call requests yet</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
<!-- / Call Requests Table -->




            </div>
            <!-- / Content -->

            

            <!-- Footer -->
            
            <!-- / Footer -->

            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>

      <!-- Drag Target Area To SlideIn Menu On Small Screens -->
      <div class="drag-target"></div>
    </div>
    <!-- / Layout wrapper -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/theme.js -->

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

    <!-- endbuild -->

    <!-- Vendors JS -->

    <!-- Main JS -->

    <script src="../../assets/js/main.js"></script>

    <!-- Page JS -->

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
