<!DOCTYPE html>
<html>
<head>
    <?php
    $this->load->view('question/inc/html_head', [
        'app_name' => $app_name
    ]);
    ?>
    <link rel="stylesheet" href="<?= base_url() ?>public/css/question/question-type-through.css"/>

</head>
<body>

<?php
$this->load->view('inc/navbar_view', [
    'login' => $login,
    'app_name' => $app_name
]);
?>

<script>
    Data = {};

    Data.SessionData = {
        BackUrl: "<?= site_url('question/index') ?>",
        SiteUrl: "<?= site_url() ?>",
        SaveUrl: "<?= site_url('question/save_a_question') ?>",
    };
</script>

<div class="container" style="margin-top: 65px" id="application"></div>
<script type="text/x-handlebars">
    {{outlet}}
</script>

<?php
$this->load->view('question/inc/common_page_body', []);
$this->load->view('question/inc/ember_jquery_lib', []);
$this->load->view('question/inc/ember_bundle', ['bundle_name' => 'question-type-through']);
?>

</body>
</html>

