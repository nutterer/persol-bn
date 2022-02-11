<?php

namespace PHPMaker2021\upPersonnel;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for personnel
 */
class Personnel extends DbTable
{
    protected $SqlFrom = "";
    protected $SqlSelect = null;
    protected $SqlSelectList = null;
    protected $SqlWhere = "";
    protected $SqlGroupBy = "";
    protected $SqlHaving = "";
    protected $SqlOrderBy = "";
    public $UseSessionForListSql = true;

    // Column CSS classes
    public $LeftColumnClass = "col-sm-2 col-form-label ew-label";
    public $RightColumnClass = "col-sm-10";
    public $OffsetColumnClass = "col-sm-10 offset-sm-2";
    public $TableLeftColumnClass = "w-col-2";

    // Export
    public $ExportDoc;

    // Fields
    public $Per_Id;
    public $Per_ThaiPre;
    public $Per_ThaiName;
    public $Per_ThaiLastName;
    public $Per_EngPre;
    public $Per_EngName;
    public $Per_EngLastName;
    public $Per_Type;
    public $Per_EmployeeType;
    public $Per_Position;
    public $Per_Academic;
    public $Per_Administrative;
    public $Per_WorDateStart;
    public $Per_WorkDate;
    public $Per_WorkStatus;
    public $Per_Born;
    public $Per_Nationality;
    public $Per_Religion;
    public $Per_IdCard;
    public $Per_Phone;
    public $Per_UPEmail;
    public $Per_Email;
    public $Per_Address;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'personnel';
        $this->TableName = 'personnel';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "`personnel`";
        $this->Dbid = 'DB';
        $this->ExportAll = true;
        $this->ExportPageBreakCount = 0; // Page break per every n record (PDF only)
        $this->ExportPageOrientation = "portrait"; // Page orientation (PDF only)
        $this->ExportPageSize = "a4"; // Page size (PDF only)
        $this->ExportExcelPageOrientation = ""; // Page orientation (PhpSpreadsheet only)
        $this->ExportExcelPageSize = ""; // Page size (PhpSpreadsheet only)
        $this->ExportWordPageOrientation = "portrait"; // Page orientation (PHPWord only)
        $this->ExportWordColumnWidth = null; // Cell width (PHPWord only)
        $this->DetailAdd = false; // Allow detail add
        $this->DetailEdit = false; // Allow detail edit
        $this->DetailView = false; // Allow detail view
        $this->ShowMultipleDetails = false; // Show multiple details
        $this->GridAddRowCount = 5;
        $this->AllowAddDeleteRow = true; // Allow add/delete row
        $this->UserIDAllowSecurity = Config("DEFAULT_USER_ID_ALLOW_SECURITY"); // Default User ID allowed permissions
        $this->BasicSearch = new BasicSearch($this->TableVar);

