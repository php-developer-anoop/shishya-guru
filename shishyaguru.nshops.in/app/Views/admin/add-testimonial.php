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
          <a href="<?= base_url(ADMINPATH . 'testimonial-list') ?>" class="btn btn-success m-auto"
            style="float:right;position:relative;">
          Testimonial List
          </a>
        </div>
        <div class="card-header">
          <?=form_open_multipart(base_url(ADMINPATH.'save-testimonial')); ?>
          <input type="hidden" name='id' value="<?=$id?>">
          <!--<input type="hidden" name='old_jpg_image' value="<?php //$image_jpg?>">-->
          <!--<input type="hidden" name='old_webp_image' value="<?php //$image_webp?>">-->
          <div class="row mt-2">
          
            <div class="col-sm-3">
              <?= form_label('Name <span class="text-danger">*</span>', 'name', ['class' => 'col-form-label']) ?>
              <?= form_input(['name' => 'name', 'required' => 'required','autocomplete'=>'off', 'placeholder' => 'Name', 'id' => 'name', 'class' => 'form-control ucwords restrictedInput','value'=>$name]); ?>
            </div>
            <div class="col-sm-3">
              <?= form_label('Location <span class="text-danger">*</span>', 'location', ['class' => 'col-form-label']) ?>
              <?= form_input(['name' => 'location', 'required' => 'required','autocomplete'=>'off', 'placeholder' => 'Location', 'id' => 'location', 'class' => 'form-control','value'=>$location]); ?>
            </div>
           <div class="col-sm-3">
              <?= form_label('Tutor <span class="text-danger">*</span>', 'location', ['class' => 'col-form-label']) ?>
              <?= form_input(['name' => 'tutor', 'required' => 'required','autocomplete'=>'off', 'placeholder' => 'Tutor', 'id' => 'tutor', 'class' => 'form-control','value'=>$tutor]); ?>
            </div>
            <div class="col-sm-3">
            <?= form_label('Rating <span class="text-danger">*</span>', 'rating', ['class' => 'col-form-label']) ?>
            <select name="rating" id="rating" class="form-control select2">
              <option value="" disabled>Select Rating</option>
              <option value="1" <?=!empty($rating) && ($rating=='1')?'selected':''?>>1</option>
              <option value="2" <?=!empty($rating) && ($rating=='2')?'selected':''?>>2</option>
              <option value="3" <?=!empty($rating) && ($rating=='3')?'selected':''?>>3</option>
              <option value="4" <?=!empty($rating) && ($rating=='4')?'selected':''?>>4</option>
              <option value="5" <?=!empty($rating) && ($rating=='5')?'selected':''?>>5</option>
            </select>
            </div>
            <div class="col-sm-12">
              <label for="testimonial" class="col-form-label">Testimonial <span class="text-danger">*</span></label>
              <?= form_textarea(['name' => 'testimonial','rows'=>'3','required' => 'required','placeholder' => 'Enter Testimonial', 'id' => 'testimonial','autocomplete'=>'off', 'class' => 'form-control','value'=>$testimonial]); ?>
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
