<?php 
    require_once "conexao.php";
    session_start();

    if (isset($_POST["login"])){
        $login = $_POST["login"];
        $senha = $_POST["senha"];
        if ((trim($login) =="") || (trim($senha) == ""))
            $mensagem = "login/Senha devem ser preenchidos";
        else{
            //$sql ="select login, senha from usuario where login = '$login'";
            $resul = $conn->query("select login, senha from usuario where login = '$login'"); 
            //$result = mysqli_query($sql,$conn);
            if ($row = mysqli_fetch_assoc($resul)){
                if($row["senha"] == $senha){
                    //login realizado com sucesso,salvamos a sessão
                    $_SESSION["login"] == $login;
                    //redirecionamos para a pagina que lista os veiculos cadastrados
                    header("location:veiculoLista.php");
                }
                else $mensagem = "Senha incorreta";
            }
            else $mensagem = " login não encontrado";
        }
    }
?>
<html>
<head>
    <title>Locadora-login</title>
</head>
<body>
    <p>para acessar o sistema, entre com seu login e senha </p>
    <font color="red"><?php if (isset ($mensagem)) echo $mensagem;?></font>
    <form name="flogin" method="post" action="login.php">
        <label>Login</label><br>
        <input name="login" type="text" size="12" maxlength="12" value=""><br>
        <label>Senha</label><br>
        <input name="senha" type="password" size="12" maxlength="12" value=""><br>
        <input name="op" type="hidden" value="logar">
        <input type="submit" value="Enviar"/>
    </form>
</body>
</html>
