<?php
namespace Sabith\Zatcaphase2;

class Invoice {
    private $data = [
        'Stackcue' => [],
        'Invoice' => [],
        'Seller' => [],
        'Customer' => [],
        'DocumentAllowances' => [],
        'DocumentCharges' => [],
        'prePaidDocuments' => [],
        'Lineitems' => []
    ];

    private $currentSection;
    private $currentLineItemIndex = -1;
    private $currentAllowanceIndex = -1;
    private $currentChargeIndex = -1;
    private $currentPrePaidDocIndex = -1;

    public function stackcue() {
        $this->currentSection = 'Stackcue';
        return $this;
    }

    public function invoice() {
        $this->currentSection = 'Invoice';
        return $this;
    }

    public function seller() {
        $this->currentSection = 'Seller';
        return $this;
    }

    public function customer() {
        $this->currentSection = 'Customer';
        return $this;
    }

    public function addDocumentAllowance() {
        $this->currentAllowanceIndex++;
        $this->data['DocumentAllowances'][$this->currentAllowanceIndex] = [];
        return $this;
    }

    public function addDocumentCharge() {
        $this->currentChargeIndex++;
        $this->data['DocumentCharges'][$this->currentChargeIndex] = [];
        return $this;
    }

    public function addPrePaidDocument() {
        $this->currentPrePaidDocIndex++;
        $this->data['prePaidDocuments'][$this->currentPrePaidDocIndex] = [];
        return $this;
    }

    public function addLineItem() {
        $this->currentLineItemIndex++;
        $this->data['Lineitems'][$this->currentLineItemIndex] = [];
        return $this;
    }

