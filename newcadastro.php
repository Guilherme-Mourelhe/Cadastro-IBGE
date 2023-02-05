<?php

session_start();

if (!isset($_SESSION["User"])) {
    $_SESSION["User"] = array();
}

if (isset($_POST["Enviar"])) {

    $nome = isset($_POST["username"]) ? $_POST["username"] : "";
    $data = isset($_POST["data"]) ? $_POST["data"] : "";
    $quartos = isset($_POST["qtdquartos"]) ? $_POST["qtdquartos"] : "";
    $televisores = isset($_POST["qtdtv"]) ? $_POST["qtdtv"] : "";

    $dataUS = explode("-", $data);
    $dataBR = [""];

    if (count($dataUS) > 1) {
        for ($i = 0, $j = 2; $j >= 0; $i++, $j--) {
            $dataBR[$i] = $dataUS[$j];
        }
        $data = implode("-", $dataBR);
    }


    $cadastro = ["nome" => $nome, "dataNasc" => $data, "qtdquartos" => $quartos, "qtdtelevisor" => $televisores];


    $error = false;

    foreach ($_SESSION["User"] as $ID => $registro) {
        if ($registro["nome"] == $nome) {
            $error = true;
            echo "Esse nome ja foi cadastrado anteriormente!";
        }
    }

    if ($error == false) {
        array_push($_SESSION["User"], $cadastro);
        echo "Pessoa cadastrada com sucesso!";
    }
}

if (isset($_POST["Limpar"])) {
    session_destroy();
    session_start();
    echo "Os registros foram apagados com sucesso!";
}

if (isset($_POST["Listar"])) {

    foreach ($_SESSION["User"] as $ID => $registro) {
        echo $ID . " -- " . " Nome: " . $registro["nome"] . " - " . " Nascimento: " . $registro["dataNasc"] .  " - " . " quartos: " . $registro["qtdquartos"] .  " - " . " televisões: " . $registro["qtdtelevisor"];
        echo "<br>";
    }
}

if (isset($_POST["excluirBtn"])) {

    $excluirID = isset($_POST["excluirPessoa"]) ? $_POST["excluirPessoa"] : "";

    foreach ($_SESSION["User"] as $ID => $registro) {
        if ($ID == $excluirID) {
            unset($_SESSION["User"]["$excluirID"]);
            echo "Registro excluído com sucesso!";
        }
    }
}
if (isset($_POST["consultarIdBtn"])) {

    $consultaID = isset($_POST["consultarId"]) ? $_POST["consultarId"] : "";

    foreach ($_SESSION["User"] as $ID => $registro) {
        if ($ID == $consultaID) {
            echo $ID . " -- " . " Nome: " . $registro["nome"] . " - " . " Nascimento: " . $registro["dataNasc"] .  " - " . " quartos: " . $registro["qtdquartos"] .  " - " . " televisões: " . $registro["qtdtelevisor"];
        }
    }
}

if (isset($_POST["consultarNmBtn"])) {

    $consultaNome = isset($_POST["consultarNome"]) ? $_POST["consultarNome"] : "";

    foreach ($_SESSION["User"] as $ID => $registro) {
        if ($registro["nome"] == $consultaNome) {
            echo $ID . " -- " . " Nome: " . $registro["nome"] . " - " . " Nascimento: " . $registro["dataNasc"] .  " - " . " quartos: " . $registro["qtdquartos"] .  " - " . " televisões: " . $registro["qtdtelevisor"];
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
        <form name="cadastroIbge" id=cadastroIbge action="newcadastro.php" method="POST">
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
                <input type="number" name="excluirPessoa" id="excluirPessoa" min="0" size="25" max="<?php echo count($_SESSION["User"]) ?>">
                <input type="submit" name="excluirBtn" id="excluirBtn" value="Excluir">
            </div>
            <br>

            <div class="userInput">
                <label> Consultar registro por id: </label>
                <br>
                <input type="number" name="consultarId" id="consultarId" min="0" size="25" max="<?php echo count($_SESSION["User"]) ?>" >
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