<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\MessageRequest;
use App\UseCases\DTO\Message\MessageCreateInputDto;
use App\UseCases\DTO\Message\MessageUpdateInputDto;
use App\UseCases\Message\MessageCreateUseCase;
use App\UseCases\Message\MessageDeleteUseCase;
use App\UseCases\Message\MessageFindByIDUseCase;
use App\UseCases\Message\MessageGetAllUseCase;
use App\UseCases\Message\MessageUpdateUseCase;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MessageController extends Controller
{
    public function index(Request $request, MessageGetAllUseCase $useCase)
    {
        $response = $useCase->execute($request->all());
        return response()->json($response, Response::HTTP_OK);
    }

    public function store(MessageRequest $request, MessageCreateUseCase $useCase)
    {
        $input = new MessageCreateInputDto(
            title: $request->title,
            message: $request->message,
            newsLetterId: $request->newsletter_id,
        );
        $response = $useCase->execute($input);
        return response()->json(['data' => $response], Response::HTTP_CREATED);
    }

    public function show(String $id, MessageFindByIDUseCase $useCase)
    {
        $response = $useCase->execute($id);
        return response()->json(['data' => $response], Response::HTTP_OK);
    }

    public function update(MessageRequest $request, string $id, MessageUpdateUseCase $useCase)
    {
        $input = new MessageUpdateInputDto(
            id: $id,
            title: $request->title,
            message: $request->message,
            newsLetterId: $request->newsletter_id,
        );
        $response = $useCase->execute($input, $id);
        return response()->json(['data' => $response], Response::HTTP_OK);
    }

    public function destroy(string $id, MessageDeleteUseCase $useCase)
    {
        $useCase->execute($id);
        return response()->json([], Response::HTTP_NO_CONTENT);
    }
}
