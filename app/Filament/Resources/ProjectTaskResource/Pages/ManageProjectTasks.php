<?php

namespace App\Filament\Resources\ProjectTaskResource\Pages;

use App\Filament\Resources\ProjectTaskResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageProjectTasks extends ManageRecords
{
    protected static string $resource = ProjectTaskResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
