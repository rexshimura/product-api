<?php

require_once "repositories\ProductRepository.php";
require_once "repositories\interface\IProductRepository.php";

class ProductController {
    private IProductRepository $productRepository;

    public function __construct() {
        $this->productRepository = new ProductRepository();
    }

    public function welcome() {
        echo json_encode(["message" => "Welcome to Product API"]);
    }

    public function GetAllProduct() 
    {
        // Return All ProductId, ProductName, ProductPrice, ProductDate and its Prices
        echo json_encode($this->productRepository->GetAllProduct(1));
    }

    public function GetLatestPriceOfTheProduct() 
    {
        // Return Products with Latest Price
        echo json_encode($this->productRepository->GetLatestPriceOfTheProduct(1));
    }

    public function GetProductById($productId) 
    {
        echo json_encode($this->productRepository->GetProductById($productId));
    }

}