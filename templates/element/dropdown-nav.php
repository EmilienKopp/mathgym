<?php
/**
 * @param $targetController string
 * @param $parentName string
 * @param $options [...]
 * 
 */
?>


<li class="nav-item dropdown">
  <a style="margin-right: 0.3rem;" class="btn btn-secondary dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
    <?= $parentName; ?>
  </a>
  <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
    <?php foreach ($options as $option) : ?>
      <li><?= $this->Html->link($option['name'], ['controller' => $targetController, 'action' => $option['action']], ['class' => 'dropdown-item']);?></li>

    <?php endforeach; ?>
    
  </ul>
</li>