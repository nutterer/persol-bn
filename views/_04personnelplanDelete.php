<?php

namespace PHPMaker2021\upPersonnelv2;

// Page object
$_04personnelplanDelete = &$Page;
?>
<script>
var currentForm, currentPageID;
var f_04personnelplandelete;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "delete";
    f_04personnelplandelete = currentForm = new ew.Form("f_04personnelplandelete", "delete");
    loadjs.done("f_04personnelplandelete");
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
<form name="f_04personnelplandelete" id="f_04personnelplandelete" class="form-inline ew-form ew-delete-form" action="<?= CurrentPageUrl() ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="_04personnelplan">
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
<?php if ($Page->Plan_Year->Visible) { // Plan_Year ?>
        <th class="<?= $Page->Plan_Year->headerCellClass() ?>"><span id="elh__04personnelplan_Plan_Year" class="_04personnelplan_Plan_Year"><?= $Page->Plan_Year->caption() ?></span></th>
<?php } ?>
<?php if ($Page->Plan_File->Visible) { // Plan_File ?>
        <th class="<?= $Page->Plan_File->headerCellClass() ?>"><span id="elh__04personnelplan_Plan_File" class="_04personnelplan_Plan_File"><?= $Page->Plan_File->caption() ?></span></th>
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
<?php if ($Page->Plan_Year->Visible) { // Plan_Year ?>
        <td <?= $Page->Plan_Year->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>__04personnelplan_Plan_Year" class="_04personnelplan_Plan_Year">
<span<?= $Page->Plan_Year->viewAttributes() ?>>
<?= $Page->Plan_Year->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->Plan_File->Visible) { // Plan_File ?>
        <td <?= $Page->Plan_File->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>__04personnelplan_Plan_File" class="_04personnelplan_Plan_File">
<span<?= $Page->Plan_File->viewAttributes() ?>>
<?= $Page->Plan_File->getViewValue() ?></span>
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
