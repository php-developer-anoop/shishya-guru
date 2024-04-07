<header id="header" class="header fixed-top d-flex align-items-center">
  <div class="container-fluid d-flex align-items-center justify-content-between  header-responsive responsive mx-3">
    <a href="<?=base_url()?>" class="logo d-flex align-items-center me-auto me-xl-0">
    <img src="<?=$logo?>" class="img-fluid" alt="<?=!empty($company['logo_alt'])?$company['logo_alt']:''?>">
    </a> 
    <div class="d-flex">
      <form  action="<?=base_url('tutor-list')?>" class="sign-up-form d-flex instudesec gap-1 mx-3 ">
        <span>
        <input type="text" autocomplete="off" class="form-control" value="<?=!empty($location)?$location:'';?>" name="city" id="header_city_value" placeholder="Enter City">
        <span id="appendHeaderCitySearch" class="commenHeaderSearch headercitysearch">
        </span>
        </span>
        <span class="mt-2 transler" onclick="return getCurrentCity()"><i class="bi bi-crosshair text-secondary"></i></span>
        <span>
        <input type="text" autocomplete="off" class="form-control <?=isset($url) && $url==''?'d-none':''?>" value="<?=!empty($subject_class_name)?$subject_class_name:'';?>"   id="header_search_value" placeholder="Enter Subject / Class">
        <input type="hidden" name="<?= (!empty($field_name)) ? $field_name :'' ?>" id="headertypesearch" value="<?= (!empty($field_value)) ? $field_value :'' ?>">
        <span id="appendHeaderSearch" class="commenHeaderSearch <?=isset($url) && $url==''?'d-none':''?>">
        </span>
        </span>
        <button type="submit" class="btn-getstarted search_btn" onclick="return validateHeaderSearch()">Search</button>
      </form>
      <div class="nav-sectionwithserchbar">
        <div class="d-flex">
          <nav id="navmenu" class="navmenu">
            <ul>
              <li class="d-none">
                <a class="btn-login mx-2"
                  href="javascript:void(0)">Log In</a>
              </li>
              <li>
                <a class="btn-getstarted mx-2" href="<?=!empty($company['care_mobile'])?'tel:+91'.$company['care_mobile']:'javascript:void(0)'?>"><?=!empty($company['care_mobile'])?'+91 '.$company['care_mobile']:''?></a>
              </li>
              <li>
                <a class="btn-getstarted mx-2 tutors-btn" 
                  href="<?=base_url('tutor-register')?>">Become a tutor</a>
              </li>
              <li>
                <a class="btn-getstarted  tutors-btn" 
                  href="<?=base_url('tutor/login')?>">Login as tutor</a>
              </li>
            </ul>
            <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
          </nav>
        </div>
      </div>
    </div>
  </div>
</header>
<script>
  function validateHeaderSearch() {
      var search_value = $('#header_search_value').val().trim();
      var search_city = $('#header_city_value').val().trim();
      if (search_value == "" && search_city == "") {
          toastr.error('Please type something to search');
          return false;
      }
      return true;
  }

$('#header_search_value').on('keyup', function() {
    var header_search_value = $('#header_search_value').val().trim();
    $('#appendHeaderSearch').html('');
    if (header_search_value != "") {
        $.ajax({
            url: "<?= base_url('getSubjectClass') ?>",
            type: "POST",
            data: {
                'search_value': header_search_value
            },
            cache: false,
            success: function(response) {
                $('#appendHeaderSearch').html(response);
            }
        });
    }
});

function gotoUrl(name, value) {
    if (value && typeof value === 'string') {
        $('#headertypesearch').attr('value', value);
        $('#headertypesearch').attr('name', name);
        $('#header_search_value').val(value);
        $('#appendHeaderSearch').html('');
    }
}

$(document).ready(function() {
  $('#header_city_value').on('keyup', function() {
    var header_city_value = $('#header_city_value').val().trim();
    $('#appendHeaderCitySearch').html('');
    if (header_city_value != "") {
      $.ajax({
        url: '<?= base_url('getCity') ?>',
        type: "POST",
        data: { 'keyword': header_city_value },
        cache: false,
        success: function(response) {
          $('#appendHeaderCitySearch').html(response);
        }
      });
    }
  });
});

  function gotoCity(url, value) {
    if (url && typeof url === 'string') {
        $.ajax({
            url:'<?= base_url('setCity') ?>', // Concatenate the URL with '/setCity'
            type: "POST",
            data: { 'city': value },
            cache: false,
            success: function (response) {
                getPopularLocality(null, value);
                $("#poplocation option").each(function () {
                    if ($(this).text() === value) { // Use $(this) instead of $('#poplocation')
                        $(this).prop("selected", true); // Set the selected property of the current option
                        return false; // Stop the loop once the desired option is found
                    }
                });
            }
        });
        $('#header_city_value').val(value); 
        $('#appendHeaderCitySearch').html('');
    }
}

</script>
<script>
function getCurrentCity() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(successCallback, errorCallback);
    } else {
        alert("Geolocation is not supported by this browser.");
    }
}

function successCallback(position) {
    var latitude = position.coords.latitude;
    var longitude = position.coords.longitude;

    // Send latitude and longitude to reverse geocoding API
    var geocodingApiUrl = 'https://maps.googleapis.com/maps/api/geocode/json?latlng=' + latitude + ',' + longitude + '&key=<?=GOOGLE_MAP_API_KEY?>';

    fetch(geocodingApiUrl)
        .then(response => response.json())
        .then(data => {
            // Parse the response to get the city name
            var addressComponents = data.results[0].address_components;
            var city = '';
            for (var i = 0; i < addressComponents.length; i++) {
                if (addressComponents[i].types.includes('locality')) {
                    city = addressComponents[i].long_name;
                    break;
                }
            }
            if (city !== '') {
                $.ajax({
                    url: "<?=base_url('setCity')?>",
                    type: "POST",
                    data: {
                        'city': city
                    },
                    cache: false,
                    success: function(response) {
                        getPopularLocality(null, city);
                        $("#poplocation option").each(function() {
                            if ($(this).text() === city) { // Use $(this) instead of $('#poplocation')
                                $(this).prop("selected", true); // Set the selected property of the current option
                                return false; // Stop the loop once the desired option is found
                            }
                        });
                    }
                });
                $('#header_city_value').val(city);

            } else {
                console.log('City not found.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
           // alert('Failed to get your current city.');
        });
}

function errorCallback(error) {
    console.error('Error getting location:', error);
    alert('Failed to get your current location.');
}

$(document).ready(function(){
    $.ajax({
            url: "<?=base_url('checkSessionSetCity')?>",
            type: "POSt",
            cache: false,
            success: function(response) {
                if(response=="false"){
                    getCurrentCity();
                    return false;
                }
               
            }
        });
});
</script>