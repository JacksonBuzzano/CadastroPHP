<script src="js/jQuery.js"></script>
<script src="js/cidades.js"></script>
<!--formatar os campos data, cpf, cnpj telefone-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>

<h4>Cadastro</h4>
<a class="btn btn-primary" href="?pagina=home&action=add"> <i class="glyphicon glyphicon-plus"></i> Cadastrar</a>
<a class="btn btn-primary" href="?pagina=funcionario">Listar</a>
<hr>

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
		$nomeFun = addslashes($_POST['nomeFun']);
        $cpfFun = addslashes($_POST['cpfFun']);
        $nascimentoFun = addslashes($_POST['nascimentoFun']);
        $enderecoFun = addslashes($_POST['enderecoFun']);
        $numeroFun = addslashes($_POST['numeroFun']);
        $cidadeFun = addslashes($_POST['cidadeFun']);
        $estadoFun = addslashes($_POST['estadoFun']);
        $telefoneFun = addslashes($_POST['telefoneFun']);
		$funcaoFun = addslashes($_POST['funcaoFun']);
		$bd->query("INSERT INTO funcionário (nomeFun, cpfFun, nascimentoFun, enderecoFun, numeroFun, cidadeFun,
                estadoFun, telefoneFun, funcaoFun) VALUES 
                ('$nomeFun','$cpfFun','$nascimentoFun','$enderecoFun','$numeroFun','$cidadeFun', '$estadoFun',
                '$telefoneFun','$funcaoFun')");
		$action = '';
	}
	if($action == 'pesquisar')
	{
		$pesquisa = $_POST['pesquisa'];
		$bd->query("SELECT * FROM funcionário WHERE nomeFun LIKE '$pesquisa%' ORDER BY nomeFun ASC");
		?>
			<table class="table table-striped">		
				<thead>
					<tr>
						<th>Nome</th>
						<th>Cpf</th>
						<th>Nascimento</th>
						<th>Endereço</th>
						<th>N°</th>
						<th>Cidade</th>
						<th>Estado</th>
						<th>Telefone</th>
						<th>Função</th>
						<th align="center">Opções</th>
					</tr>
				</thead>
			<tbody>
		<?php
		foreach($bd->result() as $dados)
			{	
			?>
				<tr>
					<td><?php echo $dados['nomeFun']; ?></td>
					<td><?php echo $dados['cpfFun']; ?></td>
					<td><?php echo $dados['nascimentoFun']; ?></td>
					<td><?php echo $dados['enderecoFun']; ?></td>
					<td><?php echo $dados['numeroFun']; ?></td>
					<td><?php echo $dados['cidadeFun']; ?></td>
					<td><?php echo $dados['estadoFun']; ?></td>
					<td><?php echo $dados['telefoneFun']; ?></td>
					<td><?php echo $dados['funcaoFun']; ?></td>
					<td>
						<a class="btn btn-primary btn-lg" href="?action=edit&idFun=<?PHP echo $dados['idFun']; ?>"> <i class="glyphicon glyphicon-pencil"></i> </a>
						<a class="btn btn-danger btn-lg" href="?action=delete&idFun=<?PHP echo $dados['idFun']; ?>"> <i class="glyphicon  glyphicon-trash"></i> </a>
					</td>
				</tr>
			<?PHP
			}
			?>
			</tbody>
		</table>
		<?php	
	}
	
    if($action == 'update')
	{	
		$idFun = addslashes($_POST['idFun']);
		$nomeFun = addslashes($_POST['nomeFun']);
		$cpfFun = addslashes($_POST['cpfFun']);
		$nascimentoFun = addslashes($_POST['nascimentoFun']);
		$enderecoFun = addslashes($_POST['enderecoFun']);
		$numeroFun = addslashes($_POST['numeroFun']);
		$cidadeFun = addslashes($_POST['cidadeFun']);
		$estadoFun = addslashes($_POST['estadoFun']);
		$telefoneFun = addslashes($_POST['telefoneFun']);
		$funcaoFun = addslashes($_POST['funcaoFun']);
		$bd->query("UPDATE funcionário SET nomeFun='$nomeFun', cpfFun='$cpfFun', nascimentoFun='$nascimentoFun', enderecoFun='$enderecoFun',
			numeroFun='$numeroFun', cidadeFun='$cidadeFun', estadoFun='$estadoFun', telefoneFun='$telefoneFun', funcaoFun='$funcaoFun'
			WHERE idFun='$idFun'");
		$action ='';
    }
    
    if($action == 'add')
    {
		?>
        <form action="?action=insert" method="post"  name="form2" id="form2">
			<div class="form-row">
    			<div class="col-sm-10">
                    <label>Nome</label>
					<input type="text" name="nomeFun" class="form-control" id="Fun" required>
				</div>
    		</div>
			<div class="form-row">
				<div class="col-sm-5">
					<label>Telefone</label>
					<input type="text" name="telefoneFun" class="form-control" id="telefone" onkeypress="$(this).mask('(00) 0000-00009')" required>
					<label>CPF</label>
					<input type="text" name="cpfFun" class="form-control" id="cpf" onkeypress="$(this).mask('000.000.000-00')" required>
				</div>
			</div>
			<div class="form-row">
    			<div class="form-group col-md-3">
                    <label>Data Nascimento</label>
					<input type="text" name="nascimentoFun" class="form-control" id="nascimentoFun" onkeypress="$(this).mask('00/00/0000')"required>
				</div>
			</div>
			<div class="form-row">
				<div class="form-group col-md-5">
                    <label>Função</label>
                    <input type="text" name="funcaoFun" class="form-control" id="funcaofun" required>
                    <label>Endereço</label>
                    <input type="text" name="enderecoFun" class="form-control" id="enderecoFun" required>
				</div>
			</div>
			<div class="form-row">
				<div class="form-group col-md-2">
                    <label>N°</label>
                    <input type="number" name="numeroFun" class="form-control" id="numeroFun" required>
				</div>
			</div>
			<div class="form-row">
				<div class="form-group col-md-2">
                    <label>Estado</label>
                    <select id="estados" name="estadoFun" class="form-control" required>
                        <option value="">Selecione...</option>
                    </select>
              
                    <label for="cidadeFun">Cidades</label>
                        <select id="cidades" name="cidadeFun" class="form-control" required>
                            <option value="">Selecione...</option>
						</select>
				</div>
			</div> 
			<button type="submit" class="btn btn-primary">Salvar</button>
			<a href="?" class="btn btn-danger">Cancelar</a>
		</form>
	<?PHP
	}
	
	if($action == 'edit')
	{
		$idFun = $_GET['idFun'];
		$bd->query("SELECT *FROM funcionário WHERE idFun=$idFun");
		foreach($bd->result() as $dados)
		{
			?>
				<form action="?action=update" method="post"  name="form2" id="form2">
					<div class="form-row">
						<div class="col-sm-10">
							<input type="hidden" name="idFun" id="idFun" class="form-control" value="<?PHP echo $dados['idFun'];?>">
							<label>Nome</label>
							<input type="text" name="nomeFun" class="form-control" id="nomeFun" value="<?php echo $dados['nomeFun'];?>">
						</div>
					</div>
					<div class="form-row">
						<div class="col-sm-5">
							<label>Telefone</label>
							<input type="text" name="telefoneFun" class="form-control" id="telefoneFun"onkeypress="$(this).mask('(00) 0000-00000')" value="<?php echo $dados['telefoneFun'];?>">
							<label>CPF</label>
							<input type="text" name="cpfFun" class="form-control" id="cpfFun" onkeypress="$(this).mask('000.000.000-00')"value="<?php echo $dados['cpfFun'];?>">
						</div>
					</div>
					<div class="form-row">
						<div class="form-group col-md-3">
							<label>Data Nascimento</label>
							<input type="text" name="nascimentoFun" class="form-control" id="nascimentoFun" onkeypress="$(this).mask('00/00/0000')"  value="<?php echo $dados['nascimentoFun'];?>">
						</div>
					</div>
					<div class="form-row">
						<div class="form-group col-md-5">
							<label>Função</label>
							<input type="text" name="funcaoFun" class="form-control" id="funcaoFun" value="<?php echo $dados['funcaoFun'];?>">
							<label>Endereço</label>
							<input type="text" name="enderecoFun" class="form-control" id="enderecoFun" value="<?php echo $dados['enderecoFun'];?>">
						</div>
					</div>
					<div class="form-row">
						<div class="form-group col-md-2">
							<label>N°</label>
							<input type="number" name="numeroFun" class="form-control" id="numeroFun" value="<?php echo $dados['numeroFun'];?>">
						</div>
					</div>
					<div class="form-row">
						<div class="form-group col-md-2">
							<label>Estado</label>
							<input type="text" name="estadoFun" class="form-control" value="<?php echo $dados['estadoFun'];?>">
							<label>Cidade</label>
							<input type="text" name="cidadeFun" class="form-control" value="<?php echo $dados['cidadeFun'];?>">
						</div>
					</div> 
					<button type="submit" class="btn btn-success"><i class="glyphicon glyphicon-ok"></i>Salvar</button>
					<a href="?" class="btn btn-danger">Cancelar</a>
				</form>
			<?php
		}
	}
	
	if($action == 'delete')
	{
		$idFun = $_GET['idFun'];
		$bd->query("DELETE FROM funcionário WHERE idFun=$idFun");
		$action = '';
	}
    
    if($action == '')
	{	
		$qt_por_funcionario = 5;
		$sql = "SELECT * FROM funcionário ORDER BY nomeFun ASC";
		$bd->query($sql);
		$total = $bd->linhas();
		$fun = $total / $qt_por_funcionario;
		$pg = 1;
		if(isset($_GET['f']) && !empty($_GET['f']))
			{	
				$pg = $_GET['f'];
			}
		$f = ($pg - 1) * $qt_por_funcionario;
		$anterior = $pg - 1;
		$proximo = $pg + 1;

		$bd->query("$sql LIMIT $f,$qt_por_funcionario");
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
							<th>Nome</th>
                            <th>Cpf</th>
                            <th>Nascimento</th>
							<th>Endereço</th>
                            <th>N°</th>
                            <th>Cidade</th>
							<th>Estado</th>
                            <th>Telefone</th>
                            <th>Função</th>
							<th align="center">Opções</th>
						</tr>
					</thead>
					<tbody>
						<?PHP
						echo 'Total de registros encontrados: '.$bd->linhas().'<br><br>';
						foreach($bd->result() as $dados)
							{	
								?>
									<td><?php echo $dados['nomeFun']; ?></td>
									<td><?php echo $dados['cpfFun']; ?></td>
                                    <td><?php echo $dados['nascimentoFun']; ?></td>
                                    <td><?php echo $dados['enderecoFun']; ?></td>
                                    <td><?php echo $dados['numeroFun']; ?></td>
                                    <td><?php echo $dados['cidadeFun']; ?></td>
                                    <td><?php echo $dados['estadoFun']; ?></td>
                                    <td><?php echo $dados['telefoneFun']; ?></td>
                                    <td><?php echo $dados['funcaoFun']; ?></td>
									<td>
										<a class="btn btn-primary btn-lg" href="?action=edit&idFun=<?PHP echo $dados['idFun']; ?>"> <i class="glyphicon glyphicon-pencil"></i> </a>

										<a class="btn btn-danger btn-lg" href="?action=delete&idFun=<?PHP echo $dados['idFun']; ?>"> <i class="glyphicon  glyphicon-trash"></i> </a>
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
								<li><a href="?f=<?PHP echo $anterior; ?>"> <i class="glyphicon glyphicon-menu-left"></i> </a></li>
								<?PHP
							}
						if($fun > 1)
							{	
								for($i=1;$i<=$fun;$i++)
									{	
										if($pg == $i or $anterior < 0)
											{	
												$cor = 'class="active"';
											}
										else
											{	
												$cor = '';
											}
										?><li <?php echo $cor; ?>><a href="?f=<?PHP echo $i; ?>"> <?PHP echo $i; ?> </a></li><?PHP
									}
							}
						if($pg < $fun)
							{	
								?>
								<li><a href="?f=<?PHP echo $proximo; ?>"> <i class="glyphicon glyphicon-menu-right"></i> </a></li>
								<?PHP
							}
						?>
						
					</ul>
				</div>
				<?PHP
			}
	}
?>