<?php
class Database {
    public function connectDb(){
        //połączenie z bazą
        try {
            $db = new PDO("mysql:host=localhost", 'root', 'haslo1');
            return $db;
        }
        catch (PDOException $e) {
            die("błąd bazy: " . $e->getMessage());
        }
    }
    public function createDb($db) {
        //stworz baze jesli nie istnieje
        $db->exec("CREATE DATABASE IF NOT EXISTS `zadanie`;");
    }
    public function createTables($db) {
        //stworz tabele jesli nie istnieje..
        $db->exec("CREATE TABLE IF NOT EXISTS zadanie.emails (id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            email VARCHAR(50),
            amount INT);");
    }

    public function insertEmails($domains, $db){
        //przygotuj zapytanie z dwoma placeholderami - na email i ilość wystąpień
        $req = $db->prepare("INSERT INTO zadanie.emails (email, amount) VALUES (?, ?)");
        //rozpocznij transakcje - dane nie zostana wrzucone do bazy do czasu ukonczenia petli
        $db->beginTransaction();
        foreach ($domains as $key => $value){
            $req->execute([$key, $value]);
        }
        //wrzuc dane do bazy
        $db->commit();
    }
    public function __construct($domains){
        //przy stworzeniu instancji klasy wykonaj wszystkie operacje
        $conn = $this->connectDb();
        $this->createDb($conn);
        $this->createTables($conn);
        $this->insertEmails($domains, $conn);
    }
}