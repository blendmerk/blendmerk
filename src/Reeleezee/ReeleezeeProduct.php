<?php
/**
 * Created by PhpStorm.
 * User: Wietse van Ginkel
 * Date: 3-4-2017
 * Time: 17:17
 */

namespace Reeleezee;


class ReeleezeeProduct
{
    public function __construct(Reeleezee $reeleezee) {
        $this->reeleezee = $reeleezee;
    }
    public function getProducts()
    {
        return $this->reeleezee->request('products', $this->reeleezee->username, $this->reeleezee->password);
    }
}