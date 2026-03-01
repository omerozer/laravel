<?php

namespace App\Filament\Resources\BlogPosts\Pages;

use App\Filament\Resources\BlogPosts\BlogPostResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditBlogPost extends EditRecord
{
    protected static string $resource = BlogPostResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $content = $data['content'] ?? '';
        if (is_string($content) && $content !== '') {
            $data['content'] = $this->normalizeRichEditorContent($content);
        }

        return $data;
    }

    private function normalizeRichEditorContent(string $html): string
    {
        $trimmed = trim($html);
        if ($trimmed === '') {
            return '<p></p>';
        }
        // Paragrafsız içerik (sadece metin veya <br>) Tiptap'ta Enter ile sorun yaratabilir
        if (! preg_match('/<p\b/i', $trimmed) && ! preg_match('/<h[1-6]\b/i', $trimmed)) {
            // <br> ile ayrılmış satırları <p>...</p> yap
            $paragraphs = preg_split('/<br\s*\/?>\s*/i', $trimmed);
            $wrapped = array_map(fn (string $s) => '<p>' . trim($s) . '</p>', array_filter(array_map('trim', $paragraphs)));
            return implode('', $wrapped) ?: '<p></p>';
        }

        return $trimmed;
    }
}
