<div class="blog-listingMainPage">
  <section class="breadcrumbs-sec extrabredcrubs">
    <div class="page-title">
      <nav class="breadcrumbs">
        <div class="">
          <ol>
            <li><a href="<?=base_url()?>">Home</a></li>
            <i class="fa-solid fa-chevron-right"></i>
            <li class="current"><?=!empty($page['page_name'])?$page['page_name']:''?></li>
          </ol>
        </div>
      </nav>
    </div>
  </section>
  <?php if (!empty($upper_blogs)): ?>
  <div class="slide-container swiper recent-posts content-section blog-listingcontainer multisecresponsive" id="recent-posts">
    <div class="blog-titleSec text-center pb-3">
      <h4><?= !empty($page['h1']) ? $page['h1'] : '' ?></h4>
    </div>
    <div class="col-md-9 col-lg-9 col-sm-9 mx-auto">
      <div class="blog-listingPageslider">
        <div class="card-wrapper swiper-wrapper">
          <?php foreach ($upper_blogs as $bkey => $bvalue): ?>
          <?php
            $blogimage = (!empty($bvalue['blog_image_jpg']) || !empty($bvalue['blog_image_webp']))
              ? base_url('uploads/') . imgExtension($bvalue['blog_image_jpg'], $bvalue['blog_image_webp'])
              : "";
            ?>
          <div class="card swiper-slide slidercls">
            <article class="row">
              <div class="col-md-6 col-sm-6 col-lg-6 p-0 m-0">
                  <div class="blog-imgSection extrablogdetails">
                        <a href="<?= !empty($bvalue['slug']) ? base_url($bvalue['slug']) : 'javascript:void(0)' ?>" class="post-img">
                <img src="<?= $blogimage ?>" alt="<?= !empty($bvalue['blog_image_alt']) ? $bvalue['blog_image_alt'] : '' ?>" class="img-fluid w-100 h-100">
                </a>
                  </div>
              
              </div>
              <div class="col-md-6 col-sm-6 col-lg-6">
                <span class="blog-listingtopcontent">
                  <h2 class="title">
                    <a href="<?= !empty($bvalue['slug']) ? base_url($bvalue['slug']) : 'javascript:void(0)' ?>"><?= !empty($bvalue['blog_title']) ? $bvalue['blog_title'] : '' ?></a>
                  </h2>
                  <p class="pragraph"><?= !empty($bvalue['short_description']) ? $bvalue['short_description'] . '...' : 'javascript:void(0)' ?><a href="<?= !empty($bvalue['slug']) ? base_url($bvalue['slug']) : 'javascript:void(0)' ?>">read more</a>
                  </p>
                  <div class="d-flex align-items-center justify-content-between blog-posttitle">
                    <span>
                      <p class="title">Posted On</p>
                      <p class="prh"><?= !empty($bvalue['created_date']) ? date('d/m/Y', strtotime($bvalue['created_date'])) : '' ?></p>
                    </span>
                    <span>
                      <p class="title">Posted By</p>
                      <p class="prh"><?= !empty($bvalue['created_by']) ? $bvalue['created_by'] : '' ?></p>
                    </span>
                    <span>
                    </span>
                  </div>
                </span>
              </div>
            </article>
          </div>
          <?php endforeach; ?>
        </div>
      </div>
      <div class="swiper-pagination"></div>
    </div>
  </div>
  <?php endif; ?>
  <?php if (!empty($lower_blogs)): ?>
  <div class="recent-posts content-section multipulcardSection" id="recent-posts">
    <div class="container ">
      <div class="mainblogsec" id="blogmultipule-Card">
        <div class="col-md-11 col-lg-11 col-sm-11 row gy-3 mx-auto">
          <?php foreach ($lower_blogs as $blkey => $blvalue):
            ?>
          <?php
            $blimage = (!empty($blvalue['blog_image_jpg']) || !empty($blvalue['blog_image_webp']))
              ? base_url('uploads/') . imgExtension($blvalue['blog_image_jpg'], $blvalue['blog_image_webp'])
              : "";
            ?>
          <div class="col-md-4 col-lg-4 col-sm-6">
            <div class="card">
              <article>
                <a href="<?= !empty($blvalue['slug']) ? base_url($blvalue['slug']) : 'javascript:void(0)' ?>" class="post-img">
                <img src="<?= $blimage ?>" alt="<?= !empty($blvalue['blog_image_alt']) ? $blvalue['blog_image_alt'] : '' ?>" class="img-fluid w-100">
                </a>
                <div class="blog-multipulecard">
                  <h2 class="title">
                    <a href="<?= !empty($blvalue['slug']) ? base_url($blvalue['slug']) : 'javascript:void(0)' ?>"><?= !empty($blvalue['blog_title']) ? $blvalue['blog_title'] : '' ?></a>
                  </h2>
                  <p class="multicard-prh"><?= !empty($blvalue['short_description']) ? $blvalue['short_description'] . '...' : 'javascript:void(0)' ?><a href="<?= !empty($blvalue['slug']) ? base_url($blvalue['slug']) : 'javascript:void(0)' ?>">read more</a></p>
                  <div class="d-flex align-items-center justify-content-between blog-posttitle">
                    <span>
                      <p class="title">Posted On</p>
                      <p class="prh"><?= !empty($blvalue['created_date']) ? date('d/m/Y', strtotime($blvalue['created_date'])) : '' ?></p>
                    </span>
                    <span>
                      <p class="title">Posted By</p>
                      <p class="prh"><?= !empty($blvalue['created_by']) ? $blvalue['created_by'] : '' ?></p>
                    </span>
                    <span>
                    </span>
                  </div>
                </div>
              </article>
            </div>
          </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </div>
  <?php endif; ?>
</div>
<?php if(!empty($testimonial_list)){?>
<section class="student-Mainsec p-0">
  <div class="feedback-student about" id="about" >
    <div class="container" data-aos="fade-up" data-aos-delay="100">
      <div class="row">
        <div class="col-xl-7">
          <div class="row icon-boxes">
            <?php foreach($testimonial_list as $tlkey=>$tlvalue){?>
            <?php $testimonial_image = "";   ?>
            <div class="col-md-6" data-aos="fade-up" data-aos-delay="300">
              <div class="icon-box student-feds studentboy">
                <span class="d-flex justify-content-center">
                <img src="<?=$testimonial_image?>" alt="<?=!empty($tlvalue['image_alt'])?$tlvalue['image_alt']:''?>" class="img-fluid">
                </span>
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