    public function __call($name, $arguments) {
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

    public function toJson() {
        return json_encode($this->data, JSON_PRETTY_PRINT);
    }

    public function toArray() {
        return $this->data;
    }

    // Document Allowance Methods
    public function allowanceReason($value) {
        $this->data['DocumentAllowances'][$this->currentAllowanceIndex]['allowanceReason'] = $value;
        return $this;
    }

    public function allowanceAmount($value) {
        $this->data['DocumentAllowances'][$this->currentAllowanceIndex]['allowanceAmount'] = $value;
        return $this;
    }

    public function allowanceTaxCategoryID($value) {
        $this->data['DocumentAllowances'][$this->currentAllowanceIndex]['taxCategoryID'] = $value;
        return $this;
    }

    public function allowanceTaxPercentage($value) {
        $this->data['DocumentAllowances'][$this->currentAllowanceIndex]['taxPercentage'] = $value;
        return $this;
    }

    // Document Charge Methods
    public function chargeReason($value) {
        $this->data['DocumentCharges'][$this->currentChargeIndex]['chargeReason'] = $value;
        return $this;
    }

    public function chargeAmount($value) {
        $this->data['DocumentCharges'][$this->currentChargeIndex]['chargeAmount'] = $value;
        return $this;
    }

    public function chargeTaxCategoryID($value) {
        $this->data['DocumentCharges'][$this->currentChargeIndex]['taxCategoryID'] = $value;
        return $this;
    }

    public function chargeTaxPercentage($value) {
        $this->data['DocumentCharges'][$this->currentChargeIndex]['taxPercentage'] = $value;
        return $this;
    }

    // PrePaid Document Methods
    public function prePaymentDocumentId($value) {
        $this->data['prePaidDocuments'][$this->currentPrePaidDocIndex]['prePaymentDocumentId'] = $value;
        return $this;
    }

    public function prePaymentDocumentIssueDate($value) {
        $this->data['prePaidDocuments'][$this->currentPrePaidDocIndex]['prePaymentDocumentIssueDate'] = $value;
        return $this;
    }

    public function prePaymentDocumentIssueTime($value) {
        $this->data['prePaidDocuments'][$this->currentPrePaidDocIndex]['prePaymentDocumentIssueTime'] = $value;
        return $this;
    }

    public function prePaymentCategoryAmount($category, $amount) {
        $this->data['prePaidDocuments'][$this->currentPrePaidDocIndex]['prePaymentCategoryAmount'][$category] = $amount;
        return $this;
    }

    // Line Item Methods
    public function lineID($value) {
        $this->data['Lineitems'][$this->currentLineItemIndex]['lineID'] = $value;
        return $this;
    }

    public function invoicedQuantity($value) {
        $this->data['Lineitems'][$this->currentLineItemIndex]['invoicedQuantity'] = $value;
        return $this;
    }

    public function invoicedQuantityUnit($value) {
        $this->data['Lineitems'][$this->currentLineItemIndex]['invoicedQuantityUnit'] = $value;
        return $this;
    }

    public function baseQuantity($value) {
        $this->data['Lineitems'][$this->currentLineItemIndex]['baseQuantity'] = $value;
        return $this;
    }

    public function currency($value) {
        $this->data['Lineitems'][$this->currentLineItemIndex]['currency'] = $value;
        return $this;
    }

    public function currency2($value) {
        $this->data['Lineitems'][$this->currentLineItemIndex]['currency2'] = $value;
        return $this;
    }

    public function name($value) {
        $this->data['Lineitems'][$this->currentLineItemIndex]['name'] = $value;
        return $this;
    }

    public function categoriesCode($value) {
        $this->data['Lineitems'][$this->currentLineItemIndex]['categoriesCode'] = $value;
        return $this;
    }

    public function vatPercentage($value) {
        $this->data['Lineitems'][$this->currentLineItemIndex]['vatPercentage'] = $value;
        return $this;
    }

    public function grossAmount($value) {
        $this->data['Lineitems'][$this->currentLineItemIndex]['grossAmount'] = $value;
        return $this;
    }

    public function priceAllowanceReason($value) {
        $this->data['Lineitems'][$this->currentLineItemIndex]['priceAllowanceReason'] = $value;
        return $this;
    }

    public function priceAllowanceAmount($value) {
        $this->data['Lineitems'][$this->currentLineItemIndex]['priceAllowanceAmount'] = $value;
        return $this;
    }

    public function lineAllowanceMethod($value) {
        $this->data['Lineitems'][$this->currentLineItemIndex]['lineAllowanceMethod'] = $value;
        return $this;
    }

    public function itemlineAllowance_UNE_Reason($value) {
        $this->data['Lineitems'][$this->currentLineItemIndex]['itemlineAllowance_UNE_Reason'] = $value;
        return $this;
    }

    public function lineAllowanceAmount($value) {
        $this->data['Lineitems'][$this->currentLineItemIndex]['lineAllowanceAmount'] = $value;
        return $this;
    }

    public function lineAllowancePercentage($value) {
        $this->data['Lineitems'][$this->currentLineItemIndex]['lineAllowancePercentage'] = $value;
        return $this;
    }

    public function baseAmountForLineAllowance($value) {
        $this->data['Lineitems'][$this->currentLineItemIndex]['baseAmountForLineAllowance'] = $value;
        return $this;
    }

    public function lineChargeMethod($value) {
        $this->data['Lineitems'][$this->currentLineItemIndex]['lineChargeMethod'] = $value;
        return $this;
    }

    public function itemlineCharge_UNE_Reason($value) {
        $this->data['Lineitems'][$this->currentLineItemIndex]['itemlineCharge_UNE_Reason'] = $value;
        return $this;
    }

    public function lineChargeAmount($value) {
        $this->data['Lineitems'][$this->currentLineItemIndex]['lineChargeAmount'] = $value;
        return $this;
    }

    public function lineChargePercentage($value) {
        $this->data['Lineitems'][$this->currentLineItemIndex]['lineChargePercentage'] = $value;
        return $this;
    }

    public function baseAmountForLineCharge($value) {
        $this->data['Lineitems'][$this->currentLineItemIndex]['baseAmountForLineCharge'] = $value;
        return $this;
    }
}



