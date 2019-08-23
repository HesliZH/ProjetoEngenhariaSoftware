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
$tblprodutos_edit = new tblprodutos_edit();

// Run the page
$tblprodutos_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tblprodutos_edit->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "edit";
var ftblprodutosedit = currentForm = new ew.Form("ftblprodutosedit", "edit");

// Validate form
ftblprodutosedit.validate = function() {
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
		<?php if ($tblprodutos_edit->id->Required) { ?>
			elm = this.getElements("x" + infix + "_id");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tblprodutos->id->caption(), $tblprodutos->id->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tblprodutos_edit->descricao->Required) { ?>
			elm = this.getElements("x" + infix + "_descricao");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tblprodutos->descricao->caption(), $tblprodutos->descricao->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($tblprodutos_edit->custo_real->Required) { ?>
			elm = this.getElements("x" + infix + "_custo_real");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tblprodutos->custo_real->caption(), $tblprodutos->custo_real->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_custo_real");
			if (elm && !ew.checkNumber(elm.value))
				return this.onError(elm, "<?php echo JsEncode($tblprodutos->custo_real->errorMessage()) ?>");
		<?php if ($tblprodutos_edit->preco_venda->Required) { ?>
			elm = this.getElements("x" + infix + "_preco_venda");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tblprodutos->preco_venda->caption(), $tblprodutos->preco_venda->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_preco_venda");
			if (elm && !ew.checkNumber(elm.value))
				return this.onError(elm, "<?php echo JsEncode($tblprodutos->preco_venda->errorMessage()) ?>");
		<?php if ($tblprodutos_edit->qtd_estoque->Required) { ?>
			elm = this.getElements("x" + infix + "_qtd_estoque");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tblprodutos->qtd_estoque->caption(), $tblprodutos->qtd_estoque->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_qtd_estoque");
			if (elm && !ew.checkNumber(elm.value))
				return this.onError(elm, "<?php echo JsEncode($tblprodutos->qtd_estoque->errorMessage()) ?>");
		<?php if ($tblprodutos_edit->unidade->Required) { ?>
			elm = this.getElements("x" + infix + "_unidade");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tblprodutos->unidade->caption(), $tblprodutos->unidade->RequiredErrorMessage)) ?>");
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
ftblprodutosedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftblprodutosedit.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $tblprodutos_edit->showPageHeader(); ?>
<?php
$tblprodutos_edit->showMessage();
?>
<form name="ftblprodutosedit" id="ftblprodutosedit" class="<?php echo $tblprodutos_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($tblprodutos_edit->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $tblprodutos_edit->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tblprodutos">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$tblprodutos_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($tblprodutos->id->Visible) { // id ?>
	<div id="r_id" class="form-group row">
		<label id="elh_tblprodutos_id" class="<?php echo $tblprodutos_edit->LeftColumnClass ?>"><?php echo $tblprodutos->id->caption() ?><?php echo ($tblprodutos->id->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tblprodutos_edit->RightColumnClass ?>"><div<?php echo $tblprodutos->id->cellAttributes() ?>>
<span id="el_tblprodutos_id">
<span<?php echo $tblprodutos->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($tblprodutos->id->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="tblprodutos" data-field="x_id" name="x_id" id="x_id" value="<?php echo HtmlEncode($tblprodutos->id->CurrentValue) ?>">
<?php echo $tblprodutos->id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tblprodutos->descricao->Visible) { // descricao ?>
	<div id="r_descricao" class="form-group row">
		<label id="elh_tblprodutos_descricao" for="x_descricao" class="<?php echo $tblprodutos_edit->LeftColumnClass ?>"><?php echo $tblprodutos->descricao->caption() ?><?php echo ($tblprodutos->descricao->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tblprodutos_edit->RightColumnClass ?>"><div<?php echo $tblprodutos->descricao->cellAttributes() ?>>
<span id="el_tblprodutos_descricao">
<input type="text" data-table="tblprodutos" data-field="x_descricao" name="x_descricao" id="x_descricao" size="30" maxlength="80" placeholder="<?php echo HtmlEncode($tblprodutos->descricao->getPlaceHolder()) ?>" value="<?php echo $tblprodutos->descricao->EditValue ?>"<?php echo $tblprodutos->descricao->editAttributes() ?>>
</span>
<?php echo $tblprodutos->descricao->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tblprodutos->custo_real->Visible) { // custo_real ?>
	<div id="r_custo_real" class="form-group row">
		<label id="elh_tblprodutos_custo_real" for="x_custo_real" class="<?php echo $tblprodutos_edit->LeftColumnClass ?>"><?php echo $tblprodutos->custo_real->caption() ?><?php echo ($tblprodutos->custo_real->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tblprodutos_edit->RightColumnClass ?>"><div<?php echo $tblprodutos->custo_real->cellAttributes() ?>>
<span id="el_tblprodutos_custo_real">
<input type="text" data-table="tblprodutos" data-field="x_custo_real" name="x_custo_real" id="x_custo_real" size="30" placeholder="<?php echo HtmlEncode($tblprodutos->custo_real->getPlaceHolder()) ?>" value="<?php echo $tblprodutos->custo_real->EditValue ?>"<?php echo $tblprodutos->custo_real->editAttributes() ?>>
</span>
<?php echo $tblprodutos->custo_real->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tblprodutos->preco_venda->Visible) { // preco_venda ?>
	<div id="r_preco_venda" class="form-group row">
		<label id="elh_tblprodutos_preco_venda" for="x_preco_venda" class="<?php echo $tblprodutos_edit->LeftColumnClass ?>"><?php echo $tblprodutos->preco_venda->caption() ?><?php echo ($tblprodutos->preco_venda->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tblprodutos_edit->RightColumnClass ?>"><div<?php echo $tblprodutos->preco_venda->cellAttributes() ?>>
<span id="el_tblprodutos_preco_venda">
<input type="text" data-table="tblprodutos" data-field="x_preco_venda" name="x_preco_venda" id="x_preco_venda" size="30" placeholder="<?php echo HtmlEncode($tblprodutos->preco_venda->getPlaceHolder()) ?>" value="<?php echo $tblprodutos->preco_venda->EditValue ?>"<?php echo $tblprodutos->preco_venda->editAttributes() ?>>
</span>
<?php echo $tblprodutos->preco_venda->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tblprodutos->qtd_estoque->Visible) { // qtd_estoque ?>
	<div id="r_qtd_estoque" class="form-group row">
		<label id="elh_tblprodutos_qtd_estoque" for="x_qtd_estoque" class="<?php echo $tblprodutos_edit->LeftColumnClass ?>"><?php echo $tblprodutos->qtd_estoque->caption() ?><?php echo ($tblprodutos->qtd_estoque->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tblprodutos_edit->RightColumnClass ?>"><div<?php echo $tblprodutos->qtd_estoque->cellAttributes() ?>>
<span id="el_tblprodutos_qtd_estoque">
<input type="text" data-table="tblprodutos" data-field="x_qtd_estoque" name="x_qtd_estoque" id="x_qtd_estoque" size="30" placeholder="<?php echo HtmlEncode($tblprodutos->qtd_estoque->getPlaceHolder()) ?>" value="<?php echo $tblprodutos->qtd_estoque->EditValue ?>"<?php echo $tblprodutos->qtd_estoque->editAttributes() ?>>
</span>
<?php echo $tblprodutos->qtd_estoque->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tblprodutos->unidade->Visible) { // unidade ?>
	<div id="r_unidade" class="form-group row">
		<label id="elh_tblprodutos_unidade" for="x_unidade" class="<?php echo $tblprodutos_edit->LeftColumnClass ?>"><?php echo $tblprodutos->unidade->caption() ?><?php echo ($tblprodutos->unidade->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tblprodutos_edit->RightColumnClass ?>"><div<?php echo $tblprodutos->unidade->cellAttributes() ?>>
<span id="el_tblprodutos_unidade">
<input type="text" data-table="tblprodutos" data-field="x_unidade" name="x_unidade" id="x_unidade" size="30" maxlength="5" placeholder="<?php echo HtmlEncode($tblprodutos->unidade->getPlaceHolder()) ?>" value="<?php echo $tblprodutos->unidade->EditValue ?>"<?php echo $tblprodutos->unidade->editAttributes() ?>>
</span>
<?php echo $tblprodutos->unidade->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$tblprodutos_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $tblprodutos_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $tblprodutos_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$tblprodutos_edit->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$tblprodutos_edit->terminate();
?>