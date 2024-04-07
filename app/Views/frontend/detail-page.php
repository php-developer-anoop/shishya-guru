<main id="main" class="institute-sec_page">
  <section class="breadcrumbs-sec">
    <div class="page-title">
      <nav class="breadcrumbs">
        <div class="">
          <ol>
            <li><a href="<?=base_url()?>">Home</a></li>
            <i class="fa-solid fa-chevron-right"></i>
            <li><a href="<?=base_url('tutor-list')?>">Tutor</a></li>
            <i class="fa-solid fa-chevron-right"></i>
            <input type="hidden" id="tutor_id" value="<?=!empty($tutor['id'])?$tutor['id']:''?>">
            <input type="hidden" id="tutor" value="<?= !empty($tutor['tutor_name']) ? $tutor['tutor_name'] : '' ?>/<?= !empty($tutor['unique_id']) ? $tutor['unique_id'] : '' ?>">
            <li class="current"><?=!empty($tutor['tutor_name'])?$tutor['tutor_name']:''?></li>
            <i class="fa-solid fa-chevron-right"></i>
            <li class=""><?=!empty($tutor['unique_id'])?$tutor['unique_id']:''?></li>
          </ol>
        </div>
      </nav>
      <?php 
        $topimage = (!empty($banner['banner_image_jpg']) && !empty($banner['banner_image_webp'])) ? base_url('uploads/') . imgExtension($banner['banner_image_jpg'], $banner['banner_image_webp']) : "";
        ?>
      <section class="registration content-section p-0">
        <img src="<?=$topimage?>" class="img-fluid">
      </section>
    </div>
  </section>
  <div class="card border-0 teacherdetailspage">
    <div class="cardbody-sec row mx-auto">
      <div class="col-lg-2 col-md-4 detailspage p-0">
        <div class="doc-info-left justify-content-center">
          <div class="doctor-img extracls-detailspage">
            <img src="<?=!empty($tutor['profile_image'])?base_url('uploads/').$tutor['profile_image']:''?>" class="img-fluid teachercarddeatlis h-100" alt="User Image">
          </div>
        </div>
      </div>
      <div class="col-lg-10 col-md-8 p-0">
        <div class="doc-info-cont">

          <div class="clinic-details detailsPage">
            <div class="col-lg-12 row">
              <div class="col-lg-3 col-md-3">
       <h4 class="doc-name"><a href="javascript:void(0)"><?=!empty($tutor['tutor_name'])?$tutor['tutor_name']:'N/A'?> </a></h4>
                <div class="col-md-12">
                    
                  <div class="d-flex appoitnment-img">
                    <img src="<?=base_url('assets/frontend')?>/img/Book.png" class="img-fluid">
                    <p class="doc-location"><?=!empty($tutor['experience_years'])?$tutor['experience_years'].' Years':'N/A'?> </p>
                  </div>
                </div>
                <div class="col-md-12 mt-1">
               
                  <div class="d-flex appoitnment-img">
                    <img src="<?=base_url('assets/frontend')?>/img/rupees.png" class="img-fluid">
                    <p class="doc-location"><?=!empty($tutor['monthly_fees'])?(int)$tutor['monthly_fees'].' / Month':'N/A'?></p>
                  </div>
                </div>
              </div>
              <div class="col-lg-6 col-md-6">
      <h4 class="doc-name" style="visibility: hidden;"><a href="javascript:void(0)"><?=!empty($tutor['tutor_name'])?$tutor['tutor_name']:'N/A'?> </a></h4>
                <div class="col-md-12">
                  <div class="d-flex appoitnment-img">
                    <img src="<?=base_url('assets/frontend')?>/img/Location.png" class="img-fluid">
                    <p class="doc-location"><?=!empty($tutor['address'])?$tutor['address']:'N/A'?></p>
                  </div>
                </div>
                <div class="col-md-12 mt-1">
                  <div class="d-flex appoitnment-img">
                    <img src="<?=base_url('assets/frontend')?>/img/profile (1).png" class="img-fluid">
                    <p class="doc-location"><?=!empty($tutor['gender'])?$tutor['gender']:'N/A'?></p>
                  </div>
                </div>
              </div>
              <div class="col-lg-3 col-md-3">
                <div class="doc-info-right">
                  <div class="">
                    <div class="d-flex justify-content-end gap-4 mb-1">
                      <a href="<?=!empty($tutor['tutor_slug'])?'https://www.facebook.com/sharer/sharer.php?u='.base_url($tutor['tutor_slug']):'javascript:void(0)'?>" ><i class="bi bi-facebook"></i></a>
                      <a href="<?=!empty($tutor['tutor_slug'])?'https://twitter.com/intent/tweet?url='.base_url($tutor['tutor_slug']):'javascript:void(0)'?>"><i class="bi bi-twitter"></i></a>
                      <a href="<?=!empty($tutor['tutor_slug'])?'https://api.whatsapp.com/send?text='.base_url($tutor['tutor_slug']):'javascript:void(0)'?>"><i class="bi bi-whatsapp"></i></a>
                      <a href="<?=!empty($tutor['tutor_slug'])?'https://www.linkedin.com/sharing/share-offsite/&amp;url='.base_url($tutor['tutor_slug']):'javascript:void(0)'?>"><i class="bi bi-linkedin"></i></a>
                    </div>
                  </div>
                  <div class="clini-infos">
                    <ul>
                      <li><i class="fa-solid fa-star"></i> <?=!empty($tutor['avg_rating'])?$tutor['avg_rating']:'N/A'?> <?=!empty($tutor['total_reviews'])?'('.$tutor['total_reviews'].' reviews)':'N/A'?> </li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="col-lg-12 col-md-12 row m-0 p-0 d-flex align-items-center">
                <div class="col-lg-9 col-md-8">
                  <div class="clinic-services">
                    <p class="m-0 px-1">Also Listed In</p>
                    <?php $boards=!empty($tutor['board'])?getMultipleBoard($tutor['board']):'';
                      $boardsArray=!empty($boards)?explode(',',$boards):[];
                      
                      $subject=!empty($tutor['subject'])?getMultipleSubject($tutor['subject']):'';
                      $subjectArray=!empty($subject)?explode(',',$subject):[];
                      
                      ?>
                    <?php if(!empty($boardsArray)){foreach($boardsArray as $bakey=>$bavalue){?>
                    <span><?=$bavalue?></span>
                    <?php }} ?>
                    <?php if(!empty($subjectArray)){foreach($subjectArray as $sakey=>$savalue){?>
                    <span><?=$savalue?></span>
                    <?php }} ?>
                  </div>
                </div>
                <div class="col-lg-3 col-md-4 m-0 p-0">
                  <div class="carddetailsbtn d-flex align-items-center justify-content-end">
                    <a href="<?=!empty($tutor['mobile_no'])?'javascript:void(0)':''?>" class="details teachergetcall mx-1"> <i class="fa fa-phone px-1"
                      aria-hidden="true"></i>Get Call Now</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="details-section">
    <div class="col-lg-12 row">
      <div class="col-lg-9">
        <div class=" px-1 col-lg-8 col-md-12 col-sm-12">
          <nav class="user-tabs my-2">
            <div class="tabs d-flex justify-content-around gap-3">
              <div class="tab">
                <button class="tablinks active">Home</button>
              </div>
              <div class="tab">
                <button class="tablinks"><a href="javascript:void(0)" onclick="goToByScroll('service')">Service</a></button>
              </div>
              <div class="tab">
                <button class="tablinks"><a href="javascript:void(0)" onclick="goToByScroll('subjects')">Subjects</a></button>
              </div>
              <div class="tab">
                <button class="tablinks"><a href="javascript:void(0)" onclick="goToByScroll('skills')">Skills</a></button>
              </div>
              <div class="tab">
                <button class="tablinks" ><a href="javascript:void(0)" onclick="goToByScroll('contact')">Contact</a></button>
              </div>
              <div class="tab">
                <button class="tablinks" ><a href="javascript:void(0)" onclick="goToByScroll('rating')">Rating</a></button>
              </div>
            </div>
          </nav>
        </div>
        <div class="card">
          <div class="card-body pt-0 detailsection">
            <div id="tab1" class="tabcontent" style="display: block;">
              <h3>About</h3>
              <p><?=!empty($tutor['about_description'])?$tutor['about_description']:'N/A'?>
              </p>
              <div class="teacher-infomation">
                <h3>Quick Information</h3>
                <div class="quick-infotmation d-flex justify-content-between">
                  <div>
                    <p>Mode of Payment</p>
                    <p><b><?=!empty($tutor['payment_mode'])?$tutor['payment_mode']:'N/A'?></b></p>
                  </div>
                  <div>
                    <p>Year Of Experience</p>
                    <p><b><?=!empty($tutor['experience_years'])?$tutor['experience_years'].' Years':'N/A'?></b></p>
                  </div>
                  <div>
                    <p>Days</p>
                    <p><b><?=!empty($tutor['days'])?$tutor['days']:'N/A'?></b></p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <section class="registration content-section p-0 mt-3 d-none">
          <img src="<?=base_url('assets/frontend')?>/img/instute badcrum.png" class="img-fluid w-100">
        </section>
        <?php if(!empty($tutor['class'])){?>
        <section id="service" class="services-sec">
          <div class="row" >
            <div class="col-md-2">
              <h4>Services</h4>
            </div>
            <?php $class = !empty($tutor['class']) ? getMultipleClass($tutor['class']) : '';
              $classArray = !empty($class) ? explode(',', $class) : [];
              $total_points = count($classArray);
              $third_point_count = ceil($total_points / 3);
              
              $first_half = array_slice($classArray, 0, $third_point_count); 
              $second_half = array_slice($classArray, $third_point_count, $third_point_count); 
              $third_half = array_slice($classArray, 2 * $third_point_count); 
                    
                ?>
            <div class="col-md-10 col-lg-10">
              <div class="allservice-sec row">
                <div class="col-md-4">
                  <ul class="m-0 p-0">
                    <?php
                      $i = 1;
                      foreach ($first_half as $apkey => $apvalue) {
                      ?>
                    <li><span><i class="fas fa-check-circle"></i></span> <?= preg_replace("/[^a-zA-Z0-9\s]/", "", $apvalue) ?></li>
                    <?php $i++;
                      } ?>
                  </ul>
                </div>
                <div class="col-md-4">
                  <ul class="m-0 p-0">
                    <?php
                      foreach ($second_half as $apkey => $apvalue) {
                      ?>
                    <li><span><i class="fas fa-check-circle"></i></span> <?= preg_replace("/[^a-zA-Z0-9\s]/", "", $apvalue) ?></li>
                    <?php $i++;
                      } ?>
                  </ul>
                </div>
                <div class="col-md-4">
                  <ul class="m-0 p-0">
                    <?php
                      foreach ($third_half as $apkey => $apvalue) {
                      ?>
                    <li><span><i class="fas fa-check-circle"></i></span> <?= preg_replace("/[^a-zA-Z0-9\s]/", "", $apvalue) ?></li>
                    <?php $i++;
                      } ?>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </section>
        <?php } ?>
        <?php if(!empty($tutor['subject'])){?>
        <section id="subjects" class="services-sec">
          <div class="row" >
            <div class="col-md-2">
              <h4>Subjects</h4>
            </div>
            <?php $subject = !empty($tutor['subject']) ? getMultipleSubject($tutor['subject']) : '';
              $subjectArray = !empty($subject) ? explode(',', $subject) : [];
              $total_points = count($subjectArray);
              $third_point_count = ceil($total_points / 3);
              
              $first_half = array_slice($subjectArray, 0, $third_point_count); 
              $second_half = array_slice($subjectArray, $third_point_count, $third_point_count); 
              $third_half = array_slice($subjectArray, 2 * $third_point_count); 
                    
                ?>
            <div class="col-md-10 col-lg-10">
              <div class="allservice-sec row">
                <div class="col-md-4">
                  <ul class="m-0 p-0">
                    <?php
                      $i = 1;
                      foreach ($first_half as $apkey => $apvalue) {
                      ?>
                    <li><span><i class="fas fa-check-circle"></i></span> <?= preg_replace("/[^a-zA-Z0-9\s]/", "", $apvalue) ?></li>
                    <?php $i++;
                      } ?>
                  </ul>
                </div>
                <div class="col-md-4">
                  <ul class="m-0 p-0">
                    <?php
                      foreach ($second_half as $apkey => $apvalue) {
                      ?>
                    <li><span><i class="fas fa-check-circle"></i></span> <?= preg_replace("/[^a-zA-Z0-9\s]/", "", $apvalue) ?></li>
                    <?php $i++;
                      } ?>
                  </ul>
                </div>
                <div class="col-md-4">
                  <ul class="m-0 p-0">
                    <?php
                      foreach ($third_half as $apkey => $apvalue) {
                      ?>
                    <li><span><i class="fas fa-check-circle"></i></span> <?= preg_replace("/[^a-zA-Z0-9\s]/", "", $apvalue) ?></li>
                    <?php $i++;
                      } ?>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </section>
        <?php } ?>
        <?php if(!empty($tutor['skill'])){?>
        <section id="skills" class="services-sec">
          <div class="row" >
            <div class="col-md-2">
              <h4>Skills</h4>
            </div>
            <?php $skill = !empty($tutor['skill']) ? getMultipleSkill($tutor['skill']) : '';
              $skillsArray = !empty($skill) ? explode(',', $skill) : [];
              $total_points = count($skillsArray);
              $third_point_count = ceil($total_points / 3);
              
              $first_half = array_slice($skillsArray, 0, $third_point_count); 
              $second_half = array_slice($skillsArray, $third_point_count, $third_point_count); 
              $third_half = array_slice($skillsArray, 2 * $third_point_count); 
                    
                ?>
            <div class="col-md-10 col-lg-10">
              <div class="allservice-sec row">
                <div class="col-md-4">
                  <ul class="m-0 p-0">
                    <?php
                      $i = 1;
                      foreach ($first_half as $apkey => $apvalue) {
                      ?>
                    <li><span><i class="fas fa-check-circle"></i></span> <?= preg_replace("/[^a-zA-Z0-9\s]/", "", $apvalue) ?></li>
                    <?php $i++;
                      } ?>
                  </ul>
                </div>
                <div class="col-md-4">
                  <ul class="m-0 p-0">
                    <?php
                      foreach ($second_half as $apkey => $apvalue) {
                      ?>
                    <li><span><i class="fas fa-check-circle"></i></span> <?= preg_replace("/[^a-zA-Z0-9\s]/", "", $apvalue) ?></li>
                    <?php $i++;
                      } ?>
                  </ul>
                </div>
                <div class="col-md-4">
                  <ul class="m-0 p-0">
                    <?php
                      foreach ($third_half as $apkey => $apvalue) {
                      ?>
                    <li><span><i class="fas fa-check-circle"></i></span> <?= preg_replace("/[^a-zA-Z0-9\s]/", "", $apvalue) ?></li>
                    <?php $i++;
                      } ?>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </section>
        <?php } ?>
        <section id="contact" class="services-sec">
          <div class="row">
            <div class="col-md-12">
              <h4>Contact</h4>
            </div>
            <div class="col-md-12 col-lg-12">
              <div class="allservice-sec row">
                <div class="col-md-4">
                  <ul class="m-0 p-0">
                    <li><i class="fa-solid fa-location-dot"></i> <?=!empty($tutor['address'])?$tutor['address']:'N/A'?> - <?=!empty($tutor['pincode'])?$tutor['pincode']:''?></li>
                  </ul>
                </div>
                <div class="col-md-5">
                  <ul>
                    <li><i class="fa fa-envelope" aria-hidden="true"></i> sxxxx@xxxx.com</li>
                  </ul>
                </div>
                <div class="col-md-3">
                  <ul>
                    <li><i class="fa fa-phone" aria-hidden="true"></i> <?=!empty($tutor['mobile_no'])?'+91xxxxxxxx0':'N/A'?></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
      <div class="col-lg-3">
        <div class="side-section" id="custumscroll">
          <div class="title">
            <h3>Book Demo Now</h3>
          </div>
          <div class="Bookdemoclass">
            <div class="col-lg-12">
              <form  id="demoForm" class="" data-aos="fade-up" data-aos-delay="200">
                <?php $captua_token = random_alphanumeric_string(6); ?>
                <input type="hidden" id="csrf" class="csrf" name="csrf_token" value="<?= $captua_token ?>">
                <div class="row gy-4 pt-1">
                  <div class="col-md-12 custom_class firscls">
                    <fieldset>
                      <legend>Full Name</legend>
                      <input type="text" name="name" autocomplete="off" class="form-control ucwords restrictedInput" id="name" placeholder="Eg.John Doe" required>
                    </fieldset>
                  </div>
                  <div class="col-md-12 custom_class">
                    <fieldset>
                      <legend>Email ID</legend>
                      <input type="email" class="form-control emailInput" autocomplete="off" name="email" id="email" placeholder="Eg. abc@gmail.com" required>
                    </fieldset>
                  </div>
                  <div class="col-md-12 custom_class">
                    <fieldset>
                      <legend>Mobile Number</legend>
                      <input type="text" class="form-control numbersWithZeroOnlyInput" autocomplete="off" maxlength="10" minlength="10" name="num" id="mobile_no" placeholder="Eg. 9XXXXXXXX" required>
                    </fieldset>
                  </div>
                  <div class="col-md-12 custom_class">
                    <fieldset>
                      <legend>Board</legend>
                      <select class="form-select" id="board" aria-label="Default select example">
                        <option value="">Choose option</option>
                        <?php if(!empty($board_list)){foreach($board_list as $blkey=>$blvalue){?>
                        <option value="<?=$blvalue['id']?>"><?=$blvalue['board_name']?></option>
                        <?php  }} ?>
                      </select>
                    </fieldset>
                  </div>
                  <div class="col-md-12 custom_class">
                    <fieldset>
                      <legend>Class</legend>
                      <select class="form-select" id="class" aria-label="Default select example" onchange="getSubject(this.value,'subject')">
                        <option value="">Choose option</option>
                        <?php if(!empty($class_list)){foreach($class_list as $clkey=>$clvalue){?>
                        <option value="<?=$clvalue['id']?>"><?=$clvalue['class_name']?></option>
                        <?php  }} ?>
                      </select>
                    </fieldset>
                  </div>
                  <div class="col-md-12 custom_class">
                    <fieldset>
                      <legend>Subject</legend>
                      <select class="form-select" id="subject" aria-label="Default select example">
                        <option value="">Choose option</option>
                      </select>
                    </fieldset>
                  </div>
                  <div class="col-md-12 custom_class">
                    <fieldset>
                      <legend>Gender</legend>
                      <select class="form-select"  aria-label="Default select example" id="gender">
                        <option value="">Choose option</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                      </select>
                    </fieldset>
                  </div>
                  <div class="col-md-12 custom_class">
                    <fieldset>
                      <legend>City</legend>
                      <select class="form-select" aria-label="Default select example" id="location">
                        <option value="">Choose option</option>
                        <?php if(!empty($city_list)){foreach($city_list as $llkey=>$llvalue){?>
                        <option value="<?=$llvalue['id']?>"><?=$llvalue['city_name'].' , '.$llvalue['state_name']?></option>
                        <?php  }} ?>
                      </select>
                    </fieldset>
                  </div>
                  <div class="col-md-12 custom_class firscls">
                    <fieldset>
                      <legend>Enter Area</legend>
                      <input type="text" name="area" autocomplete="off" class="form-control ucwords restrictedInput" id="area" placeholder="Area" required>
                    </fieldset>
                  </div>
                  <div class="col-md-12 custom_class">
                    <fieldset>
                      <legend>Tuition Mode</legend>
                      <select class="form-select" aria-label="Default select example" id="mode">
                        <option value="">Choose option</option>
                        <option value="Online">Online</option>
                        <option value="At Home">At Home</option>
                      </select>
                    </fieldset>
                  </div>
                  <div class="col-md-12 custom_class">
                    <div class="row col-md-11 mx-auto">
                      <div class="bgreprat col-lg-9 ">
                        <?= $captua_token; ?>
                      </div>
                      <div class="col-lg-3">
                        <span class="bgreprat-refesh ps-0" style="cursor:pointer;" onclick="getRandomCaptcha()"><img
                          src="<?= base_url('assets') ?>/refresh.png" class="w-100"></span>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12 custom_class">
                    <input type="text" name="match_captcha" maxlength="6" class="form-control" id="match_captcha"
                      autocomplete="off" placeholder="Enter Captcha" />
                  </div>
                </div>
              </form>
            </div>
          </div>
          <div class="col-md-12 text-center">
            <p class="f-title">
              <a href="javascript:void(0)" onclick="return validateBookDemo()" id="sumbitdemo">
                Submit 
            <div class="spinner-border spinner-border-sm text-white" id="loader" role="status">
            <span class="visually-hidden">Loading...</span></div></a>
            </p>
          </div>
        </div>
      </div>
    </div>
    <div class="mid-section">
      <section id="rating" class="services-sec rating-sec">
        <div class="row">
          <div class="col-md-12">
            <h4>Rating & Reviews</h4>
          </div>
          <div class="Rating-review row ">
            <div class="col-lg-5 col-md-12 col-sm-12 d-flex mt-2">
              <div class="reviw-point">
                <!--<span>4.0</span>-->
              </div>
              <div class=" mx-3">
                <h5><a href="<?=base_url('reviews?tutor_id='.$tutor['id'])?>">View All <?=tutor_testimonial_count($tutor['id'])?> Ratings</a></h5>
                <p>Index based on <?=tutor_testimonial_count($tutor['id'])?> rating across web.</p>
              </div>
            </div>
            <div class="col-lg-7 col-md-12 col-sm-12 Start-rating d-flex">
              <h4>Start your rating</h4>
              <span class="d-flex">
                <div class="rating left">
                  <div class="stars right">
                    <a class="star rated"></a>
                    <a class="star rated"></a>
                    <a class="star rated"></a>
                    <a class="star"></a>
                    <a class="star"></a>
                  </div>
                </div>
              </span>
              <a href="javascript:void(0)" class="write-review" data-bs-toggle="modal" data-bs-target="#exampleModal3">Write Review</a>
            </div>
          </div>
          <?php if(!empty($reviews)){?>
          <div class="col-md-12 col-lg-12 mt-3">
            <div class="allservice-sec review-sections row">
              <?php foreach($reviews as $rkey=>$rvalue){?>
              <div class="col-md-6 col-lg-2 col-sm-6 mt-3">
                <div class="reviw-box">
                  <span class="text-center">
                    <h5><?=!empty($rvalue['name'])?$rvalue['name']:''?> <br>
                      from <?=!empty($rvalue['location'])?$rvalue['location']:''?>
                    </h5>
                  </span>
                  <p><?=!empty($rvalue['testimonial'])?$rvalue['testimonial']:''?></p>
                  <span class=" col-md-6 d-flex mx-auto justify-content-evenly">
                  <?=showRatings($rvalue['rating'])?>
                  </span>
                </div>
              </div>
              <?php } ?>
            </div>
          </div>
          <?php  } ?>
        </div>
      </section>
      <?php if (!empty($faq_list)) { ?>
      <section id="faq" class="faq section-bg">
        <div class="services-sec" data-aos="fade-up">
          <div class="faq-list">
            <h3 class="heading">Faq</h3>
            <ul>
              <?php foreach ($faq_list as $flkey => $flvalue) { ?>
              <li data-aos="fade-up" data-aos-delay="100">
                <i class="bx bx-help-circle icon-help"></i>
                <a data-bs-toggle="collapse" class="<?= $flkey != 0 ? "collapsed" : "" ?>" data-bs-target="#faq-list-<?php echo $flkey; ?>">
                <span class="accodiant_itmeheding"><?php echo $flvalue['question']; ?></span>
                <i class="fa-solid fa-circle-plus icon-show"></i><i class="fa-solid fa-circle-minus icon-close"></i>
                </a>
                <div id="faq-list-<?php echo $flkey; ?>" class="collapse <?php echo $flkey == 0 ? 'show' : ''; ?>" data-parent=".faq-list">
                  <p><?php echo $flvalue['answer']; ?></p>
                </div>
              </li>
              <?php } ?>
            </ul>
          </div>
        </div>
      </section>
      <?php } ?>
    </div>
  </div>
