<?php

namespace PHPMaker2021\upPersonnel;

// Page object
$ReportView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var freportview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    freportview = currentForm = new ew.Form("freportview", "view");
    loadjs.done("freportview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<?php if (!$Page->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $Page->ExportOptions->render("body") ?>
<?php $Page->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="freportview" id="freportview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl() ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="report">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Page->Report_Id->Visible) { // Report_Id ?>
    <tr id="r_Report_Id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_report_Report_Id"><?= $Page->Report_Id->caption() ?></span></td>
        <td data-name="Report_Id" <?= $Page->Report_Id->cellAttributes() ?>>
<span id="el_report_Report_Id">
<span<?= $Page->Report_Id->viewAttributes() ?>>
<?= $Page->Report_Id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->Report_Year->Visible) { // Report_Year ?>
    <tr id="r_Report_Year">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_report_Report_Year"><?= $Page->Report_Year->caption() ?></span></td>
        <td data-name="Report_Year" <?= $Page->Report_Year->cellAttributes() ?>>
<span id="el_report_Report_Year">
<span<?= $Page->Report_Year->viewAttributes() ?>>
<?= $Page->Report_Year->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->Report_File->Visible) { // Report_File ?>
    <tr id="r_Report_File">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_report_Report_File"><?= $Page->Report_File->caption() ?></span></td>
        <td data-name="Report_File" <?= $Page->Report_File->cellAttributes() ?>>
<span id="el_report_Report_File">
<span<?= $Page->Report_File->viewAttributes() ?>>
<?= GetFileViewTag($Page->Report_File, $Page->Report_File->getViewValue(), false) ?>
</span>
</span>
</td>
    </tr>
<?php } ?>
</table>
</form>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<?php if (!$Page->isExport()) { ?>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
