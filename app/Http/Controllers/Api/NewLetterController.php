<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\NewLetterRequest;
use App\UseCases\NewLetter\NewLetterCreateUseCase;
use App\UseCases\NewLetter\NewLetterDeleteUseCase;
use App\UseCases\NewLetter\NewLetterFindByIdUseCase;
use App\UseCases\NewLetter\NewLetterGetAllUseCase;
use App\UseCases\NewLetter\NewLetterUpdateUseCase;
use App\UseCases\NewLetter\RegisterUserOnListUseCase;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\Response;

class NewLetterController extends Controller
{
    public function index(Request $request, NewLetterGetAllUseCase $useCase)
    {
        $response = $useCase->execute($request->all());
        return response()->json($response, Response::HTTP_OK);
    }

    public function store(NewLetterRequest $request, NewLetterCreateUseCase $useCase)
    {
        $response = $useCase->execute($request->all());
        return response()->json(['data' => $response], Response::HTTP_CREATED);
    }

    public function show(String $id, NewLetterFindByIdUseCase $useCase)
    {
        $response = $useCase->execute($id);
        return response()->json(['data' => $response], Response::HTTP_OK);
    }

    public function update(NewLetterRequest $request, string $id, NewLetterUpdateUseCase $useCase)
    {
        $response = $useCase->execute($request->all(), $id);
        return response()->json(['data' => $response], Response::HTTP_OK);
    }

    public function destroy(string $id, NewLetterDeleteUseCase $useCase)
    {
        $useCase->execute($id);
        return response()->json([], Response::HTTP_NO_CONTENT);
    }

    public function registerUserOnTheList(Request $request, string $idNewsLetter, RegisterUserOnListUseCase $useCase)
    {
        $request->validate(['email' => 'required']);
        $useCase->execute($request->all(), $idNewsLetter);
        return response()->json([], Response::HTTP_OK);
    }

    public function listUserByList(string $id)
    {
    }
}
