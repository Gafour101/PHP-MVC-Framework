<?php 
    namespace app\models;

    use gaf\phpmvc\Model;
    use gaf\phpmvc\db\DbModel;
    use gaf\phpmvc\Application; // Import the Application class
    /**

        * Class Application
        *
        * @author Gafour Panolong <gafopanolong.gafour@s.msumain.edu.ph>
        * @package app\models
        
    **/

    class LoginForm extends Model
    {
        public string $email = '';
        public string $password = '';

        public function rules(): array
        {
            return [
                'email' => [self::RULE_REQUIRED, self::RULE_EMAIL],
                'password' => [self::RULE_REQUIRED]
            ];
        }

        public function labels(): array
        {
            return [
                'email' => 'Email',
                'password' => 'Password'
            ];
        }

        public function login()
        {
            $user = new User();
            $userFound = $user->findUser(['email' => $this->email]);

            if (!$userFound) {
                $this->addError('email', 'User does not exist with this email');
                return false;
            }

            $hashedPassword = $userFound->password;
            if (!password_verify($this->password, $hashedPassword)) {
                $this->addError('password', 'Password is incorrect');
                return false;
            }
            
            
            return Application::$app->login($userFound);
        }
    }