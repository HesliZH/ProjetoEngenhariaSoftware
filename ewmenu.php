<?php
namespace PHPMaker2019\project1;

// Menu Language
if ($Language && $Language->LanguageFolder == $LANGUAGE_FOLDER)
	$MenuLanguage = &$Language;
else
	$MenuLanguage = new Language();

// Navbar menu
$topMenu = new Menu("navbar", TRUE, TRUE);
echo $topMenu->toScript();

// Sidebar menu
$sideMenu = new Menu("menu", TRUE, FALSE);
$sideMenu->addMenuItem(5, "mci_Cadastros", $MenuLanguage->MenuPhrase("5", "MenuText"), "", -1, "", IsLoggedIn(), FALSE, TRUE, "", "", FALSE);
$sideMenu->addMenuItem(1, "mi_tblprodutos", $MenuLanguage->MenuPhrase("1", "MenuText"), "tblprodutoslist.php", 5, "", IsLoggedIn() || AllowListMenu('{651BD1C9-A9FD-4A9D-B583-0C9BB2622709}tblprodutos'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(2, "mi_tblclientes", $MenuLanguage->MenuPhrase("2", "MenuText"), "tblclienteslist.php", 5, "", IsLoggedIn() || AllowListMenu('{651BD1C9-A9FD-4A9D-B583-0C9BB2622709}tblclientes'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(3, "mi_tblusuario", $MenuLanguage->MenuPhrase("3", "MenuText"), "tblusuariolist.php", 5, "", IsLoggedIn() || AllowListMenu('{651BD1C9-A9FD-4A9D-B583-0C9BB2622709}tblusuario'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(9, "mci_Relatórios", $MenuLanguage->MenuPhrase("9", "MenuText"), "", -1, "", IsLoggedIn(), FALSE, TRUE, "", "", FALSE);
echo $sideMenu->toScript();
?>