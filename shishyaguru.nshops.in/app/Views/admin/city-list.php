<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-12">
          <ol class="breadcrumb float-sm-left">
            <li class="breadcrumb-item"><a href="<?= base_url(ADMINPATH . 'dashboard') ?>">Home</a></li>
            <li class="breadcrumb-item">
              <?= $menu; ?>
            </li>
            <li class="breadcrumb-item active">
              <?= $title; ?>
            </li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  <div class="content">
    <div class="container-fluid">
      <div class="card">
        <div class="card-body">
          <input type="hidden" value="0" id="totalRecords" />
          <table id="responseData" class="table table-bordered mb-0">
          </table>
        </div>
      </div>
      <br>
    </div>
  </div>
</div>
<div class="modal fade" id="modal-sm">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Upload Image</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?=form_open_multipart()?>
      <div class="modal-body">
        <input type="hidden" name="city_id" id="city_id" value="">
        <input type="hidden" name="old_image_jpg" id="old_image_jpg" value="">
        <input type="hidden" name="old_image_webp" id="old_image_webp" value="">
       <input type="file" name="city_image" onchange="return imageUpload(event)" id="city_image" accept="image/png,image/jpg,image/jpeg">
      </div>
      <p id="preview"></p>
      <?=form_close()?>
    </div>
  </div>
</div>
<script>
    function getTotalRecordsData(qparam) {
        $.ajax({
            url: '<?= base_url(ADMINPATH . 'city-data'); ?>?' + qparam,
            type: "POST",
            data: { 'is_count': 'yes', 'start': 0, 'length': 10 },
            cache: false,
            success: function (response) {
                $('#totalRecords').val(response);
                //if (response) {
                    loadAllRecordsData(qparam);
                //}
            }
        });
    }

    $(document).ready(function () {
        let qparam = (new URL(location)).searchParams;
        getTotalRecordsData(qparam);
    });

    function loadAllRecordsData(qparam) {
        $('#responseData').html('');
        var newQueryParam = '?'+qparam + '&recordstotal=' + $('#totalRecords').val();
        $('#responseData').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": '<?= base_url(ADMINPATH . 'city-data'); ?>' + newQueryParam,
                "type": 'POST',
                dataSrc: (res) => {
                    return res.data
                }
            },
            "columns": [{ data: "sr_no", "name": "Sr.No", "title": "Sr.No" },
            { data: "id", "title": "City Details","render":city_detail },
            { data: "id",  "title": "Add Date","render":dates },
            { data: "id",  "title": "Upload Image","render":img_upload },
            { data: "id",  "title": "Status", "render": status_render },
            { data: "id",  "title": "Add Area", "render": action_render },
            { data: "id",  "title": "Add FAQ", "render": add_faq_render },
          ],

            "rowReorder": { selector: 'td:nth-child(2)' },
            "responsive": false,
            "autoWidth": false,
            "destroy": true,
            "searchDelay": 2000,
            "searching": true,
            "pagingType": 'simple_numbers',
            "rowId": (a) => { return 'id_' + a.id; },
            "iDisplayLength": 10,
            "order": [3, "asc"],
        });
    }


var dates = ( data, type, row, meta )=>{
  var data = '';
  let add_date= row.add_date!=null?row.add_date:"";
  if(type === 'display'){
        data += '<span class="fotr_10"><b>Added On : </b>'+add_date+'</span>' ;
  }
return data;
}
var city_detail = ( data, type, row, meta )=>{
  var data = '';
  let state_name= row.state_name!=null?row.state_name:"";
  let city_name= row.city_name!=null?row.city_name:"";
  if(type === 'display'){
        data += '<span class="fotr_10"><b>City : </b>'+city_name+'</span><br>' ;
        data += '<span class="fotr_10"><b>State : </b>'+state_name+'</span>' ;
  }
return data;
}
var img_upload = (data, type, row, meta) => {
    var output = '';
    var img_url= row.img_url!=null?row.img_url:"";
    if (type === 'display') {
        output += '<span class="fotr_10"><button type="button" class="btn btn-success btn-sm"  onclick="appendCityId(' + row.id + ',\'' + row.jpg_image + '\',\'' + row.webp_image + '\',\'' + img_url + '\')" data-toggle="modal" data-target="#modal-sm"><i class="fa fa-upload"></i></button></span><br>';
    }
    return output;
};

