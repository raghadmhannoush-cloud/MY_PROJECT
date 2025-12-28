const { institute } = require("./institute");
console.log(institute.name)
alert("مرحبا بكم بدارالمودة لتحفيظ القرآن الكريم");
function register() {
    alert("تم ارسال طلب التسجيل  بنجاح")
}
const newstudent = {
    firstname: "أحمد",
    lastname: "محمد",
    gender: "ذكر",
    birth_date: "2005-05-15",
    phonenumber: "0501234567",
    address: "الرياض",
    join_date: "2023-09-01",
    status: "نشط",
};
const newteacher = {
    first_name: "سارة",
    last_name: "علي",
    phone_number: "0507654321",
    hiring_date: "2022-08-15",
    speciality: "تجويد",
    status: "نشط",
};
const newring = {
    class_name: "حلقة الفجر",
    level: "متوسط",
    description: "حلقة لتحفيظ القرآن في وقت الفجر",
};
const newmaterial = {
    subject_name: "تجويد",
    description: "مادة لتعليم قواعد التجويد",
};
const newregistration = {
    student_id: "STU12345",
    class_id: "CLS67890",
    Registration_date: "2023-09-10",
    Registration_id: "REG54321",
    notes: "تم التسجيل بنجاح",
};
const newattendance = {
    student_id: "STU12345",
    note: "حضر الحلقة بانتظام",
    date: "2023-09-15",
    status: "حاضر",
};
const newgraphicalReport = {
    student_id: "STU12345",
    amount: 500,
    payment_date: "2023-09-20",
    method_pay: "نقدي",
    note: "تم دفع الرسوم الشهرية",
};

<script> let btn=document.getElementById("btn");</script>
let count=btn.getAttribute("data-count");
btn.onclick=function(){
    count++;
    btn.setAttribute("data-count",count);
    btn.innerHTML="تم التوزيع "+count+" مرة";
}
console.log(count);

let students;
if (localStorage.students!=null) {
    students = JSON.parse(localStorage.getItem('students'));
}
else {
    students = [];
}
let teachers;
if (localStorage.teachers!=null) {
    teachers = JSON.parse(localStorage.getItem('teachers'));
}
else {
    teachers = [];
}

let rings;
if (localStorage.rings!=null) {
    rings = JSON.parse(localStorage.getItem('rings'));
}
else {
    rings = [];
}
let materials;
if (localStorage.materials!=null) {
    materials = JSON.parse(localStorage.getItem('materials'));
}
else {
    materials = [];
}
let registrations;
if (localStorage.registrations!=null) {
    registrations = JSON.parse(localStorage.getItem('registrations'));
}
else {
    registrations = [];
}
let attendances;
if (localStorage.attendances!=null) {
    attendances = JSON.parse(localStorage.getItem('attendances'));
}
else {
    attendances = [];
}
let graphicalReports;
if (localStorage.graphicalReports!=null) {
    graphicalReports = JSON.parse(localStorage.getItem('graphicalReports'));
}
else {
    graphicalReports = [];
}
datateachers.push(newteacher);
datastudents.push(newstudent);
datarings.push(newring);
datamaterials.push(newmaterial);
dataregistrations.push(newregistration);
dataattendances.push(newattendance);
datagraphicalReports.push(newgraphicalReport);
console.log(students, teachers, rings, materials, registrations, attendances, graphicalReports);


localStorage.setItem('students', JSON.stringify(students));
localStorage.setItem('teachers', JSON.stringify(teachers));
localStorage.setItem('rings', JSON.stringify(rings));
localStorage.setItem('materials', JSON.stringify(materials));
localStorage.setItem('registrations', JSON.stringify(registrations));
localStorage.setItem('attendances', JSON.stringify(attendances));
localStorage.setItem('graphicalReports', JSON.stringify(graphicalReports));

function cleardata(){
    localStorage.clear();
    alert("تم مسح جميع البيانات");
}
function showdata(){
    console.log(JSON.parse(localStorage.getItem('students')));
    console.log(JSON.parse(localStorage.getItem('teachers')));
    console.log(JSON.parse(localStorage.getItem('rings')));
    console.log(JSON.parse(localStorage.getItem('materials')));
    console.log(JSON.parse(localStorage.getItem('registrations')));
    console.log(JSON.parse(localStorage.getItem('attendances')));
    console.log(JSON.parse(localStorage.getItem('graphicalReports')));

}
function saveData(){
    localStorage.setItem('students', JSON.stringify(students));
    localStorage.setItem('teachers', JSON.stringify(teachers));
    localStorage.setItem('rings', JSON.stringify(rings));
    localStorage.setItem('materials', JSON.stringify(materials));
    localStorage.setItem('registrations', JSON.stringify(registrations));
    localStorage.setItem('attendances', JSON.stringify(attendances));
    localStorage.setItem('graphicalReports', JSON.stringify(graphicalReports));
    alert("تم حفظ البيانات بنجاح");
}

