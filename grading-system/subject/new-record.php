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
        <header>Add New Subject </header>
        <hr style="margin-top: 6px;">

        <form method="POST" style="min-height: 280px;" action="subject-info.php">
            <div class="form first">
                <div class="details personal">
                    <span class="title">Subject Details</span>

                    <div class="fields">
                        <div class="input-field">

                            <label>Code</label>
                            <input type="text" name="CODE" required />
                        </div>

                        <div class="input-field" style="width: 280px;">
                            <label>Description</label>
                            <input type="text" name="DESCRIPTION" required />
                        </div>

                        <div class="input-field">
                            <label>Unit</label>
                            <input type="text" name="UNIT" required />
                        </div>

                        <div class="input-field">
                            <label>Type</label>
                            <input type="text" name="TYPE" required />
                        </div>
                    </div>
                    <div class="buttons" style="position: absolute;left: 30%;">
                        <div class="backBtn">
                            <i class="uil uil-navigator"></i>
                            <a href="subject.php" class="btnText">Cancel</a>
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