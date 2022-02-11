<?php

namespace PHPMaker2021\upPersonnelv2;

// Page object
$AcademicbookEdit = &$Page;
?>
<script>
if (!ew.vars.tables.academicbook) ew.vars.tables.academicbook = <?= JsonEncode(GetClientVar("tables", "academicbook")) ?>;
var currentForm, currentPageID;
var facademicbookedit;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "edit";
    facademicbookedit = currentForm = new ew.Form("facademicbookedit", "edit");

    // Add fields
    var fields = ew.vars.tables.academicbook.fields;
    facademicbookedit.addFields([
        ["Book_Id", [fields.Book_Id.required ? ew.Validators.required(fields.Book_Id.caption) : null], fields.Book_Id.isInvalid],
        ["Aca_Id", [fields.Aca_Id.required ? ew.Validators.required(fields.Aca_Id.caption) : null], fields.Aca_Id.isInvalid],
        ["Book_Type", [fields.Book_Type.required ? ew.Validators.required(fields.Book_Type.caption) : null], fields.Book_Type.isInvalid],
        ["Book_Cover", [fields.Book_Cover.required ? ew.Validators.fileRequired(fields.Book_Cover.caption) : null], fields.Book_Cover.isInvalid],
        ["Book_ISBN", [fields.Book_ISBN.required ? ew.Validators.required(fields.Book_ISBN.caption) : null], fields.Book_ISBN.isInvalid],
        ["Book_Patent", [fields.Book_Patent.required ? ew.Validators.required(fields.Book_Patent.caption) : null], fields.Book_Patent.isInvalid],
        ["Book_File", [fields.Book_File.required ? ew.Validators.fileRequired(fields.Book_File.caption) : null], fields.Book_File.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = facademicbookedit,
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
    facademicbookedit.validate = function () {
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
    facademicbookedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    facademicbookedit.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    facademicbookedit.lists.Aca_Id = <?= $Page->Aca_Id->toClientList($Page) ?>;
    facademicbookedit.lists.Book_Type = <?= $Page->Book_Type->toClientList($Page) ?>;
    loadjs.done("facademicbookedit");
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
<form name="facademicbookedit" id="facademicbookedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl() ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="academicbook">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->Book_Id->Visible) { // Book_Id ?>
    <div id="r_Book_Id" class="form-group row">
        <label id="elh_academicbook_Book_Id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Book_Id->caption() ?><?= $Page->Book_Id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->Book_Id->cellAttributes() ?>>
<span id="el_academicbook_Book_Id">
<span<?= $Page->Book_Id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->Book_Id->getDisplayValue($Page->Book_Id->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="academicbook" data-field="x_Book_Id" data-hidden="1" name="x_Book_Id" id="x_Book_Id" value="<?= HtmlEncode($Page->Book_Id->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->Aca_Id->Visible) { // Aca_Id ?>
    <div id="r_Aca_Id" class="form-group row">
        <label id="elh_academicbook_Aca_Id" for="x_Aca_Id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Aca_Id->caption() ?><?= $Page->Aca_Id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->Aca_Id->cellAttributes() ?>>
<span id="el_academicbook_Aca_Id">
    <select
        id="x_Aca_Id"
        name="x_Aca_Id"
        class="form-control ew-select<?= $Page->Aca_Id->isInvalidClass() ?>"
        data-select2-id="academicbook_x_Aca_Id"
        data-table="academicbook"
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
    var el = document.querySelector("select[data-select2-id='academicbook_x_Aca_Id']"),
        options = { name: "x_Aca_Id", selectId: "academicbook_x_Aca_Id", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.academicbook.fields.Aca_Id.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->Book_Type->Visible) { // Book_Type ?>
    <div id="r_Book_Type" class="form-group row">
        <label id="elh_academicbook_Book_Type" for="x_Book_Type" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Book_Type->caption() ?><?= $Page->Book_Type->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->Book_Type->cellAttributes() ?>>
<span id="el_academicbook_Book_Type">
    <select
        id="x_Book_Type"
        name="x_Book_Type"
        class="form-control ew-select<?= $Page->Book_Type->isInvalidClass() ?>"
        data-select2-id="academicbook_x_Book_Type"
        data-table="academicbook"
        data-field="x_Book_Type"
        data-value-separator="<?= $Page->Book_Type->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->Book_Type->getPlaceHolder()) ?>"
        <?= $Page->Book_Type->editAttributes() ?>>
        <?= $Page->Book_Type->selectOptionListHtml("x_Book_Type") ?>
    </select>
    <?= $Page->Book_Type->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->Book_Type->getErrorMessage() ?></div>
<?= $Page->Book_Type->Lookup->getParamTag($Page, "p_x_Book_Type") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='academicbook_x_Book_Type']"),
        options = { name: "x_Book_Type", selectId: "academicbook_x_Book_Type", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.academicbook.fields.Book_Type.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->Book_Cover->Visible) { // Book_Cover ?>
    <div id="r_Book_Cover" class="form-group row">
        <label id="elh_academicbook_Book_Cover" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Book_Cover->caption() ?><?= $Page->Book_Cover->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->Book_Cover->cellAttributes() ?>>
<span id="el_academicbook_Book_Cover">
<div id="fd_x_Book_Cover">
<div class="input-group">
    <div class="custom-file">
        <input type="file" class="custom-file-input" title="<?= $Page->Book_Cover->title() ?>" data-table="academicbook" data-field="x_Book_Cover" name="x_Book_Cover" id="x_Book_Cover" lang="<?= CurrentLanguageID() ?>"<?= $Page->Book_Cover->editAttributes() ?><?= ($Page->Book_Cover->ReadOnly || $Page->Book_Cover->Disabled) ? " disabled" : "" ?> aria-describedby="x_Book_Cover_help">
        <label class="custom-file-label ew-file-label" for="x_Book_Cover"><?= $Language->phrase("ChooseFile") ?></label>
    </div>
</div>
<?= $Page->Book_Cover->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->Book_Cover->getErrorMessage() ?></div>
<input type="hidden" name="fn_x_Book_Cover" id= "fn_x_Book_Cover" value="<?= $Page->Book_Cover->Upload->FileName ?>">
<input type="hidden" name="fa_x_Book_Cover" id= "fa_x_Book_Cover" value="<?= (Post("fa_x_Book_Cover") == "0") ? "0" : "1" ?>">
<input type="hidden" name="fs_x_Book_Cover" id= "fs_x_Book_Cover" value="100">
<input type="hidden" name="fx_x_Book_Cover" id= "fx_x_Book_Cover" value="<?= $Page->Book_Cover->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_Book_Cover" id= "fm_x_Book_Cover" value="<?= $Page->Book_Cover->UploadMaxFileSize ?>">
</div>
<table id="ft_x_Book_Cover" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->Book_ISBN->Visible) { // Book_ISBN ?>
    <div id="r_Book_ISBN" class="form-group row">
        <label id="elh_academicbook_Book_ISBN" for="x_Book_ISBN" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Book_ISBN->caption() ?><?= $Page->Book_ISBN->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->Book_ISBN->cellAttributes() ?>>
<span id="el_academicbook_Book_ISBN">
<input type="<?= $Page->Book_ISBN->getInputTextType() ?>" data-table="academicbook" data-field="x_Book_ISBN" name="x_Book_ISBN" id="x_Book_ISBN" size="30" maxlength="13" placeholder="<?= HtmlEncode($Page->Book_ISBN->getPlaceHolder()) ?>" value="<?= $Page->Book_ISBN->EditValue ?>"<?= $Page->Book_ISBN->editAttributes() ?> aria-describedby="x_Book_ISBN_help">
<?= $Page->Book_ISBN->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->Book_ISBN->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->Book_Patent->Visible) { // Book_Patent ?>
    <div id="r_Book_Patent" class="form-group row">
        <label id="elh_academicbook_Book_Patent" for="x_Book_Patent" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Book_Patent->caption() ?><?= $Page->Book_Patent->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->Book_Patent->cellAttributes() ?>>
<span id="el_academicbook_Book_Patent">
<input type="<?= $Page->Book_Patent->getInputTextType() ?>" data-table="academicbook" data-field="x_Book_Patent" name="x_Book_Patent" id="x_Book_Patent" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->Book_Patent->getPlaceHolder()) ?>" value="<?= $Page->Book_Patent->EditValue ?>"<?= $Page->Book_Patent->editAttributes() ?> aria-describedby="x_Book_Patent_help">
<?= $Page->Book_Patent->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->Book_Patent->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->Book_File->Visible) { // Book_File ?>
    <div id="r_Book_File" class="form-group row">
        <label id="elh_academicbook_Book_File" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Book_File->caption() ?><?= $Page->Book_File->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->Book_File->cellAttributes() ?>>
<span id="el_academicbook_Book_File">
<div id="fd_x_Book_File">
<div class="input-group">
    <div class="custom-file">
        <input type="file" class="custom-file-input" title="<?= $Page->Book_File->title() ?>" data-table="academicbook" data-field="x_Book_File" name="x_Book_File" id="x_Book_File" lang="<?= CurrentLanguageID() ?>"<?= $Page->Book_File->editAttributes() ?><?= ($Page->Book_File->ReadOnly || $Page->Book_File->Disabled) ? " disabled" : "" ?> aria-describedby="x_Book_File_help">
        <label class="custom-file-label ew-file-label" for="x_Book_File"><?= $Language->phrase("ChooseFile") ?></label>
    </div>
</div>
<?= $Page->Book_File->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->Book_File->getErrorMessage() ?></div>
<input type="hidden" name="fn_x_Book_File" id= "fn_x_Book_File" value="<?= $Page->Book_File->Upload->FileName ?>">
<input type="hidden" name="fa_x_Book_File" id= "fa_x_Book_File" value="<?= (Post("fa_x_Book_File") == "0") ? "0" : "1" ?>">
<input type="hidden" name="fs_x_Book_File" id= "fs_x_Book_File" value="100">
<input type="hidden" name="fx_x_Book_File" id= "fx_x_Book_File" value="<?= $Page->Book_File->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_Book_File" id= "fm_x_Book_File" value="<?= $Page->Book_File->UploadMaxFileSize ?>">
</div>
<table id="ft_x_Book_File" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
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
    ew.addEventHandlers("academicbook");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
