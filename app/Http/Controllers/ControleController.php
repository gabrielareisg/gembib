<?php

namespace App\Http\Controllers;

use App\Models\Controle;
use App\Http\Requests\ControleRequest;
use Carbon\Carbon;

class ControleController extends Controller
{
    private function search(){
        $request = request();
        $query = Controle::orderByDesc('id');
        
        if (!empty($request->busca_inicio) && !empty($request->busca_fim)) {
            $from = Carbon::createFromFormat('d/m/Y', $request->busca_inicio);
            $to = Carbon::createFromFormat('d/m/Y', $request->busca_fim);
            $query->where('inicio', '>=', $from);
            $query->where('fim', '<=', $to);
            $query->whereNotNull('inicio');
            $query->whereNotNull('fim');
        }
        return $query;
    }
    
    public function index(Controle $controle)
    {
        $this->authorize('sai');    
        $query = $this->search();  

        $registros = $query->paginate(12);

        return view('controle/index', ['registros' => $registros, 'controle' =>$controle,  'query' => $query]);
    }

    public function store(ControleRequest $request)
    {
        $this->authorize('sai');
        
        $validated = $request->validated();

        $controle = Controle::create($validated); 
        
        $controle->save();

        $request->session()->flash('alert-info',"Novo registro enviado com sucesso!");

        return redirect("/controle");
    }
    
    public function show(Controle $controle)
    {
        $this->authorize('sai');

        return view('controle/show', compact('controle'));
    }

    public function edit(Controle $controle){
        $this->authorize('sai');

        return view('controle.edit', with(['controle' => $controle]));
    }

    public function update(Controle $controle, ControleRequest $request){
        $this->authorize('sai');

        $validated = $request->validated();
        
        $controle->update($validated);

        $request->session()->flash('alert-info',"Registro {$controle->inicio} - {$controle->fim} atualizado com sucesso!");

        return redirect("/controle");
    }

}