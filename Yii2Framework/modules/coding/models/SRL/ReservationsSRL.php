<?php
namespace app\modules\coding\models\SRL;
use Yii;
use yii\data\ActiveDataProvider;
use app\modules\coding\models\DAL\Reservations;
use app\modules\coding\models\VML\ReservationsVML;
use app\modules\coding\models\VML\ReservationsSearchVML;
use app\config\components\functions;
use app\config\widgets\ArrayHelper;
use app\modules\coding\models\DAL\Tcoding;
use app\modules\emails\models\SRL\EmailsSRL;
use app\modules\users\models\SRL\UsersSRL;
use app\modules\sms\models\SRL\SmsSRL;
class ReservationsSRL {
    /**
     * @return array [ReservationsSearchVML $searchModel, ActiveDataProvider $dataProvider]
     */
    public static function searchModel($idp1) {
        $searchModel = new ReservationsSearchVML();
        $query       = Reservations::find()
                ->where(['id_p1' => $idp1])
                ->orderBy(['id' => SORT_DESC]);

        $searchModel->load(Yii::$app->request->queryParams);
        $query->andFilterWhere([
            'id'    => $searchModel->id,
            'name1' => $searchModel->name1,
            'name4' => $searchModel->name4,
        ]);

        $title      = null;
        $columns    = [['class' => 'yii\grid\SerialColumn']];
        $columns[0] = [
            'attribute' => 'id',
            'label'     => Yii::t('coding', 'Tracking code')
        ];
        $columns[]  = [
            'attribute' => 'p2.name1',
            'filter'    => false,
            'label'     => Yii::t('coding', 'Room')
        ];
        $columns[]  = [
            'attribute' => 'date1',
            'format'    => 'jdate',
            'filter'    => false,
            'label'     => Yii::t('coding', 'Entry date')
        ];
        $columns[]  = [
            'attribute' => 'date2',
            'format'    => 'jdate',
            'filter'    => false,
            'label'     => Yii::t('coding', 'Date of departure')
        ];
        $columns[]  = [
            'attribute' => 'name1',
            'label'     => Yii::t('coding', 'National Code')
        ];
        $columns[]  = [
            'attribute' => 'name2',
            'filter'    => false,
            'label'     => Yii::t('coding', 'First name')
        ];
        $columns[]  = [
            'attribute' => 'name3',
            'filter'    => false,
            'label'     => Yii::t('coding', 'Last name')
        ];
        $columns[]  = [
            'attribute' => 'name4',
            'label'     => Yii::t('coding', 'Mobile')
        ];
        $columns[]  = [
            'class'    => 'yii\grid\ActionColumn',
            'template' => '{view}'
        ];
        switch ($idp1) {
            case 1:
                $title = Yii::t('coding', 'Ongoing reservations');
                //$columns[]  = '';
//                $columns[]  = ['class' => 'yii\grid\ActionColumn'];
                break;
            case 2:
                $title = Yii::t('coding', 'Definitive reservations');

                break;
            case 3:
                $title = Yii::t('coding', 'Canceled reservations');
                //$columns[]  = '';
//                $columns[]  = ['class' => 'yii\grid\ActionColumn'];
                break;
        }
        $dataProvider = new ActiveDataProvider([
            'query'      => $query,
            'sort'       => false,
            'pagination' => ['defaultPageSize' => 10]
        ]);
        return [$dataProvider, $searchModel, $columns, $title];
    }
    /**
     * @return ReservationsVML
     */
    public static function newViewModel() {
        $data          = new ReservationsVML();
        $data->valint1 = 0;
        $title         = Yii::t('coding', 'Definitive reservations');
        $data->rules   = [
                [['date1', 'date2'], 'required'],
                [['date1', 'date2'], 'string', 'min' => 10, 'max' => 10],
                [['date1', 'date2'], 'match', 'pattern' => "/^[0-9]{4}(\/|-)(0[1-9]|1[0-2])(\/|-)(0[1-9]|[1-2][0-9]|3[0-1])$/"],
                [['date1'], 'compare', 'compareValue' => functions::getjdate(strtotime('-1 day')), 'operator' => '>='],
                [['date2'], 'compare', 'compareAttribute' => 'date1', 'operator' => '>='],
                [['id_p2'], 'required'],
                [['id_p2', 'id_p3'], 'integer'],
                [['id_p2'], 'validateRoom', 'skipOnEmpty' => false, 'skipOnError' => false],
                [['id_p3'], 'validateDiscount', 'skipOnEmpty' => false, 'skipOnError' => false],
                [['name2', 'name3'], 'required'],
                [['name2', 'name3'], 'string', 'max' => 255],
                [['name4'], 'required'],
                [['name4'], 'string', 'min' => 11, 'max' => 11],
                [['name4'], 'match', 'pattern' => "/^09[0-9]{9}$/"],
                [['name5'], 'trim'],
                [['name5'], 'default'],
                [['name5'], 'email'],
                [['name1'], 'required'],
                [['name1'], 'string', 'min' => 10, 'max' => 10],
                [['name1'], 'match', 'pattern' => "/^[0-9]{10}$/"],
                [['name1'], 'validateIdCard', 'skipOnError' => false, 'skipOnEmpty' => false],
                [['valint1'], 'required'],
                [['valint1'], 'integer'],
                [['valint1'], 'compare', 'compareValue' => 0, 'operator' => '>='],
        ];
        $data->labels  = [
            'id_p2'   => Yii::t('coding', 'Room'),
            'id_p3'   => Yii::t('coding', 'Discount'),
            'date1'   => Yii::t('coding', 'Entry date'),
            'date2'   => Yii::t('coding', 'Date of departure'),
            'name1'   => Yii::t('coding', 'National Code'),
            'name2'   => Yii::t('coding', 'First name'),
            'name3'   => Yii::t('coding', 'Last name'),
            'name4'   => Yii::t('coding', 'Mobile'),
            'name5'   => Yii::t('coding', 'Email'),
            'valint1' => Yii::t('coding', 'Number of entourage'),
        ];
        return [$data, $title];
    }
    /**
     * @param ReservationsVML $data
     * @return void
     */
    public static function loadItems($data) {
        if ($data->date1 && $data->date2) {
            $rows      = self::getRooms($data->date1, $data->date2);
            $data->p2s = ArrayHelper::map($rows, 'id', 'name1');
            if ($data->id_p2) {
                $rows      = self::getDiscounts($data->date1, $data->id_p2);
                $data->p3s = ArrayHelper::map($rows, 'id', 'name1');
            }
        }
    }
    /**
     * @param ReservationsVML $data
     * @return bool
     */
    public static function insert($data) {
        $data->date1 = functions::togdate($data->date1);
        $data->date2 = functions::togdate($data->date2);
        if (!$data->validate()) {
            return false;
        }
        $model          = new Reservations();
        $model->ip      = Yii::$app->request->userIP;
        $model->agent   = Yii::$app->request->userAgent;
        $model->id_p1   = 2;
        $model->id_p2   = $data->id_p2;
        $model->id_p3   = $data->id_p3;
        $model->date1   = $data->date1;
        $model->date2   = $data->date2;
        $model->name1   = $data->name1;
        $model->name2   = $data->name2;
        $model->name3   = $data->name3;
        $model->name4   = $data->name4;
        $model->name5   = $data->name5;
        self::calc($model, $data);
        if ($model->save()) {
            $data->id = $model->id;
            return true;
        }
        return false;
    }
    /**
     * @return Reservations
     */
    public static function findModel($id) {
        $model   = Reservations::findOne(['id' => $id, 'id_p1' => [1, 2, 3]]);
        $title   = null;
        $title2  = null;
        $columns = [];
        if ($model !== null) {
            switch ($model->id_p1) {
                case 1:
                    $title = Yii::t('coding', 'Ongoing reservations');
                    break;
                case 2:
                    $title = Yii::t('coding', 'Definitive reservations');
                    break;
                case 3:
                    $title = Yii::t('coding', 'Canceled reservations');
                    break;
            }
            $title2    = $model->name1;
            $columns[] = [
                'attribute' => 'id',
                'label'     => Yii::t('coding', 'Tracking code')
            ];
            $columns[] = [
                'attribute' => 'p2.name1',
                'label'     => Yii::t('coding', 'Room')
            ];
            $columns[] = [
                'attribute' => 'date1',
                'format'    => 'jdate',
                'label'     => Yii::t('coding', 'Entry date')
            ];
            $columns[] = [
                'attribute' => 'date2',
                'format'    => 'jdate',
                'label'     => Yii::t('coding', 'Date of departure')
            ];
            $columns[] = [
                'attribute' => 'name1',
                'label'     => Yii::t('coding', 'National Code')
            ];
            $columns[] = [
                'attribute' => 'name2',
                'label'     => Yii::t('coding', 'First name')
            ];
            $columns[] = [
                'attribute' => 'name3',
                'label'     => Yii::t('coding', 'Last name')
            ];
            $columns[] = [
                'attribute' => 'name4',
                'label'     => Yii::t('coding', 'Mobile')
            ];
            $columns[] = [
                'attribute' => 'name5',
                'label'     => Yii::t('coding', 'Email')
            ];
            $columns[] = [
                'attribute' => 'p2.valint1',
                'format'    => 'toman',
                'label'     => Yii::t('coding', 'Cost per night stay')
            ];
            $columns[] = [
                'attribute' => 'p2.valint2',
                'format'    => 'toman',
                'label'     => Yii::t('coding', 'Cost per person added')
            ];
            $columns[] = [
                'attribute' => 'days',
                'label'     => Yii::t('coding', 'Number of nights'),
            ];
            $columns[] = [
                'attribute' => 'valint1',
                'label'     => Yii::t('coding', 'Number of entourage')
            ];
            $columns[] = [
                'attribute' => 'valint2',
                'format'    => 'toman',
                'label'     => Yii::t('coding', 'Room charge')
            ];
            $columns[] = [
                'attribute' => 'valint3',
                'format'    => 'toman',
                'label'     => Yii::t('coding', 'Cost of attendees')
            ];
            $columns[] = [
                'attribute' => 'valint4',
                'format'    => 'toman',
                'label'     => Yii::t('coding', 'Total')
            ];
            $columns[] = [
                'attribute'  => 'p3.p2.name1',
                'visibility' => $model->p3,
                'label'      => Yii::t('coding', 'Discount name'),
            ];
            $columns[] = [
                'attribute' => 'valint5',
                'format'    => 'toman',
                'label'     => Yii::t('coding', 'Discount price')
            ];
            $columns[] = [
                'attribute' => 'valint6',
                'format'    => 'toman',
                'label'     => Yii::t('coding', 'Total amount including discounts')
            ];
            $columns[] = [
                'attribute' => 'valint7',
                'format'    => 'toman',
                'label'     => Yii::t('coding', 'Tax')
            ];
            $columns[] = [
                'attribute' => 'valint8',
                'format'    => 'toman',
                'label'     => Yii::t('coding', 'Complications')
            ];
            $columns[] = [
                'attribute' => 'valint9',
                'format'    => 'toman',
                'label'     => Yii::t('coding', 'The amount payable')
            ];
            $columns[] = [
                'label' => Yii::t('coding', 'OS'),
                'value' => function ($model) {
                    return functions::getOS($model->agent);
                },
            ];
            $columns[] = [
                'label' => Yii::t('coding', 'Browser'),
                'value' => function ($model) {
                    return functions::getBrowser($model->agent);
                },
            ];
        }
        return [$model, $title, $columns, $title2];
    }
    /**
     * 
     */
    public static function getRooms($date1, $date2, $id = null, $rowId = null) {
        $now = functions::getdatetime();
        if (strtotime($date1) < strtotime(functions::getdate())) {
            return [];
        }
        $query = Tcoding::findBySql("
            SELECT m1.*
            FROM view_list_otaghha AS m1
            WHERE 
            " . ($id ? " m1.id = $id AND " : '') . "
            m1.id NOT IN (
                SELECT m5.id_p1 FROM (
                    -- ------------------------------
                    SELECT m2.id_p1
                    FROM view_list_darhal_reserve AS m2
                    WHERE (
                           (m2.date1 <= '$date1' AND m2.date2 >= '$date1')
                        OR (m2.date1 <  '$date2' AND m2.date2 >= '$date2')
                        OR ('$date1' <= m2.date1 AND '$date2' >= m2.date1)
                    ) AND m2.datetime1 > '$now'" . ($rowId ? " AND m2.id <> $rowId" : '') . "
                    GROUP BY m2.id_p1
                    -- ------------------------------
                    UNION
                    -- ------------------------------
                    SELECT m3.id_p1
                    FROM view_list_reserv_shodeha AS m3
                    WHERE (
                          (m3.date1 <= '$date1' AND m3.date2 >= '$date1')
                       OR (m3.date1 <  '$date2' AND m3.date2 >= '$date2')
                       OR ('$date1' <= m3.date1 AND '$date2' >= m3.date1)
                    )" . ($rowId ? " AND m3.id <> $rowId" : '') . "
                    GROUP BY m3.id_p1
                    -- ------------------------------
                    UNION 
                    -- ------------------------------
                    SELECT m4.id_p1
                    FROM view_list_ghoflha AS m4
                    WHERE (m4.date1 <= '$date1' AND m4.date2 >= '$date1')
                       OR (m4.date1 <  '$date2' AND m4.date2 >= '$date2')
                       OR ('$date1' <= m4.date1 AND '$date2' >= m4.date1)
                    GROUP BY m4.id_p1
                    -- ------------------------------
                ) AS m5
                GROUP BY m5.id_p1
            )
        ");
        if ($id) {
            return $query->one();
        }
        return $query->all();
    }
    /**
     * 
     */
    public static function getRoom($date1, $name1) {
        if (strtotime($date1) < strtotime(functions::getdate())) {
            return null;
        }
        $model = Reservations::find()->where(['date1' => $date1, 'name1' => $name1, 'id_p1' => 1])->orderBy(['id' => SORT_DESC])->one();
        if ($model == null) {
            return null;
        }
        $row = self::getRooms($model->date1, $model->date2, $model->id_p2, $model->id);
        if ($row == null) {
            return null;
        }
        return $model;
    }
    /**
     * 
     */
    public static function getDiscounts($date1, $id_p1, $id = null) {
        $query = Tcoding::find()->from('view_list_takhfifat')
                ->where("id_p1 = $id_p1 AND '$date1' BETWEEN date1 AND date2")
                ->orderBy(['id' => SORT_DESC]);
        if ($id) {
            return $query->andWhere(['id' => $id])->one();
        }
        return $query->all();
    }
    /**
     * @param ReservationsVML $data
     * @param \app\modules\site\models\DAL\SiteSettings $settings
     * @return bool
     */
    public static function insertUser($data, $settings) {
        if (!$data->validate()) {
            return false;
        }
        $model            = new Reservations();
        $model->datetime1 = functions::getdatetime(strtotime("+$settings->reserve_time min"));
        $model->ip        = Yii::$app->request->userIP;
        $model->agent     = Yii::$app->request->userAgent;
        $model->id_p1     = 1;
        $model->id_p2     = $data->id_p2;
        $model->id_p3     = $data->id_p3;
        $model->date1     = $data->date1;
        $model->date2     = $data->date2;
        $model->name1     = $data->name1;
        $model->name2     = $data->name2;
        $model->name3     = $data->name3;
        $model->name4     = $data->name4;
        $model->name5     = $data->name5;
        self::calc($model, $data);
        if ($model->save()) {
            $data->id = $model->id;
            return true;
        }
        return false;
    }
    public static function calc($model, $data) {
        $model->valint1 = $data->valint1;
        $model->valint2 = $data->room->valint1 * $data->days; /* هزینه اتاق */
        $model->valint3 = $data->valint1 * $data->room->valint2; /* هزینه همراهان */
        $model->valint4 = $model->valint2 + $model->valint3; /* جمع کل */
        $model->valint5 = $data->discountVal; /* مبلغ تخفیف */
        $model->valint6 = ($model->valint4 - $model->valint5 < 1 ? 0 : $model->valint4 - $model->valint5); /* جمع کل با احتساب تخفیف */
        $model->valint7 = $model->valint6 / 100 * 6; /* مالیات */
        $model->valint8 = $model->valint6 / 100 * 3; /* عوارض */
        $model->valint9 = $model->valint6 + $model->valint7 + $model->valint8; /* مبلغ قابل پرداخت */
    }
    public static function find($code_melli, $id) {
        $now = functions::getdatetime();
        $query = Reservations::find()->where([
            'id' => $id,
            'name1' => $code_melli,
            'id_p1' => 1
        ]);
        $query->andWhere(['>', 'datetime1', $now]);
        $query->andWhere(['>=', 'date1', functions::getdate(strtotime('-1 day'))]);
        $model = $query->one();
        if ($model == null) {
            return null;
        }
        $date1  = $model->date1;
        $date2  = $model->date2;
        $roomId = $model->id_p2;
        $room = Tcoding::findBySql("
            SELECT m1.*
            FROM view_list_otaghha AS m1
            WHERE  m1.id = $roomId AND 
            m1.id NOT IN (
                SELECT m5.id_p1 FROM (
                    -- ------------------------------
                    SELECT m2.id_p1
                    FROM view_list_darhal_reserve AS m2
                    WHERE (
                           (m2.date1 <= '$date1' AND m2.date2 >= '$date1')
                        OR (m2.date1 <  '$date2' AND m2.date2 >= '$date2')
                        OR ('$date1' <= m2.date1 AND '$date2' >= m2.date1)
                    ) AND m2.datetime1 > '$now'  AND m2.id <> $model->id AND m2.id_p1 = $roomId
                    GROUP BY m2.id_p1
                    -- ------------------------------
                    UNION
                    -- ------------------------------
                    SELECT m3.id_p1
                    FROM view_list_reserv_shodeha AS m3
                    WHERE (
                          (m3.date1 <= '$date1' AND m3.date2 >= '$date1')
                       OR (m3.date1 <  '$date2' AND m3.date2 >= '$date2')
                       OR ('$date1' <= m3.date1 AND '$date2' >= m3.date1)
                    ) AND m3.id_p1 = $roomId
                    -- ------------------------------
                    UNION 
                    -- ------------------------------
                    SELECT m4.id_p1
                    FROM view_list_ghoflha AS m4
                    WHERE (
                          (m4.date1 <= '$date1' AND m4.date2 >= '$date1')
                       OR (m4.date1 <  '$date2' AND m4.date2 >= '$date2')
                       OR ('$date1' <= m4.date1 AND '$date2' >= m4.date1)
                    ) AND m4.id_p1 = $roomId
                    GROUP BY m4.id_p1
                    -- ------------------------------
                ) AS m5
                GROUP BY m5.id_p1
            )
        ")->one(); 
        if ($room == null) {
            return null;
        }
        return $model;
    }
    public static function get($params) {
        return Reservations::findOne($params);
    }
    /**
     * @param string $text Message Text
     * @param Reservations $model Reservation Model
     * @return string Message Text
     */
    public static function replacement($text, $model) {
        return str_replace([
                '[fname]', '[lname]',
                '[mobile]', '[email]',
                '[idcard]', '[id]',
                '[date1]', '[date2]'], [
                $model->name2, $model->name3,
                $model->name4, $model->name5,
                $model->name1, $model->id,
                functions::tojdate($model->date1), functions::tojdate($model->date2)
            ], $text);
    }
    /**
     * @param \app\modules\site\models\DAL\SiteSettings $settings Site Settings Model
     * @param Reservations $model Reservation Model
     */
    public static function Messenger($settings, $model) {
        $modir = UsersSRL::getModir();
        if ($settings->email_send_admin == 1 && $modir->email) {
            $text = self::replacement($settings->email_message_admin, $model);
            EmailsSRL::send($modir->email, $modir->fname . ' ' . $modir->lname, 'اطلاعات رزرو', $text);
        }

        if ($settings->email_send_user == 1 && $model->name5) {
            $text = self::replacement($settings->email_message_user, $model);
            EmailsSRL::send($model->name5, $model->name2 . ' ' . $model->name3, 'اطلاعات رزرو', $text);
        }

        if ($settings->sms_send_admin == 1 && $modir->mobile) {
            $text = self::replacement($settings->sms_message_admin, $model);
            SmsSRL::send($modir->mobile, $text);
        }

        if ($settings->sms_send_user == 1 && $model->name4) {
            $text = self::replacement($settings->sms_message_user, $model);
            SmsSRL::send($model->name4, $text);
        }
    }
}