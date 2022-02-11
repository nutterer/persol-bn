<?php

namespace PHPMaker2021\upPersonnelv2;

// Page object
$AwardView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fawardview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    fawardview = currentForm = new ew.Form("fawardview", "view");
    loadjs.done("fawardview");
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
<form name="fawardview" id="fawardview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl() ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="award">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Page->Award_Id->Visible) { // Award_Id ?>
    <tr id="r_Award_Id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_award_Award_Id"><?= $Page->Award_Id->caption() ?></span></td>
        <td data-name="Award_Id" <?= $Page->Award_Id->cellAttributes() ?>>
<span id="el_award_Award_Id">
<span<?= $Page->Award_Id->viewAttributes() ?>>
<?= $Page->Award_Id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->Per_Id->Visible) { // Per_Id ?>
    <tr id="r_Per_Id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_award_Per_Id"><?= $Page->Per_Id->caption() ?></span></td>
        <td data-name="Per_Id" <?= $Page->Per_Id->cellAttributes() ?>>
<span id="el_award_Per_Id">
<span<?= $Page->Per_Id->viewAttributes() ?>>
<?= $Page->Per_Id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->Award_Name->Visible) { // Award_Name ?>
    <tr id="r_Award_Name">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_award_Award_Name"><?= $Page->Award_Name->caption() ?></span></td>
        <td data-name="Award_Name" <?= $Page->Award_Name->cellAttributes() ?>>
<span id="el_award_Award_Name">
<span<?= $Page->Award_Name->viewAttributes() ?>>
<?= $Page->Award_Name->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->Award_Year->Visible) { // Award_Year ?>
    <tr id="r_Award_Year">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_award_Award_Year"><?= $Page->Award_Year->caption() ?></span></td>
        <td data-name="Award_Year" <?= $Page->Award_Year->cellAttributes() ?>>
<span id="el_award_Award_Year">
<span<?= $Page->Award_Year->viewAttributes() ?>>
<?= $Page->Award_Year->getViewValue() ?></span>
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
