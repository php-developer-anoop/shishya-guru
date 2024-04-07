<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title ?></title>
    <?=link_tag('https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback')."\n";?>
    <?=link_tag(base_url('assets/plugins/fontawesome-free/css/all.min.css'))."\n";?>
    <?=link_tag(base_url('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css'))."\n";?>
    <?=link_tag(base_url('assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css'))."\n";?>
    <?=link_tag(base_url('assets/plugins/toastr/toastr.min.css'))."\n";?>
    <?=link_tag(base_url('assets/dist/css/adminlte.min.css') )."\n";?>
    <style>
      .swal2-popup.swal2-toast .swal2-title {
      font-size: 15px;
      margin: 10px;
      color: #6c757d;
      }
    </style>
  </head>
  <body class="hold-transition login-page">
    <div class="login-box">
      <div class="card card-outline card-primary">
        <div class="card-header text-center">
          <?=anchor(base_url(ADMINPATH . 'login'),'Shishya Guru Admin Panel',['class'=>'h3'])?>
        </div>
        <div class="card-body">
          <h5 class="login-box-msg">Welcome Back</h5>
          <p class="login-box-msg">Log In to Access Your Account</p>
          <form>
            <div class="input-group mb-3">
              <input type="email" class="form-control" name="email" id="email" placeholder="Email" autocomplete="off">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-envelope"></span>
                </div>
              </div>
            </div>
            <div class="input-group mb-3">
              <input type="password" class="form-control" name="password" id="password" placeholder="Password"
                autocomplete="off">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-lock"></span>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-4"></div>
              <div class="col-4">
                <button type="button" id="submit" onclick="return validate()" class="btn btn-primary btn-block">Sign In</button>
              </div>
              <div class="col-4"></div>
            </div>
    </form>
        </div>
      </div>
    </div>
    <?=script_tag(base_url('assets/plugins/jquery/jquery.min.js'))?>
    <?=script_tag(base_url('assets/plugins/bootstrap/js/bootstrap.bundle.min.js'))?>
    <?=script_tag(base_url('assets/plugins/sweetalert2/sweetalert2.min.js'))?>
    <?=script_tag(base_url('assets/plugins/toastr/toastr.min.js'))?>
    <?=script_tag(base_url('assets/dist/js/adminlte.min.js'))?>
    <script>
      var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 1000
      });
      function validate() {
        var email = $('#email').val().trim();
        var password = $('#password').val().trim();
      
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
         url: '<?=base_url(ADMINPATH.'checkLogin')?>',
         data: {
           'email': email,
           'password': password,
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