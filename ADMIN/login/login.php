<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

require '../INCLUDES/conectar.inc.php'; // Conexão com o banco de dados

$username = $password = "";
$username_err = $password_err = $login_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validação do nome de usuário
    if (empty(trim($_POST["username"]))) {
        $username_err = "Por favor, insira o nome de usuário.";
    } else {
        $username = trim($_POST["username"]);
    }

    // Validação da senha
    if (empty(trim($_POST["password"]))) {
        $password_err = "Por favor, insira a senha.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Validar credenciais apenas se não houver erros
    if (empty($username_err) && empty($password_err)) {
        $sql = "SELECT id, username, password FROM users WHERE username = ?";

        if ($stmt = mysqli_prepare($link, $sql)) {
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            $param_username = $username;

            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);

                if (mysqli_stmt_num_rows($stmt) == 1) {
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);

                    if (mysqli_stmt_fetch($stmt)) {
                        if (password_verify($password, $hashed_password)) {
                            // Armazenar variáveis de sessão e redirecionar
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;

                            header("location: welcome.php");
                            exit;
                        } else {
                            $login_err = "Usuário ou senha inválidos.";
                        }
                    }
                } else {
                    $login_err = "Usuário ou senha inválidos.";
                }
            } else {
                echo "Erro ao acessar o banco de dados. Tente novamente mais tarde.";
            }
            mysqli_stmt_close($stmt);
        }
    }

    mysqli_close($link);
}
