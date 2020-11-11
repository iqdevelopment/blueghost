<?php
include 'lib.php';
echo page_header();
$vars = $_POST;

if(!empty($_POST['delete'])){

    delete_user($_POST['id']);
}else{

        $user = (object)[
            'id' => $_POST['id'],
            'firstname' => $_POST['firstname'],
            'lastname' => $_POST['lastname'],
            'email' => $_POST['email'],
            'telephone' => $_POST['telephone'],
            'description' => $_POST['description']
        ];
        


        if($user->id == 'new'){

            create_user($user);
        }else{


        update_user($user);
        }

    }


    echo page_footer();
?>