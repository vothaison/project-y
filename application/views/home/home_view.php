<div class="container-fluid">
    <div class="row">
        <div class="col-xs-12 col-md-6 col-centered">
            <br/>

            <form class="form-horizontal" method="post" id="login_form" action="<?= site_url('api/login') ?>">
                <div id="legend">
                    <legend class="">Please Login</legend>
                </div>
                <div class="form-group">
                    <label for="LoginName" class="col-sm-2 control-label">Login name</label>

                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="login" id="LoginName" placeholder="Login name">
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
                    <div class="col-sm-offset-2 col-sm-10">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox"> Remember me
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-default">Sign in</button>
                    </div>
                </div>
            </form>

            <a href="<?= site_url('home/register') ?>">Register</a>
        </div>
    </div>
    <br/>

</div>


<script>
    $(function () {
        return;
        function getParameterByName(name, url) {
            if (!url) {
                url = window.location.href;
            }
            name = name.replace(/[\[\]]/g, "\\$&");
            var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
                results = regex.exec(url);
            if (!results) return null;
            if (!results[2]) return '';
            return decodeURIComponent(results[2].replace(/\+/g, " "));
        }

        var serialize = function (obj) {
            var str = [];
            for (var p in obj)
                if (obj.hasOwnProperty(p)) {
                    str.push(encodeURIComponent(p) + "=" + encodeURIComponent(obj[p]));
                }
            return str.join("&");
        };

        $('#login_form').submit(function (e) {
            try {
                e.preventDefault();
                var returnUrl = getParameterByName('returnUrl');
                var url = $(this).attr('action');
                var postData = $(this).serialize();
                if (returnUrl) {
                    var returnUrlQuery = serialize({returnUrl: returnUrl});
                    postData += '&' + returnUrlQuery;
                }
            } catch (ex) {
                alert(ex);
            }

            var http = new XMLHttpRequest();
            http.open("POST", url, true);

            http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

            http.onreadystatechange = function() {//Call a function when the state changes.
                if(http.readyState == 4 && http.status == 200) {
                    var o = JSON.parse(http.responseText);
                    if (o.result === 1) {
                        window.location.href = o.returnUrl || '<?= site_url('dashboard') ?>';
                    } else {
                        alert('Nice try. But please try again!')
                    }
                }
            };

            http.send(postData);
        });
    });
</script>

<style>
    input[type="radio"], input[type="checkbox"] {
        margin: 0px 0 0;
    }
</style>