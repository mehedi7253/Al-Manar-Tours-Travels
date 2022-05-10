<?php

function userExists($email) //check user email exist ot not
{
    global $connect;

    $sql = "SELECT * FROM users WHERE email = '$email'";
    $query = $connect->query($sql);
    $count = mysqli_num_rows($query);
    if ($count > 0) {
        return true;
    } else {
        return false;
    }

    $connect->close();
}

// user register
function registerUser() {

    global $connect;

    $fileinfo = PATHINFO($_FILES['image']['name']);
    $newfilename  = $fileinfo['filename']. "." .$fileinfo['extension'];
    move_uploaded_file($_FILES['image']['tmp_name'],"../images/" .$newfilename);
    $location = $newfilename;

    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $gender = $_POST['gender'];
    $city       = $_POST['city'];
    $ps         = $_POST['ps'];
    $postal     = $_POST['postal'];
    $birth      = $_POST['date_of_birth'];
    $password = $_POST['password'];
    $image    = $_FILES['image']['name'];

    $newPassword = makePassword($password);
    if($newPassword) {
        $created = @date('Y-m-d H:i:s');
        $sql = "INSERT INTO users (first_name, last_name, email, phone, gender, password, image, status, city, ps, postal, date_of_birth) VALUES ('$first_name', '$last_name', '$email', '$phone', '$gender', '$newPassword', '$image', '0', '$city', '$ps', '$postal', '$birth')";
        $query = $connect->query($sql);
        if($query === TRUE) {
            return true;
        } else {
            return false;
        }
    } // /if

    $connect->close();

}

//encrypt password sing hash
function makePassword($password) {
    return hash('sha256', $password);
}

//get user data
function userdata($email) {

    global $connect;

    $sql = "SELECT * FROM users WHERE email = '$email'";
    $query = $connect->query($sql);
    $result = $query->fetch_assoc();
    if($query->num_rows == 1) {
        return $result;
    } else {
        return false;
    }

    $connect->close();

}

//user login
function login($email, $password) {

    global $connect;
    $userdata = userdata($email);
    if($userdata) {
        $makePassword = makePassword($password);
        $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$makePassword' AND status = '0'"; //if username and passwod is match user can loged in otherwise not
        $query = $connect->query($sql);


        if($query->num_rows == 1) {
            return true;
        } else {
            return false;
        }
    }

    $connect->close();
}

//get user id by their id
function getUserDataByUserId($id) {
    global $connect;

    $sql = "SELECT * FROM users WHERE id = $id";
    $query = $connect->query($sql);
    $result = $query->fetch_assoc();
    return $result;

    $connect->close();
}

//check email existing
function users_exists_by_id($id, $email) {
    global $connect;

    $sql = "SELECT * FROM users WHERE email = '$email' AND id != $id";
    $query = $connect->query($sql);
    if($query->num_rows >= 1) {
        return true;
    } else {
        return false;
    }

    $connect->close();
}

//check authentication.
function logged_in() {
    if(isset($_SESSION['id'])) {
        return true;
    } else {
        return false;
    }
}

//un authentic user can not login
function not_logged_in() {
    if(isset($_SESSION['id']) === FALSE) {
        return true;
    } else {
        return false;
    }
}

//logout
function logout() {
    if(logged_in() === TRUE){
        session_unset();

        session_destroy();

        header('location: login.php');
    }
}

//change password
function passwordMatch($id, $password) {
    global $connect;

    $userdata = getUserDataByUserId($id);
    $makePassword = makePassword($password);

    if($makePassword == $userdata['password']) {
        return true;
    } else {
        return false;
    }

    $connect->close();
}


