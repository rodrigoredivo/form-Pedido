<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FormController extends Controller
{
    public function index() {
        return view('home');
    }

    public function formSubmit(Request $request) {
        $dados = [
            'nome'=>$request->input('nome'),
            'email'=>$request->input('email'),
            'cep'=>$request->input('cep'),
            'endereco'=>$request->input('endereco'),
            'numero'=>$request->input('numero'),
            'bairro'=>$request->input('bairro'),
            'cidade'=>$request->input('cidade'),
            'estado'=>$request->input('estado')
        ];

        return response()->json($dados);
    }
}
