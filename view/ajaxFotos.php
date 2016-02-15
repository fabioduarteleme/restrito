<?php
require_once('../Connections/db.php');
include('../include/_restrito.php');

// INFO PAGE
$tabelabd ="fotos";

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
$query_r = "SELECT * FROM $tabelabd WHERE idusuario = '$idusuario' AND idrelacionamento = '$idregistro' ORDER BY ordem ASC";
$r = mysql_query($query_r, $db) or die(mysql_error());
$row_r = mysql_fetch_assoc($r);
$totalRows_r = mysql_num_rows($r);
?>


<?php if (@$row_r['id'] != "") { ?>

<!-- ORDENACAO START -->
<script>
$( "#btn-ordenar" ).click(function() {
  $("#btn-ordenar").toggleClass( "btn-danger");
  $(this).html($(this).html() == '<i class="fa fa-th"></i> Reordenar' ? '<i class="fa fa-check-circle-o"></i> Finalizar' : '<i class="fa fa-th"></i> Reordenar');
  $(".caption").toggleClass( "hidden");
  $(".framephoto").toggleClass( "cursormove animated pulse infinite" );

  $(".contentLeft ul").sortable({ opacity: 0.6, cursor: 'move', update: function() {
      var order = $(this).sortable("serialize") + '&action=updateRecordsListings'; 
        $.post("../controller/uploadController.php", order, function(theResponse){
        $(".contentRight").html(theResponse);
      });                                
    }                 
    })
});
</script>

<div class="contentLeft">

  <div id="btn-ordenar" class="btn btn-primary"><i class="fa fa-th"></i> Reordenar</div>
  <div id="btn-renomear" class="btn btn-primary"><i class="fa fa-edit"></i> Renomear</div>
  <a href="javascript:history.back()"><div id="btn-volta-reordenar" class="btn btn-default"><i class="fa fa-chevron-circle-left"></i> Voltar</div></a>
  <ul>
    <?php do { ?>
    <div class="col-sm-6 col-md-4 framephoto" id="recordsArray_<?php echo $row_r['id']; ?>">
      <div class="thumbnail">
        <div class="imagesize" style="background:url('../img/fotos/<?php echo $row_r['nomepath']; ?>');" alt="<?php echo $row_r['titulo']; ?>');"></div>
        <div class="caption">
          <!--<h3><?php //echo $row_r['titulo']; ?></h3><br>-->
          <div class="btn-del"><a onClick="return confirm('Deseja realmente excluir?')" href="ajaxFotos.php?del=<?php echo $row_r['id']; ?>" class="btn btn-danger" role="button"> <i class="fa fa-pencil-square-o"></i> Excluir</a></div>
          <div class="btn-destaque">
            <i class="fa fa-star"></i>
            <input type="hidden" value="<?php echo $row_r['id']; ?>" />
            <input type="checkbox" <?php if($row_r['destaque']=="S") { echo "checked"; } ?> id="<?php echo $row_r['id']; ?>" /><label for="<?php echo $row_r['id']; ?>"><span class="ui"></span></label>
          </div>
          
          <div class="renomear">
            <div class="btn btn-default btn-renomear">
              <input type="hidden" class="legendaoculta" value="<?php echo $row_r['id']; ?>" />
              <input type="text" class="legenda" id="<?php echo $row_r['id']; ?>"  value="<?php echo $row_r['titulo']; ?>" />          
              <i class="fa fa-check"></i>
            </div>
          </div>

        </div>
      </div>
    </div>
  <?php } while ($row_r = mysql_fetch_assoc($r)); ?>
  </ul>
</div>
<!-- ORDENACAO END -->

<!-- UPDATE DESTAQUE STATUS START -->  
  <script type="text/javascript">
        $(document).ready(function(){
            $('.btn-destaque').click(function(){
                var hiddenValueID = $(this).children(':hidden').val();
                if ($(this).children(':checked').length == 0)
                { var valueData = 'N'; } else { var valueData = 'S';}
                $.ajax({
                    type: "POST",
                    url: "../controller/uploadController.php",
                    data: {valueDestaque: valueData, id: hiddenValueID} ,
                });
            });

            $('.btn-renomear').click(function(){
                var hiddenlegenda = $(this).children('.legendaoculta').val();
                var legenda = $(this).children('.legenda').val();
                $.ajax({
                    type: "GET",
                    url: "../controller/uploadController.php",
                    data: {valueLegenda1: legenda, id: hiddenlegenda} ,
                });
                $(this).children('.fa-check').toggleClass("hidden");
            });


            $( "#btn-renomear" ).click(function() {
              $("#btn-renomear").toggleClass( "btn-danger");
              $(this).html($(this).html() == '<i class="fa fa-edit"></i> Renomear' ? '<i class="fa fa-check-circle-o"></i> Finalizar' : '<i class="fa fa-edit"></i> Renomear');
              $(".btn-del").toggleClass( "hidden");
              $(".btn-destaque").toggleClass( "hidden");
              $(".renomear").toggle();
            });

        });
    </script>
<!-- UPDATE DESTAQUE STATUS END -->

<?php } else { ?>
<div class="text-center"><br><h3>Nenhuma foto cadastrada</h3><br></div>
<?php } ?>


