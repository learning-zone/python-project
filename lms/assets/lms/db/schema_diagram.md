# LMS Database Schema Diagram

<br>

## Entity Relationship Diagram

```mermaid
erDiagram

    %% ─────────────────────────────────────────
    %% CORE INSTITUTION  [schema: settings]
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

    settings_users {
        int     user_id PK
        varchar username
        varchar password
        varchar email
        int     user_group_id FK
        int     school_id FK
        int     status
    }

    settings_user_group {
        int     user_group_id PK
        varchar group_name
        int     status
    }

    %% ─────────────────────────────────────────
    %% ACADEMIC STRUCTURE  [schema: academic]
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

    course {
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

    subject {
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
    %% STUDENT MANAGEMENT  [schema: student]
    %% ─────────────────────────────────────────
    student {
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
    %% STAFF / EMPLOYEE MANAGEMENT  [schema: hr]
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
    %% ATTENDANCE  [schema: academic]
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
    %% EXAMINATIONS & GRADES  [schema: academic]
    %% ─────────────────────────────────────────
    exam {
        int     exam_id PK
        varchar exam_name
        int     acc_year FK
        int     class_section_id FK
        date    exam_date
        int     status
    }

    exam_subject {
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

    exam_timetable {
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

    exam_online {
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
    %% FEE MANAGEMENT  [schema: fee]
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

    fee {
        int     fee_master_id PK
        varchar student_id FK
        int     fee_head_id FK
        int     acc_year FK
        numeric amount
        date    due_date
        int     status
    }

    fee_collection {
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
    %% TIMETABLE & CALENDAR  [schema: academic / settings]
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

    weekday {
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
    %% ANNOUNCEMENTS & COMMUNICATION  [schema: communication]
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
    %% ADMISSIONS  [schema: admission]
    %% ─────────────────────────────────────────
    admission_process {
        int     admission_steps_master_id PK
        varchar main_steps
        int     pos
        int     status
    }

    admission_stage {
        int     admission_stage_master_id PK
        int     admission_steps_master_id FK
        varchar main_stages
        int     action_1
        varchar posi
        int     status
    }

    admission_track {
        int     admissiontrack_id PK
        int     student_id FK
        text    desdet
        int     trackid FK
        int     mark
    }

    %% ─────────────────────────────────────────
    %% LIBRARY  [schema: library]
    %% ─────────────────────────────────────────
    library_book_details {
        int     book_id PK
        varchar title
        varchar author
        varchar isbn
        int     library_name_id FK
        int     lib_mediatype_id FK
        int     available_copies
    }

    library_circulation {
        int     circulation_id PK
        int     book_id FK
        varchar member_id FK
        date    issue_date
        date    due_date
        date    return_date
        int     status
    }

    library_membership {
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
    %% TRANSPORT  [schema: transport]
    %% ─────────────────────────────────────────
    route {
        int     route_id PK
        varchar route_name
        varchar route_code
        int     school_id FK
        int     status
    }

    vechile {
        int     vehicle_id PK
        varchar vehicle_no
        varchar vehicle_type
        int     route_id FK
        int     driver_id FK
        int     status
    }

    driver {
        int     driver_id PK
        varchar driver_name
        varchar license_no
        varchar contact_no
        int     school_id FK
    }

    trip {
        int     trip_id PK
        int     vehicle_id FK
        int     route_id FK
        date    trip_date
        time    start_time
        time    end_time
    }

    %% ─────────────────────────────────────────
    %% HOSTEL  [schema: hostel]
    %% ─────────────────────────────────────────
    hostel {
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

    hostel_room {
        int     room_id PK
        int     block_id FK
        varchar room_no
        int     capacity
        int     status
    }

    hostel_student {
        int     h_stud_id PK
        varchar student_id FK
        int     room_id FK
        int     hostel_id FK
        date    allot_date
        int     acc_year FK
    }

    %% ─────────────────────────────────────────
    %% ASSET MANAGEMENT  [schema: asset]
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

    asset {
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
    %% RFID / SECURITY  [schema: settings]
    %% ─────────────────────────────────────────
    rfid {
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
    school ||--o{ settings_users : "has"
    settings_user_group ||--o{ settings_users : "belongs_to"

    %% Academic structure
    academic_term ||--o{ academic_exam : "contains"
    course ||--o{ course_year : "has"
    school ||--o{ course : "offers"
    course ||--o{ subject : "includes"
    subjecttype ||--o{ subject : "categorizes"
    academic_year ||--o{ class_section : "scopes"
    class_section ||--o{ class_section_sub : "has_subjects"
    subject ||--o{ class_section_sub : "taught_in"

    %% Student relations
    student ||--|| academic_details : "has"
    student ||--|| additional_student : "extended_by"
    student ||--|| student_extended : "extended_by"
    student ||--|| student_contacts : "has"
    student ||--|| student_health : "has"
    student ||--o{ stud_sibling : "has"
    student ||--o{ student_class : "enrolled_in"
    student ||--o{ student_course : "registered_for"
    class_section ||--o{ student_class : "contains"
    course ||--o{ student_course : "enrolled_by"

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
    student ||--o{ attendance : "tracked_by"
    class_section ||--o{ attendance : "recorded_for"
    student ||--o{ attendance_points : "summarized_in"
    employee_details ||--o{ emp_attendance : "tracked_by"

    %% Exams & Grades
    academic_year ||--o{ exam : "schedules"
    class_section ||--o{ exam : "takes"
    exam ||--o{ exam_subject : "includes"
    subject ||--o{ exam_subject : "assessed_by"
    exam ||--o{ exam_timetable : "scheduled_in"
    exam_subject ||--o{ grade : "graded_by"
    student ||--o{ grade : "receives"
    student ||--|| grade_summary_cache : "summarized_in"
    exam_online ||--o{ online_exam_sel_questions : "contains"
    subject ||--o{ exam_online : "assessed_by"

    %% Fees
    fee_type ||--o{ fee_head : "categorizes"
    fee_head ||--o{ fee : "structures"
    student ||--o{ fee : "owes"
    fee ||--o{ fee_collection : "collected_via"
    student ||--o{ fee_collection : "pays"
    fee_discount_head ||--o{ fee_discount_student : "applied_to"
    student ||--o{ fee_discount_student : "receives"
    student ||--o{ fee_dmd : "demanded_from"
    student ||--|| fee_payment : "has"

    %% Timetable
    class_section ||--o{ timetable : "scheduled_for"
    subject ||--o{ timetable : "scheduled_in"
    employee_details ||--o{ timetable : "teaches_in"
    weekday ||--o{ timetable : "day_of"
    calendar_schedule_type ||--o{ calendar_schedule : "categorizes"

    %% Announcements
    announcement_class ||--o{ announcement : "scoped_from"
    mail_details ||--o{ mail_logs : "tracked_in"

    %% Admissions
    admission_process ||--o{ admission_stage : "has"
    admission_process ||--o{ admission_track : "tracked_in"

    %% Library
    library_name ||--o{ library_book_details : "holds"
    lib_mediatype ||--o{ library_book_details : "typed_as"
    library_book_details ||--o{ library_circulation : "circulated_via"
    library_membership ||--o{ library_circulation : "issued_to"
    school ||--o{ library_membership : "has"

    %% Transport
    school ||--o{ route : "operates"
    route ||--o{ vechile : "assigned_to"
    driver ||--o{ vechile : "drives"
    vechile ||--o{ trip : "operates"

    %% Hostel
    school ||--o{ hostel : "has"
    hostel ||--o{ hostel_block : "contains"
    hostel_block ||--o{ hostel_room : "contains"
    hostel_room ||--o{ hostel_student : "accommodates"
    student ||--o{ hostel_student : "stays_in"

    %% Assets
    asset_group ||--o{ asset_sub_group : "contains"
    asset_sub_group ||--o{ asset : "categorizes"
    school ||--o{ asset : "owns"
    asset ||--o{ individual_asset_details : "detailed_by"
    assetstatusmaster ||--o{ individual_asset_details : "status_of"

    %% RFID
    student ||--o{ rfid_student : "has"
    employee_details ||--o{ rfid_staff_check_in : "logs"
```

