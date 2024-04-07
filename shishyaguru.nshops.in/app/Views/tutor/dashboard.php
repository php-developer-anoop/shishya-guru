<main id="main" class="main">
  <div class="pagetitle">
    <p><i class="bi bi-folder"></i> <span class="current"> <a href="<?=($tutor['kyc_status']!="Approved")?'javascript:void(0)':base_url(TUTORPATH.'dashboard')?>">Dashboard</a></span></p>
    <span class="dashobord-title">
      <h1>Hey <span class="profileName"> <?=$tutor_name?></span> / <span><?=$unique_id?></span></h1>
      <p></p>
    </span>
  </div>
  <section class="section dashboard">
    <div class="row">
      <div class="col-lg-12">
        <div class="row">
          <div class="col-xxl-4 col-md-6 col-lg-4">
            <div class="card info-card sales-card">
              <div class="filter">
                <a class="icon" href="<?=base_url(TUTORPATH.'picked-leads')?>"><i class="bi bi-arrow-up-right-circle-fill"></i></a>
              </div>
              <a href="<?=base_url(TUTORPATH.'picked-leads')?>">
                <div class="card-body ">
                  <h5 class="card-title">Picked Leads</h5>
                  <div class="d-flex align-items-center">
                    <div class="d-flex align-items-center profit-lossIcon">
                      <h6 id="accepted">00</h6>
                      <span class="ms-2 d-none"><i class="bi bi-arrow-up-short"></i></span>
                    </div>
                  </div>
                </div>
              </a>
            </div>
          </div>
          <div class="col-xxl-4 col-md-6 col-lg-4">
            <div class="card info-card sales-card">
              <div class="filter">
                <a class="icon" href="<?=base_url(TUTORPATH.'active-tuitions')?>"><i class="bi bi-arrow-up-right-circle-fill"></i></a>
              </div>
              <a href="<?=base_url(TUTORPATH.'active-tuitions')?>">
                <div class="card-body">
                  <h5 class="card-title">Active Tuition</h5>
                  <div class="d-flex align-items-center">
                    <div class="d-flex align-items-center profit-lossIcon">
                      <h6 id="active">00</h6>
                      <span class="ms-2 bg-danger d-none"><i class="bi bi-arrow-down-short"></i></span>
                    </div>
                  </div>
                </div>
              </a>
            </div>
          </div>
          <div class="col-xxl-4 col-md-6 col-lg-4">
            <div class="card info-card bodyCard-bg">
              <div class="outercard-icon">
                <a class="icon" href="<?=base_url(TUTORPATH.'my-wallet')?>"> <img src="<?=base_url('assets/tutor/')?>img/card-arrow.png" class="img-fluid"></a>
              </div>
              <div class="filter card3">
                <img src="<?=base_url('assets/tutor/')?>img/card-icon.png" class="img-fluid">
              </div>
              <a href="<?=base_url(TUTORPATH.'my-wallet')?>">
                <div class="card-body ">
                  <p class="card-title text-white Wallet">Wallet</p>
                  <div class="d-flex align-items-center">
                    <div class="align-items-center profit-lossIcon">
                      <span class="balance">Total balance </span>
                      <h6 class="text-white m-0"> <?=!empty($tutor['wallet_balance'])?'₹ '.$tutor['wallet_balance']:''?></h6>
                      <span class="balance "><i class="bi bi-arrow-up-right d-none"></i></span>
                    </div>
                  </div>
                </div>
              </a>
            </div>
          </div>
          <div class="row custum-mx-auto">
            <?php if(!empty($leads)){?>
            <div class="col-lg-6 col-md-6 col-sm-12">
              <div class="card custum-overflow">
                <div class="filter">
                  <a class="icon" href="<?=base_url(TUTORPATH.'leads-list?type=New')?>"><i class="bi bi-arrow-up-right-circle-fill"></i></a>
                </div>
                <div class="card-body cardheightSet" id="style-3">
                  <h5 class="card-title">New Leads</h5>
                  <?php foreach($leads as $lkey=>$lvalue){?>
                  <div class="row">
                    <div class="col-6 leadCard-dashbord">
                      <h5><?=!empty($lvalue['name'])?$lvalue['name']:''?></h5>
                      <span><?=!empty($lvalue['class_name'])?$lvalue['class_name']:''?> <?=!empty($lvalue['board_name'])?$lvalue['board_name']:''?></span>
                      <p><i class="bi bi-geo-alt"></i> <?=!empty($lvalue['city_name'])?$lvalue['city_name']:''?></p>
                    </div>
                    <div class="col-6 leadCard-dashbord-2">
                      <p>Subject:
                        <span><?=!empty($lvalue['subject_name'])?$lvalue['subject_name']:''?></span>
                      </p>
                      <div class="d-flex justify-content-end lead-lastcard">
                        <h6><?=!empty($lvalue['tuition_mode'])?$lvalue['tuition_mode']:''?></h6>
                        <h6 class="lastchild" style="cursor:pointer;" id="number<?=$lvalue['id']?>" onclick="return showNumber(<?=$lvalue['id']?>,<?=$lvalue['city_id']?>,<?=$lvalue['class_id']?>)">Show Number</h6>
                      </div>
                    </div>
                  </div>
                  <hr>
                  <?php } ?>
                </div>
              </div>
            </div>
            <?php } ?>
            <?php if(!empty($reviews)){?>
            <div class="col-lg-6 col-md-6 col-sm-12">
              <div class="card card custum-overflow">
                <div class="filter">
                  <a class="icon" href="<?=base_url(TUTORPATH.'reviews')?>"><i class="bi bi-arrow-up-right-circle-fill"></i></a>
                </div>
                <div class="card-body cardheightSet" id="style-3">
                  <h5 class="card-title">Latest Reviews</h5>
                  <?php foreach($reviews as $rkey=>$rvalue){?>
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
                  <?php } ?>
                </div>
              </div>
            </div>
            <?php } ?>
          </div>
        </div>
      </div>
    </div>
    </div>
  </section>
