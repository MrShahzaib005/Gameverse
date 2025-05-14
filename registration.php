<?php
include_once('header.php')
?>
<body class="min-h-screen">
    <!-- Navigation -->
    <nav class="bg-gray-900 bg-opacity-90 backdrop-filter backdrop-blur-lg border-b border-gray-800 fixed w-full z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <a href="index.html" class="text-2xl font-gaming gradient-text">GAMEVERSE</a>
                    </div>
                    <div class="hidden md:block">
                        <div class="ml-10 flex items-baseline space-x-8">
                            <a href="index.html" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Home</a>
                            <a href="#" class="text-white px-3 py-2 rounded-md text-sm font-medium">Register</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Registration Header -->
    <section class="pt-32 pb-16 px-4 sm:px-6 lg:px-8 bg-gradient-to-b from-gray-900 to-gray-800">
        <div class="max-w-7xl mx-auto">
            <div class="text-center">
                <h1 class="text-4xl md:text-5xl font-gaming font-bold mb-4 gradient-text">GameVerse25 Registration</h1>
                <p class="text-xl text-gray-300 max-w-3xl mx-auto">
                    Join the biggest gaming tournament of 2025 with over 600,000 PKR in total prizes across multiple games.
                </p>
            </div>
        </div>
    </section>

    <!-- Registration Form -->
    <section class="py-12 bg-gray-900">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="register-form rounded-xl p-8 shadow-2xl">
                <form action="registration.php" id="eventRegistrationForm" method="POST" enctype="multipart/form-data">
                    <!-- Game Selection -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-300 mb-2">Select Game</label>
                        <select id="gameSelect" name="gameSelect" class="w-full px-4 py-2 rounded-md input-field">
                            <option value="">Choose your game</option>
                            <option value="cod">COD Black OPS 6 (Team)</option>
                            <option value="valorant">Valorant (Team)</option>
                            <option value="pubg">PUBG Mobile (Team)</option>
                            <option value="fifa">FIFA 25 (Solo)</option>
                            <option value="tekken">Tekken 8 (Solo)</option>
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

                    <!-- Solo Registration Fields -->
                    <div id="soloFields" class="hidden">
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-300 mb-2">Player Name</label>
                            <input type="text" name="playerName1" class="w-full px-4 py-2 rounded-md input-field">
                        </div>

                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-300 mb-2">Game ID/Username</label>
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
                        <input type="tel" name="phone" pattern="03[0-9]{9}" class="w-full px-4 py-2 rounded-md input-field" required>
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
                        <label class="block text-sm font-medium text-gray-300 mb-2">University/College Name</label>
                        <input type="text" name="institution" class="w-full px-4 py-2 rounded-md input-field" required>
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-300 mb-2">Student ID/Roll Number</label>
                        <input type="text" name="studentId" class="w-full px-4 py-2 rounded-md input-field" required>
                    </div>

                    <!-- For team registrations, add CNIC fields for all players -->
                    <div id="teamMembersCNIC" class="hidden mb-6">
                        <label class="block text-sm font-medium text-gray-300 mb-2">Team Members' CNICs</label>
                        <div id="teamMembersCNICContainer" class="space-y-3">
                            <!-- CNIC fields will be added dynamically -->
                        </div>
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
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "test data";
    $phone = $_POST["phone"];
    $email = $_POST["email"];
    $whatsapp = $_POST["whatsapp"];
    $cnic = $_POST["cnic"];
    $institution = $_POST["institution"];
    $rollnumber = $_POST["studentId"];
    $transactionId = $_POST["transactionId"];

    // ✅ Handle image upload
    $targetDir = "uploads/";
    $payment_proof = basename($_FILES["payment_proof"]["name"]);
    $targetFile = $targetDir . $payment_proof;
    move_uploaded_file($_FILES["payment_proof"]["tmp_name"], $targetFile);

    // ✅ Insert into database
    $sql = "INSERT INTO registration (email_address, phone, whatsapp,cnic,institution,rollnumber,transactionProof,transactionId) 
    VALUES ('$email', '$phone', '$whatsapp', '$cnic','$institution','$rollnumber','$payment_proof','$transactionId')";
    if ($mysqli->query($sql) === TRUE) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $sql . "<br>" . $mysqli->error;
    }

    $mysqli->close();
}

include_once('footer.php')
?>