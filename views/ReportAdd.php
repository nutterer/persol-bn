<?php

namespace PHPMaker2021\upPersonnel;

// Page object
$ReportAdd = &$Page;
?>
<script>
if (!ew.vars.tables.report) ew.vars.tables.report = <?= JsonEncode(GetClientVar("tables", "report")) ?>;
var currentForm, currentPageID;
var freportadd;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "add";
    freportadd = currentForm = new ew.Form("freportadd", "add");

    // Add fields
    var fields = ew.vars.tables.report.fields;
    freportadd.addFields([
        ["Report_Year", [fields.Report_Year.required ? ew.Validators.required(fields.Report_Year.caption) : null], fields.Report_Year.isInvalid],
        ["Report_File", [fields.Report_File.required ? ew.Validators.fileRequired(fields.Report_File.caption) : null], fields.Report_File.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = freportadd,
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
    freportadd.validate = function () {
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
    freportadd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    freportadd.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    loadjs.done("freportadd");
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
<form name="freportadd" id="freportadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl() ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="report">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->Report_Year->Visible) { // Report_Year ?>
    <div id="r_Report_Year" class="form-group row">
        <label id="elh_report_Report_Year" for="x_Report_Year" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Report_Year->caption() ?><?= $Page->Report_Year->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->Report_Year->cellAttributes() ?>>
<span id="el_report_Report_Year">
<input type="<?= $Page->Report_Year->getInputTextType() ?>" data-table="report" data-field="x_Report_Year" name="x_Report_Year" id="x_Report_Year" size="30" maxlength="4" placeholder="<?= HtmlEncode($Page->Report_Year->getPlaceHolder()) ?>" value="<?= $Page->Report_Year->EditValue ?>"<?= $Page->Report_Year->editAttributes() ?> aria-describedby="x_Report_Year_help">
<?= $Page->Report_Year->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->Report_Year->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->Report_File->Visible) { // Report_File ?>
    <div id="r_Report_File" class="form-group row">
        <label id="elh_report_Report_File" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Report_File->caption() ?><?= $Page->Report_File->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->Report_File->cellAttributes() ?>>
<span id="el_report_Report_File">
<div id="fd_x_Report_File">
<div class="input-group">
    <div class="custom-file">
        <input type="file" class="custom-file-input" title="<?= $Page->Report_File->title() ?>" data-table="report" data-field="x_Report_File" name="x_Report_File" id="x_Report_File" lang="<?= CurrentLanguageID() ?>"<?= $Page->Report_File->editAttributes() ?><?= ($Page->Report_File->ReadOnly || $Page->Report_File->Disabled) ? " disabled" : "" ?> aria-describedby="x_Report_File_help">
        <label class="custom-file-label ew-file-label" for="x_Report_File"><?= $Language->phrase("ChooseFile") ?></label>
    </div>
</div>
<?= $Page->Report_File->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->Report_File->getErrorMessage() ?></div>
<input type="hidden" name="fn_x_Report_File" id= "fn_x_Report_File" value="<?= $Page->Report_File->Upload->FileName ?>">
<input type="hidden" name="fa_x_Report_File" id= "fa_x_Report_File" value="0">
<input type="hidden" name="fs_x_Report_File" id= "fs_x_Report_File" value="100">
<input type="hidden" name="fx_x_Report_File" id= "fx_x_Report_File" value="<?= $Page->Report_File->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_Report_File" id= "fm_x_Report_File" value="<?= $Page->Report_File->UploadMaxFileSize ?>">
</div>
<table id="ft_x_Report_File" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
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
    ew.addEventHandlers("report");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
