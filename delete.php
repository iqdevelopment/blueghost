<?php
include 'lib.php';
echo page_header();


if (!empty($_GET['id'])) {
   $user = get_user_by_id($_GET['id']);

$output = "
<form method='post' action='process.php'>
opravdu chcete smazat uživatele: ".$user->firstname." ".$user->lastname." ?<br><br>
<input name='delete' style='display:none' value='1'></input>
<input name='id' style='display:none' value=".$user->id."></input>
<input type='submit' value='SMAZAT'></input>
<a href='index.php'><button>ZPĚT</button></a>
</form>



";

echo $output;

}

echo page_footer();







?>