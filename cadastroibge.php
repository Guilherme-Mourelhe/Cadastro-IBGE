<?PHP
session_start();

?>

<html>

<head>
    <title>
        Cadastro IBGE
    </title>
    <meta charset="UTF-8">

    <style>
        .linha {
            height: 50px;
        }

        .celula {
            display: inline-block;
            width: 220;
        }
    </style>

</head>

<body>
    <h1>Cadastro do IBGE</h1>

    <form id="cadastro" name="cadastro" action="cadastroibge.php" method="post">

        <div class='linha'>
            <span class='celula'>
                <label>Nome: </label>
            </span>
            <span class='celula'>
                <input name="nome" id="nome" type="text" size="30" maxlength="100">
            </span>
        </div>


        <div class='linha'>
            <span class='celula'>
                <label>Data de Nascimento: </label>
            </span>
            <span class='celula'>
                <input name="dataNascimento" id="dataNascimento" type="date">
            </span>
        </div>

        <div class='linha'>
            <span class='celula'>
                <label>Quantos Quartos tem em casa: </label>
            </span>
            <span class='celula'>
                <input name="qtdQuartos" id="qtdQuartos" type="number" min="0" max="10">
            </span>
        </div>

        <div class='linha'>
            <span class='celula'>
                <label>Quantas Televisões tem em casa: </label>
            </span>
            <span class='celula'>
                <input name="qtdTV" id="qtdTV" type="number" min="0" max="10">
            </span>
        </div>


        <input type="submit" id="enviar" name="enviar" value="Enviar">

        <input type="submit" id="limpar" name="limpar" value="Limpar">

        <input type="submit" id="listar" name="listar" value="Listar">

        <!-- Adcionar um mín e máx no excluir e consultar -->

        <br><br>
        <label>Excluir a pessoa: </label>
        <input name="posicao" id="posicao" type="number" >
        <input type="submit" id="excluir" name="excluir" value="Excluir">

        <br><br>
        <label>Consultar a pessoa: </label>
        <input name="posicaoConsulta" id="posicaoConsulta" type="number" >
        <input type="submit" id="consultar" name="consultar" value="Consultar">


        <br><br>
        <label>Consultar a pessoa por nome: </label>
        <input name="nomeConsulta" id="nomeConsulta" type="text">
        <input type="submit" id="consultarNome" name="consultarNome" value="Consultar por nome">
    </form>

    <?PHP
    
    //Cria array no session pessoa
    if ( !isset($_SESSION['pessoa']) ) {
        $_SESSION['pessoa'] = array();
    }
    //Botão limpar
    if (isset($_POST['limpar'])) {
        session_destroy();
        session_start();
        echo "Base apagada com sucesso!";
    }
    // verifica o botão enviar e se as variáveis nome e data foram setadas, armazenando-as em um array e cadastrado no SESSION. 
    //O IF verifica se o nome já foi cadastrado no array session. 
    if (isset($_POST['enviar'])) {
        //POST Array ( [nome] => sdasd [dataNascimento] => 2023-01-03 [qtdQuartos] => 8 [qtdTV] => 2 [enviar] => Enviar )
        $nome = isset($_POST['nome']) ? $_POST['nome'] : '';
        $dataNascimento = isset($_POST['dataNascimento']) ? $_POST['dataNascimento'] : '';

        //porque 

        $pessoa = array("nome" => $nome, "dataNascimento" => $dataNascimento);

        $erro = 0;
        foreach ($_SESSION['pessoa'] as $pesquisa) {
            if ($pesquisa['nome'] == $nome) {
                $erro++;
                break;
            }
        }

        if (!$erro) {
            array_push($_SESSION['pessoa'], $pessoa);
            echo "Pessoa cadastrada com sucesso!";
        } else {
            echo "Pessoa já cadastrado!";
        }
    }

    // lista as pessoas com base no conteúdo do session[pessoa] ao mesmo tempo que cria um contador para verificar se a base de pessoas está limpa.
    if (isset($_POST['listar'])) {

        $tt = 0;
        foreach ($_SESSION['pessoa'] as $id => $pessoa) {
            $tt++;
            echo "$id - $pessoa[nome] - $pessoa[dataNascimento] <br>";
        }

        if ($tt == 0) {
            echo "Base de pessoas está limpa.";
        }
    }

    // recebe a posição desejada pelo usuário e busca ela no session dando unset.
    if (isset($_POST['excluir'])) {
        $posicao = isset($_POST['posicao']) ? $_POST['posicao'] : '';
        unset($_SESSION['pessoa'][$posicao]);
    }

     // recebe a posição desejada pelo usuário e busca ela no session imprimindo a possição do mesmo na tela.
    if (isset($_POST['consultar'])) {
        $posicaoConsulta = isset($_POST['posicaoConsulta']) ? $_POST['posicaoConsulta'] : '';

        $consultado = isset($_SESSION['pessoa'][$posicaoConsulta]) ? $_SESSION['pessoa'][$posicaoConsulta] : '';

        if (!empty($consultado)) {
            echo "$posicaoConsulta - $consultado[nome] - $consultado[dataNascimento] <br>";
        } else {
            echo "Usuário Não Encontrado";
        }
    }
    //?????
    if (isset($_POST['consultarNome'])) {
        $nomeConsulta = isset($_POST['nomeConsulta']) ? $_POST['nomeConsulta'] : '';

        $pesquisaArray = array();
        $consultado = -1;

        foreach ($_SESSION['pessoa'] as $pesquisa) {

            $consultado = strpos($pesquisa['nome'], $nomeConsulta);

            if (is_integer($consultado) and $consultado >= 0) {
                array_push($pesquisaArray, $pesquisa);
            }
        }
    }



    ?>

</body>

</html>