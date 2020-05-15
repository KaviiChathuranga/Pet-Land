<?php
$app->get('/api/likes',function(){
    getAlllikes();
});
// find data
//http://localhost/petcare/public/api/likes/id
$app->get('/api/likes/{id}',function($request){
    $id=$request->getAttribute('id');
    findlikes($id);
});

// remove data
//http://localhost/petcare/public/api/likes/id
$app->delete('/api/likes/{id}',function($request){
    $id=$request->getAttribute('id');
    deletelikes($id);
});
//  update data
//http://localhost/petcare/public/api/likes/id
$app->post('/api/likes/{id}',function($request) {
  $id=$request->getAttribute('id');
  updatelikes($id);
});

//  insert data
//http://localhost/petcare/public/api/likes
$app->post('/api/likes',function($request) {
           insertlikes();
});
$app->get('/api/likesmax',function($request){
    findMaxlikes();
});


function getAlllikes(){
  require_once('dbconnect.php');
  $query = "select * from likes";
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


function insertlikes(){
  require_once('dbconnect.php');
  $input = json_decode(file_get_contents('php://input'), true);

  if (!isset($input[0]["postID"])) {
      echo "postID Not defined";
      return;
  }if (empty($input[0]["postID"])) {
      echo "postID is Empty";
      return;
  }

  if (!isset($input[0]["userID"])) {
      echo "userID Not defined";
      return;
  }if (empty($input[0]["userID"])) {
      echo "userID is Empty";
      return;
  }

  $postID = $input[0]["postID"];
  $userID = $input[0]["userID"];

  $sql = "insert into likes values(0,'".$postID."','".$userID."')";
  mysqli_query($mysqli,$sql);
  if (mysqli_affected_rows($mysqli)>0) {
    echo "true";
  }else{
    echo "false";
  }
}


function findlikes($id){
  require_once('dbconnect.php');
  $query = "select * from likes where cid='$id'";
  $result = $mysqli->query($query);
  while($row = $result->fetch_assoc()){
      $data[] = $row;
  }
  if(isset($data)){
      header('Content-Type: application/json');
      echo json_encode($data);
  }else{
    echo "likes Not Found";
  }
}


function updatelikes($id){
  require_once('dbconnect.php');
  $input = json_decode(file_get_contents('php://input'), true);

  if (!isset($input[0]["postID"])) {
      echo "postID Not defined";
      return;
  }if (empty($input[0]["postID"])) {
      echo "postID is Empty";
      return;
  }

  if (!isset($input[0]["userID"])) {
      echo "userID Not defined";
      return;
  }if (empty($input[0]["userID"])) {
      echo "userID is Empty";
      return;
  }

  $postID = $input[0]["postID"];
  $userID = $input[0]["userID"];

  $query1 = "select * from post where cid='$postID'";
  $result1 = $mysqli->query($query1);
  while($row1 = $result1->fetch_assoc()){
    $data1[] = $row1;
  }
  if(!isset($data1)){
    echo "Invalid Post";
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
  
  $sql = "update likes set postID='$postID', userID='$userID' where cid='$id'";
  mysqli_query($mysqli,$sql);
  if (mysqli_affected_rows($mysqli)>0) {
    echo "true";
  }else{
    echo "false";
  }
}

function deletelikes($id){
  require_once('dbconnect.php');
  $query = "delete from likes where cid='$id'";
  $result = $mysqli->query($query);
  if (mysqli_affected_rows($mysqli)>0){
    echo "true";
  }else{
    echo "false";
  }
}

function findMaxlikes(){
  require_once('dbconnect.php');
    $xyz= "select max(cid) as maxx from likes";
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
