<?php
namespace app\modules\coding\models\DAL;
use Yii;
/**
 * This is the model class for table "view_list_reserv_shodeha".
 * @author Hossein Najafi <hnajafi1994@gmail.com>
 *
 * @property int $id شناسه رزرو
 * @property int $id_p1 اتاق
 * @property string $date1 تاریخ ورود
 * @property string $date2 تاریخ خروج
 */
class ViewListReservShodeha extends \yii\db\ActiveRecord {
    public static function tableName() {
        return 'view_list_reserv_shodeha';
    }
    public function rules() {
        return [
                [['id', 'id_p1'], 'integer'],
                [['id_p1', 'date1', 'date2'], 'required'],
                [['date1', 'date2'], 'safe'],
        ];
    }
    public function attributeLabels() {
        return [
            'id' => Yii::t('coding', 'ID'),
            'id_p1' => Yii::t('coding', 'Id P1'),
            'date1' => Yii::t('coding', 'Date1'),
            'date2' => Yii::t('coding', 'Date2'),
        ];
    }
}