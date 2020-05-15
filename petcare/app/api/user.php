<?php
$app->get('/api/user',function(){
    getAllUser();
});
// find data
//http://localhost/petcare/public/api/user/id
$app->get('/api/user/{id}',function($request){
    $id=$request->getAttribute('id');
    findUser($id);
});

// remove data
//http://localhost/petcare/public/api/user/id
$app->delete('/api/user/{id}',function($request){
    $id=$request->getAttribute('id');
    deleteUser($id);
});
//  update data
//http://localhost/petcare/public/api/user/id
$app->post('/api/user/{id}',function($request) {
  $id=$request->getAttribute('id');
  updateUser($id);
});

//  insert data
//http://localhost/petcare/public/api/user
$app->post('/api/user',function($request) {
           insertUser();
});

$app->get('/api/usermax',function(){
    findMaxuser();
});


function getAllUser(){
  require_once('dbconnect.php');
  $query = "select * from user";
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

function insertUser(){
  require_once('dbconnect.php');
  $input = json_decode(file_get_contents('php://input'), true);

  if (!isset($input[0]["user_name"])) {
      echo "user_name Not defined";
      return;
  }if (empty($input[0]["user_name"])) {
      echo "user_name is Empty";
      return;
  }

  if (!isset($input[0]["mob_no"])) {
      echo "mobile_number Not defined";
      return;
  }if (empty($input[0]["mob_no"])) {
      echo "mobile_number is Empty";
      return;
  }

  if (!isset($input[0]["dob"])) {
      echo "Date Of Birth Not defined";
      return;
  }if (empty($input[0]["dob"])) {
      echo "Date Of Birth is Empty";
      return;
  }
  if (!isset($input[0]["name"])) {
      echo "Name Not defined";
      return;
  }if (empty($input[0]["name"])) {
      echo "Name is Empty";
      return;
  }
  if (!isset($input[0]["home_no"])) {
      echo "home_Number Not defined";
      return;
  }
  $userID = $input[0]["userID"];
  $user_name = $input[0]["user_name"];
  $name = $input[0]["name"];
  $mob_no = $input[0]["mob_no"];
  $home_no = $input[0]["home_no"];
  $dob = $input[0]["dob"];

  $sql="insert into user VALUES(0,'".$userID."','".$user_name."','".$name."','".$mob_no."','".$home_no."','".$dob."')";
  mysqli_query($mysqli,$sql);
  if (mysqli_affected_rows($mysqli)>0) {
    echo "true";
  }else{
    echo "false";
  }
}

function findUser($id){
  require_once('dbconnect.php');
  $query = "select * from User where cid='$id'";
  $result = $mysqli->query($query);
  while($row = $result->fetch_assoc()){
      $data[] = $row;
  }
  if(isset($data)){
      header('Content-Type: application/json');
      echo json_encode($data);
  }else{
    echo "User Not Found";
  }
}

function updateUser($id){
  require_once('dbconnect.php');
  $input = json_decode(file_get_contents('php://input'), true);

  if (!isset($input[0]["user_name"])) {
      echo "user_name Not defined";
      return;
  }if (empty($input[0]["user_name"])) {
      echo "user_name is Empty";
      return;
  }

  if (!isset($input[0]["mob_no"])) {
      echo "mobile_number Not defined";
      return;
  }if (empty($input[0]["mob_no"])) {
      echo "mobile_number is Empty";
      return;
  }

  if (!isset($input[0]["dob"])) {
      echo "Date Of Birth Not defined";
      return;
  }if (empty($input[0]["dob"])) {
      echo "Date Of Birth is Empty";
      return;
  }

  if (!isset($input[0]["name"])) {
      echo "Name Not defined";
      return;
  }if (empty($input[0]["name"])) {
      echo "Name is Empty";
      return;
  }
  if (!isset($input[0]["home_no"])) {
      echo "home_Number Not defined";
      return;
  }

  $userID = $input[0]["userID"];
  $user_name = $input[0]["user_name"];
  $name = $input[0]["name"];
  $mob_no = $input[0]["mob_no"];
  $home_no = $input[0]["home_no"];
  $dob = $input[0]["dob"];

  $sql="update user set userID='$userID', user_name='$user_name', name='$name', mob_no='$mob_no', home_no='$home_no', dob='$dob' where cid='$id'";
  mysqli_query($mysqli,$sql);
  if (mysqli_affected_rows($mysqli)>0) {
    echo "true";
  }else{
    echo "false";
  }
}

function deleteUser($id){
  require_once('dbconnect.php');
  $query = "delete from user where cid='$id'";
  $result = $mysqli->query($query);
  if (mysqli_affected_rows($mysqli)>0){
    echo "true";
  }else{
    echo "false";
  }
}

function findMaxuser(){
  require_once('dbconnect.php');
    $xyz= "select max(cid) as maxx from user";
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

?>
