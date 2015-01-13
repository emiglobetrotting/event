<?php

/*
 * This file is part of the Supervisor Event package.
 *
 * (c) Márk Sági-Kazár <mark.sagikazar@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Supervisor\Stub;

use Supervisor\Event\Notification;
use Supervisor\Exception\EventHandlingFailed;
use Supervisor\Exception\StopListener;

/**
 * Handles notifications a limited time only
 *
 * The limited time should at least be 3 to cover all paths
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
class Handler implements \Supervisor\Event\Handler
{
    /**
     * Stores how many times the handler was called
     *
     * @var integer
     */
    protected $count = 0;

    /**
     * {@inheritdoc}
     */
    public function handle(Notification $notification)
    {
        $this->count++;

        if ($this->count === 1) {
            return;
        } elseif ($this->count === 2) {
            throw new EventHandlingFailed;
        } else {
            throw new StopListener;
        }
    }
}
