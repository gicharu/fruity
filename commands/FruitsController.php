<?php

namespace app\commands;

use app\models\Fruits;
use app\models\Nutrition;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use PHPUnit\Util\Exception;
use yii\helpers\Json;
use yii\web\HttpException;

class FruitsController extends \yii\console\Controller
{
    public function actionIndex()
    {
        // get all fruits
        echo $this->stdout("Getting all fruits from " . \Yii::$app->params['API_URI'] . " \n");
        $client = new Client([
            'base_uri' => \Yii::$app->params['API_URI']
        ]);
        try {

            $response = $client->get('/api/fruit/all');
            if($response->getStatusCode() != 200) {
                throw new HttpException("Error {$response->getStatusCode()} encountered while fetching fruits");

            }
            $fruitsData = Json::decode($response->getBody()->getContents());
            foreach ($fruitsData as $fruit) {
                $fruitModel = new Fruits();
                $fruitModel->scenario = Fruits::CONSOLE_LOAD;
                $fruitModel->load($fruit, '');
                if(!$fruitModel->save()) {
                    throw new \Exception(Json::encode($fruitModel->getErrors()));
                }

                $nutritionModel = new Nutrition();
                $nutritionModel->load($fruit, 'nutritions');
                $nutritionModel->link('fruit', $fruitModel);


            }
            $mailSent = \Yii::$app->mailer->compose()
                ->setFrom(['noreply@hubconexionz.com', 'Fruity cron'])
                ->setTo(\Yii::$app->params['adminEmail'])
                ->setSubject('Fruits downloaded')
                ->setTextBody('Fruits has successfully been downloaded from the API')
                ->setHtmlBody('<b>Fruits has successfully been downloaded from the API</b>')
                ->send();
            if(!$mailSent) {
                throw new \Exception("An error occurred while sending email");
            }
        } catch (GuzzleException | \HttpException | \Exception $e) {
            \Yii::error($e->getMessage(), __CLASS__);
        }


    }


}
