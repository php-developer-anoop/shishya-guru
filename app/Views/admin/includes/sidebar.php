<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <a href="<?=base_url(ADMINPATH.'dashboard')?>" class="brand-link" title="<?=!empty($company['company_name'])?$company['company_name']:""?>">
  <img src="<?=$logo?>" alt="<?=!empty($company['logo_alt'])?$company['logo_alt']:""?>" class="brand-image img-circle elevation-3" style="opacity: .8">
  <span class="brand-text font-weight-light"><?=!empty($company['company_name'])?substr($company['company_name'],0,10):""?></span>
  </a>
  <div class="sidebar">
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <?php $uri = service('uri');
          if (getUri(2)) {
             $url = getUri(2);
          } else {
             $url = 'dashboard';
          }
          ?>
        <li class="nav-item">
          <a href="<?=base_url(ADMINPATH.'dashboard')?>" class="nav-link <?=!empty($url)&& ($url=="dashboard")?"active":""?>">
            <p>Dashboard</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="javascript:void(0)" class="nav-link">
            <p>
              Masters
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview" style="display: none;">
            <li class="nav-item">
              <a href="javascript:void(0)" class="nav-link">
                <p>
                  State Master
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="<?=base_url(ADMINPATH.'add-state')?>" class="nav-link">
                    <p>Add State</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?=base_url(ADMINPATH.'state-list')?>" class="nav-link">
                    <p>State List</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="javascript:void(0)" class="nav-link">
                <p>
                  Board Master
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="<?=base_url(ADMINPATH.'add-board')?>" class="nav-link">
                    <p>Add Board</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?=base_url(ADMINPATH.'board-list')?>" class="nav-link">
                    <p>Board List</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="javascript:void(0)" class="nav-link">
                <p>
                  Class Group Master
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="<?=base_url(ADMINPATH.'add-class-group')?>" class="nav-link">
                    <p>Add Class Group</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?=base_url(ADMINPATH.'class-group-list')?>" class="nav-link">
                    <p>Class Group List</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="javascript:void(0)" class="nav-link">
                <p>
                  Class Master
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="<?=base_url(ADMINPATH.'add-class')?>" class="nav-link">
                    <p>Add Class</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?=base_url(ADMINPATH.'class-list')?>" class="nav-link">
                    <p>Class List</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="javascript:void(0)" class="nav-link">
                <p>
                  Subject Master
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="<?=base_url(ADMINPATH.'add-subject')?>" class="nav-link">
                    <p>Add Subject</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?=base_url(ADMINPATH.'subject-list')?>" class="nav-link">
                    <p>Subject List</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="javascript:void(0)" class="nav-link">
                <p>
                  Skill Master
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="<?=base_url(ADMINPATH.'add-skill')?>" class="nav-link">
                    <p>Add Skill</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?=base_url(ADMINPATH.'skill-list')?>" class="nav-link">
                    <p>Skill List</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="javascript:void(0)" class="nav-link">
                <p>
                  Blog Category Master
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="<?=base_url(ADMINPATH.'add-blog-category')?>" class="nav-link">
                    <p>Add Blog Category</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?=base_url(ADMINPATH.'blog-category-list')?>" class="nav-link">
                    <p>Blog Category List</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="javascript:void(0)" class="nav-link">
                <p>
                  Blog Master
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="<?=base_url(ADMINPATH.'add-blog')?>" class="nav-link">
                    <p>Add Blog</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?=base_url(ADMINPATH.'blog-list')?>" class="nav-link">
                    <p>Blog List</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="javascript:void(0)" class="nav-link">
                <p>
                  Qualification Master
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="<?=base_url(ADMINPATH.'add-qualification')?>" class="nav-link">
                    <p>Add Qualification</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?=base_url(ADMINPATH.'qualification-list')?>" class="nav-link">
                    <p>Qualification List</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item d-none">
              <a href="javascript:void(0)" class="nav-link">
                <p>
                  Testimonial Master
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="<?=base_url(ADMINPATH.'add-testimonial')?>" class="nav-link">
                    <p>Add Testimonial</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?=base_url(ADMINPATH.'testimonial-list')?>" class="nav-link">
                    <p>Testimonial List</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="javascript:void(0)" class="nav-link">
                <p>
                  Banner Master
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="<?=base_url(ADMINPATH.'add-banner')?>" class="nav-link">
                    <p>Add Banner</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?=base_url(ADMINPATH.'banner-list')?>" class="nav-link">
                    <p>Banner List</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="javascript:void(0)" class="nav-link">
                <p>
                  Lead Master
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="<?=base_url(ADMINPATH.'add-lead')?>" class="nav-link">
                    <p>Add Lead</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?=base_url(ADMINPATH.'lead-list')?>" class="nav-link">
                    <p>Lead List</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="javascript:void(0)" class="nav-link">
                <p>
                  Tuition Fee Master
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="<?=base_url(ADMINPATH.'add-tuition-fee')?>" class="nav-link">
                    <p>Add Tuition Fee</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?=base_url(ADMINPATH.'tuition-fee-list')?>" class="nav-link">
                    <p>Tuition Fee List</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="javascript:void(0)" class="nav-link">
                <p>
                  SEO Master
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="<?=base_url(ADMINPATH.'add-seo-page')?>" class="nav-link">
                    <p>Add SEO Page</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?=base_url(ADMINPATH.'seo-page-list')?>" class="nav-link">
                    <p>SEO Pages List</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="javascript:void(0)" class="nav-link">
                <p>
                  CMS Master
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="<?=base_url(ADMINPATH.'add-cms')?>" class="nav-link">
                    <p>Add CMS Page</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?=base_url(ADMINPATH.'cms-list')?>" class="nav-link">
                    <p>CMS Pages List</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="javascript:void(0)" class="nav-link">
                <p>
                  Recharge Plan Master
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="<?=base_url(ADMINPATH.'add-plan')?>" class="nav-link">
                    <p>Add Plan</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?=base_url(ADMINPATH.'plan-list')?>" class="nav-link">
                    <p>Plans List</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="javascript:void(0)" class="nav-link">
                <p>
                  Schedule Master
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="<?=base_url(ADMINPATH.'add-schedule')?>" class="nav-link">
                    <p>Add Schedule</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?=base_url(ADMINPATH.'schedule-list')?>" class="nav-link">
                    <p>Schedule List</p>
                  </a>
                </li>
              </ul>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a href="<?=base_url(ADMINPATH.'city-list')?>" class="nav-link">
            <p>City List</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?=base_url(ADMINPATH.'area-list')?>" class="nav-link">
            <p>Area List</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?=base_url(ADMINPATH.'testimonial-list')?>" class="nav-link">
            <p>Testimonial List</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?=base_url(ADMINPATH.'area-seo-page-list')?>" class="nav-link">
            <p>Area SEO Pages List</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?=base_url(ADMINPATH.'tutor-list')?>" class="nav-link">
            <p>Tutor List</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="javascript:void(0)" class="nav-link">
            <p>
              Query List
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="<?=base_url(ADMINPATH.'query-list')?>" class="nav-link">
                <p>General Query List</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a href="<?=base_url(ADMINPATH.'faq-list')?>" class="nav-link">
            <p>FAQ List</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?=base_url(ADMINPATH.'configure-city-seo-page')?>" class="nav-link">
            <p>Configure City Seo Pages</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?=base_url(ADMINPATH.'city-seo-page-list')?>" class="nav-link">
            <p>City Seo Pages List</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="javascript:void(0)" class="nav-link">
            <p>
              Leads List
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="<?=base_url(ADMINPATH.'leads-list?type=New')?>" class="nav-link">
                <p>New Leads</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?=base_url(ADMINPATH.'leads-list?type=Pending')?>" class="nav-link">
                <p>Pending Leads</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?=base_url(ADMINPATH.'leads-list?type=Assigned')?>" class="nav-link">
                <p>Assigned Leads</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?=base_url(ADMINPATH.'leads-list?type=All')?>" class="nav-link">
                <p>All Leads</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a href="<?=base_url(ADMINPATH.'wallet-history')?>" class="nav-link <?=!empty($url)&& ($url=="wallet-history")?"active":""?>">
            <p>Wallet History</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?=base_url(ADMINPATH.'all-schedule-list')?>" class="nav-link <?=!empty($url)&& ($url=="all-schedule-list")?"active":""?>">
            <p>Scheduled List</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?=base_url(ADMINPATH.'recharge-request-list')?>" class="nav-link <?=!empty($url)&& ($url=="recharge-request-list")?"active":""?>">
            <p>Recharge Request List</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?=base_url(ADMINPATH.'websetting')?>" class="nav-link <?=!empty($url)&& ($url=="websetting")?"active":""?>">
            <p>Web Setting</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?=base_url(ADMINPATH.'home-setting')?>" class="nav-link <?=!empty($url)&& ($url=="home-setting")?"active":""?>">
            <p>Home Setting</p>
          </a>
        </li>
      </ul>
    </nav>
  </div>
</aside>