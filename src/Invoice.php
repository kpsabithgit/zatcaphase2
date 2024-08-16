<?php
namespace Sabith\Zatcaphase2;

use CURLFILE;

class Invoice
{
    private $data = [
        'Stackcue' => [],
        'Invoice' => [],
        'Seller' => [],
        'Customer' => [],
        'DocumentAllowances' => [],
        'DocumentCharges' => [],
        'prePaidDocuments' => [],
        'Lineitems' => [],
    ];
    private $stackcueHeader, $isfileSaved;
    private $currentSection;
    private $currentLineItemIndex = -1;
    private $currentAllowanceIndex = -1;
    private $currentChargeIndex = -1;
    private $currentPrePaidDocIndex = -1;

    public function stackcue()
    {
        $this->currentSection = 'Stackcue';
        return $this;
    }

    public function invoice()
    {
        $this->currentSection = 'Invoice';
        return $this;
    }

    public function seller()
    {
        $this->currentSection = 'Seller';
        return $this;
    }

    public function customer()
    {
        $this->currentSection = 'Customer';
        return $this;
    }

    public function addDocumentAllowance()
    {
        $this->currentAllowanceIndex++;
        $this->data['DocumentAllowances'][$this->currentAllowanceIndex] = [];
        return $this;
    }

    public function addDocumentCharge()
    {
        $this->currentChargeIndex++;
        $this->data['DocumentCharges'][$this->currentChargeIndex] = [];
        return $this;
    }

    public function addPrePaidDocument()
    {
        $this->currentPrePaidDocIndex++;
        $this->data['prePaidDocuments'][$this->currentPrePaidDocIndex] = [];
        return $this;
    }

    public function addLineItem()
    {
        $this->currentLineItemIndex++;
        $this->data['Lineitems'][$this->currentLineItemIndex] = [];
        return $this;
    }

    public function __call($name, $arguments)
    {
        // Check for specific fields that need to retain their exact casing
        $exactFields = ['PIHvalue'];
        if (in_array($name, $exactFields)) {
            $field = $name;
        } else {
            // Convert the name to camelCase
            $field = lcfirst(str_replace(' ', '', ucwords(str_replace('_', ' ', $name))));
        }
        $this->data[$this->currentSection][$field] = $arguments[0];
        return $this;
    }

    public function toJson()
    {
        return json_encode($this->data, JSON_PRETTY_PRINT);
    }

    public function toArray()
    {
        return $this->data;
    }

    // Document Allowance Methods
    public function allowanceReason($value)
    {
        $this->data['DocumentAllowances'][$this->currentAllowanceIndex]['allowanceReason'] = $value;
        return $this;
    }

    public function allowanceAmount($value)
    {
        $this->data['DocumentAllowances'][$this->currentAllowanceIndex]['allowanceAmount'] = $value;
        return $this;
    }

    public function allowanceTaxCategoryID($value)
    {
        $this->data['DocumentAllowances'][$this->currentAllowanceIndex]['taxCategoryID'] = $value;
        return $this;
    }

    public function allowanceTaxPercentage($value)
    {
        $this->data['DocumentAllowances'][$this->currentAllowanceIndex]['taxPercentage'] = $value;
        return $this;
    }

    // Document Charge Methods
    public function chargeReason($value)
    {
        $this->data['DocumentCharges'][$this->currentChargeIndex]['chargeReason'] = $value;
        return $this;
    }

    public function chargeAmount($value)
    {
        $this->data['DocumentCharges'][$this->currentChargeIndex]['chargeAmount'] = $value;
        return $this;
    }

    public function chargeTaxCategoryID($value)
    {
        $this->data['DocumentCharges'][$this->currentChargeIndex]['taxCategoryID'] = $value;
        return $this;
    }

    public function chargeTaxPercentage($value)
    {
        $this->data['DocumentCharges'][$this->currentChargeIndex]['taxPercentage'] = $value;
        return $this;
    }

