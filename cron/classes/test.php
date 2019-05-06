<?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_PORT => "9090",
  CURLOPT_URL => "http://199.3.0.90:9090/SIIApp-rest/comelec/reporte/cobro/comercio",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "{\n\n    \"fechaDesde\": 20180601,\n    \"fechaHasta\": 20180630,\n \"codigoUnicoEmpresa\": 2,\n    \"tipoDeCambioDolar\": 6.96\n}\n",
  CURLOPT_HTTPHEADER => array(
    "cache-control: no-cache",
    "content-type: application/json",
    "postman-token: 1b08d707-6e7a-d1d2-6e9a-7c6690c73d62"
  ),
));



$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  echo $response;       
}