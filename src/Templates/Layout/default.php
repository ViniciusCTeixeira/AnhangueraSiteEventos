<!DOCTYPE html>
<html lang="en">
<head>
    <?= $this->Html->charset() ?>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <meta property="busca:title" content="<?= ($og_title ?? ''); ?>">

    <title><?= ($og_title ?? ''); ?></title>

    <meta property="og:url" content="<?= ($og_url ?? ''); ?>"/>
    <meta property="og:type" content="<?= ($og_type ?? ''); ?>"/>
    <meta property="og:site_name" content="<?= ($og_site_name ?? ''); ?>"/>
    <meta property="og:title" content="<?= ($og_title ?? ''); ?>"/>
    <meta property="og:description" content="<?= ($og_description ?? ''); ?>"/>
    <meta property="og:image" content="<?= ($og_image ?? ''); ?>"/>

    <?= $this->Html->meta('icon') ?>

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">

    <link rel="stylesheet" href="https://kit-pro.fontawesome.com/releases/v6.0.0/css/pro.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">

    <!--====== Slick CSS ======-->
    <?= $this->Html->css('default/slick.css') ?>

    <!--====== Line Icons CSS ======-->
    <?= $this->Html->css('default/LineIcons.css') ?>

    <!--====== Bootstrap CSS ======-->
    <?= $this->Html->css('default/bootstrap.min.css') ?>
    <?= $this->Html->css('default/bootstrap-extend.css') ?>

    <!--====== Default CSS ======-->
    <?= $this->Html->css('default/default.css') ?>

    <!--====== Style CSS ======-->
    <?= $this->Html->css('default/style.css') ?>
    <?= $this->Html->css('default/pnotify.custom.min.css') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('custom_css') ?>
</head>
<body>
<?= $this->element('navbar'); ?>

<?= $this->Flash->render() ?>
<?= $this->fetch('content') ?>

<?= $this->element('footer'); ?>

<a href="#" class="back-to-top"><i class="fad fa-arrow-up"></i></a>

<!-- Core JS Files -->
<?= $this->Html->script('core/jquery.js'); ?>
<?= $this->Html->script('core/popper.min.js'); ?>
<?= $this->Html->script('core/bootstrap.min.js'); ?>

<!--====== Jquery js ======-->
<?php echo $this->Html->script('default/plugins/jquery.mask.js'); ?>
<?php echo $this->Html->script('default/plugins/jquery.ajaxSubmit.js'); ?>
<?php echo $this->Html->script('default/plugins/jquery.validate.js'); ?>
<?php echo $this->Html->script('default/plugins/sweetalert.js'); ?>
<?php echo $this->Html->script('default/plugins/pnotify.custom.min.js'); ?>

<!--====== Main js ======-->
<?php echo $this->Html->script('default/application.js'); ?>

<?php $this->start('script'); ?>
<script>
    $(function () {
        application.webroot = "<?= SITE_URL ?>";
    });
</script>
<?php $this->end(); ?>

<?= $this->fetch('script') ?>
<?= $this->fetch('custom_script') ?>
</body>
</html>
