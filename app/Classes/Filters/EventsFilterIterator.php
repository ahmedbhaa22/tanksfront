<?php
namespace App\Classes\Filters;


class EventsFilterIterator extends \FilterIterator
{
    public function accept()
    {
        $current = $this->current();

        if(array_key_exists('active', $current) && !empty($current['active'])) {
            return true;
        }

        return false;
    }
}