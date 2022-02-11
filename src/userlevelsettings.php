<?php
/**
 * PHPMaker 2021 user level settings
 */
namespace PHPMaker2021\upPersonnelv2;

// User level info
$USER_LEVELS = [["-2","Anonymous"]];
// User level priv info
$USER_LEVEL_PRIVS = [["{7E075067-9A8E-4402-9644-5EE07AF3E407}01-personnel","-2","0"],
    ["{7E075067-9A8E-4402-9644-5EE07AF3E407}02-selfdevelopment","-2","0"],
    ["{7E075067-9A8E-4402-9644-5EE07AF3E407}03-academicranks","-2","0"],
    ["{7E075067-9A8E-4402-9644-5EE07AF3E407}04-personnelplan","-2","0"],
    ["{7E075067-9A8E-4402-9644-5EE07AF3E407}05-report","-2","0"],
    ["{7E075067-9A8E-4402-9644-5EE07AF3E407}academicbook","-2","0"],
    ["{7E075067-9A8E-4402-9644-5EE07AF3E407}academicpublic","-2","0"],
    ["{7E075067-9A8E-4402-9644-5EE07AF3E407}award","-2","0"],
    ["{7E075067-9A8E-4402-9644-5EE07AF3E407}graduation","-2","0"],
    ["{7E075067-9A8E-4402-9644-5EE07AF3E407}studyleave","-2","0"],
    ["{7E075067-9A8E-4402-9644-5EE07AF3E407}studyleavetype","-2","0"],
    ["{7E075067-9A8E-4402-9644-5EE07AF3E407}per_academic","-2","0"],
    ["{7E075067-9A8E-4402-9644-5EE07AF3E407}per_administrative","-2","0"],
    ["{7E075067-9A8E-4402-9644-5EE07AF3E407}per_employeetype","-2","0"],
    ["{7E075067-9A8E-4402-9644-5EE07AF3E407}per_nationality","-2","0"],
    ["{7E075067-9A8E-4402-9644-5EE07AF3E407}per_position","-2","0"],
    ["{7E075067-9A8E-4402-9644-5EE07AF3E407}per_religion","-2","0"],
    ["{7E075067-9A8E-4402-9644-5EE07AF3E407}per_type","-2","0"],
    ["{7E075067-9A8E-4402-9644-5EE07AF3E407}per_workstatus","-2","0"],
    ["{7E075067-9A8E-4402-9644-5EE07AF3E407}users","-2","0"],
    ["{7E075067-9A8E-4402-9644-5EE07AF3E407}selfdev_type","-2","0"],
    ["{7E075067-9A8E-4402-9644-5EE07AF3E407}book_type","-2","0"],
    ["{7E075067-9A8E-4402-9644-5EE07AF3E407}public_type","-2","0"],
    ["{7E075067-9A8E-4402-9644-5EE07AF3E407}grad_admission","-2","0"],
    ["{7E075067-9A8E-4402-9644-5EE07AF3E407}per_major","-2","0"]];
// User level table info
$USER_LEVEL_TABLES = [["01-personnel","_01personnel","ข้อมูลบุคลากร",true,"{7E075067-9A8E-4402-9644-5EE07AF3E407}"],
    ["02-selfdevelopment","_02selfdevelopment","การพัฒนาตนเอง",true,"{7E075067-9A8E-4402-9644-5EE07AF3E407}"],
    ["03-academicranks","_03academicranks","การขอกำหนดตำแหน่งทางวิชาการ",true,"{7E075067-9A8E-4402-9644-5EE07AF3E407}"],
    ["04-personnelplan","_04personnelplan","แผนพัฒนาบุคลากร",true,"{7E075067-9A8E-4402-9644-5EE07AF3E407}"],
    ["05-report","_05report","รายงานผลการดำเนินงาน",true,"{7E075067-9A8E-4402-9644-5EE07AF3E407}"],
    ["academicbook","academicbook",">> ข้อมูลหนังสือ",true,"{7E075067-9A8E-4402-9644-5EE07AF3E407}"],
    ["academicpublic","academicpublic",">> ข้อมูลการตีพิมพ์เผยแพร่",true,"{7E075067-9A8E-4402-9644-5EE07AF3E407}"],
    ["award","award",">> รางวัล",true,"{7E075067-9A8E-4402-9644-5EE07AF3E407}"],
    ["graduation","graduation",">> ข้อมูลการศึกษา",true,"{7E075067-9A8E-4402-9644-5EE07AF3E407}"],
    ["studyleave","studyleave",">> ข้อมูลการลาศึกษาต่อ",true,"{7E075067-9A8E-4402-9644-5EE07AF3E407}"],
    ["studyleavetype","studyleavetype",">>> ประเภทข้อมูลการลาศึกษาต่อ",true,"{7E075067-9A8E-4402-9644-5EE07AF3E407}"],
    ["per_academic","per_academic",">>> ประเภทตำแหน่งทางวิชาการ",true,"{7E075067-9A8E-4402-9644-5EE07AF3E407}"],
    ["per_administrative","per_administrative",">>> ประเภทตำแหน่งบริหาร",true,"{7E075067-9A8E-4402-9644-5EE07AF3E407}"],
    ["per_employeetype","per_employeetype",">>> ประเภทตำแหน่งพนักงาน",true,"{7E075067-9A8E-4402-9644-5EE07AF3E407}"],
    ["per_nationality","per_nationality",">>> ประเภทสัญชาติ",true,"{7E075067-9A8E-4402-9644-5EE07AF3E407}"],
    ["per_position","per_position",">>> ประเภทตำแหน่งงาน",true,"{7E075067-9A8E-4402-9644-5EE07AF3E407}"],
    ["per_religion","per_religion",">>> ประเภทศาสนา",true,"{7E075067-9A8E-4402-9644-5EE07AF3E407}"],
    ["per_type","per_type",">>> ประเภทบุคลากร",true,"{7E075067-9A8E-4402-9644-5EE07AF3E407}"],
    ["per_workstatus","per_workstatus",">>> ประเภทสถานะปฏิบัติงาน",true,"{7E075067-9A8E-4402-9644-5EE07AF3E407}"],
    ["users","users",">> สมาชิก",true,"{7E075067-9A8E-4402-9644-5EE07AF3E407}"],
    ["selfdev_type","selfdev_type",">>> ประเภทการพัฒนาตนเอง",true,"{7E075067-9A8E-4402-9644-5EE07AF3E407}"],
    ["book_type","book_type",">>> ประเภทเอกสารประกอบ",true,"{7E075067-9A8E-4402-9644-5EE07AF3E407}"],
    ["public_type","public_type",">>> ประเภทการเผยแพร่ผลงาน",true,"{7E075067-9A8E-4402-9644-5EE07AF3E407}"],
    ["grad_admission","grad_admission",">>> ประเภทวุฒิที่ใช้บรรจุ",true,"{7E075067-9A8E-4402-9644-5EE07AF3E407}"],
    ["per_major","per_major",">>> สาขาวิชา",true,"{7E075067-9A8E-4402-9644-5EE07AF3E407}"]];
