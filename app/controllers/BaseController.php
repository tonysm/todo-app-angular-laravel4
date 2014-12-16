<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Routing\Controller;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use League\Fractal\Resource\ResourceAbstract;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;

class BaseController extends Controller
{
    /**
     * Setup the layout used by the controller.
     *
     * @return void
     */
    protected function setupLayout()
    {
        if (! is_null($this->layout)) {
            $this->layout = View::make($this->layout);
        }
    }

    /**
     * @param  EloquentCollection $collection
     * @param $transformer
     * @param  int                $statusCode
     * @return mixed
     */
    protected function respondsWithCollection(EloquentCollection $collection, $transformer, $statusCode = 200)
    {
        return $this->responds($this->parseCollectionToJson($collection, $transformer), $statusCode);
    }

    /**
     * @param  Model $model
     * @param $transformer
     * @param  int   $statusCode
     * @return mixed
     */
    protected function respondsWithItem(Model $model, $transformer, $statusCode = 200)
    {
        return $this->responds($this->parseEntityToJson($model, $transformer), $statusCode);
    }

    /**
     * @param  mixed $response
     * @param  int   $statusCode
     * @return mixed
     */
    protected function responds($response, $statusCode = 200)
    {
        return Response::make($response, $statusCode);
    }

    /**
     * @param $model
     * @param $transformer
     * @return string
     */
    protected function parseEntityToJson($model, $transformer)
    {
        return $this->parseResourceToJson(new Item($model, $transformer));
    }

    /**
     * @param  ResourceAbstract $resourceAbstract
     * @return string
     */
    protected function parseResourceToJson(ResourceAbstract $resourceAbstract)
    {
        $fractal = new Manager();

        $fractal->setSerializer(new \League\Fractal\Serializer\ArraySerializer());

        return $fractal->createData($resourceAbstract)->toJson();
    }

    /**
     * @param  EloquentCollection $collection
     * @param $transformer
     * @return string
     */
    protected function parseCollectionToJson(EloquentCollection $collection, $transformer)
    {
        return $this->parseResourceToJson(new Collection($collection->all(), $transformer, null));
    }
}
