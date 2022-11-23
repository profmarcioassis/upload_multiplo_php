<?php
		include 'conexao.php';
             
		$sql = "SELECT * FROM tbimagem order by idImg desc";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
    		while ($exibir = $result->fetch_assoc()){
				?>
				<div class="exibir">
				<img src=uploads/<?phpecho $exibir["nameImg"]?>> 
				<a href="excluir.php">X</a>
				</div>
				<?php
            }         
		} 
		else {
    		echo "Nenhum registro encontrado.";
		}

		$con->close();
	?>