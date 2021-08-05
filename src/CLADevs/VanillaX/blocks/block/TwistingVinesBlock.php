<?php

namespace CLADevs\VanillaX\blocks\block;

use CLADevs\VanillaX\blocks\utils\BlockVanilla;
use CLADevs\VanillaX\items\ItemIdentifiers;
use pocketmine\block\BlockBreakInfo;
use pocketmine\block\BlockIdentifier;
use pocketmine\block\Transparent;

class TwistingVinesBlock extends Transparent{

    public function __construct(){
        parent::__construct(new BlockIdentifier(BlockVanilla::TWISTING_VINES, 0, ItemIdentifiers::TWISTING_VINES), "Twisting Vines", new BlockBreakInfo(0));
    }
}