function addStudent(firstname,lastname,gender,birthdate,phonenumber,address,joindate,status){
    const student = {
       firstname:firstname,
       lastname:lastname,
gender:gender,
 birth_date:birthdate,
 phonenumber:phonenumber,
 address:address,
 join_date:joindate,
 status:status,
    }
}
console.log(student)
function displayStudents(){}

function encouragementMessage() { const messages = [ "بارك الله فيك، استمر 🌿", "حفظك الله بما تحفظ من كتابه 📖", "جهد مبارك، إلى الأمام   🌸" ]; const random = Math.floor(Math.random() * messages.length); alert(messages[random]); } 

function addTeacher(first_name,last_name,phone_number, hiring_date,  speciality, status){
       const teacher={      
   first_name:first_name,
    last_name:last_name,
    phone_number:phone_number,
    hiring_date:hiring_date,
    speciality:speciality,
    status:status,
}
}

function addRing(class_name,level,description){
    const Ring={
class_name: class_name,
 level: level,
 description: description,
 }
}
 console.log(Ring);
 function displayRing(){} 

function addMaterial (subject_name,description){

    const Material={
        subject_name:subject_name,
        description:description,
    }
}
console.log(Material)
function displayMaterial(){}

function addRegistration(student_id,class_id,Registration_date,Registration_id,notes){
    const registeration={
        student_id:student_id,
        class_id:class_id,
        Registration_date:Registration_date,
        Registration_id:Registration_id,
        notes:notes
    }
}
 console.log(registeration)
function displayRegistrations(){}
 
function addAttendance (student_id,note,date,status){
    const attendance={
        student_id:student_id,
        note:note,
        date:date,
        status:status,
    }
}
console.log(attendance)
function displayAttendances(){}

function addgraphicalReport(student_id,amount,payment_date, method_pay,note){
    const graphicalReport={
        student_id:student_id,
        amount:amount,
        payment_date:payment_date,
        method_pay:method_pay,
        note:note,
    }
}
console.log(graphicalReport)
function displaygraphicalReports(){}

document.getElementById("classTeacherForm")
.addEventListener("submit", function (e) {
    e.preventDefault();

    const data = {
        teacher_id: this.teacher_id.value,
   
        class_id: this.class_id.value
    };

    fetch("http://localhost:3000/api/class-teacher", {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify(data)
    })
    .then(res => {
        if (res.status === 201) {
            alert("تم توزيع المدرّس بنجاح");
            this.reset();
        }
    })
    .catch(err => console.error(err));
});


document.getElementById("classSubjectForm")
.addEventListener("submit", function (e) {
 e.preventDefault();

 const data = {
 class_id: this.class_id.value,
 subject_id: this.subject_id.value
 };

 fetch("http://localhost:3000/api/class-subject", {
 method: "POST",
 headers: {
 "Content-Type": "application/json"
 },
 body: JSON.stringify(data)
 })
 .then(res => {
 if (res.status === 201) {
 alert("تم توزيع المادة على الحلقة بنجاح");
 this.reset();
}
  }) 
  .catch(err => console.error(err));
});

document.getElementById("studentForm").addEventListener("submit", function (e) {
    e.preventDefault();

    const studentData = {
        first_name: this.first_name.value,
        last_name: this.last_name.value,
        gender: this.gender.value,
        birth_date: this.birth_date.value,
        phone_number: this.phone_number.value,
        address: this.address.value,
        join_date: this.join_date.value,
        status: "active"
    };
    fetch("http://localhost:3000/api/students", {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify(studentData)
    })
    .then(response => response.json())
    .then(data => {
        alert("تم إضافة الطالب بنجاح");
        this.reset();
    })
    .catch(error => {
        console.error("Error:", error);
    });
});

fetch("http://localhost:3000/api/students")
.then(response => response.json())
.then(data => {
    data.forEach(student => {
        const row = document.querySelector("#students table").insertRow();
 row.innerHTML =
 <td>${student.id}</td><td>${student.first_name}</td><td>${student.last_name}</td><td>${student.gender}</td><td>${student.birth_date}</td><td>${student.phone_number}</td><td>${student.address}</td><td>${student.join_date}</td><td>${student.status}</td>;
        });

        });
