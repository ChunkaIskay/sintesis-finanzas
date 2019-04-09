<?php
$curl = curl_init();
 
curl_setopt_array($curl, array(
  CURLOPT_PORT => "9090",
  CURLOPT_URL => "http://199.14.10.109:9090//SIIApp-rest/comelec/paramscobro comelec/reporte/cobro/comercio",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "{\n	\"fechaDesde\": 20180601,\n	\"fechaHasta\": 20180630,\n	\"codigoUnicoEmpresa\": 2,\n	\"tipoDeCambioDolar\": 6.96\n}",
  CURLOPT_HTTPHEADER => array(
	"Content-Type: application/json",
	"Postman-Token: d652d9e9-854a-4102-94a8-659902b096f0",
	"cache-control: no-cache"
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
