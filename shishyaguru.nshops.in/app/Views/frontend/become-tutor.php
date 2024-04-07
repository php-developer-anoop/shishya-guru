<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datepicker/1.0.10/datepicker.min.css" integrity="sha512-YdYyWQf8AS4WSB0WWdc3FbQ3Ypdm0QCWD2k4hgfqbQbRCJBEgX0iAegkl2S1Evma5ImaVXLBeUkIlP6hQ1eYKQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<?php $bgimage = !empty($page['banner_image_jpg'] || $page['banner_image_webp']) ? base_url('uploads/') . imgExtension($page['banner_image_jpg'], $page['banner_image_webp']) : "";?>
<section class="registration become-top">
  <img src="<?=$bgimage?>" alt="<?=!empty($page['banner_image_alt'])?$page['banner_image_alt']:''?>" class="img-fluid" />
</section>
<div class="topper-tutorSec">
  <span class="becom-title">
    <h3><?=!empty($page['h1'])?$page['h1']:''?></h3>
  </span>
  <section class="tutorPage-Mainsec">
    <div class="card">
      <div class="col-md-12 col-lg-12 row mx-auto">
        <div class="col-md-3 col-lg-3">
          <div class="col-md-12 col-lg-12 mx-auto side-forminfo">
            <div class="tab tutortabs">
              <button class="tablinks tutor-btn">
                <span class="icon">
                <i class="bi bi-person-lines-fill"></i>
                </span>
                <span class="Information">
                  Personal Info<br />
                  <p class="tutors">Setup account details</p>
                </span>
              </button>
              <button class="tablinks tutor-btn">
                <span class="icon">
                <i class="bi bi-book"></i>
                </span>
                <span class="Information">
                  Education Detail<br />
                  <p class="tutors">Setup account details</p>
                </span>
              </button>
              <button class="tablinks tutor-btn">
                <span class="icon">
                <i class="bi bi-person-vcard-fill"></i>
                </span>
                <span class="Information">
                  Tuition Offered<br />
                  <p class="tutors">Add service details</p>
                </span>
              </button>
              <button class="tablinks tutor-btn">
                <span class="icon">
                <i class="bi bi-card-image"></i>
                </span>
                <span class="Information">
                  Upload KYC Document<br />
                  <p class="tutors">Upload KYC document</p>
                </span>
              </button>
            </div>
          </div>
        </div>
        
        <div class="col-md-9 col-lg-9 mx-auto">
        <?=form_open_multipart('save-tutor')?>
          <div id="form" class="tutorinfosec">
            <div id="Personal" class="tabcontent">
              <h3>Personal Information:</h3>
              <p>Enter Your Account Details.</p>
              <div class="mb-3 row justify-content-between">
                <div class="col-md-12 row justify-content-between">
                  <div class="col-md-5 custom_class firscls">
                    <fieldset>
                      <legend>Full Name</legend>
                      <input type="text" name="tutor_name" id="tutor_name" class="form-control ucwords restrictedInput" autocomplete="off" placeholder="Enter full name" required>
                    </fieldset>
                  </div>
                  <!--<div class="col-md-5 custom_class firscls">-->
                  <!--  <fieldset>-->
                  <!--    <legend>Date of Birth</legend>-->
                  <!--    <input type="date" name="tutor_dob" max="<?=date('Y-m-d')?>" id="tutor_dob" class="form-control" autocomplete="off" placeholder="DD/MM/YYYY" required>-->
                  <!--  </fieldset>-->
                  <!--</div>-->
                  <div class="col-md-5 custom_class firscls ">
                    <fieldset>
                      <legend>Date of Birth</legend>
                       <div class="input-group date custum-calender" id="tutor_dob">
                   <input type="text" name="tutor_dob" max="<?=date('Y-m-d')?>"  class="form-control" autocomplete="off" placeholder="DD/MM/YYYY" required>
                     
                 </div>
                    </fieldset>
                  </div>
              
                  
                  
           
                </div>
                <div class="col-md-12 mt-2">
                  <div class="col-md-12">
                    Gender
                    <div class="custom_class firscls">
                      <div class="form-check form-check-inline ">
                        <input class="form-check-input tutor_gender" type="radio" name="tutor_gender" id="inlineRadio1"
                          value="Male">
                        <label class="form-check-label" for="inlineRadio1">Male</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input tutor_gender" type="radio" name="tutor_gender" id="inlineRadio2"
                          value="Female">
                        <label class="form-check-label" for="inlineRadio2">Female</label>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-12 mt-2 row justify-content-between">
                  <div class="col-md-5 custom_class">
                    <fieldset>
                      <legend>Email ID</legend>
                      <input type="email" autocomplete="off" class="form-control emailInput" name="tutor_email" id="tutor_email" placeholder="Eg. xyz@gmail.com" required>
                    </fieldset>
                  </div>
                  <div class="col-md-5 custom_class">
                    <fieldset>
                      <legend>Mobile Number</legend>
                      <input type="text" autocomplete="off" name="tutor_mobile" id="tutor_mobile" class="form-control numbersWithZeroOnlyInput" maxlength="10" minlength="10"  placeholder="Eg. 9XXXXXXXXX" required>
                      <span class="Verify-mob d-none" id="verify"   data-bs-target="#exampleModal2" data-bs-whatever="@mdo" onclick="return checkOtp()">Verify</span>
                      <span class="Verify-mob text-success" id="verified">Verified</span>
                    </fieldset>
                  </div>
                </div>
                <div class="col-md-12 mt-2 row justify-content-between">
                  <div class="col-md-5 custom_class">
                    <fieldset>
                      <legend>Current Address</legend>
                      <textarea class="form-control" style="resize:none" name="tutor_address" id="tutor_address" rows="6" placeholder="Enter complete address"></textarea>
                    </fieldset>
                  </div>
                  <div class="col-md-5">
                    <div class="col-md-12 custom_class">
                      <fieldset>
                        <legend>City</legend>
                        <select class="form-select select2" aria-label="Default select example" name="tutor_city" id="tutor_city">
                          <option value="">Choose City</option>
                          <?php if(!empty($city_list)){foreach($city_list as $clkey=>$clvalue){?>
                          <option value="<?=$clvalue['id']?>"><?=$clvalue['city_name'].' , '.$clvalue['state_name']?></option>
                          <?php }} ?>
                        </select>
                      </fieldset>
                    </div>
                    <div class="col-md-12 custom_class">
                      <fieldset>
                        <legend>Pincode</legend>
                        <input type="text" class="form-control numbersWithZeroOnlyInput" autocomplete="off" maxlength="6" minlength="6" name="tutor_pincode" id="tutor_pincode" placeholder="Enter Pincode" required>
                      </fieldset>
                    </div>
                  </div>
                </div>
                <div class="mb-3 form-check mx-3">
                  <input type="checkbox" class="form-check-input" name="t_and_c" id="exampleCheck1">
                  <label class="form-check-label" for="exampleCheck1">I Agree with <a href="javascript:void(0)"
                    class="text-purple">terms</a> and <a href="javascript:void(0)" class="text-purple"> policy </a> </label>
                </div>
              </div>
            </div>
            <div id="Education" class="tabcontent">
              <h3>Education Information:</h3>
              <p>Enter Educational Details</p>
              <div class="mb-3 row justify-content-between">
                <div class="col-md-12 row justify-content-between">
                  <div class="col-md-5 custom_class">
                    <fieldset>
                      <legend>Highest Qualification</legend>
                      <select class="form-select" aria-label="Default select example" name="tutor_qualification" id="tutor_qualification">
                        <option value="">Choose option</option>
                        <?php if(!empty($qualification_list)){foreach($qualification_list as $qlkey=>$qlvalue){?>
                        <option value="<?=$qlvalue['id']?>"><?=$qlvalue['qualification_name']?></option>
                        <?php }} ?>
                      </select>
                    </fieldset>
                  </div>
                </div>
                <div class="col-md-12 my-4 row justify-content-between">
                  <h3>Skills</h3>
                  <div class="col-md-5 custom_class">
                    <fieldset>
                      <legend>Select Skills</legend>
                      <select class="form-select" aria-label="Default select example" name="tutor_skill" id="tutor_skill">
                        <option value="">Choose option</option>
                        <?php if(!empty($skill_list)){foreach($skill_list as $slkey=>$slvalue){?>
                        <option value="<?=$slvalue['id']?>"><?=$slvalue['skill_name']?></option>
                        <?php }} ?>
                      </select>
                    </fieldset>
                  </div>
                </div>
                <div class="col-md-12 col-lg-12">
                  <lable>Do you have any prior teaching experience</lable>
                  <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input"  name="tutor_experience" id="tutor_experience">
                    <label class="form-check-label" for="tutor_experience">Yes</label>
                  </div>
                </div>
                <div class="col-md-12 mb-4 mt-2 row justify-content-between">
                  <lable>Please mention how many years</lable>
                  <div class="col-md-2 custom_class">
                    <fieldset>
                      <legend>Years</legend>
                      <input type="text" class="form-control numbersWithZeroOnlyInput" minlength="1" maxlength="2" name="tutor_experience_year" id="tutor_experience_year" required>
                    </fieldset>
                  </div>
                </div>
              </div>
            </div>
            <div id="Tuition" class="tabcontent">
              <h3>Tuition Offered:</h3>
              <p>Add services details</p>
              <div class="mb-3 row justify-content-between">
                <div class="col-md-12">
                  <h4>Interested for</h4>
                  <div class="custom_class firscls">
                    <div class="form-check form-check-inline ">
                      <input class="form-check-input tutor_tuition_mode" type="checkbox" value="" name="tutor_tuition_mode" id="">
                      <label class="form-check-label" for="tutor_tuition_mode">
                      At home
                      </label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input tutor_tuition_mode" type="checkbox" value="" name="tutor_tuition_mode" id="">
                      <label class="form-check-label" for="tutor_tuition_mode">
                      Online
                      </label>
                    </div>
                    <div class="form-check">
                    </div>
                  </div>
                </div>
                <div class="col-md-12 mt-2 row justify-content-between">
                  <div class="col-md-5 custom_class">
                    <fieldset>
                      <legend>Education Board</legend>
                      <select class="form-select" aria-label="Default select example" name="tutor_board" id="tutor_board">
                        <option value="">Choose option</option>
                        <?php if(!empty($board_list)){foreach($board_list as $blkey=>$blvalue){?>
                        <option value="<?=$blvalue['id']?>"><?=$blvalue['board_name']?></option>
                        <?php }} ?>
                      </select>
                    </fieldset>
                  </div>
                  <div class="col-md-5 custom_class">
                    <fieldset>
                      <legend>Classes</legend>
                      <select class="form-select" aria-label="Default select example" name="tutor_class" id="tutor_class" onchange="getSubject(this.value,'tutor_subject')">
                        <option value="">Choose option</option>
                        <?php if(!empty($class_list)){foreach($class_list as $ckey=>$cvalue){?>
                        <option value="<?=$cvalue['id']?>"><?=$cvalue['class_name']?></option>
                        <?php }} ?>
                      </select>
                    </fieldset>
                  </div>
                </div>
                <div class="col-md-12 mt-2 row justify-content-between">
                  <div class="col-md-5 custom_class">
                    <fieldset>
                      <legend>Subjects</legend>
                      <select class="form-select" aria-label="Default select example" name="tutor_subject" id="tutor_subject">
                        <option value="">Choose option</option>
                      </select>
                    </fieldset>
                  </div>
                  <div class="col-md-5 custom_class">
                    <fieldset>
                      <legend>Approx monthly fee</legend>
                      <select class="form-select" aria-label="Default select example" name="tutor_fee" id="tutor_fee">
                        <option value="">₹ Eg. 15000</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                      </select>
                    </fieldset>
                  </div>
                </div>
              </div>
            </div>
            <div id="Upload" class="tabcontent">
              <h3>Upload KYC Document</h3>
              <p>Upload the required KYC document</p>
              <div class="mb-3 row justify-content-between">
                <div class="col-md-12 ">
                  <div class="wrapper-section ">
                    <div class="col-md-12 mt-4 row">
                      <div class="col-md-6">
                        <div class="my-3 uploadPic">
                          <h3>Upload Profile Pic</h3>
                          <fieldset>
                            <legend>Upload Image</legend>
                            <input type="hidden" name="old_tutor_profile_image" value="">
                            <input type="file" class="file-browser file" id="tutor_profile_image" name="tutor_profile_image" accept="image/png, image/jpg, image/jpeg">
                          </fieldset>
                          <p class="lastlable">Max file size 1 mb. JPG,JPEG or PNG</p>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="image-preview" id="imagePreview"></div>
                      </div>
                    </div>
                    <div class="col-md-12 mt-4 row">
                      <div class="col-md-6">
                        <div class="my-3  uploadPic">
                          <h3>Upload Aadhaar Front</h3>
                          <fieldset>
                            <legend>Upload Image</legend>
                            <input type="hidden" name="old_tutor_aadhaar_front" value="">
                            <input type="file" class="file-browser-2 file" id="tutor_aadhaar_front" name="tutor_aadhaar_front" accept="image/png, image/jpg, image/jpeg">
                          </fieldset>
                          <p class="lastlable">Max file size 1 mb. JPG,JPEG or PNG</p>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="image-preview" id="imagePreview2"></div>
                      </div>
                    </div> 
                    <div class="col-md-12 mt-4 row">
                      <div class="col-md-6">
                        <div class="my-3  uploadPic">
                          <h3>Upload Aadhaar Back</h3>
                          <fieldset>
                            <legend>Upload Image</legend>
                            <input type="hidden" name="old_tutor_aadhaar_back" value="">
                            <input type="file" class="file-browser-3 file" id="tutor_aadhaar_back" name="tutor_aadhaar_back" accept="image/png, image/jpg, image/jpeg">
                          </fieldset>
                          <p class="lastlable">Max file size 1 mb. JPG,JPEG or PNG</p>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="image-preview" id="imagePreview3"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-12 col-md-12 pb-5 px-3 row mx-auto responsive-btn">
              <div class="col-md-6 col-sm-6 d-flex justify-content-start previous-btn">
                <div class="col-md-12 col-lg-12 d-flex justify-content-start">
                  <a class="formPreviuous btnPrevious" href="javascript:void(0)">
                  <i class="fa-solid fa-arrow-left"></i><span>Previous</span></a>
                </div>
              </div>
              <div class="col-md-6 col-sm-6 d-flex justify-content-end next-btn">
                <div class="col-md-12 col-lg-12 d-flex justify-content-end">
                  <button class="Forminfo-btn btnNext" id="save">
                  <span>Save</span> <i class="fa-solid fa-arrow-right"></i>
                  </button>
                  <button type="submit" id="submit" onclick="return validateTutorForm()" class="Forminfo-btn submitButton" style="display: none;">
                  <span>Submit</span> <i class="bi bi-check-circle-fill"></i>
                  </button>
                </div>
              </div>
            </div>
          </div>
          <?=form_close()?>
        </div>
        
      </div>
    </div>
  </section>
