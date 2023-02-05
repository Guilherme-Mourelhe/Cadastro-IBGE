<?php
include "header.php";
include "cadastro.php";
?>

<div class="userInput">
    <label> Excluir registro por id: </label>
    <br>
    <input type="number" name="excluirPessoa" id="excluirPessoa" min="0" size="25">
    <input type="submit" name="excluirBtn" id="excluirBtn" value="Excluir">
</div>
<br>

<?php
include "rodape.php";
?>