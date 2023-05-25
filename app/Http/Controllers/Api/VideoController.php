<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateVideoRequest;
use Illuminate\Http\Request;
use App\Models\Video;
use Exception;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->search;

        if(!empty($search)){
            $videos = Video::where('title', $search)->get();
        }
        else{
            $videos = Video::all();
        }

        if(count($videos) < 1){
            return response()->json(['message' => 'Nenhum vídeo foi encontrado!'], 404);
        }
        
        return $videos;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateVideoRequest $request)
    {
        try{
            $categorie_id = $request->has('categorie_id') ? $request->categorie_id : 1;

            $video = new Video();
            $video->title = $request->title;
            $video->description = $request->description;
            $video->url = $request->url;
            $video->categorie_id = $categorie_id;
            $video->save();

            return $video;
        } 
        catch(Exception $e){
            return response()->json(['message' => 'Erro ao inserir video.'], 400);
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
            $video = Video::findOrFail($id);
            return $video;
        } 
        catch(Exception $e){
            return response()->json(['message' => 'Não encontrado!'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateVideoRequest $request, $id)
    {
        try{
            $video = Video::findOrFail($id);
            $video->update($request->all());

            return $video;
        }
        catch(Exception $e){
            return response()->json(['message' => 'Não foi possível atualizar o vídeo.'], 404);
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
            $video = Video::findOrFail($id);
            $video->delete();

            return response()->json(['message' => 'Vídeo deletado com sucesso.'], 204);
        }
        catch(Exception $e){
            return response()->json(['message' => 'Não foi possível deletar o vídeo.'], 404);
        }
    }
}
