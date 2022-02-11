<?php

namespace PHPMaker2021\upPersonnelv2;

// Page object
$AcademicpublicView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var facademicpublicview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    facademicpublicview = currentForm = new ew.Form("facademicpublicview", "view");
    loadjs.done("facademicpublicview");
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
<form name="facademicpublicview" id="facademicpublicview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl() ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="academicpublic">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Page->Public_Id->Visible) { // Public_Id ?>
    <tr id="r_Public_Id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_academicpublic_Public_Id"><?= $Page->Public_Id->caption() ?></span></td>
        <td data-name="Public_Id" <?= $Page->Public_Id->cellAttributes() ?>>
<span id="el_academicpublic_Public_Id">
<span<?= $Page->Public_Id->viewAttributes() ?>>
<?= $Page->Public_Id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->Aca_Id->Visible) { // Aca_Id ?>
    <tr id="r_Aca_Id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_academicpublic_Aca_Id"><?= $Page->Aca_Id->caption() ?></span></td>
        <td data-name="Aca_Id" <?= $Page->Aca_Id->cellAttributes() ?>>
<span id="el_academicpublic_Aca_Id">
<span<?= $Page->Aca_Id->viewAttributes() ?>>
<?= $Page->Aca_Id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->Public_Type->Visible) { // Public_Type ?>
    <tr id="r_Public_Type">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_academicpublic_Public_Type"><?= $Page->Public_Type->caption() ?></span></td>
        <td data-name="Public_Type" <?= $Page->Public_Type->cellAttributes() ?>>
<span id="el_academicpublic_Public_Type">
<span<?= $Page->Public_Type->viewAttributes() ?>>
<?= $Page->Public_Type->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->Public_Journal->Visible) { // Public_Journal ?>
    <tr id="r_Public_Journal">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_academicpublic_Public_Journal"><?= $Page->Public_Journal->caption() ?></span></td>
        <td data-name="Public_Journal" <?= $Page->Public_Journal->cellAttributes() ?>>
<span id="el_academicpublic_Public_Journal">
<span<?= $Page->Public_Journal->viewAttributes() ?>>
<?= $Page->Public_Journal->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->Public_Title->Visible) { // Public_Title ?>
    <tr id="r_Public_Title">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_academicpublic_Public_Title"><?= $Page->Public_Title->caption() ?></span></td>
        <td data-name="Public_Title" <?= $Page->Public_Title->cellAttributes() ?>>
<span id="el_academicpublic_Public_Title">
<span<?= $Page->Public_Title->viewAttributes() ?>>
<?= $Page->Public_Title->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->Public_Date->Visible) { // Public_Date ?>
    <tr id="r_Public_Date">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_academicpublic_Public_Date"><?= $Page->Public_Date->caption() ?></span></td>
        <td data-name="Public_Date" <?= $Page->Public_Date->cellAttributes() ?>>
<span id="el_academicpublic_Public_Date">
<span<?= $Page->Public_Date->viewAttributes() ?>>
<?= $Page->Public_Date->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->Public_Volum->Visible) { // Public_Volum ?>
    <tr id="r_Public_Volum">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_academicpublic_Public_Volum"><?= $Page->Public_Volum->caption() ?></span></td>
        <td data-name="Public_Volum" <?= $Page->Public_Volum->cellAttributes() ?>>
<span id="el_academicpublic_Public_Volum">
<span<?= $Page->Public_Volum->viewAttributes() ?>>
<?= $Page->Public_Volum->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->Public_Link->Visible) { // Public_Link ?>
    <tr id="r_Public_Link">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_academicpublic_Public_Link"><?= $Page->Public_Link->caption() ?></span></td>
        <td data-name="Public_Link" <?= $Page->Public_Link->cellAttributes() ?>>
<span id="el_academicpublic_Public_Link">
<span<?= $Page->Public_Link->viewAttributes() ?>>
<?= $Page->Public_Link->getViewValue() ?></span>
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
