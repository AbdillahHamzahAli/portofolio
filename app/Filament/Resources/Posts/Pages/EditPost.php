<?php

namespace App\Filament\Resources\Posts\Pages;

use App\Filament\Resources\Posts\PostResource;
use App\Models\PostStatus;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditPost extends EditRecord
{
    protected static string $resource = PostResource::class;

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $data['user_id'] = $this->record->user_id;
        $status = $data['status'] instanceof PostStatus
            ? $data['status']
            : PostStatus::tryFrom((string) $data['status']);

        $data['published_at'] = $status === PostStatus::Published
            ? ($this->record->published_at ?? now())
            : null;

        return $data;
    }

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
