<?php

namespace PHPMaker2021\upPersonnelv2;

// Page object
$UsersAdd = &$Page;
?>
<script>
if (!ew.vars.tables.users) ew.vars.tables.users = <?= JsonEncode(GetClientVar("tables", "users")) ?>;
var currentForm, currentPageID;
var fusersadd;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "add";
    fusersadd = currentForm = new ew.Form("fusersadd", "add");

    // Add fields
    var fields = ew.vars.tables.users.fields;
    fusersadd.addFields([
        ["Per_Id", [fields.Per_Id.required ? ew.Validators.required(fields.Per_Id.caption) : null], fields.Per_Id.isInvalid],
        ["Users_Name", [fields.Users_Name.required ? ew.Validators.required(fields.Users_Name.caption) : null], fields.Users_Name.isInvalid],
        ["Users_Password", [fields.Users_Password.required ? ew.Validators.required(fields.Users_Password.caption) : null], fields.Users_Password.isInvalid],
        ["Users_Permission", [fields.Users_Permission.required ? ew.Validators.required(fields.Users_Permission.caption) : null], fields.Users_Permission.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fusersadd,
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
    fusersadd.validate = function () {
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
    fusersadd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fusersadd.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    fusersadd.lists.Per_Id = <?= $Page->Per_Id->toClientList($Page) ?>;
    loadjs.done("fusersadd");
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
<form name="fusersadd" id="fusersadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl() ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="users">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->Per_Id->Visible) { // Per_Id ?>
    <div id="r_Per_Id" class="form-group row">
        <label id="elh_users_Per_Id" for="x_Per_Id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Per_Id->caption() ?><?= $Page->Per_Id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->Per_Id->cellAttributes() ?>>
<span id="el_users_Per_Id">
    <select
        id="x_Per_Id"
        name="x_Per_Id"
        class="form-control ew-select<?= $Page->Per_Id->isInvalidClass() ?>"
        data-select2-id="users_x_Per_Id"
        data-table="users"
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
    var el = document.querySelector("select[data-select2-id='users_x_Per_Id']"),
        options = { name: "x_Per_Id", selectId: "users_x_Per_Id", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.users.fields.Per_Id.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->Users_Name->Visible) { // Users_Name ?>
    <div id="r_Users_Name" class="form-group row">
        <label id="elh_users_Users_Name" for="x_Users_Name" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Users_Name->caption() ?><?= $Page->Users_Name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->Users_Name->cellAttributes() ?>>
<span id="el_users_Users_Name">
<input type="<?= $Page->Users_Name->getInputTextType() ?>" data-table="users" data-field="x_Users_Name" name="x_Users_Name" id="x_Users_Name" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->Users_Name->getPlaceHolder()) ?>" value="<?= $Page->Users_Name->EditValue ?>"<?= $Page->Users_Name->editAttributes() ?> aria-describedby="x_Users_Name_help">
<?= $Page->Users_Name->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->Users_Name->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->Users_Password->Visible) { // Users_Password ?>
    <div id="r_Users_Password" class="form-group row">
        <label id="elh_users_Users_Password" for="x_Users_Password" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Users_Password->caption() ?><?= $Page->Users_Password->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->Users_Password->cellAttributes() ?>>
<span id="el_users_Users_Password">
<div class="input-group">
    <input type="password" name="x_Users_Password" id="x_Users_Password" autocomplete="new-password" data-field="x_Users_Password" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->Users_Password->getPlaceHolder()) ?>"<?= $Page->Users_Password->editAttributes() ?> aria-describedby="x_Users_Password_help">
    <div class="input-group-append"><button type="button" class="btn btn-default ew-toggle-password rounded-right" onclick="ew.togglePassword(event);"><i class="fas fa-eye"></i></button></div>
</div>
<?= $Page->Users_Password->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->Users_Password->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->Users_Permission->Visible) { // Users_Permission ?>
    <div id="r_Users_Permission" class="form-group row">
        <label id="elh_users_Users_Permission" for="x_Users_Permission" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Users_Permission->caption() ?><?= $Page->Users_Permission->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->Users_Permission->cellAttributes() ?>>
<span id="el_users_Users_Permission">
<input type="<?= $Page->Users_Permission->getInputTextType() ?>" data-table="users" data-field="x_Users_Permission" name="x_Users_Permission" id="x_Users_Permission" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->Users_Permission->getPlaceHolder()) ?>" value="<?= $Page->Users_Permission->EditValue ?>"<?= $Page->Users_Permission->editAttributes() ?> aria-describedby="x_Users_Permission_help">
<?= $Page->Users_Permission->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->Users_Permission->getErrorMessage() ?></div>
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
    ew.addEventHandlers("users");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
