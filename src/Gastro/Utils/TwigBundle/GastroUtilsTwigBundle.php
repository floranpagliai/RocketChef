<?php

namespace Gastro\Utils\TwigBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class GastroUtilsTwigBundle extends Bundle
{
    public function getParent()
    {
        return 'TwigBundle';
    }
}
