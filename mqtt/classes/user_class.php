<?php

class User {
    public $username;

    function __construct($username) {
        $this->username = $username;
    }

    function exists() {
        $mysqli = acquireSqlCon();
        $stmt = $mysqli->prepare("SELECT id FROM user WHERE username = ?");
        $stmt->bind_param("s", $this->username);
        $stmt->execute();
        $stmt->store_result();
        if($stmt->num_rows > 0) {
            return true;
        }
        return false;
    }

    function getId() {
        if(!$this->exists()) return false;

        return $this->param("id");
    }

    function isAdmin() {
        if(!$this->exists()) return false;

        if($this->param("admin") > 0) {
            return true;
        } else {
        return false;
    }
    }

    function create($password) {
        if($this->exists()) return false;

        $pw_hash = password_hash($password, PASSWORD_DEFAULT);

        $mysqli = acquireSqlCon();
        $stmt = $mysqli->prepare("INSERT INTO user (username,password,admin) VALUES(?,?,0)");
        $stmt->bind_param("ss", $this->username, $pw_hash);
        if(!$stmt) return false;
        if(!$stmt->execute()) return false;
        $_SESSION["loggedin"] = true;
        $_SESSION["username"] = $this->username;
        return true;
    }

    function param($parameter) {
        if(!$this->exists()) return false;
        $username = $this->username;

        $mysqli = acquireSqlcon();

        $stmt = $mysqli->prepare("SELECT ".$parameter." FROM user WHERE username = ?");
        $stmt->bind_param("s", $username);
        if(!$stmt) return "NFP(04)";
        $executed = $stmt->execute();
        if($executed) {
            while($results = $stmt->get_result()->fetch_assoc()) {
                return $results[$parameter];
            }
        }
        return "NFP(40)";
    }

    function auth($password) {
        $hash = $this->param("password");
        if(password_verify($password, $hash)) {
            return true;
        }
        return false;
    }
}

?>