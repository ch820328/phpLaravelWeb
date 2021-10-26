<?php

namespace App\Services;

use App\Contracts\Entities\Information;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use JetBrains\PhpStorm\Pure;
use Log;
use Spatie\Permission\Contracts\Role;
use Illuminate\Http\Request;
use InformationRepo;
use RoleRepo;

class InformationService
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    #[Pure] public function __construct()
    {
    }

    /**
     * @param string $username
     *
     * @return Information|null
     */
    public function findByUsername(string $username): ?Information
    {
        return InformationRepo::findByUserName($username);
    }

    /**
     * @param int $id
     *
     * @return Information
     */
    public function findById(int $id): Information
    {
        return InformationRepo::findById($id);
    }

    /**
     * @param string $page
     *
     * @return array
     */
    public function getInformationListArray(string $page): array
    {
        $informationCollection = InformationRepo::findByPage($page);
        $informationArray      = [];
        foreach ($informationCollection as $information) {
            $info               = [
                "id"   => $information->getId(),
                "page" => $information->getPage(),
                "tab"  => $information->getTab(),
                "type" => $information->getType(),
                "name" => $information->getName(),
                "url"  => $information->getUrl(),
                "note" => $information->getNote(),
            ];
            $informationArray[] = $info;
        }
        return $informationArray;
    }

    /**
     * @param Request $request
     *
     * @return bool
     */
    public function updateInformationList(Request $request): bool
    {
        $informationId = $request->get('id');
        try {
            $group = InformationRepo::make();
            $group->setPage($request->get('page'));
            $group->setTab($request->get('tab'));
            $group->setType($request->get('type'));
            $group->setName($request->get('name'));
            $group->setPage($request->get('page'));
            $group->setUrl($request->get('url'));
            $noteJson = json_encode([
                                        'district'    => $request->get('district'),
                                        'telephone'   => $request->get('telephone'),
                                        'price'       => $request->get('price'),
                                        'description' => $request->get('description'),
                                    ]);
            $group->setNote($noteJson);
            Log::info(json_encode($group->toArray()));
            InformationRepo::updateOrCreate(['id' => $informationId], $group->toArray());

            return true;
        } catch (Exception $e) {
            Log::info(__CLASS__ . ' - ' . __FUNCTION__ . ' - ' . __LINE__);
            Log::error($e->getMessage());
            return false;
        }
    }

    /**
     * @param int $informationId
     *
     * @return bool
     */
    public function deleteInformation(int $informationId): bool
    {
        try {
            InformationRepo::delete($informationId);
            return true;
        } catch (Exception $e) {
            Log::info(__CLASS__ . ' - ' . __FUNCTION__ . ' - ' . __LINE__);
            Log::error($e->getMessage());
            return false;
        }
    }

    /**
     * @return Collection|Role
     */
    public function getRoles(): Collection|Role
    {
        return RoleRepo::all();
    }
}
