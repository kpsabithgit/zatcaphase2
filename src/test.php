<?php
require 'vendor/autoload.php';

use Sabith\Zatcaphase2\ComplianceCSID;
use Sabith\Zatcaphase2\Invoice;
use Sabith\Zatcaphase2\ProductionCSID;

echo "Generting Compliance CSID<br> ";

$compliancecsid = new ComplianceCSID;
$compliancecsid->email("sales@jeem.net.sa")
    ->commonName('Jeem')
    ->location("Dammam")
    ->companyName("Jeem IT")
    ->vatNumber("310565828400003")
    ->isRequiredSimplifiedDoc(true)
    ->isRequiredStandardDoc(true)
    ->deviceSerialNumber1("stackcue")
    ->deviceSerialNumber2("ESGUnit")
    ->deviceSerialNumber3("9sfgbdb02-665")
    ->regAddress("KHOBAR")
    ->businessCategory("Software and IT")
    ->otp("272482");

    
echo $compliancecsid->sendAPIrequest();

echo "<br><br> Generting Production CSID<br>";
//stackcueComplianceIdentifier from above method used here
$stackcueComplianceIdentifier = '74e88cd4-fc4a-46f9-afee-b2c4cb4d034a';
$productioncsid = ProductionCSID::sendAPIrequest($stackcueComplianceIdentifier);
echo $productioncsid;

echo "<br><br> Generting Invoice<br>";

$invoice = new Invoice();

$invoice->stackcue()
    ->documentType('StandardInvoice')
    ->stackcueComplianceIdentifier('d1f4f24e-de77-4a93-ac74-11e9759b82cc')
    ->stackcueProductionIdentifier('80df268b-24ea-4fa5-904e-f949d155057d');

// Invoice Section
$invoice->invoice()
    ->id('SME00061')
    ->issueDate('2022-09-07')
    ->issueTime('12:21:28')
    ->invoiceCounterValue(101)
    ->actualDeliveryDate('2022-09-07')
    ->paymentMeansCode(10)
    ->PIHvalue('NWZlY2ViNjZmZmM4NmYzOGQ5NTI3ODZjNmQ2OTZjNzljMmRiYzIzOWRkNGU5MWI0NjcyOWQ3M2EyN2ZiNTdlOQ==')
    ->referanceInvoiceID('SMI00023')
    ->reasonForCreditOrDebitNote('Item Returned');

// Seller Section
$invoice->seller()
    ->partyIdentificationId('454634645645654')
    ->partyIdentificationIdType('CRN')
    ->streetName('Riyadh')
    ->buildingNumber('2322')
    ->plotIdentification('2223')
    ->citySubdivisionName('Riyad')
    ->cityName('Riyadh')
    ->postalZone('23333')
    ->companyID('311783645100003')
    ->registrationName('Acme Widgets LTD');

// Customer Section
$invoice->customer()
    ->partyIdentificationId('2345')
    ->partyIdentificationIdType('NAT')
    ->streetName('Riyadh')
    ->buildingNumber('1111')
    ->plotIdentification('2223')
    ->citySubdivisionName('Riyadh')
    ->cityName('Dammam')
    ->postalZone('12222')
    ->country('SA')
    ->companyID('399999999900003')
    ->registrationName('Acme Widgets LTD 2');

// Document Allowances
$invoice->addDocumentAllowance()
    ->allowanceReason('Free Text for allowance')
    ->allowanceAmount(1.00)
    ->allowanceTaxCategoryID('S')
    ->allowanceTaxPercentage(15);

// Document Charges
$invoice->addDocumentCharge()
    ->chargeReason('Advertising')
    ->chargeAmount(10.0)
    ->chargeTaxCategoryID('S')
    ->chargeTaxPercentage(15);

// PrePaid Documents
$invoice->addPrePaidDocument()
    ->prePaymentDocumentId('123')
    ->prePaymentDocumentIssueDate('2021-07-31')
    ->prePaymentDocumentIssueTime('12:28:17')
    ->prePaymentCategoryAmount('S', 2.00)
    ->prePaymentCategoryAmount('E', 0.00)
    ->prePaymentCategoryAmount('Z', 0.00)
    ->prePaymentCategoryAmount('O', 0.00);

$invoice->addPrePaidDocument()
    ->prePaymentDocumentId('124')
    ->prePaymentDocumentIssueDate('2021-07-31')
    ->prePaymentDocumentIssueTime('12:28:17')
    ->prePaymentCategoryAmount('S', 1.00)
    ->prePaymentCategoryAmount('E', 0.00)
    ->prePaymentCategoryAmount('Z', 0.00)
    ->prePaymentCategoryAmount('O', 0.00);

// Line Item
$invoice->addLineItem()
    ->lineID(1)
    ->invoicedQuantity(1)
    ->invoicedQuantityUnit('Pce')
    ->baseQuantity(1000)
    ->currency('SAR')
    ->currency2('SAR')
    ->name('Juice')
    ->categoriesCode('S')
    ->vatPercentage(15)
    ->grossAmount(10)
    ->priceAllowanceReason('FREETEXT')
    ->priceAllowanceAmount(1)
    ->lineAllowanceMethod('percentage') //percentage or direct
    ->itemlineAllowance_UNE_Reason('Discount')
    ->lineAllowanceAmount(1)
    ->lineAllowancePercentage(10)
    ->baseAmountForLineAllowance(11)
    ->lineChargeMethod('percentage') //percentage or direct
    ->itemlineCharge_UNE_Reason('Advertising')
    ->lineChargeAmount(1.00)
    ->lineChargePercentage(10)
    ->baseAmountForLineCharge(11);

// echo ($invoice->toJson());

echo "<br><br>Compliance Check <br>";
echo $invoice->APIcomplianceInvoiceCheck();

echo "<br><br>Compliance Check and submit <br>";
echo $invoice->APIcomplianceInvoiceCheckAndSubmit();
