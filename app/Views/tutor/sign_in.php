<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title><?=$title?></title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <!-- Favicons -->
    <link href="<?=base_url('assets/tutor/')?>img/favicon.png" rel="icon">
    <link href="<?=base_url('assets/tutor/')?>img/apple-touch-icon.png" rel="apple-touch-icon">
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
      rel="stylesheet">
    <!-- Vendor CSS Files -->
    
    <link href="<?=base_url('assets/tutor/')?>vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?=base_url('assets/tutor/')?>vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="<?=base_url('assets/tutor/')?>vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="<?=base_url('assets/tutor/')?>vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="<?=base_url('assets/tutor/')?>vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="<?=base_url('assets/tutor/')?>vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="<?=base_url('assets/tutor/')?>vendor/simple-datatables/style.css" rel="stylesheet">
    <!-- Template Main CSS File -->
    <link href="<?=base_url('assets/tutor/')?>css/style.css" rel="stylesheet">
   
    <?=link_tag(base_url('assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css'))."\n";?>
    <?=link_tag(base_url('assets/plugins/toastr/toastr.min.css'))."\n";?>
    <style>
      .swal2-popup.swal2-toast .swal2-title {
      font-size: 15px;
      margin: 10px;
      color: #6c757d;
      }
    </style>
  </head>
  <body>
    <main class="Admin-bgImg">
      <div class="container">
        <section class="section register min-vh-100 d-flex align-items-end justify-content-center py-4">
          <div class="container">
            <div class="row justify-content-around">
              <div class="col-lg-6 col-md-6 d-flex align-items-end justify-content-center phon-view ">
                <div class="header_imgSec">
                  <div class="header_icon">
                    <img src="<?=base_url('assets/tutor/')?>img/illustration_1.png" class="img-fluid">
                  </div>
                  <img src="<?=base_url('assets/tutor/')?>img/human-icon.png" class="img-fluid human_img">
                  <div class="header_icon2">
                    <img src="<?=base_url('assets/tutor/')?>img/illustration_2.png" class="img-fluid">
                  </div>
                </div>
              </div>
              <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
                <div class="card mb-5">
                  <div class="card-body">
                    <div class="pt-4 pb-2">
                      <h5 class="text-center"><img src="<?=base_url('assets/tutor/')?>img/logo.png" class="img-fluid"></h5>
                      <p class="form_heading">Sign in</p>
                    </div>
                    <form class="row g-3 needs-validation custum_InputAdmin" novalidate>
                      <div class="col-12">
                        <label for="yourEmail" class="form-label">Email ID:</label>
                        <input type="email" name="email" class="form-control emailInput" autocomplete="off" value="<?=$email?>"  placeholder="Enter email id" id="email" required>
                        <div class="invalid-feedback">Please enter a valid Email adddress!</div>
                      </div>
                      <div class="col-12">
                        <label for="password1" class="form-label">Password:</label>
                        <input type="password" name="password" class="form-control" autocomplete="off" value="<?=$password?>" placeholder="Password" id="password"  required>
                        <span class="toggle-password bi bi-eye-slash field-icon" toggle="#password1" onclick="return openPassword()"></span>
                        <div class="invalid-feedback">Please Create a Password!</div>
                      </div>
                      <div class="col-12">
                        <div class="form-check">
                          <input class="form-check-input" name="terms" type="checkbox" value="" id="keep_sign_in" required>
                          <label class="form-check-label" for="acceptTerms">Keep me signed in</label>
                          <div class="invalid-feedback">You must agree before submitting.</div>
                        </div>
                      </div>
                      <div class="col-12">
                        <button class="btn btn-Purple w-100" type="button" id="submit" onclick="return validateTutor()">Sign In</button>
                      </div>
                    </form>
                    <div class="row">
                        
                        <div class="col-lg-6"><a href="<?=base_url()?>" class="text-purple">Back To Home</a></div>
                        <div class="col-lg-6"><a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#exampleModal2" class="text-purple">Forgot Password</a></div>
                        
                    </div>
                   
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
    </main>
    <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title fs-5" id="exampleModalLabel">Get Password On Email</h4>
        <a href="javascript:void()" data-bs-dismiss="modal" aria-label="Close">
<i class="bi bi-x"></i>
        </a>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-lg-9">
            <input type="email" placeholder="Enter Registered Email" class="form-control emailInput" autocomplete="off"  id="registered_email" value="">
            <input type="hidden" id="tutor_id" value="">
          </div>
          <div class="col-lg-3" ><button class="btn btn-success" onclick="return validateForgotPassword()" id="modal_submit">Submit</button></div>
        </div>
      </div>
    </div>
  </div>
