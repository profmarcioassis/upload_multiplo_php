<style>
	.imagem {
		float: left;
		width: 20%;
		height: 300px;
		margin-left: 0%;
		margin-right: 3%;
		margin-top: 10%;
		text-align: right;
	}
</style>
<?php
include 'conexao.php';

$sql = "SELECT * FROM tbFile order by idFile desc";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
	while ($exibir = $result->fetch_assoc()) {
?>
		<div class="imagem">
			<a href="#" title="Excluir arquivo" onclick="confirmarExclusao('<?php echo $exibir["idFile"] ?>')" style="text-decoration: none;">X</a>
			<?php
			if ($exibir['extensaoFile'] != "pdf") {
			?>
				<img src="uploads/<?php echo $exibir['nameFile'] ?>" style="max-width: 100%; max-height: 100%;">
			<?php
			} else {
			?>
				<a href="uploads/<?php echo $exibir['nameFile'] ?>"><?php echo $exibir['nameFile'] ?></a>
			<?php
			}
			?>
		</div>
<?php
	}
} else {
	echo "Nenhum registro encontrado.";
}

$conn->close();
?>

<script>
	function confirmarExclusao(idFile) {
		if (window.confirm("Deseja realmente excluir o registro: \n" + idFile + "?")) {
			window.location = "excluirFile.php?idFile=" + idFile;
		}
	}
</script>