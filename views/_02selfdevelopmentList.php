<?php

namespace PHPMaker2021\upPersonnelv2;

// Page object
$_02selfdevelopmentList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var f_02selfdevelopmentlist;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "list";
    f_02selfdevelopmentlist = currentForm = new ew.Form("f_02selfdevelopmentlist", "list");
    f_02selfdevelopmentlist.formKeyCountName = '<?= $Page->FormKeyCountName ?>';
    loadjs.done("f_02selfdevelopmentlist");
});
var f_02selfdevelopmentlistsrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object for search
    f_02selfdevelopmentlistsrch = currentSearchForm = new ew.Form("f_02selfdevelopmentlistsrch");

    // Dynamic selection lists

    // Filters
    f_02selfdevelopmentlistsrch.filterList = <?= $Page->getFilterList() ?>;
    loadjs.done("f_02selfdevelopmentlistsrch");
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
<form name="f_02selfdevelopmentlistsrch" id="f_02selfdevelopmentlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?= CurrentPageUrl() ?>">
<div id="f_02selfdevelopmentlistsrch-search-panel" class="<?= $Page->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="_02selfdevelopment">
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
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> _02selfdevelopment">
<form name="f_02selfdevelopmentlist" id="f_02selfdevelopmentlist" class="form-inline ew-form ew-list-form" action="<?= CurrentPageUrl() ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="_02selfdevelopment">
<div id="gmp__02selfdevelopment" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl__02selfdevelopmentlist" class="table ew-table"><!-- .ew-table -->
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
        <th data-name="Per_Id" class="<?= $Page->Per_Id->headerCellClass() ?>"><div id="elh__02selfdevelopment_Per_Id" class="_02selfdevelopment_Per_Id"><?= $Page->renderSort($Page->Per_Id) ?></div></th>
<?php } ?>
<?php if ($Page->SelfDev_Type->Visible) { // SelfDev_Type ?>
        <th data-name="SelfDev_Type" class="<?= $Page->SelfDev_Type->headerCellClass() ?>"><div id="elh__02selfdevelopment_SelfDev_Type" class="_02selfdevelopment_SelfDev_Type"><?= $Page->renderSort($Page->SelfDev_Type) ?></div></th>
<?php } ?>
<?php if ($Page->SelfDev_StartDate->Visible) { // SelfDev_StartDate ?>
        <th data-name="SelfDev_StartDate" class="<?= $Page->SelfDev_StartDate->headerCellClass() ?>"><div id="elh__02selfdevelopment_SelfDev_StartDate" class="_02selfdevelopment_SelfDev_StartDate"><?= $Page->renderSort($Page->SelfDev_StartDate) ?></div></th>
<?php } ?>
<?php if ($Page->SelfDev_EndDate->Visible) { // SelfDev_EndDate ?>
        <th data-name="SelfDev_EndDate" class="<?= $Page->SelfDev_EndDate->headerCellClass() ?>"><div id="elh__02selfdevelopment_SelfDev_EndDate" class="_02selfdevelopment_SelfDev_EndDate"><?= $Page->renderSort($Page->SelfDev_EndDate) ?></div></th>
<?php } ?>
<?php if ($Page->SelfDev_Money->Visible) { // SelfDev_Money ?>
        <th data-name="SelfDev_Money" class="<?= $Page->SelfDev_Money->headerCellClass() ?>"><div id="elh__02selfdevelopment_SelfDev_Money" class="_02selfdevelopment_SelfDev_Money"><?= $Page->renderSort($Page->SelfDev_Money) ?></div></th>
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
        $Page->RowAttrs->merge(["data-rowindex" => $Page->RowCount, "id" => "r" . $Page->RowCount . "__02selfdevelopment", "data-rowtype" => $Page->RowType]);

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
<span id="el<?= $Page->RowCount ?>__02selfdevelopment_Per_Id">
<span<?= $Page->Per_Id->viewAttributes() ?>>
<?= $Page->Per_Id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->SelfDev_Type->Visible) { // SelfDev_Type ?>
        <td data-name="SelfDev_Type" <?= $Page->SelfDev_Type->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>__02selfdevelopment_SelfDev_Type">
<span<?= $Page->SelfDev_Type->viewAttributes() ?>>
<?= $Page->SelfDev_Type->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->SelfDev_StartDate->Visible) { // SelfDev_StartDate ?>
        <td data-name="SelfDev_StartDate" <?= $Page->SelfDev_StartDate->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>__02selfdevelopment_SelfDev_StartDate">
<span<?= $Page->SelfDev_StartDate->viewAttributes() ?>>
<?= $Page->SelfDev_StartDate->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->SelfDev_EndDate->Visible) { // SelfDev_EndDate ?>
        <td data-name="SelfDev_EndDate" <?= $Page->SelfDev_EndDate->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>__02selfdevelopment_SelfDev_EndDate">
<span<?= $Page->SelfDev_EndDate->viewAttributes() ?>>
<?= $Page->SelfDev_EndDate->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->SelfDev_Money->Visible) { // SelfDev_Money ?>
        <td data-name="SelfDev_Money" <?= $Page->SelfDev_Money->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>__02selfdevelopment_SelfDev_Money">
<span<?= $Page->SelfDev_Money->viewAttributes() ?>>
<?= $Page->SelfDev_Money->getViewValue() ?></span>
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
    ew.addEventHandlers("_02selfdevelopment");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
