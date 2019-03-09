<?php

namespace Game\Battlefield;

use Game\Heroes\IFighter;

interface IBattlefield
{
    /**
     * Makes fight between two fighters
     * @param IFighter $fighter1
     * @param IFighter $fighter2
     */
    public function fight(IFighter $fighter1 , IFighter $fighter2):void ;
}