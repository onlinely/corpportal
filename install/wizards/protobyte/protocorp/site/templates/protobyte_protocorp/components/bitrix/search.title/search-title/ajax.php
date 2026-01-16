<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
if (empty($arResult["CATEGORIES"]) || !$arResult['CATEGORIES_ITEMS_EXISTS'])
	return;
?>
<div class="search-title">
	<?foreach($arResult["CATEGORIES"] as $category_id => $arCategory):?>
		<?foreach($arCategory["ITEMS"] as $i => $arItem):?>
			<?if($category_id === "all"):
				?>
				<div class="search-title__result-item">
					<a class="search-title__result-item-link" href="<?echo $arItem["URL"]?>"><?echo $arItem["NAME"]?></a>
				</div>
			<?elseif(isset($arResult["ELEMENTS"][$arItem["ITEM_ID"]])):
				$arElement = $arResult["ELEMENTS"][$arItem["ITEM_ID"]];?>
				<div class="search-title__result-item">
					<a class="search-title__result-item-link" href="<?echo $arItem["URL"]?>">
						<?if (is_array($arElement["PICTURE"])):?>
							<div class="search-title__result-item-image-container">
								<div class="search-title__result-item-image"
									style="
										background-image: url('<?echo $arElement["PICTURE"]["src"]?>');
										width:<?=$arElement["PICTURE"]["width"]?>px;
										height:<?=$arElement["PICTURE"]["height"]?>px;
										">
								</div>
							</div>
						<?endif;?>
						<div class="search-title__result-item-info">
							<?echo $arItem["NAME"]?>
							<?
							foreach($arElement["PRICES"] as $code=>$arPrice)
							{
								if ($arPrice["MIN_PRICE"] != "Y")
									continue;

								if($arPrice["CAN_ACCESS"])
								{
									if($arPrice["DISCOUNT_VALUE"] < $arPrice["VALUE"]):?>
										<div class="search-title__result-item-price">
											<span class="search-title__result-item-current-price"><?=$arPrice["PRINT_DISCOUNT_VALUE"]?></span>
											<span class="search-title__result-item-old-price"><?=$arPrice["PRINT_VALUE"]?></span>
										</div>
									<?else:?>
										<div class="search-title__result-item-price">
											<span class="search-title__result-item-current-price"><?=$arPrice["PRINT_VALUE"]?></span>
										</div>
									<?endif;
								}
								if ($arPrice["MIN_PRICE"] == "Y")
									break;
							}
							?>
						</div>
					</a>
				</div>
			<?else:?>
				<div class="search-title__result-item">
					<a class="search-title__result-item-link" href="<?echo $arItem["URL"]?>"><?echo $arItem["NAME"]?></a>
				</div>
			<?endif;?>
		<?endforeach;?>
	<?endforeach;?>
</div>