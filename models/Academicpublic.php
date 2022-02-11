<?php

namespace PHPMaker2021\upPersonnelv2;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for academicpublic
 */
class Academicpublic extends DbTable
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
    public $Public_Id;
    public $Aca_Id;
    public $Public_Type;
    public $Public_Journal;
    public $Public_Title;
    public $Public_Date;
    public $Public_Volum;
    public $Public_Link;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'academicpublic';
        $this->TableName = 'academicpublic';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "`academicpublic`";
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

        // Public_Id
        $this->Public_Id = new DbField('academicpublic', 'academicpublic', 'x_Public_Id', 'Public_Id', '`Public_Id`', '`Public_Id`', 3, 5, -1, false, '`Public_Id`', false, false, false, 'FORMATTED TEXT', 'NO');
        $this->Public_Id->IsAutoIncrement = true; // Autoincrement field
        $this->Public_Id->IsPrimaryKey = true; // Primary key field
        $this->Public_Id->Sortable = true; // Allow sort
        $this->Public_Id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['Public_Id'] = &$this->Public_Id;

        // Aca_Id
        $this->Aca_Id = new DbField('academicpublic', 'academicpublic', 'x_Aca_Id', 'Aca_Id', '`Aca_Id`', '`Aca_Id`', 3, 5, -1, false, '`Aca_Id`', false, false, false, 'FORMATTED TEXT', 'SELECT');
        $this->Aca_Id->Nullable = false; // NOT NULL field
        $this->Aca_Id->Required = true; // Required field
        $this->Aca_Id->Sortable = true; // Allow sort
        $this->Aca_Id->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->Aca_Id->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        $this->Aca_Id->Lookup = new Lookup('Aca_Id', '_03academicranks', false, 'Aca_Id', ["Aca_Name","","",""], [], [], [], [], [], [], '', '');
        $this->Aca_Id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['Aca_Id'] = &$this->Aca_Id;

        // Public_Type
        $this->Public_Type = new DbField('academicpublic', 'academicpublic', 'x_Public_Type', 'Public_Type', '`Public_Type`', '`Public_Type`', 3, 2, -1, false, '`Public_Type`', false, false, false, 'FORMATTED TEXT', 'SELECT');
        $this->Public_Type->Nullable = false; // NOT NULL field
        $this->Public_Type->Required = true; // Required field
        $this->Public_Type->Sortable = true; // Allow sort
        $this->Public_Type->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->Public_Type->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        $this->Public_Type->Lookup = new Lookup('Public_Type', 'public_type', false, 'Public_Type_id', ["Public_Type_name","","",""], [], [], [], [], [], [], '', '');
        $this->Public_Type->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['Public_Type'] = &$this->Public_Type;

        // Public_Journal
        $this->Public_Journal = new DbField('academicpublic', 'academicpublic', 'x_Public_Journal', 'Public_Journal', '`Public_Journal`', '`Public_Journal`', 200, 200, -1, false, '`Public_Journal`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Public_Journal->Nullable = false; // NOT NULL field
        $this->Public_Journal->Required = true; // Required field
        $this->Public_Journal->Sortable = true; // Allow sort
        $this->Fields['Public_Journal'] = &$this->Public_Journal;

        // Public_Title
        $this->Public_Title = new DbField('academicpublic', 'academicpublic', 'x_Public_Title', 'Public_Title', '`Public_Title`', '`Public_Title`', 200, 200, -1, false, '`Public_Title`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Public_Title->Nullable = false; // NOT NULL field
        $this->Public_Title->Required = true; // Required field
        $this->Public_Title->Sortable = true; // Allow sort
        $this->Fields['Public_Title'] = &$this->Public_Title;

        // Public_Date
        $this->Public_Date = new DbField('academicpublic', 'academicpublic', 'x_Public_Date', 'Public_Date', '`Public_Date`', CastDateFieldForLike("`Public_Date`", 0, "DB"), 133, 10, 0, false, '`Public_Date`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Public_Date->Nullable = false; // NOT NULL field
        $this->Public_Date->Required = true; // Required field
        $this->Public_Date->Sortable = true; // Allow sort
        $this->Public_Date->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->Fields['Public_Date'] = &$this->Public_Date;

        // Public_Volum
        $this->Public_Volum = new DbField('academicpublic', 'academicpublic', 'x_Public_Volum', 'Public_Volum', '`Public_Volum`', '`Public_Volum`', 3, 4, -1, false, '`Public_Volum`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Public_Volum->Nullable = false; // NOT NULL field
        $this->Public_Volum->Required = true; // Required field
        $this->Public_Volum->Sortable = true; // Allow sort
        $this->Public_Volum->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['Public_Volum'] = &$this->Public_Volum;

        // Public_Link
        $this->Public_Link = new DbField('academicpublic', 'academicpublic', 'x_Public_Link', 'Public_Link', '`Public_Link`', '`Public_Link`', 200, 100, -1, false, '`Public_Link`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Public_Link->Nullable = false; // NOT NULL field
        $this->Public_Link->Required = true; // Required field
        $this->Public_Link->Sortable = true; // Allow sort
        $this->Fields['Public_Link'] = &$this->Public_Link;
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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "`academicpublic`";
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
            $this->Public_Id->setDbValue($conn->lastInsertId());
            $rs['Public_Id'] = $this->Public_Id->DbValue;
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
            if (array_key_exists('Public_Id', $rs)) {
                AddFilter($where, QuotedName('Public_Id', $this->Dbid) . '=' . QuotedValue($rs['Public_Id'], $this->Public_Id->DataType, $this->Dbid));
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
        $this->Public_Id->DbValue = $row['Public_Id'];
        $this->Aca_Id->DbValue = $row['Aca_Id'];
        $this->Public_Type->DbValue = $row['Public_Type'];
        $this->Public_Journal->DbValue = $row['Public_Journal'];
        $this->Public_Title->DbValue = $row['Public_Title'];
        $this->Public_Date->DbValue = $row['Public_Date'];
        $this->Public_Volum->DbValue = $row['Public_Volum'];
        $this->Public_Link->DbValue = $row['Public_Link'];
    }

    // Delete uploaded files
    public function deleteUploadedFiles($row)
    {
        $this->loadDbValues($row);
    }

    // Record filter WHERE clause
    protected function sqlKeyFilter()
    {
        return "`Public_Id` = @Public_Id@";
    }

    // Get Key
    public function getKey($current = false)
    {
        $keys = [];
        $val = $current ? $this->Public_Id->CurrentValue : $this->Public_Id->OldValue;
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
                $this->Public_Id->CurrentValue = $keys[0];
            } else {
                $this->Public_Id->OldValue = $keys[0];
            }
        }
    }

    // Get record filter
    public function getRecordFilter($row = null)
    {
        $keyFilter = $this->sqlKeyFilter();
        if (is_array($row)) {
            $val = array_key_exists('Public_Id', $row) ? $row['Public_Id'] : null;
        } else {
            $val = $this->Public_Id->OldValue !== null ? $this->Public_Id->OldValue : $this->Public_Id->CurrentValue;
        }
        if (!is_numeric($val)) {
            return "0=1"; // Invalid key
        }
        if ($val === null) {
            return "0=1"; // Invalid key
        } else {
            $keyFilter = str_replace("@Public_Id@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
            return GetUrl("AcademicpublicList");
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
        if ($pageName == "AcademicpublicView") {
            return $Language->phrase("View");
        } elseif ($pageName == "AcademicpublicEdit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "AcademicpublicAdd") {
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
                return "AcademicpublicView";
            case Config("API_ADD_ACTION"):
                return "AcademicpublicAdd";
            case Config("API_EDIT_ACTION"):
                return "AcademicpublicEdit";
            case Config("API_DELETE_ACTION"):
                return "AcademicpublicDelete";
            case Config("API_LIST_ACTION"):
                return "AcademicpublicList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "AcademicpublicList";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("AcademicpublicView", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("AcademicpublicView", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "AcademicpublicAdd?" . $this->getUrlParm($parm);
        } else {
            $url = "AcademicpublicAdd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("AcademicpublicEdit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("AcademicpublicAdd", $this->getUrlParm($parm));
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
        return $this->keyUrl("AcademicpublicDelete", $this->getUrlParm());
    }

    // Add master url
    public function addMasterUrl($url)
    {
        return $url;
    }

    public function keyToJson($htmlEncode = false)
    {
        $json = "";
        $json .= "Public_Id:" . JsonEncode($this->Public_Id->CurrentValue, "number");
        $json = "{" . $json . "}";
        if ($htmlEncode) {
            $json = HtmlEncode($json);
        }
        return $json;
    }

    // Add key value to URL
    public function keyUrl($url, $parm = "")
    {
        if ($this->Public_Id->CurrentValue !== null) {
            $url .= "/" . rawurlencode($this->Public_Id->CurrentValue);
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
            if (($keyValue = Param("Public_Id") ?? Route("Public_Id")) !== null) {
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
                $this->Public_Id->CurrentValue = $key;
            } else {
                $this->Public_Id->OldValue = $key;
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
        $this->Public_Id->setDbValue($row['Public_Id']);
        $this->Aca_Id->setDbValue($row['Aca_Id']);
        $this->Public_Type->setDbValue($row['Public_Type']);
        $this->Public_Journal->setDbValue($row['Public_Journal']);
        $this->Public_Title->setDbValue($row['Public_Title']);
        $this->Public_Date->setDbValue($row['Public_Date']);
        $this->Public_Volum->setDbValue($row['Public_Volum']);
        $this->Public_Link->setDbValue($row['Public_Link']);
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // Public_Id

        // Aca_Id

        // Public_Type

        // Public_Journal

        // Public_Title

        // Public_Date

        // Public_Volum

        // Public_Link

        // Public_Id
        $this->Public_Id->ViewValue = $this->Public_Id->CurrentValue;
        $this->Public_Id->ViewCustomAttributes = "";

        // Aca_Id
        $curVal = strval($this->Aca_Id->CurrentValue);
        if ($curVal != "") {
            $this->Aca_Id->ViewValue = $this->Aca_Id->lookupCacheOption($curVal);
            if ($this->Aca_Id->ViewValue === null) { // Lookup from database
                $filterWrk = "`Aca_Id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                $sqlWrk = $this->Aca_Id->Lookup->getSql(false, $filterWrk, '', $this, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->Aca_Id->Lookup->renderViewRow($rswrk[0]);
                    $this->Aca_Id->ViewValue = $this->Aca_Id->displayValue($arwrk);
                } else {
                    $this->Aca_Id->ViewValue = $this->Aca_Id->CurrentValue;
                }
            }
        } else {
            $this->Aca_Id->ViewValue = null;
        }
        $this->Aca_Id->ViewCustomAttributes = "";

        // Public_Type
        $curVal = strval($this->Public_Type->CurrentValue);
        if ($curVal != "") {
            $this->Public_Type->ViewValue = $this->Public_Type->lookupCacheOption($curVal);
            if ($this->Public_Type->ViewValue === null) { // Lookup from database
                $filterWrk = "`Public_Type_id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                $sqlWrk = $this->Public_Type->Lookup->getSql(false, $filterWrk, '', $this, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->Public_Type->Lookup->renderViewRow($rswrk[0]);
                    $this->Public_Type->ViewValue = $this->Public_Type->displayValue($arwrk);
                } else {
                    $this->Public_Type->ViewValue = $this->Public_Type->CurrentValue;
                }
            }
        } else {
            $this->Public_Type->ViewValue = null;
        }
        $this->Public_Type->ViewCustomAttributes = "";

        // Public_Journal
        $this->Public_Journal->ViewValue = $this->Public_Journal->CurrentValue;
        $this->Public_Journal->ViewCustomAttributes = "";

        // Public_Title
        $this->Public_Title->ViewValue = $this->Public_Title->CurrentValue;
        $this->Public_Title->ViewCustomAttributes = "";

        // Public_Date
        $this->Public_Date->ViewValue = $this->Public_Date->CurrentValue;
        $this->Public_Date->ViewValue = FormatDateTime($this->Public_Date->ViewValue, 0);
        $this->Public_Date->ViewCustomAttributes = "";

        // Public_Volum
        $this->Public_Volum->ViewValue = $this->Public_Volum->CurrentValue;
        $this->Public_Volum->ViewValue = FormatNumber($this->Public_Volum->ViewValue, 0, -2, -2, -2);
        $this->Public_Volum->ViewCustomAttributes = "";

        // Public_Link
        $this->Public_Link->ViewValue = $this->Public_Link->CurrentValue;
        $this->Public_Link->ViewCustomAttributes = "";

        // Public_Id
        $this->Public_Id->LinkCustomAttributes = "";
        $this->Public_Id->HrefValue = "";
        $this->Public_Id->TooltipValue = "";

        // Aca_Id
        $this->Aca_Id->LinkCustomAttributes = "";
        $this->Aca_Id->HrefValue = "";
        $this->Aca_Id->TooltipValue = "";

        // Public_Type
        $this->Public_Type->LinkCustomAttributes = "";
        $this->Public_Type->HrefValue = "";
        $this->Public_Type->TooltipValue = "";

        // Public_Journal
        $this->Public_Journal->LinkCustomAttributes = "";
        $this->Public_Journal->HrefValue = "";
        $this->Public_Journal->TooltipValue = "";

        // Public_Title
        $this->Public_Title->LinkCustomAttributes = "";
        $this->Public_Title->HrefValue = "";
        $this->Public_Title->TooltipValue = "";

        // Public_Date
        $this->Public_Date->LinkCustomAttributes = "";
        $this->Public_Date->HrefValue = "";
        $this->Public_Date->TooltipValue = "";

        // Public_Volum
        $this->Public_Volum->LinkCustomAttributes = "";
        $this->Public_Volum->HrefValue = "";
        $this->Public_Volum->TooltipValue = "";

        // Public_Link
        $this->Public_Link->LinkCustomAttributes = "";
        $this->Public_Link->HrefValue = "";
        $this->Public_Link->TooltipValue = "";

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

        // Public_Id
        $this->Public_Id->EditAttrs["class"] = "form-control";
        $this->Public_Id->EditCustomAttributes = "";
        $this->Public_Id->EditValue = $this->Public_Id->CurrentValue;
        $this->Public_Id->ViewCustomAttributes = "";

        // Aca_Id
        $this->Aca_Id->EditAttrs["class"] = "form-control";
        $this->Aca_Id->EditCustomAttributes = "";
        $this->Aca_Id->PlaceHolder = RemoveHtml($this->Aca_Id->caption());

        // Public_Type
        $this->Public_Type->EditAttrs["class"] = "form-control";
        $this->Public_Type->EditCustomAttributes = "";
        $this->Public_Type->PlaceHolder = RemoveHtml($this->Public_Type->caption());

        // Public_Journal
        $this->Public_Journal->EditAttrs["class"] = "form-control";
        $this->Public_Journal->EditCustomAttributes = "";
        if (!$this->Public_Journal->Raw) {
            $this->Public_Journal->CurrentValue = HtmlDecode($this->Public_Journal->CurrentValue);
        }
        $this->Public_Journal->EditValue = $this->Public_Journal->CurrentValue;
        $this->Public_Journal->PlaceHolder = RemoveHtml($this->Public_Journal->caption());

        // Public_Title
        $this->Public_Title->EditAttrs["class"] = "form-control";
        $this->Public_Title->EditCustomAttributes = "";
        if (!$this->Public_Title->Raw) {
            $this->Public_Title->CurrentValue = HtmlDecode($this->Public_Title->CurrentValue);
        }
        $this->Public_Title->EditValue = $this->Public_Title->CurrentValue;
        $this->Public_Title->PlaceHolder = RemoveHtml($this->Public_Title->caption());

        // Public_Date
        $this->Public_Date->EditAttrs["class"] = "form-control";
        $this->Public_Date->EditCustomAttributes = "";
        $this->Public_Date->EditValue = FormatDateTime($this->Public_Date->CurrentValue, 8);
        $this->Public_Date->PlaceHolder = RemoveHtml($this->Public_Date->caption());

        // Public_Volum
        $this->Public_Volum->EditAttrs["class"] = "form-control";
        $this->Public_Volum->EditCustomAttributes = "";
        $this->Public_Volum->EditValue = $this->Public_Volum->CurrentValue;
        $this->Public_Volum->PlaceHolder = RemoveHtml($this->Public_Volum->caption());

        // Public_Link
        $this->Public_Link->EditAttrs["class"] = "form-control";
        $this->Public_Link->EditCustomAttributes = "";
        if (!$this->Public_Link->Raw) {
            $this->Public_Link->CurrentValue = HtmlDecode($this->Public_Link->CurrentValue);
        }
        $this->Public_Link->EditValue = $this->Public_Link->CurrentValue;
        $this->Public_Link->PlaceHolder = RemoveHtml($this->Public_Link->caption());

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
                    $doc->exportCaption($this->Public_Id);
                    $doc->exportCaption($this->Aca_Id);
                    $doc->exportCaption($this->Public_Type);
                    $doc->exportCaption($this->Public_Journal);
                    $doc->exportCaption($this->Public_Title);
                    $doc->exportCaption($this->Public_Date);
                    $doc->exportCaption($this->Public_Volum);
                    $doc->exportCaption($this->Public_Link);
                } else {
                    $doc->exportCaption($this->Public_Id);
                    $doc->exportCaption($this->Aca_Id);
                    $doc->exportCaption($this->Public_Type);
                    $doc->exportCaption($this->Public_Journal);
                    $doc->exportCaption($this->Public_Title);
                    $doc->exportCaption($this->Public_Date);
                    $doc->exportCaption($this->Public_Volum);
                    $doc->exportCaption($this->Public_Link);
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
                        $doc->exportField($this->Public_Id);
                        $doc->exportField($this->Aca_Id);
                        $doc->exportField($this->Public_Type);
                        $doc->exportField($this->Public_Journal);
                        $doc->exportField($this->Public_Title);
                        $doc->exportField($this->Public_Date);
                        $doc->exportField($this->Public_Volum);
                        $doc->exportField($this->Public_Link);
                    } else {
                        $doc->exportField($this->Public_Id);
                        $doc->exportField($this->Aca_Id);
                        $doc->exportField($this->Public_Type);
                        $doc->exportField($this->Public_Journal);
                        $doc->exportField($this->Public_Title);
                        $doc->exportField($this->Public_Date);
                        $doc->exportField($this->Public_Volum);
                        $doc->exportField($this->Public_Link);
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
