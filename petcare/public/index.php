<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../vendor/autoload.php';

$app = new \Slim\App;
$container = $app->getContainer();
  //
  require_once('../src/routes.php');
  require_once('../src/middleware.php');
  require_once('../app/api/user.php');
  require_once('../app/api/user_pet.php');
  require_once('../app/api/pet.php');
  require_once('../app/api/like.php');
  require_once('../app/api/care_center.php');
  require_once('../app/api/comments.php');
  require_once('../app/api/doctor.php');
  require_once('../app/api/medical.php');
  require_once('../app/api/notification.php');
  require_once('../app/api/post.php');
  require_once('../app/api/treatments.php');
  require_once('../app/api/test_reports.php');
  require_once('../app/api/pet_vaccination.php');
  require_once('../app/api/pet_treatments.php');
  require_once('../app/api/pet_surgeries.php');

$app->run();
