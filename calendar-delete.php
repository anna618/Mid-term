<?php

//delete.php

if(isset($_POST["id"]))
{
 $connect = new PDO('mysql:host=localhost;dbname=independent_study_04', 'root', '');
// $connect = new PDO('mysql:host=localhost;dbname=independent_study_04', 'admin', 'mysql0818');
 $query = "
 DELETE from db_petsitter_worktime WHERE id=:id
 ";
 $statement = $connect->prepare($query);
 $statement->execute(
  array(
   ':id' => $_POST['id']
  )
 );
}

?>
