<?php

class CharacterStats extends CActiveRecord
{
	private $_levelStats = array();

    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    public function getDbConnection()
    {
        return Database::getConnection(Database::$realm);
    }

    public function tableName()
    {
        return 'character_stats';
    }

    public function relations()
    {
        return array(
            'character' => array(self::BELONGS_TO, 'Character', 'guid'),
        );
    }

	public function getLevelStats()
	{
		if(!$this->_levelStats)
			$this->_levelStats = Yii::app()->db_world->createCommand("
				SELECT str AS strength, agi AS agility, sta AS stamina, inte AS intellect, spi AS spirit 
				FROM player_levelstats 
				WHERE race = {$this->character->race} 
					AND class = {$this->character->class} 
					AND level = {$this->character->level}
				LIMIT 1")->queryRow();
		return $this->_levelStats;
	}
	
	public function getMainDps()
	{
		return round(($this->mainMinDmg + $this->mainMaxDmg) / 2 / $this->mainAttSpeed, 1);
	}
	
	public function getOffDps()
	{
		return round(($this->offMinDmg + $this->offMaxDmg) / 2 / $this->offAttSpeed, 1);
	}

	public function getRangedDps()
	{
		return round(($this->rangeMinDmg + $this->rangeMaxDmg) / 2 / $this->rangeAttSpeed, 1);
	}
}
