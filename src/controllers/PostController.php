<?php
namespace src\controllers;

use \core\Controller;
use \src\handlers\LoginHandler;
use \src\handlers\PostHandler;

class PostController extends Controller {

    // DADOS DO USUARIO LOGADO
    private $loggedUser;

    // CONSTRUCT JÁ VERIFICA SE HÁ LOGIN ATIVO E QUEM É QUE ESTÁ LOGADO
    // SEMPRE QUE USAR O HOMECONTROLLER COM O CONSTRUCT, AUTOMATICAMENTE JA VERIFICAMOS SEMPRE
    public function __construct() {
        // VERIFICA O LOGIN, E OS DADOS DO USUARIO LOGADO
        $this->loggedUser = LoginHandler::checkLogin();

        // CASO NAO RETORNE NENHUM USUARIO LOGADO, REDIRECIONA PARA /login
        if($this->loggedUser === false) {
            $this->redirect('/Login');
        }

    }

    public function new() {
        // receber os dados, validar dados e usuario e insere dados no BD
        $body = filter_input(INPUT_POST, 'body');

        if($body) {

            // ADICIONAR O POST
            PostHandler::addPost(
                $this->loggedUser->id,
                'text',
                $body
            );
        }

        $this->redirect('/');

    }

}