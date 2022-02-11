<?php

namespace PHPMaker2021\upPersonnel;

// Page object
$AcademicranksAdd = &$Page;
?>
<script>
if (!ew.vars.tables.academicranks) ew.vars.tables.academicranks = <?= JsonEncode(GetClientVar("tables", "academicranks")) ?>;
var currentForm, currentPageID;
var facademicranksadd;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "add";
    facademicranksadd = currentForm = new ew.Form("facademicranksadd", "add");

    // Add fields
    var fields = ew.vars.tables.academicranks.fields;
    facademicranksadd.addFields([
        ["Per_Id", [fields.Per_Id.required ? ew.Validators.required(fields.Per_Id.caption) : null, ew.Validators.integer], fields.Per_Id.isInvalid],
        ["Aca_RequesDate", [fields.Aca_RequesDate.required ? ew.Validators.required(fields.Aca_RequesDate.caption) : null, ew.Validators.datetime(0)], fields.Aca_RequesDate.isInvalid],
        ["Aca_AcceptDate", [fields.Aca_AcceptDate.required ? ew.Validators.required(fields.Aca_AcceptDate.caption) : null, ew.Validators.datetime(0)], fields.Aca_AcceptDate.isInvalid],
        ["Aca_EstimateStart", [fields.Aca_EstimateStart.required ? ew.Validators.required(fields.Aca_EstimateStart.caption) : null, ew.Validators.datetime(0)], fields.Aca_EstimateStart.isInvalid],
        ["Aca_EstimateEnd", [fields.Aca_EstimateEnd.required ? ew.Validators.required(fields.Aca_EstimateEnd.caption) : null, ew.Validators.datetime(0)], fields.Aca_EstimateEnd.isInvalid],
        ["Aca_Name", [fields.Aca_Name.required ? ew.Validators.required(fields.Aca_Name.caption) : null], fields.Aca_Name.isInvalid],
        ["Aca_Status", [fields.Aca_Status.required ? ew.Validators.required(fields.Aca_Status.caption) : null], fields.Aca_Status.isInvalid],
        ["Aca_SkillMajor", [fields.Aca_SkillMajor.required ? ew.Validators.required(fields.Aca_SkillMajor.caption) : null], fields.Aca_SkillMajor.isInvalid],
        ["Aca_Report", [fields.Aca_Report.required ? ew.Validators.required(fields.Aca_Report.caption) : null, ew.Validators.datetime(0)], fields.Aca_Report.isInvalid],
        ["Aca_EstimateTeaching", [fields.Aca_EstimateTeaching.required ? ew.Validators.required(fields.Aca_EstimateTeaching.caption) : null], fields.Aca_EstimateTeaching.isInvalid],
        ["Aca_EstimateBook", [fields.Aca_EstimateBook.required ? ew.Validators.required(fields.Aca_EstimateBook.caption) : null], fields.Aca_EstimateBook.isInvalid],
        ["Aca_EstimateNum", [fields.Aca_EstimateNum.required ? ew.Validators.required(fields.Aca_EstimateNum.caption) : null], fields.Aca_EstimateNum.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = facademicranksadd,
            fobj = f.getForm(),
            $fobj = $(fobj),
            $k = $fobj.find("#" + f.formKeyCountName), // Get key_count
            rowcnt = ($k[0]) ? parseInt($k.val(), 10) : 1,
            startcnt = (rowcnt == 0) ? 0 : 1; // Check rowcnt == 0 => Inline-Add
        for (var i = startcnt; i <= rowcnt; i++) {
            var rowIndex = ($k[0]) ? String(i) : "";
            f.setInvalid(rowIndex);
        }
    });

    // Validate form
    facademicranksadd.validate = function () {
        if (!this.validateRequired)
            return true; // Ignore validation
        var fobj = this.getForm(),
            $fobj = $(fobj);
        if ($fobj.find("#confirm").val() == "confirm")
            return true;
        var addcnt = 0,
            $k = $fobj.find("#" + this.formKeyCountName), // Get key_count
            rowcnt = ($k[0]) ? parseInt($k.val(), 10) : 1,
            startcnt = (rowcnt == 0) ? 0 : 1, // Check rowcnt == 0 => Inline-Add
            gridinsert = ["insert", "gridinsert"].includes($fobj.find("#action").val()) && $k[0];
        for (var i = startcnt; i <= rowcnt; i++) {
            var rowIndex = ($k[0]) ? String(i) : "";
            $fobj.data("rowindex", rowIndex);

            // Validate fields
            if (!this.validateFields(rowIndex))
                return false;

            // Call Form_CustomValidate event
            if (!this.customValidate(fobj)) {
                this.focus();
                return false;
            }
        }

        // Process detail forms
        var dfs = $fobj.find("input[name='detailpage']").get();
        for (var i = 0; i < dfs.length; i++) {
            var df = dfs[i],
                val = df.value,
                frm = ew.forms.get(val);
            if (val && frm && !frm.validate())
                return false;
        }
        return true;
    }

    // Form_CustomValidate
    facademicranksadd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    facademicranksadd.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    loadjs.done("facademicranksadd");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="facademicranksadd" id="facademicranksadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl() ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="academicranks">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->Per_Id->Visible) { // Per_Id ?>
    <div id="r_Per_Id" class="form-group row">
        <label id="elh_academicranks_Per_Id" for="x_Per_Id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Per_Id->caption() ?><?= $Page->Per_Id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->Per_Id->cellAttributes() ?>>
<span id="el_academicranks_Per_Id">
<input type="<?= $Page->Per_Id->getInputTextType() ?>" data-table="academicranks" data-field="x_Per_Id" name="x_Per_Id" id="x_Per_Id" size="30" maxlength="10" placeholder="<?= HtmlEncode($Page->Per_Id->getPlaceHolder()) ?>" value="<?= $Page->Per_Id->EditValue ?>"<?= $Page->Per_Id->editAttributes() ?> aria-describedby="x_Per_Id_help">
<?= $Page->Per_Id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->Per_Id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->Aca_RequesDate->Visible) { // Aca_RequesDate ?>
    <div id="r_Aca_RequesDate" class="form-group row">
        <label id="elh_academicranks_Aca_RequesDate" for="x_Aca_RequesDate" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Aca_RequesDate->caption() ?><?= $Page->Aca_RequesDate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->Aca_RequesDate->cellAttributes() ?>>
<span id="el_academicranks_Aca_RequesDate">
<input type="<?= $Page->Aca_RequesDate->getInputTextType() ?>" data-table="academicranks" data-field="x_Aca_RequesDate" name="x_Aca_RequesDate" id="x_Aca_RequesDate" placeholder="<?= HtmlEncode($Page->Aca_RequesDate->getPlaceHolder()) ?>" value="<?= $Page->Aca_RequesDate->EditValue ?>"<?= $Page->Aca_RequesDate->editAttributes() ?> aria-describedby="x_Aca_RequesDate_help">
<?= $Page->Aca_RequesDate->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->Aca_RequesDate->getErrorMessage() ?></div>
<?php if (!$Page->Aca_RequesDate->ReadOnly && !$Page->Aca_RequesDate->Disabled && !isset($Page->Aca_RequesDate->EditAttrs["readonly"]) && !isset($Page->Aca_RequesDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["facademicranksadd", "datetimepicker"], function() {
    ew.createDateTimePicker("facademicranksadd", "x_Aca_RequesDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->Aca_AcceptDate->Visible) { // Aca_AcceptDate ?>
    <div id="r_Aca_AcceptDate" class="form-group row">
        <label id="elh_academicranks_Aca_AcceptDate" for="x_Aca_AcceptDate" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Aca_AcceptDate->caption() ?><?= $Page->Aca_AcceptDate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->Aca_AcceptDate->cellAttributes() ?>>
<span id="el_academicranks_Aca_AcceptDate">
<input type="<?= $Page->Aca_AcceptDate->getInputTextType() ?>" data-table="academicranks" data-field="x_Aca_AcceptDate" name="x_Aca_AcceptDate" id="x_Aca_AcceptDate" placeholder="<?= HtmlEncode($Page->Aca_AcceptDate->getPlaceHolder()) ?>" value="<?= $Page->Aca_AcceptDate->EditValue ?>"<?= $Page->Aca_AcceptDate->editAttributes() ?> aria-describedby="x_Aca_AcceptDate_help">
<?= $Page->Aca_AcceptDate->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->Aca_AcceptDate->getErrorMessage() ?></div>
<?php if (!$Page->Aca_AcceptDate->ReadOnly && !$Page->Aca_AcceptDate->Disabled && !isset($Page->Aca_AcceptDate->EditAttrs["readonly"]) && !isset($Page->Aca_AcceptDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["facademicranksadd", "datetimepicker"], function() {
    ew.createDateTimePicker("facademicranksadd", "x_Aca_AcceptDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->Aca_EstimateStart->Visible) { // Aca_EstimateStart ?>
    <div id="r_Aca_EstimateStart" class="form-group row">
        <label id="elh_academicranks_Aca_EstimateStart" for="x_Aca_EstimateStart" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Aca_EstimateStart->caption() ?><?= $Page->Aca_EstimateStart->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->Aca_EstimateStart->cellAttributes() ?>>
<span id="el_academicranks_Aca_EstimateStart">
<input type="<?= $Page->Aca_EstimateStart->getInputTextType() ?>" data-table="academicranks" data-field="x_Aca_EstimateStart" name="x_Aca_EstimateStart" id="x_Aca_EstimateStart" placeholder="<?= HtmlEncode($Page->Aca_EstimateStart->getPlaceHolder()) ?>" value="<?= $Page->Aca_EstimateStart->EditValue ?>"<?= $Page->Aca_EstimateStart->editAttributes() ?> aria-describedby="x_Aca_EstimateStart_help">
<?= $Page->Aca_EstimateStart->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->Aca_EstimateStart->getErrorMessage() ?></div>
<?php if (!$Page->Aca_EstimateStart->ReadOnly && !$Page->Aca_EstimateStart->Disabled && !isset($Page->Aca_EstimateStart->EditAttrs["readonly"]) && !isset($Page->Aca_EstimateStart->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["facademicranksadd", "datetimepicker"], function() {
    ew.createDateTimePicker("facademicranksadd", "x_Aca_EstimateStart", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->Aca_EstimateEnd->Visible) { // Aca_EstimateEnd ?>
    <div id="r_Aca_EstimateEnd" class="form-group row">
        <label id="elh_academicranks_Aca_EstimateEnd" for="x_Aca_EstimateEnd" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Aca_EstimateEnd->caption() ?><?= $Page->Aca_EstimateEnd->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->Aca_EstimateEnd->cellAttributes() ?>>
<span id="el_academicranks_Aca_EstimateEnd">
<input type="<?= $Page->Aca_EstimateEnd->getInputTextType() ?>" data-table="academicranks" data-field="x_Aca_EstimateEnd" name="x_Aca_EstimateEnd" id="x_Aca_EstimateEnd" placeholder="<?= HtmlEncode($Page->Aca_EstimateEnd->getPlaceHolder()) ?>" value="<?= $Page->Aca_EstimateEnd->EditValue ?>"<?= $Page->Aca_EstimateEnd->editAttributes() ?> aria-describedby="x_Aca_EstimateEnd_help">
<?= $Page->Aca_EstimateEnd->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->Aca_EstimateEnd->getErrorMessage() ?></div>
<?php if (!$Page->Aca_EstimateEnd->ReadOnly && !$Page->Aca_EstimateEnd->Disabled && !isset($Page->Aca_EstimateEnd->EditAttrs["readonly"]) && !isset($Page->Aca_EstimateEnd->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["facademicranksadd", "datetimepicker"], function() {
    ew.createDateTimePicker("facademicranksadd", "x_Aca_EstimateEnd", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->Aca_Name->Visible) { // Aca_Name ?>
    <div id="r_Aca_Name" class="form-group row">
        <label id="elh_academicranks_Aca_Name" for="x_Aca_Name" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Aca_Name->caption() ?><?= $Page->Aca_Name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->Aca_Name->cellAttributes() ?>>
<span id="el_academicranks_Aca_Name">
<input type="<?= $Page->Aca_Name->getInputTextType() ?>" data-table="academicranks" data-field="x_Aca_Name" name="x_Aca_Name" id="x_Aca_Name" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->Aca_Name->getPlaceHolder()) ?>" value="<?= $Page->Aca_Name->EditValue ?>"<?= $Page->Aca_Name->editAttributes() ?> aria-describedby="x_Aca_Name_help">
<?= $Page->Aca_Name->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->Aca_Name->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->Aca_Status->Visible) { // Aca_Status ?>
    <div id="r_Aca_Status" class="form-group row">
        <label id="elh_academicranks_Aca_Status" for="x_Aca_Status" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Aca_Status->caption() ?><?= $Page->Aca_Status->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->Aca_Status->cellAttributes() ?>>
<span id="el_academicranks_Aca_Status">
<input type="<?= $Page->Aca_Status->getInputTextType() ?>" data-table="academicranks" data-field="x_Aca_Status" name="x_Aca_Status" id="x_Aca_Status" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->Aca_Status->getPlaceHolder()) ?>" value="<?= $Page->Aca_Status->EditValue ?>"<?= $Page->Aca_Status->editAttributes() ?> aria-describedby="x_Aca_Status_help">
<?= $Page->Aca_Status->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->Aca_Status->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->Aca_SkillMajor->Visible) { // Aca_SkillMajor ?>
    <div id="r_Aca_SkillMajor" class="form-group row">
        <label id="elh_academicranks_Aca_SkillMajor" for="x_Aca_SkillMajor" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Aca_SkillMajor->caption() ?><?= $Page->Aca_SkillMajor->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->Aca_SkillMajor->cellAttributes() ?>>
<span id="el_academicranks_Aca_SkillMajor">
<input type="<?= $Page->Aca_SkillMajor->getInputTextType() ?>" data-table="academicranks" data-field="x_Aca_SkillMajor" name="x_Aca_SkillMajor" id="x_Aca_SkillMajor" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->Aca_SkillMajor->getPlaceHolder()) ?>" value="<?= $Page->Aca_SkillMajor->EditValue ?>"<?= $Page->Aca_SkillMajor->editAttributes() ?> aria-describedby="x_Aca_SkillMajor_help">
<?= $Page->Aca_SkillMajor->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->Aca_SkillMajor->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->Aca_Report->Visible) { // Aca_Report ?>
    <div id="r_Aca_Report" class="form-group row">
        <label id="elh_academicranks_Aca_Report" for="x_Aca_Report" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Aca_Report->caption() ?><?= $Page->Aca_Report->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->Aca_Report->cellAttributes() ?>>
<span id="el_academicranks_Aca_Report">
<input type="<?= $Page->Aca_Report->getInputTextType() ?>" data-table="academicranks" data-field="x_Aca_Report" name="x_Aca_Report" id="x_Aca_Report" placeholder="<?= HtmlEncode($Page->Aca_Report->getPlaceHolder()) ?>" value="<?= $Page->Aca_Report->EditValue ?>"<?= $Page->Aca_Report->editAttributes() ?> aria-describedby="x_Aca_Report_help">
<?= $Page->Aca_Report->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->Aca_Report->getErrorMessage() ?></div>
<?php if (!$Page->Aca_Report->ReadOnly && !$Page->Aca_Report->Disabled && !isset($Page->Aca_Report->EditAttrs["readonly"]) && !isset($Page->Aca_Report->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["facademicranksadd", "datetimepicker"], function() {
    ew.createDateTimePicker("facademicranksadd", "x_Aca_Report", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->Aca_EstimateTeaching->Visible) { // Aca_EstimateTeaching ?>
    <div id="r_Aca_EstimateTeaching" class="form-group row">
        <label id="elh_academicranks_Aca_EstimateTeaching" for="x_Aca_EstimateTeaching" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Aca_EstimateTeaching->caption() ?><?= $Page->Aca_EstimateTeaching->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->Aca_EstimateTeaching->cellAttributes() ?>>
<span id="el_academicranks_Aca_EstimateTeaching">
<input type="<?= $Page->Aca_EstimateTeaching->getInputTextType() ?>" data-table="academicranks" data-field="x_Aca_EstimateTeaching" name="x_Aca_EstimateTeaching" id="x_Aca_EstimateTeaching" size="30" maxlength="10" placeholder="<?= HtmlEncode($Page->Aca_EstimateTeaching->getPlaceHolder()) ?>" value="<?= $Page->Aca_EstimateTeaching->EditValue ?>"<?= $Page->Aca_EstimateTeaching->editAttributes() ?> aria-describedby="x_Aca_EstimateTeaching_help">
<?= $Page->Aca_EstimateTeaching->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->Aca_EstimateTeaching->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->Aca_EstimateBook->Visible) { // Aca_EstimateBook ?>
    <div id="r_Aca_EstimateBook" class="form-group row">
        <label id="elh_academicranks_Aca_EstimateBook" for="x_Aca_EstimateBook" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Aca_EstimateBook->caption() ?><?= $Page->Aca_EstimateBook->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->Aca_EstimateBook->cellAttributes() ?>>
<span id="el_academicranks_Aca_EstimateBook">
<input type="<?= $Page->Aca_EstimateBook->getInputTextType() ?>" data-table="academicranks" data-field="x_Aca_EstimateBook" name="x_Aca_EstimateBook" id="x_Aca_EstimateBook" size="30" maxlength="10" placeholder="<?= HtmlEncode($Page->Aca_EstimateBook->getPlaceHolder()) ?>" value="<?= $Page->Aca_EstimateBook->EditValue ?>"<?= $Page->Aca_EstimateBook->editAttributes() ?> aria-describedby="x_Aca_EstimateBook_help">
<?= $Page->Aca_EstimateBook->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->Aca_EstimateBook->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->Aca_EstimateNum->Visible) { // Aca_EstimateNum ?>
    <div id="r_Aca_EstimateNum" class="form-group row">
        <label id="elh_academicranks_Aca_EstimateNum" for="x_Aca_EstimateNum" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Aca_EstimateNum->caption() ?><?= $Page->Aca_EstimateNum->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->Aca_EstimateNum->cellAttributes() ?>>
<span id="el_academicranks_Aca_EstimateNum">
<input type="<?= $Page->Aca_EstimateNum->getInputTextType() ?>" data-table="academicranks" data-field="x_Aca_EstimateNum" name="x_Aca_EstimateNum" id="x_Aca_EstimateNum" size="30" maxlength="1" placeholder="<?= HtmlEncode($Page->Aca_EstimateNum->getPlaceHolder()) ?>" value="<?= $Page->Aca_EstimateNum->EditValue ?>"<?= $Page->Aca_EstimateNum->editAttributes() ?> aria-describedby="x_Aca_EstimateNum_help">
<?= $Page->Aca_EstimateNum->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->Aca_EstimateNum->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$Page->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?= $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
    </div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
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
