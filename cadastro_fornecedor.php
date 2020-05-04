<script src="js/jQuery.js"></script>
<script src="js/cidades.js"></script>
<!--formatar os campos data, cpf, cnpj telefone-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>

<h4>Cadastro</h4>
<a class="btn btn-primary" href="?pagina=home&action=add"> <i class="glyphicon glyphicon-plus"></i> Cadastrar</a>
<a class="btn btn-primary" href="?pagina=home">Listar</a>
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
//inserrir dados no bancos
    if($action == 'insert')
	{	
		$nomeFor = addslashes($_POST['nomeFor']);
        $cnpjFor = addslashes($_POST['cnpjFor']);
        $nascimentoFor = addslashes($_POST['nascimentoFor']);
        $enderecoFor = addslashes($_POST['enderecoFor']);
        $cidadeFor = addslashes($_POST['cidadeFor']);
        $estadoFor = addslashes($_POST['estadoFor']);
        $telefoneFor = addslashes($_POST['telefoneFor']);
		$emailFor = addslashes($_POST['emailFor']);
		$bd->query("INSERT INTO fornecedor (nomeFor, cnpjFor, nascimentoFor, enderecoFor, cidadeFor,estadoFor, 
            telefoneFor, emailFor) VALUES 
            ('$nomeFor','$cnpjFor','$nascimentoFor','$enderecoFor', '$cidadeFor', '$estadoFor','$telefoneFor',
            '$emailFor')");
		$action = '';
    }

    if($action == 'add')
    {
		?>
        <form action="?action=insert" method="post"  name="form4" id="form4">
			<div class="form-row">
    			<div class="col-sm-10">
                    <label>Nome</label>
					<input type="text" name="nomeFor" class="form-control" id="For" required>
				</div>
    		</div>
			<div class="form-row">
				<div class="col-sm-5">
					<label>Telefone</label>
					<input type="text" name="telefoneFor" class="form-control" id="telefone" onkeypress="$(this).mask('(00) 0000-00000')"required>
					<label>CNPJ</label>
					<input type="text" name="cnpjFor" class="form-control" id="cnpj" onkeypress="$(this).mask('00.000.000/0000-00')"required>
				</div>
			</div>
			<div class="form-row">
    			<div class="form-group col-md-3">
                    <label>Data Nascimento</label>
					<input type="text" name="nascimentoFor" class="form-control" id="nascimentoFor" onkeypress="$(this).mask('00/00/0000')"required>
				</div>
			</div>
			<div class="form-row">
				<div class="form-group col-md-5">
                    <label>E-mail</label>
                    <input type="text" name="emailFor" class="form-control" id="email" required>
                    <label>Endereço</label>
                    <input type="text" name="enderecoFor" class="form-control" id="enderecoFor" required>
				</div>
			</div>
			<div class="form-row">
				<div class="form-group col-md-2">
                    <label>Estado</label>
                    <select id="estados" name="estadoFor" class="form-control" required>
                        <option value="">Selecione...</option>
                    </select>
              
                    <label>Cidades</label>
                        <select id="cidades" name="cidadeFor" class="form-control" required>
                            <option value="">Selecione...</option>
						</select>
				</div>
			</div> 
			<button type="submit" class="btn btn-primary">Salvar</button>
			<a href="?" class="btn btn-danger">Cancelar</a>
		</form>
	<?PHP
    }
