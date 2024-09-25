<?php

namespace App\Repositories;
use App\Interfaces\LogRepositoryInterface;
use App\Models\Log;

class LogRepository implements  LogRepositoryInterface
{


    public function all($request)
    {
        $paginate = (isset($request->paginate))?$request->paginate:10;

        return $this->filterAllLogs($request)->paginate($paginate);
    }

    private function filterAllLogs($request)  //Filter All logs
    {
        $query = Log::query();


        return $query
            ->with(['invoice' => function ($query) {
                $query->withTrashed()->select('id', 'serial_number');
            }])
            ->with('user:id,name');

    }

}
