<?php
namespace app\modules\coding\models\DAL;
use Yii;
/**
 * This is the model class for table "view_list_reservations_doing".
 * @author Hossein Najafi <hnajafi1994@gmail.com>
 *
 * @property int $id شناسه رزرو
 * @property int $id_p1 نوع رزرو
 * @property int $id_p2 اتاق
 * @property int $id_p3 تخفیف
 * @property string $date1 تاریخ ورود
 * @property string $date2 تاریخ خروج
 * @property string $datetime1 زمان غیرفعال شدن رزرو
 * @property string $ip آی پی کاربر
 * @property string $agent مرورگر کاربر
 * @property string $name1 کدملی
 * @property string $name2 نام
 * @property string $name3 نام خانوادگی
 * @property string $name4 شماره تلفن همراه
 * @property string $name5 پست الکترونیک
 * @property int $valint1 تعداد همراهان
 * @property int $valint2 مبلغ اتاق
 * @property int $valint3 مبلغ همراهان
 * @property int $valint4 جمع کل
 * @property int $valint5 مبلغ تخفیف
 * @property int $valint6 جمع کل با احتصاب تخفیف
 * @property int $valint7 مالیات
 * @property int $valint8 عوارض
 * @property int $valint9 مبلغ قابل پرداخت
 */
class ViewListReservationsDoing extends \yii\db\ActiveRecord {
    public static function tableName() {
        return 'view_list_reservations_doing';
    }
    public function rules() {
        return [
                [['id', 'id_p1', 'id_p2', 'id_p3', 'valint1', 'valint2', 'valint3', 'valint4', 'valint5', 'valint6', 'valint7', 'valint8', 'valint9'], 'integer'],
                [['id_p1', 'id_p2', 'date1', 'date2', 'ip', 'agent'], 'required'],
                [['date1', 'date2', 'datetime1'], 'safe'],
                [['ip', 'agent', 'name1', 'name2', 'name3', 'name4', 'name5'], 'string', 'max' => 255],
        ];
    }
    public function attributeLabels() {
        return [
            'id' => Yii::t('coding', 'ID'),
            'id_p1' => Yii::t('coding', 'Id P1'),
            'id_p2' => Yii::t('coding', 'Id P2'),
            'id_p3' => Yii::t('coding', 'Id P3'),
            'date1' => Yii::t('coding', 'Date1'),
            'date2' => Yii::t('coding', 'Date2'),
            'datetime1' => Yii::t('coding', 'Datetime1'),
            'ip' => Yii::t('coding', 'Ip'),
            'agent' => Yii::t('coding', 'Agent'),
            'name1' => Yii::t('coding', 'Name1'),
            'name2' => Yii::t('coding', 'Name2'),
            'name3' => Yii::t('coding', 'Name3'),
            'name4' => Yii::t('coding', 'Name4'),
            'name5' => Yii::t('coding', 'Name5'),
            'valint1' => Yii::t('coding', 'Valint1'),
            'valint2' => Yii::t('coding', 'Valint2'),
            'valint3' => Yii::t('coding', 'Valint3'),
            'valint4' => Yii::t('coding', 'Valint4'),
            'valint5' => Yii::t('coding', 'Valint5'),
            'valint6' => Yii::t('coding', 'Valint6'),
            'valint7' => Yii::t('coding', 'Valint7'),
            'valint8' => Yii::t('coding', 'Valint8'),
            'valint9' => Yii::t('coding', 'Valint9'),
        ];
    }
}