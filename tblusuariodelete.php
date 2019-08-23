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
$tblusuario_delete = new tblusuario_delete();

// Run the page
$tblusuario_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tblusuario_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "delete";
var ftblusuariodelete = currentForm = new ew.Form("ftblusuariodelete", "delete");

// Form_CustomValidate event
ftblusuariodelete.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftblusuariodelete.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $tblusuario_delete->showPageHeader(); ?>
<?php
$tblusuario_delete->showMessage();
?>
<form name="ftblusuariodelete" id="ftblusuariodelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($tblusuario_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $tblusuario_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tblusuario">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($tblusuario_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($tblusuario->id->Visible) { // id ?>
		<th class="<?php echo $tblusuario->id->headerCellClass() ?>"><span id="elh_tblusuario_id" class="tblusuario_id"><?php echo $tblusuario->id->caption() ?></span></th>
<?php } ?>
<?php if ($tblusuario->nome->Visible) { // nome ?>
		<th class="<?php echo $tblusuario->nome->headerCellClass() ?>"><span id="elh_tblusuario_nome" class="tblusuario_nome"><?php echo $tblusuario->nome->caption() ?></span></th>
<?php } ?>
<?php if ($tblusuario->usuario->Visible) { // usuario ?>
		<th class="<?php echo $tblusuario->usuario->headerCellClass() ?>"><span id="elh_tblusuario_usuario" class="tblusuario_usuario"><?php echo $tblusuario->usuario->caption() ?></span></th>
<?php } ?>
<?php if ($tblusuario->senha->Visible) { // senha ?>
		<th class="<?php echo $tblusuario->senha->headerCellClass() ?>"><span id="elh_tblusuario_senha" class="tblusuario_senha"><?php echo $tblusuario->senha->caption() ?></span></th>
<?php } ?>
<?php if ($tblusuario->ativo->Visible) { // ativo ?>
		<th class="<?php echo $tblusuario->ativo->headerCellClass() ?>"><span id="elh_tblusuario_ativo" class="tblusuario_ativo"><?php echo $tblusuario->ativo->caption() ?></span></th>
<?php } ?>
<?php if ($tblusuario->nivel->Visible) { // nivel ?>
		<th class="<?php echo $tblusuario->nivel->headerCellClass() ?>"><span id="elh_tblusuario_nivel" class="tblusuario_nivel"><?php echo $tblusuario->nivel->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$tblusuario_delete->RecCnt = 0;
$i = 0;
while (!$tblusuario_delete->Recordset->EOF) {
	$tblusuario_delete->RecCnt++;
	$tblusuario_delete->RowCnt++;

	// Set row properties
	$tblusuario->resetAttributes();
	$tblusuario->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$tblusuario_delete->loadRowValues($tblusuario_delete->Recordset);

	// Render row
	$tblusuario_delete->renderRow();
?>
	<tr<?php echo $tblusuario->rowAttributes() ?>>
<?php if ($tblusuario->id->Visible) { // id ?>
		<td<?php echo $tblusuario->id->cellAttributes() ?>>
<span id="el<?php echo $tblusuario_delete->RowCnt ?>_tblusuario_id" class="tblusuario_id">
<span<?php echo $tblusuario->id->viewAttributes() ?>>
<?php echo $tblusuario->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tblusuario->nome->Visible) { // nome ?>
		<td<?php echo $tblusuario->nome->cellAttributes() ?>>
<span id="el<?php echo $tblusuario_delete->RowCnt ?>_tblusuario_nome" class="tblusuario_nome">
<span<?php echo $tblusuario->nome->viewAttributes() ?>>
<?php echo $tblusuario->nome->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tblusuario->usuario->Visible) { // usuario ?>
		<td<?php echo $tblusuario->usuario->cellAttributes() ?>>
<span id="el<?php echo $tblusuario_delete->RowCnt ?>_tblusuario_usuario" class="tblusuario_usuario">
<span<?php echo $tblusuario->usuario->viewAttributes() ?>>
<?php echo $tblusuario->usuario->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tblusuario->senha->Visible) { // senha ?>
		<td<?php echo $tblusuario->senha->cellAttributes() ?>>
<span id="el<?php echo $tblusuario_delete->RowCnt ?>_tblusuario_senha" class="tblusuario_senha">
<span<?php echo $tblusuario->senha->viewAttributes() ?>>
<?php echo $tblusuario->senha->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tblusuario->ativo->Visible) { // ativo ?>
		<td<?php echo $tblusuario->ativo->cellAttributes() ?>>
<span id="el<?php echo $tblusuario_delete->RowCnt ?>_tblusuario_ativo" class="tblusuario_ativo">
<span<?php echo $tblusuario->ativo->viewAttributes() ?>>
<?php echo $tblusuario->ativo->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tblusuario->nivel->Visible) { // nivel ?>
		<td<?php echo $tblusuario->nivel->cellAttributes() ?>>
<span id="el<?php echo $tblusuario_delete->RowCnt ?>_tblusuario_nivel" class="tblusuario_nivel">
<span<?php echo $tblusuario->nivel->viewAttributes() ?>>
<?php echo $tblusuario->nivel->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$tblusuario_delete->Recordset->moveNext();
}
$tblusuario_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $tblusuario_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$tblusuario_delete->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$tblusuario_delete->terminate();
?>