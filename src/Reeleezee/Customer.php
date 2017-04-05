<?php
/**
 * Created by PhpStorm.
 * User: Wietse van Ginkel
 * Date: 5-4-2017
 * Time: 15:10
 */

namespace Reeleezee;

/**
 * Class ReeleezeeCustomer
 *
 * @package Reeleezee
 */
class Customer
{
    /**
     * @var \Reeleezee\Reeleezee
     */
    protected $reeleezee;
    /**
     * ReeleezeeProduct constructor.
     *
     * @param \Reeleezee\Reeleezee $reeleezee
     */
    public function __construct(Reeleezee $reeleezee) {
        $this->reeleezee = $reeleezee;
    }

    /**
     * @return mixed
     */
    public function getCustomers()
    {
        return $this->reeleezee->request('customers', $this->reeleezee->username, $this->reeleezee->password);
    }
}