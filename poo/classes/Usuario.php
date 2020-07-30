<?php
class Usuario{
    private $id;
    private $nome;
    private $email;
    private $senha;

    //-------------------------------------------index
    public function index(){
        if(!isset($_SESSION['id'])){
            $this->login();
        }
        else{
            $this->listar();
        }
    }


    //-------------------------------------------listar
    public function listar(){
        $conexao=Conexao::getConexao();
        $resultado=$conexao->query(
            "SELECT id, nome, email FROM usuario"
        );
        $usuarios=null;
        while($usuario=$resultado->fetch(PDO::FETCH_OBJ)){
            $usuarios[]=$usuario;
        }
        include HOME_DIR."view/paginas/usuarios/listar.php";
    }


    //-------------------------------------------cadastro
    public function criar(){
        include HOME_DIR."view/paginas/usuarios/form_usuario.php";
    }

    public function salvar(){
        if(isset($_POST["enviar"])){
            /*testa se é novo usuário*/
            if(empty($_POST["id"])){
                $this->setNome($_POST["nome"]);
                $this->setEmail($_POST["email"]);
                $senhaForm = "info63a";
                $this->setSenha($senhaForm);

                //salva no bd pela classe conexao
                $conexao=Conexao::getConexao();
                $sql="INSERT INTO usuario (nome, email, senha) VALUES ('".$this->getNome()."', '".$this->getEmail()."', '".$this->getSenha()."')";
                $conexao->query($sql);

                //mensagem se deu certo (usuário salvo no bd)
                $sql = $conexao->query("
                SELECT id
                FROM usuario
                WHERE email = '".$this->getEmail()."' AND nome = '".$this->getNome()."' AND senha = '".$this->getSenha()."'"
                );
                $result = $sql->fetch(PDO::FETCH_ASSOC);
                if(is_string($result['id'])){
                    echo "<h2>Novo usuário salvo com sucesso!</h2>";
                }
                else{
                    echo "<h2>Falha ao salvar novo usuário!</h2>";
                }
                //recarregar página
                $this->login();
            }else{
                $sql="UPDATE usuario SET nome=".$_POST["nome"].", email=".$_POST["email"];
            }
        }
    }


    //----------------------------------------------------login
    public function login(){
        include HOME_DIR."view/paginas/usuarios/login.php";
    }

    public function entrar(){
        if(isset($_POST["enviar"])){
            $this->setSenha(md5($_POST["senha"]));
            $this->setEmail($_POST["email"]);

            //conecta e procura se há conta com os dados
            $conexao=Conexao::getConexao();
            $sql = $conexao->query("
                SELECT *
                FROM usuario
                WHERE email = '".$this->getEmail()."' AND senha = '".$this->getSenha()."'"
            );
            $result = $sql->fetch(PDO::FETCH_ASSOC);
            
            //se há conta
            if(isset($result['id']) && isset($result['nome']) && isset($result['senha']) && isset($result['email'])){
                //cria sessão se não existir outra
                if(!isset($_SESSION['id'])){
                    $this->session($result['id'], $result['nome'], $result['senha'], $result['email']);
                }
                else{
                    session_unset();
                    session_destroy();
                    $this->session($result['id'], $result['nome'], $result['senha'], $result['email']);
                }
            }
            else{
                echo "<h2>Dados repassados inválidos!</h2>";
                $this->login();
            }
        }
    }

    public function session($id, $nome, $email, $senha){
        $_SESSION['id'] = $id;
        $_SESSION['nome'] = $nome;
        $_SESSION['email'] = $email;
        $_SESSION['senha'] = $senha;
        echo "<h2>Logado!</h2>";
        $this->listar();
    }


    //-------------------------------------------------editar
    public function edit(){
        if(!isset($_SESSION['id'])){
            $this->login();
        }
        else{
            include HOME_DIR."view/paginas/usuarios/editar.php";
        }
    }

    public function update(){
        if(isset($_POST["enviar"])){
            $this->setSenha(md5($_POST["senha"]));
            $this->setEmail($_POST["email"]);
            $this->setNome($_POST["nome"]);

            $conexao=Conexao::getConexao();
            $conexao->query("
                UPDATE usuario
                SET nome = '".$this->getNome()."', email = '".$this->getEmail()."', senha = '".$this->getSenha()."'
                WHERE id = '".$_SESSION['id']."'"
            );
            
            $_SESSION['senha'] = md5($_POST["senha"]);
            $_SESSION['email'] = $_POST["email"];
            $_SESSION['nome'] = $_POST["nome"];
            
            echo "<h2>Usuário atualizado com sucesso!</h2>";
            $this->listar();
        }
    }


    //-----------------------------------------------------------------mostrar dados
    public function dados(){
        if(!isset($_SESSION['id'])){
            $this->login();
        }
        else{
            include HOME_DIR."view/paginas/usuarios/dados.php";
        }
    }


    //-----------------------------------------------------------------sair
    public function sair(){
        if(!isset($_SESSION['id'])){
            $this->login();
        }
        else{
            session_unset();
            session_destroy();
            echo "<h2>Deslogado!</h2>";
            include HOME_DIR."view/paginas/usuarios/login.php";
        }
    }


    //--------------------------------------------------------------------deletar conta
    public function delete(){
        if(!isset($_SESSION['id'])){
            $this->login();
        }
        else{
            $conexao=Conexao::getConexao();
            $conexao->query("
                DELETE FROM usuario
                WHERE id = '".$_SESSION['id']."'"
            );
            session_unset();
            session_destroy();
            echo "<h2>Conta deletada!</h2>";
            include HOME_DIR."view/paginas/usuarios/login.php";
        }
    }


    //-------------------------------------------------------------GETTERS & SETTERS
    public function setId($id){
        $this->id=$id;
    }
    public function getId(){
        return $this->id;
    }
    public function setNome($nome){
        $this->nome=$nome;
    }
    
    public function getNome(){
        return $this->nome;
    }

    public function setEmail($email){
        $this->email=$email;
    }
    
    public function getEmail(){
        return $this->email;
    }

    public function setSenha($senha){
        $this->senha=$senha;
    }
    
    public function getSenha(){
        return $this->senha;
    }

    public function logout(){
        
    }

    public function autenticar(){
      
        
    }
}