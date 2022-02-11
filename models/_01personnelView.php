<?php

namespace PHPMaker2021\upPersonnelv2;

use Doctrine\DBAL\ParameterType;

/**
 * Page class
 */
class _01personnelView extends _01personnel
{
    use MessagesTrait;

    // Page ID
    public $PageID = "view";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = '01-personnel';

    // Page object name
    public $PageObjName = "_01personnelView";

    // Rendering View
    public $RenderingView = false;

    // Page URLs
    public $AddUrl;
    public $EditUrl;
    public $CopyUrl;
    public $DeleteUrl;
    public $ViewUrl;
    public $ListUrl;

    // Export URLs
    public $ExportPrintUrl;
    public $ExportHtmlUrl;
    public $ExportExcelUrl;
    public $ExportWordUrl;
    public $ExportXmlUrl;
    public $ExportCsvUrl;
    public $ExportPdfUrl;

    // Custom export
    public $ExportExcelCustom = false;
    public $ExportWordCustom = false;
    public $ExportPdfCustom = false;
    public $ExportEmailCustom = false;

    // Update URLs
    public $InlineAddUrl;
    public $InlineCopyUrl;
    public $InlineEditUrl;
    public $GridAddUrl;
    public $GridEditUrl;
    public $MultiDeleteUrl;
    public $MultiUpdateUrl;

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
        if (($keyValue = Get("Per_Id") ?? Route("Per_Id")) !== null) {
            $this->RecKey["Per_Id"] = $keyValue;
        }
        $this->ExportPrintUrl = $pageUrl . "export=print";
        $this->ExportHtmlUrl = $pageUrl . "export=html";
        $this->ExportExcelUrl = $pageUrl . "export=excel";
        $this->ExportWordUrl = $pageUrl . "export=word";
        $this->ExportXmlUrl = $pageUrl . "export=xml";
        $this->ExportCsvUrl = $pageUrl . "export=csv";
        $this->ExportPdfUrl = $pageUrl . "export=pdf";

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

        // Export options
        $this->ExportOptions = new ListOptions("div");
        $this->ExportOptions->TagClassName = "ew-export-option";

        // Other options
        if (!$this->OtherOptions) {
            $this->OtherOptions = new ListOptionsArray();
        }
        $this->OtherOptions["action"] = new ListOptions("div");
        $this->OtherOptions["action"]->TagClassName = "ew-action-option";
        $this->OtherOptions["detail"] = new ListOptions("div");
        $this->OtherOptions["detail"]->TagClassName = "ew-detail-option";
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
    public $ExportOptions; // Export options
    public $OtherOptions; // Other options
    public $DisplayRecords = 1;
    public $DbMasterFilter;
    public $DbDetailFilter;
    public $StartRecord;
    public $StopRecord;
    public $TotalRecords = 0;
    public $RecordRange = 10;
    public $RecKey = [];
    public $IsModal = false;

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

        // Get export parameters
        $custom = "";
        if (Param("export") !== null) {
            $this->Export = Param("export");
            $custom = Param("custom", "");
        } elseif (IsPost()) {
            if (Post("exporttype") !== null) {
                $this->Export = Post("exporttype");
            }
            $custom = Post("custom", "");
        } elseif (Get("cmd") == "json") {
            $this->Export = Get("cmd");
        } else {
            $this->setExportReturnUrl(CurrentUrl());
        }
        $ExportFileName = $this->TableVar; // Get export file, used in header
        if (Get("Per_Id") !== null) {
            if ($ExportFileName != "") {
                $ExportFileName .= "_";
            }
            $ExportFileName .= Get("Per_Id");
        }

        // Get custom export parameters
        if ($this->isExport() && $custom != "") {
            $this->CustomExport = $this->Export;
            $this->Export = "print";
        }
        $CustomExportType = $this->CustomExport;
        $ExportType = $this->Export; // Get export parameter, used in header

        // Update Export URLs
        if (Config("USE_PHPEXCEL")) {
            $this->ExportExcelCustom = false;
        }
        if (Config("USE_PHPWORD")) {
            $this->ExportWordCustom = false;
        }
        if ($this->ExportExcelCustom) {
            $this->ExportExcelUrl .= "&amp;custom=1";
        }
        if ($this->ExportWordCustom) {
            $this->ExportWordUrl .= "&amp;custom=1";
        }
        if ($this->ExportPdfCustom) {
            $this->ExportPdfUrl .= "&amp;custom=1";
        }
        $this->CurrentAction = Param("action"); // Set up current action

