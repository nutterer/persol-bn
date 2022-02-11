<?php

namespace PHPMaker2021\upPersonnelv2;

// Menu Language
if ($Language && function_exists(PROJECT_NAMESPACE . "Config") && $Language->LanguageFolder == Config("LANGUAGE_FOLDER")) {
    $MenuRelativePath = "";
    $MenuLanguage = &$Language;
} else { // Compat reports
    $LANGUAGE_FOLDER = "../lang/";
    $MenuRelativePath = "../";
    $MenuLanguage = Container("language");
}

// Navbar menu
$topMenu = new Menu("navbar", true, true);
echo $topMenu->toScript();

// Sidebar menu
$sideMenu = new Menu("menu", true, false);
$sideMenu->addMenuItem(1, "mi__01personnel", $MenuLanguage->MenuPhrase("1", "MenuText"), $MenuRelativePath . "_01personnelList", -1, "", IsLoggedIn() || AllowListMenu('{7E075067-9A8E-4402-9644-5EE07AF3E407}01-personnel'), false, false, "", "", false);
$sideMenu->addMenuItem(2, "mi__02selfdevelopment", $MenuLanguage->MenuPhrase("2", "MenuText"), $MenuRelativePath . "_02selfdevelopmentList", -1, "", IsLoggedIn() || AllowListMenu('{7E075067-9A8E-4402-9644-5EE07AF3E407}02-selfdevelopment'), false, false, "", "", false);
$sideMenu->addMenuItem(3, "mi__03academicranks", $MenuLanguage->MenuPhrase("3", "MenuText"), $MenuRelativePath . "_03academicranksList", -1, "", IsLoggedIn() || AllowListMenu('{7E075067-9A8E-4402-9644-5EE07AF3E407}03-academicranks'), false, false, "", "", false);
$sideMenu->addMenuItem(4, "mi__04personnelplan", $MenuLanguage->MenuPhrase("4", "MenuText"), $MenuRelativePath . "_04personnelplanList", -1, "", IsLoggedIn() || AllowListMenu('{7E075067-9A8E-4402-9644-5EE07AF3E407}04-personnelplan'), false, false, "", "", false);
$sideMenu->addMenuItem(5, "mi__05report", $MenuLanguage->MenuPhrase("5", "MenuText"), $MenuRelativePath . "_05reportList", -1, "", IsLoggedIn() || AllowListMenu('{7E075067-9A8E-4402-9644-5EE07AF3E407}05-report'), false, false, "", "", false);
$sideMenu->addMenuItem(6, "mi_academicbook", $MenuLanguage->MenuPhrase("6", "MenuText"), $MenuRelativePath . "AcademicbookList", -1, "", IsLoggedIn() || AllowListMenu('{7E075067-9A8E-4402-9644-5EE07AF3E407}academicbook'), false, false, "", "", false);
$sideMenu->addMenuItem(7, "mi_academicpublic", $MenuLanguage->MenuPhrase("7", "MenuText"), $MenuRelativePath . "AcademicpublicList", -1, "", IsLoggedIn() || AllowListMenu('{7E075067-9A8E-4402-9644-5EE07AF3E407}academicpublic'), false, false, "", "", false);
$sideMenu->addMenuItem(8, "mi_award", $MenuLanguage->MenuPhrase("8", "MenuText"), $MenuRelativePath . "AwardList", -1, "", IsLoggedIn() || AllowListMenu('{7E075067-9A8E-4402-9644-5EE07AF3E407}award'), false, false, "", "", false);
$sideMenu->addMenuItem(9, "mi_graduation", $MenuLanguage->MenuPhrase("9", "MenuText"), $MenuRelativePath . "GraduationList", -1, "", IsLoggedIn() || AllowListMenu('{7E075067-9A8E-4402-9644-5EE07AF3E407}graduation'), false, false, "", "", false);
$sideMenu->addMenuItem(10, "mi_studyleave", $MenuLanguage->MenuPhrase("10", "MenuText"), $MenuRelativePath . "StudyleaveList", -1, "", IsLoggedIn() || AllowListMenu('{7E075067-9A8E-4402-9644-5EE07AF3E407}studyleave'), false, false, "", "", false);
$sideMenu->addMenuItem(11, "mi_studyleavetype", $MenuLanguage->MenuPhrase("11", "MenuText"), $MenuRelativePath . "StudyleavetypeList", -1, "", IsLoggedIn() || AllowListMenu('{7E075067-9A8E-4402-9644-5EE07AF3E407}studyleavetype'), false, false, "", "", false);
$sideMenu->addMenuItem(12, "mi_users", $MenuLanguage->MenuPhrase("12", "MenuText"), $MenuRelativePath . "UsersList", -1, "", IsLoggedIn() || AllowListMenu('{7E075067-9A8E-4402-9644-5EE07AF3E407}users'), false, false, "", "", false);
$sideMenu->addMenuItem(13, "mi_per_academic", $MenuLanguage->MenuPhrase("13", "MenuText"), $MenuRelativePath . "PerAcademicList", -1, "", IsLoggedIn() || AllowListMenu('{7E075067-9A8E-4402-9644-5EE07AF3E407}per_academic'), false, false, "", "", false);
$sideMenu->addMenuItem(14, "mi_per_administrative", $MenuLanguage->MenuPhrase("14", "MenuText"), $MenuRelativePath . "PerAdministrativeList", -1, "", IsLoggedIn() || AllowListMenu('{7E075067-9A8E-4402-9644-5EE07AF3E407}per_administrative'), false, false, "", "", false);
$sideMenu->addMenuItem(15, "mi_per_employeetype", $MenuLanguage->MenuPhrase("15", "MenuText"), $MenuRelativePath . "PerEmployeetypeList", -1, "", IsLoggedIn() || AllowListMenu('{7E075067-9A8E-4402-9644-5EE07AF3E407}per_employeetype'), false, false, "", "", false);
$sideMenu->addMenuItem(16, "mi_per_nationality", $MenuLanguage->MenuPhrase("16", "MenuText"), $MenuRelativePath . "PerNationalityList", -1, "", IsLoggedIn() || AllowListMenu('{7E075067-9A8E-4402-9644-5EE07AF3E407}per_nationality'), false, false, "", "", false);
$sideMenu->addMenuItem(17, "mi_per_position", $MenuLanguage->MenuPhrase("17", "MenuText"), $MenuRelativePath . "PerPositionList", -1, "", IsLoggedIn() || AllowListMenu('{7E075067-9A8E-4402-9644-5EE07AF3E407}per_position'), false, false, "", "", false);
$sideMenu->addMenuItem(18, "mi_per_religion", $MenuLanguage->MenuPhrase("18", "MenuText"), $MenuRelativePath . "PerReligionList", -1, "", IsLoggedIn() || AllowListMenu('{7E075067-9A8E-4402-9644-5EE07AF3E407}per_religion'), false, false, "", "", false);
$sideMenu->addMenuItem(19, "mi_per_type", $MenuLanguage->MenuPhrase("19", "MenuText"), $MenuRelativePath . "PerTypeList", -1, "", IsLoggedIn() || AllowListMenu('{7E075067-9A8E-4402-9644-5EE07AF3E407}per_type'), false, false, "", "", false);
$sideMenu->addMenuItem(20, "mi_per_workstatus", $MenuLanguage->MenuPhrase("20", "MenuText"), $MenuRelativePath . "PerWorkstatusList", -1, "", IsLoggedIn() || AllowListMenu('{7E075067-9A8E-4402-9644-5EE07AF3E407}per_workstatus'), false, false, "", "", false);
$sideMenu->addMenuItem(21, "mi_selfdev_type", $MenuLanguage->MenuPhrase("21", "MenuText"), $MenuRelativePath . "SelfdevTypeList", -1, "", IsLoggedIn() || AllowListMenu('{7E075067-9A8E-4402-9644-5EE07AF3E407}selfdev_type'), false, false, "", "", false);
$sideMenu->addMenuItem(22, "mi_book_type", $MenuLanguage->MenuPhrase("22", "MenuText"), $MenuRelativePath . "BookTypeList", -1, "", IsLoggedIn() || AllowListMenu('{7E075067-9A8E-4402-9644-5EE07AF3E407}book_type'), false, false, "", "", false);
$sideMenu->addMenuItem(23, "mi_public_type", $MenuLanguage->MenuPhrase("23", "MenuText"), $MenuRelativePath . "PublicTypeList", -1, "", IsLoggedIn() || AllowListMenu('{7E075067-9A8E-4402-9644-5EE07AF3E407}public_type'), false, false, "", "", false);
$sideMenu->addMenuItem(24, "mi_grad_admission", $MenuLanguage->MenuPhrase("24", "MenuText"), $MenuRelativePath . "GradAdmissionList", -1, "", IsLoggedIn() || AllowListMenu('{7E075067-9A8E-4402-9644-5EE07AF3E407}grad_admission'), false, false, "", "", false);
$sideMenu->addMenuItem(25, "mi_per_major", $MenuLanguage->MenuPhrase("25", "MenuText"), $MenuRelativePath . "PerMajorList", -1, "", IsLoggedIn() || AllowListMenu('{7E075067-9A8E-4402-9644-5EE07AF3E407}per_major'), false, false, "", "", false);
echo $sideMenu->toScript();
