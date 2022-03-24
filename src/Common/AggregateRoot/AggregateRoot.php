<?php

namespace App\Common\AggregateRoot;

/**
 * Class AggregateRoot
 * @author John White <john@jontyy.com>
 */
abstract class AggregateRoot implements AggregateRootInterface
{
    use AggregateRootTrait;
}
