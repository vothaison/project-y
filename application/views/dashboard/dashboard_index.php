<div class="container-fluid" style="margin-top: 70px">
    <div class="row">
        <div class="col-xs-12 col-md-6 col-centered">
            <div class="list-group">
                <a href="#" class="list-group-item active">
                    Choose an Application
                </a>
                <a href="<?= site_url("dashboard/paper") ?>" class="list-group-item">Paper</a>
                <a href="<?= site_url("fit/index") ?>" class="list-group-item">F.I.T</a>
                <a href="<?= site_url("question/index") ?>" class="list-group-item">Question Collections</a>
                <a href="<?= site_url("user") ?>" class="list-group-item">Users</a>
            </div>
        </div>
    </div>
</div>
<style>
    body {
        background: rgb(204, 204, 204);
    }

    page[size="A4"] {
        background: white;
        width: 21cm;
        min-height: 29.7cm;
        display: block;
        margin: 0 auto;
        margin-bottom: 0.5cm;
        box-shadow: 0 0 0.5cm rgba(0, 0, 0, 0.5);
        padding: 30px 20px;
    }

    @media print {
        body, page[size="A4"] {
            margin: 0;
            box-shadow: 0;
        }
    }


</style>