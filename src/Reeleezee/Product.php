<?php
/**
 * Created by PhpStorm.
 * User: Wietse van Ginkel
 * Date: 3-4-2017
 * Time: 17:17
 */

namespace Reeleezee;

/**
 * Class ReeleezeeProduct
 *
 * @package Reeleezee
 */
class Product
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
     * @return array
     */
    public function getProducts()
    {
        return $this->reeleezee->request('products', $this->reeleezee->username, $this->reeleezee->password);
    }

    /**
     * @param string $description
     * @param float  $price
     * @param null   $barcode
     * @param null   $code
     * @param int    $costPrice
     * @param int    $purchasePrice
     * @param int    $retailPrice
     *
     * @return mixed
     */
    public function add($description = null, $price = 0.00, $vat, $barcode = null, $code = null, $costPrice = 0, $purchasePrice = 0, $retailPrice = 0)
    {
        $data = [
            'IsArchived' => false,
            'IsBillable' => true,
            'IsStockEnabled' => false,
            'BarCode' => $barcode,
            'Code' => $code,
            'Comment' => $description,
            'Description' => $description,
            'SearchName' => $description,
            'CostPrice' => $costPrice,
            'Price' => $price,
            'PurchasePrice' => $purchasePrice,
            'RetailPrice' => $retailPrice,
            'ProductVATClass' => $vat
        ];

        return $this->reeleezee->request('products/' . $this->reeleezee->guid(), 'PUT', $data);
    }
}