<?php

namespace PHPMaker2021\upPersonnelv2;

// Page object
$StudyleaveList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fstudyleavelist;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "list";
    fstudyleavelist = currentForm = new ew.Form("fstudyleavelist", "list");
    fstudyleavelist.formKeyCountName = '<?= $Page->FormKeyCountName ?>';
    loadjs.done("fstudyleavelist");
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
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$Page->renderOtherOptions();
?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<?php if ($Page->TotalRecords > 0 || $Page->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> studyleave">
<form name="fstudyleavelist" id="fstudyleavelist" class="form-inline ew-form ew-list-form" action="<?= CurrentPageUrl() ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="studyleave">
<div id="gmp_studyleave" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_studyleavelist" class="table ew-table"><!-- .ew-table -->
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
        <th data-name="Per_Id" class="<?= $Page->Per_Id->headerCellClass() ?>"><div id="elh_studyleave_Per_Id" class="studyleave_Per_Id"><?= $Page->renderSort($Page->Per_Id) ?></div></th>
<?php } ?>
<?php if ($Page->Study_Start->Visible) { // Study_Start ?>
        <th data-name="Study_Start" class="<?= $Page->Study_Start->headerCellClass() ?>"><div id="elh_studyleave_Study_Start" class="studyleave_Study_Start"><?= $Page->renderSort($Page->Study_Start) ?></div></th>
<?php } ?>
<?php if ($Page->Study_End->Visible) { // Study_End ?>
        <th data-name="Study_End" class="<?= $Page->Study_End->headerCellClass() ?>"><div id="elh_studyleave_Study_End" class="studyleave_Study_End"><?= $Page->renderSort($Page->Study_End) ?></div></th>
<?php } ?>
<?php if ($Page->StudyLeaveType_Id->Visible) { // StudyLeaveType_Id ?>
        <th data-name="StudyLeaveType_Id" class="<?= $Page->StudyLeaveType_Id->headerCellClass() ?>"><div id="elh_studyleave_StudyLeaveType_Id" class="studyleave_StudyLeaveType_Id"><?= $Page->renderSort($Page->StudyLeaveType_Id) ?></div></th>
<?php } ?>
<?php if ($Page->Study_NumAddTime->Visible) { // Study_NumAddTime ?>
        <th data-name="Study_NumAddTime" class="<?= $Page->Study_NumAddTime->headerCellClass() ?>"><div id="elh_studyleave_Study_NumAddTime" class="studyleave_Study_NumAddTime"><?= $Page->renderSort($Page->Study_NumAddTime) ?></div></th>
<?php } ?>
<?php if ($Page->Study_AddTimeStart->Visible) { // Study_AddTimeStart ?>
        <th data-name="Study_AddTimeStart" class="<?= $Page->Study_AddTimeStart->headerCellClass() ?>"><div id="elh_studyleave_Study_AddTimeStart" class="studyleave_Study_AddTimeStart"><?= $Page->renderSort($Page->Study_AddTimeStart) ?></div></th>
<?php } ?>
<?php if ($Page->Study_AddTimeEnd->Visible) { // Study_AddTimeEnd ?>
        <th data-name="Study_AddTimeEnd" class="<?= $Page->Study_AddTimeEnd->headerCellClass() ?>"><div id="elh_studyleave_Study_AddTimeEnd" class="studyleave_Study_AddTimeEnd"><?= $Page->renderSort($Page->Study_AddTimeEnd) ?></div></th>
<?php } ?>
<?php if ($Page->Study_WorkDate->Visible) { // Study_WorkDate ?>
        <th data-name="Study_WorkDate" class="<?= $Page->Study_WorkDate->headerCellClass() ?>"><div id="elh_studyleave_Study_WorkDate" class="studyleave_Study_WorkDate"><?= $Page->renderSort($Page->Study_WorkDate) ?></div></th>
<?php } ?>
<?php if ($Page->Study_GraduationDate->Visible) { // Study_GraduationDate ?>
        <th data-name="Study_GraduationDate" class="<?= $Page->Study_GraduationDate->headerCellClass() ?>"><div id="elh_studyleave_Study_GraduationDate" class="studyleave_Study_GraduationDate"><?= $Page->renderSort($Page->Study_GraduationDate) ?></div></th>
<?php } ?>
<?php if ($Page->Study_AdjustDate->Visible) { // Study_AdjustDate ?>
        <th data-name="Study_AdjustDate" class="<?= $Page->Study_AdjustDate->headerCellClass() ?>"><div id="elh_studyleave_Study_AdjustDate" class="studyleave_Study_AdjustDate"><?= $Page->renderSort($Page->Study_AdjustDate) ?></div></th>
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
        $Page->RowAttrs->merge(["data-rowindex" => $Page->RowCount, "id" => "r" . $Page->RowCount . "_studyleave", "data-rowtype" => $Page->RowType]);

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
<span id="el<?= $Page->RowCount ?>_studyleave_Per_Id">
<span<?= $Page->Per_Id->viewAttributes() ?>>
<?= $Page->Per_Id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->Study_Start->Visible) { // Study_Start ?>
        <td data-name="Study_Start" <?= $Page->Study_Start->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_studyleave_Study_Start">
<span<?= $Page->Study_Start->viewAttributes() ?>>
<?= $Page->Study_Start->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->Study_End->Visible) { // Study_End ?>
        <td data-name="Study_End" <?= $Page->Study_End->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_studyleave_Study_End">
<span<?= $Page->Study_End->viewAttributes() ?>>
<?= $Page->Study_End->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->StudyLeaveType_Id->Visible) { // StudyLeaveType_Id ?>
        <td data-name="StudyLeaveType_Id" <?= $Page->StudyLeaveType_Id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_studyleave_StudyLeaveType_Id">
<span<?= $Page->StudyLeaveType_Id->viewAttributes() ?>>
<?= $Page->StudyLeaveType_Id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->Study_NumAddTime->Visible) { // Study_NumAddTime ?>
        <td data-name="Study_NumAddTime" <?= $Page->Study_NumAddTime->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_studyleave_Study_NumAddTime">
<span<?= $Page->Study_NumAddTime->viewAttributes() ?>>
<?= $Page->Study_NumAddTime->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->Study_AddTimeStart->Visible) { // Study_AddTimeStart ?>
        <td data-name="Study_AddTimeStart" <?= $Page->Study_AddTimeStart->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_studyleave_Study_AddTimeStart">
<span<?= $Page->Study_AddTimeStart->viewAttributes() ?>>
<?= $Page->Study_AddTimeStart->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->Study_AddTimeEnd->Visible) { // Study_AddTimeEnd ?>
        <td data-name="Study_AddTimeEnd" <?= $Page->Study_AddTimeEnd->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_studyleave_Study_AddTimeEnd">
<span<?= $Page->Study_AddTimeEnd->viewAttributes() ?>>
<?= $Page->Study_AddTimeEnd->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->Study_WorkDate->Visible) { // Study_WorkDate ?>
        <td data-name="Study_WorkDate" <?= $Page->Study_WorkDate->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_studyleave_Study_WorkDate">
<span<?= $Page->Study_WorkDate->viewAttributes() ?>>
<?= $Page->Study_WorkDate->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->Study_GraduationDate->Visible) { // Study_GraduationDate ?>
        <td data-name="Study_GraduationDate" <?= $Page->Study_GraduationDate->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_studyleave_Study_GraduationDate">
<span<?= $Page->Study_GraduationDate->viewAttributes() ?>>
<?= $Page->Study_GraduationDate->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->Study_AdjustDate->Visible) { // Study_AdjustDate ?>
        <td data-name="Study_AdjustDate" <?= $Page->Study_AdjustDate->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_studyleave_Study_AdjustDate">
<span<?= $Page->Study_AdjustDate->viewAttributes() ?>>
<?= $Page->Study_AdjustDate->getViewValue() ?></span>
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
    ew.addEventHandlers("studyleave");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
