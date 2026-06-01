@extends('layouts.app')

@section('title', 'Dashboard | TT UNIK IT SOLUTIONS')

@section('content')

<style>
         /* Upload area */
        .upload-area {
            border: 2px dashed #dee2e6;
            border-radius: 0.5rem;
            padding: 1.5rem;
            text-align: center;
            cursor: pointer;
            transition: border-color 0.2s, background 0.2s;
            background: #f8f9fa;
        }
        .upload-area:hover { border-color: #185FA5; background: #eef5fc; }
        .upload-area i { font-size: 30px; color: #185FA5; display: block; margin-bottom: 6px; }
        .upload-area p { font-size: 13px; color: #6c757d; margin: 0; }
        .upload-area .link { color: #185FA5; font-weight: 500; }
        .upload-area small { font-size: 11px; color: #adb5bd; }
        .file-name { font-size: 12px; color: #185FA5; margin-top: 5px; }

    </style>

     <!-- Content -->
           
            <!-- Useful features: Start -->
      <section id="landingFeatures" class="section-py landing-features">
        <div class="container">
          <div class="text-center mb-4">
            <span class="badge bg-label-primary" style="font-size: 30px; background-color: transparent !important;">WIL Placement Application</span>
          </div>
          <h4 class="text-center mb-1">
            <p class="position-relative fw-extrabold z-1" style="color: #ffffff89;"
              >
              Fill in all required fields to submit your application. Fields marked <span style='color:red'>*</span> are required.
             </p>
          </h4>
          
      </section>
      <!-- Useful features: End -->


            <!--/ Content -->

            <div class="container-lg">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-9 col-xl-8">

            <form id="wil-form" method="POST" action="{{ route('wil_application') }}" enctype="multipart/form-data" novalidate>
               @csrf

                <!-- PERSONAL INFORMATION -->
<div class="card mb-4">
    <div class="card-body">
        <div class="section-divider">Personal information</div>
        <div class="row g-3">

            <!-- LEFT COLUMN: ID + Email stacked -->
            <div class="col-sm-6">
                
                <label class="form-label mt-3">SA ID number<span class="text-danger">*</span></label>
                <input type="text" name="id_number" class="form-control" placeholder="13-digit ID number" maxlength="13" required pattern="\d{13}">
                <div class="invalid-feedback">Please enter your Id number.</div>
            </div>

            <!-- RIGHT COLUMN: DOB + Phone stacked -->
            <div class="col-sm-6">

            

                <label class="form-label mt-3">Phone number <span class="text-danger">*</span></label>
                <input type="tel" name="phone" class="form-control" placeholder="e.g. 071 234 5678" required>
                <div class="invalid-feedback">Please enter your phone number.</div>
            </div>

            <div class="col-12">
                <label class="form-label">Physical address<span class="text-danger">*</span></label>
                <input type="text" name="address" class="form-control" placeholder="Street, suburb, city">
            </div>
        </div>
    </div>
</div>

                <!-- ACADEMIC INFORMATION -->
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="section-divider">Academic information</div>
                        <div class="row g-3">
                            <div class="col-sm-6">
                                <label class="form-label">Institution / University <span class="text-danger">*</span></label>
                                <input type="text" name="institution" class="form-control" placeholder="e.g. Tshwane University of Technology" required>
                                <div class="invalid-feedback">Please enter your institution.</div>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label">Student number <span class="text-danger">*</span></label>
                                <input type="text" name="student_number" class="form-control" placeholder="e.g. 21012345" required>
                                <div class="invalid-feedback">Please enter your student number.</div>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label">Field of study <span class="text-danger">*</span></label>
                                <select name="field_of_study" class="form-select" required>
                                    <option value="">Select your field</option>
                                    <option>Software Development</option>
                                    <option>Information Technology</option>
                                    <option>Computer Science</option>
                                    <option>IT Systems Management</option>
                                    <option>Network Engineering</option>
                                    <option>Data Science</option>
                                    <option>Cybersecurity</option>
                                    <option>Other IT field</option>
                                </select>
                                <div class="invalid-feedback">Please select your field of study.</div>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label">Year of study <span class="text-danger">*</span></label>
                                <select name="year_of_study" class="form-select" required>
                                    <option value="">Select year</option>
                                    <option value="1st">1st Year</option>
                                    <option value="2nd">2nd Year</option>
                                    <option value="3rd">3rd Year</option>
                                    <option value="4th">4th Year</option>
                                    <option value="Honours">Honours</option>
                                    <option value="Postgrad">Postgrad</option>
                                </select>
                                <div class="invalid-feedback">Please select your year of study.</div>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Faculty / Department</label>
                                <input type="text" name="faculty" class="form-control" placeholder="e.g. Faculty of ICT">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- SUPPORTING DOCUMENTS -->
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="section-divider">Supporting documents</div>
                        <p class="text-muted mb-4" style="font-size:13px">
                            All four documents below are required to complete your application.
                            Please ensure each file is clearly legible before uploading.
                        </p>
                        <div class="row g-4">

                            <!-- 1. CV -->
                            <div class="col-12 col-md-6">
                                <label class="form-label fw-semibold">
                                    <i class='bx bx-file me-1 text-primary'></i> 1. CV
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="upload-area" onclick="document.getElementById('cv-file').click()">
                                    <i class='bx bx-cloud-upload'></i>
                                    <p><span class="link">Click to upload</span> your CV</p>
                                    <small>PDF, DOC, DOCX — max 5MB</small>
                                </div>
                                <input type="file" id="cv-file" name="cv" accept=".pdf,.doc,.docx" class="d-none" required
                                       onchange="showFileName(this, 'cv-name')">
                                <div id="cv-name" class="file-name"></div>
                            </div>

                            <!-- 2. Academic Records -->
                            <div class="col-12 col-md-6">
                                <label class="form-label fw-semibold">
                                    <i class='bx bx-book-open me-1 text-primary'></i> 2. Academic Records
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="upload-area" onclick="document.getElementById('academic-file').click()">
                                    <i class='bx bx-cloud-upload'></i>
                                    <p><span class="link">Click to upload</span> your academic records</p>
                                    <small>PDF, JPG, PNG — max 5MB</small>
                                </div>
                                <input type="file" id="academic-file" name="academic_records" accept=".pdf,.jpg,.jpeg,.png" class="d-none" required
                                       onchange="showFileName(this, 'academic-name')">
                                <div id="academic-name" class="file-name"></div>
                            </div>

                            <!-- 3. WIL Recommendation Letter -->
                            <div class="col-12 col-md-6">
                                <label class="form-label fw-semibold">
                                    <i class='bx bx-envelope me-1 text-primary'></i> 3. WIL Recommendation Letter
                                    <span class="text-danger">*</span>
                                </label>
                                <p class="text-muted mb-2" style="font-size:12px">
                                    This must be an official letter from your University or College confirming that you require a WIL placement.
                                </p>
                                <div class="upload-area" onclick="document.getElementById('wil-letter-file').click()">
                                    <i class='bx bx-cloud-upload'></i>
                                    <p><span class="link">Click to upload</span> your recommendation letter</p>
                                    <small>PDF, JPG, PNG — max 5MB</small>
                                </div>
                                <input type="file" id="wil-letter-file" name="wil_recommendation_letter" accept=".pdf,.jpg,.jpeg,.png" class="d-none" required
                                       onchange="showFileName(this, 'wil-letter-name')">
                                <div id="wil-letter-name" class="file-name"></div>
                            </div>

                            <!-- 4. Copy of ID -->
                            <div class="col-12 col-md-6">
                                <label class="form-label fw-semibold">
                                    <i class='bx bx-id-card me-1 text-primary'></i> 4. Copy of ID
                                    <span class="text-danger">*</span>
                                </label>
                                <p class="text-muted mb-2" style="font-size:12px">
                                    Upload a clear copy of your South African ID document or passport.
                                </p>
                                <div class="upload-area" onclick="document.getElementById('id-file').click()">
                                    <i class='bx bx-cloud-upload'></i>
                                    <p><span class="link">Click to upload</span> your ID copy</p>
                                    <small>PDF, JPG, PNG — max 5MB</small>
                                </div>
                                <input type="file" id="id-file" name="id_copy" accept=".pdf,.jpg,.jpeg,.png" class="d-none" required
                                       onchange="showFileName(this, 'id-name')">
                                <div id="id-name" class="file-name"></div>
                            </div>

                        </div>
                    </div>
                </div>

        

                <!-- DECLARATION -->
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="section-divider">Declaration</div>
                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="terms" id="terms" required>
                                <label class="form-check-label" for="terms" style="font-size:13px">
                                    I confirm that all information provided is accurate and I agree to the
                                    <a href="#" class="text-primary">Terms &amp; Conditions</a> and
                                    <a href="#" class="text-primary">Privacy Policy</a> of TT UNIK IT Solution.
                                </label>
                                <div class="invalid-feedback">You must accept the terms and conditions.</div>
                            </div>
                        </div>
                        <div class="mb-1">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="payment_agree" id="payment_agree" required>
                                <label class="form-check-label" for="payment_agree" style="font-size:13px">
                                    I understand that the once-off application fee is non-refundable and will be processed upon submission.
                                </label>
                                <div class="invalid-feedback">You must acknowledge the payment terms.</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- SUBMIT -->
                <div class="submit-area">
                    <button type="submit" class="btn btn-primary px-5">
                        <i class='bx bx-send me-1'></i> Submit &amp; proceed to payment
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
          <!--/ Content wrapper -->
        </div>

        <!--/ Layout container -->
      </div>
    </div>

    <!-- Overlay -->
    <div class="layout-overlay layout-menu-toggle"></div>

    <!-- Drag Target Area To SlideIn Menu On Small Screens -->
    <div class="drag-target"></div>
@endsection
