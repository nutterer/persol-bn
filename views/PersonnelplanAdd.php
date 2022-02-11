<?php

namespace PHPMaker2021\upPersonnel;

// Page object
$PersonnelplanAdd = &$Page;
?>
<script>
if (!ew.vars.tables.personnelplan) ew.vars.tables.personnelplan = <?= JsonEncode(GetClientVar("tables", "personnelplan")) ?>;
var currentForm, currentPageID;
var fpersonnelplanadd;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "add";
    fpersonnelplanadd = currentForm = new ew.Form("fpersonnelplanadd", "add");

    // Add fields
    var fields = ew.vars.tables.personnelplan.fields;
    fpersonnelplanadd.addFields([
        ["Plan_Year", [fields.Plan_Year.required ? ew.Validators.required(fields.Plan_Year.caption) : null], fields.Plan_Year.isInvalid],
        ["Plan_File", [fields.Plan_File.required ? ew.Validators.fileRequired(fields.Plan_File.caption) : null], fields.Plan_File.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fpersonnelplanadd,
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
    fpersonnelplanadd.validate = function () {
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
    fpersonnelplanadd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fpersonnelplanadd.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    loadjs.done("fpersonnelplanadd");
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
<form name="fpersonnelplanadd" id="fpersonnelplanadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl() ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="personnelplan">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->Plan_Year->Visible) { // Plan_Year ?>
    <div id="r_Plan_Year" class="form-group row">
        <label id="elh_personnelplan_Plan_Year" for="x_Plan_Year" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Plan_Year->caption() ?><?= $Page->Plan_Year->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->Plan_Year->cellAttributes() ?>>
<span id="el_personnelplan_Plan_Year">
<input type="<?= $Page->Plan_Year->getInputTextType() ?>" data-table="personnelplan" data-field="x_Plan_Year" name="x_Plan_Year" id="x_Plan_Year" size="30" maxlength="4" placeholder="<?= HtmlEncode($Page->Plan_Year->getPlaceHolder()) ?>" value="<?= $Page->Plan_Year->EditValue ?>"<?= $Page->Plan_Year->editAttributes() ?> aria-describedby="x_Plan_Year_help">
<?= $Page->Plan_Year->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->Plan_Year->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->Plan_File->Visible) { // Plan_File ?>
    <div id="r_Plan_File" class="form-group row">
        <label id="elh_personnelplan_Plan_File" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Plan_File->caption() ?><?= $Page->Plan_File->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->Plan_File->cellAttributes() ?>>
<span id="el_personnelplan_Plan_File">
<div id="fd_x_Plan_File">
<div class="input-group">
    <div class="custom-file">
        <input type="file" class="custom-file-input" title="<?= $Page->Plan_File->title() ?>" data-table="personnelplan" data-field="x_Plan_File" name="x_Plan_File" id="x_Plan_File" lang="<?= CurrentLanguageID() ?>"<?= $Page->Plan_File->editAttributes() ?><?= ($Page->Plan_File->ReadOnly || $Page->Plan_File->Disabled) ? " disabled" : "" ?> aria-describedby="x_Plan_File_help">
        <label class="custom-file-label ew-file-label" for="x_Plan_File"><?= $Language->phrase("ChooseFile") ?></label>
    </div>
</div>
<?= $Page->Plan_File->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->Plan_File->getErrorMessage() ?></div>
<input type="hidden" name="fn_x_Plan_File" id= "fn_x_Plan_File" value="<?= $Page->Plan_File->Upload->FileName ?>">
<input type="hidden" name="fa_x_Plan_File" id= "fa_x_Plan_File" value="0">
<input type="hidden" name="fs_x_Plan_File" id= "fs_x_Plan_File" value="256">
<input type="hidden" name="fx_x_Plan_File" id= "fx_x_Plan_File" value="<?= $Page->Plan_File->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_Plan_File" id= "fm_x_Plan_File" value="<?= $Page->Plan_File->UploadMaxFileSize ?>">
</div>
<table id="ft_x_Plan_File" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
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
    ew.addEventHandlers("personnelplan");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
