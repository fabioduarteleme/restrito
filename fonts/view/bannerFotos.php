<?php
require_once('../Connections/db.php');
include('../include/_restrito.php');

// INFO PAGE
$tabelabd ="banner";

 // DEPLOY DATA
if ((isset($_GET['del'])) && ($_GET['del'] != "")) {
$deleteSQL = sprintf("DELETE FROM $tabelabd WHERE id=%s",
GetSQLValueString($_GET['del'], "int"));
mysql_select_db($database_db, $db);
$Result3 = mysql_query($deleteSQL, $db) or die(mysql_error());
header('location:'.$_SERVER['HTTP_REFERER'].'');
} 

$idusuario = base64_decode($_GET['iduser']);
$idregistro = base64_decode($_GET['upload']);

// RECEIVE DATA
mysql_select_db($database_db, $db);
$query_r = "SELECT * FROM $tabelabd WHERE idusuario = '$idusuario' AND id = '$idregistro'";
$r = mysql_query($query_r, $db) or die(mysql_error());
$row_r = mysql_fetch_assoc($r);
$totalRows_r = mysql_num_rows($r);
?>


<?php if (@$row_r['imagem'] != "") { ?>

  <ul>
    <?php do { ?>
    <div class="col-sm-12 col-md-12" id="recordsArray_<?php echo $row_r['id']; ?>">
        <div class="imagesize framephotoalone"alt="<?php echo $row_r['titulo']; ?>');">
          <img src="../img/banner/<?php echo $row_r['imagem']; ?>">
        </div>
    </div>
  <?php } while ($row_r = mysql_fetch_assoc($r)); ?>
  </ul>

<?php } else { ?>
<div class="text-center"><br><h3>Nenhuma imagem cadastrada</h3><br></div>
<?php } ?>


