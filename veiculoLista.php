<?php require_once "autenticacao.php";//verifica se esta autenticado?>
<html>
<head>
    <title>Veículos - Lista</title>
</head>
<body>
    <p>Lista de veículos</p>
    <a href="veiculo.php">Novo veículo</a>
    <a href="sair.php">Sair</a>
    <br><br>
				<?php 
					require_once "conexao.php";
					$resul = $conn->query("select id,nome,tipo from veiculo order by nome");
            $linhas = mysqli_num_rows($resul);
        if ($linhas < 1){
            echo "Nenhum regitro encontrado!";
        }else{?>
                <table width="400" border="1" >
                    <tr>
                        <th>Código</th>
                        <th>Nome</th>
                        <th>Tipo</th>
                        <th>Abrir</th>
                    </tr>
                    <?php while ($row = mysqli_fetch_assoc($resul)){
                        extract ($row);?>
                        <tr>
                            <td><?php echo $id; ?></td>
                            <td><?php echo $nome; ?></td>
                            <td><?php switch ($tipo){
                                case 1:
                                    echo "Básico";
                                    break;
                                case 2:
                                    echo "Básico com opcionais";
                                break;
                            } ?>
                            </td>
                            <td><a href="veiculo.php?op=abrir&id=<?php echo $id;?>">Abrir</a></td>
                        </tr>
						<?php } ?>
                        </table>
			<?php } ?>  
</body>
</html>