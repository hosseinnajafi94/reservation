<?php
use app\config\components\functions;
/* @var $this yii\web\View */
$this->title = Yii::t('dashboard', 'Dashboard');
?>
<div class="dashboard-default-index">
    <div class="row">
        <div class="col-lg-12">
            <div class="box">
                <div class="box-header">وضعیت اتاق ها</div>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>اتاق</th>
                            <?php
                            foreach ($dates as $date) {
                                ?>
                                <th><?= functions::tojdate($date) ?></th>
                                <?php
                            }
                            ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($rooms as $room) {
                            $className  = ['danger', 'danger', 'danger', 'danger', 'danger', 'danger', 'danger'];
                            $statusName = ['خالی', 'خالی', 'خالی', 'خالی', 'خالی', 'خالی', 'خالی'];
                            for ($index = 0; $index < 7; $index++) {
                                if ($room['count_m' . $index . '1'] != 0) {
                                    $className[$index]  = 'warning';
                                    $statusName[$index] = 'در حال رزرو';
                                }
                                else if ($room['count_m' . $index . '2'] != 0) {
                                    $className[$index]  = 'info';
                                    $statusName[$index] = 'رزرو شده';
                                }
                                else if ($room['count_m' . $index . '3'] != 0) {
                                    $className[$index]  = 'danger';
                                    $statusName[$index] = 'قفل شده';
                                }
                                else {
                                    $className[$index] = 'success';
                                }
                            }
                            ?>
                            <tr>
                                <td><?= $room['name1'] ?></td>
                                <?php
                                for ($index = 0; $index < 7; $index++) {
                                    ?>
                                    <td class="<?= $className[$index] ?>"><?= $statusName[$index] ?></td>
                                    <?php
                                }
                                ?>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>