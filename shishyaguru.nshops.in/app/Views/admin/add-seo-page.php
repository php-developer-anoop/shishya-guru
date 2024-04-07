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
          <a href="<?= base_url(ADMINPATH.'seo-page-list') ?>" class="btn btn-success m-auto"
            style="float:right;position:relative;">
          Seo Pages List
          </a>
        </div>
        <div class="card-header">
          <?= form_open_multipart(base_url(ADMINPATH.'save-seo-page')); ?>
          <input type="hidden" name="old_jpg_image" value="<?= !empty($banner_image_jpg) ? $banner_image_jpg : ''; ?>">
          <input type="hidden" name="old_webp_image" value="<?= !empty($banner_image_webp) ? $banner_image_webp : ''; ?>">
          <input type="hidden" name="id" value="<?= $id ?>">
          <div class="form-group row">
            <div class="col-sm-4" id="board_id">
              <?= form_label('Select Board <span class="text-danger">*</span>', 'board_id', ['class' => 'col-form-label']) ?>
              <select name="board_id"  required class="form-control select2">
                <option value="">Select Board</option>
                <?php if(!empty($board_list)){foreach($board_list as $bkey=>$bvalue){?>
                <option value="<?=$bvalue['id']?>" <?=!empty($board_id) && ($board_id==$bvalue['id'])?'selected':''?>><?=$bvalue['board_name']?></option>
                <?php }} ?>
              </select>
            </div>
            <div class="col-sm-4" id="class_id">
              <?= form_label('Select Class <span class="text-danger">*</span>', 'class_id', ['class' => 'col-form-label']) ?>
              <select name="class_id"  required class="form-control select2">
                <option value="">Select Class</option>
                <?php if(!empty($class_list)){foreach($class_list as $clkey=>$clvalue){?>
                <option value="<?=$clvalue['id']?>" <?=!empty($class_id) && ($class_id==$clvalue['id'])?'selected':''?>><?=$clvalue['class_name']?></option>
                <?php }} ?>
              </select>
            </div>
            <div class="col-sm-4" id="subject_id">
              <?= form_label('Select Subject <span class="text-danger">*</span>', 'subject_id', ['class' => 'col-form-label']) ?>
              <select name="subject_id"  required class="form-control select2">
                <option value="">Select Subject</option>
                <?php if(!empty($subject_list)){foreach($subject_list as $skey=>$svalue){?>
                <option value="<?=$svalue['id']?>" <?=!empty($subject_id) && ($subject_id==$svalue['id'])?'selected':''?>><?=$svalue['subject_name']?></option>
                <?php }} ?>
              </select>
            </div>
            <div class="col-sm-4">
              <?= form_label('Select State<span class="text-danger">*</span>', 'state_id', ['class' => 'col-form-label']) ?>
              <select name="state_id" id="state_id" class="form-control select2" required onchange="getCities(this.value, '<?= $city_id ?>')">
                <option value="">Select State</option>
                <?php if (!empty($state_list)) {
                  foreach ($state_list as $skey => $svalue) { ?>
                <option value="<?= $svalue['id'] ?>" <?= !empty($state_id) && ($state_id == $svalue['id']) ? 'selected' : '' ?>><?= $svalue['state_name'] ?></option>
                <?php }
                  } ?>
              </select>
            </div>
            <div class="col-sm-4">
              <?= form_label('Select City <span class="text-danger">*</span>', 'city_id', ['class' => 'col-form-label']) ?>
              <select name="city_id" id="city_id" required class="form-control select2">
                <option value="">Select City</option>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-sm-6">
              <label for="page_name" class="col-form-label">Page Name</label>
              <?= form_input(['name' => 'page_name', 'required' => 'required','onkeyup'=>"return getSlug(this.value,'slug')",'autocomplete'=>'off', 'placeholder' => 'Enter Page Name', 'id' => 'page_name', 'class' => 'form-control', 'value' => $page_name]); ?>
            </div>
            <div class="col-sm-6">
              <label for="slug" class="col-form-label">Slug</label>
              <?= form_input(['name' => 'slug', 'required' => 'required', 'placeholder' => 'Enter Slug', 'id' => 'slug','autocomplete'=>'off', 'class' => 'form-control','value'=>$slug]); ?>
            </div>
            <div class="col-sm-12">
              <label for="h1" class="col-form-label">H1 Heading</label>
              <?= form_input(['name' => 'h1', 'required' => 'required', 'placeholder' => 'Enter H1 Heading', 'id' => 'h1','autocomplete'=>'off', 'class' => 'form-control','value'=>$h1]); ?>
            </div>
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
              <label for="meta_schema" class="col-form-label">Meta Schema</label>
              <?= form_textarea(['name' => 'meta_schema', 'placeholder' => 'Enter Meta Schema','rows'=>'3', 'id' => 'meta_schema','autocomplete'=>'off','readonly'=>'readonly','class' => 'form-control','value'=>$meta_schema]); ?>
            </div>
            <div class="col-sm-12">
              <label for="description" class="col-form-label">Description</label>
              <textarea name="description" class="form-control" id="description"><?=$description?></textarea>
            </div>
            <div class="col-sm-12">
              <label for="faq_schema" class="col-form-label">FAQ Schema</label>
              <?= form_textarea(['name' => 'faq_schema','rows'=>'3','placeholder' => 'Enter FAQ Schema', 'id' => 'faq_schema','autocomplete'=>'off','readonly'=>'readonly', 'class' => 'form-control','value'=>$faq_schema]); ?>
            </div>
            <div class="col-sm-12">
              <label for="faq_heading" class="col-form-label">FAQ Heading</label>
              <?= form_input(['name' => 'faq_heading', 'required' => 'required', 'placeholder' => 'Enter FAQ Heading', 'id' => 'faq_heading','autocomplete'=>'off', 'class' => 'form-control','value'=>$faq_heading]); ?>
            </div>
          </div>
          <div class="input_field_wrapper">
            <?php if(!empty($faqs)){
              $i=1;
              foreach($faqs as $key=>$value){
              ?>
            <div id="faq_<?=$value['id']?>" class="position-relative pb-5">
              <div class="form-group row mb-3">
                <label for="faq_question" class="col-sm-2 col-form-label">Question</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="faq_question" placeholder="Question" value="<?=$value['question']?>" name="faq_question[]" >
                </div>
              </div>
              <div class="form-group row mb-3">
                <label for="faq_answer" class="col-sm-2 col-form-label">Answer</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="faq_answer" placeholder="Answer" value="<?=$value['answer']?>" name="faq_answer[]">
                </div>
              </div>
              <?php if($i==1){?>
              <a href="javascript:void(0);" class="add_button btn btn-success btn-sm" style="position:absolute;right:0" title="Add field"><i class="fa fa-plus"></i></a>
              <?php }else{?>
              <a href="javascript:void(0);" class="btn btn-danger btn-sm" style="position:absolute;right:0" title="Remove field" id="bt_<?=$value['id']?>" onclick="del_faq(<?=$value['id']?>)"><i class="fa fa-minus"></i></a>
              <?php } ?>
            </div>
            <?php $i++;} }else{ ?>
            <div class="position-relative pb-5">
              <div class="form-group row mb-3">
                <label for="faq_question" class="col-sm-2 col-form-label">Question</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="faq_question" placeholder="Question" value="" name="faq_question[]" >
                </div>
              </div>
              <div class="form-group row mb-3">
                <label for="faq_answer" class="col-sm-2 col-form-label">Answer</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="faq_answer" placeholder="Answer" value="" name="faq_answer[]">
                </div>
              </div>
              <a href="javascript:void(0);" class="add_button btn btn-success btn-sm" style="position:absolute;right:0" title="Add field"><i class="fa fa-plus"></i></a>
            </div>
            <?php } ?>
          </div>
          <div class="form-group row">
            <div class="col-sm-4">
              <label for="image" class="col-form-label">Image</label>
              <?= form_upload([
                'name' => 'banner_image',
                'class' => 'form-control',
                'accept' => 'image/png, image/jpg, image/jpeg'
                ]); ?>
            </div>
            <?php if (!empty($banner_image_jpg)) { ?>
            <div class="col-sm-3">
              <img src="<?= base_url('uploads/') . $banner_image_jpg; ?>" height=70px width=100px>
            </div>
            <?php } ?>
            <div class="col-sm-4">
              <label for="banner_image_alt" class="col-form-label">Banner Image Alt</label>
              <?= form_input(['name' => 'banner_image_alt', 'autocomplete'=>'off','required' => 'required', 'placeholder' => 'Enter Image Alt', 'id' => 'banner_image_alt', 'class' => 'form-control','value'=>$banner_image_alt]); ?>
            </div>
          </div>
          <div class="form-group row mt-2">
            <label for="answer" class="col-sm-2 col-form-label">Status</label>
            <div class="col-sm-6">
              <div class="row mt-2">
                <div class="col-2">
                  <div class="custom-control custom-checkbox">
                    <input class="custom-control-input" name="status" <?= ($status == 'Active') ? 'checked' : '' ?> type="radio" id="checkStatus1" value="Active" checked>
                    <label for="checkStatus1" class="custom-control-label">Active</label>
                  </div>
                </div>
                <div class="col-2">
                  <div class="custom-control custom-checkbox">
                    <input class="custom-control-input" name="status" <?= ($status == 'Inactive') ? 'checked' : '' ?> type="radio" id="checkStatus2" value="Inactive">
                    <label for="checkStatus2" class="custom-control-label">Inactive</label>
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