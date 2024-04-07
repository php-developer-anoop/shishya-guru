<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-12">
          <ol class="breadcrumb float-sm-left">
            <li class="breadcrumb-item"><a href="<?= base_url(ADMINPATH . 'dashboard') ?>">Home</a></li>
            <li class="breadcrumb-item active">
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
          <a href="<?= base_url(ADMINPATH . 'banner-list') ?>" class="btn btn-success m-auto"
            style="float:right;position:relative;">
          Banner List
          </a>
        </div>
        <div class="card-header">
          <?=form_open_multipart(base_url(ADMINPATH.'save-banner')); ?>
          <input type="hidden" name='id' value="<?=$id?>">
          <input type="hidden" name='old_jpg_image' value="<?=$banner_image_jpg?>">
          <input type="hidden" name='old_webp_image' value="<?=$banner_image_webp?>">
          <div class="row mt-2">
          <div class="col-sm-3">
              <?= form_label('Select State <span class="text-danger">*</span>', 'state_id', ['class' => 'col-form-label']) ?>
              <select name="state_id" id="state_id" required class="form-control select2" onchange="getCities(this.value, '<?= $city_id ?>')">
                <option value="">Select State</option>
                <?php if(!empty($state_list)){foreach($state_list as $skey=>$svalue){?>
                    <option value="<?=$svalue['id']?>" <?=!empty($state_id) && ($state_id==$svalue['id'])?'selected':''?>><?=$svalue['state_name']?></option>

                <?php }} ?>
              </select>
            </div>
            <div class="col-sm-3">
              <?= form_label('Select City(Multiple) <span class="text-danger">*</span>', 'city_id', ['class' => 'col-form-label']) ?>
              <select name="city_id[]" id="city_id" required class="form-control select2" multiple>
                <option value="" disabled>Select City</option>
                
              </select>
            </div>
            <div class="col-sm-3">
              <?= form_label('Slug <span class="text-danger">*</span>', 'slug', ['class' => 'col-form-label']) ?>
              <?= form_input(['name' => 'slug', 'required' => 'required','autocomplete'=>'off', 'placeholder' => 'Enter Slug', 'id' => 'slug', 'class' => 'form-control ','value'=>$slug]); ?>
            </div>
            <div class="col-sm-3">
            <label for="image" class="col-form-label">Image</label>
              <?= form_upload([
                'name' => 'image',
                'class' => 'form-control',
                'accept' => 'image/png, image/jpg, image/jpeg'
                ]); ?>
            </div>
            <div class="col-sm-3">
              <?= form_label('Banner Image Alt <span class="text-danger">*</span>', 'banner_image_alt', ['class' => 'col-form-label']) ?>
              <?= form_input(['name' => 'banner_image_alt','autocomplete'=>'off', 'placeholder' => 'Enter Banner Image Alt', 'id' => 'banner_image_alt', 'class' => 'form-control ucwords restrictedInput','value'=>$banner_image_alt]); ?>
            </div>
            <div class="col-sm-3">
              <?=form_label('Status','status',['class'=>'col-form-label'])?>
              <div class="row mt-2">
                <div class="col-4">
                  <div class="custom-control custom-checkbox">
                    <input class="custom-control-input status" name="status" <?= ($status == 'Active') ? 'checked' : '' ?> type="radio" id="checkStatus1" value="Active" checked>
                    <?=form_label('Active','checkStatus1',['class'=>'custom-control-label'])?>
                  </div>
                </div>
                <div class="col-4">
                  <div class="custom-control custom-checkbox">
                    <input class="custom-control-input status" name="status" <?= ($status == 'Inactive') ? 'checked' : '' ?> type="radio" id="checkStatus2" value="Inactive">
                    <?=form_label('Inactive','checkStatus2',['class'=>'custom-control-label'])?>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-sm-3"></div>
            <?php if (!empty($banner_image_jpg)) { ?>
            <div class="col-sm-3">
              <img src="<?= base_url('uploads/') . $banner_image_jpg; ?>" height=70px width=100px>
            </div>
            <?php } ?>
            </div>
            
            <div class="form-group row mt-2">
            <div class="col-sm-12">
              <div class="custom-btn-group">
              <button type="submit" id="submit" class="btn btn-success">Submit</button>
              </div>
            </div>
          </div>
          </div>
          <?=form_close(); ?>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
    <?php 
    if(!empty($city_id)){
    ?>
    getCities(<?= !empty($state_id) ? $state_id : "" ?>,'<?=$city_id?>');
    <?php 
    }
    ?>

    function getCities(id,city_id){
        
    $('#city_id').html('');
    $.ajax({
        url: '<?= base_url(ADMINPATH.'getCities') ?>',
        method: 'POST',
        data: { state_id: id ,city_id:city_id},
        success: function (response) {
            $('#city_id').html(response);
            
        }
    });
    }
</script>