<div class="container-fluid">
    <div class="row">
        <div class="col-xs-12 col-md-6 col-centered">
            <br/>

            <form class="form-horizontal" action="<?= site_url('api/register') ?>" method="POST" id="register_form">
                <ul class="alert alert-error" id="register-form-error">

                </ul>
                <fieldset>
                    <div id="legend">
                        <legend class="">Register</legend>
                    </div>

                    <div class="form-group">
                        <label for="LoginName" class="col-sm-2 control-label">Login name</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="login" id="LoginName"
                                   placeholder="Login name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="Email" class="col-sm-2 control-label">Email</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="email" id="Email" placeholder="Email">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-2 control-label">Password</label>

                        <div class="col-sm-10">
                            <input type="password" class="form-control" name="password" id="inputPassword3"
                                   placeholder="Password">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="confirm_password" class="col-sm-2 control-label">Confirm Password</label>

                        <div class="col-sm-10">
                            <input type="password" class="form-control" name="confirm_password" id="confirm_password"
                                   placeholder="Confirm Password">
                        </div>
                    </div>

                    <div class="control-group">
                        <!-- Button -->
                        <div class="controls">
                            <button class="btn btn-success">Register</button>
                        </div>
                    </div>
                </fieldset>
            </form>
            <br />
            <a href="<?= site_url('home/index') ?>">Login</a>

        </div>
    </div>
</div>

<script>
    $(function () {

        var errorContainer = $('#register-form-error')
        errorContainer.hide();

        $('#register_form').submit(function (e) {
            e.preventDefault();
            errorContainer.hide().html('');
            var url = $(this).attr('action');
            var postData = $(this).serialize();

            $.post(url, postData, function (o) {
                if (o.result === 1) {
                    window.location.href = '<?= site_url('dashboard') ?>';
                } else {
                    errorContainer.show();
                    for (var key in o.data) {
                        var error = '<li>' + o.data[key] + '</li>';
                        errorContainer.append(error);
                    }
                }
            }, 'json');
        });
    });
</script>