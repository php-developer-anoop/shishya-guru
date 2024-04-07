<main id="main" class="main">
  <div class="form-topclass d-block">
    <div class="pagetitle">
      <p><i class="bi bi-folder"></i><span class="current"> <a href="<?=($tutor['kyc_status']!="Approved")?'javascript:void(0)':base_url(TUTORPATH.'dashboard')?>">Dashboard</a></span> / Profile</p>
      <span class="d-flex justify-content-between align-items-center">
      <span class="dashobord-title">
        <h1>
          <i class="bi bi-arrow-left-short toggle-sidebar-btn"></i>Profile
          <span class="profileName">
        </h1>
        </span>
        <?php if(!empty($tutor['kyc_status']) && ($tutor['profile_image']!="") && ($tutor['aadhaar_front']!="") && ($tutor['aadhaar_back']!="") && ($tutor['kyc_status']!="Approved")){?>
        <div class="alert alert-warning w-100" role="alert">
          "Thank you for submitting your KYC. Once your KYC is approved, we will notify you via email or sms".
        </div>
        <?php } ?>
        <?php if(!empty($tutor['kyc_status']) && ($tutor['kyc_status']!="Approved")){?>
        <span>
        <a href="javascript:void(0)" class="viewlist bg-warning text-dark blog-btn d-none" id="profile-btn" onclick="removeReadOnly()"><i
          class="bi bi-pencil-fill"></i> Edit
        Profile</a>
        </span>
        <?php } ?>
      </span>
    </div>
  </div>
  <section class="section dashboard">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body py-4 row">
          <div class="col-md-12 col-lg-12 row mx-auto">
            <div class="col-md-3 col-lg-3 mb-3">
              <div class="col-md-12 col-lg-12 mx-auto side-forminfo">
                <div class="tab tutortabs">
                  <input type="hidden" id="form_step_id" value="<?=$tutor['form_step']?>">
                  <button class="tablinks tutor-btn" <?=($tutor['form_step']>=1) || ($tutor['form_step']=='')?'':'disabled'?> id="personal" onclick="return formStep('<?=$tutor['form_step']?>','personal')">
                  <span class="icon">
                  <i class="bi bi-person-lines-fill"></i>
                  </span>
                  <span class="Information">
                  Personal Info<br />
                  <span class="tutors">Setup account details</span>
                  </span>
                  </button>
                  <button class="tablinks tutor-btn " <?=($tutor['form_step']>=2) || ($tutor['form_step']=='')?'':'disabled'?> id="education" onclick="return formStep('<?=$tutor['form_step']?>','education')">
                  <span class="icon">
                  <i class="bi bi-book"></i>
                  </span>
                  <span class="Information">
                  Education Detail<br />
                  <span class="tutors">Setup education details</span>
                  </span>
                  </button>
                  <button class="tablinks tutor-btn " <?=($tutor['form_step']>=3) || ($tutor['form_step']=='')?'':'disabled'?> id="tuition" onclick="return formStep('<?=$tutor['form_step']?>','tuition')">
                  <span class="icon">
                  <i class="bi bi-person-vcard-fill"></i>
                  </span>
                  <span class="Information">
                  Tuition Offered<br />
                  <span class="tutors">Add service details</span>
                  </span>
                  </button>
                  <button class="tablinks tutor-btn " <?=($tutor['form_step']>=4) || ($tutor['form_step']=='')?'':'disabled'?> id="additional" onclick="return formStep('<?=$tutor['form_step']?>','additional')">
                  <span class="icon">
                  <i class="bi bi-file-earmark-fill"></i>
                  </span>
                  <span class="Information">
                  Additional Information<br />
                  <span class="tutors">Additional Information</span>
                  </span>
                  </button>
                  <button class="tablinks tutor-btn " <?=($tutor['form_step']>=5) || ($tutor['form_step']=='')?'':'disabled'?> id="kyc" onclick="return formStep('<?=$tutor['form_step']?>','kyc')">
                  <span class="icon">
                  <i class="bi bi-card-image"></i>
                  </span>
                  <span class="Information">
                  Upload KYC Document<br />
                  <span class="tutors">Upload KYC document</span>
                  </span>
                  </button>
                </div>
              </div>
            </div>
            <div class="col-md-9 col-lg-9 mx-auto">
              <div id="form" class="tutorinfosec">
                <input type="hidden" id="tutor_id" value="<?=!empty($tutor['id'])?$tutor['id']:''?>">
                <div id="Personal" class="tabcontent">
                  <h3>Personal Information:</h3>
                  <div class="mb-3 row justify-content-between">
                    <div class="col-md-12 row justify-content-between">
                      <div class="col-md-6 custom_class firscls">
                        <fieldset>
                          <legend>Full name</legend>
                          <?php if(!empty($tutor['kyc_status']) && ($tutor['kyc_status']!="Approved")){?>
                          <input type="text" name="name"  class="form-control ucwords restrictedInput border_class" id="tutor_name"
                            placeholder="Enter full name" autocomplete="off"  value="<?=!empty($tutor['tutor_name'])?$tutor['tutor_name']:''?>"
                            required>
                          <?php }else{ ?>
                          <span><?=!empty($tutor['tutor_name'])?$tutor['tutor_name']:''?></span>
                          <?php } ?>
                        </fieldset>
                      </div>
                      <div class="col-md-6 custom_class firscls">
                        <fieldset>
                          <legend>Date of Birth</legend>
                          <?php if(!empty($tutor['kyc_status']) && ($tutor['kyc_status']!="Approved")){?>
                          <input type="date" name="date" class="form-control border_class" id="dob"
                            placeholder="DD/MM/YYYY" autocomplete="off"  max="<?=date('Y-m-d')?>" value="<?=!empty($tutor['dob'])?$tutor['dob']:''?>" required>
                          <?php }else{ ?>
                          <span><?=!empty($tutor['dob'])?date('d-m-Y',strtotime($tutor['dob'])):''?></span>
                          <?php } ?>
                        </fieldset>
                      </div>
                    </div>
                    <div class="col-md-6 ps-4">
                      <legend>Gender</legend>
                      <?php if(!empty($tutor['kyc_status']) && ($tutor['kyc_status']!="Approved")){?>
                      <div class="custom_class first_class">
                        <div class="form-check form-check-inline">
                          <input class="form-check-input tutor_gender" type="radio" name="gender" id="inlineRadio1" value="Male" <?= !empty($tutor['gender']) && $tutor['gender'] == 'Male' ? 'checked' : '' ?>>
                          <label class="form-check-label" for="inlineRadio1">Male</label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input class="form-check-input tutor_gender" type="radio" name="gender" id="inlineRadio2" value="Female" <?= !empty($tutor['gender']) && $tutor['gender'] == 'Female' ? 'checked' : '' ?>>
                          <label class="form-check-label" for="inlineRadio2">Female</label>
                        </div>
                      </div>
                      <?php }else{ ?>
                      <span> <?=!empty($tutor['gender'])?$tutor['gender']:''?></span>
                      <?php } ?>
                    </div>
                    <div class="col-md-12 mt-2 row justify-content-between">
                      <div class="col-md-6 custom_class">
                        <fieldset>
                          <legend>Email ID</legend>
                          <div class="d-flex justify-content-between w-100">
                            <?php if(!empty($tutor['kyc_status']) && ($tutor['kyc_status']!="Approved")){?>
                            <input type="email" class="form-control emailInput border_class" name="email" id="email"
                              placeholder="Eg. xyz@gmail.com" autocomplete="off" value="<?=!empty($tutor['email'])?$tutor['email']:''?>"
                              required>
                            <?php }else{ ?>
                            <span> <?=!empty($tutor['email'])?$tutor['email']:''?></span>
                            <?php } ?>
                            <span class="Verify-email position-static" style="line-height: 21px;">Verified</span>
                          </div>
                        </fieldset>
                      </div>
                      <div class="col-md-6 custom_class">
                        <fieldset>
                          <legend>Mobile number</legend>
                          <div class="d-flex justify-content-between w-100">
                            <?php if(!empty($tutor['kyc_status']) && ($tutor['kyc_status']!="Approved")){?>
                            <input type="text" class="form-control numbersWithZeroOnlyInput border_class" name="mobile_no" id="mobile_no"
                              placeholder="Eg. 9101110010" autocomplete="off" value="<?=!empty($tutor['mobile_no'])?$tutor['mobile_no']:''?>" required>
                            <?php }else{ ?>
                            <span> <?=!empty($tutor['mobile_no'])?$tutor['mobile_no']:''?></span>
                            <?php } ?>
                            <span class="Verify-mob position-static" style="line-height: 21px;">Verified</span>
                          </div>
                        </fieldset>
                      </div>
                    </div>
                    <div class="col-md-12 mt-2 row justify-content-between">
                      <div class="col-md-6 custom_class">
                        <fieldset>
                          <legend>Current Address</legend>
                          <?php if(!empty($tutor['kyc_status']) && ($tutor['kyc_status']!="Approved")){?>
                          <textarea class="form-control border_class p-0" rows="4" autocomplete="off" placeholder="Enter Full Address" id="address"
                            style="resize: none;"><?=!empty($tutor['address'])?$tutor['address']:''?></textarea>
                          <?php }else{ ?>
                          <span> <?=!empty($tutor['address'])?$tutor['address']:''?></span>
                          <div class="col-md-12 custom_class mt-3">
                            <legend>Pincode</legend>
                            <?=!empty($tutor['pincode'])?$tutor['pincode']:''?>
                          </div>
                          <?php } ?>
                        </fieldset>
                      </div>
                      <div class="col-md-6">
                        <div class=" custom_class">
                          <fieldset class="border_class">
                            <legend>City</legend>
                            <?php if(!empty($tutor['kyc_status']) && ($tutor['kyc_status']!="Approved")){?>
                            <select class="form-select  select2" aria-label="Default select example" required id="city">
                              <option value="">Select City</option>
                              <?php if(!empty($city_list)){foreach($city_list as $clkey=>$clvalue){?>
                              <option value="<?=$clvalue['id']?>" <?=!empty($tutor['city'])&&($tutor['city']==$clvalue['id'])?'selected':''?>><?=$clvalue['city_name'].' , '.$clvalue['state_name']?></option>
                              <?php }} ?>
                            </select>
                            <?php }else{ ?>
                            <span> <?=!empty($tutor['city'])?getCityStateName($tutor['city']):''?></span>
                            <?php } ?>
                          </fieldset>
                        </div>
                        <?php if(!empty($tutor['kyc_status']) && ($tutor['kyc_status']!="Approved")){?>
                        <div class="col-md-12 custom_class">
                          <fieldset>
                            <legend>Pincode</legend>
                            <input type="text" maxlength="6" class="form-control  border_class" name="pincode" id="pincode"
                              placeholder="226002"  autocomplete="off" value="<?=!empty($tutor['pincode'])?$tutor['pincode']:''?>" required>
                          </fieldset>
                        </div>
                        <?php } ?>
                      </div>
                    </div>
                    <?php if(!empty($tutor['kyc_status']) && ($tutor['kyc_status']!="Approved")){?>
                    <div class="profileButtonSec mt-4">
                      <button type="button" class="Forminfo-btn submitButton" id="submit1" onclick="return savePersonalInfo()">
                        Submit 
                        <div class="spinner-border spinner-border-sm text-white" id="loader1" role="status">
                          <span class="visually-hidden">Loading...</span>
                        </div>
                      </button>
                    </div>
                    <?php }else{ ?>
                    <div class="profileButtonSec mt-4">
                    <div class="col-md-6 col-sm-6 d-flex justify-content-end previous-btn">
                        <div class="col-md-12 col-lg-12 d-flex justify-content-end">
                          <a class="formPreviuous" href="javascript:void(0)" onclick="return nextFormStep('Education','education','Personal','personal')">
                          <span class="p-0">Next</span><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(185, 178, 178, 1);transform: ;msFilter:;"><path d="m11.293 17.293 1.414 1.414L19.414 12l-6.707-6.707-1.414 1.414L15.586 11H6v2h9.586z"></path></svg></a>
                        </div>
                      </div>
                      </div><?php } ?>
                  </div>
                </div>
                <div id="Education" class="tabcontent">
                  <h3>Education Information:</h3>
                  <div class="mb-3 row justify-content-between">
                    <div class="col-md-12 row justify-content-between">
                      <div class="col-md-6 custom_class">
                        <fieldset class="border_class px-0">
                          <legend>Highest Qualification</legend>
                          <?php if(!empty($tutor['kyc_status']) && ($tutor['kyc_status']!="Approved")){?>
                          <select class="form-select select2" aria-label="Default select example" id="qualification">
                            <option value="">Choose option</option>
                            <?php if(!empty($qualification_list)){foreach($qualification_list as $qlkey=>$qlvalue){?>
                            <option value="<?=$qlvalue['id']?>" <?=!empty($tutor['qualification'])&&($tutor['qualification']==$qlvalue['id'])?'selected':''?>><?=$qlvalue['qualification_name']?></option>
                            <?php }} ?>
                          </select>
                          <?php }else{ ?>
                          <span> <?=!empty($tutor['qualification'])?getQualificationName($tutor['qualification']):''?></span>
                          <?php } ?>
                        </fieldset>
                      </div>
                    </div>
                    <div class="col-md-12 my-4 row justify-content-between">
                      <?php if(!empty($tutor['kyc_status']) && ($tutor['kyc_status']!="Approved")){?>
                      <!--<h3>Skills (Multiple)</h3>-->
                      <div class="col-md-12 custom_class">
                        <fieldset class="border_class px-0">
                          <legend>Select Skills</legend>
                          <select class="form-select select2" name="skills[]" aria-label="Default select example" id="skill" multiple>
                            <option value="" disabled>Choose option</option>
                            <?php if (!empty($skill_list)) { 
                              foreach ($skill_list as $slkey => $slvalue) { ?>
                            <option value="<?= $slvalue['id'] ?>" <?= !empty($tutor['skill']) && in_array($slvalue['id'], explode(',', $tutor['skill'])) ? 'selected' : '' ?>>
                              <?= $slvalue['skill_name'] ?>
                            </option>
                            <?php }} ?>
                          </select>
                        </fieldset>
                      </div>
                      <?php }else{ ?>
                      <legend>Skills</legend>
                      <span> <?=!empty($tutor['skill'])?getMultipleSkill($tutor['skill']):''?></span>
                      <?php } ?>
                    </div>
                    <div class="col-md-12 col-lg-12">
                      <legend>Do you have any prior teaching experience :</legend>
                      <?php if(!empty($tutor['kyc_status']) && ($tutor['kyc_status']!="Approved")){?>
                      <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1" <?=!empty($tutor['is_experienced']) && ($tutor['is_experienced']=='Yes')?'checked':''?>>
                        <label class="form-check-label" for="exampleCheck1">Yes</label>
                      </div>
                      <?php }else{ ?>
                     
                      <span><?=!empty($tutor['is_experienced'])?($tutor['is_experienced']):''?></span>
                      <?php } ?>
                    </div>
                    <div class="col-md-12 mb-4 mt-2 row justify-content-between">
                      <?php if(!empty($tutor['kyc_status']) && ($tutor['kyc_status']!="Approved")){?>
                      <legend>Please mention how many years</legend>
                      <div class="col-md-2 custom_class">
                        <fieldset>
                          <legend>Years</legend>
                          <input type="text" class="form-control" name="experience_years" id="experience_years" value="<?=!empty($tutor['experience_years'])?$tutor['experience_years']:''?>" required>
                        </fieldset>
                      </div>
                      <?php }else{ ?>
                      <legend>Experience Years :</legend>
                      <span><?=!empty($tutor['experience_years'])?($tutor['experience_years']):''?></span>
                      <?php } ?>
                    </div>
                    
                    <div class="col-md-6 col-sm-6 d-flex justify-content-start previous-btn mt-4">
                        <div class="col-md-12 col-lg-12 d-flex justify-content-start">
                          <a class="formPreviuous" href="javascript:void(0)" onclick="return prevFormStep('Personal','personal','Education','education')">
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(185, 178, 178, 1);transform: rotate(180deg);msFilter:progid:DXImageTransform.Microsoft.BasicImage(rotation=2);"><path d="m11.293 17.293 1.414 1.414L19.414 12l-6.707-6.707-1.414 1.414L15.586 11H6v2h9.586z"></path></svg><span class="p-0">Previous</span></a>
                        </div>
                      </div>
                    <?php if(!empty($tutor['kyc_status']) && ($tutor['kyc_status']!="Approved")){?>
                      <div class="col-md-6 col-sm-6 d-flex justify-content-end previous-btn p-0">
                        <div class="col-md-12 col-lg-12 d-flex justify-content-end align-items-end">
                    <div class="profileButtonSec mt-4">
                      <button type="button" class="Forminfo-btn submitButton" id="submit2" onclick="return saveEducationInfo()">
                        Submit 
                        <div class="spinner-border spinner-border-sm text-white" id="loader2" role="status">
                          <span class="visually-hidden">Loading...</span>
                        </div>
                      </button>
                    </div></div></div>
                    <?php }else{ ?>
                    
                    <div class="col-md-6 col-sm-6 d-flex justify-content-end previous-btn p-0">
                        <div class="col-md-12 col-lg-12 d-flex justify-content-end align-items-end">
                          <a class="formPreviuous " href="javascript:void(0)" onclick="return nextFormStep('Tuition','tuition','Education','education')">
                          <span class="p-0">Next</span><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(185, 178, 178, 1);transform: ;msFilter:;"><path d="m11.293 17.293 1.414 1.414L19.414 12l-6.707-6.707-1.414 1.414L15.586 11H6v2h9.586z"></path></svg></a>
                        </div>
                      </div>
                       <?php } ?>
                  </div>
                </div>
                <div id="Tuition" class="tabcontent">
                  <h3>Tuition Offered:</h3>
                  <div class="mb-3 row justify-content-between">
                    <div class="col-md-12">
                      <legend>Interested for</legend>
                      <?php if(!empty($tutor['kyc_status']) && ($tutor['kyc_status']!="Approved")){?>
                      <div class="custom_class firscls">
                        <div class="form-check form-check-inline ">
                          <input class="form-check-input tuition_mode" name="tuition_mode" type="radio" value="At Home"
                            id="flexCheckDefault" <?=!empty($tutor['tuition_mode']) && ($tutor['tuition_mode']=='At Home')?'checked':''?>>
                          <label class="form-check-label" for="flexCheckDefault">
                          At home
                          </label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input class="form-check-input tuition_mode" name="tuition_mode" type="radio" value="Online"
                            id="flexCheckDefault" <?=!empty($tutor['tuition_mode']) && ($tutor['tuition_mode']=='Online')?'checked':''?>>
                          <label class="form-check-label" for="flexCheckDefault">
                          Online
                          </label>
                        </div>
                        <div class="form-check">
                        </div>
                      </div>
                      <?php }else{ ?>
                      <span> <?=!empty($tutor['tuition_mode'])?($tutor['tuition_mode']):''?></span>
                      <?php } ?>
                    </div>
                    <div class="col-md-12 mt-2 row justify-content-between">
                      <div class="col-md-6 custom_class">
                        <fieldset class="border_class px-0">
                          <legend>Education Board (Multiple)</legend>
                          <?php if(!empty($tutor['kyc_status']) && ($tutor['kyc_status']!="Approved")){?>
                          <select class="form-select select2" name="board[]" aria-label="Default select example" id="board" multiple>
                            <option value="" disabled>Choose option</option>
                            <?php if(!empty($board_list)) { 
                              foreach($board_list as $blkey => $blvalue) { ?>
                            <option value="<?= $blvalue['id'] ?>" <?= !empty($tutor['board']) && in_array($blvalue['id'], explode(',', $tutor['board'])) ? 'selected' : '' ?>>
                              <?= $blvalue['board_name'] ?>
                            </option>
                            <?php }} ?>
                          </select>
                          <?php }else{ ?>
                          <span> <?=!empty($tutor['board'])?getMultipleBoard($tutor['board']):''?></span>
                          <?php } ?>
                        </fieldset>
                      </div>
                      <div class="col-md-6 custom_class">
                        <fieldset class="border_class px-0">
                          <legend>Classes (Multiple)</legend>
                          <?php if(!empty($tutor['kyc_status']) && ($tutor['kyc_status']!="Approved")){?>
                          <select class="form-select  select2" aria-label="Default select example" id="class" multiple onchange="getSubject('subject','<?=!empty($tutor['subject'])?$tutor['subject']:''?>')">
                            <option value="" disabled>Choose option</option>
                            <?php if(!empty($class_list)){foreach($class_list as $ckey=>$cvalue){?>
                            <option value="<?=$cvalue['id']?>" <?= !empty($tutor['class']) && in_array($cvalue['id'], explode(',', $tutor['class'])) ? 'selected' : '' ?>><?=$cvalue['class_name']?></option>
                            <?php }} ?>
                          </select>
                          <?php }else{ ?>
                          <span> <?=!empty($tutor['class'])?getMultipleClass($tutor['class']):''?></span>
                          <?php } ?>
                        </fieldset>
                      </div>
                    </div>
                    <div class="col-md-12 mt-2 row justify-content-between">
                      <div class="col-md-6 custom_class ">
                        <fieldset class="border_class px-0">
                          <legend>Subjects (Multiple)</legend>
                          <?php if(!empty($tutor['kyc_status']) && ($tutor['kyc_status']!="Approved")){?>
                          <select class="form-select select2" aria-label="Default select example" id="subject" multiple>
                            <option value="">Choose option</option>
                          </select>
                          <?php }else{ ?>
                          <span> <?=!empty($tutor['subject'])?getMultipleSubject($tutor['subject']):''?></span>
                          <?php } ?>
                        </fieldset>
                      </div>
                      <div class="col-md-6 custom_class">
                        <fieldset class="<?=(!empty($tutor['kyc_status']) && ($tutor['kyc_status']!="Approved"))?"mt-4 pb-1 ":"px-0"  ?>">
                          <legend>Approx monthly fee</legend>
                          <?php if(!empty($tutor['kyc_status']) && ($tutor['kyc_status']!="Approved")){?>
                          <input type="text" class="form-control numbersWithZeroOnlyInput" autocomplete="off" value="<?=!empty($tutor['monthly_fees'])?(int)$tutor['monthly_fees']:''?>" id="tuition_fee" maxlength="5">
                          <?php }else{ ?>
                          <span> <?=!empty($tutor['monthly_fees'])?(int)($tutor['monthly_fees']):''?></span>
                          <?php } ?>
                        </fieldset>
                      </div>
                    </div>
                    <div class="col-md-6 col-sm-6 d-flex justify-content-start previous-btn mt-4">
                        <div class="col-md-12 col-lg-12 d-flex justify-content-start">
                          <a class="formPreviuous" href="javascript:void(0)" onclick="return prevFormStep('Education','education','Tuition','tuition')">
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(185, 178, 178, 1);transform: rotate(180deg);msFilter:progid:DXImageTransform.Microsoft.BasicImage(rotation=2);"><path d="m11.293 17.293 1.414 1.414L19.414 12l-6.707-6.707-1.414 1.414L15.586 11H6v2h9.586z"></path></svg><span class="p-0">Previous</span></a>
                        </div>
                      </div>
                    <?php if(!empty($tutor['kyc_status']) && ($tutor['kyc_status']!="Approved")){?>
                     <div class="col-md-6 col-sm-6 d-flex justify-content-end previous-btn p-0">
                        <div class="col-md-12 col-lg-12 d-flex justify-content-end align-items-end">
                    <div class="profileButtonSec mt-4">
                      <button type="button" class="Forminfo-btn submitButton" id="submit3" onclick="return saveTuitionInfo()">
                        Submit 
                        <div class="spinner-border spinner-border-sm text-white" id="loader3" role="status">
                          <span class="visually-hidden">Loading...</span>
                        </div>
                      </button>
                    </div>
                    </div>
                    </div>
                    <?php }else{ ?>
                    <div class="col-md-6 col-sm-6 d-flex justify-content-end previous-btn p-0">
                        <div class="col-md-12 col-lg-12 d-flex justify-content-end align-items-end">
                          <a class="formPreviuous " href="javascript:void(0)" onclick="return nextFormStep('Additional','additional','Tuition','tuition')">
                          <span class="p-0">Next</span><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(185, 178, 178, 1);transform: ;msFilter:;"><path d="m11.293 17.293 1.414 1.414L19.414 12l-6.707-6.707-1.414 1.414L15.586 11H6v2h9.586z"></path></svg></a>
                        </div>
                      </div><?php } ?>
                  </div>
                </div>
                <div id="Additional" class="tabcontent">
                  <div class="mb-3">
                    <h3 class="mb-3">About</h3>
                    <div class="col-md-12 custom_class firscls">
                      <fieldset class="<?=(!empty($tutor['kyc_status']) && ($tutor['kyc_status']!="Approved"))?"":"px-0"  ?>">
                        <legend>Heading</legend>
                        <?php if(!empty($tutor['kyc_status']) && ($tutor['kyc_status']!="Approved")){?>
                        <input type="text" name="name" class="form-control " id="about_heading"
                          placeholder="" autocomplete="off"  value="<?=!empty($tutor['about_heading'])?$tutor['about_heading']:''?>" required>
                        <?php }else{ ?>
                        <span> <?=!empty($tutor['about_heading'])?($tutor['about_heading']):''?></span>
                        <?php } ?>
                      </fieldset>
                    </div>
                  </div>
                  <div class="col-md-12 custom_class firscls mb-3">
                    <fieldset class="<?=(!empty($tutor['kyc_status']) && ($tutor['kyc_status']!="Approved"))?"":"px-0"  ?>">
                      <legend>Description</legend>
                      <?php if(!empty($tutor['kyc_status']) && ($tutor['kyc_status']!="Approved")){?>
                      <textarea class="form-control " autocomplete="off"   id="about_description" style="resize:none"><?=!empty($tutor['about_description'])?$tutor['about_description']:''?></textarea>
                      <?php }else{ ?>
                      <span> <?=!empty($tutor['about_description'])?($tutor['about_description']):''?></span>
                      <?php } ?>
                    </fieldset>
                  </div>
                  <h3>Quick Information</h3>
                  <div class="col-md-5 custom_class firscls mb-3 col-md-3 col-lg-3">
                    <fieldset class="border_class px-0">
                      <legend>Payment Mode (Multiple)</legend>
                      <?php if(!empty($tutor['kyc_status']) && ($tutor['kyc_status']!="Approved")){?>
                      <select class="form-select select2" name="payment_mode[]" aria-label="Default select example" id="payment_mode" multiple>
                        <option value="" disabled>Choose option</option>
                        <option value="UPI" <?= !empty($tutor['payment_mode']) && in_array("UPI", explode(',', $tutor['payment_mode'])) ? 'selected' : '' ?>>UPI</option>
                        <option value="Cash" <?= !empty($tutor['payment_mode']) && in_array("Cash", explode(',', $tutor['payment_mode'])) ? 'selected' : '' ?>>Cash</option>
                      </select>
                      <?php }else{ ?>
                      <span> <?=!empty($tutor['payment_mode'])?($tutor['payment_mode']):''?></span>
                      <?php } ?>
                    </fieldset>
                  </div>
                  <div class="col-md-10 mt-4">
                    <legend>Days</legend>
                    <?php if(!empty($tutor['kyc_status']) && ($tutor['kyc_status']!="Approved")){?>
                    <div class="d-flex flex-wrap calendartick justify-content-between">
                      <div class="form-check">
                        <input class="form-check-input days" type="checkbox" value="Mon"
                          id="flexCheckDefault" <?= in_array('Mon', explode(',', $tutor['days'])) ? 'checked' : '' ?> >
                        <label class="form-check-label" for="flexCheckDefault">
                        Mon
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input days" type="checkbox" value="Tue"
                          id="flexCheckDefault" <?= in_array('Tue', explode(',', $tutor['days'])) ? 'checked' : '' ?>>
                        <label class="form-check-label" for="flexCheckDefault">
                        Tue
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input days" type="checkbox" value="Wed"
                          id="flexCheckDefault" <?= in_array('Wed', explode(',', $tutor['days'])) ? 'checked' : '' ?>>
                        <label class="form-check-label" for="flexCheckDefault">
                        Wed
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input days" type="checkbox" value="Thur"
                          id="flexCheckDefault" <?= in_array('Thur', explode(',', $tutor['days'])) ? 'checked' : '' ?>>
                        <label class="form-check-label" for="flexCheckDefault">
                        Thur
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input days" type="checkbox" value="Fri"
                          id="flexCheckDefault" <?= in_array('Fri', explode(',', $tutor['days'])) ? 'checked' : '' ?>>
                        <label class="form-check-label" for="flexCheckDefault">
                        Fri
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input days" type="checkbox" value="Sat"
                          id="flexCheckDefault" <?= in_array('Sat', explode(',', $tutor['days'])) ? 'checked' : '' ?>>
                        <label class="form-check-label" for="flexCheckDefault">
                        Sat
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input days" type="checkbox" value="Sun"
                          id="flexCheckDefault" <?= in_array('Sun', explode(',', $tutor['days'])) ? 'checked' : '' ?>>
                        <label class="form-check-label" for="flexCheckDefault">
                        Sun
                        </label>
                      </div>
                    </div>
                    <?php }else{ ?>
                    <span> <?=!empty($tutor['days'])?($tutor['days']):''?></span>
                    <?php } ?>
                  </div>
                  <div class="Additionalclass mt-2 ">
                    <div class="Additionalinfo row">
                      <div class="d-flex flex-wrap calendartick d-none">
                        <?php if(!empty($tutor['payment_mode'])){?>
                        <div class="col-sm-6">
                          <span> Mode of Payment </span>
                          <p><?=$tutor['payment_mode']?></p>
                        </div>
                        <?php } ?>
                        <?php if(!empty($tutor['days'])){?>
                        <div class="col-sm-6">
                          <span> Days </span>
                          <p><?=$tutor['days']?></p>
                        </div>
                        <?php } ?>
                      </div>
                      <div class="col-md-6 col-sm-6 d-flex justify-content-start previous-btn mt-4">
                        <div class="col-md-12 col-lg-12 d-flex justify-content-start">
                          <a class="formPreviuous" href="javascript:void(0)" onclick="return prevFormStep('Tuition','tuition','Additional','additional')">
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(185, 178, 178, 1);transform: rotate(180deg);msFilter:progid:DXImageTransform.Microsoft.BasicImage(rotation=2);"><path d="m11.293 17.293 1.414 1.414L19.414 12l-6.707-6.707-1.414 1.414L15.586 11H6v2h9.586z"></path></svg><span class="p-0">Previous</span></a>
                        </div>
                      </div>
                      <?php if(!empty($tutor['kyc_status']) && ($tutor['kyc_status']!="Approved")){?>
                      <div class="col-md-6 col-sm-6 d-flex justify-content-end previous-btn p-0">
                        <div class="col-md-12 col-lg-12 d-flex justify-content-end align-items-end">
                      <div class="col-sm-12 profileButtonSec mt-4">
                        <button type="button" class="Forminfo-btn submitButton" id="submit4" onclick="return saveAdditionalInfo()">
                          Submit 
                          <div class="spinner-border spinner-border-sm text-white" id="loader4" role="status">
                            <span class="visually-hidden">Loading...</span>
                          </div>
                        </button>
                      </div></div></div>
                      <?php }else{ ?>
                    <div class="col-md-6 col-sm-6 d-flex justify-content-end previous-btn p-0">
                        <div class="col-md-12 col-lg-12 d-flex justify-content-end align-items-end">
                          <a class="formPreviuous " href="javascript:void(0)" onclick="return nextFormStep('Upload','kyc','Additional','additional')">
                          <span class="p-0">Next</span><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(185, 178, 178, 1);transform: ;msFilter:;"><path d="m11.293 17.293 1.414 1.414L19.414 12l-6.707-6.707-1.414 1.414L15.586 11H6v2h9.586z"></path></svg></a>
                        </div>
                      </div><?php } ?>
                    </div>
                  </div>
                </div>
                <div id="Upload" class="tabcontent">
                  <h3>Upload KYC Document</h3>
                  <div class="mb-3  mt-4 row justify-content-between">
                    <div class="col-md-12 ">
                      <div class="wrapper-section ">
                        <div class="col-md-12 mt-4 row">
                          <div class="col-md-6">
                            <h6>Uploaded Profile Pic</h6>
                            <div class="image-preview" id="imagePreview">
                              <?php if(!empty($tutor['profile_image'])){?>
                              <a href="<?=base_url('uploads/').$tutor['profile_image']?>" target="_anoop"><img src="<?=base_url('uploads/').$tutor['profile_image']?>" alt=""></a>
                              <?php } ?>
                            </div>
                          </div>
                          <div class="col-md-6 <?=($tutor['kyc_status']=="Approved")?'d-none':''?>">
                            <div class="my-3 uploadPic">
                              <h3>Upload Profile Pic</h3>
                              <fieldset>
                                <legend>Upload Image</legend>
                                <input type="file" class="file-browser file"
                                  id="fileInput" name="profile_image" onchange="return imageUpload(event,<?=!empty($tutor['id'])?$tutor['id']:''?>,'profile_image','<?=!empty($tutor['profile_image'])?$tutor['profile_image']:''?>')">
                              </fieldset>
                              <p class="lastlabel">Max file size 1 mb. JPG , JPEG or PNG</p>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-12 mt-4 row">
                          <div class="col-md-6">
                            <h6>Uploaded Aadhar Front</h6>
                            <div class="image-preview" id="imagePreview2">
                              <?php if(!empty($tutor['aadhaar_front'])){?>
                              <a href="<?=base_url('uploads/').$tutor['aadhaar_front']?>" target="_anoop"><img src="<?=base_url('uploads/').$tutor['aadhaar_front']?>" alt=""></a>
                              <?php } ?>
                            </div>
                          </div>
                          <div class="col-md-6 <?=($tutor['kyc_status']=="Approved")?'d-none':''?>">
                            <div class="my-3  uploadPic">
                              <h3>Upload Aadhar Front</h3>
                              <fieldset>
                                <legend>Upload Image</legend>
                                <input type="file" class="file-browser-2 file"
                                  id="fileInput2" name="aadhaar_front" onchange="return imageUpload(event,<?=!empty($tutor['id'])?$tutor['id']:''?>,'aadhaar_front','<?=!empty($tutor['aadhaar_front'])?$tutor['aadhaar_front']:''?>')">
                              </fieldset>
                              <p class="lastlabel">Max file size 1 mb. JPG , JPEG or PNG</p>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-12 mt-4 row">
                          <div class="col-md-6">
                            <h6>Uploaded Aadhar Back</h6>
                            <div class="image-preview" id="imagePreview3">
                              <?php if(!empty($tutor['aadhaar_back'])){?>
                              <a href="<?=base_url('uploads/').$tutor['aadhaar_back']?>" target="_anoop"><img src="<?=base_url('uploads/').$tutor['aadhaar_back']?>" alt=""></a>
                              <?php } ?>
                            </div>
                          </div>
                          <div class="col-md-6 <?=($tutor['kyc_status']=="Approved")?'d-none':''?>">
                            <div class="my-3  uploadPic">
                              <h3>Upload Profile Pic</h3>
                              <fieldset>
                                <legend>Upload Image</legend>
                                <input type="file" class="file-browser-3 file"
                                  id="fileInput3" name="aadhaar_back" onchange="return imageUpload(event,<?=!empty($tutor['id'])?$tutor['id']:''?>,'aadhaar_back','<?=!empty($tutor['aadhaar_back'])?$tutor['aadhaar_back']:''?>')">
                              </fieldset>
                              <p class="lastlabel">Max file size 1 mb. JPG , JPEG or PNG</p>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6 col-sm-6 d-flex justify-content-start previous-btn mt-4">
                        <div class="col-md-12 col-lg-12 d-flex justify-content-start">
                          <a class="formPreviuous" href="javascript:void(0)" onclick="return prevFormStep('Additional','additional','Upload','kyc')">
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(185, 178, 178, 1);transform: rotate(180deg);msFilter:progid:DXImageTransform.Microsoft.BasicImage(rotation=2);"><path d="m11.293 17.293 1.414 1.414L19.414 12l-6.707-6.707-1.414 1.414L15.586 11H6v2h9.586z"></path></svg><span class="p-0">Previous</span></a>
                        </div>
                      </div>
                    <div class="profileButtonSec mt-4 d-none">
                      <button type="button" class="Forminfo-btn submitButton">
                      Submit
                      </button>
                    </div>
                  </div>
                </div>
                
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    </div>
    </div>
  </section>
