<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\EnvironmentRepository;
use App\Repositories\SiteRepository;
use App\Http\Resources\SiteEnvResource;
use App\Validators\SiteValidator;

class SiteController extends Controller
{
    protected $resource = SiteEnvResource::class;

    public function __construct(
        protected EnvironmentRepository $environmentRepository,
        protected SiteRepository $siteRepository,
        protected SiteValidator $siteValidator
    ) { }

    public function add(Request $request)
    {
        $params = $request->all();
        $this->siteValidator->verifyAdd($params);

        $row = $this->siteRepository->add($params);

        return $this->getResponse($row, 201);
    }

    public function get(Request $request, int $id)
    {
        $this->siteValidator->verifyExists($id);

        $row = $this->siteRepository->get($id);

        return $this->getResponse($row);
    }

    public function getAll(Request $request)
    {
        $params = $request->all();
        $rows = $this->siteRepository->getAll($params);

        return $this->getResponse($rows, 200);
    }

    public function edit(Request $request, int $id)
    {
        $params = $request->all();
        $this->siteValidator->verifyEdit($id, $params);

        $isUpdated = $this->siteRepository->edit($id, $params);
        $row = null;

        if ($isUpdated == true) {
            $row = $this->siteRepository->get($id);
        }

        return $this->getResponse($row);
    }

    public function delete(Request $request, int $id)
    {
        $this->siteValidator->verifyExists($id);

        $this->siteRepository->delete($id);

        return $this->getResponse([], 204);
    }
}