//alterar dados do banco
    if($action == 'update')
	{	
		$idFor = addslashes($_POST['idFor']);
		$nomeFor = addslashes($_POST['nomeFor']);
		$telefoneFor = addslashes($_POST['telefoneFor']);
		$nascimentoFor = addslashes($_POST['nascimentoFor']);
		$cnpjFor = addslashes($_POST['cnpjFor']);
		$enderecoFor = addslashes($_POST['enderecoFor']);
		$cidadeFor = addslashes($_POST['cidadeFor']);
		$estadoFor = addslashes($_POST['estadoFor']);
		$emailFor = addslashes($_POST['emailFor']);
		$bd->query("UPDATE fornecedor SET nomeFor='$nomeFor', nascimentoFor='$nascimentoFor', telefoneFor='$telefoneFor', cnpjFor='$cnpjFor',
			enderecoFor='$enderecoFor', cidadeFor='$cidadeFor', estadoFor='$estadoFor', emailFor='$emailFor' WHERE idFor='$idFor'");
		$action ='';
    }

    if($action == 'edit')
	{
		$idFor = $_GET['idFor'];
		$bd->query("SELECT *FROM fornecedor WHERE idFor=$idFor");
		foreach($bd->result() as $dados)
		{
    ?>
      <form action="?action=update" method="post"  name="form4" id="form4">
			<div class="form-row">
    			<div class="col-sm-10">
                    <input type="hidden" name="idFor" id="idFor" class="form-control" value="<?PHP echo $dados['idFor'];?>">
                    <label>Nome</label>
					<input type="text" name="nomeFor" class="form-control" id="Fornecedor" value="<?PHP echo $dados['nomeFor'];?>">
				</div>
    		</div>
			<div class="form-row">
				<div class="col-sm-5">
					<label>Telefone</label>
					<input type="text" name="telefoneFor" class="form-control" id="telefone" onkeypress="$(this).mask('(00) 0000-00000')" value="<?PHP echo $dados['telefoneFor'];?>">
					<label>CNPJ</label>
					<input type="text" name="cnpjFor" class="form-control" id="cnpj" onkeypress="$(this).mask('00.000.000/0000-00')" value="<?PHP echo $dados['cnpjFor'];?>">
				</div>
			</div>
			<div class="form-row">
    			<div class="form-group col-md-3">
                    <label>Data Nascimento</label>
					<input type="text" name="nascimentoFor" class="form-control" id="nascimento" onkeypress="$(this).mask('00/00/0000')"value="<?PHP echo $dados['nascimentoFor'];?>">
				</div>
			</div>
			<div class="form-row">
				<div class="form-group col-md-5">
                    <label>E-mail</label>
                    <input type="text" name="emailFor" class="form-control" id="email" value="<?PHP echo $dados['emailFor'];?>">
                    <label>Endereço</label>
                    <input type="text" name="enderecoFor" class="form-control" id="enderecoFor" value="<?PHP echo $dados['enderecoFor'];?>">
				</div>
			</div>
			<div class="form-row">
				<div class="form-group col-md-2">
                    <label>Estado</label>
                    <select id="estados" name="estadoFor" class="form-control" value="">
                        <option value="">Selecione um estado</option>
                    </select>
              
                    <label>Cidade</label>
                        <select id="cidades" name="cidadeFor" class="form-control" value="">
                            <option value="">Selecione uma cidade</option>
						</select>
				</div>
			</div> 
			<button type="submit" class="btn btn-primary">Salvar</button>
			<a href="?" class="btn btn-danger">Cancelar</a>
        </form>
        <?php
        }
	}
	//Pesquisar por nome
	if($action == 'pesquisar')
	{
		$pesquisar = $_POST['pesquisa'];
		$bd->query("SELECT * FROM fornecedor WHERE nomeFor LIKE '$pesquisar%' ORDER BY nomeFor");
		?>
				<table class="table table-striped">
					<thead>
						<tr>
							<th>Nome</th>
                            <th>Cnpj</th>
                            <th>Nascimento</th>
							<th>Endereço</th>
                            <th>Cidade</th>
							<th>Estado</th>
                            <th>Telefone</th>
                            <th>E-mail</th>
							<th align="center">Opções</th>
						</tr>
					</thead>
					<tbody>
						<?PHP
						foreach($bd->result() as $dados)
							{	
								?>
									<td><?php echo $dados['nomeFor']; ?></td>
									<td><?php echo $dados['cnpjFor']; ?></td>
                                    <td><?php echo $dados['nascimentoFor']; ?></td>
                                    <td><?php echo $dados['enderecoFor']; ?></td>
                                    <td><?php echo $dados['cidadeFor']; ?></td>
                                    <td><?php echo $dados['estadoFor']; ?></td>
                                    <td><?php echo $dados['telefoneFor']; ?></td>
                                    <td><?php echo $dados['emailFor']; ?></td>
									<td>
										<a class="btn btn-primary btn-lg" href="?action=edit&idFor=<?PHP echo $dados['idFor']; ?>"> <i class="glyphicon glyphicon-pencil"></i> </a>

										<a class="btn btn-danger btn-lg" href="?action=delete&idFor=<?PHP echo $dados['idFor']; ?>"> <i class="glyphicon  glyphicon-trash"></i> </a>
									</td>
								</tr>
								<?PHP
							}	
						?>
					</tbody>
				</table>
	<?php
	}
	    //deletar dados no banco
		if($action == 'delete')
		{	
			$idFor = $_GET['idFor'];
			$bd->query("DELETE FROM fornecedor WHERE idFor=$idFor");
			$action = '';
		}
		?>
        
<?php
        if($action == '')
	{	
		$qt_por_fornecedor = 5;
		$sql = "SELECT * FROM fornecedor ORDER BY nomeFor ASC";
		$bd->query($sql);
		$total = $bd->linhas();
		$for = $total / $qt_por_fornecedor;
		$pg = 1;
		if(isset($_GET['f']) && !empty($_GET['f']))
			{	
				$pg = $_GET['f'];
			}
		$f = ($pg - 1) * $qt_por_fornecedor;
		$anterior = $pg - 1;
		$proximo = $pg + 1;

		$bd->query("$sql LIMIT $f,$qt_por_fornecedor");
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
                            <th>Cnpj</th>
                            <th>Nascimento</th>
							<th>Endereço</th>
                            <th>Cidade</th>
							<th>Estado</th>
                            <th>Telefone</th>
                            <th>E-mail</th>
							<th align="center">Opções</th>
						</tr>
					</thead>
					<tbody>
						<?PHP
						echo 'Total de registros encontrados: '.$bd->linhas().'<br><br>';
						foreach($bd->result() as $dados)
							{	
								?>
									<td><?php echo $dados['nomeFor']; ?></td>
									<td><?php echo $dados['cnpjFor']; ?></td>
                                    <td><?php echo $dados['nascimentoFor']; ?></td>
                                    <td><?php echo $dados['enderecoFor']; ?></td>
                                    <td><?php echo $dados['cidadeFor']; ?></td>
                                    <td><?php echo $dados['estadoFor']; ?></td>
                                    <td><?php echo $dados['telefoneFor']; ?></td>
                                    <td><?php echo $dados['emailFor']; ?></td>
									<td>
										<a class="btn btn-primary btn-lg" href="?action=edit&idFor=<?PHP echo $dados['idFor']; ?>"> <i class="glyphicon glyphicon-pencil"></i> </a>

										<a class="btn btn-danger btn-lg" href="?action=delete&idFor=<?PHP echo $dados['idFor']; ?>"> <i class="glyphicon  glyphicon-trash"></i> </a>
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
						if($for > 1)
							{	
								for($i=1;$i<=$for;$i++)
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
						if($pg < $for)
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
          