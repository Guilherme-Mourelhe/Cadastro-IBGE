<?php
include "header.php";
include "cadastro.php";
?>

<div class="userInput">
    <label> Consultar registro por id: </label>
    <br>
    <input type="number" name="consultarId" id="consultarId" min="0" size="25">
    <input type="submit" name="consultarIdBtn" id="consultarIdBtn" value="Consultar Id">
</div>
<br>

<?php
include "rodape.php";
?>