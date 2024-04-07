
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
          <a href="<?= base_url(ADMINPATH . 'city-list') ?>" class="btn btn-success m-auto" style="float:right;position:relative;">City List</a>
        </div>
        <div class="card-body">
          <?= form_open_multipart(base_url(ADMINPATH.'save-city')); ?>
          <input type="hidden" name="state_id" id="state_id" value="<?= $state_id ?>">
          <input type="hidden" name="id" id="id" value="<?= $id ?>">
          <div class="city_wrapper">
  <?php if (!empty($city_list)) {
    $i = 0;
    foreach ($city_list as $key => $value) {
      $k = $key == 0 ? '1' : $key + 1;
  ?>
      <div id="city_<?= $value['id'] ?>">
        <div class="row mt-2">
          <div class="col-sm-3">
            <?= form_label('City Name <span class="text-danger">*</span>', 'city_name', ['class' => 'col-form-label']) ?>
            <?= form_input(['name' => 'city_name[]', 'required' => 'required', 'autocomplete' => 'off', 'placeholder' => 'Enter City Name', 'id' => 'city_name', 'class' => 'form-control ucwords restrictedInput', 'value' => $value['city_name']]); ?>
          </div>
          
          <div class="col-sm-3">
            <?= form_label('Status', 'status', ['class' => 'col-form-label']) ?>
            <div class="row mt-2">
              <div class="col-4">
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input status" name="status<?= $k ?>[]" type="radio" id="checkStatus<?= $k ?>_1" value="Active" <?= $value['status'] == 'Active' ? 'checked' : '' ?>>
                  <?= form_label('Active', 'checkStatus' . $k . '_1', ['class' => 'custom-control-label']) ?>
                </div>
              </div>
              <div class="col-4">
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input status" name="status<?= $k ?>[]" type="radio" id="checkStatus<?= $k ?>_2" value="Inactive" <?= $value['status'] == 'Inactive' ? 'checked' : '' ?>>
                  <?= form_label('Inactive', 'checkStatus' . $k . '_2', ['class' => 'custom-control-label']) ?>
                </div>
              </div>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="d-flex justify-content-start align-items-end h-100 pb-1">
              <?php if ($i == 0) { ?>
                <a href="javascript:void(0);" class="add_city_button btn btn-success btn-sm" title="Add field"><i class="fa fa-plus"></i></a>
              <?php } else { ?>
                <a href="javascript:void(0);" class="btn btn-danger btn-sm" title="Remove field" id="bt_<?= $value['id'] ?>" onclick="del_city(<?= $value['id'] ?>)"><i class="fa fa-minus"></i></a>
              <?php } ?>
            </div>
          </div>
          <?php if (!empty($value['jpg_image'])) { ?>
            <div class="col-sm-3">
              <img src="<?= base_url('uploads/') . $value['jpg_image'] ?>" height="70px" width="100px">
            </div>
          <?php } ?>
        </div>
      </div>
  <?php $i++;
    }
  } else { ?>
    <div class="row mt-2">
      <div class="col-sm-3">
        <?= form_label('City Name <span class="text-danger">*</span>', 'city_name', ['class' => 'col-form-label']) ?>
        <?= form_input(['name' => 'city_name[]', 'required' => 'required', 'autocomplete' => 'off', 'placeholder' => 'Enter City Name', 'id' => 'city_name', 'class' => 'form-control ucwords restrictedInput']); ?>
      </div>
      
      <div class="col-sm-3">
        <?= form_label('Status', 'status', ['class' => 'col-form-label']) ?>
        <div class="row mt-2">
          <div class="col-4">
            <div class="custom-control custom-checkbox">
              <input class="custom-control-input status" name="status1[]" type="radio" id="checkStatus1" value="Active" checked>
              <?= form_label('Active', 'checkStatus1', ['class' => 'custom-control-label']) ?>
            </div>
          </div>
          <div class="col-4">
            <div class="custom-control custom-checkbox">
              <input class="custom-control-input status" name="status1[]" type="radio" id="checkStatus2" value="Inactive">
              <?= form_label('Inactive', 'checkStatus2', ['class' => 'custom-control-label']) ?>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-3">
        <div class="d-flex justify-content-start align-items-end h-100 pb-1">
          <a href="javascript:void(0);" class="add_city_button btn-sm btn btn-success" title="Add field"><i class="fa fa-plus"></i></a>
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
    const addMoreButton = $('.add_city_button');
    const fieldWrapper = $('.city_wrapper');
    let fieldCounter = <?php echo count($city_list) ?: 1; ?>;
   
    $(document).on('click', '.add_city_button', function () { // Event delegation for adding fields
        if (fieldCounter < maxFieldLimit) {
            fieldCounter++;
            const fieldHTML = `
                <div class="flexer">
                    <div class="row mt-2 w-100 align-items-end">
                        <div class="col-sm-3">
                            <label for="city_name_${fieldCounter}" class="marginer">City Name <span class="text-danger">*</span></label>
                            <input type="text" name="city_name[]" required="required" autocomplete="off" placeholder="Enter City Name" id="city_name_${fieldCounter}" class="form-control ucwords restrictedInput">
                        </div>
                        
                        <div class="col-sm-3 ">
                            <label class="col-form-label">Status</label>
                            <div class="row mt-2 w-100">
                                <div class="col-4">
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input status" name="status${fieldCounter}[]" type="radio" id="checkStatus${fieldCounter}_1" value="Active" checked>
                                        <label class="custom-control-label" for="checkStatus${fieldCounter}_1">Active</label>
                                    </div>
                                </div>
                                <div class="col-4 pl-4">
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input status" name="status${fieldCounter}[]" type="radio" id="checkStatus${fieldCounter}_2" value="Inactive">
                                        <label class="custom-control-label" for="checkStatus${fieldCounter}_2">Inactive</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    <a href="javascript:void(0);" class="remove_city_button btn btn-danger btn-sm" title="Remove field"><i class="fa fa-minus"></i></a>
                
                    </div>
                     </div>`;
            
            $(fieldWrapper).append(fieldHTML);
        }
    });

    $(fieldWrapper).on('click', '.remove_city_button', function (e) {
        e.preventDefault();
        $(this).parent('div').remove();
        fieldCounter--;
    });
});



function del_city(a) {
    $.ajax({
      url: '<?= base_url(ADMINPATH.'delCity') ?>',
      type: "POST",
      data: { 'id': a },
      cache: false,
      success: function (response) {
        $('#city_' + a).remove(); 
        $('#bt_' + a).remove(); 
        toastr.success('City Deleted Successfully');
        setTimeout(function() {
             window.location.reload();
            },500);
      }
    });
}

</script>