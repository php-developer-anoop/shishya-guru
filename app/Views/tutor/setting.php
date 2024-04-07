<main id="main" class="main">
  <div class="pagetitle">
    <p><i class="bi bi-folder"></i><span class="current"> <a href="<?=($tutor['kyc_status']!="Approved")?'javascript:void(0)':base_url(TUTORPATH.'dashboard')?>">Dashboard</a></span> /  Settings  </p>
    <span class="dashobord-title">
    <h1>
      <i class="bi bi-arrow-left-short toggle-sidebar-btn"></i> Setting
      <span class="profileName">
    </h1>
    </span>
  </div>
  <section class="section dashboard">
    <div class="row">
      <div class="col-lg-12">
        <div class="row">
          <div class="col-xxl-12 col-md-12 col-lg-12">
            <div class="card">
              <div class="card-body blog-Section">
                <h4 class="card-title text-dark">
                Update Password</h5>
                <div class="row col-md-8">
                    <input type="hidden" id="tutor_id" value="<?=!empty($tutor['id'])?$tutor['id']:''?>">
                  <div class="col-md-4 custom_classInput mb-4">
                    <fieldset>
                      <legend>New Password</legend>
                      <input type="password" class="form-control" autocomplete="off" name="passages" id="password" placeholder="Enter Password" required="">
                    </fieldset>
                  </div>
                  <div class="col-md-4 custom_classInput">
                    <fieldset>
                      <legend>Confirm Password</legend>
                      <input type="password" class="form-control" autocomplete="off" name="password"  id="cpassword" placeholder="Enter Password" required="">
                    </fieldset>
                  </div>
                </div>
                <div class="savedbuttonSec">
                  <button class="btn-savedPassworld" id="submit" onclick="return validatePassword()">
                  Save
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>
<script>
    function validatePassword(){
        var tutor_id = $('#tutor_id').val().trim();
        var password = $('#password').val().trim();
        var cpassword = $('#cpassword').val().trim();

        if(password == ""){
            toastr.error("Please Enter Password");
            return false;
        } else if(cpassword == ""){
            toastr.error("Please Enter Confirm Password");
            return false;
        } else if(cpassword !== password){
            toastr.error("Both Password Should Be Same");
            return false;
        } else{
            $.ajax({
            url: '<?= base_url(TUTORPATH.'save-setting') ?>',
            type: 'POST',
            data: {
                'tutor_id':tutor_id,
                'password':password
            },
            cache: false,
            dataType: "json",
            beforeSend: function () {
                $('#submit').prop('disabled', true);
                $('#submit').text('Please Wait...');
            },
            success: function (response) {
                if (response.status === false) {
                    toastr.error(response.message);
                    $('#submit').prop('disabled', false);
                    $('#submit').text('Save');
                } else if (response.status === true) {
                    toastr.success(response.message);
                    $('#submit').prop('disabled', false);
                    $('#submit').text('Save');
                    setTimeout(function() {
                        window.location.reload();
                    },1000);
                }
            },
            error: function () {
                console.log('Error occurred during AJAX request');
            }
        });
        }
    }
</script>