        // Per_Id
        $this->Per_Id = new DbField('personnel', 'personnel', 'x_Per_Id', 'Per_Id', '`Per_Id`', '`Per_Id`', 3, 10, -1, false, '`Per_Id`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Per_Id->IsPrimaryKey = true; // Primary key field
        $this->Per_Id->Nullable = false; // NOT NULL field
        $this->Per_Id->Required = true; // Required field
        $this->Per_Id->Sortable = true; // Allow sort
        $this->Per_Id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['Per_Id'] = &$this->Per_Id;

        // Per_ThaiPre
        $this->Per_ThaiPre = new DbField('personnel', 'personnel', 'x_Per_ThaiPre', 'Per_ThaiPre', '`Per_ThaiPre`', '`Per_ThaiPre`', 200, 100, -1, false, '`Per_ThaiPre`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Per_ThaiPre->Nullable = false; // NOT NULL field
        $this->Per_ThaiPre->Required = true; // Required field
        $this->Per_ThaiPre->Sortable = true; // Allow sort
        $this->Fields['Per_ThaiPre'] = &$this->Per_ThaiPre;

        // Per_ThaiName
        $this->Per_ThaiName = new DbField('personnel', 'personnel', 'x_Per_ThaiName', 'Per_ThaiName', '`Per_ThaiName`', '`Per_ThaiName`', 200, 100, -1, false, '`Per_ThaiName`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Per_ThaiName->Nullable = false; // NOT NULL field
        $this->Per_ThaiName->Required = true; // Required field
        $this->Per_ThaiName->Sortable = true; // Allow sort
        $this->Fields['Per_ThaiName'] = &$this->Per_ThaiName;

        // Per_ThaiLastName
        $this->Per_ThaiLastName = new DbField('personnel', 'personnel', 'x_Per_ThaiLastName', 'Per_ThaiLastName', '`Per_ThaiLastName`', '`Per_ThaiLastName`', 200, 100, -1, false, '`Per_ThaiLastName`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Per_ThaiLastName->Nullable = false; // NOT NULL field
        $this->Per_ThaiLastName->Required = true; // Required field
        $this->Per_ThaiLastName->Sortable = true; // Allow sort
        $this->Fields['Per_ThaiLastName'] = &$this->Per_ThaiLastName;

        // Per_EngPre
        $this->Per_EngPre = new DbField('personnel', 'personnel', 'x_Per_EngPre', 'Per_EngPre', '`Per_EngPre`', '`Per_EngPre`', 200, 100, -1, false, '`Per_EngPre`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Per_EngPre->Nullable = false; // NOT NULL field
        $this->Per_EngPre->Required = true; // Required field
        $this->Per_EngPre->Sortable = true; // Allow sort
        $this->Fields['Per_EngPre'] = &$this->Per_EngPre;

        // Per_EngName
        $this->Per_EngName = new DbField('personnel', 'personnel', 'x_Per_EngName', 'Per_EngName', '`Per_EngName`', '`Per_EngName`', 200, 100, -1, false, '`Per_EngName`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Per_EngName->Nullable = false; // NOT NULL field
        $this->Per_EngName->Required = true; // Required field
        $this->Per_EngName->Sortable = true; // Allow sort
        $this->Fields['Per_EngName'] = &$this->Per_EngName;

        // Per_EngLastName
        $this->Per_EngLastName = new DbField('personnel', 'personnel', 'x_Per_EngLastName', 'Per_EngLastName', '`Per_EngLastName`', '`Per_EngLastName`', 200, 100, -1, false, '`Per_EngLastName`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Per_EngLastName->Nullable = false; // NOT NULL field
        $this->Per_EngLastName->Required = true; // Required field
        $this->Per_EngLastName->Sortable = true; // Allow sort
        $this->Fields['Per_EngLastName'] = &$this->Per_EngLastName;

        // Per_Type
        $this->Per_Type = new DbField('personnel', 'personnel', 'x_Per_Type', 'Per_Type', '`Per_Type`', '`Per_Type`', 200, 100, -1, false, '`Per_Type`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Per_Type->Nullable = false; // NOT NULL field
        $this->Per_Type->Required = true; // Required field
        $this->Per_Type->Sortable = true; // Allow sort
        $this->Fields['Per_Type'] = &$this->Per_Type;

        // Per_EmployeeType
        $this->Per_EmployeeType = new DbField('personnel', 'personnel', 'x_Per_EmployeeType', 'Per_EmployeeType', '`Per_EmployeeType`', '`Per_EmployeeType`', 200, 100, -1, false, '`Per_EmployeeType`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Per_EmployeeType->Nullable = false; // NOT NULL field
        $this->Per_EmployeeType->Required = true; // Required field
        $this->Per_EmployeeType->Sortable = true; // Allow sort
        $this->Fields['Per_EmployeeType'] = &$this->Per_EmployeeType;

        // Per_Position
        $this->Per_Position = new DbField('personnel', 'personnel', 'x_Per_Position', 'Per_Position', '`Per_Position`', '`Per_Position`', 200, 100, -1, false, '`Per_Position`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Per_Position->Nullable = false; // NOT NULL field
        $this->Per_Position->Required = true; // Required field
        $this->Per_Position->Sortable = true; // Allow sort
        $this->Fields['Per_Position'] = &$this->Per_Position;

        // Per_Academic
        $this->Per_Academic = new DbField('personnel', 'personnel', 'x_Per_Academic', 'Per_Academic', '`Per_Academic`', '`Per_Academic`', 200, 100, -1, false, '`Per_Academic`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Per_Academic->Nullable = false; // NOT NULL field
        $this->Per_Academic->Required = true; // Required field
        $this->Per_Academic->Sortable = true; // Allow sort
        $this->Fields['Per_Academic'] = &$this->Per_Academic;

        // Per_Administrative
        $this->Per_Administrative = new DbField('personnel', 'personnel', 'x_Per_Administrative', 'Per_Administrative', '`Per_Administrative`', '`Per_Administrative`', 200, 100, -1, false, '`Per_Administrative`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Per_Administrative->Nullable = false; // NOT NULL field
        $this->Per_Administrative->Required = true; // Required field
        $this->Per_Administrative->Sortable = true; // Allow sort
        $this->Fields['Per_Administrative'] = &$this->Per_Administrative;

        // Per_WorDateStart
        $this->Per_WorDateStart = new DbField('personnel', 'personnel', 'x_Per_WorDateStart', 'Per_WorDateStart', '`Per_WorDateStart`', CastDateFieldForLike("`Per_WorDateStart`", 0, "DB"), 133, 10, 0, false, '`Per_WorDateStart`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Per_WorDateStart->Nullable = false; // NOT NULL field
        $this->Per_WorDateStart->Required = true; // Required field
        $this->Per_WorDateStart->Sortable = true; // Allow sort
        $this->Per_WorDateStart->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->Fields['Per_WorDateStart'] = &$this->Per_WorDateStart;

        // Per_WorkDate
        $this->Per_WorkDate = new DbField('personnel', 'personnel', 'x_Per_WorkDate', 'Per_WorkDate', '`Per_WorkDate`', CastDateFieldForLike("`Per_WorkDate`", 0, "DB"), 133, 10, 0, false, '`Per_WorkDate`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Per_WorkDate->Nullable = false; // NOT NULL field
        $this->Per_WorkDate->Required = true; // Required field
        $this->Per_WorkDate->Sortable = true; // Allow sort
        $this->Per_WorkDate->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->Fields['Per_WorkDate'] = &$this->Per_WorkDate;

        // Per_WorkStatus
        $this->Per_WorkStatus = new DbField('personnel', 'personnel', 'x_Per_WorkStatus', 'Per_WorkStatus', '`Per_WorkStatus`', '`Per_WorkStatus`', 200, 10, -1, false, '`Per_WorkStatus`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Per_WorkStatus->Nullable = false; // NOT NULL field
        $this->Per_WorkStatus->Required = true; // Required field
        $this->Per_WorkStatus->Sortable = true; // Allow sort
        $this->Fields['Per_WorkStatus'] = &$this->Per_WorkStatus;

        // Per_Born
        $this->Per_Born = new DbField('personnel', 'personnel', 'x_Per_Born', 'Per_Born', '`Per_Born`', CastDateFieldForLike("`Per_Born`", 0, "DB"), 133, 10, 0, false, '`Per_Born`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Per_Born->Nullable = false; // NOT NULL field
        $this->Per_Born->Required = true; // Required field
        $this->Per_Born->Sortable = true; // Allow sort
        $this->Per_Born->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->Fields['Per_Born'] = &$this->Per_Born;

        // Per_Nationality
        $this->Per_Nationality = new DbField('personnel', 'personnel', 'x_Per_Nationality', 'Per_Nationality', '`Per_Nationality`', '`Per_Nationality`', 200, 50, -1, false, '`Per_Nationality`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Per_Nationality->Nullable = false; // NOT NULL field
        $this->Per_Nationality->Required = true; // Required field
        $this->Per_Nationality->Sortable = true; // Allow sort
        $this->Fields['Per_Nationality'] = &$this->Per_Nationality;

        // Per_Religion
        $this->Per_Religion = new DbField('personnel', 'personnel', 'x_Per_Religion', 'Per_Religion', '`Per_Religion`', '`Per_Religion`', 200, 20, -1, false, '`Per_Religion`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Per_Religion->Nullable = false; // NOT NULL field
        $this->Per_Religion->Required = true; // Required field
        $this->Per_Religion->Sortable = true; // Allow sort
        $this->Fields['Per_Religion'] = &$this->Per_Religion;

        // Per_IdCard
        $this->Per_IdCard = new DbField('personnel', 'personnel', 'x_Per_IdCard', 'Per_IdCard', '`Per_IdCard`', '`Per_IdCard`', 200, 13, -1, false, '`Per_IdCard`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Per_IdCard->Nullable = false; // NOT NULL field
        $this->Per_IdCard->Required = true; // Required field
        $this->Per_IdCard->Sortable = true; // Allow sort
        $this->Fields['Per_IdCard'] = &$this->Per_IdCard;

        // Per_Phone
        $this->Per_Phone = new DbField('personnel', 'personnel', 'x_Per_Phone', 'Per_Phone', '`Per_Phone`', '`Per_Phone`', 200, 10, -1, false, '`Per_Phone`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Per_Phone->Nullable = false; // NOT NULL field
        $this->Per_Phone->Required = true; // Required field
        $this->Per_Phone->Sortable = true; // Allow sort
        $this->Fields['Per_Phone'] = &$this->Per_Phone;

        // Per_UPEmail
        $this->Per_UPEmail = new DbField('personnel', 'personnel', 'x_Per_UPEmail', 'Per_UPEmail', '`Per_UPEmail`', '`Per_UPEmail`', 200, 100, -1, false, '`Per_UPEmail`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Per_UPEmail->Nullable = false; // NOT NULL field
        $this->Per_UPEmail->Required = true; // Required field
        $this->Per_UPEmail->Sortable = true; // Allow sort
        $this->Fields['Per_UPEmail'] = &$this->Per_UPEmail;

        // Per_Email
        $this->Per_Email = new DbField('personnel', 'personnel', 'x_Per_Email', 'Per_Email', '`Per_Email`', '`Per_Email`', 200, 100, -1, false, '`Per_Email`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Per_Email->Nullable = false; // NOT NULL field
        $this->Per_Email->Required = true; // Required field
        $this->Per_Email->Sortable = true; // Allow sort
        $this->Fields['Per_Email'] = &$this->Per_Email;

        // Per_Address
        $this->Per_Address = new DbField('personnel', 'personnel', 'x_Per_Address', 'Per_Address', '`Per_Address`', '`Per_Address`', 200, 255, -1, false, '`Per_Address`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Per_Address->Nullable = false; // NOT NULL field
        $this->Per_Address->Required = true; // Required field
        $this->Per_Address->Sortable = true; // Allow sort
        $this->Fields['Per_Address'] = &$this->Per_Address;
    }

    // Field Visibility
    public function getFieldVisibility($fldParm)
    {
        global $Security;
        return $this->$fldParm->Visible; // Returns original value
    }

    // Set left column class (must be predefined col-*-* classes of Bootstrap grid system)
    public function setLeftColumnClass($class)
    {
        if (preg_match('/^col\-(\w+)\-(\d+)$/', $class, $match)) {
            $this->LeftColumnClass = $class . " col-form-label ew-label";
            $this->RightColumnClass = "col-" . $match[1] . "-" . strval(12 - (int)$match[2]);
            $this->OffsetColumnClass = $this->RightColumnClass . " " . str_replace("col-", "offset-", $class);
            $this->TableLeftColumnClass = preg_replace('/^col-\w+-(\d+)$/', "w-col-$1", $class); // Change to w-col-*
        }
    }

    // Single column sort
    public function updateSort(&$fld)
    {
        if ($this->CurrentOrder == $fld->Name) {
            $sortField = $fld->Expression;
            $lastSort = $fld->getSort();
            if (in_array($this->CurrentOrderType, ["ASC", "DESC", "NO"])) {
                $curSort = $this->CurrentOrderType;
            } else {
                $curSort = $lastSort;
            }
            $fld->setSort($curSort);
            $orderBy = in_array($curSort, ["ASC", "DESC"]) ? $sortField . " " . $curSort : "";
            $this->setSessionOrderBy($orderBy); // Save to Session
        } else {
            $fld->setSort("");
        }
    }

    // Table level SQL
    public function getSqlFrom() // From
    {
        return ($this->SqlFrom != "") ? $this->SqlFrom : "`personnel`";
    }

    public function sqlFrom() // For backward compatibility
    {
        return $this->getSqlFrom();
    }

    public function setSqlFrom($v)
    {
        $this->SqlFrom = $v;
    }

    public function getSqlSelect() // Select
    {
        return $this->SqlSelect ?? $this->getQueryBuilder()->select("*");
    }

    public function sqlSelect() // For backward compatibility
    {
        return $this->getSqlSelect();
    }

    public function setSqlSelect($v)
    {
        $this->SqlSelect = $v;
    }

    public function getSqlWhere() // Where
    {
        $where = ($this->SqlWhere != "") ? $this->SqlWhere : "";
        $this->DefaultFilter = "";
        AddFilter($where, $this->DefaultFilter);
        return $where;
    }

    public function sqlWhere() // For backward compatibility
    {
        return $this->getSqlWhere();
    }

    public function setSqlWhere($v)
    {
        $this->SqlWhere = $v;
    }

    public function getSqlGroupBy() // Group By
    {
        return ($this->SqlGroupBy != "") ? $this->SqlGroupBy : "";
    }

    public function sqlGroupBy() // For backward compatibility
    {
        return $this->getSqlGroupBy();
    }

    public function setSqlGroupBy($v)
    {
        $this->SqlGroupBy = $v;
    }

    public function getSqlHaving() // Having
    {
        return ($this->SqlHaving != "") ? $this->SqlHaving : "";
    }

    public function sqlHaving() // For backward compatibility
    {
        return $this->getSqlHaving();
    }

    public function setSqlHaving($v)
    {
        $this->SqlHaving = $v;
    }

    public function getSqlOrderBy() // Order By
    {
        return ($this->SqlOrderBy != "") ? $this->SqlOrderBy : $this->DefaultSort;
    }

    public function sqlOrderBy() // For backward compatibility
    {
        return $this->getSqlOrderBy();
    }

    public function setSqlOrderBy($v)
    {
        $this->SqlOrderBy = $v;
    }

    // Apply User ID filters
    public function applyUserIDFilters($filter)
    {
        return $filter;
    }

    // Check if User ID security allows view all
    public function userIDAllow($id = "")
    {
        $allow = $this->UserIDAllowSecurity;
        switch ($id) {
            case "add":
            case "copy":
            case "gridadd":
            case "register":
            case "addopt":
                return (($allow & 1) == 1);
            case "edit":
            case "gridedit":
            case "update":
            case "changepassword":
            case "resetpassword":
                return (($allow & 4) == 4);
            case "delete":
                return (($allow & 2) == 2);
            case "view":
                return (($allow & 32) == 32);
            case "search":
                return (($allow & 64) == 64);
            default:
                return (($allow & 8) == 8);
        }
    }

    /**
     * Get record count
     *
     * @param string|QueryBuilder $sql SQL or QueryBuilder
     * @param mixed $c Connection
     * @return int
     */
    public function getRecordCount($sql, $c = null)
    {
        $cnt = -1;
        $rs = null;
        if ($sql instanceof \Doctrine\DBAL\Query\QueryBuilder) { // Query builder
            $sql = $sql->resetQueryPart("orderBy")->getSQL();
        }
        $pattern = '/^SELECT\s([\s\S]+)\sFROM\s/i';
        // Skip Custom View / SubQuery / SELECT DISTINCT / ORDER BY
        if (
            ($this->TableType == 'TABLE' || $this->TableType == 'VIEW' || $this->TableType == 'LINKTABLE') &&
            preg_match($pattern, $sql) && !preg_match('/\(\s*(SELECT[^)]+)\)/i', $sql) &&
            !preg_match('/^\s*select\s+distinct\s+/i', $sql) && !preg_match('/\s+order\s+by\s+/i', $sql)
        ) {
            $sqlwrk = "SELECT COUNT(*) FROM " . preg_replace($pattern, "", $sql);
        } else {
            $sqlwrk = "SELECT COUNT(*) FROM (" . $sql . ") COUNT_TABLE";
        }
        $conn = $c ?? $this->getConnection();
        $rs = $conn->executeQuery($sqlwrk);
        $cnt = $rs->fetchColumn();
        if ($cnt !== false) {
            return (int)$cnt;
        }

        // Unable to get count by SELECT COUNT(*), execute the SQL to get record count directly
        return ExecuteRecordCount($sql, $conn);
    }

    // Get SQL
    public function getSql($where, $orderBy = "")
    {
        return $this->buildSelectSql(
            $this->getSqlSelect(),
            $this->getSqlFrom(),
            $this->getSqlWhere(),
            $this->getSqlGroupBy(),
            $this->getSqlHaving(),
            $this->getSqlOrderBy(),
            $where,
            $orderBy
        )->getSQL();
    }

    // Table SQL
    public function getCurrentSql()
    {
        $filter = $this->CurrentFilter;
        $filter = $this->applyUserIDFilters($filter);
        $sort = $this->getSessionOrderBy();
        return $this->getSql($filter, $sort);
    }

    /**
     * Table SQL with List page filter
     *
     * @return QueryBuilder
     */
    public function getListSql()
    {
        $filter = $this->UseSessionForListSql ? $this->getSessionWhere() : "";
        AddFilter($filter, $this->CurrentFilter);
        $filter = $this->applyUserIDFilters($filter);
        $this->recordsetSelecting($filter);
        $select = $this->getSqlSelect();
        $from = $this->getSqlFrom();
        $sort = $this->UseSessionForListSql ? $this->getSessionOrderBy() : "";
        $this->Sort = $sort;
        return $this->buildSelectSql(
            $select,
            $from,
            $this->getSqlWhere(),
            $this->getSqlGroupBy(),
            $this->getSqlHaving(),
            $this->getSqlOrderBy(),
            $filter,
            $sort
        );
    }

    // Get ORDER BY clause
    public function getOrderBy()
    {
        $orderBy = $this->getSqlOrderBy();
        $sort = $this->getSessionOrderBy();
        if ($orderBy != "" && $sort != "") {
            $orderBy .= ", " . $sort;
        } elseif ($sort != "") {
            $orderBy = $sort;
        }
        return $orderBy;
    }

    // Get record count based on filter (for detail record count in master table pages)
    public function loadRecordCount($filter)
    {
        $origFilter = $this->CurrentFilter;
        $this->CurrentFilter = $filter;
        $this->recordsetSelecting($this->CurrentFilter);
        $select = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlSelect() : $this->getQueryBuilder()->select("*");
        $groupBy = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlGroupBy() : "";
        $having = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlHaving() : "";
        $sql = $this->buildSelectSql($select, $this->getSqlFrom(), $this->getSqlWhere(), $groupBy, $having, "", $this->CurrentFilter, "");
        $cnt = $this->getRecordCount($sql);
        $this->CurrentFilter = $origFilter;
        return $cnt;
    }

    // Get record count (for current List page)
    public function listRecordCount()
    {
        $filter = $this->getSessionWhere();
        AddFilter($filter, $this->CurrentFilter);
        $filter = $this->applyUserIDFilters($filter);
        $this->recordsetSelecting($filter);
        $select = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlSelect() : $this->getQueryBuilder()->select("*");
        $groupBy = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlGroupBy() : "";
        $having = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlHaving() : "";
        $sql = $this->buildSelectSql($select, $this->getSqlFrom(), $this->getSqlWhere(), $groupBy, $having, "", $filter, "");
        $cnt = $this->getRecordCount($sql);
        return $cnt;
    }

    /**
     * INSERT statement
     *
     * @param mixed $rs
     * @return QueryBuilder
     */
    protected function insertSql(&$rs)
    {
        $queryBuilder = $this->getQueryBuilder();
        $queryBuilder->insert($this->UpdateTable);
        foreach ($rs as $name => $value) {
            if (!isset($this->Fields[$name]) || $this->Fields[$name]->IsCustom) {
                continue;
            }
            $type = GetParameterType($this->Fields[$name], $value, $this->Dbid);
            $queryBuilder->setValue($this->Fields[$name]->Expression, $queryBuilder->createPositionalParameter($value, $type));
        }
        return $queryBuilder;
    }

    // Insert
    public function insert(&$rs)
    {
        $conn = $this->getConnection();
        $success = $this->insertSql($rs)->execute();
        if ($success) {
        }
        return $success;
    }

    /**
     * UPDATE statement
     *
     * @param array $rs Data to be updated
     * @param string|array $where WHERE clause
     * @param string $curfilter Filter
     * @return QueryBuilder
     */
    protected function updateSql(&$rs, $where = "", $curfilter = true)
    {
        $queryBuilder = $this->getQueryBuilder();
        $queryBuilder->update($this->UpdateTable);
        foreach ($rs as $name => $value) {
            if (!isset($this->Fields[$name]) || $this->Fields[$name]->IsCustom || $this->Fields[$name]->IsAutoIncrement) {
                continue;
            }
            $type = GetParameterType($this->Fields[$name], $value, $this->Dbid);
            $queryBuilder->set($this->Fields[$name]->Expression, $queryBuilder->createPositionalParameter($value, $type));
        }
        $filter = ($curfilter) ? $this->CurrentFilter : "";
        if (is_array($where)) {
            $where = $this->arrayToFilter($where);
        }
        AddFilter($filter, $where);
        if ($filter != "") {
            $queryBuilder->where($filter);
        }
        return $queryBuilder;
    }

    // Update
    public function update(&$rs, $where = "", $rsold = null, $curfilter = true)
    {
        // If no field is updated, execute may return 0. Treat as success
        $success = $this->updateSql($rs, $where, $curfilter)->execute();
        $success = ($success > 0) ? $success : true;
        return $success;
    }

    /**
     * DELETE statement
     *
     * @param array $rs Key values
     * @param string|array $where WHERE clause
     * @param string $curfilter Filter
     * @return QueryBuilder
     */
    protected function deleteSql(&$rs, $where = "", $curfilter = true)
    {
        $queryBuilder = $this->getQueryBuilder();
        $queryBuilder->delete($this->UpdateTable);
        if (is_array($where)) {
            $where = $this->arrayToFilter($where);
        }
        if ($rs) {
            if (array_key_exists('Per_Id', $rs)) {
                AddFilter($where, QuotedName('Per_Id', $this->Dbid) . '=' . QuotedValue($rs['Per_Id'], $this->Per_Id->DataType, $this->Dbid));
            }
        }
        $filter = ($curfilter) ? $this->CurrentFilter : "";
        AddFilter($filter, $where);
        return $queryBuilder->where($filter != "" ? $filter : "0=1");
    }

    // Delete
    public function delete(&$rs, $where = "", $curfilter = false)
    {
        $success = true;
        if ($success) {
            $success = $this->deleteSql($rs, $where, $curfilter)->execute();
        }
        return $success;
    }

    // Load DbValue from recordset or array
    protected function loadDbValues($row)
    {
        if (!is_array($row)) {
            return;
        }
        $this->Per_Id->DbValue = $row['Per_Id'];
        $this->Per_ThaiPre->DbValue = $row['Per_ThaiPre'];
        $this->Per_ThaiName->DbValue = $row['Per_ThaiName'];
        $this->Per_ThaiLastName->DbValue = $row['Per_ThaiLastName'];
        $this->Per_EngPre->DbValue = $row['Per_EngPre'];
        $this->Per_EngName->DbValue = $row['Per_EngName'];
        $this->Per_EngLastName->DbValue = $row['Per_EngLastName'];
        $this->Per_Type->DbValue = $row['Per_Type'];
        $this->Per_EmployeeType->DbValue = $row['Per_EmployeeType'];
        $this->Per_Position->DbValue = $row['Per_Position'];
        $this->Per_Academic->DbValue = $row['Per_Academic'];
        $this->Per_Administrative->DbValue = $row['Per_Administrative'];
        $this->Per_WorDateStart->DbValue = $row['Per_WorDateStart'];
        $this->Per_WorkDate->DbValue = $row['Per_WorkDate'];
        $this->Per_WorkStatus->DbValue = $row['Per_WorkStatus'];
        $this->Per_Born->DbValue = $row['Per_Born'];
        $this->Per_Nationality->DbValue = $row['Per_Nationality'];
        $this->Per_Religion->DbValue = $row['Per_Religion'];
        $this->Per_IdCard->DbValue = $row['Per_IdCard'];
        $this->Per_Phone->DbValue = $row['Per_Phone'];
        $this->Per_UPEmail->DbValue = $row['Per_UPEmail'];
        $this->Per_Email->DbValue = $row['Per_Email'];
        $this->Per_Address->DbValue = $row['Per_Address'];
    }

    // Delete uploaded files
    public function deleteUploadedFiles($row)
    {
        $this->loadDbValues($row);
    }

    // Record filter WHERE clause
    protected function sqlKeyFilter()
    {
        return "`Per_Id` = @Per_Id@";
    }

    // Get Key
    public function getKey($current = false)
    {
        $keys = [];
        $val = $current ? $this->Per_Id->CurrentValue : $this->Per_Id->OldValue;
        if (EmptyValue($val)) {
            return "";
        } else {
            $keys[] = $val;
        }
        return implode(Config("COMPOSITE_KEY_SEPARATOR"), $keys);
    }

    // Set Key
    public function setKey($key, $current = false)
    {
        $this->OldKey = strval($key);
        $keys = explode(Config("COMPOSITE_KEY_SEPARATOR"), $this->OldKey);
        if (count($keys) == 1) {
            if ($current) {
                $this->Per_Id->CurrentValue = $keys[0];
            } else {
                $this->Per_Id->OldValue = $keys[0];
            }
        }
    }

    // Get record filter
    public function getRecordFilter($row = null)
    {
        $keyFilter = $this->sqlKeyFilter();
        if (is_array($row)) {
            $val = array_key_exists('Per_Id', $row) ? $row['Per_Id'] : null;
        } else {
            $val = $this->Per_Id->OldValue !== null ? $this->Per_Id->OldValue : $this->Per_Id->CurrentValue;
        }
        if (!is_numeric($val)) {
            return "0=1"; // Invalid key
        }
        if ($val === null) {
            return "0=1"; // Invalid key
        } else {
            $keyFilter = str_replace("@Per_Id@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
        }
        return $keyFilter;
    }

    // Return page URL
    public function getReturnUrl()
    {
        $name = PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_RETURN_URL");
        // Get referer URL automatically
        if (ReferUrl() != "" && ReferPageName() != CurrentPageName() && ReferPageName() != "login") { // Referer not same page or login page
            $_SESSION[$name] = ReferUrl(); // Save to Session
        }
        if (@$_SESSION[$name] != "") {
            return $_SESSION[$name];
        } else {
            return GetUrl("PersonnelList");
        }
    }

    public function setReturnUrl($v)
    {
        $_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_RETURN_URL")] = $v;
    }

    // Get modal caption
    public function getModalCaption($pageName)
    {
        global $Language;
        if ($pageName == "PersonnelView") {
            return $Language->phrase("View");
        } elseif ($pageName == "PersonnelEdit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "PersonnelAdd") {
            return $Language->phrase("Add");
        } else {
            return "";
        }
    }

    // API page name
    public function getApiPageName($action)
    {
        switch (strtolower($action)) {
            case Config("API_VIEW_ACTION"):
                return "PersonnelView";
            case Config("API_ADD_ACTION"):
                return "PersonnelAdd";
            case Config("API_EDIT_ACTION"):
                return "PersonnelEdit";
            case Config("API_DELETE_ACTION"):
                return "PersonnelDelete";
            case Config("API_LIST_ACTION"):
                return "PersonnelList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "PersonnelList";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("PersonnelView", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("PersonnelView", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "PersonnelAdd?" . $this->getUrlParm($parm);
        } else {
            $url = "PersonnelAdd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("PersonnelEdit", $this->getUrlParm($parm));
        return $this->addMasterUrl($url);
    }

    // Inline edit URL
    public function getInlineEditUrl()
    {
        $url = $this->keyUrl(CurrentPageName(), $this->getUrlParm("action=edit"));
        return $this->addMasterUrl($url);
    }

    // Copy URL
    public function getCopyUrl($parm = "")
    {
        $url = $this->keyUrl("PersonnelAdd", $this->getUrlParm($parm));
        return $this->addMasterUrl($url);
    }

    // Inline copy URL
    public function getInlineCopyUrl()
    {
        $url = $this->keyUrl(CurrentPageName(), $this->getUrlParm("action=copy"));
        return $this->addMasterUrl($url);
    }

    // Delete URL
    public function getDeleteUrl()
    {
        return $this->keyUrl("PersonnelDelete", $this->getUrlParm());
    }

    // Add master url
    public function addMasterUrl($url)
    {
        return $url;
    }

    public function keyToJson($htmlEncode = false)
    {
        $json = "";
        $json .= "Per_Id:" . JsonEncode($this->Per_Id->CurrentValue, "number");
        $json = "{" . $json . "}";
        if ($htmlEncode) {
            $json = HtmlEncode($json);
        }
        return $json;
    }

    // Add key value to URL
    public function keyUrl($url, $parm = "")
    {
        if ($this->Per_Id->CurrentValue !== null) {
            $url .= "/" . rawurlencode($this->Per_Id->CurrentValue);
        } else {
            return "javascript:ew.alert(ew.language.phrase('InvalidRecord'));";
        }
        if ($parm != "") {
            $url .= "?" . $parm;
        }
        return $url;
    }

    // Render sort
    public function renderSort($fld)
    {
        $classId = $fld->TableVar . "_" . $fld->Param;
        $scriptId = str_replace("%id%", $classId, "tpc_%id%");
        $scriptStart = $this->UseCustomTemplate ? "<template id=\"" . $scriptId . "\">" : "";
        $scriptEnd = $this->UseCustomTemplate ? "</template>" : "";
        $jsSort = " class=\"ew-pointer\" onclick=\"ew.sort(event, '" . $this->sortUrl($fld) . "', 1);\"";
        if ($this->sortUrl($fld) == "") {
            $html = <<<NOSORTHTML
{$scriptStart}<div class="ew-table-header-caption">{$fld->caption()}</div>{$scriptEnd}
NOSORTHTML;
        } else {
            if ($fld->getSort() == "ASC") {
                $sortIcon = '<i class="fas fa-sort-up"></i>';
            } elseif ($fld->getSort() == "DESC") {
                $sortIcon = '<i class="fas fa-sort-down"></i>';
            } else {
                $sortIcon = '';
            }
            $html = <<<SORTHTML
{$scriptStart}<div{$jsSort}><div class="ew-table-header-btn"><span class="ew-table-header-caption">{$fld->caption()}</span><span class="ew-table-header-sort">{$sortIcon}</span></div></div>{$scriptEnd}
SORTHTML;
        }
        return $html;
    }

    // Sort URL
    public function sortUrl($fld)
    {
        if (
            $this->CurrentAction || $this->isExport() ||
            in_array($fld->Type, [128, 204, 205])
        ) { // Unsortable data type
                return "";
        } elseif ($fld->Sortable) {
            $urlParm = $this->getUrlParm("order=" . urlencode($fld->Name) . "&amp;ordertype=" . $fld->getNextSort());
            return $this->addMasterUrl(CurrentPageName() . "?" . $urlParm);
        } else {
            return "";
        }
    }

    // Get record keys from Post/Get/Session
    public function getRecordKeys()
    {
        $arKeys = [];
        $arKey = [];
        if (Param("key_m") !== null) {
            $arKeys = Param("key_m");
            $cnt = count($arKeys);
        } else {
            if (($keyValue = Param("Per_Id") ?? Route("Per_Id")) !== null) {
                $arKeys[] = $keyValue;
            } elseif (IsApi() && (($keyValue = Key(0) ?? Route(2)) !== null)) {
                $arKeys[] = $keyValue;
            } else {
                $arKeys = null; // Do not setup
            }

            //return $arKeys; // Do not return yet, so the values will also be checked by the following code
        }
        // Check keys
        $ar = [];
        if (is_array($arKeys)) {
            foreach ($arKeys as $key) {
                if (!is_numeric($key)) {
                    continue;
                }
                $ar[] = $key;
            }
        }
        return $ar;
    }

    // Get filter from record keys
    public function getFilterFromRecordKeys($setCurrent = true)
    {
        $arKeys = $this->getRecordKeys();
        $keyFilter = "";
        foreach ($arKeys as $key) {
            if ($keyFilter != "") {
                $keyFilter .= " OR ";
            }
            if ($setCurrent) {
                $this->Per_Id->CurrentValue = $key;
            } else {
                $this->Per_Id->OldValue = $key;
            }
            $keyFilter .= "(" . $this->getRecordFilter() . ")";
        }
        return $keyFilter;
    }

    // Load recordset based on filter
    public function &loadRs($filter)
    {
        $sql = $this->getSql($filter); // Set up filter (WHERE Clause)
        $conn = $this->getConnection();
        $stmt = $conn->executeQuery($sql);
        return $stmt;
    }

    // Load row values from record
    public function loadListRowValues(&$rs)
    {
        if (is_array($rs)) {
            $row = $rs;
        } elseif ($rs && property_exists($rs, "fields")) { // Recordset
            $row = $rs->fields;
        } else {
            return;
        }
        $this->Per_Id->setDbValue($row['Per_Id']);
        $this->Per_ThaiPre->setDbValue($row['Per_ThaiPre']);
        $this->Per_ThaiName->setDbValue($row['Per_ThaiName']);
        $this->Per_ThaiLastName->setDbValue($row['Per_ThaiLastName']);
        $this->Per_EngPre->setDbValue($row['Per_EngPre']);
        $this->Per_EngName->setDbValue($row['Per_EngName']);
        $this->Per_EngLastName->setDbValue($row['Per_EngLastName']);
        $this->Per_Type->setDbValue($row['Per_Type']);
        $this->Per_EmployeeType->setDbValue($row['Per_EmployeeType']);
        $this->Per_Position->setDbValue($row['Per_Position']);
        $this->Per_Academic->setDbValue($row['Per_Academic']);
        $this->Per_Administrative->setDbValue($row['Per_Administrative']);
        $this->Per_WorDateStart->setDbValue($row['Per_WorDateStart']);
        $this->Per_WorkDate->setDbValue($row['Per_WorkDate']);
        $this->Per_WorkStatus->setDbValue($row['Per_WorkStatus']);
        $this->Per_Born->setDbValue($row['Per_Born']);
        $this->Per_Nationality->setDbValue($row['Per_Nationality']);
        $this->Per_Religion->setDbValue($row['Per_Religion']);
        $this->Per_IdCard->setDbValue($row['Per_IdCard']);
        $this->Per_Phone->setDbValue($row['Per_Phone']);
        $this->Per_UPEmail->setDbValue($row['Per_UPEmail']);
        $this->Per_Email->setDbValue($row['Per_Email']);
        $this->Per_Address->setDbValue($row['Per_Address']);
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // Per_Id

        // Per_ThaiPre

        // Per_ThaiName

        // Per_ThaiLastName

        // Per_EngPre

        // Per_EngName

        // Per_EngLastName

        // Per_Type

        // Per_EmployeeType

        // Per_Position

        // Per_Academic

        // Per_Administrative

        // Per_WorDateStart

        // Per_WorkDate

        // Per_WorkStatus

        // Per_Born

        // Per_Nationality

        // Per_Religion

        // Per_IdCard

        // Per_Phone

        // Per_UPEmail

        // Per_Email

        // Per_Address

        // Per_Id
        $this->Per_Id->ViewValue = $this->Per_Id->CurrentValue;
        $this->Per_Id->ViewCustomAttributes = "";

        // Per_ThaiPre
        $this->Per_ThaiPre->ViewValue = $this->Per_ThaiPre->CurrentValue;
        $this->Per_ThaiPre->ViewCustomAttributes = "";

        // Per_ThaiName
        $this->Per_ThaiName->ViewValue = $this->Per_ThaiName->CurrentValue;
        $this->Per_ThaiName->ViewCustomAttributes = "";

        // Per_ThaiLastName
        $this->Per_ThaiLastName->ViewValue = $this->Per_ThaiLastName->CurrentValue;
        $this->Per_ThaiLastName->ViewCustomAttributes = "";

        // Per_EngPre
        $this->Per_EngPre->ViewValue = $this->Per_EngPre->CurrentValue;
        $this->Per_EngPre->ViewCustomAttributes = "";

        // Per_EngName
        $this->Per_EngName->ViewValue = $this->Per_EngName->CurrentValue;
        $this->Per_EngName->ViewCustomAttributes = "";

        // Per_EngLastName
        $this->Per_EngLastName->ViewValue = $this->Per_EngLastName->CurrentValue;
        $this->Per_EngLastName->ViewCustomAttributes = "";

        // Per_Type
        $this->Per_Type->ViewValue = $this->Per_Type->CurrentValue;
        $this->Per_Type->ViewCustomAttributes = "";

        // Per_EmployeeType
        $this->Per_EmployeeType->ViewValue = $this->Per_EmployeeType->CurrentValue;
        $this->Per_EmployeeType->ViewCustomAttributes = "";

        // Per_Position
        $this->Per_Position->ViewValue = $this->Per_Position->CurrentValue;
        $this->Per_Position->ViewCustomAttributes = "";

        // Per_Academic
        $this->Per_Academic->ViewValue = $this->Per_Academic->CurrentValue;
        $this->Per_Academic->ViewCustomAttributes = "";

        // Per_Administrative
        $this->Per_Administrative->ViewValue = $this->Per_Administrative->CurrentValue;
        $this->Per_Administrative->ViewCustomAttributes = "";

        // Per_WorDateStart
        $this->Per_WorDateStart->ViewValue = $this->Per_WorDateStart->CurrentValue;
        $this->Per_WorDateStart->ViewValue = FormatDateTime($this->Per_WorDateStart->ViewValue, 0);
        $this->Per_WorDateStart->ViewCustomAttributes = "";

        // Per_WorkDate
        $this->Per_WorkDate->ViewValue = $this->Per_WorkDate->CurrentValue;
        $this->Per_WorkDate->ViewValue = FormatDateTime($this->Per_WorkDate->ViewValue, 0);
        $this->Per_WorkDate->ViewCustomAttributes = "";

        // Per_WorkStatus
        $this->Per_WorkStatus->ViewValue = $this->Per_WorkStatus->CurrentValue;
        $this->Per_WorkStatus->ViewCustomAttributes = "";

        // Per_Born
        $this->Per_Born->ViewValue = $this->Per_Born->CurrentValue;
        $this->Per_Born->ViewValue = FormatDateTime($this->Per_Born->ViewValue, 0);
        $this->Per_Born->ViewCustomAttributes = "";

        // Per_Nationality
        $this->Per_Nationality->ViewValue = $this->Per_Nationality->CurrentValue;
        $this->Per_Nationality->ViewCustomAttributes = "";

        // Per_Religion
        $this->Per_Religion->ViewValue = $this->Per_Religion->CurrentValue;
        $this->Per_Religion->ViewCustomAttributes = "";

        // Per_IdCard
        $this->Per_IdCard->ViewValue = $this->Per_IdCard->CurrentValue;
        $this->Per_IdCard->ViewCustomAttributes = "";

        // Per_Phone
        $this->Per_Phone->ViewValue = $this->Per_Phone->CurrentValue;
        $this->Per_Phone->ViewCustomAttributes = "";

        // Per_UPEmail
        $this->Per_UPEmail->ViewValue = $this->Per_UPEmail->CurrentValue;
        $this->Per_UPEmail->ViewCustomAttributes = "";

        // Per_Email
        $this->Per_Email->ViewValue = $this->Per_Email->CurrentValue;
        $this->Per_Email->ViewCustomAttributes = "";

        // Per_Address
        $this->Per_Address->ViewValue = $this->Per_Address->CurrentValue;
        $this->Per_Address->ViewCustomAttributes = "";

        // Per_Id
        $this->Per_Id->LinkCustomAttributes = "";
        $this->Per_Id->HrefValue = "";
        $this->Per_Id->TooltipValue = "";

        // Per_ThaiPre
        $this->Per_ThaiPre->LinkCustomAttributes = "";
        $this->Per_ThaiPre->HrefValue = "";
        $this->Per_ThaiPre->TooltipValue = "";

        // Per_ThaiName
        $this->Per_ThaiName->LinkCustomAttributes = "";
        $this->Per_ThaiName->HrefValue = "";
        $this->Per_ThaiName->TooltipValue = "";

        // Per_ThaiLastName
        $this->Per_ThaiLastName->LinkCustomAttributes = "";
        $this->Per_ThaiLastName->HrefValue = "";
        $this->Per_ThaiLastName->TooltipValue = "";

        // Per_EngPre
        $this->Per_EngPre->LinkCustomAttributes = "";
        $this->Per_EngPre->HrefValue = "";
        $this->Per_EngPre->TooltipValue = "";

        // Per_EngName
        $this->Per_EngName->LinkCustomAttributes = "";
        $this->Per_EngName->HrefValue = "";
        $this->Per_EngName->TooltipValue = "";

        // Per_EngLastName
        $this->Per_EngLastName->LinkCustomAttributes = "";
        $this->Per_EngLastName->HrefValue = "";
        $this->Per_EngLastName->TooltipValue = "";

        // Per_Type
        $this->Per_Type->LinkCustomAttributes = "";
        $this->Per_Type->HrefValue = "";
        $this->Per_Type->TooltipValue = "";

        // Per_EmployeeType
        $this->Per_EmployeeType->LinkCustomAttributes = "";
        $this->Per_EmployeeType->HrefValue = "";
        $this->Per_EmployeeType->TooltipValue = "";

        // Per_Position
        $this->Per_Position->LinkCustomAttributes = "";
        $this->Per_Position->HrefValue = "";
        $this->Per_Position->TooltipValue = "";

        // Per_Academic
        $this->Per_Academic->LinkCustomAttributes = "";
        $this->Per_Academic->HrefValue = "";
        $this->Per_Academic->TooltipValue = "";

        // Per_Administrative
        $this->Per_Administrative->LinkCustomAttributes = "";
        $this->Per_Administrative->HrefValue = "";
        $this->Per_Administrative->TooltipValue = "";

        // Per_WorDateStart
        $this->Per_WorDateStart->LinkCustomAttributes = "";
        $this->Per_WorDateStart->HrefValue = "";
        $this->Per_WorDateStart->TooltipValue = "";

        // Per_WorkDate
        $this->Per_WorkDate->LinkCustomAttributes = "";
        $this->Per_WorkDate->HrefValue = "";
        $this->Per_WorkDate->TooltipValue = "";

        // Per_WorkStatus
        $this->Per_WorkStatus->LinkCustomAttributes = "";
        $this->Per_WorkStatus->HrefValue = "";
        $this->Per_WorkStatus->TooltipValue = "";

        // Per_Born
        $this->Per_Born->LinkCustomAttributes = "";
        $this->Per_Born->HrefValue = "";
        $this->Per_Born->TooltipValue = "";

        // Per_Nationality
        $this->Per_Nationality->LinkCustomAttributes = "";
        $this->Per_Nationality->HrefValue = "";
        $this->Per_Nationality->TooltipValue = "";

        // Per_Religion
        $this->Per_Religion->LinkCustomAttributes = "";
        $this->Per_Religion->HrefValue = "";
        $this->Per_Religion->TooltipValue = "";

        // Per_IdCard
        $this->Per_IdCard->LinkCustomAttributes = "";
        $this->Per_IdCard->HrefValue = "";
        $this->Per_IdCard->TooltipValue = "";

        // Per_Phone
        $this->Per_Phone->LinkCustomAttributes = "";
        $this->Per_Phone->HrefValue = "";
        $this->Per_Phone->TooltipValue = "";

        // Per_UPEmail
        $this->Per_UPEmail->LinkCustomAttributes = "";
        $this->Per_UPEmail->HrefValue = "";
        $this->Per_UPEmail->TooltipValue = "";

        // Per_Email
        $this->Per_Email->LinkCustomAttributes = "";
        $this->Per_Email->HrefValue = "";
        $this->Per_Email->TooltipValue = "";

        // Per_Address
        $this->Per_Address->LinkCustomAttributes = "";
        $this->Per_Address->HrefValue = "";
        $this->Per_Address->TooltipValue = "";

        // Call Row Rendered event
        $this->rowRendered();

        // Save data for Custom Template
        $this->Rows[] = $this->customTemplateFieldValues();
    }

    // Render edit row values
    public function renderEditRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Per_Id
        $this->Per_Id->EditAttrs["class"] = "form-control";
        $this->Per_Id->EditCustomAttributes = "";
        $this->Per_Id->EditValue = $this->Per_Id->CurrentValue;
        $this->Per_Id->PlaceHolder = RemoveHtml($this->Per_Id->caption());

        // Per_ThaiPre
        $this->Per_ThaiPre->EditAttrs["class"] = "form-control";
        $this->Per_ThaiPre->EditCustomAttributes = "";
        if (!$this->Per_ThaiPre->Raw) {
            $this->Per_ThaiPre->CurrentValue = HtmlDecode($this->Per_ThaiPre->CurrentValue);
        }
        $this->Per_ThaiPre->EditValue = $this->Per_ThaiPre->CurrentValue;
        $this->Per_ThaiPre->PlaceHolder = RemoveHtml($this->Per_ThaiPre->caption());

        // Per_ThaiName
        $this->Per_ThaiName->EditAttrs["class"] = "form-control";
        $this->Per_ThaiName->EditCustomAttributes = "";
        if (!$this->Per_ThaiName->Raw) {
            $this->Per_ThaiName->CurrentValue = HtmlDecode($this->Per_ThaiName->CurrentValue);
        }
        $this->Per_ThaiName->EditValue = $this->Per_ThaiName->CurrentValue;
        $this->Per_ThaiName->PlaceHolder = RemoveHtml($this->Per_ThaiName->caption());

        // Per_ThaiLastName
        $this->Per_ThaiLastName->EditAttrs["class"] = "form-control";
        $this->Per_ThaiLastName->EditCustomAttributes = "";
        if (!$this->Per_ThaiLastName->Raw) {
            $this->Per_ThaiLastName->CurrentValue = HtmlDecode($this->Per_ThaiLastName->CurrentValue);
        }
        $this->Per_ThaiLastName->EditValue = $this->Per_ThaiLastName->CurrentValue;
        $this->Per_ThaiLastName->PlaceHolder = RemoveHtml($this->Per_ThaiLastName->caption());

        // Per_EngPre
        $this->Per_EngPre->EditAttrs["class"] = "form-control";
        $this->Per_EngPre->EditCustomAttributes = "";
        if (!$this->Per_EngPre->Raw) {
            $this->Per_EngPre->CurrentValue = HtmlDecode($this->Per_EngPre->CurrentValue);
        }
        $this->Per_EngPre->EditValue = $this->Per_EngPre->CurrentValue;
        $this->Per_EngPre->PlaceHolder = RemoveHtml($this->Per_EngPre->caption());

        // Per_EngName
        $this->Per_EngName->EditAttrs["class"] = "form-control";
        $this->Per_EngName->EditCustomAttributes = "";
        if (!$this->Per_EngName->Raw) {
            $this->Per_EngName->CurrentValue = HtmlDecode($this->Per_EngName->CurrentValue);
        }
        $this->Per_EngName->EditValue = $this->Per_EngName->CurrentValue;
        $this->Per_EngName->PlaceHolder = RemoveHtml($this->Per_EngName->caption());

        // Per_EngLastName
        $this->Per_EngLastName->EditAttrs["class"] = "form-control";
        $this->Per_EngLastName->EditCustomAttributes = "";
        if (!$this->Per_EngLastName->Raw) {
            $this->Per_EngLastName->CurrentValue = HtmlDecode($this->Per_EngLastName->CurrentValue);
        }
        $this->Per_EngLastName->EditValue = $this->Per_EngLastName->CurrentValue;
        $this->Per_EngLastName->PlaceHolder = RemoveHtml($this->Per_EngLastName->caption());

        // Per_Type
        $this->Per_Type->EditAttrs["class"] = "form-control";
        $this->Per_Type->EditCustomAttributes = "";
        if (!$this->Per_Type->Raw) {
            $this->Per_Type->CurrentValue = HtmlDecode($this->Per_Type->CurrentValue);
        }
        $this->Per_Type->EditValue = $this->Per_Type->CurrentValue;
        $this->Per_Type->PlaceHolder = RemoveHtml($this->Per_Type->caption());

        // Per_EmployeeType
        $this->Per_EmployeeType->EditAttrs["class"] = "form-control";
        $this->Per_EmployeeType->EditCustomAttributes = "";
        if (!$this->Per_EmployeeType->Raw) {
            $this->Per_EmployeeType->CurrentValue = HtmlDecode($this->Per_EmployeeType->CurrentValue);
        }
        $this->Per_EmployeeType->EditValue = $this->Per_EmployeeType->CurrentValue;
        $this->Per_EmployeeType->PlaceHolder = RemoveHtml($this->Per_EmployeeType->caption());

        // Per_Position
        $this->Per_Position->EditAttrs["class"] = "form-control";
        $this->Per_Position->EditCustomAttributes = "";
        if (!$this->Per_Position->Raw) {
            $this->Per_Position->CurrentValue = HtmlDecode($this->Per_Position->CurrentValue);
        }
        $this->Per_Position->EditValue = $this->Per_Position->CurrentValue;
        $this->Per_Position->PlaceHolder = RemoveHtml($this->Per_Position->caption());

        // Per_Academic
        $this->Per_Academic->EditAttrs["class"] = "form-control";
        $this->Per_Academic->EditCustomAttributes = "";
        if (!$this->Per_Academic->Raw) {
            $this->Per_Academic->CurrentValue = HtmlDecode($this->Per_Academic->CurrentValue);
        }
        $this->Per_Academic->EditValue = $this->Per_Academic->CurrentValue;
        $this->Per_Academic->PlaceHolder = RemoveHtml($this->Per_Academic->caption());

        // Per_Administrative
        $this->Per_Administrative->EditAttrs["class"] = "form-control";
        $this->Per_Administrative->EditCustomAttributes = "";
        if (!$this->Per_Administrative->Raw) {
            $this->Per_Administrative->CurrentValue = HtmlDecode($this->Per_Administrative->CurrentValue);
        }
        $this->Per_Administrative->EditValue = $this->Per_Administrative->CurrentValue;
        $this->Per_Administrative->PlaceHolder = RemoveHtml($this->Per_Administrative->caption());

        // Per_WorDateStart
        $this->Per_WorDateStart->EditAttrs["class"] = "form-control";
        $this->Per_WorDateStart->EditCustomAttributes = "";
        $this->Per_WorDateStart->EditValue = FormatDateTime($this->Per_WorDateStart->CurrentValue, 8);
        $this->Per_WorDateStart->PlaceHolder = RemoveHtml($this->Per_WorDateStart->caption());

        // Per_WorkDate
        $this->Per_WorkDate->EditAttrs["class"] = "form-control";
        $this->Per_WorkDate->EditCustomAttributes = "";
        $this->Per_WorkDate->EditValue = FormatDateTime($this->Per_WorkDate->CurrentValue, 8);
        $this->Per_WorkDate->PlaceHolder = RemoveHtml($this->Per_WorkDate->caption());

        // Per_WorkStatus
        $this->Per_WorkStatus->EditAttrs["class"] = "form-control";
        $this->Per_WorkStatus->EditCustomAttributes = "";
        if (!$this->Per_WorkStatus->Raw) {
            $this->Per_WorkStatus->CurrentValue = HtmlDecode($this->Per_WorkStatus->CurrentValue);
        }
        $this->Per_WorkStatus->EditValue = $this->Per_WorkStatus->CurrentValue;
        $this->Per_WorkStatus->PlaceHolder = RemoveHtml($this->Per_WorkStatus->caption());

        // Per_Born
        $this->Per_Born->EditAttrs["class"] = "form-control";
        $this->Per_Born->EditCustomAttributes = "";
        $this->Per_Born->EditValue = FormatDateTime($this->Per_Born->CurrentValue, 8);
        $this->Per_Born->PlaceHolder = RemoveHtml($this->Per_Born->caption());

        // Per_Nationality
        $this->Per_Nationality->EditAttrs["class"] = "form-control";
        $this->Per_Nationality->EditCustomAttributes = "";
        if (!$this->Per_Nationality->Raw) {
            $this->Per_Nationality->CurrentValue = HtmlDecode($this->Per_Nationality->CurrentValue);
        }
        $this->Per_Nationality->EditValue = $this->Per_Nationality->CurrentValue;
        $this->Per_Nationality->PlaceHolder = RemoveHtml($this->Per_Nationality->caption());

        // Per_Religion
        $this->Per_Religion->EditAttrs["class"] = "form-control";
        $this->Per_Religion->EditCustomAttributes = "";
        if (!$this->Per_Religion->Raw) {
            $this->Per_Religion->CurrentValue = HtmlDecode($this->Per_Religion->CurrentValue);
        }
        $this->Per_Religion->EditValue = $this->Per_Religion->CurrentValue;
        $this->Per_Religion->PlaceHolder = RemoveHtml($this->Per_Religion->caption());

        // Per_IdCard
        $this->Per_IdCard->EditAttrs["class"] = "form-control";
        $this->Per_IdCard->EditCustomAttributes = "";
        if (!$this->Per_IdCard->Raw) {
            $this->Per_IdCard->CurrentValue = HtmlDecode($this->Per_IdCard->CurrentValue);
        }
        $this->Per_IdCard->EditValue = $this->Per_IdCard->CurrentValue;
        $this->Per_IdCard->PlaceHolder = RemoveHtml($this->Per_IdCard->caption());

        // Per_Phone
        $this->Per_Phone->EditAttrs["class"] = "form-control";
        $this->Per_Phone->EditCustomAttributes = "";
        if (!$this->Per_Phone->Raw) {
            $this->Per_Phone->CurrentValue = HtmlDecode($this->Per_Phone->CurrentValue);
        }
        $this->Per_Phone->EditValue = $this->Per_Phone->CurrentValue;
        $this->Per_Phone->PlaceHolder = RemoveHtml($this->Per_Phone->caption());

        // Per_UPEmail
        $this->Per_UPEmail->EditAttrs["class"] = "form-control";
        $this->Per_UPEmail->EditCustomAttributes = "";
        if (!$this->Per_UPEmail->Raw) {
            $this->Per_UPEmail->CurrentValue = HtmlDecode($this->Per_UPEmail->CurrentValue);
        }
        $this->Per_UPEmail->EditValue = $this->Per_UPEmail->CurrentValue;
        $this->Per_UPEmail->PlaceHolder = RemoveHtml($this->Per_UPEmail->caption());

        // Per_Email
        $this->Per_Email->EditAttrs["class"] = "form-control";
        $this->Per_Email->EditCustomAttributes = "";
        if (!$this->Per_Email->Raw) {
            $this->Per_Email->CurrentValue = HtmlDecode($this->Per_Email->CurrentValue);
        }
        $this->Per_Email->EditValue = $this->Per_Email->CurrentValue;
        $this->Per_Email->PlaceHolder = RemoveHtml($this->Per_Email->caption());

        // Per_Address
        $this->Per_Address->EditAttrs["class"] = "form-control";
        $this->Per_Address->EditCustomAttributes = "";
        if (!$this->Per_Address->Raw) {
            $this->Per_Address->CurrentValue = HtmlDecode($this->Per_Address->CurrentValue);
        }
        $this->Per_Address->EditValue = $this->Per_Address->CurrentValue;
        $this->Per_Address->PlaceHolder = RemoveHtml($this->Per_Address->caption());

        // Call Row Rendered event
        $this->rowRendered();
    }

    // Aggregate list row values
    public function aggregateListRowValues()
    {
    }

    // Aggregate list row (for rendering)
    public function aggregateListRow()
    {
        // Call Row Rendered event
        $this->rowRendered();
    }

    // Export data in HTML/CSV/Word/Excel/Email/PDF format
    public function exportDocument($doc, $recordset, $startRec = 1, $stopRec = 1, $exportPageType = "")
    {
        if (!$recordset || !$doc) {
            return;
        }
        if (!$doc->ExportCustom) {
            // Write header
            $doc->exportTableHeader();
            if ($doc->Horizontal) { // Horizontal format, write header
                $doc->beginExportRow();
                if ($exportPageType == "view") {
                    $doc->exportCaption($this->Per_Id);
                    $doc->exportCaption($this->Per_ThaiPre);
                    $doc->exportCaption($this->Per_ThaiName);
                    $doc->exportCaption($this->Per_ThaiLastName);
                    $doc->exportCaption($this->Per_EngPre);
                    $doc->exportCaption($this->Per_EngName);
                    $doc->exportCaption($this->Per_EngLastName);
                    $doc->exportCaption($this->Per_Type);
                    $doc->exportCaption($this->Per_EmployeeType);
                    $doc->exportCaption($this->Per_Position);
                    $doc->exportCaption($this->Per_Academic);
                    $doc->exportCaption($this->Per_Administrative);
                    $doc->exportCaption($this->Per_WorDateStart);
                    $doc->exportCaption($this->Per_WorkDate);
                    $doc->exportCaption($this->Per_WorkStatus);
                    $doc->exportCaption($this->Per_Born);
                    $doc->exportCaption($this->Per_Nationality);
                    $doc->exportCaption($this->Per_Religion);
                    $doc->exportCaption($this->Per_IdCard);
                    $doc->exportCaption($this->Per_Phone);
                    $doc->exportCaption($this->Per_UPEmail);
                    $doc->exportCaption($this->Per_Email);
                    $doc->exportCaption($this->Per_Address);
                } else {
                    $doc->exportCaption($this->Per_Id);
                    $doc->exportCaption($this->Per_ThaiPre);
                    $doc->exportCaption($this->Per_ThaiName);
                    $doc->exportCaption($this->Per_ThaiLastName);
                    $doc->exportCaption($this->Per_EngPre);
                    $doc->exportCaption($this->Per_EngName);
                    $doc->exportCaption($this->Per_EngLastName);
                    $doc->exportCaption($this->Per_Type);
                    $doc->exportCaption($this->Per_EmployeeType);
                    $doc->exportCaption($this->Per_Position);
                    $doc->exportCaption($this->Per_Academic);
                    $doc->exportCaption($this->Per_Administrative);
                    $doc->exportCaption($this->Per_WorDateStart);
                    $doc->exportCaption($this->Per_WorkDate);
                    $doc->exportCaption($this->Per_WorkStatus);
                    $doc->exportCaption($this->Per_Born);
                    $doc->exportCaption($this->Per_Nationality);
                    $doc->exportCaption($this->Per_Religion);
                    $doc->exportCaption($this->Per_IdCard);
                    $doc->exportCaption($this->Per_Phone);
                    $doc->exportCaption($this->Per_UPEmail);
                    $doc->exportCaption($this->Per_Email);
                    $doc->exportCaption($this->Per_Address);
                }
                $doc->endExportRow();
            }
        }

        // Move to first record
        $recCnt = $startRec - 1;
        $stopRec = ($stopRec > 0) ? $stopRec : PHP_INT_MAX;
        while (!$recordset->EOF && $recCnt < $stopRec) {
            $row = $recordset->fields;
            $recCnt++;
            if ($recCnt >= $startRec) {
                $rowCnt = $recCnt - $startRec + 1;

                // Page break
                if ($this->ExportPageBreakCount > 0) {
                    if ($rowCnt > 1 && ($rowCnt - 1) % $this->ExportPageBreakCount == 0) {
                        $doc->exportPageBreak();
                    }
                }
                $this->loadListRowValues($row);

                // Render row
                $this->RowType = ROWTYPE_VIEW; // Render view
                $this->resetAttributes();
                $this->renderListRow();
                if (!$doc->ExportCustom) {
                    $doc->beginExportRow($rowCnt); // Allow CSS styles if enabled
                    if ($exportPageType == "view") {
                        $doc->exportField($this->Per_Id);
                        $doc->exportField($this->Per_ThaiPre);
                        $doc->exportField($this->Per_ThaiName);
                        $doc->exportField($this->Per_ThaiLastName);
                        $doc->exportField($this->Per_EngPre);
                        $doc->exportField($this->Per_EngName);
                        $doc->exportField($this->Per_EngLastName);
                        $doc->exportField($this->Per_Type);
                        $doc->exportField($this->Per_EmployeeType);
                        $doc->exportField($this->Per_Position);
                        $doc->exportField($this->Per_Academic);
                        $doc->exportField($this->Per_Administrative);
                        $doc->exportField($this->Per_WorDateStart);
                        $doc->exportField($this->Per_WorkDate);
                        $doc->exportField($this->Per_WorkStatus);
                        $doc->exportField($this->Per_Born);
                        $doc->exportField($this->Per_Nationality);
                        $doc->exportField($this->Per_Religion);
                        $doc->exportField($this->Per_IdCard);
                        $doc->exportField($this->Per_Phone);
                        $doc->exportField($this->Per_UPEmail);
                        $doc->exportField($this->Per_Email);
                        $doc->exportField($this->Per_Address);
                    } else {
                        $doc->exportField($this->Per_Id);
                        $doc->exportField($this->Per_ThaiPre);
                        $doc->exportField($this->Per_ThaiName);
                        $doc->exportField($this->Per_ThaiLastName);
                        $doc->exportField($this->Per_EngPre);
                        $doc->exportField($this->Per_EngName);
                        $doc->exportField($this->Per_EngLastName);
                        $doc->exportField($this->Per_Type);
                        $doc->exportField($this->Per_EmployeeType);
                        $doc->exportField($this->Per_Position);
                        $doc->exportField($this->Per_Academic);
                        $doc->exportField($this->Per_Administrative);
                        $doc->exportField($this->Per_WorDateStart);
                        $doc->exportField($this->Per_WorkDate);
                        $doc->exportField($this->Per_WorkStatus);
                        $doc->exportField($this->Per_Born);
                        $doc->exportField($this->Per_Nationality);
                        $doc->exportField($this->Per_Religion);
                        $doc->exportField($this->Per_IdCard);
                        $doc->exportField($this->Per_Phone);
                        $doc->exportField($this->Per_UPEmail);
                        $doc->exportField($this->Per_Email);
                        $doc->exportField($this->Per_Address);
                    }
                    $doc->endExportRow($rowCnt);
                }
            }

            // Call Row Export server event
            if ($doc->ExportCustom) {
                $this->rowExport($row);
            }
            $recordset->moveNext();
        }
        if (!$doc->ExportCustom) {
            $doc->exportTableFooter();
        }
    }

    // Get file data
    public function getFileData($fldparm, $key, $resize, $width = 0, $height = 0, $plugins = [])
    {
        // No binary fields
        return false;
    }

    // Table level events

    // Recordset Selecting event
    public function recordsetSelecting(&$filter)
    {
        // Enter your code here
    }

    // Recordset Selected event
    public function recordsetSelected(&$rs)
    {
        //Log("Recordset Selected");
    }

    // Recordset Search Validated event
    public function recordsetSearchValidated()
    {
        // Example:
        //$this->MyField1->AdvancedSearch->SearchValue = "your search criteria"; // Search value
    }

    // Recordset Searching event
    public function recordsetSearching(&$filter)
    {
        // Enter your code here
    }

    // Row_Selecting event
    public function rowSelecting(&$filter)
    {
        // Enter your code here
    }

    // Row Selected event
    public function rowSelected(&$rs)
    {
        //Log("Row Selected");
    }

    // Row Inserting event
    public function rowInserting($rsold, &$rsnew)
    {
        // Enter your code here
        // To cancel, set return value to false
        return true;
    }

    // Row Inserted event
    public function rowInserted($rsold, &$rsnew)
    {
        //Log("Row Inserted");
    }

    // Row Updating event
    public function rowUpdating($rsold, &$rsnew)
    {
        // Enter your code here
        // To cancel, set return value to false
        return true;
    }

    // Row Updated event
    public function rowUpdated($rsold, &$rsnew)
    {
        //Log("Row Updated");
    }

    // Row Update Conflict event
    public function rowUpdateConflict($rsold, &$rsnew)
    {
        // Enter your code here
        // To ignore conflict, set return value to false
        return true;
    }

    // Grid Inserting event
    public function gridInserting()
    {
        // Enter your code here
        // To reject grid insert, set return value to false
        return true;
    }

    // Grid Inserted event
    public function gridInserted($rsnew)
    {
        //Log("Grid Inserted");
    }

    // Grid Updating event
    public function gridUpdating($rsold)
    {
        // Enter your code here
        // To reject grid update, set return value to false
        return true;
    }

    // Grid Updated event
    public function gridUpdated($rsold, $rsnew)
    {
        //Log("Grid Updated");
    }

    // Row Deleting event
    public function rowDeleting(&$rs)
    {
        // Enter your code here
        // To cancel, set return value to False
        return true;
    }

    // Row Deleted event
    public function rowDeleted(&$rs)
    {
        //Log("Row Deleted");
    }

    // Email Sending event
    public function emailSending($email, &$args)
    {
        //var_dump($email); var_dump($args); exit();
        return true;
    }

    // Lookup Selecting event
    public function lookupSelecting($fld, &$filter)
    {
        //var_dump($fld->Name, $fld->Lookup, $filter); // Uncomment to view the filter
        // Enter your code here
    }

    // Row Rendering event
    public function rowRendering()
    {
        // Enter your code here
    }

    // Row Rendered event
    public function rowRendered()
    {
        // To view properties of field class, use:
        //var_dump($this-><FieldName>);
    }

    // User ID Filtering event
    public function userIdFiltering(&$filter)
    {
        // Enter your code here
    }
}
