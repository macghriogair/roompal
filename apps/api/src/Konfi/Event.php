<?php
/**
 * @date    2017-03-12
 * @file    Event.php
 * @author  Patrick Mac Gregor <pmacgregor@3pc.de>
 */

namespace Macghriogair\Konfi;

class Event
{
    public $start;
    public $end;
    public $summary;
    public $organizer;
    public $location;

    public function __construct(
        \DateTimeImmutable $start,
        \DateTimeImmutable $end,
        string $summary,
        string $organizer,
        string $location
    ) {
        $this->start = $start->format('Y-m-d H:i');
        $this->end = $end->format('Y-m-d H:i');
        $this->summary = $summary;
        $this->organizer = $organizer;
        $this->location = $location;
    }
}
