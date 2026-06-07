-- =============================================================
-- LMS Database Schema
-- Stack    : React + Python (Django/FastAPI) + PostgreSQL
-- Database : lms
-- Created  : 2026-06-07
-- =============================================================


--
-- Database: "lms"
--

-- --------------------------------------------------------

--
-- Table structure for table "academic_details"
--

CREATE TABLE IF NOT EXISTS "academic_details" (
  "academic_details_id"     SERIAL,
  "student_id"              VARCHAR(20)   NOT NULL,
  "grade12_board"           VARCHAR(25)   DEFAULT NULL,
  "grade12_passing"         VARCHAR(10)   DEFAULT NULL,
  "grade12_osub1"           INT           DEFAULT NULL,
  "grade12_msub1"           INT           DEFAULT NULL,
  "grade12_osub2"           INT           DEFAULT NULL,
  "grade12_msub2"           INT           DEFAULT NULL,
  "obtained_subjects"       VARCHAR(35)   DEFAULT NULL,
  "grade12_osub3"           INT           DEFAULT NULL,
  "grade12_msub3"           INT           DEFAULT NULL,
  "grade12_total"           INT           DEFAULT NULL,
  "grade12_percentage"      INT           DEFAULT NULL,
  "rem"                     VARCHAR(25)   DEFAULT NULL,
  "grade10_board"           VARCHAR(25)   DEFAULT NULL,
  "grade10_passing"         VARCHAR(10)   DEFAULT NULL,
  "grade10_obtained_marks"  INT           DEFAULT NULL,
  "grade10_max_marks"       INT           DEFAULT NULL,
  "grade10_total_marks"     INT           DEFAULT NULL,
  "grade10_percentage"      INT           DEFAULT NULL,
  "grade10_remarks"         VARCHAR(25)   DEFAULT NULL,
  "exam_pass"               VARCHAR(25)   DEFAULT NULL,
  "puc_state"               VARCHAR(25)   DEFAULT NULL,
  "puc_totmarks"            NUMERIC(10,2)   DEFAULT NULL,
  "puc_totper"              NUMERIC(5,2)   DEFAULT NULL,
  PRIMARY KEY ("academic_details_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "academic_exam"
--

CREATE TABLE IF NOT EXISTS "academic_exam" (
  "academic_exam_id"                SERIAL,
  "academic_term_id"  INT          DEFAULT NULL,
  "exam_name"         VARCHAR(50)  DEFAULT NULL,
  "status"            SMALLINT   DEFAULT 1,
  PRIMARY KEY ("academic_exam_id")
);

--
-- Dumping data for table "academic_exam"
--

INSERT INTO "academic_exam" ("academic_exam_id", "academic_term_id", "exam_name", "status") VALUES
(1, 1, 'Mid-Semester 1', 1),
(2, 1, 'End-Semester 1', 1),
(3, 2, 'Mid-Semester 2', 1),
(4, 2, 'End-Semester 2', 1);

-- --------------------------------------------------------

--
-- Table structure for table "academic_term"
--

CREATE TABLE IF NOT EXISTS "academic_term" (
  "academic_term_id"             SERIAL,
  "term"           VARCHAR(100)  DEFAULT NULL,
  "a_year"         VARCHAR(10)   DEFAULT NULL,
  "start_date"     DATE          DEFAULT NULL,
  "end_date"       DATE          DEFAULT NULL,
  "inserted_date"  DATE          DEFAULT NULL,
  "status"         SMALLINT    DEFAULT 1,
  PRIMARY KEY ("academic_term_id")
);

--
-- Dumping data for table "academic_term"
--

INSERT INTO "academic_term" ("academic_term_id", "term", "a_year", "start_date", "end_date", "inserted_date", "status") VALUES
(1, 'Semester One', '2026', '2026-07-01', '2026-12-31', '2026-04-16', 1),
(2, 'Semester Two', '2026', '2026-01-06', '2026-07-30', '2026-04-16', 1);

-- --------------------------------------------------------

--
-- Table structure for table "academic_year"
--

CREATE TABLE IF NOT EXISTS "academic_year" (
  "academic_year_id"         SERIAL,
  "acc_year"   INT         NOT NULL,
  "from_date"  DATE        NOT NULL,
  "to_date"    DATE        NOT NULL,
  "class_div"  INT         NOT NULL,
  "status"     SMALLINT  NOT NULL,
  PRIMARY KEY ("academic_year_id")
);

--
-- Dumping data for table "academic_year"
--

INSERT INTO "academic_year" ("academic_year_id", "acc_year", "from_date", "to_date", "class_div", "status") VALUES
(1, 2026, '2026-06-01', '2026-06-30', 1, 1),
(2, 2026, '2026-06-01', '2026-06-30', 2, 1),
(3, 2026, '2026-06-01', '2026-06-30', 3, 1),
(5, 2026, '2026-07-01', '2027-06-30', 4, 1),
(6, 2026, '2026-06-01', '2026-06-30', 4, 1),
(7, 2026, '2026-07-01', '2027-06-30', 1, 1),
(8, 2026, '2026-07-01', '2027-06-30', 2, 1),
(9, 2026, '2026-07-01', '2027-06-30', 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table "additional_school"
--

CREATE TABLE IF NOT EXISTS "additional_school" (
  "col_id"                    SERIAL,
  "col_name"    VARCHAR(100)  DEFAULT NULL,
  "col_code"    VARCHAR(10)   DEFAULT NULL,
  "col_addr"    VARCHAR(200)  DEFAULT NULL,
  "col_phone"   VARCHAR(15)   DEFAULT NULL,
  "email"       VARCHAR(50)   DEFAULT NULL,
  "company_id"  INT           DEFAULT NULL,
  PRIMARY KEY ("col_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "additional_student"
--

CREATE TABLE IF NOT EXISTS "additional_student" (
  "additional_student_id"               SERIAL,
  "tempid"           INT           DEFAULT NULL,
  "admission_date"   DATE          DEFAULT NULL,
  "student_id"       VARCHAR(20)   DEFAULT NULL,
  "first_name"       VARCHAR(30)   DEFAULT NULL,
  "last_name"        VARCHAR(30)   DEFAULT NULL,
  "nationality"      VARCHAR(20)   DEFAULT NULL,
  "religion"         VARCHAR(20)   DEFAULT NULL,
  "mother_tongue"    VARCHAR(20)   DEFAULT NULL,
  "gender"           CHAR(1)       DEFAULT NULL,
  "caste_id"         INT           DEFAULT NULL,
  "marital_status"   CHAR(1)       DEFAULT NULL,
  "dob"              DATE          DEFAULT NULL,
  "per_address"      VARCHAR(200)  DEFAULT NULL,
  "cor_address"      VARCHAR(200)  DEFAULT NULL,
  "per_country"      VARCHAR(50)   DEFAULT NULL,
  "cor_country"      VARCHAR(50)   DEFAULT NULL,
  "per_phone"        VARCHAR(15)   DEFAULT NULL,
  "cor_phone"        VARCHAR(15)   DEFAULT NULL,
  "per_state"        VARCHAR(25)   DEFAULT NULL,
  "cor_state"        VARCHAR(25)   DEFAULT NULL,
  "course_admitted"  INT           DEFAULT NULL,
  "course_yearsem"   INT           DEFAULT NULL,
  "academic_year"    VARCHAR(12)   DEFAULT NULL,
  "remarks"          VARCHAR(250)  DEFAULT NULL,
  "school_id"       INT           DEFAULT NULL,
  PRIMARY KEY ("additional_student_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "admission"
--

CREATE TABLE IF NOT EXISTS "admission" (
  "admission_id"             SERIAL,
  "name"        VARCHAR(50)  NOT NULL DEFAULT '',
  "short_name"  VARCHAR(10)  DEFAULT NULL,
  PRIMARY KEY ("admission_id")
);

--
-- Dumping data for table "admission"
--

INSERT INTO "admission" ("admission_id", "name", "short_name") VALUES
(1, 'Indian', 'Ind'),
(2, 'Foreign', 'For');

-- --------------------------------------------------------

--
-- Table structure for table "admissiontrack"
--

CREATE TABLE IF NOT EXISTS "admissiontrack" (
  "admissiontrack_id"          SERIAL,
  "student_id"  INT   NOT NULL,
  "desdet"      TEXT  NOT NULL,
  "trackid"     INT   NOT NULL,
  "mark"        INT   NOT NULL,
  PRIMARY KEY ("admissiontrack_id")
);

--
-- Dumping data for table "admissiontrack"
--

INSERT INTO "admissiontrack" ("admissiontrack_id", "student_id", "desdet", "trackid", "mark") VALUES
(1, 1, '', 1, 0),
(2, 1000000, 'hhhhhhh', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table "admission_stage_master"
--

CREATE TABLE IF NOT EXISTS "admission_stage_master" (
  "admission_stage_master_id"                SERIAL,
  "admission_steps_master_id"  INT           NOT NULL,
  "main_stages"                VARCHAR(200)  NOT NULL,
  "action_1"                   INT           NOT NULL DEFAULT 1,
  "posi"                       VARCHAR(100)  NOT NULL,
  "status"                     INT           NOT NULL DEFAULT 1,
  "inserted_date_time"         TIMESTAMP      DEFAULT NULL,
  PRIMARY KEY ("admission_stage_master_id")
);

--
-- Dumping data for table "admission_stage_master"
--

INSERT INTO "admission_stage_master" ("admission_stage_master_id", "admission_steps_master_id", "main_stages", "action_1", "posi", "status", "inserted_date_time") VALUES
(31, 3, 'Application form not purchased', 2, '1', 1, '2026-02-23 12:58:48'),
(30, 3, 'Application form purchased ', 3, '2', 1, '2026-02-23 12:58:28'),
(4, 2, 'To be Scheduled ', 1, '1', 1, '2026-02-22 12:28:46'),
(5, 2, 'Invited', 1, '2', 1, '2026-02-22 12:29:10'),
(6, 2, 'Rejected', 2, '3', 1, '2026-02-22 12:29:39'),
(7, 4, 'Registered', 3, '2', 1, '2026-02-22 12:31:05'),
(8, 4, 'To be registered ', 1, '1', 1, '2026-02-22 12:31:34'),
(9, 4, 'Withdrawn', 1, '3', 1, '2026-02-22 12:31:51'),
(10, 5, 'Completed, Shortlisted to Interaction', 3, '3', 1, '2026-02-22 12:32:57');

-- --------------------------------------------------------

--
-- Table structure for table "admission_steps_master"
--

CREATE TABLE IF NOT EXISTS "admission_steps_master" (
  "admission_steps_master_id"         SERIAL,
  "main_steps"          VARCHAR(250)  NOT NULL,
  "pos"                 INT           NOT NULL,
  "status"              INT           NOT NULL DEFAULT 1,
  "comments"            VARCHAR(100)  NOT NULL,
  "inserted_date_time"  TIMESTAMP      DEFAULT NULL,
  PRIMARY KEY ("admission_steps_master_id")
);

--
-- Dumping data for table "admission_steps_master"
--

INSERT INTO "admission_steps_master" ("admission_steps_master_id", "main_steps", "pos", "status", "comments", "inserted_date_time") VALUES
(2, 'Information Session', 1, 1, '', '2026-02-22 12:13:35'),
(3, 'Issue of Application Form', 2, 1, '', '2026-02-22 12:16:56'),
(4, 'Registration of Application Form', 3, 1, '', '2026-02-22 12:17:16'),
(5, 'Test ', 4, 1, '', '2026-02-22 12:17:36'),
(6, 'Interaction', 5, 1, '', '2026-02-22 12:17:55'),
(7, 'Admission Decision', 6, 1, '', '2026-02-22 12:18:20'),
(8, 'Fee Payment', 7, 1, '', '2026-02-22 12:18:41');

-- --------------------------------------------------------

--
-- Table structure for table "album"
--

CREATE TABLE IF NOT EXISTS "album" (
  "album_id"                    SERIAL,
  "album_name"   VARCHAR(70)  NOT NULL,
  "description"  TEXT         NOT NULL,
  "class"        INT          NOT NULL,
  "section"      INT          NOT NULL,
  "status"       SMALLINT    NOT NULL,
  PRIMARY KEY ("album_id")
);

--
-- Dumping data for table "album"
--

INSERT INTO "album" ("album_id", "album_name", "description", "class", "section", "status") VALUES
(1, 'LMS ', 'School Pictures', 0, 0, 0),
(2, 'LMS', 'LMS', 0, 0, 0),
(3, 'LMS', 'Activities', 0, 0, 0),
(4, 'Campus', 'Campus', 0, 0, 0),
(5, 'School Album', 'This is a sample Album', 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table "albumpic"
--

CREATE TABLE IF NOT EXISTS "albumpic" (
  "albumpic_id"               SERIAL,
  "album_id"         INT           NOT NULL,
  "pic_name"         VARCHAR(70)   NOT NULL,
  "description"      TEXT          NOT NULL,
  "full_image_path"  VARCHAR(270)  NOT NULL,
  "half_image_path"  VARCHAR(270)  NOT NULL,
  "cover"            SMALLINT    NOT NULL,
  "status"           SMALLINT    NOT NULL,
  PRIMARY KEY ("albumpic_id")
);

--
-- Dumping data for table "albumpic"
--

INSERT INTO "albumpic" ("albumpic_id", "album_id", "pic_name", "description", "full_image_path", "half_image_path", "cover", "status") VALUES
(1, 1, 'LMS 0', 'Main', '../PhotoGallery/images/68db0b28f5b559c0aa58475ab4fd42a9.jpg', '../PhotoGallery/images/68db0b28f5b559c0aa58475ab4fd42a9.jpg', 0, 1),
(2, 1, 'LMS 0 0', 'Cafeteria', '../PhotoGallery/images/932656ce69ac72b747e4945dd7952144.jpg', '../PhotoGallery/images/932656ce69ac72b747e4945dd7952144.jpg', 0, 0),
(3, 1, 'LMS 0 0 0', 'Library', '../PhotoGallery/images/8b392adea22c53b113bb84b49ef210d8.jpg', '../PhotoGallery/images/8b392adea22c53b113bb84b49ef210d8.jpg', 0, 0),
(4, 1, 'LMS 0 0 0 0', 'Sports', '../PhotoGallery/images/691e7428468f15ca6a1d1a5a995446ed.jpg', '../PhotoGallery/images/691e7428468f15ca6a1d1a5a995446ed.jpg', 0, 0),
(5, 1, 'LMS 0', 'Logo', '../PhotoGallery/images/d76fc0bdb9359c8fde22fb74bbe438a0.gif', '../PhotoGallery/images/d76fc0bdb9359c8fde22fb74bbe438a0.gif', 0, 1),
(6, 1, 'LMS 0', 'Campus', '../PhotoGallery/images/56ce9da87c1ab6c9124ae64308372c6d.jpg', '../PhotoGallery/images/56ce9da87c1ab6c9124ae64308372c6d.jpg', 0, 0),
(7, 1, 'LMS 0', 'Campus', '../PhotoGallery/images/892a506b8de7d6b4b1d3ca85249182a7.jpg', '../PhotoGallery/images/892a506b8de7d6b4b1d3ca85249182a7.jpg', 0, 1),
(8, 3, 'Library 0', 'Library', '../PhotoGallery/images/99104dfeb97527645c65853fdaa32619.jpg', '../PhotoGallery/images/99104dfeb97527645c65853fdaa32619.jpg', 0, 0),
(9, 3, 'Sports 0', 'Sports', '../PhotoGallery/images/72140e9cf64609b0c040447fc744c052.jpg', '../PhotoGallery/images/72140e9cf64609b0c040447fc744c052.jpg', 0, 1),
(10, 3, 'Cafeteria 0', 'Cafeteria', '../PhotoGallery/images/6cc10c154ac90dfcc4f4ee77ab2e38df.jpg', '../PhotoGallery/images/6cc10c154ac90dfcc4f4ee77ab2e38df.jpg', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table "all_teachers"
--

CREATE TABLE IF NOT EXISTS "all_teachers" (
  "all_teachers_id"         BIGSERIAL,
  "class"      INT           NOT NULL,
  "user"       VARCHAR(255)  NOT NULL,
  "sub"        INT           NOT NULL,
  "section"    INT           NOT NULL,
  "sub_teac2"  INT           NOT NULL,
  "sub_teac"   INT           NOT NULL,
  "home_teac"  INT           NOT NULL,
  "sub_type"   INT           NOT NULL,
  "acc_year"   INT           NOT NULL,
  PRIMARY KEY ("all_teachers_id")
);

CREATE INDEX "ix_year_class_sec" ON "all_teachers" ("acc_year", "class", "section");
CREATE INDEX "ix_user_year" ON "all_teachers" ("user", "acc_year");

--
-- Dumping data for table "all_teachers"
--

INSERT INTO "all_teachers" ("all_teachers_id", "class", "user", "sub", "section", "sub_teac2", "sub_teac", "home_teac", "sub_type", "acc_year") VALUES
(2, 1, 'administrator', 237, 64, 0, 0, 161, 2, 2026),
(3, 10, 'administrator', 69, 65, 0, 19, 0, 1, 2026),
(8, 6, 'administrator', 69, 66, 0, 19, 0, 1, 2026),
(303, 1, 'administrator', 237, 67, 0, 0, 163, 2, 2026),
(4, 5, 'administrator', 6, 69, 18, 18, 18, 1, 2026),
(5, 5, 'administrator', 5, 70, 17, 19, 18, 1, 2026),
(6, 10, 'administrator', 69, 66, 0, 19, 0, 1, 2026),
(7, 7, 'administrator', 69, 65, 18, 19, 18, 1, 2026),
(11, 10, 'administrator', 77, 72, 0, 0, 11, 2, 2026),
(10, 10, 'administrator', 77, 71, 0, 0, 52, 2, 2026);


-- --------------------------------------------------------

--
-- Table structure for table "announcement"
--

CREATE TABLE IF NOT EXISTS "announcement" (
  "announcement_id"           SERIAL,
  "acc_year"     INT           NOT NULL,
  "type"         SMALLINT    NOT NULL,
  "fromdate"     DATE          NOT NULL,
  "todate"       DATE          NOT NULL,
  "title"        VARCHAR(200)  NOT NULL,
  "description"  TEXT          NOT NULL,
  "status"       SMALLINT    NOT NULL,
  PRIMARY KEY ("announcement_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "announcement_call"
--

CREATE TABLE IF NOT EXISTS "announcement_call" (
  "announcement_call_id"           SERIAL,
  "type"         SMALLINT    NOT NULL,
  "fromdate"     DATE          NOT NULL,
  "todate"       DATE          NOT NULL,
  "title"        VARCHAR(200)  NOT NULL,
  "description"  TEXT          NOT NULL,
  "acc_year"     INT           NOT NULL,
  "status"       SMALLINT    NOT NULL,
  PRIMARY KEY ("announcement_call_id")
);

--
-- Dumping data for table "announcement_call"
--

INSERT INTO "announcement_call" ("announcement_call_id", "type", "fromdate", "todate", "title", "description", "acc_year", "status") VALUES
(1, 1, '2026-08-05', NULL, 'School Reopens', 'School Reopens for the Academic year 2026-2026', 2026, 1),
(2, 2, '2026-08-22', '2026-08-27', '   School Mails Going into Spam', 'Over the past couple of months Google has made major modifications to its security settings. We have to send mass mails to our parents via a mail blaster but the security setting that Gmail users have deem these as unauthentic and they land in the spam folder. In such a case, please open the message and click on the button which says ''not spam''. Subsequent mails from the school will then be received in your inbox.', 2026, 1);

-- --------------------------------------------------------

--
-- Table structure for table "announcement_class"
--

CREATE TABLE IF NOT EXISTS "announcement_class" (
  "announcement_class_id"           SERIAL,
  "acc_year"     INT           NOT NULL,
  "type"         SMALLINT    NOT NULL,
  "class"        INT           NOT NULL,
  "username"     VARCHAR(30)   NOT NULL,
  "fromdate"     DATE          NOT NULL,
  "todate"       DATE          NOT NULL,
  "title"        VARCHAR(200)  NOT NULL,
  "description"  TEXT          NOT NULL,
  "status"       SMALLINT    NOT NULL,
  "grade"        INT           NOT NULL,
  "section_id"   INT           NOT NULL,
  "trg_name"     VARCHAR(255)  NOT NULL,
  "trg_path"     VARCHAR(255)  NOT NULL,
  PRIMARY KEY ("announcement_class_id")
);

CREATE INDEX "ix_year_grade_sec" ON "announcement_class" ("acc_year", "grade", "section_id", "status");
CREATE INDEX "ix_username_year" ON "announcement_class" ("username", "acc_year");

--
-- Dumping data for table "announcement_class"
--

INSERT INTO "announcement_class" ("announcement_class_id", "acc_year", "type", "class", "username", "fromdate", "todate", "title", "description", "status", "grade", "section_id", "trg_name", "trg_path") VALUES
(1, 2026, 1, 0, 'administrator', '2026-08-01', NULL, 'School Reopens', 'School Reopens for the Academic Year 2026-14', 1, 0, 0, '', ''),
(2, 2026, 1, 3, 'brindaa', '2026-08-01', NULL, 'Welcome Back To School', 'Dear Student,\r\nWelcome back to School wishing you a great year ahead.\r\n\r\nRegards,\r\nBrinda', 1, 10, 71, '', ''),
(3, 2026, 1, 2, 'administrator', '2026-08-15', NULL, 'Test Homeroom', 'Testing', 1, 5, 116, '', ''),
(4, 2026, 1, 2, 'administrator', '2026-08-30', NULL, 'Test Math', 'Math', 1, 5, 702, '', ''),
(5, 2026, 2, 0, 'administrator', '2026-08-21', '2026-08-23', 'Curriculum morning - Grade 5', 'Curriculum morning - Grade 5', 1, 0, 0, '', ''),
(6, 2026, 2, 0, 'administrator', '2026-08-22', '2026-08-23', 'PTA Formation (attachment)    ', '\nMeet with PTA Nominees: Please find attached the PTA Grade Representative Nominee Profile. Before the Grade Representatives (GR) are elected, you can meet with them informally and get to know them better.  For this we have organized a Q&A session with the Grade Representatives on Tuesday August 27, 2026 (8am - 9am) in the Board room (Ground Floor).\n\nVoting Process: The Ballot form for voting for your GR will be emailed on Mon, August 26th 2026. Submission of votes begins Tuesday, August 27th  . Parents must vote for their own grade level ONLY. The Ballot forms must be signed and either dropped in the drop-box at the School reception or scanned and emailed it to us at saroni.ghosh@email.com\n\nYour votes must be received by August 30th , 2026. Ballot forms without name and signature will not be accepted. \n\nDeclaration of Elected Grade Representatives: The PTA body will be announced on Monday September 2, 2026.', 1, 0, 0, '', ''),
(7, 2026, 2, 2, 'administrator', '2026-08-21', '2026-08-24', 'Curriculum morning: Grade 5', 'Curriculum morning: Grade 5', 1, 9, 141, '', ''),
(8, 2026, 2, 2, 'administrator', '2026-08-21', '2026-08-25', 'Curriculum morning: Grade 5', 'Curriculum morning: Grade 5', 1, 9, 138, '', ''),
(9, 2026, 2, 2, 'administrator', '2026-08-21', '2026-08-24', 'Curriculum morning: Grade 5', 'Curriculum morning: Grade 5', 1, 9, 139, '', ''),
(10, 2026, 2, 2, 'administrator', '2026-08-21', '2026-08-24', 'Curriculum morning: Grade 5', 'Curriculum morning: Grade 5', 1, 9, 140, '', '');


-- --------------------------------------------------------

--
-- Table structure for table "announcement_class_call"
--

CREATE TABLE IF NOT EXISTS "announcement_class_call" (
  "announcement_class_call_id"           SERIAL,
  "acc_year"     INT           NOT NULL,
  "type"         SMALLINT    NOT NULL,
  "class"        INT           NOT NULL,
  "username"     VARCHAR(30)   NOT NULL,
  "fromdate"     DATE          NOT NULL,
  "todate"       DATE          NOT NULL,
  "title"        VARCHAR(200)  NOT NULL,
  "description"  TEXT          NOT NULL,
  "status"       SMALLINT    NOT NULL,
  "grade"        INT           NOT NULL,
  "section_id"   INT           NOT NULL,
  PRIMARY KEY ("announcement_class_call_id")
);

--
-- Dumping data for table "announcement_class_call"
--

INSERT INTO "announcement_class_call" ("announcement_class_call_id", "acc_year", "type", "class", "username", "fromdate", "todate", "title", "description", "status", "grade", "section_id") VALUES
(1, 2026, 1, 2, 'administrator', '2026-08-15', NULL, 'Class Test', 'test', 1, 5, 116),
(2, 2026, 1, 3, 'brindaa', '2026-08-19', NULL, 'Attendance', '', 1, 10, 72);

-- --------------------------------------------------------

--
-- Table structure for table "announcement_class_test"
--

CREATE TABLE IF NOT EXISTS "announcement_class_test" (
  "announcement_class_test_id"           SERIAL,
  "acc_year"     INT           NOT NULL,
  "type"         SMALLINT    NOT NULL,
  "class"        INT           NOT NULL,
  "username"     VARCHAR(30)   NOT NULL,
  "fromdate"     DATE          NOT NULL,
  "todate"       DATE          NOT NULL,
  "title"        VARCHAR(200)  NOT NULL,
  "description"  TEXT          NOT NULL,
  "status"       SMALLINT    NOT NULL,
  "grade"        INT           NOT NULL,
  "section_id"   INT           NOT NULL,
  "trg_name"     VARCHAR(255)  NOT NULL,
  "trg_path"     VARCHAR(255)  NOT NULL,
  "subject"      VARCHAR(200)  DEFAULT NULL,
  PRIMARY KEY ("announcement_class_test_id")
);

--
-- Dumping data for table "announcement_class_test"
--

INSERT INTO "announcement_class_test" ("announcement_class_test_id", "acc_year", "type", "class", "username", "fromdate", "todate", "title", "description", "status", "grade", "section_id", "trg_name", "trg_path", "subject") VALUES
(69, 2026, 1, 1, 'administrator', '2026-11-19', NULL, 'Title', '<p>Description</p>', 1, 0, 0, '', '', ''),
(70, 2026, 1, 2, 'administrator', '2026-11-19', NULL, 'Title', '<p>Description</p>', 1, 0, 0, '', '', ''),
(71, 2026, 1, 3, 'administrator', '2026-11-19', NULL, 'Title', '<p>Description</p>', 1, 0, 0, '', '', ''),
(72, 2026, 1, 4, 'administrator', '2026-11-19', NULL, 'Title', '<p>Description</p>', 1, 0, 0, '', '', ''),
(73, 2026, 2, 5, 'administrator', '2026-11-20', '2026-11-21', 'test', '<p>test</p>', 1, 0, 0, '', '', ''),
(74, 2026, 2, 6, 'administrator', '2026-11-20', '2026-11-21', 'test', '<p>test</p>', 1, 0, 0, '', '', ''),
(75, 2026, 2, 7, 'administrator', '2026-11-20', '2026-11-21', 'test', '<p>test</p>', 1, 0, 0, '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table "announcement_class_test_docs"
--

CREATE TABLE IF NOT EXISTS "announcement_class_test_docs" (
  "announcement_class_test_docs_id"           INT           NOT NULL DEFAULT 0,
  "acc_year"     INT           NOT NULL,
  "type"         SMALLINT    NOT NULL,
  "class"        INT           NOT NULL,
  "username"     VARCHAR(30)   NOT NULL,
  "fromdate"     DATE          NOT NULL,
  "todate"       DATE          NOT NULL,
  "title"        VARCHAR(200)  NOT NULL,
  "description"  TEXT          NOT NULL,
  "status"       SMALLINT    NOT NULL,
  "grade"        INT           NOT NULL,
  "section_id"   INT           NOT NULL,
  "trg_name"     VARCHAR(255)  NOT NULL,
  "trg_path"     VARCHAR(255)  NOT NULL,
  "subject"      VARCHAR(200)  DEFAULT NULL,
  PRIMARY KEY ("announcement_class_test_docs_id")
);

--
-- Dumping data for table "announcement_class_test_docs"
--

INSERT INTO "announcement_class_test_docs" ("announcement_class_test_docs_id", "acc_year", "type", "class", "username", "fromdate", "todate", "title", "description", "status", "grade", "section_id", "trg_name", "trg_path", "subject") VALUES
(1, 2026, 1, 0, 'administrator', '2026-08-01', NULL, 'School Reopens', 'School Reopens for the Academic Year 2026-14', 1, 0, 0, '', '', NULL),
(2, 2026, 1, 3, 'brindaa', '2026-08-01', NULL, 'Welcome Back To School', 'Dear Student,\r\nWelcome back to School wishing you a great year ahead.\r\n\r\nRegards,\r\nBrinda', 1, 10, 71, '', '', NULL),
(3, 2026, 1, 2, 'administrator', '2026-08-15', NULL, 'Test Homeroom', 'Testing', 1, 5, 116, '', '', NULL),
(4, 2026, 1, 2, 'administrator', '2026-08-30', NULL, 'Test Math', 'Math', 1, 5, 702, '', '', NULL),
(5, 2026, 2, 0, 'administrator', '2026-08-21', '2026-08-23', 'Curriculum morning - Grade 5', 'Curriculum morning - Grade 5', 1, 0, 0, '', '', NULL),
(6, 2026, 2, 0, 'administrator', '2026-08-22', '2026-08-23', 'PTA Formation (attachment)    ', '\nMeet with PTA Nominees: Please find attached the PTA Grade Representative Nominee Profile. Before the Grade Representatives (GR) are elected, you can meet with them informally and get to know them better.  For this we have organized a Q&A session with the Grade Representatives on Tuesday August 27, 2026 (8am - 9am) in the Board room (Ground Floor).\n\nVoting Process: The Ballot form for voting for your GR will be emailed on Mon, August 26th 2026. Submission of votes begins Tuesday, August 27th  . Parents must vote for their own grade level ONLY. The Ballot forms must be signed and either dropped in the drop-box at the School reception or scanned and emailed it to us at saroni.ghosh@email.com\n\nYour votes must be received by August 30th , 2026. Ballot forms without name and signature will not be accepted. \n\nDeclaration of Elected Grade Representatives: The PTA body will be announced on Monday September 2, 2026.', 1, 0, 0, '', '', NULL),
(7, 2026, 2, 2, 'administrator', '2026-08-21', '2026-08-24', 'Curriculum morning: Grade 5', 'Curriculum morning: Grade 5', 1, 9, 141, '', '', NULL),
(8, 2026, 2, 2, 'administrator', '2026-08-21', '2026-08-25', 'Curriculum morning: Grade 5', 'Curriculum morning: Grade 5', 1, 9, 138, '', '', NULL),
(9, 2026, 2, 2, 'administrator', '2026-08-21', '2026-08-24', 'Curriculum morning: Grade 5', 'Curriculum morning: Grade 5', 1, 9, 139, '', '', NULL),
(10, 2026, 2, 2, 'administrator', '2026-08-21', '2026-08-24', 'Curriculum morning: Grade 5', 'Curriculum morning: Grade 5', 1, 9, 140, '', '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table "app_hod"
--

CREATE TABLE IF NOT EXISTS "app_hod" (
  "app_hod_id"        SERIAL,
  "courseid"  INT  DEFAULT NULL,
  "fid"       INT  DEFAULT NULL,
  PRIMARY KEY ("app_hod_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "archive"
--

CREATE TABLE IF NOT EXISTS "archive" (
  "f_name"                  CHAR(50)          NOT NULL DEFAULT '',
  "s_name"                  CHAR(50)          NOT NULL DEFAULT '',
  "i_name"                  CHAR(15)          DEFAULT NULL,
  "qual"                    CHAR(150)         DEFAULT NULL,
  "cert"                    CHAR(150)         DEFAULT NULL,
  "subj"                    INT               NOT NULL DEFAULT 0,
  "exp_cur"                 REAL             DEFAULT NULL,
  "exp_prev"                REAL             DEFAULT NULL,
  "sp_assoc"                CHAR(150)         DEFAULT NULL,
  "xtra"                    CHAR(150)         DEFAULT NULL,
  "father"                  CHAR(50)          DEFAULT NULL,
  "doa"                     CHAR(50)          DEFAULT NULL,
  "bg"                      CHAR(15)          NOT NULL DEFAULT '',
  "ms"                      CHAR(150)         NOT NULL DEFAULT '',
  "addr_perm"               CHAR(250)         DEFAULT NULL,
  "ct_perm"                 CHAR(50)          DEFAULT NULL,
  "pin_perm"                CHAR(50)          DEFAULT NULL,
  "st_perm"                 CHAR(50)          DEFAULT NULL,
  "ph_perm"                 CHAR(50)          DEFAULT NULL,
  "addr_pres"               CHAR(250)         DEFAULT NULL,
  "ct_pres"                 CHAR(50)          DEFAULT NULL,
  "pin_pres"                CHAR(50)          DEFAULT NULL,
  "st_pres"                 CHAR(50)          DEFAULT NULL,
  "ph_pres"                 CHAR(50)          DEFAULT NULL,
  "email"                   CHAR(50)          DEFAULT NULL,
  "archive_id"                      INT               NOT NULL DEFAULT 0,
  "slno"                    CHAR(50)          NOT NULL DEFAULT '',
  "group_id"                INT               DEFAULT NULL,
  "type_id"                 INT               NOT NULL DEFAULT 0,
  "offeredsal"              INT               NOT NULL DEFAULT 0,
  "basicsal"                INT               NOT NULL DEFAULT 0,
  "j_date"                  DATE              DEFAULT NULL,
  "cmts"                    CHAR(250)         DEFAULT NULL,
  "status_id"               INT               DEFAULT NULL,
  "dob"                     DATE              DEFAULT NULL,
  "other_facilities"        CHAR(250)         DEFAULT NULL,
  "other_responsibilities"  CHAR(250)         DEFAULT NULL,
  "prev_post"               CHAR(50)          DEFAULT NULL,
  "prev_work_place"         CHAR(50)          DEFAULT NULL,
  "prev_work_city"          CHAR(50)          DEFAULT NULL,
  "prev_work_country"       CHAR(50)          DEFAULT NULL,
  "last_date_of_work"       DATE              DEFAULT NULL,
  "staff_status_id"         INT               DEFAULT NULL,
  "date_of_updation"        DATE              DEFAULT NULL,
  "expirydate"              DATE              DEFAULT NULL,
  "gender"                  CHAR(10)          DEFAULT NULL,
  "releive_date"            DATE              DEFAULT NULL,
  "recruitment_procedure"   VARCHAR(50)  NOT NULL DEFAULT 'YES',
  "pfscheme"                VARCHAR(50)  NOT NULL DEFAULT 'YES',
  "active"                  VARCHAR(50)  DEFAULT 'YES',
  "bank_ac_no"              CHAR(20)          DEFAULT NULL,
  "pf_ac_no"                CHAR(15)          DEFAULT NULL,
  "panno"                   CHAR(25)          DEFAULT NULL,
  "csal"                    REAL             DEFAULT NULL,
  "sop"                     CHAR(10)          DEFAULT NULL,
  "cat"                     CHAR(12)          DEFAULT NULL,
  "pno"                     CHAR(15)          DEFAULT NULL,
  "vfdate"                  CHAR(20)          DEFAULT NULL,
  "vtadate"                 CHAR(20)          DEFAULT NULL,
  "dep"                     CHAR(100)         DEFAULT NULL,
  "category"                CHAR(20)          DEFAULT NULL,
  "cat_fdate"               CHAR(20)          DEFAULT NULL,
  "cat_tdate"               CHAR(20)          DEFAULT NULL,
  "pay_scale"               CHAR(20)          DEFAULT NULL,
  "spouse_name"             CHAR(20)          DEFAULT NULL,
  "dept_name"               CHAR(100)         DEFAULT NULL,
  "dept_dob"                CHAR(20)          DEFAULT NULL,
  "dept_rel"                CHAR(20)          DEFAULT NULL,
  "dept_occu"               CHAR(20)          DEFAULT NULL,
  "dept_anualinc"           REAL             DEFAULT NULL,
  "issue_place"             CHAR(100)         DEFAULT NULL,
  "mobileno"                VARCHAR(20)       DEFAULT NULL,
  "consolidated"            CHAR(20)          DEFAULT NULL,
  "col_id"                  INT               DEFAULT NULL,
  PRIMARY KEY ("archive_id")
);

--
-- Dumping data for table "archive"
--

INSERT INTO "archive" ("f_name", "s_name", "i_name", "qual", "cert", "subj", "exp_cur", "exp_prev", "sp_assoc", "xtra", "father", "doa", "bg", "ms", "addr_perm", "ct_perm", "pin_perm", "st_perm", "ph_perm", "addr_pres", "ct_pres", "pin_pres", "st_pres", "ph_pres", "email", "id", "slno", "group_id", "type_id", "offeredsal", "basicsal", "j_date", "cmts", "status_id", "dob", "other_facilities", "other_responsibilities", "prev_post", "prev_work_place", "prev_work_city", "prev_work_country", "last_date_of_work", "staff_status_id", "date_of_updation", "expirydate", "gender", "releive_date", "recruitment_procedure", "pfscheme", "active", "bank_ac_no", "pf_ac_no", "panno", "csal", "sop", "cat", "pno", "vfdate", "vtadate", "dep", "category", "cat_fdate", "cat_tdate", "pay_scale", "spouse_name", "dept_name", "dept_dob", "dept_rel", "dept_occu", "dept_anualinc", "issue_place", "mobileno", "consolidated", "col_id") VALUES
('Faculty', 'One', NULL, '', '', 1, NULL, NULL, '', NULL, NULL, NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 17, 'RD-S0001', NULL, 2, 0, 1000, NULL, '', 1, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, 0, '2026-01-07', NULL, NULL, NULL, 'YES', 'YES', 'YES', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('Puja', 'R Srivastava', NULL, '', '', 2, NULL, NULL, '', NULL, NULL, NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, 'RD-S0001', NULL, 2, 0, 1000, NULL, '', 1, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, 0, '2026-03-06', NULL, NULL, NULL, 'YES', 'YES', 'YES', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('Soumendra', 'J', NULL, '', '', 2, NULL, NULL, '', NULL, NULL, NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 19, 'RD-S0003', NULL, 5, 0, 1000, NULL, '', -1, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, 0, '2026-06-28', NULL, NULL, NULL, 'YES', 'YES', 'YES', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('Matthew', 'Sipple', NULL, '', '', 18, NULL, NULL, '', NULL, NULL, NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 182, 'RD-S0001', NULL, 70, 0, 1000, NULL, '', 1, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, 0, '2026-07-23', NULL, NULL, NULL, 'YES', 'YES', 'YES', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('Curtis', 'Davis', NULL, '', '', 18, NULL, NULL, '', NULL, NULL, NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 183, 'RD-S0002', NULL, 30, 0, 1000, NULL, '', 1, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, 0, '2026-07-25', NULL, NULL, NULL, 'YES', 'YES', 'YES', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('Hideaki', 'Tokunaga', NULL, '', '', 9, NULL, NULL, '', NULL, NULL, NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 184, 'RD-S0001', NULL, 27, 0, 1000, NULL, '', 1, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, 0, '2026-07-25', NULL, NULL, NULL, 'YES', 'YES', 'YES', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('Stephen', 'Curran', NULL, '', '', 18, NULL, NULL, '', NULL, NULL, NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 185, 'RD-S0003', NULL, 27, 0, 1000, NULL, '', 1, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, 0, '2026-07-26', NULL, NULL, NULL, 'YES', 'YES', 'YES', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('Vitna', 'Bailey', NULL, '', '', 5, NULL, NULL, '', NULL, NULL, NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 186, 'RD-S0001', NULL, 2, 0, 1000, NULL, '', 1, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, 0, '2026-07-27', NULL, NULL, NULL, 'YES', 'YES', 'YES', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('Manju', 'Upadhyaya', NULL, '', '', 5, NULL, NULL, '', NULL, NULL, NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 187, 'RD-S0002', NULL, 2, 0, 1000, NULL, '', 1, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, 0, '2026-07-27', NULL, NULL, NULL, 'YES', 'YES', 'YES', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('Aarti', 'Potdar', NULL, '', '', 9, NULL, NULL, '', NULL, NULL, NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 188, 'RD-S0002', NULL, 57, 0, 1000, NULL, '', 1, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, 0, '2026-07-30', NULL, NULL, NULL, 'YES', 'YES', 'YES', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('Anshu Sharma', '', NULL, '', '', 9, NULL, NULL, '', NULL, NULL, NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 189, 'RD-S0003', NULL, 60, 0, 1000, NULL, '', 1, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, 0, '2026-07-30', NULL, NULL, NULL, 'YES', 'YES', 'YES', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table "archive_student"
--

CREATE TABLE IF NOT EXISTS "archive_student" (
  "archive_student_id"                 INT                NOT NULL DEFAULT 0,
  "admission_id"       VARCHAR(20)        DEFAULT NULL,
  "admission_date"     DATE               DEFAULT NULL,
  "student_id"         VARCHAR(20)        DEFAULT NULL,
  "usn"                VARCHAR(20)        DEFAULT NULL,
  "first_name"         VARCHAR(30)        DEFAULT NULL,
  "last_name"          VARCHAR(30)        DEFAULT NULL,
  "nationality"        SMALLINT  DEFAULT NULL,
  "religion"           SMALLINT   DEFAULT NULL,
  "gender"             CHAR(1)            DEFAULT NULL,
  "caste_id"           VARCHAR(50)        DEFAULT NULL,
  "dob"                DATE               DEFAULT NULL,
  "age"                VARCHAR(10)        DEFAULT NULL,
  "per_address"        VARCHAR(250)       DEFAULT NULL,
  "per_city"           VARCHAR(100)       DEFAULT NULL,
  "per_state"          VARCHAR(50)        DEFAULT NULL,
  "per_country"        VARCHAR(50)        DEFAULT NULL,
  "per_pincode"        VARCHAR(7)         DEFAULT NULL,
  "per_phone"          VARCHAR(20)        DEFAULT NULL,
  "cor_address"        VARCHAR(250)       DEFAULT NULL,
  "cor_city"           VARCHAR(100)       DEFAULT NULL,
  "cor_state"          VARCHAR(50)        DEFAULT NULL,
  "cor_country"        VARCHAR(50)        DEFAULT NULL,
  "cor_pincode"        VARCHAR(7)         DEFAULT NULL,
  "cor_phone"          VARCHAR(20)        DEFAULT NULL,
  "parent_name"        VARCHAR(60)        DEFAULT NULL,
  "parent_occupation"  VARCHAR(30)        DEFAULT NULL,
  "parent_income"      NUMERIC(12,2)        DEFAULT NULL,
  "loc_address"        VARCHAR(250)       DEFAULT NULL,
  "loc_city"           VARCHAR(100)       DEFAULT NULL,
  "loc_state"          VARCHAR(50)        DEFAULT NULL,
  "loc_country"        VARCHAR(50)        DEFAULT NULL,
  "loc_pincode"        VARCHAR(7)         DEFAULT NULL,
  "loc_phone"          VARCHAR(20)        DEFAULT NULL,
  "course_admitted"    INT                DEFAULT NULL,
  "course_yearsem"     INT                DEFAULT NULL,
  "quota_id"           INT                DEFAULT NULL,
  "academic_year"      VARCHAR(12)        DEFAULT NULL,
  "remarks"            VARCHAR(250)       DEFAULT NULL,
  "username"           VARCHAR(15)        DEFAULT NULL,
  "password"           VARCHAR(255)       DEFAULT NULL,
  "archive"            VARCHAR(50)  DEFAULT 'N',
  "class_section_id"   SMALLINT         NOT NULL DEFAULT 0,
  "parent_username"    VARCHAR(15)        DEFAULT NULL,
  "password_hash"    VARCHAR(255)       DEFAULT NULL,
  "count"              INT                DEFAULT NULL,
  "blood_group"        VARCHAR(20)        DEFAULT NULL,
  "admission_type"     VARCHAR(10)        DEFAULT NULL,
  "img_source"         VARCHAR(255)       DEFAULT NULL,
  "img_source_s"       VARCHAR(255)       DEFAULT NULL,
  "marital_status"     VARCHAR(2)         NOT NULL,
  "mentor"             VARCHAR(15)        DEFAULT '',
  "m_email"            VARCHAR(20)        DEFAULT NULL,
  "mnum"               INT                DEFAULT NULL,
  "g_name"             VARCHAR(15)        DEFAULT NULL,
  "g_occ"              VARCHAR(15)        DEFAULT NULL,
  "g_in"               INT                DEFAULT NULL,
  "g_num"              INT                DEFAULT NULL,
  "g_mail"             VARCHAR(15)        DEFAULT NULL,
  "f_email"            VARCHAR(20)        DEFAULT NULL,
  "place_of_birth"     VARCHAR(30)        DEFAULT NULL,
  "f_quali"            VARCHAR(30)        DEFAULT NULL,
  "m_quali"            VARCHAR(30)        DEFAULT NULL,
  "g_quali"            VARCHAR(30)        DEFAULT NULL,
  "lang_id"            VARCHAR(200)       DEFAULT NULL,
  "State"              VARCHAR(20)        DEFAULT 'Karnataka',
  "sms_mobile"         VARCHAR(15)        DEFAULT NULL,
  "mother_tongue"      SMALLINT   DEFAULT NULL,
  "birth_disct"        VARCHAR(100)       DEFAULT NULL,
  "stud_type"          VARCHAR(10)        DEFAULT NULL,
  "vdate"              DATE               DEFAULT NULL,
  "m_name"             VARCHAR(200)       DEFAULT NULL,
  "m_occ"              VARCHAR(200)       DEFAULT NULL,
  "m_inc"              VARCHAR(15)        DEFAULT NULL,
  "foadd"              VARCHAR(255)       DEFAULT NULL,
  "moadd"              VARCHAR(255)       DEFAULT NULL,
  "goadd"              VARCHAR(255)       DEFAULT NULL,
  "adm_yr"             SMALLINT  DEFAULT NULL,
  "tcid"               INT                NOT NULL DEFAULT 0,
  "tcdate"             DATE               NOT NULL,
  "msgphone"           INT                NOT NULL,
  "rgmailid"           VARCHAR(45)        NOT NULL,
  PRIMARY KEY ("archive_student_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "assetstatusmaster"
--

CREATE TABLE IF NOT EXISTS "assetstatusmaster" (
  "assetstatusmaster_id"          SERIAL,
  "conditions"  VARCHAR(250)  DEFAULT NULL,
  PRIMARY KEY ("assetstatusmaster_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "asset_group"
--

CREATE TABLE IF NOT EXISTS "asset_group" (
  "asset_group_id"                 SERIAL,
  "assetgroupname"     VARCHAR(200)  DEFAULT NULL,
  "depreciation_rate"  NUMERIC(10,2)   DEFAULT NULL,
  "ledger_id"          VARCHAR(10)   DEFAULT NULL,
  "abbrevation"        VARCHAR(15)   DEFAULT NULL,
  PRIMARY KEY ("asset_group_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "asset_master"
--

CREATE TABLE IF NOT EXISTS "asset_master" (
  "asset_master_id"                 SERIAL,
  "asset_name"         VARCHAR(100)  DEFAULT NULL,
  "asset_description"  TEXT,
  "asset_group_id"     INT           DEFAULT NULL,
  PRIMARY KEY ("asset_master_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "asset_master_counter"
--

CREATE TABLE IF NOT EXISTS "asset_master_counter" (
  "asset_master_counter_id"        SERIAL,
  "asset_id"  INT  DEFAULT NULL,
  "counter"   INT  DEFAULT NULL,
  PRIMARY KEY ("asset_master_counter_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "asset_sub_group"
--

CREATE TABLE IF NOT EXISTS "asset_sub_group" (
  "asset_sub_group_id"                   SERIAL,
  "asset_subgroup_name"  VARCHAR(50)  DEFAULT NULL,
  "asset_group_id"       INT          DEFAULT NULL,
  "asset_code"           CHAR(3)      DEFAULT NULL,
  PRIMARY KEY ("asset_sub_group_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "attendance"
--

CREATE TABLE IF NOT EXISTS "attendance" (
  "attendance_id"        SERIAL,
  "class_id"  INT         NOT NULL,
  "type"      SMALLINT  NOT NULL,
  "acc_year"  INT         NOT NULL,
  "status"    SMALLINT  NOT NULL,
  PRIMARY KEY ("attendance_id")
);

--
-- Dumping data for table "attendance"
--

INSERT INTO "attendance" ("attendance_id", "class_id", "type", "acc_year", "status") VALUES
(1, 1, 1, 2026, 1),
(2, 2, 1, 2026, 1),
(3, 3, 1, 2026, 1),
(4, 4, 1, 2026, 1),
(5, 5, 1, 2026, 1),
(6, 6, 1, 2026, 1),
(7, 7, 1, 2026, 1),
(8, 8, 1, 2026, 1),
(9, 9, 1, 2026, 1),
(10, 15, 1, 2026, 1);

-- --------------------------------------------------------

--
-- Table structure for table "attendance_points"
--

CREATE TABLE IF NOT EXISTS "attendance_points" (
  "attendance_points_id"           SERIAL,
  "description"  VARCHAR(100)  NOT NULL,
  "short_name"   VARCHAR(3)    NOT NULL,
  "count"        INT           NOT NULL,
  "point"        INT           NOT NULL,
  "status"       SMALLINT    NOT NULL,
  "order_id"     SMALLINT    NOT NULL,
  PRIMARY KEY ("attendance_points_id")
);

--
-- Dumping data for table "attendance_points"
--

INSERT INTO "attendance_points" ("attendance_points_id", "description", "short_name", "count", "point", "status", "order_id") VALUES
(1, 'Present', 'P', 1, 1, 1, 1),
(2, 'Absent', 'A', 1, 0, 1, 0),
(3, 'Tardy', 'T', 1, 1, 1, 2),
(4, 'Tardy Excused', 'TE', 1, 1, 1, 3),
(5, 'Absent  Excused', 'AE', 1, 0, 1, 5);

-- --------------------------------------------------------

--
-- Table structure for table "attendance"
--

CREATE TABLE IF NOT EXISTS "attendance" (
  "attendance_id"                   BIGSERIAL,
  "subject_id"  INTEGER             NOT NULL,
  "username"    VARCHAR(100)        NOT NULL,
  "att_date"    DATE                NOT NULL,
  "stu_id"      BIGINT              NOT NULL,
  "sec"         SMALLINT            NOT NULL,
  "mor"         SMALLINT            NOT NULL,
  "after"       SMALLINT            NOT NULL,
  "att_desc"    VARCHAR(250)        NOT NULL,
  PRIMARY KEY ("attendance_id")
);

CREATE INDEX "ix_stu_date" ON "attendance" ("stu_id", "att_date");
CREATE INDEX "ix_date_sec" ON "attendance" ("att_date", "sec");
CREATE INDEX "ix_subj_date" ON "attendance" ("subject_id", "att_date");

-- --------------------------------------------------------

--
-- Table structure for table "att_0"
--

CREATE TABLE IF NOT EXISTS "att_0" (
  "att_0_id"          BIGSERIAL,
  "subject_id"  INTEGER  NOT NULL,
  "username"    VARCHAR(100)        NOT NULL,
  "att_date"    DATE                NOT NULL,
  "stu_id"      BIGINT              NOT NULL,
  "sec"         SMALLINT            NOT NULL,
  "mor"         SMALLINT            NOT NULL,
  "after"       SMALLINT            NOT NULL,
  "att_desc"    VARCHAR(250)        NOT NULL,
  PRIMARY KEY ("att_0_id")
);

CREATE INDEX "ix_stu_date" ON "att_0" ("stu_id", "att_date");
CREATE INDEX "ix_date_sec" ON "att_0" ("att_date", "sec");
CREATE INDEX "ix_subj_date" ON "att_0" ("subject_id", "att_date");

--
-- Dumping data for table "att_0"
--

INSERT INTO "att_0" ("att_0_id", "subject_id", "username", "att_date", "stu_id", "sec", "mor", "after", "att_desc") VALUES
(1, 427, 'scottw', '2026-09-12', 65, 1093, 0, 0, ''),
(2, 427, 'scottw', '2026-09-12', 482, 1093, 0, 0, ''),
(3, 427, 'scottw', '2026-09-12', 986, 1093, 1, 1, ''),
(4, 427, 'scottw', '2026-09-12', 735, 1093, 1, 1, ''),
(5, 435, 'andrewc', '2026-09-10', 748, 1112, 1, 1, ''),
(6, 435, 'andrewc', '2026-09-10', 2, 1112, 1, 1, ''),
(7, 435, 'andrewc', '2026-09-10', 848, 1112, 1, 1, ''),
(8, 435, 'andrewc', '2026-09-10', 187, 1112, 1, 1, ''),
(9, 435, 'andrewc', '2026-09-10', 865, 1112, 0, 0, ''),
(10, 435, 'andrewc', '2026-09-10', 528, 1112, 1, 1, '');

-- --------------------------------------------------------

--
-- Table structure for table "att_1"
--

CREATE TABLE IF NOT EXISTS "att_1" (
  "att_1_id"          BIGSERIAL,
  "subject_id"  INTEGER  NOT NULL,
  "username"    VARCHAR(100)        NOT NULL,
  "att_date"    DATE                NOT NULL,
  "stu_id"      BIGINT              NOT NULL,
  "sec"         SMALLINT   NOT NULL,
  "mor"         SMALLINT          NOT NULL,
  "after"       SMALLINT          NOT NULL,
  "att_desc"    VARCHAR(250)        NOT NULL,
  PRIMARY KEY ("att_1_id")
);

CREATE INDEX "ix_stu_date" ON "att_1" ("stu_id", "att_date");
CREATE INDEX "ix_date_sec" ON "att_1" ("att_date", "sec");
CREATE INDEX "ix_subj_date" ON "att_1" ("subject_id", "att_date");

--
-- Dumping data for table "att_1"
--

INSERT INTO "att_1" ("att_1_id", "subject_id", "username", "att_date", "stu_id", "sec", "mor", "after", "att_desc") VALUES
(1, 0, 'RFID', '2026-02-18', 619, 1, 1, 0, ' 08:49:01,  08:49:04'),
(2, 0, 'RFID', '2026-02-18', 630, 1, 1, 0, ' 08:50:44,  08:50:48'),
(3, 0, 'RFID', '2026-02-18', 603, 1, 1, 0, ' 08:54:06'),
(4, 0, 'RFID', '2026-02-18', 599, 1, 1, 0, ' 08:54:11'),
(5, 0, 'RFID', '2026-02-18', 600, 1, 1, 0, ' 08:54:24'),
(6, 0, 'RFID', '2026-02-18', 650, 1, 1, 0, ' 09:03:22'),
(7, 0, 'RFID', '2026-02-18', 648, 1, 1, 0, ' 09:04:49'),
(8, 0, 'RFID', '2026-02-18', 647, 1, 1, 0, ' 09:04:52'),
(9, 0, 'RFID', '2026-02-18', 631, 1, 1, 0, ' 09:05:05'),
(10, 0, 'RFID', '2026-02-18', 602, 1, 1, 0, ' 09:05:25');

-- --------------------------------------------------------

--
-- Table structure for table "att_1_1"
--

CREATE TABLE IF NOT EXISTS "att_1_1" (
  "att_1_1_id"        BIGSERIAL,
  "att_date"  DATE               NOT NULL,
  "stu_id"    BIGINT             NOT NULL,
  "sec"       SMALLINT  NOT NULL,
  "mor"       SMALLINT         NOT NULL,
  "after"     SMALLINT         NOT NULL,
  PRIMARY KEY ("att_1_1_id")
);

CREATE INDEX "ix_stu_date" ON "att_1_1" ("stu_id", "att_date");
CREATE INDEX "ix_date_sec" ON "att_1_1" ("att_date", "sec");

-- --------------------------------------------------------

--
-- Table structure for table "att_2"
--

CREATE TABLE IF NOT EXISTS "att_2" (
  "att_2_id"          BIGSERIAL,
  "subject_id"  INTEGER  NOT NULL,
  "username"    VARCHAR(100)        NOT NULL,
  "att_date"    DATE                NOT NULL,
  "stu_id"      BIGINT              NOT NULL,
  "sec"         SMALLINT   NOT NULL,
  "mor"         SMALLINT          NOT NULL,
  "after"       SMALLINT          NOT NULL,
  "att_desc"    VARCHAR(250)        NOT NULL,
  PRIMARY KEY ("att_2_id")
);

CREATE INDEX "ix_stu_date" ON "att_2" ("stu_id", "att_date");
CREATE INDEX "ix_date_sec" ON "att_2" ("att_date", "sec");
CREATE INDEX "ix_subj_date" ON "att_2" ("subject_id", "att_date");

--
-- Dumping data for table "att_2"
--

INSERT INTO "att_2" ("att_2_id", "subject_id", "username", "att_date", "stu_id", "sec", "mor", "after", "att_desc") VALUES
(1, 0, 'RFID', '2026-02-18', 538, 1, 1, 0, ' 08:01:24'),
(2, 0, 'RFID', '2026-02-18', 773, 1, 1, 0, ' 08:01:05'),
(3, 0, 'RFID', '2026-02-18', 22, 1, 1, 0, ' 08:01:40,  08:01:42,  12:22:50,  12:22:51'),
(4, 0, 'RFID', '2026-02-18', 24, 1, 1, 0, ' 08:02:52'),
(5, 0, 'RFID', '2026-02-18', 756, 1, 1, 0, ' 08:03:34,  08:08:52'),
(6, 0, 'RFID', '2026-02-18', 768, 1, 1, 0, ' 08:03:05'),
(7, 0, 'RFID', '2026-02-18', 25, 1, 1, 0, ' 12:15:23'),
(8, 0, 'RFID', '2026-02-18', 740, 1, 1, 0, ' 12:24:48'),
(9, 0, 'RFID', '2026-02-18', 770, 1, 1, 0, ' 12:24:46'),
(10, 0, 'RFID', '2026-02-19', 592, 1, 1, 0, ' 07:38:19');

-- --------------------------------------------------------

--
-- Table structure for table "att_2_2"
--

CREATE TABLE IF NOT EXISTS "att_2_2" (
  "att_2_2_id"        BIGSERIAL,
  "att_date"  DATE               NOT NULL,
  "stu_id"    BIGINT             NOT NULL,
  "sec"       SMALLINT  NOT NULL,
  "mor"       SMALLINT         NOT NULL,
  "after"     SMALLINT         NOT NULL,
  PRIMARY KEY ("att_2_2_id")
);

CREATE INDEX "ix_stu_date" ON "att_2_2" ("stu_id", "att_date");
CREATE INDEX "ix_date_sec" ON "att_2_2" ("att_date", "sec");

-- --------------------------------------------------------

--
-- Table structure for table "att_2_3"
--

CREATE TABLE IF NOT EXISTS "att_2_3" (
  "att_2_3_id"        BIGSERIAL,
  "att_date"  DATE               NOT NULL,
  "stu_id"    BIGINT             NOT NULL,
  "sec"       SMALLINT  NOT NULL,
  "mor"       SMALLINT         NOT NULL,
  "after"     SMALLINT         NOT NULL,
  PRIMARY KEY ("att_2_3_id")
);

CREATE INDEX "ix_stu_date" ON "att_2_3" ("stu_id", "att_date");
CREATE INDEX "ix_date_sec" ON "att_2_3" ("att_date", "sec");

-- --------------------------------------------------------

--
-- Table structure for table "att_2_4"
--

CREATE TABLE IF NOT EXISTS "att_2_4" (
  "att_2_4_id"        BIGSERIAL,
  "att_date"  DATE               NOT NULL,
  "stu_id"    BIGINT             NOT NULL,
  "sec"       SMALLINT  NOT NULL,
  "mor"       SMALLINT         NOT NULL,
  "after"     SMALLINT         NOT NULL,
  PRIMARY KEY ("att_2_4_id")
);

CREATE INDEX "ix_stu_date" ON "att_2_4" ("stu_id", "att_date");
CREATE INDEX "ix_date_sec" ON "att_2_4" ("att_date", "sec");

-- --------------------------------------------------------

--
-- Table structure for table "att_2_5"
--

CREATE TABLE IF NOT EXISTS "att_2_5" (
  "att_2_5_id"        BIGSERIAL,
  "att_date"  DATE               NOT NULL,
  "stu_id"    BIGINT             NOT NULL,
  "sec"       SMALLINT  NOT NULL,
  "mor"       SMALLINT         NOT NULL,
  "after"     SMALLINT         NOT NULL,
  PRIMARY KEY ("att_2_5_id")
);

CREATE INDEX "ix_stu_date" ON "att_2_5" ("stu_id", "att_date");
CREATE INDEX "ix_date_sec" ON "att_2_5" ("att_date", "sec");

-- --------------------------------------------------------

--
-- Table structure for table "att_2_6"
--

CREATE TABLE IF NOT EXISTS "att_2_6" (
  "att_2_6_id"        BIGSERIAL,
  "att_date"  DATE               NOT NULL,
  "stu_id"    BIGINT             NOT NULL,
  "sec"       SMALLINT  NOT NULL,
  "mor"       SMALLINT         NOT NULL,
  "after"     SMALLINT         NOT NULL,
  PRIMARY KEY ("att_2_6_id")
);

CREATE INDEX "ix_stu_date" ON "att_2_6" ("stu_id", "att_date");
CREATE INDEX "ix_date_sec" ON "att_2_6" ("att_date", "sec");

-- --------------------------------------------------------

--
-- Table structure for table "att_2_7"
--

CREATE TABLE IF NOT EXISTS "att_2_7" (
  "att_2_7_id"        BIGSERIAL,
  "att_date"  DATE               NOT NULL,
  "stu_id"    BIGINT             NOT NULL,
  "sec"       SMALLINT  NOT NULL,
  "mor"       SMALLINT         NOT NULL,
  "after"     SMALLINT         NOT NULL,
  PRIMARY KEY ("att_2_7_id")
);

CREATE INDEX "ix_stu_date" ON "att_2_7" ("stu_id", "att_date");
CREATE INDEX "ix_date_sec" ON "att_2_7" ("att_date", "sec");

-- --------------------------------------------------------

--
-- Table structure for table "att_2_8"
--

CREATE TABLE IF NOT EXISTS "att_2_8" (
  "att_2_8_id"        BIGSERIAL,
  "att_date"  DATE               NOT NULL,
  "stu_id"    BIGINT             NOT NULL,
  "sec"       SMALLINT  NOT NULL,
  "mor"       SMALLINT         NOT NULL,
  "after"     SMALLINT         NOT NULL,
  PRIMARY KEY ("att_2_8_id")
);

CREATE INDEX "ix_stu_date" ON "att_2_8" ("stu_id", "att_date");
CREATE INDEX "ix_date_sec" ON "att_2_8" ("att_date", "sec");

-- --------------------------------------------------------

--
-- Table structure for table "att_2_9"
--

CREATE TABLE IF NOT EXISTS "att_2_9" (
  "att_2_9_id"        BIGSERIAL,
  "att_date"  DATE               NOT NULL,
  "stu_id"    BIGINT             NOT NULL,
  "sec"       SMALLINT  NOT NULL,
  "mor"       SMALLINT         NOT NULL,
  "after"     SMALLINT         NOT NULL,
  PRIMARY KEY ("att_2_9_id")
);

CREATE INDEX "ix_stu_date" ON "att_2_9" ("stu_id", "att_date");
CREATE INDEX "ix_date_sec" ON "att_2_9" ("att_date", "sec");

-- --------------------------------------------------------

--
-- Table structure for table "att_3"
--

CREATE TABLE IF NOT EXISTS "att_3" (
  "att_3_id"          BIGSERIAL,
  "subject_id"  INTEGER  NOT NULL,
  "username"    VARCHAR(100)        NOT NULL,
  "att_date"    DATE                NOT NULL,
  "stu_id"      BIGINT              NOT NULL,
  "sec"         SMALLINT   NOT NULL,
  "mor"         SMALLINT          NOT NULL,
  "after"       SMALLINT          NOT NULL,
  "att_desc"    VARCHAR(250)        NOT NULL,
  PRIMARY KEY ("att_3_id")
);

CREATE INDEX "ix_stu_date" ON "att_3" ("stu_id", "att_date");
CREATE INDEX "ix_date_sec" ON "att_3" ("att_date", "sec");
CREATE INDEX "ix_subj_date" ON "att_3" ("subject_id", "att_date");

--
-- Dumping data for table "att_3"
--

INSERT INTO "att_3" ("att_3_id", "subject_id", "username", "att_date", "stu_id", "sec", "mor", "after", "att_desc") VALUES
(1, 0, 'RFID', '2026-02-12', 10, 1, 1, 0, ' 17:45:21'),
(2, 0, 'RFID', '2026-02-15', 10, 1, 1, 0, ' 12:57:13'),
(3, 0, 'RFID', '2026-02-15', 1, 1, 1, 0, ' 14:58:47'),
(4, 0, 'RFID', '2026-02-18', 651, 1, 1, 0, ' 08:02:51'),
(5, 0, 'RFID', '2026-02-18', 810, 1, 1, 0, ' 08:04:43,  12:21:45'),
(6, 0, 'RFID', '2026-02-18', 664, 1, 1, 0, ' 12:20:24'),
(7, 0, 'RFID', '2026-02-18', 11, 1, 1, 0, ' 12:21:42'),
(8, 0, 'RFID', '2026-02-18', 809, 1, 1, 0, ' 12:23:47'),
(9, 0, 'RFID', '2026-02-18', 671, 1, 1, 0, ' 14:51:24'),
(10, 0, 'RFID', '2026-02-18', 464, 1, 1, 0, ' 14:54:29');

-- --------------------------------------------------------

--
-- Table structure for table "att_3_10"
--

CREATE TABLE IF NOT EXISTS "att_3_10" (
  "att_3_10_id"        BIGSERIAL,
  "att_date"  DATE               NOT NULL,
  "stu_id"    BIGINT             NOT NULL,
  "sec"       SMALLINT  NOT NULL,
  "mor"       SMALLINT         NOT NULL,
  "after"     SMALLINT         NOT NULL,
  PRIMARY KEY ("att_3_10_id")
);

CREATE INDEX "ix_stu_date" ON "att_3_10" ("stu_id", "att_date");
CREATE INDEX "ix_date_sec" ON "att_3_10" ("att_date", "sec");

-- --------------------------------------------------------

--
-- Table structure for table "att_3_11"
--

CREATE TABLE IF NOT EXISTS "att_3_11" (
  "att_3_11_id"        BIGSERIAL,
  "att_date"  DATE               NOT NULL,
  "stu_id"    BIGINT             NOT NULL,
  "sec"       SMALLINT  NOT NULL,
  "mor"       SMALLINT         NOT NULL,
  "after"     SMALLINT         NOT NULL,
  PRIMARY KEY ("att_3_11_id")
);

CREATE INDEX "ix_stu_date" ON "att_3_11" ("stu_id", "att_date");
CREATE INDEX "ix_date_sec" ON "att_3_11" ("att_date", "sec");

-- --------------------------------------------------------

--
-- Table structure for table "att_3_12"
--

CREATE TABLE IF NOT EXISTS "att_3_12" (
  "att_3_12_id"        BIGSERIAL,
  "att_date"  DATE               NOT NULL,
  "stu_id"    BIGINT             NOT NULL,
  "sec"       SMALLINT  NOT NULL,
  "mor"       SMALLINT         NOT NULL,
  "after"     SMALLINT         NOT NULL,
  PRIMARY KEY ("att_3_12_id")
);

CREATE INDEX "ix_stu_date" ON "att_3_12" ("stu_id", "att_date");
CREATE INDEX "ix_date_sec" ON "att_3_12" ("att_date", "sec");

-- --------------------------------------------------------

--
-- Table structure for table "att_4"
--

CREATE TABLE IF NOT EXISTS "att_4" (
  "att_4_id"          BIGSERIAL,
  "subject_id"  INTEGER  NOT NULL,
  "username"    VARCHAR(100)        NOT NULL,
  "att_date"    DATE                NOT NULL,
  "stu_id"      BIGINT              NOT NULL,
  "sec"         SMALLINT   NOT NULL,
  "mor"         SMALLINT          NOT NULL,
  "after"       SMALLINT          NOT NULL,
  "att_desc"    VARCHAR(250)        NOT NULL,
  PRIMARY KEY ("att_4_id")
);

CREATE INDEX "ix_stu_date" ON "att_4" ("stu_id", "att_date");
CREATE INDEX "ix_date_sec" ON "att_4" ("att_date", "sec");
CREATE INDEX "ix_subj_date" ON "att_4" ("subject_id", "att_date");

--
-- Dumping data for table "att_4"
--

INSERT INTO "att_4" ("att_4_id", "subject_id", "username", "att_date", "stu_id", "sec", "mor", "after", "att_desc") VALUES
(1, 0, 'RFID', '2026-02-15', 581, 1, 1, 0, ' 14:51:19,  14:51:23'),
(2, 0, 'RFID', '2026-02-15', 743, 1, 1, 0, ' 14:52:27,  14:52:33'),
(3, 0, 'RFID', '2026-02-15', 741, 1, 1, 0, ' 14:58:04,  14:58:10'),
(4, 0, 'RFID', '2026-02-15', 792, 1, 1, 0, ' 14:58:55,  14:59:00'),
(5, 0, 'RFID', '2026-02-18', 776, 1, 1, 0, ' 14:52:23'),
(6, 0, 'RFID', '2026-02-18', 581, 1, 1, 0, ' 14:56:13,  14:56:09'),
(7, 0, 'RFID', '2026-02-18', 743, 1, 1, 0, ' 15:00:27'),
(8, 0, 'RFID', '2026-02-18', 741, 1, 1, 0, ' 15:00:50,  15:00:57'),
(9, 0, 'RFID', '2026-02-19', 804, 1, 1, 0, ' 07:41:37'),
(10, 0, 'RFID', '2026-02-19', 46, 1, 1, 0, ' 07:44:20');

-- --------------------------------------------------------

--
-- Table structure for table "att_4_13"
--

CREATE TABLE IF NOT EXISTS "att_4_13" (
  "att_4_13_id"        BIGSERIAL,
  "att_date"  DATE               NOT NULL,
  "stu_id"    BIGINT             NOT NULL,
  "sec"       SMALLINT  NOT NULL,
  "mor"       SMALLINT         NOT NULL,
  "after"     SMALLINT         NOT NULL,
  PRIMARY KEY ("att_4_13_id")
);

CREATE INDEX "ix_stu_date" ON "att_4_13" ("stu_id", "att_date");
CREATE INDEX "ix_date_sec" ON "att_4_13" ("att_date", "sec");

-- --------------------------------------------------------

--
-- Table structure for table "att_4_14"
--

CREATE TABLE IF NOT EXISTS "att_4_14" (
  "att_4_14_id"        BIGSERIAL,
  "att_date"  DATE               NOT NULL,
  "stu_id"    BIGINT             NOT NULL,
  "sec"       SMALLINT  NOT NULL,
  "mor"       SMALLINT         NOT NULL,
  "after"     SMALLINT         NOT NULL,
  PRIMARY KEY ("att_4_14_id")
);

CREATE INDEX "ix_stu_date" ON "att_4_14" ("stu_id", "att_date");
CREATE INDEX "ix_date_sec" ON "att_4_14" ("att_date", "sec");

-- --------------------------------------------------------

--
-- Table structure for table "att_4_15"
--

CREATE TABLE IF NOT EXISTS "att_4_15" (
  "att_4_15_id"        BIGSERIAL,
  "att_date"  DATE               NOT NULL,
  "stu_id"    BIGINT             NOT NULL,
  "sec"       SMALLINT  NOT NULL,
  "mor"       SMALLINT         NOT NULL,
  "after"     SMALLINT         NOT NULL,
  PRIMARY KEY ("att_4_15_id")
);

CREATE INDEX "ix_stu_date" ON "att_4_15" ("stu_id", "att_date");
CREATE INDEX "ix_date_sec" ON "att_4_15" ("att_date", "sec");

-- --------------------------------------------------------

--
-- Table structure for table "att_4_16"
--

CREATE TABLE IF NOT EXISTS "att_4_16" (
  "att_4_16_id"        BIGSERIAL,
  "att_date"  DATE               NOT NULL,
  "stu_id"    BIGINT             NOT NULL,
  "sec"       SMALLINT  NOT NULL,
  "mor"       SMALLINT         NOT NULL,
  "after"     SMALLINT         NOT NULL,
  PRIMARY KEY ("att_4_16_id")
);

CREATE INDEX "ix_stu_date" ON "att_4_16" ("stu_id", "att_date");
CREATE INDEX "ix_date_sec" ON "att_4_16" ("att_date", "sec");

-- --------------------------------------------------------

--
-- Table structure for table "att_5"
--

CREATE TABLE IF NOT EXISTS "att_5" (
  "att_5_id"          BIGSERIAL,
  "subject_id"  INTEGER  NOT NULL,
  "username"    VARCHAR(100)        NOT NULL,
  "att_date"    DATE                NOT NULL,
  "stu_id"      BIGINT              NOT NULL,
  "sec"         SMALLINT   NOT NULL,
  "mor"         SMALLINT          NOT NULL,
  "after"       SMALLINT          NOT NULL,
  "att_desc"    VARCHAR(250)        NOT NULL,
  PRIMARY KEY ("att_5_id")
);

CREATE INDEX "ix_stu_date" ON "att_5" ("stu_id", "att_date");
CREATE INDEX "ix_date_sec" ON "att_5" ("att_date", "sec");
CREATE INDEX "ix_subj_date" ON "att_5" ("subject_id", "att_date");

--
-- Dumping data for table "att_5"
--

INSERT INTO "att_5" ("att_5_id", "subject_id", "username", "att_date", "stu_id", "sec", "mor", "after", "att_desc") VALUES
(1, 0, 'RFID', '2026-02-15', 115, 1, 1, 0, ' 11:58:17'),
(2, 0, 'RFID', '2026-02-15', 674, 1, 1, 0, ' 14:54:40'),
(3, 0, 'RFID', '2026-02-15', 104, 1, 1, 0, ' 14:55:47'),
(4, 0, 'RFID', '2026-02-15', 566, 1, 1, 0, ' 15:03:13'),
(5, 0, 'RFID', '2026-02-16', 566, 1, 1, 0, ' 11:44:26'),
(6, 0, 'RFID', '2026-02-18', 80, 1, 1, 0, ' 08:01:44'),
(7, 0, 'RFID', '2026-02-18', 112, 1, 1, 0, ' 15:06:19'),
(8, 0, 'RFID', '2026-02-18', 113, 1, 1, 0, ' 16:21:04,  16:21:12'),
(9, 0, 'RFID', '2026-02-19', 478, 1, 1, 0, ' 07:45:08'),
(10, 0, 'RFID', '2026-02-19', 566, 1, 1, 0, ' 07:46:40,  16:42:45');


-- --------------------------------------------------------

--
-- Table structure for table "att_6"
--

CREATE TABLE IF NOT EXISTS "att_6" (
  "att_6_id"          BIGSERIAL,
  "subject_id"  INTEGER  NOT NULL,
  "username"    VARCHAR(100)        NOT NULL,
  "att_date"    DATE                NOT NULL,
  "stu_id"      BIGINT              NOT NULL,
  "sec"         SMALLINT   NOT NULL,
  "mor"         SMALLINT          NOT NULL,
  "after"       SMALLINT          NOT NULL,
  "att_desc"    VARCHAR(250)        NOT NULL,
  PRIMARY KEY ("att_6_id")
);

CREATE INDEX "ix_stu_date" ON "att_6" ("stu_id", "att_date");
CREATE INDEX "ix_date_sec" ON "att_6" ("att_date", "sec");
CREATE INDEX "ix_subj_date" ON "att_6" ("subject_id", "att_date");

--
-- Dumping data for table "att_6"
--

INSERT INTO "att_6" ("att_6_id", "subject_id", "username", "att_date", "stu_id", "sec", "mor", "after", "att_desc") VALUES
(1, 0, 'RFID', '2026-02-15', 178, 1, 1, 0, ' 14:56:59'),
(2, 0, 'RFID', '2026-02-15', 742, 1, 1, 0, ' 14:58:02'),
(3, 0, 'RFID', '2026-02-15', 677, 1, 1, 0, ' 14:58:09'),
(4, 0, 'RFID', '2026-02-15', 167, 1, 1, 0, ' 15:57:11'),
(5, 0, 'RFID', '2026-02-16', 203, 1, 1, 0, ' 10:11:16,  11:44:28'),
(6, 0, 'RFID', '2026-02-18', 203, 1, 1, 0, ' 08:00:52'),
(7, 0, 'RFID', '2026-02-18', 178, 1, 1, 0, ' 14:53:14'),
(8, 0, 'RFID', '2026-02-18', 677, 1, 1, 0, ' 15:02:35,  15:02:42'),
(9, 0, 'RFID', '2026-02-18', 167, 1, 1, 0, ' 15:13:08'),
(10, 0, 'RFID', '2026-02-18', 735, 1, 1, 0, ' 16:16:28');

-- --------------------------------------------------------

--
-- Table structure for table "att_7"
--

CREATE TABLE IF NOT EXISTS "att_7" (
  "att_7_id"          BIGSERIAL,
  "subject_id"  INTEGER  NOT NULL,
  "username"    VARCHAR(100)        NOT NULL,
  "att_date"    DATE                NOT NULL,
  "stu_id"      BIGINT              NOT NULL,
  "sec"         SMALLINT   NOT NULL,
  "mor"         SMALLINT          NOT NULL,
  "after"       SMALLINT          NOT NULL,
  "att_desc"    VARCHAR(250)        NOT NULL,
  PRIMARY KEY ("att_7_id")
);

CREATE INDEX "ix_stu_date" ON "att_7" ("stu_id", "att_date");
CREATE INDEX "ix_date_sec" ON "att_7" ("att_date", "sec");
CREATE INDEX "ix_subj_date" ON "att_7" ("subject_id", "att_date");

--
-- Dumping data for table "att_7"
--

INSERT INTO "att_7" ("att_7_id", "subject_id", "username", "att_date", "stu_id", "sec", "mor", "after", "att_desc") VALUES
(1, 0, 'RFID', '2026-02-15', 147, 1, 1, 0, ' 14:52:14,  14:52:19'),
(2, 0, 'RFID', '2026-02-15', 730, 1, 1, 0, ' 14:55:23'),
(3, 0, 'RFID', '2026-02-15', 734, 1, 1, 0, ' 14:59:53'),
(4, 0, 'RFID', '2026-02-16', 216, 1, 1, 0, ' 09:05:47'),
(5, 0, 'RFID', '2026-02-16', 567, 1, 1, 0, ' 10:17:42'),
(6, 0, 'RFID', '2026-02-18', 734, 1, 1, 0, ' 15:02:41'),
(7, 0, 'RFID', '2026-02-18', 147, 1, 1, 0, ' 16:24:10'),
(8, 0, 'RFID', '2026-02-18', 216, 1, 1, 0, ' 16:25:05'),
(9, 0, 'RFID', '2026-02-18', 567, 1, 1, 0, ' 17:46:13,  17:46:19'),
(10, 0, 'RFID', '2026-02-19', 734, 1, 1, 0, ' 07:18:36,  16:16:50');

-- --------------------------------------------------------

--
-- Table structure for table "att_8"
--

CREATE TABLE IF NOT EXISTS "att_8" (
  "att_8_id"          BIGSERIAL,
  "subject_id"  INTEGER  NOT NULL,
  "username"    VARCHAR(100)        NOT NULL,
  "att_date"    DATE                NOT NULL,
  "stu_id"      BIGINT              NOT NULL,
  "sec"         SMALLINT   NOT NULL,
  "mor"         SMALLINT          NOT NULL,
  "after"       SMALLINT          NOT NULL,
  "att_desc"    VARCHAR(250)        NOT NULL,
  PRIMARY KEY ("att_8_id")
);

CREATE INDEX "ix_stu_date" ON "att_8" ("stu_id", "att_date");
CREATE INDEX "ix_date_sec" ON "att_8" ("att_date", "sec");
CREATE INDEX "ix_subj_date" ON "att_8" ("subject_id", "att_date");

--
-- Dumping data for table "att_8"
--

INSERT INTO "att_8" ("att_8_id", "subject_id", "username", "att_date", "stu_id", "sec", "mor", "after", "att_desc") VALUES
(1, 0, 'RFID', '2026-02-15', 774, 1, 1, 0, ' 14:54:23,  14:56:06'),
(2, 0, 'RFID', '2026-02-15', 687, 1, 1, 0, ' 14:54:57'),
(3, 0, 'RFID', '2026-02-15', 241, 1, 1, 0, ' 16:18:11,  16:18:18'),
(4, 0, 'RFID', '2026-02-15', 683, 1, 1, 0, ' 16:20:50'),
(5, 0, 'RFID', '2026-02-18', 253, 1, 1, 0, ' 14:54:31,  14:59:19'),
(6, 0, 'RFID', '2026-02-18', 683, 1, 1, 0, ' 15:03:19'),
(7, 0, 'RFID', '2026-02-18', 774, 1, 1, 0, ' 15:06:15'),
(8, 0, 'RFID', '2026-02-19', 556, 1, 1, 0, ' 07:27:40'),
(9, 0, 'RFID', '2026-02-19', 615, 1, 1, 0, ' 07:31:41'),
(10, 0, 'RFID', '2026-02-19', 686, 1, 1, 0, ' 07:32:30');

-- --------------------------------------------------------

--
-- Table structure for table "att_9"
--

CREATE TABLE IF NOT EXISTS "att_9" (
  "att_9_id"          BIGSERIAL,
  "subject_id"  INTEGER  NOT NULL,
  "username"    VARCHAR(100)        NOT NULL,
  "att_date"    DATE                NOT NULL,
  "stu_id"      BIGINT              NOT NULL,
  "sec"         SMALLINT   NOT NULL,
  "mor"         SMALLINT          NOT NULL,
  "after"       SMALLINT          NOT NULL,
  "att_desc"    VARCHAR(250)        NOT NULL,
  PRIMARY KEY ("att_9_id")
);

CREATE INDEX "ix_stu_date" ON "att_9" ("stu_id", "att_date");
CREATE INDEX "ix_date_sec" ON "att_9" ("att_date", "sec");
CREATE INDEX "ix_subj_date" ON "att_9" ("subject_id", "att_date");

--
-- Dumping data for table "att_9"
--

INSERT INTO "att_9" ("att_9_id", "subject_id", "username", "att_date", "stu_id", "sec", "mor", "after", "att_desc") VALUES
(1, 0, 'RFID', '2026-02-15', 410, 1, 1, 0, ' 15:00:37'),
(2, 0, 'RFID', '2026-02-15', 232, 1, 1, 0, ' 15:00:39'),
(3, 0, 'RFID', '2026-02-15', 274, 1, 1, 0, ' 15:18:44'),
(4, 0, 'RFID', '2026-02-15', 221, 1, 1, 0, ' 16:19:51,  16:19:58'),
(5, 0, 'RFID', '2026-02-18', 410, 1, 1, 0, ' 15:01:05'),
(6, 0, 'RFID', '2026-02-18', 232, 1, 1, 0, ' 15:01:13'),
(7, 0, 'RFID', '2026-02-18', 281, 1, 1, 0, ' 16:15:43'),
(8, 0, 'RFID', '2026-02-18', 221, 1, 1, 0, ' 16:18:23'),
(9, 0, 'RFID', '2026-02-19', 512, 1, 1, 0, ' 07:18:23'),
(10, 0, 'RFID', '2026-02-19', 824, 1, 1, 0, ' 07:25:35');

-- --------------------------------------------------------

--
-- Table structure for table "att_10"
--

CREATE TABLE IF NOT EXISTS "att_10" (
  "att_10_id"          BIGSERIAL,
  "subject_id"  INTEGER  NOT NULL,
  "username"    VARCHAR(100)        NOT NULL,
  "att_date"    DATE                NOT NULL,
  "stu_id"      BIGINT              NOT NULL,
  "sec"         SMALLINT   NOT NULL,
  "mor"         SMALLINT          NOT NULL,
  "after"       SMALLINT          NOT NULL,
  "att_desc"    VARCHAR(250)        NOT NULL,
  PRIMARY KEY ("att_10_id")
);

CREATE INDEX "ix_stu_date" ON "att_10" ("stu_id", "att_date");
CREATE INDEX "ix_date_sec" ON "att_10" ("att_date", "sec");
CREATE INDEX "ix_subj_date" ON "att_10" ("subject_id", "att_date");

-- --------------------------------------------------------

--
-- Table structure for table "att_11"
--

CREATE TABLE IF NOT EXISTS "att_11" (
  "att_11_id"          BIGSERIAL,
  "subject_id"  INTEGER  NOT NULL,
  "username"    VARCHAR(100)        NOT NULL,
  "att_date"    DATE                NOT NULL,
  "stu_id"      BIGINT              NOT NULL,
  "sec"         SMALLINT   NOT NULL,
  "mor"         SMALLINT          NOT NULL,
  "after"       SMALLINT          NOT NULL,
  "att_desc"    VARCHAR(250)        NOT NULL,
  PRIMARY KEY ("att_11_id")
);

CREATE INDEX "ix_stu_date" ON "att_11" ("stu_id", "att_date");
CREATE INDEX "ix_date_sec" ON "att_11" ("att_date", "sec");
CREATE INDEX "ix_subj_date" ON "att_11" ("subject_id", "att_date");

-- --------------------------------------------------------

--
-- Table structure for table "att_12"
--

CREATE TABLE IF NOT EXISTS "att_12" (
  "att_12_id"          BIGSERIAL,
  "subject_id"  INTEGER  NOT NULL,
  "username"    VARCHAR(100)        NOT NULL,
  "att_date"    DATE                NOT NULL,
  "stu_id"      BIGINT              NOT NULL,
  "sec"         SMALLINT   NOT NULL,
  "mor"         SMALLINT          NOT NULL,
  "after"       SMALLINT          NOT NULL,
  "att_desc"    VARCHAR(250)        NOT NULL,
  PRIMARY KEY ("att_12_id")
);

CREATE INDEX "ix_stu_date" ON "att_12" ("stu_id", "att_date");
CREATE INDEX "ix_date_sec" ON "att_12" ("att_date", "sec");
CREATE INDEX "ix_subj_date" ON "att_12" ("subject_id", "att_date");

-- --------------------------------------------------------

--
-- Table structure for table "att_13"
--

CREATE TABLE IF NOT EXISTS "att_13" (
  "att_13_id"          BIGSERIAL,
  "subject_id"  INTEGER  NOT NULL,
  "username"    VARCHAR(100)        NOT NULL,
  "att_date"    DATE                NOT NULL,
  "stu_id"      BIGINT              NOT NULL,
  "sec"         SMALLINT   NOT NULL,
  "mor"         SMALLINT          NOT NULL,
  "after"       SMALLINT          NOT NULL,
  "att_desc"    VARCHAR(250)        NOT NULL,
  PRIMARY KEY ("att_13_id")
);

CREATE INDEX "ix_stu_date" ON "att_13" ("stu_id", "att_date");
CREATE INDEX "ix_date_sec" ON "att_13" ("att_date", "sec");
CREATE INDEX "ix_subj_date" ON "att_13" ("subject_id", "att_date");

-- --------------------------------------------------------

--
-- Table structure for table "att_14"
--

CREATE TABLE IF NOT EXISTS "att_14" (
  "att_14_id"          BIGSERIAL,
  "subject_id"  INTEGER  NOT NULL,
  "username"    VARCHAR(100)        NOT NULL,
  "att_date"    DATE                NOT NULL,
  "stu_id"      BIGINT              NOT NULL,
  "sec"         SMALLINT   NOT NULL,
  "mor"         SMALLINT          NOT NULL,
  "after"       SMALLINT          NOT NULL,
  "att_desc"    VARCHAR(250)        NOT NULL,
  PRIMARY KEY ("att_14_id")
);

CREATE INDEX "ix_stu_date" ON "att_14" ("stu_id", "att_date");
CREATE INDEX "ix_date_sec" ON "att_14" ("att_date", "sec");
CREATE INDEX "ix_subj_date" ON "att_14" ("subject_id", "att_date");

--
-- Dumping data for table "att_14"
--

INSERT INTO "att_14" ("att_14_id", "subject_id", "username", "att_date", "stu_id", "sec", "mor", "after", "att_desc") VALUES
(1, 0, 'RFID', '2026-02-12', 557, 1, 1, 0, ' 15:19:01'),
(2, 0, 'RFID', '2026-02-15', 427, 1, 1, 0, ' 15:03:49'),
(3, 0, 'RFID', '2026-02-15', 443, 1, 1, 0, ' 15:07:12'),
(4, 0, 'RFID', '2026-02-15', 559, 1, 1, 0, ' 15:07:56'),
(5, 0, 'RFID', '2026-02-15', 429, 1, 1, 0, ' 15:11:06'),
(6, 0, 'RFID', '2026-02-15', 440, 1, 1, 0, ' 15:14:01'),
(7, 0, 'RFID', '2026-02-18', 437, 1, 1, 0, ' 15:02:45'),
(8, 0, 'RFID', '2026-02-18', 442, 1, 1, 0, ' 15:03:36'),
(9, 0, 'RFID', '2026-02-18', 438, 1, 1, 0, ' 15:08:05'),
(10, 0, 'RFID', '2026-02-18', 429, 1, 1, 0, ' 15:13:59');

-- --------------------------------------------------------

--
-- Table structure for table "att_15"
--

CREATE TABLE IF NOT EXISTS "att_15" (
  "att_15_id"          BIGSERIAL,
  "subject_id"  INTEGER  NOT NULL,
  "username"    VARCHAR(100)        NOT NULL,
  "att_date"    DATE                NOT NULL,
  "stu_id"      BIGINT              NOT NULL,
  "sec"         SMALLINT   NOT NULL,
  "mor"         SMALLINT          NOT NULL,
  "after"       SMALLINT          NOT NULL,
  "att_desc"    VARCHAR(250)        NOT NULL,
  PRIMARY KEY ("att_15_id")
);

CREATE INDEX "ix_stu_date" ON "att_15" ("stu_id", "att_date");
CREATE INDEX "ix_date_sec" ON "att_15" ("att_date", "sec");
CREATE INDEX "ix_subj_date" ON "att_15" ("subject_id", "att_date");

--
-- Dumping data for table "att_15"
--

INSERT INTO "att_15" ("att_15_id", "subject_id", "username", "att_date", "stu_id", "sec", "mor", "after", "att_desc") VALUES
(1, 0, 'RFID', '2026-02-18', 698, 1, 1, 0, ' 15:04:44'),
(2, 0, 'RFID', '2026-02-18', 720, 1, 1, 0, ' 15:08:37'),
(3, 0, 'RFID', '2026-02-18', 697, 1, 1, 0, ' 16:14:09'),
(4, 0, 'RFID', '2026-02-19', 830, 1, 1, 0, ' 07:30:52'),
(5, 0, 'RFID', '2026-02-19', 698, 1, 1, 0, ' 07:34:54,  16:21:37'),
(6, 0, 'RFID', '2026-02-19', 355, 1, 1, 0, ' 07:35:00'),
(7, 0, 'RFID', '2026-02-19', 357, 1, 1, 0, ' 07:42:14'),
(8, 0, 'RFID', '2026-02-19', 715, 1, 1, 0, ' 07:42:30'),
(9, 0, 'RFID', '2026-02-19', 720, 1, 1, 0, ' 07:44:24'),
(10, 0, 'RFID', '2026-02-19', 697, 1, 1, 0, ' 07:45:27,  16:21:36');

-- --------------------------------------------------------

--
-- Table structure for table "att_16"
--

CREATE TABLE IF NOT EXISTS "att_16" (
  "att_16_id"          BIGSERIAL,
  "subject_id"  INTEGER  NOT NULL,
  "username"    VARCHAR(100)        NOT NULL,
  "att_date"    DATE                NOT NULL,
  "stu_id"      BIGINT              NOT NULL,
  "sec"         SMALLINT   NOT NULL,
  "mor"         SMALLINT          NOT NULL,
  "after"       SMALLINT          NOT NULL,
  "att_desc"    VARCHAR(250)        NOT NULL,
  PRIMARY KEY ("att_16_id")
);

CREATE INDEX "ix_stu_date" ON "att_16" ("stu_id", "att_date");
CREATE INDEX "ix_date_sec" ON "att_16" ("att_date", "sec");
CREATE INDEX "ix_subj_date" ON "att_16" ("subject_id", "att_date");

--
-- Dumping data for table "att_16"
--

INSERT INTO "att_16" ("att_16_id", "subject_id", "username", "att_date", "stu_id", "sec", "mor", "after", "att_desc") VALUES
(1, 0, 'RFID', '2026-02-15', 508, 1, 1, 0, ' 14:45:13'),
(2, 0, 'RFID', '2026-02-15', 375, 1, 1, 0, ' 15:03:12'),
(3, 0, 'RFID', '2026-02-15', 364, 1, 1, 0, ' 15:17:53'),
(4, 0, 'RFID', '2026-02-15', 376, 1, 1, 0, ' 15:26:14'),
(5, 0, 'RFID', '2026-02-18', 508, 1, 1, 0, ' 14:50:31'),
(6, 0, 'RFID', '2026-02-18', 375, 1, 1, 0, ' 15:06:21'),
(7, 0, 'RFID', '2026-02-18', 376, 1, 1, 0, ' 15:30:30'),
(8, 0, 'RFID', '2026-02-19', 363, 1, 1, 0, ' 07:35:14'),
(9, 0, 'RFID', '2026-02-19', 365, 1, 1, 0, ' 07:35:16'),
(10, 0, 'RFID', '2026-02-19', 375, 1, 1, 0, ' 07:38:40,  15:05:49');

-- --------------------------------------------------------

--
-- Table structure for table "bank_details"
--

CREATE TABLE IF NOT EXISTS "bank_details" (
  "bank_details_id"            SERIAL,
  "bank_name"     VARCHAR(60)  DEFAULT NULL,
  "bank_st_name"  VARCHAR(25)  DEFAULT NULL,
  "bank_address"  TEXT,
  "telephone"     INT          DEFAULT NULL,
  "acc_no"        VARCHAR(20)  DEFAULT NULL,
  "acc_type"      VARCHAR(20)  DEFAULT NULL,
  "ledger_id"     VARCHAR(20)  DEFAULT NULL,
  "status"        SMALLINT   NOT NULL DEFAULT 1,
  PRIMARY KEY ("bank_details_id")
);

--
-- Dumping data for table "bank_details"
--

INSERT INTO "bank_details" ("bank_details_id", "bank_name", "bank_st_name", "bank_address", "telephone", "acc_no", "acc_type", "ledger_id", "status") VALUES
(1, 'State Bank of India', NULL, NULL, NULL, NULL, NULL, NULL, 1),
(3, 'Citi Bank', NULL, NULL, NULL, NULL, NULL, NULL, 1),
(4, 'Punjab National Bank', NULL, NULL, NULL, NULL, NULL, NULL, 1),
(5, 'Bank of Rajasthan', NULL, NULL, NULL, NULL, NULL, NULL, 1),
(6, 'HDFC Bank Ltd.', NULL, NULL, NULL, NULL, NULL, NULL, 1),
(7, 'Coporation Bank', NULL, NULL, NULL, NULL, NULL, NULL, 1),
(8, 'ABN Amro Barakhamba,ND', NULL, NULL, NULL, NULL, NULL, NULL, 1),
(9, 'UTI Bank Ltd.', NULL, NULL, NULL, NULL, NULL, NULL, 1),
(10, 'Canara Bank', NULL, NULL, NULL, NULL, NULL, NULL, 1),
(11, 'ICICI BANK', NULL, NULL, NULL, NULL, NULL, NULL, 1),
(12, 'IDBI Bank Limited', NULL, NULL, NULL, NULL, NULL, NULL, 1),
(13, 'Abu Dhabi Commercial Bank Ltd.', NULL, NULL, NULL, NULL, NULL, NULL, 1),
(14, 'American ExpressBank Ltd.', NULL, NULL, NULL, NULL, NULL, NULL, 1),
(15, 'Arab Bangladesh Bank Limited', NULL, NULL, NULL, NULL, NULL, NULL, 1),
(16, 'Allahabad Bank', NULL, NULL, NULL, NULL, NULL, NULL, 1),
(17, 'Andhra Bank', NULL, NULL, NULL, NULL, NULL, NULL, 1),
(18, 'Bank InternationalIndonesia', NULL, NULL, NULL, NULL, NULL, NULL, 1),
(19, 'Bank of America', NULL, NULL, NULL, NULL, NULL, NULL, 1),
(20, 'Bank of Bahrain & Kuwait BSC', NULL, NULL, NULL, NULL, NULL, NULL, 1),
(21, 'Barclays Bank Plc', NULL, NULL, NULL, NULL, NULL, NULL, 1),
(22, 'Bharat OverseasBank Ltd.', NULL, NULL, NULL, NULL, NULL, NULL, 1),
(23, 'Bank of Baroda', NULL, NULL, NULL, NULL, NULL, NULL, 1),
(24, 'Bank of India', NULL, NULL, NULL, NULL, NULL, NULL, 1),
(25, 'Bank of Maharashtra', NULL, NULL, NULL, NULL, NULL, NULL, 1),
(26, 'Central Bank ofIndia', NULL, NULL, NULL, NULL, NULL, NULL, 1),
(27, 'Dena Bank', NULL, NULL, NULL, NULL, NULL, NULL, 1),
(28, 'Kotak Mahindra Bank Limited', NULL, NULL, NULL, NULL, NULL, NULL, 1),
(29, 'Oriental Bank of Commerce', NULL, NULL, NULL, NULL, NULL, NULL, 1),
(30, 'Punjab & Sind Bank', NULL, NULL, NULL, NULL, NULL, NULL, 1),
(31, 'Standard CharteredBank', NULL, NULL, NULL, NULL, NULL, NULL, 1),
(32, 'State Bank of Mauritius Ltd.', NULL, NULL, NULL, NULL, NULL, NULL, 1),
(33, 'State Bank of Bikaner and Jaip', NULL, NULL, NULL, NULL, NULL, NULL, 1),
(34, 'State Bank of Indore', NULL, NULL, NULL, NULL, NULL, NULL, 1),
(35, 'Syndicate Bank', NULL, NULL, NULL, NULL, NULL, NULL, 1),
(36, 'Union Bank of India', NULL, NULL, NULL, NULL, NULL, NULL, 1),
(37, 'United Bank Of India', NULL, NULL, NULL, NULL, NULL, NULL, 1),
(38, 'Yes Bank', NULL, NULL, NULL, NULL, NULL, NULL, 1),
(39, 'Vijaya Bank', NULL, NULL, NULL, NULL, NULL, NULL, 1),
(40, 'Federal Bank Ltd.', NULL, NULL, NULL, NULL, NULL, NULL, 1),
(41, 'Indian Bank', NULL, NULL, NULL, NULL, NULL, NULL, 1),
(42, 'Indian Overseas Bank', NULL, NULL, NULL, NULL, NULL, NULL, 1),
(43, 'ING Vysya Bank', NULL, NULL, NULL, NULL, NULL, NULL, 1),
(44, 'Axis Bank', NULL, NULL, NULL, NULL, NULL, NULL, 1),
(45, 'THE COSMOS CO-OP BANK', NULL, NULL, NULL, NULL, NULL, NULL, 1),
(46, 'BNP Paribas', NULL, NULL, NULL, NULL, NULL, NULL, 1),
(47, 'Honkong And Shanghai Bank', NULL, NULL, NULL, NULL, NULL, NULL, 1),
(48, 'The Dhanalakshmi Bank Ltd', NULL, NULL, NULL, NULL, NULL, NULL, 1),
(49, 'Deutsche Bank', NULL, NULL, NULL, NULL, NULL, NULL, 1),
(50, 'Wachovia Bank', NULL, NULL, NULL, NULL, NULL, NULL, 1),
(51, 'ABN AMRO Bank', NULL, NULL, NULL, NULL, NULL, NULL, 1),
(52, 'Development Credit Bank Ltd', NULL, NULL, NULL, NULL, NULL, NULL, 1),
(53, 'Thane Bharat Sahakari', NULL, NULL, NULL, NULL, NULL, NULL, 1),
(54, 'Bombay Mercantile Co.Op Bank', NULL, NULL, NULL, NULL, NULL, NULL, 1),
(55, 'IndusInd Bank Ltd', NULL, NULL, NULL, NULL, NULL, NULL, 1),
(56, 'Cosmos Bank', NULL, NULL, NULL, NULL, NULL, NULL, 1),
(57, 'Abhyudaya Co-Op Bank Ltd', NULL, NULL, NULL, NULL, NULL, NULL, 1),
(58, 'UCO BANK', NULL, NULL, NULL, NULL, NULL, NULL, 1),
(59, 'THE SARASWAT CO - OP BANK', NULL, NULL, NULL, NULL, NULL, NULL, 1),
(60, 'CENTURION BANK OF PUNJAB LIMIT', NULL, NULL, NULL, NULL, NULL, NULL, 1),
(61, 'The Ratnakar Bank', NULL, NULL, NULL, NULL, NULL, NULL, 1),
(62, 'THE KAPOL CO-OP BANK', NULL, NULL, NULL, NULL, NULL, NULL, 1),
(63, 'Apna Sahakari Bank', NULL, NULL, NULL, NULL, NULL, NULL, 1),
(64, 'THE BHARAT CO-OP BANK LTD', NULL, NULL, NULL, NULL, NULL, NULL, 1),
(65, 'JP Morgan Chase Bank', NULL, NULL, NULL, NULL, NULL, NULL, 1),
(66, 'The South Indian Bank Limited', NULL, NULL, NULL, NULL, NULL, NULL, 1),
(67, 'THE KARUR VYSYA BANK LIMITED', NULL, NULL, NULL, NULL, NULL, NULL, 1),
(68, 'Saraswat Bank', NULL, NULL, NULL, NULL, NULL, NULL, 1),
(69, 'NKGSB Co-op Bank Ltd', NULL, NULL, NULL, NULL, NULL, NULL, 1),
(70, 'Dhanalakshmi Bank', NULL, NULL, NULL, NULL, NULL, NULL, 1),
(71, 'TAMILNAD MERCANTILE BANK LTD', NULL, NULL, NULL, NULL, NULL, NULL, 1),
(72, 'Mizuho Corporate Bank Ltd', NULL, NULL, NULL, NULL, NULL, NULL, 1),
(73, 'The SahebraoDeshmukh Co -bank', NULL, NULL, NULL, NULL, NULL, NULL, 1),
(74, 'Lakshmi Vilas Bank', NULL, NULL, NULL, NULL, NULL, NULL, 1),
(75, 'The North Kanara GSB BANK Ltd', NULL, NULL, NULL, NULL, NULL, NULL, 1),
(76, 'JALGAON JANATA SAH. BANK', NULL, NULL, NULL, NULL, NULL, NULL, 1),
(77, 'THE BANK OF RAJASTHAN LTD', NULL, NULL, NULL, NULL, NULL, NULL, 1),
(78, 'State Bank Of Patiala', NULL, NULL, NULL, NULL, NULL, NULL, 1),
(79, 'The Mahanagar Co- Op Bank Ltd', NULL, NULL, NULL, NULL, NULL, NULL, 1),
(80, 'KARNATAKA BANK LTD', NULL, NULL, NULL, NULL, NULL, NULL, 1),
(81, 'The Royal Bank of Scotland N V', NULL, NULL, NULL, NULL, NULL, NULL, 1),
(82, 'STATE BANK OF MYSORE', NULL, NULL, NULL, NULL, NULL, NULL, 1),
(83, 'ANTWERP DIAMOND BANK', NULL, NULL, NULL, NULL, NULL, NULL, 1),
(84, 'J & K Bank', NULL, NULL, NULL, NULL, NULL, NULL, 1),
(85, 'State Bank of Hyderabad', NULL, NULL, NULL, NULL, NULL, NULL, 1),
(86, 'UBS', NULL, NULL, NULL, NULL, NULL, NULL, 1),
(87, 'STATE BANK OF TRAVANCORE', NULL, NULL, NULL, NULL, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table "batch_master"
--

CREATE TABLE IF NOT EXISTS "batch_master" (
  "batch_master_id"          SERIAL,
  "batch_name"  VARCHAR(50)  DEFAULT NULL,
  PRIMARY KEY ("batch_master_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "calendar_meeting"
--

CREATE TABLE IF NOT EXISTS "calendar_meeting" (
  "calendar_meeting_id"                  SERIAL,
  "calendar_reason_id"  INT          DEFAULT NULL,
  "staff_id"            INT          DEFAULT NULL,
  "name"                VARCHAR(20)  DEFAULT NULL,
  "status"              SMALLINT   DEFAULT 1,
  PRIMARY KEY ("calendar_meeting_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "calendar_reason"
--

CREATE TABLE IF NOT EXISTS "calendar_reason" (
  "calendar_reason_id"      SERIAL,
  "name"    VARCHAR(20)  DEFAULT NULL,
  "status"  SMALLINT   DEFAULT 1,
  PRIMARY KEY ("calendar_reason_id")
);

--
-- Dumping data for table "calendar_reason"
--

INSERT INTO "calendar_reason" ("calendar_reason_id", "name", "status") VALUES
(1, 'Academic', 1),
(2, 'Admin Related', 1),
(3, 'Transport Related', 1),
(4, 'Cafeteria Related', 1);

-- --------------------------------------------------------

--
-- Table structure for table "calendar_schedule"
--

CREATE TABLE IF NOT EXISTS "calendar_schedule" (
  "calendar_schedule_id"                         SERIAL,
  "reason_id"                  INT          DEFAULT NULL,
  "meeting_id"                 INT          DEFAULT NULL,
  "staff_id"                   INT          DEFAULT NULL,
  "meeting_date"               DATE         DEFAULT NULL,
  "calendar_schedule_time_id"  INT          DEFAULT NULL,
  "meeting_from_time"          TIME         DEFAULT NULL,
  "meeting_to_time"            TIME         DEFAULT NULL,
  "complain"                   TEXT,
  "requested_user"             VARCHAR(50)  DEFAULT NULL,
  "requested_user_type"        INT          DEFAULT NULL,
  "response_user"              VARCHAR(50)  DEFAULT NULL,
  "response_date"              DATE         DEFAULT NULL,
  "response_time"              TIME         DEFAULT NULL,
  "inserted"                   TIMESTAMP     DEFAULT NULL,
  "meeting_status"             INT          DEFAULT NULL,
  "status"                     SMALLINT   DEFAULT 1,
  "mail_setn"                  SMALLINT   NOT NULL DEFAULT 0,
  PRIMARY KEY ("calendar_schedule_id")
);

--
-- Dumping data for table "calendar_schedule"
--

INSERT INTO "calendar_schedule" ("calendar_schedule_id", "reason_id", "meeting_id", "staff_id", "meeting_date", "calendar_schedule_time_id", "meeting_from_time", "meeting_to_time", "complain", "requested_user", "requested_user_type", "response_user", "response_date", "response_time", "inserted", "meeting_status", "status", "mail_setn") VALUES
(1, 0, 0, 95, '2026-03-07', 25389, '08:40:00', '09:20:00', '', '244', NULL, NULL, NULL, NULL, '2026-02-26 18:51:00', 1, 1, 1),
(2, 0, 0, 114, '2026-03-07', 27182, '08:00:00', '08:40:00', '', '242', NULL, NULL, NULL, NULL, '2026-02-26 18:38:57', 1, 1, 1),
(3, 0, 0, 104, '2026-03-07', 27269, '08:40:00', '09:20:00', '', '1336', NULL, NULL, NULL, NULL, '2026-02-26 18:21:52', 1, 1, 1),
(4, 0, 0, 120, '2026-03-07', 27702, '08:00:00', '08:40:00', '', '355', NULL, NULL, NULL, NULL, '2026-02-26 17:40:28', 1, 1, 1),
(5, 0, 0, 104, '2026-03-07', 27262, '08:00:00', '08:40:00', '', '579', NULL, NULL, NULL, NULL, '2026-02-26 17:22:54', 1, 1, 1),
(6, 0, 0, 109, '2026-03-07', 27784, '08:00:00', '08:40:00', '', '397', NULL, NULL, NULL, NULL, '2026-02-26 17:36:08', 1, 1, 1),
(7, 0, 0, 81, '2026-03-07', 26873, '09:40:00', '10:20:00', '', '1148', NULL, NULL, NULL, NULL, '2026-02-26 17:02:27', 1, 1, 1),
(8, 0, 0, 118, '2026-03-07', 28433, '09:40:00', '10:20:00', '', '859', NULL, NULL, NULL, NULL, '2026-02-26 17:06:09', 1, 1, 1),
(9, 0, 0, 117, '2026-03-07', 27878, '11:00:00', '11:40:00', '', '873', NULL, NULL, NULL, NULL, '2026-02-26 19:14:02', 1, 1, 1),
(10, 0, 0, 151, '2026-03-07', 26482, '12:30:00', '13:10:00', '', '871', NULL, NULL, NULL, NULL, '2026-02-26 19:15:05', 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table "calendar_schedule_bk"
--

CREATE TABLE IF NOT EXISTS "calendar_schedule_bk" (
  "calendar_schedule_bk_id"                         SERIAL,
  "reason_id"                  INT          DEFAULT NULL,
  "meeting_id"                 INT          DEFAULT NULL,
  "staff_id"                   INT          DEFAULT NULL,
  "meeting_date"               DATE         DEFAULT NULL,
  "calendar_schedule_time_id"  INT          DEFAULT NULL,
  "meeting_from_time"          TIME         DEFAULT NULL,
  "meeting_to_time"            TIME         DEFAULT NULL,
  "complain"                   TEXT,
  "requested_user"             VARCHAR(50)  DEFAULT NULL,
  "requested_user_type"        INT          DEFAULT NULL,
  "response_user"              VARCHAR(50)  DEFAULT NULL,
  "response_date"              DATE         DEFAULT NULL,
  "response_time"              TIME         DEFAULT NULL,
  "inserted"                   TIMESTAMP     DEFAULT NULL,
  "meeting_status"             INT          DEFAULT NULL,
  "status"                     SMALLINT   DEFAULT 1,
  PRIMARY KEY ("calendar_schedule_bk_id")
);

--
-- Dumping data for table "calendar_schedule_bk"
--

INSERT INTO "calendar_schedule_bk" ("calendar_schedule_bk_id", "reason_id", "meeting_id", "staff_id", "meeting_date", "calendar_schedule_time_id", "meeting_from_time", "meeting_to_time", "complain", "requested_user", "requested_user_type", "response_user", "response_date", "response_time", "inserted", "meeting_status", "status") VALUES
(1, 0, 0, 95, '2026-03-07', 25389, '08:40:00', '09:20:00', '', '244', NULL, NULL, NULL, NULL, '2026-02-26 18:51:00', 1, 1),
(2, 0, 0, 114, '2026-03-07', 27182, '08:00:00', '08:40:00', '', '242', NULL, NULL, NULL, NULL, '2026-02-26 18:38:57', 1, 1),
(3, 0, 0, 104, '2026-03-07', 27269, '08:40:00', '09:20:00', '', '1336', NULL, NULL, NULL, NULL, '2026-02-26 18:21:52', 1, 1),
(4, 0, 0, 120, '2026-03-07', 27702, '08:00:00', '08:40:00', '', '355', NULL, NULL, NULL, NULL, '2026-02-26 17:40:28', 1, 1),
(5, 0, 0, 104, '2026-03-07', 27262, '08:00:00', '08:40:00', '', '579', NULL, NULL, NULL, NULL, '2026-02-26 17:22:54', 1, 1),
(6, 0, 0, 109, '2026-03-07', 27784, '08:00:00', '08:40:00', '', '397', NULL, NULL, NULL, NULL, '2026-02-26 17:36:08', 1, 1),
(7, 0, 0, 81, '2026-03-07', 26873, '09:40:00', '10:20:00', '', '1148', NULL, NULL, NULL, NULL, '2026-02-26 17:02:27', 1, 1),
(8, 0, 0, 118, '2026-03-07', 28433, '09:40:00', '10:20:00', '', '859', NULL, NULL, NULL, NULL, '2026-02-26 17:06:09', 1, 1),
(9, 0, 0, 117, '2026-03-07', 27878, '11:00:00', '11:40:00', '', '873', NULL, NULL, NULL, NULL, '2026-02-26 19:14:02', 1, 1),
(10, 0, 0, 151, '2026-03-07', 26482, '12:30:00', '13:10:00', '', '871', NULL, NULL, NULL, NULL, '2026-02-26 19:15:05', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table "calendar_schedule_setup"
--

CREATE TABLE IF NOT EXISTS "calendar_schedule_setup" (
  "calendar_schedule_setup_id"            SERIAL,
  "name"          VARCHAR(100)  DEFAULT NULL,
  "description"   TEXT,
  "meeting_date"  DATE          DEFAULT NULL,
  "inserted"      TIMESTAMP     NULL DEFAULT CURRENT_TIMESTAMP,
  "status"        SMALLINT    DEFAULT 1,
  "staff_id"      INT           DEFAULT NULL,
  "nopd"          INT           DEFAULT NULL,
  "class_id"      INT           NOT NULL,
  PRIMARY KEY ("calendar_schedule_setup_id")
);

--
-- Dumping data for table "calendar_schedule_setup"
--

INSERT INTO "calendar_schedule_setup" ("calendar_schedule_setup_id", "name", "description", "meeting_date", "inserted", "status", "staff_id", "nopd", "class_id") VALUES
(1, 'SLC', 'Please select one time for your child''s SLC. There are 4 slots for each of the time periods, choose one. During the 40 minute time slot, you will spend time in your child''s homeroom and also see some of the specialist teachers.\r\n\r\n*Note: This is one time selections, for any change in time slot please contact to kenneth.fernandez@email.com.', '2026-03-07', '2026-02-11 09:24:48', 1, 108, 45, 97),
(2, 'SLC', 'Please select one time for your child''s SLC. There are 4 slots for each of the time periods, choose one. During the 40 minute time slot, you will spend time in your child''s homeroom and also see some of the specialist teachers.\r\n\r\n*Note: This is one time selections, for any change in time slot please contact to kenneth.fernandez@email.com.', '2026-03-07', '2026-02-05 07:50:09', 1, 159, 45, 107),
(3, 'SLC', 'Please select one time for your child''s SLC. There are 4 slots for each of the time periods, choose one. During the 40 minute time slot, you will spend time in your child''s homeroom and also see some of the specialist teachers.\r\n\r\n*Note: This is one time selections, for any change in time slot please contact to kenneth.fernandez@email.com.', '2026-03-07', '2026-02-03 05:19:51', 1, 159, 45, 107),
(4, 'SLC', 'Please select one time for your child''s SLC. There are 4 slots for each of the time periods, choose one. During the 40 minute time slot, you will spend time in your child''s homeroom and also see some of the specialist teachers.\r\n\r\n*Note: This is one time selections, for any change in time slot please contact to kenneth.fernandez@email.com.', '2026-03-07', '2026-02-11 10:30:46', 1, 77, 45, 99),
(5, 'SLC', 'Please select one time for your child''s SLC. There are 4 slots for each of the time periods, choose one. During the 40 minute time slot, you will spend time in your child''s homeroom and also see some of the specialist teachers.\r\n\r\n*Note: This is one time selections, for any change in time slot please contact to kenneth.fernandez@email.com.', '2026-03-07', '2026-02-11 10:31:35', 1, 95, 45, 100),
(6, 'SLC', 'Please select one time for your child''s SLC. There are 4 slots for each of the time periods, choose one. During the 40 minute time slot, you will spend time in your child''s homeroom and also see some of the specialist teachers.\r\n\r\n*Note: This is one time selections, for any change in time slot please contact to kenneth.fernandez@email.com.', '2026-03-07', '2026-02-11 10:31:46', 1, 80, 45, 101),
(7, 'SLC', 'Please select one time for your child''s SLC. There are 4 slots for each of the time periods, choose one. During the 40 minute time slot, you will spend time in your child''s homeroom and also see some of the specialist teachers.\r\n\r\n*Note: This is one time selections, for any change in time slot please contact to kenneth.fernandez@email.com.', '2026-03-07', '2026-02-11 10:32:05', 1, 74, 45, 102),
(8, 'SLC', 'Please select one time for your child''s SLC. There are 4 slots for each of the time periods, choose one. During the 40 minute time slot, you will spend time in your child''s homeroom and also see some of the specialist teachers.\r\n\r\n*Note: This is one time selections, for any change in time slot please contact to kenneth.fernandez@email.com.', '2026-03-07', '2026-02-11 10:33:31', 1, 71, 45, 941),
(9, 'SLC', 'Please select one time for your child''s SLC. There are 4 slots for each of the time periods, choose one. During the 40 minute time slot, you will spend time in your child''s homeroom and also see some of the specialist teachers.\r\n\r\n*Note: This is one time selections, for any change in time slot please contact to kenneth.fernandez@email.com.', '2026-03-07', '2026-02-11 10:33:45', 1, 73, 45, 103),
(10, 'SLC', 'Please select one time for your child''s SLC. There are 4 slots for each of the time periods, choose one. During the 40 minute time slot, you will spend time in your child''s homeroom and also see some of the specialist teachers.\r\n\r\n*Note: This is one time selections, for any change in time slot please contact to kenneth.fernandez@email.com.', '2026-03-07', '2026-02-11 10:33:55', 1, 158, 45, 104);

-- --------------------------------------------------------

--
-- Table structure for table "calendar_schedule_time"
--

CREATE TABLE IF NOT EXISTS "calendar_schedule_time" (
  "calendar_schedule_time_id"                          BIGSERIAL,
  "calendar_schedule_setup_id"  INT          DEFAULT NULL,
  "from_time"                   VARCHAR(10)  DEFAULT NULL,
  "to_time"                     VARCHAR(10)  DEFAULT NULL,
  "format"                      SMALLINT   DEFAULT NULL,
  "status"                      SMALLINT   DEFAULT 1,
  PRIMARY KEY ("calendar_schedule_time_id")
);

--
-- Dumping data for table "calendar_schedule_time"
--

INSERT INTO "calendar_schedule_time" ("calendar_schedule_time_id", "calendar_schedule_setup_id", "from_time", "to_time", "format", "status") VALUES
(26421, 57, '15:20', '16:00', 0, 1),
(29443, 12, '14:40', '15:20', 0, 1),
(27981, 41, '15:20', '16:00', 0, 1),
(27461, 38, '15:20', '16:00', 0, 1),
(27460, 38, '15:20', '16:00', 0, 1),
(27459, 38, '15:20', '16:00', 0, 1),
(27061, 33, '15:20', '16:00', 0, 1),
(27060, 33, '15:20', '16:00', 0, 1),
(27059, 33, '15:20', '16:00', 0, 1),
(27058, 33, '15:20', '16:00', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table "calendar_schedule_type"
--

CREATE TABLE IF NOT EXISTS "calendar_schedule_type" (
  "calendar_schedule_type_id"            SERIAL,
  "name"          VARCHAR(100)  DEFAULT NULL,
  "description"   TEXT,
  "meeting_date"  DATE          DEFAULT NULL,
  "inserted"      TIMESTAMP     NULL DEFAULT CURRENT_TIMESTAMP,
  "status"        SMALLINT    DEFAULT 1,
  PRIMARY KEY ("calendar_schedule_type_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "calendar_time"
--

CREATE TABLE IF NOT EXISTS "calendar_time" (
  "calendar_time_id"      SERIAL,
  "time"    TIME        DEFAULT NULL,
  "format"  VARCHAR(2)  DEFAULT NULL,
  "status"  SMALLINT  DEFAULT 1,
  PRIMARY KEY ("calendar_time_id")
);

--
-- Dumping data for table "calendar_time"
--

INSERT INTO "calendar_time" ("calendar_time_id", "time", "format", "status") VALUES
(1, '10:00:00', 'AM', 1),
(2, '10:15:00', 'AM', 1),
(3, '10:30:00', 'AM', 1),
(4, '10:45:00', 'AM', 1),
(5, '11:00:00', 'AM', 1),
(6, '11:15:00', 'AM', 1),
(7, '11:30:00', 'AM', 1),
(8, '11:45:00', 'AM', 1),
(9, '12:00:00', 'PM', 1),
(10, '12:15:00', 'PM', 1),
(11, '12:30:00', 'PM', 1),
(12, '12:45:00', 'PM', 1),
(13, '01:30:00', 'PM', 1),
(14, '01:45:00', 'PM', 1),
(15, '02:00:00', 'PM', 1),
(16, '02:15:00', 'PM', 1),
(17, '02:30:00', 'PM', 1),
(18, '02:45:00', 'PM', 1),
(19, '03:00:00', 'PM', 1),
(20, '03:15:00', 'PM', 1),
(21, '03:30:00', 'PM', 1),
(22, '03:45:00', 'PM', 1);

-- --------------------------------------------------------

--
-- Table structure for table "card"
--

CREATE TABLE IF NOT EXISTS "card" (
  "student_id"  VARCHAR(255)  DEFAULT NULL,
  "no_series"   VARCHAR(255)  DEFAULT NULL,
  PRIMARY KEY ("student_id")
);

--
-- Dumping data for table "card"
--

INSERT INTO "card" ("student_id", "no_series") VALUES
('A728', '000C3A43000000000000000000000000'),
('A774', '43237817000000000000000000000000'),
('A759', '64927817000000000000000000000000');

-- --------------------------------------------------------

--
-- Table structure for table "category"
--

CREATE TABLE IF NOT EXISTS "category" (
  "category_id"    SERIAL,
  "name"  VARCHAR(50)  NOT NULL DEFAULT '',
  PRIMARY KEY ("category_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "centralideacomt_pyp"
--

CREATE TABLE IF NOT EXISTS "centralideacomt_pyp" (
  "centralideacomt_pyp_id"          BIGSERIAL,
  "exam_id"     INT     NOT NULL,
  "class"       INT     NOT NULL,
  "idea_cmid"   INT     NOT NULL,
  "student_id"  INT     NOT NULL,
  "acc_year"    INT     NOT NULL,
  "idea_cm"     TEXT    NOT NULL,
  "idea_cm1"    TEXT    NOT NULL,
  "idea_cm2"    TEXT    NOT NULL,
  PRIMARY KEY ("centralideacomt_pyp_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "centralidea_pyp"
--

CREATE TABLE IF NOT EXISTS "centralidea_pyp" (
  "centralidea_pyp_id"          BIGSERIAL,
  "exam_id"     INT         NOT NULL,
  "class"       INT         NOT NULL,
  "idea_id"     INT         NOT NULL,
  "student_id"  INT         NOT NULL,
  "acc_year"    INT         NOT NULL,
  "g_pyp"       VARCHAR(4)  NOT NULL,
  PRIMARY KEY ("centralidea_pyp_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "certificate_det"
--

CREATE TABLE IF NOT EXISTS "certificate_det" (
  "certificate_det_id"       SERIAL,
  "new_id"   INTEGER  DEFAULT NULL,
  "stud_id"  VARCHAR(15)            DEFAULT NULL,
  "cert_id"  INT                    DEFAULT NULL,
  "status"   VARCHAR(50)   DEFAULT NULL,
  PRIMARY KEY ("certificate_det_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "certificate_m"
--

CREATE TABLE IF NOT EXISTS "certificate_m" (
  "certificate_m_id"      SERIAL,
  "name"    VARCHAR(200)  DEFAULT NULL,
  "status"  SMALLINT    DEFAULT 1,
  PRIMARY KEY ("certificate_m_id")
);

--
-- Dumping data for table "certificate_m"
--

INSERT INTO "certificate_m" ("certificate_m_id", "name", "status") VALUES
(1, '', 0);

-- --------------------------------------------------------

--
-- Table structure for table "challan_mail_log"
--

CREATE TABLE IF NOT EXISTS "challan_mail_log" (
  "challan_mail_log_id"         SERIAL,
  "stud_id"    INT          DEFAULT NULL,
  "sem"        INT          DEFAULT NULL,
  "a_year"     VARCHAR(10)  DEFAULT NULL,
  "uid"        VARCHAR(50)  DEFAULT NULL,
  "term"       VARCHAR(10)  DEFAULT NULL,
  "slab_id"    INT          DEFAULT NULL,
  "uid_new"    VARCHAR(50)  DEFAULT NULL,
  "mail_sent"  SMALLINT   DEFAULT 0,
  PRIMARY KEY ("challan_mail_log_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "chapter_m"
--

CREATE TABLE IF NOT EXISTS "chapter_m" (
  "chapter_m_id"    SERIAL,
  "name"  VARCHAR(30)  NOT NULL,
  PRIMARY KEY ("chapter_m_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "charges"
--

CREATE TABLE IF NOT EXISTS "charges" (
  "charges_id"           SERIAL,
  "charge_name"  VARCHAR(40)  NOT NULL,
  "narration"    TEXT         NOT NULL,
  "from_date"    DATE         NOT NULL,
  "to_date"      DATE         NOT NULL,
  "price"        BIGINT       NOT NULL,
  "status"       SMALLINT   NOT NULL,
  PRIMARY KEY ("charges_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "charges_applied"
--

CREATE TABLE IF NOT EXISTS "charges_applied" (
  "charges_applied_id"          SERIAL,
  "charges_id"  INT         NOT NULL,
  "group_id"    INT         NOT NULL,
  "status"      SMALLINT  NOT NULL,
  "app_date"    TEXT        NOT NULL,
  PRIMARY KEY ("charges_applied_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "charges_group"
--

CREATE TABLE IF NOT EXISTS "charges_group" (
  "charges_group_id"    SERIAL,
  "name"  VARCHAR(40)  NOT NULL,
  PRIMARY KEY ("charges_group_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "charges_student_group"
--

CREATE TABLE IF NOT EXISTS "charges_student_group" (
  "charges_student_group_id"               SERIAL,
  "charge_group_id"  INT         NOT NULL,
  "student_id"       INT         NOT NULL,
  "status"           SMALLINT  NOT NULL,
  PRIMARY KEY ("charges_student_group_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "cir_parameter"
--

CREATE TABLE IF NOT EXISTS "cir_parameter" (
  "cir_parameter_id"          SERIAL,
  "member"      VARCHAR(20)  DEFAULT NULL,
  "department"  VARCHAR(25)  DEFAULT NULL,
  "media"       VARCHAR(25)  DEFAULT NULL,
  "issues"      INT          DEFAULT NULL,
  "course"      VARCHAR(50)  DEFAULT NULL,
  "year"        VARCHAR(15)  DEFAULT NULL,
  "renewals"    INT          DEFAULT NULL,
  "dys"         INT          DEFAULT 10,
  PRIMARY KEY ("cir_parameter_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "classtime"
--

CREATE TABLE IF NOT EXISTS "classtime" (
  "classtime_id"      SERIAL,
  "grade"   INT          DEFAULT NULL,
  "nopd"    INT          DEFAULT NULL,
  "desc1"   VARCHAR(15)  DEFAULT NULL,
  "type1"   SMALLINT   DEFAULT 1,
  "fmp1"    VARCHAR(5)   DEFAULT NULL,
  "top1"    VARCHAR(5)   DEFAULT NULL,
  "p1"      SMALLINT   DEFAULT NULL,
  "desc2"   VARCHAR(15)  DEFAULT NULL,
  "type2"   SMALLINT   DEFAULT 1,
  "fmp2"    VARCHAR(5)   DEFAULT NULL,
  "top2"    VARCHAR(5)   DEFAULT NULL,
  "p2"      SMALLINT   DEFAULT NULL,
  "desc3"   VARCHAR(15)  DEFAULT NULL,
  "type3"   SMALLINT   DEFAULT 1,
  "fmp3"    VARCHAR(5)   DEFAULT NULL,
  "top3"    VARCHAR(5)   DEFAULT NULL,
  "p3"      SMALLINT   DEFAULT NULL,
  "desc4"   VARCHAR(15)  DEFAULT NULL,
  "type4"   SMALLINT   DEFAULT 1,
  "fmp4"    VARCHAR(5)   DEFAULT NULL,
  "top4"    VARCHAR(5)   DEFAULT NULL,
  "p4"      SMALLINT   DEFAULT NULL,
  "desc5"   VARCHAR(15)  DEFAULT NULL,
  "type5"   SMALLINT   DEFAULT 1,
  "fmp5"    VARCHAR(5)   DEFAULT NULL,
  "top5"    VARCHAR(5)   DEFAULT NULL,
  "p5"      SMALLINT   DEFAULT NULL,
  "desc6"   VARCHAR(15)  DEFAULT NULL,
  "type6"   SMALLINT   DEFAULT 1,
  "fmp6"    VARCHAR(5)   DEFAULT NULL,
  "top6"    VARCHAR(5)   DEFAULT NULL,
  "p6"      SMALLINT   DEFAULT NULL,
  "desc7"   VARCHAR(15)  DEFAULT NULL,
  "type7"   SMALLINT   DEFAULT 1,
  "fmp7"    VARCHAR(5)   DEFAULT NULL,
  "top7"    VARCHAR(5)   DEFAULT NULL,
  "p7"      SMALLINT   DEFAULT NULL,
  "desc8"   VARCHAR(15)  DEFAULT NULL,
  "type8"   SMALLINT   DEFAULT 1,
  "fmp8"    VARCHAR(5)   DEFAULT NULL,
  "top8"    VARCHAR(5)   DEFAULT NULL,
  "p8"      SMALLINT   DEFAULT NULL,
  "desc9"   VARCHAR(15)  DEFAULT NULL,
  "type9"   SMALLINT   DEFAULT 1,
  "fmp9"    VARCHAR(5)   DEFAULT NULL,
  "top9"    VARCHAR(5)   DEFAULT NULL,
  "p9"      SMALLINT   DEFAULT NULL,
  "desc10"  VARCHAR(15)  DEFAULT NULL,
  "type10"  SMALLINT   DEFAULT 1,
  "fmp10"   VARCHAR(5)   DEFAULT NULL,
  "top10"   VARCHAR(5)   DEFAULT NULL,
  "p10"     SMALLINT   DEFAULT NULL,
  "desc11"  VARCHAR(15)  DEFAULT NULL,
  "type11"  SMALLINT   DEFAULT 1,
  "fmp11"   VARCHAR(5)   DEFAULT NULL,
  "top11"   VARCHAR(5)   DEFAULT NULL,
  "p11"     SMALLINT   DEFAULT NULL,
  "desc12"  VARCHAR(15)  DEFAULT NULL,
  "type12"  SMALLINT   DEFAULT 1,
  "fmp12"   VARCHAR(5)   DEFAULT NULL,
  "top12"   VARCHAR(5)   DEFAULT NULL,
  "p12"     SMALLINT   DEFAULT NULL,
  "desc13"  VARCHAR(15)  DEFAULT NULL,
  "type13"  SMALLINT   DEFAULT 1,
  "fmp13"   VARCHAR(5)   DEFAULT NULL,
  "top13"   VARCHAR(5)   DEFAULT NULL,
  "p13"     SMALLINT   DEFAULT NULL,
  "desc14"  VARCHAR(15)  DEFAULT NULL,
  "type14"  SMALLINT   DEFAULT 1,
  "fmp14"   VARCHAR(5)   DEFAULT NULL,
  "top14"   VARCHAR(5)   DEFAULT NULL,
  "p14"     SMALLINT   DEFAULT NULL,
  "desc15"  VARCHAR(15)  DEFAULT NULL,
  "type15"  SMALLINT   DEFAULT 1,
  "fmp15"   VARCHAR(5)   DEFAULT NULL,
  "top15"   VARCHAR(5)   DEFAULT NULL,
  "p15"     SMALLINT   DEFAULT NULL,
  PRIMARY KEY ("classtime_id")
);

--
-- Dumping data for table "classtime"
--

INSERT INTO "classtime" ("classtime_id", "grade", "nopd", "desc1", "type1", "fmp1", "top1", "p1", "desc2", "type2", "fmp2", "top2", "p2", "desc3", "type3", "fmp3", "top3", "p3", "desc4", "type4", "fmp4", "top4", "p4", "desc5", "type5", "fmp5", "top5", "p5", "desc6", "type6", "fmp6", "top6", "p6", "desc7", "type7", "fmp7", "top7", "p7", "desc8", "type8", "fmp8", "top8", "p8", "desc9", "type9", "fmp9", "top9", "p9", "desc10", "type10", "fmp10", "top10", "p10", "desc11", "type11", "fmp11", "top11", "p11", "desc12", "type12", "fmp12", "top12", "p12", "desc13", "type13", "fmp13", "top13", "p13", "desc14", "type14", "fmp14", "top14", "p14", "desc15", "type15", "fmp15", "top15", "p15") VALUES
(1, 1, 5, '', 1, '9:00', '9:30', 0, '', 1, '9:30', '10:00', 0, 'SNACK', 2, '10:00', '10:30', 0, '', 1, '10:30', '11:00', 0, '', 1, '11:00', '11:30', 0, NULL, 1, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(2, 10, 10, 'Registration', 1, '7:50', '8:00', 0, 'Period 1', 1, '8:05', '8:50', 0, 'Period 2', 1, '8:55', '9:40', 0, 'Period 3', 1, '9:45', '10:30', 0, 'Morning Break', 2, '10:30', '10:50', 0, 'Period 4', 1, '10:50', '11:35', 0, 'Period 5', 1, '11:40', '12:25', 1, 'Lunch Break', 2, '12:25', '1:15', 1, 'Period 6', 1, '1:15', '2:00', 1, 'Period 7', 1, '2:05', '2:50', 1, NULL, 1, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(3, 11, 10, 'Registration', 1, '7:50', '8:00', 0, 'Period 1', 1, '8:05', '8:50', 0, 'Period 2', 1, '8:55', '9:40', 0, 'Period 3', 1, '9:45', '10:30', 0, 'Morning Break', 2, '10:30', '10:50', 0, 'Period 4', 1, '10:50', '11:35', 0, 'Period 5', 1, '11:40', '12:25', 1, 'Lunch Break', 2, '12:25', '1:15', 1, 'Period 6', 1, '1:15', '2:00', 1, 'Period 7', 1, '2:05', '2:50', 1, NULL, 1, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(4, 12, 10, 'Registration', 1, '7:50', '8:00', 0, 'Period 1', 1, '8:05', '8:50', 0, 'Period 2', 1, '8:55', '9:40', 0, 'Period 3', 1, '9:45', '10:30', 0, 'Morning Break', 2, '10:30', '10:50', 0, 'Period 4', 1, '10:50', '11:35', 0, 'Period 5', 1, '11:40', '12:25', 1, 'Lunch Break', 2, '12:25', '1:15', 1, 'Period 6', 1, '1:15', '2:00', 1, 'Period 7', 1, '2:05', '2:50', 1, NULL, 1, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(5, 13, 10, 'Registration', 1, '7:50', '8:00', 0, 'Period 1', 1, '8:05', '8:50', 0, 'Period 2', 1, '8:55', '9:40', 0, 'Period 3', 1, '9:45', '10:30', 0, 'Morning Break', 2, '10:30', '10:50', 0, 'Period 4', 1, '10:50', '11:35', 0, 'Period 5', 1, '11:40', '12:25', 1, 'Lunch Break', 2, '12:25', '1:15', 1, 'Period 6', 1, '1:15', '2:00', 1, 'Period 7', 1, '2:05', '2:50', 1, NULL, 1, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(6, 14, 10, 'Registration', 1, '7:50', '8:00', 0, 'Period 1', 1, '8:05', '8:50', 0, 'Period 2', 1, '8:55', '9:40', 0, 'Period 3', 1, '9:45', '10:30', 0, 'Morning Break', 2, '10:30', '10:50', 0, 'Period 4', 1, '10:50', '11:35', 0, 'Period 5', 1, '11:40', '12:25', 1, 'Lunch Break', 2, '12:25', '1:15', 1, 'Period 6', 1, '1:15', '2:00', 1, 'Period 7', 1, '2:05', '2:50', 1, NULL, 1, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(7, 16, 10, 'Registration', 1, '7:50', '8:00', 0, 'Period 1', 1, '8:05', '8:50', 0, 'Period 2', 1, '8:55', '9:40', 0, 'Period 3', 1, '9:45', '10:30', 0, 'Morning Break', 2, '10:30', '10:50', 0, 'Period 4', 1, '10:50', '11:35', 0, 'Period 5', 1, '11:40', '12:25', 1, 'Lunch Break', 2, '12:25', '1:15', 1, 'Period 6', 1, '1:15', '2:00', 1, 'Period 7', 1, '2:05', '2:50', 1, NULL, 1, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(8, 6, 5, '', 1, '9:00', '9:00', 0, '', 1, '9:00', '10:00', 0, '', 2, '10:00', '12:00', 0, '', 1, '1:00', '2:00', 1, '', 1, '2:00', '3:00', 1, NULL, 1, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(9, 4, 10, '', 1, '7:50', '8:00', 0, '', 1, '8:05', '8:45', 0, '', 1, '8:50', '9:30', 0, 'Short Break', 2, '9:35', '10:15', 0, '', 1, '10:20', '11:00', 0, '', 1, '11:05', '11:45', 0, 'Lunch Break', 2, '11:45', '12:30', 1, '', 1, '12:30', '1:15', 1, '', 1, '1:20', '2:00', 1, '', 1, '2:05', '2:45', 1, NULL, 1, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(10, 15, 10, 'Registration', 1, '7:50', '8:00', 0, 'Period 1', 1, '8:05', '8:50', 0, 'Period 2', 1, '8:55', '9:40', 0, 'Period 3', 1, '9:45', '10:30', 0, 'Morning Break', 2, '10:30', '10:50', 0, 'Period 4', 1, '10:50', '11:35', 0, 'Period 5', 1, '11:40', '12:25', 1, 'Lunch Break', 2, '12:25', '1:15', 1, 'Period 6', 1, '1:15', '2:00', 1, 'Period 7', 1, '2:05', '2:50', 1, NULL, 1, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table "class_announcement_class"
--

CREATE TABLE IF NOT EXISTS "class_announcement_class" (
  "class_announcement_class_id"                 SERIAL,
  "class_announce_id"  INT         NOT NULL,
  "class"              INT         NOT NULL,
  "grade"              INT         NOT NULL,
  "status"             SMALLINT  NOT NULL,
  PRIMARY KEY ("class_announcement_class_id")
);

--
-- Dumping data for table "class_announcement_class"
--

INSERT INTO "class_announcement_class" ("class_announcement_class_id", "class_announce_id", "class", "grade", "status") VALUES
(1, 6, 0, 10, 1),
(2, 6, 0, 11, 1),
(3, 6, 0, 12, 1),
(4, 6, 0, 13, 1),
(5, 6, 0, 14, 1),
(6, 6, 0, 15, 1),
(7, 6, 0, 16, 1),
(8, 7, 0, 10, 1),
(9, 7, 0, 11, 1),
(10, 7, 0, 12, 1);

-- --------------------------------------------------------

--
-- Table structure for table "class_announcement_files"
--

CREATE TABLE IF NOT EXISTS "class_announcement_files" (
  "class_announcement_files_id"                     SERIAL,
  "announcement_class_id"  VARCHAR(100)  DEFAULT NULL,
  "trgt_filename"          VARCHAR(250)  DEFAULT NULL,
  "trgt_filepath"          VARCHAR(250)  DEFAULT NULL,
  "inserted_date"          DATE          DEFAULT NULL,
  "user"                   VARCHAR(200)  DEFAULT NULL,
  PRIMARY KEY ("class_announcement_files_id")
);

--
-- Dumping data for table "class_announcement_files"
--

INSERT INTO "class_announcement_files" ("class_announcement_files_id", "announcement_class_id", "trgt_filename", "trgt_filepath", "inserted_date", "user") VALUES
(13, '46', 'Head Lice Email.doc', 'class_doc/a65b638466815f7aae29d7b728c15501.doc', '2026-02-03', 'administrator');

-- --------------------------------------------------------

--
-- Table structure for table "class_announcement_master"
--

CREATE TABLE IF NOT EXISTS "class_announcement_master" (
  "class_announcement_master_id"             SERIAL,
  "day_type"       INT           NOT NULL,
  "from_date"      DATE          NOT NULL,
  "to_date"        DATE          NOT NULL,
  "grade_type"     INT           NOT NULL,
  "title"          VARCHAR(200)  NOT NULL,
  "description"    TEXT          NOT NULL,
  "user"           VARCHAR(255)  NOT NULL,
  "inserted_date"  DATE          DEFAULT NULL,
  "status"         SMALLINT    NOT NULL,
  PRIMARY KEY ("class_announcement_master_id")
);

--
-- Dumping data for table "class_announcement_master"
--

INSERT INTO "class_announcement_master" ("class_announcement_master_id", "day_type", "from_date", "to_date", "grade_type", "title", "description", "user", "inserted_date", "status") VALUES
(6, 2, '2026-11-18', '2026-11-30', 1, ' Secondary Daily Bulletin - Mon, Nov. 18', '<div id="yui_3_7_2_1_1384872502665_3929">\r\n<div id="yui_3_7_2_1_1384872502665_3928">\r\n<div id="yui_3_7_2_1_1384872502665_4000"><strong id="yui_3_7_2_1_1384872502665_3999"><em id="yui_3_7_2_1_1384872502665_3998" style="text-decoration: underline;">From Ms. Anne</em>&nbsp;-&nbsp;</strong><strong>Very Important for Calamity Jane cast</strong></div>\r\n<div id="yui_3_7_2_1_1384872502665_3927">\r\n<div id="yui_3_7_2_1_1384872502665_3996">I will be taking cast photographs&nbsp;on Tuesday&nbsp;during lunchtime, please come to the seventh floor at some point over lunch.&nbsp; Principals, please co-ordinate with your opposite numbers so we can take paired pictures.<strong><span style="text-decoration: underline;"><br /> </span></strong></div>\r\n<br />ALL cast members should bring the shirts or blouses they are wearing for the show and change into them on the seventh floor.&nbsp; You can change back into your school shirt after you have had your photograph taken.&nbsp; There is no need to bring the bottom half of your costume.&nbsp; If you are planning on wearing a hat or anything else on your head please bring that too.<strong><br /> </strong></div>\r\n<div id="yui_3_7_2_1_1384872502665_3933"><strong><span style="text-decoration: underline;"><em>&nbsp;</em></span></strong></div>\r\n<div id="yui_3_7_2_1_1384872502665_3936">\r\n<div style="font-family: verdana, sans-serif;"><strong><span style="text-decoration: underline;"><em>From Ms. Priya</em></span><em>&nbsp;-&nbsp;</em>MS Assembly</strong></div>\r\n<div id="yui_3_7_2_1_1384872502665_3935" style="font-family: verdana, sans-serif;">MS assembly rehearsals will take place in the auditorium at the following times today and&nbsp;tomorrow. The following students must attend these rehearsals&nbsp;<strong><span style="text-decoration: underline;">today at 12:25&nbsp;and&nbsp;tomorrow at 12:45&nbsp;in the auditorium.</span></strong></div>\r\n<div id="yui_3_7_2_1_1384872502665_3938" style="font-family: verdana, sans-serif;">&nbsp;</div>\r\n<div id="yui_3_7_2_1_1384872502665_3940" style="font-family: verdana, sans-serif;">Saloni Ladha</div>\r\n<div id="yui_3_7_2_1_1384872502665_3942" style="font-family: verdana, sans-serif;">Khwaish Bedi</div>\r\n<div id="yui_3_7_2_1_1384872502665_3944" style="font-family: verdana, sans-serif;">Jennisa and Aashia</div>\r\n<div id="yui_3_7_2_1_1384872502665_3967" style="font-family: verdana, sans-serif;">Anay Khanderia</div>\r\n<div id="yui_3_7_2_1_1384872502665_4003" style="font-family: verdana, sans-serif;">Ekaadh and Kartik</div>\r\n<div id="yui_3_7_2_1_1384872502665_4005" style="font-family: verdana, sans-serif;">Mihika, Mandira, Noyyo, Gina and others in the group</div>\r\n<div id="yui_3_7_2_1_1384872502665_4007" style="font-family: verdana, sans-serif;">Isha and Mallika</div>\r\n<div id="yui_3_7_2_1_1384872502665_3946" style="font-family: verdana, sans-serif;">Anoushka Lad and Shivani P</div>\r\n<div id="yui_3_7_2_1_1384872502665_3965" style="font-family: verdana, sans-serif;">Stuti Srivatava</div>\r\n<div id="yui_3_7_2_1_1384872502665_3948" style="font-family: verdana, sans-serif;">Aditya Warrier</div>\r\n<div id="yui_3_7_2_1_1384872502665_3950" style="font-family: verdana, sans-serif;">Akansha Das</div>\r\n</div>\r\n<div id="yui_3_7_2_1_1384872502665_3952" style="font-family: verdana, sans-serif;">&nbsp;</div>\r\n<div id="yui_3_7_2_1_1384872502665_3954"><strong id="yui_3_7_2_1_1384872502665_4011"><span id="yui_3_7_2_1_1384872502665_4010" style="text-decoration: underline;"><em id="yui_3_7_2_1_1384872502665_4009">From Ms. Minal and Ms. Ulka</em></span>&nbsp;-&nbsp;</strong><strong>University Visits</strong></div>\r\n<div id="yui_3_7_2_1_1384872502665_3957"><span style="font-size: 13px;">Mon 18th Nov</span><span style="font-size: 13px;">&nbsp;</span><span id="yui_3_7_2_1_1384872502665_3956" style="font-size: 13px;">-&nbsp;Visit by York University in Toronto, Canada</span></div>\r\n<div id="yui_3_7_2_1_1384872502665_3961">\r\n<div id="yui_3_7_2_1_1384872502665_3959">Tues 19th Nov&nbsp;- Visit by Deakin University, Australia&nbsp;</div>\r\n<div id="yui_3_7_2_1_1384872502665_4013">and&nbsp;Australian National University.</div>\r\n</div>\r\n<p class="yiv752424536MsoNormal" style="margin-top: 6.6pt;">&nbsp;</p>\r\n<div>(All of these will be held in the Art room on the 6th floor between&nbsp;<span style="border-bottom-width: 1px; border-bottom-style: dashed; border-bottom-color: #cccccc;">12.25pm-1pm</span>)</div>\r\n<p class="yiv752424536MsoNormal" style="margin-top: 6.6pt;"><strong><span style="font-family: arial,helvetica,sans-serif;"><em style="text-decoration: underline;">From Ms. Anne</em>&nbsp;-&nbsp;</span>Halloween Pictures</strong></p>\r\n<div>Someone who I shared the dropbox file with has removed EVERY SINGLE PICTURE from the file.&nbsp; Can you please upload them all again as a matter of urgency.</div>\r\n<p class="yiv752424536MsoNormal" style="margin-top: 6.6pt;"><strong><span style="font-family: arial,helvetica,sans-serif;"><span style="text-decoration: underline;"><em>From Ms. Richa</em></span>&nbsp;-&nbsp;For Grade 6 to 8 students</span></strong></p>\r\n<p class="yiv752424536MsoNormal" style="margin-top: 6.6pt;"><span style="font-family: arial,helvetica,sans-serif;">Do you wish to explore space and be an astronomer ? then.. here`s the opportunity ....</span></p>\r\n<p id="yui_3_7_2_1_1384872502665_4020" class="yiv752424536MsoNormal" style="margin-top: 6.6pt;"><span id="yui_3_7_2_1_1384872502665_4019" style="font-family: arial,helvetica,sans-serif;"><strong id="yui_3_7_2_1_1384872502665_4022">NASA camp June 2026 :</strong>&nbsp;We have planned&nbsp;to take the middle school students for an experiential trip to NASA space camp in the month of June.Space School is a unique ten day trip to the USA designed to inspire, excite and motivate students about science and space research. The trip includes four days at Houston, Texas, during which students participate in educational activities at Space Center, Houston. The trip also includes four days of adventure in&nbsp; Orlando, Florida. There will an optional extension to New York and Niagara.</span></p>\r\n<p id="yui_3_7_2_1_1384872502665_4017" class="yiv752424536MsoNormal" style="margin-top: 6.6pt;"><span id="yui_3_7_2_1_1384872502665_4016" style="font-family: arial,helvetica,sans-serif;">During the educational program students will:</span></p>\r\n<ul id="yui_3_7_2_1_1384872502665_4027">\r\n<li id="yui_3_7_2_1_1384872502665_4026" style="margin-left: 15px;"><span id="yui_3_7_2_1_1384872502665_4025" style="font-family: arial, helvetica, sans-serif;">Learn about the work NASA is doing</span></li>\r\n<li id="yui_3_7_2_1_1384872502665_4030" style="margin-left: 15px;"><span id="yui_3_7_2_1_1384872502665_4029" style="font-family: arial, helvetica, sans-serif;">Undergo extensive astronaut training</span></li>\r\n<li style="margin-left: 15px;"><span style="font-family: arial, helvetica, sans-serif;">Learn to overcome challenges as they participate in a realistic simulation of a space mission</span></li>\r\n<li id="yui_3_7_2_1_1384872502665_4047" style="margin-left: 15px;"><span style="font-family: arial, helvetica, sans-serif;">Work on projects</span></li>\r\n<li id="yui_3_7_2_1_1384872502665_4045" style="margin-left: 15px;"><span id="yui_3_7_2_1_1384872502665_4044" style="font-family: arial, helvetica, sans-serif;">Participate in team building exercises</span></li>\r\n<li id="yui_3_7_2_1_1384872502665_4042" style="margin-left: 15px;"><span id="yui_3_7_2_1_1384872502665_4041" style="font-family: arial, helvetica, sans-serif;">Take exclusive tours of the facilities at NASA&rsquo;s USSRC</span></li>\r\n<li id="yui_3_7_2_1_1384872502665_4039" style="margin-left: 15px;"><span id="yui_3_7_2_1_1384872502665_4038" style="font-family: arial, helvetica, sans-serif;">Watch space shows and space movies</span></li>\r\n</ul>\r\n<p id="yui_3_7_2_1_1384872502665_4036" class="yiv752424536MsoNormal" style="margin-top: 6.6pt;"><span id="yui_3_7_2_1_1384872502665_4035" style="font-family: arial,helvetica,sans-serif;">At the end of the program, there will be a graduation ceremony in which each student will receive a certificate from NASA&rsquo;s USSRC.If you are interested in attending this camp , then please register your name with Ms.Richa by sending an email to her at&nbsp;&nbsp;<a href="mailto:richa.gupta@email.com" rel="nofollow" target="_blank">richa.gupta@email.com</a>&nbsp;by&nbsp;<strong>Friday, 22nd</strong>&nbsp;<strong id="yui_3_7_2_1_1384872502665_4034">November 2026. We will then conduct an information seminar for the interested students and their parents.</strong></span></p>\r\n</div>\r\n<div id="yui_3_7_2_1_1384872502665_4050" style="font-size: 13px;">&nbsp;</div>\r\n<div id="yui_3_7_2_1_1384872502665_4032" style="font-size: 13px;"><strong><span style="font-style: italic; text-decoration: underline;">&nbsp;</span></strong></div>\r\n<div id="yui_3_7_2_1_1384872502665_4053" style="font-size: 13px;"><strong id="yui_3_7_2_1_1384872502665_4052"><span style="font-style: italic; text-decoration: underline;">From Adventurois Editors</span>&nbsp;-&nbsp;Adventurois is calling young writers!</strong></div>\r\n<div id="yui_3_7_2_1_1384872502665_4083" style="font-size: 13px;"><strong id="yui_3_7_2_1_1384872502665_4097">(Grade 9 and 10 only)</strong></div>\r\n<div id="yui_3_7_2_1_1384872502665_4056" style="font-size: 13px;"><span id="yui_3_7_2_1_1384872502665_4055" style="font-size: 13px;">Adventurois Magazine is a student-led magazine, which is a platform for people to share ideas and opinions about the world around them. We request everyone from Grade 9 and Grade 10 to write about anything that interests them, from amazing recipes to hard wrenching fictional stories, anything which brings out the writer in you. There is also a new concept called "Agony Aunt" in which you can send in your problems anonymously and get replies from our Agony Aunts, who will give you advice.&nbsp;</span><span id="yui_3_7_2_1_1384872502665_4081" style="font-size: 13px;">The last day to submit your work is18th November, please send in your entries and/or questions to</span><span style="font-size: 13px;">&nbsp;</span><span style="font-size: 13px; text-decoration: underline;"><a href="mailto:adventurois@email.com" rel="nofollow" target="_blank">adventurois@email.com</a></span><span style="font-size: 13px;">.</span><span class="yiv752424536HOEnZb"><span style="color: #888888;"><br /> </span></span></div>\r\n<span class="yiv752424536HOEnZb"><span class="yiv752424536HOEnZb"><span style="color: #888888;"></span></span></span>\r\n<div id="yui_3_7_2_1_1384872502665_4058"><span style="font-size: 13px;">&nbsp;</span></div>\r\n<span id="yui_3_7_2_1_1384872502665_4060" class="yiv752424536HOEnZb"><span id="yui_3_7_2_1_1384872502665_4059" style="color: #888888;"></span></span></div>\r\n<p><span class="yiv752424536HOEnZb"><span class="yiv752424536HOEnZb"><span style="color: #888888;"></span></span></span></p>\r\n<div id="yui_3_7_2_1_1384872502665_4087">&nbsp;</div>\r\n<p><span class="yiv752424536HOEnZb"><span class="yiv752424536HOEnZb"><span style="color: #888888;">-- <br /></span></span></span></p>\r\n<div id="yui_3_7_2_1_1384872502665_4067" dir="ltr">\r\n<div id="yui_3_7_2_1_1384872502665_4074">\r\n<div id="yui_3_7_2_1_1384872502665_4073" style="color: #666666;">\r\n<div id="yui_3_7_2_1_1384872502665_4089"><span id="yui_3_7_2_1_1384872502665_4094" style="font-family: georgia, serif;">Eric Dyck Hilty</span></div>\r\n<div id="yui_3_7_2_1_1384872502665_4078"><span id="yui_3_7_2_1_1384872502665_4077" style="font-family: georgia, serif;">Deputy Head of Secondary for Student Life<br /><br /><em id="yui_3_7_2_1_1384872502665_4076">LMS International School<br />LMS Garden City, Off Western Express Highway,<br /></em></span></div>\r\n<span id="yui_3_7_2_1_1384872502665_4072" style="font-family: georgia, serif;"><em id="yui_3_7_2_1_1384872502665_4071">Goregaon (East), Mumbai - 400 063, India.&nbsp;<br /> </em></span></div>\r\n<span style="font-family: georgia, serif;"><span style="font-style: italic; color: #666666;">Tel: +91 22 4236 3134</span></span></div>\r\n</div>\r\n<p><span id="yui_3_7_2_1_1384872502665_4069" class="yiv752424536HOEnZb"><span id="yui_3_7_2_1_1384872502665_4068" style="color: #888888;"></span></span></p>', 'administrator', '2026-11-19', 1);

-- --------------------------------------------------------

--
-- Table structure for table "class_section"
--

CREATE TABLE IF NOT EXISTS "class_section" (
  "class_section_id"            SERIAL,
  "section_name"  VARCHAR(20)  DEFAULT NULL,
  "class_id"      INT          NOT NULL,
  "s_name"        VARCHAR(3)   NOT NULL,
  "codename"      VARCHAR(22)  NOT NULL,
  "grade"         INT          NOT NULL,
  "sub"           INT          NOT NULL,
  "status"        INT          NOT NULL,
  PRIMARY KEY ("class_section_id")
);

--
-- Dumping data for table "class_section"
--

INSERT INTO "class_section" ("class_section_id", "section_name", "class_id", "s_name", "codename", "grade", "sub", "status") VALUES
(1, 'PS HR-NM-A', 1, 'A', '', 0, 0, 0),
(2, 'PS HR-RP-B', 1, 'B', '', 0, 0, 0),
(3, 'PS HR-SM-C', 1, 'C', '', 0, 0, 0),
(4, 'PS HR-DD-D', 1, 'D', '', 0, 0, 0),
(5, 'Nurs HR-NK-A', 2, 'A', '', 0, 0, 0),
(6, 'Nurs HR-BS-B', 2, 'B', '', 0, 0, 0),
(7, 'Nurs HR-PD-C', 2, 'C', '', 0, 0, 0),
(8, 'Nurs HR-SB-D', 2, 'D', '', 0, 0, 0),
(9, 'JKG HR-RM-A', 3, 'A', '', 0, 0, 0),
(10, 'JKG HR-RG-B', 3, 'B', '', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table "class_section_sub"
--

CREATE TABLE IF NOT EXISTS "class_section_sub" (
  "class_section_sub_id"            SERIAL,
  "section_name"  VARCHAR(20)  DEFAULT NULL,
  "sub"           INT          NOT NULL,
  "grade"         INT          NOT NULL,
  "status"        INT          NOT NULL,
  PRIMARY KEY ("class_section_sub_id")
);

--
-- Dumping data for table "class_section_sub"
--

INSERT INTO "class_section_sub" ("class_section_sub_id", "section_name", "sub", "grade", "status") VALUES
(1, 'Music A', 238, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table "class_teacher"
--

CREATE TABLE IF NOT EXISTS "class_teacher" (
  "class_teacher_id"          SERIAL,
  "curri_type"  INT  DEFAULT NULL,
  "grade"       INT  DEFAULT NULL,
  "sect"        INT  DEFAULT NULL,
  "teacher"     INT  DEFAULT NULL,
  PRIMARY KEY ("class_teacher_id")
);

--
-- Dumping data for table "class_teacher"
--

INSERT INTO "class_teacher" ("class_teacher_id", "curri_type", "grade", "sect", "teacher") VALUES
(10, 1, 1, 0, 17),
(9, 3, 10, 42, 17),
(4, 1, 1, 1, 18),
(5, 3, 9, 1, 18),
(8, 2, 6, 1, 17);

-- --------------------------------------------------------

--
-- Table structure for table "school"
--

CREATE TABLE IF NOT EXISTS "school" (
  "col_id"      SERIAL,
  "col_name"    VARCHAR(100)  DEFAULT NULL,
  "col_code"    VARCHAR(10)   NOT NULL DEFAULT '',
  "col_addr"    VARCHAR(100)  NOT NULL DEFAULT '',
  "col_pin"     VARCHAR(20)   DEFAULT NULL,
  "col_phone"   VARCHAR(50)   DEFAULT NULL,
  "col_fax"     VARCHAR(50)   DEFAULT NULL,
  "email"       VARCHAR(30)   DEFAULT NULL,
  "company_id"  VARCHAR(50)   DEFAULT NULL,
  "col_city"    VARCHAR(40)   NOT NULL,
  "col_state"   VARCHAR(40)   NOT NULL,
  "col_tin"     VARCHAR(40)   NOT NULL,
  PRIMARY KEY ("col_id")
);

--
-- Dumping data for table "school"
--

INSERT INTO "school" ("col_id", "col_name", "col_code", "col_addr", "col_pin", "col_phone", "col_fax", "email", "company_id", "col_city", "col_state", "col_tin") VALUES
(1, 'INTERNATIONAL SCHOOL', 'RD-S', 'Garden City\r\nNear Mall\r\nOff Western Express Highway\r\nGoregaon East\r\nMumbai - 4000000', '400000', '+ 91 22 4236 0000 / 199', '+ 91 22 4236 0000', 'education@email.com', '', 'Mumbai', 'Maharashtra', '');

-- --------------------------------------------------------

--
-- Table structure for table "comments"
--

CREATE TABLE IF NOT EXISTS "comments" (
  "comments_id"           SERIAL,
  "class"        INT          NOT NULL,
  "acc_year"     INT          NOT NULL,
  "subject_id"   INT          NOT NULL,
  "section_id"   SMALLINT   NOT NULL,
  "student_id"   INT          NOT NULL,
  "description"  TEXT         NOT NULL,
  "score"        INT          NOT NULL,
  "grade"        VARCHAR(4)   NOT NULL,
  "sys_date"     DATE         NOT NULL,
  "status"       SMALLINT   NOT NULL,
  "username"     VARCHAR(50)  NOT NULL,
  PRIMARY KEY ("comments_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "comment_kg"
--

CREATE TABLE IF NOT EXISTS "comment_kg" (
  "comment_kg_id"          BIGSERIAL,
  "exam_id"     INT     NOT NULL,
  "class"       INT     NOT NULL,
  "sec"         INT     NOT NULL,
  "student_id"  INT     NOT NULL,
  "acc_year"    INT     NOT NULL,
  "commt"       TEXT    NOT NULL,
  PRIMARY KEY ("comment_kg_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "comment_pyp"
--

CREATE TABLE IF NOT EXISTS "comment_pyp" (
  "comment_pyp_id"          BIGSERIAL,
  "exam_id"     INT     NOT NULL,
  "class"       INT     NOT NULL,
  "sec"         INT     NOT NULL,
  "sub"         INT     NOT NULL,
  "student_id"  INT     NOT NULL,
  "acc_year"    INT     NOT NULL,
  "commt1"      TEXT    NOT NULL,
  PRIMARY KEY ("comment_pyp_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "company"
--

CREATE TABLE IF NOT EXISTS "company" (
  "Sl_No"         INT           NOT NULL,
  "ID"            INT           DEFAULT NULL,
  "Company_Name"  VARCHAR(250)  DEFAULT NULL,
  "Address"       TINYTEXT,
  "City"          VARCHAR(50)   DEFAULT NULL,
  "State"         VARCHAR(50)   DEFAULT NULL,
  "Telephone"     VARCHAR(50)   DEFAULT NULL,
  "fax"           VARCHAR(50)   DEFAULT NULL,
  "Email"         VARCHAR(50)   DEFAULT NULL,
  "PAN_No"        VARCHAR(50)   DEFAULT NULL,
  PRIMARY KEY ("Sl_No")
);

-- --------------------------------------------------------

--
-- Table structure for table "country"
--

CREATE TABLE IF NOT EXISTS "country" (
  "country_id"            SERIAL,
  "country_name"  VARCHAR(20)  DEFAULT NULL,
  PRIMARY KEY ("country_id")
);

--
-- Dumping data for table "country"
--

INSERT INTO "country" ("country_id", "country_name") VALUES
(1, 'INDIA'),
(2, 'Malayasia'),
(3, 'Korea'),
(4, 'United  States'),
(5, 'SriLanka');

-- --------------------------------------------------------

--
-- Table structure for table "coursehead"
--

CREATE TABLE IF NOT EXISTS "coursehead" (
  "coursehead_id"          SERIAL,
  "cname"       CHAR(50)       DEFAULT NULL,
  "activation"  VARCHAR(50)  DEFAULT 'Y',
  PRIMARY KEY ("coursehead_id")
);

--
-- Dumping data for table "coursehead"
--

INSERT INTO "coursehead" ("coursehead_id", "cname", "activation") VALUES
(1, 'Play School', 'Y'),
(2, 'Early Year and Primary School', 'Y'),
(3, 'Middle School', 'Y'),
(4, 'High School', 'Y'),
(6, 'IB', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table "course_m"
--

CREATE TABLE IF NOT EXISTS "course_m" (
  "course_id"    SERIAL,
  "coursename"   VARCHAR(100)  NOT NULL DEFAULT '',
  "course_abbr"  VARCHAR(20)   DEFAULT NULL,
  "intake"       INT           DEFAULT NULL,
  "status"       SMALLINT    DEFAULT 1,
  "head_id"      INT           DEFAULT NULL,
  "uni_id"       VARCHAR(11)   DEFAULT NULL,
  "cids"         VARCHAR(5)    DEFAULT NULL,
  PRIMARY KEY ("course_id")
);

--
-- Dumping data for table "course_m"
--

INSERT INTO "course_m" ("course_id", "coursename", "course_abbr", "intake", "status", "head_id", "uni_id", "cids") VALUES
(1, 'Play School', 'EL', NULL, 1, 1, 'NULL', 'NULL'),
(2, 'Early Year and Primary School', 'SE', NULL, 1, 2, 'NULL', 'NULL'),
(3, 'Middle School', 'PYP', NULL, 1, 3, 'NULL', 'NULL'),
(4, 'High School', 'LS', NULL, 1, 4, 'NULL', 'NULL');

-- --------------------------------------------------------

--
-- Table structure for table "course_year"
--

CREATE TABLE IF NOT EXISTS "course_year" (
  "year_id"     SERIAL,
  "year_name"   VARCHAR(50)  NOT NULL DEFAULT '',
  "short_name"  VARCHAR(5)   NOT NULL,
  "status"      SMALLINT   DEFAULT 1,
  "head_id"     INT          DEFAULT NULL,
  "student_id"  SMALLINT   NOT NULL,
  PRIMARY KEY ("year_id")
);

--
-- Dumping data for table "course_year"
--

INSERT INTO "course_year" ("year_id", "year_name", "short_name", "status", "head_id", "student_id") VALUES
(1, 'PLAYSCHOOL', 'PS', 1, 1, 0),
(2, 'NURSERY', 'NUR', 1, 2, 0),
(3, 'JR KG', 'JR KG', 1, 2, 0),
(4, 'SR KG', 'SR KG', 1, 2, 0),
(5, '01', '01', 1, 2, 0),
(6, '02', '02', 1, 2, 0),
(7, '03', '03', 1, 2, 0),
(8, '04', '04', 1, 2, 0),
(9, '05', '05', 1, 2, 0),
(10, '06', '06', 1, 3, 0),
(11, '07', '07', 1, 3, 0),
(12, '08', '08', 1, 3, 0),
(13, '09', '09', 1, 4, 0),
(14, '10', '10', 1, 4, 0),
(15, '11', '11', 1, 4, 0),
(16, '12', '12', 1, 4, 0);

-- --------------------------------------------------------

--
-- Table structure for table "criteria"
--

CREATE TABLE IF NOT EXISTS "criteria" (
  "criteria_id"        BIGSERIAL,
  "head"      INT     NOT NULL,
  "criteria"  TEXT    NOT NULL,
  PRIMARY KEY ("criteria_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "criteria_m"
--

CREATE TABLE IF NOT EXISTS "criteria_m" (
  "criteria_m_id"           BIGSERIAL,
  "exam_id"      INT         NOT NULL,
  "class"        INT         NOT NULL,
  "sec"          INT         NOT NULL,
  "student_id"   INT         NOT NULL,
  "acc_year"     INT         NOT NULL,
  "criteria_id"  INT         NOT NULL,
  "mark"         VARCHAR(4)  NOT NULL,
  PRIMARY KEY ("criteria_m_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "day"
--

CREATE TABLE IF NOT EXISTS "day" (
  "day_id"      SERIAL,
  "Name"    VARCHAR(20)        NOT NULL,
  "status"  SMALLINT         DEFAULT 1,
  PRIMARY KEY ("day_id")
);

--
-- Dumping data for table "day"
--

INSERT INTO "day" ("ID", "Name", "status") VALUES
(1, 'Monday', 1),
(2, 'Tuesday', 1),
(3, 'Wednesday', 1),
(4, 'Thursday', 1),
(5, 'Friday', 1),
(6, 'Saturday', 0),
(7, 'Sunday', 0);

-- --------------------------------------------------------

--
-- Table structure for table "dept_no"
--

CREATE TABLE IF NOT EXISTS "dept_no" (
  "Dept"       VARCHAR(50)  NOT NULL DEFAULT '',
  "dpt_id"     SERIAL,
  "status"     SMALLINT   DEFAULT 1,
  "dept_code"  VARCHAR(5)   DEFAULT NULL,
  PRIMARY KEY ("dpt_id")
);

--
-- Dumping data for table "dept_no"
--

INSERT INTO "dept_no" ("Dept", "dpt_id", "status", "dept_code") VALUES
('NURSERY', 1, 1, 'NRY'),
('ADMINISTRATIVE', 2, 1, 'ADM'),
('PRIMARY & HIGHSCHOOL', 3, 1, 'PRY'),
('HOUSE KEEPING', 4, 1, 'HK'),
('Primary Years', 5, 1, 'PY'),
('Early Years', 6, 1, 'EY'),
('Middle Years', 7, 1, 'MY'),
('IGCSE and IBDP', 8, 1, 'IG&IB'),
('Secondary', 9, 1, 'SEC'),
('Middle Years / IGCSE and IBDP', 10, 1, 'MY/IG'),
('MYP, IGCSE and IBDP', 11, 1, 'MY,IG'),
('All homerooms and IBDP', 12, 1, 'AHM'),
('Middle Years and IGCSE', 13, 1, 'MYIG'),
('Middle Years and IBDP', 14, 1, 'MYIB'),
('IGCSE ', 15, 1, 'IG'),
('IBDP', 16, 1, 'IB'),
('WHOLE SECONDARY', 17, 1, 'WSEC'),
('WHOLE SCHOOL', 18, 1, 'WS'),
('MARKETING ADMISSION & COMMUNICATION', 19, 1, 'MAC'),
('HUMAN RESOURCE', 20, 1, 'HR'),
('ACCOUNTS', 21, 1, 'A/C'),
('LIBRARY', 22, 1, 'LIB'),
('PMS', 23, 1, 'PMS'),
('SECURITY', 24, 1, 'SECUR'),
('LABORATORY', 25, 1, 'LAB');

-- --------------------------------------------------------

--
-- Table structure for table "detain_student"
--

CREATE TABLE IF NOT EXISTS "detain_student" (
  "detain_student_id"                 INT                NOT NULL DEFAULT 0,
  "admission_id"       VARCHAR(20)        DEFAULT NULL,
  "admission_date"     DATE               DEFAULT NULL,
  "student_id"         VARCHAR(20)        DEFAULT NULL,
  "usn"                VARCHAR(20)        DEFAULT NULL,
  "first_name"         VARCHAR(30)        DEFAULT NULL,
  "last_name"          VARCHAR(30)        DEFAULT NULL,
  "nationality"        SMALLINT  DEFAULT NULL,
  "religion"           SMALLINT   DEFAULT NULL,
  "gender"             CHAR(1)            DEFAULT NULL,
  "caste_id"           VARCHAR(50)        DEFAULT NULL,
  "dob"                DATE               DEFAULT NULL,
  "age"                VARCHAR(10)        DEFAULT NULL,
  "per_address"        VARCHAR(250)       DEFAULT NULL,
  "per_city"           VARCHAR(100)       DEFAULT NULL,
  "per_state"          VARCHAR(50)        DEFAULT NULL,
  "per_country"        VARCHAR(50)        DEFAULT NULL,
  "per_pincode"        VARCHAR(7)         DEFAULT NULL,
  "per_phone"          VARCHAR(20)        DEFAULT NULL,
  "cor_address"        VARCHAR(250)       DEFAULT NULL,
  "cor_city"           VARCHAR(100)       DEFAULT NULL,
  "cor_state"          VARCHAR(50)        DEFAULT NULL,
  "cor_country"        VARCHAR(50)        DEFAULT NULL,
  "cor_pincode"        VARCHAR(7)         DEFAULT NULL,
  "cor_phone"          VARCHAR(20)        DEFAULT NULL,
  "parent_name"        VARCHAR(60)        DEFAULT NULL,
  "parent_occupation"  VARCHAR(30)        DEFAULT NULL,
  "parent_income"      NUMERIC(12,2)        DEFAULT NULL,
  "loc_address"        VARCHAR(250)       DEFAULT NULL,
  "loc_city"           VARCHAR(100)       DEFAULT NULL,
  "loc_state"          VARCHAR(50)        DEFAULT NULL,
  "loc_country"        VARCHAR(50)        DEFAULT NULL,
  "loc_pincode"        VARCHAR(7)         DEFAULT NULL,
  "loc_phone"          VARCHAR(20)        DEFAULT NULL,
  "course_admitted"    INT                DEFAULT NULL,
  "course_yearsem"     INT                DEFAULT NULL,
  "quota_id"           INT                DEFAULT NULL,
  "academic_year"      VARCHAR(12)        DEFAULT NULL,
  "remarks"            VARCHAR(250)       DEFAULT NULL,
  "username"           VARCHAR(15)        DEFAULT NULL,
  "password"           VARCHAR(255)       DEFAULT NULL,
  "archive"            VARCHAR(50)  DEFAULT 'N',
  "class_section_id"   SMALLINT         NOT NULL DEFAULT 0,
  "parent_username"    VARCHAR(15)        DEFAULT NULL,
  "password_hash"    VARCHAR(255)       DEFAULT NULL,
  "count"              INT                DEFAULT NULL,
  "blood_group"        VARCHAR(20)        DEFAULT NULL,
  "admission_type"     VARCHAR(10)        DEFAULT NULL,
  "img_source"         VARCHAR(255)       DEFAULT NULL,
  "img_source_s"       VARCHAR(255)       DEFAULT NULL,
  "marital_status"     VARCHAR(2)         NOT NULL,
  "mentor"             VARCHAR(15)        DEFAULT '',
  "m_email"            VARCHAR(20)        DEFAULT NULL,
  "mnum"               INT                DEFAULT NULL,
  "g_name"             VARCHAR(15)        DEFAULT NULL,
  "g_occ"              VARCHAR(15)        DEFAULT NULL,
  "g_in"               INT                DEFAULT NULL,
  "g_num"              INT                DEFAULT NULL,
  "g_mail"             VARCHAR(15)        DEFAULT NULL,
  "f_email"            VARCHAR(20)        DEFAULT NULL,
  "place_of_birth"     VARCHAR(30)        DEFAULT NULL,
  "f_quali"            VARCHAR(30)        DEFAULT NULL,
  "m_quali"            VARCHAR(30)        DEFAULT NULL,
  "g_quali"            VARCHAR(30)        DEFAULT NULL,
  "lang_id"            VARCHAR(200)       DEFAULT NULL,
  "State"              VARCHAR(20)        DEFAULT 'Karnataka',
  "sms_mobile"         VARCHAR(15)        DEFAULT NULL,
  "mother_tongue"      SMALLINT   DEFAULT NULL,
  "birth_disct"        VARCHAR(100)       DEFAULT NULL,
  "stud_type"          VARCHAR(10)        DEFAULT NULL,
  "vdate"              DATE               DEFAULT NULL,
  "m_name"             VARCHAR(200)       DEFAULT NULL,
  "m_occ"              VARCHAR(200)       DEFAULT NULL,
  "m_inc"              VARCHAR(15)        DEFAULT NULL,
  "foadd"              VARCHAR(255)       DEFAULT NULL,
  "moadd"              VARCHAR(255)       DEFAULT NULL,
  "goadd"              VARCHAR(255)       DEFAULT NULL,
  PRIMARY KEY ("detain_student_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "dob"
--

CREATE TABLE IF NOT EXISTS "dob" (
  "student_id"    VARCHAR(255)  DEFAULT NULL,
  "img_source_s"  VARCHAR(11)   NOT NULL,
  PRIMARY KEY ("student_id")
);

--
-- Dumping data for table "dob"
--

INSERT INTO "dob" ("student_id", "img_source_s") VALUES
('A203', 'aaliya.jain'),
('A12397', 'aarush.gupt'),
('A1182', 'aashu.kedia'),
('A427', 'abbas.jaafe'),
('A12398', 'adiraj.sing'),
('A381', 'adit.pakvas'),
('A12518', 'advika.shal'),
('A664', 'akash.singh'),
('A580', 'amogh.narve'),
('A1170', 'ananya.yoga');

-- --------------------------------------------------------

--
-- Table structure for table "doc_addnew"
--

CREATE TABLE IF NOT EXISTS "doc_addnew" (
  "doc_addnew_id"            SERIAL,
  "new_doc_name"  VARCHAR(200)  NOT NULL,
  "position"      INT           NOT NULL,
  "status"        INT           NOT NULL DEFAULT 1,
  PRIMARY KEY ("doc_addnew_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "doc_amt"
--

CREATE TABLE IF NOT EXISTS "doc_amt" (
  "doc_amt_id"             SERIAL,
  "doc_id"         VARCHAR(100)      NOT NULL DEFAULT '',
  "fee_id"         INT               NOT NULL DEFAULT 0,
  "amt"            INT               NOT NULL DEFAULT 0,
  "cancelled"      VARCHAR(50)  DEFAULT 'NO',
  "hostel_type"    VARCHAR(50)     DEFAULT 'N',
  "academic_term"  VARCHAR(100)      DEFAULT NULL,
  "fee_det_id"     INT               DEFAULT NULL,
  PRIMARY KEY ("doc_amt_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "doc_detail"
--

CREATE TABLE IF NOT EXISTS "doc_detail" (
  "doc_detail_id"             SERIAL,
  "course_id"      INT           DEFAULT NULL,
  "age"            INT           DEFAULT NULL,
  "sex"            VARCHAR(10)   DEFAULT NULL,
  "adm_type"       INT           DEFAULT NULL,
  "acc_year"       VARCHAR(10)   DEFAULT NULL,
  "doc_name"       VARCHAR(30)   DEFAULT NULL,
  "d_date"         DATE          DEFAULT NULL,
  "complaints"     TEXT,
  "treatment"      TEXT,
  "remarks"        TEXT,
  "stud_id"        VARCHAR(20)   DEFAULT NULL,
  "time"           VARCHAR(20)   DEFAULT NULL,
  "time_1"         VARCHAR(20)   DEFAULT NULL,
  "type"           VARCHAR(255)  DEFAULT NULL,
  "place"          VARCHAR(255)  DEFAULT NULL,
  "name"           VARCHAR(255)  DEFAULT NULL,
  "uploadedfile"   VARCHAR(255)  DEFAULT NULL,
  "healthspring"   VARCHAR(200)  DEFAULT NULL,
  "parents"        VARCHAR(200)  DEFAULT NULL,
  "called"         VARCHAR(200)  DEFAULT NULL,
  "emailed"        VARCHAR(200)  DEFAULT NULL,
  "met_the_child"  VARCHAR(200)  DEFAULT NULL,
  "none"           VARCHAR(200)  DEFAULT NULL,
  "p_called"       VARCHAR(200)  DEFAULT NULL,
  "p_emailed"      VARCHAR(200)  DEFAULT NULL,
  "pick_child"     VARCHAR(200)  DEFAULT NULL,
  "p_none"         VARCHAR(200)  DEFAULT NULL,
  "student_id"     VARCHAR(200)  DEFAULT NULL,
  "user"           VARCHAR(200)  DEFAULT NULL,
  "date_entered"   DATE          DEFAULT NULL,
  "date_modified"  DATE          DEFAULT NULL,
  "sent_by"        VARCHAR(150)  DEFAULT NULL,
  "outcome"        TEXT,
  PRIMARY KEY ("doc_detail_id")
);

--
-- Dumping data for table "doc_detail"
--

INSERT INTO "doc_detail" ("doc_detail_id", "course_id", "age", "sex", "adm_type", "acc_year", "doc_name", "d_date", "complaints", "treatment", "remarks", "stud_id", "time", "time_1", "type", "place", "name", "uploadedfile", "healthspring", "parents", "called", "emailed", "met_the_child", "none", "p_called", "p_emailed", "pick_child", "p_none", "student_id", "user", "date_entered", "date_modified", "sent_by", "outcome") VALUES
(1, NULL, NULL, NULL, NULL, '2026', NULL, '2026-08-22', 'cough', 'warm water given by Lissy', '', 'A676', '00-00-AM', '00-00-AM', 'back to class,Grade Skg', NULL, 'none', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '416', NULL, NULL, NULL, NULL, NULL),
(2, NULL, NULL, NULL, NULL, '2026', NULL, '2026-02-17', 'Lt Eye with redness noted,& Itchy & watery', 'Rose water Instilled & Observed', '', 'A1164', '08-15-AM', '11-20-AM', 'Informed to mother according to her that is usual after bath and it will disappear after 30 min.@09am Informed to Mother to take her home. Sent Home', NULL, 'Mother', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '666', NULL, NULL, NULL, NULL, NULL),
(3, NULL, NULL, NULL, NULL, '2026', NULL, '2026-08-06', 'Had fall,C/o Pain On Forehead Cafeteria -Wet Floor No Bump Or Any Unusual Changes Noted', 'Cold pack Applied & Observed by nurse agnel', '', 'A12205', '1-05-PM', '1-15-PM', 'sent back to class', NULL, 'None', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '580', NULL, NULL, NULL, NULL, NULL),
(4, NULL, NULL, NULL, NULL, '2026', NULL, '2026-08-06', 'Had fall, Rt Foot Hurting No Swelling Or any changes noted', 'Cold pack & Ice gel Applied & Observed by nurse agnel', '', 'A793', '12-40-PM', '1-00-PM', 'Sent back to class', NULL, 'None', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '431', NULL, NULL, NULL, NULL, NULL),
(5, NULL, NULL, NULL, NULL, '2026', NULL, '2026-08-06', 'C/o RT Knee Hurting(Old Fall) Visited x2 to first aid room', 'Cold pack & Ice gel Applied & Observed', '', 'A496', '12-40-PM', '12-55-PM', 'Sent back to Class', NULL, 'None', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '24', NULL, NULL, NULL, NULL, NULL),
(6, NULL, NULL, NULL, NULL, '2026', NULL, '2026-08-06', 'Had fall,Rt & Lt Knee Superficial Graze Noted', 'Cleaned & on Lt Knee B-Aid & on Rt Knee Soframycin Applied by nurse agnel', '', 'A692', '12-30-PM', '12-40-PM', 'Sent back to Class', NULL, 'None', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '311', NULL, NULL, NULL, NULL, NULL),
(7, NULL, NULL, NULL, NULL, '2026', NULL, '2026-08-06', 'C/o Stomachpain & Loose Motion,', 'Electeral water Given and observed by nurse agnel', '', 'A175', '12-30-PM', '2-40-PM', 'Went Home', NULL, 'Mother', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '618', NULL, NULL, NULL, NULL, NULL),
(8, NULL, NULL, NULL, NULL, '2026', NULL, '2026-08-06', 'C/o Nausia, Stomach pain', 'Syr.Crocin 7.5mls & Glu- D Given Observed by Agnelwaz', '', 'A887', '12-15-PM', '1-20-PM', 'sent back to class', NULL, 'Father', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1191', NULL, NULL, NULL, NULL, NULL),
(9, NULL, NULL, NULL, NULL, '2026', NULL, '2026-08-06', 'Unwell On Treatment Had Own medicine Crocin 5mls(Requested By Parent''s)', 'Syr.crocin 5 mls given by nurse agnel', '', 'A938', '12-00-PM', '12-10-PM', 'Sent back to class', NULL, 'none', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1142', NULL, NULL, NULL, NULL, NULL),
(10, NULL, NULL, NULL, NULL, '2026', NULL, '2026-08-06', 'RT Knee skin Peeled(Old Wound)', 'Cleaned, Nebasulf Powder & B-Aid x2 applied & Observed by nurse agnel', '', 'A845', '11-30-AM', '11-45-AM', 'sent back to class', NULL, 'None', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '213', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table "doc_detail_backup"
--

CREATE TABLE IF NOT EXISTS "doc_detail_backup" (
  "doc_detail_backup_id"             INT           NOT NULL DEFAULT 0,
  "course_id"      INT           DEFAULT NULL,
  "age"            INT           DEFAULT NULL,
  "sex"            VARCHAR(10)   DEFAULT NULL,
  "adm_type"       INT           DEFAULT NULL,
  "acc_year"       VARCHAR(10)   DEFAULT NULL,
  "doc_name"       VARCHAR(30)   DEFAULT NULL,
  "d_date"         DATE          DEFAULT NULL,
  "complaints"     TEXT,
  "treatment"      TEXT,
  "remarks"        TEXT,
  "stud_id"        VARCHAR(20)   DEFAULT NULL,
  "time"           VARCHAR(20)   DEFAULT NULL,
  "time_1"         VARCHAR(20)   DEFAULT NULL,
  "type"           VARCHAR(255)  DEFAULT NULL,
  "place"          VARCHAR(255)  DEFAULT NULL,
  "name"           VARCHAR(255)  DEFAULT NULL,
  "uploadedfile"   VARCHAR(255)  DEFAULT NULL,
  "healthspring"   VARCHAR(200)  DEFAULT NULL,
  "parents"        VARCHAR(200)  DEFAULT NULL,
  "called"         VARCHAR(200)  DEFAULT NULL,
  "emailed"        VARCHAR(200)  DEFAULT NULL,
  "met_the_child"  VARCHAR(200)  DEFAULT NULL,
  "none"           VARCHAR(200)  DEFAULT NULL,
  "p_called"       VARCHAR(200)  DEFAULT NULL,
  "p_emailed"      VARCHAR(200)  DEFAULT NULL,
  "pick_child"     VARCHAR(200)  DEFAULT NULL,
  "p_none"         VARCHAR(200)  DEFAULT NULL,
  "student_id"     VARCHAR(200)  DEFAULT NULL,
  PRIMARY KEY ("doc_detail_backup_id")
);

--
-- Dumping data for table "doc_detail_backup"
--

INSERT INTO "doc_detail_backup" ("doc_detail_backup_id", "course_id", "age", "sex", "adm_type", "acc_year", "doc_name", "d_date", "complaints", "treatment", "remarks", "stud_id", "time", "time_1", "type", "place", "name", "uploadedfile", "healthspring", "parents", "called", "emailed", "met_the_child", "none", "p_called", "p_emailed", "pick_child", "p_none", "student_id") VALUES
(1, NULL, NULL, NULL, NULL, NULL, NULL, '2026-08-22', 'cough', 'warm water given by Lissy', 'back to class,Grade Skg', 'A676', '00-00-AM', '00-00-AM', NULL, NULL, 'none', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-17', 'Lt Eye with redness noted,& Itchy & watery', 'Rose water Instilled & Observed', 'Informed to mother according to her that is usual after bath and it will disappear after 30 min.@09am Informed to Mother to take her home. Sent Home', 'A1164', '08-15-AM', '11-20-AM', NULL, NULL, 'Mother', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, NULL, NULL, NULL, NULL, NULL, NULL, '2026-08-06', 'Had fall,C/o Pain On Forehead Cafeteria -Wet Floor No Bump Or Any Unusual Changes Noted', 'Cold pack Applied & Observed by nurse agnel', 'sent back to class', 'A12205', '1-05-PM', '1-15-PM', NULL, NULL, 'None', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, NULL, NULL, NULL, NULL, NULL, NULL, '2026-08-06', 'Had fall, Rt Foot Hurting No Swelling Or any changes noted', 'Cold pack & Ice gel Applied & Observed by nurse agnel', 'Sent back to class', 'A793', '12-40-PM', '1-00-PM', NULL, NULL, 'None', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, NULL, NULL, NULL, NULL, NULL, NULL, '2026-08-06', 'C/o RT Knee Hurting(Old Fall) Visited x2 to first aid room', 'Cold pack & Ice gel Applied & Observed', 'Sent back to Class', 'A496', '12-40-PM', '12-55-PM', NULL, NULL, 'None', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, NULL, NULL, NULL, NULL, NULL, NULL, '2026-08-06', 'Had fall,Rt & Lt Knee Superficial Graze Noted', 'Cleaned & on Lt Knee B-Aid & on Rt Knee Soframycin Applied by nurse agnel', 'Sent back to Class', 'A692', '12-30-PM', '12-40-PM', NULL, NULL, 'None', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(7, NULL, NULL, NULL, NULL, NULL, NULL, '2026-08-06', 'C/o Stomachpain & Loose Motion,', 'Electeral water Given and observed by nurse agnel', 'Went Home', 'A175', '12-30-PM', '2-40-PM', NULL, NULL, 'Mother', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(8, NULL, NULL, NULL, NULL, NULL, NULL, '2026-08-06', 'C/o Nausia, Stomach pain', 'Syr.Crocin 7.5mls & Glu- D Given Observed by Agnelwaz', 'sent back to class', 'A887', '12-15-PM', '1-20-PM', NULL, NULL, 'Father', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(9, NULL, NULL, NULL, NULL, NULL, NULL, '2026-08-06', 'Unwell On Treatment Had Own medicine Crocin 5mls(Requested By Parent''s)', 'Syr.crocin 5 mls given by nurse agnel', 'Sent back to class', 'A938', '12-00-PM', '12-10-PM', NULL, NULL, 'none', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(10, NULL, NULL, NULL, NULL, NULL, NULL, '2026-08-06', 'RT Knee skin Peeled(Old Wound)', 'Cleaned, Nebasulf Powder & B-Aid x2 applied & Observed by nurse agnel', 'sent back to class', 'A845', '11-30-AM', '11-45-AM', NULL, NULL, 'None', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table "doc_instr"
--

CREATE TABLE IF NOT EXISTS "doc_instr" (
  "doc_instr_id"           SERIAL,
  "doc_id"       VARCHAR(50)  NOT NULL DEFAULT '',
  "instr_id"     INT          NOT NULL DEFAULT 0,
  "instr_no"     INT          NOT NULL DEFAULT 0,
  "instr_dt"     VARCHAR(50)  NOT NULL DEFAULT '',
  "amt"          INT          NOT NULL DEFAULT 0,
  "status"       VARCHAR(10)  NOT NULL DEFAULT '',
  "bank_name"    VARCHAR(50)  NOT NULL DEFAULT '',
  "branch_name"  VARCHAR(50)  NOT NULL DEFAULT '',
  PRIMARY KEY ("doc_instr_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "doc_instr1"
--

CREATE TABLE IF NOT EXISTS "doc_instr1" (
  "doc_instr1_id"           INT       NOT NULL DEFAULT 0,
  "doc_id"       CHAR(50)  NOT NULL DEFAULT '',
  "instr_id"     INT       NOT NULL DEFAULT 0,
  "instr_no"     INT       NOT NULL DEFAULT 0,
  "instr_dt"     CHAR(50)  NOT NULL DEFAULT '',
  "amt"          INT       NOT NULL DEFAULT 0,
  "status"       CHAR(10)  NOT NULL DEFAULT '',
  "bank_name"    CHAR(50)  NOT NULL DEFAULT '',
  "branch_name"  CHAR(50)  NOT NULL DEFAULT '',
  PRIMARY KEY ("doc_instr1_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "doc_lno"
--

CREATE TABLE IF NOT EXISTS "doc_lno" (
  "doc_lno_id"           SERIAL,
  "reciept_no"   INT  NOT NULL DEFAULT 0,
  "payorder_no"  INT  NOT NULL DEFAULT 0,
  "transfer_no"  INT  NOT NULL DEFAULT 0,
  "payslip_no"   INT  NOT NULL DEFAULT 0,
  PRIMARY KEY ("doc_lno_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "doc_m"
--

CREATE TABLE IF NOT EXISTS "doc_m" (
  "doc_m_id"          SERIAL,
  "doc_id"      VARCHAR(50)       NOT NULL DEFAULT '',
  "doc_date"    DATE              DEFAULT NULL,
  "doc_status"  VARCHAR(50)       NOT NULL DEFAULT '',
  "mode_id"     INT               NOT NULL DEFAULT 0,
  "doc_amt"     INT               NOT NULL DEFAULT 0,
  "cashier_id"  VARCHAR(50)       NOT NULL DEFAULT '',
  "stud_id"     VARCHAR(50)       NOT NULL DEFAULT '',
  "print_org"   INT               NOT NULL DEFAULT 0,
  "print_dup"   INT               NOT NULL DEFAULT 0,
  "remark"      VARCHAR(50)       DEFAULT NULL,
  "doc_type"    VARCHAR(50)       NOT NULL DEFAULT '',
  "isfine"      INT               NOT NULL DEFAULT 0,
  "cancelled"   VARCHAR(50)  DEFAULT 'NO',
  "accno"       VARCHAR(25)       DEFAULT NULL,
  "comp_no"     VARCHAR(25)       DEFAULT NULL,
  "course_id"   INT               DEFAULT 0,
  "year_id"     INT               DEFAULT 0,
  PRIMARY KEY ("doc_m_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "doc_m1"
--

CREATE TABLE IF NOT EXISTS "doc_m1" (
  "doc_m1_id"          INT               NOT NULL DEFAULT 0,
  "doc_id"      CHAR(50)          NOT NULL DEFAULT '',
  "doc_date"    DATE              DEFAULT NULL,
  "doc_status"  CHAR(50)          NOT NULL DEFAULT '',
  "mode_id"     INT               NOT NULL DEFAULT 0,
  "doc_amt"     INT               NOT NULL DEFAULT 0,
  "cashier_id"  CHAR(50)          NOT NULL DEFAULT '',
  "stud_id"     CHAR(50)          NOT NULL DEFAULT '',
  "print_org"   INT               NOT NULL DEFAULT 0,
  "print_dup"   INT               NOT NULL DEFAULT 0,
  "remark"      CHAR(50)          DEFAULT NULL,
  "doc_type"    CHAR(50)          NOT NULL DEFAULT '',
  "isfine"      INT               NOT NULL DEFAULT 0,
  "cancelled"   VARCHAR(50)  DEFAULT 'NO',
  "accno"       CHAR(25)          DEFAULT NULL,
  "comp_no"     CHAR(25)          DEFAULT NULL,
  "course_id"   INT               DEFAULT 0,
  "year_id"     INT               DEFAULT 0,
  PRIMARY KEY ("doc_m1_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "doc_other"
--

CREATE TABLE IF NOT EXISTS "doc_other" (
  "doc_other_id"           SERIAL,
  "doc_name"     VARCHAR(30)  DEFAULT NULL,
  "d_date"       DATE         DEFAULT NULL,
  "complaints"   TEXT,
  "treatment"    TEXT,
  "remarks"      TEXT,
  "slno"         VARCHAR(20)  DEFAULT NULL,
  "time"         VARCHAR(20)  DEFAULT NULL,
  "name"         VARCHAR(30)  DEFAULT NULL,
  "designation"  VARCHAR(30)  DEFAULT NULL,
  PRIMARY KEY ("doc_other_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "doc_staff"
--

CREATE TABLE IF NOT EXISTS "doc_staff" (
  "doc_staff_id"          SERIAL,
  "sex"         VARCHAR(10)  DEFAULT NULL,
  "acc_year"    VARCHAR(10)  DEFAULT NULL,
  "doc_name"    VARCHAR(30)  DEFAULT NULL,
  "d_date"      DATE         DEFAULT NULL,
  "complaints"  TEXT,
  "treatment"   TEXT,
  "remarks"     TEXT,
  "slno"        VARCHAR(20)  DEFAULT NULL,
  "time"        VARCHAR(20)  DEFAULT NULL,
  "group_id"    INT          DEFAULT NULL,
  "des_id"      INT          DEFAULT NULL,
  PRIMARY KEY ("doc_staff_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "doc_visit"
--

CREATE TABLE IF NOT EXISTS "doc_visit" (
  "doc_visit_id"             SERIAL,
  "course_id"      INT           DEFAULT NULL,
  "age"            INT           DEFAULT NULL,
  "sex"            VARCHAR(10)   DEFAULT NULL,
  "adm_type"       INT           DEFAULT NULL,
  "acc_year"       VARCHAR(10)   DEFAULT NULL,
  "doc_name"       VARCHAR(30)   DEFAULT NULL,
  "d_date"         DATE          DEFAULT NULL,
  "complaints"     TEXT,
  "treatment"      TEXT,
  "remarks"        TEXT,
  "stud_id"        VARCHAR(20)   DEFAULT NULL,
  "time"           VARCHAR(20)   DEFAULT NULL,
  "time_1"         VARCHAR(20)   DEFAULT NULL,
  "type"           VARCHAR(255)  DEFAULT NULL,
  "place"          VARCHAR(255)  DEFAULT NULL,
  "name"           VARCHAR(255)  DEFAULT NULL,
  "uploadedfile"   VARCHAR(255)  DEFAULT NULL,
  "healthspring"   VARCHAR(200)  DEFAULT NULL,
  "parents"        VARCHAR(200)  DEFAULT NULL,
  "called"         VARCHAR(200)  DEFAULT NULL,
  "emailed"        VARCHAR(200)  DEFAULT NULL,
  "met_the_child"  VARCHAR(200)  DEFAULT NULL,
  "none"           VARCHAR(200)  DEFAULT NULL,
  "p_called"       VARCHAR(200)  DEFAULT NULL,
  "p_emailed"      VARCHAR(200)  DEFAULT NULL,
  "pick_child"     VARCHAR(200)  DEFAULT NULL,
  "p_none"         VARCHAR(200)  DEFAULT NULL,
  "student_id"     VARCHAR(200)  DEFAULT NULL,
  "user"           VARCHAR(200)  DEFAULT NULL,
  "date_entered"   DATE          DEFAULT NULL,
  "date_modified"  DATE          DEFAULT NULL,
  "sent_by"        VARCHAR(150)  DEFAULT NULL,
  "outcome"        TEXT,
  PRIMARY KEY ("doc_visit_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "dp_exam_sub_m"
--

CREATE TABLE IF NOT EXISTS "dp_exam_sub_m" (
  "dp_exam_sub_m_id"             SERIAL,
  "exam_id"        INT          DEFAULT NULL,
  "exam_name"      VARCHAR(75)  NOT NULL,
  "from"           DATE         NOT NULL,
  "to"             DATE         NOT NULL,
  "examtype"       INT          NOT NULL,
  "exam_sub_name"  VARCHAR(50)  NOT NULL,
  "subject_id"     INT          NOT NULL,
  "acc_year"       INT          NOT NULL,
  "section"        INT          NOT NULL,
  "weight"         INT          NOT NULL,
  "mark"           INT          NOT NULL,
  "class"          INT          NOT NULL,
  "status"         SMALLINT   NOT NULL,
  "order_id"       INT          NOT NULL,
  "per_info"       INT          NOT NULL,
  PRIMARY KEY ("dp_exam_sub_m_id")
);

--
-- Dumping data for table "dp_exam_sub_m"
--

INSERT INTO "dp_exam_sub_m" ("dp_exam_sub_m_id", "exam_id", "exam_name", "from", "to", "examtype", "exam_sub_name", "subject_id", "acc_year", "section", "weight", "mark", "class", "status", "order_id", "per_info") VALUES
(1, 1, 'End of  Unit Inquiry Report', '2026-09-26', '2026-09-30', 0, 'UOI', 0, 2026, 0, 0, 0, 1, 1, 2, 0),
(2, 2, 'End of Unit of Inquiry Report ', '2026-09-23', '2026-10-31', 0, 'UOI', 0, 2026, 0, 0, 0, 3, 1, 2, 0),
(3, 0, 'First Unit of Inquiry ', '2026-09-23', '2026-10-31', 0, 'UOI - Ist', 0, 2026, 0, 0, 0, 2, 1, 1, 0),
(4, 3, 'End of Unit of Inquiry Report ', '2026-09-23', '2026-10-31', 0, 'UOI', 0, 2026, 0, 0, 0, 2, 1, 2, 0),
(12, 10, 'End of  Unit Inquiry Report', '2026-10-03', '2026-10-04', 0, 'UOI', 0, 2026, 0, 0, 0, 1, 1, 1, 0),
(5, 0, 'End of Unit of Inquiry Report - 1', '2026-09-23', '2026-10-31', 0, 'Unit 1 - Our actions ', 0, 2026, 0, 0, 0, 4, 1, 1, 0),
(6, 4, 'End of Unit of Inquiry Report ', '2026-09-23', '2026-10-31', 0, 'UOI', 0, 2026, 0, 0, 0, 4, 1, 2, 0),
(7, 5, 'End of Unit of Inquiry Report ', '2026-09-23', '2026-10-31', 0, 'UOI', 0, 2026, 0, 0, 0, 5, 1, 2, 0),
(8, 6, 'End of Unit of Inquiry Report ', '2026-09-23', '2026-10-31', 0, 'UOI', 0, 2026, 0, 0, 0, 6, 1, 2, 0),
(9, 7, 'End of Unit of Inquiry Report ', '2026-09-23', '2026-10-31', 0, 'UOI', 0, 2026, 0, 0, 0, 7, 1, 2, 0),
(10, 8, 'End of Unit of Inquiry Report ', '2026-09-23', '2026-10-31', 0, 'UOI', 0, 2026, 0, 0, 0, 8, 1, 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table "driver_master"
--

CREATE TABLE IF NOT EXISTS "driver_master" (
  "driver_master_id"                SERIAL,
  "driver_name"       VARCHAR(50)   DEFAULT NULL,
  "personal_details"  VARCHAR(50)   DEFAULT NULL,
  "date_of_join"      DATE          DEFAULT NULL,
  "address"           VARCHAR(200)  DEFAULT NULL,
  "experiance_yrs"    INT           DEFAULT NULL,
  "licence_det"       VARCHAR(50)   DEFAULT NULL,
  "reneval_det"       VARCHAR(50)   DEFAULT NULL,
  PRIMARY KEY ("driver_master_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "d_att_0"
--

CREATE TABLE IF NOT EXISTS "d_att_0" (
  "d_att_0_id"          BIGINT              NOT NULL DEFAULT 0,
  "subject_id"  INTEGER  NOT NULL,
  "username"    VARCHAR(100)        NOT NULL,
  "att_date"    DATE                NOT NULL,
  "stu_id"      BIGINT              NOT NULL,
  "sec"         SMALLINT   NOT NULL,
  "mor"         SMALLINT          NOT NULL,
  "after"       SMALLINT          NOT NULL,
  "att_desc"    VARCHAR(250)        NOT NULL,
  PRIMARY KEY ("d_att_0_id")
);

--
-- Dumping data for table "d_att_0"
--

INSERT INTO "d_att_0" ("d_att_0_id", "subject_id", "username", "att_date", "stu_id", "sec", "mor", "after", "att_desc") VALUES
(501, 412, 'nehap', '2026-10-21', 14, 1072, 1, 1, ''),
(502, 412, 'nehap', '2026-10-21', 308, 1072, 1, 1, ''),
(503, 412, 'nehap', '2026-10-21', 671, 1072, 1, 1, '');

-- --------------------------------------------------------

--
-- Table structure for table "d_att_1"
--

CREATE TABLE IF NOT EXISTS "d_att_1" (
  "d_att_1_id"          BIGINT              NOT NULL DEFAULT 0,
  "subject_id"  INTEGER  NOT NULL,
  "username"    VARCHAR(100)        NOT NULL,
  "att_date"    DATE                NOT NULL,
  "stu_id"      BIGINT              NOT NULL,
  "sec"         SMALLINT   NOT NULL,
  "mor"         SMALLINT          NOT NULL,
  "after"       SMALLINT          NOT NULL,
  "att_desc"    VARCHAR(250)        NOT NULL,
  PRIMARY KEY ("d_att_1_id")
);

--
-- Dumping data for table "d_att_1"
--

INSERT INTO "d_att_1" ("d_att_1_id", "subject_id", "username", "att_date", "stu_id", "sec", "mor", "after", "att_desc") VALUES
(1, 237, 'nasreens', '2026-08-21', 522, 64, 1, 1, ' 08:44:57'),
(2, 237, 'nasreens', '2026-08-21', 523, 64, 1, 1, ' 08:45:00,  08:45:01'),
(3, 237, 'nasreens', '2026-08-21', 892, 64, 1, 1, ' 08:46:18'),
(4, 237, 'nasreens', '2026-08-21', 220, 64, 1, 1, ' 08:49:58'),
(5, 237, 'nasreens', '2026-08-21', 7, 64, 1, 1, ' 08:50:49'),
(6, 237, 'nasreens', '2026-08-21', 92, 64, 1, 1, ' 08:51:28'),
(7, 237, 'nasreens', '2026-08-21', 1314, 64, 1, 1, ' 08:53:24'),
(8, 237, 'nasreens', '2026-08-21', 1005, 64, 1, 1, ' 08:57:40'),
(9, 237, 'nasreens', '2026-08-21', 1151, 64, 1, 1, ' 09:06:50'),
(10, 237, 'nasreens', '2026-08-21', 1132, 64, 0, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table "d_att_2"
--

CREATE TABLE IF NOT EXISTS "d_att_2" (
  "d_att_2_id"          BIGINT              NOT NULL DEFAULT 0,
  "subject_id"  INTEGER  NOT NULL,
  "username"    VARCHAR(100)        NOT NULL,
  "att_date"    DATE                NOT NULL,
  "stu_id"      BIGINT              NOT NULL,
  "sec"         SMALLINT   NOT NULL,
  "mor"         SMALLINT          NOT NULL,
  "after"       SMALLINT          NOT NULL,
  "att_desc"    VARCHAR(250)        NOT NULL,
  PRIMARY KEY ("d_att_2_id")
);

--
-- Dumping data for table "d_att_2"
--

INSERT INTO "d_att_2" ("d_att_2_id", "subject_id", "username", "att_date", "stu_id", "sec", "mor", "after", "att_desc") VALUES
(1, 232, 'asavarid', '2026-09-04', 898, 98, 1, 1, ''),
(2, 232, 'asavarid', '2026-09-04', 390, 98, 1, 1, ''),
(3, 232, 'asavarid', '2026-09-04', 1270, 98, 1, 1, ''),
(4, 232, 'asavarid', '2026-09-04', 327, 98, 1, 1, ''),
(5, 232, 'asavarid', '2026-09-04', 241, 98, 1, 1, ''),
(6, 232, 'asavarid', '2026-09-04', 1033, 98, 1, 1, ''),
(7, 232, 'asavarid', '2026-09-04', 624, 98, 1, 1, ''),
(8, 232, 'asavarid', '2026-09-04', 702, 98, 1, 1, ''),
(9, 232, 'asavarid', '2026-09-04', 134, 98, 0, 0, ''),
(10, 232, 'asavarid', '2026-09-04', 225, 98, 1, 1, '');

-- --------------------------------------------------------

--
-- Table structure for table "d_att_3"
--

CREATE TABLE IF NOT EXISTS "d_att_3" (
  "d_att_3_id"          BIGINT              NOT NULL DEFAULT 0,
  "subject_id"  INTEGER  NOT NULL,
  "username"    VARCHAR(100)        NOT NULL,
  "att_date"    DATE                NOT NULL,
  "stu_id"      BIGINT              NOT NULL,
  "sec"         SMALLINT   NOT NULL,
  "mor"         SMALLINT          NOT NULL,
  "after"       SMALLINT          NOT NULL,
  "att_desc"    VARCHAR(250)        NOT NULL,
  PRIMARY KEY ("d_att_3_id")
);

--
-- Dumping data for table "d_att_3"
--

INSERT INTO "d_att_3" ("d_att_3_id", "subject_id", "username", "att_date", "stu_id", "sec", "mor", "after", "att_desc") VALUES
(1, 313, 'nalinis', '2026-12-03', 1077, 1236, 1, 1, ''),
(2, 313, 'nalinis', '2026-12-03', 1202, 1236, 1, 1, ''),
(3, 313, 'nalinis', '2026-12-03', 1053, 1236, 1, 1, ''),
(4, 313, 'nalinis', '2026-12-03', 391, 1236, 1, 1, ''),
(5, 313, 'nalinis', '2026-12-03', 13, 1236, 1, 1, ''),
(6, 313, 'nalinis', '2026-12-03', 907, 1236, 1, 1, ''),
(7, 313, 'nalinis', '2026-12-03', 1198, 1236, 1, 1, ''),
(8, 313, 'nalinis', '2026-12-03', 1337, 1236, 1, 1, ''),
(9, 313, 'nalinis', '2026-12-03', 409, 1236, 1, 1, ''),
(10, 313, 'nalinis', '2026-12-03', 362, 1236, 1, 1, '');

-- --------------------------------------------------------

--
-- Table structure for table "d_att_4"
--

CREATE TABLE IF NOT EXISTS "d_att_4" (
  "d_att_4_id"          BIGINT              NOT NULL DEFAULT 0,
  "subject_id"  INTEGER  NOT NULL,
  "username"    VARCHAR(100)        NOT NULL,
  "att_date"    DATE                NOT NULL,
  "stu_id"      BIGINT              NOT NULL,
  "sec"         SMALLINT   NOT NULL,
  "mor"         SMALLINT          NOT NULL,
  "after"       SMALLINT          NOT NULL,
  "att_desc"    VARCHAR(250)        NOT NULL,
  PRIMARY KEY ("d_att_4_id")
);

--
-- Dumping data for table "d_att_4"
--

INSERT INTO "d_att_4" ("d_att_4_id", "subject_id", "username", "att_date", "stu_id", "sec", "mor", "after", "att_desc") VALUES
(1102, 244, 'RFID', '2026-08-14', 463, 113, 1, 0, ' 08:08:21'),
(1103, 244, 'RFID', '2026-08-14', 1218, 113, 1, 0, ' 08:09:37');

-- --------------------------------------------------------

--
-- Table structure for table "d_att_5"
--

CREATE TABLE IF NOT EXISTS "d_att_5" (
  "d_att_5_id"          BIGINT              NOT NULL DEFAULT 0,
  "subject_id"  INTEGER  NOT NULL,
  "username"    VARCHAR(100)        NOT NULL,
  "att_date"    DATE                NOT NULL,
  "stu_id"      BIGINT              NOT NULL,
  "sec"         SMALLINT   NOT NULL,
  "mor"         SMALLINT          NOT NULL,
  "after"       SMALLINT          NOT NULL,
  "att_desc"    VARCHAR(250)        NOT NULL,
  PRIMARY KEY ("d_att_5_id")
);

--
-- Dumping data for table "d_att_5"
--

INSERT INTO "d_att_5" ("d_att_5_id", "subject_id", "username", "att_date", "stu_id", "sec", "mor", "after", "att_desc") VALUES
(3906, 256, 'iffatk', '2026-09-27', 924, 118, 1, 1, ''),
(3907, 256, 'iffatk', '2026-09-27', 280, 118, 1, 1, ''),
(3908, 256, 'iffatk', '2026-09-27', 660, 118, 1, 1, ''),
(3909, 256, 'iffatk', '2026-09-27', 868, 118, 1, 1, ''),
(3910, 256, 'iffatk', '2026-09-27', 605, 118, 1, 1, ''),
(3911, 256, 'iffatk', '2026-09-27', 727, 118, 1, 1, ''),
(3912, 256, 'iffatk', '2026-09-27', 1056, 118, 1, 1, ''),
(3913, 256, 'iffatk', '2026-09-27', 366, 118, 1, 1, ''),
(3914, 256, 'iffatk', '2026-09-27', 415, 118, 1, 1, ''),
(3915, 256, 'iffatk', '2026-09-27', 733, 118, 1, 1, '');

-- --------------------------------------------------------

--
-- Table structure for table "d_att_7"
--

CREATE TABLE IF NOT EXISTS "d_att_7" (
  "d_att_7_id"          BIGINT              NOT NULL DEFAULT 0,
  "subject_id"  INTEGER  NOT NULL,
  "username"    VARCHAR(100)        NOT NULL,
  "att_date"    DATE                NOT NULL,
  "stu_id"      BIGINT              NOT NULL,
  "sec"         SMALLINT   NOT NULL,
  "mor"         SMALLINT          NOT NULL,
  "after"       SMALLINT          NOT NULL,
  "att_desc"    VARCHAR(250)        NOT NULL,
  PRIMARY KEY ("d_att_7_id")
);

--
-- Dumping data for table "d_att_7"
--

INSERT INTO "d_att_7" ("d_att_7_id", "subject_id", "username", "att_date", "stu_id", "sec", "mor", "after", "att_desc") VALUES
(11157, 30, 'RFID', '2026-01-24', 721, 127, 1, 0, ' 07:43:24,  07:43:24,  07:43:24'),
(11160, 30, 'RFID', '2026-01-24', 880, 127, 1, 0, ' 07:44:46,  07:44:46,  07:44:46'),
(11162, 30, 'RFID', '2026-01-24', 459, 127, 1, 0, ' 07:45:04,  07:45:04');

-- --------------------------------------------------------

--
-- Table structure for table "d_att_8"
--

CREATE TABLE IF NOT EXISTS "d_att_8" (
  "d_att_8_id"          BIGINT              NOT NULL DEFAULT 0,
  "subject_id"  INTEGER  NOT NULL,
  "username"    VARCHAR(100)        NOT NULL,
  "att_date"    DATE                NOT NULL,
  "stu_id"      BIGINT              NOT NULL,
  "sec"         SMALLINT   NOT NULL,
  "mor"         SMALLINT          NOT NULL,
  "after"       SMALLINT          NOT NULL,
  "att_desc"    VARCHAR(250)        NOT NULL,
  PRIMARY KEY ("d_att_8_id")
);

--
-- Dumping data for table "d_att_8"
--

INSERT INTO "d_att_8" ("d_att_8_id", "subject_id", "username", "att_date", "stu_id", "sec", "mor", "after", "att_desc") VALUES
(4903, 41, 'ramonaf', '2026-10-21', 252, 132, 1, 1, ''),
(4904, 41, 'ramonaf', '2026-10-21', 258, 132, 1, 1, ''),
(4905, 41, 'ramonaf', '2026-10-21', 1262, 132, 0, 0, ''),
(4906, 41, 'ramonaf', '2026-10-21', 771, 132, 0, 0, ''),
(4907, 41, 'ramonaf', '2026-10-21', 1098, 132, 1, 1, ''),
(4908, 41, 'ramonaf', '2026-10-21', 607, 132, 0, 0, ''),
(4909, 41, 'ramonaf', '2026-10-21', 139, 132, 0, 0, ''),
(4910, 41, 'ramonaf', '2026-10-21', 490, 132, 1, 1, ''),
(4911, 41, 'ramonaf', '2026-10-21', 123, 132, 1, 1, ''),
(4912, 41, 'ramonaf', '2026-10-21', 186, 132, 1, 1, '');

-- --------------------------------------------------------

--
-- Table structure for table "d_att_9"
--

CREATE TABLE IF NOT EXISTS "d_att_9" (
  "d_att_9_id"          BIGINT              NOT NULL DEFAULT 0,
  "subject_id"  INTEGER  NOT NULL,
  "username"    VARCHAR(100)        NOT NULL,
  "att_date"    DATE                NOT NULL,
  "stu_id"      BIGINT              NOT NULL,
  "sec"         SMALLINT   NOT NULL,
  "mor"         SMALLINT          NOT NULL,
  "after"       SMALLINT          NOT NULL,
  "att_desc"    VARCHAR(250)        NOT NULL,
  PRIMARY KEY ("d_att_9_id")
);

--
-- Dumping data for table "d_att_9"
--

INSERT INTO "d_att_9" ("d_att_9_id", "subject_id", "username", "att_date", "stu_id", "sec", "mor", "after", "att_desc") VALUES
(3634, 58, 'medhaj', '2026-10-05', 945, 139, 1, 1, ' 13:05:37'),
(7167, 58, 'medhaj', '2026-10-05', 483, 139, 1, 1, ''),
(7168, 58, 'medhaj', '2026-10-05', 589, 139, 1, 1, ''),
(7169, 58, 'medhaj', '2026-10-05', 480, 139, 1, 1, ''),
(7170, 58, 'medhaj', '2026-10-05', 1136, 139, 1, 1, ''),
(7171, 58, 'medhaj', '2026-10-05', 953, 139, 1, 1, ''),
(7172, 58, 'medhaj', '2026-10-05', 431, 139, 1, 1, ''),
(7173, 58, 'medhaj', '2026-10-05', 834, 139, 1, 1, ''),
(7174, 58, 'medhaj', '2026-10-05', 996, 139, 1, 1, '');

-- --------------------------------------------------------

--
-- Table structure for table "d_att_10"
--

CREATE TABLE IF NOT EXISTS "d_att_10" (
  "d_att_10_id"          BIGINT              NOT NULL DEFAULT 0,
  "subject_id"  INTEGER  NOT NULL,
  "username"    VARCHAR(100)        NOT NULL,
  "att_date"    DATE                NOT NULL,
  "stu_id"      BIGINT              NOT NULL,
  "sec"         SMALLINT   NOT NULL,
  "mor"         SMALLINT          NOT NULL,
  "after"       SMALLINT          NOT NULL,
  "att_desc"    VARCHAR(250)        NOT NULL,
  PRIMARY KEY ("d_att_10_id")
);

--
-- Dumping data for table "d_att_10"
--

INSERT INTO "d_att_10" ("d_att_10_id", "subject_id", "username", "att_date", "stu_id", "sec", "mor", "after", "att_desc") VALUES
(3453, 72, 'moitreyeem', '2026-08-21', 267, 336, 1, 1, ''),
(3454, 72, 'moitreyeem', '2026-08-21', 971, 336, 1, 1, ''),
(3455, 72, 'moitreyeem', '2026-08-21', 2, 336, 1, 1, ''),
(3456, 72, 'moitreyeem', '2026-08-21', 1008, 336, 1, 1, ''),
(3457, 72, 'moitreyeem', '2026-08-21', 470, 336, 1, 1, ''),
(3458, 72, 'moitreyeem', '2026-08-21', 213, 336, 1, 1, ''),
(3459, 72, 'moitreyeem', '2026-08-21', 1123, 336, 1, 1, ''),
(3460, 72, 'moitreyeem', '2026-08-21', 656, 336, 1, 1, ''),
(3461, 72, 'moitreyeem', '2026-08-21', 548, 336, 1, 1, ''),
(3462, 72, 'moitreyeem', '2026-08-21', 313, 336, 1, 1, '');

-- --------------------------------------------------------

--
-- Table structure for table "d_att_11"
--

CREATE TABLE IF NOT EXISTS "d_att_11" (
  "d_att_11_id"          BIGINT              NOT NULL DEFAULT 0,
  "subject_id"  INTEGER  NOT NULL,
  "username"    VARCHAR(100)        NOT NULL,
  "att_date"    DATE                NOT NULL,
  "stu_id"      BIGINT              NOT NULL,
  "sec"         SMALLINT   NOT NULL,
  "mor"         SMALLINT          NOT NULL,
  "after"       SMALLINT          NOT NULL,
  "att_desc"    VARCHAR(250)        NOT NULL,
  PRIMARY KEY ("d_att_11_id")
);

--
-- Dumping data for table "d_att_11"
--

INSERT INTO "d_att_11" ("d_att_11_id", "subject_id", "username", "att_date", "stu_id", "sec", "mor", "after", "att_desc") VALUES
(2167, 93, 'dianar', '2026-08-13', 1237, 222, 1, 1, ''),
(2168, 93, 'dianar', '2026-08-13', 54, 222, 1, 1, ''),
(2169, 93, 'dianar', '2026-08-13', 942, 222, 1, 1, ''),
(2170, 93, 'dianar', '2026-08-13', 598, 222, 1, 1, ''),
(2171, 93, 'dianar', '2026-08-13', 403, 222, 1, 1, ''),
(2172, 93, 'dianar', '2026-08-13', 711, 222, 1, 1, ''),
(2173, 93, 'dianar', '2026-08-13', 1127, 222, 1, 1, ''),
(2174, 93, 'dianar', '2026-08-13', 353, 222, 1, 1, ''),
(2175, 93, 'dianar', '2026-08-13', 1268, 222, 1, 1, ''),
(2176, 93, 'dianar', '2026-08-13', 349, 222, 1, 1, '');


-- --------------------------------------------------------

--
-- Table structure for table "d_att_12"
--

CREATE TABLE IF NOT EXISTS "d_att_12" (
  "d_att_12_id"          BIGINT              NOT NULL DEFAULT 0,
  "subject_id"  INTEGER  NOT NULL,
  "username"    VARCHAR(100)        NOT NULL,
  "att_date"    DATE                NOT NULL,
  "stu_id"      BIGINT              NOT NULL,
  "sec"         SMALLINT   NOT NULL,
  "mor"         SMALLINT          NOT NULL,
  "after"       SMALLINT          NOT NULL,
  "att_desc"    VARCHAR(250)        NOT NULL,
  PRIMARY KEY ("d_att_12_id")
);

--
-- Dumping data for table "d_att_12"
--

INSERT INTO "d_att_12" ("d_att_12_id", "subject_id", "username", "att_date", "stu_id", "sec", "mor", "after", "att_desc") VALUES
(1031, 281, 'shilpak', '2026-08-06', 1051, 218, 1, 1, ''),
(1032, 281, 'shilpak', '2026-08-06', 597, 218, 1, 1, ''),
(1033, 281, 'shilpak', '2026-08-06', 364, 218, 1, 1, ''),
(1034, 281, 'shilpak', '2026-08-06', 1119, 218, 1, 1, ''),
(1035, 281, 'shilpak', '2026-08-06', 1111, 218, 1, 1, ''),
(1036, 281, 'shilpak', '2026-08-06', 66, 218, 1, 1, ''),
(1037, 281, 'shilpak', '2026-08-06', 1321, 218, 1, 1, ''),
(1038, 281, 'shilpak', '2026-08-06', 1289, 218, 1, 1, ''),
(1039, 281, 'shilpak', '2026-08-06', 516, 218, 1, 1, ''),
(1040, 281, 'shilpak', '2026-08-06', 567, 218, 1, 1, '');

-- --------------------------------------------------------

--
-- Table structure for table "d_att_13"
--

CREATE TABLE IF NOT EXISTS "d_att_13" (
  "d_att_13_id"          BIGINT              NOT NULL DEFAULT 0,
  "subject_id"  INTEGER  NOT NULL,
  "username"    VARCHAR(100)        NOT NULL,
  "att_date"    DATE                NOT NULL,
  "stu_id"      BIGINT              NOT NULL,
  "sec"         SMALLINT   NOT NULL,
  "mor"         SMALLINT          NOT NULL,
  "after"       SMALLINT          NOT NULL,
  "att_desc"    VARCHAR(250)        NOT NULL,
  PRIMARY KEY ("d_att_13_id")
);

--
-- Dumping data for table "d_att_13"
--

INSERT INTO "d_att_13" ("d_att_13_id", "subject_id", "username", "att_date", "stu_id", "sec", "mor", "after", "att_desc") VALUES
(1358, 275, 'vivekg', '2026-08-08', 474, 179, 1, 1, ''),
(1359, 275, 'vivekg', '2026-08-08', 68, 179, 1, 1, ''),
(1360, 275, 'vivekg', '2026-08-08', 1278, 179, 1, 1, ''),
(1361, 275, 'vivekg', '2026-08-08', 475, 179, 1, 1, ''),
(1362, 275, 'vivekg', '2026-08-08', 807, 179, 1, 1, ''),
(1363, 275, 'vivekg', '2026-08-08', 639, 179, 1, 1, ''),
(1364, 275, 'vivekg', '2026-08-08', 1293, 179, 1, 1, ''),
(1365, 275, 'vivekg', '2026-08-08', 325, 179, 1, 1, ''),
(1366, 275, 'vivekg', '2026-08-08', 1245, 179, 1, 1, ''),
(1367, 275, 'vivekg', '2026-08-08', 479, 179, 1, 1, ''),
(1368, 275, 'vivekg', '2026-08-08', 802, 179, 1, 1, ''),
(1369, 275, 'vivekg', '2026-08-08', 919, 179, 1, 1, ''),
(1370, 275, 'vivekg', '2026-08-08', 785, 179, 1, 1, '');

-- --------------------------------------------------------

--
-- Table structure for table "d_att_14"
--

CREATE TABLE IF NOT EXISTS "d_att_14" (
  "d_att_14_id"          BIGINT              NOT NULL DEFAULT 0,
  "subject_id"  INTEGER  NOT NULL,
  "username"    VARCHAR(100)        NOT NULL,
  "att_date"    DATE                NOT NULL,
  "stu_id"      BIGINT              NOT NULL,
  "sec"         SMALLINT   NOT NULL,
  "mor"         SMALLINT          NOT NULL,
  "after"       SMALLINT          NOT NULL,
  "att_desc"    VARCHAR(250)        NOT NULL,
  PRIMARY KEY ("d_att_14_id")
);

--
-- Dumping data for table "d_att_14"
--

INSERT INTO "d_att_14" ("d_att_14_id", "subject_id", "username", "att_date", "stu_id", "sec", "mor", "after", "att_desc") VALUES
(1645, 158, 'shilpak', '2026-08-14', 331, 378, 1, 1, ''),
(1646, 158, 'shilpak', '2026-08-14', 488, 378, 1, 1, ''),
(1647, 158, 'shilpak', '2026-08-14', 812, 378, 1, 1, ''),
(1648, 158, 'shilpak', '2026-08-14', 371, 378, 1, 1, ''),
(1649, 158, 'shilpak', '2026-08-14', 300, 378, 1, 1, ''),
(1650, 158, 'shilpak', '2026-08-14', 810, 378, 1, 1, ''),
(1651, 158, 'shilpak', '2026-08-14', 340, 378, 1, 1, ''),
(1652, 158, 'shilpak', '2026-08-14', 1149, 378, 1, 1, ''),
(1653, 158, 'shilpak', '2026-08-14', 966, 378, 1, 1, ''),
(1654, 158, 'shilpak', '2026-08-14', 1064, 378, 1, 1, '');

-- --------------------------------------------------------

--
-- Table structure for table "d_att_15"
--

CREATE TABLE IF NOT EXISTS "d_att_15" (
  "d_att_15_id"          BIGINT              NOT NULL DEFAULT 0,
  "subject_id"  INTEGER  NOT NULL,
  "username"    VARCHAR(100)        NOT NULL,
  "att_date"    DATE                NOT NULL,
  "stu_id"      BIGINT              NOT NULL,
  "sec"         SMALLINT   NOT NULL,
  "mor"         SMALLINT          NOT NULL,
  "after"       SMALLINT          NOT NULL,
  "att_desc"    VARCHAR(250)        NOT NULL,
  PRIMARY KEY ("d_att_15_id")
);

--
-- Dumping data for table "d_att_15"
--

INSERT INTO "d_att_15" ("d_att_15_id", "subject_id", "username", "att_date", "stu_id", "sec", "mor", "after", "att_desc") VALUES
(378, 193, 'jagrutij', '2026-08-08', 112, 161, 1, 1, ''),
(379, 193, 'jagrutij', '2026-08-08', 1309, 161, 1, 1, ''),
(380, 193, 'jagrutij', '2026-08-08', 69, 161, 1, 1, ''),
(381, 193, 'jagrutij', '2026-08-08', 24, 161, 1, 1, ''),
(382, 193, 'jagrutij', '2026-08-08', 412, 161, 1, 1, ''),
(383, 193, 'jagrutij', '2026-08-08', 1159, 161, 1, 1, ''),
(384, 193, 'jagrutij', '2026-08-08', 930, 161, 1, 1, ''),
(385, 193, 'jagrutij', '2026-08-08', 1229, 161, 1, 1, ''),
(386, 193, 'jagrutij', '2026-08-08', 1061, 161, 1, 1, ''),
(387, 193, 'jagrutij', '2026-08-08', 396, 161, 1, 1, ''),
(388, 193, 'jagrutij', '2026-08-08', 95, 161, 0, 0, ''),
(389, 193, 'jagrutij', '2026-08-08', 549, 161, 1, 1, ''),
(390, 193, 'jagrutij', '2026-08-08', 188, 161, 1, 1, '');

-- --------------------------------------------------------

--
-- Table structure for table "d_att_16"
--

CREATE TABLE IF NOT EXISTS "d_att_16" (
  "d_att_16_id"          BIGINT              NOT NULL DEFAULT 0,
  "subject_id"  INTEGER  NOT NULL,
  "username"    VARCHAR(100)        NOT NULL,
  "att_date"    DATE                NOT NULL,
  "stu_id"      BIGINT              NOT NULL,
  "sec"         SMALLINT   NOT NULL,
  "mor"         SMALLINT          NOT NULL,
  "after"       SMALLINT          NOT NULL,
  "att_desc"    VARCHAR(250)        NOT NULL,
  PRIMARY KEY ("d_att_16_id")
);

--
-- Dumping data for table "d_att_16"
--

INSERT INTO "d_att_16" ("d_att_16_id", "subject_id", "username", "att_date", "stu_id", "sec", "mor", "after", "att_desc") VALUES
(8095, 265, 'scottw', '2026-12-04', 1114, 368, 1, 1, ''),
(8096, 265, 'scottw', '2026-12-04', 10, 368, 1, 1, ''),
(8097, 265, 'scottw', '2026-12-04', 1259, 368, 1, 1, ''),
(8098, 265, 'scottw', '2026-12-04', 514, 368, 1, 1, ''),
(8099, 265, 'scottw', '2026-12-04', 1058, 368, 1, 1, ''),
(8100, 265, 'scottw', '2026-12-04', 456, 368, 5, 5, ''),
(8101, 265, 'scottw', '2026-12-04', 1178, 368, 1, 1, ''),
(8102, 265, 'scottw', '2026-12-04', 1106, 368, 1, 1, ''),
(8103, 265, 'scottw', '2026-12-04', 650, 368, 5, 5, ''),
(8104, 265, 'scottw', '2026-12-04', 967, 368, 5, 5, ''),
(8636, 215, 'hemaj', '2026-12-10', 222, 306, 1, 1, ''),
(8637, 215, 'hemaj', '2026-12-10', 948, 306, 0, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table "eca_fee_apply"
--

CREATE TABLE IF NOT EXISTS "eca_fee_apply" (
  "eca_fee_apply_id"          SERIAL,
  "status"      SMALLINT    NOT NULL,
  "subject_id"  INT           NOT NULL,
  "taxid"       INT           NOT NULL,
  "apply_date"  DATE          NOT NULL,
  "applyAmt1"   NUMERIC(18,2)  NOT NULL,
  "applyAmt2"   NUMERIC(18,2)  NOT NULL,
  PRIMARY KEY ("eca_fee_apply_id")
);

--
-- Dumping data for table "eca_fee_apply"
--

INSERT INTO "eca_fee_apply" ("eca_fee_apply_id", "status", "subject_id", "taxid", "apply_date", "applyAmt1", "applyAmt2") VALUES
(428, 0, 393, 0, '2026-02-26', 0.00, 4500.00),
(429, 0, 395, 0, '2026-02-26', 0.00, 1700.00),
(430, 0, 396, 0, '2026-02-26', 0.00, 1700.00),
(431, 0, 397, 0, '2026-02-26', 300.00, 1700.00),
(432, 0, 398, 0, '2026-02-26', 0.00, 1700.00),
(433, 0, 399, 0, '2026-02-26', 0.00, 1700.00),
(434, 0, 404, 0, '2026-02-26', 0.00, 1700.00),
(435, 0, 400, 0, '2026-02-26', 0.00, 1700.00),
(436, 0, 482, 0, '2026-02-26', 0.00, 1700.00),
(437, 0, 475, 0, '2026-02-26', 0.00, 1700.00),
(438, 0, 472, 0, '2026-02-26', 0.00, 5500.00),
(439, 0, 415, 0, '2026-02-26', 0.00, 5250.00),
(440, 0, 411, 0, '2026-02-26', 0.00, 1700.00);

-- --------------------------------------------------------

--
-- Table structure for table "eca_fee_invoice"
--

CREATE TABLE IF NOT EXISTS "eca_fee_invoice" (
  "eca_fee_invoice_id"            SERIAL,
  "invoce_id"     VARCHAR(11)   NOT NULL,
  "invoice_date"  DATE          NOT NULL,
  "student_id"    INT           NOT NULL,
  "acc_year"      INT           NOT NULL,
  "user"          VARCHAR(100)  NOT NULL,
  "status"        SMALLINT    NOT NULL,
  PRIMARY KEY ("eca_fee_invoice_id")
);

--
-- Dumping data for table "eca_fee_invoice"
--

INSERT INTO "eca_fee_invoice" ("eca_fee_invoice_id", "invoce_id", "invoice_date", "student_id", "acc_year", "user", "status") VALUES
(3, '20261', '2026-11-26', 1132, 2026, 'administrator', 1),
(4, '20264', '2026-11-26', 57, 2026, 'administrator', 1),
(5, '20265', '2026-11-26', 1137, 2026, 'administrator', 1),
(6, '20266', '2026-11-26', 44, 2026, 'administrator', 1),
(7, '20267', '2026-11-26', 59, 2026, 'administrator', 1),
(8, '20268', '2026-11-26', 1261, 2026, 'administrator', 1),
(9, '20269', '2026-11-26', 1151, 2026, 'administrator', 1),
(10, '202610', '2026-11-26', 1151, 2026, 'administrator', 1);

-- --------------------------------------------------------

--
-- Table structure for table "eca_fee_invoice_det"
--

CREATE TABLE IF NOT EXISTS "eca_fee_invoice_det" (
  "eca_fee_invoice_det_id"          SERIAL,
  "invoice_id"  INT           NOT NULL,
  "fee_head"    INT           NOT NULL,
  "amount"      NUMERIC(18,2)  NOT NULL,
  "tax_amount"  NUMERIC(18,2)  NOT NULL,
  "tot_amount"  NUMERIC(18,2)  NOT NULL,
  "status"      SMALLINT    NOT NULL,
  PRIMARY KEY ("eca_fee_invoice_det_id")
);

--
-- Dumping data for table "eca_fee_invoice_det"
--

INSERT INTO "eca_fee_invoice_det" ("eca_fee_invoice_det_id", "invoice_id", "fee_head", "amount", "tax_amount", "tot_amount", "status") VALUES
(10, 3, 1, 10000.00, 800.00, 10800.00, 1),
(11, 3, 1, 10000.00, 800.00, 10800.00, 1),
(12, 3, 1, 10000.00, 800.00, 10800.00, 1),
(13, 3, 2, 9000.00, 900.00, 9900.00, 1),
(14, 3, 4, 5000.00, 500.00, 5500.00, 1),
(15, 3, 6, 6000.00, 240.00, 6240.00, 1),
(16, 3, 5, 5500.00, 550.00, 6050.00, 1),
(17, 3, 0, 0.00, 0.00, 0.00, 1),
(18, 3, 0, 0.00, 0.00, 0.00, 1),
(19, 4, 1, 10000.00, 800.00, 10800.00, 1),
(20, 4, 2, 9000.00, 900.00, 9900.00, 1);


-- --------------------------------------------------------

--
-- Table structure for table "eca_type"
--

CREATE TABLE IF NOT EXISTS "eca_type" (
  "fee_id"     SERIAL,
  "fee_name"   VARCHAR(100)  NOT NULL DEFAULT '',
  "catid"      NUMERIC(18,2)  DEFAULT '0.00',
  "catidtype"  VARCHAR(200)  NOT NULL,
  "price"      NUMERIC(18,2)  NOT NULL,
  "refund"     INT           DEFAULT 1,
  "status"     INT           DEFAULT 1,
  "ftype"      SMALLINT    DEFAULT 1,
  PRIMARY KEY ("fee_id")
);

--
-- Dumping data for table "eca_type"
--

INSERT INTO "eca_type" ("fee_id", "fee_name", "catid", "catidtype", "price", "refund", "status", "ftype") VALUES
(1, 'Ace Speech and Drama Course', 0.00, '', 4500.00, 0, 1, 1),
(2, 'American Football', 0.00, '', 1700.00, 0, 1, 1),
(3, 'App Development & Game Design - Net Value', 0.00, '', 1512.99, 0, 1, 1),
(4, 'Badminton', 0.00, '', 1700.00, 0, 1, 1),
(5, 'Ballet', 0.00, '', 1700.00, 0, 1, 1),
(6, 'Basket Ball - Internal', 0.00, '', 1700.00, 0, 1, 1),
(7, 'Basket Ball - External', 0.00, '', 3500.00, 0, 1, 1),
(8, 'Bollywood Dance', 0.00, '', 1700.00, 0, 1, 1),
(9, 'Creative Calling', 0.00, '', 1700.00, 0, 1, 1),
(10, 'Cricket', 0.00, '', 3500.00, 0, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table "empallowances"
--

CREATE TABLE IF NOT EXISTS "empallowances" (
  "empallowances_id"            SERIAL,
  "empid"         INT    DEFAULT NULL,
  "allowance_id"  INT    DEFAULT NULL,
  "percent"       REAL  DEFAULT NULL,
  "amt"           REAL  DEFAULT NULL,
  "col_id"        INT    DEFAULT NULL,
  PRIMARY KEY ("empallowances_id")
);

--
-- Dumping data for table "empallowances"
--

INSERT INTO "empallowances" ("empallowances_id", "empid", "allowance_id", "percent", "amt", "col_id") VALUES
(1, 17, 0, 0, 1000, NULL),
(2, 18, 0, 0, 1000, NULL),
(3, 19, 0, 0, 1000, NULL),
(4, 182, 0, 0, 1000, NULL),
(5, 183, 0, 0, 1000, NULL),
(6, 184, 0, 0, 1000, NULL),
(7, 185, 0, 0, 1000, NULL),
(8, 186, 0, 0, 1000, NULL),
(9, 187, 0, 0, 1000, NULL),
(10, 188, 0, 0, 1000, NULL);

-- --------------------------------------------------------

--
-- Table structure for table "emp_attendance"
--

CREATE TABLE IF NOT EXISTS "emp_attendance" (
  "iId_att"            BIGSERIAL,
  "iIdx_organization"  BIGINT        NOT NULL,
  "att_date"           DATE          NOT NULL,
  "att_shift"          BIGINT        NOT NULL,
  "att_department"     BIGINT        NOT NULL,
  "att_empid"          VARCHAR(250)  NOT NULL,
  "att_status"         TEXT          NOT NULL,
  "ihalf"              VARCHAR(250)  NOT NULL,
  "itt"                VARCHAR(250)  NOT NULL,
  PRIMARY KEY ("iId_att")
);

-- --------------------------------------------------------

--
-- Table structure for table "employee_department"
--

CREATE TABLE IF NOT EXISTS "employee_department" (
  "iId_department"    BIGSERIAL,
  "iIdx_institution"  BIGINT        NOT NULL,
  "vdepartmentname"   VARCHAR(250)  NOT NULL,
  PRIMARY KEY ("iId_department")
);

-- --------------------------------------------------------

--
-- Table structure for table "emp_details"
--

CREATE TABLE IF NOT EXISTS "emp_details" (
  "iId_emp"           BIGSERIAL,
  "vemp_id"           VARCHAR(250)  NOT NULL,
  "demp_jdate"        DATE          NOT NULL,
  "vemp_name"         VARCHAR(250)  NOT NULL,
  "vemp_address"      VARCHAR(250)  NOT NULL,
  "iemp_cno"          BIGINT        NOT NULL,
  "vemp_email"        VARCHAR(250)  NOT NULL,
  "demp_dob"          DATE          NOT NULL,
  "vemp_gender"       VARCHAR(250)  NOT NULL,
  "iemp_age"          BIGINT        NOT NULL,
  "vemp_religion"     VARCHAR(250)  NOT NULL,
  "vemp_cast"         VARCHAR(250)  NOT NULL,
  "vemp_designation"  BIGINT        NOT NULL,
  "iemp_jposition"    BIGINT        NOT NULL,
  "vemp_jtype"        BIGINT        NOT NULL,
  "femp_bp"           NUMERIC(18,2)  NOT NULL,
  "femp_ta"           NUMERIC(18,2)  NOT NULL,
  "femp_da"           NUMERIC(18,2)  NOT NULL,
  "femp_hra"          NUMERIC(18,2)  NOT NULL,
  PRIMARY KEY ("iId_emp")
);

-- --------------------------------------------------------

--
-- Table structure for table "emp_details1"
--

CREATE TABLE IF NOT EXISTS "emp_details1" (
  "iId_emp"             BIGSERIAL,
  "iIdx_institution"    BIGINT        NOT NULL,
  "iIdx_department"     BIGINT        NOT NULL,
  "vemp_id"             VARCHAR(250)  NOT NULL,
  "iemp_designation"    BIGINT        NOT NULL,
  "demp_jdate"          DATE          NOT NULL,
  "femp_bpay"           NUMERIC(18,2)  NOT NULL,
  "pda"                 NUMERIC(18,2)  NOT NULL,
  "phra"                NUMERIC(18,2)  NOT NULL,
  "pcca"                NUMERIC(18,2)  NOT NULL,
  "potherear"           NUMERIC(18,2)  NOT NULL,
  "pf"                  NUMERIC(18,2)   NOT NULL,
  "loans"               NUMERIC(18,2)  NOT NULL,
  "otherded"            NUMERIC(18,2)  NOT NULL,
  "vemp_name"           VARCHAR(250)  NOT NULL,
  "vemp_qualification"  VARCHAR(250)  NOT NULL,
  "demp_dob"            DATE          NOT NULL,
  "vemp_gender"         VARCHAR(250)  NOT NULL,
  "vemp_address"        VARCHAR(250)  NOT NULL,
  "iemp_cno"            BIGINT        NOT NULL,
  "vemp_email"          VARCHAR(250)  NOT NULL,
  "vemp_comments"       VARCHAR(250)  NOT NULL,
  "vaccount"            VARCHAR(250)  NOT NULL,
  "ptype"               VARCHAR(250)  NOT NULL,
  PRIMARY KEY ("iId_emp")
);

-- --------------------------------------------------------

--
-- Table structure for table "emp_job"
--

CREATE TABLE IF NOT EXISTS "emp_job" (
  "iId_job"           BIGSERIAL,
  "iIdx_institution"  BIGINT        NOT NULL,
  "vjob"              VARCHAR(250)  NOT NULL,
  PRIMARY KEY ("iId_job")
);

-- --------------------------------------------------------

--
-- Table structure for table "emp_loan"
--

CREATE TABLE IF NOT EXISTS "emp_loan" (
  "iIdx_loan"          BIGSERIAL,
  "iIdx_organization"  BIGINT        NOT NULL,
  "iIdx_department"    BIGINT        NOT NULL,
  "emp_id"             VARCHAR(250)  NOT NULL,
  "floantamount"       NUMERIC(18,2)  NOT NULL,
  "finstallment"       NUMERIC(18,2)  NOT NULL,
  "dfdate"             DATE          NOT NULL,
  "dtdate"             DATE          NOT NULL,
  PRIMARY KEY ("iIdx_loan")
);

-- --------------------------------------------------------

--
-- Table structure for table "employee_salary"
--

CREATE TABLE IF NOT EXISTS "employee_salary" (
  "iId_salary"         BIGSERIAL,
  "iIdx_organization"  BIGINT        NOT NULL,
  "iIdx_department"    BIGINT        NOT NULL,
  "vId_emp"            VARCHAR(250)  NOT NULL,
  "ddate"              DATE          NOT NULL,
  "iyear"              BIGINT        NOT NULL,
  "vmonth"             VARCHAR(250)  NOT NULL,
  "iwordays"           BIGINT        NOT NULL,
  "ipresent"           BIGINT        NOT NULL,
  "fda"                NUMERIC(18,2)  NOT NULL,
  "fhra"               NUMERIC(18,2)  NOT NULL,
  "fcca"               NUMERIC(18,2)  NOT NULL,
  "fotherear"          NUMERIC(18,2)  NOT NULL,
  "flop"               NUMERIC(18,2)  NOT NULL,
  "fpf"                NUMERIC(18,2)  NOT NULL,
  "fpt"                NUMERIC(18,2)  NOT NULL,
  "floans"             NUMERIC(18,2)  NOT NULL,
  "fotherded"          NUMERIC(18,2)  NOT NULL,
  "fgrosssal"          NUMERIC(18,2)  NOT NULL,
  "ftotded"            NUMERIC(18,2)  NOT NULL,
  "fnetsal"            NUMERIC(18,2)  NOT NULL,
  "ptype"              VARCHAR(250)  NOT NULL,
  PRIMARY KEY ("iId_salary")
);

-- --------------------------------------------------------

--
-- Table structure for table "enter_date"
--

CREATE TABLE IF NOT EXISTS "enter_date" (
  "enter_date_id"    SERIAL,
  "Date"  DATE  DEFAULT NULL,
  PRIMARY KEY ("enter_date_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "exam_detention"
--

CREATE TABLE IF NOT EXISTS "exam_detention" (
  "exam_detention_id"        SERIAL,
  "acc_year"  INT         NOT NULL,
  "sem"       INT         NOT NULL,
  "exam_sem"  INT         NOT NULL,
  "section"   INT         NOT NULL,
  "int_id"    INT         NOT NULL,
  "tst_id"    INT         NOT NULL,
  "status"    SMALLINT  NOT NULL,
  "count"     INT         NOT NULL,
  PRIMARY KEY ("exam_detention_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "exam_grade_point"
--

CREATE TABLE IF NOT EXISTS "exam_grade_point" (
  "exam_grade_point_id"          SERIAL,
  "sem"         INT          NOT NULL,
  "acc_year"    INT          NOT NULL,
  "exam_id"     INT          NOT NULL,
  "subject_id"  INT          NOT NULL,
  "from_point"  INT          NOT NULL,
  "to_point"    INT          NOT NULL,
  "tot_point"   VARCHAR(11)  NOT NULL,
  "desc"        TEXT         NOT NULL,
  "status"      SMALLINT   NOT NULL,
  PRIMARY KEY ("exam_grade_point_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "exam_links"
--

CREATE TABLE IF NOT EXISTS "exam_links" (
  "exam_links_id"        SERIAL,
  "sem"       INT           NOT NULL,
  "linkname"  VARCHAR(200)  NOT NULL,
  PRIMARY KEY ("exam_links_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "exam_m"
--

CREATE TABLE IF NOT EXISTS "exam_m" (
  "exam_m_id"          SERIAL,
  "curriculam"  INT          NOT NULL,
  "class"       INT          NOT NULL,
  "f_date"      DATE         NOT NULL,
  "t_date"      DATE         NOT NULL,
  "vct"         INT          DEFAULT 0,
  "exam_name"   VARCHAR(30)  NOT NULL,
  "max_mark"    TEXT,
  "flag"        SMALLINT   NOT NULL DEFAULT 0,
  "accyear"     YEAR(4)      NOT NULL,
  "exam_count"  INT          NOT NULL,
  "sub_id"      TEXT         NOT NULL,
  "descr"       VARCHAR(22)  NOT NULL DEFAULT 0,
  "sts"         SMALLINT   DEFAULT 0,
  PRIMARY KEY ("exam_m_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "exam_remarks"
--

CREATE TABLE IF NOT EXISTS "exam_remarks" (
  "exam_remarks_id"          SERIAL,
  "acc_year"    INT         NOT NULL,
  "sem"         INT         NOT NULL,
  "section"     INT         NOT NULL,
  "student_id"  INT         NOT NULL,
  "exam_sem"    INT         NOT NULL,
  "int_id"      INT         NOT NULL,
  "tst_id"      INT         NOT NULL,
  "status"      SMALLINT  NOT NULL,
  "remarks1"    TEXT        NOT NULL,
  "remarks2"    TEXT        NOT NULL,
  "remarks3"    TEXT        NOT NULL,
  "remarks4"    TEXT        NOT NULL,
  PRIMARY KEY ("exam_remarks_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "exam_sub_m"
--

CREATE TABLE IF NOT EXISTS "exam_sub_m" (
  "exam_sub_m_id"             SERIAL,
  "exam_id"        INT          DEFAULT NULL,
  "exam_name"      VARCHAR(75)  NOT NULL,
  "exam_sub_name"  VARCHAR(50)  NOT NULL,
  "subject_id"     INT          NOT NULL,
  "section"        INT          NOT NULL,
  "per_info"       INT          NOT NULL,
  "mark"           INT          NOT NULL,
  "acc_year"       INT          NOT NULL,
  "class"          INT          NOT NULL,
  "status"         SMALLINT   NOT NULL,
  "order_id"       INT          NOT NULL,
  PRIMARY KEY ("exam_sub_m_id")
);

--
-- Dumping data for table "exam_sub_m"
--

INSERT INTO "exam_sub_m" ("exam_sub_m_id", "exam_id", "exam_name", "exam_sub_name", "subject_id", "section", "per_info", "mark", "acc_year", "class", "status", "order_id") VALUES
(1, 2, 'Test', 'TI', 59, 1, 0, 100, 2026, 9, 1, 1),
(2, 2, 'Assignment', 'AS', 59, 1, 0, 100, 2026, 9, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table "exam_sub_sub_m"
--

CREATE TABLE IF NOT EXISTS "exam_sub_sub_m" (
  "exam_sub_sub_m_id"             SERIAL,
  "exam_id"        INT          DEFAULT NULL,
  "exam_name"      VARCHAR(75)  NOT NULL,
  "exam_sub_name"  VARCHAR(50)  NOT NULL,
  "per_info"       INT          NOT NULL,
  "mark"           INT          NOT NULL,
  "status"         SMALLINT   NOT NULL,
  "order_id"       INT          NOT NULL,
  PRIMARY KEY ("exam_sub_sub_m_id")
);

--
-- Dumping data for table "exam_sub_sub_m"
--

INSERT INTO "exam_sub_sub_m" ("exam_sub_sub_m_id", "exam_id", "exam_name", "exam_sub_name", "per_info", "mark", "status", "order_id") VALUES
(1, 1, 'July Test 1', 'J', 0, 50, 1, 1),
(2, 2, 'July Assessment 1', 'JS', 0, 30, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table "exam_timetable_m"
--

CREATE TABLE IF NOT EXISTS "exam_timetable_m" (
  "exam_timetable_m_id"          SERIAL,
  "exam_id"     INT          NOT NULL,
  "subject_id"  INT          NOT NULL,
  "exam_date"   DATE         NOT NULL,
  "exam_time"   VARCHAR(20)  NOT NULL,
  PRIMARY KEY ("exam_timetable_m_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "exam_topers"
--

CREATE TABLE IF NOT EXISTS "exam_topers" (
  "exam_topers_id"          SERIAL,
  "exam_id"     INT          NOT NULL,
  "stud_id"     INT          NOT NULL,
  "posi"        INT          NOT NULL,
  "total_mark"  INT          NOT NULL,
  "descr"       VARCHAR(22)  NOT NULL DEFAULT 0,
  "sec_id"      INT          NOT NULL,
  "rfg"         VARCHAR(2)   DEFAULT NULL,
  "cc"          INT          DEFAULT 0,
  "ca"          INT          DEFAULT 0,
  "sub_remks"   TEXT,
  PRIMARY KEY ("exam_topers_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "exam_year_m"
--

CREATE TABLE IF NOT EXISTS "exam_year_m" (
  "exam_year_m_id"             SERIAL,
  "exam_name"      VARCHAR(75)  NOT NULL,
  "exam_sub_name"  VARCHAR(50)  NOT NULL,
  "per_info"       INT          NOT NULL,
  "mark"           INT          NOT NULL,
  "acc_year"       INT          NOT NULL,
  "class"          INT          NOT NULL,
  "status"         SMALLINT   NOT NULL,
  "order_id"       INT          NOT NULL,
  PRIMARY KEY ("exam_year_m_id")
);

--
-- Dumping data for table "exam_year_m"
--

INSERT INTO "exam_year_m" ("exam_year_m_id", "exam_name", "exam_sub_name", "per_info", "mark", "acc_year", "class", "status", "order_id") VALUES
(1, '2026-13', '2026-13', 100, 100, 2026, 5, 1, 1),
(2, 'Semester 1', 'Sem 1', 100, 100, 2026, 9, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table "fee_apply_fee_student"
--

CREATE TABLE IF NOT EXISTS "fee_apply_fee_student" (
  "fee_apply_fee_student_id"              SERIAL,
  "student_id"      INT         NOT NULL,
  "acc_year"        INT         NOT NULL,
  "status"          SMALLINT  NOT NULL,
  "division"        INT         NOT NULL,
  "comment"         TEXT        NOT NULL,
  "generalComment"  SMALLINT  NOT NULL DEFAULT 1,
  "hidePDC"         SMALLINT  NOT NULL DEFAULT 1,
  PRIMARY KEY ("fee_apply_fee_student_id")
);

--
-- Dumping data for table "fee_apply_fee_student"
--

INSERT INTO "fee_apply_fee_student" ("fee_apply_fee_student_id", "student_id", "acc_year", "status", "division", "comment", "generalComment", "hidePDC") VALUES
(1, 1, 2026, 1, 11, '', 1, 1),
(2, 2, 2026, 1, 10, '', 1, 1),
(3, 3, 2026, 1, 5, '', 1, 1),
(4, 4, 2026, 1, 7, '', 1, 1),
(5, 5, 2026, 1, 9, '', 1, 1),
(6, 6, 2026, 1, 14, '', 1, 1),
(7, 7, 2026, 1, 1, '', 1, 1),
(8, 8, 2026, 1, 3, '', 1, 1),
(9, 9, 2026, 1, 2, '', 1, 1),
(10, 10, 2026, 1, 16, '', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table "fee_cat"
--

CREATE TABLE IF NOT EXISTS "fee_cat" (
  "catid"     SERIAL,
  "cat_name"  VARCHAR(100)  DEFAULT NULL,
  "status"    SMALLINT    DEFAULT 1,
  PRIMARY KEY ("catid")
);

-- --------------------------------------------------------

--
-- Table structure for table "fee_challan_mail_log"
--

CREATE TABLE IF NOT EXISTS "fee_challan_mail_log" (
  "fee_challan_mail_log_id"                 SERIAL,
  "stud_id"            INT           DEFAULT NULL,
  "sem"                INT           DEFAULT NULL,
  "a_year"             VARCHAR(10)   DEFAULT NULL,
  "uid"                VARCHAR(50)   DEFAULT NULL,
  "term"               VARCHAR(10)   DEFAULT NULL,
  "slab_id"            INT           DEFAULT NULL,
  "uid_new"            VARCHAR(50)   DEFAULT NULL,
  "mail_sent"          SMALLINT    DEFAULT 0,
  "inserted_datetime"  TIMESTAMP      DEFAULT NULL,
  "user"               VARCHAR(50)   DEFAULT NULL,
  "view_count"         INT           DEFAULT NULL,
  "sent_details"       VARCHAR(200)  DEFAULT NULL,
  PRIMARY KEY ("fee_challan_mail_log_id")
);

--
-- Dumping data for table "fee_challan_mail_log"
--

INSERT INTO "fee_challan_mail_log" ("fee_challan_mail_log_id", "stud_id", "sem", "a_year", "uid", "term", "slab_id", "uid_new", "mail_sent", "inserted_datetime", "user", "view_count", "sent_details") VALUES
(411, 1132, 2, '2026', '6c3ccaa50629ecff340b6677b02eb8a8', '1', 6, '17d63b1625c816c22647a73e1482372b', 1, '2026-03-20 15:53:41', 'eyinfo', NULL, 'quebecxn@email.com'),
(412, 57, 2, '2026', '6c3ccaa50629ecff340b6677b02eb8a8', '1', 6, 'b9228e0962a78b84f3d5d92f4faa000b', 1, '2026-03-20 15:53:41', 'eyinfo', 2, 'mohitconnections@email.com'),
(413, 1137, 2, '2026', '6c3ccaa50629ecff340b6677b02eb8a8', '1', 6, '0deb1c54814305ca9ad266f53bc82511', 1, '2026-03-20 15:53:41', 'eyinfo', 4, 'bhupinder70@email.com'),
(414, 44, 2, '2026', '6c3ccaa50629ecff340b6677b02eb8a8', '1', 6, '66808e327dc79d135ba18e051673d906', 1, '2026-03-20 15:53:41', 'eyinfo', 1, 'aizawa.kenta@email.com'),
(415, 1314, 2, '2026', '6c3ccaa50629ecff340b6677b02eb8a8', '1', 6, '42e7aaa88b48137a16a1acd04ed91125', 1, '2026-03-20 15:53:41', 'eyinfo', 2, 'Damian.Dunn@email.com'),
(416, 3000007, 2, '2026', '6c3ccaa50629ecff340b6677b02eb8a8', '1', 6, '8fe0093bb30d6f8c31474bd0764e6ac0', 0, '2026-03-20 15:53:41', 'eyinfo', NULL, NULL),
(417, 1219, 2, '2026', '6c3ccaa50629ecff340b6677b02eb8a8', '1', 6, '41ae36ecb9b3eee609d05b90c14222fb', 1, '2026-03-20 15:53:41', 'eyinfo', NULL, 'andre.timmins@email.com'),
(418, 3000004, 2, '2026', '6c3ccaa50629ecff340b6677b02eb8a8', '1', 6, 'd1f255a373a3cef72e03aa9d980c7eca', 1, '2026-03-20 15:53:41', 'eyinfo', NULL, 'ilidavs@email.com'),
(419, 59, 2, '2026', '6c3ccaa50629ecff340b6677b02eb8a8', '1', 6, '7eacb532570ff6858afd2723755ff790', 1, '2026-03-20 15:53:41', 'eyinfo', 1, 'tkintlgroup@email.com'),
(420, 1261, 2, '2026', '6c3ccaa50629ecff340b6677b02eb8a8', '1', 6, 'b6f0479ae87d244975439c6124592772', 1, '2026-03-20 15:53:41', 'eyinfo', 1, 'sahil_verma@email.com'),

-- --------------------------------------------------------

--
-- Table structure for table "fee_discount_det"
--

CREATE TABLE IF NOT EXISTS "fee_discount_det" (
  "fee_discount_det_id"             SERIAL,
  "admissionType"  INT         NOT NULL,
  "currencyType"   INT         NOT NULL,
  "disscountType"  INT         NOT NULL,
  "feeHead"        INT         NOT NULL,
  "discountAmt"    INT         NOT NULL,
  "curType"        SMALLINT  NOT NULL,
  "status"         SMALLINT  NOT NULL,
  PRIMARY KEY ("fee_discount_det_id")
);

--
-- Dumping data for table "fee_discount_det"
--

INSERT INTO "fee_discount_det" ("fee_discount_det_id", "admissionType", "currencyType", "disscountType", "feeHead", "discountAmt", "curType", "status") VALUES
(5, 1, 1, 4, 2, 75, 1, 1),
(6, 1, 1, 4, 4, 75, 1, 1),
(9, 1, 1, 4, 5, 75, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table "fee_discount_head"
--

CREATE TABLE IF NOT EXISTS "fee_discount_head" (
  "fee_discount_head_id"      SERIAL,
  "name"    VARCHAR(50)  NOT NULL,
  "desc"    TEXT         NOT NULL,
  "status"  SMALLINT   NOT NULL,
  PRIMARY KEY ("fee_discount_head_id")
);

--
-- Dumping data for table "fee_discount_head"
--

INSERT INTO "fee_discount_head" ("fee_discount_head_id", "name", "desc", "status") VALUES
(4, 'Scholarship 75%', 'Scholarship 75%', 1);

-- --------------------------------------------------------

--
-- Table structure for table "fee_discount_slab"
--

CREATE TABLE IF NOT EXISTS "fee_discount_slab" (
  "fee_discount_slab_id"      SERIAL,
  "name"    VARCHAR(50)  NOT NULL,
  "desc"    TEXT         NOT NULL,
  "status"  SMALLINT   NOT NULL,
  PRIMARY KEY ("fee_discount_slab_id")
);

--
-- Dumping data for table "fee_discount_slab"
--

INSERT INTO "fee_discount_slab" ("fee_discount_slab_id", "name", "desc", "status") VALUES
(6, 'CS', 'Continuing student', 1),
(7, 'FS', 'Founder Student', 1),
(8, 'STAP', 'STAP', 1),
(9, 'EXPAT', 'EXPAT', 1),
(10, 'NS', 'New Student', 1),
(11, 'CS ( IB Group 1)', 'Continuing student ( IB Group 1)', 1),
(12, 'CS ( IB Group 2)', 'Continuing student ( IB Group 2)', 1),
(13, 'CS ( IB Group 3)', 'Continuing student ( IB Group 3)', 1),
(14, 'CS ( IB Group 4)', 'Continuing student ( IB Group 4)', 1);

-- --------------------------------------------------------

--
-- Table structure for table "fee_discount_student"
--

CREATE TABLE IF NOT EXISTS "fee_discount_student" (
  "fee_discount_student_id"           SERIAL,
  "student_id"   INT         NOT NULL,
  "discount_id"  INT         NOT NULL,
  "acc_year"     INT         NOT NULL,
  "status"       SMALLINT  NOT NULL,
  PRIMARY KEY ("fee_discount_student_id")
);

--
-- Dumping data for table "fee_discount_student"
--

INSERT INTO "fee_discount_student" ("fee_discount_student_id", "student_id", "discount_id", "acc_year", "status") VALUES
(8, 473, 4, 2026, 1),
(9, 1308, 4, 2026, 1),
(10, 156, 0, 2026, 1);

-- --------------------------------------------------------

--
-- Table structure for table "fee_dmd"
--

CREATE TABLE IF NOT EXISTS "fee_dmd" (
  "fee_dmd_id"      SERIAL,
  "studid"  INT         DEFAULT NULL,
  "pid"     INT         DEFAULT NULL,
  "sid"     INT         DEFAULT NULL,
  "admid"   INT         DEFAULT NULL,
  "ins_dt"  DATE        DEFAULT NULL,
  "dmdsts"  SMALLINT  DEFAULT 0,
  "uid"     INT         DEFAULT NULL,
  "accyr"   INT         DEFAULT NULL,
  "T1dmd1"  INT         DEFAULT 0,
  "T2dmd1"  INT         DEFAULT 0,
  "T3dmd1"  INT         DEFAULT 0,
  "T1dmd2"  INT         DEFAULT 0,
  "T2dmd2"  INT         DEFAULT 0,
  "T3dmd2"  INT         DEFAULT 0,
  "T1dmd3"  INT         DEFAULT 0,
  "T2dmd3"  INT         DEFAULT 0,
  "T3dmd3"  INT         DEFAULT 0,
  "T1dmd4"  INT         DEFAULT 0,
  "T2dmd4"  INT         DEFAULT 0,
  "T3dmd4"  INT         DEFAULT 0,
  "T1dmd5"  INT         DEFAULT 0,
  "T2dmd5"  INT         DEFAULT 0,
  "T3dmd5"  INT         DEFAULT 0,
  "T1dmd6"  INT         DEFAULT 0,
  "T2dmd6"  INT         DEFAULT 0,
  "T3dmd6"  INT         DEFAULT 0,
  "T1dmd7"  INT         DEFAULT 0,
  "T2dmd7"  INT         DEFAULT 0,
  "T3dmd7"  INT         DEFAULT 0,
  "T1dmd8"  INT         DEFAULT 0,
  "T2dmd8"  INT         DEFAULT 0,
  "T3dmd8"  INT         DEFAULT 0,
  "T1dmd9"  INT         DEFAULT 0,
  "T2dmd9"  INT         DEFAULT 0,
  "T3dmd9"  INT         DEFAULT 0,
  PRIMARY KEY ("fee_dmd_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "fee_financial_year"
--

CREATE TABLE IF NOT EXISTS "fee_financial_year" (
  "fee_financial_year_id"         SERIAL,
  "statrtM"    INT         NOT NULL,
  "greater"    VARCHAR(4)  NOT NULL,
  "lessthen"   VARCHAR(4)  NOT NULL,
  "equals"     VARCHAR(4)  NOT NULL,
  "startdate"  INT         NOT NULL,
  "endm"       INT         NOT NULL,
  "enddate"    INT         NOT NULL,
  "nextyear"   VARCHAR(4)  NOT NULL,
  PRIMARY KEY ("fee_financial_year_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "fee_head"
--

CREATE TABLE IF NOT EXISTS "fee_head" (
  "fee_head_id"              SERIAL,
  "course_id"       INT         DEFAULT NULL,
  "year_id"         INT         NOT NULL DEFAULT 0,
  "admission_type"  INT         NOT NULL DEFAULT 0,
  "amount1"         INT         DEFAULT NULL,
  "amount2"         INT         DEFAULT NULL,
  "amount3"         INT         DEFAULT NULL,
  "amount"          INT         DEFAULT NULL,
  "fid"             INT         DEFAULT NULL,
  "accyr"           INT         DEFAULT NULL,
  "status"          SMALLINT  NOT NULL DEFAULT 1,
  "catid"           INT         DEFAULT NULL,
  "ftype"           SMALLINT  DEFAULT NULL,
  PRIMARY KEY ("fee_head_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "fee_h_det"
--

CREATE TABLE IF NOT EXISTS "fee_h_det" (
  "fee_h_det_id"             SERIAL,
  "stud_id"        INTEGER  NOT NULL,
  "fee_id"         INT                    DEFAULT NULL,
  "installment"    INT                    DEFAULT NULL,
  "amt"            NUMERIC(9,2)             DEFAULT '0.00',
  "due_date"       DATE                   DEFAULT NULL,
  "fee_amount"     NUMERIC(9,2)             DEFAULT '0.00',
  "paid"           VARCHAR(50)       DEFAULT 'No',
  "hostel_type"    VARCHAR(50)          DEFAULT 'N',
  "academic_term"  VARCHAR(10)            DEFAULT NULL,
  "doc_id"         INT                    DEFAULT NULL,
  PRIMARY KEY ("fee_h_det_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "fee_import"
--

CREATE TABLE IF NOT EXISTS "fee_import" (
  "fee_import_id"              SERIAL,
  "accYear"         TEXT  NOT NULL,
  "receipt"         TEXT  NOT NULL,
  "studentId"       TEXT  NOT NULL,
  "feeHead_id"      TEXT  NOT NULL,
  "totalAmount"     TEXT  NOT NULL,
  "totalAmountDet"  TEXT  NOT NULL,
  "totalDisAmount"  TEXT  NOT NULL,
  "totalConverted"  TEXT  NOT NULL,
  "discountType"    TEXT  NOT NULL,
  "currency"        TEXT  NOT NULL,
  "status"          TEXT  NOT NULL,
  "paymentDate"     TEXT  NOT NULL,
  "modeofpayment"   TEXT  NOT NULL,
  "Chq_no"          TEXT  NOT NULL,
  "Chq_date"        TEXT  NOT NULL,
  "bank_id"         TEXT  NOT NULL,
  "amountCleared"   TEXT  NOT NULL,
  "clearedDate"     TEXT  NOT NULL,
  "remarks"         TEXT  NOT NULL,
  PRIMARY KEY ("fee_import_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "fee_imprest"
--

CREATE TABLE IF NOT EXISTS "fee_imprest" (
  "enrollment_no"       VARCHAR(255)  DEFAULT NULL,
  "student_ name"       VARCHAR(255)  DEFAULT NULL,
  "tuition_fee_1"       NUMERIC(12,2)  DEFAULT NULL,
  "tuition_fee_2"       NUMERIC(12,2)  DEFAULT NULL,
  "Imprest"             VARCHAR(255)  DEFAULT NULL,
  "graduation_fees"     NUMERIC(12,2)  DEFAULT NULL,
  "Excess_tuition_fee"  NUMERIC(12,2)  DEFAULT NULL,
  PRIMARY KEY ("enrollment_no")
);

--
-- Dumping data for table "fee_imprest"
--

INSERT INTO "fee_imprest" ("enrollment_no", "student_ name", "tuition_fee_1", "tuition_fee_2", "Imprest", "graduation_fees", "Excess_tuition_fee") VALUES
('enrollment_no', 'student_ name', 'tuition_fee_1', 'tuition_fee_2', 'Imprest', 'graduation_fees', 'Excess_tuition_fee'),
('A12176', 'Samaira Khan', NULL, NULL, '375', NULL, NULL),
('A12174', 'Aarohan Kundu', NULL, NULL, '375', NULL, NULL),
('A12175', 'Armaan Rajan', NULL, NULL, '1175', NULL, NULL),
('A12183', 'Abhyudaya Singh', NULL, NULL, '1175', NULL, NULL),
('A12180', 'Sanaya Kanakia', NULL, NULL, '775', NULL, NULL),
('A12167', 'Drishti Chandgothia', NULL, NULL, '375', NULL, NULL),
('A12201', 'Mihika Daga', NULL, NULL, '575', NULL, NULL),
('A12172', 'Reet Anand', NULL, NULL, '575', NULL, NULL),
('A12188', 'Veer Jaradi', NULL, NULL, '1175', NULL, NULL),
('A12187', 'Adi Pavoor', NULL, NULL, '575', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table "fee_imprest_new"
--

CREATE TABLE IF NOT EXISTS "fee_imprest_new" (
  "enrollment_no"        VARCHAR(255)  DEFAULT NULL,
  "next_grade"           VARCHAR(255)  DEFAULT NULL,
  "student_name"         VARCHAR(255)  DEFAULT NULL,
  "tution_fees1"         NUMERIC(12,2)  DEFAULT NULL,
  "tution_fees2"         NUMERIC(12,2)  DEFAULT NULL,
  "imprest"              DOUBLE PRECISION        DEFAULT NULL,
  "graduation_fees"      DOUBLE PRECISION        DEFAULT NULL,
  "less_execution_fees"  DOUBLE PRECISION        DEFAULT NULL,
  PRIMARY KEY ("enrollment_no")
);

--
-- Dumping data for table "fee_imprest_new"
--

INSERT INTO "fee_imprest_new" ("enrollment_no", "next_grade", "student_name", "tution_fees1", "tution_fees2", "imprest", "graduation_fees", "less_execution_fees") VALUES
('enrollment_no', 'next_grade', 'student_name', 'tution_fees1', 'tution_fees2', 0, 0, 0),
('A12176', 'Nursery', 'Samaira Khan', '', '', 375, 0, 0),
('A12174', 'Nursery', 'Aarohan Kundu', '', '', 375, 0, 0),
('A12175', 'Nursery', 'Armaan Rajan', '', '', 1175, 0, 0),
('A12183', 'Nursery', 'Abhyudaya Singh', '', '', 1175, 0, 0),
('A12180', 'Nursery', 'Sanaya Kanakia', '', '', 775, 0, 0),
('A12167', 'Nursery', 'Drishti Chandgothia', '', '', 375, 0, 0),
('A12201', 'Nursery', 'Mihika Daga', '', '', 575, 0, 0),
('A12172', 'Nursery', 'Reet Anand', '', '', 575, 0, 0),
('A12188', 'Nursery', 'Veer Jaradi', '', '', 1175, 0, 0),
('A12187', 'Nursery', 'Adi Pavoor', '', '', 575, 0, 0),
('A12190', 'Nursery', 'Arssh Gupta', '', '', 575, 0, 0),
('A12210', 'Nursery', 'Riaan Verma', '', '', 1075, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table "fee_invoice_settings"
--

CREATE TABLE IF NOT EXISTS "fee_invoice_settings" (
  "fee_invoice_settings_id"           SERIAL,
  "invoicedate"  DATE        NOT NULL,
  "duedate"      DATE        NOT NULL,
  "sem"          INT         NOT NULL,
  "ctype"        INT         NOT NULL,
  "remark1"      TEXT        NOT NULL,
  "remark2"      TEXT        NOT NULL,
  "remark3"      TEXT        NOT NULL,
  "accyear"      INT         NOT NULL,
  "status"       SMALLINT  NOT NULL,
  PRIMARY KEY ("fee_invoice_settings_id")
);

--
-- Dumping data for table "fee_invoice_settings"
--

INSERT INTO "fee_invoice_settings" ("fee_invoice_settings_id", "invoicedate", "duedate", "sem", "ctype", "remark1", "remark2", "remark3", "accyear", "status") VALUES
(2, NULL, NULL, 0, 1, '', '', '* This is a system generated receipt and hence does not require a signature. ', 2026, 1),
(3, NULL, NULL, 0, 1, '', '', '*This is a system generated invoice and hence does not require a signature.\r\n\r\n*All the cheques must be handed over to the MAC by April 15th, 2026.', 2026, 1),
(5, NULL, NULL, 2, 2, '', '', 'DISCLAIMER: This is a provisional promotion for the next academic year, which may be subject to change based on the PTM results. If there is any change in the result, the difference in the fees would be refunded by Oberoi International Early Years (Playschool to SKG).', 2026, 1),
(4, NULL, NULL, 1, 2, '', '', 'grade playschool General Comment', 2026, 1),
(6, NULL, NULL, 3, 2, '', '', 'DISCLAIMER: This is a provisional promotion for the next academic year, which may be subject to change based on the PTM results. If there is any change in the result, the difference in the fees would be refunded by Oberoi International Early Years (Playschool to SKG).', 2026, 1),
(7, NULL, NULL, 4, 2, '', '', 'DISCLAIMER: This is a provisional promotion for the next academic year, which may be subject to change based on the PTM results. If there is any change in the result, the difference in the fees would be refunded by Oberoi International Early Years (Playschool to SKG).', 2026, 1),
(8, NULL, NULL, 5, 2, '', '', 'DISCLAIMER: This is a provisional promotion for the next academic year, which may be subject to change based on the PTM results. If there is any change in the result, the difference in the fees would be refunded by Oberoi International School (Grade 1 to 10).', 2026, 1),
(9, NULL, NULL, 6, 2, '', '', 'DISCLAIMER: This is a provisional promotion for the next academic year, which may be subject to change based on the PTM results. If there is any change in the result, the difference in the fees would be refunded by Oberoi International School (Grade 1 to 10).', 2026, 1),
(10, NULL, NULL, 7, 2, '', '', 'DISCLAIMER: This is a provisional promotion for the next academic year, which may be subject to change based on the PTM results. If there is any change in the result, the difference in the fees would be refunded by Oberoi International School (Grade 1 to 10).', 2026, 1);

-- --------------------------------------------------------

--
-- Table structure for table "fee_logo"
--

CREATE TABLE IF NOT EXISTS "fee_logo" (
  "fee_logo_id"          SERIAL,
  "class_id"    INT           NOT NULL,
  "path"        VARCHAR(240)  NOT NULL,
  "name_det"    VARCHAR(200)  NOT NULL,
  "status"      SMALLINT    NOT NULL,
  "eca"         VARCHAR(250)  NOT NULL,
  "reportcard"  VARCHAR(250)  NOT NULL,
  "s_name"      VARCHAR(10)   NOT NULL,
  PRIMARY KEY ("fee_logo_id")
);

--
-- Dumping data for table "fee_logo"
--

INSERT INTO "fee_logo" ("fee_logo_id", "class_id", "path", "name_det", "status", "eca", "reportcard", "s_name") VALUES
(1, 5, 'http://learninzone.com/lms/images/Grade1to10.png', ' INTERNATIONAL SCHOOL (Grade 1 to 10)', 1, ' FOUNDATION – ECA', 'https://learningzone.com/lms/images/Primaryheadsigniture.JPG', 'OIS'),
(2, 6, 'https://learningzone.com/lms/images/Grade1to10.png', ' INTERNATIONAL SCHOOL (Grade 1 to 10)', 1, ' FOUNDATION – ECA', 'https://learningzone.com/lms/images/Primaryheadsigniture.JPG', 'OIS'),
(3, 7, 'https://learningzone.com/lms/images/Grade1to10.png', ' INTERNATIONAL SCHOOL (Grade 1 to 10)', 1, ' FOUNDATION – ECA', 'https://learningzone.com/lms/images/Primaryheadsigniture.JPG', 'OIS'),
(4, 8, 'https://learningzone.com/lms/images/Grade1to10.png', ' INTERNATIONAL SCHOOL (Grade 1 to 10)', 1, ' FOUNDATION – ECA', 'https://learningzone.com/lms/images/Primaryheadsigniture.JPG', 'OIS'),
(5, 9, 'https://learningzone.com/lms/images/Grade1to10.png', ' INTERNATIONAL SCHOOL (Grade 1 to 10)', 1, ' FOUNDATION – ECA', 'https://learningzone.com/lms/images/Primaryheadsigniture.JPG', 'OIS'),
(6, 10, 'https://learningzone.com/lms/images/Grade1to10.png', ' INTERNATIONAL SCHOOL (Grade 1 to 10)', 1, ' FOUNDATION – ECA', 'https://learningzone.com/lms/images/SecondayheadSign.JPG', 'OIS'),
(7, 11, 'https://learningzone.com/lms/images/Grade1to10.png', ' INTERNATIONAL SCHOOL (Grade 1 to 10)', 1, ' FOUNDATION – ECA', 'https://learningzone.com/lms/images/SecondayheadSign.JPG', 'OIS'),
(8, 12, 'https://learningzone.com/lms/images/Grade1to10.png', ' INTERNATIONAL SCHOOL (Grade 1 to 10)', 1, ' FOUNDATION – ECA', 'https://learningzone.com/lms/images/SecondayheadSign.JPG', 'OIS'),
(9, 13, 'https://learningzone.com/lms//images/Grade1to10.png', ' INTERNATIONAL SCHOOL (Grade 1 to 10)', 1, ' FOUNDATION – ECA', 'https://learningzone.com/lms/images/SecondayheadSign.JPG', 'OIS'),
(10, 14, 'https://learningzone.com/lms//images/Grade1to10.png', ' INTERNATIONAL SCHOOL (Grade 1 to 10)', 1, ' FOUNDATION – ECA', 'https://learningzone.com/lms/images/SecondayheadSign.JPG', 'OIS');

-- --------------------------------------------------------

--
-- Table structure for table "fee_mail_log"
--

CREATE TABLE IF NOT EXISTS "fee_mail_log" (
  "fee_mail_log_id"             SERIAL,
  "uid"            VARCHAR(100)  NOT NULL,
  "user"           VARCHAR(200)  NOT NULL,
  "mail_date"      DATE          NOT NULL,
  "status"         SMALLINT    NOT NULL,
  "mail_sentdate"  DATE          NOT NULL,
  "mail_senttime"  TIME          NOT NULL,
  "sentdet"        VARCHAR(250)  NOT NULL,
  PRIMARY KEY ("fee_mail_log_id")
);

--
-- Dumping data for table "fee_mail_log"
--

INSERT INTO "fee_mail_log" ("fee_mail_log_id", "uid", "user", "mail_date", "status", "mail_sentdate", "mail_senttime", "sentdet") VALUES
(88, '1becf26e9f32353e30870060538746e7', 'receipts', '2026-12-13', 1, NULL, '00:00:00', 'Mail sent to ruchiarora79@mail.com  <br>\n'),
(87, '9f655cc8884fda7ad6d8a6fb15cc001e', 'receipts', '2026-12-13', 1, NULL, '00:00:00', 'Mail sent to sapanachandgothia@email.in  <br>\n'),
(86, 'eebe038e47780c96e2762b5e2003cef7', 'receipts', '2026-12-13', 1, NULL, '00:00:00', 'Mail sent to tanejanidhi@email.com  <br>\n'),
(85, 'cacad2aec9f4371413f91805dcea928e', 'receipts', '2026-12-13', 1, NULL, '00:00:00', 'Mail sent to sharmilakarnad@email.com  <br>\n'),
(84, '342c472b95d00421be10e9512b532866', 'receipts', '2026-12-13', 1, NULL, '00:00:00', 'Mail sent to hemangi47@email.com  <br>\n'),
(83, '1b742ae215adf18b75449c6e272fd92d', 'receipts', '2026-12-13', 1, NULL, '00:00:00', 'Mail sent to rekhahiran@email.com  <br>\n'),
(82, 'a440a3d316c5614c7a9310e902f4a43e', 'receipts', '2026-12-13', 1, NULL, '00:00:00', 'Mail sent to anujagoenka@email.com  <br>\n'),
(81, '01ce84968c6969bdd5d51c5eeaa3946a', 'receipts', '2026-12-13', 1, NULL, '00:00:00', 'Mail sent to baileyvn@email.com  <br>\n'),
(80, 'e0a0a422a9069a4cb2b91211a451da4b', 'receipts', '2026-12-13', 1, NULL, '00:00:00', 'Mail sent to narvekar.meera@email.com  <br>\n'),
(79, '1872e3d47e965d2e64f63ca01dd937f9', 'receipts', '2026-12-13', 1, NULL, '00:00:00', 'Mail sent to saloni1610@email.com  <br>\n'),
(78, 'e382f91e2c82c3853aeb0d3948275232', 'receipts', '2026-12-13', 1, NULL, '00:00:00', 'Mail sent to bhavna.banerjee@mail.co.uk  <br>\n'),
(77, 'e334ea177458f7e0c7e6815079acf967', 'receipts', '2026-12-13', 1, NULL, '00:00:00', 'Mail sent to agkhush@email.com  <br>\n'),
(76, 'c61aed648da48aa3893fb3eaadd88a7f', 'receipts', '2026-12-13', 1, NULL, '00:00:00', 'Mail sent to priya@email.com  <br>\n'),

-- --------------------------------------------------------

--
-- Table structure for table "fee_master"
--

CREATE TABLE IF NOT EXISTS "fee_master" (
  "fee_master_id"         SERIAL,
  "dmdid"      INT         DEFAULT NULL,
  "studid"     INT         DEFAULT NULL,
  "pid"        INT         DEFAULT NULL,
  "sid"        INT         DEFAULT NULL,
  "admid"      INT         DEFAULT NULL,
  "bfbalamt"   INT         DEFAULT 0,
  "bfexeamt"   INT         DEFAULT 0,
  "fnamt"      INT         DEFAULT 0,
  "cenamt"     INT         DEFAULT 0,
  "balamt"     INT         DEFAULT 0,
  "exeamt"     INT         DEFAULT 0,
  "accyr"      INT         DEFAULT NULL,
  "pstatus"    SMALLINT  DEFAULT NULL,
  "sclamt"     INT         DEFAULT 0,
  "lsclamt"    INT         DEFAULT 0,
  "refundsts"  SMALLINT  DEFAULT 0,
  "status"     SMALLINT  DEFAULT 0,
  "scl_st"     SMALLINT  DEFAULT 0,
  "dtfee1"     INT         DEFAULT 0,
  "ptfee1"     INT         DEFAULT 0,
  "dtfee2"     INT         DEFAULT 0,
  "ptfee2"     INT         DEFAULT 0,
  "dtfee3"     INT         DEFAULT 0,
  "ptfee3"     INT         DEFAULT 0,
  "dtptfee1"   INT         DEFAULT 0,
  "ptptfee1"   INT         DEFAULT 0,
  "dtptfee2"   INT         DEFAULT 0,
  "ptptfee2"   INT         DEFAULT 0,
  "dtptfee3"   INT         DEFAULT 0,
  "ptptfee3"   INT         DEFAULT 0,
  PRIMARY KEY ("fee_master_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "fee_m_canceled"
--

CREATE TABLE IF NOT EXISTS "fee_m_canceled" (
  "fee_m_canceled_id"               SERIAL,
  "accYear"          INT           NOT NULL,
  "studentId"        INT           NOT NULL,
  "admissionCat"     INT           NOT NULL,
  "currencyType"     INT           NOT NULL,
  "installmentId"    INT           NOT NULL,
  "amount"           NUMERIC(18,2)  NOT NULL,
  "fine"             DOUBLE PRECISION        NOT NULL,
  "paymentDate"      DATE          NOT NULL,
  "mode_of_payment"  SMALLINT    NOT NULL,
  "bankName"         INT           NOT NULL,
  "bankDetails"      VARCHAR(250)  NOT NULL,
  "ddChequeNo"       VARCHAR(30)   NOT NULL,
  "ddChequeDate"     DATE          NOT NULL,
  "clearedDate"      DATE          NOT NULL,
  "amountCleared"    NUMERIC(18,2)  NOT NULL,
  "remarks"          TEXT          NOT NULL,
  "receipt"          VARCHAR(20)   NOT NULL,
  "status"           SMALLINT    NOT NULL,
  PRIMARY KEY ("fee_m_canceled_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "fee_m_cheque_det"
--

CREATE TABLE IF NOT EXISTS "fee_m_cheque_det" (
  "fee_m_cheque_det_id"            SERIAL,
  "receiptId"     INT           NOT NULL,
  "receiptDet"    VARCHAR(20)   NOT NULL,
  "bankName"      INT           NOT NULL,
  "amount"        NUMERIC(18,2)  NOT NULL,
  "ddChequeNo"    VARCHAR(50)   NOT NULL,
  "ddChequeDate"  DATE          NOT NULL,
  "clearedDate"   DATE          NOT NULL,
  "cleared"       NUMERIC(18,2)  NOT NULL,
  "remarks"       TEXT          NOT NULL,
  "status"        SMALLINT    NOT NULL,
  PRIMARY KEY ("fee_m_cheque_det_id")
);

--
-- Dumping data for table "fee_m_cheque_det"
--

INSERT INTO "fee_m_cheque_det" ("fee_m_cheque_det_id", "receiptId", "receiptDet", "bankName", "amount", "ddChequeNo", "ddChequeDate", "clearedDate", "cleared", "remarks", "status") VALUES
(1090, 626, 'EM/FR/2026/1', 51, 89500.00, '12345', '2026-04-16', NULL, 0.00, '', 1),
(1091, 627, 'EM/FR/2026/2', 19, 89500.00, '12345', '2026-04-15', NULL, 0.00, '', 1),
(1092, 629, 'EM/FR/2026/4', 0, 0.00, '', '2026-01-01', NULL, 0.00, '', 1);

-- --------------------------------------------------------

--
-- Table structure for table "fee_m_collect"
--

CREATE TABLE IF NOT EXISTS "fee_m_collect" (
  "fee_m_collect_id"               SERIAL,
  "accYear"          INT           NOT NULL,
  "studentId"        INT           NOT NULL,
  "admissionCat"     INT           NOT NULL,
  "currencyType"     INT           NOT NULL,
  "installmentId"    INT           NOT NULL,
  "amount"           NUMERIC(18,2)  NOT NULL,
  "totalAmount"      NUMERIC(18,2)  NOT NULL,
  "totalDisAmount"   NUMERIC(18,2)  NOT NULL,
  "discountType"     INT           NOT NULL,
  "fine"             NUMERIC(18,2)  NOT NULL,
  "paymentDate"      DATE          NOT NULL,
  "mode_of_payment"  SMALLINT    NOT NULL,
  "userDetails"      TEXT          NOT NULL,
  "noOfddCheque"     VARCHAR(30)   NOT NULL,
  "amountCleared"    NUMERIC(18,2)  NOT NULL,
  "clearedDate"      DATE          NOT NULL,
  "remarks"          TEXT          NOT NULL,
  "receipt"          VARCHAR(20)   NOT NULL,
  "status"           SMALLINT    NOT NULL,
  "remarks_cancel"   TEXT          NOT NULL,
  "date_cancel"      DATE          NOT NULL,
  PRIMARY KEY ("fee_m_collect_id")
);

--
-- Dumping data for table "fee_m_collect"
--

INSERT INTO "fee_m_collect" ("fee_m_collect_id", "accYear", "studentId", "admissionCat", "currencyType", "installmentId", "amount", "totalAmount", "totalDisAmount", "discountType", "fine", "paymentDate", "mode_of_payment", "userDetails", "noOfddCheque", "amountCleared", "clearedDate", "remarks", "receipt", "status", "remarks_cancel", "date_cancel") VALUES
(626, 2026, 650, 1, 1, 1, 89500.00, 89500.00, 0.00, 0, 0.00, '2026-04-17', 3, 'administrator 17-04-2026 17:34:42', '1', 0.00, NULL, 'Payment for 1st installment made', 'EM/FR/2026/1', 1, '', NULL),
(627, 2026, 726, 1, 1, 1, 89500.00, 89500.00, 0.00, 0, 0.00, '2026-04-17', 3, 'administrator 17-04-2026 17:51:16', '1', 0.00, NULL, 'Testing description', 'EM/FR/2026/2', 1, '', NULL),
(628, 2026, 841, 1, 1, 1, 89500.00, 89500.00, 0.00, 0, 0.00, '2026-05-30', 1, 'administrator 30-05-2026 10:21:44', '0', 89500.00, '2026-05-30', '', 'EM/FR/2026/3', 1, '', NULL),
(629, 2026, 841, 1, 1, 2, 89500.00, 89500.00, 0.00, 0, 0.00, '2026-05-31', 3, 'administrator 31-05-2026 09:24:28', '1', 0.00, NULL, '', 'EM/FR/2026/4', 1, '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table "fee_m_collect_admission"
--

CREATE TABLE IF NOT EXISTS "fee_m_collect_admission" (
  "fee_m_collect_admission_id"               SERIAL,
  "studentId"        INT           NOT NULL,
  "currencyType"     INT           NOT NULL,
  "amount"           NUMERIC(18,2)  NOT NULL,
  "paymentDate"      DATE          NOT NULL,
  "mode_of_payment"  SMALLINT    NOT NULL,
  "userDetails"      TEXT          NOT NULL,
  "noOfddCheque"     VARCHAR(30)   NOT NULL,
  "amountCleared"    NUMERIC(18,2)  NOT NULL,
  "clearedDate"      DATE          NOT NULL,
  "remarks"          TEXT          NOT NULL,
  "receipt"          VARCHAR(20)   NOT NULL,
  "status"           SMALLINT    NOT NULL,
  "remarks_cancel"   TEXT          NOT NULL,
  "date_cancel"      DATE          NOT NULL,
  PRIMARY KEY ("fee_m_collect_admission_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "fee_m_conversion_rate"
--

CREATE TABLE IF NOT EXISTS "fee_m_conversion_rate" (
  "fee_m_conversion_rate_id"               SERIAL,
  "c_date"           DATE        NOT NULL,
  "native_currency"  INT         NOT NULL,
  "currency"         INT         NOT NULL,
  "conversion_rate"  DOUBLE PRECISION      NOT NULL,
  "bankCharges"      DOUBLE PRECISION      NOT NULL,
  "remarks"          TEXT        NOT NULL,
  "status"           SMALLINT  NOT NULL,
  PRIMARY KEY ("fee_m_conversion_rate_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "fee_m_currency_code"
--

CREATE TABLE IF NOT EXISTS "fee_m_currency_code" (
  "fee_m_currency_code_id"           SERIAL,
  "name"         VARCHAR(10)   NOT NULL,
  "description"  VARCHAR(50)   NOT NULL,
  "code"         VARCHAR(350)  NOT NULL,
  "status"       SMALLINT    NOT NULL,
  PRIMARY KEY ("fee_m_currency_code_id")
);

--
-- Dumping data for table "fee_m_currency_code"
--

INSERT INTO "fee_m_currency_code" ("fee_m_currency_code_id", "name", "description", "code", "status") VALUES
(1, 'INR', 'Rupee', '<b>&#x20B9;</b>', 1),
(2, 'USD', 'Dollar', '<b>&#36;</b>', 1),
(3, 'EUR', 'Euro', '<b>&#128;</b>', 1),
(4, 'GBP', 'Pounds', '<b>&#163;</b>', 1);

-- --------------------------------------------------------

--
-- Table structure for table "fee_m_descrption"
--

CREATE TABLE IF NOT EXISTS "fee_m_descrption" (
  "fee_m_descrption_id"             SERIAL,
  "uid"            VARCHAR(35)  NOT NULL,
  "accyear"        INT          NOT NULL,
  "academicYear"   INT          NOT NULL,
  "class"          INT          NOT NULL,
  "adm_cat"        INT          NOT NULL,
  "no_of_instal"   INT          DEFAULT 0,
  "currency"       INT          NOT NULL,
  "no_of_student"  INT          DEFAULT 0,
  "status"         SMALLINT   DEFAULT 0,
  PRIMARY KEY ("fee_m_descrption_id")
);

--
-- Dumping data for table "fee_m_descrption"
--

INSERT INTO "fee_m_descrption" ("fee_m_descrption_id", "uid", "accyear", "academicYear", "class", "adm_cat", "no_of_instal", "currency", "no_of_student", "status") VALUES
(257, '26259f55dce251b7f48b2d6dde83cc49', 0, 0, 1, 1, 2, 1, 2, 1),
(258, '30b69beef45b642cddad80fd5a7f1d21', 6, 0, 1, 1, 1, 1, 2, 1),
(259, '6c3ccaa50629ecff340b6677b02eb8a8', 6, 0, 2, 1, 1, 1, 0, 1),
(260, 'b3bd01d9ed5978c100e982face61f002', 8, 0, 2, 1, 1, 1, 0, 1),
(261, '9501c36a7759e56ae61f37c33821b9a9', 6, 0, 3, 1, 1, 1, 0, 1),
(262, '3ea652d37d7e198a1900f77adcadb388', 8, 0, 3, 1, 1, 1, 0, 1),
(263, '2abbc2245a417536ad5bebb010f72aa8', 6, 0, 4, 1, 1, 1, 0, 1),
(264, '8323cd01ea7ae3c5e011ae33de6b86ad', 7, 0, 4, 1, 1, 1, 0, 1),
(265, '779d2172a25ab3440de735d9ae5b07a2', 6, 0, 15, 1, 1, 1, 0, 1),
(266, '78953ef52a7e47fdb5a429ba83be716f', 9, 0, 15, 1, 1, 1, 0, 1),
(267, '500bdfe572bc89a447046e0f01247fdd', 7, 0, 15, 1, 1, 1, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table "fee_m_descrption_head_total"
--

CREATE TABLE IF NOT EXISTS "fee_m_descrption_head_total" (
  "fee_m_descrption_head_total_id"          SERIAL,
  "uid"         VARCHAR(35)   NOT NULL,
  "head_id"     INT           NOT NULL,
  "amount"      NUMERIC(18,2)   NOT NULL,
  "sts"         SMALLINT    DEFAULT 0,
  "discomment"  VARCHAR(250)  NOT NULL,
  PRIMARY KEY ("fee_m_descrption_head_total_id")
);

--
-- Dumping data for table "fee_m_descrption_head_total"
--

INSERT INTO "fee_m_descrption_head_total" ("fee_m_descrption_head_total_id", "uid", "head_id", "amount", "sts", "discomment") VALUES
(1021, '26259f55dce251b7f48b2d6dde83cc49', 5, 179000.00, 1, ''),
(1022, '30b69beef45b642cddad80fd5a7f1d21', 5, 125000.00, 1, 'PDC dated November 30th, 2026'),
(1023, '30b69beef45b642cddad80fd5a7f1d21', 6, 0.00, 1, ''),
(1024, '6c3ccaa50629ecff340b6677b02eb8a8', 5, 220000.00, 1, 'PDC dated November 30th, 2026'),
(1025, '6c3ccaa50629ecff340b6677b02eb8a8', 6, 0.00, 1, ''),
(1026, 'b3bd01d9ed5978c100e982face61f002', 5, 55000.00, 1, 'PDC dated November 30th, 2026'),
(1027, 'b3bd01d9ed5978c100e982face61f002', 6, 0.00, 1, ''),
(1028, '9501c36a7759e56ae61f37c33821b9a9', 5, 237500.00, 1, 'PDC dated November 30th, 2026'),
(1029, '9501c36a7759e56ae61f37c33821b9a9', 6, 0.00, 1, ''),
(1030, '3ea652d37d7e198a1900f77adcadb388', 5, 59375.00, 1, 'PDC dated November 30th, 2026');

-- --------------------------------------------------------

--
-- Table structure for table "fee_m_descrption_inst_total"
--

CREATE TABLE IF NOT EXISTS "fee_m_descrption_inst_total" (
  "fee_m_descrption_inst_total_id"             SERIAL,
  "uid"            VARCHAR(35)  NOT NULL,
  "inst_id"        INT          NOT NULL,
  "amount"         NUMERIC(18,2)  NOT NULL,
  "f_due_date"     DATE         NOT NULL,
  "t_due_date"     DATE         NOT NULL,
  "no_of_student"  INT          NOT NULL,
  "sts"            SMALLINT   DEFAULT 0,
  PRIMARY KEY ("fee_m_descrption_inst_total_id")
);

--
-- Dumping data for table "fee_m_descrption_inst_total"
--

INSERT INTO "fee_m_descrption_inst_total" ("fee_m_descrption_inst_total_id", "uid", "inst_id", "amount", "f_due_date", "t_due_date", "no_of_student", "sts") VALUES
(256, '26259f55dce251b7f48b2d6dde83cc49', 1, 89500.00, '2026-04-01', '2026-05-31', 1, 1),
(257, '26259f55dce251b7f48b2d6dde83cc49', 2, 89500.00, '2026-08-01', '2026-08-31', 1, 1),
(258, '30b69beef45b642cddad80fd5a7f1d21', 1, 250000.00, NULL, NULL, 2, 1),
(259, '30b69beef45b642cddad80fd5a7f1d21', 2, 89500.00, '2026-08-01', '2026-08-31', 0, 1),
(340, '6d832a595895fc44e17dfe611b3064a5', 1, 600000.00, NULL, NULL, 0, 1),
(260, '6c3ccaa50629ecff340b6677b02eb8a8', 1, 440000.00, NULL, NULL, 0, 1),
(261, '6c3ccaa50629ecff340b6677b02eb8a8', 2, 182500.00, '2026-05-01', '2026-11-30', 0, 1),
(262, 'b3bd01d9ed5978c100e982face61f002', 1, 220000.00, NULL, NULL, 0, 1),
(263, 'b3bd01d9ed5978c100e982face61f002', 2, 91250.00, '2026-05-01', '2026-11-30', 0, 1),
(264, '9501c36a7759e56ae61f37c33821b9a9', 1, 475000.00, NULL, NULL, 0, 1),
(265, '9501c36a7759e56ae61f37c33821b9a9', 2, 182500.00, '2026-05-01', '2026-11-30', 0, 1),
(266, '3ea652d37d7e198a1900f77adcadb388', 1, 237500.00, NULL, NULL, 0, 1),
(267, '3ea652d37d7e198a1900f77adcadb388', 2, 91250.00, '2026-05-01', '2026-11-30', 0, 1),
(268, '2abbc2245a417536ad5bebb010f72aa8', 1, 495000.00, NULL, NULL, 0, 1);


-- --------------------------------------------------------

--
-- Table structure for table "fee_m_descrption_invoice"
--

CREATE TABLE IF NOT EXISTS "fee_m_descrption_invoice" (
  "fee_m_descrption_invoice_id"            SERIAL,
  "uid"           VARCHAR(35)  NOT NULL,
  "academicYear"  INT          NOT NULL,
  "studentId"     INT          NOT NULL,
  "invId"         INT          NOT NULL,
  "class"         INT          NOT NULL,
  "adm_cat"       INT          NOT NULL,
  "no_of_instal"  INT          DEFAULT 0,
  "invoiceid"     VARCHAR(20)  NOT NULL,
  "invoiceDate"   DATE         NOT NULL,
  "status"        SMALLINT   DEFAULT 0,
  PRIMARY KEY ("fee_m_descrption_invoice_id")
);

--
-- Dumping data for table "fee_m_descrption_invoice"
--

INSERT INTO "fee_m_descrption_invoice" ("fee_m_descrption_invoice_id", "uid", "academicYear", "studentId", "invId", "class", "adm_cat", "no_of_instal", "invoiceid", "invoiceDate", "status") VALUES
(506, '30b69beef45b642cddad80fd5a7f1d21', 2026, 0, 100, 1, 1, 1, 'I/OEY/13-14/1', '2026-02-25', 0),
(4150, 'b7832ddfc2017741b1a683a7c15d8a02', 2026, 68, 1548, 14, 1, 1, 'I/OIS/14-15/1548', '2026-03-20', 1),
(4151, 'b7832ddfc2017741b1a683a7c15d8a02', 2026, 41, 1549, 14, 1, 1, 'I/OIS/14-15/1549', '2026-03-20', 1),
(4145, 'f9768ec5f6b8258b5353cdf70608fcaa', 2026, 28, 1543, 14, 1, 1, 'I/OIS/14-15/1543', '2026-03-20', 1),
(4146, 'b7832ddfc2017741b1a683a7c15d8a02', 2026, 1222, 1544, 14, 1, 1, 'I/OIS/14-15/1544', '2026-03-20', 1),
(4147, 'b7832ddfc2017741b1a683a7c15d8a02', 2026, 1245, 1545, 14, 1, 1, 'I/OIS/14-15/1545', '2026-03-20', 1),
(4148, '5d6d6e38c7fb87f7850898375483f46d', 2026, 1220, 1546, 14, 1, 1, 'I/OIS/14-15/1546', '2026-03-20', 1),
(4149, 'b7832ddfc2017741b1a683a7c15d8a02', 2026, 1232, 1547, 14, 1, 1, 'I/OIS/14-15/1547', '2026-03-20', 1),
(4144, 'b7832ddfc2017741b1a683a7c15d8a02', 2026, 1278, 1542, 14, 1, 1, 'I/OIS/14-15/1542', '2026-03-20', 1),
(4143, 'b7832ddfc2017741b1a683a7c15d8a02', 2026, 1015, 1541, 14, 1, 1, 'I/OIS/14-15/1541', '2026-03-20', 1);

-- --------------------------------------------------------

--
-- Table structure for table "fee_m_descrption_invoice_eca"
--

CREATE TABLE IF NOT EXISTS "fee_m_descrption_invoice_eca" (
  "fee_m_descrption_invoice_eca_id"            INT          NOT NULL DEFAULT 0,
  "uid"           VARCHAR(35)  NOT NULL,
  "academicYear"  INT          NOT NULL,
  "studentId"     INT          NOT NULL,
  "invId"         INT          NOT NULL,
  "class"         INT          NOT NULL,
  "adm_cat"       INT          NOT NULL,
  "no_of_instal"  INT          DEFAULT 0,
  "invoiceid"     VARCHAR(20)  NOT NULL,
  "invoiceDate"   DATE         NOT NULL,
  "status"        SMALLINT   DEFAULT 0,
  PRIMARY KEY ("fee_m_descrption_invoice_eca_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "fee_m_descrption_invoice_head"
--

CREATE TABLE IF NOT EXISTS "fee_m_descrption_invoice_head" (
  "fee_m_descrption_invoice_head_id"            SERIAL,
  "invoice_id"    INT           NOT NULL,
  "requestedAmt"  NUMERIC(18,2)  NOT NULL,
  "discountAmt"   NUMERIC(18,2)  NOT NULL,
  "recivedAmt"    NUMERIC(18,2)  NOT NULL,
  "status"        SMALLINT    NOT NULL DEFAULT 1,
  "fee_head"      INT           NOT NULL,
  PRIMARY KEY ("fee_m_descrption_invoice_head_id")
);

--
-- Dumping data for table "fee_m_descrption_invoice_head"
--

INSERT INTO "fee_m_descrption_invoice_head" ("fee_m_descrption_invoice_head_id", "invoice_id", "requestedAmt", "discountAmt", "recivedAmt", "status", "fee_head") VALUES
(5821, 2533, 220000.00, 0.00, 220000.00, 1, 4),
(5822, 2533, 220000.00, 0.00, 220000.00, 1, 5),
(5823, 2533, 1175.00, 0.00, 1175.00, 1, 8),
(5824, 2534, 220000.00, 0.00, 220000.00, 1, 4),
(5825, 2534, 220000.00, 0.00, 220000.00, 1, 5),
(5826, 2534, 575.00, 0.00, 575.00, 1, 8),
(5827, 2535, 220000.00, 0.00, 220000.00, 1, 4),
(5828, 2535, 220000.00, 0.00, 220000.00, 1, 5),
(5829, 2535, 375.00, 0.00, 375.00, 1, 8),
(5830, 2536, 220000.00, 0.00, 220000.00, 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table "fee_m_head_inst_collected"
--

CREATE TABLE IF NOT EXISTS "fee_m_head_inst_collected" (
  "fee_m_head_inst_collected_id"              SERIAL,
  "uid"             VARCHAR(50)   NOT NULL,
  "accYear"         INT           NOT NULL,
  "instId"          INT           NOT NULL,
  "receipt"         VARCHAR(20)   NOT NULL,
  "studentId"       INT           NOT NULL,
  "feeHead"         INT           NOT NULL,
  "totalAmount"     NUMERIC(18,2)  NOT NULL,
  "totalAmountDet"  NUMERIC(18,2)  NOT NULL,
  "totalDisAmount"  NUMERIC(18,2)  NOT NULL,
  "discountType"    INT           NOT NULL,
  "totalConverted"  NUMERIC(18,2)  NOT NULL,
  "currency"        INT           NOT NULL,
  "status"          SMALLINT    NOT NULL,
  PRIMARY KEY ("fee_m_head_inst_collected_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "fee_m_head_total"
--

CREATE TABLE IF NOT EXISTS "fee_m_head_total" (
  "fee_m_head_total_id"              SERIAL,
  "uid"             VARCHAR(50)   NOT NULL,
  "accYear"         INT           NOT NULL,
  "studentId"       INT           NOT NULL,
  "feeHead"         INT           NOT NULL,
  "oneTime"         SMALLINT    NOT NULL,
  "totalCollected"  NUMERIC(18,2)  NOT NULL,
  "refund"          SMALLINT    NOT NULL,
  "refundAmount"    NUMERIC(18,2)  NOT NULL,
  "cleared"         SMALLINT    NOT NULL,
  "status"          SMALLINT    NOT NULL,
  PRIMARY KEY ("fee_m_head_total_id")
);

--
-- Dumping data for table "fee_m_head_total"
--

INSERT INTO "fee_m_head_total" ("fee_m_head_total_id", "uid", "accYear", "studentId", "feeHead", "oneTime", "totalCollected", "refund", "refundAmount", "cleared", "status") VALUES
(158, '30b69beef45b642cddad80fd5a7f1d21', 2026, 650, 5, 2, 89500.00, 0, 0.00, 0, 1),
(159, '30b69beef45b642cddad80fd5a7f1d21', 2026, 726, 5, 2, 89500.00, 0, 0.00, 0, 1),
(160, '26259f55dce251b7f48b2d6dde83cc49', 2026, 841, 5, 2, 0.00, 0, 0.00, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table "fee_payment"
--

CREATE TABLE IF NOT EXISTS "fee_payment" (
  "fee_payment_id"           SERIAL,
  "fmid"         INT           DEFAULT NULL,
  "studid"       INT           DEFAULT NULL,
  "pid"          INT           DEFAULT NULL,
  "sid"          INT           DEFAULT NULL,
  "tmid"         SMALLINT    DEFAULT NULL,
  "admid"        INT           DEFAULT NULL,
  "docid"        VARCHAR(25)   DEFAULT NULL,
  "bfexeamt"     INT           DEFAULT NULL,
  "bfbalamt"     INT           DEFAULT 0,
  "pdamt"        INT           DEFAULT NULL,
  "docamt"       INT           DEFAULT NULL,
  "mop"          SMALLINT    DEFAULT NULL,
  "pay_dt"       DATE          DEFAULT NULL,
  "bkid"         INT           DEFAULT NULL,
  "brchdet"      VARCHAR(255)  DEFAULT NULL,
  "ddno"         VARCHAR(25)   DEFAULT NULL,
  "dddt"         DATE          DEFAULT NULL,
  "fnamt"        INT           DEFAULT NULL,
  "cenamt"       INT           DEFAULT NULL,
  "balamt"       INT           DEFAULT NULL,
  "exeamt"       INT           DEFAULT NULL,
  "ins_dt"       DATE          DEFAULT NULL,
  "remks"        VARCHAR(255)  DEFAULT NULL,
  "recptstatus"  SMALLINT    DEFAULT 0,
  "uid"          INT           DEFAULT NULL,
  "accyr"        INT           DEFAULT NULL,
  "canuid"       INT           DEFAULT NULL,
  "pdtptfee"     INT           DEFAULT NULL,
  "pd1"          INT           NOT NULL,
  "pd2"          INT           NOT NULL,
  "pd3"          INT           NOT NULL,
  "pd4"          INT           DEFAULT 0,
  "pd5"          INT           DEFAULT 0,
  "pd6"          INT           DEFAULT 0,
  "pd7"          INT           DEFAULT 0,
  "pd8"          INT           DEFAULT 0,
  "pd9"          INT           DEFAULT 0,
  PRIMARY KEY ("fee_payment_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "fee_slab_student"
--

CREATE TABLE IF NOT EXISTS "fee_slab_student" (
  "fee_slab_student_id"          SERIAL,
  "student_id"  INT         NOT NULL,
  "slab_id"     INT         NOT NULL,
  "acc_year"    INT         NOT NULL,
  "status"      SMALLINT  NOT NULL,
  PRIMARY KEY ("fee_slab_student_id")
);

--
-- Dumping data for table "fee_slab_student"
--

INSERT INTO "fee_slab_student" ("fee_slab_student_id", "student_id", "slab_id", "acc_year", "status") VALUES
(1264, 639, 6, 2026, 1),
(1265, 632, 6, 2026, 1),
(1266, 648, 6, 2026, 1),
(1267, 642, 6, 2026, 1),
(1268, 636, 6, 2026, 1),
(1269, 625, 6, 2026, 1),
(1270, 635, 6, 2026, 1),
(1271, 599, 6, 2026, 1),
(1272, 647, 6, 2026, 1),
(1273, 644, 6, 2026, 1),
(1274, 645, 6, 2026, 1);

-- --------------------------------------------------------

--
-- Table structure for table "fee_tax"
--

CREATE TABLE IF NOT EXISTS "fee_tax" (
  "fee_tax_id"        SERIAL,
  "tax_name"  VARCHAR(100)  NOT NULL,
  "value"     NUMERIC(18,2)  NOT NULL,
  "fdate"     DATE          NOT NULL,
  "tdate"     DATE          NOT NULL,
  "typeid"    INT           NOT NULL,
  PRIMARY KEY ("fee_tax_id")
);

--
-- Dumping data for table "fee_tax"
--

INSERT INTO "fee_tax" ("fee_tax_id", "tax_name", "value", "fdate", "tdate", "typeid") VALUES
(1, 'Service Tax  Cess @ 12%', 12.00, '2026-04-01', '2026-03-31', 1),
(2, 'Education Cess @ 2%', 2.00, '2026-04-01', '2026-03-31', 2),
(3, 'Secondary and Higher Education Cess @ 1%', 1.00, '2026-04-01', '2026-03-31', 3);

-- --------------------------------------------------------

--
-- Table structure for table "fee_type"
--

CREATE TABLE IF NOT EXISTS "fee_type" (
  "fee_id"     SERIAL,
  "fee_name"   VARCHAR(100)  NOT NULL DEFAULT '',
  "catid"      NUMERIC(18,2)  DEFAULT '0.00',
  "refund"     INT           DEFAULT 1,
  "status"     INT           DEFAULT 1,
  "ftype"      SMALLINT    DEFAULT 1,
  "fee_order"  INT           NOT NULL,
  PRIMARY KEY ("fee_id")
);

--
-- Dumping data for table "fee_type"
--

INSERT INTO "fee_type" ("fee_id", "fee_name", "catid", "refund", "status", "ftype", "fee_order") VALUES
(1, 'Admission Fees', 15.50, 0, 1, 1, 1),
(2, 'Secutiy Deposit', 10.00, 1, 1, 1, 2),
(3, 'Imprest', 0.00, 0, 1, 1, 4),
(4, 'Tution Fees - I', 0.00, 0, 1, 2, 3),
(5, 'Tution Fees - II', 0.00, 0, 1, 2, 6),
(6, 'Application Processing Fees', 0.00, 0, 1, 1, 7),
(7, 'Excess payment', 0.00, 0, 1, 2, 8),
(8, 'Imprest', 0.00, 0, 1, 1, 4),
(9, 'Graduation fees', 0.00, 0, 1, 1, 5);

-- --------------------------------------------------------

--
-- Table structure for table "fee_upload"
--

CREATE TABLE IF NOT EXISTS "fee_upload" (
  "fee_upload_id"                SERIAL,
  "feeDate"           VARCHAR(20)   NOT NULL,
  "receitNo"          VARCHAR(100)  NOT NULL,
  "name"              VARCHAR(100)  NOT NULL,
  "enrollmentNo"      VARCHAR(100)  NOT NULL,
  "grade"             VARCHAR(100)  NOT NULL,
  "category"          VARCHAR(100)  NOT NULL,
  "bank"              VARCHAR(100)  NOT NULL,
  "chqno"             VARCHAR(100)  NOT NULL,
  "total"             NUMERIC(18,2)  NOT NULL,
  "penaltyCharges"    VARCHAR(100)  NOT NULL,
  "inword"            TEXT          NOT NULL,
  "comment"           TEXT          NOT NULL,
  "acc_year"          INT           NOT NULL,
  "fee_head"          VARCHAR(200)  NOT NULL,
  "feedet1"           VARCHAR(200)  NOT NULL,
  "amt1"              NUMERIC(18,2)  NOT NULL,
  "feedet2"           VARCHAR(200)  NOT NULL,
  "amt2"              NUMERIC(18,2)  NOT NULL,
  "feedet3"           VARCHAR(200)  NOT NULL,
  "amt3"              NUMERIC(18,2)  NOT NULL,
  "feedet4"           VARCHAR(200)  NOT NULL,
  "amt4"              NUMERIC(18,2)  NOT NULL,
  "feedet5"           VARCHAR(200)  NOT NULL,
  "amt5"              NUMERIC(18,2)  NOT NULL,
  "feedet6"           VARCHAR(200)  NOT NULL,
  "amt6"              NUMERIC(18,2)  NOT NULL,
  "feedet7"           VARCHAR(200)  NOT NULL,
  "amt7"              NUMERIC(18,2)  NOT NULL,
  "feedet8"           VARCHAR(200)  NOT NULL,
  "amt8"              NUMERIC(18,2)  NOT NULL,
  "feedet9"           VARCHAR(200)  NOT NULL,
  "amt9"              NUMERIC(18,2)  NOT NULL,
  "feedet10"          VARCHAR(200)  NOT NULL,
  "amt10"             NUMERIC(18,2)  NOT NULL,
  "fee_rec_type"      SMALLINT    NOT NULL,
  "fee_uploade_date"  DATE          NOT NULL,
  "fee_uploade_user"  VARCHAR(200)  NOT NULL,
  "fee_deleted_date"  DATE          NOT NULL,
  "fee_deleted_user"  VARCHAR(200)  NOT NULL,
  "publish"           SMALLINT    NOT NULL DEFAULT 0,
  "uid"               VARCHAR(70)   NOT NULL,
  PRIMARY KEY ("fee_upload_id")
);

--
-- Dumping data for table "fee_upload"
--

INSERT INTO "fee_upload" ("fee_upload_id", "feeDate", "receitNo", "name", "enrollmentNo", "grade", "category", "bank", "chqno", "total", "penaltyCharges", "inword", "comment", "acc_year", "fee_head", "feedet1", "amt1", "feedet2", "amt2", "feedet3", "amt3", "feedet4", "amt4", "feedet5", "amt5", "feedet6", "amt6", "feedet7", "amt7", "feedet8", "amt8", "feedet9", "amt9", "feedet10", "amt10", "fee_rec_type", "fee_uploade_date", "fee_uploade_user", "fee_deleted_date", "fee_deleted_user", "publish", "uid") VALUES
(9905, '30/11/2026', 'TFII/OIS/1742', 'Sarthak Darekar', 'A106', 'VI', 'Cheque', 'State Bank of India', 'Cheque No. 014557', 299750.00, '', 'Rupees Two Lakhs Ninety Nine Thousand Seven Hundred Fifty  and Paise Zero Only ', '', 2026, 'School fees for AY 2026-14', 'Tution Fees - II', 299750.00, '', 0.00, '', 0.00, '', 0.00, '', 0.00, '', 0.00, '', 0.00, '', 0.00, '', 0.00, '', 0.00, 1, '2026-12-11', 'administrator', NULL, '', 1, '36ae77db7915835abc105f631f0391f8'),
(9906, '30/11/2026', 'TFII/OIS/1743', 'Selina Ranchal', 'A407', 'VII', 'Cheque', 'State Bank of India', 'Cheque No. 004782', 299750.00, '', 'Rupees Two Lakhs Ninety Nine Thousand Seven Hundred Fifty  and Paise Zero Only ', '', 2026, 'School fees for AY 2026-14', 'Tution Fees - II', 299750.00, '', 0.00, '', 0.00, '', 0.00, '', 0.00, '', 0.00, '', 0.00, '', 0.00, '', 0.00, '', 0.00, 1, '2026-12-11', 'administrator', NULL, '', 1, 'c5383525e91474a4e5d7dcfee92c054f'),
(9907, '30/11/2026', 'TFII/OIS/1744', 'Varun Sivakumar', 'A459', 'VIII', 'Cheque', 'State Bank of India', 'Cheque No. 676392', 299750.00, '', 'Rupees Two Lakhs Ninety Nine Thousand Seven Hundred Fifty  and Paise Zero Only ', '', 2026, 'School fees for AY 2026-14', 'Tution Fees - II', 299750.00, '', 0.00, '', 0.00, '', 0.00, '', 0.00, '', 0.00, '', 0.00, '', 0.00, '', 0.00, '', 0.00, 1, '2026-12-11', 'administrator', NULL, '', 1, '4d289c150fc83d36f5158512246e3bfe'),
(9908, '30/11/2026', 'TFII/OIS/1745', 'Aaryan Shetty', 'A056', 'VI', 'Cheque', 'State Bank of India', 'Cheque No. 274431', 258750.00, '', 'Rupees Two Lakhs Fifty Eight Thousand Seven Hundred Fifty  and Paise Zero Only ', '', 2026, 'School fees for AY 2026-14', 'Tution Fees - II', 258750.00, '', 0.00, '', 0.00, '', 0.00, '', 0.00, '', 0.00, '', 0.00, '', 0.00, '', 0.00, '', 0.00, 1, '2026-12-11', 'administrator', NULL, '', 1, '515b9d40500ef7d05007b5668991fc7c'),
(9909, '30/11/2026', 'TFII/OIS/1746', 'Anushka Gupta', 'A793', 'V', 'Cheque', 'State Bank of India', 'Cheque No. 034414', 122625.00, '', 'Rupees  One Lakh Twenty Two Thousand Six Hundred Twenty Five and Paise Zero Only ', '', 2026, 'School fees for AY 2026-14', 'Tution Fees - II', 122625.00, '', 0.00, '', 0.00, '', 0.00, '', 0.00, '', 0.00, '', 0.00, '', 0.00, '', 0.00, '', 0.00, 1, '2026-12-11', 'administrator', NULL, '', 1, '1980fa3bbff704c8bec1b7196cf7dfbc'),
(9976, '28/11/2026', 'TFI/OIS/991', 'Shreeya Bidawatka', 'A112', 'III', 'RTGS', 'Direct Credit', '', 200000.00, '', 'Rupees Two Lakhs Zero and Paise Zero Only', '', 2026, 'School fees for AY 2026-14', 'Tution Fees - II', 200000.00, '', 0.00, '', 0.00, '', 0.00, '', 0.00, '', 0.00, '', 0.00, '', 0.00, '', 0.00, '', 0.00, 1, '2026-12-11', 'administrator', NULL, '', 1, '4800deb3f3be382f97782401f775184a'),
(9974, '25/11/2026', 'AFSD/OIS/168', 'Vishesh Khakhar', 'A12569', 'IX', 'Cheque', 'State Bank of India', 'Cheque No. 238818', 150000.00, '', 'Rupees One Lakh Fifty Thousand and Paise Zero Only', '', 2026, 'School fees for AY 2026-14', 'Admission Fees', 100000.00, 'Security Deposit', 50000.00, '', 0.00, '', 0.00, '', 0.00, '', 0.00, '', 0.00, '', 0.00, '', 0.00, '', 0.00, 1, '2026-12-11', 'administrator', NULL, '', 1, 'fced4f35799409dd854ebeaea7db546d'),
(9972, '22/11/2026', 'TFI/OIS/988', 'Phoung Duc', 'A12553', 'I', 'RTGS', 'Direct Credit', '', 245250.00, '', 'Rupees Two Lakhs Forty Five Thousand Two Hundred Fifty and Paise Zero Only', '', 2026, 'School fees for AY 2026-14', 'Tution Fees - II', 245250.00, '', 0.00, '', 0.00, '', 0.00, '', 0.00, '', 0.00, '', 0.00, '', 0.00, '', 0.00, '', 0.00, 1, '2026-12-11', 'administrator', NULL, '', 1, '35675fd71a153bf3baab29b904e525c8');

-- --------------------------------------------------------

--
-- Table structure for table "fee_upload_deleted"
--

CREATE TABLE IF NOT EXISTS "fee_upload_deleted" (
  "fee_upload_deleted_id"                SERIAL,
  "feeDate"           VARCHAR(20)   NOT NULL,
  "receitNo"          VARCHAR(100)  NOT NULL,
  "name"              VARCHAR(100)  NOT NULL,
  "enrollmentNo"      VARCHAR(100)  NOT NULL,
  "grade"             VARCHAR(100)  NOT NULL,
  "category"          VARCHAR(100)  NOT NULL,
  "bank"              VARCHAR(100)  NOT NULL,
  "chqno"             VARCHAR(100)  NOT NULL,
  "total"             NUMERIC(18,2)  NOT NULL,
  "penaltyCharges"    VARCHAR(100)  NOT NULL,
  "inword"            TEXT          NOT NULL,
  "comment"           TEXT          NOT NULL,
  "acc_year"          INT           NOT NULL,
  "fee_head"          VARCHAR(200)  NOT NULL,
  "feedet1"           VARCHAR(200)  NOT NULL,
  "amt1"              NUMERIC(18,2)  NOT NULL,
  "feedet2"           VARCHAR(200)  NOT NULL,
  "amt2"              NUMERIC(18,2)  NOT NULL,
  "feedet3"           VARCHAR(200)  NOT NULL,
  "amt3"              NUMERIC(18,2)  NOT NULL,
  "feedet4"           VARCHAR(200)  NOT NULL,
  "amt4"              NUMERIC(18,2)  NOT NULL,
  "feedet5"           VARCHAR(200)  NOT NULL,
  "amt5"              NUMERIC(18,2)  NOT NULL,
  "feedet6"           VARCHAR(200)  NOT NULL,
  "amt6"              NUMERIC(18,2)  NOT NULL,
  "feedet7"           VARCHAR(200)  NOT NULL,
  "amt7"              NUMERIC(18,2)  NOT NULL,
  "feedet8"           VARCHAR(200)  NOT NULL,
  "amt8"              NUMERIC(18,2)  NOT NULL,
  "feedet9"           VARCHAR(200)  NOT NULL,
  "amt9"              NUMERIC(18,2)  NOT NULL,
  "feedet10"          VARCHAR(200)  NOT NULL,
  "amt10"             NUMERIC(18,2)  NOT NULL,
  "fee_rec_type"      SMALLINT    NOT NULL,
  "fee_uploade_date"  DATE          NOT NULL,
  "fee_uploade_user"  VARCHAR(200)  NOT NULL,
  "fee_deleted_date"  DATE          NOT NULL,
  "fee_deleted_user"  VARCHAR(200)  NOT NULL,
  "publish"           SMALLINT    NOT NULL DEFAULT 0,
  "uid"               VARCHAR(70)   NOT NULL,
  PRIMARY KEY ("fee_upload_deleted_id")
);

--
-- Dumping data for table "fee_upload_deleted"
--

INSERT INTO "fee_upload_deleted" ("fee_upload_deleted_id", "feeDate", "receitNo", "name", "enrollmentNo", "grade", "category", "bank", "chqno", "total", "penaltyCharges", "inword", "comment", "acc_year", "fee_head", "feedet1", "amt1", "feedet2", "amt2", "feedet3", "amt3", "feedet4", "amt4", "feedet5", "amt5", "feedet6", "amt6", "feedet7", "amt7", "feedet8", "amt8", "feedet9", "amt9", "feedet10", "amt10", "fee_rec_type", "fee_uploade_date", "fee_uploade_user", "fee_deleted_date", "fee_deleted_user", "publish", "uid") VALUES
(6930, '30/11/2026', 'TFII/OIEY/515', 'Abhyudaya Singh', 'A12183', 'PLAYSCHOOL', 'Cheque', 'HDFC Bank', 'Cheque No.  290808', 89500.00, '', 'Rupees Eighty Nine Thousand Five Hundred  and Paise Zero Only ', '', 2026, 'School fees for AY 2026-14', 'Tution Fees - II', 89500.00, '', 0.00, '', 0.00, '', 0.00, '', 0.00, '', 0.00, '', 0.00, '', 0.00, '', 0.00, '', 0.00, 1, '2026-12-06', 'administrator', NULL, '', 0, '2f254e66097fd653a5ca4cfdb33be358'),
(6932, '30/11/2026', 'TFII/OIEY/517', 'Ahaan Anand', 'A12217', 'PLAYSCHOOL', 'Cheque', 'HDFC Bank', 'Cheque No.  419926', 89500.00, '', 'Rupees Eighty Nine Thousand Five Hundred  and Paise Zero Only ', '', 2026, 'School fees for AY 2026-14', 'Tution Fees - II', 89500.00, '', 0.00, '', 0.00, '', 0.00, '', 0.00, '', 0.00, '', 0.00, '', 0.00, '', 0.00, '', 0.00, 1, '2026-12-06', 'administrator', NULL, '', 0, ''),
(7113, '30/11/2026', 'TFII/OIEY/698', 'Akshata Singh', 'A12166', 'PLAYSCHOOL', 'Cheque', 'Axis Bank', 'Cheque No.  027355', 89500.00, '', 'Rupees Eighty Nine Thousand Five Hundred  and Paise Zero Only ', '', 2026, 'School fees for AY 2026-14', 'Tution Fees - II', 89500.00, '', 0.00, '', 0.00, '', 0.00, '', 0.00, '', 0.00, '', 0.00, '', 0.00, '', 0.00, '', 0.00, 1, '2026-12-06', 'administrator', NULL, '', 0, ''),
(7046, '30/11/2026', 'TFII/OIEY/631', 'Arssh Gupta', 'A12190', 'PLAYSCHOOL', 'Cheque', 'ICICI Bank', 'Cheque No.  690753', 89500.00, '', 'Rupees Eighty Nine Thousand Five Hundred  and Paise Zero Only ', '', 2026, 'School fees for AY 2026-14', 'Tution Fees - II', 89500.00, '', 0.00, '', 0.00, '', 0.00, '', 0.00, '', 0.00, '', 0.00, '', 0.00, '', 0.00, '', 0.00, 1, '2026-12-06', 'administrator', NULL, '', 0, ''),
(7081, '30/11/2026', 'TFII/OIEY/666', 'Ashvath Karnad', 'A12205', 'PLAYSCHOOL', 'Cheque', 'Standard Chartered Bank', 'Cheque No.  000156', 89500.00, '', 'Rupees Eighty Nine Thousand Five Hundred  and Paise Zero Only ', '', 2026, 'School fees for AY 2026-14', 'Tution Fees - II', 89500.00, '', 0.00, '', 0.00, '', 0.00, '', 0.00, '', 0.00, '', 0.00, '', 0.00, '', 0.00, '', 0.00, 1, '2026-12-06', 'administrator', NULL, '', 0, ''),
(6989, '30/11/2026', 'TFII/OIEY/574', 'Ridhaan Kachwala', 'A12186', 'PLAYSCHOOL', 'Cheque', 'HDFC Bank', 'Cheque No.  974973', 89500.00, '', 'Rupees Eighty Nine Thousand Five Hundred  and Paise Zero Only ', '', 2026, 'School fees for AY 2026-14', 'Tution Fees - II', 89500.00, '', 0.00, '', 0.00, '', 0.00, '', 0.00, '', 0.00, '', 0.00, '', 0.00, '', 0.00, '', 0.00, 1, '2026-12-06', 'administrator', NULL, '', 0, ''),
(6992, '30/11/2026', 'TFII/OIEY/577', 'Rudra Dhawan', 'A12214', 'PLAYSCHOOL', 'Cheque', 'HDFC Bank', 'Cheque No.  255671', 179000.00, '', 'Rupees  One Lakh Seventy Nine Thousand  and Paise Zero Only ', '', 2026, 'School fees for AY 2026-14', 'Tution Fees - II', 179000.00, '', 0.00, '', 0.00, '', 0.00, '', 0.00, '', 0.00, '', 0.00, '', 0.00, '', 0.00, '', 0.00, 1, '2026-12-06', 'administrator', NULL, '', 0, ''),
(7111, '30/11/2026', 'TFII/OIEY/696', 'Samaira Khan', 'A12176', 'PLAYSCHOOL', 'Cheque', 'Axis Bank', 'Cheque No.  564433', 89500.00, '', 'Rupees Eighty Nine Thousand Five Hundred  and Paise Zero Only ', '', 2026, 'School fees for AY 2026-14', 'Tution Fees - II', 89500.00, '', 0.00, '', 0.00, '', 0.00, '', 0.00, '', 0.00, '', 0.00, '', 0.00, '', 0.00, '', 0.00, 1, '2026-12-06', 'administrator', NULL, '', 0, ''),
(6852, '30/11/2026', 'TFII/OIEY/437', 'Sanaya Kanakia', 'A12180', 'PLAYSCHOOL', 'Cheque', 'OBC', 'Cheque No.  116902', 89500.00, '', 'Rupees Eighty Nine Thousand Five Hundred  and Paise Zero Only ', '', 2026, 'School fees for AY 2026-14', 'Tution Fees - II', 89500.00, '', 0.00, '', 0.00, '', 0.00, '', 0.00, '', 0.00, '', 0.00, '', 0.00, '', 0.00, '', 0.00, 1, '2026-12-06', 'administrator', NULL, '', 0, ''),
(7089, '30/11/2026', 'TFII/OIEY/674', 'Shhaurya Gupta', 'A12199', 'PLAYSCHOOL', 'Cheque', 'Standard Chartered Bank', 'Cheque No.  000005', 89500.00, '', 'Rupees Eighty Nine Thousand Five Hundred  and Paise Zero Only ', '', 2026, 'School fees for AY 2026-14', 'Tution Fees - II', 89500.00, '', 0.00, '', 0.00, '', 0.00, '', 0.00, '', 0.00, '', 0.00, '', 0.00, '', 0.00, '', 0.00, 1, '2026-12-06', 'administrator', NULL, '', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table "field_info"
--

CREATE TABLE IF NOT EXISTS "field_info" (
  "f_id"              SERIAL,
  "f_name"            VARCHAR(50)  NOT NULL,
  "tab_id"            INT          NOT NULL,
  "field_type"        VARCHAR(20)  DEFAULT NULL,
  "field_edit_type"   VARCHAR(10)  DEFAULT NULL,
  "field_code"        VARCHAR(60)  DEFAULT NULL,
  "field_visibility"  INT          DEFAULT 0,
  PRIMARY KEY ("f_id")
);

--
-- Dumping data for table "field_info"
--

INSERT INTO "field_info" ("f_id", "f_name", "tab_id", "field_type", "field_edit_type", "field_code", "field_visibility") VALUES
(1, 'Admission_Number', 1, 'TxtF', 'TxtF', 'adm_num', 1),
(2, 'Admission_Date', 1, 'TxtF', 'Date', 'adm_date', 0),
(3, 'First_Name', 1, 'TxtF', 'TxtF', 'frst_name', 0),
(4, 'Last_Name', 1, 'TxtF', 'TxtF', 'last_name', 0),
(5, 'Student_ID', 1, 'TxtF', 'TxtF', 'stu_id', 0),
(6, 'Roll_Number', 1, 'TxtF', 'TxtF', 'rol_num', 0),
(7, 'Age', 1, 'TxtF', 'TxtF', 'age', 0),
(8, 'Gender', 1, 'TxtF', 'Drp', 'gndr', 0),
(9, 'Address', 1, 'TxtA', 'TxtA', 'adr', 0),
(10, 'City', 1, 'TxtF', 'TxtF', 'city', 0),
(11, 'State', 1, 'TxtF', 'TxtF', 'state', 0),
(12, 'Country', 1, 'TxtF', 'TxtF', 'country', 0),
(13, 'Pin', 1, 'TxtF', 'TxtF', 'pin', 0),
(14, 'Grade', 1, 'TxtF', 'Drp', 'bld_grp', 0),
(15, 'Date_of_Birth', 1, 'Date', 'Date', 'd_o_b', 0),
(16, 'Student_Photo', 1, 'Img', 'Img', 'st_photo', 1),
(17, 'Mother_Tongue', 1, 'TxtF', 'Drp', 'mthr_tng', 0),
(18, 'Father_Name', 1, 'TxtF', 'TxtF', 'f_name', 0),
(19, 'Mother_Name', 1, 'TxtF', 'TxtF', 'f_name', 0),
(20, 'Gardian_Name', 1, 'TxtF', 'TxtF', 'g_name', 0),
(21, 'Home_Room_Teacher', 1, 'TxtF', 'Drp', 'class_teach', 0),
(22, 'Father_First_Name', 2, 'TxtF', 'TxtF', 'fath_frs', 0),
(23, 'Father_Last_Name', 2, 'TxtF', 'TxtF', 'fath_las', 0),
(24, 'Father_Middle_Name', 2, 'TxtF', 'TxtF', 'fath_mid', 0),
(25, 'F_mail_Address', 2, 'TxtF', 'mail', 'fath_mail', 0),
(26, 'F_Landline_Number', 2, 'TxtF', 'TxtF', 'land_num_dad', 0),
(27, 'F_Mobile_Number', 2, 'TxtF', 'TxtF', 'mob_num_dad', 0),
(28, 'F_Office_Number', 2, 'TxtF', 'TxtF', 'off_fath', 0),
(29, 'Father_Address', 2, 'TxtA', 'TxtA', 'fath_addr', 0),
(30, 'Mother_First_Name', 2, 'TxtF', 'TxtF', 'moth_frs', 0),
(31, 'Mother_Last_Name', 2, 'TxtF', 'TxtF', 'moth_las', 0),
(32, 'Mother_Middle_Name', 2, 'TxtF', 'TxtF', 'moth_mid', 0),
(33, 'M_mail_Address', 2, 'TxtF', 'mail', 'moth_mail', 0),
(34, 'M_Landline_Number', 2, 'TxtF', 'TxtF', 'land_num_mom', 0),
(35, 'M_Mobile_Number', 2, 'TxtF', 'TxtF', 'mob_num_mom', 0),
(36, 'M_Office_Number', 2, 'TxtF', 'TxtF', 'off_moth', 0),
(37, 'Mother_Address', 2, 'TxtA', 'TxtA', 'moth_addr', 0),
(38, 'Guardian_First_Name', 2, 'TxtF', 'TxtF', 'guar_frs', 0),
(39, 'Guardian_Last_Name', 2, 'TxtF', 'TxtF', 'guar_las', 0),
(40, 'Guardian_Middle_Name', 2, 'TxtF', 'TxtF', 'guar_mid', 0),
(41, 'G_mail_Address', 2, 'TxtF', 'mail', 'guar_mail', 0),
(42, 'G_Landline_Number', 2, 'TxtF', 'TxtF', 'land_num_guar', 0),
(43, 'G_Mobile_Number', 2, 'TxtF', 'TxtF', 'mob_num_guar', 0),
(44, 'G_Office_Number', 2, 'TxtF', 'TxtF', 'off_guar', 0),
(45, 'Guardian_Address', 2, 'TxtA', 'TxtA', 'guar_addr', 0),
(46, 'Blood_Group', 3, 'TxtF', 'Drp', 'bld_grp', 0),
(47, 'Allergic', 3, 'TxtA', 'TxtA', 'allergy', 0),
(48, 'Doctor_Name', 3, 'TxtF', 'TxtF', 'doc_name', 0),
(49, 'Doctor_Number', 3, 'TxtF', 'TxtF', 'doc_num', 0),
(50, 'Dentist_Name', 3, 'TxtF', 'TxtF', 'dent_name', 0),
(51, 'Dentist_Number', 3, 'TxtF', 'TxtF', 'dent_num', 0),
(52, 'Insurance_Company', 3, 'TxtF', 'TxtF', 'insr_cmpny', 0),
(53, 'Policy_Number', 3, 'TxtF', 'TxtF', 'pol_num', 0),
(54, 'Customer_ID', 3, 'TxtF', 'TxtF', 'ins_cust_id', 0),
(55, 'Checkup_Date', 3, 'Date', 'Date', 'chk_date', 0),
(56, 'Checkup_Description', 3, 'TxtF', 'TxtF', 'chk_desc', 0),
(57, 'Checkup_Outcome', 3, 'TxtF', 'TxtF', 'chk_out', 0),
(58, 'Checkup_Remark', 3, 'TxtA', 'TxtA', 'chk_rem', 0),
(59, 'Medical_Event_Date', 3, 'Date', 'Date', 'med_date', 0),
(60, 'Medical_Event', 3, 'TxtF', 'TxtF', 'med_desc', 0),
(61, 'Medical_Outcome', 3, 'TxtF', 'TxtF', 'med_out', 0),
(62, 'Medical_Remark', 3, 'TxtA', 'TxtA', 'med_rem', 0),
(63, 'Health_Card', 4, 'Chk', 'Chk', 'hlth_crd', 0),
(64, 'OCI_POI', 4, 'Chk', 'Chk', 'oci/opi', 0),
(65, 'Photo', 4, 'Chk', 'Chk', 'photo', 0),
(66, 'School_Transcripts', 4, 'Chk', 'Chk', 'schl_trn', 0),
(67, 'Birth_Certificate', 4, 'Chk', 'Chk', 'birth_crtf', 0),
(68, 'Passport_of_Student', 4, 'Chk', 'Chk', 'pass_stud', 0),
(69, 'Passport_of_parent', 4, 'Chk', 'Chk', 'pass_parnt', 0),
(70, 'Visa_of_Student', 4, 'Chk', 'Chk', 'visa_stud', 0),
(71, 'Visa_of_Parent', 4, 'Chk', 'Chk', 'visa_parnt', 0),
(72, 'Company_Letter', 4, 'Chk', 'Chk', 'cmpny_lettr', 0),
(73, 'FRO', 4, 'Chk', 'Chk', 'fro', 0),
(74, 'TC', 4, 'Chk', 'Chk', 'tc', 0),
(75, 'School_Letter', 4, 'Chk', 'Chk', 'schl_lettr', 0),
(76, 'Migration_Certificate', 4, 'Chk', 'Chk', 'migratn_certif', 0),
(77, 'Marksheet', 4, 'Chk', 'Chk', 'marksheet', 0),
(78, 'Leaveletter', 4, 'Chk', 'Chk', 'leave_lettr', 0),
(126, 'Hello_there', 28, 'TxtF', NULL, NULL, 0),
(80, 'Parent_Marriage_Certificate', 4, 'Chk', 'Chk', NULL, 1),
(79, 'Nationality', 1, 'TxtF', 'Drp', 'nat', 0),
(125, 'test_2', 28, 'Rad', 'Rad', NULL, 1),
(124, 'Mothers_Passport', 28, 'Chk', 'Chk', 'moth_pass', 0),
(128, 'Sharath', 30, 'Chk', NULL, NULL, 0),
(129, 'DOA', 30, 'Date', 'TxtF', NULL, 0),
(130, 'Add_Product', 31, 'TxtF', 'TxtA', NULL, 0),
(131, 'Products', 31, 'TxtF', 'TxtF', NULL, 0),
(132, 'Availability', 31, 'Chk', 'Chk', NULL, 0),
(133, 'checking', 31, 'Chk', 'Chk', NULL, 0),
(134, 'Office Address', 1, 'TxtF', NULL, NULL, 0),
(135, 'Passport Number', 1, 'TxtA', NULL, NULL, 0),
(136, 'Passport Number', 1, 'TxtA', NULL, NULL, 0),
(137, 'EMail ID', 1, 'TxtF', NULL, NULL, 0),
(138, 'Mothers_EMai_ID', 1, 'TxtF', NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table "fresh_contact_list"
--

CREATE TABLE IF NOT EXISTS "fresh_contact_list" (
  "fresh_contact_list_id"           SERIAL,
  "school_id"    VARCHAR(100)  NOT NULL DEFAULT '',
  "father_mail"  VARCHAR(150)  DEFAULT NULL,
  "mother_mail"  VARCHAR(150)  DEFAULT NULL,
  "F8"           VARCHAR(255)  DEFAULT NULL,
  PRIMARY KEY ("fresh_contact_list_id")
);

CREATE UNIQUE INDEX "ux_school_id" ON "fresh_contact_list" ("school_id");

--
-- Dumping data for table "fresh_contact_list"
--

INSERT INTO "fresh_contact_list" ("school_id", "father_mail", "mother_mail", "F8") VALUES
('A043', 'info@biosagri.com', 'nazina44@email.com', NULL),
('A051', 'w_pinto1@hotmail.com', 'jyotipinto1@email.com', NULL),
('A071', 'parmar.dipak@email.com', 'pannaparmar@email.com', NULL),
('A073', 'ankur.shah1@email.com', 'vaibhavi.shah@email.com', NULL),
('A083', 'jiiya220607@email.com', 'jiiya220607@email.com', NULL),
('A092', 'rajendra.chandorkar@email.com', 'shilpa.chandorkar@email.com', NULL),
('A1000', 'kaushik.pillalamarri@email.com', 'cpillalamarri@email.com', NULL),
('A1002', 'vnmathreja@email.com', 'mitalivmathreja@email.com', NULL),
('A1011', 'kishor.sgs@email.com', 'rashi.sgs@email.com', NULL),
('A1040', 'Chaudhuri.k@email.com', 'ruchidhrita@email.com', NULL);

-- --------------------------------------------------------

--
-- Table structure for table "general_doc_details"
--

CREATE TABLE IF NOT EXISTS "general_doc_details" (
  "general_doc_details_id"            SERIAL,
  "student_id"    VARCHAR(200)        NOT NULL,
  "docname"       VARCHAR(255)        NOT NULL,
  "docphone"      VARCHAR(255)        NOT NULL,
  "docaddress"    TEXT                NOT NULL,
  "denname"       VARCHAR(255)        NOT NULL,
  "denphone"      VARCHAR(255)        NOT NULL,
  "denaddress"    TEXT                NOT NULL,
  "allergies"     TEXT                NOT NULL,
  "notification"  TEXT                NOT NULL,
  "status"        SMALLINT          NOT NULL DEFAULT 1,
  "hospname"      VARCHAR(255)        NOT NULL,
  "ddv"           DATE                NOT NULL,
  PRIMARY KEY ("general_doc_details_id")
);

--
-- Dumping data for table "general_doc_details"
--

INSERT INTO "general_doc_details" ("general_doc_details_id", "student_id", "docname", "docphone", "docaddress", "denname", "denphone", "denaddress", "allergies", "notification", "status", "hospname", "ddv") VALUES
(10, '39', '', '', '', '', '', '', '', 'Frequent abdominal pain, Frequent headaches, Motion sickness', 1, '', '2026-09-26'),
(11, '48', '', '', '', '', '', '', '', 'Motion sickness', 1, '', '2026-09-26'),
(12, '50', '', '', '', '', '', '', '', 'Motion sickness', 1, '', '2026-09-26'),
(13, '51', '', '', '', '', '', '', '', 'Eyes Sight - R(-2) L(-1.75)', 1, '', '2026-09-26'),
(14, '51', '', '', '', '', '', '', '', 'Motion sickness', 1, '', '2026-09-26'),
(15, '56', '', '', '', '', '', '', 'Food Color - Artificial coloring in foods inflames adenoids', '', 1, '', '2026-09-26'),
(16, '60', '', '', '', '', '', '', '', 'Febrile convulsions or Epilepsy', 1, '', '2026-09-26'),
(17, '61', '', '', '', '', '', '', '', 'Eyes Sight - R(75) L(50)', 1, '', '2026-09-26'),
(18, '69', '', '', '', '', '', '', '', 'Asthma', 1, '', '2026-09-26'),
(19, '70', '', '', '', '', '', '', '', 'Eyes Sight - R(SPH- 0.5 /CYL -3.25/ AXIS- 10) L(SPH- 0.75/CYL -3.00/ AXIS- 170)', 1, '', '2026-09-26'),
(20, '72', '', '', '', '', '', '', '', 'Bronchitis', 1, '', '2026-09-26');

-- --------------------------------------------------------

--
-- Table structure for table "grade"
--

CREATE TABLE IF NOT EXISTS "grade" (
  "grade_id"       SERIAL,
  "name"     VARCHAR(22)  NOT NULL,
  "g_from"   REAL        NOT NULL,
  "g_to"     REAL        NOT NULL,
  "remarks"  TEXT         NOT NULL,
  PRIMARY KEY ("grade_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "gradekg"
--

CREATE TABLE IF NOT EXISTS "gradekg" (
  "gradekg_id"           BIGSERIAL,
  "exam_id"      INT         NOT NULL,
  "class"        INT         NOT NULL,
  "sec"          INT         NOT NULL,
  "skill"        INT         NOT NULL,
  "student_id"   INT         NOT NULL,
  "acc_year"     INT         NOT NULL,
  "grade_value"  VARCHAR(4)  NOT NULL,
  PRIMARY KEY ("gradekg_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "gradepyp"
--

CREATE TABLE IF NOT EXISTS "gradepyp" (
  "gradepyp_id"           BIGSERIAL,
  "exam_id"      INT         NOT NULL,
  "class"        INT         NOT NULL,
  "sec"          INT         NOT NULL,
  "skill"        INT         NOT NULL,
  "student_id"   INT         NOT NULL,
  "acc_year"     INT         NOT NULL,
  "grade_value"  VARCHAR(4)  NOT NULL,
  PRIMARY KEY ("gradepyp_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "grade_assessment"
--

CREATE TABLE IF NOT EXISTS "grade_assessment" (
  "grade_assessment_id"                SERIAL,
  "category_id"       INT           DEFAULT NULL,
  "subject"           INT           DEFAULT NULL,
  "term"              INT           DEFAULT NULL,
  "title"             VARCHAR(100)  DEFAULT NULL,
  "description"       TEXT,
  "assign_date"       DATE          DEFAULT NULL,
  "due_date"          DATE          DEFAULT NULL,
  "max_point"         INT           DEFAULT NULL,
  "apply_grade"       VARCHAR(1)    DEFAULT 'Y',
  "grade_type"        VARCHAR(10)   DEFAULT NULL,
  "course_objective"  TEXT,
  "a_year"            INT           DEFAULT NULL,
  "inserted_date"     DATE          DEFAULT NULL,
  "status"            SMALLINT    DEFAULT 1,
  PRIMARY KEY ("grade_assessment_id")
);

CREATE INDEX "ix_subj_term_year" ON "grade_assessment" ("subject", "term", "a_year", "status");
CREATE INDEX "ix_category_year" ON "grade_assessment" ("category_id", "a_year");

--
-- Dumping data for table "grade_assessment"
--

INSERT INTO "grade_assessment" ("grade_assessment_id", "category_id", "subject", "term", "title", "description", "assign_date", "due_date", "max_point", "apply_grade", "grade_type", "course_objective", "a_year", "inserted_date", "status") VALUES
(1, 1, 64, 1, 'HW Assign', 'Homeroom Assignment', '2026-08-01', '2026-08-30', 100, 'Y', 'alphabet', 'compulsory to attend', 2026, '2026-08-01', 1),
(2, 1, 64, 1, 'HW Assign 2', 'Homeroom Assignment 2', '2026-08-01', '2026-08-30', 100, 'Y', 'alphabet', 'Optional', 2026, '2026-08-01', 1),
(3, 2, 90, 1, 'August', 'class test - August', '2026-08-01', '2026-08-02', 0, 'Y', 'alphabet', '', 2026, '2026-08-01', 0),
(4, 16, 188, 1, 'WWI Glogster', 'WWI', '2026-08-16', '2026-08-23', 50, 'N', 'alphabet', '', 2026, '2026-08-16', 1),
(5, 19, 160, 1, 'MAIN reason WWI', '', '2026-08-16', '2026-08-19', 0, 'Y', 'alphabet', '', 2026, '2026-08-16', 1),
(6, 28, 331, 1, 'Conflict in ME 1&2', '', '2026-08-19', '2026-08-19', 0, 'Y', 'alphabet', '', 2026, '2026-08-16', 0),
(133, 1041, 162, 1, 'Chekhov Scene', '', '2026-09-26', NULL, 0, 'Y', 'alphabet', '', 2026, '2026-09-13', 1),
(7, 17, 188, 1, 'Mock Paper 2', '', '2026-08-21', '2026-08-22', 0, 'Y', 'alphabet', '', 2026, '2026-08-21', 0),
(8, 32, 188, 1, 'Glog WWI', 'Test 1', '2026-08-21', '2026-08-28', 0, 'Y', 'alphabet', '', 2026, '2026-08-21', 1),
(142, 905, 270, 1, 'TT Quiz', 'Quiz on Table Tennis', '2026-08-30', '2026-08-30', 0, 'Y', 'alphabet', 'To understand and apply the basic rules as it relates to table tennis (singles and doubles)', 2026, '2026-09-16', 0),
(141, 1063, 333, 1, 'EXAMEN 1', 'CHAPTER 1', '2026-08-28', '2026-09-13', 0, 'Y', 'alphabet', '', 2026, '2026-09-16', 1);

-- --------------------------------------------------------

--
-- Table structure for table "grade_avg"
--

CREATE TABLE IF NOT EXISTS "grade_avg" (
  "grade_avg_id"             SERIAL,
  "subject"        INT         DEFAULT NULL,
  "letter1"        VARCHAR(5)  DEFAULT NULL,
  "letter2"        VARCHAR(5)  DEFAULT NULL,
  "letter3"        VARCHAR(5)  DEFAULT NULL,
  "letter4"        VARCHAR(5)  DEFAULT NULL,
  "letter5"        VARCHAR(5)  DEFAULT NULL,
  "letter6"        VARCHAR(5)  DEFAULT NULL,
  "letter7"        VARCHAR(5)  DEFAULT NULL,
  "letter8"        VARCHAR(5)  DEFAULT NULL,
  "letter9"        VARCHAR(5)  DEFAULT NULL,
  "letter10"       VARCHAR(5)  DEFAULT NULL,
  "letter11"       VARCHAR(5)  DEFAULT NULL,
  "letter12"       VARCHAR(5)  DEFAULT NULL,
  "letter13"       VARCHAR(5)  DEFAULT NULL,
  "letter14"       VARCHAR(5)  DEFAULT NULL,
  "letter15"       VARCHAR(5)  DEFAULT NULL,
  "avg1"           VARCHAR(5)  DEFAULT NULL,
  "avg2"           VARCHAR(5)  DEFAULT NULL,
  "avg3"           VARCHAR(5)  DEFAULT NULL,
  "avg4"           VARCHAR(5)  DEFAULT NULL,
  "avg5"           VARCHAR(5)  DEFAULT NULL,
  "avg6"           VARCHAR(5)  DEFAULT NULL,
  "avg7"           VARCHAR(5)  DEFAULT NULL,
  "avg8"           VARCHAR(5)  DEFAULT NULL,
  "avg9"           VARCHAR(5)  DEFAULT NULL,
  "avg10"          VARCHAR(5)  DEFAULT NULL,
  "avg11"          VARCHAR(5)  DEFAULT NULL,
  "avg12"          VARCHAR(5)  DEFAULT NULL,
  "avg13"          VARCHAR(5)  DEFAULT NULL,
  "avg14"          VARCHAR(5)  DEFAULT NULL,
  "avg15"          VARCHAR(5)  DEFAULT NULL,
  "inserted_date"  DATE        DEFAULT NULL,
  "status"         SMALLINT  DEFAULT 1,
  PRIMARY KEY ("grade_avg_id")
);

--
-- Dumping data for table "grade_avg"
--

INSERT INTO "grade_avg" ("grade_avg_id", "subject", "letter1", "letter2", "letter3", "letter4", "letter5", "letter6", "letter7", "letter8", "letter9", "letter10", "letter11", "letter12", "letter13", "letter14", "letter15", "avg1", "avg2", "avg3", "avg4", "avg5", "avg6", "avg7", "avg8", "avg9", "avg10", "avg11", "avg12", "avg13", "avg14", "avg15", "inserted_date", "status") VALUES
(1, 64, 'A+', 'A', 'B+', 'B', 'C+', 'C', 'D+', 'D', 'F', '', '', '', '', '', '', '100', '94', '89', '84', '79', '74', '69', '64', '59', '', '', '', '', '', '', '2026-08-01', 1),
(2, 336, 'A+', 'A', 'B+', 'B', 'C+', 'C', 'D+', 'D', 'F', '', '', '', '', '', '', '100', '94', '89', '84', '79', '74', '69', '64', '59', '', '', '', '', '', '', '2026-08-01', 1),
(3, 90, 'A+', 'A', 'B+', 'B', 'C+', 'C', 'D+', 'D', 'F', '', '', '', '', '', '', '100', '94', '89', '84', '79', '74', '69', '64', '59', '', '', '', '', '', '', '2026-08-01', 1),
(4, 319, 'A+', 'A', 'B+', 'B', 'C+', 'C', 'D+', 'D', 'F', '', '', '', '', '', '', '100', '94', '89', '84', '79', '74', '69', '64', '59', '', '', '', '', '', '', '2026-08-05', 1),
(5, 245, 'A+', 'A', 'B+', 'B', 'C+', 'C', 'D+', 'D', 'F', '', '', '', '', '', '', '100', '94', '89', '84', '79', '74', '69', '64', '59', '', '', '', '', '', '', '2026-08-10', 1),
(6, 270, 'A+', 'A', 'B+', 'B', 'C+', 'C', 'D+', 'D', 'F', '', '', '', '', '', '', '100', '94', '89', '84', '79', '74', '69', '64', '59', '', '', '', '', '', '', '2026-08-13', 1),
(7, 317, 'A+', 'A', 'B+', 'B', 'C+', 'C', 'D+', 'D', 'F', '', '', '', '', '', '', '100', '94', '89', '84', '79', '74', '69', '64', '59', '', '', '', '', '', '', '2026-08-13', 1),
(8, 188, 'A+', 'A', 'B+', 'B', 'C+', 'C', 'D+', 'D', 'F', '', '', '', '', '', '', '100', '94', '89', '84', '79', '74', '69', '64', '59', '', '', '', '', '', '', '2026-08-16', 1),
(9, 160, 'A+', 'A', 'B+', 'B', 'C+', 'C', 'D+', 'D', 'F', '', '', '', '', '', '', '100', '94', '89', '84', '79', '74', '69', '64', '59', '', '', '', '', '', '', '2026-08-16', 1),
(10, 282, 'A+', 'A', 'B+', 'B', 'C+', 'C', 'D+', 'D', 'F', '', '', '', '', '', '', '100', '94', '89', '84', '79', '74', '69', '64', '59', '', '', '', '', '', '', '2026-08-16', 1);

-- --------------------------------------------------------

--
-- Table structure for table "grade_category"
--

CREATE TABLE IF NOT EXISTS "grade_category" (
  "grade_category_id"           SERIAL,
  "subject"      INT           DEFAULT NULL,
  "title"        VARCHAR(50)   DEFAULT NULL,
  "description"  TEXT,
  "a_year"       INT           DEFAULT NULL,
  "term_id"      INT           DEFAULT NULL,
  "term"         VARCHAR(255)  DEFAULT NULL,
  "weight"       INT           DEFAULT NULL,
  "status"       SMALLINT    DEFAULT 1,
  PRIMARY KEY ("grade_category_id")
);

CREATE INDEX "ix_subj_year_term" ON "grade_category" ("subject", "a_year", "term_id", "status");

--
-- Dumping data for table "grade_category"
--

INSERT INTO "grade_category" ("grade_category_id", "subject", "title", "description", "a_year", "term_id", "term", "weight", "status") VALUES
(1, 64, 'HW', 'Home Room', 2026, 1, 't1, t2, t3, t4, t5, t6', 0, 1),
(2, 90, 'Class Test', 'class test', 2026, 1, 't1, t2, t3, t4, t5, t6', 50, 1),
(3, 153, 'Speaking', 'Speech', 2026, 1, 't1, t2, t3, , , ', 0, 0),
(4, 319, 'Test and Quizzes', '', 2026, 1, 't1, t2, t3, t4, t5, t6', 30, 0),
(5, 319, 'Projects', '', 2026, 1, 't1, t2, t3, t4, t5, t6', 30, 0),
(6, 319, 'Participation', '', 2026, 1, 't1, t2, t3, t4, t5, t6', 20, 0),
(7, 319, 'Homework', '', 2026, 1, 't1, t2, t3, t4, t5, t6', 10, 0),
(8, 319, 'Organization', '', 2026, 1, 't1, t2, t3, t4, t5, t6', 10, 0),
(1102, 320, 'Organization.', 'deadlines, punctuality, bring materials to class', 2026, 1, '', 10, 1),
(10, 270, 'Movement Skills and Concepts', 'This grade will be based on skill performance and assessment of knowledge.', 2026, 1, 't1, t2, t3, t4, t5, t6', 30, 0);

-- --------------------------------------------------------

--
-- Table structure for table "grade_grace"
--

CREATE TABLE IF NOT EXISTS "grade_grace" (
  "grade_grace_id"      SERIAL,
  "letter"  VARCHAR(5)  DEFAULT NULL,
  "status"  SMALLINT  DEFAULT 1,
  PRIMARY KEY ("grade_grace_id")
);

--
-- Dumping data for table "grade_grace"
--

INSERT INTO "grade_grace" ("grade_grace_id", "letter", "status") VALUES
(1, 'A+', 1),
(2, 'A', 1),
(3, 'B+', 1),
(4, 'B', 1),
(5, 'C+', 1),
(6, 'C', 1),
(7, 'D+', 1),
(8, 'D', 1),
(9, 'F', 1),
(10, 'U', 1);

-- --------------------------------------------------------

--
-- Table structure for table "grade_m_64_1"
--

CREATE TABLE IF NOT EXISTS "grade_m_64_1" (
  "grade_m_64_1_id"             SERIAL,
  "user"           VARCHAR(70)  DEFAULT NULL,
  "a_year"         INT          DEFAULT NULL,
  "student_id"     INT          DEFAULT NULL,
  "term"           INT          DEFAULT NULL,
  "subject"        INT          DEFAULT NULL,
  "category"       INT          DEFAULT NULL,
  "category1"      INT          DEFAULT NULL,
  "category2"      INT          DEFAULT NULL,
  "inserted_date"  DATE         DEFAULT NULL,
  "comments"       TEXT,
  "status"         SMALLINT   DEFAULT 1,
  "avg_1"          VARCHAR(5)   DEFAULT NULL,
  "HW_Assign_1"    VARCHAR(5)   DEFAULT NULL,
  "HW_Assign_2_1"  VARCHAR(5)   DEFAULT NULL,
  PRIMARY KEY ("grade_m_64_1_id")
);

--
-- Dumping data for table "grade_m_64_1"
--

INSERT INTO "grade_m_64_1" ("grade_m_64_1_id", "user", "a_year", "student_id", "term", "subject", "category", "category1", "category2", "inserted_date", "comments", "status", "avg_1", "HW_Assign_1", "HW_Assign_2_1") VALUES
(1, NULL, NULL, 464, 1, 64, NULL, NULL, NULL, NULL, NULL, 1, '99', '99', '99'),
(2, NULL, NULL, 1132, 1, 64, 0, NULL, NULL, '2026-12-16', NULL, 1, '100', '100', '100'),
(3, NULL, NULL, 892, 1, 64, 0, NULL, NULL, '2026-12-16', NULL, 1, '98', '99', '97'),
(4, NULL, NULL, 580, 1, 64, 0, NULL, NULL, '2026-12-16', NULL, 1, '97', '99', '95'),
(5, NULL, NULL, 92, 1, 64, NULL, NULL, NULL, NULL, NULL, 1, '93', '92', '93'),
(6, NULL, NULL, 220, 1, 64, 0, NULL, NULL, '2026-12-16', NULL, 1, '99', '99', '99'),
(7, NULL, NULL, 545, 1, 64, 0, NULL, NULL, '2026-12-16', NULL, 1, '90', '88', '91'),
(8, NULL, NULL, 7, 1, 64, 0, NULL, NULL, '2026-12-16', NULL, 1, '96', '99', '92'),
(9, NULL, NULL, 523, 1, 64, 0, NULL, NULL, '2026-12-16', NULL, 1, '92', '91', '93'),
(10, NULL, NULL, 601, 1, 64, NULL, NULL, NULL, NULL, NULL, 1, '93', '92', '94'),
(11, NULL, NULL, 975, 1, 64, NULL, NULL, NULL, NULL, NULL, 1, '94', '93', '95'),
(12, NULL, NULL, 1151, 1, 64, 0, NULL, NULL, '2026-12-16', NULL, 1, '95', '94', '96'),
(13, NULL, NULL, 356, 1, 64, 0, NULL, NULL, '2026-12-16', NULL, 1, '96', '95', '97'),
(14, NULL, NULL, 958, 1, 64, 0, NULL, NULL, '2026-12-16', NULL, 1, '97', '96', '98'),
(15, NULL, NULL, 1005, 1, 64, 0, NULL, NULL, '2026-12-16', NULL, 1, '98', '97', '99');

-- --------------------------------------------------------

--
-- Table structure for table "grade_m_64_2"
--

CREATE TABLE IF NOT EXISTS "grade_m_64_2" (
  "grade_m_64_2_id"             SERIAL,
  "user"           VARCHAR(70)  DEFAULT NULL,
  "a_year"         INT          DEFAULT NULL,
  "student_id"     INT          DEFAULT NULL,
  "term"           INT          DEFAULT NULL,
  "subject"        INT          DEFAULT NULL,
  "category"       INT          DEFAULT NULL,
  "category1"      INT          DEFAULT NULL,
  "category2"      INT          DEFAULT NULL,
  "inserted_date"  DATE         DEFAULT NULL,
  "comments"       TEXT,
  "status"         SMALLINT   DEFAULT 1,
  "avg_1"          VARCHAR(5)   DEFAULT NULL,
  PRIMARY KEY ("grade_m_64_2_id")
);

--
-- Dumping data for table "grade_m_64_2"
--

INSERT INTO "grade_m_64_2" ("grade_m_64_2_id", "user", "a_year", "student_id", "term", "subject", "category", "category1", "category2", "inserted_date", "comments", "status", "avg_1") VALUES
(1, NULL, NULL, 464, 2, 64, 0, 0, NULL, NULL, '', 1, '99'),
(2, 'Abhyudaya', NULL, 1132, 2, 64, 0, 0, NULL, NULL, '', 1, '100'),
(3, 'Adi', NULL, 892, 2, 64, 0, 0, NULL, NULL, '', 1, '98'),
(4, 'Ashvath', NULL, 580, 2, 64, 0, 0, NULL, NULL, '', 1, '97'),
(5, NULL, NULL, 92, 2, 64, 0, 0, NULL, NULL, '', 1, '93'),
(6, 'Kiaan', NULL, 220, 2, 64, 0, 0, NULL, NULL, '', 1, '99'),
(7, 'Ridhaan', NULL, 545, 2, 64, 0, 0, NULL, NULL, '', 1, '90'),
(8, 'Saiesha', NULL, 7, 2, 64, 0, 0, NULL, NULL, '', 1, '96'),
(9, 'Samaira', NULL, 523, 2, 64, 0, 0, NULL, NULL, '', 1, '92'),
(10, NULL, NULL, 601, 2, 64, 0, 0, NULL, NULL, '', 1, '93'),
(11, NULL, NULL, 975, 2, 64, 0, 0, NULL, NULL, '', 1, '94'),
(12, 'Shaurya', NULL, 1151, 2, 64, 0, 0, NULL, NULL, '', 1, '95'),
(13, 'Sonia', NULL, 356, 2, 64, 0, 0, NULL, NULL, '', 1, '96'),
(14, 'Vidush', NULL, 958, 2, 64, 0, 0, NULL, NULL, '', 1, '97'),
(15, 'Zenishka', NULL, 1005, 2, 64, 0, 0, NULL, NULL, '', 1, '98'),
(16, NULL, NULL, 465, 2, 64, NULL, NULL, NULL, NULL, NULL, 1, NULL),
(17, NULL, NULL, 1314, 2, 64, NULL, NULL, NULL, NULL, NULL, 1, NULL),
(18, NULL, NULL, 522, 2, 64, NULL, NULL, NULL, NULL, NULL, 1, NULL),
(19, NULL, NULL, 1351, 2, 64, NULL, NULL, NULL, NULL, NULL, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table "grade_m_68_1"
--

CREATE TABLE IF NOT EXISTS "grade_m_68_1" (
  "grade_m_68_1_id"             SERIAL,
  "user"           VARCHAR(70)  DEFAULT NULL,
  "a_year"         INT          DEFAULT NULL,
  "student_id"     INT          DEFAULT NULL,
  "term"           INT          DEFAULT NULL,
  "subject"        INT          DEFAULT NULL,
  "category"       INT          DEFAULT NULL,
  "category1"      INT          DEFAULT NULL,
  "category2"      INT          DEFAULT NULL,
  "inserted_date"  DATE         DEFAULT NULL,
  "comments"       TEXT,
  "status"         SMALLINT   DEFAULT 1,
  PRIMARY KEY ("grade_m_68_1_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "grade_m_68_2"
--

CREATE TABLE IF NOT EXISTS "grade_m_68_2" (
  "grade_m_68_2_id"             SERIAL,
  "user"           VARCHAR(70)  DEFAULT NULL,
  "a_year"         INT          DEFAULT NULL,
  "student_id"     INT          DEFAULT NULL,
  "term"           INT          DEFAULT NULL,
  "subject"        INT          DEFAULT NULL,
  "category"       INT          DEFAULT NULL,
  "category1"      INT          DEFAULT NULL,
  "category2"      INT          DEFAULT NULL,
  "inserted_date"  DATE         DEFAULT NULL,
  "comments"       TEXT,
  "status"         SMALLINT   DEFAULT 1,
  PRIMARY KEY ("grade_m_68_2_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "grade_m_71_1"
--

CREATE TABLE IF NOT EXISTS "grade_m_71_1" (
  "grade_m_71_1_id"             SERIAL,
  "user"           VARCHAR(70)  DEFAULT NULL,
  "a_year"         INT          DEFAULT NULL,
  "student_id"     INT          DEFAULT NULL,
  "term"           INT          DEFAULT NULL,
  "subject"        INT          DEFAULT NULL,
  "category"       INT          DEFAULT NULL,
  "category1"      INT          DEFAULT NULL,
  "category2"      INT          DEFAULT NULL,
  "inserted_date"  DATE         DEFAULT NULL,
  "comments"       TEXT,
  "status"         SMALLINT   DEFAULT 1,
  PRIMARY KEY ("grade_m_71_1_id")
);

--
-- Dumping data for table "grade_m_71_1"
--

INSERT INTO "grade_m_71_1" ("grade_m_71_1_id", "user", "a_year", "student_id", "term", "subject", "category", "category1", "category2", "inserted_date", "comments", "status") VALUES
(1, 'Aaditya', NULL, 1277, 1, 71, 0, NULL, NULL, '2026-12-16', 'Aaditya is a very talented and hardworking member of our homeroom class.  He is enthusiastic when he is interested in a topic and he is an active participant in our class.  He can work on learning tolerance and empathy as he learns to develop a working relationship with different students. He can also work on being on time to class daily.', 1),
(2, 'Alizeh', NULL, 746, 1, 71, 0, NULL, NULL, '2026-12-16', 'Alizeh is often quiet in our class discussions but when she has an opinion she is not shy to express it.  Her love of sport and particularly swimming is evident.  She willingly cooperates with her classmates and adds her perspective to our conversations.  She can work on being on time to class.', 1),
(3, 'Aryan', NULL, 976, 1, 71, 0, NULL, NULL, '2026-12-16', 'Aryan is always willing to share in class.  He is enthusiastic, open, and willing to contribute to our class in whatever way he can.  He follows directions and can be a good listener.  He can work on developing a bit of independence and on learning to trust himself and his ideas.  ', 1),
(4, 'Ayushi', NULL, 1008, 1, 71, 0, NULL, NULL, '2026-12-16', 'Ayushi is always on time and always smiling.  She goes about her business quietly and is an integral part of our class.  She cooperates well with her peers and is always willing to help out others.  Although we appreciate her quiet way, she can work on being a bit more outspoken and, when she speaks, speaking louder.', 1),
(5, 'Disha', NULL, 1123, 1, 71, 0, NULL, NULL, '2026-12-16', 'Disha is always prepared and enthusiastic.  She is willing to get involved and is an articulate speaker.  When she has a concern, she will voice it.  She can work on occasionally taking a step back and truly listening to the ideas of others, particularly when teaming.  ', 1),
(6, 'Jahnavi', NULL, 239, 1, 71, 0, NULL, NULL, '2026-12-16', 'Jahnavi really seems to enjoy coming to school and spending time with her friends.  She comes to class with a friendly smile and gets along with her peers well.  She can work on expressing her opinion and participating in our class discussions a bit more actively.', 1),
(7, 'Jasmit', NULL, 313, 1, 71, 0, NULL, NULL, '2026-12-16', 'Jasmit is a quiet but welcome addition to our class.  We appreciate his often unique contributions in our class discussions.  He is kind and tolerant of all his classmates.  He can work on sharing his ideas with the class more often.', 1),
(8, 'Kanksha', NULL, 180, 1, 71, 0, NULL, NULL, '2026-12-16', 'Kanksha is an active participant in our class on all levels.  She is enthusiastic and not afraid to say what she thinks.  She works well with her peers and is willing to help out others as needed. The class really appreciated her efforts on the banner that she spent so much time creating for Field Day. ', 1),
(9, 'Mridul', NULL, 17, 1, 71, 0, NULL, NULL, '2026-12-16', 'Midrul is often the first one to greet me in the mornings, always with a smile.  He is always engaged in our class discussions and is a good listener.  He is also tolerant of his fellow classmates\\'' differences and is willing to help them out when asked.  ', 1),
(10, 'Nandita', NULL, 305, 1, 71, 0, NULL, NULL, '2026-12-16', 'Nandita is adjusting well and is an integral part of our class.  She is willing to help out her fellow classmates, kind, quiet and respectful.  She can work on speaking louder, clearer, and expressing her opinion a bit more often.', 1);

-- --------------------------------------------------------

--
-- Table structure for table "grade_m_71_2"
--

CREATE TABLE IF NOT EXISTS "grade_m_71_2" (
  "grade_m_71_2_id"             SERIAL,
  "user"           VARCHAR(70)  DEFAULT NULL,
  "a_year"         INT          DEFAULT NULL,
  "student_id"     INT          DEFAULT NULL,
  "term"           INT          DEFAULT NULL,
  "subject"        INT          DEFAULT NULL,
  "category"       INT          DEFAULT NULL,
  "category1"      INT          DEFAULT NULL,
  "category2"      INT          DEFAULT NULL,
  "inserted_date"  DATE         DEFAULT NULL,
  "comments"       TEXT,
  "status"         SMALLINT   DEFAULT 1,
  PRIMARY KEY ("grade_m_71_2_id")
);

--
-- Dumping data for table "grade_m_71_2"
--

INSERT INTO "grade_m_71_2" ("grade_m_71_2_id", "user", "a_year", "student_id", "term", "subject", "category", "category1", "category2", "inserted_date", "comments", "status") VALUES
(1, 'Aaditya', NULL, 1277, 2, 71, 0, 0, NULL, NULL, 'Aaditya has been a welcome addition to 6B this year.  He excels at sharing his thinking and ideas with the class.  He can often see things from multiple perspectives.  I would encourage him to try to be on time to class next year.  I would also encourage him to work on his tolerance of others and on communicating with kindness.', 1),
(2, 'Alizeh', NULL, 746, 2, 71, 0, 0, NULL, NULL, 'Alizeh has been an integral part of 6B.  She is has a knack for getting along wtih others, she shows tolarance of classmates that are different than she and often has unique ideas to share with the class.  Next year she can work on being on time (rather than standing outside socializing)and on keeping her locker neatly organized.  ', 1),
(3, 'Aryan', NULL, 976, 2, 71, 0, 0, NULL, NULL, 'Aryan has demonstrated resinience, patience and tolerance this year.  He is always willing to participate and is enthusiastic in all he does.  He comes prepared to class and is always on time.  He can continue to work on communicating with kindness and listening to others.', 1),
(4, 'Ayushi', NULL, 1008, 2, 71, 0, 0, NULL, NULL, 'Ayushi is a pleasure to have in class.  She listens, follows directions and treats her fellow classmates with respect.  When she choses to focus on her academics, she understands concepts with ease.  I would encourage her to stay focused on her academics, balancing her friendships with her studies.  I would also encourage her to speak up more in class as she has valuable contributions to make to our class.', 1),
(5, 'Disha', NULL, 1123, 2, 71, 0, 0, NULL, NULL, 'Disha is an enthusiastic learner and in all she does.  She is always on time, organized and willing to help out others.  In fact she has shown much patience when working with other students to help them understand a concept.  She is very good at explaining her ideas clearly.  This year she has learned to be a better listener to her classmates.  She can continue to work on being open to her fellow classmates\\'' ideas.', 1),
(6, 'Jahnavi', NULL, 239, 2, 71, 0, 0, NULL, NULL, 'Jahnavi has been an integral part of our class this year.  She is always laughing and gets along with her peers well.  She comes to class on time.  I would encourage Jahnavi to focus on her studies a bit more and to practice speaking up in class, to share her ideas.', 1),
(7, 'Jasmit', NULL, 313, 2, 71, 0, 0, NULL, NULL, 'Jasmit is a quiet but important member of our class.  He gets along with his classmates well in spite of not always thinking in the same way they do.  He comes to class on time, keeps his locker organized and is well prepared for class.  I would encourage him to speak up more in class as he has valuable ideas to share that we could all benefit from.', 1),
(8, 'Kanksha', NULL, 180, 2, 71, 0, 0, NULL, NULL, 'Kanksha has been a pleasure to have in our class this year.  She works hard and does her best at everything.  She comes to class on time and is always prepared.  I would encourage her to work on her communication and teamwork skills.  I wish her all the best at her new school next year.  I am sure she will adjust there very well.', 1),
(9, 'Mridul', NULL, 17, 2, 71, 0, 0, NULL, NULL, 'Mridul is a quiet and thoughful member of our class.  He treats everyone with kindness, listens to others\\'' ideas and demonstrates warmth and self confidence.  I would encourage him to continue to work on his teamwork and communication skills.', 1),
(10, 'Nandita', NULL, 305, 2, 71, 0, 0, NULL, NULL, 'Nandita has been an integral member of our class this year.  She comes to class ontime and is always willing to help out.  She has made improvements in speaking up.  However she can continue to work on this in her classes as the more we participate the more we learn.  ', 1);


--
-- Table structure for table "grade_m_exception"
--

CREATE TABLE IF NOT EXISTS "grade_m_exception" (
  "grade_m_exception_id"           SERIAL,
  "exception"    VARCHAR(5)    NOT NULL,
  "description"  VARCHAR(100)  NOT NULL,
  "marks"        INT           DEFAULT NULL,
  "status"       SMALLINT    NOT NULL DEFAULT 1,
  PRIMARY KEY ("grade_m_exception_id")
);

--
-- Dumping data for table "grade_m_exception"
--

INSERT INTO "grade_m_exception" ("grade_m_exception_id", "exception", "description", "marks", "status") VALUES
(1, 'EX', 'Exempt', 100, 1),
(2, 'M', 'Missed', 100, 1),
(3, 'I', 'Incomplete', 100, 1),
(4, '', '', NULL, 1),
(5, 'U', 'Unrated', 100, 1);

-- --------------------------------------------------------

--
-- Table structure for table "grade_points"
--

CREATE TABLE IF NOT EXISTS "grade_points" (
  "grade_points_id"           SERIAL,
  "achievement"  VARCHAR(3)  NOT NULL,
  "effort"       VARCHAR(3)  NOT NULL,
  PRIMARY KEY ("grade_points_id")
);

--
-- Dumping data for table "grade_points"
--

INSERT INTO "grade_points" ("grade_points_id", "achievement", "effort") VALUES
(1, 'I', '4'),
(2, 'D', '3'),
(3, 'E', '2'),
(4, 'L', '1'),
(5, 'N/A', 'N/A');

-- --------------------------------------------------------

--
-- Table structure for table "grade_points_eal"
--

CREATE TABLE IF NOT EXISTS "grade_points_eal" (
  "grade_points_eal_id"           SERIAL,
  "achievement"  VARCHAR(50)  NOT NULL,
  "effort"       VARCHAR(3)   NOT NULL,
  PRIMARY KEY ("grade_points_eal_id")
);

--
-- Dumping data for table "grade_points_eal"
--

INSERT INTO "grade_points_eal" ("grade_points_eal_id", "achievement", "effort") VALUES
(1, 'Bridging', '5'),
(2, 'Expanding', '4'),
(3, 'Developing', '3'),
(4, 'Beginning', '2'),
(5, 'Entering', '1');

-- --------------------------------------------------------

--
-- Table structure for table "grade_points_eal_assessment_key"
--

CREATE TABLE IF NOT EXISTS "grade_points_eal_assessment_key" (
  "grade_points_eal_assessment_key_id"     SERIAL,
  "fname"  VARCHAR(50)  NOT NULL,
  "sname"  VARCHAR(50)  NOT NULL,
  "desc"   TEXT         NOT NULL,
  PRIMARY KEY ("grade_points_eal_assessment_key_id")
);

--
-- Dumping data for table "grade_points_eal_assessment_key"
--

INSERT INTO "grade_points_eal_assessment_key" ("grade_points_eal_assessment_key_id", "fname", "sname", "desc") VALUES
(1, 'CD', 'Consistently Displayed', 'Student consistently demonstrates understanding of concepts, content and skills, at grade level, at the time of the progress report.'),
(2, 'DE', 'Developing as Expected', 'meets most grade level expectations independently'),
(3, 'DS', 'Developing Steadily', 'Student is developing steadily and demonstrates some understanding, with support, of concepts, content and skills, at grade level, at the time of the progress report'),
(4, 'ES', 'Early Stages', 'Student is in the early stage and requires significant support to understand concepts, content and skills, at the time of the progress report');

-- --------------------------------------------------------

--
-- Table structure for table "grade_setup"
--

CREATE TABLE IF NOT EXISTS "grade_setup" (
  "grade_setup_id"                  SERIAL,
  "grade_id"            INT          DEFAULT NULL,
  "subject"             INT          DEFAULT NULL,
  "term"                INT          DEFAULT NULL,
  "category_grade"      VARCHAR(1)   DEFAULT 'N',
  "term_grade"          VARCHAR(1)   DEFAULT 'N',
  "assignment_sorting"  VARCHAR(20)  DEFAULT NULL,
  "copy_class"          INT          DEFAULT NULL,
  "cal_method"          SMALLINT   DEFAULT NULL,
  "grade_type"          VARCHAR(10)  DEFAULT 'alphabet',
  "status"              SMALLINT   DEFAULT 1,
  PRIMARY KEY ("grade_setup_id")
);

--
-- Dumping data for table "grade_setup"
--

INSERT INTO "grade_setup" ("grade_setup_id", "grade_id", "subject", "term", "category_grade", "term_grade", "assignment_sorting", "copy_class", "cal_method", "grade_type", "status") VALUES
(1, 1, 64, 1, 'Y', 'Y', '', 0, 1, 'alphabet', 1),
(2, 2, 336, 1, '', '', '', 0, 2, 'alphabet', 1),
(3, 3, 90, 1, '', '', '', 0, 2, 'alphabet', 1),
(4, 4, 319, 1, 'Y', '', '', 0, 2, 'alphabet', 1),
(5, 5, 245, 1, 'Y', '', '', 0, 2, 'alphabet', 1),
(6, 6, 270, 1, '', 'Y', '', 0, 2, 'alphabet', 1),
(7, 7, 317, 1, 'Y', '', '', 0, 2, 'alphabet', 1),
(8, 8, 188, 1, '', 'Y', '', 0, 2, 'alphabet', 1),
(9, 9, 160, 1, '', 'Y', '', 0, 2, 'alphabet', 1),
(10, 10, 282, 1, '', 'Y', '', 0, 2, 'alphabet', 1);

-- --------------------------------------------------------

--
-- Table structure for table "grade_skill_comments"
--

CREATE TABLE IF NOT EXISTS "grade_skill_comments" (
  "grade_skill_comments_id"        SERIAL,
  "sub"       INT           NOT NULL,
  "student"   INT           NOT NULL,
  "skill"     INT           NOT NULL,
  "sem1"      TEXT          NOT NULL,
  "sem2"      TEXT          NOT NULL,
  "user"      VARCHAR(100)  NOT NULL,
  "ent_date"  DATE          NOT NULL,
  "status"    SMALLINT    NOT NULL,
  PRIMARY KEY ("grade_skill_comments_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "grade_skill_ponts"
--

CREATE TABLE IF NOT EXISTS "grade_skill_ponts" (
  "grade_skill_ponts_id"        SERIAL,
  "sub"       INT           NOT NULL,
  "student"   INT           NOT NULL,
  "skill"     INT           NOT NULL,
  "sub_skil"  INT           NOT NULL,
  "sem1_ach"  VARCHAR(3)    NOT NULL,
  "sem1_eff"  VARCHAR(3)    NOT NULL,
  "sem2_ach"  VARCHAR(3)    NOT NULL,
  "sem2_eff"  VARCHAR(3)    NOT NULL,
  "user"      VARCHAR(100)  NOT NULL,
  "ent_date"  DATE          NOT NULL,
  "status"    SMALLINT    NOT NULL,
  PRIMARY KEY ("grade_skill_ponts_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "hallno"
--

CREATE TABLE IF NOT EXISTS "hallno" (
  "hallno_id"       SERIAL,
  "hall_no"  VARCHAR(30)  DEFAULT NULL,
  "school"  VARCHAR(60)  DEFAULT NULL,
  "status"   SMALLINT   DEFAULT 1,
  PRIMARY KEY ("hallno_id")
);

--
-- Dumping data for table "hallno"
--

INSERT INTO "hallno" ("hallno_id", "hall_no", "school", "status") VALUES
(1, '101', 'RD-S', 1),
(2, '501 Hum', 'RD-S', 1),
(3, '502 Hum', 'RD-S', 1),
(4, '503 Hum', 'RD-S', 1),
(5, '504 Hum', 'RD-S', 1),
(6, '506 Lab', 'RD-S', 1),
(7, '507 Hum - HL', 'RD-S', 0),
(8, '508 Hum', 'RD-S', 1),
(9, '510 Hum', 'RD-S', 1),
(10, '511 Hum', 'RD-S', 1);

-- --------------------------------------------------------

--
-- Table structure for table "hospital_det"
--

CREATE TABLE IF NOT EXISTS "hospital_det" (
  "hospital_det_id"              SERIAL,
  "doc_name"        VARCHAR(200)  DEFAULT NULL,
  "treatment_date"  DATE          DEFAULT NULL,
  "time_in"         VARCHAR(200)  DEFAULT NULL,
  "time_out"        VARCHAR(200)  DEFAULT NULL,
  "diagnosis"       TEXT,
  "treatment"       TEXT,
  "report"          TEXT,
  "returned"        VARCHAR(100)  DEFAULT NULL,
  "picked"          TEXT,
  "doc_detail_id"   VARCHAR(200)  DEFAULT NULL,
  "hospital_name"   VARCHAR(200)  DEFAULT NULL,
  PRIMARY KEY ("hospital_det_id")
);

--
-- Dumping data for table "hospital_det"
--

INSERT INTO "hospital_det" ("hospital_det_id", "doc_name", "treatment_date", "time_in", "time_out", "diagnosis", "treatment", "report", "returned", "picked", "doc_detail_id", "hospital_name") VALUES
(1, '14july', NULL, '12-59-AM', '12-59-AM', '14july', '14july', '14july', 'on', '14july', '', '0'),
(2, 'Doctor''s Name', NULL, '12-59-AM', '12-59-AM', 'Diagnosis', 'Treatment', 'Report', 'on', 'Picked By', '', '1'),
(3, 'Doctor''s Name', NULL, '12-59-AM', '12-59-AM', 'Diagnosis', 'Treatment', 'Report', 'on', 'Picked By', '', '1'),
(4, 'Testing', NULL, '12-59-AM', '12-59-AM', 'Testing', 'Testing', 'Testing', 'on', 'Testing', '', '1'),
(5, 'Test', NULL, '12-59-AM', '12-59-AM', 'Test', 'Test', 'Test', 'on', 'Test', '', '1'),
(6, 'Test', NULL, '12-59-AM', '12-59-AM', 'Test', 'Test', 'Test', 'on', 'Test', '', '1'),
(7, 'Test', NULL, '12-59-AM', '12-59-AM', 'Test', 'Test', 'Test', 'on', 'Test', '4341', '1'),
(8, '', NULL, '12-00-AM', '12-00-AM', '', '', '', 'no', '', '41', ''),
(9, '', NULL, '12-00-AM', '12-00-AM', '', '', '', 'no', '', '42', ''),
(10, '', NULL, '12-00-AM', '12-00-AM', '', '', '', 'no', '', '634', '');

-- --------------------------------------------------------

--
-- Table structure for table "hospital_tab"
--

CREATE TABLE IF NOT EXISTS "hospital_tab" (
  "hospital_tab_id"             SERIAL,
  "hospital_name"  VARCHAR(250)  DEFAULT NULL,
  PRIMARY KEY ("hospital_tab_id")
);

--
-- Dumping data for table "hospital_tab"
--

INSERT INTO "hospital_tab" ("hospital_tab_id", "hospital_name") VALUES
(1, 'Hospital');

-- --------------------------------------------------------

--
-- Table structure for table "hostel_fee_m"
--

CREATE TABLE IF NOT EXISTS "hostel_fee_m" (
  "hostel_fee_m_id"             SERIAL,
  "fee_id"         INT           NOT NULL DEFAULT 0,
  "amt"            INT           NOT NULL DEFAULT 0,
  "installment"    INT           DEFAULT 0,
  "due_date"       DATE          DEFAULT NULL,
  "hostel_id"      INT           DEFAULT NULL,
  "academic_term"  VARCHAR(200)  DEFAULT NULL,
  "refund"         NUMERIC(12,2)   DEFAULT NULL,
  PRIMARY KEY ("hostel_fee_m_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "hostel_fee_type"
--

CREATE TABLE IF NOT EXISTS "hostel_fee_type" (
  "fee_id"    SERIAL,
  "fee_name"  VARCHAR(100)  NOT NULL DEFAULT '',
  "status"    INT           NOT NULL DEFAULT 1,
  PRIMARY KEY ("fee_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "hostel_m"
--

CREATE TABLE IF NOT EXISTS "hostel_m" (
  "hostel_m_id"           SERIAL,
  "hostel_id"    VARCHAR(25)    DEFAULT NULL,
  "hostel_name"  VARCHAR(255)   DEFAULT NULL,
  "hostel_type"  VARCHAR(50)  DEFAULT 'B',
  "address"      TEXT,
  "phone_no"     VARCHAR(50)    DEFAULT NULL,
  "no_floors"    INT            DEFAULT NULL,
  "no_rooms"     INT            DEFAULT NULL,
  "warden_name"  VARCHAR(50)    DEFAULT NULL,
  "no_attender"  INT            DEFAULT NULL,
  "hostel_rent"  NUMERIC(8,2)     DEFAULT NULL,
  "mess_charge"  NUMERIC(8,2)     DEFAULT NULL,
  PRIMARY KEY ("hostel_m_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "h_archive_m"
--

CREATE TABLE IF NOT EXISTS "h_archive_m" (
  "h_archive_m_id"                INT          NOT NULL DEFAULT 0,
  "s_id"              VARCHAR(50)  NOT NULL DEFAULT '',
  "h_id"              INT          NOT NULL DEFAULT 0,
  "lg_name"           VARCHAR(50)  NOT NULL DEFAULT '',
  "relation"          VARCHAR(50)  NOT NULL DEFAULT '',
  "lg_add"            VARCHAR(50)  NOT NULL DEFAULT '',
  "phone"             VARCHAR(50)  DEFAULT NULL,
  "food"              INT          NOT NULL DEFAULT 0,
  "room_no"           INT          DEFAULT NULL,
  "old_s_name"        VARCHAR(50)  DEFAULT NULL,
  "year1"             VARCHAR(50)  DEFAULT NULL,
  "emp_n"             VARCHAR(50)  DEFAULT NULL,
  "dept"              VARCHAR(50)  DEFAULT NULL,
  "ex_activity"       VARCHAR(50)  DEFAULT NULL,
  "j_date"            TIMESTAMP     DEFAULT NULL,
  "weight"            INT          DEFAULT NULL,
  "bid"               VARCHAR(50)  DEFAULT NULL,
  "date_of_updation"  DATE         DEFAULT NULL,
  "domain"            VARCHAR(25)  DEFAULT NULL,
  "l_date"            DATE         DEFAULT NULL,
  PRIMARY KEY ("h_archive_m_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "hostel_block"
--

CREATE TABLE IF NOT EXISTS "hostel_block" (
  "hostel_block_id"         SERIAL,
  "blockname"  VARCHAR(50)    NOT NULL DEFAULT '',
  "hostel_no"  INT            DEFAULT NULL,
  "status"     VARCHAR(50)  DEFAULT 1,
  PRIMARY KEY ("hostel_block_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "h_cons_purchase_det"
--

CREATE TABLE IF NOT EXISTS "h_cons_purchase_det" (
  "id_det"         SERIAL,
  "id_m"           INT           NOT NULL DEFAULT 0,
  "itemname_id"    INT           NOT NULL DEFAULT 0,
  "quantity"       VARCHAR(45)   DEFAULT NULL,
  "quantity_type"  VARCHAR(45)   DEFAULT NULL,
  "unit_price"     NUMERIC(12,2)   DEFAULT 0,
  "amount"         NUMERIC(12,2)  DEFAULT 0,
  PRIMARY KEY ("id_det")
);

-- --------------------------------------------------------

--
-- Table structure for table "h_cons_purchase_m"
--

CREATE TABLE IF NOT EXISTS "h_cons_purchase_m" (
  "id_m"           SERIAL,
  "date_of_entry"  DATE          DEFAULT NULL,
  "supplier_id"    INT           DEFAULT 0,
  "bill_no"        VARCHAR(45)   DEFAULT NULL,
  "bill_date"      DATE          DEFAULT NULL,
  "no_of_items"    VARCHAR(50)   DEFAULT NULL,
  "tax"            VARCHAR(45)   DEFAULT NULL,
  "total_amount"   NUMERIC(12,2)   DEFAULT NULL,
  "comments"       VARCHAR(250)  DEFAULT NULL,
  "user_id"        INT           DEFAULT NULL,
  PRIMARY KEY ("id_m")
);

-- --------------------------------------------------------

--
-- Table structure for table "h_issue_consumable"
--

CREATE TABLE IF NOT EXISTS "h_issue_consumable" (
  "issue_id"       SERIAL,
  "school_id"     INT           DEFAULT NULL,
  "department_id"  INT           DEFAULT NULL,
  "issued_date"    DATE          DEFAULT NULL,
  "itemname"       VARCHAR(250)  DEFAULT NULL,
  "issued_qty"     VARCHAR(45)   DEFAULT NULL,
  "issued_by"      VARCHAR(250)  DEFAULT NULL,
  "issued_to"      VARCHAR(250)  DEFAULT NULL,
  "comments"       VARCHAR(250)  DEFAULT NULL,
  PRIMARY KEY ("issue_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "h_item_master"
--

CREATE TABLE IF NOT EXISTS "h_item_master" (
  "h_item_master_id"             SERIAL,
  "item_name"      VARCHAR(250)  DEFAULT NULL,
  "quantity_type"  VARCHAR(250)  DEFAULT NULL,
  "stock"          VARCHAR(250)  DEFAULT 0,
  PRIMARY KEY ("h_item_master_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "hostel_room_m"
--

CREATE TABLE IF NOT EXISTS "hostel_room_m" (
  "hostel_room_m_id"        SERIAL,
  "h_id"      INT          NOT NULL DEFAULT 0,
  "room_no"   VARCHAR(50)  NOT NULL DEFAULT '',
  "capacity"  INT          NOT NULL DEFAULT 0,
  "occupant"  INT          NOT NULL DEFAULT 0,
  "bid"       INT          NOT NULL DEFAULT 0,
  "ext_no"    INT          DEFAULT 0,
  PRIMARY KEY ("hostel_room_m_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "hostel_student_m"
--

CREATE TABLE IF NOT EXISTS "hostel_student_m" (
  "hostel_student_m_id"          SERIAL,
  "s_id"        INTEGER  DEFAULT NULL,
  "h_id"        INT                    NOT NULL DEFAULT 0,
  "lg_name"     VARCHAR(50)            NOT NULL DEFAULT '',
  "relation"    VARCHAR(50)            NOT NULL DEFAULT '',
  "lg_add"      VARCHAR(50)            NOT NULL DEFAULT '',
  "phone"       VARCHAR(50)            DEFAULT NULL,
  "room_no"     INT                    DEFAULT NULL,
  "emp_n"       VARCHAR(50)            DEFAULT NULL,
  "dept"        VARCHAR(50)            DEFAULT NULL,
  "j_date"      DATE                   DEFAULT NULL,
  "bid"         VARCHAR(50)            DEFAULT NULL,
  "domain"      VARCHAR(10)            DEFAULT NULL,
  "archive"     CHAR(1)                DEFAULT NULL,
  "l_date"      DATE                   DEFAULT NULL,
  "p_add"       VARCHAR(255)           DEFAULT NULL,
  "p_phone"     VARCHAR(20)            DEFAULT NULL,
  "blood"       VARCHAR(20)            DEFAULT NULL,
  "last_name"   VARCHAR(50)            DEFAULT NULL,
  "first_name"  VARCHAR(50)            DEFAULT NULL,
  PRIMARY KEY ("hostel_student_m_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "h_suplier_master"
--

CREATE TABLE IF NOT EXISTS "h_suplier_master" (
  "h_suplier_master_id"              SERIAL,
  "name"            VARCHAR(250)      DEFAULT NULL,
  "contact_person"  VARCHAR(100)      DEFAULT NULL,
  "phone"           VARCHAR(30)       DEFAULT NULL,
  "fax"             VARCHAR(30)       DEFAULT NULL,
  "email"           VARCHAR(30)       DEFAULT NULL,
  "black_listed"    VARCHAR(50)  DEFAULT 'NO',
  "address"         VARCHAR(255)      DEFAULT NULL,
  "remarks"         VARCHAR(255)      DEFAULT NULL,
  "ledger_id"       VARCHAR(10)       DEFAULT NULL,
  PRIMARY KEY ("h_suplier_master_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "h_temp_cons_purchase_det"
--

CREATE TABLE IF NOT EXISTS "h_temp_cons_purchase_det" (
  "id_det"         SERIAL,
  "id_m"           INT           NOT NULL DEFAULT 0,
  "itemname_id"    INT           NOT NULL DEFAULT 0,
  "quantity"       VARCHAR(45)   DEFAULT NULL,
  "quantity_type"  VARCHAR(45)   DEFAULT NULL,
  "unit_price"     NUMERIC(12,2)   DEFAULT 0,
  "amount"         NUMERIC(12,2)  DEFAULT 0,
  PRIMARY KEY ("id_det")
);

-- --------------------------------------------------------

--
-- Table structure for table "h_temp_issue_consumable"
--

CREATE TABLE IF NOT EXISTS "h_temp_issue_consumable" (
  "issue_id"     SERIAL,
  "itemname_id"  INT           NOT NULL DEFAULT 0,
  "issued_qty"   VARCHAR(45)   DEFAULT NULL,
  "issued_to"    VARCHAR(250)  DEFAULT NULL,
  PRIMARY KEY ("issue_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "id"
--

CREATE TABLE IF NOT EXISTS "id" (
  "student_id"  VARCHAR(255)  DEFAULT NULL,
  "no_series"   VARCHAR(255)  DEFAULT NULL,
  PRIMARY KEY ("student_id")
);

--
-- Dumping data for table "id"
--

INSERT INTO "id" ("student_id", "no_series") VALUES
('A1009', '41EB7717000000000000000000000000'),
('A1101', '409D7717000000000000000000000000'),
('A12416', '7DB5AA07000000000000000000000000'),
('A1214', '1FCE7707000000000000000000000000'),
('A921', '5F057717000000000000000000000000'),
('A12422', '6C0DA807000000000000000000000000'),
('A1280', '502C7617000000000000000000000000'),
('A1035', '7D067717000000000000000000000000'),
('A12540', '62DF6217000000000000000000000000'),
('A1152', '5C167817000000000000000000000000'),
('A12467', '00C85DA0000000000000000000000000'),
('A12444', '206F7907000000000000000000000000');

-- --------------------------------------------------------

--
-- Table structure for table "ideas"
--

CREATE TABLE IF NOT EXISTS "ideas" (
  "ideas_id"        SERIAL,
  "class"     INT   NOT NULL,
  "exam_id"   INT   NOT NULL,
  "idea"      TEXT  NOT NULL,
  "acc_year"  INT   NOT NULL,
  "theme"     TEXT  NOT NULL,
  "keyconc"   TEXT  NOT NULL,
  "unit"      INT   NOT NULL,
  PRIMARY KEY ("ideas_id")
);

--
-- Dumping data for table "ideas"
--

INSERT INTO "ideas" ("ideas_id", "class", "exam_id", "idea", "acc_year", "theme", "keyconc", "unit") VALUES
(1, 1, 1, 'Through visual arts we may express and share our ideas and feelings.', 2026, 'How we express ourselves.', 'Form, Perspective and Reflection.', 1),
(2, 2, 4, 'Everyday I can learn about who I am with and through others.', 2026, 'Who we are ', 'Change, Reflection, Responsibility ', 5),
(3, 3, 2, 'People’s relationships with each other can have an impact on their wellbeing. ', 2026, 'Who we are', 'Form, Connection, Responsibility ', 2),
(4, 4, 6, 'Our behavior impacts us and the lives of others. ', 2026, 'Who we are ', 'Perspective, Causation, Connection ', 6),
(5, 5, 7, 'People’s capabilities may increase as they grow.', 2026, 'Who we are ', 'Form, Change, Function.', 7),
(6, 6, 8, 'Choices in daily routines may impact peoples’ health.', 2026, 'Who we are ', 'Function, Causation and Responsibility ', 8),
(7, 7, 9, 'Contributions made by people can motivate and inspire others to take action. ', 2026, 'Who we are ', 'Perspective, Reflection', 9),
(8, 8, 10, 'Human migration can be a response to challenges, risks and opportunities.', 2026, 'Where we are in place and time ', 'Change, Connection, Causation ', 10),
(9, 9, 11, 'Mythology provides a window into the beliefs and values of different cultures.', 2026, 'How we express ourselves ', 'Function, Perspective', 11),
(10, 2, 4, 'People recognize important events through celebrations', 2026, 'How we express ourselves', 'Causation, Perspective', 13);

-- --------------------------------------------------------

--
-- Table structure for table "ideas_1"
--

CREATE TABLE IF NOT EXISTS "ideas_1" (
  "ideas_1_id"            SERIAL,
  "class"         INT   NOT NULL,
  "master_ideas"  INT   NOT NULL,
  "idea"          TEXT  NOT NULL,
  "acc_year"      INT   NOT NULL,
  "posi"          INT   NOT NULL,
  PRIMARY KEY ("ideas_1_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "igc_2026_1"
--

CREATE TABLE IF NOT EXISTS "igc_2026_1" (
  "igc_2026_1_id"             SERIAL,
  "class_section"  INT           DEFAULT NULL,
  "student_id"     INT           DEFAULT NULL,
  "subject_id"     INT           DEFAULT NULL,
  "status"         VARCHAR(4)    DEFAULT NULL,
  "sem_id"         INT           DEFAULT NULL,
  "int_id"         INT           DEFAULT NULL,
  "tst_id"         INT           DEFAULT NULL,
  "mark"           REAL         DEFAULT NULL,
  "grade"          VARCHAR(4)    DEFAULT NULL,
  "remarks"        TEXT          NOT NULL,
  "grade_rem"      VARCHAR(250)  NOT NULL,
  PRIMARY KEY ("igc_2026_1_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "igc_2026_2"
--

CREATE TABLE IF NOT EXISTS "igc_2026_2" (
  "igc_2026_2_id"             SERIAL,
  "class_section"  INT           DEFAULT NULL,
  "student_id"     INT           DEFAULT NULL,
  "subject_id"     INT           DEFAULT NULL,
  "status"         VARCHAR(4)    DEFAULT NULL,
  "sem_id"         INT           DEFAULT NULL,
  "int_id"         INT           DEFAULT NULL,
  "tst_id"         INT           DEFAULT NULL,
  "mark"           REAL         DEFAULT NULL,
  "grade"          VARCHAR(4)    DEFAULT NULL,
  "remarks"        TEXT          NOT NULL,
  "grade_rem"      VARCHAR(250)  NOT NULL,
  PRIMARY KEY ("igc_2026_2_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "igc_2026_3"
--

CREATE TABLE IF NOT EXISTS "igc_2026_3" (
  "igc_2026_3_id"             SERIAL,
  "class_section"  INT           DEFAULT NULL,
  "student_id"     INT           DEFAULT NULL,
  "subject_id"     INT           DEFAULT NULL,
  "status"         VARCHAR(4)    DEFAULT NULL,
  "sem_id"         INT           DEFAULT NULL,
  "int_id"         INT           DEFAULT NULL,
  "tst_id"         INT           DEFAULT NULL,
  "mark"           REAL         DEFAULT NULL,
  "grade"          VARCHAR(4)    DEFAULT NULL,
  "remarks"        TEXT          NOT NULL,
  "grade_rem"      VARCHAR(250)  NOT NULL,
  PRIMARY KEY ("igc_2026_3_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "igc_2026_4"
--

CREATE TABLE IF NOT EXISTS "igc_2026_4" (
  "igc_2026_4_id"             SERIAL,
  "class_section"  INT           DEFAULT NULL,
  "student_id"     INT           DEFAULT NULL,
  "subject_id"     INT           DEFAULT NULL,
  "status"         VARCHAR(4)    DEFAULT NULL,
  "sem_id"         INT           DEFAULT NULL,
  "int_id"         INT           DEFAULT NULL,
  "tst_id"         INT           DEFAULT NULL,
  "mark"           REAL         DEFAULT NULL,
  "grade"          VARCHAR(4)    DEFAULT NULL,
  "remarks"        TEXT          NOT NULL,
  "grade_rem"      VARCHAR(250)  NOT NULL,
  PRIMARY KEY ("igc_2026_4_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "igc_2026_5"
--

CREATE TABLE IF NOT EXISTS "igc_2026_5" (
  "igc_2026_5_id"             SERIAL,
  "class_section"  INT           DEFAULT NULL,
  "student_id"     INT           DEFAULT NULL,
  "subject_id"     INT           DEFAULT NULL,
  "status"         VARCHAR(4)    DEFAULT NULL,
  "sem_id"         INT           DEFAULT NULL,
  "int_id"         INT           DEFAULT NULL,
  "tst_id"         INT           DEFAULT NULL,
  "mark"           REAL         DEFAULT NULL,
  "grade"          VARCHAR(4)    DEFAULT NULL,
  "remarks"        TEXT          NOT NULL,
  "grade_rem"      VARCHAR(250)  NOT NULL,
  PRIMARY KEY ("igc_2026_5_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "igc_2026_6"
--

CREATE TABLE IF NOT EXISTS "igc_2026_6" (
  "igc_2026_6_id"             SERIAL,
  "class_section"  INT           DEFAULT NULL,
  "student_id"     INT           DEFAULT NULL,
  "subject_id"     INT           DEFAULT NULL,
  "status"         VARCHAR(4)    DEFAULT NULL,
  "sem_id"         INT           DEFAULT NULL,
  "int_id"         INT           DEFAULT NULL,
  "tst_id"         INT           DEFAULT NULL,
  "mark"           REAL         DEFAULT NULL,
  "grade"          VARCHAR(4)    DEFAULT NULL,
  "remarks"        TEXT          NOT NULL,
  "grade_rem"      VARCHAR(250)  NOT NULL,
  PRIMARY KEY ("igc_2026_6_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "igc_2026_7"
--

CREATE TABLE IF NOT EXISTS "igc_2026_7" (
  "igc_2026_7_id"             SERIAL,
  "class_section"  INT           DEFAULT NULL,
  "student_id"     INT           DEFAULT NULL,
  "subject_id"     INT           DEFAULT NULL,
  "status"         VARCHAR(4)    DEFAULT NULL,
  "sem_id"         INT           DEFAULT NULL,
  "int_id"         INT           DEFAULT NULL,
  "tst_id"         INT           DEFAULT NULL,
  "mark"           REAL         DEFAULT NULL,
  "grade"          VARCHAR(4)    DEFAULT NULL,
  "remarks"        TEXT          NOT NULL,
  "grade_rem"      VARCHAR(250)  NOT NULL,
  PRIMARY KEY ("igc_2026_7_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "igc_2026_8"
--

CREATE TABLE IF NOT EXISTS "igc_2026_8" (
  "igc_2026_8_id"             SERIAL,
  "class_section"  INT           DEFAULT NULL,
  "student_id"     INT           DEFAULT NULL,
  "subject_id"     INT           DEFAULT NULL,
  "status"         VARCHAR(4)    DEFAULT NULL,
  "sem_id"         INT           DEFAULT NULL,
  "int_id"         INT           DEFAULT NULL,
  "tst_id"         INT           DEFAULT NULL,
  "mark"           REAL         DEFAULT NULL,
  "grade"          VARCHAR(4)    DEFAULT NULL,
  "remarks"        TEXT          NOT NULL,
  "grade_rem"      VARCHAR(250)  NOT NULL,
  PRIMARY KEY ("igc_2026_8_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "igc_2026_9"
--

CREATE TABLE IF NOT EXISTS "igc_2026_9" (
  "igc_2026_9_id"             SERIAL,
  "class_section"  INT           DEFAULT NULL,
  "student_id"     INT           DEFAULT NULL,
  "subject_id"     INT           DEFAULT NULL,
  "status"         VARCHAR(4)    DEFAULT NULL,
  "sem_id"         INT           DEFAULT NULL,
  "int_id"         INT           DEFAULT NULL,
  "tst_id"         INT           DEFAULT NULL,
  "mark"           REAL         DEFAULT NULL,
  "grade"          VARCHAR(4)    DEFAULT NULL,
  "remarks"        TEXT          NOT NULL,
  "grade_rem"      VARCHAR(250)  NOT NULL,
  PRIMARY KEY ("igc_2026_9_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "igc_exam_year_m"
--

CREATE TABLE IF NOT EXISTS "igc_exam_year_m" (
  "igc_exam_year_m_id"             SERIAL,
  "exam_name"      VARCHAR(75)  NOT NULL,
  "exam_sub_name"  VARCHAR(50)  NOT NULL,
  "per_info"       INT          NOT NULL,
  "mark"           INT          NOT NULL,
  "acc_year"       INT          NOT NULL,
  "class"          INT          NOT NULL,
  "status"         SMALLINT   NOT NULL,
  "order_id"       INT          NOT NULL,
  PRIMARY KEY ("igc_exam_year_m_id")
);

--
-- Dumping data for table "igc_exam_year_m"
--

INSERT INTO "igc_exam_year_m" ("igc_exam_year_m_id", "exam_name", "exam_sub_name", "per_info", "mark", "acc_year", "class", "status", "order_id") VALUES
(1, 'Semester 1', 'S1', 100, 100, 2026, 1, 1, 1),
(2, 'Semester 1', 'Sem 1', 100, 100, 2026, 3, 1, 1),
(3, 'Semester 1', 'Sem 1', 100, 100, 2026, 2, 1, 1),
(4, 'Semester 1', 'Sem 1', 100, 100, 2026, 4, 1, 1),
(5, 'Semester 1', 'Sem 1', 100, 100, 2026, 5, 1, 1),
(6, 'Semester 1', 'Sem 1', 100, 100, 2026, 6, 1, 1),
(7, 'Semester 1', 'Sem 1', 100, 100, 2026, 7, 1, 1),
(8, 'Semester 1', 'Sem 1', 100, 100, 2026, 8, 1, 1),
(9, 'Semester 1', 'Sem 1', 100, 100, 2026, 9, 1, 1),
(10, 'Semester 1', 'S1', 100, 100, 2026, 64, 1, 1),
(11, 'Semester 2', 'S2', 100, 100, 2026, 1, 1, 2),
(12, 'Semester 2', 'Sem 2', 100, 100, 2026, 2, 1, 2),
(13, 'Semester 2', 'Sem 2', 100, 100, 2026, 3, 1, 2),
(14, 'Semester 2', 'Sem 2', 100, 100, 2026, 4, 1, 2),
(15, 'Semester 2', 'Sem 2', 100, 100, 2026, 5, 1, 2),
(16, 'Semester 2', 'Sem 2', 100, 100, 2026, 6, 1, 0),
(17, 'Semester 2 ', 'Sem 2', 100, 100, 2026, 7, 1, 2),
(18, 'Semester 2', 'Sem 2', 100, 100, 2026, 8, 1, 2),
(19, 'Semester 2', 'Sem 2', 100, 100, 2026, 9, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table "individual_asset_details"
--

CREATE TABLE IF NOT EXISTS "individual_asset_details" (
  "individual_asset_details_id"                 SERIAL,
  "asset_id"           INT                                                                         DEFAULT NULL,
  "item_code"          VARCHAR(50)                                                                 DEFAULT NULL,
  "item_description"   VARCHAR(250)                                                                DEFAULT NULL,
  "unitprice"          NUMERIC(25,2)                                                                 DEFAULT NULL,
  "location_id"        INT                                                                         DEFAULT NULL,
  "dept_id"            INT                                                                         DEFAULT NULL,
  "date_of_purchase"   DATE                                                                        DEFAULT NULL,
  "asset_purchase_id"  INT                                                                         DEFAULT NULL,
  "current_value"      NUMERIC(15,2)                                                                 DEFAULT NULL,
  "asset_status_id"    INT                                                                         DEFAULT NULL,
  "status"             VARCHAR(50)                                                        DEFAULT 'false',
  "PO_ID"              INT                                                                         DEFAULT NULL,
  "AssetStatus"        VARCHAR(50)                                                           DEFAULT 'New',
  "vendor"             INT                                                                         DEFAULT NULL,
  "conditions"         VARCHAR(50)  DEFAULT 'Not Installed',
  "billno"             VARCHAR(24)                                                                 NOT NULL,
  PRIMARY KEY ("individual_asset_details_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "intake"
--

CREATE TABLE IF NOT EXISTS "intake" (
  "intake_id"              SERIAL,
  "adm_type"        INT         DEFAULT NULL,
  "intake"          INT         DEFAULT NULL,
  "course_id"       INT         DEFAULT NULL,
  "course_year_id"  INT         DEFAULT NULL,
  "status"          SMALLINT  DEFAULT 1,
  PRIMARY KEY ("intake_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "interview"
--

CREATE TABLE IF NOT EXISTS "interview" (
  "interview_id"           SERIAL,
  "class"        INT          NOT NULL,
  "acc_year"     INT          NOT NULL,
  "name"         VARCHAR(50)  NOT NULL,
  "description"  TEXT         NOT NULL,
  "status"       SMALLINT   NOT NULL,
  "mark"         INT          NOT NULL,
  PRIMARY KEY ("interview_id")
);

--
-- Dumping data for table "interview"
--

INSERT INTO "interview" ("interview_id", "class", "acc_year", "name", "description", "status", "mark") VALUES
(1, 0, 2026, 'Tour of School', 'sample', 1, 0),
(2, 0, 2026, 'Meeting with Head of School', 'sample', 1, 0),
(3, 0, 2026, 'Registration', 'sample', 1, 0),
(4, 0, 2026, 'Fee Payment ', 'smaple', 1, 0),
(5, 0, 2026, 'Test track', 'er', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table "kgskills"
--

CREATE TABLE IF NOT EXISTS "kgskills" (
  "kgskills_id"        SERIAL,
  "class"     INT           NOT NULL,
  "sub"       INT           NOT NULL,
  "skill"     VARCHAR(250)  NOT NULL,
  "acc_year"  INT           NOT NULL,
  "posi"      INT           NOT NULL,
  "exam_id"   INT           NOT NULL,
  PRIMARY KEY ("kgskills_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "kg_subskills"
--

CREATE TABLE IF NOT EXISTS "kg_subskills" (
  "kg_subskills_id"            SERIAL,
  "class"         INT   NOT NULL,
  "sub"           INT   NOT NULL,
  "master_skill"  INT   NOT NULL,
  "sub_skill"     TEXT  NOT NULL,
  "acc_year"      INT   NOT NULL,
  "posi"          INT   NOT NULL,
  PRIMARY KEY ("kg_subskills_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "language"
--

CREATE TABLE IF NOT EXISTS "language" (
  "language_id"    SERIAL,
  "lang"  VARCHAR(20)  NOT NULL,
  PRIMARY KEY ("language_id")
);

--
-- Dumping data for table "language"
--

INSERT INTO "language" ("language_id", "lang") VALUES
(1, 'Arabic'),
(2, 'Assamese'),
(3, 'Bengali'),
(4, 'British'),
(5, 'Dutch'),
(6, 'English'),
(7, 'Gujarati'),
(8, 'French'),
(9, 'Hindi'),
(10, 'Japanese'),
(11, 'Kashmiri'),
(12, 'Kokani'),
(13, 'Kannada'),
(14, 'Korea'),
(15, 'Kutchi'),
(16, 'Malayalam'),
(17, 'Mandarin'),
(18, 'Marathi'),
(19, 'Marwadi'),
(20, 'Oriya'),
(21, 'Punjabi'),
(22, 'Russian'),
(23, 'Sindhi'),
(24, 'Spanish'),
(25, 'Tamil'),
(26, 'Telugu'),
(27, 'Tulu'),
(28, 'Urdu'),
(29, 'Nalayalam'),
(30, 'Vietnamese'),
(31, 'Maithili'),
(32, 'Nepalese'),
(33, 'Malaysian');

-- --------------------------------------------------------

--
-- Table structure for table "ld"
--

CREATE TABLE IF NOT EXISTS "ld" (
  "Sl_No"            INT           NOT NULL DEFAULT 0,
  "LID"              VARCHAR(7)    DEFAULT NULL,
  "Name"             VARCHAR(200)  DEFAULT NULL,
  "ID"               VARCHAR(5)    DEFAULT NULL,
  "SGID"             VARCHAR(5)    DEFAULT NULL,
  "Opening_Balance"  NUMERIC(20,2)  NOT NULL DEFAULT '0.00',
  "Closing_Balance"  NUMERIC(20,2)  NOT NULL DEFAULT '0.00',
  "OBType"           CHAR(2)       DEFAULT NULL,
  "Member_ID"        VARCHAR(6)    DEFAULT NULL,
  "Opening_Type"     CHAR(2)       DEFAULT NULL,
  PRIMARY KEY ("Sl_No")
);

-- --------------------------------------------------------

--
-- Table structure for table "leave_acc_year"
--

CREATE TABLE IF NOT EXISTS "leave_acc_year" (
  "leave_acc_year_id"        SERIAL,
  "acc_name"  VARCHAR(50)  NOT NULL,
  "acc_year"  VARCHAR(50)  NOT NULL,
  "status"    SMALLINT   DEFAULT 1,
  PRIMARY KEY ("leave_acc_year_id")
);

--
-- Dumping data for table "leave_acc_year"
--

INSERT INTO "leave_acc_year" ("leave_acc_year_id", "acc_name", "acc_year", "status") VALUES
(1, '2008', '2008 - 2009', 1),
(2, '2009', '2009 - 2010', 1),
(3, '2010', '2010 - 2026', 1),
(4, '2026', '2026 - 2026', 1),
(5, '2026', '2026 - 2026', 1),
(6, '2026', '2026 - 2026', 1);

-- --------------------------------------------------------

--
-- Table structure for table "leave_att_point"
--

CREATE TABLE IF NOT EXISTS "leave_att_point" (
  "leave_att_point_id"               SERIAL,
  "point_att"        VARCHAR(50)   NOT NULL,
  "update_points"    VARCHAR(200)  NOT NULL,
  "att_colors"       VARCHAR(255)  NOT NULL,
  "full_name"        VARCHAR(255)  NOT NULL,
  "name"             VARCHAR(50)   DEFAULT NULL,
  "status"           INT           NOT NULL,
  "staff_date_time"  TIMESTAMP      NOT NULL,
  "username"         VARCHAR(255)  NOT NULL,
  PRIMARY KEY ("leave_att_point_id")
);

--
-- Dumping data for table "leave_att_point"
--

INSERT INTO "leave_att_point" ("leave_att_point_id", "point_att", "update_points", "att_colors", "full_name", "name", "status", "staff_date_time", "username") VALUES
(1, '1', '0', '077512', '0', 'P', 1, '2026-01-31 01:36:30', 'administrator'),
(2, '0', '1', 'FF1808', '0', 'A', 1, '2026-01-31 01:36:30', 'administrator'),
(3, '1', '0', 'FF3912', '0', 'WO', 1, '2026-01-31 01:36:30', 'administrator'),
(4, '0', '0', '0000FF', '0', 'H', 1, '2026-01-31 01:36:30', 'administrator'),
(5, '0', '1', 'FF0000', '0', 'L', 1, '2026-01-31 01:36:30', 'administrator'),
(6, '0.5', '0.5', '9933CC', '0', 'FHL', 1, '2026-01-31 01:36:30', 'administrator'),
(7, '0.5', '0.5', '330000', '0', 'SHL', 1, '2026-01-31 01:36:30', 'administrator'),
(8, '0', '1', 'FF0000', '0', 'LWP', 1, '2026-01-31 01:36:30', 'administrator'),
(9, '1', '0', '9933CC', '0', 'P (EE)', 1, '2026-01-31 01:36:30', 'administrator'),
(10, '1', '0', 'FF6600', '0', 'P (LC)', 1, '2026-01-31 01:36:30', 'administrator'),
(11, '0.25', '0.25', '4141B5', '0', 'P (QD)', 1, '2026-01-31 13:23:20', 'administrator');

-- --------------------------------------------------------

--
-- Table structure for table "leave_data_m20"
--

CREATE TABLE IF NOT EXISTS "leave_data_m20" (
  "leave_data_m20_id"             SERIAL,
  "staff_id"       INT           NOT NULL,
  "E_Code"         VARCHAR(255)  NOT NULL,
  "Employee_Name"  VARCHAR(255)  NOT NULL,
  "Apr_13"         VARCHAR(255)  NOT NULL,
  "May_13"         VARCHAR(255)  NOT NULL,
  "June_13"        VARCHAR(255)  NOT NULL,
  "July_13"        VARCHAR(255)  NOT NULL,
  "Aug_13"         VARCHAR(255)  NOT NULL,
  "Sep_13"         VARCHAR(255)  NOT NULL,
  "Oct_13"         VARCHAR(255)  NOT NULL,
  "Nov_13"         VARCHAR(255)  NOT NULL,
  "Dec_13"         VARCHAR(255)  NOT NULL,
  "Jan_14"         VARCHAR(255)  NOT NULL,
  "Feb_14"         VARCHAR(255)  NOT NULL,
  "March_14"       VARCHAR(255)  NOT NULL,
  PRIMARY KEY ("leave_data_m20_id")
);

--
-- Dumping data for table "leave_data_m20"
--

INSERT INTO "leave_data_m20" ("leave_data_m20_id", "staff_id", "E_Code", "Employee_Name", "Apr_13", "May_13", "June_13", "July_13", "Aug_13", "Sep_13", "Oct_13", "Nov_13", "Dec_13", "Jan_14", "Feb_14", "March_14") VALUES
(1, 238, '8209', 'Afroz Pannu', '0.50', '2.00', '4.5', '1.50', '1.00', '', '2.00', '1.00', '6.50', '7.00', '1.50', '1.00'),
(2, 240, '8007', 'Agnel Waz', '1.00', '', '', '11', '1', '', '1.00', '1.00', '1.00', '6.00', '', '4.00'),
(3, 0, '8015', 'Anil Mane', '2.50', '6.00', '1.00', '0.50', '3', '2.00', '1.00', '3.00', '4.00', '3.50', '3.50', '1.00'),
(4, 275, '8022', 'Anisha Punjabi', '2', '1', '3.5', '', '', '5.50', '1.00', '-', '1.00', '4.00', '4.00', '16.00'),
(5, 192, '8016', 'Anju Agrawal', '2.50', '5.50', '1.50', '4.50', '0.5', '5.00', '3.00', '6.00', '3.00', '4.00', '2.00', '2.00'),
(6, 246, '8020', 'Archana Mestry ', '3.50', '', '2.50', '2.50', '2.00', '4.50', '-', '1.00', '12.00', '0.50', '1.00', '1.00'),
(7, 260, '8235', 'Asvina Vala', '1', '2', '4', '', '3.5', '3.50', '1.00', '2.50', '6.00', '4.00', '3.50', '3.00'),
(8, 247, '8243', 'Chaitali Ganediwala', '2', '', '3', '', '1.5', '-', '2.50', '4.00', '8.00', '4.50', '1.50', '2.50'),
(9, 271, '8233', 'Deepak Mistry', '0.5', '', '1.5', '1', '', '-', '2.50', '7.50', '4.00', '4.00', '-', '0.50'),
(10, 208, '8204', 'Dhyanvi Kumar', '3.00', '6.50', '1.5', '6.00', '1.00', '1.00', '0.75', '4.75', '1.75', '6.25', '5.00', '3.50');

-- --------------------------------------------------------

--
-- Table structure for table "leave_staff_attand"
--

CREATE TABLE IF NOT EXISTS "leave_staff_attand" (
  "leave_staff_attand_id"               SERIAL,
  "staff_id"         VARCHAR(100)  NOT NULL,
  "a_year"           VARCHAR(10)   NOT NULL,
  "rfid_date"        VARCHAR(100)  NOT NULL,
  "expect_rfid_in"   VARCHAR(100)  NOT NULL,
  "rfid_in"          VARCHAR(100)  NOT NULL,
  "expect_rfid_out"  VARCHAR(100)  NOT NULL,
  "rfid_out"         VARCHAR(100)  NOT NULL,
  "att_code_rfid"    VARCHAR(100)  NOT NULL,
  "att_point_rfid"   VARCHAR(100)  NOT NULL,
  "rfid_number"      VARCHAR(250)  NOT NULL,
  "status"           SMALLINT    DEFAULT 1,
  PRIMARY KEY ("leave_staff_attand_id")
);

--
-- Dumping data for table "leave_staff_attand"
--

INSERT INTO "leave_staff_attand" ("leave_staff_attand_id", "staff_id", "a_year", "rfid_date", "expect_rfid_in", "rfid_in", "expect_rfid_out", "rfid_out", "att_code_rfid", "att_point_rfid", "rfid_number", "status") VALUES
(1, '281', '2026', '2026-03-20', '07:40', '', '16:10', '', 'H', '0', 'C429DF38000000000000000000000000', 1),
(2, '281', '2026', '2026-03-21', '07:40', '', '16:10', '', 'H', '0', 'C429DF38000000000000000000000000', 1),
(3, '281', '2026', '2026-03-22', '07:40', '', '16:10', '', 'H', '0', 'C429DF38000000000000000000000000', 1),
(4, '281', '2026', '2026-03-23', '07:40', '', '16:10', '', 'H', '0', 'C429DF38000000000000000000000000', 1),
(5, '281', '2026', '2026-03-24', '07:40', '07:30:40', '16:10', '15:23:07', 'EE', '0.5', 'C429DF38000000000000000000000000', 1),
(6, '281', '2026', '2026-03-25', '07:40', '08:10:05', '16:10', '16:12:38', 'LC', '0', 'C429DF38000000000000000000000000', 1),
(7, '281', '2026', '2026-03-26', '07:40', '07:31:47', '16:10', '16:29:39', 'P', '0', 'C429DF38000000000000000000000000', 1),
(8, '281', '2026', '2026-03-27', '07:40', '07:29:52', '16:10', '07:29:52', 'P(D)', '0', 'C429DF38000000000000000000000000', 1),
(9, '281', '2026', '2026-03-28', '07:40', '07:34:19', '16:10', '16:26:39', 'P', '0', 'C429DF38000000000000000000000000', 1),
(10, '281', '2026', '2026-03-29', '07:40', '', '16:10', '', 'H', '0', 'C429DF38000000000000000000000000', 1);

-- --------------------------------------------------------

--
-- Table structure for table "leave_staff_day"
--

CREATE TABLE IF NOT EXISTS "leave_staff_day" (
  "leave_staff_day_id"          SERIAL,
  "days"        INT  NOT NULL,
  "leave_type"  INT  NOT NULL,
  "staff_type"  INT  NOT NULL,
  "status"      INT  NOT NULL,
  PRIMARY KEY ("leave_staff_day_id")
);

--
-- Dumping data for table "leave_staff_day"
--

INSERT INTO "leave_staff_day" ("leave_staff_day_id", "days", "leave_type", "staff_type", "status") VALUES
(1, 30, 1, 1, 1),
(2, 30, 1, 2, 1),
(3, 0, 6, 1, 1),
(4, 0, 6, 2, 1),
(5, 15, 2, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table "leave_staff_paid_tot_acc"
--

CREATE TABLE IF NOT EXISTS "leave_staff_paid_tot_acc" (
  "leave_staff_paid_tot_acc_id"          SERIAL,
  "staff_name"  VARCHAR(250)  NOT NULL DEFAULT '',
  "staff_id"    INT           DEFAULT NULL,
  "group_id"    INT           DEFAULT NULL,
  "ins_date"    TIMESTAMP      NOT NULL,
  "acc_1"       VARCHAR(250)  NOT NULL DEFAULT '',
  "acc_2"       VARCHAR(250)  NOT NULL DEFAULT '',
  "acc_3"       VARCHAR(250)  NOT NULL DEFAULT '',
  "acc_4"       VARCHAR(250)  NOT NULL DEFAULT '',
  "acc_5"       VARCHAR(250)  NOT NULL DEFAULT '',
  "acc_6"       VARCHAR(250)  NOT NULL DEFAULT '',
  "status"      SMALLINT    DEFAULT 1,
  PRIMARY KEY ("leave_staff_paid_tot_acc_id")
);

--
-- Dumping data for table "leave_staff_paid_tot_acc"
--

INSERT INTO "leave_staff_paid_tot_acc" ("leave_staff_paid_tot_acc_id", "staff_name", "staff_id", "group_id", "ins_date", "acc_1", "acc_2", "acc_3", "acc_4", "acc_5", "acc_6", "status") VALUES
(1, 'Alexander Johnson ', 69, 1, NULL, '', '', '', '', '', '25', 1),
(2, 'Natasha Khanna ', 70, 1, NULL, '', '', '', '', '', '25', 1),
(3, 'Neha Thoria ', 71, 1, NULL, '', '', '', '', '', '25', 1),
(4, 'Adam Meier ', 66, 1, NULL, '', '', '', '', '', '25', 1),
(5, 'Pascal Fuzier ', 67, 1, NULL, '', '', '', '', '', '25', 1),
(6, 'Michael Bailey ', 68, 1, NULL, '', '', '', '', '', '25', 1),
(7, 'Robert Mullins ', 63, 1, NULL, '', '', '', '', '', '25', 1),
(8, 'Carrie Tokunaga ', 64, 3, NULL, '', '', '', '', '', '25', 1),
(9, 'Vitna Bailey ', 65, 1, NULL, '', '', '', '', '', '25', 1),
(10, 'Erika Mullins ', 62, 1, NULL, '', '', '', '', '', '25', 1);

-- --------------------------------------------------------

--
-- Table structure for table "leave_staff_paid_tot_acc_temp"
--

CREATE TABLE IF NOT EXISTS "leave_staff_paid_tot_acc_temp" (
  "leave_staff_paid_tot_acc_temp_id"           SERIAL,
  "staff_id"     INT           DEFAULT NULL,
  "acc_id"       VARCHAR(250)  NOT NULL DEFAULT '',
  "tot_paid"     VARCHAR(200)  NOT NULL,
  "paid_vat"     VARCHAR(250)  NOT NULL DEFAULT '',
  "cur_balance"  NUMERIC(12,2)  NOT NULL,
  "un_paid"      VARCHAR(200)  NOT NULL,
  "status"       SMALLINT    DEFAULT 1,
  PRIMARY KEY ("leave_staff_paid_tot_acc_temp_id")
);

--
-- Dumping data for table "leave_staff_paid_tot_acc_temp"
--

INSERT INTO "leave_staff_paid_tot_acc_temp" ("leave_staff_paid_tot_acc_temp_id", "staff_id", "acc_id", "tot_paid", "paid_vat", "cur_balance", "un_paid", "status") VALUES
(1, 69, '6', '9', '15.25', '0', '6.25', 1),
(2, 70, '6', '9', '8.5', '0.5', '0', 1),
(3, 66, '6', '9', '7.5', '1.5', '0', 1),
(4, 67, '6', '9', '0', '9', '0', 1),
(5, 68, '6', '9', '4', '5', '0', 1),
(6, 64, '6', '9', '5', '4', '0', 1),
(7, 65, '6', '9', '3', '6', '0', 1),
(8, 61, '6', '9', '11', '0', '2', 1),
(9, 60, '6', '9', '6.5', '2.5', '0', 1),
(10, 58, '6', '9', '5', '4', '0', 1);

-- --------------------------------------------------------

--
-- Table structure for table "leave_staff_paid_tot_backup"
--

CREATE TABLE IF NOT EXISTS "leave_staff_paid_tot_backup" (
  "leave_staff_paid_tot_backup_id"        SERIAL,
  "staff_id"  INT           DEFAULT NULL,
  "acc_id"    VARCHAR(250)  NOT NULL DEFAULT '',
  "tot_paid"  VARCHAR(200)  NOT NULL,
  "paid_vat"  VARCHAR(250)  NOT NULL DEFAULT '',
  "un_paid"   VARCHAR(200)  NOT NULL,
  "status"    SMALLINT    DEFAULT 1,
  PRIMARY KEY ("leave_staff_paid_tot_backup_id")
);

--
-- Dumping data for table "leave_staff_paid_tot_backup"
--

INSERT INTO "leave_staff_paid_tot_backup" ("leave_staff_paid_tot_backup_id", "staff_id", "acc_id", "tot_paid", "paid_vat", "un_paid", "status") VALUES
(1, 69, '6', '9', '9', '10', 1),
(2, 70, '6', '9', '7.5', '0', 1),
(3, 66, '6', '9', '7.5', '0', 1),
(4, 67, '6', '9', '0', '0', 1),
(5, 68, '6', '9', '2.5', '0', 1),
(6, 64, '6', '9', '4', '0', 1),
(7, 65, '6', '9', '3', '0', 1),
(8, 61, '6', '9', '9', '0.5', 1),
(9, 60, '6', '9', '6', '0', 1),
(10, 58, '6', '9', '5', '0', 1);

-- --------------------------------------------------------

--
-- Table structure for table "lesson_chapter"
--

CREATE TABLE IF NOT EXISTS "lesson_chapter" (
  "lesson_chapter_id"       SERIAL,
  "class"    INT           NOT NULL,
  "subj"     INT           NOT NULL,
  "chapter"  VARCHAR(250)  NOT NULL,
  PRIMARY KEY ("lesson_chapter_id")
);

--
-- Dumping data for table "lesson_chapter"
--

INSERT INTO "lesson_chapter" ("lesson_chapter_id", "class", "subj", "chapter") VALUES
(1, 5, 5, 'BASIC COMPUTER ORGANISATION'),
(2, 5, 5, 'MULTIMEDIA'),
(3, 5, 6, 'Mask Making'),
(4, 5, 6, 'Painting'),
(5, 5, 3, 'Understanding of mathematics'),
(6, 5, 3, 'Operations'),
(7, 2, 233, 'Language'),
(8, 2, 234, 'Introduction'),
(9, 2, 235, 'Introduction'),
(10, 2, 235, 'Types of music'),
(11, 5, 1, 'Introduction'),
(12, 5, 1, 'Types'),
(13, 5, 2, 'SPELLING'),
(14, 5, 2, 'Abbreviations'),
(15, 5, 4, 'Alphabets'),
(16, 5, 7, 'Introduction'),
(17, 5, 7, 'Types of music'),
(18, 5, 8, 'Activities'),
(19, 5, 247, 'Introduction'),
(20, 5, 247, 'Forms of dance'),
(21, 5, 248, 'Basics'),
(22, 5, 248, 'Solve a puzzle'),
(23, 5, 249, 'Warm up'),
(24, 5, 249, 'Basic gym exercises'),
(25, 2, 232, 'Games'),
(26, 2, 232, 'Story telling'),
(27, 2, 236, 'Basics'),
(28, 2, 236, 'Games'),
(29, 5, 250, 'Basics'),
(30, 5, 250, 'Different strokes'),
(31, 5, 2, 'Opposites'),
(32, 9, 59, 'Module 1'),
(33, 1, 237, 'Testing');

-- --------------------------------------------------------

--
-- Table structure for table "lesson_plan_documents"
--

CREATE TABLE IF NOT EXISTS "lesson_plan_documents" (
  "lesson_plan_documents_id"                      INT           NOT NULL,
  "teacher_lesson_plan_id"  INT           NOT NULL,
  "titel"                   VARCHAR(100)  NOT NULL,
  "description"             TEXT          NOT NULL,
  "file_path"               VARCHAR(250)  NOT NULL,
  "status"                  SMALLINT    NOT NULL,
  PRIMARY KEY ("lesson_plan_documents_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "library_name"
--

CREATE TABLE IF NOT EXISTS "library_name" (
  "library_name_id"       SERIAL,
  "name"     VARCHAR(100)  NOT NULL DEFAULT '',
  "address"  VARCHAR(250)  DEFAULT NULL,
  "phone"    VARCHAR(50)   DEFAULT NULL,
  "email"    VARCHAR(50)   DEFAULT NULL,
  "remark"   TEXT,
  PRIMARY KEY ("library_name_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "lib_acc_details"
--

CREATE TABLE IF NOT EXISTS "lib_acc_details" (
  "lib_acc_details_id"           SERIAL,
  "master_id"    INT                    DEFAULT NULL,
  "media_type"   INT                    NOT NULL DEFAULT 0,
  "acc_no"       INTEGER  DEFAULT NULL,
  "mode"         VARCHAR(50)            DEFAULT 'D',
  "book_status"  VARCHAR(50)            DEFAULT NULL,
  "book_type"    VARCHAR(50)            DEFAULT NULL,
  "library"      INT                    NOT NULL DEFAULT 0,
  "register"     INT                    NOT NULL DEFAULT 0,
  "flag"         INT                    DEFAULT 0,
  "call_no"      VARCHAR(50)            DEFAULT NULL,
  PRIMARY KEY ("lib_acc_details_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "lib_book_binding"
--

CREATE TABLE IF NOT EXISTS "lib_book_binding" (
  "lib_book_binding_id"            SERIAL,
  "acc_no"        VARCHAR(10)    DEFAULT NULL,
  "library"       INT            DEFAULT NULL,
  "binding_date"  DATE           DEFAULT NULL,
  "return_date"   DATE           DEFAULT NULL,
  "status"        VARCHAR(50)  DEFAULT 'S',
  "descr"         VARCHAR(255)   DEFAULT NULL,
  PRIMARY KEY ("lib_book_binding_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "lib_book_details"
--

CREATE TABLE IF NOT EXISTS "lib_book_details" (
  "lib_book_details_id"                 SERIAL,
  "title"              VARCHAR(255)  DEFAULT NULL,
  "class_no"           VARCHAR(255)  DEFAULT NULL,
  "classification_no"  VARCHAR(20)   DEFAULT NULL,
  "book_no"            VARCHAR(50)   DEFAULT NULL,
  "author"             VARCHAR(255)  DEFAULT NULL,
  "author_details"     VARCHAR(255)  DEFAULT NULL,
  "publisher"          VARCHAR(255)  DEFAULT NULL,
  "edition"            VARCHAR(255)  DEFAULT NULL,
  "year"               VARCHAR(255)  DEFAULT NULL,
  "rack"               VARCHAR(255)  DEFAULT NULL,
  "purchase_type"      VARCHAR(255)  DEFAULT NULL,
  "supplier"           VARCHAR(255)  DEFAULT NULL,
  "no_of_pages"        VARCHAR(10)   DEFAULT 0,
  "pyment_type"        VARCHAR(255)  DEFAULT NULL,
  "payment_details"    VARCHAR(255)  DEFAULT NULL,
  "bill_no"            VARCHAR(50)   DEFAULT NULL,
  "bill_date"          DATE          DEFAULT NULL,
  "date_of_acquiring"  DATE          DEFAULT NULL,
  "price_type"         VARCHAR(255)  DEFAULT NULL,
  "price"              NUMERIC(12,2)   DEFAULT NULL,
  "isbn"               VARCHAR(50)   DEFAULT NULL,
  "subject"            VARCHAR(255)  DEFAULT NULL,
  "key_word1"          VARCHAR(255)  DEFAULT NULL,
  "key_word2"          VARCHAR(255)  DEFAULT NULL,
  "key_word3"          VARCHAR(255)  DEFAULT NULL,
  "key_word4"          VARCHAR(255)  DEFAULT NULL,
  "key_word5"          VARCHAR(255)  DEFAULT NULL,
  "remarks"            TEXT,
  PRIMARY KEY ("lib_book_details_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "lib_bound_acc_det"
--

CREATE TABLE IF NOT EXISTS "lib_bound_acc_det" (
  "lib_bound_acc_det_id"            SERIAL,
  "master_id"     INT          DEFAULT NULL,
  "mag_acc_no"    VARCHAR(50)  DEFAULT NULL,
  "volume"        VARCHAR(50)  DEFAULT NULL,
  "issue"         VARCHAR(50)  DEFAULT NULL,
  "mode"          VARCHAR(50)  DEFAULT 'D',
  "bound_status"  VARCHAR(50)  DEFAULT NULL,
  "bound_type"    VARCHAR(50)  DEFAULT NULL,
  "library"       INT          NOT NULL DEFAULT 0,
  "register"      INT          NOT NULL DEFAULT 0,
  "flag"          INT          DEFAULT 0,
  PRIMARY KEY ("lib_bound_acc_det_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "lib_bound_media_det"
--

CREATE TABLE IF NOT EXISTS "lib_bound_media_det" (
  "lib_bound_media_det_id"                 SERIAL,
  "acc_no"             VARCHAR(50)            DEFAULT NULL,
  "title"              VARCHAR(255)           DEFAULT NULL,
  "month"              INTEGER  DEFAULT NULL,
  "year"               INT                    DEFAULT NULL,
  "periodicity"        VARCHAR(4)             DEFAULT NULL,
  "key_word1"          VARCHAR(255)           DEFAULT NULL,
  "key_word2"          VARCHAR(255)           DEFAULT NULL,
  "key_word3"          VARCHAR(255)           DEFAULT NULL,
  "key_word4"          VARCHAR(255)           DEFAULT NULL,
  "key_word5"          VARCHAR(255)           DEFAULT NULL,
  "remarks"            TEXT,
  "flag"               INT                    DEFAULT NULL,
  "date_of_acquiring"  DATE                   DEFAULT NULL,
  PRIMARY KEY ("lib_bound_media_det_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "lib_budget_m"
--

CREATE TABLE IF NOT EXISTS "lib_budget_m" (
  "lib_budget_m_id"         SERIAL,
  "year_from"  DATE  DEFAULT NULL,
  "year_to"    DATE  DEFAULT NULL,
  "amt"        INT   NOT NULL DEFAULT 0,
  "library"    INT   NOT NULL DEFAULT 0,
  PRIMARY KEY ("lib_budget_m_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "lib_cd_acc_det"
--

CREATE TABLE IF NOT EXISTS "lib_cd_acc_det" (
  "lib_cd_acc_det_id"          SERIAL,
  "master_id"   INT          DEFAULT NULL,
  "media_type"  INT          NOT NULL DEFAULT 0,
  "acc_no"      VARCHAR(50)  NOT NULL DEFAULT '',
  "mode"        VARCHAR(50)  NOT NULL DEFAULT '',
  "cd_status"   VARCHAR(50)  DEFAULT NULL,
  "cd_type"     VARCHAR(50)  DEFAULT NULL,
  "library"     INT          NOT NULL DEFAULT 0,
  "register"    INT          NOT NULL DEFAULT 0,
  "flag"        INT          DEFAULT 0,
  "call_no"     INT          DEFAULT NULL,
  PRIMARY KEY ("lib_cd_acc_det_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "lib_cd_det"
--

CREATE TABLE IF NOT EXISTS "lib_cd_det" (
  "lib_cd_det_id"                 SERIAL,
  "title"              VARCHAR(255)           DEFAULT NULL,
  "call_no"            VARCHAR(100)           DEFAULT NULL,
  "author"             VARCHAR(255)           DEFAULT NULL,
  "rack"               VARCHAR(255)           DEFAULT NULL,
  "date_of_acquiring"  DATE                   DEFAULT NULL,
  "key_word1"          VARCHAR(255)           DEFAULT NULL,
  "key_word2"          VARCHAR(255)           DEFAULT NULL,
  "key_word3"          VARCHAR(255)           DEFAULT NULL,
  "key_word4"          VARCHAR(255)           DEFAULT NULL,
  "key_word5"          VARCHAR(255)           DEFAULT NULL,
  "publication_date"   DATE                   DEFAULT NULL,
  "price"              NUMERIC(8,2)             DEFAULT NULL,
  "source_acc_no"      VARCHAR(15)            DEFAULT NULL,
  "month"              INTEGER  DEFAULT NULL,
  "year"               INT                    DEFAULT NULL,
  "volume"             VARCHAR(15)            DEFAULT NULL,
  "issue"              VARCHAR(15)            DEFAULT NULL,
  "source"             VARCHAR(255)           DEFAULT NULL,
  "remarks"            TEXT,
  "class_no"           VARCHAR(255)           DEFAULT NULL,
  PRIMARY KEY ("lib_cd_det_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "lib_circulation_m"
--

CREATE TABLE IF NOT EXISTS "lib_circulation_m" (
  "lib_circulation_m_id"           SERIAL,
  "m_id"         INT                    NOT NULL DEFAULT 0,
  "acc_id"       INTEGER  DEFAULT NULL,
  "library"      INT                    DEFAULT NULL,
  "issue_date"   DATE                   DEFAULT NULL,
  "due_date"     DATE                   DEFAULT NULL,
  "return_date"  DATE                   DEFAULT NULL,
  "renews"       INT                    DEFAULT 0,
  "remarks"      VARCHAR(250)           DEFAULT NULL,
  "status"       CHAR(1)                NOT NULL DEFAULT '',
  "cno"          VARCHAR(20)            DEFAULT NULL,
  "media_type"   VARCHAR(5)             DEFAULT NULL,
  "name"         VARCHAR(30)            DEFAULT NULL,
  "returned"     VARCHAR(30)            DEFAULT NULL,
  "issue_time"   TIME                   DEFAULT '00:00:00',
  "due_time"     TIME                   DEFAULT '00:00:00',
  "par_count"    INT                    DEFAULT 0,
  "ret_to"       VARCHAR(30)            DEFAULT NULL,
  "fineamt"      NUMERIC(7,2)             DEFAULT NULL,
  PRIMARY KEY ("lib_circulation_m_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "lib_finedtls"
--

CREATE TABLE IF NOT EXISTS "lib_finedtls" (
  "lib_finedtls_id"        SERIAL,
  "daysfrom"  INT         DEFAULT NULL,
  "daysto"    INT         DEFAULT NULL,
  "fine1"     NUMERIC(5,2)  DEFAULT NULL,
  "fine2"     NUMERIC(5,2)  DEFAULT NULL,
  "fine3"     NUMERIC(5,2)  DEFAULT NULL,
  PRIMARY KEY ("lib_finedtls_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "lib_floppy_acc_det"
--

CREATE TABLE IF NOT EXISTS "lib_floppy_acc_det" (
  "lib_floppy_acc_det_id"             SERIAL,
  "master_id"      INT          DEFAULT NULL,
  "media_type"     INT          DEFAULT NULL,
  "acc_no"         VARCHAR(50)  DEFAULT NULL,
  "mode"           VARCHAR(50)  DEFAULT NULL,
  "floppy_status"  VARCHAR(50)  DEFAULT NULL,
  "floppy_type"    VARCHAR(50)  DEFAULT NULL,
  "library"        INT          DEFAULT NULL,
  "register"       INT          DEFAULT NULL,
  "flag"           INT          DEFAULT NULL,
  "call_no"        INT          DEFAULT NULL,
  PRIMARY KEY ("lib_floppy_acc_det_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "lib_magazine"
--

CREATE TABLE IF NOT EXISTS "lib_magazine" (
  "title"            VARCHAR(200)           NOT NULL DEFAULT '',
  "rack"             VARCHAR(15)            DEFAULT NULL,
  "magazine_sub_no"  VARCHAR(50)            DEFAULT NULL,
  "source"           VARCHAR(20)            DEFAULT NULL,
  "magazine_date"    DATE                   DEFAULT NULL,
  "year"             VARCHAR(4)             DEFAULT NULL,
  "issue"            VARCHAR(8)             DEFAULT NULL,
  "volume"           VARCHAR(8)             DEFAULT NULL,
  "issn"             VARCHAR(8)             DEFAULT NULL,
  "keywords"         VARCHAR(50)            DEFAULT NULL,
  "no_of_pages"      INT                    DEFAULT NULL,
  "language"         VARCHAR(15)            DEFAULT NULL,
  "amount_type"      VARCHAR(15)            DEFAULT NULL,
  "amount"           NUMERIC(10,2)            DEFAULT NULL,
  "bill_no"          VARCHAR(50)            DEFAULT NULL,
  "bank_details"     VARCHAR(100)           DEFAULT NULL,
  "status"           CHAR(1)                DEFAULT NULL,
  "register"         INT                    NOT NULL DEFAULT 0,
  "library"          INT                    DEFAULT NULL,
  "subject"          VARCHAR(100)           DEFAULT NULL,
  "magazine_no"      VARCHAR(9)             DEFAULT NULL,
  "lib_magazine_id"               SERIAL,
  "month"            INTEGER  DEFAULT NULL,
  "remarks"          TEXT,
  "articles1"        VARCHAR(255)           DEFAULT NULL,
  "articles2"        VARCHAR(255)           DEFAULT NULL,
  "bound"            VARCHAR(50)          DEFAULT 'N',
  "ssp_type"         INT                    DEFAULT NULL,
  "stts"             INT                    DEFAULT 1,
  PRIMARY KEY ("lib_magazine_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "lib_magazine_subscription"
--

CREATE TABLE IF NOT EXISTS "lib_magazine_subscription" (
  "lib_magazine_subscription_id"                 SERIAL,
  "title"              VARCHAR(200)           NOT NULL DEFAULT '',
  "language"           VARCHAR(20)            DEFAULT NULL,
  "periodicity"        VARCHAR(15)            DEFAULT NULL,
  "due_date"           DATE                   DEFAULT NULL,
  "supplier"           VARCHAR(100)           DEFAULT NULL,
  "subscription_date"  DATE                   DEFAULT NULL,
  "bill_no"            VARCHAR(6)             DEFAULT NULL,
  "amount_type"        VARCHAR(15)            DEFAULT NULL,
  "amount"             NUMERIC(10,2)            DEFAULT NULL,
  "bank_details"       VARCHAR(100)           DEFAULT NULL,
  "a_sub_no"           VARCHAR(15)            DEFAULT NULL,
  "source"             VARCHAR(50)            DEFAULT NULL,
  "library"            INT                    DEFAULT NULL,
  "register"           INT                    DEFAULT NULL,
  "ssp_type"           INT                    DEFAULT NULL,
  "stts"               INT                    DEFAULT 1,
  PRIMARY KEY ("lib_magazine_subscription_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "lib_mediatype"
--

CREATE TABLE IF NOT EXISTS "lib_mediatype" (
  "lib_mediatype_id"    INT          NOT NULL DEFAULT 0,
  "name"  VARCHAR(50)  NOT NULL DEFAULT '',
  PRIMARY KEY ("lib_mediatype_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "lib_membership_det"
--

CREATE TABLE IF NOT EXISTS "lib_membership_det" (
  "mbno"     VARCHAR(50)    NOT NULL DEFAULT '',
  "m_id"     VARCHAR(50)    NOT NULL DEFAULT '',
  "library"  VARCHAR(50)    NOT NULL DEFAULT '',
  "deposit"  VARCHAR(50)  DEFAULT 'N',
  PRIMARY KEY ("mbno")
);

-- --------------------------------------------------------

--
-- Table structure for table "lib_membership_m"
--

CREATE TABLE IF NOT EXISTS "lib_membership_m" (
  "lib_membership_m_id"            SERIAL,
  "issued_on"     DATE          DEFAULT NULL,
  "valid_till"    DATE          DEFAULT NULL,
  "cancelled_on"  DATE          DEFAULT NULL,
  "s_id"          VARCHAR(10)   DEFAULT NULL,
  "type"          INT           NOT NULL DEFAULT 0,
  "m_no"          VARCHAR(50)   NOT NULL,
  "usn"           VARCHAR(50)   DEFAULT NULL,
  "status"        CHAR(1)       NOT NULL DEFAULT '',
  "pwd"           VARCHAR(50)   DEFAULT NULL,
  "MemberName"    VARCHAR(100)  NOT NULL DEFAULT '',
  "totalCards"    INT           NOT NULL DEFAULT 0,
  "domain"        VARCHAR(10)   DEFAULT NULL,
  PRIMARY KEY ("lib_membership_m_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "lib_newmagazine"
--

CREATE TABLE IF NOT EXISTS "lib_newmagazine" (
  "title"            VARCHAR(200)           NOT NULL DEFAULT '',
  "rack"             VARCHAR(15)            DEFAULT NULL,
  "magazine_sub_no"  VARCHAR(50)            DEFAULT NULL,
  "source"           VARCHAR(20)            DEFAULT NULL,
  "magazine_date"    DATE                   DEFAULT NULL,
  "year"             VARCHAR(4)             DEFAULT NULL,
  "issue"            VARCHAR(8)             DEFAULT NULL,
  "volume"           VARCHAR(8)             DEFAULT NULL,
  "issn"             VARCHAR(8)             DEFAULT NULL,
  "keywords"         VARCHAR(50)            DEFAULT NULL,
  "no_of_pages"      INT                    DEFAULT NULL,
  "language"         VARCHAR(15)            DEFAULT NULL,
  "amount_type"      VARCHAR(15)            DEFAULT NULL,
  "amount"           NUMERIC(5,2)             DEFAULT NULL,
  "bill_no"          VARCHAR(50)            DEFAULT NULL,
  "bank_details"     VARCHAR(100)           DEFAULT NULL,
  "status"           CHAR(1)                DEFAULT NULL,
  "register"         INT                    NOT NULL DEFAULT 0,
  "library"          INT                    DEFAULT NULL,
  "subject"          VARCHAR(100)           DEFAULT NULL,
  "magazine_no"      VARCHAR(9)             DEFAULT NULL,
  "lib_newmagazine_id"               SERIAL,
  "month"            INTEGER  DEFAULT NULL,
  "remarks"          TEXT,
  "articles1"        VARCHAR(255)           DEFAULT NULL,
  "articles2"        VARCHAR(255)           DEFAULT NULL,
  "bound"            VARCHAR(50)          DEFAULT 'N',
  PRIMARY KEY ("lib_newmagazine_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "lib_newspaper_det"
--

CREATE TABLE IF NOT EXISTS "lib_newspaper_det" (
  "lib_newspaper_det_id"              SERIAL,
  "newspaper_no"    VARCHAR(10)   DEFAULT NULL,
  "title"           VARCHAR(150)  DEFAULT NULL,
  "language"        VARCHAR(50)   DEFAULT NULL,
  "newspaper_date"  DATE          DEFAULT NULL,
  "amount"          NUMERIC(10,2)   DEFAULT NULL,
  "remarks"         TEXT,
  "library"         INT           DEFAULT NULL,
  "register"        INT           DEFAULT NULL,
  "stts"            SMALLINT    DEFAULT 1,
  "nofcp"           INT           DEFAULT 0,
  PRIMARY KEY ("lib_newspaper_det_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "lib_order_det"
--

CREATE TABLE IF NOT EXISTS "lib_order_det" (
  "lib_order_det_id"               SERIAL,
  "order_id"         INT   NOT NULL DEFAULT 0,
  "title"            TEXT,
  "copies"           INT   NOT NULL DEFAULT 0,
  "author"           TEXT,
  "publisher"        TEXT,
  "apprate"          INT   DEFAULT NULL,
  "received_copies"  INT   DEFAULT 0,
  PRIMARY KEY ("lib_order_det_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "lib_order_m"
--

CREATE TABLE IF NOT EXISTS "lib_order_m" (
  "lib_order_m_id"            SERIAL,
  "order_no"      VARCHAR(50)  NOT NULL DEFAULT '',
  "order_date"    DATE         DEFAULT NULL,
  "order_copies"  INT          NOT NULL DEFAULT 0,
  "order_amt"     NUMERIC(8,2)  DEFAULT NULL,
  "vendor_id"     INT          NOT NULL DEFAULT 0,
  "library"       INT          NOT NULL DEFAULT 0,
  PRIMARY KEY ("lib_order_m_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "lib_phy_stkrep"
--

CREATE TABLE IF NOT EXISTS "lib_phy_stkrep" (
  "lib_phy_stkrep_id"       SERIAL,
  "mat_acc"  TEXT          NOT NULL,
  "mis_acc"  TEXT          NOT NULL,
  "ext_acc"  TEXT          NOT NULL,
  "iss_acc"  TEXT          NOT NULL,
  "dam_acc"  TEXT          NOT NULL,
  "sdate"    VARCHAR(150)  NOT NULL,
  "matc"     INT           NOT NULL,
  "misc"     INT           NOT NULL,
  "extc"     INT           NOT NULL,
  "issc"     INT           NOT NULL,
  "damc"     INT           NOT NULL,
  "media"    INT           DEFAULT NULL,
  PRIMARY KEY ("lib_phy_stkrep_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "lib_project_report_det"
--

CREATE TABLE IF NOT EXISTS "lib_project_report_det" (
  "lib_project_report_det_id"                 SERIAL,
  "title"              VARCHAR(255)  DEFAULT NULL,
  "call_no"            VARCHAR(100)  DEFAULT NULL,
  "author"             VARCHAR(255)  DEFAULT NULL,
  "school"            VARCHAR(20)   DEFAULT NULL,
  "year"               VARCHAR(255)  DEFAULT NULL,
  "rack"               VARCHAR(255)  DEFAULT NULL,
  "no_of_pages"        VARCHAR(10)   DEFAULT 0,
  "date_of_acquiring"  DATE          DEFAULT NULL,
  "key_word1"          VARCHAR(255)  DEFAULT NULL,
  "key_word2"          VARCHAR(255)  DEFAULT NULL,
  "key_word3"          VARCHAR(255)  DEFAULT NULL,
  "key_word4"          VARCHAR(255)  DEFAULT NULL,
  "key_word5"          VARCHAR(255)  DEFAULT NULL,
  "guide_name"         VARCHAR(100)  DEFAULT NULL,
  "class_name"         VARCHAR(100)  DEFAULT NULL,
  "course"             VARCHAR(50)   DEFAULT NULL,
  "remarks"            TEXT,
  PRIMARY KEY ("lib_project_report_det_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "lib_proj_acc_det"
--

CREATE TABLE IF NOT EXISTS "lib_proj_acc_det" (
  "lib_proj_acc_det_id"           SERIAL,
  "master_id"    INT       DEFAULT NULL,
  "media_type"   INT       NOT NULL DEFAULT 0,
  "acc_no"       CHAR(50)  NOT NULL DEFAULT '',
  "mode"         CHAR(50)  NOT NULL DEFAULT '',
  "book_status"  CHAR(50)  DEFAULT NULL,
  "book_type"    CHAR(50)  DEFAULT NULL,
  "library"      INT       NOT NULL DEFAULT 0,
  "register"     INT       NOT NULL DEFAULT 0,
  "flag"         INT       DEFAULT 0,
  "call_no"      INT       DEFAULT NULL,
  PRIMARY KEY ("lib_proj_acc_det_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "lib_purchase_det"
--

CREATE TABLE IF NOT EXISTS "lib_purchase_det" (
  "p_det_id"     SERIAL,
  "purchase_id"  INT           DEFAULT NULL,
  "title"        VARCHAR(200)  DEFAULT NULL,
  "copies"       INT           DEFAULT NULL,
  "author"       VARCHAR(200)  DEFAULT NULL,
  "publisher"    VARCHAR(200)  DEFAULT NULL,
  "apprate"      NUMERIC(8,2)   DEFAULT NULL,
  "received"     INT           DEFAULT NULL,
  "balance"      INT           DEFAULT NULL,
  PRIMARY KEY ("p_det_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "lib_purchase_m"
--

CREATE TABLE IF NOT EXISTS "lib_purchase_m" (
  "lib_purchase_m_id"             SERIAL,
  "order_id"       VARCHAR(50)  DEFAULT NULL,
  "purchaseNo"     VARCHAR(50)  NOT NULL DEFAULT '',
  "copies"         INT          NOT NULL DEFAULT 0,
  "delivery_date"  DATE         DEFAULT NULL,
  "amt"            NUMERIC(8,2)  DEFAULT NULL,
  "library"        INT          NOT NULL DEFAULT 0,
  "duedate"        DATE         DEFAULT NULL,
  "ptype"          VARCHAR(10)  DEFAULT NULL,
  PRIMARY KEY ("lib_purchase_m_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "lib_question_paper_det"
--

CREATE TABLE IF NOT EXISTS "lib_question_paper_det" (
  "lib_question_paper_det_id"                 SERIAL,
  "question_paper_no"  VARCHAR(255)  DEFAULT NULL,
  "school"            VARCHAR(10)   DEFAULT NULL,
  "course"             INT           DEFAULT NULL,
  "sem"                INT           DEFAULT NULL,
  "subject"            INT           DEFAULT NULL,
  "month"              VARCHAR(5)    DEFAULT NULL,
  "year"               VARCHAR(5)    DEFAULT NULL,
  "scheme"             VARCHAR(10)   DEFAULT NULL,
  "remarks"            TEXT,
  "library"            INT           DEFAULT NULL,
  "register"           INT           DEFAULT NULL,
  "flag"               INT           NOT NULL DEFAULT 0,
  "noupld"             INT           DEFAULT 0,
  "upldfiles"          VARCHAR(255)  DEFAULT NULL,
  PRIMARY KEY ("lib_question_paper_det_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "lib_quotation"
--

CREATE TABLE IF NOT EXISTS "lib_quotation" (
  "lib_quotation_id"         SERIAL,
  "library"    INT   DEFAULT NULL,
  "quot_date"  DATE  DEFAULT NULL,
  "vendor"     INT   DEFAULT NULL,
  PRIMARY KEY ("lib_quotation_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "lib_register"
--

CREATE TABLE IF NOT EXISTS "lib_register" (
  "lib_register_id"            SERIAL,
  "library"       INT           DEFAULT NULL,
  "register"      VARCHAR(100)  DEFAULT NULL,
  "collage_name"  TEXT,
  PRIMARY KEY ("lib_register_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "lib_reservation_m"
--

CREATE TABLE IF NOT EXISTS "lib_reservation_m" (
  "lib_reservation_m_id"        SERIAL,
  "l_id"      INT          DEFAULT NULL,
  "resdate"   DATE         DEFAULT NULL,
  "m_id"      VARCHAR(15)  DEFAULT NULL,
  "end_date"  DATE         DEFAULT NULL,
  "medid"     INT          DEFAULT NULL,
  "accno"     VARCHAR(50)  DEFAULT NULL,
  PRIMARY KEY ("lib_reservation_m_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "lib_reservation_temp"
--

CREATE TABLE IF NOT EXISTS "lib_reservation_temp" (
  "lib_reservation_temp_id"          SERIAL,
  "l_id"        VARCHAR(20)            DEFAULT NULL,
  "resdate"     DATE                   DEFAULT NULL,
  "m_id"        VARCHAR(20)            DEFAULT NULL,
  "accno"       INTEGER  DEFAULT NULL,
  "end_date"    DATE                   DEFAULT NULL,
  "media_type"  INT                    DEFAULT NULL,
  "stts"        SMALLINT             DEFAULT 0,
  PRIMARY KEY ("lib_reservation_temp_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "lib_temp_quotation_trans"
--

CREATE TABLE IF NOT EXISTS "lib_temp_quotation_trans" (
  "lib_temp_quotation_trans_id"         SERIAL,
  "author"     VARCHAR(100)  DEFAULT NULL,
  "publisher"  VARCHAR(100)  DEFAULT NULL,
  "title"      VARCHAR(100)  DEFAULT NULL,
  "copies"     INT           DEFAULT NULL,
  "library"    INT           DEFAULT NULL,
  "vendor"     INT           DEFAULT NULL,
  PRIMARY KEY ("lib_temp_quotation_trans_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "lib_vendor_m"
--

CREATE TABLE IF NOT EXISTS "lib_vendor_m" (
  "lib_vendor_m_id"         SERIAL,
  "type"       INT           NOT NULL DEFAULT 0,
  "Name"       VARCHAR(100)  NOT NULL DEFAULT '',
  "address"    TEXT,
  "telephone"  VARCHAR(50)   DEFAULT NULL,
  "email"      VARCHAR(50)   DEFAULT NULL,
  "url"        VARCHAR(50)   DEFAULT NULL,
  "remark"     TEXT,
  PRIMARY KEY ("lib_vendor_m_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "lib_vendor_type"
--

CREATE TABLE IF NOT EXISTS "lib_vendor_type" (
  "lib_vendor_type_id"    SERIAL,
  "type"  VARCHAR(50)  NOT NULL DEFAULT '',
  PRIMARY KEY ("lib_vendor_type_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "links"
--

CREATE TABLE IF NOT EXISTS "links" (
  "module"        VARCHAR(50)   DEFAULT NULL,
  "submodule"     VARCHAR(50)   DEFAULT NULL,
  "linkname"      VARCHAR(250)  DEFAULT NULL,
  "linkpath"      VARCHAR(250)  DEFAULT NULL,
  "links_id"            SERIAL,
  "parameter"     VARCHAR(250)  DEFAULT NULL,
  "Display_name"  VARCHAR(250)  NOT NULL,
  "help"          TEXT          NOT NULL,
  "imgpath"       VARCHAR(250)  NOT NULL,
  PRIMARY KEY ("links_id")
);

--
-- Dumping data for table "links"
--

INSERT INTO "links" ("module", "submodule", "linkname", "linkpath", "id", "parameter", "Display_name", "help", "imgpath") VALUES
('Accounts', 'Add Masters', 'Bank Details', '/lms/fee/bank_det.php', 1, '', 'Bank Details', '', ''),
('Accounts', 'Add Masters', 'Fee Head', '/lms/fee/feetypeadd.php', 2, '', 'Fee Head', '', ''),
('Accounts', 'Add Masters', 'General Fee Structure', '/lms/fee/feestut.php', 3, '', 'Fee Structure', '', ''),
('Accounts', 'Add Masters', 'Transport Fee Structure', '/lms/fee/tptfeestut.php', 4, '', 'Transport Fee', '', ''),
('Accounts', 'Add Masters', 'Gererate Fee Receipt', '/lms/fee/fee_rec.php', 5, '', 'Collect Fees', '', ''),
('Accounts', 'Add Masters', 'Manage Student Fee', '/lms/fee/addlfee.php', 6, '', 'Conversion Charges', '', ''),
('Accounts', 'Add Masters', 'Generate Addl Fee Receipt', '/lms/fee/addlfeerpt.php', 7, '', 'Reconciliation', '', ''),
('Accounts', 'Add Masters', 'Cancel Fee Receipt', '/lms/fee/SearchReceipt.php', 8, '', 'Cancel Fee Receipt', '', ''),
('Accounts', 'Add Masters', 'Refund Fee', '/lms/fee/select_stud_mod2.php', 9, '', 'Refund Fee', '', ''),
('Accounts', 'Add Masters', 'Scholarship Update', '/lms/fee/studsearch.php', 10, '', 'Upload', '', ''),
('Accounts', 'Reports', 'Demanded Fee Structure', '/lms/fee/dmdfee.php', 12, '', 'Academic Fee Invoice', '', ''),
('Accounts', 'Reports', 'Fee Collection Report', '/lms/fee/feecol.php', 13, '', 'Fee Collection Report', '', ''),
('Accounts', 'Reports', 'Student wise Fee Report', '/lms/fee/studfeerpt.php', 14, '', 'Student wise Fee Report', '', ''),
('Accounts', 'Reports', 'Fee Due Report', '/lms/fee/feeduerpt.php', 15, '', 'Fee Due Report', '', ''),
('Accounts', 'Reports', 'Excess Payment Report', '/lms/fee/feeexecrpt.php', 16, '', 'Excess Payment Report', '', ''),
('Accounts', 'Reports', 'Cancelled Fee Report', '/lms/fee/canfeerpt.php', 17, '', 'Cancelled Fee Report', '', ''),
('Accounts', 'Reports', 'Refunded Fee Report', '/lms/fee/reffeerpt.php', 18, '', 'Refunded Fee Report', '', ''),
('Accounts', 'Reports', 'Class wise Fee Report', '/lms/fee/semfee.php', 19, '', 'Class wise Fee Report', '', ''),
('Accounts', 'Reports', 'Payment Wise Fee Report', '/lms/fee/bankchfee.php', 20, '', 'Payment Wise Fee Report', '', ''),
('Accounts', 'Reports', 'Date Wise Fee Report', '/lms/fee/dtchrpt.php', 21, '', 'Date Wise Fee Report', '', ''),
('Accounts', 'Reports', 'Consolidated Fee Report', '/lms/fee/confee.php', 22, '', 'Consolidated Fee Report', '', ''),
('Accounts', 'Reports', 'Fee Wise Collection Report', '/lms/fee/feecolrpt.php', 23, '', 'Fee Wise Collection Report', '', ''),
('Accounts', 'Reports', 'Due Fees', '/lms/fee/studduefee.php', 24, '', 'Due Fees', '', ''),
('Accounts', 'Reports', 'Fee Transaction Report', '/lms/fee/studfeetrns.php', 25, '', 'Fee Transaction Report', '', ''),
('Accounts', 'Reports', 'Scholarship Report', '/lms/fee/schrpt.php', 26, '', 'Scholarship Report', '', ''),
('Accounts', 'Reports', 'Bank Report', '/lms/fee/bankrpt.php', 27, '', 'Bank Report', '', ''),
('Asset Management', 'Billing', 'Payment Status', '/lms/AssetMgt/paymentstatus.php', 28, '', 'Payment Status', '', ''),
('Asset Management', 'Breakages', 'Breakages Entry', '/lms/AssetMgt/BreakagesEntry.php', 29, '', 'Breakages Entry', '', ''),
('Asset Management', 'Deputation', 'Receive Assets For Deputation', '/lms/AssetMgt/DeputeAssets.php', 30, '', 'Receive Assets For Deputation', '', ''),
('Asset Management', 'Deputation', 'Send Assets on Deputation', '/lms/AssetMgt/DeputeAssetsToDestination.php', 31, '', 'Send Assets on Deputation', '', ''),
('Asset Management', 'Deputation', 'Receive Deputation Assets', '/lms/AssetMgt/ReceiveDeputeAssets.php', 32, '', 'Receive Deputation Assets', '', ''),
('Asset Management', 'Deputation', 'Issue Deputed Assets concerned Dept', '/lms/AssetMgt/IssueDeputedAssetsToDepts.php', 33, '', 'Issue Deputed Assets concerned Dept', '', ''),
('Asset Management', 'Major Purchases', 'Generate Requirement Indents', '/lms/AssetMgt/RequirementIndent.php', 35, '', 'Generate Requirement Indents', '', ''),
('Asset Management', 'Major Purchases', 'Add Quotation Details', '/lms/AssetMgt/Quotation.php', 36, '', 'Add Quotation Details', '', ''),
('Asset Management', 'Major Purchases', 'Process Quotations', '/lms/AssetMgt/ProcessQuotations.php', 37, '', 'Process Quotations', '', ''),
('Asset Management', 'Major Purchases', 'Generate Purchase Order', '/lms/AssetMgt/PurchaseOrder.php', 38, '', 'Generate Purchase Order', '', ''),
('Asset Management', 'Major Purchases', 'Modify Purchase Order', '/lms/AssetMgt/ModifyPO.php', 39, '', 'Modify Purchase Order', '', ''),
('Asset Management', 'Major Purchases', 'Receive Assets', '/lms/AssetMgt/ReceiveAssets.php', 40, '', 'Receive Assets', '', ''),
('Asset Management', 'Major Purchases', 'Issue Assets', '/lms/AssetMgt/IssueAsset.php', 41, '', 'Issue Assets', '', ''),
('Asset Management', 'Masters', 'Asset Group Master', '/lms/AssetMgt/AssetGroup.php', 42, '', 'Asset Group Master', '', ''),
('Asset Management', 'Masters', 'Asset Sub Group Master', '/lms/AssetMgt/AssetSubGroupMaster.php', 43, '', 'Asset Sub Group Master', '', ''),
('Asset Management', 'Masters', 'Asset Master', '/lms/AssetMgt/AssetMaster.php', 44, '', 'Asset Master', '', ''),
('Asset Management', 'Masters', 'Asset Status Master', '/lms/AssetMgt/AssetStatusMaster.php', 45, '', 'Asset Status Master', '', ''),
('Asset Management', 'Masters', 'Location Master', '/lms/AssetMgt/LocationMaster.php', 46, '', 'Location Master', '', ''),
('Asset Management', 'Masters', 'Vendor Master', '/lms/AssetMgt/VendorMaster.php', 47, '', 'Vendor Master', '', ''),
('Asset Management', 'Masters', 'Add Existing Assets', '/lms/AssetMgt/OldAssets.php', 48, '', 'Add Existing Assets', '', ''),
('Asset Management', 'Movement of Assets', 'Move Asset', '/lms/AssetMgt/MoveAsset.php', 49, '', 'Move Asset', '', ''),
('Asset Management', 'Registers', 'Requirement Indents', '/lms/AssetMgt/PendingRequirementIndent.php', 50, '', 'Requirement Indents', '', ''),
('Asset Management', 'Registers', 'Quotation Details', '/lms/AssetMgt/Quotation_det.php', 51, '', 'Quotation Details', '', ''),
('Asset Management', 'Registers', 'Generated Purchase Orders', '/lms/AssetMgt/PurchaseOrderLists.php', 52, '', 'Generated Purchase Orders', '', ''),
('Asset Management', 'Registers', 'Asset Movement Register', '/lms/AssetMgt/AssetMovementRegister.php', 53, '', 'Asset Movement Register', '', ''),
('Asset Management', 'Registers', 'Asset Master Register', '/lms/AssetMgt/AssetRegister.php', 54, '', 'Asset Master Register', '', ''),
('Asset Management', 'Registers', 'Departmentwise Asset Register', '/lms/AssetMgt/ViewStockRegister.php', 55, '', 'Departmentwise Asset Register', '', ''),
('Asset Management', 'Registers', 'Location Wise Asset Register', '/lms/AssetMgt/LocationwiseAssetReport.php', 56, '', 'Location Wise Asset Register', '', ''),
('Asset Management', 'Registers', 'Assetwise Report', '/lms/AssetMgt/AssetwiseReport.php', 57, '', 'Assetwise Report', '', ''),
('Asset Management', 'Registers', 'Assetwise Report 2', '/lms/AssetMgt/AssetwiseReport2.php', 58, '', 'Assetwise Report 2', '', ''),
('Asset Management', 'Registers', 'Breakages List', '/lms/AssetMgt/BreakagesList.php', 59, '', 'Breakages List', '', ''),
('Asset Management', 'Return of Assets', 'Receive Assets From Dept', '/lms/AssetMgt/ReturnAssets.php', 60, '', 'Receive Assets From Dept', '', ''),
('Asset Management', 'Return of Assets', 'Return Assets to Vendors', '/lms/AssetMgt/ReturnAssetsToVendors.php', 61, '', 'Return Assets to Vendors', '', ''),
('Asset Management', 'Return of Assets', 'Receive Returned Assets', '/lms/AssetMgt/ReceiveReturnedAssets.php', 62, '', 'Receive Returned Assets', '', ''),
('Asset Management', 'Return of Assets', 'Issue Returned Assets to Dept', '/lms/AssetMgt/IssueReturnedAssetsToDepts.php', 63, '', 'Issue Returned Assets to Dept', '', ''),
('Asset Management', 'Service of Assets', 'Receive Assets For Servicing / Repair', '/lms/AssetMgt/ServiceAssets.php', 64, '', 'Receive Assets For Servicing / Repair', '', ''),
('Asset Management', 'Service of Assets', 'Send Assets to Servicing /Repair', '/lms/AssetMgt/SendAssetsToService.php', 65, '', 'Send Assets to Servicing /Repair', '', ''),
('Asset Management', 'Service of Assets', 'Receive Serviced/Repaired Assets', '/lms/AssetMgt/ReceiveServicedAssets.php', 66, '', 'Receive Serviced/Repaired Assets', '', ''),
('Asset Management', 'Service of Assets', 'Issue Serviced/Repaired Assets To Dept', '/lms/AssetMgt/IssueServicedAssetsToDepts.php', 67, '', 'Issue Serviced/Repaired Assets To Dept', '', ''),
('Parents Web', 'Announcement', 'School Announcement', '/lms/Calendar/scannouncement.php', 68, '', 'School Announcement', '', ''),
('Parents Web', 'Announcement', 'Class Announcement', '/lms/Calendar/announcement.php', 69, '', 'Class Announcement', '', ''),
('Parents Web', 'Reports', 'School Announcement', '/lms/Calendar/scannouncementRep.php', 70, '', 'School Announcement', '', ''),
('Parents Web', 'Reports', 'Class Announcement', '/lms/Calendar/classannouncementRep.php', 71, '', 'Class Announcement', '', ''),
('Charges', 'Advances', 'Declare Advances', '/lms/Charges/declareAdvances.php', 72, '', 'Declare Advances', '', ''),
('Charges', 'Advances', 'Receive Advances', '/lms/Charges/receiveAdvances.php', 73, '', 'Receive Advances', '', ''),
('Charges', 'Charges', 'Create charges', '/lms/Charges/createCharges.php', 74, '', 'Create charges', '', ''),
('Charges', 'Charges', 'Create group', '/lms/Charges/createGroup.php', 75, '', 'Create group', '', ''),
('Charges', 'Charges', 'Apply Students to Group', '/lms/Charges/applyStudents.php', 76, '', 'Apply Students to Group', '', ''),
('Charges', 'Charges', 'Apply Charges', '/lms/Charges/applyCharges.php', 77, '', 'Apply Charges', '', ''),
('Charges', 'Reports', 'Charges', '/lms/Charges/chargesReport.php', 78, '', 'Charges', '', ''),
('Charges', 'Reports', 'Student ledger', '/lms/Charges/studentledger.php', 79, '', 'Student ledger', '', ''),
('Class', 'Class', 'Home Work', '/lms/TimeTable/homework.php', 80, '', 'Home Work', '', ''),
('Class', 'Class', 'Study Materials', '/lms/TimeTable/student_lesson_plan.php', 81, '', 'Worksheets', '', ''),
('Class', 'Class', 'Lesson Plan', '/lms/TimeTable/lesson_plan.php', 82, '', 'Lesson Plan', '', ''),
('Email & SMS alert', 'SMS', 'Send MSG', '/lms/mail_msg/FetchsubjectDet1.php', 84, '', 'Send MSG', '', ''),
('Email & SMS alert', 'SMS', 'Attendance', '/lms/mail_msg/attendance.php', 85, '', 'Attendance', '', ''),
('Health Management', 'Student Medical Details', 'Add Medical Report', '/lms/health_management/add_medical.php', 109, '', 'Add Medical Report', '', ''),
('Health Management', 'Student Medical Details', 'Edit Medical Report', '/lms/health_management/edit_medical_rep.php', 110, '', 'Edit Medical Report', '', ''),
('Health Management', 'Student Medical Details', 'View Medical Report', '/lms/health_management/viewadd_main.php', 111, '', 'View Medical Report', '', ''),
('Health Management', 'Infirmary Report', 'Add Sick Report', '/lms/health_management/sick_report.php', 112, '', 'Add Event Report', '', ''),
('Health Management', 'Infirmary Report', 'Edit Sick Report', '/lms/health_management/edit_report.php', 113, '', 'Edit Event Report', '', ''),
('Health Management', 'Infirmary Report', 'View Sick Report', '/lms/health_management/view_report.php', 114, '', 'View Event Report', '', ''),
('Health Management', 'Infirmary Report', 'Day Wise Sick Report', '/lms/health_management/daywise_report.php', 115, '', 'Day Wise Event Report', '', ''),
('Hostel Management', 'Consumable Entry', 'Item Master', '/lms/hostel/Consumables/ItemMaster.php', 116, '', 'Item Master', '', ''),
('Hostel Management', 'Consumable Entry', 'Suplier Master', '/lms/hostel/Consumables/SuplierMaster.php', 117, '', 'Suplier Master', '', ''),
('Hostel Management', 'Consumable Entry', 'Purchase Master', '/lms/hostel/Consumables/PurchaseMaster.php', 118, '', 'Purchase Master', '', ''),
('Hostel Management', 'Consumable Entry', 'Issue Master', '/lms/hostel/Consumables/IssueMaster.php', 119, '', 'Issue Master', '', ''),
('Hostel Management', 'Consumable Report', 'Stock Status Report', '/lms/hostel/Consumables/StockStatusReport.php', 120, '', 'Stock Status Report', '', ''),
('Hostel Management', 'Consumable Report', 'Perchase Register', '/lms/hostel/Consumables/purchase_report.php', 121, '', 'Perchase Register', '', ''),
('Hostel Management', 'Consumable Report', 'Vendorwise Report', '/lms/hostel/Consumables/vendorwise_report.php', 122, '', 'Vendorwise Report', '', ''),
('Hostel Management', 'Consumable Report', 'Departmentwise Issues Report', '/lms/hostel/Consumables/DeptwiseIssues.php', 123, '', 'Departmentwise Issues Report', '', ''),
('Hostel Management', 'Consumable Report', 'Bill Details', '/lms/hostel/Consumables/bill_details.php', 124, '', 'Bill Details', '', ''),
('Hostel Management', 'Fee Details', 'Add Fee Type', '/lms/hostel/fee/feetypeadd.php', 125, '', 'Add Fee Type', '', ''),
('Hostel Management', 'Fee Details', 'Describe Fee Structure', '/lms/hostel/fee/addfee.php', 126, '', 'Describe Fee Structure', '', ''),
('Hostel Management', 'Fee Details', 'Apply Fee by Hostel', '/lms/hostel/fee/SelectFee.php', 127, '', 'Apply Fee by Hostel', '', ''),
('Hostel Management', 'Fee Details', 'Apply Fee by Student', '/lms/hostel/fee/specstudent.php', 128, '?action=student_details.php', 'Apply Fee by Student', '', ''),
('Hostel Management', 'Fee Details', 'General Receipts', '/lms/hostel/fee/specstudent.php', 129, '?action=generalreceipts.php', 'General Receipts', '', ''),
('Hostel Management', 'Fee Details', 'Generate Mess Bill', '/lms/hostel/fee/messbill.php', 130, '', 'Generate Mess Bill', '', ''),
('Hostel Management', 'Hostel Details', 'Manage Hostel Details', '/lms/hostel/add_n_hostel.php', 132, '', 'Manage Hostel Details', '', ''),
('Hostel Management', 'Hostel Details', 'Manage Block Details', '/lms/hostel/hblockadd.php', 133, '', 'Manage Block Details', '', ''),
('Hostel Management', 'Hostel Details', 'Manage Room Details', '/lms/hostel/hroom_det.php', 134, '', 'Manage Room Details', '', ''),
('Hostel Management', 'Reports', 'Hostel Fee Due Report', '/lms/hostel/fee/fee_due_report.php', 135, '', 'Hostel Fee Due Report', '', ''),
('Hostel Management', 'Reports', 'Hostel Fee Paid Report', '/lms/hostel/fee/fee_paid_report.php', 136, '', 'Hostel Fee Paid Report', '', ''),
('Hostel Management', 'Reports', 'Fee Paid by Student', '/lms/hostel/fee/specstudent.php', 137, '?action=paid_by_student.php', 'Fee Paid by Student', '', ''),
('Hostel Management', 'Reports', 'Fee Due from Student', '/lms/hostel/fee/specstudent.php', 138, '?action=due_by_student.php', 'Fee Due from Student', '', ''),
('Hostel Management', 'Reports', 'Accomodation Details', '/lms/hostel/fee/hostelsearch.php', 139, '', 'Accomodation Details', '', ''),
('Hostel Management', 'Student Admission in Hostel', 'Apply Student To Hostel', '/lms/hostel/doSearch.php', 140, '?action=add_stud1.php', 'Apply Student To Hostel', '', ''),
('Hostel Management', 'Student Admission in Hostel', 'View Modify Student Details', '/lms/hostel/doSearch2.php', 141, '?action=view_hstud.php', 'View Modify Student Details', '', ''),
('Hostel Management', 'Student Admission in Hostel', 'Delete Student Details', '/lms/hostel/search_hostel2.php', 142, '?action=stud_modify.php', 'Delete Student Details', '', ''),
('Hostel Management', 'Student Admission in Hostel', 'View Student Archive Info', '/lms/hostel/searcharchive.php', 143, '?action=view_archive.php', 'View Student Archive Info', '', ''),
('Hostel Management', 'Student Admission in Hostel', 'Generate Hostel ID Card', '/lms/hostel/hostel_id.php', 144, '', 'Generate Hostel ID Card', '', ''),
('Library Management', 'Add Master', 'Manage Library', '/lms/library/view_lib_add_mod_del.php', 153, '', 'Manage Library', '', ''),
('Library Management', 'Add Master', 'Manage Registers', '/lms/library/addregister.php', 154, '', 'Manage Registers', '', ''),
('Library Management', 'Add Master', 'Manage Fine Details', '/lms/library/libfinedtls.php', 155, '', 'Manage Fine Details', '', ''),
('Library Management', 'Add Master', 'Manage Circulation Parameters', '/lms/library/mem_circulate.php', 156, '', 'Manage Circulation Parameters', '', ''),
('Parents Web', 'Reports', 'Lunch Calendar', '/lms/Calendar/Lunch_Calendar_rep.php', 441, 'NULL', 'Lunch Calendar', '', ''),
('Library Management', 'Manage Media', 'Add Media', '/lms/library/selectMediaType.php', 158, '?action=addMediaDet.php', 'Add Media', '', ''),
('Library Management', 'Manage Media', 'Modify Media Details', '/lms/library/selectMediaType1.php', 159, '?action=modifyMediaDet.php', 'Modify Media Details', '', ''),
('Library Management', 'Manage Media', 'Subscription Details', '/lms/library/subscribe.php', 160, '', 'Subscription Details', '', ''),
('Library Management', 'Manage Media', 'Magazine/Journal Details', '/lms/library/new_magazines.php', 161, '', 'Magazine/Journal Details', '', ''),
('Library Management', 'Manage Media', 'Add/Modify Question Paper', '/lms/library/add_question_paper.php', 162, '', 'Add/Modify Question Paper', '', ''),
('Library Management', 'Manage Media', 'Book Binding', '/lms/library/book_binding.php', 163, '', 'Book Binding', '', ''),
('Library Management', 'Manage Media', 'Return Book Binding', '/lms/library/return_book_binding.php', 164, '', 'Return Book Binding', '', ''),
('Library Management', 'Manage Media', 'Add/Modify News Paper', '/lms/library/add_newspaper.php', 165, '', 'Add/Modify News Paper', '', ''),
('Library Management', 'Manage Member', 'Add New Member', '/lms/library/selectMember1.php', 166, '', 'Add New Member', '', ''),
('Library Management', 'Manage Member', 'Cancel Member', '/lms/library/selectMemberg.php', 167, '?action=viewMember.php', 'Cancel Member', '', ''),
('Library Management', 'Manage Vendor', 'Add Modify Vendor Type', '/lms/library/view_lib_vendor_type.php', 168, '', 'Add Modify Vendor Type', '', ''),
('Library Management', 'Manage Vendor', 'Add Modify Vendor', '/lms/library/view_lib_vendor_m.php', 169, '', 'Add Modify Vendor', '', ''),
('Library Management', 'Media Transaction', 'Transact Media', '/lms/library/lib.php', 170, '', 'Transact Media', '', ''),
('Library Management', 'Media Transaction', 'Check Reservation', '/lms/library/selectMediaType.php', 171, '?action=viewReservationDet.php', 'Check Reservation', '', ''),
('Library Management', 'Media Transaction', 'Stock Verification', '/lms/library/stock_verification.php', 172, '', 'Stock Verification', '', ''),
('Library Management', 'Media Transaction', 'Issue/Return Of Magazine/Journals', '/lms/library/media2.php', 173, '', 'Issue/Return Of Magazine/Journals', '', ''),
('Library Management', 'OPAC', 'Basic Media Search', '/lms/library/opac.php', 174, '?action=basicsearch', 'Basic Media Search', '', ''),
('Library Management', 'OPAC', 'Advance OPAC Search', '/lms/library/advance_opac_search.php', 175, '', 'Advance OPAC Search', '', ''),
('Library Management', 'OPAC', 'Brief Media Report', '/lms/library/selectMediaType.php', 176, '?action=viewTotalMedia.php', 'Brief Media Report', '', ''),
('Library Management', 'OPAC', 'New Media Arrival Report', '/lms/library/selectnewarrival.php', 177, '', 'New Media Arrival Report', '', ''),
('Library Management', 'OPAC', 'Detailed Media Report', '/lms/library/opac_total_book.php', 178, '', 'Detailed Media Report', '', ''),
('Library Management', 'OPAC', 'Damaged Media Report', '/lms/library/dummyrpt.php', 179, '', 'Damaged Media Report', '', ''),
('Library Management', 'OPAC', 'Subject Wise Media Report', '/lms/library/subject_wise_report.php', 180, '', 'Subject Wise Media Report', '', ''),
('Library Management', 'OPAC', 'Reference Media Report', '/lms/library/reference_media_details.php', 181, '', 'Reference Media Report', '', ''),
('Library Management', 'OPAC', 'Media Usage Analysis', '/lms/library/media_usage_analysis.php', 182, '', 'Media Usage Analysis', '', ''),
('Library Management', 'OPAC', 'Statistics of News Paper/Magazines', '/lms/library/statistics_of_newspaper.php', 183, '', 'Statistics of News Paper/Magazines', '', ''),
('Library Management', 'OPAC', 'Brief Stock Verification Report', '/lms/library/stock_verification_rep.php', 184, '', 'Brief Stock Verification Report', '', ''),
('Library Management', 'OPAC', 'Missed Media Report', '/lms/library/missedrpt.php', 185, '', 'Missed Media Report', '', ''),
('Library Management', 'OPAC', 'Generate Barcode Sticker', '/lms/library/barcode_database_file.php', 186, '', 'Generate Barcode Sticker', '', ''),
('Library Management', 'OPAC', 'Verify Issue', '/lms/library/issver.php', 187, '', 'Verify Issue', '', ''),
('Library Management', 'OPAC', 'Physical Stock Verification', '/lms/library/phystkrep.php', 188, '', 'Physical Stock Verification', '', ''),
('Library Management', 'OPAC', 'Physical Stock Report', '/lms/library/phystkver.php', 189, '', 'Physical Stock Report', '', ''),
('Library Management', 'Purchase Details', 'Generate Purchase Order', '/lms/library/generatePurchaseOrder.php', 190, '', 'Generate Purchase Order', '', ''),
('Library Management', 'Purchase Details', 'Receive Purchase', '/lms/library/enterPurchaseDetail.php', 191, '', 'Receive Purchase', '', ''),
('Library Management', 'Quotation', 'Add Quotation', '/lms/library/addquotation.php', 192, '', 'Add Quotation', '', ''),
('Library Management', 'Quotation', 'Modify Quotation', '/lms/library/modquotation.php', 193, '', 'Modify Quotation', '', ''),
('Library Management', 'Reports', 'Day to Day Statistics', '/lms/library/day_to_day_statistics.php', 194, '', 'Day to Day Statistics', '', ''),
('Library Management', 'Reports', 'View Due Media', '/lms/library/view_outstanding.php', 195, '', 'View Due Media', '', ''),
('Library Management', 'Reports', 'Member Details', '/lms/library/view_deposit_holder_det.php', 196, '', 'Member Details', '', ''),
('Library Management', 'Reports', 'Member Transaction Report', '/lms/library/searchMemberdetail.php', 197, '?action=Searchmedia.php', 'Member Transaction Report', '', ''),
('Library Management', 'Reports', 'Book Binding Details', '/lms/library/book_binding_report.php', 198, '', 'Book Binding Details', '', ''),
('Library Management', 'Reports', 'Purchase Order Report', '/lms/library/selectMediaType.php', 199, '?action=viewPurchaseOrder.php', 'Purchase Order Report', '', ''),
('Library Management', 'Reports', 'Purchases Report', '/lms/library/selectMediaType.php', 200, '?action=viewPurchase.php', 'Purchases Report', '', ''),
('Library Management', 'Reports', 'Total Issued/Returned Media Report', '/lms/library/reference_media_reports.php', 201, '', 'Total Issued/Returned Media Report', '', ''),
('Library Management', 'Reports', 'Issued Magazine/Journal Report', '/lms/library/magzineRpt.php', 202, '', 'Issued Magazine/Journal Report', '', ''),
('Library Management', 'Reports', 'Returned Magazine/Journal Report', '/lms/library/magzine_return.php', 203, '', 'Returned Magazine/Journal Report', '', ''),
('Main', 'Main', 'Settings', '/lms/menu/mastermenu.php', 204, '', 'Setup', '', 'images/menu/Setup.png'),
('Main', 'Main', 'Staff Management', '/lms/menu/staffmenu.php', 205, '', 'Staff', '', 'images/menu/staff.png'),
('Main', 'Main', 'User Management', '/lms/menu/usermenu.php', 206, '', 'Security', '', 'images/menu/Security.png'),
('Main', 'Main', 'Student-Management', '/lms/menu/studentmenu.php', 207, '', 'Student', '', 'images/menu/student.png'),
('Main', 'Main', 'Accounts', '/lms/menu/feemenu.php', 208, '', 'Accounts', '', 'images/menu/finance.png'),
('Main', 'Main', 'Time Table', '/lms/menu/timetablemenu.php', 209, '', 'Timetable', '', 'images/menu/timetable.png'),
('Main', 'Main', 'Student Assessment', '/lms/menu/studattdmenu.php', 210, '', 'Gradebook', '', 'images/menu/grade.png'),
('Main', 'Main', 'Transportation', '/lms/menu/tptmenu.php', 211, '', 'Transport', '', 'images/menu/school_bus.png'),
('Main', 'Main', 'Email & SMS alert', '/lms/menu/enoticemenu.php', 212, '', 'Email', '', 'images/menu/smsemail.png'),
('Main', 'Main', 'Class', '/lms/menu/class.php', 214, '', 'Class', '', 'images/menu/classroom.png'),
('Main', 'Main', 'Inventory', '/lms/menu/inventory.php', 216, '', 'Inventory', '', 'images/menu/pos.png'),
('Main', 'Main', 'Charges', '/lms/menu/charges.php', 217, '', 'Charges', '', 'images/menu/charges.png'),
('Main', 'Main', 'Parents Web', '/lms/menu/calendar.php', 218, '', 'Calendar', '', 'images/menu/calendar.png'),
('Main', 'Main', 'Library Management', '/lms/menu/libmenu.php', 219, '', 'Library', '', 'images/menu/library.png'),
('Main', 'Main', 'Hostel Management', '/lms/menu/hostelmenu.php', 220, '', 'Hostel', '', 'images/menu/hostel.png'),
('Main', 'Main', 'Health Management', '/lms/menu/healthManagement.php', 221, '', 'Medical', '', 'images/menu/medical.png'),
('Main', 'Main', 'Pre-Admission', '/lms/menu/preadmission.php', 222, '', 'Admission', '', 'images/menu/admission.png'),
('Main', 'Main', 'Asset Management', '/lms/menu/assetmenu.php', 223, '', 'Asset', '', 'images/menu/asset.png'),
('Pre-Admission', 'Master Data', 'Online Application', '/lms/pre_admin/serachapp.php', 224, '', 'Online Application', '', ''),
('Pre-Admission', 'Master Data', 'Add student details', '/lms/pre_admin/add_stud_details.php', 225, '', 'Add student details', '', ''),
('Pre-Admission', 'Master Data', 'Modify student details', '/lms/pre_admin/edit_forms.php', 226, '', 'Modify student details', '', ''),
('Pre-Admission', 'Master Data', 'Admit Students', '/lms/pre_admin/applied_students.php', 227, '', 'Admission Students', '', ''),
('Pre-Admission', 'Master Data', 'Tracking Items', '/lms/pre_admin/interview.php', 228, '', 'Tracking Items', '', ''),
('Pre-Admission', 'Master Data', 'Admission Records', '/lms/pre_admin/admissionRecords.php', 229, '', 'Admission Records', '', ''),
('Student-Management', 'Reports', 'Student List', '/lms/student_det/list_of_student.php', 230, '', 'Student List', '', ''),
('Student-Management', 'Reports', 'View Details', '/lms/student_det/view_stud.php', 231, '', 'View Details', '', ''),
('Student-Management', 'Reports', 'View Student Details', '/lms/student_det/search_student_det.php', 232, '', 'View Student Details', '', ''),
('Student-Management', 'Reports', 'Student Contact Details', '/lms/student_det/search_student1.php', 233, '', 'Student Contact Details', '', ''),
('Student-Management', 'Reports', 'Print Address Label', '/lms/student_det/addresssearch.php', 234, '', 'Print Address Label', '', ''),
('Student-Management', 'Reports', 'Admission Type Wise Report', '/lms/student_det/admissiontypewise.php', 235, '', 'Admission Type Wise Report', '', ''),
('Student-Management', 'Reports', 'Nationality Wise Report', '/lms/student_det/CasteWise.php', 236, '', 'Nationality Wise Report', '', ''),
('Student-Management', 'Reports', 'Religion Wise Report', '/lms/student_det/ReligionWise.php', 237, '', 'Religion Wise Report', '', ''),
('Student-Management', 'Reports', 'Gender Wise Report', '/lms/student_det/sexwise.php', 238, '', 'Gender Wise Report', '', ''),
('Student-Management', 'Reports', 'Archived Student List', '/lms/student_det/search_archive_det.php', 239, '', 'Archived Student List', '', ''),
('Settings', 'Add Masters', 'School Details', '/lms/masters/schooladd.php', 240, '', 'School Information', '', ''),
('Settings', 'Add Masters', 'School Division', '/lms/masters/courseadd.php', 241, '', 'Division', '', ''),
('Settings', 'Add Masters', 'Class', '/lms/masters/yearadd.php', 242, '', 'Class', '', ''),
('Settings', 'Add Masters', 'Subject Type', '/lms/masters/subtypeadd.php', 243, '', 'Subject Type', '', ''),
('Settings', 'Add Masters', 'Subjects', '/lms/masters/subadd.php', 244, '', 'Subjects', '', ''),
('Settings', 'Add Masters', 'Add Document Details', '/lms/masters/ViewCertificate.php', 245, '', 'Add Document Details', '', ''),
('Settings', 'Add Masters', 'Admission Type', '/lms/masters/add_admission_type.php', 246, '', 'Admission Type', '', ''),
('Settings', 'Add Masters', 'Religion', '/lms/masters/add_religion.php', 247, '', 'Religion', '', ''),
('Settings', 'Add Masters', 'Category', '/lms/masters/add_category_type.php', 248, '', 'Category', '', ''),
('Settings', 'Add Masters', 'Nationality', '/lms/masters/national.php', 249, '', 'Nationality', '', ''),
('Settings', 'Add Masters', 'Country', '/lms/masters/addcountry.php', 250, '', 'Country', '', ''),
('Settings', 'Add Masters', 'Batch', '/lms/masters/batchmaster.php', 251, '', 'Batch', '', ''),
('Settings', 'Add Masters', 'Languages', '/lms/masters/language.php', 252, '', 'Languages', '', ''),
('Settings', 'Add Masters', 'Main Skill', '/lms/masters/master_skills.php', 253, '', 'Main Skill', '', ''),
('Settings', 'Add Masters', 'Main Approaches', '/lms/masters/master_approaches.php', 254, '', 'Main Approaches', '', ''),
('Settings', 'Masters', 'Section & Intake', '/lms/masters/sanction_intake.php', 256, '', 'Section & Intake', '', ''),
('Settings', 'Reports', 'Intake Report', '/lms/masters/inrep.php', 257, '', 'Intake Report', '', ''),
('Staff Management', 'Add Masters', 'Manage Department', '/lms/employee_details/departmentadd.php', 258, '', 'Add Department', '', ''),
('Staff Management', 'Add Masters', 'Manage Designation', '/lms/employee_details/staffdesadd.php', 259, '', 'Add Designation', '', ''),
('Staff Management', 'Add Masters', 'Manage Staff Type', '/lms/employee_details/stafftypeadd.php', 260, '', 'Add Staff Type', '', ''),
('Staff Management', 'Add Masters', 'Add Staff Details', '/lms/employee_details/update.php', 261, '', 'Add Staff Details', '', ''),
('Staff Management', 'Add Masters', 'Modify Staff Details', '/lms/employee_details/search.php', 262, '', 'Modify Staff Details', '', ''),
('Staff Management', 'Add Masters', 'Generate ID Card', '/lms/employee_details/staff_card.php', 263, '', 'Generate ID Card', '', ''),
('Staff Management', 'Add Masters', 'Manage Service Book', '/lms/employee_details/Promotion.php', 264, '', 'Manage Service Book', '', ''),
('Staff Management', 'Add Masters', 'Activate Archived Staff', '/lms/employee_details/act_staff.php', 265, '', 'Activate Archived Staff', '', ''),
('Parents Web', 'Calendar', 'Lunch Calendar', '/lms/Calendar/Lunch_Calendar.php', 440, 'NULL', 'Lunch Calendar', '', ''),
('Staff Management', 'Reports', 'View Details', '/lms/employee_details/viewstf.php', 267, '', 'View Details', '', ''),
('Staff Management', 'Reports', 'View Staff Details', '/lms/employee_details/view_employee_details.php', 268, '', 'View Staff Details', '', ''),
('Staff Management', 'Reports', 'Staff Service Record', '/lms/employee_details/archive_search.php', 269, '', 'Staff Service Record', '', ''),
('Staff Management', 'Reports', 'View Staff List', '/lms/employee_details/Staff_Type_Emplist.php', 270, '', 'View Staff List', '', ''),
('Staff Management', 'Reports', 'Teaching Staff Contact Details', '/lms/employee_details/teaching.php', 271, '', 'Teaching Staff Contact Details', '', ''),
('Staff Management', 'Reports', 'Non Teaching Staff Contact Details', '/lms/employee_details/nonteaching.php', 272, '', 'Non Teaching Staff Contact Details', '', ''),
('Staff Management', 'Reports', 'Employee List Designation Wise', '/lms/employee_details/Emp_List.php', 273, '', 'Employee List Designation Wise', '', ''),
('Staff Management', 'Reports', 'Employee List Department Wise', '/lms/employee_details/Emp_List_Department.php', 274, '', 'Employee List Department Wise', '', ''),
('Staff Management', 'Reports', 'Print Address Label', '/lms/employee_details/addresssearch.php', 275, '', 'Print Address Label', '', ''),
('Staff Management', 'Reports', 'Archived Employee Details', '/lms/employee_details/Retired_Emplist.php', 276, '', 'Archived Employee Details', '', ''),
('Class', 'Add Masters', 'Attendance', '/lms/studatt/ex_FetchsubjectDet1.php', 278, '', 'Attendance', '', ''),
('Student Assessment', 'Add Masters', 'Add Marks', '/lms/studatt/AddMarks.php', 280, '', 'Add Marks', '', ''),
('Student Assessment', 'Assessment', 'Year Setup', '/lms/Assessment/YearSetup.php', 288, '', 'Year Setup', '', ''),
('Student Assessment', 'Assessment', 'Subject Setup', '/lms/Assessment/SubjectSetup.php', 289, '', 'Subject Setup', '', ''),
('Student Assessment', 'Assessment', 'Add Marks (A)', '/lms/Assessment/AddMarks_a.php', 290, '', 'Add Marks (A)', '', ''),
('Student Assessment', 'Assessment', 'Add Marks (C)', '/lms/Assessment/AddMarks_c.php', 291, '', 'Add Marks (C)', '', ''),
('Student Assessment', 'Assessment', 'Add Marks (T)', '/lms/Assessment/AddMarks_t.php', 292, '', 'Add Marks (T)', '', ''),
('Student Assessment', 'Assessment', 'Freeze Grades', '/lms/Assessment/FreezeGrades.php', 293, '', 'Freeze Grades', '', ''),
('Student Assessment', 'Assessment Reports', 'Report Card', '/lms/Assessment/ReportCard.php', 294, '', 'Report Card', '', ''),
('Student Assessment', 'Assessment Reports', 'Consolidate Report', '/lms/Assessment/ConsolidateReport.php', 295, '', 'Consolidate Report', '', ''),
('Student Assessment', 'Assessment Reports', 'Consolidate Report (S)', '/lms/Assessment/ConsolidateReportS.php', 296, '', 'Consolidate Report (S)', '', ''),
('Class', 'Reports', 'Subject wise Attendance Report', '/lms/studatt/subject_attreport.php', 298, '', 'Subject wise Attendance Report', '', ''),
('Class', 'Reports', 'Consolidated Attendance Report', '/lms/studatt/View_Attendance.php', 299, '', 'Consolidated Attendance', '', ''),
('Class', 'Reports', 'Day wise Attendance Report', '/lms/studatt/daywise_attreport.php', 301, '', 'Day Attendance Report', '', ''),
('Class', 'Reports', 'Detailed Student Attendance', '/lms/studatt/det_att_rep_stud.php', 303, '', 'Detailed Student Attendance', '', ''),
('Class', 'Reports', 'Detailed Attendance Report', '/lms/studatt/det_stud.php', 304, '', 'Detailed Exam Report', '', ''),
('Student Assessment', 'Reports', 'Mark Analysis-Graph', '/lms/studatt/graph.php', 306, '', 'Mark Analysis-Graph', '', ''),
('Student Assessment', 'Reports', 'Consolidated', '/lms/studatt/Marks_Attendance2.php', 307, '', 'Consolidated', '', ''),
('Student Assessment', 'Reports', 'Mark Card', '/lms/studatt/det_stud.php', 308, '', 'Mark Card', '', ''),
('Parents Web', 'Reports', 'Class Calendar', '/lms/Calendar/class_call_rep.php', 439, 'NULL', 'Class Calendar', '', ''),
('Parents Web', 'Calendar', 'Class Calendar', '/lms/Calendar/class_call.php', 438, 'NULL', 'Class Calendar', '', ''),
('Student Assessment', 'Reports', 'PYP Reports', '/lms/pyp/reportspyp.php', 437, 'NULL', 'Students Review Sheet (PYP)', '', ''),
('Student Assessment', 'Add Masters', 'Skill Grade PYP', '/lms/pyp/gradepyp.php', 436, 'NULL', 'Students Review Sheet ( PYP)', '', ''),
('Student Assessment', 'Reports', 'Skill-set', '/lms/studatt/pskillset_report.php', 315, '', 'Skill-set', '', ''),
('Student Assessment', 'Add Masters', 'Add Criteria Grade', '/lms/pyp/crt_gradepyp.php', 435, 'NULL', 'Add Criteria Grade', '', ''),
('Student-Management', 'Add Masters', 'Student Details', '/lms/student_det/SearchStudent.php', 317, '', 'Student Details', '', ''),
('Student-Management', 'Add Masters', 'Modify Student Details', '/lms/student_det/select_stud_mod2.php', 318, '', 'Modify Student Details', '', ''),
('Student-Management', 'Add Masters', 'Activate Archived Student', '/lms/student_det/SearchArchive.php', 319, '', 'Activate Archived Student', '', ''),
('Student-Management', 'Add Masters', 'Promote / Archive Student', '/lms/student_det/promoteSelect.php', 320, '', 'Promote / Archive Student', '', ''),
('Student-Management', 'Add Masters', 'Apply Student to Section', '/lms/student_det/apply_student_to_section.php', 321, '', 'Apply Student to Section', '', ''),
('Student-Management', 'Add Masters', 'Change Students Section', '/lms/student_det/change_student_section.php', 322, '', 'Change Students Section', '', ''),
('Student-Management', 'Add Masters', 'Student ID Card', '/lms/student_det/id_card.php', 325, '', 'Student ID Card', '', ''),
('Student-Management', 'Add Masters', 'Apply Course', '/lms/student_det/studentcourse.php', 326, '', 'Apply Course', '', ''),
('Student Assessment', 'Add Masters', 'Add Skill PYP', '/lms/pyp/subskill_p.php', 434, 'NULL', 'Add Skill PYP', '', ''),
('Time Table', 'Add Masters', 'Manage Period Timings', '/lms/TimeTable/classtime.php', 328, '', 'Manage Period Timings', '', ''),
('Time Table', 'Add Masters', 'Manage Class Room', '/lms/TimeTable/addhall.php', 329, '', 'Manage Class Room', '', ''),
('Time Table', 'Add Masters', 'Manage Time Table', '/lms/TimeTable/applytimetable.php', 330, '', 'Manage Time Table', '', ''),
('Class', 'Add Masters', 'Master Lesson Plan', '/lms/TimeTable/master_lesson_plan.php', 331, '', 'Master Lesson Plan', '', ''),
('Class', 'Add Masters', 'Teacher lesson plan', '/lms/TimeTable/teacher_lesson_plan.php', 332, '', 'Teacher lesson plan', '', ''),
('Time Table', 'Reports', 'Class Room Time Table', '/lms/TimeTable/hallwise.php', 334, '', 'Class Room Time Table', '', ''),
('Time Table', 'Reports', 'Coursewise Time Table', '/lms/TimeTable/coursewise.php', 335, '', 'Coursewise Time Table', '', ''),
('Time Table', 'Reports', 'Staff Wise Time Table', '/lms/TimeTable/staffwise.php', 336, '', 'Staff Wise Time Table', '', ''),
('Time Table', 'Reports', 'Subject Wise Time Table', '/lms/TimeTable/subjectwise.php', 337, '', 'Subject Wise Time Table', '', ''),
('Time Table', 'Reports', 'Full View Time Table', '/lms/TimeTable/fullcoursewise.php', 338, '', 'Full View Time Table', '', ''),
('Time Table', 'Reports', 'View Time Table', '/lms/TimeTable/vwtt.php', 339, '', 'View Time Table', '', ''),
('Time Table', 'Reports', 'Staff Time Table', '/lms/int_exam/staff_det.php', 340, '', 'Staff Time Table', '', ''),
('Student Assessment', 'Add Masters', 'Add Centeral Ideas', '/lms/pyp/ideas_pyp.php', 433, 'NULL', 'Add Centeral Ideas', '', ''),
('Transportation', 'Master Data', 'Vehicle Details', '/lms/Transportation/add_vechile_master.php', 342, '', 'Vehicle Details', '', ''),
('Transportation', 'Master Data', 'Driver Details', '/lms/Transportation/add_driver_master.php', 343, '', 'Driver Details', '', ''),
('Transportation', 'Master Data', 'Route Details', '/lms/Transportation/add_route_master.php', 344, '', 'Route Details', '', ''),
('Transportation', 'Master Data', 'Pick Up Points', '/lms/Transportation/add_points_master.php', 345, '', 'Pick Up Points', '', ''),
('Transportation', 'Master Data', 'Trip Details', '/lms/Transportation/tripmaster.php', 346, '', 'Trip Details', '', ''),
('Transportation', 'Master Data', 'Apply Pick Up Points To Route', '/lms/Transportation/point_details.php', 347, '', 'Apply Pick Up Points To Route', '', ''),
('Transportation', 'Master Data', 'Describe Fee', '/lms/Transportation/desc_fee.php', 348, '', 'Describe Fee', '', ''),
('Transportation', 'Plan Transportation Details', 'Assign Vechile To Route', '/lms/Transportation/applyvechile.php', 349, '', 'Assign Vechile To Route', '', ''),
('Transportation', 'Plan Transportation Details', 'Apply Student/Staff To Route', '/lms/Transportation/passengermaster.php', 350, '', 'Apply Student/Staff To Route', '', ''),
('Transportation', 'Plan Transportation Details', 'Modify/Delete Student/Staff To Route', '/lms/Transportation/viewpasngr.php', 351, '', 'Modify/Delete Student/Staff To Route', '', ''),
('Transportation', 'Plan Transportation Details', 'Generate Bus Pass', '/lms/Transportation/bus_card.php', 352, '', 'Generate Bus Pass', '', ''),
('Transportation', 'Plan Transportation Details', 'Special Trip Entry', '/lms/Transportation/specialtripentry.php', 353, '', 'Special Trip Entry', '', ''),
('Transportation', 'Reports', 'View Vehicle Details', '/lms/Transportation/viewvechilemaster.php', 354, '', 'View Vehicle Details', '', ''),
('Transportation', 'Reports', 'View Driver Details', '/lms/Transportation/viewdrivermaster.php', 355, '', 'View Driver Details', '', ''),
('Transportation', 'Reports', 'Route Wise Members Report', '/lms/Transportation/report_passenger.php', 356, '', 'Route Wise Members Report', '', ''),
('Transportation', 'Reports', 'Track Bus', '/lms/Transportation/special_trip_report.php', 357, '', 'Track Bus', '', ''),
('Transportation', 'Special Reports', 'Route Report', '/lms/login/route_report.php', 358, '', 'Route Report', '', ''),
('Transportation', 'Special Reports', 'Special Trips', '/lms/login/spe_trip.php', 359, '', 'Special Trips', '', ''),
('User Management', 'Help', 'Help', '/lms/AdminTask/admintask.htm', 360, '', 'Help', '', ''),
('User Management', 'Reports', 'Log Report', '/lms/AdminTask/LogReportView.php', 361, '', 'Log Report', '', ''),
('User Management', 'Reports', 'Logcheck', '/lms/AdminTask/logcheck.php', 362, '', 'Logcheck', '', ''),
('User Management', 'Reports', 'User Login Report', '/lms/AdminTask/logweek.php', 363, '', 'User Login Report', '', ''),
('User Management', 'Reports', 'Staff Subject Rights', '/lms/AdminTask/staffrt_det.php', 364, '', 'Staff Subject Rights', '', ''),
('User Management', 'Reports', 'Staff Information', '/lms/AdminTask/username.php', 365, '', 'Staff Information', '', ''),
('User Management', 'Reports', 'Student Information', '/lms/AdminTask/search_student_detstud.php', 366, '', 'Student Information', '', ''),
('User Management', 'Users', 'Declare User Group', '/lms/AdminTask/AddUserGroup.php', 367, '', 'Declare User Group', '', ''),
('User Management', 'Users', 'Modify Group Rights', '/lms/AdminTask/ModUserGroup.php', 368, '', 'Modify Group Rights', '', ''),
('User Management', 'Users', 'Add User', '/lms/AdminTask/addusers.php', 369, '', 'Add User', '', ''),
('User Management', 'Users', 'Modify/Delete User', '/lms/AdminTask/mod_del_user.php', 370, '', 'Modify/Delete User', '', ''),
('User Management', 'Users', 'User Rights', '/lms/AdminTask/useraccess.php', 371, '', 'User Rights', '', ''),
('User Management', 'Users', 'Change Password', '/lms/AdminTask/changepass.php', 372, '', 'Change Password', '', ''),
('User Management', 'Users', 'Add Subject Rights', '/lms/AdminTask/AddRightsToStaff.php', 373, '', 'Add Subject Rights', '', ''),
('User Management', 'Users', 'Delete Subject Rights', '/lms/AdminTask/DeleteRightsofStaff.php', 374, '', 'Delete Subject Rights', '', ''),
('User Management', 'Users', 'Power Up User', '/lms/AdminTask/unlock.php', 375, '', 'Power Up User', '', ''),
('User Management', 'Users', 'Download Backup', '/lms/download_manager/index.php', 376, '', 'Download Backup', '', ''),
('User Management', 'Users', 'Student Rights', '/lms/AdminTask/Student_Rights.php', 377, '', 'Student Rights', '', ''),
('User Management', 'Users', 'Parent Rights', '/lms/AdminTask/parent_rights.php', 378, '', 'Parent Rights', '', ''),
('User Management', 'Users', 'Power Up Student/Parent', '/lms/AdminTask/powerstud.php', 379, '', 'Power Up Student/Parent', '', ''),
('User Management', 'Users', 'Manage Password(S)', '/lms/AdminTask/stud_chpswd.php', 380, '', 'Manage Password(S)', '', ''),
('User Management', 'Users', 'Manage Password(P)', '/lms/AdminTask/par_chpswd.php', 381, '', 'Manage Password(P)', '', ''),
('User Management', 'Users', 'Apply Class Teacher', '/lms/AdminTask/applyhod.php', 382, '', 'Apply Class Teacher', '', ''),
('Email & SMS alert', 'Email', 'Compose Email', '/lms/mail_msg/ckeditor/_samples/output_html.php', 383, '', 'Compose Email', '', ''),
('Email & SMS alert', 'Email', 'Send Email', '/lms/mail_msg/mail/sendmail.php', 384, 'NULL', 'Send Email', '', ''),
('Email & SMS alert', 'Email', 'Email Settings', '/lms/mail_msg/mail/mailsettings.php', 385, 'NULL', 'Email Settings', '', ''),
('Pre-Admission', 'Reports', 'Online Enquiry', '/lms/pre_admin/onlineforms_report.php', 386, 'NULL', 'Online Enquiry', '', ''),
('Pre-Admission', 'Reports', 'Walk In', '/lms/pre_admin/studapplied_report.php', 387, 'NULL', 'Walk In', '', ''),
('Pre-Admission', 'Reports', 'Admission Status', '/lms/pre_admin/interview_report.php', 388, 'NULL', 'Admission Status', '', ''),
('Pre-Admission', 'Reports', 'Enroled', '/lms/pre_admin/Enroled.php', 389, 'NULL', 'Enrolled', '', ''),
('Pre-Admission', 'Master Data', 'Enrol', '/lms/pre_admin/enroolstudent.php', 390, 'NULL', 'Enrollment', '', ''),
('Health Management', 'Student Medical Details', 'Medical details', '/lms/health_management/student_medical.php', 391, 'NULL', 'Medical details', '', ''),
('Health Management', 'Infirmary Report', 'Event Records', '/lms/health_management/day_studs_full.php', 392, 'NULL', 'Day Wise Doctor Report', '', ''),
('Parents Web', 'Calendar', 'School Calendar', '/lms/Calendar/scannouncement_call.php', 393, '', 'School Calendar', '', ''),
('Parents Web', 'Reports', 'School Calendar', '/lms/Calendar/scannouncementRep_call.php', 394, '', 'School Calendar', '', ''),
('Photo Gallery', 'Add', 'School', '/lms/PhotoGallery/schoolGallery.php', 395, 'NULL', 'School', '', ''),
('Photo Gallery', 'Add', 'Class', '/lms/PhotoGallery/classGallery.php', 396, 'NULL', 'Class', '', ''),
('Photo Gallery', 'View', 'School', '/lms/PhotoGallery/schoolGalleryView.php', 397, 'NULL', 'School', '', ''),
('Photo Gallery', 'View', 'Class', '/lms/PhotoGallery/classGalleryView.php', 398, 'NULL', 'Class', '', ''),
('Main', 'Main', 'Photo Gallery', '/lms/menu/Gallery.php', 399, 'NULL', 'Gallery', '', 'images/menu/Gallery.png'),
('Settings', 'Add Masters', 'Attendance', '/lms/masters/Attendance.php', 400, 'NULL', 'Attendance', '', ''),
('Main', 'Main', 'Online Assessment', '/lms/menu/Online.php', 403, 'NULL', 'Assessment', '', 'images/menu/onlineexam.png'),
('Online Assessment', 'Add Masters', 'Declare Exam', '/lms/OnlineAss/declare_exam.php', 404, 'NULL', 'Declare Exam', '', ''),
('Online Assessment', 'Add Masters', 'Add Questions', '/lms/OnlineAss/add_questions.php', 405, 'NULL', 'Add Questions', '', ''),
('Online Assessment', 'Add Masters', 'Online Assessment', '/lms/OnlineAss/online_assessment.php', 406, 'NULL', 'Online Assessment', '', ''),
('Online Assessment', 'Add Masters', 'Evaluate', '/lms/OnlineAss/Evaluate.php', 407, 'NULL', 'Evaluate', '', ''),
('Class', 'Reports', 'Master Lesson Plan', '/lms/TimeTable/master_lesson_plan_rep.php', 408, 'NULL', 'Master Lesson Plan', '', ''),
('Class', 'Reports', 'Teacher lesson plan', '/lms/TimeTable/Teacher_lesson_plan_rep.php', 409, 'NULL', 'Teacher lesson plan', '', ''),
('Settings', 'Add Masters', 'Subject Group', '/lms/masters/Subject_Group.php', 410, 'NULL', 'Subject Group', '', ''),
('Student Assessment', 'Add Masters', 'Declare Term', '/lms/skills/grade.php', 421, 'NULL', 'Declare Term', '', ''),
('Student Assessment', 'Add Masters', 'Grade Boundaries', '/lms/skills/subject_grade.php', 422, '', 'Grade Boundaries', '', ''),
('Student Assessment', 'Add Masters', 'Add Skill', '/lms/skills/master_skills.php', 423, '', 'Add Skill', '', ''),
('Student Assessment', 'Add Masters', 'Add Skill Grade', '/lms/skills/skillset.php', 424, 'NULL', 'Students Review Sheet (MSP)', '', ''),
('Student Assessment', 'Reports', 'MSP Report', '/lms/skills/skillset_report.php', 425, 'NULL', 'Students Review Sheet (MSP)', '', ''),
('Email & SMS alert', 'Email', 'Mail Group', '/lms/mail_msg/mail/mail_group.php', 426, 'NULL', 'Mail Group', '', ''),
('Email & SMS alert', 'Email', 'Add member to Group', '/lms/mail_msg/mail/mail_member.php', 427, 'NULL', 'Add member to Group', '', ''),
('Email & SMS alert', 'Email', 'Send Group Mail', '/lms/mail_msg/mail/sendmail_new.php', 428, 'NULL', 'Send Group Mail', '', ''),
('Student Assessment', 'Add Masters', 'Add Skill KG', '/lms/kg/subskill.php', 429, 'NULL', 'Add Skill KG', '', '');
INSERT INTO "links" ("module", "submodule", "linkname", "linkpath", "id", "parameter", "Display_name", "help", "imgpath") VALUES
('Student Assessment', 'Add Masters', 'Skill Grade KG', '/lms/kg/gradekg.php', 430, 'NULL', 'Students Review Sheet (KG)', '', ''),
('Student Assessment', 'Reports', 'KG Reports', '/lms/kg/reportskg.php', 431, 'NULL', 'Students Review Sheet (KG)', '', ''),
('Student-Management', 'Reports', 'Parent Username', '/lms/student_det/parentUsername.php', 432, 'NULL', 'Parent Username', '', ''),
('Student Assessment', 'Add Masters', 'Skill set', '/lms/studatt/skillset.php', 443, '', 'Skill set', '', ''),
('Student Assessment', 'Reports', 'Skill-set', '/lms/studatt/skillset_report.php', 444, '', 'Skill-set', '', ''),
('Pre-Admission', 'Enquires', 'Appointment', '/lms/pre_admin/appointment.php', 540, '', 'Appointment', '', ''),
('Pre-Admission', 'Enquires', 'Enquiry Status', '/lms/pre_admin/enquiry_view.php', 539, '', 'Enquiry', '', ''),
('Pre-Admission', 'Enquires', 'Enquiry', '/lms/pre_admin/enquiry.php', 538, '', 'Enquiry', '', ''),
('Settings', 'Add Masters', 'Interface Designer', '/lms/Tabbed_Interface/flexi_tab_config.php', 461, 'NULL', 'Interface Designer', '', ''),
('Settings', 'Add Masters', 'Tabbed Interface', '/lms/Tabbed_Interface/Student/first1.php', 462, 'NULL', 'Tabbed Interface', '', ''),
('Student Assessment', 'Add Masters', 'Declare Term', '/lms/skills/setupcat.php', 463, 'NULL', 'Grade Book', '', ''),
('Settings', 'Add Masters', 'Add Term', '/lms/masters/term.php', 464, 'NULL', 'Year Setup', '', ''),
('Accounts', 'Student', 'Modify Student Details', '/lms/student_det/select_stud_mod2.php', 455, 'NULL', 'Modify Student Details', '', ''),
('Accounts', 'Student', 'Discount Group', '/lms/pre_admin/discountgroup.php', 456, '', 'Discount Group', '', ''),
('Accounts', 'Student', 'Apply Discount', '/lms/pre_admin/applydiscount.php?std=std', 457, 'NULL', 'Apply Discount', '', ''),
('Accounts', 'Student', 'Modify Student Details', '/lms/student_det/select_stud_mod2.php', 465, 'NULL', 'Modify Student Details', '', ''),
('Accounts', 'Student', 'Discount Group', '/lms/pre_admin/discountgroup.php', 466, '', 'Discount Group', '', ''),
('Accounts', 'Student', 'Apply Discount', '/lms/pre_admin/applydiscount.php?std=std', 467, 'NULL', 'Apply Discount', '', ''),
('Accounts', 'Student', 'Apply Fee', '/lms/fee/applyfee.php?std=std', 468, 'NULL', 'Apply Fee', '', ''),
('Accounts', 'Student', 'Apply Slab', '/lms/fee/applyslab.php?std=std', 469, 'NULL', 'Apply Slab', '', ''),
('Settings', 'Add Masters', 'Flexi Tab Setup', '/lms/masters/flexi_setup.php', 470, 'NULL', 'Flexi Tab Setup', '', ''),
('Student Assessment', 'Add Masters', 'Report Card', '/lms/skills/report_card.php', 471, '', 'Report Card', '', ''),
('Settings', 'Add Masters', 'User Rights', '/lms/masters/useraccess.php', 472, 'NULL', 'User Rights', '', ''),
('Student-Management', 'Add Masters', 'Parent Teacher Conference', '/lms/student_det/ptConference.php', 473, 'NULL', 'Parent Teacher Conference', '', ''),
('Student-Management', 'Add Masters', 'Pastoral Care', '/lms/student_det/pastoral.php', 474, 'NULL', 'Pastoral Care', '', ''),
('Student-Management', 'Add Masters', 'Leaving Certificate', '/lms/student_det/LeavingCertificate.php', 475, 'NULL', 'Leaving Certificate', '', ''),
('Email & SMS alert', 'Reports', 'Mail Admin Log', '/lms/mail_msg/mailadminlog.php', 487, 'NULL', 'Mail Admin Log', '', ''),
('Staff Management', 'Add Masters', 'Leave Management', '/lms/employee_details/leave.php', 476, 'NULL', 'Leave Management', '', ''),
('Main', 'Main', 'Student-Information', '/lms/menu/Student-Information.php', 477, 'NULL', 'Student-Information', '', 'images/menu/student_info.png'),
('Student-Information', 'Add Masters', 'Student-Information', '/lms/student_det/SearchStudent.php', 478, 'NULL', 'Student-Information', '', ''),
('Settings', 'Add Masters', 'Class Setup', '/lms/class/class_create.php', 479, 'NULL', 'Class Setup', '', ''),
('Settings', 'Add Masters', 'Create Group', '/lms/group/group.php', 480, 'NULL', 'Create Group', '', ''),
('Main', 'Main', 'RFID', '/lms/menu/rfid.php', 481, 'NULL', 'RFID', '', 'images/menu/rfid.png'),
('RFID', 'Reports', 'Staff Time Sheet', '/lms/rfid/StaffDailyAttendance.php', 482, 'NULL', 'Staff Time Sheet', '', ''),
('Settings', 'Add Masters', 'Leave Setup', '/lms/employee_details/leavesetup.php', 483, 'NULL', 'Leave Setup', '', ''),
('Staff Management', 'Reports', 'Leave Reports', '/lms/employee_details/leavereports.php', 484, 'NULL', 'Leave Reports', '', ''),
('Class', 'Reports', 'Class Report', '/lms/class/class_report.php', 485, 'NULL', 'Class Report', '', ''),
('Time Table', 'Reports', 'Student Time Table', '/lms/TimeTable/studentwise.php', 486, '', 'Student Time Table', '', ''),
('Email & SMS alert', 'Reports', 'Mail Log', '/lms/mail_msg/maillog.php', 488, 'NULL', 'Mail Log', '', ''),
('Class', 'Add Masters', 'Weekly updates', '/lms/week_up/attach.php', 489, 'NULL', 'Weekly updates/Other Document', '', ''),
('Class', 'Add Masters', 'curriculum documents', '/lms/week_up/curri.php', 490, 'NULL', 'Curriculum/Other Document', '', ''),
('Class', 'Reports', 'Curriculum Documents', '/lms/week_up/stud_ups.php', 491, 'NULL', 'Curriculum Documents', '', ''),
('Class', 'Reports', 'Weekly Updates', '/lms/week_up/stud_ups.php', 492, 'NULL', 'Weekly Updates', '', ''),
('Health Management', 'Infirmary Report', 'Add Doctor Visit Report', '/lms/health_management/add_doc_visit.php', 493, '', 'Doctor Event Report', '', ''),
('Health Management', 'Student Medical Details', 'Add General Medical Report', '/lms/health_management/sick_reportnew.php', 494, 'NULL', 'Add General Medical Report', '', ''),
('Health Management', 'Student Medical Details', 'Edit General Medical Report', '/lms/health_management/edit_reportnew.php', 495, 'NULL', 'Edit General Medical Report', '', ''),
('Main', 'Main', 'Academic Report', '/lms/menu/accyrmenu.php', 496, 'NULL', 'Report card', '', 'images/menu/reportcard.png'),
('Academic Report', 'Add Masters', 'Year Setup', '/lms/grade/YearSetup.php', 497, 'NULL', 'Year Setup', '', ''),
('Academic Report', 'Add Masters', 'Declare Exam', '/lms/grade/SubjectSetup.php', 498, '', 'Declare Exam', '', ''),
('Academic Report', 'Add Masters', 'Add Skill', '/lms/grade/skillset.php', 499, 'NULL', 'Add Unit', '', ''),
('Student-Management', 'Reports', 'Student Elective Subjects Report', '/lms/student_det/search_student_ele.php', 531, 'NULL', 'Student Elective Subjects Report', '', ''),
('Academic Report', 'Add Masters', 'Add Comment', '/lms/grade/addcmnt.php', 500, 'NULL', 'Add Comment', '', ''),
('Academic Report', 'Reports', 'Report Card', '/lms/grade/rprts.php', 501, 'NULL', 'Primary Report Card', '', ''),
('Academic Report', 'Reports', 'Secondary Report Card', '/lms/grade/sec_reportCard.php', 502, 'NULL', 'Secondary Report Card', '', ''),
('Student-Management', 'Reports', 'Sibling Report', '/lms/student_det/siblings.php', 503, 'NULL', 'Sibling Report', '', ''),
('Staff Management', 'Reports', 'Staff Attendance', '/lms/rfid/StaffmonthlyAttendance.php', 519, 'NULL', 'Staff Attendance', '', ''),
('Staff Management', 'Reports', 'Staff Daily Attendance', '/lms/rfid/StaffDailyAttendance.php', 520, 'NULL', 'Staff Daily Attendance', '', ''),
('RFID', 'Reports', 'Staff Daily Attendance', '/lms/rfid/StaffDailyAttendance.php', 521, 'NULL', 'Staff Daily Attendance', '', ''),
('RFID', 'Reports', 'Staff Attendance', '/lms/rfid/StaffmonthlyAttendance.php', 522, 'NULL', 'Staff Attendance', '', ''),
('Student Assessment', 'Add Masters', 'Student Report Card', '/lms/skills/studentReportCard.php', 524, '', 'Student Report Card', '', ''),
('Class', 'Reports', 'Missed Class', '/lms/studatt/missedClass.php', 525, 'NULL', 'Missed Class', '', ''),
('Accounts', 'Miscellaneous', 'Fee Head', '/lms/eca/feetypeadd.php', 526, '', 'Fee Head', '', ''),
('Accounts', 'Miscellaneous', 'General Fee Structure', '/lms/eca/feestut.php', 527, '', 'Fee Structure', '', ''),
('Accounts', 'Reports', 'Demanded Fee Structure', '/lms/eca/dmdfee.php', 528, '', 'Demanded Fee Structure', '', ''),
('Accounts', 'Miscellaneous', 'Invoice', '/lms/eca/Invoice.php', 529, '', 'Invoice', '', ''),
('Academic Report', 'Add Masters', 'Add Skill Points', '/lms/grade/skillpoints.php', 530, 'NULL', 'Add Skill', '', ''),
('Student Assessment', 'Add Masters', 'Teacher Comments', '/lms/skills/teacherComments.php', 532, '', 'Teacher Comments', '', ''),
('Class', 'Reports', 'Subject Attendance', '/lms/studatt/subjectwiseattreportmain.php', 533, 'NULL', 'Subject Attendance', '', ''),
('Student Assessment', 'Add Masters', 'Report Comments', '/lms/skills/report_card1.php', 534, '', 'Report Comments', '', ''),
('Main', 'Main', 'Fee', '/lms/menu/fee.php', 535, 'NULL', 'Fee', '', ''),
('Fee', 'Fee', 'Fee', '/lms/fee/stundetfeereciptall.php', 536, 'NULL', 'Receipts', '', ''),
('Academic Report', 'Reports', 'Semester Report Card', '/lms/grade/Semesterrprts.php', 537, 'NULL', 'Primary Semester Report Card', '', ''),
('Pre-Admission', 'Enquires', 'Admission Pack', '/lms/pre_admin/admission_pack.php', 541, '', 'Admission Pack', '', ''),
('Class', 'Reports', 'Attendance Report - Year', '/lms/studatt/studentcourse.php', 542, 'NULL', 'Attendance Report - Year', '', ''),
('Student-Management', 'Add Masters', 'RFID', '/lms/student_det/studentcourserfid.php', 543, 'NULL', 'RFID', '', ''),
('Staff Management', 'Add Masters', 'RFID', '/lms/employee_details/staffrfidupdate.php', 544, 'NULL', 'RFID', '', ''),
('Parents Web', 'Appointment Scheduler', 'Schedule Setup', '/lms/Calendar/schedulerSetup.php', 545, 'NULL', 'Schedule Setup', '', ''),
('Parents Web', 'Appointment Scheduler', 'Schedule Meeting', '/lms/Calendar/appointmentScheduler.php', 546, 'NULL', 'Schedule Meeting', '', ''),
('Parents Web', 'Appointment Scheduler', 'Confirm Meeting', '/lms/Calendar/adminScheduler.php', 547, 'NULL', 'Confirm Meeting', '', ''),
('Class', 'Reports', 'Attendance Eligibility', '/lms/studatt/studnetmissdclassreport.php', 548, '', 'Attendance Tolerance', '', ''),
('Parents Web', 'Appointment Scheduler', 'Cancel Meeting', '/lms/Calendar/cancelScheduler.php', 549, '', 'Cancel Meeting', '', ''),
('Parents Web', 'Reports', 'Meeting Report', '/lms/Calendar/SchedulerReport.php', 550, '', 'Meeting Report', '', ''),
('Student-Management', 'Reports', 'DeRegistered Students', '/lms/student_det/search_deregistered_det.php', 551, '', 'De-Registered Students', '', ''),
('Student-Management', 'Reports', 'Re-Enrolled', '/lms/student_det/search_reenrolled_det.php', 552, '', 'Re-Enrolled Students', '', ''),
('Pre-Admission', 'Enquires', 'Enquiry Setup', '/lms/pre_admin/admission_master.php', 554, '', 'Enquiry Setup', '', ''),
('Fee', 'Fee', 'Invoice', '/lms/fee/stundetfeeinvoiceall.php', 555, 'NULL', 'Invoice', '', ''),
('Settings', 'Add Masters', 'Subject Description', '/lms/masters/subject_description.php', 556, '', 'Subject Description', '', ''),
('Class', 'Add Masters', 'Holiday', '/lms/studatt/att_holiday.php', 557, 'NULL', 'Holiday', '', ''),
('Parents Web', 'EC Activity', 'ECA Setup', '/lms/Calendar/ecaSetup.php', 558, 'NULL', 'ECA Setup', '', ''),
('Parents Web', 'EC Activity', 'EC Activity', '/lms/Calendar/ecaActivity.php', 559, 'NULL', 'EC Activity', '', ''),
('Parents Web', 'EC Activity', 'ECA Report', '/lms/Calendar/ecaReport.php', 560, 'NULL', 'ECA Report', '', ''),
('Parents Web', 'EC Activity', 'My Enrollment', '/lms/Calendar/ecaEnrollment.php', 561, 'NULL', 'My Enrollment', '', '');

-- --------------------------------------------------------

--
-- Table structure for table "links_p"
--

CREATE TABLE IF NOT EXISTS "links_p" (
  "module"        VARCHAR(50)   DEFAULT NULL,
  "submodule"     VARCHAR(50)   DEFAULT NULL,
  "linkname"      VARCHAR(250)  DEFAULT NULL,
  "linkpath"      VARCHAR(250)  DEFAULT NULL,
  "links_p_id"            SERIAL,
  "parameter"     VARCHAR(250)  DEFAULT NULL,
  "Display_name"  VARCHAR(250)  NOT NULL,
  "help"          TEXT          NOT NULL,
  PRIMARY KEY ("links_p_id")
);

--
-- Dumping data for table "links_p"
--

INSERT INTO "links_p" ("module", "submodule", "linkname", "linkpath", "id", "parameter", "Display_name", "help") VALUES
('Main', 'Main', 'User Management', '/lms/menu/usermenu.php', 206, '', '', ''),
('Main', 'Main', 'Student Management', '/lms/menu/studentmenu.php', 207, '', '', ''),
('Main', 'Main', 'Class', '/lms/menu/class.php', 214, '', '', ''),
('Main', 'Main', 'Parents Web', '/lms/menu/calendar.php', 218, '', '', ''),
('Main', 'Main', 'Health Management', '/lms/menu/healthManagement.php', 221, '', '', ''),
('Main', 'Main', 'Photo Gallery', '/lms/menu/Gallery.php', 399, '', '', ''),
('Main', 'Main', 'Online Assessment', '/lms/menu/Online.php', 403, '', '', ''),
('Health Management', 'Student Medical Details', 'Medical details', '/lms/health_management/student_medical.php', 391, '', '', ''),
('Health Management', 'Infirmary Report', 'Event Records', '/lms/health_management/day_studs_full.php', 392, '', '', ''),
('Parents Web', 'Reports', 'School Announcement', '/lms/Calendar/scannouncementRep.php', 70, '', '', ''),
('Parents Web', 'Reports', 'Class Announcement', '/lms/Calendar/classannouncementRep.php', 71, '', '', ''),
('Parents Web', 'Reports', 'School Calendar', '/lms/Calendar/scannouncementRep_call.php', 394, '', '', ''),
('Student-Management', 'Reports', 'View Details', '/lms/student_det/view_stud.php', 231, '', '', ''),
('Time Table', 'Reports', 'Class Room Time Table', '/lms/TimeTable/hallwise.php', 334, '', '', ''),
('Online Assessment', 'Add Masters', 'Online Assessment', '/lms/OnlineAss/online_assessment.php', 406, '', '', ''),
('Class', 'Class', 'Home Work', '/lms/TimeTable/homework.php', 80, '', '', ''),
('Class', 'Class', 'Lesson Plan', '/lms/TimeTable/lesson_plan.php', 82, '', '', ''),
('Photo Gallery', 'View', 'School', '/lms/PhotoGallery/schoolGalleryView.php', 397, '', '', ''),
('Photo Gallery', 'View', 'Class', '/lms/PhotoGallery/classGalleryView.php', 398, '', '', ''),
('Class', 'Reports', 'Curriculum Documents', '/lms/week_up/stud_ups.php', 491, NULL, 'Curriculum / Other Document', ''),
('Class', 'Reports', 'Weekly Updates', '/lms/week_up/stud_ups.php', 492, NULL, 'Weekly updates / Other Document ', ''),
('User Management', 'Users', 'Manage Password(P)', '/AdminTask/par_chpswd.php', 381, '', 'Manage Password(P)', ''),
('Main', 'Main', 'Fee', '/lms/menu/fee.php', 535, NULL, 'Fee', ''),
('Fee', 'Fee', 'Fee', '/lms/fee/stundetfeereciptall.php', 536, NULL, 'Fee', ''),
('Parents Web', 'Appointment Scheduler', 'Schedule Meeting', '/lms/Calendar/appointmentScheduler.php', 546, NULL, '', ''),
('Fee', 'Fee', 'Invoice', '/lms/fee/stundetfeeinvoiceall.php', 555, NULL, '', '');

-- --------------------------------------------------------

--
-- Table structure for table "location_master"
--

CREATE TABLE IF NOT EXISTS "location_master" (
  "location_master_id"        SERIAL,
  "location"  VARCHAR(50)  DEFAULT NULL,
  "dept_id"   INT          DEFAULT NULL,
  PRIMARY KEY ("location_master_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "log"
--

CREATE TABLE IF NOT EXISTS "log" (
  "log_id"          BIGSERIAL,
  "username"    TEXT,
  "address"     TEXT,
  "accessdate"  TIMESTAMP      DEFAULT NULL,
  "urladdress"  TEXT,
  "linkname"    TEXT,
  "module"      VARCHAR(250)  DEFAULT NULL,
  "trans_date"  DATE          DEFAULT NULL,
  PRIMARY KEY ("log_id")
);

--
-- Dumping data for table "log"
--

INSERT INTO "log" ("log_id", "username", "address", "accessdate", "urladdress", "linkname", "module", "trans_date") VALUES
(1, 'administrator', '127.0.0.1', '2026-04-02 07:07:51', '/lms/home.php', 'Home', NULL, '2026-04-02'),
(2, 'administrator', '127.0.0.1', '2026-04-02 07:07:57', '/lms/home.php', 'Home', NULL, '2026-04-02'),
(3, 'administrator', '127.0.0.1', '2026-04-02 07:08:03', '/lms/home.php', 'Home', NULL, '2026-04-02'),
(4, 'administrator', '127.0.0.1', '2026-04-02 07:08:11', '/lms/home.php', 'Home', NULL, '2026-04-02'),
(5, 'administrator', '127.0.0.1', '2026-04-02 07:18:26', '/lms/home.php', 'Home', NULL, '2026-04-02'),
(6, 'administrator', '127.0.0.1', '2026-04-02 07:18:28', '/lms/menu/studattdmenu.php', 'Student Assessment', NULL, '2026-04-02'),
(7, 'administrator', '127.0.0.1', '2026-04-02 07:18:29', '/lms/menu/studattdmenu.php', 'Student Assessment', NULL, '2026-04-02'),
(8, 'administrator', '127.0.0.1', '2026-04-02 07:18:30', '/lms/skills/setupcat.php', 'Declare Term', '463', '2026-04-02'),
(9, 'administrator', '127.0.0.1', '2026-04-02 07:20:11', '/lms/skills/setupcat.php', 'Declare Term', '463', '2026-04-02'),
(10, 'administrator', '127.0.0.1', '2026-04-02 09:45:59', '/lms/menu/studattdmenu.php', 'Student Assessment', NULL, '2026-04-02');

-- --------------------------------------------------------

--
-- Table structure for table "lunch_menu_master"
--

CREATE TABLE IF NOT EXISTS "lunch_menu_master" (
  "lunch_menu_master_id"              SERIAL,
  "day_det"         VARCHAR(11)   NOT NULL,
  "menu_date"       DATE          NOT NULL,
  "order_id"        INT           NOT NULL,
  "Breakfast_Menu"  VARCHAR(250)  NOT NULL,
  "Lunch_Menu"      VARCHAR(250)  NOT NULL,
  PRIMARY KEY ("lunch_menu_master_id")
);

--
-- Dumping data for table "lunch_menu_master"
--

INSERT INTO "lunch_menu_master" ("lunch_menu_master_id", "day_det", "menu_date", "order_id", "Breakfast_Menu", "Lunch_Menu") VALUES
(1, 'Monday', '2026-01-03', 1, 'Samosa, Jam bread, fruit', 'Mix Veg., Jeera Rice, Dal Tadaka, Sprout Salad'),
(2, 'Tuesday', '2026-01-04', 2, 'veg club sandwich, fruit', 'Boiled Veg, Schezwan Rice Soup, Palak Paratha'),
(3, 'Wednesday', '2026-01-05', 3, 'Muesli-milk, Bread Butter, fruit', 'School will be functioning up to 11.00am, so no lunch'),
(4, 'Thursday', '2026-01-06', 4, 'Bread Butter,  Sponge Dosa, Chutney, Sambar, fruit', 'Scrambled eggs bread, soup, Methi-corn Paratha'),
(5, 'Friday', '2026-01-07', 5, 'Bread Butter, Bread Jam, fruit', 'Pav Bhaji, Papad, Tossed Salad, Coconut rice& Sweet');

-- --------------------------------------------------------

--
-- Table structure for table "lunch_menu_master_temp"
--

CREATE TABLE IF NOT EXISTS "lunch_menu_master_temp" (
  "sr_number"       VARCHAR(10)   NOT NULL,
  "date_det"        VARCHAR(15)   NOT NULL,
  "day"             VARCHAR(10)   NOT NULL,
  "Breakfast_Menu"  VARCHAR(200)  NOT NULL,
  "Lunch_Menu"      VARCHAR(200)  NOT NULL,
  PRIMARY KEY ("sr_number")
);

--
-- Dumping data for table "lunch_menu_master_temp"
--

INSERT INTO "lunch_menu_master_temp" ("sr_number", "date_det", "day", "Breakfast_Menu", "Lunch_Menu") VALUES
('1', '2026-01-03', 'Monday', 'Samosa, Jam bread, fruit', 'Mix Veg., Jeera Rice, Dal Tadaka, Sprout Salad'),
('2', '2026-01-04', 'Tuesday', 'veg club sandwich, fruit', 'Boiled Veg, Schezwan Rice Soup, Palak Paratha'),
('3', '2026-01-05', 'Wednesday', 'Muesli-milk, Bread Butter, fruit', 'School will be functioning up to 11.00am, so no lunch'),
('4', '2026-01-06', 'Thursday', 'Bread Butter,  Sponge Dosa, Chutney, Sambar, fruit', 'Scrambled eggs bread, soup, Methi-corn Paratha'),
('5', '2026-01-07', 'Friday', 'Bread Butter, Bread Jam, fruit', 'Pav Bhaji, Papad, Tossed Salad, Coconut rice& Sweet'),
('6', '2026-01-10', 'Monday', 'Grilled Sandwich, Fruit', 'Pumpkin Puri with Coconut Chutney, veg hakka noodles, Cole Slaw'),
('7', '2026-01-11', 'Tuesday', 'Cheese toast, Jam bread, fruit', 'Jeera Rice, Rajama, Dal Fry, Baked Veg Roti, Russian Salad'),
('8', '2026-01-12', 'Wednesday', 'Bread-Butter, Aloo-mutter patty, fruit.', 'Green Pease Paneer, Panchranta Dal, Rice, Burnt Garlic Noodle, Mint Salad'),
('9', '2026-01-13', 'Thursday', 'Dosa, Chutney, sambar, Bread-butter, fruit', 'CholePuri, Rice, Pineapple Raita, Mexican Green Rice, Cabbage Salad'),
('10', '2026-01-14', 'Friday', 'Wada pav, Bread-Jam, fruit', 'Stuffed Capsicum, Roti, Veg Pulav, Dal Makhani, Schezwan Noodles, Pasta Salad'),
('11', '2026-01-17', 'Monday', 'Pizza, fruit', 'Roti, corn palak cream, Mint salad, Dal-Khichadi- Kadhi, plain rice'),
('12', '2026-01-18', 'Tuesday', 'Dosa sambar chutney, bread butter, fruit', 'Tomato Pasta, Garlic Bread, Soup, Paratha, Cole Slaw'),
('13', '2026-01-20', 'Thursday', 'Pohe, Khajurladdu, fruit', 'Methi Mutter Malai, Roti, Rice, Dal Tadaka, Papad, Cheese Sandwich'),
('14', '2026-01-21', 'Friday', 'Cornflakes Sweet cold milk, bread jam, fruit', 'Carrot Rice, Tomato Soup, Egg Omlet, Bread'),
('15', '2026-01-24', 'Monday', 'Wada Sambar, chutney, bread butter, fruit', 'Baked Veg, Paratha, Soup, Veg Noodles'),
('16', '2026-01-25', 'Tuesday', 'DaliyaUpama, Bread Butter, fruit', 'Veg Kofta, Roti, Rice, Dal Tadka, Raita, Hakka Noodles'),
('17', '2026-01-26', 'Wednesday', 'Cheese potato sandwich, Fruit', 'Paneer Makhanwala, Roti, Masur Dal, Rice, Sprout Salad'),
('18', '2026-01-27', 'Thursday', 'Garlic toast, Doughnut, Fruit', 'Mixed Pasta, Garlic Bread, Soup, Lemon Rice, Tossed Salad'),
('19', '2026-01-28', 'Friday', 'Idli Sambar, chutney, bread butter, fruit', 'Green Pease Pulav, Dal Tadaka Veg Noodle Soup, Cabbage Salad'),

-- --------------------------------------------------------

--
-- Table structure for table "mailinsert"
--

CREATE TABLE IF NOT EXISTS "mailinsert" (
  "mailinsert_id"     SERIAL,
  "user"   VARCHAR(80)  NOT NULL,
  "mail2"  VARCHAR(80)  NOT NULL,
  PRIMARY KEY ("mailinsert_id")
);

--
-- Dumping data for table "mailinsert"
--

INSERT INTO "mailinsert" ("mailinsert_id", "user", "mail2") VALUES
(1247, 'oisinfo', 'hiran_naresh@email.com'),
(1248, 'oisinfo', 'ajay@email.com'),
(1250, 'oisinfo', 'bijit.kundu@email.com'),
(1251, 'oisinfo', 'harshal@email.com'),
(1252, 'oisinfo', 'puneet.ibsa@email.com'),
(1253, 'oisinfo', 'banerjeen@email.com'),
(1254, 'oisinfo', 'abhinavjain@email.com'),
(1255, 'oisinfo', 'michael.bailey@email.com'),
(1256, 'oisinfo', 'rmgoenka@email.com'),
(1257, 'oisinfo', 'rajan_purnendu@email.com'),
(1258, 'oisinfo', 'aizawa.kenta@email.com');

-- --------------------------------------------------------

--
-- Table structure for table "mail_attachments"
--

CREATE TABLE IF NOT EXISTS "mail_attachments" (
  "mail_attachments_id"        SERIAL,
  "str_id"    INT           NOT NULL,
  "name"      VARCHAR(50)   NOT NULL,
  "link"      VARCHAR(200)  NOT NULL,
  "adate"     DATE          NOT NULL,
  "username"  VARCHAR(255)  NOT NULL,
  "status"    SMALLINT    NOT NULL,
  PRIMARY KEY ("mail_attachments_id")
);

--
-- Dumping data for table "mail_attachments"
--

INSERT INTO "mail_attachments" ("mail_attachments_id", "str_id", "name", "link", "adate", "username", "status") VALUES
(1, 0, 'test', 'attach/07-08-20261375884658test.xlsx', '2026-08-07', 'administrator', 0),
(2, 0, '', 'attach/07-08-20261375885933Impact of different ingredients.docx', '2026-08-07', 'administrator', 0),
(3, 0, 'file1', '', '2026-08-07', 'administrator', 0),
(4, 0, '', 'attach/07-08-20261375887458obilogonew.png', '2026-08-07', 'administrator', 0),
(5, 0, 'obilogonew', 'attach/07-08-20261375888110obilogonew.png', '2026-08-07', 'administrator', 0),
(6, 0, 'filename', 'attach/07-08-20261375888196obilogonew.png', '2026-08-07', 'administrator', 0),
(7, 0, 'Grade 8 Art Final ', 'attach/08-08-20261375919024Grade 8 Art Final .xlsx', '2026-08-08', 'oisinfo', 0),
(8, 0, 'Important Information About Counseling', 'attach/13-08-20261376368414Important Information About Counseling.pdf', '2026-08-13', 'oisinfo', 0),
(9, 0, 'Important Information About Counseling', 'attach/13-08-20261376372080Important Information About Counseling.pdf', '2026-08-13', 'eyinfo', 0),
(10, 0, '6 W UPD GRADE 3', 'attach/14-08-202613764485386 W UPD GRADE 3.docx', '2026-08-14', 'pascalf', 0);

-- --------------------------------------------------------

--
-- Table structure for table "mail_details"
--

CREATE TABLE IF NOT EXISTS "mail_details" (
  "mail_details_id"            SERIAL,
  "mail_subject"  VARCHAR(70)  NOT NULL,
  "mail_content"  MEDIUMTEXT   NOT NULL,
  "status"        SMALLINT   NOT NULL,
  "mail_date"     DATE         NOT NULL,
  "username"      VARCHAR(40)  NOT NULL,
  "count"         INT          NOT NULL,
  PRIMARY KEY ("mail_details_id")
);

--
-- Dumping data for table "mail_details"
--

INSERT INTO "mail_details" ("mail_details_id", "mail_subject", "mail_content", "status", "mail_date", "username", "count") VALUES
(1, 'HEALTH INfo', '', 1, '2026-05-28', 'administrator', 0),
(2, 'French 6 week update', '<p>Dear Parents,</p>\r\n<p>the year started with a lot of enthusiasm in the French class. It is good to be back and to see the children everyday. Do contact me at any time, I will be happy to answer your questions.</p>\r\n<p>For now, please find attached our plans for the first six weeks of instruction.</p>\r\n<p>Kind regards.</p>\r\n<p>Pascal Fuzier.</p>\r\n', 1, '2026-08-14', 'pascalf', 0),
(3, 'No school tomorrow & Thursday is library day. ', '<p>Dear parents of 1C,</p>\r\n<p>Please note that 1C class will be visiting the library every Thursday for book exchange. Students are encouraged to exchange books on any day they are done with the library books. Students are learning about &#39;good fit book&#39; and &#39;I PICK&#39; to<i><u> become independent in choosing the right books for them</u></i>. &#39;I PICK&#39; stands for<font color="#FF0000"> I</font> choose the book.<font color="#FF0000"> P</font>urpose; Why do I want to read this book? <font color="#FF0000">I</font>nterest: Does this book interest me? <font color="#FF0000">C</font>omprehension: Do I understand the text? <font color="#FF0000">K</font>now: I know most of the words. Please expect the children to bring the books that are not exactly at their reading level, but try to understand why they might have choosen the book. The discussion and encouragement of &#39;I PICK&#39; should continue at home as well. The modifiied reading will be provided by the school. Please read with your children and talk about reading everyday.</p>\r\n<p>As you know and received the note many times, there is no school tomorrow.</p>\r\n<p>Enjoy Raksha Badhan and thank you for your support,</p>\r\n<p>Vitna Bailey</p>\r\n', 1, '2026-08-19', 'vitnab', 0);

-- --------------------------------------------------------

--
-- Table structure for table "mail_group"
--

CREATE TABLE IF NOT EXISTS "mail_group" (
  "mail_group_id"           SERIAL,
  "group_name"   VARCHAR(100)  DEFAULT NULL,
  "description"  VARCHAR(255)  DEFAULT NULL,
  "status"       SMALLINT    DEFAULT 0,
  PRIMARY KEY ("mail_group_id")
);

--
-- Dumping data for table "mail_group"
--

INSERT INTO "mail_group" ("mail_group_id", "group_name", "description", "status") VALUES
(1, 'p', '', 1),
(2, 'ECA', 'Cultural', 1);

-- --------------------------------------------------------

--
-- Table structure for table "mail_logs"
--

CREATE TABLE IF NOT EXISTS "mail_logs" (
  "mail_logs_id"            SERIAL,
  "mail_sent_id"  INT           NOT NULL,
  "mail_details"      TEXT          NOT NULL,
  "response"      TEXT          NOT NULL,
  "status"        SMALLINT    NOT NULL,
  "mail_date"     DATE          NOT NULL,
  "mail_time"     TIME          NOT NULL,
  "user"          VARCHAR(250)  NOT NULL,
  "from_mail"     VARCHAR(250)  NOT NULL,
  "to_mail"       VARCHAR(250)  NOT NULL,
  "subject"       VARCHAR(250)  NOT NULL,
  "valid"         SMALLINT    NOT NULL DEFAULT 1,
  "viewed"        SMALLINT    NOT NULL DEFAULT 0,
  "mail_att"      TEXT          NOT NULL,
  PRIMARY KEY ("mail_logs_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "mail_logs_system"
--

CREATE TABLE IF NOT EXISTS "mail_logs_system" (
  "mail_logs_system_id"            SERIAL,
  "mail_sent_id"  INT           NOT NULL,
  "mail_details"      TEXT          NOT NULL,
  "response"      TEXT          NOT NULL,
  "status"        SMALLINT    NOT NULL,
  "mail_date"     DATE          NOT NULL,
  "mail_time"     TIME          NOT NULL,
  "user"          VARCHAR(250)  NOT NULL,
  "from_mail"     VARCHAR(250)  NOT NULL,
  "to_mail"       VARCHAR(250)  NOT NULL,
  "subject"       VARCHAR(250)  NOT NULL,
  "stud"          INT           NOT NULL,
  PRIMARY KEY ("mail_logs_system_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "mail_member"
--

CREATE TABLE IF NOT EXISTS "mail_member" (
  "mail_member_id"           SERIAL,
  "group_name"   VARCHAR(10)   DEFAULT NULL,
  "stud_id"      VARCHAR(100)  DEFAULT NULL,
  "member_type"  VARCHAR(10)   DEFAULT NULL,
  "status"       SMALLINT    DEFAULT NULL,
  PRIMARY KEY ("mail_member_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "mail_member_field"
--

CREATE TABLE IF NOT EXISTS "mail_member_field" (
  "mail_member_field_id"          SERIAL,
  "name"        VARCHAR(100)  DEFAULT NULL,
  "name_field"  VARCHAR(100)  DEFAULT NULL,
  "mail_field"  VARCHAR(100)  DEFAULT NULL,
  "phone"       VARCHAR(20)   DEFAULT NULL,
  "status"      SMALLINT    DEFAULT 0,
  "table_name"  VARCHAR(50)   NOT NULL,
  "where_id"    VARCHAR(50)   NOT NULL,
  PRIMARY KEY ("mail_member_field_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "mail_sent_count"
--

CREATE TABLE IF NOT EXISTS "mail_sent_count" (
  "mail_sent_count_id"            SERIAL,
  "username"      VARCHAR(30)  NOT NULL,
  "mail_details_id"   VARCHAR(70)  NOT NULL,
  "from_mail_id"  VARCHAR(70)  NOT NULL,
  "to_mail_id"    VARCHAR(70)  NOT NULL,
  "student_id"    INT          NOT NULL,
  "mail_date"     DATE         NOT NULL,
  "mail_time"     TIME         NOT NULL,
  "mail_count"    INT          NOT NULL,
  PRIMARY KEY ("mail_sent_count_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "mail_settings"
--

CREATE TABLE IF NOT EXISTS "mail_settings" (
  "mail_settings_id"            SERIAL,
  "user_id"       VARCHAR(80)  NOT NULL,
  "status"        SMALLINT   NOT NULL,
  "from_name"     VARCHAR(80)  NOT NULL,
  "from_address"  VARCHAR(80)  NOT NULL,
  "domain_name"   VARCHAR(80)  NOT NULL,
  "smtp_host"     VARCHAR(80)  NOT NULL,
  "smtp_port"     INT          NOT NULL,
  "username"      VARCHAR(80)  NOT NULL,
  "password"      VARCHAR(80)  NOT NULL,
  "signature"     TEXT         NOT NULL,
  "count"         INT          NOT NULL,
  PRIMARY KEY ("mail_settings_id")
);

--
-- Dumping data for table "mail_settings"
--

INSERT INTO "mail_settings" ("mail_settings_id", "user_id", "status", "from_name", "from_address", "domain_name", "smtp_host", "smtp_port", "username", "password", "signature", "count") VALUES
(1, 'administrator', 1, 'Soumendra Nath De', 'soumendranath.de@email.com', 'email.com', 'smtp.gmail.com', 465, 'soumendranath.de', 'xxxxxx', '', 0),
(2, 'faculty', 1, 'Roshan', 'sureshduggaladka@email.com', 'email.com', 'smtp.gmail.com', 465, 'sureshduggaladka', 'xxxxxx', 'Thanks and Kind Regards', 0),
(3, 'nehata', 1, 'MySchool', 'neha.thakar@email.com', 'email.com', 'smtp.gmail.com', 465, 'neha.thakar', 'xxxxxx', '', 0),
(4, 'dianar', 1, 'Diana Roy', 'diana.roy@email.com', 'email.com', 'smtp.gmail.com', 465, 'diana.roy', 'xxxxxx', 'Ms Diana Roy', 0),
(5, 'jaikalap', 1, 'Jaikala Prasad', 'LMS International School', 'gmail.com', 'smtp.gmail.com', 465, 'xxxxxx', 'xxxxxx', 'Regards,\r\nJaikala Prasad\r\nIGCSE and IBDP Physics Faculty\r\nGr-12A Homeroom Tr.\r\n', 0),
(6, 'oisinfo', 1, 'OIS INFO', 'oisinfo@email.com', 'email.com', 'smtp.gmail.com', 465, 'oisinfo', 'xxxxxx', '', 0),
(7, 'sudhar', 1, 'Sudha Rakesh ', 'sudha.rakesh@email.com', 'email.com', 'smtp.gmail.com', 465, 'sudha.rakesh', 'xxxxxx', '', 0),
(8, 'florinad', 1, 'Florina D''Souza ', 'florina.dsouza@email.com', 'email.com', 'smtp.gmail.com', 465, 'florina.dsouza', 'xxxxxx', '', 0),
(9, 'matthews', 1, 'Matthew Sipple', 'matthew.sipple@email.com', 'email.com', 'smtp.gmail.com', 465, 'matthew.sipple', 'xxxxxx', '', 0),
(10, 'eyinfo', 1, 'EY INFO', 'eyinfo@email.com', 'email.com', 'smtp.gmail.com', 465, 'eyinfo', 'xxxxxx', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table "major_master"
--

CREATE TABLE IF NOT EXISTS "major_master" (
  "major_master_id"          SERIAL,
  "section_id"  INT  DEFAULT NULL,
  "sem_id"      INT  DEFAULT NULL,
  "maj_id"      INT  DEFAULT NULL,
  PRIMARY KEY ("major_master_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "marks_1_1"
--

CREATE TABLE IF NOT EXISTS "marks_1_1" (
  "marks_1_1_id"       SERIAL,
  "studid"   INT  DEFAULT NULL,
  "secid"    INT  DEFAULT NULL,
  "bid"      INT  DEFAULT NULL,
  "subid"    INT  NOT NULL DEFAULT 0,
  "assmk1"   INT  DEFAULT NULL,
  "ba1"      INT  NOT NULL DEFAULT 0,
  "assmk2"   INT  DEFAULT NULL,
  "ba2"      INT  NOT NULL DEFAULT 0,
  "assmk3"   INT  DEFAULT NULL,
  "ba3"      INT  NOT NULL DEFAULT 0,
  "assmk4"   INT  DEFAULT NULL,
  "ba4"      INT  NOT NULL DEFAULT 0,
  "assmk5"   INT  DEFAULT NULL,
  "ba5"      INT  NOT NULL DEFAULT 0,
  "assmk6"   INT  DEFAULT NULL,
  "ba6"      INT  NOT NULL DEFAULT 0,
  "assmk7"   INT  DEFAULT NULL,
  "ba7"      INT  NOT NULL DEFAULT 0,
  "assmk8"   INT  DEFAULT NULL,
  "ba8"      INT  NOT NULL DEFAULT 0,
  "assmk9"   INT  DEFAULT NULL,
  "ba9"      INT  NOT NULL DEFAULT 0,
  "assmk10"  INT  DEFAULT NULL,
  "ba10"     INT  NOT NULL DEFAULT 0,
  "accyr"    INT  DEFAULT NULL,
  PRIMARY KEY ("marks_1_1_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "marks_2_2"
--

CREATE TABLE IF NOT EXISTS "marks_2_2" (
  "marks_2_2_id"       SERIAL,
  "studid"   INT  DEFAULT NULL,
  "secid"    INT  DEFAULT NULL,
  "bid"      INT  DEFAULT NULL,
  "subid"    INT  NOT NULL DEFAULT 0,
  "assmk1"   INT  DEFAULT NULL,
  "ba1"      INT  NOT NULL DEFAULT 0,
  "assmk2"   INT  DEFAULT NULL,
  "ba2"      INT  NOT NULL DEFAULT 0,
  "assmk3"   INT  DEFAULT NULL,
  "ba3"      INT  NOT NULL DEFAULT 0,
  "assmk4"   INT  DEFAULT NULL,
  "ba4"      INT  NOT NULL DEFAULT 0,
  "assmk5"   INT  DEFAULT NULL,
  "ba5"      INT  NOT NULL DEFAULT 0,
  "assmk6"   INT  DEFAULT NULL,
  "ba6"      INT  NOT NULL DEFAULT 0,
  "assmk7"   INT  DEFAULT NULL,
  "ba7"      INT  NOT NULL DEFAULT 0,
  "assmk8"   INT  DEFAULT NULL,
  "ba8"      INT  NOT NULL DEFAULT 0,
  "assmk9"   INT  DEFAULT NULL,
  "ba9"      INT  NOT NULL DEFAULT 0,
  "assmk10"  INT  DEFAULT NULL,
  "ba10"     INT  NOT NULL DEFAULT 0,
  "accyr"    INT  DEFAULT NULL,
  PRIMARY KEY ("marks_2_2_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "marks_2_3"
--

CREATE TABLE IF NOT EXISTS "marks_2_3" (
  "marks_2_3_id"       SERIAL,
  "studid"   INT  DEFAULT NULL,
  "secid"    INT  DEFAULT NULL,
  "bid"      INT  DEFAULT NULL,
  "subid"    INT  NOT NULL DEFAULT 0,
  "assmk1"   INT  DEFAULT NULL,
  "ba1"      INT  NOT NULL DEFAULT 0,
  "assmk2"   INT  DEFAULT NULL,
  "ba2"      INT  NOT NULL DEFAULT 0,
  "assmk3"   INT  DEFAULT NULL,
  "ba3"      INT  NOT NULL DEFAULT 0,
  "assmk4"   INT  DEFAULT NULL,
  "ba4"      INT  NOT NULL DEFAULT 0,
  "assmk5"   INT  DEFAULT NULL,
  "ba5"      INT  NOT NULL DEFAULT 0,
  "assmk6"   INT  DEFAULT NULL,
  "ba6"      INT  NOT NULL DEFAULT 0,
  "assmk7"   INT  DEFAULT NULL,
  "ba7"      INT  NOT NULL DEFAULT 0,
  "assmk8"   INT  DEFAULT NULL,
  "ba8"      INT  NOT NULL DEFAULT 0,
  "assmk9"   INT  DEFAULT NULL,
  "ba9"      INT  NOT NULL DEFAULT 0,
  "assmk10"  INT  DEFAULT NULL,
  "ba10"     INT  NOT NULL DEFAULT 0,
  "accyr"    INT  DEFAULT NULL,
  PRIMARY KEY ("marks_2_3_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "marks_2_4"
--

CREATE TABLE IF NOT EXISTS "marks_2_4" (
  "marks_2_4_id"       SERIAL,
  "studid"   INT  DEFAULT NULL,
  "secid"    INT  DEFAULT NULL,
  "bid"      INT  DEFAULT NULL,
  "subid"    INT  NOT NULL DEFAULT 0,
  "assmk1"   INT  DEFAULT NULL,
  "ba1"      INT  NOT NULL DEFAULT 0,
  "assmk2"   INT  DEFAULT NULL,
  "ba2"      INT  NOT NULL DEFAULT 0,
  "assmk3"   INT  DEFAULT NULL,
  "ba3"      INT  NOT NULL DEFAULT 0,
  "assmk4"   INT  DEFAULT NULL,
  "ba4"      INT  NOT NULL DEFAULT 0,
  "assmk5"   INT  DEFAULT NULL,
  "ba5"      INT  NOT NULL DEFAULT 0,
  "assmk6"   INT  DEFAULT NULL,
  "ba6"      INT  NOT NULL DEFAULT 0,
  "assmk7"   INT  DEFAULT NULL,
  "ba7"      INT  NOT NULL DEFAULT 0,
  "assmk8"   INT  DEFAULT NULL,
  "ba8"      INT  NOT NULL DEFAULT 0,
  "assmk9"   INT  DEFAULT NULL,
  "ba9"      INT  NOT NULL DEFAULT 0,
  "assmk10"  INT  DEFAULT NULL,
  "ba10"     INT  NOT NULL DEFAULT 0,
  "accyr"    INT  DEFAULT NULL,
  PRIMARY KEY ("marks_2_4_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "marks_2_5"
--

CREATE TABLE IF NOT EXISTS "marks_2_5" (
  "marks_2_5_id"       SERIAL,
  "studid"   INT  DEFAULT NULL,
  "secid"    INT  DEFAULT NULL,
  "bid"      INT  DEFAULT NULL,
  "subid"    INT  NOT NULL DEFAULT 0,
  "assmk1"   INT  DEFAULT NULL,
  "ba1"      INT  NOT NULL DEFAULT 0,
  "assmk2"   INT  DEFAULT NULL,
  "ba2"      INT  NOT NULL DEFAULT 0,
  "assmk3"   INT  DEFAULT NULL,
  "ba3"      INT  NOT NULL DEFAULT 0,
  "assmk4"   INT  DEFAULT NULL,
  "ba4"      INT  NOT NULL DEFAULT 0,
  "assmk5"   INT  DEFAULT NULL,
  "ba5"      INT  NOT NULL DEFAULT 0,
  "assmk6"   INT  DEFAULT NULL,
  "ba6"      INT  NOT NULL DEFAULT 0,
  "assmk7"   INT  DEFAULT NULL,
  "ba7"      INT  NOT NULL DEFAULT 0,
  "assmk8"   INT  DEFAULT NULL,
  "ba8"      INT  NOT NULL DEFAULT 0,
  "assmk9"   INT  DEFAULT NULL,
  "ba9"      INT  NOT NULL DEFAULT 0,
  "assmk10"  INT  DEFAULT NULL,
  "ba10"     INT  NOT NULL DEFAULT 0,
  "accyr"    INT  DEFAULT NULL,
  PRIMARY KEY ("marks_2_5_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "marks_2_6"
--

CREATE TABLE IF NOT EXISTS "marks_2_6" (
  "marks_2_6_id"       SERIAL,
  "studid"   INT  DEFAULT NULL,
  "secid"    INT  DEFAULT NULL,
  "bid"      INT  DEFAULT NULL,
  "subid"    INT  NOT NULL DEFAULT 0,
  "assmk1"   INT  DEFAULT NULL,
  "ba1"      INT  NOT NULL DEFAULT 0,
  "assmk2"   INT  DEFAULT NULL,
  "ba2"      INT  NOT NULL DEFAULT 0,
  "assmk3"   INT  DEFAULT NULL,
  "ba3"      INT  NOT NULL DEFAULT 0,
  "assmk4"   INT  DEFAULT NULL,
  "ba4"      INT  NOT NULL DEFAULT 0,
  "assmk5"   INT  DEFAULT NULL,
  "ba5"      INT  NOT NULL DEFAULT 0,
  "assmk6"   INT  DEFAULT NULL,
  "ba6"      INT  NOT NULL DEFAULT 0,
  "assmk7"   INT  DEFAULT NULL,
  "ba7"      INT  NOT NULL DEFAULT 0,
  "assmk8"   INT  DEFAULT NULL,
  "ba8"      INT  NOT NULL DEFAULT 0,
  "assmk9"   INT  DEFAULT NULL,
  "ba9"      INT  NOT NULL DEFAULT 0,
  "assmk10"  INT  DEFAULT NULL,
  "ba10"     INT  NOT NULL DEFAULT 0,
  "accyr"    INT  DEFAULT NULL,
  PRIMARY KEY ("marks_2_6_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "marks_2_7"
--

CREATE TABLE IF NOT EXISTS "marks_2_7" (
  "marks_2_7_id"       SERIAL,
  "studid"   INT  DEFAULT NULL,
  "secid"    INT  DEFAULT NULL,
  "bid"      INT  DEFAULT NULL,
  "subid"    INT  NOT NULL DEFAULT 0,
  "assmk1"   INT  DEFAULT NULL,
  "ba1"      INT  NOT NULL DEFAULT 0,
  "assmk2"   INT  DEFAULT NULL,
  "ba2"      INT  NOT NULL DEFAULT 0,
  "assmk3"   INT  DEFAULT NULL,
  "ba3"      INT  NOT NULL DEFAULT 0,
  "assmk4"   INT  DEFAULT NULL,
  "ba4"      INT  NOT NULL DEFAULT 0,
  "assmk5"   INT  DEFAULT NULL,
  "ba5"      INT  NOT NULL DEFAULT 0,
  "assmk6"   INT  DEFAULT NULL,
  "ba6"      INT  NOT NULL DEFAULT 0,
  "assmk7"   INT  DEFAULT NULL,
  "ba7"      INT  NOT NULL DEFAULT 0,
  "assmk8"   INT  DEFAULT NULL,
  "ba8"      INT  NOT NULL DEFAULT 0,
  "assmk9"   INT  DEFAULT NULL,
  "ba9"      INT  NOT NULL DEFAULT 0,
  "assmk10"  INT  DEFAULT NULL,
  "ba10"     INT  NOT NULL DEFAULT 0,
  "accyr"    INT  DEFAULT NULL,
  PRIMARY KEY ("marks_2_7_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "marks_2_8"
--

CREATE TABLE IF NOT EXISTS "marks_2_8" (
  "marks_2_8_id"       SERIAL,
  "studid"   INT  DEFAULT NULL,
  "secid"    INT  DEFAULT NULL,
  "bid"      INT  DEFAULT NULL,
  "subid"    INT  NOT NULL DEFAULT 0,
  "assmk1"   INT  DEFAULT NULL,
  "ba1"      INT  NOT NULL DEFAULT 0,
  "assmk2"   INT  DEFAULT NULL,
  "ba2"      INT  NOT NULL DEFAULT 0,
  "assmk3"   INT  DEFAULT NULL,
  "ba3"      INT  NOT NULL DEFAULT 0,
  "assmk4"   INT  DEFAULT NULL,
  "ba4"      INT  NOT NULL DEFAULT 0,
  "assmk5"   INT  DEFAULT NULL,
  "ba5"      INT  NOT NULL DEFAULT 0,
  "assmk6"   INT  DEFAULT NULL,
  "ba6"      INT  NOT NULL DEFAULT 0,
  "assmk7"   INT  DEFAULT NULL,
  "ba7"      INT  NOT NULL DEFAULT 0,
  "assmk8"   INT  DEFAULT NULL,
  "ba8"      INT  NOT NULL DEFAULT 0,
  "assmk9"   INT  DEFAULT NULL,
  "ba9"      INT  NOT NULL DEFAULT 0,
  "assmk10"  INT  DEFAULT NULL,
  "ba10"     INT  NOT NULL DEFAULT 0,
  "accyr"    INT  DEFAULT NULL,
  PRIMARY KEY ("marks_2_8_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "marks_2_9"
--

CREATE TABLE IF NOT EXISTS "marks_2_9" (
  "marks_2_9_id"       SERIAL,
  "studid"   INT  DEFAULT NULL,
  "secid"    INT  DEFAULT NULL,
  "bid"      INT  DEFAULT NULL,
  "subid"    INT  NOT NULL DEFAULT 0,
  "assmk1"   INT  DEFAULT NULL,
  "ba1"      INT  NOT NULL DEFAULT 0,
  "assmk2"   INT  DEFAULT NULL,
  "ba2"      INT  NOT NULL DEFAULT 0,
  "assmk3"   INT  DEFAULT NULL,
  "ba3"      INT  NOT NULL DEFAULT 0,
  "assmk4"   INT  DEFAULT NULL,
  "ba4"      INT  NOT NULL DEFAULT 0,
  "assmk5"   INT  DEFAULT NULL,
  "ba5"      INT  NOT NULL DEFAULT 0,
  "assmk6"   INT  DEFAULT NULL,
  "ba6"      INT  NOT NULL DEFAULT 0,
  "assmk7"   INT  DEFAULT NULL,
  "ba7"      INT  NOT NULL DEFAULT 0,
  "assmk8"   INT  DEFAULT NULL,
  "ba8"      INT  NOT NULL DEFAULT 0,
  "assmk9"   INT  DEFAULT NULL,
  "ba9"      INT  NOT NULL DEFAULT 0,
  "assmk10"  INT  DEFAULT NULL,
  "ba10"     INT  NOT NULL DEFAULT 0,
  "accyr"    INT  DEFAULT NULL,
  PRIMARY KEY ("marks_2_9_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "marks_3_10"
--

CREATE TABLE IF NOT EXISTS "marks_3_10" (
  "marks_3_10_id"       SERIAL,
  "studid"   INT  DEFAULT NULL,
  "secid"    INT  DEFAULT NULL,
  "bid"      INT  DEFAULT NULL,
  "subid"    INT  NOT NULL DEFAULT 0,
  "assmk1"   INT  DEFAULT NULL,
  "ba1"      INT  NOT NULL DEFAULT 0,
  "assmk2"   INT  DEFAULT NULL,
  "ba2"      INT  NOT NULL DEFAULT 0,
  "assmk3"   INT  DEFAULT NULL,
  "ba3"      INT  NOT NULL DEFAULT 0,
  "assmk4"   INT  DEFAULT NULL,
  "ba4"      INT  NOT NULL DEFAULT 0,
  "assmk5"   INT  DEFAULT NULL,
  "ba5"      INT  NOT NULL DEFAULT 0,
  "assmk6"   INT  DEFAULT NULL,
  "ba6"      INT  NOT NULL DEFAULT 0,
  "assmk7"   INT  DEFAULT NULL,
  "ba7"      INT  NOT NULL DEFAULT 0,
  "assmk8"   INT  DEFAULT NULL,
  "ba8"      INT  NOT NULL DEFAULT 0,
  "assmk9"   INT  DEFAULT NULL,
  "ba9"      INT  NOT NULL DEFAULT 0,
  "assmk10"  INT  DEFAULT NULL,
  "ba10"     INT  NOT NULL DEFAULT 0,
  "accyr"    INT  DEFAULT NULL,
  PRIMARY KEY ("marks_3_10_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "marks_3_11"
--

CREATE TABLE IF NOT EXISTS "marks_3_11" (
  "marks_3_11_id"       SERIAL,
  "studid"   INT  DEFAULT NULL,
  "secid"    INT  DEFAULT NULL,
  "bid"      INT  DEFAULT NULL,
  "subid"    INT  NOT NULL DEFAULT 0,
  "assmk1"   INT  DEFAULT NULL,
  "ba1"      INT  NOT NULL DEFAULT 0,
  "assmk2"   INT  DEFAULT NULL,
  "ba2"      INT  NOT NULL DEFAULT 0,
  "assmk3"   INT  DEFAULT NULL,
  "ba3"      INT  NOT NULL DEFAULT 0,
  "assmk4"   INT  DEFAULT NULL,
  "ba4"      INT  NOT NULL DEFAULT 0,
  "assmk5"   INT  DEFAULT NULL,
  "ba5"      INT  NOT NULL DEFAULT 0,
  "assmk6"   INT  DEFAULT NULL,
  "ba6"      INT  NOT NULL DEFAULT 0,
  "assmk7"   INT  DEFAULT NULL,
  "ba7"      INT  NOT NULL DEFAULT 0,
  "assmk8"   INT  DEFAULT NULL,
  "ba8"      INT  NOT NULL DEFAULT 0,
  "assmk9"   INT  DEFAULT NULL,
  "ba9"      INT  NOT NULL DEFAULT 0,
  "assmk10"  INT  DEFAULT NULL,
  "ba10"     INT  NOT NULL DEFAULT 0,
  "accyr"    INT  DEFAULT NULL,
  PRIMARY KEY ("marks_3_11_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "marks_3_12"
--

CREATE TABLE IF NOT EXISTS "marks_3_12" (
  "marks_3_12_id"       SERIAL,
  "studid"   INT  DEFAULT NULL,
  "secid"    INT  DEFAULT NULL,
  "bid"      INT  DEFAULT NULL,
  "subid"    INT  NOT NULL DEFAULT 0,
  "assmk1"   INT  DEFAULT NULL,
  "ba1"      INT  NOT NULL DEFAULT 0,
  "assmk2"   INT  DEFAULT NULL,
  "ba2"      INT  NOT NULL DEFAULT 0,
  "assmk3"   INT  DEFAULT NULL,
  "ba3"      INT  NOT NULL DEFAULT 0,
  "assmk4"   INT  DEFAULT NULL,
  "ba4"      INT  NOT NULL DEFAULT 0,
  "assmk5"   INT  DEFAULT NULL,
  "ba5"      INT  NOT NULL DEFAULT 0,
  "assmk6"   INT  DEFAULT NULL,
  "ba6"      INT  NOT NULL DEFAULT 0,
  "assmk7"   INT  DEFAULT NULL,
  "ba7"      INT  NOT NULL DEFAULT 0,
  "assmk8"   INT  DEFAULT NULL,
  "ba8"      INT  NOT NULL DEFAULT 0,
  "assmk9"   INT  DEFAULT NULL,
  "ba9"      INT  NOT NULL DEFAULT 0,
  "assmk10"  INT  DEFAULT NULL,
  "ba10"     INT  NOT NULL DEFAULT 0,
  "accyr"    INT  DEFAULT NULL,
  PRIMARY KEY ("marks_3_12_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "marks_4_13"
--

CREATE TABLE IF NOT EXISTS "marks_4_13" (
  "marks_4_13_id"       SERIAL,
  "studid"   INT  DEFAULT NULL,
  "secid"    INT  DEFAULT NULL,
  "bid"      INT  DEFAULT NULL,
  "subid"    INT  NOT NULL DEFAULT 0,
  "assmk1"   INT  DEFAULT NULL,
  "ba1"      INT  NOT NULL DEFAULT 0,
  "assmk2"   INT  DEFAULT NULL,
  "ba2"      INT  NOT NULL DEFAULT 0,
  "assmk3"   INT  DEFAULT NULL,
  "ba3"      INT  NOT NULL DEFAULT 0,
  "assmk4"   INT  DEFAULT NULL,
  "ba4"      INT  NOT NULL DEFAULT 0,
  "assmk5"   INT  DEFAULT NULL,
  "ba5"      INT  NOT NULL DEFAULT 0,
  "assmk6"   INT  DEFAULT NULL,
  "ba6"      INT  NOT NULL DEFAULT 0,
  "assmk7"   INT  DEFAULT NULL,
  "ba7"      INT  NOT NULL DEFAULT 0,
  "assmk8"   INT  DEFAULT NULL,
  "ba8"      INT  NOT NULL DEFAULT 0,
  "assmk9"   INT  DEFAULT NULL,
  "ba9"      INT  NOT NULL DEFAULT 0,
  "assmk10"  INT  DEFAULT NULL,
  "ba10"     INT  NOT NULL DEFAULT 0,
  "accyr"    INT  DEFAULT NULL,
  PRIMARY KEY ("marks_4_13_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "marks_4_14"
--

CREATE TABLE IF NOT EXISTS "marks_4_14" (
  "marks_4_14_id"       SERIAL,
  "studid"   INT  DEFAULT NULL,
  "secid"    INT  DEFAULT NULL,
  "bid"      INT  DEFAULT NULL,
  "subid"    INT  NOT NULL DEFAULT 0,
  "assmk1"   INT  DEFAULT NULL,
  "ba1"      INT  NOT NULL DEFAULT 0,
  "assmk2"   INT  DEFAULT NULL,
  "ba2"      INT  NOT NULL DEFAULT 0,
  "assmk3"   INT  DEFAULT NULL,
  "ba3"      INT  NOT NULL DEFAULT 0,
  "assmk4"   INT  DEFAULT NULL,
  "ba4"      INT  NOT NULL DEFAULT 0,
  "assmk5"   INT  DEFAULT NULL,
  "ba5"      INT  NOT NULL DEFAULT 0,
  "assmk6"   INT  DEFAULT NULL,
  "ba6"      INT  NOT NULL DEFAULT 0,
  "assmk7"   INT  DEFAULT NULL,
  "ba7"      INT  NOT NULL DEFAULT 0,
  "assmk8"   INT  DEFAULT NULL,
  "ba8"      INT  NOT NULL DEFAULT 0,
  "assmk9"   INT  DEFAULT NULL,
  "ba9"      INT  NOT NULL DEFAULT 0,
  "assmk10"  INT  DEFAULT NULL,
  "ba10"     INT  NOT NULL DEFAULT 0,
  "accyr"    INT  DEFAULT NULL,
  PRIMARY KEY ("marks_4_14_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "marks_4_15"
--

CREATE TABLE IF NOT EXISTS "marks_4_15" (
  "marks_4_15_id"       SERIAL,
  "studid"   INT  DEFAULT NULL,
  "secid"    INT  DEFAULT NULL,
  "bid"      INT  DEFAULT NULL,
  "subid"    INT  NOT NULL DEFAULT 0,
  "assmk1"   INT  DEFAULT NULL,
  "ba1"      INT  NOT NULL DEFAULT 0,
  "assmk2"   INT  DEFAULT NULL,
  "ba2"      INT  NOT NULL DEFAULT 0,
  "assmk3"   INT  DEFAULT NULL,
  "ba3"      INT  NOT NULL DEFAULT 0,
  "assmk4"   INT  DEFAULT NULL,
  "ba4"      INT  NOT NULL DEFAULT 0,
  "assmk5"   INT  DEFAULT NULL,
  "ba5"      INT  NOT NULL DEFAULT 0,
  "assmk6"   INT  DEFAULT NULL,
  "ba6"      INT  NOT NULL DEFAULT 0,
  "assmk7"   INT  DEFAULT NULL,
  "ba7"      INT  NOT NULL DEFAULT 0,
  "assmk8"   INT  DEFAULT NULL,
  "ba8"      INT  NOT NULL DEFAULT 0,
  "assmk9"   INT  DEFAULT NULL,
  "ba9"      INT  NOT NULL DEFAULT 0,
  "assmk10"  INT  DEFAULT NULL,
  "ba10"     INT  NOT NULL DEFAULT 0,
  "accyr"    INT  DEFAULT NULL,
  PRIMARY KEY ("marks_4_15_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "marks_4_16"
--

CREATE TABLE IF NOT EXISTS "marks_4_16" (
  "marks_4_16_id"       SERIAL,
  "studid"   INT  DEFAULT NULL,
  "secid"    INT  DEFAULT NULL,
  "bid"      INT  DEFAULT NULL,
  "subid"    INT  NOT NULL DEFAULT 0,
  "assmk1"   INT  DEFAULT NULL,
  "ba1"      INT  NOT NULL DEFAULT 0,
  "assmk2"   INT  DEFAULT NULL,
  "ba2"      INT  NOT NULL DEFAULT 0,
  "assmk3"   INT  DEFAULT NULL,
  "ba3"      INT  NOT NULL DEFAULT 0,
  "assmk4"   INT  DEFAULT NULL,
  "ba4"      INT  NOT NULL DEFAULT 0,
  "assmk5"   INT  DEFAULT NULL,
  "ba5"      INT  NOT NULL DEFAULT 0,
  "assmk6"   INT  DEFAULT NULL,
  "ba6"      INT  NOT NULL DEFAULT 0,
  "assmk7"   INT  DEFAULT NULL,
  "ba7"      INT  NOT NULL DEFAULT 0,
  "assmk8"   INT  DEFAULT NULL,
  "ba8"      INT  NOT NULL DEFAULT 0,
  "assmk9"   INT  DEFAULT NULL,
  "ba9"      INT  NOT NULL DEFAULT 0,
  "assmk10"  INT  DEFAULT NULL,
  "ba10"     INT  NOT NULL DEFAULT 0,
  "accyr"    INT  DEFAULT NULL,
  PRIMARY KEY ("marks_4_16_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "marks_2026_5"
--

CREATE TABLE IF NOT EXISTS "marks_2026_5" (
  "marks_2026_5_id"             SERIAL,
  "class_section"  INT           DEFAULT NULL,
  "student_id"     INT           DEFAULT NULL,
  "subject_id"     INT           DEFAULT NULL,
  "status"         VARCHAR(4)    DEFAULT NULL,
  "sem_id"         INT           DEFAULT NULL,
  "int_id"         INT           DEFAULT NULL,
  "tst_id"         INT           DEFAULT NULL,
  "mark"           REAL         DEFAULT NULL,
  "grade"          VARCHAR(4)    DEFAULT NULL,
  "remarks"        TEXT          NOT NULL,
  "grade_rem"      VARCHAR(250)  NOT NULL,
  PRIMARY KEY ("marks_2026_5_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "marks_2026_9"
--

CREATE TABLE IF NOT EXISTS "marks_2026_9" (
  "marks_2026_9_id"             SERIAL,
  "class_section"  INT           DEFAULT NULL,
  "student_id"     INT           DEFAULT NULL,
  "subject_id"     INT           DEFAULT NULL,
  "status"         VARCHAR(4)    DEFAULT NULL,
  "sem_id"         INT           DEFAULT NULL,
  "int_id"         INT           DEFAULT NULL,
  "tst_id"         INT           DEFAULT NULL,
  "mark"           REAL         DEFAULT NULL,
  "grade"          VARCHAR(4)    DEFAULT NULL,
  "remarks"        TEXT          NOT NULL,
  "grade_rem"      VARCHAR(250)  NOT NULL,
  PRIMARY KEY ("marks_2026_9_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "master_approaches"
--

CREATE TABLE IF NOT EXISTS "master_approaches" (
  "master_approaches_id"     SERIAL,
  "divi"   INT           NOT NULL,
  "class"  INT           NOT NULL,
  "sub"    INT           NOT NULL,
  "skill"  VARCHAR(250)  NOT NULL,
  "posi"   INT           NOT NULL,
  PRIMARY KEY ("master_approaches_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "master_lesson_plan"
--

CREATE TABLE IF NOT EXISTS "master_lesson_plan" (
  "master_lesson_plan_id"           SERIAL,
  "divi"         INT           NOT NULL,
  "class"        INT           NOT NULL,
  "subj"         INT           NOT NULL,
  "chapter"      VARCHAR(250)  NOT NULL,
  "topic"        VARCHAR(40)   NOT NULL,
  "description"  TEXT          NOT NULL,
  "home_work"    TEXT          NOT NULL,
  "notes"        TEXT          NOT NULL,
  "details"      TEXT          NOT NULL,
  "reso"         VARCHAR(250)  NOT NULL,
  "status"       SMALLINT    NOT NULL DEFAULT 1,
  PRIMARY KEY ("master_lesson_plan_id")
);

--
-- Dumping data for table "master_lesson_plan"
--

INSERT INTO "master_lesson_plan" ("master_lesson_plan_id", "divi", "class", "subj", "chapter", "topic", "description", "home_work", "notes", "details", "reso", "status") VALUES
(1, 0, 5, 5, '1', 'Introduction ', 'Students were introduced to the concept of John Von Neuman\\''s architecture', 'Lab exercises', 'Practicals in the lab', 'Good', '', 1),
(2, 0, 5, 5, '1', 'Types of I/O devices', 'Students were made familiar with the some of the input-output devices.', 'Lab exercises', 'Worksheet given - Identify the device and specify whether input or output.', 'Good', '', 1),
(3, 0, 5, 5, '1', '5 BaSIC OPERATIONS', 'Students were made familiar with the primary \r\nand Secondary storage and its types.', 'A test on the next day', 'Worksheet as homework', 'Students worked in pairs to\r\nprepare a PPT on any one \r\nInput/Output/storage device.\r\n\r\nWorksheet given to state the \r\ndifferent types of I/O devices.', '', 1),
(4, 0, 5, 5, '1', 'QUIZ ', 'Quiz was conducted to recapitulate work done. Worksheet was completed to prepare the students for the Assessment. ', '---', 'Prepare for the S.A.', 'Good', '', 1),
(5, 0, 5, 5, '2', 'INTRODUCTION ', 'Students will be introduced to the term multimedia. The difference between uni media \r\nand multimedia.', 'Show pictures', 'Examples', 'Good', '', 1),
(6, 0, 5, 5, '2', 'Different kinds of multimedia', 'Students will be familiarized with the different types of media', 'Discussion about example', 'Write a note on multimedia', '', '', 1),
(7, 0, 5, 5, '2', 'Applications of multimedia', 'Students will be made to research about\r\nthe different applications of multimedia. ', 'Students will be made to research about\r\nthe different applications of multimedia. ', 'Homework', 'Good', '', 1),
(8, 0, 5, 6, '3', 'Introduction', 'List of materials needed', 'Check designs', 'Check designs', 'Good', '', 1),
(9, 0, 5, 6, '3', 'Types of masks', 'Different designs', 'Different disigns', 'Different disigns', 'Good', '', 1),
(10, 0, 5, 6, '4', 'Introduction', 'Materials needed', 'Check various designs ', 'Check various designs ', 'Good', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table "master_skills"
--

CREATE TABLE IF NOT EXISTS "master_skills" (
  "master_skills_id"      SERIAL,
  "divi"    INT           NOT NULL,
  "class"   INT           NOT NULL,
  "sub"     INT           NOT NULL,
  "skill"   VARCHAR(250)  NOT NULL,
  "posi"    INT           NOT NULL,
  "mark"    INT           NOT NULL,
  "status"  SMALLINT    DEFAULT 1,
  PRIMARY KEY ("master_skills_id")
);

--
-- Dumping data for table "master_skills"
--

INSERT INTO "master_skills" ("master_skills_id", "divi", "class", "sub", "skill", "posi", "mark", "status") VALUES
(1, 3, 5, 1, 'Thinking Skills', 1, 0, 0),
(2, 3, 5, 1, 'Social Skills', 2, 0, 0),
(3, 3, 5, 1, 'Self-Management Skills', 3, 0, 0),
(4, 3, 5, 1, 'Research Skills', 4, 0, 0),
(5, 3, 5, 2, 'Listening', 2, 0, 1),
(6, 3, 5, 3, 'Shape and Space', 2, 0, 0),
(7, 3, 5, 3, 'Measurement', 3, 0, 0),
(8, 3, 5, 3, 'Data Analysis', 4, 0, 0),
(9, 3, 5, 4, 'Speaking', 2, 0, 0),
(10, 3, 5, 4, 'Reading', 3, 0, 0),
(11, 3, 5, 4, 'Writing', 4, 0, 0),
(12, 3, 5, 5, 'ICT', 1, 0, 1),
(13, 3, 5, 6, 'ART', 1, 0, 1),
(14, 3, 5, 7, 'MUSIC', 1, 0, 0),
(15, 3, 5, 8, 'DRAMA', 1, 0, 1),
(16, 3, 5, 247, 'DANCE', 1, 0, 0),
(17, 3, 5, 248, 'Games', 1, 0, 1),
(18, 3, 5, 248, 'Gymnastics', 2, 0, 1),
(19, 3, 5, 248, 'Swimming', 3, 0, 1),
(20, 3, 5, 248, 'Basketball', 4, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table "modules"
--

CREATE TABLE IF NOT EXISTS "modules" (
  "module"  VARCHAR(50)  NOT NULL,
  "modules_id"      SERIAL,
  PRIMARY KEY ("module"),
  PRIMARY KEY ("modules_id")
);

--
-- Dumping data for table "modules"
--

INSERT INTO "modules" ("module", "id") VALUES
('Main', 1),
('Settings', 2),
('User Management', 3),
('Pre-Admission', 4),
('Student-Management', 5),
('Staff Management', 7),
('Class', 8),
('Student Assessment', 9),
('Time Table', 10),
('Email & SMS alert', 11),
('Parents Web', 12),
('Charges', 13),
('Accounts', 14),
('Asset Management', 15),
('Library Management', 16),
('Hostel Management', 17),
('Health Management', 18),
('Transportation', 19),
('Inventory', 20),
('Photo Gallery', 22),
('Online Assessment', 23),
('', 24),
('RFID', 25),
('Academic Report', 26),
('Fee', 27);

-- --------------------------------------------------------

--
-- Table structure for table "modules_p"
--

CREATE TABLE IF NOT EXISTS "modules_p" (
  "module"  VARCHAR(50)  NOT NULL,
  "modules_p_id"      SERIAL,
  PRIMARY KEY ("module"),
  PRIMARY KEY ("modules_p_id")
);

--
-- Dumping data for table "modules_p"
--

INSERT INTO "modules_p" ("module", "id") VALUES
('Main', 1),
('Student-Management', 5),
('Class', 7),
('Student Assessment', 8),
('Time Table', 10),
('Parents Web', 11),
('Photo Gallery', 12),
('Library Management', 15),
('Health Management', 17),
('User Management', 3),
('Fee', 27);

-- --------------------------------------------------------

--
-- Table structure for table "module_info"
--

CREATE TABLE IF NOT EXISTS "module_info" (
  "mod_id"       SERIAL,
  "module_name"  VARCHAR(50)  NOT NULL,
  PRIMARY KEY ("mod_id")
);

--
-- Dumping data for table "module_info"
--

INSERT INTO "module_info" ("mod_id", "module_name") VALUES
(1, 'Student Management'),
(2, 'Staff Management'),
(3, 'Library Management'),
(4, 'Inventory_Management');

-- --------------------------------------------------------

--
-- Table structure for table "msg"
--

CREATE TABLE IF NOT EXISTS "msg" (
  "msg_id"             SERIAL,
  "username"       VARCHAR(30)  DEFAULT NULL,
  "student_id"     INT          DEFAULT NULL,
  "mobile_number"  VARCHAR(30)  DEFAULT NULL,
  "msg"            TEXT,
  "class_det"      INT          NOT NULL,
  "msg_date"       DATE         NOT NULL,
  "msg_time"       TIME         NOT NULL,
  "guid"           VARCHAR(50)  NOT NULL,
  "errorcode"      INT          NOT NULL,
  "seqno"          VARCHAR(20)  NOT NULL,
  PRIMARY KEY ("msg_id")
);

--
-- Dumping data for table "msg"
--

INSERT INTO "msg" ("msg_id", "username", "student_id", "mobile_number", "msg", "class_det", "msg_date", "msg_time", "guid", "errorcode", "seqno") VALUES
(1, 'administrator', 55, '8050458035', 'Announcement Test MSg', 0, '2026-01-09', '12:05:40', 'c65e709e-ead7-43a6-a8bc-da582c783cf7', 0, '918050458035'),
(2, 'administrator', 55, '9845498377', 'Announcement Test MSG', 0, '2026-01-09', '12:07:28', '9ad8c4e5-672d-45ab-9293-f7b9764f9e05', 0, '919845498377'),
(3, 'administrator', 3, '9845498377', 'Announcement HI this is test MSG\r\n\r\nregards ', 5, '2026-01-09', '20:01:52', '0d5ff463-e17f-4ca7-a5f2-e1ed92b748b8', 14, '919845498377'),
(4, 'administrator', 4, '8050458035', 'Announcement HI this is test MSG\r\n\r\nregards ', 5, '2026-01-09', '20:01:53', '282a50bb-03c7-41a8-81ed-5536ebcbdd1c', 14, '918050458035'),
(5, 'administrator', 3, '9845498377', 'Announcement hi', 5, '2026-01-09', '20:02:12', 'bdb94a61-573a-4151-ae59-a332b72b6804', 0, '919845498377');

-- --------------------------------------------------------

--
-- Table structure for table "msg_not_sent"
--

CREATE TABLE IF NOT EXISTS "msg_not_sent" (
  "msg_not_sent_id"             SERIAL,
  "username"       VARCHAR(30)  DEFAULT NULL,
  "student_id"     INT          DEFAULT NULL,
  "mobile_number"  VARCHAR(30)  DEFAULT NULL,
  "msg"            TEXT,
  "class_det"      INT          NOT NULL,
  "msg_date"       DATE         NOT NULL,
  "msg_time"       TIME         NOT NULL,
  PRIMARY KEY ("msg_not_sent_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "msp_unit"
--

CREATE TABLE IF NOT EXISTS "msp_unit" (
  "msp_unit_id"         SERIAL,
  "class"      INT           NOT NULL,
  "exam_id"    INT           NOT NULL,
  "sub"        INT           NOT NULL,
  "unit"       VARCHAR(250)  NOT NULL,
  "unit_s"     VARCHAR(255)  NOT NULL,
  "mark_m"     INT           NOT NULL,
  "acc_year"   INT           NOT NULL,
  "posi"       INT           NOT NULL,
  "un_type"    INT           NOT NULL,
  "status"     INT           NOT NULL,
  "exam_date"  DATE          NOT NULL,
  PRIMARY KEY ("msp_unit_id")
);

--
-- Dumping data for table "msp_unit"
--

INSERT INTO "msp_unit" ("msp_unit_id", "class", "exam_id", "sub", "unit", "unit_s", "mark_m", "acc_year", "posi", "un_type", "status", "exam_date") VALUES
(1, 1, 1, 0, 'Unit 1 Art', '', 0, 2026, 0, 0, 1, NULL),
(2, 3, 2, 0, 'Unit 1- Relationships', '', 0, 2026, 0, 0, 1, '2026-10-04'),
(3, 3, 2, 0, 'Unit 1 - Relationship', '', 0, 2026, 0, 0, 0, NULL),
(4, 2, 4, 0, 'Unit 2 - Celebrations', '', 0, 2026, 0, 0, 1, '2026-12-19'),
(5, 2, 4, 0, 'Unit 1 - Amazing me', '', 0, 2026, 0, 0, 1, '2026-10-11'),
(6, 4, 6, 0, 'Unit 1 - Our actions ', '', 0, 2026, 0, 0, 1, '2026-09-20'),
(7, 5, 7, 0, 'Unit 1 - Growth', '', 0, 2026, 0, 0, 1, '2026-09-20'),
(8, 6, 8, 0, 'Unit 1 - Healthy choices ', '', 0, 2026, 0, 0, 1, '2026-09-20'),
(9, 7, 9, 0, 'Unit 1 - Role models ', '', 0, 2026, 0, 0, 1, '2026-09-20'),
(10, 8, 10, 0, 'Unit 1 - Migration', '', 0, 2026, 0, 0, 1, '2026-09-20'),
(11, 9, 11, 0, 'Unit 1 - Mythology', '', 0, 2026, 0, 0, 1, '2026-09-13'),
(12, 3, 2, 0, 'Unit 2', '', 0, 2026, 0, 0, 0, NULL),
(14, 3, 2, 0, 'Unit 2 - Stories', '', 0, 2026, 0, 0, 1, '2026-12-19'),
(15, 4, 6, 0, 'Unit 2 - Signs and symbols', '', 0, 2026, 0, 0, 1, '2026-10-24'),
(16, 5, 7, 0, 'Unit 2 - Field to table ', '', 0, 2026, 0, 0, 1, '2026-10-31'),
(17, 6, 8, 0, 'Unit 2 - Communities', '', 0, 2026, 0, 0, 1, '2026-10-31'),
(18, 7, 9, 0, 'Unit 2 - Explorations', '', 0, 2026, 0, 0, 1, '2026-10-31'),
(19, 8, 10, 0, 'Unit 2 - Earth', '', 0, 2026, 0, 0, 1, '2026-10-31'),
(20, 9, 11, 0, 'Unit 2 - Topography ', '', 0, 2026, 0, 0, 1, '2026-10-31'),
(21, 4, 13, 0, 'Unit 3 - Plants', '', 0, 2026, 0, 0, 1, '2026-12-17'),
(22, 5, 14, 0, 'Unit 3 - Art', '', 0, 2026, 0, 0, 1, '2026-12-19'),
(23, 6, 15, 0, 'Unit 3 - Sound', '', 0, 2026, 0, 0, 1, '2026-12-19'),
(24, 7, 16, 0, 'Unit 3 - Systems', '', 0, 2026, 0, 0, 1, '2026-12-19'),
(25, 8, 17, 0, 'Unit 3 - Organization', '', 0, 2026, 0, 0, 1, '2026-12-19'),
(26, 9, 18, 0, 'Unit 3 - Sustainability', '', 0, 2026, 0, 0, 1, '2026-12-19'),
(27, 5, 7, 0, 'test', '', 0, 2026, 0, 0, 0, '2026-01-17'),
(28, 6, 15, 0, 'Unit 4 - Patterns in Nature', '', 0, 2026, 0, 0, 1, '2026-02-21'),
(29, 4, 13, 0, 'Unit 4 - Communities', '', 0, 2026, 0, 0, 1, '2026-03-18'),
(30, 5, 14, 0, 'Unit 4 - Navigating the world', '', 0, 2026, 0, 0, 1, '2026-02-28'),
(31, 7, 16, 0, 'Unit 4 - Matter', '', 0, 2026, 0, 0, 1, '2026-02-14'),
(32, 8, 17, 0, 'Unit 4 - Human systems', '', 0, 2026, 0, 0, 1, '2026-02-21'),
(33, 9, 18, 0, 'Unit 4 - Media', '', 0, 2026, 0, 0, 1, '2026-02-06'),
(34, 3, 19, 0, 'Unit - 3 Animals', '', 0, 2026, 0, 0, 1, '2026-04-01'),
(35, 2, 20, 0, 'Unit 3 - Transportation', '', 0, 2026, 0, 0, 1, '2026-03-07');

-- --------------------------------------------------------

--
-- Table structure for table "nationality"
--

CREATE TABLE IF NOT EXISTS "nationality" (
  "nationality_id"            SERIAL,
  "nation"        VARCHAR(50)  DEFAULT NULL,
  "short_nation"  VARCHAR(10)  DEFAULT NULL,
  PRIMARY KEY ("nationality_id")
);

--
-- Dumping data for table "nationality"
--

INSERT INTO "nationality" ("nationality_id", "nation", "short_nation") VALUES
(1, 'American', 'NULL'),
(2, 'Australian', 'NULL'),
(3, 'Belgium', 'NULL'),
(4, 'Brazilian', 'NULL'),
(5, 'British', 'NULL'),
(6, 'British / Indian', 'NULL'),
(7, 'Canadian', 'NULL'),
(8, 'Colombian', 'NULL'),
(9, 'Danish', 'NULL'),
(10, 'Dutch', 'NULL'),
(11, 'French', 'NULL'),
(12, 'German', 'NULL'),
(13, 'Indian', 'NULL'),
(14, 'Italian', 'NULL'),
(15, 'Japanese', 'NULL'),
(16, 'Korean', 'NULL'),
(17, 'Malaysian', 'NULL'),
(18, 'Netherlands', 'NULL'),
(19, 'Malaysian', 'NULL'),
(20, 'Russian', 'NULL'),
(21, 'Norwegian', 'NULL'),
(22, 'Singapore', 'NULL'),
(23, 'Saudi', 'NULL'),
(24, 'South African', 'NULL'),
(25, 'Spanish', 'NULL'),
(26, 'Srilankan', 'NULL'),
(27, 'Swiss', 'NULL'),
(28, 'Turkish', 'NULL'),
(29, 'Trinidadian', 'NULL'),
(30, 'US', 'NULL'),
(31, 'U.S.A', 'NULL'),
(32, 'U.K.', 'NULL'),
(33, 'U.S.A', 'NULL'),
(34, 'USA & Indian', 'NULL'),
(35, 'Uzebekistan', NULL),
(36, 'New Zealand', NULL),
(37, 'NRI (UK)', NULL),
(38, 'NRI (USA)', NULL),
(39, 'China', NULL),
(40, 'Filipino', NULL),
(41, 'Nepal', NULL),
(42, 'Greek', NULL),
(43, 'American/Indian OCI', NULL),
(44, 'Australian (with OCI)', NULL),
(45, 'British (With Overseas Citizen of India card)', NULL),
(46, 'Canadian (with OCI)', NULL),
(47, 'Estonian', NULL),
(48, 'Fiji', NULL),
(49, 'HINDU', NULL),
(50, 'HKSAR', NULL),
(51, 'Hong kong', NULL),
(52, 'Indian Origin, US Passport Holder', NULL),
(53, 'Indonesian', NULL),
(54, 'KENYAN', NULL),
(55, 'Swedish', NULL),
(56, 'Indian/American', NULL);

-- --------------------------------------------------------

--
-- Table structure for table "obemail"
--

CREATE TABLE IF NOT EXISTS "obemail" (
  "student_id"    VARCHAR(255)  DEFAULT NULL,
  "img_source_s"  VARCHAR(255)  DEFAULT NULL,
  PRIMARY KEY ("student_id")
);

--
-- Dumping data for table "obemail"
--

INSERT INTO "obemail" ("student_id", "img_source_s") VALUES
('A203', 'aaliya.jain@email.com'),
('A12397', 'aarush.gupta@email.com'),
('A1182', 'aashu.kedia@email.com'),
('A427', 'abbas.jaaferi@email.com'),
('A12398', 'adiraj.singh@email.com'),
('A381', 'adit.pakvasa@email.com'),
('A12518', 'advika.shali@email.com'),
('A664', 'akash.singh@email.com'),
('A580', 'amogh.narvekar@email.com'),
('A1170', 'ananya.yogarajah@email.com');


-- --------------------------------------------------------

--
-- Table structure for table "obe_skill_mark"
--

CREATE TABLE IF NOT EXISTS "obe_skill_mark" (
  "obe_skill_mark_id"             SERIAL,
  "class_section"  INT           DEFAULT NULL,
  "student_id"     INT           DEFAULT NULL,
  "subject_id"     INT           DEFAULT NULL,
  "status"         VARCHAR(4)    DEFAULT NULL,
  "sem_id"         INT           DEFAULT NULL,
  "unit"           INT           NOT NULL,
  "int_id"         INT           DEFAULT NULL,
  "tst_id"         INT           DEFAULT NULL,
  "mark"           VARCHAR(4)    DEFAULT NULL,
  "grade"          TEXT,
  "remarks"        TEXT,
  "grade_rem"      VARCHAR(250)  NOT NULL,
  PRIMARY KEY ("obe_skill_mark_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "obnat"
--

CREATE TABLE IF NOT EXISTS "obnat" (
  "student_id"   VARCHAR(255)  DEFAULT NULL,
  "nationality"  VARCHAR(255)  DEFAULT NULL,
  PRIMARY KEY ("student_id")
);

--
-- Dumping data for table "obnat"
--

INSERT INTO "obnat" ("student_id", "nationality") VALUES
('A630', '13'),
('A216', '13'),
('A606', '5'),
('A595', '5'),
('A12522', '13'),
('A12515', '13'),
('A1040', '13'),
('A972', '1'),
('A1118', '13'),
('A790', '13');

-- --------------------------------------------------------

--
-- Table structure for table "ois_data"
--

CREATE TABLE IF NOT EXISTS "ois_data" (
  "stu_id"    VARCHAR(255)  DEFAULT NULL,
  "stu_rfid"  VARCHAR(255)  DEFAULT NULL,
  PRIMARY KEY ("stu_id")
);

--
-- Dumping data for table "ois_data"
--

INSERT INTO "ois_data" ("stu_id", "stu_rfid") VALUES
('A467', '0B881817000000000000000000000000'),
('A458', '32981917000000000000000000000000'),
('A487', '723D6B17000000000000000000000000'),
('A499', '72D76B17000000000000000000000000'),
('A508', '49B76B17000000000000000000000000'),
('A503', '5E2F6B17000000000000000000000000'),
('A506', '6C236D17000000000000000000000000'),
('A634', '5C246D17000000000000000000000000'),
('A735', '42B06C17000000000000000000000000'),
('A510', '0C261917000000000000000000000000');

-- --------------------------------------------------------

--
-- Table structure for table "online_exam_des_mark"
--

CREATE TABLE IF NOT EXISTS "online_exam_des_mark" (
  "student_id"   INT         NOT NULL,
  "online_exam_des_mark_id"           SERIAL,
  "exam_id"      INT         NOT NULL,
  "ques_id"      INT         DEFAULT NULL,
  "description"  TEXT        NOT NULL,
  "score"        INT         NOT NULL,
  "status"       SMALLINT  NOT NULL,
  PRIMARY KEY ("online_exam_des_mark_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "online_exam_des_questions"
--

CREATE TABLE IF NOT EXISTS "online_exam_des_questions" (
  "online_exam_des_questions_id"           SERIAL,
  "exam_id"      INT         NOT NULL,
  "description"  TEXT        NOT NULL,
  "score"        INT         NOT NULL,
  "status"       SMALLINT  NOT NULL,
  PRIMARY KEY ("online_exam_des_questions_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "online_exam_det"
--

CREATE TABLE IF NOT EXISTS "online_exam_det" (
  "online_exam_det_id"               SERIAL,
  "class_id"         INT          NOT NULL,
  "acc_year"         INT          NOT NULL,
  "section_id"       VARCHAR(3)   NOT NULL,
  "exam_name"        VARCHAR(80)  NOT NULL,
  "exam_short_name"  VARCHAR(8)   NOT NULL,
  "subject_id"       INT          NOT NULL,
  "exam_type"        SMALLINT   NOT NULL,
  "score"            INT          NOT NULL,
  "exam_date"        DATE         NOT NULL,
  "status"           SMALLINT   NOT NULL,
  "time_limit"       VARCHAR(10)  NOT NULL,
  PRIMARY KEY ("online_exam_det_id")
);

--
-- Dumping data for table "online_exam_det"
--

INSERT INTO "online_exam_det" ("online_exam_det_id", "class_id", "acc_year", "section_id", "exam_name", "exam_short_name", "subject_id", "exam_type", "score", "exam_date", "status", "time_limit") VALUES
(1, 5, 2026, '1', 'ICT', 'ICT', 5, 2, 0, '2026-01-16', 1, '1:00');

-- --------------------------------------------------------

--
-- Table structure for table "online_exam_sel_mark"
--

CREATE TABLE IF NOT EXISTS "online_exam_sel_mark" (
  "student_id"  INT         NOT NULL,
  "online_exam_sel_mark_id"          SERIAL,
  "exam_id"     INT         NOT NULL,
  "ans"         SMALLINT  NOT NULL,
  "score"       INT         NOT NULL,
  "status"      SMALLINT  NOT NULL,
  PRIMARY KEY ("online_exam_sel_mark_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "online_exam_sel_questions"
--

CREATE TABLE IF NOT EXISTS "online_exam_sel_questions" (
  "online_exam_sel_questions_id"            SERIAL,
  "exam_id"       INT         NOT NULL,
  "no_of_option"  SMALLINT  NOT NULL,
  "que"           TEXT        NOT NULL,
  "option1"       TEXT        NOT NULL,
  "option2"       TEXT        NOT NULL,
  "option3"       TEXT        NOT NULL,
  "option4"       TEXT        NOT NULL,
  "option5"       TEXT        NOT NULL,
  "right_ans"     SMALLINT  NOT NULL,
  "score"         INT         NOT NULL,
  "status"        SMALLINT  NOT NULL,
  PRIMARY KEY ("online_exam_sel_questions_id")
);

--
-- Dumping data for table "online_exam_sel_questions"
--

INSERT INTO "online_exam_sel_questions" ("online_exam_sel_questions_id", "exam_id", "no_of_option", "que", "option1", "option2", "option3", "option4", "option5", "right_ans", "score", "status") VALUES
(1, 1, 4, 'WWW stands for ', 'World Worm Web ', 'World Wide Web ', 'World Word Web ', 'None', '', 2, 10, 1),
(2, 1, 4, 'What do you use to type? ', 'Keyboard', 'Mouse', 'Monitor', 'CPU', '', 1, 10, 1);

-- --------------------------------------------------------

--
-- Table structure for table "parentmenu"
--

CREATE TABLE IF NOT EXISTS "parentmenu" (
  "row_id"     SERIAL,
  "module"     CHAR(50)          DEFAULT NULL,
  "submodule"  CHAR(50)          DEFAULT NULL,
  "linkname"   CHAR(250)         DEFAULT NULL,
  "linkpath"   CHAR(250)         DEFAULT NULL,
  "access"     VARCHAR(50)  DEFAULT NULL,
  "parameter"  CHAR(250)         DEFAULT NULL,
  "id"         INT               DEFAULT NULL,
  PRIMARY KEY ("row_id")
);

--
-- Dumping data for table "parentmenu"
--

INSERT INTO "parentmenu" ("module", "submodule", "linkname", "linkpath", "access", "parameter", "id") VALUES
('Main', 'Main', 'Settings', '/lms/menu/mastermenu.php', 'No', '', 204),
('Main', 'Main', 'Staff Management', '/lms/menu/staffmenu.php', 'No', '', 205),
('Main', 'Main', 'User Management', '/lms/menu/usermenu.php', 'Yes', '', 206),
('Main', 'Main', 'Student Management', '/lms/menu/studentmenu.php', 'Yes', '', 207),
('Main', 'Main', 'Accounts', '/lms/menu/feemenu.php', 'No', '', 208),
('Main', 'Main', 'Time Table', '/lms/menu/timetablemenu.php', 'No', '', 209),
('Main', 'Main', 'Student Assessment', '/lms/menu/studattdmenu.php', 'No', '', 210),
('Main', 'Main', 'Transportation', '/lms/menu/tptmenu.php', 'No', '', 211),
('Main', 'Main', 'Email & SMS alert', '/lms/menu/enoticemenu.php', 'No', '', 212),
('Main', 'Main', 'Class', '/lms/menu/class.php', 'Yes', '', 214),
('Main', 'Main', 'Inventory', '/lms/menu/inventory.php', 'No', '', 216),
('Main', 'Main', 'Charges', '/lms/menu/charges.php', 'No', '', 217),
('Main', 'Main', 'Parents Web', '/lms/menu/calendar.php', 'Yes', '', 218),
('Main', 'Main', 'Library Management', '/lms/menu/libmenu.php', 'No', '', 219),
('Main', 'Main', 'Hostel Management', '/lms/menu/hostelmenu.php', 'No', '', 220),
('Main', 'Main', 'Health Management', '/lms/menu/healthManagement.php', 'Yes', '', 221),
('Main', 'Main', 'Pre-Admission', '/lms/menu/preadmission.php', 'No', '', 222),
('Main', 'Main', 'Asset Management', '/lms/menu/assetmenu.php', 'No', '', 223),
('User Management', 'Users', 'Declare User Group', '/lms/AdminTask/AddUserGroup.php', 'No', '', 367),
('User Management', 'Users', 'Modify Group Rights', '/lms/AdminTask/ModUserGroup.php', 'No', '', 368),
('User Management', 'Users', 'Add User', '/lms/AdminTask/addusers.php', 'No', '', 369),
('User Management', 'Users', 'Modify/Delete User', '/lms/AdminTask/mod_del_user.php', 'No', '', 370),
('User Management', 'Users', 'User Rights', '/lms/AdminTask/useraccess.php', 'No', '', 371),
('User Management', 'Users', 'Change Password', '/lms/AdminTask/changepass.php', 'No', '', 372),
('User Management', 'Users', 'Add Subject Rights', '/lms/AdminTask/AddRightsToStaff.php', 'No', '', 373),
('User Management', 'Users', 'Delete Subject Rights', '/lms/AdminTask/DeleteRightsofStaff.php', 'No', '', 374),
('User Management', 'Users', 'Power Up User', '/lms/AdminTask/unlock.php', 'No', '', 375),
('User Management', 'Users', 'Download Backup', '/lms/download_manager/index.php', 'No', '', 376),
('User Management', 'Users', 'Student Rights', '/lms/AdminTask/Student_Rights.php', 'No', '', 377),
('User Management', 'Users', 'Parent Rights', '/lms/AdminTask/parent_rights.php', 'No', '', 378),
('User Management', 'Users', 'Power Up Student/Parent', '/lms/AdminTask/powerstud.php', 'No', '', 379),
('User Management', 'Users', 'Manage Password(S)', '/lms/AdminTask/stud_chpswd.php', 'No', '', 380),
('User Management', 'Users', 'Manage Password(P)', '/lms/AdminTask/par_chpswd.php', 'Yes', '', 381),
('User Management', 'Users', 'Apply Class Teacher', '/lms/AdminTask/applyhod.php', 'No', '', 382),
('Student Management', 'Reports', 'Student List', '/lms/student_det/list_of_student.php', 'No', '', 230),
('Student Management', 'Reports', 'View Details', '/lms/student_det/view_stud.php', 'Yes', '', 231),
('Student Management', 'Reports', 'View Student Details', '/lms/student_det/search_student_det.php', 'No', '', 232),
('Student Management', 'Reports', 'Student Contact Details', '/lms/student_det/search_student1.php', 'No', '', 233),
('Student Management', 'Reports', 'Print Address Label', '/lms/student_det/addresssearch.php', 'No', '', 234),
('Student Management', 'Reports', 'Admission Type Wise Report', '/lms/student_det/admissiontypewise.php', 'No', '', 235),
('Student Management', 'Reports', 'Category Wise Report', '/lms/student_det/CasteWise.php', 'No', '', 236),
('Student Management', 'Reports', 'Religion Wise Report', '/lms/student_det/ReligionWise.php', 'No', '', 237),
('Student Management', 'Reports', 'Gender Wise Report', '/lms/student_det/sexwise.php', 'No', '', 238),
('Student Management', 'Reports', 'Archived Student List', '/lms/student_det/search_archive_det.php', 'No', '', 239),
('Class', 'Reports', 'Subject wise Attendance Report', '/lms/studatt/subject_attreport.php', 'No', '', 298),
('Class', 'Reports', 'Consolidated Attendance Report', '/lms/studatt/View_Attendance.php', 'No', '', 299),
('Class', 'Reports', 'Percentage wise Attendance Report', '/lms/studatt/View_Shortage_Attendance.php', 'No', '', 300),
('Class', 'Reports', 'Day wise Attendance Report', '/lms/studatt/daywise_attreport.php', 'No', '', 301),
('Class', 'Reports', 'Detailed Student Attendance', '/lms/studatt/det_att_rep_stud.php', 'Yes', '', 303),
('Class', 'Reports', 'Detailed Attendance Report', '/lms/studatt/det_stud.php', 'No', '', 304),
('Student Assessment', 'Reports', 'Skill set', '/lms/studatt/skillset_report.php', 'No', '', 305),
('Student Assessment', 'Reports', 'Mark Analysis-Graph', '/lms/studatt/graph.php', 'No', '', 306),
('Student Assessment', 'Reports', 'Consolidated', '/lms/studatt/Marks_Attendance2.php', 'No', '', 307),
('Student Assessment', 'Reports', 'Mark Card', '/lms/studatt/det_stud.php', 'No', '', 308),
('Student Assessment', 'Reports', 'Skill-set', '/lms/studatt/pskillset_report.php', 'No', '', 315),
('Time Table', 'Reports', 'Class Room Time Table', '/lms/TimeTable/hallwise.php', 'Yes', '', 334),
('Time Table', 'Reports', 'Coursewise Time Table', '/lms/TimeTable/coursewise.php', 'No', '', 335),
('Time Table', 'Reports', 'Staff Wise Time Table', '/lms/TimeTable/staffwise.php', 'No', '', 336),
('Time Table', 'Reports', 'Subject Wise Time Table', '/lms/TimeTable/subjectwise.php', 'No', '', 337),
('Time Table', 'Reports', 'Full View Time Table', '/lms/TimeTable/fullcoursewise.php', 'No', '', 338),
('Time Table', 'Reports', 'View Time Table', '/lms/TimeTable/vwtt.php', 'No', '', 339),
('Time Table', 'Reports', 'Staff Time Table', '/lms/int_exam/staff_det.php', 'No', '', 340),
('Parents Web', 'Reports', 'School Announcement', '/lms/Calendar/scannouncementRep.php', 'Yes', '', 70),
('Parents Web', 'Reports', 'Class Announcement', '/lms/Calendar/classannouncementRep.php', 'Yes', '', 71),
('Class', 'Class', 'Home Work', '/lms/TimeTable/homework.php', 'No', '', 80),
('Class', 'Class', 'Study Materials', '/lms/TimeTable/student_lesson_plan.php', 'No', '', 81),
('Class', 'Class', 'Lesson Plan', '/lms/TimeTable/lesson_plan.php', 'No', '', 82),
('Health Management', 'Infirmary Report', 'Add Sick Report', '/lms/health_management/sick_report.php', 'No', '', 112),
('Health Management', 'Infirmary Report', 'Edit Sick Report', '/lms/health_management/edit_report.php', 'No', '', 113),
('Health Management', 'Infirmary Report', 'View Sick Report', '/lms/health_management/view_report.php', 'No', '', 114),
('Health Management', 'Infirmary Report', 'Day Wise Sick Report', '/lms/health_management/daywise_report.php', 'No', '', 115),
('Health Management', 'Student Medical Details', 'Add Medical Report', '/lms/health_management/add_medical.php', 'No', '', 109),
('Health Management', 'Student Medical Details', 'Edit Medical Report', '/lms/health_management/edit_medical_rep.php', 'No', '', 110),
('Health Management', 'Student Medical Details', 'View Medical Report', '/lms/health_management/viewadd_main.php', 'No', '', 111),
('Health Management', 'Student Medical Details', 'Medical details', '/lms/health_management/student_medical.php', 'Yes', '', 391),
('Health Management', 'Infirmary Report', 'Event Records', '/lms/health_management/day_studs_full.php', 'No', '', 392),
('Parents Web', 'Reports', 'School Calendar', '/lms/Calendar/scannouncementRep_call.php', 'Yes', '', 394),
('Parents Web', 'Calendar', 'School Calendar', '/lms/Calendar/scannouncement_call.php', 'No', '', 393),
('Parents Web', 'Announcement', 'School Announcement', '/lms/Calendar/scannouncement.php', 'No', '', 68),
('Parents Web', 'Announcement', 'Class Announcement', '/lms/Calendar/announcement.php', 'No', '', 69),
('Class', 'Reports', 'Teacher lesson plan', '/lms/TimeTable/Teacher_lesson_plan_rep.php', 'No', '', 409),
('Main', 'Main', 'Photo Gallery', '/lms/menu/Gallery.php', 'Yes', '', 399),
('Main', 'Main', 'Online Assessment', '/lms/menu/Online.php', 'No', '', 403),
('Photo Gallery', 'View', 'School', '/lms/PhotoGallery/schoolGalleryView.php', 'Yes', '', 397),
('Photo Gallery', 'View', 'Class', '/lms/PhotoGallery/classGalleryView.php', 'No', '', 398),
('Class', 'Reports', 'Curriculum/Other Document', '/lms/week_up/stud_ups.php', 'Yes', '', 491),
('Class', 'Reports', 'Weekly updates/Other Document', '/lms/week_up/stud_ups.php', 'Yes', '', 492),
('Student-Management', 'Reports', 'View Details', '/lms/student_det/view_stud.php', 'Yes', '', 231),
('Main', 'Main', 'Fee', '/lms/menu/fee.php', 'Yes', '', 535),
('Fee', 'Fee', 'Fee', '/lms/fee/stundetfeereciptall.php', 'Yes', '', 536),
('Parents Web', 'Appointment Scheduler', 'Schedule Meeting', '/lms/Calendar/appointmentScheduler.php', 'Yes', '', 546),
('Fee', 'Fee', 'Invoice', '/lms/fee/stundetfeeinvoiceall.php', 'Yes', '', 555);

-- --------------------------------------------------------

--
-- Table structure for table "pasng_route_master"
--

CREATE TABLE IF NOT EXISTS "pasng_route_master" (
  "pasng_route_master_id"         SERIAL,
  "p_type"     INT          DEFAULT NULL,
  "pasng_id"   VARCHAR(20)  DEFAULT NULL,
  "route_id"   INT          DEFAULT NULL,
  "source_pt"  INT          DEFAULT NULL,
  "trip_id"    INT          DEFAULT NULL,
  "val_mon"    VARCHAR(10)  NOT NULL,
  "val_yr"     VARCHAR(10)  NOT NULL,
  "rec_no"     VARCHAR(25)  DEFAULT NULL,
  "sts"        SMALLINT   DEFAULT 0,
  "wefdt"      DATE         DEFAULT NULL,
  PRIMARY KEY ("pasng_route_master_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "phy_lib_stock"
--

CREATE TABLE IF NOT EXISTS "phy_lib_stock" (
  "acc_no"  VARCHAR(30)   DEFAULT NULL,
  "mtype"   VARCHAR(100)  DEFAULT NULL,
  PRIMARY KEY ("acc_no")
);

-- --------------------------------------------------------

--
-- Table structure for table "point_details"
--

CREATE TABLE IF NOT EXISTS "point_details" (
  "point_details_id"        SERIAL,
  "route_id"  INT          DEFAULT NULL,
  "point_id"  INT          DEFAULT NULL,
  "pick_t"    VARCHAR(25)  NOT NULL,
  "drop_t"    VARCHAR(25)  NOT NULL,
  PRIMARY KEY ("point_details_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "point_master"
--

CREATE TABLE IF NOT EXISTS "point_master" (
  "point_master_id"          SERIAL,
  "point_name"  VARCHAR(50)  DEFAULT NULL,
  "details"     VARCHAR(50)  DEFAULT NULL,
  "dist"        NUMERIC(5,1)   DEFAULT NULL,
  "oneway"      NUMERIC(12,2)  DEFAULT NULL,
  "twoway"      NUMERIC(12,2)  DEFAULT NULL,
  PRIMARY KEY ("point_master_id")
);

--
-- Dumping data for table "point_master"
--

INSERT INTO "point_master" ("point_master_id", "point_name", "details", "dist", "oneway", "twoway") VALUES
(1, 'Majestic', 'Majestic Bus Stand', 20.0, '20', '30');

-- --------------------------------------------------------

--
-- Table structure for table "previous_job"
--

CREATE TABLE IF NOT EXISTS "previous_job" (
  "previous_job_id"                 SERIAL,
  "staff_id"           INT           DEFAULT NULL,
  "prev_post"          VARCHAR(200)  DEFAULT NULL,
  "prev_work_place"    VARCHAR(200)  DEFAULT NULL,
  "prev_work_city"     VARCHAR(200)  DEFAULT NULL,
  "prev_work_country"  VARCHAR(200)  DEFAULT NULL,
  "last_date_work"     VARCHAR(25)   DEFAULT NULL,
  "from_date"          VARCHAR(25)   DEFAULT NULL,
  "col_id"             INT           DEFAULT NULL,
  "exp_type"           VARCHAR(100)  DEFAULT NULL,
  "years"              VARCHAR(25)   DEFAULT NULL,
  PRIMARY KEY ("previous_job_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "products"
--

CREATE TABLE IF NOT EXISTS "products" (
  "PRODUCT_ID"    BIGSERIAL,
  "PRODUCT_NAME"  VARCHAR(200)     NOT NULL,
  "AMOUNT"        BIGINT  DEFAULT NULL,
  "PRODUCT_CODE"  VARCHAR(20)      NOT NULL,
  "QUANTITY"      BIGINT           DEFAULT 1,
  "CATEGORY"      INTEGER     DEFAULT NULL,
  "REORDERLEVEL"  INT              NOT NULL,
  "BAR_CODE"      INT              NOT NULL,
  PRIMARY KEY ("PRODUCT_ID")
);

CREATE UNIQUE INDEX "PRODUCT_ID" ON "products" ("PRODUCT_ID");

-- --------------------------------------------------------

--
-- Table structure for table "pypskills"
--

CREATE TABLE IF NOT EXISTS "pypskills" (
  "pypskills_id"        SERIAL,
  "class"     INT           NOT NULL,
  "sub"       INT           NOT NULL,
  "exam_id"   INT           NOT NULL,
  "skill"     VARCHAR(250)  NOT NULL,
  "acc_year"  INT           NOT NULL,
  "posi"      INT           NOT NULL,
  PRIMARY KEY ("pypskills_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "pyp_subskills"
--

CREATE TABLE IF NOT EXISTS "pyp_subskills" (
  "pyp_subskills_id"            SERIAL,
  "class"         INT   NOT NULL,
  "sub"           INT   NOT NULL,
  "master_skill"  INT   NOT NULL,
  "sub_skill"     TEXT  NOT NULL,
  "examid"        INT   NOT NULL,
  "acc_year"      INT   NOT NULL,
  "posi"          INT   NOT NULL,
  "unit"          INT   NOT NULL,
  PRIMARY KEY ("pyp_subskills_id")
);

--
-- Dumping data for table "pyp_subskills"
--

INSERT INTO "pyp_subskills" ("pyp_subskills_id", "class", "sub", "master_skill", "sub_skill", "examid", "acc_year", "posi", "unit") VALUES
(1, 1, 0, 0, ' Elements of art (form).', 1, 2026, 1, 1),
(2, 1, 0, 0, 'Diverse ways in which people express themselves (reflection)', 1, 2026, 2, 1),
(3, 1, 0, 0, 'Translating our own ideas in different ways (perspective)', 1, 2026, 3, 1),
(4, 2, 0, 0, 'How I am growing and changing ', 4, 2026, 1, 5),
(5, 2, 0, 0, 'Myself as a part of the group ', 4, 2026, 2, 5),
(6, 2, 0, 0, 'Being independent ', 4, 2026, 3, 5),
(7, 3, 0, 0, 'Different relationships in our lives ', 2, 2026, 1, 2),
(8, 3, 0, 0, 'The give and take in a relationship ', 2, 2026, 2, 2),
(9, 3, 0, 0, 'How relationship affect us', 2, 2026, 3, 2),
(10, 4, 0, 0, 'Making choices', 6, 2026, 1, 6),
(11, 4, 0, 0, 'How our actions can make a difference ', 6, 2026, 2, 6),
(12, 4, 0, 0, 'The IB Learner Profile ', 6, 2026, 3, 6),
(13, 5, 0, 0, 'Physical, Emotional, and Social growth ', 7, 2026, 1, 7),
(14, 5, 0, 0, 'Roles and responsibilities at home and school', 7, 2026, 2, 7),
(15, 5, 0, 0, 'Relationship between roles and capabilities', 7, 2026, 3, 7),
(16, 6, 0, 0, 'Daily habits and routines', 8, 2026, 1, 8),
(17, 6, 0, 0, 'Balanced choices', 8, 2026, 2, 8),
(18, 6, 0, 0, 'Consequences of choices', 8, 2026, 3, 8),
(19, 7, 0, 0, 'Individuals and their contributions', 9, 2026, 1, 9),
(20, 7, 0, 0, 'Identifying their characteristics', 9, 2026, 2, 9),
(21, 7, 0, 0, 'Influence of individuals on us ', 9, 2026, 3, 9),
(22, 8, 0, 0, 'Reasons for migration', 10, 2026, 1, 10),
(23, 8, 0, 0, 'Migration throughout history', 10, 2026, 2, 10),
(24, 8, 0, 0, 'Effects of migration on individuals, communities and culture ', 10, 2026, 3, 10),
(25, 9, 0, 0, 'Features of a myth ', 11, 2026, 1, 11),
(26, 9, 0, 0, 'Interpretations of myths ', 11, 2026, 2, 11),
(27, 9, 0, 0, 'The relevance of myths today ', 11, 2026, 3, 11),
(28, 2, 0, 0, 'Celebrations around the world ', 4, 2026, 1, 13),
(29, 2, 0, 0, 'Reasons why people celebrate ', 4, 2026, 2, 13),
(30, 2, 0, 0, 'Similarities and differences between celebrations', 4, 2026, 3, 13),
(31, 3, 0, 0, 'Stories can be shared creatively', 2, 2026, 1, 14),
(32, 3, 0, 0, 'How stories make us feel', 2, 2026, 2, 14),
(33, 3, 0, 0, 'A story and it’s elements ', 2, 2026, 3, 14),
(34, 4, 0, 0, 'Signs and symbols', 6, 2026, 1, 15),
(35, 4, 0, 0, 'Features of signs and symbols', 6, 2026, 2, 15),
(36, 4, 0, 0, 'How signs and symbols convey information ', 6, 2026, 3, 15),
(37, 5, 0, 0, 'Food sources', 7, 2026, 1, 16),
(38, 5, 0, 0, 'Processes that foods go through ', 7, 2026, 2, 16),
(39, 5, 0, 0, 'Food processes and our choices', 7, 2026, 3, 16),
(40, 6, 0, 0, 'Characteristics of a community', 8, 2026, 1, 17),
(41, 6, 0, 0, 'Communities in the past', 8, 2026, 2, 17),
(42, 6, 0, 0, 'Factors that contribute to change', 8, 2026, 3, 17),
(43, 7, 0, 0, 'Reasons for exploration', 9, 2026, 1, 18),
(44, 7, 0, 0, 'Discoveries and inventions made through explorations', 9, 2026, 2, 18),
(45, 7, 0, 0, 'Effects of explorations', 9, 2026, 3, 18),
(46, 8, 0, 0, 'Reasons for distribution of resources', 10, 2026, 1, 19),
(47, 8, 0, 0, 'Opportunities these resources provide ', 10, 2026, 2, 19),
(48, 8, 0, 0, 'Our responsibility towards resources ', 10, 2026, 3, 19),
(49, 9, 0, 0, 'World topography includes different landforms', 11, 2026, 1, 20),
(50, 9, 0, 0, 'Characteristics of culture', 11, 2026, 2, 20),
(51, 9, 0, 0, 'How topography affects culture', 11, 2026, 3, 20),
(52, 4, 0, 0, 'Characteristics of plants', 13, 2026, 1, 21),
(53, 4, 0, 0, 'How plants can be used as a resource', 13, 2026, 2, 21),
(54, 4, 0, 0, 'The conditions that the plants need to stay healthy ', 13, 2026, 3, 21),
(55, 5, 0, 0, 'Elements of art ', 14, 2026, 1, 22),
(56, 5, 0, 0, 'Diverse ways in which people express themselves', 14, 2026, 2, 22),
(57, 5, 0, 0, 'Translating our own ideas in different ways', 14, 2026, 3, 22),
(58, 6, 0, 0, 'Sound and its properties', 15, 2026, 1, 23),
(59, 6, 0, 0, 'Musical instruments and their working', 15, 2026, 2, 23),
(60, 6, 0, 0, 'Expressing through sound', 15, 2026, 3, 23),
(61, 7, 0, 0, 'Need for social order', 16, 2026, 1, 24),
(62, 7, 0, 0, 'Systems to ensure social order', 16, 2026, 2, 24),
(63, 7, 0, 0, 'Consequences of having systems', 16, 2026, 3, 24),
(64, 8, 0, 0, 'The different structures and functions of organizations', 17, 2026, 1, 25),
(65, 8, 0, 0, 'How decisions affect us', 17, 2026, 2, 25),
(66, 8, 0, 0, 'How we influence decisions', 17, 2026, 3, 25),
(67, 9, 0, 0, 'Need for sustainability ', 18, 2026, 1, 26),
(68, 9, 0, 0, 'Sustainable practices within the community', 18, 2026, 2, 26),
(69, 9, 0, 0, 'Barriers for sustainability', 18, 2026, 3, 26),
(70, 6, 0, 0, 'Patterns in nature and their causes', 15, 2026, 1, 28),
(71, 6, 0, 0, 'Instruments that help us learn about patterns', 15, 2026, 2, 28),
(72, 6, 0, 0, 'How understanding of patterns is used', 15, 2026, 3, 28),
(73, 4, 0, 0, 'Reasons people live in a community', 13, 2026, 1, 29),
(74, 4, 0, 0, 'Purpose of systems in a community', 13, 2026, 2, 29),
(75, 4, 0, 0, 'Roles and responsibilities in a community', 13, 2026, 3, 29),
(76, 5, 0, 0, 'Different tools people use', 14, 2026, 1, 30),
(77, 5, 0, 0, 'How we use different tools', 14, 2026, 2, 30),
(78, 5, 0, 0, 'How tools have evolved overtime', 14, 2026, 3, 30),
(79, 7, 0, 0, 'Properties of matter (Form)', 16, 2026, 1, 31),
(80, 7, 0, 0, 'How matter can be changed (Change)', 16, 2026, 2, 31),
(81, 7, 0, 0, 'How matter is used to meet people’s needs (Function, Change)', 16, 2026, 3, 31),
(82, 8, 0, 0, 'The body systems and how they work', 17, 2026, 1, 32),
(83, 8, 0, 0, 'The interconnectedness of the systems', 17, 2026, 2, 32),
(84, 8, 0, 0, 'How our actions impact our body systems', 17, 2026, 3, 32),
(85, 9, 0, 0, 'Forms of media', 18, 2026, 1, 33),
(86, 9, 0, 0, 'How media is used to organise social groups', 18, 2026, 2, 33),
(87, 9, 0, 0, 'Transformation of society', 18, 2026, 3, 33),
(88, 3, 0, 0, 'Animals and their characteristics', 19, 2026, 1, 34),
(89, 3, 0, 0, 'How animals depend on their habitat', 19, 2026, 2, 34),
(90, 3, 0, 0, 'Responsibility towards animals', 19, 2026, 3, 34),
(91, 2, 0, 0, 'Different types of transportation and their uses', 20, 2026, 1, 35),
(92, 2, 0, 0, 'Decisions involved in using transportation', 20, 2026, 2, 35),
(93, 2, 0, 0, 'Impact of transport choice', 20, 2026, 3, 35);

-- --------------------------------------------------------

--
-- Table structure for table "quotation"
--

CREATE TABLE IF NOT EXISTS "quotation" (
  "quotation_id"           SERIAL,
  "QuotNo"       VARCHAR(30)                        DEFAULT NULL,
  "QuotDate"     DATE                               DEFAULT NULL,
  "RID"          INT                                DEFAULT NULL,
  "unitprice"    NUMERIC(25,2)                        DEFAULT NULL,
  "quantity"     INT                                DEFAULT NULL,
  "total_price"  NUMERIC(30,2)                        DEFAULT NULL,
  "asset_id"     INT                                DEFAULT NULL,
  "vendor_id"    INT                                DEFAULT NULL,
  "status"       VARCHAR(50)  DEFAULT 'Not Processed',
  "POStatus"     VARCHAR(50)           DEFAULT 'Pending',
  "conditions"   TEXT,
  PRIMARY KEY ("quotation_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "quotation_trans"
--

CREATE TABLE IF NOT EXISTS "quotation_trans" (
  "id"         INT           DEFAULT NULL,
  "author"     VARCHAR(250)  DEFAULT NULL,
  "publisher"  VARCHAR(250)  DEFAULT NULL,
  "title"      VARCHAR(250)  DEFAULT NULL,
  "copies"     INT           DEFAULT NULL,
  "tid"        SERIAL,
  PRIMARY KEY ("tid")
);

-- --------------------------------------------------------

--
-- Table structure for table "receipt_details"
--

CREATE TABLE IF NOT EXISTS "receipt_details" (
  "RECEIPT_ID"        BIGINT        NOT NULL,
  "SL_NO"             BIGINT        DEFAULT NULL,
  "PRODUCT_ID"        BIGINT        DEFAULT NULL,
  "PRODUCT_NAME"      VARCHAR(100)  DEFAULT NULL,
  "QUANTITY"          INTEGER  DEFAULT NULL,
  "AMOUNT"            BIGINT        DEFAULT NULL,
  "TAX"               REAL         DEFAULT NULL,
  "DISCOUNT"          REAL         DEFAULT NULL,
  "PAYABLE"           REAL         DEFAULT NULL,
  "USER_NAME"         VARCHAR(50)   DEFAULT NULL,
  "DATE_OF_PURCHASE"  DATE          DEFAULT NULL,
  "TIME_OF_PURCHASE"  TIME          NOT NULL,
  PRIMARY KEY ("RECEIPT_ID")
);

-- --------------------------------------------------------

--
-- Table structure for table "receipt_totals"
--

CREATE TABLE IF NOT EXISTS "receipt_totals" (
  "RECEIPT_ID"        BIGSERIAL,
  "TOTAL_QUANTITY"    BIGINT       DEFAULT NULL,
  "TOTAL_AMOUNT"      REAL        DEFAULT NULL,
  "TOTAL_TAX"         REAL        DEFAULT NULL,
  "TOTAL_DISCOUNT"    REAL        DEFAULT NULL,
  "TOTAL_PAYABLE"     REAL        DEFAULT NULL,
  "USER_NAME"         VARCHAR(50)  DEFAULT NULL,
  "DATE_OF_PURCHASE"  DATE         DEFAULT NULL,
  "TIME_OF_PURCHASE"  TIME         NOT NULL,
  PRIMARY KEY ("RECEIPT_ID")
);

-- --------------------------------------------------------

--
-- Table structure for table "register"
--

CREATE TABLE IF NOT EXISTS "register" (
  "reg_no"                    SERIAL,
  "ish_start_date"            DATE          DEFAULT NULL,
  "student_id"                INT           DEFAULT NULL,
  "us_grade_level"            VARCHAR(55)   DEFAULT NULL,
  "student_email"             VARCHAR(55)   DEFAULT NULL,
  "passport_no"               VARCHAR(22)   DEFAULT NULL,
  "date_of_issue"             DATE          DEFAULT NULL,
  "date_of_expiration"        DATE          DEFAULT NULL,
  "visa_type"                 VARCHAR(10)   DEFAULT NULL,
  "other_type"                VARCHAR(100)  DEFAULT NULL,
  "other_type_x"              VARCHAR(100)  DEFAULT NULL,
  "pre_school_name"           VARCHAR(100)  DEFAULT NULL,
  "pre_school_language"       VARCHAR(22)   DEFAULT NULL,
  "pre_school_address"        VARCHAR(255)  DEFAULT NULL,
  "pre_school_city"           VARCHAR(22)   DEFAULT NULL,
  "pre_school_state"          VARCHAR(22)   DEFAULT NULL,
  "pre_school_country"        VARCHAR(22)   DEFAULT NULL,
  "pre_school_doj"            DATE          DEFAULT NULL,
  "pre_school_ldate"          DATE          DEFAULT NULL,
  "pre_school_grade_from"     VARCHAR(22)   DEFAULT NULL,
  "pre_school_grade_to"       VARCHAR(22)   DEFAULT NULL,
  "pre_school_cur_type"       VARCHAR(100)  DEFAULT NULL,
  "pre_school_year_begin"     DATE          DEFAULT NULL,
  "pre_school_name2"          VARCHAR(100)  DEFAULT NULL,
  "pre_school_language2"      VARCHAR(22)   DEFAULT NULL,
  "pre_school_address2"       VARCHAR(255)  DEFAULT NULL,
  "pre_school_city2"          VARCHAR(22)   DEFAULT NULL,
  "pre_school_state2"         VARCHAR(22)   DEFAULT NULL,
  "pre_school_country2"       VARCHAR(22)   DEFAULT NULL,
  "pre_school_doj2"           DATE          DEFAULT NULL,
  "pre_school_ldate2"         DATE          DEFAULT NULL,
  "pre_school_grade_from2"    VARCHAR(22)   DEFAULT NULL,
  "pre_school_grade_to2"      VARCHAR(22)   DEFAULT NULL,
  "pre_school_cur_type2"      VARCHAR(55)   DEFAULT NULL,
  "pre_school_year_begin2"    DATE          DEFAULT NULL,
  "ish_student"               VARCHAR(11)   DEFAULT NULL,
  "ish_student_from"          DATE          DEFAULT NULL,
  "ish_student_to"            DATE          DEFAULT NULL,
  "pre_ish_student"           VARCHAR(22)   DEFAULT NULL,
  "pre_ish_student_doj"       DATE          DEFAULT NULL,
  "student_native_lang"       VARCHAR(22)   DEFAULT NULL,
  "student_native_language2"  VARCHAR(22)   DEFAULT NULL,
  "student_home_lang"         VARCHAR(22)   DEFAULT NULL,
  "father_native_lang"        VARCHAR(22)   DEFAULT NULL,
  "father_native_language2"   VARCHAR(22)   DEFAULT NULL,
  "father_home_lang"          VARCHAR(22)   DEFAULT NULL,
  "mother_native_lang"        VARCHAR(22)   DEFAULT NULL,
  "mother_native_language2"   VARCHAR(22)   DEFAULT NULL,
  "mother_home_lang"          VARCHAR(22)   DEFAULT NULL,
  "eng_exp"                   VARCHAR(11)   DEFAULT NULL,
  "esl"                       VARCHAR(11)   DEFAULT NULL,
  "rem_inst"                  VARCHAR(11)   DEFAULT NULL,
  "retained"                  VARCHAR(11)   DEFAULT NULL,
  "ses"                       VARCHAR(11)   DEFAULT NULL,
  "award"                     VARCHAR(11)   DEFAULT NULL,
  "psy"                       VARCHAR(11)   DEFAULT NULL,
  "susp"                      VARCHAR(11)   DEFAULT NULL,
  "medication"                VARCHAR(11)   DEFAULT NULL,
  "phl"                       VARCHAR(11)   DEFAULT NULL,
  "cause"                     VARCHAR(255)  DEFAULT NULL,
  PRIMARY KEY ("reg_no")
);

-- --------------------------------------------------------

--
-- Table structure for table "religion"
--

CREATE TABLE IF NOT EXISTS "religion" (
  "religion_id"    SERIAL,
  "name"  VARCHAR(100)  DEFAULT NULL,
  PRIMARY KEY ("religion_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "requirementindent"
--

CREATE TABLE IF NOT EXISTS "requirementindent" (
  "requirementindent_id"                SERIAL,
  "RDate"             DATE                      DEFAULT NULL,
  "RINumber"          VARCHAR(20)               DEFAULT NULL,
  "School"           VARCHAR(100)              DEFAULT NULL,
  "person"            VARCHAR(150)              DEFAULT NULL,
  "asset_id"          INT                       DEFAULT NULL,
  "quantity"          INT                       DEFAULT NULL,
  "POStatus"          VARCHAR(50)  DEFAULT 'Pending',
  "dept_id"           INT                       DEFAULT NULL,
  "processed_qty"     INT                       DEFAULT 0,
  "quotation_status"  VARCHAR(50)          DEFAULT 'NO',
  "asgroup_id"        VARCHAR(10)               NOT NULL,
  PRIMARY KEY ("requirementindent_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "rfidois"
--

CREATE TABLE IF NOT EXISTS "rfidois" (
  "strudentid"  VARCHAR(255)  DEFAULT NULL,
  "rfid"        VARCHAR(255)  DEFAULT NULL,
  PRIMARY KEY ("strudentid")
);

--
-- Dumping data for table "rfidois"
--

INSERT INTO "rfidois" ("strudentid", "rfid") VALUES
('A738', '50E46B17000000000000000000000000'),
('A607', '22941917000000000000000000000000'),
('A582', '02D71817000000000000000000000000'),
('A597', '084B1917000000000000000000000000'),
('A546', '27C81917000000000000000000000000'),
('A461', '0B5F1917000000000000000000000000'),
('A467', '0B881817000000000000000000000000'),
('A458', '32981917000000000000000000000000'),
('A487', '723D6B17000000000000000000000000'),
('A499', '72D76B17000000000000000000000000');

-- --------------------------------------------------------

--
-- Table structure for table "rfid_card_type"
--

CREATE TABLE IF NOT EXISTS "rfid_card_type" (
  "rfid_card_type_id"      SERIAL,
  "name"    VARCHAR(100)  NOT NULL,
  "status"  SMALLINT    NOT NULL,
  PRIMARY KEY ("rfid_card_type_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "rfid_enrolment_user"
--

CREATE TABLE IF NOT EXISTS "rfid_enrolment_user" (
  "rfid_enrolment_user_id"          SERIAL,
  "rfid"        VARCHAR(50)  NOT NULL,
  "user"        VARCHAR(50)  NOT NULL,
  "user_type"   SMALLINT   NOT NULL,
  "add_date"    DATE         NOT NULL,
  "end_date"    DATE         NOT NULL,
  "status"      SMALLINT   NOT NULL,
  "active"      VARCHAR(1)   NOT NULL DEFAULT 'Y',
  "rfidAccess"  VARCHAR(1)   NOT NULL DEFAULT 'N',
  "desc"        TEXT         NOT NULL,
  PRIMARY KEY ("rfid_enrolment_user_id")
);

--
-- Dumping data for table "rfid_enrolment_user"
--

INSERT INTO "rfid_enrolment_user" ("rfid_enrolment_user_id", "rfid", "user", "user_type", "add_date", "end_date", "status", "active", "rfidAccess", "desc") VALUES
(1, 'C4B7A30E000000000000000000000000', '240', 2, NULL, NULL, 1, 'Y', 'Y', ''),
(2, 'DC080817000000000000000000000000', '192', 2, NULL, NULL, 1, 'Y', 'Y', ''),
(3, '55FD7617000000000000000000000000', '203', 2, NULL, NULL, 1, 'Y', 'Y', ''),
(4, 'F85B4892000000000000000000000000', '326', 2, NULL, NULL, 1, 'Y', 'Y', ''),
(5, 'F8FDB8F2000000000000000000000000', '325', 2, NULL, NULL, 1, 'Y', 'Y', ''),
(6, 'D0772717000000000000000000000000', '264', 2, NULL, NULL, 1, 'Y', 'Y', ''),
(7, '5D927C17000000000000000000000000', '208', 2, NULL, NULL, 1, 'Y', 'Y', ''),
(8, 'C4B74CDE000000000000000000000000', '231', 2, NULL, NULL, 1, 'Y', 'Y', ''),
(9, '6A9B7917000000000000000000000000', '238', 2, NULL, NULL, 1, 'Y', 'Y', ''),
(10, '52CC7917000000000000000000000000', '242', 2, NULL, NULL, 1, 'Y', 'Y', '');

-- --------------------------------------------------------

--
-- Table structure for table "rfid_mac_det"
--

CREATE TABLE IF NOT EXISTS "rfid_mac_det" (
  "rfid_mac_det_id"      SERIAL,
  "mac_id"  VARCHAR(50)   NOT NULL,
  "desc"    VARCHAR(250)  NOT NULL,
  "status"  SMALLINT    NOT NULL,
  PRIMARY KEY ("rfid_mac_det_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "rfid_masters"
--

CREATE TABLE IF NOT EXISTS "rfid_masters" (
  "rfid_masters_id"      SERIAL,
  "name"    VARCHAR(50)   NOT NULL,
  "desc"    VARCHAR(250)  NOT NULL,
  "status"  SMALLINT    NOT NULL,
  PRIMARY KEY ("rfid_masters_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "rfid_new_aug15"
--

CREATE TABLE IF NOT EXISTS "rfid_new_aug15" (
  "rfid_new_aug15_id"        SERIAL,
  "GRNumber"  VARCHAR(255)  DEFAULT NULL,
  "CardUID"   VARCHAR(255)  DEFAULT NULL,
  "Checked"   VARCHAR(255)  DEFAULT NULL,
  "cardid"    VARCHAR(255)  DEFAULT NULL,
  "color"     VARCHAR(255)  DEFAULT NULL,
  PRIMARY KEY ("rfid_new_aug15_id")
);

--
-- Dumping data for table "rfid_new_aug15"
--

INSERT INTO "rfid_new_aug15" ("GRNumber", "CardUID", "Checked", "cardid", "color") VALUES
('A377', '63CB7817000000000000000000000000', 'Checked', NULL, '0'),
('A509', '59397917000000000000000000000000', 'Checked', NULL, '0'),
('A304', '6A337A17000000000000000000000000', 'Checked', NULL, '0'),
('A473', '4FC47817000000000000000000000000', 'Checked', NULL, '0'),
('A022', '7F547A17000000000000000000000000', 'Checked', NULL, '0'),
('A670', '75337A17000000000000000000000000', 'Checked', NULL, '0'),
('A590', '6C397817000000000000000000000000', 'Checked', NULL, '0'),
('A244', '7A037A17000000000000000000000000', 'Checked', NULL, '0'),
('A143', '68786B17000000000000000000000000', 'Checked', NULL, '0'),
('A245', '6DA36B17000000000000000000000000', 'Checked', NULL, '0');

-- --------------------------------------------------------

--
-- Table structure for table "rfid_reader_master"
--

CREATE TABLE IF NOT EXISTS "rfid_reader_master" (
  "rfid_reader_master_id"          SERIAL,
  "readerName"  VARCHAR(50)  NOT NULL,
  "readerip"    VARCHAR(50)  NOT NULL,
  "turnstile"   VARCHAR(50)  NOT NULL,
  "type"        INT          NOT NULL,
  "desc"        TEXT         NOT NULL,
  "status"      SMALLINT   NOT NULL,
  PRIMARY KEY ("rfid_reader_master_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "rfid_staff_check_in"
--

CREATE TABLE IF NOT EXISTS "rfid_staff_check_in" (
  "rfid_staff_check_in_id"            SERIAL,
  "controllerip"  VARCHAR(40)  NOT NULL,
  "readerno"      VARCHAR(40)  NOT NULL,
  "rfidno"        VARCHAR(40)  NOT NULL,
  "att_date"      DATE         NOT NULL,
  "att_time"      TIME         NOT NULL,
  "user"          INT          NOT NULL DEFAULT 0,
  "type"          INT          NOT NULL DEFAULT 2,
  "status"        INT          NOT NULL DEFAULT 0,
  PRIMARY KEY ("rfid_staff_check_in_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "rfid_staff_check_out"
--

CREATE TABLE IF NOT EXISTS "rfid_staff_check_out" (
  "rfid_staff_check_out_id"            SERIAL,
  "controllerip"  VARCHAR(40)  NOT NULL,
  "readerno"      VARCHAR(40)  NOT NULL,
  "rfidno"        VARCHAR(40)  NOT NULL,
  "att_date"      DATE         NOT NULL,
  "att_time"      TIME         NOT NULL,
  "user"          INT          NOT NULL DEFAULT 0,
  "type"          INT          NOT NULL DEFAULT 2,
  "status"        INT          NOT NULL DEFAULT 0,
  PRIMARY KEY ("rfid_staff_check_out_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "rfid_student"
--

CREATE TABLE IF NOT EXISTS "rfid_student" (
  "rfid_student_id"            SERIAL,
  "to_day_date"   DATE         NOT NULL,
  "controllerip"  VARCHAR(40)  NOT NULL,
  "readerno"      VARCHAR(40)  NOT NULL,
  "rfidno"        VARCHAR(40)  NOT NULL,
  "att_date"      DATE         NOT NULL,
  "att_time"      TIME         NOT NULL,
  "studid"        INT          NOT NULL,
  "status"        INT          NOT NULL DEFAULT 1,
  "delt"          VARCHAR(2)   NOT NULL,
  PRIMARY KEY ("rfid_student_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "rfid_user_access"
--

CREATE TABLE IF NOT EXISTS "rfid_user_access" (
  "rfid_user_access_id"         SERIAL,
  "user_type"  INT         NOT NULL,
  "userid"     INT         NOT NULL,
  "food"       SMALLINT  NOT NULL,
  "trans"      SMALLINT  NOT NULL,
  "status"     SMALLINT  NOT NULL,
  PRIMARY KEY ("rfid_user_access_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "route_master"
--

CREATE TABLE IF NOT EXISTS "route_master" (
  "route_master_id"          SERIAL,
  "route_code"  VARCHAR(25)  DEFAULT NULL,
  "route_name"  VARCHAR(50)  DEFAULT NULL,
  PRIMARY KEY ("route_master_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "route_vechile_details"
--

CREATE TABLE IF NOT EXISTS "route_vechile_details" (
  "route_vechile_details_id"          SERIAL,
  "vechile_id"  INT  DEFAULT NULL,
  "route_id"    INT  DEFAULT NULL,
  "driver_id"   INT  DEFAULT NULL,
  PRIMARY KEY ("route_vechile_details_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "sal_head"
--

CREATE TABLE IF NOT EXISTS "sal_head" (
  "sal_head_id"         SERIAL,
  "name"       VARCHAR(50)  NOT NULL DEFAULT '',
  "type"       INT          NOT NULL DEFAULT 0,
  "col_id"     INT          DEFAULT NULL,
  "status"     SMALLINT   DEFAULT 1,
  "ledger_id"  VARCHAR(20)  DEFAULT NULL,
  PRIMARY KEY ("sal_head_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "sanction_intake"
--

CREATE TABLE IF NOT EXISTS "sanction_intake" (
  "sanction_intake_id"              SERIAL,
  "course_id"       INT         DEFAULT NULL,
  "course_year_id"  INT         DEFAULT NULL,
  "intake"          INT         DEFAULT NULL,
  "status"          SMALLINT  DEFAULT 1,
  PRIMARY KEY ("sanction_intake_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "staff_lv_data_feb19"
--

CREATE TABLE IF NOT EXISTS "staff_lv_data_feb19" (
  "staff_lv_data_feb19_id"                SERIAL,
  "Sr_No"             VARCHAR(255)  DEFAULT NULL,
  "Employee_Code"     VARCHAR(255)  DEFAULT NULL,
  "MySchoo_Staff_ID"  VARCHAR(255)  DEFAULT NULL,
  "Employee_Name"     VARCHAR(255)  DEFAULT NULL,
  "Category"          VARCHAR(255)  DEFAULT NULL,
  "Official_Email"    VARCHAR(255)  DEFAULT NULL,
  "UD_ID_no"          VARCHAR(255)  DEFAULT NULL,
  PRIMARY KEY ("staff_lv_data_feb19_id")
);

--
-- Dumping data for table "staff_lv_data_feb19"
--

INSERT INTO "staff_lv_data_feb19" ("Sr_No", "Employee_Code", "MySchoo_Staff_ID", "Employee_Name", "Category", "Official_Email", "UD_ID_no") VALUES
('1', '8730', 'RD-S46010', 'Radhakrishna Suvarna', 'Non Teaching', 'radhakrishna.suvarna@email.com', 'CB560717000000000000000000000000'),
('2', '8834', 'RD-S460013', 'Suhas Jadhav', 'Non Teaching', 'suhas.jadhav@email.com', 'C4BB1E4E000000000000000000000000'),
('3', '8007', 'RD-S20268', 'Agnel  Waz', 'Non Teaching', 'agnel.waz@email.com', 'C4B7A30E000000000000000000000000'),
('4', '8201', 'RD-S2016', 'Gayatri Padhye', 'Non Teaching', 'gayatri.padhye@email.com', 'C4BA6BFE000000000000000000000000'),
('5', '8991', 'RD-S21120', 'Simon Aroza', 'Non Teaching', 'simon.aroza@email.com', 'A46B401D000000000000000000000000'),
('6', '8015', 'RD-S46009', 'Anil Mane', 'Non Teaching', 'anil.mane @email.com', 'D0772717000000000000000000000000'),
('7', '8016', 'RD-S0555', 'Anju Agrawal', 'Non Teaching', 'anju.agrawal@email.com', 'DC080817000000000000000000000000'),
('8', '8741', 'RD-S460011', 'Rupali Roy', 'Non Teaching', 'rupali.roy@email.com', 'D8570917000000000000000000000000'),
('9', '8418', 'RD-S46001', 'Merina Dabre', 'Non Teaching', 'merina.dabre@email.com', 'EC222617000000000000000000000000'),
('10', '8859', 'RD-S460016', 'Sapna Khandekar', 'Non Teaching', 'sapna.khandekar@email.com', 'C4B7DD1E000000000000000000000000');

-- --------------------------------------------------------

--
-- Table structure for table "sec_hospital"
--

CREATE TABLE IF NOT EXISTS "sec_hospital" (
  "sec_hospital_id"        SERIAL,
  "hos_name"  VARCHAR(11)  NOT NULL,
  "position"  INT          NOT NULL,
  "status"    INT          NOT NULL DEFAULT 1,
  PRIMARY KEY ("sec_hospital_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "services"
--

CREATE TABLE IF NOT EXISTS "services" (
  "SERVICE_ID"    BIGSERIAL,
  "SERVICE_NAME"  VARCHAR(200)     NOT NULL,
  "AMOUNT"        BIGINT  DEFAULT NULL,
  "SERVICE_CODE"  VARCHAR(20)      NOT NULL,
  "QUANTITY"      BIGINT  DEFAULT NULL,
  "CATEGORY"      INTEGER     DEFAULT NULL,
  PRIMARY KEY ("SERVICE_ID")
);

CREATE UNIQUE INDEX "SERVICE_ID" ON "services" ("SERVICE_ID");

-- --------------------------------------------------------

--
-- Table structure for table "service_gatepass_details"
--

CREATE TABLE IF NOT EXISTS "service_gatepass_details" (
  "service_gatepass_details_id"                   SERIAL,
  "gatepass_id"          INT               DEFAULT NULL,
  "item_code_id"         INT               DEFAULT NULL,
  "location_id"          INT               DEFAULT NULL,
  "returned"             VARCHAR(50)  DEFAULT 'NO',
  "issue_status"         VARCHAR(50)  DEFAULT 'NO',
  "completely_received"  VARCHAR(50)  DEFAULT 'NO',
  "issuedt"              DATE              DEFAULT NULL,
  "issuetodept"          VARCHAR(4)        DEFAULT 'NO',
  PRIMARY KEY ("service_gatepass_details_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "sessional_master"
--

CREATE TABLE IF NOT EXISTS "sessional_master" (
  "Sl_No"           SERIAL,
  "Sessional_ID"    VARCHAR(10)       DEFAULT NULL,
  "Sessional_Name"  VARCHAR(20)       DEFAULT NULL,
  "Course_ID"       VARCHAR(20)       DEFAULT NULL,
  "Course_Year_ID"  VARCHAR(10)       DEFAULT NULL,
  "activated"       VARCHAR(50)  DEFAULT 'On',
  "Academic_Year"   INT               DEFAULT 0,
  "From_Date"       DATE              DEFAULT NULL,
  "To_Date"         DATE              DEFAULT NULL,
  PRIMARY KEY ("Sl_No")
);

-- --------------------------------------------------------

--
-- Table structure for table "settings"
--

CREATE TABLE IF NOT EXISTS "settings" (
  "SETTING_ID"     SERIAL,
  "SETTING_NAME"   VARCHAR(50)   NOT NULL DEFAULT 0,
  "SETTING_VALUE"  REAL         DEFAULT 0,
  PRIMARY KEY ("SETTING_ID")
);

CREATE UNIQUE INDEX "SETTING_ID" ON "settings" ("SETTING_ID");


-- --------------------------------------------------------

--
-- Table structure for table "skill_grade"
--

CREATE TABLE IF NOT EXISTS "skill_grade" (
  "skill_grade_id"          BIGSERIAL,
  "divi"        INT         NOT NULL,
  "class"       INT         NOT NULL,
  "sec"         INT         NOT NULL,
  "student_id"  INT         NOT NULL,
  "skill"       INT         NOT NULL,
  "acc_year"    INT         NOT NULL,
  "eval1"       VARCHAR(4)  NOT NULL,
  "eval2"       VARCHAR(4)  NOT NULL,
  "eval3"       VARCHAR(4)  NOT NULL,
  PRIMARY KEY ("skill_grade_id")
);

--
-- Dumping data for table "skill_grade"
--

INSERT INTO "skill_grade" ("skill_grade_id", "divi", "class", "sec", "student_id", "skill", "acc_year", "eval1", "eval2", "eval3") VALUES
(1, 3, 5, 1, 10, 1, 2026, '20', '22', ''),
(2, 3, 5, 1, 10, 2, 2026, '13', '43', ''),
(3, 3, 5, 1, 10, 3, 2026, '33', '33', ''),
(4, 3, 5, 1, 10, 4, 2026, '33', '33', ''),
(5, 3, 5, 1, 10, 5, 2026, '11', '22', ''),
(6, 3, 5, 1, 10, 6, 2026, '32', '32', ''),
(7, 3, 5, 1, 10, 7, 2026, '23', '21', ''),
(8, 3, 5, 1, 10, 8, 2026, '32', '21', ''),
(9, 3, 5, 1, 10, 9, 2026, '22', '21', ''),
(10, 3, 5, 1, 10, 10, 2026, '12', '32', ''),
(11, 3, 5, 1, 10, 11, 2026, '22', '32', ''),
(12, 3, 5, 1, 10, 12, 2026, '12', '21', ''),
(13, 3, 5, 1, 10, 13, 2026, '23', '12', ''),
(14, 3, 5, 1, 10, 14, 2026, '32', '23', ''),
(15, 3, 5, 1, 10, 15, 2026, '32', '11', ''),
(16, 3, 5, 1, 10, 16, 2026, '22', '22', ''),
(17, 3, 5, 1, 10, 17, 2026, '22', '22', ''),
(18, 3, 5, 1, 10, 18, 2026, '33', '22', ''),
(19, 3, 5, 1, 10, 19, 2026, '22', '23', ''),
(20, 3, 5, 1, 10, 20, 2026, '32', '44', ''),
(21, 3, 5, 1, 10, 21, 2026, '12', '32', ''),
(22, 3, 5, 1, 10, 22, 2026, '17', '28', ''),
(23, 3, 5, 1, 10, 23, 2026, '32', '33', ''),
(24, 3, 5, 1, 10, 24, 2026, '23', '21', ''),
(25, 3, 5, 1, 10, 25, 2026, '33', '22', ''),
(26, 3, 5, 1, 10, 26, 2026, '11', '22', '');

-- --------------------------------------------------------

--
-- Table structure for table "skill_grade_desc"
--

CREATE TABLE IF NOT EXISTS "skill_grade_desc" (
  "skill_grade_desc_id"          BIGSERIAL,
  "exam_id"     INT     NOT NULL,
  "class"       INT     NOT NULL,
  "sec"         INT     NOT NULL,
  "sub"         INT     NOT NULL,
  "student_id"  INT     NOT NULL,
  "acc_year"    INT     NOT NULL,
  "desc1"       TEXT    NOT NULL,
  PRIMARY KEY ("skill_grade_desc_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "skill_grade_ib"
--

CREATE TABLE IF NOT EXISTS "skill_grade_ib" (
  "skill_grade_ib_id"          BIGSERIAL,
  "divi"        INT         NOT NULL,
  "class"       INT         NOT NULL,
  "exam"        INT         NOT NULL,
  "student_id"  INT         NOT NULL,
  "subject"     INT         NOT NULL,
  "acc_year"    INT         NOT NULL,
  "skill1"      INT         NOT NULL,
  "skill2"      INT         NOT NULL,
  "skill3"      INT         NOT NULL,
  "skill4"      INT         NOT NULL,
  "skill5"      INT         NOT NULL,
  "skill6"      INT         NOT NULL,
  "skill7"      INT         NOT NULL,
  "skill8"      INT         NOT NULL,
  "skill9"      INT         NOT NULL,
  "skill10"     INT         NOT NULL,
  "totalmark"   INT         NOT NULL,
  "ibgrade"     INT         NOT NULL,
  "aproach1"    SMALLINT  NOT NULL,
  "aproach2"    SMALLINT  NOT NULL,
  "aproach3"    SMALLINT  NOT NULL,
  "aproach4"    SMALLINT  NOT NULL,
  "aproach5"    SMALLINT  NOT NULL,
  "aproach6"    SMALLINT  NOT NULL,
  "aproach7"    SMALLINT  NOT NULL,
  "aproach8"    SMALLINT  NOT NULL,
  "aproach9"    SMALLINT  NOT NULL,
  "aproach10"   SMALLINT  NOT NULL,
  "comments"    TEXT        NOT NULL,
  PRIMARY KEY ("skill_grade_ib_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "special_trip_entry"
--

CREATE TABLE IF NOT EXISTS "special_trip_entry" (
  "special_trip_entry_id"              SERIAL,
  "req_given_by"    VARCHAR(60)   DEFAULT NULL,
  "trip_details"    VARCHAR(100)  DEFAULT NULL,
  "pick_up_time"    VARCHAR(10)   DEFAULT NULL,
  "departure_time"  VARCHAR(10)   DEFAULT NULL,
  "vechile_name"    INT           DEFAULT NULL,
  "Driver_name"     VARCHAR(100)  DEFAULT NULL,
  "helper_name"     VARCHAR(100)  DEFAULT NULL,
  "date"            DATE          DEFAULT NULL,
  PRIMARY KEY ("special_trip_entry_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "spl_advances"
--

CREATE TABLE IF NOT EXISTS "spl_advances" (
  "spl_advances_id"        SERIAL,
  "div"       INT     NOT NULL,
  "class"     INT     NOT NULL,
  "acc_year"  INT     NOT NULL,
  "price"     BIGINT  NOT NULL,
  "status"    INT     NOT NULL,
  PRIMARY KEY ("spl_advances_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "spl_advances_coll"
--

CREATE TABLE IF NOT EXISTS "spl_advances_coll" (
  "spl_advances_coll_id"            BIGSERIAL,
  "div"           INT           NOT NULL,
  "class"         INT           NOT NULL,
  "acc_year"      INT           NOT NULL,
  "student_id"    BIGINT        NOT NULL,
  "col_amount"    NUMERIC(18,2)  NOT NULL,
  "spent_amount"  NUMERIC(18,2)  NOT NULL,
  "bal_amount"    NUMERIC(18,2)  NOT NULL,
  "col_date"      DATE          NOT NULL,
  "desc"          TEXT          NOT NULL,
  "status"        SMALLINT    NOT NULL,
  PRIMARY KEY ("spl_advances_coll_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "sta"
--

CREATE TABLE IF NOT EXISTS "sta" (
  "sta_id"            SERIAL,
  "srno"          VARCHAR(255)  DEFAULT NULL,
  "employeecode"  VARCHAR(255)  DEFAULT NULL,
  "employeename"  VARCHAR(255)  DEFAULT NULL,
  "carduid"       VARCHAR(255)  DEFAULT NULL,
  "employeetype"  VARCHAR(255)  DEFAULT NULL,
  "category"      VARCHAR(255)  DEFAULT NULL,
  "department"    VARCHAR(255)  DEFAULT NULL,
  "emailid"       VARCHAR(255)  DEFAULT NULL,
  PRIMARY KEY ("sta_id")
);

--
-- Dumping data for table "sta"
--

INSERT INTO "sta" ("srno", "employeecode", "employeename", "carduid", "employeetype", "category", "department", "emailid") VALUES
('1', '8007', 'Agnel Waz', 'C4B7A30E000000000000000000000000', 'Current Employee', 'Non Teaching', 'Support - Nurse', 'agnel.waz@email.com'),
('2', '8015', 'Anil Mane', 'D0772717000000000000000000000000', 'Current Employee', 'Non Teaching', 'Library', 'anil.mane @email.com'),
('3', '8016', 'Anju Agrawal', 'DC080817000000000000000000000000', 'Current Employee', 'Non Teaching', 'Marketing, Admissions and Communications', 'anju.agrawal@email.com'),
('4', '8020', 'Archana Mestry', 'DCF40717000000000000000000000000', 'Current Employee', 'Non Teaching', 'HR', 'archana.mestry@email.com'),
('5', '8022', 'Anisha Punjabi', 'E4720217000000000000000000000000', 'Current Employee', 'Non Teaching', 'Support - Secretary', 'anisha.punjabi@email.com'),
('6', '8040', 'Priti Sharma', '55FD7617000000000000000000000000', 'Current Employee', 'Non Teaching', 'Marketing, Admissions and Communications', 'priti.sharma@email.com '),
('7', '8042', 'Priyanka Gujarathy', '7A8A6B17000000000000000000000000', 'Current Employee', 'Non Teaching', 'Accounts', 'priyanka.gujarathy@email.com'),
('8', '8062', 'Uday Mistry', '3A031817000000000000000000000000', 'Current Employee', 'Non Teaching', 'Accounts', 'uday.mistry@email.com'),
('9', '8201', 'Gayatri Padhye', 'C4BA6BFE000000000000000000000000', 'Current Employee', 'Non Teaching', 'Administration', 'gayatri.padhye@email.com'),
('10', '8203', 'Vinayak More', '79967717000000000000000000000000', 'Current Employee', 'Non Teaching', 'Administration', 'vinayak.more@email.com ');

-- --------------------------------------------------------

--
-- Table structure for table "staff_archive_status"
--

CREATE TABLE IF NOT EXISTS "staff_archive_status" (
  "staff_archive_status_id"      SERIAL,
  "status"  VARCHAR(30)  DEFAULT NULL,
  PRIMARY KEY ("staff_archive_status_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "staff_att"
--

CREATE TABLE IF NOT EXISTS "staff_att" (
  "staff_att_id"        SERIAL,
  "staff_id"  INT         NOT NULL,
  "bio_id"    INT         NOT NULL,
  "amonth"    INT         NOT NULL,
  "ayear"     INT         NOT NULL,
  "m01"       VARCHAR(2)  NOT NULL,
  "a01"       VARCHAR(2)  NOT NULL,
  "m02"       VARCHAR(2)  NOT NULL,
  "a02"       VARCHAR(2)  NOT NULL,
  "m03"       VARCHAR(2)  NOT NULL,
  "a03"       VARCHAR(2)  NOT NULL,
  "m04"       VARCHAR(2)  NOT NULL,
  "a04"       VARCHAR(2)  NOT NULL,
  "m05"       VARCHAR(2)  NOT NULL,
  "a05"       VARCHAR(2)  NOT NULL,
  "m06"       VARCHAR(2)  NOT NULL,
  "a06"       VARCHAR(2)  NOT NULL,
  "m07"       VARCHAR(2)  NOT NULL,
  "a07"       VARCHAR(2)  NOT NULL,
  "m08"       VARCHAR(2)  NOT NULL,
  "a08"       VARCHAR(2)  NOT NULL,
  "m09"       VARCHAR(2)  NOT NULL,
  "a09"       VARCHAR(2)  NOT NULL,
  "m10"       VARCHAR(2)  NOT NULL,
  "a10"       VARCHAR(2)  NOT NULL,
  "m11"       VARCHAR(2)  NOT NULL,
  "a11"       VARCHAR(2)  NOT NULL,
  "m12"       VARCHAR(2)  NOT NULL,
  "a12"       VARCHAR(2)  NOT NULL,
  "m13"       VARCHAR(2)  NOT NULL,
  "a13"       VARCHAR(2)  NOT NULL,
  "m14"       VARCHAR(2)  NOT NULL,
  "a14"       VARCHAR(2)  NOT NULL,
  "m15"       VARCHAR(2)  NOT NULL,
  "a15"       VARCHAR(2)  NOT NULL,
  "m16"       VARCHAR(2)  NOT NULL,
  "a16"       VARCHAR(2)  NOT NULL,
  "m17"       VARCHAR(2)  NOT NULL,
  "a17"       VARCHAR(2)  NOT NULL,
  "m18"       VARCHAR(2)  NOT NULL,
  "a18"       VARCHAR(2)  NOT NULL,
  "m19"       VARCHAR(2)  NOT NULL,
  "a19"       VARCHAR(2)  NOT NULL,
  "m20"       VARCHAR(2)  NOT NULL,
  "a20"       VARCHAR(2)  NOT NULL,
  "m21"       VARCHAR(2)  NOT NULL,
  "a21"       VARCHAR(2)  NOT NULL,
  "m22"       VARCHAR(2)  NOT NULL,
  "a22"       VARCHAR(2)  NOT NULL,
  "m23"       VARCHAR(2)  NOT NULL,
  "a23"       VARCHAR(2)  NOT NULL,
  "m24"       VARCHAR(2)  NOT NULL,
  "a24"       VARCHAR(2)  NOT NULL,
  "m25"       VARCHAR(2)  NOT NULL,
  "a25"       VARCHAR(2)  NOT NULL,
  "m26"       VARCHAR(2)  NOT NULL,
  "a26"       VARCHAR(2)  NOT NULL,
  "m27"       VARCHAR(2)  NOT NULL,
  "a27"       VARCHAR(2)  NOT NULL,
  "m28"       VARCHAR(2)  NOT NULL,
  "a28"       VARCHAR(2)  NOT NULL,
  "m29"       VARCHAR(2)  NOT NULL,
  "a29"       VARCHAR(2)  NOT NULL,
  "m30"       VARCHAR(2)  NOT NULL,
  "a30"       VARCHAR(2)  NOT NULL,
  "m31"       VARCHAR(2)  NOT NULL,
  "a31"       VARCHAR(2)  NOT NULL,
  PRIMARY KEY ("staff_att_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "staff_att_updt"
--

CREATE TABLE IF NOT EXISTS "staff_att_updt" (
  "staff_att_updt_id"              SERIAL,
  "leave_approval"  INT           NOT NULL,
  "staff_id"        INT           NOT NULL,
  "user"            VARCHAR(255)  NOT NULL,
  "toddate"         DATE          NOT NULL,
  "todtime"         TIME          NOT NULL,
  "type"            VARCHAR(255)  NOT NULL,
  PRIMARY KEY ("staff_att_updt_id")
);

--
-- Dumping data for table "staff_att_updt"
--

INSERT INTO "staff_att_updt" ("staff_att_updt_id", "leave_approval", "staff_id", "user", "toddate", "todtime", "type") VALUES
(1, 0, 4, 'administrator', '2026-10-30', '11:19:22', '3'),
(2, 0, 161, 'lesterd', '2026-11-14', '08:48:53', '1'),
(3, 0, 170, 'lesterd', '2026-11-14', '08:49:45', '4'),
(4, 0, 188, 'administrator', '2026-01-17', '11:45:29', '1'),
(5, 0, 69, 'pujas', '2026-01-23', '16:40:05', '6'),
(6, 0, 281, 'administrator', '2026-01-22', '12:11:55', '10'),
(7, 0, 281, 'administrator', '2026-01-23', '12:14:11', '10'),
(8, 0, 244, 'pujas', '2026-01-18', '15:22:53', '6'),
(9, 0, 281, 'administrator', '2026-01-30', '02:17:57', '1'),
(10, 0, 170, 'administrator', '2026-01-30', '00:01:24', '1');

-- --------------------------------------------------------

--
-- Table structure for table "staff_calenders"
--

CREATE TABLE IF NOT EXISTS "staff_calenders" (
  "staff_calenders_id"           SERIAL,
  "acc_year"     INT           NOT NULL,
  "staff_typ"    INT           NOT NULL,
  "username"     VARCHAR(30)   NOT NULL,
  "fromdate"     DATE          NOT NULL,
  "title"        VARCHAR(200)  NOT NULL,
  "description"  TEXT          NOT NULL,
  "status"       SMALLINT    NOT NULL,
  PRIMARY KEY ("staff_calenders_id")
);

--
-- Dumping data for table "staff_calenders"
--

INSERT INTO "staff_calenders" ("staff_calenders_id", "acc_year", "staff_typ", "username", "fromdate", "title", "description", "status") VALUES
(30, 2026, 1, 'administrator', '2026-10-21', 'Staff Holiday', 'Staff holiday', 1),
(31, 2026, 1, 'administrator', '2026-11-25', 'Early school sports day', 'Early school sports day', 1),
(32, 2026, 2, 'administrator', '2026-11-25', 'Early school sports day', 'Early school sports day', 0),
(33, 2026, 1, 'administrator', '2026-11-27', 'Primary years sports Day', 'Primary years sports Day', 1),
(34, 2026, 1, 'administrator', '2026-11-29', 'Secondary school sports day', '', 1),
(35, 2026, 1, 'administrator', '2026-11-01', 'Autumn/Diwali Break', '', 1),
(36, 2026, 1, 'administrator', '2026-11-02', 'Weeakend', '', 0),
(37, 2026, 1, 'administrator', '2026-11-04', 'Autumn/Diwali Break', '', 1),
(38, 2026, 1, 'administrator', '2026-11-05', 'Autumn/Diwali Break', '', 1),
(39, 2026, 1, 'administrator', '2026-11-06', 'Autumn/Diwali Break', '', 1),
(40, 2026, 1, 'administrator', '2026-11-07', 'Autumn/Diwali Break', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table "staff_class_group"
--

CREATE TABLE IF NOT EXISTS "staff_class_group" (
  "staff_class_group_id"         SERIAL,
  "group_id"   INT           NOT NULL,
  "section"    INT           NOT NULL,
  "grade"      INT           NOT NULL,
  "sub"        INT           NOT NULL,
  "username"   VARCHAR(255)  NOT NULL,
  "store_ids"  INT           NOT NULL,
  "staff_id"   INT           NOT NULL,
  "status"     INT           NOT NULL,
  PRIMARY KEY ("staff_class_group_id")
);

--
-- Dumping data for table "staff_class_group"
--

INSERT INTO "staff_class_group" ("staff_class_group_id", "group_id", "section", "grade", "sub", "username", "store_ids", "staff_id", "status") VALUES
(1, 2, 382, 13, 276, 'administrator', 44249, 20, 1),
(2, 2, 197, 13, 279, 'administrator', 44249, 20, 1),
(3, 2, 193, 13, 279, 'administrator', 44249, 20, 1),
(4, 2, 195, 13, 280, 'administrator', 44249, 20, 1),
(5, 2, 940, 13, 368, 'administrator', 44249, 20, 1),
(6, 2, 180, 13, 277, 'administrator', 44249, 20, 1),
(7, 2, 85, 13, 149, 'administrator', 44249, 20, 1),
(8, 2, 352, 13, 145, 'administrator', 44249, 20, 1),
(9, 2, 199, 13, 142, 'administrator', 44249, 20, 1),
(10, 2, 190, 13, 142, 'administrator', 44249, 20, 1);

-- --------------------------------------------------------

--
-- Table structure for table "staff_default"
--

CREATE TABLE IF NOT EXISTS "staff_default" (
  "staff_default_id"        SERIAL,
  "status"    INT           NOT NULL,
  "reason"    TEXT          NOT NULL,
  "time_in"   VARCHAR(255)  DEFAULT NULL,
  "time_out"  VARCHAR(255)  DEFAULT NULL,
  "d_date"    VARCHAR(255)  DEFAULT NULL,
  "user"      VARCHAR(255)  DEFAULT NULL,
  "staff_id"  INT           NOT NULL,
  "ins_date"  VARCHAR(255)  DEFAULT NULL,
  PRIMARY KEY ("staff_default_id")
);

--
-- Dumping data for table "staff_default"
--

INSERT INTO "staff_default" ("staff_default_id", "status", "reason", "time_in", "time_out", "d_date", "user", "staff_id", "ins_date") VALUES
(1, 1, 'test', '', '17:00', '2026-02-12', 'ishwarb', 244, '2026-02-04 17:53:02'),
(2, 1, 'test', '08:25', '17:00', '2026-02-18', 'ishwarb', 244, '2026-02-19 14:53:02'),
(3, 1, 'test  now', '08:25', '18:25', '2026-01-13', 'pujas', 250, '2026-02-24 19:28:02'),
(4, 1, 'Forget', '', '16:10', '2026-02-28', 'soumyag', 232, '2026-03-07 14:52:03'),
(5, 1, 'Forget', '07:40', '16:10', '2026-02-27', 'soumyag', 232, '2026-03-07 14:58:03'),
(6, 1, 'Not punch', '08:00', '17:00', '2026-03-03', 'jaywantp', 269, '2026-03-07 16:36:03'),
(7, 1, 'Forget to punch', '08:00', '18:25', '2026-03-04', 'jaywantp', 269, '2026-03-07 16:42:03'),
(8, 1, 'Forgot', '', '17:15', '2026-02-25', 'jagrutic', 190, '2026-03-10 10:05:03'),
(9, 1, 'Forgot', '', '15:00', '2026-02-21', 'erich', 38, '2026-03-10 10:16:03'),
(10, 1, 'Forgot', '07:30', '16:40', '2026-02-24', 'richag', 21, '2026-03-10 10:22:03'),
(11, 1, 'Forgot', '', '17:30', '2026-02-28', 'ianm', 40, '2026-03-10 10:26:03'),
(12, 1, 'Forgot', '', '17:30', '2026-03-03', 'vijayk', 263, '2026-03-10 10:32:03'),
(13, 1, 'Forgot', '', '15:30', '2026-02-27', 'seemapo', 294, '2026-03-10 10:35:03'),
(14, 1, 'Forget', '07:30', '16:15', '2026-02-25', 'sonian', 85, '2026-03-10 10:53:03'),
(15, 1, 'Forgot', '', '16:30', '2026-02-25', 'jalpas', 172, '2026-03-10 13:55:03'),
(16, 1, 'Forgot', '07:40', '16:40', '2026-02-24', 'nikhats', 121, '2026-03-10 14:04:03'),
(17, 1, 'Test', '08:00', '17:00', '2026-02-20', 'soumendran', 249, '2026-03-10 16:08:03'),
(18, 1, 'Forget', '', '17:00', '2026-03-10', 'soumendran', 249, '2026-03-11 13:01:03'),
(19, 1, 'test', '05:10', '13:25', '2026-03-10', 'archanam', 246, '2026-03-11 15:55:03'),
(20, 1, 'test', '08:05', '17:00', '2026-03-07', 'chaitalig', 247, '2026-03-13 10:54:03'),
(21, 1, 'Forget', '', '17:00', '2026-02-21', 'jenniferk', 287, '2026-03-15 15:58:03'),
(22, 1, 'Forget', '', '17:00', '2026-02-28', 'jenniferk', 287, '2026-03-15 16:00:03'),
(23, 1, 'Forget', '', '17:00', '2026-03-03', 'jenniferk', 287, '2026-03-15 16:01:03'),
(24, 1, 'Forget', '07:20', '17:00', '2026-03-04', 'jenniferk', 287, '2026-03-15 16:02:03'),
(25, 1, 'Conference', '07:30', '16:30', '2026-02-26', 'lisaw', 202, '2026-03-15 16:20:03'),
(26, 1, 'Conference', '07:30', '16:30', '2026-02-27', 'lisaw', 202, '2026-03-15 16:20:03'),
(27, 1, 'Conference', '07:30', '16:30', '2026-02-28', 'lisaw', 202, '2026-03-15 16:21:03'),
(28, 1, 'forget', '', '16:25', '2026-03-04', 'stellam', 39, '2026-03-15 16:44:03'),
(29, 1, 'Forgot', '', '17:00', '2026-02-27', 'florinad', 198, '2026-03-19 10:18:03'),
(30, 1, 'Forget', '', '17:05', '2026-03-26', 'soumendran', 249, '2026-03-27 08:44:03'),
(31, 1, 'RFID card did not swipe', '07:00', '16:10', '2026-03-27', 'erich', 38, '2026-03-28 07:32:03'),
(32, 1, 'Card did not swipe', '07:30', '', '2026-03-26', 'nandinis', 35, '2026-03-28 08:11:03'),
(33, 1, 'I had punched in around 16:40', '', '16:40', '2026-03-26', 'estherj', 156, '2026-03-28 13:23:03'),
(34, 1, 'I had punched in around 16:25', '', '16:25', '2026-03-27', 'estherj', 156, '2026-03-28 13:21:03'),
(35, 1, 'Did swipe out. ', '', '17:00', '2026-03-26', 'florinad', 198, '2026-04-01 08:48:04'),
(36, 1, 'Forgot to punch out', '', '04:10', '2026-03-26', 'wafas', 57, '2026-04-01 09:27:04'),
(37, 1, 'Forget to punch out ', '', '16:10', '2026-03-25', 'bhaveshs', 207, '2026-04-01 12:02:04'),
(38, 1, 'Malfunction', '', '16:10', '2026-03-26', 'soumyag', 232, '2026-04-01 14:56:04'),
(39, 1, 'Malfunction', '', '16:10', '2026-03-27', 'soumyag', 232, '2026-04-01 14:55:04');

-- --------------------------------------------------------

--
-- Table structure for table "staff_default_status"
--

CREATE TABLE IF NOT EXISTS "staff_default_status" (
  "staff_default_status_id"             SERIAL,
  "user"           VARCHAR(255)  NOT NULL,
  "inserted_date"  TIMESTAMP      NOT NULL,
  "staff_id_ins"   INT           NOT NULL,
  "type"           VARCHAR(255)  NOT NULL,
  "in_time"        VARCHAR(255)  NOT NULL,
  "in_edit_time"   VARCHAR(255)  NOT NULL,
  "out_time"       VARCHAR(255)  NOT NULL,
  "out_edit_time"  VARCHAR(255)  NOT NULL,
  "manager_id"     VARCHAR(255)  NOT NULL,
  "default_date"   DATE          NOT NULL,
  "default_id"     INT           NOT NULL,
  "approved"       INT           NOT NULL DEFAULT 0,
  "reject"         INT           NOT NULL DEFAULT 0,
  "acc_year"       INT           NOT NULL,
  PRIMARY KEY ("staff_default_status_id")
);

--
-- Dumping data for table "staff_default_status"
--

INSERT INTO "staff_default_status" ("staff_default_status_id", "user", "inserted_date", "staff_id_ins", "type", "in_time", "in_edit_time", "out_time", "out_edit_time", "manager_id", "default_date", "default_id", "approved", "reject", "acc_year") VALUES
(1, 'pujas', '2026-02-25 12:29:02', 1, 'D', '', '', '', '', '250', NULL, 0, 0, 1, 2026),
(2, 'pujas', '2026-02-20 00:46:02', 2, 'D', '', '', '', '', '250', NULL, 0, 0, 1, 2026),
(3, 'michaelb', '2026-03-07 15:15:03', 4, 'D', '', '', '', '', '68', NULL, 0, 1, 0, 2026),
(4, 'michaelb', '2026-03-07 15:15:03', 5, 'D', '', '', '', '', '68', NULL, 0, 1, 0, 2026),
(5, 'vladimirk', '2026-03-07 16:39:03', 6, 'D', '', '', '', '', '251', NULL, 0, 1, 0, 2026),
(6, 'vladimirk', '2026-03-07 16:44:03', 7, 'D', '', '', '', '', '251', NULL, 0, 1, 0, 2026),
(7, 'saronig', '2026-03-10 10:07:03', 8, 'D', '', '', '', '', '193', NULL, 0, 1, 0, 2026),
(8, 'shannac', '2026-03-10 10:18:03', 9, 'D', '', '', '', '', '3', NULL, 0, 1, 0, 2026),
(9, 'shannac', '2026-03-15 16:45:03', 10, 'D', '', '', '', '', '3', NULL, 0, 1, 0, 2026),
(10, 'shannac', '2026-03-10 10:27:03', 11, 'D', '', '', '', '', '3', NULL, 0, 1, 0, 2026),
(11, 'deepakm', '2026-03-10 10:33:03', 12, 'D', '', '', '', '', '271', NULL, 0, 1, 0, 2026),
(12, 'shannac', '2026-03-10 10:36:03', 13, 'D', '', '', '', '', '3', NULL, 0, 1, 0, 2026),
(13, 'michaelb', '2026-03-10 10:54:03', 14, 'D', '', '', '', '', '68', NULL, 0, 1, 0, 2026),
(14, 'michaelb', '2026-03-10 13:56:03', 15, 'D', '', '', '', '', '68', NULL, 0, 1, 0, 2026),
(15, 'michaelb', '2026-03-10 14:06:03', 16, 'D', '', '', '', '', '68', NULL, 0, 1, 0, 2026),
(16, 'pujas', '2026-03-10 16:09:03', 17, 'D', '', '', '', '', '250', NULL, 0, 1, 0, 2026),
(17, 'chaitalig', '2026-03-11 15:57:03', 19, 'D', '', '', '', '', '247', NULL, 0, 1, 0, 2026),
(18, 'binduo', '2026-03-13 10:57:03', 20, 'D', '', '', '', '', '252', NULL, 0, 1, 0, 2026),
(19, 'vladimirk', '2026-03-15 15:59:03', 21, 'D', '', '', '', '', '251', NULL, 0, 1, 0, 2026),
(20, 'vladimirk', '2026-03-15 16:00:03', 22, 'D', '', '', '', '', '251', NULL, 0, 1, 0, 2026),
(21, 'vladimirk', '2026-03-15 16:02:03', 23, 'D', '', '', '', '', '251', NULL, 0, 1, 0, 2026),
(22, 'vladimirk', '2026-03-15 16:02:03', 24, 'D', '', '', '', '', '251', NULL, 0, 1, 0, 2026),
(23, 'matthews', '2026-03-15 16:26:03', 25, 'D', '', '', '', '', '182', NULL, 0, 1, 0, 2026),
(24, 'matthews', '2026-03-15 16:26:03', 26, 'D', '', '', '', '', '182', NULL, 0, 1, 0, 2026),
(25, 'matthews', '2026-03-15 16:26:03', 27, 'D', '', '', '', '', '182', NULL, 0, 1, 0, 2026),
(26, 'shannac', '2026-03-15 16:44:03', 28, 'D', '', '', '', '', '3', NULL, 0, 1, 0, 2026),
(27, 'shannac', '2026-03-19 10:19:03', 29, 'D', '', '', '', '', '3', NULL, 0, 1, 0, 2026);

-- --------------------------------------------------------

--
-- Table structure for table "staff_dependents"
--

CREATE TABLE IF NOT EXISTS "staff_dependents" (
  "staff_dependents_id"        SERIAL,
  "dname"     VARCHAR(100)  DEFAULT NULL,
  "ddob"      VARCHAR(100)  DEFAULT NULL,
  "drel"      VARCHAR(50)   DEFAULT NULL,
  "doccu"     VARCHAR(50)   DEFAULT NULL,
  "d_addr"    VARCHAR(255)  DEFAULT NULL,
  "username"  VARCHAR(100)  DEFAULT NULL,
  "staff_id"  INT           DEFAULT NULL,
  "col_id"    INT           DEFAULT NULL,
  "d_phone"   VARCHAR(100)  DEFAULT NULL,
  PRIMARY KEY ("staff_dependents_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "staff_des"
--

CREATE TABLE IF NOT EXISTS "staff_des" (
  "d_name"    VARCHAR(50)   NOT NULL DEFAULT '',
  "d_id"      SERIAL,
  "group_id"  INT           DEFAULT NULL,
  "d_code"    VARCHAR(100)  DEFAULT NULL,
  "col_id"    INT           DEFAULT NULL,
  "priority"  INT           DEFAULT NULL,
  PRIMARY KEY ("d_id")
);

--
-- Dumping data for table "staff_des"
--

INSERT INTO "staff_des" ("d_name", "d_id", "group_id", "d_code", "col_id", "priority") VALUES
('Principal', 1, 3, 'PRN', NULL, 1),
('Teacher', 2, 1, 'TC', NULL, 3),
('Admin', 3, 2, 'ADM', NULL, 1),
('Asst. Mistress', 4, 1, 'AM', NULL, 2),
('IT', 5, 2, 'IT', NULL, 4),
('Assistant Teacher - Primary', 6, 1, 'ATP', 0, 3),
('Career Counselor ', 7, 2, 'CC', 0, 2),
('Community Outreach Coordinator', 8, 2, 'COC', 0, 2),
('Deputy Head of Primary', 9, 2, 'DHP', 0, 2),
('Deputy Head of Primary for Early Years', 10, 2, 'DHPE', 0, 2),
('Deputy Head of Secondary: Academics', 11, 2, 'DHSA', 0, 2),
('Deputy Head of Secondary: Student Life ', 12, 2, 'DHSS', 0, 2),
('Assistant Teacher - Student Success Programme', 13, 1, 'ATSSP', 0, 3),
('Assistant Teacher - Primary (Part-Time)', 14, 1, 'ATPP', 0, 3),
('English and TOK Teacher / Head Of English', 15, 1, 'HE', 0, 3),
('Head of Modern Languages', 16, 1, 'HML', 0, 3),
('Head of Primary', 17, 1, 'HP', 0, 3),
('Head of Secondary', 18, 1, 'HS', 0, 3),
('HOD - Hindi', 19, 1, 'HODH', 0, 3),
('HOD - Mathematics', 20, 1, 'HODM', 0, 3),
('HOD - Science', 21, 1, 'HODS', 0, 3),
('HOD - Visual Arts and Career Counselor', 22, 1, 'HODV', 0, 3),
('IBDP Coordinator and Teacher', 23, 1, 'IBC', 0, 3),
('IGCSE Coordinator ', 24, 1, 'IGC', 0, 2),
('Literacy Coordinator ', 25, 2, 'LC', 0, 2),
('Middle School Coordinator', 26, 2, 'MSC', 0, 2),
('Music Teacher', 27, 1, 'MT', 0, 3),
('Numeracy Coordinator - Primary Years ', 28, 2, 'NCP', 0, 2),
('Part Time Teacher - Primary', 29, 1, 'PTT', 0, 3),
('Physical Education Teacher', 30, 1, 'PET', 0, 3),
('Portuguese Teacher', 31, 1, 'PT', 0, 3),
('Primary Counselor', 32, 2, 'PC', 0, 2),
('Primary Modern Language Teacher', 33, 1, 'PMLT', 0, 3),
('Primary Teacher', 34, 1, 'PT', 0, 3),
('Primary Teacher - Arts', 35, 1, 'PTA', 0, 3),
('Primary Teacher - Dance', 36, 1, 'PTD', 0, 3),
('Primary Teacher - Hindi', 37, 1, 'PTH', 0, 3),
('Primary Teacher - Spanish', 38, 1, 'PTS', 0, 3),
('Primary Teacher - Visual Arts   ', 39, 1, 'PTV', 0, 3),
('Primary Teacher (ESL)', 40, 1, 'PTESL', 0, 3),
('PYP Coordinator', 41, 2, 'PYPC', 0, 2),
('Secondary Counselor', 42, 2, 'SC', 0, 2),
('Secondary Teacher - Arts', 43, 1, 'STA', 0, 3),
('Secondary Teacher - Biology', 44, 1, 'STB', 0, 3),
('Secondary Teacher - Biology and ESS', 45, 1, 'STBE', 0, 3),
('Secondary Teacher - Business Studies and Economics', 46, 1, 'STBSE', 0, 3),
('Secondary Teacher - Drama / English', 47, 1, 'STD', 0, 3),
('Secondary Teacher - English', 48, 1, 'STE', 0, 3),
('Secondary Teacher - English & HOD - English', 49, 1, 'STEH', 0, 3),
('Secondary Teacher - ESL', 50, 1, 'STESL', 0, 3),
('Secondary Teacher - French', 51, 1, 'STF', 0, 3),
('Secondary Teacher - General Science ', 52, 1, 'STGS', 0, 3),
('Secondary Teacher - Hindi', 53, 1, 'SCH', 0, 3),
('Secondary Teacher - Humanities', 54, 1, 'STHM', 0, 3),
('Secondary Teacher - Humanities and Science', 55, 1, 'STHS', 0, 3),
('Secondary Teacher - ICT', 56, 1, 'STICT', 0, 3),
('Secondary Teacher - Mathematics', 57, 1, 'STM', 0, 3),
('Secondary Teacher - Mathematics and Science', 58, 1, 'STMS', 0, 3),
('Secondary Teacher - Physics', 59, 1, 'STP', 0, 3),
('Secondary Teacher - Science', 60, 1, 'STS', 0, 3),
('Secondary Teacher - Science and Chemistry', 61, 1, 'STSC', 0, 3),
('Secondary Teacher - Student Success Program', 62, 1, 'STSSP', 0, 3),
('Secondary Teacher - Visual Arts Teacher', 63, 1, 'STV', 0, 3),
('Secondary Teacher English and Humanities', 64, 1, 'STEH', 0, 3),
('Secondary Tecaher Business and Economics / HOD - H', 65, 1, 'STEHH', 0, 3),
('Secondary Tecaher Performing Arts', 66, 1, 'STPA', 0, 3),
('Spanish Teacher', 67, 1, 'SPT', 0, 3),
('Teacher - French and Spanish', 68, 1, 'TFS', 0, 3),
('Teacher - Student Success Programme', 69, 1, 'TSSP', 0, 3),
('Vice Principal', 70, 1, 'VP', NULL, 1),
('Manager', 71, 2, 'Mang', NULL, 2),
('At Manager', 72, 2, 'At Mang', NULL, 5),
('Executive', 73, 2, 'Exe', NULL, 5),
('Sr Executive', 74, 2, 'Sr Exe', NULL, 5),
('Trustee', 75, 2, 'TRE', NULL, 1),
('Account Executive', 76, 10, 'A/C Exe', NULL, 3),
('Account Manger', 77, 10, 'A/C Mang', NULL, 3),
('HEAD - LIBRARY', 78, 7, 'Head -Lib', NULL, 3),
('Librarian', 79, 7, 'Libr', NULL, 3);

-- --------------------------------------------------------

--
-- Table structure for table "employee_details"
--

CREATE TABLE IF NOT EXISTS "employee_details" (
  "f_name"                  VARCHAR(50)       NOT NULL DEFAULT '',
  "s_name"                  VARCHAR(50)       NOT NULL DEFAULT '',
  "i_name"                  VARCHAR(15)       DEFAULT NULL,
  "qual"                    VARCHAR(150)      DEFAULT NULL,
  "cert"                    VARCHAR(150)      DEFAULT NULL,
  "subj"                    INT               NOT NULL DEFAULT 0,
  "exp_cur"                 VARCHAR(50)       DEFAULT NULL,
  "exp_prev"                VARCHAR(50)       DEFAULT NULL,
  "sp_assoc"                VARCHAR(150)      DEFAULT NULL,
  "xtra"                    VARCHAR(150)      DEFAULT NULL,
  "father"                  VARCHAR(50)       DEFAULT NULL,
  "doa"                     VARCHAR(50)       DEFAULT NULL,
  "bg"                      VARCHAR(15)       NOT NULL DEFAULT '',
  "ms"                      VARCHAR(150)      NOT NULL DEFAULT '',
  "addr_perm"               VARCHAR(250)      DEFAULT NULL,
  "ct_perm"                 VARCHAR(50)       DEFAULT NULL,
  "pin_perm"                VARCHAR(50)       DEFAULT NULL,
  "st_perm"                 VARCHAR(50)       DEFAULT NULL,
  "ph_perm"                 VARCHAR(50)       DEFAULT NULL,
  "addr_pres"               VARCHAR(250)      DEFAULT NULL,
  "ct_pres"                 VARCHAR(50)       DEFAULT NULL,
  "pin_pres"                VARCHAR(50)       DEFAULT NULL,
  "st_pres"                 VARCHAR(50)       DEFAULT NULL,
  "ph_pres"                 VARCHAR(50)       DEFAULT NULL,
  "email"                   VARCHAR(250)      DEFAULT NULL,
  "employee_details_id"                      SERIAL,
  "slno"                    VARCHAR(50)       NOT NULL DEFAULT '',
  "group_id"                INT               DEFAULT NULL,
  "appnt_des"               INT               DEFAULT 0,
  "offeredsal"              INT               NOT NULL DEFAULT 0,
  "basicsal"                INT               NOT NULL DEFAULT 0,
  "j_date"                  DATE              DEFAULT NULL,
  "cmts"                    VARCHAR(250)      DEFAULT NULL,
  "status_id"               INT               DEFAULT NULL,
  "dob"                     DATE              DEFAULT NULL,
  "other_facilities"        VARCHAR(250)      DEFAULT NULL,
  "other_responsibilities"  VARCHAR(250)      DEFAULT NULL,
  "prev_post"               VARCHAR(50)       DEFAULT NULL,
  "prev_work_place"         VARCHAR(50)       DEFAULT NULL,
  "prev_work_city"          VARCHAR(50)       DEFAULT NULL,
  "prev_work_country"       VARCHAR(50)       DEFAULT NULL,
  "last_date_of_work"       DATE              DEFAULT NULL,
  "staff_status_id"         INT               DEFAULT NULL,
  "date_of_updation"        DATE              DEFAULT NULL,
  "expirydate"              DATE              DEFAULT NULL,
  "gender"                  VARCHAR(10)       DEFAULT NULL,
  "releive_date"            DATE              DEFAULT NULL,
  "recruitment_procedure"   VARCHAR(255)      NOT NULL,
  "pfscheme"                VARCHAR(50)  NOT NULL DEFAULT 'YES',
  "active"                  VARCHAR(50)  DEFAULT 'YES',
  "bank_ac_no"              VARCHAR(20)       DEFAULT NULL,
  "pf_ac_no"                VARCHAR(15)       DEFAULT NULL,
  "panno"                   VARCHAR(25)       DEFAULT NULL,
  "csal"                    VARCHAR(25)       DEFAULT NULL,
  "sop"                     VARCHAR(40)       DEFAULT NULL,
  "cat"                     VARCHAR(12)       DEFAULT NULL,
  "pno"                     VARCHAR(15)       DEFAULT NULL,
  "vfdate"                  VARCHAR(20)       DEFAULT NULL,
  "vtadate"                 VARCHAR(20)       DEFAULT NULL,
  "dep"                     VARCHAR(100)      DEFAULT NULL,
  "category"                VARCHAR(20)       DEFAULT NULL,
  "cat_fdate"               VARCHAR(20)       DEFAULT NULL,
  "cat_tdate"               VARCHAR(20)       DEFAULT NULL,
  "pay_scale"               VARCHAR(20)       DEFAULT NULL,
  "spouse_name"             VARCHAR(20)       DEFAULT NULL,
  "dept_name"               VARCHAR(100)      DEFAULT NULL,
  "dept_dob"                VARCHAR(20)       DEFAULT NULL,
  "dept_rel"                VARCHAR(20)       DEFAULT NULL,
  "dept_occu"               VARCHAR(20)       DEFAULT NULL,
  "dept_anualinc"           VARCHAR(15)       DEFAULT NULL,
  "issue_place"             VARCHAR(100)      DEFAULT NULL,
  "mobileno"                VARCHAR(20)       DEFAULT NULL,
  "col_id"                  INT               DEFAULT NULL,
  "height"                  VARCHAR(100)      DEFAULT NULL,
  "id_mark"                 VARCHAR(255)      DEFAULT NULL,
  "religion"                INT               DEFAULT NULL,
  "appnt_date"              DATE              DEFAULT NULL,
  "type_id"                 INT               DEFAULT NULL,
  "aicte_scale"             VARCHAR(100)      DEFAULT NULL,
  "payscale"                VARCHAR(15)       DEFAULT NULL,
  "payrange"                VARCHAR(15)       DEFAULT NULL,
  "substantive"             VARCHAR(20)       DEFAULT NULL,
  "tanno"                   VARCHAR(20)       DEFAULT NULL,
  "bank"                    VARCHAR(255)      DEFAULT NULL,
  "joined_as"               VARCHAR(100)      DEFAULT NULL,
  "officiating_pay"         INT               DEFAULT NULL,
  "app_no"                  VARCHAR(25)       DEFAULT NULL,
  "staff_group_id"          INT               DEFAULT NULL,
  "img_col"                 VARCHAR(255)      DEFAULT NULL,
  "nationality"             VARCHAR(25)       DEFAULT NULL,
  "mother_tongue"           VARCHAR(25)       DEFAULT NULL,
  "membership"              VARCHAR(25)       DEFAULT NULL,
  "empexc"                  VARCHAR(25)       DEFAULT NULL,
  "extraact"                VARCHAR(25)       DEFAULT NULL,
  "addinfo"                 VARCHAR(25)       DEFAULT NULL,
  "kannada"                 CHAR(1)           DEFAULT NULL,
  "english"                 CHAR(1)           DEFAULT NULL,
  "hindi"                   CHAR(1)           DEFAULT NULL,
  "husband"                 VARCHAR(50)       DEFAULT NULL,
  "scard"                   VARCHAR(15)       DEFAULT NULL,
  "employee_code"           VARCHAR(20)       NOT NULL,
  PRIMARY KEY ("employee_details_id")
);

CREATE UNIQUE INDEX "ux_employee_code" ON "employee_details" ("employee_code");
CREATE INDEX "ix_group_active" ON "employee_details" ("group_id", "active");

--
-- Dumping data for table "employee_details"
--

INSERT INTO "employee_details" ("f_name", "s_name", "i_name", "qual", "cert", "subj", "exp_cur", "exp_prev", "sp_assoc", "xtra", "father", "doa", "bg", "ms", "addr_perm", "ct_perm", "pin_perm", "st_perm", "ph_perm", "addr_pres", "ct_pres", "pin_pres", "st_pres", "ph_pres", "email", "id", "slno", "group_id", "appnt_des", "offeredsal", "basicsal", "j_date", "cmts", "status_id", "dob", "other_facilities", "other_responsibilities", "prev_post", "prev_work_place", "prev_work_city", "prev_work_country", "last_date_of_work", "staff_status_id", "date_of_updation", "expirydate", "gender", "releive_date", "recruitment_procedure", "pfscheme", "active", "bank_ac_no", "pf_ac_no", "panno", "csal", "sop", "cat", "pno", "vfdate", "vtadate", "dep", "category", "cat_fdate", "cat_tdate", "pay_scale", "spouse_name", "dept_name", "dept_dob", "dept_rel", "dept_occu", "dept_anualinc", "issue_place", "mobileno", "col_id", "height", "id_mark", "religion", "appnt_date", "type_id", "aicte_scale", "payscale", "payrange", "substantive", "tanno", "bank", "joined_as", "officiating_pay", "app_no", "staff_group_id", "img_col", "nationality", "mother_tongue", "membership", "empexc", "extraact", "addinfo", "kannada", "english", "hindi", "husband", "scard", "employee_code") VALUES
('Alexander Johnson', '', NULL, '', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, 'NA', 'Married', NULL, NULL, NULL, NULL, NULL, '', '', '', '', NULL, 'alexander.johnson@email.com', 69, '8327', 1, NULL, 0, 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'MALE', NULL, 'User', '', 'YES', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, '1940-01-01', 31, NULL, NULL, NULL, '', '', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '8327'),
('Natasha Khanna', '', NULL, '', NULL, 6, NULL, NULL, NULL, NULL, NULL, NULL, 'NA', 'Married', NULL, NULL, NULL, NULL, NULL, '', '', '', '', NULL, 'natasha.khanna@email.com', 70, '8244', 1, NULL, 0, 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'FEMALE', NULL, 'User', '', 'YES', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, '1940-01-01', 34, NULL, NULL, NULL, '', '', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '8244'),
('Neha Thoria', '', NULL, '', NULL, 6, NULL, NULL, NULL, NULL, NULL, NULL, 'NA', 'Married', NULL, NULL, NULL, NULL, NULL, '', '', '', '', NULL, 'neha.thoria@email.com', 71, '8269', 1, NULL, 0, 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'MALE', NULL, 'User', '', 'YES', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, '1940-01-01', 34, NULL, NULL, NULL, '', '', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '8269'),
('Adam Meier', '', NULL, '', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, 'NA', 'Married', NULL, NULL, NULL, NULL, NULL, '', '', '', '', NULL, 'adam.meier@email.com', 66, '8271', 1, NULL, 0, 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, 'MALE', NULL, 'User', '', 'YES', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, '1940-01-01', 38, NULL, NULL, NULL, '', '', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '8271'),
('Pascal Fuzier', '', NULL, '', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, 'NA', 'Married', NULL, NULL, NULL, NULL, NULL, '', '', '', '', NULL, 'pascal.fuzier@email.com', 67, '8262', 1, NULL, 0, 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'MALE', NULL, 'User', '', 'YES', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, '1940-01-01', 33, NULL, NULL, NULL, '', '', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '8262'),
('Michael Bailey', '', NULL, '', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, 'NA', 'Married', NULL, NULL, NULL, NULL, NULL, '', '', '', '', NULL, 'michael.bailey@email.com', 68, '8251', 1, NULL, 0, 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'MALE', NULL, 'User', '', 'YES', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, '1940-01-01', 17, NULL, NULL, NULL, '', '', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '8251'),
('Robert Mullins  ', '', NULL, '', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, 'NA', 'Married', NULL, NULL, NULL, NULL, NULL, '', '', '', '', NULL, 'robert.mullins@email.com', 63, '8248', 1, NULL, 0, 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'MALE', NULL, 'User', '', 'YES', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, '1940-01-01', 34, NULL, NULL, NULL, '', '', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '8248'),
('Carrie Tokunaga', '', NULL, '', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, 'NA', 'Married', NULL, NULL, NULL, NULL, NULL, '', '', '', '', NULL, 'carrie.tokunaga@email.com', 64, '8263', 3, NULL, 0, 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'MALE', NULL, 'User', '', 'YES', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, '1940-01-01', 34, NULL, NULL, NULL, '', '', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '8263'),
('Vitna Bailey ', '', NULL, '', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, 'NA', 'Married', NULL, NULL, NULL, NULL, NULL, '', '', '', '', NULL, 'vitna.bailey@email.com', 65, '8315', 1, NULL, 0, 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, 'FEMALE', NULL, 'User', '', 'NO', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, '1940-01-01', 25, NULL, NULL, NULL, '', '', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '8315'),
('Erika Mullins ', '', NULL, '', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, 'NA', 'Married', NULL, NULL, NULL, NULL, NULL, '', '', '', '', NULL, 'erika.mullins@email.com', 62, '8249', 1, NULL, 0, 0, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, 'MALE', NULL, '', '', 'NO', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, '1940-01-01', 40, NULL, NULL, NULL, '', '', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '8249');

-- --------------------------------------------------------

--
-- Table structure for table "staff_group"
--

CREATE TABLE IF NOT EXISTS "staff_group" (
  "staff_group_id"      SERIAL,
  "name"    VARCHAR(50)  NOT NULL DEFAULT '',
  "status"  SMALLINT   DEFAULT 1,
  "col_id"  INT          DEFAULT NULL,
  PRIMARY KEY ("staff_group_id")
);

--
-- Dumping data for table "staff_group"
--

INSERT INTO "staff_group" ("staff_group_id", "name", "status", "col_id") VALUES
(1, 'Teaching (7.30 am to 4.10 pm)', 1, 1),
(2, 'Non Teaching (8.00 am to 5.00 pm)', 1, 1),
(3, 'Teaching (7.30 am to 1.30 pm)', 1, 1),
(4, 'Teaching Part Time (7.30 am to 1.00 pm)', 1, 1),
(5, 'Non Teaching (7.30 am to 4.10 pm)', 1, NULL),
(6, 'Teaching Part Time(7.30 am to 3.00 pm)', 1, NULL),
(7, 'Non Teaching (7.30 am to 4.30 pm)', 1, NULL),
(8, 'Teaching (9.00 am to 3.00 pm)', 1, NULL),
(9, 'Non Teaching (7.45 am to 4.45 pm)', 1, NULL),
(10, 'Non Teaching (9.00 am to 6.00 pm)', 1, NULL),
(11, 'Cristina Dascalu - Monday ( 7:30 am - 1:00pm', 1, NULL),
(12, 'Teaching (8:00 am to 4:40 pm)', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table "staff_groupnames"
--

CREATE TABLE IF NOT EXISTS "staff_groupnames" (
  "staff_groupnames_id"        SERIAL,
  "grupname"  VARCHAR(255)  NOT NULL,
  "status"    INT           NOT NULL,
  PRIMARY KEY ("staff_groupnames_id")
);

--
-- Dumping data for table "staff_groupnames"
--

INSERT INTO "staff_groupnames" ("staff_groupnames_id", "grupname", "status") VALUES
(1, 'Test Group', 1),
(2, 'IGCSE', 1),
(3, 'IBDP', 1),
(4, 'Secondary Cordinator', 1),
(5, 'Primary Cordinator', 1),
(6, 'Whole School', 1),
(7, 'PE', 1),
(8, 'Grade 1', 1),
(9, 'Grade 2', 1),
(10, 'Grade 3', 1),
(11, 'Grade 4', 1),
(12, 'Grade 5', 1),
(13, 'Grade 6', 1),
(14, 'Grade 7', 1),
(15, 'Grade 8', 1),
(16, 'Grade 9', 1),
(17, 'Grade 10', 1),
(18, 'Grade 11', 1),
(19, 'Grade 12', 1),
(20, 'EAL', 1),
(21, 'SKG', 1),
(22, 'Playschool', 1),
(23, 'Nursery', 1),
(24, 'JKG', 1),
(25, 'English', 1),
(26, 'Hindi', 1),
(27, 'Humanities', 1),
(28, 'Math', 1),
(29, 'MFL', 1),
(30, 'Performing Art', 1),
(31, 'Science', 1),
(32, 'ICT', 1),
(33, 'Visual Ats', 1),
(34, 'Early Years', 1),
(35, 'ECA', 1),
(36, 'Middle School', 1);

-- --------------------------------------------------------

--
-- Table structure for table "staff_hr_grup"
--

CREATE TABLE IF NOT EXISTS "staff_hr_grup" (
  "staff_hr_grup_id"        SERIAL,
  "user"      VARCHAR(255)  NOT NULL,
  "hr_id"     INT           DEFAULT NULL,
  "mng_id"    INT           DEFAULT NULL,
  "staff_id"  INT           NOT NULL,
  "acc_year"  INT           DEFAULT NULL,
  "status"    SMALLINT    NOT NULL,
  PRIMARY KEY ("staff_hr_grup_id")
);

--
-- Dumping data for table "staff_hr_grup"
--

INSERT INTO "staff_hr_grup" ("staff_hr_grup_id", "user", "hr_id", "mng_id", "staff_id", "acc_year", "status") VALUES
(1, '', 246, 68, 245, 0, 1),
(2, '', 0, 0, 194, 0, 1),
(3, '', 246, 183, 212, 0, 1),
(4, '', 0, 0, 213, 0, 1),
(5, '', 0, 0, 201, 2026, 1),
(6, '', 0, 0, 211, 2026, 1),
(7, '', 0, 0, 236, 2026, 1),
(8, '', 246, 3, 198, 2026, 1),
(9, '', 0, 0, 233, 2026, 1),
(10, '', 0, 0, 195, 2026, 1);

-- --------------------------------------------------------

--
-- Table structure for table "employee_leave"
--

CREATE TABLE IF NOT EXISTS "employee_leave" (
  "employee_leave_id"                     SERIAL,
  "staff_att_approve"      INT           NOT NULL,
  "user"                   VARCHAR(255)  NOT NULL,
  "user_manager"           VARCHAR(255)  NOT NULL,
  "inserted_date"          TIMESTAMP      NOT NULL,
  "updated_date"           TIMESTAMP      NOT NULL,
  "user_id"                INT           NOT NULL,
  "avl"                    INT           NOT NULL,
  "type"                   VARCHAR(255)  NOT NULL,
  "in_time"                VARCHAR(255)  NOT NULL,
  "out_time"               VARCHAR(255)  NOT NULL,
  "hd_ee_da_date"          DATE          NOT NULL,
  "reason"                 TEXT          NOT NULL,
  "manager"                VARCHAR(255)  NOT NULL,
  "submit_with"            INT           NOT NULL,
  "f_date"                 DATE          NOT NULL,
  "f_time"                 VARCHAR(255)  NOT NULL,
  "t_date"                 DATE          NOT NULL,
  "to_time"                VARCHAR(255)  NOT NULL,
  "half_time_in"           VARCHAR(255)  NOT NULL,
  "backup"                 VARCHAR(255)  NOT NULL,
  "notify"                 VARCHAR(255)  NOT NULL,
  "days"                   VARCHAR(155)  NOT NULL,
  "contact"                VARCHAR(20)   NOT NULL,
  "approved"               INT           NOT NULL DEFAULT 0,
  "reject"                 INT           NOT NULL DEFAULT 0,
  "acc_year"               INT           NOT NULL,
  "status"                 INT           NOT NULL DEFAULT 1,
  "status_reason"          INT           NOT NULL,
  "withd_commt"            TEXT          NOT NULL,
  "with_color"             VARCHAR(255)  NOT NULL,
  "status_approve"         INT           NOT NULL DEFAULT 1,
  "status_approve_manger"  TIMESTAMP      NOT NULL,
  "status_with_staff"      TIMESTAMP      NOT NULL,
  "staff_id"               INT           NOT NULL,
  "approve_reason"         TEXT          NOT NULL,
  "reject_reason"          TEXT          NOT NULL,
  PRIMARY KEY ("employee_leave_id")
);

--
-- Dumping data for table "employee_leave"
--

INSERT INTO "employee_leave" ("employee_leave_id", "staff_att_approve", "user", "user_manager", "inserted_date", "updated_date", "user_id", "avl", "type", "in_time", "out_time", "hd_ee_da_date", "reason", "manager", "submit_with", "f_date", "f_time", "t_date", "to_time", "half_time_in", "backup", "notify", "days", "contact", "approved", "reject", "acc_year", "status", "status_reason", "withd_commt", "with_color", "status_approve", "status_approve_manger", "status_with_staff", "staff_id", "approve_reason", "reject_reason") VALUES
(17, 0, 'archanam', '', '2026-03-07 11:06:03', NULL, 0, 0, '1', '', '', NULL, 'personal', '', 1, '2026-03-20', '', '2026-03-20', '', '', '', '', '1', '', 0, 0, 2026, 1, 2, 'no personal work', '', 2, NULL, '2026-03-07 11:11:03', 246, '', ''),
(16, 0, 'archanam', 'chaitalig', '2026-03-07 11:02:03', '2026-03-07 11:05:03', 247, 0, '1', '', '', NULL, 'personal work', '', 0, '2026-03-17', '', '2026-03-17', '', '', '', '', '0', '', 0, 1, 2026, 1, 1, '', '', 1, NULL, NULL, 246, '', 'public holiday'),
(89, 0, 'soumendran', '', '2026-03-27 14:11:03', NULL, 0, 0, '1', '', '', NULL, 'Not well', '', 0, '2026-03-25', '', '2026-03-25', '', '', '', '', '1', '', 0, 0, 2026, 1, 1, '', '', 1, NULL, NULL, 249, '', ''),
(92, 0, 'scottw', 'shannac', '2026-03-31 15:55:03', '2026-04-01 10:18:04', 3, 0, '1', '', '', NULL, 'personal day', '', 0, '2026-05-02', '', '2026-05-02', '', '', '', '', '1', 'n/a', 1, 0, 2026, 1, 1, '', '', 1, NULL, NULL, 7, 'Approved', ''),
(21, 0, 'adrienneh', '', '2026-03-07 12:53:03', NULL, 0, 0, 'EE', '', '15:00', '2026-02-28', 'Pesrsonal', '', 1, NULL, '', NULL, '', '', '', '', '', '', 0, 0, 2026, 1, 2, 'Wrongly upaded', '', 2, NULL, '2026-03-07 12:56:03', 4, '', ''),
(22, 0, 'adrienneh', 'shannac', '2026-03-07 12:57:03', '2026-03-10 16:15:03', 3, 0, '6', '08:00', '15:00', '2026-02-28', 'Out door duty', '', 0, NULL, '', NULL, '', '', '', '', '', '', 1, 0, 2026, 1, 1, '', '', 1, NULL, NULL, 4, 'Ok', ''),
(23, 0, 'parago', 'shannac', '2026-03-07 13:04:03', '2026-03-10 16:15:03', 3, 0, 'EE', '', '15:10', '2026-02-28', 'Personal', '', 0, NULL, '', NULL, '', '', '', '', '', '', 1, 0, 2026, 1, 1, '', '', 1, NULL, NULL, 34, 'Ok', ''),
(25, 0, 'shilpak', 'michaelb', '2026-03-07 15:28:03', '2026-03-07 15:29:03', 68, 0, '6', '07:15', '17:00', '2026-02-28', 'Official', '', 0, NULL, '', NULL, '', '', '', '', '', '', 1, 0, 2026, 1, 1, '', '', 1, NULL, NULL, 24, 'ok', ''),
(27, 0, 'adrienneh', 'shannac', '2026-03-07 16:18:03', '2026-03-07 16:22:03', 3, 0, '1', '', '', NULL, 'Sick', '', 0, '2026-02-25', '', '2026-02-25', '', '', '', '', '1', '', 1, 0, 2026, 1, 1, '', '', 1, NULL, NULL, 4, 'Ok', ''),
(29, 0, 'ulkaa', 'shannac', '2026-03-10 14:30:03', '2026-03-10 14:36:03', 3, 0, '1', '', '', NULL, 'Had to urgently go to Pune due to dad\\''s health issue', '', 0, '2026-02-24', '', '2026-02-24', '', '', '', '', '1', '', 1, 0, 2026, 1, 1, '', '', 1, NULL, NULL, 26, 'OK', ''),
(30, 0, 'debran', 'michaelb', '2026-03-10 15:23:03', '2026-03-10 15:24:03', 68, 0, '1', '', '', NULL, 'Mother is not well', '', 0, '2026-02-20', '', '2026-02-26', '', '', '', '', '5', '', 1, 0, 2026, 1, 1, '', '', 1, NULL, NULL, 151, 'Ok', '');

-- --------------------------------------------------------

--
-- Table structure for table "employee_leave_hr"
--

CREATE TABLE IF NOT EXISTS "employee_leave_hr" (
  "employee_leave_hr_id"        SERIAL,
  "user"      VARCHAR(255)  NOT NULL,
  "hr_id"     INT           NOT NULL,
  "acc_year"  INT           NOT NULL,
  "status"    SMALLINT    NOT NULL,
  PRIMARY KEY ("employee_leave_hr_id")
);

--
-- Dumping data for table "employee_leave_hr"
--

INSERT INTO "employee_leave_hr" ("employee_leave_hr_id", "user", "hr_id", "acc_year", "status") VALUES
(1, 'administrator', 247, 2026, 1),
(2, 'administrator', 246, 2026, 1),
(3, 'administrator', 248, 2026, 1);

-- --------------------------------------------------------

--
-- Table structure for table "employee_leave_manger"
--

CREATE TABLE IF NOT EXISTS "employee_leave_manger" (
  "employee_leave_manger_id"         SERIAL,
  "user"       VARCHAR(255)  NOT NULL,
  "manger_id"  INT           NOT NULL,
  "acc_year"   INT           NOT NULL,
  "status"     SMALLINT    NOT NULL,
  PRIMARY KEY ("employee_leave_manger_id")
);

--
-- Dumping data for table "employee_leave_manger"
--

INSERT INTO "employee_leave_manger" ("employee_leave_manger_id", "user", "manger_id", "acc_year", "status") VALUES
(1, 'administrator', 188, 2026, 0),
(2, 'administrator', 182, 2026, 1),
(3, 'administrator', 68, 2026, 1),
(4, 'administrator', 250, 2026, 1),
(5, 'administrator', 3, 2026, 1),
(6, 'administrator', 251, 2026, 1),
(7, 'administrator', 61, 2026, 1),
(8, 'administrator', 248, 2026, 1),
(9, 'administrator', 202, 2026, 1),
(10, 'administrator', 252, 2026, 1),
(11, 'administrator', 183, 2026, 1),
(12, 'administrator', 257, 2026, 1),
(13, 'administrator', 231, 2026, 1),
(14, 'administrator', 247, 2026, 1),
(15, 'administrator', 185, 2026, 1),
(16, 'administrator', 193, 2026, 1),
(17, 'administrator', 269, 2026, 1),
(18, 'administrator', 21, 2026, 1),
(19, 'administrator', 264, 2026, 1),
(20, 'administrator', 271, 2026, 1);

-- --------------------------------------------------------

--
-- Table structure for table "employee_leave_type"
--

CREATE TABLE IF NOT EXISTS "employee_leave_type" (
  "employee_leave_type_id"            SERIAL,
  "leave_name"    VARCHAR(255)  NOT NULL,
  "special_type"  INT           NOT NULL,
  "lv_ty"         INT           NOT NULL,
  "status"        SMALLINT    NOT NULL,
  PRIMARY KEY ("employee_leave_type_id")
);

--
-- Dumping data for table "employee_leave_type"
--

INSERT INTO "employee_leave_type" ("employee_leave_type_id", "leave_name", "special_type", "lv_ty", "status") VALUES
(1, 'Leave', 1, 0, 1),
(2, 'Unpaid Leave', 1, 0, 1),
(3, 'Maternity Leave', 2, 0, 1),
(5, 'Default', 1, 1, 0),
(6, 'Out Door', 1, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table "employee_leave_type_group"
--

CREATE TABLE IF NOT EXISTS "employee_leave_type_group" (
  "employee_leave_type_group_id"          SERIAL,
  "staff_id"    INT  NOT NULL,
  "leave_type"  INT  NOT NULL,
  "status"      INT  NOT NULL,
  PRIMARY KEY ("employee_leave_type_group_id")
);

--
-- Dumping data for table "employee_leave_type_group"
--

INSERT INTO "employee_leave_type_group" ("employee_leave_type_group_id", "staff_id", "leave_type", "status") VALUES
(1, 330, 1, 0),
(2, 331, 1, 0),
(3, 332, 1, 0),
(4, 281, 3, 0),
(5, 333, 1, 0),
(6, 334, 1, 0),
(7, 335, 1, 0),
(8, 335, 6, 0),
(9, 258, 3, 1),
(10, 336, 1, 0),
(11, 337, 1, 0),
(12, 339, 1, 0),
(13, 340, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table "staff_qualification"
--

CREATE TABLE IF NOT EXISTS "staff_qualification" (
  "staff_qualification_id"              SERIAL,
  "staff_id"        INT           DEFAULT NULL,
  "course_name"     VARCHAR(100)  DEFAULT NULL,
  "year_pass"       VARCHAR(100)  DEFAULT NULL,
  "university"      VARCHAR(100)  DEFAULT NULL,
  "reg_date"        VARCHAR(200)  DEFAULT NULL,
  "name_board"      VARCHAR(200)  DEFAULT NULL,
  "school"         VARCHAR(200)  DEFAULT NULL,
  "specialization"  VARCHAR(50)   DEFAULT NULL,
  "class"           VARCHAR(25)   DEFAULT NULL,
  "percentage"      VARCHAR(25)   DEFAULT NULL,
  PRIMARY KEY ("staff_qualification_id")
);

--
-- Dumping data for table "staff_qualification"
--

INSERT INTO "staff_qualification" ("staff_qualification_id", "staff_id", "course_name", "year_pass", "university", "reg_date", "name_board", "school", "specialization", "class", "percentage") VALUES
(1, 1, 'Dip. in Comp.Sc', '1991', '', '', '', 'MNTI', 'CS', NULL, NULL),
(2, 2, 'II PUC', '1988', 'bangalore', '', '', 'mounts', 'Commerce', NULL, NULL),
(3, 2, 'Dip in Com', '', '', '', '', '', 'CS', NULL, NULL),
(4, 8, 'II puc', '1988', 'Bangalore', '', '', 'Mount Carmel', 'Commerce', NULL, NULL),
(5, 9, 'M.A.Ed.', '2009', 'University of Mumbai', '', '', 'University of Mumbai', 'Educational Admin', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table "staff_rights"
--

CREATE TABLE IF NOT EXISTS "staff_rights" (
  "staff_rights_id"                SERIAL,
  "staff_id"          INT          DEFAULT NULL,
  "course_id"         INT          DEFAULT NULL,
  "subject_id"        INT          DEFAULT NULL,
  "year_id"           INT          DEFAULT NULL,
  "subject_type"      INT          DEFAULT NULL,
  "class_section_id"  INT          DEFAULT NULL,
  "batch_id"          INT          DEFAULT NULL,
  "StaffID"           VARCHAR(50)  DEFAULT NULL,
  "maj_id"            INT          DEFAULT NULL,
  PRIMARY KEY ("staff_rights_id")
);

--
-- Dumping data for table "staff_rights"
--

INSERT INTO "staff_rights" ("staff_rights_id", "staff_id", "course_id", "subject_id", "year_id", "subject_type", "class_section_id", "batch_id", "StaffID", "maj_id") VALUES
(1, 0, 2, 232, 2, 1, 1, 0, 'RD-S0001', 0),
(2, 0, 2, 233, 2, 1, 1, 0, 'RD-S0001', 0),
(3, 0, 2, 236, 2, 1, 1, 0, 'RD-S0001', 0),
(4, 0, 3, 1, 5, 1, 1, 0, 'RD-S0001', 0),
(5, 0, 3, 2, 5, 1, 1, 0, 'RD-S0001', 0),
(6, 0, 3, 3, 5, 1, 1, 0, 'RD-S0001', 0),
(7, 0, 3, 5, 5, 1, 1, 0, 'RD-S0001', 0),
(8, 0, 3, 1, 5, 1, 1, 0, 'RD-S0001', 0),
(9, 0, 3, 2, 5, 1, 1, 0, 'RD-S0001', 0),
(10, 0, 3, 3, 5, 1, 1, 0, 'RD-S0001', 0),
(11, 0, 3, 4, 5, 1, 1, 0, 'RD-S0001', 0),
(12, 0, 3, 5, 5, 1, 1, 0, 'RD-S0001', 0),
(13, 0, 3, 6, 5, 1, 1, 0, 'RD-S0001', 0),
(14, 0, 3, 7, 5, 1, 1, 0, 'RD-S0001', 0),
(15, 0, 3, 8, 5, 1, 1, 0, 'RD-S0001', 0),
(16, 0, 3, 247, 5, 1, 1, 0, 'RD-S0001', 0),
(17, 0, 3, 248, 5, 4, 1, 0, 'RD-S0001', 0),
(18, 0, 3, 249, 5, 4, 1, 0, 'RD-S0001', 0),
(19, 0, 3, 250, 5, 4, 1, 0, 'RD-S0001', 0),
(20, 0, 3, 59, 9, 1, 1, 0, 'RD-S0002', 0);

-- --------------------------------------------------------

--
-- Table structure for table "staff_status"
--

CREATE TABLE IF NOT EXISTS "staff_status" (
  "staff_status_id"      SERIAL,
  "name"    VARCHAR(50)  DEFAULT NULL,
  "status"  SMALLINT   DEFAULT 1,
  PRIMARY KEY ("staff_status_id")
);

--
-- Dumping data for table "staff_status"
--

INSERT INTO "staff_status" ("staff_status_id", "name", "status") VALUES
(1, 'Permanent', 1),
(2, 'Temprorary', 1),
(3, 'Contractual', 1);

-- --------------------------------------------------------

--
-- Table structure for table "staff_termination"
--

CREATE TABLE IF NOT EXISTS "staff_termination" (
  "staff_termination_id"        SERIAL,
  "staff_id"  INT           DEFAULT NULL,
  "san_date"  DATE          DEFAULT NULL,
  "san_no"    VARCHAR(100)  DEFAULT NULL,
  "aut_name"  VARCHAR(100)  DEFAULT NULL,
  "remarks"   TEXT,
  "eff_date"  DATE          DEFAULT NULL,
  "headg"     VARCHAR(200)  DEFAULT NULL,
  PRIMARY KEY ("staff_termination_id")
);

--
-- Dumping data for table "staff_termination"
--

INSERT INTO "staff_termination" ("staff_termination_id", "staff_id", "san_date", "san_no", "aut_name", "remarks", "eff_date", "headg") VALUES
(1, 17, '2026-01-07', 'CLRT/HRM/NewApp/17', 'HR Manager', 'Newly recruited staff', '2026-01-07', 'New Appointment'),
(2, 18, '2026-03-06', 'CLRT/HRM/NewApp/18', 'HR Manager', 'Newly recruited staff', '2026-03-06', 'New Appointment'),
(3, 19, '2026-06-28', 'CLRT/HRM/NewApp/19', 'HR Manager', 'Newly recruited staff', '2026-06-28', 'New Appointment'),
(4, 182, '2026-07-23', 'CLRT/HRM/NewApp/182', 'HR Manager', 'Newly recruited staff', '2026-07-23', 'New Appointment'),
(5, 183, '2026-07-25', 'CLRT/HRM/NewApp/183', 'HR Manager', 'Newly recruited staff', '2026-07-25', 'New Appointment'),
(6, 184, '2026-07-25', 'CLRT/HRM/NewApp/184', 'HR Manager', 'Newly recruited staff', '2026-07-25', 'New Appointment'),
(7, 185, '2026-07-26', 'CLRT/HRM/NewApp/185', 'HR Manager', 'Newly recruited staff', '2026-07-26', 'New Appointment'),
(8, 186, '2026-07-27', 'CLRT/HRM/NewApp/186', 'HR Manager', 'Newly recruited staff', '2026-07-27', 'New Appointment'),
(9, 187, '2026-07-27', 'CLRT/HRM/NewApp/187', 'HR Manager', 'Newly recruited staff', '2026-07-27', 'New Appointment'),
(10, 188, '2026-07-30', 'CLRT/HRM/NewApp/188', 'HR Manager', 'Newly recruited staff', '2026-07-30', 'New Appointment');

-- --------------------------------------------------------

--
-- Table structure for table "staff_time"
--

CREATE TABLE IF NOT EXISTS "staff_time" (
  "staff_time_id"          SERIAL,
  "acc_year"    VARCHAR(200)  NOT NULL,
  "leave_det"   INT           NOT NULL,
  "staff_type"  VARCHAR(200)  NOT NULL,
  "enter_date"  DATE          NOT NULL,
  "staff_date"  VARCHAR(255)  NOT NULL,
  "date_type"   INT           NOT NULL,
  "username"    VARCHAR(200)  NOT NULL,
  "intime"      VARCHAR(200)  NOT NULL,
  "ex_intime"   VARCHAR(255)  NOT NULL,
  "outtime"     VARCHAR(200)  NOT NULL,
  "ex_outtime"  VARCHAR(255)  NOT NULL,
  "title"       VARCHAR(200)  NOT NULL,
  "status"      INT           NOT NULL DEFAULT 1,
  PRIMARY KEY ("staff_time_id")
);

--
-- Dumping data for table "staff_time"
--

INSERT INTO "staff_time" ("staff_time_id", "acc_year", "leave_det", "staff_type", "enter_date", "staff_date", "date_type", "username", "intime", "ex_intime", "outtime", "ex_outtime", "title", "status") VALUES
(1, '2026', 1, '1', '2026-03-15', '', 1, 'administrator', '07:30', '07:40', '16:10', '16:10', 'Teaching', 1),
(2, '2026', 1, '2', '2026-02-17', '', 1, 'administrator', '08:00', '08:15', '17:00', '17:00', 'Non Teaching', 1),
(3, '2026', 1, '3', NULL, '', 1, 'administrator', '07:30', '', '13:30', '', 'Teaching', 1),
(4, '2026', 1, '4', NULL, '', 1, 'administrator', '07:30', '', '13:00', '', 'Teaching Part Time', 1),
(5, '2026', 1, '5', '2026-02-18', '', 1, 'administrator', '07:30', '07:45', '16:10', '16:10', 'Non Teaching', 1),
(6, '2026', 1, '6', NULL, '', 1, 'administrator', '07:30', '', '15:00', '', 'Teaching Part Time', 1),
(7, '2026', 1, '7', '2026-03-15', '', 1, 'administrator', '07:30', '07:45', '16:30', '16:30', 'Non Teaching', 1),
(8, '2026', 1, '8', NULL, '', 1, 'administrator', '09:00', '', '15:00', '', 'Teaching', 1),
(9, '2026', 1, '9', '2026-02-18', '', 1, 'administrator', '07:45', '08:00', '16:45', '16:45', 'Non Teaching', 1),
(10, '2026', 1, '10', '2026-02-18', '', 1, 'administrator', '09:00', '09:15', '18:00', '18:00', 'Non Teaching', 1);

-- --------------------------------------------------------

--
-- Table structure for table "studentmenu"
--

CREATE TABLE IF NOT EXISTS "studentmenu" (
  "row_id"     SERIAL,
  "module"     CHAR(50)          DEFAULT NULL,
  "submodule"  CHAR(50)          DEFAULT NULL,
  "linkname"   CHAR(250)         DEFAULT NULL,
  "linkpath"   CHAR(250)         DEFAULT NULL,
  "access"     VARCHAR(50)  DEFAULT NULL,
  "parameter"  CHAR(250)         DEFAULT NULL,
  "id"         INT               DEFAULT NULL,
  PRIMARY KEY ("row_id")
);

--
-- Dumping data for table "studentmenu"
--

INSERT INTO "studentmenu" ("module", "submodule", "linkname", "linkpath", "access", "parameter", "id") VALUES
('Main', 'Main', 'User Management', '/lms/menu/usermenu.php', 'No', '', 206),
('Main', 'Main', 'Student Management', '/lms/menu/studentmenu.php', 'No', '', 207),
('Main', 'Main', 'Class', '/lms/menu/class.php', 'Yes', '', 214),
('Main', 'Main', 'Parents Web', '/lms/menu/calendar.php', 'Yes', '', 218),
('Main', 'Main', 'Health Management', '/lms/menu/healthManagement.php', 'Yes', '', 221),
('Main', 'Main', 'Photo Gallery', '/lms/menu/Gallery.php', 'Yes', '', 399),
('Main', 'Main', 'Online Assessment', '/lms/menu/Online.php', 'No', '', 403),
('Class', 'Class', 'Home Work', '/lms/TimeTable/homework.php', 'Yes', '', 80),
('Class', 'Class', 'Lesson Plan', '/lms/TimeTable/lesson_plan.php', 'Yes', '', 82),
('Parents Web', 'Reports', 'School Announcement', '/lms/Calendar/scannouncementRep.php', 'Yes', '', 70),
('Parents Web', 'Reports', 'Class Announcement', '/lms/Calendar/classannouncementRep.php', 'Yes', '', 71),
('Parents Web', 'Reports', 'School Calendar', '/lms/Calendar/scannouncementRep_call.php', 'Yes', '', 394),
('Health Management', 'Student Medical Details', 'Medical details', '/lms/health_management/student_medical.php', 'Yes', '', 391),
('Photo Gallery', 'View', 'School', '/lms/PhotoGallery/schoolGalleryView.php', 'Yes', '', 397),
('Photo Gallery', 'View', 'Class', '/lms/PhotoGallery/classGalleryView.php', 'No', '', 398);

-- --------------------------------------------------------

--
-- Table structure for table "student_card_number"
--

CREATE TABLE IF NOT EXISTS "student_card_number" (
  "student_card_number_id"          SERIAL,
  "student_id"  INT          NOT NULL,
  "swap_card"   VARCHAR(50)  NOT NULL,
  "status"      SMALLINT   NOT NULL,
  PRIMARY KEY ("student_card_number_id")
);

--
-- Dumping data for table "student_card_number"
--

INSERT INTO "student_card_number" ("student_card_number_id", "student_id", "swap_card", "status") VALUES
(1, 907, '32981917000000000000000000000000', 1),
(2, 303, '723D6B17000000000000000000000000', 1),
(3, 384, '72D76B17000000000000000000000000', 1),
(4, 752, '49B76B17000000000000000000000000', 1),
(5, 150, '5E2F6B17000000000000000000000000', 1),
(6, 779, '6CB96B17000000000000000000000000', 1),
(7, 762, '5C246D17000000000000000000000000', 1),
(8, 591, '42B06C17000000000000000000000000', 1),
(9, 769, '35791917000000000000000000000000', 1),
(10, 1135, '5F0C7A17000000000000000000000000', 1);

-- --------------------------------------------------------

--
-- Table structure for table "student_class"
--

CREATE TABLE IF NOT EXISTS "student_class" (
  "student_class_id"        BIGSERIAL,
  "div"       INT     NOT NULL,
  "class"     INT     NOT NULL,
  "sub"       INT     NOT NULL,
  "sub_sec"   INT     NOT NULL,
  "acc_year"  INT     NOT NULL,
  "stu_id"    BIGINT  NOT NULL,
  PRIMARY KEY ("student_class_id")
);

--
-- Dumping data for table "student_class"
--

INSERT INTO "student_class" ("student_class_id", "div", "class", "sub", "sub_sec", "acc_year", "stu_id") VALUES
(1, 0, 1, 238, 1, 2026, 893),
(2, 0, 1, 238, 1, 2026, 671),
(3, 0, 1, 238, 1, 2026, 731),
(4, 0, 1, 238, 1, 2026, 387),
(5, 0, 1, 238, 1, 2026, 417),
(6, 0, 1, 238, 1, 2026, 841),
(7, 0, 1, 238, 1, 2026, 79),
(8, 0, 1, 238, 1, 2026, 216),
(9, 0, 1, 238, 1, 2026, 75),
(10, 0, 1, 238, 1, 2026, 156);

-- --------------------------------------------------------

--
-- Table structure for table "student_course"
--

CREATE TABLE IF NOT EXISTS "student_course" (
  "student_course_id"        SERIAL,
  "div"       INT     NOT NULL,
  "class"     INT     NOT NULL,
  "sub"       INT     NOT NULL,
  "sub_sec"   INT     NOT NULL,
  "acc_year"  INT     NOT NULL,
  "stu_id"    BIGINT  NOT NULL,
  PRIMARY KEY ("student_course_id")
);

--
-- Dumping data for table "student_course"
--

INSERT INTO "student_course" ("student_course_id", "div", "class", "sub", "sub_sec", "acc_year", "stu_id") VALUES
(1, 3, 10, 0, 42, 2026, 1055),
(2, 3, 10, 0, 42, 2026, 775),
(3, 3, 10, 0, 42, 2026, 472),
(4, 3, 10, 0, 42, 2026, 262),
(5, 3, 10, 0, 42, 2026, 694),
(6, 3, 10, 0, 42, 2026, 834),
(7, 3, 10, 0, 42, 2026, 40),
(8, 3, 10, 0, 42, 2026, 808),
(9, 3, 10, 0, 42, 2026, 758),
(10, 3, 10, 0, 42, 2026, 306);

-- --------------------------------------------------------

--
-- Table structure for table "student_leavingcertificate"
--

CREATE TABLE IF NOT EXISTS "student_leavingcertificate" (
  "student_leavingcertificate_id"                    SERIAL,
  "student_id"            INT   NOT NULL,
  "gradeCompleted"        INT   NOT NULL,
  "academicYear"          INT   NOT NULL,
  "lastDateOfAttendance"  DATE  NOT NULL,
  "sysdate"               DATE  NOT NULL,
  "resultEndYear"         INT   NOT NULL,
  "comments"              TEXT  NOT NULL,
  PRIMARY KEY ("student_leavingcertificate_id")
);

--
-- Dumping data for table "student_leavingcertificate"
--

INSERT INTO "student_leavingcertificate" ("student_leavingcertificate_id", "student_id", "gradeCompleted", "academicYear", "lastDateOfAttendance", "sysdate", "resultEndYear", "comments") VALUES
(1, 814, 4, 2026, NULL, '2026-05-30', 2026, ''),
(2, 975, 1, 2026, NULL, '2026-07-22', 2026, ''),
(3, 473, 1, 2026, NULL, '2026-09-30', 2026, ''),
(4, 108, 1, 2026, NULL, '2026-11-06', 2026, ''),
(5, 156, 1, 2026, NULL, '2026-02-19', 2026, '');

-- --------------------------------------------------------

--
-- Table structure for table "student_m"
--

CREATE TABLE IF NOT EXISTS "student_m" (
  "student_m_id"                 SERIAL,
  "admission_id"       VARCHAR(20)        DEFAULT NULL,
  "admission_date"     DATE               DEFAULT NULL,
  "student_id"         VARCHAR(20)        DEFAULT NULL,
  "usn"                VARCHAR(20)        DEFAULT NULL,
  "first_name"         VARCHAR(30)        DEFAULT NULL,
  "middle_name"        VARCHAR(30)        NOT NULL,
  "last_name"          VARCHAR(30)        DEFAULT NULL,
  "nationality"        SMALLINT  DEFAULT NULL,
  "religion"           SMALLINT   DEFAULT NULL,
  "gender"             CHAR(1)            DEFAULT NULL,
  "caste_id"           VARCHAR(50)        DEFAULT NULL,
  "dob"                DATE               DEFAULT NULL,
  "age"                VARCHAR(10)        DEFAULT NULL,
  "per_address"        VARCHAR(250)       DEFAULT NULL,
  "per_city"           VARCHAR(100)       DEFAULT NULL,
  "per_state"          VARCHAR(50)        DEFAULT NULL,
  "per_country"        VARCHAR(50)        DEFAULT NULL,
  "per_pincode"        VARCHAR(7)         DEFAULT NULL,
  "per_phone"          VARCHAR(20)        DEFAULT NULL,
  "cor_address"        VARCHAR(250)       DEFAULT NULL,
  "cor_city"           VARCHAR(100)       DEFAULT NULL,
  "cor_state"          VARCHAR(50)        DEFAULT NULL,
  "cor_country"        VARCHAR(50)        DEFAULT NULL,
  "cor_pincode"        VARCHAR(7)         DEFAULT NULL,
  "cor_phone"          VARCHAR(20)        DEFAULT NULL,
  "parent_name"        VARCHAR(60)        DEFAULT NULL,
  "parent_occupation"  VARCHAR(30)        DEFAULT NULL,
  "parent_income"      NUMERIC(12,2)        DEFAULT NULL,
  "loc_address"        VARCHAR(250)       DEFAULT NULL,
  "loc_city"           VARCHAR(100)       DEFAULT NULL,
  "loc_state"          VARCHAR(50)        DEFAULT NULL,
  "loc_country"        VARCHAR(50)        DEFAULT NULL,
  "loc_pincode"        VARCHAR(7)         DEFAULT NULL,
  "loc_phone"          VARCHAR(20)        DEFAULT NULL,
  "course_admitted"    INT                DEFAULT NULL,
  "course_yearsem"     INT                DEFAULT NULL,
  "quota_id"           INT                DEFAULT NULL,
  "academic_year"      VARCHAR(12)        DEFAULT NULL,
  "remarks"            VARCHAR(250)       DEFAULT NULL,
  "username"           VARCHAR(15)        DEFAULT NULL,
  "password"           VARCHAR(255)       DEFAULT NULL,
  "archive"            VARCHAR(50)  DEFAULT 'N',
  "class_section_id"   SMALLINT         NOT NULL DEFAULT 0,
  "parent_username"    VARCHAR(15)        DEFAULT NULL,
  "password_hash"    VARCHAR(35)        DEFAULT NULL,
  "count"              INT                DEFAULT NULL,
  "blood_group"        VARCHAR(20)        DEFAULT NULL,
  "admission_type"     VARCHAR(10)        DEFAULT NULL,
  "img_source"         VARCHAR(255)       DEFAULT NULL,
  "img_source_s"       VARCHAR(255)       DEFAULT NULL,
  "marital_status"     VARCHAR(2)         NOT NULL,
  "mentor"             VARCHAR(15)        DEFAULT '',
  "m_email"            VARCHAR(70)        DEFAULT NULL,
  "mnum"               VARCHAR(32)        DEFAULT NULL,
  "g_name"             VARCHAR(15)        DEFAULT NULL,
  "g_occ"              VARCHAR(15)        DEFAULT NULL,
  "g_in"               BIGINT             DEFAULT NULL,
  "g_num"              VARCHAR(32)        DEFAULT NULL,
  "g_mail"             VARCHAR(70)        DEFAULT NULL,
  "f_email"            VARCHAR(70)        DEFAULT NULL,
  "place_of_birth"     VARCHAR(30)        DEFAULT NULL,
  "f_quali"            VARCHAR(30)        DEFAULT NULL,
  "m_quali"            VARCHAR(30)        DEFAULT NULL,
  "g_quali"            VARCHAR(30)        DEFAULT NULL,
  "lang_id"            VARCHAR(200)       DEFAULT NULL,
  "State"              VARCHAR(20)        DEFAULT 'Karnataka',
  "sms_mobile"         VARCHAR(32)        DEFAULT NULL,
  "mother_tongue"      SMALLINT   DEFAULT NULL,
  "birth_disct"        VARCHAR(100)       DEFAULT NULL,
  "stud_type"          VARCHAR(10)        DEFAULT NULL,
  "vdate"              DATE               DEFAULT NULL,
  "m_name"             VARCHAR(200)       DEFAULT NULL,
  "m_occ"              VARCHAR(200)       DEFAULT NULL,
  "m_inc"              VARCHAR(15)        DEFAULT NULL,
  "foadd"              VARCHAR(255)       DEFAULT NULL,
  "moadd"              VARCHAR(255)       DEFAULT NULL,
  "goadd"              VARCHAR(255)       DEFAULT NULL,
  "adm_yr"             SMALLINT  DEFAULT NULL,
  "tcid"               BIGINT             NOT NULL DEFAULT 0,
  "tcdate"             DATE               NOT NULL,
  "msgphone"           BIGINT             NOT NULL,
  "rgmailid"           VARCHAR(70)        NOT NULL,
  "mother_email"       VARCHAR(30)        DEFAULT NULL,
  "f_org"              VARCHAR(100)       DEFAULT NULL,
  "m_org"              VARCHAR(100)       DEFAULT NULL,
  "g_org"              VARCHAR(100)       DEFAULT NULL,
  "f_desg"             VARCHAR(100)       DEFAULT NULL,
  "m_desg"             VARCHAR(100)       DEFAULT NULL,
  "g_desg"             VARCHAR(100)       DEFAULT NULL,
  "fpan_no"            VARCHAR(20)        DEFAULT NULL,
  "mpan_no"            VARCHAR(20)        DEFAULT NULL,
  "gpan_no"            VARCHAR(20)        DEFAULT NULL,
  "office"             VARCHAR(255)       DEFAULT NULL,
  "per_grade"          VARCHAR(100)       DEFAULT NULL,
  "residence"          VARCHAR(255)       DEFAULT NULL,
  "parent_org"         TEXT,
  "hear_school"        VARCHAR(255)       DEFAULT NULL,
  "parent_desig"       VARCHAR(100)       DEFAULT NULL,
  "passport_type"      VARCHAR(20)        DEFAULT NULL,
  "per_school_name"    VARCHAR(255)       DEFAULT NULL,
  "enquiry_type"       VARCHAR(10)        DEFAULT NULL,
  "action"             VARCHAR(10)        DEFAULT 'Disapprove',
  "adminpack"          VARCHAR(2)         DEFAULT 'N',
  "inserted_date"      DATE               DEFAULT NULL,
  "inserted_time"      TIME               DEFAULT NULL,
  "status"             SMALLINT         DEFAULT 1,
  "sem_elig"           SMALLINT   NOT NULL,
  "apl_prev"           SMALLINT   DEFAULT NULL,
  "m_occp"             VARCHAR(250)       NOT NULL,
  "f_occp"             VARCHAR(250)       NOT NULL,
  PRIMARY KEY ("student_m_id")
);

CREATE UNIQUE INDEX "ux_student_id" ON "student_m" ("student_id");
CREATE INDEX "ix_archive_year" ON "student_m" ("archive", "adm_yr");
CREATE INDEX "ix_section_archive" ON "student_m" ("class_section_id", "archive");
CREATE INDEX "ix_first_last" ON "student_m" ("first_name", "last_name");

--
-- Dumping data for table "student_m"
--

INSERT INTO "student_m" ("student_m_id", "admission_id", "admission_date", "student_id", "usn", "first_name", "middle_name", "last_name", "nationality", "religion", "gender", "caste_id", "dob", "age", "per_address", "per_city", "per_state", "per_country", "per_pincode", "per_phone", "cor_address", "cor_city", "cor_state", "cor_country", "cor_pincode", "cor_phone", "parent_name", "parent_occupation", "parent_income", "loc_address", "loc_city", "loc_state", "loc_country", "loc_pincode", "loc_phone", "course_admitted", "course_yearsem", "quota_id", "academic_year", "remarks", "username", "password", "archive", "class_section_id", "parent_username", "password_hash", "count", "blood_group", "admission_type", "img_source", "img_source_s", "marital_status", "mentor", "m_email", "mnum", "g_name", "g_occ", "g_in", "g_num", "g_mail", "f_email", "place_of_birth", "f_quali", "m_quali", "g_quali", "lang_id", "State", "sms_mobile", "mother_tongue", "birth_disct", "stud_type", "vdate", "m_name", "m_occ", "m_inc", "foadd", "moadd", "goadd", "adm_yr", "tcid", "tcdate", "msgphone", "rgmailid", "mother_email", "f_org", "m_org", "g_org", "f_desg", "m_desg", "g_desg", "fpan_no", "mpan_no", "gpan_no", "office", "per_grade", "residence", "parent_org", "hear_school", "parent_desig", "passport_type", "per_school_name", "enquiry_type", "action", "adminpack", "inserted_date", "inserted_time", "status", "sem_elig", "apl_prev", "m_occp", "f_occp") VALUES
(1, '129720', '2010-02-16', 'A233', '', 'S.Sri', '', 'Krishna', 13, 0, 'M', '', '2001-07-19', '12', '', '', '', '', '', '', 'Flat No. 1904, 19th Flr Tower-II Raheja Tipco Heights, Rani Sati Marg, Malad (E)', 'Mumbai', 'Maharashtra', 'India', '400097', '022 42665185 / 40700', 'S. Sri Shankar ', 'Employee', 0.00, 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 3, 11, 0, '2026', '', 'A233', '129720', 'N', 44, '12345', '12345', 1, 'NA', '1', '../student_images/A233.JPG', 'srikrishna.srishankar@email.com', '', 'NULL', 'vidyalakshmishankar@email.com', '0', '', '', 0, '0', '', 'srishankarsrivatsa@email.com', '', '', '', '', '', '', '0000000000', 6, '', '', NULL, 'Srividyalakshmi Vaithianathan ', 'Ca Finance', '', 'Bkc -', '1904 19th Floor, Tower Ii, Raheja Tipco Heights Malad East', '', NULL, 0, NULL, 0000000000, 'srishankarsrivatsa@email.com', 'NULL', '', '', '', '', '', '', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'Disapprove', 'N', NULL, '00:00:00', 1, 0, NULL, '', ''),
(2, '1206018', '2026-07-16', 'A921', '', 'Arsalaan', '', 'Abbas', 13, 0, 'M', '', '2002-02-18', '11', '', '', '', '', '', '', 'Raj Classic, B1507/08, Powai Marg, Off Yari Rd, Versova, Andheri (W)', 'Mumbai', 'Maharashtra', 'India', '400061', '022-26315140', 'Roshan Abbas ', 'Media Entrepreneur', 0.00, 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 3, 10, 0, '2026', '', 'A921', '1206018', 'N', 0, '12345', '12345', 0, 'NA', '1', '../student_images/img3/2.jpg', 'arsalaan.abbas@email.com', '', 'NULL', 'shaheen@email.com', '0000000000', '', '', 0, '0', '', 'roshanabbas1970@email.com', '', '', '', '', '', '', '0000000000', 28, '', '', NULL, 'Shaheen Abbas ', 'Jewellry Designer', '', '401,Trans Avenue,Behind Mahada Tel.Exchange,Andheri (w) - 400053', 'Raj Classic,B1507/08,Off Yari Rd,Versova,Andheri (w) - 400061', '', NULL, 0, NULL, 0000000000, 'roshanabbas1970@email.com', 'NULL', 'Encompass Events Pvt Ltd', 'Flower Child', '', '', '', '', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'Disapprove', 'N', NULL, '00:00:00', 1, 0, NULL, '', ''),
(3, '1205821', '2026-04-07', 'A920', 'NULL', 'Ayatal', '', 'Abbas', 13, NULL, 'F', 'NULL', '2007-07-18', '6', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'Raj Classic, B1507/08, Panch Marg, Off Yari Rd Versova, Andheri (W)', 'Mumbai', 'Maharashtra', 'India', '400061', '022-26315140', 'Roshan Abbas ', 'Media Entrepreneur', NULL, 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 2, 5, NULL, '2026', 'NULL', '1205821', '1205821', 'N', 13, '12345', '12345', 0, 'NULL', '1', '../student_images/A920.JPG', 'roshanabbas1970@email.com,roshan@encompass.in,shaheen@email.com', '', 'NULL', 'shaheen@email.com', '0000000000', '', '', NULL, '0', '', 'roshanabbas1970@email.com', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', '0000000000', 28, 'NULL', 'NULL', NULL, 'Shaheen Abbas ', 'Jewellry Designer', 'NULL', '401,Trans Avenue,Behind Mahada Tel.Exchange,Andheri (w) - 400053', 'Raj Classic,B1507/08,Off Yari Rd,Versova,Andheri (w) - 400061', 'NULL', NULL, 0, NULL, 0000000000, 'roshanabbas1970@email.com', 'NULL', 'Encompass Events Pvt Ltd', 'Flower Child', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'Disapprove', 'N', NULL, '00:00:00', 1, 0, NULL, '', ''),
(4, '1201032', '2010-05-29', 'A310', '', 'Mael', 'Abdoun', 'Guezennec', 11, 0, 'M', '', '2005-04-01', '8', '', '', '', '', '', '', 'A - 1803, Oberoi Woods, Mohan Gokhale Rd, Off WE Hwy, Goregaon (E)', 'Mumbai', 'Maharashtra', 'India', '400063', '', 'Olivier Abdoun ', 'Software Engineer', 0.00, 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 2, 7, 0, '2026', '', '1201032', '1201032', 'N', 26, '12345', '12345', 0, 'NA', '1', '../student_images/A310.JPG', '', '', 'NULL', 'soazic.guezennec@email.com', '0000000000', '', '', 0, '0', '', 'oabdoun@email.com', '', '', '', '', '', '', '9920709193', 8, '', '', NULL, 'Soazic Guezennec ', 'Artist', '', 'Tour Manhattan 5 - 6, Place De L''iris 92 926 Paris La Defense Cedex', '69 Bud Henri Barbusse Montreuil', '', NULL, 0, NULL, 0000000000, 'oliver.abdoun@atos.net', 'NULL', 'Tour Manhattan', '', '', '', '', '', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'Disapprove', 'N', NULL, '00:00:00', 1, 0, NULL, '', ''),
(5, '1206748', '2026-09-07', 'A1117', 'NULL', 'Devyani', '', 'Abhyankar', 13, NULL, 'F', 'NULL', '2003-03-08', '10', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', '15, Yugprabhat, Narayan Pathare Rd, Mahim', 'Mumbai', 'Maharashtra', 'India', '400016', '022-24452623', 'Ravindra Abhyankar ', '0', NULL, 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 2, 9, NULL, '2026', 'NULL', '1206748', '1206748', 'N', 37, '12345', '12345', 2, 'NULL', '1', '../student_images/A1117.JPG', 'devyani.abhyankar@email.com', '', 'NULL', 'mena.malgonkar@email.com', '9821883333', '', '', NULL, '0', '', 'ravi.abhyankar@email.com', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', '0000000000', 18, 'NULL', 'NULL', NULL, 'Mena Malgavkar ', '0', 'NULL', '0', '0', 'NULL', NULL, 0, NULL, 0000000000, 'ravi.abhyankar@email.com', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'Disapprove', 'N', NULL, '00:00:00', 1, 0, NULL, '', ''),
(6, '1204079', '2026-06-06', 'A728', '', 'Tanishqa', '', 'Abraham', 13, 0, 'F', '', '1998-09-20', '15', '', '', '', '', '', '', '2C/63, Windermere, Oshiwara, Andheri (W)', 'Mumbai', 'Maharashtra', 'India', '400053', '02226355661/26334958', 'Archie Abraham ', '0', 0.00, 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 4, 14, 0, '2026', '', '1204079', '1204079', 'N', 52, '12345', '12345', 0, 'NA', '1', '../student_images/img4/6.JPG', 'tanishqa.abraham@email.com', '', 'NULL', 'estherabraham02@email.com', '0000000000', '', '', 0, '0', '', 'archie@aiplgroup.co.in', '', '', '', '', '', '', '0000000000', 8, '', '', NULL, 'Esther Abraham ', '0', '', '0', '0', '', NULL, 0, NULL, 0000000000, 'archie@aiplgroup.co.in', 'NULL', '', '', '', '', '', '', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'Disapprove', 'N', NULL, '00:00:00', 1, 0, NULL, '', ''),
(7, '1208113', NULL, 'A12203', 'NULL', 'Saiesha', '', 'Adhalrao', 13, NULL, 'F', 'NULL', '2010-11-12', '3', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', '1002, B-Wing,Valencia, Hiranandani Gardens, Powai', 'Mumbai', 'Maharashtra', 'India', '400076', '022-25704975', 'Akshay Adhalrao ', '0', NULL, 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 1, 1, NULL, '2026', 'NULL', '1208113', '1208113', 'N', 0, '12345', 'saiesha@11', 1, 'NULL', '1', '../student_images/A12203.JPG', 'akshay@email.com', '', 'NULL', 'madhuri@email.com', '0000000000', '', '', NULL, '0', '', 'akshay@email.com', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', '0000000000', NULL, 'NULL', 'NULL', NULL, 'Madhuri Adhalrao ', '0', 'NULL', '0', '0', 'NULL', NULL, 0, NULL, 0000000000, 'akshay@email.com', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'Disapprove', 'N', NULL, '00:00:00', 1, 0, NULL, '', ''),
(8, '1206173', '2026-02-07', 'A1100', 'NULL', 'Aaria', '', 'Adhvaryu', 13, NULL, 'F', 'NULL', '2009-03-30', '4', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', '1601, Rajshree 1, Royal Complex, Eksar Rd, Borivali (W)', 'Mumabi', 'Maharashtra', 'India', '400092', '022-28902092', 'Jay Adhvaryu ', 'Business', NULL, 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 2, 3, NULL, '2026', 'NULL', '1206173', '1206173', 'N', 7, '12345', '12345', 0, 'NULL', '1', '../student_images/A1100.JPG', 'j7@email.com,meghnashsh1@email.com', '', 'NULL', 'meghnashah1@email.com', '0000000000', '', '', NULL, '0', '', 'j7@email.com', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', '0000000000', 8, 'NULL', 'NULL', NULL, 'Meghna Adhvaryu ', 'Advocate', 'NULL', 'B - 202 City Point,J.B Nagar,Andheri (e) - 400059', 'Yusuf Bldg,3rd Floor,Fountain,Fort - 400001', 'NULL', NULL, 0, NULL, 0000000000, 'j7@email.com', 'NULL', 'Safforn Capital', 'Mis Malvi Ranchoddas', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'Disapprove', 'N', NULL, '00:00:00', 1, 0, NULL, '', ''),
(9, '1208125', '2026-09-04', 'A12252', '', 'Zahra', '', 'Affendi', 13, 0, 'F', '', '2009-12-27', '4', '', '', '', '', '', '', '103, Silver Cascade Apts, Mount Mary Rd, Nr Mount Mary Curch, Bandra (W)', 'Mumbai', 'Maharahstra', 'India', '400050', '022-26411000', 'Kavish Affendi ', '0', 0.00, 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 2, 2, 0, '2026', '', '1208125', '1208125', 'N', 0, '12345', '12345', 0, 'NA', '1', '../student_images/A12252.JPG', 'kavish.affendi@email.com', '', 'NULL', 'sabahet22@mail.co.in', '0', '', '', 0, '0', '', 'kavish.affendi@email.com', '', '', '', '', '', '', '0000000000', 9, '', '', NULL, 'Saba Affendi ', '0', '', '0', '0', '', NULL, 0, NULL, 0000000000, 'kavish.affendi@email.com', 'NULL', '', '', '', '', '', '', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'Disapprove', 'N', NULL, '00:00:00', 1, 0, NULL, '', ''),
(10, '1206754', '2026-09-07', 'A1187', 'NULL', 'Aditya', '', 'Agarwal', 13, NULL, 'M', 'NULL', '1996-07-07', '17', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', '2601 Verona, Hiranandani Gardens, Powai', 'Mumbai', 'Maharahstra', 'India', '400076', '40055469', 'Arvind Agarwal ', '0', NULL, 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 4, 16, NULL, '2026', 'NULL', '1206754', '1206754', 'N', 57, '12345', '12345', NULL, 'NULL', '1', '../student_images/A1187.JPG', 'aditya.agarwal@email.com', '', 'NULL', 'nirupama09@email.com', '0000000000', '', '', NULL, '0', '', 'aagarwal1602@email.com', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', '00000000000', NULL, 'NULL', 'NULL', NULL, 'Nirupama Agarwal ', '0', 'NULL', '0', '0', 'NULL', NULL, 0, NULL, 00000000000, 'aagarwal1602@email.com', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'Disapprove', 'N', NULL, '00:00:00', 1, 0, NULL, '', '');

-- --------------------------------------------------------

--
-- Table structure for table "student_mail_list"
--

CREATE TABLE IF NOT EXISTS "student_mail_list" (
  "student_mail_list_id"               SERIAL,
  "date_entered"     DATE                DEFAULT NULL,
  "staff_delete_vt"  INT                 NOT NULL,
  "staff_idss"       INT                 NOT NULL,
  "store_ids"        INT                 NOT NULL,
  "student_id"       VARCHAR(255)        DEFAULT NULL,
  "first_name"       VARCHAR(255)        DEFAULT NULL,
  "last_name"        VARCHAR(255)        DEFAULT NULL,
  "stud_mailss"      VARCHAR(255)        DEFAULT NULL,
  "emrgcy_mails"     VARCHAR(255)        DEFAULT NULL,
  "parent_name"      VARCHAR(255)        DEFAULT NULL,
  "m_name"           VARCHAR(255)        DEFAULT NULL,
  "f_email"          VARCHAR(255)        DEFAULT NULL,
  "m_email"          VARCHAR(255)        DEFAULT NULL,
  "g_name"           VARCHAR(255)        DEFAULT NULL,
  "g_mail"           VARCHAR(255)        DEFAULT NULL,
  "user"             VARCHAR(255)        DEFAULT NULL,
  "status"           INT                 NOT NULL DEFAULT 0,
  "person_type"      VARCHAR(255)        NOT NULL,
  "staff_mailid"     VARCHAR(255)        DEFAULT NULL,
  PRIMARY KEY ("student_mail_list_id")
);

CREATE INDEX "ix_student_id" ON "student_mail_list" ("student_id");
CREATE INDEX "ix_date_status" ON "student_mail_list" ("date_entered", "status");

--
-- Dumping data for table "student_mail_list"
--

INSERT INTO "student_mail_list" ("student_mail_list_id", "date_entered", "staff_delete_vt", "staff_idss", "store_ids", "student_id", "first_name", "last_name", "stud_mailss", "emrgcy_mails", "parent_name", "m_name", "f_email", "m_email", "g_name", "g_mail", "user", "status", "person_type", "staff_mailid") VALUES
(234189, '2026-03-28', 0, 0, 8524343, '1274', 'Aanchal', 'Vyas', 'aanchal.vyas@email.com', 'vyasdevelopers@email.com', 'Vyas, Sanjay', 'Vyas, Snehal', 'vyasdevelopers@email.com', 'vyasdevelopers@email.com', '', '', 'crystalv', 0, 'student', NULL),
(234190, '2026-03-28', 0, 0, 8524343, '874', 'Dinisha', 'Patel', 'dinisha.patel@email.com', 'ppatelasda@email.com', 'Patel, Purvin', 'Patel, Gayatri', 'ppatelasda@email.com', 'gayatri203patel@email.com', '', '', 'crystalv', 0, 'student', NULL),
(234191, '2026-03-28', 0, 0, 8524343, '1009', 'Dzhina', 'Sarasvat', 'dzhina.sarasvat@email.com', 'satyen.saraswat@email.com', 'Saraswat, Satyen', 'Sarasvat, Irina', 'satyen.saraswat@email.com', 'irinasar15@mail.ru', '', '', 'crystalv', 0, 'student', NULL),
(234192, '2026-03-28', 0, 0, 8524343, '978', 'Ishani', 'Ruia', 'ishani.ruia@email.com', 'ruiamr@email.com', 'Ruia, Mukesh', 'Ruia, Kalpana', 'ruiamr@mail.co.in', 'ruiakm@email.com', '', '', 'crystalv', 0, 'student', NULL),
(234193, '2026-03-28', 0, 0, 8524343, '219', 'Jash', 'Chheda', 'jash.chheda@email.com', 'mmc@email.com', 'Chheda, Manish', 'Chheda, Payal', 'mmc@email.com', 'payal0710@email.com', 'Chheda, Mulchan', 'msc@email.com', 'crystalv', 0, 'student', NULL),
(234194, '2026-03-28', 0, 0, 8524343, '1255', 'Mandira', 'Venkataraman', 'mandira.venkataraman@email.com', 'venkat.mallikarunan@email.com', 'Venkataraman, Mallikarjunan', 'Venkataraman, Elizabeth', 'venkatmallik@hotmail.com', 'elizabeth.venkataraman@email.com', '', '', 'crystalv', 0, 'student', NULL),
(234195, '2026-03-28', 0, 0, 8524343, '869', 'Noyyo', 'Parulekar', 'noyyo.parulekar@oberoi-is.ne', 'niteen.parulekar@email.com', 'Parulekar, Niteen', 'Parulekar, Lipeeka', 'niteen.parulekar@email.com', 'lipikaparulekar@email.com', '', '', 'crystalv', 0, 'student', NULL),
(234196, '2026-03-28', 0, 0, 8524343, '888', 'Saipriya', 'Patro', 'saipriya.patro@email.com', 'sam@email.com', 'Patro, Sairam', 'Patro, Anita', 'sam@email.com', 'anita.patro@email.com', '', '', 'crystalv', 0, 'student', NULL),
(234197, '2026-03-28', 0, 0, 8524343, '853', 'Zubin', 'Pande', 'zubin.pande@email.com', 'dhananjaypande@email.com', 'Pande, Dhananjay', 'Pande, Medini', 'dhananjaypande@email.com', 'medinipande@email.com', 'Pande, Sanjay', '0', 'crystalv', 0, 'student', NULL);

-- --------------------------------------------------------

--
-- Table structure for table "student_modify"
--

CREATE TABLE IF NOT EXISTS "student_modify" (
  "student_modify_id"                      SERIAL,
  "student_field_name"      VARCHAR(50)  NOT NULL,
  "student_interface_name"  VARCHAR(50)  NOT NULL,
  PRIMARY KEY ("student_modify_id")
);

--
-- Dumping data for table "student_modify"
--

INSERT INTO "student_modify" ("student_modify_id", "student_field_name", "student_interface_name") VALUES
(1, 'id', 'id'),
(2, 'admission_id', 'Admission_Number'),
(3, 'admission_date', 'Admission_Date'),
(4, 'student_id', 'Student_ID'),
(5, 'usn', 'usn'),
(6, 'first_name', 'First_Name'),
(7, 'last_name', 'Last_Name'),
(8, 'nationality', 'Nationality'),
(9, 'religion', 'Religion'),
(10, 'gender', 'Gender');

-- --------------------------------------------------------

--
-- Table structure for table "student_m_adminpack"
--

CREATE TABLE IF NOT EXISTS "student_m_adminpack" (
  "student_m_adminpack_id"             SERIAL,
  "reg_code"       VARCHAR(20)  DEFAULT NULL,
  "app_no"         VARCHAR(20)  DEFAULT NULL,
  "enquiry"        VARCHAR(20)  DEFAULT NULL,
  "handover_date"  DATE         DEFAULT NULL,
  "courier"        VARCHAR(20)  DEFAULT NULL,
  "consignment"    VARCHAR(20)  DEFAULT NULL,
  "send_date"      DATE         DEFAULT NULL,
  "receive_date"   DATE         DEFAULT NULL,
  "action"         VARCHAR(10)  DEFAULT 'Disapprove',
  "inserted_date"  DATE         DEFAULT NULL,
  "inserted_time"  TIME         DEFAULT NULL,
  "status"         SMALLINT   DEFAULT 1,
  PRIMARY KEY ("student_m_adminpack_id")
);

--
-- Dumping data for table "student_m_adminpack"
--

INSERT INTO "student_m_adminpack" ("student_m_adminpack_id", "reg_code", "app_no", "enquiry", "handover_date", "courier", "consignment", "send_date", "receive_date", "action", "inserted_date", "inserted_time", "status") VALUES
(1, '100001', '12345', 'courier_service', NULL, 'DTDC', '12346', '2026-02-20', '2026-02-26', 'Disapprove', '2026-02-26', '16:15:38', 1),
(2, '100002', '12347', 'manual_handover', '2026-02-10', '', '', NULL, '2026-02-26', 'Approve', '2026-02-26', '16:16:08', 1),
(3, '100003', '12348', 'courier_service', NULL, 'Blue Dart', '12349', '2026-02-18', '2026-02-26', 'Approve', '2026-02-26', '17:06:03', 1),
(4, '100004', '12349', 'manual_handover', '2026-03-01', '', '', NULL, '2026-01-08', 'Approve', '2026-03-01', '11:20:53', 1);

-- --------------------------------------------------------

--
-- Table structure for table "student_m_appointment"
--

CREATE TABLE IF NOT EXISTS "student_m_appointment" (
  "student_m_appointment_id"             SERIAL,
  "student_name"   VARCHAR(100)  DEFAULT NULL,
  "parent_name"    VARCHAR(100)  DEFAULT NULL,
  "dob"            DATE          DEFAULT NULL,
  "mobile"         VARCHAR(30)   DEFAULT NULL,
  "email"          VARCHAR(255)  DEFAULT NULL,
  "description"    TEXT,
  "app_date"       TIMESTAMP      DEFAULT NULL,
  "inserted_date"  DATE          DEFAULT NULL,
  "inserted_time"  TIME          DEFAULT NULL,
  "status"         SMALLINT    DEFAULT 1,
  PRIMARY KEY ("student_m_appointment_id")
);

--
-- Dumping data for table "student_m_appointment"
--

INSERT INTO "student_m_appointment" ("student_m_appointment_id", "student_name", "parent_name", "dob", "mobile", "email", "description", "app_date", "inserted_date", "inserted_time", "status") VALUES
(1, 'Pradeep Kumar', 'Kumar Sharma', '2026-01-30', '7760653743', 'pradeep.vwa@email.com', 'hi', '2026-02-20 12:46:32', '2026-02-13', '17:59:53', 1),
(2, 'Pradeep Kumar', 'Kumar Sharma', '2026-02-28', '7760653743', 'pradeep.vwa@email.com', 'hi', '2026-02-20 12:49:35', '2026-02-13', '19:57:03', 1);

-- --------------------------------------------------------

--
-- Table structure for table "student_m_ec"
--

CREATE TABLE IF NOT EXISTS "student_m_ec" (
  "student_m_ec_id"             SERIAL,
  "fname"          VARCHAR(100)  DEFAULT NULL,
  "lname"          VARCHAR(100)  DEFAULT NULL,
  "relation"       VARCHAR(50)   DEFAULT NULL,
  "countryCode"    INT           DEFAULT NULL,
  "home_phone"     BIGINT        DEFAULT NULL,
  "cell_phone"     BIGINT        DEFAULT NULL,
  "work_phone"     BIGINT        DEFAULT NULL,
  "email"          VARCHAR(255)  DEFAULT NULL,
  "note"           TEXT,
  "inserted_date"  DATE          DEFAULT NULL,
  "status"         SMALLINT    DEFAULT 1,
  PRIMARY KEY ("student_m_ec_id")
);

--
-- Dumping data for table "student_m_ec"
--

INSERT INTO "student_m_ec" ("student_m_ec_id", "fname", "lname", "relation", "countryCode", "home_phone", "cell_phone", "work_phone", "email", "note", "inserted_date", "status") VALUES
(1, 'Pradeep', 'Kumar', 'Brother', 91, 7760653743, 7760653743, 7760653743, 'pradeep.vwa@email.com', 'Hi,This is Pradeep Kumar.', '2026-07-26', 0),
(2, 'Kumar', 'Pradeep', 'Brother', 91, 0, 0, 0, '', '', '2026-07-26', 0),
(3, 'Pradeep', '', '', 0, 0, 0, 0, '', '', '2026-10-24', 0),
(4, 'Kumar', '', '', 0, 0, 0, 0, '', '', '2026-10-24', 0),
(5, 'Pradeep', '', '', 0, 0, 0, 0, '', '', '2026-12-11', 0),
(6, 'Sharma', '', '', 0, 0, 0, 0, '', '', '2026-10-24', 0),
(7, 'Pradeep', '', '', 0, 0, 0, 0, '', '', '2026-12-11', 0),
(8, 'Pradeep', '', '', 0, 0, 0, 0, '', '', '2026-12-11', 0);

-- --------------------------------------------------------

--
-- Table structure for table "student_m_enquirystatus"
--

CREATE TABLE IF NOT EXISTS "student_m_enquirystatus" (
  "student_m_enquirystatus_id"      SERIAL,
  "name"    VARCHAR(20)  DEFAULT NULL,
  "status"  SMALLINT   DEFAULT 1,
  PRIMARY KEY ("student_m_enquirystatus_id")
);

--
-- Dumping data for table "student_m_enquirystatus"
--

INSERT INTO "student_m_enquirystatus" ("student_m_enquirystatus_id", "name", "status") VALUES
(1, 'To be Scheduled', 1),
(2, 'Invited', 1),
(3, 'Completed', 1),
(4, 'Received', 1),
(5, 'Not Received', 1);

-- --------------------------------------------------------

--
-- Table structure for table "student_m_event"
--

CREATE TABLE IF NOT EXISTS "student_m_event" (
  "student_m_event_id"      SERIAL,
  "event"   VARCHAR(100)  DEFAULT NULL,
  "status"  SMALLINT    DEFAULT 1,
  PRIMARY KEY ("student_m_event_id")
);

--
-- Dumping data for table "student_m_event"
--

INSERT INTO "student_m_event" ("student_m_event_id", "event", "status") VALUES
(1, 'Academic Event', 1),
(2, 'Attendance Notice', 1),
(3, 'Bullying/intimidation', 1),
(4, 'Cell phone usage in school', 1),
(5, 'Cheating', 1),
(6, 'Chewing gum', 1),
(7, 'Christian Behavior', 1),
(8, 'Class disruption', 1),
(9, 'Complements', 1),
(10, 'Crude language', 1),
(11, 'Destruction of school property', 1),
(12, 'Disrespectful', 1),
(13, 'Dress code violation', 1),
(14, 'Excessive Absences', 1),
(15, 'Excessive tardies', 1),
(16, 'Failure to appear for detention', 1),
(17, 'Fighting', 1),
(18, 'Fines', 1),
(19, 'Food Fight', 1),
(20, 'Graffiti', 1),
(21, 'Helped in the cafeteria ', 1),
(22, 'Helping an old lady across the street', 1),
(23, 'Horseplay', 1),
(24, 'In off-limits area of campus', 1),
(25, 'Inattentive', 1),
(26, 'Littering', 1),
(27, 'Lying', 1),
(28, 'name calling and spitting', 1),
(29, 'Not prepared for class', 1),
(30, 'Off campus lunch tardy', 1),
(31, 'On campus driving violation', 1),
(32, 'Profanity', 1),
(33, 'Report of unsatisfactory conduct', 1),
(34, 'Restless', 1),
(35, 'Sexual harrassment', 1),
(36, 'Skipping Class', 1),
(37, 'Smoking', 1),
(38, 'Talking', 1),
(39, 'Tardiness', 1),
(40, 'TARDY', 1),
(41, 'Theft', 1),
(42, 'throwing rocks', 1),
(43, 'Unsatisfactory progress', 1),
(44, 'Used Cell Phone', 1),
(45, 'Was very good today', 1),
(46, 'Yelling in the Hallway', 1);

-- --------------------------------------------------------

--
-- Table structure for table "student_m_field"
--

CREATE TABLE IF NOT EXISTS "student_m_field" (
  "student_m_field_id"             SERIAL,
  "tab_id"         INT           DEFAULT NULL,
  "order"          INT           DEFAULT NULL,
  "user_name"      VARCHAR(255)  DEFAULT NULL,
  "field_name"     VARCHAR(100)  DEFAULT NULL,
  "display_name"   VARCHAR(100)  DEFAULT NULL,
  "field_type"     VARCHAR(10)   DEFAULT NULL,
  "mandatory"      SMALLINT    DEFAULT 0,
  "inserted_date"  TIMESTAMP      DEFAULT NULL,
  "status"         SMALLINT    DEFAULT 1,
  PRIMARY KEY ("student_m_field_id")
);

--
-- Dumping data for table "student_m_field"
--

INSERT INTO "student_m_field" ("student_m_field_id", "tab_id", "order", "user_name", "field_name", "display_name", "field_type", "mandatory", "inserted_date", "status") VALUES
(1, 2, 5, 'administrator', 'admission_id', 'Application Number', 'INT', 0, '2026-05-21 16:02:52', 1),
(2, 2, 10, 'administrator', 'admission_date', 'Admission Date', 'DATE', 0, '2026-05-21 16:02:52', 1),
(3, 2, 0, 'administrator', 'course_admitted', 'School Division', 'SELECT', 1, '2026-05-21 16:02:52', 1),
(4, 2, 1, 'administrator', 'course_yearsem', 'Grade', 'SELECT', 1, '2026-05-21 16:02:52', 1),
(5, 2, 6, 'administrator', 'academic_year', 'Academic Year', 'SELECT', 1, '2026-05-21 16:02:52', 1),
(6, 2, 2, 'administrator', 'first_name', 'First Name', 'CHAR', 1, '2026-05-21 16:02:52', 1),
(7, 2, 3, 'administrator', 'last_name', 'Last Name', 'CHAR', 1, '2026-05-21 16:02:52', 1),
(8, 2, 4, 'administrator', 'student_id', 'Student ID', 'CHAR', 0, '2026-05-21 16:02:52', 1),
(9, 2, 7, 'administrator', 'dob', 'Date of Birth', 'SELECT', 1, '2026-05-21 16:02:52', 1),
(10, 2, 8, 'administrator', 'age', 'Age on Admission', 'INT', 0, '2026-05-21 16:02:52', 1),
(11, 2, 9, 'administrator', 'gender', 'Gender', 'SELECT', 1, '2026-05-21 16:02:52', 1),
(12, 2, 11, 'administrator', 'place_of_birth', 'Birth City', 'CHAR', 0, '2026-05-21 16:02:52', 1),
(13, 2, 12, 'administrator', 'birth_disct', 'Birth State', 'CHAR', 0, '2026-05-21 16:02:52', 1),
(14, 2, 13, 'administrator', 'State', 'Birth Country', 'CHAR', 0, '2026-05-21 16:02:52', 1),
(15, 2, 14, 'administrator', 'nationality', 'Nationality', 'SELECT', 1, '2026-05-21 16:02:52', 1),
(16, 2, 15, 'administrator', 'blood_group', 'Blood Group', 'SELECT', 0, '2026-05-21 16:02:52', 1),
(17, 2, 16, 'administrator', 'img_source', 'Student Photo', 'UPLOAD', 0, '2026-05-21 16:02:52', 1),
(18, 2, 17, 'administrator', 'img_source_s', 'E-Mail ID', 'CHAR', 0, '2026-05-21 16:02:52', 1),
(19, 2, 18, 'administrator', 'mother_tongue', 'Mother Tongue', 'SELECT', 1, '2026-05-21 16:02:52', 1),
(20, 3, 0, 'administrator', 'msgphone', 'MSG Phone number', 'INT', 1, '2026-05-21 16:02:52', 1),
(21, 3, 1, 'administrator', 'usn', 'EC number', 'INT', 1, '2026-05-21 16:02:52', 1),
(22, 3, 2, 'administrator', 'rgmailid', 'Mail-Id', 'CHAR', 1, '2026-05-21 16:02:52', 1),
(23, 4, 0, 'administrator', 'parent_name', 'Father Name', 'CHAR', 0, '2026-05-21 16:02:52', 1),
(24, 4, 1, 'administrator', 'parent_occupation', 'Father Occupation', 'CHAR', 0, '2026-05-21 16:02:52', 1),
(25, 4, 2, 'administrator', 'sms_mobile', 'Father Mobile Number', 'INT', 0, '2026-05-21 16:02:52', 1),
(26, 4, 3, 'administrator', 'f_email', 'Father E-mail', 'CHAR', 0, '2026-05-21 16:02:52', 1),
(27, 4, 4, 'administrator', 'f_quali', 'Father Qualification', 'CHAR', 0, '2026-05-21 16:02:52', 1),
(28, 4, 5, 'administrator', 'foadd', 'Father Office Address', 'TEXTAREA', 0, '2026-05-21 16:02:52', 1),
(29, 4, 6, 'administrator', 'm_name', 'Mother Name', 'CHAR', 0, '2026-05-21 16:02:52', 1),
(30, 4, 7, 'administrator', 'm_occ', 'Mother Occupation', 'CHAR', 0, '2026-05-21 16:02:52', 1),
(31, 4, 8, 'administrator', 'mnum', 'Mother Mobile Number', 'INT', 0, '2026-05-21 16:02:52', 1),
(32, 4, 9, 'administrator', 'm_email', 'Mother E-mail', 'CHAR', 0, '2026-05-21 16:02:52', 1),
(33, 4, 10, 'administrator', 'm_quali', 'Mother Qualification', 'CHAR', 0, '2026-05-21 16:02:52', 1),
(34, 4, 11, 'administrator', 'moadd', 'Mother Office Address', 'TEXTAREA', 0, '2026-05-21 16:02:52', 1),
(35, 4, 12, 'administrator', 'g_name', 'Guardian Name', 'CHAR', 0, '2026-05-21 16:02:52', 1),
(36, 4, 13, 'administrator', 'g_occ', 'Guardian Occupation', 'CHAR', 0, '2026-05-21 16:02:52', 1),
(37, 4, 14, 'administrator', 'g_num', 'Guardian  Mobile Number', 'INT', 0, '2026-05-21 16:02:52', 1),
(38, 4, 15, 'administrator', 'g_mail', 'Guardian  E-mail', 'CHAR', 0, '2026-05-21 16:02:52', 1),
(39, 4, 16, 'administrator', 'g_quali', 'Guardian  Qualification', 'CHAR', 0, '2026-05-21 16:02:52', 1),
(40, 4, 17, 'administrator', 'goadd', 'Guardian  Office Address', 'TEXTAREA', 0, '2026-05-21 16:02:52', 1),
(41, 5, 0, 'administrator', 'per_address', 'Present Address ', 'TEXTAREA', 0, '2026-05-21 16:02:52', 1),
(42, 5, 1, 'administrator', 'per_city', 'Present  City/Town', 'CHAR', 0, '2026-05-21 16:02:52', 1),
(43, 5, 2, 'administrator', 'per_state', 'Present State', 'CHAR', 0, '2026-05-21 16:02:52', 1),
(44, 5, 3, 'administrator', 'per_country', 'Present  Country', 'CHAR', 0, '2026-05-21 16:02:52', 1),
(45, 5, 4, 'administrator', 'per_pincode', 'Present  Pin Code', 'INT', 0, '2026-05-21 16:02:52', 1),
(46, 5, 5, 'administrator', 'per_phone', 'Present  Phone No', 'INT', 0, '2026-05-21 16:02:52', 1),
(47, 5, 6, 'administrator', 'cor_address', 'Permanent Address', 'TEXTAREA', 0, '2026-05-21 16:02:52', 1),
(48, 5, 7, 'administrator', 'cor_city', 'Permanent City/Town', 'CHAR', 0, '2026-05-21 16:02:52', 1),
(49, 5, 8, 'administrator', 'cor_state', 'Permanent State', 'CHAR', 0, '2026-05-21 16:02:52', 1),
(50, 5, 9, 'administrator', 'cor_country', 'Permanent Country', 'CHAR', 0, '2026-05-21 16:02:52', 1),
(51, 5, 10, 'administrator', 'cor_pincode', 'Permanent Pin Code', 'INT', 0, '2026-05-21 16:02:52', 1),
(52, 5, 11, 'administrator', 'cor_phone', 'Permanent Phone No', 'INT', 0, '2026-05-21 16:02:52', 1),
(53, 1, 5, 'administrator', 'admission_type', 'Admission Category', 'SELECT', 1, '2026-05-23 10:34:48', 1),
(56, 4, 18, 'administrator', 'Father_PAN', 'Father PAN', NULL, 0, '2026-11-15 14:34:25', 1),
(57, 4, 19, 'administrator', 'Mother_PAN', 'Mother PAN', NULL, 0, '2026-11-15 14:34:51', 1);

-- --------------------------------------------------------

--
-- Table structure for table "student_m_flexi"
--

CREATE TABLE IF NOT EXISTS "student_m_flexi" (
  "student_m_flexi_id"                      SERIAL,
  "inserted_date"           TIMESTAMP      DEFAULT NULL,
  "status"                  SMALLINT    DEFAULT 1,
  "Passport_No_8"           VARCHAR(100)  DEFAULT NULL,
  "Passport_Type_8"         VARCHAR(100)  DEFAULT NULL,
  "Passport_Issue_Date_8"   VARCHAR(100)  DEFAULT NULL,
  "Passport_Expiry_Date_8"  VARCHAR(100)  DEFAULT NULL,
  "Previous_School_Name_9"  VARCHAR(100)  DEFAULT NULL,
  "Previous_Grade_9"        VARCHAR(100)  DEFAULT NULL,
  "Email_ID_2"              VARCHAR(100)  DEFAULT NULL,
  "PS_No_2"                 VARCHAR(100)  DEFAULT NULL,
  "Other_Info_2"            VARCHAR(100)  DEFAULT NULL,
  "Sample_feild_10"         VARCHAR(100)  DEFAULT NULL,
  "Date_of_Joining_2"       VARCHAR(100)  DEFAULT NULL,
  "Passport_info_8"         VARCHAR(100)  DEFAULT NULL,
  "Father_PAN_4"            VARCHAR(100)  DEFAULT NULL,
  "Mother_PAN_4"            VARCHAR(100)  DEFAULT NULL,
  PRIMARY KEY ("student_m_flexi_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "student_m_online"
--

CREATE TABLE IF NOT EXISTS "student_m_online" (
  "student_m_online_id"                 SERIAL,
  "admission_id"       VARCHAR(20)        DEFAULT NULL,
  "admission_date"     DATE               DEFAULT NULL,
  "student_id"         VARCHAR(20)        DEFAULT NULL,
  "usn"                VARCHAR(20)        DEFAULT NULL,
  "first_name"         VARCHAR(30)        DEFAULT NULL,
  "middle_name"        VARCHAR(30)        NOT NULL,
  "last_name"          VARCHAR(30)        DEFAULT NULL,
  "nationality"        SMALLINT  DEFAULT NULL,
  "religion"           SMALLINT   DEFAULT NULL,
  "gender"             CHAR(1)            DEFAULT NULL,
  "caste_id"           VARCHAR(50)        DEFAULT NULL,
  "dob"                DATE               DEFAULT NULL,
  "age"                VARCHAR(10)        DEFAULT NULL,
  "per_address"        VARCHAR(250)       DEFAULT NULL,
  "per_city"           VARCHAR(100)       DEFAULT NULL,
  "per_state"          VARCHAR(50)        DEFAULT NULL,
  "per_country"        VARCHAR(50)        DEFAULT NULL,
  "per_pincode"        VARCHAR(7)         DEFAULT NULL,
  "per_phone"          VARCHAR(20)        DEFAULT NULL,
  "cor_address"        VARCHAR(250)       DEFAULT NULL,
  "cor_city"           VARCHAR(100)       DEFAULT NULL,
  "cor_state"          VARCHAR(50)        DEFAULT NULL,
  "cor_country"        VARCHAR(50)        DEFAULT NULL,
  "cor_pincode"        VARCHAR(7)         DEFAULT NULL,
  "cor_phone"          VARCHAR(20)        DEFAULT NULL,
  "parent_name"        VARCHAR(60)        DEFAULT NULL,
  "parent_occupation"  VARCHAR(30)        DEFAULT NULL,
  "parent_income"      NUMERIC(12,2)        DEFAULT NULL,
  "loc_address"        VARCHAR(250)       DEFAULT NULL,
  "loc_city"           VARCHAR(100)       DEFAULT NULL,
  "loc_state"          VARCHAR(50)        DEFAULT NULL,
  "loc_country"        VARCHAR(50)        DEFAULT NULL,
  "loc_pincode"        VARCHAR(7)         DEFAULT NULL,
  "loc_phone"          VARCHAR(20)        DEFAULT NULL,
  "course_admitted"    INT                DEFAULT NULL,
  "course_yearsem"     INT                DEFAULT NULL,
  "quota_id"           INT                DEFAULT NULL,
  "academic_year"      VARCHAR(12)        DEFAULT NULL,
  "remarks"            VARCHAR(250)       DEFAULT NULL,
  "username"           VARCHAR(15)        DEFAULT NULL,
  "password"           VARCHAR(255)       DEFAULT NULL,
  "archive"            VARCHAR(50)  DEFAULT 'N',
  "class_section_id"   SMALLINT         NOT NULL DEFAULT 0,
  "parent_username"    VARCHAR(15)        DEFAULT NULL,
  "password_hash"    VARCHAR(35)        DEFAULT NULL,
  "count"              INT                DEFAULT NULL,
  "blood_group"        VARCHAR(20)        DEFAULT NULL,
  "admission_type"     VARCHAR(10)        DEFAULT NULL,
  "img_source"         VARCHAR(255)       DEFAULT NULL,
  "img_source_s"       VARCHAR(255)       DEFAULT NULL,
  "marital_status"     VARCHAR(2)         NOT NULL,
  "mentor"             VARCHAR(15)        DEFAULT '',
  "m_email"            VARCHAR(100)       DEFAULT NULL,
  "mnum"               BIGINT             DEFAULT NULL,
  "g_name"             VARCHAR(15)        DEFAULT NULL,
  "g_occ"              VARCHAR(15)        DEFAULT NULL,
  "g_in"               BIGINT             DEFAULT NULL,
  "g_num"              BIGINT             DEFAULT NULL,
  "g_mail"             VARCHAR(100)       DEFAULT NULL,
  "f_email"            VARCHAR(100)       DEFAULT NULL,
  "place_of_birth"     VARCHAR(30)        DEFAULT NULL,
  "f_quali"            VARCHAR(30)        DEFAULT NULL,
  "m_quali"            VARCHAR(30)        DEFAULT NULL,
  "g_quali"            VARCHAR(30)        DEFAULT NULL,
  "lang_id"            VARCHAR(200)       DEFAULT NULL,
  "State"              VARCHAR(20)        DEFAULT 'Karnataka',
  "sms_mobile"         VARCHAR(15)        DEFAULT NULL,
  "mother_tongue"      SMALLINT   DEFAULT NULL,
  "birth_disct"        VARCHAR(100)       DEFAULT NULL,
  "stud_type"          VARCHAR(10)        DEFAULT NULL,
  "vdate"              DATE               DEFAULT NULL,
  "m_name"             VARCHAR(200)       DEFAULT NULL,
  "m_occ"              VARCHAR(200)       DEFAULT NULL,
  "m_inc"              VARCHAR(15)        DEFAULT NULL,
  "foadd"              VARCHAR(255)       DEFAULT NULL,
  "moadd"              VARCHAR(255)       DEFAULT NULL,
  "goadd"              VARCHAR(255)       DEFAULT NULL,
  "adm_yr"             SMALLINT  DEFAULT NULL,
  "tcid"               BIGINT             NOT NULL DEFAULT 0,
  "tcdate"             DATE               NOT NULL,
  "msgphone"           BIGINT             NOT NULL,
  "rgmailid"           VARCHAR(100)       NOT NULL,
  "mother_email"       VARCHAR(30)        DEFAULT NULL,
  "f_org"              VARCHAR(100)       DEFAULT NULL,
  "m_org"              VARCHAR(100)       DEFAULT NULL,
  "g_org"              VARCHAR(100)       DEFAULT NULL,
  "f_desg"             VARCHAR(100)       DEFAULT NULL,
  "m_desg"             VARCHAR(100)       DEFAULT NULL,
  "g_desg"             VARCHAR(100)       DEFAULT NULL,
  "fpan_no"            VARCHAR(20)        DEFAULT NULL,
  "mpan_no"            VARCHAR(20)        DEFAULT NULL,
  "gpan_no"            VARCHAR(20)        DEFAULT NULL,
  "office"             VARCHAR(255)       DEFAULT NULL,
  "per_grade"          VARCHAR(100)       DEFAULT NULL,
  "residence"          VARCHAR(255)       DEFAULT NULL,
  "parent_org"         TEXT,
  "hear_school"        VARCHAR(255)       DEFAULT NULL,
  "parent_desig"       VARCHAR(100)       DEFAULT NULL,
  "passport_type"      VARCHAR(20)        DEFAULT NULL,
  "per_school_name"    VARCHAR(255)       DEFAULT NULL,
  "enquiry_type"       VARCHAR(10)        DEFAULT NULL,
  "action"             VARCHAR(30)        DEFAULT NULL,
  "adminpack"          VARCHAR(2)         DEFAULT 'N',
  "inserted_date"      DATE               DEFAULT NULL,
  "inserted_time"      TIME               DEFAULT NULL,
  "status"             SMALLINT         DEFAULT 1,
  "sem_elig"           SMALLINT   NOT NULL,
  "apl_prev"           SMALLINT   DEFAULT NULL,
  "m_occp"             VARCHAR(250)       NOT NULL,
  "f_occp"             VARCHAR(250)       NOT NULL,
  PRIMARY KEY ("student_m_online_id")
);

--
-- Dumping data for table "student_m_online"
--

INSERT INTO "student_m_online" ("student_m_online_id", "admission_id", "admission_date", "student_id", "usn", "first_name", "middle_name", "last_name", "nationality", "religion", "gender", "caste_id", "dob", "age", "per_address", "per_city", "per_state", "per_country", "per_pincode", "per_phone", "cor_address", "cor_city", "cor_state", "cor_country", "cor_pincode", "cor_phone", "parent_name", "parent_occupation", "parent_income", "loc_address", "loc_city", "loc_state", "loc_country", "loc_pincode", "loc_phone", "course_admitted", "course_yearsem", "quota_id", "academic_year", "remarks", "username", "password", "archive", "class_section_id", "parent_username", "password_hash", "count", "blood_group", "admission_type", "img_source", "img_source_s", "marital_status", "mentor", "m_email", "mnum", "g_name", "g_occ", "g_in", "g_num", "g_mail", "f_email", "place_of_birth", "f_quali", "m_quali", "g_quali", "lang_id", "State", "sms_mobile", "mother_tongue", "birth_disct", "stud_type", "vdate", "m_name", "m_occ", "m_inc", "foadd", "moadd", "goadd", "adm_yr", "tcid", "tcdate", "msgphone", "rgmailid", "mother_email", "f_org", "m_org", "g_org", "f_desg", "m_desg", "g_desg", "fpan_no", "mpan_no", "gpan_no", "office", "per_grade", "residence", "parent_org", "hear_school", "parent_desig", "passport_type", "per_school_name", "enquiry_type", "action", "adminpack", "inserted_date", "inserted_time", "status", "sem_elig", "apl_prev", "m_occp", "f_occp") VALUES
(1000000, NULL, '2026-10-09', NULL, NULL, 'Chayn', '', 'Gupta Murthy ', 6, NULL, NULL, NULL, '2010-10-15', NULL, '8A, Hilltop Apartments,\nPali Hill, \nBandra West\nBombay 400050', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Ansoo Gupta', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, 3, NULL, '2026', NULL, NULL, NULL, 'N', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', 'mahesh.murthy@email.com', 0000000000, NULL, NULL, NULL, NULL, NULL, 'nsoogupta@email.com', NULL, NULL, NULL, NULL, NULL, 'Karnataka', 0000000000, NULL, NULL, NULL, NULL, 'Mahesh Murthy', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, '', NULL, 'Pinstorm', 'Seedfund', NULL, 'Chief Operating Officer', 'Managing Partner', NULL, NULL, NULL, NULL, NULL, NULL, 'Montessori', NULL, 'Half-brother - Agni Murthy - studies in OIS, in Grade 11', NULL, NULL, 'Little Butterflies', NULL, NULL, 'N', NULL, NULL, 1, 0, NULL, 'Venture Capital', 'Digital Media'),
(1000001, NULL, '2026-10-09', NULL, NULL, 'Nishil', '', 'Parwani  ', 31, NULL, NULL, NULL, '2026-12-02', NULL, '32/02 C Wing, Oberoi Springs, Off New Link Road, Opposite Citi Mall, Andheri West, Mumbai 400053, India', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Seema Parwani', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, NULL, '2026', NULL, NULL, NULL, 'N', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', 'sameer@email.com', 0000000000, NULL, NULL, NULL, NULL, NULL, 'seema.parwani@email.com', NULL, NULL, NULL, NULL, NULL, 'Karnataka', 0000000000, NULL, NULL, NULL, NULL, 'Sameer Parwani', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, '', NULL, 'Education', 'IT', NULL, 'Oberoi International School', 'Coupon Dunia', NULL, NULL, NULL, NULL, NULL, NULL, 'Not Applicable', NULL, 'I am a teacher at your school.', NULL, NULL, 'Not Applicable', NULL, NULL, 'N', NULL, NULL, 1, 0, NULL, 'Computer Engineer', 'Teacher'),
(1000002, NULL, '2026-10-09', NULL, NULL, 'Renaya', '', 'Batra  ', 13, NULL, NULL, NULL, '2009-06-08', NULL, 'Plot no 40. Renaissance Bldg, 4th floor, Gulmohar Road no 1, JVPD Scheme, Next to Criti Care Hospital, Juhu. Mumbai 400049', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Rohini Batra', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, 4, NULL, '2026', NULL, NULL, NULL, 'N', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', 'rishi_batra@email.com', 0000000000, NULL, NULL, NULL, NULL, NULL, 'batrarohini@email.com', NULL, NULL, NULL, NULL, NULL, 'Karnataka', 0000000000, NULL, NULL, NULL, NULL, 'Rishi Batra', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, '', NULL, 'NotApplicable', 'Family Business', NULL, 'Home-maker', 'Administration Manager', NULL, NULL, NULL, NULL, NULL, NULL, 'ICSE', NULL, 'Through friends.', NULL, NULL, 'Camlin Alpha kids', NULL, NULL, 'N', NULL, NULL, 1, 0, NULL, 'Logistics', 'Not Applicable'),
(1000003, NULL, '2026-10-09', NULL, NULL, 'SHIVAAN', '', 'ANAL PATWA ', 13, NULL, NULL, NULL, '2026-08-13', NULL, '101-102, WESTWIND I, \nGANDHI GRAM ROAD, \nNEAR ISCKON TEMPLE, \nJUHU, MUMBAI 400049.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'JARNA PRADEEP DOSHI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, 2, NULL, '2026', NULL, NULL, NULL, 'N', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', 'ivy.anal@email.com', 0000000000, NULL, NULL, NULL, NULL, NULL, 'jarnadoshi@email.com', NULL, NULL, NULL, NULL, NULL, 'Karnataka', 0000000000, NULL, NULL, NULL, NULL, 'ANAL RAJNIKANT PATWA', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, '', NULL, 'J''S STUDIO', 'IVORY ROSE', NULL, 'PROPRIETOR', 'PARTNER', NULL, NULL, NULL, NULL, NULL, NULL, 'NOT APPLICABLE', NULL, 'PARIZAD PATRAWALA , JUGNU SHAH AND RECENTLY KRUPA BHIMANI. (FRIENDS WHOSE CHILDREN ARE CURRENTLY STUDYING THERE)', NULL, NULL, 'SERRA INTERNATIONAL', NULL, NULL, 'N', NULL, NULL, 1, 0, NULL, 'DIAMOND JEWELRY', 'HOME DECOR'),
(1000004, NULL, '2026-10-10', NULL, NULL, 'Hridhaan', '', 'kalpesh Mehta ', 13, NULL, NULL, NULL, '2009-04-03', NULL, '302 Jamuna apartment, opposite shoppers stop, s. v. Road, AndheriMumbai west, Mumbai 400058', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Vaidehi kalpesh Mehta', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, 4, NULL, '2026', NULL, NULL, NULL, 'N', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', 'kalpesh@email.com', 0000000000, NULL, NULL, NULL, NULL, NULL, 'vaidehi@email.com', NULL, NULL, NULL, NULL, NULL, 'Karnataka', 0000000000, NULL, NULL, NULL, NULL, 'Kalpesh D. Mehta', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, '', NULL, 'Not applicable', 'Mehta exports', NULL, 'Not applicable', 'Managing partner', NULL, NULL, NULL, NULL, NULL, NULL, 'IGCSE', NULL, 'Family and friends', NULL, NULL, 'Utpal shanghai school', NULL, NULL, 'N', NULL, NULL, 1, 0, NULL, 'Exports of Argo products', 'Not applicable'),
(1000005, NULL, '2026-10-10', NULL, NULL, 'Ashima', '', 'Dasgupta  ', 13, NULL, NULL, NULL, '2026-07-08', NULL, '12A04, E Wing, Raheja Heights, Malad East', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Shweta Dasgupta', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, NULL, '2026', NULL, NULL, NULL, 'N', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', 'kaushik.dasgupta@email.com', 0000000000, NULL, NULL, NULL, NULL, NULL, 'shweta.dasgupta@email.com', NULL, NULL, NULL, NULL, NULL, 'Karnataka', 0000000000, NULL, NULL, NULL, NULL, 'Kaushik Dasgupta', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, '', NULL, 'Deutsche Bank', 'Avista Advisory', NULL, 'Vice President', 'Senior Associate', NULL, NULL, NULL, NULL, NULL, NULL, 'Not Applicable', NULL, 'From Collegues', NULL, NULL, 'Not Applicable', NULL, NULL, 'N', NULL, NULL, 1, 0, NULL, 'Finance', 'Finance'),
(1000006, NULL, '2026-10-10', NULL, NULL, 'Hridaan', '', 'Pankil Mehta ', 13, NULL, NULL, NULL, '2026-06-12', NULL, '11/12, Aashit Apartment, A Wing, 1st Floor, Off Juhu Tara Road, Juhu Koliwada, Juhu, Mumbai - 400049', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'AANAL MEHTA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, NULL, '2015', NULL, NULL, NULL, 'N', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', 'pankil@email.com', 0000000000, NULL, NULL, NULL, NULL, NULL, 'aanal@email.com', NULL, NULL, NULL, NULL, NULL, 'Karnataka', 0000000000, NULL, NULL, NULL, NULL, 'PANKIL MEHTA', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, '', NULL, 'MARRIAGE MANTRA', 'KIAANA HOME ORIGINALE USA / AFFINITY', NULL, 'DIRECTOR', 'DIRECTOR / MANAGING DIRECTOR', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 'Word of mouth through other parents whose children are currently at OIS.', NULL, NULL, '', NULL, NULL, 'N', NULL, NULL, 1, 0, NULL, 'HOME FURNISHINGS / DIGITAL MARKETING', 'EVENTS & EXHIBITIONS'),
(1000007, NULL, '2026-10-10', NULL, NULL, 'Kabir', '', 'Tahir Majithia ', 13, NULL, NULL, NULL, '2026-11-04', NULL, '501 Hicons Aura, Sherly Rajan Road, Off Carter Road, Bandra (W), Mumbai -400 050', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Zeba Tahir Majithia', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, 2, NULL, '2026', NULL, NULL, NULL, 'N', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', 'kevinsm@email.com', 0000000000, NULL, NULL, NULL, NULL, NULL, 'zebanathani@email.com', NULL, NULL, NULL, NULL, NULL, 'Karnataka', 0000000000, NULL, NULL, NULL, NULL, 'Tahir Shantikumar Majithia', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, '', NULL, 'Not Applicable', 'Majithia Constructions Pvt.Ltd', NULL, 'Not Applicable', 'Managing Director', NULL, NULL, NULL, NULL, NULL, NULL, 'Not Applicable', NULL, 'Friends', NULL, NULL, 'Not Applicable', NULL, NULL, 'N', NULL, NULL, 1, 0, NULL, 'Real Estate', 'Not Applicable'),
(1000008, NULL, '2026-10-10', NULL, NULL, 'Ira', '', 'Pande  ', 13, NULL, NULL, NULL, '2026-07-08', NULL, '801, Hicons Enclave,\n14th Road, Khar (West),\nMumbai 400 052.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Kanan Sangani', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, 2, NULL, '2026', NULL, NULL, NULL, 'N', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', 'tarun@email.com', 0000000000, NULL, NULL, NULL, NULL, NULL, 'kanansangani@email.com', NULL, NULL, NULL, NULL, NULL, 'Karnataka', 0000000000, NULL, NULL, NULL, NULL, 'Tarun Pande', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, '', NULL, 'Beetle & Bottle', 'Lighthouse Funds', NULL, 'Co-founder', 'Chief Financial Officer', NULL, NULL, NULL, NULL, NULL, NULL, 'Play school', NULL, 'We first heard about OIS from Sachin Bhartiya and his wife Seema. Sachin is Tarun’s work colleague and Seema and him are our close friends. Their sons Saksham (JKG) and Satvik (grade 3) have been attending OIS for the past few years.', NULL, NULL, 'Little Bo Peep', NULL, NULL, 'N', NULL, NULL, 1, 0, NULL, 'Private Equity', 'Design label for kids'),
(1000009, NULL, '2026-10-10', NULL, NULL, 'Aanya', '', 'verma  ', 13, NULL, NULL, NULL, '2026-03-09', NULL, 'A-1104 Oberoi woods, goregaon east, mumbai', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Vandana Verma', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, NULL, '2026', NULL, NULL, NULL, 'N', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', 'Sharatv@email.com', 0000000000, NULL, NULL, NULL, NULL, NULL, 'Vandanaluther@email.com', NULL, NULL, NULL, NULL, NULL, 'Karnataka', 0000000000, NULL, NULL, NULL, NULL, 'Sharat verma', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, '', NULL, '', 'Procter and gamble', NULL, '', 'Brand Manager', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 'Right behind the residence', NULL, NULL, '', NULL, NULL, 'N', NULL, NULL, 1, 0, NULL, 'FMCG', ''),
(1000010, NULL, '2026-10-10', NULL, NULL, 'Vedant', '', 'Chanakya  ', 13, NULL, NULL, NULL, '2026-04-13', NULL, 'E-1206, Oberoi Splendor, JVLR, Andheri East, Mumbai 400060', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Aishvarya', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, 2, NULL, '2026', NULL, NULL, NULL, 'N', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', 'Chanakya.gupta@email.com', 0000000000, NULL, NULL, NULL, NULL, NULL, 'Aishvarya.m@email.com', NULL, NULL, NULL, NULL, NULL, 'Karnataka', 0000000000, NULL, NULL, NULL, NULL, 'Chanakya Gupta', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, '', NULL, 'Hindustan Unilever Limited', 'Hindustan Unilever Limited', NULL, 'Marketing Manager', 'National Account Manager', NULL, NULL, NULL, NULL, NULL, NULL, 'Play school', NULL, 'Through friends in the apartment complex and colleagues at work', NULL, NULL, 'The Little Company, unilever campus', NULL, NULL, 'N', NULL, NULL, 1, 0, NULL, 'Sales and Marketing', 'Sales and Marketing');

-- --------------------------------------------------------

--
-- Table structure for table "student_m_online_enquirystage"
--

CREATE TABLE IF NOT EXISTS "student_m_online_enquirystage" (
  "student_m_online_enquirystage_id"                             SERIAL,
  "student_m_online_id"            INT         DEFAULT NULL,
  "comments"                       TEXT,
  "admission_steps_master_id"      INT         DEFAULT NULL,
  "admission_stage_master_id"      INT         DEFAULT NULL,
  "admission_stage_master_action"  INT         DEFAULT NULL,
  "meeting_date"                   TIMESTAMP    DEFAULT NULL,
  "inserted"                       TIMESTAMP   NULL DEFAULT CURRENT_TIMESTAMP,
  "status"                         SMALLINT  NOT NULL DEFAULT 1,
  PRIMARY KEY ("student_m_online_enquirystage_id")
);

--
-- Dumping data for table "student_m_online_enquirystage"
--

INSERT INTO "student_m_online_enquirystage" ("student_m_online_enquirystage_id", "student_m_online_id", "comments", "admission_steps_master_id", "admission_stage_master_id", "admission_stage_master_action", "meeting_date", "inserted", "status") VALUES
(1, 1000000, NULL, 2, 4, 1, NULL, '2026-10-09 05:28:13', 1),
(2, 1000001, NULL, 2, 4, 1, NULL, '2026-10-09 05:28:13', 1),
(3, 1000002, NULL, 2, 4, 1, NULL, '2026-10-09 05:28:13', 1),
(4, 1000003, NULL, 2, 4, 1, NULL, '2026-10-09 05:28:13', 1),
(5, 1000004, NULL, 2, 4, 1, NULL, '2026-10-10 05:28:13', 1),
(6, 1000005, NULL, 2, 4, 1, NULL, '2026-10-10 05:28:13', 1),
(7, 1000006, NULL, 2, 4, 1, NULL, '2026-10-10 05:28:13', 1),
(8, 1000007, NULL, 2, 4, 1, NULL, '2026-10-10 05:28:13', 1),
(9, 1000008, NULL, 2, 4, 1, NULL, '2026-10-10 05:28:13', 1),
(10, 1000009, NULL, 2, 4, 1, NULL, '2026-10-10 05:28:13', 1);

-- --------------------------------------------------------

--
-- Table structure for table "student_m_pastoral"
--

CREATE TABLE IF NOT EXISTS "student_m_pastoral" (
  "student_m_pastoral_id"             SERIAL,
  "student_id"     VARCHAR(20)  DEFAULT NULL,
  "selected_date"  DATE         DEFAULT NULL,
  "reported_by"    VARCHAR(20)  DEFAULT NULL,
  "event_id"       INT          DEFAULT NULL,
  "description"    TEXT,
  "notes"          TEXT,
  "consequence"    TEXT,
  "detention"      VARCHAR(10)  DEFAULT NULL,
  "email_send"     TEXT,
  "a_year"         INT          DEFAULT NULL,
  "inserted_date"  TIMESTAMP     DEFAULT NULL,
  "status"         SMALLINT   DEFAULT 1,
  PRIMARY KEY ("student_m_pastoral_id")
);

--
-- Dumping data for table "student_m_pastoral"
--

INSERT INTO "student_m_pastoral" ("student_m_pastoral_id", "student_id", "selected_date", "reported_by", "event_id", "description", "notes", "consequence", "detention", "email_send", "a_year", "inserted_date", "status") VALUES
(11, '1046', '2026-10-10', '38', 3, 'test', 'test', 'test', 'NO', ',,,,,,,', 2026, '2026-10-10 14:10:45', 1),
(12, '151', '2026-10-10', '3', 2, 'test notice', 'test notice', 'test notice', 'NO', ',,,,,,,', 2026, '2026-10-10 14:58:00', 1),
(13, '473', '2026-10-10', '188', 4, 'Description of Event', 'Notes ( Confidential - Parent do not see these notes ) ', 'Consequences', 'YES', ',,,,,,,', 2026, '2026-10-10 15:10:03', 1),
(14, '266', '2026-10-10', '', 1, 'testing', 'tesing', 'testing', 'NO', ',,,,,,,', 2026, '2026-10-10 15:11:42', 1),
(15, '473', '2026-10-10', '188', 1, 'Description ', 'Notes ', 'Consequences', 'YES', '1,2,3,4,5,6,7,', 2026, '2026-10-10 19:04:33', 1),
(16, '643', '2026-10-31', '291', 41, 'Shivam took a pair of headphones out of a backpack. ', '', 'Meeting with Priya R. and Puja S.\r\nParent Meeting, Mon. Nov. 11, 2026\r\n1.5 day suspension from school.\r\nWrite an apology letter.\r\nBehaviour contract: See Mr. Hilty & Ms. Hima weekly\r\n\r\n', '', ',,,,,,,', 2026, '2026-11-13 14:12:50', 1),
(17, '965', '2026-02-25', '2', 17, 'Arjun Razdon responded to a student who was approaching him from behind. He responded by kicking and then hitting the student in the head with his closed hand. Mr. Darren witnessed the end of the event and CCTV was viewed showing the fight.', 'Arjun said the other student was making fun of him and his family (abusing him). When leaving the class, he said he was attacked by Harsh Ruia and he said he was defending himself. According to CCTV, Arjun swung a closed hand at Harsh which struck Harsh in the head.', 'Parent Phone Call\r\nParent Meeting\r\n1 day suspension\r\nStudent will meet with Mr. Eric upon his return', '', ',,,,,,,', 2026, '2026-02-25 15:41:33', 1),
(18, '977', '2026-02-25', '2', 17, 'Harsh left his business class to confront another student who was apparently making fun on his family (abusing him). When confronting the other student he was kicked by the student and struck back by kicking and hitting him. According to CCTV Harsh and the other student were fighting outside the classroom. Mr. Darren broke up the fight and Ms. Anne reported the incident to Mr. Eric', 'Harsh was in the same class as Arjun Razdan. While leaving the class, he ran towards Arjun. Both students were kicking and hitting each other with closed hands.', 'Phone call to mother\r\nMeeting with mother\r\n1 day suspension from school\r\nMeet with Mr. Eric when returning to school on Thursday, Feb. 27.', '', ',,,,,,,', 2026, '2026-02-25 15:48:07', 1),
(19, '1102', '2026-10-14', '38', 2, 'Below 90% attendance', 'Note to parent', 'Note to parents', '', ',,,,,,,', 2026, '2026-03-10 08:48:42', 1),
(20, '1102', '2026-02-27', '38', 2, 'Below 90% attendance', 'Note to parent', 'Note to parent', '', ',,,,,,,', 2026, '2026-03-10 08:49:57', 1);

-- --------------------------------------------------------

--
-- Table structure for table "student_m_tab"
--

CREATE TABLE IF NOT EXISTS "student_m_tab" (
  "student_m_tab_id"             SERIAL,
  "name"           VARCHAR(100)  DEFAULT NULL,
  "tab_name"       VARCHAR(100)  DEFAULT NULL,
  "inserted_date"  DATE          DEFAULT NULL,
  "status"         SMALLINT    DEFAULT 1,
  "description"    VARCHAR(50)   DEFAULT NULL,
  PRIMARY KEY ("student_m_tab_id")
);

--
-- Dumping data for table "student_m_tab"
--

INSERT INTO "student_m_tab" ("student_m_tab_id", "name", "tab_name", "inserted_date", "status", "description") VALUES
(2, NULL, 'Student', '2026-05-21', 1, 'Student Details'),
(3, NULL, 'Emergency', '2026-05-21', 1, 'Emergency Contact Details'),
(4, NULL, 'Parent', '2026-05-21', 1, 'Parent/Guardian Details'),
(5, NULL, 'Address', '2026-05-21', 1, 'Present/Permanent  Address'),
(6, NULL, 'Documents', '2026-05-23', 1, 'Tick the relevent documents'),
(7, NULL, 'Login', '2026-05-23', 1, 'Username & Password'),
(11, NULL, 'Misc', '2026-05-30', 1, 'misc');

-- --------------------------------------------------------

--
-- Table structure for table "student_pt_m"
--

CREATE TABLE IF NOT EXISTS "student_pt_m" (
  "student_pt_m_id"                SERIAL,
  "user_name"         VARCHAR(100)  DEFAULT NULL,
  "subject"           VARCHAR(100)  DEFAULT NULL,
  "student_id"        VARCHAR(20)   DEFAULT NULL,
  "teacher_id"        INT           DEFAULT NULL,
  "conf_date"         DATE          DEFAULT NULL,
  "academic"          SMALLINT    DEFAULT 0,
  "conduct"           SMALLINT    DEFAULT 0,
  "other"             SMALLINT    DEFAULT 0,
  "location"          SMALLINT    DEFAULT NULL,
  "reason"            TEXT,
  "other_reason"      TEXT,
  "observation_id"    TEXT,
  "observation"       TEXT,
  "recommendation"    TEXT,
  "parents_comments"  TEXT,
  "a_year"            INT           DEFAULT NULL,
  "inserted_date"     TIMESTAMP      DEFAULT NULL,
  "status"            SMALLINT    DEFAULT 1,
  PRIMARY KEY ("student_pt_m_id")
);

--
-- Dumping data for table "student_pt_m"
--

INSERT INTO "student_pt_m" ("student_pt_m_id", "user_name", "subject", "student_id", "teacher_id", "conf_date", "academic", "conduct", "other", "location", "reason", "other_reason", "observation_id", "observation", "recommendation", "parents_comments", "a_year", "inserted_date", "status") VALUES
(1, 'administrator', 'Conference Testing', '266', 188, '2026-08-01', 0, 0, 0, 1, ',,', 'Reason Testing', '', 'Observation Testing', 'Recommendation Testing', 'Comments Testing', 2026, '2026-08-01 18:23:59', 1),
(2, 'administrator', 'Conference Testing2', '266', 74, '2026-08-27', 1, 1, 1, 3, ',,', 'Reason Testing2', '', 'Observation Testing2', 'Recommendation Testing2', 'Comments Testing2', 2026, '2026-08-01 18:37:05', 1),
(3, 'administrator', 'test', '', 3, '2026-08-19', 1, 0, 0, 0, NULL, '', NULL, '', 'test', '', 2026, '2026-08-19 14:33:38', 1),
(4, 'administrator', 'Test1', '266', 194, '2026-08-21', 1, 1, 1, 1, ',,', 'Parent''s Reaction/Comments1', '', 'Parent''s Reaction/Comments1', 'Parent''s Reaction/Comments1', 'Parent''s Reaction/Comments1', 2026, '2026-08-21 14:35:56', 0),
(5, 'administrator', 'Test Sub', '266', 194, '2026-08-22', 1, 1, 1, 1, ',,', 'teuwyyuwe', '', 'hfdshfhjsl', 'jndjzcz.x', 'ncnxzmnzx,mc', 2026, '2026-08-22 12:02:07', 1),
(7, 'administrator', 'Test1', '473', 194, '2026-08-22', 1, 1, 1, 3, ',,', 'Reason  1', '', 'Observation  1', 'Observation  1', 'Parent''s Reaction/Comments', 2026, '2026-08-22 14:04:00', 1),
(8, 'administrator', 'Test Sub', '1149', 194, '2026-08-22', 0, 1, 0, 2, NULL, 'dskjksd', NULL, '', '', '', 2026, '2026-08-22 14:35:14', 1);

-- --------------------------------------------------------

--
-- Table structure for table "student_pt_observation"
--

CREATE TABLE IF NOT EXISTS "student_pt_observation" (
  "student_pt_observation_id"           SERIAL,
  "observation"  VARCHAR(100)  DEFAULT NULL,
  "status"       SMALLINT    DEFAULT 1,
  PRIMARY KEY ("student_pt_observation_id")
);

--
-- Dumping data for table "student_pt_observation"
--

INSERT INTO "student_pt_observation" ("student_pt_observation_id", "observation", "status") VALUES
(1, 'Behavior Concern', 1),
(2, 'Health Issues', 1),
(3, 'IEP Review', 1),
(4, 'Irregular attendance', 1),
(5, 'Lack of ability', 1),
(6, 'Lack of effort', 1),
(7, 'Lack of self-control', 1),
(8, 'Low grades', 1),
(9, 'Not turning in assignment', 1),
(10, 'Social adjustment difficulty', 1);

-- --------------------------------------------------------

--
-- Table structure for table "student_pt_observation_m"
--

CREATE TABLE IF NOT EXISTS "student_pt_observation_m" (
  "student_pt_observation_m_id"              BIGSERIAL,
  "student_id"      INT         DEFAULT NULL,
  "teacher_id"      INT         DEFAULT NULL,
  "observation_id"  INT         DEFAULT NULL,
  "checkbox"        SMALLINT  DEFAULT 0,
  PRIMARY KEY ("student_pt_observation_m_id")
);

--
-- Dumping data for table "student_pt_observation_m"
--

INSERT INTO "student_pt_observation_m" ("student_pt_observation_m_id", "student_id", "teacher_id", "observation_id", "checkbox") VALUES
(34, 473, 194, 2, 1),
(33, 473, 194, 1, 1),
(3, 266, 188, 3, 1),
(4, 266, 188, 4, 1),
(5, 266, 188, 5, 1),
(6, 266, 188, 6, 1),
(7, 266, 188, 7, 1),
(8, 266, 188, 8, 1),
(9, 266, 188, 9, 1),
(10, 266, 188, 10, 1);

-- --------------------------------------------------------

--
-- Table structure for table "student_health"
--

CREATE TABLE IF NOT EXISTS "student_health" (
  "student_health_id"             SERIAL,
  "studid"         VARCHAR(20)  DEFAULT NULL,
  "studname"       VARCHAR(30)  DEFAULT NULL,
  "courseid"       INT          DEFAULT NULL,
  "academicyear"   VARCHAR(10)  DEFAULT NULL,
  "height"         VARCHAR(10)  DEFAULT NULL,
  "weight"         VARCHAR(10)  DEFAULT NULL,
  "general_exam"   TEXT,
  "vision"         TEXT,
  "dental"         TEXT,
  "cardio_exam"    TEXT,
  "chest_exam"     TEXT,
  "urine_exam"     TEXT,
  "blood_exam"     TEXT,
  "remarks"        TEXT,
  "rep_date"       DATE         DEFAULT NULL,
  "pefr"           TEXT,
  "date_selected"  DATE         DEFAULT NULL,
  "student_id"     INT          DEFAULT NULL,
  "date_modified"  DATE         DEFAULT NULL,
  PRIMARY KEY ("student_health_id")
);

--
-- Dumping data for table "student_health"
--

INSERT INTO "student_health" ("student_health_id", "studid", "studname", "courseid", "academicyear", "height", "weight", "general_exam", "vision", "dental", "cardio_exam", "chest_exam", "urine_exam", "blood_exam", "remarks", "rep_date", "pefr", "date_selected", "student_id", "date_modified") VALUES
(1, 'A1013', 'Bharadwaj, Ayan Puneet', 2, '2026', '90', '14', 'not measured', 'not measured', '50', '17.283950617', '0.91228070175', NULL, NULL, NULL, NULL, NULL, '2026-08-05', 141, NULL),
(2, 'A1071', 'Chandorkar, Arya Rajendra', 2, '2026', '87', '9', 'not measured', 'not measured', '48', '11.890606421', '0.88679245283', NULL, NULL, NULL, NULL, NULL, '2026-08-05', 197, NULL),
(3, 'A1143', 'Dixit, Shaurya Maulik', 2, '2026', '99', '13', '116', '98', '49.5', '13.263952658', '0.84210526316', NULL, NULL, NULL, NULL, NULL, '2026-08-05', 326, NULL),
(4, 'A941', 'Dodeja, Aryan Suraj', 2, '2026', '90', '14', '114', '98', '52', '17.283950617', '0.96428571429', NULL, NULL, NULL, NULL, NULL, '2026-08-05', 327, NULL),
(5, 'A944', 'Goel, Nirvan Piyush', 2, '2026', '96', '14', '110', '98', '49.5', '15.190972222', '0.92105263158', NULL, NULL, NULL, NULL, NULL, '2026-08-05', 395, NULL),
(6, 'A1272', 'Jumani, Yuveer', 2, '2026', '94', '14.5', '120', '97', '51', '16.410140335', '0.9298245614', NULL, NULL, NULL, NULL, NULL, '2026-08-05', 544, NULL),
(7, 'A1019', 'Kurup, Nia Raj', 2, '2026', '93', '10.5', '126', '98', '51.5', '12.140131807', '0.82692307692', NULL, NULL, NULL, NULL, NULL, '2026-08-05', 649, NULL),
(8, 'A928', 'Parekh, Yahvi Pintu', 2, '2026', '85', '12', '87', '96', '45', '16.60899654', '0.90196078431', NULL, NULL, NULL, NULL, NULL, '2026-08-05', 863, NULL),
(9, 'A991', 'Shah, Kenisha Tanmay', 2, '2026', '85', '11.6', '87', '99', '47', '16.055363322', '0.96', NULL, NULL, NULL, NULL, NULL, '2026-08-05', 1057, NULL),
(10, 'A983', 'Shah, Raya Mihir', 2, '2026', '99', '13', '108', '95', '49', '13.263952658', '0.85964912281', NULL, NULL, NULL, NULL, NULL, '2026-08-05', 1062, NULL);

-- --------------------------------------------------------

--
-- Table structure for table "stud_sibling"
--

CREATE TABLE IF NOT EXISTS "stud_sibling" (
  "stud_sibling_id"           SERIAL,
  "family_name"  VARCHAR(255)  NOT NULL,
  "family_code"  VARCHAR(255)  NOT NULL,
  "relation"     VARCHAR(255)  NOT NULL,
  "stud"         INT           NOT NULL,
  "status"       SMALLINT    NOT NULL,
  PRIMARY KEY ("stud_sibling_id")
);

--
-- Dumping data for table "stud_sibling"
--

INSERT INTO "stud_sibling" ("stud_sibling_id", "family_name", "family_code", "relation", "stud", "status") VALUES
(1, '', 'OB12962ye9g', '', 1297, 0),
(2, '', 'OB12962ye9g', '', 1296, 0),
(3, '', 'OB1297bklv0', '', 1296, 0),
(4, '', 'OB1297bklv0', '', 1297, 0),
(5, '', 'OB266bjirb', '', 462, 0),
(6, '', 'OB266bjirb', '', 266, 0),
(7, 'shiv', 'OBd9xe7', '', 670, 0),
(8, 'Roshan Abbas', 'OBd9xe7', '', 0, 0),
(9, 'Roshan Abbas', 'OBd9xe7', '', 3, 1),
(10, 'shiv', 'OBd9xe7', '', 447, 0);

-- --------------------------------------------------------

--
-- Table structure for table "style"
--

CREATE TABLE IF NOT EXISTS "style" (
  "field_id"          SERIAL,
  "field_pos_org"     INT  NOT NULL DEFAULT 1,
  "field_pos_recent"  INT  NOT NULL DEFAULT 1,
  "vert_pos_org"      INT  DEFAULT NULL,
  "vert_pos_rec"      INT  DEFAULT NULL,
  PRIMARY KEY ("field_id")
);

--
-- Dumping data for table "style"
--

INSERT INTO "style" ("field_id", "field_pos_org", "field_pos_recent", "vert_pos_org", "vert_pos_rec") VALUES
(1, 1, 2, NULL, NULL),
(2, 2, 2, NULL, NULL),
(3, 1, 2, NULL, NULL),
(4, 2, 1, NULL, NULL),
(5, 1, 1, NULL, NULL),
(6, 1, 2, NULL, NULL),
(7, 1, 1, NULL, NULL),
(8, 2, 2, NULL, NULL),
(9, 1, 2, NULL, NULL),
(10, 2, 2, NULL, NULL);


-- --------------------------------------------------------

--
-- Table structure for table "subjecttype"
--

CREATE TABLE IF NOT EXISTS "subjecttype" (
  "subtype_id"    SERIAL,
  "subtype_name"  VARCHAR(50)  NOT NULL DEFAULT '',
  PRIMARY KEY ("subtype_id")
);

--
-- Dumping data for table "subjecttype"
--

INSERT INTO "subjecttype" ("subtype_id", "subtype_name") VALUES
(1, 'Theory'),
(2, 'Homeroom'),
(3, 'Activity'),
(4, 'PE'),
(5, 'Oral');

-- --------------------------------------------------------

--
-- Table structure for table "subject_group"
--

CREATE TABLE IF NOT EXISTS "subject_group" (
  "subject_group_id"          SERIAL,
  "group_name"  VARCHAR(80)  NOT NULL,
  "status"      SMALLINT   NOT NULL,
  "order_id"    INT          NOT NULL,
  PRIMARY KEY ("subject_group_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "subject_group_det"
--

CREATE TABLE IF NOT EXISTS "subject_group_det" (
  "subject_group_det_id"          SERIAL,
  "group_id"    INT         NOT NULL,
  "sem"         INT         NOT NULL,
  "subject_id"  INT         NOT NULL,
  "status"      SMALLINT  NOT NULL,
  PRIMARY KEY ("subject_group_det_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "subject_m"
--

CREATE TABLE IF NOT EXISTS "subject_m" (
  "subject_id"      SERIAL,
  "course_id"       INT            NOT NULL DEFAULT 0,
  "subject_name"    VARCHAR(100)   NOT NULL DEFAULT '',
  "sub_type"        INT            NOT NULL DEFAULT 0,
  "total_marks"     INT            DEFAULT NULL,
  "course_year_id"  INT            NOT NULL DEFAULT 0,
  "subject_code"    VARCHAR(50)    DEFAULT NULL,
  "status"          SMALLINT     DEFAULT 1,
  "elective"        VARCHAR(50)  DEFAULT 'N',
  "abb_name"        VARCHAR(7)     DEFAULT NULL,
  "cycle"           INT            NOT NULL,
  "sys_year"        INT            NOT NULL DEFAULT 0,
  "cont_hours"      INT            NOT NULL,
  "max_mark"        INT            DEFAULT NULL,
  "f"               VARCHAR(3)     NOT NULL,
  "sub_pre"         INT            DEFAULT NULL,
  PRIMARY KEY ("subject_id")
);

--
-- Dumping data for table "subject_m"
--

INSERT INTO "subject_m" ("subject_id", "course_id", "subject_name", "sub_type", "total_marks", "course_year_id", "subject_code", "status", "elective", "abb_name", "cycle", "sys_year", "cont_hours", "max_mark", "f", "sub_pre") VALUES
(1, 3, 'Art', 1, 100, 5, '01 Arts', 1, 'N', 'NULL', 0, 0, 0, 100, '', 10),
(2, 3, '01 Language Art', 1, 100, 5, '01 Lan Art', 0, 'N', 'NULL', 0, 0, 0, 100, '', 2),
(3, 3, 'Hindi Native', 1, 100, 5, '01 Hnd Nat', 1, 'N', 'NULL', 0, 0, 0, 100, '', 11),
(4, 3, 'HIndi Non Native', 1, 100, 5, '01 Hnd Non Nat', 1, 'N', 'NULL', 0, 0, 0, 100, '', 12),
(5, 3, '01 ICT', 1, 100, 5, '01 ICT', 0, 'N', 'NULL', 0, 0, 0, 100, '', 5),
(6, 3, '01 Math', 1, 100, 5, '01 Math', 0, 'Y', 'NULL', 0, 0, 0, 100, '', 6),
(7, 3, 'Music', 1, 100, 5, '01 Music', 1, 'N', 'NULL', 0, 0, 0, 100, '', 14),
(8, 3, '01 Dance and Drama', 3, 100, 5, '01 D & D', 0, 'N', 'NULL', 0, 0, 0, 100, '', 8),
(9, 3, 'Art', 1, 100, 6, '02 Arts', 1, 'N', 'NULL', 0, 0, 0, 100, '', 10),
(10, 3, '02 Dance and Drama', 1, 100, 6, '02 D&D', 0, 'N', 'NULL', 0, 0, 0, 100, '', 2);

-- --------------------------------------------------------

--
-- Table structure for table "submodules"
--

CREATE TABLE IF NOT EXISTS "submodules" (
  "module"     VARCHAR(50)  DEFAULT NULL,
  "submodule"  VARCHAR(50)  DEFAULT NULL,
  "submodules_id"         SERIAL,
  PRIMARY KEY ("submodules_id")
);

--
-- Dumping data for table "submodules"
--

INSERT INTO "submodules" ("module", "submodule", "id") VALUES
('Main', 'Main', 1),
('Settings', 'Add Masters', 2),
('Settings', 'Reports', 3),
('Settings', 'Help', 4),
('Staff Management', 'Add Masters', 5),
('Staff Management', 'Reports', 6),
('Staff Management', 'Help', 7),
('User Management', 'Users', 8),
('User Management', 'Reports', 9),
('User Management', 'Help', 10),
('Student-Management', 'Add Masters', 11),
('Student-Management', 'Reports', 12),
('Student-Management', 'Help', 13),
('Accounts', 'Add Masters', 130),
('Accounts', 'Reports', 132),
('Accounts', 'Help', 137),
('Time Table', 'Add Masters', 18),
('Time Table', 'Reports', 19),
('Time Table', 'Help', 20),
('Student Assessment', 'Add Masters', 21),
('Student Assessment', 'Reports', 22),
('Student Assessment', 'Help', 23),
('Transportation Management', 'Master Data', 24),
('Transportation Management', 'Plan Transportation Details', 25),
('Transportation Management', 'Reports', 26),
('Transportation Management', 'Special Reports', 27),
('Transportation Management', 'Help', 28),
('Asset Management', 'Masters', 29),
('Asset Management', 'Major Purchases', 30),
('Asset Management', 'Minor Purchases', 31),
('Asset Management', 'Return of Assets', 32),
('Asset Management', 'Service of Assets', 33),
('Asset Management', 'Deputation', 34),
('Asset Management', 'Movement of Assets', 35),
('Asset Management', 'Registers', 36),
('Asset Management', 'Breakages', 37),
('Asset Management', 'Billing ', 38),
('Asset Management', 'Help', 39),
('Library Management', 'Add Master', 40),
('Library Management', 'Manage Media', 41),
('Library Management', 'Manage Member', 42),
('Library Management', 'Media Transaction', 43),
('Library Management', 'Borrow Reference Media', 44),
('Library Management', 'OPAC', 45),
('Library Management', 'Manage Vendor', 46),
('Library Management', 'Quotation', 47),
('Library Management', 'Purchase Details', 48),
('Library Management', 'Reports', 49),
('Library Management', 'Help', 50),
('Email & SMS alert', 'SMS', 51),
('Email & SMS alert', 'Email', 52),
('Email & SMS alert', 'Help', 53),
('Web Database', 'Prepare', 54),
('Web Database', 'Create', 55),
('Web Database', 'Help', 56),
('Accounts Management', 'Add Masters', 57),
('Accounts Management', 'Reports', 58),
('Accounts Management', 'Help', 59),
('MIS Reports', 'Admission Reports', 60),
('MIS Reports', 'Staff Reports', 61),
('MIS Reports', 'Login Reports', 62),
('MIS Reports', 'Student Reports', 63),
('MIS Reports', 'Student Fee', 64),
('MIS Reports', 'Time Table', 65),
('MIS Reports', 'Transportation', 66),
('MIS Reports', 'Assets', 67),
('MIS Reports', 'Library', 68),
('Class', 'Class', 71),
('Finance', 'Transactions', 72),
('Finance', 'Settings', 73),
('Finance', 'Reports', 74),
('Finance', 'Final Account', 75),
('Finance', 'Payroll', 76),
('Finance', 'Help', 77),
('Inventory', 'Products', 78),
('Inventory', 'POS', 79),
('Inventory', 'Reports', 80),
('Charges', 'Advances', 82),
('Charges', 'Charges', 83),
('Charges', 'Reports', 84),
('Parents Web', 'Appointment Scheduler', 143),
('Parents Web', 'Announcement', 142),
('Hostel Management', 'Hostel Details', 87),
('Hostel Management', 'Student Admission in Hostel', 88),
('Hostel Management', 'Fee Details', 89),
('Hostel Management', 'Additional Details', 90),
('Hostel Management', 'Consumable Entry', 91),
('Hostel Management', 'Consumable Report', 92),
('Hostel Management', 'Reports', 93),
('Hostel Management', 'Help', 94),
('Health Management', 'Student Medical Details', 95),
('Health Management', 'Infirmary Report', 96),
('Transportation', 'Master Data', 97),
('Transportation', 'Plan Transportation Details', 98),
('Transportation', 'Reports', 99),
('Transportation', 'Special Reports', 100),
('Transportation', 'Help', 101),
('Pre-Admission', 'Master Data', 127),
('Pre-Admission', 'Enquires', 126),
('Student Assessment', 'Assessment', 104),
('Student Assessment', 'Assessment Reports', 116),
('Parents Web', 'Calendar', 141),
('Photo Gallery', 'Add', 118),
('Photo Gallery', 'View', 119),
('Class', 'Add Masters', 120),
('Class', 'Reports', 121),
('Online Assessment', 'Add Masters', 122),
('Online Assessment', 'Reports', 123),
('Email & SMS alert', 'Reports', 124),
('Pre-Admission', 'Reports', 128),
('Accounts', 'Student', 129),
('RFID', 'Add Masters', 133),
('RFID', 'Reports', 134),
('Academic Report', 'Add Masters', 135),
('Academic Report', 'Reports', 136),
('Accounts', 'Miscellaneous', 131),
('Fee', 'Fee', 140),
('Parents Web', 'Reports', 145),
('Parents Web', 'EC Activity', 144);

-- --------------------------------------------------------

--
-- Table structure for table "sub_skills"
--

CREATE TABLE IF NOT EXISTS "sub_skills" (
  "sub_skills_id"            SERIAL,
  "divi"          INT         NOT NULL,
  "class"         INT         NOT NULL,
  "sub"           INT         NOT NULL,
  "master_skill"  INT         NOT NULL,
  "sub_skill"     TEXT        NOT NULL,
  "posi"          INT         NOT NULL,
  "status"        SMALLINT  DEFAULT 1,
  PRIMARY KEY ("sub_skills_id")
);

--
-- Dumping data for table "sub_skills"
--

INSERT INTO "sub_skills" ("sub_skills_id", "divi", "class", "sub", "master_skill", "sub_skill", "posi", "status") VALUES
(1, 3, 5, 1, 1, '', 0, 1),
(20, 3, 5, 2, 6, 'Follows directions ', 1, 1),
(2, 3, 5, 1, 1, 'Comprehension: grasps meaning from material learned; communicates and interprets learning', 2, 1),
(3, 3, 5, 1, 1, 'Application: makes use of previously acquired knowledge in practical or new ways', 3, 1),
(4, 3, 5, 1, 2, 'Accepts responsibility', 1, 1),
(5, 3, 5, 1, 2, 'Respects others and cooperates', 2, 1),
(6, 3, 5, 1, 2, 'Resolves conflict', 3, 1),
(7, 3, 5, 1, 2, 'Participates in group decision-making and adopts a variety of group roles', 4, 1),
(8, 3, 5, 1, 3, 'Organization: plans and carries out activities effectively', 1, 1),
(9, 3, 5, 1, 3, 'Time Management: uses time effectively and appropriately', 2, 1),
(10, 3, 5, 1, 3, 'Codes of Behavior: knows and applies essential agreements and appropriate school rules ', 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table "tabs"
--

CREATE TABLE IF NOT EXISTS "tabs" (
  "tab_id"          SERIAL,
  "tab_name"        VARCHAR(50)  NOT NULL,
  "modul_id"        INT          NOT NULL,
  "tab_visibility"  INT          DEFAULT 0,
  PRIMARY KEY ("tab_id")
);

--
-- Dumping data for table "tabs"
--

INSERT INTO "tabs" ("tab_id", "tab_name", "modul_id", "tab_visibility") VALUES
(1, 'Student', 1, 0),
(2, 'Contact', 1, 0),
(3, 'Medical', 1, 0),
(4, 'Enclosed Documents', 1, 0),
(11, 'Fee', 1, 0),
(12, 'Transport', 1, 0),
(5, 'Personal Details', 2, 0),
(6, 'Address Information', 2, 0),
(7, 'Office Details', 2, 0),
(8, 'Additional Details', 2, 0),
(9, 'Proffessional Background', 2, 0),
(10, 'Dependents', 2, 0),
(26, 'Subject Elective', 1, 0),
(27, 'Academic Records', 1, 0),
(29, 'GradeBook', 1, 0),
(28, 'Lovely_Test', 1, 0),
(30, 'Dummy', 1, 1),
(31, 'Add_Products', 4, 0),
(32, 'jack_tab', 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table "teacher_lesson_docments"
--

CREATE TABLE IF NOT EXISTS "teacher_lesson_docments" (
  "teacher_lesson_docments_id"                 SERIAL,
  "teacher_lesson_id"  INT           NOT NULL,
  "title"              VARCHAR(70)   NOT NULL,
  "description"        TEXT          NOT NULL,
  "source"             VARCHAR(250)  NOT NULL,
  "status"             SMALLINT    NOT NULL,
  "p_Access"           SMALLINT    NOT NULL,
  PRIMARY KEY ("teacher_lesson_docments_id")
);

--
-- Dumping data for table "teacher_lesson_docments"
--

INSERT INTO "teacher_lesson_docments" ("teacher_lesson_docments_id", "teacher_lesson_id", "title", "description", "source", "status", "p_Access") VALUES
(1, 1, 'Types of I/O devices', '', '', 1, 0),
(2, 2, 'Introduction ', '', '', 1, 0),
(3, 3, 'Introduction', '', '', 1, 0),
(4, 4, 'Addition', '', '', 1, 0),
(5, 5, 'Subtraction', '', '', 1, 0),
(6, 6, 'Introduction', '', '', 1, 0),
(7, 7, 'Public speaking', '', '', 1, 0),
(8, 8, 'Working in a team', '', '', 1, 0),
(9, 9, 'Simple spellings', '', '', 1, 0),
(10, 10, 'Abbreviate days ', '', '', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table "teacher_lesson_plan"
--

CREATE TABLE IF NOT EXISTS "teacher_lesson_plan" (
  "teacher_lesson_plan_id"           SERIAL,
  "divi"         INT          NOT NULL,
  "class"        INT          NOT NULL,
  "sec"          INT          NOT NULL,
  "subj"         INT          NOT NULL,
  "chapter"      INT          NOT NULL,
  "topic"        VARCHAR(99)  NOT NULL,
  "r_date"       DATE         NOT NULL,
  "to_date"      DATE         NOT NULL,
  "description"  TEXT         NOT NULL,
  "home_work"    TEXT         NOT NULL,
  "notes"        TEXT         NOT NULL,
  "details"      TEXT         NOT NULL,
  "staff_r"      SMALLINT   NOT NULL,
  "parent_r"     SMALLINT   NOT NULL,
  "status"       SMALLINT   NOT NULL,
  PRIMARY KEY ("teacher_lesson_plan_id")
);

--
-- Dumping data for table "teacher_lesson_plan"
--

INSERT INTO "teacher_lesson_plan" ("teacher_lesson_plan_id", "divi", "class", "sec", "subj", "chapter", "topic", "r_date", "to_date", "description", "home_work", "notes", "details", "staff_r", "parent_r", "status") VALUES
(1, 3, 5, 1, 5, 1, '2', '2026-01-08', '2026-01-08', 'Students were made familiar with the some of the input-output devices.', 'Lab exercises', 'Worksheet given - Identify the device and specify whether input or output.', 'Good', 0, 0, 1),
(2, 3, 5, 1, 5, 1, '1', '2026-01-08', '2026-01-08', 'Students were introduced to the concept of John Von Neuman architecture', 'Lab exercises', 'Practicals in the lab', 'Good', 0, 0, 1),
(3, 3, 5, 1, 3, 5, '12', '2026-01-02', '2026-01-08', 'Introduction to the evolution of mathematics', 'Get more information', 'Get more information', '', 0, 0, 1),
(4, 3, 5, 1, 3, 6, '14', '2026-01-08', '2026-01-15', 'Adding two numbers', 'Try complexity', 'Try complexity', 'Good', 0, 0, 1),
(5, 3, 5, 1, 3, 6, '15', '2026-01-16', '2026-01-22', 'Subtract two numbers', 'Try complexity', 'Try complexity', 'Good', 0, 0, 1),
(6, 3, 5, 1, 1, 11, '22', '2026-01-02', '2026-01-04', 'Why Transdisciplinary Skills ?', '', '', 'Good', 0, 0, 1),
(7, 3, 5, 1, 1, 12, '23', '2026-01-07', '2026-01-09', 'Public speaking', 'Talk in class', 'Talk in class', 'Good', 0, 0, 1),
(8, 3, 5, 1, 1, 12, '24', '2026-01-10', '2026-01-15', 'Working in a team', 'Team activity', 'Team activity', '', 0, 0, 1),
(9, 3, 5, 1, 2, 13, '25', '2026-01-02', '2026-01-04', 'Simple spellings', 'Learn simple words', 'Learn simple words', 'Good', 0, 0, 1),
(10, 3, 5, 1, 2, 14, '26', '2026-01-07', '2026-01-15', 'Abbreviate days ', 'Abbreviate days ', 'Abbreviate days', '', 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table "tempstaff_qualification"
--

CREATE TABLE IF NOT EXISTS "tempstaff_qualification" (
  "tempstaff_qualification_id"              SERIAL,
  "course_name"     VARCHAR(100)  DEFAULT NULL,
  "year_pass"       VARCHAR(100)  DEFAULT NULL,
  "university"      VARCHAR(100)  DEFAULT NULL,
  "reg_date"        VARCHAR(200)  DEFAULT NULL,
  "name_board"      VARCHAR(200)  DEFAULT NULL,
  "school"         VARCHAR(200)  DEFAULT NULL,
  "specialization"  VARCHAR(50)   DEFAULT NULL,
  "username"        VARCHAR(100)  DEFAULT NULL,
  "col_id"          INT           DEFAULT NULL,
  PRIMARY KEY ("tempstaff_qualification_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "temp_previous_job"
--

CREATE TABLE IF NOT EXISTS "temp_previous_job" (
  "prev_post"          VARCHAR(200)  DEFAULT NULL,
  "prev_work_place"    VARCHAR(200)  DEFAULT NULL,
  "prev_work_city"     VARCHAR(200)  DEFAULT NULL,
  "prev_work_country"  VARCHAR(200)  DEFAULT NULL,
  "last_date_work"     DATE          DEFAULT NULL,
  "temp_previous_job_id"                 INT           NOT NULL DEFAULT 0,
  "from_date"          DATE          DEFAULT NULL,
  "username"           VARCHAR(100)  DEFAULT NULL,
  "col_id"             INT           DEFAULT NULL,
  "exp_type"           VARCHAR(100)  DEFAULT NULL,
  PRIMARY KEY ("temp_previous_job_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "temp_rec"
--

CREATE TABLE IF NOT EXISTS "temp_rec" (
  "temp_rec_id"                SERIAL,
  "DESCRIPTION"       DOUBLE PRECISION  NOT NULL,
  "QTY"               DOUBLE PRECISION  NOT NULL,
  "AMOUNT"            DOUBLE PRECISION  NOT NULL,
  "SUBTOTAL"          DOUBLE PRECISION  NOT NULL,
  "DISCOUNTAMOUNT"    DOUBLE PRECISION  NOT NULL,
  "SERVICETAXAMOUNT"  DOUBLE PRECISION  NOT NULL,
  "TOTAL"             DOUBLE PRECISION  NOT NULL,
  "ATTENDEDBY"        INT     NOT NULL,
  "USERNAME"          INT     NOT NULL,
  PRIMARY KEY ("temp_rec_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "temp_staff_dependents"
--

CREATE TABLE IF NOT EXISTS "temp_staff_dependents" (
  "temp_staff_dependents_id"        INT           NOT NULL DEFAULT 0,
  "dname"     VARCHAR(100)  DEFAULT NULL,
  "ddob"      VARCHAR(100)  DEFAULT NULL,
  "drel"      VARCHAR(50)   DEFAULT NULL,
  "doccu"     VARCHAR(50)   DEFAULT NULL,
  "d_addr"    VARCHAR(255)  DEFAULT NULL,
  "username"  VARCHAR(100)  DEFAULT NULL,
  "col_id"    INT           DEFAULT NULL,
  "d_phone"   INT           DEFAULT NULL,
  PRIMARY KEY ("temp_staff_dependents_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "temp_trans"
--

CREATE TABLE IF NOT EXISTS "temp_trans" (
  "temp_id"         BIGINT        NOT NULL,
  "temp_dept"       VARCHAR(250)  NOT NULL,
  "temp_vtype"      VARCHAR(250)  NOT NULL,
  "temp_billno"     VARCHAR(250)  NOT NULL,
  "temp_billdate"   DATE          NOT NULL,
  "temp_vno"        VARCHAR(250)  NOT NULL,
  "temp_vdate"      DATE          NOT NULL,
  "temp_cb"         VARCHAR(250)  NOT NULL,
  "temp_cdno"       VARCHAR(250)  NOT NULL,
  "temp_cddate"     DATE          NOT NULL,
  "temp_tds"        NUMERIC(18,2)  NOT NULL,
  "temp_narration"  VARCHAR(250)  NOT NULL,
  "temp_by"         VARCHAR(250)  NOT NULL,
  "temp_to"         VARCHAR(250)  NOT NULL,
  "temp_byam"       NUMERIC(18,2)  NOT NULL,
  "temp_toam"       NUMERIC(18,2)  NOT NULL,
  "temp_tr"         VARCHAR(250)  NOT NULL,
  PRIMARY KEY ("temp_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "timetable"
--

CREATE TABLE IF NOT EXISTS "timetable" (
  "timetable_id"           SERIAL,
  "subjectcode"  VARCHAR(15)  DEFAULT NULL,
  "subname"      VARCHAR(30)  DEFAULT NULL,
  "hallno"       VARCHAR(10)  DEFAULT NULL,
  "staffid"      VARCHAR(15)  DEFAULT NULL,
  "staffname"    VARCHAR(20)  DEFAULT NULL,
  "course_id"    VARCHAR(10)  DEFAULT NULL,
  "sem_id"       INT          DEFAULT NULL,
  "sec_id"       INT          DEFAULT NULL,
  "batchid"      INT          DEFAULT 0,
  "pid"          INT          DEFAULT NULL,
  "sub_id"       INT          DEFAULT NULL,
  "weekday"      INT          DEFAULT NULL,
  PRIMARY KEY ("timetable_id")
);

--
-- Dumping data for table "timetable"
--

INSERT INTO "timetable" ("timetable_id", "subjectcode", "subname", "hallno", "staffid", "staffname", "course_id", "sem_id", "sec_id", "batchid", "pid", "sub_id", "weekday") VALUES
(1, '81', '06 Math', '15', '52', 'Dawn Schlecht', '3', 10, 287, 0, 2, 81, 1),
(2, '77', '06 Homeroom', '15', '52', 'Dawn Schlecht', '3', 10, 71, 0, 2, 77, 3),
(3, '77', '06 Homeroom', '15', '52', 'Dawn Schlecht', '3', 10, 71, 0, 1, 77, 5),
(4, '77', '06 Homeroom', '15', '52', 'Dawn Schlecht', '3', 10, 71, 0, 1, 77, 3),
(5, '77', '06 Homeroom', '15', '52', 'Dawn Schlecht', '3', 10, 71, 0, 1, 77, 4),
(6, '78', '06 Humanities', '10', '11', 'Brinda Anandh', '3', 10, 244, 0, 3, 78, 3),
(7, '78', '06 Humanities', '10', '11', 'Brinda Anandh', '3', 10, 244, 0, 7, 78, 1),
(8, '78', '06 Humanities', '10', '11', 'Brinda Anandh', '3', 10, 244, 0, 6, 78, 2),
(9, '78', '06 Humanities', '10', '11', 'Brinda Anandh', '3', 10, 244, 0, 7, 78, 2),
(10, '78', '06 Humanities', '10', '11', 'Brinda Anandh', '3', 10, 244, 0, 4, 78, 5);

-- --------------------------------------------------------

--
-- Table structure for table "tptfeehead"
--

CREATE TABLE IF NOT EXISTS "tptfeehead" (
  "tptfeehead_id"        SERIAL,
  "route"     INT  DEFAULT NULL,
  "point_id"  INT  DEFAULT NULL,
  "amount"    INT  DEFAULT NULL,
  "accyr"     INT  DEFAULT NULL,
  PRIMARY KEY ("tptfeehead_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "trans_fee_str"
--

CREATE TABLE IF NOT EXISTS "trans_fee_str" (
  "trans_fee_str_id"        SERIAL,
  "validity"  SMALLINT  DEFAULT NULL,
  "FMon"      INT         DEFAULT NULL,
  "FYear"     INT         DEFAULT NULL,
  "amount"    INT         NOT NULL,
  PRIMARY KEY ("trans_fee_str_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "tripmaster"
--

CREATE TABLE IF NOT EXISTS "tripmaster" (
  "tripmaster_id"         SERIAL,
  "route_id"   VARCHAR(100)  DEFAULT NULL,
  "trip_name"  VARCHAR(100)  DEFAULT NULL,
  "trip_time"  VARCHAR(100)  DEFAULT NULL,
  PRIMARY KEY ("tripmaster_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "type"
--

CREATE TABLE IF NOT EXISTS "type" (
  "type_id"    SERIAL,
  "type"  VARCHAR(10)  DEFAULT NULL,
  PRIMARY KEY ("type_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "unit_kg"
--

CREATE TABLE IF NOT EXISTS "unit_kg" (
  "unit_kg_id"            SERIAL,
  "class"         INT   NOT NULL,
  "exam_id"       INT   NOT NULL,
  "master_skill"  INT   NOT NULL,
  "acc_year"      INT   NOT NULL,
  "student_id"    INT   NOT NULL,
  "theme"         TEXT  NOT NULL,
  "idea"          TEXT  NOT NULL,
  "skill_cm"      TEXT  NOT NULL,
  "profile"       TEXT  NOT NULL,
  "fac_cmt"       TEXT  NOT NULL,
  PRIMARY KEY ("unit_kg_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "unpaid_leave_data_m20"
--

CREATE TABLE IF NOT EXISTS "unpaid_leave_data_m20" (
  "unpaid_leave_data_m20_id"             SERIAL,
  "staff_id"       INT           NOT NULL,
  "E_Code"         VARCHAR(255)  NOT NULL,
  "Employee_Name"  VARCHAR(255)  NOT NULL,
  "Apr_13"         VARCHAR(255)  NOT NULL,
  "May_13"         VARCHAR(255)  NOT NULL,
  "June_13"        VARCHAR(255)  NOT NULL,
  "July_13"        VARCHAR(255)  NOT NULL,
  "Aug_13"         VARCHAR(255)  NOT NULL,
  "Sep_13"         VARCHAR(255)  NOT NULL,
  "Oct_13"         VARCHAR(255)  NOT NULL,
  "Nov_13"         VARCHAR(255)  NOT NULL,
  "Dec_13"         VARCHAR(255)  NOT NULL,
  "Jan_14"         VARCHAR(255)  NOT NULL,
  "Feb_14"         VARCHAR(255)  NOT NULL,
  "March_14"       VARCHAR(255)  NOT NULL,
  PRIMARY KEY ("unpaid_leave_data_m20_id")
);

--
-- Dumping data for table "unpaid_leave_data_m20"
--

INSERT INTO "unpaid_leave_data_m20" ("unpaid_leave_data_m20_id", "staff_id", "E_Code", "Employee_Name", "Apr_13", "May_13", "June_13", "July_13", "Aug_13", "Sep_13", "Oct_13", "Nov_13", "Dec_13", "Jan_14", "Feb_14", "March_14") VALUES
(1, 281, '8481', 'Aakruti Shah', '', '', '', '', '', '', '', '', '', '', '0.25', '0.25'),
(2, 170, '8429', 'Aarti Ahuja', '', '', '', '', '', '', '', '', '', '', '', ''),
(3, 188, '8439', 'Aarti Potdar', '', '', '', '', '', '', '', '', '', '', '', ''),
(4, 122, '8281', 'Abha Shah', '', '', '', '', '', '', '', '', '', '', '', '3'),
(5, 127, '8225', 'Akshada Pagar', '', '', '', '', '', '', '', '', '', '', '', ''),
(6, 140, '8018', 'Almas Lokhande', '', '', '', '', '', '', '', '', '', '', '', ''),
(7, 104, '8012', 'Ambika Menon', '', '', '', '', '', '', '', '', '', '', '', ''),
(8, 136, '8275', 'Anindita Mukherjee', '', '', '', '', '', '', '', '', '', '', '', ''),
(9, 174, '8442', 'Anita Crasto', '', '', '', '', '', '', '', '', '', '', '', '0.25'),
(10, 282, '8446', 'Ankita Thapliyal', '', '', '', '', '', '', '', '', '', '', '4', '1');

-- --------------------------------------------------------

--
-- Table structure for table "usermenu"
--

CREATE TABLE IF NOT EXISTS "usermenu" (
  "username"   VARCHAR(50)       DEFAULT NULL,
  "module"     VARCHAR(50)       DEFAULT NULL,
  "submodule"  VARCHAR(50)       DEFAULT NULL,
  "linkname"   VARCHAR(250)      DEFAULT NULL,
  "linkpath"   VARCHAR(250)      DEFAULT NULL,
  "access"     VARCHAR(50)  DEFAULT NULL,
  "parameter"  VARCHAR(250)      DEFAULT NULL,
  "id"         INT               DEFAULT NULL,
  "inc"        SERIAL,
  "groupname"  VARCHAR(50)       DEFAULT NULL,
  "rights"     VARCHAR(1)        DEFAULT 'V',
  PRIMARY KEY ("inc")
);

--
-- Dumping data for table "usermenu"
--

INSERT INTO "usermenu" ("username", "module", "submodule", "linkname", "linkpath", "access", "parameter", "id", "inc", "groupname", "rights") VALUES
('administrator', 'Accounts', 'Add Masters', 'Bank Details', '/lms/fee/bank_det.php', 'Yes', '', 1, 1, 'NULL', 'V'),
('administrator', 'Accounts', 'Add Masters', 'Fee Head', '/lms/fee/feetypeadd.php', 'Yes', '', 2, 2, 'NULL', 'V'),
('administrator', 'Accounts', 'Add Masters', 'General Fee Structure', '/lms/fee/feestut.php', 'Yes', '', 3, 3, 'NULL', 'V'),
('vitnab', 'Online Assessment', 'Add Masters', 'Declare Exam', '/lms/OnlineAss/declare_exam.php', 'Yes', '', 404, 87258, 'FACULTY', 'V'),
('snehak', 'Academic Report', 'Reports', 'Secondary Report Card', '/lms/grade/sec_reportCard.php', 'Yes', '', 502, 101183, 'FACULTY', 'V'),
('heidih', 'Student Management', 'Reports', 'Parent Username', '/lms/student_det/parentUsername.php', 'Yes', '', 432, 121853, 'FACULTY', 'V'),
('aartia', 'Online Assessment', 'Add Masters', 'Evaluate', '/lms/OnlineAss/Evaluate.php', 'Yes', '', 407, 116966, 'FACULTY', 'V'),
('manjuu', 'Student Assessment', 'Add Masters', 'Student Report Card', '/lms/skills/studentReportCard.php', 'Yes', '', 524, 100013, 'FACULTY', 'V'),
('administrator', 'Staff Management', 'Add Masters', 'Leave Management', '/lms/employee_details/leave.php', 'Yes', '', 476, 33431, '', 'V'),
('administrator', 'Accounts', 'Add Masters', 'Scholarship Update', '/lms/fee/studsearch.php', 'Yes', '', 10, 10, 'NULL', 'V'),
('administrator', 'Accounts', 'Reports', 'Demanded Fee Structure', '/lms/fee/dmdfee.php', 'Yes', '', 12, 12, 'NULL', 'V');


-- --------------------------------------------------------

--
-- Table structure for table "users"
--

CREATE TABLE IF NOT EXISTS "users" (
  "user_id"      SERIAL,
  "username"     VARCHAR(50)       NOT NULL,
  "password"     VARCHAR(255)      DEFAULT NULL,
  "count"        SMALLINT          DEFAULT 0,
  "activated"    VARCHAR(50)       DEFAULT 'On',
  "fullname"     VARCHAR(100)      DEFAULT NULL,
  "description"  VARCHAR(250)      DEFAULT NULL,
  "disabledate"  DATE              DEFAULT NULL,
  "person"       VARCHAR(50)       DEFAULT NULL,
  "s_id"         VARCHAR(50)       DEFAULT NULL,
  "user_type"    CHAR(2)           DEFAULT NULL,
  "srid"         INT               DEFAULT NULL,
  "groupname"    VARCHAR(100)      DEFAULT NULL,
  "shortname"    VARCHAR(10)       DEFAULT NULL,
  PRIMARY KEY ("user_id")
);

--
-- Dumping data for table "users"
--

INSERT INTO "users" ("username", "password", "user_id", "count", "activated", "fullname", "description", "disabledate", "person", "s_id", "user_type", "srid", "groupname", "shortname") VALUES
('administrator', 'c556fc50260d162e18350cc2352dc38b', 1, 1, 'On', 'admin', 'admin', NULL, 'Staff', 'a1', 'NT', 0, 'adminm', 'admin'),
('priyadarshinir', '9154e0bfa96d744818cd15ea25a9c84c', 0, 1, 'On', 'Priyadarshini Ramteke', '', NULL, 'Staff', 'RD-S8629', NULL, 18, 'FACULTY', 'Priyadarsh'),
('faculty', '827ccb0eea8a706c4c34a16891f84e7b', 0, 1, 'On', 'Faculty Test', '', NULL, 'Staff', 'RD-S0001', NULL, 209, 'FACULTY', 'admin'),
('vladimirk', '9154e0bfa96d744818cd15ea25a9c84c', 0, 0, 'On', 'Vladimir Kuskovski', 'User', NULL, 'None', 'RD-S21112', NULL, 251, 'SLT', 'Vladimir'),
('pujas', '9154e0bfa96d744818cd15ea25a9c84c', 0, 1, 'On', 'Puja Srivastava', 'User', NULL, 'None', 'RD-S2026', NULL, 250, 'SLT', 'Puja'),
('andrewc', '510aa8bfcab9e742e9ab98d707b811d7', 0, 1, 'On', 'Andrew Crofton', 'user', NULL, 'Staff', '8227', NULL, 1, 'FACULTY', 'Andrew'),
('annem', '6d4ce717499b3df5d6101ab1dc18c09a', 0, 1, 'On', 'Anne Murray', 'User', NULL, 'Staff', '9054', NULL, 2, 'FACULTY', 'Anne '),
('shannac', '9154e0bfa96d744818cd15ea25a9c84c', 0, 0, 'On', 'Shanna Crofton', '', NULL, 'Staff', '8226', NULL, 3, 'SLT', 'Shanna '),
('adrienneh', 'c89f9f4ef264e22001f9a9c3d72992ef', 0, 1, 'On', 'Adrienne Higley', 'User', NULL, 'Staff', '8273', NULL, 4, 'FACULTY', 'Adrienne');

-- --------------------------------------------------------

--
-- Table structure for table "user_group"
--

CREATE TABLE IF NOT EXISTS "user_group" (
  "user_group_id"          INT           NOT NULL DEFAULT 1,
  "group_name"  VARCHAR(50)   DEFAULT NULL,
  "module"      VARCHAR(50)   DEFAULT NULL,
  "submodule"   VARCHAR(50)   DEFAULT NULL,
  "linkname"    VARCHAR(250)  DEFAULT NULL,
  "parameter"   VARCHAR(250)  DEFAULT NULL,
  "linkpath"    VARCHAR(250)  DEFAULT NULL,
  PRIMARY KEY ("user_group_id")
);

--
-- Dumping data for table "user_group"
--

INSERT INTO "user_group" ("group_name", "module", "submodule", "linkname", "id", "parameter", "linkpath") VALUES
('COORDINATOR', 'Class', 'Reports', 'Subject wise Attendance Report', 298, '', '/lms/studatt/subject_attreport.php'),
('HUMAN RESOURCE', 'Main', 'Main', 'Staff Management', 205, '', '/lms/menu/staffmenu.php'),
('COORDINATOR', 'Class', 'Reports', 'Consolidated Attendance Report', 299, '', '/lms/studatt/View_Attendance.php'),
('FACULTY', 'Settings', 'Add Masters', 'Subjects', 244, '', '/lms/masters/subadd.php'),
('COORDINATOR', 'Main', 'Main', 'Student Assessment', 210, '', '/lms/menu/studattdmenu.php'),
('FACULTY', 'Student-Management', 'Reports', 'View Student Details', 232, '', '/lms/student_det/search_student_det.php'),
('HUMAN RESOURCE', 'Main', 'Main', 'Settings', 204, '', '/lms/menu/mastermenu.php'),
('FACULTY', 'Main', 'Main', 'User Management', 206, '', '/lms/menu/usermenu.php'),
('FACULTY', 'Main', 'Main', 'Time Table', 209, '', '/lms/menu/timetablemenu.php'),
('FACULTY', 'Main', 'Main', 'Student-Management', 207, '', '/lms/menu/studentmenu.php'),
('FACULTY', 'Main', 'Main', 'Student Assessment', 210, '', '/lms/menu/studattdmenu.php'),
('FACULTY', 'Main', 'Main', 'Staff Management', 205, '', '/lms/menu/staffmenu.php'),
('FACULTY', 'Main', 'Main', 'Email & SMS alert', 212, '', '/lms/menu/enoticemenu.php'),
('FACULTY', 'Class', 'Reports', 'Detailed Student Attendance', 303, '', '/lms/studatt/det_att_rep_stud.php'),
('FACULTY', 'Staff Management', 'Add Masters', 'Leave Management', 476, '', '/lms/employee_details/leave.php'),
('ADMIN', 'Class', 'Reports', 'Master Lesson Plan', 408, '', '/lms/TimeTable/master_lesson_plan_rep.php'),
('COORDINATOR', 'Class', 'Reports', 'Detailed Attendance Report', 304, '', '/lms/studatt/det_stud.php'),
('FACULTY', 'Online Assessment', 'Add Masters', 'Add Questions', 405, '', '/lms/OnlineAss/add_questions.php'),
('FACULTY', 'Online Assessment', 'Add Masters', 'Declare Exam', 404, '', '/lms/OnlineAss/declare_exam.php'),
('FACULTY', 'Online Assessment', 'Add Masters', 'Evaluate', 407, '', '/lms/OnlineAss/Evaluate.php'),
('FACULTY', 'Online Assessment', 'Add Masters', 'Online Assessment', 406, '', '/lms/OnlineAss/online_assessment.php'),
('FACULTY', 'Parents Web', 'Appointment Scheduler', 'Confirm Meeting', 547, '', '/lms/Calendar/adminScheduler.php'),
('FACULTY', 'Parents Web', 'Calendar', 'Class Calendar', 438, '', '/lms/Calendar/class_call.php'),
('FACULTY', 'Parents Web', 'Reports', 'Lunch Calendar', 441, '', '/lms/Calendar/Lunch_Calendar_rep.php'),
('FACULTY', 'Parents Web', 'Reports', 'School Announcement', 70, '', '/lms/Calendar/scannouncementRep.php'),
('FACULTY', 'Photo Gallery', 'Add', 'Class', 396, '', '/lms/PhotoGallery/classGallery.php'),
('FACULTY', 'Photo Gallery', 'View', 'School', 397, '', '/lms/PhotoGallery/schoolGalleryView.php'),
('FACULTY', 'Settings', 'Add Masters', 'Subject Group', 410, '', '/lms/masters/Subject_Group.php'),
('FACULTY', 'Settings', 'Add Masters', 'Subject Type', 243, '', '/lms/masters/subtypeadd.php'),
('FACULTY', 'Settings', 'Add Masters', 'Subjects', 244, '', '/lms/masters/subadd.php'),
('ADMISSION', 'Main', 'Main', 'Student-Management', 207, '', '/lms/menu/studentmenu.php'),
('ADMISSION', 'Main', 'Main', 'Photo Gallery', 399, '', '/lms/menu/Gallery.php'),
('ADMISSION', 'Main', 'Main', 'Pre-Admission', 222, '', '/lms/menu/preadmission.php'),
('ADMISSION', 'Main', 'Main', 'Staff Management', 205, '', '/lms/menu/staffmenu.php'),
('FACULTY', 'Student Management', 'Add Masters', 'Apply Course', 326, '', '/lms/student_det/studentcourse.php'),
('FACULTY', 'Student Management', 'Reports', 'Admission Type Wise Report', 235, '', '/lms/student_det/admissiontypewise.php'),
('FACULTY', 'Student Management', 'Reports', 'Category Wise Report', 236, '', '/lms/student_det/CasteWise.php'),
('FACULTY', 'Student Management', 'Reports', 'Gender Wise Report', 238, '', '/lms/student_det/sexwise.php'),
('FACULTY', 'Student Management', 'Reports', 'Parent Username', 432, '', '/lms/student_det/parentUsername.php'),
('FACULTY', 'Student Management', 'Reports', 'Student List', 230, '', '/lms/student_det/list_of_student.php'),
('FACULTY', 'Student Management', 'Reports', 'View Student Details', 232, '', '/lms/student_det/search_student_det.php'),
('FACULTY', 'Transportation', 'Reports', 'Route Wise Members Report', 356, '', '/lms/Transportation/report_passenger.php'),
('FACULTY', 'Student Assessment', 'Add Masters', 'Student Report Card', 524, '', '/lms/skills/studentReportCard.php'),
('FACULTY', 'User Management', 'Users', 'Change Password', 372, '', '/lms/AdminTask/changepass.php'),
('DEPUTY HEAD MY', 'Main', 'Main', 'Accounts', 208, '', '/lms/menu/feemenu.php'),
('DEPUTY HEAD MY', 'Main', 'Main', 'Asset Management', 223, '', '/lms/menu/assetmenu.php'),
('DEPUTY HEAD MY', 'Main', 'Main', 'Charges', 217, '', '/lms/menu/charges.php'),
('DEPUTY HEAD MY', 'Main', 'Main', 'Class', 214, '', '/lms/menu/class.php'),
('DEPUTY HEAD MY', 'Main', 'Main', 'Email & SMS alert', 212, '', '/lms/menu/enoticemenu.php'),
('DEPUTY HEAD MY', 'Main', 'Main', 'Health Management', 221, '', '/lms/menu/healthManagement.php'),
('DEPUTY HEAD MY', 'Main', 'Main', 'Hostel Management', 220, '', '/lms/menu/hostelmenu.php'),
('DEPUTY HEAD MY', 'Main', 'Main', 'Inventory', 216, '', '/lms/menu/inventory.php'),
('DEPUTY HEAD MY', 'Main', 'Main', 'Library Management', 219, '', '/lms/menu/libmenu.php'),
('DEPUTY HEAD MY', 'Main', 'Main', 'Online Assessment', 403, '', '/lms/menu/Online.php'),
('DEPUTY HEAD MY', 'Main', 'Main', 'Parents Web', 218, '', '/lms/menu/calendar.php'),
('DEPUTY HEAD MY', 'Main', 'Main', 'Photo Gallery', 399, '', '/lms/menu/Gallery.php'),
('DEPUTY HEAD MY', 'Main', 'Main', 'Pre-Admission', 222, '', '/lms/menu/preadmission.php'),
('DEPUTY HEAD MY', 'Main', 'Main', 'Settings', 204, '', '/lms/menu/mastermenu.php'),
('DEPUTY HEAD MY', 'Main', 'Main', 'Staff Management', 205, '', '/lms/menu/staffmenu.php'),
('DEPUTY HEAD MY', 'Main', 'Main', 'Student Assessment', 210, '', '/lms/menu/studattdmenu.php'),
('DEPUTY HEAD MY', 'Main', 'Main', 'Student-Management', 207, '', '/lms/menu/studentmenu.php'),
('DEPUTY HEAD MY', 'Main', 'Main', 'Time Table', 209, '', '/lms/menu/timetablemenu.php'),
('DEPUTY HEAD MY', 'Main', 'Main', 'Transportation', 211, '', '/lms/menu/tptmenu.php'),
('DEPUTY HEAD MY', 'Main', 'Main', 'User Management', 206, '', '/lms/menu/usermenu.php'),
('ADMIN', 'Email & SMS alert', 'SMS', 'Send MSG', 84, '', '/lms/mail_msg/FetchsubjectDet1.php'),
('MEDICAL', 'Health Management', 'Infirmary Report', 'View Sick Report', 114, '', '/lms/health_management/view_report.php'),
('ADMIN', 'Email & SMS alert', 'Reports', 'Mail Log', 488, '', '/lms/mail_msg/maillog.php'),
('MEDICAL', 'Health Management', 'Student Medical Details', 'Medical details', 391, '', '/lms/health_management/student_medical.php'),
('MEDICAL', 'Main', 'Main', 'Student-Management', 207, '', '/lms/menu/studentmenu.php'),
('MEDICAL', 'Main', 'Main', 'Staff Management', 205, '', '/lms/menu/staffmenu.php'),
('ADMIN', 'Class', 'Reports', 'Teacher lesson plan', 409, '', '/lms/TimeTable/Teacher_lesson_plan_rep.php'),
('SCHOOL ADMIN', 'Main', 'Main', 'Student-Information', 477, '', '/lms/menu/Student-Information.php'),
('SCHOOL ADMIN', 'Main', 'Main', 'Student-Management', 207, '', '/lms/menu/studentmenu.php'),
('SCHOOL ADMIN', 'Main', 'Main', 'Email & SMS alert', 212, '', '/lms/menu/enoticemenu.php'),
('SCHOOL ADMIN', 'Main', 'Main', 'Parents Web', 218, '', '/lms/menu/calendar.php'),
('SCHOOL ADMIN', 'Class', 'Reports', 'Detailed Student Attendance', 303, '', '/lms/studatt/det_att_rep_stud.php'),
('SCHOOL ADMIN', 'Class', 'Reports', 'Detailed Attendance Report', 304, '', '/lms/studatt/det_stud.php'),
('SCHOOL ADMIN', 'Class', 'Reports', 'Day wise Attendance Report', 301, '', '/lms/studatt/daywise_attreport.php'),
('SCHOOL ADMIN', 'Class', 'Class', 'Lesson Plan', 82, '', '/lms/TimeTable/lesson_plan.php'),
('SCHOOL ADMIN', 'Class', 'Reports', 'Consolidated Attendance Report', 299, '', '/lms/studatt/View_Attendance.php'),
('SCHOOL ADMIN', 'Class', 'Reports', 'Class Report', 485, '', '/lms/class/class_report.php'),
('SCHOOL ADMIN', 'Class', 'Class', 'Home Work', 80, '', '/lms/TimeTable/homework.php'),
('SCHOOL ADMIN', 'Class', 'Add Masters', 'Teacher lesson plan', 332, '', '/lms/TimeTable/teacher_lesson_plan.php'),
('ADMIN', 'Class', 'Reports', 'Subject wise Attendance Report', 298, '', '/lms/studatt/subject_attreport.php'),
('SEC - FACULTY', 'Main', 'Main', 'Parents Web', 218, '', '/lms/menu/calendar.php'),
('SEC - FACULTY', 'Academic Report', 'Add Masters', 'Add Comment', 500, '', '/lms/grade/addcmnt.php'),
('SCHOOL ADMIN', 'Email & SMS alert', 'Email', 'Send Email', 384, '', '/lms/mail_msg/mail/sendmail.php'),
('SCHOOL ADMIN', 'Email & SMS alert', 'Reports', 'Mail Log', 488, '', '/lms/mail_msg/maillog.php'),
('SCHOOL ADMIN', 'Email & SMS alert', 'Email', 'Email Settings', 385, '', '/lms/mail_msg/mail/mailsettings.php'),
('SCHOOL ADMIN', 'Health Management', 'Student Medical Details', 'Add Medical Report', 109, '', '/lms/health_management/add_medical.php'),
('SCHOOL ADMIN', 'Health Management', 'Student Medical Details', 'Edit Medical Report', 110, '', '/lms/health_management/edit_medical_rep.php');

-- --------------------------------------------------------

--
-- Table structure for table "vechile_master"
--

CREATE TABLE IF NOT EXISTS "vechile_master" (
  "vechile_master_id"                    SERIAL,
  "registration_no"       VARCHAR(10)    DEFAULT NULL,
  "vechile_mod_no"        VARCHAR(20)    DEFAULT NULL,
  "year_of_mfg"           VARCHAR(10)    DEFAULT NULL,
  "registration_details"  VARCHAR(50)    DEFAULT NULL,
  "trans_type"            VARCHAR(50)  DEFAULT NULL,
  "lease_det"             VARCHAR(100)   DEFAULT NULL,
  "passng_capacity_sch"   INT            DEFAULT NULL,
  "passng_capacity_col"   INT            DEFAULT NULL,
  "fittness_date"         DATE           DEFAULT NULL,
  "insurance_date"        DATE           DEFAULT NULL,
  "road_tax_date"         DATE           DEFAULT NULL,
  "permit"                DATE           DEFAULT NULL,
  PRIMARY KEY ("vechile_master_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "vendormaster_assets"
--

CREATE TABLE IF NOT EXISTS "vendormaster_assets" (
  "vendormaster_assets_id"              SERIAL,
  "name"            VARCHAR(250)      DEFAULT NULL,
  "contact_person"  VARCHAR(100)      DEFAULT NULL,
  "phone"           VARCHAR(30)       DEFAULT NULL,
  "fax"             VARCHAR(30)       DEFAULT NULL,
  "email"           VARCHAR(30)       DEFAULT NULL,
  "black_listed"    VARCHAR(50)  DEFAULT 'NO',
  "address"         VARCHAR(255)      DEFAULT NULL,
  "remarks"         VARCHAR(255)      DEFAULT NULL,
  "ledger_id"       VARCHAR(10)       DEFAULT NULL,
  "pan_no"          VARCHAR(20)       DEFAULT NULL,
  PRIMARY KEY ("vendormaster_assets_id")
);

-- --------------------------------------------------------

--
-- Table structure for table "week_updates"
--

CREATE TABLE IF NOT EXISTS "week_updates" (
  "week_updates_id"        SERIAL,
  "name"      VARCHAR(50)   NOT NULL,
  "link"      VARCHAR(200)  NOT NULL,
  "adate"     DATE          NOT NULL,
  "username"  VARCHAR(255)  NOT NULL,
  "class"     VARCHAR(255)  NOT NULL,
  "status"    SMALLINT    NOT NULL,
  PRIMARY KEY ("week_updates_id")
);

--
-- Dumping data for table "week_updates"
--

INSERT INTO "week_updates" ("week_updates_id", "name", "link", "adate", "username", "class", "status") VALUES
(1, 'obilogonew', 'view_week/23-08-20261377221669obilogonew.png', '2026-08-23', 'administrator', '139', 1),
(2, 'oberoi report', 'view_week/23-08-20261377221759oberoi report.pdf', '2026-08-23', 'administrator', '139', 1),
(3, 'Unit letter for ''Relationships''', 'view_week/26-08-20261377509079Unit letter for ''Relationships''.docx', '2026-08-26', 'administrator', '3', 1),
(4, 'Who We Are- Unit letter 2026-2026', 'view_week/26-08-20261377509160Who We Are- Unit letter 2026-2026.doc', '2026-08-26', 'administrator', '2', 1),
(5, 'Unit letter - our actions and behaviour', 'view_week/26-08-20261377510131Unit letter - our actions and behaviour.docx', '2026-08-26', 'administrator', '4', 1),
(6, 'Unit letter role models', 'view_week/26-08-20261377510261Unit letter role models.docx', '2026-08-26', 'administrator', '7', 1),
(7, 'OIS Academic Honesty Policy 2026-14', 'view_week/26-08-20261377516148.doc', '2026-08-26', 'administrator', '10', 1),
(8, 'Secondary Parent Handbook-1', 'view_week/26-08-20261377516132.docx', '2026-08-26', 'administrator', '10', 1),
(9, 'Gr 3 21-24 Aug', 'view_week/26-08-20261377511650.ppt', '2026-08-26', 'administrator', '7', 1),
(10, 'OIS Homework Policy 2026-14', 'view_week/26-08-20261377516158.docx', '2026-08-26', 'administrator', '10', 1),


-- --------------------------------------------------------

--
-- Table structure for table "working_year"
--

CREATE TABLE IF NOT EXISTS "working_year" (
  "working_year_id"          SERIAL,
  "Company_ID"  INT               DEFAULT NULL,
  "From_Date"   DATE              DEFAULT NULL,
  "To_Date"     DATE              DEFAULT NULL,
  "activated"   VARCHAR(50)  DEFAULT 'On',
  "Transfered"  VARCHAR(50)  DEFAULT 'No',
  PRIMARY KEY ("working_year_id")
);

-- --------------------------------------------------------
-- NORMALIZED TABLES (added 2026-06-07 — DBA optimization)
-- --------------------------------------------------------

--
-- Unified attendance log replacing the 34 separate att_* tables.
-- Partitioned by year for O(1) archival via DROP PARTITION.
--

CREATE TABLE IF NOT EXISTS "attendance_log" (
  "id"          BIGSERIAL,
  "att_date"    DATE                NOT NULL,
  "stu_id"      INTEGER        NOT NULL,
  "subject_id"  INTEGER  NOT NULL DEFAULT 0,
  "class_id"    SMALLINT   NOT NULL,
  "sec"         SMALLINT   NOT NULL,
  "mor"         SMALLINT          NOT NULL DEFAULT 0,
  "after"       SMALLINT          NOT NULL DEFAULT 0,
  "username"    VARCHAR(50)         NOT NULL DEFAULT '',
  "att_desc"    VARCHAR(500)        NOT NULL DEFAULT '',
  PRIMARY KEY ("id", "att_date")
);

CREATE INDEX "ix_stu_date" ON "attendance_log" ("stu_id",     "att_date");
CREATE INDEX "ix_date_class" ON "attendance_log" ("att_date",   "class_id", "sec");
CREATE INDEX "ix_subj_date" ON "attendance_log" ("subject_id", "att_date");
PARTITION BY RANGE (YEAR("att_date")) (
  PARTITION p2024 VALUES LESS THAN (2025),
  PARTITION p2025 VALUES LESS THAN (2026),
  PARTITION p2026 VALUES LESS THAN (2027),
  PARTITION p2027 VALUES LESS THAN (2028),
  PARTITION pmax  VALUES LESS THAN MAXVALUE
);

-- --------------------------------------------------------

--
-- Normalized parent/guardian contacts (replaces 25+ flat columns in student_m).
-- Supports unlimited contacts per student without schema changes.
--

CREATE TABLE IF NOT EXISTS "student_contacts" (
  "student_contacts_id"            SERIAL,
  "student_m_id"  INTEGER                        NOT NULL,
  "relation"      VARCHAR(50)  NOT NULL,
  "full_name"     VARCHAR(100)                        DEFAULT NULL,
  "email"         VARCHAR(150)                        DEFAULT NULL,
  "mobile"        VARCHAR(20)                         DEFAULT NULL,
  "occupation"    VARCHAR(100)                        DEFAULT NULL,
  "organisation"  VARCHAR(100)                        DEFAULT NULL,
  "designation"   VARCHAR(100)                        DEFAULT NULL,
  "pan_no"        VARCHAR(20)                         DEFAULT NULL,
  "address"       VARCHAR(255)                        DEFAULT NULL,
  PRIMARY KEY ("student_contacts_id")
);

CREATE INDEX "ix_student_rel" ON "student_contacts" ("student_m_id", "relation");

-- --------------------------------------------------------

--
-- Overflow table for large TEXT/blob columns from student_m.
-- Keeps the main student_m row compact for sequential scans.
--

CREATE TABLE IF NOT EXISTS "student_extended" (
  "student_m_id"  INTEGER  NOT NULL,
  "parent_org"    TEXT          DEFAULT NULL,
  "residence"     VARCHAR(255)  DEFAULT NULL,
  "office"        VARCHAR(255)  DEFAULT NULL,
  "per_grade"     VARCHAR(100)  DEFAULT NULL,
  PRIMARY KEY ("student_m_id")
);

-- --------------------------------------------------------

--
-- Pre-aggregated grade summary cache for read-heavy report queries.
-- Refreshed nightly; report pages query this instead of joining grade_assessment + grade_category.
--

CREATE TABLE IF NOT EXISTS "grade_summary_cache" (
  "subject"       INTEGER       NOT NULL,
  "a_year"        SMALLINT  NOT NULL,
  "term_id"       SMALLINT   NOT NULL,
  "avg_score"     DECIMAL(5,2)       DEFAULT NULL,
  "top_grade"     VARCHAR(5)         DEFAULT NULL,
  "refreshed_at"  TIMESTAMP           NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY ("subject", "a_year", "term_id")
);

-- ============================================================
-- Fix: Advance sequences past seed data to prevent id collisions
-- Run these statements AFTER the initial data load.
-- ============================================================
SELECT setval(pg_get_serial_sequence('"academic_exam"', 'academic_exam_id'), COALESCE((SELECT MAX("academic_exam_id") FROM "academic_exam"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"academic_term"', 'academic_term_id'), COALESCE((SELECT MAX("academic_term_id") FROM "academic_term"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"academic_year"', 'academic_year_id'), COALESCE((SELECT MAX("academic_year_id") FROM "academic_year"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"admission"', 'admission_id'), COALESCE((SELECT MAX("admission_id") FROM "admission"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"admission_stage_master"', 'admission_stage_master_id'), COALESCE((SELECT MAX("admission_stage_master_id") FROM "admission_stage_master"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"admission_steps_master"', 'admission_steps_master_id'), COALESCE((SELECT MAX("admission_steps_master_id") FROM "admission_steps_master"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"admissiontrack"', 'admissiontrack_id'), COALESCE((SELECT MAX("admissiontrack_id") FROM "admissiontrack"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"album"', 'album_id'), COALESCE((SELECT MAX("album_id") FROM "album"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"albumpic"', 'albumpic_id'), COALESCE((SELECT MAX("albumpic_id") FROM "albumpic"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"all_teachers"', 'all_teachers_id'), COALESCE((SELECT MAX("all_teachers_id") FROM "all_teachers"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"announcement_call"', 'announcement_call_id'), COALESCE((SELECT MAX("announcement_call_id") FROM "announcement_call"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"announcement_class"', 'announcement_class_id'), COALESCE((SELECT MAX("announcement_class_id") FROM "announcement_class"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"announcement_class_call"', 'announcement_class_call_id'), COALESCE((SELECT MAX("announcement_class_call_id") FROM "announcement_class_call"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"announcement_class_test"', 'announcement_class_test_id'), COALESCE((SELECT MAX("announcement_class_test_id") FROM "announcement_class_test"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"att_0"', 'att_0_id'), COALESCE((SELECT MAX("att_0_id") FROM "att_0"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"att_1"', 'att_1_id'), COALESCE((SELECT MAX("att_1_id") FROM "att_1"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"att_14"', 'att_14_id'), COALESCE((SELECT MAX("att_14_id") FROM "att_14"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"att_15"', 'att_15_id'), COALESCE((SELECT MAX("att_15_id") FROM "att_15"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"att_16"', 'att_16_id'), COALESCE((SELECT MAX("att_16_id") FROM "att_16"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"att_2"', 'att_2_id'), COALESCE((SELECT MAX("att_2_id") FROM "att_2"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"att_3"', 'att_3_id'), COALESCE((SELECT MAX("att_3_id") FROM "att_3"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"att_4"', 'att_4_id'), COALESCE((SELECT MAX("att_4_id") FROM "att_4"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"att_5"', 'att_5_id'), COALESCE((SELECT MAX("att_5_id") FROM "att_5"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"att_6"', 'att_6_id'), COALESCE((SELECT MAX("att_6_id") FROM "att_6"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"att_7"', 'att_7_id'), COALESCE((SELECT MAX("att_7_id") FROM "att_7"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"att_8"', 'att_8_id'), COALESCE((SELECT MAX("att_8_id") FROM "att_8"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"att_9"', 'att_9_id'), COALESCE((SELECT MAX("att_9_id") FROM "att_9"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"attendance"', 'attendance_id'), COALESCE((SELECT MAX("attendance_id") FROM "attendance"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"attendance_points"', 'attendance_points_id'), COALESCE((SELECT MAX("attendance_points_id") FROM "attendance_points"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"bank_details"', 'bank_details_id'), COALESCE((SELECT MAX("bank_details_id") FROM "bank_details"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"calendar_reason"', 'calendar_reason_id'), COALESCE((SELECT MAX("calendar_reason_id") FROM "calendar_reason"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"calendar_schedule"', 'calendar_schedule_id'), COALESCE((SELECT MAX("calendar_schedule_id") FROM "calendar_schedule"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"calendar_schedule_bk"', 'calendar_schedule_bk_id'), COALESCE((SELECT MAX("calendar_schedule_bk_id") FROM "calendar_schedule_bk"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"calendar_schedule_setup"', 'calendar_schedule_setup_id'), COALESCE((SELECT MAX("calendar_schedule_setup_id") FROM "calendar_schedule_setup"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"calendar_schedule_time"', 'calendar_schedule_time_id'), COALESCE((SELECT MAX("calendar_schedule_time_id") FROM "calendar_schedule_time"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"calendar_time"', 'calendar_time_id'), COALESCE((SELECT MAX("calendar_time_id") FROM "calendar_time"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"certificate_m"', 'certificate_m_id'), COALESCE((SELECT MAX("certificate_m_id") FROM "certificate_m"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"class_announcement_class"', 'class_announcement_class_id'), COALESCE((SELECT MAX("class_announcement_class_id") FROM "class_announcement_class"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"class_announcement_files"', 'class_announcement_files_id'), COALESCE((SELECT MAX("class_announcement_files_id") FROM "class_announcement_files"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"class_announcement_master"', 'class_announcement_master_id'), COALESCE((SELECT MAX("class_announcement_master_id") FROM "class_announcement_master"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"class_section"', 'class_section_id'), COALESCE((SELECT MAX("class_section_id") FROM "class_section"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"class_section_sub"', 'class_section_sub_id'), COALESCE((SELECT MAX("class_section_sub_id") FROM "class_section_sub"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"class_teacher"', 'class_teacher_id'), COALESCE((SELECT MAX("class_teacher_id") FROM "class_teacher"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"classtime"', 'classtime_id'), COALESCE((SELECT MAX("classtime_id") FROM "classtime"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"school"', 'col_id'), COALESCE((SELECT MAX("col_id") FROM "school"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"country"', 'country_id'), COALESCE((SELECT MAX("country_id") FROM "country"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"course_m"', 'course_id'), COALESCE((SELECT MAX("course_id") FROM "course_m"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"course_year"', 'year_id'), COALESCE((SELECT MAX("year_id") FROM "course_year"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"coursehead"', 'coursehead_id'), COALESCE((SELECT MAX("coursehead_id") FROM "coursehead"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"day"', 'day_id'), COALESCE((SELECT MAX("day_id") FROM "day"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"dept_no"', 'dpt_id'), COALESCE((SELECT MAX("dpt_id") FROM "dept_no"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"doc_detail"', 'doc_detail_id'), COALESCE((SELECT MAX("doc_detail_id") FROM "doc_detail"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"dp_exam_sub_m"', 'dp_exam_sub_m_id'), COALESCE((SELECT MAX("dp_exam_sub_m_id") FROM "dp_exam_sub_m"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"eca_fee_apply"', 'eca_fee_apply_id'), COALESCE((SELECT MAX("eca_fee_apply_id") FROM "eca_fee_apply"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"eca_fee_invoice"', 'eca_fee_invoice_id'), COALESCE((SELECT MAX("eca_fee_invoice_id") FROM "eca_fee_invoice"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"eca_fee_invoice_det"', 'eca_fee_invoice_det_id'), COALESCE((SELECT MAX("eca_fee_invoice_det_id") FROM "eca_fee_invoice_det"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"eca_type"', 'fee_id'), COALESCE((SELECT MAX("fee_id") FROM "eca_type"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"empallowances"', 'empallowances_id'), COALESCE((SELECT MAX("empallowances_id") FROM "empallowances"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"exam_sub_m"', 'exam_sub_m_id'), COALESCE((SELECT MAX("exam_sub_m_id") FROM "exam_sub_m"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"exam_sub_sub_m"', 'exam_sub_sub_m_id'), COALESCE((SELECT MAX("exam_sub_sub_m_id") FROM "exam_sub_sub_m"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"exam_year_m"', 'exam_year_m_id'), COALESCE((SELECT MAX("exam_year_m_id") FROM "exam_year_m"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"fee_apply_fee_student"', 'fee_apply_fee_student_id'), COALESCE((SELECT MAX("fee_apply_fee_student_id") FROM "fee_apply_fee_student"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"fee_challan_mail_log"', 'fee_challan_mail_log_id'), COALESCE((SELECT MAX("fee_challan_mail_log_id") FROM "fee_challan_mail_log"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"fee_discount_det"', 'fee_discount_det_id'), COALESCE((SELECT MAX("fee_discount_det_id") FROM "fee_discount_det"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"fee_discount_head"', 'fee_discount_head_id'), COALESCE((SELECT MAX("fee_discount_head_id") FROM "fee_discount_head"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"fee_discount_slab"', 'fee_discount_slab_id'), COALESCE((SELECT MAX("fee_discount_slab_id") FROM "fee_discount_slab"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"fee_discount_student"', 'fee_discount_student_id'), COALESCE((SELECT MAX("fee_discount_student_id") FROM "fee_discount_student"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"fee_invoice_settings"', 'fee_invoice_settings_id'), COALESCE((SELECT MAX("fee_invoice_settings_id") FROM "fee_invoice_settings"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"fee_logo"', 'fee_logo_id'), COALESCE((SELECT MAX("fee_logo_id") FROM "fee_logo"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"fee_m_cheque_det"', 'fee_m_cheque_det_id'), COALESCE((SELECT MAX("fee_m_cheque_det_id") FROM "fee_m_cheque_det"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"fee_m_collect"', 'fee_m_collect_id'), COALESCE((SELECT MAX("fee_m_collect_id") FROM "fee_m_collect"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"fee_m_currency_code"', 'fee_m_currency_code_id'), COALESCE((SELECT MAX("fee_m_currency_code_id") FROM "fee_m_currency_code"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"fee_m_descrption"', 'fee_m_descrption_id'), COALESCE((SELECT MAX("fee_m_descrption_id") FROM "fee_m_descrption"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"fee_m_descrption_head_total"', 'fee_m_descrption_head_total_id'), COALESCE((SELECT MAX("fee_m_descrption_head_total_id") FROM "fee_m_descrption_head_total"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"fee_m_descrption_inst_total"', 'fee_m_descrption_inst_total_id'), COALESCE((SELECT MAX("fee_m_descrption_inst_total_id") FROM "fee_m_descrption_inst_total"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"fee_m_descrption_invoice"', 'fee_m_descrption_invoice_id'), COALESCE((SELECT MAX("fee_m_descrption_invoice_id") FROM "fee_m_descrption_invoice"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"fee_m_descrption_invoice_head"', 'fee_m_descrption_invoice_head_id'), COALESCE((SELECT MAX("fee_m_descrption_invoice_head_id") FROM "fee_m_descrption_invoice_head"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"fee_m_head_total"', 'fee_m_head_total_id'), COALESCE((SELECT MAX("fee_m_head_total_id") FROM "fee_m_head_total"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"fee_mail_log"', 'fee_mail_log_id'), COALESCE((SELECT MAX("fee_mail_log_id") FROM "fee_mail_log"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"fee_slab_student"', 'fee_slab_student_id'), COALESCE((SELECT MAX("fee_slab_student_id") FROM "fee_slab_student"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"fee_tax"', 'fee_tax_id'), COALESCE((SELECT MAX("fee_tax_id") FROM "fee_tax"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"fee_type"', 'fee_id'), COALESCE((SELECT MAX("fee_id") FROM "fee_type"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"fee_upload"', 'fee_upload_id'), COALESCE((SELECT MAX("fee_upload_id") FROM "fee_upload"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"fee_upload_deleted"', 'fee_upload_deleted_id'), COALESCE((SELECT MAX("fee_upload_deleted_id") FROM "fee_upload_deleted"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"field_info"', 'f_id'), COALESCE((SELECT MAX("f_id") FROM "field_info"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"fresh_contact_list"', 'fresh_contact_list_id'), COALESCE((SELECT MAX("fresh_contact_list_id") FROM "fresh_contact_list"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"general_doc_details"', 'general_doc_details_id'), COALESCE((SELECT MAX("general_doc_details_id") FROM "general_doc_details"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"grade_assessment"', 'grade_assessment_id'), COALESCE((SELECT MAX("grade_assessment_id") FROM "grade_assessment"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"grade_avg"', 'grade_avg_id'), COALESCE((SELECT MAX("grade_avg_id") FROM "grade_avg"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"grade_category"', 'grade_category_id'), COALESCE((SELECT MAX("grade_category_id") FROM "grade_category"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"grade_grace"', 'grade_grace_id'), COALESCE((SELECT MAX("grade_grace_id") FROM "grade_grace"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"grade_m_64_1"', 'grade_m_64_1_id'), COALESCE((SELECT MAX("grade_m_64_1_id") FROM "grade_m_64_1"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"grade_m_64_2"', 'grade_m_64_2_id'), COALESCE((SELECT MAX("grade_m_64_2_id") FROM "grade_m_64_2"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"grade_m_71_1"', 'grade_m_71_1_id'), COALESCE((SELECT MAX("grade_m_71_1_id") FROM "grade_m_71_1"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"grade_m_71_2"', 'grade_m_71_2_id'), COALESCE((SELECT MAX("grade_m_71_2_id") FROM "grade_m_71_2"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"grade_m_exception"', 'grade_m_exception_id'), COALESCE((SELECT MAX("grade_m_exception_id") FROM "grade_m_exception"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"grade_points"', 'grade_points_id'), COALESCE((SELECT MAX("grade_points_id") FROM "grade_points"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"grade_points_eal"', 'grade_points_eal_id'), COALESCE((SELECT MAX("grade_points_eal_id") FROM "grade_points_eal"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"grade_points_eal_assessment_key"', 'grade_points_eal_assessment_key_id'), COALESCE((SELECT MAX("grade_points_eal_assessment_key_id") FROM "grade_points_eal_assessment_key"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"grade_setup"', 'grade_setup_id'), COALESCE((SELECT MAX("grade_setup_id") FROM "grade_setup"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"hallno"', 'hallno_id'), COALESCE((SELECT MAX("hallno_id") FROM "hallno"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"hospital_det"', 'hospital_det_id'), COALESCE((SELECT MAX("hospital_det_id") FROM "hospital_det"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"hospital_tab"', 'hospital_tab_id'), COALESCE((SELECT MAX("hospital_tab_id") FROM "hospital_tab"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"ideas"', 'ideas_id'), COALESCE((SELECT MAX("ideas_id") FROM "ideas"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"igc_exam_year_m"', 'igc_exam_year_m_id'), COALESCE((SELECT MAX("igc_exam_year_m_id") FROM "igc_exam_year_m"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"interview"', 'interview_id'), COALESCE((SELECT MAX("interview_id") FROM "interview"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"language"', 'language_id'), COALESCE((SELECT MAX("language_id") FROM "language"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"leave_acc_year"', 'leave_acc_year_id'), COALESCE((SELECT MAX("leave_acc_year_id") FROM "leave_acc_year"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"leave_att_point"', 'leave_att_point_id'), COALESCE((SELECT MAX("leave_att_point_id") FROM "leave_att_point"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"leave_data_m20"', 'leave_data_m20_id'), COALESCE((SELECT MAX("leave_data_m20_id") FROM "leave_data_m20"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"leave_staff_attand"', 'leave_staff_attand_id'), COALESCE((SELECT MAX("leave_staff_attand_id") FROM "leave_staff_attand"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"leave_staff_day"', 'leave_staff_day_id'), COALESCE((SELECT MAX("leave_staff_day_id") FROM "leave_staff_day"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"leave_staff_paid_tot_acc"', 'leave_staff_paid_tot_acc_id'), COALESCE((SELECT MAX("leave_staff_paid_tot_acc_id") FROM "leave_staff_paid_tot_acc"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"leave_staff_paid_tot_acc_temp"', 'leave_staff_paid_tot_acc_temp_id'), COALESCE((SELECT MAX("leave_staff_paid_tot_acc_temp_id") FROM "leave_staff_paid_tot_acc_temp"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"leave_staff_paid_tot_backup"', 'leave_staff_paid_tot_backup_id'), COALESCE((SELECT MAX("leave_staff_paid_tot_backup_id") FROM "leave_staff_paid_tot_backup"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"lesson_chapter"', 'lesson_chapter_id'), COALESCE((SELECT MAX("lesson_chapter_id") FROM "lesson_chapter"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"links"', 'links_id'), COALESCE((SELECT MAX("links_id") FROM "links"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"links_p"', 'links_p_id'), COALESCE((SELECT MAX("links_p_id") FROM "links_p"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"log"', 'log_id'), COALESCE((SELECT MAX("log_id") FROM "log"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"lunch_menu_master"', 'lunch_menu_master_id'), COALESCE((SELECT MAX("lunch_menu_master_id") FROM "lunch_menu_master"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"mail_attachments"', 'mail_attachments_id'), COALESCE((SELECT MAX("mail_attachments_id") FROM "mail_attachments"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"mail_details"', 'mail_details_id'), COALESCE((SELECT MAX("mail_details_id") FROM "mail_details"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"mail_group"', 'mail_group_id'), COALESCE((SELECT MAX("mail_group_id") FROM "mail_group"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"mail_settings"', 'mail_settings_id'), COALESCE((SELECT MAX("mail_settings_id") FROM "mail_settings"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"mailinsert"', 'mailinsert_id'), COALESCE((SELECT MAX("mailinsert_id") FROM "mailinsert"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"master_lesson_plan"', 'master_lesson_plan_id'), COALESCE((SELECT MAX("master_lesson_plan_id") FROM "master_lesson_plan"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"master_skills"', 'master_skills_id'), COALESCE((SELECT MAX("master_skills_id") FROM "master_skills"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"module_info"', 'mod_id'), COALESCE((SELECT MAX("mod_id") FROM "module_info"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"modules"', 'modules_id'), COALESCE((SELECT MAX("modules_id") FROM "modules"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"modules_p"', 'modules_p_id'), COALESCE((SELECT MAX("modules_p_id") FROM "modules_p"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"msg"', 'msg_id'), COALESCE((SELECT MAX("msg_id") FROM "msg"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"msp_unit"', 'msp_unit_id'), COALESCE((SELECT MAX("msp_unit_id") FROM "msp_unit"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"nationality"', 'nationality_id'), COALESCE((SELECT MAX("nationality_id") FROM "nationality"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"online_exam_det"', 'online_exam_det_id'), COALESCE((SELECT MAX("online_exam_det_id") FROM "online_exam_det"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"online_exam_sel_questions"', 'online_exam_sel_questions_id'), COALESCE((SELECT MAX("online_exam_sel_questions_id") FROM "online_exam_sel_questions"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"parentmenu"', 'row_id'), COALESCE((SELECT MAX("row_id") FROM "parentmenu"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"point_master"', 'point_master_id'), COALESCE((SELECT MAX("point_master_id") FROM "point_master"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"pyp_subskills"', 'pyp_subskills_id'), COALESCE((SELECT MAX("pyp_subskills_id") FROM "pyp_subskills"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"rfid_enrolment_user"', 'rfid_enrolment_user_id'), COALESCE((SELECT MAX("rfid_enrolment_user_id") FROM "rfid_enrolment_user"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"rfid_new_aug15"', 'rfid_new_aug15_id'), COALESCE((SELECT MAX("rfid_new_aug15_id") FROM "rfid_new_aug15"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"skill_grade"', 'skill_grade_id'), COALESCE((SELECT MAX("skill_grade_id") FROM "skill_grade"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"sta"', 'sta_id'), COALESCE((SELECT MAX("sta_id") FROM "sta"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"staff_att_updt"', 'staff_att_updt_id'), COALESCE((SELECT MAX("staff_att_updt_id") FROM "staff_att_updt"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"staff_calenders"', 'staff_calenders_id'), COALESCE((SELECT MAX("staff_calenders_id") FROM "staff_calenders"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"staff_class_group"', 'staff_class_group_id'), COALESCE((SELECT MAX("staff_class_group_id") FROM "staff_class_group"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"staff_default"', 'staff_default_id'), COALESCE((SELECT MAX("staff_default_id") FROM "staff_default"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"staff_default_status"', 'staff_default_status_id'), COALESCE((SELECT MAX("staff_default_status_id") FROM "staff_default_status"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"staff_des"', 'd_id'), COALESCE((SELECT MAX("d_id") FROM "staff_des"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"employee_details"', 'employee_details_id'), COALESCE((SELECT MAX("employee_details_id") FROM "employee_details"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"staff_group"', 'staff_group_id'), COALESCE((SELECT MAX("staff_group_id") FROM "staff_group"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"staff_groupnames"', 'staff_groupnames_id'), COALESCE((SELECT MAX("staff_groupnames_id") FROM "staff_groupnames"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"staff_hr_grup"', 'staff_hr_grup_id'), COALESCE((SELECT MAX("staff_hr_grup_id") FROM "staff_hr_grup"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"employee_leave"', 'employee_leave_id'), COALESCE((SELECT MAX("employee_leave_id") FROM "employee_leave"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"employee_leave_hr"', 'employee_leave_hr_id'), COALESCE((SELECT MAX("employee_leave_hr_id") FROM "employee_leave_hr"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"employee_leave_manger"', 'employee_leave_manger_id'), COALESCE((SELECT MAX("employee_leave_manger_id") FROM "employee_leave_manger"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"employee_leave_type"', 'employee_leave_type_id'), COALESCE((SELECT MAX("employee_leave_type_id") FROM "employee_leave_type"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"employee_leave_type_group"', 'employee_leave_type_group_id'), COALESCE((SELECT MAX("employee_leave_type_group_id") FROM "employee_leave_type_group"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"staff_lv_data_feb19"', 'staff_lv_data_feb19_id'), COALESCE((SELECT MAX("staff_lv_data_feb19_id") FROM "staff_lv_data_feb19"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"staff_qualification"', 'staff_qualification_id'), COALESCE((SELECT MAX("staff_qualification_id") FROM "staff_qualification"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"staff_rights"', 'staff_rights_id'), COALESCE((SELECT MAX("staff_rights_id") FROM "staff_rights"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"staff_status"', 'staff_status_id'), COALESCE((SELECT MAX("staff_status_id") FROM "staff_status"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"staff_termination"', 'staff_termination_id'), COALESCE((SELECT MAX("staff_termination_id") FROM "staff_termination"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"staff_time"', 'staff_time_id'), COALESCE((SELECT MAX("staff_time_id") FROM "staff_time"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"student_health"', 'student_health_id'), COALESCE((SELECT MAX("student_health_id") FROM "student_health"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"stud_sibling"', 'stud_sibling_id'), COALESCE((SELECT MAX("stud_sibling_id") FROM "stud_sibling"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"student_card_number"', 'student_card_number_id'), COALESCE((SELECT MAX("student_card_number_id") FROM "student_card_number"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"student_class"', 'student_class_id'), COALESCE((SELECT MAX("student_class_id") FROM "student_class"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"student_course"', 'student_course_id'), COALESCE((SELECT MAX("student_course_id") FROM "student_course"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"student_leavingcertificate"', 'student_leavingcertificate_id'), COALESCE((SELECT MAX("student_leavingcertificate_id") FROM "student_leavingcertificate"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"student_m"', 'student_m_id'), COALESCE((SELECT MAX("student_m_id") FROM "student_m"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"student_m_adminpack"', 'student_m_adminpack_id'), COALESCE((SELECT MAX("student_m_adminpack_id") FROM "student_m_adminpack"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"student_m_appointment"', 'student_m_appointment_id'), COALESCE((SELECT MAX("student_m_appointment_id") FROM "student_m_appointment"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"student_m_ec"', 'student_m_ec_id'), COALESCE((SELECT MAX("student_m_ec_id") FROM "student_m_ec"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"student_m_enquirystatus"', 'student_m_enquirystatus_id'), COALESCE((SELECT MAX("student_m_enquirystatus_id") FROM "student_m_enquirystatus"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"student_m_event"', 'student_m_event_id'), COALESCE((SELECT MAX("student_m_event_id") FROM "student_m_event"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"student_m_field"', 'student_m_field_id'), COALESCE((SELECT MAX("student_m_field_id") FROM "student_m_field"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"student_m_online"', 'student_m_online_id'), COALESCE((SELECT MAX("student_m_online_id") FROM "student_m_online"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"student_m_online_enquirystage"', 'student_m_online_enquirystage_id'), COALESCE((SELECT MAX("student_m_online_enquirystage_id") FROM "student_m_online_enquirystage"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"student_m_pastoral"', 'student_m_pastoral_id'), COALESCE((SELECT MAX("student_m_pastoral_id") FROM "student_m_pastoral"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"student_m_tab"', 'student_m_tab_id'), COALESCE((SELECT MAX("student_m_tab_id") FROM "student_m_tab"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"student_mail_list"', 'student_mail_list_id'), COALESCE((SELECT MAX("student_mail_list_id") FROM "student_mail_list"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"student_modify"', 'student_modify_id'), COALESCE((SELECT MAX("student_modify_id") FROM "student_modify"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"student_pt_m"', 'student_pt_m_id'), COALESCE((SELECT MAX("student_pt_m_id") FROM "student_pt_m"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"student_pt_observation"', 'student_pt_observation_id'), COALESCE((SELECT MAX("student_pt_observation_id") FROM "student_pt_observation"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"student_pt_observation_m"', 'student_pt_observation_m_id'), COALESCE((SELECT MAX("student_pt_observation_m_id") FROM "student_pt_observation_m"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"studentmenu"', 'row_id'), COALESCE((SELECT MAX("row_id") FROM "studentmenu"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"style"', 'field_id'), COALESCE((SELECT MAX("field_id") FROM "style"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"sub_skills"', 'sub_skills_id'), COALESCE((SELECT MAX("sub_skills_id") FROM "sub_skills"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"subject_m"', 'subject_id'), COALESCE((SELECT MAX("subject_id") FROM "subject_m"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"subjecttype"', 'subtype_id'), COALESCE((SELECT MAX("subtype_id") FROM "subjecttype"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"submodules"', 'submodules_id'), COALESCE((SELECT MAX("submodules_id") FROM "submodules"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"tabs"', 'tab_id'), COALESCE((SELECT MAX("tab_id") FROM "tabs"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"teacher_lesson_docments"', 'teacher_lesson_docments_id'), COALESCE((SELECT MAX("teacher_lesson_docments_id") FROM "teacher_lesson_docments"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"teacher_lesson_plan"', 'teacher_lesson_plan_id'), COALESCE((SELECT MAX("teacher_lesson_plan_id") FROM "teacher_lesson_plan"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"timetable"', 'timetable_id'), COALESCE((SELECT MAX("timetable_id") FROM "timetable"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"unpaid_leave_data_m20"', 'unpaid_leave_data_m20_id'), COALESCE((SELECT MAX("unpaid_leave_data_m20_id") FROM "unpaid_leave_data_m20"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"user_group"', 'row_id'), COALESCE((SELECT MAX("row_id") FROM "user_group"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"usermenu"', 'inc'), COALESCE((SELECT MAX("inc") FROM "usermenu"), 0) + 1, false);
SELECT setval(pg_get_serial_sequence('"week_updates"', 'week_updates_id'), COALESCE((SELECT MAX("week_updates_id") FROM "week_updates"), 0) + 1, false);
