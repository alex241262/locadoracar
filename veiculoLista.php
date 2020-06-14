<?php require_once "autenticacao.php"; ?>
<html>
<head>
    <title>Veículos - Lista</title>
</head>
<body>
    <p>lista de veículos</p>
    <a href="veiculo.php">Novo veículo</a>
    <a href="sair.php">Sair</a>
    <br><br>
    <?php 
    require_once "conexao.php";
    
            //$sql = "select id, nome, tipo from veiculo order by nome";
            //$resul = mysqli_query($sql,$conn);
			$resul = $conn->query("select login, senha from usuario where login = '$login'");
            $linhas = mysqli_num_rows($result);
        if ($linhas < 1){
            echo "Nome regitro encontrado!";
        }else{?>
                <table width="300" border="1">
                    <tr>
                        <th>Código</th>
                        <th>Nome</th>
                        <th>Tipo</th>
                        <th>Abrir</th>
                    </tr>
                    <?php while ($row = mysqli_fetch_assoc($resul)){
                        estract ($row);?>
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
                            }?>
                            </td>
                            <td><a href="veiculo.php?op=abrir&id=<?php echo $id;?>">Abrir</a></td>
                        </tr>
					<?php}?>
                        </table>
		<?php}?>
</body>
</html>