<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Result $result
 * @var $student
 * @var $nextRank
 *
 * TODO Add carousel feature
 */

?>

<?php
    $classMap = [
        '□' => 'btn-outline-secondary',
        '◎' => 'btn-success',
        '△' => 'btn-danger',
    ];

    $valueMap = [
        '□' => 0,
        '◎' => 1,
        '△' => 2,
    ];
?>

<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h1 class="heading">Results for <?= $student->name ?> </h1>
            <h2 class="heading"> <?= $student->rank->name ?> ===> <?= $nextRank->name ?> </h2>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="results view content">
        <?= $this->Form->create(null, [
                                        'type' => 'post',
                                        'url' => ['action' => 'updateStudentResults', $student->id],
        ]); ?>
        <table class="table table-striped table-hover table-bordered">
            <thead>
                <tr>
                  <th scope="col">十番台</th>
                  <th scope="col">1</th>
                  <th scope="col">2</th>
                  <th scope="col">3</th>
                  <th scope="col">4</th>
                  <th scope="col">5</th>
                  <th scope="col">6</th>
                  <th scope="col">7</th>
                  <th scope="col">8</th>
                  <th scope="col">9</th>
                  <th scope="col">10</th>
                </tr>
            </thead>
            <tbody>
            <?php
            foreach ($subranksWithResults as $subrank) : ?>
            <tr>
                <th scope="row"> <?= 10*$subrank->id ?> </th>
                <?php foreach ($subrank->worksheets as $worksheet) :
                    $result = $worksheet->results[0]->result;
                    $class = $classMap[$result];
                    $value = $valueMap[$result];
                ?>
                    <td>
                        <input type="range" class="btn-check" name="<?= $worksheet->id; ?>" autocomplete="off"
                                onclick="toggleme(this.id);" id="<?= $worksheet->id; ?>" value="<?= $value ?>">
                        <label  class="btn <?=$class ?>"
                                for="<?= $worksheet->id ?>"
                                id="label<?= $worksheet->id ?>">
                                    <?= $result ?>

                        </label><br/>
                        <?= $worksheet->id ?>
                    </td>
                <?php endforeach; ?>
            </tr>
            <?php endforeach; ?>


          </tbody>
        </table>
        <?= $this->Form->button(
            __('Save'),
            ['type' => 'submit', 'value' => 'save'],
            ['action' => 'updateStudentResults', $student->id]
        ) ?>
        <?= $this->Html->link(
            __('Rank Up!'),
            ['controller' => 'results', 'action' => 'rankUp', $student->id],
            ['class' => 'button', 'value' => $student->id]
        ) ?>
        <?= $this->Form->end(); ?>
        </div>
    </div>
</div>
<script>
    function toggleme(id) {
        var input = document.getElementById(id);
        var value = parseInt(input.value,10);
        var label = document.getElementById('label'+id);
        value++;
        if (value === 3) {
            value = 0;
        }
        input.value = value;
        switch (value) {
            case 0 : { label.innerText = "□"; label.className = "btn btn-outline-secondary"; }
            break;
            case 1 : { label.innerText = "◎"; label.className = "btn btn-success"; }
            break;
            case 2 : { label.innerText = "△"; label.className = "btn btn-danger"; }
            break;
            default : { label.innerText = "□"; label.className = "btn btn-outline-secondary"; }
        }
    }

</script>
