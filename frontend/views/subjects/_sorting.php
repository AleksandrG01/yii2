<?php

use frontend\controllers\SubjectsController;
?>

<div class="subject-sorting-wrapper">
	<a href="#" class="--js-open-close-form button -hover-red-bg -iconed-right" onclick="openCloseForm()">
		Добавить 
		<i>
			<svg>
				<use xlink:href="/images/svg-sprite/symbol/svg/sprite.symbol.svg#pluss" aria-hidden="true"></use>
			</svg>
		</i>
	</a>
	<div class="subject-sorting">
		<div class="subject-sorting-text --js-sorting-open-close" onclick="openCloseSorting()">
			Сортировать по 
			<span ><?= SubjectsController::textSorting($sort_name) ?></span>
		</div>
		<ul class="subject-sorting-list --js-subject-sorting-list" style="display: none;">
			<li @click="show = false"><?= $sort->link('territory') ?></li>
			<li @click="show = false"><?= $sort->link('population') ?></li>
			<li @click="show = false"><?= $sort->link('okato') ?></li>
		</ul>
	</div>
</div>


