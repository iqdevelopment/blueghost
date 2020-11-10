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
                // kontrola jestli nemá array moc částí, nejsou zde nepovolené znaky a jestli záznam existuje
            if ($wholename != $check OR $check_size != 2 OR user_exists($firstname,$lastname) == false){
                echo "Špatné vstupní parametry!";
            }else {
              

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
                        <td><textarea type = 'textfield' name ='description'>".$user['description']."</textarea></td>

                       
                    </tr>
                    </table>
                    <input type='submit'>
                    </form>";
                    echo $output;



            }
  





  }else{

    echo "Špatné vstupní parametry!<br>";
    echo "<a href='index.php'><button>Zpět</button></a>";
  }




echo page_footer();








?>