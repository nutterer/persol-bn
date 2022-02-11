<?php

namespace PHPMaker2021\upPersonnelv2;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for academicbook
 */
class Academicbook extends DbTable
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
    public $Book_Id;
    public $Aca_Id;
    public $Book_Type;
    public $Book_Cover;
    public $Book_ISBN;
    public $Book_Patent;
    public $Book_File;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'academicbook';
        $this->TableName = 'academicbook';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "`academicbook`";
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

        // Book_Id
        $this->Book_Id = new DbField('academicbook', 'academicbook', 'x_Book_Id', 'Book_Id', '`Book_Id`', '`Book_Id`', 3, 5, -1, false, '`Book_Id`', false, false, false, 'FORMATTED TEXT', 'NO');
        $this->Book_Id->IsAutoIncrement = true; // Autoincrement field
        $this->Book_Id->IsPrimaryKey = true; // Primary key field
        $this->Book_Id->Sortable = true; // Allow sort
        $this->Book_Id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['Book_Id'] = &$this->Book_Id;

        // Aca_Id
        $this->Aca_Id = new DbField('academicbook', 'academicbook', 'x_Aca_Id', 'Aca_Id', '`Aca_Id`', '`Aca_Id`', 3, 5, -1, false, '`Aca_Id`', false, false, false, 'FORMATTED TEXT', 'SELECT');
        $this->Aca_Id->Nullable = false; // NOT NULL field
        $this->Aca_Id->Required = true; // Required field
        $this->Aca_Id->Sortable = true; // Allow sort
        $this->Aca_Id->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->Aca_Id->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        $this->Aca_Id->Lookup = new Lookup('Aca_Id', '_03academicranks', false, 'Aca_Id', ["Aca_Name","","",""], [], [], [], [], [], [], '', '');
        $this->Aca_Id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['Aca_Id'] = &$this->Aca_Id;

        // Book_Type
        $this->Book_Type = new DbField('academicbook', 'academicbook', 'x_Book_Type', 'Book_Type', '`Book_Type`', '`Book_Type`', 3, 2, -1, false, '`Book_Type`', false, false, false, 'FORMATTED TEXT', 'SELECT');
        $this->Book_Type->Nullable = false; // NOT NULL field
        $this->Book_Type->Required = true; // Required field
        $this->Book_Type->Sortable = true; // Allow sort
        $this->Book_Type->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->Book_Type->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        $this->Book_Type->Lookup = new Lookup('Book_Type', 'book_type', false, 'Book_Type_id', ["Book_Type_name","","",""], [], [], [], [], [], [], '', '');
        $this->Book_Type->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['Book_Type'] = &$this->Book_Type;

        // Book_Cover
        $this->Book_Cover = new DbField('academicbook', 'academicbook', 'x_Book_Cover', 'Book_Cover', '`Book_Cover`', '`Book_Cover`', 200, 100, -1, true, '`Book_Cover`', false, false, false, 'FORMATTED TEXT', 'FILE');
        $this->Book_Cover->Nullable = false; // NOT NULL field
        $this->Book_Cover->Required = true; // Required field
        $this->Book_Cover->Sortable = true; // Allow sort
        $this->Fields['Book_Cover'] = &$this->Book_Cover;

        // Book_ISBN
        $this->Book_ISBN = new DbField('academicbook', 'academicbook', 'x_Book_ISBN', 'Book_ISBN', '`Book_ISBN`', '`Book_ISBN`', 200, 13, -1, false, '`Book_ISBN`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Book_ISBN->Nullable = false; // NOT NULL field
        $this->Book_ISBN->Required = true; // Required field
        $this->Book_ISBN->Sortable = true; // Allow sort
        $this->Fields['Book_ISBN'] = &$this->Book_ISBN;

        // Book_Patent
        $this->Book_Patent = new DbField('academicbook', 'academicbook', 'x_Book_Patent', 'Book_Patent', '`Book_Patent`', '`Book_Patent`', 200, 100, -1, false, '`Book_Patent`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Book_Patent->Nullable = false; // NOT NULL field
        $this->Book_Patent->Required = true; // Required field
        $this->Book_Patent->Sortable = true; // Allow sort
        $this->Fields['Book_Patent'] = &$this->Book_Patent;

        // Book_File
        $this->Book_File = new DbField('academicbook', 'academicbook', 'x_Book_File', 'Book_File', '`Book_File`', '`Book_File`', 200, 100, -1, true, '`Book_File`', false, false, false, 'FORMATTED TEXT', 'FILE');
        $this->Book_File->Nullable = false; // NOT NULL field
        $this->Book_File->Required = true; // Required field
        $this->Book_File->Sortable = true; // Allow sort
        $this->Fields['Book_File'] = &$this->Book_File;
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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "`academicbook`";
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
            $this->Book_Id->setDbValue($conn->lastInsertId());
            $rs['Book_Id'] = $this->Book_Id->DbValue;
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
            if (array_key_exists('Book_Id', $rs)) {
                AddFilter($where, QuotedName('Book_Id', $this->Dbid) . '=' . QuotedValue($rs['Book_Id'], $this->Book_Id->DataType, $this->Dbid));
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
        $this->Book_Id->DbValue = $row['Book_Id'];
        $this->Aca_Id->DbValue = $row['Aca_Id'];
        $this->Book_Type->DbValue = $row['Book_Type'];
        $this->Book_Cover->Upload->DbValue = $row['Book_Cover'];
        $this->Book_ISBN->DbValue = $row['Book_ISBN'];
        $this->Book_Patent->DbValue = $row['Book_Patent'];
        $this->Book_File->Upload->DbValue = $row['Book_File'];
    }

    // Delete uploaded files
    public function deleteUploadedFiles($row)
    {
        $this->loadDbValues($row);
        $oldFiles = EmptyValue($row['Book_Cover']) ? [] : [$row['Book_Cover']];
        foreach ($oldFiles as $oldFile) {
            if (file_exists($this->Book_Cover->oldPhysicalUploadPath() . $oldFile)) {
                @unlink($this->Book_Cover->oldPhysicalUploadPath() . $oldFile);
            }
        }
        $oldFiles = EmptyValue($row['Book_File']) ? [] : [$row['Book_File']];
        foreach ($oldFiles as $oldFile) {
            if (file_exists($this->Book_File->oldPhysicalUploadPath() . $oldFile)) {
                @unlink($this->Book_File->oldPhysicalUploadPath() . $oldFile);
            }
        }
    }

    // Record filter WHERE clause
    protected function sqlKeyFilter()
    {
        return "`Book_Id` = @Book_Id@";
    }

    // Get Key
    public function getKey($current = false)
    {
        $keys = [];
        $val = $current ? $this->Book_Id->CurrentValue : $this->Book_Id->OldValue;
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
                $this->Book_Id->CurrentValue = $keys[0];
            } else {
                $this->Book_Id->OldValue = $keys[0];
            }
        }
    }

    // Get record filter
    public function getRecordFilter($row = null)
    {
        $keyFilter = $this->sqlKeyFilter();
        if (is_array($row)) {
            $val = array_key_exists('Book_Id', $row) ? $row['Book_Id'] : null;
        } else {
            $val = $this->Book_Id->OldValue !== null ? $this->Book_Id->OldValue : $this->Book_Id->CurrentValue;
        }
        if (!is_numeric($val)) {
            return "0=1"; // Invalid key
        }
        if ($val === null) {
            return "0=1"; // Invalid key
        } else {
            $keyFilter = str_replace("@Book_Id@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
            return GetUrl("AcademicbookList");
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
        if ($pageName == "AcademicbookView") {
            return $Language->phrase("View");
        } elseif ($pageName == "AcademicbookEdit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "AcademicbookAdd") {
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
                return "AcademicbookView";
            case Config("API_ADD_ACTION"):
                return "AcademicbookAdd";
            case Config("API_EDIT_ACTION"):
                return "AcademicbookEdit";
            case Config("API_DELETE_ACTION"):
                return "AcademicbookDelete";
            case Config("API_LIST_ACTION"):
                return "AcademicbookList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "AcademicbookList";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("AcademicbookView", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("AcademicbookView", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "AcademicbookAdd?" . $this->getUrlParm($parm);
        } else {
            $url = "AcademicbookAdd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("AcademicbookEdit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("AcademicbookAdd", $this->getUrlParm($parm));
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
        return $this->keyUrl("AcademicbookDelete", $this->getUrlParm());
    }

    // Add master url
    public function addMasterUrl($url)
    {
        return $url;
    }

    public function keyToJson($htmlEncode = false)
    {
        $json = "";
        $json .= "Book_Id:" . JsonEncode($this->Book_Id->CurrentValue, "number");
        $json = "{" . $json . "}";
        if ($htmlEncode) {
            $json = HtmlEncode($json);
        }
        return $json;
    }

    // Add key value to URL
    public function keyUrl($url, $parm = "")
    {
        if ($this->Book_Id->CurrentValue !== null) {
            $url .= "/" . rawurlencode($this->Book_Id->CurrentValue);
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
            if (($keyValue = Param("Book_Id") ?? Route("Book_Id")) !== null) {
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
                $this->Book_Id->CurrentValue = $key;
            } else {
                $this->Book_Id->OldValue = $key;
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
        $this->Book_Id->setDbValue($row['Book_Id']);
        $this->Aca_Id->setDbValue($row['Aca_Id']);
        $this->Book_Type->setDbValue($row['Book_Type']);
        $this->Book_Cover->Upload->DbValue = $row['Book_Cover'];
        $this->Book_ISBN->setDbValue($row['Book_ISBN']);
        $this->Book_Patent->setDbValue($row['Book_Patent']);
        $this->Book_File->Upload->DbValue = $row['Book_File'];
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // Book_Id

        // Aca_Id

        // Book_Type

        // Book_Cover

        // Book_ISBN

        // Book_Patent

        // Book_File

        // Book_Id
        $this->Book_Id->ViewValue = $this->Book_Id->CurrentValue;
        $this->Book_Id->ViewCustomAttributes = "";

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

        // Book_Type
        $curVal = strval($this->Book_Type->CurrentValue);
        if ($curVal != "") {
            $this->Book_Type->ViewValue = $this->Book_Type->lookupCacheOption($curVal);
            if ($this->Book_Type->ViewValue === null) { // Lookup from database
                $filterWrk = "`Book_Type_id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                $sqlWrk = $this->Book_Type->Lookup->getSql(false, $filterWrk, '', $this, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->Book_Type->Lookup->renderViewRow($rswrk[0]);
                    $this->Book_Type->ViewValue = $this->Book_Type->displayValue($arwrk);
                } else {
                    $this->Book_Type->ViewValue = $this->Book_Type->CurrentValue;
                }
            }
        } else {
            $this->Book_Type->ViewValue = null;
        }
        $this->Book_Type->ViewCustomAttributes = "";

        // Book_Cover
        if (!EmptyValue($this->Book_Cover->Upload->DbValue)) {
            $this->Book_Cover->ViewValue = $this->Book_Cover->Upload->DbValue;
        } else {
            $this->Book_Cover->ViewValue = "";
        }
        $this->Book_Cover->ViewCustomAttributes = "";

        // Book_ISBN
        $this->Book_ISBN->ViewValue = $this->Book_ISBN->CurrentValue;
        $this->Book_ISBN->ViewCustomAttributes = "";

        // Book_Patent
        $this->Book_Patent->ViewValue = $this->Book_Patent->CurrentValue;
        $this->Book_Patent->ViewCustomAttributes = "";

        // Book_File
        if (!EmptyValue($this->Book_File->Upload->DbValue)) {
            $this->Book_File->ViewValue = $this->Book_File->Upload->DbValue;
        } else {
            $this->Book_File->ViewValue = "";
        }
        $this->Book_File->ViewCustomAttributes = "";

        // Book_Id
        $this->Book_Id->LinkCustomAttributes = "";
        $this->Book_Id->HrefValue = "";
        $this->Book_Id->TooltipValue = "";

        // Aca_Id
        $this->Aca_Id->LinkCustomAttributes = "";
        $this->Aca_Id->HrefValue = "";
        $this->Aca_Id->TooltipValue = "";

        // Book_Type
        $this->Book_Type->LinkCustomAttributes = "";
        $this->Book_Type->HrefValue = "";
        $this->Book_Type->TooltipValue = "";

        // Book_Cover
        $this->Book_Cover->LinkCustomAttributes = "";
        $this->Book_Cover->HrefValue = "";
        $this->Book_Cover->ExportHrefValue = $this->Book_Cover->UploadPath . $this->Book_Cover->Upload->DbValue;
        $this->Book_Cover->TooltipValue = "";

        // Book_ISBN
        $this->Book_ISBN->LinkCustomAttributes = "";
        $this->Book_ISBN->HrefValue = "";
        $this->Book_ISBN->TooltipValue = "";

        // Book_Patent
        $this->Book_Patent->LinkCustomAttributes = "";
        $this->Book_Patent->HrefValue = "";
        $this->Book_Patent->TooltipValue = "";

        // Book_File
        $this->Book_File->LinkCustomAttributes = "";
        $this->Book_File->HrefValue = "";
        $this->Book_File->ExportHrefValue = $this->Book_File->UploadPath . $this->Book_File->Upload->DbValue;
        $this->Book_File->TooltipValue = "";

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

        // Book_Id
        $this->Book_Id->EditAttrs["class"] = "form-control";
        $this->Book_Id->EditCustomAttributes = "";
        $this->Book_Id->EditValue = $this->Book_Id->CurrentValue;
        $this->Book_Id->ViewCustomAttributes = "";

        // Aca_Id
        $this->Aca_Id->EditAttrs["class"] = "form-control";
        $this->Aca_Id->EditCustomAttributes = "";
        $this->Aca_Id->PlaceHolder = RemoveHtml($this->Aca_Id->caption());

        // Book_Type
        $this->Book_Type->EditAttrs["class"] = "form-control";
        $this->Book_Type->EditCustomAttributes = "";
        $this->Book_Type->PlaceHolder = RemoveHtml($this->Book_Type->caption());

        // Book_Cover
        $this->Book_Cover->EditAttrs["class"] = "form-control";
        $this->Book_Cover->EditCustomAttributes = "";
        if (!EmptyValue($this->Book_Cover->Upload->DbValue)) {
            $this->Book_Cover->EditValue = $this->Book_Cover->Upload->DbValue;
        } else {
            $this->Book_Cover->EditValue = "";
        }
        if (!EmptyValue($this->Book_Cover->CurrentValue)) {
            $this->Book_Cover->Upload->FileName = $this->Book_Cover->CurrentValue;
        }

        // Book_ISBN
        $this->Book_ISBN->EditAttrs["class"] = "form-control";
        $this->Book_ISBN->EditCustomAttributes = "";
        if (!$this->Book_ISBN->Raw) {
            $this->Book_ISBN->CurrentValue = HtmlDecode($this->Book_ISBN->CurrentValue);
        }
        $this->Book_ISBN->EditValue = $this->Book_ISBN->CurrentValue;
        $this->Book_ISBN->PlaceHolder = RemoveHtml($this->Book_ISBN->caption());

        // Book_Patent
        $this->Book_Patent->EditAttrs["class"] = "form-control";
        $this->Book_Patent->EditCustomAttributes = "";
        if (!$this->Book_Patent->Raw) {
            $this->Book_Patent->CurrentValue = HtmlDecode($this->Book_Patent->CurrentValue);
        }
        $this->Book_Patent->EditValue = $this->Book_Patent->CurrentValue;
        $this->Book_Patent->PlaceHolder = RemoveHtml($this->Book_Patent->caption());

        // Book_File
        $this->Book_File->EditAttrs["class"] = "form-control";
        $this->Book_File->EditCustomAttributes = "";
        if (!EmptyValue($this->Book_File->Upload->DbValue)) {
            $this->Book_File->EditValue = $this->Book_File->Upload->DbValue;
        } else {
            $this->Book_File->EditValue = "";
        }
        if (!EmptyValue($this->Book_File->CurrentValue)) {
            $this->Book_File->Upload->FileName = $this->Book_File->CurrentValue;
        }

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
                    $doc->exportCaption($this->Book_Id);
                    $doc->exportCaption($this->Aca_Id);
                    $doc->exportCaption($this->Book_Type);
                    $doc->exportCaption($this->Book_Cover);
                    $doc->exportCaption($this->Book_ISBN);
                    $doc->exportCaption($this->Book_Patent);
                    $doc->exportCaption($this->Book_File);
                } else {
                    $doc->exportCaption($this->Book_Id);
                    $doc->exportCaption($this->Aca_Id);
                    $doc->exportCaption($this->Book_Type);
                    $doc->exportCaption($this->Book_Cover);
                    $doc->exportCaption($this->Book_ISBN);
                    $doc->exportCaption($this->Book_Patent);
                    $doc->exportCaption($this->Book_File);
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
                        $doc->exportField($this->Book_Id);
                        $doc->exportField($this->Aca_Id);
                        $doc->exportField($this->Book_Type);
                        $doc->exportField($this->Book_Cover);
                        $doc->exportField($this->Book_ISBN);
                        $doc->exportField($this->Book_Patent);
                        $doc->exportField($this->Book_File);
                    } else {
                        $doc->exportField($this->Book_Id);
                        $doc->exportField($this->Aca_Id);
                        $doc->exportField($this->Book_Type);
                        $doc->exportField($this->Book_Cover);
                        $doc->exportField($this->Book_ISBN);
                        $doc->exportField($this->Book_Patent);
                        $doc->exportField($this->Book_File);
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
        $width = ($width > 0) ? $width : Config("THUMBNAIL_DEFAULT_WIDTH");
        $height = ($height > 0) ? $height : Config("THUMBNAIL_DEFAULT_HEIGHT");

        // Set up field name / file name field / file type field
        $fldName = "";
        $fileNameFld = "";
        $fileTypeFld = "";
        if ($fldparm == 'Book_Cover') {
            $fldName = "Book_Cover";
            $fileNameFld = "Book_Cover";
        } elseif ($fldparm == 'Book_File') {
            $fldName = "Book_File";
            $fileNameFld = "Book_File";
        } else {
            return false; // Incorrect field
        }

        // Set up key values
        $ar = explode(Config("COMPOSITE_KEY_SEPARATOR"), $key);
        if (count($ar) == 1) {
            $this->Book_Id->CurrentValue = $ar[0];
        } else {
            return false; // Incorrect key
        }

        // Set up filter (WHERE Clause)
        $filter = $this->getRecordFilter();
        $this->CurrentFilter = $filter;
        $sql = $this->getCurrentSql();
        $conn = $this->getConnection();
        $dbtype = GetConnectionType($this->Dbid);
        if ($row = $conn->fetchAssoc($sql)) {
            $val = $row[$fldName];
            if (!EmptyValue($val)) {
                $fld = $this->Fields[$fldName];

                // Binary data
                if ($fld->DataType == DATATYPE_BLOB) {
                    if ($dbtype != "MYSQL") {
                        if (is_resource($val) && get_resource_type($val) == "stream") { // Byte array
                            $val = stream_get_contents($val);
                        }
                    }
                    if ($resize) {
                        ResizeBinary($val, $width, $height, 100, $plugins);
                    }

                    // Write file type
                    if ($fileTypeFld != "" && !EmptyValue($row[$fileTypeFld])) {
                        AddHeader("Content-type", $row[$fileTypeFld]);
                    } else {
                        AddHeader("Content-type", ContentType($val));
                    }

                    // Write file name
                    $downloadPdf = !Config("EMBED_PDF") && Config("DOWNLOAD_PDF_FILE");
                    if ($fileNameFld != "" && !EmptyValue($row[$fileNameFld])) {
                        $fileName = $row[$fileNameFld];
                        $pathinfo = pathinfo($fileName);
                        $ext = strtolower(@$pathinfo["extension"]);
                        $isPdf = SameText($ext, "pdf");
                        if ($downloadPdf || !$isPdf) { // Skip header if not download PDF
                            AddHeader("Content-Disposition", "attachment; filename=\"" . $fileName . "\"");
                        }
                    } else {
                        $ext = ContentExtension($val);
                        $isPdf = SameText($ext, ".pdf");
                        if ($isPdf && $downloadPdf) { // Add header if download PDF
                            AddHeader("Content-Disposition", "attachment; filename=\"" . $fileName . "\"");
                        }
                    }

                    // Write file data
                    if (
                        StartsString("PK", $val) &&
                        ContainsString($val, "[Content_Types].xml") &&
                        ContainsString($val, "_rels") &&
                        ContainsString($val, "docProps")
                    ) { // Fix Office 2007 documents
                        if (!EndsString("\0\0\0", $val)) { // Not ends with 3 or 4 \0
                            $val .= "\0\0\0\0";
                        }
                    }

                    // Clear any debug message
                    if (ob_get_length()) {
                        ob_end_clean();
                    }

                    // Write binary data
                    Write($val);

                // Upload to folder
                } else {
                    if ($fld->UploadMultiple) {
                        $files = explode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $val);
                    } else {
                        $files = [$val];
                    }
                    $data = [];
                    $ar = [];
                    foreach ($files as $file) {
                        if (!EmptyValue($file)) {
                            if (Config("ENCRYPT_FILE_PATH")) {
                                $ar[$file] = FullUrl(GetApiUrl(Config("API_FILE_ACTION") .
                                    "/" . $this->TableVar . "/" . Encrypt($fld->physicalUploadPath() . $file)));
                            } else {
                                $ar[$file] = FullUrl($fld->hrefPath() . $file);
                            }
                        }
                    }
                    $data[$fld->Param] = $ar;
                    WriteJson($data);
                }
            }
            return true;
        }
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
