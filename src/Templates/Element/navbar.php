<section class="navbar-area <?= ((isset($headerHome)) ? '' : 'sticky') ?>">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <nav class="navbar navbar-expand-lg">
                    <a class="navbar-brand page-scroll align-items-center" href="<?= SITE_URL ?>">
                        <img src="<?= SITE_URL ?>img/anhanguera_logo.png" style="height: 50px !important;" alt="">
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTwo" aria-controls="navbarTwo" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="toggler-icon"></span>
                        <span class="toggler-icon"></span>
                        <span class="toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse sub-menu-bar" id="navbarTwo">
                        <ul class="navbar-nav">
                            <li class="nav-item"><a class="<?= (($this->Tool->isActiveMenu(['Pages' => ['index']], $this->request->getParam('action'), $this->request->getParam('controller'))) ? 'scrollMove' : '') ?>" href="<?= $this->Url->build(["controller" => "Pages", "action" => "index"]); ?>/#/speeches"><?= __('Palestras') ?></a></li>
                            <li class="nav-item"><a class="<?= (($this->Tool->isActiveMenu(['Pages' => ['index']], $this->request->getParam('action'), $this->request->getParam('controller'))) ? 'scrollMove' : '') ?>" href="<?= $this->Url->build(["controller" => "Pages", "action" => "index"]); ?>/#/events"><?= __('Eventos') ?></a></li>
                            <li class="nav-item"><a class="<?= (($this->Tool->isActiveMenu(['Pages' => ['index']], $this->request->getParam('action'), $this->request->getParam('controller'))) ? 'scrollMove' : '') ?>" href="<?= $this->Url->build(["controller" => "Pages", "action" => "index"]); ?>/#/contacts"><?= __('Contatos') ?></a></li>
                            <?php if($this->getRequest()->getSession()->check('Auth.User.id')) {?>
                                <li class="d-lx-none d-md-none nav-item"><a class="page-scroll" href="<?= $this->Url->build(["controller" => "Pages", "action" => "dashboard"]); ?>"><?= __('Dashboard') ?></a></li>
                            <?php } else {?>
                                <li class="d-lx-none d-md-none nav-item"><a class="page-scroll" href="<?= $this->Url->build(["controller" => "Users", "action" => "login"]); ?>"><?= __('Login') ?></a></li>
                                <li class="d-lx-none d-md-none nav-item"><a class="page-scroll" href="<?= $this->Url->build(["controller" => "Users", "action" => "login"]); ?>"><?= __('Cadastre-se') ?></a></li>
                            <?php }?>
                        </ul>
                    </div>
                    <?php if($this->getRequest()->getSession()->check('Auth.User.id')) {?>
                        <div class="navbar-btn d-none d-sm-inline-block">
                            <ul>
                                <li>
                                    <a class="solid" href="<?= $this->Url->build(["controller" => "Pages", "action" => "dashboard"]); ?>" style="margin-right: 10px">
                                        <i class="fad fa-sign-in" style="margin-right: 5px;"></i>
                                        <?= __('Dashboard') ?>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    <?php } else{?>
                        <div class="navbar-btn d-none d-sm-inline-block">
                            <ul>
                                <li class="d-none d-md-inline-block d-lx-inline-block">
                                    <a class="solid" href="<?= $this->Url->build(["controller" => "Users", "action" => "login"]); ?>" style="margin-right: 10px">
                                        <i class="fad fa-sign-in" style="margin-right: 5px;"></i>
                                        <?= __('Login') ?>
                                    </a>
                                </li>
                                <li class="d-none d-md-inline-block d-lx-inline-block">
                                    <a class="solid" href="<?= $this->Url->build(["controller" => "Users", "action" => "login"]); ?>" style="margin-right: 10px">
                                        <i class="fad fa-sign-in" style="margin-right: 5px;"></i>
                                        <?= __('Cadastre-se') ?>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    <?php }?>
                </nav>
            </div>
        </div>
    </div>
</section>
