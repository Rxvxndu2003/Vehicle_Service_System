<?php

use PHPUnit\Framework\TestCase;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\WebDriverBy;

class LoginTest extends TestCase
{
    protected $webDriver;

    public function setUp(): void
    {
        $host = 'http://localhost:4444/wd/hub'; // Selenium server URL
        $capabilities = DesiredCapabilities::chrome(); // Or use DesiredCapabilities::firefox() for Firefox
        $this->webDriver = RemoteWebDriver::create($host, $capabilities);
    }

    public function testLogin()
    {
        // Visit the login page
        $this->webDriver->get('http://your-laravel-app-url/login');

        // Find and fill in the login form fields
        $this->webDriver->findElement(WebDriverBy::id('email'))->sendKeys('your-email@example.com');
        $this->webDriver->findElement(WebDriverBy::id('password'))->sendKeys('your-password');

        // Submit the form
        $this->webDriver->findElement(WebDriverBy::cssSelector('button[type="submit"]'))->click();

        // Assert you are on the dashboard
        $this->assertStringContainsString('Dashboard', $this->webDriver->getTitle());
    }

    public function tearDown(): void
    {
        $this->webDriver->quit();
    }
}