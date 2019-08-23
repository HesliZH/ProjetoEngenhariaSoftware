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
$Report1_report = new Report1_report();

// Run the page
$Report1_report->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$Report1_report->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$Report1->isExport()) { ?>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php
$Report1_report->RecCnt = 1; // No grouping
if ($Report1_report->DbDetailFilter <> "") {
	if ($Report1_report->ReportFilter <> "") $Report1_report->ReportFilter .= " AND ";
	$Report1_report->ReportFilter .= "(" . $Report1_report->DbDetailFilter . ")";
}
$ReportConn = &$Report1_report->getConnection();

// Set up detail SQL
$Report1->CurrentFilter = $Report1_report->ReportFilter;
$Report1_report->ReportSql = $Report1->getDetailSql();

// Load recordset
$Report1_report->Recordset = $ReportConn->Execute($Report1_report->ReportSql);
$Report1_report->RecordExists = !$Report1_report->Recordset->EOF;
?>
<?php if (!$Report1->isExport()) { ?>
<?php if ($Report1_report->RecordExists) { ?>
<div class="ew-view-export-options"><?php $Report1_report->ExportOptions->render("body") ?></div>
<?php } ?>
<?php } ?>
<?php $Report1_report->showPageHeader(); ?>
<table class="ew-report-table">
<?php

	// Get detail records
	$Report1_report->ReportFilter = $Report1_report->DefaultFilter;
	if ($Report1_report->DbDetailFilter <> "") {
		if ($Report1_report->ReportFilter <> "")
			$Report1_report->ReportFilter .= " AND ";
		$Report1_report->ReportFilter .= "(" . $Report1_report->DbDetailFilter . ")";
	}
	if (!$Security->canReport()) {
		if ($Report1_report->ReportFilter <> "")
			$Report1_report->ReportFilter .= " AND ";
		$Report1_report->ReportFilter .= "(0=1)";
	}

	// Set up detail SQL
	$Report1->CurrentFilter = $Report1_report->ReportFilter;
	$Report1_report->ReportSql = $Report1->getDetailSql();

	// Load detail records
	$Report1_report->DetailRecordset = $ReportConn->execute($Report1_report->ReportSql);
	$Report1_report->DtlRecordCount = $Report1_report->DetailRecordset->RecordCount();

	// Initialize aggregates
	if (!$Report1_report->DetailRecordset->EOF) {
		$Report1_report->RecCnt++;
	}
	if ($Report1_report->RecCnt == 1) {
		$Report1_report->ReportCounts[0] = 0;
	}
	$Report1_report->ReportCounts[0] += $Report1_report->DtlRecordCount;
	if ($Report1_report->RecordExists) {
?>
	<tr>
		<td class="ew-group-header"><?php echo $Report1->id->caption() ?></td>
		<td class="ew-group-header"><?php echo $Report1->descricao->caption() ?></td>
		<td class="ew-group-header"><?php echo $Report1->preco_venda->caption() ?></td>
	</tr>
<?php
	}
	while (!$Report1_report->DetailRecordset->EOF) {
		$Report1_report->RowCnt++;
		$Report1->id->setDbValue($Report1_report->DetailRecordset->fields('id'));
		$Report1->descricao->setDbValue($Report1_report->DetailRecordset->fields('descricao'));
		$Report1->preco_venda->setDbValue($Report1_report->DetailRecordset->fields('preco_venda'));

		// Render for view
		$Report1->RowType = ROWTYPE_VIEW;
		$Report1->resetAttributes();
		$Report1_report->renderRow();
?>
	<tr>
		<td<?php echo $Report1->id->cellAttributes() ?>>
<span<?php echo $Report1->id->viewAttributes() ?>>
<?php echo $Report1->id->getViewValue() ?></span>
</td>
		<td<?php echo $Report1->descricao->cellAttributes() ?>>
<span<?php echo $Report1->descricao->viewAttributes() ?>>
<?php echo $Report1->descricao->getViewValue() ?></span>
</td>
		<td<?php echo $Report1->preco_venda->cellAttributes() ?>>
<span<?php echo $Report1->preco_venda->viewAttributes() ?>>
<?php echo $Report1->preco_venda->getViewValue() ?></span>
</td>
	</tr>
<?php
		$Report1_report->DetailRecordset->moveNext();
	}
	$Report1_report->DetailRecordset->close();
?>
<?php if ($Report1_report->RecordExists) { ?>
	<tr><td colspan="3">&nbsp;<br></td></tr>
	<tr><td colspan="3" class="ew-grand-summary"><?php echo $Language->Phrase("RptGrandTotal") ?>&nbsp;(<?php echo FormatNumber($Report1_report->ReportCounts[0], 0) ?>&nbsp;<?php echo $Language->Phrase("RptDtlRec") ?>)</td></tr>
<?php } ?>
<?php if ($Report1_report->RecordExists) { ?>
	<tr><td colspan=3>&nbsp;<br></td></tr>
<?php } else { ?>
	<tr><td><?php echo $Language->phrase("NoRecord") ?></td></tr>
<?php } ?>
</table>
<?php
$Report1_report->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$Report1->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$Report1_report->terminate();
?>