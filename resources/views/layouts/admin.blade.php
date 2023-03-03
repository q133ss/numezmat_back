<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title', 'Панель администратора')</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="/admin_assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="/admin_assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="/admin_assets/vendors/jvectormap/jquery-jvectormap.css">
    <link rel="stylesheet" href="/admin_assets/vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="/admin_assets/vendors/owl-carousel-2/owl.carousel.min.css">
    <link rel="stylesheet" href="/admin_assets/vendors/owl-carousel-2/owl.theme.default.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="/admin_assets/css/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="/admin_assets/images/favicon.png" />
</head>
<body>
<div class="container-scroller">
    <!-- partial:partials/_sidebar.html -->
    <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
            <a class="sidebar-brand brand-logo" href="/" target="_blank"><span class="text-primary">Numezmat</span></a>
            <a class="sidebar-brand brand-logo-mini" href="index.html"><img src="/admin_assets/images/logo-mini.svg" alt="logo" /></a>
        </div>
        <ul class="nav">
            <li class="nav-item profile">
                <div class="profile-desc">
                    <div class="profile-pic">
                        <div class="count-indicator">
                            <img class="img-xs rounded-circle " src="/admin_assets/images/faces/face15.jpg" alt="">
                            <span class="count bg-success"></span>
                        </div>
                        <div class="profile-name">
                            <h5 class="mb-0 font-weight-normal">{{Auth()->user()->name}}</h5>
                        </div>
                    </div>
                </div>
            </li>
            <li class="nav-item nav-category">
                <span class="nav-link">Навигация</span>
            </li>

            <li class="nav-item menu-items">
                <a class="nav-link" href="{{route('admin.users.index')}}">
              <span class="menu-icon">
                <i class="mdi mdi-contacts"></i>
              </span>
                    <span class="menu-title">Пользователи</span>
                </a>
            </li>

            <li class="nav-item menu-items">
                <a class="nav-link" data-toggle="collapse" href="#ui-advert" aria-expanded="false" aria-controls="ui-basic">
              <span class="menu-icon">
                <i class="mdi mdi-receipt"></i>
              </span>
                    <span class="menu-title">Реклама</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="ui-advert">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"> <a class="nav-link" href="{{route('admin.ads.requests')}}">Заявки на рекламу</a></li>
                        <li class="nav-item"> <a class="nav-link" href="{{route('admin.ads.index')}}">Реклама</a></li>
                    </ul>
                </div>
            </li>

            <li class="nav-item menu-items">
                <a class="nav-link" href="{{route('admin.roles.index')}}">
              <span class="menu-icon">
                <i class="mdi mdi-account-card-details"></i>
              </span>
                    <span class="menu-title">Роли</span>
                </a>
            </li>

            <li class="nav-item menu-items">
                <a class="nav-link" href="#">
              <span class="menu-icon">
                <i class="mdi mdi-account-key"></i>
              </span>
                    <span class="menu-title">Доступы</span>
                </a>
            </li>

            <li class="nav-item menu-items">
                <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
              <span class="menu-icon">
                <i class="mdi mdi-alert "></i>
              </span>
                    <span class="menu-title">Заблокированные</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="ui-basic">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"> <a class="nav-link" href="pages/ui-features/buttons.html">Новости</a></li>
                        <li class="nav-item"> <a class="nav-link" href="pages/ui-features/dropdowns.html">Определение и оценка</a></li>
                        <li class="nav-item"> <a class="nav-link" href="pages/ui-features/typography.html">Экспертиза</a></li>
                        <li class="nav-item"> <a class="nav-link" href="pages/ui-features/typography.html">Каталог</a></li>
                        <li class="nav-item"> <a class="nav-link" href="pages/ui-features/typography.html">Магазин</a></li>
                        <li class="nav-item"> <a class="nav-link" href="pages/ui-features/typography.html">Библиотека</a></li>
                        <li class="nav-item"> <a class="nav-link" href="pages/ui-features/typography.html">Беседка</a></li>
                    </ul>
                </div>
            </li>
        </ul>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_navbar.html -->
        <nav class="navbar p-0 fixed-top d-flex flex-row">
            <div class="navbar-brand-wrapper d-flex d-lg-none align-items-center justify-content-center">
                <a class="navbar-brand brand-logo-mini" href="index.html"><img src="/admin_assets/images/logo-mini.svg" alt="logo" /></a>
            </div>
            <div class="navbar-menu-wrapper flex-grow d-flex align-items-stretch">
                <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                    <span class="mdi mdi-menu"></span>
                </button>

                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
                    <span class="mdi mdi-format-line-spacing"></span>
                </button>
            </div>
        </nav>
        <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">
                @yield('content')
            </div>
            <!-- content-wrapper ends -->
            <!-- partial:partials/_footer.html -->

            <!-- partial -->
        </div>
        <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->
<!-- plugins:js -->
<script src="/admin_assets/vendors/js/vendor.bundle.base.js"></script>
<!-- endinject -->
<!-- Plugin js for this page -->
<script src="/admin_assets/vendors/chart.js/Chart.min.js"></script>
<script src="/admin_assets/vendors/progressbar.js/progressbar.min.js"></script>
<script src="/admin_assets/vendors/jvectormap/jquery-jvectormap.min.js"></script>
<script src="/admin_assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<script src="/admin_assets/vendors/owl-carousel-2/owl.carousel.min.js"></script>
<!-- End plugin js for this page -->
<!-- inject:js -->
<script src="/admin_assets/js/off-canvas.js"></script>
<script src="/admin_assets/js/hoverable-collapse.js"></script>
<script src="/admin_assets/js/misc.js"></script>
<script src="/admin_assets/js/settings.js"></script>
<script src="/admin_assets/js/todolist.js"></script>
<!-- endinject -->
<!-- Custom js for this page -->
<script src="/admin_assets/js/dashboard.js"></script>
<!-- End custom js for this page -->
<script>
    $('.delete_agreement').click(function (){
        let conf = confirm('Вы уверены?');
        if(conf){
            return true;
        }
        return false;
    });
</script>
@yield('scripts')
</body>
</html>
