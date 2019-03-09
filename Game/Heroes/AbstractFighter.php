<?php

namespace Game\Heroes;

use Game\Heroes\IFighter;

abstract class AbstractFighter implements IFighter
{
    private $health;
    private $strength;
    private $defence;
    private $speed;
    private $luck;
    /**
     * If true the fighter get lucky this turn
     * @var bool
     */
    private $getLucky = false;

    /**
     * AbstractFighter constructor.
     * @param array $healthRange
     * @param array $strengthRange
     * @param array $defenceRange
     * @param array $speedRange
     * @param array $luckRange
     * @throws \Exception
     */
    public function __construct(array $healthRange, array $strengthRange, array $defenceRange, array $speedRange, array $luckRange)
    {

        $this->health = $this->generateProperty($healthRange,"health");
        $this->strength = $this->generateProperty($strengthRange,"strength");
        $this->defence = $this->generateProperty($defenceRange,"defence");
        $this->speed = $this->generateProperty($speedRange,"speed");
        $this->luck = $this->generateProperty($luckRange,"luck");
    }

    /**
     * Generate property in range
     * @param array $range
     * @param string $propertyName
     * @return int
     * @throws \Exception
     */
    protected function generateProperty(array $range, string $propertyName): int
    {
        if ($this->checkRange($range)) {
            return rand($range[0], $range[1]);
        } else {
            throw new \Exception("Your hero must possess some " . $propertyName . " in range (e.g.: [x,y])");
        }
    }

    /**
     * Helper function to check hero's properties range
     * @param array $range
     * @return bool
     */
    private function checkRange(array $range): bool
    {
        if (isset($range) && is_array($range) && count($range) == 2 && filter_var($range[0], FILTER_VALIDATE_INT, array('options' => array('min_range' => 0))) && filter_var($range[1], FILTER_VALIDATE_INT, array('options' => array('min_range' => 0)))) {
            return true;
        }
        return false;
    }

    /**
     * Check if the fighter get lucky
     * @return bool
     */
    private function didYouGetLucky(): bool
    {
        $luck = rand(1,100);
        if ($this->luck <= $luck) {
            return true;
        }
        return false;
    }

    /**
     * Attacks other fighter
     * @param IFighter $defender
     */
    public function attack(IFighter $defender): void
    {
        $defender->defend($this->strength);
    }

    /**
     * Defend from enemy attacks
     * @param int $strikePower
     */
    public function defend(int $strikePower) :void
    {
        if ($this->didYouGetLucky()) {
            $this->getLucky = true;
            return;
        }
        $this->health = max($this->health - max($strikePower - $this->defence, 0), 0);
    }

    /**
     * Return hero's speed
     * @return int
     */
    public function getSpeed(): int
    {
        return $this->speed;
    }

    /**
     * Return hero's luck
     * @return int
     */
    public function getLuck(): int
    {
        return $this->luck;
    }

    /**
     * Return hero's health
     * @return int
     */
    public function getHealth(): int
    {
        return $this->health;
    }

    /**
     * Return true if the hero get lucky
     * @return bool
     */
    public function getLucky(): bool
    {
        return $this->getLucky;
    }

    /**
     * @return string
     * @throws \ReflectionException
     */
    public function __toString(): string
    {
        return preg_replace('/([a-z])([A-Z])/','$1 $2', (new \ReflectionClass($this))->getShortName());
    }
}