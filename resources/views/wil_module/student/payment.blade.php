
<!doctype html>

<html
  lang="en"
  class="layout-navbar-fixed layout-wide"
  dir="ltr"
  data-skin="default"
  data-assets-path="../../assets/"
  data-template="front-pages"
  data-bs-theme="light">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Make Payment</title>

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

    <link rel="stylesheet" href="../../assets/vendor/css/pages/front-page.css" />

    <!-- Vendors CSS -->

    <!-- endbuild -->

    <!-- Page CSS -->

    <link rel="stylesheet" href="../../assets/vendor/css/pages/front-page-payment.css" />

    <!-- Helpers -->
    <script src="../../assets/vendor/js/helpers.js"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->

    <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
    <script src="../../assets/vendor/js/template-customizer.js"></script>

    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->

    <script src="../../assets/js/front-config.js"></script>

    <style>
      .student-card {
      background: #f0f5ff;
      border-radius: 10px;
      padding: 14px 18px;
      display: flex;
      align-items: center;
      gap: 14px;
    }

    .avatar {
      width: 44px;
      height: 44px;
      border-radius: 50%;
      background: #cfe2ff;
      color: #0d6efd;
      font-weight: 600;
      font-size: 15px;
      display: flex;
      align-items: center;
      justify-content: center;
      flex-shrink: 0;
    }
    </style>

  </head>

  <body>
    <script src="../../assets/vendor/js/dropdown-hover.js"></script>
    <script src="../../assets/vendor/js/mega-dropdown.js"></script>
            <!-- Navbar: Start -->

          
          <!-- Navbar: End -->

    <!-- Sections:Start -->

    <section class="section-py bg-body first-section-pt">
      <div class="container">
        <div class="card px-3">
          <div class="row">
            <div class="col-lg-7 card-body border-end p-md-8">
              <h4 class="mb-2">WIL Application - Admin Fee</h4>
              <p class="mb-0">
                Complete your Work Integrated Learning application by paying the once-off admin fee below.
              </p>
              <br>
            <div class="student-card">
            <div class="avatar">{{ substr(Auth::user()->full_name,0,1) }}{{ substr(Auth::user()->surname,0,1) }}</div> 
            <div>
              <p class="mb-0 fw-semibold" style="font-size:15px;">{{ Auth::user()->full_name }}  {{Auth::user()->surname}}</p>
              <p class="mb-0 text-muted" style="font-size:13px;">{{$application->student_number}} &middot; {{Auth::user()->email}}</p>
            </div>
          </div>
              <div class="row g-5 py-8">
                <div class="col-md col-lg-12 col-xl-6">
                  <div class="form-check custom-option custom-option-basic checked">
                    <label
                      class="form-check-label custom-option-content form-check-input-payment"
                      for="customRadioVisa">
                      <input
                        name="customRadioTemp"
                        class="form-check-input mt-2"
                        type="radio"
                        value="credit-card"
                        id="customRadioVisa"
                        checked />
                      <span class="custom-option-body">
                        <img
                          src="../../assets/img/icons/payments/visa-light.png"
                          alt="visa-card"
                          width="58"
                          data-app-light-img="icons/payments/visa-light.png"
                          data-app-dark-img="icons/payments/visa-dark.png" />
                        <span class="ms-4 fw-medium text-heading">Credit Card</span>
                      </span>
                    </label>
                  </div>
                </div>
                <div class="col-md col-lg-12 col-xl-6">
                  <div class="form-check custom-option custom-option-basic">
                    <label
                      class="form-check-label custom-option-content form-check-input-payment"
                      for="customRadioPaypal">
                      <input
                        name="customRadioTemp"
                        class="form-check-input mt-2"
                        type="radio"
                        value="paypal"
                        id="customRadioPaypal" />
                      <span class="custom-option-body">
                        <img
                          src="../../assets/img/icons/payments/paypal-light.png"
                          alt="paypal"
                          width="58"
                          data-app-light-img="icons/payments/paypal-light.png"
                          data-app-dark-img="icons/payments/paypal-dark.png" />
                        <span class="ms-4 fw-medium text-heading">Paypal</span>
                      </span>
                    </label>
                  </div>
                </div>
              </div>
              
              <div id="form-credit-card">
                <h4 class="mt-8 mb-6">Credit Card Info</h4>
                <form>
                  <div class="row g-6">
                    <div class="col-12">
                      <label class="form-label" for="billings-card-num">Card number</label>
                      <div class="input-group input-group-merge">
                        <input
                          type="text"
                          id="billings-card-num"
                          class="form-control billing-card-mask"
                          placeholder="7465 8374 5837 5067"
                          aria-describedby="paymentCard" />
                        <span class="input-group-text cursor-pointer p-1" id="paymentCard"
                          ><span class="card-type"></span
                        ></span>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <label class="form-label" for="billings-card-name">Name</label>
                      <input type="text" id="billings-card-name" class="form-control" placeholder="John Doe" />
                    </div>
                    <div class="col-md-3">
                      <label class="form-label" for="billings-card-date">EXP. Date</label>
                      <input
                        type="text"
                        id="billings-card-date"
                        class="form-control billing-expiry-date-mask"
                        placeholder="MM/YY" />
                    </div>
                    <div class="col-md-3">
                      <label class="form-label" for="billings-card-cvv">CVV</label>
                      <input
                        type="text"
                        id="billings-card-cvv"
                        class="form-control billing-cvv-mask"
                        maxlength="3"
                        placeholder="965" />
                    </div>
                  </div>
                </form>
              </div>
            </div>
            <div class="col-lg-5 card-body p-md-8">
              <h4 class="mb-2">Processing Payment</h4>
              <p class="mb-8">
                It can help you manage and speed up your application,<br />
                 after fulfilment.
              </p>
              <div class="bg-lighter p-6 rounded">
                <p>Admin Fee — Once-off payment</p>
                <div class="d-flex align-items-center mb-4">
                  <h1 class="text-heading mb-0">R900<span style="font-size: 25px;">.00</span></h1>
                </div>
                <div class="collapse d-grid">
                  <button
                    type="button"
                    data-bs-target="#pricingModal"
                    data-bs-toggle="modal"
                    class="collapse btn btn-label-primary">
                    Change Plan
                  </button>
                </div>
              </div>
              <div class="mt-5">
                <div class="d-flex justify-content-between align-items-center">
                  <p class="mb-0">Admin Fee</p>
                  <h6 class="mb-0">R900.00</h6>
                </div>
                <div class="d-flex justify-content-between align-items-center mt-2">
                  <p class="mb-0">VAT (0%)</p>
                  <h6 class="mb-0">R0.00</h6>
                </div>
                <hr />
                <div class="d-flex justify-content-between align-items-center mt-4 pb-1">
                  <p class="mb-0"><b>Total Due</b></p>
                  <h6 class="mb-0"><b>R900.00</b></h6>
                </div>
                <div class="d-grid mt-5">
                  <button class="btn btn-success">
                    <span class="me-2">Proceed with Payment</span>
                    <i class="icon-base ti tabler-arrow-right scaleX-n1-rtl"></i>
                  </button>
                </div>

                <p class="mt-8">
                  By continuing, you accept to our Terms of Services and Privacy Policy. Please note that payments are
                  non-refundable.
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Modal -->
    <!-- Pricing Modal -->
    <div class="modal fade" id="pricingModal" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-xl modal-simple modal-pricing">
        <div class="modal-content">
          <div class="modal-body">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <!-- Pricing Plans -->
            <div class="rounded-top">
              <h4 class="text-center mb-2">Pricing Plans</h4>
              <p class="text-center mb-0">
                All plans include 40+ advanced tools and features to boost your product. Choose the best plan to fit
                your needs.
              </p>
              <div class="d-flex align-items-center justify-content-center flex-wrap gap-2 pt-12 pb-4">
                <label class="switch switch-sm ms-sm-12 ps-sm-12 me-0">
                  <span class="switch-label fs-6 text-body">Monthly</span>
                  <input type="checkbox" class="switch-input price-duration-toggler" checked />
                  <span class="switch-toggle-slider">
                    <span class="switch-on"></span>
                    <span class="switch-off"></span>
                  </span>
                  <span class="switch-label fs-6 text-body">Annually</span>
                </label>
                <div class="mt-n5 ms-n10 ml-2 mb-12 d-none d-sm-flex align-items-center gap-1">
                  <i class="icon-base ti tabler-corner-left-down icon-lg text-body-secondary scaleX-n1-rtl"></i>
                  <span class="badge badge-sm bg-label-primary rounded-1 mb-2">Save up to 10%</span>
                </div>
              </div>

              <div class="row gy-6">
                <!-- Basic -->
                <div class="col-xl mb-md-0">
                  <div class="card border rounded shadow-none">
                    <div class="card-body pt-12 p-5">
                      <div class="mt-3 mb-5 text-center">
                        <img
                          src="../../assets/img/illustrations/page-pricing-basic.png"
                          alt="Basic Image"
                          height="120" />
                      </div>
                      <h4 class="card-title text-center text-capitalize mb-1">Basic</h4>
                      <p class="text-center mb-5">A simple start for everyone</p>
                      <div class="text-center h-px-50">
                        <div class="d-flex justify-content-center">
                          <sup class="h6 text-body pricing-currency mt-2 mb-0 me-1">$</sup>
                          <h1 class="mb-0 text-primary">0</h1>
                          <sub class="h6 text-body pricing-duration mt-auto mb-1">/month</sub>
                        </div>
                      </div>

                      <ul class="list-group ps-6 my-5 pt-9">
                        <li class="mb-4">100 responses a month</li>
                        <li class="mb-4">Unlimited forms and surveys</li>
                        <li class="mb-4">Unlimited fields</li>
                        <li class="mb-4">Basic form creation tools</li>
                        <li class="mb-0">Up to 2 subdomains</li>
                      </ul>

                      <button type="button" class="btn btn-label-success d-grid w-100" data-bs-dismiss="modal">
                        Your Current Plan
                      </button>
                    </div>
                  </div>
                </div>

                <!-- Pro -->
                <div class="col-xl mb-md-0">
                  <div class="card border-primary border shadow-none">
                    <div class="card-body position-relative pt-4 p-5">
                      <div class="position-absolute end-0 me-5 top-0 mt-4">
                        <span class="badge bg-label-primary rounded-1">Popular</span>
                      </div>
                      <div class="my-5 pt-6 text-center">
                        <img
                          src="../../assets/img/illustrations/page-pricing-standard.png"
                          alt="Standard Image"
                          height="120" />
                      </div>
                      <h4 class="card-title text-center text-capitalize mb-1">Standard</h4>
                      <p class="text-center mb-5">For small to medium businesses</p>
                      <div class="text-center h-px-50">
                        <div class="d-flex justify-content-center">
                          <sup class="h6 text-body pricing-currency mt-2 mb-0 me-1">$</sup>
                          <h1 class="price-toggle price-yearly text-primary mb-0">7</h1>
                          <h1 class="price-toggle price-monthly text-primary mb-0 d-none">9</h1>
                          <sub class="h6 text-body pricing-duration mt-auto mb-1">/month</sub>
                        </div>
                        <small class="price-yearly price-yearly-toggle text-body-secondary">USD 480 / year</small>
                      </div>

                      <ul class="list-group ps-6 my-5 pt-9">
                        <li class="mb-4">Unlimited responses</li>
                        <li class="mb-4">Unlimited forms and surveys</li>
                        <li class="mb-4">Instagram profile page</li>
                        <li class="mb-4">Google Docs integration</li>
                        <li class="mb-0">Custom “Thank you” page</li>
                      </ul>

                      <button type="button" class="btn btn-primary d-grid w-100" data-bs-dismiss="modal">
                        Upgrade
                      </button>
                    </div>
                  </div>
                </div>

                <!-- Enterprise -->
                <div class="col-xl">
                  <div class="card border rounded shadow-none">
                    <div class="card-body pt-12 p-5">
                      <div class="mt-3 mb-5 text-center">
                        <img
                          src="../../assets/img/illustrations/page-pricing-enterprise.png"
                          alt="Enterprise Image"
                          height="120" />
                      </div>
                      <h4 class="card-title text-center text-capitalize mb-1">Enterprise</h4>
                      <p class="text-center mb-5">Solution for big organizations</p>

                      <div class="text-center h-px-50">
                        <div class="d-flex justify-content-center">
                          <sup class="h6 text-body pricing-currency mt-2 mb-0 me-1">$</sup>
                          <h1 class="price-toggle price-yearly text-primary mb-0">16</h1>
                          <h1 class="price-toggle price-monthly text-primary mb-0 d-none">19</h1>
                          <sub class="h6 text-body pricing-duration mt-auto mb-1">/month</sub>
                        </div>
                        <small class="price-yearly price-yearly-toggle text-body-secondary">USD 960 / year</small>
                      </div>

                      <ul class="list-group ps-6 my-5 pt-9">
                        <li class="mb-4">PayPal payments</li>
                        <li class="mb-4">Logic Jumps</li>
                        <li class="mb-4">File upload with 5GB storage</li>
                        <li class="mb-4">Custom domain support</li>
                        <li class="mb-0">Stripe integration</li>
                      </ul>

                      <button type="button" class="btn btn-label-primary d-grid w-100" data-bs-dismiss="modal">
                        Upgrade
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!--/ Pricing Plans -->
          </div>
        </div>
      </div>
    </div>
    <!--/ Pricing Modal -->
    <script src="../../assets//js/pages-pricing.js"></script>
    <!-- /Modal -->

    <!-- / Sections:End -->

    <!-- Footer: Start -->
    
    <!-- Footer: End -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/theme.js -->

    <script src="../../assets/vendor/libs/popper/popper.js"></script>
    <script src="../../assets/vendor/js/bootstrap.js"></script>
    <script src="../../assets/vendor/libs/node-waves/node-waves.js"></script>

    <script src="../../assets/vendor/libs/@algolia/autocomplete-js.js"></script>

    <script src="../../assets/vendor/libs/pickr/pickr.js"></script>

    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="../../assets/vendor/libs/cleave-zen/cleave-zen.js"></script>

    <!-- Main JS -->

    <script src="../../assets/js/front-main.js"></script>

    <!-- Page JS -->
    <script src="../../assets/js/pages-pricing.js"></script>
    <script src="../../assets/js/front-page-payment.js"></script>
  </body>
</html>
