<?php  // This is the HTML code with the student add-form 

?>

<form name="frmAdd" method="post" action="" id="frmAdd"
    onSubmit="return validate();">
    <div id="mail-status"></div>
    <div>
        <label style="padding-top: 20px;">Name</label> <span
            id="name-info" class="info"></span><br /> <input type="text"
            name="name" id="name" class="demoInputBox">
    </div>
    <div>
        <label>Roll Number</label> <span id="roll-number-info"
            class="info"></span><br /> <input type="text"
            name="roll_number" id="roll_number" class="demoInputBox">
    </div>
    <div>
        <label>Date of Birth</label> <span id="dob-info" class="info"></span><br />
        <input type="date" name="dob" id="dob" class="demoInputBox">
    </div>
    <div>
        <label>Class</label> <span id="class-info" class="info"></span><br />
        <input type="text" name="class" id="class" class="demoInputBox">
    </div>
    <div>
        <input type="submit" name="add" id="btnSubmit" value="Add" />
    </div>
    </div>
</form>
<script src="https://code.jquery.com/jquery-2.1.1.min.js"
    type="text/javascript"></script>
<script>
function validate() {
    var valid = true;   
    $(".demoInputBox").css('background-color','');
    $(".info").html('');
    
    if(!$("#name").val()) {
        $("#name-info").html("(required)");
        $("#name").css('background-color','#FFFFDF');
        valid = false;
    }
    if(!$("#roll_number").val()) {
        $("#roll-number-info").html("(required)");
        $("#roll_number").css('background-color','#FFFFDF');
        valid = false;
    }
    if(!$("#dob").val()) {
        $("#dob-info").html("(required)");
        $("#dob").css('background-color','#FFFFDF');
        valid = false;
    }
    if(!$("#class").val()) {
        $("#class-info").html("(required)");
        $("#class").css('background-color','#FFFFDF');
        valid = false;
    }   
    return valid;
}
</script>
</body>
</html>




<?php
// This is the code from the index.php


require_once ("class/Student.php");

...

// $action = "";
if (! empty($_GET["action"])) {
    $action = $_GET["action"];
}
switch ($action) {
    
    ...
    
    case "student-add":
        if (isset($_POST['add'])) {
            $name = $_POST['name'];
            $roll_number = $_POST['roll_number'];
            $dob = "";
            if ($_POST["dob"]) {
                $dob_timestamp = strtotime($_POST["dob"]);
                $dob = date("Y-m-d", $dob_timestamp);
            }
            $class = $_POST['class'];
            
            $student = new Student();
            $insertId = $student->addStudent($name, $roll_number, $dob, $class);
            if (empty($insertId)) {
                $response = array(
                    "message" => "Problem in Adding New Record",
                    "type" => "error"
                );
            } else {
                header("Location: index.php");
            }
        }
        require_once "web/student-add.php";
        break;
    
    case "student-edit":
        $student_id = $_GET["id"];
        $student = new Student();
        
        if (isset($_POST['add'])) {
            $name = $_POST['name'];
            $roll_number = $_POST['roll_number'];
            $dob = "";
            if ($_POST["dob"]) {
                $dob_timestamp = strtotime($_POST["dob"]);
                $dob = date("Y-m-d", $dob_timestamp);
            }
            $class = $_POST['class'];
            
            $student->editStudent($name, $roll_number, $dob, $class, $student_id);
            
            header("Location: index.php");
        }
        
        $result = $student->getStudentById($student_id);
        require_once "web/student-edit.php";
        break;
    
    case "student-delete":
        $student_id = $_GET["id"];
        $student = new Student();
        
        $student->deleteStudent($student_id);
        
        $result = $student->getAllStudent();
        require_once "web/student.php";
        break;
    
    default:
        $student = new Student();
        $result = $student->getAllStudent();
        require_once "web/student.php";
        break;
}
?>




<?php 


//This is the Student.php code containing the functions to execute PHP CRUD 
//using OOPS and reflect the changes in the student database using MySQLi.


require_once ("class/DBController.php");
class Student
{
    private $db_handle;
    
    function __construct() {
        $this->db_handle = new DBController();
    }
    
    function addStudent($name, $roll_number, $dob, $class) {
        $query = "INSERT INTO tbl_student (name,roll_number,dob,class) VALUES (?, ?, ?, ?)";
        $paramType = "siss";
        $paramValue = array(
            $name,
            $roll_number,
            $dob,
            $class
        );
        
        $insertId = $this->db_handle->insert($query, $paramType, $paramValue);
        return $insertId;
    }
    