        // Setup export options
        $this->setupExportOptions();
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

        // Load current record
        $loadCurrentRecord = false;
        $returnUrl = "";
        $matchRecord = false;
        if ($this->isPageRequest()) { // Validate request
            if (($keyValue = Get("Per_Id") ?? Route("Per_Id")) !== null) {
                $this->Per_Id->setQueryStringValue($keyValue);
                $this->RecKey["Per_Id"] = $this->Per_Id->QueryStringValue;
            } elseif (Post("Per_Id") !== null) {
                $this->Per_Id->setFormValue(Post("Per_Id"));
                $this->RecKey["Per_Id"] = $this->Per_Id->FormValue;
            } elseif (IsApi() && ($keyValue = Key(0) ?? Route(2)) !== null) {
                $this->Per_Id->setQueryStringValue($keyValue);
                $this->RecKey["Per_Id"] = $this->Per_Id->QueryStringValue;
            } else {
                $returnUrl = "_01personnelList"; // Return to list
            }

            // Get action
            $this->CurrentAction = "show"; // Display
            switch ($this->CurrentAction) {
                case "show": // Get a record to display

                    // Load record based on key
                    if (IsApi()) {
                        $filter = $this->getRecordFilter();
                        $this->CurrentFilter = $filter;
                        $sql = $this->getCurrentSql();
                        $conn = $this->getConnection();
                        $this->Recordset = LoadRecordset($sql, $conn);
                        $res = $this->Recordset && !$this->Recordset->EOF;
                    } else {
                        $res = $this->loadRow();
                    }
                    if (!$res) { // Load record based on key
                        if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "") {
                            $this->setFailureMessage($Language->phrase("NoRecord")); // Set no record message
                        }
                        $returnUrl = "_01personnelList"; // No matching record, return to list
                    }
                    break;
            }

