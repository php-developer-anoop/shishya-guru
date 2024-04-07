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
      <form action="<?=base_url(ADMINPATH.'wallet-history')?>" method="GET">
        <div class="row justify-content-center">
          <div class="form-group col-lg-2">
            <label for="from_date">From Date</label>
            <input type="date" name="from_date" id="from_date" onchange="validate_to()" class="form-control" max="" value="<?=!empty($from_date)?$from_date:''?>">
          </div>
          <div class="form-group col-lg-2">
            <label for="to_date">To Date</label>
            <input type="date" name="to_date" id="to_date" onchange="validate_from()" class="form-control"  max=""  value="<?=!empty($to_date)?$to_date:''?>">
          </div>
          <div class="form-group col-lg-2  mt-4 pt-2">
            <button type="submit" class="btn btn-primary" onclick="return validatefilter()">Submit</button>
            <a href="<?=base_url(ADMINPATH.'wallet-history')?>" class="btn btn-success">Reset</a>
          </div>
        </div>
      </form>
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
            url: '<?= base_url(ADMINPATH . 'wallet-data'); ?>?' + qparam,
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
                "url": '<?= base_url(ADMINPATH . 'wallet-data'); ?>' + newQueryParam,
                "type": 'POST',
                dataSrc: (res) => {
                    return res.data
                }
            },
            "columns": [{ data: "sr_no", "name": "Sr.No", "title": "Sr.No" },
            { data: "id", "title": "Credit/Debit","render":credit_debit_render },
            { data: "tutor_name",  "title": "User Name"},
            { data: "id",  "title": "Transaction Amount","render":amount_txn },
           // { data: "transaction_id",  "title": "Transaction Id" },
            { data: "created_date",  "title": "Created At" },
            { data: "remark",  "title": "Remark" },
          ],

            "rowReorder": { selector: 'td:nth-child(2)' },
            "responsive": false,
            "autoWidth": false,
            "destroy": true,
            "searchDelay": 1000,
            "searching": true,
            "pagingType": 'simple_numbers',
            "rowId": (a) => { return 'id_' + a.id; },
            "iDisplayLength": 10,
            "order": [3, "asc"],
        });
    }


var amount_txn = ( data, type, row, meta )=>{
  var data = '';
  let before_amount= row.before_amount!=null?row.before_amount:"";
  let txn_amount= row.txn_amount!=null?row.txn_amount:"";
  let final_amount= row.final_amount!=null?row.final_amount:"";
  if(type === 'display'){
        data += '<span class="fotr_10"><b>Before Amount : </b>'+before_amount+'</span><br>' ;
        data += '<span class="fotr_10"><b>Txn. Amount : </b>'+txn_amount+'</span><br>' ;
        data += '<span class="fotr_10"><b>Final  Amount : </b>'+final_amount+'</span>' ;
  }
return data;
}

     var credit_debit_render = ( data, type, row, meta )=>{
  var data = '';
  let credit_debit= row.credit_debit!=null?capitalizeFirstLetters(row.credit_debit):"";
  if(type === 'display'){
        data= '<span>'+credit_debit+'</span><br>' ;
  }
return data;
}

$(document).ready(function() {
    $('.first').on('change', function() {
        
        var startDateValue = $(this).val();
        $('.second').attr('min', startDateValue);
    });
    $('.second').on('change', function() {
       
        var startDateValue = $(this).val();
        $('.first').attr('min', startDateValue);
    });
});

function validatefilter(){
    var from_date=$('.first').val();
    var to_date=$('.second').val();
    
    if(to_date == "" && from_date == ""){
        toastr.error("Select From Date To Filter");
        return false;
    }
    else if(to_date != "" && from_date == ""){
        toastr.error("Select From Date");
        return false;
    }
    else if(to_date == "" && from_date != ""){
        toastr.error("Select To Date");
        return false;
    }
}

</script>