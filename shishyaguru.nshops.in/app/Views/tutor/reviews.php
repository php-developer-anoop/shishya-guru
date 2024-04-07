<main id="main" class="main">
  <div class="pagetitle">
    <p><i class="bi bi-folder"></i><span class="current"> <a href="<?=($tutor['kyc_status']!="Approved")?'javascript:void(0)':base_url(TUTORPATH.'dashboard')?>">Dashboard</a></span> / Reviews</p>
    <span class="dashobord-title">
    <h1>
      <i class="bi bi-arrow-left-short"></i>Reviews 
      <span class="profileName">
    </h1>
    </span>
  </div>
  <section class="section dashboard">
    <div class="row">
      <div class="col-lg-12">
        <div class="row">
          <div class="col-xxl-12 col-md-12 col-lg-12">
            <div class="card custum-overflow">
              <div class="card-body cardheightSet extraresponsive" id="style-3">
                <h5 class="card-title">Latest Reviews</h5>
                <?php if(!empty($reviews)){foreach($reviews as $rkey=>$rvalue){?>
                <div class="col-12 leadCard-dashbord">
                  <div class="d-flex">
                    <h4><?=!empty($rvalue['name'])?$rvalue['name']:''?></h4>
                    <span class="d-flex align-items-center ps-2">
                    <?=showTutorRatings($rvalue['rating'])?>
                    </span>
                  </div>
                  <div class="letest-reviwcard">
                    <div class="d-flex justify-content-between">
                      <span><i class="bi bi-geo-alt text-dark"></i> <?=!empty($rvalue['location'])?$rvalue['location']:''?></span>
                      <span><i class="bi bi-calendar"></i> <?=!empty($rvalue['add_date'])?date('d/m/Y',strtotime($rvalue['add_date'])):''?>, <?=!empty($rvalue['add_date'])?date('h:i A',strtotime($rvalue['add_date'])):''?></span>
                    </div>
                    <p><?=!empty($rvalue['testimonial'])?$rvalue['testimonial']:''?>
                    </p>
                  </div>
                </div>
                <hr>
                <?php }} ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>