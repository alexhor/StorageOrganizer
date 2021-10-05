<?php

use App\Enums\ContainerStatus;

return [

    ContainerStatus::class => [
        ContainerStatus::Working => 'Working',
        ContainerStatus::NeedsRepair => 'Needs Repair',
        ContainerStatus::NeedsReplacement => 'Needs Replacement',
        ContainerStatus::NeedsCheckup => 'Needs Checkup',
        ContainerStatus::Broken => 'Broken',
    ],

];
