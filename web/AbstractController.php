<?php
namespace pdynarowski\web;

use Yii;

/**
 * Kontroler ogólny, przeznaczony dla różnych aplikajcji napisanych w Yii2 
 * @author pawel
 *
 */
abstract class AbstractController extends \yii\web\Controller
{
    /** 
     * obsługa http get 
     * 
     */
    protected function hasInGetRequest(string $key)
    {
        return Yii::$app->request->isGet && \Yii::$app->request->get($key, false);
    }
    
    protected function isPost()
    {
        return Yii::$app->request->isPost;
    }
    
    /** obsługa sesji */
    protected function removeFromSession(array $sessionKeys)
    {
        $session = Yii::$app->session;
        
        foreach($sessionKeys as $key) {
            if($session->has($key)) {
                $session->remove($key);
            }
        }
    }
    
    protected function setToSession(array $sessionKeys)
    {
        $session = Yii::$app->session;
        
        foreach($sessionKeys as $key=>$val) {
            if($session->has($key)) {
                $session->remove($key);
            }
            $session->set($key, $val);
        }
    }
    
    protected function hasInSession($key)
    {
        return $session = \Yii::$app->session->has($key);
    }
    
    protected function invalidateSession()
    {
        Yii::$app->session->removeAll();
        Yii::$app->session->destroy();
    }
    
    protected function getFromSession($key, $defaultValue = null)
    {
        return Yii::$app->session->get($key, $defaultValue);
    }
    
    /**
     *
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction'
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null
            ]
        ];
    }
}
