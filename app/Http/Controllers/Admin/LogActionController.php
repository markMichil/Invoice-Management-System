<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\LogRepository;
use Illuminate\Http\Request;
use App\Interfaces\LogRepositoryInterface;
class LogActionController extends Controller
{

    protected $logRepository;

    public function __construct(LogRepositoryInterface $logRepository)
    {
        $this->logRepository = $logRepository;
        $this->pageTitle = 'Log Page';
    }

    public function index(Request $request){
        $logs = $this->logRepository->all($request);

        return view('AdminPanel.PagesContent.log.index')
            ->with('data',$logs)
            ->with('pageTitle',$this->pageTitle);
    }


}
