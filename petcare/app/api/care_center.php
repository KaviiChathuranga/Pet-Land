<?php
$app->get('/api/care_center',function(){
    getAllCareCenter();
});
// find data
//http://localhost/petcare/public/api/care_center/id
$app->get('/api/care_center/{id}',function($request){
    $id=$request->getAttribute('id');
    findCareCenter($id);
});

// remove data
//http://localhost/petcare/public/api/care_center/id
$app->delete('/api/care_center/{id}',function($request){
    $id=$request->getAttribute('id');
    deleteCareCenter($id);
});
//  update data
//http://localhost/petcare/public/api/care_center/id
$app->post('/api/care_center/{id}',function($request) {
  $id=$request->getAttribute('id');
  updateCareCenter($id);
});

//  insert data
//http://localhost/petcare/public/api/care_center
$app->post('/api/care_center',function($request) {
           insertCareCenter();
});
$app->get('/api/care_centermax',function($request){
    findMaxcare_center();
});


function getAllCareCenter(){
  require_once('dbconnect.php');
  $query = "select * from care_center";
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


function insertCareCenter(){
  require_once('dbconnect.php');
  $input = json_decode(file_get_contents('php://input'), true);

  if (!isset($input[0]["care_center_name"])) {
      echo "care_center_name Not defined";
      return;
  }if (empty($input[0]["care_center_name"])) {
      echo "care_center_name is Empty";
      return;
  }
  if (!isset($input[0]["address"])) {
      echo "address Not defined";
      return;
  }if (empty($input[0]["address"])) {
      echo "address is Empty";
      return;
  }
  if (!isset($input[0]["contact_no"])) {
      echo "contact_no Not defined";
      return;
  }if (empty($input[0]["contact_no"])) {
      echo "contact_no is Empty";
      return;
  }
  if (!isset($input[0]["open_hours"])) {
      echo "open_hours Not defined";
      return;
  }if (empty($input[0]["open_hours"])) {
      echo "open_hours is Empty";
      return;
  }

  $care_center_name = $input[0]["care_center_name"];
  $address = $input[0]["address"];
  $contact_no = $input[0]["contact_no"];
  $open_hours = $input[0]["open_hours"];

 $sql = "insert into care_center values(0,'".$care_center_name."','".$address."','".$contact_no."','".$open_hours."')";
 mysqli_query($mysqli,$sql);
 if (mysqli_affected_rows($mysqli)>0) {
   echo "true";
 }else{
   echo "false";
 }
}


function findCareCenter($id){
  require_once('dbconnect.php');
  $query = "select * from care_center where cid='$id'";
  $result = $mysqli->query($query);
  while($row = $result->fetch_assoc()){
      $data[] = $row;
  }
  if(isset($data)){
      header('Content-Type: application/json');
      echo json_encode($data);
  }else{
    echo "care_center Not Found";
  }
}


function updateCareCenter($id){
  require_once('dbconnect.php');
  $input = json_decode(file_get_contents('php://input'), true);

  if (!isset($input[0]["care_center_name"])) {
      echo "care_center_name Not defined";
      return;
  }if (empty($input[0]["care_center_name"])) {
      echo "care_center_name is Empty";
      return;
  }
  if (!isset($input[0]["address"])) {
      echo "address Not defined";
      return;
  }if (empty($input[0]["address"])) {
      echo "address is Empty";
      return;
  }
  if (!isset($input[0]["contact_no"])) {
      echo "contact_no Not defined";
      return;
  }if (empty($input[0]["contact_no"])) {
      echo "contact_no is Empty";
      return;
  }
  if (!isset($input[0]["open_hours"])) {
      echo "open_hours Not defined";
      return;
  }if (empty($input[0]["open_hours"])) {
      echo "open_hours is Empty";
      return;
  }
  
  $care_center_name = $input[0]["care_center_name"];
  $address = $input[0]["address"];
  $contact_no = $input[0]["contact_no"];
  $open_hours = $input[0]["open_hours"];

 $sql = "update care_center set care_center_name='$care_center_name', address='$address', contact_no='$contact_no', open_hours='$open_hours' where cid='$id'";
 mysqli_query($mysqli,$sql);
 if (mysqli_affected_rows($mysqli)>0) {
   echo "true";
 }else{
   echo "false";
 }
}

function deleteCareCenter($id){
  require_once('dbconnect.php');
  $query = "delete from care_center where cid='$id'";
  $result = $mysqli->query($query);
  if (mysqli_affected_rows($mysqli)>0){
    echo "true";
  }else{
    echo "false";
  }
}


function findMaxcare_center(){
  require_once('dbconnect.php');
    $xyz= "select max(cid) as maxx from care_center";
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
