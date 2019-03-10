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
        $html = '';
        if ($round == 1) {
            $html .= '<div class="fighterPresentation">
                <p>Presentation of the heroes involved in the fight</p>
                <div class="divTable">
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
                </div>
             </div>
             <div class="fightStart">
                 <p>Fight Start!</p>
             </div>
             ';

            $html .= "";
        }

        $html .= '<div class="fightRound">
            <div class="divTable">
                <div class="divTableBody">
                    <div class="divTableRow">
                        <div class="divTableCell">Round ' . $round . '</div>
                    </div>
                    <div class="divTableRow">
                        <div class="divTableCell">' . $attacker . ' attacks ' . $defender . '</div>
                    </div>
                    <div class="divTableRow">
                        <div class="divTableCell">';

                        if ($defender->getLucky()) {
                            $html .= $defender . ' gets luck this turn and did not get any damage!';
                        } else {

                            if (!empty($attacker->getSkillsUsed())) {
                                $html .= 'In this turn ' . $attacker . ' used the following skills: ' . '<br />';
                                foreach ($attacker->getSkillsUsed() as $skill) {
                                    $html .= $skill . '<br /><br />';
                                }
                            }

                            if (!empty($defender->getSkillsUsed())) {
                                $html .= 'In this turn ' . $defender . ' used the following skills: ' . '<br />';
                                foreach ($defender->getSkillsUsed() as $skill) {
                                    $html .= $skill . '<br /><br />';
                                }
                            }

                            $html .= $defender . ' lost ' . max($oldDefenderHealth - $defender->getHealth(), 0) . ' health points! And left with ' . $defender->getHealth() . ' health points.' . '<br />';

                        }

                        $html .= '
                        </div>
                    </div>
                </div>
            </div>
        </div>';

        if ($defender->getHealth() == 0) {
            $html .= '<div class="fightWinner">
                    <p>And the winner in this epic battle is ' . $attacker . '!!!</p>
            </div>';
        }

        echo $html;
    }
}