</div>
<!-- Features Section - Home Page -->
<section id="features" class="features tutorclass-details">
  <div class="container">
    <div class="row gy-4 align-items-center features-item tutor-Number">
      <div class="col-lg-7  order-1 order-lg-2 ">
        <h3>Join us and you’ll have everything you need to teach successfully.</h3>
        <div class="col-md-12  col-lg-1g col-sm-12 row">
          <div class="col-md-1 col-lg-1  col-sm-1 col-resposive-2">
            <div class="schoolnumring">
              <span>01.</span>
              <hr>
              <span>02.</span>
              <hr>
              <span>03.</span>
              <hr>
            </div>
          </div>
          <div class="col-md-11 col-lg-11 col-sm-11 col-resposive-10">
            <div class="tutor-numbercontent">
              <div class="">
                <h5>Set your own rate</h5>
                <p>Choose your own monthly fee. On average, our tutors charge ₹ 15000 - ₹ 25000 per month.</p>
              </div>
              <div class="">
                <h5>Teach anytime, anywhere</h5>
                <p>Decide when and how many hours you want to teach. No minimum time commitment or fixed schedule.</p>
              </div>
              <div class="">
                <h5>Grow professionally</h5>
                <p>Get tips to upgrade your skills. You’ll get all the help you need from our team to grow.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-5 d-flex  order-2 order-lg-1 align-items-center">
        <span class="class-nameunion">
        <img src="<?=base_url()?>assets/frontend/img/Union.png" class="img-fluid">
        </span>
        <div class="image-stack">
          <img src="<?=base_url()?>assets/frontend/img/nursury to kg.png" alt="" class="top-front">
          <img src="<?=base_url()?>assets/frontend/img/6 to 9.png" alt="" class="stack-front">
          <img src="<?=base_url()?>assets/frontend/img/1 to 5.png" alt="" class="stack-back">
        </div>
      </div>
    </div>
    <!-- Features Item -->
  </div>
