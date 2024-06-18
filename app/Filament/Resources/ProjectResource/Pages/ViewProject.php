<?php

namespace App\Filament\Resources\ProjectResource\Pages;

use App\Filament\Resources\ProjectResource;
use App\Models\ProjectTask;
use App\Models\User;
use Filament\Actions;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Resources\Pages\ViewRecord;
use Filament\Tables\Table;
use Filament\Tables;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Forms\Form;
use Filament\Forms;
use Filament\Forms\FormsComponent;

class ViewProject extends ViewRecord implements HasTable//, HasForms
{
    use InteractsWithTable;
    //use InteractsWithForms;

    protected static string $resource = ProjectResource::class;

    protected static string $view = 'projects.view-project';

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }

    /*
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title'),
            ]);
    }
    */

    public function table(Table $table): Table
    {
        $project_id = $this->record->id;

        $form = [
            Forms\Components\Grid::make()
                ->columns(2)
                ->schema([
                    Forms\Components\TextInput::make('title')
                        ->required(),
                    Forms\Components\TextInput::make('status')
                        ->required(),
                ]),
            Forms\Components\Grid::make()
                ->columns(2)
                ->schema([
                    Forms\Components\Select::make('user_id')
                        ->label('Assigned to')
                        ->options(User::all()->pluck('name', 'id'))
                        ->nullable(),
                    Forms\Components\DateTimePicker::make('deadline_at'),
                 ]),
            Forms\Components\RichEditor::make('description'),
            Forms\Components\Repeater::make('Times')
                ->relationship('times')
                ->schema([
                    Forms\Components\Grid::make()
                        ->columns(2)
                        ->schema([
                            Forms\Components\DateTimePicker::make('started_at')
                                ->required(),
                            Forms\Components\DateTimePicker::make('finished_at')
                                ->required(),
                        ]),
                    Forms\Components\Checkbox::make('is_billable'),
                ]),
        ];

        return $table
            ->query(ProjectTask::where('project_id', $project_id))
            ->actions([
                Tables\Actions\ViewAction::make()->form($form),
                Tables\Actions\EditAction::make()->form($form),
                Tables\Actions\DeleteAction::make(),
            ])
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
            ]);
    }
}