</main>
<?php  $bottombanner = !empty($home['bottom_banner_jpg'] || $home['bottom_banner_webp']) ? base_url('uploads/') . imgExtension($home['bottom_banner_jpg'], $home['bottom_banner_webp']) : "";  ?>
<section class="registration content-section resitation-page" style="background-image:url('<?=$bottombanner?>')">
  <div class="registertutor">
    <h3>
    Register as Tutor</h2>
    <p><i class="bi bi-chevron-double-up"></i> 2000+ Tutors already registered with us</p>
    <a class="cta-btn" href="<?=base_url('tutor-register')?>">Register Now</a>
  </div>
</section>
<div class="modal fade mt-5" id="exampleModal3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <div class="row justify-content-center">
          <div class="col-12 col-md-12 col-lg-12">
            <div class="card bg-white border-0">
              <div class="card-body  Otp-section">
                <div class=" col-md-10 mx-auto">
                  <h5>Enter Mobile Number</h5>
                  <input class="form-control numbersWithZeroOnlyInput" id="validphone" maxlength="10" type="text" name="phone" pattern="[0-9]*"
                    placeholder="Phone Number" required autocomplete="off" />
                  <input type="hidden" id="hidden_mobile_no" value="">
                  <div class="text-center">
                    <button class="btn btn-mobile-otp mb-3" id="send_otp" onclick="return validatePhoneNumber()">
                    Send OTP
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="modal fade mt-5" id="exampleModal4" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <div class="row justify-content-center">
          <div class="col-12 col-md-6 col-lg-4" style="min-width: 500px;">
            <div class="card bg-white border-0">
              <div class="card-body text-center Otp-section">
                <h4>Verify by OTP</h4>
                <p id="user_otp_message"></p>
                <div class="otp-field otpCont mb-4">
                  <input type="hidden" id="user_otp" value="">
                  <input class="otp numbersOnly" autocomplete="off" id="first" oninput="digitValidate(this)" onkeyup="tabChange(1)" type="text" maxlength="1">
                  <input class="otp numbersOnly" autocomplete="off" id="second" oninput="digitValidate(this)" onkeyup="tabChange(2)" type="text" maxlength="1">
                  <input class="otp numbersOnly" autocomplete="off" id="third" oninput="digitValidate(this)" onkeyup="tabChange(3)" type="text" maxlength="1">
                  <input class="otp numbersOnly" autocomplete="off" id="fourth" oninput="digitValidate(this)" onkeyup="tabChange(4)" type="text" maxlength="1">
                </div>
                <button class="btn btn-varify-otp mb-3" onclick="return validateOtp()" id="validate_otp">
                Verify
                </button>
                <button class="btn btn-success mt-1" id="resend_otp" onclick="return validateResendOtp()">
                Resend OTP
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="modal fade mt-5" id="exampleModal5" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <div class="row justify-content-center">
          <div class="col-12 col-md-12 col-lg-12">
            <div class="card bg-white border-0">
              <div class="card-body text-center">
                <div class="col-md-10 mx-auto">
                  <div class="ratewrap">
                    <label>Select Rating</label>
                    <ul id="stars" class="star_wrp">
                      <input type="hidden" id="user_rating" value="1">
                      <li class="star selected" title="Poor" data-value="1" onclick="ease_navigation('1');"> 
                        <i class="fa-regular fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                      </li>
                      <li class="star" title="Average" data-value="2" onclick="ease_navigation('2');"> 
                        <i class="fa-regular fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                      </li>
                      <li class="star" title="Average" data-value="3" onclick="ease_navigation('3');"> 
                        <i class="fa-regular fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                      </li>
                      <li class="star" title="Excellent" data-value="4" onclick="ease_navigation('4');"> 
                        <i class="fa-regular fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                      </li>
                      <li class="star" title="Excellent" data-value="5" onclick="ease_navigation('5');"> 
                        <i class="fa-regular fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                      </li>
                    </ul>
                  </div>
                  <div class="form-floating mt-4">
                    <input type="text" id="user_name" class="form-control restrictedInput" autocomplete="off" placeholder="Enter Your Name">
                    <label for="user_name">Name</label>
                  </div>
                  <div class="form-floating mt-4">
                    <input type="text" id="user_location" class="form-control" autocomplete="off" placeholder="Enter Your Location" value="<?=!empty(session()->get('session_city'))?session()->get('session_city'):''?>">
                    <label for="user_location">Location</label>
                  </div>
                  <div class="form-floating mt-4">
                    <textarea class="form-control reviw-sec" placeholder="Enter Your Review" id="user_review"></textarea>
                    <label for="user_review">Write Review</label>
                  </div>
                </div>
                <button class="btn btn-varify-otp mb-3" onclick="return validateReview()" id="validate_review">
                Submit
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
  // OTP Input
