<?php

#______           _    _____           _                  
#|  _  \         | |  /  ___|         | |                 
#| | | |__ _ _ __| | _\ `--. _   _ ___| |_ ___ _ __ ___   
#| | | / _` | '__| |/ /`--. \ | | / __| __/ _ \ '_ ` _ \  
#| |/ / (_| | |  |   </\__/ / |_| \__ \ ||  __/ | | | | | 
#|___/ \__,_|_|  |_|\_\____/ \__, |___/\__\___|_| |_| |_| 
#                             __/ |                       
#                            |___/

namespace pocketmine\block;

use pocketmine\item\Item;
use pocketmine\item\Tool;
use pocketmine\nbt\NBT;
use pocketmine\nbt\tag\CompoundTag;
use pocketmine\nbt\tag\ListTag;
use pocketmine\nbt\tag\IntTag;
use pocketmine\nbt\tag\StringTag;
use pocketmine\Player;
use pocketmine\tile\Dropper as TileDropper;
use pocketmine\tile\Tile;

class Dropper extends Solid
{
    protected $id = self::DROPPER;

    public function __construct($meta = 0)
    {
        $this->meta = $meta;
    }

    public function canBeActivated()
    {
        return true;
    }

    public function getHardness()
    {
        return 3.5;
    }

    public function getName()
    {
        return "Dropper";
    }

    public function getToolType()
    {
        return Tool::TYPE_PICKAXE;
    }

    public function place(Item $item, Block $block, Block $target, $face, $fx, $fy, $fz, Player $player = null)
    {
        $dispenser = null;
        if ($player instanceof Player) {
            $pitch = $player->getPitch();
            if (abs($pitch) >= 45) {
                if ($pitch < 0) $f = 4;
                else $f = 5;
            } else $f = $player->getDirection();
        } else $f = 0;
        $faces = [
            3 => 3,
            0 => 4,
            2 => 5,
            1 => 2,
            4 => 0,
            5 => 1
        ];
        $this->meta = $faces[$f];

        $this->getLevel()->setBlock($block, $this, true, true);
        $nbt = new CompoundTag("", [
            new ListTag("Items", []),
            new StringTag("id", Tile::DROPPER),
            new IntTag("x", $this->x),
            new IntTag("y", $this->y),
            new IntTag("z", $this->z)
        ]);
        $nbt->Items->setTagType(NBT::TAG_Compound);

        if ($item->hasCustomName()) {
            $nbt->CustomName = new StringTag("CustomName", $item->getCustomName());
        }

        if ($item->hasCustomBlockData()) {
            foreach ($item->getCustomBlockData() as $key => $v) {
                $nbt->{$key} = $v;
            }
        }

        Tile::createTile(Tile::DROPPER, $this->getLevel(), $nbt);

        return true;
    }

    public function activate()
    {
        $tile = $this->getLevel()->getTile($this);
        if ($tile instanceof TileDropper) {
            $tile->activate();
        }
    }

    public function onActivate(Item $item, Player $player = null)
    {
        if ($player instanceof Player) {
            $t = $this->getLevel()->getTile($this);
            $dropper = null;
            if ($t instanceof TileDropper) {
                $dropper = $t;
            } else {
                $nbt = new CompoundTag("", [
                    new ListTag("Items", []),
                    new StringTag("id", Tile::DROPPER),
                    new IntTag("x", $this->x),
                    new IntTag("y", $this->y),
                    new IntTag("z", $this->z)
                ]);
                $nbt->Items->setTagType(NBT::TAG_Compound);
                $dropper = Tile::createTile(Tile::DROPPER, $this->getLevel(), $nbt);
            }
            
            $player->addWindow($dropper->getInventory());
        }

        return true;
    }

    public function getDrops(Item $item): array
    {
        return [
            [$this->id, 0, 1],
        ];
    }
}
