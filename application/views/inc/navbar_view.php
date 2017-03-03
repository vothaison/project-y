<?php
if (isset($app_name)) {
    $app_name = $app_name ? $app_name : 'myPlan';
} else {
    $app_name = 'myPlan';
}
?>
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                    aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#"><?= $app_name ?></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li><a href="<?= site_url("dashboard/index") ?>">Dashboard</a></li>
                <li><a href="<?= site_url("dashboard/logout") ?>">Logout</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="<?= site_url("user/manage_account") ?>">Signed in as <b><?= $login ?></b></a></li>
            </ul>
        </div>
        <!--/.nav-collapse -->
    </div>
</nav>