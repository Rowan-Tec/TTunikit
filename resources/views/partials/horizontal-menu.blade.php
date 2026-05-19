<style>
#horizontal-menu,
#horizontal-menu .container-xxl,
#horizontal-menu .menu-inner {
  overflow: visible !important;
}

#horizontal-menu .menu-item {
  position: relative;
}

#horizontal-menu .menu-sub {
  display: none;
  position: absolute;
  top: 100%;
  left: 0;
  z-index: 1050;
}

#horizontal-menu .menu-item:hover > .menu-sub {
  display: block;
}
</style>
<!-- horizontal Menu -->
<nav id="horizontal-menu" class="menu-horizontal menu bg-menu-theme w-100 border-bottom">
  <div class="container-xxl">
    <ul class="menu-inner d-flex align-items-center flex-nowrap">

      <!-- Business Finance -->
      <li class="menu-item">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
          <i class="menu-icon icon-base ti tabler-shopping-cart"></i>
          <div>Online Shop</div>
        </a>
        <ul class="menu-sub">
               <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link">
              <i class="menu-icon icon-base ti tabler-shopping-cart"></i>
              <div>Shop</div>
            </a>
          </li>
          <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link">
              <i class="menu-icon icon-base ti tabler-layout-grid"></i>
              <div>Product Categories</div>
            </a>
          </li>
          <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link">
              <i class="menu-icon icon-base ti tabler-tag"></i>
              <div>Browse all Brands</div>
            </a>
          </li>
          <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link">
              <i class="menu-icon icon-base ti tabler-percentage"></i>
              <div>Promotions</div>
            </a>
          </li>
        </ul>
      </li>

      <!-- Financial Services -->
      <li class="menu-item">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
          <i class="menu-icon icon-base ti tabler-tool"></i>
          <div>Computer Repairs</div>
        </a>
        <ul class="menu-sub">
          <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link">
              <i class="menu-icon icon-base ti tabler-settings"></i>
              <div>Hardware Repairs</div>
            </a>
          </li>
          <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link">
              <i class="menu-icon icon-base ti tabler-code"></i>
              <div>Computer Software</div>
            </a>
          </li>
          <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link">
              <i class="menu-icon icon-base ti tabler-app-window"></i>
              <div>Applications</div>
            </a>
          </li>
          <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link">
              <i class="menu-icon icon-base ti tabler-device-laptop"></i>
              <div>Screen Replacement</div>
            </a>
          </li>
          <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link">
              <i class="menu-icon icon-base ti tabler-arrow-up-circle"></i>
              <div>PC Upgrade</div>
            </a>
          </li>
        </ul>
      </li>

      <!-- Marketplace -->

      <li class="menu-item">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
          <i class="menu-icon icon-base ti tabler-code"></i>
          <div>Website Development</div>
        </a>
        <ul class="menu-sub">
          <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link">
              <i class="menu-icon icon-base ti tabler-browser"></i>
              <div>Web Applications</div>
            </a>
          </li>
          <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link">
              <i class="menu-icon icon-base ti tabler-building-store"></i>
              <div>Business Website</div>
            </a>
          </li>
          <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link">
              <i class="menu-icon icon-base ti tabler-user"></i>
              <div>Personal Website</div>
            </a>
          </li>
          <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link">
              <i class="menu-icon icon-base ti tabler-shopping-cart"></i>
              <div>Ecommerce Website</div>
            </a>
          </li>
        </ul>
      </li>

      <!-- Personal Finance -->
      <li class="menu-item">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
          <i class="menu-icon icon-base ti tabler-network"></i>
          <div>Networking & Cabling</div>
        </a>
        <ul class="menu-sub">
          <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link">
              <i class="menu-icon icon-base ti tabler-sitemap"></i>
              <div>Network Design</div>
            </a>
          </li>
          <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link">
              <i class="menu-icon icon-base ti tabler-plug"></i>
              <div>Network Cabling</div>
            </a>
          </li>
            <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link">
              <i class="menu-icon icon-base ti tabler-wifi"></i>
              <div>Fibre Installation</div>
            </a>
          </li>
            <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link">
              <i class="menu-icon icon-base ti tabler-server"></i>
              <div>Inhouse Server Design</div>
            </a>
          </li>
        </ul>
      </li>

      <!-- TECHNICAL SUPPORT -->
     
      <li class="menu-item">
  <a href="javascript:void(0);" class="menu-link menu-toggle">
    <i class="menu-icon icon-base ti tabler-headset"></i>
    <div>Technical Support</div>
  </a>

  <ul class="menu-sub">

    <li class="menu-item">
      <a href="#" class="menu-link">
        <i class="menu-icon icon-base ti tabler-tool"></i>
        <div>Onsite Technical Support</div>
      </a>
    </li>

    <li class="menu-item">
      <a href="#" class="menu-link">
        <i class="menu-icon icon-base ti tabler-file-text"></i>
        <div>Service Level Agreement</div>
      </a>
    </li>

    <li class="menu-item">
      <a href="#" class="menu-link">
        <i class="menu-icon icon-base ti tabler-headset"></i>
        <div>Remote Support</div>
      </a>
    </li>

    <li class="menu-item">
      <a href="#" class="menu-link">
        <i class="menu-icon icon-base ti tabler-server"></i>
        <div>Web Hosting</div>
      </a>
    </li>

    <li class="menu-item">
      <a href="#" class="menu-link">
        <i class="menu-icon icon-base ti tabler-shield-lock"></i>
        <div>Cyber Security</div>
      </a>
    </li>

  </ul>
</li>

      <!-- Contacts -->

      <li class="menu-item">
  <a href="javascript:void(0);" class="menu-link menu-toggle">
    <i class="menu-icon icon-base ti tabler-phone"></i>
    <div>Contacts</div>
  </a>

  <ul class="menu-sub">

    <li class="menu-item">
      <a href="#" class="menu-link">
        <i class="menu-icon icon-base ti tabler-ticket"></i>
        <div>Open a Ticket</div>
      </a>
    </li>

    <li class="menu-item">
      <a href="#" class="menu-link">
        <i class="menu-icon icon-base ti tabler-message"></i>
        <div>Live Chat</div>
      </a>
    </li>

    <li class="menu-item">
      <a href="#" class="menu-link">
        <i class="menu-icon icon-base ti tabler-calendar-event"></i>
        <div>Book Appointment</div>
      </a>
    </li>

  </ul>
</li>

    </ul>
  </div>
</nav>
<!-- /Horizontal Menu -->
