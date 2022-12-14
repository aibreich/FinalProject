<?php
/**
 *Author: Marielle Harrell
 *Date: 11/15/2022
 *File: sausageModel.class.php
 *Description:
 */

class Sausage
{
    //private attributes
    private $id, $name, $description, $price, $stock_quantity, $heat, $image;

    public function __construct($id, $name, $price, $stock_quantity, $description, $heat, $image)
    {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->stock_quantity = $stock_quantity;
        $this->description = $description;
        $this->heat = $heat;
        $this->image = $image;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    //set item id
    public function setId($id) {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    public function getHeat()
    {
        return $this->heat;
    }

    public function getStock()
    {
        return $this->stock_quantity;
    }

    public function getImage(){
        return $this->image;
    }

}
