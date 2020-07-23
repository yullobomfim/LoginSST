<?php 

    Class usuarios{
        
    private $pdo;
    public $msgErro = "";

    public function conectar($nome, $host, $email, $senha){
        global $pdo;
        global $msgErro;

        try {
            $pdo = new PDO("mysql:dbname=".$nome."host=".$host, $email,$senha);
        }catch (PDOException $e) {
            echo "Erro com banco de dados";
            $msgErro = $e-> getMessage();
        }catch(Exception $e){
            echo "Erro genérico";
        }
    }
    public function cadastrar($nome, $telefone, $email, $senha){
        global $pdo;
        global $msgErro;

        /*verificar se já tem email cadastrado*/
        /* Selecione no banco de dados Usuarios, na coluna id_usuario, o valor email */
        $sql= $pdo->prepare("SELECT id_usuario FROM usuarios WHERE email = :e");
        $sql-> bindvalue(":e", $email);
        $sql->execute();
        if ($sql->rowCount()>0 ){
            return false;
        }else{
        /* Caso não esteja cadastrado, cadastrar*/
        $sql ->$PDO->prepare("INSERT INTO usuarios(nome, telefone, email, senha) VALUES (:n, :t, :u, :s)");
        $sql->bindValue(":n", $nome);
        $sql->bindValue(":t", $telefone);
        $sql->bindValue(":e", $email);
        $sql->bindValue(":s", md5($senha));
        $sql->execute();
        /**se estiver tudo ok */
        return true;
        }
    }
   
    public function logar($email, $senha){
        global $pdo;
        global $msgErro;

        /*verificar se o email e senha já estão cadastrados no banco de dados, se sim.. entrar no sistema*/
        /*entrar no sistema*/
        $sql->$pdo->prepare("SELECT id_usuario FROM usuarios WHERE email=:e AND senha=:s");
        $sql->bindValue(":e",$email);
        $sql->bindValue(":s",md5($senha));
        $sql->execute();
        if($sql->rouwCount()>0){

        /*Entrar no Sistema (Sessão) */
        $dado = $sql->fetch();
        session_start();
        $_SESSION['id_usuario'] = $dado['id_usuario'];
        return true;    /*Logado com Sucesso*/
        } else{
            return false;}   /*Não foi possivel realizar o login*/
        }
    }
?>
