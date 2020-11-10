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



/****************
 * 
 * 
 * očištění jména od nechtěných tagů
 * 
 * 
 ************/

function fixtags($text){
    $text = htmlspecialchars($text);
    $text = preg_replace("/=/", "=\"\"", $text);
    $text = preg_replace("/&quot;/", "&quot;\"", $text);
    $tags = "/&lt;(\/|)(\w*)(\ |)(\w*)([\\\=]*)(?|(\")\"&quot;\"|)(?|(.*)?&quot;(\")|)([\ ]?)(\/|)&gt;/i";
    $replacement = "<$1$2$3$4$5$6$7$8$9$10>";
    $text = preg_replace($tags, $replacement, $text);
    $text = preg_replace("/=\"\"/", "=", $text);
    return $text;
    }



?>