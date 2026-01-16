<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/install/wizard_sol/wizard.php");

class SelectSiteStep extends CSelectSiteWizardStep
{
    function InitStep()
    {
        parent::InitStep();
        $wizard =& $this->GetWizard();
        $wizard->solutionName = "protocorp";
        // Явно задаём ID шага и название следующего
        $this->SetStepID("SelectSiteStep");
        $this->SetNextStep("SelectTemplateStep");
    }
}

class SelectTemplateStep extends CSelectTemplateWizardStep
{
    function InitStep()
    {
        parent::InitStep();
        $wizard =& $this->GetWizard();
        if (!$wizard->solutionName)
        {
            $wizard->solutionName = "protocorp";
        }
        $this->SetStepID("SelectTemplateStep");
        $this->SetNextStep("DataInstallStep");
    }
}

class DataInstallStep extends CDataInstallWizardStep
{
    function InitStep()
    {
        parent::InitStep();
        $this->SetStepID("DataInstallStep");
        $this->SetNextStep("FinishStep");
    }
    
    function CorrectServices(&$arServices)
    {
        $wizard =& $this->GetWizard();
        if ($wizard->GetVar("installDemoData") != "Y")
        {
        }
    }
}

class FinishStep extends CFinishWizardStep
{
}
?>