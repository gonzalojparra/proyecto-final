<?php

use App\Actions\Jetstream\ControllerShowTeams;
use App\Http\Actions\showTeams;

  $escuelas = new ControllerShowTeams();

  $escuelas = $escuelas->showTeams();
  echo $escuelas;
  ?>