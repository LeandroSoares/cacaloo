<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class ArquivoCasa extends Model {
    protected $table = 'arquivos_casa';
    protected $fillable = ['titulo','categoria','descricao','arquivo_path','arquivo_nome_original','arquivo_mime','arquivo_tamanho','capa_path','capa_mime','user_id'];
    public function autor(): BelongsTo { return $this->belongsTo(User::class, 'user_id'); }
    public function getEhImagemAttribute(): bool { return str_starts_with((string)$this->arquivo_mime, 'image/'); }
}
