<?php
namespace App\Classes\Filters;

class OffersFilterIterator extends \FilterIterator
{
    public function accept()
    {
        $current = $this->current();

        return true;
    }
}