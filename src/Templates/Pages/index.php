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
                        <?= __('Confira as palestras que temos agendadas.') ?>
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
                                    <input class="form-control" name="speeches_q" type="search"
                                           placeholder="<?= __('Busca por aproximação...'); ?>"
                                           value="<?= $this->request->getQuery('speeches_q'); ?>">
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                    <?= $this->Form->control('speeches_month', ['type' => 'select', 'class' => 'form-control', 'options' => $this->Date->getMonths(), 'label' => FALSE, 'default' => (($this->request->getQuery('speeches_month')) ?: date("m")), 'empty' => false]) ?>
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
                                            <th><?= __('Detalhes'); ?></th>
                                            <th width="20%"><?= __('Data'); ?></th>
                                            <th width="10%"><?= __('Status'); ?></th>
                                            <th width="10%"></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($speeches as $key => $row) { ?>
                                            <tr>
                                                <td>
                                                    <p>
                                                        <?= $this->Date->humanizeDate($row->created->format('Y-m-d H:i:s')); ?>
                                                    </p>
                                                </td>
                                                <td>
                                                    <p>
                                                        <?= __('Inicio: ') . $this->Date->humanizeDate($row->date_time_start->format('Y-m-d H:i:s')); ?>
                                                    </p>
                                                    <p>
                                                        <?= __('Final: ') . $this->Date->humanizeDate($row->date_time_end->format('Y-m-d H:i:s')); ?>
                                                    </p>
                                                </td>
                                                <td>
                                                    <?php if ($row->allow_login) { ?>
                                                        <span class="label label-success"><?= __('Sim'); ?></span>
                                                    <?php } else { ?>
                                                        <span class="label label-default"><?= __('Não'); ?></span>
                                                    <?php } ?>
                                                </td>
                                                <td class="text-center">
                                                    <a href="<?= $this->Url->build(['controller' => 'Accounts', 'action' => 'employeeView', $row->access_token]); ?>"
                                                       class="btn btn-info btn-sm">
                                                        <i class="fad fa-cogs"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            <?php } else { ?>
                                <p>
                                    <?= __('Nenhuma palestra encontrada.'); ?>
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
                        <?= __('Gonfira os eventos que temos agendados.'); ?>
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
                                    <input class="form-control" name="events_q" type="search"
                                           placeholder="<?= __('Busca por aproximação...'); ?>"
                                           value="<?= $this->request->getQuery('events_q'); ?>">
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                    <?= $this->Form->control('events_month', ['type' => 'select', 'class' => 'form-control', 'options' => $this->Date->getMonths(), 'label' => FALSE, 'default' => (($this->request->getQuery('events_month')) ?: date("m")), 'empty' => false]) ?>
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
                                            <th><?= __('Detalhes'); ?></th>
                                            <th width="20%"><?= __('Data'); ?></th>
                                            <th width="10%"><?= __('Status'); ?></th>
                                            <th width="10%"></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($events as $key => $row) { ?>
                                            <tr>
                                                <td>
                                                    <p><?= $row->title ?></p>
                                                    <p><?= $row->description ?></p>
                                                    <p>
                                                        <?php if($row->type) {?>
                                                            <?= __('URL: ').$row->url; ?>
                                                        <?php } else { ?>
                                                            <?= __('Endereço: ').$row->address; ?>
                                                        <?php } ?>
                                                    </p>
                                                </td>
                                                <td>
                                                    <p>
                                                        <?= __('Inicio: ') . $this->Date->humanizeDate($row->date_time_start->format('Y-m-d H:i:s')); ?>
                                                    </p>
                                                    <p>
                                                        <?= __('Final: ') . $this->Date->humanizeDate($row->date_time_end->format('Y-m-d H:i:s')); ?>
                                                    </p>
                                                </td>
                                                <td>
                                                    <?php if ($row->status) { ?>
                                                        <span class="label label-success"><?= __('Confirmado'); ?></span>
                                                    <?php } else { ?>
                                                        <span class="label label-danger"><?= __('Cancelado'); ?></span>
                                                    <?php } ?>
                                                </td>
                                                <td class="text-center">
                                                    <a href="<?= $this->Url->build(['controller' => '', 'action' => '', $row->id]); ?>" class="btn btn-info btn-sm">
                                                        <i class="fad fa-cogs"></i>
                                                        <?= __('Participar'); ?>
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            <?php } else { ?>
                                <p>
                                    <?= __('Nenhum evento encontrado.'); ?>
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
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="single-contact-info contact-color-3 mt-30 d-flex">
                        <div class="contact-info-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div class="contact-info-content media-body">
                            <p class="text" style="font-size: 20px;margin-top: 12px;">
                                <?= __('asutter@anhanguera.com') ?>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12">
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
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="single-contact-info contact-color-3 mt-30 d-flex">
                        <div class="contact-info-icon">
                            <i class="fa-duotone fa-buildings"></i>
                        </div>
                        <div class="contact-info-content media-body">
                            <p class="text" style="font-size: 20px;margin-top: 12px;">
                                <?= __('Av. Visconde do Rio Branco, 123 - Centro, Niterói - RJ, 24020-000') ?>
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
