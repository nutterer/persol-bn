<?php

namespace PHPMaker2021\upPersonnelv2;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for graduation
 */
class Graduation extends DbTable
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
    public $Grad_Id;
    public $Per_Id;
    public $Grad_Degree;
    public $Grad_Major;
    public $Grad_ShortDegree;
    public $Grad_Institution;
    public $Grad_Provinces;
    public $Grad_Country;
    public $Grad_Start;
    public $Grad_End;
    public $Grad_GPA;
    public $Grad_Honor;
    public $Grad_Admission;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'graduation';
        $this->TableName = 'graduation';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "`graduation`";
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

        // Grad_Id
        $this->Grad_Id = new DbField('graduation', 'graduation', 'x_Grad_Id', 'Grad_Id', '`Grad_Id`', '`Grad_Id`', 3, 5, -1, false, '`Grad_Id`', false, false, false, 'FORMATTED TEXT', 'NO');
        $this->Grad_Id->IsAutoIncrement = true; // Autoincrement field
        $this->Grad_Id->IsPrimaryKey = true; // Primary key field
        $this->Grad_Id->Sortable = true; // Allow sort
        $this->Grad_Id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['Grad_Id'] = &$this->Grad_Id;

        // Per_Id
        $this->Per_Id = new DbField('graduation', 'graduation', 'x_Per_Id', 'Per_Id', '`Per_Id`', '`Per_Id`', 3, 4, -1, false, '`Per_Id`', false, false, false, 'FORMATTED TEXT', 'SELECT');
        $this->Per_Id->Nullable = false; // NOT NULL field
        $this->Per_Id->Required = true; // Required field
        $this->Per_Id->Sortable = true; // Allow sort
        $this->Per_Id->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->Per_Id->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        $this->Per_Id->Lookup = new Lookup('Per_Id', '_01personnel', false, 'Per_Id', ["Per_Id","Per_ThaiName","Per_ThaiLastName",""], [], [], [], [], [], [], '', '');
        $this->Per_Id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['Per_Id'] = &$this->Per_Id;

        // Grad_Degree
        $this->Grad_Degree = new DbField('graduation', 'graduation', 'x_Grad_Degree', 'Grad_Degree', '`Grad_Degree`', '`Grad_Degree`', 201, 256, -1, false, '`Grad_Degree`', false, false, false, 'FORMATTED TEXT', 'TEXTAREA');
        $this->Grad_Degree->Nullable = false; // NOT NULL field
        $this->Grad_Degree->Required = true; // Required field
        $this->Grad_Degree->Sortable = true; // Allow sort
        $this->Fields['Grad_Degree'] = &$this->Grad_Degree;

        // Grad_Major
        $this->Grad_Major = new DbField('graduation', 'graduation', 'x_Grad_Major', 'Grad_Major', '`Grad_Major`', '`Grad_Major`', 201, 256, -1, false, '`Grad_Major`', false, false, false, 'FORMATTED TEXT', 'TEXTAREA');
        $this->Grad_Major->Nullable = false; // NOT NULL field
        $this->Grad_Major->Required = true; // Required field
        $this->Grad_Major->Sortable = true; // Allow sort
        $this->Fields['Grad_Major'] = &$this->Grad_Major;

        // Grad_ShortDegree
        $this->Grad_ShortDegree = new DbField('graduation', 'graduation', 'x_Grad_ShortDegree', 'Grad_ShortDegree', '`Grad_ShortDegree`', '`Grad_ShortDegree`', 201, 256, -1, false, '`Grad_ShortDegree`', false, false, false, 'FORMATTED TEXT', 'TEXTAREA');
        $this->Grad_ShortDegree->Nullable = false; // NOT NULL field
        $this->Grad_ShortDegree->Required = true; // Required field
        $this->Grad_ShortDegree->Sortable = true; // Allow sort
        $this->Fields['Grad_ShortDegree'] = &$this->Grad_ShortDegree;

        // Grad_Institution
        $this->Grad_Institution = new DbField('graduation', 'graduation', 'x_Grad_Institution', 'Grad_Institution', '`Grad_Institution`', '`Grad_Institution`', 200, 200, -1, false, '`Grad_Institution`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Grad_Institution->Nullable = false; // NOT NULL field
        $this->Grad_Institution->Required = true; // Required field
        $this->Grad_Institution->Sortable = true; // Allow sort
        $this->Fields['Grad_Institution'] = &$this->Grad_Institution;

        // Grad_Provinces
        $this->Grad_Provinces = new DbField('graduation', 'graduation', 'x_Grad_Provinces', 'Grad_Provinces', '`Grad_Provinces`', '`Grad_Provinces`', 200, 100, -1, false, '`Grad_Provinces`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Grad_Provinces->Nullable = false; // NOT NULL field
        $this->Grad_Provinces->Required = true; // Required field
        $this->Grad_Provinces->Sortable = true; // Allow sort
        $this->Fields['Grad_Provinces'] = &$this->Grad_Provinces;

        // Grad_Country
        $this->Grad_Country = new DbField('graduation', 'graduation', 'x_Grad_Country', 'Grad_Country', '`Grad_Country`', '`Grad_Country`', 200, 100, -1, false, '`Grad_Country`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Grad_Country->Nullable = false; // NOT NULL field
        $this->Grad_Country->Required = true; // Required field
        $this->Grad_Country->Sortable = true; // Allow sort
        $this->Fields['Grad_Country'] = &$this->Grad_Country;

        // Grad_Start
        $this->Grad_Start = new DbField('graduation', 'graduation', 'x_Grad_Start', 'Grad_Start', '`Grad_Start`', CastDateFieldForLike("`Grad_Start`", 0, "DB"), 133, 10, 0, false, '`Grad_Start`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Grad_Start->Nullable = false; // NOT NULL field
        $this->Grad_Start->Required = true; // Required field
        $this->Grad_Start->Sortable = true; // Allow sort
        $this->Grad_Start->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->Fields['Grad_Start'] = &$this->Grad_Start;

        // Grad_End
        $this->Grad_End = new DbField('graduation', 'graduation', 'x_Grad_End', 'Grad_End', '`Grad_End`', CastDateFieldForLike("`Grad_End`", 0, "DB"), 133, 10, 0, false, '`Grad_End`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Grad_End->Nullable = false; // NOT NULL field
        $this->Grad_End->Required = true; // Required field
        $this->Grad_End->Sortable = true; // Allow sort
        $this->Grad_End->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->Fields['Grad_End'] = &$this->Grad_End;

        // Grad_GPA
        $this->Grad_GPA = new DbField('graduation', 'graduation', 'x_Grad_GPA', 'Grad_GPA', '`Grad_GPA`', '`Grad_GPA`', 200, 4, -1, false, '`Grad_GPA`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Grad_GPA->Nullable = false; // NOT NULL field
        $this->Grad_GPA->Required = true; // Required field
        $this->Grad_GPA->Sortable = true; // Allow sort
        $this->Fields['Grad_GPA'] = &$this->Grad_GPA;

        // Grad_Honor
        $this->Grad_Honor = new DbField('graduation', 'graduation', 'x_Grad_Honor', 'Grad_Honor', '`Grad_Honor`', '`Grad_Honor`', 200, 100, -1, false, '`Grad_Honor`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Grad_Honor->Nullable = false; // NOT NULL field
        $this->Grad_Honor->Required = true; // Required field
        $this->Grad_Honor->Sortable = true; // Allow sort
        $this->Fields['Grad_Honor'] = &$this->Grad_Honor;

        // Grad_Admission
        $this->Grad_Admission = new DbField('graduation', 'graduation', 'x_Grad_Admission', 'Grad_Admission', '`Grad_Admission`', '`Grad_Admission`', 3, 2, -1, false, '`Grad_Admission`', false, false, false, 'FORMATTED TEXT', 'SELECT');
        $this->Grad_Admission->Nullable = false; // NOT NULL field
        $this->Grad_Admission->Required = true; // Required field
        $this->Grad_Admission->Sortable = true; // Allow sort
        $this->Grad_Admission->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->Grad_Admission->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        $this->Grad_Admission->Lookup = new Lookup('Grad_Admission', 'grad_admission', false, 'Grad_Admission_id', ["Grad_Admission_name","","",""], [], [], [], [], [], [], '', '');
        $this->Grad_Admission->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['Grad_Admission'] = &$this->Grad_Admission;
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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "`graduation`";
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
            $this->Grad_Id->setDbValue($conn->lastInsertId());
            $rs['Grad_Id'] = $this->Grad_Id->DbValue;
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
            if (array_key_exists('Grad_Id', $rs)) {
                AddFilter($where, QuotedName('Grad_Id', $this->Dbid) . '=' . QuotedValue($rs['Grad_Id'], $this->Grad_Id->DataType, $this->Dbid));
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
        $this->Grad_Id->DbValue = $row['Grad_Id'];
        $this->Per_Id->DbValue = $row['Per_Id'];
        $this->Grad_Degree->DbValue = $row['Grad_Degree'];
        $this->Grad_Major->DbValue = $row['Grad_Major'];
        $this->Grad_ShortDegree->DbValue = $row['Grad_ShortDegree'];
        $this->Grad_Institution->DbValue = $row['Grad_Institution'];
        $this->Grad_Provinces->DbValue = $row['Grad_Provinces'];
        $this->Grad_Country->DbValue = $row['Grad_Country'];
        $this->Grad_Start->DbValue = $row['Grad_Start'];
        $this->Grad_End->DbValue = $row['Grad_End'];
        $this->Grad_GPA->DbValue = $row['Grad_GPA'];
        $this->Grad_Honor->DbValue = $row['Grad_Honor'];
        $this->Grad_Admission->DbValue = $row['Grad_Admission'];
    }

    // Delete uploaded files
    public function deleteUploadedFiles($row)
    {
        $this->loadDbValues($row);
    }

    // Record filter WHERE clause
    protected function sqlKeyFilter()
    {
        return "`Grad_Id` = @Grad_Id@";
    }

    // Get Key
    public function getKey($current = false)
    {
        $keys = [];
        $val = $current ? $this->Grad_Id->CurrentValue : $this->Grad_Id->OldValue;
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
                $this->Grad_Id->CurrentValue = $keys[0];
            } else {
                $this->Grad_Id->OldValue = $keys[0];
            }
        }
    }

    // Get record filter
    public function getRecordFilter($row = null)
    {
        $keyFilter = $this->sqlKeyFilter();
        if (is_array($row)) {
            $val = array_key_exists('Grad_Id', $row) ? $row['Grad_Id'] : null;
        } else {
            $val = $this->Grad_Id->OldValue !== null ? $this->Grad_Id->OldValue : $this->Grad_Id->CurrentValue;
        }
        if (!is_numeric($val)) {
            return "0=1"; // Invalid key
        }
        if ($val === null) {
            return "0=1"; // Invalid key
        } else {
            $keyFilter = str_replace("@Grad_Id@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
            return GetUrl("GraduationList");
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
        if ($pageName == "GraduationView") {
            return $Language->phrase("View");
        } elseif ($pageName == "GraduationEdit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "GraduationAdd") {
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
                return "GraduationView";
            case Config("API_ADD_ACTION"):
                return "GraduationAdd";
            case Config("API_EDIT_ACTION"):
                return "GraduationEdit";
            case Config("API_DELETE_ACTION"):
                return "GraduationDelete";
            case Config("API_LIST_ACTION"):
                return "GraduationList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "GraduationList";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("GraduationView", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("GraduationView", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "GraduationAdd?" . $this->getUrlParm($parm);
        } else {
            $url = "GraduationAdd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("GraduationEdit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("GraduationAdd", $this->getUrlParm($parm));
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
        return $this->keyUrl("GraduationDelete", $this->getUrlParm());
    }

    // Add master url
    public function addMasterUrl($url)
    {
        return $url;
    }

    public function keyToJson($htmlEncode = false)
    {
        $json = "";
        $json .= "Grad_Id:" . JsonEncode($this->Grad_Id->CurrentValue, "number");
        $json = "{" . $json . "}";
        if ($htmlEncode) {
            $json = HtmlEncode($json);
        }
        return $json;
    }

    // Add key value to URL
    public function keyUrl($url, $parm = "")
    {
        if ($this->Grad_Id->CurrentValue !== null) {
            $url .= "/" . rawurlencode($this->Grad_Id->CurrentValue);
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
            if (($keyValue = Param("Grad_Id") ?? Route("Grad_Id")) !== null) {
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
                $this->Grad_Id->CurrentValue = $key;
            } else {
                $this->Grad_Id->OldValue = $key;
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
        $this->Grad_Id->setDbValue($row['Grad_Id']);
        $this->Per_Id->setDbValue($row['Per_Id']);
        $this->Grad_Degree->setDbValue($row['Grad_Degree']);
        $this->Grad_Major->setDbValue($row['Grad_Major']);
        $this->Grad_ShortDegree->setDbValue($row['Grad_ShortDegree']);
        $this->Grad_Institution->setDbValue($row['Grad_Institution']);
        $this->Grad_Provinces->setDbValue($row['Grad_Provinces']);
        $this->Grad_Country->setDbValue($row['Grad_Country']);
        $this->Grad_Start->setDbValue($row['Grad_Start']);
        $this->Grad_End->setDbValue($row['Grad_End']);
        $this->Grad_GPA->setDbValue($row['Grad_GPA']);
        $this->Grad_Honor->setDbValue($row['Grad_Honor']);
        $this->Grad_Admission->setDbValue($row['Grad_Admission']);
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // Grad_Id

        // Per_Id

        // Grad_Degree

        // Grad_Major

        // Grad_ShortDegree

        // Grad_Institution

        // Grad_Provinces

        // Grad_Country

        // Grad_Start

        // Grad_End

        // Grad_GPA

        // Grad_Honor

        // Grad_Admission

        // Grad_Id
        $this->Grad_Id->ViewValue = $this->Grad_Id->CurrentValue;
        $this->Grad_Id->ViewCustomAttributes = "";

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

        // Grad_Degree
        $this->Grad_Degree->ViewValue = $this->Grad_Degree->CurrentValue;
        $this->Grad_Degree->ViewCustomAttributes = "";

        // Grad_Major
        $this->Grad_Major->ViewValue = $this->Grad_Major->CurrentValue;
        $this->Grad_Major->ViewCustomAttributes = "";

        // Grad_ShortDegree
        $this->Grad_ShortDegree->ViewValue = $this->Grad_ShortDegree->CurrentValue;
        $this->Grad_ShortDegree->ViewCustomAttributes = "";

        // Grad_Institution
        $this->Grad_Institution->ViewValue = $this->Grad_Institution->CurrentValue;
        $this->Grad_Institution->ViewCustomAttributes = "";

        // Grad_Provinces
        $this->Grad_Provinces->ViewValue = $this->Grad_Provinces->CurrentValue;
        $this->Grad_Provinces->ViewCustomAttributes = "";

        // Grad_Country
        $this->Grad_Country->ViewValue = $this->Grad_Country->CurrentValue;
        $this->Grad_Country->ViewCustomAttributes = "";

        // Grad_Start
        $this->Grad_Start->ViewValue = $this->Grad_Start->CurrentValue;
        $this->Grad_Start->ViewValue = FormatDateTime($this->Grad_Start->ViewValue, 0);
        $this->Grad_Start->ViewCustomAttributes = "";

        // Grad_End
        $this->Grad_End->ViewValue = $this->Grad_End->CurrentValue;
        $this->Grad_End->ViewValue = FormatDateTime($this->Grad_End->ViewValue, 0);
        $this->Grad_End->ViewCustomAttributes = "";

        // Grad_GPA
        $this->Grad_GPA->ViewValue = $this->Grad_GPA->CurrentValue;
        $this->Grad_GPA->ViewCustomAttributes = "";

        // Grad_Honor
        $this->Grad_Honor->ViewValue = $this->Grad_Honor->CurrentValue;
        $this->Grad_Honor->ViewCustomAttributes = "";

        // Grad_Admission
        $curVal = strval($this->Grad_Admission->CurrentValue);
        if ($curVal != "") {
            $this->Grad_Admission->ViewValue = $this->Grad_Admission->lookupCacheOption($curVal);
            if ($this->Grad_Admission->ViewValue === null) { // Lookup from database
                $filterWrk = "`Grad_Admission_id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                $sqlWrk = $this->Grad_Admission->Lookup->getSql(false, $filterWrk, '', $this, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->Grad_Admission->Lookup->renderViewRow($rswrk[0]);
                    $this->Grad_Admission->ViewValue = $this->Grad_Admission->displayValue($arwrk);
                } else {
                    $this->Grad_Admission->ViewValue = $this->Grad_Admission->CurrentValue;
                }
            }
        } else {
            $this->Grad_Admission->ViewValue = null;
        }
        $this->Grad_Admission->ViewCustomAttributes = "";

        // Grad_Id
        $this->Grad_Id->LinkCustomAttributes = "";
        $this->Grad_Id->HrefValue = "";
        $this->Grad_Id->TooltipValue = "";

        // Per_Id
        $this->Per_Id->LinkCustomAttributes = "";
        $this->Per_Id->HrefValue = "";
        $this->Per_Id->TooltipValue = "";

        // Grad_Degree
        $this->Grad_Degree->LinkCustomAttributes = "";
        $this->Grad_Degree->HrefValue = "";
        $this->Grad_Degree->TooltipValue = "";

        // Grad_Major
        $this->Grad_Major->LinkCustomAttributes = "";
        $this->Grad_Major->HrefValue = "";
        $this->Grad_Major->TooltipValue = "";

        // Grad_ShortDegree
        $this->Grad_ShortDegree->LinkCustomAttributes = "";
        $this->Grad_ShortDegree->HrefValue = "";
        $this->Grad_ShortDegree->TooltipValue = "";

        // Grad_Institution
        $this->Grad_Institution->LinkCustomAttributes = "";
        $this->Grad_Institution->HrefValue = "";
        $this->Grad_Institution->TooltipValue = "";

        // Grad_Provinces
        $this->Grad_Provinces->LinkCustomAttributes = "";
        $this->Grad_Provinces->HrefValue = "";
        $this->Grad_Provinces->TooltipValue = "";

        // Grad_Country
        $this->Grad_Country->LinkCustomAttributes = "";
        $this->Grad_Country->HrefValue = "";
        $this->Grad_Country->TooltipValue = "";

        // Grad_Start
        $this->Grad_Start->LinkCustomAttributes = "";
        $this->Grad_Start->HrefValue = "";
        $this->Grad_Start->TooltipValue = "";

        // Grad_End
        $this->Grad_End->LinkCustomAttributes = "";
        $this->Grad_End->HrefValue = "";
        $this->Grad_End->TooltipValue = "";

        // Grad_GPA
        $this->Grad_GPA->LinkCustomAttributes = "";
        $this->Grad_GPA->HrefValue = "";
        $this->Grad_GPA->TooltipValue = "";

        // Grad_Honor
        $this->Grad_Honor->LinkCustomAttributes = "";
        $this->Grad_Honor->HrefValue = "";
        $this->Grad_Honor->TooltipValue = "";

        // Grad_Admission
        $this->Grad_Admission->LinkCustomAttributes = "";
        $this->Grad_Admission->HrefValue = "";
        $this->Grad_Admission->TooltipValue = "";

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

        // Grad_Id
        $this->Grad_Id->EditAttrs["class"] = "form-control";
        $this->Grad_Id->EditCustomAttributes = "";
        $this->Grad_Id->EditValue = $this->Grad_Id->CurrentValue;
        $this->Grad_Id->ViewCustomAttributes = "";

        // Per_Id
        $this->Per_Id->EditAttrs["class"] = "form-control";
        $this->Per_Id->EditCustomAttributes = "";
        $this->Per_Id->PlaceHolder = RemoveHtml($this->Per_Id->caption());

        // Grad_Degree
        $this->Grad_Degree->EditAttrs["class"] = "form-control";
        $this->Grad_Degree->EditCustomAttributes = "";
        $this->Grad_Degree->EditValue = $this->Grad_Degree->CurrentValue;
        $this->Grad_Degree->PlaceHolder = RemoveHtml($this->Grad_Degree->caption());

        // Grad_Major
        $this->Grad_Major->EditAttrs["class"] = "form-control";
        $this->Grad_Major->EditCustomAttributes = "";
        $this->Grad_Major->EditValue = $this->Grad_Major->CurrentValue;
        $this->Grad_Major->PlaceHolder = RemoveHtml($this->Grad_Major->caption());

        // Grad_ShortDegree
        $this->Grad_ShortDegree->EditAttrs["class"] = "form-control";
        $this->Grad_ShortDegree->EditCustomAttributes = "";
        $this->Grad_ShortDegree->EditValue = $this->Grad_ShortDegree->CurrentValue;
        $this->Grad_ShortDegree->PlaceHolder = RemoveHtml($this->Grad_ShortDegree->caption());

        // Grad_Institution
        $this->Grad_Institution->EditAttrs["class"] = "form-control";
        $this->Grad_Institution->EditCustomAttributes = "";
        if (!$this->Grad_Institution->Raw) {
            $this->Grad_Institution->CurrentValue = HtmlDecode($this->Grad_Institution->CurrentValue);
        }
        $this->Grad_Institution->EditValue = $this->Grad_Institution->CurrentValue;
        $this->Grad_Institution->PlaceHolder = RemoveHtml($this->Grad_Institution->caption());

        // Grad_Provinces
        $this->Grad_Provinces->EditAttrs["class"] = "form-control";
        $this->Grad_Provinces->EditCustomAttributes = "";
        if (!$this->Grad_Provinces->Raw) {
            $this->Grad_Provinces->CurrentValue = HtmlDecode($this->Grad_Provinces->CurrentValue);
        }
        $this->Grad_Provinces->EditValue = $this->Grad_Provinces->CurrentValue;
        $this->Grad_Provinces->PlaceHolder = RemoveHtml($this->Grad_Provinces->caption());

        // Grad_Country
        $this->Grad_Country->EditAttrs["class"] = "form-control";
        $this->Grad_Country->EditCustomAttributes = "";
        if (!$this->Grad_Country->Raw) {
            $this->Grad_Country->CurrentValue = HtmlDecode($this->Grad_Country->CurrentValue);
        }
        $this->Grad_Country->EditValue = $this->Grad_Country->CurrentValue;
        $this->Grad_Country->PlaceHolder = RemoveHtml($this->Grad_Country->caption());

        // Grad_Start
        $this->Grad_Start->EditAttrs["class"] = "form-control";
        $this->Grad_Start->EditCustomAttributes = "";
        $this->Grad_Start->EditValue = FormatDateTime($this->Grad_Start->CurrentValue, 8);
        $this->Grad_Start->PlaceHolder = RemoveHtml($this->Grad_Start->caption());

        // Grad_End
        $this->Grad_End->EditAttrs["class"] = "form-control";
        $this->Grad_End->EditCustomAttributes = "";
        $this->Grad_End->EditValue = FormatDateTime($this->Grad_End->CurrentValue, 8);
        $this->Grad_End->PlaceHolder = RemoveHtml($this->Grad_End->caption());

        // Grad_GPA
        $this->Grad_GPA->EditAttrs["class"] = "form-control";
        $this->Grad_GPA->EditCustomAttributes = "";
        if (!$this->Grad_GPA->Raw) {
            $this->Grad_GPA->CurrentValue = HtmlDecode($this->Grad_GPA->CurrentValue);
        }
        $this->Grad_GPA->EditValue = $this->Grad_GPA->CurrentValue;
        $this->Grad_GPA->PlaceHolder = RemoveHtml($this->Grad_GPA->caption());

        // Grad_Honor
        $this->Grad_Honor->EditAttrs["class"] = "form-control";
        $this->Grad_Honor->EditCustomAttributes = "";
        if (!$this->Grad_Honor->Raw) {
            $this->Grad_Honor->CurrentValue = HtmlDecode($this->Grad_Honor->CurrentValue);
        }
        $this->Grad_Honor->EditValue = $this->Grad_Honor->CurrentValue;
        $this->Grad_Honor->PlaceHolder = RemoveHtml($this->Grad_Honor->caption());

        // Grad_Admission
        $this->Grad_Admission->EditAttrs["class"] = "form-control";
        $this->Grad_Admission->EditCustomAttributes = "";
        $this->Grad_Admission->PlaceHolder = RemoveHtml($this->Grad_Admission->caption());

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
                    $doc->exportCaption($this->Grad_Id);
                    $doc->exportCaption($this->Per_Id);
                    $doc->exportCaption($this->Grad_Degree);
                    $doc->exportCaption($this->Grad_Major);
                    $doc->exportCaption($this->Grad_ShortDegree);
                    $doc->exportCaption($this->Grad_Institution);
                    $doc->exportCaption($this->Grad_Provinces);
                    $doc->exportCaption($this->Grad_Country);
                    $doc->exportCaption($this->Grad_Start);
                    $doc->exportCaption($this->Grad_End);
                    $doc->exportCaption($this->Grad_GPA);
                    $doc->exportCaption($this->Grad_Honor);
                    $doc->exportCaption($this->Grad_Admission);
                } else {
                    $doc->exportCaption($this->Grad_Id);
                    $doc->exportCaption($this->Per_Id);
                    $doc->exportCaption($this->Grad_Institution);
                    $doc->exportCaption($this->Grad_Provinces);
                    $doc->exportCaption($this->Grad_Country);
                    $doc->exportCaption($this->Grad_Start);
                    $doc->exportCaption($this->Grad_End);
                    $doc->exportCaption($this->Grad_GPA);
                    $doc->exportCaption($this->Grad_Honor);
                    $doc->exportCaption($this->Grad_Admission);
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
                        $doc->exportField($this->Grad_Id);
                        $doc->exportField($this->Per_Id);
                        $doc->exportField($this->Grad_Degree);
                        $doc->exportField($this->Grad_Major);
                        $doc->exportField($this->Grad_ShortDegree);
                        $doc->exportField($this->Grad_Institution);
                        $doc->exportField($this->Grad_Provinces);
                        $doc->exportField($this->Grad_Country);
                        $doc->exportField($this->Grad_Start);
                        $doc->exportField($this->Grad_End);
                        $doc->exportField($this->Grad_GPA);
                        $doc->exportField($this->Grad_Honor);
                        $doc->exportField($this->Grad_Admission);
                    } else {
                        $doc->exportField($this->Grad_Id);
                        $doc->exportField($this->Per_Id);
                        $doc->exportField($this->Grad_Institution);
                        $doc->exportField($this->Grad_Provinces);
                        $doc->exportField($this->Grad_Country);
                        $doc->exportField($this->Grad_Start);
                        $doc->exportField($this->Grad_End);
                        $doc->exportField($this->Grad_GPA);
                        $doc->exportField($this->Grad_Honor);
                        $doc->exportField($this->Grad_Admission);
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
