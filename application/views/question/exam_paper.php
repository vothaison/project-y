<!DOCTYPE html>
<html>
<head>
    <?php
    $this->load->view('question/inc/html_head', [
        'app_name' => $app_name
    ]);
    ?>
    <link rel="stylesheet" href="<?= base_url() ?>public/css/question/exam-paper.css"/>

</head>
<body>

<?php
$this->load->view('inc/navbar_view', [
    'login' => $login,
    'app_name' => $app_name
]);
?>

<div id="application"></div>
<script type="text/x-handlebars">
    {{outlet}}
</script>

<?php
$this->load->view('question/inc/common_page_body', []);
$this->load->view('question/inc/ember_jquery_lib', []);
$this->load->view('question/inc/ember_bundle', ['bundle_name' => 'exam-paper']);
?>

</body>
</html>
