<?php
namespace app\modules\coding\controllers;
use Yii;
use yii\filters\AccessControl;
use app\config\widgets\Controller;
use app\config\widgets\ArrayHelper;
use app\config\components\functions;
use app\modules\coding\models\SRL\ReservationsSRL;
class ReservationsController extends Controller {
    private $items;
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow'   => true,
                        'actions' => ['index'],
                        'roles'   => ['Reservation'],
                        'verbs'   => ['GET'],
                        'roleParams' => ['idp1' => Yii::$app->request->get('idp1')],
                    ],
                    [
                        'allow'   => true,
                        'actions' => ['view'],
                        'roles'   => ['Reservation'],
                        'verbs'   => ['GET'],
                        'roleParams' => function() {
                            $id = Yii::$app->request->get('id');
                            $this->items = ReservationsSRL::findModel($id);
                            $model = $this->items[0];
                            if ($model == null) {
                                return false;
                            }
                            return ['idp1' => $model->id_p1];
                        },
                    ],
                    [
                        'allow'   => true,
                        'actions' => ['create'],
                        'roles'   => ['Reservation'],
                        'verbs'   => ['GET', 'POST'],
                        'roleParams' => ['idp1' => 2],
                    ],
                    [
                        'allow'   => true,
                        'actions' => ['rooms', 'discounts'],
                        'roles'   => ['Reservation'],
                        'verbs'   => ['POST'],
                        'roleParams' => ['idp1' => 2],
                    ],
                ],
            ],
        ];
    }
    public function actionIndex($idp1) {
        list($dataProvider, $searchModel, $columns, $title) = ReservationsSRL::searchModel($idp1);
        return $this->render('index', [
                    'dataProvider' => $dataProvider,
                    'searchModel'  => $searchModel,
                    'columns'      => $columns,
                    'title'        => $title,
                    'idp1'         => $idp1,
        ]);
    }
    public function actionView() {
        list($model, $title, $columns, $title2) = $this->items;
        return $this->render('view', [
                    'model'   => $model,
                    'title'   => $title,
                    'columns' => $columns,
                    'title2'  => $title2,
        ]);
    }
    public function actionCreate() {
        list($model, $title) = ReservationsSRL::newViewModel();
        if ($model->load(Yii::$app->request->post()) && ReservationsSRL::insert($model)) {
            functions::setSuccessFlash();
            return $this->redirect(['view', 'id' => $model->id]);
        }
        ReservationsSRL::loadItems($model);
        return $this->render('create', [
                    'model' => $model,
                    'title' => $title,
        ]);
    }
    public function actionRooms() {
        $list  = [];
        $date1 = functions::togdate(Yii::$app->request->post('date1'));
        $date2 = functions::togdate(Yii::$app->request->post('date2'));
        $time1 = strtotime($date1);
        $time2 = strtotime($date2);
        if ($time1 <= $time2 && date('Y-m-d', $time1) == $date1 && date('Y-m-d', $time2) == $date2) {
            $list = ReservationsSRL::getRooms($date1, $date2);
        }
        return $this->asJson(['saved' => true, 'list' => ArrayHelper::map($list, 'id', 'name1')]);
    }
    public function actionDiscounts() {
        $roomId = Yii::$app->request->post('id');
        $date1  = functions::togdate(Yii::$app->request->post('date1'));
        $rows   = ReservationsSRL::getDiscounts($date1, $roomId);
        return $this->asJson(['saved' => true, 'list' => ArrayHelper::map($rows, 'id', 'name1')]);
    }
}