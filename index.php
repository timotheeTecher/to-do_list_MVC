<?php
    session_start();

    require('controller/controller.php');

    try {
        if(isset($_GET['page'])) {
            switch ($_GET['page']) {
                case 'inscription':
                    if(!empty($_POST['first_name']) && !empty($_POST['last_name']) && !empty($_POST['email']) && !empty($_POST['password'])) {
                        signUp(htmlspecialchars($_POST['first_name']), htmlspecialchars($_POST['last_name']), htmlspecialchars($_POST['email']), htmlspecialchars($_POST['password']));
                    } else {
                        loadSignUp();
                    }
                    break;
                case 'connexion':
                    if(!empty($_POST['email']) && !empty($_POST['password'])) {
                        signIn(htmlspecialchars($_POST['email']), htmlspecialchars($_POST['password']));
                    } else {
                        loadSignIn();
                    }
                    break;
                case 'deconnexion':
                    logOut();
                    break;
                case 'todolist':
                    if(!empty($_POST['task'])) {
                        postNewTask($_POST['task'], $_SESSION['id']);
                    } else {
                        loadTaskManager($_SESSION['id']);
                    }
                    break;
                case 'supprimer-tache':
                    deleteTask($_POST['taskID']);
                    break;
                case 'modifier-tache':
                    updateTask($_POST['taskID'], $_POST['label']);
                    break;
                case 'dernier-id':
                    getLastTaskId();
                    break;
                default:
                    throw new Exception("Cette page n'existe pas ou a été suprimée !");
            }
        } else {
            loadSignUp();
        }
    } catch(Exception $e) {
        die("Error : ".$e->getMessage());
    }