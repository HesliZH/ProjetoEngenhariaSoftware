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
$tblprodutos_list = new tblprodutos_list();

// Run the page
$tblprodutos_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tblprodutos_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$tblprodutos->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var ftblprodutoslist = currentForm = new ew.Form("ftblprodutoslist", "list");
ftblprodutoslist.formKeyCountName = '<?php echo $tblprodutos_list->FormKeyCountName ?>';

// Form_CustomValidate event
ftblprodutoslist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftblprodutoslist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

var ftblprodutoslistsrch = currentSearchForm = new ew.Form("ftblprodutoslistsrch");

// Filters
ftblprodutoslistsrch.filterList = <?php echo $tblprodutos_list->getFilterList() ?>;
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$tblprodutos->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($tblprodutos_list->TotalRecs > 0 && $tblprodutos_list->ExportOptions->visible()) { ?>
<?php $tblprodutos_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($tblprodutos_list->ImportOptions->visible()) { ?>
<?php $tblprodutos_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($tblprodutos_list->SearchOptions->visible()) { ?>
<?php $tblprodutos_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($tblprodutos_list->FilterOptions->visible()) { ?>
<?php $tblprodutos_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$tblprodutos_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$tblprodutos->isExport() && !$tblprodutos->CurrentAction) { ?>
<form name="ftblprodutoslistsrch" id="ftblprodutoslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($tblprodutos_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="ftblprodutoslistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="tblprodutos">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($tblprodutos_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($tblprodutos_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $tblprodutos_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($tblprodutos_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($tblprodutos_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($tblprodutos_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($tblprodutos_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $tblprodutos_list->showPageHeader(); ?>
<?php
$tblprodutos_list->showMessage();
?>
<?php if ($tblprodutos_list->TotalRecs > 0 || $tblprodutos->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($tblprodutos_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> tblprodutos">
<form name="ftblprodutoslist" id="ftblprodutoslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($tblprodutos_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $tblprodutos_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tblprodutos">
<div id="gmp_tblprodutos" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($tblprodutos_list->TotalRecs > 0 || $tblprodutos->isGridEdit()) { ?>
<table id="tbl_tblprodutoslist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$tblprodutos_list->RowType = ROWTYPE_HEADER;

// Render list options
$tblprodutos_list->renderListOptions();

// Render list options (header, left)
$tblprodutos_list->ListOptions->render("header", "left");
?>
<?php if ($tblprodutos->id->Visible) { // id ?>
	<?php if ($tblprodutos->sortUrl($tblprodutos->id) == "") { ?>
		<th data-name="id" class="<?php echo $tblprodutos->id->headerCellClass() ?>"><div id="elh_tblprodutos_id" class="tblprodutos_id"><div class="ew-table-header-caption"><?php echo $tblprodutos->id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id" class="<?php echo $tblprodutos->id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tblprodutos->SortUrl($tblprodutos->id) ?>',1);"><div id="elh_tblprodutos_id" class="tblprodutos_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tblprodutos->id->caption() ?></span><span class="ew-table-header-sort"><?php if ($tblprodutos->id->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tblprodutos->id->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tblprodutos->descricao->Visible) { // descricao ?>
	<?php if ($tblprodutos->sortUrl($tblprodutos->descricao) == "") { ?>
		<th data-name="descricao" class="<?php echo $tblprodutos->descricao->headerCellClass() ?>"><div id="elh_tblprodutos_descricao" class="tblprodutos_descricao"><div class="ew-table-header-caption"><?php echo $tblprodutos->descricao->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="descricao" class="<?php echo $tblprodutos->descricao->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tblprodutos->SortUrl($tblprodutos->descricao) ?>',1);"><div id="elh_tblprodutos_descricao" class="tblprodutos_descricao">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tblprodutos->descricao->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($tblprodutos->descricao->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tblprodutos->descricao->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tblprodutos->custo_real->Visible) { // custo_real ?>
	<?php if ($tblprodutos->sortUrl($tblprodutos->custo_real) == "") { ?>
		<th data-name="custo_real" class="<?php echo $tblprodutos->custo_real->headerCellClass() ?>"><div id="elh_tblprodutos_custo_real" class="tblprodutos_custo_real"><div class="ew-table-header-caption"><?php echo $tblprodutos->custo_real->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="custo_real" class="<?php echo $tblprodutos->custo_real->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tblprodutos->SortUrl($tblprodutos->custo_real) ?>',1);"><div id="elh_tblprodutos_custo_real" class="tblprodutos_custo_real">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tblprodutos->custo_real->caption() ?></span><span class="ew-table-header-sort"><?php if ($tblprodutos->custo_real->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tblprodutos->custo_real->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tblprodutos->preco_venda->Visible) { // preco_venda ?>
	<?php if ($tblprodutos->sortUrl($tblprodutos->preco_venda) == "") { ?>
		<th data-name="preco_venda" class="<?php echo $tblprodutos->preco_venda->headerCellClass() ?>"><div id="elh_tblprodutos_preco_venda" class="tblprodutos_preco_venda"><div class="ew-table-header-caption"><?php echo $tblprodutos->preco_venda->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="preco_venda" class="<?php echo $tblprodutos->preco_venda->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tblprodutos->SortUrl($tblprodutos->preco_venda) ?>',1);"><div id="elh_tblprodutos_preco_venda" class="tblprodutos_preco_venda">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tblprodutos->preco_venda->caption() ?></span><span class="ew-table-header-sort"><?php if ($tblprodutos->preco_venda->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tblprodutos->preco_venda->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tblprodutos->qtd_estoque->Visible) { // qtd_estoque ?>
	<?php if ($tblprodutos->sortUrl($tblprodutos->qtd_estoque) == "") { ?>
		<th data-name="qtd_estoque" class="<?php echo $tblprodutos->qtd_estoque->headerCellClass() ?>"><div id="elh_tblprodutos_qtd_estoque" class="tblprodutos_qtd_estoque"><div class="ew-table-header-caption"><?php echo $tblprodutos->qtd_estoque->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="qtd_estoque" class="<?php echo $tblprodutos->qtd_estoque->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tblprodutos->SortUrl($tblprodutos->qtd_estoque) ?>',1);"><div id="elh_tblprodutos_qtd_estoque" class="tblprodutos_qtd_estoque">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tblprodutos->qtd_estoque->caption() ?></span><span class="ew-table-header-sort"><?php if ($tblprodutos->qtd_estoque->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tblprodutos->qtd_estoque->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tblprodutos->unidade->Visible) { // unidade ?>
	<?php if ($tblprodutos->sortUrl($tblprodutos->unidade) == "") { ?>
		<th data-name="unidade" class="<?php echo $tblprodutos->unidade->headerCellClass() ?>"><div id="elh_tblprodutos_unidade" class="tblprodutos_unidade"><div class="ew-table-header-caption"><?php echo $tblprodutos->unidade->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="unidade" class="<?php echo $tblprodutos->unidade->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tblprodutos->SortUrl($tblprodutos->unidade) ?>',1);"><div id="elh_tblprodutos_unidade" class="tblprodutos_unidade">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tblprodutos->unidade->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($tblprodutos->unidade->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tblprodutos->unidade->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$tblprodutos_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($tblprodutos->ExportAll && $tblprodutos->isExport()) {
	$tblprodutos_list->StopRec = $tblprodutos_list->TotalRecs;
} else {

	// Set the last record to display
	if ($tblprodutos_list->TotalRecs > $tblprodutos_list->StartRec + $tblprodutos_list->DisplayRecs - 1)
		$tblprodutos_list->StopRec = $tblprodutos_list->StartRec + $tblprodutos_list->DisplayRecs - 1;
	else
		$tblprodutos_list->StopRec = $tblprodutos_list->TotalRecs;
}
$tblprodutos_list->RecCnt = $tblprodutos_list->StartRec - 1;
if ($tblprodutos_list->Recordset && !$tblprodutos_list->Recordset->EOF) {
	$tblprodutos_list->Recordset->moveFirst();
	$selectLimit = $tblprodutos_list->UseSelectLimit;
	if (!$selectLimit && $tblprodutos_list->StartRec > 1)
		$tblprodutos_list->Recordset->move($tblprodutos_list->StartRec - 1);
} elseif (!$tblprodutos->AllowAddDeleteRow && $tblprodutos_list->StopRec == 0) {
	$tblprodutos_list->StopRec = $tblprodutos->GridAddRowCount;
}

// Initialize aggregate
$tblprodutos->RowType = ROWTYPE_AGGREGATEINIT;
$tblprodutos->resetAttributes();
$tblprodutos_list->renderRow();
while ($tblprodutos_list->RecCnt < $tblprodutos_list->StopRec) {
	$tblprodutos_list->RecCnt++;
	if ($tblprodutos_list->RecCnt >= $tblprodutos_list->StartRec) {
		$tblprodutos_list->RowCnt++;

		// Set up key count
		$tblprodutos_list->KeyCount = $tblprodutos_list->RowIndex;

		// Init row class and style
		$tblprodutos->resetAttributes();
		$tblprodutos->CssClass = "";
		if ($tblprodutos->isGridAdd()) {
		} else {
			$tblprodutos_list->loadRowValues($tblprodutos_list->Recordset); // Load row values
		}
		$tblprodutos->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$tblprodutos->RowAttrs = array_merge($tblprodutos->RowAttrs, array('data-rowindex'=>$tblprodutos_list->RowCnt, 'id'=>'r' . $tblprodutos_list->RowCnt . '_tblprodutos', 'data-rowtype'=>$tblprodutos->RowType));

		// Render row
		$tblprodutos_list->renderRow();

		// Render list options
		$tblprodutos_list->renderListOptions();
?>
	<tr<?php echo $tblprodutos->rowAttributes() ?>>
<?php

// Render list options (body, left)
$tblprodutos_list->ListOptions->render("body", "left", $tblprodutos_list->RowCnt);
?>
	<?php if ($tblprodutos->id->Visible) { // id ?>
		<td data-name="id"<?php echo $tblprodutos->id->cellAttributes() ?>>
<span id="el<?php echo $tblprodutos_list->RowCnt ?>_tblprodutos_id" class="tblprodutos_id">
<span<?php echo $tblprodutos->id->viewAttributes() ?>>
<?php echo $tblprodutos->id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tblprodutos->descricao->Visible) { // descricao ?>
		<td data-name="descricao"<?php echo $tblprodutos->descricao->cellAttributes() ?>>
<span id="el<?php echo $tblprodutos_list->RowCnt ?>_tblprodutos_descricao" class="tblprodutos_descricao">
<span<?php echo $tblprodutos->descricao->viewAttributes() ?>>
<?php echo $tblprodutos->descricao->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tblprodutos->custo_real->Visible) { // custo_real ?>
		<td data-name="custo_real"<?php echo $tblprodutos->custo_real->cellAttributes() ?>>
<span id="el<?php echo $tblprodutos_list->RowCnt ?>_tblprodutos_custo_real" class="tblprodutos_custo_real">
<span<?php echo $tblprodutos->custo_real->viewAttributes() ?>>
<?php echo $tblprodutos->custo_real->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tblprodutos->preco_venda->Visible) { // preco_venda ?>
		<td data-name="preco_venda"<?php echo $tblprodutos->preco_venda->cellAttributes() ?>>
<span id="el<?php echo $tblprodutos_list->RowCnt ?>_tblprodutos_preco_venda" class="tblprodutos_preco_venda">
<span<?php echo $tblprodutos->preco_venda->viewAttributes() ?>>
<?php echo $tblprodutos->preco_venda->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tblprodutos->qtd_estoque->Visible) { // qtd_estoque ?>
		<td data-name="qtd_estoque"<?php echo $tblprodutos->qtd_estoque->cellAttributes() ?>>
<span id="el<?php echo $tblprodutos_list->RowCnt ?>_tblprodutos_qtd_estoque" class="tblprodutos_qtd_estoque">
<span<?php echo $tblprodutos->qtd_estoque->viewAttributes() ?>>
<?php echo $tblprodutos->qtd_estoque->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tblprodutos->unidade->Visible) { // unidade ?>
		<td data-name="unidade"<?php echo $tblprodutos->unidade->cellAttributes() ?>>
<span id="el<?php echo $tblprodutos_list->RowCnt ?>_tblprodutos_unidade" class="tblprodutos_unidade">
<span<?php echo $tblprodutos->unidade->viewAttributes() ?>>
<?php echo $tblprodutos->unidade->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$tblprodutos_list->ListOptions->render("body", "right", $tblprodutos_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$tblprodutos->isGridAdd())
		$tblprodutos_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$tblprodutos->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($tblprodutos_list->Recordset)
	$tblprodutos_list->Recordset->Close();
?>
<?php if (!$tblprodutos->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$tblprodutos->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($tblprodutos_list->Pager)) $tblprodutos_list->Pager = new PrevNextPager($tblprodutos_list->StartRec, $tblprodutos_list->DisplayRecs, $tblprodutos_list->TotalRecs, $tblprodutos_list->AutoHidePager) ?>
<?php if ($tblprodutos_list->Pager->RecordCount > 0 && $tblprodutos_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($tblprodutos_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $tblprodutos_list->pageUrl() ?>start=<?php echo $tblprodutos_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($tblprodutos_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $tblprodutos_list->pageUrl() ?>start=<?php echo $tblprodutos_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $tblprodutos_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($tblprodutos_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $tblprodutos_list->pageUrl() ?>start=<?php echo $tblprodutos_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($tblprodutos_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $tblprodutos_list->pageUrl() ?>start=<?php echo $tblprodutos_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $tblprodutos_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($tblprodutos_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $tblprodutos_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $tblprodutos_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $tblprodutos_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $tblprodutos_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($tblprodutos_list->TotalRecs == 0 && !$tblprodutos->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $tblprodutos_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$tblprodutos_list->showPageFooter();
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
$tblprodutos_list->terminate();
?>