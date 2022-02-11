<?php

namespace PHPMaker2021\upPersonnelv2;

// Page object
$BookTypeView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fbook_typeview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    fbook_typeview = currentForm = new ew.Form("fbook_typeview", "view");
    loadjs.done("fbook_typeview");
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
<form name="fbook_typeview" id="fbook_typeview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl() ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="book_type">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Page->Book_Type_id->Visible) { // Book_Type_id ?>
    <tr id="r_Book_Type_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_book_type_Book_Type_id"><?= $Page->Book_Type_id->caption() ?></span></td>
        <td data-name="Book_Type_id" <?= $Page->Book_Type_id->cellAttributes() ?>>
<span id="el_book_type_Book_Type_id">
<span<?= $Page->Book_Type_id->viewAttributes() ?>>
<?= $Page->Book_Type_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->Book_Type_name->Visible) { // Book_Type_name ?>
    <tr id="r_Book_Type_name">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_book_type_Book_Type_name"><?= $Page->Book_Type_name->caption() ?></span></td>
        <td data-name="Book_Type_name" <?= $Page->Book_Type_name->cellAttributes() ?>>
<span id="el_book_type_Book_Type_name">
<span<?= $Page->Book_Type_name->viewAttributes() ?>>
<?= $Page->Book_Type_name->getViewValue() ?></span>
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
