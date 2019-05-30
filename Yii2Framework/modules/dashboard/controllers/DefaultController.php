<?php
namespace app\modules\dashboard\controllers;
use yii\filters\AccessControl;
use app\config\widgets\Controller;
use app\config\components\functions;
use app\modules\coding\models\DAL\Tcoding;
class DefaultController extends Controller {
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow'   => true,
                        'actions' => ['index'],
                        'roles'   => ['Dashboard'],
                        'verbs'   => ['GET']
                    ],
                ],
            ],
        ];
    }
    public function actionIndex() {
        
        $date1 = $date2 = [];
        $date1[0] = $date2[0] = functions::getdate(strtotime('+0 day'));
        $date1[1] = $date2[1] = functions::getdate(strtotime('+1 day'));
        $date1[2] = $date2[2] = functions::getdate(strtotime('+2 day'));
        $date1[3] = $date2[3] = functions::getdate(strtotime('+3 day'));
        $date1[4] = $date2[4] = functions::getdate(strtotime('+4 day'));
        $date1[5] = $date2[5] = functions::getdate(strtotime('+5 day'));
        $date1[6] = $date2[6] = functions::getdate(strtotime('+6 day'));
        $now = functions::getdatetime();
        $rooms = functions::queryAll("
            SELECT m1.id, m1.name1
            , func_darhal_reserve('$date1[0]', '$date2[0]', '$now', m1.id) AS count_m01
            , func_reserv_shodeha('$date1[0]', '$date2[0]', m1.id)         AS count_m02
            , func_ghoflha('$date1[0]', '$date2[0]', m1.id)                AS count_m03
            , func_darhal_reserve('$date1[1]', '$date2[1]', '$now', m1.id) AS count_m11
            , func_reserv_shodeha('$date1[1]', '$date2[1]', m1.id)         AS count_m12
            , func_ghoflha('$date1[1]', '$date2[1]', m1.id)                AS count_m13
            , func_darhal_reserve('$date1[2]', '$date2[2]', '$now', m1.id) AS count_m21
            , func_reserv_shodeha('$date1[2]', '$date2[2]', m1.id)         AS count_m22
            , func_ghoflha('$date1[2]', '$date2[2]', m1.id)                AS count_m23
            , func_darhal_reserve('$date1[3]', '$date2[3]', '$now', m1.id) AS count_m31
            , func_reserv_shodeha('$date1[3]', '$date2[3]', m1.id)         AS count_m32
            , func_ghoflha('$date1[3]', '$date2[3]', m1.id)                AS count_m33
            , func_darhal_reserve('$date1[4]', '$date2[4]', '$now', m1.id) AS count_m41
            , func_reserv_shodeha('$date1[4]', '$date2[4]', m1.id)         AS count_m42
            , func_ghoflha('$date1[4]', '$date2[4]', m1.id)                AS count_m43
            , func_darhal_reserve('$date1[5]', '$date2[5]', '$now', m1.id) AS count_m51
            , func_reserv_shodeha('$date1[5]', '$date2[5]', m1.id)         AS count_m52
            , func_ghoflha('$date1[5]', '$date2[5]', m1.id)                AS count_m53
            , func_darhal_reserve('$date1[6]', '$date2[6]', '$now', m1.id) AS count_m61
            , func_reserv_shodeha('$date1[6]', '$date2[6]', m1.id)         AS count_m62
            , func_ghoflha('$date1[6]', '$date2[6]', m1.id)                AS count_m63
            FROM view_list_otaghha AS m1
            GROUP BY m1.id
        ");
        return $this->renderView([
            'rooms' => $rooms,
            'dates' => $date1,
        ]);
    }
}