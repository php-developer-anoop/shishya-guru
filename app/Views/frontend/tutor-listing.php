<main id="main" class="institute-sec_page container-fluid p-0">
  <section class="breadcrumbs-sec m-0 overflow-hidden">
    <div class="page-title">
      <nav class="breadcrumbs">
        <div class="">
          <ol>
            <li><a href="<?=base_url()?>">Home</a></li>
            <i class="fa-solid fa-chevron-right"></i>
            <li class="current">Tutor List</li>
          </ol>
        </div>
      </nav>
      <div class="overflow-hidden">
      <?=form_open('tutor-list',['method'=>'GET'])?>
      <div class="inputgroup-sec row">
        <div class="col-md-2 col-lg-2">
          <input type="text" class="form-control position-relative" id="location" onkeyup="return getLocation(this.value)" value="<?=!empty($location)?$location:'';?>" autocomplete="off" name="location" placeholder="Location">
          <div class="row position-absolute w-100">
      <div id="appendLocation" class="col-md-3 col-lg-2 pe-0">
      </div>
      </div>
        </div>
        <div class="col-md-2 col-lg-2">
          <select class="form-select" name="board" aria-label="Default select example">
            <option value="">Choose Board</option>
            <?php if(!empty($board_list)){foreach($board_list as $blkey=>$blvalue){?>
            <option value="<?=$blvalue['id']?>" <?=!empty($board) && ($board==$blvalue['id'])?'selected':''?>><?=$blvalue['board_name']?></option>
            <?php  }} ?>
          </select>
        </div>
        <div class="col-md-2 col-lg-2">
          <select class="form-select" name="class" aria-label="Default select example" onchange="getSubject(this.value,'subject')">
            <option value="">Choose Class</option>
            <?php if(!empty($class_list)){foreach($class_list as $clkey=>$clvalue){?>
            <option value="<?=$clvalue['id']?>" <?=(!empty($class) && ($class==$clvalue['id'])) || (!empty($get_class_name) && ($get_class_name==$clvalue['class_name'])) ?'selected':''?>><?=$clvalue['class_name']?></option>
            <?php  }} ?>
          </select>
        </div>
        <div class="col-md-2 col-lg-2">
          <select class="form-select" name="subject" aria-label="Default select example" id="subject">
            <option value="">Select Subject</option>
          </select>
        </div>
        <div class="col-md-2 col-lg-2">
          <select class="form-select" name="gender" aria-label="Default select example">
            <option value="">Gender</option>
            <option value="Male" <?=!empty($gender) && ($gender=="Male")?'selected':''?>>Male</option>
            <option value="Female" <?=!empty($gender) && ($gender=="Female")?'selected':''?>>Female</option>
          </select>
        </div>
        <div class="col-md-1 col-lg-1">
          <button type="Submit" class="form-control">Submit</button>
        </div>
        <div class="col-md-1 col-lg-1">
          <button class="form-control"><a href="<?=base_url('tutor-list')?>" class="fw-normal">Reset</a></button>
        </div>
      </div>
      <?=form_close()?>
      </div>
      <?php $topbanner = !empty($page['banner_image_jpg'] || $page['banner_image_webp']) ? base_url('uploads/') . imgExtension($page['banner_image_jpg'], $page['banner_image_webp']) : ""; ?>
      <section class="registration content-section p-0">
        <img src="<?=$topbanner?>" class="img-fluid" alt="<?=!empty($page['banner_image_alt'])?$page['banner_image_alt']:''?>">
      </section>
    </div>
  </section>
  <div class="content mb-5">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12 col-lg-4 col-xl-3 theiaStickySidebar ">
          <div class="side-section">
            <?php if(!empty($class_list)){?>
            <div class="sidebarinstittute">
              <div class="sidebarcontent">
                <p>Tutors By Classes</p>
                <ul class="p-0">
                  <?php foreach($class_list as $ckey=>$cvalue){?>
                  <li class="<?=($ckey==0) && (!empty($get_class_name) && ($get_class_name)==$cvalue['class_name'])?'text-purple':''?> inactive " id="class<?=$cvalue['id']?>"><a style="text-decoration:none;cursor:pointer;" onclick="return getTutors(<?=$cvalue['id']?>,'class')">
                    <i class="<?=($ckey==0) && (!empty($get_class_name) && ($get_class_name)==$cvalue['class_name'])?'fa-solid fa-circle-check':''?> <?=$get_class_name==$cvalue['class_name']?'fa-solid fa-circle-check':''?> uncheck" id="tickclass<?=$cvalue['id']?>"></i> 
                    Home tutor for <?=$cvalue['class_name']?></a>
                  </li>
                  <?php } ?>
                </ul>
              </div>
            </div>
            <?php } ?>
            <?php if(!empty($city_area_list)){?>
            <div class="sidebarinstittute mt-3">
              <div class="sidebarcontent">
                <p>Popular Areas</p>
                <ul class="p-0">
                  <?php foreach($city_area_list as $cakey=>$cavalue){?>
                  <li class="<?=(!empty($area) && ($area==$cavalue['area_name']))?'text-purple':''?> inactivearea" id="area<?=$cavalue['id']?>"><a style="text-decoration:none;cursor:pointer;" onclick="return getTutorsFromArea('<?=$cavalue['area_name'].' '.$cavalue['city_name']?>','area',<?=$cavalue['id']?>)">
                    <i class="<?=(!empty($area) && ($area==$cavalue['area_name']))?'fa-solid fa-circle-check':''?> uncheckarea" id="tickarea<?=$cavalue['id']?>"></i> 
                    <?=$cavalue['area_name']?>, <?=$cavalue['city_name']?></a>
                  </li>
                  <?php } ?>
                </ul>
              </div>
            </div>
            <?php } ?>
           
          </div>
        </div>
        <div class="col-md-12 col-lg-8 col-xl-9">
          <?php if(!empty($board_list)){?>
          <div class="slide-container swiper mb-3">
            <div class="container topinstudtte-slider">
              <div class=" container slider-contentslider">
                <div class="card-wrapper swiper-wrapper">
                  <?php foreach($board_list as $blskey=>$blsvalue){?>
                  <div class="card swiper-slide slidercls">
                    <div class="card instuttee-card">
                      <div class="instutte-cardsec">
                        <p><a href="javascript:void(0)" class="card-slidertop" onclick="return getTutors(<?=$blsvalue['id']?>,'board')"><?=$blsvalue['board_name']?></a></p>
                      </div>
                    </div>
                  </div>
                
                  <?php } ?>
                </div>
              </div>
            </div>
            <div class="extrastyle swiper-button-next swiper-navBtn"></div>
            <div class="extrastyle swiper-button-prev swiper-navBtn "></div>
          </div>
          <?php } ?>
         
          <div class="card border-0 row custumClassInstitute" id="appendTutorFilter">
               <?php if(!empty($tutor_list)){?>
            <?php foreach($tutor_list as $tlkey=>$tlvalue){?>
            <div class="cardbody-sec row mx-auto col-sm-6 col-lg-12 col-md-12">
              <div class="col-lg-3 col-md-3">
                <div class="doc-info-left">
                  <div class="doctor-img">
                    <img src="<?=!empty($tlvalue['profile_image'])?base_url('uploads/').$tlvalue['profile_image']:''?>" class="img-fluid teachercard" alt="User Image">
                  </div>
                </div>
              </div>
              <div class="col-lg-9 col-md-9">
                <div class="doc-info-cont">
                  <div class="dflexbtwn">
                    <h4 class="doc-name mx-2"><a href="<?=!empty($tlvalue['tutor_slug'])?base_url($tlvalue['tutor_slug']):'javascript:void(0)'?>"><?=!empty($tlvalue['tutor_name'])?$tlvalue['tutor_name']:''?> </a></h4>
                    <div class="social-links d-flex justify-content-around">
                      <a href="https://www.facebook.com/sharer/sharer.php?u=<?=base_url($tlvalue['tutor_slug'])?>"><i class="bi bi-facebook"></i></a>
                      <a href="https://twitter.com/intent/tweet?url=<?=base_url($tlvalue['tutor_slug'])?>"><i class="bi bi-twitter"></i></a>
                      <a href="https://api.whatsapp.com/send?text=<?=base_url($tlvalue['tutor_slug'])?>"><i class="bi bi-whatsapp"></i></a>
                      <a href="https://www.linkedin.com/sharing/share-offsite/&amp;url=<?=base_url($tlvalue['tutor_slug'])?>"><i class="bi bi-linkedin"></i></a>
                    </div> 
                  </div>
                  <div class="clinic-details">
                    <div class="col-lg-12 row mx-auto">
                      <div class="col-lg-5 col-md-5">
                        <div class="col-md-12">
                          <div class="d-flex appoitnment-img">
                            <img src="<?=base_url('assets/frontend/')?>img/Book.png" class="img-fluid"> 
                            <p class="doc-location"><?=!empty($tlvalue['experience_years'])?$tlvalue['experience_years'].' Years':'N/A'?></p>
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="d-flex appoitnment-img">
                            <img src="<?=base_url('assets/frontend/')?>img/Location.png" class="img-fluid"> 
                            <p class="doc-location"><?=!empty($tlvalue['address'])?$tlvalue['address']:'N/A'?></p>
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-4 col-md-4">
                        <div class="col-md-12">
                          <div class="d-flex appoitnment-img">
                            <img src="<?=base_url('assets/frontend/')?>img/rupees.png" class="img-fluid"> 
                            <p class="doc-location"><?=!empty($tlvalue['monthly_fees'])?(int)$tlvalue['monthly_fees'].' per month':'N/A'?></p>
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="d-flex appoitnment-img">
                            <img src="<?=base_url('assets/frontend/')?>img/profile (1).png" class="img-fluid"> 
                            <p class="doc-location"><?=!empty($tlvalue['gender'])?$tlvalue['gender']:'N/A'?></p>
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-3 col-md-3">
                        <div class="doc-info-right">
                          <div class="clini-infos">
                            <ul>
                              <li><i class="fa-solid fa-star"></i> <?=!empty($tlvalue['avg_rating'])?$tlvalue['avg_rating']:'N/A'?> <?=!empty($tlvalue['total_reviews'])?'('.$tlvalue['total_reviews'].' reviews)':'N/A'?>  </li>
                            </ul>
                          </div>
                        </div>
                      </div>
                      <p class="m-0">Listed In:</p>
                      <div class="col-lg-12 col-md-12 row p-0 m-0">
                        <div class="col-lg-9 col-md-5">
                          <?php $boards=!empty($tlvalue['board'])?getMultipleBoard($tlvalue['board']):'';
                            $boardsArray=!empty($boards)?explode(',',$boards):[];
                            
                            $subjects=!empty($tlvalue['subject'])?getMultipleSubject($tlvalue['subject']):'';
                            $subjectArray=!empty($subjects)?explode(',',$subjects):[];
                            
                            ?>
                          <div class="clinic-services ">
                            <?php $totalBoards=0;
                            $totalSubjects=0;
                            if(!empty($boardsArray)){foreach($boardsArray as $bakey=>$bavalue){
                            $totalBoards+=strlen($bavalue);
                            ?>
                            <span><?=$bavalue?></span>
                            <?php }} ?>
                            <?php if(!empty($subjectArray)){foreach($subjectArray as $sakey=>$savalue){
                            $totalSubjects+=strlen($savalue);
                            ?>
                            <span><?=$savalue?></span>
                            <?php }} ?>
                          </div>
                          
                        </div>
                        <div class="col-lg-3 col-md-7">
                          <div class="carddetailsbtn d-flex justify-content-end">
                            <a href="<?=!empty($tlvalue['tutor_slug'])?base_url($tlvalue['tutor_slug']):'javascript:void(0)'?>" class="details">View Details</a>
                            <a href="<?=!empty($tlvalue['tutor_slug'])?base_url($tlvalue['tutor_slug']):'javascript:void(0)'?>" class="applynow d-none">Apply Now</a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <?php }}else{ ?>
            
            <div class='d-flex justify-content-center mt-1 h-100'><img class="w-100 img-fluid" src="<?=base_url('assets/no_tutor_found.jpg')?>" /></div>
            <?php } ?>
            <div class="loader text-center"><img src="<?=base_url('assets/frontend/')?>img/loader.gif" alt="" height="300" width="400"></div>
            <div  id="appendTutors"></div>
          </div>


          
          
          <?php if((tutors_count()) > 10){?>
          <div class="text-center">
              
            <a class="btn btn-loadmore" href="javascript:void(0);" id="loadMoreTutors">Load More</a>	
          </div>
          <?php } ?>
        </div>
      </div>
      <section class="adminposted">
        <div class="col-lg-12 col-md-12 footer-about tutors_lucknow">
          <div class="col-lg-3 col-lg-3">
            <div class="social-links d-flex justify-content-around">
              Share This: 
              <a href="<?=!empty($page_url)?'https://www.facebook.com/sharer/sharer.php?u='.($page_url):'javascript:void(0)'?>" ><i class="bi bi-facebook"></i></a>
              <a href="<?=!empty($page_url)?'https://twitter.com/intent/tweet?url='.($page_url):'javascript:void(0)'?>"><i class="bi bi-twitter"></i></a>
              <a href="<?=!empty($page_url)?'https://api.whatsapp.com/send?text='.($page_url):'javascript:void(0)'?>"><i class="bi bi-whatsapp"></i></a>
              <a href="<?=!empty($page_url)?'https://www.linkedin.com/sharing/share-offsite/&amp;url='.($page_url):'javascript:void(0)'?>"><i class="bi bi-linkedin"></i></a>
            </div>
          </div>
          <?php /*
          <div class="tutor-pragraph moretext ">
            <?=!empty($page['description'])?$page['description']:''?>
          </div>
          
          <div class="">
            <a href="javascript:void(0)" class="tutorsgroup moreless-button">Read More</a>
          </div>
          */?>
        </div>
      </section>
      <?php /*if(!empty($faq_list)){?>
      <section id="faq" class="faq section-bg">
        <div class="container" data-aos="fade-up">
          <div class="faq-list">
            <h3 class="heading"><?=!empty($page['faq_heading'])?$page['faq_heading']:''?></h3>
            <ul>
              <?php foreach($faq_list as $key=>$value){ ?>
              <li data-aos="fade-up" data-aos-delay="100">
                <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse" class="<?=$key!=0?"collapsed":""?>" data-bs-target="#faq-list-<?php echo $key; ?>"> <span class="accodiant_itmeheding"><?php echo $value['question']; ?></span> <i class="fa-solid fa-circle-plus icon-show"></i><i class="fa-solid fa-circle-minus icon-close"></i></a>
                <div id="faq-list-<?php echo $key; ?>" class="collapse <?php echo $key == 0 ? 'show' : ''; ?>" data-bs-parent=".faq-list">
                  <p><?php echo $value['answer']; ?></p>
                </div>
              </li>
              <?php } ?>
            </ul>
          </div>
        </div>
      </section>
      <?php } */ ?>
    </div>
  </div>

