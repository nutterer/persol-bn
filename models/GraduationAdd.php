<?php

namespace PHPMaker2021\upPersonnelv2;

use Doctrine\DBAL\ParameterType;

/**
 * Page class
 */
class GraduationAdd extends Graduation
{
    use MessagesTrait;

    // Page ID
    public $PageID = "add";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'graduation';

    // Page object name
    public $PageObjName = "GraduationAdd";

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

        // Table object (graduation)
        if (!isset($GLOBALS["graduation"]) || get_class($GLOBALS["graduation"]) == PROJECT_NAMESPACE . "graduation") {
            $GLOBALS["graduation"] = &$this;
        }

        // Page URL
        $pageUrl = $this->pageUrl();

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'graduation');
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
                $doc = new $class(Container("graduation"));
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
                    if ($pageName == "GraduationView") {
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
            $key .= @$ar['Grad_Id'];
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
            $this->Grad_Id->Visible = false;
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
    public $FormClassName = "ew-horizontal ew-form ew-add-form";
    public $IsModal = false;
    public $IsMobileOrModal = false;
    public $DbMasterFilter = "";
    public $DbDetailFilter = "";
    public $StartRecord;
    public $Priv = 0;
    public $OldRecordset;
    public $CopyRecord;

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
        $this->Grad_Id->Visible = false;
        $this->Per_Id->setVisibility();
        $this->Grad_Degree->setVisibility();
        $this->Grad_Major->setVisibility();
        $this->Grad_ShortDegree->setVisibility();
        $this->Grad_Institution->setVisibility();
        $this->Grad_Provinces->setVisibility();
        $this->Grad_Country->setVisibility();
        $this->Grad_Start->setVisibility();
        $this->Grad_End->setVisibility();
        $this->Grad_GPA->setVisibility();
        $this->Grad_Honor->setVisibility();
        $this->Grad_Admission->setVisibility();
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
        $this->setupLookupOptions($this->Grad_Admission);

        // Check modal
        if ($this->IsModal) {
            $SkipHeaderFooter = true;
        }
        $this->IsMobileOrModal = IsMobile() || $this->IsModal;
        $this->FormClassName = "ew-form ew-add-form ew-horizontal";
        $postBack = false;

        // Set up current action
        if (IsApi()) {
            $this->CurrentAction = "insert"; // Add record directly
            $postBack = true;
        } elseif (Post("action") !== null) {
            $this->CurrentAction = Post("action"); // Get form action
            $this->setKey(Post($this->OldKeyName));
            $postBack = true;
        } else {
            // Load key values from QueryString
            if (($keyValue = Get("Grad_Id") ?? Route("Grad_Id")) !== null) {
                $this->Grad_Id->setQueryStringValue($keyValue);
            }
            $this->OldKey = $this->getKey(true); // Get from CurrentValue
            $this->CopyRecord = !EmptyValue($this->OldKey);
            if ($this->CopyRecord) {
                $this->CurrentAction = "copy"; // Copy record
            } else {
                $this->CurrentAction = "show"; // Display blank record
            }
        }

        // Load old record / default values
        $loaded = $this->loadOldRecord();

        // Load form values
        if ($postBack) {
            $this->loadFormValues(); // Load form values
        }

        // Validate form if post back
        if ($postBack) {
            if (!$this->validateForm()) {
                $this->EventCancelled = true; // Event cancelled
                $this->restoreFormValues(); // Restore form values
                if (IsApi()) {
                    $this->terminate();
                    return;
                } else {
                    $this->CurrentAction = "show"; // Form error, reset action
                }
            }
        }

        // Perform current action
        switch ($this->CurrentAction) {
            case "copy": // Copy an existing record
                if (!$loaded) { // Record not loaded
                    if ($this->getFailureMessage() == "") {
                        $this->setFailureMessage($Language->phrase("NoRecord")); // No record found
                    }
                    $this->terminate("GraduationList"); // No matching record, return to list
                    return;
                }
                break;
            case "insert": // Add new record
                $this->SendEmail = true; // Send email on add success
                if ($this->addRow($this->OldRecordset)) { // Add successful
                    if ($this->getSuccessMessage() == "" && Post("addopt") != "1") { // Skip success message for addopt (done in JavaScript)
                        $this->setSuccessMessage($Language->phrase("AddSuccess")); // Set up success message
                    }
                    $returnUrl = $this->getReturnUrl();
                    if (GetPageName($returnUrl) == "GraduationList") {
                        $returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
                    } elseif (GetPageName($returnUrl) == "GraduationView") {
                        $returnUrl = $this->getViewUrl(); // View page, return to View page with keyurl directly
                    }
                    if (IsApi()) { // Return to caller
                        $this->terminate(true);
                        return;
                    } else {
                        $this->terminate($returnUrl);
                        return;
                    }
                } elseif (IsApi()) { // API request, return
                    $this->terminate();
                    return;
                } else {
                    $this->EventCancelled = true; // Event cancelled
                    $this->restoreFormValues(); // Add failed, restore form values
                }
        }

        // Set up Breadcrumb
        $this->setupBreadcrumb();

        // Render row based on row type
        $this->RowType = ROWTYPE_ADD; // Render add type

        // Render row
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

    // Load default values
    protected function loadDefaultValues()
    {
        $this->Grad_Id->CurrentValue = null;
        $this->Grad_Id->OldValue = $this->Grad_Id->CurrentValue;
        $this->Per_Id->CurrentValue = null;
        $this->Per_Id->OldValue = $this->Per_Id->CurrentValue;
        $this->Grad_Degree->CurrentValue = null;
        $this->Grad_Degree->OldValue = $this->Grad_Degree->CurrentValue;
        $this->Grad_Major->CurrentValue = null;
        $this->Grad_Major->OldValue = $this->Grad_Major->CurrentValue;
        $this->Grad_ShortDegree->CurrentValue = null;
        $this->Grad_ShortDegree->OldValue = $this->Grad_ShortDegree->CurrentValue;
        $this->Grad_Institution->CurrentValue = null;
        $this->Grad_Institution->OldValue = $this->Grad_Institution->CurrentValue;
        $this->Grad_Provinces->CurrentValue = null;
        $this->Grad_Provinces->OldValue = $this->Grad_Provinces->CurrentValue;
        $this->Grad_Country->CurrentValue = null;
        $this->Grad_Country->OldValue = $this->Grad_Country->CurrentValue;
        $this->Grad_Start->CurrentValue = null;
        $this->Grad_Start->OldValue = $this->Grad_Start->CurrentValue;
        $this->Grad_End->CurrentValue = null;
        $this->Grad_End->OldValue = $this->Grad_End->CurrentValue;
        $this->Grad_GPA->CurrentValue = null;
        $this->Grad_GPA->OldValue = $this->Grad_GPA->CurrentValue;
        $this->Grad_Honor->CurrentValue = null;
        $this->Grad_Honor->OldValue = $this->Grad_Honor->CurrentValue;
        $this->Grad_Admission->CurrentValue = null;
        $this->Grad_Admission->OldValue = $this->Grad_Admission->CurrentValue;
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

        // Check field name 'Grad_Degree' first before field var 'x_Grad_Degree'
        $val = $CurrentForm->hasValue("Grad_Degree") ? $CurrentForm->getValue("Grad_Degree") : $CurrentForm->getValue("x_Grad_Degree");
        if (!$this->Grad_Degree->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->Grad_Degree->Visible = false; // Disable update for API request
            } else {
                $this->Grad_Degree->setFormValue($val);
            }
        }

        // Check field name 'Grad_Major' first before field var 'x_Grad_Major'
        $val = $CurrentForm->hasValue("Grad_Major") ? $CurrentForm->getValue("Grad_Major") : $CurrentForm->getValue("x_Grad_Major");
        if (!$this->Grad_Major->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->Grad_Major->Visible = false; // Disable update for API request
            } else {
                $this->Grad_Major->setFormValue($val);
            }
        }

        // Check field name 'Grad_ShortDegree' first before field var 'x_Grad_ShortDegree'
        $val = $CurrentForm->hasValue("Grad_ShortDegree") ? $CurrentForm->getValue("Grad_ShortDegree") : $CurrentForm->getValue("x_Grad_ShortDegree");
        if (!$this->Grad_ShortDegree->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->Grad_ShortDegree->Visible = false; // Disable update for API request
            } else {
                $this->Grad_ShortDegree->setFormValue($val);
            }
        }

        // Check field name 'Grad_Institution' first before field var 'x_Grad_Institution'
        $val = $CurrentForm->hasValue("Grad_Institution") ? $CurrentForm->getValue("Grad_Institution") : $CurrentForm->getValue("x_Grad_Institution");
        if (!$this->Grad_Institution->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->Grad_Institution->Visible = false; // Disable update for API request
            } else {
                $this->Grad_Institution->setFormValue($val);
            }
        }

        // Check field name 'Grad_Provinces' first before field var 'x_Grad_Provinces'
        $val = $CurrentForm->hasValue("Grad_Provinces") ? $CurrentForm->getValue("Grad_Provinces") : $CurrentForm->getValue("x_Grad_Provinces");
        if (!$this->Grad_Provinces->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->Grad_Provinces->Visible = false; // Disable update for API request
            } else {
                $this->Grad_Provinces->setFormValue($val);
            }
        }

        // Check field name 'Grad_Country' first before field var 'x_Grad_Country'
        $val = $CurrentForm->hasValue("Grad_Country") ? $CurrentForm->getValue("Grad_Country") : $CurrentForm->getValue("x_Grad_Country");
        if (!$this->Grad_Country->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->Grad_Country->Visible = false; // Disable update for API request
            } else {
                $this->Grad_Country->setFormValue($val);
            }
        }

        // Check field name 'Grad_Start' first before field var 'x_Grad_Start'
        $val = $CurrentForm->hasValue("Grad_Start") ? $CurrentForm->getValue("Grad_Start") : $CurrentForm->getValue("x_Grad_Start");
        if (!$this->Grad_Start->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->Grad_Start->Visible = false; // Disable update for API request
            } else {
                $this->Grad_Start->setFormValue($val);
            }
            $this->Grad_Start->CurrentValue = UnFormatDateTime($this->Grad_Start->CurrentValue, 0);
        }

        // Check field name 'Grad_End' first before field var 'x_Grad_End'
        $val = $CurrentForm->hasValue("Grad_End") ? $CurrentForm->getValue("Grad_End") : $CurrentForm->getValue("x_Grad_End");
        if (!$this->Grad_End->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->Grad_End->Visible = false; // Disable update for API request
            } else {
                $this->Grad_End->setFormValue($val);
            }
            $this->Grad_End->CurrentValue = UnFormatDateTime($this->Grad_End->CurrentValue, 0);
        }

        // Check field name 'Grad_GPA' first before field var 'x_Grad_GPA'
        $val = $CurrentForm->hasValue("Grad_GPA") ? $CurrentForm->getValue("Grad_GPA") : $CurrentForm->getValue("x_Grad_GPA");
        if (!$this->Grad_GPA->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->Grad_GPA->Visible = false; // Disable update for API request
            } else {
                $this->Grad_GPA->setFormValue($val);
            }
        }

        // Check field name 'Grad_Honor' first before field var 'x_Grad_Honor'
        $val = $CurrentForm->hasValue("Grad_Honor") ? $CurrentForm->getValue("Grad_Honor") : $CurrentForm->getValue("x_Grad_Honor");
        if (!$this->Grad_Honor->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->Grad_Honor->Visible = false; // Disable update for API request
            } else {
                $this->Grad_Honor->setFormValue($val);
            }
        }

        // Check field name 'Grad_Admission' first before field var 'x_Grad_Admission'
        $val = $CurrentForm->hasValue("Grad_Admission") ? $CurrentForm->getValue("Grad_Admission") : $CurrentForm->getValue("x_Grad_Admission");
        if (!$this->Grad_Admission->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->Grad_Admission->Visible = false; // Disable update for API request
            } else {
                $this->Grad_Admission->setFormValue($val);
            }
        }

        // Check field name 'Grad_Id' first before field var 'x_Grad_Id'
        $val = $CurrentForm->hasValue("Grad_Id") ? $CurrentForm->getValue("Grad_Id") : $CurrentForm->getValue("x_Grad_Id");
    }

    // Restore form values
    public function restoreFormValues()
    {
        global $CurrentForm;
        $this->Per_Id->CurrentValue = $this->Per_Id->FormValue;
        $this->Grad_Degree->CurrentValue = $this->Grad_Degree->FormValue;
        $this->Grad_Major->CurrentValue = $this->Grad_Major->FormValue;
        $this->Grad_ShortDegree->CurrentValue = $this->Grad_ShortDegree->FormValue;
        $this->Grad_Institution->CurrentValue = $this->Grad_Institution->FormValue;
        $this->Grad_Provinces->CurrentValue = $this->Grad_Provinces->FormValue;
        $this->Grad_Country->CurrentValue = $this->Grad_Country->FormValue;
        $this->Grad_Start->CurrentValue = $this->Grad_Start->FormValue;
        $this->Grad_Start->CurrentValue = UnFormatDateTime($this->Grad_Start->CurrentValue, 0);
        $this->Grad_End->CurrentValue = $this->Grad_End->FormValue;
        $this->Grad_End->CurrentValue = UnFormatDateTime($this->Grad_End->CurrentValue, 0);
        $this->Grad_GPA->CurrentValue = $this->Grad_GPA->FormValue;
        $this->Grad_Honor->CurrentValue = $this->Grad_Honor->FormValue;
        $this->Grad_Admission->CurrentValue = $this->Grad_Admission->FormValue;
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

    // Return a row with default values
    protected function newRow()
    {
        $this->loadDefaultValues();
        $row = [];
        $row['Grad_Id'] = $this->Grad_Id->CurrentValue;
        $row['Per_Id'] = $this->Per_Id->CurrentValue;
        $row['Grad_Degree'] = $this->Grad_Degree->CurrentValue;
        $row['Grad_Major'] = $this->Grad_Major->CurrentValue;
        $row['Grad_ShortDegree'] = $this->Grad_ShortDegree->CurrentValue;
        $row['Grad_Institution'] = $this->Grad_Institution->CurrentValue;
        $row['Grad_Provinces'] = $this->Grad_Provinces->CurrentValue;
        $row['Grad_Country'] = $this->Grad_Country->CurrentValue;
        $row['Grad_Start'] = $this->Grad_Start->CurrentValue;
        $row['Grad_End'] = $this->Grad_End->CurrentValue;
        $row['Grad_GPA'] = $this->Grad_GPA->CurrentValue;
        $row['Grad_Honor'] = $this->Grad_Honor->CurrentValue;
        $row['Grad_Admission'] = $this->Grad_Admission->CurrentValue;
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
        if ($this->RowType == ROWTYPE_VIEW) {
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
        } elseif ($this->RowType == ROWTYPE_ADD) {
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

            // Grad_Degree
            $this->Grad_Degree->EditAttrs["class"] = "form-control";
            $this->Grad_Degree->EditCustomAttributes = "";
            $this->Grad_Degree->EditValue = HtmlEncode($this->Grad_Degree->CurrentValue);
            $this->Grad_Degree->PlaceHolder = RemoveHtml($this->Grad_Degree->caption());

            // Grad_Major
            $this->Grad_Major->EditAttrs["class"] = "form-control";
            $this->Grad_Major->EditCustomAttributes = "";
            $this->Grad_Major->EditValue = HtmlEncode($this->Grad_Major->CurrentValue);
            $this->Grad_Major->PlaceHolder = RemoveHtml($this->Grad_Major->caption());

            // Grad_ShortDegree
            $this->Grad_ShortDegree->EditAttrs["class"] = "form-control";
            $this->Grad_ShortDegree->EditCustomAttributes = "";
            $this->Grad_ShortDegree->EditValue = HtmlEncode($this->Grad_ShortDegree->CurrentValue);
            $this->Grad_ShortDegree->PlaceHolder = RemoveHtml($this->Grad_ShortDegree->caption());

            // Grad_Institution
            $this->Grad_Institution->EditAttrs["class"] = "form-control";
            $this->Grad_Institution->EditCustomAttributes = "";
            if (!$this->Grad_Institution->Raw) {
                $this->Grad_Institution->CurrentValue = HtmlDecode($this->Grad_Institution->CurrentValue);
            }
            $this->Grad_Institution->EditValue = HtmlEncode($this->Grad_Institution->CurrentValue);
            $this->Grad_Institution->PlaceHolder = RemoveHtml($this->Grad_Institution->caption());

            // Grad_Provinces
            $this->Grad_Provinces->EditAttrs["class"] = "form-control";
            $this->Grad_Provinces->EditCustomAttributes = "";
            if (!$this->Grad_Provinces->Raw) {
                $this->Grad_Provinces->CurrentValue = HtmlDecode($this->Grad_Provinces->CurrentValue);
            }
            $this->Grad_Provinces->EditValue = HtmlEncode($this->Grad_Provinces->CurrentValue);
            $this->Grad_Provinces->PlaceHolder = RemoveHtml($this->Grad_Provinces->caption());

            // Grad_Country
            $this->Grad_Country->EditAttrs["class"] = "form-control";
            $this->Grad_Country->EditCustomAttributes = "";
            if (!$this->Grad_Country->Raw) {
                $this->Grad_Country->CurrentValue = HtmlDecode($this->Grad_Country->CurrentValue);
            }
            $this->Grad_Country->EditValue = HtmlEncode($this->Grad_Country->CurrentValue);
            $this->Grad_Country->PlaceHolder = RemoveHtml($this->Grad_Country->caption());

            // Grad_Start
            $this->Grad_Start->EditAttrs["class"] = "form-control";
            $this->Grad_Start->EditCustomAttributes = "";
            $this->Grad_Start->EditValue = HtmlEncode(FormatDateTime($this->Grad_Start->CurrentValue, 8));
            $this->Grad_Start->PlaceHolder = RemoveHtml($this->Grad_Start->caption());

            // Grad_End
            $this->Grad_End->EditAttrs["class"] = "form-control";
            $this->Grad_End->EditCustomAttributes = "";
            $this->Grad_End->EditValue = HtmlEncode(FormatDateTime($this->Grad_End->CurrentValue, 8));
            $this->Grad_End->PlaceHolder = RemoveHtml($this->Grad_End->caption());

            // Grad_GPA
            $this->Grad_GPA->EditAttrs["class"] = "form-control";
            $this->Grad_GPA->EditCustomAttributes = "";
            if (!$this->Grad_GPA->Raw) {
                $this->Grad_GPA->CurrentValue = HtmlDecode($this->Grad_GPA->CurrentValue);
            }
            $this->Grad_GPA->EditValue = HtmlEncode($this->Grad_GPA->CurrentValue);
            $this->Grad_GPA->PlaceHolder = RemoveHtml($this->Grad_GPA->caption());

            // Grad_Honor
            $this->Grad_Honor->EditAttrs["class"] = "form-control";
            $this->Grad_Honor->EditCustomAttributes = "";
            if (!$this->Grad_Honor->Raw) {
                $this->Grad_Honor->CurrentValue = HtmlDecode($this->Grad_Honor->CurrentValue);
            }
            $this->Grad_Honor->EditValue = HtmlEncode($this->Grad_Honor->CurrentValue);
            $this->Grad_Honor->PlaceHolder = RemoveHtml($this->Grad_Honor->caption());

            // Grad_Admission
            $this->Grad_Admission->EditAttrs["class"] = "form-control";
            $this->Grad_Admission->EditCustomAttributes = "";
            $curVal = trim(strval($this->Grad_Admission->CurrentValue));
            if ($curVal != "") {
                $this->Grad_Admission->ViewValue = $this->Grad_Admission->lookupCacheOption($curVal);
            } else {
                $this->Grad_Admission->ViewValue = $this->Grad_Admission->Lookup !== null && is_array($this->Grad_Admission->Lookup->Options) ? $curVal : null;
            }
            if ($this->Grad_Admission->ViewValue !== null) { // Load from cache
                $this->Grad_Admission->EditValue = array_values($this->Grad_Admission->Lookup->Options);
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "`Grad_Admission_id`" . SearchString("=", $this->Grad_Admission->CurrentValue, DATATYPE_NUMBER, "");
                }
                $sqlWrk = $this->Grad_Admission->Lookup->getSql(true, $filterWrk, '', $this);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->Grad_Admission->EditValue = $arwrk;
            }
            $this->Grad_Admission->PlaceHolder = RemoveHtml($this->Grad_Admission->caption());

            // Add refer script

            // Per_Id
            $this->Per_Id->LinkCustomAttributes = "";
            $this->Per_Id->HrefValue = "";

            // Grad_Degree
            $this->Grad_Degree->LinkCustomAttributes = "";
            $this->Grad_Degree->HrefValue = "";

            // Grad_Major
            $this->Grad_Major->LinkCustomAttributes = "";
            $this->Grad_Major->HrefValue = "";

            // Grad_ShortDegree
            $this->Grad_ShortDegree->LinkCustomAttributes = "";
            $this->Grad_ShortDegree->HrefValue = "";

            // Grad_Institution
            $this->Grad_Institution->LinkCustomAttributes = "";
            $this->Grad_Institution->HrefValue = "";

            // Grad_Provinces
            $this->Grad_Provinces->LinkCustomAttributes = "";
            $this->Grad_Provinces->HrefValue = "";

            // Grad_Country
            $this->Grad_Country->LinkCustomAttributes = "";
            $this->Grad_Country->HrefValue = "";

            // Grad_Start
            $this->Grad_Start->LinkCustomAttributes = "";
            $this->Grad_Start->HrefValue = "";

            // Grad_End
            $this->Grad_End->LinkCustomAttributes = "";
            $this->Grad_End->HrefValue = "";

            // Grad_GPA
            $this->Grad_GPA->LinkCustomAttributes = "";
            $this->Grad_GPA->HrefValue = "";

            // Grad_Honor
            $this->Grad_Honor->LinkCustomAttributes = "";
            $this->Grad_Honor->HrefValue = "";

            // Grad_Admission
            $this->Grad_Admission->LinkCustomAttributes = "";
            $this->Grad_Admission->HrefValue = "";
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
        if ($this->Grad_Degree->Required) {
            if (!$this->Grad_Degree->IsDetailKey && EmptyValue($this->Grad_Degree->FormValue)) {
                $this->Grad_Degree->addErrorMessage(str_replace("%s", $this->Grad_Degree->caption(), $this->Grad_Degree->RequiredErrorMessage));
            }
        }
        if ($this->Grad_Major->Required) {
            if (!$this->Grad_Major->IsDetailKey && EmptyValue($this->Grad_Major->FormValue)) {
                $this->Grad_Major->addErrorMessage(str_replace("%s", $this->Grad_Major->caption(), $this->Grad_Major->RequiredErrorMessage));
            }
        }
        if ($this->Grad_ShortDegree->Required) {
            if (!$this->Grad_ShortDegree->IsDetailKey && EmptyValue($this->Grad_ShortDegree->FormValue)) {
                $this->Grad_ShortDegree->addErrorMessage(str_replace("%s", $this->Grad_ShortDegree->caption(), $this->Grad_ShortDegree->RequiredErrorMessage));
            }
        }
        if ($this->Grad_Institution->Required) {
            if (!$this->Grad_Institution->IsDetailKey && EmptyValue($this->Grad_Institution->FormValue)) {
                $this->Grad_Institution->addErrorMessage(str_replace("%s", $this->Grad_Institution->caption(), $this->Grad_Institution->RequiredErrorMessage));
            }
        }
        if ($this->Grad_Provinces->Required) {
            if (!$this->Grad_Provinces->IsDetailKey && EmptyValue($this->Grad_Provinces->FormValue)) {
                $this->Grad_Provinces->addErrorMessage(str_replace("%s", $this->Grad_Provinces->caption(), $this->Grad_Provinces->RequiredErrorMessage));
            }
        }
        if ($this->Grad_Country->Required) {
            if (!$this->Grad_Country->IsDetailKey && EmptyValue($this->Grad_Country->FormValue)) {
                $this->Grad_Country->addErrorMessage(str_replace("%s", $this->Grad_Country->caption(), $this->Grad_Country->RequiredErrorMessage));
            }
        }
        if ($this->Grad_Start->Required) {
            if (!$this->Grad_Start->IsDetailKey && EmptyValue($this->Grad_Start->FormValue)) {
                $this->Grad_Start->addErrorMessage(str_replace("%s", $this->Grad_Start->caption(), $this->Grad_Start->RequiredErrorMessage));
            }
        }
        if (!CheckDate($this->Grad_Start->FormValue)) {
            $this->Grad_Start->addErrorMessage($this->Grad_Start->getErrorMessage(false));
        }
        if ($this->Grad_End->Required) {
            if (!$this->Grad_End->IsDetailKey && EmptyValue($this->Grad_End->FormValue)) {
                $this->Grad_End->addErrorMessage(str_replace("%s", $this->Grad_End->caption(), $this->Grad_End->RequiredErrorMessage));
            }
        }
        if (!CheckDate($this->Grad_End->FormValue)) {
            $this->Grad_End->addErrorMessage($this->Grad_End->getErrorMessage(false));
        }
        if ($this->Grad_GPA->Required) {
            if (!$this->Grad_GPA->IsDetailKey && EmptyValue($this->Grad_GPA->FormValue)) {
                $this->Grad_GPA->addErrorMessage(str_replace("%s", $this->Grad_GPA->caption(), $this->Grad_GPA->RequiredErrorMessage));
            }
        }
        if ($this->Grad_Honor->Required) {
            if (!$this->Grad_Honor->IsDetailKey && EmptyValue($this->Grad_Honor->FormValue)) {
                $this->Grad_Honor->addErrorMessage(str_replace("%s", $this->Grad_Honor->caption(), $this->Grad_Honor->RequiredErrorMessage));
            }
        }
        if ($this->Grad_Admission->Required) {
            if (!$this->Grad_Admission->IsDetailKey && EmptyValue($this->Grad_Admission->FormValue)) {
                $this->Grad_Admission->addErrorMessage(str_replace("%s", $this->Grad_Admission->caption(), $this->Grad_Admission->RequiredErrorMessage));
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

    // Add record
    protected function addRow($rsold = null)
    {
        global $Language, $Security;
        $conn = $this->getConnection();

        // Load db values from rsold
        $this->loadDbValues($rsold);
        if ($rsold) {
        }
        $rsnew = [];

        // Per_Id
        $this->Per_Id->setDbValueDef($rsnew, $this->Per_Id->CurrentValue, 0, false);

        // Grad_Degree
        $this->Grad_Degree->setDbValueDef($rsnew, $this->Grad_Degree->CurrentValue, "", false);

        // Grad_Major
        $this->Grad_Major->setDbValueDef($rsnew, $this->Grad_Major->CurrentValue, "", false);

        // Grad_ShortDegree
        $this->Grad_ShortDegree->setDbValueDef($rsnew, $this->Grad_ShortDegree->CurrentValue, "", false);

        // Grad_Institution
        $this->Grad_Institution->setDbValueDef($rsnew, $this->Grad_Institution->CurrentValue, "", false);

        // Grad_Provinces
        $this->Grad_Provinces->setDbValueDef($rsnew, $this->Grad_Provinces->CurrentValue, "", false);

        // Grad_Country
        $this->Grad_Country->setDbValueDef($rsnew, $this->Grad_Country->CurrentValue, "", false);

        // Grad_Start
        $this->Grad_Start->setDbValueDef($rsnew, UnFormatDateTime($this->Grad_Start->CurrentValue, 0), CurrentDate(), false);

        // Grad_End
        $this->Grad_End->setDbValueDef($rsnew, UnFormatDateTime($this->Grad_End->CurrentValue, 0), CurrentDate(), false);

        // Grad_GPA
        $this->Grad_GPA->setDbValueDef($rsnew, $this->Grad_GPA->CurrentValue, "", false);

        // Grad_Honor
        $this->Grad_Honor->setDbValueDef($rsnew, $this->Grad_Honor->CurrentValue, "", false);

        // Grad_Admission
        $this->Grad_Admission->setDbValueDef($rsnew, $this->Grad_Admission->CurrentValue, 0, false);

        // Call Row Inserting event
        $insertRow = $this->rowInserting($rsold, $rsnew);
        if ($insertRow) {
            $addRow = $this->insert($rsnew);
            if ($addRow) {
            }
        } else {
            if ($this->getSuccessMessage() != "" || $this->getFailureMessage() != "") {
                // Use the message, do nothing
            } elseif ($this->CancelMessage != "") {
                $this->setFailureMessage($this->CancelMessage);
                $this->CancelMessage = "";
            } else {
                $this->setFailureMessage($Language->phrase("InsertCancelled"));
            }
            $addRow = false;
        }
        if ($addRow) {
            // Call Row Inserted event
            $this->rowInserted($rsold, $rsnew);
        }

        // Clean upload path if any
        if ($addRow) {
        }

        // Write JSON for API request
        if (IsApi() && $addRow) {
            $row = $this->getRecordsFromRecordset([$rsnew], true);
            WriteJson(["success" => true, $this->TableVar => $row]);
        }
        return $addRow;
    }

    // Set up Breadcrumb
    protected function setupBreadcrumb()
    {
        global $Breadcrumb, $Language;
        $Breadcrumb = new Breadcrumb("index");
        $url = CurrentUrl();
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("GraduationList"), "", $this->TableVar, true);
        $pageId = ($this->isCopy()) ? "Copy" : "Add";
        $Breadcrumb->add("add", $pageId, $url);
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
                case "x_Grad_Admission":
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

    // Form Custom Validate event
    public function formCustomValidate(&$customError)
    {
        // Return error message in CustomError
        return true;
    }
}
