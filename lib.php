<?php

/******
 * 
 * header pro všechny stránky
 * 
 */

function page_header(){ 
$output = "
<!DOCTYPE html>
<html>
<head>
<title>Programátorský úkol</title>
</head>
<body>
";
return $output;

}


/******
 * 
 * footer pro všechny stránky
 * 
 */

function page_footer(){ 
    $output = "
    </body>
    </html>
    ";
    return $output;
    
    }

    /********
     * 
     * 
     * mysql connect info
     * 
     *********/
    function server_connect(){

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "blueghost";

   
        $conn = mysqli_connect($servername, $username, $password,$dbname);
        if($conn === false){
            die("ERROR: Could not connect. " . mysqli_connect_error());
        }else{
        return $conn;
    }
      

    }


    /********
     * 
     * 
     * dostane vsechny uzivatele v tabulce
     * jako parametry se mohou použít jméno a příjmení
     * 
     ******/


     function get_users($firstname = null,$lastname = null){


        $conn = server_connect();
        if ($firstname != NULL AND $lastname != NULL){
            $sql = "SELECT id, firstname, lastname, email,telephone, description 
                FROM users 
                WHERE firstname = '".$firstname ."' AND lastname = '".$lastname ."' ";   
        }else{
        $sql = "SELECT id, firstname, lastname, email,telephone, description FROM users";
        }
        $obj_arr = array();
        $result = $conn->query($sql);
        if (empty($result)){
            return 'žádné výsledky';
        }else {
                // 
                while($row = $result->fetch_assoc()) {
                    $obj_arr[] = $row; 
                }
            return $obj_arr ;    
                }
    
    
        $conn->close();
            }

/**********
 * 
 * 
 * update uživatele
 * 
 ********/
            
     function update_user($user = null){


        $conn = server_connect();
       
            $sql = "
            UPDATE users
            SET
                firstname = '".$user->firstname."',
                lastname = '".$user->lastname."',
                email = '".$user->email."',
                telephone = '".$user->telephone."',
                description = '".$user->description."'

            WHERE id = ".$user->id." ";   
        
        
            if ($conn->query($sql) === TRUE) {
                echo "Uživatel".$user->firstname." ".$user->lastname." byl úspěšně editován<br>";
                echo "<a href='index.php'><button>Zpět</button></a>";
              } else {
                echo "Error updating record: " . $conn->error;
              }
        
    
    
        $conn->close();
            }


/**********
 * 
 * 
 * smazání uživatele
 * 
 */
function delete_user($user = null){


    $conn = server_connect();
   
        $sql = "
        DELETE FROM users
        WHERE id = ".$user->id." ";   
    
    
        if ($conn->query($sql) === TRUE) {
            echo "Uživatel".$user->firstname." ".$user->lastname." byl úspěšně smazán<br>";
            echo "<a href='index.php'><button>Zpět</button></a>";
          } else {
            echo "Error updating record: " . $conn->error;
          }
    


    $conn->close();
        }




/*******
 * 
 * zpracování do přehledové tabulky
 * 
 * 
 **********/

function show_users_table(){
        $users = get_users();

        if($users == 'žádné výsledky'){
            $output = 'žádné výsledky';

        }else{

            $output = '
            <h2>Tabulka s kontakty</h2>
            <table>
            <tr>
                <th>ID</th>
                <th>Jméno</th>
                <th>Příjmení</th>
                <th>Email</th>
                <th>Telefon</th>
                <th>Popis</th>
                <th>Editace</th>
                <th>Smazat</th>
            </tr>
            ';
            foreach ($users as $user){
                $output .= "
                <tr>
                    <td>".$user['id']."</td>
                    <td>".$user['firstname']."</td>
                    <td>".$user['lastname']."</td>
                    <td>".$user['email']."</td>
                    <td>".$user['telephone']."</td>
                    <td>".$user['description']."</td>
                    <td><a href= 'identifikator-kontaktu.php?user=".$user['firstname']."-".$user['lastname']."'><button>EDITACE</button></a></td>
                    <td><a href= 'delete.php?id=".$user['id']."'><button>SMAZAT</button></a></td>
                </tr>";
                //echo $user['id']." - ".$user['firstname']." - ".$user['lastname']." - ".$user['telephone']." - ".$user['email']." - ".$user['description']."<br>";
            }
            $output .= "</table>";
        }

        return $output;
    }

/***********
 * 
 * kontrola zda existuje v DB
 * 
 */

function user_exists($firstname,$lastname){

$conn = server_connect();
       
$sql = "
SELECT * FROM users
WHERE firstname = '".$firstname."'
    AND lastname = '".$lastname."' ";  

$result = $conn->query($sql);
    $res = $result->fetch_assoc();
   // print_r($res); 
        
    $conn->close();
    if(!empty($res)){

        return true;
    }else{
        return false; 
    }
    
  }





 


?>