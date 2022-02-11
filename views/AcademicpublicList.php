<?php

namespace PHPMaker2021\upPersonnelv2;

// Page object
$AcademicpublicList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var facademicpubliclist;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "list";
    facademicpubliclist = currentForm = new ew.Form("facademicpubliclist", "list");
    facademicpubliclist.formKeyCountName = '<?= $Page->FormKeyCountName ?>';
    loadjs.done("facademicpubliclist");
});
var facademicpubliclistsrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object for search
    facademicpubliclistsrch = currentSearchForm = new ew.Form("facademicpubliclistsrch");

    // Dynamic selection lists

    // Filters
    facademicpubliclistsrch.filterList = <?= $Page->getFilterList() ?>;
    loadjs.done("facademicpubliclistsrch");
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
<form name="facademicpubliclistsrch" id="facademicpubliclistsrch" class="form-inline ew-form ew-ext-search-form" action="<?= CurrentPageUrl() ?>">
<div id="facademicpubliclistsrch-search-panel" class="<?= $Page->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="academicpublic">
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
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> academicpublic">
<form name="facademicpubliclist" id="facademicpubliclist" class="form-inline ew-form ew-list-form" action="<?= CurrentPageUrl() ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="academicpublic">
<div id="gmp_academicpublic" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_academicpubliclist" class="table ew-table"><!-- .ew-table -->
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
        <th data-name="Aca_Id" class="<?= $Page->Aca_Id->headerCellClass() ?>"><div id="elh_academicpublic_Aca_Id" class="academicpublic_Aca_Id"><?= $Page->renderSort($Page->Aca_Id) ?></div></th>
<?php } ?>
<?php if ($Page->Public_Type->Visible) { // Public_Type ?>
        <th data-name="Public_Type" class="<?= $Page->Public_Type->headerCellClass() ?>"><div id="elh_academicpublic_Public_Type" class="academicpublic_Public_Type"><?= $Page->renderSort($Page->Public_Type) ?></div></th>
<?php } ?>
<?php if ($Page->Public_Journal->Visible) { // Public_Journal ?>
        <th data-name="Public_Journal" class="<?= $Page->Public_Journal->headerCellClass() ?>"><div id="elh_academicpublic_Public_Journal" class="academicpublic_Public_Journal"><?= $Page->renderSort($Page->Public_Journal) ?></div></th>
<?php } ?>
<?php if ($Page->Public_Title->Visible) { // Public_Title ?>
        <th data-name="Public_Title" class="<?= $Page->Public_Title->headerCellClass() ?>"><div id="elh_academicpublic_Public_Title" class="academicpublic_Public_Title"><?= $Page->renderSort($Page->Public_Title) ?></div></th>
<?php } ?>
<?php if ($Page->Public_Date->Visible) { // Public_Date ?>
        <th data-name="Public_Date" class="<?= $Page->Public_Date->headerCellClass() ?>"><div id="elh_academicpublic_Public_Date" class="academicpublic_Public_Date"><?= $Page->renderSort($Page->Public_Date) ?></div></th>
<?php } ?>
<?php if ($Page->Public_Volum->Visible) { // Public_Volum ?>
        <th data-name="Public_Volum" class="<?= $Page->Public_Volum->headerCellClass() ?>"><div id="elh_academicpublic_Public_Volum" class="academicpublic_Public_Volum"><?= $Page->renderSort($Page->Public_Volum) ?></div></th>
<?php } ?>
<?php if ($Page->Public_Link->Visible) { // Public_Link ?>
        <th data-name="Public_Link" class="<?= $Page->Public_Link->headerCellClass() ?>"><div id="elh_academicpublic_Public_Link" class="academicpublic_Public_Link"><?= $Page->renderSort($Page->Public_Link) ?></div></th>
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
        $Page->RowAttrs->merge(["data-rowindex" => $Page->RowCount, "id" => "r" . $Page->RowCount . "_academicpublic", "data-rowtype" => $Page->RowType]);

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
<span id="el<?= $Page->RowCount ?>_academicpublic_Aca_Id">
<span<?= $Page->Aca_Id->viewAttributes() ?>>
<?= $Page->Aca_Id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->Public_Type->Visible) { // Public_Type ?>
        <td data-name="Public_Type" <?= $Page->Public_Type->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_academicpublic_Public_Type">
<span<?= $Page->Public_Type->viewAttributes() ?>>
<?= $Page->Public_Type->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->Public_Journal->Visible) { // Public_Journal ?>
        <td data-name="Public_Journal" <?= $Page->Public_Journal->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_academicpublic_Public_Journal">
<span<?= $Page->Public_Journal->viewAttributes() ?>>
<?= $Page->Public_Journal->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->Public_Title->Visible) { // Public_Title ?>
        <td data-name="Public_Title" <?= $Page->Public_Title->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_academicpublic_Public_Title">
<span<?= $Page->Public_Title->viewAttributes() ?>>
<?= $Page->Public_Title->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->Public_Date->Visible) { // Public_Date ?>
        <td data-name="Public_Date" <?= $Page->Public_Date->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_academicpublic_Public_Date">
<span<?= $Page->Public_Date->viewAttributes() ?>>
<?= $Page->Public_Date->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->Public_Volum->Visible) { // Public_Volum ?>
        <td data-name="Public_Volum" <?= $Page->Public_Volum->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_academicpublic_Public_Volum">
<span<?= $Page->Public_Volum->viewAttributes() ?>>
<?= $Page->Public_Volum->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->Public_Link->Visible) { // Public_Link ?>
        <td data-name="Public_Link" <?= $Page->Public_Link->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_academicpublic_Public_Link">
<span<?= $Page->Public_Link->viewAttributes() ?>>
<?= $Page->Public_Link->getViewValue() ?></span>
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
    ew.addEventHandlers("academicpublic");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
