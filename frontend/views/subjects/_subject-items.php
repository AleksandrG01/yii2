
<div class="subject-items">
	<?php foreach($subjects as $subject): ?>
		<div class="subject-item">
			<div class="subject-image _pic-fluid">
				<img width="100" height="100" src="<?= Yii::getAlias('@images/' . $subject->gerb) ?>" alt="<?= $subject->subject ?>">
			</div>
			<div class="subject-deskription">
				<div class="subject-title"><?= $subject->subject ?></div>
				<div class="subject-options">
					<div class="subject-option-item">
						<div class="subject-option-title">Адм. центр</div>
						<div class="subject-option-text"><?= $subject->administrative_center ? $subject->administrative_center : '-' ?></div>
					</div>
					<div class="subject-option-item">
						<div class="subject-option-title">Территория</div>
						<div class="subject-option-text"><?= number_format($subject->territory, 0, '', '.') ?></div>
					</div>
					<div class="subject-option-item">
						<div class="subject-option-title">Население</div>
						<div class="subject-option-text"><?= number_format($subject->population, 0, '', '.') ?> чел.</div>
					</div>
				</div>
			</div>
			<div class="subject-okato">
				<div class="subject-okato-title">окато</div>
				<div class="subject-okato-text"><?= number_format($subject->okato, 0, '', '.')  ?></div>
			</div>
		</div>
	<?php endforeach ?>
</div>