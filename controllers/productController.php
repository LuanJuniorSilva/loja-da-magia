<?php
class productController extends controller
{
  public function index()
  {

    $products = new Products();

    $data = array(
      'products' => $products->getProducts(),
    );
    $this->loadView('products', $data);
  }
}
