<?php
namespace PHPMaker2019\project1;

// Session
if (session_status() !== PHP_SESSION_ACTIVE)
	session_start(); // Init session data

// Output buffering
ob_start(); 

// Autoload
include_once "autoload.php";
?>
<?php

// Write header
WriteHeader(FALSE);

// Create page object
$tblusuario_edit = new tblusuario_edit();

// Run the page
$tblusuario_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tblusuario_edit->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "edit";
var ftblusuarioedit = currentForm = new ew.Form("ftblusuarioedit", "edit");

// Validate form
ftblusuarioedit.validate = function() {
	if (!this.validateRequired)
		return true; // Ignore validation
	var $ = jQuery, fobj = this.getForm(), $fobj = $(fobj);
	if ($fobj.find("#confirm").val() == "F")
		return true;
	var elm, felm, uelm, addcnt = 0;
	var $k = $fobj.find("#" + this.formKeyCountName); // Get key_count
	var rowcnt = ($k[0]) ? parseInt($k.val(), 10) : 1;
	var startcnt = (rowcnt == 0) ? 0 : 1; // Check rowcnt == 0 => Inline-Add
	var gridinsert = ["insert", "gridinsert"].includes($fobj.find("#action").val()) && $k[0];
	for (var i = startcnt; i <= rowcnt; i++) {
		var infix = ($k[0]) ? String(i) : "";
		$fobj.data("rowindex", infix);
		<?php if ($tblusuario_edit->id->Required) { ?>
			elm = this.getElements("x" + infix + "_id");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tblusuario->id->caption(), $tblusuario->id->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tblusuario_edit->nome->Required) { ?>
			elm = this.getElements("x" + infix + "_nome");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tblusuario->nome->caption(), $tblusuario->nome->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tblusuario_edit->usuario->Required) { ?>
			elm = this.getElements("x" + infix + "_usuario");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tblusuario->usuario->caption(), $tblusuario->usuario->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tblusuario_edit->senha->Required) { ?>
			elm = this.getElements("x" + infix + "_senha");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tblusuario->senha->caption(), $tblusuario->senha->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tblusuario_edit->ativo->Required) { ?>
			elm = this.getElements("x" + infix + "_ativo");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tblusuario->ativo->caption(), $tblusuario->ativo->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_ativo");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($tblusuario->ativo->errorMessage()) ?>");
		<?php if ($tblusuario_edit->nivel->Required) { ?>
			elm = this.getElements("x" + infix + "_nivel");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tblusuario->nivel->caption(), $tblusuario->nivel->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_nivel");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($tblusuario->nivel->errorMessage()) ?>");

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
	}

	// Process detail forms
	var dfs = $fobj.find("input[name='detailpage']").get();
	for (var i = 0; i < dfs.length; i++) {
		var df = dfs[i], val = df.value;
		if (val && ew.forms[val])
			if (!ew.forms[val].validate())
				return false;
	}
	return true;
}

