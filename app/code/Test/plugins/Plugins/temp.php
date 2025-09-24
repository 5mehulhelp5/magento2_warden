<?php

namespace Test\plugins\Plugins;

class temp
{
    // public function beforegetcode(\Test\plugins\Model\temp $sub)
    // {
    //     return ['111111111111111'];
    // }
    // public function aftergetcode(\Test\plugins\Model\temp $sub, string $result): string
    // {
    //     return $result . '00';
    // }

    public function aroundgetcode(\Test\plugins\Model\temp $sub, callable $proc)
    {
        return $proc('111111111111111') . '00';
    }
}
