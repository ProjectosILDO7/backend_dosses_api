<?php

namespace App\Repositories\Funcionarios;

use App\Models\Cliente;
use App\Models\reserva;
use App\Models\reserva_senha_funcionario;
use App\Models\Transporte;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Image;


class FuncionarioRepository
{

    protected $ententy;
    protected $userID;
    protected $senha;
    protected $endereco;
    public $tipo_transporte;

    public function __construct(User $funcionario, Cliente $endereco)
    {
        $this->ententy = $funcionario;
        $this->endereco=$endereco;
        $this->userID = Auth()->user()->id;
        $this->senha = rand(11202388, 22205077);
    }

    public function getFuncionarios()
    {

        $funcionario = $this->ententy::with('endereco')->where('acesso',"!=","RC")->where('acesso', "!=", 'super_admin')->orderBy('name', 'asc')->get();
        if (asset($funcionario)) {
            return response()->json($funcionario);
        } else {
            return response()->json([
                'status' => 'Erro',
                'message' => 'Não foi possível carregar a lista de funcionario'
            ], 401);
        }
    }

    public function getClientes()
    {

        $clientes = $this->ententy::with('endereco')->where('acesso',"!=","RF")->where('acesso', "!=", 'super_admin')->orderBy('name', 'asc')->get();
        if (asset($clientes)) {
            return response()->json($clientes);
        } else {
            return response()->json([
                'status' => 'Erro',
                'message' => 'Não foi possível carregar a lista de clientes'
            ], 401);
        }
    }


    public function getMinhasReservas()
    {

        $reservas = reserva::with('transportes')->where('user_id', $this->userID)->get();
        if (asset($reservas)) {
            return response()->json($reservas);
        } else {
            return response()->json([
                'status' => 'Erro',
                'message' => 'Não foi possível carregar a lista de reservas'
            ], 401);
        }
    }

    public function criar_reserva($transporte_id)
    {
        $trans = Transporte::find($transporte_id);

        if ($trans->total_lugares != 0) {
            //desconto de lugar
            $lugares = $trans->total_lugares - 1;

            $t = $trans->update(['total_lugares' => $lugares]);

            if (isset($t)) {

                $infoReser = reserva::with('transportes')->where('user_id', $this->userID)->where('transporte_id', $transporte_id)->whereDay('created_at', date('d'))->get();
                foreach ($infoReser as $value) {
                    # code...
                    $this->tipo_transporte=$value->transportes->tipo_transporte;
                }
                if (count($infoReser) > 0) {
                    $transUpdate = Transporte::with('reservas')->where('tipo_transporte', 'passageiro')->orWhere('tipo_transporte', 'carga')->find($transporte_id);

                    $lugares = $transUpdate->total_lugares+1;
                    $t=$trans->update(['total_lugares' => $lugares]);
                    
                    if(isset($t)){
                        return response()->json([
                            'message' => 'Você, já solicitou uma reserva hoje para '.$this->tipo_transporte.', porfavor tente solicitar de novo depois de 24 Horas!'
                        ], 402);
                    }
                    
                } else {
                    $r = reserva::create([
                        'user_id' => $this->userID,
                        'transporte_id' => $transporte_id,
                        'data' => now()
                    ]);
                    if (isset($r)) {
                        return response()->json(['message' => 'Lugar reservado! Por favor compre de emediato o seu bilhete'], 200);
                    } else {
                        $trans = Transporte::find($transporte_id);
                        $lugares = $trans->total_lugares+1;
                        $t=$trans->update(['total_lugares' => $lugares]);
                        if(isset($t)){
                            return response()->json(['message' => 'Erro ao solicitar reserva'], 402);
                        }
                        
                    }
                }
            }
        } else {
            return response()->json([
                'message' => 'De momento não temos lugar reservado, consulte outro transporte!'
            ], 402);
        }
    }

