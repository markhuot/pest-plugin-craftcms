<?php

namespace Pest\CraftCms;

use Symfony\Component\DomCrawler\Crawler;

class TestableResponseBehavior extends \yii\base\Behavior {
    /** @var \craft\web\Response */
    public $owner;

    public function querySelector($selector) {
        $html = $this->owner->data;
        $crawler = new Crawler($html);
        return new NodeList($crawler->filter($selector));
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
        test()->assertStringNotContainsString($text, $this->owner->data);
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
        $value = $this->owner->headers->get($name);
        if ($expected === null) {
            test()->assertNotNull($value);
        }
        else {
            test()->assertSame($expected, $value);
        }
        return $this;
    }

    function assertHeaderMissing($name) {
        test()->assertNull($this->owner->headers->get($name));
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
        // TODO
        return $this;
    }

    function assertNoContent() {
        // TODO
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

    function assertRedirect() {
        test()->toBeGreaterThanOrEqual(300)
            ->toBeLessThanOrEqual(399);
        return $this;
    }

    // function assertRedirectToSignedRoute() {
    // }

    function assertSee($text) {
        test()->assertStringContainsString($text, $this->owner->data);
        return $this;
    }

    function assertSeeInOrder() {
        // TODO
        return $this;
    }

    function assertSeeText(string $text) {
        return $this->assertSeeTextInOrder($text);
    }

    function assertSeeTextInOrder() {
        // TODO
        return $this;
    }

    function assertSessionHas() {
        // TODO
        return $this;
    }

    function assertSessionHasInput() {
        // TODO
        return $this;
    }

    function assertSessionHasAll() {
        // TODO
        return $this;
    }

    function assertSessionHasErrors() {
        // TODO
        return $this;
    }

    function assertSessionHasErrorsIn() {
        // TODO
        return $this;
    }

    function assertSessionHasNoErrors() {
        // TODO
        return $this;
    }

    function assertSessionDoesntHaveErrors() {
        // TODO
        return $this;
    }

    function assertSessionMissing() {
        // TODO
        return $this;
    }

    function assertStatus($code) {
        test()->assertSame($code, $this->owner->statusCode);
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
