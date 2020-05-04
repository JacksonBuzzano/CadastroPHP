<h4>Cadastro</h4>
<a class="btn btn-primary" href="?pagina=home&action=add"> <i class="glyphicon glyphicon-plus"></i> Cadastrar</a>
<a class="btn btn-primary" href="?pagina=home">Listar</a> <br><br>



<form action="?action=pesquisar" method="post">
	<label>Pesquisar</label>
	<div class="form-group col-md-5">
		<input type="text" name="pesquisa" class="form-control">
	</div>
	<button type="submit" class="btn btn-primary"> <i class="glyphicon glyphicon-search"></i> Pesquisar </button>
</form>
<hr>

<?php 
$action = '';
if(!empty($_GET['action']))
	{	
		$action = $_GET['action'];
	}
if($action == 'insert')
	{	
		$nomeUsuario = addslashes($_POST['nomeUsuario']);
		$senhaUsuario = addslashes($_POST['senhaUsuario']);
		$bd->query("INSERT INTO usuários (nomeUsuario,senhaUsuario) VALUES ('$nomeUsuario','$senhaUsuario')");
		$action = '';
	}
	
if($action == 'pesquisar')
	{
		$pesquisa = $_POST['pesquisa'];
		$bd->query("SELECT * FROM usuários WHERE nomeUsuario LIKE '$pesquisa%' ORDER BY nomeUsuario ASC");
		?>
		<table class="table table-striped">
		<tbody>
			<thead>
				<tr>
					<th>ID</th>
					<th>Nome</th>
					<th>Senha</th>
					<th align="center">Opções</th>
				</tr>
			</thead>
		<?php
		foreach($bd->result() as $dados)
		{
		?>
			<tr>
				<td><?php echo $dados['idUsuario']?></td>
				<td><?php echo $dados['nomeUsuario']?></td>
				<td><?php echo $dados['senhaUsuario']?></td>
				<td>
					<a class="btn btn-primary btn-lg" href="?action=edit&idUsuario=<?PHP echo $dados['idUsuario']; ?>"> <i class="glyphicon glyphicon-pencil"></i> </a>
					<a class="btn btn-danger btn-lg" href="?action=delete&idUsuario=<?PHP echo $dados['idUsuario']; ?>"> <i class="glyphicon  glyphicon-trash"></i> </a>
				</td>
			</tr>
		<?php
		}
		?>
		</tbody>
		</table>
		<?php
	}

if($action == 'update')
	{	
		$idUsuario = addslashes($_POST['idUsuario']);
		$nomeUsuario = addslashes($_POST['nomeUsuario']);
		$senhaUsuario = addslashes($_POST['senhaUsuario']);
		$bd->query("UPDATE usuários SET nomeUsuario='$nomeUsuario',senhaUsuario='$senhaUsuario' WHERE idUsuario=$idUsuario");
		$action = '';
	}
if($action == 'add')
	{	
		?>
		<form action="?action=insert" method="post" name="form1" class="form"
			<label>Nome</label>
			<input type="text" name="nomeUsuario" id="nomeUsuario" class="form-control">
			<label>Senha</label>
			<input type="password" name="senhaUsuario" id="senhaUsuario" class="form-control">
			<br>
			<button type="submit" class="btn btn-success"> <i class="glyphicon glyphicon-ok"></i> Salvar</button>
			<a class="btn btn-default" href="?">Cancelar</a>
		</form>
		<?PHP
	}
if($action == 'edit')
	{	
		$idUsuario = $_GET['idUsuario'];
		$bd->query("SELECT *FROM usuários WHERE idUsuario=$idUsuario");
		foreach($bd->result() as $dados)
			{	
				?>
				<form action="?action=update" method="post" name="form1" id="form1"> 
					<input type="hidden" name="idUsuario" id="idUsuario" class="form-control" value="<?PHP echo $dados['idUsuario']; ?>">
					<label>Nome</label>
					<input type="text" name="nomeUsuario" id="nomeUsuario" class="form-control" value="<?PHP echo $dados['nomeUsuario']; ?>">
					<label>Senha</label>
					<input type="password" name="senhaUsuario" id="senhaUsuario" class="form-control" value="<?PHP echo $dados['senhaUsuario']; ?>">
					<br>
					<button type="submit" class="btn btn-success"> <i class="glyphicon glyphicon-ok"></i> Salvar</button>
					<a class="btn btn-danger" href="?">Cancelar</a>
				</form>
				<?PHP
			}
	}

if($action == 'delete')
	{	
		$idUsuario = $_GET['idUsuario'];
		$bd->query("DELETE FROM usuários WHERE idUsuario=$idUsuario");
		$action = '';
	}
if($action == '')
	{	
		$qt_por_usuario = 5;
		$sql = "SELECT * FROM usuários ORDER BY nomeUsuario ASC";
		$bd->query($sql);
		$total = $bd->linhas();
		$usua = $total / $qt_por_usuario;
		$pg = 1;
		if(isset($_GET['u']) && !empty($_GET['u']))
			{	
				$pg = $_GET['u'];
			}
		$u = ($pg - 1) * $qt_por_usuario;
		$anterior = $pg - 1;
		$proximo = $pg + 1;

		$bd->query("$sql LIMIT $u,$qt_por_usuario");
		if($total == '')
			{	
				echo 'Nenhum resultado encontrado';
			}
		else
			{
				?>
				<table class="table table-striped">
					<thead>
						<tr>
							<th>ID</th>
							<th>Nome</th>
							<th>Senha</th>
							<th align="center">Opções</th>
						</tr>
					</thead>
					<tbody>
						<?PHP
						echo 'Total de registros encontrados: '.$bd->linhas().'<br><br>';
						foreach($bd->result() as $dados)
							{	
								?>
								<tr>
									<td><?php echo $dados['idUsuario']; ?></td>
									<td><?php echo $dados['nomeUsuario']; ?></td>
									<td><?php echo $dados['senhaUsuario']; ?></td>
									<td>
										<a class="btn btn-primary btn-lg" href="?action=edit&idUsuario=<?PHP echo $dados['idUsuario']; ?>"> <i class="glyphicon glyphicon-pencil"></i> </a>

										<a class="btn btn-danger btn-lg" href="?action=delete&idUsuario=<?PHP echo $dados['idUsuario']; ?>"> <i class="glyphicon  glyphicon-trash"></i> </a>
									</td>
								</tr>
								<?PHP
							}	
						?>
					</tbody>
				</table>

				<div class="text-center">
					<ul class="pagination pagination-sm">
						<?php 
						if($pg > 1)
							{	
								?>
								<li><a href="?u=<?PHP echo $anterior; ?>"> <i class="glyphicon glyphicon-menu-left"></i> </a></li>
								<?PHP
							}
						if($usua > 1)
							{	
								for($i=1;$i<=$usua;$i++)
									{	
										if($pg == $i or $anterior < 0)
											{	
												$cor = 'class="active"';
											}
										else
											{	
												$cor = '';
											}
										?><li <?php echo $cor; ?>><a href="?u=<?PHP echo $i; ?>"> <?PHP echo $i; ?> </a></li><?PHP
									}
							}
						if($pg < $usua)
							{	
								?>
								<li><a href="?u=<?PHP echo $proximo; ?>"> <i class="glyphicon glyphicon-menu-right"></i> </a></li>
								<?PHP
							}
						?>
						
					</ul>
				</div>
				<?PHP
			}
	}

?>
