<?=script_tag(base_url('assets/plugins/bootstrap/js/bootstrap.bundle.min.js'))."\n"?>
<?=script_tag(base_url('assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js'))."\n"?>
<?=script_tag('//cdn.jsdelivr.net/npm/sweetalert2@11')."\n"?>
<?=script_tag(base_url('assets/plugins/toastr/toastr.min.js'))."\n"?>
<?=script_tag(base_url('assets/common.js'))?>
<?=script_tag(base_url('assets/plugins/datatables/jquery.dataTables.min.js'))."\n"?>
<?=script_tag(base_url('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js'))."\n"?>
<?=script_tag(base_url('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js'))."\n"?>
<?=script_tag(base_url('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js'))."\n"?>
<?=script_tag(base_url('assets/plugins/datatables-buttons/js/dataTables.buttons.min.js'))."\n"?>
<?=script_tag(base_url('assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js'))."\n"?>

<?=script_tag('https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js')."\n"?>
<?=script_tag('https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/js/bootstrap-timepicker.min.js')."\n"?>
<?=script_tag(base_url('assets/plugins/select2/js/select2.full.min.js'))."\n"?>

<?=script_tag(base_url('assets/dist/js/adminlte.min.js'))."\n"?>
<script>
    <?php if (session()->getFlashdata('success')) { ?>
			setTimeout(function () {
				toastr.success('<?php echo session()->getFlashdata('success'); ?>')
			}, 1000);
		<?php } ?>
		<?php if (session()->getFlashdata('failed')) { ?>
			setTimeout(function () {
				toastr.error('<?php echo session()->getFlashdata('failed'); ?>.')
			}, 1000);
		<?php } ?>

// $(document).ready(function() {
//     const $element = $('#pushmenu');

//     if ($element.length > 0) {
//         $element.click();
//     }
// });

		function change_status(id, table) {
    $.ajax({
      url: '<?= base_url(ADMINPATH.'changeStatus') ?>',
      type: "POST",
      data: { 'id': id, 'table': table },
      cache: false,
      success: function (response) {
          $('#label_id'+id).html(response);
      }
    });
  }
  function change_popular(id, table) {
    $.ajax({
      url: '<?= base_url(ADMINPATH.'changePopular') ?>',
      type: "POST",
      data: { 'id': id, 'table': table },
      cache: false,
      success: function (response) {
          $('#popular_label'+id).html(response);
      }
    });
  }
  function getSlug(val,id){
        $.ajax({
      url: '<?= base_url(ADMINPATH.'getSlug') ?>',
      type: 'POST',
      data: {
        'keyword': val
      },
      cache: false,
      success: function (response) {
       $('#'+id).val(response);
      }
    });
    }  

  $(document).ready(function(){
    var maxFieldLimit = 10; //Input fields increment limitation
    var add_more_button = $('.add_button'); //Add button selector
    var Fieldwrapper = $('.input_field_wrapper'); //Input field wrapper
    var fieldHTML = '<div class="position-relative pb-5"><div class="form-group row mb-3"><label for="faq_question" class="col-sm-2 col-form-label">Question</label><div class="col-sm-10"><input type="text" class="form-control" id="faq_question" placeholder="Question" value="" name="faq_question[]" ></div></div><div class="form-group row mb-3"><label for="faq_answer" class="col-sm-2 col-form-label">Answer</label><div class="col-sm-10"><input type="text" class="form-control" id="faq_answer" placeholder="Answer" value="" name="faq_answer[]"></div></div><a href="javascript:void(0);" style="position:absolute;right:0" class="remove_button btn btn-danger btn-sm"  title="Remove field"><i class="fa fa-minus"></i></a></div>'; //New input field html 
    var x = 1; //Initial field counter is 1
    $(add_more_button).click(function(){ //Once add button is clicked
        if(x < maxFieldLimit){ //Check maximum number of input fields
            x++; //Increment field counter
            $(Fieldwrapper).append(fieldHTML); // Add field html
        }
    });
    $(Fieldwrapper).on('click', '.remove_button', function(e){ //Once remove button is clicked
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    });
});

function del_faq(a) {
    $.ajax({
      url: '<?= base_url(ADMINPATH.'delFaq') ?>',
      type: "POST",
      data: { 'id': a },
      cache: false,
      success: function (response) {
        $('#faq_' + a).remove(); 
        $('#bt_' + a).remove(); 
        toastr.success('Faq Deleted Successfully');
        setTimeout(function() {
             window.location.reload();
            },500);
      }
    });
}

 function deleteRecord(id, table) {
    $.ajax({
      url: '<?= base_url(ADMINPATH.'deleteRecord') ?>',
      type: "POST",
      data: { 'id': id, 'table': table },
      cache: false,
      
      success: function (response) {
          toastr.success('Data Deleted Successfully');
        $(document).ready(function () {
          let qparam = (new URL(location)).searchParams;
          getTotalRecordsData(qparam);
        });
          
      }
    });
  }
</script>