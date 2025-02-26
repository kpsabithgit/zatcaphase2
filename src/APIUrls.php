<?php
namespace Sabith\Zatcaphase2;

//

class APIUrls
{
    public static function get($key)
    {
        $data = [
            'Productioncsid' => 'productioncsid',
            'Compliancecsid' => 'compliance',
            'Simplifiedcompliance' => 'simplified-compliance',
            'SimplifiedInvoice' => 'simplified-invoice',
            'SimplifiedCreditNote' => 'simplified-creditnote',
            'SimplifiedDebitNote' => 'simplified-debitnote',
            'StandardCompliance' => 'standard-compliance',
            'StandardInvoice' => 'standard-invoice',
           'StandardCreditNote' => 'standard-creditnote',
            'StandardDebitNote' => 'standard-debitnote',
        ];
        $baseUrl = EnvVariables::get('STACKCUE_API_END_POINT_BASE_URL');
        $url = $baseUrl . '/api/' . $data[$key];
        return $url;
    }

}
