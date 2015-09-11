
<?php
/**
 * Thumbnail
 * A partir de uma imagem (JPG ou PNG) gera um thumbnail (miniatura) proporcional à original
 * Testado com PHP 4.3 e biblioteca GD (Win)
 * Verificar as permissões de diretório, pois acaba sendo um erro comum pastas sem permissão.
 * Para testar a função em um servidor basta colocar o arquivo numa pasta e uma imagem: VER EXEMPLO NO FIM DO ARQUIVO
 * PHP >= 4 com GD >= 1.8
 *
 * @author Dudu <edu.chaos@gmail.com>				
 * @version 2005-11-26
 *
 * @param string $arq_in	
 * @param string $arq_out	
 * @param int $max_w		largura maxima
 * @param int $max_h 		altura máxima
 * @return string			erro
*/
function Thumbnail( $arq_in, $arq_out = "", $max_w = 150, $max_h = 150 )
{
	$erro = NULL;

	/**/
	if( ! function_exists('imagecopyresampled') )		return "ERRO: imagecopyresampled";
	if( ! function_exists('imageCreateTrueColor'))      return "ERRO: imageCreateTrueColor";
	if( ! function_exists('getimagesize') )				return "ERRO: getimagesize";
	/**/
	if( ! file_exists( $arq_in ) )						return "ERRO: ! file_exists('$arq_in')";

	/* renomeando */
	$arq_out = ( ! $arq_out ? "t_".$arq_in : $arq_out );
	
	/* array ... */
	$arr = getimagesize( $arq_in );
	
	$tipo = $arr[2];
	$altura = $arr[1];
	$largura = $arr[0];
	
	if( $tipo != 2 && $tipo != 3 )
		return "ERRO: file_type '$arr[mime]'";
	
	/* redimensionando */
	$max_t = ( $max_w > $max_h ? $max_w : $max_h );
	$max_i = ( $largura > $altura ? $largura : $altura );
	$prop = $max_i / $max_t;
	$largura_t = floor( $largura / $prop );
	$altura_t = floor( $altura / $prop );

	/* gerando imagem (GD) */

	$alocar = ( $tipo == 2 ? "imagecreatefromjpeg" : "imagecreatefrompng" );
	if( ! $img = $alocar( $arq_in ) )
		return "ERRO :'$alocar'";

	if( function_exists('imageCreateTrueColor') ) 
	{
		if( ! $img_t = imagecreatetruecolor( $largura_t, $altura_t ) )
			return "ERRO :'imagecreatetruecolor'";
	} else
		if( ! $img_t = imagecreate( $largura_t, $altura_t ) )
			return "ERRO: 'imagecreate'";
	 
	if( ! imagecopyresampled( $img_t, $img, 0, 0, 0, 0, $largura_t, $altura_t, $largura, $altura )) 
		return "ERRO: 'imagecopyresampled'";
	//if( ! imagecopyresized( $img_t, $img, 0, 0, 0, 0, $largura_t, $altura_t, $largura, $altura ) )
	//	return "ERRO: 'imagecopyresized'";

	$criar = ( $tipo == 2 ? "imagejpeg" : "imagepng" );
	$erro  = $criar($img_t, $arq_out, 90 ) ? "" : "ERRO : '$criar'";
		
	imagedestroy($img);
	imagedestroy($img_t);
	
	return $erro;
}

/** exemplo ** /
	if( ! $error = thumbnail( 'imagem.jpg', 'imagem_t.jpg', 100, 100 ) )
		 print '<img src="imagem.jpg" alt="imagem normal" /><br /><img src="imagem_t.jpg" alt="imagem thumbnail" />';
	else
		print $error;
/** fim exemplo **/

?>