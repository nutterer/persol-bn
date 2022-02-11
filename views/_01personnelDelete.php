<?php

namespace PHPMaker2021\upPersonnelv2;

// Page object
$_01personnelDelete = &$Page;
?>
<script>
var currentForm, currentPageID;
var f_01personneldelete;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "delete";
    f_01personneldelete = currentForm = new ew.Form("f_01personneldelete", "delete");
    loadjs.done("f_01personneldelete");
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
<form name="f_01personneldelete" id="f_01personneldelete" class="form-inline ew-form ew-delete-form" action="<?= CurrentPageUrl() ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="_01personnel">
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
<?php if ($Page->Per_Id->Visible) { // Per_Id ?>
        <th class="<?= $Page->Per_Id->headerCellClass() ?>"><span id="elh__01personnel_Per_Id" class="_01personnel_Per_Id"><?= $Page->Per_Id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->Per_ThaiName->Visible) { // Per_ThaiName ?>
        <th class="<?= $Page->Per_ThaiName->headerCellClass() ?>"><span id="elh__01personnel_Per_ThaiName" class="_01personnel_Per_ThaiName"><?= $Page->Per_ThaiName->caption() ?></span></th>
<?php } ?>
<?php if ($Page->Per_ThaiLastName->Visible) { // Per_ThaiLastName ?>
        <th class="<?= $Page->Per_ThaiLastName->headerCellClass() ?>"><span id="elh__01personnel_Per_ThaiLastName" class="_01personnel_Per_ThaiLastName"><?= $Page->Per_ThaiLastName->caption() ?></span></th>
<?php } ?>
<?php if ($Page->Per_major->Visible) { // Per_major ?>
        <th class="<?= $Page->Per_major->headerCellClass() ?>"><span id="elh__01personnel_Per_major" class="_01personnel_Per_major"><?= $Page->Per_major->caption() ?></span></th>
<?php } ?>
<?php if ($Page->Per_Phone->Visible) { // Per_Phone ?>
        <th class="<?= $Page->Per_Phone->headerCellClass() ?>"><span id="elh__01personnel_Per_Phone" class="_01personnel_Per_Phone"><?= $Page->Per_Phone->caption() ?></span></th>
<?php } ?>
<?php if ($Page->Per_UPEmail->Visible) { // Per_UPEmail ?>
        <th class="<?= $Page->Per_UPEmail->headerCellClass() ?>"><span id="elh__01personnel_Per_UPEmail" class="_01personnel_Per_UPEmail"><?= $Page->Per_UPEmail->caption() ?></span></th>
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
<?php if ($Page->Per_Id->Visible) { // Per_Id ?>
        <td <?= $Page->Per_Id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>__01personnel_Per_Id" class="_01personnel_Per_Id">
<span<?= $Page->Per_Id->viewAttributes() ?>>
<?= $Page->Per_Id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->Per_ThaiName->Visible) { // Per_ThaiName ?>
        <td <?= $Page->Per_ThaiName->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>__01personnel_Per_ThaiName" class="_01personnel_Per_ThaiName">
<span<?= $Page->Per_ThaiName->viewAttributes() ?>>
<?= $Page->Per_ThaiName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->Per_ThaiLastName->Visible) { // Per_ThaiLastName ?>
        <td <?= $Page->Per_ThaiLastName->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>__01personnel_Per_ThaiLastName" class="_01personnel_Per_ThaiLastName">
<span<?= $Page->Per_ThaiLastName->viewAttributes() ?>>
<?= $Page->Per_ThaiLastName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->Per_major->Visible) { // Per_major ?>
        <td <?= $Page->Per_major->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>__01personnel_Per_major" class="_01personnel_Per_major">
<span<?= $Page->Per_major->viewAttributes() ?>>
<?= $Page->Per_major->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->Per_Phone->Visible) { // Per_Phone ?>
        <td <?= $Page->Per_Phone->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>__01personnel_Per_Phone" class="_01personnel_Per_Phone">
<span<?= $Page->Per_Phone->viewAttributes() ?>>
<?= $Page->Per_Phone->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->Per_UPEmail->Visible) { // Per_UPEmail ?>
        <td <?= $Page->Per_UPEmail->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>__01personnel_Per_UPEmail" class="_01personnel_Per_UPEmail">
<span<?= $Page->Per_UPEmail->viewAttributes() ?>>
<?= $Page->Per_UPEmail->getViewValue() ?></span>
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
