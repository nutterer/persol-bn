<?php

namespace PHPMaker2021\upPersonnelv2;

// Page object
$PerAcademicEdit = &$Page;
?>
<script>
if (!ew.vars.tables.per_academic) ew.vars.tables.per_academic = <?= JsonEncode(GetClientVar("tables", "per_academic")) ?>;
var currentForm, currentPageID;
var fper_academicedit;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "edit";
    fper_academicedit = currentForm = new ew.Form("fper_academicedit", "edit");

    // Add fields
    var fields = ew.vars.tables.per_academic.fields;
    fper_academicedit.addFields([
        ["Per_Academic_id", [fields.Per_Academic_id.required ? ew.Validators.required(fields.Per_Academic_id.caption) : null], fields.Per_Academic_id.isInvalid],
        ["Per_Academic_name", [fields.Per_Academic_name.required ? ew.Validators.required(fields.Per_Academic_name.caption) : null], fields.Per_Academic_name.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fper_academicedit,
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
    fper_academicedit.validate = function () {
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
    fper_academicedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fper_academicedit.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    loadjs.done("fper_academicedit");
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
<form name="fper_academicedit" id="fper_academicedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl() ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="per_academic">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->Per_Academic_id->Visible) { // Per_Academic_id ?>
    <div id="r_Per_Academic_id" class="form-group row">
        <label id="elh_per_academic_Per_Academic_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Per_Academic_id->caption() ?><?= $Page->Per_Academic_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->Per_Academic_id->cellAttributes() ?>>
<span id="el_per_academic_Per_Academic_id">
<span<?= $Page->Per_Academic_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->Per_Academic_id->getDisplayValue($Page->Per_Academic_id->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="per_academic" data-field="x_Per_Academic_id" data-hidden="1" name="x_Per_Academic_id" id="x_Per_Academic_id" value="<?= HtmlEncode($Page->Per_Academic_id->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->Per_Academic_name->Visible) { // Per_Academic_name ?>
    <div id="r_Per_Academic_name" class="form-group row">
        <label id="elh_per_academic_Per_Academic_name" for="x_Per_Academic_name" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Per_Academic_name->caption() ?><?= $Page->Per_Academic_name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->Per_Academic_name->cellAttributes() ?>>
<span id="el_per_academic_Per_Academic_name">
<textarea data-table="per_academic" data-field="x_Per_Academic_name" name="x_Per_Academic_name" id="x_Per_Academic_name" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->Per_Academic_name->getPlaceHolder()) ?>"<?= $Page->Per_Academic_name->editAttributes() ?> aria-describedby="x_Per_Academic_name_help"><?= $Page->Per_Academic_name->EditValue ?></textarea>
<?= $Page->Per_Academic_name->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->Per_Academic_name->getErrorMessage() ?></div>
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
    ew.addEventHandlers("per_academic");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
