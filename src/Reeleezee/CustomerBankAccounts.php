<?php
/**
 * Created by PhpStorm.
 * User: wietse
 * Date: 29-6-17
 * Time: 15:16
 */

namespace Reeleezee;


class CustomerBankAccounts
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
    public function getCustomerBankAccounts($baseId)
    {
        return $this->reeleezee->request('customers/' . $baseId. '/bankrelations', $this->reeleezee->username, $this->reeleezee->password);
    }
}