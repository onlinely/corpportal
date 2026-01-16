<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

/**
 * @global CMain $APPLICATION
 */

global $APPLICATION;

if(empty($arResult))
	return "";

$strReturn = '';?>
<?
$strReturn .= '<div id="breadcrumbs">


		<div class="breadcrumbs swipeignore">';

$itemSize = count($arResult);
for($index = 0; $index < $itemSize; $index++)
{
	$title = htmlspecialcharsex($arResult[$index]["TITLE"]);
	$arrow = ($index > 0? '' : '');
	if($arResult[$index]["LINK"] <> "" && $index != $itemSize-1)
	{
		$strReturn .=  $arrow.'
		<div class="breadcrumbs__item"><a class="breadcrumbs__link" href="'.$arResult[$index]["LINK"].'">
					<span class="breadcrumbs__item-name">'.$title.'</span>
				</a></div><span class="breadcrumbs__separator">/</span>';
	}
	else
	{
		$strReturn .= $arrow.'
		<div class="breadcrumbs__item"><span class="breadcrumbs__item-name">'.$title.'</span></div>
			';
	}
}

$strReturn .= '

</div>
</div>';

return $strReturn;

