<section id="home" class="slider_area">
    <div id="carouselThree" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-7">
                            <div class="slider-content">
                                <h2 class="title"><?= __('Um lugar para CRESCER!') ?></h2>
                                <h4 class="sub-title text-white">
                                    <?= __('Venha conferir alguns dos nosso eventos') ?><br>
                                    <?= __('que foram feitos para te ajudar a crescer!') ?>
                                </h4>
                                <ul class="slider-btn rounded-buttons">
                                    <li>
                                        <a class="main-btn rounded-two scrollMove"
                                           href="<?= $this->Url->build(["controller" => "Pages", "action" => "index"]); ?>/#/speeches">
                                            <i class="fad fa-rocket-launch" style="margin-right: 5px;"></i>
                                            <?= __('Nossas palestras') ?>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="main-btn rounded-two scrollMove"
                                           href="<?= $this->Url->build(["controller" => "Pages", "action" => "index"]); ?>/#/contacts">
                                            <i class="fas fa-phone-alt" style="margin-right: 5px;"></i>
                                            <?= __('Quero Palestrar') ?>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="slider-image-box d-none d-lg-flex align-items-end">
                    <div class="slider-image">
                        <img src="<?= SITE_URL ?>img/banner1.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="speeches" class="page-box page-dark">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="section-title text-center pb-10">
                    <h3 class="title"><?= __('Nossas Palestras') ?></h3>
                    <hr>
                    <p>
                        <?php if (!empty($speeches)) { ?>
                            <?= __('Comfira as palestras que temos agendadas para essa semana.') ?>
                        <?php } else { ?>
                            <?= __('Poxa, não temos paletras agendadas para essa semana.') ?>
                        <?php } ?>
                    </p>
                </div>
            </div>
        </div>
        <div class="row bg-white p-3">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="widget-wrap">
                    <div class="widget-header block-header clearfix">
                        <?= $this->Form->create(NULL, ['id' => 'Speeches', 'class' => 'j-forms', 'url' => ['controller' => 'Pages', 'action' => 'index'], 'novalidate' => 'novalidate', 'type' => 'get']); ?>
                        <?php $this->Form->setTemplates(['inputContainer' => '{{content}}']); ?>

                        <?= $this->Form->control('filter', ['type' => 'hidden', 'value' => 1]) ?>

                        <div class="form-content">
                            <div class="row">
                                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 unit">
                                    <input class="form-control" name="speeches_q" type="search" placeholder="<?= __('Busca por aproximação...'); ?>" value="<?= $this->request->getQuery('speeches_q'); ?>">
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 unit">
                                            <?= $this->Form->control('speeches_date_from', ['type' => 'text', 'class' => 'form-control mask_date', 'value' => ((!empty($speeches_date_from)) ? $speeches_date_from : ''), 'label' => FALSE, 'placeholder' => __('Data de Início')]) ?>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 unit">
                                            <?= $this->Form->control('speeches_date_to', ['type' => 'text', 'class' => 'form-control mask_date', 'value' => ((!empty($speeches_date_to)) ? $speeches_date_to : ''), 'label' => FALSE, 'placeholder' => __('Data Fim')]) ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-right">
                                    <button type="submit" class="btn btn-success btn-sm marginButtonDefault">
                                        <?= __('Buscar'); ?>
                                    </button>
                                    <a href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'index']); ?>"
                                       class="btn btn-warning btn-sm marginButtonDefault">
                                        <?= __('Limpar busca'); ?>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <?= $this->Form->end() ?>
                    </div>
                    <div class="widget-container">
                        <div class="widget-content">
                            <?php if (count($speeches) > 0) { ?>
                                <div class="table-responsive">
                                    <table class="table table-hover"
                                           style="width: 1029px !important;max-width: 1029px !important;">
                                        <thead>
                                        <tr>
                                            <th width="8%"><?php echo __('Cadastro'); ?></th>
                                            <th class="text-center" width="5%"><?php echo __('Ativo'); ?></th>
                                            <th class="text-center" width="10%"><?php echo __('Online'); ?></th>
                                            <th class="text-center" width="13%"><?php echo __('Último acesso'); ?></th>
                                            <th><?php echo __('Nome'); ?></th>
                                            <th><?php echo __('Perfil'); ?></th>
                                            <th width="7%"></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($speeches as $key => $row) { ?>
                                            <tr>
                                                <td>
                                                    <p>
                                                        <?= (($row->created) ? $this->Date->humanizeDate($row->created->format('Y-m-d H:i:s')) : ''); ?>
                                                    </p>
                                                </td>
                                                <td class="text-center">
                                                    <?php if ($row->allow_login) { ?>
                                                        <span class="label label-success"><?= __('Sim'); ?></span>
                                                    <?php } else { ?>
                                                        <span class="label label-default"><?= __('Não'); ?></span>
                                                    <?php } ?>
                                                </td>
                                                <td class="text-center">
                                                    <p>
                                                        <?php if ($row->is_online) { ?>
                                                            <span class="label label-success" style="margin-bottom: 5px;"><?= __('Sim') ?></span>
                                                        <?php } else { ?>
                                                            <span class="label label-default" style="margin-bottom: 5px;"><?= __('Não') ?></span>
                                                        <?php } ?>
                                                    </p>
                                                    <?php if ($row['last_check_online']) { ?>
                                                        <p class="marginLineTopDefault">
                                                            <?= $this->Date->humanizeDate($row['last_check_online']->format('Y-m-d H:i:s')); ?>
                                                        </p>
                                                    <?php } ?>
                                                </td>
                                                <td class="text-center">
                                                    <?php if ($row['last_login']) { ?>
                                                        <p>
                                                            <?= $this->Date->humanizeDate($row['last_login']->format('Y-m-d H:i:s')); ?>
                                                        </p>
                                                    <?php } ?>
                                                </td>
                                                <td>
                                                    <p>
                                                        <a href="<?= $this->Url->build(['controller' => 'Accounts', 'action' => 'employeeView', $row->access_token]); ?>">
                                                            <?= h($row->full_name) ?>
                                                        </a>
                                                    </p>
                                                </td>
                                                <td>
                                                    <p>
                                                        <?php
                                                        if ($row->role == 0) {
                                                            echo 'Atendente';
                                                        } elseif ($row->role == 1) {
                                                            echo 'Administrador';
                                                        } elseif ($row->role == 2) {
                                                            echo 'Supervisor';
                                                        } elseif ($row->role == 3) {
                                                            echo 'Vendedor';
                                                        }
                                                        ?>
                                                    </p>
                                                </td>
                                                <td class="text-center">
                                                    <a href="<?= $this->Url->build(['controller' => 'Accounts', 'action' => 'employeeView', $row->access_token]); ?>" class="btn btn-info btn-sm">
                                                        <i class="fad fa-cogs"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                                <?php echo $this->element('scroll-table') ?>
                                <?php echo $this->element('pagination', ['textCount' => 'Total de usuários:']); ?>
                            <?php } else { ?>
                                <p>
                                    <?= __('Nenhum registro encontrado até o momento.'); ?>
                                </p>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="events" class="page-box page-dark">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="section-title text-center pb-10">
                    <h3 class="title"><?= __('Nosso Eventos') ?></h3>
                    <hr>
                    <p>
                        <?php if(!empty($events)) {?>
                            <?= __('Gonfira os eventos que temos para essa semana.'); ?>
                        <?php } else { ?>
                            <?= __('Poxa, não temos eventos agendadas para essa semana.') ?>
                        <?php } ?>
                    </p>
                </div>
            </div>
        </div>
        <div class="row bg-white p-3">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="widget-wrap">
                    <div class="widget-header block-header clearfix">
                        <?= $this->Form->create(NULL, ['id' => 'Events', 'class' => 'j-forms', 'url' => ['controller' => 'Pages', 'action' => 'index'], 'novalidate' => 'novalidate', 'type' => 'get']); ?>
                        <?php $this->Form->setTemplates(['inputContainer' => '{{content}}']); ?>

                        <?= $this->Form->control('filter', ['type' => 'hidden', 'value' => 1]) ?>

                        <div class="form-content">
                            <div class="row">
                                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 unit">
                                    <input class="form-control" name="events_q" type="search" placeholder="<?= __('Busca por aproximação...'); ?>" value="<?= $this->request->getQuery('events_q'); ?>">
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 unit">
                                            <?= $this->Form->control('events_date_from', ['type' => 'text', 'class' => 'form-control mask_date', 'value' => ((!empty($events_date_from)) ? $events_date_from : ''), 'label' => FALSE, 'placeholder' => __('Data de Início')]) ?>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 unit">
                                            <?= $this->Form->control('events_date_to', ['type' => 'text', 'class' => 'form-control mask_date', 'value' => ((!empty($events_date_to)) ? $events_date_to : ''), 'label' => FALSE, 'placeholder' => __('Data Fim')]) ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-right">
                                    <button type="submit" class="btn btn-success btn-sm marginButtonDefault">
                                        <?= __('Buscar'); ?>
                                    </button>
                                    <a href="<?= $this->Url->build(['controller' => 'Pages', 'action' => 'index']); ?>"
                                       class="btn btn-warning btn-sm marginButtonDefault">
                                        <?= __('Limpar busca'); ?>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <?= $this->Form->end() ?>
                    </div>
                    <div class="widget-container">
                        <div class="widget-content">
                            <?php if (count($events) > 0) { ?>
                                <div class="table-responsive">
                                    <table class="table table-hover"
                                           style="width: 1029px !important;max-width: 1029px !important;">
                                        <thead>
                                        <tr>
                                            <th width="8%"><?php echo __('Cadastro'); ?></th>
                                            <th class="text-center" width="5%"><?php echo __('Ativo'); ?></th>
                                            <th class="text-center" width="10%"><?php echo __('Online'); ?></th>
                                            <th class="text-center" width="13%"><?php echo __('Último acesso'); ?></th>
                                            <th><?php echo __('Nome'); ?></th>
                                            <th><?php echo __('Perfil'); ?></th>
                                            <th width="7%"></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($events as $key => $row) { ?>
                                            <tr>
                                                <td>
                                                    <p>
                                                        <?= (($row->created) ? $this->Date->humanizeDate($row->created->format('Y-m-d H:i:s')) : ''); ?>
                                                    </p>
                                                </td>
                                                <td class="text-center">
                                                    <?php if ($row->allow_login) { ?>
                                                        <span class="label label-success"><?= __('Sim'); ?></span>
                                                    <?php } else { ?>
                                                        <span class="label label-default"><?= __('Não'); ?></span>
                                                    <?php } ?>
                                                </td>
                                                <td class="text-center">
                                                    <p>
                                                        <?php if ($row->is_online) { ?>
                                                            <span class="label label-success" style="margin-bottom: 5px;"><?= __('Sim') ?></span>
                                                        <?php } else { ?>
                                                            <span class="label label-default" style="margin-bottom: 5px;"><?= __('Não') ?></span>
                                                        <?php } ?>
                                                    </p>
                                                    <?php if ($row['last_check_online']) { ?>
                                                        <p class="marginLineTopDefault">
                                                            <?= $this->Date->humanizeDate($row['last_check_online']->format('Y-m-d H:i:s')); ?>
                                                        </p>
                                                    <?php } ?>
                                                </td>
                                                <td class="text-center">
                                                    <?php if ($row['last_login']) { ?>
                                                        <p>
                                                            <?= $this->Date->humanizeDate($row['last_login']->format('Y-m-d H:i:s')); ?>
                                                        </p>
                                                    <?php } ?>
                                                </td>
                                                <td>
                                                    <p>
                                                        <a href="<?= $this->Url->build(['controller' => 'Accounts', 'action' => 'employeeView', $row->access_token]); ?>">
                                                            <?= h($row->full_name) ?>
                                                        </a>
                                                    </p>
                                                </td>
                                                <td>
                                                    <p>
                                                        <?php
                                                        if ($row->role == 0) {
                                                            echo 'Atendente';
                                                        } elseif ($row->role == 1) {
                                                            echo 'Administrador';
                                                        } elseif ($row->role == 2) {
                                                            echo 'Supervisor';
                                                        } elseif ($row->role == 3) {
                                                            echo 'Vendedor';
                                                        }
                                                        ?>
                                                    </p>
                                                </td>
                                                <td class="text-center">
                                                    <a href="<?= $this->Url->build(['controller' => 'Accounts', 'action' => 'employeeView', $row->access_token]); ?>" class="btn btn-info btn-sm">
                                                        <i class="fad fa-cogs"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                                <?php echo $this->element('scroll-table') ?>
                                <?php echo $this->element('pagination', ['textCount' => 'Total de usuários:']); ?>
                            <?php } else { ?>
                                <p>
                                    <?= __('Nenhum registro encontrado até o momento.'); ?>
                                </p>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="contacts" class="contact-area page-dark">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="section-heading">
                    <h2 class="marginTopDefault"><?= __('Dúvidas? Fale conosco') ?></h2>
                    <hr>
                </div>
            </div>
        </div>
        <div class="contact-info pt-10">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="single-contact-info contact-color-2 mt-30 d-flex">
                        <div class="contact-info-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div class="contact-info-content media-body">
                            <p class="text" style="font-size: 20px;margin-top: 12px;"><?= __('asutter@anhanguera.com') ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="single-contact-info contact-color-3 mt-30 d-flex">
                        <div class="contact-info-icon">
                            <i class="fab fa-whatsapp"></i>
                        </div>
                        <div class="contact-info-content media-body">
                            <p class="text" style="font-size: 20px;margin-top: 12px;">
                                <a href="<?= $this->Url->build(["controller" => "Pages", "action" => "whatsapp"]); ?>">
                                    <?= __('(21) 96974-9717') ?>
                                </a>
                            </p>
                            <p class="text" style="font-size: 14px;margin-top: 5px;line-height: 14px;">
                                <?= __('Central de atendimento') ?><br>
                                <span class="text" style="font-size: 11px;"><?= __('Apenas WhatsApp') ?></span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php $this->start('custom_script'); ?>
<script>
    $(function () {

    });
</script>
<?php $this->end(); ?>
