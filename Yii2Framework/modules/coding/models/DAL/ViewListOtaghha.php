<?php
namespace app\modules\coding\models\DAL;
use Yii;
/**
 * This is the model class for table "view_list_otaghha".
 * @author Hossein Najafi <hnajafi1994@gmail.com>
 *
 * @property int $id
 * @property int $id_noe
 * @property int $deleted
 * @property string $created_at
 * @property int $created_by
 * @property string $updated_at
 * @property int $updated_by
 * @property int $id_p1
 * @property int $id_p2
 * @property int $id_p3
 * @property int $id_p4
 * @property int $id_p5
 * @property string $name1
 * @property string $name2
 * @property string $name3
 * @property string $name4
 * @property string $name5
 * @property int $valint1
 * @property int $valint2
 * @property int $valint3
 * @property int $valint4
 * @property int $valint5
 * @property int $valint6
 * @property string $date1
 * @property string $date2
 * @property string $date3
 * @property string $date4
 * @property string $date5
 */
class ViewListOtaghha extends \yii\db\ActiveRecord {
    public static function tableName() {
        return 'view_list_otaghha';
    }
    public function rules() {
        return [
                [['id', 'id_noe', 'deleted', 'created_by', 'updated_by', 'id_p1', 'id_p2', 'id_p3', 'id_p4', 'id_p5', 'valint1', 'valint2', 'valint3', 'valint4', 'valint5', 'valint6'], 'integer'],
                [['id_noe', 'deleted', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'required'],
                [['created_at', 'updated_at', 'date1', 'date2', 'date3', 'date4', 'date5'], 'safe'],
                [['name1', 'name2', 'name3', 'name4', 'name5'], 'string'],
        ];
    }
    public function attributeLabels() {
        return [
            'id' => Yii::t('coding', 'ID'),
            'id_noe' => Yii::t('coding', 'Id Noe'),
            'deleted' => Yii::t('coding', 'Deleted'),
            'created_at' => Yii::t('coding', 'Created At'),
            'created_by' => Yii::t('coding', 'Created By'),
            'updated_at' => Yii::t('coding', 'Updated At'),
            'updated_by' => Yii::t('coding', 'Updated By'),
            'id_p1' => Yii::t('coding', 'Id P1'),
            'id_p2' => Yii::t('coding', 'Id P2'),
            'id_p3' => Yii::t('coding', 'Id P3'),
            'id_p4' => Yii::t('coding', 'Id P4'),
            'id_p5' => Yii::t('coding', 'Id P5'),
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
            'date1' => Yii::t('coding', 'Date1'),
            'date2' => Yii::t('coding', 'Date2'),
            'date3' => Yii::t('coding', 'Date3'),
            'date4' => Yii::t('coding', 'Date4'),
            'date5' => Yii::t('coding', 'Date5'),
        ];
    }
}