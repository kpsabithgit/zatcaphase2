<?php
namespace Sabith\Zatcaphase2;

use Sabith\Zatcaphase2\APIUrls;

class ComplianceCSID
{
    private $data = [];

    public function email($value)
    {
        $this->data['email'] = $value;
        return $this;
    }
    public function location($value)
    {
        $this->data['location'] = $value;
        return $this;

    }
    public function companyName($value)
    {
        $this->data['companyName'] = $value;
        return $this;

    }
    public function vatNumber($value)
    {
        $this->data['vatNumber'] = $value;
        return $this;

    }
    public function isRequiredSimplifiedDoc($value)
    {
        $this->data['isRequiredSimplifiedDoc'] = $value;
        return $this;

    }
    public function isRequiredStandardDoc($value)
    {
        $this->data['isRequiredStandardDoc'] = $value;
        return $this;

    }

    public function deviceSerialNumber1($value)
    {
        $this->data['deviceSerialNumber1'] = $value;
        return $this;

    }
    public function deviceSerialNumber2($value)
    {
        $this->data['deviceSerialNumber2'] = $value;
        return $this;

    }
    public function deviceSerialNumber3($value)
    {
        $this->data['deviceSerialNumber3'] = $value;
        return $this;

    }
    public function regAddress($value)
    {
        $this->data['regAddress'] = $value;
        return $this;

    }
    
    public function commonName($value)
    {
        $this->data['commonName'] = $value;
        return $this;

    }
    public function businesscategory($value)
    {
        $this->data['businesscategory'] = $value;
        return $this;

    }
    public function otp($value)
    {
        $this->data['otp'] = $value;
        return $this;

    }
    public function toArray()
    {
        return $this->data;
    }

    public function sendAPIrequest()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => APIUrls::get('Compliancecsid'),
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
                'Authorization: Bearer '.EnvVariables::get('STACKCUE_API_ACCESS_TOKEN'),
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;

    }

}
