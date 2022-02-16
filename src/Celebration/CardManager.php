<?php
namespace Braddle\Celebration;

use function Composer\Autoload\includeFile;

class CardManager
{
    private const TYPE_BIRTHDAY = 'Birthday';
    private const TYPE_ANNIVERSARY = 'Anniversary';

    private EventRetriever $eventRetriever;
    private Sender $sender;

    public function __construct(EventRetriever $eventRetriever, Sender $sender)
    {
        $this->eventRetriever = $eventRetriever;
        $this->sender = $sender;
    }

    public function sendCelebration(Person $person) : void
    {
        $event = $this->eventRetriever->getEvent($person);

        $template = $this->getTemplate($event->getType(), $event->getYears());

        $this->sender->send($person->getName(), $person->getEmail(), $template);
    }

    private function getTemplate(string $type, int $years): string
    {
        if($type === self::TYPE_BIRTHDAY){
            return $this->getBirthdayTemplate($years);
        }

        if($type === self::TYPE_ANNIVERSARY){
            return $this->getAnniversaryTemplate($years);
        }

        throw new \Exception("not type defined");
    }

    private function getBirthdayTemplate(int $years): string
    {
        if($years === 1){
            return "TEMPLATE_BABY";
        }elseif ($years > 1 && $years < 5){
            return "TEMPLATE_TODDLER";
        }elseif ($years > 4 && $years < 13){
            return "TEMPLATE_CHILD";
        }elseif ($years > 12 && $years < 18){
            return "TEMPLATE_TEENAGER";
        }else{
            return "TEMPLATE_ADULT";
        }
    }

    private function getAnniversaryTemplate(int $years): string
    {
        if($years === 1){
            return "TEMPLATE_PAPER";
        }elseif($years === 25){
            return "TEMPLATE_SILVER";
        }elseif ($years === 40){
            return "TEMPLATE_RUBY";
        }elseif ($years === 50){
            return "TEMPLATE_GOLD";
        }elseif ($years === 60){
            return "TEMPLATE_DIAMOND";
        }else{
            return "TEMPLATE_ANNIVERSARY";
        }
    }
}