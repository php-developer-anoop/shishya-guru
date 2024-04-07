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
          <a href="<?= base_url(ADMINPATH . 'class-list') ?>" class="btn btn-success m-auto"
            style="float:right;position:relative;">
          Class List
          </a>
        </div>
        <div class="card-header">
          <?=form_open(); ?>
          <input type="hidden" id='class_id' value="<?=$id?>">
          <div class="row mt-2">
            <div class="col-sm-3">
              <?= form_label('Select Class Group <span class="text-danger">*</span>', 'class_group_id', ['class' => 'col-form-label']) ?>
             <select name="class_group_id" id="class_group_id" class="form-control select2" required>
                <option value="">Select Class Group</option>
                <?php if(!empty($class_group_list)){foreach($class_group_list as $cglkey=>$cglvalue){?>
                    <option value="<?=$cglvalue['id']?>" <?=!empty($class_group_id) && ($class_group_id==$cglvalue['id'])?'selected':''?>><?=$cglvalue['class_group_name']?></option>
                <?php }} ?>
             </select>
            </div>
            <div class="col-sm-3">
              <?= form_label('Class Name <span class="text-danger">*</span>', 'class_name', ['class' => 'col-form-label']) ?>
              <?= form_input(['name' => 'class_name', 'required' => 'required','autocomplete'=>'off', 'placeholder' => 'Enter Class Name', 'id' => 'class_name', 'class' => 'form-control','value'=>$class_name]); ?>
            </div>
            <div class="col-sm-3">
              <?= form_label('Select Board (Multiple) <span class="text-danger">*</span>', 'board', ['class' => 'col-form-label']) ?>
             <select name="boards[]" id="boards" class="form-control select2" multiple required>
                <option value="" disabled>Select Board</option>
                <?php if(!empty($boards_list)){foreach($boards_list as $blkey=>$blvalue){?>
                    <option value="<?=$blvalue['id']?>" <?=!empty($boards) && in_array($blvalue['id'],$boards)?'selected':''?>><?=$blvalue['board_name']?></option>
                <?php }} ?>
             </select>
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
              <button type="button" id="submit" onclick="return validateClass()" class="btn btn-success">Submit</button>
              </div>
            </div>
          </div>
          </div>
          <?php echo form_close(); ?>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
    function validateClass() {
    var class_name = $('#class_name').val().trim();
    var class_id = $('#class_id').val().trim();
    var class_group_id = $('#class_group_id').val().trim();
    var boards = $('#boards').val();
    var status = $('.status:checked').val().trim();

    if (class_group_id === "") {
        toastr.error("Please Select Class Group");
        return false;
    } else if (class_name === "") {
        toastr.error("Please Enter Class Name");
        return false;
    } else if (boards === "") {
        toastr.error("Please Select Board");
        return false;
    }   else {
        Swal.fire({
            title: 'Are you sure?',
            text: 'You Want to Submit',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, submit it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?= base_url(ADMINPATH . 'save-class') ?>', // Replace this with the actual backend endpoint URL
                    type: 'POST',
                    data: {
                        'id': class_id,
                        'class_name': class_name,
                        'class_group_id':class_group_id,
                        'boards':boards,
                        'status': status
                    },
                    cache: false,
                    dataType: "json",
                    beforeSend: function () {
                        $('#submit').text('Please Wait...');
                        $('#submit').prop("disabled", true);
                    },
                    success: function (response) {
                        if (response.status === false) {
                            toastr.error(response.message);
                            $('#submit').text('Submit');
                            $('#submit').prop("disabled", false);
                        } else if (response.status === true) {
                            toastr.success(response.message);
                            setTimeout(function () {
                                window.location.href = response.url;
                            }, 500);
                        }
                    },
                    error: function (xhr, status, error) {
                        // Handle error if necessary
                        console.error(xhr, status, error);
                        Swal.fire("Error occurred. Please try again."); // Show a generic error message
                    }
                });
            }
        });
    }
}

</script>