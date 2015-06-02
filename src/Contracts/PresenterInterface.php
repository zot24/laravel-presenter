<?php namespace Motty\Presenter\Contracts;

interface PresenterInterface
{
    /**
     * Return an instance of a Model wrapped in a presenter object
     *
     * @param $model
     * @param PresentableInterface $presenter
     * @return Model
     */
    public function model($model, PresentableInterface $presenter);

    /**
     * Return an instance of a Collection with each value wrapped in a presenter object
     *
     * @param $collection
     * @param PresentableInterface $presenter
     * @return Collection
     */
    public function collection($collection, PresentableInterface $presenter);

    /**
     * Return an instance of a Paginator with each value wrapped in a presenter object
     *
     * @param $paginator
     * @param PresentableInterface $presenter
     * @return Paginator
     */
    public function paginator($paginator, PresentableInterface $presenter);
}
