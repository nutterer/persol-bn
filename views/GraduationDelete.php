<?php

namespace PHPMaker2021\upPersonnelv2;

// Page object
$GraduationDelete = &$Page;
?>
<script>
var currentForm, currentPageID;
var fgraduationdelete;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "delete";
    fgraduationdelete = currentForm = new ew.Form("fgraduationdelete", "delete");
    loadjs.done("fgraduationdelete");
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
<form name="fgraduationdelete" id="fgraduationdelete" class="form-inline ew-form ew-delete-form" action="<?= CurrentPageUrl() ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="graduation">
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
        <th class="<?= $Page->Per_Id->headerCellClass() ?>"><span id="elh_graduation_Per_Id" class="graduation_Per_Id"><?= $Page->Per_Id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->Grad_Institution->Visible) { // Grad_Institution ?>
        <th class="<?= $Page->Grad_Institution->headerCellClass() ?>"><span id="elh_graduation_Grad_Institution" class="graduation_Grad_Institution"><?= $Page->Grad_Institution->caption() ?></span></th>
<?php } ?>
<?php if ($Page->Grad_Provinces->Visible) { // Grad_Provinces ?>
        <th class="<?= $Page->Grad_Provinces->headerCellClass() ?>"><span id="elh_graduation_Grad_Provinces" class="graduation_Grad_Provinces"><?= $Page->Grad_Provinces->caption() ?></span></th>
<?php } ?>
<?php if ($Page->Grad_Country->Visible) { // Grad_Country ?>
        <th class="<?= $Page->Grad_Country->headerCellClass() ?>"><span id="elh_graduation_Grad_Country" class="graduation_Grad_Country"><?= $Page->Grad_Country->caption() ?></span></th>
<?php } ?>
<?php if ($Page->Grad_Start->Visible) { // Grad_Start ?>
        <th class="<?= $Page->Grad_Start->headerCellClass() ?>"><span id="elh_graduation_Grad_Start" class="graduation_Grad_Start"><?= $Page->Grad_Start->caption() ?></span></th>
<?php } ?>
<?php if ($Page->Grad_End->Visible) { // Grad_End ?>
        <th class="<?= $Page->Grad_End->headerCellClass() ?>"><span id="elh_graduation_Grad_End" class="graduation_Grad_End"><?= $Page->Grad_End->caption() ?></span></th>
<?php } ?>
<?php if ($Page->Grad_GPA->Visible) { // Grad_GPA ?>
        <th class="<?= $Page->Grad_GPA->headerCellClass() ?>"><span id="elh_graduation_Grad_GPA" class="graduation_Grad_GPA"><?= $Page->Grad_GPA->caption() ?></span></th>
<?php } ?>
<?php if ($Page->Grad_Honor->Visible) { // Grad_Honor ?>
        <th class="<?= $Page->Grad_Honor->headerCellClass() ?>"><span id="elh_graduation_Grad_Honor" class="graduation_Grad_Honor"><?= $Page->Grad_Honor->caption() ?></span></th>
<?php } ?>
<?php if ($Page->Grad_Admission->Visible) { // Grad_Admission ?>
        <th class="<?= $Page->Grad_Admission->headerCellClass() ?>"><span id="elh_graduation_Grad_Admission" class="graduation_Grad_Admission"><?= $Page->Grad_Admission->caption() ?></span></th>
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
<span id="el<?= $Page->RowCount ?>_graduation_Per_Id" class="graduation_Per_Id">
<span<?= $Page->Per_Id->viewAttributes() ?>>
<?= $Page->Per_Id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->Grad_Institution->Visible) { // Grad_Institution ?>
        <td <?= $Page->Grad_Institution->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_graduation_Grad_Institution" class="graduation_Grad_Institution">
<span<?= $Page->Grad_Institution->viewAttributes() ?>>
<?= $Page->Grad_Institution->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->Grad_Provinces->Visible) { // Grad_Provinces ?>
        <td <?= $Page->Grad_Provinces->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_graduation_Grad_Provinces" class="graduation_Grad_Provinces">
<span<?= $Page->Grad_Provinces->viewAttributes() ?>>
<?= $Page->Grad_Provinces->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->Grad_Country->Visible) { // Grad_Country ?>
        <td <?= $Page->Grad_Country->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_graduation_Grad_Country" class="graduation_Grad_Country">
<span<?= $Page->Grad_Country->viewAttributes() ?>>
<?= $Page->Grad_Country->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->Grad_Start->Visible) { // Grad_Start ?>
        <td <?= $Page->Grad_Start->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_graduation_Grad_Start" class="graduation_Grad_Start">
<span<?= $Page->Grad_Start->viewAttributes() ?>>
<?= $Page->Grad_Start->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->Grad_End->Visible) { // Grad_End ?>
        <td <?= $Page->Grad_End->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_graduation_Grad_End" class="graduation_Grad_End">
<span<?= $Page->Grad_End->viewAttributes() ?>>
<?= $Page->Grad_End->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->Grad_GPA->Visible) { // Grad_GPA ?>
        <td <?= $Page->Grad_GPA->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_graduation_Grad_GPA" class="graduation_Grad_GPA">
<span<?= $Page->Grad_GPA->viewAttributes() ?>>
<?= $Page->Grad_GPA->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->Grad_Honor->Visible) { // Grad_Honor ?>
        <td <?= $Page->Grad_Honor->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_graduation_Grad_Honor" class="graduation_Grad_Honor">
<span<?= $Page->Grad_Honor->viewAttributes() ?>>
<?= $Page->Grad_Honor->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->Grad_Admission->Visible) { // Grad_Admission ?>
        <td <?= $Page->Grad_Admission->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_graduation_Grad_Admission" class="graduation_Grad_Admission">
<span<?= $Page->Grad_Admission->viewAttributes() ?>>
<?= $Page->Grad_Admission->getViewValue() ?></span>
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
