<?php

// user class

class UserRegister
{
    public $fname;
    public $lname;
    public $email;
    public $password;
    public $confirmPassword;
    public $errorMessage = null;
    public $successMsg = null;
    public $passErrorMsg = null;
    const PATH =  "C:\\Users\\HP\\Documents\\login-reg-project\\users.json";
    // public $data = [];

    public function __construct($fname, $lname, $email, $password, $confirmPassword)
    {
        $this->fname = $fname;
        $this->lname = $lname;
        $this->email = $email;
        $this->password = $password;
        $this->confirmPassword = $confirmPassword;
    }

    public static function allUser()
    {

        $users =  json_decode(file_get_contents(self::PATH), true);

        return $users;
    }

    public function addUser()
    {
        $users =  json_decode(file_get_contents(self::PATH), true);

        $data = ['fname' => $this->fname, 'lname' => $this->lname, 'email' => $this->email, 'password' => password_hash($this->password, PASSWORD_BCRYPT)];


        //check user is exist already
        $userEmails = array_column($users['users'], 'email');

        foreach ($userEmails as $userEmail) {
            if ($this->email == $userEmail) {
                return $this->errorMessage = 'User already exist';
            }
        }

        array_push($users['users'], $data);

        $users_data = json_encode($users);

        if ($this->password == $this->confirmPassword) {
            file_put_contents(self::PATH, $users_data);
            return  $this->successMsg = 'User created successfully';
        } else {
            return $this->passErrorMsg = 'Password didn\'t match';
        }
    }
}


class LoginUser
{

    public $email;
    public $password;
    public $logedIn = false;
    public $userData  = [];
    const PATH =  "C:\\Users\\HP\\Documents\\login-reg-project\\users.json";

    public function __construct($email, $password)
    {
        $this->email = $email;
        $this->password = $password;
    }

    public function checkUser()
    {
        $users = json_decode(file_get_contents(self::PATH), true)['users'];

        foreach ($users as $user) {

            if ($this->email == $user['email'] &&  password_verify($this->password, $user['password'])) {
                $this->logedIn = true;
                $this->userData = $user;
                return;
            }
        }
    }
}
