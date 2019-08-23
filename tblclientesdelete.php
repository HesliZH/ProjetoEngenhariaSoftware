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
$tblclientes_delete = new tblclientes_delete();

// Run the page
$tblclientes_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tblclientes_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "delete";
var ftblclientesdelete = currentForm = new ew.Form("ftblclientesdelete", "delete");

// Form_CustomValidate event
ftblclientesdelete.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftblclientesdelete.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $tblclientes_delete->showPageHeader(); ?>
<?php
$tblclientes_delete->showMessage();
?>
<form name="ftblclientesdelete" id="ftblclientesdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($tblclientes_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $tblclientes_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tblclientes">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($tblclientes_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($tblclientes->id->Visible) { // id ?>
		<th class="<?php echo $tblclientes->id->headerCellClass() ?>"><span id="elh_tblclientes_id" class="tblclientes_id"><?php echo $tblclientes->id->caption() ?></span></th>
<?php } ?>
<?php if ($tblclientes->nome->Visible) { // nome ?>
		<th class="<?php echo $tblclientes->nome->headerCellClass() ?>"><span id="elh_tblclientes_nome" class="tblclientes_nome"><?php echo $tblclientes->nome->caption() ?></span></th>
<?php } ?>
<?php if ($tblclientes->cpf_cnpj->Visible) { // cpf_cnpj ?>
		<th class="<?php echo $tblclientes->cpf_cnpj->headerCellClass() ?>"><span id="elh_tblclientes_cpf_cnpj" class="tblclientes_cpf_cnpj"><?php echo $tblclientes->cpf_cnpj->caption() ?></span></th>
<?php } ?>
<?php if ($tblclientes->endereco->Visible) { // endereco ?>
		<th class="<?php echo $tblclientes->endereco->headerCellClass() ?>"><span id="elh_tblclientes_endereco" class="tblclientes_endereco"><?php echo $tblclientes->endereco->caption() ?></span></th>
<?php } ?>
<?php if ($tblclientes->cep->Visible) { // cep ?>
		<th class="<?php echo $tblclientes->cep->headerCellClass() ?>"><span id="elh_tblclientes_cep" class="tblclientes_cep"><?php echo $tblclientes->cep->caption() ?></span></th>
<?php } ?>
<?php if ($tblclientes->telefone->Visible) { // telefone ?>
		<th class="<?php echo $tblclientes->telefone->headerCellClass() ?>"><span id="elh_tblclientes_telefone" class="tblclientes_telefone"><?php echo $tblclientes->telefone->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$tblclientes_delete->RecCnt = 0;
$i = 0;
while (!$tblclientes_delete->Recordset->EOF) {
	$tblclientes_delete->RecCnt++;
	$tblclientes_delete->RowCnt++;

	// Set row properties
	$tblclientes->resetAttributes();
	$tblclientes->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$tblclientes_delete->loadRowValues($tblclientes_delete->Recordset);

	// Render row
	$tblclientes_delete->renderRow();
?>
	<tr<?php echo $tblclientes->rowAttributes() ?>>
<?php if ($tblclientes->id->Visible) { // id ?>
		<td<?php echo $tblclientes->id->cellAttributes() ?>>
<span id="el<?php echo $tblclientes_delete->RowCnt ?>_tblclientes_id" class="tblclientes_id">
<span<?php echo $tblclientes->id->viewAttributes() ?>>
<?php echo $tblclientes->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tblclientes->nome->Visible) { // nome ?>
		<td<?php echo $tblclientes->nome->cellAttributes() ?>>
<span id="el<?php echo $tblclientes_delete->RowCnt ?>_tblclientes_nome" class="tblclientes_nome">
<span<?php echo $tblclientes->nome->viewAttributes() ?>>
<?php echo $tblclientes->nome->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tblclientes->cpf_cnpj->Visible) { // cpf_cnpj ?>
		<td<?php echo $tblclientes->cpf_cnpj->cellAttributes() ?>>
<span id="el<?php echo $tblclientes_delete->RowCnt ?>_tblclientes_cpf_cnpj" class="tblclientes_cpf_cnpj">
<span<?php echo $tblclientes->cpf_cnpj->viewAttributes() ?>>
<?php echo $tblclientes->cpf_cnpj->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tblclientes->endereco->Visible) { // endereco ?>
		<td<?php echo $tblclientes->endereco->cellAttributes() ?>>
<span id="el<?php echo $tblclientes_delete->RowCnt ?>_tblclientes_endereco" class="tblclientes_endereco">
<span<?php echo $tblclientes->endereco->viewAttributes() ?>>
<?php echo $tblclientes->endereco->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tblclientes->cep->Visible) { // cep ?>
		<td<?php echo $tblclientes->cep->cellAttributes() ?>>
<span id="el<?php echo $tblclientes_delete->RowCnt ?>_tblclientes_cep" class="tblclientes_cep">
<span<?php echo $tblclientes->cep->viewAttributes() ?>>
<?php echo $tblclientes->cep->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tblclientes->telefone->Visible) { // telefone ?>
		<td<?php echo $tblclientes->telefone->cellAttributes() ?>>
<span id="el<?php echo $tblclientes_delete->RowCnt ?>_tblclientes_telefone" class="tblclientes_telefone">
<span<?php echo $tblclientes->telefone->viewAttributes() ?>>
<?php echo $tblclientes->telefone->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$tblclientes_delete->Recordset->moveNext();
}
$tblclientes_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $tblclientes_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$tblclientes_delete->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$tblclientes_delete->terminate();
?>