</section>

<div class="container">
  <?php if(!empty($faq_list)){?>
  <section id="faq" class="faq section-bg">
    <div class="services-sec">
      <div class="faq-list ">
        <h3 class="heading"><?=!empty($page['faq_heading'])?$page['faq_heading']:''?></h3>
        <ul>
          <?php foreach($faq_list as $key=>$value){ ?>
          <li>
            <i class="bx bx-help-circle icon-help"></i>
            <a data-bs-toggle="collapse" class="<?=$key!=0?"collapsed":""?>" data-bs-target="#faq-list-<?php echo $key; ?>">
            <span class="accodiant_itmeheding"><?php echo $value['question']; ?></span>
            <i class="fa-solid fa-circle-minus icon-close"></i>
            <i class="fa-solid fa-circle-plus icon-show"></i>
            </a>
            <div id="faq-list-<?php echo $key; ?>" class="collapse <?php echo $key == 0 ? 'show' : ''; ?>" data-bs-parent=".faq-list">
              <p><?php echo $value['answer']; ?></p>
            </div>
          </li>
          <?php } ?>
        </ul>
      </div>
    </div>
  </section>
  <?php } ?>
  <!-- End Frequently Asked Questions Section -->
</div>
<?php if(!empty($testimonial_list)){?>
<section class="student-Mainsec p-0">
  <div class="feedback-student about" id="about" >
    <div class="container" data-aos="fade-up" data-aos-delay="100">
      <div class="row">
        <div class="col-xl-7">
          <div class="row icon-boxes">
            <?php foreach($testimonial_list as $tlkey=>$tlvalue){?>
            <?php $testimonial_image =  "";   ?>
            <div class="col-md-6" data-aos="fade-up" data-aos-delay="300">
              <div class="icon-box student-feds studentboy">
                <span class="d-flex justify-content-center">
                <img src="<?=$testimonial_image?>" alt="<?=!empty($tlvalue['image_alt'])?$tlvalue['image_alt']:''?>" class="img-fluid">
                </span>
                <div class="text-center">
                  <p><span class="fa-solid fa-quote-left"></span><?=!empty($tlvalue['testimonial'])?$tlvalue['testimonial']:''?><span class="fa-solid fa-quote-right"></span></p>
                </div>
                <div class="d-flex justify-content-center">
                  <i class="fa-solid fa-star"></i>   
                  <i class="fa-solid fa-star"></i>   
                  <i class="fa-solid fa-star"></i>   
                  <i class="fa-solid fa-star"></i>   
                </div>
              </div>
            </div>
            <?php } ?>
            <span class="feed-union">
            <img src="<?=base_url()?>assets/frontend/img/feedunion.png" class="img-fluid">
            </span>
            <span class="feed-union2 d-none">
            <img src="<?=base_url()?>assets/frontend/img/bottom reviw.png" class="img-fluid">
            </span>
          </div>
        </div>
        <div class="col-xl-5 content">
          <h2><?=!empty($home['testimonial_heading'])?$home['testimonial_heading']:''?></h2>
          <a href="<?=base_url('reviews')?>" class="read-more"><span>View Reviews</span></a>
        </div>
      </div>
    </div>
  </div>
</section>
<?php } ?>
<!-- modal section -->
<!--<span>-->
<!--  <div class="modal fade mt-5" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">-->
<!--  <div class="modal-dialog">-->
<!--    <div class="modal-content">-->
<!--      <div class="modal-header text-center">-->
<!--        <h1 class="modal-title fs-5" id="exampleModalLabel"><b>Complete your query details</b></h1>-->
<!--        <button type="button" class="btncross" data-bs-dismiss="modal" aria-label="Close"><i-->
<!--          class="fa-solid fa-xmark"></i></button>-->
<!--      </div>-->
<!--      <div class="modal-body">-->
<!--        <form>-->
<!--          <?php $captua_token = random_alphanumeric_string(6); ?>-->
<!--          <input type="hidden" id="csrf" class="csrf" name="csrf_token" value="<?= $captua_token ?>">-->
<!--          <div class="mb-3 row">-->
<!--            <div class="col-md-6 custom_class firscls">-->
<!--              <fieldset>-->
<!--                <legend>Full Name</legend>-->
<!--                <input type="text" name="name" autocomplete="off" id="modal_name" class="form-control ucwords restrictedInput" placeholder="Eg. John Doe" required>-->
<!--              </fieldset>-->
<!--            </div>-->
<!--            <div class="col-md-6 custom_class">-->
<!--              <fieldset>-->
<!--                <legend>Mobile Number</legend>-->
<!--                <input type="text" class="form-control numbersWithZeroOnlyInput" autocomplete="off" maxlength="10" minlength="10" id="modal_phone" name="num" placeholder="Eg. 9XXXXXXXXX" required>-->
<!--              </fieldset>-->
<!--            </div>-->
<!--            <div class="col-md-6 custom_class">-->
<!--              <fieldset>-->
<!--                <legend>Class</legend>-->
<!--                <select class="form-select" id="modal_class_id" required aria-label="Default select example" onchange="getSubject(this.value,'modal_subject')">-->
<!--                  <option  value="">Choose option</option>-->
<!--                  <?php if(!empty($class_list)){foreach($class_list as $mckey=>$mcvalue){?>-->
<!--                  <option value="<?=$mcvalue['id']?>"><?=$mcvalue['class_name']?></option>-->
<!--                  <?php }} ?>-->
<!--                </select>-->
<!--              </fieldset>-->
<!--            </div>-->
<!--            <div class="col-md-6 custom_class">-->
<!--              <fieldset>-->
<!--                <legend>Subject</legend>-->
<!--                <select class="form-select" aria-label="Default select example" id="modal_subject" required>-->
<!--                  <option value="">Choose option</option>-->
<!--                </select>-->
<!--              </fieldset>-->
<!--            </div>-->
<!--            <div class="col-md-6 custom_class">-->
<!--              <fieldset>-->
<!--                <legend>Board</legend>-->
<!--                <select class="form-select" aria-label="Default select example" id="modal_board" required>-->
<!--                  <option  value="">Choose option</option>-->
<!--                  <?php if(!empty($board_list)){foreach($board_list as $mbkey=>$mbvalue){?>-->
<!--                  <option value="<?=$mbvalue['id']?>"><?=$mbvalue['board_name']?></option>-->
<!--                  <?php }} ?>-->
<!--                </select>-->
<!--              </fieldset>-->
<!--            </div>-->
<!--            <div class="col-md-6 custom_class">-->
<!--              <fieldset>-->
<!--                <legend>Gender</legend>-->
<!--                <select class="form-select" id="modal_gender" aria-label="Default select example" required>-->
<!--                  <option value="">Choose option</option>-->
<!--                  <option value="Male">Male</option>-->
<!--                  <option value="Female">Female</option>-->
<!--                  <option value="Others">Others</option>-->
<!--                </select>-->
<!--              </fieldset>-->
<!--            </div>-->
<!--            <div class="col-md-6 custom_class">-->
<!--              <fieldset>-->
<!--                <legend>City</legend>-->
<!--                <select class="form-select" id="modal_location" aria-label="Default select example" required>-->
<!--                  <option  value="">Choose option</option>-->
<!--                  <?php if(!empty($city_list)){foreach($city_list as $mclkey=>$mclvalue){?>-->
<!--                  <option value="<?=$mclvalue['id']?>"><?=$mclvalue['city_name']?></option>-->
<!--                  <?php }} ?>-->
<!--                </select>-->
<!--              </fieldset>-->
<!--            </div>-->
<!--            <div class="col-md-6 custom_class">-->
<!--              <fieldset>-->
<!--                <legend>Tuition Mode</legend>-->
<!--                <select class="form-select" id="modal_tuition_mode" aria-label="Default select example" required>-->
<!--                  <option value="">Choose option</option>-->
<!--                  <option value="At Home">At Home</option>-->
<!--                  <option value="Online">Online</option>-->
<!--                </select>-->
<!--              </fieldset>-->
<!--            </div>-->
<!--            <div class="col-md-12 custom_class">-->
<!--              <div class="row py-2 px-4">-->
<!--                <div class="bgreprat col-lg-5 col-11">-->
<!--                  <?= $captua_token; ?>-->
<!--                </div>-->
<!--                <div class="col-lg-1 col-1 py-2 py-lg-1 ps-0 ps-lg-1">-->
<!--                  <span class="bgreprat-refesh ps-0" style="cursor:pointer;" onclick="getRandomCaptcha()"><img-->
<!--                    src="<?= base_url('assets') ?>/refresh.png" class="w-100"></span>-->
<!--                </div>-->
<!--                <div class="col-lg-6 ps-0 ps-lg-3">-->
<!--                  <div class="form-group">-->
<!--                    <input type="text" name="match_captcha" maxlength="6" class="form-control" id="match_captcha"-->
<!--                      autocomplete="off" placeholder="Enter Captcha" />-->
<!--                  </div>-->
<!--                </div>-->
<!--              </div>-->
<!--            </div>-->
<!--          </div>-->
<!--          <div class="col-lg-12 d-grid">-->
<!--            <button type="button" class="btn modalsubmitbtn" id="modalsubmit" onclick="return validateModalForm()">-->
<!--              Submit -->
<!--              <div class="spinner-border spinner-border-sm text-white" id="loader" role="status">-->
<!--                <span class="visually-hidden">Loading...</span></div>-->
<!--            </button>-->
<!--            </div>-->
<!--        </form>-->
<!--        </div>-->
<!--      </div>-->
<!--    </div>-->
<!--  </div>-->
<!--</span>-->
<span>
  <div class="modal fade mt-5" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-body">
          <div class="row justify-content-center">
            <div class="col-12 col-md-6 col-lg-4" style="min-width: 500px;">
              <div class="card bg-white border-0">
                <div class="card-body text-center Otp-section">
                  <input type="hidden" id="resp_otp" value="" >
                  <h4>Verify by OTP</h4>
                  <p id="resp_message"></p>
                  <div class="otp-field mb-4">
                    <input type="text" class="otp numbersOnly" oninput="digitValidate(this)" onkeyup="tabChange(1)" maxlength="1" minlength="1" id="first" autocomplete="off" required/>
                    <input type="text" class="otp numbersOnly" oninput="digitValidate(this)" onkeyup="tabChange(2)" maxlength="1" minlength="1" id="second" autocomplete="off" required/>
                    <input type="text" class="otp numbersOnly" oninput="digitValidate(this)" onkeyup="tabChange(3)" maxlength="1" minlength="1" id="third" autocomplete="off" required/>
                    <input type="text" class="otp numbersOnly" oninput="digitValidate(this)" onkeyup="tabChange(4)" maxlength="1" minlength="1" id="fourth" autocomplete="off" required/>
                  </div>
                  <button class="btn btn-success mt-1" id="resendOtp" onclick="return resendOtp()">
                  Resend OTP
                  </button>
                  <button class="btn btn-varify-otp mb-3" id="verifyOtp" onclick="return verifyOtp()">
                  Verify
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</span>

