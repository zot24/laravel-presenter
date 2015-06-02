<?php namespace Motty\Presenter;

use Motty\Presenter\Contracts\PresenterInterface;
use Motty\Presenter\Contracts\PresentableInterface;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class LaravelPresenter implements PresenterInterface
{
    /**
     * Return an instance of a Model wrapped in a presenter object
     *
     * @param Model $model
     * @param PresentableInterface $presenter
     * @return Model
     */
    public function model($model, PresentableInterface $presenter)
    {
        $object = clone $presenter;

        $object->set($model);

        return $object;
    }

    /**
     * Return an instance of a Collection with each value wrapped in a presenter object
     *
     * @param Collection $collection
     * @param PresentableInterface $presenter
     * @return Collection
     */
    public function collection($collection, PresentableInterface $presenter)
    {
        foreach ($collection as $key => $value) {
            $collection->put($key, $this->model($value, $presenter));
        }

        return $collection;
    }

    /**
     * Return an instance of a Paginator with each value wrapped in a presenter object
     *
     * @param LengthAwarePaginator $paginator
     * @param PresentableInterface $presenter
     * @return LengthAwarePaginator
     */
    public function paginator($paginator, PresentableInterface $presenter)
    {
        $items = array();

        foreach ($paginator->items() as $item) {
            $items[] = $this->model($item, $presenter);
        }

        $paginator = new LengthAwarePaginator(
            $items,
            $paginator->total(),
            $paginator->perPage(),
            $paginator->currentPage(),
            [
                'path' => LengthAwarePaginator::resolveCurrentPath()
            ]
        );

        return $paginator;
    }
}
