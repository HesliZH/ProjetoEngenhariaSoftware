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
$tblprodutos_delete = new tblprodutos_delete();

// Run the page
$tblprodutos_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tblprodutos_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "delete";
var ftblprodutosdelete = currentForm = new ew.Form("ftblprodutosdelete", "delete");

// Form_CustomValidate event
ftblprodutosdelete.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftblprodutosdelete.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $tblprodutos_delete->showPageHeader(); ?>
<?php
$tblprodutos_delete->showMessage();
?>
<form name="ftblprodutosdelete" id="ftblprodutosdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($tblprodutos_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $tblprodutos_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tblprodutos">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($tblprodutos_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($tblprodutos->id->Visible) { // id ?>
		<th class="<?php echo $tblprodutos->id->headerCellClass() ?>"><span id="elh_tblprodutos_id" class="tblprodutos_id"><?php echo $tblprodutos->id->caption() ?></span></th>
<?php } ?>
<?php if ($tblprodutos->descricao->Visible) { // descricao ?>
		<th class="<?php echo $tblprodutos->descricao->headerCellClass() ?>"><span id="elh_tblprodutos_descricao" class="tblprodutos_descricao"><?php echo $tblprodutos->descricao->caption() ?></span></th>
<?php } ?>
<?php if ($tblprodutos->custo_real->Visible) { // custo_real ?>
		<th class="<?php echo $tblprodutos->custo_real->headerCellClass() ?>"><span id="elh_tblprodutos_custo_real" class="tblprodutos_custo_real"><?php echo $tblprodutos->custo_real->caption() ?></span></th>
<?php } ?>
<?php if ($tblprodutos->preco_venda->Visible) { // preco_venda ?>
		<th class="<?php echo $tblprodutos->preco_venda->headerCellClass() ?>"><span id="elh_tblprodutos_preco_venda" class="tblprodutos_preco_venda"><?php echo $tblprodutos->preco_venda->caption() ?></span></th>
<?php } ?>
<?php if ($tblprodutos->qtd_estoque->Visible) { // qtd_estoque ?>
		<th class="<?php echo $tblprodutos->qtd_estoque->headerCellClass() ?>"><span id="elh_tblprodutos_qtd_estoque" class="tblprodutos_qtd_estoque"><?php echo $tblprodutos->qtd_estoque->caption() ?></span></th>
<?php } ?>
<?php if ($tblprodutos->unidade->Visible) { // unidade ?>
		<th class="<?php echo $tblprodutos->unidade->headerCellClass() ?>"><span id="elh_tblprodutos_unidade" class="tblprodutos_unidade"><?php echo $tblprodutos->unidade->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$tblprodutos_delete->RecCnt = 0;
$i = 0;
while (!$tblprodutos_delete->Recordset->EOF) {
	$tblprodutos_delete->RecCnt++;
	$tblprodutos_delete->RowCnt++;

	// Set row properties
	$tblprodutos->resetAttributes();
	$tblprodutos->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$tblprodutos_delete->loadRowValues($tblprodutos_delete->Recordset);

	// Render row
	$tblprodutos_delete->renderRow();
?>
	<tr<?php echo $tblprodutos->rowAttributes() ?>>
<?php if ($tblprodutos->id->Visible) { // id ?>
		<td<?php echo $tblprodutos->id->cellAttributes() ?>>
<span id="el<?php echo $tblprodutos_delete->RowCnt ?>_tblprodutos_id" class="tblprodutos_id">
<span<?php echo $tblprodutos->id->viewAttributes() ?>>
<?php echo $tblprodutos->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tblprodutos->descricao->Visible) { // descricao ?>
		<td<?php echo $tblprodutos->descricao->cellAttributes() ?>>
<span id="el<?php echo $tblprodutos_delete->RowCnt ?>_tblprodutos_descricao" class="tblprodutos_descricao">
<span<?php echo $tblprodutos->descricao->viewAttributes() ?>>
<?php echo $tblprodutos->descricao->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tblprodutos->custo_real->Visible) { // custo_real ?>
		<td<?php echo $tblprodutos->custo_real->cellAttributes() ?>>
<span id="el<?php echo $tblprodutos_delete->RowCnt ?>_tblprodutos_custo_real" class="tblprodutos_custo_real">
<span<?php echo $tblprodutos->custo_real->viewAttributes() ?>>
<?php echo $tblprodutos->custo_real->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tblprodutos->preco_venda->Visible) { // preco_venda ?>
		<td<?php echo $tblprodutos->preco_venda->cellAttributes() ?>>
<span id="el<?php echo $tblprodutos_delete->RowCnt ?>_tblprodutos_preco_venda" class="tblprodutos_preco_venda">
<span<?php echo $tblprodutos->preco_venda->viewAttributes() ?>>
<?php echo $tblprodutos->preco_venda->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tblprodutos->qtd_estoque->Visible) { // qtd_estoque ?>
		<td<?php echo $tblprodutos->qtd_estoque->cellAttributes() ?>>
<span id="el<?php echo $tblprodutos_delete->RowCnt ?>_tblprodutos_qtd_estoque" class="tblprodutos_qtd_estoque">
<span<?php echo $tblprodutos->qtd_estoque->viewAttributes() ?>>
<?php echo $tblprodutos->qtd_estoque->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tblprodutos->unidade->Visible) { // unidade ?>
		<td<?php echo $tblprodutos->unidade->cellAttributes() ?>>
<span id="el<?php echo $tblprodutos_delete->RowCnt ?>_tblprodutos_unidade" class="tblprodutos_unidade">
<span<?php echo $tblprodutos->unidade->viewAttributes() ?>>
<?php echo $tblprodutos->unidade->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$tblprodutos_delete->Recordset->moveNext();
}
$tblprodutos_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $tblprodutos_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$tblprodutos_delete->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$tblprodutos_delete->terminate();
?>