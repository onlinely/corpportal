<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
//data-da=".sort-panel,991,last"
?>
<div class="smart-filter__wrapper" data-da=".catalog-section__filter-mobile,991,last">
	<div class="smart-filter__spoiler">
      <div class="smart-filter__spoiler-btn">
        <span><?=GetMessage("CT_BCSF_FILTER_TITLE")?></span>
        <div class="smart-filter__spoiler-icon">
          <svg class="smart-filter__spoiler-open" width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M3.30769 5.61538C4.5822 5.61538 5.61538 4.5822 5.61538 3.30769C5.61538 2.03319 4.5822 1 3.30769 1C2.03319 1 1 2.03319 1 3.30769C1 4.5822 2.03319 5.61538 3.30769 5.61538Z"  stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
              <path d="M5.61523 3.30762H20.9998"  stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
              <path d="M11.0001 13.3078C12.2746 13.3078 13.3078 12.2746 13.3078 11.0001C13.3078 9.72557 12.2746 8.69238 11.0001 8.69238C9.72557 8.69238 8.69238 9.72557 8.69238 11.0001C8.69238 12.2746 9.72557 13.3078 11.0001 13.3078Z"  stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
              <path d="M1 11H8.69231"  stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
              <path d="M13.3076 11H20.9999"  stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
              <path d="M18.6925 21.0002C19.967 21.0002 21.0002 19.967 21.0002 18.6925C21.0002 17.418 19.967 16.3848 18.6925 16.3848C17.418 16.3848 16.3848 17.418 16.3848 18.6925C16.3848 19.967 17.418 21.0002 18.6925 21.0002Z"  stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
              <path d="M16.3846 18.6924H1"  stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
          </svg>
          <svg class="smart-filter__spoiler-close" width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M21 1L1 21" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
              <path d="M1 1L21 21" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
          </svg>
        </div>
      </div>
    </div>
	<div class="smart-filter">
		<div class="smart-filter-section bx-filter">
			<div class="smart-filter__title"><?=GetMessage("CT_BCSF_FILTER_TITLE")?></div>
				<form name="<?echo $arResult["FILTER_NAME"]."_form"?>" action="<?echo $arResult["FORM_ACTION"]?>" method="get" class="smartfilter">
					<div class="smart-filter__form-wrapper">
						<?foreach($arResult["HIDDEN"] as $arItem):?>
							<input type="hidden" name="<?echo $arItem["CONTROL_NAME"]?>" id="<?echo $arItem["CONTROL_ID"]?>" value="<?echo $arItem["HTML_VALUE"]?>" />
						<?endforeach;?>
						<?foreach($arResult["ITEMS"] as $key=>$arItem)//prices
						{
							$key = $arItem["ENCODED_ID"];
							if(isset($arItem["PRICE"])):
								if ($arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"] <= 0)
									continue;

								$step_num = 4;
								$step = ($arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"]) / $step_num;
								$prices = array();
								if (Bitrix\Main\Loader::includeModule("currency"))
								{
									for ($i = 0; $i < $step_num; $i++)
									{
										$prices[$i] = CCurrencyLang::CurrencyFormat($arItem["VALUES"]["MIN"]["VALUE"] + $step*$i, $arItem["VALUES"]["MIN"]["CURRENCY"], false);
									}
									$prices[$step_num] = CCurrencyLang::CurrencyFormat($arItem["VALUES"]["MAX"]["VALUE"], $arItem["VALUES"]["MAX"]["CURRENCY"], false);
								}
								else
								{
									$precision = $arItem["DECIMALS"]? $arItem["DECIMALS"]: 0;
									for ($i = 0; $i < $step_num; $i++)
									{
										$prices[$i] = number_format($arItem["VALUES"]["MIN"]["VALUE"] + $step*$i, $precision, ".", "");
									}
									$prices[$step_num] = number_format($arItem["VALUES"]["MAX"]["VALUE"], $precision, ".", "");
								}
								?>
								<div class="bx-filter-parameters-box bx-active smart-filter-parameters-box ">
									<span class="bx-filter-container-modef"></span>
									<div class="smart-filter-parameters-box-title" onclick="smartFilter.hideFilterProps(this)">
										<span class="smart-filter-parameters-box-title-text"><?=$arItem["NAME"]?></span>
										<span class="smart-filter-angle smart-filter-angle-up">
											<span data-role="prop_angle" class="smart-filter-angles <?if ($arItem["DISPLAY_EXPANDED"]== "Y"):?>_onlinely-arrow-top<?else:?>_onlinely-arrow-bottom<?endif?>">
												<svg width="10" height="7" viewBox="0 0 10 7" fill="none" xmlns="http://www.w3.org/2000/svg">
													<path d="M1 5.5L4.78462 1.59618C4.81224 1.56582 4.8456 1.54162 4.88265 1.52508C4.91969 1.50853 4.95963 1.5 5 1.5C5.04037 1.5 5.08031 1.50853 5.11735 1.52508C5.1544 1.54162 5.18776 1.56582 5.21538 1.59618L9 5.5" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
												</svg>
											</spa>
										</span>
									</div>

									<div class="bx-filter-block smart-filter-block" data-role="bx_filter_block">
										<div class="bx-filter-parameters-box-container smart-filter-parameters-box-container">
											<div class="smart-filter-input-group-numbe__wrapper">
												<div class="form-group bx-filter-parameters-box-container-block">
													<div class="bx-filter-input-container smart-filter-input-container">
														<input
															class="min-price form-control form-control-sm"
															type="text"
															name="<?echo $arItem["VALUES"]["MIN"]["CONTROL_NAME"]?>"
															id="<?echo $arItem["VALUES"]["MIN"]["CONTROL_ID"]?>"
															value="<?echo $arItem["VALUES"]["MIN"]["HTML_VALUE"]?>"
															placeholder="<?=$arItem["VALUES"]["MIN"]["VALUE"]?>"
															onkeyup="smartFilter.keyup(this)"
														/>
													</div>
												</div>
												<div class="form-group bx-filter-parameters-box-container-block">
													<div class="bx-filter-input-container smart-filter-input-container">
														<input
															class="max-price form-control form-control-sm"
															type="text"
															name="<?echo $arItem["VALUES"]["MAX"]["CONTROL_NAME"]?>"
															id="<?echo $arItem["VALUES"]["MAX"]["CONTROL_ID"]?>"
															value="<?echo $arItem["VALUES"]["MAX"]["HTML_VALUE"]?>"
															placeholder="<?=$arItem["VALUES"]["MAX"]["VALUE"]?>"
															onkeyup="smartFilter.keyup(this)"
														/>
													</div>
												</div>
											</div>
											<div class="bx-ui-slider-track-container">
												<div class="bx-ui-slider-track" id="drag_track_<?=$key?>">
													<?for($i = 0; $i <= $step_num; $i++):?>
													<div class="bx-ui-slider-part p<?=$i+1?>"><span><?=$prices[$i]?></span></div>
													<?endfor;?>

													<div class="bx-ui-slider-pricebar-vd" style="left: 0;right: 0;" id="colorUnavailableActive_<?=$key?>"></div>
													<div class="bx-ui-slider-pricebar-vn" style="left: 0;right: 0;" id="colorAvailableInactive_<?=$key?>"></div>
													<div class="bx-ui-slider-pricebar-v"  style="left: 0;right: 0;" id="colorAvailableActive_<?=$key?>"></div>
													<div class="bx-ui-slider-range" id="drag_tracker_<?=$key?>"  style="left: 0%; right: 0%;">
														<a class="bx-ui-slider-handle left"  style="left:0;" href="javascript:void(0)" id="left_slider_<?=$key?>">
															<span class="bx-ui-slider-handle-point"></span>
														</a>
														<a class="bx-ui-slider-handle right" style="right:0;" href="javascript:void(0)" id="right_slider_<?=$key?>">
															<span class="bx-ui-slider-handle-point"></span>
														</a>
													</div>
												</div>
											</div>
										</div>
									</div>
								
								
								
								</div>
								<?
								$arJsParams = array(
									"leftSlider" => 'left_slider_'.$key,
									"rightSlider" => 'right_slider_'.$key,
									"tracker" => "drag_tracker_".$key,
									"trackerWrap" => "drag_track_".$key,
									"minInputId" => $arItem["VALUES"]["MIN"]["CONTROL_ID"],
									"maxInputId" => $arItem["VALUES"]["MAX"]["CONTROL_ID"],
									"minPrice" => $arItem["VALUES"]["MIN"]["VALUE"],
									"maxPrice" => $arItem["VALUES"]["MAX"]["VALUE"],
									"curMinPrice" => $arItem["VALUES"]["MIN"]["HTML_VALUE"],
									"curMaxPrice" => $arItem["VALUES"]["MAX"]["HTML_VALUE"],
									"fltMinPrice" => intval($arItem["VALUES"]["MIN"]["FILTERED_VALUE"]) ? $arItem["VALUES"]["MIN"]["FILTERED_VALUE"] : $arItem["VALUES"]["MIN"]["VALUE"] ,
									"fltMaxPrice" => intval($arItem["VALUES"]["MAX"]["FILTERED_VALUE"]) ? $arItem["VALUES"]["MAX"]["FILTERED_VALUE"] : $arItem["VALUES"]["MAX"]["VALUE"],
									"precision" => $precision,
									"colorUnavailableActive" => 'colorUnavailableActive_'.$key,
									"colorAvailableActive" => 'colorAvailableActive_'.$key,
									"colorAvailableInactive" => 'colorAvailableInactive_'.$key,
								);
								?>
								<script type="text/javascript">
									BX.ready(function(){
										window['trackBar<?=$key?>'] = new BX.Iblock.SmartFilter(<?=CUtil::PhpToJSObject($arJsParams)?>);
									});
								</script>
							<?endif;
						}

						//not prices
						foreach($arResult["ITEMS"] as $key=>$arItem)
						{
							if(
								empty($arItem["VALUES"])
								|| isset($arItem["PRICE"])
							)
								continue;

							if (
								$arItem["DISPLAY_TYPE"] == "A"
								&& (
									$arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"] <= 0
								)
							)
								continue;
							?>
							<div class="bx-filter-parameters-box smart-filter-parameters-box  <?if ($arItem["DISPLAY_EXPANDED"]== "Y"):?>bx-active<?endif?>">
								<span class="bx-filter-container-modef"></span>
								<div class="smart-filter-parameters-box-title" onclick="smartFilter.hideFilterProps(this)">
									<div class="smart-filter-parameters-box-title__wrap">
										<span class="bx-filter-parameters-box-hint smart-filter-parameters-box-title-text"><?=$arItem["NAME"]?></span>
										<?if ($arItem["FILTER_HINT"] <> ""):?>
											<span id="item_title_hint_<?echo $arItem["ID"]?>" class="smart-filter-question">?</span>
											<script type="text/javascript">
												new top.BX.CHint({
													parent: top.BX("item_title_hint_<?echo $arItem["ID"]?>"),
													show_timeout: 10,
													hide_timeout: 200,
													dx: 2,
													preventHide: true,
													min_width: 250,
													hint: '<?= CUtil::JSEscape($arItem["FILTER_HINT"])?>'
												});
											</script>
										<?endif?>
									</div>
									<span class="smart-filter-angle smart-filter-angle-up">
										<span data-role="prop_angle" class="smart-filter-angles <?if ($arItem["DISPLAY_EXPANDED"]== "Y"):?>_onlinely-arrow-top<?else:?>_onlinely-arrow-bottom<?endif?>">
											<svg width="10" height="7" viewBox="0 0 10 7" fill="none" xmlns="http://www.w3.org/2000/svg">
												<path d="M1 5.5L4.78462 1.59618C4.81224 1.56582 4.8456 1.54162 4.88265 1.52508C4.91969 1.50853 4.95963 1.5 5 1.5C5.04037 1.5 5.08031 1.50853 5.11735 1.52508C5.1544 1.54162 5.18776 1.56582 5.21538 1.59618L9 5.5" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
											</svg>
										</spa>
									</span>
								</div>

								<div class="bx-filter-block smart-filter-block" data-role="bx_filter_block">
									<div class="smart-filter-parameters-box-container">
									<?
									$arCur = current($arItem["VALUES"]);
									switch ($arItem["DISPLAY_TYPE"])
									{
										case "A"://NUMBERS_WITH_SLIDER
											?>
											<div class="smart-filter-input-group-numbe__wrapper">
												<div class="form-group bx-filter-parameters-box-container-block">
													<div class="bx-filter-input-container smart-filter-input-container">
														<input
															class="min-price form-control form-control-sm"
															type="text"
															name="<?echo $arItem["VALUES"]["MIN"]["CONTROL_NAME"]?>"
															id="<?echo $arItem["VALUES"]["MIN"]["CONTROL_ID"]?>"
															value="<?echo $arItem["VALUES"]["MIN"]["HTML_VALUE"]?>"
															placeholder="<?=$arItem["VALUES"]["MIN"]["VALUE"]?>"
															onkeyup="smartFilter.keyup(this)"
														/>
													</div>
												</div>
												<div class="form-group bx-filter-parameters-box-container-block">
													<div class="bx-filter-input-container smart-filter-input-container">
														<input
															class="max-price form-control form-control-sm"
															type="text"
															name="<?echo $arItem["VALUES"]["MAX"]["CONTROL_NAME"]?>"
															id="<?echo $arItem["VALUES"]["MAX"]["CONTROL_ID"]?>"
															value="<?echo $arItem["VALUES"]["MAX"]["HTML_VALUE"]?>"
															placeholder="<?=$arItem["VALUES"]["MAX"]["VALUE"]?>"
															onkeyup="smartFilter.keyup(this)"
														/>
													</div>
												</div>
											</div>
											<div class="bx-ui-slider-track-container">
												<div class="bx-ui-slider-track" id="drag_track_<?=$key?>">
													<?
													$precision = $arItem["DECIMALS"]? $arItem["DECIMALS"]: 0;
													$step = ($arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"]) / 4;
													$value1 = number_format($arItem["VALUES"]["MIN"]["VALUE"], $precision, ".", "");
													$value2 = number_format($arItem["VALUES"]["MIN"]["VALUE"] + $step, $precision, ".", "");
													$value3 = number_format($arItem["VALUES"]["MIN"]["VALUE"] + $step * 2, $precision, ".", "");
													$value4 = number_format($arItem["VALUES"]["MIN"]["VALUE"] + $step * 3, $precision, ".", "");
													$value5 = number_format($arItem["VALUES"]["MAX"]["VALUE"], $precision, ".", "");
													?>
													<div class="bx-ui-slider-part p1"><span><?=$value1?></span></div>
													<div class="bx-ui-slider-part p2"><span><?=$value2?></span></div>
													<div class="bx-ui-slider-part p3"><span><?=$value3?></span></div>
													<div class="bx-ui-slider-part p4"><span><?=$value4?></span></div>
													<div class="bx-ui-slider-part p5"><span><?=$value5?></span></div>

													<div class="bx-ui-slider-pricebar-vd" style="left: 0;right: 0;" id="colorUnavailableActive_<?=$key?>"></div>
													<div class="bx-ui-slider-pricebar-vn" style="left: 0;right: 0;" id="colorAvailableInactive_<?=$key?>"></div>
													<div class="bx-ui-slider-pricebar-v"  style="left: 0;right: 0;" id="colorAvailableActive_<?=$key?>"></div>
													<div class="bx-ui-slider-range" 	id="drag_tracker_<?=$key?>"  style="left: 0;right: 0;">
														<a class="bx-ui-slider-handle left"  style="left:0;" href="javascript:void(0)" id="left_slider_<?=$key?>">
															<span class="bx-ui-slider-handle-point"></span>
														</a>
														<a class="bx-ui-slider-handle right" style="right:0;" href="javascript:void(0)" id="right_slider_<?=$key?>">
															<span class="bx-ui-slider-handle-point"></span>
														</a>
													</div>
												</div>
											</div>
											<?
											$arJsParams = array(
												"leftSlider" => 'left_slider_'.$key,
												"rightSlider" => 'right_slider_'.$key,
												"tracker" => "drag_tracker_".$key,
												"trackerWrap" => "drag_track_".$key,
												"minInputId" => $arItem["VALUES"]["MIN"]["CONTROL_ID"],
												"maxInputId" => $arItem["VALUES"]["MAX"]["CONTROL_ID"],
												"minPrice" => $arItem["VALUES"]["MIN"]["VALUE"],
												"maxPrice" => $arItem["VALUES"]["MAX"]["VALUE"],
												"curMinPrice" => $arItem["VALUES"]["MIN"]["HTML_VALUE"],
												"curMaxPrice" => $arItem["VALUES"]["MAX"]["HTML_VALUE"],
												"fltMinPrice" => intval($arItem["VALUES"]["MIN"]["FILTERED_VALUE"]) ? $arItem["VALUES"]["MIN"]["FILTERED_VALUE"] : $arItem["VALUES"]["MIN"]["VALUE"] ,
												"fltMaxPrice" => intval($arItem["VALUES"]["MAX"]["FILTERED_VALUE"]) ? $arItem["VALUES"]["MAX"]["FILTERED_VALUE"] : $arItem["VALUES"]["MAX"]["VALUE"],
												"precision" => $arItem["DECIMALS"]? $arItem["DECIMALS"]: 0,
												"colorUnavailableActive" => 'colorUnavailableActive_'.$key,
												"colorAvailableActive" => 'colorAvailableActive_'.$key,
												"colorAvailableInactive" => 'colorAvailableInactive_'.$key,
											);
											?>
											<script type="text/javascript">
												BX.ready(function(){
													window['trackBar<?=$key?>'] = new BX.Iblock.SmartFilter(<?=CUtil::PhpToJSObject($arJsParams)?>);
												});
											</script>
											<?
											break;
										case "B"://NUMBERS
											?>
												<div class="smart-filter-input-group-numbe__wrapper">
												<div class="form-group bx-filter-parameters-box-container-block">
													<div class="bx-filter-input-container smart-filter-input-container">
														<input
															class="min-price form-control form-control-sm"
															type="text"
															name="<?echo $arItem["VALUES"]["MIN"]["CONTROL_NAME"]?>"
															id="<?echo $arItem["VALUES"]["MIN"]["CONTROL_ID"]?>"
															value="<?echo $arItem["VALUES"]["MIN"]["HTML_VALUE"]?>"
															placeholder="<?=$arItem["VALUES"]["MIN"]["VALUE"]?>"
															onkeyup="smartFilter.keyup(this)"
														/>
													</div>
												</div>
												<div class="form-group bx-filter-parameters-box-container-block">
													<div class="bx-filter-input-container smart-filter-input-container">
														<input
															class="max-price form-control form-control-sm"
															type="text"
															name="<?echo $arItem["VALUES"]["MAX"]["CONTROL_NAME"]?>"
															id="<?echo $arItem["VALUES"]["MAX"]["CONTROL_ID"]?>"
															value="<?echo $arItem["VALUES"]["MAX"]["HTML_VALUE"]?>"
															placeholder="<?=$arItem["VALUES"]["MAX"]["VALUE"]?>"
															onkeyup="smartFilter.keyup(this)"
														/>
													</div>
												</div>
											</div>
											<?
											break;
										case "G"://CHECKBOXES_WITH_PICTURES
											?>
											<div class="smart-filter-input-group-checkbox-pictures">
												<?foreach ($arItem["VALUES"] as $val => $ar):?>
													<input
														style="display: none"
														type="checkbox"
														name="<?=$ar["CONTROL_NAME"]?>"
														id="<?=$ar["CONTROL_ID"]?>"
														value="<?=$ar["HTML_VALUE"]?>"
														<? echo $ar["CHECKED"]? 'checked="checked"': '' ?>
													/>
													<?
													$class = "";
													if ($ar["CHECKED"])
														$class.= " bx-active";
													if ($ar["DISABLED"])
														$class.= " disabled";
													?>
													<label for="<?=$ar["CONTROL_ID"]?>" data-role="label_<?=$ar["CONTROL_ID"]?>" class="smart-filter-checkbox-label <?=$class?>" onclick="smartFilter.keyup(BX('<?=CUtil::JSEscape($ar["CONTROL_ID"])?>')); BX.toggleClass(this, 'bx-active');">
														<span class="smart-filter-checkbox-btn bx-color-sl">
															<?if (isset($ar["FILE"]) && !empty($ar["FILE"]["SRC"])):?>
																<span class="smart-filter-checkbox-btn-image" style="background-image:url('<?=$ar["FILE"]["SRC"]?>');"></span>
															<?endif?>
														</span>
													</label>
												<?endforeach?>
											</div>
											<?
											break;
										case "H"://CHECKBOXES_WITH_PICTURES_AND_LABELS
											?>
											<div class="smart-filter-input-group-checkbox-pictures smart-filter-input-group-checkbox-pictures-width-pict">

												<?foreach ($arItem["VALUES"] as $val => $ar):?>
													<input
														style="display: none"
														type="checkbox"
														name="<?=$ar["CONTROL_NAME"]?>"
														id="<?=$ar["CONTROL_ID"]?>"
														value="<?=$ar["HTML_VALUE"]?>"
														<? echo $ar["CHECKED"]? 'checked="checked"': '' ?>
													/>
													<?
													$class = "";
													if ($ar["CHECKED"])
														$class.= " bx-active";
													if ($ar["DISABLED"])
														$class.= " disabled";
													?>
													<label for="<?=$ar["CONTROL_ID"]?>" data-role="label_<?=$ar["CONTROL_ID"]?>" class="smart-filter-checkbox-label <?=$class?>" onclick="smartFilter.keyup(BX('<?=CUtil::JSEscape($ar["CONTROL_ID"])?>')); BX.toggleClass(this, 'bx-active');">
														<span class="smart-filter-checkbox-btn bx-color-sl">
															<?if (isset($ar["FILE"]) && !empty($ar["FILE"]["SRC"])):?>
																<span class="smart-filter-checkbox-btn-image" style="background-image:url('<?=$ar["FILE"]["SRC"]?>');"></span>
															<?endif?>
															</span>
															<span class="smart-filter-input-group-checkbox-pictures-param-text" title="<?=$ar["VALUE"];?>"><?=$ar["VALUE"];?><?
														if ($arParams["DISPLAY_ELEMENT_COUNT"] !== "N" && isset($ar["ELEMENT_COUNT"])):
															?> (<span data-role="count_<?=$ar["CONTROL_ID"]?>"><? echo $ar["ELEMENT_COUNT"]; ?></span>)<?
														endif;?></span>
													</label>
												<?endforeach?>
											</div>
											<?
											break;
										case "P"://DROPDOWN
											$checkedItemExist = false;
											?>
												<div class="bx-filter-select-container">
													<div class="bx-filter-select-block" onclick="smartFilter.showDropDownPopup(this, '<?=CUtil::JSEscape($key)?>')">
														<div class="bx-filter-select-text" data-role="currentOption">
															<?
															foreach ($arItem["VALUES"] as $val => $ar)
															{
																if ($ar["CHECKED"])
																{
																	echo $ar["VALUE"];
																	$checkedItemExist = true;
																}
															}
															if (!$checkedItemExist)
															{
																echo GetMessage("CT_BCSF_FILTER_ALL");
															}
															?>
														</div>
														<div class="bx-filter-select-arrow"></div>
														<input
															style="display: none"
															type="radio"
															name="<?=$arCur["CONTROL_NAME_ALT"]?>"
															id="<? echo "all_".$arCur["CONTROL_ID"] ?>"
															value=""
														/>
														<?foreach ($arItem["VALUES"] as $val => $ar):?>
															<input
																style="display: none"
																type="radio"
																name="<?=$ar["CONTROL_NAME_ALT"]?>"
																id="<?=$ar["CONTROL_ID"]?>"
																value="<? echo $ar["HTML_VALUE_ALT"] ?>"
																<? echo $ar["CHECKED"]? 'checked="checked"': '' ?>
															/>
														<?endforeach?>
														<div class="bx-filter-select-popup" data-role="dropdownContent" style="display: none;">
															<ul>
																<li>
																	<label for="<?="all_".$arCur["CONTROL_ID"]?>" class="bx-filter-param-label" data-role="label_<?="all_".$arCur["CONTROL_ID"]?>" onclick="smartFilter.selectDropDownItem(this, '<?=CUtil::JSEscape("all_".$arCur["CONTROL_ID"])?>')">
																		<? echo GetMessage("CT_BCSF_FILTER_ALL"); ?>
																	</label>
																</li>
															<?
															foreach ($arItem["VALUES"] as $val => $ar):
																$class = "";
																if ($ar["CHECKED"])
																	$class.= " selected";
																if ($ar["DISABLED"])
																	$class.= " disabled";
															?>
																<li>
																	<label for="<?=$ar["CONTROL_ID"]?>" class="bx-filter-param-label<?=$class?>" data-role="label_<?=$ar["CONTROL_ID"]?>" onclick="smartFilter.selectDropDownItem(this, '<?=CUtil::JSEscape($ar["CONTROL_ID"])?>')"><?=$ar["VALUE"]?></label>
																</li>
															<?endforeach?>
															</ul>
														</div>
													</div>
												</div>
											<?
											break;
										case "R"://DROPDOWN_WITH_PICTURES_AND_LABELS
											?>
											<div class="bx-filter-select-container">
												<div class="bx-filter-select-block" onclick="smartFilter.showDropDownPopup(this, '<?=CUtil::JSEscape($key)?>')">
													<div class="bx-filter-select-text fix" data-role="currentOption">
														<?
														$checkedItemExist = false;
														foreach ($arItem["VALUES"] as $val => $ar):
															if ($ar["CHECKED"])
															{
															?>
																<?if (isset($ar["FILE"]) && !empty($ar["FILE"]["SRC"])):?>
																	<span class="bx-filter-btn-color-icon" style="background-image:url('<?=$ar["FILE"]["SRC"]?>');"></span>
																<?endif?>
																<span class="bx-filter-param-text">
																	<?=$ar["VALUE"]?>
																</span>
															<?
																$checkedItemExist = true;
															}
														endforeach;
														if (!$checkedItemExist)
														{
															?><span class="bx-filter-btn-color-icon all"></span> <?
															echo GetMessage("CT_BCSF_FILTER_ALL");
														}
														?>
													</div>
													<div class="bx-filter-select-arrow"></div>
													<input
														style="display: none"
														type="radio"
														name="<?=$arCur["CONTROL_NAME_ALT"]?>"
														id="<? echo "all_".$arCur["CONTROL_ID"] ?>"
														value=""
													/>
													<?foreach ($arItem["VALUES"] as $val => $ar):?>
														<input
															style="display: none"
															type="radio"
															name="<?=$ar["CONTROL_NAME_ALT"]?>"
															id="<?=$ar["CONTROL_ID"]?>"
															value="<?=$ar["HTML_VALUE_ALT"]?>"
															<? echo $ar["CHECKED"]? 'checked="checked"': '' ?>
														/>
													<?endforeach?>
													<div class="bx-filter-select-popup" data-role="dropdownContent" style="display: none">
														<ul>
															<li style="border-bottom: 1px solid #e5e5e5;padding-bottom: 5px;margin-bottom: 5px;">
																<label for="<?="all_".$arCur["CONTROL_ID"]?>" class="bx-filter-param-label" data-role="label_<?="all_".$arCur["CONTROL_ID"]?>" onclick="smartFilter.selectDropDownItem(this, '<?=CUtil::JSEscape("all_".$arCur["CONTROL_ID"])?>')">
																	<span class="bx-filter-btn-color-icon all"></span>
																	<? echo GetMessage("CT_BCSF_FILTER_ALL"); ?>
																</label>
															</li>
														<?
														foreach ($arItem["VALUES"] as $val => $ar):
															$class = "";
															if ($ar["CHECKED"])
																$class.= " selected";
															if ($ar["DISABLED"])
																$class.= " disabled";
														?>
															<li>
																<label for="<?=$ar["CONTROL_ID"]?>" data-role="label_<?=$ar["CONTROL_ID"]?>" class="bx-filter-param-label<?=$class?>" onclick="smartFilter.selectDropDownItem(this, '<?=CUtil::JSEscape($ar["CONTROL_ID"])?>')">
																	<?if (isset($ar["FILE"]) && !empty($ar["FILE"]["SRC"])):?>
																		<span class="bx-filter-btn-color-icon" style="background-image:url('<?=$ar["FILE"]["SRC"]?>');"></span>
																	<?endif?>
																	<span class="bx-filter-param-text">
																		<?=$ar["VALUE"]?>
																	</span>
																</label>
															</li>
														<?endforeach?>
														</ul>
													</div>
												</div>
											</div>
											<?
											break;
										case "K"://RADIO_BUTTONS
											?>
												<?foreach($arItem["VALUES"] as $val => $ar):?>
							
													<div class="radio form-group__item">
														<input
															type="radio"
															class="form-radio-input custom-radio"
															value="<? echo $ar["HTML_VALUE_ALT"] ?>"
															name="<? echo $ar["CONTROL_NAME_ALT"] ?>"
															id="<? echo $ar["CONTROL_ID"] ?>"
															<? echo $ar["CHECKED"]? 'checked': '' ?>
															onclick="smartFilter.click(this)"
														/>
														<label data-role="label_<?=$ar["CONTROL_ID"]?>" class="smart-filter-radio-text form-radio-label" for="<? echo $ar["CONTROL_ID"] ?>">
															<span class="bx-filter-input-checkbox <? echo $ar["DISABLED"] ? 'disabled': '' ?>">
																<span class="bx-filter-param-text" title="<?=$ar["VALUE"];?>"><?=$ar["VALUE"];?><?
																if ($arParams["DISPLAY_ELEMENT_COUNT"] !== "N" && isset($ar["ELEMENT_COUNT"])):
																	?>&nbsp;(<span data-role="count_<?=$ar["CONTROL_ID"]?>"><? echo $ar["ELEMENT_COUNT"]; ?></span>)<?
																endif;?></span>
															</span>
														</label>
													</div>
												<?endforeach;?>
											<?
											break;
										case "U"://CALENDAR
											?>
												<div class="bx-filter-parameters-box-container-block">
													<div class="bx-filter-input-container bx-filter-calendar-container">
														<?$APPLICATION->IncludeComponent(
															'bitrix:main.calendar',
															'',
															array(
																'FORM_NAME' => $arResult["FILTER_NAME"]."_form",
																'SHOW_INPUT' => 'Y',
																'INPUT_ADDITIONAL_ATTR' => 'class="calendar" placeholder="'.FormatDate("SHORT", $arItem["VALUES"]["MIN"]["VALUE"]).'" onkeyup="smartFilter.keyup(this)" onchange="smartFilter.keyup(this)"',
																'INPUT_NAME' => $arItem["VALUES"]["MIN"]["CONTROL_NAME"],
																'INPUT_VALUE' => $arItem["VALUES"]["MIN"]["HTML_VALUE"],
																'SHOW_TIME' => 'N',
																'HIDE_TIMEBAR' => 'Y',
															),
															null,
															array('HIDE_ICONS' => 'Y')
														);?>
													</div>
												</div>
												<div class="bx-filter-parameters-box-container-block">
													<div class="bx-filter-input-container bx-filter-calendar-container">
														<?$APPLICATION->IncludeComponent(
															'bitrix:main.calendar',
															'',
															array(
																'FORM_NAME' => $arResult["FILTER_NAME"]."_form",
																'SHOW_INPUT' => 'Y',
																'INPUT_ADDITIONAL_ATTR' => 'class="calendar" placeholder="'.FormatDate("SHORT", $arItem["VALUES"]["MAX"]["VALUE"]).'" onkeyup="smartFilter.keyup(this)" onchange="smartFilter.keyup(this)"',
																'INPUT_NAME' => $arItem["VALUES"]["MAX"]["CONTROL_NAME"],
																'INPUT_VALUE' => $arItem["VALUES"]["MAX"]["HTML_VALUE"],
																'SHOW_TIME' => 'N',
																'HIDE_TIMEBAR' => 'Y',
															),
															null,
															array('HIDE_ICONS' => 'Y')
														);?>
													</div>
												</div>
											<?
											break;
										default://CHECKBOXES
											?>
											<div class="smart-filter-input-group-checkbox-list">
											<div class="form-group">
												<?foreach($arItem["VALUES"] as $val => $ar):?>
													<div class="form-group__form-check">
														<input
															type="checkbox"
															class="form-check-input"
															value="<? echo $ar["HTML_VALUE"] ?>"
															name="<? echo $ar["CONTROL_NAME"] ?>"
															id="<? echo $ar["CONTROL_ID"] ?>"
															<? echo $ar["CHECKED"]? 'checked': '' ?>
															onclick="smartFilter.click(this)"
														/>
														<label data-role="label_<?=$ar["CONTROL_ID"]?>" class="smart-filter-checkbox-text form-check-label <? echo $ar["DISABLED"] ? 'disabled': '' ?>" for="<? echo $ar["CONTROL_ID"] ?>">
															<?=$ar["VALUE"];?>
															<?if ($arParams["DISPLAY_ELEMENT_COUNT"] !== "N" && isset($ar["ELEMENT_COUNT"])):
																	?>&nbsp;(<span data-role="count_<?=$ar["CONTROL_ID"]?>"><? echo $ar["ELEMENT_COUNT"]; ?></span>)<?
															endif;?>
														</label>
													</div>
												<?endforeach;?>
											</div>
											</div>
									<?
									}
									?>
									</div>
								</div>
							</div>
						<?
						}
						?>
					</div>
					<div class="smart-filter__btns">
						<div class="col smart-filter-button-box">
							<div class="smart-filter-block">
								<div class="smart-filter-parameters-box-container">
									<input
										class="smart-filter__btn-apply"
										type="submit"
										id="set_filter"
										name="set_filter"
										value="<?=GetMessage("CT_BCSF_SET_FILTER")?>"
									/>
									<input
										class="smart-filter__btn-reset"
										type="submit"
										id="del_filter"
										name="del_filter"
										value="<?=GetMessage("CT_BCSF_DEL_FILTER")?>"
									/>
									<div class="bx-filter-popup-result" id="modef" <?if(!isset($arResult["ELEMENT_COUNT"])) echo 'style="display:none"';?> style="display: inline-block;">
										<?echo GetMessage("CT_BCSF_FILTER_COUNT", array("#ELEMENT_COUNT#" => '<span id="modef_num">'.intval($arResult["ELEMENT_COUNT"]).'</span>'));?>
										<span class="arrow"></span>
										<br/>
										<a href="<?echo $arResult["FILTER_URL"]?>" target=""><?echo GetMessage("CT_BCSF_FILTER_SHOW")?></a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</form>
		</div>
	</div>
</div>
<script type="text/javascript">
	var smartFilter = new JCSmartFilter('<?echo CUtil::JSEscape($arResult["FORM_ACTION"])?>', '<?=CUtil::JSEscape($arParams["FILTER_VIEW_MODE"])?>', <?=CUtil::PhpToJSObject($arResult["JS_FILTER_PARAMS"])?>);
</script>