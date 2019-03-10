<?php

namespace Game\Output;

use Game\Heroes\IFighter;

class HtmlOutput implements IOutput
{
    /**
     * Output the result of the fight
     * @param IFighter $attacker
     * @param IFighter $defender
     * @param int $round
     * @param int $oldDefenderHealth
     */
    public function render(IFighter $attacker, IFighter $defender,  int $round, int $oldDefenderHealth): void
    {
        $html = '<div class="fighterPresentation">';
        $html = '<p>Presentation of the heroes involved in the fight</p>';
        $html .= '<div class="divTable">
                    <div class="divTableBody">
                        <div class="divTableRow">
                            <div class="divTableCell">Hero\'s name</div>
                            <div class="divTableCell">Health</div>
                            <div class="divTableCell">Strength</div>
                            <div class="divTableCell">Defence</div>
                            <div class="divTableCell">Speed</div>
                            <div class="divTableCell">Luck</div>
                        </div>
                        <div class="divTableRow">
                            <div class="divTableCell">' . $attacker . '</div>
                            <div class="divTableCell">' . $attacker->getHealth() . '</div>
                            <div class="divTableCell">' . $attacker->getStrength() . '</div>
                            <div class="divTableCell">' . $attacker->getDefence() . '</div>
                            <div class="divTableCell">' . $attacker->getSpeed() . '</div>
                            <div class="divTableCell">' . $attacker->getLuck() . '</div>
                        </div>
                        <div class="divTableRow">
                            <div class="divTableCell">' . $defender . '</div>
                            <div class="divTableCell">' . $defender->getHealth() . '</div>
                            <div class="divTableCell">' . $defender->getStrength() . '</div>
                            <div class="divTableCell">' . $defender->getDefence() . '</div>
                            <div class="divTableCell">' . $defender->getSpeed() . '</div>
                            <div class="divTableCell">' . $defender->getLuck() . '</div>
                        </div>
                    </div>
                </div>';





        $html .= 'Round ' . $round . '<br />';
        $html .= $attacker . ' with ' . $attacker->getHealth() . ' attacks ' . $defender . ' with ' . $oldDefenderHealth . '<br />';
        if ($getLucky) {
            $html .= $defender . ' gets luck this turn and did not get any damage!' . '<br />';
        } else {

            if (!empty($skillsUsedByAttacker)) {
                $html .= 'In this turn ' . $attacker . ' used the following skills: ' . '<br />';
                foreach ($skillsUsedByAttacker as $skill) {
                    $html .= $skill . '<br />';
                }
            }

            if (!empty($skillsUsedByDefender)) {
                $html .= 'In this turn ' . $defender . ' used the following skills: ' . '<br />';
                foreach ($skillsUsedByDefender as $skill) {
                    $html .= $skill . '<br />';
                }
            }

            $html .= $defender . ' lost ' . $damageDone . ' health points! And left with ' . $defenderHealthLeft . ' health points' . '<br />';

            if ($defenderHealthLeft == 0) {
                $html .= '<br /><br /><br />And the winner in this epic battle is ' . $attacker . '<br />';
            }
        }

        $html .= '<br /><br /><br />';

        echo $html;
    }
}