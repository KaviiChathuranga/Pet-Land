<?php
$app->get('/api/notification',function(){
    getAllNotification();
});
// find data
//http://localhost/petcare/public/api/notification/id
$app->get('/api/notification/{id}',function($request){
    $id=$request->getAttribute('id');
    findNotification($id);
});

// remove data
//http://localhost/petcare/public/api/notification/id
$app->delete('/api/notification/{id}',function($request){
    $id=$request->getAttribute('id');
    deleteNotification($id);
});
//  update data
//http://localhost/petcare/public/api/notification/id
$app->post('/api/notification/{id}',function($request) {
  $id=$request->getAttribute('id');
  updateNotification($id);
});

//  insert data
//http://localhost/petcare/public/api/notification
$app->post('/api/notification',function($request) {
           insertNotification();
});
$app->get('/api/notificationmax',function($request){
    findMaxnotification();
});



function getAllNotification(){
  require_once('dbconnect.php');
  $query = "select * from notification";
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


function insertNotification(){
  require_once('dbconnect.php');
  $input = json_decode(file_get_contents('php://input'), true);

  if (!isset($input[0]["petID"])) {
      echo "petID Not defined";
      return;
  }if (empty($input[0]["petID"])) {
      echo "petID is Empty";
      return;
  }

  if (!isset($input[0]["status"])) {
      echo "status Not defined";
      return;
  }if (empty($input[0]["status"])) {
      echo "status is Empty";
      return;
  }

  $petID = $input[0]["petID"];
  $status = $input[0]["status"];

  $query1 = "select * from pet where cid='$petID'";
  $result1 = $mysqli->query($query1);
  while($row1 = $result1->fetch_assoc()){
    $data1[] = $row1;
  }
  if(!isset($data1)){
    echo "Invalid Pet";
    return;
  }

  $sql = "insert into notification values(0,'".$petID."','".$status."')";
  mysqli_query($mysqli,$sql);
  if (mysqli_affected_rows($mysqli)>0) {
    echo "true";
  }else{
    echo "false";
  }
}


function findNotification($id){
  require_once('dbconnect.php');
  $query = "select * from notification where cid='$id'";
  $result = $mysqli->query($query);
  while($row = $result->fetch_assoc()){
      $data[] = $row;
  }
  if(isset($data)){
      header('Content-Type: application/json');
      echo json_encode($data);
  }else{
    echo "notification Not Found";
  }
}


function updateNotification($id){
  require_once('dbconnect.php');
  $input = json_decode(file_get_contents('php://input'), true);

  if (!isset($input[0]["petID"])) {
      echo "petID Not defined";
      return;
  }if (empty($input[0]["petID"])) {
      echo "petID is Empty";
      return;
  }

  if (!isset($input[0]["status"])) {
      echo "status Not defined";
      return;
  }if (empty($input[0]["status"])) {
      echo "status is Empty";
      return;
  }


  $petID = $input[0]["petID"];
  $status = $input[0]["status"];

  $sql = "update notification set petID='$petID', status='$status'  where cid='$id'";
  mysqli_query($mysqli,$sql);
  if (mysqli_affected_rows($mysqli)>0) {
    echo "true";
  }else{
    echo "false";
  }
}

function deleteNotification($id){
  require_once('dbconnect.php');
  $query = "delete from notification where cid='$id'";
  $result = $mysqli->query($query);
  if (mysqli_affected_rows($mysqli)>0){
    echo "true";
  }else{
    echo "false";
  }
}

function findMaxnotification(){
  require_once('dbconnect.php');
    $xyz= "select max(cid) as maxx from notification";
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
