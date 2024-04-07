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
          <a href="<?= base_url(ADMINPATH . 'add-tuition-fee') ?>" class="btn btn-success m-auto float-right">Add Tuition Fee</a>
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
            url: '<?= base_url(ADMINPATH . 'tuition-fee-data'); ?>?' + qparam,
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
                "url": '<?= base_url(ADMINPATH . 'tuition-fee-data'); ?>' + newQueryParam,
                "type": 'POST',
                dataSrc: (res) => {
                    return res.data
                }
            },
            "columns": [{ data: "sr_no", "name": "Sr.No", "title": "Sr.No" },
            { data: "id", "title": "State/Class","render":state_class },
            { data: "id", "title": "Fee Detail","render":fee_detail },
            { data: "id",  "title": "Dates","render":dates },
            { data: "id",  "title": "Status", "render": status_render },
            { data: "id",  "title": "Action", "render": action_render }
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
  let upd_date= row.update_date!=null?row.update_date:"";
  if(type === 'display'){
        data += '<span class="fotr_10"><b>Added On : </b>'+add_date+'</span><br>' ;
        data += '<span class="fotr_10"><b>Updated On : </b>'+upd_date+'</span>' ;
      
  }
return data;
}

var state_class = ( data, type, row, meta )=>{
  var data = '';
  let state_name = row.state_name!=null?row.state_name:"";
  let class_name = row.class_name!=null?row.class_name:"";

  if(type === 'display'){
        data += '<span class="fotr_10"><b>State : </b>'+state_name+'</span><br>' ;
        data += '<span class="fotr_10"><b>Class : </b>'+class_name+'</span>' ;
      
  }
return data;
}

var fee_detail = ( data, type, row, meta )=>{
  var data = '';
  let fee_head = row.fee_head!=null?row.fee_head:"";
  let fee = row.fee!=null?row.fee:"";
  let duration = row.duration!=null?row.duration:"";

  if(type === 'display'){
        data += '<span class="fotr_10"><b>Fee Head : </b>'+fee_head+'</span><br>' ;
        data += '<span class="fotr_10"><b>Fee : </b>'+fee+'</span><br>' ;
        data += '<span class="fotr_10"><b>Duration : </b>'+duration+'</span>' ;
      
  }
return data;
}

function action_render(data, type, row, meta) {
    let output = '';
    if (type === 'display') {
        output = '<a href="<?= base_url(ADMINPATH . "add-tuition-fee?state_id=") ?>' + row.state_id + '&class_id='+row.class_id+'" class="btn btn-success btn-sm text-white " title="Edit Subject"><i class="fa fa-edit"></i></a> ';
    }
    return output;
}



   function status_render(data, type, row, meta) {
    if (type === 'display') {
        const isChecked = row.status === 'Active';
        const label = isChecked ? 'Active' : 'Inactive';
        const id = `tableswitch5${row.id}`;
        const onchange = `change_status(${row.id}, 'dt_tuition_fee_list')`;

        return `<div class="custom-control custom-switch">
                <input type="checkbox" onchange="${onchange}" ${isChecked ? 'checked' : ''} class="custom-control-input" id="${id}">
                <label class="custom-control-label" for="${id}" id="label_id${row.id}">${label}</label>
            </div> `;
    }
    return '';
}

</script>