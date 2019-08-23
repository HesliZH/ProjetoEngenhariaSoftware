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
$tblusuario_view = new tblusuario_view();

// Run the page
$tblusuario_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tblusuario_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$tblusuario->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var ftblusuarioview = currentForm = new ew.Form("ftblusuarioview", "view");

// Form_CustomValidate event
ftblusuarioview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftblusuarioview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$tblusuario->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $tblusuario_view->ExportOptions->render("body") ?>
<?php $tblusuario_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $tblusuario_view->showPageHeader(); ?>
<?php
$tblusuario_view->showMessage();
?>
<form name="ftblusuarioview" id="ftblusuarioview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($tblusuario_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $tblusuario_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tblusuario">
<input type="hidden" name="modal" value="<?php echo (int)$tblusuario_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($tblusuario->id->Visible) { // id ?>
	<tr id="r_id">
		<td class="<?php echo $tblusuario_view->TableLeftColumnClass ?>"><span id="elh_tblusuario_id"><?php echo $tblusuario->id->caption() ?></span></td>
		<td data-name="id"<?php echo $tblusuario->id->cellAttributes() ?>>
<span id="el_tblusuario_id">
<span<?php echo $tblusuario->id->viewAttributes() ?>>
<?php echo $tblusuario->id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tblusuario->nome->Visible) { // nome ?>
	<tr id="r_nome">
		<td class="<?php echo $tblusuario_view->TableLeftColumnClass ?>"><span id="elh_tblusuario_nome"><?php echo $tblusuario->nome->caption() ?></span></td>
		<td data-name="nome"<?php echo $tblusuario->nome->cellAttributes() ?>>
<span id="el_tblusuario_nome">
<span<?php echo $tblusuario->nome->viewAttributes() ?>>
<?php echo $tblusuario->nome->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tblusuario->usuario->Visible) { // usuario ?>
	<tr id="r_usuario">
		<td class="<?php echo $tblusuario_view->TableLeftColumnClass ?>"><span id="elh_tblusuario_usuario"><?php echo $tblusuario->usuario->caption() ?></span></td>
		<td data-name="usuario"<?php echo $tblusuario->usuario->cellAttributes() ?>>
<span id="el_tblusuario_usuario">
<span<?php echo $tblusuario->usuario->viewAttributes() ?>>
<?php echo $tblusuario->usuario->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tblusuario->senha->Visible) { // senha ?>
	<tr id="r_senha">
		<td class="<?php echo $tblusuario_view->TableLeftColumnClass ?>"><span id="elh_tblusuario_senha"><?php echo $tblusuario->senha->caption() ?></span></td>
		<td data-name="senha"<?php echo $tblusuario->senha->cellAttributes() ?>>
<span id="el_tblusuario_senha">
<span<?php echo $tblusuario->senha->viewAttributes() ?>>
<?php echo $tblusuario->senha->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tblusuario->ativo->Visible) { // ativo ?>
	<tr id="r_ativo">
		<td class="<?php echo $tblusuario_view->TableLeftColumnClass ?>"><span id="elh_tblusuario_ativo"><?php echo $tblusuario->ativo->caption() ?></span></td>
		<td data-name="ativo"<?php echo $tblusuario->ativo->cellAttributes() ?>>
<span id="el_tblusuario_ativo">
<span<?php echo $tblusuario->ativo->viewAttributes() ?>>
<?php echo $tblusuario->ativo->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tblusuario->nivel->Visible) { // nivel ?>
	<tr id="r_nivel">
		<td class="<?php echo $tblusuario_view->TableLeftColumnClass ?>"><span id="elh_tblusuario_nivel"><?php echo $tblusuario->nivel->caption() ?></span></td>
		<td data-name="nivel"<?php echo $tblusuario->nivel->cellAttributes() ?>>
<span id="el_tblusuario_nivel">
<span<?php echo $tblusuario->nivel->viewAttributes() ?>>
<?php echo $tblusuario->nivel->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$tblusuario_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$tblusuario->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$tblusuario_view->terminate();
?>