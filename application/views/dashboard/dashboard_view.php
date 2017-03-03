<div class="container">
    <div class="row" style="margin-top: 50px">
        <div size="A4" class="col-xs-12 col-md-10 col-centered blank-page">
            <form class="form-inline" id="create_todo_form" action="api/create_todo">
                <div class="alert alert-danger display-none">
                    <ul id="alert-error">

                    </ul>
                </div>
                <div class="alert alert-success display-none">
                    <ul id="alert-success">

                    </ul>
                </div>

                <br>

                <div class="form-group">
                    <label for="exampleInputName2"></label>

                    <div class="col-sm-10">
                        <input name="content" type="text" class="form-control" placeholder="Content">
                    </div>
                </div>
                <button type="submit" class="btn btn-default">Add</button>
            </form>

            <br>
            <ul id="list_todo" class="list-group" style="margin: 0 15px;">
            </ul>
        </div>

    </div>
</div>

<link rel="stylesheet" href="<?= base_url() ?>public/css/paper.css"/>