    function editStudent($name, $roll_number, $dob, $class, $student_id) {
        $query = "UPDATE tbl_student SET name = ?,roll_number = ?,dob = ?,class = ? WHERE id = ?";
        $paramType = "sissi";
        $paramValue = array(
            $name,
            $roll_number,
            $dob,
            $class,
            $student_id
        );
        
        $this->db_handle->update($query, $paramType, $paramValue);
    }
    
    function deleteStudent($student_id) {
        $query = "DELETE FROM tbl_student WHERE id = ?";
        $paramType = "i";
        $paramValue = array(
            $student_id
        );
        $this->db_handle->update($query, $paramType, $paramValue);
    }
    
    function getStudentById($student_id) {
        $query = "SELECT * FROM tbl_student WHERE id = ?";
        $paramType = "i";
        $paramValue = array(
            $student_id
        );
        
        $result = $this->db_handle->runQuery($query, $paramType, $paramValue);
        return $result;
    }
    
    function getAllStudent() {
        $sql = "SELECT * FROM tbl_student";
        $result = $this->db_handle->runBaseQuery($sql);
        return $result;
    }
}
?>





<?php



require_once ("class/DBController.php");
class Attendance {
    private $db_handle;
    
    function __construct() {
        $this->db_handle = new DBController();
    }
    
    function addAttendance($attendance_date, $student_id, $present, $absent) {
        $query = "INSERT INTO tbl_attendance (attendance_date,student_id,present,absent) VALUES (?, ?, ?, ?)";
        $paramType = "siii";
        $paramValue = array(
            $attendance_date,
            $student_id,
            $present,
            $absent
        );
        
        $insertId = $this->db_handle->insert($query, $paramType, $paramValue);
        return $insertId;
    }
    
    function deleteAttendanceByDate($attendance_date) {
        $query = "DELETE FROM tbl_attendance WHERE attendance_date = ?";
        $paramType = "s";
        $paramValue = array(
            $attendance_date
        );
        $this->db_handle->update($query, $paramType, $paramValue);
    }
    
    function getAttendanceByDate($attendance_date) {
        $query = "SELECT * FROM tbl_attendance LEFT JOIN tbl_student ON tbl_attendance.student_id = tbl_student.id WHERE attendance_date = ? ORDER By student_id";
        $paramType = "s";
        $paramValue = array(
            $attendance_date
        );
        
        $result = $this->db_handle->runQuery($query, $paramType, $paramValue);
        return $result;
    }
    
    function getAttendance() {
        $sql = "SELECT id, attendance_date, sum(present) as present, sum(absent) as absent FROM tbl_attendance GROUP By attendance_date";
        $result = $this->db_handle->runBaseQuery($sql);
        return $result;
    }
}
?>







<?php require_once "web/header.php"; ?>

<form name="frmAdd" method="post" action="" id="frmAdd"
    onSubmit="return validate();">
    <div>
        <input type="date" name="attendance_date" id="attendance_date" class="demoInputBox"> <span id="attendance_date-info" class="info"></span>
    </div>
    <div id="toys-grid">
        <table cellpadding="10" cellspacing="1">
            <thead>
                <tr>
                    <th><strong>Student</strong></th>
                    <th><strong>Present</strong></th>
                    <th><strong>Absent</strong></th>

                </tr>
            </thead>
            <tbody>
                    <?php 
            if (! empty($studentResult)) {
                foreach ($studentResult as $k => $v) {
            ?>
          <tr>
                    <td><input type="hidden"
            name="student_id[]" id="student_id" value = "<?php echo $studentResult[$k]["id"]; ?>">
            <?php echo $studentResult[$k]["name"]; ?></td>
                    <td><input type="radio" name="attendance-<?php echo $studentResult[$k]["id"]; ?>" value="present" checked /></td>
                    <td><input type="radio" name="attendance-<?php echo $studentResult[$k]["id"]; ?>" value="absent" /></td>
                </tr>
                    <?php
                        }
                    }
                    ?>
            <tbody>
        
        </table>
        
    </div>
   <div>
        <input type="submit" name="add" id="btnSubmit" value="Add" />
    </div> 
</form>
<script src="https://code.jquery.com/jquery-2.1.1.min.js"
    type="text/javascript"></script>
<script>
function validate() {
    var valid = true;   
    $(".demoInputBox").css('background-color','');
    $(".info").html('');
    
    if(!$("#attendance_date").val()) {
        $("#attendance_date-info").html("(required)");
        $("#attendance_date").css('background-color','#FFFFDF');
        valid = false;
    } 
    return valid;
}
</script>
</body>
</html>