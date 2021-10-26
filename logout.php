<?php

//$_SESSION = array();
$_SESSION['username'] = "";
$_SESSION['log'] = "<a href=\"index.php?page=login\">Connexion</a>";

header("Location: index.php?page=home");
exit();

?>
