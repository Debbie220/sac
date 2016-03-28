<?php

use Illuminate\Database\Seeder;
use App\Course;
use App\Subject;

class CourseTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        $this->parseCourses();
    }

    /**
    * Parse all the courses into Course Objects and save in the database.
    */ 
    private function parseCourses(){
        $courses = $this->getCourses();
        foreach ($courses as $course) {
            $number = $course['catalog'][0];
            $title = $course['coursetitle'][0];
            $subject_code = $course['subject'][0];
            try{

                $subject_title = $course['subjecttitle'][0];
                $subject_title = str_replace('Augustana Faculty - ', '', $subject_title);

                Subject::create(['code' => $subject_code, 'name' => $subject_title]);
            } catch(Exception $e){
                // print("Subject ".$subject_code." already exists.\n");
            }
            $attributes = [
                'subject_code' => $subject_code,
                'number' => $number,
                'title' => $title
            ];
            try{
                $course = Course::firstOrNew($attributes);
                $course->offered_this_semester = true;
                $course->save();
            }catch(Exception $e){
                print("Course ".$subject_code.$number." already exists.\n");
            }
        }
    }

    /**
    * Get all the courses in the current term.
    *
    * @return a list with courses names and numbers
    */ 
    private function getCourses(){
        $term = $this->getTerm();
        $term_context = "term={$term},ou=calendar,dc=ualberta,dc=ca";

        $filter = "(facultycode=AU)";

        # Data we want
        # 'subjectTitle' is the name of the the discipline(ie: Psychology)
        # 'subject' is the acronym of the discipline name (ie PSYCHO)
        # 'courseTitle' is the name for this course
        # 'catalog' is the course number (ie: 104)
        $attributes =  ['catalog', 'courseTitle', 'subjectTitle', 'subject'];

        return $this->getResults($term_context, $filter, $attributes);
    
    }


    /**
    * Sets up the connection with the ldap server
    *
    * @return the connection 
    */
    private function setUpConnection(){
        $host = 'ldap://directory.srv.ualberta.ca';
        $conn = ldap_connect($host);
        ldap_bind($conn);//binding anonymously
        return $conn;
    }


    /**
    * Get the current term to update the database
    *
    * @return The code of the current term (Winter or Fall)
    */
    private function getTerm()
    {
        $now = time();
        $year = date('Y',$now);
        $month = date('m',$now);

        $term_name = "Fall";
        if($month < 8) //If this happens before August, gets the Winter term
            $term_name = "Winter";
        

        $termtitle = $term_name.'*'.$year;

        $context = 'ou=calendar,dc=ualberta,dc=ca';
        $filter = '(termtitle='.$termtitle.')';
        $attributes = ['term'];
        
        $entries = $this->getResults($context, $filter, $attributes);
        if($entries)
            return $entries[0]['term'][0];
        else 
            return false;

    }

    /**
    *   Gets the results based on the context, filter and attributes given.
    *
    *   @return the entries without the first count element
    */
    private function getResults($context, $filter, $attributes){
        $conn = $this->setUpConnection();
        $results = @ldap_list($conn, $context, $filter, $attributes);
        $entries = [];

        if($results) {
            $entries = ldap_get_entries($conn,$results);

            # remove first "count" element
            array_shift($entries);
        }
        return $entries;
    }
}
