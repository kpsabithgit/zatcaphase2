<?php
namespace Sabith\Zatcaphase2;

Class APIUrls{
    public static function get($key){
        $data = [
            'Productioncsid'=>'productioncsid',
            'Compliancecsid'=>'compliance',
            'Simplifiedcompliance' => 'simplified-compliance',
            'SimplifiedInvoice' => 'simplified-invoice',
            'SimplifiedCreditNote' => 'simplified-creditnote',
            'SimplifiedDebitNote' => 'simplified-debitnote',
            'StandardCompliance' => 'standard-compliance',
            'StandardInvoice' => 'standard-invoice',
            'StandardCreditnote' => 'standard-creditnote',
            'StandardDebitnote' => 'standard-debitnote'
        ];
        $url =  env('STACKCUE_API_END_POINT_BASE_URL').'/'.'api'.'/'.$data[$key];
        return $url;
    }
}