//   document.querySelectorAll(".otSc").forEach(function (otpEl) {
//     otpEl.addEventListener("keyup", backSp);
//     otpEl.addEventListener("keypress", function () {
//       var nexEl = this.nextElementSibling;
//       nexEl.focus();
//     })
//   })

//   function backSp(backKey) {
//     if (backKey.keyCode == 8) {
//       var prev = this.previousElementSibling.focus()
//     }
//   }


 
   $('#loader').hide();
  function validateBookDemo() {
    var name = $('#name').val().trim();
    var phone = $('#mobile_no').val().trim();
    var email = $('#email').val().trim();
    var class_id = $('#class').val();
    var subject = $('#subject').val();
    var board = $('#board').val();
    var area = $('#area').val();
    var gender = $('#gender').val();
    var city_id = $('#location').val();
    var tuition_mode = $('#mode').val();
    var csrf = $('#csrf').val().trim();
    var match_captcha = $('#match_captcha').val().trim();

    if (name === "") {
        toastr.error('Please Enter Name');
        return false;
    } else if (email === "") {
        toastr.error('Please Enter Email');
        return false;
    } else if (phone === "") {
        toastr.error('Please Enter Mobile Number');
        return false;
    } else if (phone.length !== 10 || isNaN(phone)) {
        toastr.error('Please Enter A Valid 10 Digit Mobile Number');
        return false;
    } else if (board === "") {
        toastr.error('Please Select Board');
        return false;
    } else if (class_id === "") {
        toastr.error('Please Select Class');
        return false;
    } else if (subject === "") {
        toastr.error('Please Select Subject');
        return false;
    }  else if (gender === "") {
        toastr.error('Please Select Gender');
        return false;
    } else if (city_id === "") {
        toastr.error('Please Select City');
        return false;
    } else if (area === "") {
        toastr.error('Please Enter Area');
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
                'email': email,
                'match_captcha': match_captcha,
                'csrf': csrf,
                'class_id': class_id, // Changed key name
                'subject': subject,
                'board': board,
                'area': area,
                'gender': gender,
                'city_id': city_id,
                'tuition_mode': tuition_mode,
            },
            cache: false,
            dataType: "json",
            beforeSend: function () {
                $('#sumbitdemo').prop('disabled', true).text('Please Wait...',true);
                $('#loader').show();
            },
            success: function (response) {
                if (response.status === false) {
                    toastr.error(response.message);
                    $('#sumbitdemo').prop('disabled', false).text('Submit',true);
                } else if (response.status === true) {
                    $('#sumbitdemo').prop('disabled', false).text('Submit',true);
                    $('#loader').hide();
                    toastr.success(response.message);
                    document.getElementById("demoForm").reset();
                    getRandomCaptcha();
                }
            },
            error: function () {
                console.log('Error occurred during AJAX request');
            }
        });
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
  
  function validatePhoneNumber() {
    var mobile_no = $('#validphone').val().trim();
    
    if (mobile_no == "") {
        toastr.error('Please Enter Mobile Number');
        return false;
    } else if (mobile_no.length < 10) {
        toastr.error('Please Enter A Valid 10 Digit Mobile Number');
        return false;
    } else {
        $.ajax({
            url: '<?= base_url('validatePhoneNumber') ?>',
            type: "POST",
            data: { 'mobile_no': mobile_no },
            cache: false,
            dataType: 'json',
            beforeSend: function () {
                $('#send_otp').prop('disabled', true).text('Please Wait...',true);
                $('#hidden_mobile_no').val(mobile_no);
            },
            success: function(response) {
                if (response.status == true) {
                    $('#send_otp').prop('disabled', false).text('Send Otp',true);
                    $('#validphone').val('');
                    
                    $('#exampleModal3').modal('hide');
                    $('#exampleModal4').modal('show');
                    $('#user_otp_message').html(response.message);
                    
                    $('#user_otp').val(response.otp);
                }else{
                    toastr.error(response.message);
                }
            }
        });
    }
}

