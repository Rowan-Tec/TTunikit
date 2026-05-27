<nav class="layout-navbar navbar navbar-expand-xl align-items-center bg-navbar-theme dropdown-menu" id="layout-navbar" >
          <div class="container-xxl" >
              <a href="{{ auth()->check() ? route('dashboard') : url('/') }}" class="app-brand-link">
                <img src="https://www.ttunikit.co.za/assets/img/branding/TTwebbrand.png" alt="Logo" data-app-dark-img="branding/TTwebbrand.png" class="navbar-logo" height="65" style="visibility: visible;">
              </a>
            <div class="navbar-brand app-brand demo d-none d-xl-flex py-0 me-4">
            

              <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-xl-none">
                <i class="ti ti-x ti-md align-middle"></i>
              </a>
            </div>

            <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
              <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                <i class="ti ti-menu-2 ti-md"></i>
              </a>
            </div>
            <div class="navbar-nav-center d-flex align-items-center d-none d-xl-flex">
            <li>
              <a><span><i class="fa-solid fa-location-dot"></i></span> Tirelo Business Park, Mabulela Atok (HQ) | <span><i class="fa-solid fa-phone"></i></span> Tel: 015 619 0072 | <span><i class="fa-brands fa-whatsapp"></i></span> 061 486 5651</a>
             </li>
             <li><span class="me-3"></span>
                <a href="https://www.linkedin.com/company/ttunikit" target="_blank" data-theme="light">
                  <span class="align-middle ml-2 me-3" style="color:#ccc;"> <i class="fa-brands fa-linkedin-in"></i></span>
                </a>
              </li>
              <li>
                <a href="https://www.facebook.com/ttunikit" target="_blank" data-theme="light">
                  <span class="align-middle me-3" style="color:#ccc;"> <i class="fa-brands fa-facebook-f"></i></span>
                </a>
              </li>
              <li>
                <a href="https://www.instagram.com/ttunikit" target="_blank" data-theme="light">
                  <span class="align-middle me-3" style="color:#ccc;"><i class="fa-brands fa-instagram"></i></span>
                </a>
              </li>
                  <li>
                <a href="https://www.twitter.com/ttunikit" target="_blank" data-theme="light">
                  <span class="align-middle me-3" style="color:#ccc;"><i class="fa-brands fa-twitter"></i></span>
                </a>
              </li>
            </div>

            <div class="d-flex align-items-center" id="navbar-collapse">
              <ul class="navbar-nav flex-row align-items-center ms-auto">
                <!-- Style Switcher -->
                <!-- <li class="nav-item dropdown-style-switcher dropdown">
                  <a class="nav-link btn btn-text-secondary btn-icon rounded-pill dropdown-toggle hide-arrow waves-effect waves-light" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <i class="ti ti-md ti-moon-stars"></i>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-styles">
                    <li>
                      <a class="dropdown-item waves-effect active" href="javascript:void(0);" data-theme="light">
                        <span class="align-middle"><i class="ti ti-sun ti-md me-3"></i>Light</span>
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item waves-effect" href="javascript:void(0);" data-theme="dark">
                        <span class="align-middle"><i class="ti ti-moon-stars ti-md me-3"></i>Dark</span>
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item waves-effect" href="javascript:void(0);" data-theme="system">
                        <span class="align-middle"><i class="ti ti-device-desktop-analytics ti-md me-3"></i>System</span>
                      </a>
                    </li>
                  </ul>
                </li> -->
                <!-- / Style Switcher-->
            <li>
              @auth
                <a href="{{ route('dashboard') }}" class="btn btn-primary waves-effect waves-light">
                  <span class="tf-icons icon-base ti tabler-layout-dashboard scaleX-n1-rtl me-md-1"></span>
                  <span class="d-none d-md-block">Dashboard</span>
                </a>
              @else
                <a href="{{ route('login') }}" class="btn btn-primary waves-effect waves-light">
                  <span class="tf-icons icon-base ti tabler-login scaleX-n1-rtl me-md-1"></span>
                  <span class="d-none d-md-block">Login/Register</span>
                </a>
              @endauth
            </li>
                                </ul>
            </div>

            <!-- Search Small Screens -->
            <div class="navbar-search-wrapper search-input-wrapper container-xxl d-none">
              <span class="twitter-typeahead" style="position: relative; display: inline-block;"><input type="text" class="form-control search-input border-0 tt-input container-xxl" placeholder="Search..." aria-label="Search..." autocomplete="off" spellcheck="false" dir="auto" style="position: relative; vertical-align: top;"><pre aria-hidden="true" style="position: absolute; visibility: hidden; white-space: pre; font-family: &quot;Public Sans&quot;, -apple-system, BlinkMacSystemFont, &quot;Segoe UI&quot;, &quot;Oxygen&quot;, &quot;Ubuntu&quot;, &quot;Cantarell&quot;, &quot;Fira Sans&quot;, &quot;Droid Sans&quot;, &quot;Helvetica Neue&quot;, sans-serif; font-size: 15px; font-style: normal; font-variant: normal; font-weight: 400; word-spacing: 0px; letter-spacing: 0px; text-indent: 0px; text-rendering: optimizelegibility; text-transform: none;"></pre><div class="tt-menu navbar-search-suggestion ps" style="position: absolute; top: 100%; left: 0px; z-index: 100; display: none;"><div class="tt-dataset tt-dataset-pages"></div><div class="tt-dataset tt-dataset-files"></div><div class="tt-dataset tt-dataset-members"></div><div class="ps__rail-x" style="left: 0px; bottom: 0px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 0px; right: 0px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div></div></div></span>
                <i class="ti ti-x search-toggler cursor-pointer"></i>
            </div>
          </div>
        </nav>
