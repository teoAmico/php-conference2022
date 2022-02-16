<?php

namespace Braddle\Bowling;

use PHPUnit\Framework\TestCase;

class GameTest extends TestCase
{
    private Game $game;
    public function setUp(): void
    {
        $this->game = new Game();
    }

    public function test_score_whenZero(): void
    {
        $this->assertEquals(0, $this->game->score('-- -- -- -- -- -- -- --'));
    }

    public function test_score_whenOnePoint(): void
    {
        $this->assertEquals(1, $this->game->score('1- -- -- -- -- -- -- --'));
    }

    public function test_score_whenTwoPoint(): void
    {
        $this->assertEquals(2, $this->game->score('2- -- -- -- -- -- -- --'));
    }

    public function test_score_whenTwoPointSecondRoll(): void
    {
        $this->assertEquals(2, $this->game->score('11 -- -- -- -- -- -- --'));
    }

    public function test_score_whenSpare(): void
    {
        $this->assertEquals(10, $this->game->score('1/ -- -- -- -- -- -- --'));
    }

    public function test_score_whenStrike(): void
    {
        $this->assertEquals(10, $this->game->score('X- -- -- -- -- -- -- --'));
    }

    public function test_score_whenSpareWithBonusOnePoint(): void
    {
        $this->assertEquals(12, $this->game->score('1/ 1- -- -- -- -- -- --'));
    }

    public function test_score_whenSpareWithBonusTwoPoint(): void
    {
        $this->assertEquals(14, $this->game->score('1/ 2- -- -- -- -- -- --'));
    }

    public function test_score_whenSpareWithBonusStrikePoint(): void
    {
        $this->assertEquals(30, $this->game->score('1/ X- -- -- -- -- -- --'));
    }

    public function test_score_whenSpareWithBonusSparePoint(): void
    {
        $this->assertEquals(30, $this->game->score('1/ 1/ -- -- -- -- -- --'));
    }

    public function test_score_whenStrikeWithBonusTwoPoint(): void
    {
        $this->assertEquals(14, $this->game->score('X- 1- 1- -- -- -- -- --'));
    }
}