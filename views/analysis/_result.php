<br>
<br>

<div class="row">
<?php foreach ($result as $type => $words) : ?>
<div class="col-lg-3">
    <h4><?= $model->compare[$type] ?>:</h4>
    <?php foreach ($words as $word) : ?>
        <p><?= $word ?></p>
    <?php endforeach; ?>
    </p>
</div>
<?php endforeach; ?>
</div>