<?php

namespace MagicToolbox\Magic360\Plugin;

class ReplaceMagic360Icon
{
    public function afterGetMagic360IconPath($subject, $result)
    {
        return "custom/filename.jpg"; // relative to pub/media/magic360/
    }
}
