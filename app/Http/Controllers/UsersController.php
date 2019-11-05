<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Student;
use Session;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $roles = Role::pluck('name', 'name');
        $users = User::all();
        return view('users.index', compact('users', 'roles'));
    }

    public function assignrole(Request $request)
    {
        $user = User::find($request->user_id)->syncRoles($request->roles);
        // dd($user);
        flash('Tugasan telah ditetapkan dengan jayanya.')->success()->important();
        return redirect('users');
    }

    public function uploadPelajar(Request $request)
    {
        // if ($request->input('submit') != null) {

        // dd($request->file('file'));
        $file = $request->file('file');

            // File Details
        $filename = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        $tempPath = $file->getRealPath();
        $fileSize = $file->getSize();
        $mimeType = $file->getMimeType();

            // Valid File Extensions
        $valid_extension = array("csv");

            // 2MB in Bytes
        $maxFileSize = 2097152;

        if(in_array(strtolower($extension),$valid_extension)){
            // Check file size
            if ($fileSize <= $maxFileSize) {
                // File upload location
                $location = 'uploads';

                // Upload file
                $file->move($location, $filename);

                // Import CSV to Database
                $filepath = public_path($location . "/" . $filename);

                // Reading file
                $file = fopen($filepath, "r");

                $importData_arr = array();
                $i = 0;

                while (($filedata = fgetcsv($file, 1000, ",")) !== FALSE) {
                    $num = count($filedata);

                    // Skip first row (Remove below comment if you want to skip the first row)
                    if ($i == 0) {
                        $i++;
                        continue;
                    }

                    for ($c = 0; $c < $num; $c++) {
                        $importData_arr[$i][] = $filedata[$c];
                    }
                    $i++;
                }
                fclose($file);
                // dd($importData_arr);
                // Insert to MySQL database
                foreach ($importData_arr as $importData) {
                    $data = array(
                        "username" => $importData[0],
                        "name" => $importData[1],
                        "email" => $importData[2],
                        "phoneNumber" => $importData[3],
                        "iljtm_id" => $importData[4],
                        "student_ndp" => $importData[5],
                        "course_id" => $importData[6],
                        "student_semester" => $importData[7],
                        "student_session" => $importData[8]
                    );

                    if (Student::where('student_ndp',$data["student_ndp"])->count()==0) {
                        if (User::where('username',$data["username"])->count()==0) {
                            $student = new Student;
                            $student->student_ndp = $data["student_ndp"];
                            $student->course_id = $data["course_id"];
                            $student->student_semester = $data["student_semester"];
                            $student->student_session = $data["student_session"];
                            $student->save();

                            $user = new User;
                            $user->name = $data["name"];
                            $user->username = $data["username"];
                            $user->email = $data["email"];
                            $user->phoneNumber = $data["phoneNumber"];
                            $user->iljtm_id = $data["iljtm_id"];
                            $user->password = bcrypt('password');
                            $user->profileable_type = "App\Student";
                            $user->profileable_id = $student->student_id;
                            $user->save();

                            $user->assignrole('pelajar');
                        }
                    }
                }
            } else {
                flash('File too large. File must be less than 2MB.')->error()->important();
                return redirect()->action('UsersController@index');
            }
        } else {
            flash('Invalid File Extension.')->error()->important();
            return redirect()->action('UsersController@index');
        }
        flash('Data pelajar telah direkodkan')->success()->important();
        return redirect()->action('UsersController@index');
    }
}
