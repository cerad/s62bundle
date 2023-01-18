<?php

namespace App;

use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;

define('PROJECT_ROOT', dirname(__DIR__));

class Kernel extends BaseKernel
{
    use MicroKernelTrait;
}
