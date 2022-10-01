<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\EnvironmentRepository;
use App\Repositories\SiteRepository;
use App\Http\Resources\SiteResource;

class SiteController extends Controller
{
    protected $resource = SiteResource::class;

    public function __construct(
        protected EnvironmentRepository $environmentRepository,
        protected SiteRepository $siteRepository
    ) { }

    public function add(Request $request)
    {
        $params = $request->all();
        $row = $this->siteRepository->add($params);

        return $this->getResponse($row, 201);
    }

    public function get(Request $request, string $id)
    {
        $row = $this->siteRepository->get($id);
        return $this->getResponse($row);
    }

    public function getAll(Request $request)
    {
        $params = $request->all();
        $rows = $this->siteRepository->getAll($params);

        return $this->getResponse($rows, 200);
    }

    public function edit(Request $request, string $id)
    {
        $params = $request->all();
        $row = $this->siteRepository->edit($id, $params);

        return $this->getResponse($row);
    }

    public function delete(Request $request, string $id)
    {
        $result = $this->siteRepository->delete($id);
        $statusCode = empty($result) === false ? '204' : '404';

        return $this->getResponse([], $statusCode);
    }
}
