<?php

namespace PHPMaker2021\upPersonnel;

// Page object
$PersonnelplanDelete = &$Page;
?>
<script>
var currentForm, currentPageID;
var fpersonnelplandelete;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "delete";
    fpersonnelplandelete = currentForm = new ew.Form("fpersonnelplandelete", "delete");
    loadjs.done("fpersonnelplandelete");
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
<form name="fpersonnelplandelete" id="fpersonnelplandelete" class="form-inline ew-form ew-delete-form" action="<?= CurrentPageUrl() ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="personnelplan">
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
<?php if ($Page->Plan_Id->Visible) { // Plan_Id ?>
        <th class="<?= $Page->Plan_Id->headerCellClass() ?>"><span id="elh_personnelplan_Plan_Id" class="personnelplan_Plan_Id"><?= $Page->Plan_Id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->Plan_Year->Visible) { // Plan_Year ?>
        <th class="<?= $Page->Plan_Year->headerCellClass() ?>"><span id="elh_personnelplan_Plan_Year" class="personnelplan_Plan_Year"><?= $Page->Plan_Year->caption() ?></span></th>
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
<?php if ($Page->Plan_Id->Visible) { // Plan_Id ?>
        <td <?= $Page->Plan_Id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_personnelplan_Plan_Id" class="personnelplan_Plan_Id">
<span<?= $Page->Plan_Id->viewAttributes() ?>>
<?= $Page->Plan_Id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->Plan_Year->Visible) { // Plan_Year ?>
        <td <?= $Page->Plan_Year->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_personnelplan_Plan_Year" class="personnelplan_Plan_Year">
<span<?= $Page->Plan_Year->viewAttributes() ?>>
<?= $Page->Plan_Year->getViewValue() ?></span>
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
