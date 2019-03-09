<?php
/**
 * Created by PhpStorm.
 * User: kaloyan
 * Date: 08.03.19
 * Time: 13:52
 */

namespace Game\Skills;


abstract class AbstractSkill implements ISkill
{
    protected $chanceToUse;

    public function __construct(int $chanceToUse)
    {
        $this->chanceToUse = $chanceToUse;
    }

    /**
     * Return true if the skill was used
     * @return bool
     */
    public function used(): bool
    {
        $use = rand(1,100);
        if ($this->chanceToUse <= $use) {
            return true;
        }
        return false;
    }

    /**
     * Return the name of the skill
     * @return string
     * @throws \ReflectionException
     */
    public function getSkillName(): string
    {
        return preg_replace('/([a-z])([A-Z])/','$1 $2', (new \ReflectionClass($this))->getShortName());
    }
}