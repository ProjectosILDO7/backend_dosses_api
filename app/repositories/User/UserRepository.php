<?php

namespace App\Repositories\User;

use App\Models\Cliente;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserRepository
{

    protected $entety;
    protected $entetyCliente;

    public function __construct(User $model, Cliente $cliente)
    {
        $this->entety = $model;
        $this->entetyCliente=$cliente;
    }

    public function save($data)
    {
        // $dep_id=Departamento::factory()->create([
        //     'departamento'=>'RC_Cliente',
        // ]);
        $register = $this->entety::create([
           // 'departamento_id'=>$dep_id->id,
            'name' => $data['name'],
            'email' => $data['email'],
            'telemovel' => $data['telemovel'],
            'acesso' => 'RC',
            'email_verified_at' => now(),
            'status'=>'Activo',
            'password' => Hash::make($data['password']),
            'remember_token' => Str::random(1),
        ]);

        if($data->endereco){
            $registerEndereco = $this->entetyCliente::create([
                'user_id'=>$register->id,
                'endereco'=>$data->endereco,
            ]);
        };

        if(asset($registerEndereco)){
            return response()->json($register);
        }else{
            return response()->json([
                'status' => 500,
                'message'=>'Erro ao criar conta',
            ], 500);
        }

        
    }

    public function updateUser($request){

        if(!$user=auth()->user()){
            return response()->json([
                'status' => 401,
                'message'=>'Usuário não encotrado'
            ]);
        }else{
            $data = $request->only('name', 'email');
            
            
            if($request->password){
                $user['password'] = bcrypt($request->password);
            }
                
            $user->update($data);

            if(asset($user)){
                return response()->json([
                    'status'    => 200,
                    'message'   => 'Dados actualizados com sucesso!'
                ], 200);
            }else{
                return response()->json([
                    'status'    => 500,
                    'message'   => 'Erro ao actualizar os dados!'
                ], 500);
            }
            
        }
       
    }
}
