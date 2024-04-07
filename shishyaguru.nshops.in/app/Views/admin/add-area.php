<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-12">
          <ol class="breadcrumb float-sm-left">
            <li class="breadcrumb-item"><a href="<?= base_url(ADMINPATH . 'dashboard') ?>">Home</a></li>
            <li class="breadcrumb-item active"><?= $menu ?></li>
            <li class="breadcrumb-item active"><?= $title ?></li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  <div class="content">
    <div class="container-fluid">
      <div class="card card-default">
        <div class="card-header">
          <a href="<?= base_url(ADMINPATH . 'area-list') ?>" class="btn btn-success m-auto" style="float:right;position:relative;">Area List</a>
        </div>
        <div class="card-body">
          <?= form_open(base_url(ADMINPATH.'save-area')); ?>
          <input type="hidden" name="state_id" id="state_id" value="<?= $state_id ?>">
          <input type="hidden" name="city_id" id="city_id" value="<?= $city_id ?>">
          <input type="hidden" name="id" id="id" value="<?= $id ?>">
          <div class="area_wrapper">
            <?php if(!empty($area_list)){
              $i=0;
              foreach($area_list as $key=>$value){
                $k=$key==0?'1':$key+1;
              ?>
            <div id="area_<?=$value['id']?>">
              <div class="row mt-2">
                <div class="col-sm-4">
                  <?= form_label('Area Name <span class="text-danger">*</span>', 'area_name', ['class' => 'col-form-label']) ?>
                  <?= form_input(['name' => 'area_name[]', 'required' => 'required', 'autocomplete' => 'off', 'placeholder' => 'Enter Area Name', 'id' => 'area_name', 'class' => 'form-control ucwords restrictedInput','value'=>$value['area_name']]); ?>
                </div>
                <div class="col-sm-3">
                  <?= form_label('Status', 'status', ['class' => 'col-form-label']) ?>
                  <div class="row mt-2">
                    <div class="col-6">
                      <div class="custom-control custom-checkbox">
                        <input class="custom-control-input status" name="status<?=$k?>[]" type="radio" id="checkStatus<?=$k?>" value="Active" <?=$value['status']=='Active'?'checked':''?>>
                        <?= form_label('Active', 'checkStatus'.$k, ['class' => 'custom-control-label']) ?>
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="custom-control custom-checkbox">
                        <input class="custom-control-input status" name="status<?=$k?>[]" type="radio" id="checkStatus<?=$k+1?>" value="Inactive" <?=$value['status']=='Inactive'?'checked':''?>>
                        <?= form_label('Inactive', 'checkStatus'.$k+1, ['class' => 'custom-control-label']) ?>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-sm-5">
                  <div class="d-flex justify-content-start align-items-end h-100 pb-1">
                    <?php if($i==0){ ?>
                    <a href="javascript:void(0);" class="add_area_button btn btn-success btn-sm" title="Add field"><i class="fa fa-plus"></i></a>
                    <?php } else { ?>
                    <a href="javascript:void(0);" class="btn btn-danger btn-sm" title="Remove field" id="bt_<?=$value['id']?>" onclick="del_area(<?=$value['id']?>)"><i class="fa fa-minus"></i></a>
                    <?php } ?>
                  </div>
                </div>
              </div>
            </div>
            <?php $i++; } } else { ?>
            <div class="row mt-2">
              <div class="col-sm-4">
                <?= form_label('Area Name <span class="text-danger">*</span>', 'area_name', ['class' => 'col-form-label']) ?>
                <?= form_input(['name' => 'area_name[]', 'required' => 'required', 'autocomplete' => 'off', 'placeholder' => 'Enter Area Name', 'id' => 'area_name', 'class' => 'form-control ucwords restrictedInput']); ?>
              </div>
              <div class="col-sm-3">
                <?= form_label('Status', 'status', ['class' => 'col-form-label']) ?>
                <div class="row mt-2">
                  <div class="col-6">
                    <div class="custom-control custom-checkbox">
                      <input class="custom-control-input status" name="status1[]" type="radio" id="checkStatus1" value="Active" checked>
                      <?= form_label('Active', 'checkStatus1', ['class' => 'custom-control-label']) ?>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="custom-control custom-checkbox">
                      <input class="custom-control-input status" name="status1[]" type="radio" id="checkStatus2" value="Inactive">
                      <?= form_label('Inactive', 'checkStatus2', ['class' => 'custom-control-label']) ?>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-5">
                <div class="d-flex justify-content-start align-items-end h-100 pb-1">
                  <a href="javascript:void(0);" class="add_area_button btn-sm btn btn-success" title="Add field"><i class="fa fa-plus"></i></a>
                </div>
              </div>
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
          <?= form_close(); ?>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
  
  $(document).ready(function () {
    const maxFieldLimit = 10;
    const addMoreButton = $('.add_area_button');
    const fieldWrapper = $('.area_wrapper');
    let fieldCounter = <?= count($area_list) ?: 1 ?>;
   
    $(document).on('click', '.add_area_button', function () { // Event delegation for adding fields
        if (fieldCounter < maxFieldLimit) {
            fieldCounter++;
            const fieldHTML = `
                <div class="flexer">
                    <div class="row mt-2">
                        <div class="col-sm-7">
                            <label for="area_name_${fieldCounter}">Area Name <span class="text-danger">*</span></label>
                            <input type="text" name="area_name[]" required="required" autocomplete="off" placeholder="Enter Area Name" id="area_name_${fieldCounter}" class="form-control ucwords restrictedInput">
                        </div>
                        <div class="col-sm-5 pr-0">
                            <label class="col-form-label">Status</label>
                            <div class="row mt-2 w-100">
                                <div class="col-6">
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input status" name="status${fieldCounter}[]" type="radio" id="checkStatus${fieldCounter}_1" value="Active" checked>
                                        <label class="custom-control-label" for="checkStatus${fieldCounter}_1">Active</label>
                                    </div>
                                </div>
                                <div class="col-6 pl-3">
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input status" name="status${fieldCounter}[]" type="radio" id="checkStatus${fieldCounter}_2" value="Inactive">
                                        <label class="custom-control-label" for="checkStatus${fieldCounter}_2">Inactive</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="javascript:void(0);" class="remove_area_button btn btn-danger btn-sm" title="Remove field"><i class="fa fa-minus"></i></a>
                </div>`;
            
            $(fieldWrapper).append(fieldHTML);
        }
    });

    $(fieldWrapper).on('click', '.remove_area_button', function (e) {
        e.preventDefault();
        $(this).parent('div').remove();
        fieldCounter--;
    });
});

function del_area(a) {
    $.ajax({
      url: '<?= base_url(ADMINPATH.'delArea') ?>',
      type: "POST",
      data: { 'id': a },
      cache: false,
      success: function (response) {
        $('#area_' + a).remove(); 
        $('#bt_' + a).remove(); 
        toastr.success('Area Deleted Successfully');
        setTimeout(function() {
             window.location.reload();
            },500);
      }
    });
}
</script>