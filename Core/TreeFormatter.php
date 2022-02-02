<?php

namespace Root\Core;

use Root\App\Controllers\Controller;
use Root\App\Models\Objects\User;
use Root\App\Models\UserModel;

class TreeFormatter extends Controller
{

    /**
     * Undocumente
     *
     * @return string
     */
    public function format()
    {

        $root = $this->allUsers();
        $image = $root->getNodeIcon() == null ? "null" : explode(" AND ", $root->getNodeIcon());
        $image = str_replace("\\", "/", $image[1]);
        $json = "{";
        $json .= "\"Id\":\"{$root->getId()}\"";
        $json .= ",\"name\":\"{$root->getName()}\"";
        $json .= ",\"icon\":\"{$image}\"";
        $json .= ",\"foot\":" . ($root->getFoot() == null ? "null" : $root->getFoot());
        if ($root->hasChilds()) {
            $json .= ",\"childs\": [";
            foreach ($root->getChilds() as $key => $node) {
                $json .= $this->formatChild($node) . (($key != (count($root->getChilds()) - 1)) ? "," : "");
            }
            $json .= "]";
        }
        $json .= "}";
        //header('Content-Type: text/json');
        return $json;
    }

    /**
     * Undocumented function
     *
     * @param User $node
     * @return string
     */
    private function formatChild($node)
    {
        //var_dump($node->getId()); exit();
        $image = $node->getNodeIcon() == null ? "null" : explode(" AND ", $node->getNodeIcon());
        $image = str_replace("\\", "/", $image[1]);
        $json = " {";
        $json .= "\"Id\":\"{$node->getId()}\"";
        $json .= ",\"name\":\"{$node->getName()}\"";
        $json .= ",\"icon\":\"{$image}\"";
        $json .= ",\"foot\":" . ($node->getFoot() == null ? "null" : $node->getFoot());
        if ($node->hasChilds()) {
            $json .= ",\"childs\": [";
            foreach ($node->getChilds() as $key => $child) {
                $json .= $this->formatChild($child) . (($key != (count($node->getChilds()) - 1)) ? "," : "");
            }
            $json .= "]";
        }
        $json .= "}";
        return $json;
    }
}
