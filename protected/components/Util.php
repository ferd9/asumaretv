<?php

/**
 * Description of Utilidades
 * Esta clase possea varias funcionee.. como por ejemplo acortar una cadena demasiada larga
 * 
 * @author El APRENDIZ www.elaprendiz.net63.net
 */
class Util {
    
    public static function minizarString($str,$longitud = 31)
    {
       if(strlen($str)<31)
           return $str;
       else
       {
          $tmp = str_split($str, $longitud);
          return $tmp[0]."..."; 
       }
       
       return null;
    }
    
//    public static function eliminarSignos($str,$longitud = 0)
//    {
//        // REEMPLAZANDO ' ' => '_'
//	$return = str_replace(' ','_',$str);
//	// REEMPLAZANDO RAROS
//	$return = str_replace(array('?','¿','¡','!','%'),'',$return);
//	//
//        if($longitud > 0)
//        {
//            $return = Util::minizarString($return, $longitud);
//        }
//	return strtolower($return);
//        
//    }
    
    /**
 * Create a web friendly URL slug from a string.
 * 
 * Although supported, transliteration is discouraged because
 *     1) most web browsers support UTF-8 characters in URLs
 *     2) transliteration causes a loss of information
 *
 * @author Sean Murphy <sean@iamseanmurphy.com>
 * @copyright Copyright 2012 Sean Murphy. All rights reserved.
 * @license http://creativecommons.org/publicdomain/zero/1.0/
 *
 * @param string $str
 * @param array $options
 * @return string
 */
public static function eliminarSignos($str, $longitud = 0,$options = array()) {
	// Make sure string is in UTF-8 and strip invalid UTF-8 characters
	$str = mb_convert_encoding((string)$str, 'UTF-8', mb_list_encodings());
	
	$defaults = array(
		'delimiter' => '-',
		'limit' => $longitud>0?$longitud:(strlen($str)>62?62:null),
		'lowercase' => true,
		'replacements' => array(),
		'transliterate' => false,
	);
	
	// Merge options
	$options = array_merge($defaults, $options);
	
	$char_map = array(
		// Latin
		'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'A', 'Å' => 'A', 'Æ' => 'AE', 'Ç' => 'C', 
		'È' => 'E', 'É' => 'E', 'Ê' => 'E', 'Ë' => 'E', 'Ì' => 'I', 'Í' => 'I', 'Î' => 'I', 'Ï' => 'I', 
		'Ð' => 'D', 'Ñ' => 'N', 'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O', 'Ö' => 'O', 'Ő' => 'O', 
		'Ø' => 'O', 'Ù' => 'U', 'Ú' => 'U', 'Û' => 'U', 'Ü' => 'U', 'Ű' => 'U', 'Ý' => 'Y', 'Þ' => 'TH', 
		'ß' => 'ss', 
		'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a', 'ä' => 'a', 'å' => 'a', 'æ' => 'ae', 'ç' => 'c', 
		'è' => 'e', 'é' => 'e', 'ê' => 'e', 'ë' => 'e', 'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i', 
		'ð' => 'd', 'ñ' => 'n', 'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'õ' => 'o', 'ö' => 'o', 'ő' => 'o', 
		'ø' => 'o', 'ù' => 'u', 'ú' => 'u', 'û' => 'u', 'ü' => 'u', 'ű' => 'u', 'ý' => 'y', 'þ' => 'th', 
		'ÿ' => 'y',
 
		// Latin symbols
		'©' => '(c)',
 
		// Greek
		'Α' => 'A', 'Β' => 'B', 'Γ' => 'G', 'Δ' => 'D', 'Ε' => 'E', 'Ζ' => 'Z', 'Η' => 'H', 'Θ' => '8',
		'Ι' => 'I', 'Κ' => 'K', 'Λ' => 'L', 'Μ' => 'M', 'Ν' => 'N', 'Ξ' => '3', 'Ο' => 'O', 'Π' => 'P',
		'Ρ' => 'R', 'Σ' => 'S', 'Τ' => 'T', 'Υ' => 'Y', 'Φ' => 'F', 'Χ' => 'X', 'Ψ' => 'PS', 'Ω' => 'W',
		'Ά' => 'A', 'Έ' => 'E', 'Ί' => 'I', 'Ό' => 'O', 'Ύ' => 'Y', 'Ή' => 'H', 'Ώ' => 'W', 'Ϊ' => 'I',
		'Ϋ' => 'Y',
		'α' => 'a', 'β' => 'b', 'γ' => 'g', 'δ' => 'd', 'ε' => 'e', 'ζ' => 'z', 'η' => 'h', 'θ' => '8',
		'ι' => 'i', 'κ' => 'k', 'λ' => 'l', 'μ' => 'm', 'ν' => 'n', 'ξ' => '3', 'ο' => 'o', 'π' => 'p',
		'ρ' => 'r', 'σ' => 's', 'τ' => 't', 'υ' => 'y', 'φ' => 'f', 'χ' => 'x', 'ψ' => 'ps', 'ω' => 'w',
		'ά' => 'a', 'έ' => 'e', 'ί' => 'i', 'ό' => 'o', 'ύ' => 'y', 'ή' => 'h', 'ώ' => 'w', 'ς' => 's',
		'ϊ' => 'i', 'ΰ' => 'y', 'ϋ' => 'y', 'ΐ' => 'i',
 
		// Turkish
		'Ş' => 'S', 'İ' => 'I', 'Ç' => 'C', 'Ü' => 'U', 'Ö' => 'O', 'Ğ' => 'G',
		'ş' => 's', 'ı' => 'i', 'ç' => 'c', 'ü' => 'u', 'ö' => 'o', 'ğ' => 'g', 
 
		// Russian
		'А' => 'A', 'Б' => 'B', 'В' => 'V', 'Г' => 'G', 'Д' => 'D', 'Е' => 'E', 'Ё' => 'Yo', 'Ж' => 'Zh',
		'З' => 'Z', 'И' => 'I', 'Й' => 'J', 'К' => 'K', 'Л' => 'L', 'М' => 'M', 'Н' => 'N', 'О' => 'O',
		'П' => 'P', 'Р' => 'R', 'С' => 'S', 'Т' => 'T', 'У' => 'U', 'Ф' => 'F', 'Х' => 'H', 'Ц' => 'C',
		'Ч' => 'Ch', 'Ш' => 'Sh', 'Щ' => 'Sh', 'Ъ' => '', 'Ы' => 'Y', 'Ь' => '', 'Э' => 'E', 'Ю' => 'Yu',
		'Я' => 'Ya',
		'а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd', 'е' => 'e', 'ё' => 'yo', 'ж' => 'zh',
		'з' => 'z', 'и' => 'i', 'й' => 'j', 'к' => 'k', 'л' => 'l', 'м' => 'm', 'н' => 'n', 'о' => 'o',
		'п' => 'p', 'р' => 'r', 'с' => 's', 'т' => 't', 'у' => 'u', 'ф' => 'f', 'х' => 'h', 'ц' => 'c',
		'ч' => 'ch', 'ш' => 'sh', 'щ' => 'sh', 'ъ' => '', 'ы' => 'y', 'ь' => '', 'э' => 'e', 'ю' => 'yu',
		'я' => 'ya',
 
		// Ukrainian
		'Є' => 'Ye', 'І' => 'I', 'Ї' => 'Yi', 'Ґ' => 'G',
		'є' => 'ye', 'і' => 'i', 'ї' => 'yi', 'ґ' => 'g',
 
		// Czech
		'Č' => 'C', 'Ď' => 'D', 'Ě' => 'E', 'Ň' => 'N', 'Ř' => 'R', 'Š' => 'S', 'Ť' => 'T', 'Ů' => 'U', 
		'Ž' => 'Z', 
		'č' => 'c', 'ď' => 'd', 'ě' => 'e', 'ň' => 'n', 'ř' => 'r', 'š' => 's', 'ť' => 't', 'ů' => 'u',
		'ž' => 'z', 
 
		// Polish
		'Ą' => 'A', 'Ć' => 'C', 'Ę' => 'e', 'Ł' => 'L', 'Ń' => 'N', 'Ó' => 'o', 'Ś' => 'S', 'Ź' => 'Z', 
		'Ż' => 'Z', 
		'ą' => 'a', 'ć' => 'c', 'ę' => 'e', 'ł' => 'l', 'ń' => 'n', 'ó' => 'o', 'ś' => 's', 'ź' => 'z',
		'ż' => 'z',
 
		// Latvian
		'Ā' => 'A', 'Č' => 'C', 'Ē' => 'E', 'Ģ' => 'G', 'Ī' => 'i', 'Ķ' => 'k', 'Ļ' => 'L', 'Ņ' => 'N', 
		'Š' => 'S', 'Ū' => 'u', 'Ž' => 'Z',
		'ā' => 'a', 'č' => 'c', 'ē' => 'e', 'ģ' => 'g', 'ī' => 'i', 'ķ' => 'k', 'ļ' => 'l', 'ņ' => 'n',
		'š' => 's', 'ū' => 'u', 'ž' => 'z'
	);
	
	// Make custom replacements
	$str = preg_replace(array_keys($options['replacements']), $options['replacements'], $str);
	
	// Transliterate characters to ASCII
	if ($options['transliterate']) {
		$str = str_replace(array_keys($char_map), $char_map, $str);
	}
	
	// Replace non-alphanumeric characters with our delimiter
	$str = preg_replace('/[^\p{L}\p{Nd}]+/u', $options['delimiter'], $str);
	
	// Remove duplicate delimiters
	$str = preg_replace('/(' . preg_quote($options['delimiter'], '/') . '){2,}/', '$1', $str);
	
	// Truncate slug to max. characters
	$str = mb_substr($str, 0, ($options['limit'] ? $options['limit'] : mb_strlen($str, 'UTF-8')), 'UTF-8');
	
	// Remove delimiter from ends
	$str = trim($str, $options['delimiter']);
	
	return $options['lowercase'] ? mb_strtolower($str, 'UTF-8') : $str;
}
    
