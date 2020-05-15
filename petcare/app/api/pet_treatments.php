<?php
$app->get('/api/pet_treatments',function(){
    getAllPet_treatments();
});
// find data
//http://localhost/petcare/public/api/pet_treatments/id
$app->get('/api/pet_treatments/{id}',function($request){
    $id=$request->getAttribute('id');
    findPet_treatments($id);
});

// remove data
//http://localhost/petcare/public/api/pet_treatments/id
$app->delete('/api/pet_treatments/{id}',function($request){
    $id=$request->getAttribute('id');
    deletePet_treatments($id);
});
//  update data
//http://localhost/petcare/public/api/pet_treatments/id
$app->post('/api/pet_treatments/{id}',function($request) {
  $id=$request->getAttribute('id');
  updatePet_treatments($id);
});

//  insert data
//http://localhost/petcare/public/api/pet_treatments
$app->post('/api/pet_treatments',function($request) {
           insertPet_treatments();
});

$app->get('/api/pet_treatmentsmax',function($request){
    findMaxpet_treatments();
});


function getAllPet_treatments(){
  require_once('dbconnect.php');
  $query = "select * from pet_treatments";
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

function insertPet_treatments(){
  require_once('dbconnect.php');
  $input = json_decode(file_get_contents('php://input'), true);

  if (!isset($input[0]["treatmentID"])) {
      echo "treatmentID Not defined";
      return;
  }if (empty($input[0]["treatmentID"])) {
      echo "treatmentID is Empty";
      return;
  }
  if (!isset($input[0]["petID"])) {
      echo "petID Not defined";
      return;
  }if (empty($input[0]["petID"])) {
      echo "petID is Empty";
      return;
  }
  if (!isset($input[0]["treatment_type"])) {
      echo "treatment_type Not defined";
      return;
  }if (empty($input[0]["treatment_type"])) {
      echo "treatment_type is Empty";
      return;
  }
  $treatmentID = $input[0]["treatmentID"];
  $petID = $input[0]["petID"];
  $treatment_type = $input[0]["treatment_type"];

  $query1 = "select * from pet where cid='$petID'";
  $result1 = $mysqli->query($query1);
  while($row1 = $result1->fetch_assoc()){
    $data1[] = $row1;
  }
  if(!isset($data1)){
    echo "Invalid Pet";
    return;
  }

  $sql = "insert into pet_treatments values(0,'".$treatmentID."','".$petID."','".$treatment_type."')";
  mysqli_query($mysqli,$sql);
  if (mysqli_affected_rows($mysqli)>0) {
    echo "true";
  }else{
    echo "false";
  }
}

function findPet_treatments($id){
  require_once('dbconnect.php');
  $query = "select * from pet_treatments where cid='$id'";
  $result = $mysqli->query($query);
  while($row = $result->fetch_assoc()){
      $data[] = $row;
  }
  if(isset($data)){
      header('Content-Type: application/json');
      echo json_encode($data);
  }else{
    echo "pet_treatments Not Found";
  }
}

function updatePet_treatments($id){
  require_once('dbconnect.php');
  $input = json_decode(file_get_contents('php://input'), true);

  if (!isset($input[0]["treatmentID"])) {
      echo "treatmentID Not defined";
      return;
  }if (empty($input[0]["treatmentID"])) {
      echo "treatmentID is Empty";
      return;
  }
  if (!isset($input[0]["petID"])) {
      echo "petID Not defined";
      return;
  }if (empty($input[0]["petID"])) {
      echo "petID is Empty";
      return;
  }
  if (!isset($input[0]["treatment_type"])) {
      echo "treatment_type Not defined";
      return;
  }if (empty($input[0]["treatment_type"])) {
      echo "treatment_type is Empty";
      return;
  }

  $treatmentID = $input[0]["treatmentID"];
  $petID = $input[0]["petID"];
  $treatment_type = $input[0]["treatment_type"];

  $sql = "update pet_treatments set treatmentID='$treatmentID', petID='$petID', treatment_type='$treatment_type' where cid='$id'";
  mysqli_query($mysqli,$sql);
  if (mysqli_affected_rows($mysqli)>0) {
    echo "true";
  }else{
    echo "false";
  }
}

function deletePet_treatments($id){
  require_once('dbconnect.php');
  $query = "delete from pet_treatments where cid='$id'";
  $result = $mysqli->query($query);
  if (mysqli_affected_rows($mysqli)>0){
    echo "true";
  }else{
    echo "false";
  }
}

function findMaxpet_treatments(){
  require_once('dbconnect.php');
    $xyz= "select max(cid) as maxx from pet_treatments";
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
