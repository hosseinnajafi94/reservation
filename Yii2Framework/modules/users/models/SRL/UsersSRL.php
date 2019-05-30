<?php
namespace app\modules\users\models\SRL;
use Yii;
use yii\data\ActiveDataProvider;
use app\modules\users\models\DAL\Users;
use app\modules\users\models\VML\UsersVML;
use app\config\components\functions;
use app\config\widgets\ArrayHelper;
class UsersSRL {
    /**
     * @return array [UsersSearchVML $searchModel, ActiveDataProvider $dataProvider]
     */
    public static function searchModel() {
        $module       = Yii::$app->getModule('users');
        $query        = Users::find()->where([
            'group_id'  => $module->params['group.User'],
            'status_id' => $module->params['status.Active']
        ]);
        $query->orderBy(['id' => SORT_DESC]);
        $dataProvider = new ActiveDataProvider([
            'query'      => $query,
            'sort'       => false,
            'pagination' => ['defaultPageSize' => 10]
        ]);
        return $dataProvider;
    }
    /**
     * @return UsersVML
     */
    public static function newViewModel($scenario) {
        $data           = new UsersVML();
        $data->scenario = $scenario;
        return $data;
    }
    /**
     * @param UsersVML $data
     * @return void
     */
    public static function loadItems($data) {
        $items        = Users::find()
                ->select('name as fname, description as lname')
                ->from('auth_item')
                ->where("name not in ('Reservation', 'Tcoding')")
                ->orderBy('CAST(description AS UNSIGNED) ASC')
                ->all();
        $data->_roles = ArrayHelper::map($items, 'fname', 'lname');
    }
    /**
     * @param UsersVML $data
     * @return bool
     */
    public static function insert($data) {
        if (!$data->validate()) {
            return false;
        }
        if ($data->scenario != 'create') {
            return false;
        }
        $userId               = Yii::$app->user->id;
        $datetime             = functions::getdatetime();
        $module               = Yii::$app->getModule('users');
        $model                = new Users();
        $model->email         = $data->email ? $data->email : null;
        $model->mobile        = $data->mobile;
        $model->fname         = $data->fname;
        $model->lname         = $data->lname;
        $model->password_hash = Yii::$app->security->generatePasswordHash($module->params['defaultPassword']);
        $model->auth_key      = Yii::$app->security->generateRandomString();
        $model->status_id     = $module->params['status.Active'];
        $model->group_id      = $module->params['group.User'];
        $model->created_at    = $datetime;
        $model->created_by    = $userId;
        $model->updated_at    = $datetime;
        $model->updated_by    = $userId;
        $model->avatar        = $module->params['defaultAvatar'];
        if ($model->save()) {
            $data->id = $model->id;
            self::assignRoleToUser($data);
            return true;
        }
        return false;
    }
    /**
     * @return Users
     */
    public static function findModel($id) {
        $module = Yii::$app->getModule('users');
        return Users::findOne([
                    'id'        => $id,
                    'status_id' => $module->params['status.Active']
        ]);
    }
    /**
     * @return Users
     */
    public static function findUser($id) {
        return Users::findOne($id);
    }
    /**
     * @param int $id
     * @return UsersVML
     */
    public static function findViewModel($id, $scenario) {
        $model = self::findModel($id);
        if ($model == null) {
            return null;
        }
        $data           = new UsersVML();
        $data->scenario = $scenario;
        $data->id       = $model->id;
        $data->email    = $model->email;
        $data->mobile   = $model->mobile;
        $data->fname    = $model->fname;
        $data->lname    = $model->lname;
        if ($data->scenario == 'update') {
            $auth        = Yii::$app->authManager;
            $permissions = $auth->getPermissionsByUser($data->id);
            foreach ($permissions as $name => $permission) {
                $data->roles[] = $name;
            }
        }
        $data->setModel($model);
        return $data;
    }
    /**
     * @param UsersVML $data
     * @return bool
     */
    public static function update($data) {
        if (!$data->validate()) {
            return false;
        }
        $model = $data->getModel();
        if ($data->scenario == 'change-password') {
            $isValid = Yii::$app->security->validatePassword($data->old_password, $model->password_hash);
            if (!$isValid) {
                $data->addError('old_password', Yii::t('users', 'The old password is wrong!'));
                return false;
            }
            if ($data->new_password != $data->new_password_repeat) {
                $data->addError('new_password_repeat', Yii::t('users', 'New password is not equal to repetition.'));
                return false;
            }
            $model->password_hash = Yii::$app->security->generatePasswordHash($data->new_password);
            return $model->save();
        }
        else if ($data->scenario == 'update-profile') {
            $model->email      = $data->email ? $data->email : null;
            $model->mobile     = $data->mobile;
            $model->fname      = $data->fname;
            $model->lname      = $data->lname;
            $model->updated_at = functions::getdatetime();
            $model->updated_by = Yii::$app->user->id;
            return $model->save();
        }
        else if ($data->scenario == 'update') {
            $model->email      = $data->email ? $data->email : null;
            $model->mobile     = $data->mobile;
            $model->fname      = $data->fname;
            $model->lname      = $data->lname;
            $model->updated_at = functions::getdatetime();
            $model->updated_by = Yii::$app->user->id;
            if ($model->save()) {
                self::assignRoleToUser($data);
                return true;
            }
            return false;
        }
        return false;
    }
    /**
     * @param int $id
     * @return bool
     */
    public static function delete($id) {
        $model = self::findModel($id);
        if ($model == null) {
            return false;
        }
        $module           = Yii::$app->getModule('users');
        $model->status_id = $module->params['status.Delete'];
        return $model->save();
    }
    /**
     * @param int $id
     * @return bool
     */
    public static function resetPasswordUser($id) {
        $model = self::findModel($id);
        if ($model == null) {
            return false;
        }
        $module               = Yii::$app->getModule('users');
        $model->password_hash = Yii::$app->security->generatePasswordHash($module->params['defaultPassword']);
        return $model->save();
    }
    /**
     * @param UsersVML $user User View Model
     * @return void
     */
    public static function assignRoleToUser($user) {
        $auth = Yii::$app->authManager;
        $auth->revokeAll($user->id);
        foreach ($user->roles as $role) {
            $auth->assign($auth->getPermission($role), $user->id);
        }
    }
    /**
     * @return Users Users Model Modir
     */
    public static function getModir() {
        $module = Yii::$app->getModule('users');
        $query  = Users::find()->where([
            'group_id'  => $module->params['group.Admin'],
            'status_id' => $module->params['status.Active']
        ]);
        return $query->orderBy(['id' => SORT_DESC])->one();
    }
}