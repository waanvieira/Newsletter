<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\Response;

abstract class BaseCrudController extends Controller
{
    protected $paginationSize = 15;

    protected abstract function model();

    protected abstract function resource();

    protected abstract function resourceCollection();

    protected abstract function requestValidate();

    protected abstract function orderBy() : array;

    public function index()
    {
        $model = $this->model();
        $data = !empty($this->orderBy()) ? $model::orderBy($this->orderBy()['field'], $this->orderBy()['order'])->paginate($this->paginationSize) : $model::paginate($this->paginationSize);
        $resourceCollectionClass = $this->resourceCollection();
        if ($this->resourceCollection()) {
            $refClass = new \ReflectionClass($this->resourceCollection());

            return $refClass->isSubclassOf(ResourceCollection::class)
                ? new $resourceCollectionClass($data)
                : $resourceCollectionClass::collection($data);
        }

        return $this->success('Registros encontrados com sucesso', $data);
    }

    public function store(Request $request)
    {
        $this->requestValidate();
        $obj = $this->model()::create($request->all());
        $obj->refresh();
        $resource = $this->resource();

        if ($this->resource()) {
            return new $resource($obj);
        }

        return $this->success(null, $obj, Response::HTTP_CREATED);
    }

    public function show($id)
    {
        $obj = $this->findOrFail($id);
        $resource = $this->resource();

        if ($this->resource()) {
            return new $resource($obj);
        }

        return $this->success('Registro encontrado com sucesso', $obj);
    }

    public function update(Request $request, $id)
    {
        $this->requestValidate();
        $obj = $this->findOrFail($id);
        $obj->update($request->all());
        $resource = $this->resource();

        if ($this->resource()) {
            return new $resource($obj);
        }

        return $this->success('Registro atualizado com sucesso', $obj);
    }

    public function destroy($id)
    {
        $obj = $this->findOrFail($id);
        $obj->delete();
        return response()->noContent(); //204 - No content
    }

    protected function findOrFail($id)
    {
        $model = $this->model();
        $keyName = (new $model)->getRouteKeyName();
        return $this->model()::where($keyName, $id)->firstOrFail();
    }
}
