<?php

    require_once "connection/connection.php";

    class order {

        private $orderId = "";
        private $customerId = "";
        private $productId = "";
        private $productQty = "";
        private $price = "";
        private $comments = "";

        public function getOrderId() {
            return $this->orderId;
        }
        protected function setOrderId($orderId) {
            $this->orderId = $orderId;
            return null;
        }

        public function getCustomerId() {
            return $this->customerId;
        }
        public function setCustomerId($customerId){
            $this->customerId = $customerId;
            return null;
        }

        public function getProductId() {
            return $this->productId;
        }
        public function setProductId($productId) {
            $this->productId = $productId;
            return null;
        }

        public function getProductQty() {
            return $this->productQty;
        }
        public function setProductQty($productQty) {
            $this->productQty = $productQty;
            return null;
        }

        public function getPrice() {
            return $this->price;
        }
        public function setPrice($price) {
            $this->price = $price;
            return null;
        }

        public function getComments() {
            return $this->comments;
        }
        public function setComments($comments) {
            $this->comments = $comments;
            return null;
        }

        public function __construct($orderId = "", $customerId = "", $productId = "", $productQty = "", $price = "", $comments = "")  {

            if($orderId && $customerId && $productId && $productQty && $price && $comments) {
                $this->orderId = $orderId;
                $this->customerId = $customerId;
                $this->productId = $productId;
                $this->productQty = $productQty;
                $this->price = $price;
                $this->comments = $comments;
            }
        }

?>