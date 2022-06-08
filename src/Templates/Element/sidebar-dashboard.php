<aside
    class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3"
    id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
           aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-auto text-center" href="<?= SITE_URL ?>">
            <img src="<?= SITE_URL ?>img\anhanguera_logo.png" class="navbar-brand-img h-100" alt="main_logo">
        </a>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse w-auto h-auto" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <?php $urlPages = [
                'Pages' => ['dashboard']
            ]; ?>
            <li class="nav-item text-center">
                <a class="nav-link <?= (($this->Tool->isActiveMenu($urlPages, $this->request->getParam('action'), $this->request->getParam('controller'))) ? 'active' : '') ?>"
                   href="<?= $this->Url->build(["controller" => "Pages", "action" => "dashboard"]); ?>">
                    <div class="text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">dashboard</i>
                    </div>
                    <span class="nav-link-text ms-1"><?= __('Dashboard') ?></span>
                </a>
            </li>
        </ul>
    </div>
</aside>
