<?php

//Zip Class
require("ss_zip.class.php");

// All possible languages available, used for selecting the right language file.
$languages = array(
    'af' => 'african',
    'sq' => 'albanian',
    'ar' => 'arabic',
    'ar-dz' => 'arabic', // algeria
    'ar-bh' => 'arabic', // bahrain
    'ar-eg' => 'arabic', // egypt
    'ar-iq' => 'arabic', // iraq
    'ar-jo' => 'arabic', // jordan
    'ar-kw' => 'arabic', // kuwait
    'ar-lb' => 'arabic', // lebanon
    'ar-ly' => 'arabic', // libya
    'ar-ma' => 'arabic', // morocco
    'ar-om' => 'arabic', // oman
    'ar-qa' => 'arabic', // qatar
    'ar-sa' => 'arabic', // Saudi Arabia
    'ar-sy' => 'arabic', // syria
    'ar-tn' => 'arabic', // tunisia
    'ar-ae' => 'arabic', // U.A.E
    'ar-ye' => 'arabic', // yemen
    'hy' => 'armenian',
    'ast' => 'asturian',
    'eu' => 'basque',
    'be' => 'belarusian',
    'bs' => 'bosnian',
    'bg' => 'bulgarian',
    'ca' => 'catalan',
    'zh' => 'chinese',
    'zh-smp' => 'chinese simplified', // China Simplified
    'zh-cn' => 'chinese', // China
    'zh-hk' => 'chinese', // Hong Kong
    'zh-sg' => 'chinese', // Singapore
    'zh-tw' => 'chinese', // Taiwan
    'hr' => 'croatian',
    'cs' => 'czech',
    'da' => 'danish',
    'nl' => 'dutch',
    'nl-be' => 'dutch', // Belgium
    'en' => 'english',
    'en-au' => 'english', // Australia
    'en-bz' => 'english', // Belize
    'en-ca' => 'english', // Canada
    'en-ie' => 'english', // Ireland
    'en-jm' => 'english', // Jamaica
    'en-nz' => 'english', // New Zealand
    'en-ph' => 'english', // Philippines
    'en-za' => 'english', // South Africa
    'en-tt' => 'english', // Trinidad
    'en-gb' => 'english', // United Kingdom
    'en-us' => 'english', // United States
    'en-zw' => 'english', // Zimbabwe
    'eo' => 'esperanto',
    'et' => 'estonian',
    'fo' => 'faeroese',
    'fi' => 'finnish',
    'fr' => 'french',
    'fr-be' => 'french', // Belgium
    'fr-ca' => 'french', // Canada
    'fr-fr' => 'french', // France
    'fr-lu' => 'french', // Luxembourg
    'fr-mc' => 'french', // Monaco
    'fr-ch' => 'french', // Switzerland
    'gl' => 'galician',
    'ka' => 'georgian',
    'de' => 'german',
    'de-at' => 'german', // Austria
    'de-de' => 'german', // Germany
    'de-li' => 'german', // Liechtenstein
    'de-lu' => 'german', // Luxembourg
    'de-ch' => 'german', // Switzerland
    'el' => 'greek',
    'he' => 'hebrew',
    'hu' => 'hungarian',
    'is' => 'icelandic',
    'id' => 'indonesian',
    'ga' => 'irish',
    'it' => 'italian',
    'it-ch' => 'italian', // Switzerland
    'ja' => 'japanese',
    'ko' => 'korean',
    'ko-kp' => 'korean', // North Korea
    'ko-kr' => 'korean', // South Korea
    'lv' => 'latvian',
    'lt' => 'lithuanian',
    'mk' => 'macedonian',
    'ms' => 'malay',
    'no' => 'norwegian',
    'nb' => 'norwegian bokmal',
    'nn' => 'norwegian nynorsk',
    'pl' => 'polish',
    'pt' => 'portuguese',
    'pt-br' => 'portuguese', // Brazil
    'ro' => 'romanian',
    'ru' => 'russian',
    'gd' => 'scots gealic',
    'sr' => 'serbian',
    'sk' => 'slovak',
    'sl' => 'slovenian',
    'es' => 'spanish',
    'es-ar' => 'spanish', // Argentina
    'es-bo' => 'spanish', // Bolivia
    'es-cl' => 'spanish', // Chile
    'es-co' => 'spanish', // Colombia
    'es-cr' => 'spanish', // Costa Rica
    'es-do' => 'spanish', // Dominican Republic
    'es-ec' => 'spanish', // Ecuador
    'es-sv' => 'spanish', // El Salvador
    'es-gt' => 'spanish', // Guatemala
    'es-hn' => 'spanish', // Honduras
    'es-mx' => 'spanish', // Mexico
    'es-ni' => 'spanish', // Nicaragua
    'es-pa' => 'spanish', // Panama
    'es-py' => 'spanish', // Paraguay
    'es-pe' => 'spanish', // Peru
    'es-pr' => 'spanish', // Puerto Rico
    'es-es' => 'spanish', // Spain
    'es-uy' => 'spanish', // Uruguay
    'es-ve' => 'spanish', // Venezuela
    'sv' => 'swedish',
    'sv-fi' => 'swedish', // Finland
    'th' => 'thai',
    'tr' => 'turkish',
    'uk' => 'ukrainian',
    'vi' => 'vietnamese',
    'cy' => 'welsh',
    'xh' => 'xhosa',
    'yi' => 'yiddish',
    'zu' => 'zulu'
);

	function array_sort_multi($array, $key,$key2)

	{
	  foreach ($array as $i => $k) { 
		   if(! empty($array[$i][$key][$key2])){
		   $sort_values[$i] = $array[$i][$key][$key2];
		   }else{
		   $sort_values[$i] = $array[$i];
		   }
	  } 
	  asort ($sort_values);
	  reset ($sort_values);
	  while (list ($arr_keys, $arr_values) = each ($sort_values)) {
			 $sorted_arr[] = $array[$arr_keys];
	  }
	  return $sorted_arr;
	} 

	function directoryPath($string, $server) {
		$stringArray = split("/",$string);
		$level = count($stringArray);

		$down = "";
		$levelCount=0;
		while($levelCount<$level-1) {
			$down .= "../";
			$levelCount++;
		}
		$returnString = "<A HREF=\"javascript:submitForm('cd', '" . $down . "')\" style='text-decoration:underline;'>&lt;" . $server . "&gt;</A>";
		foreach($stringArray as $str) {
			$down = "";
			$level = $level - 1;
			$levelCount=0;
			while($levelCount<$level) {
				$down .= "../";
				$levelCount++;
			}

			if($level>=0) {
				$returnString .= "<A HREF=\"javascript:submitForm('cd', '" . $down . "')\" style='text-decoration:underline;'>" .  $str . "</A>/";
			}
		}
		return $returnString;
	}

	function filePart($string) {
		$stringArray = explode("/",$string);
		$level = count($stringArray);
		if ($stringArray[$level-1]=="")
			return $stringArray[$level-2];
		else
			return $stringArray[$level-1];
	}


	function fileDescription($filename){
		$ext = strtolower(getExtention($filename));
		if($ext == 'png' OR $ext == 'gif' OR $ext == 'jpg' OR $ext == 'psp' OR $ext == 'bmp' OR $ext == 'ai' OR $ext == 'tiff'){
	    	$res['imgfilename'] = 'pic.gif';
			$res['description'] = strtoupper($ext).' Image/Picture';
	 	}elseif($ext == 'html' OR $ext == 'htm'){
	    	$res['imgfilename'] = 'html.gif';
			$res['description'] = 'HTML Document';
	 	}elseif($ext == 'css'){
	 		$res['imgfilename'] = 'txt.gif';
			$res['description'] = 'Stylesheet';
	 	}elseif($ext == 'doc'){
	 		$res['imgfilename'] = 'doc.gif';
			$res['description'] = 'Microsoft Word Document';
	 	}elseif($ext == 'pdf'){
	 		$res['imgfilename'] = 'pdf.gif';
			$res['description'] = 'PDF Document';
		}elseif($ext == 'php' OR $ext == 'php3'){
			$res['imgfilename'] = 'php.gif';
			$res['description'] = 'PHP Script';
		}elseif($ext == 'js'){
			$res['imgfilename'] = 'js.gif';
			$res['description'] = 'Javascript';
		}elseif($ext == 'swf'){
			$res['imgfilename'] = 'pic.gif';
			$res['description'] = 'Flash file';
		}elseif($ext == 'txt'){
			$res['imgfilename'] = 'txt.gif';
			$res['description'] = 'Textfile';
		}elseif($ext == 'avi' OR $ext == 'mov' OR $ext == 'mpg' OR $ext == 'rm'){
			$res['imgfilename'] = 'mov.gif';
			$res['description'] = 'Video file';
		}elseif($ext == 'mp3' OR $ext == 'wav' OR $ext == 'ogg'){
			$res['imgfilename'] = 'mov.gif';
			$res['description'] = 'Audio file';
		}elseif($ext == 'zip' OR $ext == 'rar' OR $ext == 'cab' OR $ext == 'b2z'){
			$res['imgfilename'] = 'zip.gif';
			$res['description'] = 'Compressed file';
		}elseif($ext == 'exe' OR $ext == 'com' OR $ext == 'bat'){
			$res['imgfilename'] = 'exe.gif';
			$res['description'] = 'Application';
		}else{
			$res['imgfilename'] = 'file.gif';
			$res['description'] = $ext . ' File';
		}
		return $res;
	}

	function getExtention($filename){
		if(($dotpos = strrpos($filename, '.')) === false){
			return false;
		}else{
			return substr($filename, $dotpos+1);
		}
	}

	function deleteRecursive($dirname) 
	{ // recursive function to delete  
	  // all subdirectories and contents: 
	  if(is_dir($dirname))$dir_handle=opendir($dirname); 
	  while($file=readdir($dir_handle)) 
	  { 
		if($file!="." && $file!="..") 
		{ 
		  if(!is_dir($dirname."/".$file))unlink ($dirname."/".$file); 
		  else deleteRecursive($dirname."/".$file); 
		} 
	  } 
	  closedir($dir_handle); 
	  rmdir($dirname); 
	  return true; 
	} 
?>
