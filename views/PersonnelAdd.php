<?php

namespace PHPMaker2021\upPersonnel;

// Page object
$PersonnelAdd = &$Page;
?>
<script>
if (!ew.vars.tables.personnel) ew.vars.tables.personnel = <?= JsonEncode(GetClientVar("tables", "personnel")) ?>;
var currentForm, currentPageID;
var fpersonneladd;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "add";
    fpersonneladd = currentForm = new ew.Form("fpersonneladd", "add");

    // Add fields
    var fields = ew.vars.tables.personnel.fields;
    fpersonneladd.addFields([
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
        ["Per_Academic", [fields.Per_Academic.required ? ew.Validators.required(fields.Per_Academic.caption) : null], fields.Per_Academic.isInvalid],
        ["Per_Administrative", [fields.Per_Administrative.required ? ew.Validators.required(fields.Per_Administrative.caption) : null], fields.Per_Administrative.isInvalid],
        ["Per_WorDateStart", [fields.Per_WorDateStart.required ? ew.Validators.required(fields.Per_WorDateStart.caption) : null, ew.Validators.datetime(0)], fields.Per_WorDateStart.isInvalid],
        ["Per_WorkDate", [fields.Per_WorkDate.required ? ew.Validators.required(fields.Per_WorkDate.caption) : null, ew.Validators.datetime(0)], fields.Per_WorkDate.isInvalid],
        ["Per_WorkStatus", [fields.Per_WorkStatus.required ? ew.Validators.required(fields.Per_WorkStatus.caption) : null], fields.Per_WorkStatus.isInvalid],
        ["Per_Born", [fields.Per_Born.required ? ew.Validators.required(fields.Per_Born.caption) : null, ew.Validators.datetime(0)], fields.Per_Born.isInvalid],
        ["Per_Nationality", [fields.Per_Nationality.required ? ew.Validators.required(fields.Per_Nationality.caption) : null], fields.Per_Nationality.isInvalid],
        ["Per_Religion", [fields.Per_Religion.required ? ew.Validators.required(fields.Per_Religion.caption) : null], fields.Per_Religion.isInvalid],
        ["Per_IdCard", [fields.Per_IdCard.required ? ew.Validators.required(fields.Per_IdCard.caption) : null], fields.Per_IdCard.isInvalid],
        ["Per_Phone", [fields.Per_Phone.required ? ew.Validators.required(fields.Per_Phone.caption) : null], fields.Per_Phone.isInvalid],
        ["Per_UPEmail", [fields.Per_UPEmail.required ? ew.Validators.required(fields.Per_UPEmail.caption) : null], fields.Per_UPEmail.isInvalid],
        ["Per_Email", [fields.Per_Email.required ? ew.Validators.required(fields.Per_Email.caption) : null], fields.Per_Email.isInvalid],
        ["Per_Address", [fields.Per_Address.required ? ew.Validators.required(fields.Per_Address.caption) : null], fields.Per_Address.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fpersonneladd,
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
    fpersonneladd.validate = function () {
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
    fpersonneladd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fpersonneladd.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    loadjs.done("fpersonneladd");
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
<form name="fpersonneladd" id="fpersonneladd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl() ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="personnel">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->Per_Id->Visible) { // Per_Id ?>
    <div id="r_Per_Id" class="form-group row">
        <label id="elh_personnel_Per_Id" for="x_Per_Id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Per_Id->caption() ?><?= $Page->Per_Id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->Per_Id->cellAttributes() ?>>
<span id="el_personnel_Per_Id">
<input type="<?= $Page->Per_Id->getInputTextType() ?>" data-table="personnel" data-field="x_Per_Id" name="x_Per_Id" id="x_Per_Id" placeholder="<?= HtmlEncode($Page->Per_Id->getPlaceHolder()) ?>" value="<?= $Page->Per_Id->EditValue ?>"<?= $Page->Per_Id->editAttributes() ?> aria-describedby="x_Per_Id_help">
<?= $Page->Per_Id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->Per_Id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->Per_ThaiPre->Visible) { // Per_ThaiPre ?>
    <div id="r_Per_ThaiPre" class="form-group row">
        <label id="elh_personnel_Per_ThaiPre" for="x_Per_ThaiPre" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Per_ThaiPre->caption() ?><?= $Page->Per_ThaiPre->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->Per_ThaiPre->cellAttributes() ?>>
<span id="el_personnel_Per_ThaiPre">
<input type="<?= $Page->Per_ThaiPre->getInputTextType() ?>" data-table="personnel" data-field="x_Per_ThaiPre" name="x_Per_ThaiPre" id="x_Per_ThaiPre" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->Per_ThaiPre->getPlaceHolder()) ?>" value="<?= $Page->Per_ThaiPre->EditValue ?>"<?= $Page->Per_ThaiPre->editAttributes() ?> aria-describedby="x_Per_ThaiPre_help">
<?= $Page->Per_ThaiPre->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->Per_ThaiPre->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->Per_ThaiName->Visible) { // Per_ThaiName ?>
    <div id="r_Per_ThaiName" class="form-group row">
        <label id="elh_personnel_Per_ThaiName" for="x_Per_ThaiName" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Per_ThaiName->caption() ?><?= $Page->Per_ThaiName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->Per_ThaiName->cellAttributes() ?>>
<span id="el_personnel_Per_ThaiName">
<input type="<?= $Page->Per_ThaiName->getInputTextType() ?>" data-table="personnel" data-field="x_Per_ThaiName" name="x_Per_ThaiName" id="x_Per_ThaiName" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->Per_ThaiName->getPlaceHolder()) ?>" value="<?= $Page->Per_ThaiName->EditValue ?>"<?= $Page->Per_ThaiName->editAttributes() ?> aria-describedby="x_Per_ThaiName_help">
<?= $Page->Per_ThaiName->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->Per_ThaiName->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->Per_ThaiLastName->Visible) { // Per_ThaiLastName ?>
    <div id="r_Per_ThaiLastName" class="form-group row">
        <label id="elh_personnel_Per_ThaiLastName" for="x_Per_ThaiLastName" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Per_ThaiLastName->caption() ?><?= $Page->Per_ThaiLastName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->Per_ThaiLastName->cellAttributes() ?>>
<span id="el_personnel_Per_ThaiLastName">
<input type="<?= $Page->Per_ThaiLastName->getInputTextType() ?>" data-table="personnel" data-field="x_Per_ThaiLastName" name="x_Per_ThaiLastName" id="x_Per_ThaiLastName" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->Per_ThaiLastName->getPlaceHolder()) ?>" value="<?= $Page->Per_ThaiLastName->EditValue ?>"<?= $Page->Per_ThaiLastName->editAttributes() ?> aria-describedby="x_Per_ThaiLastName_help">
<?= $Page->Per_ThaiLastName->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->Per_ThaiLastName->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->Per_EngPre->Visible) { // Per_EngPre ?>
    <div id="r_Per_EngPre" class="form-group row">
        <label id="elh_personnel_Per_EngPre" for="x_Per_EngPre" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Per_EngPre->caption() ?><?= $Page->Per_EngPre->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->Per_EngPre->cellAttributes() ?>>
<span id="el_personnel_Per_EngPre">
<input type="<?= $Page->Per_EngPre->getInputTextType() ?>" data-table="personnel" data-field="x_Per_EngPre" name="x_Per_EngPre" id="x_Per_EngPre" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->Per_EngPre->getPlaceHolder()) ?>" value="<?= $Page->Per_EngPre->EditValue ?>"<?= $Page->Per_EngPre->editAttributes() ?> aria-describedby="x_Per_EngPre_help">
<?= $Page->Per_EngPre->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->Per_EngPre->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->Per_EngName->Visible) { // Per_EngName ?>
    <div id="r_Per_EngName" class="form-group row">
        <label id="elh_personnel_Per_EngName" for="x_Per_EngName" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Per_EngName->caption() ?><?= $Page->Per_EngName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->Per_EngName->cellAttributes() ?>>
<span id="el_personnel_Per_EngName">
<input type="<?= $Page->Per_EngName->getInputTextType() ?>" data-table="personnel" data-field="x_Per_EngName" name="x_Per_EngName" id="x_Per_EngName" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->Per_EngName->getPlaceHolder()) ?>" value="<?= $Page->Per_EngName->EditValue ?>"<?= $Page->Per_EngName->editAttributes() ?> aria-describedby="x_Per_EngName_help">
<?= $Page->Per_EngName->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->Per_EngName->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->Per_EngLastName->Visible) { // Per_EngLastName ?>
    <div id="r_Per_EngLastName" class="form-group row">
        <label id="elh_personnel_Per_EngLastName" for="x_Per_EngLastName" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Per_EngLastName->caption() ?><?= $Page->Per_EngLastName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->Per_EngLastName->cellAttributes() ?>>
<span id="el_personnel_Per_EngLastName">
<input type="<?= $Page->Per_EngLastName->getInputTextType() ?>" data-table="personnel" data-field="x_Per_EngLastName" name="x_Per_EngLastName" id="x_Per_EngLastName" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->Per_EngLastName->getPlaceHolder()) ?>" value="<?= $Page->Per_EngLastName->EditValue ?>"<?= $Page->Per_EngLastName->editAttributes() ?> aria-describedby="x_Per_EngLastName_help">
<?= $Page->Per_EngLastName->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->Per_EngLastName->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->Per_Type->Visible) { // Per_Type ?>
    <div id="r_Per_Type" class="form-group row">
        <label id="elh_personnel_Per_Type" for="x_Per_Type" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Per_Type->caption() ?><?= $Page->Per_Type->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->Per_Type->cellAttributes() ?>>
<span id="el_personnel_Per_Type">
<input type="<?= $Page->Per_Type->getInputTextType() ?>" data-table="personnel" data-field="x_Per_Type" name="x_Per_Type" id="x_Per_Type" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->Per_Type->getPlaceHolder()) ?>" value="<?= $Page->Per_Type->EditValue ?>"<?= $Page->Per_Type->editAttributes() ?> aria-describedby="x_Per_Type_help">
<?= $Page->Per_Type->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->Per_Type->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->Per_EmployeeType->Visible) { // Per_EmployeeType ?>
    <div id="r_Per_EmployeeType" class="form-group row">
        <label id="elh_personnel_Per_EmployeeType" for="x_Per_EmployeeType" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Per_EmployeeType->caption() ?><?= $Page->Per_EmployeeType->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->Per_EmployeeType->cellAttributes() ?>>
<span id="el_personnel_Per_EmployeeType">
<input type="<?= $Page->Per_EmployeeType->getInputTextType() ?>" data-table="personnel" data-field="x_Per_EmployeeType" name="x_Per_EmployeeType" id="x_Per_EmployeeType" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->Per_EmployeeType->getPlaceHolder()) ?>" value="<?= $Page->Per_EmployeeType->EditValue ?>"<?= $Page->Per_EmployeeType->editAttributes() ?> aria-describedby="x_Per_EmployeeType_help">
<?= $Page->Per_EmployeeType->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->Per_EmployeeType->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->Per_Position->Visible) { // Per_Position ?>
    <div id="r_Per_Position" class="form-group row">
        <label id="elh_personnel_Per_Position" for="x_Per_Position" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Per_Position->caption() ?><?= $Page->Per_Position->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->Per_Position->cellAttributes() ?>>
<span id="el_personnel_Per_Position">
<input type="<?= $Page->Per_Position->getInputTextType() ?>" data-table="personnel" data-field="x_Per_Position" name="x_Per_Position" id="x_Per_Position" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->Per_Position->getPlaceHolder()) ?>" value="<?= $Page->Per_Position->EditValue ?>"<?= $Page->Per_Position->editAttributes() ?> aria-describedby="x_Per_Position_help">
<?= $Page->Per_Position->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->Per_Position->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->Per_Academic->Visible) { // Per_Academic ?>
    <div id="r_Per_Academic" class="form-group row">
        <label id="elh_personnel_Per_Academic" for="x_Per_Academic" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Per_Academic->caption() ?><?= $Page->Per_Academic->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->Per_Academic->cellAttributes() ?>>
<span id="el_personnel_Per_Academic">
<input type="<?= $Page->Per_Academic->getInputTextType() ?>" data-table="personnel" data-field="x_Per_Academic" name="x_Per_Academic" id="x_Per_Academic" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->Per_Academic->getPlaceHolder()) ?>" value="<?= $Page->Per_Academic->EditValue ?>"<?= $Page->Per_Academic->editAttributes() ?> aria-describedby="x_Per_Academic_help">
<?= $Page->Per_Academic->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->Per_Academic->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->Per_Administrative->Visible) { // Per_Administrative ?>
    <div id="r_Per_Administrative" class="form-group row">
        <label id="elh_personnel_Per_Administrative" for="x_Per_Administrative" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Per_Administrative->caption() ?><?= $Page->Per_Administrative->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->Per_Administrative->cellAttributes() ?>>
<span id="el_personnel_Per_Administrative">
<input type="<?= $Page->Per_Administrative->getInputTextType() ?>" data-table="personnel" data-field="x_Per_Administrative" name="x_Per_Administrative" id="x_Per_Administrative" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->Per_Administrative->getPlaceHolder()) ?>" value="<?= $Page->Per_Administrative->EditValue ?>"<?= $Page->Per_Administrative->editAttributes() ?> aria-describedby="x_Per_Administrative_help">
<?= $Page->Per_Administrative->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->Per_Administrative->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->Per_WorDateStart->Visible) { // Per_WorDateStart ?>
    <div id="r_Per_WorDateStart" class="form-group row">
        <label id="elh_personnel_Per_WorDateStart" for="x_Per_WorDateStart" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Per_WorDateStart->caption() ?><?= $Page->Per_WorDateStart->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->Per_WorDateStart->cellAttributes() ?>>
<span id="el_personnel_Per_WorDateStart">
<input type="<?= $Page->Per_WorDateStart->getInputTextType() ?>" data-table="personnel" data-field="x_Per_WorDateStart" name="x_Per_WorDateStart" id="x_Per_WorDateStart" placeholder="<?= HtmlEncode($Page->Per_WorDateStart->getPlaceHolder()) ?>" value="<?= $Page->Per_WorDateStart->EditValue ?>"<?= $Page->Per_WorDateStart->editAttributes() ?> aria-describedby="x_Per_WorDateStart_help">
<?= $Page->Per_WorDateStart->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->Per_WorDateStart->getErrorMessage() ?></div>
<?php if (!$Page->Per_WorDateStart->ReadOnly && !$Page->Per_WorDateStart->Disabled && !isset($Page->Per_WorDateStart->EditAttrs["readonly"]) && !isset($Page->Per_WorDateStart->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fpersonneladd", "datetimepicker"], function() {
    ew.createDateTimePicker("fpersonneladd", "x_Per_WorDateStart", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->Per_WorkDate->Visible) { // Per_WorkDate ?>
    <div id="r_Per_WorkDate" class="form-group row">
        <label id="elh_personnel_Per_WorkDate" for="x_Per_WorkDate" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Per_WorkDate->caption() ?><?= $Page->Per_WorkDate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->Per_WorkDate->cellAttributes() ?>>
<span id="el_personnel_Per_WorkDate">
<input type="<?= $Page->Per_WorkDate->getInputTextType() ?>" data-table="personnel" data-field="x_Per_WorkDate" name="x_Per_WorkDate" id="x_Per_WorkDate" placeholder="<?= HtmlEncode($Page->Per_WorkDate->getPlaceHolder()) ?>" value="<?= $Page->Per_WorkDate->EditValue ?>"<?= $Page->Per_WorkDate->editAttributes() ?> aria-describedby="x_Per_WorkDate_help">
<?= $Page->Per_WorkDate->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->Per_WorkDate->getErrorMessage() ?></div>
<?php if (!$Page->Per_WorkDate->ReadOnly && !$Page->Per_WorkDate->Disabled && !isset($Page->Per_WorkDate->EditAttrs["readonly"]) && !isset($Page->Per_WorkDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fpersonneladd", "datetimepicker"], function() {
    ew.createDateTimePicker("fpersonneladd", "x_Per_WorkDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->Per_WorkStatus->Visible) { // Per_WorkStatus ?>
    <div id="r_Per_WorkStatus" class="form-group row">
        <label id="elh_personnel_Per_WorkStatus" for="x_Per_WorkStatus" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Per_WorkStatus->caption() ?><?= $Page->Per_WorkStatus->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->Per_WorkStatus->cellAttributes() ?>>
<span id="el_personnel_Per_WorkStatus">
<input type="<?= $Page->Per_WorkStatus->getInputTextType() ?>" data-table="personnel" data-field="x_Per_WorkStatus" name="x_Per_WorkStatus" id="x_Per_WorkStatus" size="30" maxlength="10" placeholder="<?= HtmlEncode($Page->Per_WorkStatus->getPlaceHolder()) ?>" value="<?= $Page->Per_WorkStatus->EditValue ?>"<?= $Page->Per_WorkStatus->editAttributes() ?> aria-describedby="x_Per_WorkStatus_help">
<?= $Page->Per_WorkStatus->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->Per_WorkStatus->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->Per_Born->Visible) { // Per_Born ?>
    <div id="r_Per_Born" class="form-group row">
        <label id="elh_personnel_Per_Born" for="x_Per_Born" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Per_Born->caption() ?><?= $Page->Per_Born->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->Per_Born->cellAttributes() ?>>
<span id="el_personnel_Per_Born">
<input type="<?= $Page->Per_Born->getInputTextType() ?>" data-table="personnel" data-field="x_Per_Born" name="x_Per_Born" id="x_Per_Born" placeholder="<?= HtmlEncode($Page->Per_Born->getPlaceHolder()) ?>" value="<?= $Page->Per_Born->EditValue ?>"<?= $Page->Per_Born->editAttributes() ?> aria-describedby="x_Per_Born_help">
<?= $Page->Per_Born->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->Per_Born->getErrorMessage() ?></div>
<?php if (!$Page->Per_Born->ReadOnly && !$Page->Per_Born->Disabled && !isset($Page->Per_Born->EditAttrs["readonly"]) && !isset($Page->Per_Born->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fpersonneladd", "datetimepicker"], function() {
    ew.createDateTimePicker("fpersonneladd", "x_Per_Born", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->Per_Nationality->Visible) { // Per_Nationality ?>
    <div id="r_Per_Nationality" class="form-group row">
        <label id="elh_personnel_Per_Nationality" for="x_Per_Nationality" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Per_Nationality->caption() ?><?= $Page->Per_Nationality->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->Per_Nationality->cellAttributes() ?>>
<span id="el_personnel_Per_Nationality">
<input type="<?= $Page->Per_Nationality->getInputTextType() ?>" data-table="personnel" data-field="x_Per_Nationality" name="x_Per_Nationality" id="x_Per_Nationality" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->Per_Nationality->getPlaceHolder()) ?>" value="<?= $Page->Per_Nationality->EditValue ?>"<?= $Page->Per_Nationality->editAttributes() ?> aria-describedby="x_Per_Nationality_help">
<?= $Page->Per_Nationality->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->Per_Nationality->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->Per_Religion->Visible) { // Per_Religion ?>
    <div id="r_Per_Religion" class="form-group row">
        <label id="elh_personnel_Per_Religion" for="x_Per_Religion" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Per_Religion->caption() ?><?= $Page->Per_Religion->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->Per_Religion->cellAttributes() ?>>
<span id="el_personnel_Per_Religion">
<input type="<?= $Page->Per_Religion->getInputTextType() ?>" data-table="personnel" data-field="x_Per_Religion" name="x_Per_Religion" id="x_Per_Religion" size="30" maxlength="20" placeholder="<?= HtmlEncode($Page->Per_Religion->getPlaceHolder()) ?>" value="<?= $Page->Per_Religion->EditValue ?>"<?= $Page->Per_Religion->editAttributes() ?> aria-describedby="x_Per_Religion_help">
<?= $Page->Per_Religion->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->Per_Religion->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->Per_IdCard->Visible) { // Per_IdCard ?>
    <div id="r_Per_IdCard" class="form-group row">
        <label id="elh_personnel_Per_IdCard" for="x_Per_IdCard" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Per_IdCard->caption() ?><?= $Page->Per_IdCard->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->Per_IdCard->cellAttributes() ?>>
<span id="el_personnel_Per_IdCard">
<input type="<?= $Page->Per_IdCard->getInputTextType() ?>" data-table="personnel" data-field="x_Per_IdCard" name="x_Per_IdCard" id="x_Per_IdCard" size="30" maxlength="13" placeholder="<?= HtmlEncode($Page->Per_IdCard->getPlaceHolder()) ?>" value="<?= $Page->Per_IdCard->EditValue ?>"<?= $Page->Per_IdCard->editAttributes() ?> aria-describedby="x_Per_IdCard_help">
<?= $Page->Per_IdCard->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->Per_IdCard->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->Per_Phone->Visible) { // Per_Phone ?>
    <div id="r_Per_Phone" class="form-group row">
        <label id="elh_personnel_Per_Phone" for="x_Per_Phone" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Per_Phone->caption() ?><?= $Page->Per_Phone->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->Per_Phone->cellAttributes() ?>>
<span id="el_personnel_Per_Phone">
<input type="<?= $Page->Per_Phone->getInputTextType() ?>" data-table="personnel" data-field="x_Per_Phone" name="x_Per_Phone" id="x_Per_Phone" size="30" maxlength="10" placeholder="<?= HtmlEncode($Page->Per_Phone->getPlaceHolder()) ?>" value="<?= $Page->Per_Phone->EditValue ?>"<?= $Page->Per_Phone->editAttributes() ?> aria-describedby="x_Per_Phone_help">
<?= $Page->Per_Phone->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->Per_Phone->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->Per_UPEmail->Visible) { // Per_UPEmail ?>
    <div id="r_Per_UPEmail" class="form-group row">
        <label id="elh_personnel_Per_UPEmail" for="x_Per_UPEmail" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Per_UPEmail->caption() ?><?= $Page->Per_UPEmail->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->Per_UPEmail->cellAttributes() ?>>
<span id="el_personnel_Per_UPEmail">
<input type="<?= $Page->Per_UPEmail->getInputTextType() ?>" data-table="personnel" data-field="x_Per_UPEmail" name="x_Per_UPEmail" id="x_Per_UPEmail" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->Per_UPEmail->getPlaceHolder()) ?>" value="<?= $Page->Per_UPEmail->EditValue ?>"<?= $Page->Per_UPEmail->editAttributes() ?> aria-describedby="x_Per_UPEmail_help">
<?= $Page->Per_UPEmail->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->Per_UPEmail->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->Per_Email->Visible) { // Per_Email ?>
    <div id="r_Per_Email" class="form-group row">
        <label id="elh_personnel_Per_Email" for="x_Per_Email" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Per_Email->caption() ?><?= $Page->Per_Email->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->Per_Email->cellAttributes() ?>>
<span id="el_personnel_Per_Email">
<input type="<?= $Page->Per_Email->getInputTextType() ?>" data-table="personnel" data-field="x_Per_Email" name="x_Per_Email" id="x_Per_Email" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->Per_Email->getPlaceHolder()) ?>" value="<?= $Page->Per_Email->EditValue ?>"<?= $Page->Per_Email->editAttributes() ?> aria-describedby="x_Per_Email_help">
<?= $Page->Per_Email->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->Per_Email->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->Per_Address->Visible) { // Per_Address ?>
    <div id="r_Per_Address" class="form-group row">
        <label id="elh_personnel_Per_Address" for="x_Per_Address" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Per_Address->caption() ?><?= $Page->Per_Address->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->Per_Address->cellAttributes() ?>>
<span id="el_personnel_Per_Address">
<input type="<?= $Page->Per_Address->getInputTextType() ?>" data-table="personnel" data-field="x_Per_Address" name="x_Per_Address" id="x_Per_Address" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->Per_Address->getPlaceHolder()) ?>" value="<?= $Page->Per_Address->EditValue ?>"<?= $Page->Per_Address->editAttributes() ?> aria-describedby="x_Per_Address_help">
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
    ew.addEventHandlers("personnel");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
