<?php

namespace PHPMaker2021\upPersonnelv2;

// Page object
$_02selfdevelopmentEdit = &$Page;
?>
<script>
if (!ew.vars.tables._02selfdevelopment) ew.vars.tables._02selfdevelopment = <?= JsonEncode(GetClientVar("tables", "_02selfdevelopment")) ?>;
var currentForm, currentPageID;
var f_02selfdevelopmentedit;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "edit";
    f_02selfdevelopmentedit = currentForm = new ew.Form("f_02selfdevelopmentedit", "edit");

    // Add fields
    var fields = ew.vars.tables._02selfdevelopment.fields;
    f_02selfdevelopmentedit.addFields([
        ["SelfDev_Id", [fields.SelfDev_Id.required ? ew.Validators.required(fields.SelfDev_Id.caption) : null], fields.SelfDev_Id.isInvalid],
        ["Per_Id", [fields.Per_Id.required ? ew.Validators.required(fields.Per_Id.caption) : null], fields.Per_Id.isInvalid],
        ["SelfDev_Type", [fields.SelfDev_Type.required ? ew.Validators.required(fields.SelfDev_Type.caption) : null], fields.SelfDev_Type.isInvalid],
        ["SelfDev_Name", [fields.SelfDev_Name.required ? ew.Validators.required(fields.SelfDev_Name.caption) : null], fields.SelfDev_Name.isInvalid],
        ["SelfDev_StartDate", [fields.SelfDev_StartDate.required ? ew.Validators.required(fields.SelfDev_StartDate.caption) : null, ew.Validators.datetime(0)], fields.SelfDev_StartDate.isInvalid],
        ["SelfDev_EndDate", [fields.SelfDev_EndDate.required ? ew.Validators.required(fields.SelfDev_EndDate.caption) : null, ew.Validators.datetime(0)], fields.SelfDev_EndDate.isInvalid],
        ["SelfDev_Money", [fields.SelfDev_Money.required ? ew.Validators.required(fields.SelfDev_Money.caption) : null, ew.Validators.float], fields.SelfDev_Money.isInvalid],
        ["SelfDev_Address", [fields.SelfDev_Address.required ? ew.Validators.required(fields.SelfDev_Address.caption) : null], fields.SelfDev_Address.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = f_02selfdevelopmentedit,
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
    f_02selfdevelopmentedit.validate = function () {
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
    f_02selfdevelopmentedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    f_02selfdevelopmentedit.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    f_02selfdevelopmentedit.lists.Per_Id = <?= $Page->Per_Id->toClientList($Page) ?>;
    f_02selfdevelopmentedit.lists.SelfDev_Type = <?= $Page->SelfDev_Type->toClientList($Page) ?>;
    loadjs.done("f_02selfdevelopmentedit");
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
<form name="f_02selfdevelopmentedit" id="f_02selfdevelopmentedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl() ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="_02selfdevelopment">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->SelfDev_Id->Visible) { // SelfDev_Id ?>
    <div id="r_SelfDev_Id" class="form-group row">
        <label id="elh__02selfdevelopment_SelfDev_Id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->SelfDev_Id->caption() ?><?= $Page->SelfDev_Id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->SelfDev_Id->cellAttributes() ?>>
<span id="el__02selfdevelopment_SelfDev_Id">
<span<?= $Page->SelfDev_Id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->SelfDev_Id->getDisplayValue($Page->SelfDev_Id->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="_02selfdevelopment" data-field="x_SelfDev_Id" data-hidden="1" name="x_SelfDev_Id" id="x_SelfDev_Id" value="<?= HtmlEncode($Page->SelfDev_Id->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->Per_Id->Visible) { // Per_Id ?>
    <div id="r_Per_Id" class="form-group row">
        <label id="elh__02selfdevelopment_Per_Id" for="x_Per_Id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Per_Id->caption() ?><?= $Page->Per_Id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->Per_Id->cellAttributes() ?>>
<span id="el__02selfdevelopment_Per_Id">
    <select
        id="x_Per_Id"
        name="x_Per_Id"
        class="form-control ew-select<?= $Page->Per_Id->isInvalidClass() ?>"
        data-select2-id="_02selfdevelopment_x_Per_Id"
        data-table="_02selfdevelopment"
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
    var el = document.querySelector("select[data-select2-id='_02selfdevelopment_x_Per_Id']"),
        options = { name: "x_Per_Id", selectId: "_02selfdevelopment_x_Per_Id", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables._02selfdevelopment.fields.Per_Id.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->SelfDev_Type->Visible) { // SelfDev_Type ?>
    <div id="r_SelfDev_Type" class="form-group row">
        <label id="elh__02selfdevelopment_SelfDev_Type" for="x_SelfDev_Type" class="<?= $Page->LeftColumnClass ?>"><?= $Page->SelfDev_Type->caption() ?><?= $Page->SelfDev_Type->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->SelfDev_Type->cellAttributes() ?>>
<span id="el__02selfdevelopment_SelfDev_Type">
    <select
        id="x_SelfDev_Type"
        name="x_SelfDev_Type"
        class="form-control ew-select<?= $Page->SelfDev_Type->isInvalidClass() ?>"
        data-select2-id="_02selfdevelopment_x_SelfDev_Type"
        data-table="_02selfdevelopment"
        data-field="x_SelfDev_Type"
        data-value-separator="<?= $Page->SelfDev_Type->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->SelfDev_Type->getPlaceHolder()) ?>"
        <?= $Page->SelfDev_Type->editAttributes() ?>>
        <?= $Page->SelfDev_Type->selectOptionListHtml("x_SelfDev_Type") ?>
    </select>
    <?= $Page->SelfDev_Type->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->SelfDev_Type->getErrorMessage() ?></div>
<?= $Page->SelfDev_Type->Lookup->getParamTag($Page, "p_x_SelfDev_Type") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='_02selfdevelopment_x_SelfDev_Type']"),
        options = { name: "x_SelfDev_Type", selectId: "_02selfdevelopment_x_SelfDev_Type", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables._02selfdevelopment.fields.SelfDev_Type.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->SelfDev_Name->Visible) { // SelfDev_Name ?>
    <div id="r_SelfDev_Name" class="form-group row">
        <label id="elh__02selfdevelopment_SelfDev_Name" for="x_SelfDev_Name" class="<?= $Page->LeftColumnClass ?>"><?= $Page->SelfDev_Name->caption() ?><?= $Page->SelfDev_Name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->SelfDev_Name->cellAttributes() ?>>
<span id="el__02selfdevelopment_SelfDev_Name">
<textarea data-table="_02selfdevelopment" data-field="x_SelfDev_Name" name="x_SelfDev_Name" id="x_SelfDev_Name" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->SelfDev_Name->getPlaceHolder()) ?>"<?= $Page->SelfDev_Name->editAttributes() ?> aria-describedby="x_SelfDev_Name_help"><?= $Page->SelfDev_Name->EditValue ?></textarea>
<?= $Page->SelfDev_Name->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->SelfDev_Name->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->SelfDev_StartDate->Visible) { // SelfDev_StartDate ?>
    <div id="r_SelfDev_StartDate" class="form-group row">
        <label id="elh__02selfdevelopment_SelfDev_StartDate" for="x_SelfDev_StartDate" class="<?= $Page->LeftColumnClass ?>"><?= $Page->SelfDev_StartDate->caption() ?><?= $Page->SelfDev_StartDate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->SelfDev_StartDate->cellAttributes() ?>>
<span id="el__02selfdevelopment_SelfDev_StartDate">
<input type="<?= $Page->SelfDev_StartDate->getInputTextType() ?>" data-table="_02selfdevelopment" data-field="x_SelfDev_StartDate" name="x_SelfDev_StartDate" id="x_SelfDev_StartDate" placeholder="<?= HtmlEncode($Page->SelfDev_StartDate->getPlaceHolder()) ?>" value="<?= $Page->SelfDev_StartDate->EditValue ?>"<?= $Page->SelfDev_StartDate->editAttributes() ?> aria-describedby="x_SelfDev_StartDate_help">
<?= $Page->SelfDev_StartDate->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->SelfDev_StartDate->getErrorMessage() ?></div>
<?php if (!$Page->SelfDev_StartDate->ReadOnly && !$Page->SelfDev_StartDate->Disabled && !isset($Page->SelfDev_StartDate->EditAttrs["readonly"]) && !isset($Page->SelfDev_StartDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["f_02selfdevelopmentedit", "datetimepicker"], function() {
    ew.createDateTimePicker("f_02selfdevelopmentedit", "x_SelfDev_StartDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->SelfDev_EndDate->Visible) { // SelfDev_EndDate ?>
    <div id="r_SelfDev_EndDate" class="form-group row">
        <label id="elh__02selfdevelopment_SelfDev_EndDate" for="x_SelfDev_EndDate" class="<?= $Page->LeftColumnClass ?>"><?= $Page->SelfDev_EndDate->caption() ?><?= $Page->SelfDev_EndDate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->SelfDev_EndDate->cellAttributes() ?>>
<span id="el__02selfdevelopment_SelfDev_EndDate">
<input type="<?= $Page->SelfDev_EndDate->getInputTextType() ?>" data-table="_02selfdevelopment" data-field="x_SelfDev_EndDate" name="x_SelfDev_EndDate" id="x_SelfDev_EndDate" placeholder="<?= HtmlEncode($Page->SelfDev_EndDate->getPlaceHolder()) ?>" value="<?= $Page->SelfDev_EndDate->EditValue ?>"<?= $Page->SelfDev_EndDate->editAttributes() ?> aria-describedby="x_SelfDev_EndDate_help">
<?= $Page->SelfDev_EndDate->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->SelfDev_EndDate->getErrorMessage() ?></div>
<?php if (!$Page->SelfDev_EndDate->ReadOnly && !$Page->SelfDev_EndDate->Disabled && !isset($Page->SelfDev_EndDate->EditAttrs["readonly"]) && !isset($Page->SelfDev_EndDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["f_02selfdevelopmentedit", "datetimepicker"], function() {
    ew.createDateTimePicker("f_02selfdevelopmentedit", "x_SelfDev_EndDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->SelfDev_Money->Visible) { // SelfDev_Money ?>
    <div id="r_SelfDev_Money" class="form-group row">
        <label id="elh__02selfdevelopment_SelfDev_Money" for="x_SelfDev_Money" class="<?= $Page->LeftColumnClass ?>"><?= $Page->SelfDev_Money->caption() ?><?= $Page->SelfDev_Money->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->SelfDev_Money->cellAttributes() ?>>
<span id="el__02selfdevelopment_SelfDev_Money">
<input type="<?= $Page->SelfDev_Money->getInputTextType() ?>" data-table="_02selfdevelopment" data-field="x_SelfDev_Money" name="x_SelfDev_Money" id="x_SelfDev_Money" size="30" placeholder="<?= HtmlEncode($Page->SelfDev_Money->getPlaceHolder()) ?>" value="<?= $Page->SelfDev_Money->EditValue ?>"<?= $Page->SelfDev_Money->editAttributes() ?> aria-describedby="x_SelfDev_Money_help">
<?= $Page->SelfDev_Money->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->SelfDev_Money->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->SelfDev_Address->Visible) { // SelfDev_Address ?>
    <div id="r_SelfDev_Address" class="form-group row">
        <label id="elh__02selfdevelopment_SelfDev_Address" for="x_SelfDev_Address" class="<?= $Page->LeftColumnClass ?>"><?= $Page->SelfDev_Address->caption() ?><?= $Page->SelfDev_Address->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->SelfDev_Address->cellAttributes() ?>>
<span id="el__02selfdevelopment_SelfDev_Address">
<textarea data-table="_02selfdevelopment" data-field="x_SelfDev_Address" name="x_SelfDev_Address" id="x_SelfDev_Address" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->SelfDev_Address->getPlaceHolder()) ?>"<?= $Page->SelfDev_Address->editAttributes() ?> aria-describedby="x_SelfDev_Address_help"><?= $Page->SelfDev_Address->EditValue ?></textarea>
<?= $Page->SelfDev_Address->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->SelfDev_Address->getErrorMessage() ?></div>
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
    ew.addEventHandlers("_02selfdevelopment");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
