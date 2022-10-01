<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\EnvironmentRepository;

class EnvironmentController extends Controller
{
    public function __construct(
        protected EnvironmentRepository $environmentRepository
    ) { }

    public function add(Request $request)
    {
        $params = $request->all();
        $row = $this->environmentRepository->add($params);

        return $this->getResponse($row, 201);
    }

    public function get(Request $request, string $id)
    {
        $row = $this->environmentRepository->get($id);
        return $this->getResponse($row);
    }

    public function getAll(Request $request)
    {
        $params = $request->all();
        $rows = $this->environmentRepository->getAll($params);

        return $this->getResponse($rows, 200);
    }

    public function edit(Request $request, string $id)
    {
        $params = $request->all();
        $row = $this->environmentRepository->edit($id, $params);

        return $this->getResponse($row);
    }

    public function delete(Request $request, string $id)
    {
        $result = $this->environmentRepository->delete($id);
        $statusCode = empty($result) === false ? '204' : '404';

        return $this->getResponse([], $statusCode);
    }
}
