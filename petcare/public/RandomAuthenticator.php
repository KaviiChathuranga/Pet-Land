<?php
use Tuupola\Middleware\HttpBasicAuthentication\AuthenticatorInterface;
use Tuupola\Middleware\HttpBasicAuthentication;

class RandomAuthenticator implements AuthenticatorInterface {
    public function __invoke(array $arguments) {
        return (bool)rand(0,1);
    }
}

$app = new Slim\App;

$app->add(new HttpBasicAuthentication([
    "path" => "/admin",
    "realm" => "Protected",
    "authenticator" => new RandomAuthenticator
]));
 ?>