            // Export data only
            if (!$this->CustomExport && in_array($this->Export, array_keys(Config("EXPORT_CLASSES")))) {
                $this->exportData();
                $this->terminate();
                return;
            }
        } else {
            $returnUrl = "_01personnelList"; // Not page request, return to list
        }
        if ($returnUrl != "") {
            $this->terminate($returnUrl);
            return;
        }

        // Set up Breadcrumb
        if (!$this->isExport()) {
            $this->setupBreadcrumb();
        }

        // Render row
        $this->RowType = ROWTYPE_VIEW;
        $this->resetAttributes();
        $this->renderRow();

        // Normal return
        if (IsApi()) {
            $rows = $this->getRecordsFromRecordset($this->Recordset, true); // Get current record only
            $this->Recordset->close();
            WriteJson(["success" => true, $this->TableVar => $rows]);
            $this->terminate(true);
            return;
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

    // Set up other options
    protected function setupOtherOptions()
    {
        global $Language, $Security;
        $options = &$this->OtherOptions;
        $option = $options["action"];

        // Add
        $item = &$option->add("add");
        $addcaption = HtmlTitle($Language->phrase("ViewPageAddLink"));
        if ($this->IsModal) {
            $item->Body = "<a class=\"ew-action ew-add\" title=\"" . $addcaption . "\" data-caption=\"" . $addcaption . "\" href=\"#\" onclick=\"return ew.modalDialogShow({lnk:this,url:'" . HtmlEncode(GetUrl($this->AddUrl)) . "'});\">" . $Language->phrase("ViewPageAddLink") . "</a>";
        } else {
            $item->Body = "<a class=\"ew-action ew-add\" title=\"" . $addcaption . "\" data-caption=\"" . $addcaption . "\" href=\"" . HtmlEncode(GetUrl($this->AddUrl)) . "\">" . $Language->phrase("ViewPageAddLink") . "</a>";
        }
        $item->Visible = ($this->AddUrl != "" && $Security->canAdd());

        // Edit
        $item = &$option->add("edit");
        $editcaption = HtmlTitle($Language->phrase("ViewPageEditLink"));
        if ($this->IsModal) {
            $item->Body = "<a class=\"ew-action ew-edit\" title=\"" . $editcaption . "\" data-caption=\"" . $editcaption . "\" href=\"#\" onclick=\"return ew.modalDialogShow({lnk:this,url:'" . HtmlEncode(GetUrl($this->EditUrl)) . "'});\">" . $Language->phrase("ViewPageEditLink") . "</a>";
        } else {
            $item->Body = "<a class=\"ew-action ew-edit\" title=\"" . $editcaption . "\" data-caption=\"" . $editcaption . "\" href=\"" . HtmlEncode(GetUrl($this->EditUrl)) . "\">" . $Language->phrase("ViewPageEditLink") . "</a>";
        }
        $item->Visible = ($this->EditUrl != "" && $Security->canEdit());

        // Copy
        $item = &$option->add("copy");
        $copycaption = HtmlTitle($Language->phrase("ViewPageCopyLink"));
        if ($this->IsModal) {
            $item->Body = "<a class=\"ew-action ew-copy\" title=\"" . $copycaption . "\" data-caption=\"" . $copycaption . "\" href=\"#\" onclick=\"return ew.modalDialogShow({lnk:this,btn:'AddBtn',url:'" . HtmlEncode(GetUrl($this->CopyUrl)) . "'});\">" . $Language->phrase("ViewPageCopyLink") . "</a>";
        } else {
            $item->Body = "<a class=\"ew-action ew-copy\" title=\"" . $copycaption . "\" data-caption=\"" . $copycaption . "\" href=\"" . HtmlEncode(GetUrl($this->CopyUrl)) . "\">" . $Language->phrase("ViewPageCopyLink") . "</a>";
        }
        $item->Visible = ($this->CopyUrl != "" && $Security->canAdd());

        // Delete
        $item = &$option->add("delete");
        if ($this->IsModal) { // Handle as inline delete
            $item->Body = "<a onclick=\"return ew.confirmDelete(this);\" class=\"ew-action ew-delete\" title=\"" . HtmlTitle($Language->phrase("ViewPageDeleteLink")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("ViewPageDeleteLink")) . "\" href=\"" . HtmlEncode(UrlAddQuery(GetUrl($this->DeleteUrl), "action=1")) . "\">" . $Language->phrase("ViewPageDeleteLink") . "</a>";
        } else {
            $item->Body = "<a class=\"ew-action ew-delete\" title=\"" . HtmlTitle($Language->phrase("ViewPageDeleteLink")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("ViewPageDeleteLink")) . "\" href=\"" . HtmlEncode(GetUrl($this->DeleteUrl)) . "\">" . $Language->phrase("ViewPageDeleteLink") . "</a>";
        }
        $item->Visible = ($this->DeleteUrl != "" && $Security->canDelete());

        // Set up action default
        $option = $options["action"];
        $option->DropDownButtonPhrase = $Language->phrase("ButtonActions");
        $option->UseDropDownButton = false;
        $option->UseButtonGroup = true;
        $item = &$option->add($option->GroupOptionName);
        $item->Body = "";
        $item->Visible = false;
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
        $this->AddUrl = $this->getAddUrl();
        $this->EditUrl = $this->getEditUrl();
        $this->CopyUrl = $this->getCopyUrl();
        $this->DeleteUrl = $this->getDeleteUrl();
        $this->ListUrl = $this->getListUrl();
        $this->setupOtherOptions();

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
        }

        // Call Row Rendered event
        if ($this->RowType != ROWTYPE_AGGREGATEINIT) {
            $this->rowRendered();
        }
    }

    // Get export HTML tag
    protected function getExportTag($type, $custom = false)
    {
        global $Language;
        $pageUrl = $this->pageUrl();
        if (SameText($type, "excel")) {
            if ($custom) {
                return "<a href=\"#\" class=\"ew-export-link ew-excel\" title=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" onclick=\"return ew.export(document.f_01personnelview, '" . $this->ExportExcelUrl . "', 'excel', true);\">" . $Language->phrase("ExportToExcel") . "</a>";
            } else {
                return "<a href=\"" . $this->ExportExcelUrl . "\" class=\"ew-export-link ew-excel\" title=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\">" . $Language->phrase("ExportToExcel") . "</a>";
            }
        } elseif (SameText($type, "word")) {
            if ($custom) {
                return "<a href=\"#\" class=\"ew-export-link ew-word\" title=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" onclick=\"return ew.export(document.f_01personnelview, '" . $this->ExportWordUrl . "', 'word', true);\">" . $Language->phrase("ExportToWord") . "</a>";
            } else {
                return "<a href=\"" . $this->ExportWordUrl . "\" class=\"ew-export-link ew-word\" title=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\">" . $Language->phrase("ExportToWord") . "</a>";
            }
        } elseif (SameText($type, "pdf")) {
            if ($custom) {
                return "<a href=\"#\" class=\"ew-export-link ew-pdf\" title=\"" . HtmlEncode($Language->phrase("ExportToPDFText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToPDFText")) . "\" onclick=\"return ew.export(document.f_01personnelview, '" . $this->ExportPdfUrl . "', 'pdf', true);\">" . $Language->phrase("ExportToPDF") . "</a>";
            } else {
                return "<a href=\"" . $this->ExportPdfUrl . "\" class=\"ew-export-link ew-pdf\" title=\"" . HtmlEncode($Language->phrase("ExportToPDFText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToPDFText")) . "\">" . $Language->phrase("ExportToPDF") . "</a>";
            }
        } elseif (SameText($type, "html")) {
            return "<a href=\"" . $this->ExportHtmlUrl . "\" class=\"ew-export-link ew-html\" title=\"" . HtmlEncode($Language->phrase("ExportToHtmlText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToHtmlText")) . "\">" . $Language->phrase("ExportToHtml") . "</a>";
        } elseif (SameText($type, "xml")) {
            return "<a href=\"" . $this->ExportXmlUrl . "\" class=\"ew-export-link ew-xml\" title=\"" . HtmlEncode($Language->phrase("ExportToXmlText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToXmlText")) . "\">" . $Language->phrase("ExportToXml") . "</a>";
        } elseif (SameText($type, "csv")) {
            return "<a href=\"" . $this->ExportCsvUrl . "\" class=\"ew-export-link ew-csv\" title=\"" . HtmlEncode($Language->phrase("ExportToCsvText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToCsvText")) . "\">" . $Language->phrase("ExportToCsv") . "</a>";
        } elseif (SameText($type, "email")) {
            $url = $custom ? ",url:'" . $pageUrl . "export=email&amp;custom=1'" : "";
            return '<button id="emf__01personnel" class="ew-export-link ew-email" title="' . $Language->phrase("ExportToEmailText") . '" data-caption="' . $Language->phrase("ExportToEmailText") . '" onclick="ew.emailDialogShow({lnk:\'emf__01personnel\', hdr:ew.language.phrase(\'ExportToEmailText\'), f:document.f_01personnelview, key:' . ArrayToJsonAttribute($this->RecKey) . ', sel:false' . $url . '});">' . $Language->phrase("ExportToEmail") . '</button>';
        } elseif (SameText($type, "print")) {
            return "<a href=\"" . $this->ExportPrintUrl . "\" class=\"ew-export-link ew-print\" title=\"" . HtmlEncode($Language->phrase("PrinterFriendlyText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("PrinterFriendlyText")) . "\">" . $Language->phrase("PrinterFriendly") . "</a>";
        }
    }

    // Set up export options
    protected function setupExportOptions()
    {
        global $Language;

        // Printer friendly
        $item = &$this->ExportOptions->add("print");
        $item->Body = $this->getExportTag("print");
        $item->Visible = true;

        // Export to Excel
        $item = &$this->ExportOptions->add("excel");
        $item->Body = $this->getExportTag("excel");
        $item->Visible = true;

        // Export to Word
        $item = &$this->ExportOptions->add("word");
        $item->Body = $this->getExportTag("word");
        $item->Visible = true;

        // Export to Html
        $item = &$this->ExportOptions->add("html");
        $item->Body = $this->getExportTag("html");
        $item->Visible = true;

        // Export to Xml
        $item = &$this->ExportOptions->add("xml");
        $item->Body = $this->getExportTag("xml");
        $item->Visible = true;

        // Export to Csv
        $item = &$this->ExportOptions->add("csv");
        $item->Body = $this->getExportTag("csv");
        $item->Visible = true;

        // Export to Pdf
        $item = &$this->ExportOptions->add("pdf");
        $item->Body = $this->getExportTag("pdf");
        $item->Visible = true;

        // Export to Email
        $item = &$this->ExportOptions->add("email");
        $item->Body = $this->getExportTag("email");
        $item->Visible = true;

        // Drop down button for export
        $this->ExportOptions->UseButtonGroup = true;
        $this->ExportOptions->UseDropDownButton = true;
        if ($this->ExportOptions->UseButtonGroup && IsMobile()) {
            $this->ExportOptions->UseDropDownButton = true;
        }
        $this->ExportOptions->DropDownButtonPhrase = $Language->phrase("ButtonExport");

        // Add group option item
        $item = &$this->ExportOptions->add($this->ExportOptions->GroupOptionName);
        $item->Body = "";
        $item->Visible = false;

        // Hide options for export
        if ($this->isExport()) {
            $this->ExportOptions->hideAllOptions();
        }
    }

    /**
    * Export data in HTML/CSV/Word/Excel/XML/Email/PDF format
    *
    * @param boolean $return Return the data rather than output it
    * @return mixed
    */
    public function exportData($return = false)
    {
        global $Language;
        $utf8 = SameText(Config("PROJECT_CHARSET"), "utf-8");

        // Load recordset
        if (!$this->Recordset) {
            $this->Recordset = $this->loadRecordset();
        }
        $rs = &$this->Recordset;
        if ($rs) {
            $this->TotalRecords = $rs->recordCount();
        }
        $this->StartRecord = 1;
        $this->setupStartRecord(); // Set up start record position

        // Set the last record to display
        if ($this->DisplayRecords <= 0) {
            $this->StopRecord = $this->TotalRecords;
        } else {
            $this->StopRecord = $this->StartRecord + $this->DisplayRecords - 1;
        }
        $this->ExportDoc = GetExportDocument($this, "v");
        $doc = &$this->ExportDoc;
        if (!$doc) {
            $this->setFailureMessage($Language->phrase("ExportClassNotFound")); // Export class not found
        }
        if (!$rs || !$doc) {
            RemoveHeader("Content-Type"); // Remove header
            RemoveHeader("Content-Disposition");
            $this->showMessage();
            return;
        }
        $this->StartRecord = 1;
        $this->StopRecord = $this->DisplayRecords <= 0 ? $this->TotalRecords : $this->DisplayRecords;

        // Call Page Exporting server event
        $this->ExportDoc->ExportCustom = !$this->pageExporting();
        $header = $this->PageHeader;
        $this->pageDataRendering($header);
        $doc->Text .= $header;
        $this->exportDocument($doc, $rs, $this->StartRecord, $this->StopRecord, "view");
        $footer = $this->PageFooter;
        $this->pageDataRendered($footer);
        $doc->Text .= $footer;

        // Close recordset
        $rs->close();

        // Call Page Exported server event
        $this->pageExported();

        // Export header and footer
        $doc->exportHeaderAndFooter();

        // Clean output buffer (without destroying output buffer)
        $buffer = ob_get_contents(); // Save the output buffer
        if (!Config("DEBUG") && $buffer) {
            ob_clean();
        }

        // Write debug message if enabled
        if (Config("DEBUG") && !$this->isExport("pdf")) {
            echo GetDebugMessage();
        }

        // Output data
        if ($this->isExport("email")) {
            if ($return) {
                return $doc->Text; // Return email content
            } else {
                echo $this->exportEmail($doc->Text); // Send email
            }
        } else {
            $doc->export();
            if ($return) {
                RemoveHeader("Content-Type"); // Remove header
                RemoveHeader("Content-Disposition");
                $content = ob_get_contents();
                if ($content) {
                    ob_clean();
                }
                if ($buffer) {
                    echo $buffer; // Resume the output buffer
                }
                return $content;
            }
        }
    }

    // Export email
    protected function exportEmail($emailContent)
    {
        global $TempImages, $Language;
        $sender = Post("sender", "");
        $recipient = Post("recipient", "");
        $cc = Post("cc", "");
        $bcc = Post("bcc", "");

        // Subject
        $subject = Post("subject", "");
        $emailSubject = $subject;

        // Message
        $content = Post("message", "");
        $emailMessage = $content;

        // Check sender
        if ($sender == "") {
            return "<p class=\"text-danger\">" . str_replace("%s", $Language->phrase("Sender"), $Language->phrase("EnterRequiredField")) . "</p>";
        }
        if (!CheckEmail($sender)) {
            return "<p class=\"text-danger\">" . $Language->phrase("EnterProperSenderEmail") . "</p>";
        }

        // Check recipient
        if ($recipient == "") {
            return "<p class=\"text-danger\">" . str_replace("%s", $Language->phrase("Recipient"), $Language->phrase("EnterRequiredField")) . "</p>";
        }
        if (!CheckEmailList($recipient, Config("MAX_EMAIL_RECIPIENT"))) {
            return "<p class=\"text-danger\">" . $Language->phrase("EnterProperRecipientEmail") . "</p>";
        }

        // Check cc
        if (!CheckEmailList($cc, Config("MAX_EMAIL_RECIPIENT"))) {
            return "<p class=\"text-danger\">" . $Language->phrase("EnterProperCcEmail") . "</p>";
        }

        // Check bcc
        if (!CheckEmailList($bcc, Config("MAX_EMAIL_RECIPIENT"))) {
            return "<p class=\"text-danger\">" . $Language->phrase("EnterProperBccEmail") . "</p>";
        }

        // Check email sent count
        $_SESSION[Config("EXPORT_EMAIL_COUNTER")] = $_SESSION[Config("EXPORT_EMAIL_COUNTER")] ?? 0;
        if ((int)$_SESSION[Config("EXPORT_EMAIL_COUNTER")] > Config("MAX_EMAIL_SENT_COUNT")) {
            return "<p class=\"text-danger\">" . $Language->phrase("ExceedMaxEmailExport") . "</p>";
        }

        // Send email
        $email = new Email();
        $email->Sender = $sender; // Sender
        $email->Recipient = $recipient; // Recipient
        $email->Cc = $cc; // Cc
        $email->Bcc = $bcc; // Bcc
        $email->Subject = $emailSubject; // Subject
        $email->Format = "html";
        if ($emailMessage != "") {
            $emailMessage = RemoveXss($emailMessage) . "<br><br>";
        }
        foreach ($TempImages as $tmpImage) {
            $email->addEmbeddedImage($tmpImage);
        }
        $email->Content = $emailMessage . CleanEmailContent($emailContent); // Content
        $eventArgs = [];
        if ($this->Recordset) {
            $eventArgs["rs"] = &$this->Recordset;
        }
        $emailSent = false;
        if ($this->emailSending($email, $eventArgs)) {
            $emailSent = $email->send();
        }

        // Check email sent status
        if ($emailSent) {
            // Update email sent count
            $_SESSION[Config("EXPORT_EMAIL_COUNTER")]++;

            // Sent email success
            return "<p class=\"text-success\">" . $Language->phrase("SendEmailSuccess") . "</p>"; // Set up success message
        } else {
            // Sent email failure
            return "<p class=\"text-danger\">" . $email->SendErrDescription . "</p>";
        }
    }

    // Set up Breadcrumb
    protected function setupBreadcrumb()
    {
        global $Breadcrumb, $Language;
        $Breadcrumb = new Breadcrumb("index");
        $url = CurrentUrl();
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("_01personnelList"), "", $this->TableVar, true);
        $pageId = "view";
        $Breadcrumb->add("view", $pageId, $url);
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

    // Page Exporting event
    // $this->ExportDoc = export document object
    public function pageExporting()
    {
        //$this->ExportDoc->Text = "my header"; // Export header
        //return false; // Return false to skip default export and use Row_Export event
        return true; // Return true to use default export and skip Row_Export event
    }

    // Row Export event
    // $this->ExportDoc = export document object
    public function rowExport($rs)
    {
        //$this->ExportDoc->Text .= "my content"; // Build HTML with field value: $rs["MyField"] or $this->MyField->ViewValue
    }

    // Page Exported event
    // $this->ExportDoc = export document object
    public function pageExported()
    {
        //$this->ExportDoc->Text .= "my footer"; // Export footer
        //Log($this->ExportDoc->Text);
    }
}
