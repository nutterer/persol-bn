<?php

namespace PHPMaker2021\upPersonnelv2;

use Slim\Views\PhpRenderer;
use Slim\Csrf\Guard;
use Psr\Container\ContainerInterface;
use Monolog\Logger;
use Monolog\Handler\RotatingFileHandler;
use Doctrine\DBAL\Logging\LoggerChain;
use Doctrine\DBAL\Logging\DebugStack;

return [
    "cache" => function (ContainerInterface $c) {
        return new \Slim\HttpCache\CacheProvider();
    },
    "view" => function (ContainerInterface $c) {
        return new PhpRenderer("views/");
    },
    "flash" => function (ContainerInterface $c) {
        return new \Slim\Flash\Messages();
    },
    "audit" => function (ContainerInterface $c) {
        $logger = new Logger("audit"); // For audit trail
        $logger->pushHandler(new AuditTrailHandler("audit.log"));
        return $logger;
    },
    "log" => function (ContainerInterface $c) {
        $logger = new Logger("log");
        $logger->pushHandler(new RotatingFileHandler("log.log"));
        return $logger;
    },
    "sqllogger" => function (ContainerInterface $c) {
        $loggers = [];
        if (Config("DEBUG")) {
            $loggers[] = $c->get("debugstack");
        }
        return (count($loggers) > 0) ? new LoggerChain($loggers) : null;
    },
    "csrf" => function (ContainerInterface $c) {
        global $ResponseFactory;
        return new Guard($ResponseFactory, Config("CSRF_PREFIX"));
    },
    "debugstack" => \DI\create(DebugStack::class),
    "debugsqllogger" => \DI\create(DebugSqlLogger::class),
    "security" => \DI\create(AdvancedSecurity::class),
    "profile" => \DI\create(UserProfile::class),
    "language" => \DI\create(Language::class),
    "timer" => \DI\create(Timer::class),

    // Tables
    "_01personnel" => \DI\create(_01personnel::class),
    "_02selfdevelopment" => \DI\create(_02selfdevelopment::class),
    "_03academicranks" => \DI\create(_03academicranks::class),
    "_04personnelplan" => \DI\create(_04personnelplan::class),
    "_05report" => \DI\create(_05report::class),
    "academicbook" => \DI\create(Academicbook::class),
    "academicpublic" => \DI\create(Academicpublic::class),
    "award" => \DI\create(Award::class),
    "graduation" => \DI\create(Graduation::class),
    "studyleave" => \DI\create(Studyleave::class),
    "studyleavetype" => \DI\create(Studyleavetype::class),
    "per_academic" => \DI\create(PerAcademic::class),
    "per_administrative" => \DI\create(PerAdministrative::class),
    "per_employeetype" => \DI\create(PerEmployeetype::class),
    "per_nationality" => \DI\create(PerNationality::class),
    "per_position" => \DI\create(PerPosition::class),
    "per_religion" => \DI\create(PerReligion::class),
    "per_type" => \DI\create(PerType::class),
    "per_workstatus" => \DI\create(PerWorkstatus::class),
    "users" => \DI\create(Users::class),
    "selfdev_type" => \DI\create(SelfdevType::class),
    "book_type" => \DI\create(BookType::class),
    "public_type" => \DI\create(PublicType::class),
    "grad_admission" => \DI\create(GradAdmission::class),
    "per_major" => \DI\create(PerMajor::class),
];
