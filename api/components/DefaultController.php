<?php

namespace api\components;

use yii\filters\ContentNegotiator;
use yii\filters\RateLimiter;
use yii\helpers\ArrayHelper;
use yii\rest\Controller;
use yii\rest\OptionsAction;
use yii\web\Response;

/**
 * Class DefaultController
 * @package api\modules\v1
 */
class DefaultController extends Controller
{
    /**
     * @var Serializer
     */
    public $serializer = [
        'class' => Serializer::class,
        'collectionEnvelope' => 'items',
        'expandParam' => 'expand'
    ];

    public function getContentNegotiator()
    {
        return [
            'class' => ContentNegotiator::class,
            'formats' => $this->getFormats(),
            'languages' => $this->getLanguages(),
            'formatParam' => '_f',
            'languageParam' => '_l',
        ];
    }

    public function getFormats()
    {
        return [
            'application/json' => Response::FORMAT_JSON,
            'application/xml' => Response::FORMAT_XML,
        ];
    }

    public function getLanguages()
    {
        return [
            'en',
            'ru',
            'uz',
            'oz'
        ];
    }

    public function getRateLimiter()
    {
        return [
            'class' => RateLimiter::class,
        ];
    }


    /**
     * @return array
     */
    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
            'contentNegotiator' => $this->getContentNegotiator(),
            'rateLimiter' => $this->getRateLimiter(),
        ]);
    }


    /**
     * @return array
     */
    public function actions()
    {
        return [
            'options' => [
                'class' => OptionsAction::class,
            ]
        ];
    }
}