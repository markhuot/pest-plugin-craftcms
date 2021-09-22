<?php

declare(strict_types=1);

namespace Pest\CraftCms;

use craft\web\Application;
use craft\web\Response;
use markhuot\craftpest\web\Request;
use PHPUnit\Util\Test;
use yii\base\Event;

/**
 * @internal
 * @property Application $craft The Craft instance
 */
trait Http
{
    /** @var string */
    public $uri;

    /** @var Response */
    public $response;


    /**
     * Example description.
     */
    public function get(string $uri=null): TestableResponse
    {
        // Configure the request
        // $this->craft->request->headers->add('host', 'localhost:8080');
        // $this->craft->request->headers->add('accept', 'text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8');
        // $this->craft->request->headers->add('upgrade-insecure-request', '1');
        // $this->craft->request->headers->add('user-agent', 'craft-pest');
        // $this->craft->request->headers->add('accept-language', 'en-us');
        // $this->craft->request->headers->add('accept-encoding', 'gzip, deflate');
        // $this->craft->request->headers->add('connection', 'keep-alive');

        $resolvedUri = ltrim($uri ?? $this->uri ?? '/', '/');

        (new PropertySetter($this->craft->request))->setRaw([
            '_isConsoleRequest' => false,
            '_fullPath' => $resolvedUri,
            '_path' => $resolvedUri,
            '_fullUri' => $resolvedUri,
            '_ipAddress' => '::1',
            '_rawBody' => '',
            '_bodyParams' => [],
            '_queryParams' => [],
            '_hostInfo' => 'http://localhost:8080',
            '_hostName' => 'localhost',
            '_baseUrl' => '',
            '_scriptUrl' => '/index.php',
            '_scriptFile' => '',
            '_pathInfo' => $resolvedUri,
            '_url' => "/{$resolvedUri}",
            '_port' => 8080,
        ]);
        // dd($this->craft->request);

        // Override the response
        //$this->craft->response->attachBehavior('testableResponse', new TestableResponseBehavior);

        // Set the response stream so nothing gets written to the terminal
        // We have to do this because the `ErrorHandler::handleException` makes a call to
        // echo without any ability to override. To avoid all that error HTML written to
        // the screen we set our output stream to null and it's pushed in to the ether.
        Event::on(\yii\web\Response::class, \yii\web\Response::EVENT_BEFORE_SEND, function (Event $event) {
            /** @var Response $response */
            $response = $event->sender;
            $response->stream = fopen('/dev/null', 'rb');
        });

        $this->craft->trigger(Application::EVENT_BEFORE_REQUEST);

        // Run the application
        try {
            $response = $this->craft->handleRequest($this->craft->request);
        }

        // Catch any exceptions during handling
        catch (\Exception $e) {
            $this->craft->errorHandler->silentExitOnException = true;
            $this->craft->errorHandler->discardExistingOutput = false;
            $this->craft->errorHandler->handleException($e);
            $response = $this->craft->response;
            $response->statusCode = 404;
        }

        $this->craft->trigger(Application::EVENT_AFTER_REQUEST);

        // Return the response
        return new TestableResponse($response);
    }
}
