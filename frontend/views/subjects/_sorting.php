<?php

use frontend\controllers\SubjectsController;
?>

<div class="subject-sorting-wrapper">
	<a href="#" class="button -hover-red-bg -iconed-right" :class="{ '-scrolled': styckyMenu, '': !styckyMenu }"
	@scroll.window="styckyMenu = (window.pageYOffset < 50) ? false: true" x-data @click.prevent="$store.openForm.toggle()">
		Добавить 
		<i>
			<svg>
				<use xlink:href="/images/svg-sprite/symbol/svg/sprite.symbol.svg#pluss" aria-hidden="true"></use>
			</svg>
		</i>
	</a>
	<div class="subject-sorting" x-data="{show:0, }"  @click.away="show = false" x-cloak>
		<div class="subject-sorting-text" @click="show = !show" @keydown.enter="show = !show" :class="{'active' : show}">
			Сортировать по 
			<span ><?= SubjectsController::textSorting($sort_name) ?></span>
		</div>
		<ul class="subject-sorting-list" x-show="show" x-cloak>
			<li @click="show = false"><?= $sort->link('territory') ?></li>
			<li @click="show = false"><?= $sort->link('population') ?></li>
			<li @click="show = false"><?= $sort->link('okato') ?></li>
		</ul>
	</div>
</div>
