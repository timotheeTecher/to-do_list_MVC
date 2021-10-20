<?php

    class Manager {

        protected function connectToDb() {
            try {
                $dataBase = new PDO('mysql:host=localhost;dbname=mvc_todolist;charset=utf8', 'root', '');
                $dataBase->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            catch(Exception $e) {
                throw new Exception('Erreur : '.$e->getMessage());
            }
            
            return $dataBase;
        }
    }