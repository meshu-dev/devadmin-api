<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\IconRepository;
use App\Http\Resources\IconResource;
use App\Validators\IconValidator;

class IconController extends Controller
{
    protected $resource = IconResource::class;

    public function __construct(
        protected IconRepository $iconRepository,
        protected IconValidator $iconValidator
    ) { }

    public function add(Request $request)
    {
        $params = $request->all();
        $this->iconValidator->verifyAdd($params);

        $row = $this->iconRepository->add($params);

        return $this->getResponse($row, 201);
    }

    public function get(Request $request, int $id)
    {
        $this->iconValidator->verifyExists($id);

        $row = $this->iconRepository->get($id);

        return $this->getResponse($row);
    }

    public function getAll(Request $request)
    {
        $params = $request->all();
        $rows = $this->iconRepository->getAll($params);

        return $this->getResponse($rows, 200);
    }

    public function edit(Request $request, int $id)
    {
        $params = $request->all();
        $this->iconValidator->verifyEdit($id, $params);

        $isUpdated = $this->iconRepository->edit($id, $params);
        $row = null;

        if ($isUpdated == true) {
            $row = $this->iconRepository->get($id);
        }

        return $this->getResponse($row);
    }

    public function delete(Request $request, int $id)
    {
        $this->iconValidator->verifyExists($id);

        $this->iconRepository->delete($id);

        return $this->getResponse([], 204);
    }
}
