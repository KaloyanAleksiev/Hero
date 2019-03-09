<?php
namespace Game\Heroes;

use Game\Skills\MagicShieldSkill;
use Game\Skills\RapidStrikeSkill;

class Vaderus extends AbstractFighter
{
    const HEALTH_RANGE = [70,100];
    const STRENGTH_RANGE = [70,80];
    const DEFENCE_RANGE = [45,55];
    const SPEED_RANGE = [40,50];
    const LUCK_RANGE = [10,30];
    const RAPID_STRIKE_CHANCE = 10;
    const MAGIC_SHIELD_CHANCE = 20;

    /**
     * @var RapidStrikeSkill
     */
    private $rapidStrikeSkill;
    /**
     * @var MagicShieldSkill
     */
    private $magicShieldSkill;
    /**
     * @var array of skills used each turn
     */
    private $usedSkills = array();

    public function __construct()
    {
        $this->rapidStrikeSkill = new RapidStrikeSkill(self::RAPID_STRIKE_CHANCE);
        $this->magicShieldSkill = new MagicShieldSkill(self::MAGIC_SHIELD_CHANCE);
        parent::__construct(self::HEALTH_RANGE, self::STRENGTH_RANGE, self::DEFENCE_RANGE, self::SPEED_RANGE, self::LUCK_RANGE);
    }

    /**
     * Attacks other fighter
     * @param IFighter $defender
     * @throws \ReflectionException
     */
    public function attack(IFighter $defender): void
    {

        if ($defender->didYouGetLucky()) {
            return;
        }

        $this->resetSkillsUsed();
        if ($this->rapidStrikeSkill->use())
        {
            $this->usedSkills[] = $this->rapidStrikeSkill->getSkillName();
            $this->strike($defender);
        }

        $this->strike($defender);
    }

    /**
     * Defence from enemy attacks
     * @param int $strikePower
     * @throws \ReflectionException
     */
    public function defence(int $strikePower): void
    {
        $this->resetSkillsUsed();
        if ($this->magicShieldSkill->use()) {
            $this->usedSkills[] = $this->magicShieldSkill->getSkillName();
            $strikePower = intval(round($strikePower/2));
        }
        $this->defend($strikePower);
    }

    /**
     * Reset skills used
     */
    private function resetSkillsUsed(): void
    {
        $this->usedSkills = array();
    }

    /**
     * Return skills used by the hero
     * @return array
     */
    public function getSkillsUsed(): array
    {
        return $this->usedSkills;
    }

}