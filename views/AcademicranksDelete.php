<?php

namespace PHPMaker2021\upPersonnel;

// Page object
$AcademicranksDelete = &$Page;
?>
<script>
var currentForm, currentPageID;
var facademicranksdelete;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "delete";
    facademicranksdelete = currentForm = new ew.Form("facademicranksdelete", "delete");
    loadjs.done("facademicranksdelete");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="facademicranksdelete" id="facademicranksdelete" class="form-inline ew-form ew-delete-form" action="<?= CurrentPageUrl() ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="academicranks">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($Page->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?= HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
    <thead>
    <tr class="ew-table-header">
<?php if ($Page->Aca_Id->Visible) { // Aca_Id ?>
        <th class="<?= $Page->Aca_Id->headerCellClass() ?>"><span id="elh_academicranks_Aca_Id" class="academicranks_Aca_Id"><?= $Page->Aca_Id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->Per_Id->Visible) { // Per_Id ?>
        <th class="<?= $Page->Per_Id->headerCellClass() ?>"><span id="elh_academicranks_Per_Id" class="academicranks_Per_Id"><?= $Page->Per_Id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->Aca_RequesDate->Visible) { // Aca_RequesDate ?>
        <th class="<?= $Page->Aca_RequesDate->headerCellClass() ?>"><span id="elh_academicranks_Aca_RequesDate" class="academicranks_Aca_RequesDate"><?= $Page->Aca_RequesDate->caption() ?></span></th>
<?php } ?>
<?php if ($Page->Aca_AcceptDate->Visible) { // Aca_AcceptDate ?>
        <th class="<?= $Page->Aca_AcceptDate->headerCellClass() ?>"><span id="elh_academicranks_Aca_AcceptDate" class="academicranks_Aca_AcceptDate"><?= $Page->Aca_AcceptDate->caption() ?></span></th>
<?php } ?>
<?php if ($Page->Aca_EstimateStart->Visible) { // Aca_EstimateStart ?>
        <th class="<?= $Page->Aca_EstimateStart->headerCellClass() ?>"><span id="elh_academicranks_Aca_EstimateStart" class="academicranks_Aca_EstimateStart"><?= $Page->Aca_EstimateStart->caption() ?></span></th>
<?php } ?>
<?php if ($Page->Aca_EstimateEnd->Visible) { // Aca_EstimateEnd ?>
        <th class="<?= $Page->Aca_EstimateEnd->headerCellClass() ?>"><span id="elh_academicranks_Aca_EstimateEnd" class="academicranks_Aca_EstimateEnd"><?= $Page->Aca_EstimateEnd->caption() ?></span></th>
<?php } ?>
<?php if ($Page->Aca_Name->Visible) { // Aca_Name ?>
        <th class="<?= $Page->Aca_Name->headerCellClass() ?>"><span id="elh_academicranks_Aca_Name" class="academicranks_Aca_Name"><?= $Page->Aca_Name->caption() ?></span></th>
<?php } ?>
<?php if ($Page->Aca_Status->Visible) { // Aca_Status ?>
        <th class="<?= $Page->Aca_Status->headerCellClass() ?>"><span id="elh_academicranks_Aca_Status" class="academicranks_Aca_Status"><?= $Page->Aca_Status->caption() ?></span></th>
<?php } ?>
<?php if ($Page->Aca_SkillMajor->Visible) { // Aca_SkillMajor ?>
        <th class="<?= $Page->Aca_SkillMajor->headerCellClass() ?>"><span id="elh_academicranks_Aca_SkillMajor" class="academicranks_Aca_SkillMajor"><?= $Page->Aca_SkillMajor->caption() ?></span></th>
<?php } ?>
<?php if ($Page->Aca_Report->Visible) { // Aca_Report ?>
        <th class="<?= $Page->Aca_Report->headerCellClass() ?>"><span id="elh_academicranks_Aca_Report" class="academicranks_Aca_Report"><?= $Page->Aca_Report->caption() ?></span></th>
<?php } ?>
<?php if ($Page->Aca_EstimateTeaching->Visible) { // Aca_EstimateTeaching ?>
        <th class="<?= $Page->Aca_EstimateTeaching->headerCellClass() ?>"><span id="elh_academicranks_Aca_EstimateTeaching" class="academicranks_Aca_EstimateTeaching"><?= $Page->Aca_EstimateTeaching->caption() ?></span></th>
<?php } ?>
<?php if ($Page->Aca_EstimateBook->Visible) { // Aca_EstimateBook ?>
        <th class="<?= $Page->Aca_EstimateBook->headerCellClass() ?>"><span id="elh_academicranks_Aca_EstimateBook" class="academicranks_Aca_EstimateBook"><?= $Page->Aca_EstimateBook->caption() ?></span></th>
<?php } ?>
<?php if ($Page->Aca_EstimateNum->Visible) { // Aca_EstimateNum ?>
        <th class="<?= $Page->Aca_EstimateNum->headerCellClass() ?>"><span id="elh_academicranks_Aca_EstimateNum" class="academicranks_Aca_EstimateNum"><?= $Page->Aca_EstimateNum->caption() ?></span></th>
<?php } ?>
    </tr>
    </thead>
    <tbody>
