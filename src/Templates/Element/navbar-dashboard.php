<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl shadow-blur mt-4 left-auto top-1"
     id="navbarBlur" navbar-scroll="true">
    <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
            <h6 class="font-weight-bolder mb-0"><?= $page_title ?></h6>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4 justify-content-end" id="navbar">
            <ul class="navbar-nav justify-content-end">
                <li class="nav-item d-flex align-items-center">
                    <a href="<?= $this->Url->build(["controller" => "Users", "action" => "logout"]); ?>"
                       class="nav-link text-body font-weight-bold px-0">
                        <i class="fa-duotone fa-arrow-right-from-bracket me-sm-1"></i>
                        <span class="d-sm-inline d-none"><?= __('Sair') ?></span>
                    </a>
                </li>
                <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                    <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                        <div class="sidenav-toggler-inner">
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
