<?php
//Iniciando a $_SESSION - Sempre que usarmos ela devemos iniciar a mesma.
session_start();

// Fazendo a verificação de segurança na $_SESSION no índice que criamos para não ter erros no script caso ela não seja setada.
if (!isset($_SESSION["User"])) {
    $_SESSION["User"] = array();
}

//Destruindo os dados armazenados na SESSION 
if (isset($_POST["Limpar"])) {
    session_destroy();
    session_start();
    echo "Banco de dados apagado :)";
    echo "<br>";
    echo "<br>";
    echo "<a href='main.php'>VOLTAR AO MENU PRINCIPAL</a>";
}

if (isset($_POST["Enviar"])) {

    $nome = isset($_POST["username"]) ? $_POST["username"] : '';
    $date = isset($_POST["data"]) ? $_POST["data"] : '';
    $quartos = isset($_POST["qtdquartos"]) ? $_POST["qtdquartos"] : '';
    $tv = isset($_POST["qtdtv"]) ? $_POST["qtdtv"] : '';

    // transforma a data para o formato brasileiro.
    $dataUS = explode("-", $date);
    $databr = array();

    if (count($dataUS) > 1) {
        for ($i = 2, $j = 0; $i >= 0; $i--, $j++) {
            $databr[$j] = $dataUS[$i];
        }

        $date = implode("-", $databr);
    }

    // Juntandos todos os dados do cadastro em único array
    $pessoa = ["nome" => $nome, "data" => $date, "quarto" => $quartos, "televisores" => $tv];

    //variável de controle que informa se pessoa já tiver sido cadastrada.
    $erro = false;

    foreach ($_SESSION["User"] as $cadastro) {
        if ($cadastro["nome"] == $nome) {
            $erro = true;
            echo "Essa pessoa já foi cadastrada anteriormente.";
            echo "<br>";
            echo "<br>";
            echo "<a href='main.php'>VOLTAR AO MENU PRINCIPAL</a>";
            break;
        }
    }

    if ($erro != true) {
        array_push($_SESSION["User"], $pessoa);
        echo "Cadastro efetuado com sucesso!";
        echo "<br>";
        echo "<br>";
        echo "<a href='main.php'>VOLTAR AO MENU PRINCIPAL</a>";
    }
}
if (isset($_POST["Listar"])) {

    if (count($_SESSION["User"]) == 0) {
        echo "Nenhuma pessoa foi cadastrada até o momento...";
        echo "<br>";
    }

    foreach ($_SESSION["User"] as $ID => $registro) {

        //  print_r($registro);
        echo $ID . " = " .  $registro["nome"] . " - " . $registro["data"] . " quartos: " . $registro["quarto"] . " televisões: " . $registro["televisores"];
        echo "<br>";
    }

    echo "<br>";
    echo "<br>";
    echo "<a href='main.php'>VOLTAR AO MENU PRINCIPAL</a>";
}

if (isset($_POST["excluirBtn"])) {

    $excluir_id = isset($_POST["excluirPessoa"]) ? $_POST["excluirPessoa"] : '';

    foreach ($_SESSION["User"] as $ID => $valor) {

        if ($ID == $excluir_id) {
            unset($_SESSION["User"][$excluir_id]);
            echo "Registro excluído com sucesso.";
            echo "<br>";
            echo "<br>";
            echo "<a href='main.php'>VOLTAR AO MENU PRINCIPAL</a>";
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
    echo "<br>";
    echo "<br>";
    echo "<a href='main.php'>VOLTAR AO MENU PRINCIPAL</a>";
}

if (isset($_POST["consultarNmBtn"])) {

    $consulta_nome = isset($_POST["consultarNome"]) ? $_POST["consultarNome"] : '';

    foreach ($_SESSION["User"] as $ID => $valor) {
        if ($valor["nome"] == $consulta_nome) {
            echo $ID . " = " .  $valor["nome"] . " - " . $valor["data"] . " quartos: " . $valor["quarto"] . " televisões: " . $valor["televisores"];
        }
    }
    echo "<br>";
    echo "<br>";
    echo "<a href='main.php'>VOLTAR AO MENU PRINCIPAL</a>";
}
