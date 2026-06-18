@extends('layouts.app')
@section('title', 'TT UNIK IT SOLUTIONS | Work Integrated Learning')
@section('description', 'TT UNIK IT SOLUTIONS provide Work Integrated Learning which is designed for ICT, MEDIA, FINANCE AND BUSINESS ADMINISTRATION. ')
@section('keywords', 'Work Integrated Learning, WIL, TUT WIL, UNISA WIL, UJ WIL')
@section('content')

<style>
    
    
element {
}
.layout-page, .content-wrapper, .content-wrapper > *, .layout-menu {
  min-block-size: 1px;
}
@media (min-width: 768px) {
  .col-md1 {
    flex: 1 0 0%;

    padding-top: 55px !important;
  }
  
 
 .bg-primary {
  --bs-bg-opacity: 1;
  background-color: rgb(21, 20, 28) !important;
  border:1px solid #6c6c6c;
}

.btn-outline-light {
  --bs-btn-color: #fff;
  --bs-btn-border-color: var(--bs-light);
}


.btn-primary {
  --bs-btn-bg: #16379a !important;
  --bs-btn-color: var(--bs-primary-contrast);
  --bs-btn-border-color: #a7a7ab !important;
}  
.bg-light {
  --bs-bg-opacity: 1;
  background-color: rgb(21, 20, 28) !important;
}
</style>

<div class="content-wrapper">
            <!-- Content -->
<div class="col-md">

      <div id="carouselExampleDark" class="carousel carousel-dark slide carousel-fade" data-bs-ride="carousel">
        <div class="carousel-indicators">
          <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="" aria-label="Slide 1"></button>
          <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2" class="active" aria-current="true"></button>
          <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2" aria-label="Slide 3" class=""></button>
        </div>
        <div class="carousel-inner">
          <div class="carousel-item">
            <img class="d-block w-100" src="https://www.ttunikit.co.za/assets/img/wil/Work_Integrated_Learning.png" alt="First slide">
            <div class="carousel-caption d-none d-md-block">

            </div>
          </div>
          <div class="carousel-item active">
            <img class="d-block w-100" src="https://www.ttunikit.co.za/assets/img/wil/TTUNIKWIL.png" alt="Second slide">
            <div class="carousel-caption d-none d-md-block">
           
            </div>
          </div>
          <div class="carousel-item">
            <img class="d-block w-100" src="https://www.ttunikit.co.za/assets/img/wil/WIL_SLIDES(1).png" alt="Third slide">
            <div class="carousel-caption d-none d-md-block">
              
            </div>
          </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleDark" role="button" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleDark" role="button" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </a>
      </div>

  <div class="col-md">
      </div>

<!--  ORIGINAL 
<div class="content-wrapper">
    <div class="col-md1">
        <section class="py-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="bg-light border p-4 rounded text-center">

                            <h5 class="fw-bold display-6 mb-3">Call Me Back</h5>

                            <div class="d-flex">
                                <input 
                                    id="phone_number"
                                    aria-label="Telephone Number"
                                    class="form-control me-2" 
                                    placeholder="Telephone Number" 
                                    type="tel"
                                > 
                                <button 
                                    id="callMeBtn"
                                    class="btn btn-primary text-nowrap" 
                                    type="button"
                                    onclick="submitCallRequest()"
                                >
                                    Call Me!
                                </button>
                            </div>

                            {{-- Success Message --}}
                            <div 
                                id="callSuccess" 
                                style="display:none; margin-top:12px; padding:10px 14px; background:#d1fae5; border:1px solid #6ee7b7; border-radius:8px; color:#065f46; font-size:14px; font-weight:500;"
                            >
                                ✅ Thank you! We will call you shortly.
                            </div>

                            {{-- Error Message --}}
                            <div 
                                id="callError" 
                                style="display:none; margin-top:12px; padding:10px 14px; background:#fee2e2; border:1px solid #fca5a5; border-radius:8px; color:#991b1b; font-size:14px; font-weight:500;"
                            >
                                ❌ Please enter a valid phone number.
                            </div>

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="bg-primary p-4 mt-md-0 mt-3 rounded text-center">
                            <h5 class="text-white fw-bold display-6 mb-3">Apply for a WIL</h5>
                            <a class="btn btn-outline-light" href="{{ route('wil_application') }}">
                                Apply and get started today
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div> 

-->

<div class="content-wrapper">
    <div class="col-md1">
        <section class="py-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="bg-light border p-4 rounded text-center">

                            <h5 class="fw-bold display-6 mb-3">Call Me Back</h5>

                            {{-- Success Message --}}
                            @if(session('success'))
                                <div style="margin-bottom:12px; padding:10px 14px; background:#d1fae5; border:1px solid #6ee7b7; border-radius:8px; color:#065f46; font-size:14px; font-weight:500;">
                                    ✅ {{ session('success') }}
                                </div>
                            @endif

                            <form method="POST" action="{{ route('call_request.store') }}">
    @csrf

    <div class="d-flex gap-2 align-items-start">
        {{-- Name --}}
        <div class="flex-grow-1">
            <input
                type="text"
                name="name"
                class="form-control @error('name') is-invalid @enderror"
                placeholder="Your Name"
                value="{{ old('name') }}"
                required
            >
            @error('name')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        {{-- Phone --}}
        <div class="flex-grow-1">
            <input
                type="tel"
                name="phone"
                class="form-control @error('phone') is-invalid @enderror"
                placeholder="Telephone Number"
                value="{{ old('phone') }}"
                required
            >
            @error('phone')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        <button class="btn btn-primary text-nowrap" type="submit">
            Call Me!
        </button>
    </div>
</form>

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="bg-primary p-4 mt-md-0 mt-3 rounded text-center">
                            <h5 class="text-white fw-bold display-6 mb-3">Apply for a WIL</h5>
                            <a class="btn btn-outline-light" href="{{ route('wil_application') }}">
                                Apply and get started today
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>


    
    <div class="content-wrapper">
            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">
       

              <div class="row mt-6">
                <!-- Navigation -->
                <div class="col-lg-3 col-md-4 col-12 mb-md-0 mb-4">
                  <div class="d-flex justify-content-between flex-column nav-align-left mb-2 mb-md-0">
                    <ul class="nav nav-pills flex-column" role="tablist">
                      <li class="nav-item" role="presentation">
                        <button class="nav-link active waves-effect waves-light" data-bs-toggle="tab" data-bs-target="#payment" aria-selected="true" role="tab">
                          <i class="icon-base ti tabler-credit-card icon-sm faq-nav-icon me-1_5"></i>
                          <span class="align-middle">Administration Process</span>
                        </button>
                      </li>
                      <li class="nav-item" role="presentation">
                        <button class="nav-link waves-effect waves-light" data-bs-toggle="tab" data-bs-target="#delivery" aria-selected="false" tabindex="-1" role="tab">
                          <i class="icon-base ti tabler-briefcase icon-sm faq-nav-icon me-1_5"></i>
                          <span class="align-middle">Terms and Conditions</span>
                        </button>
                      </li>
                      <li class="nav-item" role="presentation">
                        <button class="nav-link waves-effect waves-light" data-bs-toggle="tab" data-bs-target="#cancellation" aria-selected="false" tabindex="-1" role="tab">
                          <i class="icon-base ti tabler-rotate-clockwise-2 icon-sm faq-nav-icon me-1_5"></i>
                          <span class="align-middle">What is our WIL offering</span>
                        </button>
                      </li>
                      <li class="nav-item" role="presentation">
                        <button class="nav-link waves-effect waves-light" data-bs-toggle="tab" data-bs-target="#orders" aria-selected="false" tabindex="-1" role="tab">
                          <i class="icon-base ti tabler-box icon-sm faq-nav-icon me-1_5"></i>
                          <span class="align-middle">Why choosing TT UNIK IT SOLUTIONS</span>
                        </button>
                      </li>
                      <li class="nav-item" role="presentation">
                        <button class="nav-link waves-effect waves-light" data-bs-toggle="tab" data-bs-target="#product" aria-selected="false" tabindex="-1" role="tab">
                          <i class="icon-base ti tabler-settings icon-sm faq-nav-icon me-1_5"></i>
                          <span class="align-middle">Contact Information</span>
                        </button>
                      </li>
                    </ul>
                    <div class="d-none d-md-block">
                      <div class="mt-4">
                        <img src="../../assets/img/illustrations/girl-sitting-with-laptop.png" class="img-fluid" width="270" alt="FAQ Image">
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /Navigation -->

                <!-- FAQ's -->
                <div class="col-lg-9 col-md-8 col-12">
                  <div class="tab-content p-0">
                    <div class="tab-pane fade show active" id="payment" role="tabpanel">

                      <div id="accordionPayment" class="accordion">
                        <div class="card accordion-item active">
                          <h2 class="accordion-header">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" aria-expanded="true" data-bs-target="#accordionPayment-1" aria-controls="accordionPayment-1">
                             Onboarding Registration Fees
                            </button>
                          </h2>

                          <div id="accordionPayment-1" class="accordion-collapse collapse show">
                            <div class="accordion-body">
                          TT UNIK IT SOLUTIONS offers a premium Work Integrated Learning (WIL) programme. To enrol, candidates are required to pay a once-off administration fee of R900.
This programme is more than a work integrated learning initiative—it is a platform that equips students and graduates with valuable skills in Information Technology, Media and Broadcasting, Telecommunications, Business Administration, and Finance or Banking.
Our WIL platform unlocks opprotunities of candicates to become employble or starting businesses. 

                            </div>
                          </div>
                        </div>

                        <div class="card accordion-item">
                          <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accordionPayment-2" aria-controls="accordionPayment-2">
                              How do I pay for my Registration Fee?
                          </h2>
                          <div id="accordionPayment-2" class="accordion-collapse collapse">
                            <div class="accordion-body">
                              We accept Visa® and MasterCard® or EFT. Our servers encrypt all
                              information submitted to them, so you can be confident that your credit card information
                              will be kept safe and secure. Our Banking Details are as follows: <br>Bank Name: First National Bank<br> Account Number: 62426701620 <br>Reference: Full Names
                            </div>
                          </div>
                        </div>

                        <div class="card accordion-item">
                          <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accordionPayment-3" aria-controls="accordionPayment-3">
                              How long will it take to get Letter of acceptance after processing a payment?
                            </button>
                          </h2>
                          <div id="accordionPayment-3" class="accordion-collapse collapse">
                            <div class="accordion-body">
                            As we recieve overwhealing number of applications, it is advised to call us on 015 619 0072 or 061 4865 651 after you have made a payment. This will help us to speedup
                            your acceptance letter. 
                            

                            </div>
                          </div>
                        </div>

                        <div class="card accordion-item">
                          <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accordionPayment-4" aria-controls="accordionPayment-4">
                              How will i get my accaptence WIL letter?
                            </button>
                          </h2>
                          <div id="accordionPayment-4" class="accordion-collapse collapse">
                            <div class="accordion-body">
                              The letter will be send through the email you have registered on the system. Please make sure you register with email which you access to be notified with WIL application
                              and other communication related matters. 
                            </div>
                          </div>
                        </div>

                        <div class="card accordion-item">
                          <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accordionPayment-5" aria-controls="accordionPayment-5">
                              Is it compulsory to pay admin fee to be accepeted at TT UNIK IT SOLUTIONS ?
                            </button>
                          </h2>
                          <div id="accordionPayment-5" class="accordion-collapse collapse">
                            <div class="accordion-body">
                            We consider only students who register with us, allowing TT UNIK IT SOLUTIONS experts and mentors to focus their training efforts on candidates who are serious about their careers. Over the years, we have supported students and graduates at no cost.
As our company grows and demand for WIL increases, we have decided to introduce a premium WIL offering that provides extended skills transfer and mentorship.

                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="tab-pane fade" id="delivery" role="tabpanel">
                   
                      <div id="accordionDelivery" class="accordion">
                        <div class="card accordion-item active">
                          <h2 class="accordion-header">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" aria-expanded="true" data-bs-target="#accordionDelivery-1" aria-controls="accordionDelivery-1">
                              How would you ship my order?
                            </button>
                          </h2>

                          <div id="accordionDelivery-1" class="accordion-collapse collapse show">
                            <div class="accordion-body">
                              For large products, we deliver your product via a third party logistics company offering
                              you the “room of choice” scheduled delivery service. For small products, we offer free
                              parcel delivery.
                            </div>
                          </div>
                        </div>

                        <div class="card accordion-item">
                          <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accordionDelivery-2" aria-controls="accordionDelivery-2">
                              What is the delivery cost of my order?
                            </button>
                          </h2>
                          <div id="accordionDelivery-2" class="accordion-collapse collapse">
                            <div class="accordion-body">
                              The cost of scheduled delivery is $69 or $99 per order, depending on the destination
                              postal code. The parcel delivery is free.
                            </div>
                          </div>
                        </div>

                        <div class="card accordion-item">
                          <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accordionDelivery-4" aria-controls="accordionDelivery-4">
                              What to do if my product arrives damaged?
                            </button>
                          </h2>
                          <div id="accordionDelivery-4" class="accordion-collapse collapse">
                            <div class="accordion-body">
                              We will promptly replace any product that is damaged in transit. Just contact our
                              <a href="javascript:void(0);">support team</a>, to notify us of the situation within 48
                              hours of product arrival.
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="tab-pane fade" id="cancellation" role="tabpanel">
                 
                      <div id="accordionCancellation" class="accordion">
                        <div class="card accordion-item active">
                          <h2 class="accordion-header">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" aria-expanded="true" data-bs-target="#accordionCancellation-1" aria-controls="accordionCancellation-1">
                              Can I cancel my order?
                            </button>
                          </h2>

                          <div id="accordionCancellation-1" class="accordion-collapse collapse show">
                            <div class="accordion-body">
                              <p>
                                Scheduled delivery orders can be cancelled 72 hours prior to your selected delivery date
                                for full refund.
                              </p>
                              <p class="mb-0">
                                Parcel delivery orders cannot be cancelled, however a free return label can be provided
                                upon request.
                              </p>
                            </div>
                          </div>
                        </div>

                        <div class="card accordion-item">
                          <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accordionCancellation-2" aria-controls="accordionCancellation-2">
                              Can I return my product?
                            </button>
                          </h2>
                          <div id="accordionCancellation-2" class="accordion-collapse collapse">
                            <div class="accordion-body">
                              You can return your product within 15 days of delivery, by contacting our
                              <a href="javascript:void(0);">support team</a>, All merchandise returned must be in the
                              original packaging with all original items.
                            </div>
                          </div>
                        </div>

                        <div class="card accordion-item">
                          <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" aria-controls="accordionCancellation-3" data-bs-target="#accordionCancellation-3">
                              Where can I view status of return?
                            </button>
                          </h2>
                          <div id="accordionCancellation-3" class="accordion-collapse collapse">
                            <div class="accordion-body">
                              <p>Locate the item from Your <a href="javascript:void(0);">Orders</a></p>
                              <p class="mb-0">Select <span class="fw-medium">Return/Refund</span> status</p>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="tab-pane fade" id="orders" role="tabpanel">
                    
                      <div id="accordionOrders" class="accordion">
                        <div class="card accordion-item active">
                          <h2 class="accordion-header">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" aria-expanded="true" data-bs-target="#accordionOrders-1" aria-controls="accordionOrders-1">
                              Has my order been successful?
                            </button>
                          </h2>

                          <div id="accordionOrders-1" class="accordion-collapse collapse show">
                            <div class="accordion-body">
                              <p>
                                All successful order transactions will receive an order confirmation email once the
                                order has been processed. If you have not received your order confirmation email within
                                24 hours, check your junk email or spam folder.
                              </p>
                              <p class="mb-0">
                                Alternatively, log in to your account to check your order summary. If you do not have a
                                account, you can contact our Customer Care Team on
                                <span class="fw-medium">1-000-000-000</span>.
                              </p>
                            </div>
                          </div>
                        </div>

                        <div class="card accordion-item">
                          <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accordionOrders-2" aria-controls="accordionOrders-2">
                              My Promotion Code is not working, what can I do?
                            </button>
                          </h2>
                          <div id="accordionOrders-2" class="accordion-collapse collapse">
                            <div class="accordion-body">
                              If you are having issues with a promotion code, please contact us at
                              <span class="fw-medium">1 000 000 000</span> for assistance.
                            </div>
                          </div>
                        </div>

                        <div class="card accordion-item">
                          <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accordionOrders-3" aria-controls="accordionOrders-3">
                              How do I track my Orders?
                            </button>
                          </h2>
                          <div id="accordionOrders-3" class="accordion-collapse collapse">
                            <div class="accordion-body">
                              <p>
                                If you have an account just sign into your account from
                                <a href="javascript:void(0);">here</a> and select
                                <span class="fw-medium">“My Orders”</span>.
                              </p>
                              <p class="mb-0">
                                If you have a a guest account track your order from
                                <a href="javascript:void(0);">here</a> using the order number and the email address.
                              </p>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="tab-pane fade" id="product" role="tabpanel">
                
                      <div id="accordionProduct" class="accordion">
                        <div class="card accordion-item active">
                          <h2 class="accordion-header">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" aria-expanded="true" data-bs-target="#accordionProduct-1" aria-controls="accordionProduct-1">
                              Will I be notified once my order has shipped?
                            </button>
                          </h2>

                          <div id="accordionProduct-1" class="accordion-collapse collapse show">
                            <div class="accordion-body">
                              Yes, We will send you an email once your order has been shipped. This email will contain
                              tracking and order information.
                            </div>
                          </div>
                        </div>

                        <div class="card accordion-item">
                          <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accordionProduct-2" aria-controls="accordionProduct-2">
                              Where can I find warranty information?
                            </button>
                          </h2>
                          <div id="accordionProduct-2" class="accordion-collapse collapse">
                            <div class="accordion-body">
                              We are committed to quality products. For information on warranty period and warranty
                              services, visit our Warranty section <a href="javascript:void(0);">here</a>.
                            </div>
                          </div>
                        </div>

                        <div class="card accordion-item">
                          <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accordionProduct-3" aria-controls="accordionProduct-3">
                              How can I purchase additional warranty coverage?
                            </button>
                          </h2>
                          <div id="accordionProduct-3" class="accordion-collapse collapse">
                            <div class="accordion-body">
                              For the peace of your mind, we offer extended warranty plans that add additional year(s)
                              of protection to the standard manufacturer’s warranty provided by us. To purchase or find
                              out more about the extended warranty program, visit Extended Warranty section
                              <a href="javascript:void(0);">here</a>.
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /FAQ's -->
              </div>
            </div>
            <!-- / Content -->

            <div class="content-backdrop fade"></div>
          </div>
            <div class="content-backdrop fade"></div>
          </div>

          {{-- In your main layout --}}
@vite(['resources/js/app.js'])


          <script>
function submitCallRequest() {
    const phone   = document.getElementById('phone_number').value.trim();
    const btn     = document.getElementById('callMeBtn');
    const success = document.getElementById('callSuccess');
    const error   = document.getElementById('callError');

    // Hide previous messages
    success.style.display = 'none';
    error.style.display   = 'none';

    // Basic validation
    if (!phone || phone.length != 10 ) {
        error.style.display = 'block';
        return;
    }

    // Loading state
    btn.disabled     = true;
    btn.innerHTML    = 'Sending...';

    axios.post('/api/call-request', { phone_number: phone })
        .then(function (response) {
            success.style.display = 'block';
            document.getElementById('phone_number').value = '';
        })
        .catch(function (err) {
            error.innerHTML     = '❌ Something went wrong. Please try again.';
            error.style.display = 'block';
        })
        .finally(function () {
            btn.disabled  = false;
            btn.innerHTML = 'Call Me!';
        });
}
</script>

 @endsection
