

<nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">算数番付　Tracker　App</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
          <ul class="navbar-nav">
            <li class="nav-item">
              <?= $this->Html->link('Home', '/pages/home', ['class' => 'nav-link active', 'aria-current' => 'page']); ?>
            </li>
            <!-- TODO add feature: Read elements from config Table-->
            <?= $this->element('dropdown-nav', [
              'targetController' => 'students',
              'parentName' => 'Students',
              'options' => [
                  ['name' => 'List', 'action' => 'index'],
                  ['name' => 'Create new', 'action' => 'add'],
                ],
            ]); ?>
          <?= $this->element('dropdown-nav', [
              'targetController' => 'worksheets',
              'parentName' => 'Worksheets',
              'options' => [
                  ['name' => 'List', 'action' => 'index'],
                  ['name' => 'Create new', 'action' => 'add'],
                  ['name' => 'Create several', 'action' => 'seed']
                ],
            ]); ?>
          <?= $this->element('dropdown-nav', [
              'targetController' => 'ranks',
              'parentName' => 'Ranks',
              'options' => [
                  ['name' => 'List', 'action' => 'index'],
                  ['name' => 'Create new', 'action' => 'add']
                ],
            ]); ?>
          </ul>
          <?= $this->Form->create(null,['url' => ['controller' => 'Results', 'action' => 'view'], 'type' => 'get', 'class' => 'd-flex']) ?>
            <input class="form-control me-2" type="search" placeholder="<?=__('Search Student') ?>" aria-label="Search" name="search">
            <button class="btn btn-outline-success" type="submit"><?=__('Search') ?></button>
          <?= $this->Form->end() ?>
        </div>
      </div>
    </nav>
    <script>
      if (window.location.pathname.includes('results/view') || window.location.pathname.includes('edit') || window.location.pathname.includes('add'))
      {
        var submitted = false;

          $(function(){
            $("form").submit(function() {
              submitted = true;
            });

            window.onbeforeunload = function () {
              if (!submitted) {
                return 'Do you really want to leave the page?';
              }
            }

          });
      }
    </script>
