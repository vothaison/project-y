<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, shrink-to-fit=no, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Enhanced F.I.T </title>

    <link rel="stylesheet" href="<?= base_url() ?>public/css/single-fit/bootstrap.min.css"/>
    <link rel="stylesheet" href="<?= base_url() ?>public/css/style.css"/>

    <link rel="stylesheet" href="<?= base_url() ?>public/css/single-fit/sidebar.css"/>
    <link rel="stylesheet" href="<?= base_url() ?>public/css/single-fit/main.css"/>

    <link href="<?=base_url()?>public/img/favicon.png" rel="shortcut icon">


</head>

<body>

<?php
$this->load->view('inc/navbar_view', [
    'login' => $login,
    'app_name' => $app_name
]);
?>

<div class="container" style="margin-top: 50px">
    <div class="row">
        <div class="col-xs-12 col-md-6 col-centered">
            <br/>
            <ul class="list-group">

                <?php
                foreach ($data as $item) {
                    echo '<li class="list-group-item" data-target="'. $item['url'] .'">';

                    if($item['viewed']) {
                        echo '	<span class="badge">' . $item['date'] . '</span>';
                    } else{
                        echo '	<span style="background: red" class="badge">' . $item['date'] . '</span>';
                    }

                    echo '<span>' . $item['title'] . '&nbsp;&nbsp;' . '</span>';
                    echo '<span class="label label-success" style="display: inline-block; line-height: 1.5em; padding: 0;">';
                    echo '<a style="display: inline-block; padding: 4px 7px;" href="'.
                        site_url("fit/detail?url=". urlencode($item['url'])) .
                        '&string_id='. urlencode($item['string_id']).
                        '">View</a>';
                    echo '</span>';
                    echo '</li>';
                }
                ?>

            </ul>
        </div>
    </div>
</div>

<script src="<?= base_url() ?>public/js/single/fit/jquery.min.js"></script>
<script src="<?= base_url() ?>public/js/single/fit/bootstrap.min.js"></script>

</body>
</html>
