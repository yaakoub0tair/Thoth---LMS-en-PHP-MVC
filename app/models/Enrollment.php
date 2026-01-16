<?php
namespace App\Models;

class Enrollment {
    private $db;
    
    public function __construct() {
        $this->db = \App\Core\Database::getPDO();
    }
    
    public function enroll($studentId, $courseId) {
        $stmt = $this->db->prepare("INSERT INTO enrollments (student_id, course_id) VALUES (?, ?)");
        return $stmt->execute([$studentId, $courseId]);
    }
    
    public function isEnrolled($studentId, $courseId) {
        $stmt = $this->db->prepare("SELECT * FROM enrollments WHERE student_id = ? AND course_id = ?");
        $stmt->execute([$studentId, $courseId]);
        return $stmt->fetch() !== false;
    }
    
    public function unenroll($studentId, $courseId) {
        $stmt = $this->db->prepare("DELETE FROM enrollments WHERE student_id = ? AND course_id = ?");
        return $stmt->execute([$studentId, $courseId]);
    }
}
