<?php
require_once '../model/db-connect.php';
require_once './includes/header.php';
session_start();
if (!isset($_SESSION['logado'])) header('Location: ../index.php');
$id = $_SESSION['id_usuario'];
$sql = "SELECT * FROM usuarios WHERE idusuario = '$id'";
$result = mysqli_query($connect, $sql);
$data = mysqli_fetch_array($result);
mysqli_close($connect);
$date = strtotime($data['created_at']);
$date = date('d/m/Y', $date);
?>
<div class="container">
    <div class="row">
        <div class="col s12">
            <h5 id="today" class="center"></h5>
            <h1 class="center">Olá <?php echo $data['nome']; ?></h1>
            <h6 class="center">Cadastrado desde: <?php echo $date; ?></h6>
            <div class="center">
                <a href="../controller/logout.php" class="waves-effect waves-light btn red"><i class="material-icons left">exit_to_app</i>Sair</a>
            </div>
        </div>
    </div>
</div>
<script src="./js/datetime.js" type="text/javascript"></script>
<?php
require_once './includes/footer.php';
?>