    // PrePaid Document Methods
    public function prePaymentDocumentId($value)
    {
        $this->data['prePaidDocuments'][$this->currentPrePaidDocIndex]['prePaymentDocumentId'] = $value;
        return $this;
    }

    public function prePaymentDocumentIssueDate($value)
    {
        $this->data['prePaidDocuments'][$this->currentPrePaidDocIndex]['prePaymentDocumentIssueDate'] = $value;
        return $this;
    }

    public function prePaymentDocumentIssueTime($value)
    {
        $this->data['prePaidDocuments'][$this->currentPrePaidDocIndex]['prePaymentDocumentIssueTime'] = $value;
        return $this;
    }

    public function prePaymentCategoryAmount($category, $amount)
    {
        $this->data['prePaidDocuments'][$this->currentPrePaidDocIndex]['prePaymentCategoryAmount'][$category] = $amount;
        return $this;
    }

    // Line Item Methods
    public function lineID($value)
    {
        $this->data['Lineitems'][$this->currentLineItemIndex]['lineID'] = $value;
        return $this;
    }

    public function invoicedQuantity($value)
    {
        $this->data['Lineitems'][$this->currentLineItemIndex]['invoicedQuantity'] = $value;
        return $this;
    }

    public function invoicedQuantityUnit($value)
    {
        $this->data['Lineitems'][$this->currentLineItemIndex]['invoicedQuantityUnit'] = $value;
        return $this;
    }

    public function baseQuantity($value)
    {
        $this->data['Lineitems'][$this->currentLineItemIndex]['baseQuantity'] = $value;
        return $this;
    }

    public function currency($value)
    {
        $this->data['Lineitems'][$this->currentLineItemIndex]['currency'] = $value;
        return $this;
    }

    public function currency2($value)
    {
        $this->data['Lineitems'][$this->currentLineItemIndex]['currency2'] = $value;
        return $this;
    }

    public function name($value)
    {
        $this->data['Lineitems'][$this->currentLineItemIndex]['name'] = $value;
        return $this;
    }

    public function categoriesCode($value)
    {
        $this->data['Lineitems'][$this->currentLineItemIndex]['categoriesCode'] = $value;
        return $this;
    }

    public function vatPercentage($value)
    {
        $this->data['Lineitems'][$this->currentLineItemIndex]['vatPercentage'] = $value;
        return $this;
    }

    public function grossAmount($value)
    {
        $this->data['Lineitems'][$this->currentLineItemIndex]['grossAmount'] = $value;
        return $this;
    }

    public function priceAllowanceReason($value)
    {
        $this->data['Lineitems'][$this->currentLineItemIndex]['priceAllowanceReason'] = $value;
        return $this;
    }

    public function priceAllowanceAmount($value)
    {
        $this->data['Lineitems'][$this->currentLineItemIndex]['priceAllowanceAmount'] = $value;
        return $this;
    }

    public function lineAllowanceMethod($value)
    {
        $this->data['Lineitems'][$this->currentLineItemIndex]['lineAllowanceMethod'] = $value;
        return $this;
    }

    public function itemlineAllowance_UNE_Reason($value)
    {
        $this->data['Lineitems'][$this->currentLineItemIndex]['itemlineAllowance_UNE_Reason'] = $value;
        return $this;
    }

    public function lineAllowanceAmount($value)
    {
        $this->data['Lineitems'][$this->currentLineItemIndex]['lineAllowanceAmount'] = $value;
        return $this;
    }

    public function lineAllowancePercentage($value)
    {
        $this->data['Lineitems'][$this->currentLineItemIndex]['lineAllowancePercentage'] = $value;
        return $this;
    }

    public function baseAmountForLineAllowance($value)
    {
        $this->data['Lineitems'][$this->currentLineItemIndex]['baseAmountForLineAllowance'] = $value;
        return $this;
    }

    public function lineChargeMethod($value)
    {
        $this->data['Lineitems'][$this->currentLineItemIndex]['lineChargeMethod'] = $value;
        return $this;
    }

