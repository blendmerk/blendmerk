<?php
/**
 * Created by PhpStorm.
 * User: Wietse van Ginkel
 * Date: 4-4-2017
 * Time: 11:09
 */

namespace Reeleezee;

/**
 * Class ReeleezeeProductVAT
 *
 * @package Reeleezee
 */
class ReeleezeeProductVAT
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
    public function getVatClasses()
    {
        return $this->reeleezee->request('ProductVATClasses', $this->reeleezee->username, $this->reeleezee->password);
    }
}