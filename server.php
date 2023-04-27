<?php
    function login($username, $password, $my_conn){

        $query = $my_conn->conn->prepare("SELECT `id`, `username` FROM `users` WHERE `username` = ? and `password` = ?");
        $query->bind_param('ss', $username, $password);

        $query->execute();

        $result = $query->get_result();

        $rows = $result->num_rows;

        if($rows > 0){
            $row = $result->fetch_assoc();
            $_SESSION['userId'] = $row['id'];
            $_SESSION['username'] = $row['username'];
        } else {
            $_SESSION['userId'] = 0;
            $_SESSION['username'] = '';
        }
    }
?>