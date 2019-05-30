<?php
namespace app\modules\users\models\DAL;
use Yii;
use app\modules\coding\models\DAL\Tcoding;
/**
 * This is the model class for table "users".
 * @author Hossein Najafi <hnajafi1994@gmail.com>
 *
 * @property int $id
 * @property int $status_id
 * @property int $group_id
 * @property string $username
 * @property string $email
 * @property string $mobile
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $created_at
 * @property int $created_by
 * @property string $updated_at
 * @property int $updated_by
 * @property string $fname
 * @property string $lname
 * @property string $avatar
 *
 * @property Tcoding[] $tcodings
 * @property Tcoding[] $tcodings0
 * @property UsersStatus $status
 * @property UsersGroups $group
 * @property Users $createdBy
 * @property Users[] $users
 * @property Users $updatedBy
 * @property Users[] $users0
 */
class Users extends \yii\db\ActiveRecord {
    public static function tableName() {
        return 'users';
    }
    public function rules() {
        return [
                [['status_id', 'group_id', 'mobile', 'auth_key', 'password_hash', 'created_at', 'created_by', 'updated_at', 'updated_by', 'fname', 'lname', 'avatar'], 'required'],
                [['status_id', 'group_id', 'created_by', 'updated_by'], 'integer'],
                [['created_at', 'updated_at'], 'safe'],
                [['username', 'email', 'mobile', 'password_hash', 'password_reset_token', 'fname', 'lname', 'avatar'], 'string', 'max' => 255],
                [['auth_key'], 'string', 'max' => 32],
                [['auth_key'], 'unique'],
                [['mobile'], 'unique'],
                [['email'], 'unique'],
                [['username'], 'unique'],
                [['status_id'], 'exist', 'skipOnError' => true, 'targetClass' => UsersStatus::className(), 'targetAttribute' => ['status_id' => 'id']],
                [['group_id'], 'exist', 'skipOnError' => true, 'targetClass' => UsersGroups::className(), 'targetAttribute' => ['group_id' => 'id']],
                [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['created_by' => 'id']],
                [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['updated_by' => 'id']],
        ];
    }
    public function attributeLabels() {
        return [
            'id' => Yii::t('users', 'ID'),
            'status_id' => Yii::t('users', 'Status ID'),
            'group_id' => Yii::t('users', 'Group ID'),
            'username' => Yii::t('users', 'Username'),
            'email' => Yii::t('users', 'Email'),
            'mobile' => Yii::t('users', 'Mobile'),
            'auth_key' => Yii::t('users', 'Auth Key'),
            'password_hash' => Yii::t('users', 'Password Hash'),
            'password_reset_token' => Yii::t('users', 'Password Reset Token'),
            'created_at' => Yii::t('users', 'Created At'),
            'created_by' => Yii::t('users', 'Created By'),
            'updated_at' => Yii::t('users', 'Updated At'),
            'updated_by' => Yii::t('users', 'Updated By'),
            'fname' => Yii::t('users', 'Fname'),
            'lname' => Yii::t('users', 'Lname'),
            'avatar' => Yii::t('users', 'Avatar'),
        ];
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTcodings() {
        return $this->hasMany(Tcoding::className(), ['created_by' => 'id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTcodings0() {
        return $this->hasMany(Tcoding::className(), ['updated_by' => 'id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStatus() {
        return $this->hasOne(UsersStatus::className(), ['id' => 'status_id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroup() {
        return $this->hasOne(UsersGroups::className(), ['id' => 'group_id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy() {
        return $this->hasOne(Users::className(), ['id' => 'created_by']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers() {
        return $this->hasMany(Users::className(), ['created_by' => 'id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedBy() {
        return $this->hasOne(Users::className(), ['id' => 'updated_by']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers0() {
        return $this->hasMany(Users::className(), ['updated_by' => 'id']);
    }
}