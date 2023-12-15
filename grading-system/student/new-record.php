<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />
    <link rel="stylesheet" href="../CSS/update.css">

    <title>Add New Record</title>
</head>

<body>
    <div class="container">
        <header>Add New Student Record</header>
        <hr style="margin-top: 6px;">

        <form method="POST" action="student-info.php">
            <div class="form first">
                <div class="details personal">
                    <span class="title">Student Details</span>

                    <div class="fields">
                        <div class="input-field">
                            <label>Username</label>
                            <input type="text" name="USERNAME" required />
                        </div>

                        <div class="input-field">
                            <label>Password</label>
                            <input type="text" name="PASSWORD" required />
                        </div>

                        <div class="input-field" style="visibility: hidden;">
                            <label>First Name</label>
                            <input type="text" />
                        </div>

                        <div class="input-field">
                            <label>First Name</label>
                            <input type="text" name="FIRST_NAME" required />
                        </div>

                        <div class="input-field">
                            <label>Middle Name</label>
                            <input type="text" name="MIDDLE_NAME" required />
                        </div>

                        <div class="input-field">
                            <label>Last Name</label>
                            <input type="text" name="LAST_NAME" required />
                        </div>

                        <div class="input-field">
                            <label>Date of Birth</label>
                            <input type="date" name="BIRTH_DATE" required />
                        </div>

                        <div class="input-field">
                            <label>Gender</label>
                            <select required name="GENDER">
                                <option disabled selected>Select gender</option>
                                <option>Male</option>
                                <option>Female</option>
                                <option>Bayot</option>
                                <option>Tomboy</option>
                                <option>Non-Binary</option>
                                <option>Transformer</option>
                                <option>Horse</option>
                                <option>Nigga</option>
                            </select>
                        </div>

                        <div class="input-field">
                            <label>Contact Number</label>
                            <input type="text" name="CONTACT_NUM" required />
                        </div>

                        <div class="input-field">
                            <label>Institute</label>
                            <input type="text" name="INSTITUTE" required />
                        </div>

                        <div class="input-field">
                            <label>Course</label>
                            <input type="text" name="COURSE" required />
                        </div>
                        <div class="input-field" style="visibility: hidden;">
                            <label>Course</label>
                            <input type="text" />
                        </div>
                    </div>
                </div>

                <div class=" details ID">
                    <span class="title">Emergency Details</span>

                    <div class="fields">
                        <div class="input-field">
                            <label>Purok</label>
                            <input type="text" name="PUROK" required>
                        </div>

                        <div class="input-field">
                            <label>Barangay</label>
                            <input type="text" name="BARANGAY" required>
                        </div>

                        <div class="input-field">
                            <label>Municipality</label>
                            <input type="text" name="MUNICIPALITY" required>
                        </div>

                        <div class="input-field">
                            <label>Province</label>
                            <input type="text" name="PROVINCE" required>
                        </div>

                        <div class="input-field">
                            <label>Zip Code</label>
                            <input type="text" name="ZIP_CODE" required>
                        </div>
                        <div class="input-field" style="visibility: hidden;">
                            <label>Course</label>
                            <input type="text" />
                        </div>

                        <div class=" input-field">
                            <label>Guardian Name</label>
                            <input type="text" name="GUARDIAN" required>
                        </div>

                        <div class="input-field">
                            <label>Guardian Contact Number</label>
                            <input type="text" name="GUARD_CONTACT" required>
                        </div>

                        <div class="input-field">
                            <label>Guardian Address</label>
                            <input type="text" name="GUARD_ADDRESS" required>
                        </div>
                    </div>
                </div>
                <div class="buttons" style="position: absolute;left: 30%;">
                    <div class="backBtn">
                        <i class="uil uil-navigator"></i>
                        <a href="student.php" class="btnText">Cancel</a>
                    </div>

                    <button class="sumbit">
                        <span class="btnText">Submit</span>
                        <i class="uil uil-navigator" style="font-size: 18px;"></i>
                    </button>
                </div>
            </div>


        </form>
    </div>
</body>

</html>