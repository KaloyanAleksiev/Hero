<?php
/**
 * Created by PhpStorm.
 * User: kaloyan
 * Date: 08.03.19
 * Time: 17:04
 */

namespace Game\Heroes;


class WildBeast extends AbstractFighter
{
    const HEALTH_RANGE = [60,90];
    const STRENGTH_RANGE = [60,90];
    const DEFENCE_RANGE = [40,60];
    const SPEED_RANGE = [40,60];
    const LUCK_RANGE = [25,40];

    /**
     * @var array of skills used each turn
     */
    private $usedSkills = array();

    public function __construct()
    {
        parent::__construct(self::HEALTH_RANGE, self::STRENGTH_RANGE, self::DEFENCE_RANGE, self::SPEED_RANGE, self::LUCK_RANGE);
    }

    /**
     * Attacks other fighter
     * @param IFighter $defender
     */
    public function attack(IFighter $defender): void
    {
        if ($defender->didYouGetLucky()) {
            return;
        }
        $this->strike($defender);
    }

    /**
     * Defence from enemy attacks
     * @param int $strikePower
     */
    public function defence(int $strikePower): void
    {
        $this->defend($strikePower);
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