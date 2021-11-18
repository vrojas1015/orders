<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSpecialInstructionRequest;
use App\Http\Requests\UpdateSpecialInstructionRequest;
use App\Repositories\SpecialInstructionRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class SpecialInstructionController extends AppBaseController
{
    /** @var  SpecialInstructionRepository */
    private $specialInstructionRepository;

    public function __construct(SpecialInstructionRepository $specialInstructionRepo)
    {
        $this->specialInstructionRepository = $specialInstructionRepo;
    }

    /**
     * Display a listing of the SpecialInstruction.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $specialInstructions = $this->specialInstructionRepository->all();

        return view('special_instructions.index')
            ->with('specialInstructions', $specialInstructions);
    }

    /**
     * Show the form for creating a new SpecialInstruction.
     *
     * @return Response
     */
    public function create()
    {
        return view('special_instructions.create');
    }

    /**
     * Store a newly created SpecialInstruction in storage.
     *
     * @param CreateSpecialInstructionRequest $request
     *
     * @return Response
     */
    public function store(CreateSpecialInstructionRequest $request)
    {
        $input = $request->all();

        $specialInstruction = $this->specialInstructionRepository->create($input);

        Flash::success('Special Instruction saved successfully.');

        return redirect(route('specialInstructions.index'));
    }

    /**
     * Display the specified SpecialInstruction.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $specialInstruction = $this->specialInstructionRepository->find($id);

        if (empty($specialInstruction)) {
            Flash::error('Special Instruction not found');

            return redirect(route('specialInstructions.index'));
        }

        return view('special_instructions.show')->with('specialInstruction', $specialInstruction);
    }

    /**
     * Show the form for editing the specified SpecialInstruction.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $specialInstruction = $this->specialInstructionRepository->find($id);

        if (empty($specialInstruction)) {
            Flash::error('Special Instruction not found');

            return redirect(route('specialInstructions.index'));
        }

        return view('special_instructions.edit')->with('specialInstruction', $specialInstruction);
    }

    /**
     * Update the specified SpecialInstruction in storage.
     *
     * @param int $id
     * @param UpdateSpecialInstructionRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSpecialInstructionRequest $request)
    {
        $specialInstruction = $this->specialInstructionRepository->find($id);

        if (empty($specialInstruction)) {
            Flash::error('Special Instruction not found');

            return redirect(route('specialInstructions.index'));
        }

        $specialInstruction = $this->specialInstructionRepository->update($request->all(), $id);

        Flash::success('Special Instruction updated successfully.');

        return redirect(route('specialInstructions.index'));
    }

    /**
     * Remove the specified SpecialInstruction from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $specialInstruction = $this->specialInstructionRepository->find($id);

        if (empty($specialInstruction)) {
            Flash::error('Special Instruction not found');

            return redirect(route('specialInstructions.index'));
        }

        $this->specialInstructionRepository->delete($id);

        Flash::success('Special Instruction deleted successfully.');

        return redirect(route('specialInstructions.index'));
    }
}
