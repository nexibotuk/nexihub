<?php
$page_title = "Careers";
$page_description = "Join the Nexi Hub team - Build. Automate. Scale. Help us build the future of digital tools.";

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_application'])) {
    // Prepare webhook data
    $position = $_POST['position'] ?? '';
    $firstName = $_POST['first_name'] ?? '';
    $lastName = $_POST['last_name'] ?? '';
    $email = $_POST['email'] ?? '';
    $country = $_POST['country'] ?? '';
    $dob = $_POST['date_of_birth'] ?? '';
    $discordUsername = $_POST['discord_username'] ?? '';
    $discordId = $_POST['discord_id'] ?? '';
    $experience = $_POST['experience'] ?? '';
    $motivation = $_POST['motivation'] ?? '';
    $availability = $_POST['availability'] ?? '';
    $additionalInfo = $_POST['additional_info'] ?? '';
    $contractAgreement = isset($_POST['contract_agreement']) ? 'Yes' : 'No';
    $emailAgreement = isset($_POST['email_agreement']) ? 'Yes' : 'No';
    
    // Create Discord embed
    $embed = [
        'title' => 'New Job Application - ' . $position,
        'color' => hexdec('e64f21'), // Orange color
        'timestamp' => date('c'),
        'fields' => [
            [
                'name' => 'Personal Information',
                'value' => "**Name:** {$firstName} {$lastName}\n**Email:** {$email}\n**Country:** {$country}\n**Date of Birth:** {$dob}",
                'inline' => false
            ],
            [
                'name' => 'Discord Information',
                'value' => "**Username:** {$discordUsername}\n**ID:** {$discordId}",
                'inline' => false
            ],
            [
                'name' => 'Experience & Skills',
                'value' => substr($experience, 0, 1000) . (strlen($experience) > 1000 ? '...' : ''),
                'inline' => false
            ],
            [
                'name' => 'Motivation',
                'value' => substr($motivation, 0, 1000) . (strlen($motivation) > 1000 ? '...' : ''),
                'inline' => false
            ],
            [
                'name' => 'Availability',
                'value' => $availability,
                'inline' => true
            ],
            [
                'name' => 'Agreements',
                'value' => "**Contract & NDA:** {$contractAgreement}\n**Nexi Hub Email:** {$emailAgreement}",
                'inline' => true
            ]
        ],
        'footer' => [
            'text' => 'Nexi Hub Careers • nexihub.uk'
        ]
    ];
    
    if (!empty($additionalInfo)) {
        $embed['fields'][] = [
            'name' => 'Additional Information',
            'value' => substr($additionalInfo, 0, 1000) . (strlen($additionalInfo) > 1000 ? '...' : ''),
            'inline' => false
        ];
    }
    
    $webhookData = [
        'content' => "**New Application Received**\nPosition: **{$position}**",
        'embeds' => [$embed]
    ];
    
    // Send webhook
    $webhookUrl = 'https://discord.com/api/webhooks/1393997390112886855/8vCEMFEskYWcN9S5tNCFbOI7q4XTX4nXvzgM0CDoq-eufAFXWwrhFpURSXG7B0lriN_L';
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $webhookUrl);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($webhookData));
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
    $result = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    
    if ($httpCode === 204) {
        $submitSuccess = true;
    } else {
        $submitError = true;
    }
}

include 'includes/header.php';
?>

<!-- Hero Section -->
<section class="careers-hero">
    <div class="container">
        <div class="hero-content">
            <h1 class="hero-title">Shape the Future with Us</h1>
            <p class="hero-subtitle">Build. Automate. Scale.</p>
            <p class="hero-description">
                Join a team of innovators, creators, and visionaries building the next generation of digital tools.
                At Nexi Hub, your work directly impacts millions of users worldwide.
            </p>
            <div class="hero-stats">
                <div class="stat-item">
                    <span class="stat-number">100%</span>
                    <span class="stat-label">Remote-First</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number">11</span>
                    <span class="stat-label">Open Positions</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number">Global</span>
                    <span class="stat-label">Opportunities</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Success/Error Messages -->
<?php if (isset($submitSuccess)): ?>
<section class="message-section">
    <div class="container">
        <div class="success-message">
            <div class="message-icon success-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M20 6L9 17l-5-5"/>
                </svg>
            </div>
            <h2>Application Submitted Successfully!</h2>
            <p>Thank you for your interest in joining Nexi Hub. Our team will review your application and get back to you within 2-3 business days.</p>
            <a href="/careers" class="btn btn-primary">Submit Another Application</a>
        </div>
    </div>
