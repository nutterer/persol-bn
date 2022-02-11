<?php

namespace PHPMaker2021\upPersonnelv2;

// Page object
$StudyleavetypeView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fstudyleavetypeview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    fstudyleavetypeview = currentForm = new ew.Form("fstudyleavetypeview", "view");
    loadjs.done("fstudyleavetypeview");
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
<form name="fstudyleavetypeview" id="fstudyleavetypeview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl() ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="studyleavetype">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Page->StudyLeaveType_Id->Visible) { // StudyLeaveType_Id ?>
    <tr id="r_StudyLeaveType_Id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_studyleavetype_StudyLeaveType_Id"><?= $Page->StudyLeaveType_Id->caption() ?></span></td>
        <td data-name="StudyLeaveType_Id" <?= $Page->StudyLeaveType_Id->cellAttributes() ?>>
<span id="el_studyleavetype_StudyLeaveType_Id">
<span<?= $Page->StudyLeaveType_Id->viewAttributes() ?>>
<?= $Page->StudyLeaveType_Id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->StudyLeaveType_Name->Visible) { // StudyLeaveType_Name ?>
    <tr id="r_StudyLeaveType_Name">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_studyleavetype_StudyLeaveType_Name"><?= $Page->StudyLeaveType_Name->caption() ?></span></td>
        <td data-name="StudyLeaveType_Name" <?= $Page->StudyLeaveType_Name->cellAttributes() ?>>
<span id="el_studyleavetype_StudyLeaveType_Name">
<span<?= $Page->StudyLeaveType_Name->viewAttributes() ?>>
<?= $Page->StudyLeaveType_Name->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->StudyLeaveType__Institution->Visible) { // StudyLeaveType_ Institution ?>
    <tr id="r_StudyLeaveType__Institution">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_studyleavetype_StudyLeaveType__Institution"><?= $Page->StudyLeaveType__Institution->caption() ?></span></td>
        <td data-name="StudyLeaveType__Institution" <?= $Page->StudyLeaveType__Institution->cellAttributes() ?>>
<span id="el_studyleavetype_StudyLeaveType__Institution">
<span<?= $Page->StudyLeaveType__Institution->viewAttributes() ?>>
<?= $Page->StudyLeaveType__Institution->getViewValue() ?></span>
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
