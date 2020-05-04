<?php 
require_once('db_connect.php');
$bd = new Banco();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilo.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" 
    integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" 
    crossorigin="anonymous">
    <title>Lista de Usuários</title>
</head>
<body>

  <ul class="nav">
    <li class="nav-item">
            <a class="nav-link active" href="index.php">Home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="usuarios.php">Usuários</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="funcionario.php">Funcionário</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="produtos.php">Produtos</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="fornecedor.php">Fornecedor</a>
        </li>
    </ul>

  <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <?php 
                $usuario = 'cadastro_usuarios';
                if(!empty($_GET['usua']))
                    {   
                        $usuario = $_GET['usu'];
                    }
                if(file_exists("$usuario.php"))
                    {   
                        include("$usuario.php");
                    }
                else
                    {   
                        ?> <i class="glyphicon glyphicon-thumbs-down"></i> Página não encontrada. <?PHP
                    }
                ?>
            </div>
        </div>
    </div>

</body>
</html>