</section>
<?php elseif (isset($submitError)): ?>
<section class="message-section">
    <div class="container">
        <div class="error-message">
            <div class="message-icon error-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M18 6L6 18M6 6l12 12"/>
                </svg>
            </div>
            <h2>Submission Error</h2>
            <p>There was an issue submitting your application. Please try again or contact us directly.</p>
            <a href="/contact" class="btn btn-primary">Contact Support</a>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- Why Join Us Section -->
<section class="why-join-section">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">Why Join Nexi Hub?</h2>
            <p class="section-subtitle">
                We're building something extraordinary, and we want you to be part of it
            </p>
        </div>
        
        <div class="benefits-grid">
            <div class="benefit-card">
                <div class="benefit-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
                        <circle cx="12" cy="10" r="3"/>
                    </svg>
                </div>
                <h3>Remote-First Culture</h3>
                <p>Work from anywhere in the world. We believe talent isn't limited by geography.</p>
            </div>
            
            <div class="benefit-card">
                <div class="benefit-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/>
                    </svg>
                </div>
                <h3>Voluntary Opportunity</h3>
                <p>All positions are voluntary roles that offer valuable experience, skill development, and networking opportunities.</p>
            </div>
            
            <div class="benefit-card">
                <div class="benefit-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 0 0 6.001 6M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 0 0 6.001 6M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16l3-9m-3 9l-3-9"/>
                    </svg>
                </div>
                <h3>Growth Opportunities</h3>
                <p>Continuous learning, skill development, and clear career progression paths.</p>
            </div>
            
            <div class="benefit-card">
                <div class="benefit-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/>
                    </svg>
                </div>
                <h3>Cutting-Edge Projects</h3>
                <p>Work on innovative platforms that impact millions of users worldwide.</p>
            </div>
            
            <div class="benefit-card">
                <div class="benefit-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                        <circle cx="9" cy="7" r="4"/>
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"/>
                    </svg>
                </div>
                <h3>Amazing Team</h3>
                <p>Collaborate with passionate, talented people who love what they do.</p>
            </div>
            
            <div class="benefit-card">
                <div class="benefit-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M3 3v18h18"/>
                        <path d="M18.7 8l-5.1 5.2-2.8-2.7L7 14.3"/>
                    </svg>
                </div>
                <h3>Impact & Scale</h3>
                <p>Your work directly contributes to products used by millions globally.</p>
            </div>
        </div>
    </div>
</section>

