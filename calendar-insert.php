<?php

//insert.php
$connect = new PDO('mysql:host=localhost;dbname=independent_study_04', 'root', '');
//$connect = new PDO('mysql:host=localhost;dbname=independent_study_04', 'admin', 'mysql0818');

if(isset($_POST["title"]));
{
    
 $query = "
 INSERT INTO db_petsitter_worktime
 (title,price, start_event, end_event) 
 VALUES (:title,:price, :start_event, :end_event)
 ";
 $statement = $connect->prepare($query);
 $statement->execute(
  array(
   ':title'  => $_POST['title'],
   ':price'  => $_POST['price'],
   ':start_event' => $_POST['start'],
   ':end_event' => $_POST['end']
  )
 );
}
?>