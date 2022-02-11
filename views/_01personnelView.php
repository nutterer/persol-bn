<?php

namespace PHPMaker2021\upPersonnelv2;

// Page object
$_01personnelView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var f_01personnelview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    f_01personnelview = currentForm = new ew.Form("f_01personnelview", "view");
    loadjs.done("f_01personnelview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<?php if (!$Page->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $Page->ExportOptions->render("body") ?>
<?php $Page->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="f_01personnelview" id="f_01personnelview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl() ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="_01personnel">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Page->Per_Id->Visible) { // Per_Id ?>
    <tr id="r_Per_Id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh__01personnel_Per_Id"><?= $Page->Per_Id->caption() ?></span></td>
        <td data-name="Per_Id" <?= $Page->Per_Id->cellAttributes() ?>>
<span id="el__01personnel_Per_Id">
<span<?= $Page->Per_Id->viewAttributes() ?>>
<?= $Page->Per_Id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->Per_ThaiPre->Visible) { // Per_ThaiPre ?>
    <tr id="r_Per_ThaiPre">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh__01personnel_Per_ThaiPre"><?= $Page->Per_ThaiPre->caption() ?></span></td>
        <td data-name="Per_ThaiPre" <?= $Page->Per_ThaiPre->cellAttributes() ?>>
<span id="el__01personnel_Per_ThaiPre">
<span<?= $Page->Per_ThaiPre->viewAttributes() ?>>
<?= $Page->Per_ThaiPre->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->Per_ThaiName->Visible) { // Per_ThaiName ?>
    <tr id="r_Per_ThaiName">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh__01personnel_Per_ThaiName"><?= $Page->Per_ThaiName->caption() ?></span></td>
        <td data-name="Per_ThaiName" <?= $Page->Per_ThaiName->cellAttributes() ?>>
<span id="el__01personnel_Per_ThaiName">
<span<?= $Page->Per_ThaiName->viewAttributes() ?>>
<?= $Page->Per_ThaiName->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->Per_ThaiLastName->Visible) { // Per_ThaiLastName ?>
    <tr id="r_Per_ThaiLastName">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh__01personnel_Per_ThaiLastName"><?= $Page->Per_ThaiLastName->caption() ?></span></td>
        <td data-name="Per_ThaiLastName" <?= $Page->Per_ThaiLastName->cellAttributes() ?>>
<span id="el__01personnel_Per_ThaiLastName">
<span<?= $Page->Per_ThaiLastName->viewAttributes() ?>>
<?= $Page->Per_ThaiLastName->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->Per_EngPre->Visible) { // Per_EngPre ?>
    <tr id="r_Per_EngPre">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh__01personnel_Per_EngPre"><?= $Page->Per_EngPre->caption() ?></span></td>
        <td data-name="Per_EngPre" <?= $Page->Per_EngPre->cellAttributes() ?>>
<span id="el__01personnel_Per_EngPre">
<span<?= $Page->Per_EngPre->viewAttributes() ?>>
<?= $Page->Per_EngPre->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->Per_EngName->Visible) { // Per_EngName ?>
    <tr id="r_Per_EngName">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh__01personnel_Per_EngName"><?= $Page->Per_EngName->caption() ?></span></td>
        <td data-name="Per_EngName" <?= $Page->Per_EngName->cellAttributes() ?>>
<span id="el__01personnel_Per_EngName">
<span<?= $Page->Per_EngName->viewAttributes() ?>>
<?= $Page->Per_EngName->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->Per_EngLastName->Visible) { // Per_EngLastName ?>
    <tr id="r_Per_EngLastName">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh__01personnel_Per_EngLastName"><?= $Page->Per_EngLastName->caption() ?></span></td>
        <td data-name="Per_EngLastName" <?= $Page->Per_EngLastName->cellAttributes() ?>>
<span id="el__01personnel_Per_EngLastName">
<span<?= $Page->Per_EngLastName->viewAttributes() ?>>
<?= $Page->Per_EngLastName->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->Per_Type->Visible) { // Per_Type ?>
    <tr id="r_Per_Type">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh__01personnel_Per_Type"><?= $Page->Per_Type->caption() ?></span></td>
        <td data-name="Per_Type" <?= $Page->Per_Type->cellAttributes() ?>>
<span id="el__01personnel_Per_Type">
<span<?= $Page->Per_Type->viewAttributes() ?>>
<?= $Page->Per_Type->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->Per_EmployeeType->Visible) { // Per_EmployeeType ?>
    <tr id="r_Per_EmployeeType">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh__01personnel_Per_EmployeeType"><?= $Page->Per_EmployeeType->caption() ?></span></td>
        <td data-name="Per_EmployeeType" <?= $Page->Per_EmployeeType->cellAttributes() ?>>
<span id="el__01personnel_Per_EmployeeType">
<span<?= $Page->Per_EmployeeType->viewAttributes() ?>>
<?= $Page->Per_EmployeeType->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->Per_Position->Visible) { // Per_Position ?>
    <tr id="r_Per_Position">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh__01personnel_Per_Position"><?= $Page->Per_Position->caption() ?></span></td>
        <td data-name="Per_Position" <?= $Page->Per_Position->cellAttributes() ?>>
<span id="el__01personnel_Per_Position">
<span<?= $Page->Per_Position->viewAttributes() ?>>
<?= $Page->Per_Position->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->Per_major->Visible) { // Per_major ?>
    <tr id="r_Per_major">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh__01personnel_Per_major"><?= $Page->Per_major->caption() ?></span></td>
        <td data-name="Per_major" <?= $Page->Per_major->cellAttributes() ?>>
<span id="el__01personnel_Per_major">
<span<?= $Page->Per_major->viewAttributes() ?>>
<?= $Page->Per_major->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->Per_Academic->Visible) { // Per_Academic ?>
    <tr id="r_Per_Academic">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh__01personnel_Per_Academic"><?= $Page->Per_Academic->caption() ?></span></td>
        <td data-name="Per_Academic" <?= $Page->Per_Academic->cellAttributes() ?>>
<span id="el__01personnel_Per_Academic">
<span<?= $Page->Per_Academic->viewAttributes() ?>>
<?= $Page->Per_Academic->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->Per_Administrative->Visible) { // Per_Administrative ?>
    <tr id="r_Per_Administrative">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh__01personnel_Per_Administrative"><?= $Page->Per_Administrative->caption() ?></span></td>
        <td data-name="Per_Administrative" <?= $Page->Per_Administrative->cellAttributes() ?>>
<span id="el__01personnel_Per_Administrative">
<span<?= $Page->Per_Administrative->viewAttributes() ?>>
<?= $Page->Per_Administrative->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->Per_WorDateStart->Visible) { // Per_WorDateStart ?>
    <tr id="r_Per_WorDateStart">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh__01personnel_Per_WorDateStart"><?= $Page->Per_WorDateStart->caption() ?></span></td>
        <td data-name="Per_WorDateStart" <?= $Page->Per_WorDateStart->cellAttributes() ?>>
<span id="el__01personnel_Per_WorDateStart">
<span<?= $Page->Per_WorDateStart->viewAttributes() ?>>
<?= $Page->Per_WorDateStart->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->Per_WorkDate->Visible) { // Per_WorkDate ?>
    <tr id="r_Per_WorkDate">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh__01personnel_Per_WorkDate"><?= $Page->Per_WorkDate->caption() ?></span></td>
        <td data-name="Per_WorkDate" <?= $Page->Per_WorkDate->cellAttributes() ?>>
<span id="el__01personnel_Per_WorkDate">
<span<?= $Page->Per_WorkDate->viewAttributes() ?>>
<?= $Page->Per_WorkDate->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->Per_Born->Visible) { // Per_Born ?>
    <tr id="r_Per_Born">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh__01personnel_Per_Born"><?= $Page->Per_Born->caption() ?></span></td>
        <td data-name="Per_Born" <?= $Page->Per_Born->cellAttributes() ?>>
<span id="el__01personnel_Per_Born">
<span<?= $Page->Per_Born->viewAttributes() ?>>
<?= $Page->Per_Born->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->Per_Nationality->Visible) { // Per_Nationality ?>
    <tr id="r_Per_Nationality">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh__01personnel_Per_Nationality"><?= $Page->Per_Nationality->caption() ?></span></td>
        <td data-name="Per_Nationality" <?= $Page->Per_Nationality->cellAttributes() ?>>
<span id="el__01personnel_Per_Nationality">
<span<?= $Page->Per_Nationality->viewAttributes() ?>>
<?= $Page->Per_Nationality->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->Per_Religion->Visible) { // Per_Religion ?>
    <tr id="r_Per_Religion">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh__01personnel_Per_Religion"><?= $Page->Per_Religion->caption() ?></span></td>
        <td data-name="Per_Religion" <?= $Page->Per_Religion->cellAttributes() ?>>
<span id="el__01personnel_Per_Religion">
<span<?= $Page->Per_Religion->viewAttributes() ?>>
<?= $Page->Per_Religion->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->Per_IdCard->Visible) { // Per_IdCard ?>
    <tr id="r_Per_IdCard">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh__01personnel_Per_IdCard"><?= $Page->Per_IdCard->caption() ?></span></td>
        <td data-name="Per_IdCard" <?= $Page->Per_IdCard->cellAttributes() ?>>
<span id="el__01personnel_Per_IdCard">
<span<?= $Page->Per_IdCard->viewAttributes() ?>>
<?= $Page->Per_IdCard->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->Per_WorkStatus->Visible) { // Per_WorkStatus ?>
    <tr id="r_Per_WorkStatus">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh__01personnel_Per_WorkStatus"><?= $Page->Per_WorkStatus->caption() ?></span></td>
        <td data-name="Per_WorkStatus" <?= $Page->Per_WorkStatus->cellAttributes() ?>>
<span id="el__01personnel_Per_WorkStatus">
<span<?= $Page->Per_WorkStatus->viewAttributes() ?>>
<?= $Page->Per_WorkStatus->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->Per_Phone->Visible) { // Per_Phone ?>
    <tr id="r_Per_Phone">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh__01personnel_Per_Phone"><?= $Page->Per_Phone->caption() ?></span></td>
        <td data-name="Per_Phone" <?= $Page->Per_Phone->cellAttributes() ?>>
<span id="el__01personnel_Per_Phone">
<span<?= $Page->Per_Phone->viewAttributes() ?>>
<?= $Page->Per_Phone->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->Per_UPEmail->Visible) { // Per_UPEmail ?>
    <tr id="r_Per_UPEmail">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh__01personnel_Per_UPEmail"><?= $Page->Per_UPEmail->caption() ?></span></td>
        <td data-name="Per_UPEmail" <?= $Page->Per_UPEmail->cellAttributes() ?>>
<span id="el__01personnel_Per_UPEmail">
<span<?= $Page->Per_UPEmail->viewAttributes() ?>>
<?= $Page->Per_UPEmail->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->Per_Email->Visible) { // Per_Email ?>
    <tr id="r_Per_Email">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh__01personnel_Per_Email"><?= $Page->Per_Email->caption() ?></span></td>
        <td data-name="Per_Email" <?= $Page->Per_Email->cellAttributes() ?>>
<span id="el__01personnel_Per_Email">
<span<?= $Page->Per_Email->viewAttributes() ?>>
<?= $Page->Per_Email->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->Per_Address->Visible) { // Per_Address ?>
    <tr id="r_Per_Address">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh__01personnel_Per_Address"><?= $Page->Per_Address->caption() ?></span></td>
        <td data-name="Per_Address" <?= $Page->Per_Address->cellAttributes() ?>>
<span id="el__01personnel_Per_Address">
<span<?= $Page->Per_Address->viewAttributes() ?>>
<?= $Page->Per_Address->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
</table>
</form>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<?php if (!$Page->isExport()) { ?>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
