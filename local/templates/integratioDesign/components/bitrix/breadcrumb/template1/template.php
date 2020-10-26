<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

/**
 * @global CMain $APPLICATION
 */

global $APPLICATION;

//delayed function must return a string
if(empty($arResult))
	return "";

$strReturn = '';

// <div class="breadcrumbs-box">
//             <div class="inner-wrap">
//                 <a href="$arResult[$index]["LINK"]">$title</a>
             
//                 <span>$title</span>
//             </div>
//         </div>




$strReturn .= '<div class="bc_breadcrumbs"><ul>';

$itemSize = count($arResult);
for($index = 0; $index < $itemSize; $index++)
{
	$title = htmlspecialcharsex($arResult[$index]["TITLE"]);
//	if($arResult[$index]["LINK"] <> "" && $index != $itemSize-1)
	//{
		$strReturn .= '<li><a href="'.$arResult[$index]["LINK"].' ">'.$title .'</a></li>';
//	}
//	else
//	{
//		$strReturn .= '<li>'.$title.'</li>';
//	}
}

$strReturn .= '<div class="clearboth"></div>'.'</ul></div>';

return $strReturn;