</div>
    <!-- End #main -->
    <a href="javascript:void(0)" class="back-to-top d-flex align-items-center justify-content-center"><i
      class="bi bi-arrow-up-short"></i></a>
    <!--  Jquery Files -->
   
    <!-- Vendor JS Files -->
    <?=script_tag(base_url('assets/plugins/jquery/jquery.min.js'))?>
    
    <script src="<?=base_url('assets/tutor/')?>vendor/apexcharts/apexcharts.min.js"></script>
    <script src="<?=base_url('assets/tutor/')?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?=base_url('assets/tutor/')?>vendor/chart.js/chart.umd.js"></script>
    <script src="<?=base_url('assets/tutor/')?>vendor/echarts/echarts.min.js"></script>
    <script src="<?=base_url('assets/tutor/')?>vendor/quill/quill.min.js"></script>
    <script src="<?=base_url('assets/tutor/')?>vendor/tinymce/tinymce.min.js"></script>
    <script src="<?=base_url('assets/tutor/')?>vendor/php-email-form/validate.js"></script>
    <!-- Template Main JS File -->
    <script src="<?=base_url('assets/tutor/')?>js/mainadmin.js"></script>
    <script src="<?=base_url('assets/tutor/')?>js/admin.js"></script>

    <?=script_tag(base_url('assets/plugins/sweetalert2/sweetalert2.min.js'))?>
    <?=script_tag(base_url('assets/plugins/toastr/toastr.min.js'))?>
    <?=script_tag(base_url('assets/common.js'))?>

    <script>
        var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 1000
      });
      function validateTutor() {
        var email = $('#email').val().trim();
        var password = $('#password').val().trim();
        var keep_signed_in = $('#keep_sign_in').prop('checked');
        
      
        if (email == "") {
          Toast.fire({
            icon: 'warning',
            title: 'Please Fill Email'
          })
          return false;
        } else if (password == "") {
          Toast.fire({
            icon: 'warning',
            title: 'Please Fill Password'
          })
          return false;
        } else {
            $.ajax({
         type: 'POST',
         url: '<?=base_url(TUTORPATH.'checkLogin')?>',
         data: {
           'email': email,
           'password': password,
           'is_remember':keep_signed_in
         },
         dataType: 'json',
         beforeSend: () => {
            $('#submit').text('Please Wait...');
            $('#submit').prop("disabled", true);
         },
         success: (res) => {
           if (res.status) {
            Toast.fire({
               icon: 'success',
               title: res.message
             })
             setTimeout(function() {
             window.location.href = '' + res.goto;
             },1000);
           } else {
            $('#submit').text('Sign In');
            $('#submit').prop("disabled", false);
             Toast.fire({
               icon: 'error',
               title: res.message
             })
           }
         }
       });
        }
      }
      
      function openPassword(){
        var passwordField = $('#password');
        var passwordFieldType = passwordField.attr('type');
        
        if (passwordFieldType == 'password') {
            passwordField.attr('type', 'text');
            $(this).text('Hide');
        } else {
            passwordField.attr('type', 'password');
            $(this).text('Show');
        }
      }
      
      function validateForgotPassword() {
    var registered_email = $('#registered_email').val().trim();
    if (registered_email == "") {
        toastr.error("Please Enter Registered Email");
        return false;
    } else {
        $.ajax({
            type: 'GET', // Changed from GET to POST
            url: '<?= base_url(TUTORPATH."sendForgotPassword") ?>', // Fixed syntax
            data: {
                'email': registered_email,
            },
            dataType: 'json',
            beforeSend: function() {
                $('#modal_submit').text('Please Wait...');
                $('#modal_submit').prop("disabled", true);
            },
            success: function(res) {
                if (res.status) {
                    toastr.success(res.message);
                    $('#exampleModal2').modal('hide');
                    $('#registered_email').val('');
                    $('#modal_submit').text('Submit');
                    $('#modal_submit').prop("disabled", false);
                } else {
                    $('#registered_email').val('');
                    $('#modal_submit').text('Submit');
                    $('#modal_submit').prop("disabled", false);
                    toastr.error(res.message);
                }
            },
            error: function(xhr, status, error) {
                // Handle error if any
                console.error(xhr.responseText);
                toastr.error("An error occurred. Please try again.");
                $('#modal_submit').text('Submit');
                $('#modal_submit').prop("disabled", false);
            }
        });
    }
}

      
      
      $(function () {
        <?php if (session()->getFlashdata('success')) { ?>
          toastr.success("<?php echo session()->getFlashdata('success'); ?>")
        <?php } ?>
        <?php if (session()->getFlashdata('failed')) { ?>
          toastr.error('<?php echo session()->getFlashdata('failed'); ?>')
        <?php } ?>
      });
    </script>
  </body>
</html>