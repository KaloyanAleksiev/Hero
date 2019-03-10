<?php

namespace Game\Heroes;


interface IFighter
{
    /**
     * Attacks other fighter
     * @param IFighter $defender
     */
    public function attack(IFighter $defender): void;

    /**
     * Defend from enemy attacks
     * @param int $strikePower
     */
    public function defend(int $strikePower): void;

    /**
     * Return and set getLucky property to true if the defender get lucky
     * @return bool
     */
    public function didYouGetLucky(): bool;

    /**
     * Return hero's speed
     * @return int
     */
    public function getSpeed(): int;

    /**
     * Return hero's luck
     * @return int
     */
    public function getLuck(): int;

    /**
     * Return hero's health
     * @return int
     */
    public function getHealth(): int;

    /**
     * Return hero's strength
     * @return int
     */
    public function getStrength(): int;

    /**
     * Return hero's defence
     * @return int
     */
    public function getDefence(): int;

    /**
     * Return true if the hero get lucky
     * @return bool
     */
    public function getLucky(): bool;

    /**
     * Return skills used by the hero
     * @return array
     */
    public function getSkillsUsed(): array;

    /**
     * @return string
     */
    public function __toString(): string;

}