// Wait for DOM to be fully loaded before running any code
document.addEventListener('DOMContentLoaded', function() {
    // Initialize countdown timer if we're on the home page
    initializeCountdown();
    
    // Initialize registration form if we're on the registration page
    initializeRegistrationForm();
    
    // Add shadow to navbar on scroll (works on all pages)
    initializeNavbarScroll();
});

// Countdown timer initialization
function initializeCountdown() {
    const daysElement = document.getElementById('days');
    if (!daysElement) return; // Only run on pages with countdown
    
    function updateCountdown() {
        const now = new Date();
        const eventDate = new Date('June 13, 2025 10:00:00');
        const diff = eventDate - now;
        
        if (diff <= 0) {
            document.getElementById('days').textContent = '00';
            document.getElementById('hours').textContent = '00';
            document.getElementById('minutes').textContent = '00';
            document.getElementById('seconds').textContent = '00';
            return;
        }
        
        const days = Math.floor(diff / (1000 * 60 * 60 * 24));
        const hours = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((diff % (1000 * 60)) / 1000);
        
        document.getElementById('days').textContent = days.toString().padStart(2, '0');
        document.getElementById('hours').textContent = hours.toString().padStart(2, '0');
        document.getElementById('minutes').textContent = minutes.toString().padStart(2, '0');
        document.getElementById('seconds').textContent = seconds.toString().padStart(2, '0');
    }
    
    // Update countdown every second
    setInterval(updateCountdown, 1000);
    updateCountdown();
}

