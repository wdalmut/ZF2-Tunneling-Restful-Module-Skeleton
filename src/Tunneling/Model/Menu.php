<?php
namespace Tunneling\Model;

class Menu
{
    public function get($id)
    {
        return array("id" => $id);
    }

    public function add($name, $value)
    {
        return array("name" => $name, "value" => $value);
    }
}
