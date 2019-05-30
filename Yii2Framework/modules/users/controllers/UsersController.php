<?php
namespace app\modules\users\controllers;
use Yii;
use yii\filters\AccessControl;
use app\config\widgets\Controller;
use app\config\components\functions;
use app\modules\users\models\SRL\UsersSRL;
class UsersController extends Controller {
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                        [
                        'allow'   => true,
                        'actions' => ['index', 'view', 'role'],
                        'roles'   => ['Users'],
                        'verbs'   => ['GET']
                    ],
                        [
                        'allow'   => true,
                        'actions' => ['delete', 'reset-password'],
                        'roles'   => ['Users'],
                        'verbs'   => ['POST']
                    ],
                        [
                        'allow'   => true,
                        'actions' => ['create', 'update'],
                        'roles'   => ['Users'],
                        'verbs'   => ['GET', 'POST']
                    ],
                ],
            ],
        ];
    }
    public function actionIndex() {
        $model = UsersSRL::searchModel();
        return $this->renderView($model);
    }
    public function actionView($id) {
        $model = UsersSRL::findModel($id);
        if ($model == null) {
            functions::httpNotFound();
        }
        return $this->renderView($model);
    }
    public function actionCreate() {
        $model = UsersSRL::newViewModel('create');
        if ($model->load(Yii::$app->request->post()) && UsersSRL::insert($model)) {
            functions::setSuccessFlash();
            return $this->redirectToView(['id' => $model->id]);
        }
        UsersSRL::loadItems($model);
        return $this->renderView($model);
    }
    public function actionUpdate($id) {
        $model = UsersSRL::findViewModel($id, 'update');
        if ($model == null) {
            functions::httpNotFound();
        }
        if ($model->load(Yii::$app->request->post()) && UsersSRL::update($model)) {
            functions::setSuccessFlash();
            return $this->redirectToView(['id' => $model->id]);
        }
        UsersSRL::loadItems($model);
        return $this->renderView($model);
    }
    public function actionDelete($id) {
        $deleted = UsersSRL::delete($id);
        if ($deleted) {
            functions::setSuccessFlash();
        }
        else {
            functions::setFailFlash();
        }
        return $this->redirectToIndex();
    }
    public function actionResetPassword($id) {
        $reset = UsersSRL::resetPasswordUser($id);
        if ($reset) {
            functions::setSuccessFlash();
        }
        else {
            functions::setFailFlash();
        }
        return $this->redirectToView(['id' => $id], 'reset-password');
    }
    public function actionRole() {
        $auth = Yii::$app->authManager;
        $auth->removeAll();

        $reservationRule = new \app\modules\users\components\ReservationRule();
        $auth->add($reservationRule);

        $tcodingRule = new \app\modules\users\components\TcodingRule();
        $auth->add($tcodingRule);

        $tcoding              = $auth->createPermission('Tcoding');
        $tcoding->description = '0- اطلاعات پایه';
        $auth->add($tcoding);

        $reservation              = $auth->createPermission('Reservation');
        $reservation->description = '0- رزرو';
        $auth->add($reservation);

        $dashboard              = $auth->createPermission('Dashboard');
        $dashboard->description = '1- داشبورد';
        $auth->add($dashboard);

        $profile = $auth->createPermission('Profile');
        $profile->description = '2- پروفایل';
        $auth->add($profile);

        $users              = $auth->createPermission('Users');
        $users->description = '3- کاربران';
        $auth->add($users);

        $roomTypes              = $auth->createPermission('RoomTypes');
        $roomTypes->description = '4- انواع اتاق';
        $roomTypes->ruleName    = $tcodingRule->name;
        $auth->add($roomTypes);
        $auth->addChild($roomTypes, $tcoding);

        $rooms              = $auth->createPermission('Rooms');
        $rooms->description = '5- اتاق ها';
        $rooms->ruleName    = $tcodingRule->name;
        $auth->add($rooms);
        $auth->addChild($rooms, $tcoding);

        $discounts              = $auth->createPermission('Discounts');
        $discounts->description = '6- تخفیفات';
        $discounts->ruleName    = $tcodingRule->name;
        $auth->add($discounts);
        $auth->addChild($discounts, $tcoding);

        $locks              = $auth->createPermission('Locks');
        $locks->description = '7- قفل ها';
        $locks->ruleName    = $tcodingRule->name;
        $auth->add($locks);
        $auth->addChild($locks, $tcoding);

        $definitiveReservations              = $auth->createPermission('DefinitiveReservations');
        $definitiveReservations->description = '8- رزرو های قطعی شده';
        $definitiveReservations->ruleName    = $reservationRule->name;
        $auth->add($definitiveReservations);
        $auth->addChild($definitiveReservations, $reservation);

        $ongoingReservations              = $auth->createPermission('OngoingReservations');
        $ongoingReservations->description = '9- رزرو های درحال انجام';
        $ongoingReservations->ruleName    = $reservationRule->name;
        $auth->add($ongoingReservations);
        $auth->addChild($ongoingReservations, $reservation);

        $canceledReservations              = $auth->createPermission('CanceledReservations');
        $canceledReservations->description = '10- رزرو های لغو شده';
        $canceledReservations->ruleName    = $reservationRule->name;
        $auth->add($canceledReservations);
        $auth->addChild($canceledReservations, $reservation);

        $sms              = $auth->createPermission('Sms');
        $sms->description = '11- پیامک ها';
        $auth->add($sms);

        $smsSettings              = $auth->createPermission('SmsSettings');
        $smsSettings->description = '12- تنظیمات پیامک';
        $auth->add($smsSettings);

        $email              = $auth->createPermission('Email');
        $email->description = '13- ایمیل ها';
        $auth->add($email);

        $emailSettings              = $auth->createPermission('EmailSettings');
        $emailSettings->description = '14- تنظیمات ایمیل';
        $auth->add($emailSettings);

        $siteSettings              = $auth->createPermission('SiteSettings');
        $siteSettings->description = '15- تنظیمات سایت';
        $auth->add($siteSettings);

        $auth->assign($dashboard, 1);
        $auth->assign($profile, 1);
        $auth->assign($users, 1);
        $auth->assign($tcoding, 1);
        $auth->assign($reservation, 1);
        $auth->assign($sms, 1);
        $auth->assign($smsSettings, 1);
        $auth->assign($email, 1);
        $auth->assign($emailSettings, 1);
        $auth->assign($siteSettings, 1);
        
        $auth->assign($dashboard, 2);
        $auth->assign($profile, 2);
        $auth->assign($roomTypes, 2);
        $auth->assign($rooms, 2);
        $auth->assign($discounts, 2);
        $auth->assign($locks, 2);
        
        $auth->assign($dashboard, 3);
        $auth->assign($profile, 3);
        $auth->assign($definitiveReservations, 3);
        $auth->assign($ongoingReservations, 3);
        $auth->assign($canceledReservations, 3);
    }
    public function actionRole2() {
        //Yii::$app->authManager->revokeAll(Yii::$app->user->id);
        //$assignments = Yii::$app->authManager->getAssignments(Yii::$app->user->id);
        //echo '<pre>';
        //var_dump($assignments);
        //echo '</pre>';
        //return '';
        //$auth = Yii::$app->authManager;
        //$auth->removeAll();
        //
        // Rule
        //$rule = new \app\modules\users\components\Rule();
        //$auth->add($rule);
        //
        //$userGroupRule = new \app\modules\users\components\UserGroupRule();
        //$auth->add($userGroupRule);
        //
        // Role
        //$user = $auth->createRole('user');
        //$user->ruleName = $userGroupRule->name;
        //$auth->add($user);
        //
        //$admin = $auth->createRole('admin');
        //$admin->ruleName = $userGroupRule->name;
        //$auth->add($admin);
        //$auth->addChild($admin, $user);
        //
        // Permission
        //$createPost              = $auth->createPermission('createPost');
        //$createPost->description = 'Create a post';
        //$auth->add($createPost);
        //
        //$updatePost              = $auth->createPermission('updatePost');
        //$updatePost->description = 'Update post';
        //$auth->add($updatePost);
        //
        //$updateOwnPost              = $auth->createPermission('updateOwnPost');
        //$updateOwnPost->description = 'Update own post';
        //$updateOwnPost->ruleName    = $rule->name;
        //$auth->add($updateOwnPost);
        //
        // Add Child
        //$auth->addChild($user, $createPost);
        //$auth->addChild($admin, $updatePost);
        //$auth->addChild($updateOwnPost, $updatePost);
        //$auth->addChild($user, $updateOwnPost);
        //
        //[
        //    'allow' => true,
        //    'actions' => ['update'],
        //    'roles' => ['updatePost'],
        //    'roleParams' => function() {
        //        return ['post' => Post::findOne(['id' => Yii::$app->request->get('id')])];
        //    },
        //],
        //
        //[
        //    'allow' => true,
        //    'actions' => ['update'],
        //    'roles' => ['updatePost'],
        //    'roleParams' => ['postId' => Yii::$app->request->get('id')],
        //],
        //
        //$auth = \Yii::$app->authManager;
        //$userRole = $auth->getRole('author');
        //$auth->assign($userRole, $user->getId());
    }
}