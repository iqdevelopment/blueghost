<?php
include 'lib.php';
include 'process.php';

echo page_header();


//kontrola jestli je parametr použit
if (!empty($_GET['user'])) {
        $wholename = $_GET['user'];
        //kontrola, jestli do URL někdo nehodil nepovolené znaky
        $check = strip_tags($wholename);
        $check = preg_replace('/<[^>]*>/', '', $check);

            if ($wholename  != $check){
                echo "Špatné vstupní parametry!";
            }else {
                $pieces = explode('-',$wholename);
                $firstname = $pieces[0];
                $lastname = $pieces[1];

                $user = get_users($firstname,$lastname);
                
                $user = $user[0];
              
                // všecho ok, můžu pokračovat
                $output = "
                <h2>Zde upravte údaje</h2>
                <table>
                <tr>
                    <th>Jméno</th>
                    <th>Příjmení</th>
                    <th>Email</th>
                    <th>Telefon</th>
                    <th>Popis</th>
                </tr>
                
                    <tr><form action='process.php' method='post'>
                        <td style='display:none'><input type = 'text' name ='id' value =' ".$user['id']."' style='display:none'></input></td>
                        <td><input type = 'text' name ='firstname' value =' ".$user['firstname']."'></input></td>
                        <td><input type = 'text' name ='lastname' value =' ".$user['lastname']."'></input></td>
                        <td><input type = 'text' name ='email' value =' ".$user['email']."'></input></td>
                        <td><input type = 'text' name ='telephone' value =' ".$user['telephone']."'></input></td>
                        <td><textarea type = 'textfield' name ='description' value =' ".$user['description']."'></textarea></td>

                       
                    </tr>
                    </table>
                    <input type='submit'>
                    </form>";
                    echo $output;



            }
  





  }else{

    echo "Špatné vstupní parametry!";
  }




echo page_footer();








?>