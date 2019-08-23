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
$tblclientes_list = new tblclientes_list();

// Run the page
$tblclientes_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tblclientes_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$tblclientes->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var ftblclienteslist = currentForm = new ew.Form("ftblclienteslist", "list");
ftblclienteslist.formKeyCountName = '<?php echo $tblclientes_list->FormKeyCountName ?>';

// Form_CustomValidate event
ftblclienteslist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftblclienteslist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

var ftblclienteslistsrch = currentSearchForm = new ew.Form("ftblclienteslistsrch");

// Filters
ftblclienteslistsrch.filterList = <?php echo $tblclientes_list->getFilterList() ?>;
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$tblclientes->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($tblclientes_list->TotalRecs > 0 && $tblclientes_list->ExportOptions->visible()) { ?>
<?php $tblclientes_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($tblclientes_list->ImportOptions->visible()) { ?>
<?php $tblclientes_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($tblclientes_list->SearchOptions->visible()) { ?>
<?php $tblclientes_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($tblclientes_list->FilterOptions->visible()) { ?>
<?php $tblclientes_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$tblclientes_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$tblclientes->isExport() && !$tblclientes->CurrentAction) { ?>
<form name="ftblclienteslistsrch" id="ftblclienteslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($tblclientes_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="ftblclienteslistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="tblclientes">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($tblclientes_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($tblclientes_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $tblclientes_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($tblclientes_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($tblclientes_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($tblclientes_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($tblclientes_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $tblclientes_list->showPageHeader(); ?>
<?php
$tblclientes_list->showMessage();
?>
<?php if ($tblclientes_list->TotalRecs > 0 || $tblclientes->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($tblclientes_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> tblclientes">
<form name="ftblclienteslist" id="ftblclienteslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($tblclientes_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $tblclientes_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tblclientes">
<div id="gmp_tblclientes" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($tblclientes_list->TotalRecs > 0 || $tblclientes->isGridEdit()) { ?>
<table id="tbl_tblclienteslist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$tblclientes_list->RowType = ROWTYPE_HEADER;

// Render list options
$tblclientes_list->renderListOptions();

// Render list options (header, left)
$tblclientes_list->ListOptions->render("header", "left");
?>
<?php if ($tblclientes->id->Visible) { // id ?>
	<?php if ($tblclientes->sortUrl($tblclientes->id) == "") { ?>
		<th data-name="id" class="<?php echo $tblclientes->id->headerCellClass() ?>"><div id="elh_tblclientes_id" class="tblclientes_id"><div class="ew-table-header-caption"><?php echo $tblclientes->id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id" class="<?php echo $tblclientes->id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tblclientes->SortUrl($tblclientes->id) ?>',1);"><div id="elh_tblclientes_id" class="tblclientes_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tblclientes->id->caption() ?></span><span class="ew-table-header-sort"><?php if ($tblclientes->id->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tblclientes->id->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tblclientes->nome->Visible) { // nome ?>
	<?php if ($tblclientes->sortUrl($tblclientes->nome) == "") { ?>
		<th data-name="nome" class="<?php echo $tblclientes->nome->headerCellClass() ?>"><div id="elh_tblclientes_nome" class="tblclientes_nome"><div class="ew-table-header-caption"><?php echo $tblclientes->nome->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nome" class="<?php echo $tblclientes->nome->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tblclientes->SortUrl($tblclientes->nome) ?>',1);"><div id="elh_tblclientes_nome" class="tblclientes_nome">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tblclientes->nome->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($tblclientes->nome->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tblclientes->nome->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tblclientes->cpf_cnpj->Visible) { // cpf_cnpj ?>
	<?php if ($tblclientes->sortUrl($tblclientes->cpf_cnpj) == "") { ?>
		<th data-name="cpf_cnpj" class="<?php echo $tblclientes->cpf_cnpj->headerCellClass() ?>"><div id="elh_tblclientes_cpf_cnpj" class="tblclientes_cpf_cnpj"><div class="ew-table-header-caption"><?php echo $tblclientes->cpf_cnpj->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="cpf_cnpj" class="<?php echo $tblclientes->cpf_cnpj->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tblclientes->SortUrl($tblclientes->cpf_cnpj) ?>',1);"><div id="elh_tblclientes_cpf_cnpj" class="tblclientes_cpf_cnpj">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tblclientes->cpf_cnpj->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($tblclientes->cpf_cnpj->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tblclientes->cpf_cnpj->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tblclientes->endereco->Visible) { // endereco ?>
	<?php if ($tblclientes->sortUrl($tblclientes->endereco) == "") { ?>
		<th data-name="endereco" class="<?php echo $tblclientes->endereco->headerCellClass() ?>"><div id="elh_tblclientes_endereco" class="tblclientes_endereco"><div class="ew-table-header-caption"><?php echo $tblclientes->endereco->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="endereco" class="<?php echo $tblclientes->endereco->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tblclientes->SortUrl($tblclientes->endereco) ?>',1);"><div id="elh_tblclientes_endereco" class="tblclientes_endereco">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tblclientes->endereco->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($tblclientes->endereco->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tblclientes->endereco->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tblclientes->cep->Visible) { // cep ?>
	<?php if ($tblclientes->sortUrl($tblclientes->cep) == "") { ?>
		<th data-name="cep" class="<?php echo $tblclientes->cep->headerCellClass() ?>"><div id="elh_tblclientes_cep" class="tblclientes_cep"><div class="ew-table-header-caption"><?php echo $tblclientes->cep->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="cep" class="<?php echo $tblclientes->cep->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tblclientes->SortUrl($tblclientes->cep) ?>',1);"><div id="elh_tblclientes_cep" class="tblclientes_cep">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tblclientes->cep->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($tblclientes->cep->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tblclientes->cep->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tblclientes->telefone->Visible) { // telefone ?>
	<?php if ($tblclientes->sortUrl($tblclientes->telefone) == "") { ?>
		<th data-name="telefone" class="<?php echo $tblclientes->telefone->headerCellClass() ?>"><div id="elh_tblclientes_telefone" class="tblclientes_telefone"><div class="ew-table-header-caption"><?php echo $tblclientes->telefone->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="telefone" class="<?php echo $tblclientes->telefone->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tblclientes->SortUrl($tblclientes->telefone) ?>',1);"><div id="elh_tblclientes_telefone" class="tblclientes_telefone">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tblclientes->telefone->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($tblclientes->telefone->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tblclientes->telefone->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$tblclientes_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($tblclientes->ExportAll && $tblclientes->isExport()) {
	$tblclientes_list->StopRec = $tblclientes_list->TotalRecs;
} else {

	// Set the last record to display
	if ($tblclientes_list->TotalRecs > $tblclientes_list->StartRec + $tblclientes_list->DisplayRecs - 1)
		$tblclientes_list->StopRec = $tblclientes_list->StartRec + $tblclientes_list->DisplayRecs - 1;
	else
		$tblclientes_list->StopRec = $tblclientes_list->TotalRecs;
}
$tblclientes_list->RecCnt = $tblclientes_list->StartRec - 1;
if ($tblclientes_list->Recordset && !$tblclientes_list->Recordset->EOF) {
	$tblclientes_list->Recordset->moveFirst();
	$selectLimit = $tblclientes_list->UseSelectLimit;
	if (!$selectLimit && $tblclientes_list->StartRec > 1)
		$tblclientes_list->Recordset->move($tblclientes_list->StartRec - 1);
} elseif (!$tblclientes->AllowAddDeleteRow && $tblclientes_list->StopRec == 0) {
	$tblclientes_list->StopRec = $tblclientes->GridAddRowCount;
}

// Initialize aggregate
$tblclientes->RowType = ROWTYPE_AGGREGATEINIT;
$tblclientes->resetAttributes();
$tblclientes_list->renderRow();
while ($tblclientes_list->RecCnt < $tblclientes_list->StopRec) {
	$tblclientes_list->RecCnt++;
	if ($tblclientes_list->RecCnt >= $tblclientes_list->StartRec) {
		$tblclientes_list->RowCnt++;

		// Set up key count
		$tblclientes_list->KeyCount = $tblclientes_list->RowIndex;

		// Init row class and style
		$tblclientes->resetAttributes();
		$tblclientes->CssClass = "";
		if ($tblclientes->isGridAdd()) {
		} else {
			$tblclientes_list->loadRowValues($tblclientes_list->Recordset); // Load row values
		}
		$tblclientes->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$tblclientes->RowAttrs = array_merge($tblclientes->RowAttrs, array('data-rowindex'=>$tblclientes_list->RowCnt, 'id'=>'r' . $tblclientes_list->RowCnt . '_tblclientes', 'data-rowtype'=>$tblclientes->RowType));

		// Render row
		$tblclientes_list->renderRow();

		// Render list options
		$tblclientes_list->renderListOptions();
?>
	<tr<?php echo $tblclientes->rowAttributes() ?>>
<?php

// Render list options (body, left)
$tblclientes_list->ListOptions->render("body", "left", $tblclientes_list->RowCnt);
?>
	<?php if ($tblclientes->id->Visible) { // id ?>
		<td data-name="id"<?php echo $tblclientes->id->cellAttributes() ?>>
<span id="el<?php echo $tblclientes_list->RowCnt ?>_tblclientes_id" class="tblclientes_id">
<span<?php echo $tblclientes->id->viewAttributes() ?>>
<?php echo $tblclientes->id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tblclientes->nome->Visible) { // nome ?>
		<td data-name="nome"<?php echo $tblclientes->nome->cellAttributes() ?>>
<span id="el<?php echo $tblclientes_list->RowCnt ?>_tblclientes_nome" class="tblclientes_nome">
<span<?php echo $tblclientes->nome->viewAttributes() ?>>
<?php echo $tblclientes->nome->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tblclientes->cpf_cnpj->Visible) { // cpf_cnpj ?>
		<td data-name="cpf_cnpj"<?php echo $tblclientes->cpf_cnpj->cellAttributes() ?>>
<span id="el<?php echo $tblclientes_list->RowCnt ?>_tblclientes_cpf_cnpj" class="tblclientes_cpf_cnpj">
<span<?php echo $tblclientes->cpf_cnpj->viewAttributes() ?>>
<?php echo $tblclientes->cpf_cnpj->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tblclientes->endereco->Visible) { // endereco ?>
		<td data-name="endereco"<?php echo $tblclientes->endereco->cellAttributes() ?>>
<span id="el<?php echo $tblclientes_list->RowCnt ?>_tblclientes_endereco" class="tblclientes_endereco">
<span<?php echo $tblclientes->endereco->viewAttributes() ?>>
<?php echo $tblclientes->endereco->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tblclientes->cep->Visible) { // cep ?>
		<td data-name="cep"<?php echo $tblclientes->cep->cellAttributes() ?>>
<span id="el<?php echo $tblclientes_list->RowCnt ?>_tblclientes_cep" class="tblclientes_cep">
<span<?php echo $tblclientes->cep->viewAttributes() ?>>
<?php echo $tblclientes->cep->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tblclientes->telefone->Visible) { // telefone ?>
		<td data-name="telefone"<?php echo $tblclientes->telefone->cellAttributes() ?>>
<span id="el<?php echo $tblclientes_list->RowCnt ?>_tblclientes_telefone" class="tblclientes_telefone">
<span<?php echo $tblclientes->telefone->viewAttributes() ?>>
<?php echo $tblclientes->telefone->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$tblclientes_list->ListOptions->render("body", "right", $tblclientes_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$tblclientes->isGridAdd())
		$tblclientes_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$tblclientes->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($tblclientes_list->Recordset)
	$tblclientes_list->Recordset->Close();
?>
<?php if (!$tblclientes->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$tblclientes->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($tblclientes_list->Pager)) $tblclientes_list->Pager = new PrevNextPager($tblclientes_list->StartRec, $tblclientes_list->DisplayRecs, $tblclientes_list->TotalRecs, $tblclientes_list->AutoHidePager) ?>
<?php if ($tblclientes_list->Pager->RecordCount > 0 && $tblclientes_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($tblclientes_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $tblclientes_list->pageUrl() ?>start=<?php echo $tblclientes_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($tblclientes_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $tblclientes_list->pageUrl() ?>start=<?php echo $tblclientes_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $tblclientes_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($tblclientes_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $tblclientes_list->pageUrl() ?>start=<?php echo $tblclientes_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($tblclientes_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $tblclientes_list->pageUrl() ?>start=<?php echo $tblclientes_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $tblclientes_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($tblclientes_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $tblclientes_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $tblclientes_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $tblclientes_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $tblclientes_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($tblclientes_list->TotalRecs == 0 && !$tblclientes->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $tblclientes_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$tblclientes_list->showPageFooter();
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
$tblclientes_list->terminate();
?>