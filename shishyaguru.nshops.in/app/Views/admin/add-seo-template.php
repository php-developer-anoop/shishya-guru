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
          <?= form_open_multipart(base_url(ADMINPATH.'save-seo-template')); ?>
          <input type="hidden" name="old_image_jpg" value="<?= !empty($image_jpg) ? $image_jpg : ''; ?>">
          <input type="hidden" name="old_image_webp" value="<?= !empty($image_webp) ? $image_webp : ''; ?>">
          <input type="hidden" name="id" value="<?= $id ?>">
          <input type="hidden" name="table_id" value="<?= $table_id ?>">
          <input type="hidden" name="table_name" value="<?= $table_name ?>">
           
          <div class="form-group row">
            <div class="col-sm-6">
              <label for="display_name" class="col-form-label">Display Name</label>
              <?= form_input(['name' => 'display_name', 'required' => 'required','onkeyup'=>"return getSlug(this.value,'slug')",'autocomplete'=>'off', 'placeholder' => 'Enter Display Name', 'id' => 'display_name', 'class' => 'form-control', 'value' => $display_name]); ?>
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
              <label for="description" class="col-form-label">Description</label>
              <textarea name="description" class="form-control" id="description"><?=$description?></textarea>
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
            <div class="col-sm-3">
              <label for="image" class="col-form-label">Image</label>
              <?= form_upload([
                'name' => 'image',
                'class' => 'form-control',
                'accept' => 'image/png, image/jpg, image/jpeg'
                ]); ?>
            </div>
            <?php if (!empty($image_jpg)) { ?>
            <div class="col-sm-3">
              <img src="<?= base_url('uploads/') . $image_jpg; ?>" height=100% width=100%>
            </div>
            <?php } ?>
            <div class="col-sm-3">
              <label for="image_alt" class="col-form-label">Image Alt</label>
              <?= form_input(['name' => 'image_alt', 'autocomplete'=>'off','required' => 'required', 'placeholder' => 'Enter Image Alt', 'id' => 'image_alt', 'class' => 'form-control','value'=>$image_alt]); ?>
            </div>
            <div class="col-sm-3">
              <label for="posted_by" class="col-form-label">Posted By</label>
              <?= form_input(['name' => 'posted_by', 'autocomplete'=>'off','required' => 'required', 'placeholder' => 'Posted By', 'id' => 'posted_by', 'class' => 'form-control','value'=>$posted_by]); ?>
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
</script>