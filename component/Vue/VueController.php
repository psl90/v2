<?php

namespace Neoan3\Component\Vue;

use Neoan3\Apps\Ops;
use Neoan3\Apps\Template;
use Neoan3\Frame\VastN3;
use Neoan3\Model;

/**
 * Class TestController
 * @package Neoan3\Component\Test
 *
 * Generated by neoan3-cli for neoan3 v3.*
 */

class VueController extends VastN3 {
    function init(){
        $controller = Ops::toPascalCase(sub(1));
        if(!sub(2)){
            $controller .= '/' . $controller;
        } else {
            $controller .= '/' . Ops::toCamelCase(sub(2));
            if(sub(3)){
                $controller .= '/' . lcfirst(sub(3));
            }
        }
        $path = path . '/component/'.$controller.'.vue';
        $template = $this->renderer->readTemplateTag($path);
        $doc = $this->renderer->loadDomDoc(file_get_contents($path));

        $script = $this->renderer->prepareScript($doc, $_GET);
        $component = Template::embrace($script,['template'=>$template]);

        header('Content-Type: text/javascript');
        echo $component;
        exit();
    }
    public function getVue(string $model, $params=[])
    {
        $modelClass = $this->autoLoadModel($model);
        return $modelClass::find($params);
    }
    public function postVue(string $model, $body = [])
    {
        $modelClass = $this->autoLoadModel($model);
        return $modelClass::create($body);
    }
    private function autoLoadModel($modelString)
    {
        $modelClass = '\\Neoan3\\Model\\' . Ops::toPascalCase($modelString) . '\\'.Ops::toPascalCase($modelString).'Model';
        $modelClass::init($this->provider);
        return $modelClass;
    }

}