<!-- Open Positions Section -->
<section class="positions-section">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">Open Positions</h2>
            <p class="section-subtitle">
                Find your perfect role and help us build the future of digital tools
            </p>
            <div class="volunteer-notice">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z"/>
                </svg>
                <p><strong>Please Note:</strong> All positions at Nexi Hub are <strong>voluntary roles</strong>. While unpaid, these opportunities offer valuable experience, skill development, professional networking, and the chance to contribute to innovative projects that impact users worldwide.</p>
            </div>
        </div>
        
        <!-- Regional Leadership -->
        <div class="position-category">
            <h3 class="category-title">Regional Leadership</h3>
            <div class="positions-grid">
                
                <div class="position-card" data-position="Regional Director - Latin America">
                    <div class="position-header">
                        <h4 class="position-title">Regional Director - Latin America</h4>
                        <span class="position-type">Leadership</span>
                    </div>
                    <div class="position-location">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
                            <circle cx="12" cy="10" r="3"/>
                        </svg>
                        Remote (South America, Central America, Caribbean)
                    </div>
                    <p class="position-summary">Lead expansion across Latin American markets with focus on localization and emerging strategies.</p>
                    <button class="apply-btn">Apply Now</button>
                </div>
            </div>
        </div>
        
        <!-- Corporate Functions -->
        <div class="position-category">
            <h3 class="category-title">Corporate Functions</h3>
            <div class="positions-grid">
                <div class="position-card" data-position="Compliance Manager">
                    <div class="position-header">
                        <h4 class="position-title">Compliance Manager</h4>
                        <span class="position-type">Legal</span>
                    </div>
                    <div class="position-location">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
                            <circle cx="12" cy="10" r="3"/>
                        </svg>
                        Remote
                    </div>
                    <p class="position-summary">Ensure adherence to global regulations and support ethical business practices.</p>
                    <button class="apply-btn">Apply Now</button>
                </div>
            </div>
        </div>
        
        <!-- Shared Services -->
        <div class="position-category">
            <h3 class="category-title">Shared Services</h3>
            <div class="positions-grid">
                <div class="position-card" data-position="Brand Manager">
                    <div class="position-header">
                        <h4 class="position-title">Brand Manager</h4>
                        <span class="position-type">Marketing</span>
                    </div>
                    <div class="position-location">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
                            <circle cx="12" cy="10" r="3"/>
                        </svg>
                        Remote
                    </div>
                    <p class="position-summary">Develop and maintain brand identity across all Nexi Hub platforms and communications.</p>
                    <button class="apply-btn">Apply Now</button>
                </div>
                
                <div class="position-card" data-position="Marketing Manager">
                    <div class="position-header">
                        <h4 class="position-title">Marketing Manager</h4>
                        <span class="position-type">Marketing</span>
                    </div>
                    <div class="position-location">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
                            <circle cx="12" cy="10" r="3"/>
                        </svg>
                        Remote
                    </div>
                    <p class="position-summary">Lead marketing strategies and campaigns to drive growth across all platforms.</p>
                    <button class="apply-btn">Apply Now</button>
                </div>
                
                <div class="position-card" data-position="Partnership Manager">
                    <div class="position-header">
                        <h4 class="position-title">Partnership Manager</h4>
                        <span class="position-type">Business Development</span>
                    </div>
                    <div class="position-location">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
                            <circle cx="12" cy="10" r="3"/>
                        </svg>
                        Remote
                    </div>
                    <p class="position-summary">Build and manage strategic partnerships to expand our platform reach.</p>
                    <button class="apply-btn">Apply Now</button>
                </div>
                
                <div class="position-card" data-position="Research & Development Manager">
                    <div class="position-header">
                        <h4 class="position-title">Research & Development Manager</h4>
                        <span class="position-type">Innovation</span>
                    </div>
                    <div class="position-location">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
                            <circle cx="12" cy="10" r="3"/>
                        </svg>
                        Remote
                    </div>
                    <p class="position-summary">Lead research initiatives and drive innovation across all Nexi Hub platforms.</p>
                    <button class="apply-btn">Apply Now</button>
                </div>
                
                <div class="position-card" data-position="Resource Planning Manager">
                    <div class="position-header">
                        <h4 class="position-title">Resource Planning Manager</h4>
                        <span class="position-type">Operations</span>
                    </div>
                    <div class="position-location">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
                            <circle cx="12" cy="10" r="3"/>
                        </svg>
                        Remote
                    </div>
                    <p class="position-summary">Plan and optimize resource allocation across all departments and projects.</p>
                    <button class="apply-btn">Apply Now</button>
                </div>
            </div>
        </div>
        
        <!-- Company Leadership Team -->
        <div class="position-category">
            <h3 class="category-title">Company Leadership Team</h3>
            <div class="positions-grid">
                <div class="position-card" data-position="Nexi Pulse General Manager">
                    <div class="position-header">
                        <h4 class="position-title">Nexi Pulse General Manager</h4>
                        <span class="position-type">Leadership</span>
                    </div>
                    <div class="position-location">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
                            <circle cx="12" cy="10" r="3"/>
                        </svg>
                        Remote
                    </div>
                    <p class="position-summary">Lead the Nexi Pulse platform strategy, operations, and team management.</p>
                    <button class="apply-btn">Apply Now</button>
                </div>
                
                <div class="position-card" data-position="Nexi Pulse Head of Product">
                    <div class="position-header">
                        <h4 class="position-title">Nexi Pulse Head of Product</h4>
                        <span class="position-type">Product</span>
                    </div>
                    <div class="position-location">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
                            <circle cx="12" cy="10" r="3"/>
                        </svg>
                        Remote
                    </div>
                    <p class="position-summary">Drive product vision and strategy for the Nexi Pulse platform.</p>
                    <button class="apply-btn">Apply Now</button>
                </div>
                
                <div class="position-card" data-position="Nexi Pulse Head of Technology">
                    <div class="position-header">
                        <h4 class="position-title">Nexi Pulse Head of Technology</h4>
                        <span class="position-type">Technology</span>
                    </div>
                    <div class="position-location">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
                            <circle cx="12" cy="10" r="3"/>
                        </svg>
                        Remote
                    </div>
                    <p class="position-summary">Lead technical development and architecture for Nexi Pulse.</p>
                    <button class="apply-btn">Apply Now</button>
                </div>
                
                <div class="position-card" data-position="Nexi Bot General Manager">
                    <div class="position-header">
                        <h4 class="position-title">Nexi Bot General Manager</h4>
                        <span class="position-type">Leadership</span>
                    </div>
                    <div class="position-location">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
                            <circle cx="12" cy="10" r="3"/>
                        </svg>
                        Remote
                    </div>
                    <p class="position-summary">Oversee Nexi Bot platform operations, strategy, and growth initiatives.</p>
                    <button class="apply-btn">Apply Now</button>
                </div>
                
                <div class="position-card" data-position="Nexi Bot Head of Engineering">
                    <div class="position-header">
                        <h4 class="position-title">Nexi Bot Head of Engineering</h4>
                        <span class="position-type">Engineering</span>
                    </div>
                    <div class="position-location">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
                            <circle cx="12" cy="10" r="3"/>
                        </svg>
                        Remote
                    </div>
                    <p class="position-summary">Lead engineering team and technical development for Nexi Bot.</p>
                    <button class="apply-btn">Apply Now</button>
                </div>
                
                <div class="position-card" data-position="Nexi Web General Manager">
                    <div class="position-header">
                        <h4 class="position-title">Nexi Web General Manager</h4>
                        <span class="position-type">Leadership</span>
                    </div>
                    <div class="position-location">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
                            <circle cx="12" cy="10" r="3"/>
                        </svg>
                        Remote
                    </div>
                    <p class="position-summary">Manage Nexi Web platform strategy, operations, and business development.</p>
                    <button class="apply-btn">Apply Now</button>
                </div>
                
                <div class="position-card" data-position="Nexi Web Creative Director">
                    <div class="position-header">
                        <h4 class="position-title">Nexi Web Creative Director</h4>
                        <span class="position-type">Creative</span>
                    </div>
                    <div class="position-location">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
                            <circle cx="12" cy="10" r="3"/>
                        </svg>
                        Remote
                    </div>
                    <p class="position-summary">Lead creative vision and design strategy for Nexi Web platform.</p>
                    <button class="apply-btn">Apply Now</button>
                </div>
                
                <div class="position-card" data-position="Nexi Web Head of Engineering">
                    <div class="position-header">
                        <h4 class="position-title">Nexi Web Head of Engineering</h4>
                        <span class="position-type">Engineering</span>
                    </div>
                    <div class="position-location">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
                            <circle cx="12" cy="10" r="3"/>
                        </svg>
                        Remote
                    </div>
                    <p class="position-summary">Lead engineering team and technical development for Nexi Web.</p>
                    <button class="apply-btn">Apply Now</button>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Application Modal -->
