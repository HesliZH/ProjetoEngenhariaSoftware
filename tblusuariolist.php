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
$tblusuario_list = new tblusuario_list();

// Run the page
$tblusuario_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tblusuario_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$tblusuario->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var ftblusuariolist = currentForm = new ew.Form("ftblusuariolist", "list");
ftblusuariolist.formKeyCountName = '<?php echo $tblusuario_list->FormKeyCountName ?>';

// Form_CustomValidate event
ftblusuariolist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftblusuariolist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

var ftblusuariolistsrch = currentSearchForm = new ew.Form("ftblusuariolistsrch");

// Filters
ftblusuariolistsrch.filterList = <?php echo $tblusuario_list->getFilterList() ?>;
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$tblusuario->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($tblusuario_list->TotalRecs > 0 && $tblusuario_list->ExportOptions->visible()) { ?>
<?php $tblusuario_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($tblusuario_list->ImportOptions->visible()) { ?>
<?php $tblusuario_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($tblusuario_list->SearchOptions->visible()) { ?>
<?php $tblusuario_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($tblusuario_list->FilterOptions->visible()) { ?>
<?php $tblusuario_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$tblusuario_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$tblusuario->isExport() && !$tblusuario->CurrentAction) { ?>
<form name="ftblusuariolistsrch" id="ftblusuariolistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($tblusuario_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="ftblusuariolistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="tblusuario">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($tblusuario_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($tblusuario_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $tblusuario_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($tblusuario_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($tblusuario_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($tblusuario_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($tblusuario_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $tblusuario_list->showPageHeader(); ?>
<?php
$tblusuario_list->showMessage();
?>
<?php if ($tblusuario_list->TotalRecs > 0 || $tblusuario->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($tblusuario_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> tblusuario">
<form name="ftblusuariolist" id="ftblusuariolist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($tblusuario_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $tblusuario_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tblusuario">
<div id="gmp_tblusuario" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($tblusuario_list->TotalRecs > 0 || $tblusuario->isGridEdit()) { ?>
<table id="tbl_tblusuariolist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$tblusuario_list->RowType = ROWTYPE_HEADER;

// Render list options
$tblusuario_list->renderListOptions();

// Render list options (header, left)
$tblusuario_list->ListOptions->render("header", "left");
?>
<?php if ($tblusuario->id->Visible) { // id ?>
	<?php if ($tblusuario->sortUrl($tblusuario->id) == "") { ?>
		<th data-name="id" class="<?php echo $tblusuario->id->headerCellClass() ?>"><div id="elh_tblusuario_id" class="tblusuario_id"><div class="ew-table-header-caption"><?php echo $tblusuario->id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id" class="<?php echo $tblusuario->id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tblusuario->SortUrl($tblusuario->id) ?>',1);"><div id="elh_tblusuario_id" class="tblusuario_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tblusuario->id->caption() ?></span><span class="ew-table-header-sort"><?php if ($tblusuario->id->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tblusuario->id->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tblusuario->nome->Visible) { // nome ?>
	<?php if ($tblusuario->sortUrl($tblusuario->nome) == "") { ?>
		<th data-name="nome" class="<?php echo $tblusuario->nome->headerCellClass() ?>"><div id="elh_tblusuario_nome" class="tblusuario_nome"><div class="ew-table-header-caption"><?php echo $tblusuario->nome->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nome" class="<?php echo $tblusuario->nome->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tblusuario->SortUrl($tblusuario->nome) ?>',1);"><div id="elh_tblusuario_nome" class="tblusuario_nome">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tblusuario->nome->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($tblusuario->nome->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tblusuario->nome->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tblusuario->usuario->Visible) { // usuario ?>
	<?php if ($tblusuario->sortUrl($tblusuario->usuario) == "") { ?>
		<th data-name="usuario" class="<?php echo $tblusuario->usuario->headerCellClass() ?>"><div id="elh_tblusuario_usuario" class="tblusuario_usuario"><div class="ew-table-header-caption"><?php echo $tblusuario->usuario->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="usuario" class="<?php echo $tblusuario->usuario->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tblusuario->SortUrl($tblusuario->usuario) ?>',1);"><div id="elh_tblusuario_usuario" class="tblusuario_usuario">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tblusuario->usuario->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($tblusuario->usuario->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tblusuario->usuario->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tblusuario->senha->Visible) { // senha ?>
	<?php if ($tblusuario->sortUrl($tblusuario->senha) == "") { ?>
		<th data-name="senha" class="<?php echo $tblusuario->senha->headerCellClass() ?>"><div id="elh_tblusuario_senha" class="tblusuario_senha"><div class="ew-table-header-caption"><?php echo $tblusuario->senha->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="senha" class="<?php echo $tblusuario->senha->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tblusuario->SortUrl($tblusuario->senha) ?>',1);"><div id="elh_tblusuario_senha" class="tblusuario_senha">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tblusuario->senha->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($tblusuario->senha->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tblusuario->senha->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tblusuario->ativo->Visible) { // ativo ?>
	<?php if ($tblusuario->sortUrl($tblusuario->ativo) == "") { ?>
		<th data-name="ativo" class="<?php echo $tblusuario->ativo->headerCellClass() ?>"><div id="elh_tblusuario_ativo" class="tblusuario_ativo"><div class="ew-table-header-caption"><?php echo $tblusuario->ativo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ativo" class="<?php echo $tblusuario->ativo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tblusuario->SortUrl($tblusuario->ativo) ?>',1);"><div id="elh_tblusuario_ativo" class="tblusuario_ativo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tblusuario->ativo->caption() ?></span><span class="ew-table-header-sort"><?php if ($tblusuario->ativo->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tblusuario->ativo->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tblusuario->nivel->Visible) { // nivel ?>
	<?php if ($tblusuario->sortUrl($tblusuario->nivel) == "") { ?>
		<th data-name="nivel" class="<?php echo $tblusuario->nivel->headerCellClass() ?>"><div id="elh_tblusuario_nivel" class="tblusuario_nivel"><div class="ew-table-header-caption"><?php echo $tblusuario->nivel->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nivel" class="<?php echo $tblusuario->nivel->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tblusuario->SortUrl($tblusuario->nivel) ?>',1);"><div id="elh_tblusuario_nivel" class="tblusuario_nivel">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tblusuario->nivel->caption() ?></span><span class="ew-table-header-sort"><?php if ($tblusuario->nivel->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tblusuario->nivel->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$tblusuario_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($tblusuario->ExportAll && $tblusuario->isExport()) {
	$tblusuario_list->StopRec = $tblusuario_list->TotalRecs;
} else {

	// Set the last record to display
	if ($tblusuario_list->TotalRecs > $tblusuario_list->StartRec + $tblusuario_list->DisplayRecs - 1)
		$tblusuario_list->StopRec = $tblusuario_list->StartRec + $tblusuario_list->DisplayRecs - 1;
	else
		$tblusuario_list->StopRec = $tblusuario_list->TotalRecs;
}
$tblusuario_list->RecCnt = $tblusuario_list->StartRec - 1;
if ($tblusuario_list->Recordset && !$tblusuario_list->Recordset->EOF) {
	$tblusuario_list->Recordset->moveFirst();
	$selectLimit = $tblusuario_list->UseSelectLimit;
	if (!$selectLimit && $tblusuario_list->StartRec > 1)
		$tblusuario_list->Recordset->move($tblusuario_list->StartRec - 1);
} elseif (!$tblusuario->AllowAddDeleteRow && $tblusuario_list->StopRec == 0) {
	$tblusuario_list->StopRec = $tblusuario->GridAddRowCount;
}

// Initialize aggregate
$tblusuario->RowType = ROWTYPE_AGGREGATEINIT;
$tblusuario->resetAttributes();
$tblusuario_list->renderRow();
while ($tblusuario_list->RecCnt < $tblusuario_list->StopRec) {
	$tblusuario_list->RecCnt++;
	if ($tblusuario_list->RecCnt >= $tblusuario_list->StartRec) {
		$tblusuario_list->RowCnt++;

		// Set up key count
		$tblusuario_list->KeyCount = $tblusuario_list->RowIndex;

		// Init row class and style
		$tblusuario->resetAttributes();
		$tblusuario->CssClass = "";
		if ($tblusuario->isGridAdd()) {
		} else {
			$tblusuario_list->loadRowValues($tblusuario_list->Recordset); // Load row values
		}
		$tblusuario->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$tblusuario->RowAttrs = array_merge($tblusuario->RowAttrs, array('data-rowindex'=>$tblusuario_list->RowCnt, 'id'=>'r' . $tblusuario_list->RowCnt . '_tblusuario', 'data-rowtype'=>$tblusuario->RowType));

		// Render row
		$tblusuario_list->renderRow();

		// Render list options
		$tblusuario_list->renderListOptions();
?>
	<tr<?php echo $tblusuario->rowAttributes() ?>>
<?php

// Render list options (body, left)
$tblusuario_list->ListOptions->render("body", "left", $tblusuario_list->RowCnt);
?>
	<?php if ($tblusuario->id->Visible) { // id ?>
		<td data-name="id"<?php echo $tblusuario->id->cellAttributes() ?>>
<span id="el<?php echo $tblusuario_list->RowCnt ?>_tblusuario_id" class="tblusuario_id">
<span<?php echo $tblusuario->id->viewAttributes() ?>>
<?php echo $tblusuario->id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tblusuario->nome->Visible) { // nome ?>
		<td data-name="nome"<?php echo $tblusuario->nome->cellAttributes() ?>>
<span id="el<?php echo $tblusuario_list->RowCnt ?>_tblusuario_nome" class="tblusuario_nome">
<span<?php echo $tblusuario->nome->viewAttributes() ?>>
<?php echo $tblusuario->nome->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tblusuario->usuario->Visible) { // usuario ?>
		<td data-name="usuario"<?php echo $tblusuario->usuario->cellAttributes() ?>>
<span id="el<?php echo $tblusuario_list->RowCnt ?>_tblusuario_usuario" class="tblusuario_usuario">
<span<?php echo $tblusuario->usuario->viewAttributes() ?>>
<?php echo $tblusuario->usuario->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tblusuario->senha->Visible) { // senha ?>
		<td data-name="senha"<?php echo $tblusuario->senha->cellAttributes() ?>>
<span id="el<?php echo $tblusuario_list->RowCnt ?>_tblusuario_senha" class="tblusuario_senha">
<span<?php echo $tblusuario->senha->viewAttributes() ?>>
<?php echo $tblusuario->senha->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tblusuario->ativo->Visible) { // ativo ?>
		<td data-name="ativo"<?php echo $tblusuario->ativo->cellAttributes() ?>>
<span id="el<?php echo $tblusuario_list->RowCnt ?>_tblusuario_ativo" class="tblusuario_ativo">
<span<?php echo $tblusuario->ativo->viewAttributes() ?>>
<?php echo $tblusuario->ativo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tblusuario->nivel->Visible) { // nivel ?>
		<td data-name="nivel"<?php echo $tblusuario->nivel->cellAttributes() ?>>
<span id="el<?php echo $tblusuario_list->RowCnt ?>_tblusuario_nivel" class="tblusuario_nivel">
<span<?php echo $tblusuario->nivel->viewAttributes() ?>>
<?php echo $tblusuario->nivel->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$tblusuario_list->ListOptions->render("body", "right", $tblusuario_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$tblusuario->isGridAdd())
		$tblusuario_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$tblusuario->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($tblusuario_list->Recordset)
	$tblusuario_list->Recordset->Close();
?>
<?php if (!$tblusuario->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$tblusuario->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($tblusuario_list->Pager)) $tblusuario_list->Pager = new PrevNextPager($tblusuario_list->StartRec, $tblusuario_list->DisplayRecs, $tblusuario_list->TotalRecs, $tblusuario_list->AutoHidePager) ?>
<?php if ($tblusuario_list->Pager->RecordCount > 0 && $tblusuario_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($tblusuario_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $tblusuario_list->pageUrl() ?>start=<?php echo $tblusuario_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($tblusuario_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $tblusuario_list->pageUrl() ?>start=<?php echo $tblusuario_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $tblusuario_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($tblusuario_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $tblusuario_list->pageUrl() ?>start=<?php echo $tblusuario_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($tblusuario_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $tblusuario_list->pageUrl() ?>start=<?php echo $tblusuario_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $tblusuario_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($tblusuario_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $tblusuario_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $tblusuario_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $tblusuario_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $tblusuario_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($tblusuario_list->TotalRecs == 0 && !$tblusuario->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $tblusuario_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$tblusuario_list->showPageFooter();
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
$tblusuario_list->terminate();
?>