</main>
<span>
  <div class="modal fade mt-5" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-body">
          <div class="row justify-content-center">
            <div class="col-12 col-md-6 col-lg-4" style="min-width: 500px;">
              <div class="bg-white border-0">
                <div class="card-body text-center Otp-section">
                  <h4>Verify by OTP</h4>
                  <p>4 digit OTP sent to your abXXXX@gmail.com and 98XXXXXX123</p>
                  <div class="otp-field mb-4">
                    <input type="number" />
                    <input type="number" />
                    <input type="number" />
                    <input type="number" />
                  </div>
                  <button class="btn btn-varify-otp mb-3">
                  Verify
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</span>
<span>
  <div class="modal fade mt-5" id="exampleModal3" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-body">
          <div class="row justify-content-center">
            <div class="col-12 col-md-6 col-lg-4" style="min-width: 500px;">
              <div class="bg-white border-0">
                <div class="card-body text-center Otp-section">
                  <h4>Verify by OTP</h4>
                  <p>4 digit OTP sent to your abXXXX@gmail.com and 98XXXXXX123</p>
                  <div class="otp-field mb-4">
                    <input type="number" />
                    <input type="number" />
                    <input type="number" />
                    <input type="number" />
                  </div>
                  <button class="btn btn-varify-otp mb-3">
                  Verify
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</span>
<script>
  
  <?php 
    if(!empty($tutor['subject'])){
    ?>
    getSubject('subject','<?=$tutor['subject']?>');
    <?php 
    }
    ?>
  function getSubject(append_id,subject_id){
   
    $('#'+append_id).html('');
    var class_id = $('#class').val();
  
    $.ajax({
      url: '<?= base_url('getMultipleClassSubject') ?>',
      type: "POST",
      data: { 'class_id': class_id,subject_id:subject_id},
      cache: false,
      success: function (response) {
          $('#'+append_id).html(response);
      }
    });
  }

  function imageUpload(e, tutor_id, type, old_image) {
    var file = e.target.files[0];
    if (file) {
        var fileName = file.name;
        var fileExtension = fileName.split('.').pop().toLowerCase();
        var allowedExtensions = ['jpg', 'jpeg', 'png'];
        var maxSize = 1 * 1024 * 1024; 

        if ($.inArray(fileExtension, allowedExtensions) === -1) {
            toastr.error('Invalid file type! Please select a JPG, JPEG, PNG file.');
            $(e.target).val('');
            return;
        } else if (file.size > maxSize) {
            toastr.error('Please Select A File Less Than 1 Mb');
            $(e.target).val('');
            return;
        }
    } else {
        toastr.error('No file selected.');
        return;
    }

    var formData = new FormData();
    formData.append('image', file);
    formData.append('tutor_id', tutor_id);
    formData.append('type', type);
    formData.append('old_image', old_image);

    $.ajax({
        url: '<?= base_url(TUTORPATH.'save-kyc-image') ?>', // Ensure that base_url is properly defined
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
            toastr.success('Image Uploaded successfully');
           // window.location.reload();
        },
        error: function (xhr, status, error) {
            console.log('Upload error: ' + error);
        }
    });
}
$('#loader1').hide();
function savePersonalInfo(){
  var tutor_id=$('#tutor_id').val().trim();
  var name=$('#tutor_name').val().trim();
  var dob=$('#dob').val().trim();
  var gender=$('.tutor_gender:checked').val();
  var email=$('#email').val().trim();
  var mobile_no=$('#mobile_no').val().trim();
  var address=$('#address').val().trim();
  var city=$('#city').val().trim();
  var pincode=$('#pincode').val().trim();

  if (name === "") {
        toastr.error('Please Enter Name');
        return false;
    } else if (dob === "") {
        toastr.error('Please Select Date Of Birth');
        return false;
    } else if (gender === undefined) {
        toastr.error('Please Select Gender');
        return false;
    } else if (email === "") {
        toastr.error('Please Enter Email');
        return false;
    } else if (mobile_no === "") {
        toastr.error('Please Enter Mobile Number');
        return false;
    } else if (mobile_no.length != 10) {
        toastr.error('Please Enter A Valid 10 Digit Mobile Number');
        return false;
    } else if (address === "") {
        toastr.error('Please Enter Address');
        return false;
    } else if (city === "") {
        toastr.error('Please Select City');
        return false;
    } else if (pincode === "") {
        toastr.error('Please Enter Pincode');
        return false;
    } else {
      $.ajax({
            url: '<?= base_url(TUTORPATH.'save-personal-info') ?>',
            type: 'POST',
            data: {
                'tutor_id':tutor_id,
                'name': name,
                'mobile_no': mobile_no,
                'dob': dob,
                'address': address,
                'city': city, 
                'pincode': pincode,
                'email': email,
                'gender': gender
            },
            cache: false,
            dataType: "json",
            beforeSend: function () {
                $('#submit1').prop('disabled', true);
                $('#loader1').show();
            },
            success: function (response) {
                if (response.status === false) {
                    toastr.error(response.message);
                    $('#submit1').prop('disabled', false);
                $('#loader1').hide();
                } else if (response.status === true) {
                    toastr.success(response.message);
                    $('#submit1').prop('disabled', false);
                    $('#loader1').hide();
                    setTimeout(function() {
             window.location.reload();
             },1000);
                }
            },
            error: function () {
                console.log('Error occurred during AJAX request');
            }
        });
    }
}
$('#loader2').hide();
function saveEducationInfo(){
  var tutor_id=$('#tutor_id').val().trim();
  var qualification=$('#qualification').val().trim();
  var skill=$('#skill').val();

  var is_experienced=$('#exampleCheck1:checked').val();
  var experience_years=$('#experience_years').val().trim();
  
    if (qualification === "") {
        toastr.error('Please Select Qualification');
        return false;
    } else if (skill === "") {
        toastr.error('Please Select Skill');
        return false;
    }else if (is_experienced === undefined && experience_years !== "") {
        toastr.error('Please Tick Experience');
        return false;
    } else if (is_experienced !== undefined && experience_years === "") {
        toastr.error('Please Enter Years Of Experience');
        return false;
    } else {
      $.ajax({
            url: '<?= base_url(TUTORPATH.'save-education-info') ?>',
            type: 'POST',
            data: {
                'tutor_id':tutor_id,
                'qualification': qualification,
                'is_experienced': is_experienced,
                'experience_years': experience_years,
                'skill': skill
            },
            cache: false,
            dataType: "json",
            beforeSend: function () {
                $('#submit2').prop('disabled', true);
                $('#loader2').show();
            },
            success: function (response) {
                if (response.status === false) {
                    toastr.error(response.message);
                    $('#submit2').prop('disabled', false);
                    $('#loader2').hide();
                } else if (response.status === true) {
                    toastr.success(response.message);
                    $('#submit2').prop('disabled', false);
                    $('#loader2').hide();
                    setTimeout(function() {
             window.location.reload();
             },1000);
                }
            },
            error: function () {
                console.log('Error occurred during AJAX request');
            }
        });
    }
}

