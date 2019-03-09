<?php
/**
 * Created by PhpStorm.
 * User: kaloyan
 * Date: 08.03.19
 * Time: 16:57
 */

namespace Game\Output;


use Game\Heroes\IFighter;

interface IOutput
{
    /**
     * Output the result of the fight
     * @param IFighter $attacker
     * @param IFighter $defender
     * @param int $round
     * @param int $oldDefenderHealth
     */
    public function render(IFighter $attacker, IFighter $defender, int $round, int $oldDefenderHealth): void;

}