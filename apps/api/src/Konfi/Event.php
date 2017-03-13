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

    public $sort;

    public function __construct(
        \DateTimeImmutable $start,
        \DateTimeImmutable $end,
        string $summary,
        string $organizer,
        string $location
    ) {
        $this->start = $start->setTimezone(new \DateTimeZone('Europe/Berlin'))->format('Y-m-d H:i');
        $this->end = $end->setTimezone(new \DateTimeZone('Europe/Berlin'))->format('Y-m-d H:i');
        $this->summary = $summary;
        $this->organizer = $organizer;
        $this->location = $location;

        $this->sort = $start->getTimestamp();
    }
}
