<?php

namespace PHPMaker2021\upPersonnelv2;

use Doctrine\DBAL\ParameterType;

/**
 * Page class
 */
class _02selfdevelopmentEdit extends _02selfdevelopment
{
    use MessagesTrait;

    // Page ID
    public $PageID = "edit";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = '02-selfdevelopment';

    // Page object name
    public $PageObjName = "_02selfdevelopmentEdit";

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

        // Table object (_02selfdevelopment)
        if (!isset($GLOBALS["_02selfdevelopment"]) || get_class($GLOBALS["_02selfdevelopment"]) == PROJECT_NAMESPACE . "_02selfdevelopment") {
            $GLOBALS["_02selfdevelopment"] = &$this;
        }

        // Page URL
        $pageUrl = $this->pageUrl();

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", '02-selfdevelopment');
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
                $doc = new $class(Container("_02selfdevelopment"));
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

            // Handle modal response
            if ($this->IsModal) { // Show as modal
                $row = ["url" => GetUrl($url), "modal" => "1"];
                $pageName = GetPageName($url);
                if ($pageName != $this->getListUrl()) { // Not List page
                    $row["caption"] = $this->getModalCaption($pageName);
                    if ($pageName == "_02selfdevelopmentView") {
                        $row["view"] = "1";
                    }
                } else { // List page should not be shown as modal => error
                    $row["error"] = $this->getFailureMessage();
                    $this->clearFailureMessage();
                }
                WriteJson($row);
            } else {
                SaveDebugMessage();
                Redirect(GetUrl($url));
            }
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
            $key .= @$ar['SelfDev_Id'];
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
        if ($this->isAdd() || $this->isCopy() || $this->isGridAdd()) {
            $this->SelfDev_Id->Visible = false;
        }
    }

    // Lookup data
    public function lookup()
    {
        global $Language, $Security;

        // Get lookup object
        $fieldName = Post("field");
        $lookup = $this->Fields[$fieldName]->Lookup;

        // Get lookup parameters
        $lookupType = Post("ajax", "unknown");
        $pageSize = -1;
        $offset = -1;
        $searchValue = "";
        if (SameText($lookupType, "modal")) {
            $searchValue = Post("sv", "");
            $pageSize = Post("recperpage", 10);
            $offset = Post("start", 0);
        } elseif (SameText($lookupType, "autosuggest")) {
            $searchValue = Param("q", "");
            $pageSize = Param("n", -1);
            $pageSize = is_numeric($pageSize) ? (int)$pageSize : -1;
            if ($pageSize <= 0) {
                $pageSize = Config("AUTO_SUGGEST_MAX_ENTRIES");
            }
            $start = Param("start", -1);
            $start = is_numeric($start) ? (int)$start : -1;
            $page = Param("page", -1);
            $page = is_numeric($page) ? (int)$page : -1;
            $offset = $start >= 0 ? $start : ($page > 0 && $pageSize > 0 ? ($page - 1) * $pageSize : 0);
        }
        $userSelect = Decrypt(Post("s", ""));
        $userFilter = Decrypt(Post("f", ""));
        $userOrderBy = Decrypt(Post("o", ""));
        $keys = Post("keys");
        $lookup->LookupType = $lookupType; // Lookup type
        if ($keys !== null) { // Selected records from modal
            if (is_array($keys)) {
                $keys = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $keys);
            }
            $lookup->FilterFields = []; // Skip parent fields if any
            $lookup->FilterValues[] = $keys; // Lookup values
            $pageSize = -1; // Show all records
        } else { // Lookup values
            $lookup->FilterValues[] = Post("v0", Post("lookupValue", ""));
        }
        $cnt = is_array($lookup->FilterFields) ? count($lookup->FilterFields) : 0;
        for ($i = 1; $i <= $cnt; $i++) {
            $lookup->FilterValues[] = Post("v" . $i, "");
        }
        $lookup->SearchValue = $searchValue;
        $lookup->PageSize = $pageSize;
        $lookup->Offset = $offset;
        if ($userSelect != "") {
            $lookup->UserSelect = $userSelect;
        }
        if ($userFilter != "") {
            $lookup->UserFilter = $userFilter;
        }
        if ($userOrderBy != "") {
            $lookup->UserOrderBy = $userOrderBy;
        }
        $lookup->toJson($this); // Use settings from current page
    }
    public $FormClassName = "ew-horizontal ew-form ew-edit-form";
    public $IsModal = false;
    public $IsMobileOrModal = false;
    public $DbMasterFilter;
    public $DbDetailFilter;

    /**
     * Page run
     *
     * @return void
     */
    public function run()
    {
        global $ExportType, $CustomExportType, $ExportFileName, $UserProfile, $Language, $Security, $CurrentForm,
            $SkipHeaderFooter;

        // Is modal
        $this->IsModal = Param("modal") == "1";

        // Create form object
        $CurrentForm = new HttpForm();
        $this->CurrentAction = Param("action"); // Set up current action
        $this->SelfDev_Id->setVisibility();
        $this->Per_Id->setVisibility();
        $this->SelfDev_Type->setVisibility();
        $this->SelfDev_Name->setVisibility();
        $this->SelfDev_StartDate->setVisibility();
        $this->SelfDev_EndDate->setVisibility();
        $this->SelfDev_Money->setVisibility();
        $this->SelfDev_Address->setVisibility();
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
        $this->setupLookupOptions($this->Per_Id);
        $this->setupLookupOptions($this->SelfDev_Type);

        // Check modal
        if ($this->IsModal) {
            $SkipHeaderFooter = true;
        }
        $this->IsMobileOrModal = IsMobile() || $this->IsModal;
        $this->FormClassName = "ew-form ew-edit-form ew-horizontal";
        $loaded = false;
        $postBack = false;

        // Set up current action and primary key
        if (IsApi()) {
            // Load key values
            $loaded = true;
            if (($keyValue = Get("SelfDev_Id") ?? Key(0) ?? Route(2)) !== null) {
                $this->SelfDev_Id->setQueryStringValue($keyValue);
                $this->SelfDev_Id->setOldValue($this->SelfDev_Id->QueryStringValue);
            } elseif (Post("SelfDev_Id") !== null) {
                $this->SelfDev_Id->setFormValue(Post("SelfDev_Id"));
                $this->SelfDev_Id->setOldValue($this->SelfDev_Id->FormValue);
            } else {
                $loaded = false; // Unable to load key
            }

            // Load record
            if ($loaded) {
                $loaded = $this->loadRow();
            }
            if (!$loaded) {
                $this->setFailureMessage($Language->phrase("NoRecord")); // Set no record message
                $this->terminate();
                return;
            }
            $this->CurrentAction = "update"; // Update record directly
            $this->OldKey = $this->getKey(true); // Get from CurrentValue
            $postBack = true;
        } else {
            if (Post("action") !== null) {
                $this->CurrentAction = Post("action"); // Get action code
                if (!$this->isShow()) { // Not reload record, handle as postback
                    $postBack = true;
                }

                // Get key from Form
                $this->setKey(Post($this->OldKeyName));
            } else {
                $this->CurrentAction = "show"; // Default action is display

                // Load key from QueryString
                $loadByQuery = false;
                if (($keyValue = Get("SelfDev_Id") ?? Route("SelfDev_Id")) !== null) {
                    $this->SelfDev_Id->setQueryStringValue($keyValue);
                    $loadByQuery = true;
                } else {
                    $this->SelfDev_Id->CurrentValue = null;
                }
            }

            // Load recordset
            if ($this->isShow()) {
                // Load current record
                $loaded = $this->loadRow();
                $this->OldKey = $loaded ? $this->getKey(true) : ""; // Get from CurrentValue
            }
        }

        // Process form if post back
        if ($postBack) {
            $this->loadFormValues(); // Get form values
        }

        // Validate form if post back
        if ($postBack) {
            if (!$this->validateForm()) {
                $this->EventCancelled = true; // Event cancelled
                $this->restoreFormValues();
                if (IsApi()) {
                    $this->terminate();
                    return;
                } else {
                    $this->CurrentAction = ""; // Form error, reset action
                }
            }
        }

        // Perform current action
        switch ($this->CurrentAction) {
            case "show": // Get a record to display
                if (!$loaded) { // Load record based on key
                    if ($this->getFailureMessage() == "") {
                        $this->setFailureMessage($Language->phrase("NoRecord")); // No record found
                    }
                    $this->terminate("_02selfdevelopmentList"); // No matching record, return to list
                    return;
                }
                break;
            case "update": // Update
                $returnUrl = $this->getReturnUrl();
                if (GetPageName($returnUrl) == "_02selfdevelopmentList") {
                    $returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
                }
                $this->SendEmail = true; // Send email on update success
                if ($this->editRow()) { // Update record based on key
                    if ($this->getSuccessMessage() == "") {
                        $this->setSuccessMessage($Language->phrase("UpdateSuccess")); // Update success
                    }
                    if (IsApi()) {
                        $this->terminate(true);
                        return;
                    } else {
                        $this->terminate($returnUrl); // Return to caller
                        return;
                    }
                } elseif (IsApi()) { // API request, return
                    $this->terminate();
                    return;
                } elseif ($this->getFailureMessage() == $Language->phrase("NoRecord")) {
                    $this->terminate($returnUrl); // Return to caller
                    return;
                } else {
                    $this->EventCancelled = true; // Event cancelled
                    $this->restoreFormValues(); // Restore form values if update failed
                }
        }

        // Set up Breadcrumb
        $this->setupBreadcrumb();

        // Render the record
        $this->RowType = ROWTYPE_EDIT; // Render as Edit
        $this->resetAttributes();
        $this->renderRow();

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

    // Get upload files
    protected function getUploadFiles()
    {
        global $CurrentForm, $Language;
    }

    // Load form values
    protected function loadFormValues()
    {
        // Load from form
        global $CurrentForm;

        // Check field name 'SelfDev_Id' first before field var 'x_SelfDev_Id'
        $val = $CurrentForm->hasValue("SelfDev_Id") ? $CurrentForm->getValue("SelfDev_Id") : $CurrentForm->getValue("x_SelfDev_Id");
        if (!$this->SelfDev_Id->IsDetailKey) {
            $this->SelfDev_Id->setFormValue($val);
        }

        // Check field name 'Per_Id' first before field var 'x_Per_Id'
        $val = $CurrentForm->hasValue("Per_Id") ? $CurrentForm->getValue("Per_Id") : $CurrentForm->getValue("x_Per_Id");
        if (!$this->Per_Id->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->Per_Id->Visible = false; // Disable update for API request
            } else {
                $this->Per_Id->setFormValue($val);
            }
        }

        // Check field name 'SelfDev_Type' first before field var 'x_SelfDev_Type'
        $val = $CurrentForm->hasValue("SelfDev_Type") ? $CurrentForm->getValue("SelfDev_Type") : $CurrentForm->getValue("x_SelfDev_Type");
        if (!$this->SelfDev_Type->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->SelfDev_Type->Visible = false; // Disable update for API request
            } else {
                $this->SelfDev_Type->setFormValue($val);
            }
        }

        // Check field name 'SelfDev_Name' first before field var 'x_SelfDev_Name'
        $val = $CurrentForm->hasValue("SelfDev_Name") ? $CurrentForm->getValue("SelfDev_Name") : $CurrentForm->getValue("x_SelfDev_Name");
        if (!$this->SelfDev_Name->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->SelfDev_Name->Visible = false; // Disable update for API request
            } else {
                $this->SelfDev_Name->setFormValue($val);
            }
        }

        // Check field name 'SelfDev_StartDate' first before field var 'x_SelfDev_StartDate'
        $val = $CurrentForm->hasValue("SelfDev_StartDate") ? $CurrentForm->getValue("SelfDev_StartDate") : $CurrentForm->getValue("x_SelfDev_StartDate");
        if (!$this->SelfDev_StartDate->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->SelfDev_StartDate->Visible = false; // Disable update for API request
            } else {
                $this->SelfDev_StartDate->setFormValue($val);
            }
            $this->SelfDev_StartDate->CurrentValue = UnFormatDateTime($this->SelfDev_StartDate->CurrentValue, 0);
        }

        // Check field name 'SelfDev_EndDate' first before field var 'x_SelfDev_EndDate'
        $val = $CurrentForm->hasValue("SelfDev_EndDate") ? $CurrentForm->getValue("SelfDev_EndDate") : $CurrentForm->getValue("x_SelfDev_EndDate");
        if (!$this->SelfDev_EndDate->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->SelfDev_EndDate->Visible = false; // Disable update for API request
            } else {
                $this->SelfDev_EndDate->setFormValue($val);
            }
            $this->SelfDev_EndDate->CurrentValue = UnFormatDateTime($this->SelfDev_EndDate->CurrentValue, 0);
        }

        // Check field name 'SelfDev_Money' first before field var 'x_SelfDev_Money'
        $val = $CurrentForm->hasValue("SelfDev_Money") ? $CurrentForm->getValue("SelfDev_Money") : $CurrentForm->getValue("x_SelfDev_Money");
        if (!$this->SelfDev_Money->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->SelfDev_Money->Visible = false; // Disable update for API request
            } else {
                $this->SelfDev_Money->setFormValue($val);
            }
        }

        // Check field name 'SelfDev_Address' first before field var 'x_SelfDev_Address'
        $val = $CurrentForm->hasValue("SelfDev_Address") ? $CurrentForm->getValue("SelfDev_Address") : $CurrentForm->getValue("x_SelfDev_Address");
        if (!$this->SelfDev_Address->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->SelfDev_Address->Visible = false; // Disable update for API request
            } else {
                $this->SelfDev_Address->setFormValue($val);
            }
        }
    }

    // Restore form values
    public function restoreFormValues()
    {
        global $CurrentForm;
        $this->SelfDev_Id->CurrentValue = $this->SelfDev_Id->FormValue;
        $this->Per_Id->CurrentValue = $this->Per_Id->FormValue;
        $this->SelfDev_Type->CurrentValue = $this->SelfDev_Type->FormValue;
        $this->SelfDev_Name->CurrentValue = $this->SelfDev_Name->FormValue;
        $this->SelfDev_StartDate->CurrentValue = $this->SelfDev_StartDate->FormValue;
        $this->SelfDev_StartDate->CurrentValue = UnFormatDateTime($this->SelfDev_StartDate->CurrentValue, 0);
        $this->SelfDev_EndDate->CurrentValue = $this->SelfDev_EndDate->FormValue;
        $this->SelfDev_EndDate->CurrentValue = UnFormatDateTime($this->SelfDev_EndDate->CurrentValue, 0);
        $this->SelfDev_Money->CurrentValue = $this->SelfDev_Money->FormValue;
        $this->SelfDev_Address->CurrentValue = $this->SelfDev_Address->FormValue;
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
        $this->SelfDev_Id->setDbValue($row['SelfDev_Id']);
        $this->Per_Id->setDbValue($row['Per_Id']);
        $this->SelfDev_Type->setDbValue($row['SelfDev_Type']);
        $this->SelfDev_Name->setDbValue($row['SelfDev_Name']);
        $this->SelfDev_StartDate->setDbValue($row['SelfDev_StartDate']);
        $this->SelfDev_EndDate->setDbValue($row['SelfDev_EndDate']);
        $this->SelfDev_Money->setDbValue($row['SelfDev_Money']);
        $this->SelfDev_Address->setDbValue($row['SelfDev_Address']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $row = [];
        $row['SelfDev_Id'] = null;
        $row['Per_Id'] = null;
        $row['SelfDev_Type'] = null;
        $row['SelfDev_Name'] = null;
        $row['SelfDev_StartDate'] = null;
        $row['SelfDev_EndDate'] = null;
        $row['SelfDev_Money'] = null;
        $row['SelfDev_Address'] = null;
        return $row;
    }

    // Load old record
    protected function loadOldRecord()
    {
        // Load old record
        $this->OldRecordset = null;
        $validKey = $this->OldKey != "";
        if ($validKey) {
            $this->CurrentFilter = $this->getRecordFilter();
            $sql = $this->getCurrentSql();
            $conn = $this->getConnection();
            $this->OldRecordset = LoadRecordset($sql, $conn);
        }
        $this->loadRowValues($this->OldRecordset); // Load row values
        return $validKey;
    }

    // Render row values based on field settings
    public function renderRow()
    {
        global $Security, $Language, $CurrentLanguage;

        // Initialize URLs

        // Convert decimal values if posted back
        if ($this->SelfDev_Money->FormValue == $this->SelfDev_Money->CurrentValue && is_numeric(ConvertToFloatString($this->SelfDev_Money->CurrentValue))) {
            $this->SelfDev_Money->CurrentValue = ConvertToFloatString($this->SelfDev_Money->CurrentValue);
        }

        // Call Row_Rendering event
        $this->rowRendering();

        // Common render codes for all row types

        // SelfDev_Id

        // Per_Id

        // SelfDev_Type

        // SelfDev_Name

        // SelfDev_StartDate

        // SelfDev_EndDate

        // SelfDev_Money

        // SelfDev_Address
        if ($this->RowType == ROWTYPE_VIEW) {
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
        } elseif ($this->RowType == ROWTYPE_EDIT) {
            // SelfDev_Id
            $this->SelfDev_Id->EditAttrs["class"] = "form-control";
            $this->SelfDev_Id->EditCustomAttributes = "";
            $this->SelfDev_Id->EditValue = $this->SelfDev_Id->CurrentValue;
            $this->SelfDev_Id->ViewCustomAttributes = "";

            // Per_Id
            $this->Per_Id->EditAttrs["class"] = "form-control";
            $this->Per_Id->EditCustomAttributes = "";
            $curVal = trim(strval($this->Per_Id->CurrentValue));
            if ($curVal != "") {
                $this->Per_Id->ViewValue = $this->Per_Id->lookupCacheOption($curVal);
            } else {
                $this->Per_Id->ViewValue = $this->Per_Id->Lookup !== null && is_array($this->Per_Id->Lookup->Options) ? $curVal : null;
            }
            if ($this->Per_Id->ViewValue !== null) { // Load from cache
                $this->Per_Id->EditValue = array_values($this->Per_Id->Lookup->Options);
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "`Per_Id`" . SearchString("=", $this->Per_Id->CurrentValue, DATATYPE_NUMBER, "");
                }
                $sqlWrk = $this->Per_Id->Lookup->getSql(true, $filterWrk, '', $this);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                $arwrk = $rswrk;
                foreach ($arwrk as &$row)
                    $row = $this->Per_Id->Lookup->renderViewRow($row);
                $this->Per_Id->EditValue = $arwrk;
            }
            $this->Per_Id->PlaceHolder = RemoveHtml($this->Per_Id->caption());

            // SelfDev_Type
            $this->SelfDev_Type->EditAttrs["class"] = "form-control";
            $this->SelfDev_Type->EditCustomAttributes = "";
            $curVal = trim(strval($this->SelfDev_Type->CurrentValue));
            if ($curVal != "") {
                $this->SelfDev_Type->ViewValue = $this->SelfDev_Type->lookupCacheOption($curVal);
            } else {
                $this->SelfDev_Type->ViewValue = $this->SelfDev_Type->Lookup !== null && is_array($this->SelfDev_Type->Lookup->Options) ? $curVal : null;
            }
            if ($this->SelfDev_Type->ViewValue !== null) { // Load from cache
                $this->SelfDev_Type->EditValue = array_values($this->SelfDev_Type->Lookup->Options);
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "`SelfDev_Type_id`" . SearchString("=", $this->SelfDev_Type->CurrentValue, DATATYPE_NUMBER, "");
                }
                $sqlWrk = $this->SelfDev_Type->Lookup->getSql(true, $filterWrk, '', $this);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->SelfDev_Type->EditValue = $arwrk;
            }
            $this->SelfDev_Type->PlaceHolder = RemoveHtml($this->SelfDev_Type->caption());

            // SelfDev_Name
            $this->SelfDev_Name->EditAttrs["class"] = "form-control";
            $this->SelfDev_Name->EditCustomAttributes = "";
            $this->SelfDev_Name->EditValue = HtmlEncode($this->SelfDev_Name->CurrentValue);
            $this->SelfDev_Name->PlaceHolder = RemoveHtml($this->SelfDev_Name->caption());

            // SelfDev_StartDate
            $this->SelfDev_StartDate->EditAttrs["class"] = "form-control";
            $this->SelfDev_StartDate->EditCustomAttributes = "";
            $this->SelfDev_StartDate->EditValue = HtmlEncode(FormatDateTime($this->SelfDev_StartDate->CurrentValue, 8));
            $this->SelfDev_StartDate->PlaceHolder = RemoveHtml($this->SelfDev_StartDate->caption());

            // SelfDev_EndDate
            $this->SelfDev_EndDate->EditAttrs["class"] = "form-control";
            $this->SelfDev_EndDate->EditCustomAttributes = "";
            $this->SelfDev_EndDate->EditValue = HtmlEncode(FormatDateTime($this->SelfDev_EndDate->CurrentValue, 8));
            $this->SelfDev_EndDate->PlaceHolder = RemoveHtml($this->SelfDev_EndDate->caption());

            // SelfDev_Money
            $this->SelfDev_Money->EditAttrs["class"] = "form-control";
            $this->SelfDev_Money->EditCustomAttributes = "";
            $this->SelfDev_Money->EditValue = HtmlEncode($this->SelfDev_Money->CurrentValue);
            $this->SelfDev_Money->PlaceHolder = RemoveHtml($this->SelfDev_Money->caption());
            if (strval($this->SelfDev_Money->EditValue) != "" && is_numeric($this->SelfDev_Money->EditValue)) {
                $this->SelfDev_Money->EditValue = FormatNumber($this->SelfDev_Money->EditValue, -2, -2, -2, -2);
            }

            // SelfDev_Address
            $this->SelfDev_Address->EditAttrs["class"] = "form-control";
            $this->SelfDev_Address->EditCustomAttributes = "";
            $this->SelfDev_Address->EditValue = HtmlEncode($this->SelfDev_Address->CurrentValue);
            $this->SelfDev_Address->PlaceHolder = RemoveHtml($this->SelfDev_Address->caption());

            // Edit refer script

            // SelfDev_Id
            $this->SelfDev_Id->LinkCustomAttributes = "";
            $this->SelfDev_Id->HrefValue = "";

            // Per_Id
            $this->Per_Id->LinkCustomAttributes = "";
            $this->Per_Id->HrefValue = "";

            // SelfDev_Type
            $this->SelfDev_Type->LinkCustomAttributes = "";
            $this->SelfDev_Type->HrefValue = "";

            // SelfDev_Name
            $this->SelfDev_Name->LinkCustomAttributes = "";
            $this->SelfDev_Name->HrefValue = "";

            // SelfDev_StartDate
            $this->SelfDev_StartDate->LinkCustomAttributes = "";
            $this->SelfDev_StartDate->HrefValue = "";

            // SelfDev_EndDate
            $this->SelfDev_EndDate->LinkCustomAttributes = "";
            $this->SelfDev_EndDate->HrefValue = "";

            // SelfDev_Money
            $this->SelfDev_Money->LinkCustomAttributes = "";
            $this->SelfDev_Money->HrefValue = "";

            // SelfDev_Address
            $this->SelfDev_Address->LinkCustomAttributes = "";
            $this->SelfDev_Address->HrefValue = "";
        }
        if ($this->RowType == ROWTYPE_ADD || $this->RowType == ROWTYPE_EDIT || $this->RowType == ROWTYPE_SEARCH) { // Add/Edit/Search row
            $this->setupFieldTitles();
        }

        // Call Row Rendered event
        if ($this->RowType != ROWTYPE_AGGREGATEINIT) {
            $this->rowRendered();
        }
    }

    // Validate form
    protected function validateForm()
    {
        global $Language;

        // Check if validation required
        if (!Config("SERVER_VALIDATE")) {
            return true;
        }
        if ($this->SelfDev_Id->Required) {
            if (!$this->SelfDev_Id->IsDetailKey && EmptyValue($this->SelfDev_Id->FormValue)) {
                $this->SelfDev_Id->addErrorMessage(str_replace("%s", $this->SelfDev_Id->caption(), $this->SelfDev_Id->RequiredErrorMessage));
            }
        }
        if ($this->Per_Id->Required) {
            if (!$this->Per_Id->IsDetailKey && EmptyValue($this->Per_Id->FormValue)) {
                $this->Per_Id->addErrorMessage(str_replace("%s", $this->Per_Id->caption(), $this->Per_Id->RequiredErrorMessage));
            }
        }
        if ($this->SelfDev_Type->Required) {
            if (!$this->SelfDev_Type->IsDetailKey && EmptyValue($this->SelfDev_Type->FormValue)) {
                $this->SelfDev_Type->addErrorMessage(str_replace("%s", $this->SelfDev_Type->caption(), $this->SelfDev_Type->RequiredErrorMessage));
            }
        }
        if ($this->SelfDev_Name->Required) {
            if (!$this->SelfDev_Name->IsDetailKey && EmptyValue($this->SelfDev_Name->FormValue)) {
                $this->SelfDev_Name->addErrorMessage(str_replace("%s", $this->SelfDev_Name->caption(), $this->SelfDev_Name->RequiredErrorMessage));
            }
        }
        if ($this->SelfDev_StartDate->Required) {
            if (!$this->SelfDev_StartDate->IsDetailKey && EmptyValue($this->SelfDev_StartDate->FormValue)) {
                $this->SelfDev_StartDate->addErrorMessage(str_replace("%s", $this->SelfDev_StartDate->caption(), $this->SelfDev_StartDate->RequiredErrorMessage));
            }
        }
        if (!CheckDate($this->SelfDev_StartDate->FormValue)) {
            $this->SelfDev_StartDate->addErrorMessage($this->SelfDev_StartDate->getErrorMessage(false));
        }
        if ($this->SelfDev_EndDate->Required) {
            if (!$this->SelfDev_EndDate->IsDetailKey && EmptyValue($this->SelfDev_EndDate->FormValue)) {
                $this->SelfDev_EndDate->addErrorMessage(str_replace("%s", $this->SelfDev_EndDate->caption(), $this->SelfDev_EndDate->RequiredErrorMessage));
            }
        }
        if (!CheckDate($this->SelfDev_EndDate->FormValue)) {
            $this->SelfDev_EndDate->addErrorMessage($this->SelfDev_EndDate->getErrorMessage(false));
        }
        if ($this->SelfDev_Money->Required) {
            if (!$this->SelfDev_Money->IsDetailKey && EmptyValue($this->SelfDev_Money->FormValue)) {
                $this->SelfDev_Money->addErrorMessage(str_replace("%s", $this->SelfDev_Money->caption(), $this->SelfDev_Money->RequiredErrorMessage));
            }
        }
        if (!CheckNumber($this->SelfDev_Money->FormValue)) {
            $this->SelfDev_Money->addErrorMessage($this->SelfDev_Money->getErrorMessage(false));
        }
        if ($this->SelfDev_Address->Required) {
            if (!$this->SelfDev_Address->IsDetailKey && EmptyValue($this->SelfDev_Address->FormValue)) {
                $this->SelfDev_Address->addErrorMessage(str_replace("%s", $this->SelfDev_Address->caption(), $this->SelfDev_Address->RequiredErrorMessage));
            }
        }

        // Return validate result
        $validateForm = !$this->hasInvalidFields();

        // Call Form_CustomValidate event
        $formCustomError = "";
        $validateForm = $validateForm && $this->formCustomValidate($formCustomError);
        if ($formCustomError != "") {
            $this->setFailureMessage($formCustomError);
        }
        return $validateForm;
    }

    // Update record based on key values
    protected function editRow()
    {
        global $Security, $Language;
        $oldKeyFilter = $this->getRecordFilter();
        $filter = $this->applyUserIDFilters($oldKeyFilter);
        $conn = $this->getConnection();
        $this->CurrentFilter = $filter;
        $sql = $this->getCurrentSql();
        $rsold = $conn->fetchAssoc($sql);
        if (!$rsold) {
            $this->setFailureMessage($Language->phrase("NoRecord")); // Set no record message
            $editRow = false; // Update Failed
        } else {
            // Save old values
            $this->loadDbValues($rsold);
            $rsnew = [];

            // Per_Id
            $this->Per_Id->setDbValueDef($rsnew, $this->Per_Id->CurrentValue, 0, $this->Per_Id->ReadOnly);

            // SelfDev_Type
            $this->SelfDev_Type->setDbValueDef($rsnew, $this->SelfDev_Type->CurrentValue, 0, $this->SelfDev_Type->ReadOnly);

            // SelfDev_Name
            $this->SelfDev_Name->setDbValueDef($rsnew, $this->SelfDev_Name->CurrentValue, "", $this->SelfDev_Name->ReadOnly);

            // SelfDev_StartDate
            $this->SelfDev_StartDate->setDbValueDef($rsnew, UnFormatDateTime($this->SelfDev_StartDate->CurrentValue, 0), CurrentDate(), $this->SelfDev_StartDate->ReadOnly);

            // SelfDev_EndDate
            $this->SelfDev_EndDate->setDbValueDef($rsnew, UnFormatDateTime($this->SelfDev_EndDate->CurrentValue, 0), CurrentDate(), $this->SelfDev_EndDate->ReadOnly);

            // SelfDev_Money
            $this->SelfDev_Money->setDbValueDef($rsnew, $this->SelfDev_Money->CurrentValue, 0, $this->SelfDev_Money->ReadOnly);

            // SelfDev_Address
            $this->SelfDev_Address->setDbValueDef($rsnew, $this->SelfDev_Address->CurrentValue, "", $this->SelfDev_Address->ReadOnly);

            // Call Row Updating event
            $updateRow = $this->rowUpdating($rsold, $rsnew);
            if ($updateRow) {
                if (count($rsnew) > 0) {
                    $editRow = $this->update($rsnew, "", $rsold);
                } else {
                    $editRow = true; // No field to update
                }
                if ($editRow) {
                }
            } else {
                if ($this->getSuccessMessage() != "" || $this->getFailureMessage() != "") {
                    // Use the message, do nothing
                } elseif ($this->CancelMessage != "") {
                    $this->setFailureMessage($this->CancelMessage);
                    $this->CancelMessage = "";
                } else {
                    $this->setFailureMessage($Language->phrase("UpdateCancelled"));
                }
                $editRow = false;
            }
        }

        // Call Row_Updated event
        if ($editRow) {
            $this->rowUpdated($rsold, $rsnew);
        }

        // Clean upload path if any
        if ($editRow) {
        }

        // Write JSON for API request
        if (IsApi() && $editRow) {
            $row = $this->getRecordsFromRecordset([$rsnew], true);
            WriteJson(["success" => true, $this->TableVar => $row]);
        }
        return $editRow;
    }

    // Set up Breadcrumb
    protected function setupBreadcrumb()
    {
        global $Breadcrumb, $Language;
        $Breadcrumb = new Breadcrumb("index");
        $url = CurrentUrl();
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("_02selfdevelopmentList"), "", $this->TableVar, true);
        $pageId = "edit";
        $Breadcrumb->add("edit", $pageId, $url);
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
                case "x_Per_Id":
                    break;
                case "x_SelfDev_Type":
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

    // Set up starting record parameters
    public function setupStartRecord()
    {
        if ($this->DisplayRecords == 0) {
            return;
        }
        if ($this->isPageRequest()) { // Validate request
            $startRec = Get(Config("TABLE_START_REC"));
            $pageNo = Get(Config("TABLE_PAGE_NO"));
            if ($pageNo !== null) { // Check for "pageno" parameter first
                if (is_numeric($pageNo)) {
                    $this->StartRecord = ($pageNo - 1) * $this->DisplayRecords + 1;
                    if ($this->StartRecord <= 0) {
                        $this->StartRecord = 1;
                    } elseif ($this->StartRecord >= (int)(($this->TotalRecords - 1) / $this->DisplayRecords) * $this->DisplayRecords + 1) {
                        $this->StartRecord = (int)(($this->TotalRecords - 1) / $this->DisplayRecords) * $this->DisplayRecords + 1;
                    }
                    $this->setStartRecordNumber($this->StartRecord);
                }
            } elseif ($startRec !== null) { // Check for "start" parameter
                $this->StartRecord = $startRec;
                $this->setStartRecordNumber($this->StartRecord);
            }
        }
        $this->StartRecord = $this->getStartRecordNumber();

        // Check if correct start record counter
        if (!is_numeric($this->StartRecord) || $this->StartRecord == "") { // Avoid invalid start record counter
            $this->StartRecord = 1; // Reset start record counter
            $this->setStartRecordNumber($this->StartRecord);
        } elseif ($this->StartRecord > $this->TotalRecords) { // Avoid starting record > total records
            $this->StartRecord = (int)(($this->TotalRecords - 1) / $this->DisplayRecords) * $this->DisplayRecords + 1; // Point to last page first record
            $this->setStartRecordNumber($this->StartRecord);
        } elseif (($this->StartRecord - 1) % $this->DisplayRecords != 0) {
            $this->StartRecord = (int)(($this->StartRecord - 1) / $this->DisplayRecords) * $this->DisplayRecords + 1; // Point to page boundary
            $this->setStartRecordNumber($this->StartRecord);
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

    // Form Custom Validate event
    public function formCustomValidate(&$customError)
    {
        // Return error message in CustomError
        return true;
    }
}
