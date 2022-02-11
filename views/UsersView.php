<?php

namespace PHPMaker2021\upPersonnelv2;

// Page object
$UsersView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fusersview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    fusersview = currentForm = new ew.Form("fusersview", "view");
    loadjs.done("fusersview");
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
<form name="fusersview" id="fusersview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl() ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="users">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Page->Users__Id->Visible) { // Users _Id ?>
    <tr id="r_Users__Id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_users_Users__Id"><?= $Page->Users__Id->caption() ?></span></td>
        <td data-name="Users__Id" <?= $Page->Users__Id->cellAttributes() ?>>
<span id="el_users_Users__Id">
<span<?= $Page->Users__Id->viewAttributes() ?>>
<?= $Page->Users__Id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->Per_Id->Visible) { // Per_Id ?>
    <tr id="r_Per_Id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_users_Per_Id"><?= $Page->Per_Id->caption() ?></span></td>
        <td data-name="Per_Id" <?= $Page->Per_Id->cellAttributes() ?>>
<span id="el_users_Per_Id">
<span<?= $Page->Per_Id->viewAttributes() ?>>
<?= $Page->Per_Id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->Users_Name->Visible) { // Users_Name ?>
    <tr id="r_Users_Name">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_users_Users_Name"><?= $Page->Users_Name->caption() ?></span></td>
        <td data-name="Users_Name" <?= $Page->Users_Name->cellAttributes() ?>>
<span id="el_users_Users_Name">
<span<?= $Page->Users_Name->viewAttributes() ?>>
<?= $Page->Users_Name->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->Users_Password->Visible) { // Users_Password ?>
    <tr id="r_Users_Password">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_users_Users_Password"><?= $Page->Users_Password->caption() ?></span></td>
        <td data-name="Users_Password" <?= $Page->Users_Password->cellAttributes() ?>>
<span id="el_users_Users_Password">
<span<?= $Page->Users_Password->viewAttributes() ?>>
<?= $Page->Users_Password->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->Users_Permission->Visible) { // Users_Permission ?>
    <tr id="r_Users_Permission">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_users_Users_Permission"><?= $Page->Users_Permission->caption() ?></span></td>
        <td data-name="Users_Permission" <?= $Page->Users_Permission->cellAttributes() ?>>
<span id="el_users_Users_Permission">
<span<?= $Page->Users_Permission->viewAttributes() ?>>
<?= $Page->Users_Permission->getViewValue() ?></span>
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