    public function itemlineCharge_UNE_Reason($value)
    {
        $this->data['Lineitems'][$this->currentLineItemIndex]['itemlineCharge_UNE_Reason'] = $value;
        return $this;
    }

    public function lineChargeAmount($value)
    {
        $this->data['Lineitems'][$this->currentLineItemIndex]['lineChargeAmount'] = $value;
        return $this;
    }

    public function lineChargePercentage($value)
    {
        $this->data['Lineitems'][$this->currentLineItemIndex]['lineChargePercentage'] = $value;
        return $this;
    }

    public function baseAmountForLineCharge($value)
    {
        $this->data['Lineitems'][$this->currentLineItemIndex]['baseAmountForLineCharge'] = $value;
        return $this;
    }

    public function getStackcueHeader()
    {
        return $this->stackcueHeader;
    }

    public function isfileSaved()
    {
        return $this->isfileSaved;
    }

    public function APIcomplianceInvoiceCheck()
    {

        $DocType = $this->data['Stackcue']['documentType'];

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => APIUrls::get($DocType),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($this->data),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Authorization: Bearer ' . EnvVariables::get('STACKCUE_API_ACCESS_TOKEN'),
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;

    }

    public function APIcomplianceInvoiceCheckAndSubmit()
    {

        $DocType = $this->data['Stackcue']['documentType'];
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => APIUrls::get($DocType),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($this->data),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Authorization: Bearer ' . EnvVariables::get('STACKCUE_API_ACCESS_TOKEN'),
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;

    }

    public function API_PDF_InvoiceCheckAndSubmit($fileLocations)
    {

        $DocType = $this->data['Stackcue']['documentType'];

        $pathToSave = $fileLocations['pdfA3_SaveDirectory'];

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => APIUrls::get($DocType),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array('data' => "'" . base64_encode($this->toJson()) . "'", 'file' => new CURLFILE($fileLocations['pdfLocation'])),
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . EnvVariables::get('STACKCUE_API_ACCESS_TOKEN'),
            ),
        ));

        // Callback function to capture headers
        curl_setopt($curl, CURLOPT_HEADERFUNCTION,
            function ($curl, $header) use (&$headers) {
                $len = strlen($header);
                $header = explode(':', $header, 2);
                if (count($header) < 2) {
                    return $len; // ignore invalid headers
                }
                $headers[strtolower(trim($header[0]))] = trim($header[1]);
                return $len;
            }
        );

        $response = curl_exec($curl);

        $stackcueHeader_json = isset($headers['stackcue-header']) ? $headers['stackcue-header'] : null;

        // echo "Stackcue-Header: $stackcueHeader\n";
        $this->stackcueHeader = $stackcueHeader_json;

        curl_close($curl);
        //echo $response;
        if ($stackcueHeader_json != null) {
            $stackcueHeader_arr = json_decode($stackcueHeader_json, true);

            $zatcaSubmissionStatus = isset($stackcueHeader_arr['stackcueHelper']['zatcaSubmissionStatus']) ? ($stackcueHeader_arr['stackcueHelper']['zatcaSubmissionStatus']) : null;
            if ($zatcaSubmissionStatus != null && $zatcaSubmissionStatus == 1) {
                // Create directory if it does not exist
                if (!file_exists($pathToSave)) {
                    mkdir($pathToSave, 0777, true);
                }
                // Set the file path including the file name
                $file_path = $pathToSave . '/' . $fileLocations['pdfA3_FileName'];
                $file_handle = fopen($file_path, 'w');
                // Initialize cURL session

                //conditions if fle saved or not
                $fileSave = fwrite($file_handle, $response);
                if ($fileSave === false) {
                    $this->isfileSaved = "false";
                } elseif ($fileSave == strlen($response)) {
                    $this->isfileSaved = "true";
                }
                else{
                    $this->isfileSaved = $fileSave;
                }
                $this->stackcueHeader = $stackcueHeader_json;

            }

        }

    }

}
