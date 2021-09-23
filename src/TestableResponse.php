<?php

namespace Pest\CraftCms;

use craft\web\Response;
use Symfony\Component\DomCrawler\Crawler;

class TestableResponse
{
    /**
     * @var \craft\web\Response
     */
    protected $response;

    /**
     * @var \Symfony\Component\DomCrawler\Crawler
     */
    protected $crawler;

    public function __construct(Response $response, Crawler $crawler = null)
    {
        $this->response = $response;
        $this->crawler = $crawler ?: new Crawler();
    }

    public function querySelector(string $selector): NodeList {
        $html = $this->response->content;
        $this->crawler->addContent($html);
        return new NodeList($this->crawler->filter($selector));
    }


    function assertCookie() {
        // TODO
        return $this;
    }

    function assertCookieExpired() {
        // TODO
        return $this;
    }

    function assertCookieNotExpired() {
        // TODO
        return $this;
    }

    function assertCookieMissing() {
        // TODO
        return $this;
    }

    function assertCreated() {
        return $this->assertStatus(201);
    }

    function assertDontSee(string $text) {
        test()->assertStringNotContainsString($text, $this->response->data);
        return $this;
    }

    function assertDontSeeText() {
        // TODO
        return $this;
    }

    function assertDownload() {
        // TODO
        return $this;
    }

    function assertExactJson() {
        // TODO
        return $this;
    }

    function assertForbidden() {
        return $this->assertStatus(403);
    }

    function assertHeader($name, $expected=null) {
        $value = $this->response->headers->get($name);
        if ($expected === null) {
            test()->assertNotNull($value);
        }
        else {
            test()->assertSame($expected, $value);
        }
        return $this;
    }

    function assertHeaderMissing($name):self {
        expect($this->response->headers->has($name))->toBeFalse();
        return $this;
    }

    function assertJson() {
        // TODO
        return $this;
    }

    function assertJsonCount() {
        // TODO
        return $this;
    }

    function assertJsonFragment() {
        // TODO
        return $this;
    }

    function assertJsonMissing() {
        // TODO
        return $this;
    }

    function assertJsonMissingExact() {
        // TODO
        return $this;
    }

    function assertJsonMissingValidationErrors() {
        // TODO
        return $this;
    }

    function assertJsonPath() {
        // TODO
        return $this;
    }

    function assertJsonStructure() {
        // TODO
        return $this;
    }

    function assertJsonValidationErrors() {
        // TODO
        return $this;
    }

    function assertLocation() {
        return $this;
    }

    function assertNoContent(): self
    {
        expect($this->response->data)->toBeNull();
        return $this;
    }

    function assertNotFound() {
        return $this->assertStatus(404);
    }

    function assertOk() {
        return $this->assertStatus(200);
    }

    function assertPlainCookie() {
        // TODO
        return $this;
    }

    function assertRedirect()
    {
        expect($this->response->statusCode)->toBeGreaterThanOrEqual(300)->toBeLessThan(320);
        return $this;
    }

    // function assertRedirectToSignedRoute() {
    // }

    function assertSee($text): self
    {
        test()->assertStringContainsString($text, $this->response->content);
        return $this;
    }

    function assertSeeInOrder(): self
    {
        // TODO
        return $this;
    }

    function assertSeeText(string $text): self
    {
        return $this->assertSee($text);
    }

    function assertSeeTextInOrder(string $text): self
    {
        // TODO
        return $this;
    }

    function assertSessionHas(): self
    {
        // TODO
        return $this;
    }

    function assertSessionHasInput(): self
    {
        // TODO
        return $this;
    }

    function assertSessionHasAll(): self
    {
        // TODO
        return $this;
    }

    function assertSessionHasErrors(): self
    {
        // TODO
        return $this;
    }

    function assertSessionHasErrorsIn(): self
    {
        // TODO
        return $this;
    }

    function assertSessionHasNoErrors(): self
    {
        // TODO
        return $this;
    }

    function assertSessionDoesntHaveErrors(): self
    {
        // TODO
        return $this;
    }

    function assertSessionMissing(): self
    {
        // TODO
        return $this;
    }

    function assertStatus(int $code): self
    {
        test()->assertSame($code, $this->response->statusCode);
        return $this;
    }

    function assertSuccessful() {
        // TODO
        return $this;
    }

    function assertUnauthorized() {
        // TODO
        return $this;
    }

    function assertValid() {
        // TODO
        return $this;
    }

    function assertInvalid() {
        // TODO
        return $this;
    }

    function assertViewHas() {
        // TODO
        return $this;
    }

    function assertViewHasAll() {
        // TODO
        return $this;
    }

    function assertViewIs() {
        // TODO
        return $this;
    }

    function assertViewMissing() {
        // TODO
        return $this;
    }

}
