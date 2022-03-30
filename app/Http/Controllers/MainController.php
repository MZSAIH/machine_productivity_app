<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MainController extends Controller
{
    public function show_login()
    {
        if(Auth::check())
            return redirect('/home');
        return view('auth.login');
    }

    public function confirm_login(Request $request)
    {

        $request->validate([
            'username' => 'bail|required',
            'password' => 'bail|required',
        ]);
        if(Auth::attempt(['username' => request('username'), 'password' => request('password')]))
        {
            return redirect('/home');
        }
        return redirect()->back()->withErrors(
            'this credential does not match our record'
            )->withInput();
    }

    public function upload_page()
    {
        return view('upload_file');
    }

    public function handle_file(Request $request)
    {
        /*$file_name = $request->file('uploaded_file')->getClientOriginalName();
        return view('handle_file',compact('file_name'));*/
    /////////////////////////////////////////////////////////////
        $file = $request->file('uploaded_file');
        if ($file) {
            $filename = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension(); //Get extension of uploaded file
            $tempPath = $file->getRealPath();
            $fileSize = $file->getSize(); //Get size of uploaded file in bytes
            //Check for file extension and size
            $this->checkUploadedFileProperties($extension, $fileSize);
            //Where uploaded file will be stored on the server
            $location = 'uploads'; //Created an "uploads" folder for that
            // Upload file
            $file->move($location, $filename);
            // In case the uploaded file path is to be stored in the database
            $filepath = public_path($location . "/" . $filename);
            // Reading file
            $file = fopen($filepath, "r");
            $importData_arr = array(); // Read through the file and store the contents as an array
            if($extension == 'csv'){
                $i = 0;
                //Read the contents of the uploaded file
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
                fclose($file); //Close after reading
            }
            $j = 0;
            foreach ($importData_arr as $importData) {
                print_r($importData);
                /*$name = $importData[1]; //Get user names
                $email = $importData[3]; //Get the user emails
                $j++;
                try {
                    DB::beginTransaction();
                    Player::create([
                        'name' => $importData[1],
                        'club' => $importData[2],
                        'email' => $importData[3],
                        'position' => $importData[4],
                        'age' => $importData[5],
                        'salary' => $importData[6]
                    ]);
                    //Send Email
                    $this->sendEmail($email, $name);
                    DB::commit();
                } catch (\Exception $e) {
                    //throw $th;
                    DB::rollBack();
                }*/
            }
            return response()->json([
                'message' => "$j records successfully uploaded"
            ]);
        } else {
            //no file was uploaded
            throw new \Exception('No file was uploaded', Response::HTTP_BAD_REQUEST);
        }
    }

    public function checkUploadedFileProperties($extension, $fileSize)
    {
        $valid_extension = array("csv", "xlsx"); //Only want csv and excel files
        $maxFileSize = 2097152; // Uploaded file size limit is 2mb
        if (in_array(strtolower($extension), $valid_extension)) {
            if ($fileSize <= $maxFileSize) {
                } else {
                    throw new \Exception('No file was uploaded', Response::HTTP_REQUEST_ENTITY_TOO_LARGE); //413 error
                }
            } else {
            throw new \Exception('Invalid file extension', Response::HTTP_UNSUPPORTED_MEDIA_TYPE); //415 error
        }
    }

}
