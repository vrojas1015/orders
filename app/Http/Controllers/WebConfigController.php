<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateWebConfigRequest;
use App\Http\Requests\UpdateWebConfigRequest;
use App\Repositories\WebConfigRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Alert;
use Response;


class WebConfigController extends AppBaseController
{
    /** @var  WebConfigRepository */
    private $webConfigRepository;

    public function __construct(WebConfigRepository $webConfigRepo)
    {
        $this->webConfigRepository = $webConfigRepo;
    }

    /**
     * Display a listing of the WebConfig.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $webConfigs = $this->webConfigRepository->all();

        return view('web_configs.index')
            ->with('webConfigs', $webConfigs);
    }

    /**
     * Show the form for creating a new WebConfig.
     *
     * @return Response
     */
    public function create()
    {
        return view('web_configs.create');
    }

    /**
     * Store a newly created WebConfig in storage.
     *
     * @param CreateWebConfigRequest $request
     *
     * @return Response
     */
    public function store(Request $request)
    {


        $name = $request->file('img')->hashName();
        $extension = $request->file('img')->extension();
        $request->merge(['logo' => 'storage/logos/'.$request->user()->id.'/'.$name]);
        //dd($extension);
        if ($extension == 'jpeg' || $extension =='jpg' || $extension =='png') {

            $input = $request->validate([
                'address' => 'required|string|max:255',
                'logo' => 'required|string|max:255',
            ]);
            $path = $request->file('img')->storeAs(
                'public/logos/'.$request->user()->id, $name
            );
            /*dd(asset('storage/logos/Logo_JM.png'));
            asset('storage/file.txt');*/
        }else{
            Alert::error('Error', 'You must choose a .jpg, png, jpeg format');
            return view('web_configs.create');
        }

        $webConfig = $this->webConfigRepository->create($input);

        Alert::success('Success');

        return redirect(route('webConfigs.index'));
    }

    /**
     * Display the specified WebConfig.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $webConfig = $this->webConfigRepository->find($id);

        if (empty($webConfig)) {
            Flash::error('Web Config not found');

            return redirect(route('webConfigs.index'));
        }

        return view('web_configs.show')->with('webConfig', $webConfig);
    }

    /**
     * Show the form for editing the specified WebConfig.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $webConfig = $this->webConfigRepository->find($id);

        if (empty($webConfig)) {
            Flash::error('Web Config not found');

            return redirect(route('webConfigs.index'));
        }

        return view('web_configs.edit')->with('webConfig', $webConfig);
    }

    /**
     * Update the specified WebConfig in storage.
     *
     * @param int $id
     * @param UpdateWebConfigRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateWebConfigRequest $request)
    {
        $webConfig = $this->webConfigRepository->find($id);

        if (empty($webConfig)) {
            Flash::error('Web Config not found');

            return redirect(route('webConfigs.index'));
        }

        $webConfig = $this->webConfigRepository->update($request->all(), $id);

        Flash::success('Web Config updated successfully.');

        return redirect(route('webConfigs.index'));
    }

    /**
     * Remove the specified WebConfig from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $webConfig = $this->webConfigRepository->find($id);

        if (empty($webConfig)) {
            Flash::error('Web Config not found');

            return redirect(route('webConfigs.index'));
        }

        $this->webConfigRepository->delete($id);

        Flash::success('Web Config deleted successfully.');

        return redirect(route('webConfigs.index'));
    }
}
