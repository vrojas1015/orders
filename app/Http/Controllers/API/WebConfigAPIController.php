<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateWebConfigAPIRequest;
use App\Http\Requests\API\UpdateWebConfigAPIRequest;
use App\Models\WebConfig;
use App\Repositories\WebConfigRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class WebConfigController
 * @package App\Http\Controllers\API
 */

class WebConfigAPIController extends AppBaseController
{
    /** @var  WebConfigRepository */
    private $webConfigRepository;

    public function __construct(WebConfigRepository $webConfigRepo)
    {
        $this->webConfigRepository = $webConfigRepo;
    }

    /**
     * Display a listing of the WebConfig.
     * GET|HEAD /webConfigs
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $webConfigs = $this->webConfigRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($webConfigs->toArray(), 'Web Configs retrieved successfully');
    }

    /**
     * Store a newly created WebConfig in storage.
     * POST /webConfigs
     *
     * @param CreateWebConfigAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateWebConfigAPIRequest $request)
    {
        $input = $request->all();

        $webConfig = $this->webConfigRepository->create($input);

        return $this->sendResponse($webConfig->toArray(), 'Web Config saved successfully');
    }

    /**
     * Display the specified WebConfig.
     * GET|HEAD /webConfigs/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var WebConfig $webConfig */
        $webConfig = $this->webConfigRepository->find($id);

        if (empty($webConfig)) {
            return $this->sendError('Web Config not found');
        }

        return $this->sendResponse($webConfig->toArray(), 'Web Config retrieved successfully');
    }

    /**
     * Update the specified WebConfig in storage.
     * PUT/PATCH /webConfigs/{id}
     *
     * @param int $id
     * @param UpdateWebConfigAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateWebConfigAPIRequest $request)
    {
        $input = $request->all();

        /** @var WebConfig $webConfig */
        $webConfig = $this->webConfigRepository->find($id);

        if (empty($webConfig)) {
            return $this->sendError('Web Config not found');
        }

        $webConfig = $this->webConfigRepository->update($input, $id);

        return $this->sendResponse($webConfig->toArray(), 'WebConfig updated successfully');
    }

    /**
     * Remove the specified WebConfig from storage.
     * DELETE /webConfigs/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var WebConfig $webConfig */
        $webConfig = $this->webConfigRepository->find($id);

        if (empty($webConfig)) {
            return $this->sendError('Web Config not found');
        }

        $webConfig->delete();

        return $this->sendSuccess('Web Config deleted successfully');
    }
}
