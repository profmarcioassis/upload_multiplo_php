<?php
require_once("conexao.php");
if (isset($_GET["idFile"])) {
    $idFile = $_GET["idFile"];
    $sqlDelete = "DELETE FROM tbfile WHERE idFile = $idFile";

    if ($conn->query($sqlDelete) === TRUE) {
?>
<script>
    alert("Registro excluído com sucesso.");
    window.location = "index.php";
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