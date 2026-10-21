<?php
namespace App\Http\Controllers;
use App\Models\ArquivoCasa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ArquivoCasaController extends Controller {
    public function index(Request $request) {
        $categorias = ArquivoCasa::query()->select('categoria')->distinct()->orderBy('categoria')->pluck('categoria');
        $arquivos = ArquivoCasa::query()
            ->when($request->filled('busca'), function ($q) use ($request) {
                $termo = trim((string)$request->input('busca'));
                $q->where(fn($sub) => $sub->where('titulo','like',"%{$termo}%")->orWhere('descricao','like',"%{$termo}%")->orWhere('categoria','like',"%{$termo}%"));
            })
            ->when($request->filled('categoria'), fn($q) => $q->where('categoria',$request->input('categoria')))
            ->latest()->paginate(12)->withQueryString();
        return view('arquivos-diversos.index', compact('arquivos','categorias'));
    }

    public function store(Request $request) {
        $data = $request->validate([
            'titulo'=>['required','string','max:160'], 'categoria'=>['required','string','max:100'],
            'descricao'=>['nullable','string','max:3000'],
            'arquivo'=>['required','file','max:20480','mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,txt,csv,rtf,odt,ods,odp,jpg,jpeg,png,webp,gif'],
            'capa'=>['nullable','image','mimes:jpg,jpeg,png,webp,gif','max:5120'],
        ], [
            'arquivo.max'=>'O arquivo principal deve ter no máximo 20 MB.',
            'arquivo.mimes'=>'Formato não permitido. Envie um documento compatível ou uma imagem JPG, PNG, WEBP ou GIF.',
            'capa.max'=>'A capa deve ter no máximo 5 MB.',
        ]);
        $disk = Storage::disk('local');
        $upload = $request->file('arquivo');
        $arquivoPath = $upload->store('biblioteca-casa/arquivos','local');
        $capaPath = null;
        try {
            if ($request->hasFile('capa')) $capaPath = $request->file('capa')->store('biblioteca-casa/capas','local');
            ArquivoCasa::create([
                'titulo'=>trim($data['titulo']), 'categoria'=>trim($data['categoria']),
                'descricao'=>isset($data['descricao']) ? trim($data['descricao']) : null,
                'arquivo_path'=>$arquivoPath,
                'arquivo_nome_original'=>Str::limit(basename($upload->getClientOriginalName()),255,''),
                'arquivo_mime'=>$upload->getMimeType() ?: 'application/octet-stream',
                'arquivo_tamanho'=>(int)$upload->getSize(), 'capa_path'=>$capaPath,
                'capa_mime'=>$request->hasFile('capa') ? $request->file('capa')->getMimeType() : null,
                'user_id'=>$request->user()->id,
            ]);
        } catch (\Throwable $e) {
            $disk->delete(array_filter([$arquivoPath,$capaPath])); throw $e;
        }
        return redirect()->route('arquivos-diversos.index')->with('success','Arquivo adicionado à biblioteca com sucesso.');
    }

    public function download(ArquivoCasa $arquivo): StreamedResponse {
        abort_unless(Storage::disk('local')->exists($arquivo->arquivo_path),404);
        $nome = basename(str_replace('\\','/',$arquivo->arquivo_nome_original));
        $nome = preg_replace('/[\x00-\x1F\x7F"\\\\\/]+/u','_',$nome) ?: 'arquivo';
        return Storage::disk('local')->download($arquivo->arquivo_path, Str::limit($nome,180,''));
    }

    public function capa(ArquivoCasa $arquivo) {
        abort_unless($arquivo->capa_path && Storage::disk('local')->exists($arquivo->capa_path),404);
        $mime = $arquivo->capa_mime ?: 'image/jpeg';
        abort_unless(in_array($mime,['image/jpeg','image/png','image/webp','image/gif'],true),404);
        return response()->stream(function () use ($arquivo) {
            $stream = Storage::disk('local')->readStream($arquivo->capa_path);
            abort_if($stream === false,404); fpassthru($stream); if (is_resource($stream)) fclose($stream);
        },200,['Content-Type'=>$mime,'Content-Disposition'=>'inline; filename="capa"','X-Content-Type-Options'=>'nosniff','Cache-Control'=>'private, no-store']);
    }

    public function destroy(ArquivoCasa $arquivo) {
        $paths = array_filter([$arquivo->arquivo_path,$arquivo->capa_path]);
        $arquivo->delete(); Storage::disk('local')->delete($paths);
        return redirect()->route('arquivos-diversos.index')->with('success','Arquivo excluído da biblioteca.');
    }
}
