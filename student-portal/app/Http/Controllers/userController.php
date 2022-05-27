<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class userController extends Controller
{
    function getLoginInfo(Request $req)
    {
        $req->validate([
            'username' => 'required',
            'password' => 'required',
            'radio' => 'required|in:teacher,admin,student'
        ]);
        $pass = md5($req->password);
        if ($req['radio'] == "teacher") {
            $teacher = NULL;
            $teacher = DB::select('SELECT *
                                    FROM teachers
                                    WHERE username = ? AND teacher_password = ?', [$req->username, $pass]);
            if ($teacher) {
                $req->session()->put('username', $req->username);
                $req->session()->put('userType', 'teacher');
                return redirect('showTeacherStudents');
            } else {
                $_SESSION['error'] = "Wrong username or password";
                return view('login');
            }
        } else if ($req['radio'] == "student") {
            $student = NULL;
            $student = DB::select('SELECT *
                                    FROM students
                                    WHERE username = ? AND `password` = ?', [$req->username, $pass]);
            if ($student) {
                $req->session()->put('username', $req->username);
                $req->session()->put('userType', 'student');
                return redirect('viewRegisteredCourses');
            } else {
                $_SESSION['error'] = "Wrong username or password";
                return view('login');
            }
        } else {
            $user = NULL;
            $user = DB::select('SELECT *
                                FROM admins
                                WHERE username = ? AND admin_password = ?', [$req->username, $req->password]);
            if ($user) {
                $req->session()->put('username', $req->username);
                $req->session()->put('userType', 'admin');
                return redirect('adminProfile');
            } else {
                $_SESSION['error'] = "Wrong username or password";
                return view('login');
            }
        }
    }

    function getRegisterInfo(Request $regReq)
    {
        $regReq->validate([
            'username' => 'required | max:15',
            'password' => 'required | min:6',
            'email' => 'required',
            'id' => 'required | max:4',
        ]);
        $studentUsername = $regReq->username;
        $studentPass = $regReq->password;
        $studentEmail = $regReq->email;
        $studentID = $regReq->id;
        $student = DB::select("SELECT *
                            FROM students
                            WHERE id = ? or username = ? or email = ?", [$studentID, $studentUsername, $studentEmail]);
        if ($student) {
            $_SESSION['error'] = "Already registered";
            return view('register');
        } else {
            $encryptedStudentPass = md5($studentPass);
            DB::insert("INSERT INTO students (username, `password`, email, id, gpa)
                            VALUES ('$studentUsername', '$encryptedStudentPass', '$studentEmail', '$studentID', 0.00)");
            return redirect('login');
        }
    }

    function getCourseRegisterInfo(Request $req)
    {
        $req->validate([
            'coursename' => 'required',
            'cid' => 'required | max:4',
            'hrs' => 'required'
        ]);
        $test = NULL;
        $test = DB::select('SELECT *
                            FROM courses
                            WHERE cid = ? or coursename = ?', [$req->cid, $req->coursename]);
        if ($test) {
            $_SESSION['error'] = "Already existing course";
            return view('addCourse');
        }
        $course = array('coursename' => $req->coursename, 'cid' => $req->cid, 'hrs' => $req->hrs);
        DB::table('courses')->insert($course);
        return redirect('addCourse');
    }

    function getTeacherRegisterInfo(Request $req)
    {
        $req->validate([
            'username' => 'required',
            'cid' => 'required | max:4',
            'email' => 'required',
            'teacher_password' => 'required'
        ]);
        $test = NULL;
        $test = DB::select('SELECT *
                            FROM teachers
                            WHERE username = ? or cid = ? or email = ?', [$req->username, $req->cid, $req->email]);
        if ($test) {
            $_SESSION['error'] = "Already existing teacher";
            return view('teacherRegister');
        }
        $teacher = array('username' => $req->username, 'cid' => $req->cid, 'email' => $req->email, 'teacher_password' => md5($req->teacher_password));
        DB::table('teachers')->insert($teacher);
        return redirect('teacherRegister');
    }

    function delete(Request $req)
    {
        $req->validate([
            'id' => 'required',
            'radio' => 'required|in:teacher,course,student'
        ]);
        if ($req['radio'] == "teacher") {
            $check = NULL;
            $check = DB::select('SELECT *
                                    FROM teachers
                                    WHERE tid = ?', [$req->id]);
            if ($check) {
                DB::statement('Delete FROM teachers WHERE tid = ?', [$req->id]);
                return redirect('adminProfile');
            } else {
                $_SESSION['error'] = "Wrong entry";
                return view('deleteForm');
            }
        } else if ($req['radio'] == "course") {
            $check1 = NULL;
            $check2 = NULL;
            $check1 = DB::select('SELECT *
                                    FROM courses
                                    WHERE cid = ?', [$req->id]);
            $check2 = DB::select('SELECT *
                                    FROM teachers
                                    WHERE cid = ?', [$req->id]);
            if ($check1 && $check2 == NULL) {
                DB::statement('Delete FROM courses WHERE cid = ?', [$req->id]);
                return redirect('adminProfile');
            } else {
                $_SESSION['error'] = "Wrong entry";
                return view('deleteForm');
            }
        } else if ($req['radio'] == "student") {
            $check1 = NULL;
            $check2 = NULL;
            $check1 = DB::select('SELECT *
                                    FROM students
                                    WHERE id = ?', [$req->id]);
            $check2 = DB::select('SELECT *
                                    FROM registration
                                    WHERE id = ?', [$req->id]);
            if ($check1 && $check2 == NULL) {
                DB::statement('Delete FROM students WHERE id = ?', [$req->id]);
                return redirect('adminProfile');
            } else {
                $_SESSION['error'] = "Wrong entry";
                return view('deleteForm');
            }
        }
    }

    function edit(Request $req)
    {
        $req->validate([
            'radio' => 'required|in:teacher,course,student'
        ]);
        if ($req['radio'] == "student") {
            return view('studentEditForm');
        } else if ($req['radio'] == "teacher") {
            return view('teacherEditForm');
        } else if ($req['radio'] == "course") {
            return view('courseEditForm');
        }
    }

    function studentEdit(Request $req)
    {
        $req->validate([
            'id' => 'required',
            'password' => 'required',
            'username' => 'required',
            'email' => 'required'
        ]);
        $check1 = NULL;
        $check2 = NULL;
        $check1 = DB::select('SELECT *
                                FROM students
                                WHERE id = ?', [$req->id]);
        $check2 = DB::select('SELECT *
                                FROM students
                                WHERE (username = ? or email = ?) and id != ?', [$req->username, $req->email, $req->id]);
        if ($check1) {
            if ($check2 == NULL) {
                DB::statement('Update students set password = ?, username = ?, email = ? WHERE id = ?', [md5($req->password), $req->username, $req->email, $req->id]);
                return view('adminProfile');
            }
            $_SESSION['error'] = "Wrong entry!";
            return view('studentEditForm');
        } else {
            $_SESSION['error'] = "Wrong entry!";
            return view('studentEditForm');
        }
    }

    function teacherEdit(Request $req)
    {
        $req->validate([
            'tid' => 'required',
            'cid' => 'required',
            'teacher_password' => 'required',
            'username' => 'required',
            'email' => 'required'
        ]);
        $check1 = NULL;
        $check2 = NULL;
        $check3 = NULL;
        $check1 = DB::select('SELECT *
                                FROM teachers
                                WHERE tid = ?', [$req->tid]);
        $check2 = DB::select('SELECT *
                                FROM courses
                                WHERE cid = ?', [$req->cid]);
        $check3 = DB::select('SELECT *
                                FROM teachers
                                WHERE (username = ? or email = ?) and tid != ?', [$req->username, $req->email, $req->tid]);
        if ($check1 && $check2) {
            if ($check3 == NULL) {
                DB::statement('Update teachers set teacher_password = ?, username = ?, email = ?, cid = ? WHERE tid = ?', [md5($req->teacher_password), $req->username, $req->email, $req->cid, $req->tid]);
                return view('adminProfile');
            }
            $_SESSION['error'] = "Wrong entry!";
            return view('studentEditForm');
        } else {
            $_SESSION['error'] = "Wrong entry!";
            return view('teacherEditForm');
        }
    }

    function courseEdit(Request $req)
    {
        $req->validate([
            'cid' => 'required',
            'coursename' => 'required',
            'hrs' => 'required'
        ]);
        $check1 = NULL;
        $check2 = NULL;
        $check1 = DB::select('SELECT *
                                FROM courses
                                WHERE cid = ?', [$req->cid]);
        $check2 = DB::select('SELECT *
                                FROM courses
                                WHERE coursename = ? and cid != ?', [$req->coursename, $req->cid]);
        if ($check1) {
            if ($check2 == NULL) {
                DB::statement('Update courses set hrs = ?, coursename = ? WHERE cid = ?', [$req->hrs, $req->coursename, $req->cid]);
                return view('adminProfile');
            }
            $_SESSION['error'] = "Wrong entry";
            return view('courseEditForm');
        } else {
            $_SESSION['error'] = "Wrong entry";
            return view('courseEditForm');
        }
    }

    function view(Request $req)
    {
        $req->validate([
            'radio' => 'required|in:teacher,course,student'
        ]);
        if ($req['radio'] == "student") {
            $result = DB::select('SELECT *
                                    FROM students');
            return view('studentsTable', ['result' => $result]);
        } else if ($req['radio'] == "teacher") {
            $result = DB::select('SELECT *
                                    FROM teachers');
            return view('teachersTable', ['result' => $result]);
        } else if ($req['radio'] == "course") {
            $result = DB::select('SELECT *
                                    FROM courses');
            return view('coursesTable', ['result' => $result]);
        }
    }

    public function viewRegisteredCourses()
    {
        $result = DB::select("SELECT * FROM registration join students on students.id = registration.id join courses on courses.cid = registration.cid WHERE students.username = ?", [session('username')]);
        $info = DB::select('SELECT *
                                FROM students
                                WHERE username = ?', [session('username')]);
        $totalGrade = DB::select("SELECT SUM(R.grade*C.hrs) AS S
                                    FROM registration AS R,courses AS C
                                    WHERE R.id = ? AND R.cid = C.cid AND R.grade != 0", [$info[0]->id]);
        $totalNumberOfHours = DB::select("SELECT SUM(hrs) AS S
                                            FROM registration AS R, courses AS C
                                            WHERE R.id = ? AND C.cid = R.cid AND R.grade != 0", [$info[0]->id]);
        if ((float)$totalNumberOfHours[0]->S != 0) {
            $updatedGPA = (float)$totalGrade[0]->S / (float)$totalNumberOfHours[0]->S;
        } else {
            $updatedGPA = 0;
        }
        DB::statement("UPDATE students
                        SET gpa = ?
                        WHERE id = ?", [$updatedGPA, $info[0]->id]);
        $info = DB::select('SELECT *
                                FROM students
                                WHERE username = ?', [session('username')]);
        return view('studentProfile', ['info' => $info[0], 'result' => $result]);
    }

    function showTeacherStudents()
    {
        $teacherUsername = session('username');
        $result = DB::select("SELECT S.id, S.username, S.email
                                FROM registration AS R, teachers AS T, students AS S
                                WHERE R.cid = T.cid AND T.username = ? AND R.grade = 0 AND R.id = S.id", [$teacherUsername]);
        $courseName = DB::select("SELECT *
                                    FROM courses AS C, teachers AS T
                                    WHERE C.cid = T.cid AND T.username = ?", [$teacherUsername]);
        return view('teacherProfile', ['result' => $result, 'courseName' => $courseName[0]]);
    }

    function editedGrades(Request $req)
    {
        $req->validate([
            'cid' => 'required',
            'id' => 'required',
            'grade' => 'required'
        ]);
        $courseID = $req->cid;
        $studentID = $req->id;
        $updatedGrade = $req->grade;
        $result = NULL;
        $CID = NULL;
        $result = DB::select("SELECT id
                                FROM students
                                WHERE id = '$studentID'");
        $CID = DB::select("SELECT *
                            FROM teachers
                            WHERE cid = ? AND username = ?", [$courseID, session('username')]);

        if ($result && $CID) {
            DB::statement("UPDATE registration
                            SET grade = ?
                            WHERE id = ? AND cid = ?", [$updatedGrade, $studentID, $courseID]);
            return redirect('showTeacherStudents');
        } else {
            $_SESSION['error'] = "Wrong entry!";
            return view('editGrades');
        }
    }

    function viewCourseVideos($cid)
    {
        $result = DB::select('SELECT *
                                FROM videos
                                WHERE cid = ?', [$cid]);
        return view('videosPage', ['result' => $result]);
    }

    function getVideoRegisterInfo(Request $req)
    {
        $check = DB::select("SELECT *
                            FROM teachers
                            WHERE cid = ? AND username = ?", [$req->cid, session('username')]);
        if ($check) {
            $del = '/';
            $str1 = $req->file('fileVideo')->store('videos');
            $token1 = strtok($str1, $del);
            $token1 = strtok($del);
            $video = array('cid' => $req->cid, 'location' => $token1);
            $check = NULL;
            DB::table('videos')->insert($video);
        } else {
            $_SESSION['error'] = "Please insert a correct Course ID!";
        }
        return view('uploadVideoForm');
    }

    function enroll(Request $req)
    {
        $req->validate([
            'coursename' => 'required | max:20',
        ]);
        $RegCourse = $req->coursename;
        $course = NULL;
        $check = NULL;
        $course = DB::select("SELECT *FROM courses WHERE coursename= '$RegCourse'");
        $id = DB::table('students')->where('username', session('username'))->first();
        $cid = DB::table('courses')->where('coursename', $RegCourse)->first();
        if ($course) {
            $check = DB::select("SELECT * FROM registration WHERE cid = ? and id = ?", [$cid->cid, $id->id]);
            if ($check == NULL) {
                DB::insert("INSERT INTO registration (id, cid, grade) VALUES ('$id->id','$cid->cid', 0.00)");
                return redirect('viewRegisteredCourses');
            } else {
                $_SESSION['error'] = "Course doesn't exist!";
                return view('enrollForm');
            }
        } else {
            $_SESSION['error'] = "Course doesn't exist!";
            return view('enrollForm');
        }
    }

    function advancedSearch(Request $req)
    {
        $query = NULL;
        $query = DB::table('courses')->select('*')
            ->join('teachers', 'teachers.cid', '=', 'courses.cid')
            ->join('registration', 'registration.cid', '=', 'courses.cid')
            ->join('students', 'students.id', '=', 'registration.id');
        if ($req->id) {
            $query->where('students.id', $req->id);
        }
        if ($req->tid) {
            $query->where('teachers.tid', $req->tid);
        }
        if ($req->cid) {
            $query->where('courses.cid', $req->cid);
        }
        if ($req->studentname) {
            $query->where('students.username', $req->studentname);
        }
        if ($req->teachername) {
            $query->where('teachers.username', $req->teachername);
        }
        if ($req->coursename) {
            $query->where('courses.coursename', $req->coursename);
        }
        if ($req->studentemail) {
            $query->where('students.email', $req->studentemail);
        }
        if ($req->teacheremail) {
            $query->where('teachers.email', $req->teacheremail);
        }
        if ($req->hrs) {
            $query->where('courses.hrs', $req->hrs);
        }
        if ($req->gpa) {
            $query->where('students.gpa', '>=', $req->gpa);
        }
        $search = $query->get();
        return view('searchView', ['search' => $search]);
    }
}
