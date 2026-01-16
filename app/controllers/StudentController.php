<?php
namespace App\Controllers;

use App\Core\Auth;
use App\Models\Course;
use App\Models\Enrollment;

class StudentController {
    private $course;
    private $enrollment;
    
    public function __construct() {
        $this->course = new Course();
        $this->enrollment = new Enrollment();
    }
    
    public function dashboard() {
        Auth::requireLogin();
        
        $studentId = $_SESSION['user_id'];
        $courses = $this->course->getStudentCourses($studentId);
        $allCourses = $this->course->getAll();
        
        include __DIR__ . '/../views/student/dashboard.php';
    }
    
    public function courseDetails($id) {
        Auth::requireLogin();
        
        $course = $this->course->findById($id);
        if (!$course) {
            echo "Cours non trouvé";
            return;
        }
        
        $studentId = $_SESSION['user_id'];
        $isEnrolled = $this->enrollment->isEnrolled($studentId, $id);
        
        include __DIR__ . '/../views/student/course.php';
    }
    
    public function enroll($courseId) {
        Auth::requireLogin();
        
        $studentId = $_SESSION['user_id'];
        
        if ($this->enrollment->isEnrolled($studentId, $courseId)) {
            header('Location: /student/course/' . $courseId);
            exit;
        }
        
        if ($this->enrollment->enroll($studentId, $courseId)) {
            header('Location: /student/course/' . $courseId);
        } else {
            echo "Erreur lors de l'inscription au cours";
        }
        exit;
    }
    
    public function unenroll($courseId) {
        Auth::requireLogin();
        
        $studentId = $_SESSION['user_id'];
        
        if (!$this->enrollment->isEnrolled($studentId, $courseId)) {
            header('Location: /student/course/' . $courseId);
            exit;
        }
        
        if ($this->enrollment->unenroll($studentId, $courseId)) {
            header('Location: /student/course/' . $courseId);
        } else {
            echo "Erreur lors de la désinscription du cours";
        }
        exit;
    }
}
