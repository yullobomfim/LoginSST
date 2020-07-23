<?php
    require_once 'Classes/Usuarios.php'
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Usuários</title>
    <link rel="stylesheet" href="CSS/estilo.css">
</head>

<body>
    <div id="corpo-form-cad">
        <h1>Sistema de Gestão em Segurança do Trabalho</h1>
        <form method="POST">
            <input type="text" name="nome" placeholder="Nome Completo" maxlength="30">
            <input type="text" name="telefone" placeholder="Telefone">
            <input type="email" name="email" placeholder="Usuário">
            <input type="password" name="senha" placeholder="Senha">
            <input type="password" name="confSenha" placeholder="Confirmar Senha">
            <input type="submit" value="CADASTRAR">
            <a href="index.php"> <strong> Já sou cadastrado</strong> </a>
        </form>
    </div>
    
<?php       
    /* Post - Action do php*/   
    /* ISSET VERIFICA AS VARIAVEIS DO POST*/ 
    /* addslashes melhora a segurança do acesso as variaveis*/
    /* usar o if para verificar se todos os campos estão preenchidos*/
    
    if(isset($_POST['nome'])) 
        $nome = addslashes ($_POST['nome']);
        $telefone = addslashes ($_POST['telefone']);
        $email = addslashes ($_POST['email']);
        $senha = addslashes ($_POST['senha']);
        $confirmarSenha = addslashes ($_POST['confSenha']);
    
    if(!empty($nome) && !empty($telefone) && !empty($email) && !empty($senha) && !empty($confirmarSenha))
    {
    $u-> conectar("usuarios", "localhost", "root", "");
    /** (BancoDados,host,email,senha) */
    
    /**ANTES DE ENVIAR A SOLICITACAO DE CADASTRO , verificar se a senha e confirmar senha estao iguais. */
    
    if($msgErro == "") /**esta tudo certo */
    {           
        if ($senha == $confirmarSenha)
        # teste para ver se senha e confirmarSenha estao iguais, se sim..continuar
        {
            if($u->cadastrar($nome,$telefone,$email,$senha))
            {
?>
    <div id="msg-Sucesso">
    Cadastrado com Sucesso, Acesse para Entrar.;
    </div>
<?php
        }else{
?>
    <div id="msg-Erro">
    Email já Cadastrado.;
    </div>
<?php    
    }
        }else{
?>
    <div id="msg-Erro">
    Senha e confirmar senha não correspondem.;
    </div>
<?php    
        }
    }else{
?>
    <div id="msg-Erro">
    echo "Erro: ".$u->msgErro;
    echo "Preencha todos os campos";
    </div>
<?php    
    }
    }     
?>

</body>
</html>