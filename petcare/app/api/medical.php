<?php
$app->get('/api/medical',function(){
    getAllMedical();
});
// find data
//http://localhost/petcare/public/api/medical/id
$app->get('/api/medical/{id}',function($request){
    $id=$request->getAttribute('id');
    findMedical($id);
});

// remove data
//http://localhost/petcare/public/api/medical/id
$app->delete('/api/medical/{id}',function($request){
    $id=$request->getAttribute('id');
    deleteMedical($id);
});
//  update data
//http://localhost/petcare/public/api/medical/id
$app->post('/api/medical/{id}',function($request) {
  $id=$request->getAttribute('id');
  updateMedical($id);
});

//  insert data
//http://localhost/petcare/public/api/medical
$app->post('/api/medical',function($request) {
           insertMedical();
});
$app->get('/api/medicalmax',function($request){
    findMaxmedical();
});


function getAllMedical(){
  require_once('dbconnect.php');
  $query = "select * from medical_doctor";
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


function insertMedical(){
  require_once('dbconnect.php');
  $input = json_decode(file_get_contents('php://input'), true);

  if (!isset($input[0]["centerID"])) {
      echo "centerID Not defined";
      return;
  }if (empty($input[0]["centerID"])) {
      echo "centerID is Empty";
      return;
  }
  if (!isset($input[0]["allocated_doctor"])) {
      echo "allocated_doctor Not defined";
      return;
  }if (empty($input[0]["allocated_doctor"])) {
      echo "allocated_doctor is Empty";
      return;
  }


    $centerID = $input[0]["centerID"];
    $allocated_doctor = $input[0]["allocated_doctor"];

    $query1 = "select * from care_center where cid='$centerID'";
    $result1 = $mysqli->query($query1);
    while($row1 = $result1->fetch_assoc()){
      $data1[] = $row1;
    }
    if(!isset($data1)){
      echo "Invalid care_center";
      return;
    }

    $query2 = "select * from doctor where cid='$allocated_doctor'";
    $result2 = $mysqli->query($query2);
    while($row2 = $result2->fetch_assoc()){
      $data2[] = $row2;
    }
    if(!isset($data2)){
      echo "Invalid Doctor";
      return;
    }

    $sql = "insert into medical_doctor values(0,'".$centerID."','".$allocated_doctor."')";
    mysqli_query($mysqli,$sql);
    if (mysqli_affected_rows($mysqli)>0) {
      echo "true";
    }else{
      echo "false";
    }
}


function findMedical($id){
  require_once('dbconnect.php');
  $query = "select * from medical_doctor where cid='$id'";
  $result = $mysqli->query($query);
  while($row = $result->fetch_assoc()){
      $data[] = $row;
  }
  if(isset($data)){
      header('Content-Type: application/json');
      echo json_encode($data);
  }else{
    echo "medical_doctor Not Found";
  }
}


function updateMedical($id){
  require_once('dbconnect.php');
  $input = json_decode(file_get_contents('php://input'), true);

  if (!isset($input[0]["centerID"])) {
      echo "centerID Not defined";
      return;
  }if (empty($input[0]["centerID"])) {
      echo "centerID is Empty";
      return;
  }
  if (!isset($input[0]["allocated_doctor"])) {
      echo "allocated_doctor Not defined";
      return;
  }if (empty($input[0]["allocated_doctor"])) {
      echo "allocated_doctor is Empty";
      return;
  }

  $centerID = $input[0]["centerID"];
  $allocated_doctor = $input[0]["allocated_doctor"];

  $sql = "update medical_doctor set centerID='$centerID', allocated_doctor='$allocated_doctor' where cid='$id'";
  mysqli_query($mysqli,$sql);
  if (mysqli_affected_rows($mysqli)>0) {
    echo "true";
  }else{
    echo "false";
  }
}

function deleteMedical($id){
  require_once('dbconnect.php');
  $query = "delete from medical_doctor where cid='$id'";
  $result = $mysqli->query($query);
  if (mysqli_affected_rows($mysqli)>0){
    echo "true";
  }else{
    echo "false";
  }
}

function findMaxmedical(){
  require_once('dbconnect.php');
    $xyz= "select max(cid) as maxx from medical_doctor";
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
