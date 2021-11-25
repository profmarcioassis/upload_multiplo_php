<?php
	//verifica se foi enviado algum valor (arquivo)
	if (isset($_POST["upload"])) {
		//recebe os valores enviados pelo formulário
		$file = $_FILES["file"];
		//permite debugar e ver o que foi enviado
		//var_dump($file);
		//conta quantas imagens foram enviadas
		$numFile = count(array_filter($file['name']));
		//define qual pasta a imagem será salva
		$folder = "uploads";
		/*
		define os tipos suportados de arquivos enviados
		apesar de o exemplo estar mais voltado para imagem, 
		pode usar para outros tipos de arquivos também
		*/
		$permite = array("tif", "jpg", "jpeg", "png", "pdf");
		$maxSize = 1024 * 1024 * 5;
		//Mensagens
		$msg = array(); //cria um array vazio
		//cria um array e já atribui valores das mensagens a ele.
		$erroMsg = array( 
			1 =>"O arquivo é maior que o limite definido no max_filesize",
			2 => "O aquivo ultrapassa o limite de tamanho permitido no MAX_FILE_SIZE",
			3 => "O upload do arquivo foi feito parcialmente",
			4 => "Não foi feito o upload do arquivo"
			);

			for ($i=0; $i < $numFile; $i++) { 
				$name = $file["name"][$i]; //pega o nome do arquivo
				$type = $file["type"][$i]; //pega o tipo do arquivo
				$size = $file["size"][$i]; //pega o tamanho do arquivo
				$error = $file["error"][$i]; //pega os erros
				$tmp = $file["tmp_name"][$i]; //pega o nome temporário do arquivo quando ele está sendo passado do cliente para o servidor
				//echo "Nome da imagem: $tmp";
				//pega a largura e a altura da imagem (resolução)
				//list($largura, $altura) = getimagesize($tmp);
				//echo "<br>Largura: $largura, altura: $altura<br>";
				
				$extensao = @end(explode(".", $name)); //pega extensão de cada arquivo
				//echo $extensao."<BR>";
				//var_dump($extensao); //para debugar e ver se está pegando a extensão dos arquivos

				$novoNome = rand() . ".$extensao"; //gerando um novo nome para os arquivos

				//abaixo estamos tratando as mensagens a serem exibidas para o usuário, em casos de erro ou sucesso no upload
				if ($error != 0) { //se não houver erro ao carregar a imagem
					$msg[] = "<b>$name: </b>".$erroMsg[$error];
				} else if(!in_array($extensao, $permite)) {
					$msg[] = "<b>$name: </b> Erro - Tipo de arquivo não suportado. Escolha arquivo do tipo .tif, .jpg, .jpeg e .png";
				} else if ($size > $maxSize) {
					$msg[] = "<b>$name: </b>Erro - Tamanho do arquivo é maior que o permitido.";
				} else {
					//move o arquivo para a pasta definida 
					if (move_uploaded_file($tmp, $folder."/".$novoNome)) { 
						//trecho para gravar a imagem na pasta e para gravar os dados na pasta da imagem no banco de dados
						include "conexao.php"; //inclui o arquivo de conexão com o banco de dados
						//define o comando sql para inserção do nome da imagem no banco de dados
						$SQL = "INSERT INTO tbFile (nameFile, extensaoFile) VALUES ('".$novoNome."','".$extensao."')";
						if ($conn->query($SQL) === TRUE){ //verifica se o comando foi executado com sucesso
							$msg[] = "<b>$name: </b> Upload realizado com sucesso.";
						} 
						else{
							//mensagem exibida caso ocorra algum erro na execução do comando sql
							$msg[] = "<b>$name: </b> Erro - ".$conn->error;
						}				
					} else {
						$msg[] = "<b>$name: </b> Desculpe! Ocorreu um erro ao fazer upload do arquivo.";
					}
				} 
			}
			//var_dump($msg); //para debugar e ver o conteúdo da variável $msg
			foreach ($msg as $mensagem) {
				echo $mensagem."<br>";
			}
			header("Location: index.php");
	}
