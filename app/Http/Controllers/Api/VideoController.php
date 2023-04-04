<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Video;
use Exception;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(count(Video::all()) == 0){
            return response()->json(['message' => 'Não há videos encontrados!'], 404);
        }
        
        $videos = Video::all();
        return $videos;
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
            $video = new Video();
            $video->fill($request->all());
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
    public function update(Request $request, $id)
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

            return response()->json(['message' => 'Vídeo deletado com sucesso.'], 200);
        }
        catch(Exception $e){
            return response()->json(['message' => 'Não foi possível deletar o vídeo.'], 404);
        }
    }
}
