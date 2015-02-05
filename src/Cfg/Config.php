<?php

namespace Chonla\Cfg;

use \Symfony\Component\Yaml\Yaml;

class Config extends \Noodlehaus\Config {
	
	/**
	* Overwirte defaut loadYaml, due to Symfony change.
	*/
    protected function loadYaml($path)
    {
        try {
            $data = Yaml::parse(file_get_contents($path));
        }
        catch(\Exception $ex) {
            throw new ParseException(
                array(
                    'message'   => 'Error parsing YAML file',
                    'exception' => $ex
                )
            );
        }

        return $data;
    }

    protected function saveYaml($path)
    {
        $output = Yaml::dump($this->data);
        file_put_contents($path, $output);
    }

    protected function saveJson($path)
    {
        file_put_contents($path, json_encode($this->data));
    }

    public function save($path) {
        $info = pathinfo($path);

        // Check if a load-* method exists for the file extension, if not throw exception
        $save_method = 'save' . ucfirst($info['extension']);
        if (!method_exists(__CLASS__, $save_method)) {
            throw new UnsupportedFormatException('Unsupported configuration format');
        }

        $this->$save_method($path);
    }

}