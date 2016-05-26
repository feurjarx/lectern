<?php
/**
 * Created by PhpStorm.
 * Date: 05.05.2016
 * Time: 21:05
 */
/** @var $this BaseController */
?>
<?php ob_start() ?>
    <script src="<?php echo Utils::getHttpHost(); ?>/bower_components/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
<?php $afterJs = ob_get_clean(); ?>

<h1 class="text-center">Заполнение резюме</h1>
<form action="/student/cv/save" method="post">

    <div class="col-lg-12 col-md-12 col-xs-12">
        <div class="form-group">
            <label for="sphere-select">Сфера деятельности</label>
            <br>
            <select name="sphere" id="sphere-select" class="selectpicker show-tick">

                <?php foreach (Utils::getSpheresTitles() as $sphere => $title): ?>

                    <option value="<?php echo $sphere; ?>"><?php echo $title ?></option>

                <?php endforeach; ?>

            </select>
        </div>
    </div>

    <div class="col-lg-12 col-md-12 col-xs-12">
        <div class="form-group">
            <label for="skills-textarea">Навыки</label>
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="fa fa-hand-rock-o"></i>
                </span>
                <textarea required style="resize: vertical" rows="7" class="form-control" name="skills" id="skills-textarea" placeholder="Перечислите навыки и языки программирования, которыми владеете"></textarea>
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-asterisk"></span>
                </span>
            </div>
        </div>
    </div>


    <div class="col-lg-3 col-md-3 col-xs-12">
        <div class="form-group">
            <label for="work-experience-select">Рабочий стаж</label>
            <br>
            <select name="work_experience" id="work-experience-select" class="selectpicker show-tick">

                <?php foreach (Utils::getWorkExperiencesTitles() as $experience => $title): ?>

                    <option value="<?php echo $experience; ?>"><?php echo $title ?></option>

                <?php endforeach; ?>

            </select>
        </div>
    </div>

    <div class="col-lg-3 col-md-3 col-xs-12">
        <div class="form-group">
            <label for="education-select">Образование</label>
            <br>
            <select name="education" id="education-select" class="selectpicker show-tick">

                <?php foreach (Utils::getEducationsTitles() as $education => $title): ?>

                    <option value="<?php echo $education; ?>"><?php echo $title ?></option>

                <?php endforeach; ?>

            </select>
        </div>
    </div>

    <div class="col-lg-3 col-md-3 col-xs-12">
        <div class="form-group">
            <label for="schedule-select">Желаемый рабочий график</label>
            <br>
            <select name="schedule" id="schedule-select" class="selectpicker show-tick">

                <?php foreach (Utils::getSchedulesTitles() as $schedule => $title): ?>

                    <option value="<?php echo $schedule; ?>"><?php echo $title ?></option>

                <?php endforeach; ?>

            </select>
        </div>
    </div>

    <div class="col-lg-3 col-md-3 col-xs-12">
        <div class="form-group">
            <label for="desire-salary-input">Заработная плата</label>
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-money" aria-hidden="true"></i></span>
                <input type="number" step="100" class="form-control" name="desire_salary" id="desire-salary-input" placeholder="Введите желаемую з/п">
                <span class="input-group-addon"><i class="fa fa-rub" aria-hidden="true"></i></span>
            </div>
        </div>
    </div>

    <div class="col-lg-12 col-md-12 col-xs-12">
        <div class="form-group">
            <label for="foreign-languages-input">Владение иностранными языками</label>
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="fa fa-language"></i>
                </span>
                <input type="text" class="form-control" name="foreign_languages" id="foreign-languages-input" placeholder="Перечислите через запятую">
            </div>
        </div>
    </div>

    <div class="col-lg-12 col-md-12 col-xs-12">
        <div class="form-group">
            <label for="ext-education-textarea">Дополнительное образование</label>
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="fa fa-graduation-cap"></i>
                </span>
                <textarea style="resize: vertical" rows="3" class="form-control" name="ext_education" id="ext-education-textarea" placeholder="Если есть, то укажите сведения о доп. образовании"></textarea>
            </div>
        </div>
    </div>

    <div class="col-lg-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="about-textarea">О себе</label>
            <div class="input-group">
            <span class="input-group-addon">
                <i class="fa fa-comment-o"></i>
            </span>
                <textarea style="resize: vertical" rows="5" class="form-control" name="about" id="about-textarea" placeholder="Напишите о себе то, что считаете желательно знать будущему работодателю"></textarea>
            </div>
        </div>
    </div>

    <div class="col-lg-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="hobbies-textarea">Увлечения</label>
            <div class="input-group">
            <span class="input-group-addon">
                <i class="fa fa-arrow-circle-o-right"></i>
            </span>
                <textarea style="resize: vertical" rows="5" class="form-control" name="hobbies" id="hobbies-textarea" placeholder="Напишите о своих увлечениях, а также то, чем бы желали заниматься"></textarea>
            </div>
        </div>
    </div>


    <div class="col-lg-6 col-md-6 col-xs-12">
        <div class="form-group">
            <input id="is-drivers-license-checkbox" name="is_drivers_license" type="checkbox" data-toggle="checkbox-x" data-size="sm" data-three-state="false">
            <label for="is-drivers-license-checkbox">Водительское удостоверение</label>
            <br>
            <input id="is-smoking-checkbox" name="is_smoking" type="checkbox" data-toggle="checkbox-x" data-size="sm" data-three-state="false">
            <label for="is-smoking-checkbox">Курение сигарет</label>
            <br>
            <input id="is-married-checkbox" name="is_married" type="checkbox" data-toggle="checkbox-x" data-size="sm" data-three-state="false">
            <label for="is-married-checkbox">В браке</label>
        </div>

    </div>

    <div class="form-group col-lg-6 col-md-6 col-xs-12">

        <div class="col-lg-12 col-md-12 col-xs-12 padding-none">
            <label>Режим доступа&nbsp;</label>
        </div>

        <div class="col-lg-9 col-md-9 col-xs-9 padding-none">
            <div class="btn-group" data-toggle="buttons">
                <label class="btn btn-default active">
                    <span class="fa fa-unlock"></span>
                    <input type="radio" name="access_type" value="public" autocomplete="off" checked>
                    <span> Публичный</span>
                </label>
                <label class="btn btn-default">
                    <span class="fa fa-unlock-alt"></span>
                    <input type="radio" name="access_type" value="private" autocomplete="off">
                    <span> Закрытый</span>
                </label>
            </div>
        </div>

        <div class="col-lg-3 col-md-3 col-xs-3 padding-none">
            <div class="btn-group btn-group-md pull-right">
                <button class="btn btn-success pull-right" type="submit">
                    <em class="glyphicon glyphicon-floppy-disk"></em>
                    <span class="hidden-xs">Сохранить</span>
                </button>
            </div>
        </div>
    </div>
</form>
