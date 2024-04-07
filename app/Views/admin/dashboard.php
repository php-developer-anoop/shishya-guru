<style>
  .container-fluid a,a:hover{
  color:black;
  }
</style>
<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row">
    
       <div class="col-12 col-sm-6 col-md-3">
          <a href="<?=base_url(ADMINPATH.'leads-list?type=New')?>" >
            <div class="info-box">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-cog"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">New Leads</span>
                <span class="info-box-number" id="new">
                00
                </span>
              </div>
            </div>
          </a>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
          <a href="<?=base_url(ADMINPATH.'leads-list?type=Assigned')?>" >
            <div class="info-box">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-cog"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Assigned Leads</span>
                <span class="info-box-number" id="assigned">
                00
                </span>
              </div>
            </div>
          </a>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
          <a href="<?=base_url(ADMINPATH.'leads-list?type=Pending')?>" >
            <div class="info-box">
              <span class="info-box-icon bg-secondary elevation-1"><i class="fas fa-cog"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Pending Tutor</span>
                <span class="info-box-number" id="pending">
                00
                </span>
              </div>
            </div>
          </a>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
          <a href="<?=base_url(ADMINPATH.'leads-list?type=All')?>" >
            <div class="info-box">
              <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-cog"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">All Leads</span>
                <span class="info-box-number" id="all">
                00
                </span>
              </div>
            </div>
          </a>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
          <a href="<?=base_url(ADMINPATH.'tutor-list?type=kyc_pending')?>" >
            <div class="info-box">
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-cog"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">KYC Pending Tutors</span>
                <span class="info-box-number" id="kyc_pending_tutors">
                00
                </span>
              </div>
            </div>
          </a>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
          <a href="<?=base_url(ADMINPATH.'tutor-list?type=kyc_completed')?>" >
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">KYC Completed Tutors</span>
                <span class="info-box-number" id="kyc_completed_tutors">
                00
                </span>
              </div>
            </div>
          </a>
        </div>
         <div class="col-12 col-sm-6 col-md-3">
          <a href="<?=base_url(ADMINPATH.'tutor-list?type=all')?>" >
            <div class="info-box">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-cog"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">All Tutors</span>
                <span class="info-box-number" id="all_tutors">
                00
                </span>
              </div>
            </div>
          </a>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
          <a href="<?=base_url(ADMINPATH.'recharge-request-list?type=Pending')?>" >
            <div class="info-box">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-cog"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">New Pending Recharge Request</span>
                <span class="info-box-number" id="pending_recharge_request">
                00
                </span>
              </div>
            </div>
          </a>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
  function getCount( type,table ){  
    $.ajax({
      url: '<?= base_url(ADMINPATH.'getCount') ?>',
      type: "POST",
      data: {'type': type,'table':table},
      cache: false,
        success:function(response) {   
         $('#'+ type ).html(response);
        }
      });
    }
    function loaddatavalue(){  
  setTimeout( ()=>{ getCount( 'new','leads_list' ); },200 );
  setTimeout( ()=>{ getCount( 'assigned','leads_list' ); },400 );
  setTimeout( ()=>{ getCount( 'pending','leads_list' ); },600 );
  setTimeout( ()=>{ getCount( 'all','leads_list' ); },800 );
  setTimeout( ()=>{ getCount( 'all_tutors','tutor_list' ); },1000 );
  setTimeout( ()=>{ getCount( 'kyc_pending_tutors','tutor_list' ); },1200 );
  setTimeout( ()=>{ getCount( 'kyc_completed_tutors','tutor_list' ); },1400 );
  setTimeout( ()=>{ getCount( 'pending_recharge_request','recharge_request' ); },1600 );
  
}
  
  window.load = loaddatavalue();
</script>