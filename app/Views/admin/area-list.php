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
<script>
    function getTotalRecordsData(qparam) {
        $.ajax({
            url: '<?= base_url(ADMINPATH . 'area-data'); ?>?' + qparam,
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
                "url": '<?= base_url(ADMINPATH . 'area-data'); ?>' + newQueryParam,
                "type": 'POST',
                dataSrc: (res) => {
                    return res.data
                }
            },
            "columns": [{ data: "sr_no", "name": "Sr.No", "title": "Sr.No" },
            { data: "id", "title": "Area Details","render":area_detail },
            { data: "state_name", "title": "State" },
            { data: "id",  "title": "Add Date","render":dates },
            { data: "id",  "title": "Status", "render": status_render },
           // { data: "id",  "title": "Action", "render": action_render }
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
var area_detail = ( data, type, row, meta )=>{
  var data = '';
  let city_name= row.city_name!=null?row.city_name:"";
  let area_name= row.area_name!=null?row.area_name:"";
  if(type === 'display'){
        data += '<span class="fotr_10"><b>Area : </b>'+area_name+'</span><br>' ;
        data += '<span class="fotr_10"><b>City : </b>'+city_name+'</span>' ;
  }
return data;
}

function status_render(data, type, row, meta) {
    if (type === 'display') {
        const isChecked = row.status === 'Active';
        const label = isChecked ? 'Active' : 'Inactive';
        const id = `tableswitch5${row.id}`;
        const onchange = `change_status(${row.id}, 'dt_area_list')`;

        const isPopular = row.is_popular === 'Yes';
    const labelPopular = isPopular ? 'Yes' : 'No';
    const idPopular = `tableswitch6${row.id}`; // Changed ID to make it unique
    const onChangePopular = `change_popular(${row.id}, 'dt_area_list')`; 

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

</script>