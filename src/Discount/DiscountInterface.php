<?php


namespace Mtest\Discount;


interface DiscountInterface
{
    public function setVariable($name, $var);
    public function getHtml($template);
}