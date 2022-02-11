<?php

namespace PHPMaker2021\upPersonnelv2;

// Page object
$GraduationList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fgraduationlist;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "list";
    fgraduationlist = currentForm = new ew.Form("fgraduationlist", "list");
    fgraduationlist.formKeyCountName = '<?= $Page->FormKeyCountName ?>';
    loadjs.done("fgraduationlist");
});
var fgraduationlistsrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object for search
    fgraduationlistsrch = currentSearchForm = new ew.Form("fgraduationlistsrch");

    // Dynamic selection lists

    // Filters
    fgraduationlistsrch.filterList = <?= $Page->getFilterList() ?>;
    loadjs.done("fgraduationlistsrch");
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
<form name="fgraduationlistsrch" id="fgraduationlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?= CurrentPageUrl() ?>">
<div id="fgraduationlistsrch-search-panel" class="<?= $Page->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="graduation">
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
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> graduation">
<form name="fgraduationlist" id="fgraduationlist" class="form-inline ew-form ew-list-form" action="<?= CurrentPageUrl() ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="graduation">
<div id="gmp_graduation" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_graduationlist" class="table ew-table"><!-- .ew-table -->
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
        <th data-name="Per_Id" class="<?= $Page->Per_Id->headerCellClass() ?>"><div id="elh_graduation_Per_Id" class="graduation_Per_Id"><?= $Page->renderSort($Page->Per_Id) ?></div></th>
<?php } ?>
<?php if ($Page->Grad_Institution->Visible) { // Grad_Institution ?>
        <th data-name="Grad_Institution" class="<?= $Page->Grad_Institution->headerCellClass() ?>"><div id="elh_graduation_Grad_Institution" class="graduation_Grad_Institution"><?= $Page->renderSort($Page->Grad_Institution) ?></div></th>
<?php } ?>
<?php if ($Page->Grad_Provinces->Visible) { // Grad_Provinces ?>
        <th data-name="Grad_Provinces" class="<?= $Page->Grad_Provinces->headerCellClass() ?>"><div id="elh_graduation_Grad_Provinces" class="graduation_Grad_Provinces"><?= $Page->renderSort($Page->Grad_Provinces) ?></div></th>
<?php } ?>
<?php if ($Page->Grad_Country->Visible) { // Grad_Country ?>
        <th data-name="Grad_Country" class="<?= $Page->Grad_Country->headerCellClass() ?>"><div id="elh_graduation_Grad_Country" class="graduation_Grad_Country"><?= $Page->renderSort($Page->Grad_Country) ?></div></th>
<?php } ?>
<?php if ($Page->Grad_Start->Visible) { // Grad_Start ?>
        <th data-name="Grad_Start" class="<?= $Page->Grad_Start->headerCellClass() ?>"><div id="elh_graduation_Grad_Start" class="graduation_Grad_Start"><?= $Page->renderSort($Page->Grad_Start) ?></div></th>
<?php } ?>
<?php if ($Page->Grad_End->Visible) { // Grad_End ?>
        <th data-name="Grad_End" class="<?= $Page->Grad_End->headerCellClass() ?>"><div id="elh_graduation_Grad_End" class="graduation_Grad_End"><?= $Page->renderSort($Page->Grad_End) ?></div></th>
<?php } ?>
<?php if ($Page->Grad_GPA->Visible) { // Grad_GPA ?>
        <th data-name="Grad_GPA" class="<?= $Page->Grad_GPA->headerCellClass() ?>"><div id="elh_graduation_Grad_GPA" class="graduation_Grad_GPA"><?= $Page->renderSort($Page->Grad_GPA) ?></div></th>
<?php } ?>
<?php if ($Page->Grad_Honor->Visible) { // Grad_Honor ?>
        <th data-name="Grad_Honor" class="<?= $Page->Grad_Honor->headerCellClass() ?>"><div id="elh_graduation_Grad_Honor" class="graduation_Grad_Honor"><?= $Page->renderSort($Page->Grad_Honor) ?></div></th>
<?php } ?>
<?php if ($Page->Grad_Admission->Visible) { // Grad_Admission ?>
        <th data-name="Grad_Admission" class="<?= $Page->Grad_Admission->headerCellClass() ?>"><div id="elh_graduation_Grad_Admission" class="graduation_Grad_Admission"><?= $Page->renderSort($Page->Grad_Admission) ?></div></th>
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
        $Page->RowAttrs->merge(["data-rowindex" => $Page->RowCount, "id" => "r" . $Page->RowCount . "_graduation", "data-rowtype" => $Page->RowType]);

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
<span id="el<?= $Page->RowCount ?>_graduation_Per_Id">
<span<?= $Page->Per_Id->viewAttributes() ?>>
<?= $Page->Per_Id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->Grad_Institution->Visible) { // Grad_Institution ?>
        <td data-name="Grad_Institution" <?= $Page->Grad_Institution->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_graduation_Grad_Institution">
<span<?= $Page->Grad_Institution->viewAttributes() ?>>
<?= $Page->Grad_Institution->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->Grad_Provinces->Visible) { // Grad_Provinces ?>
        <td data-name="Grad_Provinces" <?= $Page->Grad_Provinces->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_graduation_Grad_Provinces">
<span<?= $Page->Grad_Provinces->viewAttributes() ?>>
<?= $Page->Grad_Provinces->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->Grad_Country->Visible) { // Grad_Country ?>
        <td data-name="Grad_Country" <?= $Page->Grad_Country->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_graduation_Grad_Country">
<span<?= $Page->Grad_Country->viewAttributes() ?>>
<?= $Page->Grad_Country->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->Grad_Start->Visible) { // Grad_Start ?>
        <td data-name="Grad_Start" <?= $Page->Grad_Start->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_graduation_Grad_Start">
<span<?= $Page->Grad_Start->viewAttributes() ?>>
<?= $Page->Grad_Start->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->Grad_End->Visible) { // Grad_End ?>
        <td data-name="Grad_End" <?= $Page->Grad_End->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_graduation_Grad_End">
<span<?= $Page->Grad_End->viewAttributes() ?>>
<?= $Page->Grad_End->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->Grad_GPA->Visible) { // Grad_GPA ?>
        <td data-name="Grad_GPA" <?= $Page->Grad_GPA->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_graduation_Grad_GPA">
<span<?= $Page->Grad_GPA->viewAttributes() ?>>
<?= $Page->Grad_GPA->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->Grad_Honor->Visible) { // Grad_Honor ?>
        <td data-name="Grad_Honor" <?= $Page->Grad_Honor->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_graduation_Grad_Honor">
<span<?= $Page->Grad_Honor->viewAttributes() ?>>
<?= $Page->Grad_Honor->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->Grad_Admission->Visible) { // Grad_Admission ?>
        <td data-name="Grad_Admission" <?= $Page->Grad_Admission->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_graduation_Grad_Admission">
<span<?= $Page->Grad_Admission->viewAttributes() ?>>
<?= $Page->Grad_Admission->getViewValue() ?></span>
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
    ew.addEventHandlers("graduation");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
