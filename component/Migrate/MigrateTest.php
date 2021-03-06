<?php

namespace Neoan3\Component\Migrate;

use Neoan3\Provider\FileSystem\MockFile;
use Neoan3\Provider\FileSystem\Native;
use PHPUnit\Framework\TestCase;

/**
 * Class PostTest
 * Generated by neoan3-cli
 * @package Neoan3\Component\Migrate
 */
class MigrateTest extends TestCase
{
    private MigrateController $instance;
    private Native $fileSystem;
    function setUp(): void
    {
        $this->fileSystem = new MockFile();
        $this->instance = new MigrateController(null, $this->fileSystem);
    }
        /**
     *  Route output shall have no errors
     */
    public function testInit()
    {

        $this->fileSystem->putContents(path.'/model/NotModel/migrate.json',"{}");
        $this->fileSystem->putContents(path.'/model/NotModel/migrate.json',"{}");
        $this->expectOutputRegex('/^<!doctype html>/');
        $this->instance->init();
    }

    function testPostMigrate()
    {
        $mock =['migrate'=>['test'=>'me'],'name'=>'notModel'];
        $this->fileSystem->putContents(path . '/model/NotModel','');
        $this->fileSystem->putContents(path.'/model/NotModel/migrate.json',"{}");
        $response = $this->instance->postMigrate($mock);
        $this->assertIsArray($response);
        $this->assertSame(['test'=>'me'], $mock['migrate']);
    }

}