$('#loader3').hide();
function saveTuitionInfo(){
  var tutor_id=$('#tutor_id').val().trim();
  var tuition_mode=$('.tuition_mode:checked').val();

  var board=$('#board').val();
  var class_id=$('#class').val();
  var subject=$('#subject').val();
  var tuition_fee=$('#tuition_fee').val().trim();
  
  if (tuition_mode === undefined) {
        toastr.error('Please Select Tuition Mode');
        return false;
    } else if (board === "") {
        toastr.error('Please Select Board');
        return false;
    } else if (class_id === "") {
        toastr.error('Please Select class');
        return false;
    } else if (subject === "") {
        toastr.error('Please Select Subject');
        return false;
    } else if (tuition_fee === "") {
        toastr.error('Please Select Tuition Fee');
        return false;
    } else {
      $.ajax({
            url: '<?= base_url(TUTORPATH.'save-tuition-info') ?>',
            type: 'POST',
            data: {
                'tutor_id':tutor_id,
                'tuition_mode': tuition_mode,
                'class_id': class_id,
                'board': board,
                'subject': subject,
                'tuition_fee': tuition_fee,
            },
            cache: false,
            dataType: "json",
            beforeSend: function () {
                $('#submit2').prop('disabled', true);
                $('#loader2').show();
            },
            success: function (response) {
                if (response.status === false) {
                    toastr.error(response.message);
                    $('#submit2').prop('disabled', false);
                    $('#loader2').hide();
                } else if (response.status === true) {
                    toastr.success(response.message);
                    $('#submit2').prop('disabled', false);
                    $('#loader2').hide();
                    setTimeout(function() {
             window.location.reload();
             },1000);
                }
            },
            error: function () {
                console.log('Error occurred during AJAX request');
            }
        });
    }
}


