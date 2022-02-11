<?php

namespace PHPMaker2021\upPersonnelv2;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for studyleave
 */
class Studyleave extends DbTable
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
    public $Study_Id;
    public $Per_Id;
    public $Study_Start;
    public $Study_End;
    public $StudyLeaveType_Id;
    public $Study_NumAddTime;
    public $Study_AddTimeStart;
    public $Study_AddTimeEnd;
    public $Study_WorkDate;
    public $Study_GraduationDate;
    public $Study_AdjustDate;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'studyleave';
        $this->TableName = 'studyleave';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "`studyleave`";
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

        // Study_Id
        $this->Study_Id = new DbField('studyleave', 'studyleave', 'x_Study_Id', 'Study_Id', '`Study_Id`', '`Study_Id`', 3, 5, -1, false, '`Study_Id`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Study_Id->Nullable = false; // NOT NULL field
        $this->Study_Id->Required = true; // Required field
        $this->Study_Id->Sortable = true; // Allow sort
        $this->Study_Id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['Study_Id'] = &$this->Study_Id;

        // Per_Id
        $this->Per_Id = new DbField('studyleave', 'studyleave', 'x_Per_Id', 'Per_Id', '`Per_Id`', '`Per_Id`', 3, 10, -1, false, '`Per_Id`', false, false, false, 'FORMATTED TEXT', 'SELECT');
        $this->Per_Id->Nullable = false; // NOT NULL field
        $this->Per_Id->Required = true; // Required field
        $this->Per_Id->Sortable = true; // Allow sort
        $this->Per_Id->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->Per_Id->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        $this->Per_Id->Lookup = new Lookup('Per_Id', '_01personnel', false, 'Per_Id', ["Per_Id","Per_ThaiName","Per_ThaiLastName",""], [], [], [], [], [], [], '', '');
        $this->Per_Id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['Per_Id'] = &$this->Per_Id;

        // Study_Start
        $this->Study_Start = new DbField('studyleave', 'studyleave', 'x_Study_Start', 'Study_Start', '`Study_Start`', CastDateFieldForLike("`Study_Start`", 0, "DB"), 133, 10, 0, false, '`Study_Start`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Study_Start->Nullable = false; // NOT NULL field
        $this->Study_Start->Required = true; // Required field
        $this->Study_Start->Sortable = true; // Allow sort
        $this->Study_Start->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->Fields['Study_Start'] = &$this->Study_Start;

        // Study_End
        $this->Study_End = new DbField('studyleave', 'studyleave', 'x_Study_End', 'Study_End', '`Study_End`', CastDateFieldForLike("`Study_End`", 0, "DB"), 133, 10, 0, false, '`Study_End`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Study_End->Nullable = false; // NOT NULL field
        $this->Study_End->Required = true; // Required field
        $this->Study_End->Sortable = true; // Allow sort
        $this->Study_End->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->Fields['Study_End'] = &$this->Study_End;

        // StudyLeaveType_Id
        $this->StudyLeaveType_Id = new DbField('studyleave', 'studyleave', 'x_StudyLeaveType_Id', 'StudyLeaveType_Id', '`StudyLeaveType_Id`', '`StudyLeaveType_Id`', 3, 2, -1, false, '`StudyLeaveType_Id`', false, false, false, 'FORMATTED TEXT', 'SELECT');
        $this->StudyLeaveType_Id->Nullable = false; // NOT NULL field
        $this->StudyLeaveType_Id->Required = true; // Required field
        $this->StudyLeaveType_Id->Sortable = true; // Allow sort
        $this->StudyLeaveType_Id->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->StudyLeaveType_Id->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        $this->StudyLeaveType_Id->Lookup = new Lookup('StudyLeaveType_Id', 'studyleavetype', false, 'StudyLeaveType_Id', ["StudyLeaveType_Name","","",""], [], [], [], [], [], [], '', '');
        $this->StudyLeaveType_Id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['StudyLeaveType_Id'] = &$this->StudyLeaveType_Id;

        // Study_NumAddTime
        $this->Study_NumAddTime = new DbField('studyleave', 'studyleave', 'x_Study_NumAddTime', 'Study_NumAddTime', '`Study_NumAddTime`', CastDateFieldForLike("`Study_NumAddTime`", 0, "DB"), 133, 10, 0, false, '`Study_NumAddTime`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Study_NumAddTime->Nullable = false; // NOT NULL field
        $this->Study_NumAddTime->Required = true; // Required field
        $this->Study_NumAddTime->Sortable = true; // Allow sort
        $this->Study_NumAddTime->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->Fields['Study_NumAddTime'] = &$this->Study_NumAddTime;

        // Study_AddTimeStart
        $this->Study_AddTimeStart = new DbField('studyleave', 'studyleave', 'x_Study_AddTimeStart', 'Study_AddTimeStart', '`Study_AddTimeStart`', CastDateFieldForLike("`Study_AddTimeStart`", 0, "DB"), 133, 10, 0, false, '`Study_AddTimeStart`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Study_AddTimeStart->Nullable = false; // NOT NULL field
        $this->Study_AddTimeStart->Required = true; // Required field
        $this->Study_AddTimeStart->Sortable = true; // Allow sort
        $this->Study_AddTimeStart->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->Fields['Study_AddTimeStart'] = &$this->Study_AddTimeStart;

        // Study_AddTimeEnd
        $this->Study_AddTimeEnd = new DbField('studyleave', 'studyleave', 'x_Study_AddTimeEnd', 'Study_AddTimeEnd', '`Study_AddTimeEnd`', CastDateFieldForLike("`Study_AddTimeEnd`", 0, "DB"), 133, 10, 0, false, '`Study_AddTimeEnd`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Study_AddTimeEnd->Nullable = false; // NOT NULL field
        $this->Study_AddTimeEnd->Required = true; // Required field
        $this->Study_AddTimeEnd->Sortable = true; // Allow sort
        $this->Study_AddTimeEnd->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->Fields['Study_AddTimeEnd'] = &$this->Study_AddTimeEnd;

        // Study_WorkDate
        $this->Study_WorkDate = new DbField('studyleave', 'studyleave', 'x_Study_WorkDate', 'Study_WorkDate', '`Study_WorkDate`', CastDateFieldForLike("`Study_WorkDate`", 0, "DB"), 133, 10, 0, false, '`Study_WorkDate`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Study_WorkDate->Nullable = false; // NOT NULL field
        $this->Study_WorkDate->Required = true; // Required field
        $this->Study_WorkDate->Sortable = true; // Allow sort
        $this->Study_WorkDate->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->Fields['Study_WorkDate'] = &$this->Study_WorkDate;

        // Study_GraduationDate
        $this->Study_GraduationDate = new DbField('studyleave', 'studyleave', 'x_Study_GraduationDate', 'Study_GraduationDate', '`Study_GraduationDate`', CastDateFieldForLike("`Study_GraduationDate`", 0, "DB"), 133, 10, 0, false, '`Study_GraduationDate`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Study_GraduationDate->Nullable = false; // NOT NULL field
        $this->Study_GraduationDate->Required = true; // Required field
        $this->Study_GraduationDate->Sortable = true; // Allow sort
        $this->Study_GraduationDate->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->Fields['Study_GraduationDate'] = &$this->Study_GraduationDate;

        // Study_AdjustDate
        $this->Study_AdjustDate = new DbField('studyleave', 'studyleave', 'x_Study_AdjustDate', 'Study_AdjustDate', '`Study_AdjustDate`', CastDateFieldForLike("`Study_AdjustDate`", 0, "DB"), 133, 10, 0, false, '`Study_AdjustDate`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Study_AdjustDate->Nullable = false; // NOT NULL field
        $this->Study_AdjustDate->Required = true; // Required field
        $this->Study_AdjustDate->Sortable = true; // Allow sort
        $this->Study_AdjustDate->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->Fields['Study_AdjustDate'] = &$this->Study_AdjustDate;
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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "`studyleave`";
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
        $this->Study_Id->DbValue = $row['Study_Id'];
        $this->Per_Id->DbValue = $row['Per_Id'];
        $this->Study_Start->DbValue = $row['Study_Start'];
        $this->Study_End->DbValue = $row['Study_End'];
        $this->StudyLeaveType_Id->DbValue = $row['StudyLeaveType_Id'];
        $this->Study_NumAddTime->DbValue = $row['Study_NumAddTime'];
        $this->Study_AddTimeStart->DbValue = $row['Study_AddTimeStart'];
        $this->Study_AddTimeEnd->DbValue = $row['Study_AddTimeEnd'];
        $this->Study_WorkDate->DbValue = $row['Study_WorkDate'];
        $this->Study_GraduationDate->DbValue = $row['Study_GraduationDate'];
        $this->Study_AdjustDate->DbValue = $row['Study_AdjustDate'];
    }

    // Delete uploaded files
    public function deleteUploadedFiles($row)
    {
        $this->loadDbValues($row);
    }

    // Record filter WHERE clause
    protected function sqlKeyFilter()
    {
        return "";
    }

    // Get Key
    public function getKey($current = false)
    {
        $keys = [];
        return implode(Config("COMPOSITE_KEY_SEPARATOR"), $keys);
    }

    // Set Key
    public function setKey($key, $current = false)
    {
        $this->OldKey = strval($key);
        $keys = explode(Config("COMPOSITE_KEY_SEPARATOR"), $this->OldKey);
        if (count($keys) == 0) {
        }
    }

    // Get record filter
    public function getRecordFilter($row = null)
    {
        $keyFilter = $this->sqlKeyFilter();
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
            return GetUrl("StudyleaveList");
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
        if ($pageName == "StudyleaveView") {
            return $Language->phrase("View");
        } elseif ($pageName == "StudyleaveEdit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "StudyleaveAdd") {
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
                return "StudyleaveView";
            case Config("API_ADD_ACTION"):
                return "StudyleaveAdd";
            case Config("API_EDIT_ACTION"):
                return "StudyleaveEdit";
            case Config("API_DELETE_ACTION"):
                return "StudyleaveDelete";
            case Config("API_LIST_ACTION"):
                return "StudyleaveList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "StudyleaveList";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("StudyleaveView", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("StudyleaveView", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "StudyleaveAdd?" . $this->getUrlParm($parm);
        } else {
            $url = "StudyleaveAdd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("StudyleaveEdit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("StudyleaveAdd", $this->getUrlParm($parm));
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
        return $this->keyUrl("StudyleaveDelete", $this->getUrlParm());
    }

    // Add master url
    public function addMasterUrl($url)
    {
        return $url;
    }

    public function keyToJson($htmlEncode = false)
    {
        $json = "";
        $json = "{" . $json . "}";
        if ($htmlEncode) {
            $json = HtmlEncode($json);
        }
        return $json;
    }

    // Add key value to URL
    public function keyUrl($url, $parm = "")
    {
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
            //return $arKeys; // Do not return yet, so the values will also be checked by the following code
        }
        // Check keys
        $ar = [];
        if (is_array($arKeys)) {
            foreach ($arKeys as $key) {
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
        $this->Study_Id->setDbValue($row['Study_Id']);
        $this->Per_Id->setDbValue($row['Per_Id']);
        $this->Study_Start->setDbValue($row['Study_Start']);
        $this->Study_End->setDbValue($row['Study_End']);
        $this->StudyLeaveType_Id->setDbValue($row['StudyLeaveType_Id']);
        $this->Study_NumAddTime->setDbValue($row['Study_NumAddTime']);
        $this->Study_AddTimeStart->setDbValue($row['Study_AddTimeStart']);
        $this->Study_AddTimeEnd->setDbValue($row['Study_AddTimeEnd']);
        $this->Study_WorkDate->setDbValue($row['Study_WorkDate']);
        $this->Study_GraduationDate->setDbValue($row['Study_GraduationDate']);
        $this->Study_AdjustDate->setDbValue($row['Study_AdjustDate']);
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // Study_Id

        // Per_Id

        // Study_Start

        // Study_End

        // StudyLeaveType_Id

        // Study_NumAddTime

        // Study_AddTimeStart

        // Study_AddTimeEnd

        // Study_WorkDate

        // Study_GraduationDate

        // Study_AdjustDate

        // Study_Id
        $this->Study_Id->ViewValue = $this->Study_Id->CurrentValue;
        $this->Study_Id->ViewValue = FormatNumber($this->Study_Id->ViewValue, 0, -2, -2, -2);
        $this->Study_Id->ViewCustomAttributes = "";

        // Per_Id
        $curVal = strval($this->Per_Id->CurrentValue);
        if ($curVal != "") {
            $this->Per_Id->ViewValue = $this->Per_Id->lookupCacheOption($curVal);
            if ($this->Per_Id->ViewValue === null) { // Lookup from database
                $filterWrk = "`Per_Id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                $sqlWrk = $this->Per_Id->Lookup->getSql(false, $filterWrk, '', $this, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->Per_Id->Lookup->renderViewRow($rswrk[0]);
                    $this->Per_Id->ViewValue = $this->Per_Id->displayValue($arwrk);
                } else {
                    $this->Per_Id->ViewValue = $this->Per_Id->CurrentValue;
                }
            }
        } else {
            $this->Per_Id->ViewValue = null;
        }
        $this->Per_Id->ViewCustomAttributes = "";

        // Study_Start
        $this->Study_Start->ViewValue = $this->Study_Start->CurrentValue;
        $this->Study_Start->ViewValue = FormatDateTime($this->Study_Start->ViewValue, 0);
        $this->Study_Start->ViewCustomAttributes = "";

        // Study_End
        $this->Study_End->ViewValue = $this->Study_End->CurrentValue;
        $this->Study_End->ViewValue = FormatDateTime($this->Study_End->ViewValue, 0);
        $this->Study_End->ViewCustomAttributes = "";

        // StudyLeaveType_Id
        $curVal = strval($this->StudyLeaveType_Id->CurrentValue);
        if ($curVal != "") {
            $this->StudyLeaveType_Id->ViewValue = $this->StudyLeaveType_Id->lookupCacheOption($curVal);
            if ($this->StudyLeaveType_Id->ViewValue === null) { // Lookup from database
                $filterWrk = "`StudyLeaveType_Id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                $sqlWrk = $this->StudyLeaveType_Id->Lookup->getSql(false, $filterWrk, '', $this, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->StudyLeaveType_Id->Lookup->renderViewRow($rswrk[0]);
                    $this->StudyLeaveType_Id->ViewValue = $this->StudyLeaveType_Id->displayValue($arwrk);
                } else {
                    $this->StudyLeaveType_Id->ViewValue = $this->StudyLeaveType_Id->CurrentValue;
                }
            }
        } else {
            $this->StudyLeaveType_Id->ViewValue = null;
        }
        $this->StudyLeaveType_Id->ViewCustomAttributes = "";

        // Study_NumAddTime
        $this->Study_NumAddTime->ViewValue = $this->Study_NumAddTime->CurrentValue;
        $this->Study_NumAddTime->ViewValue = FormatDateTime($this->Study_NumAddTime->ViewValue, 0);
        $this->Study_NumAddTime->ViewCustomAttributes = "";

        // Study_AddTimeStart
        $this->Study_AddTimeStart->ViewValue = $this->Study_AddTimeStart->CurrentValue;
        $this->Study_AddTimeStart->ViewValue = FormatDateTime($this->Study_AddTimeStart->ViewValue, 0);
        $this->Study_AddTimeStart->ViewCustomAttributes = "";

        // Study_AddTimeEnd
        $this->Study_AddTimeEnd->ViewValue = $this->Study_AddTimeEnd->CurrentValue;
        $this->Study_AddTimeEnd->ViewValue = FormatDateTime($this->Study_AddTimeEnd->ViewValue, 0);
        $this->Study_AddTimeEnd->ViewCustomAttributes = "";

        // Study_WorkDate
        $this->Study_WorkDate->ViewValue = $this->Study_WorkDate->CurrentValue;
        $this->Study_WorkDate->ViewValue = FormatDateTime($this->Study_WorkDate->ViewValue, 0);
        $this->Study_WorkDate->ViewCustomAttributes = "";

        // Study_GraduationDate
        $this->Study_GraduationDate->ViewValue = $this->Study_GraduationDate->CurrentValue;
        $this->Study_GraduationDate->ViewValue = FormatDateTime($this->Study_GraduationDate->ViewValue, 0);
        $this->Study_GraduationDate->ViewCustomAttributes = "";

        // Study_AdjustDate
        $this->Study_AdjustDate->ViewValue = $this->Study_AdjustDate->CurrentValue;
        $this->Study_AdjustDate->ViewValue = FormatDateTime($this->Study_AdjustDate->ViewValue, 0);
        $this->Study_AdjustDate->ViewCustomAttributes = "";

        // Study_Id
        $this->Study_Id->LinkCustomAttributes = "";
        $this->Study_Id->HrefValue = "";
        $this->Study_Id->TooltipValue = "";

        // Per_Id
        $this->Per_Id->LinkCustomAttributes = "";
        $this->Per_Id->HrefValue = "";
        $this->Per_Id->TooltipValue = "";

        // Study_Start
        $this->Study_Start->LinkCustomAttributes = "";
        $this->Study_Start->HrefValue = "";
        $this->Study_Start->TooltipValue = "";

        // Study_End
        $this->Study_End->LinkCustomAttributes = "";
        $this->Study_End->HrefValue = "";
        $this->Study_End->TooltipValue = "";

        // StudyLeaveType_Id
        $this->StudyLeaveType_Id->LinkCustomAttributes = "";
        $this->StudyLeaveType_Id->HrefValue = "";
        $this->StudyLeaveType_Id->TooltipValue = "";

        // Study_NumAddTime
        $this->Study_NumAddTime->LinkCustomAttributes = "";
        $this->Study_NumAddTime->HrefValue = "";
        $this->Study_NumAddTime->TooltipValue = "";

        // Study_AddTimeStart
        $this->Study_AddTimeStart->LinkCustomAttributes = "";
        $this->Study_AddTimeStart->HrefValue = "";
        $this->Study_AddTimeStart->TooltipValue = "";

        // Study_AddTimeEnd
        $this->Study_AddTimeEnd->LinkCustomAttributes = "";
        $this->Study_AddTimeEnd->HrefValue = "";
        $this->Study_AddTimeEnd->TooltipValue = "";

        // Study_WorkDate
        $this->Study_WorkDate->LinkCustomAttributes = "";
        $this->Study_WorkDate->HrefValue = "";
        $this->Study_WorkDate->TooltipValue = "";

        // Study_GraduationDate
        $this->Study_GraduationDate->LinkCustomAttributes = "";
        $this->Study_GraduationDate->HrefValue = "";
        $this->Study_GraduationDate->TooltipValue = "";

        // Study_AdjustDate
        $this->Study_AdjustDate->LinkCustomAttributes = "";
        $this->Study_AdjustDate->HrefValue = "";
        $this->Study_AdjustDate->TooltipValue = "";

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

        // Study_Id
        $this->Study_Id->EditAttrs["class"] = "form-control";
        $this->Study_Id->EditCustomAttributes = "";
        $this->Study_Id->EditValue = $this->Study_Id->CurrentValue;
        $this->Study_Id->PlaceHolder = RemoveHtml($this->Study_Id->caption());

        // Per_Id
        $this->Per_Id->EditAttrs["class"] = "form-control";
        $this->Per_Id->EditCustomAttributes = "";
        $this->Per_Id->PlaceHolder = RemoveHtml($this->Per_Id->caption());

        // Study_Start
        $this->Study_Start->EditAttrs["class"] = "form-control";
        $this->Study_Start->EditCustomAttributes = "";
        $this->Study_Start->EditValue = FormatDateTime($this->Study_Start->CurrentValue, 8);
        $this->Study_Start->PlaceHolder = RemoveHtml($this->Study_Start->caption());

        // Study_End
        $this->Study_End->EditAttrs["class"] = "form-control";
        $this->Study_End->EditCustomAttributes = "";
        $this->Study_End->EditValue = FormatDateTime($this->Study_End->CurrentValue, 8);
        $this->Study_End->PlaceHolder = RemoveHtml($this->Study_End->caption());

        // StudyLeaveType_Id
        $this->StudyLeaveType_Id->EditAttrs["class"] = "form-control";
        $this->StudyLeaveType_Id->EditCustomAttributes = "";
        $this->StudyLeaveType_Id->PlaceHolder = RemoveHtml($this->StudyLeaveType_Id->caption());

        // Study_NumAddTime
        $this->Study_NumAddTime->EditAttrs["class"] = "form-control";
        $this->Study_NumAddTime->EditCustomAttributes = "";
        $this->Study_NumAddTime->EditValue = FormatDateTime($this->Study_NumAddTime->CurrentValue, 8);
        $this->Study_NumAddTime->PlaceHolder = RemoveHtml($this->Study_NumAddTime->caption());

        // Study_AddTimeStart
        $this->Study_AddTimeStart->EditAttrs["class"] = "form-control";
        $this->Study_AddTimeStart->EditCustomAttributes = "";
        $this->Study_AddTimeStart->EditValue = FormatDateTime($this->Study_AddTimeStart->CurrentValue, 8);
        $this->Study_AddTimeStart->PlaceHolder = RemoveHtml($this->Study_AddTimeStart->caption());

        // Study_AddTimeEnd
        $this->Study_AddTimeEnd->EditAttrs["class"] = "form-control";
        $this->Study_AddTimeEnd->EditCustomAttributes = "";
        $this->Study_AddTimeEnd->EditValue = FormatDateTime($this->Study_AddTimeEnd->CurrentValue, 8);
        $this->Study_AddTimeEnd->PlaceHolder = RemoveHtml($this->Study_AddTimeEnd->caption());

        // Study_WorkDate
        $this->Study_WorkDate->EditAttrs["class"] = "form-control";
        $this->Study_WorkDate->EditCustomAttributes = "";
        $this->Study_WorkDate->EditValue = FormatDateTime($this->Study_WorkDate->CurrentValue, 8);
        $this->Study_WorkDate->PlaceHolder = RemoveHtml($this->Study_WorkDate->caption());

        // Study_GraduationDate
        $this->Study_GraduationDate->EditAttrs["class"] = "form-control";
        $this->Study_GraduationDate->EditCustomAttributes = "";
        $this->Study_GraduationDate->EditValue = FormatDateTime($this->Study_GraduationDate->CurrentValue, 8);
        $this->Study_GraduationDate->PlaceHolder = RemoveHtml($this->Study_GraduationDate->caption());

        // Study_AdjustDate
        $this->Study_AdjustDate->EditAttrs["class"] = "form-control";
        $this->Study_AdjustDate->EditCustomAttributes = "";
        $this->Study_AdjustDate->EditValue = FormatDateTime($this->Study_AdjustDate->CurrentValue, 8);
        $this->Study_AdjustDate->PlaceHolder = RemoveHtml($this->Study_AdjustDate->caption());

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
                    $doc->exportCaption($this->Study_Id);
                    $doc->exportCaption($this->Per_Id);
                    $doc->exportCaption($this->Study_Start);
                    $doc->exportCaption($this->Study_End);
                    $doc->exportCaption($this->StudyLeaveType_Id);
                    $doc->exportCaption($this->Study_NumAddTime);
                    $doc->exportCaption($this->Study_AddTimeStart);
                    $doc->exportCaption($this->Study_AddTimeEnd);
                    $doc->exportCaption($this->Study_WorkDate);
                    $doc->exportCaption($this->Study_GraduationDate);
                    $doc->exportCaption($this->Study_AdjustDate);
                } else {
                    $doc->exportCaption($this->Study_Id);
                    $doc->exportCaption($this->Per_Id);
                    $doc->exportCaption($this->Study_Start);
                    $doc->exportCaption($this->Study_End);
                    $doc->exportCaption($this->StudyLeaveType_Id);
                    $doc->exportCaption($this->Study_NumAddTime);
                    $doc->exportCaption($this->Study_AddTimeStart);
                    $doc->exportCaption($this->Study_AddTimeEnd);
                    $doc->exportCaption($this->Study_WorkDate);
                    $doc->exportCaption($this->Study_GraduationDate);
                    $doc->exportCaption($this->Study_AdjustDate);
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
                        $doc->exportField($this->Study_Id);
                        $doc->exportField($this->Per_Id);
                        $doc->exportField($this->Study_Start);
                        $doc->exportField($this->Study_End);
                        $doc->exportField($this->StudyLeaveType_Id);
                        $doc->exportField($this->Study_NumAddTime);
                        $doc->exportField($this->Study_AddTimeStart);
                        $doc->exportField($this->Study_AddTimeEnd);
                        $doc->exportField($this->Study_WorkDate);
                        $doc->exportField($this->Study_GraduationDate);
                        $doc->exportField($this->Study_AdjustDate);
                    } else {
                        $doc->exportField($this->Study_Id);
                        $doc->exportField($this->Per_Id);
                        $doc->exportField($this->Study_Start);
                        $doc->exportField($this->Study_End);
                        $doc->exportField($this->StudyLeaveType_Id);
                        $doc->exportField($this->Study_NumAddTime);
                        $doc->exportField($this->Study_AddTimeStart);
                        $doc->exportField($this->Study_AddTimeEnd);
                        $doc->exportField($this->Study_WorkDate);
                        $doc->exportField($this->Study_GraduationDate);
                        $doc->exportField($this->Study_AdjustDate);
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