    public function create($data)
    {

        if ($data->image) {
            $image = time() . '.' . explode('/', explode(':', substr($data->image, 0, strpos($data->image, ';')))[1])[1];
            Image::make($data->image)->save(public_path('storage/image/funcionarios/' . $image));
        } else {
            $image = null;
        }
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'numBI' => $data['numBI'],
            'image' => $image,
            'dataValidadeBI' => $data['picked'],
            'departamento_id' => $data['departamento_id'],
            'acesso' => 'RF',
            'password' => bcrypt($this->senha),
            'status' => 'Activo'
        ]);


        if (asset($user)) {
            return response()->json([
                'status' => 'Sucesso',
                'Funcionario' => $user,
                'Senha' => $this->senha,
            ], 200);
        } else {
            return response()->json([
                'status' => 'Erro',
                'message' => 'Nao foi possível cadastrar o funcionario. deve-se a um problema interno.!'
            ], 401);
        }
    }

    public function getFuncionario($id)
    {
        //dd($id);
        $getFuncionario = $this->ententy::with('endereco')->find($id);
        if (asset($getFuncionario)) {
            return response()->json([
                'getFuncionario' => $getFuncionario
            ], 200);
        } else {
            return response()->json([
                'message' => 'Funcionário não encontrado..!'
            ], 401);
        }
    }

    public function getClientePeloAdmin($id)
    {
        //dd($id);
        $getCliente = $this->ententy::find($id);
        if (asset($getCliente)) {
            return response()->json([
                'getCliente' => $getCliente
            ], 200);
        } else {
            return response()->json([
                'message' => 'Cliente não encontrado..!'
            ], 401);
        }
    }

    public function inativar($id)
    {
        //dd($id);
        $status = 'Inativo';
        $inativar = $this->ententy::find($id);
        $inativar->status = $status;
        $inativar->save();

        if (isset($inativar)) {
            $funcionario = $this->ententy::with('endereco', 'senha')->where('status', "!=", 1)->where('acesso',"!=","RC")->orderBy('name', 'asc')->get();
            return response()->json($funcionario);
        } else {
            $funcionario = $this->ententy::with('endereco', 'senha')->where('status', "!=", 1)->where('acesso',"!=","RC")->orderBy('name', 'asc')->get();
            return response()->json($funcionario);
        }
    }

    public function activo($id)
    {
        //dd($id);
        $status = 'Activo';
        $activar = $this->ententy::find($id);
        $activar->status = $status;
        $activar->save();

        if (isset($activar)) {
            $funcionario = $this->ententy::with('departamentos', 'senha')->where('status', "!=", 1)->where('acesso',"!=","RC")->orderBy('name', 'asc')->get();
            return response()->json($funcionario);
        } else {
            $funcionario = $this->ententy::with('departamentos', 'senha')->where('status', "!=", 1)->where('acesso',"!=","RC")->orderBy('name', 'asc')->get();
            return response()->json($funcionario);
        }
    }

    public function updateFuncionario($request, $id)
    {
        $updateFuncionario = $this->ententy::find($id);

        $data = $request->only('name', 'telemovel', 'endereco');
        
        $updateFuncionario->update($data);

        if($request->endereco){
            $updateEndereco=$this->endereco->where('user_id', $id)->first();
            $updateEndereco->endereco=$request->endereco;
            $updateEndereco->save();
        };

        if (asset($updateFuncionario)) {
            return response()->json(['message' => 'Funcionário actualizado com sucesso'], 200);
        } else {
            return response()->json(['Erro' => 'Não foi possível actualizar este funcionário'], 401);
        }
    }

    public function apagar($id)
    {

        $deleteFuncionario = $this->ententy::find($id);

        $deleteImage = Storage::disk('public')->delete('/image/funcionarios/' . $deleteFuncionario->image);

        if (asset($deleteImage)) {
            $deleteFuncionario->delete();
        }

        if (asset($deleteFuncionario)) {
            return response()->json(['message' => 'Funcionário apagado com sucesso'], 200);
        } else {
            return response()->json(['erro' => 'Não foi possível apagar'], 401);
        }
    }

    public function detalhes($id)
    {
        $detalhes = $this->ententy::with('endereco')->find($id);
        if (asset($detalhes)) {
            return response()->json($detalhes);
        } else {
            return response()->json(['erro' => 'Não foi possível carregar os detalhes']);
        }
    }

    public function detalhesClientes($id)
    {
        $detalhes = $this->ententy::with('endereco')->find($id);
        if (asset($detalhes)) {
            return response()->json($detalhes);
        } else {
            return response()->json(['erro' => 'Não foi possível carregar os detalhes']);
        }
    }
}
