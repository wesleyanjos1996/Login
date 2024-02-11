<?php
require_once './model/db-connect.php';
require_once './view/includes/header.php';
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
<div class="container">
    <div class="row">
        <div class="col s12">
            <h1 class="center">Login</h1>
            <?php
                if (!empty($error)) {
                    foreach ($error as $erro) {
                        echo $erro;
                    }
                }
            ?>
            <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post" class="col s12">
                <div class="row">
                    <div class="input-field col s12 m6">
                        <input type="text" name="login" id="login" autocomplete="username" class="validate">
                        <label for="login">Usuário</label>
                    </div>
                    <div class="input-field col s12 m6">
                        <input type="password" name="password" id="password" autocomplete="current-password" class="validate">
                        <label for="password">Senha</label>
                    </div>
                </div>
                <button type="submit" name="btn-enter" class="btn-large z-depth-2 center">Entrar</button>
            </form>
        </div>
    </div>
</div>
<?php
require_once './view/includes/footer.php';
?>