<?php
    
    require_once('Manager.php');

    class UserManager extends Manager { 

        public function isExisting($email) {
            $dataBase = $this->connectToDb();
            $request  = $dataBase->prepare('SELECT * FROM user WHERE email = :email');
            $request->execute(array('email' => $email));
            $result = $request->fetch();
            if(!empty($result['email'])) {
                return true;
            }

            return false;
        }

        public function addUser($firstName, $lastName, $email, $password) {
            $dataBase = $this->connectToDb();
            $request  = $dataBase->prepare('INSERT INTO user(first_name, last_name, email, passwd) VALUES(:first_name, :last_name, :email, :passwd)');
            $result   = $request->execute(array(
                'first_name' => $firstName,
                'last_name'  => $lastName,
                'email'      => $email,
                'passwd'     => md5("azerty".$password."qsdf")
            ));

            return $result;
        }

        public function logInUser($email, $password) {
            $dataBase = $this->connectToDb();
            $request  = $dataBase->prepare('SELECT * FROM user WHERE email = :email AND passwd = :passwd');
            $request->execute(array(
                'email'  => $email,
                'passwd' => md5("azerty".$password."qsdf")
            ));
            $result = $request->fetch();
            if(!empty($result['email']) && !empty($result['passwd'])) {
                $_SESSION['id']         = $result['id'];
                $_SESSION['first_name'] = $result['first_name'];
                $_SESSION['last_name']  = $result['last_name'];
                return true;
            }

            return false;
        }

        public function logOutUser() {
            session_destroy();
            header('Location: /inscription');
        }
    }