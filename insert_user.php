<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
$link = mysqli_connect('localhost', 'mybox', 'P@ssw0rd', 'project-mybox');
mysqli_set_charset($link, 'utf8');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $content = file_get_contents('php://input');

    $user = json_decode($content, true);
    $name = $user['name'];
    $lastname = $user['lastname'];
    $email = $user['email'];
    $password = $user['password'];
    $tel = $user['tel'];

    $sql2 = "SELECT email FROM user WHERE email='$email' ";
    $result2 = mysqli_query($link, $sql2);
    $rowcount = mysqli_num_rows($result2);
    if ($rowcount == 1) {
        echo json_encode(['status' => 'error', 'message' => 'Unable to register This email already has users.']);
        exit;
    }

    $sql = "INSERT INTO `users` (`email`, `name`, `lastname`, `tel`, `password`) VALUES ('$email', '$name', '$lastname', '$tel', '$password');";
    $result = mysqli_query($link, $sql);
    if ($result) {
        echo json_encode(['status' => 'ok', 'message' => 'Sign up Success']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error Cannot Insert Data']);
    }
}
mysqli_close($link);
