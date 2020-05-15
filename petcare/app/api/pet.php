<?php
$app->get('/api/pet',function(){
    getAllPet();
});
// find data
//http://localhost/petcare/public/api/pet/id
$app->get('/api/pet/{id}',function($request){
    $id=$request->getAttribute('id');
    findPet($id);
});
$app->get('/api/petID/{id}',function($request){
    $id=$request->getAttribute('id');
    findpetID($id);
});
// remove data
//http://localhost/petcare/public/api/pet/id
$app->delete('/api/pet/{id}',function($request){
    $id=$request->getAttribute('id');
    deletePet($id);
});
//  update data
//http://localhost/petcare/public/api/pet/id
$app->post('/api/pet/{id}',function($request) {
  $id=$request->getAttribute('id');
  updatePet($id);
});

//  insert data
//http://localhost/petcare/public/api/pet
$app->post('/api/pet',function($request) {
           insertPet();
});
$app->get('/api/petmax',function($request){
    findMaxpet();
});


function getAllPet(){
  require_once('dbconnect.php');
  $query = "select * from pet";
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

function insertPet(){
  require_once('dbconnect.php');
  $input = json_decode(file_get_contents('php://input'), true);
  $xyz= "select max(cid) as maxx from pet";
  $xxx=$mysqli->query($xyz);
  while($row1 = $xxx->fetch_assoc()){
    $data1[] = $row1;
  }
  $max = json_encode($data1[0]['maxx'],JSON_NUMERIC_CHECK );
  if ($max == 0) {
    $max =0;
  }
  if (!isset($input[0]["category"])) {
      echo "category Not defined";
      return;
  }if (empty($input[0]["category"])) {
      echo "category is Empty";
      return;
  }
  if (!isset($input[0]["name"])) {
      echo "name Not defined";
      return;
  }if (empty($input[0]["name"])) {
      echo "name is Empty";
      return;
  }
  if (!isset($input[0]["weight"])) {
      echo "weight Not defined";
      return;
  }if (empty($input[0]["weight"])) {
      echo "weight is Empty";
      return;
  }
  if (!isset($input[0]["breed"])) {
      echo "breed Not defined";
      return;
  }if (empty($input[0]["breed"])) {
      echo "breed is Empty";
      return;
  }
  if (!isset($input[0]["pet_dob"])) {
      echo "pet_dob Not defined";
      return;
  }if (empty($input[0]["pet_dob"])) {
      echo "pet_dob is Empty";
      return;
  }

  $category = $input[0]["category"];
  $splittedString = str_split($category);
  $petID =  $splittedString[0]."0".($max+1);

  $name = $input[0]["name"];
  $weight = $input[0]["weight"];
  $breed = $input[0]["breed"];
  $pet_dob = $input[0]["pet_dob"];

  $sql = "insert into pet values(0,'".$petID."','".$category."','".$name."','".$weight."','".$breed."','".$pet_dob."')";
  mysqli_query($mysqli,$sql);
  if (mysqli_affected_rows($mysqli)>0) {
    echo "true";
  }else{
    echo "false";
  }
}

function findPet($id){
  require_once('dbconnect.php');
  $query = "select * from pet where cid='$id'";
  $result = $mysqli->query($query);
  while($row = $result->fetch_assoc()){
      $data[] = $row;
  }
  if(isset($data)){
      header('Content-Type: application/json');
      echo json_encode($data);
  }else{
    echo "pet Not Found";
  }
}
function findpetID($id){
  require_once('dbconnect.php');
  $query = "select * from pet where petID='$id'";
  $result = $mysqli->query($query);
  while($row = $result->fetch_assoc()){
      $data[] = $row;
  }
  if(isset($data)){
      header('Content-Type: application/json');
      echo json_encode($data);
  }else{
    echo "pet Not Found";
  }
}
function updatePet($id){
  require_once('dbconnect.php');
  $input = json_decode(file_get_contents('php://input'), true);

  if (!isset($input[0]["category"])) {
      echo "category Not defined";
      return;
  }if (empty($input[0]["category"])) {
      echo "category is Empty";
      return;
  }
  if (!isset($input[0]["name"])) {
      echo "name Not defined";
      return;
  }if (empty($input[0]["name"])) {
      echo "name is Empty";
      return;
  }
  if (!isset($input[0]["weight"])) {
      echo "weight Not defined";
      return;
  }if (empty($input[0]["weight"])) {
      echo "weight is Empty";
      return;
  }
  if (!isset($input[0]["breed"])) {
      echo "breed Not defined";
      return;
  }if (empty($input[0]["breed"])) {
      echo "breed is Empty";
      return;
  }
  if (!isset($input[0]["pet_dob"])) {
      echo "pet_dob Not defined";
      return;
  }if (empty($input[0]["pet_dob"])) {
      echo "pet_dob is Empty";
      return;
  }

  $petID = $input[0]["petID"];
  $category = $input[0]["category"];
  $name = $input[0]["name"];
  $weight = $input[0]["weight"];
  $breed = $input[0]["breed"];
  $pet_dob = $input[0]["pet_dob"];

  $sql = "update pet set petID='$petID', category='$category', name='$name', weight='$weight', breed='$breed', pet_dob='$pet_dob'  where cid='$id'";
  mysqli_query($mysqli,$sql);
  if (mysqli_affected_rows($mysqli)>0) {
    echo "true";
  }else{
    echo "false";
  }
}

function deletePet($id){
  require_once('dbconnect.php');
  $query = "delete from pet where cid='$id'";
  $result = $mysqli->query($query);
  if (mysqli_affected_rows($mysqli)>0){
    echo "true";
  }else{
    echo "false";
  }
}

function findMaxpet(){
  require_once('dbconnect.php');
    $xyz= "select max(cid) as maxx from pet";
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
