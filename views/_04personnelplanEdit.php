<?php

namespace PHPMaker2021\upPersonnelv2;

// Page object
$_04personnelplanEdit = &$Page;
?>
<script>
if (!ew.vars.tables._04personnelplan) ew.vars.tables._04personnelplan = <?= JsonEncode(GetClientVar("tables", "_04personnelplan")) ?>;
var currentForm, currentPageID;
var f_04personnelplanedit;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "edit";
    f_04personnelplanedit = currentForm = new ew.Form("f_04personnelplanedit", "edit");

    // Add fields
    var fields = ew.vars.tables._04personnelplan.fields;
    f_04personnelplanedit.addFields([
        ["Plan_Id", [fields.Plan_Id.required ? ew.Validators.required(fields.Plan_Id.caption) : null], fields.Plan_Id.isInvalid],
        ["Plan_Year", [fields.Plan_Year.required ? ew.Validators.required(fields.Plan_Year.caption) : null], fields.Plan_Year.isInvalid],
        ["Plan_File", [fields.Plan_File.required ? ew.Validators.required(fields.Plan_File.caption) : null], fields.Plan_File.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = f_04personnelplanedit,
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
    f_04personnelplanedit.validate = function () {
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
    f_04personnelplanedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    f_04personnelplanedit.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    loadjs.done("f_04personnelplanedit");
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
<form name="f_04personnelplanedit" id="f_04personnelplanedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl() ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="_04personnelplan">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->Plan_Id->Visible) { // Plan_Id ?>
    <div id="r_Plan_Id" class="form-group row">
        <label id="elh__04personnelplan_Plan_Id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Plan_Id->caption() ?><?= $Page->Plan_Id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->Plan_Id->cellAttributes() ?>>
<span id="el__04personnelplan_Plan_Id">
<span<?= $Page->Plan_Id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->Plan_Id->getDisplayValue($Page->Plan_Id->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="_04personnelplan" data-field="x_Plan_Id" data-hidden="1" name="x_Plan_Id" id="x_Plan_Id" value="<?= HtmlEncode($Page->Plan_Id->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->Plan_Year->Visible) { // Plan_Year ?>
    <div id="r_Plan_Year" class="form-group row">
        <label id="elh__04personnelplan_Plan_Year" for="x_Plan_Year" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Plan_Year->caption() ?><?= $Page->Plan_Year->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->Plan_Year->cellAttributes() ?>>
<span id="el__04personnelplan_Plan_Year">
<input type="<?= $Page->Plan_Year->getInputTextType() ?>" data-table="_04personnelplan" data-field="x_Plan_Year" name="x_Plan_Year" id="x_Plan_Year" size="30" maxlength="4" placeholder="<?= HtmlEncode($Page->Plan_Year->getPlaceHolder()) ?>" value="<?= $Page->Plan_Year->EditValue ?>"<?= $Page->Plan_Year->editAttributes() ?> aria-describedby="x_Plan_Year_help">
<?= $Page->Plan_Year->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->Plan_Year->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->Plan_File->Visible) { // Plan_File ?>
    <div id="r_Plan_File" class="form-group row">
        <label id="elh__04personnelplan_Plan_File" for="x_Plan_File" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Plan_File->caption() ?><?= $Page->Plan_File->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->Plan_File->cellAttributes() ?>>
<span id="el__04personnelplan_Plan_File">
<textarea data-table="_04personnelplan" data-field="x_Plan_File" name="x_Plan_File" id="x_Plan_File" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->Plan_File->getPlaceHolder()) ?>"<?= $Page->Plan_File->editAttributes() ?> aria-describedby="x_Plan_File_help"><?= $Page->Plan_File->EditValue ?></textarea>
<?= $Page->Plan_File->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->Plan_File->getErrorMessage() ?></div>
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
    ew.addEventHandlers("_04personnelplan");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
