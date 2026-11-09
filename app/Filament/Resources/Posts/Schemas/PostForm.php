<?php

namespace App\Filament\Resources\Posts\Schemas;

use App\Models\PostStatus;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class PostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required()
                    ->maxLength(255)
                    ->live(onBlur: true)
                    ->afterStateUpdated(function (string $operation, $state, callable $set): void {
                        if ($operation === 'create') {
                            $set('slug', str($state)->slug()->toString());
                        }
                    }),
                TextInput::make('slug')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(255),
                Textarea::make('excerpt')
                    ->rows(3)
                    ->maxLength(65535),
                RichEditor::make('body')
                    ->required()
                    ->columnSpanFull(),
                FileUpload::make('cover_path')
                    ->label('Cover image')
                    ->image()
                    ->disk('public')
                    ->directory('blog/covers')
                    ->imageEditor(),
                TextInput::make('cover_alt')
                    ->label('Cover alt text')
                    ->maxLength(255),
                Select::make('status')
                    ->options(PostStatus::class)
                    ->required()
                    ->native(false),
                DateTimePicker::make('published_at')
                    ->seconds(false),
            ]);
    }
}
