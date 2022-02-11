<?php

namespace PHPMaker2021\upPersonnelv2;

// Page object
$AcademicbookList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var facademicbooklist;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "list";
    facademicbooklist = currentForm = new ew.Form("facademicbooklist", "list");
    facademicbooklist.formKeyCountName = '<?= $Page->FormKeyCountName ?>';
    loadjs.done("facademicbooklist");
});
var facademicbooklistsrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object for search
    facademicbooklistsrch = currentSearchForm = new ew.Form("facademicbooklistsrch");

    // Dynamic selection lists

    // Filters
    facademicbooklistsrch.filterList = <?= $Page->getFilterList() ?>;
    loadjs.done("facademicbooklistsrch");
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
<?php if ($Page->TotalRecords > 0 && $Page->ExportOptions->visible()) { ?>
<?php $Page->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($Page->ImportOptions->visible()) { ?>
<?php $Page->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($Page->SearchOptions->visible()) { ?>
<?php $Page->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($Page->FilterOptions->visible()) { ?>
<?php $Page->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$Page->renderOtherOptions();
?>
<?php if ($Security->canSearch()) { ?>
<?php if (!$Page->isExport() && !$Page->CurrentAction) { ?>
<form name="facademicbooklistsrch" id="facademicbooklistsrch" class="form-inline ew-form ew-ext-search-form" action="<?= CurrentPageUrl() ?>">
<div id="facademicbooklistsrch-search-panel" class="<?= $Page->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="academicbook">
    <div class="ew-extended-search">
<div id="xsr_<?= $Page->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
    <div class="ew-quick-search input-group">
        <input type="text" name="<?= Config("TABLE_BASIC_SEARCH") ?>" id="<?= Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?= HtmlEncode($Page->BasicSearch->getKeyword()) ?>" placeholder="<?= HtmlEncode($Language->phrase("Search")) ?>">
        <input type="hidden" name="<?= Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?= Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?= HtmlEncode($Page->BasicSearch->getType()) ?>">
        <div class="input-group-append">
            <button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?= $Language->phrase("SearchBtn") ?></button>
            <button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?= $Page->BasicSearch->getTypeNameShort() ?></span></button>
            <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item<?php if ($Page->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?= $Language->phrase("QuickSearchAuto") ?></a>
                <a class="dropdown-item<?php if ($Page->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?= $Language->phrase("QuickSearchExact") ?></a>
                <a class="dropdown-item<?php if ($Page->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?= $Language->phrase("QuickSearchAll") ?></a>
                <a class="dropdown-item<?php if ($Page->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?= $Language->phrase("QuickSearchAny") ?></a>
            </div>
        </div>
    </div>
</div>
    </div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<?php if ($Page->TotalRecords > 0 || $Page->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> academicbook">
<form name="facademicbooklist" id="facademicbooklist" class="form-inline ew-form ew-list-form" action="<?= CurrentPageUrl() ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="academicbook">
<div id="gmp_academicbook" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_academicbooklist" class="table ew-table"><!-- .ew-table -->
<thead>
    <tr class="ew-table-header">
<?php
// Header row
$Page->RowType = ROWTYPE_HEADER;

// Render list options
$Page->renderListOptions();

// Render list options (header, left)
$Page->ListOptions->render("header", "left");
?>
<?php if ($Page->Aca_Id->Visible) { // Aca_Id ?>
        <th data-name="Aca_Id" class="<?= $Page->Aca_Id->headerCellClass() ?>"><div id="elh_academicbook_Aca_Id" class="academicbook_Aca_Id"><?= $Page->renderSort($Page->Aca_Id) ?></div></th>
<?php } ?>
<?php if ($Page->Book_Type->Visible) { // Book_Type ?>
        <th data-name="Book_Type" class="<?= $Page->Book_Type->headerCellClass() ?>"><div id="elh_academicbook_Book_Type" class="academicbook_Book_Type"><?= $Page->renderSort($Page->Book_Type) ?></div></th>
<?php } ?>
<?php if ($Page->Book_Cover->Visible) { // Book_Cover ?>
        <th data-name="Book_Cover" class="<?= $Page->Book_Cover->headerCellClass() ?>"><div id="elh_academicbook_Book_Cover" class="academicbook_Book_Cover"><?= $Page->renderSort($Page->Book_Cover) ?></div></th>
<?php } ?>
<?php if ($Page->Book_ISBN->Visible) { // Book_ISBN ?>
        <th data-name="Book_ISBN" class="<?= $Page->Book_ISBN->headerCellClass() ?>"><div id="elh_academicbook_Book_ISBN" class="academicbook_Book_ISBN"><?= $Page->renderSort($Page->Book_ISBN) ?></div></th>
<?php } ?>
<?php if ($Page->Book_Patent->Visible) { // Book_Patent ?>
        <th data-name="Book_Patent" class="<?= $Page->Book_Patent->headerCellClass() ?>"><div id="elh_academicbook_Book_Patent" class="academicbook_Book_Patent"><?= $Page->renderSort($Page->Book_Patent) ?></div></th>
<?php } ?>
<?php if ($Page->Book_File->Visible) { // Book_File ?>
        <th data-name="Book_File" class="<?= $Page->Book_File->headerCellClass() ?>"><div id="elh_academicbook_Book_File" class="academicbook_Book_File"><?= $Page->renderSort($Page->Book_File) ?></div></th>
<?php } ?>
<?php
// Render list options (header, right)
$Page->ListOptions->render("header", "right");
?>
    </tr>
</thead>
<tbody>
<?php
if ($Page->ExportAll && $Page->isExport()) {
    $Page->StopRecord = $Page->TotalRecords;
} else {
    // Set the last record to display
    if ($Page->TotalRecords > $Page->StartRecord + $Page->DisplayRecords - 1) {
        $Page->StopRecord = $Page->StartRecord + $Page->DisplayRecords - 1;
    } else {
        $Page->StopRecord = $Page->TotalRecords;
    }
}
$Page->RecordCount = $Page->StartRecord - 1;
if ($Page->Recordset && !$Page->Recordset->EOF) {
    // Nothing to do
} elseif (!$Page->AllowAddDeleteRow && $Page->StopRecord == 0) {
    $Page->StopRecord = $Page->GridAddRowCount;
}

// Initialize aggregate
$Page->RowType = ROWTYPE_AGGREGATEINIT;
$Page->resetAttributes();
$Page->renderRow();
while ($Page->RecordCount < $Page->StopRecord) {
    $Page->RecordCount++;
    if ($Page->RecordCount >= $Page->StartRecord) {
        $Page->RowCount++;

        // Set up key count
        $Page->KeyCount = $Page->RowIndex;

        // Init row class and style
        $Page->resetAttributes();
        $Page->CssClass = "";
        if ($Page->isGridAdd()) {
            $Page->loadRowValues(); // Load default values
            $Page->OldKey = "";
            $Page->setKey($Page->OldKey);
        } else {
            $Page->loadRowValues($Page->Recordset); // Load row values
            if ($Page->isGridEdit()) {
                $Page->OldKey = $Page->getKey(true); // Get from CurrentValue
                $Page->setKey($Page->OldKey);
            }
        }
        $Page->RowType = ROWTYPE_VIEW; // Render view

        // Set up row id / data-rowindex
        $Page->RowAttrs->merge(["data-rowindex" => $Page->RowCount, "id" => "r" . $Page->RowCount . "_academicbook", "data-rowtype" => $Page->RowType]);

        // Render row
        $Page->renderRow();

        // Render list options
        $Page->renderListOptions();
?>
    <tr <?= $Page->rowAttributes() ?>>
<?php
// Render list options (body, left)
$Page->ListOptions->render("body", "left", $Page->RowCount);
?>
    <?php if ($Page->Aca_Id->Visible) { // Aca_Id ?>
        <td data-name="Aca_Id" <?= $Page->Aca_Id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_academicbook_Aca_Id">
<span<?= $Page->Aca_Id->viewAttributes() ?>>
<?= $Page->Aca_Id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->Book_Type->Visible) { // Book_Type ?>
        <td data-name="Book_Type" <?= $Page->Book_Type->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_academicbook_Book_Type">
<span<?= $Page->Book_Type->viewAttributes() ?>>
<?= $Page->Book_Type->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->Book_Cover->Visible) { // Book_Cover ?>
        <td data-name="Book_Cover" <?= $Page->Book_Cover->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_academicbook_Book_Cover">
<span<?= $Page->Book_Cover->viewAttributes() ?>>
<?= GetFileViewTag($Page->Book_Cover, $Page->Book_Cover->getViewValue(), false) ?>
</span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->Book_ISBN->Visible) { // Book_ISBN ?>
        <td data-name="Book_ISBN" <?= $Page->Book_ISBN->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_academicbook_Book_ISBN">
<span<?= $Page->Book_ISBN->viewAttributes() ?>>
<?= $Page->Book_ISBN->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->Book_Patent->Visible) { // Book_Patent ?>
        <td data-name="Book_Patent" <?= $Page->Book_Patent->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_academicbook_Book_Patent">
<span<?= $Page->Book_Patent->viewAttributes() ?>>
<?= $Page->Book_Patent->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->Book_File->Visible) { // Book_File ?>
        <td data-name="Book_File" <?= $Page->Book_File->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_academicbook_Book_File">
<span<?= $Page->Book_File->viewAttributes() ?>>
<?= GetFileViewTag($Page->Book_File, $Page->Book_File->getViewValue(), false) ?>
</span>
</span>
</td>
    <?php } ?>
<?php
// Render list options (body, right)
$Page->ListOptions->render("body", "right", $Page->RowCount);
?>
    </tr>
<?php
    }
    if (!$Page->isGridAdd()) {
        $Page->Recordset->moveNext();
    }
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$Page->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php
// Close recordset
if ($Page->Recordset) {
    $Page->Recordset->close();
}
?>
<?php if (!$Page->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$Page->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?= CurrentPageUrl() ?>">
<?= $Page->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $Page->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($Page->TotalRecords == 0 && !$Page->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $Page->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<?php if (!$Page->isExport()) { ?>
<script>
// Field event handlers
loadjs.ready("head", function() {
    ew.addEventHandlers("academicbook");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
