<?php

namespace PHPMaker2021\upPersonnelv2;

// Page object
$_03academicranksView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var f_03academicranksview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    f_03academicranksview = currentForm = new ew.Form("f_03academicranksview", "view");
    loadjs.done("f_03academicranksview");
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
<form name="f_03academicranksview" id="f_03academicranksview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl() ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="_03academicranks">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Page->Aca_Id->Visible) { // Aca_Id ?>
    <tr id="r_Aca_Id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh__03academicranks_Aca_Id"><?= $Page->Aca_Id->caption() ?></span></td>
        <td data-name="Aca_Id" <?= $Page->Aca_Id->cellAttributes() ?>>
<span id="el__03academicranks_Aca_Id">
<span<?= $Page->Aca_Id->viewAttributes() ?>>
<?= $Page->Aca_Id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->Per_Id->Visible) { // Per_Id ?>
    <tr id="r_Per_Id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh__03academicranks_Per_Id"><?= $Page->Per_Id->caption() ?></span></td>
        <td data-name="Per_Id" <?= $Page->Per_Id->cellAttributes() ?>>
<span id="el__03academicranks_Per_Id">
<span<?= $Page->Per_Id->viewAttributes() ?>>
<?= $Page->Per_Id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->Aca_RequesDate->Visible) { // Aca_RequesDate ?>
    <tr id="r_Aca_RequesDate">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh__03academicranks_Aca_RequesDate"><?= $Page->Aca_RequesDate->caption() ?></span></td>
        <td data-name="Aca_RequesDate" <?= $Page->Aca_RequesDate->cellAttributes() ?>>
<span id="el__03academicranks_Aca_RequesDate">
<span<?= $Page->Aca_RequesDate->viewAttributes() ?>>
<?= $Page->Aca_RequesDate->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->Aca_AcceptDate->Visible) { // Aca_AcceptDate ?>
    <tr id="r_Aca_AcceptDate">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh__03academicranks_Aca_AcceptDate"><?= $Page->Aca_AcceptDate->caption() ?></span></td>
        <td data-name="Aca_AcceptDate" <?= $Page->Aca_AcceptDate->cellAttributes() ?>>
<span id="el__03academicranks_Aca_AcceptDate">
<span<?= $Page->Aca_AcceptDate->viewAttributes() ?>>
<?= $Page->Aca_AcceptDate->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->Aca_EstimateStart->Visible) { // Aca_EstimateStart ?>
    <tr id="r_Aca_EstimateStart">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh__03academicranks_Aca_EstimateStart"><?= $Page->Aca_EstimateStart->caption() ?></span></td>
        <td data-name="Aca_EstimateStart" <?= $Page->Aca_EstimateStart->cellAttributes() ?>>
<span id="el__03academicranks_Aca_EstimateStart">
<span<?= $Page->Aca_EstimateStart->viewAttributes() ?>>
<?= $Page->Aca_EstimateStart->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->Aca_EstimateEnd->Visible) { // Aca_EstimateEnd ?>
    <tr id="r_Aca_EstimateEnd">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh__03academicranks_Aca_EstimateEnd"><?= $Page->Aca_EstimateEnd->caption() ?></span></td>
        <td data-name="Aca_EstimateEnd" <?= $Page->Aca_EstimateEnd->cellAttributes() ?>>
<span id="el__03academicranks_Aca_EstimateEnd">
<span<?= $Page->Aca_EstimateEnd->viewAttributes() ?>>
<?= $Page->Aca_EstimateEnd->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->Aca_Name->Visible) { // Aca_Name ?>
    <tr id="r_Aca_Name">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh__03academicranks_Aca_Name"><?= $Page->Aca_Name->caption() ?></span></td>
        <td data-name="Aca_Name" <?= $Page->Aca_Name->cellAttributes() ?>>
<span id="el__03academicranks_Aca_Name">
<span<?= $Page->Aca_Name->viewAttributes() ?>>
<?= $Page->Aca_Name->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->Aca_Status->Visible) { // Aca_Status ?>
    <tr id="r_Aca_Status">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh__03academicranks_Aca_Status"><?= $Page->Aca_Status->caption() ?></span></td>
        <td data-name="Aca_Status" <?= $Page->Aca_Status->cellAttributes() ?>>
<span id="el__03academicranks_Aca_Status">
<span<?= $Page->Aca_Status->viewAttributes() ?>>
<?= $Page->Aca_Status->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->Aca_SkillMajor->Visible) { // Aca_SkillMajor ?>
    <tr id="r_Aca_SkillMajor">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh__03academicranks_Aca_SkillMajor"><?= $Page->Aca_SkillMajor->caption() ?></span></td>
        <td data-name="Aca_SkillMajor" <?= $Page->Aca_SkillMajor->cellAttributes() ?>>
<span id="el__03academicranks_Aca_SkillMajor">
<span<?= $Page->Aca_SkillMajor->viewAttributes() ?>>
<?= $Page->Aca_SkillMajor->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->Aca_Report->Visible) { // Aca_Report ?>
    <tr id="r_Aca_Report">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh__03academicranks_Aca_Report"><?= $Page->Aca_Report->caption() ?></span></td>
        <td data-name="Aca_Report" <?= $Page->Aca_Report->cellAttributes() ?>>
<span id="el__03academicranks_Aca_Report">
<span<?= $Page->Aca_Report->viewAttributes() ?>>
<?= $Page->Aca_Report->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->Aca_EstimateTeaching->Visible) { // Aca_EstimateTeaching ?>
    <tr id="r_Aca_EstimateTeaching">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh__03academicranks_Aca_EstimateTeaching"><?= $Page->Aca_EstimateTeaching->caption() ?></span></td>
        <td data-name="Aca_EstimateTeaching" <?= $Page->Aca_EstimateTeaching->cellAttributes() ?>>
<span id="el__03academicranks_Aca_EstimateTeaching">
<span<?= $Page->Aca_EstimateTeaching->viewAttributes() ?>>
<?= $Page->Aca_EstimateTeaching->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->Aca_EstimateBook->Visible) { // Aca_EstimateBook ?>
    <tr id="r_Aca_EstimateBook">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh__03academicranks_Aca_EstimateBook"><?= $Page->Aca_EstimateBook->caption() ?></span></td>
        <td data-name="Aca_EstimateBook" <?= $Page->Aca_EstimateBook->cellAttributes() ?>>
<span id="el__03academicranks_Aca_EstimateBook">
<span<?= $Page->Aca_EstimateBook->viewAttributes() ?>>
<?= $Page->Aca_EstimateBook->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->Aca_EstimateNum->Visible) { // Aca_EstimateNum ?>
    <tr id="r_Aca_EstimateNum">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh__03academicranks_Aca_EstimateNum"><?= $Page->Aca_EstimateNum->caption() ?></span></td>
        <td data-name="Aca_EstimateNum" <?= $Page->Aca_EstimateNum->cellAttributes() ?>>
<span id="el__03academicranks_Aca_EstimateNum">
<span<?= $Page->Aca_EstimateNum->viewAttributes() ?>>
<?= $Page->Aca_EstimateNum->getViewValue() ?></span>
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
