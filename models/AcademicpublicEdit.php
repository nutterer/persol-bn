<?php

namespace PHPMaker2021\upPersonnelv2;

use Doctrine\DBAL\ParameterType;

/**
 * Page class
 */
class AcademicpublicEdit extends Academicpublic
{
    use MessagesTrait;

    // Page ID
    public $PageID = "edit";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'academicpublic';

    // Page object name
    public $PageObjName = "AcademicpublicEdit";

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

        // Table object (academicpublic)
        if (!isset($GLOBALS["academicpublic"]) || get_class($GLOBALS["academicpublic"]) == PROJECT_NAMESPACE . "academicpublic") {
            $GLOBALS["academicpublic"] = &$this;
        }

        // Page URL
        $pageUrl = $this->pageUrl();

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'academicpublic');
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
                $doc = new $class(Container("academicpublic"));
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
                    if ($pageName == "AcademicpublicView") {
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
            $key .= @$ar['Public_Id'];
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
            $this->Public_Id->Visible = false;
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
        $this->Public_Id->setVisibility();
        $this->Aca_Id->setVisibility();
        $this->Public_Type->setVisibility();
        $this->Public_Journal->setVisibility();
        $this->Public_Title->setVisibility();
        $this->Public_Date->setVisibility();
        $this->Public_Volum->setVisibility();
        $this->Public_Link->setVisibility();
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
        $this->setupLookupOptions($this->Aca_Id);
        $this->setupLookupOptions($this->Public_Type);

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
            if (($keyValue = Get("Public_Id") ?? Key(0) ?? Route(2)) !== null) {
                $this->Public_Id->setQueryStringValue($keyValue);
                $this->Public_Id->setOldValue($this->Public_Id->QueryStringValue);
            } elseif (Post("Public_Id") !== null) {
                $this->Public_Id->setFormValue(Post("Public_Id"));
                $this->Public_Id->setOldValue($this->Public_Id->FormValue);
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
                if (($keyValue = Get("Public_Id") ?? Route("Public_Id")) !== null) {
                    $this->Public_Id->setQueryStringValue($keyValue);
                    $loadByQuery = true;
                } else {
                    $this->Public_Id->CurrentValue = null;
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
                    $this->terminate("AcademicpublicList"); // No matching record, return to list
                    return;
                }
                break;
            case "update": // Update
                $returnUrl = $this->getReturnUrl();
                if (GetPageName($returnUrl) == "AcademicpublicList") {
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

        // Check field name 'Public_Id' first before field var 'x_Public_Id'
        $val = $CurrentForm->hasValue("Public_Id") ? $CurrentForm->getValue("Public_Id") : $CurrentForm->getValue("x_Public_Id");
        if (!$this->Public_Id->IsDetailKey) {
            $this->Public_Id->setFormValue($val);
        }

        // Check field name 'Aca_Id' first before field var 'x_Aca_Id'
        $val = $CurrentForm->hasValue("Aca_Id") ? $CurrentForm->getValue("Aca_Id") : $CurrentForm->getValue("x_Aca_Id");
        if (!$this->Aca_Id->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->Aca_Id->Visible = false; // Disable update for API request
            } else {
                $this->Aca_Id->setFormValue($val);
            }
        }

        // Check field name 'Public_Type' first before field var 'x_Public_Type'
        $val = $CurrentForm->hasValue("Public_Type") ? $CurrentForm->getValue("Public_Type") : $CurrentForm->getValue("x_Public_Type");
        if (!$this->Public_Type->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->Public_Type->Visible = false; // Disable update for API request
            } else {
                $this->Public_Type->setFormValue($val);
            }
        }

        // Check field name 'Public_Journal' first before field var 'x_Public_Journal'
        $val = $CurrentForm->hasValue("Public_Journal") ? $CurrentForm->getValue("Public_Journal") : $CurrentForm->getValue("x_Public_Journal");
        if (!$this->Public_Journal->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->Public_Journal->Visible = false; // Disable update for API request
            } else {
                $this->Public_Journal->setFormValue($val);
            }
        }

        // Check field name 'Public_Title' first before field var 'x_Public_Title'
        $val = $CurrentForm->hasValue("Public_Title") ? $CurrentForm->getValue("Public_Title") : $CurrentForm->getValue("x_Public_Title");
        if (!$this->Public_Title->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->Public_Title->Visible = false; // Disable update for API request
            } else {
                $this->Public_Title->setFormValue($val);
            }
        }

        // Check field name 'Public_Date' first before field var 'x_Public_Date'
        $val = $CurrentForm->hasValue("Public_Date") ? $CurrentForm->getValue("Public_Date") : $CurrentForm->getValue("x_Public_Date");
        if (!$this->Public_Date->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->Public_Date->Visible = false; // Disable update for API request
            } else {
                $this->Public_Date->setFormValue($val);
            }
            $this->Public_Date->CurrentValue = UnFormatDateTime($this->Public_Date->CurrentValue, 0);
        }

        // Check field name 'Public_Volum' first before field var 'x_Public_Volum'
        $val = $CurrentForm->hasValue("Public_Volum") ? $CurrentForm->getValue("Public_Volum") : $CurrentForm->getValue("x_Public_Volum");
        if (!$this->Public_Volum->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->Public_Volum->Visible = false; // Disable update for API request
            } else {
                $this->Public_Volum->setFormValue($val);
            }
        }

        // Check field name 'Public_Link' first before field var 'x_Public_Link'
        $val = $CurrentForm->hasValue("Public_Link") ? $CurrentForm->getValue("Public_Link") : $CurrentForm->getValue("x_Public_Link");
        if (!$this->Public_Link->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->Public_Link->Visible = false; // Disable update for API request
            } else {
                $this->Public_Link->setFormValue($val);
            }
        }
    }

    // Restore form values
    public function restoreFormValues()
    {
        global $CurrentForm;
        $this->Public_Id->CurrentValue = $this->Public_Id->FormValue;
        $this->Aca_Id->CurrentValue = $this->Aca_Id->FormValue;
        $this->Public_Type->CurrentValue = $this->Public_Type->FormValue;
        $this->Public_Journal->CurrentValue = $this->Public_Journal->FormValue;
        $this->Public_Title->CurrentValue = $this->Public_Title->FormValue;
        $this->Public_Date->CurrentValue = $this->Public_Date->FormValue;
        $this->Public_Date->CurrentValue = UnFormatDateTime($this->Public_Date->CurrentValue, 0);
        $this->Public_Volum->CurrentValue = $this->Public_Volum->FormValue;
        $this->Public_Link->CurrentValue = $this->Public_Link->FormValue;
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
        $this->Public_Id->setDbValue($row['Public_Id']);
        $this->Aca_Id->setDbValue($row['Aca_Id']);
        $this->Public_Type->setDbValue($row['Public_Type']);
        $this->Public_Journal->setDbValue($row['Public_Journal']);
        $this->Public_Title->setDbValue($row['Public_Title']);
        $this->Public_Date->setDbValue($row['Public_Date']);
        $this->Public_Volum->setDbValue($row['Public_Volum']);
        $this->Public_Link->setDbValue($row['Public_Link']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $row = [];
        $row['Public_Id'] = null;
        $row['Aca_Id'] = null;
        $row['Public_Type'] = null;
        $row['Public_Journal'] = null;
        $row['Public_Title'] = null;
        $row['Public_Date'] = null;
        $row['Public_Volum'] = null;
        $row['Public_Link'] = null;
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

        // Public_Id

        // Aca_Id

        // Public_Type

        // Public_Journal

        // Public_Title

        // Public_Date

        // Public_Volum

        // Public_Link
        if ($this->RowType == ROWTYPE_VIEW) {
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
        } elseif ($this->RowType == ROWTYPE_EDIT) {
            // Public_Id
            $this->Public_Id->EditAttrs["class"] = "form-control";
            $this->Public_Id->EditCustomAttributes = "";
            $this->Public_Id->EditValue = $this->Public_Id->CurrentValue;
            $this->Public_Id->ViewCustomAttributes = "";

            // Aca_Id
            $this->Aca_Id->EditAttrs["class"] = "form-control";
            $this->Aca_Id->EditCustomAttributes = "";
            $curVal = trim(strval($this->Aca_Id->CurrentValue));
            if ($curVal != "") {
                $this->Aca_Id->ViewValue = $this->Aca_Id->lookupCacheOption($curVal);
            } else {
                $this->Aca_Id->ViewValue = $this->Aca_Id->Lookup !== null && is_array($this->Aca_Id->Lookup->Options) ? $curVal : null;
            }
            if ($this->Aca_Id->ViewValue !== null) { // Load from cache
                $this->Aca_Id->EditValue = array_values($this->Aca_Id->Lookup->Options);
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "`Aca_Id`" . SearchString("=", $this->Aca_Id->CurrentValue, DATATYPE_NUMBER, "");
                }
                $sqlWrk = $this->Aca_Id->Lookup->getSql(true, $filterWrk, '', $this);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->Aca_Id->EditValue = $arwrk;
            }
            $this->Aca_Id->PlaceHolder = RemoveHtml($this->Aca_Id->caption());

            // Public_Type
            $this->Public_Type->EditAttrs["class"] = "form-control";
            $this->Public_Type->EditCustomAttributes = "";
            $curVal = trim(strval($this->Public_Type->CurrentValue));
            if ($curVal != "") {
                $this->Public_Type->ViewValue = $this->Public_Type->lookupCacheOption($curVal);
            } else {
                $this->Public_Type->ViewValue = $this->Public_Type->Lookup !== null && is_array($this->Public_Type->Lookup->Options) ? $curVal : null;
            }
            if ($this->Public_Type->ViewValue !== null) { // Load from cache
                $this->Public_Type->EditValue = array_values($this->Public_Type->Lookup->Options);
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "`Public_Type_id`" . SearchString("=", $this->Public_Type->CurrentValue, DATATYPE_NUMBER, "");
                }
                $sqlWrk = $this->Public_Type->Lookup->getSql(true, $filterWrk, '', $this);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->Public_Type->EditValue = $arwrk;
            }
            $this->Public_Type->PlaceHolder = RemoveHtml($this->Public_Type->caption());

            // Public_Journal
            $this->Public_Journal->EditAttrs["class"] = "form-control";
            $this->Public_Journal->EditCustomAttributes = "";
            if (!$this->Public_Journal->Raw) {
                $this->Public_Journal->CurrentValue = HtmlDecode($this->Public_Journal->CurrentValue);
            }
            $this->Public_Journal->EditValue = HtmlEncode($this->Public_Journal->CurrentValue);
            $this->Public_Journal->PlaceHolder = RemoveHtml($this->Public_Journal->caption());

            // Public_Title
            $this->Public_Title->EditAttrs["class"] = "form-control";
            $this->Public_Title->EditCustomAttributes = "";
            if (!$this->Public_Title->Raw) {
                $this->Public_Title->CurrentValue = HtmlDecode($this->Public_Title->CurrentValue);
            }
            $this->Public_Title->EditValue = HtmlEncode($this->Public_Title->CurrentValue);
            $this->Public_Title->PlaceHolder = RemoveHtml($this->Public_Title->caption());

            // Public_Date
            $this->Public_Date->EditAttrs["class"] = "form-control";
            $this->Public_Date->EditCustomAttributes = "";
            $this->Public_Date->EditValue = HtmlEncode(FormatDateTime($this->Public_Date->CurrentValue, 8));
            $this->Public_Date->PlaceHolder = RemoveHtml($this->Public_Date->caption());

            // Public_Volum
            $this->Public_Volum->EditAttrs["class"] = "form-control";
            $this->Public_Volum->EditCustomAttributes = "";
            $this->Public_Volum->EditValue = HtmlEncode($this->Public_Volum->CurrentValue);
            $this->Public_Volum->PlaceHolder = RemoveHtml($this->Public_Volum->caption());

            // Public_Link
            $this->Public_Link->EditAttrs["class"] = "form-control";
            $this->Public_Link->EditCustomAttributes = "";
            if (!$this->Public_Link->Raw) {
                $this->Public_Link->CurrentValue = HtmlDecode($this->Public_Link->CurrentValue);
            }
            $this->Public_Link->EditValue = HtmlEncode($this->Public_Link->CurrentValue);
            $this->Public_Link->PlaceHolder = RemoveHtml($this->Public_Link->caption());

            // Edit refer script

            // Public_Id
            $this->Public_Id->LinkCustomAttributes = "";
            $this->Public_Id->HrefValue = "";

            // Aca_Id
            $this->Aca_Id->LinkCustomAttributes = "";
            $this->Aca_Id->HrefValue = "";

            // Public_Type
            $this->Public_Type->LinkCustomAttributes = "";
            $this->Public_Type->HrefValue = "";

            // Public_Journal
            $this->Public_Journal->LinkCustomAttributes = "";
            $this->Public_Journal->HrefValue = "";

            // Public_Title
            $this->Public_Title->LinkCustomAttributes = "";
            $this->Public_Title->HrefValue = "";

            // Public_Date
            $this->Public_Date->LinkCustomAttributes = "";
            $this->Public_Date->HrefValue = "";

            // Public_Volum
            $this->Public_Volum->LinkCustomAttributes = "";
            $this->Public_Volum->HrefValue = "";

            // Public_Link
            $this->Public_Link->LinkCustomAttributes = "";
            $this->Public_Link->HrefValue = "";
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
        if ($this->Public_Id->Required) {
            if (!$this->Public_Id->IsDetailKey && EmptyValue($this->Public_Id->FormValue)) {
                $this->Public_Id->addErrorMessage(str_replace("%s", $this->Public_Id->caption(), $this->Public_Id->RequiredErrorMessage));
            }
        }
        if ($this->Aca_Id->Required) {
            if (!$this->Aca_Id->IsDetailKey && EmptyValue($this->Aca_Id->FormValue)) {
                $this->Aca_Id->addErrorMessage(str_replace("%s", $this->Aca_Id->caption(), $this->Aca_Id->RequiredErrorMessage));
            }
        }
        if ($this->Public_Type->Required) {
            if (!$this->Public_Type->IsDetailKey && EmptyValue($this->Public_Type->FormValue)) {
                $this->Public_Type->addErrorMessage(str_replace("%s", $this->Public_Type->caption(), $this->Public_Type->RequiredErrorMessage));
            }
        }
        if ($this->Public_Journal->Required) {
            if (!$this->Public_Journal->IsDetailKey && EmptyValue($this->Public_Journal->FormValue)) {
                $this->Public_Journal->addErrorMessage(str_replace("%s", $this->Public_Journal->caption(), $this->Public_Journal->RequiredErrorMessage));
            }
        }
        if ($this->Public_Title->Required) {
            if (!$this->Public_Title->IsDetailKey && EmptyValue($this->Public_Title->FormValue)) {
                $this->Public_Title->addErrorMessage(str_replace("%s", $this->Public_Title->caption(), $this->Public_Title->RequiredErrorMessage));
            }
        }
        if ($this->Public_Date->Required) {
            if (!$this->Public_Date->IsDetailKey && EmptyValue($this->Public_Date->FormValue)) {
                $this->Public_Date->addErrorMessage(str_replace("%s", $this->Public_Date->caption(), $this->Public_Date->RequiredErrorMessage));
            }
        }
        if (!CheckDate($this->Public_Date->FormValue)) {
            $this->Public_Date->addErrorMessage($this->Public_Date->getErrorMessage(false));
        }
        if ($this->Public_Volum->Required) {
            if (!$this->Public_Volum->IsDetailKey && EmptyValue($this->Public_Volum->FormValue)) {
                $this->Public_Volum->addErrorMessage(str_replace("%s", $this->Public_Volum->caption(), $this->Public_Volum->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->Public_Volum->FormValue)) {
            $this->Public_Volum->addErrorMessage($this->Public_Volum->getErrorMessage(false));
        }
        if ($this->Public_Link->Required) {
            if (!$this->Public_Link->IsDetailKey && EmptyValue($this->Public_Link->FormValue)) {
                $this->Public_Link->addErrorMessage(str_replace("%s", $this->Public_Link->caption(), $this->Public_Link->RequiredErrorMessage));
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

            // Aca_Id
            $this->Aca_Id->setDbValueDef($rsnew, $this->Aca_Id->CurrentValue, 0, $this->Aca_Id->ReadOnly);

            // Public_Type
            $this->Public_Type->setDbValueDef($rsnew, $this->Public_Type->CurrentValue, 0, $this->Public_Type->ReadOnly);

            // Public_Journal
            $this->Public_Journal->setDbValueDef($rsnew, $this->Public_Journal->CurrentValue, "", $this->Public_Journal->ReadOnly);

            // Public_Title
            $this->Public_Title->setDbValueDef($rsnew, $this->Public_Title->CurrentValue, "", $this->Public_Title->ReadOnly);

            // Public_Date
            $this->Public_Date->setDbValueDef($rsnew, UnFormatDateTime($this->Public_Date->CurrentValue, 0), CurrentDate(), $this->Public_Date->ReadOnly);

            // Public_Volum
            $this->Public_Volum->setDbValueDef($rsnew, $this->Public_Volum->CurrentValue, 0, $this->Public_Volum->ReadOnly);

            // Public_Link
            $this->Public_Link->setDbValueDef($rsnew, $this->Public_Link->CurrentValue, "", $this->Public_Link->ReadOnly);

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
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("AcademicpublicList"), "", $this->TableVar, true);
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
                case "x_Aca_Id":
                    break;
                case "x_Public_Type":
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
