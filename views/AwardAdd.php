<?php

namespace PHPMaker2021\upPersonnelv2;

// Page object
$AwardAdd = &$Page;
?>
<script>
if (!ew.vars.tables.award) ew.vars.tables.award = <?= JsonEncode(GetClientVar("tables", "award")) ?>;
var currentForm, currentPageID;
var fawardadd;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "add";
    fawardadd = currentForm = new ew.Form("fawardadd", "add");

    // Add fields
    var fields = ew.vars.tables.award.fields;
    fawardadd.addFields([
        ["Per_Id", [fields.Per_Id.required ? ew.Validators.required(fields.Per_Id.caption) : null], fields.Per_Id.isInvalid],
        ["Award_Name", [fields.Award_Name.required ? ew.Validators.required(fields.Award_Name.caption) : null], fields.Award_Name.isInvalid],
        ["Award_Year", [fields.Award_Year.required ? ew.Validators.required(fields.Award_Year.caption) : null], fields.Award_Year.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fawardadd,
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
    fawardadd.validate = function () {
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
    fawardadd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fawardadd.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    fawardadd.lists.Per_Id = <?= $Page->Per_Id->toClientList($Page) ?>;
    loadjs.done("fawardadd");
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
<form name="fawardadd" id="fawardadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl() ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="award">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->Per_Id->Visible) { // Per_Id ?>
    <div id="r_Per_Id" class="form-group row">
        <label id="elh_award_Per_Id" for="x_Per_Id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Per_Id->caption() ?><?= $Page->Per_Id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->Per_Id->cellAttributes() ?>>
<span id="el_award_Per_Id">
    <select
        id="x_Per_Id"
        name="x_Per_Id"
        class="form-control ew-select<?= $Page->Per_Id->isInvalidClass() ?>"
        data-select2-id="award_x_Per_Id"
        data-table="award"
        data-field="x_Per_Id"
        data-value-separator="<?= $Page->Per_Id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->Per_Id->getPlaceHolder()) ?>"
        <?= $Page->Per_Id->editAttributes() ?>>
        <?= $Page->Per_Id->selectOptionListHtml("x_Per_Id") ?>
    </select>
    <?= $Page->Per_Id->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->Per_Id->getErrorMessage() ?></div>
<?= $Page->Per_Id->Lookup->getParamTag($Page, "p_x_Per_Id") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='award_x_Per_Id']"),
        options = { name: "x_Per_Id", selectId: "award_x_Per_Id", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.award.fields.Per_Id.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->Award_Name->Visible) { // Award_Name ?>
    <div id="r_Award_Name" class="form-group row">
        <label id="elh_award_Award_Name" for="x_Award_Name" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Award_Name->caption() ?><?= $Page->Award_Name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->Award_Name->cellAttributes() ?>>
<span id="el_award_Award_Name">
<input type="<?= $Page->Award_Name->getInputTextType() ?>" data-table="award" data-field="x_Award_Name" name="x_Award_Name" id="x_Award_Name" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->Award_Name->getPlaceHolder()) ?>" value="<?= $Page->Award_Name->EditValue ?>"<?= $Page->Award_Name->editAttributes() ?> aria-describedby="x_Award_Name_help">
<?= $Page->Award_Name->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->Award_Name->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->Award_Year->Visible) { // Award_Year ?>
    <div id="r_Award_Year" class="form-group row">
        <label id="elh_award_Award_Year" for="x_Award_Year" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Award_Year->caption() ?><?= $Page->Award_Year->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->Award_Year->cellAttributes() ?>>
<span id="el_award_Award_Year">
<input type="<?= $Page->Award_Year->getInputTextType() ?>" data-table="award" data-field="x_Award_Year" name="x_Award_Year" id="x_Award_Year" size="30" maxlength="4" placeholder="<?= HtmlEncode($Page->Award_Year->getPlaceHolder()) ?>" value="<?= $Page->Award_Year->EditValue ?>"<?= $Page->Award_Year->editAttributes() ?> aria-describedby="x_Award_Year_help">
<?= $Page->Award_Year->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->Award_Year->getErrorMessage() ?></div>
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
    ew.addEventHandlers("award");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
