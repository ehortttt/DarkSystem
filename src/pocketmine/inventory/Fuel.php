<?php

#______           _    _____           _                  
#|  _  \         | |  /  ___|         | |                 
#| | | |__ _ _ __| | _\ `--. _   _ ___| |_ ___ _ __ ___   
#| | | / _` | '__| |/ /`--. \ | | / __| __/ _ \ '_ ` _ \  
#| |/ / (_| | |  |   </\__/ / |_| \__ \ ||  __/ | | | | | 
#|___/ \__,_|_|  |_|\_\____/ \__, |___/\__\___|_| |_| |_| 
#                             __/ |                       
#                            |___/

namespace pocketmine\inventory;

use pocketmine\item\Item;

//TODO: remove this

abstract class Fuel{
	
	public static $duration = [
		Item::COAL => 1600,
		Item::COAL_BLOCK => 16000,
		Item::TRUNK => 300,
		Item::WOODEN_PLANKS => 300,
		Item::SAPLING => 100,
		Item::WOODEN_AXE => 200,
		Item::WOODEN_PICKAXE => 200,
		Item::WOODEN_SWORD => 200,
		Item::WOODEN_SHOVEL => 200,
		Item::WOODEN_HOE => 200,
		Item::STICK => 100,
		Item::FENCE => 300,
		Item::FENCE_GATE => 300,
		Item::FENCE_GATE_SPRUCE => 300,
		Item::FENCE_GATE_BIRCH => 300,
		Item::FENCE_GATE_JUNGLE => 300,
		Item::FENCE_GATE_ACACIA => 300,
		Item::FENCE_GATE_DARK_OAK => 300,
		Item::WOODEN_STAIRS => 300,
		Item::SPRUCE_WOOD_STAIRS => 300,
		Item::BIRCH_WOOD_STAIRS => 300,
		Item::JUNGLE_WOOD_STAIRS => 300,
		Item::TRAPDOOR => 300,
		Item::WORKBENCH => 300,
		Item::BOOKSHELF => 300,
		Item::CHEST => 300,
		Item::BUCKET => 20000,
	];

}
