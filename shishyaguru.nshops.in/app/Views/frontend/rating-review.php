<main id="main" class="institute-sec_page">
  <section class="breadcrumbs-sec">
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
  <div class="mid-section m-0 rating-reviwPage">
    <div class="services-sec rating-sec d-none ">
      <div class="col-md-12">
        <h4><?=!empty($page['h1'])?$page['h1']:''?></h4>
      </div>
      <div class="Rating-review d-flex border-purple py-2">
        <div class="col-lg-6 d-flex mt-2">
          <div class="reviw-point">
            <span>4.0</span>
          </div>
          <div class="mx-3 rating-prh">
            <h5>View All 378 Ratings</h5>
            <p>Index based on 378 rating across web.</p>
          </div>
        </div>
        <hr>
        <div class="col-lg-6 Start-rating d-flex">
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
          <a href="#" class="write-review2" data-bs-toggle="modal" data-bs-target="#exampleModal">Write Review</a>
        </div>
      </div>
    </div>
    <?php if(!empty($testimonial_list)){?>
    <div class="allreviw-title">
      <h4>User Reviews</h4>
      <p>
        <select class="form-select" aria-label="Default select example" id="sort_by" onchange="getReviews(this.value)">
          <option value="">Sort By</option>
          <option value="Latest">Latest</option>
          <option value="Oldest">Oldest</option>
        </select>
      </p>
    </div>
    <div id="appendReviews">
      <?php foreach($testimonial_list as $tlkey=>$tlvalue){?>
      <div class="allreview-sec firstallreviwsec">
        <span class="titlesec">
          <h4><?=!empty($tlvalue['name'])?$tlvalue['name']:''?></h4>
          <p><?=!empty($tlvalue['location'])?$tlvalue['location']:''?></p>
        </span>
        <p><?=!empty($tlvalue['testimonial'])?$tlvalue['testimonial']:''?></p>
        <div class="review-Icon">
          <?=showRatings($tlvalue['rating'])?>
          <p><b>Posted On:</b><span class="px-1"><?=!empty($tlvalue['add_date'])?date('d/m/Y',strtotime($tlvalue['add_date'])):''?></span><span class="px-1"><?=!empty($tlvalue['add_date'])?date('H:i A',strtotime($tlvalue['add_date'])):''?></span></p>
        </div>
      </div>
      <?php } ?>
      <?php } ?>
    </div>
    <div id="appendLoadMoreReviews"></div>
    <div class="loader text-center"><img src="<?=base_url('assets/frontend/')?>img/loader.gif" alt="" height="300" width="400"></div>
    <?php $count=0;if(!empty($tutor_id)){
            $count=tutor_testimonial_count($tutor_id);
    }else{
        $count=testimonial_count();
    }
    if(($count) > 10){?>
    <div class="text-center mb-2">
      <a class="btn btn-loadmore" href="javascript:void(0);" id="loadMoreReviews">Load More</a>	
    </div>
    <?php } ?>
    <?php if(!empty($faq_list)){?>
    <section id="faq" class="faq section-bg">
      <div class="services-sec" data-aos="fade-up">
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
  </div>
</main>
<?php $bottombanner = !empty($home['bottom_banner_jpg'] || $home['bottom_banner_webp']) ? base_url('uploads/') . imgExtension($home['bottom_banner_jpg'], $home['bottom_banner_webp']) : "";  ?>
<section class="registration content-section resitation-page" style="background-image:url('<?=$bottombanner?>')">
  <div class="registertutor">
    <h3>
    Register as Tutor</h2>
    <p><i class="bi bi-chevron-double-up"></i> 2000+ Tutors already registered with us</p>
    <a class="cta-btn" href="<?=base_url('tutor-register')?>">Register Now</a>
  </div>
</section>
<script>
 function getReviews(val) {
     
    if (val !== "") {
        $('#appendReviews').html('');
        $('#appendLoadMoreReviews').html('');
        $('#loadMoreReviews').show();
        $.ajax({
            url: "<?=base_url('getReviews')?>",
            cache: false,
            data: { val: val, tutor_id: <?= !empty($tutor_id) ? $tutor_id : 0 ?> },
            method: 'POST',
            dataType: 'html',
            success: function(response) {
                $('#appendReviews').html(response);
            },
            error: function(xhr, status, error) {
                console.error("An error occurred while fetching reviews:", error);
            }
        });
    }
}

 $('.loader').hide();
  $(document).ready(function() {
    var page = 0;
    // Hide loader initially

    $('#loadMoreReviews').on('click', function() {
        page++;
      var sort_by=$('#sort_by').val();
        $.ajax({
            url: '<?= base_url('getReviews') ?>',
            type: "POST",
            data: { page: page,val:sort_by },
            cache: false,
            beforeSend: function() {
                $('.loader').show(); // Show loader before sending AJAX request
            },
            success: function(response) {
                if (response) {
                    $('#appendLoadMoreReviews').append(response);
                } else {
                    $('#loadMoreReviews').hide();
                }
            },
            complete: function() {
              setTimeout(function() {
                $('.loader').hide();
            }, 1000);    // Hide loader after AJAX request is completed
            },
            error: function(xhr, status, error) {
                console.error("Error occurred while loading more tutors:", error);
            }
        });
    });
});
</script>