<div class="sidebar-include">
    <?$APPLICATION->IncludeComponent("bitrix:main.include", "", [
        "AREA_FILE_SHOW" => "file",
        "PATH" => SITE_DIR . "include/sidebar_calling.php"
    ]);?>
      <?$APPLICATION->IncludeComponent("bitrix:main.include", "", [
        "AREA_FILE_SHOW" => "file",
        "PATH" => SITE_DIR . "include/sidebar_banner.php"
    ]);?>
</div>