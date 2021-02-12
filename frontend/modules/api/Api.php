<?php

namespace frontend\modules\api;

use Yii;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Request;

class Api
{
    static public function mapApi(string $addr, $reverse = false): string
    {
        $client = new Client([
            'base_uri' => 'https://geocode-maps.yandex.ru/',
        ]);
        $api_key = Yii::$app->params['apiKeyMap'];
        $address = Yii::$app->request->get('address',$addr);
        try {
            $request = new Request('GET','1.x/');
            $response = $client->send($request, [
                'query' => ['geocode' => $address, 'apikey' => $api_key, 'format' => 'json'],
            ]);

            $content = $response->getBody()->getContents();
            $response_data = json_decode($content);
            if($reverse == true) {
                if(!isset($response_data->response->GeoObjectCollection->featureMember[0]->GeoObject->metaDataProperty
                        ->GeocoderMetaData->text)) {
                    throw new RequestException('Address not found', $request);
                }

                return $response_data->response->GeoObjectCollection->featureMember[0]->GeoObject->metaDataProperty
                    ->GeocoderMetaData->text;
            }

            if(!isset($response_data->response->GeoObjectCollection->featureMember[0]->GeoObject->Point->pos)) {
                throw new RequestException('Address not found', $request);
            }

            return $response_data->response->GeoObjectCollection->featureMember[0]->GeoObject->Point->pos;

        } catch (RequestException $e) {
            return '';
        }
    }
}
