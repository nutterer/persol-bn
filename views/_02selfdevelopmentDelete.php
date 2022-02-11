<?php

namespace PHPMaker2021\upPersonnelv2;

// Page object
$_02selfdevelopmentDelete = &$Page;
?>
<script>
var currentForm, currentPageID;
var f_02selfdevelopmentdelete;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "delete";
    f_02selfdevelopmentdelete = currentForm = new ew.Form("f_02selfdevelopmentdelete", "delete");
    loadjs.done("f_02selfdevelopmentdelete");
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
<form name="f_02selfdevelopmentdelete" id="f_02selfdevelopmentdelete" class="form-inline ew-form ew-delete-form" action="<?= CurrentPageUrl() ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="_02selfdevelopment">
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
        <th class="<?= $Page->Per_Id->headerCellClass() ?>"><span id="elh__02selfdevelopment_Per_Id" class="_02selfdevelopment_Per_Id"><?= $Page->Per_Id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->SelfDev_Type->Visible) { // SelfDev_Type ?>
        <th class="<?= $Page->SelfDev_Type->headerCellClass() ?>"><span id="elh__02selfdevelopment_SelfDev_Type" class="_02selfdevelopment_SelfDev_Type"><?= $Page->SelfDev_Type->caption() ?></span></th>
<?php } ?>
<?php if ($Page->SelfDev_StartDate->Visible) { // SelfDev_StartDate ?>
        <th class="<?= $Page->SelfDev_StartDate->headerCellClass() ?>"><span id="elh__02selfdevelopment_SelfDev_StartDate" class="_02selfdevelopment_SelfDev_StartDate"><?= $Page->SelfDev_StartDate->caption() ?></span></th>
<?php } ?>
<?php if ($Page->SelfDev_EndDate->Visible) { // SelfDev_EndDate ?>
        <th class="<?= $Page->SelfDev_EndDate->headerCellClass() ?>"><span id="elh__02selfdevelopment_SelfDev_EndDate" class="_02selfdevelopment_SelfDev_EndDate"><?= $Page->SelfDev_EndDate->caption() ?></span></th>
<?php } ?>
<?php if ($Page->SelfDev_Money->Visible) { // SelfDev_Money ?>
        <th class="<?= $Page->SelfDev_Money->headerCellClass() ?>"><span id="elh__02selfdevelopment_SelfDev_Money" class="_02selfdevelopment_SelfDev_Money"><?= $Page->SelfDev_Money->caption() ?></span></th>
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
<span id="el<?= $Page->RowCount ?>__02selfdevelopment_Per_Id" class="_02selfdevelopment_Per_Id">
<span<?= $Page->Per_Id->viewAttributes() ?>>
<?= $Page->Per_Id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->SelfDev_Type->Visible) { // SelfDev_Type ?>
        <td <?= $Page->SelfDev_Type->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>__02selfdevelopment_SelfDev_Type" class="_02selfdevelopment_SelfDev_Type">
<span<?= $Page->SelfDev_Type->viewAttributes() ?>>
<?= $Page->SelfDev_Type->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->SelfDev_StartDate->Visible) { // SelfDev_StartDate ?>
        <td <?= $Page->SelfDev_StartDate->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>__02selfdevelopment_SelfDev_StartDate" class="_02selfdevelopment_SelfDev_StartDate">
<span<?= $Page->SelfDev_StartDate->viewAttributes() ?>>
<?= $Page->SelfDev_StartDate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->SelfDev_EndDate->Visible) { // SelfDev_EndDate ?>
        <td <?= $Page->SelfDev_EndDate->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>__02selfdevelopment_SelfDev_EndDate" class="_02selfdevelopment_SelfDev_EndDate">
<span<?= $Page->SelfDev_EndDate->viewAttributes() ?>>
<?= $Page->SelfDev_EndDate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->SelfDev_Money->Visible) { // SelfDev_Money ?>
        <td <?= $Page->SelfDev_Money->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>__02selfdevelopment_SelfDev_Money" class="_02selfdevelopment_SelfDev_Money">
<span<?= $Page->SelfDev_Money->viewAttributes() ?>>
<?= $Page->SelfDev_Money->getViewValue() ?></span>
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
