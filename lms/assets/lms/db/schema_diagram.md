# LMS Database Schema Diagram

> **Stack:** React + Python (Django/FastAPI) + PostgreSQL  
> **Tables:** ~300 tables across 14 functional domains  
> **Note:** Foreign keys are implied by naming conventions (no explicit FK constraints in schema).

---

## Entity Relationship Diagram

```mermaid
erDiagram

    %% ─────────────────────────────────────────
    %% CORE INSTITUTION
    %% ─────────────────────────────────────────
    company {
        int     company_id PK
        varchar name
        varchar code
        varchar address
        varchar phone
        varchar email
    }

    school {
        int     school_id PK
        varchar col_name
        varchar col_code
        varchar col_addr
        int     company_id FK
    }

    users {
        int     user_id PK
        varchar username
        varchar password
        varchar email
        int     user_group_id FK
        int     school_id FK
        int     status
    }

    user_group {
        int     user_group_id PK
        varchar group_name
        int     status
    }

    %% ─────────────────────────────────────────
    %% ACADEMIC STRUCTURE
    %% ─────────────────────────────────────────
    academic_year {
        int     academic_year_id PK
        int     acc_year
        date    from_date
        date    to_date
        int     class_div FK
        smallint status
    }

    academic_term {
        int     academic_term_id PK
        varchar term
        varchar a_year
        date    start_date
        date    end_date
        smallint status
    }

    academic_exam {
        int     academic_exam_id PK
        int     academic_term_id FK
        varchar exam_name
        smallint status
    }

    course_m {
        int     course_id PK
        varchar course_name
        varchar course_code
        int     school_id FK
        int     status
    }

    course_year {
        int     course_year_id PK
        int     course_id FK
        varchar year_name
        int     duration
        int     status
    }

    class_section {
        int     class_section_id PK
        int     grade
        varchar section_name
        int     acc_year FK
        int     school_id FK
        int     status
    }

    class_section_sub {
        int     class_section_sub_id PK
        int     class_section_id FK
        int     subject_id FK
        int     teacher_id FK
        int     acc_year
    }

    subject_m {
        int     subject_id PK
        varchar subject_name
        varchar subject_code
        int     subjecttype_id FK
        int     course_id FK
        int     status
    }

    subjecttype {
        int     subjecttype_id PK
        varchar type_name
        int     status
    }

    %% ─────────────────────────────────────────
    %% STUDENT MANAGEMENT
    %% ─────────────────────────────────────────
    student_m {
        varchar student_id PK
        varchar first_name
        varchar last_name
        char    gender
        date    dob
        varchar email
        int     school_id FK
        int     acc_year FK
        int     status
    }

    academic_details {
        int     academic_details_id PK
        varchar student_id FK
        varchar grade12_board
        int     grade12_total
        int     grade10_total_marks
        numeric puc_totper
    }

    additional_student {
        int     additional_student_id PK
        varchar student_id FK
        int     course_admitted FK
        int     course_yearsem FK
        int     school_id FK
        varchar nationality
        varchar religion
    }

    student_class {
        int     student_class_id PK
        varchar student_id FK
        int     class_section_id FK
        int     acc_year FK
        int     status
    }

    student_course {
        int     student_course_id PK
        varchar student_id FK
        int     course_id FK
        int     course_year_id FK
        int     acc_year FK
    }

    student_contacts {
        int     contact_id PK
        varchar student_id FK
        varchar father_name
        varchar mother_name
        varchar guardian_name
        varchar contact_phone
        varchar email
    }

    student_extended {
        int     extended_id PK
        varchar student_id FK
        varchar nationality
        varchar religion
        varchar blood_group
        text    address
    }

    student_health {
        int     health_id PK
        varchar student_id FK
        varchar blood_group
        varchar allergies
        varchar medical_conditions
        varchar doctor_name
    }

    stud_sibling {
        int     sibling_id PK
        varchar student_id FK
        varchar sibling_name
        int     sibling_class FK
    }

    %% ─────────────────────────────────────────
    %% STAFF / EMPLOYEE MANAGEMENT
    %% ─────────────────────────────────────────
    employee_details {
        int     staff_id PK
        varchar first_name
        varchar last_name
        varchar username FK
        int     employee_department_id FK
        int     staff_des_id FK
        int     school_id FK
        int     status
    }

    employee_department {
        int     employee_department_id PK
        varchar dept_name
        int     school_id FK
        int     status
    }

    staff_des {
        int     staff_des_id PK
        varchar designation
        int     status
    }

    staff_qualification {
        int     qual_id PK
        int     staff_id FK
        varchar degree
        varchar institution
        int     year_passed
    }

    emp_details {
        int     emp_details_id PK
        int     staff_id FK
        varchar bank_name
        varchar bank_ac_no
        varchar pan_no
        int     basic_salary
    }

    employee_salary {
        int     employee_salary_id PK
        int     staff_id FK
        int     acc_year FK
        varchar month
        numeric basic
        numeric gross
        numeric deductions
        numeric net_salary
    }

    employee_leave {
        int     leave_id PK
        int     staff_id FK
        int     leave_type_id FK
        date    from_date
        date    to_date
        varchar status
        varchar remarks
    }

    employee_leave_type {
        int     leave_type_id PK
        varchar leave_type_name
        int     max_days
        int     status
    }

    %% ─────────────────────────────────────────
    %% ATTENDANCE
    %% ─────────────────────────────────────────
    attendance {
        int     att_id PK
        varchar student_id FK
        int     class_section_id FK
        date    att_date
        int     subject_id FK
        int     acc_year FK
        char    status
    }

    attendance_points {
        int     att_points_id PK
        varchar student_id FK
        int     acc_year FK
        int     class_section_id FK
        int     present_days
        int     absent_days
        int     total_days
    }

    emp_attendance {
        int     emp_att_id PK
        int     staff_id FK
        date    att_date
        time    in_time
        time    out_time
        char    status
    }

    %% ─────────────────────────────────────────
    %% EXAMINATIONS & GRADES
    %% ─────────────────────────────────────────
    exam_m {
        int     exam_id PK
        varchar exam_name
        int     acc_year FK
        int     class_section_id FK
        date    exam_date
        int     status
    }

    exam_sub_m {
        int     exam_sub_id PK
        int     exam_id FK
        int     subject_id FK
        int     max_marks
        int     pass_marks
        int     duration
    }

    exam_year_m {
        int     exam_year_id PK
        int     acc_year FK
        varchar exam_name
        int     class_id FK
        int     status
    }

    exam_timetable_m {
        int     timetable_id PK
        int     exam_id FK
        int     subject_id FK
        date    exam_date
        time    start_time
        varchar hall_no
    }

    exam_grade_point {
        int     grade_point_id PK
        varchar grade
        int     min_marks
        int     max_marks
        numeric grade_point
    }

    grade {
        int     grade_id PK
        varchar student_id FK
        int     exam_sub_id FK
        int     marks_obtained
        varchar grade_letter
        varchar remarks
    }

    grade_summary_cache {
        int     cache_id PK
        varchar student_id FK
        int     exam_year_id FK
        int     class_section_id FK
        numeric total_marks
        numeric percentage
        varchar rank
    }

    online_exam_det {
        int     online_exam_id PK
        varchar exam_name
        int     subject_id FK
        int     class_section_id FK
        int     acc_year FK
        date    exam_date
        int     duration_mins
    }

    online_exam_sel_questions {
        int     question_id PK
        int     online_exam_id FK
        text    question
        varchar option_a
        varchar option_b
        varchar option_c
        varchar option_d
        char    correct_option
    }

    %% ─────────────────────────────────────────
    %% FEE MANAGEMENT
    %% ─────────────────────────────────────────
    fee_head {
        int     fee_head_id PK
        varchar head_name
        int     fee_type_id FK
        int     acc_year FK
        int     status
    }

    fee_type {
        int     fee_type_id PK
        varchar type_name
        int     status
    }

    fee_master {
        int     fee_master_id PK
        varchar student_id FK
        int     fee_head_id FK
        int     acc_year FK
        numeric amount
        date    due_date
        int     status
    }

    fee_m_collect {
        int     collection_id PK
        varchar student_id FK
        int     fee_master_id FK
        numeric amount_paid
        date    payment_date
        varchar payment_mode
        varchar receipt_no
    }

    fee_discount_head {
        int     discount_head_id PK
        varchar discount_name
        int     acc_year FK
        int     status
    }

    fee_discount_student {
        int     discount_id PK
        varchar student_id FK
        int     discount_head_id FK
        numeric discount_amount
        int     acc_year FK
    }

    fee_dmd {
        int     fee_dmd_id PK
        varchar student_id FK
        int     fee_head_id FK
        int     acc_year FK
        numeric demanded_amount
        date    due_date
    }

    fee_payment {
        int     fee_payment_id PK
        varchar student_id FK
        int     acc_year FK
        numeric total_paid
        numeric balance
        varchar payment_status
    }

    fee_financial_year {
        int     fin_year_id PK
        varchar year_name
        date    from_date
        date    to_date
        int     status
    }

    %% ─────────────────────────────────────────
    %% TIMETABLE & CALENDAR
    %% ─────────────────────────────────────────
    timetable {
        int     timetable_id PK
        int     class_section_id FK
        int     subject_id FK
        int     staff_id FK
        int     day_id FK
        time    start_time
        time    end_time
        int     acc_year FK
    }

    day {
        int     day_id PK
        varchar day_name
        int     day_order
    }

    calendar_schedule {
        int     schedule_id PK
        date    schedule_date
        varchar title
        text    description
        int     schedule_type_id FK
        int     acc_year FK
        int     class_section_id FK
    }

    calendar_schedule_type {
        int     schedule_type_id PK
        varchar type_name
        varchar color_code
    }

    %% ─────────────────────────────────────────
    %% ANNOUNCEMENTS & COMMUNICATION
    %% ─────────────────────────────────────────
    announcement {
        int     announcement_id PK
        int     acc_year FK
        smallint type
        date    fromdate
        date    todate
        varchar title
        text    description
        smallint status
    }

    announcement_class {
        int     announcement_class_id PK
        int     acc_year FK
        int     grade FK
        int     section_id FK
        varchar username FK
        varchar title
        text    description
        smallint status
    }

    mail_details {
        int     mail_id PK
        varchar from_user FK
        varchar to_list
        varchar subject
        text    body
        datetime sent_date
        int     status
    }

    mail_logs {
        int     log_id PK
        int     mail_id FK
        varchar recipient
        datetime sent_at
        varchar delivery_status
    }

    %% ─────────────────────────────────────────
    %% ADMISSIONS
    %% ─────────────────────────────────────────
    admission_steps_master {
        int     admission_steps_master_id PK
        varchar main_steps
        int     pos
        int     status
    }

    admission_stage_master {
        int     admission_stage_master_id PK
        int     admission_steps_master_id FK
        varchar main_stages
        int     action_1
        varchar posi
        int     status
    }

    admissiontrack {
        int     admissiontrack_id PK
        int     student_id FK
        text    desdet
        int     trackid FK
        int     mark
    }

    %% ─────────────────────────────────────────
    %% LIBRARY
    %% ─────────────────────────────────────────
    lib_book_details {
        int     book_id PK
        varchar title
        varchar author
        varchar isbn
        int     library_name_id FK
        int     lib_mediatype_id FK
        int     available_copies
    }

    lib_circulation_m {
        int     circulation_id PK
        int     book_id FK
        varchar member_id FK
        date    issue_date
        date    due_date
        date    return_date
        int     status
    }

    lib_membership_m {
        int     membership_id PK
        varchar member_id
        varchar member_type
        varchar member_name
        int     school_id FK
        date    valid_upto
    }

    library_name {
        int     library_id PK
        varchar library_name
        int     school_id FK
    }

    lib_mediatype {
        int     mediatype_id PK
        varchar media_type
    }

    %% ─────────────────────────────────────────
    %% TRANSPORT
    %% ─────────────────────────────────────────
    route_master {
        int     route_id PK
        varchar route_name
        varchar route_code
        int     school_id FK
        int     status
    }

    vechile_master {
        int     vehicle_id PK
        varchar vehicle_no
        varchar vehicle_type
        int     route_id FK
        int     driver_id FK
        int     status
    }

    driver_master {
        int     driver_id PK
        varchar driver_name
        varchar license_no
        varchar contact_no
        int     school_id FK
    }

    tripmaster {
        int     trip_id PK
        int     vehicle_id FK
        int     route_id FK
        date    trip_date
        time    start_time
        time    end_time
    }

    %% ─────────────────────────────────────────
    %% HOSTEL
    %% ─────────────────────────────────────────
    hostel_m {
        int     hostel_id PK
        varchar hostel_name
        int     school_id FK
        int     total_rooms
        int     status
    }

    hostel_block {
        int     block_id PK
        int     hostel_id FK
        varchar block_name
        int     status
    }

    hostel_room_m {
        int     room_id PK
        int     block_id FK
        varchar room_no
        int     capacity
        int     status
    }

    hostel_student_m {
        int     h_stud_id PK
        varchar student_id FK
        int     room_id FK
        int     hostel_id FK
        date    allot_date
        int     acc_year FK
    }

    %% ─────────────────────────────────────────
    %% ASSET MANAGEMENT
    %% ─────────────────────────────────────────
    asset_group {
        int     asset_group_id PK
        varchar group_name
        int     status
    }

    asset_sub_group {
        int     asset_sub_group_id PK
        int     asset_group_id FK
        varchar sub_group_name
        int     status
    }

    asset_master {
        int     asset_id PK
        varchar asset_name
        int     asset_sub_group_id FK
        int     school_id FK
        int     status
    }

    assetstatusmaster {
        int     asset_status_id PK
        varchar status_name
    }

    individual_asset_details {
        int     ind_asset_id PK
        int     asset_id FK
        varchar serial_no
        date    purchase_date
        int     asset_status_id FK
        int     school_id FK
    }

    %% ─────────────────────────────────────────
    %% RFID / SECURITY
    %% ─────────────────────────────────────────
    rfid_masters {
        int     rfid_id PK
        varchar card_no
        varchar user_id FK
        varchar user_type
        int     status
    }

    rfid_student {
        int     rfid_student_id PK
        varchar student_id FK
        varchar card_no
        int     status
    }

    rfid_staff_check_in {
        int     checkin_id PK
        int     staff_id FK
        varchar card_no FK
        datetime check_in_time
    }

    %% ─────────────────────────────────────────
    %% RELATIONSHIPS
    %% ─────────────────────────────────────────

    %% Institution hierarchy
    company ||--o{ school : "has"
    school ||--o{ users : "has"
    user_group ||--o{ users : "belongs_to"

    %% Academic structure
    academic_term ||--o{ academic_exam : "contains"
    course_m ||--o{ course_year : "has"
    school ||--o{ course_m : "offers"
    course_m ||--o{ subject_m : "includes"
    subjecttype ||--o{ subject_m : "categorizes"
    academic_year ||--o{ class_section : "scopes"
    class_section ||--o{ class_section_sub : "has_subjects"
    subject_m ||--o{ class_section_sub : "taught_in"

    %% Student relations
    student_m ||--|| academic_details : "has"
    student_m ||--|| additional_student : "extended_by"
    student_m ||--|| student_extended : "extended_by"
    student_m ||--|| student_contacts : "has"
    student_m ||--|| student_health : "has"
    student_m ||--o{ stud_sibling : "has"
    student_m ||--o{ student_class : "enrolled_in"
    student_m ||--o{ student_course : "registered_for"
    class_section ||--o{ student_class : "contains"
    course_m ||--o{ student_course : "enrolled_by"

    %% Staff relations
    employee_department ||--o{ employee_details : "employs"
    staff_des ||--o{ employee_details : "designates"
    school ||--o{ employee_details : "employs"
    employee_details ||--o{ staff_qualification : "has"
    employee_details ||--|| emp_details : "has"
    employee_details ||--o{ employee_salary : "receives"
    employee_leave_type ||--o{ employee_leave : "categorizes"
    employee_details ||--o{ employee_leave : "applies"

    %% Attendance
    student_m ||--o{ attendance : "tracked_by"
    class_section ||--o{ attendance : "recorded_for"
    student_m ||--o{ attendance_points : "summarized_in"
    employee_details ||--o{ emp_attendance : "tracked_by"

    %% Exams & Grades
    academic_year ||--o{ exam_m : "schedules"
    class_section ||--o{ exam_m : "takes"
    exam_m ||--o{ exam_sub_m : "includes"
    subject_m ||--o{ exam_sub_m : "assessed_by"
    exam_m ||--o{ exam_timetable_m : "scheduled_in"
    exam_sub_m ||--o{ grade : "graded_by"
    student_m ||--o{ grade : "receives"
    student_m ||--|| grade_summary_cache : "summarized_in"
    online_exam_det ||--o{ online_exam_sel_questions : "contains"
    subject_m ||--o{ online_exam_det : "assessed_by"

    %% Fees
    fee_type ||--o{ fee_head : "categorizes"
    fee_head ||--o{ fee_master : "structures"
    student_m ||--o{ fee_master : "owes"
    fee_master ||--o{ fee_m_collect : "collected_via"
    student_m ||--o{ fee_m_collect : "pays"
    fee_discount_head ||--o{ fee_discount_student : "applied_to"
    student_m ||--o{ fee_discount_student : "receives"
    student_m ||--o{ fee_dmd : "demanded_from"
    student_m ||--|| fee_payment : "has"

    %% Timetable
    class_section ||--o{ timetable : "scheduled_for"
    subject_m ||--o{ timetable : "scheduled_in"
    employee_details ||--o{ timetable : "teaches_in"
    day ||--o{ timetable : "day_of"
    calendar_schedule_type ||--o{ calendar_schedule : "categorizes"

    %% Announcements
    announcement_class ||--o{ announcement : "scoped_from"
    mail_details ||--o{ mail_logs : "tracked_in"

    %% Admissions
    admission_steps_master ||--o{ admission_stage_master : "has"
    admission_steps_master ||--o{ admissiontrack : "tracked_in"

    %% Library
    library_name ||--o{ lib_book_details : "holds"
    lib_mediatype ||--o{ lib_book_details : "typed_as"
    lib_book_details ||--o{ lib_circulation_m : "circulated_via"
    lib_membership_m ||--o{ lib_circulation_m : "issued_to"
    school ||--o{ lib_membership_m : "has"

    %% Transport
    school ||--o{ route_master : "operates"
    route_master ||--o{ vechile_master : "assigned_to"
    driver_master ||--o{ vechile_master : "drives"
    vechile_master ||--o{ tripmaster : "operates"

    %% Hostel
    school ||--o{ hostel_m : "has"
    hostel_m ||--o{ hostel_block : "contains"
    hostel_block ||--o{ hostel_room_m : "contains"
    hostel_room_m ||--o{ hostel_student_m : "accommodates"
    student_m ||--o{ hostel_student_m : "stays_in"

    %% Assets
    asset_group ||--o{ asset_sub_group : "contains"
    asset_sub_group ||--o{ asset_master : "categorizes"
    school ||--o{ asset_master : "owns"
    asset_master ||--o{ individual_asset_details : "detailed_by"
    assetstatusmaster ||--o{ individual_asset_details : "status_of"

    %% RFID
    student_m ||--o{ rfid_student : "has"
    employee_details ||--o{ rfid_staff_check_in : "logs"
```

