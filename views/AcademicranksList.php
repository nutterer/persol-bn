<?php

namespace PHPMaker2021\upPersonnel;

// Page object
$AcademicranksList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var facademicrankslist;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "list";
    facademicrankslist = currentForm = new ew.Form("facademicrankslist", "list");
    facademicrankslist.formKeyCountName = '<?= $Page->FormKeyCountName ?>';
    loadjs.done("facademicrankslist");
});
var facademicrankslistsrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object for search
    facademicrankslistsrch = currentSearchForm = new ew.Form("facademicrankslistsrch");

    // Dynamic selection lists

    // Filters
    facademicrankslistsrch.filterList = <?= $Page->getFilterList() ?>;
    loadjs.done("facademicrankslistsrch");
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
<?php if (!$Page->isExport() && !$Page->CurrentAction) { ?>
<form name="facademicrankslistsrch" id="facademicrankslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?= CurrentPageUrl() ?>">
<div id="facademicrankslistsrch-search-panel" class="<?= $Page->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="academicranks">
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
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<?php if ($Page->TotalRecords > 0 || $Page->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> academicranks">
<form name="facademicrankslist" id="facademicrankslist" class="form-inline ew-form ew-list-form" action="<?= CurrentPageUrl() ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="academicranks">
<div id="gmp_academicranks" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_academicrankslist" class="table ew-table"><!-- .ew-table -->
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
        <th data-name="Aca_Id" class="<?= $Page->Aca_Id->headerCellClass() ?>"><div id="elh_academicranks_Aca_Id" class="academicranks_Aca_Id"><?= $Page->renderSort($Page->Aca_Id) ?></div></th>
<?php } ?>
<?php if ($Page->Per_Id->Visible) { // Per_Id ?>
        <th data-name="Per_Id" class="<?= $Page->Per_Id->headerCellClass() ?>"><div id="elh_academicranks_Per_Id" class="academicranks_Per_Id"><?= $Page->renderSort($Page->Per_Id) ?></div></th>
<?php } ?>
<?php if ($Page->Aca_RequesDate->Visible) { // Aca_RequesDate ?>
        <th data-name="Aca_RequesDate" class="<?= $Page->Aca_RequesDate->headerCellClass() ?>"><div id="elh_academicranks_Aca_RequesDate" class="academicranks_Aca_RequesDate"><?= $Page->renderSort($Page->Aca_RequesDate) ?></div></th>
<?php } ?>
<?php if ($Page->Aca_AcceptDate->Visible) { // Aca_AcceptDate ?>
        <th data-name="Aca_AcceptDate" class="<?= $Page->Aca_AcceptDate->headerCellClass() ?>"><div id="elh_academicranks_Aca_AcceptDate" class="academicranks_Aca_AcceptDate"><?= $Page->renderSort($Page->Aca_AcceptDate) ?></div></th>
<?php } ?>
<?php if ($Page->Aca_EstimateStart->Visible) { // Aca_EstimateStart ?>
        <th data-name="Aca_EstimateStart" class="<?= $Page->Aca_EstimateStart->headerCellClass() ?>"><div id="elh_academicranks_Aca_EstimateStart" class="academicranks_Aca_EstimateStart"><?= $Page->renderSort($Page->Aca_EstimateStart) ?></div></th>
<?php } ?>
<?php if ($Page->Aca_EstimateEnd->Visible) { // Aca_EstimateEnd ?>
        <th data-name="Aca_EstimateEnd" class="<?= $Page->Aca_EstimateEnd->headerCellClass() ?>"><div id="elh_academicranks_Aca_EstimateEnd" class="academicranks_Aca_EstimateEnd"><?= $Page->renderSort($Page->Aca_EstimateEnd) ?></div></th>
<?php } ?>
<?php if ($Page->Aca_Name->Visible) { // Aca_Name ?>
        <th data-name="Aca_Name" class="<?= $Page->Aca_Name->headerCellClass() ?>"><div id="elh_academicranks_Aca_Name" class="academicranks_Aca_Name"><?= $Page->renderSort($Page->Aca_Name) ?></div></th>
<?php } ?>
<?php if ($Page->Aca_Status->Visible) { // Aca_Status ?>
        <th data-name="Aca_Status" class="<?= $Page->Aca_Status->headerCellClass() ?>"><div id="elh_academicranks_Aca_Status" class="academicranks_Aca_Status"><?= $Page->renderSort($Page->Aca_Status) ?></div></th>
<?php } ?>
<?php if ($Page->Aca_SkillMajor->Visible) { // Aca_SkillMajor ?>
        <th data-name="Aca_SkillMajor" class="<?= $Page->Aca_SkillMajor->headerCellClass() ?>"><div id="elh_academicranks_Aca_SkillMajor" class="academicranks_Aca_SkillMajor"><?= $Page->renderSort($Page->Aca_SkillMajor) ?></div></th>
<?php } ?>
<?php if ($Page->Aca_Report->Visible) { // Aca_Report ?>
        <th data-name="Aca_Report" class="<?= $Page->Aca_Report->headerCellClass() ?>"><div id="elh_academicranks_Aca_Report" class="academicranks_Aca_Report"><?= $Page->renderSort($Page->Aca_Report) ?></div></th>
<?php } ?>
<?php if ($Page->Aca_EstimateTeaching->Visible) { // Aca_EstimateTeaching ?>
        <th data-name="Aca_EstimateTeaching" class="<?= $Page->Aca_EstimateTeaching->headerCellClass() ?>"><div id="elh_academicranks_Aca_EstimateTeaching" class="academicranks_Aca_EstimateTeaching"><?= $Page->renderSort($Page->Aca_EstimateTeaching) ?></div></th>
<?php } ?>
<?php if ($Page->Aca_EstimateBook->Visible) { // Aca_EstimateBook ?>
        <th data-name="Aca_EstimateBook" class="<?= $Page->Aca_EstimateBook->headerCellClass() ?>"><div id="elh_academicranks_Aca_EstimateBook" class="academicranks_Aca_EstimateBook"><?= $Page->renderSort($Page->Aca_EstimateBook) ?></div></th>
<?php } ?>
<?php if ($Page->Aca_EstimateNum->Visible) { // Aca_EstimateNum ?>
        <th data-name="Aca_EstimateNum" class="<?= $Page->Aca_EstimateNum->headerCellClass() ?>"><div id="elh_academicranks_Aca_EstimateNum" class="academicranks_Aca_EstimateNum"><?= $Page->renderSort($Page->Aca_EstimateNum) ?></div></th>
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
        $Page->RowAttrs->merge(["data-rowindex" => $Page->RowCount, "id" => "r" . $Page->RowCount . "_academicranks", "data-rowtype" => $Page->RowType]);

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
<span id="el<?= $Page->RowCount ?>_academicranks_Aca_Id">
<span<?= $Page->Aca_Id->viewAttributes() ?>>
<?= $Page->Aca_Id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->Per_Id->Visible) { // Per_Id ?>
        <td data-name="Per_Id" <?= $Page->Per_Id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_academicranks_Per_Id">
<span<?= $Page->Per_Id->viewAttributes() ?>>
<?= $Page->Per_Id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->Aca_RequesDate->Visible) { // Aca_RequesDate ?>
        <td data-name="Aca_RequesDate" <?= $Page->Aca_RequesDate->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_academicranks_Aca_RequesDate">
<span<?= $Page->Aca_RequesDate->viewAttributes() ?>>
<?= $Page->Aca_RequesDate->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->Aca_AcceptDate->Visible) { // Aca_AcceptDate ?>
        <td data-name="Aca_AcceptDate" <?= $Page->Aca_AcceptDate->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_academicranks_Aca_AcceptDate">
<span<?= $Page->Aca_AcceptDate->viewAttributes() ?>>
<?= $Page->Aca_AcceptDate->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->Aca_EstimateStart->Visible) { // Aca_EstimateStart ?>
        <td data-name="Aca_EstimateStart" <?= $Page->Aca_EstimateStart->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_academicranks_Aca_EstimateStart">
<span<?= $Page->Aca_EstimateStart->viewAttributes() ?>>
<?= $Page->Aca_EstimateStart->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->Aca_EstimateEnd->Visible) { // Aca_EstimateEnd ?>
        <td data-name="Aca_EstimateEnd" <?= $Page->Aca_EstimateEnd->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_academicranks_Aca_EstimateEnd">
<span<?= $Page->Aca_EstimateEnd->viewAttributes() ?>>
<?= $Page->Aca_EstimateEnd->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->Aca_Name->Visible) { // Aca_Name ?>
        <td data-name="Aca_Name" <?= $Page->Aca_Name->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_academicranks_Aca_Name">
<span<?= $Page->Aca_Name->viewAttributes() ?>>
<?= $Page->Aca_Name->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->Aca_Status->Visible) { // Aca_Status ?>
        <td data-name="Aca_Status" <?= $Page->Aca_Status->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_academicranks_Aca_Status">
<span<?= $Page->Aca_Status->viewAttributes() ?>>
<?= $Page->Aca_Status->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->Aca_SkillMajor->Visible) { // Aca_SkillMajor ?>
        <td data-name="Aca_SkillMajor" <?= $Page->Aca_SkillMajor->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_academicranks_Aca_SkillMajor">
<span<?= $Page->Aca_SkillMajor->viewAttributes() ?>>
<?= $Page->Aca_SkillMajor->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->Aca_Report->Visible) { // Aca_Report ?>
        <td data-name="Aca_Report" <?= $Page->Aca_Report->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_academicranks_Aca_Report">
<span<?= $Page->Aca_Report->viewAttributes() ?>>
<?= $Page->Aca_Report->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->Aca_EstimateTeaching->Visible) { // Aca_EstimateTeaching ?>
        <td data-name="Aca_EstimateTeaching" <?= $Page->Aca_EstimateTeaching->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_academicranks_Aca_EstimateTeaching">
<span<?= $Page->Aca_EstimateTeaching->viewAttributes() ?>>
<?= $Page->Aca_EstimateTeaching->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->Aca_EstimateBook->Visible) { // Aca_EstimateBook ?>
        <td data-name="Aca_EstimateBook" <?= $Page->Aca_EstimateBook->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_academicranks_Aca_EstimateBook">
<span<?= $Page->Aca_EstimateBook->viewAttributes() ?>>
<?= $Page->Aca_EstimateBook->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->Aca_EstimateNum->Visible) { // Aca_EstimateNum ?>
        <td data-name="Aca_EstimateNum" <?= $Page->Aca_EstimateNum->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_academicranks_Aca_EstimateNum">
<span<?= $Page->Aca_EstimateNum->viewAttributes() ?>>
<?= $Page->Aca_EstimateNum->getViewValue() ?></span>
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
    ew.addEventHandlers("academicranks");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
