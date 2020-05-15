<?php
$app->get('/api/test_reports',function(){
    getAllTest_reports();
});
// find data
//http://localhost/petcare/public/api/test_reports/id
$app->get('/api/test_reports/{id}',function($request){
    $id=$request->getAttribute('id');
    findTest_reports($id);
});

// remove data
//http://localhost/petcare/public/api/test_reports/id
$app->delete('/api/test_reports/{id}',function($request){
    $id=$request->getAttribute('id');
    deleteTest_reports($id);
});
//  update data
//http://localhost/petcare/public/api/test_reports/id
$app->post('/api/test_reports/{id}',function($request) {
  $id=$request->getAttribute('id');
  updateTest_reports($id);
});

//  insert data
//http://localhost/petcare/public/api/test_reports
$app->post('/api/test_reports',function($request) {
           insertTest_reports();
});
$app->get('/api/test_reportsmax',function($request){
    findMaxtest_reports();
});


function getAllTest_reports(){
  require_once('dbconnect.php');
  $query = "select * from test_reports";
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

function insertTest_reports(){
  require_once('dbconnect.php');
  $input = json_decode(file_get_contents('php://input'), true);

  if (!isset($input[0]["date"])) {
      echo "date Not defined";
      return;
  }if (empty($input[0]["date"])) {
      echo "date is Empty";
      return;
  }
  if (!isset($input[0]["report_file"])) {
      echo "report_file Not defined";
      return;
  }if (empty($input[0]["report_file"])) {
      echo "report_file is Empty";
      return;
  }
  if (!isset($input[0]["petID"])) {
      echo "petID Not defined";
      return;
  }if (empty($input[0]["petID"])) {
      echo "petID is Empty";
      return;
  }

  $date = $input[0]["date"];
  $report_file = $input[0]["report_file"];
  $petID = $input[0]["petID"];
  // $date = $input[0]["date"];

    $query1 = "select * from pet where cid='$petID'";
    $result1 = $mysqli->query($query1);
    while($row1 = $result1->fetch_assoc()){
      $data1[] = $row1;
    }
    if(!isset($data1)){
      echo "Invalid Pet";
      return;
    }

  $sql = "insert into test_reports values(0,'".$date."','".$report_file."','".$petID."')";
  mysqli_query($mysqli,$sql);
  if (mysqli_affected_rows($mysqli)>0) {
    echo "true";
  }else{
    echo "false";
  }
}

function findTest_reports($id){
  require_once('dbconnect.php');
  $query = "select * from test_reports where cid='$id'";
  $result = $mysqli->query($query);
  while($row = $result->fetch_assoc()){
      $data[] = $row;
  }
  if(isset($data)){
      header('Content-Type: application/json');
      echo json_encode($data);
  }else{
    echo "test_reports Not Found";
  }
}

function updateTest_reports($id){
  require_once('dbconnect.php');
  $input = json_decode(file_get_contents('php://input'), true);

  if (!isset($input[0]["date"])) {
      echo "date Not defined";
      return;
  }if (empty($input[0]["date"])) {
      echo "date is Empty";
      return;
  }
  if (!isset($input[0]["report_file"])) {
      echo "report_file Not defined";
      return;
  }if (empty($input[0]["report_file"])) {
      echo "report_file is Empty";
      return;
  }
  if (!isset($input[0]["petID"])) {
      echo "petID Not defined";
      return;
  }if (empty($input[0]["petID"])) {
      echo "petID is Empty";
      return;
  }

  $date = $input[0]["date"];
  $report_file = $input[0]["report_file"];
  $petID = $input[0]["petID"];
  // $date = $input[0]["date"];

  $sql = "update test_reports set date='$date', report_file='$report_file', petID='$petID' where cid='$id'";
  mysqli_query($mysqli,$sql);
  if (mysqli_affected_rows($mysqli)>0) {
    echo "true";
  }else{
    echo "false";
  }
}

function deleteTest_reports($id){
  require_once('dbconnect.php');
  $query = "delete from test_reports where cid='$id'";
  $result = $mysqli->query($query);
  if (mysqli_affected_rows($mysqli)>0){
    echo "true";
  }else{
    echo "false";
  }
}

function findMaxtest_reports(){
  require_once('dbconnect.php');
    $xyz= "select max(cid) as maxx from test_reports";
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
