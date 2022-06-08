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
    <?= $this->Html->css('dashboard/nucleo-icons.css'); ?>
    <?= $this->Html->css('dashboard/nucleo-svg.css'); ?>

    <?= $this->Html->css('dashboard/material-dashboard.css?v=3.0.2'); ?>
    <?= $this->Html->css('dashboard/select2.min.css'); ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('custom_css') ?>
</head>
<body class="g-sidenav-show bg-gray-200 dark-version">
    <!--====== SIDEBAR START ======-->
    <?= $this->element('sidebar-dashboard'); ?>
    <!--====== NAVBAR ENDS ======-->

<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
    <!--====== SIDEBAR START ======-->
    <?= $this->element('navbar-dashboard'); ?>
    <!--====== NAVBAR ENDS ======-->

    <div class="container-fluid py-4">
        <?= $this->Flash->render() ?>
        <?= $this->fetch('content') ?>
    </div>
</main>

<!-- Core JS Files -->
<?= $this->Html->script('core/jquery.js'); ?>
<?= $this->Html->script('core/popper.min.js'); ?>
<?= $this->Html->script('core/bootstrap.min.js'); ?>

<!-- Plugin -->
<!-- Alert-->
<?= $this->Html->script('dashboard/plugins/sweetalert2.all.min.js'); ?>

<!-- Form-->
<?= $this->Html->script('dashboard/plugins/wickedpicker.min.js'); ?>
<?= $this->Html->script('dashboard/plugins/select2.min.js'); ?>
<?= $this->Html->script('dashboard/plugins/jquery.mask.js'); ?>
<?= $this->Html->script('dashboard/plugins/jquery-confirm.js'); ?>
<?= $this->Html->script('dashboard/plugins/jquery.ui.js'); ?>

<!-- Tools-->
<?= $this->Html->script('dashboard/plugins/perfect-scrollbar.min.js'); ?>
<?= $this->Html->script('dashboard/plugins/smooth-scrollbar.min.js'); ?>
<?= $this->Html->script('dashboard/plugins/chartjs.min.js'); ?>

<?= $this->Html->script('dashboard/material-dashboard.js?v=3.0.2'); ?>
<?= $this->Html->script('dashboard/application.js'); ?>

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
