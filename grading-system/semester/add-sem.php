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
    <div class="container" style="width: 600px;">
        <header>Add New Semester </header>
        <hr style="margin-top: 6px;">

        <form method="POST" style="min-height: 220px;" action="semester-info.php">
            <div class="form first">
                <div class="details personal">
                    <span class="title">Semester Details</span>

                    <div class="fields">
                        <div class="input-field">
                            <label>School Year</label>
                            <input type="text" name="SCHOOL_YEAR" required />
                        </div>

                        <div class="input-field" style="width: 180px;">
                            <label>Semester</label>
                            <select required name="SEMESTER">
                                <option disabled selected>Select Semester </option>
                                <option>1st semester</option>
                                <option>2nd semester</option>
                                <option>Summer</option>
                            </select>
                        </div>

                        <div class="input-field">
                            <label>Status</label>
                            <select required name="STATUS">
                                <option disabled selected>Select Status</option>
                                <option>active</option>
                                <option>inactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="buttons" style="position: absolute;left: 30%;">
                        <div class="backBtn">
                            <i class="uil uil-navigator"></i>
                            <a href="semester.php" class="btnText">Cancel</a>
                        </div>

                        <button class="sumbit">
                            <span class="btnText">Submit</span>
                            <i class="uil uil-navigator" style="font-size: 18px;"></i>
                        </button>
                    </div>
                </div>
            </div>
    </div>

    </div>


    </form>
    </div>
</body>

</html>