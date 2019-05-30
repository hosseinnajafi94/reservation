<?php
namespace app\modules\site\controllers;
use Yii;
use yii\filters\AccessControl;
use app\config\widgets\Controller;
use app\config\components\functions;
use app\modules\site\models\SRL\SiteSettingsSRL;
class SettingsController extends Controller {
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow'   => true,
                        'actions' => ['index'],
                        'roles'   => ['SiteSettings'],
                        'verbs'   => ['GET', 'POST']
                    ],
                ],
            ],
        ];
    }
    public function actionIndex() {
        $model      = SiteSettingsSRL::get();
        $oldLogo    = $model->logo;
        $oldFavicon = $model->favicon;
        if ($model->load(Yii::$app->request->post()) && SiteSettingsSRL::save($model, $oldLogo, $oldFavicon)) {
            functions::setSuccessFlash();
            return $this->refresh();
        }
        return $this->renderView($model);
    }
}