<?php
session_start();
$_SESSION['login']=="";

session_unset();
$_SESSION['action1']="Vous vous êtes déconnecté(e)s avec succès!";
?>
<script language="javascript">
document.location="index.php";
</script>        

