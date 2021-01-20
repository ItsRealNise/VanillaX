<?php

namespace CLADevs\VanillaX\entities\boss;

use CLADevs\VanillaX\entities\LivingEntity;

class EnderDragonEntity extends LivingEntity{

    public $width = 13;
    public $height = 4;

    const NETWORK_ID = self::ENDER_DRAGON;

    protected function initEntity(): void{
        parent::initEntity();
        $this->setMaxHealth(200);
    }

    public function getName(): string{
        return "Ender Dragon";
    }
}