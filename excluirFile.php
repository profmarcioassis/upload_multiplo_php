<?php
require_once("conexao.php");
if (isset($_GET["idFile"])) {
    $idFile = $_GET["idFile"];

    // $sqlSelect = "SELECT * from tbFile where idFile = $idFile";
    // $dados = $conn->query($sqlSelect);
    // $exibir = $dados->fetch_assoc();
    // $arquivo = "uploads/".$exibir["nameFile"];
    //echo $arquivo;
    $sqlDelete = "DELETE FROM tbfile WHERE idFile = $idFile";

    if ($conn->query($sqlDelete) === TRUE) {
        //if(file_exists($exibir["nameFile"])){
            //unlink($arquivo);
            //}
?>
        <script>
            alert("Registro excluído com sucesso.");
            //window.location = "index.php";
        </script>

    <?php

    } else {
    ?>
        <script>
            alert("Erro ao excluir o registro.");
            window.history.back();
        </script>
<?php

    }
}
?>