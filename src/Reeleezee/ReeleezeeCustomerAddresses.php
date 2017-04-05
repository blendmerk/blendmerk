<?php
/**
 * Created by PhpStorm.
 * User: Wietse van Ginkel
 * Date: 5-4-2017
 * Time: 16:20
 */

namespace Reeleezee;

/**
 * Class ReeleezeeCustomerAddresses
 *
 * @package Reeleezee
 */
class ReeleezeeCustomerAddresses
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
    public function getCustomerAddresses($baseId)
    {
        return $this->reeleezee->request('customers/' . $baseId. '/addresses', $this->reeleezee->username, $this->reeleezee->password);
    }
}