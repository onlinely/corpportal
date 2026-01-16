<?
include_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/urlrewrite.php');

CHTTP::SetStatus("404 Not Found");
@define("ERROR_404","Y");

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

$APPLICATION->SetTitle("404 Not Found");?>
<div class="not-found">
    <div class="container">
        <div class="not-found__wrap">
            <div class="not-found__title">
                Ошибка 404
            </div>
            <div class="not-found__sub-title">
                К&nbsp;сожалению, запрошенная вами страница не&nbsp;найдена!
            </div>
            <div class="not-found__btn">
                <a href="main.html" class="btn-default">
                    Перейти на главную
                </a>
            </div>
        </div>
    </div>
</div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>