<script src="https://cdnjs.cloudflare.com/ajax/libs/datepicker/1.0.10/datepicker.min.js" integrity="sha512-RCgrAvvoLpP7KVgTkTctrUdv7C6t7Un3p1iaoPr1++3pybCyCsCZZN7QEHMZTcJTmcJ7jzexTO+eFpHk4OCFAg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $(document).ready(function(){
        $('#tutor_dob').datepicker({
            format: 'dd/mm/yyyy',
            autoclose: true,
            endDate: new Date(), // Disable future dates
            todayHighlight: true // Highlight today's date
        });

        // Event listener for date selection
        $('#tutor_dob').on('changeDate', function(){
            $('#tutor_dob').datepicker('hide');
        });
    });
</script>





<script>

  document.querySelectorAll(".otSc").forEach(function (otpEl) {
    otpEl.addEventListener("keyup", backSp);
    otpEl.addEventListener("keypress", function () {
      var nexEl = this.nextElementSibling;
      nexEl.focus();
    })
  })

  function backSp(backKey) {
    if (backKey.keyCode == 8) {
      var prev = this.previousElementSibling.focus()
    }
  }
  
  function getSubject(class_id,append_id){
      $('#'+append_id).html('');
    $.ajax({
      url: '<?= base_url('getSubject') ?>',
      type: "POST",
      data: { 'class_id': class_id},
      cache: false,
      success: function (response) {
          $('#'+append_id).html(response);
      }
    });
  }
  $('#loader').hide();
  function validateModalForm() {
    var name = $('#modal_name').val().trim();
    var phone = $('#modal_phone').val().trim();
    var class_id = $('#modal_class_id').val().trim();
    var subject = $('#modal_subject').val().trim();
    var board = $('#modal_board').val().trim();
    var gender = $('#modal_gender').val().trim();
    var city_id = $('#modal_location').val().trim();
    var tuition_mode = $('#modal_tuition_mode').val().trim();
    var csrf = $('#csrf').val().trim();
    var match_captcha = $('#match_captcha').val().trim();

    if (name === "") {
        toastr.error('Please Enter Name');
        return false;
    } else if (phone === "") {
        toastr.error('Please Enter Mobile Number');
        return false;
    } else if (phone.length !== 10 || isNaN(phone)) {
        toastr.error('Please Enter A Valid 10 Digit Mobile Number');
        return false;
    } else if (class_id === "") {
        toastr.error('Please Select Class');
        return false;
    } else if (subject === "") {
        toastr.error('Please Select Subject');
        return false;
    } else if (board === "") {
        toastr.error('Please Select Board');
        return false;
    } else if (gender === "") {
        toastr.error('Please Select Gender');
        return false;
    } else if (city_id === "") {
        toastr.error('Please Select City');
        return false;
    } else if (tuition_mode === "") {
        toastr.error('Please Select Tuition Mode');
        return false;
    } else if (match_captcha === "") {
        toastr.error('Please Enter Captcha');
        return false;
    } else if (match_captcha !== csrf) {
        toastr.error('Captcha Not Match');
        return false;
    } else {
        $.ajax({
            url: '<?= base_url('save-tutor-query') ?>',
            type: 'POST',
            data: {
                'name': name,
                'mobile_no': phone,
                'match_captcha': match_captcha,
                'csrf': csrf,
                'class_id': class_id, // Changed key name
                'subject': subject,
                'board': board,
                'gender': gender,
                'city_id': city_id,
                'tuition_mode': tuition_mode,
            },
            cache: false,
            dataType: "json",
            beforeSend: function () {
                $('#modalsubmit').prop('disabled', true);
                $('#loader').show();
            },
            success: function (response) {
                if (response.status === false) {
                    toastr.error(response.message);
                    $('#modalsubmit').prop('disabled', true);
                } else if (response.status === true) {
                    $('#modalsubmit').prop('disabled', true);
                    $('#loader').hide();
                    toastr.success(response.message);
                    $('#exampleModal').find('form').trigger('reset');
                    $('#exampleModal').modal('hide'); 
                }
            },
            error: function () {
                console.log('Error occurred during AJAX request');
            }
        });
    }
}