$(document).ready(function() {
    // Define a function to handle the AJAX call
    function handleFeesChange() {
        $('#tuition_fee').html('');
        var city_id = $('#city').val();
        var class_id = $('#class').val();
        var tuition_fee = '<?= !empty($tutor['monthly_fees']) ? $tutor['monthly_fees'] : "" ?>';

        $.ajax({
            url: '<?= base_url("getFees") ?>', // Assuming TUTORPATH is a PHP constant
            type: 'POST',
            data: {
                'city_id': city_id,
                'class_id': class_id,
                'tuition_fee': tuition_fee
            },
            cache: false,
            dataType: "html",
            success: function(response) {
                $('#tuition_fee').html(response);
            },
            error: function() {
                console.log('Error occurred during AJAX request');
            }
        });
    }

    // Call the function on page load
    handleFeesChange();

    // Bind the function to the change event of .getfees element
    $('.getfees').on('change', handleFeesChange);
});
$('#loader4').hide();
function saveAdditionalInfo(){
  var tutor_id=$('#tutor_id').val().trim();
  var about_heading = $('#about_heading').val().trim();
  var about_description =$('#about_description').val().trim();
  var payment_mode =$('#payment_mode').val();
  var selectedValues = []; 

        $('.days').each(function() {
            if ($(this).is(':checked')) {
                selectedValues.push($(this).val());
            }
        });
var days = selectedValues.join(',');
if (about_heading === '') {
        toastr.error('Please Enter About Heading');
        return false;
    } else if (about_description === "") {
        toastr.error('Please Enter About Description');
        return false;
    } else if (payment_mode === "") {
        toastr.error('Please Select Payment Mode');
        return false;
    } else if (days === "") {
        toastr.error('Please Select Days');
        return false;
    } else {
      $.ajax({
            url: '<?= base_url(TUTORPATH.'save-additional-info') ?>',
            type: 'POST',
            data: {
                'tutor_id':tutor_id,
                'about_heading': about_heading,
                'about_description': about_description,
                'payment_mode': payment_mode,
                'days': days,
            },
            cache: false,
            dataType: "json",
            beforeSend: function () {
                $('#submit4').prop('disabled', true);
                $('#loader4').show();
            },
            success: function (response) {
                if (response.status === false) {
                    toastr.error(response.message);
                    $('#submit4').prop('disabled', false);
                    $('#loader4').hide();
                } else if (response.status === true) {
                    toastr.success(response.message);
                    $('#submit4').prop('disabled', false);
                    $('#loader4').hide();
                    setTimeout(function() {
             window.location.reload();
             },1000);
                }
            },
            error: function () {
                console.log('Error occurred during AJAX request');
            }
        });
    }
}

function formStep(step, id) {
}
$(document).ready(function(){
    $("#profile-btn").click();
});

function nextFormStep(div_id,button_id,prev_div_id,prev_button_id) {
    $('#' + div_id).addClass('active',true).css('display','block');
    $('#' + prev_div_id).removeClass('active',true).css('display','none');
    $('#' + button_id).addClass('active',true);
    $('#' + prev_button_id).removeClass('active',true);
}

function prevFormStep(prev_div_id, prev_button_id, div_id, button_id) {
    $('#' + prev_div_id).addClass('active').css('display', 'block');
    $('#' + div_id).removeClass('active').css('display', 'none');
    $('#' + prev_button_id).addClass('active');
    $('#' + button_id).removeClass('active');
}


</script>