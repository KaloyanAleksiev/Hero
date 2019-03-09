<?php

namespace Game\Battlefield;

use Game\Heroes\IFighter;

interface IBattlefield
{
    public function fight(IFighter $fighter1 , IFighter $fighter2):void ;
}