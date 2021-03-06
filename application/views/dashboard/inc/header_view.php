<!DocType html>
<html lang="en">
<head>
    <title>Paper - Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>

    <link rel="stylesheet" href="<?= base_url() ?>public/lib/bootstrap/bootstrap.css"/>
    <link rel="stylesheet" href="<?= base_url() ?>public/lib/bootstrap/bootstrap-theme.css"/>

    <link rel="stylesheet" href="<?= base_url() ?>public/css/style.css"/>

    <script src="<?= base_url() ?>public/lib/jquery/jquery.min.js"></script>
    <script src="<?= base_url() ?>public/lib/bootstrap/bootstrap.js"></script>


    <script src="<?= base_url() ?>public/js/dashboard/template.js"></script>
    <script src="<?= base_url() ?>public/js/dashboard/events.js"></script>
    <script src="<?= base_url() ?>public/js/dashboard/result.js"></script>

    <script src="<?= base_url() ?>public/js/dashboard.js"></script>

    <link href="<?=base_url()?>public/img/favicon_red.png" rel="shortcut icon">

</head>
<body>
<?php
$this->load->view('inc/navbar_view', ['login' => $login]);
?>

<style>
        .navbar-right {
            float: right !important;
            margin-right: 0px;
        }
</style>
