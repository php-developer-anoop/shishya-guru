<main id="main" class="main">
  <div class="pagetitle">
    <p><i class="bi bi-folder"></i><span class="current"> <a href="<?=($tutor['kyc_status']!="Approved")?'javascript:void(0)':base_url(TUTORPATH.'dashboard')?>">Dashboard</a></span> / New Leads</p>
    <span class="dashobord-title">
    <h1>
      <i class="bi bi-arrow-left-short"></i>New Leads 
      <span class="profileName">
    </h1>
    </span>
  </div>
  <section class="section dashboard">
    <div class="row">
      <div class="col-lg-12">
        <div class="row">
          <div class="col-xxl-12 col-md-12 col-lg-12">
            <div class="card custum-overflow">
              <div class="tablemaincls mt-3" id="style-3">
                <input type="hidden" value="0" id="totalRecords" />
                <table id="responseData" class="display nowrap custumtable dataTable" style="width:100%">
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <span>
    <div class="modal fade mt-5" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel"
      aria-hidden="true">
      <div class="modal-dialog modal-sm">
        <div class="modal-content">
          <span class="text-end">
          <button type="button" class="btnclosebtn" data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-x"></i></button>
          </span>
          <div class="modal-body infficientBalance">
            <div class="border-0">
              <div class="card-body text-center">
                <div class=" py-3">
                  <img src="<?=base_url('assets/tutor/')?>/img/wallet2.png" class="img-fluid">
                </div>
                <h5>Insufficient Balance</h5>
                <!--<a href="">Add fund</a>-->
                <h6>Contact Admin : <?=!empty($company['care_mobile'])?'+91 '.$company['care_mobile']:''?></h6>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </span>
</main>
<script>
  function getTotalRecordsData(qparam) {
        $.ajax({
            url: '<?= base_url(TUTORPATH . 'leads-list-data'); ?>?' + qparam,
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
                "url": '<?= base_url(TUTORPATH . 'leads-list-data'); ?>' + newQueryParam,
                "type": 'POST',
                dataSrc: (res) => {
                    return res.data
                }
            },
            "columns": [
            { data: "id", "title": "Action","render":show_number },
            { data: "id", "title": "Subject","render":subject_name},
            { data: "id", "title": "Tuition Mode","render":tuition_mode },
            { data: "name", "title": "Student Name"},
            { data: "city_name", "title": "City"},
            { data: "board_name", "title": "Board"},
            { data: "class_name", "title": "Class"},
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
    
   var show_number = ( data, type, row, meta )=>{
  var data = '';
  let mobile_no= row.mobile_no!=null?row.mobile_no:"";
  if(type === 'display'){
        data += '<span class="shownumber" id="number'+row.id+'" onclick="return showNumber('+row.id+','+row.city_id+','+row.class_id+')">Show Number</span>';
  }
return data;
}    

    var tuition_mode = ( data, type, row, meta )=>{
  var data = '';
  let tuition_mode= row.tuition_mode!=null?row.tuition_mode:"";
  if(type === 'display'){
        data += '<span class="home-tution">'+tuition_mode+'</span><br>' ;
      
  }
return data;
}
  var subject_name = ( data, type, row, meta )=>{
  var data = '';
  let subject_name= row.subject_name!=null?row.subject_name:"";
  if(type === 'display'){
        data += '<span class="subject">'+subject_name+'</span><br>' ;
      
  }
return data;
}

function showNumber(lead_id, city_id, class_id) {
    $.ajax({
        type: 'POST',
        url: '<?= base_url(TUTORPATH.'showNumber')?>',
        data: {
            'city_id': city_id,
            'class_id': class_id,
            'lead_id': lead_id
        },
        dataType: 'json',
        beforeSend: function() {
            $('#number' + lead_id).text('Please Wait...');
            $('#number' + lead_id).attr("disabled");
        },
        success: function(res) {
            if (res.status === true) {
                $('#number' + lead_id).css({'background': '#ffffff', 'color': 'black'}).text(res.mobile_no);
            } else {
                $('#exampleModal2').modal('show');
                $('#number' + lead_id).text('Show Number');
            }
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
}

</script>