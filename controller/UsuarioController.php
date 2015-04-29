<?php
  include("../controller/dao/impl/UsuarioDaoImpl.php");
  include("../controller/funcoesController.php");

  function salvar() {
    if (trim($_POST["nome"]) == "") {
      throw new Exception("Nome de usuário não informado."); 
    }
    if (trim($_POST["login"]) == "") {
      throw new Exception("Login de usuário não informado."); 
    }
    if (trim($_POST["senha"]) == "") {
      throw new Exception("Senha de usuário não informada.");
    }
    if (trim($_POST["senhaRepetida"]) == "") {
      throw new Exception("Repita a senha para cadastrar.");
    }
    if ($_POST["senha"] != $_POST["senhaRepetida"]) {
      throw new Exception("Senhas não conferem.");
    }
    
    $usuario = new Usuario(0, $_POST["nome"], $_POST["login"], $_POST["senha"]);

    $usuarioDao = new UsuarioDaoImpl();
    
    if ($usuarioDao->buscar($usuario->getLogin()) != null) {
      throw new Exception('Usuário com login "'.$usuario->getLogin().'" já existe.');
    }
    $usuarioDao->salvar($usuario);
    
    redireMsg("../view/cadastrousuario.php", "Usuário cadastrado com sucesso.");
  }  
  
  function excluir($usuario)
  {
	  $usuarioDao = new UsuarioDaoImpl();
	  $usuarioDao->excluir($usuario);
  }
  
  function buscarUsuarios()
  {
	$usuarioDao = new UsuarioDaoImpl();
	return $usuarioDao->listar();
  }
  
  try {
    if ($_POST["operacao"] == "salvar") {
      salvar();
    } else if ($_POST["operacao"] == "excluir") {
		excluir($_POST["usuario"]);
		//echo "Usuário ".$_POST["usuario"]." removido com sucesso";
    } 
  } catch (Exception $e) {
    redireMsg("../view/cadastrousuario.php", "Erro: ".$e->getMessage());
  }
?>

