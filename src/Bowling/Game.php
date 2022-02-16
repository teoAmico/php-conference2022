<?php

namespace Braddle\Bowling;

class Game
{
    private int $score = 0;
    private bool $spareBonus = false;
    private bool $strikeBonusFirstRoll = false;
    private bool $strikeBonusSecondRoll = false;

    public function score(string $game): int
    {
        $rolls = explode(' ', $game);

        foreach ($rolls as $roll){
            $this->calculateSpareBonus($roll);
            $this->calculateStrikeBonus($roll);
            $this->calculateRollScores($roll);
        }

        return $this->score;
    }

    private function isStrike(string $pin): bool
    {
        return strtoupper($pin) === 'X';
    }

    private function isSpare(string $pin): bool
    {
        return strtoupper($pin) === '/';
    }

    private function calculateRollScores(string $roll): void
    {
        if($this->isSpare($roll[1])){
            $this->score += (10 - (int)$roll[0]);
            $this->spareBonus = true;
        }

        if($this->isStrike($roll[0] )){
            $this->score += 10;
            $this->strikeBonusFirstRoll = true;
        }

        if(is_numeric((int) $roll[0])){
            $this->score += (int)$roll[0];
        }
        if(is_numeric((int) $roll[1])){
            $this->score += (int)$roll[1];
        }
    }

    private function calculateSpareBonus(string $roll): void
    {
        if($this->spareBonus){
            $this->spareBonus = false;
            $this->calculateRollScores($roll);
        }
    }

    private function calculateStrikeBonus(string $roll): void
    {
        if($this->strikeBonusSecondRoll){
            $this->strikeBonusSecondRoll = false;
            $this->calculateRollScores($roll);
        }

        if($this->strikeBonusFirstRoll){
            $this->strikeBonusFirstRoll = false;
            $this->strikeBonusSecondRoll = true;
            $this->calculateRollScores($roll);
        }

    }

}