---

## Domain Overview

| Domain | Schema | Key Tables | Purpose |
|---|---|---|---|
| **Institution** | `settings` | `company`, `school`, `settings_users`, `settings_user_group` | Multi-tenant institution hierarchy |
| **Academic Structure** | `academic` | `academic_year`, `academic_term`, `course`, `class_section`, `subject` | Curriculum & year structure |
| **Students** | `student` | `student`, `student_class`, `academic_details`, `student_contacts`, `student_health`, `certificate` | Full student lifecycle |
| **Staff / HR** | `hr` | `employee_details`, `employee_department`, `employee_salary`, `employee_leave`, `staff_des`, `staff_qualification` | HR & payroll |
| **Attendance** | `academic` | `attendance`, `attendance_points`, `att_0`–`att_16` (partitioned), `d_att_*` | Student & staff attendance |
| **Examinations** | `academic` | `exam`, `exam_subject`, `exam_timetable`, `exam_online`, `exam_year_m` | Exams & timetables |
| **Grades** | `academic` | `grade`, `grade_summary_cache`, `grade_points`, `marks_*`, `igc_*` | Results & grading |
| **Fees** | `fee` | `fee_head`, `fee`, `fee_collection`, `fee_payment`, `fee_discount_*`, `charges`, `receipt_details`, `bank_details` | Billing & collections |
| **Timetable** | `academic` / `settings` | `timetable`, `calendar_schedule`, `weekday` | Scheduling |
| **Communication** | `communication` | `announcement`, `announcement_class`, `mail_details`, `mail_logs`, `album`, `msg` | Announcements & messaging |
| **Admissions** | `admission` | `admission`, `admission_process`, `admission_stage`, `admission_track`, `interview` | Enrollment workflow |
| **Library** | `library` | `library_book_details`, `library_circulation`, `library_membership`, `library_name`, `lib_mediatype`, `lib_register` | Library management |
| **Transport** | `transport` | `route`, `vechile`, `driver`, `trip`, `pasng_route_master` | Fleet & routing |
| **Hostel** | `hostel` | `hostel`, `hostel_block`, `hostel_room`, `hostel_student`, `hostel_fee_m` | Accommodation |
| **Assets** | `asset` | `asset`, `asset_group`, `asset_sub_group`, `individual_asset_details`, `assetstatusmaster`, `products`, `quotation` | Inventory & procurement |
| **Medical** | `medical` | `doc_detail`, `doc_visit`, `doc_staff`, `general_doc_details`, `hospital_det` | Health records |
| **Settings / RFID** | `settings` | `settings_modules`, `settings_parentmenu`, `settings_submodules`, `settings_links`, `weekday`, `working_year`, `rfid`, `rfid_student`, `rfid_staff_check_in` | System config & access control |
