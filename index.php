<?php
$lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
switch ($lang){
    case "de":
        //echo "PAGE DE";
        header("Location: http://www.casadilavanda.com/de/");
		exit;
        break;
    case "it":
        //echo "PAGE IT";
        header("Location: http://www.casadilavanda.com/en/");
		exit;
        break;
    case "en":
        //echo "PAGE EN";
        header("Location: http://www.casadilavanda.com/en/");
		exit;
        break;        
    default:
        //echo "PAGE EN - Setting Default";
        header("Location: http://www.casadilavanda.com/en/");
		exit;
        break;
}
?>