$('#verified').hide();
function checkOtp() {

    var tutor_mobile = $('#tutor_mobile').val().trim();
    var tutor_email = $('#tutor_email').val().trim();
    
    if (tutor_mobile === "") {
        toastr.error('Please Enter Mobile Number');
        $('#exampleModal2').modal('hide');
        return false;
    } else if (tutor_mobile.length !== 10) {
        toastr.error('Please Enter A Valid 10 Digit Mobile Number');
        $('#exampleModal2').modal('hide');
        return false;
    } else if (tutor_email == "") {
        toastr.error('Please Enter Email');
        $('#exampleModal2').modal('hide');
        return false;
    } else {
      $.ajax({
       url: "<?=base_url('sendOtp')?>",
       cache: false,
       data:{tutor_mobile:tutor_mobile,tutor_email:tutor_email},
       method: 'POST',
       dataType:'json',
       success: function(response) {
           if(response.status==true){
            toastr.success(response.message);
            $('#resp_otp').val(response.otp);
            $('#resp_message').html(response.message);
            $('#exampleModal2').modal('show');
            
           }else if(response.status==false){
            toastr.error(response.message);
           }
       }
   });
    } 
}

function resendOtp() {

var tutor_mobile = $('#tutor_mobile').val().trim();
var tutor_email = $('#tutor_email').val().trim();

  $.ajax({
   url: "<?=base_url('resendOtp')?>",
   cache: false,
   data:{tutor_mobile:tutor_mobile,tutor_email:tutor_email},
   method: 'POST',
   dataType:'json',
   beforeSend: () => {
            $('#resendOtp').text('Please Wait...');
            $('#resendOtp').prop("disabled", true);
         },
   success: function(response) {
       if(response.status==true){
        toastr.success(response.message);
        $('#resp_otp').val(response.otp);
        $('#resendOtp').text('Resend OTP');
        $('#resendOtp').prop("disabled", false);
        //$('#resp_message').html(response.message); 
       }else if(response.status==false){
        toastr.error(response.message);
        $('#resendOtp').text('Resend OTP');
        $('#resendOtp').prop("disabled", false);
       }
   }
});
} 


