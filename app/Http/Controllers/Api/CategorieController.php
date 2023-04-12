<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Categorie;
use Exception;

class CategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Categorie::all();

        if(count($categories) == 0){
            return response()->json(['message' => 'Nenhuma categoria foi encontrada!'], 404);
        }

        return $categories;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $categorie = new Categorie();
            $categorie->fill($request->all());
            $categorie->save();

            return $categorie;
        }
        catch(Exception $e){
            return response()->json(['message' => 'Erro ao inserir categoria!']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try{
            $categorie = Categorie::findOrFail($id);

            return $categorie;
        }
        catch(Exception $e){
            return response()->json(['message' => 'Nenhuma categoria encontrada!']);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try{
            $categorie = Categorie::findOrFail($id);
            $categorie->update($request->all());

            return $categorie;
        }
        catch(Exception $e){
            return response()->json(['message' => 'Não foi possível atualizar a categoria.'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $categorie = Categorie::findOrFail($id);
            $categorie->delete();

            return response()->json(['message' => 'Categoria excluída com sucesso.']);
        }
        catch(Exception $e){
            return response()->json(['message' => 'Erro ao excluir categoria.']);
        }
    }
}
