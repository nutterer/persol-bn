<?php

namespace PHPMaker2021\upPersonnelv2;

use Doctrine\DBAL\ParameterType;

/**
 * Page class
 */
class _01personnelDelete extends _01personnel
{
    use MessagesTrait;

    // Page ID
    public $PageID = "delete";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = '01-personnel';

    // Page object name
    public $PageObjName = "_01personnelDelete";

    // Rendering View
    public $RenderingView = false;

    // Page headings
    public $Heading = "";
    public $Subheading = "";
    public $PageHeader;
    public $PageFooter;

    // Page terminated
    private $terminated = false;

    // Page heading
    public function pageHeading()
    {
        global $Language;
        if ($this->Heading != "") {
            return $this->Heading;
        }
        if (method_exists($this, "tableCaption")) {
            return $this->tableCaption();
        }
        return "";
    }

    // Page subheading
    public function pageSubheading()
    {
        global $Language;
        if ($this->Subheading != "") {
            return $this->Subheading;
        }
        if ($this->TableName) {
            return $Language->phrase($this->PageID);
        }
        return "";
    }

    // Page name
    public function pageName()
    {
        return CurrentPageName();
    }

    // Page URL
    public function pageUrl()
    {
        $url = ScriptName() . "?";
        if ($this->UseTokenInUrl) {
            $url .= "t=" . $this->TableVar . "&"; // Add page token
        }
        return $url;
    }

    // Show Page Header
    public function showPageHeader()
    {
        $header = $this->PageHeader;
        $this->pageDataRendering($header);
        if ($header != "") { // Header exists, display
            echo '<p id="ew-page-header">' . $header . '</p>';
        }
    }

    // Show Page Footer
    public function showPageFooter()
    {
        $footer = $this->PageFooter;
        $this->pageDataRendered($footer);
        if ($footer != "") { // Footer exists, display
            echo '<p id="ew-page-footer">' . $footer . '</p>';
        }
    }

    // Validate page request
    protected function isPageRequest()
    {
        global $CurrentForm;
        if ($this->UseTokenInUrl) {
            if ($CurrentForm) {
                return ($this->TableVar == $CurrentForm->getValue("t"));
            }
            if (Get("t") !== null) {
                return ($this->TableVar == Get("t"));
            }
        }
        return true;
    }

    // Constructor
    public function __construct()
    {
        global $Language, $DashboardReport, $DebugTimer;

        // Initialize
        $GLOBALS["Page"] = &$this;
        $this->TokenTimeout = SessionTimeoutTime();

        // Language object
        $Language = Container("language");

        // Parent constuctor
        parent::__construct();

        // Table object (_01personnel)
        if (!isset($GLOBALS["_01personnel"]) || get_class($GLOBALS["_01personnel"]) == PROJECT_NAMESPACE . "_01personnel") {
            $GLOBALS["_01personnel"] = &$this;
        }

        // Page URL
        $pageUrl = $this->pageUrl();

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", '01-personnel');
        }

        // Start timer
        $DebugTimer = Container("timer");

        // Debug message
        LoadDebugMessage();

