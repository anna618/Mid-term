<?php

//load.php
$connect = new PDO('mysql:host=localhost;dbname=independent_study_04', 'root', '');
//$connect = new PDO('mysql:host=localhost;dbname=independent_study_04', 'admin', 'mysql0818');

$data = array();

$query = "SELECT * FROM db_petsitter_worktime ORDER BY id";

$statement = $connect->prepare($query);

$statement->execute();

$result = $statement->fetchAll();

foreach($result as $row)
{
 $data[] = array(
  'id'   => $row["id"],
  'title'   => $row["title"],
  'price'   => $row["price"],
  'start'   => $row["start_event"],
  'end'   => $row["end_event"]
 );
}

echo json_encode($data);

?>