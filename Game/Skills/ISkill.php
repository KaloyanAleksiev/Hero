<?php

namespace Game\Skills;

interface ISkill
{
    /**
     * Return true if the skill was used
     * @return bool
     */
    public function used():bool;
}