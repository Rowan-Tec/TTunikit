@extends('layouts.app')

@section('title', 'Dashboard | TT UNIK IT SOLUTIONS')

@section('content')

<!-- Content -->
           
            <!-- Useful features: Start -->
      <section id="landingFeatures" class="section-py landing-features">
        <div class="container">
          <div class="text-center mb-4">
            <span class="badge bg-label-primary" style="font-size: 25px;">WORK INTEGRATED LEARNING</span>
          </div>
          <h4 class="text-center mb-1">
            <span class="position-relative fw-extrabold z-1"
              >Gain real ICT experience
              <img
                src="../../assets/img/front-pages/icons/section-title-icon.png"
                alt="laptop charging"
                class="section-title-img position-absolute object-fit-contain bottom-0 z-n1" />
            </span>
            right here at TT UNIK
          </h4>
          <p class="text-center mb-12">
            The Tirelo WIL Program opens our doors to all IT students from colleges and institutions
            across South Africa — come work with us, contribute to real projects, and build the
            skills and experience your career needs.
            <br>
            <a href="{{ route('wil_application') }}" class="btn btn-light btn-lg px-5 rounded-pill fw-semibold"
           style="color:#185FA5; position:relative; z-index:1; margin-top:20px;">
            Apply for WIL placement
        </a>
          </p>
          
          <div class="features-icon-wrapper row gx-0 gy-6 g-sm-12">
            <div class="col-lg-4 col-sm-6 text-center features-icon-box">
              <div class="mb-4 text-primary text-center">
                <i class="ti ti-device-desktop" style="background-color: transparent; font-size:65px"></i>
                  <path
                    opacity="0.2"
                    d="M10 44.4663V18.4663C10 17.4054 10.4214 16.388 11.1716 15.6379C11.9217 14.8877 12.9391 14.4663 14 14.4663H50C51.0609 14.4663 52.0783 14.8877 52.8284 15.6379C53.5786 16.388 54 17.4054 54 18.4663V44.4663H10Z"
                    fill="currentColor" />
                  <path
                    d="M10 44.4663V18.4663C10 17.4054 10.4214 16.388 11.1716 15.6379C11.9217 14.8877 12.9391 14.4663 14 14.4663H50C51.0609 14.4663 52.0783 14.8877 52.8284 15.6379C53.5786 16.388 54 17.4054 54 18.4663V44.4663M36 22.4663H28M6 44.4663H58V48.4663C58 49.5272 57.5786 50.5446 56.8284 51.2947C56.0783 52.0449 55.0609 52.4663 54 52.4663H10C8.93913 52.4663 7.92172 52.0449 7.17157 51.2947C6.42143 50.5446 6 49.5272 6 48.4663V44.4663Z"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round" />
                </svg>
              </div>
              <h4 class="mb-2">100%</h4>
              <p class="features-icon-description">
               Hosted at TT UNIKIT Solutions
              </p>
            </div>
            <div class="col-lg-4 col-sm-6 text-center features-icon-box">
              <div class="mb-4 text-primary text-center">
                <i class='ti ti-calendar' style="background-color: transparent; font-size:65px"></i>
                  <path
                    opacity="0.2"
                    fill-rule="evenodd"
                    clip-rule="evenodd"
                    d="M52.8934 36.9867L45.1661 27.709C45.4614 33.3937 44.0587 40.0137 39.7274 47.5687L47.1102 53.475C47.3728 53.6835 47.6842 53.8215 48.0149 53.8759C48.3457 53.9303 48.6849 53.8994 49.0004 53.786C49.3159 53.6726 49.5972 53.4806 49.8177 53.228C50.0381 52.9755 50.1905 52.6709 50.2602 52.343L53.2872 38.6602C53.3602 38.3701 53.3625 38.0667 53.294 37.7755C53.2255 37.4843 53.0881 37.2138 52.8934 36.9867ZM10.959 37.1344L18.6864 27.8813C18.3911 33.566 19.7938 40.1859 24.1251 47.7164L16.7422 53.6227C16.4814 53.8311 16.1718 53.9698 15.8426 54.0256C15.5134 54.0814 15.1754 54.0526 14.8604 53.9419C14.5453 53.8311 14.2637 53.6421 14.0418 53.3925C13.82 53.143 13.6653 52.8411 13.5922 52.5152L10.5653 38.8078C10.4923 38.5177 10.49 38.2144 10.5585 37.9232C10.627 37.632 10.7644 37.3615 10.959 37.1344Z"
                    fill="currentColor" />
                  <path
                    fill-rule="evenodd"
                    clip-rule="evenodd"
                    d="M30.1373 4.56417C30.661 4.13034 31.3197 3.89282 31.9999 3.89282C32.6817 3.89282 33.3419 4.1314 33.8661 4.56708C36.2461 6.5048 41.3981 11.3124 44.2413 18.7028C45.231 21.2754 45.9359 24.1485 46.1526 27.3062L53.8054 36.4894C54.1015 36.8368 54.3105 37.2498 54.4151 37.6941C54.519 38.1357 54.5167 38.5956 54.4085 39.0361L51.3844 52.7309L51.3837 52.734C51.2735 53.2253 51.0402 53.6805 50.7057 54.0569C50.3712 54.4332 49.9465 54.7183 49.4715 54.8853C48.9964 55.0523 48.4867 55.0957 47.9903 55.0115C47.4939 54.9273 47.027 54.7182 46.6337 54.4039L46.6332 54.4035L39.5243 48.7164H24.4758L17.3669 54.4035L17.3665 54.4039C16.9731 54.7182 16.5062 54.9273 16.0098 55.0115C15.5134 55.0957 15.0037 55.0523 14.5287 54.8853C14.0537 54.7183 13.6289 54.4332 13.2944 54.0569C12.9599 53.6805 12.7266 53.2253 12.6165 52.734L12.6158 52.7309L9.59162 39.0361C9.48345 38.5957 9.48117 38.1358 9.58509 37.6941C9.68969 37.2496 9.89886 36.8364 10.1952 36.489L17.7037 27.4979C17.9004 24.2604 18.619 21.3188 19.6398 18.6906C22.5111 11.2981 27.7301 6.49122 30.1373 4.56417ZM44.1834 27.8703C44.1674 27.7856 44.1625 27.6995 44.1686 27.6142C43.9794 24.5834 43.3088 21.8491 42.3746 19.4209C39.7071 12.4872 34.8477 7.94455 32.5992 6.11468L32.5893 6.10666L32.5894 6.1066C32.424 5.96848 32.2154 5.89282 31.9999 5.89282C31.7845 5.89282 31.5759 5.96848 31.4105 6.1066L31.3942 6.11994C29.1222 7.93749 24.1977 12.4799 21.5041 19.4147C20.5347 21.9107 19.8484 24.7306 19.6863 27.8638C19.6871 27.9087 19.6849 27.9536 19.6796 27.9984C19.4292 33.348 20.7083 39.6051 24.7062 46.7164H39.2879C43.2365 39.5474 44.4691 33.2477 44.1834 27.8703ZM52.2729 37.7746L46.2018 30.4892C46.0153 35.5301 44.567 41.2065 41.1592 47.4631L47.8821 52.8414C48.0105 52.944 48.1628 53.0122 48.3248 53.0397C48.4868 53.0672 48.6531 53.053 48.8081 52.9985C48.9631 52.944 49.1017 52.851 49.2109 52.7282C49.3197 52.6057 49.3957 52.4576 49.4318 52.2978L49.4321 52.2965L52.4584 38.5922C52.4605 38.5827 52.4627 38.5733 52.4651 38.5639C52.499 38.4289 52.5001 38.2877 52.4682 38.1522C52.4363 38.0167 52.3724 37.8908 52.2818 37.7852L52.2728 37.7746L52.2729 37.7746ZM17.6801 30.6463L11.7266 37.7754L11.7184 37.7852L11.7183 37.7852C11.6277 37.8908 11.5638 38.0167 11.5319 38.1522C11.5 38.2877 11.5011 38.4289 11.5351 38.5639C11.5374 38.5733 11.5397 38.5827 11.5418 38.5922L14.568 52.2965L14.5683 52.2978C14.6044 52.4576 14.6804 52.6057 14.7893 52.7282C14.8984 52.851 15.037 52.944 15.192 52.9985C15.347 53.053 15.5133 53.0672 15.6753 53.0397C15.8373 53.0122 15.9897 52.944 16.118 52.8414L22.835 47.4678C19.3947 41.2766 17.9053 35.6511 17.6801 30.6463ZM27.0626 55.5914C27.0626 55.0391 27.5103 54.5914 28.0626 54.5914H35.9376C36.4899 54.5914 36.9376 55.0391 36.9376 55.5914C36.9376 56.1437 36.4899 56.5914 35.9376 56.5914H28.0626C27.5103 56.5914 27.0626 56.1437 27.0626 55.5914ZM34.9532 24.0914C34.9532 25.7224 33.631 27.0445 32.0001 27.0445C30.3691 27.0445 29.047 25.7224 29.047 24.0914C29.047 22.4604 30.3691 21.1383 32.0001 21.1383C33.631 21.1383 34.9532 22.4604 34.9532 24.0914Z"
                    fill="currentColor" />
                </svg>
              </div>
              <h4 class="mb-2">1-12</h4>
              <p class="features-icon-description">
                Months duration
              </p>
            </div>
            <div class="col-lg-4 col-sm-6 text-center features-icon-box">
              <div class="text-center mb-4 text-primary">
                <i class='ti ti-brand-paypal' style="background-color: transparent; font-size:65px"></i>
                  <path
                    opacity="0.2"
                    d="M52.575 9.44123L5.97499 22.5662C5.57831 22.6747 5.2247 22.9028 4.96234 23.2195C4.69997 23.5361 4.54161 23.926 4.50881 24.3359C4.47602 24.7459 4.57039 25.1559 4.77907 25.5103C4.98775 25.8647 5.3006 26.1461 5.67499 26.3162L27.075 36.4412C27.4942 36.6354 27.8309 36.972 28.025 37.3912L38.15 58.7912C38.3201 59.1656 38.6016 59.4785 38.9559 59.6872C39.3103 59.8958 39.7204 59.9902 40.1303 59.9574C40.5402 59.9246 40.9301 59.7662 41.2468 59.5039C41.5634 59.2415 41.7915 58.8879 41.9 58.4912L55.025 11.8912C55.1245 11.5512 55.1306 11.1906 55.0428 10.8474C54.955 10.5041 54.7765 10.1908 54.5259 9.94028C54.2754 9.68975 53.9621 9.51123 53.6189 9.42342C53.2756 9.33562 52.9151 9.34177 52.575 9.44123Z"
                    fill="currentColor" />
                  <path
                    fill-rule="evenodd"
                    clip-rule="evenodd"
                    d="M53.8666 8.45462C53.3513 8.32282 52.8102 8.33156 52.2995 8.47988L52.2942 8.48144L5.71115 21.6016L5.70701 21.6028C5.11366 21.7659 4.5848 22.1076 4.19216 22.5815C3.79862 23.0565 3.56107 23.6413 3.51188 24.2562C3.46268 24.8711 3.60424 25.4862 3.91726 26.0177C4.22884 26.5468 4.69522 26.9675 5.25338 27.2231L26.6472 37.3452L26.6472 37.3452L26.6546 37.3486C26.8589 37.4432 27.0229 37.6072 27.1175 37.8115L27.1174 37.8115L27.1209 37.8189L37.243 59.2126C37.4985 59.7708 37.9192 60.2372 38.4484 60.5488C38.9799 60.8619 39.595 61.0034 40.2099 60.9542C40.8248 60.905 41.4096 60.6675 41.8846 60.2739C42.3586 59.8813 42.7002 59.3524 42.8634 58.759L42.8645 58.755L55.9847 12.1719L55.9862 12.1668C56.1346 11.656 56.1433 11.1149 56.0115 10.5996C55.8792 10.0825 55.6103 9.61055 55.2329 9.23317C54.8556 8.85579 54.3836 8.58688 53.8666 8.45462ZM52.846 10.4038L52.5749 9.44123L52.8556 10.401C53.0235 10.3519 53.2015 10.3489 53.3709 10.3922C53.5404 10.4356 53.695 10.5237 53.8187 10.6474C53.9424 10.7711 54.0305 10.9257 54.0739 11.0952C54.1172 11.2646 54.1142 11.4426 54.0651 11.6105L54.065 11.6105L54.0623 11.6201L40.9373 58.2201L40.9353 58.2275C40.8811 58.4258 40.767 58.6026 40.6087 58.7338C40.4503 58.865 40.2554 58.9442 40.0504 58.9606C39.8455 58.977 39.6404 58.9298 39.4632 58.8255C39.2861 58.7211 39.1454 58.5647 39.0603 58.3775L39.0538 58.3635L28.9323 36.971L28.9303 36.9667C28.9285 36.9629 28.9268 36.9591 28.925 36.9553L39.732 26.1483C40.1225 25.7578 40.1225 25.1246 39.732 24.7341C39.3415 24.3436 38.7083 24.3436 38.3178 24.7341L27.5108 35.5411C27.5069 35.5393 27.503 35.5375 27.4991 35.5357L6.10255 25.4123L6.0886 25.4058C5.9014 25.3208 5.74498 25.18 5.64064 25.0029C5.53629 24.8257 5.48911 24.6206 5.50551 24.4157C5.5219 24.2107 5.60109 24.0158 5.73227 23.8574C5.86345 23.6991 6.04025 23.5851 6.2386 23.5308L6.2386 23.5309L6.24598 23.5288L52.846 10.4038Z"
                    fill="currentColor" />
                </svg>
              </div>
              <h5 class="mb-2">R900</h5>
              <p class="features-icon-description">
                Once-Off Administration Fee
              </p>
            </div>
      </section>
      <!-- Useful features: End -->

           
    <!-- ABOUT THE PROGRAMME -->
    <div class="card mb-4" style="margin-top: 25px; border-radius: 20px;">
        <div class="card-body">
            <p class="section-label mb-1">About the programme</p>
            <h4 class="fw-semibold mb-3">What is the Tirelo WIL Program?</h4>
            <p class="text-muted" style="line-height:1.8">
                The Tirelo WIL Program is an initiative by <strong>TT UNIK IT Solution</strong> that opens our doors
                to IT students who need to complete their Work Integrated Learning requirement. Instead of
                searching for a placement elsewhere, students come to <strong>us</strong> — and we give them a
                structured, meaningful experience in a real, working IT environment.
            </p>
            <p class="text-muted mb-4" style="line-height:1.8">
                You won't be sitting on the sidelines. From day one, you'll be contributing to real TT UNIK
                projects alongside our team, under the guidance of a dedicated supervisor who will support
                and track your growth throughout your entire placement period.
            </p>
        </div>
    </div>

    <!-- WHAT YOU WILL DO -->
    <div class="card mb-4" style="margin-top: 25px; border-radius: 20px;">
        <div class="card-body">
            <p class="section-label mb-1">What you will do</p>
            <h4 class="fw-semibold mb-1">Real work. Real experience. Real growth.</h4>
            <p class="text-muted mb-4">
                During your WIL at TT UNIK, you will be involved in live projects and day-to-day
                IT operations across three core areas:
            </p>
            <div class="row g-4">
                <div class="col-12 col-sm-6 col-lg-4">
                    <div class="d-flex gap-3">
                        <div class="offer-icon-wrap"><i class='ti ti-code' style="background-color: transparent; font-size:25px; color: #7367F0;"></i></div>
                        <div>
                            <h6 class="fw-semibold mb-1">Web & software development</h6>
                            <p class="text-muted mb-0" style="font-size:13px">
                                Work on real development tasks — building, testing, and improving
                                web applications and software solutions for actual TT UNIK clients.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-lg-4">
                    <div class="d-flex gap-3">
                        <div class="offer-icon-wrap"><i class='ti ti-fidget-spinner' style="background-color: transparent; font-size:25px; color: #7367F0;"></i></div>
                        <div>
                            <h6 class="fw-semibold mb-1">IT support & networking</h6>
                            <p class="text-muted mb-0" style="font-size:13px">
                                Get hands-on exposure to IT infrastructure, support operations,
                                and networking tasks in a professional business environment.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-lg-4">
                    <div class="d-flex gap-3">
                        <div class="offer-icon-wrap"><i class='ti ti-database' style="background-color: transparent; font-size:25px ; color: #7367F0;"></i></div>
                        <div>
                            <h6 class="fw-semibold mb-1">Database & systems admin</h6>
                            <p class="text-muted mb-0" style="font-size:13px">
                                Work with real databases and systems — learning how data is managed,
                                secured, and optimised inside a live IT company.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- HOW IT WORKS -->
    <div class="card mb-4" style="margin-top: 25px; border-radius: 20px;">
        <div class="card-body">
            <p class="section-label mb-1">How it works</p>
            <h4 class="fw-semibold mb-4">Your journey from application to completion</h4>
            <div class="row g-3 text-center">
                <div class="col-6 col-md-3">
                    <div class="step-circle">1</div>
                    <h6 class="fw-semibold mb-1">Apply & pay</h6>
                    <p class="text-muted mb-0" style="font-size:13px">
                        Submit your WIL application and pay the once-off Administration Fee.
                    </p>
                </div>
                <div class="col-6 col-md-3">
                    <div class="step-circle">2</div>
                    <h6 class="fw-semibold mb-1">Get confirmed</h6>
                    <p class="text-muted mb-0" style="font-size:13px">
                        TT UNIK reviews your application and confirms your placement start date.
                    </p>
                </div>
                <div class="col-6 col-md-3">
                    <div class="step-circle">3</div>
                    <h6 class="fw-semibold mb-1">Start at TT UNIK</h6>
                    <p class="text-muted mb-0" style="font-size:13px">
                        Join our team, meet your dedicated supervisor, and begin working on real IT projects.
                    </p>
                </div>
                <div class="col-6 col-md-3">
                    <div class="step-circle">4</div>
                    <h6 class="fw-semibold mb-1">Complete & get your letter</h6>
                    <p class="text-muted mb-0" style="font-size:13px">
                        Finish your WIL period and receive an official reference letter from TT UNIK IT Solution.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- WHAT YOU GAIN -->
    <div class="card mb-4" style="margin-top: 25px; border-radius: 20px;">
        <div class="card-body">
            <p class="section-label mb-1">What you gain</p>
            <h4 class="fw-semibold mb-1">Skills & experience that set you apart</h4>
            <p class="text-muted mb-4">
                By the time you complete your WIL at TT UNIK, you will have exposure to
                skills that IT employers actively look for.
            </p>
            <div class="d-flex flex-wrap gap-2 mb-4">
                <span class="skill-chip"><i class="ti ti-check" style="background-color: transparent; color: green;"></i> Software development</span>
                <span class="skill-chip"><i class="ti ti-check" style="background-color: transparent; color: green;"></i> Database management</span>
                <span class="skill-chip"><i class="ti ti-check" style="background-color: transparent; color: green;"></i> IT infrastructure & networking</span>
                <span class="skill-chip"><i class="ti ti-check" style="background-color: transparent; color: green;"></i> Systems administration</span>
                <span class="skill-chip"><i class="ti ti-check" style="background-color: transparent; color: green;"></i> Working in a live IT team</span>
                <span class="skill-chip"><i class="ti ti-check" style="background-color: transparent; color: green;"></i> Professional workplace conduct</span>
                <span class="skill-chip"><i class="ti ti-check" style="background-color: transparent; color: green;"></i> Client-facing project work</span>
                <span class="skill-chip"><i class="ti ti-check" style="background-color: transparent; color: green;"></i> Problem solving under supervision</span>
            </div>
            <div class="highlight-box">
                <i class='bx bx-envelope me-2'></i>
                <strong>Reference letter included.</strong> Every student who successfully completes their WIL
                placement at TT UNIK IT Solution receives an official reference letter — a valuable asset
                for any job application or portfolio.
            </div>
        </div>
    </div>

    <!-- WHO CAN APPLY -->
    <div class="card mb-4" style="margin-top: 25px; border-radius: 20px;">
        <div class="card-body">
            <p class="section-label mb-1">Who can apply</p>
            <h4 class="fw-semibold mb-1">Open to students from all institutions & colleges</h4>
            <p class="text-muted mb-4">
                If your institution or college requires you to complete a Work Integrated Learning
                module as part of your IT qualification, you are welcome to apply for the Tirelo WIL Program.
            </p>
            <div class="d-flex flex-wrap gap-4">
                <span class="institution-badge" style="background-color: #000; padding: 10px; border-radius: 5px; color: #fff;"><i class="ti ti-buildings" style="background-color: transparent; font-size: 20px;"></i> Universities of Technology</span>
                <span class="institution-badge" style="background-color: #000; padding: 10px; border-radius: 5px; color: #fff;"><i class='ti ti-buildings' style="background-color: transparent; font-size: 20px;"></i> TVET Colleges</span>
                <span class="institution-badge" style="background-color: #000; padding: 10px; border-radius: 5px; color: #fff;"><i class='ti ti-buildings' style="background-color: transparent; font-size: 20px;"></i> Private Colleges</span>
                <span class="institution-badge" style="background-color: #000; padding: 10px; border-radius: 5px; color: #fff;"><i class='ti ti-buildings' style="background-color: transparent; font-size: 20px;"></i> Distance Learning Institutions</span>
                <span class="institution-badge" style="background-color: #000; padding: 10px; border-radius: 5px; color: #fff;"><i class='ti ti-buildings' style="background-color: transparent; font-size: 20px;"></i> Any accredited SA institution</span>
            </div>
            <p class="text-muted mt-3 mb-0" style="font-size:13px">
                <i class='bx bx-info-circle me-1'></i>
                Not sure if your institution qualifies?
                <a href="#" class="text-primary">Contact us</a> before applying and we'll confirm.
            </p>
        </div>
    </div>

     <!-- CTA -->
    <div class="cta-section text-center" style="margin-top: 15px;">
        <h4 class="fw-semibold text-black mb-2">Ready to do your WIL at TT UNIK?</h4>
        <p class="mb-4">
            Join students from across South Africa gaining real, hands-on IT experience right here at TT UNIK IT Solution.
        </p>
        <a href="{{ route('wil_application') }}" class="btn btn-light btn-lg px-5 rounded-pill fw-semibold"
           style="color:#185FA5; position:relative; z-index:1; margin-top:20px;">
            Apply for WIL placement today
        </a>
    </div>

            <!--/ Content -->


@endsection
