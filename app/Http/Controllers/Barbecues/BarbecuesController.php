<?php

namespace App\Http\Controllers\Barbecues;

use App\Exceptions\ApiException;
use App\Helpers\ReturnApi;
use App\Http\Controllers\Controller;
use App\Http\Requests\Barbecues\BarbecuesController\CreateRequest;
use App\Http\Requests\Barbecues\BarbecuesController\DeleteRequest;
use App\Http\Requests\Barbecues\BarbecuesController\FindRequest;
use App\Http\Requests\Barbecues\BarbecuesController\UpdateRequest;
use App\Models\Barbecue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BarbecuesController extends Controller
{
    public function get()
    {
        return ReturnApi::success("All barbecues", Barbecue::with(['owner', 'users'])->get());
    }

    public function find(FindRequest $request)
    {
    }

    public function create(CreateRequest $request)
    {
        $data = $request->validated();

        try {
            DB::beginTransaction();

            $barbecueUsers = [];

            foreach ($data['users'] as $user) {
                $barbecueUsers[$user['id']] = [
                    'paid' => $user['paid'],
                    'with_drink' => $user['with_drink']
                ];
            }

            $barbecue = Barbecue::create([...$data, "owner_id" => 1]);
            $barbecue->users()->sync($barbecueUsers);

            DB::commit();
            return ReturnApi::success("barbecue created",  Barbecue::with(['owner', 'users'])->find($barbecue->id));
        } catch (\Exception $exception) {
            dd($exception);
            DB::rollBack();
            throw new ApiException("Error in create barbecue");
        }
    }

    public function update(UpdateRequest $request)
    {
    }

    public function delete(DeleteRequest $request)
    {
    }
}