// Registration form initialization
function initializeRegistrationForm() {
    const gameSelect = document.getElementById('gameSelect');
    if (!gameSelect) return; // Only run on registration page
    
    const teamFields = document.getElementById('teamFields');
    const soloFields = document.getElementById('soloFields');
    const teamMembersContainer = document.getElementById('teamMembersContainer');
    const teamMembersCNIC = document.getElementById('teamMembersCNIC');
    const teamMembersCNICContainer = document.getElementById('teamMembersCNICContainer');
    const regFee = document.getElementById('regFee');
    const registrationForm = document.getElementById('registrationForm');
    const paymentProofInput = document.getElementById('payment-proof');
    const dropZone = paymentProofInput.closest('div.border-2');
    
    const gameFees = {
        cod: { type: 'team', players: 5, fee: 1200, name: 'COD Black OPS 6' },
        valorant: { type: 'team', players: 5, fee: 1200, name: 'Valorant' },
        pubg: { type: 'team', players: 4, fee: 500, name: 'PUBG Mobile' },
        fifa: { type: 'solo', fee: 800, name: 'FIFA 25' },
        tekken: { type: 'solo', fee: 1000, name: 'Tekken 8' }
    };
    
    function createTeamMemberFields(playerCount) {
        teamMembersContainer.innerHTML = '';
        teamMembersCNICContainer.innerHTML = '';
        for (let i = 1; i <= playerCount; i++) {
            // Create player name field
            const input = document.createElement('input');
            input.type = 'text';
            input.name = `player${i}`;
            input.placeholder = `Player ${i}${i === 1 ? ' (Captain)' : ''}`;
            input.className = 'w-full px-4 py-2 rounded-md input-field mb-3';
            input.required = true;
            teamMembersContainer.appendChild(input);

            // Create CNIC field
            const cnicInput = document.createElement('input');
            cnicInput.type = 'text';
            cnicInput.name = `player${i}CNIC`;
            cnicInput.placeholder = `Player ${i} CNIC`;
            cnicInput.pattern = '[0-9]{5}-[0-9]{7}-[0-9]{1}';
            cnicInput.className = 'w-full px-4 py-2 rounded-md input-field mb-3';
            cnicInput.required = true;
            teamMembersCNICContainer.appendChild(cnicInput);

            // Add CNIC format helper text
            const helperText = document.createElement('p');
            helperText.className = 'text-xs text-gray-400 mb-3';
            helperText.textContent = 'Format: XXXXX-XXXXXXX-X';
            teamMembersCNICContainer.appendChild(helperText);
        }
    }
    
    // Game selection change handler
    gameSelect.addEventListener('change', function() {
        const game = gameFees[this.value];
        if (!game) {
            teamFields.classList.add('hidden');
            soloFields.classList.add('hidden');
            teamMembersCNIC.classList.add('hidden');
            regFee.textContent = 'Select a game';
            return;
        }
        
        if (game.type === 'team') {
            teamFields.classList.remove('hidden');
            teamMembersCNIC.classList.remove('hidden');
            soloFields.classList.add('hidden');
            createTeamMemberFields(game.players);
            regFee.textContent = `${game.fee} PKR × ${game.players} = ${game.fee * game.players} PKR`;
        } else {
            teamFields.classList.add('hidden');
            teamMembersCNIC.classList.add('hidden');
            soloFields.classList.remove('hidden');
            regFee.textContent = `${game.fee} PKR`;
        }
    });

    // File upload handling
    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        dropZone.addEventListener(eventName, preventDefaults, false);
    });

    function preventDefaults(e) {
        e.preventDefault();
        e.stopPropagation();
    }

    ['dragenter', 'dragover'].forEach(eventName => {
        dropZone.addEventListener(eventName, highlight, false);
    });

    ['dragleave', 'drop'].forEach(eventName => {
        dropZone.addEventListener(eventName, unhighlight, false);
    });

    function highlight(e) {
        dropZone.classList.add('border-purple-500', 'bg-gray-800');
    }

    function unhighlight(e) {
        dropZone.classList.remove('border-purple-500', 'bg-gray-800');
    }

    dropZone.addEventListener('drop', handleDrop, false);

    function handleDrop(e) {
        const dt = e.dataTransfer;
        const files = dt.files;
        handleFiles(files);
    }

    function handleFiles(files) {
        if (files.length > 0) {
            const file = files[0];
            if (file.size > 10 * 1024 * 1024) { // 10MB limit
                alert('File is too large. Please upload a file smaller than 10MB.');
                return;
            }
            if (!file.type.startsWith('image/')) {
                alert('Please upload an image file.');
                return;
            }
            paymentProofInput.files = files;
            showPreview(file);
        }
    }

    function showPreview(file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const preview = document.createElement('img');
            preview.src = e.target.result;
            preview.className = 'mt-2 rounded-lg max-h-48 mx-auto';
            const existingPreview = dropZone.querySelector('img');
            if (existingPreview) {
                existingPreview.remove();
            }
            dropZone.appendChild(preview);
        }
        reader.readAsDataURL(file);
    }

    paymentProofInput.addEventListener('change', function(e) {
        handleFiles(this.files);
    });
    
    // Form submission handler
    registrationForm.addEventListener('submit', function(e) {
        e.preventDefault();
        const game = gameSelect.value;
        const gameInfo = gameFees[game];
        
        if (!gameInfo) {
            alert('Please select a game');
            return;
        }

        // Validate CNIC format
        const cnicRegex = /^[0-9]{5}-[0-9]{7}-[0-9]{1}$/;
        const mainCNIC = this.querySelector('input[name="cnic"]').value;
        
        if (!cnicRegex.test(mainCNIC)) {
            alert('Please enter a valid CNIC number in the format XXXXX-XXXXXXX-X');
            return;
        }

        // Validate team member CNICs if it's a team game
        if (gameInfo.type === 'team') {
            for (let i = 1; i <= gameInfo.players; i++) {
                const cnicInput = this.querySelector(`input[name="player${i}CNIC"]`);
                if (!cnicRegex.test(cnicInput.value)) {
                    alert(`Please enter a valid CNIC number for Player ${i} in the format XXXXX-XXXXXXX-X`);
                    return;
                }
            }
        }

        // Validate phone numbers
        const phone = this.querySelector('input[name="phone"]').value;
        const whatsapp = this.querySelector('input[name="whatsapp"]').value;
        const phoneRegex = /^03[0-9]{9}$/;
        
        if (!phoneRegex.test(phone)) {
            alert('Please enter a valid phone number in the format 03XXXXXXXXX');
            return;
        }
        
        if (!phoneRegex.test(whatsapp)) {
            alert('Please enter a valid WhatsApp number in the format 03XXXXXXXXX');
            return;
        }

        // Validate payment proof
        if (!paymentProofInput.files || paymentProofInput.files.length === 0) {
            alert('Please upload your payment proof');
            return;
        }
        
        alert(`Registration submitted successfully for ${gameInfo.name}! We will verify your payment and send a confirmation email.`);
        this.reset();
        teamFields.classList.add('hidden');
        soloFields.classList.add('hidden');
        regFee.textContent = 'Select a game';
        const existingPreview = dropZone.querySelector('img');
        if (existingPreview) {
            existingPreview.remove();
        }
    });
}

