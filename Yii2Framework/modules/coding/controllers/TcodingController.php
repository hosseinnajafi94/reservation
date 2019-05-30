<?php
namespace app\modules\coding\controllers;
use Yii;
use yii\filters\AccessControl;
use app\config\widgets\Controller;
use app\config\components\functions;
use app\modules\coding\models\SRL\TcodingSRL;
class TcodingController extends Controller {
    private $items;
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow'      => true,
                        'actions'    => ['index'],
                        'roles'      => ['Tcoding'],
                        'verbs'      => ['GET'],
                        'roleParams' => ['idnoe' => Yii::$app->request->get('idnoe')],
                    ],
                    [
                        'allow'   => true,
                        'actions' => ['view'],
                        'roles'   => ['Tcoding'],
                        'verbs'   => ['GET'],
                        'roleParams' => function() {
                            $id = Yii::$app->request->get('id');
                            $this->items = TcodingSRL::findModel($id);
                            $model = $this->items[0];
                            if ($model == null) {
                                return false;
                            }
                            return ['idnoe' => $model->id_noe];
                        },
                    ],
                    [
                        'allow'   => true,
                        'actions' => ['delete'],
                        'roles'   => ['Tcoding'],
                        'verbs'   => ['POST'],
                        'roleParams' => function() {
                            $id = Yii::$app->request->get('id');
                            $this->items = TcodingSRL::findModel($id);
                            $model = $this->items[0];
                            if ($model == null) {
                                return false;
                            }
                            return ['idnoe' => $model->id_noe];
                        },
                    ],
                    [
                        'allow'   => true,
                        'actions' => ['delete-image'],
                        'roles'   => ['Tcoding'],
                        'verbs'   => ['POST'],
                        'roleParams' => ['idnoe' => 2],
                    ],
                    [
                        'allow'      => true,
                        'actions'    => ['create'],
                        'roles'      => ['Tcoding'],
                        'verbs'      => ['GET', 'POST'],
                        'roleParams' => ['idnoe' => Yii::$app->request->get('idnoe')],
                    ],
                    [
                        'allow'   => true,
                        'actions' => ['update'],
                        'roles'   => ['Tcoding'],
                        'verbs'   => ['GET', 'POST'],
                        'roleParams' => function() {
                            $id = Yii::$app->request->get('id');
                            $this->items = TcodingSRL::findViewModel($id);
                            $model = $this->items[0];
                            if ($model == null) {
                                return false;
                            }
                            return ['idnoe' => $model->model->id_noe];
                        },
                    ],
                ],
            ],
        ];
    }
    public function actionIndex($idnoe) {
        if (is_numeric($idnoe) === false || in_array($idnoe, [1, 2, 4, 6]) === false) {
            return functions::httpNotFound();
        }
        list($dataProvider, $columns, $title) = TcodingSRL::searchModel($idnoe);
        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'columns' => $columns,
            'title' => $title,
            'idnoe' => $idnoe,
        ]);
    }
    public function actionView() {
        list($model, $title, $columns, $title2) = $this->items;
        return $this->render('view', [
            'model' => $model,
            'title' => $title,
            'columns' => $columns,
            'title2' => $title2,
        ]);
    }
    public function actionCreate($idnoe) {
        list($model, $title) = TcodingSRL::newViewModel($idnoe);
        if ($model->load(Yii::$app->request->post()) && TcodingSRL::insert($model, $idnoe)) {
            functions::setSuccessFlash();
            return $this->redirect(['view', 'id' => $model->id]);
        }
        TcodingSRL::loadItems($model, $idnoe);
        return $this->render('create', [
            'model' => $model,
            'title' => $title,
            'idnoe' => $idnoe,
        ]);
    }
    public function actionUpdate() {
        list($model, $title, $idnoe, $title2) = $this->items;
        if ($model->load(Yii::$app->request->post()) && TcodingSRL::update($model, $idnoe)) {
            functions::setSuccessFlash();
            return $this->redirect(['view', 'id' => $model->id]);
        }
        TcodingSRL::loadItems($model, $idnoe);
        return $this->render('update', [
            'model' => $model,
            'title' => $title,
            'idnoe' => $idnoe,
            'title2' => $title2,
        ]);
    }
    public function actionDelete($id) {
        list($deleted, $idnoe) = TcodingSRL::delete($id);
        if ($deleted === null) {
            return functions::httpNotFound();
        }
        else if ($deleted) {
            functions::setSuccessFlash();
        }
        else {
            functions::setFailFlash();
        }
        return $this->redirect(['index', 'idnoe' => $idnoe]);
    }
    public function actionDeleteImage() {
        $id = Yii::$app->request->post('id');
        list($saved, $messages) = TcodingSRL::deleteImage($id);
        return $this->asJson(['saved' => $saved, 'messages' => $messages]);
    }
}