function validateOtp() {
    var entered_otp = $('#first').val() + $('#second').val() + $('#third').val() + $('#fourth').val();
    var sent_otp = $('#user_otp').val();
    var mobile_no = $('#hidden_mobile_no').val().trim();
    if (entered_otp == "") {
        toastr.error('Please Enter OTP');
        return false;
    } else if (entered_otp.length < 4) {
        toastr.error('Please Enter A Valid OTP');
        return false;
    } else if (entered_otp != sent_otp) {
        toastr.error('OTP Not Match');
        return false;
    } else {
        $.ajax({
            url: '<?= base_url('validateOtp') ?>',
            type: "POST",
            data: { 'entered_otp': entered_otp, 'sent_otp': sent_otp,'mobile_no':mobile_no },
            cache: false,
            dataType: 'json',
            beforeSend: function() {
                $('#validate_otp').prop('disabled', true).text('Please Wait...');
            },
            success: function(response) {
                if (response.status == true) {
                    $('#validate_otp').prop('disabled', false).text('Verify');
                    $('#exampleModal4').modal('hide');
                    $('#exampleModal5').modal('show');
                    toastr.success(response.message);
                    // $('#user_otp_message').html(response.message);
                    // $('#user_otp').val(response.otp);
                } else {
                    toastr.error(response.message);
                }
            }
        });
    }
}
function ease_navigation(val){
    $('#user_rating').val(val);
}
function validateReview(){
    var user_rating = $('#user_rating').val();
    var user_name=$('#user_name').val().trim();
    var user_location=$('#user_location').val().trim();
    var user_review=$('#user_review').val().trim();
    var tutor_id=$('#tutor_id').val().trim();
    var tutor=$('#tutor').val().trim();
    
    if(user_rating == ""){
        toastr.error("Please Select Rating");
        return false;
    }else if(user_name == ""){
        toastr.error("Please Enter Name");
        return false;
    }else if(user_location == ""){
        toastr.error("Please Enter Location");
        return false;
    }else if(user_review == ""){
        toastr.error("Please Enter Your Review");
        return false;
    }else{
         $.ajax({
            url: '<?= base_url('validateReview') ?>',
            type: "POST",
            data: { 'user_rating': user_rating, 'user_name': user_name,'user_location':user_location,'user_review':user_review,
                tutor_id:tutor_id,tutor:tutor
            },
            cache: false,
            dataType: 'json',
            beforeSend: function() {
                $('#validate_review').prop('disabled', true).text('Please Wait...');
            },
            success: function(response) {
                if (response.status == true) {
                    $('#validate_review').prop('disabled', false).text('Submit');
                     $('#user_name').val('');
                     $('#user_location').val('');
                     $('#user_review').val('');
                     $('#hidden_mobile_no').val('');
                    $('#exampleModal5').modal('hide');
                     
                    toastr.success(response.message);
                    window.location.reload();
                    // $('#user_otp_message').html(response.message);
                    // $('#user_otp').val(response.otp);
                } else {
                    toastr.error(response.message);
                }
            }
        });
    }
}

function validateResendOtp(){
    var mobile_no = $('#hidden_mobile_no').val().trim();
    $.ajax({
            url: '<?= base_url('validateResendOtp') ?>',
            type: "POST",
            data: { 'mobile_no': mobile_no },
            cache: false,
            dataType: 'json',
            beforeSend: function() {
                $('#resend_otp').prop('disabled', true).text('Please Wait...');
            },
            success: function(response) {
                if (response.status == true) {
                    $('#resend_otp').prop('disabled', false).text('Resend Otp');
                    
                    toastr.success(response.message);
                    // $('#user_otp_message').html(response.message);
                     $('#user_otp').val(response.otp);
                } else {
                    toastr.error(response.message);
                    $('#resend_otp').prop('disabled', false).text('Resend Otp');
                }
            }
        });
}

function goToByScroll(sectionID) {
    var $target = $("#" + sectionID);
    var headerHeight = $("header").outerHeight(); // Assuming header is <header> tag. Change selector accordingly if not.

    if ($target.length) {
        var targetPosition = $target.offset().top - headerHeight;
        $('html, body').animate({
            scrollTop: targetPosition
        }, 'fast');
    } else {
        console.error("Section with ID '" + sectionID + "' not found.");
    }
}


</script>