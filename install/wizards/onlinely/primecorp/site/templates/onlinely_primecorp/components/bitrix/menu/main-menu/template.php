<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();?>

<?if (!empty($arResult)):?>
    <nav class="header__menu" role="navigation" aria-label="main-menu">
        <ul class="header__list">
            <?$previousLevel = 0;
            foreach ($arResult as $arItem):
                if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel) {
                    echo str_repeat('</ul></li>', ($previousLevel - $arItem["DEPTH_LEVEL"]));
                }
                if ($arItem["IS_PARENT"]):
                    if ($arItem["DEPTH_LEVEL"] == 1):?>
                        <li class="header__item">
                            <a 
                                href="<?=$arItem['LINK']?>" 
                                class="header__link<?=$arItem['SELECTED'] ? ' selected' : ''?>" 
                                aria-haspopup="true" 
                                aria-expanded="false"
                            >
                                <span><?=$arItem['TEXT']?></span>
                                <svg width="10" height="5" viewBox="0 0 10 5" fill="none" aria-hidden="true">
                                    <path d="M1.31445 1.15076L4.62599 4.07862C4.65016 4.10139 4.67936 4.11954 4.71177 4.13195C4.74419 4.14436 4.77913 4.15076 4.81445 4.15076C4.84977 4.15076 4.88472 4.14436 4.91714 4.13195C4.94955 4.11954 4.97874 4.10139 5.00291 4.07862L8.31445 1.15076" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            </a>
                            <ul class="header__sub-list" role="menu">
                    <?else:?>
                        <li class="header__sub-item">
                            <a 
                                href="<?=$arItem['LINK']?>" 
                                class="header__sub-link<?=$arItem['SELECTED'] ? ' selected' : ''?>" 
                                role="menuitem"
                            >
                                <?=$arItem['TEXT']?>
                            </a>
                            <ul role="menu">
                    <?endif?>
                <?else:
                    if ($arItem["PERMISSION"] > "D"):?>
                        <?if ($arItem["DEPTH_LEVEL"] == 1):?>
                            <li class="header__item">
                                <a 
                                    href="<?=$arItem['LINK']?>" 
                                    class="header__link<?=$arItem['SELECTED'] ? ' selected' : ''?>" 
                                    aria-current="<?=$arItem['SELECTED'] ? 'page' : 'false'?>"
                                >
                                    <span><?=$arItem['TEXT']?></span>
                                </a>
                            </li>
                        <?else:?>
                            <li class="header__sub-item">
                                <a 
                                    href="<?=$arItem['LINK']?>" 
                                    class="header__sub-link<?=$arItem['SELECTED'] ? ' selected' : ''?>" 
                                    role="menuitem"
                                >
                                    <?=$arItem['TEXT']?>
                                </a>
                            </li>
                        <?endif?>
                    <?else:?>
                        <?if ($arItem["DEPTH_LEVEL"] == 1):?>
                            <li class="header__item">
                                <a 
                                    href="<?=$arItem['LINK']?>" 
                                    class="header__link denied" 
                                    title="<?=GetMessage('MENU_ITEM_ACCESS_DENIED')?>"
                                >
                                    <span><?=$arItem['TEXT']?></span>
                                </a>
                            </li>
                        <?else:?>
                            <li class="header__sub-item">
                                <a 
                                    href="#" 
                                    class="denied" 
                                    title="<?=GetMessage('MENU_ITEM_ACCESS_DENIED')?>"
                                >
                                    <?=$arItem['TEXT']?>
                                </a>
                            </li>
                        <?endif?>
                    <?endif?>
                <?endif?>
                
                <?$previousLevel = $arItem["DEPTH_LEVEL"];?>
            <?endforeach?>
            
            <?if ($previousLevel > 1) {
                echo str_repeat('</ul></li>', ($previousLevel - 1));
            }?>
        </ul>
    </nav>
<?endif?>