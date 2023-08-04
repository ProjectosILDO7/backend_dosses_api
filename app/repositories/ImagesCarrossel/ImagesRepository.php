<?php

namespace App\Repositories\ImagesCarrossel;

use App\Models\Imagem;
use Illuminate\Support\Facades\Storage;
use Image;

final class ImagesRepository
{
    private $entety;
    private $user_id;

    public function __construct(Imagem $inagem)
    {
        $this->entety=$inagem;
        $this->user_id=Auth()->user()->id;
    }

    public function createImage($data){

        if ($data->imagens) {
            $image = time() . '.' . explode('/', explode(':', substr($data->imagens, 0, strpos($data->imagens, ';')))[1])[1];
            Image::make($data->imagens)->save(public_path('storage/image/produtos/' . $image));
        } else {
            $image = null;
        }
        $Imagems_image = $this->entety->create([
            'user_id' => $this->user_id,
            'imagens' => $image,
            'titulo' => $data->titulo,
            'conteudo' => $data->conteudo,
        ]);
       
        if(asset($Imagems_image)){
            return response()->json($Imagems_image);
        }else{
            return response()->json('Erro ao salvar as imagens');
        }
        
    }

    public function Images(){
        $imagens = $this->entety::where('user_id', $this->user_id)->orderBy('created_at', 'desc')->get();
        return response()->json($imagens);
    }

    public function detalhes($id){
        $imagens = $this->entety::find($id);
        return response()->json($imagens);
    }

    public function apagarImagem($id){

        $deleteImagem = $this->entety::find($id);

        $deleteImageInStore = Storage::disk('public')->delete('/image/produtos/' . $deleteImagem->imagens);

        if (asset($deleteImageInStore)) {
            $deleteImagem->delete();
        }

        if (asset($deleteImagem)) {
            return response()->json($deleteImagem);
        } else {
            return response()->json(['erro' => 'Não foi possível apagar'], 401);
        }
    }
}