// Form_CustomValidate event
ftblusuarioedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftblusuarioedit.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $tblusuario_edit->showPageHeader(); ?>
<?php
$tblusuario_edit->showMessage();
?>
<form name="ftblusuarioedit" id="ftblusuarioedit" class="<?php echo $tblusuario_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($tblusuario_edit->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $tblusuario_edit->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tblusuario">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$tblusuario_edit->IsModal ?>">
<!-- Fields to prevent google autofill -->
<input class="d-none" type="text" name="<?php echo Encrypt(Random()) ?>">
<input class="d-none" type="password" name="<?php echo Encrypt(Random()) ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($tblusuario->id->Visible) { // id ?>
	<div id="r_id" class="form-group row">
		<label id="elh_tblusuario_id" class="<?php echo $tblusuario_edit->LeftColumnClass ?>"><?php echo $tblusuario->id->caption() ?><?php echo ($tblusuario->id->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tblusuario_edit->RightColumnClass ?>"><div<?php echo $tblusuario->id->cellAttributes() ?>>
<span id="el_tblusuario_id">
<span<?php echo $tblusuario->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($tblusuario->id->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="tblusuario" data-field="x_id" name="x_id" id="x_id" value="<?php echo HtmlEncode($tblusuario->id->CurrentValue) ?>">
<?php echo $tblusuario->id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tblusuario->nome->Visible) { // nome ?>
	<div id="r_nome" class="form-group row">
		<label id="elh_tblusuario_nome" for="x_nome" class="<?php echo $tblusuario_edit->LeftColumnClass ?>"><?php echo $tblusuario->nome->caption() ?><?php echo ($tblusuario->nome->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tblusuario_edit->RightColumnClass ?>"><div<?php echo $tblusuario->nome->cellAttributes() ?>>
<span id="el_tblusuario_nome">
<input type="text" data-table="tblusuario" data-field="x_nome" name="x_nome" id="x_nome" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($tblusuario->nome->getPlaceHolder()) ?>" value="<?php echo $tblusuario->nome->EditValue ?>"<?php echo $tblusuario->nome->editAttributes() ?>>
</span>
<?php echo $tblusuario->nome->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tblusuario->usuario->Visible) { // usuario ?>
	<div id="r_usuario" class="form-group row">
		<label id="elh_tblusuario_usuario" for="x_usuario" class="<?php echo $tblusuario_edit->LeftColumnClass ?>"><?php echo $tblusuario->usuario->caption() ?><?php echo ($tblusuario->usuario->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tblusuario_edit->RightColumnClass ?>"><div<?php echo $tblusuario->usuario->cellAttributes() ?>>
<span id="el_tblusuario_usuario">
<input type="text" data-table="tblusuario" data-field="x_usuario" name="x_usuario" id="x_usuario" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($tblusuario->usuario->getPlaceHolder()) ?>" value="<?php echo $tblusuario->usuario->EditValue ?>"<?php echo $tblusuario->usuario->editAttributes() ?>>
</span>
<?php echo $tblusuario->usuario->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tblusuario->senha->Visible) { // senha ?>
	<div id="r_senha" class="form-group row">
		<label id="elh_tblusuario_senha" for="x_senha" class="<?php echo $tblusuario_edit->LeftColumnClass ?>"><?php echo $tblusuario->senha->caption() ?><?php echo ($tblusuario->senha->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tblusuario_edit->RightColumnClass ?>"><div<?php echo $tblusuario->senha->cellAttributes() ?>>
<span id="el_tblusuario_senha">
<input type="text" data-table="tblusuario" data-field="x_senha" name="x_senha" id="x_senha" size="30" maxlength="40" placeholder="<?php echo HtmlEncode($tblusuario->senha->getPlaceHolder()) ?>" value="<?php echo $tblusuario->senha->EditValue ?>"<?php echo $tblusuario->senha->editAttributes() ?>>
</span>
<?php echo $tblusuario->senha->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tblusuario->ativo->Visible) { // ativo ?>
	<div id="r_ativo" class="form-group row">
		<label id="elh_tblusuario_ativo" for="x_ativo" class="<?php echo $tblusuario_edit->LeftColumnClass ?>"><?php echo $tblusuario->ativo->caption() ?><?php echo ($tblusuario->ativo->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tblusuario_edit->RightColumnClass ?>"><div<?php echo $tblusuario->ativo->cellAttributes() ?>>
<span id="el_tblusuario_ativo">
<input type="text" data-table="tblusuario" data-field="x_ativo" name="x_ativo" id="x_ativo" size="30" placeholder="<?php echo HtmlEncode($tblusuario->ativo->getPlaceHolder()) ?>" value="<?php echo $tblusuario->ativo->EditValue ?>"<?php echo $tblusuario->ativo->editAttributes() ?>>
</span>
<?php echo $tblusuario->ativo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tblusuario->nivel->Visible) { // nivel ?>
	<div id="r_nivel" class="form-group row">
		<label id="elh_tblusuario_nivel" for="x_nivel" class="<?php echo $tblusuario_edit->LeftColumnClass ?>"><?php echo $tblusuario->nivel->caption() ?><?php echo ($tblusuario->nivel->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tblusuario_edit->RightColumnClass ?>"><div<?php echo $tblusuario->nivel->cellAttributes() ?>>
<span id="el_tblusuario_nivel">
<input type="text" data-table="tblusuario" data-field="x_nivel" name="x_nivel" id="x_nivel" size="30" placeholder="<?php echo HtmlEncode($tblusuario->nivel->getPlaceHolder()) ?>" value="<?php echo $tblusuario->nivel->EditValue ?>"<?php echo $tblusuario->nivel->editAttributes() ?>>
</span>
<?php echo $tblusuario->nivel->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$tblusuario_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $tblusuario_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $tblusuario_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$tblusuario_edit->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$tblusuario_edit->terminate();
?>