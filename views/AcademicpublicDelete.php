<?php

namespace PHPMaker2021\upPersonnelv2;

// Page object
$AcademicpublicDelete = &$Page;
?>
<script>
var currentForm, currentPageID;
var facademicpublicdelete;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "delete";
    facademicpublicdelete = currentForm = new ew.Form("facademicpublicdelete", "delete");
    loadjs.done("facademicpublicdelete");
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
<form name="facademicpublicdelete" id="facademicpublicdelete" class="form-inline ew-form ew-delete-form" action="<?= CurrentPageUrl() ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="academicpublic">
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
        <th class="<?= $Page->Aca_Id->headerCellClass() ?>"><span id="elh_academicpublic_Aca_Id" class="academicpublic_Aca_Id"><?= $Page->Aca_Id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->Public_Type->Visible) { // Public_Type ?>
        <th class="<?= $Page->Public_Type->headerCellClass() ?>"><span id="elh_academicpublic_Public_Type" class="academicpublic_Public_Type"><?= $Page->Public_Type->caption() ?></span></th>
<?php } ?>
<?php if ($Page->Public_Journal->Visible) { // Public_Journal ?>
        <th class="<?= $Page->Public_Journal->headerCellClass() ?>"><span id="elh_academicpublic_Public_Journal" class="academicpublic_Public_Journal"><?= $Page->Public_Journal->caption() ?></span></th>
<?php } ?>
<?php if ($Page->Public_Title->Visible) { // Public_Title ?>
        <th class="<?= $Page->Public_Title->headerCellClass() ?>"><span id="elh_academicpublic_Public_Title" class="academicpublic_Public_Title"><?= $Page->Public_Title->caption() ?></span></th>
<?php } ?>
<?php if ($Page->Public_Date->Visible) { // Public_Date ?>
        <th class="<?= $Page->Public_Date->headerCellClass() ?>"><span id="elh_academicpublic_Public_Date" class="academicpublic_Public_Date"><?= $Page->Public_Date->caption() ?></span></th>
<?php } ?>
<?php if ($Page->Public_Volum->Visible) { // Public_Volum ?>
        <th class="<?= $Page->Public_Volum->headerCellClass() ?>"><span id="elh_academicpublic_Public_Volum" class="academicpublic_Public_Volum"><?= $Page->Public_Volum->caption() ?></span></th>
<?php } ?>
<?php if ($Page->Public_Link->Visible) { // Public_Link ?>
        <th class="<?= $Page->Public_Link->headerCellClass() ?>"><span id="elh_academicpublic_Public_Link" class="academicpublic_Public_Link"><?= $Page->Public_Link->caption() ?></span></th>
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
<span id="el<?= $Page->RowCount ?>_academicpublic_Aca_Id" class="academicpublic_Aca_Id">
<span<?= $Page->Aca_Id->viewAttributes() ?>>
<?= $Page->Aca_Id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->Public_Type->Visible) { // Public_Type ?>
        <td <?= $Page->Public_Type->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_academicpublic_Public_Type" class="academicpublic_Public_Type">
<span<?= $Page->Public_Type->viewAttributes() ?>>
<?= $Page->Public_Type->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->Public_Journal->Visible) { // Public_Journal ?>
        <td <?= $Page->Public_Journal->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_academicpublic_Public_Journal" class="academicpublic_Public_Journal">
<span<?= $Page->Public_Journal->viewAttributes() ?>>
<?= $Page->Public_Journal->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->Public_Title->Visible) { // Public_Title ?>
        <td <?= $Page->Public_Title->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_academicpublic_Public_Title" class="academicpublic_Public_Title">
<span<?= $Page->Public_Title->viewAttributes() ?>>
<?= $Page->Public_Title->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->Public_Date->Visible) { // Public_Date ?>
        <td <?= $Page->Public_Date->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_academicpublic_Public_Date" class="academicpublic_Public_Date">
<span<?= $Page->Public_Date->viewAttributes() ?>>
<?= $Page->Public_Date->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->Public_Volum->Visible) { // Public_Volum ?>
        <td <?= $Page->Public_Volum->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_academicpublic_Public_Volum" class="academicpublic_Public_Volum">
<span<?= $Page->Public_Volum->viewAttributes() ?>>
<?= $Page->Public_Volum->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->Public_Link->Visible) { // Public_Link ?>
        <td <?= $Page->Public_Link->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_academicpublic_Public_Link" class="academicpublic_Public_Link">
<span<?= $Page->Public_Link->viewAttributes() ?>>
<?= $Page->Public_Link->getViewValue() ?></span>
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
