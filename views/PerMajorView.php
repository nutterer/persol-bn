<?php

namespace PHPMaker2021\upPersonnelv2;

// Page object
$PerMajorView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fper_majorview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    fper_majorview = currentForm = new ew.Form("fper_majorview", "view");
    loadjs.done("fper_majorview");
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
<form name="fper_majorview" id="fper_majorview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl() ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="per_major">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Page->Per_major_id->Visible) { // Per_major_id ?>
    <tr id="r_Per_major_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_per_major_Per_major_id"><?= $Page->Per_major_id->caption() ?></span></td>
        <td data-name="Per_major_id" <?= $Page->Per_major_id->cellAttributes() ?>>
<span id="el_per_major_Per_major_id">
<span<?= $Page->Per_major_id->viewAttributes() ?>>
<?= $Page->Per_major_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->Per_major_name->Visible) { // Per_major_name ?>
    <tr id="r_Per_major_name">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_per_major_Per_major_name"><?= $Page->Per_major_name->caption() ?></span></td>
        <td data-name="Per_major_name" <?= $Page->Per_major_name->cellAttributes() ?>>
<span id="el_per_major_Per_major_name">
<span<?= $Page->Per_major_name->viewAttributes() ?>>
<?= $Page->Per_major_name->getViewValue() ?></span>
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
