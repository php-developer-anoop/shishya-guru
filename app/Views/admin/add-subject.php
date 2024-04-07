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
          <a href="<?= base_url(ADMINPATH . 'subject-list') ?>" class="btn btn-success m-auto"
            style="float:right;position:relative;">
          Subject List
          </a>
        </div>
        <div class="card-header">
          <?=form_open_multipart(base_url(ADMINPATH.'save-subject')); ?>
          <input type="hidden" name='id' value="<?=$id?>">
          <input type="hidden" name='old_jpg_image' value="<?=$image_jpg?>">
          <input type="hidden" name='old_webp_image' value="<?=$image_webp?>">
          <div class="row mt-2">
          <div class="col-sm-3">
              <?= form_label('Select Class <span class="text-danger">*</span>', 'class_name', ['class' => 'col-form-label']) ?>
              <select name="class_id" id="class_id" required class="form-control select2">
                <option value="">Select Class</option>
                <?php if(!empty($class_list)){foreach($class_list as $clkey=>$clvalue){?>
                    <option value="<?=$clvalue['id']?>" <?=!empty($class_id) && ($class_id==$clvalue['id'])?'selected':''?>><?=$clvalue['class_name']?></option>

                <?php }} ?>
              </select>
            </div>
            <div class="col-sm-3">
              <?= form_label('Subject Name <span class="text-danger">*</span>', 'subject_name', ['class' => 'col-form-label']) ?>
              <?= form_input(['name' => 'subject_name', 'required' => 'required','autocomplete'=>'off', 'placeholder' => 'Enter Subject Name', 'id' => 'subject_name', 'class' => 'form-control ucwords restrictedInput','value'=>$subject_name]); ?>
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
              <?= form_label('Image Alt <span class="text-danger">*</span>', 'image_alt', ['class' => 'col-form-label']) ?>
              <?= form_input(['name' => 'image_alt','autocomplete'=>'off', 'placeholder' => 'Enter Image Alt', 'id' => 'image_alt', 'class' => 'form-control ucwords restrictedInput','value'=>$image_alt]); ?>
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
            <?php if (!empty($image_jpg)) { ?>
            <div class="col-sm-3">
              <img src="<?= base_url('uploads/') . $image_jpg; ?>" height=70px width=100px>
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
