<?php 

function invert($datainv,$sep){

	$ano=substr("$datainv",0, 4);
	$mes=substr("$datainv",5, 2);
	$dia=substr("$datainv",8, 2);
	$datainv="$dia$sep$mes$sep$ano";
	return $datainv;
}

function datashort($datashort,$sepshort){

	$anoshort=substr("$datashort",0, 4);
	$messhort=substr("$datashort",5, 2);
	$diashort=substr("$datashort",8, 2);
	$datashort="$diashort$sepshort$messhort";
	return $datashort;
}

function limitar($Texto,$Tamanho) {
  return (strlen($Texto) > $Tamanho) ? substr($Texto, 0, $Tamanho) . '...' : $Texto;
}


///////////////////////////////////  URL AMIGAVEL  ///////////////////////////////////////////


function seo($string){
 $a = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜüÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿŔŕ"!@#$%&*()_-+={[}]/?;:.,\\\'<>';
 $b = 'aaaaaaaceeeeiiiidnoooooouuuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr                              ';
 $string = utf8_decode($string);
 $string = strtr($string, utf8_decode($a), $b);
 $string = strip_tags(trim($string));

/*Agora, remove qualquer espaço em branco duplicado*/
$string = preg_replace('/\s(?=\s)/', '', $string);

/*Ssubstitui qualquer espaço em branco (não-espaço), com um espaço*/
$string = preg_replace('/[\n\r\t]/', ' ', $string);

/*Remove qualquer espaço vazio*/
$string = str_replace(" ","-",$string);
return strtolower(utf8_encode($string));


}

?>