<?php

namespace PHPMaker2021\upPersonnelv2;

// Page object
$_04personnelplanView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var f_04personnelplanview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    f_04personnelplanview = currentForm = new ew.Form("f_04personnelplanview", "view");
    loadjs.done("f_04personnelplanview");
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
<form name="f_04personnelplanview" id="f_04personnelplanview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl() ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="_04personnelplan">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Page->Plan_Id->Visible) { // Plan_Id ?>
    <tr id="r_Plan_Id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh__04personnelplan_Plan_Id"><?= $Page->Plan_Id->caption() ?></span></td>
        <td data-name="Plan_Id" <?= $Page->Plan_Id->cellAttributes() ?>>
<span id="el__04personnelplan_Plan_Id">
<span<?= $Page->Plan_Id->viewAttributes() ?>>
<?= $Page->Plan_Id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->Plan_Year->Visible) { // Plan_Year ?>
    <tr id="r_Plan_Year">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh__04personnelplan_Plan_Year"><?= $Page->Plan_Year->caption() ?></span></td>
        <td data-name="Plan_Year" <?= $Page->Plan_Year->cellAttributes() ?>>
<span id="el__04personnelplan_Plan_Year">
<span<?= $Page->Plan_Year->viewAttributes() ?>>
<?= $Page->Plan_Year->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->Plan_File->Visible) { // Plan_File ?>
    <tr id="r_Plan_File">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh__04personnelplan_Plan_File"><?= $Page->Plan_File->caption() ?></span></td>
        <td data-name="Plan_File" <?= $Page->Plan_File->cellAttributes() ?>>
<span id="el__04personnelplan_Plan_File">
<span<?= $Page->Plan_File->viewAttributes() ?>>
<?= $Page->Plan_File->getViewValue() ?></span>
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
