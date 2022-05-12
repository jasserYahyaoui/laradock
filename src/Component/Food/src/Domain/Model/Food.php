<?php
/**
 * Created by PhpStorm.
 * User: jasser
 * Date: 09/05/22
 * Time: 15:32
 */

namespace App\Component\Food\src\Domain\Model;


class Food
{
    private $name;

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }
}