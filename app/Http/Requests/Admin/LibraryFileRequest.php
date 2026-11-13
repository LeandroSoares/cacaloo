<?php

namespace App\Http\Requests\Admin;

use App\Models\LibraryTag;
use Illuminate\Foundation\Http\FormRequest;

class LibraryFileRequest extends FormRequest
{
    public const ALLOWED_FILE_MIMES = 'pdf,doc,docx,xls,xlsx,ppt,pptx,txt,csv,rtf,odt,ods,odp,jpg,jpeg,png,webp,gif';

    public const ALLOWED_COVER_MIMES = 'jpg,jpeg,png,webp,gif';

    public function authorize(): bool
    {
        $user = $this->user();

        if (! $user) {
            return false;
        }

        return $user->can('library.manage') || $user->hasRole(['admin', 'sysadmin']);
    }

    public function rules(): array
    {
        $isCreating = $this->isMethod('POST');

        return [
            'title' => ['required', 'string', 'max:160'],
            'description' => ['nullable', 'string', 'max:3000'],
            'tags' => ['required', 'array', 'min:1', 'max:8'],
            'tags.*' => [
                'required',
                'string',
                'min:2',
                'max:'.LibraryTag::MAX_NAME_LENGTH,
                'regex:'.LibraryTag::NAME_REGEX,
            ],
            'file' => [
                $isCreating ? 'required' : 'nullable',
                'file',
                'max:20480',
                'mimes:'.self::ALLOWED_FILE_MIMES,
            ],
            'cover' => [
                'nullable',
                'image',
                'mimes:'.self::ALLOWED_COVER_MIMES,
                'max:5120',
            ],
            'is_active' => ['boolean'],
            'remove_cover' => ['boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'O título do arquivo é obrigatório.',
            'title.max' => 'O título não pode ter mais de 160 caracteres.',
            'description.max' => 'A descrição não pode ter mais de 3000 caracteres.',
            'tags.required' => 'Selecione ou adicione pelo menos uma tag/categoria.',
            'tags.min' => 'Selecione ou adicione pelo menos uma tag/categoria.',
            'tags.max' => 'Selecione no máximo 8 tags por arquivo.',
            'tags.*.min' => 'Cada tag deve ter pelo menos 2 caracteres.',
            'tags.*.max' => 'Cada tag deve ter no máximo '.LibraryTag::MAX_NAME_LENGTH.' caracteres (não cole textos ou descrições no campo de tag).',
            'tags.*.regex' => 'Cada tag pode conter apenas letras, números, espaços e hífens (sem pontuação ou símbolos).',
            'file.required' => 'Selecione o arquivo principal para envio.',
            'file.max' => 'O arquivo principal deve ter no máximo 20 MB.',
            'file.mimes' => 'Formato não permitido. Envie um documento compatível (PDF, Office, TXT, CSV) ou imagem (JPG, PNG, WEBP, GIF).',
            'cover.image' => 'A capa deve ser uma imagem válida.',
            'cover.mimes' => 'A capa deve estar em formato JPG, PNG, WEBP ou GIF.',
            'cover.max' => 'A capa deve ter no máximo 5 MB.',
        ];
    }

    protected function prepareForValidation(): void
    {
        $rawTags = $this->input('tags', []);
        if (is_string($rawTags)) {
            $rawTags = explode(',', $rawTags);
        }

        $customTags = $this->input('custom_tags', '');
        if (is_string($customTags) && trim($customTags) !== '') {
            $rawTags = array_merge((array) $rawTags, explode(',', $customTags));
        }

        $normalizedTags = array_values(array_unique(array_filter(
            array_map(fn ($tag) => preg_replace('/\s+/u', ' ', trim((string) $tag)) ?? '', (array) $rawTags),
            fn ($tag) => $tag !== ''
        )));

        $this->merge([
            'tags' => $normalizedTags,
            'is_active' => $this->has('is_active') ? $this->boolean('is_active') : true,
            'remove_cover' => $this->boolean('remove_cover'),
        ]);
    }
}
