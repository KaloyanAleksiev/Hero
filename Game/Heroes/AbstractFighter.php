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
    private $getLucky;

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
        $this->setHealth($healthRange);
        $this->setStrength($strengthRange);
        $this->setDefence($defenceRange);
        $this->setSpeed($speedRange);
        $this->setLuck($luckRange);
    }

    /**
     * Set Health property
     * @param array $range
     * @throws \Exception
     */
    protected function setHealth(array $range): void
    {
        if ($this->checkRange($range)) {
            $this->health = rand($range[0], $range[1]);
        } else {
            throw new \Exception("Your hero must possess some health in range (e.g.: [x,y])");
        }

    }
    /**
     * Set Strength property
     * @param array $range
     * @throws \Exception
     */
    protected function setStrength(array $range): void
    {
        if ($this->checkRange($range)) {
            $this->strength = rand($range[0], $range[1]);
        } else {
            throw new \Exception("Your hero must possess some strength in range (e.g.: [x,y])");
        }

    }

    /**
     * Set Defence property
     * @param array $range
     * @throws \Exception
     */
    protected function setDefence(array $range): void
    {
        if ($this->checkRange($range)) {
            $this->defence = rand($range[0], $range[1]);
        } else {
            throw new \Exception("Your hero must possess some defence in range (e.g.: [x,y])");
        }
    }

    /**
     * Set Speed property
     * @param array $range
     * @throws \Exception
     */
    protected function setSpeed(array $range): void
    {
        if ($this->checkRange($range)) {
            $this->speed = rand($range[0], $range[1]);
        } else {
            throw new \Exception("Your hero must possess some speed in range (e.g.: [x,y])");
        }
    }

    /**
     * Set Luck property
     * @param array $range
     * @throws \Exception
     */
    protected function setLuck(array $range): void
    {
        if ($this->checkRange($range)) {
            $this->luck = rand($range[0], $range[1]);
        } else {
            throw new \Exception("Your hero must possess some luck in range (e.g.: [x,y])");
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
     * The actual strike/hit action
     * @param IFighter $defender
     */
    protected function strike(IFighter $defender): void
    {
        $defender->defence($this->strength);
    }

    /**
     * The actual defend action
     * @param int $strikePower
     */
    protected function defend(int $strikePower) :void
    {
        $this->health = max($this->health - max($strikePower - $this->defence, 0), 0);
    }

    /**
     * Set true if the fighter get lucky
     * @return bool
     */
    public function didYouGetLucky(): bool
    {
        $luck = rand(1,100);
        if ($this->luck <= $luck) {
            $this->getLucky = true;
            return true;
        }
        $this->getLucky = false;
        return false;

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