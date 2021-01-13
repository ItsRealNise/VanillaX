<?php

namespace CLADevs\VanillaX\entities\loot;

use CLADevs\VanillaX\scheduler\DownloadLootTableTask;
use CLADevs\VanillaX\VanillaX;
use pocketmine\Server;
use pocketmine\utils\TextFormat;

class LootManager{

    /** @var LootTable[] */
    private array $lootTables = [];

    public function startup(): void{
        $path = VanillaX::getInstance()->getDataFolder() . "loot_tables";
        if(!file_exists($path)){
            VanillaX::getInstance()->getLogger()->notice(TextFormat::RED . "loot tables not found, downloading...");
            Server::getInstance()->getAsyncPool()->submitTask(new DownloadLootTableTask(VanillaX::getInstance()->getDataFolder()));
            return;
        }
        $this->initializeLootTable("loot_tables");
    }

    /**
     * @return LootTable[]
     */
    public function getLootTables(): array{
        return $this->lootTables;
    }

    public function getLootTableFor(string $name): ?LootTable{
        return $this->lootTables[strtolower($name)] ?? null;
    }

    public function initializeLootTable(string $directory): void{
        $path = VanillaX::getInstance()->getDataFolder() . $directory;

        if(!file_exists($path)) return;
        foreach(array_diff(scandir($path), [".", ".."]) as $file){
            if(is_dir($filePath = $path . DIRECTORY_SEPARATOR . $file)){
                $this->initializeLootTable($directory . DIRECTORY_SEPARATOR . $file);
            }else{
                $info = pathinfo($file);
                if($info["extension"] === "json"){
                    $result = json_decode(file_get_contents($filePath), true);
                    $this->lootTables[strtolower($info["filename"])] = new LootTable($result);
                }
            }
        }
    }
}