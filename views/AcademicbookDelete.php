<?php

namespace PHPMaker2021\upPersonnelv2;

// Page object
$AcademicbookDelete = &$Page;
?>
<script>
var currentForm, currentPageID;
var facademicbookdelete;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "delete";
    facademicbookdelete = currentForm = new ew.Form("facademicbookdelete", "delete");
    loadjs.done("facademicbookdelete");
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
<form name="facademicbookdelete" id="facademicbookdelete" class="form-inline ew-form ew-delete-form" action="<?= CurrentPageUrl() ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="academicbook">
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
        <th class="<?= $Page->Aca_Id->headerCellClass() ?>"><span id="elh_academicbook_Aca_Id" class="academicbook_Aca_Id"><?= $Page->Aca_Id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->Book_Type->Visible) { // Book_Type ?>
        <th class="<?= $Page->Book_Type->headerCellClass() ?>"><span id="elh_academicbook_Book_Type" class="academicbook_Book_Type"><?= $Page->Book_Type->caption() ?></span></th>
<?php } ?>
<?php if ($Page->Book_Cover->Visible) { // Book_Cover ?>
        <th class="<?= $Page->Book_Cover->headerCellClass() ?>"><span id="elh_academicbook_Book_Cover" class="academicbook_Book_Cover"><?= $Page->Book_Cover->caption() ?></span></th>
<?php } ?>
<?php if ($Page->Book_ISBN->Visible) { // Book_ISBN ?>
        <th class="<?= $Page->Book_ISBN->headerCellClass() ?>"><span id="elh_academicbook_Book_ISBN" class="academicbook_Book_ISBN"><?= $Page->Book_ISBN->caption() ?></span></th>
<?php } ?>
<?php if ($Page->Book_Patent->Visible) { // Book_Patent ?>
        <th class="<?= $Page->Book_Patent->headerCellClass() ?>"><span id="elh_academicbook_Book_Patent" class="academicbook_Book_Patent"><?= $Page->Book_Patent->caption() ?></span></th>
<?php } ?>
<?php if ($Page->Book_File->Visible) { // Book_File ?>
        <th class="<?= $Page->Book_File->headerCellClass() ?>"><span id="elh_academicbook_Book_File" class="academicbook_Book_File"><?= $Page->Book_File->caption() ?></span></th>
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
<span id="el<?= $Page->RowCount ?>_academicbook_Aca_Id" class="academicbook_Aca_Id">
<span<?= $Page->Aca_Id->viewAttributes() ?>>
<?= $Page->Aca_Id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->Book_Type->Visible) { // Book_Type ?>
        <td <?= $Page->Book_Type->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_academicbook_Book_Type" class="academicbook_Book_Type">
<span<?= $Page->Book_Type->viewAttributes() ?>>
<?= $Page->Book_Type->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->Book_Cover->Visible) { // Book_Cover ?>
        <td <?= $Page->Book_Cover->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_academicbook_Book_Cover" class="academicbook_Book_Cover">
<span<?= $Page->Book_Cover->viewAttributes() ?>>
<?= GetFileViewTag($Page->Book_Cover, $Page->Book_Cover->getViewValue(), false) ?>
</span>
</span>
</td>
<?php } ?>
<?php if ($Page->Book_ISBN->Visible) { // Book_ISBN ?>
        <td <?= $Page->Book_ISBN->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_academicbook_Book_ISBN" class="academicbook_Book_ISBN">
<span<?= $Page->Book_ISBN->viewAttributes() ?>>
<?= $Page->Book_ISBN->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->Book_Patent->Visible) { // Book_Patent ?>
        <td <?= $Page->Book_Patent->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_academicbook_Book_Patent" class="academicbook_Book_Patent">
<span<?= $Page->Book_Patent->viewAttributes() ?>>
<?= $Page->Book_Patent->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->Book_File->Visible) { // Book_File ?>
        <td <?= $Page->Book_File->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_academicbook_Book_File" class="academicbook_Book_File">
<span<?= $Page->Book_File->viewAttributes() ?>>
<?= GetFileViewTag($Page->Book_File, $Page->Book_File->getViewValue(), false) ?>
</span>
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
