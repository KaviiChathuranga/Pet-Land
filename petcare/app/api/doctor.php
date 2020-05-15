<?php
$app->get('/api/doctor',function(){
    getAllDoctor();
});
// find data
//http://localhost/petcare/public/api/doctor/id
$app->get('/api/doctor/{id}',function($request){
    $id=$request->getAttribute('id');
    findDoctor($id);
});

// remove data
//http://localhost/petcare/public/api/doctor/id
$app->delete('/api/doctor/{id}',function($request){
    $id=$request->getAttribute('id');
    deleteDoctor($id);
});
//  update data
//http://localhost/petcare/public/api/doctor/id
$app->post('/api/doctor/{id}',function($request) {
  $id=$request->getAttribute('id');
  updateDoctor($id);
});

//  insert data
//http://localhost/petcare/public/api/doctor
$app->post('/api/doctor',function($request) {
           insertDoctor();
});
$app->get('/api/doctormax',function($request){
    findMaxdoctor();
});


function getAllDoctor(){
  require_once('dbconnect.php');
  $query = "select * from doctor";
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


function insertDoctor(){
  require_once('dbconnect.php');
  $input = json_decode(file_get_contents('php://input'), true);

  if (!isset($input[0]["doctor_name"])) {
      echo "doctor_name Not defined";
      return;
  }if (empty($input[0]["doctor_name"])) {
      echo "doctor_name is Empty";
      return;
  }
  if (!isset($input[0]["slva_no"])) {
      echo "slva_no Not defined";
      return;
  }if (empty($input[0]["slva_no"])) {
      echo "slva_no is Empty";
      return;
  }
  if (!isset($input[0]["address"])) {
      echo "address Not defined";
      return;
  }if (empty($input[0]["address"])) {
      echo "address is Empty";
      return;
  }
  $doctor_name = $input[0]["doctor_name"];
  $slva_no = $input[0]["slva_no"];
  $address = $input[0]["address"];
  // $doctor_name = $input[0]["doctor_name"];

  $sql = "insert into doctor values(0,'".$doctor_name."','".$slva_no."','".$address."')";
  mysqli_query($mysqli,$sql);
  if (mysqli_affected_rows($mysqli)>0) {
    echo "true";
  }else{
    echo "false";
  }
}


function findDoctor($id){
  require_once('dbconnect.php');
  $query = "select * from doctor where cid='$id'";
  $result = $mysqli->query($query);
  while($row = $result->fetch_assoc()){
      $data[] = $row;
  }
  if(isset($data)){
      header('Content-Type: application/json');
      echo json_encode($data);
  }else{
    echo "doctor Not Found";
  }
}


function updateDoctor($id){
  require_once('dbconnect.php');
  $input = json_decode(file_get_contents('php://input'), true);

  if (!isset($input[0]["doctor_name"])) {
      echo "doctor_name Not defined";
      return;
  }if (empty($input[0]["doctor_name"])) {
      echo "doctor_name is Empty";
      return;
  }
  if (!isset($input[0]["slva_no"])) {
      echo "slva_no Not defined";
      return;
  }if (empty($input[0]["slva_no"])) {
      echo "slva_no is Empty";
      return;
  }
  if (!isset($input[0]["address"])) {
      echo "address Not defined";
      return;
  }if (empty($input[0]["address"])) {
      echo "address is Empty";
      return;
  }
  
  $doctor_name = $input[0]["doctor_name"];
  $slva_no = $input[0]["slva_no"];
  $address = $input[0]["address"];
  // $doctor_name = $input[0]["doctor_name"];

  $sql = "update doctor set doctor_name='$doctor_name', slva_no='$slva_no', address='$address'  where cid='$id'";
  mysqli_query($mysqli,$sql);
  if (mysqli_affected_rows($mysqli)>0) {
    echo "true";
  }else{
    echo "false";
  }
}

function deleteDoctor($id){
  require_once('dbconnect.php');
  $query = "delete from doctor where cid='$id'";
  $result = $mysqli->query($query);
  if (mysqli_affected_rows($mysqli)>0){
    echo "true";
  }else{
    echo "false";
  }
}

function findMaxdoctor(){
  require_once('dbconnect.php');
    $xyz= "select max(cid) as maxx from doctor";
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