---

## Domain Overview

| Domain | Key Tables | Purpose |
|---|---|---|
| **Institution** | `company`, `school`, `users`, `user_group` | Multi-tenant institution hierarchy |
| **Academic Structure** | `academic_year`, `academic_term`, `course_m`, `class_section`, `subject_m` | Curriculum & year structure |
| **Students** | `student_m`, `student_class`, `academic_details`, `student_contacts`, `student_health` | Full student lifecycle |
| **Staff** | `employee_details`, `employee_department`, `employee_salary`, `employee_leave` | HR & payroll |
| **Attendance** | `attendance`, `attendance_points`, `att_0`–`att_16` (partitioned) | Student & staff attendance |
| **Examinations** | `exam_m`, `exam_sub_m`, `exam_timetable_m`, `online_exam_det` | Exams & timetables |
| **Grades** | `grade`, `grade_summary_cache`, `grade_points`, `marks_*` | Results & grading |
| **Fees** | `fee_head`, `fee_master`, `fee_m_collect`, `fee_payment`, `fee_discount_*` | Billing & collections |
| **Timetable** | `timetable`, `calendar_schedule`, `day` | Scheduling |
| **Announcements** | `announcement`, `announcement_class`, `mail_details` | Communication |
| **Admissions** | `admission_steps_master`, `admission_stage_master`, `admissiontrack` | Enrollment workflow |
| **Library** | `lib_book_details`, `lib_circulation_m`, `lib_membership_m` | Library management |
| **Transport** | `route_master`, `vechile_master`, `driver_master`, `tripmaster` | Fleet & routing |
| **Hostel** | `hostel_m`, `hostel_block`, `hostel_room_m`, `hostel_student_m` | Accommodation |
| **Assets** | `asset_master`, `asset_group`, `individual_asset_details` | Inventory |
| **RFID** | `rfid_masters`, `rfid_student`, `rfid_staff_check_in` | Access control |
