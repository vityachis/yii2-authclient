<?php

namespace yiiunit\extensions\authclient\data;

use vityachis\authclient\BaseClient;

/**
 * Mock for the Auth client.
 */
class TestClient extends BaseClient
{
    /**
     * {@inheritdoc}
     */
    protected function initUserAttributes()
    {
        return [];
    }
}