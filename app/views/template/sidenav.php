<?php

$menuArray = [
    [
        'Title' => 'Dashboard',
        'Link' => '',
        'Active' => '',
        'Header' => 'Home',
        'Icon' => 'bx bx-home text-secondary',
        'Order' => 0,
        'Role' => [],
        'Submenu' => [
            [
                'Title' => 'ภาพรวม',
                'Link' => '/home/overallDashboard',
                'Active' => setActive('overallDashboard'),
                'Header' => '',
                'Icon' => '',
                'Order' => 0,
                'Role' => [],
                'Submenu' => [],
            ],
            [
                'Title' => 'ตัวชี้วัด',
                'Link' => '/home/indicatorsDashboard',
                'Active' => setActive('indicatorsDashboard'),
                'Header' => '',
                'Icon' => '',
                'Order' => 0,
                'Role' => [],
                'Submenu' => [],
            ],
            [
                'Title' => 'โครงการ',
                'Link' => '/home/projectsDashboard',
                'Active' => setActive('projectsDashboard'),
                'Header' => '',
                'Icon' => '',
                'Order' => 0,
                'Role' => [],
                'Submenu' => [],
            ],
        ],
    ],
    [
        'Title' => 'โครงการ',
        'Link' => '',
        'Active' => '',
        'Header' => 'Projects',
        'Icon' => 'bx bx-notepad text-primary',
        'Order' => 0,
        'Role' => [],
        'Submenu' => [
            [
                'Title' => 'โครงการทั้งหมด',
                'Link' => '/projects',
                'Active' => setActive('projects'),
                'Header' => '',
                'Icon' => '',
                'Order' => 0,
                'Role' => [],
                'Submenu' => [],
            ],
        ],
    ],
    [
        'Title' => 'การเงิน',
        'Link' => '',
        'Active' => '',
        'Header' => 'Finance',
        'Icon' => 'bx bx-money text-success',
        'Order' => 0,
        'Role' => [],
        'Submenu' => [
            [
                'Title' => 'สินทรัพย์/หนี้สิน',
                'Link' => '/finance/assets',
                'Active' => setActive('assets'),
                'Header' => '',
                'Icon' => '',
                'Order' => 0,
                'Role' => [],
                'Submenu' => [],
            ],
            [
                'Title' => 'รายรับ/รายจ่าย',
                'Link' => '/finance/balance',
                'Active' => setActive('balance'),
                'Header' => '',
                'Icon' => '',
                'Order' => 0,
                'Role' => [],
                'Submenu' => [],
            ],
        ],
    ],
    [
        'Title' => 'จัดการข้อมูล',
        'Link' => '',
        'Active' => '',
        'Header' => 'ข้อมูลระบบ',
        'Icon' => 'bx bx-user-circle text-warning',
        'Order' => 0,
        'Role' => [1],
        'Submenu' => [
            [
                'Title' => 'จัดการผู้ใช้งาน',
                'Link' => '/users',
                'Active' => setActive('users'),
                'Header' => '',
                'Icon' => '',
                'Order' => 0,
                'Role' => [1],
                'Submenu' => [],
            ],
        ],
    ],
    [
        'Title' => 'ออกจากระบบ',
        'Link' => '/auth/logout',
        'Active' => false,
        'Header' => 'ออกจากระบบ',
        'Icon' => 'bx bx-log-out-circle text-danger',
        'Order' => 0,
        'Role' => [],
        'Submenu' => [],
    ],
];


function menuRender($menuArray)
{
    $html = '';
    $role = $_SESSION['user']['roles'];
    sort($role);
    foreach ($menuArray as $menu) {

        //check role if $menu['Role'] match with $_SESSION['role'] or empty show menu
        if (array_intersect($role, $menu['Role']) || $menu['Role'] == []) {
            //check submenu if empty show single menu
            if (empty($menu['Submenu'])) {
                $html .= (($menu['Header']) ? '<li class="menu-header small text-uppercase">
            <span class="menu-header-text">' . $menu['Header'] . '</span></li>' : '') . '            
            <li class="menu-item ' . $menu['Active'] . '">
                <a href="' . $menu['Link'] . '" class="menu-link">
                    ' .
                    (($menu['Icon']) ? '<i class="menu-icon tf-icons ' . $menu['Icon'] . '"></i>' : '')
                    . '
                    <div data-i18n="' . $menu['Title'] . '">' . $menu['Title'] . '</div>
                </a>
            </li>
            ';
            } else {
                $html .= (($menu['Header']) ? '<li class="menu-header small text-uppercase">
            <span class="menu-header-text">' . $menu['Header'] . '</span></li>' : '') . '
            <li class="menu-item ' . $menu['Active'] . '">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons ' . $menu['Icon'] . '"></i>
                    <div data-i18n="' . $menu['Title'] . '">' . $menu['Title'] . '</div>
                </a>
                <ul class="menu-sub">
                    ' . menuRender($menu['Submenu']) . '
                </ul>
            </li>
            ';
            }
        }
    }
    return $html;
}

function setActive($link)
{
    $url = $_SERVER['REQUEST_URI'];
    $url = explode('/', $url);
    $url = $url[count($url) - 1];

    if ($url === $link) {
        return 'active';
    }
}

?>

<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <!-- LOGO -->
    <div class="app-brand demo ">
        <a href="index.html" class="app-brand-link">
            <span class="app-brand-logo">
                <img src="/assets/img/edf_logo.png" alt="MOE" height="45">
            </span>
            <span class="app-brand-text menu-text fs-5 fw-bold ms-1 mb-1"><?php echo APP_TITLE_TH_SHORT; ?></span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>
    <!-- LOGO -->

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- SHOW USER MENU PROFILE -->
        <?php
        if (count($_SESSION) > 0) {
            echo '
            <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <div data-i18n="' . $_SESSION['user']['email'] . '" class="text-uppercase">' . $_SESSION['user']['email'] . '</div>
            </a>
                <ul class="menu-sub">
                    <li class="menu-item">
                        <a href="#" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-cog"></i>
                            <div data-i18n="Setting">ตั้งค่า</div>
                        </a>
                    </li>
                    <!-- li class="menu-item">
                        <a href="#" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-log-out"></i>
                            <div data-i18n="Logout">ออกจากระบบ</div>
                        </a>
                    </!-->
                </ul>
            </li>
                ';
        }
        ?>
        <!-- SHOW USER MENU PROFILE -->

        <!-- <li class=" menu-header small text-uppercase mt-0">
            <span class="menu-header-text">เมนู</span>
        </li> -->
        <?php echo menuRender($menuArray); ?>
    </ul>
</aside>

<!-- HAMBERGER MENU -->
<nav class="layout-navbar container-fluid navbar navbar-expand-xl" id="layout-navbar" style="background-color:RGBA(255,255,255,0) !important; z-index:0;">
    <div class=" layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none mt-2 ms-2">
        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
            <i class="bx bx-menu bx-sm"></i>
        </a>
    </div>
</nav>
<!-- HAMBERGER MENU -->

<!-- <script>
    let activeItem = document.getElementsByClassName('menu-item active');
    let activeItemParent = activeItem[0].parentElement;
    let activeItemNode = activeItemParent.parentElement;
    activeItemNode.classList.add('active', 'open');
</script> -->

<script>
    //find active
    let activeItem = document.getElementsByClassName('menu-item active');
    let activeItemParent = activeItem[0].parentElement;
    let activeItemNode = activeItemParent.parentElement;
    activeItemNode.classList.add('active', 'open');
</script>