function verifyOtp(){
  var otp = $('#first').val()+$('#second').val()+$('#third').val()+$('#fourth').val();
  var sent_otp = $('#resp_otp').val();
  var tutor_mobile = $('#tutor_mobile').val().trim();
  var tutor_email = $('#tutor_email').val().trim();
  if(otp.length != 4){
    toastr.error('Enter A Valid Otp');
    return false;
  } else if(otp !== sent_otp){
    toastr.error('OTP Not Match');
    return false;
  } else{
    $.ajax({
       url: "<?=base_url('verifyOtp')?>",
       cache: false,
       data:{otp:otp,sent_otp:sent_otp,tutor_mobile:tutor_mobile,tutor_email:tutor_email},
       method: 'POST',
       dataType:'json',
       beforeSend: () => {
            $('#verifyOtp').text('Please Wait...');
            $('#verifyOtp').prop("disabled", true);
         },
       success: function(response) {
           if(response.status==true){
            toastr.success(response.message);
            $('#exampleModal2').modal('hide');
            $('#resp_otp').val('');
            $('#verified').show();
            //$('#verify').hide();
            setTimeout(function() {
             window.location.href = '' + response.goto;
             },1000);
           }else if(response.status==false){
            toastr.error(response.message);
           }
       }
   });
  } 
}

