
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, shrink-to-fit=no, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>User - Details</title>
    <link rel="stylesheet" href="<?= base_url() ?>public/css/single-fit/bootstrap.min.css"/>
    <link rel="stylesheet" href="<?= base_url() ?>public/css/style.css"/>

    <link rel="stylesheet" href="<?= base_url() ?>public/css/single-fit/sidebar.css"/>
    <link rel="stylesheet" href="<?= base_url() ?>public/css/single-fit/main.css"/>

    <link href="<?=base_url()?>public/img/favicon_red.png" rel="shortcut icon">


</head>

<body>

<?php
$this->load->view('inc/navbar_view', [
    'login' => $login,
    'app_name' => $app_name]);
?>

<div class="container" style="margin-top: 65px" id="application"></div>

<script src="<?= base_url() ?>public/js/single/fit/jquery.min.js"></script>
<script src="<?= base_url() ?>public/js/single/fit/bootstrap.min.js"></script>
<script src="<?= base_url() ?>public/lib/waitingfor.js"></script>
<script src="<?= base_url() ?>public/lib/ember/ember-template-compiler.js"></script>
<script src="<?= base_url() ?>public/lib/ember/ember.debug.js"></script>

<script>
    Data = {};

    Data.SessionData = {
        DetailsUrl: "<?= site_url('user/detail')  ?>",
        BackUrl: "<?= $data['back_url'] ?>",
        ListUrl: "<?= site_url('user/index')  ?>",
        PostCreateUrl: "<?= site_url('user/post_create') ?>",

        PageData: {

        },
        SiteUrl: "<?= site_url() ?>"
    };
</script>

<script type="text/x-handlebars">
    {{outlet}}
</script>

<script type="application/javascript" src="<?= site_url("JavascriptBundle?app_name=".urlencode('user-create')) ?>"></script>
<script type="application/javascript" src="<?= site_url("JavascriptBundle/templates?app_name=".urlencode('user-create')) ?>"></script>

<style>
.modal-open {
    overflow: visible;
}
.modal-open, .modal-open .navbar-fixed-top, .modal-open .navbar-fixed-bottom {
    padding-right:0px!important;
}
</style>

<script>

</script>
</body>
</html>
