<?php
$app->get('/api/user_pet',function(){
    getAlluser_petPet();
});
// find data
//http://localhost/petcare/public/api/user_pet/id
$app->get('/api/user_pet/{id}',function($request){
    $id=$request->getAttribute('id');
    finduser_petPet($id);
});

// remove data
//http://localhost/petcare/public/api/user_pet/id
$app->delete('/api/user_pet/{id}',function($request){
    $id=$request->getAttribute('id');
    deleteuser_petPet($id);
});
//  update data
//http://localhost/petcare/public/api/user_pet/id
$app->post('/api/user_pet/{id}',function($request) {
  $id=$request->getAttribute('id');
  updateuser_petPet($id);
});

//  insert data
//http://localhost/petcare/public/api/user_pet
$app->post('/api/user_pet',function($request) {
           insertuser_petPet();
});

//http://localhost/petcare/public/api/user_petmax
$app->get('/api/user_petmax',function($request){
    findMaxuser_pet_pet();
});


function getAlluser_petPet(){
  require_once('dbconnect.php');
  $query = "select * from user_pet";
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

function insertuser_petPet(){
  require_once('dbconnect.php');
  $input = json_decode(file_get_contents('php://input'), true);

  if (!isset($input[0]["petID"])) {
      echo "petID Not defined";
      return;
  }if (empty($input[0]["petID"])) {
      echo "petID is Empty";
      return;
  }
  if (!isset($input[0]["userID"])) {
      echo "userID Not defined";
      return;
  }if (empty($input[0]["userID"])) {
      echo "userID is Empty";
      return;
  }

  $petID =  $input[0]["petID"];
  $userID = $input[0]["userID"];

  $query1 = "select * from pet where cid='$petID'";
  $result1 = $mysqli->query($query1);
  while($row1 = $result1->fetch_assoc()){
    $data1[] = $row1;
  }
  if(!isset($data1)){
    echo "Invalid Pet";
    return;
  }

  $query2 = "select * from user where cid='$userID'";
  $result2 = $mysqli->query($query2);
  while($row2 = $result2->fetch_assoc()){
    $data2[] = $row2;
  }
  if(!isset($data2)){
    echo "Invalid User";
    return;
  }

  $sql = "insert into user_pet values(0,'".$petID."','".$userID."')";
  mysqli_query($mysqli,$sql);
  if (mysqli_affected_rows($mysqli)>0) {
    echo "true";
  }else{
    echo "false";
  }
}

function finduser_petPet($id){
  require_once('dbconnect.php');
  $query = "select * from user_pet where cid='$id'";
  $result = $mysqli->query($query);
  while($row = $result->fetch_assoc()){
      $data[] = $row;
  }
  if(isset($data)){
      header('Content-Type: application/json');
      echo json_encode($data);
  }else{
    echo "user_pet Not Found";
  }
}

function updateuser_petPet($id){
  require_once('dbconnect.php');
  $input = json_decode(file_get_contents('php://input'), true);

  if (!isset($input[0]["petID"])) {
      echo "petID Not defined";
      return;
  }if (empty($input[0]["petID"])) {
      echo "petID is Empty";
      return;
  }
  if (!isset($input[0]["userID"])) {
      echo "userID Not defined";
      return;
  }if (empty($input[0]["userID"])) {
      echo "userID is Empty";
      return;
  }

  $petID =  $input[0]["petID"];
  $userID = $input[0]["userID"];

  $sql = "update user_pet set petID='$petID', userID='$userID' where cid='$id'";
  mysqli_query($mysqli,$sql);
  if (mysqli_affected_rows($mysqli)>0) {
    echo "true";
  }else{
    echo "false";
  }
}

function deleteuser_petPet($id){
  require_once('dbconnect.php');
  $query = "delete from user_pet where cid='$id'";
  $result = $mysqli->query($query);
  if (mysqli_affected_rows($mysqli)>0){
    echo "true";
  }else{
    echo "false";
  }
}

function findMaxuser_pet_pet(){
  require_once('dbconnect.php');
    $xyz= "select max(cid) as maxx from user_pet";
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