document.addEventListener("DOMContentLoaded", function () {
    var tabs = document.querySelectorAll('.tabcontent');
    var tabLinks = document.querySelectorAll('.tablinks');
    var currentTab = 0;
    var btnPrevious = document.querySelector('.btnPrevious');
    var btnNext = document.querySelector('.btnNext');
    var submitButton = document.querySelector('.submitButton');

    // Function to switch between tabs
    function openTab(tabIndex) {
      
      tabs.forEach(function (tab) {
        tab.classList.remove('active');
      });
      tabLinks.forEach(function (link) {
        link.classList.remove('active');
      });
      tabs[tabIndex].classList.add('active');
      tabLinks[tabIndex].classList.add('active');

      // Toggle display of Previous button
      btnPrevious.style.display = (tabIndex === 0) ? "none" : "block";
      // Toggle display of Next button
      btnNext.style.display = (tabIndex === tabs.length - 1) ? "none" : "block";
      // Toggle display of Submit button
      submitButton.style.display = (tabIndex === tabs.length - 1) ? "block" : "none";
    }

    // Next button functionality
    btnNext.addEventListener('click', function (e) {
    var tutor_name = $('#tutor_name').val().trim();
    var tutor_dob = $('#tutor_dob').val().trim();
    var tutor_gender = $('.tutor_gender:checked').val();
    var tutor_email = $('#tutor_email').val().trim();
    var tutor_mobile = $('#tutor_mobile').val().trim();
    var tutor_address = $('#tutor_address').val().trim();
    var tutor_city = $('#tutor_city').val();
    var tutor_pincode = $('#tutor_pincode').val();
    var t_and_c = $('#exampleCheck1').is(':checked');

    if (tutor_name === "") {
        toastr.error('Please Enter Name');
        return false;
    } else if (tutor_dob === "") {
        toastr.error('Please Select Date Of Birth');
        return false;
    } else if (tutor_gender === undefined) {
        toastr.error('Please Select Gender');
        return false;
    } else if (tutor_email === "") {
        toastr.error('Please Enter Email');
        return false;
    } else if (tutor_mobile === "") {
        toastr.error('Please Enter Mobile Number');
        return false;
    } else if (tutor_mobile.length != 10) {
        toastr.error('Please Enter A Valid 10 Digit Mobile Number');
        return false;
    } else if (tutor_address === "") {
        toastr.error('Please Enter Address');
        return false;
    } else if (tutor_city === "") {
        toastr.error('Please Select City');
        return false;
    } else if (tutor_pincode === "") {
        toastr.error('Please Enter Pincode');
        return false;
    } else if (!t_and_c) {
        toastr.error('Please Check Terms And Policy');
        return false;
    } else{
      $.ajax({
       url: "<?=base_url('checkUserVerification')?>",
       cache: false,
       data:{mobile_no:tutor_mobile,
            tutor_name:tutor_name,
            dob:tutor_dob,
            gender:tutor_gender,
            email:tutor_email,
            address:tutor_address,
            city:tutor_city,
            pincode:tutor_pincode
          },
       method: 'POST',
       dataType:'json',
       beforeSend: () => {
            $('#save').text('Please Wait...');
            $('#save').prop("disabled", true);
         },
       success: function(response) {
           if(response.status==true){
            toastr.success(response.message);
            $('#exampleModal2').modal('show');
            $('#resp_otp').val(response.otp);
            $('#resp_message').html(response.message);
           }else if(response.status==false){
            toastr.error(response.message);
            $('#save').html('<span>Save</span> <i class="fa-solid fa-arrow-right"></i>');
            $('#save').prop("disabled", false);
           }
       }
   });
    }
     
    });


    // btnNext.addEventListener('click', function (e) {
    //   currentTab = (currentTab + 1) % tabs.length;
    //   openTab(currentTab);
    // });

    // Previous button functionality
    btnPrevious.addEventListener('click', function () {
      currentTab = (currentTab - 1 + tabs.length) % tabs.length;
      openTab(currentTab);
    });

    // Open the first tab by default
    openTab(currentTab);
  });
</script>



