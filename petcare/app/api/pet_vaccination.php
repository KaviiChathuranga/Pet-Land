<?php
$app->get('/api/pet_vaccination',function(){
    getAllPet_vaccination();
});
// find data
//http://localhost/petcare/public/api/pet_vaccination/id
$app->get('/api/pet_vaccination/{id}',function($request){
    $id=$request->getAttribute('id');
    findPet_vaccination($id);
});

// remove data
//http://localhost/petcare/public/api/pet_vaccination/id
$app->delete('/api/pet_vaccination/{id}',function($request){
    $id=$request->getAttribute('id');
    deletePet_vaccination($id);
});
//  update data
//http://localhost/petcare/public/api/pet_vaccination/id
$app->post('/api/pet_vaccination/{id}',function($request) {
  $id=$request->getAttribute('id');
  updatePet_vaccination($id);
});

//  insert data
//http://localhost/petcare/public/api/pet_vaccination
$app->post('/api/pet_vaccination',function($request) {
           insertPet_vaccination();
});
$app->get('/api/pet_vaccinationmax',function($request){
    findMaxpet_vaccination();
});


function getAllPet_vaccination(){
  require_once('dbconnect.php');
  $query = "select * from pet_vaccination";
  $result = $mysqli->query($query);
  while($row = $result->fetch_assoc()){
    $data[] = $row;
  }
  if(isset($data)){
    header('Content-Type: application/json');
    echo json_encode($data);
  }else{
    echo "Empty List";
  }
}

function insertPet_vaccination(){
  require_once('dbconnect.php');
  $input = json_decode(file_get_contents('php://input'), true);

  if (!isset($input[0]["vaccinationID"])) {
      echo "vaccinationID Not defined";
      return;
  }if (empty($input[0]["vaccinationID"])) {
      echo "vaccinationID is Empty";
      return;
  }
  if (!isset($input[0]["date"])) {
      echo "date Not defined";
      return;
  }if (empty($input[0]["date"])) {
      echo "date is Empty";
      return;
  }
  if (!isset($input[0]["age"])) {
      echo "age Not defined";
      return;
  }if (empty($input[0]["age"])) {
      echo "age is Empty";
      return;
  }
  if (!isset($input[0]["doctor"])) {
      echo "doctor Not defined";
      return;
  }if (empty($input[0]["doctor"])) {
      echo "doctor is Empty";
      return;
  }
  if (!isset($input[0]["care_center"])) {
      echo "care_center Not defined";
      return;
  }if (empty($input[0]["care_center"])) {
      echo "care_center is Empty";
      return;
  }
  if (!isset($input[0]["remark"])) {
      echo "remark Not defined";
      return;
  }if (empty($input[0]["remark"])) {
      echo "remark is Empty";
      return;
  }

  $vaccinationID = $input[0]["vaccinationID"];
  $date = $input[0]["date"];
  $age = $input[0]["age"];
  $doctor = $input[0]["doctor"];
  $care_center = $input[0]["care_center"];
  $remark = $input[0]["remark"];

  $query1 = "select * from care_center where cid='$care_center'";
  $result1 = $mysqli->query($query1);
  while($row1 = $result1->fetch_assoc()){
    $data1[] = $row1;
  }
  if(!isset($data1)){
    echo "Invalid care_center";
    return;
  }

  $query2 = "select * from doctor where cid='$doctor'";
  $result2 = $mysqli->query($query2);
  while($row2 = $result2->fetch_assoc()){
    $data2[] = $row2;
  }
  if(!isset($data2)){
    echo "Invalid Doctor";
    return;
  }

  $sql = "insert into pet_vaccination values(0,'".$vaccinationID."','".$date."','".$age."','".$doctor."','".$care_center."','".$remark."')";
  mysqli_query($mysqli,$sql);
  if (mysqli_affected_rows($mysqli)>0) {
    echo "true";
  }else{
    echo "false";
  }
}

function findPet_vaccination($id){
  require_once('dbconnect.php');
  $query = "select * from pet_vaccination where cid='$id'";
  $result = $mysqli->query($query);
  while($row = $result->fetch_assoc()){
      $data[] = $row;
  }
  if(isset($data)){
      header('Content-Type: application/json');
      echo json_encode($data);
  }else{
    echo "pet_vaccination Not Found";
  }
}

function updatePet_vaccination($id){
  require_once('dbconnect.php');
  $input = json_decode(file_get_contents('php://input'), true);

  if (!isset($input[0]["vaccinationID"])) {
      echo "vaccinationID Not defined";
      return;
  }if (empty($input[0]["vaccinationID"])) {
      echo "vaccinationID is Empty";
      return;
  }
  if (!isset($input[0]["date"])) {
      echo "date Not defined";
      return;
  }if (empty($input[0]["date"])) {
      echo "date is Empty";
      return;
  }
  if (!isset($input[0]["age"])) {
      echo "age Not defined";
      return;
  }if (empty($input[0]["age"])) {
      echo "age is Empty";
      return;
  }
  if (!isset($input[0]["doctor"])) {
      echo "doctor Not defined";
      return;
  }if (empty($input[0]["doctor"])) {
      echo "doctor is Empty";
      return;
  }
  if (!isset($input[0]["care_center"])) {
      echo "care_center Not defined";
      return;
  }if (empty($input[0]["care_center"])) {
      echo "care_center is Empty";
      return;
  }
  if (!isset($input[0]["remark"])) {
      echo "remark Not defined";
      return;
  }if (empty($input[0]["remark"])) {
      echo "remark is Empty";
      return;
  }

  $vaccinationID = $input[0]["vaccinationID"];
  $date = $input[0]["date"];
  $age = $input[0]["age"];
  $doctor = $input[0]["doctor"];
  $care_center = $input[0]["care_center"];
  $remark = $input[0]["remark"];

  $sql = "update pet_vaccination set vaccinationID='$vaccinationID', date='$date', age='$age', doctor='$doctor', care_center='$care_center', remark='$remark' where cid='$id'";
  mysqli_query($mysqli,$sql);
  if (mysqli_affected_rows($mysqli)>0) {
    echo "true";
  }else{
    echo "false";
  }
}

function deletePet_vaccination($id){
  require_once('dbconnect.php');
  $query = "delete from pet_vaccination where cid='$id'";
  $result = $mysqli->query($query);
  if (mysqli_affected_rows($mysqli)>0){
    echo "true";
  }else{
    echo "false";
  }
}

function findMaxpet_vaccination(){
  require_once('dbconnect.php');
    $xyz= "select max(cid) as maxx from pet_vaccination";
    $xxx=$mysqli->query($xyz);
    while($row1 = $xxx->fetch_assoc()){
      $data1[] = $row1;
    }
    $max= json_encode($data1[0]['maxx'],JSON_NUMERIC_CHECK );
    if ($max==0) {
      echo "0";
      return;
    }
    echo $max;
}
