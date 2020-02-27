<?php
    include_once('config.php');

    function getUserFullName($username) {
        $connection = getConnection();
        $result = select($connection,"select firstname, lastname from users where username = '$username' and active=1");
        $row = mysqli_fetch_array($result);
        closeConnection($connection);
        $firstname = $row['firstname'];
        $lastname = $row['lastname'];
        return $firstname.' '.$lastname;
    }

    function signup($username, $password, $firstname, $lastname, $phone, $email) {
        $connection = getConnection();
        $result = select($connection,"INSERT INTO users (username, password, firstname, lastname, phone, email, isadmin, active) VALUES ('$username', '$password', '$firstname', '$lastname', '$phone', '$email', 0, 1)");
        closeConnection($connection);
        return $result;
    }

    // function getUserid($userid){
    //     $connection = getConnection();
    //     $result = select($connection,"select userid from users where userid = '$userid' and active=1");
    //     $row = mysqli_fetch_array($result);
    //     closeConnection($connection);
    //     $userid = $row['userid'];
    //     return $userid;

    // }
    function getUsers(){
        $connection = getConnection();
        $sql = "SELECT * FROM users";
        $result = select($connection, $sql);
        closeConnection($connection);
        $users = array();
        while($item = mysqli_fetch_array($result)) {
            $users[] = $item;
        }
        return $users;
    }

    function getUserbyId($userid){
        $connection = getConnection();
        $sql = "SELECT userid, username, password, firstname, lastname, email, phone,
         active, isadmin FROM users WHERE userid=$userid";
        $result = select($connection, $sql);
        $user = mysqli_fetch_array($result);
        closeConnection($connection);
        return $user;   
    }

    function updateUser($userid, $username, $password, $firstname, $lastname, $email, $phone) {
        $connection = getConnection();
        $sql = "UPDATE users SET username = '$username', password = '$password', firstname = '$firstname', lastname ='$lastname', email = '$email',
         phone = '$phone' WHERE userid='$userid'";
        $result = select($connection, $sql);
        closeConnection($connection);
        return $result;

    }

    function deleteUser($userid){
        $connection = getConnection();
        $sql = "DELETE FROM users WHERE userid=$userid";
        $result = select($connection, $sql);
        closeConnection($connection);
        return $result;
    }

    function addUser($username, $password, $firstname, $lastname, $email, $phone) {
        $connection = getConnection();
        $sql = "INSERT INTO users (username, password, firstname, lastname, email, phone, active, isadmin) VALUES ('$username', '$password', '$firstname', '$lastname', '$email', '$phone', 1, 0)";
        $result = select($connection, $sql);
        closeConnection($connection);
        return $result;
    }
    

?>

