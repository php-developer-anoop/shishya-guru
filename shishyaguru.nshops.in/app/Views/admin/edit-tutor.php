<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-12">
          <ol class="breadcrumb float-sm-left">
            <li class="breadcrumb-item"><a href="<?= base_url(ADMINPATH.'dashboard') ?>">Home</a></li>
            <li class="breadcrumb-item">
              <?= $menu ?>
            </li>
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
          <a href="<?= base_url(ADMINPATH.'tutor-list') ?>" class="btn btn-success m-auto"
            style="float:right;position:relative;">
          Tutor List
          </a>
        </div>
        <div class="card-header">
          <?= form_open_multipart(base_url(ADMINPATH.'save-tutor')); ?>
          <input type="hidden" name="old_profile_image" value="<?= !empty($profile_image) ? $profile_image : ''; ?>">
          <input type="hidden" name="old_aadhaar_front" value="<?= !empty($aadhaar_front) ? $aadhaar_front : ''; ?>">
          <input type="hidden" name="old_aadhaar_back" value="<?= !empty($aadhaar_back) ? $aadhaar_back : ''; ?>">
          <input type="hidden" name="id" value="<?= $id ?>">
          <div class="form-group row">
            <div class="col-sm-3">
              <label for="tutor_name" class="col-form-label">Tutor Name</label>
              <?= form_input(['name' => 'tutor_name', 'required' => 'required','autocomplete'=>'off', 'placeholder' => 'Enter Tutor Name', 'id' => 'tutor_name', 'class' => 'form-control restrictedInput', 'value' => $tutor_name]); ?>
            </div>
            <div class="col-sm-3">
              <label for="dob" class="col-form-label">DOB</label>
              <?= form_input(['type'=>'date','name' => 'dob', 'required' => 'required', 'id' => 'dob','autocomplete'=>'off', 'class' => 'form-control','value'=>$dob]); ?>
            </div>
            <div class="col-sm-3">
              <label for="mobile_no" class="col-form-label">Mobile</label>
              <?= form_input(['name' => 'mobile_no', 'required' => 'required','maxlength'=>'10','autocomplete'=>'off', 'placeholder' => 'Enter Mobile No.', 'id' => 'mobile_no', 'class' => 'form-control numbersWithZeroOnlyInput', 'value' => $mobile_no]); ?>
            </div>
            <div class="col-sm-3">
              <label for="email" class="col-form-label">Email</label>
              <?= form_input(['name' => 'email', 'required' => 'required','autocomplete'=>'off', 'placeholder' => 'Enter Email', 'id' => 'tutor_name', 'class' => 'form-control emailInput', 'value' => $email]); ?>
            </div>
            <div class="col-sm-3">
              <label for="gender" class="col-form-label">Gender</label>
              <select class="form-control select2" name="gender">
                <option value="" disabled>Select Option</option>
                <option value="Male" <?=!empty($gender) && ($gender=="Male")?"selected":""?>>Male</option>
                <option value="Female" <?=!empty($gender) && ($gender=="Female")?"selected":""?>>Female</option>
              </select>
            </div>
            <div class="col-sm-3">
              <label for="is_experienced" class="col-form-label">Is Experienced</label>
              <select class="form-control select2" name="is_experienced">
                <option value="" disabled>Select Option</option>
                <option value="Yes" <?=!empty($is_experienced) && ($is_experienced=="Yes")?"selected":""?>>Yes</option>
                <option value="No" <?=!empty($is_experienced) && ($is_experienced=="No")?"selected":""?>>No</option>
              </select>
            </div>
            <div class="col-sm-3">
              <label for="experience_years" class="col-form-label">Exp. (Yrs)</label>
              <?= form_input(['name' => 'experience_years','maxlength'=>'2','autocomplete'=>'off', 'placeholder' => 'Enter Experience', 'id' => 'experience_years', 'class' => 'form-control numbersWithZeroOnlyInput', 'value' => $experience_years]); ?>
            </div>
            <div class="col-sm-3">
              <label for="tuition_mode" class="col-form-label">Tuition Mode</label>
              <select class="form-control select2" name="tuition_mode">
                <option value="" disabled>Select Option</option>
                <option value="At Home" <?=!empty($tuition_mode) && ($tuition_mode=="At Home")?"selected":""?>>At Home</option>
                <option value="Online" <?=!empty($tuition_mode) && ($tuition_mode=="Online")?"selected":""?>>Online</option>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-sm-4" >
              <?= form_label('Select Board', 'board_id', ['class' => 'col-form-label']) ?>
              <select name="board_id[]"  required class="form-control select2" multiple>
                <option value="" disabled>Select Board</option>
                <?php if(!empty($board_list)){foreach($board_list as $bkey=>$bvalue){?>
                <option value="<?=$bvalue['id']?>" <?= !empty($board) && in_array($bvalue['id'], explode(',', $board)) ? 'selected' : '' ?>><?=$bvalue['board_name']?></option>
                <?php }} ?>
              </select>
            </div>
            <div class="col-sm-4">
              <?= form_label('Select Class ', 'class_id', ['class' => 'col-form-label']) ?>
              <select name="class_id[]" id="class_id"  required class="form-control  select2" multiple onchange="getSubject('subject_id','<?=!empty($subject)?$subject:''?>')">
                <option value="" disabled>Select Class</option>
                <?php if(!empty($class_list)){foreach($class_list as $clkey=>$clvalue){?>
                <option value="<?=$clvalue['id']?>" <?= !empty($class) && in_array($clvalue['id'], explode(',', $class)) ? 'selected' : '' ?>><?=$clvalue['class_name']?></option>
                <?php }} ?>
              </select>
            </div>
            <div class="col-sm-4">
              <?= form_label('Select Subject ', 'subject_id', ['class' => 'col-form-label']) ?>
              <select name="subject_id[]" id="subject_id"  required class="form-control select2" multiple>
                <option value="" disabled>Select Subject</option>
              </select>
            </div>
            <div class="col-sm-4">
              <?= form_label('Select Skills', 'class_id', ['class' => 'col-form-label']) ?>
              <select name="skills[]" id="skills"  required class="form-control select2" multiple>
                <option value="" disabled>Select Skills</option>
                <?php if(!empty($skill_list)){foreach($skill_list as $slkey=>$slvalue){?>
                <option value="<?=$slvalue['id']?>" <?= !empty($skill) && in_array($slvalue['id'], explode(',', $skill)) ? 'selected' : '' ?>><?=$slvalue['skill_name']?></option>
                <?php }} ?>
              </select>
            </div>
            <div class="col-sm-4">
              <?= form_label('Select Days', 'days', ['class' => 'col-form-label']) ?>
              <select name="days[]" id="days"  required class="form-control select2" multiple>
                <option value="" disabled>Select Days</option>
                <option value="Mon" <?= !empty($days) && in_array('Mon', explode(',', $days)) ? 'selected' : '' ?>>Mon</option>
                <option value="Tue" <?= !empty($days) && in_array('Tue', explode(',', $days)) ? 'selected' : '' ?>>Tue</option>
                <option value="Wed" <?= !empty($days) && in_array('Wed', explode(',', $days)) ? 'selected' : '' ?>>Wed</option>
                <option value="Thur" <?= !empty($days) && in_array('Thur', explode(',', $days)) ? 'selected' : '' ?>>Thur</option>
                <option value="Fri" <?= !empty($days) && in_array('Fri', explode(',', $days)) ? 'selected' : '' ?>>Fri</option>
                <option value="Sat" <?= !empty($days) && in_array('Sat', explode(',', $days)) ? 'selected' : '' ?>>Sat</option>
                <option value="Sun" <?= !empty($days) && in_array('Sun', explode(',', $days)) ? 'selected' : '' ?>>Sun</option>
              </select>
            </div>
            <div class="col-sm-4">
              <?= form_label('Select Qualification', 'qualification', ['class' => 'col-form-label']) ?>
              <select name="qualification" id="qualification" class="form-control select2" required>
                <option value="" disabled>Select Qualification</option>
                <?php if (!empty($qualification_list)) {
                  foreach ($qualification_list as $qkey => $qvalue) { ?>
                <option value="<?= $qvalue['id'] ?>" <?= !empty($qualification) && ($qualification == $qvalue['id']) ? 'selected' : '' ?>><?= $qvalue['qualification_name'] ?></option>
                <?php }
                  } ?>
              </select>
            </div>
            <div class="col-sm-4">
              <?= form_label('Select City ', 'city_id', ['class' => 'col-form-label']) ?>
              <select name="city_id" id="city_id" required class="form-control  select2">
                <option value="" disabled>Select City</option>
                <?php if (!empty($city_list)) {
                  foreach ($city_list as $ckey => $cvalue) { ?>
                <option value="<?= $cvalue['id'] ?>" <?= !empty($city) && ($city == $cvalue['id']) ? 'selected' : '' ?>><?= $cvalue['city_name'].' , '.$cvalue['state_name'] ?></option>
                <?php }
                  } ?>
              </select>
            </div>
            <div class="col-sm-4">
              <label for="address" class="col-form-label">Address</label>
              <?= form_input(['name' => 'address', 'required' => 'required',  'placeholder' => 'Enter Address','autocomplete'=>'off', 'id' => 'address', 'class' => 'form-control','value'=>$address]); ?>
            </div>
            <div class="col-sm-4">
              <label for="pincode" class="col-form-label">Pincode</label>
              <?= form_input(['name' => 'pincode', 'required' => 'required', 'maxlength'=>'6', 'placeholder' => 'Enter Pincode','autocomplete'=>'off', 'id' => 'pincode', 'class' => 'form-control numbersWithZeroOnlyInput','value'=>$pincode]); ?>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-sm-12">
              <label for="meta_title" class="col-form-label">Meta Title</label>
              <?= form_input(['name' => 'meta_title', 'required' => 'required', 'maxlength'=>'70', 'placeholder' => 'Enter Meta Title','autocomplete'=>'off', 'id' => 'meta_title', 'class' => 'form-control','value'=>$meta_title]); ?>
            </div>
            <div class="col-sm-12">
              <label for="meta_description" class="col-form-label">Meta Description</label>
              <?= form_input(['name' => 'meta_description', 'required' => 'required','maxlength'=>'160', 'placeholder' => 'Enter Meta Description','autocomplete'=>'off', 'id' => 'meta_description', 'class' => 'form-control','value'=>$meta_description]); ?>
            </div>
            <div class="col-sm-12">
              <label for="meta_keyword" class="col-form-label">Meta Keyword</label>
              <?= form_input(['name' => 'meta_keyword', 'required' => 'required', 'placeholder' => 'Enter Meta Keyword', 'id' => 'meta_keyword','autocomplete'=>'off', 'class' => 'form-control','value'=>$meta_keyword]); ?>
            </div>
            <div class="col-sm-12">
              <label for="about_heading" class="col-form-label">About Heading</label>
              <?= form_input(['name' => 'about_heading', 'required' => 'required', 'placeholder' => 'Enter About Heading', 'id' => 'about_heading','autocomplete'=>'off', 'class' => 'form-control','value'=>$about_heading]); ?>
            </div>
            <div class="col-sm-12">
              <label for="about_description" class="col-form-label">About Description</label>
              <textarea name="about_description" class="form-control" id="about_description"><?=$about_description?></textarea>
            </div>
            <div class="col-sm-3">
              <label for="tuition_fee" class="col-form-label">Monthly Fees</label>
              <?= form_input(['name' => 'tuition_fee', 'required' => 'required','maxlength'=>'5', 'placeholder' => 'Enter Monthly Fees', 'id' => 'tuition_fee','autocomplete'=>'off', 'class' => 'form-control numbersWithZeroOnlyInput','value'=>$monthly_fees]); ?>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-sm-4">
              <label for="image" class="col-form-label">Profile Image</label>
              <?= form_upload([
                'name' => 'profile_image',
                'class' => 'form-control',
                'accept' => 'image/png, image/jpg, image/jpeg'
                ]); ?>
            </div>
            <div class="col-sm-4">
              <label for="image" class="col-form-label">Aadhaar Front</label>
              <?= form_upload([
                'name' => 'aadhaar_front',
                'class' => 'form-control',
                'accept' => 'image/png, image/jpg, image/jpeg'
                ]); ?>
            </div>
            <div class="col-sm-4">
              <label for="image" class="col-form-label">Aadhaar Back</label>
              <?= form_upload([
                'name' => 'aadhaar_back',
                'class' => 'form-control',
                'accept' => 'image/png, image/jpg, image/jpeg'
                ]); ?>
            </div>
            <?php if (!empty($profile_image)) { ?>
            <div class="col-sm-4 mt-2">
              <a href="<?= base_url('uploads/') . $profile_image; ?>" target="_anoop"><img src="<?= base_url('uploads/') . $profile_image; ?>" height="100px" width=50%></a>
            </div>
            <?php } ?>
            <?php if (!empty($aadhaar_front)) { ?>
            <div class="col-sm-4 mt-2">
              <a href="<?= base_url('uploads/') . $aadhaar_front; ?>" target="_anoop"><img src="<?= base_url('uploads/') . $aadhaar_front; ?>" height="100px" width=50%></a>
            </div>
            <?php } ?>
            <?php if (!empty($aadhaar_back)) { ?>
            <div class="col-sm-4 mt-2">
              <a href="<?= base_url('uploads/') . $aadhaar_back; ?>" target="_anoop"><img src="<?= base_url('uploads/') . $aadhaar_back; ?>" height="100px" width=50%></a>
            </div>
            <?php } ?>
          </div>
          <div class="form-group row">
            <label for="answer" class="col-sm-2 col-form-label">Status</label>
            <div class="col-sm-6">
              <div class="row mt-2">
                <div class="col-3">
                  <div class="custom-control custom-checkbox">
                    <input class="custom-control-input" name="status" <?= ($status == 'Active') ? 'checked' : '' ?> type="radio" id="checkStatus1" value="Active" checked>
                    <label for="checkStatus1" class="custom-control-label">Active</label>
                  </div>
                </div>
                <div class="col-3">
                  <div class="custom-control custom-checkbox">
                    <input class="custom-control-input" name="status" <?= ($status == 'Inactive') ? 'checked' : '' ?> type="radio" id="checkStatus2" value="Inactive">
                    <label for="checkStatus2" class="custom-control-label">Inactive</label>
                  </div>
                </div>
                <div class="col-3">
                  <div class="custom-control custom-checkbox">
                    <input class="custom-control-input" name="status" <?= ($status == 'Blocked') ? 'checked' : '' ?> type="radio" id="checkStatus5" value="Blocked">
                    <label for="checkStatus5" class="custom-control-label">Blocked</label>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group row">
            <label for="answer" class="col-sm-2 col-form-label">KYC Status</label>
            <div class="col-sm-6">
              <div class="row mt-2">
                <div class="col-3">
                  <div class="custom-control custom-checkbox">
                    <input class="custom-control-input" name="kyc_status" <?= ($kyc_status == 'Pending') ? 'checked' : '' ?> type="radio" id="checkStatus3" value="Pending" checked>
                    <label for="checkStatus3" class="custom-control-label">Pending</label>
                  </div>
                </div>
                <div class="col-3">
                  <div class="custom-control custom-checkbox">
                    <input class="custom-control-input" name="kyc_status" <?= ($kyc_status == 'Approved') ? 'checked' : '' ?> type="radio" id="checkStatus4" value="Approved">
                    <label for="checkStatus4" class="custom-control-label">Approved</label>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group row mt-2">
            <div class="col-sm-12">
              <div class="custom-btn-group">
                <input type="submit" value="Submit" class="btn btn-success">
              </div>
            </div>
          </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
    CKEDITOR.replace('description');
    <?php 
    if(!empty($subject)){
    ?>
    getSubject('subject_id','<?=$subject?>');
    <?php 
    }
    ?>
  function getSubject(append_id,subject_id){
   
    $('#'+append_id).html('');
    var class_id = $('#class_id').val();
    // alert(class_id);
  
    $.ajax({
      url: '<?= base_url('getMultipleClassSubject') ?>',
      type: "POST",
      data: { class_id: class_id,subject_id:subject_id},
      cache: false,
      success: function (response) {
          //alert(response);
          $('#'+append_id).html(response);
      }
    });
  }
  
  $(document).ready(function() {
    // Define a function to handle the AJAX call
    function handleFeesChange() {
        $('#tuition_fee').html('');
        var city_id = $('#city_id').val();
        var class_id = $('#class_id').val();
        var tuition_fee = '<?= !empty($monthly_fees) ? $monthly_fees : "" ?>';

        $.ajax({
            url: '<?= base_url("getFees") ?>', // Assuming TUTORPATH is a PHP constant
            type: 'POST',
            data: {
                'city_id': city_id,
                'class_id': class_id,
                'tuition_fee': tuition_fee
            },
            cache: false,
            dataType: "html",
            success: function(response) {
                $('#tuition_fee').html(response);
            },
            error: function() {
                console.log('Error occurred during AJAX request');
            }
        });
    }

    // Call the function on page load
    handleFeesChange();

    // Bind the function to the change event of .getfees element
    $('.getfees').on('change', handleFeesChange);
});
</script>