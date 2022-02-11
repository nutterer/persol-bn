<?php

namespace PHPMaker2021\upPersonnelv2;

use Doctrine\DBAL\ParameterType;

/**
 * Page class
 */
class _01personnelEdit extends _01personnel
{
    use MessagesTrait;

    // Page ID
    public $PageID = "edit";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = '01-personnel';

    // Page object name
    public $PageObjName = "_01personnelEdit";

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

            // Handle modal response
            if ($this->IsModal) { // Show as modal
                $row = ["url" => GetUrl($url), "modal" => "1"];
                $pageName = GetPageName($url);
                if ($pageName != $this->getListUrl()) { // Not List page
                    $row["caption"] = $this->getModalCaption($pageName);
                    if ($pageName == "_01personnelView") {
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
        $this->Per_Id->setVisibility();
        $this->Per_ThaiPre->setVisibility();
        $this->Per_ThaiName->setVisibility();
        $this->Per_ThaiLastName->setVisibility();
        $this->Per_EngPre->setVisibility();
        $this->Per_EngName->setVisibility();
        $this->Per_EngLastName->setVisibility();
        $this->Per_Type->setVisibility();
        $this->Per_EmployeeType->setVisibility();
        $this->Per_Position->setVisibility();
        $this->Per_major->setVisibility();
        $this->Per_Academic->setVisibility();
        $this->Per_Administrative->setVisibility();
        $this->Per_WorDateStart->setVisibility();
        $this->Per_WorkDate->setVisibility();
        $this->Per_Born->setVisibility();
        $this->Per_Nationality->setVisibility();
        $this->Per_Religion->setVisibility();
        $this->Per_IdCard->setVisibility();
        $this->Per_WorkStatus->setVisibility();
        $this->Per_Phone->setVisibility();
        $this->Per_UPEmail->setVisibility();
        $this->Per_Email->setVisibility();
        $this->Per_Address->setVisibility();
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
            if (($keyValue = Get("Per_Id") ?? Key(0) ?? Route(2)) !== null) {
                $this->Per_Id->setQueryStringValue($keyValue);
                $this->Per_Id->setOldValue($this->Per_Id->QueryStringValue);
            } elseif (Post("Per_Id") !== null) {
                $this->Per_Id->setFormValue(Post("Per_Id"));
                $this->Per_Id->setOldValue($this->Per_Id->FormValue);
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
                if (($keyValue = Get("Per_Id") ?? Route("Per_Id")) !== null) {
                    $this->Per_Id->setQueryStringValue($keyValue);
                    $loadByQuery = true;
                } else {
                    $this->Per_Id->CurrentValue = null;
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
                    $this->terminate("_01personnelList"); // No matching record, return to list
                    return;
                }
                break;
            case "update": // Update
                $returnUrl = $this->getReturnUrl();
                if (GetPageName($returnUrl) == "_01personnelList") {
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

        // Check field name 'Per_Id' first before field var 'x_Per_Id'
        $val = $CurrentForm->hasValue("Per_Id") ? $CurrentForm->getValue("Per_Id") : $CurrentForm->getValue("x_Per_Id");
        if (!$this->Per_Id->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->Per_Id->Visible = false; // Disable update for API request
            } else {
                $this->Per_Id->setFormValue($val);
            }
        }
        if ($CurrentForm->hasValue("o_Per_Id")) {
            $this->Per_Id->setOldValue($CurrentForm->getValue("o_Per_Id"));
        }

        // Check field name 'Per_ThaiPre' first before field var 'x_Per_ThaiPre'
        $val = $CurrentForm->hasValue("Per_ThaiPre") ? $CurrentForm->getValue("Per_ThaiPre") : $CurrentForm->getValue("x_Per_ThaiPre");
        if (!$this->Per_ThaiPre->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->Per_ThaiPre->Visible = false; // Disable update for API request
            } else {
                $this->Per_ThaiPre->setFormValue($val);
            }
        }

        // Check field name 'Per_ThaiName' first before field var 'x_Per_ThaiName'
        $val = $CurrentForm->hasValue("Per_ThaiName") ? $CurrentForm->getValue("Per_ThaiName") : $CurrentForm->getValue("x_Per_ThaiName");
        if (!$this->Per_ThaiName->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->Per_ThaiName->Visible = false; // Disable update for API request
            } else {
                $this->Per_ThaiName->setFormValue($val);
            }
        }

        // Check field name 'Per_ThaiLastName' first before field var 'x_Per_ThaiLastName'
        $val = $CurrentForm->hasValue("Per_ThaiLastName") ? $CurrentForm->getValue("Per_ThaiLastName") : $CurrentForm->getValue("x_Per_ThaiLastName");
        if (!$this->Per_ThaiLastName->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->Per_ThaiLastName->Visible = false; // Disable update for API request
            } else {
                $this->Per_ThaiLastName->setFormValue($val);
            }
        }

        // Check field name 'Per_EngPre' first before field var 'x_Per_EngPre'
        $val = $CurrentForm->hasValue("Per_EngPre") ? $CurrentForm->getValue("Per_EngPre") : $CurrentForm->getValue("x_Per_EngPre");
        if (!$this->Per_EngPre->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->Per_EngPre->Visible = false; // Disable update for API request
            } else {
                $this->Per_EngPre->setFormValue($val);
            }
        }

