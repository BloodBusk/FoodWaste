<?php

class Food
{
    private $foodName;
    private $foodPrice;
    private $foodAmount;
    private $storeName;


    public function DisplayFood()
    {
        $string = "<div class='foodCard'>";
            $string .= "<p class='right storeName'>" . $this->storeName . "</p>";
            $string .= "<div>";
                $string .= "<p class='semiBold foodName'>" . $this->foodName . "</p>";
                $string .= "<p class='foodPrice'>" . $this->foodPrice . ",-" ."</p>";
            $string .= "</div>";
            $string .= "<div>";
                $string .= "<p>Amount Left:</p>";
                $string .= "<p>" . $this->foodAmount . "</p>";
            $string .= "</div>";
            $string .= "<div>";
                $string .= "<p>Best Before:</p>";
                $string .= "<p>17/12</p>";
            $string .= "</div>";
            $string .= "<div>";
            $string .= "<button class='addToCart addToShoppingCart'>Add to cart</button>";
        $string .= "</div>";
        $string .= "</div>";
        return $string;
    }
}
