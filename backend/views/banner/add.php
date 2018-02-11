
<div class="panel panel-default">
    <div class="panel-heading main-color-bg">Добавить баннер</div>
    <div class="panel-body">
        <form method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">Название: </label>
                <input type="text" id="name" class="form-control" placeholder="Название" name="name" value="<?=isset($_POST['name']) ? $_POST['name'] : ''?>" >
                <span class="text-danger"><?=isset($errors['name']) ? $errors['name'] : ''?></span>
            </div>
            <div class="form-group">
                <label for="url">URL: </label>
                <input type="text" id="url" class="form-control" placeholder="URL" name="url" value="<?=isset($_POST['url']) ? $_POST['url'] : ''?>">
                <span class="text-danger"><?=isset($errors['url']) ? $errors['url'] : ''?></span>
            </div>
            <div class="form-group">
                <label for="position">Позиция: </label>
                <input type="number" id="position" class="form-control" placeholder="" name="position" value="<?=isset($_POST['position']) ? $_POST['position'] : ''?>">
                <span class="text-danger"><?=isset($errors['position']) ? $errors['position'] : ''?></span>
            </div>
            <div class="form-group">
                <label for="status">Статус: </label>
                <div class="form-group">
                    <input id="status" type="checkbox" data-size="mini" name="status" checked >
                </div>
            </div>
            <div class="form-group">
                <label>Выберите картинку:</label>
                <div class="input-group">

                             <span class="input-group-btn">
                                <span class="btn btn-default btn-file">
                                 Browse… <input type="file" id="imgInp" name="image" >
                                </span>
                             </span>
                    <input type="text" class="form-control" readonly>

                </div>
                <span class="text-danger"><?=isset($errors['image']) ? $errors['image'] : ''?></span>
                <img id='img-upload' src=""/>
            </div>
            <button type="submit" class="btn btn-success">Добавить</button>
        </form>

    </div>
</div>