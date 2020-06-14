<?php
    require_once "autenticacao.php";
    require_once "conexao.php";

    $op = "novo";
    if (isset($GET["op"])){
        $op = "abrir";        
    }elseif (isset($_POST["op"])){
        $op = $_POST["op"];
    }
    
    if (isset($_POST["excluir"])){
        //excluir
        $id = $_POST["id"];
        $sql = " delete from veiculo where id=$id";
        $result = mysqli_query($sql,$conn);
        if ($result){
            header ("location:veiculoListaphp");
            exit;
        }else $mensagem = "Não foi possivel excluir";
        
    }else{
        if($op == "novo"){
            //inicializa variaveis
            $nome ="";
            $tipo ="";
        }elseif($op == "cadastrar"){
            //cadastrar
            $nome = trim($_POST["nome"]);
            $tipo = $_POST["tipo"];
            if($nome == ""){
                $mensagem =" O campo nome deve ser preenchido";
            }else{
                $sql = " insert into veiculo (nome,tipo) values ($nome,$tipo)";
                $result = mysqli_query($ql,$conn);
                    if($result){
                        header("location:veiculoLista.php");
                        exit;
                    }else $mensagem = "Não foi possivel cadatar. Verifique os dados!";
            }
        }elseif($op == "abrir"){
            //abrir
            $op = "atualizar";
            $id = $_GET["id"];
            $sql = " select nome,tipo from veiculo where id = $id";
            $result = mysqli_query($sql,$conn);
            $row = mysqli_fetch_assoc($rsult);
            extract($row);//o campo nome da tabela é extraido para a variavel $nome...
        }elseif($op == "atualizar"){
            //recuperando valores do post
            $id = $_POST["id"];
            $nome = trim($_POST["nome"]);
            $tipo = $_POST["tipo"];
            if ($nome == ""){
                $mensagem = "O campo nome deve ser preenchido";
            }else{
                $sql = "update veiculo set nome='$nome',tipo='$tipo'";
                $result = mysqli_query($sql,$conn);
                if($result){
                    header("location:veiculolista.php");
                    exit;
                }else $mensagem ="Não foi possivel atualizar,verifique os dados!";
            }
        }
    }
?>
<html>
<head>
    <title>Veículo - Vadastro</title>
</head>
<body>
    <p>Cadastro de veículo</p>
    <font color="red"><?php if (isset($mensagem))echo $mensagem;?></font>
    <form name="fveiculo" methodo="post" action="veiculo.ph">
        <label>Nome</label<br>
        <input name="nome" type="text" value="<?php echo $nome;?>"size="45" maxlength="45"><br>
        <label>Tipo</label<br>
        <select name="tipo" size=1>
        <option value="1" <?php if ($tipo == 1) echo " selected";?>>Basico</option>
        <option value="2" <?php if ($tipo == 2) echo " selected";?>>Basico com opcionais</option>
        </select><br>
        <?php if ($op != "cadastrar"){?>
            <input typr="checkbox" name="excluir" value="excluir">Excluir<br><?php
        }?>
        <?php if ($op == "atualizar"){?>
            <input type="hidden" name="id" value="<?php echo $id ?>">
        <?php}?>
        <input type="hidden"name="op" value="<?php echo $op ?>">
        <input type="submit" value="Enviar">
        <a href="javascript:void(null);" onclick="location.href='veiculoLista.php';">Voltar</a>
    </form>
</body>
</html>        