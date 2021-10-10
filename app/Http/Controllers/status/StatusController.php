<?php

namespace App\Http\Controllers\status;

use App\Http\Controllers\Controller;
use App\Repository\status\StatusRepositoryInterface;
use Illuminate\Http\Request;
use PHPUnit\Exception;

class StatusController extends Controller
{
    //

    /**
     * @var StatusRepositoryInterface
     */
    private $status;

    public function __construct(StatusRepositoryInterface $statusRepository)
    {
        $this->status = $statusRepository;
    }

    public function create(Request $request)
    {
        try {
            $data = $request->only('name');
            $output = $this->status->customCreate($data);
            return ['status' => true, 'data' => $output];
        } catch (Exception $exception) {
            return ['status' => false, 'message' => 'something went wrong'];
        }
    }

    public function getAllStatus()
    {
        $data = $this->status->getAll();
        return ['status'=>true,'data'=>$data];
    }


}
