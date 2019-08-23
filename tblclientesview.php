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
$tblclientes_view = new tblclientes_view();

// Run the page
$tblclientes_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tblclientes_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$tblclientes->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var ftblclientesview = currentForm = new ew.Form("ftblclientesview", "view");

// Form_CustomValidate event
ftblclientesview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftblclientesview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$tblclientes->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $tblclientes_view->ExportOptions->render("body") ?>
<?php $tblclientes_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $tblclientes_view->showPageHeader(); ?>
<?php
$tblclientes_view->showMessage();
?>
<form name="ftblclientesview" id="ftblclientesview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($tblclientes_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $tblclientes_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tblclientes">
<input type="hidden" name="modal" value="<?php echo (int)$tblclientes_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($tblclientes->id->Visible) { // id ?>
	<tr id="r_id">
		<td class="<?php echo $tblclientes_view->TableLeftColumnClass ?>"><span id="elh_tblclientes_id"><?php echo $tblclientes->id->caption() ?></span></td>
		<td data-name="id"<?php echo $tblclientes->id->cellAttributes() ?>>
<span id="el_tblclientes_id">
<span<?php echo $tblclientes->id->viewAttributes() ?>>
<?php echo $tblclientes->id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tblclientes->nome->Visible) { // nome ?>
	<tr id="r_nome">
		<td class="<?php echo $tblclientes_view->TableLeftColumnClass ?>"><span id="elh_tblclientes_nome"><?php echo $tblclientes->nome->caption() ?></span></td>
		<td data-name="nome"<?php echo $tblclientes->nome->cellAttributes() ?>>
<span id="el_tblclientes_nome">
<span<?php echo $tblclientes->nome->viewAttributes() ?>>
<?php echo $tblclientes->nome->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tblclientes->cpf_cnpj->Visible) { // cpf_cnpj ?>
	<tr id="r_cpf_cnpj">
		<td class="<?php echo $tblclientes_view->TableLeftColumnClass ?>"><span id="elh_tblclientes_cpf_cnpj"><?php echo $tblclientes->cpf_cnpj->caption() ?></span></td>
		<td data-name="cpf_cnpj"<?php echo $tblclientes->cpf_cnpj->cellAttributes() ?>>
<span id="el_tblclientes_cpf_cnpj">
<span<?php echo $tblclientes->cpf_cnpj->viewAttributes() ?>>
<?php echo $tblclientes->cpf_cnpj->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tblclientes->endereco->Visible) { // endereco ?>
	<tr id="r_endereco">
		<td class="<?php echo $tblclientes_view->TableLeftColumnClass ?>"><span id="elh_tblclientes_endereco"><?php echo $tblclientes->endereco->caption() ?></span></td>
		<td data-name="endereco"<?php echo $tblclientes->endereco->cellAttributes() ?>>
<span id="el_tblclientes_endereco">
<span<?php echo $tblclientes->endereco->viewAttributes() ?>>
<?php echo $tblclientes->endereco->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tblclientes->cep->Visible) { // cep ?>
	<tr id="r_cep">
		<td class="<?php echo $tblclientes_view->TableLeftColumnClass ?>"><span id="elh_tblclientes_cep"><?php echo $tblclientes->cep->caption() ?></span></td>
		<td data-name="cep"<?php echo $tblclientes->cep->cellAttributes() ?>>
<span id="el_tblclientes_cep">
<span<?php echo $tblclientes->cep->viewAttributes() ?>>
<?php echo $tblclientes->cep->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tblclientes->telefone->Visible) { // telefone ?>
	<tr id="r_telefone">
		<td class="<?php echo $tblclientes_view->TableLeftColumnClass ?>"><span id="elh_tblclientes_telefone"><?php echo $tblclientes->telefone->caption() ?></span></td>
		<td data-name="telefone"<?php echo $tblclientes->telefone->cellAttributes() ?>>
<span id="el_tblclientes_telefone">
<span<?php echo $tblclientes->telefone->viewAttributes() ?>>
<?php echo $tblclientes->telefone->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$tblclientes_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$tblclientes->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$tblclientes_view->terminate();
?>