<?php

namespace PHPMaker2021\upPersonnelv2;

// Page object
$GradAdmissionAdd = &$Page;
?>
<script>
if (!ew.vars.tables.grad_admission) ew.vars.tables.grad_admission = <?= JsonEncode(GetClientVar("tables", "grad_admission")) ?>;
var currentForm, currentPageID;
var fgrad_admissionadd;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "add";
    fgrad_admissionadd = currentForm = new ew.Form("fgrad_admissionadd", "add");

    // Add fields
    var fields = ew.vars.tables.grad_admission.fields;
    fgrad_admissionadd.addFields([
        ["Grad_Admission_name", [fields.Grad_Admission_name.required ? ew.Validators.required(fields.Grad_Admission_name.caption) : null], fields.Grad_Admission_name.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fgrad_admissionadd,
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
    fgrad_admissionadd.validate = function () {
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
    fgrad_admissionadd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fgrad_admissionadd.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    loadjs.done("fgrad_admissionadd");
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
<form name="fgrad_admissionadd" id="fgrad_admissionadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl() ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="grad_admission">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->Grad_Admission_name->Visible) { // Grad_Admission_name ?>
    <div id="r_Grad_Admission_name" class="form-group row">
        <label id="elh_grad_admission_Grad_Admission_name" for="x_Grad_Admission_name" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Grad_Admission_name->caption() ?><?= $Page->Grad_Admission_name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->Grad_Admission_name->cellAttributes() ?>>
<span id="el_grad_admission_Grad_Admission_name">
<textarea data-table="grad_admission" data-field="x_Grad_Admission_name" name="x_Grad_Admission_name" id="x_Grad_Admission_name" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->Grad_Admission_name->getPlaceHolder()) ?>"<?= $Page->Grad_Admission_name->editAttributes() ?> aria-describedby="x_Grad_Admission_name_help"><?= $Page->Grad_Admission_name->EditValue ?></textarea>
<?= $Page->Grad_Admission_name->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->Grad_Admission_name->getErrorMessage() ?></div>
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
    ew.addEventHandlers("grad_admission");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
