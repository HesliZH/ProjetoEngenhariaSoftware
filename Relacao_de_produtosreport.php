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
$Relacao_de_produtos_report = new Relacao_de_produtos_report();

// Run the page
$Relacao_de_produtos_report->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$Relacao_de_produtos_report->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$Relacao_de_produtos->isExport()) { ?>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php
$Relacao_de_produtos_report->RecCnt = 1; // No grouping
if ($Relacao_de_produtos_report->DbDetailFilter <> "") {
	if ($Relacao_de_produtos_report->ReportFilter <> "") $Relacao_de_produtos_report->ReportFilter .= " AND ";
	$Relacao_de_produtos_report->ReportFilter .= "(" . $Relacao_de_produtos_report->DbDetailFilter . ")";
}
$ReportConn = &$Relacao_de_produtos_report->getConnection();

// Set up detail SQL
$Relacao_de_produtos->CurrentFilter = $Relacao_de_produtos_report->ReportFilter;
$Relacao_de_produtos_report->ReportSql = $Relacao_de_produtos->getDetailSql();

// Load recordset
$Relacao_de_produtos_report->Recordset = $ReportConn->Execute($Relacao_de_produtos_report->ReportSql);
$Relacao_de_produtos_report->RecordExists = !$Relacao_de_produtos_report->Recordset->EOF;
?>
<?php if (!$Relacao_de_produtos->isExport()) { ?>
<?php if ($Relacao_de_produtos_report->RecordExists) { ?>
<div class="ew-view-export-options"><?php $Relacao_de_produtos_report->ExportOptions->render("body") ?></div>
<?php } ?>
<?php } ?>
<?php $Relacao_de_produtos_report->showPageHeader(); ?>
<table class="ew-report-table">
<?php

	// Get detail records
	$Relacao_de_produtos_report->ReportFilter = $Relacao_de_produtos_report->DefaultFilter;
	if ($Relacao_de_produtos_report->DbDetailFilter <> "") {
		if ($Relacao_de_produtos_report->ReportFilter <> "")
			$Relacao_de_produtos_report->ReportFilter .= " AND ";
		$Relacao_de_produtos_report->ReportFilter .= "(" . $Relacao_de_produtos_report->DbDetailFilter . ")";
	}
	if (!$Security->canReport()) {
		if ($Relacao_de_produtos_report->ReportFilter <> "")
			$Relacao_de_produtos_report->ReportFilter .= " AND ";
		$Relacao_de_produtos_report->ReportFilter .= "(0=1)";
	}

	// Set up detail SQL
	$Relacao_de_produtos->CurrentFilter = $Relacao_de_produtos_report->ReportFilter;
	$Relacao_de_produtos_report->ReportSql = $Relacao_de_produtos->getDetailSql();

	// Load detail records
	$Relacao_de_produtos_report->DetailRecordset = $ReportConn->execute($Relacao_de_produtos_report->ReportSql);
	$Relacao_de_produtos_report->DtlRecordCount = $Relacao_de_produtos_report->DetailRecordset->RecordCount();

	// Initialize aggregates
	if (!$Relacao_de_produtos_report->DetailRecordset->EOF) {
		$Relacao_de_produtos_report->RecCnt++;
	}
	if ($Relacao_de_produtos_report->RecCnt == 1) {
		$Relacao_de_produtos_report->ReportCounts[0] = 0;
	}
	$Relacao_de_produtos_report->ReportCounts[0] += $Relacao_de_produtos_report->DtlRecordCount;
	if ($Relacao_de_produtos_report->RecordExists) {
?>
	<tr>
		<td class="ew-group-header"><?php echo $Relacao_de_produtos->id->caption() ?></td>
		<td class="ew-group-header"><?php echo $Relacao_de_produtos->descricao->caption() ?></td>
		<td class="ew-group-header"><?php echo $Relacao_de_produtos->preco_venda->caption() ?></td>
	</tr>
<?php
	}
	while (!$Relacao_de_produtos_report->DetailRecordset->EOF) {
		$Relacao_de_produtos_report->RowCnt++;
		$Relacao_de_produtos->id->setDbValue($Relacao_de_produtos_report->DetailRecordset->fields('id'));
		$Relacao_de_produtos->descricao->setDbValue($Relacao_de_produtos_report->DetailRecordset->fields('descricao'));
		$Relacao_de_produtos->preco_venda->setDbValue($Relacao_de_produtos_report->DetailRecordset->fields('preco_venda'));

		// Render for view
		$Relacao_de_produtos->RowType = ROWTYPE_VIEW;
		$Relacao_de_produtos->resetAttributes();
		$Relacao_de_produtos_report->renderRow();
?>
	<tr>
		<td<?php echo $Relacao_de_produtos->id->cellAttributes() ?>>
<span<?php echo $Relacao_de_produtos->id->viewAttributes() ?>>
<?php echo $Relacao_de_produtos->id->getViewValue() ?></span>
</td>
		<td<?php echo $Relacao_de_produtos->descricao->cellAttributes() ?>>
<span<?php echo $Relacao_de_produtos->descricao->viewAttributes() ?>>
<?php echo $Relacao_de_produtos->descricao->getViewValue() ?></span>
</td>
		<td<?php echo $Relacao_de_produtos->preco_venda->cellAttributes() ?>>
<span<?php echo $Relacao_de_produtos->preco_venda->viewAttributes() ?>>
<?php echo $Relacao_de_produtos->preco_venda->getViewValue() ?></span>
</td>
	</tr>
<?php
		$Relacao_de_produtos_report->DetailRecordset->moveNext();
	}
	$Relacao_de_produtos_report->DetailRecordset->close();
?>
<?php if ($Relacao_de_produtos_report->RecordExists) { ?>
	<tr><td colspan="3">&nbsp;<br></td></tr>
	<tr><td colspan="3" class="ew-grand-summary"><?php echo $Language->Phrase("RptGrandTotal") ?>&nbsp;(<?php echo FormatNumber($Relacao_de_produtos_report->ReportCounts[0], 0) ?>&nbsp;<?php echo $Language->Phrase("RptDtlRec") ?>)</td></tr>
<?php } ?>
<?php if ($Relacao_de_produtos_report->RecordExists) { ?>
	<tr><td colspan=3>&nbsp;<br></td></tr>
<?php } else { ?>
	<tr><td><?php echo $Language->phrase("NoRecord") ?></td></tr>
<?php } ?>
</table>
<?php
$Relacao_de_produtos_report->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$Relacao_de_produtos->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$Relacao_de_produtos_report->terminate();
?>