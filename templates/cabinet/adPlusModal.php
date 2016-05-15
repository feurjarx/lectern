<?php
/**
 * Created by PhpStorm.
 * Date: 15.05.2016
 * Time: 19:00
 */
?>

<?php ob_start() ?>
    <script src="<?php echo Constants::getHttpHost(); ?>/assets/js/ad-plus.js"></script>
<?php $afterJs = ob_get_clean(); ?>

<form class="modal fade" id="add-plus-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Добавление нового объявления о работе</h4>
            </div>

            <div class="modal-body">

                <div class="form-group">
                    <label for="ad-name-input">Наименование</label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input type="text" class="form-control" name="name" id="ad-name-input" placeholder="Введите наименование работы">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="ad-salary-input">Средняя заработная плата</label>
                    <div class="input-group">
                        <input type="number" step="1000" class="form-control" name="salary" id="ad-salary-input" placeholder="Введите среднию заработную оплату">
                        <span class="input-group-addon"><i class="fa fa-rub" aria-hidden="true"></i></span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="ad-details-input">Описание</label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
                        <textarea style="resize: vertical" rows="7" class="form-control" name="details" id="ad-details-input" placeholder="Укажите необходимые требования и обязанности"></textarea>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="ad-company-input">Компания</label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-building-o" aria-hidden="true"></i></span>
                        <select disabled class="form-control" name="company_id" id="ad-company-input">
                            <option value="1">Test1</option>
                            <option value="2">Test2</option>
                        </select>
                    </div>
                </div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                <button type="submit" class="btn btn-primary">Опубликовать</button>
            </div>
            
        </div>
    </div>
</form>
