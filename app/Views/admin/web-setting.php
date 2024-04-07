<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-12">
          <ol class="breadcrumb float-sm-left">
            <li class="breadcrumb-item"><a href="<?= base_url(ADMINPATH . 'dashboard') ?>">Home</a></li>
            <li class="breadcrumb-item active">
              <?= $title ?>
            </li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  <div class="content">
    <div class="container-fluid">
      <div class="card card-default">
        <div class="card-header">
          <?=form_open_multipart(ADMINPATH . 'save/websetting'); ?>
          <?=form_hidden('id',!empty($web['id'])?$web['id']:"")?>
          <?=form_hidden('old_logo_jpg',!empty($web['logo_jpg'])?$web['logo_jpg']:"")?>
          <?=form_hidden('old_logo_webp',!empty($web['logo_webp'])?$web['logo_webp']:"")?>
          <?=form_hidden('old_favicon',!empty($web['favicon'])?$web['favicon']:"")?>
          <?=form_hidden('old_qr_code',!empty($web['qr_code'])?$web['qr_code']:"")?>
          <div class="row">
            <div class="col-sm-3">
              <label for="company_name" class=" col-form-label">Company Name</label>
              <?= form_input(['name' => 'company_name', 'required' => 'required', 'placeholder' => 'Enter Company Name', 'id' => 'company_name', 'class' => 'form-control ucwords restrictedInput','autocomplete'=>'off','value'=>!empty($web['company_name']) ? $web['company_name']:'']); ?>
            </div>
            <div class="col-sm-3">
              <label for="care_mobile_no" class=" col-form-label">Care Mobile</label>
              <?= form_input(['name' => 'care_mobile_no', 'required' => 'required', 'placeholder' => 'Enter Care Mobile', 'id' => 'care_mobile_no','maxlength'=>'10','autocomplete'=>'off', 'class' => 'form-control notzero numbersWithZeroOnlyInput','value'=>!empty($web['care_mobile']) ? $web['care_mobile']:'']); ?>
            </div>
            <div class="col-sm-3">
              <label for="care_whatsapp_no" class=" col-form-label">Care Whatsapp No.</label>
              <?= form_input(['name' => 'care_whatsapp_no', 'required' => 'required', 'placeholder' => 'Enter Care Email', 'id' => 'care_whatsapp_no','maxlength'=>'10','autocomplete'=>'off', 'class' => 'form-control notzero numbersWithZeroOnlyInput','value'=>!empty($web['care_whatsapp_no']) ? $web['care_whatsapp_no']:'']); ?>
            </div>
            <div class="col-sm-3">
              <label for="care_email_id" class=" col-form-label">Care Email</label>
              <?= form_input(['name' => 'care_email_id', 'required' => 'required', 'placeholder' => 'Enter Care Email', 'id' => 'care_email_id', 'class' => 'form-control emailInput','autocomplete'=>'off','value'=>!empty($web['care_email']) ? $web['care_email']:'']); ?>
            </div>
            <div class="col-sm-3">
              <label for="facebook_link" class="col-form-label">Facebook Link</label>
              <?= form_input(['name' => 'facebook_link', 'required' => 'required', 'placeholder' => 'Enter Facebook Link', 'id' => 'facebook_link', 'class' => 'form-control','autocomplete'=>'off','value'=>!empty($web['facebook_link']) ? $web['facebook_link']:'']); ?>
            </div>
            <div class="col-sm-3">
              <label for="youtube_link" class="col-form-label">YouTube Link</label>
              <?= form_input(['name' => 'youtube_link', 'required' => 'required', 'placeholder' => 'Enter Youtube Link', 'id' => 'youtube_link', 'class' => 'form-control','autocomplete'=>'off','value'=>!empty($web['youtube_link']) ? $web['youtube_link']:'']); ?>
            </div>
            <div class="col-sm-3">
              <label for="instagram_link" class="col-form-label">Instagram Link</label> 
              <?= form_input(['name' => 'instagram_link', 'required' => 'required', 'placeholder' => 'Enter Instagram Link', 'id' => 'instagram_link', 'class' => 'form-control','autocomplete'=>'off','value'=>!empty($web['instagram_link']) ? $web['instagram_link']:'']); ?>
            </div>
            <div class="col-sm-3">
              <label for="twitter_link" class="col-form-label">Twitter Link</label>
              <?= form_input(['name' => 'twitter_link', 'required' => 'required', 'placeholder' => 'Enter Twitter Link', 'id' => 'twitter_link', 'class' => 'form-control','autocomplete'=>'off','value'=>!empty($web['twitter_x_link']) ? $web['twitter_x_link']:'']); ?>
            </div>
            <div class="col-sm-3">
              <label for="linkedin_link" class="col-form-label">Linkedin Link</label>
              <?= form_input(['name' => 'linkedin_link', 'required' => 'required', 'placeholder' => 'Enter Linkedin Link', 'id' => 'linkedin_link', 'class' => 'form-control','autocomplete'=>'off','value'=>!empty($web['linkedin_link']) ? $web['linkedin_link']:'']); ?>
            </div>
            <div class="col-sm-12">
              <label for="office_address" class="col-form-label">Full Address</label>
              <?= form_input(['name' => 'office_address', 'required' => 'required', 'placeholder' => 'Enter Full Address', 'id' => 'office_address', 'class' => 'form-control','autocomplete'=>'off','value'=>!empty($web['office_address']) ? $web['office_address']:'']); ?>
            </div>
            <div class="col-sm-12">
              <label for="map_script" class="col-form-label">Map Iframe</label>
              <?= form_input(['name' => 'map_script', 'required' => 'required', 'placeholder' => 'Enter Map Iframe', 'id' => 'map_script', 'class' => 'form-control','autocomplete'=>'off','value'=>!empty($web['map_script']) ? $web['map_script']:'']); ?>
            </div>
            <div class="col-sm-4">
              <label for="logo" class="col-form-label">Logo</label>
              <?= form_upload([
                'name'        => 'logo_img',
                'class'       => 'form-control',
                'accept'      => 'image/png, image/jpg, image/jpeg' 
                ]); ?>
            </div>
            <div class="col-sm-4">
              <label for="banner_image_alt" class="col-form-label">Logo Alt</label>
              <?= form_input([
                'name'        => 'logo_alt',
                'required'    => 'required',
                'placeholder' => 'Logo Alt',
                'id'          => 'logo_alt',
                'class'       => 'form-control',
                'autocomplete'=>'off',
                'value'       =>!empty($web['logo_alt']) ? $web['logo_alt']:''
                ]); ?>
            </div>
            <div class="col-sm-4">
              <label for="favicon" class="col-form-label">Favicon</label>
              <?= form_upload([
                'name'        => 'favicon_img',
                'class'       => 'form-control',
                'accept'      => 'image/png, image/jpg, image/jpeg' 
                ]); ?>
            </div>
            <?php if (!empty($web['logo_jpg'])) { ?>
            <div class="col-sm-4 mt-2">
              <img src="<?= base_url('uploads/') . $web['logo_jpg']; ?>" height="70px" width="50%" alt="Logo">
            </div>
            <?php } ?>
            <div class="col-sm-4">
            </div>
            <?php if (!empty($web['favicon'])) { ?>
            <div class="col-sm-4 mt-2">
              <img src="<?= base_url('uploads/') . $web['favicon'] ?>" height="70px" width="50%" alt="Image">
            </div>
            <?php } ?>
            <div class="col-sm-4">
              <label for="logo" class="col-form-label">QR Code</label>
              <?= form_upload([
                'name'        => 'qr_code',
                'class'       => 'form-control',
                'accept'      => 'image/png, image/jpg, image/jpeg' 
                ]); ?>
            </div>
            <?php if (!empty($web['qr_code'])) { ?>
            <div class="col-sm-4 mt-2">
              <img src="<?= base_url('uploads/') . $web['qr_code'] ?>" height="70px" width="50%" alt="Image">
            </div>
            <?php } ?>
            <div class="col-sm-4">
              <label for="upi_id" class="col-form-label">UPI ID</label>
              <?= form_input([
                'name'        => 'upi_id',
                'required'    => 'required',
                'placeholder' => 'UPI ID',
                'id'          => 'upi_id',
                'class'       => 'form-control',
                'autocomplete'=>'off',
                'value'       =>!empty($web['upi_id']) ? $web['upi_id']:''
                ]); ?>
            </div>
          </div>
          <div class="form-group row mt-2">
            <div class="col-sm-12">
              <div class="custom-btn-group">
                <input type="submit" value="Submit" class="btn btn-success">
              </div>
            </div>
          </div>
          <?php echo form_close(); ?>
        </div>
      </div>
    </div>
  </div>
</div>