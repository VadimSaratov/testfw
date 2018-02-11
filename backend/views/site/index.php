<div class="panel panel-default">
    <div class="panel-heading main-color-bg">Список баннеров</div>
    <div class="panel-body">
        <table class="table table-striped table-hover">
            <thead>
            <tr class="thead">
                <th>Картинка</th>
                <th>Название</th>
                <th>URL</th>
                <th><span class="glyphicon glyphicon-cog"></th>
                <th class="hidden-xs">Статус</th>
                <th class="hidden-xs">Позиция</th>
                <th class="hidden-xs"></th>

            </tr>
            </thead>
            <tbody>
            <? foreach ( $banners as $value ): ?>
            <tr class="<?= $value['status'] == 1 ? 'success' : 'active'?>" data-id="<?= $value['id'] ?>" data-pos="<?= $value['position'] ?>">
                <td><img id="smImg" alt="Banner image" src="/images/<?= $value['image'] ?>"></td>
                <td><?= $value['name'] ?></td>
                <td><a href="<?= $value['url'] ?>"><?= $value['url'] ?></a></td>
                <td align="center">
                    <button type="button" class="btn btn-primary btn-xs" onclick="location.href='/admin/banner/edit?id=<?= $value['id'] ?>'">
                        <span class="glyphicon glyphicon-edit"></span>
                    </button>
                    <button type="button" class="btn btn-danger btn-xs"
                            onclick="location.href='/admin/banner/delete?id=<?= $value['id'] ?>'">
                        <span class="glyphicon glyphicon-remove-circle"></span>
                    </button>
                </td>
                <td><input id="status" type="checkbox" data-size="mini" name="status" <?= $value['status'] == 1 ? 'checked' : ''?>></td>
                <td class="pos"><?= $value['position'] ?></td>
                <td>
                    <button id="up" type="button" class="btn btn-success btn-xs"><span
                                class="glyphicon glyphicon-circle-arrow-up"></span></button>
                    <button id="down" type="button" class="btn btn-success btn-xs"><span
                                class="glyphicon glyphicon-circle-arrow-down"></span></button>
                </td>
            </tr>
            <? endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<!-- Modal for img -->
<div class="modal" id="imagemodal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <img id="bgImg" src="" alt="">
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script src="/admin/js/move_pos.js"></script>
<script src="/admin/js/setStatus.js"></script>


