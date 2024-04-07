<main id="main">
  <?php $topimage = !empty($home['top_banner_jpg'] || $home['top_banner_webp']) ? base_url('uploads/') . imgExtension($home['top_banner_jpg'], $home['top_banner_webp']) : "";
    $topbg= !empty($home['top_bg_image_jpg'] || $home['top_bg_image_webp']) ? base_url('uploads/') . imgExtension($home['top_bg_image_jpg'], $home['top_bg_image_webp']) : ""; 
    $midbanner = !empty($home['mid_banner_jpg'] || $home['mid_banner_webp']) ? base_url('uploads/') . imgExtension($home['mid_banner_jpg'], $home['mid_banner_webp']) : ""; 
    $bottombanner = !empty($home['bottom_banner_jpg'] || $home['bottom_banner_webp']) ? base_url('uploads/') . imgExtension($home['bottom_banner_jpg'], $home['bottom_banner_webp']) : ""; 
    $free_demo = !empty($home['free_demo_image_jpg'] || $home['free_demo_image_webp']) ? base_url('uploads/') . imgExtension($home['free_demo_image_jpg'], $home['free_demo_image_webp']) : ""; 
    ?>
  <section id="hero" class="hero overflow-visible">
    <img src="<?=$topbg?>" alt="<?=!empty($home['top_bg_image_alt'])?$home['top_bg_image_alt']:''?>"  class="mainheader-img" data-aos="fade-in">
    <div class="container">
      <div class="row">
        <div class="col-lg-6">
          <h2 data-aos="fade-up" data-aos-delay="100"><?=!empty($home['top_heading'])?$home['top_heading']:''?>
          </h2>
          <div class="col-lg-10 position-relative">
            <form action="<?=base_url('tutor-list')?>" style="background-color:#f3eeee" class="sign-up-form d-flex gap-1 bordrer-purple" data-aos="fade-up" data-aos-delay="300">
              <!--<input type="text" autocomplete="off" name="city" class="form-control d-none"  id="search_city" placeholder="Enter City">-->
              <input type="text" autocomplete="off" class="form-control mx-2"  id="search_value" placeholder="Enter Subject / Class">
              <input type="hidden" name="" id="typesearch" value="">
              <button type="submit" class="btn btn-primary search_btn" onclick="return validateSearch()">Search</button>
            </form>
            <div id="appendSearch">
            </div>
            <div id="appendLocation" class="col-md-6 col-lg-6 pe-0 d-none">
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="header_imgSec">
            <div class="header_icon"> 
              <img src="<?=base_url()?>assets/frontend/img/illustration_1.png" class="img-fluid">
            </div>
            <img src="<?=$topimage?>" alt="<?=!empty($home['top_banner_alt'])?$home['top_banner_alt']:''?>" class="img-fluid">
            <div class="header_icon2"> 
              <img src="<?=base_url()?>assets/frontend/img/illustration_2.png" class="img-fluid">
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="tophead-sec">
    <div class="col-lg-12 row">
      <div class="col-lg-9">
        <?php if(!empty($class_group_list)){?>
        <div class="first-section">
          <div class="top_heading">
            <h3>
              <?=!empty($home['class_group_heading'])?$home['class_group_heading']:''?>
            </h3>
            <a href="<?=base_url('tutor-list?class_group='.($class_group_list[0]['class_group_name']))?>">View More</a>
          </div>
          <div class="row">
            <?php foreach($class_group_list as $cglkey=>$cglvalue){?>
            <div class="col-lg-4">
              <a href="<?=base_url('tutor-list?class_group='.($cglvalue['class_group_name']))?>" class="<?=$cglkey==0?'active':''?>">
                  <div class="header-box">
                <span>
                  <div class="firsticonbox">
                    <div>
                      <p> <?=!empty($cglvalue['class_group_name'])?'Tuition for '.$cglvalue['class_group_name']:''?></p>
                      <h6><?= !empty(getListedTutors($cglvalue['id'])) ? getListedTutors($cglvalue['id'])." Listed" : '0 Listed' ?></h6>
                    </div>
                    <div>
                      <i class="fa-solid fa-chevron-right"></i>
                    </div>
                  </div>
                </span>
              </div>
              </a>
            </div>
            <?php } ?>
          </div>
        </div>
        <?php } ?>
        <?php if(!empty($subject_list)){?>
        <div class="slider-sec">
          <div class="top_heading">
            <h3><?=!empty($home['subject_heading'])?$home['subject_heading']:''?> <br><img src="<?=base_url()?>assets/frontend/img/Star 3.png" class="img fluid starimg"></h3>
            <a href="<?=base_url('tutor-list?subject_name='.($subject_list[0]['subject_name']))?>">View More</a>
          </div>
          <div class="slide-container swiper">
            <div class="slide-content">
              <div class="card-wrapper swiper-wrapper h-100 min-heighter">
                <?php foreach($subject_list as $slkey=>$slvalue){?>
                <?php $bgimage = !empty($slvalue['image_jpg'] || $slvalue['image_webp']) ? base_url('uploads/') . imgExtension($slvalue['image_jpg'], $slvalue['image_webp']) : ""; ?>
                <div class="card swiper-slide slidercls h-100">
                  <a href="<?= base_url('tutor-list?subject_name=' .($slvalue['subject_name'])) ?>" class="card">
                    <div class="card-body all-sec">
                      <span class="card-Innerprh">
                      <img src="<?=$bgimage?>" class="img-fluid" alt="<?=!empty($slvalue['image_alt'])?$slvalue['image_alt']:''?>">
                      </span><br>
                      <span class="card-prh text-light"><?=!empty($slvalue['subject_name'])?$slvalue['subject_name']:''?></span>
                    </div>
                  </a>
                </div>
                <?php } ?>
              </div>
            </div>
            <div class="swiper-button-next swiper-navBtn"></div>
            <div class="swiper-button-prev swiper-navBtn"></div>
          </div>
          <span class="elipsis-icon">
          <img src="<?=base_url()?>assets/frontend/img/Ellipse 13 (1).png" class="img-fluid">
          </span> 
          <div class="union-icon">
            <img src="<?=base_url()?>assets/frontend/img/Union.png" class="img-fluid">
          </div>
        </div>
        <?php } ?>
        <?php if(!empty($tutor_list)){?>
        <section id="recent-posts" class="recent-posts content-section">
          <div class="container" data-aos="fade-up">
            <div class="top_heading">
              <h3><?=!empty($home['tutor_heading'])?$home['tutor_heading']:''?></h3>
              <a href="<?=base_url('tutor-list')?>">View More</a>
            </div>
          </div>
          <div class="container">
            <div class="row gy-4 firstFeatured">
              <?php foreach($tutor_list as $tlkey=>$tlvalue){?>
              <div class="col-xl-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                <article>
                  <a  href="<?=!empty($tlvalue['tutor_slug'])?base_url().$tlvalue['tutor_slug']:''?>" class="post-img">
                  <img src="<?=!empty($tlvalue['profile_image'])?base_url('uploads/').$tlvalue['profile_image']:''?>" alt="" class="img-fluid w-100">
                  </a>
                  <div class="firstFeatured-content" id="custum-scrollbar">
                      <h2 class="title px-2">
                    <a href="<?=!empty($tlvalue['tutor_slug'])?base_url().$tlvalue['tutor_slug']:''?>"><?=!empty($tlvalue['tutor_name'])?$tlvalue['tutor_name']:''?> (<?=!empty($tlvalue['gender'])?substr($tlvalue['gender'], 0, 1):''?>)</a>
                  </h2>
                  <div class="col-lg-12 row mx-auto px-2 my-2">
                    <div class="col-lg-6 cardSection">
                      <span class="card-innertopsec">
                        <svg xmlns="http://www.w3.org/2000/svg" width="9" height="9" viewBox="0 0 9 9" fill="none">
                          <g filter="url(#filter0_d_82_2104)">
                            <circle cx="4.5" cy="4.5" r="2.5" fill="#18B032"/>
                          </g>
                          <defs>
                            <filter id="filter0_d_82_2104" x="0" y="0" width="9" height="9" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                              <feFlood flood-opacity="0" result="BackgroundImageFix"/>
                              <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha"/>
                              <feMorphology radius="2" operator="dilate" in="SourceAlpha" result="effect1_dropShadow_82_2104"/>
                              <feOffset/>
                              <feComposite in2="hardAlpha" operator="out"/>
                              <feColorMatrix type="matrix" values="0 0 0 0 0.701545 0 0 0 0 0.969543 0 0 0 0 0.840904 0 0 0 1 0"/>
                              <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_82_2104"/>
                              <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_82_2104" result="shape"/>
                            </filter>
                          </defs>
                        </svg>
                        <p class="post-category"><?=!empty($tlvalue['city'])?getCityName($tlvalue['city']):'N/A'?></p>
                      </span>
                      <h6>Exp. :- <?=!empty($tlvalue['experience_years'])?$tlvalue['experience_years'].' Years':'N/A'?></h6>
                    </div>
                    <div class="col-lg-6 cardSection">
                      <span class="card-innertopsec justify-content-end">
                        <i class="fa-solid fa-star"></i>
                        <p class="post-category"><?=!empty($tlvalue['avg_rating'])?$tlvalue['avg_rating']:''?> <?=!empty($tlvalue['total_reviews'])?'('.$tlvalue['total_reviews'].' reviews)':''?></p>
                      </span>
                      <h6 class="text-end"><span class="text_clr"> <?=!empty($tlvalue['monthly_fees'])?'₹ '.(int)$tlvalue['monthly_fees'].' per month':'N/A'?></span></h6>
                    </div>
                  </div>
                  <div class="d-flex align-items-center pils-icon flex-wrap">
                    <?php $class=!empty($tlvalue['class'])?getMultipleClass($tlvalue['class']):'';
                      $classArray=!empty($class)?explode(',',$class):[];
                      
                      $subject=!empty($tlvalue['subject'])?getMultipleSubject($tlvalue['subject']):'';
                      $subjectArray=!empty($subject)?explode(',',$subject):[];
                      
                      ?>
                    <?php if(!empty($classArray)){foreach($classArray as $bakey=>$bavalue){?>
                    <p><?=$bavalue?></p>
                    <?php if($bakey == 3){break;}}} ?>
                    <?php if(!empty($subjectArray)){foreach($subjectArray as $sakey=>$savalue){?>
                    <p><?=$savalue?></p>
                    <?php if($sakey == 3){break;}}} ?><a class="cardmorecls" href="<?=!empty($tlvalue['tutor_slug'])?base_url().$tlvalue['tutor_slug']:''?>"> + more </a>
                  </div>
                  </div>
                  
                  
                </article>
              </div>
              <?php } ?>
            </div>
          </div>
        </section>
        <?php  } ?>
        <section class="registration content-section">
          <img src="<?=$midbanner?>" alt="<?=!empty($home['mid_banner_alt'])?$home['mid_banner_alt']:''?>" class="img-fluid">
        </section>
        <section class="content-section">
          <div class="container" data-aos="fade-up">
            <div class="top_heading addsection">
              <h3>
              <?=!empty($home['about_us_heading'])?$home['about_us_heading']:''?></h1>
            </div>
            <p><?=!empty($home['about_us_description'])?$home['about_us_description']:''?></p>
            <div class="row content whychosesec">
              <?php
                $about_points = !empty($home['about_us_point']) ? array_map('trim', explode(',', json_encode($home['about_us_point']))) : [];
                $total_points = count($about_points);
                $half_point_count = ceil($total_points / 2);
                $first_half = array_slice($about_points, 0, $half_point_count);
                $second_half = array_slice($about_points, $half_point_count);
                ?>
              <div class="col-lg-6">
                <ul>
                  <?php
                    $i = 1;
                    foreach ($first_half as $apkey => $apvalue) {
                    ?>
                  <li><span><?= $i ?></span> <?= preg_replace("/[^a-zA-Z0-9\s]/", "", $apvalue) ?></li>
                  <?php $i++;
                    } ?>
                </ul>
              </div>
              <div class="col-lg-6">
                <ul>
                  <?php
                    foreach ($second_half as $apkey => $apvalue) {
                    ?>
                  <li><span><?= $i ?></span> <?= preg_replace("/[^a-zA-Z0-9\s]/", "", $apvalue) ?></li>
                  <?php $i++;
                    } ?>
                </ul>
              </div>
            </div>
          </div>
        </section>
        <?php if (!empty($city_list)) { ?>
        <section class="content-section">
          <div class="container" data-aos="fade-up">
            <div class="top_heading ">
              <h3 class="top-study"><?=!empty($home['city_heading'])?$home['city_heading']:''?></h3>
            </div>
            <div class="slide-container swiper">
              <div class="slider-contentslider">
                <div class="card-wrapper swiper-wrapper">
                  <?php foreach ($city_list as $clkey => $clvalue) { ?>
                  <input type="hidden" id="citid" value="<?=$clvalue['id'].','.$clvalue['state_id']?>">
                  <?php 
                    $cityimage = (!empty($clvalue['jpg_image']) || !empty($clvalue['webp_image'])) 
                      ? base_url('uploads/') . imgExtension($clvalue['jpg_image'], $clvalue['webp_image']) 
                      : ""; 
                    ?>
                  <div class="card swiper-slide <?= $clkey == 0 ? 'slidercls' : '' ?>">
                    <a href="<?= base_url('tutor-list?city=' .urlencode($clvalue['city_name'])) ?>">
                      <div class="card">
                        <div class="card-body all-sec citysection">
                          <img src="<?= $cityimage ?>" class="img-fluid" alt="<?= !empty($clvalue['city_name']) ? $clvalue['city_name'] : '' ?>">
                          <br> <b><?= !empty($clvalue['city_name']) ? $clvalue['city_name'] : '' ?></b>
                        </div>
                      </div>
                    </a>
                  </div>
                  <?php } ?>
                </div>
              </div>
              <div class="swiper-button-next swiper-navBtn"></div>
              <div class="swiper-button-prev swiper-navBtn"></div>
            </div>
          </div>
        </section>
        <?php } ?>
        <section id="features" class="features">
          <div class="container">
            <div class="row gy-4 align-items-center features-item">
              <div class="col-lg-7" data-aos="fade-up" data-aos-delay="200">
                <h3>Book your <span><img src="<?=base_url()?>assets/frontend/img/Group 45.png" class="img-fluid demoimg"></span>session </h3>
                <p>
                  Get home tutor session at home
                </p>
                <a href="javascript:void(0)" class="btn btn-get-started extrastyle">Book a free demo</a>
              </div>
              <div class="col-lg-5 d-flex align-items-center " data-aos="zoom-out">
                <i class="fa-solid fa-circle"></i>
                <img src="<?=$free_demo?>" alt="<?=!empty($home['free_demo_image_alt'])?$home['free_demo_image_alt']:''?>" class="img-fluid bg-clean w-100">
                <img src="<?=base_url()?>assets/frontend/img/Star 2.png" class="img-fluid star-2">
              </div>
            </div>
          </div>
        </section>
        <?php if(!empty($city_list)){?>
        <section class="content-section">
          <div class="container" data-aos="fade-up">
            <div class="first-section">
              <div class="top_heading">
                <h3>
                  <?=!empty($home['area_heading'])?$home['area_heading']:''?> 
                  <select class="Locationsec"  onchange="getPopularLocality(this.value)" id="poplocation">
                    <?php foreach($city_list as $ckey=>$cvalue){?>
                    <option value="<?=$cvalue['id'].','.$cvalue['state_id']?>" <?=!empty($location) && ($location==$cvalue['city_name'])?'selected':''?>><?=$cvalue['city_name']?></option>
                    <?php } ?>
                  </select>
                </h3>
                <a href="<?=!empty($city_list[0]["city_name"])?base_url('tutor-list?city=').$city_list[0]["city_name"]:''?>">View More</a>
              </div>
              <div class="row" id="append_locality">
              </div>
            </div>
          </div>
        </section>
        <?php } ?>
        <?php if(!empty($blog_list)){?>
        <div class="">
          <div class="slide-container swiper recent-posts content-section" id="recent-posts">
            <div class="top_heading">
              <h3><?=!empty($home['blogs_heading'])?$home['blogs_heading']:''?></h3>
              <a href="<?=base_url('blogs')?>">View More</a>
            </div>
            <div class="blog-contentslider container ">
              <div class="card-wrapper swiper-wrapper mainblogsec">
                <?php foreach($blog_list as $blkey=>$blvalue){?>
                <?php 
                  $blogimage = (!empty($blvalue['blog_image_jpg']) || !empty($blvalue['blog_image_webp'])) 
                    ? base_url('uploads/') . imgExtension($blvalue['blog_image_jpg'], $blvalue['blog_image_webp']) 
                    : ""; 
                  ?>
                <div class="card swiper-slide slidercls">
                  <article>
                    <a href="<?=base_url($blvalue['slug'])?>" class="post-img">
                    <img src="<?=$blogimage?>" alt="<?=!empty($blvalue['blog_image_alt'])?$blvalue['blog_image_alt']:''?>" class="img-fluid w-100">
                    </a>
                    <h2 class="title">
                      <a href="<?=base_url($blvalue['slug'])?>"><?=!empty($blvalue['blog_title'])?$blvalue['blog_title']:''?></a>
                    </h2>
                    <div class="d-flex align-items-center justify-content-between blog-sec">
                      <p><?=!empty($blvalue['created_date'])?date('M d , Y',strtotime($blvalue['created_date'])):''?></p>
                      <a href="<?=base_url($blvalue['slug'])?>" class="active">Read More</a>
                    </div>
                  </article>
                </div>
                <?php } ?>
              </div>
            </div>
            <div class="swiper-button-next swiper-navBtn"></div>
            <div class="swiper-button-prev swiper-navBtn"></div>
          </div>
        </div>
        <?php } ?>
        <?php if(!empty($testimonial_list)){?>
        <section class="student-Mainsec p-0">
          <div class="feedback-student about" id="about" >
            <div class="container" data-aos="fade-up" data-aos-delay="100">
              <div class="row">
                <div class="col-xl-7">
                  <div class="row icon-boxes">
                    <?php foreach($testimonial_list as $tlkey=>$tlvalue){?>
                    
                    <div class="col-md-6" data-aos="fade-up" data-aos-delay="300">
                      <div class="icon-box student-feds studentboy">
                        
                        <div class="text-center">
                          <p><span class="fa-solid fa-quote-left"></span><?=!empty($tlvalue['testimonial'])?$tlvalue['testimonial']:''?><span class="fa-solid fa-quote-right"></span></p>
                        </div>
                        <div class="d-flex justify-content-center">
                          <?=showRatings($tlvalue['rating'])?> 
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
                      <select class="form-select" aria-label="Default select example" id="city_id">
                        <option value="">Choose option</option>
                        <?php if(!empty($location_list)){foreach($location_list as $llkey=>$llvalue){?>
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
  </section>
  <section class="registration content-section resitation-page" style="background-image:url('<?=$bottombanner?>')">
    <div class="registertutor">
      <h3>
      Register as Tutor</h2>
      <p><i class="bi bi-chevron-double-up"></i> 2000+ Tutors already registered with us</p>
      <a class="cta-btn" href="<?=base_url('tutor-register')?>">Register Now</a>
    </div>
  </section>
</main>
<script>
 $(document).ready(function(){
    var city_name = $('#header_city_value').val();
    getPopularLocality(null,city_name);
});

  function getPopularLocality(city_id=null,city_name=null){
      $('#append_locality').html('');
    $.ajax({
      url: '<?= base_url('getPopularLocality') ?>',
      type: "POST",
      data: { 'city_id': city_id,'city_name':city_name },
      cache: false,
      success: function (response) {
          $('#append_locality').html(response);
      }
    });
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
  function validateBookDemo() {
    var name = $('#name').val().trim();
    var phone = $('#mobile_no').val().trim();
    var email = $('#email').val().trim();
    var class_id = $('#class').val();
    var subject = $('#subject').val();
    var board = $('#board').val();
    var gender = $('#gender').val();
    var city_id = $('#city_id').val();
    var area = $('#area').val();
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
                $('#sumbitdemo').addClass('disabled', true).text('Please Wait...',true);
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
            //         setTimeout(function() {
            //  window.location.reload;
            //  },1000);
                }
            },
            error: function () {
                console.log('Error occurred during AJAX request');
            }
        });
    }
}

