<?php
$app->get('/api/comments',function(){
    getAllComments();
});
// find data
//http://localhost/petcare/public/api/comments/id
$app->get('/api/comments/{id}',function($request){
    $id=$request->getAttribute('id');
    findComments($id);
});

// remove data
//http://localhost/petcare/public/api/comments/id
$app->delete('/api/comments/{id}',function($request){
    $id=$request->getAttribute('id');
    deleteComments($id);
});
//  update data
//http://localhost/petcare/public/api/comments/id
$app->post('/api/comments/{id}',function($request) {
  $id=$request->getAttribute('id');
  updateComments($id);
});

//  insert data
//http://localhost/petcare/public/api/comments
$app->post('/api/comments',function($request) {
           insertComments();
});
$app->get('/api/commentsmax',function($request){
    findMaxcomments();
});


function getAllComments(){
  require_once('dbconnect.php');
  $query = "select * from comments";
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


function insertComments(){
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

  $sql = "insert into comments values(0,'".$postID."','".$userID."')";
  mysqli_query($mysqli,$sql);
  if (mysqli_affected_rows($mysqli)>0) {
    echo "true";
  }else{
    echo "false";
  }
}


function findComments($id){
  require_once('dbconnect.php');
  $query = "select * from comments where cid='$id'";
  $result = $mysqli->query($query);
  while($row = $result->fetch_assoc()){
      $data[] = $row;
  }
  if(isset($data)){
      header('Content-Type: application/json');
      echo json_encode($data);
  }else{
    echo "comments Not Found";
  }
}


function updateComments($id){
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

 $sql = "update comments set postID='$postID', userID='$userID' where cid='$id'";
 mysqli_query($mysqli,$sql);
 if (mysqli_affected_rows($mysqli)>0) {
   echo "true";
 }else{
   echo "false";
 }
}

function deleteComments($id){
  require_once('dbconnect.php');
  $query = "delete from comments where cid='$id'";
  $result = $mysqli->query($query);
  if (mysqli_affected_rows($mysqli)>0){
    echo "true";
  }else{
    echo "false";
  }
}


function findMaxcomments(){
  require_once('dbconnect.php');
    $xyz= "select max(cid) as maxx from comments";
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
