<?php
include 'lib.php';


echo page_header();

//kontrola jestli je parametr použit
if (!empty($_GET['user'])) {
        $wholename = $_GET['user'];
        //kontrola, jestli do URL někdo nehodil nepovolené znaky
        $check = strip_tags($wholename);
        $check = preg_replace('/<[^>]*>/', '', $check);
        $pieces = explode('-',$wholename);
        $check_size = sizeof($pieces);
        $firstname = $pieces[0];
        $lastname = $pieces[1];
             // nový uživatel   
            if($firstname == 'new' AND $lastname == 'new'){
                
                echo render_form();

            }
            
            // kontrola jestli nemá array moc částí, nejsou zde nepovolené znaky a jestli záznam existuje
            elseif ($wholename != $check OR $check_size != 2 OR user_exists($firstname,$lastname) == false){
                echo "Špatné vstupní parametry!";
            
            }else {
            
                $user = get_users($firstname,$lastname);
                $user = $user[0];
                
//$user = $user[0];
              
                // všecho ok, můžu pokračovat
                echo render_form($user);


            }
  





  }else{

    echo "Špatné vstupní parametry!<br>";
    echo "<a href='index.php'><button>Zpět</button></a>";
  }




echo page_footer();








?>