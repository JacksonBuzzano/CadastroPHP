<?php 
require_once('db_connect.php');
$bd = new Banco();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/estilo.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" 
    integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" 
    crossorigin="anonymous">
    <title>Sistema de Cadastro</title>
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


    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
</body>
</html>