<?php

namespace PHPMaker2021\upPersonnelv2;

// Page object
$UsersDelete = &$Page;
?>
<script>
var currentForm, currentPageID;
var fusersdelete;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "delete";
    fusersdelete = currentForm = new ew.Form("fusersdelete", "delete");
    loadjs.done("fusersdelete");
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
<form name="fusersdelete" id="fusersdelete" class="form-inline ew-form ew-delete-form" action="<?= CurrentPageUrl() ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="users">
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
<?php if ($Page->Users__Id->Visible) { // Users _Id ?>
        <th class="<?= $Page->Users__Id->headerCellClass() ?>"><span id="elh_users_Users__Id" class="users_Users__Id"><?= $Page->Users__Id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->Per_Id->Visible) { // Per_Id ?>
        <th class="<?= $Page->Per_Id->headerCellClass() ?>"><span id="elh_users_Per_Id" class="users_Per_Id"><?= $Page->Per_Id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->Users_Name->Visible) { // Users_Name ?>
        <th class="<?= $Page->Users_Name->headerCellClass() ?>"><span id="elh_users_Users_Name" class="users_Users_Name"><?= $Page->Users_Name->caption() ?></span></th>
<?php } ?>
<?php if ($Page->Users_Password->Visible) { // Users_Password ?>
        <th class="<?= $Page->Users_Password->headerCellClass() ?>"><span id="elh_users_Users_Password" class="users_Users_Password"><?= $Page->Users_Password->caption() ?></span></th>
<?php } ?>
<?php if ($Page->Users_Permission->Visible) { // Users_Permission ?>
        <th class="<?= $Page->Users_Permission->headerCellClass() ?>"><span id="elh_users_Users_Permission" class="users_Users_Permission"><?= $Page->Users_Permission->caption() ?></span></th>
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
<?php if ($Page->Users__Id->Visible) { // Users _Id ?>
        <td <?= $Page->Users__Id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_users_Users__Id" class="users_Users__Id">
<span<?= $Page->Users__Id->viewAttributes() ?>>
<?= $Page->Users__Id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->Per_Id->Visible) { // Per_Id ?>
        <td <?= $Page->Per_Id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_users_Per_Id" class="users_Per_Id">
<span<?= $Page->Per_Id->viewAttributes() ?>>
<?= $Page->Per_Id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->Users_Name->Visible) { // Users_Name ?>
        <td <?= $Page->Users_Name->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_users_Users_Name" class="users_Users_Name">
<span<?= $Page->Users_Name->viewAttributes() ?>>
<?= $Page->Users_Name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->Users_Password->Visible) { // Users_Password ?>
        <td <?= $Page->Users_Password->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_users_Users_Password" class="users_Users_Password">
<span<?= $Page->Users_Password->viewAttributes() ?>>
<?= $Page->Users_Password->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->Users_Permission->Visible) { // Users_Permission ?>
        <td <?= $Page->Users_Permission->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_users_Users_Permission" class="users_Users_Permission">
<span<?= $Page->Users_Permission->viewAttributes() ?>>
<?= $Page->Users_Permission->getViewValue() ?></span>
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