<?php /* if(!empty($testimonial_list)){?>
<section class="student-Mainsec p-0">
  <div class="feedback-student instudecldabout about" id="about" >
    <div class="container">
      <div class="row">
        <div class="col-xl-7">
          <div class="row icon-boxes">
            <?php foreach($testimonial_list as $tlkey=>$tlvalue){?>
            <div class="col-md-6">
              <?php $testimonial_image = !empty($tlvalue['image_jpg'] || $tlvalue['image_webp']) ? base_url('uploads/') . imgExtension($tlvalue['image_jpg'], $tlvalue['image_webp']) : "";   ?>
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
            <span class="feed-union instute">
            <img src="<?=base_url('assets/frontend/')?>img/feedunion.png" class="img-fluid">
            </span>
            <span class="feed-union2">
            <img src="<?=base_url('assets/frontend/')?>img/bottom reviw.png" class="img-fluid">
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
<?php }*/ ?>
<?php  $bottombanner = !empty($home['bottom_banner_jpg'] || $home['bottom_banner_webp']) ? base_url('uploads/') . imgExtension($home['bottom_banner_jpg'], $home['bottom_banner_webp']) : "";  ?>
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
  document.addEventListener('DOMContentLoaded', function() {
    const cards = document.querySelectorAll('.instutte-cardsec');

    cards.forEach(card => {
      card.addEventListener('click', function() {
        // Remove 'active' class from all cards
        cards.forEach(c => c.classList.remove('active'));
        // Add 'active' class to the clicked card
        this.classList.add('active');
        // You can add further functionality here, like fetching data
        // or performing other actions when a card is clicked
      });
    });
  });
