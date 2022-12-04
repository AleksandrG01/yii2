
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
						<div class="subject-option-text"><?= $subject->administrative_center ?></div>
					</div>
					<div class="subject-option-item">
						<div class="subject-option-title">Территория</div>
						<div class="subject-option-text"><?= $subject->territory ?></div>
					</div>
					<div class="subject-option-item">
						<div class="subject-option-title">Население</div>
						<div class="subject-option-text"><?= $subject->population ?> чел.</div>
					</div>
				</div>
			</div>
			<div class="subject-okato">
				<div class="subject-okato-title">окато</div>
				<div class="subject-okato-text"><?= $subject->okato ?></div>
			</div>
		</div>
	<?php endforeach ?>
</div>