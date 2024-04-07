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
        <div class="card-header">
          <a href="<?= base_url(ADMINPATH . 'add-class') ?>" class="btn btn-success m-auto float-right">Add Class</a>
        </div>
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
            url: '<?= base_url(ADMINPATH . 'class-data'); ?>?' + qparam,
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
                "url": '<?= base_url(ADMINPATH . 'class-data'); ?>' + newQueryParam,
                "type": 'POST',
                dataSrc: (res) => {
                    return res.data
                }
            },
            "columns": [{ data: "sr_no", "name": "Sr.No", "title": "Sr.No" },
            { data: "id", "title": "Class Details","render":class_detail },
            { data: "id",  "title": "Dates","render":dates },
            { data: "is_seo_added",  "title": "Seo Page Added"},
            { data: "id",  "title": "Status", "render": status_render },
            { data: "id",  "title": "Action", "render": action_render },
            { data: "id",  "title": "Add / Edit Seo Page", "render": add_seo_render },
           
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

    var class_detail = ( data, type, row, meta )=>{
  var data = '';
  let class_name= row.class_name!=null?row.class_name:"";
  let class_group_name= row.class_group_name!=null?row.class_group_name:"";
  if(type === 'display'){
        data += '<span class="fotr_10"><b>Class Name : </b>'+class_name+'</span><br>' ;
        data += '<span class="fotr_10"><b>Class Group : </b>'+class_group_name+'</span>' ;
      
  }
return data;
}


var dates = ( data, type, row, meta )=>{
  var data = '';
  let add_date= row.add_date!=null?row.add_date:"";
  let upd_date= row.update_date!=null?row.update_date:"";
  if(type === 'display'){
        data += '<span class="fotr_10"><b>Added On : </b>'+add_date+'</span><br>' ;
        data += '<span class="fotr_10"><b>Updated On : </b>'+upd_date+'</span>' ;
      
  }
return data;
}

function action_render(data, type, row, meta) {
    let output = '';
    if (type === 'display') {
        output = '<a href="<?= base_url(ADMINPATH . "add-class?id=") ?>' + row.id + '" class="btn btn-success btn-sm text-white " title="Edit Class"><i class="fa fa-edit"></i></a> ';
        
    }
    return output;
}
function add_seo_render(data, type, row, meta) {
    let output = '';
    if (type === 'display') {
        var icon_class =  row.is_seo_added=='Yes'?"edit":"plus";
        output = '<a href="<?= base_url(ADMINPATH . "add-seo-template?table_id=") ?>' + row.id + '&table_name=dt_class_list" class="btn btn-primary btn-sm text-white " title="Add/Edit Seo Page"><i class="fa fa-'+icon_class+'"></i></a> ';
       
    }
    return output;
}
   function status_render(data, type, row, meta) {
    if (type === 'display') {
        const isChecked = row.status === 'Active';
        const label = isChecked ? 'Active' : 'Inactive';
        const id = `tableswitch5${row.id}`;
        const onchange = `change_status(${row.id}, 'dt_class_list')`;

        return `<div class="custom-control custom-switch">
                <input type="checkbox" onchange="${onchange}" ${isChecked ? 'checked' : ''} class="custom-control-input" id="${id}">
                <label class="custom-control-label" for="${id}" id="label_id${row.id}">${label}</label>
            </div> `;
    }
    return '';
}

</script>