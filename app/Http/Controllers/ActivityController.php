<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;

class ActivityController extends Controller
{
    public function index()
    {
        $dataPage = [
            'pageTitle' => "Activity Log",
            'page' => 'activity',

        ];

        return view('activity.index', $dataPage);
    }

    public function show(Activity $activity)
    {

        if ($activity) {
            $dataJson['message'] = "Data Activity ditemukan";
            $dataJson['data'] = [
                'user' => $activity->user->name,
                'log_name' => $activity->log_name,
                'description' => $activity->description,
                'properties' => $activity->properties,
                'created_at' => $activity->created_at->translatedFormat('j F Y H:i:s'),
            ];
            return response()->json($dataJson, 200);
        }
    }

    public function datatable(Request $request)
    {

        $columns = array(
            0 => 'activity_log.id',
            1 => 'causer_id',
            2 => 'log_name',
            3 => 'description',
            4 => 'created_at',
        );

        $totalData = Activity::count();
        $totalFiltered = $totalData;
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        //custom data
        $userAct = $request->input('userAct');
        $logNameAct = $request->input('logNameAct');
        $descAct = $request->input('descAct');

        /** pengambilan query */
        $query = Activity::orderBy($order, $dir);


        if (!empty($userAct)) {
            if ($userAct == 'system') {
                $query->where('causer_id', null);
            } else {
                $query->where('causer_id', $userAct);
            }
        }


        if (!empty($logNameAct)) {
            $query->where('log_name', $logNameAct);
        }

        if (!empty($descAct)) {
            $query->orWhere('description', 'LIKE', "%{$descAct}%");
        }

        $activities = $query->offset($start)->limit($limit)->get();

        $totalFiltered = $query->count();


        $data = array();
        if (!empty($activities)) {
            $no = $start;
            foreach ($activities as $act) {
                $no++;
                if ($act->causer_id === null) {
                    $username = "System";
                } else {
                    $username = $act->user->name;
                }
                $nestedData['no'] = $no;
                $nestedData['user'] = $username;
                $nestedData['logName'] = $act->log_name;
                $nestedData['description'] = $act->description;
                $nestedData['created_at'] = $act->created_at->translatedFormat('j F Y H:i:s');
                $nestedData['action'] = '<button data-id="' . $act->id . '" class="btn btn-info btn-circle btn-detail">
                <i class="fas fa-search"></i>
                            </button>';

                $data[] = $nestedData;
            }
        }




        $json_data = array(
            "draw"            => intval($request->input('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data,
            "order"           => $order,
            "dir" => $dir,
            "userAct" => $userAct,
            "logNameCat" => $logNameAct,
        );


        return response()->json($json_data, 200);
    }
}
