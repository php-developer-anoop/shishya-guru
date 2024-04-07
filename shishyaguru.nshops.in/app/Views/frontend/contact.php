<main>
  <!-- ======= Contact Section ======= -->
  <section id="contact" class="contact">
    <div class="container">
      <div class="section-title">
        <h1><?=!empty($page['h1'])?$page['h1']:''?></h1>
        <p><?=!empty($page['description'])?$page['description']:''?></p>
      </div>
      <div class="row">
        <div class="col-lg-5  align-items-stretch">
          <div class="info">
            <div class="address">
              <i class="bi bi-geo-alt"></i>
              <h4>Location:</h4>
              <p><?=!empty($company['office_address'])?$company['office_address']:''?></p>
            </div>
            <div class="email">
              <i class="bi bi-envelope"></i>
              <h4>Email:</h4>
              <p><?=!empty($company['care_email'])?$company['care_email']:''?></p>
            </div>
            <div class="phone">
              <i class="bi bi-phone"></i>
              <h4>Call:</h4>
              <p><?=!empty($company['care_mobile'])?'+91 '.$company['care_mobile']:''?></p>
            </div>
            <div class="contactMap"><?=!empty($company['map_script'])?$company['map_script']:''?></div>
            
          </div>
        </div>
        <div class="col-lg-7 mt-5 mt-lg-0  align-items-stretch">
          <form class="php-email-form d-flex flex-column justify-content-center" id="contactForm">
              <?php $captua_token = random_alphanumeric_string(6); ?>
                <input type="hidden" id="csrf" class="csrf" name="csrf_token" value="<?= $captua_token ?>">
            <div class="row">
              <div class="form-group col-md-6">
                <label for="name">Your Name</label>
                <input type="text" name="name" autocomplete="off" class="form-control ucwords restrictedInput" id="name" required>
              </div>
              <div class="form-group col-md-6">
                <label for="name">Your Email</label>
                <input type="email" autocomplete="off" class="form-control emailInput" name="email" id="email" required>
              </div>
            </div>
            <div class="form-group">
              <label for="name">Subject</label>
              <input type="text" class="form-control" autocomplete="off" name="subject" id="subject" required>
            </div>
            <div class="form-group">
              <label for="name">Message</label>
              <textarea class="form-control" name="message" id="message" rows="5" required></textarea>
            </div>
            <div class="col-md-12 custom_class">
                <div class="row gy-3">
                    <div class="col-md-7 row align-items-end ">
                        <div class=" col-10">
                      <div class="bgreprat">
                        <?= $captua_token; ?> 
                      </div>
                      </div>
                      <div class="col-2 col-2 pb-1 px-1">
                        <span class="bgreprat-refesh ps-0" style="cursor:pointer;" onclick="getRandomCaptcha()"><img
                          src="<?= base_url('assets') ?>/refresh.png" class="w-100"></span>
                      </div>
                    </div>
                <div class="col-md-5">
                    <input type="text" name="match_captcha" maxlength="6" class="form-control" id="match_captcha"
                      autocomplete="off" placeholder="Enter Captcha" />
                  </div>
                   </div>
                   </div>
            <!--<div class="my-3">-->
            <!--  <div class="loading">Loading</div>-->
            <!--  <div class="error-message"></div>-->
            <!--  <div class="sent-message">Your message has been sent. Thank you!</div>-->
            <!--</div>-->
            <div class="text-center mt-3"><button type="submit" id="submit" onclick="return validateSubmit()">Submit</button></div>
          </form>
        </div>
      </div>
    </div>
  </section>
</main>
<script>
  function validateSubmit() {
    var name = $('#name').val().trim();
    var email = $('#email').val().trim();
    var subject = $('#subject').val().trim();
    var message = $('#message').val().trim();
    var csrf = $('#csrf').val().trim();
    var match_captcha = $('#match_captcha').val().trim();

    if (name === "") {
        toastr.error("Please Enter Name");
        return false;
    } else if (email === "") {
        toastr.error("Please Enter Email");
        return false;
    } else if (subject === "") {
        toastr.error("Please Enter Subject");
        return false;
    } else if (message === "") {
        toastr.error("Please Enter Message");
        return false;
    } else if (message.length < 50) {
        toastr.error("Message length must be more than 50 words");
        return false;
    } else if (match_captcha === "") {
        toastr.error("Please Enter Captcha");
        return false;
    } else if (match_captcha !== csrf) {
        toastr.error("Captcha Not Match");
        return false;
    } else {
        $.ajax({
            url: '<?= base_url('saveQuery') ?>',
            type: "POST",
            data: {
                name: name,
                email: email,
                subject: subject,
                message: message
            },
            cache: false,
            dataType: 'json',
            beforeSend: function () {
                $('#submit').text('Please wait....');
                $('#submit').prop('disabled', true); // Show loader before sending AJAX request
            },
            success: function (response) {
                if (response.status == true) {
                    toastr.success(response.message);
                    $('#submit').prop('disabled', false);
                    $('#submit').text('Submit');
                    $('#contactForm')[0].reset(); // Correct way to reset the form
                } else {
                    toastr.error(response.message);
                    $('#submit').prop('disabled', false);
                    $('#submit').text('Submit');
                }
            },
            error: function (xhr, status, error) {
                console.error('Error:', error);
            }
        });
    }
}

</script>