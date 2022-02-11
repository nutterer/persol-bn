<?php

namespace PHPMaker2021\upPersonnel;

// Page object
$ReportDelete = &$Page;
?>
<script>
var currentForm, currentPageID;
var freportdelete;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "delete";
    freportdelete = currentForm = new ew.Form("freportdelete", "delete");
    loadjs.done("freportdelete");
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
<form name="freportdelete" id="freportdelete" class="form-inline ew-form ew-delete-form" action="<?= CurrentPageUrl() ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="report">
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
<?php if ($Page->Report_Id->Visible) { // Report_Id ?>
        <th class="<?= $Page->Report_Id->headerCellClass() ?>"><span id="elh_report_Report_Id" class="report_Report_Id"><?= $Page->Report_Id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->Report_Year->Visible) { // Report_Year ?>
        <th class="<?= $Page->Report_Year->headerCellClass() ?>"><span id="elh_report_Report_Year" class="report_Report_Year"><?= $Page->Report_Year->caption() ?></span></th>
<?php } ?>
<?php if ($Page->Report_File->Visible) { // Report_File ?>
        <th class="<?= $Page->Report_File->headerCellClass() ?>"><span id="elh_report_Report_File" class="report_Report_File"><?= $Page->Report_File->caption() ?></span></th>
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
<?php if ($Page->Report_Id->Visible) { // Report_Id ?>
        <td <?= $Page->Report_Id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_report_Report_Id" class="report_Report_Id">
<span<?= $Page->Report_Id->viewAttributes() ?>>
<?= $Page->Report_Id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->Report_Year->Visible) { // Report_Year ?>
        <td <?= $Page->Report_Year->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_report_Report_Year" class="report_Report_Year">
<span<?= $Page->Report_Year->viewAttributes() ?>>
<?= $Page->Report_Year->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->Report_File->Visible) { // Report_File ?>
        <td <?= $Page->Report_File->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_report_Report_File" class="report_Report_File">
<span<?= $Page->Report_File->viewAttributes() ?>>
<?= GetFileViewTag($Page->Report_File, $Page->Report_File->getViewValue(), false) ?>
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
