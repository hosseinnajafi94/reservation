<?php
namespace app\modules\coding\models\DAL;
use Yii;
/**
 * This is the model class for table "view_list_takhfifat".
 * @author Hossein Najafi <hnajafi1994@gmail.com>
 *
 * @property int $id
 * @property int $id_p1
 * @property string $date1
 * @property string $date2
 * @property string $name1
 * @property int $valint1
 * @property int $valint2
 */
class ViewListTakhfifat extends \yii\db\ActiveRecord {
    public static function tableName() {
        return 'view_list_takhfifat';
    }
    public function rules() {
        return [
                [['id', 'id_p1', 'valint1', 'valint2'], 'integer'],
                [['date1', 'date2'], 'safe'],
                [['name1'], 'string'],
        ];
    }
    public function attributeLabels() {
        return [
            'id' => Yii::t('coding', 'ID'),
            'id_p1' => Yii::t('coding', 'Id P1'),
            'date1' => Yii::t('coding', 'Date1'),
            'date2' => Yii::t('coding', 'Date2'),
            'name1' => Yii::t('coding', 'Name1'),
            'valint1' => Yii::t('coding', 'Valint1'),
            'valint2' => Yii::t('coding', 'Valint2'),
        ];
    }
}