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

<div class="container" style="margin-top: 65px" id="application">
</div>

<script src="<?= base_url() ?>public/js/single/fit/jquery.min.js"></script>
<script src="<?= base_url() ?>public/js/single/fit/bootstrap.min.js"></script>
<script src="<?= base_url() ?>public/lib/waitingfor.js"></script>
<script src="<?= base_url() ?>public/lib/ember/ember-template-compiler.js"></script>
<script src="<?= base_url() ?>public/lib/ember/ember.debug.js"></script>

<script>
    Data = {};

    Data.Roles = <?= json_encode($data['roles']) ?>;
    Data.PrivilegeActions = <?= json_encode($data['privilege_actions']) ?>;

    Data.SessionData = {
        Login: "<?= $data['user_info']['login'] ?>",
        BackUrl: "<?= $data['back_url'] ?>",
        PageData: {
            UserInfo:  <?= json_encode($data['user_info']) ?>
        },
        SiteUrl: "<?= site_url() ?>"
    };
</script>

<script type="text/x-handlebars">
    {{outlet}}
</script>

<script type="application/javascript" src="<?= site_url("JavascriptBundle?app_name=".urlencode('user-details')) ?>"></script>
<script type="application/javascript" src="<?= site_url("JavascriptBundle/templates?app_name=".urlencode('user-details')) ?>"></script>

<style>
    /* override bootstrap 3 class to remove scrollbar from modal backdrop
   when not necessary */
    .modal {
        overflow-y: auto;
    }
    /* custom class to add space for scrollbar */
    .modal-scrollbar {
        margin-right: 15px;
    }
</style>

<script>
    (function($) {

        $(document)
            .on( 'hidden.bs.modal', '.modal', function() {
                $(document.body).removeClass( 'modal-scrollbar' );
            })
            .on( 'show.bs.modal', '.modal', function() {
                // Bootstrap's .modal-open class hides any scrollbar on the body,
                // so if there IS a scrollbar on the body at modal open time, then
                // add a right margin to take its place.
                if ( $(window).height() < $(document).height() ) {
                    $(document.body).addClass( 'modal-scrollbar' );
                }
            });

    })(window.jQuery);
</script>
</body>
</html>
