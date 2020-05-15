<?php
$app->get('/api/post',function(){
    getAllPost();
});
// find data
//http://localhost/petcare/public/api/post/id
$app->get('/api/post/{id}',function($request){
    $id=$request->getAttribute('id');
    findPost($id);
});

// remove data
//http://localhost/petcare/public/api/post/id
$app->delete('/api/post/{id}',function($request){
    $id=$request->getAttribute('id');
    deletePost($id);
});
//  update data
//http://localhost/petcare/public/api/post/id
$app->post('/api/post/{id}',function($request) {
  $id=$request->getAttribute('id');
  updatePost($id);
});

//  insert data
//http://localhost/petcare/public/api/post
$app->post('/api/post',function($request) {
           insertPost();
});
$app->get('/api/postmax',function($request){
    findMaxpost();
});

function getAllPost(){
  require_once('dbconnect.php');
  $query = "select * from post";
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

function insertPost(){
  require_once('dbconnect.php');
  $input = json_decode(file_get_contents('php://input'), true);

  if (!isset($input[0]["postID"])) {
      echo "postID Not defined";
      return;
  }if (empty($input[0]["postID"])) {
      echo "postID is Empty";
      return;
  }
  if (!isset($input[0]["posted_user"])) {
      echo "posted_user Not defined";
      return;
  }if (empty($input[0]["posted_user"])) {
      echo "posted_user is Empty";
      return;
  }
  if (!isset($input[0]["description"])) {
      echo "description Not defined";
      return;
  }if (empty($input[0]["description"])) {
      echo "description is Empty";
      return;
  }

  $postID = $input[0]["postID"];
  $posted_user = $input[0]["posted_user"];
  $post_img = $input[0]["post_img"];
  $description = $input[0]["description"];

    $query1 = "select * from user where cid='$posted_user'";
    $result1 = $mysqli->query($query1);
    while($row1 = $result1->fetch_assoc()){
      $data1[] = $row1;
    }
    if(!isset($data1)){
      echo "Invalid User";
      return;
    }
    
  $sql = "insert into post values(0,'".$postID."','".$posted_user."','".$post_img."','".$description."')";
  mysqli_query($mysqli,$sql);
  if (mysqli_affected_rows($mysqli)>0) {
    echo "true";
  }else{
    echo "false";
  }
}

function findPost($id){
  require_once('dbconnect.php');
  $query = "select * from post where cid='$id'";
  $result = $mysqli->query($query);
  while($row = $result->fetch_assoc()){
      $data[] = $row;
  }
  if(isset($data)){
      header('Content-Type: application/json');
      echo json_encode($data);
  }else{
    echo "post Not Found";
  }
}

function updatePost($id){
  require_once('dbconnect.php');
  $input = json_decode(file_get_contents('php://input'), true);

  if (!isset($input[0]["postID"])) {
      echo "postID Not defined";
      return;
  }if (empty($input[0]["postID"])) {
      echo "postID is Empty";
      return;
  }
  if (!isset($input[0]["posted_user"])) {
      echo "posted_user Not defined";
      return;
  }if (empty($input[0]["posted_user"])) {
      echo "posted_user is Empty";
      return;
  }
  if (!isset($input[0]["description"])) {
      echo "description Not defined";
      return;
  }if (empty($input[0]["description"])) {
      echo "description is Empty";
      return;
  }

  $postID = $input[0]["postID"];
  $posted_user = $input[0]["posted_user"];
  $post_img = $input[0]["post_img"];
  $description = $input[0]["description"];

  $sql = "update post set postID='$postID', posted_user='$posted_user', post_img='$post_img', description='$description' where cid='$id'";
  mysqli_query($mysqli,$sql);
  if (mysqli_affected_rows($mysqli)>0) {
    echo "true";
  }else{
    echo "false";
  }
}

function deletePost($id){
  require_once('dbconnect.php');
  $query = "delete from post where cid='$id'";
  $result = $mysqli->query($query);
  if (mysqli_affected_rows($mysqli)>0){
    echo "true";
  }else{
    echo "false";
  }
}

function findMaxpost(){
  require_once('dbconnect.php');
    $xyz= "select max(cid) as maxx from post";
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
