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
$tblclientes_add = new tblclientes_add();

// Run the page
$tblclientes_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tblclientes_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "add";
var ftblclientesadd = currentForm = new ew.Form("ftblclientesadd", "add");

// Validate form
ftblclientesadd.validate = function() {
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
		<?php if ($tblclientes_add->nome->Required) { ?>
			elm = this.getElements("x" + infix + "_nome");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tblclientes->nome->caption(), $tblclientes->nome->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tblclientes_add->cpf_cnpj->Required) { ?>
			elm = this.getElements("x" + infix + "_cpf_cnpj");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tblclientes->cpf_cnpj->caption(), $tblclientes->cpf_cnpj->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tblclientes_add->endereco->Required) { ?>
			elm = this.getElements("x" + infix + "_endereco");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tblclientes->endereco->caption(), $tblclientes->endereco->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tblclientes_add->cep->Required) { ?>
			elm = this.getElements("x" + infix + "_cep");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tblclientes->cep->caption(), $tblclientes->cep->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tblclientes_add->telefone->Required) { ?>
			elm = this.getElements("x" + infix + "_telefone");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tblclientes->telefone->caption(), $tblclientes->telefone->RequiredErrorMessage)) ?>");
		<?php } ?>

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
ftblclientesadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftblclientesadd.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $tblclientes_add->showPageHeader(); ?>
<?php
$tblclientes_add->showMessage();
?>
<form name="ftblclientesadd" id="ftblclientesadd" class="<?php echo $tblclientes_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($tblclientes_add->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $tblclientes_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tblclientes">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$tblclientes_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($tblclientes->nome->Visible) { // nome ?>
	<div id="r_nome" class="form-group row">
		<label id="elh_tblclientes_nome" for="x_nome" class="<?php echo $tblclientes_add->LeftColumnClass ?>"><?php echo $tblclientes->nome->caption() ?><?php echo ($tblclientes->nome->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tblclientes_add->RightColumnClass ?>"><div<?php echo $tblclientes->nome->cellAttributes() ?>>
<span id="el_tblclientes_nome">
<input type="text" data-table="tblclientes" data-field="x_nome" name="x_nome" id="x_nome" size="30" maxlength="75" placeholder="<?php echo HtmlEncode($tblclientes->nome->getPlaceHolder()) ?>" value="<?php echo $tblclientes->nome->EditValue ?>"<?php echo $tblclientes->nome->editAttributes() ?>>
</span>
<?php echo $tblclientes->nome->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tblclientes->cpf_cnpj->Visible) { // cpf_cnpj ?>
	<div id="r_cpf_cnpj" class="form-group row">
		<label id="elh_tblclientes_cpf_cnpj" for="x_cpf_cnpj" class="<?php echo $tblclientes_add->LeftColumnClass ?>"><?php echo $tblclientes->cpf_cnpj->caption() ?><?php echo ($tblclientes->cpf_cnpj->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tblclientes_add->RightColumnClass ?>"><div<?php echo $tblclientes->cpf_cnpj->cellAttributes() ?>>
<span id="el_tblclientes_cpf_cnpj">
<input type="text" data-table="tblclientes" data-field="x_cpf_cnpj" name="x_cpf_cnpj" id="x_cpf_cnpj" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($tblclientes->cpf_cnpj->getPlaceHolder()) ?>" value="<?php echo $tblclientes->cpf_cnpj->EditValue ?>"<?php echo $tblclientes->cpf_cnpj->editAttributes() ?>>
</span>
<?php echo $tblclientes->cpf_cnpj->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tblclientes->endereco->Visible) { // endereco ?>
	<div id="r_endereco" class="form-group row">
		<label id="elh_tblclientes_endereco" for="x_endereco" class="<?php echo $tblclientes_add->LeftColumnClass ?>"><?php echo $tblclientes->endereco->caption() ?><?php echo ($tblclientes->endereco->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tblclientes_add->RightColumnClass ?>"><div<?php echo $tblclientes->endereco->cellAttributes() ?>>
<span id="el_tblclientes_endereco">
<input type="text" data-table="tblclientes" data-field="x_endereco" name="x_endereco" id="x_endereco" size="30" maxlength="80" placeholder="<?php echo HtmlEncode($tblclientes->endereco->getPlaceHolder()) ?>" value="<?php echo $tblclientes->endereco->EditValue ?>"<?php echo $tblclientes->endereco->editAttributes() ?>>
</span>
<?php echo $tblclientes->endereco->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tblclientes->cep->Visible) { // cep ?>
	<div id="r_cep" class="form-group row">
		<label id="elh_tblclientes_cep" for="x_cep" class="<?php echo $tblclientes_add->LeftColumnClass ?>"><?php echo $tblclientes->cep->caption() ?><?php echo ($tblclientes->cep->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tblclientes_add->RightColumnClass ?>"><div<?php echo $tblclientes->cep->cellAttributes() ?>>
<span id="el_tblclientes_cep">
<input type="text" data-table="tblclientes" data-field="x_cep" name="x_cep" id="x_cep" size="30" maxlength="80" placeholder="<?php echo HtmlEncode($tblclientes->cep->getPlaceHolder()) ?>" value="<?php echo $tblclientes->cep->EditValue ?>"<?php echo $tblclientes->cep->editAttributes() ?>>
</span>
<?php echo $tblclientes->cep->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tblclientes->telefone->Visible) { // telefone ?>
	<div id="r_telefone" class="form-group row">
		<label id="elh_tblclientes_telefone" for="x_telefone" class="<?php echo $tblclientes_add->LeftColumnClass ?>"><?php echo $tblclientes->telefone->caption() ?><?php echo ($tblclientes->telefone->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tblclientes_add->RightColumnClass ?>"><div<?php echo $tblclientes->telefone->cellAttributes() ?>>
<span id="el_tblclientes_telefone">
<input type="text" data-table="tblclientes" data-field="x_telefone" name="x_telefone" id="x_telefone" size="30" maxlength="15" placeholder="<?php echo HtmlEncode($tblclientes->telefone->getPlaceHolder()) ?>" value="<?php echo $tblclientes->telefone->EditValue ?>"<?php echo $tblclientes->telefone->editAttributes() ?>>
</span>
<?php echo $tblclientes->telefone->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$tblclientes_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $tblclientes_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $tblclientes_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$tblclientes_add->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$tblclientes_add->terminate();
?>