    public static function findCodeVideo($link)
    {
        
        $ps1 = strpos($link, '=');
        $pret = str_split($link, $ps1+1);
        $rs = $pret[1];
        if(!is_bool(strpos($pret[1], '&')))
        {
                $ps2 = strpos($pret[1], '&');
                $tmp = str_split($pret[1], $ps2);
                $rs = $tmp[0];
        }
        return '<iframe src="http://www.youtube.com/embed/'.$rs.'" frameborder="0" width="425" height="350"></iframe>';        
    }
    
        
    public static function getFoto($name)
    {
        $im = @imagecreatefromjpeg(Yii::app()->basePath.DIRECTORY_SEPARATOR."fotos".DIRECTORY_SEPARATOR.$name);

       /* Ver si falló */
        if(!$im)
        {
            /* Crear una imagen en blanco */
            $im  = imagecreatetruecolor(150, 30);
            $fondo = imagecolorallocate($im, 255, 255, 255);
            $ct  = imagecolorallocate($im, 0, 0, 0);
            imagefilledrectangle($im, 0, 0, 150, 30, $fondo);
            /* Imprimir un mensaje de error */
            imagestring($im, 1, 5, 5, 'Error cargando ' . $fondo, $ct);
        }
        return $im;

    }
    
    public static function getMeses()
    {
    	return array('Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre');
    }
    
