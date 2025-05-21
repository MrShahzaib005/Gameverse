<?php
include_once('header.php')
?>
<?php
function addFiveMembers($registrationId,$mysqli) {

    $name = $_POST["player1"];
    $cnic = $_POST["player1CNIC"];
    $addMembersSql = "INSERT INTO team_members (member_name, cnic,registrationId) 
    VALUES ('$name', '$cnic', '$registrationId')";
    $mysqli->query($addMembersSql);

    $name = $_POST["player2"];
    $cnic = $_POST["player2CNIC"];
    $addMembersSql = "INSERT INTO team_members (member_name, cnic,registrationId) 
    VALUES ('$name', '$cnic', '$registrationId')";
    $mysqli->query($addMembersSql);

       $name = $_POST["player3"];
    $cnic = $_POST["player3CNIC"];
    $addMembersSql = "INSERT INTO team_members (member_name, cnic,registrationId) 
    VALUES ('$name', '$cnic', '$registrationId')";
    $mysqli->query($addMembersSql);

       $name = $_POST["player4"];
    $cnic = $_POST["player4CNIC"];
    $addMembersSql = "INSERT INTO team_members (member_name, cnic,registrationId) 
    VALUES ('$name', '$cnic', '$registrationId')";
    $mysqli->query($addMembersSql);

       $name = $_POST["player5"];
    $cnic = $_POST["player5CNIC"];
    $addMembersSql = "INSERT INTO team_members (member_name, cnic,registrationId) 
    VALUES ('$name', '$cnic', '$registrationId')";
    $mysqli->query($addMembersSql);
}

function addSoloMembers($registrationId,$mysqli) {

    $name = $_POST["playerName1"];
    $gameId = $_POST["gameId"];
    $addMembersSql = "INSERT INTO team_members (member_name, gamerId,registrationId) 
    VALUES ('$name', '$gameId', '$registrationId')";
    $mysqli->query($addMembersSql); 
}