<?php
$Page->RecordCount = 0;
$i = 0;
while (!$Page->Recordset->EOF) {
    $Page->RecordCount++;
    $Page->RowCount++;

    // Set row properties
    $Page->resetAttributes();
    $Page->RowType = ROWTYPE_VIEW; // View

    // Get the field contents
    $Page->loadRowValues($Page->Recordset);

    // Render row
    $Page->renderRow();
?>
    <tr <?= $Page->rowAttributes() ?>>
<?php if ($Page->Aca_Id->Visible) { // Aca_Id ?>
        <td <?= $Page->Aca_Id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_academicranks_Aca_Id" class="academicranks_Aca_Id">
<span<?= $Page->Aca_Id->viewAttributes() ?>>
<?= $Page->Aca_Id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->Per_Id->Visible) { // Per_Id ?>
        <td <?= $Page->Per_Id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_academicranks_Per_Id" class="academicranks_Per_Id">
<span<?= $Page->Per_Id->viewAttributes() ?>>
<?= $Page->Per_Id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->Aca_RequesDate->Visible) { // Aca_RequesDate ?>
        <td <?= $Page->Aca_RequesDate->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_academicranks_Aca_RequesDate" class="academicranks_Aca_RequesDate">
<span<?= $Page->Aca_RequesDate->viewAttributes() ?>>
<?= $Page->Aca_RequesDate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->Aca_AcceptDate->Visible) { // Aca_AcceptDate ?>
        <td <?= $Page->Aca_AcceptDate->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_academicranks_Aca_AcceptDate" class="academicranks_Aca_AcceptDate">
<span<?= $Page->Aca_AcceptDate->viewAttributes() ?>>
<?= $Page->Aca_AcceptDate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->Aca_EstimateStart->Visible) { // Aca_EstimateStart ?>
        <td <?= $Page->Aca_EstimateStart->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_academicranks_Aca_EstimateStart" class="academicranks_Aca_EstimateStart">
<span<?= $Page->Aca_EstimateStart->viewAttributes() ?>>
<?= $Page->Aca_EstimateStart->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->Aca_EstimateEnd->Visible) { // Aca_EstimateEnd ?>
        <td <?= $Page->Aca_EstimateEnd->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_academicranks_Aca_EstimateEnd" class="academicranks_Aca_EstimateEnd">
<span<?= $Page->Aca_EstimateEnd->viewAttributes() ?>>
<?= $Page->Aca_EstimateEnd->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->Aca_Name->Visible) { // Aca_Name ?>
        <td <?= $Page->Aca_Name->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_academicranks_Aca_Name" class="academicranks_Aca_Name">
<span<?= $Page->Aca_Name->viewAttributes() ?>>
<?= $Page->Aca_Name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->Aca_Status->Visible) { // Aca_Status ?>
        <td <?= $Page->Aca_Status->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_academicranks_Aca_Status" class="academicranks_Aca_Status">
<span<?= $Page->Aca_Status->viewAttributes() ?>>
<?= $Page->Aca_Status->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->Aca_SkillMajor->Visible) { // Aca_SkillMajor ?>
        <td <?= $Page->Aca_SkillMajor->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_academicranks_Aca_SkillMajor" class="academicranks_Aca_SkillMajor">
<span<?= $Page->Aca_SkillMajor->viewAttributes() ?>>
<?= $Page->Aca_SkillMajor->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->Aca_Report->Visible) { // Aca_Report ?>
        <td <?= $Page->Aca_Report->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_academicranks_Aca_Report" class="academicranks_Aca_Report">
<span<?= $Page->Aca_Report->viewAttributes() ?>>
<?= $Page->Aca_Report->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->Aca_EstimateTeaching->Visible) { // Aca_EstimateTeaching ?>
        <td <?= $Page->Aca_EstimateTeaching->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_academicranks_Aca_EstimateTeaching" class="academicranks_Aca_EstimateTeaching">
<span<?= $Page->Aca_EstimateTeaching->viewAttributes() ?>>
<?= $Page->Aca_EstimateTeaching->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->Aca_EstimateBook->Visible) { // Aca_EstimateBook ?>
        <td <?= $Page->Aca_EstimateBook->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_academicranks_Aca_EstimateBook" class="academicranks_Aca_EstimateBook">
<span<?= $Page->Aca_EstimateBook->viewAttributes() ?>>
<?= $Page->Aca_EstimateBook->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->Aca_EstimateNum->Visible) { // Aca_EstimateNum ?>
        <td <?= $Page->Aca_EstimateNum->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_academicranks_Aca_EstimateNum" class="academicranks_Aca_EstimateNum">
<span<?= $Page->Aca_EstimateNum->viewAttributes() ?>>
<?= $Page->Aca_EstimateNum->getViewValue() ?></span>
</span>
</td>
<?php } ?>
    </tr>
<?php
    $Page->Recordset->moveNext();
}
$Page->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?= $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