<div id="applicationModal" class="modal">
    <div class="modal-overlay"></div>
    <div class="modal-content">
        <div class="modal-header">
            <h2 id="modalTitle">Apply for Position</h2>
            <button class="modal-close" type="button">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M18 6L6 18M6 6l12 12"/>
                </svg>
            </button>
        </div>
        
        <form id="applicationForm" method="POST" action="">
            <input type="hidden" name="position" id="positionInput">
            
            <div class="form-section">
                <h3>Personal Information</h3>
                <div class="form-row">
                    <div class="form-group">
                        <label for="first_name">First Name *</label>
                        <input type="text" id="first_name" name="first_name" required>
                    </div>
                    <div class="form-group">
                        <label for="last_name">Last Name *</label>
                        <input type="text" id="last_name" name="last_name" required>
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="email">Email Address *</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="country">Country *</label>
                        <select id="country" name="country" required>
                            <option value="">Select your country</option>
                            <option value="US">United States</option>
                            <option value="CA">Canada</option>
                            <option value="MX">Mexico</option>
                            <option value="GB">United Kingdom</option>
                            <option value="DE">Germany</option>
                            <option value="FR">France</option>
                            <option value="ES">Spain</option>
                            <option value="IT">Italy</option>
                            <option value="NL">Netherlands</option>
                            <option value="AU">Australia</option>
                            <option value="NZ">New Zealand</option>
                            <option value="JP">Japan</option>
                            <option value="KR">South Korea</option>
                            <option value="SG">Singapore</option>
                            <option value="BR">Brazil</option>
                            <option value="AR">Argentina</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="date_of_birth">Date of Birth *</label>
                    <input type="date" id="date_of_birth" name="date_of_birth" required>
                </div>
            </div>
            
            <div class="form-section">
                <h3>Discord Information</h3>
                <div class="form-row">
                    <div class="form-group">
                        <label for="discord_username">Discord Username *</label>
                        <input type="text" id="discord_username" name="discord_username" placeholder="username#1234" required>
                    </div>
                    <div class="form-group">
                        <label for="discord_id">Discord User ID *</label>
                        <input type="text" id="discord_id" name="discord_id" placeholder="123456789012345678" required>
                    </div>
                </div>
            </div>
            
            <div class="form-section">
                <h3>Application Details</h3>
                <div class="form-group">
                    <label for="experience">Relevant Experience & Skills *</label>
                    <textarea id="experience" name="experience" rows="4" placeholder="Tell us about your relevant experience, skills, and qualifications for this role..." required></textarea>
                </div>
                
                <div class="form-group">
                    <label for="motivation">Why do you want to join Nexi Hub? *</label>
                    <textarea id="motivation" name="motivation" rows="4" placeholder="What motivates you to apply for this position? How do you align with our mission?" required></textarea>
                </div>
                
                <div class="form-group">
                    <label for="availability">Availability *</label>
                    <select id="availability" name="availability" required>
                        <option value="">Select your availability</option>
                        <option value="Immediately">Available immediately</option>
                        <option value="2 weeks">Available in 2 weeks</option>
                        <option value="1 month">Available in 1 month</option>
                        <option value="2-3 months">Available in 2-3 months</option>
                        <option value="Other">Other (please specify in additional info)</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="additional_info">Additional Information</label>
                    <textarea id="additional_info" name="additional_info" rows="3" placeholder="Any additional information you'd like to share..."></textarea>
                </div>
            </div>
            
            <div class="form-section">
                <h3>Agreements</h3>
                <div class="checkbox-group">
                    <div class="checkbox-item">
                        <input type="checkbox" id="contract_agreement" name="contract_agreement" required>
                        <label for="contract_agreement">I agree to sign a contract and Non-Disclosure Agreement (NDA) if offered this position *</label>
                    </div>
                    <div class="checkbox-item">
                        <input type="checkbox" id="email_agreement" name="email_agreement" required>
                        <label for="email_agreement">I agree to receive and use a Nexi Hub email address for official communications *</label>
                    </div>
                    <div class="checkbox-item legal-acceptance">
                        <input type="checkbox" id="legal_acceptance" name="legal_acceptance" required>
                        <label for="legal_acceptance">I accept all terms and conditions outlined in <a href="/legal" target="_blank">nexihub.uk/legal</a> *</label>
                    </div>
                </div>
            </div>
            
            <div class="form-actions">
                <button type="button" class="btn btn-secondary cancel-btn">Cancel</button>
                <button type="submit" name="submit_application" class="btn btn-primary">Submit Application</button>
            </div>
        </form>
    </div>
</div>

<script>
// Modal functionality
const modal = document.getElementById('applicationModal');
const modalOverlay = document.querySelector('.modal-overlay');
const applyBtns = document.querySelectorAll('.apply-btn');
const closeBtn = document.querySelector('.modal-close');
const cancelBtn = document.querySelector('.cancel-btn');
const modalTitle = document.getElementById('modalTitle');
const positionInput = document.getElementById('positionInput');

function openModal(position) {
    modalTitle.textContent = `Apply for ${position}`;
    positionInput.value = position;
    modal.style.display = 'flex';
    document.body.style.overflow = 'hidden';
}

function closeModal() {
    modal.style.display = 'none';
    document.body.style.overflow = 'auto';
}

applyBtns.forEach(btn => {
    btn.addEventListener('click', function() {
        const positionCard = this.closest('.position-card');
        const position = positionCard.dataset.position;
        openModal(position);
    });
});

closeBtn.addEventListener('click', closeModal);
cancelBtn.addEventListener('click', closeModal);
modalOverlay.addEventListener('click', closeModal);

// Close modal with Escape key
document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape' && modal.style.display === 'flex') {
        closeModal();
    }
});
</script>

<?php include 'includes/footer.php'; ?>
