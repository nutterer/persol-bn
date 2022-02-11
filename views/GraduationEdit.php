<?php

namespace PHPMaker2021\upPersonnelv2;

// Page object
$GraduationEdit = &$Page;
?>
<script>
if (!ew.vars.tables.graduation) ew.vars.tables.graduation = <?= JsonEncode(GetClientVar("tables", "graduation")) ?>;
var currentForm, currentPageID;
var fgraduationedit;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "edit";
    fgraduationedit = currentForm = new ew.Form("fgraduationedit", "edit");

    // Add fields
    var fields = ew.vars.tables.graduation.fields;
    fgraduationedit.addFields([
        ["Grad_Id", [fields.Grad_Id.required ? ew.Validators.required(fields.Grad_Id.caption) : null], fields.Grad_Id.isInvalid],
        ["Per_Id", [fields.Per_Id.required ? ew.Validators.required(fields.Per_Id.caption) : null], fields.Per_Id.isInvalid],
        ["Grad_Degree", [fields.Grad_Degree.required ? ew.Validators.required(fields.Grad_Degree.caption) : null], fields.Grad_Degree.isInvalid],
        ["Grad_Major", [fields.Grad_Major.required ? ew.Validators.required(fields.Grad_Major.caption) : null], fields.Grad_Major.isInvalid],
        ["Grad_ShortDegree", [fields.Grad_ShortDegree.required ? ew.Validators.required(fields.Grad_ShortDegree.caption) : null], fields.Grad_ShortDegree.isInvalid],
        ["Grad_Institution", [fields.Grad_Institution.required ? ew.Validators.required(fields.Grad_Institution.caption) : null], fields.Grad_Institution.isInvalid],
        ["Grad_Provinces", [fields.Grad_Provinces.required ? ew.Validators.required(fields.Grad_Provinces.caption) : null], fields.Grad_Provinces.isInvalid],
        ["Grad_Country", [fields.Grad_Country.required ? ew.Validators.required(fields.Grad_Country.caption) : null], fields.Grad_Country.isInvalid],
        ["Grad_Start", [fields.Grad_Start.required ? ew.Validators.required(fields.Grad_Start.caption) : null, ew.Validators.datetime(0)], fields.Grad_Start.isInvalid],
        ["Grad_End", [fields.Grad_End.required ? ew.Validators.required(fields.Grad_End.caption) : null, ew.Validators.datetime(0)], fields.Grad_End.isInvalid],
        ["Grad_GPA", [fields.Grad_GPA.required ? ew.Validators.required(fields.Grad_GPA.caption) : null], fields.Grad_GPA.isInvalid],
        ["Grad_Honor", [fields.Grad_Honor.required ? ew.Validators.required(fields.Grad_Honor.caption) : null], fields.Grad_Honor.isInvalid],
        ["Grad_Admission", [fields.Grad_Admission.required ? ew.Validators.required(fields.Grad_Admission.caption) : null], fields.Grad_Admission.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fgraduationedit,
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
    fgraduationedit.validate = function () {
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
    fgraduationedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fgraduationedit.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    fgraduationedit.lists.Per_Id = <?= $Page->Per_Id->toClientList($Page) ?>;
    fgraduationedit.lists.Grad_Admission = <?= $Page->Grad_Admission->toClientList($Page) ?>;
    loadjs.done("fgraduationedit");
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
<form name="fgraduationedit" id="fgraduationedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl() ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="graduation">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->Grad_Id->Visible) { // Grad_Id ?>
    <div id="r_Grad_Id" class="form-group row">
        <label id="elh_graduation_Grad_Id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Grad_Id->caption() ?><?= $Page->Grad_Id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->Grad_Id->cellAttributes() ?>>
<span id="el_graduation_Grad_Id">
<span<?= $Page->Grad_Id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->Grad_Id->getDisplayValue($Page->Grad_Id->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="graduation" data-field="x_Grad_Id" data-hidden="1" name="x_Grad_Id" id="x_Grad_Id" value="<?= HtmlEncode($Page->Grad_Id->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->Per_Id->Visible) { // Per_Id ?>
    <div id="r_Per_Id" class="form-group row">
        <label id="elh_graduation_Per_Id" for="x_Per_Id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Per_Id->caption() ?><?= $Page->Per_Id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->Per_Id->cellAttributes() ?>>
<span id="el_graduation_Per_Id">
    <select
        id="x_Per_Id"
        name="x_Per_Id"
        class="form-control ew-select<?= $Page->Per_Id->isInvalidClass() ?>"
        data-select2-id="graduation_x_Per_Id"
        data-table="graduation"
        data-field="x_Per_Id"
        data-value-separator="<?= $Page->Per_Id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->Per_Id->getPlaceHolder()) ?>"
        <?= $Page->Per_Id->editAttributes() ?>>
        <?= $Page->Per_Id->selectOptionListHtml("x_Per_Id") ?>
    </select>
    <?= $Page->Per_Id->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->Per_Id->getErrorMessage() ?></div>
<?= $Page->Per_Id->Lookup->getParamTag($Page, "p_x_Per_Id") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='graduation_x_Per_Id']"),
        options = { name: "x_Per_Id", selectId: "graduation_x_Per_Id", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.graduation.fields.Per_Id.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->Grad_Degree->Visible) { // Grad_Degree ?>
    <div id="r_Grad_Degree" class="form-group row">
        <label id="elh_graduation_Grad_Degree" for="x_Grad_Degree" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Grad_Degree->caption() ?><?= $Page->Grad_Degree->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->Grad_Degree->cellAttributes() ?>>
<span id="el_graduation_Grad_Degree">
<textarea data-table="graduation" data-field="x_Grad_Degree" name="x_Grad_Degree" id="x_Grad_Degree" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->Grad_Degree->getPlaceHolder()) ?>"<?= $Page->Grad_Degree->editAttributes() ?> aria-describedby="x_Grad_Degree_help"><?= $Page->Grad_Degree->EditValue ?></textarea>
<?= $Page->Grad_Degree->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->Grad_Degree->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->Grad_Major->Visible) { // Grad_Major ?>
    <div id="r_Grad_Major" class="form-group row">
        <label id="elh_graduation_Grad_Major" for="x_Grad_Major" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Grad_Major->caption() ?><?= $Page->Grad_Major->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->Grad_Major->cellAttributes() ?>>
<span id="el_graduation_Grad_Major">
<textarea data-table="graduation" data-field="x_Grad_Major" name="x_Grad_Major" id="x_Grad_Major" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->Grad_Major->getPlaceHolder()) ?>"<?= $Page->Grad_Major->editAttributes() ?> aria-describedby="x_Grad_Major_help"><?= $Page->Grad_Major->EditValue ?></textarea>
<?= $Page->Grad_Major->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->Grad_Major->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->Grad_ShortDegree->Visible) { // Grad_ShortDegree ?>
    <div id="r_Grad_ShortDegree" class="form-group row">
        <label id="elh_graduation_Grad_ShortDegree" for="x_Grad_ShortDegree" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Grad_ShortDegree->caption() ?><?= $Page->Grad_ShortDegree->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->Grad_ShortDegree->cellAttributes() ?>>
<span id="el_graduation_Grad_ShortDegree">
<textarea data-table="graduation" data-field="x_Grad_ShortDegree" name="x_Grad_ShortDegree" id="x_Grad_ShortDegree" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->Grad_ShortDegree->getPlaceHolder()) ?>"<?= $Page->Grad_ShortDegree->editAttributes() ?> aria-describedby="x_Grad_ShortDegree_help"><?= $Page->Grad_ShortDegree->EditValue ?></textarea>
<?= $Page->Grad_ShortDegree->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->Grad_ShortDegree->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->Grad_Institution->Visible) { // Grad_Institution ?>
    <div id="r_Grad_Institution" class="form-group row">
        <label id="elh_graduation_Grad_Institution" for="x_Grad_Institution" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Grad_Institution->caption() ?><?= $Page->Grad_Institution->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->Grad_Institution->cellAttributes() ?>>
<span id="el_graduation_Grad_Institution">
<input type="<?= $Page->Grad_Institution->getInputTextType() ?>" data-table="graduation" data-field="x_Grad_Institution" name="x_Grad_Institution" id="x_Grad_Institution" size="30" maxlength="200" placeholder="<?= HtmlEncode($Page->Grad_Institution->getPlaceHolder()) ?>" value="<?= $Page->Grad_Institution->EditValue ?>"<?= $Page->Grad_Institution->editAttributes() ?> aria-describedby="x_Grad_Institution_help">
<?= $Page->Grad_Institution->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->Grad_Institution->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->Grad_Provinces->Visible) { // Grad_Provinces ?>
    <div id="r_Grad_Provinces" class="form-group row">
        <label id="elh_graduation_Grad_Provinces" for="x_Grad_Provinces" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Grad_Provinces->caption() ?><?= $Page->Grad_Provinces->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->Grad_Provinces->cellAttributes() ?>>
<span id="el_graduation_Grad_Provinces">
<input type="<?= $Page->Grad_Provinces->getInputTextType() ?>" data-table="graduation" data-field="x_Grad_Provinces" name="x_Grad_Provinces" id="x_Grad_Provinces" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->Grad_Provinces->getPlaceHolder()) ?>" value="<?= $Page->Grad_Provinces->EditValue ?>"<?= $Page->Grad_Provinces->editAttributes() ?> aria-describedby="x_Grad_Provinces_help">
<?= $Page->Grad_Provinces->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->Grad_Provinces->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->Grad_Country->Visible) { // Grad_Country ?>
    <div id="r_Grad_Country" class="form-group row">
        <label id="elh_graduation_Grad_Country" for="x_Grad_Country" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Grad_Country->caption() ?><?= $Page->Grad_Country->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->Grad_Country->cellAttributes() ?>>
<span id="el_graduation_Grad_Country">
<input type="<?= $Page->Grad_Country->getInputTextType() ?>" data-table="graduation" data-field="x_Grad_Country" name="x_Grad_Country" id="x_Grad_Country" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->Grad_Country->getPlaceHolder()) ?>" value="<?= $Page->Grad_Country->EditValue ?>"<?= $Page->Grad_Country->editAttributes() ?> aria-describedby="x_Grad_Country_help">
<?= $Page->Grad_Country->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->Grad_Country->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->Grad_Start->Visible) { // Grad_Start ?>
    <div id="r_Grad_Start" class="form-group row">
        <label id="elh_graduation_Grad_Start" for="x_Grad_Start" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Grad_Start->caption() ?><?= $Page->Grad_Start->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->Grad_Start->cellAttributes() ?>>
<span id="el_graduation_Grad_Start">
<input type="<?= $Page->Grad_Start->getInputTextType() ?>" data-table="graduation" data-field="x_Grad_Start" name="x_Grad_Start" id="x_Grad_Start" placeholder="<?= HtmlEncode($Page->Grad_Start->getPlaceHolder()) ?>" value="<?= $Page->Grad_Start->EditValue ?>"<?= $Page->Grad_Start->editAttributes() ?> aria-describedby="x_Grad_Start_help">
<?= $Page->Grad_Start->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->Grad_Start->getErrorMessage() ?></div>
<?php if (!$Page->Grad_Start->ReadOnly && !$Page->Grad_Start->Disabled && !isset($Page->Grad_Start->EditAttrs["readonly"]) && !isset($Page->Grad_Start->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fgraduationedit", "datetimepicker"], function() {
    ew.createDateTimePicker("fgraduationedit", "x_Grad_Start", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->Grad_End->Visible) { // Grad_End ?>
    <div id="r_Grad_End" class="form-group row">
        <label id="elh_graduation_Grad_End" for="x_Grad_End" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Grad_End->caption() ?><?= $Page->Grad_End->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->Grad_End->cellAttributes() ?>>
<span id="el_graduation_Grad_End">
<input type="<?= $Page->Grad_End->getInputTextType() ?>" data-table="graduation" data-field="x_Grad_End" name="x_Grad_End" id="x_Grad_End" placeholder="<?= HtmlEncode($Page->Grad_End->getPlaceHolder()) ?>" value="<?= $Page->Grad_End->EditValue ?>"<?= $Page->Grad_End->editAttributes() ?> aria-describedby="x_Grad_End_help">
<?= $Page->Grad_End->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->Grad_End->getErrorMessage() ?></div>
<?php if (!$Page->Grad_End->ReadOnly && !$Page->Grad_End->Disabled && !isset($Page->Grad_End->EditAttrs["readonly"]) && !isset($Page->Grad_End->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fgraduationedit", "datetimepicker"], function() {
    ew.createDateTimePicker("fgraduationedit", "x_Grad_End", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->Grad_GPA->Visible) { // Grad_GPA ?>
    <div id="r_Grad_GPA" class="form-group row">
        <label id="elh_graduation_Grad_GPA" for="x_Grad_GPA" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Grad_GPA->caption() ?><?= $Page->Grad_GPA->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->Grad_GPA->cellAttributes() ?>>
<span id="el_graduation_Grad_GPA">
<input type="<?= $Page->Grad_GPA->getInputTextType() ?>" data-table="graduation" data-field="x_Grad_GPA" name="x_Grad_GPA" id="x_Grad_GPA" size="30" maxlength="4" placeholder="<?= HtmlEncode($Page->Grad_GPA->getPlaceHolder()) ?>" value="<?= $Page->Grad_GPA->EditValue ?>"<?= $Page->Grad_GPA->editAttributes() ?> aria-describedby="x_Grad_GPA_help">
<?= $Page->Grad_GPA->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->Grad_GPA->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->Grad_Honor->Visible) { // Grad_Honor ?>
    <div id="r_Grad_Honor" class="form-group row">
        <label id="elh_graduation_Grad_Honor" for="x_Grad_Honor" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Grad_Honor->caption() ?><?= $Page->Grad_Honor->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->Grad_Honor->cellAttributes() ?>>
<span id="el_graduation_Grad_Honor">
<input type="<?= $Page->Grad_Honor->getInputTextType() ?>" data-table="graduation" data-field="x_Grad_Honor" name="x_Grad_Honor" id="x_Grad_Honor" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->Grad_Honor->getPlaceHolder()) ?>" value="<?= $Page->Grad_Honor->EditValue ?>"<?= $Page->Grad_Honor->editAttributes() ?> aria-describedby="x_Grad_Honor_help">
<?= $Page->Grad_Honor->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->Grad_Honor->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->Grad_Admission->Visible) { // Grad_Admission ?>
    <div id="r_Grad_Admission" class="form-group row">
        <label id="elh_graduation_Grad_Admission" for="x_Grad_Admission" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Grad_Admission->caption() ?><?= $Page->Grad_Admission->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->Grad_Admission->cellAttributes() ?>>
<span id="el_graduation_Grad_Admission">
    <select
        id="x_Grad_Admission"
        name="x_Grad_Admission"
        class="form-control ew-select<?= $Page->Grad_Admission->isInvalidClass() ?>"
        data-select2-id="graduation_x_Grad_Admission"
        data-table="graduation"
        data-field="x_Grad_Admission"
        data-value-separator="<?= $Page->Grad_Admission->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->Grad_Admission->getPlaceHolder()) ?>"
        <?= $Page->Grad_Admission->editAttributes() ?>>
        <?= $Page->Grad_Admission->selectOptionListHtml("x_Grad_Admission") ?>
    </select>
    <?= $Page->Grad_Admission->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->Grad_Admission->getErrorMessage() ?></div>
<?= $Page->Grad_Admission->Lookup->getParamTag($Page, "p_x_Grad_Admission") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='graduation_x_Grad_Admission']"),
        options = { name: "x_Grad_Admission", selectId: "graduation_x_Grad_Admission", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.graduation.fields.Grad_Admission.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$Page->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?= $Language->phrase("SaveBtn") ?></button>
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
    ew.addEventHandlers("graduation");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
