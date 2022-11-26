<?php if (Yii::$app->session->hasFlash('success')) : ?>
	<div class="success-add-subject" x-data :class="$store.openForm.close && '-closed'">
		<div class="success-add-text">
			<svg class="close-form">
				<use xlink:href="/images/svg-sprite/symbol/svg/sprite.symbol.svg#cuccess" aria-hidden="true"></use>
			</svg>
			Добавлено
		</div>
	</div>
<?php endif ?>
