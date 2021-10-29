<?php

namespace App\Http\Controllers;

use App\Services\InformationService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Contracts\Support\Renderable;
use DB;
use Log;
use Exception;
use Throwable;

class InformationController extends Controller
{
    private InformationService $informationService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->informationService = new InformationService();
    }

    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index(): Renderable
    {
        return view('home');
    }

    /**
     * @return string
     */
    public function getFamilyList(): string
    {
        return json_encode($this->informationService->getinformationListArray('family'));
    }

    /**
     * @return string
     */
    public function getProgramList(): string
    {
        return json_encode($this->informationService->getinformationListArray('program'));
    }

    /**
     * @param string $page
     *
     * @return string
     */
    public function getInformationList(string $page): string
    {
        return json_encode($this->informationService->getinformationListArray($page));
    }

    /**
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function updateInformationList(Request $request): JsonResponse
    {
        Log::info(__CLASS__ . ' - ' .  __FUNCTION__ . ' - ' . __LINE__);
        Log::info($request);
        $result = $this->informationService->updateInformationList($request);

        if ($result) {
            $statusCode = 201;
        } else {
            $statusCode = 400;
        }
        return response()->json(['result' => $result], $statusCode);
    }

    /**
     * @param int $informationId
     *
     * @return JsonResponse
     * @throws Throwable
     */
    public function deleteInformation(int $informationId): JsonResponse
    {
        DB::beginTransaction();
        try {
            $result = $this->informationService->deleteInformation($informationId);
            DB::commit();
        } catch (Exception $e) {
            Log::info(__CLASS__ . ' - ' .  __FUNCTION__ . ' - ' . __LINE__);
            Log::error($e->getMessage());
            DB::rollBack();
            throw $e;
        }

        if ($result) {
            $statusCode = 204;
        } else {
            $statusCode = 400;
        }
        return response()->json(['result' => $result], $statusCode);
    }
}
