<?php

                $url = "http://199.14.10.109:9090/SIIApp-rest/comelec/reporte/cobro/comercio";
                
                $fields = array(
                        "fechaDesde"=> '2019-01-01',
                        "fechaHasta"=> '2019-01-31',
                        "codigoUnicoEmpresa"=> 2,
                        "tipoDeCambioDolar"=> 6.96);

                $header = array(
                    "cache-control: no-cache",
                    "content-type: application/json"
                  );
               
                if($ch = curl_init($url))
                {
                    curl_setopt($ch, CURLOPT_PORT, '8081');
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
                    curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
                    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
                    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
                    curl_setopt($ch, CURLOPT_HTTPHEADER, $header);

                    $output = curl_exec($ch);

                    $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                    $err = curl_error($ch);

                    curl_close($ch);

                    $output = json_decode($output, true);
                    print_r($output);exit;
                    if(!$output){
                        echo "cURL Error #:00001";
                    }

                    //return (int) $status;
                }
