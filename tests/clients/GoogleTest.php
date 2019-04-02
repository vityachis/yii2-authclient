<?php

namespace yiiunit\extensions\authclient\clients;

use vityachis\authclient\clients\Google;
use vityachis\authclient\OAuthToken;
use vityachis\authclient\signature\RsaSha;
use yiiunit\extensions\authclient\TestCase;

/**
 * @group google
 */
class GoogleTest extends TestCase
{
    protected function setUp()
    {
        $config = [
            'components' => [
                'request' => [
                    'hostInfo' => 'http://testdomain.com',
                    'scriptUrl' => '/index.php',
                ],
            ]
        ];
        $this->mockApplication($config, '\yii\web\Application');
    }

    public function testAuthenticateUserJwt()
    {
        $params = $this->getParam('google');
        if (empty($params['serviceAccount'])) {
            $this->markTestSkipped("Google service account name is not configured.");
        }

        $oauthClient = new Google();
        $token = $oauthClient->authenticateUserJwt($params['serviceAccount'], [
            'class' => RsaSha::className(),
            'algorithm' => OPENSSL_ALGO_SHA256,
            'privateCertificate' => $params['serviceAccountPrivateKey']
        ]);
        $this->assertTrue($token instanceof OAuthToken);
        $this->assertNotEmpty($token->getToken());
    }
}