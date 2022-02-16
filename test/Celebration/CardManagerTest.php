<?php
namespace Braddle\Celebration;

use Mockery\Adapter\Phpunit\MockeryTestCase;
use \Mockery as m;

class CardManagerTest extends MockeryTestCase
{
    private CardManager $cardManager;
    private EventRetriever $eventRetrieverMock;
    private Sender $senderSpy;
    private Person $personMock;
    private Event $eventMock;

    public function setUp(): void
    {
        parent::setUp();

        $this->eventRetrieverMock = m::mock(EventRetriever::class);
        $this->senderSpy = m::spy(Sender::class);

        $this->cardManager = new CardManager(
            $this->eventRetrieverMock,
            $this->senderSpy
        );

        $this->personMock = m::mock(Person::class);
        $this->personMock->shouldReceive("getEmail")->andReturn("test@test.com");
        $this->personMock->shouldReceive("getName")->andReturn("Teo");

        $this->eventMock = m::mock(Event::class);
    }
    public function test_sendCelebration_whenBirthday_1year_sendingCardWithBabyTemplate():void
    {
        $this->eventMock->shouldReceive("getType")->andReturn("Birthday");
        $this->eventMock->shouldReceive("getYears")->andReturn(1);

        $this->eventRetrieverMock->shouldReceive('getEvent')
            ->with($this->personMock)
            ->andReturn($this->eventMock);

         $this->cardManager->sendCelebration($this->personMock);

        $this->senderSpy
            ->shouldHaveReceived('send')
            ->with("Teo", "test@test.com", 'TEMPLATE_BABY');
    }

    public function test_sendCelebration_whenBirthday_3years_sendingCardWithToddlerTemplate():void
    {
        $this->eventMock->shouldReceive("getType")->andReturn("Birthday");
        $this->eventMock->shouldReceive("getYears")->andReturn(3);

        $this->eventRetrieverMock->shouldReceive('getEvent')
            ->with($this->personMock)
            ->andReturn($this->eventMock);

        $this->cardManager->sendCelebration($this->personMock);

        $this->senderSpy
            ->shouldHaveReceived('send')
            ->with("Teo", "test@test.com", 'TEMPLATE_TODDLER');
    }

    public function test_sendCelebration_whenAnniversary_1year_sendingCardWithPaperTemplate():void
    {
        $this->eventMock->shouldReceive("getType")->andReturn("Anniversary");
        $this->eventMock->shouldReceive("getYears")->andReturn(1);

        $this->eventRetrieverMock->shouldReceive('getEvent')
            ->with($this->personMock)
            ->andReturn($this->eventMock);

        $this->cardManager->sendCelebration($this->personMock);

        $this->senderSpy
            ->shouldHaveReceived('send')
            ->with("Teo", "test@test.com", 'TEMPLATE_PAPER');
    }

    public function test_sendCelebration_returnException_1year_whenTypeNotFound(): void
    {
        $this->eventMock->shouldReceive("getType")->andReturn("TEST");
        $this->eventMock->shouldReceive("getYears")->andReturn(1);

        $this->expectException(\Exception::class);

        $this->cardManager->sendCelebration($this->personMock);
    }
}
