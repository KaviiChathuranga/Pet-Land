<?php
$app->get('/api/treatments',function(){
    getAllTreatments();
});
// find data
//http://localhost/petcare/public/api/treatments/id
$app->get('/api/treatments/{id}',function($request){
    $id=$request->getAttribute('id');
    findTreatments($id);
});

// remove data
//http://localhost/petcare/public/api/treatments/id
$app->delete('/api/treatments/{id}',function($request){
    $id=$request->getAttribute('id');
    deleteTreatments($id);
});
//  update data
//http://localhost/petcare/public/api/treatments/id
$app->post('/api/treatments/{id}',function($request) {
  $id=$request->getAttribute('id');
  updateTreatments($id);
});

//  insert data
//http://localhost/petcare/public/api/treatments
$app->post('/api/treatments',function($request) {
           insertTreatments();
});
$app->get('/api/treatmentsmax',function($request){
    findMaxtreatments();
});

function getAllTreatments(){
  require_once('dbconnect.php');
  $query = "select * from treatments";
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

function insertTreatments(){
  require_once('dbconnect.php');
  $input = json_decode(file_get_contents('php://input'), true);

  if (!isset($input[0]["date"])) {
      echo "date Not defined";
      return;
  }if (empty($input[0]["date"])) {
      echo "date is Empty";
      return;
  }
  if (!isset($input[0]["age"])) {
      echo "age Not defined";
      return;
  }if (empty($input[0]["age"])) {
      echo "age is Empty";
      return;
  }
  if (!isset($input[0]["doctor"])) {
      echo "doctor Not defined";
      return;
  }if (empty($input[0]["doctor"])) {
      echo "doctor is Empty";
      return;
  }
  if (!isset($input[0]["care_center"])) {
      echo "care_center Not defined";
      return;
  }if (empty($input[0]["care_center"])) {
      echo "care_center is Empty";
      return;
  }
  if (!isset($input[0]["remark"])) {
      echo "remark Not defined";
      return;
  }if (empty($input[0]["remark"])) {
      echo "remark is Empty";
      return;
  }
  if (!isset($input[0]["next_gen_risk"])) {
      echo "next_gen_risk Not defined";
      return;
  }if (empty($input[0]["next_gen_risk"])) {
      echo "next_gen_risk is Empty";
      return;
  }

  $date = $input[0]["date"];
  $age = $input[0]["age"];
  $doctor = $input[0]["doctor"];
  $care_center = $input[0]["care_center"];
  $remark = $input[0]["remark"];
  $next_gen_risk = $input[0]["next_gen_risk"];

  $query1 = "select * from care_center where cid='$care_center'";
  $result1 = $mysqli->query($query1);
  while($row1 = $result1->fetch_assoc()){
    $data1[] = $row1;
  }
  if(!isset($data1)){
    echo "Invalid care_center";
    return;
  }

  $query2 = "select * from doctor where cid='$doctor'";
  $result2 = $mysqli->query($query2);
  while($row2 = $result2->fetch_assoc()){
    $data2[] = $row2;
  }
  if(!isset($data2)){
    echo "Invalid Doctor";
    return;
  }

  $sql = "insert into treatments values(0,'".$date."','".$age."','".$doctor."','".$care_center."','".$remark."','".$next_gen_risk."')";
  mysqli_query($mysqli,$sql);
  if (mysqli_affected_rows($mysqli)>0) {
    echo "true";
  }else{
    echo "false";
  }

}

function findTreatments($id){
  require_once('dbconnect.php');
  $query = "select * from treatments where cid='$id'";
  $result = $mysqli->query($query);
  while($row = $result->fetch_assoc()){
      $data[] = $row;
  }
  if(isset($data)){
      header('Content-Type: application/json');
      echo json_encode($data);
  }else{
    echo "treatments Not Found";
  }
}

function updateTreatments($id){
  require_once('dbconnect.php');
  $input = json_decode(file_get_contents('php://input'), true);

  if (!isset($input[0]["date"])) {
      echo "date Not defined";
      return;
  }if (empty($input[0]["date"])) {
      echo "date is Empty";
      return;
  }
  if (!isset($input[0]["age"])) {
      echo "age Not defined";
      return;
  }if (empty($input[0]["age"])) {
      echo "age is Empty";
      return;
  }
  if (!isset($input[0]["doctor"])) {
      echo "doctor Not defined";
      return;
  }if (empty($input[0]["doctor"])) {
      echo "doctor is Empty";
      return;
  }
  if (!isset($input[0]["care_center"])) {
      echo "care_center Not defined";
      return;
  }if (empty($input[0]["care_center"])) {
      echo "care_center is Empty";
      return;
  }
  if (!isset($input[0]["remark"])) {
      echo "remark Not defined";
      return;
  }if (empty($input[0]["remark"])) {
      echo "remark is Empty";
      return;
  }
  if (!isset($input[0]["next_gen_risk"])) {
      echo "next_gen_risk Not defined";
      return;
  }if (empty($input[0]["next_gen_risk"])) {
      echo "next_gen_risk is Empty";
      return;
  }

  $date = $input[0]["date"];
  $age = $input[0]["age"];
  $doctor = $input[0]["doctor"];
  $care_center = $input[0]["care_center"];
  $remark = $input[0]["remark"];
  $next_gen_risk = $input[0]["next_gen_risk"];

  $sql = "update treatments set date='$date', age='$age', doctor='$doctor', care_center='$care_center', remark='$remark', next_gen_risk='$next_gen_risk'  where cid='$id'";
  mysqli_query($mysqli,$sql);
  if (mysqli_affected_rows($mysqli)>0) {
    echo "true";
  }else{
    echo "false";
  }
}

function deleteTreatments($id){
  require_once('dbconnect.php');
  $query = "delete from treatments where cid='$id'";
  $result = $mysqli->query($query);
  if (mysqli_affected_rows($mysqli)>0){
    echo "true";
  }else{
    echo "false";
  }
}

function findMaxtreatments(){
  require_once('dbconnect.php');
    $xyz= "select max(cid) as maxx from treatments";
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
