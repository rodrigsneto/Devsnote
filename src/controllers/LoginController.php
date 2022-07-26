<?php
namespace src\controllers;

use \core\Controller;
use \src\handlers\LoginHandler;

class LoginController extends Controller {

    public function signin() {
        // TEM ALGUMA MENSAGEM DE FLASH?
        $flash = '';
        if(!empty($_SESSION['flash'])) {
            $flash = $_SESSION['flash'];
            $_SESSION['flash'] = '';
        }
        // RENDERIZAR LOGIN (ENVIANDO AVISO FLASH, SE HOUVER)
        $this->render('signin', [
            'flash'=>$flash
        ]);
    }

    public function signinAction() {
        // RECEBER input email
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        // RECEBER input password
        $password = filter_input(INPUT_POST, 'password');

        // SE $email E $password EXISTIR
        if($email && $password) {
            // VERIFICAR LOGIN, ENVIANDO EMAIL E SENHA, E RETORNAR UM token
            $token = LoginHandler::verifyLogin($email, $password);

            if($token) {
                // SE RETORNAR O LOGIN, REDIRECIONAR PARA HOJE
                $_SESSION['token'] = $token;
                $this->redirect('/');
            } else {
                // SETA MENSAGEM DE ERRO E REENVIA PARA /login
                $_SESSION['flash'] = 'Email e/ou senha não conferem';
                $this->redirect('/login');
            }

        } else {
            $_SESSION['flash'] = 'Digite os campos de e-mail e/ou senha.';
            $this->redirect('/login');
        }
    }

    public function signup() {
        // TEM ALGUMA MENSAGEM DE FLASH?
        $flash = '';
        if(!empty($_SESSION['flash'])) {
            $flash = $_SESSION['flash'];
            $_SESSION['flash'] = '';
        }
        // RENDERIZAR LOGIN (ENVIANDO AVISO FLASH, SE HOUVER)
        $this->render('signup', [
            'flash'=>$flash
        ]);
    }

    public function signupAction() {
        $name = filter_input(INPUT_POST, 'name');
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $password = filter_input(INPUT_POST, 'password');
        $birthdate = filter_input(INPUT_POST, 'birthdate');

        // VALIDAR TODOS OS DADOS
        if($name && $email && $password && $birthdate) {

            // REVERTER PADRAO BRASILEIRO DE DATA
            $birthdate = explode('/', $birthdate);
            if(count($birthdate) != 3) {
                // CASO DATA INVALIDA, RETORNA ERRO E VOLTA PARA PAGINA CADASTRO
                $_SESSION['flash'] = 'Data de Nascimento Invalido';
                $this->redirect('/cadastro');
            }
            // SEPARAR BIRTHDATE POR ANO MES E DIA
            $birthdate = $birthdate[2].'-'.$birthdate[1].'-'.$birthdate[0];

            // CASO DATA INVALIDA, RETORNA ERRO E VOLTA PARA PAGINA CADASTRO
            if(strtotime($birthdate) === false){
                $_SESSION['flash'] = 'Data de Nascimento Invalido';
                $this->redirect('/cadastro');
            }

            // VERIFICAR SE HÁ ALGUM CADASTRO COM ESTE EMAIL
            if(LoginHandler::emailExists($email) === false) {
                // CASO NÃO EXISTA, ADICIONA OS DADOS NOME EMAIL SENHA E DATA NASCIMENTO
                $token = LoginHandler::addUser($name, $email, $password, $birthdate);
                $_SESSION['token'] = $token;
                // CASO EMAIL NÃO CONSTAR NO BD, REDIRECIONA PARA A PAGINA HOME
                $this->redirect('/');
            } else {
                // CASO EMAIL JÁ CONSTA NO BD, RETORNA ERRO E VOLTA PARA PAGINA CADASTRO
                $_SESSION['flash'] = 'Email já cadastrado';
                $this->redirect('/cadastro');
            }

        } else {
            // CASO NAO TENHA OS DADOS DO USUARIO, VOLTAR PARA CADASTRO
            $this->redirect('/cadastro');
        }
    }

}