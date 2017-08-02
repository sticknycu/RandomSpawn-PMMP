<?php

namespace NycuRO\RandomSpawn;

use pocketmine\Player;
use pocketmine\utils\TextFormat;
use pocketmine\plugin\PluginBase;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\level\Position;
use pocketmine\math\Vector3;

class RandomSpawn extends PluginBase
{
    public function onLoad()
    {
        $this->getLogger()->info(TextFormat::YELLOW . "RandomSpawn is loaded succesfully!");
    }

    public function onEnable()
    {
        $this->getLogger()->info(TextFormat::GREEN . "RandomSpawn-PMMP is enabled succesfully!");
    }

    public function onDisable()
    {
        $this->getLogger()->info(TextFormat::RED . "RandomSpawn-PMMP is disabled succesfully!");
    }

    public function onCommand(CommandSender $sender, Command $command, $label, array $args)
    {
        switch ($command->getName())
        {
            case "rspawn":
                if (!$sender->hasPermission("nycuro.rspawn"))
                {
                    $sender->sendMessage("You don't have permission to use this command!");
                }
                else
                {
                    if ($sender instanceof Player)
                    {
                        $x = mt_rand(100, 100000);
                        $y = mt_rand(1, 256);
                        $z = mt_rand(100, 100000);
                        $coords = $sender->getLevel()->getSafeSpawn(new Vector3($x, $y, $z));
                        $sender->teleport($coords);
                        $sender->sendMessage(TextFormat::GREEN . "You are teleported to Wild!");
                        $sender->sendMessage(TextFormat::YELLOW . "Your position is selected random!");
                    }
                    else
                    {
                        $sender->sendMessage(TextFormat::RED . "This command is used only in game by Player!");
                    }
                }
                return true;
            default:
                return false;
        }
    }
}
