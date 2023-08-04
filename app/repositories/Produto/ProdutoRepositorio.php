<?php

namespace App\Repositories\Produto;

use App\Models\Pedido;
use App\Models\Produto;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Image;


class ProdutoRepositorio
{
    protected $ententy;
    protected $entetyPedido;

    public function __construct(Produto $produto, Pedido $pedido)
    {
        $this->ententy = $produto;
        $this->entetyPedido=$pedido;

    }

    public function getProdutos()
    {

        $Produto = $this->ententy::with('categorias')->orderBy('nome_produto', 'asc')->get();
        if (asset($Produto)) {
            return response()->json($Produto);
        } else {
            return response()->json([
                'status' => 'Erro',
                'message' => 'Não foi possível carregar a lista de Produtos'
            ], 401);
        }
    }

    public function getProdutosClientes()
    {

        $Produto = $this->ententy::with('categorias')->orderBy('nome_produto', 'asc')->get();
        if (asset($Produto)) {
            return response()->json($Produto);
        } else {
            return response()->json([
                'status' => 'Erro',
                'message' => 'Não foi possível carregar a lista de Produtos'
            ], 401);
        }
    }




    // public function criar_reserva($transporte_id)
    // {
    //     $trans = Transporte::find($transporte_id);

    //     if ($trans->total_lugares != 0) {
    //         //desconto de lugar
    //         $lugares = $trans->total_lugares - 1;

    //         $t = $trans->update(['total_lugares' => $lugares]);

    //         if (isset($t)) {

    //             $infoReser = reserva::with('transportes')->where('user_id', $this->userID)->where('transporte_id', $transporte_id)->whereDay('created_at', date('d'))->get();
    //             foreach ($infoReser as $value) {
    //                 # code...
    //                 $this->tipo_transporte=$value->transportes->tipo_transporte;
    //             }
    //             if (count($infoReser) > 0) {
    //                 $transUpdate = Transporte::with('reservas')->where('tipo_transporte', 'passageiro')->orWhere('tipo_transporte', 'carga')->find($transporte_id);

    //                 $lugares = $transUpdate->total_lugares+1;
    //                 $t=$trans->update(['total_lugares' => $lugares]);
                    
    //                 if(isset($t)){
    //                     return response()->json([
    //                         'message' => 'Você, já solicitou uma reserva hoje para '.$this->tipo_transporte.', porfavor tente solicitar de novo depois de 24 Horas!'
    //                     ], 402);
    //                 }
                    
    //             } else {
    //                 $r = reserva::create([
    //                     'user_id' => $this->userID,
    //                     'transporte_id' => $transporte_id,
    //                     'data' => now()
    //                 ]);
    //                 if (isset($r)) {
    //                     return response()->json(['message' => 'Lugar reservado! Por favor compre de emediato o seu bilhete'], 200);
    //                 } else {
    //                     $trans = Transporte::find($transporte_id);
    //                     $lugares = $trans->total_lugares+1;
    //                     $t=$trans->update(['total_lugares' => $lugares]);
    //                     if(isset($t)){
    //                         return response()->json(['message' => 'Erro ao solicitar reserva'], 402);
    //                     }
                        
    //                 }
    //             }
    //         }
    //     } else {
    //         return response()->json([
    //             'message' => 'De momento não temos lugar reservado, consulte outro transporte!'
    //         ], 402);
    //     }
    // }

    public function create($data)
    {
        
        if ($data->image_produto) {
            $image = time() . '.' . explode('/', explode(':', substr($data->image_produto, 0, strpos($data->image_produto, ';')))[1])[1];
            Image::make($data->image_produto)->save(public_path('storage/image/produtos/' . $image));
        } else {
            $image = null;
        }
        $produtos_categoria = $this->ententy->create([
            'categoria_id' => $data['categoria_id'],
            'nome_produto' => $data['nome_produto'],
            'image_produto' => $image,
            'descricao' => $data['descricao'],
            'preco' => $data['preco'],
            'receita' => $data['receita'],
        ]);
       
        return response()->json($produtos_categoria);
        // if ($data->image_produto) {
            
        //     $produtos_categoria = $this->ententy->create([
        //         'categoria_id' => $data['categoria_id'],
        //         'nome_produto' => $data['nome_produto'],
        //         'image_produto' => $data->file('image_produto')->store('image/produtos'),
        //         'descricao' => $data['descricao'],
        //         'preco' => $data['preco'],
        //         'receita' => $data['receita'],
        //     ]);

        //     return response()->json($produtos_categoria);
        // } 
    }

    public function getProduto($id)
    {
        //dd($id);
        $getProduto = $this->ententy::with('categorias')->find($id);
        if (asset($getProduto)) {
            return response()->json( $getProduto);
        } else {
            return response()->json([
                'message' => 'Produto não encontrado..!'
            ], 401);
        }
    }


   
    
    public function updateProduto($request, $id)
    {
        $updateProduto = $this->ententy::find($id);

        $data = $request->only('nome_produto', 'descricao', 'preco', 'receita');

        $tamanhoImagem = strlen($request->image_produto);

        if ($tamanhoImagem > 20) {
            if ($request->image_produto) {
                //Se existir uma imagem na pasta de estudante de referencia entao apaga-se esta e cadastra-se outra
                if (Storage::exists('/image/produtos/' . $updateProduto->image_produto)) {
                    Storage::delete('/image/produtos/' . $updateProduto->image_produto);
                }
                $data['image_produto'] = time() . '.' . explode('/', explode(':', substr($request->image_produto, 0, strpos($request->image_produto, ';')))[1])[1];
                Image::make($request->image_produto)->save(public_path('storage/image/produtos/' . $data['image_produto']));
            } else {
                $data['image_produto'] = null;
            }
        }

        $updateProduto->update($data);


        if (asset($updateProduto)) {
            return response()->json($updateProduto);
        } else {
            return response()->json(['Erro' => 'Não foi possível actualizar este produto'], 401);
        }
    }

    public function apagar($id)
    {

        $deleteProduto = $this->ententy::find($id);

        $deleteImage = Storage::disk('public')->delete('/image/produtos/' . $deleteProduto->image_produto);

        if (asset($deleteImage)) {
            $deleteProduto->delete();
        }

        if (asset($deleteProduto)) {
            return response()->json($deleteProduto);
        } else {
            return response()->json(['erro' => 'Não foi possível apagar'], 401);
        }
    }

    public function detalhes($id)
    {
        $detalhes = $this->ententy::with('categorias')->find($id);
        if (asset($detalhes)) {
            return response()->json($detalhes);
        } else {
            return response()->json(['erro' => 'Não foi possível carregar os detalhes']);
        }
    }

    public function pedirProduto($produto_id)
    {
        $cliente_id=Auth()->user()->id;

        $pedido=$this->entetyPedido->create([
            'produto_id'=>$produto_id,
            'cliente_id'=>$cliente_id,
            'status'=>1
        ]);

        if(asset($pedido)){
            return response()->json('O seu pedido foi enviado com sucesso, aguarde pelo contacto');
        }

        
    }

}