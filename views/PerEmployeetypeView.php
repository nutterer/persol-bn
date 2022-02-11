<?php

namespace PHPMaker2021\upPersonnelv2;

// Page object
$PerEmployeetypeView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fper_employeetypeview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    fper_employeetypeview = currentForm = new ew.Form("fper_employeetypeview", "view");
    loadjs.done("fper_employeetypeview");
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
<form name="fper_employeetypeview" id="fper_employeetypeview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl() ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="per_employeetype">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Page->Per_EmployeeType_id->Visible) { // Per_EmployeeType_id ?>
    <tr id="r_Per_EmployeeType_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_per_employeetype_Per_EmployeeType_id"><?= $Page->Per_EmployeeType_id->caption() ?></span></td>
        <td data-name="Per_EmployeeType_id" <?= $Page->Per_EmployeeType_id->cellAttributes() ?>>
<span id="el_per_employeetype_Per_EmployeeType_id">
<span<?= $Page->Per_EmployeeType_id->viewAttributes() ?>>
<?= $Page->Per_EmployeeType_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->Per_EmployeeType_name->Visible) { // Per_EmployeeType_name ?>
    <tr id="r_Per_EmployeeType_name">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_per_employeetype_Per_EmployeeType_name"><?= $Page->Per_EmployeeType_name->caption() ?></span></td>
        <td data-name="Per_EmployeeType_name" <?= $Page->Per_EmployeeType_name->cellAttributes() ?>>
<span id="el_per_employeetype_Per_EmployeeType_name">
<span<?= $Page->Per_EmployeeType_name->viewAttributes() ?>>
<?= $Page->Per_EmployeeType_name->getViewValue() ?></span>
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
