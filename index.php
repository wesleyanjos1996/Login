<?php
require_once './model/db-connect.php';
session_start();
if(isset($_POST['btn-enter'])) {
    $error = [];
    $login = mysqli_escape_string($connect, $_POST['login']);
    $password = mysqli_escape_string($connect, $_POST['password']);
    if (empty($login) or empty($password)) {
        $error[] = '<li>O Campo Login/ Senha está vazio!</li>';
    } else {
        $sql = "SELECT login FROM usuarios WHERE login = '$login'";
        $result = mysqli_query($connect, $sql);
        if (mysqli_num_rows($result) > 0) {
            $password = md5($password);
            $sql = "SELECT * FROM usuarios WHERE login = '$login' AND senha = '$password'";
            $result = mysqli_query($connect, $sql);
            if (mysqli_num_rows($result) == 1) {
                $data = mysqli_fetch_array($result);
                mysqli_close($connect);
                $_SESSION['logado'] = true;
                $_SESSION['id_usuario'] = $data['idusuario'];
                header('Location: ./view/home.php');
            } else {
                $error[] = '<li>Usuário ou senha não conferem!</li>';
            }
        } else {
            $error[] = '<li>Usuário não encontrado!</li>';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema Login</title>
</head>
<body>
    <h1>Login</h1>
    <?php
        if (!empty($error)) {
            foreach ($error as $erro) {
                echo $erro;
            }
        }
    ?>
    <hr>
    <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
        Login:
        <input type="text" name="login">
        <br>
        Senha:
        <input type="password" name="password">
        <br>
        <button type="submit" name="btn-enter">Entrar</button>
    </form>
</body>
</html>