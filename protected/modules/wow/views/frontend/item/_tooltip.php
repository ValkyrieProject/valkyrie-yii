    <span  class="icon-frame frame-56" style='background-image: url("http://eu.battle.net/wow-assets/static/images/icons/56/<?=$model->icon?>.jpg");'></span>
    <?php if($full): ?>
    <h3 class="subheader color-q<?=$model->Quality?>"><?=$model->name?></h3>
    <?php endif; ?>
    <ul class="item-specs" style="margin: 0">
        <?php if($model->Map): ?>
		<li><?=$this->map_text?></li>
		<?php endif; if($model->Flags & $model::ITEM_FLAGS_CONJURED): ?>
		<li>Conjured</li>
		<?php endif; if($model->bonding > 0 && $model->bonding < 4): ?>
		<li><?=$model::itemAlias('bonding',$model->bonding)?></li>
		<?php endif; if($model->maxcount == 1): ?>
		<li>Unique</li>
		<?php endif; if(in_array($model->class, array($model::ITEM_CLASS_ARMOR, $model::ITEM_CLASS_WEAPON))): ?>
        <li><span class="float-right"><?=$model->subclass_text['subclass']?></span><?=$model::itemAlias('invtype', $model->InventoryType)?></li>
        <?php endif; if($model->class == $model::ITEM_CLASS_CONTAINER): ?>
		<li><?=$model->ContainerSlots?> Slot Bag</li>
		<?php endif; if($model->class == $model::ITEM_CLASS_WEAPON): ?>
        <li>
			<span class="float-right">Speed <?=$model->delay/1000?></span>
			<?=$model->dmg_min1?> - <?=$model->dmg_max1?> Damage
		</li>
		<li>(<?=$model->dps?>  damage per second)</li>
        <?php endif; if($model->class == $model::ITEM_CLASS_PROJECTILE && $model->dmg_min1 > 0 && $model->dmg_max1 > 0): ?>
        <li>+<?=($model->dmg_min1 + $model->dmg_max1) / 2?> damage per second</li>
		<?php endif; if($model->block): ?>
		<li><?=$model->block?> Block</li>
        <?php endif; if($model->armor): ?>
		<li><?=$model->armor?> Armor</li>
		<?php endif; if($model->fire_res): ?>
		<li>+<?=$model->fire_res?> Fire Resistance</li>
        <?php endif; if($model->nature_res): ?>
		<li>+<?=$model->nature_res?> Nature Resistance</li>
        <?php endif; if($model->frost_res): ?>
		<li>+<?=$model->frost_res?> Frost Resistance</li>
        <?php endif; if($model->shadow_res): ?>
		<li>+<?=$model->shadow_res?> Shadow Resistance</li>
        <?php endif; if($model->arcane_res): ?>
		<li>+<?=$model->arcane_res?> Arcane Resistance</li>
		<?php endif; foreach($model->stats as $stat):
            if($stat['type'] >= 3 && $stat['type'] <= 8): ?>
		<li id="stat-<?=$stat['type']?>">+<span><?=$stat['value']?></span> <?=$model::itemAlias('stat', $stat['type'])?></li>
		<?php endif; endforeach; if($model->MaxDurability > 0): ?>
        <li>Durability <?=$model->MaxDurability?>/<?=$model->MaxDurability?></li>
		<?php endif; if($model->AllowableClass AND is_array($model->required_classes)): ?>
        <li>Classes: <?=implode(', ', $model->required_classes)?></li>
        <?php endif; if($model->AllowableRace AND is_array($model->required_races)): ?>
        <li>Races: <?=implode(', ', $model->required_races)?></li>
        <?php endif; if($model->RequiredLevel): ?>
		<li>Requires Level <?=$model->RequiredLevel?></li>
		<?php endif; if($model->RequiredSkill): ?>
        <li>Requires <?=$model->required_skill?> (<?=$model->RequiredSkillRank?>)</li>
        <?php endif; if($model->requiredspell): ?>
        <li>Requires <?=$model->required_spell?></li>
        <?php endif; if($model->RequiredReputationFaction) :?>
		<li>Requires <?$model->required_faction?> - <?=Faction::itemAlias('rank',$model->RequiredReputationRank)?></li>
        <?php endif; if($model->ItemLevel): ?>
        <li>Item Level <?=$model->ItemLevel?></li>
        <?php endif; if($model->itemset): ?>
		<li>
        	<ul class="item-specs">
            	<li class="color-tooltip-yellow"><?=$model->set['name']?> (0/<?=$model->set['count']?>)</li>
        <?php foreach($model->set['items'] as $item): ?>
				<li class="indent">
					<a class="color-d4 has-tip" href="/wow/item/<?=$item['entry']?>"><?=$item['name']?></a>
				</li>
		<?php endforeach; ?>
            	<li class="indent-top"></li>
        <?php foreach($model->set['bonuses'] as $piece => $spell): ?>
				<li class="color-d4">(<?=$piece?>) Set: <?=$spell->info?></li>
		<?php endforeach; ?>
        	</ul>
        </li>
        <?php endif; foreach($model->spells as $spell): ?>
        <li class="color-q2">
			<?=$model::itemAlias('spell_trigger', $spell['trigger'])?>: <?=$spell['description']?>
		</li>
       	<?php endforeach; if($model->description): ?>
		<li class="color-tooltip-yellow">"<?=$model->description?>"</li>
		<?php endif; if($model->SellPrice > 0): $sMoney = array('gold', 'silver', 'copper'); ?>
		<li>Sell Price:
        <?php foreach($sMoney as $money): if($model->sell_price[$money] > 0): ?>
        	<span class="icon-<?=$money?>"><?=$model->sell_price[$money]?></span>
        <?php endif; endforeach; ?>
		</li>
        <?php endif; ?>
    </ul>
<span class="clear"><!-- --></span>