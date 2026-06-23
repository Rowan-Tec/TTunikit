
<!doctype html>

<html
  lang="en"
  class="layout-navbar-fixed layout-menu-fixed layout-compact"
  dir="ltr"
  data-skin="default"
  data-assets-path="../../assets/"
  data-template="vertical-menu-template-no-customizer-starter"
  data-bs-theme="light">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Demo: Page 2 - Starter Kit | Vuexy - Bootstrap Dashboard PRO</title>

    <meta name="description" content="" />

    <!-- Favicon -->
<link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon/favicon.ico') }}" />

<!-- CSS -->
<link rel="stylesheet" href="{{ asset('assets/vendor/fonts/iconify-icons.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/node-waves/node-waves.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/css/core.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />

<!-- Head JS -->
<script src="{{ asset('assets/vendor/js/helpers.js') }}"></script>
<script src="{{ asset('assets/js/config.js') }}"></script>
  </head>

  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->

        
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->

        

          <!-- / Navbar -->

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="py-4 mb-6">EDIT APPLICATION</h4>

               <!-- Changing STATUS -->
                <div class="col-md" style="width: 600px;">
                  <div class="card">
                    <h5 class="card-header">CHANGE AND GIVE FEEDBACK</h5>
                    <div class="card-body">
                      <form class="browser-default-validation" action="{{route('update', $application->id)}}" method="POST">
                       
                        @csrf
                        @method('PUT')

                        <div class="mb-6">
                          <label class="form-label" for="basic-default-country">STATUS</label>
                          <select class="form-select" id="basic-default-country" name="status" required>
                            <option value="">Update Status</option>
                            <option value="payment_pending" 
                                {{ $application->status == 'payment_pending' ? 'selected' : '' }}>
                                 Payment Pending
                            </option>
                            <option value="under_review"
                                 {{ $application->status == 'under_review' ? 'selected' : '' }}>
                                 Under Review
                            </option>
                            <option value="Rejected"
                                {{ $application->status == 'rejected' ? 'selected' : '' }}>
                                Rejected
                            </option>
                            <option value="Approved"
                                {{ $application->status == 'approved' ? 'selected' : '' }}>
                                Approved
                            </option>
                          </select>
                        </div>
                        
                        <div class="mb-6">
                          <label class="form-label" for="basic-default-bio">NOTE</label>
                          <textarea
                            class="form-control"
                            id="basic-default-bio"
                            name="notes"
                            rows="3"
                            placeholder="Write feedback for the student..."
                            required> {{ $application->notes }}
                        </textarea>
                        </div>
                        <div class="row">
                          <div class="col-12">
                            <button type="submit" class="btn btn-primary">UPDATE</button>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
                <!-- /CHANGE STATUS -->
        
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

   <!-- Bottom JS -->
<script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/popper/popper.js') }}"></script>
<script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/node-waves/node-waves.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/hammer/hammer.js') }}"></script>
<script src="{{ asset('assets/vendor/js/menu.js') }}"></script>
<script src="{{ asset('assets/js/main.js') }}"></script>

    <!-- Page JS -->
  </body>
</html>
