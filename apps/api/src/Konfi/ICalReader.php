<?php
/**
 * @date    2017-03-12
 * @file    ICalReader.php
 * @author  Patrick Mac Gregor <pmacgregor@3pc.de>
 */

namespace Macghriogair\Konfi;

use Sabre\VObject;

class ICalReader
{
    protected $cal;

    protected $config;

    protected $clientId;

    public function __construct(array $config, $clientId = null)
    {
        $this->config = $config;
        $this->clientId = $clientId;
        $this->validateClient();
        $contents = isset($config['file']) ? $this->fromFile($config['file']) : $this->fromURL($config['url']);
        $fullCalendar = VObject\Reader::read($contents, VObject\Reader::OPTION_FORGIVING);
        $this->cal = $fullCalendar->expand(new \DateTime(), (new \DateTime())->modify('+3 day'));
    }

    public function parse()
    {
        $events = [];

        foreach ($this->cal->VEVENT as $event) {
            if ($event->STATUS == 'CANCELLED') {
                continue;
            }

            $location = (string) $event->LOCATION;
            // not a client's room
            if (! $this->isRelevantRoom($location)) {
                continue;
            }
            $summary = (string) $event->SUMMARY;
            $events[] = new Event(
                $event->DTSTART->getDateTime(),
                $event->DTEND->getDateTime(),
                $summary,
                $event->ORGANIZER['CN'],
                $location
            );
        }
        return $events;
    }


    protected function validateClient()
    {
        if (! isset($this->config['clients'][$this->clientId])) {
            throw new \InvalidArgumentException("Invalid client Id!");
        }
    }

    protected function fromFile($path)
    {
        return fopen($path, 'r');
    }

    protected function fromURL($url)
    {
        $opts = [
            "ssl"=> [
                "verify_peer"=> false,
                "verify_peer_name"=> false
            ]
        ];
        return file_get_contents($url, false, stream_context_create($opts));
    }

    protected function isRelevantRoom($location)
    {
        $pattern = $this->config['clients'][$this->clientId]['pattern'];
        return preg_match($pattern, $location);
    }
}
