<?php

namespace PHPMaker2021\upPersonnelv2;

// Page object
$GradAdmissionView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fgrad_admissionview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    fgrad_admissionview = currentForm = new ew.Form("fgrad_admissionview", "view");
    loadjs.done("fgrad_admissionview");
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
<form name="fgrad_admissionview" id="fgrad_admissionview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl() ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="grad_admission">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Page->Grad_Admission_id->Visible) { // Grad_Admission_id ?>
    <tr id="r_Grad_Admission_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_grad_admission_Grad_Admission_id"><?= $Page->Grad_Admission_id->caption() ?></span></td>
        <td data-name="Grad_Admission_id" <?= $Page->Grad_Admission_id->cellAttributes() ?>>
<span id="el_grad_admission_Grad_Admission_id">
<span<?= $Page->Grad_Admission_id->viewAttributes() ?>>
<?= $Page->Grad_Admission_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->Grad_Admission_name->Visible) { // Grad_Admission_name ?>
    <tr id="r_Grad_Admission_name">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_grad_admission_Grad_Admission_name"><?= $Page->Grad_Admission_name->caption() ?></span></td>
        <td data-name="Grad_Admission_name" <?= $Page->Grad_Admission_name->cellAttributes() ?>>
<span id="el_grad_admission_Grad_Admission_name">
<span<?= $Page->Grad_Admission_name->viewAttributes() ?>>
<?= $Page->Grad_Admission_name->getViewValue() ?></span>
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
