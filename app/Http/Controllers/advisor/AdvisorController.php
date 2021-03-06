<?php

namespace App\Http\Controllers\advisor;

use App\Http\Controllers\Controller;
use App\Http\Requests\advisor\AdvisorRequest;
use App\Http\Resources\advisor\AdvisorResource;
use App\Repository\advisor\AdvisorRepositoryInterface;
use Illuminate\Http\Request;
use PHPUnit\Exception;

class AdvisorController extends Controller
{
    //
    /**
     * @var AdvisorRepositoryInterface
     */
    private $advisor;

    public function __construct(AdvisorRepositoryInterface $advisorRepository)
    {
        $this->advisor = $advisorRepository;
    }
    public function index()
    {
        $data = $this->advisor->getAll(true);
//        dd($data);
        return view('pages.advisor',['data'=>$data]);
    }

    public function store(AdvisorRequest $request)
    {
        try {
            $output = $this->advisor->store($request->all());
            if ($output == true) {
                return redirect()->back()->with('success', 'Advisor added successfully');
            } else {
                return redirect()->back()->withErrors(['error' => 'something went wrong']);
            }
        }catch (\Exception $exception)
        {
            return redirect()->back()->withErrors(['error' => 'something went wrong']);
        }
    }

    public function advisorUpdate(Request $request)
    {
        $id = $request->id;
        $status = $request->status;
        try {
            $output = $this->advisor->updateStatus($status,$id);
            if ($output == true) {
                return redirect()->back()->with('success', 'Advisor status update successfully');
            } else {
                return redirect()->back()->withErrors(['error' => 'something went wrong']);
            }

        } catch (\Exception $exception) {
            return redirect()->back()->withErrors(['error' => 'something went wrong']);
        }
    }

    public function getAllFeatured()
    {
        try {
            $output = $this->advisor->featuredAdvisor('Featured');
            return ['status'=>true,'data'=>AdvisorResource::collection($output)];
        }catch (\Exception $e)
        {
            return ['status' => false, 'message' => 'something went wrong'];
        }
    }

    public function getAllAdvisor()
    {
        try {
            $output = $this->advisor->getAllStatus();
            return ['status'=>true,'data'=>AdvisorResource::collection($output)];
        }catch (Exception $exception)
        {
            return ['status' => false, 'message' => 'something went wrong'];
        }
    }
}
