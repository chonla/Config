<?php

use Chonla\Cfg\Config;

class ConfigTest extends \PHPUnit_Framework_TestCase {
	
	private $temp_yaml;
	private $temp_json;

	public function setUp() {
		$this->temp_yaml = __DIR__.'/data/temp.yaml';
		$this->temp_json = __DIR__.'/data/temp.json';
	}

	public function tearDown() {
		if (file_exists($this->temp_yaml)) {
			unlink($this->temp_yaml);
		}
		if (file_exists($this->temp_json)) {
			unlink($this->temp_json);
		}
	}

	public function testSaveYaml() {
		$expected = 200;
		$config = Config::load(__DIR__.'/data/pass.yaml');
		$config->set('test.me', $expected);
		$config->save($this->temp_yaml);
		$config = Config::load($this->temp_yaml);
		$result = $config->get('test.me');
		$this->assertEquals($expected, $result);
	}

	public function testSaveJsonFromYaml() {
		$expected = 200;
		$config = Config::load(__DIR__.'/data/pass.yaml');
		$config->set('test.me', $expected);
		$config->save($this->temp_json);
		$config = Config::load($this->temp_json);
		$result = $config->get('test.me');
		$this->assertEquals($expected, $result);
	}

}