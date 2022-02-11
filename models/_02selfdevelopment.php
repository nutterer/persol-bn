<?php

namespace PHPMaker2021\upPersonnelv2;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for 02-selfdevelopment
 */
class _02selfdevelopment extends DbTable
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
    public $SelfDev_Id;
    public $Per_Id;
    public $SelfDev_Type;
    public $SelfDev_Name;
    public $SelfDev_StartDate;
    public $SelfDev_EndDate;
    public $SelfDev_Money;
    public $SelfDev_Address;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = '_02selfdevelopment';
        $this->TableName = '02-selfdevelopment';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "`02-selfdevelopment`";
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

        // SelfDev_Id
        $this->SelfDev_Id = new DbField('_02selfdevelopment', '02-selfdevelopment', 'x_SelfDev_Id', 'SelfDev_Id', '`SelfDev_Id`', '`SelfDev_Id`', 3, 5, -1, false, '`SelfDev_Id`', false, false, false, 'FORMATTED TEXT', 'NO');
        $this->SelfDev_Id->IsAutoIncrement = true; // Autoincrement field
        $this->SelfDev_Id->IsPrimaryKey = true; // Primary key field
        $this->SelfDev_Id->Sortable = true; // Allow sort
        $this->SelfDev_Id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['SelfDev_Id'] = &$this->SelfDev_Id;

        // Per_Id
        $this->Per_Id = new DbField('_02selfdevelopment', '02-selfdevelopment', 'x_Per_Id', 'Per_Id', '`Per_Id`', '`Per_Id`', 3, 4, -1, false, '`Per_Id`', false, false, false, 'FORMATTED TEXT', 'SELECT');
        $this->Per_Id->Nullable = false; // NOT NULL field
        $this->Per_Id->Required = true; // Required field
        $this->Per_Id->Sortable = true; // Allow sort
        $this->Per_Id->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->Per_Id->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        $this->Per_Id->Lookup = new Lookup('Per_Id', '_01personnel', false, 'Per_Id', ["Per_Id","Per_ThaiName","Per_ThaiLastName",""], [], [], [], [], [], [], '', '');
        $this->Per_Id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['Per_Id'] = &$this->Per_Id;

        // SelfDev_Type
        $this->SelfDev_Type = new DbField('_02selfdevelopment', '02-selfdevelopment', 'x_SelfDev_Type', 'SelfDev_Type', '`SelfDev_Type`', '`SelfDev_Type`', 3, 2, -1, false, '`SelfDev_Type`', false, false, false, 'FORMATTED TEXT', 'SELECT');
        $this->SelfDev_Type->Nullable = false; // NOT NULL field
        $this->SelfDev_Type->Required = true; // Required field
        $this->SelfDev_Type->Sortable = true; // Allow sort
        $this->SelfDev_Type->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->SelfDev_Type->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        $this->SelfDev_Type->Lookup = new Lookup('SelfDev_Type', 'selfdev_type', false, 'SelfDev_Type_id', ["SelfDev_Type_name","","",""], [], [], [], [], [], [], '', '');
        $this->SelfDev_Type->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['SelfDev_Type'] = &$this->SelfDev_Type;

        // SelfDev_Name
        $this->SelfDev_Name = new DbField('_02selfdevelopment', '02-selfdevelopment', 'x_SelfDev_Name', 'SelfDev_Name', '`SelfDev_Name`', '`SelfDev_Name`', 201, 256, -1, false, '`SelfDev_Name`', false, false, false, 'FORMATTED TEXT', 'TEXTAREA');
        $this->SelfDev_Name->Nullable = false; // NOT NULL field
        $this->SelfDev_Name->Required = true; // Required field
        $this->SelfDev_Name->Sortable = true; // Allow sort
        $this->Fields['SelfDev_Name'] = &$this->SelfDev_Name;

        // SelfDev_StartDate
        $this->SelfDev_StartDate = new DbField('_02selfdevelopment', '02-selfdevelopment', 'x_SelfDev_StartDate', 'SelfDev_StartDate', '`SelfDev_StartDate`', CastDateFieldForLike("`SelfDev_StartDate`", 0, "DB"), 133, 10, 0, false, '`SelfDev_StartDate`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->SelfDev_StartDate->Nullable = false; // NOT NULL field
        $this->SelfDev_StartDate->Required = true; // Required field
        $this->SelfDev_StartDate->Sortable = true; // Allow sort
        $this->SelfDev_StartDate->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->Fields['SelfDev_StartDate'] = &$this->SelfDev_StartDate;

        // SelfDev_EndDate
        $this->SelfDev_EndDate = new DbField('_02selfdevelopment', '02-selfdevelopment', 'x_SelfDev_EndDate', 'SelfDev_EndDate', '`SelfDev_EndDate`', CastDateFieldForLike("`SelfDev_EndDate`", 0, "DB"), 133, 10, 0, false, '`SelfDev_EndDate`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->SelfDev_EndDate->Nullable = false; // NOT NULL field
        $this->SelfDev_EndDate->Required = true; // Required field
        $this->SelfDev_EndDate->Sortable = true; // Allow sort
        $this->SelfDev_EndDate->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->Fields['SelfDev_EndDate'] = &$this->SelfDev_EndDate;

        // SelfDev_Money
        $this->SelfDev_Money = new DbField('_02selfdevelopment', '02-selfdevelopment', 'x_SelfDev_Money', 'SelfDev_Money', '`SelfDev_Money`', '`SelfDev_Money`', 4, 12, -1, false, '`SelfDev_Money`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->SelfDev_Money->Nullable = false; // NOT NULL field
        $this->SelfDev_Money->Required = true; // Required field
        $this->SelfDev_Money->Sortable = true; // Allow sort
        $this->SelfDev_Money->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->SelfDev_Money->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->Fields['SelfDev_Money'] = &$this->SelfDev_Money;

        // SelfDev_Address
        $this->SelfDev_Address = new DbField('_02selfdevelopment', '02-selfdevelopment', 'x_SelfDev_Address', 'SelfDev_Address', '`SelfDev_Address`', '`SelfDev_Address`', 201, 256, -1, false, '`SelfDev_Address`', false, false, false, 'FORMATTED TEXT', 'TEXTAREA');
        $this->SelfDev_Address->Nullable = false; // NOT NULL field
        $this->SelfDev_Address->Required = true; // Required field
        $this->SelfDev_Address->Sortable = true; // Allow sort
        $this->Fields['SelfDev_Address'] = &$this->SelfDev_Address;
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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "`02-selfdevelopment`";
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
            // Get insert id if necessary
            $this->SelfDev_Id->setDbValue($conn->lastInsertId());
            $rs['SelfDev_Id'] = $this->SelfDev_Id->DbValue;
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
            if (array_key_exists('SelfDev_Id', $rs)) {
                AddFilter($where, QuotedName('SelfDev_Id', $this->Dbid) . '=' . QuotedValue($rs['SelfDev_Id'], $this->SelfDev_Id->DataType, $this->Dbid));
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
        $this->SelfDev_Id->DbValue = $row['SelfDev_Id'];
        $this->Per_Id->DbValue = $row['Per_Id'];
        $this->SelfDev_Type->DbValue = $row['SelfDev_Type'];
        $this->SelfDev_Name->DbValue = $row['SelfDev_Name'];
        $this->SelfDev_StartDate->DbValue = $row['SelfDev_StartDate'];
        $this->SelfDev_EndDate->DbValue = $row['SelfDev_EndDate'];
        $this->SelfDev_Money->DbValue = $row['SelfDev_Money'];
        $this->SelfDev_Address->DbValue = $row['SelfDev_Address'];
    }

    // Delete uploaded files
    public function deleteUploadedFiles($row)
    {
        $this->loadDbValues($row);
    }

    // Record filter WHERE clause
    protected function sqlKeyFilter()
    {
        return "`SelfDev_Id` = @SelfDev_Id@";
    }

    // Get Key
    public function getKey($current = false)
    {
        $keys = [];
        $val = $current ? $this->SelfDev_Id->CurrentValue : $this->SelfDev_Id->OldValue;
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
                $this->SelfDev_Id->CurrentValue = $keys[0];
            } else {
                $this->SelfDev_Id->OldValue = $keys[0];
            }
        }
    }

    // Get record filter
    public function getRecordFilter($row = null)
    {
        $keyFilter = $this->sqlKeyFilter();
        if (is_array($row)) {
            $val = array_key_exists('SelfDev_Id', $row) ? $row['SelfDev_Id'] : null;
        } else {
            $val = $this->SelfDev_Id->OldValue !== null ? $this->SelfDev_Id->OldValue : $this->SelfDev_Id->CurrentValue;
        }
        if (!is_numeric($val)) {
            return "0=1"; // Invalid key
        }
        if ($val === null) {
            return "0=1"; // Invalid key
        } else {
            $keyFilter = str_replace("@SelfDev_Id@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
            return GetUrl("_02selfdevelopmentList");
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
        if ($pageName == "_02selfdevelopmentView") {
            return $Language->phrase("View");
        } elseif ($pageName == "_02selfdevelopmentEdit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "_02selfdevelopmentAdd") {
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
                return "_02selfdevelopmentView";
            case Config("API_ADD_ACTION"):
                return "_02selfdevelopmentAdd";
            case Config("API_EDIT_ACTION"):
                return "_02selfdevelopmentEdit";
            case Config("API_DELETE_ACTION"):
                return "_02selfdevelopmentDelete";
            case Config("API_LIST_ACTION"):
                return "_02selfdevelopmentList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "_02selfdevelopmentList";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("_02selfdevelopmentView", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("_02selfdevelopmentView", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "_02selfdevelopmentAdd?" . $this->getUrlParm($parm);
        } else {
            $url = "_02selfdevelopmentAdd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("_02selfdevelopmentEdit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("_02selfdevelopmentAdd", $this->getUrlParm($parm));
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
        return $this->keyUrl("_02selfdevelopmentDelete", $this->getUrlParm());
    }

    // Add master url
    public function addMasterUrl($url)
    {
        return $url;
    }

    public function keyToJson($htmlEncode = false)
    {
        $json = "";
        $json .= "SelfDev_Id:" . JsonEncode($this->SelfDev_Id->CurrentValue, "number");
        $json = "{" . $json . "}";
        if ($htmlEncode) {
            $json = HtmlEncode($json);
        }
        return $json;
    }

    // Add key value to URL
    public function keyUrl($url, $parm = "")
    {
        if ($this->SelfDev_Id->CurrentValue !== null) {
            $url .= "/" . rawurlencode($this->SelfDev_Id->CurrentValue);
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
            if (($keyValue = Param("SelfDev_Id") ?? Route("SelfDev_Id")) !== null) {
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
                $this->SelfDev_Id->CurrentValue = $key;
            } else {
                $this->SelfDev_Id->OldValue = $key;
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
        $this->SelfDev_Id->setDbValue($row['SelfDev_Id']);
        $this->Per_Id->setDbValue($row['Per_Id']);
        $this->SelfDev_Type->setDbValue($row['SelfDev_Type']);
        $this->SelfDev_Name->setDbValue($row['SelfDev_Name']);
        $this->SelfDev_StartDate->setDbValue($row['SelfDev_StartDate']);
        $this->SelfDev_EndDate->setDbValue($row['SelfDev_EndDate']);
        $this->SelfDev_Money->setDbValue($row['SelfDev_Money']);
        $this->SelfDev_Address->setDbValue($row['SelfDev_Address']);
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // SelfDev_Id

        // Per_Id

        // SelfDev_Type

        // SelfDev_Name

        // SelfDev_StartDate

        // SelfDev_EndDate

        // SelfDev_Money

        // SelfDev_Address

        // SelfDev_Id
        $this->SelfDev_Id->ViewValue = $this->SelfDev_Id->CurrentValue;
        $this->SelfDev_Id->ViewCustomAttributes = "";

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

        // SelfDev_Type
        $curVal = strval($this->SelfDev_Type->CurrentValue);
        if ($curVal != "") {
            $this->SelfDev_Type->ViewValue = $this->SelfDev_Type->lookupCacheOption($curVal);
            if ($this->SelfDev_Type->ViewValue === null) { // Lookup from database
                $filterWrk = "`SelfDev_Type_id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                $sqlWrk = $this->SelfDev_Type->Lookup->getSql(false, $filterWrk, '', $this, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->SelfDev_Type->Lookup->renderViewRow($rswrk[0]);
                    $this->SelfDev_Type->ViewValue = $this->SelfDev_Type->displayValue($arwrk);
                } else {
                    $this->SelfDev_Type->ViewValue = $this->SelfDev_Type->CurrentValue;
                }
            }
        } else {
            $this->SelfDev_Type->ViewValue = null;
        }
        $this->SelfDev_Type->ViewCustomAttributes = "";

        // SelfDev_Name
        $this->SelfDev_Name->ViewValue = $this->SelfDev_Name->CurrentValue;
        $this->SelfDev_Name->ViewCustomAttributes = "";

        // SelfDev_StartDate
        $this->SelfDev_StartDate->ViewValue = $this->SelfDev_StartDate->CurrentValue;
        $this->SelfDev_StartDate->ViewValue = FormatDateTime($this->SelfDev_StartDate->ViewValue, 0);
        $this->SelfDev_StartDate->ViewCustomAttributes = "";

        // SelfDev_EndDate
        $this->SelfDev_EndDate->ViewValue = $this->SelfDev_EndDate->CurrentValue;
        $this->SelfDev_EndDate->ViewValue = FormatDateTime($this->SelfDev_EndDate->ViewValue, 0);
        $this->SelfDev_EndDate->ViewCustomAttributes = "";

        // SelfDev_Money
        $this->SelfDev_Money->ViewValue = $this->SelfDev_Money->CurrentValue;
        $this->SelfDev_Money->ViewValue = FormatNumber($this->SelfDev_Money->ViewValue, 2, -2, -2, -2);
        $this->SelfDev_Money->ViewCustomAttributes = "";

        // SelfDev_Address
        $this->SelfDev_Address->ViewValue = $this->SelfDev_Address->CurrentValue;
        $this->SelfDev_Address->ViewCustomAttributes = "";

        // SelfDev_Id
        $this->SelfDev_Id->LinkCustomAttributes = "";
        $this->SelfDev_Id->HrefValue = "";
        $this->SelfDev_Id->TooltipValue = "";

        // Per_Id
        $this->Per_Id->LinkCustomAttributes = "";
        $this->Per_Id->HrefValue = "";
        $this->Per_Id->TooltipValue = "";

        // SelfDev_Type
        $this->SelfDev_Type->LinkCustomAttributes = "";
        $this->SelfDev_Type->HrefValue = "";
        $this->SelfDev_Type->TooltipValue = "";

        // SelfDev_Name
        $this->SelfDev_Name->LinkCustomAttributes = "";
        $this->SelfDev_Name->HrefValue = "";
        $this->SelfDev_Name->TooltipValue = "";

        // SelfDev_StartDate
        $this->SelfDev_StartDate->LinkCustomAttributes = "";
        $this->SelfDev_StartDate->HrefValue = "";
        $this->SelfDev_StartDate->TooltipValue = "";

        // SelfDev_EndDate
        $this->SelfDev_EndDate->LinkCustomAttributes = "";
        $this->SelfDev_EndDate->HrefValue = "";
        $this->SelfDev_EndDate->TooltipValue = "";

        // SelfDev_Money
        $this->SelfDev_Money->LinkCustomAttributes = "";
        $this->SelfDev_Money->HrefValue = "";
        $this->SelfDev_Money->TooltipValue = "";

        // SelfDev_Address
        $this->SelfDev_Address->LinkCustomAttributes = "";
        $this->SelfDev_Address->HrefValue = "";
        $this->SelfDev_Address->TooltipValue = "";

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

        // SelfDev_Id
        $this->SelfDev_Id->EditAttrs["class"] = "form-control";
        $this->SelfDev_Id->EditCustomAttributes = "";
        $this->SelfDev_Id->EditValue = $this->SelfDev_Id->CurrentValue;
        $this->SelfDev_Id->ViewCustomAttributes = "";

        // Per_Id
        $this->Per_Id->EditAttrs["class"] = "form-control";
        $this->Per_Id->EditCustomAttributes = "";
        $this->Per_Id->PlaceHolder = RemoveHtml($this->Per_Id->caption());

        // SelfDev_Type
        $this->SelfDev_Type->EditAttrs["class"] = "form-control";
        $this->SelfDev_Type->EditCustomAttributes = "";
        $this->SelfDev_Type->PlaceHolder = RemoveHtml($this->SelfDev_Type->caption());

        // SelfDev_Name
        $this->SelfDev_Name->EditAttrs["class"] = "form-control";
        $this->SelfDev_Name->EditCustomAttributes = "";
        $this->SelfDev_Name->EditValue = $this->SelfDev_Name->CurrentValue;
        $this->SelfDev_Name->PlaceHolder = RemoveHtml($this->SelfDev_Name->caption());

        // SelfDev_StartDate
        $this->SelfDev_StartDate->EditAttrs["class"] = "form-control";
        $this->SelfDev_StartDate->EditCustomAttributes = "";
        $this->SelfDev_StartDate->EditValue = FormatDateTime($this->SelfDev_StartDate->CurrentValue, 8);
        $this->SelfDev_StartDate->PlaceHolder = RemoveHtml($this->SelfDev_StartDate->caption());

        // SelfDev_EndDate
        $this->SelfDev_EndDate->EditAttrs["class"] = "form-control";
        $this->SelfDev_EndDate->EditCustomAttributes = "";
        $this->SelfDev_EndDate->EditValue = FormatDateTime($this->SelfDev_EndDate->CurrentValue, 8);
        $this->SelfDev_EndDate->PlaceHolder = RemoveHtml($this->SelfDev_EndDate->caption());

        // SelfDev_Money
        $this->SelfDev_Money->EditAttrs["class"] = "form-control";
        $this->SelfDev_Money->EditCustomAttributes = "";
        $this->SelfDev_Money->EditValue = $this->SelfDev_Money->CurrentValue;
        $this->SelfDev_Money->PlaceHolder = RemoveHtml($this->SelfDev_Money->caption());
        if (strval($this->SelfDev_Money->EditValue) != "" && is_numeric($this->SelfDev_Money->EditValue)) {
            $this->SelfDev_Money->EditValue = FormatNumber($this->SelfDev_Money->EditValue, -2, -2, -2, -2);
        }

        // SelfDev_Address
        $this->SelfDev_Address->EditAttrs["class"] = "form-control";
        $this->SelfDev_Address->EditCustomAttributes = "";
        $this->SelfDev_Address->EditValue = $this->SelfDev_Address->CurrentValue;
        $this->SelfDev_Address->PlaceHolder = RemoveHtml($this->SelfDev_Address->caption());

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
                    $doc->exportCaption($this->SelfDev_Id);
                    $doc->exportCaption($this->Per_Id);
                    $doc->exportCaption($this->SelfDev_Type);
                    $doc->exportCaption($this->SelfDev_Name);
                    $doc->exportCaption($this->SelfDev_StartDate);
                    $doc->exportCaption($this->SelfDev_EndDate);
                    $doc->exportCaption($this->SelfDev_Money);
                    $doc->exportCaption($this->SelfDev_Address);
                } else {
                    $doc->exportCaption($this->SelfDev_Id);
                    $doc->exportCaption($this->Per_Id);
                    $doc->exportCaption($this->SelfDev_Type);
                    $doc->exportCaption($this->SelfDev_StartDate);
                    $doc->exportCaption($this->SelfDev_EndDate);
                    $doc->exportCaption($this->SelfDev_Money);
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
                        $doc->exportField($this->SelfDev_Id);
                        $doc->exportField($this->Per_Id);
                        $doc->exportField($this->SelfDev_Type);
                        $doc->exportField($this->SelfDev_Name);
                        $doc->exportField($this->SelfDev_StartDate);
                        $doc->exportField($this->SelfDev_EndDate);
                        $doc->exportField($this->SelfDev_Money);
                        $doc->exportField($this->SelfDev_Address);
                    } else {
                        $doc->exportField($this->SelfDev_Id);
                        $doc->exportField($this->Per_Id);
                        $doc->exportField($this->SelfDev_Type);
                        $doc->exportField($this->SelfDev_StartDate);
                        $doc->exportField($this->SelfDev_EndDate);
                        $doc->exportField($this->SelfDev_Money);
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
