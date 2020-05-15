<?php
// Routes

use Slim\Http\Request;
use Slim\Http\Response;
use \Firebase\JWT\JWT;

$app->post('/api', function (Request $request, Response $response, array $args) {
  // require_once('settings.php');
  //   $input = $request->getParsedBody();
  //   $email = $input['email'];
  //   $sql = "SELECT * FROM User WHERE email= '$email'";
  //   $result = $mysqli->query($sql);
  //
  //   while($row = $result->fetch_assoc()){
  //       $data[] = $row;
  //   }
  //
  //   // verify email address.
  //   if(!isset($data)) {
  //       return $this->response->withJson(['error' => true, 'message' => 'These credentials do not match our records.']);
  //   }
  //
  //   // verify password.
  //   if ($input['password'] !== $data[0]['password']) {
  //       return $this->response->withJson(['error' => true, 'message' => 'These credentials do not match our records.']);
  //   }
  //
  //   $settings = $this->get('settings'); // get settings array.
  //
  //   $token = JWT::encode(['id' =>  $data[0]['id'], 'email' =>  $data[0]['email']], $settings['jwt']['secret'], "HS256");
  //
  //   return $this->response->withJson(['token' => $token]);

});
// $app->group('/api', function(\Slim\App $app) {

    $app->get('/api/userr',function(Request $request, Response $response, array $args) {
      // require_once('middleware.php');
        // echo $request->getAttribute('decoded_token_data');
        // echo $response;
        /*output
        stdClass Object
            (
                [id] => 2
                [email] => arjunphp@gmail.com
            )

        */
    });
//
// });
// $app->group('/api', function(\Slim\App $app) {
//
//     $app->get('/api/user',function(Request $request, Response $response, array $args) {
//         print_r($request->getAttribute('decoded_token_data'));
//
//         /*output
//         stdClass Object
//             (
//                 [id] => 2
//                 [email] => arjunphp@gmail.com
//             )
//
//         */
//     });
// //
// });
//
// use Firebase\JWT\JWT;
// use Tuupola\Base62;
// use \Psr\Http\Message\ServerRequestInterface as Request;
// use \Psr\Http\Message\ResponseInterface as Response;
//
// require '../vendor/autoload.php';
//
// $app = new \Slim\App;
// $container = $app->getContainer();
//
// $app->post("/api/token",  function ($request, $response, $args) use ($container){
//     /* Here generate and return JWT to the client. */
//     //$valid_scopes = ["read", "write", "delete"]
// // echo "string";
//   	$requested_scopes = $request->getParsedBody() ?: [];
//
//     $now = new DateTime();
//     $future = new DateTime("+10 minutes");
//     $server = $request->getServerParams();
//     $jti = (new Base62)->encode(random_bytes(16));
//     $payload = [
//         "iat" => $now->getTimeStamp(),
//         "exp" => $future->getTimeStamp(),
//         "jti" => $jti,
//         "sub" => $server["PHP_AUTH_USER"]
//     ];
//     // $details = "kavindu";
//     $secret = "123456789helo_secret";
//     $token = JWT::encode($payload, $secret, "HS256");
//     $data["token"] = $token;
//     $data["expires"] = $future->getTimeStamp();
//       // $data["name"] = $request;
//     return $response->withStatus(201)
//         ->withHeader("Content-Type", "application/json")
//         ->write(json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
// });
//
// $app->get("/api/secure",  function ($request, $response, $args) {
//
//     $data = ["status" => 1, 'msg' => "This route is secure!"];
//
//     return $response->withStatus(200)
//         ->withHeader("Content-Type", "application/json")
//         ->write(json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
// });
//
// $app->get("/api/not-secure",  function ($request, $response, $args) {
//
//     $data = ["status" => 1, 'msg' => "No need of token to access me"];
//
//     return $response->withStatus(200)
//         ->withHeader("Content-Type", "application/json")
//         ->write(json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
// });
//
// $app->post("/api/formData",  function ($request, $response, $args) {
//     $data = $request->getParsedBody();
//
//     $result = ["status" => 1, 'msg' => $data];
//
//     // Request with status response
//     return $this->response->withJson($result, 200);
// });
//
//
// $app->get('/api/home', function ($request, $response, $args) {
//         // Sample log message
//
//     $this->logger->info("Slim-Skeleton '/' route");
//     // Render index view
//     return $this->renderer->render($response, 'index.phtml', ["name" => "Welcome to Trinity Tuts demo Api"]);
// });
//
//     $app->post(“/token”, function ($request, $response, $args) use ($container){
//  /* Here generate and return JWT to the client. */
//  //$valid_scopes = [“read”, “write”, “delete”]
// $requested_scopes = $request->getParsedBody() ?: [];
// $now = new DateTime();
//  $future = new DateTime(“+10 minutes”);
//  $server = $request->getServerParams();
//  $jti = (new Base62)->encode(random_bytes(16));
//  $payload = [
//  “iat” => $now->getTimeStamp(),
//  “exp” => $future->getTimeStamp(),
//  “jti” => $jti,
//  “sub” => $server[“PHP_AUTH_USER”]
//  ];
//  $secret = “123456789helo_secret”;
//  $token = JWT::encode($payload, $secret, “HS256”);
//  $data[“token”] = $token;
//  $data[“expires”] = $future->getTimeStamp();
//  return $response->withStatus(201)
//  ->withHeader(“Content-Type”, “application/json”)
//  ->write(json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
// });
// $app->get(“/secure”, function ($request, $response, $args) {
// $data = [“status” => 1, ‘msg’ => “This route is secure!”];
// return $response->withStatus(200)
//  ->withHeader(“Content-Type”, “application/json”)
//  ->write(json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
// });
// $app->get(“/not-secure”, function ($request, $response, $args) {
// $data = [“status” => 1, ‘msg’ => “No need of token to access me”];
// return $response->withStatus(200)
//  ->withHeader(“Content-Type”, “application/json”)
//  ->write(json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
// });
// $app->post(“/formData”, function ($request, $response, $args) {
//  $data = $request->getParsedBody();
// $result = [“status” => 1, ‘msg’ => $data];
// // Request with status response
//  return $this->response->withJson($result, 200);
// });
// $app->get(‘/home’, function ($request, $response, $args) {
//  // Sample log message
//  $this->logger->info(“Slim-Skeleton ‘/’ route”);
// // Render index view
//  return $this->renderer->render($response, ‘index.phtml’, [“name” => “Welcome to Trinity Tuts demo Api”]);
// });
 ?>