function action_render(data, type, row, meta) {
    let output = '';
    if (type === 'display') {
       
        output= '<a href="<?= base_url(ADMINPATH . "add-area?city_id=") ?>' + row.id + '&state_id='+row.state_id+'" class="btn btn-primary btn-sm text-white " title="Add Area"><i class="fa fa-plus"></i></a> ';
    }
    return output;
}

function add_faq_render(data, type, row, meta) {
    let output = '';
    if (type === 'display') {
       
        output= '<a href="<?= base_url(ADMINPATH . "add-city-faq?city_id=") ?>' + row.id +'" class="btn btn-success btn-sm text-white " title="Add Area"><i class="fa fa-plus"></i></a> ';
    }
    return output;
}

   function status_render(data, type, row, meta) {
    if (type === 'display') {
        const isChecked = row.status === 'Active';
        const label = isChecked ? 'Active' : 'Inactive';
        const id = `tableswitch5${row.id}`;
        const onchange = `change_status(${row.id}, 'dt_city_list')`;

        const isPopular = row.is_popular === 'Yes';
    const labelPopular = isPopular ? 'Yes' : 'No';
    const idPopular = `tableswitch6${row.id}`; // Changed ID to make it unique
    const onChangePopular = `change_popular(${row.id}, 'dt_city_list')`; 

        return `<div class="d-flex flex-row">
    <b>Status : </b> 
        <div class="custom-control custom-switch form-switch gap-2">
                <input type="checkbox" onchange="${onchange}" ${isChecked ? 'checked' : ''} class="  custom-control-input form-check-input" id="${id}">
                <label class="custom-control-label" for="${id}" id="label_id${row.id}">${label}</label>
            </div></div>
            <div class="d-flex flex-row">
            <b>Is Popular : </b> 
            <div class="custom-control custom-switch form-switch gap-2">
                <input type="checkbox" onchange="${onChangePopular}" ${isPopular ? 'checked' : ''} class=" custom-control-input form-check-input" id="${idPopular}" role="switch">
                <label class="custom-control-label" for="${idPopular}" id="popular_label${row.id}">${labelPopular}</label>
            </div>
            </div>
            `;
    }
    return '';
}



  function appendCityId(city_id,old_image_jpg,old_image_webp,img_url){
    $('#city_id').val(city_id);
    $('#old_image_jpg').val(old_image_jpg);
    $('#old_image_webp').val(old_image_webp);
    $('#preview').html('<img src="' + img_url + '">');
  }

  function imageUpload(e) {
    var city_id = $('#city_id').val();
    var old_image_jpg = $('#old_image_jpg').val();
    var old_image_webp = $('#old_image_webp').val();

    var file = e.target.files[0];
    var formData = new FormData();
    formData.append('image', file);
    formData.append('city_id', city_id);
    formData.append('old_image_jpg', old_image_jpg);
    formData.append('old_image_webp', old_image_webp);

    // Display a preview of the selected image
    var reader = new FileReader();
    reader.onload = function (e) {
        $('#preview').html('<img src="' + e.target.result + '">');
    };
    reader.readAsDataURL(file);

    // Upload the image using AJAX
    $.ajax({
        url: '<?=base_url(ADMINPATH.'save-city-image')?>', // Change this to your upload script
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false, // Change to false to prevent jQuery from automatically setting the content type
        success: function (response) {
            // Handle success response
            toastr.success('Image Uploaded successfully');
        //   setTimeout(function() {
        //         window.location.reload();
        //     }, 1000);
        $('#city_image').val('');
        },
        error: function (xhr, status, error) {
            // Handle error response
            console.error('Upload error: ' + error);
        }
    });
}


</script>