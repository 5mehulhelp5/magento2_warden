<?php

namespace DependencyInjection\Example\Model;

class Main
{

    public DependencyInjectable $injectable;
    public array $arr;
    public function __construct(DependencyInjectableInterface $injectable, array $arr = [])
    {
        $this->injectable = $injectable;
        $this->arr = $arr;
    }

    public function getArr(): array
    {
        return $this->arr;
    }
}
