<?php
include "header.php";
include "cadastro.php";
?>

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
</div>

<?php
include "rodape.php";
?>