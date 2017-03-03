<!DOCTYPE html>
<html lang="vi">

<head>

    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, shrink-to-fit=no, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Simple Question Details </title>

    <link rel="stylesheet" href="<?= base_url() ?>public/css/single-fit/bootstrap.min.css"/>
    <link rel="stylesheet" href="<?= base_url() ?>public/css/style.css"/>

    <link rel="stylesheet" href="<?= base_url() ?>public/css/single-fit/sidebar.css"/>
    <link rel="stylesheet" href="<?= base_url() ?>public/css/single-fit/main.css"/>

    <link href="<?= base_url() ?>public/img/favicon_red.png" rel="shortcut icon">

</head>

<body>

<?php
$this->load->view('inc/navbar_view', [
    'login' => $login,
    'app_name' => $app_name
]);
?>

<div class="container" style="margin-top: 50px">
    <div class="col-xs-12 col-sm-9 col-md-6 col-centered">
        <div class="row" style="margin-top: 15px">
            <?php
            $back_url = site_url("user/index");
            $back_url .= '?';
            $back_url .= 'limit=' . $data['limit'];
            $back_url .= '&page=' . $data['page'];
            $back_url .= '&keyword=' . $data['keyword'];

            $href = site_url("user/create");
            $href .= '?';
            $href .= '&back_url=' . urlencode($back_url);
            ?>


        </div>

        <div class="row" style="margin-top: 15px">
            <form action="?limit=2&page=2" class="form-inline">
                <input type="hidden" name="limit" value="<?= $data['limit'] ?>"/>
                <input type="hidden" name="page" value="<?= $data['page'] ?>"/>

                <div class="form-group col-xs-9 .col-sm-10 col-md-9"
                     style="padding-left: 0; padding-right: 0; margin-bottom: 10px;">
                    <div class="input-group" style="width: 100%">
                        <input type="text" class="form-control" name="keyword" value="<?= $data['keyword'] ?>"
                               autofocus/>
                    </div>
                </div>
                <div class="form-group col-xs-3 .col-sm-2 col-md-3" style="padding-right: 0; margin-bottom: 10px;">
                    <button type="submit" class="btn btn-default" style="width: 100%">Search</button>
                </div>
            </form>
        </div>

        <div class="row">
            <div class="col-xs-7 col-md-8" style="padding-left: 0; padding-right: 0;">
                <nav aria-label="Page navigation">
                    <ul class="pagination" style="margin: 0px 0 5px 0">
                        <?php if ($data['page'] != 1) {
                            $query = '?';
                            $query .= 'limit=' . $data['limit'];
                            $query .= '&page=' . ($data['page'] - 1);
                            $query .= '&keyword=' . $data['keyword'];

                            ?>
                            <li>
                                <a href="<?= $query ?>"
                                   aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>
                        <?php } ?>

                        <?php
                        for ($i = 1; $i <= $data['page_count']; $i++) {
                            $query = '?';
                            $query .= 'limit=' . $data['limit'];
                            $query .= '&page=' . $i;
                            $query .= '&keyword=' . $data['keyword'];

                            $active = ($data['page'] == $i) ? 'class="active"' : '';

                            echo '<li ' . $active . ' ><a href="' . $query . '">' . $i . '</a></li>';
                        }
                        ?>

                        <?php if ($data['page'] < $data['page_count']) {
                            $query = '?';
                            $query .= 'limit=' . $data['limit'];
                            $query .= '&page=' . ($data['page'] + 1);
                            $query .= '&keyword=' . $data['keyword'];
                            ?>
                            <li>
                                <a href="<?= $query ?>"
                                   aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                </nav>

            </div>
            <div class="col-xs-5 col-md-4" style="text-align: right; padding-left: 0; padding-right: 0;">

                <div class="btn-group" style="margin: 0px 0 5px 0;">
                    <button type="button" class="btn btn-default">
                        <?= $data['limit'] ?>
                    </button>

                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false"><span class="caret"></span> <span
                            class="sr-only">Toggle Dropdown</span></button>
                    <ul class="dropdown-menu">

                        <?php
                        for ($i = 0; $i < count($data['limit_array']); $i++) {
                            $query = '?';
                            $query .= 'limit=' . $data['limit_array'][$i];
                            $query .= '&page=' . $data['page'];
                            $query .= '&keyword=' . $data['keyword'];

                            echo '<li>';
                            echo '<a href="' . $query . '">' . $data['limit_array'][$i] . '</a>';
                            echo '</li>';
                        }
                        ?>
                    </ul>
                </div>

            </div>
        </div>

        <div class="row">
            <ul class="list-group">
                <?php
                foreach ($data['list'] as $item) {
                    $back_url = site_url("question/index");
                    $back_url .= '?';
                    $back_url .= 'limit=' . $data['limit'];
                    $back_url .= '&page=' . $data['page'];
                    $back_url .= '&keyword=' . $data['keyword'];

                    $href = site_url("question/detail");
                    $href .= '?';
                    $href .= 'question_id=' . urlencode($item['question_id']);
                    $href .= '&back_url=' . urlencode($back_url);

                    echo '<li class="list-group-item">';
                    echo '<span>' . $item['question_text'] . '&nbsp;&nbsp;' . '</span>';
                    echo '<span class="label label-success" style="display: inline-block; line-height: 1.5em; padding: 0;">';
                    echo '<a style="display: inline-block; padding: 4px 7px;" href="' . $href . '">';
                    echo 'View';
                    echo '</a>';
                    echo '</span>';
                    echo '</li>';
                }
                ?>

            </ul>
        </div>

        <div class="row">
            <div class="breadcrumb">
                <li class="active">Total <b><?= $data['total'] ?></b></li>
            </div>
        </div>
    </div>
</div>

<script src="<?= base_url() ?>public/js/single/fit/jquery.min.js"></script>
<script src="<?= base_url() ?>public/js/single/fit/bootstrap.min.js"></script>

</body>
<style>
</style>
</html>
