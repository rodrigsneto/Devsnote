<?php
namespace src\handlers;

use \src\models\User;

class LoginHandler {

    // CHECAR SE HÁ UM LOGIN
    public static function checkLogin() {
        // SE EXISTIR E ESTIVER PREENCHIDA O DADO 'token' no array $_SESSION
        if(!empty($_SESSION['token'])) {
            // PEGA O VALOR 'token' do $_SESSION
            $token = $_SESSION['token'];
            // PEGAR OS DADOS DO usuario REFERENTE AO token
            $data = User::select()->where('token', $token)->one();

            if($data) {
                // CASO $data TENHA RECEBIDO UM USUARIO

                if (count($data) > 0) {
                    $loggedUser = new User();
                    $loggedUser->id = ($data['id']);
                    $loggedUser->name = ($data['name']);
                    $loggedUser->avatar = ($data['avatar']);

                    // RETORNAR A CLASSE $loggedUser com os dados do usuario
                    return $loggedUser;
                }
            } else {
                // SE O VALOR $data NAO TIVER RETORNADO NENHUM VALOR...RETORNA FALSO
                return false;
            }

        }
        // SE NÃO EXISTIR E NAO ESTIVER VAZIA O DADO 'token' no array $_SESSION, RETORNA false
        return false;
    }

    // VALIDAR O LOGIN VERIFICANDO email E senha
    public static function verifyLogin($email, $password) {
        // COLETAR email E TRAZER DADOS DO USUARIO
        $user = User::select()->where('email', $email)->one();

        if($user) {
            // VERIFICAR SE $password QUE RECEBEMOS COM GET BATE COM O ['password'] DO BD
            if(password_verify($password, $user['password'])) {
                // GERAR UM TOKEN DE LOGIN PARA O USUARIO
                $token = md5(time().rand(0,9999).time());

                User::update()
                    ->set('token', $token)
                    ->where('email', $email)
                    ->execute();

                return $token;
            }
        }

        return false;
    }

    public static function emailExists($email) {
        $user = User::select()->where('email', $email)->one();
        return $user ? true : false;
    }

    public static function addUser($name, $email, $password, $birthdate) {
        // GERAR UM HASH PARA O PASSWORD
        $hash = password_hash($password, PASSWORD_DEFAULT);
        // GERA UM TOKEN PARA O USUARIO
        $token = md5(time().rand(0,9999).time());

        User::insert([
            'email' => $email,
            'password' => $hash,
            'name' => $name,
            'birthdate' => $birthdate,
            'token' => $token
        ])->execute();

        return $token;
    }

}










