<?php

/*
 *
 *  ____            _        _   __  __ _                  __  __ ____
 * |  _ \ ___   ___| | _____| |_|  \/  (_)_ __   ___      |  \/  |  _ \
 * | |_) / _ \ / __| |/ / _ \ __| |\/| | | '_ \ / _ \_____| |\/| | |_) |
 * |  __/ (_) | (__|   <  __/ |_| |  | | | | | |  __/_____| |  | |  __/
 * |_|   \___/ \___|_|\_\___|\__|_|  |_|_|_| |_|\___|     |_|  |_|_|
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * @author PocketMine Team
 * @link http://www.pocketmine.net/
 *
 *
*/

declare(strict_types=1);

namespace pocketmine\level\biome;

use pocketmine\block\Sapling;
use pocketmine\level\generator\populator\BigTree;
use pocketmine\level\generator\populator\TallGrass;
use pocketmine\level\generator\populator\Tree;

class JungleBiome extends GrassyBiome{

	public const TYPE_NORMAL = 0;
	public const TYPE_JUNGLE = 3;

	/** @var int */
	public $type;

	public function __construct(int $type = self::TYPE_NORMAL){
		parent::__construct();

		$this->type = $type;

		$trees = new Tree($type === self::TYPE_JUNGLE ? Sapling::JUNGLE : Sapling::JUNGLE);
		$bigTrees = new BigTree($type === self::TYPE_JUNGLE ? Sapling::JUNGLE : Sapling::JUNGLE);
		$trees->setBaseAmount(6);
		$bigTrees->setBaseAmount(2);
		$this->addPopulator($trees);
		$this->addPopulator($bigTrees);

		$tallGrass = new TallGrass();
		$tallGrass->setBaseAmount(4);

		$this->addPopulator($tallGrass);

		$this->setElevation(63, 81);

		if($type === self::TYPE_JUNGLE){
			$this->temperature = 0.5;
			$this->rainfall = 0.7;
		}else{
			$this->temperature = 0.6;
			$this->rainfall = 0.8;
		}
	}

	public function getName() : string{
		return $this->type === self::TYPE_JUNGLE ? "Jungle Forest" : "Forest Jungle";
	}
}