</main>
<span>
    <div class="modal fade mt-5" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel"
      aria-hidden="true">
      <div class="modal-dialog modal-sm">
        <div class="modal-content">
          <span class="text-end">
          <button type="button" class="btnclosebtn" data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-x"></i></button>
          </span>
          <div class="modal-body infficientBalance">
            <div class="border-0">
              <div class="card-body text-center">
                <div class=" py-3">
                  <img src="<?=base_url('assets/tutor/')?>/img/wallet2.png" class="img-fluid">
                </div>
                <h5>Insufficient Balance</h5>
                <!--<a href="">Add fund</a>-->
                <h6>Contact Admin : <?=!empty($company['care_mobile'])?'+91 '.$company['care_mobile']:''?></h6>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </span>
<script>
 
function showNumber(lead_id, city_id, class_id) {
    $.ajax({
        type: 'POST',
        url: '<?= base_url(TUTORPATH.'showNumber')?>',
        data: {
            'city_id': city_id,
            'class_id': class_id,
            'lead_id': lead_id
        },
        dataType: 'json',
        beforeSend: function() {
            $('#number' + lead_id).text('Please Wait...');
            $('#number' + lead_id).attr("disabled");
        },
        success: function(res) {
            
            if (res.status == true) {
                $('#number' + lead_id).css({'background': '#ffffff', 'color': 'black'}).text(res.mobile_no);
            } else {
                $('#exampleModal2').modal('show');
                $('#number' + lead_id).text('Show Number');
                return false;
            }
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
}

function getCount( type,table ){  
    $.ajax({
      url: '<?= base_url(TUTORPATH.'getCount') ?>',
      type: "POST",
      data: {'type': type},
      cache: false,
        success:function(response) {   
         $('#'+ type ).html(response);
        }
      });
    }
    
    function loaddatavalue(){  
    
   setTimeout( ()=>{ getCount( 'accepted' ); },500 );
  setTimeout( ()=>{ getCount( 'active' ); },600 );  
    }
     window.load = loaddatavalue();
</script>