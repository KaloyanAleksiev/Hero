<?php

namespace Game\Battlefield;


class AlleopForest extends AbstractBattlefield
{
    const NUMBER_OF_ROUNDS = 20;

    public function __construct()
    {
        parent::__construct(self::NUMBER_OF_ROUNDS);
    }
}