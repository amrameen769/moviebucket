
<body id="page-top">
    <div id="wrapper">
        <nav class="navbar navbar-dark align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0" style="width: auto!important;">
            <div class="container-fluid d-flex flex-column p-0">
                <a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="#">
                    <div class="sidebar-brand-icon rotate-n-15"><i class="fas fa-tachometer-alt"></i></div>
                    <div class="sidebar-brand-text mx-3">
                        <span>
                            Dashboard
                        </span>
                    </div>
                </a>
                <hr class="sidebar-divider my-0">
                <ul class="nav navbar-nav text-light" id="accordionSidebar">
                    <li class="nav-item" role="presentation"><a class="nav-link active" href="<?=SITE_URL?>mv-admin/home.php"><span>Statistics</span></a></li>
                    <li class="nav-item dropdown"><a class="dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="false" href="#">Pending Requests</a>
                        <div class="dropdown-menu animated--grow-in" role="menu">
                            <a class="dropdown-item" role="presentation" href="<?=SITE_URL?>mv-admin/includes/mv-requests.php">Movie Requests</a>
                            <a class="dropdown-item" role="presentation" href="<?=SITE_URL?>mv-admin/includes/thr-requests.php">Theater Requests</a>
                        </div>
                    </li>
                </ul>
                <div class="text-center d-none d-md-inline"><button class="btn rounded-circle border-0" id="sidebarToggle" type="button"></button></div>
            </div>
        </nav>
        <div class="d-flex flex-column" id="content-wrapper">
