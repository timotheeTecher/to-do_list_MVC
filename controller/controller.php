<?php
    require('model/UserManager.php');
    require('model/TaskManager.php');

    function loadSignUp() {
        require('view/signUpView.php');
    }

    function signUp($first_name, $last_name, $email, $password) {
        $userManager = new UserManager();
        if($userManager->isExisting($email)) {
            echo "Vous êtes déjà inscrit";
        } else {
            $result = $userManager->addUser($first_name, $last_name, $email, $password);
            if($result === false) {
                throw new Exception("Impossible de s'inscrire pour le moment");
            } else {
                $logged = $userManager->logInUser($email, $password);
                if($logged === false) {
                    throw new Exception("Impossible de s'inscrire pour le moment");
                } else {
                    header('Location: /todolist');
                    exit();
                }
            }
        }
    }

    function loadSignIn() {
        require('view/signInView.php');
    }
    
    function signIn($email, $password) {
        $userManager = new UserManager();
        if(!$userManager->isExisting($email)) {
            echo "Erreur de login";
        } else {
            $result = $userManager->logInUser($email, $password);
            if($result === false) {
                throw new Exception("Impossible de se connecter pour le moment");
            } else {
                header('Location: /todolist');
                exit();
            }
        }
    }

    function logOut() {
        $userManager = new UserManager();
        $userManager->logOutUser();
    }

    function loadTaskManager($userID) {
        $taskManager = new TaskManager();
        $request = $taskManager->getUserTasks($userID);
        require('view/taskManagerView.php');
    }

    function postNewTask($label, $userID) {
        $taskManager = new TaskManager();
        $result = $taskManager->addTask($label, $userID);
        if($result === false) {
            throw new Execption("Impossible d'ajouter de nouvelles tâches");
        } else {
            header('Location: /todolist');
            exit();
        }
    }

    function deleteTask($taskID) {
        $taskManager = new TaskManager();
        $result = $taskManager->removeTask($taskID);
        if($result === false) {
            throw new Exception("Impossible de supprimer la tâche");
        } else {
            header('Location: /todolist');
            exit();
        }
    }

    function updateTask($taskID, $label) {
        $taskManager = new TaskManager();
        $result = $taskManager->editTask($taskID, $label);
        if($result === false) {
            throw new Exception("Impossible de modifier la tâche");
        } else {
            header('Location: /todolist');
            exit();
        }
    }

    function getLastTaskId() {
        $taskManager = new TaskManager();
        $taskManager->getLastId();
    }