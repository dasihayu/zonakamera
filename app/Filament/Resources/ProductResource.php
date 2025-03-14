<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\RawJs;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use League\CommonMark\CommonMarkConverter;
use TomatoPHP\FilamentMediaManager\Form\MediaManagerInput;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'fluentui-camera-24';

    protected static ?int $navigationSort = -1;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Tabs::make('Product Resource')
                    ->tabs([
                        Forms\Components\Tabs\Tab::make('General')
                            ->icon('heroicon-o-information-circle')
                            ->schema([
                                Forms\Components\Section::make('Main Details')
                                    ->description('Fill out the main details of the product')
                                    ->icon('heroicon-o-clipboard')
                                    ->schema([
                                        Forms\Components\TextInput::make('title')
                                            ->label('Title')
                                            ->maxLength(255)
                                            ->required()
                                            ->columnSpan(2),
                                        Forms\Components\RichEditor::make('description')
                                            ->label('Description')
                                            ->toolbarButtons([
                                                'bold',
                                                'italic',
                                                'underline',
                                                'bulletList',
                                                'orderedList',
                                                'link',
                                            ])
                                            ->required()
                                            ->columnSpan(2),
                                        Forms\Components\Select::make('categories')
                                            ->label('Category')
                                            ->relationship('categories', 'name', function (Builder $query) {
                                                $query->where('is_active', 1);
                                            })
                                            ->searchable()
                                            ->multiple()
                                            ->preload()
                                            ->required(),
                                        Forms\Components\Select::make('is_visible')
                                            ->label('Is Visible')
                                            ->default(1)
                                            ->options([
                                                0 => "No",
                                                1 => "Yes",
                                            ])
                                            ->native(false)
                                            ->required(),
                                        Forms\Components\TextInput::make('price')
                                            ->prefix('IDR')
                                            ->numeric()
                                            ->columnSpan(2),
                                    ])
                                    ->compact()
                                    ->columns(2),
                            ]),
                        Forms\Components\Tabs\Tab::make('Images')
                            ->icon('heroicon-o-photo')
                            ->schema([
                                Forms\Components\Section::make('Image')
                                    ->description('Upload product images here')
                                    ->schema([
                                        Forms\Components\FileUpload::make('image_url')
                                            ->label('')
                                            ->disk('public')
                                            ->directory('product_image')
                                            ->required()
                                    ])
                                    ->compact(),
                            ]),
                    ])
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('product_id')
                    ->badge()
                    ->sortable()
                    ->searchable(),
                Tables\Columns\ImageColumn::make('image_url')
                    ->label('Image')
                    ->width(100)
                    ->height(100)
                    ->disk('public'),
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->alignCenter(),

                Tables\Columns\TextColumn::make('price')
                    ->money('IDR',  true)
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_visible')
                    ->boolean()
                    ->alignCenter(),
                Tables\Columns\TextColumn::make('categories.name')
                    ->badge()
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('is_visible')
                    ->label('Visibility')
                    ->options([
                        1 => 'Visible',
                        0 => 'Not Visible',
                    ])
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('toggleVisibility')
                    ->label('Toggle Visibility')
                    ->icon('heroicon-o-eye')
                    ->color('warning')
                    ->requiresConfirmation()
                    ->action(function (Model $record) {
                        // Membalikkan nilai is_visible
                        $record->is_visible = !$record->is_visible;
                        $record->save();
                    })
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return __("menu.nav_group.product");
    }
}
