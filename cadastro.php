<?php
//Iniciando a $_SESSION - Sempre que usarmos ela devemos iniciar a mesma.
session_start();

// Fazendo a verificação de segurança na $_SESSION no índice que criamos para não ter erros no script caso ela não seja setada.
if (!isset($_SESSION["User"])) {
    $_SESSION["User"] = array();
}
//variável criada para quando o usuário querer listar os cadastros e o mesmo estiver vazio.

//Destruindo os dados armazenados na SESSION 
if (isset($_POST["Limpar"])) {
    session_destroy();
    session_start();
    echo "Banco de dados apagado :)";
}

if (isset($_POST["Enviar"])) {

    $nome = isset($_POST["username"]) ? $_POST["username"] : '';
    $date = isset($_POST["data"]) ? $_POST["data"] : '';
    $quartos = isset($_POST["qtdquartos"]) ? $_POST["qtdquartos"] : '';
    $tv = isset($_POST["qtdtv"]) ? $_POST["qtdtv"] : '';

    // transforma a data para o formato brasileiro.
    $aux = explode("-", $date);
    $databr = array();

    if (count($aux) > 1) {
        for ($i = 2, $j = 0; $i >= 0; $i--, $j++) {
            $databr[$j] = $aux[$i];
        }

        $date = implode("-", $databr);
    }

    // Juntandos todos os dados do cadastro em único array
    $pessoa = ["nome" => $nome, "data" => $date, "quarto" => $quartos, "televisores" => $tv];

    $erro = false;

    foreach ($_SESSION["User"] as $cadastro) {
        if ($cadastro["nome"] == $nome) {
            $erro = true;
            echo "Essa pessoa já foi cadastrada anteriormente.";
            break;
        }
    }

    if ($erro != true) {
        array_push($_SESSION["User"], $pessoa);
        echo "Cadastro efetuado com sucesso!";
    }
}


if (isset($_POST["Listar"])) {

    if (count($_SESSION["User"]) == 0) {
        echo "Nenhuma pessoa foi cadastrada até o momento...";
    }

    foreach ($_SESSION["User"] as $ID => $registro) {

        //  print_r($registro);
        echo $ID . " = " .  $registro["nome"] . " - " . $registro["data"] . " quartos: " . $registro["quarto"] . " televisões: " . $registro["televisores"];
        echo "<br>";
    }
}

if (isset($_POST["excluirBtn"])) {

    $excluir_id = isset($_POST["excluirPessoa"]) ? $_POST["excluirPessoa"] : '';

    foreach ($_SESSION["User"] as $ID => $valor) {

        if ($ID == $excluir_id) {
            unset($_SESSION["User"][$excluir_id]);
        }
    }
}

if (isset($_POST["consultarIdBtn"])) {

    $consulta_id = isset($_POST["consultarId"]) ? $_POST["consultarId"] : '';

    foreach ($_SESSION["User"] as $ID => $valor) {
        if ($ID == $consulta_id) {
            echo $ID . " = " .  $valor["nome"] . " - " . $valor["data"] . " quartos: " . $valor["quarto"] . " televisões: " . $valor["televisores"];
        }
    }
}

if (isset($_POST["consultarNmBtn"])) {

    $consulta_nome = isset($_POST["consultarNome"]) ? $_POST["consultarNome"] : '';

    foreach ($_SESSION["User"] as $ID => $valor) {
        if ($valor["nome"] == $consulta_nome) {
            echo $ID . " = " .  $valor["nome"] . " - " . $valor["data"] . " quartos: " . $valor["quarto"] . " televisões: " . $valor["televisores"];
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CADASTRO - TREINO</title>
</head>

<body>
    <div class="Main">
        <form name="cadastroIbge" id=cadastroIbge action="cadastro.php" method="POST">
            <h2> CADASTRO IBGE </h2>

            <div class="userInput">
                <label> Nome: </label>
                <br>
                <input type="text" name="username" id="username" placeholder="Ex: Carlos Monteiro" maxlength="40" size="25">
            </div>
            <br>


            <div class="userInput">
                <label> Data de nascimento: </label>
                <br>
                <input type="date" name="data" id="data" size="25">
            </div>
            <br>

            <div class="userInput">
                <label> Quantos quartos possui na sua casa? </label>
                <br>
                <input type="number" name="qtdquartos" id="qtdquartos" placeholder="Ex: 4" min="0" max="20">
            </div>
            <br>


            <div class="userInput">
                <label> Quantas televisões possui na sua casa? </label>
                <br>
                <input type="number" name="qtdtv" id="qtdtv" placeholder="Ex: 4" min="0" max="25">
            </div>
            <br>

            <div class="userbutton">

                <input type="submit" name="Enviar" id="Enviar" value="Enviar">
                <input type="submit" name="Limpar" id="Limpar" value="LimparBD">
                <input type="submit" name="Listar" id="Listar" value="Listar">

            </div>
            <br>

            <div class="userInput">
                <label> Excluir registro por id: </label>
                <br>
                <input type="number" name="excluirPessoa" id="excluirPessoa" min="0" size="25">
                <input type="submit" name="excluirBtn" id="excluirBtn" value="Excluir">
            </div>
            <br>

            <div class="userInput">
                <label> Consultar registro por id: </label>
                <br>
                <input type="number" name="consultarId" id="consultarId" min="0" size="25">
                <input type="submit" name="consultarIdBtn" id="consultarIdBtn" value="Consultar Id">
            </div>
            <br>

            <div class="userInput">
                <label> Consultar pessoa por nome: </label>
                <br>
                <input type="text" name="consultarNome" id="consultarNome" size="20" maxlength="40">
                <input type="submit" name="consultarNmBtn" id="consultarNmBtn" value="Consultar Nome">
            </div>
            <br>

        </form>
    </div>
</body>

</html>