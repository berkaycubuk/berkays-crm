<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InvoiceResource\Pages;
use App\Filament\Resources\InvoiceResource\RelationManagers;
use App\Models\Contact;
use App\Models\Invoice;
use App\Models\Project;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class InvoiceResource extends Resource
{
    protected static ?string $model = Invoice::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('project_id')
                    ->options(Project::all()->pluck('name', 'id'))
                    ->nullable()
                    ->label('Project'),
                Forms\Components\Select::make('contact_id')
                    ->options(Contact::all()->pluck('full_name', 'id'))
                    ->label('Contact')
                    ->nullable(),
                Forms\Components\TextInput::make('subtotal')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('tax_subtotal')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('currency')
                    ->required(),
                Forms\Components\TextInput::make('status')
                    ->required(),
                Forms\Components\TextInput::make('first_name')
                    ->required(),
                Forms\Components\TextInput::make('last_name'),
                Forms\Components\TextInput::make('company'),
                Forms\Components\Textarea::make('address'),
                Forms\Components\TextInput::make('city'),
                Forms\Components\TextInput::make('country'),
                Forms\Components\TextInput::make('postal_code'),
                Forms\Components\TextInput::make('tax_id'),
                Forms\Components\FileUpload::make('document_path'),
                Forms\Components\Repeater::make('items')
                    ->columnSpanFull()
                    ->relationship()
                    ->schema([
                        Forms\Components\Grid::make()
                            ->columns(2)
                            ->schema([
                                Forms\Components\TextInput::make('name')
                                    ->required(),
                                Forms\Components\TextInput::make('quantity')
                                    ->required()
                                    ->numeric(),
                                Forms\Components\TextInput::make('tax')
                                    ->required()
                                    ->numeric(),
                                Forms\Components\TextInput::make('amount')
                                    ->required()
                                    ->numeric(),
                            ]),
                    ]),
                Forms\Components\Repeater::make('history')
                    ->columnSpanFull()
                    ->relationship()
                    ->schema([
                        Forms\Components\Grid::make()
                            ->columns(2)
                            ->schema([
                                Forms\Components\TextInput::make('action')
                                    ->required(),
                                Forms\Components\TextInput::make('related_model'),
                                Forms\Components\TextInput::make('related_id'),
                            ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id'),
                Tables\Columns\TextColumn::make('subtotal')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('tax_subtotal')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('currency')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListInvoices::route('/'),
            'create' => Pages\CreateInvoice::route('/create'),
            'view' => Pages\ViewInvoice::route('/{record}'),
            'edit' => Pages\EditInvoice::route('/{record}/edit'),
        ];
    }
}
