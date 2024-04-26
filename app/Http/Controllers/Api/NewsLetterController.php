<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\NewsLetterRequest;
use App\UseCases\DTO\NewsLetter\NewsLetterCreateInputDto;
use App\UseCases\DTO\NewsLetter\NewsLetterUpdateInputDto;
use App\UseCases\NewsLetter\{
    NewsLetterCreateUseCase,
    NewsLetterDeleteUseCase,
    NewsLetterFindByIdUseCase,
    NewsLetterGetAllUseCase,
    NewsLetterUpdateUseCase,
    RegisterUserOnListUseCase
};
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class NewsLetterController extends Controller
{
    public function index(Request $request, NewsLetterGetAllUseCase $useCase)
    {
        $response = $useCase->execute($request->all());
        return response()->json($response, Response::HTTP_OK);
    }

    public function store(NewsLetterRequest $request, NewsLetterCreateUseCase $useCase)
    {
        $inputDto = new NewsLetterCreateInputDto(
            $request->name,
            $request->description,
            $request->email
        );
        $response = $useCase->execute($inputDto);
        return response()->json(['data' => $response], Response::HTTP_CREATED);
    }

    public function show(String $id, NewsLetterFindByIdUseCase $useCase)
    {
        $response = $useCase->execute($id);
        return response()->json(['data' => $response], Response::HTTP_OK);
    }

    public function update(NewsLetterRequest $request, string $id, NewsLetterUpdateUseCase $useCase)
    {
        $inputDto = new NewsLetterUpdateInputDto(
            $id,
            $request->name,
            $request->description,
            $request->email
        );
        $response = $useCase->execute($inputDto, $id);
        return response()->json(['data' => $response], Response::HTTP_OK);
    }

    public function destroy(string $id, NewsLetterDeleteUseCase $useCase)
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
}
