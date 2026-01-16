<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("PROTOCORP_HIDE_SIDEBAR", "Y");
$APPLICATION->SetTitle("Контакты");
?>
<div class="two-columns">
<div class="two-columns__item">
    <p>
        <b>Телефон:</b>+7 (495) 01-02-03,
    </p>
    <p>
        <b>Сотовый:</b>	+7 (800) 01-02-03
    </p>
    <p>
        <b>Эл.почта</b><b>:</b> <a href="mailto:info@protobyte.ru">info@protobyte.ru</a>
    </p>
    <p>
        <b>Офис:</b> Москва, ул. Победы, дом 125Б, этаж&nbsp;3, каб.&nbsp;5&nbsp;(рабочее время c&nbsp;10:00 до&nbsp;17:00) <br> Вход со&nbsp;двора, 2&nbsp;этаж.
    </p>
    <p>
        Просим заранее назначать встречу по&nbsp;телефону
    </p>
    <br>
    <div class="map-mobile"></div>
    <h2>Реквизиты</h2>
    <table class="table table-color">
        <tbody>
            <tr>
                <td>Наименование</td>
                <td>Индивидуальный предприниматель ВАСИЛЬЕВ ВАСИЛИЙ ВАСИЛЬЕВИЧ</td>
            </tr>
            <tr>
                <td>Юридический адрес</td>
                <td>Российская Федерация, 000000, МОСКОВСКАЯ ОБЛ, Г МОСКВА</td>
            </tr>
            <tr>
                <td>ИНН</td>
                <td>000000000000</td>
            </tr>
            <tr>
                <td>ОГРН</td>
                <td>000000000000000</td>
            </tr>
            <tr>
                <td>Расчетный счет</td>
                <td>00000000000000000000</td>
            </tr>
            <tr>
                <td>Банк</td>
                <td>АО «Банк»</td>
            </tr>
            <tr>
                <td>Юридический адрес Банка</td>
                <td>Москва, 000000, 1-й Волоколамский проезд</td>
            </tr>
            <tr>
                <td>Корр. счет Банка</td>
                <td>00000000000000000000</td>
            </tr>
            <tr>
                <td>ИНН Банка</td>
                <td>0000000000</td>
            </tr>
            <tr>
                <td>БИК Банка</td>
                <td>0000000000</td>
            </tr>
        </tbody>
    </table>
</div>
<div class="two-columns__item">
    <div class="map" data-da=".map-mobile,991,first">
        <script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3A7d55a7b99f0a978ab53deaf3397680b73cf0087ec018ede98f87698069b1ba4b&amp;width=100%&amp;height=800&amp;lang=ru_RU&amp;scroll=true"></script>
    </div>
</div>
</div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>