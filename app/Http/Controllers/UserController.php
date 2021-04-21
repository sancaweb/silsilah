<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseFormat;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataPage = [
            'pageTitle' => "User Management",
            'page' => 'user',
            'roles' => Role::all()->pluck('name'),
            'action' => route('user.store')
        ];

        return view('users.index', $dataPage);
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => ['required', 'max:255'],
            'username' => ['required', 'max:255', 'unique:users,username'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required_with:password_confirmation', 'same:password_confirmation', 'min:6'],
            'password_confirmation' => ['min:6'],
            'role' => ['required']
        ]);

        try {
            DB::beginTransaction();


            $user = User::create([
                'name' => $request->nama,
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);

            $user->assignRole($request->role);
            activity('user_management')->withProperties($request)->performedOn($user)->log('Create User');

            DB::commit();


            return ResponseFormat::success([
                'user' => $user
            ], 'Data User berhasil ditambahkan');
        } catch (Exception $error) {
            DB::rollBack();
            return ResponseFormat::error([
                'message' => "Something went wrong",
                'error' => $error
            ], 'Error Penambahan user', 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user =   User::find($id);

        if ($user) {

            return ResponseFormat::success([
                'user' => $user,
                'role' => $user->getRoleNames(),
                'action' => route('user.update', $id)
            ], 'Data user ditemukan');
        } else {
            return ResponseFormat::error([
                'message' => "Data user tidak ditemukan"
            ], "Not found", 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, $id)
    {


        try {
            DB::beginTransaction();
            $user = User::find($id);

            if ($user) {
                $user->name = $request->nama;
                $user->username = $request->username;
                $user->email = $request->email;

                if (!empty($request->password)) {
                    $user->password = Hash::make($request->password);
                }

                $user->save();

                $user->syncRoles($request->role);


                activity('user_management')->withProperties($request)->performedOn($user)->log('Update User');
            } else {
                throw new Exception("Data User tidak ditemukan");
            }

            DB::commit();

            return ResponseFormat::success([
                'user' => $user,
            ], 'User Updated');
        } catch (Exception $error) {
            DB::rollBack();

            return ResponseFormat::error([
                'message' => "Something went wrong",
                'error' => $error
            ], "Update User Error", 400);
        }
    }

    public function delete(Request $request, $id)
    {
        $user = User::find($id);

        if ($user) {
            $user->delete();

            activity('user_management')->withProperties($request)->performedOn($user)->log('Delete User');

            return ResponseFormat::success([
                'message' => "Data berhasil dihapus"
            ], "User Deleted");
        } else {
            return ResponseFormat::error([
                'message' => "User tidak ditemukan",
                'error' => "Delete Failed"

            ], "Delete Failed", 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }



    public function datatable(Request $request)
    {
        $columns = array(
            0 => 'id',
            1 => 'name',
            2 => 'email',
            3 => 'username',
            4 => 'role',
        );

        $totalData = User::count();
        $totalFiltered = $totalData;

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if (empty($request->input('search.value'))) {
            if ($request->input('order.0.column') == 4) {
                $users = User::join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
                    ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
                    ->select('users.*', 'roles.name as rolename')
                    ->offset($start)
                    ->limit($limit)
                    ->orderBy('roles.name', $dir)
                    ->get();
            } else {
                $users = User::offset($start)
                    ->limit($limit)
                    ->orderBy($order, $dir)
                    ->get();
            }
        } else {
            $search = $request->input('search.value');
            if ($request->input('order.0.column') == 4) {
                $users = User::join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
                    ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
                    ->select('users.*', 'roles.name as rolename')
                    ->where('roles.name', 'LIKE', "%{$search}%")
                    ->orWhere('users.name', 'LIKE', "%{$search}%")
                    ->orWhere('username', 'LIKE', "%{$search}%")
                    ->orWhere('email', 'LIKE', "%{$search}%")
                    ->offset($start)
                    ->limit($limit)
                    ->orderBy('roles.name', $dir)
                    ->get();
            } else {
                $users =  User::whereHas('roles', function ($query) use ($search) {
                    $query->where('roles.name', 'LIKE', "%{$search}%");
                })
                    ->orWhere('name', 'LIKE', "%{$search}%")
                    ->orWhere('username', 'LIKE', "%{$search}%")
                    ->orWhere('email', 'LIKE', "%{$search}%")
                    ->offset($start)
                    ->limit($limit)
                    ->orderBy($order, $dir)
                    ->get();
            }


            $totalFiltered = User::whereHas('roles', function ($query) use ($search) {
                $query->where('roles.name', 'LIKE', "%{$search}%");
            })
                ->orWhere('name', 'LIKE', "%{$search}%")
                ->orWhere('username', 'LIKE', "%{$search}%")
                ->orWhere('email', 'LIKE', "%{$search}%")
                ->count();
        }

        $data = array();

        if (!empty($users)) {
            $no = $start;
            foreach ($users as $user) {
                $no++;
                $nestedData['no'] = $no;
                $nestedData['name'] = $user->name;
                $nestedData['email'] = $user->email;
                $nestedData['username'] = $user->username;
                $nestedData['role'] = $user->getRoleNames();

                $nestedData['action'] = '<button data-id="' . $user->id . '" class="btn btn-primary btn-circle btn-edit">
                              <i class="fas fa-edit"></i>
                          </button>
                          <button type="button" data-id="' . $user->id . '" class="btn btn-danger btn-circle btn-delete">
                              <i class="fas fa-trash"></i>
                          </button>
                          ';

                $data[] = $nestedData;
            }
        }

        $json_data = array(
            "draw"            => intval($request->input('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data,
            "order"           => $order,
            "dir" => $dir
        );

        return response()->json($json_data, 200);
    }
}
