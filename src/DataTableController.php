<?php

class DataTableController extends \Yajra\DataTables\Html\Builder {
    /**
     * @param \Yajra\DataTables\EloquentDataTable $dataTable
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function configEloquentDataTable(\Yajra\DataTables\EloquentDataTable $dataTable) {
        $raw_columns = [];

        $this->collection->map(function (DataTableColumn $column) use ($dataTable, &$raw_columns) {
            if( null !== $column->getServerRender() ) {
                if( true === $column->isVirtualColumn() ) {
                    $dataTable
                        ->addColumn(
                            $column->data,
                            $column->getServerRender()
                        );
                }
                else {
                    $dataTable
                        ->editColumn(
                            $column->data,
                            $column->getServerRender()
                        );
                }
            }

            if( null !== $column->getFilter() ) {
                $dataTable->filterColumn(
                    $column->data,
                    $column->getFilter()
                );
            }

            if( true === $column->isRaw() ) {
                array_push($raw_columns, $column->data);
            }
        });

        if( count($raw_columns) > 0 ) {
            $dataTable->rawColumns($raw_columns);
        }

        return $dataTable
            ->make(true);
    }
}