<main id="main" class="blogdetailsSection">
  <section class="breadcrumbs-sec">
    <div class="page-title">
      <nav class="breadcrumbs">
        <div class="">
          <ol>
            <li><a href="<?=base_url()?>">Home</a></li>
            <i class="fa-solid fa-chevron-right"></i>
            <li><a href="<?=base_url('blogs')?>">Blogs</a></li>
            <i class="fa-solid fa-chevron-right"></i>
            <li class="current"><?=!empty($page['blog_title'])?$page['blog_title']:''?></li>
          </ol>
        </div>
      </nav>
      <?php 
        $bgimage = (!empty($page['banner_image_jpg']) || !empty($page['banner_image_webp'])) 
          ? base_url('uploads/') . imgExtension($page['banner_image_jpg'], $page['banner_image_webp']) 
          : ""; 
        ?>
      <section class="registration content-section p-0">
        <img src="<?=$bgimage?>" class="img-fluid" alt="<?=!empty($page['banner_image_alt'])?$page['banner_image_alt']:''?>">
      </section>
    </div>
  </section>
  <?php 
    $blogimage = (!empty($page['blog_image_jpg']) || !empty($page['blog_image_webp'])) 
      ? base_url('uploads/') . imgExtension($page['blog_image_jpg'], $page['blog_image_webp']) 
      : ""; 
    ?>
  <section id="blog-details" class="blog-details">
    <div class="row g-3">
      <div class="col-lg-8">
        <article class="article">
          <span class="blog-detailtopSec">
            <h1><?=!empty($page['h1'])?$page['h1']:''?></h1>
            <p>By <?=!empty($page['created_by'])?$page['created_by']:''?>, Posted on <?=!empty($page['created_date'])?date('d/m/Y',strtotime($page['created_date'])):''?></p>
          </span>
          <div class="post-img">
            <img src="<?=$blogimage?>" alt="<?=!empty($page['blog_image_alt'])?$page['blog_image_alt']:''?>" class="img-fluid w-100">
          </div>
          <div class="content">
            <?=!empty($page['description'])?$page['description']:''?>
          </div>
        </article>
        <?php if (!empty($featured_blogs)) { ?>
        <div class="blogdetailnext-prives">
          <div class="col-sm-6 blogpostbtn">
            <a href="<?= !empty($featured_blogs[count($featured_blogs) - 1]['slug']) ? base_url($featured_blogs[count($featured_blogs) - 1]['slug']) : 'javascript:void(0)' ?>">
            <img src="<?= base_url() ?>assets/frontend/img/preivew.png" class="img-fluid"> Previous Post
            </a>
            <p class="d-none">Aut quisquam eligendi qui vero maxime.</p>
          </div>
          <div class="col-sm-6 blogpostbtn text-end">
            <a href="<?= !empty($featured_blogs[0]['slug']) ? base_url($featured_blogs[0]['slug']) : 'javascript:void(0)' ?>">
            Next Post <img src="<?= base_url() ?>assets/frontend/img/next.png" class="img-fluid">
            </a>
            <p class="d-none">Aut quisquam eligendi qui vero maxime.</p>
          </div>
        </div>
        <?php } ?>
        <?php if(!empty($class_group_list)){?>
        <div class="first-section">
          <div class="top_heading">
            <h3>
            Explore Home Tutor Goal</h1>
            <a href="<?=base_url('tutor-list?class_group='.($class_group_list[0]['class_group_name']))?>">View More</a>
          </div>
          <div class="row">
            <?php foreach($class_group_list as $cglkey=>$cglvalue){?>
            <div class="col-lg-4">
              <div class="header-box">
                <span>
                  <div class="firsticonbox">
                    <div>
                      <p> <a href="<?=base_url('tutor-list?class_group='.($cglvalue['class_group_name']))?>" class="<?=$cglkey==0?'active':''?>"><?=!empty($cglvalue['class_group_name'])?'Tuition for '.$cglvalue['class_group_name']:''?> </a> 
                      </p>
                      <h6><?= !empty(getListedTutors($cglvalue['id'])) ? getListedTutors($cglvalue['id'])." Listed" : '0 Listed' ?></h6>
                    </div>
                    <div>
                      <i class="fa-solid fa-chevron-right"></i>
                    </div>
                  </div>
                </span>
              </div>
            </div>
            <?php } ?>
          </div>
        </div>
        <?php } ?>
        <?php if(!empty($subject_list)){?>
        <div class="slider-sec">
          <div class="top_heading">
            <h3>Popular Home Tutor By Subjects <br><img src="<?=base_url()?>assets/frontend/img/Star 3.png" class="img fluid starimg"></h3>
            <a href="<?=base_url('tutor-list?subject_name='.($subject_list[0]['subject_name']))?>">View More</a>
          </div>
          <div class="slide-container swiper">
            <div class="slide-content">
              <div class="card-wrapper swiper-wrapper">
                <?php foreach($subject_list as $slkey=>$slvalue){?>
                <?php $bgimage = !empty($slvalue['image_jpg'] || $slvalue['image_webp']) ? base_url('uploads/') . imgExtension($slvalue['image_jpg'], $slvalue['image_webp']) : ""; ?>
                <div class="card swiper-slide slidercls">
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
              <div class="col-xl-4 col-md-6 col-sm-6">
                <article>
                  <a  href="<?=!empty($tlvalue['tutor_slug'])?base_url().$tlvalue['tutor_slug']:''?>" class="post-img">
                  <img src="<?=!empty($tlvalue['profile_image'])?base_url('uploads/').$tlvalue['profile_image']:''?>" alt="" class="img-fluid w-100">
                  </a>
                  
                   <div class="firstFeatured-content" id="custum-scrollbar">
                  <h2 class="title">
                    <a href="<?=!empty($tlvalue['tutor_slug'])?base_url().$tlvalue['tutor_slug']:''?>"><?=!empty($tlvalue['tutor_name'])?$tlvalue['tutor_name']:''?> (<?=!empty($tlvalue['gender'])?substr($tlvalue['gender'], 0, 1):''?>)</a>
                  </h2>
                  <div class="col-lg-12 row mx-auto my-2">
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
                        <p class="post-category"><?=!empty($tlvalue['city'])?getCityName($tlvalue['city']):''?></p>
                      </span>
                      <h6>Exp. :- <?=!empty($tlvalue['experience_years'])?$tlvalue['experience_years'].' Years':''?></h6>
                    </div>
                    <div class="col-lg-6 cardSection">
                      <span class="card-innertopsec justify-content-end">
                        <i class="fa-solid fa-star"></i>
                        <p class="post-category"><?=!empty($tlvalue['avg_rating'])?$tlvalue['avg_rating']:''?> <?=!empty($tlvalue['total_reviews'])?'('.$tlvalue['total_reviews'].' reviews)':''?></p>
                      </span>
                      <h6 class="text-end"><span class="text_clr"> <?=!empty($tlvalue['monthly_fees'])?'₹ '.(int)$tlvalue['monthly_fees'].' per month':''?></span></h6>
                    </div>
                  </div>
                  <div class="d-flex align-items-center pils-icon flex-wrap">
                    <?php 
                      $classes=!empty($tlvalue['class'])?getMultipleClass($tlvalue['class']):'';
                      $classArray=!empty($classes)?explode(',',$classes):[];
                      
                      $subject=!empty($tlvalue['subject'])?getMultipleSubject($tlvalue['subject']):'';
                      $subjectArray=!empty($subject)?explode(',',$subject):[];
                      
                      ?>
                    <?php if(!empty($classArray)){foreach($classArray as $bakey=>$bavalue){?>
                    <p><?=$bavalue?></p>
                    <?php if($bakey ==3){break;}}} ?>
                    <?php if(!empty($subjectArray)){foreach($subjectArray as $sakey=>$savalue){?>
                    <p><?=$savalue?></p>
                    <?php if($sakey ==3){break;}}} ?>
                    <a href="<?=!empty($tlvalue['tutor_slug'])?base_url().$tlvalue['tutor_slug']:''?>" class="cardmorecls"> + more</a>
                  </div>
                 </div>
                </article>
              </div>
              <?php } ?>
            </div>
          </div>
        </section>
        <?php  } ?>
      </div>
      <?php if(!empty($featured_blogs)){?>
      <div class="col-lg-4">
        <div class="sidebar">
          <div class="sidebar-item recent-posts">
            <h3 class="sidebar-title">Featured Blogs</h3>
            <?php foreach($featured_blogs as $fbkey=>$fbvalue){?>
            <?php $bimage = !empty($fbvalue['blog_image_jpg'] || $fbvalue['blog_image_webp']) ? base_url('uploads/') . imgExtension($fbvalue['blog_image_jpg'], $fbvalue['blog_image_webp']) : ""; ?>
            <div class="post-item">
              <img src="<?=$bimage?>" alt="<?=!empty($fbvalue['blog_image_alt'])?$fbvalue['blog_image_alt']:''?>" class="flex-shrink-0">
              <div class="pt-2">
                <h4><a href="<?=!empty($fbvalue['slug'])?base_url($fbvalue['slug']):'javascript:void(0)'?>"><?=!empty($fbvalue['blog_title'])?$fbvalue['blog_title']:''?></a>
                </h4>
                <!--<span><i class="bi bi-clock"></i>&nbsp;&nbsp;7 min Read</span>-->
              </div>
            </div>
            <?php } ?>
          </div>
        </div>
      </div>
      <?php } ?>
    </div>
  </section>
</main>