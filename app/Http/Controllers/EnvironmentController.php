<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\EnvironmentRepository;
use App\Http\Resources\EnvironmentResource;
use App\Http\Resources\SiteResource;
use App\Validators\EnvironmentValidator;

class EnvironmentController extends Controller
{
    protected $resource = EnvironmentResource::class;

    public function __construct(
        protected EnvironmentRepository $environmentRepository,
        protected EnvironmentValidator $environmentValidator
    ) {
    }

    public function add(Request $request)
    {
        $params = $request->all();
        $this->environmentValidator->verifyAdd($params);

        $row = $this->environmentRepository->add($params);

        return $this->getResponse($row, 201);
    }

    public function get(Request $request, int $id)
    {
        $this->environmentValidator->verifyExists($id);

        $row = $this->environmentRepository->get($id);

        return $this->getResponse($row);
    }

    public function getAll(Request $request)
    {
        $params = $request->all();
        $rows = $this->environmentRepository->getAll($params);

        return $this->getResponse($rows, 200);
    }

    public function getSites(Request $request, int $id)
    {
        $this->environmentValidator->verifyExists($id);

        $row = $this->environmentRepository->get($id);

        $this->resource = SiteResource::class;
        return $this->getResponse($row->sites);
    }

    public function edit(Request $request, int $id)
    {
        $params = $request->all();
        $this->environmentValidator->verifyEdit($id, $params);

        $isUpdated = $this->environmentRepository->edit($id, $params);
        $row = null;

        if ($isUpdated == true) {
            $row = $this->environmentRepository->get($id);
        }

        return $this->getResponse($row);
    }

    public function delete(Request $request, int $id)
    {
        $this->environmentValidator->verifyExists($id);

        $row = $this->environmentRepository->get($id);
        $totalSites = $row->sites->count();

        if ($totalSites > 0) {
            return $this->getResponse(
                ['error' => 'Cannot delete this environment as there are sites are assigned to it'],
                422
            );
        }

        $this->environmentRepository->delete($id);

        return $this->getResponse([], 204);
    }
}
