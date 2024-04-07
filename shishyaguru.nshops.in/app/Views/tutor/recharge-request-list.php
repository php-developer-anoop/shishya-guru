<main id="main" class="main">
  <div class="form-topclass d-block">
    <div class="pagetitle m-0 col-md-12">
      <p><i class="bi bi-folder"></i><span class="current"><a href="<?=($tutor['kyc_status']!="Approved")?'javascript:void(0)':base_url(TUTORPATH.'dashboard')?>">Dashboard</a></span> /
        Wallet 
      </p>
      <span class="dashobord-title d-flex justify-content-between">
        <h1><i class="bi bi-arrow-left-short toggle-sidebar-btn"></i>Recharge Request List<span class="profileName"></span>
        </h1>
        <span class="d-flex dashobord-title">
          <p></p>
        </span>
      </span>
    </div>
  </div>
  <section class="section dashboard">
    <div class="row">
      <div class="col-lg-12">
        <div class="row">
          <div class="col-xxl-12 col-md-12 col-lg-12">
            <div class="card sales-card bodyCard-bg px-2">
              <div class="filter card3 walletPage">
                <img src="<?=base_url('assets/tutor')?>/img/card-icon.png" class="img-fluid">
              </div>
            </div>
          </div>
          <div class="col-xxl-12 col-md-12 col-lg-12">
            <!--<h5 class="fw-bold">Recharge Request History</h5>-->
            <div class="card custum-overflow">
              <div class="tablemaincls mt-3" id="style-3">
                <input type="hidden" value="0" id="totalRecords" />
                <table id="responseData" class="display nowrap" style="width:100%">
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>
<script>
  function getTotalRecordsData(qparam) {
        $.ajax({
            url: '<?= base_url(TUTORPATH . 'recharge-request-data'); ?>?' + qparam,
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
       // alert(qparam);
        $('#responseData').html('');
        var newQueryParam = '?'+qparam + '&recordstotal=' + $('#totalRecords').val();
        $('#responseData').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": '<?= base_url(TUTORPATH . 'recharge-request-data'); ?>' + newQueryParam,
                "type": 'POST',
                dataSrc: (res) => {
                    return res.data
                }
            },
            "columns": [
            { data: "sr_no", "name": "Sr.No", "title": "Sr.No" },
            { data: "id", "title": "Tutor Details","render":tutor_details },
            { data: "id", "title": "Transaction Details","render":txn_details },
            { data: "id",  "title": "Dates","render":dates },
            { data: "id",  "title": "Status", "render": status_render },
           // { data: "id",  "title": "Action", "render": action_render },
            
          ],
             
            "rowReorder": { selector: 'td:nth-child(2)' },
            "responsive": false,
            "autoWidth": false,
            "destroy": true,
            "searchDelay": 500,
            "searching": true,
            "pagingType": 'simple_numbers',
            "rowId": (a) => { return 'id_' + a.id; },
            "iDisplayLength": 10,
            "order": [2, "asc"],
        });
    }
    
    
var tutor_details = ( data, type, row, meta )=>{
  var data = '';
  let tutor_name= row.tutor_name!=null?row.tutor_name:"";
  let tutor_unique_id= row.tutor_unique_id!=null?row.tutor_unique_id:"";
  if(type === 'display'){
        data += '<span class="fotr_10"><b>Tutor Name : </b>'+tutor_name+'</span><br>' ;
        data += '<span class="fotr_10"><b>Unique ID : </b>'+tutor_unique_id+'</span>' ;
      
  }
return data;
}

var txn_details = ( data, type, row, meta )=>{
  var data = '';
  let amount= row.amount!=null?row.amount:"";
  let txn_id= row.txn_id!=null?row.txn_id:"";
  if(type === 'display'){
        data += '<span class="fotr_10"><b>Amount : </b>'+amount+'</span><br>' ;
        data += '<span class="fotr_10"><b>Txn. Id : </b>'+txn_id+'</span>' ;
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
  function status_render(data, type, row, meta) {
       var data='';
    if (type === 'display') {
        data += '<span class="fotr_10" id="status_' + row.id + '">' + row.status + '</span>';
    }
    return data;
}
</script>