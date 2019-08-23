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
$tblprodutos_view = new tblprodutos_view();

// Run the page
$tblprodutos_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tblprodutos_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$tblprodutos->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var ftblprodutosview = currentForm = new ew.Form("ftblprodutosview", "view");

// Form_CustomValidate event
ftblprodutosview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftblprodutosview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$tblprodutos->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $tblprodutos_view->ExportOptions->render("body") ?>
<?php $tblprodutos_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $tblprodutos_view->showPageHeader(); ?>
<?php
$tblprodutos_view->showMessage();
?>
<form name="ftblprodutosview" id="ftblprodutosview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($tblprodutos_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $tblprodutos_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tblprodutos">
<input type="hidden" name="modal" value="<?php echo (int)$tblprodutos_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($tblprodutos->id->Visible) { // id ?>
	<tr id="r_id">
		<td class="<?php echo $tblprodutos_view->TableLeftColumnClass ?>"><span id="elh_tblprodutos_id"><?php echo $tblprodutos->id->caption() ?></span></td>
		<td data-name="id"<?php echo $tblprodutos->id->cellAttributes() ?>>
<span id="el_tblprodutos_id">
<span<?php echo $tblprodutos->id->viewAttributes() ?>>
<?php echo $tblprodutos->id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tblprodutos->descricao->Visible) { // descricao ?>
	<tr id="r_descricao">
		<td class="<?php echo $tblprodutos_view->TableLeftColumnClass ?>"><span id="elh_tblprodutos_descricao"><?php echo $tblprodutos->descricao->caption() ?></span></td>
		<td data-name="descricao"<?php echo $tblprodutos->descricao->cellAttributes() ?>>
<span id="el_tblprodutos_descricao">
<span<?php echo $tblprodutos->descricao->viewAttributes() ?>>
<?php echo $tblprodutos->descricao->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tblprodutos->custo_real->Visible) { // custo_real ?>
	<tr id="r_custo_real">
		<td class="<?php echo $tblprodutos_view->TableLeftColumnClass ?>"><span id="elh_tblprodutos_custo_real"><?php echo $tblprodutos->custo_real->caption() ?></span></td>
		<td data-name="custo_real"<?php echo $tblprodutos->custo_real->cellAttributes() ?>>
<span id="el_tblprodutos_custo_real">
<span<?php echo $tblprodutos->custo_real->viewAttributes() ?>>
<?php echo $tblprodutos->custo_real->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tblprodutos->preco_venda->Visible) { // preco_venda ?>
	<tr id="r_preco_venda">
		<td class="<?php echo $tblprodutos_view->TableLeftColumnClass ?>"><span id="elh_tblprodutos_preco_venda"><?php echo $tblprodutos->preco_venda->caption() ?></span></td>
		<td data-name="preco_venda"<?php echo $tblprodutos->preco_venda->cellAttributes() ?>>
<span id="el_tblprodutos_preco_venda">
<span<?php echo $tblprodutos->preco_venda->viewAttributes() ?>>
<?php echo $tblprodutos->preco_venda->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tblprodutos->qtd_estoque->Visible) { // qtd_estoque ?>
	<tr id="r_qtd_estoque">
		<td class="<?php echo $tblprodutos_view->TableLeftColumnClass ?>"><span id="elh_tblprodutos_qtd_estoque"><?php echo $tblprodutos->qtd_estoque->caption() ?></span></td>
		<td data-name="qtd_estoque"<?php echo $tblprodutos->qtd_estoque->cellAttributes() ?>>
<span id="el_tblprodutos_qtd_estoque">
<span<?php echo $tblprodutos->qtd_estoque->viewAttributes() ?>>
<?php echo $tblprodutos->qtd_estoque->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tblprodutos->unidade->Visible) { // unidade ?>
	<tr id="r_unidade">
		<td class="<?php echo $tblprodutos_view->TableLeftColumnClass ?>"><span id="elh_tblprodutos_unidade"><?php echo $tblprodutos->unidade->caption() ?></span></td>
		<td data-name="unidade"<?php echo $tblprodutos->unidade->cellAttributes() ?>>
<span id="el_tblprodutos_unidade">
<span<?php echo $tblprodutos->unidade->viewAttributes() ?>>
<?php echo $tblprodutos->unidade->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$tblprodutos_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$tblprodutos->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$tblprodutos_view->terminate();
?>