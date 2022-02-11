<?php

namespace PHPMaker2021\upPersonnelv2;

// Page object
$AcademicpublicAdd = &$Page;
?>
<script>
if (!ew.vars.tables.academicpublic) ew.vars.tables.academicpublic = <?= JsonEncode(GetClientVar("tables", "academicpublic")) ?>;
var currentForm, currentPageID;
var facademicpublicadd;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "add";
    facademicpublicadd = currentForm = new ew.Form("facademicpublicadd", "add");

    // Add fields
    var fields = ew.vars.tables.academicpublic.fields;
    facademicpublicadd.addFields([
        ["Aca_Id", [fields.Aca_Id.required ? ew.Validators.required(fields.Aca_Id.caption) : null], fields.Aca_Id.isInvalid],
        ["Public_Type", [fields.Public_Type.required ? ew.Validators.required(fields.Public_Type.caption) : null], fields.Public_Type.isInvalid],
        ["Public_Journal", [fields.Public_Journal.required ? ew.Validators.required(fields.Public_Journal.caption) : null], fields.Public_Journal.isInvalid],
        ["Public_Title", [fields.Public_Title.required ? ew.Validators.required(fields.Public_Title.caption) : null], fields.Public_Title.isInvalid],
        ["Public_Date", [fields.Public_Date.required ? ew.Validators.required(fields.Public_Date.caption) : null, ew.Validators.datetime(0)], fields.Public_Date.isInvalid],
        ["Public_Volum", [fields.Public_Volum.required ? ew.Validators.required(fields.Public_Volum.caption) : null, ew.Validators.integer], fields.Public_Volum.isInvalid],
        ["Public_Link", [fields.Public_Link.required ? ew.Validators.required(fields.Public_Link.caption) : null], fields.Public_Link.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = facademicpublicadd,
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
    facademicpublicadd.validate = function () {
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
    facademicpublicadd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    facademicpublicadd.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    facademicpublicadd.lists.Aca_Id = <?= $Page->Aca_Id->toClientList($Page) ?>;
    facademicpublicadd.lists.Public_Type = <?= $Page->Public_Type->toClientList($Page) ?>;
    loadjs.done("facademicpublicadd");
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
<form name="facademicpublicadd" id="facademicpublicadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl() ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="academicpublic">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->Aca_Id->Visible) { // Aca_Id ?>
    <div id="r_Aca_Id" class="form-group row">
        <label id="elh_academicpublic_Aca_Id" for="x_Aca_Id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Aca_Id->caption() ?><?= $Page->Aca_Id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->Aca_Id->cellAttributes() ?>>
<span id="el_academicpublic_Aca_Id">
    <select
        id="x_Aca_Id"
        name="x_Aca_Id"
        class="form-control ew-select<?= $Page->Aca_Id->isInvalidClass() ?>"
        data-select2-id="academicpublic_x_Aca_Id"
        data-table="academicpublic"
        data-field="x_Aca_Id"
        data-value-separator="<?= $Page->Aca_Id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->Aca_Id->getPlaceHolder()) ?>"
        <?= $Page->Aca_Id->editAttributes() ?>>
        <?= $Page->Aca_Id->selectOptionListHtml("x_Aca_Id") ?>
    </select>
    <?= $Page->Aca_Id->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->Aca_Id->getErrorMessage() ?></div>
<?= $Page->Aca_Id->Lookup->getParamTag($Page, "p_x_Aca_Id") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='academicpublic_x_Aca_Id']"),
        options = { name: "x_Aca_Id", selectId: "academicpublic_x_Aca_Id", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.academicpublic.fields.Aca_Id.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->Public_Type->Visible) { // Public_Type ?>
    <div id="r_Public_Type" class="form-group row">
        <label id="elh_academicpublic_Public_Type" for="x_Public_Type" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Public_Type->caption() ?><?= $Page->Public_Type->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->Public_Type->cellAttributes() ?>>
<span id="el_academicpublic_Public_Type">
    <select
        id="x_Public_Type"
        name="x_Public_Type"
        class="form-control ew-select<?= $Page->Public_Type->isInvalidClass() ?>"
        data-select2-id="academicpublic_x_Public_Type"
        data-table="academicpublic"
        data-field="x_Public_Type"
        data-value-separator="<?= $Page->Public_Type->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->Public_Type->getPlaceHolder()) ?>"
        <?= $Page->Public_Type->editAttributes() ?>>
        <?= $Page->Public_Type->selectOptionListHtml("x_Public_Type") ?>
    </select>
    <?= $Page->Public_Type->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->Public_Type->getErrorMessage() ?></div>
<?= $Page->Public_Type->Lookup->getParamTag($Page, "p_x_Public_Type") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='academicpublic_x_Public_Type']"),
        options = { name: "x_Public_Type", selectId: "academicpublic_x_Public_Type", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.academicpublic.fields.Public_Type.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->Public_Journal->Visible) { // Public_Journal ?>
    <div id="r_Public_Journal" class="form-group row">
        <label id="elh_academicpublic_Public_Journal" for="x_Public_Journal" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Public_Journal->caption() ?><?= $Page->Public_Journal->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->Public_Journal->cellAttributes() ?>>
<span id="el_academicpublic_Public_Journal">
<input type="<?= $Page->Public_Journal->getInputTextType() ?>" data-table="academicpublic" data-field="x_Public_Journal" name="x_Public_Journal" id="x_Public_Journal" size="30" maxlength="200" placeholder="<?= HtmlEncode($Page->Public_Journal->getPlaceHolder()) ?>" value="<?= $Page->Public_Journal->EditValue ?>"<?= $Page->Public_Journal->editAttributes() ?> aria-describedby="x_Public_Journal_help">
<?= $Page->Public_Journal->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->Public_Journal->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->Public_Title->Visible) { // Public_Title ?>
    <div id="r_Public_Title" class="form-group row">
        <label id="elh_academicpublic_Public_Title" for="x_Public_Title" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Public_Title->caption() ?><?= $Page->Public_Title->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->Public_Title->cellAttributes() ?>>
<span id="el_academicpublic_Public_Title">
<input type="<?= $Page->Public_Title->getInputTextType() ?>" data-table="academicpublic" data-field="x_Public_Title" name="x_Public_Title" id="x_Public_Title" size="30" maxlength="200" placeholder="<?= HtmlEncode($Page->Public_Title->getPlaceHolder()) ?>" value="<?= $Page->Public_Title->EditValue ?>"<?= $Page->Public_Title->editAttributes() ?> aria-describedby="x_Public_Title_help">
<?= $Page->Public_Title->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->Public_Title->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->Public_Date->Visible) { // Public_Date ?>
    <div id="r_Public_Date" class="form-group row">
        <label id="elh_academicpublic_Public_Date" for="x_Public_Date" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Public_Date->caption() ?><?= $Page->Public_Date->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->Public_Date->cellAttributes() ?>>
<span id="el_academicpublic_Public_Date">
<input type="<?= $Page->Public_Date->getInputTextType() ?>" data-table="academicpublic" data-field="x_Public_Date" name="x_Public_Date" id="x_Public_Date" placeholder="<?= HtmlEncode($Page->Public_Date->getPlaceHolder()) ?>" value="<?= $Page->Public_Date->EditValue ?>"<?= $Page->Public_Date->editAttributes() ?> aria-describedby="x_Public_Date_help">
<?= $Page->Public_Date->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->Public_Date->getErrorMessage() ?></div>
<?php if (!$Page->Public_Date->ReadOnly && !$Page->Public_Date->Disabled && !isset($Page->Public_Date->EditAttrs["readonly"]) && !isset($Page->Public_Date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["facademicpublicadd", "datetimepicker"], function() {
    ew.createDateTimePicker("facademicpublicadd", "x_Public_Date", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->Public_Volum->Visible) { // Public_Volum ?>
    <div id="r_Public_Volum" class="form-group row">
        <label id="elh_academicpublic_Public_Volum" for="x_Public_Volum" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Public_Volum->caption() ?><?= $Page->Public_Volum->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->Public_Volum->cellAttributes() ?>>
<span id="el_academicpublic_Public_Volum">
<input type="<?= $Page->Public_Volum->getInputTextType() ?>" data-table="academicpublic" data-field="x_Public_Volum" name="x_Public_Volum" id="x_Public_Volum" size="30" placeholder="<?= HtmlEncode($Page->Public_Volum->getPlaceHolder()) ?>" value="<?= $Page->Public_Volum->EditValue ?>"<?= $Page->Public_Volum->editAttributes() ?> aria-describedby="x_Public_Volum_help">
<?= $Page->Public_Volum->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->Public_Volum->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->Public_Link->Visible) { // Public_Link ?>
    <div id="r_Public_Link" class="form-group row">
        <label id="elh_academicpublic_Public_Link" for="x_Public_Link" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Public_Link->caption() ?><?= $Page->Public_Link->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->Public_Link->cellAttributes() ?>>
<span id="el_academicpublic_Public_Link">
<input type="<?= $Page->Public_Link->getInputTextType() ?>" data-table="academicpublic" data-field="x_Public_Link" name="x_Public_Link" id="x_Public_Link" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->Public_Link->getPlaceHolder()) ?>" value="<?= $Page->Public_Link->EditValue ?>"<?= $Page->Public_Link->editAttributes() ?> aria-describedby="x_Public_Link_help">
<?= $Page->Public_Link->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->Public_Link->getErrorMessage() ?></div>
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
    ew.addEventHandlers("academicpublic");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
