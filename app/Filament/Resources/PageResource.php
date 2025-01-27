<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PageResource\Pages;
use App\Filament\Resources\PageResource\RelationManagers;
use App\Models\Page;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PageResource extends Resource
{
    protected static ?string $model = Page::class;

    protected static ?string $navigationIcon = 'fluentui-stack-20';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Tabs::make('Page Content')
                    ->tabs([
                        Forms\Components\Tabs\Tab::make('Homepage')
                            ->icon('heroicon-o-home')
                            ->schema([
                                Forms\Components\Section::make('Hero Section')
                                    ->description('Will appear at the very top of the landing page')
                                    ->icon('heroicon-o-information-circle')
                                    ->schema([
                                        Forms\Components\TextInput::make('home_banner_title')
                                            ->label('Hero Title')
                                            ->required()
                                            ->maxLength(255),
                                        Forms\Components\TextInput::make('home_banner_sub')
                                            ->label('Hero Subtitle')
                                            ->maxLength(255)
                                            ->required(),
                                        Forms\Components\FileUpload::make('home_banner_img')
                                            ->label('Hero Image')
                                            ->disk('public')
                                            ->directory('pages/home')
                                            ->required()
                                            ->columnSpanFull(),
                                    ])
                                    ->compact()
                                    ->columns(2),

                                Forms\Components\Section::make('About Section')
                                    ->description('Will appear in the about section')
                                    ->icon('heroicon-o-information-circle')
                                    ->schema([
                                        Forms\Components\TextInput::make('home_about_title')
                                            ->label('About Title')
                                            ->required()
                                            ->maxLength(255),
                                        Forms\Components\FileUpload::make('home_about_img')
                                            ->label('About Image')
                                            ->disk('public')
                                            ->directory('pages/home')
                                            ->required(),
                                        Forms\Components\Markdowneditor::make('home_about_sub')
                                            ->label('About Subtitle')
                                            ->columnSpanFull()
                                            ->required(),
                                    ])
                                    ->compact()
                                    ->columns(2),
                            ]),
                        Forms\Components\Tabs\Tab::make('About Us')
                            ->icon('heroicon-o-information-circle')
                            ->schema([
                                Forms\Components\Section::make('About us Banner')
                                    ->icon('heroicon-o-information-circle')
                                    ->description('Will appear on the about us page')
                                    ->schema([
                                        Forms\Components\FileUpload::make('about_banner')
                                            ->label('Hero Image')
                                            ->disk('public')
                                            ->directory('pages/about')
                                            ->required(),
                                    ])
                                    ->compact(),
                                Forms\Components\Section::make('About us Content')
                                    ->icon('heroicon-o-information-circle')
                                    ->description('Will appear on the about us page')
                                    ->schema([
                                        Forms\Components\TextInput::make('about_content_title')
                                            ->label('About Title')
                                            ->required()
                                            ->maxLength(255),
                                        Forms\Components\FileUpload::make('about_image')
                                            ->label('About Image')
                                            ->disk('public')
                                            ->directory('pages/about')
                                            ->required(),
                                        Forms\Components\Markdowneditor::make('about_content_desctiption')
                                            ->label('About Text')
                                            ->columnSpanFull()
                                            ->required(),
                                    ])
                                    ->compact()
                                    ->columns(2),
                                Forms\Components\Section::make('Map Section')
                                    ->icon('heroicon-o-information-circle')
                                    ->description('Will appear on the about us page')
                                    ->schema([
                                        Forms\Components\TextInput::make('about_map_title')
                                            ->label('Map Title')
                                            ->required()
                                            ->columnSpanFull()
                                            ->maxLength(255),
                                        Forms\Components\Markdowneditor::make('about_map_text')
                                            ->label('Map Description')
                                            ->columnSpanFull()
                                            ->required(),
                                    ])
                                    ->compact()
                                    ->columns(2),
                            ]),
                        Forms\Components\Tabs\Tab::make('Products')
                            ->icon('heroicon-o-camera')
                            ->schema([
                                Forms\Components\Section::make('Product Banner')
                                    ->icon('heroicon-o-information-circle')
                                    ->description('Will appear on the product page')
                                    ->schema([
                                        Forms\Components\FileUpload::make('product_banner')
                                            ->label('Hero Image')
                                            ->disk('public')
                                            ->directory('pages/about')
                                            ->required(),
                                    ])
                                    ->compact(),
                            ]),

                        Forms\Components\Tabs\Tab::make('Bookings')
                            ->icon('heroicon-o-book-open')
                            ->schema([
                                Forms\Components\Section::make('Booking Banner')
                                    ->icon('heroicon-o-information-circle')
                                    ->description('Will appear on the booking page')
                                    ->schema([
                                        Forms\Components\FileUpload::make('booking_banner')
                                            ->label('Booking Image')
                                            ->disk('public')
                                            ->directory('pages/about')
                                            ->required(),
                                    ])
                                    ->compact(),
                            ]),

                        Forms\Components\Tabs\Tab::make('Cart')
                            ->icon('heroicon-o-shopping-cart')
                            ->schema([
                                Forms\Components\Section::make('Cart Banner')
                                    ->icon('heroicon-o-information-circle')
                                    ->description('Will appear on the cart page')
                                    ->schema([
                                        Forms\Components\FileUpload::make('cart_banner')
                                            ->label('Cart Image')
                                            ->disk('public')
                                            ->directory('pages/about')
                                            ->required(),
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
                Tables\Columns\TextColumn::make('home_banner_title')
                    ->label('Hero Title')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('home_banner_sub')
                    ->label('Hero Subtitle')
                    ->sortable()
                    ->searchable(),
            ])
            ->filters([
                // Filters bisa ditambahkan sesuai kebutuhan
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                // Bulk actions bisa ditambahkan sesuai kebutuhan
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
            'index' => Pages\ListPages::route('/'),
            'create' => Pages\CreatePage::route('/create'),
            'edit' => Pages\EditPage::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return __("menu.nav_group.contents");
    }
}
