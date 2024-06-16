<?php
namespace Sabith\Zatcaphase2;

class ProductionCSID
{
    public static function sendAPIrequest($stackcueComplianceIdentifier)
    {

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => APIUrls::get('Productioncsid'),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{
        "stackcueComplianceIdentifier": "' . $stackcueComplianceIdentifier . '"
}',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Authorization: Bearer ' . EnvVariables::get('STACKCUE_API_ACCESS_TOKEN'),
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;

    }
}
