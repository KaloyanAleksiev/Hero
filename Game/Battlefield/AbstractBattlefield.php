<?php

namespace Game\Battlefield;

use Game\Heroes\IFighter;
use Game\Output\HtmlOutput;

class AbstractBattlefield implements IBattlefield
{
    private $numberOfRounds;

    /**
     * @var IFighter
     */
    private $firstAttacker;
    /**
     * @var IFighter
     */
    private $secondAttacker;
    /**
     * @var HtmlOutput
     */
    private $htmlOutput;

    /**
     * AbstractBattlefield constructor.
     * @param int $numberOfRounds
     * @throws \Exception
     */
    public function __construct(int $numberOfRounds)
    {
        $this->htmlOutput = new HtmlOutput();
        $this->setNumberOfRounds($numberOfRounds);
    }

    /**
     * Makes fight between two fighters
     * @param IFighter $fighter1
     * @param IFighter $fighter2
     */
    public function fight(IFighter $fighter1, IFighter $fighter2): void
    {
        $this->setAttackerPosition($fighter1, $fighter2);

        for ( $i = 1; $i <= $this->getNumberOfRounds(); $i++ ) {
            if ($i % 2 == 0) {
                $oldDefenderHealth = $this->firstAttacker->getHealth();

                $this->secondAttacker->attack($this->firstAttacker);

                $this->htmlOutput->render(
                    $this->secondAttacker,
                    $this->firstAttacker,
                    $this->firstAttacker->getLucky(),
                    $this->secondAttacker->getSkillsUsed(),
                    $this->firstAttacker->getSkillsUsed(),
                    max($oldDefenderHealth - $this->firstAttacker->getHealth(), 0),
                    $this->firstAttacker->getHealth(),
                    $i,
                    $oldDefenderHealth
                );
            } else {
                $oldDefenderHealth = $this->secondAttacker->getHealth();

                $this->firstAttacker->attack($this->secondAttacker);

                $this->htmlOutput->render(
                    $this->firstAttacker,
                    $this->secondAttacker,
                    $this->secondAttacker->getLucky(),
                    $this->firstAttacker->getSkillsUsed(),
                    $this->secondAttacker->getSkillsUsed(),
                    max($oldDefenderHealth - $this->secondAttacker->getHealth(), 0),
                    $this->secondAttacker->getHealth(),
                    $i,
                    $oldDefenderHealth
                );
            }

            if ($this->firstAttacker->getHealth() == 0 || $this->secondAttacker->getHealth() == 0) {
                break;
            }
        }
    }

    /**
     * Set number of rounds
     * @param int $numberOfRounds
     * @throws \Exception
     */
    protected function setNumberOfRounds(int $numberOfRounds): void
    {
        if (isset($numberOfRounds) && filter_var($numberOfRounds, FILTER_VALIDATE_INT, array('options' => array('min_range' => 1)))) {
            $this->numberOfRounds = $numberOfRounds;
        } else {
            throw new \Exception("Need to set a proper value for the number of the rounds");
        }
    }

    /**
     * @return int
     */
    public function getNumberOfRounds(): int
    {
        return $this->numberOfRounds;
    }

    /**
     * Set first and second attacker
     * @param IFighter $fighter1
     * @param IFighter $fighter2
     */
    private function setAttackerPosition(IFighter $fighter1 , IFighter $fighter2): void
    {
        $this->firstAttacker = $fighter1;
        $this->secondAttacker = $fighter2;
        if ($fighter1->getSpeed() < $fighter2->getSpeed()) {
            $this->firstAttacker = $fighter2;
            $this->secondAttacker = $fighter1;
        } else if ($fighter1->getSpeed() == $fighter2->getSpeed()) {
            if ($fighter1->getLuck() < $fighter2->getLuck()) {
                $this->firstAttacker = $fighter2;
                $this->secondAttacker = $fighter1;
            }
        }
    }

}