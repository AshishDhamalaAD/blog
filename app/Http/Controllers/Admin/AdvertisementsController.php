<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdvertisementRequest;
use App\Models\Advertisement;
use App\Models\Enums\AdvertisementPositionEnum;
use App\Models\Enums\AdvertisementStatusEnum;
use Illuminate\Http\Request;

class AdvertisementsController extends Controller
{
    private string $resource = 'advertisement';
    private string $routeResource = 'advertisements';

    public function index(Request $request)
    {
        $data['headers'] = [
            'Image',
            'Position',
            'Status',
            'Created Date',
            'Action',
        ];
        $data['items'] = Advertisement::latest('id')->paginate(10);
        $data['resource'] = $this->resource;
        $data['routeResource'] = $this->routeResource;
        $data['title'] = __('Advertisements');

        return view('admin.advertisements.index', $data);
    }

    public function create(Request $request)
    {
        $data['title'] = __('Add new Advertisement');
        $data['routeResource'] = $this->routeResource;
        $data['statuses'] = AdvertisementStatusEnum::cases();
        $data['positions'] = AdvertisementPositionEnum::cases();
        $data['model'] = new Advertisement([
            'status' => AdvertisementStatusEnum::ACTIVE,
        ]);

        return view('admin.advertisements.create', $data);
    }

    public function store(AdvertisementRequest $request)
    {
        $advertisement = Advertisement::create($request->createData());

        $this->makeOtherAdvertisementsInactive($advertisement, $request->position);

        return redirect()->route('admin.advertisements.index')->with('success', 'Advertisement created successfully.');
    }

    public function edit(Request $request, Advertisement $advertisement)
    {
        $this->authorize('update', $advertisement);

        $data['title'] = __('Edit Advertisement');
        $data['routeResource'] = $this->routeResource;
        $data['statuses'] = AdvertisementStatusEnum::cases();
        $data['positions'] = AdvertisementPositionEnum::cases();
        $data['model'] = $advertisement;

        return view('admin.advertisements.create', $data);
    }

    public function update(AdvertisementRequest $request, Advertisement $advertisement)
    {
        $this->authorize('update', $advertisement);

        $advertisement->update($request->updateData($advertisement));

        $this->makeOtherAdvertisementsInactive($advertisement, $request->position);

        return back()->with('success', 'Advertisement updated successfully.');
    }

    public function destroy(Advertisement $advertisement)
    {
        $this->authorize('delete', $advertisement);

        $advertisement->deleteImage();

        $advertisement->delete();

        return back()->with('success', 'Advertisement deleted successfully.');
    }

    private function makeOtherAdvertisementsInactive(Advertisement $advertisement, $position)
    {
        Advertisement::where('position', $position)
            ->where('id', '!=', $advertisement->id)
            ->update([
                'status' => AdvertisementStatusEnum::IN_ACTIVE,
            ]);
    }
}
