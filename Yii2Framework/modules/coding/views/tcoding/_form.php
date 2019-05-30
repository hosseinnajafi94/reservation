<?php
use yii\helpers\Html;
use app\config\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $form \app\config\widgets\ActiveForm */
/* @var $model \app\modules\coding\models\VML\TcodingVML */
/* @var $idnoe int */
?>
<div class="tcoding-form">
    <?php
    $form = ActiveForm::begin(['layout' => 'horizontal']);
    switch ($idnoe) {
        case 1:
            ?>
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <?= $form->field($model, 'name1')->textInput(['maxlength' => true]) ?>
                </div>
            </div>
            <?php
            break;
        case 2:
            $options = [
                'template' => "{label}<div class=\"col-sm-5\">{input}</div>\n{hint}\n{error}",
                'labelOptions' => ['class' => 'control-label col-sm-4'],
                'errorOptions' => ['class' => 'help-block help-block-error col-sm-8 col-sm-offset-4']
            ];
            ?>
            <div class="row">
                <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
                    <?= $form->field($model, 'valint5', [
                        'horizontalCheckboxTemplate' => 
                        "
                            <div class=\"col-sm-5 col-sm-offset-4\">
                                <div class=\"checkbox\">
                                    {beginLabel}
                                        {input}
                                        {labelTitle}
                                    {endLabel}
                                </div>
                                {error}
                            </div>
                            {hint}
                        ",
                    ])->checkbox() ?>
                    <?= $form->field($model, 'id_p1', $options)->dropDownList($model->p1s) ?>
                    <?= $form->field($model, 'name1', $options)->textInput(['maxlength' => true]) ?>
                    <?= $form->field($model, 'valint3', $options)->textInput(['dir' => 'ltr', 'class' => 'form-control number']) ?>
                    <?= $form->field($model, 'valint4', $options)->textInput(['dir' => 'ltr', 'class' => 'form-control number']) ?>
                    <?= $form->field($model, 'valint1', $options)->textInput(['dir' => 'ltr', 'class' => 'form-control number'])->hint(Yii::t('app', 'Toman')) ?>
                    <?= $form->field($model, 'valint2', $options)->textInput(['dir' => 'ltr', 'class' => 'form-control number'])->hint(Yii::t('app', 'Toman')) ?>
                    <?= $form->field($model, 'name2[]', $options)->fileInput(['multiple' => true, 'accept' => 'image/*']) ?>
                </div>
                <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                    <?= $form->field($model, 'name3', [
                        'labelOptions' => ['class' => 'text-right col-sm-12'],
                        'template' => "{label}<div class=\"col-sm-12\">{input}</div>\n{hint}\n{error}"
                    ])->textarea(['rows' => 20]) ?>
                </div>
            </div>
            <?php
            break;
        case 4:
            $options = [
                'template' => "{label}<div class=\"col-sm-12\">{input}</div>\n{hint}\n{error}",
                'errorOptions' => ['class' => 'help-block help-block-error col-sm-12']
            ];
            $this->registerCss('.panel-body .form-group:last-child {margin-bottom: 0;}.checkbox {margin: 0;}.checkbox label {padding: 0;}.checkbox input[type="checkbox"] {position: relative;top: 4px;margin: 0;}');
            ?>
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <?= $form->field($model, 'name1')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($model, 'date1')->textInput(['maxlength' => true, 'dir' => 'ltr', 'class' => 'form-control text-center datePicker']) ?>
                    <?= $form->field($model, 'date2')->textInput(['maxlength' => true, 'dir' => 'ltr', 'class' => 'form-control text-center datePicker']) ?>
                    <?= $form->field($model, 'valint1')->dropDownList($model->p1s) ?>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <?= $form->errorSummary($model) ?>
                    <div class="panel panel-default">
                        <div class="panel-heading"><h2 class="panel-title">لیست اتاق ها</h2></div>
                        <div class="panel-body" style="overflow-x: hidden;overflow-y: auto;height: 240px;">
                            <?php
                            foreach ($model->models as $index => $row) {
                                ?>
                                <div class="row">
                                    <div class="col-sm-6 col-xs-12">
                                        <?= $form->field($row, "[$index]valint1", [
                                            'horizontalCheckboxTemplate' => 
                                            "
                                                <div class=\"col-sm-12\">
                                                    <div class=\"checkbox\">
                                                        {beginLabel}
                                                            {input}
                                                            {labelTitle}
                                                        {endLabel}
                                                    </div>
                                                    {error}
                                                </div>
                                                {hint}
                                            ",
                                        ])->checkbox() ?>
                                    </div>
                                    <div class="col-sm-6 col-xs-12">
                                        <?= $form->field($row, "[$index]valint2", $options)->textInput(['class' => 'form-control number', 'dir' => 'ltr'])->label(false) ?>
                                    </div>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            break;
        case 6:
            $this->registerCss('.panel-body .form-group {margin-bottom: 0;}.checkbox {margin: 0 !important;padding: 0 !important;}.checkbox label {padding: 0;}.checkbox input[type="checkbox"] {position: relative;top: 4px;margin: 0;}');
            ?>
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <?= $form->field($model, 'name1')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($model, 'date1')->textInput(['maxlength' => true, 'dir' => 'ltr', 'class' => 'form-control text-center datePicker']) ?>
                    <?= $form->field($model, 'date2')->textInput(['maxlength' => true, 'dir' => 'ltr', 'class' => 'form-control text-center datePicker']) ?>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <?= $form->errorSummary($model) ?>
                    <div class="panel panel-default">
                        <div class="panel-heading"><h2 class="panel-title">لیست اتاق ها</h2></div>
                        <div class="panel-body" style="overflow-x: hidden;overflow-y: auto;height: 165px;">
                            <?php
                            foreach ($model->models as $index => $row) {
                                echo $form->field($row, "[$index]valint1", [
                                    'horizontalCheckboxTemplate' => 
                                    "
                                        <div class=\"col-sm-12\">
                                            <div class=\"checkbox\">
                                                {beginLabel}
                                                    {input}
                                                    {labelTitle}
                                                {endLabel}
                                            </div>
                                            {error}
                                        </div>
                                        {hint}
                                    ",
                                ])->checkbox();
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            break;
    }
    ?>
    <div class="box-footer">
        <?php
        echo Html::a(Yii::t('app', 'Return'), ['index', 'idnoe' => $idnoe], ['class' => 'btn btn-sm btn-warning']) . "\n";
        echo Html::submitButton(Yii::t('app', 'Submit'), ['class' => 'btn btn-sm btn-success']);
        ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
<?php
$this->registerCss('.checkbox input[type="checkbox"] {visibility: visible;}');
