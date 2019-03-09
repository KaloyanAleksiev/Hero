<?php

namespace Game\Heroes;


interface IFighter
{
    public function attack(IFighter $defender): void;

    public function defend(int $strikePower): void;

    public function getSpeed(): int;

    public function getLuck(): int;

    public function getHealth(): int;

    public function getLucky(): bool;

    public function getSkillsUsed(): array;

}