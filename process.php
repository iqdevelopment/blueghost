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
            $check = check_inputs($user);
            if(!empty($check)){
                echo $check;
            }else{

            create_user($user);}
        }else{

            $check = check_inputs($user);
            if(!empty($check)){
                echo $check;
            }else{

                update_user($user);}
      
        }

    }


    echo page_footer();
?>