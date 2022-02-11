<?php

namespace PHPMaker2021\upPersonnelv2;

// Page object
$StudyleavetypeDelete = &$Page;
?>
<script>
var currentForm, currentPageID;
var fstudyleavetypedelete;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "delete";
    fstudyleavetypedelete = currentForm = new ew.Form("fstudyleavetypedelete", "delete");
    loadjs.done("fstudyleavetypedelete");
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
<form name="fstudyleavetypedelete" id="fstudyleavetypedelete" class="form-inline ew-form ew-delete-form" action="<?= CurrentPageUrl() ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="studyleavetype">
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
<?php if ($Page->StudyLeaveType_Name->Visible) { // StudyLeaveType_Name ?>
        <th class="<?= $Page->StudyLeaveType_Name->headerCellClass() ?>"><span id="elh_studyleavetype_StudyLeaveType_Name" class="studyleavetype_StudyLeaveType_Name"><?= $Page->StudyLeaveType_Name->caption() ?></span></th>
<?php } ?>
<?php if ($Page->StudyLeaveType__Institution->Visible) { // StudyLeaveType_ Institution ?>
        <th class="<?= $Page->StudyLeaveType__Institution->headerCellClass() ?>"><span id="elh_studyleavetype_StudyLeaveType__Institution" class="studyleavetype_StudyLeaveType__Institution"><?= $Page->StudyLeaveType__Institution->caption() ?></span></th>
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
<?php if ($Page->StudyLeaveType_Name->Visible) { // StudyLeaveType_Name ?>
        <td <?= $Page->StudyLeaveType_Name->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_studyleavetype_StudyLeaveType_Name" class="studyleavetype_StudyLeaveType_Name">
<span<?= $Page->StudyLeaveType_Name->viewAttributes() ?>>
<?= $Page->StudyLeaveType_Name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->StudyLeaveType__Institution->Visible) { // StudyLeaveType_ Institution ?>
        <td <?= $Page->StudyLeaveType__Institution->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_studyleavetype_StudyLeaveType__Institution" class="studyleavetype_StudyLeaveType__Institution">
<span<?= $Page->StudyLeaveType__Institution->viewAttributes() ?>>
<?= $Page->StudyLeaveType__Institution->getViewValue() ?></span>
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
