<section class="content">
    <pre>
BASE URL: http://localhost/placement/index.php/api/


/////////////////////////////////////////////////
URL: users/login
Input Param:
    username:a@gmail.com
    password:12345

Response True:
{
    "status": true,
    "message": "login successfull",
    "data": {
        "id": "20",
        "name": "Aman",
        "email": "aman@gmail.com",
        "c_code": "",
        "mobile": "123",
        "password": "21232f297a57a5a743894a0e4a801fc3",
        "biometric": "",
        "device_token": "",
        "stream": "jhg",
        "batch": "",
        "applied_in": "0",
        "user_type": "3",
        "skills": "jg",
        "created": "0",
        "status": "1"
    }
}

Response False:
{
    "status": false,
    "message": "Username does not exist",
    "data": {}
}


/////////////////////////////////////////////////
URL: users/forget_password
Input Param:
    username:a@gmail.com
    //if have OTP then
    password:12345
    otp:1234

Response True:
{
    "status": true,
    "message": "password change successfull",
    "data": {
        "id": "3",
        "name": "Mohit",
        "email": "mohit@gmail.com",
        "c_code": "+91",
        "mobile": "95821630988",
        "password": "827ccb0eea8a706c4c34a16891f84e7b",
        "biometric": "Hello",
        "device_token": "",
        "stream": "",
        "batch": "",
        "appeared_in": "0",
        "user_type": "3",
        "skills": "",
        "created": "2",
        "status": "1"
    }
}

Response False:
{
    "status": false,
    "message": "Username does not exist",
    "data": {}
}

///////////Change Password
URL: users/change_password
Input Param:
    user_id:1
    password:12345

Response True:
{
    "status": true,
    "message": "password change successfull",
    "data": []
}

Response False:
{
    "status": false,
    "message": "Password does not change",
    "data": []
}


//////////Get Home User
URL: home/get_home_user
Input Param:
    user_id:20

Response True:
{
    "status": true,
    "message": "Information Displayed",
    "data": {
        "user_data": {
            "id": "20",
            "name": "Anugrah Agarwal",
            "email": "anugrah@gmail.com",
            "c_code": "",
            "mobile": "7895",
            "stream": "btech",
            "batch": "",
            "appeared_in": "0",
            "skills": "php",
            "status": "1"
        },
        "education": [
            {
                "id": "5",
                "user_id": "20",
                "education_id": "1",
                "marks": "200",
                "max_marks": "250",
                "roll_no": "566",
                "created": "1562090423",
                "status": "1",
                "edu_title": "10th"
            },
            {
                "id": "6",
                "user_id": "20",
                "education_id": "2",
                "marks": "200",
                "max_marks": "25",
                "roll_no": "566",
                "created": "1562090423",
                "status": "1",
                "edu_title": "12th"
            },
            {
                "id": "7",
                "user_id": "20",
                "education_id": "3",
                "marks": "200",
                "max_marks": "25",
                "roll_no": "566",
                "created": "1562090423",
                "status": "1",
                "edu_title": "BTECH"
            }
        ],
        "recommended": [
            {
                "id": "5",
                "name": "Google",
                "location": "Noida, Uttar Pradesh, India",
                "package": "2",
                "drive_date": "1564524000",
                "designation": "",
                "is_enrolled": "0"
            },
            {
                "id": "6",
                "name": "Google",
                "location": "Noida, Uttar Pradesh, India",
                "package": "2",
                "drive_date": "1564524000",
                "designation": "",
                "is_enrolled": "0"
            }
        ]
    }
}

Response False
{
    "status": false,
    "message": "Invalid User id",
    "data": []
}

//////////Get Company List
URL: home/get_company_list
Input Param:
    user_id:20

Response True:
{
    "status": true,
    "message": "Company List Displayed",
    "data": [
        {
            "id": "1",
            "name": "Appsqudz"
        },
        {
            "id": "2",
            "name": "app"
        },
        {
            "id": "3",
            "name": "anugrah7890"
        },
        {
            "id": "4",
            "name": "appsquadz"
        },
        {
            "id": "5",
            "name": "Google"
        },
        {
            "id": "6",
            "name": "Google"
        }
    ]
}

Response False
{
    "status": false,
    "message": "No Company Found",
    "data": []
}

//////////Get Student List
URL: home/get_student_list
Input Param:
    user_id:20
    company_id:4

Response True:
{
    "status": true,
    "message": "Student List Displayed",
    "data": [
        {
            "id": "20",
            "name": "Anugrah Agarwal",
            "attendance_id": "1",
            "is_attendance": "1",
            "roll_no": "",
            "graduation": ""
        }
    ]
}
Response False
{
    "status": false,
    "message": "No Student Found",
    "data": []
}


//////////Get Attendance User
URL: home/attendance_user
Input Param:
    user_id:3
    company_id:2
    task_for:1

Response True:
{
    "status": true,
    "message": "Company Enroilled Successfully",
    "data": []
}
Response False
{
    "status": false,
    "message": "Alreay Enrolled",
    "data": []
}

//////////Register Student
URL: home/register_student
Input Param:
    user_id:20
    name:Jack
    email:jack@gmail.com
    mobile:1111
    password:12345678
    stream:M.Tech
    skills:PHP
    batch:2019-2020
    biometric:sdfsfdsfdsfdsfsdfsd
    qualification:[
                    {
                      "education_id": 1,
                      "marks": 20,
                      "max_marks": 200,
                      "roll_no": "1478610006"
                    },
                    {
                      "education_id": 1,
                      "marks": 20,
                      "max_marks": 200,
                      "roll_no": "1478610006"
                    }
                  ]  
  

Response True:
{
    "status": true,
    "message": "User Registered",
    "data": []
}
Response False


//////////Submit Student Attendance
URL: home/submit_student_attendance
Input Param:
    user_id:3
    invigilator_id:2
    task_for:1
    attendance_id:1

Response True:
{
    "status": true,
    "message": "Attendance Submitteded Successfully",
    "data": []
}
Response False
{
    "status": false,
    "message": "Already Attendance Submitted",
    "data": []
}



    </pre>
</section>