$message = "";
if (isset($_POST) && $_SERVER["REQUEST_METHOD"] == "POST") {
    $phone = $_POST["phone"];
    $email = $_POST["email"];
    $whatsapp = $_POST["whatsapp"];
    $cnic = $_POST["cnic"];
    $institution = $_POST["institution"];
    $rollnumber = $_POST["studentId"];
    $transactionId = $_POST["transactionId"];
    $gameSelect = $_POST["gameSelect"];
    $province = $_POST["province"];
    //get province here 

    $sql = "SELECT COUNT(*) as count FROM registration WHERE email_address = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if ($row["count"] > 0) {
        $message = "Email $email already exists!";
    } else {
        // ✅ Handle image upload
        $targetDir = "uploads/";
        $payment_proof = basename($_FILES["payment_proof"]["name"]);
        $targetFile = $targetDir . $payment_proof;
        move_uploaded_file($_FILES["payment_proof"]["tmp_name"], $targetFile);

        // ✅ Insert into database
        $registrationSql = "INSERT INTO registration (email_address, phone, whatsapp,cnic,institution,rollnumber,transactionProof,transactionId,gameSelect,province) 
        VALUES ('$email', '$phone', '$whatsapp', '$cnic','$institution','$rollnumber','$payment_proof','$transactionId','$gameSelect','$province')";
        if ($mysqli->query($registrationSql) === TRUE) {
            $registrationId = $mysqli->insert_id;
            if ($gameSelect == "cod" || $gameSelect == "valorant" || $gameSelect == "pubg") {
                addFiveMembers($registrationId,$mysqli);
            } else {
                addSoloMembers($registrationId,$mysqli);
            }
            $encodedEmail = base64_encode($email);
            $message = "Congratulations! You have successfully registered for game $gameSelect.";
            $emailSubject = "Registration GameVerse $gameSelect";
            $emailMessage = "Congratulations! You have successfully registered for game $gameSelect. Please click on the link below to verify your email address. <br/>";
            $emailMessage .= "Click <a href='https://gamesverse.net/verifyEmail.php?code=$encodedEmail' target='_blank'>verify Email</a> to verify your email address.";
            $header = "From: mirza.aqueel.qau@gmail.com \r\n";
            $header .= "Cc: mr.shahzaib25005@gmail.com \r\n";
            $header .= "MIME-Version: 1.0\r\n";
            $header .= "Content-type: text/html\r\n";
            
            mail($email,$emailSubject,$emailMessage,$header);
   
            
        } else {
            $message = "Error: " . $sql . "<br>" . $mysqli->error;
        }

}

   

    $mysqli->close();
}
?>
<body class="min-h-screen">
    <!-- Navigation -->
    <?php include_once("navigation.html") ?>

    <!-- Registration Header -->
    <?php include_once("registration-header.html") ?>

    <!-- Registration Form -->
    <section class="py-12 bg-gray-900">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="register-form rounded-xl p-8 shadow-2xl">
                <span id="message-panel" class="message"><?php echo $message; ?></span>
                <form action="registration.php" id="eventRegistrationForm" method="POST" enctype="multipart/form-data">
                    <!-- Game Selection -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-300 mb-2">Select Game</label>
                        <?php 
                        $game = "";
                      if (isset($_GET['game'])) {
                            $game = $_GET['game'];
                        } 
                  
                    $games = [
                        "cod" => "COD Black OPS 6 (Team)",
                        "valorant" => "Valorant (Team)",
                        "pubg" => "PUBG Mobile (Team)",
                        "fifa" => "FIFA 25 (Solo)",
                        "tekken" => "Tekken 8 (Solo)"
                    ];
                    
                    ?>
                <select id="gameSelect" name="gameSelect" class="w-full px-4 py-2 rounded-md input-field" required>
                    <option value="">Choose your game</option>
                    <?php foreach ($games as $key => $value): 
                            $sel = "";
                            if ($game == $key):
                                $sel = "selected";
                            endif;
                        ?>
                        <option value="<?= htmlspecialchars($key); ?>" <?= $sel; ?>><?= htmlspecialchars($value); ?></option>
                    <?php endforeach; ?>
                </select>
                    </div>

                    <!-- Team Registration Fields -->
                    <div id="teamFields" class="hidden">
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-300 mb-2">Team Name</label>
                            <input type="text" name="teamName" class="w-full px-4 py-2 rounded-md input-field">
                        </div>

                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-300 mb-2">Team Members</label>
                            <div id="teamMembersContainer" class="space-y-3">
                                <!-- Member fields will be added dynamically -->
                            </div>
                        </div>
                    </div>
                     <!-- For team registrations, add CNIC fields for all players -->
                    <div id="teamMembersCNIC" class="hidden mb-6">
                        <label class="block text-sm font-medium text-gray-300 mb-2">Team Members' CNICs</label>
                        <div id="teamMembersCNICContainer" class="space-y-3">
                            <!-- CNIC fields will be added dynamically -->
                        </div>
                    </div>

                    <!-- Solo Registration Fields -->
                    <div id="soloFields" class="hidden">
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-300 mb-2">Player Name</label>
                            <input type="text" name="playerName1" class="w-full px-4 py-2 rounded-md input-field">
                        </div>

                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-300 mb-2">Gamer Name</label>
                            <input type="text" name="gameId" class="w-full px-4 py-2 rounded-md input-field">
                        </div>
                    </div>

                    <!-- Contact Information -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-300 mb-2">Email</label>
                        <input type="email" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" class="w-full px-4 py-2 rounded-md input-field" required>
                        <p class="text-xs text-gray-400 mt-1">Example: example@email.com</p>
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-300 mb-2">Phone Number</label>
                        <input type="tel" name="phone" pattern="03[0-9]{9}" class="w-full px-4 py-2 rounded-md input-field">
                        <p class="text-xs text-gray-400 mt-1">Format: 03XXXXXXXXX</p>
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-300 mb-2">WhatsApp Number</label>
                        <input type="tel" name="whatsapp" pattern="03[0-9]{9}" class="w-full px-4 py-2 rounded-md input-field" required>
                        <p class="text-xs text-gray-400 mt-1">Format: 03XXXXXXXXX</p>
                    </div>

                    <!-- Additional Information -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-300 mb-2">CNIC Number</label>
                        <input type="text" name="cnic" pattern="[0-9]{5}-[0-9]{7}-[0-9]{1}" class="w-full px-4 py-2 rounded-md input-field" required>
                        <p class="text-xs text-gray-400 mt-1">Format: XXXXX-XXXXXXX-X</p>
                    </div>

                        <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-300 mb-2">Select Province</label>
                        <select id="province" name="province" class="w-full px-4 py-2 rounded-md input-field" required>
                            <option value="">Choose your province</option>
                            <option value="punjab">Punjab</option>
                            <option value="sindh">Sindh</option>
                            <option value="balochistan">Balochistan</option>
                            <option value="kpk">KPK</option>
                            <option value="GB">Azad Kashmir and Gilgit-Baltistan</option>
                        </select>
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-300 mb-2">University/College Name</label>
                        <input type="text" name="institution" class="w-full px-4 py-2 rounded-md input-field" required>
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-300 mb-2">Student ID/Roll Number</label>
                        <input type="text" name="studentId" class="w-full px-4 py-2 rounded-md input-field" required>
                    </div>

                   

                    <!-- Payment Information -->
                    <?php include_once('payment-information.html') ?>

                    <!-- Transaction Details -->
                    <?php include_once('transaction-details.html') ?>

                    <!-- Terms and Conditions -->
                    <?php include_once('terms-and-conditions.html') ?>

                    <button type="submit" class="w-full bg-gradient-to-r from-purple-600 to-blue-500 text-white px-6 py-3 rounded-md font-medium btn-glow mb-8">
                        Complete Registration
                    </button>

                    <!-- Tournament Details -->
                    <?php include_once('tournament-details.html') ?>
                </form>
            </div>
        </div>
    </section>

    <?php
include_once('footer.php')
?>