<?php
namespace frontend\models;

use Ramsey\Uuid\Uuid;
use Yii;
use yii\base\Model;

/**
 * Signup form
 */
class SignupForm extends Model
{
    /** @var string $username */
    public $username;

    /** @var string $email */
    public $email;

    /** @var int $mobile */
    public $mobile;

    /** @var string $password */
    public $password;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\frontend\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\frontend\models\User', 'message' => 'This email address has already been taken.'],

            ['mobile', 'trim'],
            ['mobile', 'required'],
            ['mobile', 'string', 'min' => 10],
            ['mobile', 'unique', 'targetClass' => '\frontend\models\User', 'message' => 'This mobile number has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],
        ];
    }

    /**
     * Signs user up.
     *
     * @return bool whether the creating new account was successful and email was sent
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        
        $user = new User();
        $user->id = Uuid::uuid4()->toString();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->mobile = $this->mobile;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $user->generateEmailVerificationToken();
        return $user->save() && $this->sendEmail($user);

    }

    /**
     * Sends confirmation email to user
     * @param User $user user model to with email should be send
     * @return bool whether the email was sent
     */
    protected function sendEmail($user)
    {
        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'emailVerify-html', 'text' => 'emailVerify-text'],
                ['user' => $user]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
            ->setTo($this->email)
            ->setSubject('Account registration at ' . Yii::$app->name)
            ->send();
    }


    /**
     * Convert mobile number from input mask to integer
     *
     * @param string $mobile
     *
     * @return int
     */
    private function convertMobile(string $mobile): int
    {
        $mobile = str_replace(['+', '(', ')', ' '], '', $mobile);
        return (int) $mobile;
    }
}