        // Open connection
        $GLOBALS["Conn"] = $GLOBALS["Conn"] ?? $this->getConnection();
    }

    // Get content from stream
    public function getContents($stream = null): string
    {
        global $Response;
        return is_object($Response) ? $Response->getBody() : ob_get_clean();
    }

    // Is terminated
    public function isTerminated()
    {
        return $this->terminated;
    }

    /**
     * Terminate page
     *
     * @param string $url URL for direction
     * @return void
     */
    public function terminate($url = "")
    {
        if ($this->terminated) {
            return;
        }
        global $ExportFileName, $TempImages, $DashboardReport;

        // Page is terminated
        $this->terminated = true;

         // Page Unload event
        if (method_exists($this, "pageUnload")) {
            $this->pageUnload();
        }

        // Global Page Unloaded event (in userfn*.php)
        Page_Unloaded();

        // Export
        if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
            $content = $this->getContents();
            if ($ExportFileName == "") {
                $ExportFileName = $this->TableVar;
            }
            $class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
            if (class_exists($class)) {
                $doc = new $class(Container("_01personnel"));
                $doc->Text = @$content;
                if ($this->isExport("email")) {
                    echo $this->exportEmail($doc->Text);
                } else {
                    $doc->export();
                }
                DeleteTempImages(); // Delete temp images
                return;
            }
        }
        if (!IsApi() && method_exists($this, "pageRedirecting")) {
            $this->pageRedirecting($url);
        }

        // Close connection
        CloseConnections();

        // Return for API
        if (IsApi()) {
            $res = $url === true;
            if (!$res) { // Show error
                WriteJson(array_merge(["success" => false], $this->getMessages()));
            }
            return;
        }

        // Go to URL if specified
        if ($url != "") {
            if (!Config("DEBUG") && ob_get_length()) {
                ob_end_clean();
            }
            SaveDebugMessage();
            Redirect(GetUrl($url));
        }
        return; // Return to controller
    }

    // Get records from recordset
    protected function getRecordsFromRecordset($rs, $current = false)
    {
        $rows = [];
        if (is_object($rs)) { // Recordset
            while ($rs && !$rs->EOF) {
                $this->loadRowValues($rs); // Set up DbValue/CurrentValue
                $row = $this->getRecordFromArray($rs->fields);
                if ($current) {
                    return $row;
                } else {
                    $rows[] = $row;
                }
                $rs->moveNext();
            }
        } elseif (is_array($rs)) {
            foreach ($rs as $ar) {
                $row = $this->getRecordFromArray($ar);
                if ($current) {
                    return $row;
                } else {
                    $rows[] = $row;
                }
            }
        }
        return $rows;
    }

    // Get record from array
    protected function getRecordFromArray($ar)
    {
        $row = [];
        if (is_array($ar)) {
            foreach ($ar as $fldname => $val) {
                if (array_key_exists($fldname, $this->Fields) && ($this->Fields[$fldname]->Visible || $this->Fields[$fldname]->IsPrimaryKey)) { // Primary key or Visible
                    $fld = &$this->Fields[$fldname];
                    if ($fld->HtmlTag == "FILE") { // Upload field
                        if (EmptyValue($val)) {
                            $row[$fldname] = null;
                        } else {
                            if ($fld->DataType == DATATYPE_BLOB) {
                                $url = FullUrl(GetApiUrl(Config("API_FILE_ACTION") .
                                    "/" . $fld->TableVar . "/" . $fld->Param . "/" . rawurlencode($this->getRecordKeyValue($ar))));
                                $row[$fldname] = ["type" => ContentType($val), "url" => $url, "name" => $fld->Param . ContentExtension($val)];
                            } elseif (!$fld->UploadMultiple || !ContainsString($val, Config("MULTIPLE_UPLOAD_SEPARATOR"))) { // Single file
                                $url = FullUrl(GetApiUrl(Config("API_FILE_ACTION") .
                                    "/" . $fld->TableVar . "/" . Encrypt($fld->physicalUploadPath() . $val)));
                                $row[$fldname] = ["type" => MimeContentType($val), "url" => $url, "name" => $val];
                            } else { // Multiple files
                                $files = explode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $val);
                                $ar = [];
                                foreach ($files as $file) {
                                    $url = FullUrl(GetApiUrl(Config("API_FILE_ACTION") .
                                        "/" . $fld->TableVar . "/" . Encrypt($fld->physicalUploadPath() . $file)));
                                    if (!EmptyValue($file)) {
                                        $ar[] = ["type" => MimeContentType($file), "url" => $url, "name" => $file];
                                    }
                                }
                                $row[$fldname] = $ar;
                            }
                        }
                    } else {
                        $row[$fldname] = $val;
                    }
                }
            }
        }
        return $row;
    }

    // Get record key value from array
    protected function getRecordKeyValue($ar)
    {
        $key = "";
        if (is_array($ar)) {
            $key .= @$ar['Per_Id'];
        }
        return $key;
    }

    /**
     * Hide fields for add/edit
     *
     * @return void
     */
    protected function hideFieldsForAddEdit()
    {
    }
    public $DbMasterFilter = "";
    public $DbDetailFilter = "";
    public $StartRecord;
    public $TotalRecords = 0;
    public $RecordCount;
    public $RecKeys = [];
    public $StartRowCount = 1;
    public $RowCount = 0;

    /**
     * Page run
     *
     * @return void
     */
    public function run()
    {
        global $ExportType, $CustomExportType, $ExportFileName, $UserProfile, $Language, $Security, $CurrentForm;
        $this->CurrentAction = Param("action"); // Set up current action
        $this->Per_Id->setVisibility();
        $this->Per_ThaiPre->Visible = false;
        $this->Per_ThaiName->setVisibility();
        $this->Per_ThaiLastName->setVisibility();
        $this->Per_EngPre->Visible = false;
        $this->Per_EngName->Visible = false;
        $this->Per_EngLastName->Visible = false;
        $this->Per_Type->Visible = false;
        $this->Per_EmployeeType->Visible = false;
        $this->Per_Position->Visible = false;
        $this->Per_major->setVisibility();
        $this->Per_Academic->Visible = false;
        $this->Per_Administrative->Visible = false;
        $this->Per_WorDateStart->Visible = false;
        $this->Per_WorkDate->Visible = false;
        $this->Per_Born->Visible = false;
        $this->Per_Nationality->Visible = false;
        $this->Per_Religion->Visible = false;
        $this->Per_IdCard->Visible = false;
        $this->Per_WorkStatus->Visible = false;
        $this->Per_Phone->setVisibility();
        $this->Per_UPEmail->setVisibility();
        $this->Per_Email->Visible = false;
        $this->Per_Address->Visible = false;
        $this->hideFieldsForAddEdit();

        // Do not use lookup cache
        $this->setUseLookupCache(false);

        // Global Page Loading event (in userfn*.php)
        Page_Loading();

        // Page Load event
        if (method_exists($this, "pageLoad")) {
            $this->pageLoad();
        }

        // Set up lookup cache
        $this->setupLookupOptions($this->Per_Type);
        $this->setupLookupOptions($this->Per_EmployeeType);
        $this->setupLookupOptions($this->Per_Position);
        $this->setupLookupOptions($this->Per_major);
        $this->setupLookupOptions($this->Per_Academic);
        $this->setupLookupOptions($this->Per_Administrative);
        $this->setupLookupOptions($this->Per_Nationality);
        $this->setupLookupOptions($this->Per_Religion);
        $this->setupLookupOptions($this->Per_WorkStatus);

        // Set up Breadcrumb
        $this->setupBreadcrumb();

        // Load key parameters
        $this->RecKeys = $this->getRecordKeys(); // Load record keys
        $filter = $this->getFilterFromRecordKeys();
        if ($filter == "") {
            $this->terminate("_01personnelList"); // Prevent SQL injection, return to list
            return;
        }

        // Set up filter (WHERE Clause)
        $this->CurrentFilter = $filter;

        // Get action
        if (IsApi()) {
            $this->CurrentAction = "delete"; // Delete record directly
        } elseif (Post("action") !== null) {
            $this->CurrentAction = Post("action");
        } elseif (Get("action") == "1") {
            $this->CurrentAction = "delete"; // Delete record directly
        } else {
            $this->CurrentAction = "show"; // Display record
        }
        if ($this->isDelete()) {
            $this->SendEmail = true; // Send email on delete success
            if ($this->deleteRows()) { // Delete rows
                if ($this->getSuccessMessage() == "") {
                    $this->setSuccessMessage($Language->phrase("DeleteSuccess")); // Set up success message
                }
                if (IsApi()) {
                    $this->terminate(true);
                    return;
                } else {
                    $this->terminate($this->getReturnUrl()); // Return to caller
                    return;
                }
            } else { // Delete failed
                if (IsApi()) {
                    $this->terminate();
                    return;
                }
                $this->CurrentAction = "show"; // Display record
            }
        }
        if ($this->isShow()) { // Load records for display
            if ($this->Recordset = $this->loadRecordset()) {
                $this->TotalRecords = $this->Recordset->recordCount(); // Get record count
            }
            if ($this->TotalRecords <= 0) { // No record found, exit
                if ($this->Recordset) {
                    $this->Recordset->close();
                }
                $this->terminate("_01personnelList"); // Return to list
                return;
            }
        }

        // Set LoginStatus / Page_Rendering / Page_Render
        if (!IsApi() && !$this->isTerminated()) {
            // Pass table and field properties to client side
            $this->toClientVar(["tableCaption"], ["caption", "Required", "IsInvalid", "Raw"]);

            // Setup login status
            SetupLoginStatus();

            // Pass login status to client side
            SetClientVar("login", LoginStatus());

            // Global Page Rendering event (in userfn*.php)
            Page_Rendering();

            // Page Rendering event
            if (method_exists($this, "pageRender")) {
                $this->pageRender();
            }
        }
    }

    // Load recordset
    public function loadRecordset($offset = -1, $rowcnt = -1)
    {
        // Load List page SQL (QueryBuilder)
        $sql = $this->getListSql();

        // Load recordset
        if ($offset > -1) {
            $sql->setFirstResult($offset);
        }
        if ($rowcnt > 0) {
            $sql->setMaxResults($rowcnt);
        }
        $stmt = $sql->execute();
        $rs = new Recordset($stmt, $sql);

        // Call Recordset Selected event
        $this->recordsetSelected($rs);
        return $rs;
    }

    /**
     * Load row based on key values
     *
     * @return void
     */
    public function loadRow()
    {
        global $Security, $Language;
        $filter = $this->getRecordFilter();

        // Call Row Selecting event
        $this->rowSelecting($filter);

        // Load SQL based on filter
        $this->CurrentFilter = $filter;
        $sql = $this->getCurrentSql();
        $conn = $this->getConnection();
        $res = false;
        $row = $conn->fetchAssoc($sql);
        if ($row) {
            $res = true;
            $this->loadRowValues($row); // Load row values
        }
        return $res;
    }

    /**
     * Load row values from recordset or record
     *
     * @param Recordset|array $rs Record
     * @return void
     */
    public function loadRowValues($rs = null)
    {
        if (is_array($rs)) {
            $row = $rs;
        } elseif ($rs && property_exists($rs, "fields")) { // Recordset
            $row = $rs->fields;
        } else {
            $row = $this->newRow();
        }

        // Call Row Selected event
        $this->rowSelected($row);
        if (!$rs) {
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
        $this->Per_major->setDbValue($row['Per_major']);
        $this->Per_Academic->setDbValue($row['Per_Academic']);
        $this->Per_Administrative->setDbValue($row['Per_Administrative']);
        $this->Per_WorDateStart->setDbValue($row['Per_WorDateStart']);
        $this->Per_WorkDate->setDbValue($row['Per_WorkDate']);
        $this->Per_Born->setDbValue($row['Per_Born']);
        $this->Per_Nationality->setDbValue($row['Per_Nationality']);
        $this->Per_Religion->setDbValue($row['Per_Religion']);
        $this->Per_IdCard->setDbValue($row['Per_IdCard']);
        $this->Per_WorkStatus->setDbValue($row['Per_WorkStatus']);
        $this->Per_Phone->setDbValue($row['Per_Phone']);
        $this->Per_UPEmail->setDbValue($row['Per_UPEmail']);
        $this->Per_Email->setDbValue($row['Per_Email']);
        $this->Per_Address->setDbValue($row['Per_Address']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $row = [];
        $row['Per_Id'] = null;
        $row['Per_ThaiPre'] = null;
        $row['Per_ThaiName'] = null;
        $row['Per_ThaiLastName'] = null;
        $row['Per_EngPre'] = null;
        $row['Per_EngName'] = null;
        $row['Per_EngLastName'] = null;
        $row['Per_Type'] = null;
        $row['Per_EmployeeType'] = null;
        $row['Per_Position'] = null;
        $row['Per_major'] = null;
        $row['Per_Academic'] = null;
        $row['Per_Administrative'] = null;
        $row['Per_WorDateStart'] = null;
        $row['Per_WorkDate'] = null;
        $row['Per_Born'] = null;
        $row['Per_Nationality'] = null;
        $row['Per_Religion'] = null;
        $row['Per_IdCard'] = null;
        $row['Per_WorkStatus'] = null;
        $row['Per_Phone'] = null;
        $row['Per_UPEmail'] = null;
        $row['Per_Email'] = null;
        $row['Per_Address'] = null;
        return $row;
    }

    // Render row values based on field settings
    public function renderRow()
    {
        global $Security, $Language, $CurrentLanguage;

        // Initialize URLs

        // Call Row_Rendering event
        $this->rowRendering();

        // Common render codes for all row types

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

        // Per_major

        // Per_Academic

        // Per_Administrative

        // Per_WorDateStart

        // Per_WorkDate

        // Per_Born

        // Per_Nationality

        // Per_Religion

        // Per_IdCard

        // Per_WorkStatus

        // Per_Phone

        // Per_UPEmail

        // Per_Email

        // Per_Address
        if ($this->RowType == ROWTYPE_VIEW) {
            // Per_Id
            $this->Per_Id->ViewValue = $this->Per_Id->CurrentValue;
            $this->Per_Id->ViewValue = FormatNumber($this->Per_Id->ViewValue, 0, -2, -2, -2);
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
            $curVal = strval($this->Per_Type->CurrentValue);
            if ($curVal != "") {
                $this->Per_Type->ViewValue = $this->Per_Type->lookupCacheOption($curVal);
                if ($this->Per_Type->ViewValue === null) { // Lookup from database
                    $filterWrk = "`Per_Type_id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $sqlWrk = $this->Per_Type->Lookup->getSql(false, $filterWrk, '', $this, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->Per_Type->Lookup->renderViewRow($rswrk[0]);
                        $this->Per_Type->ViewValue = $this->Per_Type->displayValue($arwrk);
                    } else {
                        $this->Per_Type->ViewValue = $this->Per_Type->CurrentValue;
                    }
                }
            } else {
                $this->Per_Type->ViewValue = null;
            }
            $this->Per_Type->ViewCustomAttributes = "";

            // Per_EmployeeType
            $curVal = strval($this->Per_EmployeeType->CurrentValue);
            if ($curVal != "") {
                $this->Per_EmployeeType->ViewValue = $this->Per_EmployeeType->lookupCacheOption($curVal);
                if ($this->Per_EmployeeType->ViewValue === null) { // Lookup from database
                    $filterWrk = "`Per_EmployeeType_id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $sqlWrk = $this->Per_EmployeeType->Lookup->getSql(false, $filterWrk, '', $this, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->Per_EmployeeType->Lookup->renderViewRow($rswrk[0]);
                        $this->Per_EmployeeType->ViewValue = $this->Per_EmployeeType->displayValue($arwrk);
                    } else {
                        $this->Per_EmployeeType->ViewValue = $this->Per_EmployeeType->CurrentValue;
                    }
                }
            } else {
                $this->Per_EmployeeType->ViewValue = null;
            }
            $this->Per_EmployeeType->ViewCustomAttributes = "";

            // Per_Position
            $curVal = strval($this->Per_Position->CurrentValue);
            if ($curVal != "") {
                $this->Per_Position->ViewValue = $this->Per_Position->lookupCacheOption($curVal);
                if ($this->Per_Position->ViewValue === null) { // Lookup from database
                    $filterWrk = "`Per_Position_id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $sqlWrk = $this->Per_Position->Lookup->getSql(false, $filterWrk, '', $this, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->Per_Position->Lookup->renderViewRow($rswrk[0]);
                        $this->Per_Position->ViewValue = $this->Per_Position->displayValue($arwrk);
                    } else {
                        $this->Per_Position->ViewValue = $this->Per_Position->CurrentValue;
                    }
                }
            } else {
                $this->Per_Position->ViewValue = null;
            }
            $this->Per_Position->ViewCustomAttributes = "";

            // Per_major
            $curVal = strval($this->Per_major->CurrentValue);
            if ($curVal != "") {
                $this->Per_major->ViewValue = $this->Per_major->lookupCacheOption($curVal);
                if ($this->Per_major->ViewValue === null) { // Lookup from database
                    $filterWrk = "`Per_major_id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $sqlWrk = $this->Per_major->Lookup->getSql(false, $filterWrk, '', $this, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->Per_major->Lookup->renderViewRow($rswrk[0]);
                        $this->Per_major->ViewValue = $this->Per_major->displayValue($arwrk);
                    } else {
                        $this->Per_major->ViewValue = $this->Per_major->CurrentValue;
                    }
                }
            } else {
                $this->Per_major->ViewValue = null;
            }
            $this->Per_major->ViewCustomAttributes = "";

            // Per_Academic
            $curVal = strval($this->Per_Academic->CurrentValue);
            if ($curVal != "") {
                $this->Per_Academic->ViewValue = $this->Per_Academic->lookupCacheOption($curVal);
                if ($this->Per_Academic->ViewValue === null) { // Lookup from database
                    $filterWrk = "`Per_Academic_id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $sqlWrk = $this->Per_Academic->Lookup->getSql(false, $filterWrk, '', $this, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->Per_Academic->Lookup->renderViewRow($rswrk[0]);
                        $this->Per_Academic->ViewValue = $this->Per_Academic->displayValue($arwrk);
                    } else {
                        $this->Per_Academic->ViewValue = $this->Per_Academic->CurrentValue;
                    }
                }
            } else {
                $this->Per_Academic->ViewValue = null;
            }
            $this->Per_Academic->ViewCustomAttributes = "";

            // Per_Administrative
            $curVal = strval($this->Per_Administrative->CurrentValue);
            if ($curVal != "") {
                $this->Per_Administrative->ViewValue = $this->Per_Administrative->lookupCacheOption($curVal);
                if ($this->Per_Administrative->ViewValue === null) { // Lookup from database
                    $filterWrk = "`Per_Administrative_id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $sqlWrk = $this->Per_Administrative->Lookup->getSql(false, $filterWrk, '', $this, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->Per_Administrative->Lookup->renderViewRow($rswrk[0]);
                        $this->Per_Administrative->ViewValue = $this->Per_Administrative->displayValue($arwrk);
                    } else {
                        $this->Per_Administrative->ViewValue = $this->Per_Administrative->CurrentValue;
                    }
                }
            } else {
                $this->Per_Administrative->ViewValue = null;
            }
            $this->Per_Administrative->ViewCustomAttributes = "";

            // Per_WorDateStart
            $this->Per_WorDateStart->ViewValue = $this->Per_WorDateStart->CurrentValue;
            $this->Per_WorDateStart->ViewValue = FormatDateTime($this->Per_WorDateStart->ViewValue, 0);
            $this->Per_WorDateStart->ViewCustomAttributes = "";

            // Per_WorkDate
            $this->Per_WorkDate->ViewValue = $this->Per_WorkDate->CurrentValue;
            $this->Per_WorkDate->ViewValue = FormatDateTime($this->Per_WorkDate->ViewValue, 0);
            $this->Per_WorkDate->ViewCustomAttributes = "";

            // Per_Born
            $this->Per_Born->ViewValue = $this->Per_Born->CurrentValue;
            $this->Per_Born->ViewValue = FormatDateTime($this->Per_Born->ViewValue, 0);
            $this->Per_Born->ViewCustomAttributes = "";

            // Per_Nationality
            $curVal = strval($this->Per_Nationality->CurrentValue);
            if ($curVal != "") {
                $this->Per_Nationality->ViewValue = $this->Per_Nationality->lookupCacheOption($curVal);
                if ($this->Per_Nationality->ViewValue === null) { // Lookup from database
                    $filterWrk = "`Per_Nationality_id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $sqlWrk = $this->Per_Nationality->Lookup->getSql(false, $filterWrk, '', $this, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->Per_Nationality->Lookup->renderViewRow($rswrk[0]);
                        $this->Per_Nationality->ViewValue = $this->Per_Nationality->displayValue($arwrk);
                    } else {
                        $this->Per_Nationality->ViewValue = $this->Per_Nationality->CurrentValue;
                    }
                }
            } else {
                $this->Per_Nationality->ViewValue = null;
            }
            $this->Per_Nationality->ViewCustomAttributes = "";

            // Per_Religion
            $curVal = strval($this->Per_Religion->CurrentValue);
            if ($curVal != "") {
                $this->Per_Religion->ViewValue = $this->Per_Religion->lookupCacheOption($curVal);
                if ($this->Per_Religion->ViewValue === null) { // Lookup from database
                    $filterWrk = "`Per_Religion_id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $sqlWrk = $this->Per_Religion->Lookup->getSql(false, $filterWrk, '', $this, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->Per_Religion->Lookup->renderViewRow($rswrk[0]);
                        $this->Per_Religion->ViewValue = $this->Per_Religion->displayValue($arwrk);
                    } else {
                        $this->Per_Religion->ViewValue = $this->Per_Religion->CurrentValue;
                    }
                }
            } else {
                $this->Per_Religion->ViewValue = null;
            }
            $this->Per_Religion->ViewCustomAttributes = "";

            // Per_IdCard
            $this->Per_IdCard->ViewValue = $this->Per_IdCard->CurrentValue;
            $this->Per_IdCard->ViewCustomAttributes = "";

            // Per_WorkStatus
            $curVal = strval($this->Per_WorkStatus->CurrentValue);
            if ($curVal != "") {
                $this->Per_WorkStatus->ViewValue = $this->Per_WorkStatus->lookupCacheOption($curVal);
                if ($this->Per_WorkStatus->ViewValue === null) { // Lookup from database
                    $filterWrk = "`Per_WorkStatus_id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $sqlWrk = $this->Per_WorkStatus->Lookup->getSql(false, $filterWrk, '', $this, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->Per_WorkStatus->Lookup->renderViewRow($rswrk[0]);
                        $this->Per_WorkStatus->ViewValue = $this->Per_WorkStatus->displayValue($arwrk);
                    } else {
                        $this->Per_WorkStatus->ViewValue = $this->Per_WorkStatus->CurrentValue;
                    }
                }
            } else {
                $this->Per_WorkStatus->ViewValue = null;
            }
            $this->Per_WorkStatus->ViewCustomAttributes = "";

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

            // Per_ThaiName
            $this->Per_ThaiName->LinkCustomAttributes = "";
            $this->Per_ThaiName->HrefValue = "";
            $this->Per_ThaiName->TooltipValue = "";

            // Per_ThaiLastName
            $this->Per_ThaiLastName->LinkCustomAttributes = "";
            $this->Per_ThaiLastName->HrefValue = "";
            $this->Per_ThaiLastName->TooltipValue = "";

            // Per_major
            $this->Per_major->LinkCustomAttributes = "";
            $this->Per_major->HrefValue = "";
            $this->Per_major->TooltipValue = "";

            // Per_Phone
            $this->Per_Phone->LinkCustomAttributes = "";
            $this->Per_Phone->HrefValue = "";
            $this->Per_Phone->TooltipValue = "";

            // Per_UPEmail
            $this->Per_UPEmail->LinkCustomAttributes = "";
            $this->Per_UPEmail->HrefValue = "";
            $this->Per_UPEmail->TooltipValue = "";
        }

        // Call Row Rendered event
        if ($this->RowType != ROWTYPE_AGGREGATEINIT) {
            $this->rowRendered();
        }
    }

    // Delete records based on current filter
    protected function deleteRows()
    {
        global $Language, $Security;
        $deleteRows = true;
        $sql = $this->getCurrentSql();
        $conn = $this->getConnection();
        $rows = $conn->fetchAll($sql);
        if (count($rows) == 0) {
            $this->setFailureMessage($Language->phrase("NoRecord")); // No record found
            return false;
        }
        $conn->beginTransaction();

        // Clone old rows
        $rsold = $rows;

        // Call row deleting event
        if ($deleteRows) {
            foreach ($rsold as $row) {
                $deleteRows = $this->rowDeleting($row);
                if (!$deleteRows) {
                    break;
                }
            }
        }
        if ($deleteRows) {
            $key = "";
            foreach ($rsold as $row) {
                $thisKey = "";
                if ($thisKey != "") {
                    $thisKey .= Config("COMPOSITE_KEY_SEPARATOR");
                }
                $thisKey .= $row['Per_Id'];
                if (Config("DELETE_UPLOADED_FILES")) { // Delete old files
                    $this->deleteUploadedFiles($row);
                }
                $deleteRows = $this->delete($row); // Delete
                if ($deleteRows === false) {
                    break;
                }
                if ($key != "") {
                    $key .= ", ";
                }
                $key .= $thisKey;
            }
        }
        if (!$deleteRows) {
            // Set up error message
            if ($this->getSuccessMessage() != "" || $this->getFailureMessage() != "") {
                // Use the message, do nothing
            } elseif ($this->CancelMessage != "") {
                $this->setFailureMessage($this->CancelMessage);
                $this->CancelMessage = "";
            } else {
                $this->setFailureMessage($Language->phrase("DeleteCancelled"));
            }
        }
        if ($deleteRows) {
            $conn->commit(); // Commit the changes
        } else {
            $conn->rollback(); // Rollback changes
        }

        // Call Row Deleted event
        if ($deleteRows) {
            foreach ($rsold as $row) {
                $this->rowDeleted($row);
            }
        }

        // Write JSON for API request
        if (IsApi() && $deleteRows) {
            $row = $this->getRecordsFromRecordset($rsold);
            WriteJson(["success" => true, $this->TableVar => $row]);
        }
        return $deleteRows;
    }

    // Set up Breadcrumb
    protected function setupBreadcrumb()
    {
        global $Breadcrumb, $Language;
        $Breadcrumb = new Breadcrumb("index");
        $url = CurrentUrl();
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("_01personnelList"), "", $this->TableVar, true);
        $pageId = "delete";
        $Breadcrumb->add("delete", $pageId, $url);
    }

    // Setup lookup options
    public function setupLookupOptions($fld)
    {
        if ($fld->Lookup !== null && $fld->Lookup->Options === null) {
            // Get default connection and filter
            $conn = $this->getConnection();
            $lookupFilter = "";

            // No need to check any more
            $fld->Lookup->Options = [];

            // Set up lookup SQL and connection
            switch ($fld->FieldVar) {
                case "x_Per_Type":
                    break;
                case "x_Per_EmployeeType":
                    break;
                case "x_Per_Position":
                    break;
                case "x_Per_major":
                    break;
                case "x_Per_Academic":
                    break;
                case "x_Per_Administrative":
                    break;
                case "x_Per_Nationality":
                    break;
                case "x_Per_Religion":
                    break;
                case "x_Per_WorkStatus":
                    break;
                default:
                    $lookupFilter = "";
                    break;
            }

            // Always call to Lookup->getSql so that user can setup Lookup->Options in Lookup_Selecting server event
            $sql = $fld->Lookup->getSql(false, "", $lookupFilter, $this);

            // Set up lookup cache
            if ($fld->UseLookupCache && $sql != "" && count($fld->Lookup->Options) == 0) {
                $totalCnt = $this->getRecordCount($sql, $conn);
                if ($totalCnt > $fld->LookupCacheCount) { // Total count > cache count, do not cache
                    return;
                }
                $rows = $conn->executeQuery($sql)->fetchAll(\PDO::FETCH_BOTH);
                $ar = [];
                foreach ($rows as $row) {
                    $row = $fld->Lookup->renderViewRow($row);
                    $ar[strval($row[0])] = $row;
                }
                $fld->Lookup->Options = $ar;
            }
        }
    }

    // Page Load event
    public function pageLoad()
    {
        //Log("Page Load");
    }

    // Page Unload event
    public function pageUnload()
    {
        //Log("Page Unload");
    }

    // Page Redirecting event
    public function pageRedirecting(&$url)
    {
        // Example:
        //$url = "your URL";
    }

    // Message Showing event
    // $type = ''|'success'|'failure'|'warning'
    public function messageShowing(&$msg, $type)
    {
        if ($type == 'success') {
            //$msg = "your success message";
        } elseif ($type == 'failure') {
            //$msg = "your failure message";
        } elseif ($type == 'warning') {
            //$msg = "your warning message";
        } else {
            //$msg = "your message";
        }
    }

    // Page Render event
    public function pageRender()
    {
        //Log("Page Render");
    }

    // Page Data Rendering event
    public function pageDataRendering(&$header)
    {
        // Example:
        //$header = "your header";
    }

    // Page Data Rendered event
    public function pageDataRendered(&$footer)
    {
        // Example:
        //$footer = "your footer";
    }
}
