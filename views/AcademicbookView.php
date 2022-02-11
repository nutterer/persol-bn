<?php

namespace PHPMaker2021\upPersonnelv2;

// Page object
$AcademicbookView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var facademicbookview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    facademicbookview = currentForm = new ew.Form("facademicbookview", "view");
    loadjs.done("facademicbookview");
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
<form name="facademicbookview" id="facademicbookview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl() ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="academicbook">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Page->Book_Id->Visible) { // Book_Id ?>
    <tr id="r_Book_Id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_academicbook_Book_Id"><?= $Page->Book_Id->caption() ?></span></td>
        <td data-name="Book_Id" <?= $Page->Book_Id->cellAttributes() ?>>
<span id="el_academicbook_Book_Id">
<span<?= $Page->Book_Id->viewAttributes() ?>>
<?= $Page->Book_Id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->Aca_Id->Visible) { // Aca_Id ?>
    <tr id="r_Aca_Id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_academicbook_Aca_Id"><?= $Page->Aca_Id->caption() ?></span></td>
        <td data-name="Aca_Id" <?= $Page->Aca_Id->cellAttributes() ?>>
<span id="el_academicbook_Aca_Id">
<span<?= $Page->Aca_Id->viewAttributes() ?>>
<?= $Page->Aca_Id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->Book_Type->Visible) { // Book_Type ?>
    <tr id="r_Book_Type">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_academicbook_Book_Type"><?= $Page->Book_Type->caption() ?></span></td>
        <td data-name="Book_Type" <?= $Page->Book_Type->cellAttributes() ?>>
<span id="el_academicbook_Book_Type">
<span<?= $Page->Book_Type->viewAttributes() ?>>
<?= $Page->Book_Type->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->Book_Cover->Visible) { // Book_Cover ?>
    <tr id="r_Book_Cover">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_academicbook_Book_Cover"><?= $Page->Book_Cover->caption() ?></span></td>
        <td data-name="Book_Cover" <?= $Page->Book_Cover->cellAttributes() ?>>
<span id="el_academicbook_Book_Cover">
<span<?= $Page->Book_Cover->viewAttributes() ?>>
<?= GetFileViewTag($Page->Book_Cover, $Page->Book_Cover->getViewValue(), false) ?>
</span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->Book_ISBN->Visible) { // Book_ISBN ?>
    <tr id="r_Book_ISBN">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_academicbook_Book_ISBN"><?= $Page->Book_ISBN->caption() ?></span></td>
        <td data-name="Book_ISBN" <?= $Page->Book_ISBN->cellAttributes() ?>>
<span id="el_academicbook_Book_ISBN">
<span<?= $Page->Book_ISBN->viewAttributes() ?>>
<?= $Page->Book_ISBN->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->Book_Patent->Visible) { // Book_Patent ?>
    <tr id="r_Book_Patent">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_academicbook_Book_Patent"><?= $Page->Book_Patent->caption() ?></span></td>
        <td data-name="Book_Patent" <?= $Page->Book_Patent->cellAttributes() ?>>
<span id="el_academicbook_Book_Patent">
<span<?= $Page->Book_Patent->viewAttributes() ?>>
<?= $Page->Book_Patent->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->Book_File->Visible) { // Book_File ?>
    <tr id="r_Book_File">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_academicbook_Book_File"><?= $Page->Book_File->caption() ?></span></td>
        <td data-name="Book_File" <?= $Page->Book_File->cellAttributes() ?>>
<span id="el_academicbook_Book_File">
<span<?= $Page->Book_File->viewAttributes() ?>>
<?= GetFileViewTag($Page->Book_File, $Page->Book_File->getViewValue(), false) ?>
</span>
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
