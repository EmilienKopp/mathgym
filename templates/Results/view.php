<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Result $result
 */

debug($resultsForStudent->toArray());
debug($studentRankWorksheets);
debug($subranks);
?>

<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
          
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="results view content">
            
        <table class="table table-striped table-hover table-bordered">
          <thead>
            <tr>
              <th scope="col">○○十番台</th>
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
                
            
          </tbody>
        </table>

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