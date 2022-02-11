<?php

namespace PHPMaker2021\upPersonnel;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for academicranks
 */
class Academicranks extends DbTable
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
    public $Aca_Id;
    public $Per_Id;
    public $Aca_RequesDate;
    public $Aca_AcceptDate;
    public $Aca_EstimateStart;
    public $Aca_EstimateEnd;
    public $Aca_Name;
    public $Aca_Status;
    public $Aca_SkillMajor;
    public $Aca_Report;
    public $Aca_EstimateTeaching;
    public $Aca_EstimateBook;
    public $Aca_EstimateNum;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'academicranks';
        $this->TableName = 'academicranks';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "`academicranks`";
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

        // Aca_Id
        $this->Aca_Id = new DbField('academicranks', 'academicranks', 'x_Aca_Id', 'Aca_Id', '`Aca_Id`', '`Aca_Id`', 3, 5, -1, false, '`Aca_Id`', false, false, false, 'FORMATTED TEXT', 'NO');
        $this->Aca_Id->IsAutoIncrement = true; // Autoincrement field
        $this->Aca_Id->IsPrimaryKey = true; // Primary key field
        $this->Aca_Id->Sortable = true; // Allow sort
        $this->Aca_Id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['Aca_Id'] = &$this->Aca_Id;

        // Per_Id
        $this->Per_Id = new DbField('academicranks', 'academicranks', 'x_Per_Id', 'Per_Id', '`Per_Id`', '`Per_Id`', 3, 10, -1, false, '`Per_Id`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Per_Id->Nullable = false; // NOT NULL field
        $this->Per_Id->Required = true; // Required field
        $this->Per_Id->Sortable = true; // Allow sort
        $this->Per_Id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['Per_Id'] = &$this->Per_Id;

        // Aca_RequesDate
        $this->Aca_RequesDate = new DbField('academicranks', 'academicranks', 'x_Aca_RequesDate', 'Aca_RequesDate', '`Aca_RequesDate`', CastDateFieldForLike("`Aca_RequesDate`", 0, "DB"), 133, 10, 0, false, '`Aca_RequesDate`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Aca_RequesDate->Nullable = false; // NOT NULL field
        $this->Aca_RequesDate->Required = true; // Required field
        $this->Aca_RequesDate->Sortable = true; // Allow sort
        $this->Aca_RequesDate->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->Fields['Aca_RequesDate'] = &$this->Aca_RequesDate;

        // Aca_AcceptDate
        $this->Aca_AcceptDate = new DbField('academicranks', 'academicranks', 'x_Aca_AcceptDate', 'Aca_AcceptDate', '`Aca_AcceptDate`', CastDateFieldForLike("`Aca_AcceptDate`", 0, "DB"), 133, 10, 0, false, '`Aca_AcceptDate`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Aca_AcceptDate->Nullable = false; // NOT NULL field
        $this->Aca_AcceptDate->Required = true; // Required field
        $this->Aca_AcceptDate->Sortable = true; // Allow sort
        $this->Aca_AcceptDate->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->Fields['Aca_AcceptDate'] = &$this->Aca_AcceptDate;

        // Aca_EstimateStart
        $this->Aca_EstimateStart = new DbField('academicranks', 'academicranks', 'x_Aca_EstimateStart', 'Aca_EstimateStart', '`Aca_EstimateStart`', CastDateFieldForLike("`Aca_EstimateStart`", 0, "DB"), 133, 10, 0, false, '`Aca_EstimateStart`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Aca_EstimateStart->Nullable = false; // NOT NULL field
        $this->Aca_EstimateStart->Required = true; // Required field
        $this->Aca_EstimateStart->Sortable = true; // Allow sort
        $this->Aca_EstimateStart->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->Fields['Aca_EstimateStart'] = &$this->Aca_EstimateStart;

        // Aca_EstimateEnd
        $this->Aca_EstimateEnd = new DbField('academicranks', 'academicranks', 'x_Aca_EstimateEnd', 'Aca_EstimateEnd', '`Aca_EstimateEnd`', CastDateFieldForLike("`Aca_EstimateEnd`", 0, "DB"), 133, 10, 0, false, '`Aca_EstimateEnd`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Aca_EstimateEnd->Nullable = false; // NOT NULL field
        $this->Aca_EstimateEnd->Required = true; // Required field
        $this->Aca_EstimateEnd->Sortable = true; // Allow sort
        $this->Aca_EstimateEnd->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->Fields['Aca_EstimateEnd'] = &$this->Aca_EstimateEnd;

        // Aca_Name
        $this->Aca_Name = new DbField('academicranks', 'academicranks', 'x_Aca_Name', 'Aca_Name', '`Aca_Name`', '`Aca_Name`', 200, 100, -1, false, '`Aca_Name`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Aca_Name->Nullable = false; // NOT NULL field
        $this->Aca_Name->Required = true; // Required field
        $this->Aca_Name->Sortable = true; // Allow sort
        $this->Fields['Aca_Name'] = &$this->Aca_Name;

        // Aca_Status
        $this->Aca_Status = new DbField('academicranks', 'academicranks', 'x_Aca_Status', 'Aca_Status', '`Aca_Status`', '`Aca_Status`', 200, 100, -1, false, '`Aca_Status`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Aca_Status->Nullable = false; // NOT NULL field
        $this->Aca_Status->Required = true; // Required field
        $this->Aca_Status->Sortable = true; // Allow sort
        $this->Fields['Aca_Status'] = &$this->Aca_Status;

        // Aca_SkillMajor
        $this->Aca_SkillMajor = new DbField('academicranks', 'academicranks', 'x_Aca_SkillMajor', 'Aca_SkillMajor', '`Aca_SkillMajor`', '`Aca_SkillMajor`', 200, 100, -1, false, '`Aca_SkillMajor`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Aca_SkillMajor->Nullable = false; // NOT NULL field
        $this->Aca_SkillMajor->Required = true; // Required field
        $this->Aca_SkillMajor->Sortable = true; // Allow sort
        $this->Fields['Aca_SkillMajor'] = &$this->Aca_SkillMajor;

        // Aca_Report
        $this->Aca_Report = new DbField('academicranks', 'academicranks', 'x_Aca_Report', 'Aca_Report', '`Aca_Report`', CastDateFieldForLike("`Aca_Report`", 0, "DB"), 133, 10, 0, false, '`Aca_Report`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Aca_Report->Nullable = false; // NOT NULL field
        $this->Aca_Report->Required = true; // Required field
        $this->Aca_Report->Sortable = true; // Allow sort
        $this->Aca_Report->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->Fields['Aca_Report'] = &$this->Aca_Report;

        // Aca_EstimateTeaching
        $this->Aca_EstimateTeaching = new DbField('academicranks', 'academicranks', 'x_Aca_EstimateTeaching', 'Aca_EstimateTeaching', '`Aca_EstimateTeaching`', '`Aca_EstimateTeaching`', 200, 10, -1, false, '`Aca_EstimateTeaching`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Aca_EstimateTeaching->Nullable = false; // NOT NULL field
        $this->Aca_EstimateTeaching->Required = true; // Required field
        $this->Aca_EstimateTeaching->Sortable = true; // Allow sort
        $this->Fields['Aca_EstimateTeaching'] = &$this->Aca_EstimateTeaching;

        // Aca_EstimateBook
        $this->Aca_EstimateBook = new DbField('academicranks', 'academicranks', 'x_Aca_EstimateBook', 'Aca_EstimateBook', '`Aca_EstimateBook`', '`Aca_EstimateBook`', 200, 10, -1, false, '`Aca_EstimateBook`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Aca_EstimateBook->Nullable = false; // NOT NULL field
        $this->Aca_EstimateBook->Required = true; // Required field
        $this->Aca_EstimateBook->Sortable = true; // Allow sort
        $this->Fields['Aca_EstimateBook'] = &$this->Aca_EstimateBook;

        // Aca_EstimateNum
        $this->Aca_EstimateNum = new DbField('academicranks', 'academicranks', 'x_Aca_EstimateNum', 'Aca_EstimateNum', '`Aca_EstimateNum`', '`Aca_EstimateNum`', 200, 1, -1, false, '`Aca_EstimateNum`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Aca_EstimateNum->Nullable = false; // NOT NULL field
        $this->Aca_EstimateNum->Required = true; // Required field
        $this->Aca_EstimateNum->Sortable = true; // Allow sort
        $this->Fields['Aca_EstimateNum'] = &$this->Aca_EstimateNum;
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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "`academicranks`";
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
            $this->Aca_Id->setDbValue($conn->lastInsertId());
            $rs['Aca_Id'] = $this->Aca_Id->DbValue;
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
            if (array_key_exists('Aca_Id', $rs)) {
                AddFilter($where, QuotedName('Aca_Id', $this->Dbid) . '=' . QuotedValue($rs['Aca_Id'], $this->Aca_Id->DataType, $this->Dbid));
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
        $this->Aca_Id->DbValue = $row['Aca_Id'];
        $this->Per_Id->DbValue = $row['Per_Id'];
        $this->Aca_RequesDate->DbValue = $row['Aca_RequesDate'];
        $this->Aca_AcceptDate->DbValue = $row['Aca_AcceptDate'];
        $this->Aca_EstimateStart->DbValue = $row['Aca_EstimateStart'];
        $this->Aca_EstimateEnd->DbValue = $row['Aca_EstimateEnd'];
        $this->Aca_Name->DbValue = $row['Aca_Name'];
        $this->Aca_Status->DbValue = $row['Aca_Status'];
        $this->Aca_SkillMajor->DbValue = $row['Aca_SkillMajor'];
        $this->Aca_Report->DbValue = $row['Aca_Report'];
        $this->Aca_EstimateTeaching->DbValue = $row['Aca_EstimateTeaching'];
        $this->Aca_EstimateBook->DbValue = $row['Aca_EstimateBook'];
        $this->Aca_EstimateNum->DbValue = $row['Aca_EstimateNum'];
    }

    // Delete uploaded files
    public function deleteUploadedFiles($row)
    {
        $this->loadDbValues($row);
    }

    // Record filter WHERE clause
    protected function sqlKeyFilter()
    {
        return "`Aca_Id` = @Aca_Id@";
    }

    // Get Key
    public function getKey($current = false)
    {
        $keys = [];
        $val = $current ? $this->Aca_Id->CurrentValue : $this->Aca_Id->OldValue;
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
                $this->Aca_Id->CurrentValue = $keys[0];
            } else {
                $this->Aca_Id->OldValue = $keys[0];
            }
        }
    }

    // Get record filter
    public function getRecordFilter($row = null)
    {
        $keyFilter = $this->sqlKeyFilter();
        if (is_array($row)) {
            $val = array_key_exists('Aca_Id', $row) ? $row['Aca_Id'] : null;
        } else {
            $val = $this->Aca_Id->OldValue !== null ? $this->Aca_Id->OldValue : $this->Aca_Id->CurrentValue;
        }
        if (!is_numeric($val)) {
            return "0=1"; // Invalid key
        }
        if ($val === null) {
            return "0=1"; // Invalid key
        } else {
            $keyFilter = str_replace("@Aca_Id@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
            return GetUrl("AcademicranksList");
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
        if ($pageName == "AcademicranksView") {
            return $Language->phrase("View");
        } elseif ($pageName == "AcademicranksEdit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "AcademicranksAdd") {
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
                return "AcademicranksView";
            case Config("API_ADD_ACTION"):
                return "AcademicranksAdd";
            case Config("API_EDIT_ACTION"):
                return "AcademicranksEdit";
            case Config("API_DELETE_ACTION"):
                return "AcademicranksDelete";
            case Config("API_LIST_ACTION"):
                return "AcademicranksList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "AcademicranksList";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("AcademicranksView", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("AcademicranksView", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "AcademicranksAdd?" . $this->getUrlParm($parm);
        } else {
            $url = "AcademicranksAdd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("AcademicranksEdit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("AcademicranksAdd", $this->getUrlParm($parm));
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
        return $this->keyUrl("AcademicranksDelete", $this->getUrlParm());
    }

    // Add master url
    public function addMasterUrl($url)
    {
        return $url;
    }

    public function keyToJson($htmlEncode = false)
    {
        $json = "";
        $json .= "Aca_Id:" . JsonEncode($this->Aca_Id->CurrentValue, "number");
        $json = "{" . $json . "}";
        if ($htmlEncode) {
            $json = HtmlEncode($json);
        }
        return $json;
    }

    // Add key value to URL
    public function keyUrl($url, $parm = "")
    {
        if ($this->Aca_Id->CurrentValue !== null) {
            $url .= "/" . rawurlencode($this->Aca_Id->CurrentValue);
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
            if (($keyValue = Param("Aca_Id") ?? Route("Aca_Id")) !== null) {
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
                $this->Aca_Id->CurrentValue = $key;
            } else {
                $this->Aca_Id->OldValue = $key;
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
        $this->Aca_Id->setDbValue($row['Aca_Id']);
        $this->Per_Id->setDbValue($row['Per_Id']);
        $this->Aca_RequesDate->setDbValue($row['Aca_RequesDate']);
        $this->Aca_AcceptDate->setDbValue($row['Aca_AcceptDate']);
        $this->Aca_EstimateStart->setDbValue($row['Aca_EstimateStart']);
        $this->Aca_EstimateEnd->setDbValue($row['Aca_EstimateEnd']);
        $this->Aca_Name->setDbValue($row['Aca_Name']);
        $this->Aca_Status->setDbValue($row['Aca_Status']);
        $this->Aca_SkillMajor->setDbValue($row['Aca_SkillMajor']);
        $this->Aca_Report->setDbValue($row['Aca_Report']);
        $this->Aca_EstimateTeaching->setDbValue($row['Aca_EstimateTeaching']);
        $this->Aca_EstimateBook->setDbValue($row['Aca_EstimateBook']);
        $this->Aca_EstimateNum->setDbValue($row['Aca_EstimateNum']);
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // Aca_Id

        // Per_Id

        // Aca_RequesDate

        // Aca_AcceptDate

        // Aca_EstimateStart

        // Aca_EstimateEnd

        // Aca_Name

        // Aca_Status

        // Aca_SkillMajor

        // Aca_Report

        // Aca_EstimateTeaching

        // Aca_EstimateBook

        // Aca_EstimateNum

        // Aca_Id
        $this->Aca_Id->ViewValue = $this->Aca_Id->CurrentValue;
        $this->Aca_Id->ViewCustomAttributes = "";

        // Per_Id
        $this->Per_Id->ViewValue = $this->Per_Id->CurrentValue;
        $this->Per_Id->ViewValue = FormatNumber($this->Per_Id->ViewValue, 0, -2, -2, -2);
        $this->Per_Id->ViewCustomAttributes = "";

        // Aca_RequesDate
        $this->Aca_RequesDate->ViewValue = $this->Aca_RequesDate->CurrentValue;
        $this->Aca_RequesDate->ViewValue = FormatDateTime($this->Aca_RequesDate->ViewValue, 0);
        $this->Aca_RequesDate->ViewCustomAttributes = "";

        // Aca_AcceptDate
        $this->Aca_AcceptDate->ViewValue = $this->Aca_AcceptDate->CurrentValue;
        $this->Aca_AcceptDate->ViewValue = FormatDateTime($this->Aca_AcceptDate->ViewValue, 0);
        $this->Aca_AcceptDate->ViewCustomAttributes = "";

        // Aca_EstimateStart
        $this->Aca_EstimateStart->ViewValue = $this->Aca_EstimateStart->CurrentValue;
        $this->Aca_EstimateStart->ViewValue = FormatDateTime($this->Aca_EstimateStart->ViewValue, 0);
        $this->Aca_EstimateStart->ViewCustomAttributes = "";

        // Aca_EstimateEnd
        $this->Aca_EstimateEnd->ViewValue = $this->Aca_EstimateEnd->CurrentValue;
        $this->Aca_EstimateEnd->ViewValue = FormatDateTime($this->Aca_EstimateEnd->ViewValue, 0);
        $this->Aca_EstimateEnd->ViewCustomAttributes = "";

        // Aca_Name
        $this->Aca_Name->ViewValue = $this->Aca_Name->CurrentValue;
        $this->Aca_Name->ViewCustomAttributes = "";

        // Aca_Status
        $this->Aca_Status->ViewValue = $this->Aca_Status->CurrentValue;
        $this->Aca_Status->ViewCustomAttributes = "";

        // Aca_SkillMajor
        $this->Aca_SkillMajor->ViewValue = $this->Aca_SkillMajor->CurrentValue;
        $this->Aca_SkillMajor->ViewCustomAttributes = "";

        // Aca_Report
        $this->Aca_Report->ViewValue = $this->Aca_Report->CurrentValue;
        $this->Aca_Report->ViewValue = FormatDateTime($this->Aca_Report->ViewValue, 0);
        $this->Aca_Report->ViewCustomAttributes = "";

        // Aca_EstimateTeaching
        $this->Aca_EstimateTeaching->ViewValue = $this->Aca_EstimateTeaching->CurrentValue;
        $this->Aca_EstimateTeaching->ViewCustomAttributes = "";

        // Aca_EstimateBook
        $this->Aca_EstimateBook->ViewValue = $this->Aca_EstimateBook->CurrentValue;
        $this->Aca_EstimateBook->ViewCustomAttributes = "";

        // Aca_EstimateNum
        $this->Aca_EstimateNum->ViewValue = $this->Aca_EstimateNum->CurrentValue;
        $this->Aca_EstimateNum->ViewCustomAttributes = "";

        // Aca_Id
        $this->Aca_Id->LinkCustomAttributes = "";
        $this->Aca_Id->HrefValue = "";
        $this->Aca_Id->TooltipValue = "";

        // Per_Id
        $this->Per_Id->LinkCustomAttributes = "";
        $this->Per_Id->HrefValue = "";
        $this->Per_Id->TooltipValue = "";

        // Aca_RequesDate
        $this->Aca_RequesDate->LinkCustomAttributes = "";
        $this->Aca_RequesDate->HrefValue = "";
        $this->Aca_RequesDate->TooltipValue = "";

        // Aca_AcceptDate
        $this->Aca_AcceptDate->LinkCustomAttributes = "";
        $this->Aca_AcceptDate->HrefValue = "";
        $this->Aca_AcceptDate->TooltipValue = "";

        // Aca_EstimateStart
        $this->Aca_EstimateStart->LinkCustomAttributes = "";
        $this->Aca_EstimateStart->HrefValue = "";
        $this->Aca_EstimateStart->TooltipValue = "";

        // Aca_EstimateEnd
        $this->Aca_EstimateEnd->LinkCustomAttributes = "";
        $this->Aca_EstimateEnd->HrefValue = "";
        $this->Aca_EstimateEnd->TooltipValue = "";

        // Aca_Name
        $this->Aca_Name->LinkCustomAttributes = "";
        $this->Aca_Name->HrefValue = "";
        $this->Aca_Name->TooltipValue = "";

        // Aca_Status
        $this->Aca_Status->LinkCustomAttributes = "";
        $this->Aca_Status->HrefValue = "";
        $this->Aca_Status->TooltipValue = "";

        // Aca_SkillMajor
        $this->Aca_SkillMajor->LinkCustomAttributes = "";
        $this->Aca_SkillMajor->HrefValue = "";
        $this->Aca_SkillMajor->TooltipValue = "";

        // Aca_Report
        $this->Aca_Report->LinkCustomAttributes = "";
        $this->Aca_Report->HrefValue = "";
        $this->Aca_Report->TooltipValue = "";

        // Aca_EstimateTeaching
        $this->Aca_EstimateTeaching->LinkCustomAttributes = "";
        $this->Aca_EstimateTeaching->HrefValue = "";
        $this->Aca_EstimateTeaching->TooltipValue = "";

        // Aca_EstimateBook
        $this->Aca_EstimateBook->LinkCustomAttributes = "";
        $this->Aca_EstimateBook->HrefValue = "";
        $this->Aca_EstimateBook->TooltipValue = "";

        // Aca_EstimateNum
        $this->Aca_EstimateNum->LinkCustomAttributes = "";
        $this->Aca_EstimateNum->HrefValue = "";
        $this->Aca_EstimateNum->TooltipValue = "";

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

        // Aca_Id
        $this->Aca_Id->EditAttrs["class"] = "form-control";
        $this->Aca_Id->EditCustomAttributes = "";
        $this->Aca_Id->EditValue = $this->Aca_Id->CurrentValue;
        $this->Aca_Id->ViewCustomAttributes = "";

        // Per_Id
        $this->Per_Id->EditAttrs["class"] = "form-control";
        $this->Per_Id->EditCustomAttributes = "";
        $this->Per_Id->EditValue = $this->Per_Id->CurrentValue;
        $this->Per_Id->PlaceHolder = RemoveHtml($this->Per_Id->caption());

        // Aca_RequesDate
        $this->Aca_RequesDate->EditAttrs["class"] = "form-control";
        $this->Aca_RequesDate->EditCustomAttributes = "";
        $this->Aca_RequesDate->EditValue = FormatDateTime($this->Aca_RequesDate->CurrentValue, 8);
        $this->Aca_RequesDate->PlaceHolder = RemoveHtml($this->Aca_RequesDate->caption());

        // Aca_AcceptDate
        $this->Aca_AcceptDate->EditAttrs["class"] = "form-control";
        $this->Aca_AcceptDate->EditCustomAttributes = "";
        $this->Aca_AcceptDate->EditValue = FormatDateTime($this->Aca_AcceptDate->CurrentValue, 8);
        $this->Aca_AcceptDate->PlaceHolder = RemoveHtml($this->Aca_AcceptDate->caption());

        // Aca_EstimateStart
        $this->Aca_EstimateStart->EditAttrs["class"] = "form-control";
        $this->Aca_EstimateStart->EditCustomAttributes = "";
        $this->Aca_EstimateStart->EditValue = FormatDateTime($this->Aca_EstimateStart->CurrentValue, 8);
        $this->Aca_EstimateStart->PlaceHolder = RemoveHtml($this->Aca_EstimateStart->caption());

        // Aca_EstimateEnd
        $this->Aca_EstimateEnd->EditAttrs["class"] = "form-control";
        $this->Aca_EstimateEnd->EditCustomAttributes = "";
        $this->Aca_EstimateEnd->EditValue = FormatDateTime($this->Aca_EstimateEnd->CurrentValue, 8);
        $this->Aca_EstimateEnd->PlaceHolder = RemoveHtml($this->Aca_EstimateEnd->caption());

        // Aca_Name
        $this->Aca_Name->EditAttrs["class"] = "form-control";
        $this->Aca_Name->EditCustomAttributes = "";
        if (!$this->Aca_Name->Raw) {
            $this->Aca_Name->CurrentValue = HtmlDecode($this->Aca_Name->CurrentValue);
        }
        $this->Aca_Name->EditValue = $this->Aca_Name->CurrentValue;
        $this->Aca_Name->PlaceHolder = RemoveHtml($this->Aca_Name->caption());

        // Aca_Status
        $this->Aca_Status->EditAttrs["class"] = "form-control";
        $this->Aca_Status->EditCustomAttributes = "";
        if (!$this->Aca_Status->Raw) {
            $this->Aca_Status->CurrentValue = HtmlDecode($this->Aca_Status->CurrentValue);
        }
        $this->Aca_Status->EditValue = $this->Aca_Status->CurrentValue;
        $this->Aca_Status->PlaceHolder = RemoveHtml($this->Aca_Status->caption());

        // Aca_SkillMajor
        $this->Aca_SkillMajor->EditAttrs["class"] = "form-control";
        $this->Aca_SkillMajor->EditCustomAttributes = "";
        if (!$this->Aca_SkillMajor->Raw) {
            $this->Aca_SkillMajor->CurrentValue = HtmlDecode($this->Aca_SkillMajor->CurrentValue);
        }
        $this->Aca_SkillMajor->EditValue = $this->Aca_SkillMajor->CurrentValue;
        $this->Aca_SkillMajor->PlaceHolder = RemoveHtml($this->Aca_SkillMajor->caption());

        // Aca_Report
        $this->Aca_Report->EditAttrs["class"] = "form-control";
        $this->Aca_Report->EditCustomAttributes = "";
        $this->Aca_Report->EditValue = FormatDateTime($this->Aca_Report->CurrentValue, 8);
        $this->Aca_Report->PlaceHolder = RemoveHtml($this->Aca_Report->caption());

        // Aca_EstimateTeaching
        $this->Aca_EstimateTeaching->EditAttrs["class"] = "form-control";
        $this->Aca_EstimateTeaching->EditCustomAttributes = "";
        if (!$this->Aca_EstimateTeaching->Raw) {
            $this->Aca_EstimateTeaching->CurrentValue = HtmlDecode($this->Aca_EstimateTeaching->CurrentValue);
        }
        $this->Aca_EstimateTeaching->EditValue = $this->Aca_EstimateTeaching->CurrentValue;
        $this->Aca_EstimateTeaching->PlaceHolder = RemoveHtml($this->Aca_EstimateTeaching->caption());

        // Aca_EstimateBook
        $this->Aca_EstimateBook->EditAttrs["class"] = "form-control";
        $this->Aca_EstimateBook->EditCustomAttributes = "";
        if (!$this->Aca_EstimateBook->Raw) {
            $this->Aca_EstimateBook->CurrentValue = HtmlDecode($this->Aca_EstimateBook->CurrentValue);
        }
        $this->Aca_EstimateBook->EditValue = $this->Aca_EstimateBook->CurrentValue;
        $this->Aca_EstimateBook->PlaceHolder = RemoveHtml($this->Aca_EstimateBook->caption());

        // Aca_EstimateNum
        $this->Aca_EstimateNum->EditAttrs["class"] = "form-control";
        $this->Aca_EstimateNum->EditCustomAttributes = "";
        if (!$this->Aca_EstimateNum->Raw) {
            $this->Aca_EstimateNum->CurrentValue = HtmlDecode($this->Aca_EstimateNum->CurrentValue);
        }
        $this->Aca_EstimateNum->EditValue = $this->Aca_EstimateNum->CurrentValue;
        $this->Aca_EstimateNum->PlaceHolder = RemoveHtml($this->Aca_EstimateNum->caption());

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
                    $doc->exportCaption($this->Aca_Id);
                    $doc->exportCaption($this->Per_Id);
                    $doc->exportCaption($this->Aca_RequesDate);
                    $doc->exportCaption($this->Aca_AcceptDate);
                    $doc->exportCaption($this->Aca_EstimateStart);
                    $doc->exportCaption($this->Aca_EstimateEnd);
                    $doc->exportCaption($this->Aca_Name);
                    $doc->exportCaption($this->Aca_Status);
                    $doc->exportCaption($this->Aca_SkillMajor);
                    $doc->exportCaption($this->Aca_Report);
                    $doc->exportCaption($this->Aca_EstimateTeaching);
                    $doc->exportCaption($this->Aca_EstimateBook);
                    $doc->exportCaption($this->Aca_EstimateNum);
                } else {
                    $doc->exportCaption($this->Aca_Id);
                    $doc->exportCaption($this->Per_Id);
                    $doc->exportCaption($this->Aca_RequesDate);
                    $doc->exportCaption($this->Aca_AcceptDate);
                    $doc->exportCaption($this->Aca_EstimateStart);
                    $doc->exportCaption($this->Aca_EstimateEnd);
                    $doc->exportCaption($this->Aca_Name);
                    $doc->exportCaption($this->Aca_Status);
                    $doc->exportCaption($this->Aca_SkillMajor);
                    $doc->exportCaption($this->Aca_Report);
                    $doc->exportCaption($this->Aca_EstimateTeaching);
                    $doc->exportCaption($this->Aca_EstimateBook);
                    $doc->exportCaption($this->Aca_EstimateNum);
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
                        $doc->exportField($this->Aca_Id);
                        $doc->exportField($this->Per_Id);
                        $doc->exportField($this->Aca_RequesDate);
                        $doc->exportField($this->Aca_AcceptDate);
                        $doc->exportField($this->Aca_EstimateStart);
                        $doc->exportField($this->Aca_EstimateEnd);
                        $doc->exportField($this->Aca_Name);
                        $doc->exportField($this->Aca_Status);
                        $doc->exportField($this->Aca_SkillMajor);
                        $doc->exportField($this->Aca_Report);
                        $doc->exportField($this->Aca_EstimateTeaching);
                        $doc->exportField($this->Aca_EstimateBook);
                        $doc->exportField($this->Aca_EstimateNum);
                    } else {
                        $doc->exportField($this->Aca_Id);
                        $doc->exportField($this->Per_Id);
                        $doc->exportField($this->Aca_RequesDate);
                        $doc->exportField($this->Aca_AcceptDate);
                        $doc->exportField($this->Aca_EstimateStart);
                        $doc->exportField($this->Aca_EstimateEnd);
                        $doc->exportField($this->Aca_Name);
                        $doc->exportField($this->Aca_Status);
                        $doc->exportField($this->Aca_SkillMajor);
                        $doc->exportField($this->Aca_Report);
                        $doc->exportField($this->Aca_EstimateTeaching);
                        $doc->exportField($this->Aca_EstimateBook);
                        $doc->exportField($this->Aca_EstimateNum);
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
