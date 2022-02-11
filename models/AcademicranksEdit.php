<?php

namespace PHPMaker2021\upPersonnel;

use Doctrine\DBAL\ParameterType;

/**
 * Page class
 */
class AcademicranksEdit extends Academicranks
{
    use MessagesTrait;

    // Page ID
    public $PageID = "edit";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'academicranks';

    // Page object name
    public $PageObjName = "AcademicranksEdit";

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

        // Table object (academicranks)
        if (!isset($GLOBALS["academicranks"]) || get_class($GLOBALS["academicranks"]) == PROJECT_NAMESPACE . "academicranks") {
            $GLOBALS["academicranks"] = &$this;
        }

        // Page URL
        $pageUrl = $this->pageUrl();

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'academicranks');
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
                $doc = new $class(Container("academicranks"));
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
                    if ($pageName == "AcademicranksView") {
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
            $key .= @$ar['Aca_Id'];
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
            $this->Aca_Id->Visible = false;
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
        $this->Aca_Id->setVisibility();
        $this->Per_Id->setVisibility();
        $this->Aca_RequesDate->setVisibility();
        $this->Aca_AcceptDate->setVisibility();
        $this->Aca_EstimateStart->setVisibility();
        $this->Aca_EstimateEnd->setVisibility();
        $this->Aca_Name->setVisibility();
        $this->Aca_Status->setVisibility();
        $this->Aca_SkillMajor->setVisibility();
        $this->Aca_Report->setVisibility();
        $this->Aca_EstimateTeaching->setVisibility();
        $this->Aca_EstimateBook->setVisibility();
        $this->Aca_EstimateNum->setVisibility();
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
            if (($keyValue = Get("Aca_Id") ?? Key(0) ?? Route(2)) !== null) {
                $this->Aca_Id->setQueryStringValue($keyValue);
                $this->Aca_Id->setOldValue($this->Aca_Id->QueryStringValue);
            } elseif (Post("Aca_Id") !== null) {
                $this->Aca_Id->setFormValue(Post("Aca_Id"));
                $this->Aca_Id->setOldValue($this->Aca_Id->FormValue);
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
                if (($keyValue = Get("Aca_Id") ?? Route("Aca_Id")) !== null) {
                    $this->Aca_Id->setQueryStringValue($keyValue);
                    $loadByQuery = true;
                } else {
                    $this->Aca_Id->CurrentValue = null;
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
                    $this->terminate("AcademicranksList"); // No matching record, return to list
                    return;
                }
                break;
            case "update": // Update
                $returnUrl = $this->getReturnUrl();
                if (GetPageName($returnUrl) == "AcademicranksList") {
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

        // Check field name 'Aca_Id' first before field var 'x_Aca_Id'
        $val = $CurrentForm->hasValue("Aca_Id") ? $CurrentForm->getValue("Aca_Id") : $CurrentForm->getValue("x_Aca_Id");
        if (!$this->Aca_Id->IsDetailKey) {
            $this->Aca_Id->setFormValue($val);
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

        // Check field name 'Aca_RequesDate' first before field var 'x_Aca_RequesDate'
        $val = $CurrentForm->hasValue("Aca_RequesDate") ? $CurrentForm->getValue("Aca_RequesDate") : $CurrentForm->getValue("x_Aca_RequesDate");
        if (!$this->Aca_RequesDate->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->Aca_RequesDate->Visible = false; // Disable update for API request
            } else {
                $this->Aca_RequesDate->setFormValue($val);
            }
            $this->Aca_RequesDate->CurrentValue = UnFormatDateTime($this->Aca_RequesDate->CurrentValue, 0);
        }

        // Check field name 'Aca_AcceptDate' first before field var 'x_Aca_AcceptDate'
        $val = $CurrentForm->hasValue("Aca_AcceptDate") ? $CurrentForm->getValue("Aca_AcceptDate") : $CurrentForm->getValue("x_Aca_AcceptDate");
        if (!$this->Aca_AcceptDate->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->Aca_AcceptDate->Visible = false; // Disable update for API request
            } else {
                $this->Aca_AcceptDate->setFormValue($val);
            }
            $this->Aca_AcceptDate->CurrentValue = UnFormatDateTime($this->Aca_AcceptDate->CurrentValue, 0);
        }

        // Check field name 'Aca_EstimateStart' first before field var 'x_Aca_EstimateStart'
        $val = $CurrentForm->hasValue("Aca_EstimateStart") ? $CurrentForm->getValue("Aca_EstimateStart") : $CurrentForm->getValue("x_Aca_EstimateStart");
        if (!$this->Aca_EstimateStart->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->Aca_EstimateStart->Visible = false; // Disable update for API request
            } else {
                $this->Aca_EstimateStart->setFormValue($val);
            }
            $this->Aca_EstimateStart->CurrentValue = UnFormatDateTime($this->Aca_EstimateStart->CurrentValue, 0);
        }

        // Check field name 'Aca_EstimateEnd' first before field var 'x_Aca_EstimateEnd'
        $val = $CurrentForm->hasValue("Aca_EstimateEnd") ? $CurrentForm->getValue("Aca_EstimateEnd") : $CurrentForm->getValue("x_Aca_EstimateEnd");
        if (!$this->Aca_EstimateEnd->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->Aca_EstimateEnd->Visible = false; // Disable update for API request
            } else {
                $this->Aca_EstimateEnd->setFormValue($val);
            }
            $this->Aca_EstimateEnd->CurrentValue = UnFormatDateTime($this->Aca_EstimateEnd->CurrentValue, 0);
        }

        // Check field name 'Aca_Name' first before field var 'x_Aca_Name'
        $val = $CurrentForm->hasValue("Aca_Name") ? $CurrentForm->getValue("Aca_Name") : $CurrentForm->getValue("x_Aca_Name");
        if (!$this->Aca_Name->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->Aca_Name->Visible = false; // Disable update for API request
            } else {
                $this->Aca_Name->setFormValue($val);
            }
        }

        // Check field name 'Aca_Status' first before field var 'x_Aca_Status'
        $val = $CurrentForm->hasValue("Aca_Status") ? $CurrentForm->getValue("Aca_Status") : $CurrentForm->getValue("x_Aca_Status");
        if (!$this->Aca_Status->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->Aca_Status->Visible = false; // Disable update for API request
            } else {
                $this->Aca_Status->setFormValue($val);
            }
        }

        // Check field name 'Aca_SkillMajor' first before field var 'x_Aca_SkillMajor'
        $val = $CurrentForm->hasValue("Aca_SkillMajor") ? $CurrentForm->getValue("Aca_SkillMajor") : $CurrentForm->getValue("x_Aca_SkillMajor");
        if (!$this->Aca_SkillMajor->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->Aca_SkillMajor->Visible = false; // Disable update for API request
            } else {
                $this->Aca_SkillMajor->setFormValue($val);
            }
        }

        // Check field name 'Aca_Report' first before field var 'x_Aca_Report'
        $val = $CurrentForm->hasValue("Aca_Report") ? $CurrentForm->getValue("Aca_Report") : $CurrentForm->getValue("x_Aca_Report");
        if (!$this->Aca_Report->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->Aca_Report->Visible = false; // Disable update for API request
            } else {
                $this->Aca_Report->setFormValue($val);
            }
            $this->Aca_Report->CurrentValue = UnFormatDateTime($this->Aca_Report->CurrentValue, 0);
        }

        // Check field name 'Aca_EstimateTeaching' first before field var 'x_Aca_EstimateTeaching'
        $val = $CurrentForm->hasValue("Aca_EstimateTeaching") ? $CurrentForm->getValue("Aca_EstimateTeaching") : $CurrentForm->getValue("x_Aca_EstimateTeaching");
        if (!$this->Aca_EstimateTeaching->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->Aca_EstimateTeaching->Visible = false; // Disable update for API request
            } else {
                $this->Aca_EstimateTeaching->setFormValue($val);
            }
        }

        // Check field name 'Aca_EstimateBook' first before field var 'x_Aca_EstimateBook'
        $val = $CurrentForm->hasValue("Aca_EstimateBook") ? $CurrentForm->getValue("Aca_EstimateBook") : $CurrentForm->getValue("x_Aca_EstimateBook");
        if (!$this->Aca_EstimateBook->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->Aca_EstimateBook->Visible = false; // Disable update for API request
            } else {
                $this->Aca_EstimateBook->setFormValue($val);
            }
        }

        // Check field name 'Aca_EstimateNum' first before field var 'x_Aca_EstimateNum'
        $val = $CurrentForm->hasValue("Aca_EstimateNum") ? $CurrentForm->getValue("Aca_EstimateNum") : $CurrentForm->getValue("x_Aca_EstimateNum");
        if (!$this->Aca_EstimateNum->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->Aca_EstimateNum->Visible = false; // Disable update for API request
            } else {
                $this->Aca_EstimateNum->setFormValue($val);
            }
        }
    }

    // Restore form values
    public function restoreFormValues()
    {
        global $CurrentForm;
        $this->Aca_Id->CurrentValue = $this->Aca_Id->FormValue;
        $this->Per_Id->CurrentValue = $this->Per_Id->FormValue;
        $this->Aca_RequesDate->CurrentValue = $this->Aca_RequesDate->FormValue;
        $this->Aca_RequesDate->CurrentValue = UnFormatDateTime($this->Aca_RequesDate->CurrentValue, 0);
        $this->Aca_AcceptDate->CurrentValue = $this->Aca_AcceptDate->FormValue;
        $this->Aca_AcceptDate->CurrentValue = UnFormatDateTime($this->Aca_AcceptDate->CurrentValue, 0);
        $this->Aca_EstimateStart->CurrentValue = $this->Aca_EstimateStart->FormValue;
        $this->Aca_EstimateStart->CurrentValue = UnFormatDateTime($this->Aca_EstimateStart->CurrentValue, 0);
        $this->Aca_EstimateEnd->CurrentValue = $this->Aca_EstimateEnd->FormValue;
        $this->Aca_EstimateEnd->CurrentValue = UnFormatDateTime($this->Aca_EstimateEnd->CurrentValue, 0);
        $this->Aca_Name->CurrentValue = $this->Aca_Name->FormValue;
        $this->Aca_Status->CurrentValue = $this->Aca_Status->FormValue;
        $this->Aca_SkillMajor->CurrentValue = $this->Aca_SkillMajor->FormValue;
        $this->Aca_Report->CurrentValue = $this->Aca_Report->FormValue;
        $this->Aca_Report->CurrentValue = UnFormatDateTime($this->Aca_Report->CurrentValue, 0);
        $this->Aca_EstimateTeaching->CurrentValue = $this->Aca_EstimateTeaching->FormValue;
        $this->Aca_EstimateBook->CurrentValue = $this->Aca_EstimateBook->FormValue;
        $this->Aca_EstimateNum->CurrentValue = $this->Aca_EstimateNum->FormValue;
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

    // Return a row with default values
    protected function newRow()
    {
        $row = [];
        $row['Aca_Id'] = null;
        $row['Per_Id'] = null;
        $row['Aca_RequesDate'] = null;
        $row['Aca_AcceptDate'] = null;
        $row['Aca_EstimateStart'] = null;
        $row['Aca_EstimateEnd'] = null;
        $row['Aca_Name'] = null;
        $row['Aca_Status'] = null;
        $row['Aca_SkillMajor'] = null;
        $row['Aca_Report'] = null;
        $row['Aca_EstimateTeaching'] = null;
        $row['Aca_EstimateBook'] = null;
        $row['Aca_EstimateNum'] = null;
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
        if ($this->RowType == ROWTYPE_VIEW) {
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
        } elseif ($this->RowType == ROWTYPE_EDIT) {
            // Aca_Id
            $this->Aca_Id->EditAttrs["class"] = "form-control";
            $this->Aca_Id->EditCustomAttributes = "";
            $this->Aca_Id->EditValue = $this->Aca_Id->CurrentValue;
            $this->Aca_Id->ViewCustomAttributes = "";

            // Per_Id
            $this->Per_Id->EditAttrs["class"] = "form-control";
            $this->Per_Id->EditCustomAttributes = "";
            $this->Per_Id->EditValue = HtmlEncode($this->Per_Id->CurrentValue);
            $this->Per_Id->PlaceHolder = RemoveHtml($this->Per_Id->caption());

            // Aca_RequesDate
            $this->Aca_RequesDate->EditAttrs["class"] = "form-control";
            $this->Aca_RequesDate->EditCustomAttributes = "";
            $this->Aca_RequesDate->EditValue = HtmlEncode(FormatDateTime($this->Aca_RequesDate->CurrentValue, 8));
            $this->Aca_RequesDate->PlaceHolder = RemoveHtml($this->Aca_RequesDate->caption());

            // Aca_AcceptDate
            $this->Aca_AcceptDate->EditAttrs["class"] = "form-control";
            $this->Aca_AcceptDate->EditCustomAttributes = "";
            $this->Aca_AcceptDate->EditValue = HtmlEncode(FormatDateTime($this->Aca_AcceptDate->CurrentValue, 8));
            $this->Aca_AcceptDate->PlaceHolder = RemoveHtml($this->Aca_AcceptDate->caption());

            // Aca_EstimateStart
            $this->Aca_EstimateStart->EditAttrs["class"] = "form-control";
            $this->Aca_EstimateStart->EditCustomAttributes = "";
            $this->Aca_EstimateStart->EditValue = HtmlEncode(FormatDateTime($this->Aca_EstimateStart->CurrentValue, 8));
            $this->Aca_EstimateStart->PlaceHolder = RemoveHtml($this->Aca_EstimateStart->caption());

            // Aca_EstimateEnd
            $this->Aca_EstimateEnd->EditAttrs["class"] = "form-control";
            $this->Aca_EstimateEnd->EditCustomAttributes = "";
            $this->Aca_EstimateEnd->EditValue = HtmlEncode(FormatDateTime($this->Aca_EstimateEnd->CurrentValue, 8));
            $this->Aca_EstimateEnd->PlaceHolder = RemoveHtml($this->Aca_EstimateEnd->caption());

            // Aca_Name
            $this->Aca_Name->EditAttrs["class"] = "form-control";
            $this->Aca_Name->EditCustomAttributes = "";
            if (!$this->Aca_Name->Raw) {
                $this->Aca_Name->CurrentValue = HtmlDecode($this->Aca_Name->CurrentValue);
            }
            $this->Aca_Name->EditValue = HtmlEncode($this->Aca_Name->CurrentValue);
            $this->Aca_Name->PlaceHolder = RemoveHtml($this->Aca_Name->caption());

            // Aca_Status
            $this->Aca_Status->EditAttrs["class"] = "form-control";
            $this->Aca_Status->EditCustomAttributes = "";
            if (!$this->Aca_Status->Raw) {
                $this->Aca_Status->CurrentValue = HtmlDecode($this->Aca_Status->CurrentValue);
            }
            $this->Aca_Status->EditValue = HtmlEncode($this->Aca_Status->CurrentValue);
            $this->Aca_Status->PlaceHolder = RemoveHtml($this->Aca_Status->caption());

            // Aca_SkillMajor
            $this->Aca_SkillMajor->EditAttrs["class"] = "form-control";
            $this->Aca_SkillMajor->EditCustomAttributes = "";
            if (!$this->Aca_SkillMajor->Raw) {
                $this->Aca_SkillMajor->CurrentValue = HtmlDecode($this->Aca_SkillMajor->CurrentValue);
            }
            $this->Aca_SkillMajor->EditValue = HtmlEncode($this->Aca_SkillMajor->CurrentValue);
            $this->Aca_SkillMajor->PlaceHolder = RemoveHtml($this->Aca_SkillMajor->caption());

            // Aca_Report
            $this->Aca_Report->EditAttrs["class"] = "form-control";
            $this->Aca_Report->EditCustomAttributes = "";
            $this->Aca_Report->EditValue = HtmlEncode(FormatDateTime($this->Aca_Report->CurrentValue, 8));
            $this->Aca_Report->PlaceHolder = RemoveHtml($this->Aca_Report->caption());

            // Aca_EstimateTeaching
            $this->Aca_EstimateTeaching->EditAttrs["class"] = "form-control";
            $this->Aca_EstimateTeaching->EditCustomAttributes = "";
            if (!$this->Aca_EstimateTeaching->Raw) {
                $this->Aca_EstimateTeaching->CurrentValue = HtmlDecode($this->Aca_EstimateTeaching->CurrentValue);
            }
            $this->Aca_EstimateTeaching->EditValue = HtmlEncode($this->Aca_EstimateTeaching->CurrentValue);
            $this->Aca_EstimateTeaching->PlaceHolder = RemoveHtml($this->Aca_EstimateTeaching->caption());

            // Aca_EstimateBook
            $this->Aca_EstimateBook->EditAttrs["class"] = "form-control";
            $this->Aca_EstimateBook->EditCustomAttributes = "";
            if (!$this->Aca_EstimateBook->Raw) {
                $this->Aca_EstimateBook->CurrentValue = HtmlDecode($this->Aca_EstimateBook->CurrentValue);
            }
            $this->Aca_EstimateBook->EditValue = HtmlEncode($this->Aca_EstimateBook->CurrentValue);
            $this->Aca_EstimateBook->PlaceHolder = RemoveHtml($this->Aca_EstimateBook->caption());

            // Aca_EstimateNum
            $this->Aca_EstimateNum->EditAttrs["class"] = "form-control";
            $this->Aca_EstimateNum->EditCustomAttributes = "";
            if (!$this->Aca_EstimateNum->Raw) {
                $this->Aca_EstimateNum->CurrentValue = HtmlDecode($this->Aca_EstimateNum->CurrentValue);
            }
            $this->Aca_EstimateNum->EditValue = HtmlEncode($this->Aca_EstimateNum->CurrentValue);
            $this->Aca_EstimateNum->PlaceHolder = RemoveHtml($this->Aca_EstimateNum->caption());

            // Edit refer script

            // Aca_Id
            $this->Aca_Id->LinkCustomAttributes = "";
            $this->Aca_Id->HrefValue = "";

            // Per_Id
            $this->Per_Id->LinkCustomAttributes = "";
            $this->Per_Id->HrefValue = "";

            // Aca_RequesDate
            $this->Aca_RequesDate->LinkCustomAttributes = "";
            $this->Aca_RequesDate->HrefValue = "";

            // Aca_AcceptDate
            $this->Aca_AcceptDate->LinkCustomAttributes = "";
            $this->Aca_AcceptDate->HrefValue = "";

            // Aca_EstimateStart
            $this->Aca_EstimateStart->LinkCustomAttributes = "";
            $this->Aca_EstimateStart->HrefValue = "";

            // Aca_EstimateEnd
            $this->Aca_EstimateEnd->LinkCustomAttributes = "";
            $this->Aca_EstimateEnd->HrefValue = "";

            // Aca_Name
            $this->Aca_Name->LinkCustomAttributes = "";
            $this->Aca_Name->HrefValue = "";

            // Aca_Status
            $this->Aca_Status->LinkCustomAttributes = "";
            $this->Aca_Status->HrefValue = "";

            // Aca_SkillMajor
            $this->Aca_SkillMajor->LinkCustomAttributes = "";
            $this->Aca_SkillMajor->HrefValue = "";

            // Aca_Report
            $this->Aca_Report->LinkCustomAttributes = "";
            $this->Aca_Report->HrefValue = "";

            // Aca_EstimateTeaching
            $this->Aca_EstimateTeaching->LinkCustomAttributes = "";
            $this->Aca_EstimateTeaching->HrefValue = "";

            // Aca_EstimateBook
            $this->Aca_EstimateBook->LinkCustomAttributes = "";
            $this->Aca_EstimateBook->HrefValue = "";

            // Aca_EstimateNum
            $this->Aca_EstimateNum->LinkCustomAttributes = "";
            $this->Aca_EstimateNum->HrefValue = "";
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
        if ($this->Aca_Id->Required) {
            if (!$this->Aca_Id->IsDetailKey && EmptyValue($this->Aca_Id->FormValue)) {
                $this->Aca_Id->addErrorMessage(str_replace("%s", $this->Aca_Id->caption(), $this->Aca_Id->RequiredErrorMessage));
            }
        }
        if ($this->Per_Id->Required) {
            if (!$this->Per_Id->IsDetailKey && EmptyValue($this->Per_Id->FormValue)) {
                $this->Per_Id->addErrorMessage(str_replace("%s", $this->Per_Id->caption(), $this->Per_Id->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->Per_Id->FormValue)) {
            $this->Per_Id->addErrorMessage($this->Per_Id->getErrorMessage(false));
        }
        if ($this->Aca_RequesDate->Required) {
            if (!$this->Aca_RequesDate->IsDetailKey && EmptyValue($this->Aca_RequesDate->FormValue)) {
                $this->Aca_RequesDate->addErrorMessage(str_replace("%s", $this->Aca_RequesDate->caption(), $this->Aca_RequesDate->RequiredErrorMessage));
            }
        }
        if (!CheckDate($this->Aca_RequesDate->FormValue)) {
            $this->Aca_RequesDate->addErrorMessage($this->Aca_RequesDate->getErrorMessage(false));
        }
        if ($this->Aca_AcceptDate->Required) {
            if (!$this->Aca_AcceptDate->IsDetailKey && EmptyValue($this->Aca_AcceptDate->FormValue)) {
                $this->Aca_AcceptDate->addErrorMessage(str_replace("%s", $this->Aca_AcceptDate->caption(), $this->Aca_AcceptDate->RequiredErrorMessage));
            }
        }
        if (!CheckDate($this->Aca_AcceptDate->FormValue)) {
            $this->Aca_AcceptDate->addErrorMessage($this->Aca_AcceptDate->getErrorMessage(false));
        }
        if ($this->Aca_EstimateStart->Required) {
            if (!$this->Aca_EstimateStart->IsDetailKey && EmptyValue($this->Aca_EstimateStart->FormValue)) {
                $this->Aca_EstimateStart->addErrorMessage(str_replace("%s", $this->Aca_EstimateStart->caption(), $this->Aca_EstimateStart->RequiredErrorMessage));
            }
        }
        if (!CheckDate($this->Aca_EstimateStart->FormValue)) {
            $this->Aca_EstimateStart->addErrorMessage($this->Aca_EstimateStart->getErrorMessage(false));
        }
        if ($this->Aca_EstimateEnd->Required) {
            if (!$this->Aca_EstimateEnd->IsDetailKey && EmptyValue($this->Aca_EstimateEnd->FormValue)) {
                $this->Aca_EstimateEnd->addErrorMessage(str_replace("%s", $this->Aca_EstimateEnd->caption(), $this->Aca_EstimateEnd->RequiredErrorMessage));
            }
        }
        if (!CheckDate($this->Aca_EstimateEnd->FormValue)) {
            $this->Aca_EstimateEnd->addErrorMessage($this->Aca_EstimateEnd->getErrorMessage(false));
        }
        if ($this->Aca_Name->Required) {
            if (!$this->Aca_Name->IsDetailKey && EmptyValue($this->Aca_Name->FormValue)) {
                $this->Aca_Name->addErrorMessage(str_replace("%s", $this->Aca_Name->caption(), $this->Aca_Name->RequiredErrorMessage));
            }
        }
        if ($this->Aca_Status->Required) {
            if (!$this->Aca_Status->IsDetailKey && EmptyValue($this->Aca_Status->FormValue)) {
                $this->Aca_Status->addErrorMessage(str_replace("%s", $this->Aca_Status->caption(), $this->Aca_Status->RequiredErrorMessage));
            }
        }
        if ($this->Aca_SkillMajor->Required) {
            if (!$this->Aca_SkillMajor->IsDetailKey && EmptyValue($this->Aca_SkillMajor->FormValue)) {
                $this->Aca_SkillMajor->addErrorMessage(str_replace("%s", $this->Aca_SkillMajor->caption(), $this->Aca_SkillMajor->RequiredErrorMessage));
            }
        }
        if ($this->Aca_Report->Required) {
            if (!$this->Aca_Report->IsDetailKey && EmptyValue($this->Aca_Report->FormValue)) {
                $this->Aca_Report->addErrorMessage(str_replace("%s", $this->Aca_Report->caption(), $this->Aca_Report->RequiredErrorMessage));
            }
        }
        if (!CheckDate($this->Aca_Report->FormValue)) {
            $this->Aca_Report->addErrorMessage($this->Aca_Report->getErrorMessage(false));
        }
        if ($this->Aca_EstimateTeaching->Required) {
            if (!$this->Aca_EstimateTeaching->IsDetailKey && EmptyValue($this->Aca_EstimateTeaching->FormValue)) {
                $this->Aca_EstimateTeaching->addErrorMessage(str_replace("%s", $this->Aca_EstimateTeaching->caption(), $this->Aca_EstimateTeaching->RequiredErrorMessage));
            }
        }
        if ($this->Aca_EstimateBook->Required) {
            if (!$this->Aca_EstimateBook->IsDetailKey && EmptyValue($this->Aca_EstimateBook->FormValue)) {
                $this->Aca_EstimateBook->addErrorMessage(str_replace("%s", $this->Aca_EstimateBook->caption(), $this->Aca_EstimateBook->RequiredErrorMessage));
            }
        }
        if ($this->Aca_EstimateNum->Required) {
            if (!$this->Aca_EstimateNum->IsDetailKey && EmptyValue($this->Aca_EstimateNum->FormValue)) {
                $this->Aca_EstimateNum->addErrorMessage(str_replace("%s", $this->Aca_EstimateNum->caption(), $this->Aca_EstimateNum->RequiredErrorMessage));
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

            // Aca_RequesDate
            $this->Aca_RequesDate->setDbValueDef($rsnew, UnFormatDateTime($this->Aca_RequesDate->CurrentValue, 0), CurrentDate(), $this->Aca_RequesDate->ReadOnly);

            // Aca_AcceptDate
            $this->Aca_AcceptDate->setDbValueDef($rsnew, UnFormatDateTime($this->Aca_AcceptDate->CurrentValue, 0), CurrentDate(), $this->Aca_AcceptDate->ReadOnly);

            // Aca_EstimateStart
            $this->Aca_EstimateStart->setDbValueDef($rsnew, UnFormatDateTime($this->Aca_EstimateStart->CurrentValue, 0), CurrentDate(), $this->Aca_EstimateStart->ReadOnly);

            // Aca_EstimateEnd
            $this->Aca_EstimateEnd->setDbValueDef($rsnew, UnFormatDateTime($this->Aca_EstimateEnd->CurrentValue, 0), CurrentDate(), $this->Aca_EstimateEnd->ReadOnly);

            // Aca_Name
            $this->Aca_Name->setDbValueDef($rsnew, $this->Aca_Name->CurrentValue, "", $this->Aca_Name->ReadOnly);

            // Aca_Status
            $this->Aca_Status->setDbValueDef($rsnew, $this->Aca_Status->CurrentValue, "", $this->Aca_Status->ReadOnly);

            // Aca_SkillMajor
            $this->Aca_SkillMajor->setDbValueDef($rsnew, $this->Aca_SkillMajor->CurrentValue, "", $this->Aca_SkillMajor->ReadOnly);

            // Aca_Report
            $this->Aca_Report->setDbValueDef($rsnew, UnFormatDateTime($this->Aca_Report->CurrentValue, 0), CurrentDate(), $this->Aca_Report->ReadOnly);

            // Aca_EstimateTeaching
            $this->Aca_EstimateTeaching->setDbValueDef($rsnew, $this->Aca_EstimateTeaching->CurrentValue, "", $this->Aca_EstimateTeaching->ReadOnly);

            // Aca_EstimateBook
            $this->Aca_EstimateBook->setDbValueDef($rsnew, $this->Aca_EstimateBook->CurrentValue, "", $this->Aca_EstimateBook->ReadOnly);

            // Aca_EstimateNum
            $this->Aca_EstimateNum->setDbValueDef($rsnew, $this->Aca_EstimateNum->CurrentValue, "", $this->Aca_EstimateNum->ReadOnly);

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
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("AcademicranksList"), "", $this->TableVar, true);
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
