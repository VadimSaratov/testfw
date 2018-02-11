<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<?php
	\vendor\core\base\View::getMeta();
	?>
    <!-- Bootstrap core CSS -->
    <link type="text/css" href="/admin/assets/bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">
    <link type="text/css" href="/admin/css/style.css" rel="stylesheet">
    <link type="text/css" href="/admin/assets/bootstrap-switch-master/dist/css/bootstrap3/bootstrap-switch.min.css" rel="stylesheet">

</head>
<body>
<nav class="navbar navbar-default">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                    aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Admin Panel</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="#">Welcome, <?=$_SESSION['user']['name']?></a></li>
                <li><a href="/admin/logout/"><span class="glyphicon glyphicon-off" aria-hidden="true"></span></a></li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>
<header id="header">
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h1><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Админка
                    <small>Ротатор баннеров</small>
                </h1>
            </div>
            <div class="col-md-2">
                <!-- Single button -->
                <div class="btn create">
                    <button type="button" class="btn btn-success btn-md" data-toggle="modal" data-target="#addBanner">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Добавить
                    </button>
                </div>
            </div>
        </div>
    </div>

</header>

<section id="main">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="list-group">
                    <a href="/admin/" class="list-group-item active main-color-bg">
                        <span class="glyphicon glyphicon-cog" aria-hidden="true"> Админка
                    </a>
                    <a href="/admin/" class="list-group-item">
                        <span class="glyphicon glyphicon-home" aria-hidden="true"></span> Главная</a>
                    <a href="/admin/banner/add/" class="list-group-item">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Добавить баннер</a>
                </div>
            </div>
            <div class="col-md-9">
	            <?= $content ?>
            </div>
        </div>
    </div>
</section>
<!-- Modal -->
<!-- Add banner -->
<div class="modal fade" id="addBanner" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="modalForm" enctype="multipart/form-data">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Добавить баннер</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <span class="hide-error">Напишите название</span>
                        <label for="name">Название: </label>
                        <input type="text" id="name" class="form-control" placeholder="Название" name="name">
                    </div>
                    <div class="form-group">
                        <span class="hide-error">Укажите URL</span>
                        <label for="url">URL: </label>
                        <input type="text" id="url" class="form-control" placeholder="URL" name="url">
                    </div>
                    <div class="form-group">
                        <span class="hide-error">Выберите позицию</span>
                        <label for="position">Позиция: </label>
                        <input type="number" id="position" class="form-control" placeholder="" name="position">
                    </div>
                    <div class="form-group">
                        <label for="status">Статус: </label>
                        <div class="form-group">
                            <input id="status"  type="checkbox" data-size="mini" name="status" checked >
                        </div>
                    </div>
                    <div class="form-group">
                        <span class="hide-error">Выберите файл</span>
                        <label>Картинка:</label>
                        <div class="input-group">
                             <span class="input-group-btn">
                                <span class="btn btn-default btn-file">
                                 Browse… <input type="file" id="imgInp">
                                </span>
                             </span>
                            <span id="fileName" class="form-control" readonly></span>
                        </div>
                        <img id='img-upload'/>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                    <button type="submit" class="btn btn-primary">Добавить</button>
                </div>
            </form>
        </div>
    </div>
</div>

<footer id="footer">
    <p>Copyright Vadim, &copy; <?= date('Y')?> </p>
</footer>
<script type="text/javascript" src="/admin/js/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="/admin/assets/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/admin/js/fileInput.js"></script>
<script src="/admin/assets/bootstrap-switch-master/dist/js/bootstrap-switch.js"></script>
<script src="/admin/js/modalimg.js"></script>
<script src="/admin/js/validateModal.js"></script>

<?php
foreach ($scripts as $script){
    echo $script;
}
?>
<script>
    $(document).ready(function () {
        $("[name='status']").bootstrapSwitch();
    });
</script>
</body>
</html>