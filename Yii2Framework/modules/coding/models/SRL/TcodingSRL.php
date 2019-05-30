<?php
namespace app\modules\coding\models\SRL;
use Yii;
use yii\data\ActiveDataProvider;
use app\config\widgets\ArrayHelper;
use app\modules\coding\models\DAL\Tcoding;
use app\modules\coding\models\DAL\ViewListOtaghha;
use app\modules\coding\models\VML\TcodingVML;
use app\config\components\functions;
use yii\web\UploadedFile;
use yii\base\Model;
class TcodingSRL {
    /**
     * @return array [TcodingSearchVML $searchModel, ActiveDataProvider $dataProvider]
     */
    public static function searchModel($idnoe) {
        $query   = Tcoding::find()
                ->select('m1.*')
                ->from('tcoding AS m1')
                ->where(['m1.deleted' => 0, 'm1.id_noe' => $idnoe])
                ->orderBy(['m1.id' => SORT_DESC]);
        $title   = null;
        $columns = [];
        switch ($idnoe) {
            case 1:
                $title     = Yii::t('coding', 'Types of rooms');
                $columns[] = [
                    'attribute' => 'name1',
                    'label'     => Yii::t('coding', 'Name')
                ];
                break;
            case 2:
                $query->innerJoin('tcoding AS m2', 'm1.id_p1=m2.id AND m2.deleted = 0 AND m2.id_noe = 1');
                $title     = Yii::t('coding', 'Rooms');
                $columns[] = [
                    'attribute' => 'p1.name1',
                    'label'     => Yii::t('coding', 'Room type')
                ];
                $columns[] = [
                    'attribute' => 'name1',
                    'label'     => Yii::t('coding', 'Room Name')
                ];
                $columns[] = [
                    'attribute' => 'valint1',
                    'format'    => 'toman',
                    'label'     => Yii::t('coding', 'Cost per night stay')
                ];
                $columns[] = [
                    'attribute' => 'valint2',
                    'format'    => 'toman',
                    'label'     => Yii::t('coding', 'Cost per person added')
                ];
                $columns[] = [
                    'attribute' => 'valint3',
                    'label'     => Yii::t('coding', 'Number of beds')
                ];
                $columns[] = [
                    'attribute' => 'valint4',
                    'label'     => Yii::t('coding', 'Maximum capacity')
                ];
                $columns[] = [
                    'attribute' => 'valint5',
                    'format'    => 'bool',
                    'label'     => Yii::t('coding', 'Active')
                ];
                break;
            case 4:
                $title     = Yii::t('coding', 'Discounts');
                $columns[] = [
                    'attribute' => 'name1',
                    'label'     => Yii::t('coding', 'Name')
                ];
                $columns[] = [
                    'attribute' => 'date1',
                    'format'    => 'jdate',
                    'label'     => Yii::t('coding', 'Start Date')
                ];
                $columns[] = [
                    'attribute' => 'date2',
                    'format'    => 'jdate',
                    'label'     => Yii::t('coding', 'End Date')
                ];
                $columns[] = [
                    'attribute' => 'valint1',
                    'label'     => Yii::t('coding', 'Type of discount'),
                    'value'     => function($model) {
                        return ($model->valint1 === 1 ? Yii::t('coding', 'Price') : ($model->valint1 === 2 ? Yii::t('coding', 'Percentage') : null));
                    }
                ];
                break;
            case 6:
                $title     = Yii::t('coding', 'Locks');
                $columns[] = [
                    'attribute' => 'name1',
                    'label'     => Yii::t('coding', 'Name')
                ];
                $columns[] = [
                    'attribute' => 'date1',
                    'format'    => 'jdate',
                    'label'     => Yii::t('coding', 'Start Date')
                ];
                $columns[] = [
                    'attribute' => 'date2',
                    'format'    => 'jdate',
                    'label'     => Yii::t('coding', 'End Date')
                ];
                break;
        }
        $dataProvider = new ActiveDataProvider([
            'query'      => $query,
            'sort'       => false,
            'pagination' => ['defaultPageSize' => 10]
        ]);
        return [$dataProvider, $columns, $title];
    }
    /**
     * @return TcodingVML
     */
    public static function newViewModel($idnoe) {
        $data   = new TcodingVML();
        $title  = null;
        $labels = [];
        $rules  = [];
        switch ($idnoe) {
            case 1:
                $title             = Yii::t('coding', 'Types of rooms');
                $labels['name1']   = Yii::t('coding', 'Name');
                $rules             = [
                        [['name1'], 'required'],
                        [['name1'], 'string', 'max' => 255],
                ];
                break;
            case 2:
                $title             = Yii::t('coding', 'Rooms');
                $labels['id_p1']   = Yii::t('coding', 'Room type');
                $labels['name1']   = Yii::t('coding', 'Name');
                $labels['valint1'] = Yii::t('coding', 'Cost per night stay');
                $labels['valint2'] = Yii::t('coding', 'Cost per person added');
                $labels['valint3'] = Yii::t('coding', 'Number of beds');
                $labels['valint4'] = Yii::t('coding', 'Maximum capacity');
                $labels['valint5'] = Yii::t('coding', 'Active');
                $labels['name2']   = Yii::t('coding', 'Images');
                $labels['name3']   = Yii::t('coding', 'Possibilities');
                $rules             = [
                        [['id_p1', 'name1', 'valint1', 'valint2', 'valint3', 'valint4', 'valint5'], 'required'],
                        [['id_p1', 'valint1', 'valint2', 'valint3', 'valint4', 'valint5'], 'integer'],
                        [['name1'], 'string', 'max' => 255],
                        [['name2'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg, gif', 'maxFiles' => 4],
                        [['name3'], 'string'],
                ];
                break;
            case 4:
                $title             = Yii::t('coding', 'Discounts');
                $labels['name1']   = Yii::t('coding', 'Name');
                $labels['date1']   = Yii::t('coding', 'Start Date');
                $labels['date2']   = Yii::t('coding', 'End Date');
                $labels['valint1'] = Yii::t('coding', 'Type of discount');
                $rules             = [
                        [['name1', 'date1', 'date2', 'valint1'], 'required'],
                        [['valint1'], 'integer'],
                        [['valint1'], 'in', 'range' => [1, 2]],
                        [['name1'], 'string', 'max' => 255],
                        [['date1', 'date2'], 'string', 'min' => 10, 'max' => 10],
                        [['models'], 'checkIsArray', 'skipOnError' => false, 'skipOnEmpty' => false]
                ];
                $data->models      = [];
                /* @var $models ViewListOtaghha[] */
                $models            = ViewListOtaghha::find()->orderBy(['id' => SORT_ASC])->all();
                if (!$models) {
                    $data->addError('models', Yii::t('coding', 'No room was found.'));
                }
                foreach ($models as $model) {
                    $row         = new TcodingVML();
                    $row->id_p1  = $model->id;
                    $row->labels = ['valint1' => $model->name1, 'valint2' => Yii::t('coding', 'Value')];
                    $row->rules  = [
                            [['valint1'], 'required'],
                            [['valint2'], 'required', 'when' => function ($model) {
                                return $model->valint1 == 1;
                            }, 'whenClient' => "function (attribute, value) {
                                var id = attribute.id.replace('valint2', 'valint1');
                                return $('#' + id).prop('checked');
                            }"],
                            [['valint1', 'valint2'], 'integer'],
                            [['valint1'], 'in', 'range' => [0, 1]],
                    ];
                    $data->models[] = $row;
                }
                break;
            case 6:
                $title           = Yii::t('coding', 'Locks');
                $labels['name1'] = Yii::t('coding', 'Name');
                $labels['date1'] = Yii::t('coding', 'Start Date');
                $labels['date2'] = Yii::t('coding', 'End Date');
                $rules           = [
                        [['name1', 'date1', 'date2'], 'required'],
                        [['name1'], 'string', 'max' => 255],
                        [['date1', 'date2'], 'string', 'min' => 10, 'max' => 10],
                        [['models'], 'checkIsArray', 'skipOnError' => false, 'skipOnEmpty' => false]
                ];
                $data->models    = [];
                /* @var $models ViewListOtaghha[] */
                $models          = ViewListOtaghha::find()->orderBy(['id' => SORT_ASC])->all();
                if (!$models) {
                    $data->addError('models', Yii::t('coding', 'No room was found.'));
                }
                foreach ($models as $model) {
                    $row            = new TcodingVML();
                    $row->id_p1     = $model->id;
                    $row->labels    = ['valint1' => $model->name1];
                    $row->rules     = [
                            [['valint1'], 'required'],
                            [['valint1'], 'integer'],
                            [['valint1'], 'in', 'range' => [0, 1]],
                    ];
                    $data->models[] = $row;
                }
                break;
        }
        $data->labels = $labels;
        $data->rules  = $rules;
        return [$data, $title];
    }
    /**
     * @param TcodingVML $data
     * @return void
     */
    public static function loadItems($data, $idnoe) {
        switch ($idnoe) {
            case 2:
                $types     = Tcoding::find()->where(['deleted' => 0, 'id_noe' => 1])->all();
                $data->p1s = ArrayHelper::map($types, 'id', 'name1');
                break;
            case 4:
                $data->p1s = [1 => Yii::t('coding', 'Price'), 2 => Yii::t('coding', 'Percentage')];
                break;
        }
    }
    /**
     * @param TcodingVML $data
     * @return bool
     */
    public static function insert($data, $idnoe) {
        switch ($idnoe) {
            case 2:
                $data->name2 = UploadedFile::getInstances($data, 'name2');
                break;
            case 4:
            case 6:
                $data->date1 = functions::togdate($data->date1);
                $data->date2 = functions::togdate($data->date2);
                Model::loadMultiple($data->models, Yii::$app->request->post());
                break;
        }
        if (!$data->validate()) {
            return false;
        }
        $model             = new Tcoding();
        $model->id_noe     = (int) $idnoe;
        $model->deleted    = 0;
        $model->created_at = $model->updated_at = functions::getdatetime();
        $model->created_by = $model->updated_by = Yii::$app->user->id;
        switch ($model->id_noe) {
            case 1:
                $model->name1   = $data->name1;
                break;
            case 2:
                $model->id_p1   = $data->id_p1;
                $model->name1   = $data->name1;
                $model->name3   = $data->name3;
                $model->valint1 = $data->valint1;
                $model->valint2 = $data->valint2;
                $model->valint3 = $data->valint3;
                $model->valint4 = $data->valint4;
                $model->valint5 = $data->valint5;
                $saved          = $model->save();
                if (!$saved) {
                    return false;
                }
                $data->id = $model->id;
                foreach ($data->name2 as $file) {
                    $fileName = uniqid(time(), true) . '.' . $file->extension;
                    $file->saveAs('uploads/rooms/' . $fileName);

                    $modelC             = new Tcoding();
                    $modelC->id_noe     = 3;
                    $modelC->deleted    = 0;
                    $modelC->created_at = $modelC->updated_at = $model->updated_at;
                    $modelC->created_by = $modelC->updated_by = $model->updated_by;
                    $modelC->id_p1      = $model->id;
                    $modelC->name1      = $fileName;
                    $modelC->save();
                }
                return true;
            case 4:
                if (!Model::validateMultiple($data->models)) {
                    return false;
                }
                $model->name1   = $data->name1;
                $model->date1   = $data->date1;
                $model->date2   = $data->date2;
                $model->valint1 = $data->valint1;
                $saved          = $model->save();
                if (!$saved) {
                    return false;
                }
                $data->id = $model->id;
                foreach ($data->models as $row) {
                    if ($row->valint1 == 1) {
                        $modelC             = new Tcoding();
                        $modelC->id_noe     = 5;
                        $modelC->deleted    = 0;
                        $modelC->created_at = $modelC->updated_at = $model->updated_at;
                        $modelC->created_by = $modelC->updated_by = $model->updated_by;
                        $modelC->id_p1      = $row->id_p1;
                        $modelC->id_p2      = $model->id;
                        $modelC->valint1    = $row->valint2;
                        $modelC->save();
                    }
                }
                return true;
            case 6:
                if (!Model::validateMultiple($data->models)) {
                    return false;
                }
                $model->name1 = $data->name1;
                $model->date1 = $data->date1;
                $model->date2 = $data->date2;
                $saved        = $model->save();
                if (!$saved) {
                    return false;
                }
                $data->id = $model->id;
                foreach ($data->models as $row) {
                    if ($row->valint1 == 1) {
                        $modelC             = new Tcoding();
                        $modelC->id_noe     = 7;
                        $modelC->deleted    = 0;
                        $modelC->created_at = $modelC->updated_at = $model->updated_at;
                        $modelC->created_by = $modelC->updated_by = $model->updated_by;
                        $modelC->id_p1      = $row->id_p1;
                        $modelC->id_p2      = $model->id;
                        $modelC->save();
                    }
                }
                return true;
        }
        if ($model->save()) {
            $data->id = $model->id;
            return true;
        }
        return false;
    }
    /**
     * @return Tcoding
     */
    public static function findModel($id) {
        $model   = Tcoding::findOne(['id' => $id, 'deleted' => 0, 'id_noe' => [1, 2, 4, 6]]);
        $title   = null;
        $title2  = null;
        $columns = [];
        if ($model !== null) {
            switch ($model->id_noe) {
                case 1:
                    $title     = Yii::t('coding', 'Types of rooms');
                    $title2    = $model->name1;
                    $columns[] = [
                        'attribute' => 'name1',
                        'label'     => Yii::t('coding', 'Name')
                    ];
                    break;
                case 2:
                    $title     = Yii::t('coding', 'Rooms');
                    $title2    = $model->name1;
                    $columns[] = [
                        'attribute' => 'valint5',
                        'format'    => 'bool',
                        'label'     => Yii::t('coding', 'Active')
                    ];
                    $columns[] = [
                        'attribute' => 'p1.name1',
                        'label'     => Yii::t('coding', 'Room type')
                    ];
                    $columns[] = [
                        'attribute' => 'name1',
                        'label'     => Yii::t('coding', 'Room Name')
                    ];
                    $columns[] = [
                        'attribute' => 'valint1',
                        'format'    => 'toman',
                        'label'     => Yii::t('coding', 'Cost per night stay')
                    ];
                    $columns[] = [
                        'attribute' => 'valint2',
                        'format'    => 'toman',
                        'label'     => Yii::t('coding', 'Cost per person added')
                    ];
                    $columns[] = [
                        'attribute' => 'valint3',
                        'label'     => Yii::t('coding', 'Number of beds')
                    ];
                    $columns[] = [
                        'attribute' => 'valint4',
                        'label'     => Yii::t('coding', 'Maximum capacity')
                    ];
                    $columns[] = [
                        'label'  => Yii::t('coding', 'Images'),
                        'format' => 'raw',
                        'value'  => function ($model) {
                            $output = [];
                            $images = $model->getTcodings()->where(['deleted' => 0, 'id_noe' => 3])->orderBy(['id' => SORT_ASC])->all();
                            foreach ($images as $image) {
                                $url = Yii::getAlias('@web/uploads/rooms/' . $image->name1);
                                $output[] = '
                                    <a href="' . $url . '" data-image="' . $image->id . '" target="_blank">
                                        <span class="close">x</span>
                                        <img src="' . $url . '" style="max-width: 150px;max-height: 150px;"/>
                                    </a>
                                ';
                            }
                            return implode(' ', $output);
                        }
                    ];
                    $columns[] = [
                        'attribute' => 'name3',
                        'label'     => Yii::t('coding', 'Possibilities')
                    ];
                    break;
                case 4:
                    $title     = Yii::t('coding', 'Discounts');
                    $title2    = $model->name1;
                    $columns[] = [
                        'attribute' => 'name1',
                        'label'     => Yii::t('coding', 'Name')
                    ];
                    $columns[] = [
                        'attribute' => 'date1',
                        'format'    => 'jdate',
                        'label'     => Yii::t('coding', 'Start Date')
                    ];
                    $columns[] = [
                        'attribute' => 'date2',
                        'format'    => 'jdate',
                        'label'     => Yii::t('coding', 'End Date')
                    ];
                    $columns[] = [
                        'attribute' => 'valint1',
                        'label'     => Yii::t('coding', 'Type of discount'),
                        'value'     => function($model) {
                            return ($model->valint1 === 1 ? Yii::t('coding', 'Price') : ($model->valint1 === 2 ? Yii::t('coding', 'Percentage') : null));
                        }
                    ];
                    $columns[] = [
                        'label'  => Yii::t('coding', 'Rooms'),
                        'format' => 'raw',
                        'value'  => function($model) {
                            $models = Tcoding::find()->select('m1.valint1, m2.name1')->from('tcoding AS m1')->innerJoin('tcoding AS m2', 'm1.id_p1 = m2.id')->where(['m1.deleted' => 0, 'm1.id_noe' => 5, 'm1.id_p2' => $model->id])->all();
                            $output = [];
                            foreach ($models as $row) {
                                if ($model->valint1 === 1) {
                                    $output[] = $row->name1 . ': ' . functions::toman($row->valint1);
                                }
                                else if ($model->valint1 === 2) {
                                    $output[] = $row->name1 . ': %' . $row->valint1;
                                }
                            }
                            return implode('<br/>', $output);
                        }
                    ];
                    break;
                case 6:
                    $title     = Yii::t('coding', 'Locks');
                    $title2    = $model->name1;
                    $columns[] = [
                        'attribute' => 'name1',
                        'label'     => Yii::t('coding', 'Name')
                    ];
                    $columns[] = [
                        'attribute' => 'date1',
                        'format'    => 'jdate',
                        'label'     => Yii::t('coding', 'Start Date')
                    ];
                    $columns[] = [
                        'attribute' => 'date2',
                        'format'    => 'jdate',
                        'label'     => Yii::t('coding', 'End Date')
                    ];
                    $columns[] = [
                        'label'  => Yii::t('coding', 'Rooms'),
                        'format' => 'raw',
                        'value'  => function($model) {
                            $models = Tcoding::find()->select('m2.name1')->from('tcoding AS m1')->innerJoin('tcoding AS m2', 'm1.id_p1 = m2.id')->where(['m1.deleted' => 0, 'm1.id_noe' => 7, 'm1.id_p2' => $model->id])->all();
                            return implode('<br/>', ArrayHelper::getColumn($models, 'name1'));
                        }
                    ];
                    break;
            }
        }
        return [$model, $title, $columns, $title2];
    }
    /**
     * @param int $id
     * @return TcodingVML
     */
    public static function findViewModel($id) {
        list($model, $title, $columns, $title2) = self::findModel($id);
        if ($model == null) {
            return [null];
        }
        list($data, $t) = self::newViewModel($model->id_noe);
        $data->id = $model->id;
        switch ($model->id_noe) {
            case 1:
                $data->name1   = $model->name1;
                break;
            case 2:
                $data->id_p1   = $model->id_p1;
                $data->name1   = $model->name1;
                $data->name3   = $model->name3;
                $data->valint1 = $model->valint1;
                $data->valint2 = $model->valint2;
                $data->valint3 = $model->valint3;
                $data->valint4 = $model->valint4;
                $data->valint5 = $model->valint5;
                break;
            case 4:
                $data->name1   = $model->name1;
                $data->date1   = $model->date1;
                $data->date2   = $model->date2;
                $data->valint1 = $model->valint1;
                $o             = Tcoding::find()->where(['id_noe' => 5, 'deleted' => 0, 'id_p2' => $model->id])->indexBy('id_p1')->all();
                foreach ($data->models as $row) {
                    if (isset($o[$row->id_p1])) {
                        $row->valint1 = 1;
                        $row->valint2 = $o[$row->id_p1]->valint1;
                    }
                }
                break;
            case 6:
                $data->name1 = $model->name1;
                $data->date1 = $model->date1;
                $data->date2 = $model->date2;
                $o           = Tcoding::find()->where(['id_noe' => 7, 'deleted' => 0, 'id_p2' => $model->id])->indexBy('id_p1')->all();
                foreach ($data->models as $row) {
                    $row->valint1 = isset($o[$row->id_p1]) ? 1 : 0;
                }
                break;
        }
        $data->setModel($model);
        return [$data, $title, $model->id_noe, $title2];
    }
    /**
     * @param TcodingVML $data
     * @return bool
     */
    public static function update($data, $idnoe) {
        switch ($idnoe) {
            case 2:
                $data->name2 = UploadedFile::getInstances($data, 'name2');
                break;
            case 4:
            case 6:
                $data->date1 = functions::togdate($data->date1);
                $data->date2 = functions::togdate($data->date2);
                Model::loadMultiple($data->models, Yii::$app->request->post());
                break;
        }
        if (!$data->validate()) {
            return false;
        }
        $model             = $data->getModel();
        $model->updated_at = functions::getdatetime();
        $model->updated_by = Yii::$app->user->id;
        switch ($model->id_noe) {
            case 1:
                $model->name1   = $data->name1;
                break;
            case 2:
                $model->id_p1   = $data->id_p1;
                $model->name1   = $data->name1;
                $model->name3   = $data->name3;
                $model->valint1 = $data->valint1;
                $model->valint2 = $data->valint2;
                $model->valint3 = $data->valint3;
                $model->valint4 = $data->valint4;
                $model->valint5 = $data->valint5;
                $saved          = $model->save();
                if (!$saved) {
                    return false;
                }
                foreach ($data->name2 as $file) {
                    $fileName = uniqid(time(), true) . '.' . $file->extension;
                    $file->saveAs('uploads/rooms/' . $fileName);

                    $modelC             = new Tcoding();
                    $modelC->id_noe     = 3;
                    $modelC->deleted    = 0;
                    $modelC->created_at = $modelC->updated_at = $model->updated_at;
                    $modelC->created_by = $modelC->updated_by = $model->updated_by;
                    $modelC->id_p1      = $model->id;
                    $modelC->name1      = $fileName;
                    $modelC->save();
                }
                return true;
            case 4:
                if (!Model::validateMultiple($data->models)) {
                    return false;
                }
                $model->name1   = $data->name1;
                $model->date1   = $data->date1;
                $model->date2   = $data->date2;
                $model->valint1 = $data->valint1;
                $saved          = $model->save();
                if (!$saved) {
                    return false;
                }
                Tcoding::updateAll(['deleted' => 1], ['id_noe' => 5, 'deleted' => 0, 'id_p2' => $model->id]);
                foreach ($data->models as $row) {
                    if ($row->valint1 == 1) {
                        $modelC             = new Tcoding();
                        $modelC->id_noe     = 5;
                        $modelC->deleted    = 0;
                        $modelC->created_at = $modelC->updated_at = $model->updated_at;
                        $modelC->created_by = $modelC->updated_by = $model->updated_by;
                        $modelC->id_p1      = $row->id_p1;
                        $modelC->id_p2      = $model->id;
                        $modelC->valint1    = $row->valint2;
                        $modelC->save();
                    }
                }
                return true;
            case 6:
                if (!Model::validateMultiple($data->models)) {
                    return false;
                }
                $model->name1 = $data->name1;
                $model->date1 = $data->date1;
                $model->date2 = $data->date2;
                $saved        = $model->save();
                if (!$saved) {
                    return false;
                }
                Tcoding::updateAll(['deleted' => 1], ['id_noe' => 7, 'deleted' => 0, 'id_p2' => $model->id]);
                foreach ($data->models as $row) {
                    if ($row->valint1 == 1) {
                        $modelC             = new Tcoding();
                        $modelC->id_noe     = 7;
                        $modelC->deleted    = 0;
                        $modelC->created_at = $modelC->updated_at = $model->updated_at;
                        $modelC->created_by = $modelC->updated_by = $model->updated_by;
                        $modelC->id_p1      = $row->id_p1;
                        $modelC->id_p2      = $model->id;
                        $modelC->save();
                    }
                }
                return true;
        }
        return $model->save();
    }
    /**
     * @param int $id
     * @return bool
     */
    public static function delete($id) {
        list($model, $title, $columns, $title2) = self::findModel($id);
        if ($model == null) {
            return [null, null];
        }
        $model->deleted    = 1;
        $model->updated_at = functions::getdatetime();
        $model->updated_by = Yii::$app->user->id;
        $saved             = $model->save();
        return [$saved, $model->id_noe];
    }
    /**
     * @param int $id
     * @return bool
     */
    public static function deleteImage($id) {
        $model = Tcoding::findOne(['deleted' => 0, 'id_noe' => 3, 'id' => $id]);
        if ($model == null) {
            return [false, ['id' => 'فایلی یافت نشد']];
        }
        $model->deleted    = 1;
        $model->updated_at = functions::getdatetime();
        $model->updated_by = Yii::$app->user->id;
        $saved             = $model->save();
        return [$saved, []];
    }
}