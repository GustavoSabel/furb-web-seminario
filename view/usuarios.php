<!DOCTYPE html>
<html>
  <head>
	<meta charset="utf-8">
    <title>Usuários Cadastrados</title>
	<link rel="stylesheet" href="../Resources/Estilos.css">
	<script>
		function deletar(idUsuario)
		{
			var linha = document.getElementById("usuario-" + idUsuario);
			linha.parentNode.removeChild(linha);
			
			
			var xmlhttp;
			if (window.XMLHttpRequest)
			{// code for IE7+, Firefox, Chrome, Opera, Safari
				xmlhttp=new XMLHttpRequest();
			}
			else
			{// code for IE6, IE5
				xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			xmlhttp.onreadystatechange=function()
			{
				if (xmlhttp.readyState==4 && xmlhttp.status==200)
				{
					//document.getElementById("myDiv").innerHTML=xmlhttp.responseText;
					alert('Removido com sucesso:' + xmlhttp.responseText);
				}
			}
			xmlhttp.open("POST","../controller/UsuarioController.php",true);
			xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
			xmlhttp.send("operacao=excluir&usuario=" + idUsuario);
		}
	</script>
  </head>
  <body>
	<header>
		<div class="cabecalho">
			<h1>Usuários Cadastrados</h1><br>
		</div>
	</header>
	<nav>
		<ul class="navegacao">
			<li>
				<a class="link_img" href="../index.php">
					<img class="link_home" src="../Resources/Imagens/home-icon_white_64.png" alt="Home" />
				</a>
			</li>
			<li>
				<a class="link_texto" href="cadastrousuario.php">Cadastro de usuário</a>
			</li>
		</ul>
	</nav>
	<section>
		<div class="usuarios">
			<table>
				<thead>
					<th>
						Código
					</th>
					<th>
						Nome
					</th>
					<th>
						Login
					</th>
					<th>
						
					</th>
				</thead>
				<tbody>
					<?php
						include("../controller/dao/impl/UsuarioDaoImpl.php");
						
						$dao = new UsuarioDaoImpl();
						$resultado = $dao->listarTodos();
						while($usuario = mysql_fetch_array($resultado, MYSQL_NUM))
						{
							echo "<tr id='usuario-".$usuario[0]."'>";
							echo "<td width='100px'>";
								echo $usuario[0];
							echo "</td>";
							echo "<td>";
								echo $usuario[1];
							echo "</td>";
							echo "<td>";
								echo $usuario[2];
							echo "</td>";
							echo "<td width='16px'>
								<a href='#' onClick='deletar(". $usuario[0] .")'><img class='link_delete' src='../Resources/Imagens/delete.png' />
								</a></td>";
							echo "</tr>";
						}
					?>
				<tbody>
				
			</table>
		</div>
	</section>
	<footer>
		<span> All Rights Reserved. </span>
	</footer>
  </body>
</html>
 
