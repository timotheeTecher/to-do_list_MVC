<?php
    require_once('Manager.php');

    class TaskManager extends Manager {
        
        public function getUserTasks($userID) {
            $dataBase = $this->connectToDb();
            $request  = $dataBase->prepare('SELECT * FROM task WHERE userID = :userID');
            $request->execute(array(
                'userID' => $userID
            ));

            return $request;
        }

        public function getLastId() {
            $dataBase = $this->connectToDb();
            $request  = $dataBase->prepare('SELECT MAX(id) as last_id FROM task');
            $request->execute();
            $result     = $request->fetch();
            $jsonResult = json_encode($result);

            echo $jsonResult;
        }
        
        public function addTask($label, $userID) {
            $dataBase = $this->connectToDb();
            $request  = $dataBase->prepare('INSERT INTO task(label, userID) VALUES(:label, :userID)');
            $result   = $request->execute(array(
                "label" => $label,
                "userID" => $userID
            ));
            
            return $result;
        }

        public function removeTask($taskID) {
            $dataBase = $this->connectToDb();
            $request  = $dataBase->prepare('DELETE FROM task WHERE id = :taskID');
            $result   = $request->execute(array(
                "taskID" => $taskID
            ));

            return $result;
        }
        
        public function editTask($taskID, $label) {
            $dataBase = $this->connectToDb();
            $request  = $dataBase->prepare('UPDATE task SET label = :label WHERE id = :taskID');
            $result   = $request->execute(array(
                "label" => $label,
                "taskID" => $taskID
            ));

            return $result;
        }  
    }