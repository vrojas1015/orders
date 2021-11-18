<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateSpecialInstructionAPIRequest;
use App\Http\Requests\API\UpdateSpecialInstructionAPIRequest;
use App\Models\SpecialInstruction;
use App\Repositories\SpecialInstructionRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class SpecialInstructionController
 * @package App\Http\Controllers\API
 */

class SpecialInstructionAPIController extends AppBaseController
{
    /** @var  SpecialInstructionRepository */
    private $specialInstructionRepository;

    public function __construct(SpecialInstructionRepository $specialInstructionRepo)
    {
        $this->specialInstructionRepository = $specialInstructionRepo;
    }

    /**
     * Display a listing of the SpecialInstruction.
     * GET|HEAD /specialInstructions
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $specialInstructions = $this->specialInstructionRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($specialInstructions->toArray(), 'Special Instructions retrieved successfully');
    }

    /**
     * Store a newly created SpecialInstruction in storage.
     * POST /specialInstructions
     *
     * @param CreateSpecialInstructionAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateSpecialInstructionAPIRequest $request)
    {
        $input = $request->all();

        $specialInstruction = $this->specialInstructionRepository->create($input);

        return $this->sendResponse($specialInstruction->toArray(), 'Special Instruction saved successfully');
    }

    /**
     * Display the specified SpecialInstruction.
     * GET|HEAD /specialInstructions/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var SpecialInstruction $specialInstruction */
        $specialInstruction = $this->specialInstructionRepository->find($id);

        if (empty($specialInstruction)) {
            return $this->sendError('Special Instruction not found');
        }

        return $this->sendResponse($specialInstruction->toArray(), 'Special Instruction retrieved successfully');
    }

    /**
     * Update the specified SpecialInstruction in storage.
     * PUT/PATCH /specialInstructions/{id}
     *
     * @param int $id
     * @param UpdateSpecialInstructionAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSpecialInstructionAPIRequest $request)
    {
        $input = $request->all();

        /** @var SpecialInstruction $specialInstruction */
        $specialInstruction = $this->specialInstructionRepository->find($id);

        if (empty($specialInstruction)) {
            return $this->sendError('Special Instruction not found');
        }

        $specialInstruction = $this->specialInstructionRepository->update($input, $id);

        return $this->sendResponse($specialInstruction->toArray(), 'SpecialInstruction updated successfully');
    }

    /**
     * Remove the specified SpecialInstruction from storage.
     * DELETE /specialInstructions/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var SpecialInstruction $specialInstruction */
        $specialInstruction = $this->specialInstructionRepository->find($id);

        if (empty($specialInstruction)) {
            return $this->sendError('Special Instruction not found');
        }

        $specialInstruction->delete();

        return $this->sendSuccess('Special Instruction deleted successfully');
    }
}
