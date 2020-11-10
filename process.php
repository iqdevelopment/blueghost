<?php
include 'lib.php';
$vars = $_POST;
$user = (object)[
    'id' => $_POST['id'],
    'firstname' => $_POST['firstname'],
    'lastname' => $_POST['lastname'],
    'email' => $_POST['email'],
    'telephone' => $_POST['telephone'],
    'description' => $_POST['description'],
];


update_user($user);





?>