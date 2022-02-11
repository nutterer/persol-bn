<?php

namespace PHPMaker2021\upPersonnelv2;

use Slim\App;
use Slim\Routing\RouteCollectorProxy;

// Handle Routes
return function (App $app) {
    // _01personnel
    $app->any('/_01personnelList[/{Per_Id}]', _01personnelController::class . ':list')->add(PermissionMiddleware::class)->setName('_01personnelList-_01personnel-list'); // list
    $app->any('/_01personnelAdd[/{Per_Id}]', _01personnelController::class . ':add')->add(PermissionMiddleware::class)->setName('_01personnelAdd-_01personnel-add'); // add
    $app->any('/_01personnelView[/{Per_Id}]', _01personnelController::class . ':view')->add(PermissionMiddleware::class)->setName('_01personnelView-_01personnel-view'); // view
    $app->any('/_01personnelEdit[/{Per_Id}]', _01personnelController::class . ':edit')->add(PermissionMiddleware::class)->setName('_01personnelEdit-_01personnel-edit'); // edit
    $app->any('/_01personnelDelete[/{Per_Id}]', _01personnelController::class . ':delete')->add(PermissionMiddleware::class)->setName('_01personnelDelete-_01personnel-delete'); // delete
    $app->group(
        '/_01personnel',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{Per_Id}]', _01personnelController::class . ':list')->add(PermissionMiddleware::class)->setName('_01personnel/list-_01personnel-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{Per_Id}]', _01personnelController::class . ':add')->add(PermissionMiddleware::class)->setName('_01personnel/add-_01personnel-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{Per_Id}]', _01personnelController::class . ':view')->add(PermissionMiddleware::class)->setName('_01personnel/view-_01personnel-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{Per_Id}]', _01personnelController::class . ':edit')->add(PermissionMiddleware::class)->setName('_01personnel/edit-_01personnel-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{Per_Id}]', _01personnelController::class . ':delete')->add(PermissionMiddleware::class)->setName('_01personnel/delete-_01personnel-delete-2'); // delete
        }
    );

    // _02selfdevelopment
    $app->any('/_02selfdevelopmentList[/{SelfDev_Id}]', _02selfdevelopmentController::class . ':list')->add(PermissionMiddleware::class)->setName('_02selfdevelopmentList-_02selfdevelopment-list'); // list
    $app->any('/_02selfdevelopmentAdd[/{SelfDev_Id}]', _02selfdevelopmentController::class . ':add')->add(PermissionMiddleware::class)->setName('_02selfdevelopmentAdd-_02selfdevelopment-add'); // add
    $app->any('/_02selfdevelopmentView[/{SelfDev_Id}]', _02selfdevelopmentController::class . ':view')->add(PermissionMiddleware::class)->setName('_02selfdevelopmentView-_02selfdevelopment-view'); // view
    $app->any('/_02selfdevelopmentEdit[/{SelfDev_Id}]', _02selfdevelopmentController::class . ':edit')->add(PermissionMiddleware::class)->setName('_02selfdevelopmentEdit-_02selfdevelopment-edit'); // edit
    $app->any('/_02selfdevelopmentDelete[/{SelfDev_Id}]', _02selfdevelopmentController::class . ':delete')->add(PermissionMiddleware::class)->setName('_02selfdevelopmentDelete-_02selfdevelopment-delete'); // delete
    $app->group(
        '/_02selfdevelopment',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{SelfDev_Id}]', _02selfdevelopmentController::class . ':list')->add(PermissionMiddleware::class)->setName('_02selfdevelopment/list-_02selfdevelopment-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{SelfDev_Id}]', _02selfdevelopmentController::class . ':add')->add(PermissionMiddleware::class)->setName('_02selfdevelopment/add-_02selfdevelopment-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{SelfDev_Id}]', _02selfdevelopmentController::class . ':view')->add(PermissionMiddleware::class)->setName('_02selfdevelopment/view-_02selfdevelopment-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{SelfDev_Id}]', _02selfdevelopmentController::class . ':edit')->add(PermissionMiddleware::class)->setName('_02selfdevelopment/edit-_02selfdevelopment-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{SelfDev_Id}]', _02selfdevelopmentController::class . ':delete')->add(PermissionMiddleware::class)->setName('_02selfdevelopment/delete-_02selfdevelopment-delete-2'); // delete
        }
    );

    // _03academicranks
    $app->any('/_03academicranksList[/{Aca_Id}]', _03academicranksController::class . ':list')->add(PermissionMiddleware::class)->setName('_03academicranksList-_03academicranks-list'); // list
    $app->any('/_03academicranksAdd[/{Aca_Id}]', _03academicranksController::class . ':add')->add(PermissionMiddleware::class)->setName('_03academicranksAdd-_03academicranks-add'); // add
    $app->any('/_03academicranksView[/{Aca_Id}]', _03academicranksController::class . ':view')->add(PermissionMiddleware::class)->setName('_03academicranksView-_03academicranks-view'); // view
    $app->any('/_03academicranksEdit[/{Aca_Id}]', _03academicranksController::class . ':edit')->add(PermissionMiddleware::class)->setName('_03academicranksEdit-_03academicranks-edit'); // edit
    $app->any('/_03academicranksDelete[/{Aca_Id}]', _03academicranksController::class . ':delete')->add(PermissionMiddleware::class)->setName('_03academicranksDelete-_03academicranks-delete'); // delete
    $app->group(
        '/_03academicranks',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{Aca_Id}]', _03academicranksController::class . ':list')->add(PermissionMiddleware::class)->setName('_03academicranks/list-_03academicranks-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{Aca_Id}]', _03academicranksController::class . ':add')->add(PermissionMiddleware::class)->setName('_03academicranks/add-_03academicranks-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{Aca_Id}]', _03academicranksController::class . ':view')->add(PermissionMiddleware::class)->setName('_03academicranks/view-_03academicranks-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{Aca_Id}]', _03academicranksController::class . ':edit')->add(PermissionMiddleware::class)->setName('_03academicranks/edit-_03academicranks-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{Aca_Id}]', _03academicranksController::class . ':delete')->add(PermissionMiddleware::class)->setName('_03academicranks/delete-_03academicranks-delete-2'); // delete
        }
    );

    // _04personnelplan
    $app->any('/_04personnelplanList[/{Plan_Id}]', _04personnelplanController::class . ':list')->add(PermissionMiddleware::class)->setName('_04personnelplanList-_04personnelplan-list'); // list
    $app->any('/_04personnelplanAdd[/{Plan_Id}]', _04personnelplanController::class . ':add')->add(PermissionMiddleware::class)->setName('_04personnelplanAdd-_04personnelplan-add'); // add
    $app->any('/_04personnelplanView[/{Plan_Id}]', _04personnelplanController::class . ':view')->add(PermissionMiddleware::class)->setName('_04personnelplanView-_04personnelplan-view'); // view
    $app->any('/_04personnelplanEdit[/{Plan_Id}]', _04personnelplanController::class . ':edit')->add(PermissionMiddleware::class)->setName('_04personnelplanEdit-_04personnelplan-edit'); // edit
    $app->any('/_04personnelplanDelete[/{Plan_Id}]', _04personnelplanController::class . ':delete')->add(PermissionMiddleware::class)->setName('_04personnelplanDelete-_04personnelplan-delete'); // delete
    $app->group(
        '/_04personnelplan',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{Plan_Id}]', _04personnelplanController::class . ':list')->add(PermissionMiddleware::class)->setName('_04personnelplan/list-_04personnelplan-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{Plan_Id}]', _04personnelplanController::class . ':add')->add(PermissionMiddleware::class)->setName('_04personnelplan/add-_04personnelplan-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{Plan_Id}]', _04personnelplanController::class . ':view')->add(PermissionMiddleware::class)->setName('_04personnelplan/view-_04personnelplan-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{Plan_Id}]', _04personnelplanController::class . ':edit')->add(PermissionMiddleware::class)->setName('_04personnelplan/edit-_04personnelplan-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{Plan_Id}]', _04personnelplanController::class . ':delete')->add(PermissionMiddleware::class)->setName('_04personnelplan/delete-_04personnelplan-delete-2'); // delete
        }
    );

    // _05report
    $app->any('/_05reportList[/{Report_Id}]', _05reportController::class . ':list')->add(PermissionMiddleware::class)->setName('_05reportList-_05report-list'); // list
    $app->any('/_05reportAdd[/{Report_Id}]', _05reportController::class . ':add')->add(PermissionMiddleware::class)->setName('_05reportAdd-_05report-add'); // add
    $app->any('/_05reportView[/{Report_Id}]', _05reportController::class . ':view')->add(PermissionMiddleware::class)->setName('_05reportView-_05report-view'); // view
    $app->any('/_05reportEdit[/{Report_Id}]', _05reportController::class . ':edit')->add(PermissionMiddleware::class)->setName('_05reportEdit-_05report-edit'); // edit
    $app->any('/_05reportDelete[/{Report_Id}]', _05reportController::class . ':delete')->add(PermissionMiddleware::class)->setName('_05reportDelete-_05report-delete'); // delete
    $app->group(
        '/_05report',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{Report_Id}]', _05reportController::class . ':list')->add(PermissionMiddleware::class)->setName('_05report/list-_05report-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{Report_Id}]', _05reportController::class . ':add')->add(PermissionMiddleware::class)->setName('_05report/add-_05report-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{Report_Id}]', _05reportController::class . ':view')->add(PermissionMiddleware::class)->setName('_05report/view-_05report-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{Report_Id}]', _05reportController::class . ':edit')->add(PermissionMiddleware::class)->setName('_05report/edit-_05report-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{Report_Id}]', _05reportController::class . ':delete')->add(PermissionMiddleware::class)->setName('_05report/delete-_05report-delete-2'); // delete
        }
    );

    // academicbook
    $app->any('/AcademicbookList[/{Book_Id}]', AcademicbookController::class . ':list')->add(PermissionMiddleware::class)->setName('AcademicbookList-academicbook-list'); // list
    $app->any('/AcademicbookAdd[/{Book_Id}]', AcademicbookController::class . ':add')->add(PermissionMiddleware::class)->setName('AcademicbookAdd-academicbook-add'); // add
    $app->any('/AcademicbookView[/{Book_Id}]', AcademicbookController::class . ':view')->add(PermissionMiddleware::class)->setName('AcademicbookView-academicbook-view'); // view
    $app->any('/AcademicbookEdit[/{Book_Id}]', AcademicbookController::class . ':edit')->add(PermissionMiddleware::class)->setName('AcademicbookEdit-academicbook-edit'); // edit
    $app->any('/AcademicbookDelete[/{Book_Id}]', AcademicbookController::class . ':delete')->add(PermissionMiddleware::class)->setName('AcademicbookDelete-academicbook-delete'); // delete
    $app->group(
        '/academicbook',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{Book_Id}]', AcademicbookController::class . ':list')->add(PermissionMiddleware::class)->setName('academicbook/list-academicbook-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{Book_Id}]', AcademicbookController::class . ':add')->add(PermissionMiddleware::class)->setName('academicbook/add-academicbook-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{Book_Id}]', AcademicbookController::class . ':view')->add(PermissionMiddleware::class)->setName('academicbook/view-academicbook-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{Book_Id}]', AcademicbookController::class . ':edit')->add(PermissionMiddleware::class)->setName('academicbook/edit-academicbook-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{Book_Id}]', AcademicbookController::class . ':delete')->add(PermissionMiddleware::class)->setName('academicbook/delete-academicbook-delete-2'); // delete
        }
    );

    // academicpublic
    $app->any('/AcademicpublicList[/{Public_Id}]', AcademicpublicController::class . ':list')->add(PermissionMiddleware::class)->setName('AcademicpublicList-academicpublic-list'); // list
    $app->any('/AcademicpublicAdd[/{Public_Id}]', AcademicpublicController::class . ':add')->add(PermissionMiddleware::class)->setName('AcademicpublicAdd-academicpublic-add'); // add
    $app->any('/AcademicpublicView[/{Public_Id}]', AcademicpublicController::class . ':view')->add(PermissionMiddleware::class)->setName('AcademicpublicView-academicpublic-view'); // view
    $app->any('/AcademicpublicEdit[/{Public_Id}]', AcademicpublicController::class . ':edit')->add(PermissionMiddleware::class)->setName('AcademicpublicEdit-academicpublic-edit'); // edit
    $app->any('/AcademicpublicDelete[/{Public_Id}]', AcademicpublicController::class . ':delete')->add(PermissionMiddleware::class)->setName('AcademicpublicDelete-academicpublic-delete'); // delete
    $app->group(
        '/academicpublic',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{Public_Id}]', AcademicpublicController::class . ':list')->add(PermissionMiddleware::class)->setName('academicpublic/list-academicpublic-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{Public_Id}]', AcademicpublicController::class . ':add')->add(PermissionMiddleware::class)->setName('academicpublic/add-academicpublic-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{Public_Id}]', AcademicpublicController::class . ':view')->add(PermissionMiddleware::class)->setName('academicpublic/view-academicpublic-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{Public_Id}]', AcademicpublicController::class . ':edit')->add(PermissionMiddleware::class)->setName('academicpublic/edit-academicpublic-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{Public_Id}]', AcademicpublicController::class . ':delete')->add(PermissionMiddleware::class)->setName('academicpublic/delete-academicpublic-delete-2'); // delete
        }
    );

    // award
    $app->any('/AwardList[/{Award_Id}]', AwardController::class . ':list')->add(PermissionMiddleware::class)->setName('AwardList-award-list'); // list
    $app->any('/AwardAdd[/{Award_Id}]', AwardController::class . ':add')->add(PermissionMiddleware::class)->setName('AwardAdd-award-add'); // add
    $app->any('/AwardView[/{Award_Id}]', AwardController::class . ':view')->add(PermissionMiddleware::class)->setName('AwardView-award-view'); // view
    $app->any('/AwardEdit[/{Award_Id}]', AwardController::class . ':edit')->add(PermissionMiddleware::class)->setName('AwardEdit-award-edit'); // edit
    $app->any('/AwardDelete[/{Award_Id}]', AwardController::class . ':delete')->add(PermissionMiddleware::class)->setName('AwardDelete-award-delete'); // delete
    $app->group(
        '/award',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{Award_Id}]', AwardController::class . ':list')->add(PermissionMiddleware::class)->setName('award/list-award-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{Award_Id}]', AwardController::class . ':add')->add(PermissionMiddleware::class)->setName('award/add-award-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{Award_Id}]', AwardController::class . ':view')->add(PermissionMiddleware::class)->setName('award/view-award-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{Award_Id}]', AwardController::class . ':edit')->add(PermissionMiddleware::class)->setName('award/edit-award-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{Award_Id}]', AwardController::class . ':delete')->add(PermissionMiddleware::class)->setName('award/delete-award-delete-2'); // delete
        }
    );

    // graduation
    $app->any('/GraduationList[/{Grad_Id}]', GraduationController::class . ':list')->add(PermissionMiddleware::class)->setName('GraduationList-graduation-list'); // list
    $app->any('/GraduationAdd[/{Grad_Id}]', GraduationController::class . ':add')->add(PermissionMiddleware::class)->setName('GraduationAdd-graduation-add'); // add
    $app->any('/GraduationView[/{Grad_Id}]', GraduationController::class . ':view')->add(PermissionMiddleware::class)->setName('GraduationView-graduation-view'); // view
    $app->any('/GraduationEdit[/{Grad_Id}]', GraduationController::class . ':edit')->add(PermissionMiddleware::class)->setName('GraduationEdit-graduation-edit'); // edit
    $app->any('/GraduationDelete[/{Grad_Id}]', GraduationController::class . ':delete')->add(PermissionMiddleware::class)->setName('GraduationDelete-graduation-delete'); // delete
    $app->group(
        '/graduation',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{Grad_Id}]', GraduationController::class . ':list')->add(PermissionMiddleware::class)->setName('graduation/list-graduation-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{Grad_Id}]', GraduationController::class . ':add')->add(PermissionMiddleware::class)->setName('graduation/add-graduation-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{Grad_Id}]', GraduationController::class . ':view')->add(PermissionMiddleware::class)->setName('graduation/view-graduation-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{Grad_Id}]', GraduationController::class . ':edit')->add(PermissionMiddleware::class)->setName('graduation/edit-graduation-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{Grad_Id}]', GraduationController::class . ':delete')->add(PermissionMiddleware::class)->setName('graduation/delete-graduation-delete-2'); // delete
        }
    );

    // studyleave
    $app->any('/StudyleaveList', StudyleaveController::class . ':list')->add(PermissionMiddleware::class)->setName('StudyleaveList-studyleave-list'); // list
    $app->group(
        '/studyleave',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '', StudyleaveController::class . ':list')->add(PermissionMiddleware::class)->setName('studyleave/list-studyleave-list-2'); // list
        }
    );

    // studyleavetype
    $app->any('/StudyleavetypeList[/{StudyLeaveType_Id}]', StudyleavetypeController::class . ':list')->add(PermissionMiddleware::class)->setName('StudyleavetypeList-studyleavetype-list'); // list
    $app->any('/StudyleavetypeAdd[/{StudyLeaveType_Id}]', StudyleavetypeController::class . ':add')->add(PermissionMiddleware::class)->setName('StudyleavetypeAdd-studyleavetype-add'); // add
    $app->any('/StudyleavetypeView[/{StudyLeaveType_Id}]', StudyleavetypeController::class . ':view')->add(PermissionMiddleware::class)->setName('StudyleavetypeView-studyleavetype-view'); // view
    $app->any('/StudyleavetypeEdit[/{StudyLeaveType_Id}]', StudyleavetypeController::class . ':edit')->add(PermissionMiddleware::class)->setName('StudyleavetypeEdit-studyleavetype-edit'); // edit
    $app->any('/StudyleavetypeDelete[/{StudyLeaveType_Id}]', StudyleavetypeController::class . ':delete')->add(PermissionMiddleware::class)->setName('StudyleavetypeDelete-studyleavetype-delete'); // delete
    $app->group(
        '/studyleavetype',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{StudyLeaveType_Id}]', StudyleavetypeController::class . ':list')->add(PermissionMiddleware::class)->setName('studyleavetype/list-studyleavetype-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{StudyLeaveType_Id}]', StudyleavetypeController::class . ':add')->add(PermissionMiddleware::class)->setName('studyleavetype/add-studyleavetype-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{StudyLeaveType_Id}]', StudyleavetypeController::class . ':view')->add(PermissionMiddleware::class)->setName('studyleavetype/view-studyleavetype-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{StudyLeaveType_Id}]', StudyleavetypeController::class . ':edit')->add(PermissionMiddleware::class)->setName('studyleavetype/edit-studyleavetype-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{StudyLeaveType_Id}]', StudyleavetypeController::class . ':delete')->add(PermissionMiddleware::class)->setName('studyleavetype/delete-studyleavetype-delete-2'); // delete
        }
    );

    // per_academic
    $app->any('/PerAcademicList[/{Per_Academic_id}]', PerAcademicController::class . ':list')->add(PermissionMiddleware::class)->setName('PerAcademicList-per_academic-list'); // list
    $app->any('/PerAcademicAdd[/{Per_Academic_id}]', PerAcademicController::class . ':add')->add(PermissionMiddleware::class)->setName('PerAcademicAdd-per_academic-add'); // add
    $app->any('/PerAcademicView[/{Per_Academic_id}]', PerAcademicController::class . ':view')->add(PermissionMiddleware::class)->setName('PerAcademicView-per_academic-view'); // view
    $app->any('/PerAcademicEdit[/{Per_Academic_id}]', PerAcademicController::class . ':edit')->add(PermissionMiddleware::class)->setName('PerAcademicEdit-per_academic-edit'); // edit
    $app->any('/PerAcademicDelete[/{Per_Academic_id}]', PerAcademicController::class . ':delete')->add(PermissionMiddleware::class)->setName('PerAcademicDelete-per_academic-delete'); // delete
    $app->group(
        '/per_academic',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{Per_Academic_id}]', PerAcademicController::class . ':list')->add(PermissionMiddleware::class)->setName('per_academic/list-per_academic-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{Per_Academic_id}]', PerAcademicController::class . ':add')->add(PermissionMiddleware::class)->setName('per_academic/add-per_academic-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{Per_Academic_id}]', PerAcademicController::class . ':view')->add(PermissionMiddleware::class)->setName('per_academic/view-per_academic-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{Per_Academic_id}]', PerAcademicController::class . ':edit')->add(PermissionMiddleware::class)->setName('per_academic/edit-per_academic-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{Per_Academic_id}]', PerAcademicController::class . ':delete')->add(PermissionMiddleware::class)->setName('per_academic/delete-per_academic-delete-2'); // delete
        }
    );

    // per_administrative
    $app->any('/PerAdministrativeList[/{Per_Administrative_id}]', PerAdministrativeController::class . ':list')->add(PermissionMiddleware::class)->setName('PerAdministrativeList-per_administrative-list'); // list
    $app->any('/PerAdministrativeAdd[/{Per_Administrative_id}]', PerAdministrativeController::class . ':add')->add(PermissionMiddleware::class)->setName('PerAdministrativeAdd-per_administrative-add'); // add
    $app->any('/PerAdministrativeView[/{Per_Administrative_id}]', PerAdministrativeController::class . ':view')->add(PermissionMiddleware::class)->setName('PerAdministrativeView-per_administrative-view'); // view
    $app->any('/PerAdministrativeEdit[/{Per_Administrative_id}]', PerAdministrativeController::class . ':edit')->add(PermissionMiddleware::class)->setName('PerAdministrativeEdit-per_administrative-edit'); // edit
    $app->any('/PerAdministrativeDelete[/{Per_Administrative_id}]', PerAdministrativeController::class . ':delete')->add(PermissionMiddleware::class)->setName('PerAdministrativeDelete-per_administrative-delete'); // delete
    $app->group(
        '/per_administrative',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{Per_Administrative_id}]', PerAdministrativeController::class . ':list')->add(PermissionMiddleware::class)->setName('per_administrative/list-per_administrative-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{Per_Administrative_id}]', PerAdministrativeController::class . ':add')->add(PermissionMiddleware::class)->setName('per_administrative/add-per_administrative-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{Per_Administrative_id}]', PerAdministrativeController::class . ':view')->add(PermissionMiddleware::class)->setName('per_administrative/view-per_administrative-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{Per_Administrative_id}]', PerAdministrativeController::class . ':edit')->add(PermissionMiddleware::class)->setName('per_administrative/edit-per_administrative-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{Per_Administrative_id}]', PerAdministrativeController::class . ':delete')->add(PermissionMiddleware::class)->setName('per_administrative/delete-per_administrative-delete-2'); // delete
        }
    );

    // per_employeetype
    $app->any('/PerEmployeetypeList[/{Per_EmployeeType_id}]', PerEmployeetypeController::class . ':list')->add(PermissionMiddleware::class)->setName('PerEmployeetypeList-per_employeetype-list'); // list
    $app->any('/PerEmployeetypeAdd[/{Per_EmployeeType_id}]', PerEmployeetypeController::class . ':add')->add(PermissionMiddleware::class)->setName('PerEmployeetypeAdd-per_employeetype-add'); // add
    $app->any('/PerEmployeetypeView[/{Per_EmployeeType_id}]', PerEmployeetypeController::class . ':view')->add(PermissionMiddleware::class)->setName('PerEmployeetypeView-per_employeetype-view'); // view
    $app->any('/PerEmployeetypeEdit[/{Per_EmployeeType_id}]', PerEmployeetypeController::class . ':edit')->add(PermissionMiddleware::class)->setName('PerEmployeetypeEdit-per_employeetype-edit'); // edit
    $app->any('/PerEmployeetypeDelete[/{Per_EmployeeType_id}]', PerEmployeetypeController::class . ':delete')->add(PermissionMiddleware::class)->setName('PerEmployeetypeDelete-per_employeetype-delete'); // delete
    $app->group(
        '/per_employeetype',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{Per_EmployeeType_id}]', PerEmployeetypeController::class . ':list')->add(PermissionMiddleware::class)->setName('per_employeetype/list-per_employeetype-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{Per_EmployeeType_id}]', PerEmployeetypeController::class . ':add')->add(PermissionMiddleware::class)->setName('per_employeetype/add-per_employeetype-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{Per_EmployeeType_id}]', PerEmployeetypeController::class . ':view')->add(PermissionMiddleware::class)->setName('per_employeetype/view-per_employeetype-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{Per_EmployeeType_id}]', PerEmployeetypeController::class . ':edit')->add(PermissionMiddleware::class)->setName('per_employeetype/edit-per_employeetype-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{Per_EmployeeType_id}]', PerEmployeetypeController::class . ':delete')->add(PermissionMiddleware::class)->setName('per_employeetype/delete-per_employeetype-delete-2'); // delete
        }
    );

    // per_nationality
    $app->any('/PerNationalityList[/{Per_Nationality_id}]', PerNationalityController::class . ':list')->add(PermissionMiddleware::class)->setName('PerNationalityList-per_nationality-list'); // list
    $app->any('/PerNationalityAdd[/{Per_Nationality_id}]', PerNationalityController::class . ':add')->add(PermissionMiddleware::class)->setName('PerNationalityAdd-per_nationality-add'); // add
    $app->any('/PerNationalityView[/{Per_Nationality_id}]', PerNationalityController::class . ':view')->add(PermissionMiddleware::class)->setName('PerNationalityView-per_nationality-view'); // view
    $app->any('/PerNationalityEdit[/{Per_Nationality_id}]', PerNationalityController::class . ':edit')->add(PermissionMiddleware::class)->setName('PerNationalityEdit-per_nationality-edit'); // edit
    $app->any('/PerNationalityDelete[/{Per_Nationality_id}]', PerNationalityController::class . ':delete')->add(PermissionMiddleware::class)->setName('PerNationalityDelete-per_nationality-delete'); // delete
    $app->group(
        '/per_nationality',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{Per_Nationality_id}]', PerNationalityController::class . ':list')->add(PermissionMiddleware::class)->setName('per_nationality/list-per_nationality-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{Per_Nationality_id}]', PerNationalityController::class . ':add')->add(PermissionMiddleware::class)->setName('per_nationality/add-per_nationality-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{Per_Nationality_id}]', PerNationalityController::class . ':view')->add(PermissionMiddleware::class)->setName('per_nationality/view-per_nationality-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{Per_Nationality_id}]', PerNationalityController::class . ':edit')->add(PermissionMiddleware::class)->setName('per_nationality/edit-per_nationality-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{Per_Nationality_id}]', PerNationalityController::class . ':delete')->add(PermissionMiddleware::class)->setName('per_nationality/delete-per_nationality-delete-2'); // delete
        }
    );

    // per_position
    $app->any('/PerPositionList[/{Per_Position_id}]', PerPositionController::class . ':list')->add(PermissionMiddleware::class)->setName('PerPositionList-per_position-list'); // list
    $app->any('/PerPositionAdd[/{Per_Position_id}]', PerPositionController::class . ':add')->add(PermissionMiddleware::class)->setName('PerPositionAdd-per_position-add'); // add
    $app->any('/PerPositionView[/{Per_Position_id}]', PerPositionController::class . ':view')->add(PermissionMiddleware::class)->setName('PerPositionView-per_position-view'); // view
    $app->any('/PerPositionEdit[/{Per_Position_id}]', PerPositionController::class . ':edit')->add(PermissionMiddleware::class)->setName('PerPositionEdit-per_position-edit'); // edit
    $app->any('/PerPositionDelete[/{Per_Position_id}]', PerPositionController::class . ':delete')->add(PermissionMiddleware::class)->setName('PerPositionDelete-per_position-delete'); // delete
    $app->group(
        '/per_position',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{Per_Position_id}]', PerPositionController::class . ':list')->add(PermissionMiddleware::class)->setName('per_position/list-per_position-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{Per_Position_id}]', PerPositionController::class . ':add')->add(PermissionMiddleware::class)->setName('per_position/add-per_position-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{Per_Position_id}]', PerPositionController::class . ':view')->add(PermissionMiddleware::class)->setName('per_position/view-per_position-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{Per_Position_id}]', PerPositionController::class . ':edit')->add(PermissionMiddleware::class)->setName('per_position/edit-per_position-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{Per_Position_id}]', PerPositionController::class . ':delete')->add(PermissionMiddleware::class)->setName('per_position/delete-per_position-delete-2'); // delete
        }
    );

    // per_religion
    $app->any('/PerReligionList[/{Per_Religion_id}]', PerReligionController::class . ':list')->add(PermissionMiddleware::class)->setName('PerReligionList-per_religion-list'); // list
    $app->any('/PerReligionAdd[/{Per_Religion_id}]', PerReligionController::class . ':add')->add(PermissionMiddleware::class)->setName('PerReligionAdd-per_religion-add'); // add
    $app->any('/PerReligionView[/{Per_Religion_id}]', PerReligionController::class . ':view')->add(PermissionMiddleware::class)->setName('PerReligionView-per_religion-view'); // view
    $app->any('/PerReligionEdit[/{Per_Religion_id}]', PerReligionController::class . ':edit')->add(PermissionMiddleware::class)->setName('PerReligionEdit-per_religion-edit'); // edit
    $app->any('/PerReligionDelete[/{Per_Religion_id}]', PerReligionController::class . ':delete')->add(PermissionMiddleware::class)->setName('PerReligionDelete-per_religion-delete'); // delete
    $app->group(
        '/per_religion',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{Per_Religion_id}]', PerReligionController::class . ':list')->add(PermissionMiddleware::class)->setName('per_religion/list-per_religion-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{Per_Religion_id}]', PerReligionController::class . ':add')->add(PermissionMiddleware::class)->setName('per_religion/add-per_religion-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{Per_Religion_id}]', PerReligionController::class . ':view')->add(PermissionMiddleware::class)->setName('per_religion/view-per_religion-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{Per_Religion_id}]', PerReligionController::class . ':edit')->add(PermissionMiddleware::class)->setName('per_religion/edit-per_religion-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{Per_Religion_id}]', PerReligionController::class . ':delete')->add(PermissionMiddleware::class)->setName('per_religion/delete-per_religion-delete-2'); // delete
        }
    );

    // per_type
    $app->any('/PerTypeList[/{Per_Type_id}]', PerTypeController::class . ':list')->add(PermissionMiddleware::class)->setName('PerTypeList-per_type-list'); // list
    $app->any('/PerTypeAdd[/{Per_Type_id}]', PerTypeController::class . ':add')->add(PermissionMiddleware::class)->setName('PerTypeAdd-per_type-add'); // add
    $app->any('/PerTypeView[/{Per_Type_id}]', PerTypeController::class . ':view')->add(PermissionMiddleware::class)->setName('PerTypeView-per_type-view'); // view
    $app->any('/PerTypeEdit[/{Per_Type_id}]', PerTypeController::class . ':edit')->add(PermissionMiddleware::class)->setName('PerTypeEdit-per_type-edit'); // edit
    $app->any('/PerTypeDelete[/{Per_Type_id}]', PerTypeController::class . ':delete')->add(PermissionMiddleware::class)->setName('PerTypeDelete-per_type-delete'); // delete
    $app->group(
        '/per_type',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{Per_Type_id}]', PerTypeController::class . ':list')->add(PermissionMiddleware::class)->setName('per_type/list-per_type-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{Per_Type_id}]', PerTypeController::class . ':add')->add(PermissionMiddleware::class)->setName('per_type/add-per_type-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{Per_Type_id}]', PerTypeController::class . ':view')->add(PermissionMiddleware::class)->setName('per_type/view-per_type-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{Per_Type_id}]', PerTypeController::class . ':edit')->add(PermissionMiddleware::class)->setName('per_type/edit-per_type-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{Per_Type_id}]', PerTypeController::class . ':delete')->add(PermissionMiddleware::class)->setName('per_type/delete-per_type-delete-2'); // delete
        }
    );

    // per_workstatus
    $app->any('/PerWorkstatusList[/{Per_WorkStatus_id}]', PerWorkstatusController::class . ':list')->add(PermissionMiddleware::class)->setName('PerWorkstatusList-per_workstatus-list'); // list
    $app->any('/PerWorkstatusAdd[/{Per_WorkStatus_id}]', PerWorkstatusController::class . ':add')->add(PermissionMiddleware::class)->setName('PerWorkstatusAdd-per_workstatus-add'); // add
    $app->any('/PerWorkstatusView[/{Per_WorkStatus_id}]', PerWorkstatusController::class . ':view')->add(PermissionMiddleware::class)->setName('PerWorkstatusView-per_workstatus-view'); // view
    $app->any('/PerWorkstatusEdit[/{Per_WorkStatus_id}]', PerWorkstatusController::class . ':edit')->add(PermissionMiddleware::class)->setName('PerWorkstatusEdit-per_workstatus-edit'); // edit
    $app->any('/PerWorkstatusDelete[/{Per_WorkStatus_id}]', PerWorkstatusController::class . ':delete')->add(PermissionMiddleware::class)->setName('PerWorkstatusDelete-per_workstatus-delete'); // delete
    $app->group(
        '/per_workstatus',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{Per_WorkStatus_id}]', PerWorkstatusController::class . ':list')->add(PermissionMiddleware::class)->setName('per_workstatus/list-per_workstatus-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{Per_WorkStatus_id}]', PerWorkstatusController::class . ':add')->add(PermissionMiddleware::class)->setName('per_workstatus/add-per_workstatus-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{Per_WorkStatus_id}]', PerWorkstatusController::class . ':view')->add(PermissionMiddleware::class)->setName('per_workstatus/view-per_workstatus-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{Per_WorkStatus_id}]', PerWorkstatusController::class . ':edit')->add(PermissionMiddleware::class)->setName('per_workstatus/edit-per_workstatus-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{Per_WorkStatus_id}]', PerWorkstatusController::class . ':delete')->add(PermissionMiddleware::class)->setName('per_workstatus/delete-per_workstatus-delete-2'); // delete
        }
    );

    // users
    $app->any('/UsersList[/{Users__Id}]', UsersController::class . ':list')->add(PermissionMiddleware::class)->setName('UsersList-users-list'); // list
    $app->any('/UsersAdd[/{Users__Id}]', UsersController::class . ':add')->add(PermissionMiddleware::class)->setName('UsersAdd-users-add'); // add
    $app->any('/UsersView[/{Users__Id}]', UsersController::class . ':view')->add(PermissionMiddleware::class)->setName('UsersView-users-view'); // view
    $app->any('/UsersEdit[/{Users__Id}]', UsersController::class . ':edit')->add(PermissionMiddleware::class)->setName('UsersEdit-users-edit'); // edit
    $app->any('/UsersDelete[/{Users__Id}]', UsersController::class . ':delete')->add(PermissionMiddleware::class)->setName('UsersDelete-users-delete'); // delete
    $app->group(
        '/users',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{Users__Id}]', UsersController::class . ':list')->add(PermissionMiddleware::class)->setName('users/list-users-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{Users__Id}]', UsersController::class . ':add')->add(PermissionMiddleware::class)->setName('users/add-users-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{Users__Id}]', UsersController::class . ':view')->add(PermissionMiddleware::class)->setName('users/view-users-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{Users__Id}]', UsersController::class . ':edit')->add(PermissionMiddleware::class)->setName('users/edit-users-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{Users__Id}]', UsersController::class . ':delete')->add(PermissionMiddleware::class)->setName('users/delete-users-delete-2'); // delete
        }
    );

    // selfdev_type
    $app->any('/SelfdevTypeList[/{SelfDev_Type_id}]', SelfdevTypeController::class . ':list')->add(PermissionMiddleware::class)->setName('SelfdevTypeList-selfdev_type-list'); // list
    $app->any('/SelfdevTypeAdd[/{SelfDev_Type_id}]', SelfdevTypeController::class . ':add')->add(PermissionMiddleware::class)->setName('SelfdevTypeAdd-selfdev_type-add'); // add
    $app->any('/SelfdevTypeView[/{SelfDev_Type_id}]', SelfdevTypeController::class . ':view')->add(PermissionMiddleware::class)->setName('SelfdevTypeView-selfdev_type-view'); // view
    $app->any('/SelfdevTypeEdit[/{SelfDev_Type_id}]', SelfdevTypeController::class . ':edit')->add(PermissionMiddleware::class)->setName('SelfdevTypeEdit-selfdev_type-edit'); // edit
    $app->any('/SelfdevTypeDelete[/{SelfDev_Type_id}]', SelfdevTypeController::class . ':delete')->add(PermissionMiddleware::class)->setName('SelfdevTypeDelete-selfdev_type-delete'); // delete
    $app->group(
        '/selfdev_type',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{SelfDev_Type_id}]', SelfdevTypeController::class . ':list')->add(PermissionMiddleware::class)->setName('selfdev_type/list-selfdev_type-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{SelfDev_Type_id}]', SelfdevTypeController::class . ':add')->add(PermissionMiddleware::class)->setName('selfdev_type/add-selfdev_type-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{SelfDev_Type_id}]', SelfdevTypeController::class . ':view')->add(PermissionMiddleware::class)->setName('selfdev_type/view-selfdev_type-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{SelfDev_Type_id}]', SelfdevTypeController::class . ':edit')->add(PermissionMiddleware::class)->setName('selfdev_type/edit-selfdev_type-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{SelfDev_Type_id}]', SelfdevTypeController::class . ':delete')->add(PermissionMiddleware::class)->setName('selfdev_type/delete-selfdev_type-delete-2'); // delete
        }
    );

    // book_type
    $app->any('/BookTypeList[/{Book_Type_id}]', BookTypeController::class . ':list')->add(PermissionMiddleware::class)->setName('BookTypeList-book_type-list'); // list
    $app->any('/BookTypeAdd[/{Book_Type_id}]', BookTypeController::class . ':add')->add(PermissionMiddleware::class)->setName('BookTypeAdd-book_type-add'); // add
    $app->any('/BookTypeView[/{Book_Type_id}]', BookTypeController::class . ':view')->add(PermissionMiddleware::class)->setName('BookTypeView-book_type-view'); // view
    $app->any('/BookTypeEdit[/{Book_Type_id}]', BookTypeController::class . ':edit')->add(PermissionMiddleware::class)->setName('BookTypeEdit-book_type-edit'); // edit
    $app->any('/BookTypeDelete[/{Book_Type_id}]', BookTypeController::class . ':delete')->add(PermissionMiddleware::class)->setName('BookTypeDelete-book_type-delete'); // delete
    $app->group(
        '/book_type',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{Book_Type_id}]', BookTypeController::class . ':list')->add(PermissionMiddleware::class)->setName('book_type/list-book_type-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{Book_Type_id}]', BookTypeController::class . ':add')->add(PermissionMiddleware::class)->setName('book_type/add-book_type-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{Book_Type_id}]', BookTypeController::class . ':view')->add(PermissionMiddleware::class)->setName('book_type/view-book_type-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{Book_Type_id}]', BookTypeController::class . ':edit')->add(PermissionMiddleware::class)->setName('book_type/edit-book_type-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{Book_Type_id}]', BookTypeController::class . ':delete')->add(PermissionMiddleware::class)->setName('book_type/delete-book_type-delete-2'); // delete
        }
    );

    // public_type
    $app->any('/PublicTypeList[/{Public_Type_id}]', PublicTypeController::class . ':list')->add(PermissionMiddleware::class)->setName('PublicTypeList-public_type-list'); // list
    $app->any('/PublicTypeAdd[/{Public_Type_id}]', PublicTypeController::class . ':add')->add(PermissionMiddleware::class)->setName('PublicTypeAdd-public_type-add'); // add
    $app->any('/PublicTypeView[/{Public_Type_id}]', PublicTypeController::class . ':view')->add(PermissionMiddleware::class)->setName('PublicTypeView-public_type-view'); // view
    $app->any('/PublicTypeEdit[/{Public_Type_id}]', PublicTypeController::class . ':edit')->add(PermissionMiddleware::class)->setName('PublicTypeEdit-public_type-edit'); // edit
    $app->any('/PublicTypeDelete[/{Public_Type_id}]', PublicTypeController::class . ':delete')->add(PermissionMiddleware::class)->setName('PublicTypeDelete-public_type-delete'); // delete
    $app->group(
        '/public_type',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{Public_Type_id}]', PublicTypeController::class . ':list')->add(PermissionMiddleware::class)->setName('public_type/list-public_type-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{Public_Type_id}]', PublicTypeController::class . ':add')->add(PermissionMiddleware::class)->setName('public_type/add-public_type-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{Public_Type_id}]', PublicTypeController::class . ':view')->add(PermissionMiddleware::class)->setName('public_type/view-public_type-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{Public_Type_id}]', PublicTypeController::class . ':edit')->add(PermissionMiddleware::class)->setName('public_type/edit-public_type-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{Public_Type_id}]', PublicTypeController::class . ':delete')->add(PermissionMiddleware::class)->setName('public_type/delete-public_type-delete-2'); // delete
        }
    );

    // grad_admission
    $app->any('/GradAdmissionList[/{Grad_Admission_id}]', GradAdmissionController::class . ':list')->add(PermissionMiddleware::class)->setName('GradAdmissionList-grad_admission-list'); // list
    $app->any('/GradAdmissionAdd[/{Grad_Admission_id}]', GradAdmissionController::class . ':add')->add(PermissionMiddleware::class)->setName('GradAdmissionAdd-grad_admission-add'); // add
    $app->any('/GradAdmissionView[/{Grad_Admission_id}]', GradAdmissionController::class . ':view')->add(PermissionMiddleware::class)->setName('GradAdmissionView-grad_admission-view'); // view
    $app->any('/GradAdmissionEdit[/{Grad_Admission_id}]', GradAdmissionController::class . ':edit')->add(PermissionMiddleware::class)->setName('GradAdmissionEdit-grad_admission-edit'); // edit
    $app->any('/GradAdmissionDelete[/{Grad_Admission_id}]', GradAdmissionController::class . ':delete')->add(PermissionMiddleware::class)->setName('GradAdmissionDelete-grad_admission-delete'); // delete
    $app->group(
        '/grad_admission',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{Grad_Admission_id}]', GradAdmissionController::class . ':list')->add(PermissionMiddleware::class)->setName('grad_admission/list-grad_admission-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{Grad_Admission_id}]', GradAdmissionController::class . ':add')->add(PermissionMiddleware::class)->setName('grad_admission/add-grad_admission-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{Grad_Admission_id}]', GradAdmissionController::class . ':view')->add(PermissionMiddleware::class)->setName('grad_admission/view-grad_admission-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{Grad_Admission_id}]', GradAdmissionController::class . ':edit')->add(PermissionMiddleware::class)->setName('grad_admission/edit-grad_admission-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{Grad_Admission_id}]', GradAdmissionController::class . ':delete')->add(PermissionMiddleware::class)->setName('grad_admission/delete-grad_admission-delete-2'); // delete
        }
    );

    // per_major
    $app->any('/PerMajorList[/{Per_major_id}]', PerMajorController::class . ':list')->add(PermissionMiddleware::class)->setName('PerMajorList-per_major-list'); // list
    $app->any('/PerMajorAdd[/{Per_major_id}]', PerMajorController::class . ':add')->add(PermissionMiddleware::class)->setName('PerMajorAdd-per_major-add'); // add
    $app->any('/PerMajorView[/{Per_major_id}]', PerMajorController::class . ':view')->add(PermissionMiddleware::class)->setName('PerMajorView-per_major-view'); // view
    $app->any('/PerMajorEdit[/{Per_major_id}]', PerMajorController::class . ':edit')->add(PermissionMiddleware::class)->setName('PerMajorEdit-per_major-edit'); // edit
    $app->any('/PerMajorDelete[/{Per_major_id}]', PerMajorController::class . ':delete')->add(PermissionMiddleware::class)->setName('PerMajorDelete-per_major-delete'); // delete
    $app->group(
        '/per_major',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{Per_major_id}]', PerMajorController::class . ':list')->add(PermissionMiddleware::class)->setName('per_major/list-per_major-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{Per_major_id}]', PerMajorController::class . ':add')->add(PermissionMiddleware::class)->setName('per_major/add-per_major-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{Per_major_id}]', PerMajorController::class . ':view')->add(PermissionMiddleware::class)->setName('per_major/view-per_major-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{Per_major_id}]', PerMajorController::class . ':edit')->add(PermissionMiddleware::class)->setName('per_major/edit-per_major-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{Per_major_id}]', PerMajorController::class . ':delete')->add(PermissionMiddleware::class)->setName('per_major/delete-per_major-delete-2'); // delete
        }
    );

    // error
    $app->any('/error', OthersController::class . ':error')->add(PermissionMiddleware::class)->setName('error');

    // login
    $app->any('/login', OthersController::class . ':login')->add(PermissionMiddleware::class)->setName('login');

    // logout
    $app->any('/logout', OthersController::class . ':logout')->add(PermissionMiddleware::class)->setName('logout');

    // captcha
    $app->any('/captcha[/{page}]', OthersController::class . ':captcha')->add(PermissionMiddleware::class)->setName('captcha');

    // Swagger
    $app->get('/' . Config("SWAGGER_ACTION"), OthersController::class . ':swagger')->setName(Config("SWAGGER_ACTION")); // Swagger

    // Index
    $app->any('/[index]', OthersController::class . ':index')->setName('index');
    if (function_exists(PROJECT_NAMESPACE . "Route_Action")) {
        Route_Action($app);
    }

    /**
     * Catch-all route to serve a 404 Not Found page if none of the routes match
     * NOTE: Make sure this route is defined last.
     */
    $app->map(
        ['GET', 'POST', 'PUT', 'DELETE', 'PATCH'],
        '/{routes:.+}',
        function ($request, $response, $params) {
            $error = [
                "statusCode" => "404",
                "error" => [
                    "class" => "text-warning",
                    "type" => Container("language")->phrase("Error"),
                    "description" => str_replace("%p", $params["routes"], Container("language")->phrase("PageNotFound")),
                ],
            ];
            Container("flash")->addMessage("error", $error);
            return $response->withStatus(302)->withHeader("Location", GetUrl("error")); // Redirect to error page
        }
    );
};