// Navbar scroll effect initialization
function initializeNavbarScroll() {
    window.addEventListener('scroll', function() {
        const nav = document.querySelector('nav');
        if (window.scrollY > 10) {
            nav.classList.add('shadow-lg');
        } else {
            nav.classList.remove('shadow-lg');
        }
    });
}

// Mobile menu toggle
document.getElementById('mobile-menu-button').addEventListener('click', function() {
    const menu = document.getElementById('mobile-menu');
    menu.classList.toggle('hidden');
});

// Game tab switching
document.querySelectorAll('.game-tab').forEach(tab => {
    tab.addEventListener('click', function() {
        // Remove active class from all tabs
        document.querySelectorAll('.game-tab').forEach(t => {
            t.classList.remove('active');
            t.classList.add('text-gray-300', 'hover:text-white', 'hover:bg-gray-700');
            t.classList.remove('text-white', 'bg-gray-700');
        });
        
        // Add active class to clicked tab
        this.classList.add('active');
        this.classList.remove('text-gray-300', 'hover:text-white', 'hover:bg-gray-700');
        this.classList.add('text-white', 'bg-gray-700');
        
        // Here you would switch the game details content
        // For this demo, we're just showing the Valorant details
    });
});

// Registration type toggle
document.querySelectorAll('input[name="regType"]').forEach(radio => {
    radio.addEventListener('change', function() {
        if (this.value === 'team') {
            document.getElementById('teamFields').classList.remove('hidden');
            document.getElementById('soloFields').classList.add('hidden');
            document.querySelector('button[type="submit"]').textContent = 'Complete Registration ($50)';
        } else {
            document.getElementById('teamFields').classList.add('hidden');
            document.getElementById('soloFields').classList.remove('hidden');
            document.querySelector('button[type="submit"]').textContent = 'Join as Solo Player ($10)';
        }
    });
});

// Form submission
document.getElementById('eventRegistrationForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const regType = document.querySelector('input[name="regType"]:checked').value;
    
    if (regType === 'team') {
        const teamName = document.getElementById('teamName').value;
        alert(`Thank you for registering your team "${teamName}"! A confirmation email has been sent with payment instructions.`);
    } else {
        const ign = document.getElementById('soloIGN').value;
        alert(`Thank you for registering as a solo player "${ign}"! We'll match you with a team soon.`);
    }
    
    // Reset form
    this.reset();
});

// Smooth scrolling for navigation links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function(e) {
        e.preventDefault();
        
        const targetId = this.getAttribute('href');
        const targetElement = document.querySelector(targetId);
        
        if (targetElement) {
            window.scrollTo({
                top: targetElement.offsetTop - 80,
                behavior: 'smooth'
            });
            
            // Close mobile menu if open
            const mobileMenu = document.getElementById('mobile-menu');
            if (!mobileMenu.classList.contains('hidden')) {
                mobileMenu.classList.add('hidden');
            }
        }
    });
}); 