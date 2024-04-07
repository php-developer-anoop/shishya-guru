<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title><?=$meta_title?></title>
    <meta content="<?=$meta_description?>" name="description">
    <meta content="<?=$meta_keyword?>" name="keywords">
    <link href="<?=base_url('assets/tutor/')?>img/favicon.png" rel="icon">
    <link href="<?=base_url('assets/tutor/')?>img/apple-touch-icon.png" rel="apple-touch-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>  
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link href="<?=base_url('assets/tutor/')?>vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?=base_url('assets/tutor/')?>vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="<?=base_url('assets/tutor/')?>vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <?=link_tag(base_url('assets/plugins/select2/css/select2.min.css'))."\n";?>
    <?=link_tag(base_url('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css'))."\n";?>
    <link href="<?=base_url('assets/tutor/')?>vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="<?=base_url('assets/tutor/')?>vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="<?=base_url('assets/tutor/')?>vendor/remixicon/remixicon.css" rel="stylesheet">
    <?=link_tag(base_url('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css'))."\n";?>
    <?=link_tag(base_url('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css'))."\n";?>
    <link href="<?=base_url('assets/tutor/')?>css/style.css" rel="stylesheet">
    <?=link_tag(base_url('assets/plugins/toastr/toastr.min.css'))."\n";?>
    <style>
        .current a {
            color:#BA59DD;
        }
    </style>
  </head>
  <body>
    <header id="header" class="header fixed-top d-flex align-items-center">
      <div class="d-flex align-items-center justify-content-between nav-header">
        <a href="<?=base_url(TUTORPATH.'dashboard')?>" class="logo  d-flex align-items-center justify-content-center  sidebartoggle">
        <img src="<?=base_url('assets/tutor/')?>img/logo2.png" alt="">
        </a>
        <i class="bi toggle-sidebar-btn dashobord-Sidebaricon"></i> 
      </div>
      <div class="topbar_btn search-bar">
        <a href="<?=($tutor['kyc_status']!="Approved")?'javascript:void(0)':base_url(TUTORPATH.'dashboard')?>" class="topBardash"><i class="bi bi-layout-text-window-reverse"></i> Dashboard</a>
        <a href="<?=base_url(TUTORPATH.'my-profile')?>" class="topprofile"><i class="bi bi-person-circle"></i> Profile</a>
      </div>
      <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">
          <li class="nav-item dropdown">
            <a class="nav-link nav-icon" href="javascript:void(0)" data-bs-toggle="dropdown">
            <i class="bi bi-bell"></i>
            </a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link nav-icon" href="javascript:void(0)" data-bs-toggle="dropdown">
            <i class="bi bi-chat-left-text"></i>
            </a>
          </li>
          <li class="nav-item dropdown profile-responsive pe-lg-5">
            <a class="nav-link nav-profile d-flex align-items-center pe-0 profile-cls" href="javascript:void(0)" data-bs-toggle="dropdown">
            <img src="<?=!empty($profile_image)?$profile_image:base_url('assets/tutor/img/profileicon.png')?>" alt="Profile" class="rounded-circle">
            </a>
            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
              <li class="dropdown-header">
                <h6><?=!empty($tutor['tutor_name'])?$tutor['tutor_name']:''?></h6>
                <span>Teacher</span>
              </li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li>
                <a class="dropdown-item d-flex align-items-center"  href="<?=base_url(TUTORPATH.'my-profile')?>">
                <i class="bi bi-person"></i>
                <span>My Profile</span>
                </a>
              </li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li>
                <a class="dropdown-item d-flex align-items-center"  href="<?=($tutor['kyc_status']!="Approved")?'javascript:void(0)':base_url(TUTORPATH.'setting')?>">
                <i class="bi bi-gear"></i>
                <span>Account Settings</span>
                </a>
              </li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li>
                <a class="dropdown-item d-flex align-items-center" href="javascript:void(0)">
                <i class="bi bi-question-circle"></i>
                <span>Need Help?</span>
                </a>
              </li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li>
                <a class="dropdown-item d-flex align-items-center" href="<?=base_url(TUTORPATH.'logout')?>">
                <i class="bi bi-box-arrow-right"></i>
                <span>Sign Out</span>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
    </header>
    <aside id="sidebar" class="sidebar">
      <ul class="sidebar-nav extresposive" id="sidebar-nav">
        <li class="nav-item d-none">
          <a class="nav-link collapsed" href="<?=($tutor['kyc_status']!="Approved")?'javascript:void(0)':base_url(TUTORPATH.'course-list')?>">
          <img src="<?=base_url('assets/tutor/')?>img/Notebook.png" class="img-fluid"> <span class="sidebarNotShow">Courses <i class="bi bi-caret-right-fill"></i></span>
          </a>
        </li>
        <!--<li class="nav-item">-->
        <!--  <a class="nav-link collapsed" href="<?=($tutor['kyc_status']!="Approved")?'javascript:void(0)':base_url(TUTORPATH.'leads-list?type=New')?>">-->
        <!--  <img src="<?=base_url('assets/tutor/')?>img/Notebook.png" class="img-fluid"> <span class="sidebarNotShow">New Leads <i class="bi bi-caret-right-fill"></i></span>-->
        <!--  </a>-->
        <!--</li>-->
        <li class="nav-item">
          <a class="nav-link collapsed" href="<?=($tutor['kyc_status']!="Approved")?'javascript:void(0)':base_url(TUTORPATH.'reviews')?>">
          <img src="<?=base_url('assets/tutor/')?>img/Star--review.png" class="img-fluid"> <span class="sidebarNotShow">Reviews <i class="bi bi-caret-right-fill"></i></span>
          </a>
        </li>
        <li class="nav-item d-none">
          <a class="nav-link collapsed" href="<?=($tutor['kyc_status']!="Approved")?'javascript:void(0)':base_url(TUTORPATH.'blogs')?>">
          <img src="<?=base_url('assets/tutor/')?>img/Blog.png" class="img-fluid">
          <span class="sidebarNotShow">Blogs <i class="bi bi-caret-right-fill"></i></span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link collapsed" href="<?=($tutor['kyc_status']!="Approved")?'javascript:void(0)':base_url(TUTORPATH.'setting')?>">
          <img src="<?=base_url('assets/tutor/')?>img/Settings.png" class="img-fluid">
          <span class="sidebarNotShow">Settings <i class="bi bi-caret-right-fill"></i></span>
          </a>
        </li>
        <li class="nav-item sidebarNotShow">
          <a class="nav-link collapsed" href="<?=($tutor['kyc_status']!="Approved")?'javascript:void(0)':base_url(TUTORPATH.'active-tuitions')?>">
          <img src="<?=base_url('assets/tutor/')?>img/User--activity.png" class="img-fluid">
          <span class="sidebarNotShow">Active Tuition <i class="bi bi-caret-right-fill"></i></span>
          </a>
        </li>
        <li class="nav-item sidebarNotShow">
          <a class="nav-link collapsed" href="<?=($tutor['kyc_status']!="Approved")?'javascript:void(0)':base_url(TUTORPATH.'picked-leads')?>">
          <img src="<?=base_url('assets/tutor/')?>img/Interactive-segmentation-cursor.png" class="img-fluid">
          <span class="sidebarNotShow">Picked Enquiry <i class="bi bi-caret-right-fill"></i></span>
          </a>
        </li>
        <li class="nav-item sidebarNotShow">
          <a class="nav-link collapsed" href="<?=($tutor['kyc_status']!="Approved")?'javascript:void(0)':base_url(TUTORPATH.'my-wallet')?>">
          <img src="<?=base_url('assets/tutor/')?>img/Wallet.png" class="img-fluid">
          <span class="sidebarNotShow">Wallet <i class="bi bi-caret-right-fill"></i></span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link collapsed" href="<?=base_url(TUTORPATH.'logout')?>">
          <img src="<?=base_url('assets/tutor/')?>img/Logout.png" class="img-fluid">
          <span class="sidebarNotShow">Logout <i class="bi bi-caret-right-fill"></i></span>
          </a>
        </li>
      </ul>
    </aside>