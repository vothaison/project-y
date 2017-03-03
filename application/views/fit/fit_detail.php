<?php
$this->load->view('single/html2text.php');

?>

<?php


$dom = pQuery::parseStr($html);

$trArray = $dom->query('#attachments tr');
$attachments = [];

for ($i = 1, $count = count($trArray); $i < $count; $i++) {
    $tr = $trArray[$i];
    $a = $tr->query('td a');
    $href = $a->attr('href');

    $href = str_replace(' ', '%20', $href);

    $attachments[] = [
        'fileName' => trim($a->text()),
        'fileUrl' => $href
    ];
}

$title = trim($dom->query('.title')->text());
$submitted = trim($dom->query('.submitted')->html());

$contentDom = $dom->query('.content')[0];
$contentHtml = trim($contentDom->html());
$contentDom->query('#attachments')->remove();

$contentHtmlText = $dom->query('.content')[0];


$anchors = $contentHtmlText->query('a');
foreach ($anchors as $anchor) {
    if(trim($anchor->text()) === trim($anchor->attr('href'))){

    }else{
        $newText = $anchor->html() . ' ('. trim($anchor->attr('href')) .')';
        $anchor->html($newText);
    }
}

$paragraphs = $contentHtmlText->query('p');
foreach ($paragraphs as $paragraph) {
    $newHtml = $paragraph->html();
    $paragraph->html($newHtml);
}

$contentHtmlText->query('table.sticky-header')->remove();
$contentText = trim($contentHtmlText->text());

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">

<head>

    <meta charset="utf-8">
     <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, shrink-to-fit=no, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Enhanced F.I.T - <?=$title?> </title>

    <link rel="stylesheet" href="<?= base_url() ?>public/css/single-fit/bootstrap.min.css"/>
    <link rel="stylesheet" href="<?= base_url() ?>public/css/style.css"/>

    <link rel="stylesheet" href="<?= base_url() ?>public/css/single-fit/sidebar.css"/>
    <link rel="stylesheet" href="<?= base_url() ?>public/css/single-fit/main.css"/>

    <link href="<?=base_url()?>public/img/favicon.png" rel="shortcut icon">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

<?php
$this->load->view('inc/navbar_view', [
    'login' => $login,
    'app_name' => $app_name]);
?>

<div class="container" style="margin-top: 65px">
    <div class="row">
        <div class="col-xs-12 col-md-6 col-centered">
            <a href="<?= site_url("fit/index") ?>" class="btn btn-success" style="display: inline-block; margin-bottom: 13px;">Back</a>

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><?= $title ?></h3>
                </div>

                <div class="panel-body" style="padding: 5px 15px">
                    <i style="color: gray; font-size: 11px; display: inline-block; margin-bottom: 10px;"><?= $submitted ?></i>
                    <br/>

                    <?= $contentHtml ?>

                    &#128279;
                </div>

                <div class="panel-footer"></div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title" style="line-height: 2em;">For facebook
                        <button id="btn-copy-text" class="btn btn-default" data-clipboard-target="#fit_details"
                                style="float:right;">
                            Copy
                        </button>
                        <div class="clearfix"></div>
                    </h3>
                </div>

                <?php
                $copyValue = $fit_url . "\n\n" . $title . "\n" . '(' . $submitted . ')' . "\n\n" . '{{$contentText}}' . "\n\n";

                if (count($attachments)) {
                    $copyValue .= 'ATTACHMENTS' . "\n\n";
                    for ($i = 0, $count = count($attachments); $i < $count; $i++) {
                        $copyValue .= $attachments[$i]['fileName'] . "\n";
                        $copyValue .= $attachments[$i]['fileUrl'] . "\n";
                    }
                }
                ?>

                <div class="panel-body">
                    <textarea id="fit_details" name="textarea"
                              style="width:100%;height:350px;"><?= $copyValue ?></textarea>
                </div>
            </div>
        </div>
    </div>
</div>

<div style="display: none" id="fit_details_contentHtmlText">
    <?= $contentHtmlText->html() ?>
</div>

<script src="<?= base_url() ?>public/js/single/fit/jquery.min.js"></script>
<script src="<?= base_url() ?>public/js/single/fit/bootstrap.min.js"></script>
<script src="<?= base_url() ?>public/js/single/fit/clipboard.min.js"></script>
<script src="<?= base_url() ?>public/js/single/fit/main.js"></script>

</body>
</html>
