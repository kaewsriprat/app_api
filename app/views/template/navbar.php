<!-- Layout container -->
<div class="layout-page">

    <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">

        <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0   d-xl-none ">
            <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                <i class="bx bx-menu bx-sm"></i>
            </a>
        </div>


        <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
            <div class="navbar-nav align-items-center">
                <div class="nav-item navbar-search-wrapper">
                    <a class="nav-item nav-link search-toggler" href="/">
                        <img src="../../assets/img/edf_logo.png" alt="MOE" height="45">
                        <span class="d-none d-md-inline-block ps-3 fs-5"><?php echo APP_TITLE_TH; ?></span>
                    </a>
                </div>
            </div>
            <?php
            if (!empty($_SESSION)) {
                echo  '<ul class="navbar-nav flex-row align-items-center ms-auto">
              <li class="nav-item navbar-dropdown dropdown-user dropdown">
              <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
              <i class="bx bx-grid-alt bx-sm"></i>
              </a>
              <ul class="dropdown-menu dropdown-menu-end">
              <li>
              <a class="dropdown-item" href="/users/profile">
              <i class="bx bx-user me-2"></i>
              <span class="align-middle">My Profile</span>
              </a>
              </li>
              <li>
              <div class="dropdown-divider"></div>
              </li>
              <li>
              <a class="dropdown-item" href="users/logout" target="_blank">
              <i class="bx bx-power-off me-2"></i>
              <span class="align-middle">Log Out</span>
              </a>
              </li>
              </ul>
              </li>
              </ul>';
            }
            ?>
        </div>

    </nav>


    <div class="content-wrapper">