<?php

namespace PHPMaker2021\upPersonnelv2;

// Page object
$_01personnelAdd = &$Page;
?>
<script>
if (!ew.vars.tables._01personnel) ew.vars.tables._01personnel = <?= JsonEncode(GetClientVar("tables", "_01personnel")) ?>;
var currentForm, currentPageID;
var f_01personneladd;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "add";
    f_01personneladd = currentForm = new ew.Form("f_01personneladd", "add");

    // Add fields
    var fields = ew.vars.tables._01personnel.fields;
    f_01personneladd.addFields([
        ["Per_Id", [fields.Per_Id.required ? ew.Validators.required(fields.Per_Id.caption) : null, ew.Validators.integer], fields.Per_Id.isInvalid],
        ["Per_ThaiPre", [fields.Per_ThaiPre.required ? ew.Validators.required(fields.Per_ThaiPre.caption) : null], fields.Per_ThaiPre.isInvalid],
        ["Per_ThaiName", [fields.Per_ThaiName.required ? ew.Validators.required(fields.Per_ThaiName.caption) : null], fields.Per_ThaiName.isInvalid],
        ["Per_ThaiLastName", [fields.Per_ThaiLastName.required ? ew.Validators.required(fields.Per_ThaiLastName.caption) : null], fields.Per_ThaiLastName.isInvalid],
        ["Per_EngPre", [fields.Per_EngPre.required ? ew.Validators.required(fields.Per_EngPre.caption) : null], fields.Per_EngPre.isInvalid],
        ["Per_EngName", [fields.Per_EngName.required ? ew.Validators.required(fields.Per_EngName.caption) : null], fields.Per_EngName.isInvalid],
        ["Per_EngLastName", [fields.Per_EngLastName.required ? ew.Validators.required(fields.Per_EngLastName.caption) : null], fields.Per_EngLastName.isInvalid],
        ["Per_Type", [fields.Per_Type.required ? ew.Validators.required(fields.Per_Type.caption) : null], fields.Per_Type.isInvalid],
        ["Per_EmployeeType", [fields.Per_EmployeeType.required ? ew.Validators.required(fields.Per_EmployeeType.caption) : null], fields.Per_EmployeeType.isInvalid],
        ["Per_Position", [fields.Per_Position.required ? ew.Validators.required(fields.Per_Position.caption) : null], fields.Per_Position.isInvalid],
        ["Per_major", [fields.Per_major.required ? ew.Validators.required(fields.Per_major.caption) : null], fields.Per_major.isInvalid],
        ["Per_Academic", [fields.Per_Academic.required ? ew.Validators.required(fields.Per_Academic.caption) : null], fields.Per_Academic.isInvalid],
        ["Per_Administrative", [fields.Per_Administrative.required ? ew.Validators.required(fields.Per_Administrative.caption) : null], fields.Per_Administrative.isInvalid],
        ["Per_WorDateStart", [fields.Per_WorDateStart.required ? ew.Validators.required(fields.Per_WorDateStart.caption) : null, ew.Validators.datetime(0)], fields.Per_WorDateStart.isInvalid],
        ["Per_WorkDate", [fields.Per_WorkDate.required ? ew.Validators.required(fields.Per_WorkDate.caption) : null, ew.Validators.datetime(0)], fields.Per_WorkDate.isInvalid],
        ["Per_Born", [fields.Per_Born.required ? ew.Validators.required(fields.Per_Born.caption) : null, ew.Validators.datetime(0)], fields.Per_Born.isInvalid],
        ["Per_Nationality", [fields.Per_Nationality.required ? ew.Validators.required(fields.Per_Nationality.caption) : null], fields.Per_Nationality.isInvalid],
        ["Per_Religion", [fields.Per_Religion.required ? ew.Validators.required(fields.Per_Religion.caption) : null], fields.Per_Religion.isInvalid],
        ["Per_IdCard", [fields.Per_IdCard.required ? ew.Validators.required(fields.Per_IdCard.caption) : null], fields.Per_IdCard.isInvalid],
        ["Per_WorkStatus", [fields.Per_WorkStatus.required ? ew.Validators.required(fields.Per_WorkStatus.caption) : null], fields.Per_WorkStatus.isInvalid],
        ["Per_Phone", [fields.Per_Phone.required ? ew.Validators.required(fields.Per_Phone.caption) : null], fields.Per_Phone.isInvalid],
        ["Per_UPEmail", [fields.Per_UPEmail.required ? ew.Validators.required(fields.Per_UPEmail.caption) : null], fields.Per_UPEmail.isInvalid],
        ["Per_Email", [fields.Per_Email.required ? ew.Validators.required(fields.Per_Email.caption) : null], fields.Per_Email.isInvalid],
        ["Per_Address", [fields.Per_Address.required ? ew.Validators.required(fields.Per_Address.caption) : null], fields.Per_Address.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = f_01personneladd,
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
    f_01personneladd.validate = function () {
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
    f_01personneladd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    f_01personneladd.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    f_01personneladd.lists.Per_Type = <?= $Page->Per_Type->toClientList($Page) ?>;
    f_01personneladd.lists.Per_EmployeeType = <?= $Page->Per_EmployeeType->toClientList($Page) ?>;
    f_01personneladd.lists.Per_Position = <?= $Page->Per_Position->toClientList($Page) ?>;
    f_01personneladd.lists.Per_major = <?= $Page->Per_major->toClientList($Page) ?>;
    f_01personneladd.lists.Per_Academic = <?= $Page->Per_Academic->toClientList($Page) ?>;
    f_01personneladd.lists.Per_Administrative = <?= $Page->Per_Administrative->toClientList($Page) ?>;
    f_01personneladd.lists.Per_Nationality = <?= $Page->Per_Nationality->toClientList($Page) ?>;
    f_01personneladd.lists.Per_Religion = <?= $Page->Per_Religion->toClientList($Page) ?>;
    f_01personneladd.lists.Per_WorkStatus = <?= $Page->Per_WorkStatus->toClientList($Page) ?>;
    loadjs.done("f_01personneladd");
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
<form name="f_01personneladd" id="f_01personneladd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl() ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="_01personnel">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->Per_Id->Visible) { // Per_Id ?>
    <div id="r_Per_Id" class="form-group row">
        <label id="elh__01personnel_Per_Id" for="x_Per_Id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Per_Id->caption() ?><?= $Page->Per_Id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->Per_Id->cellAttributes() ?>>
<span id="el__01personnel_Per_Id">
<input type="<?= $Page->Per_Id->getInputTextType() ?>" data-table="_01personnel" data-field="x_Per_Id" name="x_Per_Id" id="x_Per_Id" size="30" placeholder="<?= HtmlEncode($Page->Per_Id->getPlaceHolder()) ?>" value="<?= $Page->Per_Id->EditValue ?>"<?= $Page->Per_Id->editAttributes() ?> aria-describedby="x_Per_Id_help">
<?= $Page->Per_Id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->Per_Id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->Per_ThaiPre->Visible) { // Per_ThaiPre ?>
    <div id="r_Per_ThaiPre" class="form-group row">
        <label id="elh__01personnel_Per_ThaiPre" for="x_Per_ThaiPre" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Per_ThaiPre->caption() ?><?= $Page->Per_ThaiPre->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->Per_ThaiPre->cellAttributes() ?>>
<span id="el__01personnel_Per_ThaiPre">
<input type="<?= $Page->Per_ThaiPre->getInputTextType() ?>" data-table="_01personnel" data-field="x_Per_ThaiPre" name="x_Per_ThaiPre" id="x_Per_ThaiPre" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->Per_ThaiPre->getPlaceHolder()) ?>" value="<?= $Page->Per_ThaiPre->EditValue ?>"<?= $Page->Per_ThaiPre->editAttributes() ?> aria-describedby="x_Per_ThaiPre_help">
<?= $Page->Per_ThaiPre->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->Per_ThaiPre->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->Per_ThaiName->Visible) { // Per_ThaiName ?>
    <div id="r_Per_ThaiName" class="form-group row">
        <label id="elh__01personnel_Per_ThaiName" for="x_Per_ThaiName" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Per_ThaiName->caption() ?><?= $Page->Per_ThaiName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->Per_ThaiName->cellAttributes() ?>>
<span id="el__01personnel_Per_ThaiName">
<input type="<?= $Page->Per_ThaiName->getInputTextType() ?>" data-table="_01personnel" data-field="x_Per_ThaiName" name="x_Per_ThaiName" id="x_Per_ThaiName" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->Per_ThaiName->getPlaceHolder()) ?>" value="<?= $Page->Per_ThaiName->EditValue ?>"<?= $Page->Per_ThaiName->editAttributes() ?> aria-describedby="x_Per_ThaiName_help">
<?= $Page->Per_ThaiName->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->Per_ThaiName->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->Per_ThaiLastName->Visible) { // Per_ThaiLastName ?>
    <div id="r_Per_ThaiLastName" class="form-group row">
        <label id="elh__01personnel_Per_ThaiLastName" for="x_Per_ThaiLastName" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Per_ThaiLastName->caption() ?><?= $Page->Per_ThaiLastName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->Per_ThaiLastName->cellAttributes() ?>>
<span id="el__01personnel_Per_ThaiLastName">
<input type="<?= $Page->Per_ThaiLastName->getInputTextType() ?>" data-table="_01personnel" data-field="x_Per_ThaiLastName" name="x_Per_ThaiLastName" id="x_Per_ThaiLastName" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->Per_ThaiLastName->getPlaceHolder()) ?>" value="<?= $Page->Per_ThaiLastName->EditValue ?>"<?= $Page->Per_ThaiLastName->editAttributes() ?> aria-describedby="x_Per_ThaiLastName_help">
<?= $Page->Per_ThaiLastName->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->Per_ThaiLastName->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->Per_EngPre->Visible) { // Per_EngPre ?>
    <div id="r_Per_EngPre" class="form-group row">
        <label id="elh__01personnel_Per_EngPre" for="x_Per_EngPre" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Per_EngPre->caption() ?><?= $Page->Per_EngPre->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->Per_EngPre->cellAttributes() ?>>
<span id="el__01personnel_Per_EngPre">
<input type="<?= $Page->Per_EngPre->getInputTextType() ?>" data-table="_01personnel" data-field="x_Per_EngPre" name="x_Per_EngPre" id="x_Per_EngPre" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->Per_EngPre->getPlaceHolder()) ?>" value="<?= $Page->Per_EngPre->EditValue ?>"<?= $Page->Per_EngPre->editAttributes() ?> aria-describedby="x_Per_EngPre_help">
<?= $Page->Per_EngPre->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->Per_EngPre->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->Per_EngName->Visible) { // Per_EngName ?>
    <div id="r_Per_EngName" class="form-group row">
        <label id="elh__01personnel_Per_EngName" for="x_Per_EngName" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Per_EngName->caption() ?><?= $Page->Per_EngName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->Per_EngName->cellAttributes() ?>>
<span id="el__01personnel_Per_EngName">
<input type="<?= $Page->Per_EngName->getInputTextType() ?>" data-table="_01personnel" data-field="x_Per_EngName" name="x_Per_EngName" id="x_Per_EngName" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->Per_EngName->getPlaceHolder()) ?>" value="<?= $Page->Per_EngName->EditValue ?>"<?= $Page->Per_EngName->editAttributes() ?> aria-describedby="x_Per_EngName_help">
<?= $Page->Per_EngName->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->Per_EngName->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->Per_EngLastName->Visible) { // Per_EngLastName ?>
    <div id="r_Per_EngLastName" class="form-group row">
        <label id="elh__01personnel_Per_EngLastName" for="x_Per_EngLastName" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Per_EngLastName->caption() ?><?= $Page->Per_EngLastName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->Per_EngLastName->cellAttributes() ?>>
<span id="el__01personnel_Per_EngLastName">
<input type="<?= $Page->Per_EngLastName->getInputTextType() ?>" data-table="_01personnel" data-field="x_Per_EngLastName" name="x_Per_EngLastName" id="x_Per_EngLastName" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->Per_EngLastName->getPlaceHolder()) ?>" value="<?= $Page->Per_EngLastName->EditValue ?>"<?= $Page->Per_EngLastName->editAttributes() ?> aria-describedby="x_Per_EngLastName_help">
<?= $Page->Per_EngLastName->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->Per_EngLastName->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->Per_Type->Visible) { // Per_Type ?>
    <div id="r_Per_Type" class="form-group row">
        <label id="elh__01personnel_Per_Type" for="x_Per_Type" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Per_Type->caption() ?><?= $Page->Per_Type->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->Per_Type->cellAttributes() ?>>
<span id="el__01personnel_Per_Type">
    <select
        id="x_Per_Type"
        name="x_Per_Type"
        class="form-control ew-select<?= $Page->Per_Type->isInvalidClass() ?>"
        data-select2-id="_01personnel_x_Per_Type"
        data-table="_01personnel"
        data-field="x_Per_Type"
        data-value-separator="<?= $Page->Per_Type->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->Per_Type->getPlaceHolder()) ?>"
        <?= $Page->Per_Type->editAttributes() ?>>
        <?= $Page->Per_Type->selectOptionListHtml("x_Per_Type") ?>
    </select>
    <?= $Page->Per_Type->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->Per_Type->getErrorMessage() ?></div>
<?= $Page->Per_Type->Lookup->getParamTag($Page, "p_x_Per_Type") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='_01personnel_x_Per_Type']"),
        options = { name: "x_Per_Type", selectId: "_01personnel_x_Per_Type", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables._01personnel.fields.Per_Type.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->Per_EmployeeType->Visible) { // Per_EmployeeType ?>
    <div id="r_Per_EmployeeType" class="form-group row">
        <label id="elh__01personnel_Per_EmployeeType" for="x_Per_EmployeeType" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Per_EmployeeType->caption() ?><?= $Page->Per_EmployeeType->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->Per_EmployeeType->cellAttributes() ?>>
<span id="el__01personnel_Per_EmployeeType">
    <select
        id="x_Per_EmployeeType"
        name="x_Per_EmployeeType"
        class="form-control ew-select<?= $Page->Per_EmployeeType->isInvalidClass() ?>"
        data-select2-id="_01personnel_x_Per_EmployeeType"
        data-table="_01personnel"
        data-field="x_Per_EmployeeType"
        data-value-separator="<?= $Page->Per_EmployeeType->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->Per_EmployeeType->getPlaceHolder()) ?>"
        <?= $Page->Per_EmployeeType->editAttributes() ?>>
        <?= $Page->Per_EmployeeType->selectOptionListHtml("x_Per_EmployeeType") ?>
    </select>
    <?= $Page->Per_EmployeeType->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->Per_EmployeeType->getErrorMessage() ?></div>
<?= $Page->Per_EmployeeType->Lookup->getParamTag($Page, "p_x_Per_EmployeeType") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='_01personnel_x_Per_EmployeeType']"),
        options = { name: "x_Per_EmployeeType", selectId: "_01personnel_x_Per_EmployeeType", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables._01personnel.fields.Per_EmployeeType.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->Per_Position->Visible) { // Per_Position ?>
    <div id="r_Per_Position" class="form-group row">
        <label id="elh__01personnel_Per_Position" for="x_Per_Position" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Per_Position->caption() ?><?= $Page->Per_Position->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->Per_Position->cellAttributes() ?>>
<span id="el__01personnel_Per_Position">
    <select
        id="x_Per_Position"
        name="x_Per_Position"
        class="form-control ew-select<?= $Page->Per_Position->isInvalidClass() ?>"
        data-select2-id="_01personnel_x_Per_Position"
        data-table="_01personnel"
        data-field="x_Per_Position"
        data-value-separator="<?= $Page->Per_Position->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->Per_Position->getPlaceHolder()) ?>"
        <?= $Page->Per_Position->editAttributes() ?>>
        <?= $Page->Per_Position->selectOptionListHtml("x_Per_Position") ?>
    </select>
    <?= $Page->Per_Position->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->Per_Position->getErrorMessage() ?></div>
<?= $Page->Per_Position->Lookup->getParamTag($Page, "p_x_Per_Position") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='_01personnel_x_Per_Position']"),
        options = { name: "x_Per_Position", selectId: "_01personnel_x_Per_Position", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables._01personnel.fields.Per_Position.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->Per_major->Visible) { // Per_major ?>
    <div id="r_Per_major" class="form-group row">
        <label id="elh__01personnel_Per_major" for="x_Per_major" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Per_major->caption() ?><?= $Page->Per_major->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->Per_major->cellAttributes() ?>>
<span id="el__01personnel_Per_major">
    <select
        id="x_Per_major"
        name="x_Per_major"
        class="form-control ew-select<?= $Page->Per_major->isInvalidClass() ?>"
        data-select2-id="_01personnel_x_Per_major"
        data-table="_01personnel"
        data-field="x_Per_major"
        data-value-separator="<?= $Page->Per_major->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->Per_major->getPlaceHolder()) ?>"
        <?= $Page->Per_major->editAttributes() ?>>
        <?= $Page->Per_major->selectOptionListHtml("x_Per_major") ?>
    </select>
    <?= $Page->Per_major->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->Per_major->getErrorMessage() ?></div>
<?= $Page->Per_major->Lookup->getParamTag($Page, "p_x_Per_major") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='_01personnel_x_Per_major']"),
        options = { name: "x_Per_major", selectId: "_01personnel_x_Per_major", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables._01personnel.fields.Per_major.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->Per_Academic->Visible) { // Per_Academic ?>
    <div id="r_Per_Academic" class="form-group row">
        <label id="elh__01personnel_Per_Academic" for="x_Per_Academic" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Per_Academic->caption() ?><?= $Page->Per_Academic->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->Per_Academic->cellAttributes() ?>>
<span id="el__01personnel_Per_Academic">
    <select
        id="x_Per_Academic"
        name="x_Per_Academic"
        class="form-control ew-select<?= $Page->Per_Academic->isInvalidClass() ?>"
        data-select2-id="_01personnel_x_Per_Academic"
        data-table="_01personnel"
        data-field="x_Per_Academic"
        data-value-separator="<?= $Page->Per_Academic->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->Per_Academic->getPlaceHolder()) ?>"
        <?= $Page->Per_Academic->editAttributes() ?>>
        <?= $Page->Per_Academic->selectOptionListHtml("x_Per_Academic") ?>
    </select>
    <?= $Page->Per_Academic->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->Per_Academic->getErrorMessage() ?></div>
<?= $Page->Per_Academic->Lookup->getParamTag($Page, "p_x_Per_Academic") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='_01personnel_x_Per_Academic']"),
        options = { name: "x_Per_Academic", selectId: "_01personnel_x_Per_Academic", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables._01personnel.fields.Per_Academic.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->Per_Administrative->Visible) { // Per_Administrative ?>
    <div id="r_Per_Administrative" class="form-group row">
        <label id="elh__01personnel_Per_Administrative" for="x_Per_Administrative" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Per_Administrative->caption() ?><?= $Page->Per_Administrative->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->Per_Administrative->cellAttributes() ?>>
<span id="el__01personnel_Per_Administrative">
    <select
        id="x_Per_Administrative"
        name="x_Per_Administrative"
        class="form-control ew-select<?= $Page->Per_Administrative->isInvalidClass() ?>"
        data-select2-id="_01personnel_x_Per_Administrative"
        data-table="_01personnel"
        data-field="x_Per_Administrative"
        data-value-separator="<?= $Page->Per_Administrative->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->Per_Administrative->getPlaceHolder()) ?>"
        <?= $Page->Per_Administrative->editAttributes() ?>>
        <?= $Page->Per_Administrative->selectOptionListHtml("x_Per_Administrative") ?>
    </select>
    <?= $Page->Per_Administrative->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->Per_Administrative->getErrorMessage() ?></div>
<?= $Page->Per_Administrative->Lookup->getParamTag($Page, "p_x_Per_Administrative") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='_01personnel_x_Per_Administrative']"),
        options = { name: "x_Per_Administrative", selectId: "_01personnel_x_Per_Administrative", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables._01personnel.fields.Per_Administrative.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->Per_WorDateStart->Visible) { // Per_WorDateStart ?>
    <div id="r_Per_WorDateStart" class="form-group row">
        <label id="elh__01personnel_Per_WorDateStart" for="x_Per_WorDateStart" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Per_WorDateStart->caption() ?><?= $Page->Per_WorDateStart->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->Per_WorDateStart->cellAttributes() ?>>
<span id="el__01personnel_Per_WorDateStart">
<input type="<?= $Page->Per_WorDateStart->getInputTextType() ?>" data-table="_01personnel" data-field="x_Per_WorDateStart" name="x_Per_WorDateStart" id="x_Per_WorDateStart" placeholder="<?= HtmlEncode($Page->Per_WorDateStart->getPlaceHolder()) ?>" value="<?= $Page->Per_WorDateStart->EditValue ?>"<?= $Page->Per_WorDateStart->editAttributes() ?> aria-describedby="x_Per_WorDateStart_help">
<?= $Page->Per_WorDateStart->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->Per_WorDateStart->getErrorMessage() ?></div>
<?php if (!$Page->Per_WorDateStart->ReadOnly && !$Page->Per_WorDateStart->Disabled && !isset($Page->Per_WorDateStart->EditAttrs["readonly"]) && !isset($Page->Per_WorDateStart->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["f_01personneladd", "datetimepicker"], function() {
    ew.createDateTimePicker("f_01personneladd", "x_Per_WorDateStart", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->Per_WorkDate->Visible) { // Per_WorkDate ?>
    <div id="r_Per_WorkDate" class="form-group row">
        <label id="elh__01personnel_Per_WorkDate" for="x_Per_WorkDate" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Per_WorkDate->caption() ?><?= $Page->Per_WorkDate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->Per_WorkDate->cellAttributes() ?>>
<span id="el__01personnel_Per_WorkDate">
<input type="<?= $Page->Per_WorkDate->getInputTextType() ?>" data-table="_01personnel" data-field="x_Per_WorkDate" name="x_Per_WorkDate" id="x_Per_WorkDate" placeholder="<?= HtmlEncode($Page->Per_WorkDate->getPlaceHolder()) ?>" value="<?= $Page->Per_WorkDate->EditValue ?>"<?= $Page->Per_WorkDate->editAttributes() ?> aria-describedby="x_Per_WorkDate_help">
<?= $Page->Per_WorkDate->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->Per_WorkDate->getErrorMessage() ?></div>
<?php if (!$Page->Per_WorkDate->ReadOnly && !$Page->Per_WorkDate->Disabled && !isset($Page->Per_WorkDate->EditAttrs["readonly"]) && !isset($Page->Per_WorkDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["f_01personneladd", "datetimepicker"], function() {
    ew.createDateTimePicker("f_01personneladd", "x_Per_WorkDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->Per_Born->Visible) { // Per_Born ?>
    <div id="r_Per_Born" class="form-group row">
        <label id="elh__01personnel_Per_Born" for="x_Per_Born" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Per_Born->caption() ?><?= $Page->Per_Born->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->Per_Born->cellAttributes() ?>>
<span id="el__01personnel_Per_Born">
<input type="<?= $Page->Per_Born->getInputTextType() ?>" data-table="_01personnel" data-field="x_Per_Born" name="x_Per_Born" id="x_Per_Born" placeholder="<?= HtmlEncode($Page->Per_Born->getPlaceHolder()) ?>" value="<?= $Page->Per_Born->EditValue ?>"<?= $Page->Per_Born->editAttributes() ?> aria-describedby="x_Per_Born_help">
<?= $Page->Per_Born->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->Per_Born->getErrorMessage() ?></div>
<?php if (!$Page->Per_Born->ReadOnly && !$Page->Per_Born->Disabled && !isset($Page->Per_Born->EditAttrs["readonly"]) && !isset($Page->Per_Born->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["f_01personneladd", "datetimepicker"], function() {
    ew.createDateTimePicker("f_01personneladd", "x_Per_Born", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->Per_Nationality->Visible) { // Per_Nationality ?>
    <div id="r_Per_Nationality" class="form-group row">
        <label id="elh__01personnel_Per_Nationality" for="x_Per_Nationality" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Per_Nationality->caption() ?><?= $Page->Per_Nationality->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->Per_Nationality->cellAttributes() ?>>
<span id="el__01personnel_Per_Nationality">
    <select
        id="x_Per_Nationality"
        name="x_Per_Nationality"
        class="form-control ew-select<?= $Page->Per_Nationality->isInvalidClass() ?>"
        data-select2-id="_01personnel_x_Per_Nationality"
        data-table="_01personnel"
        data-field="x_Per_Nationality"
        data-value-separator="<?= $Page->Per_Nationality->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->Per_Nationality->getPlaceHolder()) ?>"
        <?= $Page->Per_Nationality->editAttributes() ?>>
        <?= $Page->Per_Nationality->selectOptionListHtml("x_Per_Nationality") ?>
    </select>
    <?= $Page->Per_Nationality->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->Per_Nationality->getErrorMessage() ?></div>
<?= $Page->Per_Nationality->Lookup->getParamTag($Page, "p_x_Per_Nationality") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='_01personnel_x_Per_Nationality']"),
        options = { name: "x_Per_Nationality", selectId: "_01personnel_x_Per_Nationality", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables._01personnel.fields.Per_Nationality.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->Per_Religion->Visible) { // Per_Religion ?>
    <div id="r_Per_Religion" class="form-group row">
        <label id="elh__01personnel_Per_Religion" for="x_Per_Religion" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Per_Religion->caption() ?><?= $Page->Per_Religion->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->Per_Religion->cellAttributes() ?>>
<span id="el__01personnel_Per_Religion">
    <select
        id="x_Per_Religion"
        name="x_Per_Religion"
        class="form-control ew-select<?= $Page->Per_Religion->isInvalidClass() ?>"
        data-select2-id="_01personnel_x_Per_Religion"
        data-table="_01personnel"
        data-field="x_Per_Religion"
        data-value-separator="<?= $Page->Per_Religion->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->Per_Religion->getPlaceHolder()) ?>"
        <?= $Page->Per_Religion->editAttributes() ?>>
        <?= $Page->Per_Religion->selectOptionListHtml("x_Per_Religion") ?>
    </select>
    <?= $Page->Per_Religion->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->Per_Religion->getErrorMessage() ?></div>
<?= $Page->Per_Religion->Lookup->getParamTag($Page, "p_x_Per_Religion") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='_01personnel_x_Per_Religion']"),
        options = { name: "x_Per_Religion", selectId: "_01personnel_x_Per_Religion", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables._01personnel.fields.Per_Religion.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->Per_IdCard->Visible) { // Per_IdCard ?>
    <div id="r_Per_IdCard" class="form-group row">
        <label id="elh__01personnel_Per_IdCard" for="x_Per_IdCard" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Per_IdCard->caption() ?><?= $Page->Per_IdCard->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->Per_IdCard->cellAttributes() ?>>
<span id="el__01personnel_Per_IdCard">
<input type="<?= $Page->Per_IdCard->getInputTextType() ?>" data-table="_01personnel" data-field="x_Per_IdCard" name="x_Per_IdCard" id="x_Per_IdCard" size="30" maxlength="13" placeholder="<?= HtmlEncode($Page->Per_IdCard->getPlaceHolder()) ?>" value="<?= $Page->Per_IdCard->EditValue ?>"<?= $Page->Per_IdCard->editAttributes() ?> aria-describedby="x_Per_IdCard_help">
<?= $Page->Per_IdCard->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->Per_IdCard->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->Per_WorkStatus->Visible) { // Per_WorkStatus ?>
    <div id="r_Per_WorkStatus" class="form-group row">
        <label id="elh__01personnel_Per_WorkStatus" for="x_Per_WorkStatus" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Per_WorkStatus->caption() ?><?= $Page->Per_WorkStatus->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->Per_WorkStatus->cellAttributes() ?>>
<span id="el__01personnel_Per_WorkStatus">
    <select
        id="x_Per_WorkStatus"
        name="x_Per_WorkStatus"
        class="form-control ew-select<?= $Page->Per_WorkStatus->isInvalidClass() ?>"
        data-select2-id="_01personnel_x_Per_WorkStatus"
        data-table="_01personnel"
        data-field="x_Per_WorkStatus"
        data-value-separator="<?= $Page->Per_WorkStatus->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->Per_WorkStatus->getPlaceHolder()) ?>"
        <?= $Page->Per_WorkStatus->editAttributes() ?>>
        <?= $Page->Per_WorkStatus->selectOptionListHtml("x_Per_WorkStatus") ?>
    </select>
    <?= $Page->Per_WorkStatus->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->Per_WorkStatus->getErrorMessage() ?></div>
<?= $Page->Per_WorkStatus->Lookup->getParamTag($Page, "p_x_Per_WorkStatus") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='_01personnel_x_Per_WorkStatus']"),
        options = { name: "x_Per_WorkStatus", selectId: "_01personnel_x_Per_WorkStatus", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables._01personnel.fields.Per_WorkStatus.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->Per_Phone->Visible) { // Per_Phone ?>
    <div id="r_Per_Phone" class="form-group row">
        <label id="elh__01personnel_Per_Phone" for="x_Per_Phone" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Per_Phone->caption() ?><?= $Page->Per_Phone->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->Per_Phone->cellAttributes() ?>>
<span id="el__01personnel_Per_Phone">
<input type="<?= $Page->Per_Phone->getInputTextType() ?>" data-table="_01personnel" data-field="x_Per_Phone" name="x_Per_Phone" id="x_Per_Phone" size="30" maxlength="10" placeholder="<?= HtmlEncode($Page->Per_Phone->getPlaceHolder()) ?>" value="<?= $Page->Per_Phone->EditValue ?>"<?= $Page->Per_Phone->editAttributes() ?> aria-describedby="x_Per_Phone_help">
<?= $Page->Per_Phone->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->Per_Phone->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->Per_UPEmail->Visible) { // Per_UPEmail ?>
    <div id="r_Per_UPEmail" class="form-group row">
        <label id="elh__01personnel_Per_UPEmail" for="x_Per_UPEmail" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Per_UPEmail->caption() ?><?= $Page->Per_UPEmail->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->Per_UPEmail->cellAttributes() ?>>
<span id="el__01personnel_Per_UPEmail">
<input type="<?= $Page->Per_UPEmail->getInputTextType() ?>" data-table="_01personnel" data-field="x_Per_UPEmail" name="x_Per_UPEmail" id="x_Per_UPEmail" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->Per_UPEmail->getPlaceHolder()) ?>" value="<?= $Page->Per_UPEmail->EditValue ?>"<?= $Page->Per_UPEmail->editAttributes() ?> aria-describedby="x_Per_UPEmail_help">
<?= $Page->Per_UPEmail->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->Per_UPEmail->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->Per_Email->Visible) { // Per_Email ?>
    <div id="r_Per_Email" class="form-group row">
        <label id="elh__01personnel_Per_Email" for="x_Per_Email" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Per_Email->caption() ?><?= $Page->Per_Email->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->Per_Email->cellAttributes() ?>>
<span id="el__01personnel_Per_Email">
<input type="<?= $Page->Per_Email->getInputTextType() ?>" data-table="_01personnel" data-field="x_Per_Email" name="x_Per_Email" id="x_Per_Email" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->Per_Email->getPlaceHolder()) ?>" value="<?= $Page->Per_Email->EditValue ?>"<?= $Page->Per_Email->editAttributes() ?> aria-describedby="x_Per_Email_help">
<?= $Page->Per_Email->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->Per_Email->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->Per_Address->Visible) { // Per_Address ?>
    <div id="r_Per_Address" class="form-group row">
        <label id="elh__01personnel_Per_Address" for="x_Per_Address" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Per_Address->caption() ?><?= $Page->Per_Address->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->Per_Address->cellAttributes() ?>>
<span id="el__01personnel_Per_Address">
<textarea data-table="_01personnel" data-field="x_Per_Address" name="x_Per_Address" id="x_Per_Address" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->Per_Address->getPlaceHolder()) ?>"<?= $Page->Per_Address->editAttributes() ?> aria-describedby="x_Per_Address_help"><?= $Page->Per_Address->EditValue ?></textarea>
<?= $Page->Per_Address->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->Per_Address->getErrorMessage() ?></div>
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
    ew.addEventHandlers("_01personnel");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
