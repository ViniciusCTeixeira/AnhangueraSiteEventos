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
        <?php if (!empty($speeches)) { ?>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <ul class="timeline">
                        <?php foreach ($speeches as $key => $speech) {?>
                        <li class="<?= ($key%2 === 0) ? 'timeline-inverted' : ''?>">
                            <div class="timeline-image">
                                <img class="rounded-circle img-fluid" src="<?= SITE_URL ?>img/speaker/<?= (!empty($speech['img']))? $speech['img'] : 'avatar-user.png' ?>" alt="">
                            </div>
                            <div class="timeline-panel">
                                <div class="timeline-heading">
                                    <h4 class="text-success"><?= h($speech['name']) ?></h4>
                                    <h5 class="text-info"><?= h($speech['speaker']) ?></h5>
                                </div>
                                <div class="timeline-body">
                                    <p>
                                        <?= h($speech['description']) ?>
                                    </p>
                                    <p class="text-warning">
                                        <?= h($this->Date->formatDate($speech['day'])) ?>
                                    </p>
                                </div>
                            </div>
                        </li>
                        <?php }?>
                    </ul>
                </div>
            </div>
        <?php } ?>
    </div>
</section>

<?php if (!empty($oldSpeeches)) { ?>
    <section id="oldSpeeches" class="page-box page-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="section-title text-center pb-10">
                        <h3 class="title"><?= __('Palestras Antigas') ?></h3>
                        <hr>
                        <p>
                            <?= __('Comfira algumas das palestras já feitas.') ?>
                        </p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <ul class="timeline">
                        <?php foreach ($oldSpeeches as $key => $oldSpeech) {?>
                            <li class="<?= ($key%2 === 0) ? 'timeline-inverted' : ''?>">
                                <div class="timeline-image">
                                    <img class="rounded-circle img-fluid" src="<?= SITE_URL ?>img/speaker/<?= (!empty($oldSpeech['img']))? $speech['img'] : 'avatar-user.png' ?>" alt="">
                                </div>
                                <div class="timeline-panel">
                                    <div class="timeline-heading">
                                        <h4 class="text-success"><?= h($oldSpeech['name']) ?></h4>
                                        <h5 class="text-info"><?= h($oldSpeech['speaker']) ?></h5>
                                    </div>
                                    <div class="timeline-body">
                                        <p>
                                            <?= h($oldSpeech['description']) ?>
                                        </p>
                                        <p class="text-warning">
                                            <?= h($this->Date->formatDate($oldSpeech['day'])) ?>
                                        </p>
                                    </div>
                                </div>
                            </li>
                        <?php }?>
                    </ul>
                </div>
            </div>
        </div>
    </section>
<?php } ?>

<section id="events" class="page-box page-dark">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="section-heading">
                    <h2 class="marginTopDefault"><?= __('Nosso Eventos'); ?></h2>
                    <hr>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-mdCotação enviada-12 col-sm-12 col-xs-12 marginBottomDefault">
                        <p style="line-height: 22px;font-size: 18px;" class="marginBottomDefault">
                            <?php if(!empty($events)) {?>
                                <?= __('Gonfira os eventos que temos para essa semana.'); ?>
                            <?php } else { ?>
                                <?= __('Poxa, não temos eventos agendadas para essa semana.') ?>
                            <?php } ?>
                        </p>
                    </div>
                </div>
                <div class="row">
                    <?php foreach ($events as $event) {?>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <div class="feature">
                                <i class="<?= $event['icon'] ?>"></i>
                                <div class="feature-content">
                                    <h4 class="text-success"><?= h($event['name']) ?></h4>
                                    <p><?= h($event['description']) ?></p>
                                    <p class="text-warning"><?= h($this->Date->formatDate($event['day'])) ?></p>
                                </div>
                            </div>
                        </div>
                    <?php }?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php if (!empty($oldEvents)){?>
    <section id="oldEvents" class="page-box page-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="section-heading">
                        <h2 class="marginTopDefault"><?= __('Eventos Antigos'); ?></h2>
                        <hr>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-mdCotação enviada-12 col-sm-12 col-xs-12 marginBottomDefault">
                            <p style="line-height: 22px;font-size: 18px;" class="marginBottomDefault">
                                <?= __('Gonfira alguns dos eventos ja feitos.'); ?>
                            </p>
                        </div>
                    </div>
                    <div class="row">
                        <?php foreach ($events as $event) {?>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="feature">
                                    <i class="<?= $event['icon'] ?>"></i>
                                    <div class="feature-content">
                                        <h4 class="text-success"><?= h($event['name']) ?></h4>
                                        <p><?= h($event['description']) ?></p>
                                        <p class="text-warning"><?= h($this->Date->formatDate($event['day'])) ?></p>
                                    </div>
                                </div>
                            </div>
                        <?php }?>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php }?>

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