function validateSearch(){
var search_value=$('#search_value').val().trim();

if(search_value==""){
toastr.error('Please type something to search');
return false;
}
return true;
}

$('#search_value').on('keyup',function(){
  var search_value=$('#search_value').val().trim();
  $('#appendSearch').html('');
  if(search_value != ""){
    $.ajax({
      url: '<?= base_url('getSubjectClass') ?>',
      type: "POST",
      data: { 'search_value': search_value},
      cache: false,
      success: function (response) {
          $('#appendSearch').html(response);
      }
    });
  }
  
});

function gotoUrl(name, value) {
  if (value && typeof value === 'string') {
    $('#typesearch').attr('value', value);
    $('#typesearch').attr('name', name);
    $('#search_value').val(value);
    $('#appendSearch').html('');
  }
}


$(document).ready(function(){
  $('#search_value').val('');
});


$(document).ready(function() {
  $('#search_city').on('keyup', function() {
    var search_value = $('#search_city').val().trim();
    $('#appendLocation').html('');
    if (search_value != "") {
      $.ajax({
        url: '<?= base_url('getCity') ?>',
        type: "POST",
        data: { 'keyword': search_value },
        cache: false,
        success: function(response) {
          $('#appendLocation').html(response);
        }
      });
    }
  });
});
//   function gotoCity(url, value) {
//     if (url && typeof url === 'string') {
//       $('#search_city').val(value);
//       $('#appendLocation').html('');
//     }
//   }


</script>