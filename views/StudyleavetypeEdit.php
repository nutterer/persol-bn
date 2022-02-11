<?php

namespace PHPMaker2021\upPersonnelv2;

// Page object
$StudyleavetypeEdit = &$Page;
?>
<script>
if (!ew.vars.tables.studyleavetype) ew.vars.tables.studyleavetype = <?= JsonEncode(GetClientVar("tables", "studyleavetype")) ?>;
var currentForm, currentPageID;
var fstudyleavetypeedit;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "edit";
    fstudyleavetypeedit = currentForm = new ew.Form("fstudyleavetypeedit", "edit");

    // Add fields
    var fields = ew.vars.tables.studyleavetype.fields;
    fstudyleavetypeedit.addFields([
        ["StudyLeaveType_Id", [fields.StudyLeaveType_Id.required ? ew.Validators.required(fields.StudyLeaveType_Id.caption) : null], fields.StudyLeaveType_Id.isInvalid],
        ["StudyLeaveType_Name", [fields.StudyLeaveType_Name.required ? ew.Validators.required(fields.StudyLeaveType_Name.caption) : null], fields.StudyLeaveType_Name.isInvalid],
        ["StudyLeaveType__Institution", [fields.StudyLeaveType__Institution.required ? ew.Validators.required(fields.StudyLeaveType__Institution.caption) : null], fields.StudyLeaveType__Institution.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fstudyleavetypeedit,
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
    fstudyleavetypeedit.validate = function () {
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
    fstudyleavetypeedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fstudyleavetypeedit.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    loadjs.done("fstudyleavetypeedit");
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
<form name="fstudyleavetypeedit" id="fstudyleavetypeedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl() ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="studyleavetype">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->StudyLeaveType_Id->Visible) { // StudyLeaveType_Id ?>
    <div id="r_StudyLeaveType_Id" class="form-group row">
        <label id="elh_studyleavetype_StudyLeaveType_Id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->StudyLeaveType_Id->caption() ?><?= $Page->StudyLeaveType_Id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->StudyLeaveType_Id->cellAttributes() ?>>
<span id="el_studyleavetype_StudyLeaveType_Id">
<span<?= $Page->StudyLeaveType_Id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->StudyLeaveType_Id->getDisplayValue($Page->StudyLeaveType_Id->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="studyleavetype" data-field="x_StudyLeaveType_Id" data-hidden="1" name="x_StudyLeaveType_Id" id="x_StudyLeaveType_Id" value="<?= HtmlEncode($Page->StudyLeaveType_Id->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->StudyLeaveType_Name->Visible) { // StudyLeaveType_Name ?>
    <div id="r_StudyLeaveType_Name" class="form-group row">
        <label id="elh_studyleavetype_StudyLeaveType_Name" for="x_StudyLeaveType_Name" class="<?= $Page->LeftColumnClass ?>"><?= $Page->StudyLeaveType_Name->caption() ?><?= $Page->StudyLeaveType_Name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->StudyLeaveType_Name->cellAttributes() ?>>
<span id="el_studyleavetype_StudyLeaveType_Name">
<input type="<?= $Page->StudyLeaveType_Name->getInputTextType() ?>" data-table="studyleavetype" data-field="x_StudyLeaveType_Name" name="x_StudyLeaveType_Name" id="x_StudyLeaveType_Name" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->StudyLeaveType_Name->getPlaceHolder()) ?>" value="<?= $Page->StudyLeaveType_Name->EditValue ?>"<?= $Page->StudyLeaveType_Name->editAttributes() ?> aria-describedby="x_StudyLeaveType_Name_help">
<?= $Page->StudyLeaveType_Name->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->StudyLeaveType_Name->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->StudyLeaveType__Institution->Visible) { // StudyLeaveType_ Institution ?>
    <div id="r_StudyLeaveType__Institution" class="form-group row">
        <label id="elh_studyleavetype_StudyLeaveType__Institution" for="x_StudyLeaveType__Institution" class="<?= $Page->LeftColumnClass ?>"><?= $Page->StudyLeaveType__Institution->caption() ?><?= $Page->StudyLeaveType__Institution->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->StudyLeaveType__Institution->cellAttributes() ?>>
<span id="el_studyleavetype_StudyLeaveType__Institution">
<textarea data-table="studyleavetype" data-field="x_StudyLeaveType__Institution" name="x_StudyLeaveType__Institution" id="x_StudyLeaveType__Institution" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->StudyLeaveType__Institution->getPlaceHolder()) ?>"<?= $Page->StudyLeaveType__Institution->editAttributes() ?> aria-describedby="x_StudyLeaveType__Institution_help"><?= $Page->StudyLeaveType__Institution->EditValue ?></textarea>
<?= $Page->StudyLeaveType__Institution->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->StudyLeaveType__Institution->getErrorMessage() ?></div>
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
    ew.addEventHandlers("studyleavetype");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