        // Check field name 'Per_EngName' first before field var 'x_Per_EngName'
        $val = $CurrentForm->hasValue("Per_EngName") ? $CurrentForm->getValue("Per_EngName") : $CurrentForm->getValue("x_Per_EngName");
        if (!$this->Per_EngName->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->Per_EngName->Visible = false; // Disable update for API request
            } else {
                $this->Per_EngName->setFormValue($val);
            }
        }

        // Check field name 'Per_EngLastName' first before field var 'x_Per_EngLastName'
        $val = $CurrentForm->hasValue("Per_EngLastName") ? $CurrentForm->getValue("Per_EngLastName") : $CurrentForm->getValue("x_Per_EngLastName");
        if (!$this->Per_EngLastName->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->Per_EngLastName->Visible = false; // Disable update for API request
            } else {
                $this->Per_EngLastName->setFormValue($val);
            }
        }

        // Check field name 'Per_Type' first before field var 'x_Per_Type'
        $val = $CurrentForm->hasValue("Per_Type") ? $CurrentForm->getValue("Per_Type") : $CurrentForm->getValue("x_Per_Type");
        if (!$this->Per_Type->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->Per_Type->Visible = false; // Disable update for API request
            } else {
                $this->Per_Type->setFormValue($val);
            }
        }

        // Check field name 'Per_EmployeeType' first before field var 'x_Per_EmployeeType'
        $val = $CurrentForm->hasValue("Per_EmployeeType") ? $CurrentForm->getValue("Per_EmployeeType") : $CurrentForm->getValue("x_Per_EmployeeType");
        if (!$this->Per_EmployeeType->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->Per_EmployeeType->Visible = false; // Disable update for API request
            } else {
                $this->Per_EmployeeType->setFormValue($val);
            }
        }

        // Check field name 'Per_Position' first before field var 'x_Per_Position'
        $val = $CurrentForm->hasValue("Per_Position") ? $CurrentForm->getValue("Per_Position") : $CurrentForm->getValue("x_Per_Position");
        if (!$this->Per_Position->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->Per_Position->Visible = false; // Disable update for API request
            } else {
                $this->Per_Position->setFormValue($val);
            }
        }

        // Check field name 'Per_major' first before field var 'x_Per_major'
        $val = $CurrentForm->hasValue("Per_major") ? $CurrentForm->getValue("Per_major") : $CurrentForm->getValue("x_Per_major");
        if (!$this->Per_major->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->Per_major->Visible = false; // Disable update for API request
            } else {
                $this->Per_major->setFormValue($val);
            }
        }

        // Check field name 'Per_Academic' first before field var 'x_Per_Academic'
        $val = $CurrentForm->hasValue("Per_Academic") ? $CurrentForm->getValue("Per_Academic") : $CurrentForm->getValue("x_Per_Academic");
        if (!$this->Per_Academic->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->Per_Academic->Visible = false; // Disable update for API request
            } else {
                $this->Per_Academic->setFormValue($val);
            }
        }

        // Check field name 'Per_Administrative' first before field var 'x_Per_Administrative'
        $val = $CurrentForm->hasValue("Per_Administrative") ? $CurrentForm->getValue("Per_Administrative") : $CurrentForm->getValue("x_Per_Administrative");
        if (!$this->Per_Administrative->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->Per_Administrative->Visible = false; // Disable update for API request
            } else {
                $this->Per_Administrative->setFormValue($val);
            }
        }

        // Check field name 'Per_WorDateStart' first before field var 'x_Per_WorDateStart'
        $val = $CurrentForm->hasValue("Per_WorDateStart") ? $CurrentForm->getValue("Per_WorDateStart") : $CurrentForm->getValue("x_Per_WorDateStart");
        if (!$this->Per_WorDateStart->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->Per_WorDateStart->Visible = false; // Disable update for API request
            } else {
                $this->Per_WorDateStart->setFormValue($val);
            }
            $this->Per_WorDateStart->CurrentValue = UnFormatDateTime($this->Per_WorDateStart->CurrentValue, 0);
        }

        // Check field name 'Per_WorkDate' first before field var 'x_Per_WorkDate'
        $val = $CurrentForm->hasValue("Per_WorkDate") ? $CurrentForm->getValue("Per_WorkDate") : $CurrentForm->getValue("x_Per_WorkDate");
        if (!$this->Per_WorkDate->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->Per_WorkDate->Visible = false; // Disable update for API request
            } else {
                $this->Per_WorkDate->setFormValue($val);
            }
            $this->Per_WorkDate->CurrentValue = UnFormatDateTime($this->Per_WorkDate->CurrentValue, 0);
        }

        // Check field name 'Per_Born' first before field var 'x_Per_Born'
        $val = $CurrentForm->hasValue("Per_Born") ? $CurrentForm->getValue("Per_Born") : $CurrentForm->getValue("x_Per_Born");
        if (!$this->Per_Born->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->Per_Born->Visible = false; // Disable update for API request
            } else {
                $this->Per_Born->setFormValue($val);
            }
            $this->Per_Born->CurrentValue = UnFormatDateTime($this->Per_Born->CurrentValue, 0);
        }

        // Check field name 'Per_Nationality' first before field var 'x_Per_Nationality'
        $val = $CurrentForm->hasValue("Per_Nationality") ? $CurrentForm->getValue("Per_Nationality") : $CurrentForm->getValue("x_Per_Nationality");
        if (!$this->Per_Nationality->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->Per_Nationality->Visible = false; // Disable update for API request
            } else {
                $this->Per_Nationality->setFormValue($val);
            }
        }

        // Check field name 'Per_Religion' first before field var 'x_Per_Religion'
        $val = $CurrentForm->hasValue("Per_Religion") ? $CurrentForm->getValue("Per_Religion") : $CurrentForm->getValue("x_Per_Religion");
        if (!$this->Per_Religion->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->Per_Religion->Visible = false; // Disable update for API request
            } else {
                $this->Per_Religion->setFormValue($val);
            }
        }

        // Check field name 'Per_IdCard' first before field var 'x_Per_IdCard'
        $val = $CurrentForm->hasValue("Per_IdCard") ? $CurrentForm->getValue("Per_IdCard") : $CurrentForm->getValue("x_Per_IdCard");
        if (!$this->Per_IdCard->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->Per_IdCard->Visible = false; // Disable update for API request
            } else {
                $this->Per_IdCard->setFormValue($val);
            }
        }

        // Check field name 'Per_WorkStatus' first before field var 'x_Per_WorkStatus'
        $val = $CurrentForm->hasValue("Per_WorkStatus") ? $CurrentForm->getValue("Per_WorkStatus") : $CurrentForm->getValue("x_Per_WorkStatus");
        if (!$this->Per_WorkStatus->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->Per_WorkStatus->Visible = false; // Disable update for API request
            } else {
                $this->Per_WorkStatus->setFormValue($val);
            }
        }

        // Check field name 'Per_Phone' first before field var 'x_Per_Phone'
        $val = $CurrentForm->hasValue("Per_Phone") ? $CurrentForm->getValue("Per_Phone") : $CurrentForm->getValue("x_Per_Phone");
        if (!$this->Per_Phone->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->Per_Phone->Visible = false; // Disable update for API request
            } else {
                $this->Per_Phone->setFormValue($val);
            }
        }

        // Check field name 'Per_UPEmail' first before field var 'x_Per_UPEmail'
        $val = $CurrentForm->hasValue("Per_UPEmail") ? $CurrentForm->getValue("Per_UPEmail") : $CurrentForm->getValue("x_Per_UPEmail");
        if (!$this->Per_UPEmail->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->Per_UPEmail->Visible = false; // Disable update for API request
            } else {
                $this->Per_UPEmail->setFormValue($val);
            }
        }

        // Check field name 'Per_Email' first before field var 'x_Per_Email'
        $val = $CurrentForm->hasValue("Per_Email") ? $CurrentForm->getValue("Per_Email") : $CurrentForm->getValue("x_Per_Email");
        if (!$this->Per_Email->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->Per_Email->Visible = false; // Disable update for API request
            } else {
                $this->Per_Email->setFormValue($val);
            }
        }

        // Check field name 'Per_Address' first before field var 'x_Per_Address'
        $val = $CurrentForm->hasValue("Per_Address") ? $CurrentForm->getValue("Per_Address") : $CurrentForm->getValue("x_Per_Address");
        if (!$this->Per_Address->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->Per_Address->Visible = false; // Disable update for API request
            } else {
                $this->Per_Address->setFormValue($val);
            }
        }
    }

    // Restore form values
    public function restoreFormValues()
    {
        global $CurrentForm;
        $this->Per_Id->CurrentValue = $this->Per_Id->FormValue;
        $this->Per_ThaiPre->CurrentValue = $this->Per_ThaiPre->FormValue;
        $this->Per_ThaiName->CurrentValue = $this->Per_ThaiName->FormValue;
        $this->Per_ThaiLastName->CurrentValue = $this->Per_ThaiLastName->FormValue;
        $this->Per_EngPre->CurrentValue = $this->Per_EngPre->FormValue;
        $this->Per_EngName->CurrentValue = $this->Per_EngName->FormValue;
        $this->Per_EngLastName->CurrentValue = $this->Per_EngLastName->FormValue;
        $this->Per_Type->CurrentValue = $this->Per_Type->FormValue;
        $this->Per_EmployeeType->CurrentValue = $this->Per_EmployeeType->FormValue;
        $this->Per_Position->CurrentValue = $this->Per_Position->FormValue;
        $this->Per_major->CurrentValue = $this->Per_major->FormValue;
        $this->Per_Academic->CurrentValue = $this->Per_Academic->FormValue;
        $this->Per_Administrative->CurrentValue = $this->Per_Administrative->FormValue;
        $this->Per_WorDateStart->CurrentValue = $this->Per_WorDateStart->FormValue;
        $this->Per_WorDateStart->CurrentValue = UnFormatDateTime($this->Per_WorDateStart->CurrentValue, 0);
        $this->Per_WorkDate->CurrentValue = $this->Per_WorkDate->FormValue;
        $this->Per_WorkDate->CurrentValue = UnFormatDateTime($this->Per_WorkDate->CurrentValue, 0);
        $this->Per_Born->CurrentValue = $this->Per_Born->FormValue;
        $this->Per_Born->CurrentValue = UnFormatDateTime($this->Per_Born->CurrentValue, 0);
        $this->Per_Nationality->CurrentValue = $this->Per_Nationality->FormValue;
        $this->Per_Religion->CurrentValue = $this->Per_Religion->FormValue;
        $this->Per_IdCard->CurrentValue = $this->Per_IdCard->FormValue;
        $this->Per_WorkStatus->CurrentValue = $this->Per_WorkStatus->FormValue;
        $this->Per_Phone->CurrentValue = $this->Per_Phone->FormValue;
        $this->Per_UPEmail->CurrentValue = $this->Per_UPEmail->FormValue;
        $this->Per_Email->CurrentValue = $this->Per_Email->FormValue;
        $this->Per_Address->CurrentValue = $this->Per_Address->FormValue;
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

            // Per_major
            $this->Per_major->LinkCustomAttributes = "";
            $this->Per_major->HrefValue = "";
            $this->Per_major->TooltipValue = "";

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

            // Per_WorkStatus
            $this->Per_WorkStatus->LinkCustomAttributes = "";
            $this->Per_WorkStatus->HrefValue = "";
            $this->Per_WorkStatus->TooltipValue = "";

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
        } elseif ($this->RowType == ROWTYPE_EDIT) {
            // Per_Id
            $this->Per_Id->EditAttrs["class"] = "form-control";
            $this->Per_Id->EditCustomAttributes = "";
            $this->Per_Id->EditValue = HtmlEncode($this->Per_Id->CurrentValue);
            $this->Per_Id->PlaceHolder = RemoveHtml($this->Per_Id->caption());

            // Per_ThaiPre
            $this->Per_ThaiPre->EditAttrs["class"] = "form-control";
            $this->Per_ThaiPre->EditCustomAttributes = "";
            if (!$this->Per_ThaiPre->Raw) {
                $this->Per_ThaiPre->CurrentValue = HtmlDecode($this->Per_ThaiPre->CurrentValue);
            }
            $this->Per_ThaiPre->EditValue = HtmlEncode($this->Per_ThaiPre->CurrentValue);
            $this->Per_ThaiPre->PlaceHolder = RemoveHtml($this->Per_ThaiPre->caption());

            // Per_ThaiName
            $this->Per_ThaiName->EditAttrs["class"] = "form-control";
            $this->Per_ThaiName->EditCustomAttributes = "";
            if (!$this->Per_ThaiName->Raw) {
                $this->Per_ThaiName->CurrentValue = HtmlDecode($this->Per_ThaiName->CurrentValue);
            }
            $this->Per_ThaiName->EditValue = HtmlEncode($this->Per_ThaiName->CurrentValue);
            $this->Per_ThaiName->PlaceHolder = RemoveHtml($this->Per_ThaiName->caption());

            // Per_ThaiLastName
            $this->Per_ThaiLastName->EditAttrs["class"] = "form-control";
            $this->Per_ThaiLastName->EditCustomAttributes = "";
            if (!$this->Per_ThaiLastName->Raw) {
                $this->Per_ThaiLastName->CurrentValue = HtmlDecode($this->Per_ThaiLastName->CurrentValue);
            }
            $this->Per_ThaiLastName->EditValue = HtmlEncode($this->Per_ThaiLastName->CurrentValue);
            $this->Per_ThaiLastName->PlaceHolder = RemoveHtml($this->Per_ThaiLastName->caption());

            // Per_EngPre
            $this->Per_EngPre->EditAttrs["class"] = "form-control";
            $this->Per_EngPre->EditCustomAttributes = "";
            if (!$this->Per_EngPre->Raw) {
                $this->Per_EngPre->CurrentValue = HtmlDecode($this->Per_EngPre->CurrentValue);
            }
            $this->Per_EngPre->EditValue = HtmlEncode($this->Per_EngPre->CurrentValue);
            $this->Per_EngPre->PlaceHolder = RemoveHtml($this->Per_EngPre->caption());

            // Per_EngName
            $this->Per_EngName->EditAttrs["class"] = "form-control";
            $this->Per_EngName->EditCustomAttributes = "";
            if (!$this->Per_EngName->Raw) {
                $this->Per_EngName->CurrentValue = HtmlDecode($this->Per_EngName->CurrentValue);
            }
            $this->Per_EngName->EditValue = HtmlEncode($this->Per_EngName->CurrentValue);
            $this->Per_EngName->PlaceHolder = RemoveHtml($this->Per_EngName->caption());

            // Per_EngLastName
            $this->Per_EngLastName->EditAttrs["class"] = "form-control";
            $this->Per_EngLastName->EditCustomAttributes = "";
            if (!$this->Per_EngLastName->Raw) {
                $this->Per_EngLastName->CurrentValue = HtmlDecode($this->Per_EngLastName->CurrentValue);
            }
            $this->Per_EngLastName->EditValue = HtmlEncode($this->Per_EngLastName->CurrentValue);
            $this->Per_EngLastName->PlaceHolder = RemoveHtml($this->Per_EngLastName->caption());

            // Per_Type
            $this->Per_Type->EditAttrs["class"] = "form-control";
            $this->Per_Type->EditCustomAttributes = "";
            $curVal = trim(strval($this->Per_Type->CurrentValue));
            if ($curVal != "") {
                $this->Per_Type->ViewValue = $this->Per_Type->lookupCacheOption($curVal);
            } else {
                $this->Per_Type->ViewValue = $this->Per_Type->Lookup !== null && is_array($this->Per_Type->Lookup->Options) ? $curVal : null;
            }
            if ($this->Per_Type->ViewValue !== null) { // Load from cache
                $this->Per_Type->EditValue = array_values($this->Per_Type->Lookup->Options);
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "`Per_Type_id`" . SearchString("=", $this->Per_Type->CurrentValue, DATATYPE_NUMBER, "");
                }
                $sqlWrk = $this->Per_Type->Lookup->getSql(true, $filterWrk, '', $this);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->Per_Type->EditValue = $arwrk;
            }
            $this->Per_Type->PlaceHolder = RemoveHtml($this->Per_Type->caption());

            // Per_EmployeeType
            $this->Per_EmployeeType->EditAttrs["class"] = "form-control";
            $this->Per_EmployeeType->EditCustomAttributes = "";
            $curVal = trim(strval($this->Per_EmployeeType->CurrentValue));
            if ($curVal != "") {
                $this->Per_EmployeeType->ViewValue = $this->Per_EmployeeType->lookupCacheOption($curVal);
            } else {
                $this->Per_EmployeeType->ViewValue = $this->Per_EmployeeType->Lookup !== null && is_array($this->Per_EmployeeType->Lookup->Options) ? $curVal : null;
            }
            if ($this->Per_EmployeeType->ViewValue !== null) { // Load from cache
                $this->Per_EmployeeType->EditValue = array_values($this->Per_EmployeeType->Lookup->Options);
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "`Per_EmployeeType_id`" . SearchString("=", $this->Per_EmployeeType->CurrentValue, DATATYPE_NUMBER, "");
                }
                $sqlWrk = $this->Per_EmployeeType->Lookup->getSql(true, $filterWrk, '', $this);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->Per_EmployeeType->EditValue = $arwrk;
            }
            $this->Per_EmployeeType->PlaceHolder = RemoveHtml($this->Per_EmployeeType->caption());

            // Per_Position
            $this->Per_Position->EditAttrs["class"] = "form-control";
            $this->Per_Position->EditCustomAttributes = "";
            $curVal = trim(strval($this->Per_Position->CurrentValue));
            if ($curVal != "") {
                $this->Per_Position->ViewValue = $this->Per_Position->lookupCacheOption($curVal);
            } else {
                $this->Per_Position->ViewValue = $this->Per_Position->Lookup !== null && is_array($this->Per_Position->Lookup->Options) ? $curVal : null;
            }
            if ($this->Per_Position->ViewValue !== null) { // Load from cache
                $this->Per_Position->EditValue = array_values($this->Per_Position->Lookup->Options);
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "`Per_Position_id`" . SearchString("=", $this->Per_Position->CurrentValue, DATATYPE_NUMBER, "");
                }
                $sqlWrk = $this->Per_Position->Lookup->getSql(true, $filterWrk, '', $this);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->Per_Position->EditValue = $arwrk;
            }
            $this->Per_Position->PlaceHolder = RemoveHtml($this->Per_Position->caption());

            // Per_major
            $this->Per_major->EditAttrs["class"] = "form-control";
            $this->Per_major->EditCustomAttributes = "";
            $curVal = trim(strval($this->Per_major->CurrentValue));
            if ($curVal != "") {
                $this->Per_major->ViewValue = $this->Per_major->lookupCacheOption($curVal);
            } else {
                $this->Per_major->ViewValue = $this->Per_major->Lookup !== null && is_array($this->Per_major->Lookup->Options) ? $curVal : null;
            }
            if ($this->Per_major->ViewValue !== null) { // Load from cache
                $this->Per_major->EditValue = array_values($this->Per_major->Lookup->Options);
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "`Per_major_id`" . SearchString("=", $this->Per_major->CurrentValue, DATATYPE_NUMBER, "");
                }
                $sqlWrk = $this->Per_major->Lookup->getSql(true, $filterWrk, '', $this);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->Per_major->EditValue = $arwrk;
            }
            $this->Per_major->PlaceHolder = RemoveHtml($this->Per_major->caption());

            // Per_Academic
            $this->Per_Academic->EditAttrs["class"] = "form-control";
            $this->Per_Academic->EditCustomAttributes = "";
            $curVal = trim(strval($this->Per_Academic->CurrentValue));
            if ($curVal != "") {
                $this->Per_Academic->ViewValue = $this->Per_Academic->lookupCacheOption($curVal);
            } else {
                $this->Per_Academic->ViewValue = $this->Per_Academic->Lookup !== null && is_array($this->Per_Academic->Lookup->Options) ? $curVal : null;
            }
            if ($this->Per_Academic->ViewValue !== null) { // Load from cache
                $this->Per_Academic->EditValue = array_values($this->Per_Academic->Lookup->Options);
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "`Per_Academic_id`" . SearchString("=", $this->Per_Academic->CurrentValue, DATATYPE_NUMBER, "");
                }
                $sqlWrk = $this->Per_Academic->Lookup->getSql(true, $filterWrk, '', $this);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->Per_Academic->EditValue = $arwrk;
            }
            $this->Per_Academic->PlaceHolder = RemoveHtml($this->Per_Academic->caption());

            // Per_Administrative
            $this->Per_Administrative->EditAttrs["class"] = "form-control";
            $this->Per_Administrative->EditCustomAttributes = "";
            $curVal = trim(strval($this->Per_Administrative->CurrentValue));
            if ($curVal != "") {
                $this->Per_Administrative->ViewValue = $this->Per_Administrative->lookupCacheOption($curVal);
            } else {
                $this->Per_Administrative->ViewValue = $this->Per_Administrative->Lookup !== null && is_array($this->Per_Administrative->Lookup->Options) ? $curVal : null;
            }
            if ($this->Per_Administrative->ViewValue !== null) { // Load from cache
                $this->Per_Administrative->EditValue = array_values($this->Per_Administrative->Lookup->Options);
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "`Per_Administrative_id`" . SearchString("=", $this->Per_Administrative->CurrentValue, DATATYPE_NUMBER, "");
                }
                $sqlWrk = $this->Per_Administrative->Lookup->getSql(true, $filterWrk, '', $this);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->Per_Administrative->EditValue = $arwrk;
            }
            $this->Per_Administrative->PlaceHolder = RemoveHtml($this->Per_Administrative->caption());

            // Per_WorDateStart
            $this->Per_WorDateStart->EditAttrs["class"] = "form-control";
            $this->Per_WorDateStart->EditCustomAttributes = "";
            $this->Per_WorDateStart->EditValue = HtmlEncode(FormatDateTime($this->Per_WorDateStart->CurrentValue, 8));
            $this->Per_WorDateStart->PlaceHolder = RemoveHtml($this->Per_WorDateStart->caption());

            // Per_WorkDate
            $this->Per_WorkDate->EditAttrs["class"] = "form-control";
            $this->Per_WorkDate->EditCustomAttributes = "";
            $this->Per_WorkDate->EditValue = HtmlEncode(FormatDateTime($this->Per_WorkDate->CurrentValue, 8));
            $this->Per_WorkDate->PlaceHolder = RemoveHtml($this->Per_WorkDate->caption());

            // Per_Born
            $this->Per_Born->EditAttrs["class"] = "form-control";
            $this->Per_Born->EditCustomAttributes = "";
            $this->Per_Born->EditValue = HtmlEncode(FormatDateTime($this->Per_Born->CurrentValue, 8));
            $this->Per_Born->PlaceHolder = RemoveHtml($this->Per_Born->caption());

            // Per_Nationality
            $this->Per_Nationality->EditAttrs["class"] = "form-control";
            $this->Per_Nationality->EditCustomAttributes = "";
            $curVal = trim(strval($this->Per_Nationality->CurrentValue));
            if ($curVal != "") {
                $this->Per_Nationality->ViewValue = $this->Per_Nationality->lookupCacheOption($curVal);
            } else {
                $this->Per_Nationality->ViewValue = $this->Per_Nationality->Lookup !== null && is_array($this->Per_Nationality->Lookup->Options) ? $curVal : null;
            }
            if ($this->Per_Nationality->ViewValue !== null) { // Load from cache
                $this->Per_Nationality->EditValue = array_values($this->Per_Nationality->Lookup->Options);
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "`Per_Nationality_id`" . SearchString("=", $this->Per_Nationality->CurrentValue, DATATYPE_NUMBER, "");
                }
                $sqlWrk = $this->Per_Nationality->Lookup->getSql(true, $filterWrk, '', $this);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->Per_Nationality->EditValue = $arwrk;
            }
            $this->Per_Nationality->PlaceHolder = RemoveHtml($this->Per_Nationality->caption());

            // Per_Religion
            $this->Per_Religion->EditAttrs["class"] = "form-control";
            $this->Per_Religion->EditCustomAttributes = "";
            $curVal = trim(strval($this->Per_Religion->CurrentValue));
            if ($curVal != "") {
                $this->Per_Religion->ViewValue = $this->Per_Religion->lookupCacheOption($curVal);
            } else {
                $this->Per_Religion->ViewValue = $this->Per_Religion->Lookup !== null && is_array($this->Per_Religion->Lookup->Options) ? $curVal : null;
            }
            if ($this->Per_Religion->ViewValue !== null) { // Load from cache
                $this->Per_Religion->EditValue = array_values($this->Per_Religion->Lookup->Options);
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "`Per_Religion_id`" . SearchString("=", $this->Per_Religion->CurrentValue, DATATYPE_NUMBER, "");
                }
                $sqlWrk = $this->Per_Religion->Lookup->getSql(true, $filterWrk, '', $this);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->Per_Religion->EditValue = $arwrk;
            }
            $this->Per_Religion->PlaceHolder = RemoveHtml($this->Per_Religion->caption());

            // Per_IdCard
            $this->Per_IdCard->EditAttrs["class"] = "form-control";
            $this->Per_IdCard->EditCustomAttributes = "";
            if (!$this->Per_IdCard->Raw) {
                $this->Per_IdCard->CurrentValue = HtmlDecode($this->Per_IdCard->CurrentValue);
            }
            $this->Per_IdCard->EditValue = HtmlEncode($this->Per_IdCard->CurrentValue);
            $this->Per_IdCard->PlaceHolder = RemoveHtml($this->Per_IdCard->caption());

            // Per_WorkStatus
            $this->Per_WorkStatus->EditAttrs["class"] = "form-control";
            $this->Per_WorkStatus->EditCustomAttributes = "";
            $curVal = trim(strval($this->Per_WorkStatus->CurrentValue));
            if ($curVal != "") {
                $this->Per_WorkStatus->ViewValue = $this->Per_WorkStatus->lookupCacheOption($curVal);
            } else {
                $this->Per_WorkStatus->ViewValue = $this->Per_WorkStatus->Lookup !== null && is_array($this->Per_WorkStatus->Lookup->Options) ? $curVal : null;
            }
            if ($this->Per_WorkStatus->ViewValue !== null) { // Load from cache
                $this->Per_WorkStatus->EditValue = array_values($this->Per_WorkStatus->Lookup->Options);
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "`Per_WorkStatus_id`" . SearchString("=", $this->Per_WorkStatus->CurrentValue, DATATYPE_NUMBER, "");
                }
                $sqlWrk = $this->Per_WorkStatus->Lookup->getSql(true, $filterWrk, '', $this);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->Per_WorkStatus->EditValue = $arwrk;
            }
            $this->Per_WorkStatus->PlaceHolder = RemoveHtml($this->Per_WorkStatus->caption());

            // Per_Phone
            $this->Per_Phone->EditAttrs["class"] = "form-control";
            $this->Per_Phone->EditCustomAttributes = "";
            if (!$this->Per_Phone->Raw) {
                $this->Per_Phone->CurrentValue = HtmlDecode($this->Per_Phone->CurrentValue);
            }
            $this->Per_Phone->EditValue = HtmlEncode($this->Per_Phone->CurrentValue);
            $this->Per_Phone->PlaceHolder = RemoveHtml($this->Per_Phone->caption());

            // Per_UPEmail
            $this->Per_UPEmail->EditAttrs["class"] = "form-control";
            $this->Per_UPEmail->EditCustomAttributes = "";
            if (!$this->Per_UPEmail->Raw) {
                $this->Per_UPEmail->CurrentValue = HtmlDecode($this->Per_UPEmail->CurrentValue);
            }
            $this->Per_UPEmail->EditValue = HtmlEncode($this->Per_UPEmail->CurrentValue);
            $this->Per_UPEmail->PlaceHolder = RemoveHtml($this->Per_UPEmail->caption());

            // Per_Email
            $this->Per_Email->EditAttrs["class"] = "form-control";
            $this->Per_Email->EditCustomAttributes = "";
            if (!$this->Per_Email->Raw) {
                $this->Per_Email->CurrentValue = HtmlDecode($this->Per_Email->CurrentValue);
            }
            $this->Per_Email->EditValue = HtmlEncode($this->Per_Email->CurrentValue);
            $this->Per_Email->PlaceHolder = RemoveHtml($this->Per_Email->caption());

            // Per_Address
            $this->Per_Address->EditAttrs["class"] = "form-control";
            $this->Per_Address->EditCustomAttributes = "";
            $this->Per_Address->EditValue = HtmlEncode($this->Per_Address->CurrentValue);
            $this->Per_Address->PlaceHolder = RemoveHtml($this->Per_Address->caption());

            // Edit refer script

            // Per_Id
            $this->Per_Id->LinkCustomAttributes = "";
            $this->Per_Id->HrefValue = "";

            // Per_ThaiPre
            $this->Per_ThaiPre->LinkCustomAttributes = "";
            $this->Per_ThaiPre->HrefValue = "";

            // Per_ThaiName
            $this->Per_ThaiName->LinkCustomAttributes = "";
            $this->Per_ThaiName->HrefValue = "";

            // Per_ThaiLastName
            $this->Per_ThaiLastName->LinkCustomAttributes = "";
            $this->Per_ThaiLastName->HrefValue = "";

            // Per_EngPre
            $this->Per_EngPre->LinkCustomAttributes = "";
            $this->Per_EngPre->HrefValue = "";

            // Per_EngName
            $this->Per_EngName->LinkCustomAttributes = "";
            $this->Per_EngName->HrefValue = "";

            // Per_EngLastName
            $this->Per_EngLastName->LinkCustomAttributes = "";
            $this->Per_EngLastName->HrefValue = "";

            // Per_Type
            $this->Per_Type->LinkCustomAttributes = "";
            $this->Per_Type->HrefValue = "";

            // Per_EmployeeType
            $this->Per_EmployeeType->LinkCustomAttributes = "";
            $this->Per_EmployeeType->HrefValue = "";

            // Per_Position
            $this->Per_Position->LinkCustomAttributes = "";
            $this->Per_Position->HrefValue = "";

            // Per_major
            $this->Per_major->LinkCustomAttributes = "";
            $this->Per_major->HrefValue = "";

            // Per_Academic
            $this->Per_Academic->LinkCustomAttributes = "";
            $this->Per_Academic->HrefValue = "";

            // Per_Administrative
            $this->Per_Administrative->LinkCustomAttributes = "";
            $this->Per_Administrative->HrefValue = "";

            // Per_WorDateStart
            $this->Per_WorDateStart->LinkCustomAttributes = "";
            $this->Per_WorDateStart->HrefValue = "";

            // Per_WorkDate
            $this->Per_WorkDate->LinkCustomAttributes = "";
            $this->Per_WorkDate->HrefValue = "";

            // Per_Born
            $this->Per_Born->LinkCustomAttributes = "";
            $this->Per_Born->HrefValue = "";

            // Per_Nationality
            $this->Per_Nationality->LinkCustomAttributes = "";
            $this->Per_Nationality->HrefValue = "";

            // Per_Religion
            $this->Per_Religion->LinkCustomAttributes = "";
            $this->Per_Religion->HrefValue = "";

            // Per_IdCard
            $this->Per_IdCard->LinkCustomAttributes = "";
            $this->Per_IdCard->HrefValue = "";

            // Per_WorkStatus
            $this->Per_WorkStatus->LinkCustomAttributes = "";
            $this->Per_WorkStatus->HrefValue = "";

            // Per_Phone
            $this->Per_Phone->LinkCustomAttributes = "";
            $this->Per_Phone->HrefValue = "";

            // Per_UPEmail
            $this->Per_UPEmail->LinkCustomAttributes = "";
            $this->Per_UPEmail->HrefValue = "";

            // Per_Email
            $this->Per_Email->LinkCustomAttributes = "";
            $this->Per_Email->HrefValue = "";

            // Per_Address
            $this->Per_Address->LinkCustomAttributes = "";
            $this->Per_Address->HrefValue = "";
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
        if ($this->Per_Id->Required) {
            if (!$this->Per_Id->IsDetailKey && EmptyValue($this->Per_Id->FormValue)) {
                $this->Per_Id->addErrorMessage(str_replace("%s", $this->Per_Id->caption(), $this->Per_Id->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->Per_Id->FormValue)) {
            $this->Per_Id->addErrorMessage($this->Per_Id->getErrorMessage(false));
        }
        if ($this->Per_ThaiPre->Required) {
            if (!$this->Per_ThaiPre->IsDetailKey && EmptyValue($this->Per_ThaiPre->FormValue)) {
                $this->Per_ThaiPre->addErrorMessage(str_replace("%s", $this->Per_ThaiPre->caption(), $this->Per_ThaiPre->RequiredErrorMessage));
            }
        }
        if ($this->Per_ThaiName->Required) {
            if (!$this->Per_ThaiName->IsDetailKey && EmptyValue($this->Per_ThaiName->FormValue)) {
                $this->Per_ThaiName->addErrorMessage(str_replace("%s", $this->Per_ThaiName->caption(), $this->Per_ThaiName->RequiredErrorMessage));
            }
        }
        if ($this->Per_ThaiLastName->Required) {
            if (!$this->Per_ThaiLastName->IsDetailKey && EmptyValue($this->Per_ThaiLastName->FormValue)) {
                $this->Per_ThaiLastName->addErrorMessage(str_replace("%s", $this->Per_ThaiLastName->caption(), $this->Per_ThaiLastName->RequiredErrorMessage));
            }
        }
        if ($this->Per_EngPre->Required) {
            if (!$this->Per_EngPre->IsDetailKey && EmptyValue($this->Per_EngPre->FormValue)) {
                $this->Per_EngPre->addErrorMessage(str_replace("%s", $this->Per_EngPre->caption(), $this->Per_EngPre->RequiredErrorMessage));
            }
        }
        if ($this->Per_EngName->Required) {
            if (!$this->Per_EngName->IsDetailKey && EmptyValue($this->Per_EngName->FormValue)) {
                $this->Per_EngName->addErrorMessage(str_replace("%s", $this->Per_EngName->caption(), $this->Per_EngName->RequiredErrorMessage));
            }
        }
        if ($this->Per_EngLastName->Required) {
            if (!$this->Per_EngLastName->IsDetailKey && EmptyValue($this->Per_EngLastName->FormValue)) {
                $this->Per_EngLastName->addErrorMessage(str_replace("%s", $this->Per_EngLastName->caption(), $this->Per_EngLastName->RequiredErrorMessage));
            }
        }
        if ($this->Per_Type->Required) {
            if (!$this->Per_Type->IsDetailKey && EmptyValue($this->Per_Type->FormValue)) {
                $this->Per_Type->addErrorMessage(str_replace("%s", $this->Per_Type->caption(), $this->Per_Type->RequiredErrorMessage));
            }
        }
        if ($this->Per_EmployeeType->Required) {
            if (!$this->Per_EmployeeType->IsDetailKey && EmptyValue($this->Per_EmployeeType->FormValue)) {
                $this->Per_EmployeeType->addErrorMessage(str_replace("%s", $this->Per_EmployeeType->caption(), $this->Per_EmployeeType->RequiredErrorMessage));
            }
        }
        if ($this->Per_Position->Required) {
            if (!$this->Per_Position->IsDetailKey && EmptyValue($this->Per_Position->FormValue)) {
                $this->Per_Position->addErrorMessage(str_replace("%s", $this->Per_Position->caption(), $this->Per_Position->RequiredErrorMessage));
            }
        }
        if ($this->Per_major->Required) {
            if (!$this->Per_major->IsDetailKey && EmptyValue($this->Per_major->FormValue)) {
                $this->Per_major->addErrorMessage(str_replace("%s", $this->Per_major->caption(), $this->Per_major->RequiredErrorMessage));
            }
        }
        if ($this->Per_Academic->Required) {
            if (!$this->Per_Academic->IsDetailKey && EmptyValue($this->Per_Academic->FormValue)) {
                $this->Per_Academic->addErrorMessage(str_replace("%s", $this->Per_Academic->caption(), $this->Per_Academic->RequiredErrorMessage));
            }
        }
        if ($this->Per_Administrative->Required) {
            if (!$this->Per_Administrative->IsDetailKey && EmptyValue($this->Per_Administrative->FormValue)) {
                $this->Per_Administrative->addErrorMessage(str_replace("%s", $this->Per_Administrative->caption(), $this->Per_Administrative->RequiredErrorMessage));
            }
        }
        if ($this->Per_WorDateStart->Required) {
            if (!$this->Per_WorDateStart->IsDetailKey && EmptyValue($this->Per_WorDateStart->FormValue)) {
                $this->Per_WorDateStart->addErrorMessage(str_replace("%s", $this->Per_WorDateStart->caption(), $this->Per_WorDateStart->RequiredErrorMessage));
            }
        }
        if (!CheckDate($this->Per_WorDateStart->FormValue)) {
            $this->Per_WorDateStart->addErrorMessage($this->Per_WorDateStart->getErrorMessage(false));
        }
        if ($this->Per_WorkDate->Required) {
            if (!$this->Per_WorkDate->IsDetailKey && EmptyValue($this->Per_WorkDate->FormValue)) {
                $this->Per_WorkDate->addErrorMessage(str_replace("%s", $this->Per_WorkDate->caption(), $this->Per_WorkDate->RequiredErrorMessage));
            }
        }
        if (!CheckDate($this->Per_WorkDate->FormValue)) {
            $this->Per_WorkDate->addErrorMessage($this->Per_WorkDate->getErrorMessage(false));
        }
        if ($this->Per_Born->Required) {
            if (!$this->Per_Born->IsDetailKey && EmptyValue($this->Per_Born->FormValue)) {
                $this->Per_Born->addErrorMessage(str_replace("%s", $this->Per_Born->caption(), $this->Per_Born->RequiredErrorMessage));
            }
        }
        if (!CheckDate($this->Per_Born->FormValue)) {
            $this->Per_Born->addErrorMessage($this->Per_Born->getErrorMessage(false));
        }
        if ($this->Per_Nationality->Required) {
            if (!$this->Per_Nationality->IsDetailKey && EmptyValue($this->Per_Nationality->FormValue)) {
                $this->Per_Nationality->addErrorMessage(str_replace("%s", $this->Per_Nationality->caption(), $this->Per_Nationality->RequiredErrorMessage));
            }
        }
        if ($this->Per_Religion->Required) {
            if (!$this->Per_Religion->IsDetailKey && EmptyValue($this->Per_Religion->FormValue)) {
                $this->Per_Religion->addErrorMessage(str_replace("%s", $this->Per_Religion->caption(), $this->Per_Religion->RequiredErrorMessage));
            }
        }
        if ($this->Per_IdCard->Required) {
            if (!$this->Per_IdCard->IsDetailKey && EmptyValue($this->Per_IdCard->FormValue)) {
                $this->Per_IdCard->addErrorMessage(str_replace("%s", $this->Per_IdCard->caption(), $this->Per_IdCard->RequiredErrorMessage));
            }
        }
        if ($this->Per_WorkStatus->Required) {
            if (!$this->Per_WorkStatus->IsDetailKey && EmptyValue($this->Per_WorkStatus->FormValue)) {
                $this->Per_WorkStatus->addErrorMessage(str_replace("%s", $this->Per_WorkStatus->caption(), $this->Per_WorkStatus->RequiredErrorMessage));
            }
        }
        if ($this->Per_Phone->Required) {
            if (!$this->Per_Phone->IsDetailKey && EmptyValue($this->Per_Phone->FormValue)) {
                $this->Per_Phone->addErrorMessage(str_replace("%s", $this->Per_Phone->caption(), $this->Per_Phone->RequiredErrorMessage));
            }
        }
        if ($this->Per_UPEmail->Required) {
            if (!$this->Per_UPEmail->IsDetailKey && EmptyValue($this->Per_UPEmail->FormValue)) {
                $this->Per_UPEmail->addErrorMessage(str_replace("%s", $this->Per_UPEmail->caption(), $this->Per_UPEmail->RequiredErrorMessage));
            }
        }
        if ($this->Per_Email->Required) {
            if (!$this->Per_Email->IsDetailKey && EmptyValue($this->Per_Email->FormValue)) {
                $this->Per_Email->addErrorMessage(str_replace("%s", $this->Per_Email->caption(), $this->Per_Email->RequiredErrorMessage));
            }
        }
        if ($this->Per_Address->Required) {
            if (!$this->Per_Address->IsDetailKey && EmptyValue($this->Per_Address->FormValue)) {
                $this->Per_Address->addErrorMessage(str_replace("%s", $this->Per_Address->caption(), $this->Per_Address->RequiredErrorMessage));
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

            // Per_ThaiPre
            $this->Per_ThaiPre->setDbValueDef($rsnew, $this->Per_ThaiPre->CurrentValue, "", $this->Per_ThaiPre->ReadOnly);

            // Per_ThaiName
            $this->Per_ThaiName->setDbValueDef($rsnew, $this->Per_ThaiName->CurrentValue, "", $this->Per_ThaiName->ReadOnly);

            // Per_ThaiLastName
            $this->Per_ThaiLastName->setDbValueDef($rsnew, $this->Per_ThaiLastName->CurrentValue, "", $this->Per_ThaiLastName->ReadOnly);

            // Per_EngPre
            $this->Per_EngPre->setDbValueDef($rsnew, $this->Per_EngPre->CurrentValue, "", $this->Per_EngPre->ReadOnly);

            // Per_EngName
            $this->Per_EngName->setDbValueDef($rsnew, $this->Per_EngName->CurrentValue, "", $this->Per_EngName->ReadOnly);

            // Per_EngLastName
            $this->Per_EngLastName->setDbValueDef($rsnew, $this->Per_EngLastName->CurrentValue, "", $this->Per_EngLastName->ReadOnly);

            // Per_Type
            $this->Per_Type->setDbValueDef($rsnew, $this->Per_Type->CurrentValue, 0, $this->Per_Type->ReadOnly);

            // Per_EmployeeType
            $this->Per_EmployeeType->setDbValueDef($rsnew, $this->Per_EmployeeType->CurrentValue, 0, $this->Per_EmployeeType->ReadOnly);

            // Per_Position
            $this->Per_Position->setDbValueDef($rsnew, $this->Per_Position->CurrentValue, 0, $this->Per_Position->ReadOnly);

            // Per_major
            $this->Per_major->setDbValueDef($rsnew, $this->Per_major->CurrentValue, 0, $this->Per_major->ReadOnly);

            // Per_Academic
            $this->Per_Academic->setDbValueDef($rsnew, $this->Per_Academic->CurrentValue, 0, $this->Per_Academic->ReadOnly);

            // Per_Administrative
            $this->Per_Administrative->setDbValueDef($rsnew, $this->Per_Administrative->CurrentValue, 0, $this->Per_Administrative->ReadOnly);

            // Per_WorDateStart
            $this->Per_WorDateStart->setDbValueDef($rsnew, UnFormatDateTime($this->Per_WorDateStart->CurrentValue, 0), CurrentDate(), $this->Per_WorDateStart->ReadOnly);

            // Per_WorkDate
            $this->Per_WorkDate->setDbValueDef($rsnew, UnFormatDateTime($this->Per_WorkDate->CurrentValue, 0), CurrentDate(), $this->Per_WorkDate->ReadOnly);

            // Per_Born
            $this->Per_Born->setDbValueDef($rsnew, UnFormatDateTime($this->Per_Born->CurrentValue, 0), CurrentDate(), $this->Per_Born->ReadOnly);

            // Per_Nationality
            $this->Per_Nationality->setDbValueDef($rsnew, $this->Per_Nationality->CurrentValue, 0, $this->Per_Nationality->ReadOnly);

            // Per_Religion
            $this->Per_Religion->setDbValueDef($rsnew, $this->Per_Religion->CurrentValue, 0, $this->Per_Religion->ReadOnly);

            // Per_IdCard
            $this->Per_IdCard->setDbValueDef($rsnew, $this->Per_IdCard->CurrentValue, "", $this->Per_IdCard->ReadOnly);

            // Per_WorkStatus
            $this->Per_WorkStatus->setDbValueDef($rsnew, $this->Per_WorkStatus->CurrentValue, 0, $this->Per_WorkStatus->ReadOnly);

            // Per_Phone
            $this->Per_Phone->setDbValueDef($rsnew, $this->Per_Phone->CurrentValue, "", $this->Per_Phone->ReadOnly);

            // Per_UPEmail
            $this->Per_UPEmail->setDbValueDef($rsnew, $this->Per_UPEmail->CurrentValue, "", $this->Per_UPEmail->ReadOnly);

            // Per_Email
            $this->Per_Email->setDbValueDef($rsnew, $this->Per_Email->CurrentValue, "", $this->Per_Email->ReadOnly);

            // Per_Address
            $this->Per_Address->setDbValueDef($rsnew, $this->Per_Address->CurrentValue, "", $this->Per_Address->ReadOnly);

            // Call Row Updating event
            $updateRow = $this->rowUpdating($rsold, $rsnew);

            // Check for duplicate key when key changed
            if ($updateRow) {
                $newKeyFilter = $this->getRecordFilter($rsnew);
                if ($newKeyFilter != $oldKeyFilter) {
                    $rsChk = $this->loadRs($newKeyFilter)->fetch();
                    if ($rsChk !== false) {
                        $keyErrMsg = str_replace("%f", $newKeyFilter, $Language->phrase("DupKey"));
                        $this->setFailureMessage($keyErrMsg);
                        $updateRow = false;
                    }
                }
            }
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
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("_01personnelList"), "", $this->TableVar, true);
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
