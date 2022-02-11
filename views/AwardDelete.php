<?php

namespace PHPMaker2021\upPersonnelv2;

// Page object
$AwardDelete = &$Page;
?>
<script>
var currentForm, currentPageID;
var fawarddelete;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "delete";
    fawarddelete = currentForm = new ew.Form("fawarddelete", "delete");
    loadjs.done("fawarddelete");
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
<form name="fawarddelete" id="fawarddelete" class="form-inline ew-form ew-delete-form" action="<?= CurrentPageUrl() ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="award">
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
<?php if ($Page->Per_Id->Visible) { // Per_Id ?>
        <th class="<?= $Page->Per_Id->headerCellClass() ?>"><span id="elh_award_Per_Id" class="award_Per_Id"><?= $Page->Per_Id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->Award_Name->Visible) { // Award_Name ?>
        <th class="<?= $Page->Award_Name->headerCellClass() ?>"><span id="elh_award_Award_Name" class="award_Award_Name"><?= $Page->Award_Name->caption() ?></span></th>
<?php } ?>
<?php if ($Page->Award_Year->Visible) { // Award_Year ?>
        <th class="<?= $Page->Award_Year->headerCellClass() ?>"><span id="elh_award_Award_Year" class="award_Award_Year"><?= $Page->Award_Year->caption() ?></span></th>
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
<?php if ($Page->Per_Id->Visible) { // Per_Id ?>
        <td <?= $Page->Per_Id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_award_Per_Id" class="award_Per_Id">
<span<?= $Page->Per_Id->viewAttributes() ?>>
<?= $Page->Per_Id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->Award_Name->Visible) { // Award_Name ?>
        <td <?= $Page->Award_Name->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_award_Award_Name" class="award_Award_Name">
<span<?= $Page->Award_Name->viewAttributes() ?>>
<?= $Page->Award_Name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->Award_Year->Visible) { // Award_Year ?>
        <td <?= $Page->Award_Year->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_award_Award_Year" class="award_Award_Year">
<span<?= $Page->Award_Year->viewAttributes() ?>>
<?= $Page->Award_Year->getViewValue() ?></span>
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
