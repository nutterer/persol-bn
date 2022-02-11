<?php

namespace PHPMaker2021\upPersonnelv2;

// Page object
$SelfdevTypeAdd = &$Page;
?>
<script>
if (!ew.vars.tables.selfdev_type) ew.vars.tables.selfdev_type = <?= JsonEncode(GetClientVar("tables", "selfdev_type")) ?>;
var currentForm, currentPageID;
var fselfdev_typeadd;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "add";
    fselfdev_typeadd = currentForm = new ew.Form("fselfdev_typeadd", "add");

    // Add fields
    var fields = ew.vars.tables.selfdev_type.fields;
    fselfdev_typeadd.addFields([
        ["SelfDev_Type_name", [fields.SelfDev_Type_name.required ? ew.Validators.required(fields.SelfDev_Type_name.caption) : null], fields.SelfDev_Type_name.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fselfdev_typeadd,
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
    fselfdev_typeadd.validate = function () {
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
    fselfdev_typeadd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fselfdev_typeadd.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    loadjs.done("fselfdev_typeadd");
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
<form name="fselfdev_typeadd" id="fselfdev_typeadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl() ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="selfdev_type">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->SelfDev_Type_name->Visible) { // SelfDev_Type_name ?>
    <div id="r_SelfDev_Type_name" class="form-group row">
        <label id="elh_selfdev_type_SelfDev_Type_name" for="x_SelfDev_Type_name" class="<?= $Page->LeftColumnClass ?>"><?= $Page->SelfDev_Type_name->caption() ?><?= $Page->SelfDev_Type_name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->SelfDev_Type_name->cellAttributes() ?>>
<span id="el_selfdev_type_SelfDev_Type_name">
<textarea data-table="selfdev_type" data-field="x_SelfDev_Type_name" name="x_SelfDev_Type_name" id="x_SelfDev_Type_name" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->SelfDev_Type_name->getPlaceHolder()) ?>"<?= $Page->SelfDev_Type_name->editAttributes() ?> aria-describedby="x_SelfDev_Type_name_help"><?= $Page->SelfDev_Type_name->EditValue ?></textarea>
<?= $Page->SelfDev_Type_name->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->SelfDev_Type_name->getErrorMessage() ?></div>
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
    ew.addEventHandlers("selfdev_type");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
