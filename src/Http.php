<?php

declare(strict_types=1);

namespace Pest\CraftCms;

/**
 * @internal
 */
trait Http
{
    /**
     * Example description.
     */
    public function get(string $uri): \yii\web\Response
    {
        // Configure the request
        $this->craft->request->setIsConsoleRequest(false);
        $this->craft->request->setHostInfo('http://localhost');
        $this->craft->request->setQueryParams(['p' => $uri]);

        // Override the response
        $this->craft->response->attachBehavior('testableResponse', new TestableResponseBehavior);

        // Run the application
        $this->craft->trigger(\craft\web\Application::EVENT_BEFORE_REQUEST);
        $response = $this->craft->handleRequest($this->craft->request);
        $this->craft->trigger(\craft\web\Application::EVENT_AFTER_REQUEST);

        // Return the response
        return $response;
    }
}