</script>


<script>
    <?php 
    if(!empty($class)){
    ?>
    getSubject(<?=$class?>,'subject');
    <?php 
    }
    ?>
    <?php 
    if(!empty($get_class_name)){
    ?>
    getSubject('<?=$get_class_name?>','subject');
    <?php 
    }
    ?>
  function getSubject(class_id,append_id){
    $('#'+append_id).html('');
    <?php if(!empty($subject)){?>
    var subject_id=<?=$subject?>;
    <?php }else{ ?>
    var subject_id='';
    <?php } ?>
    $.ajax({
      url: '<?= base_url('getSubject') ?>',
      type: "POST",
      data: { 'class_id': class_id,subject_id:subject_id},
      cache: false,
      success: function (response) {
          $('#'+append_id).html(response);
      }
    });
  }
  $('.loader').hide();
  $(document).ready(function() {
    var page = 0;
     // Hide loader initially

    $('#loadMoreTutors').on('click', function() {
        page++;

        $.ajax({
            url: '<?= base_url('loadMoreTutors') ?>',
            type: "POST",
            data: { page: page },
            cache: false,
            beforeSend: function() {
                $('.loader').show(); // Show loader before sending AJAX request
            },
            success: function(response) {
                if (response) {
                    $('.loader').hide();
                    $('#appendTutors').append(response);
                } else {
                    $('#loadMoreTutors').hide();
                }
            },
            complete: function() {
              
              setTimeout(function() {
                $('.loader').hide();
            }, 1000); // Hide loader after AJAX request is completed
            },
            error: function(xhr, status, error) {
                console.error("Error occurred while loading more tutors:", error);
            }
        });
    });
});

