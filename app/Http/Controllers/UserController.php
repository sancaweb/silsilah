<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormat;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UserUpdateRequest;
use Illuminate\Support\Facades\Validator;

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
        $dataValidate['foto'] = ['image', 'mimes:jpeg,jpg,png,gif,svg', 'max:5000'];
        $dataValidate['nama'] = ['required', 'max:255'];
        $dataValidate['username'] = ['required', 'max:255', 'unique:users,username'];
        $dataValidate['email'] = ['required', 'email', 'unique:users,email'];
        $dataValidate['password'] = ['required_with:password_confirmation', 'same:password_confirmation', 'min:6'];
        $dataValidate['password_confirmation'] = ['min:6'];
        $dataValidate['role'] = ['required'];

        $validator = Validator::make($request->all(), $dataValidate);

        if ($validator->fails()) {
            return ResponseFormat::error([
                'errorValidator' => $validator->messages(),
            ], 'Error Validator', 402);
        }

        try {
            DB::beginTransaction();

            if ($request->hasFile('foto')) {
                $file = $request->file('foto');
                $foto = $file->store("images/user");
            } else {
                $foto = null;
            }


            $user = User::create([
                'name' => $request->nama,
                'foto' => $foto,
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);

            $user->assignRole($request->role);
            activity('user_management')->withProperties($user)->performedOn($user)->log('Create User');

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

            $dataUser = [
                'foto' => $user->takeImage(),
                'name' => $user->name,
                'username' => $user->username,
                'email' => $user->email,
                'role' => $user->getRoleNames()
            ];

            return ResponseFormat::success([
                'user' => $dataUser,
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
    public function update(Request $request, $id)
    {
        $dataValidate['foto'] = ['image', 'mimes:jpeg,jpg,png,gif,svg', 'max:5000'];
        $dataValidate['nama'] = ['required', 'max:255'];
        $dataValidate['username'] = ['required', 'max:255', 'unique:users,username,' . $id];
        $dataValidate['email'] = ['required', 'email', 'unique:users,email,' . $id];
        $dataValidate['password'] = ['same:password_confirmation'];
        $dataValidate['password_confirmation'] = ['same:password'];
        $dataValidate['role'] = ['required'];

        $validator = Validator::make($request->all(), $dataValidate);

        if ($validator->fails()) {
            return ResponseFormat::error([
                'errorValidator' => $validator->messages(),
            ], 'Error Validator', 402);
        }

        try {
            DB::beginTransaction();
            $user = User::find($id);

            if ($user) {

                if ($request->hasFile('foto')) {
                    $file = $request->file('foto');
                    $foto = $file->store("images/user");
                    Storage::delete($user->foto);
                    $user->foto = $foto;
                }

                $user->name = $request->nama;
                $user->username = $request->username;
                $user->email = $request->email;

                if (!empty($request->password)) {
                    $user->password = Hash::make($request->password);
                }

                $user->save();

                $user->syncRoles($request->role);


                activity('user_management')->withProperties($user)->performedOn($user)->log('Update User');
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

            $activity = activity('user_management')->withProperties($user)->performedOn($user)->log('Delete User');

            $user->delete();


            return ResponseFormat::success([
                'message' => "Data berhasil dihapus",
                'activity' => $activity
            ], "User Deleted");
        } else {
            return ResponseFormat::error([
                'message' => "User tidak ditemukan"

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
            1 => 'foto',
            2 => 'name',
            3 => 'email',
            4 => 'username',
            5 => 'role',
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
                $nestedData['foto'] = '
                        <a id="linkFoto" href="' . $user->takeImage() . '" data-lightbox="' . $user->name . $user->id . '" data-title="User Foto ' . $user->name . '">
                                    <img id="imageReview" src="' . $user->takeImage() . '" alt="Image Foto" style="width: 150px;height: 150px;object-fit:cover;object-position:center;" class="img-thumbnail img-fluid">
                                </a>
                ';
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
