<?php

namespace PHPMaker2021\upPersonnelv2;

// Page object
$_01personnelList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var f_01personnellist;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "list";
    f_01personnellist = currentForm = new ew.Form("f_01personnellist", "list");
    f_01personnellist.formKeyCountName = '<?= $Page->FormKeyCountName ?>';
    loadjs.done("f_01personnellist");
});
var f_01personnellistsrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object for search
    f_01personnellistsrch = currentSearchForm = new ew.Form("f_01personnellistsrch");

    // Dynamic selection lists

    // Filters
    f_01personnellistsrch.filterList = <?= $Page->getFilterList() ?>;
    loadjs.done("f_01personnellistsrch");
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
<form name="f_01personnellistsrch" id="f_01personnellistsrch" class="form-inline ew-form ew-ext-search-form" action="<?= CurrentPageUrl() ?>">
<div id="f_01personnellistsrch-search-panel" class="<?= $Page->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="_01personnel">
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
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> _01personnel">
<form name="f_01personnellist" id="f_01personnellist" class="form-inline ew-form ew-list-form" action="<?= CurrentPageUrl() ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="_01personnel">
<div id="gmp__01personnel" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl__01personnellist" class="table ew-table"><!-- .ew-table -->
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
<?php if ($Page->Per_Id->Visible) { // Per_Id ?>
        <th data-name="Per_Id" class="<?= $Page->Per_Id->headerCellClass() ?>"><div id="elh__01personnel_Per_Id" class="_01personnel_Per_Id"><?= $Page->renderSort($Page->Per_Id) ?></div></th>
<?php } ?>
<?php if ($Page->Per_ThaiName->Visible) { // Per_ThaiName ?>
        <th data-name="Per_ThaiName" class="<?= $Page->Per_ThaiName->headerCellClass() ?>"><div id="elh__01personnel_Per_ThaiName" class="_01personnel_Per_ThaiName"><?= $Page->renderSort($Page->Per_ThaiName) ?></div></th>
<?php } ?>
<?php if ($Page->Per_ThaiLastName->Visible) { // Per_ThaiLastName ?>
        <th data-name="Per_ThaiLastName" class="<?= $Page->Per_ThaiLastName->headerCellClass() ?>"><div id="elh__01personnel_Per_ThaiLastName" class="_01personnel_Per_ThaiLastName"><?= $Page->renderSort($Page->Per_ThaiLastName) ?></div></th>
<?php } ?>
<?php if ($Page->Per_major->Visible) { // Per_major ?>
        <th data-name="Per_major" class="<?= $Page->Per_major->headerCellClass() ?>"><div id="elh__01personnel_Per_major" class="_01personnel_Per_major"><?= $Page->renderSort($Page->Per_major) ?></div></th>
<?php } ?>
<?php if ($Page->Per_Phone->Visible) { // Per_Phone ?>
        <th data-name="Per_Phone" class="<?= $Page->Per_Phone->headerCellClass() ?>"><div id="elh__01personnel_Per_Phone" class="_01personnel_Per_Phone"><?= $Page->renderSort($Page->Per_Phone) ?></div></th>
<?php } ?>
<?php if ($Page->Per_UPEmail->Visible) { // Per_UPEmail ?>
        <th data-name="Per_UPEmail" class="<?= $Page->Per_UPEmail->headerCellClass() ?>"><div id="elh__01personnel_Per_UPEmail" class="_01personnel_Per_UPEmail"><?= $Page->renderSort($Page->Per_UPEmail) ?></div></th>
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
        $Page->RowAttrs->merge(["data-rowindex" => $Page->RowCount, "id" => "r" . $Page->RowCount . "__01personnel", "data-rowtype" => $Page->RowType]);

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
    <?php if ($Page->Per_Id->Visible) { // Per_Id ?>
        <td data-name="Per_Id" <?= $Page->Per_Id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>__01personnel_Per_Id">
<span<?= $Page->Per_Id->viewAttributes() ?>>
<?= $Page->Per_Id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->Per_ThaiName->Visible) { // Per_ThaiName ?>
        <td data-name="Per_ThaiName" <?= $Page->Per_ThaiName->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>__01personnel_Per_ThaiName">
<span<?= $Page->Per_ThaiName->viewAttributes() ?>>
<?= $Page->Per_ThaiName->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->Per_ThaiLastName->Visible) { // Per_ThaiLastName ?>
        <td data-name="Per_ThaiLastName" <?= $Page->Per_ThaiLastName->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>__01personnel_Per_ThaiLastName">
<span<?= $Page->Per_ThaiLastName->viewAttributes() ?>>
<?= $Page->Per_ThaiLastName->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->Per_major->Visible) { // Per_major ?>
        <td data-name="Per_major" <?= $Page->Per_major->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>__01personnel_Per_major">
<span<?= $Page->Per_major->viewAttributes() ?>>
<?= $Page->Per_major->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->Per_Phone->Visible) { // Per_Phone ?>
        <td data-name="Per_Phone" <?= $Page->Per_Phone->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>__01personnel_Per_Phone">
<span<?= $Page->Per_Phone->viewAttributes() ?>>
<?= $Page->Per_Phone->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->Per_UPEmail->Visible) { // Per_UPEmail ?>
        <td data-name="Per_UPEmail" <?= $Page->Per_UPEmail->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>__01personnel_Per_UPEmail">
<span<?= $Page->Per_UPEmail->viewAttributes() ?>>
<?= $Page->Per_UPEmail->getViewValue() ?></span>
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
    ew.addEventHandlers("_01personnel");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