function getTutors(id, type) {
    $('#appendTutorFilter').html('');
    <?php if(!empty($subject_id)){?>
        var subject_id='<?=$subject_id?>';
    <?php }else{?>
       var subject_id=''; 
    <?php }?>
    $.ajax({
        url: '<?= base_url('getTutors') ?>',
        type: "POST",
        data: { id: id, type: type,subject_id:subject_id },
        cache: false,
        success: function(response) {
            $('#appendTutorFilter').html(response);
            if(type=="class"){
            $('.inactive').removeClass('text-purple');
            $('.uncheck').removeClass('fa-solid fa-circle-check');
            $('#' + type + id).addClass('text-purple');
            $('#tick' + type + id).addClass('fa-solid fa-circle-check');
            }
          
        },
        error: function(xhr, status, error) {
            console.error('Error:', error);
        }
    });
}

function getTutorsFromArea(searchlike, type,id) {

    $('#appendTutorFilter').html('');
    $.ajax({
        url: '<?= base_url('getTutors') ?>',
        type: "POST",
        data: { id: searchlike, type: type },
        cache: false,
        success: function(response) {
            $('#appendTutorFilter').html(response);
            $('.inactivearea').removeClass('text-purple');
            $('.uncheckarea').removeClass('fa-solid fa-circle-check');
            $('#' + type + id).addClass('text-purple');
            $('#tick' + type + id).addClass('fa-solid fa-circle-check');
        },
        error: function(xhr, status, error) {
            console.error('Error:', error);
        }
    });
}

function getLocation(keyword){
 // alert(keyword);
 $('#appendLocation').html('');
 if(keyword){
  $.ajax({
        url: '<?= base_url('getLocation') ?>',
        type: "POST",
        data: { keyword: keyword},
        cache: false,
        success: function(response) {
            $('#appendLocation').html(response);

        },
        error: function(xhr, status, error) {
            console.error('Error:', error);
        }
    });
 }

}
function gotoLocation(val){
$('#location').val(val);
$('#appendLocation').html('');
}
</script>