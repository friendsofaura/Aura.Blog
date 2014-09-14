<?php
namespace Aura\Blog\Domain;

class BlogFactory
{
    public function newEntity($row)
    {
        return new BlogEntity($row);
    }

    public function newCollection($rows)
    {
        $collection = array();
        foreach ($rows as $row) {
            $collection[] = $this->newEntity($row);
        }
        return $collection;
    }
}
