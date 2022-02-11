<?php

namespace PHPMaker2021\upPersonnelv2;

// Page object
$_02selfdevelopmentView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var f_02selfdevelopmentview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    f_02selfdevelopmentview = currentForm = new ew.Form("f_02selfdevelopmentview", "view");
    loadjs.done("f_02selfdevelopmentview");
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
<form name="f_02selfdevelopmentview" id="f_02selfdevelopmentview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl() ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="_02selfdevelopment">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Page->SelfDev_Id->Visible) { // SelfDev_Id ?>
    <tr id="r_SelfDev_Id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh__02selfdevelopment_SelfDev_Id"><?= $Page->SelfDev_Id->caption() ?></span></td>
        <td data-name="SelfDev_Id" <?= $Page->SelfDev_Id->cellAttributes() ?>>
<span id="el__02selfdevelopment_SelfDev_Id">
<span<?= $Page->SelfDev_Id->viewAttributes() ?>>
<?= $Page->SelfDev_Id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->Per_Id->Visible) { // Per_Id ?>
    <tr id="r_Per_Id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh__02selfdevelopment_Per_Id"><?= $Page->Per_Id->caption() ?></span></td>
        <td data-name="Per_Id" <?= $Page->Per_Id->cellAttributes() ?>>
<span id="el__02selfdevelopment_Per_Id">
<span<?= $Page->Per_Id->viewAttributes() ?>>
<?= $Page->Per_Id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->SelfDev_Type->Visible) { // SelfDev_Type ?>
    <tr id="r_SelfDev_Type">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh__02selfdevelopment_SelfDev_Type"><?= $Page->SelfDev_Type->caption() ?></span></td>
        <td data-name="SelfDev_Type" <?= $Page->SelfDev_Type->cellAttributes() ?>>
<span id="el__02selfdevelopment_SelfDev_Type">
<span<?= $Page->SelfDev_Type->viewAttributes() ?>>
<?= $Page->SelfDev_Type->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->SelfDev_Name->Visible) { // SelfDev_Name ?>
    <tr id="r_SelfDev_Name">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh__02selfdevelopment_SelfDev_Name"><?= $Page->SelfDev_Name->caption() ?></span></td>
        <td data-name="SelfDev_Name" <?= $Page->SelfDev_Name->cellAttributes() ?>>
<span id="el__02selfdevelopment_SelfDev_Name">
<span<?= $Page->SelfDev_Name->viewAttributes() ?>>
<?= $Page->SelfDev_Name->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->SelfDev_StartDate->Visible) { // SelfDev_StartDate ?>
    <tr id="r_SelfDev_StartDate">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh__02selfdevelopment_SelfDev_StartDate"><?= $Page->SelfDev_StartDate->caption() ?></span></td>
        <td data-name="SelfDev_StartDate" <?= $Page->SelfDev_StartDate->cellAttributes() ?>>
<span id="el__02selfdevelopment_SelfDev_StartDate">
<span<?= $Page->SelfDev_StartDate->viewAttributes() ?>>
<?= $Page->SelfDev_StartDate->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->SelfDev_EndDate->Visible) { // SelfDev_EndDate ?>
    <tr id="r_SelfDev_EndDate">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh__02selfdevelopment_SelfDev_EndDate"><?= $Page->SelfDev_EndDate->caption() ?></span></td>
        <td data-name="SelfDev_EndDate" <?= $Page->SelfDev_EndDate->cellAttributes() ?>>
<span id="el__02selfdevelopment_SelfDev_EndDate">
<span<?= $Page->SelfDev_EndDate->viewAttributes() ?>>
<?= $Page->SelfDev_EndDate->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->SelfDev_Money->Visible) { // SelfDev_Money ?>
    <tr id="r_SelfDev_Money">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh__02selfdevelopment_SelfDev_Money"><?= $Page->SelfDev_Money->caption() ?></span></td>
        <td data-name="SelfDev_Money" <?= $Page->SelfDev_Money->cellAttributes() ?>>
<span id="el__02selfdevelopment_SelfDev_Money">
<span<?= $Page->SelfDev_Money->viewAttributes() ?>>
<?= $Page->SelfDev_Money->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->SelfDev_Address->Visible) { // SelfDev_Address ?>
    <tr id="r_SelfDev_Address">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh__02selfdevelopment_SelfDev_Address"><?= $Page->SelfDev_Address->caption() ?></span></td>
        <td data-name="SelfDev_Address" <?= $Page->SelfDev_Address->cellAttributes() ?>>
<span id="el__02selfdevelopment_SelfDev_Address">
<span<?= $Page->SelfDev_Address->viewAttributes() ?>>
<?= $Page->SelfDev_Address->getViewValue() ?></span>
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
