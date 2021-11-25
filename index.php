<!DOCTYPE html>
<html lang="pt-br">

<head>
	<meta charset="utf-8">
	<title>Upload múltiplo com PHP</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<style>
		body{
			margin: 0px;
			padding: 0px;
		}

		.container {
			width: 100%;
		}

		.entrada {
			padding: 5px;
		}

		.saida{
			padding: 5px;
			width: 100%;
		}

		

	</style>
</head>

<body>
	<div class="container">
		<div class="entrada">
			<h1>Upload de imagens</h1>
			<?php include_once("upload.php"); ?>
			<form action="" method="post" enctype="multipart/form-data">
				<label for="file">Selecione os arquivos</label>
				<input type="file" name="file[]" multiple required>
				<br>
				<input type="submit" name="upload" value="Salvar">
			</form>
		</div>
		<div class="saida">
			<h2>Imagens cadastradas</h2>
			<?php include_once("exibirFile.php"); ?>
		</div>
	</div>
</body>

</html>