<?php

echo "<script> let cf = confirm('do you want to delete Y/N');";
echo "if(!cf){window.location.href='../view/perfil.php';} else {window.location.href='deletar.php';}</script>";

?>