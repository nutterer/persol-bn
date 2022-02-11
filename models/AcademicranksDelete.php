<?php

namespace PHPMaker2021\upPersonnel;

use Doctrine\DBAL\ParameterType;

/**
 * Page class
 */
class AcademicranksDelete extends Academicranks
{
    use MessagesTrait;

    // Page ID
    public $PageID = "delete";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'academicranks';

    // Page object name
    public $PageObjName = "AcademicranksDelete";

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

        // Set up Breadcrumb
        $this->setupBreadcrumb();

        // Load key parameters
        $this->RecKeys = $this->getRecordKeys(); // Load record keys
        $filter = $this->getFilterFromRecordKeys();
        if ($filter == "") {
            $this->terminate("AcademicranksList"); // Prevent SQL injection, return to list
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
                $this->terminate("AcademicranksList"); // Return to list
                return;
            }
        }

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
                $thisKey .= $row['Aca_Id'];
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
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("AcademicranksList"), "", $this->TableVar, true);
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