    public static function getDias()
    {
    	$dias = array();
    	for($i=1;$i<=31;$i++)
    	{
    		$dias[$i]=$i;
    	}
    	
    	return $dias;
    }
    
    public static function getAnios()
    {
    	$anios = array();
    	for($i=1905;$i<=date("Y",time());$i++)
    	{
    	$anios[$i]=$i;
    	}    	 
    	return array_reverse($anios,true);
    }
    
    public static function getToken()
    {
    	return sha1(uniqid(mt_rand(), true));
    }
    
    //Pasar de esto www.miweb.com a esto <a href="http://www.miweb.com">www.miweb.com</a>
    function replace_urls($string){
    	$host = "([a-z\d][-a-z\d]*[a-z\d]\.)+[a-z][-a-z\d]*[a-z]";
    	$port = "(:\d{1,})?";
    	$path = "(\/[^?<>\#\"\s]+)?";
    	$query = "(\?[^<>\#\"\s]+)?";
    	return preg_replace("#((ht|f)tps?:\/\/{$host}{$port}{$path}{$query})#i", "<a href='$1'>$1</a>", $string);
    }
    
    
    public static function generarResumen($text)
    {
        preg_match('/^([^.!?]*[\.!?]+){0,1}/', strip_tags($text), $abstract);
        if(strlen($abstract[0])>300)
        {
            $abstract[0] = substr($abstract[0], 0, 300);  
        }
        return $abstract[0];
    }
    
    public static function getImageFromText($content)
    {
        if(strlen($content)>0)
        {
            $dom = new domDocument;

            /*** load the html into the object ***/
            $dom->loadHTML($content);

            /*** discard white space ***/
            $dom->preserveWhiteSpace = false;

            $images = $dom->getElementsByTagName('img');

            foreach($images as $img)
            {          
                return $img->getAttribute('src');
                break;
            }
        }        
        
        return null;
    }
    
    public static function getImagesFromText($content)
    {
        if(strlen($content)>0)
        {
            $dom = new domDocument;

            /*** load the html into the object ***/
            $dom->loadHTML($content);

            /*** discard white space ***/
            $dom->preserveWhiteSpace = false;

            $images = $dom->getElementsByTagName('img');

            return $images;
        }
        return null;
    }
    
    public static function removeEmptyParrafo($text)
    {
       return preg_replace("/<p[^>]*>[\s| ]*<\/p>/", '', $text);        
    }
}

?>
