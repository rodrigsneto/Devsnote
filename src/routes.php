<?php
use core\Router;

$router = new Router();

// CHAMA O HOMECONTROLLER CONSTRUCT, QUE JÁ VERIFICA SE HÁ ALGUM USUARIO LOGADO E SEUS DADOS.
$router->get('/', 'HomeController@index');

// ROTA LOGIN - CHAMA O LOGINCONTROLLER - METODO signin - RESPONSAVEL PELO LOGIN DO USUARIO
$router->get('/login', 'LoginController@signin');
// ROTA LOGIN - CHAMA O LOGINCONTROLLER - METODO signin - RESPONSAVEL PELO LOGIN DO USUARIO
$router->post('/login', 'LoginController@signinAction');

// ROTA LOGIN - CHAMA O LOGINCONTROLLER - METODO signin - RESPONSAVEL PELO LOGIN DO USUARIO
$router->get('/cadastro', 'LoginController@signup');
// ROTA LOGIN - CHAMA O LOGINCONTROLLER - METODO signin - RESPONSAVEL PELO LOGIN DO USUARIO
$router->post('/cadastro', 'LoginController@signupAction');

// $router->get('/pesquisa')
// $router->get('/perfil')
// $router->get('/sair')
// $router->get('/amigos')
// $router->get('/fotos')
// $router->get('/config')