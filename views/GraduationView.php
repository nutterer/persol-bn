<?php

namespace PHPMaker2021\upPersonnelv2;

// Page object
$GraduationView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fgraduationview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    fgraduationview = currentForm = new ew.Form("fgraduationview", "view");
    loadjs.done("fgraduationview");
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
<form name="fgraduationview" id="fgraduationview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl() ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="graduation">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Page->Grad_Id->Visible) { // Grad_Id ?>
    <tr id="r_Grad_Id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_graduation_Grad_Id"><?= $Page->Grad_Id->caption() ?></span></td>
        <td data-name="Grad_Id" <?= $Page->Grad_Id->cellAttributes() ?>>
<span id="el_graduation_Grad_Id">
<span<?= $Page->Grad_Id->viewAttributes() ?>>
<?= $Page->Grad_Id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->Per_Id->Visible) { // Per_Id ?>
    <tr id="r_Per_Id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_graduation_Per_Id"><?= $Page->Per_Id->caption() ?></span></td>
        <td data-name="Per_Id" <?= $Page->Per_Id->cellAttributes() ?>>
<span id="el_graduation_Per_Id">
<span<?= $Page->Per_Id->viewAttributes() ?>>
<?= $Page->Per_Id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->Grad_Degree->Visible) { // Grad_Degree ?>
    <tr id="r_Grad_Degree">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_graduation_Grad_Degree"><?= $Page->Grad_Degree->caption() ?></span></td>
        <td data-name="Grad_Degree" <?= $Page->Grad_Degree->cellAttributes() ?>>
<span id="el_graduation_Grad_Degree">
<span<?= $Page->Grad_Degree->viewAttributes() ?>>
<?= $Page->Grad_Degree->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->Grad_Major->Visible) { // Grad_Major ?>
    <tr id="r_Grad_Major">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_graduation_Grad_Major"><?= $Page->Grad_Major->caption() ?></span></td>
        <td data-name="Grad_Major" <?= $Page->Grad_Major->cellAttributes() ?>>
<span id="el_graduation_Grad_Major">
<span<?= $Page->Grad_Major->viewAttributes() ?>>
<?= $Page->Grad_Major->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->Grad_ShortDegree->Visible) { // Grad_ShortDegree ?>
    <tr id="r_Grad_ShortDegree">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_graduation_Grad_ShortDegree"><?= $Page->Grad_ShortDegree->caption() ?></span></td>
        <td data-name="Grad_ShortDegree" <?= $Page->Grad_ShortDegree->cellAttributes() ?>>
<span id="el_graduation_Grad_ShortDegree">
<span<?= $Page->Grad_ShortDegree->viewAttributes() ?>>
<?= $Page->Grad_ShortDegree->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->Grad_Institution->Visible) { // Grad_Institution ?>
    <tr id="r_Grad_Institution">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_graduation_Grad_Institution"><?= $Page->Grad_Institution->caption() ?></span></td>
        <td data-name="Grad_Institution" <?= $Page->Grad_Institution->cellAttributes() ?>>
<span id="el_graduation_Grad_Institution">
<span<?= $Page->Grad_Institution->viewAttributes() ?>>
<?= $Page->Grad_Institution->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->Grad_Provinces->Visible) { // Grad_Provinces ?>
    <tr id="r_Grad_Provinces">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_graduation_Grad_Provinces"><?= $Page->Grad_Provinces->caption() ?></span></td>
        <td data-name="Grad_Provinces" <?= $Page->Grad_Provinces->cellAttributes() ?>>
<span id="el_graduation_Grad_Provinces">
<span<?= $Page->Grad_Provinces->viewAttributes() ?>>
<?= $Page->Grad_Provinces->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->Grad_Country->Visible) { // Grad_Country ?>
    <tr id="r_Grad_Country">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_graduation_Grad_Country"><?= $Page->Grad_Country->caption() ?></span></td>
        <td data-name="Grad_Country" <?= $Page->Grad_Country->cellAttributes() ?>>
<span id="el_graduation_Grad_Country">
<span<?= $Page->Grad_Country->viewAttributes() ?>>
<?= $Page->Grad_Country->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->Grad_Start->Visible) { // Grad_Start ?>
    <tr id="r_Grad_Start">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_graduation_Grad_Start"><?= $Page->Grad_Start->caption() ?></span></td>
        <td data-name="Grad_Start" <?= $Page->Grad_Start->cellAttributes() ?>>
<span id="el_graduation_Grad_Start">
<span<?= $Page->Grad_Start->viewAttributes() ?>>
<?= $Page->Grad_Start->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->Grad_End->Visible) { // Grad_End ?>
    <tr id="r_Grad_End">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_graduation_Grad_End"><?= $Page->Grad_End->caption() ?></span></td>
        <td data-name="Grad_End" <?= $Page->Grad_End->cellAttributes() ?>>
<span id="el_graduation_Grad_End">
<span<?= $Page->Grad_End->viewAttributes() ?>>
<?= $Page->Grad_End->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->Grad_GPA->Visible) { // Grad_GPA ?>
    <tr id="r_Grad_GPA">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_graduation_Grad_GPA"><?= $Page->Grad_GPA->caption() ?></span></td>
        <td data-name="Grad_GPA" <?= $Page->Grad_GPA->cellAttributes() ?>>
<span id="el_graduation_Grad_GPA">
<span<?= $Page->Grad_GPA->viewAttributes() ?>>
<?= $Page->Grad_GPA->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->Grad_Honor->Visible) { // Grad_Honor ?>
    <tr id="r_Grad_Honor">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_graduation_Grad_Honor"><?= $Page->Grad_Honor->caption() ?></span></td>
        <td data-name="Grad_Honor" <?= $Page->Grad_Honor->cellAttributes() ?>>
<span id="el_graduation_Grad_Honor">
<span<?= $Page->Grad_Honor->viewAttributes() ?>>
<?= $Page->Grad_Honor->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->Grad_Admission->Visible) { // Grad_Admission ?>
    <tr id="r_Grad_Admission">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_graduation_Grad_Admission"><?= $Page->Grad_Admission->caption() ?></span></td>
        <td data-name="Grad_Admission" <?= $Page->Grad_Admission->cellAttributes() ?>>
<span id="el_graduation_Grad_Admission">
<span<?= $Page->Grad_Admission->viewAttributes() ?>>
<?= $Page->Grad_Admission->getViewValue() ?></span>
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
