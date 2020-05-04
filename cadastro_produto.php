<script src="js/jQuery.js"></script>
<!--formatar os campos data, cpf, cnpj telefone-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>

<h4>Cadastro</h4>
<a class="btn btn-primary" href="?pagina=home&action=add"> <i class="glyphicon glyphicon-plus"></i> Cadastrar</a>
<a class="btn btn-primary" href="?pagina=produto">Listar</a>
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

//inserir dados no bando
    if($action == 'insert')
	{	
		$nomePro = addslashes($_POST['nomePro']);
        $qntPro = addslashes($_POST['qntPro']);
        $compraPro = addslashes($_POST['compraPro']);
        $vendaPro = addslashes($_POST['vendaPro']);
        $marcaPro = addslashes($_POST['marcaPro']);
		$bd->query("INSERT INTO produtos (nomePro, qntPro, compraPro, vendaPro, marcaPro) VALUES 
                ('$nomePro','$qntPro','$compraPro','$vendaPro','$marcaPro')");
		$action = '';
    }

    if($action == 'add')
    {
		?>
        <form action="?action=insert" method="post"  name="form3" id="form3">
			<div class="form-row">
    			<div class="col-sm-10">
                    <label>Nome Produto</label>
					<input type="text" name="nomePro" class="form-control" id="produto" required>
				</div>
    		</div>
			<div class="form-row">
				<div class="col-sm-5">
					<label>Quantidade</label>
					<input type="number" name="qntPro" class="form-control" id="produto" required>
					<label>Valor da Compra</label>
					<input type="double" name="compraPro" class="form-control" id="compra" onkeypress="$(this).mask('000.000,00')" required>
				</div>
			</div>
			<div class="form-row">
    			<div class="form-group col-md-3">
                    <label>Valor da Venda</label>
					<input type="double" name="vendaPro" class="form-control" id="venda" onkeypress="$(this).mask('000.000,00')" required>
				</div>
			</div>
			<div class="form-row">
				<div class="form-group col-md-5">
                    <label>Marca do Produto</label>
                    <input type="text" name="marcaPro" class="form-control" id="marca" required>
                </div> 
            </div> 
			<button type="submit" class="btn btn-primary">Salvar</button>
			<a href="?" class="btn btn-danger">Cancelar</a>
		</form>
	<?PHP
	}
//pesquisar por nome
	if($action == 'pesquisar')
	{
		$pesquisa = $_POST['pesquisa'];
		$bd->query("SELECT * FROM produtos WHERE nomePro LIKE '$pesquisa%' ORDER BY nomePro ASC");
		?>
			<table class="table table-striped">
			<thead>
				<tr>
					<th>Nome</th>
					<th>Quantidade</th>
					<th>Valor da Compra</th>
					<th>Valor da Venda</th>
					<th>Marca</th>
					<th align="center">Opções</th>
				</tr>
			</thead>
			<tbody>
		<?php
		foreach($bd->result() as $dados){
		?>
			<tr>
				<td><?php echo $dados['nomePro']; ?></td>
				<td><?php echo $dados['qntPro']; ?></td>
				<td><?php echo $dados['compraPro']; ?></td>
				<td><?php echo $dados['vendaPro']; ?></td>
				<td><?php echo $dados['marcaPro']; ?></td>
				<td>
					<a class="btn btn-primary btn-lg" href="?action=edit&idPro=<?PHP echo $dados['idPro']; ?>"> <i class="glyphicon glyphicon-pencil"></i> </a>
					<a class="btn btn-danger btn-lg" href="?action=delete&idPro=<?PHP echo $dados['idPro']; ?>"> <i class="glyphicon  glyphicon-trash"></i> </a>
				</td>
            </tr>
        	<?PHP
                }	
       		 ?>
    			</tbody>
				</table>
		<?php
		}
	
//alterar dados no banco
    if($action == 'update')
	{	
		$idPro = addslashes($_POST['idPro']);
		$nomePro = addslashes($_POST['nomePro']);
        $compraPro = addslashes($_POST['compraPro']);
        $qntPro = addslashes($_POST['qntPro']);
        $vendaPro = addslashes($_POST['vendaPro']);
        $marcaPro = addslashes($_POST['marcaPro']);
		$bd->query("UPDATE produtos SET nomePro='$nomePro', qntPro='$qntPro', compraPro='$compraPro', vendaPro='$vendaPro',
            marcaPro='$marcaPro' WHERE idPro=$idPro");
		$action = '';
	}
    
    if($action == 'edit')
	{
		$idPro = $_GET['idPro'];
		$bd->query("SELECT *FROM produtos WHERE idPro=$idPro");
		foreach($bd->result() as $dados)
		{
			?>
			<form action="?action=update" method="post"  name="form3" id="form3">
                <div class="form-row">
                    <div class="col-sm-10">
                        <input type="hidden" name="idPro" id="idPro" class="form-control" value="<?PHP echo $dados['idPro']; ?>">
                        <label>Nome Produto</label>
                        <input type="text" name="nomePro" class="form-control" id="produto" value="<?PHP echo $dados['nomePro']; ?>">
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-sm-5">
                        <label>Quantidade</label>
                        <input type="number" name="qntPro" class="form-control" id="produto" value="<?PHP echo $dados['qntPro']; ?>">
                        <label>Valor da Compra</label>
                        <input type="text" name="compraPro" class="form-control" id="compra" onkeypress="$(this).mask('###0.00' , {reverse: true});" value="<?PHP echo $dados['compraPro']; ?>">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label>Valor da Venda</label>
                        <input type="text" name="vendaPro" class="form-control" id="venda" onkeypress="$(this).mask('###0.00' , {reverse: true}); "value="<?PHP echo $dados['vendaPro']; ?>">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-5">
                        <label>Marca do Produto</label>
                        <input type="text" name="marcaPro" class="form-control" id="marca" value="<?PHP echo $dados['marcaPro']; ?>">
                    </div> 
                </div> 
                <button type="submit" class="btn btn-primary">Salvar</button>
                <a href="?" class="btn btn-danger">Cancelar</a>
			</form>
			<?php
		}
    }
    //deletar dados no banco
    if($action == 'delete')
	{	
		$idPro = $_GET['idPro'];
		$bd->query("DELETE FROM produtos WHERE idPro=$idPro");
		$action = '';
	}
    ?>

<?php

if($action == '')
	{	
		$qt_por_produto = 5;
		$sql = "SELECT * FROM produtos order by nomePro ASC";
		$bd->query($sql);
		$total = $bd->linhas();
		$prod = $total / $qt_por_produto;
		$pg = 1;
		if(isset($_GET['p']) && !empty($_GET['p']))
			{	
				$pg = $_GET['p'];
			}
		$f = ($pg - 1) * $qt_por_produto;
		$anterior = $pg - 1;
		$proximo = $pg + 1;

		$bd->query("$sql LIMIT $f,$qt_por_produto");
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
            <th>Quantidade</th>
            <th>Valor da Compra</th>
            <th>Valor da Venda</th>
            <th>Marca</th>
            <th align="center">Opções</th>
        </tr>
    </thead>
    <tbody>
        <?PHP
            echo 'Total de registros encontrados: '.$bd->linhas().'<br><br>';
            foreach($bd->result() as $dados)
                {	
        ?>
                        <td><?php echo $dados['nomePro']; ?></td>
                        <td><?php echo $dados['qntPro']; ?></td>
                        <td><?php echo $dados['compraPro']; ?></td>
                        <td><?php echo $dados['vendaPro']; ?></td>
                        <td><?php echo $dados['marcaPro']; ?></td>
                    <td>
                        <a class="btn btn-primary btn-lg" href="?action=edit&idPro=<?PHP echo $dados['idPro']; ?>"> <i class="glyphicon glyphicon-pencil"></i> </a>
                        <a class="btn btn-danger btn-lg" href="?action=delete&idPro=<?PHP echo $dados['idPro']; ?>"> <i class="glyphicon  glyphicon-trash"></i> </a>
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
								<li><a href="?p=<?PHP echo $anterior; ?>"> <i class="glyphicon glyphicon-menu-left"></i> </a></li>
								<?PHP
							}
						if($prod > 1)
							{	
								for($i=1;$i<=$prod;$i++)
									{	
										if($pg == $i or $anterior < 0)
											{	
												$cor = 'class="active"';
											}
										else
											{	
												$cor = '';
											}
										?><li <?php echo $cor; ?>><a href="?p=<?PHP echo $i; ?>"> <?PHP echo $i; ?> </a></li><?PHP
									}
							}
						if($pg < $prod)
							{	
								?>
								<li><a href="?p=<?PHP echo $proximo; ?>"> <i class="glyphicon glyphicon-menu-right"></i> </a></li>
								<?PHP
							}
						?>
						
					</ul>
				</div>
				<?PHP
			}
	}
?>