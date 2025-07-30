<?php
/**
 * Create Example Services for ALL Service Types - Smooth Migration Global
 * 
 * This script creates 2 example services for each of the 12 service types
 * using creative company names (real names with comedic twists)
 * 
 * Usage: Place in WordPress root and visit while logged in as admin
 * URL: https://yoursite.com/create-all-services.php
 */

// Ensure we're in WordPress context
if (!defined('ABSPATH')) {
    require_once('wp-load.php');
}

// Security check
if (!current_user_can('manage_options')) {
    die('Access denied. Admin privileges required.');
}

// First, let's update the service type descriptions that are missing
function update_service_type_descriptions() {
    $descriptions = array(
        'banking' => 'International banking solutions and account setup services.',
        'money-transfer' => 'Secure international money transfers and foreign exchange services.',
        'telecommunication' => 'Mobile plans, internet, and communication setup in your new country.',
        'insurance' => 'Comprehensive insurance coverage for international relocations.',
        'realtor' => 'Professional real estate services and housing solutions worldwide.',
        'vehicles' => 'Vehicle import, purchase, and transportation services.',
        'visas-immigration' => 'Navigate complex visa requirements with expert immigration guidance.',
        'pet-relocation' => 'Safe and stress-free relocation services for your beloved pets.',
        'school-search' => 'Find the right schools and educational opportunities for your children.',
        'business-setup' => 'Company formation and business setup in your new country.',
        'tax-legal' => 'International tax advice and legal services for expats.',
        'utilities-services' => 'Internet, electricity, water, and essential service connections.'
    );
    
    $updated = array();
    foreach ($descriptions as $slug => $description) {
        $term = get_term_by('slug', $slug, 'service_type');
        if ($term && empty($term->description)) {
            wp_update_term($term->term_id, 'service_type', array('description' => $description));
            $updated[] = $term->name;
        }
    }
    return $updated;
}

// Define all services with creative company names
$services_data = array(
    
    // BANKING SERVICES
    'banking' => array(
        array(
            'title' => 'Pursue Bank International Account',
            'content' => '<h2>Pursue Bank - Your International Banking Partner</h2>
<p>Pursue Bank (formerly Chase) offers comprehensive international banking services designed specifically for expatriates and global citizens.</p>
<h3>Account Features:</h3>
<ul>
<li>Multi-currency accounts (USD, EUR, GBP, AUD)</li>
<li>No international wire transfer fees</li>
<li>Global ATM access with fee reimbursement</li>
<li>24/7 English-speaking customer support</li>
<li>Mobile banking with international features</li>
<li>Pre-arrival account setup available</li>
</ul>
<h3>Eligibility Requirements:</h3>
<p>Minimum opening deposit of $1,000, valid passport, and proof of international relocation.</p>
<p><strong>Special Expat Offer:</strong> First year annual fee waived for new international customers.</p>',
            'excerpt' => 'Premium international banking with Pursue Bank featuring multi-currency accounts and global ATM access.',
            'price' => 'From $25/month',
            'duration' => '1-2 weeks setup'
        ),
        array(
            'title' => 'Wells Fartgo Global Business Banking',
            'content' => '<h2>Wells Fartgo - Business Banking Excellence</h2>
<p>Wells Fartgo specializes in international business banking solutions for companies expanding globally.</p>
<h3>Business Services:</h3>
<ul>
<li>Corporate multi-currency accounts</li>
<li>International payroll processing</li>
<li>Trade finance and letters of credit</li>
<li>Foreign exchange hedging tools</li>
<li>Dedicated relationship manager</li>
<li>Online treasury management platform</li>
</ul>
<h3>Additional Benefits:</h3>
<p>Priority customer service, quarterly business reviews, and access to exclusive international business events.</p>
<p><strong>Corporate Package:</strong> Includes business credit line up to $500,000 and merchant services.</p>',
            'excerpt' => 'Comprehensive business banking solutions from Wells Fartgo with international payroll and trade finance.',
            'price' => 'From $75/month',
            'duration' => '2-3 weeks setup'
        )
    ),
    
    // MONEY TRANSFER & INTERNATIONAL TRANSFERS
    'money-transfer' => array(
        array(
            'title' => 'Wise Guy Money Transfers',
            'content' => '<h2>Wise Guy - Smart International Transfers</h2>
<p>Wise Guy (inspired by Wise) offers transparent, low-cost international money transfers with real exchange rates.</p>
<h3>Transfer Features:</h3>
<ul>
<li>Real mid-market exchange rates</li>
<li>Transparent fees (no hidden charges)</li>
<li>Fast transfers (minutes to hours)</li>
<li>200+ countries supported</li>
<li>Multi-currency borderless account</li>
<li>Business bulk payment options</li>
</ul>
<h3>Speed Options:</h3>
<p>Instant transfers, standard (1-2 days), or economy (3-5 days) based on your needs and budget.</p>
<p><strong>First Transfer:</strong> No fees on your first transfer up to $500.</p>',
            'excerpt' => 'Transparent international money transfers with Wise Guy featuring real exchange rates and low fees.',
            'price' => 'From $2 + 0.5%',
            'duration' => 'Minutes to 2 days'
        ),
        array(
            'title' => 'MoneyGram Pro International',
            'content' => '<h2>MoneyGram Pro - Global Money Movement</h2>
<p>MoneyGram Pro provides reliable international money transfer services with extensive global reach.</p>
<h3>Service Options:</h3>
<ul>
<li>Cash pickup at 350,000+ locations</li>
<li>Direct bank deposits worldwide</li>
<li>Mobile wallet transfers</li>
<li>Bill payment services</li>
<li>Business payment solutions</li>
<li>Recurring transfer scheduling</li>
</ul>
<h3>Global Network:</h3>
<p>Available in 200+ countries and territories with local currency payout options.</p>
<p><strong>Loyalty Program:</strong> Earn points on every transfer and get discounts on future transactions.</p>',
            'excerpt' => 'Reliable global money transfers with MoneyGram Pro offering cash pickup and bank deposits worldwide.',
            'price' => 'From $5 + exchange margin',
            'duration' => '10 minutes to 1 day'
        )
    ),
    
    // TELECOMMUNICATION (Mobile & Cellular Plans)
    'telecommunication' => array(
        array(
            'title' => 'Verizon International Mobile Plans',
            'content' => '<h2>Verizon - Global Connectivity Solutions</h2>
<p>Verizon offers comprehensive international mobile plans designed for expatriates and frequent travelers.</p>
<h3>Plan Features:</h3>
<ul>
<li>Unlimited international roaming</li>
<li>High-speed data in 100+ countries</li>
<li>International calling and texting</li>
<li>Hotspot capabilities abroad</li>
<li>Multi-device family plans</li>
<li>24/7 multilingual customer support</li>
</ul>
<h3>Device Options:</h3>
<p>Latest smartphones with international warranties and global compatibility.</p>
<p><strong>Expat Special:</strong> First 3 months at 50% off for new international customers.</p>',
            'excerpt' => 'Comprehensive international mobile plans from Verizon with unlimited roaming and global connectivity.',
            'price' => 'From $89/month',
            'duration' => '1-3 days activation'
        ),
        array(
            'title' => 'AT&T Global Communications',
            'content' => '<h2>AT&T - Your Global Communication Partner</h2>
<p>AT&T provides business-grade communication solutions for international companies and remote workers.</p>
<h3>Business Solutions:</h3>
<ul>
<li>International VoIP phone systems</li>
<li>Virtual phone numbers in 50+ countries</li>
<li>Conference calling with global dial-in</li>
<li>Unified communications platform</li>
<li>Mobile device management</li>
<li>International internet connectivity</li>
</ul>
<h3>Enterprise Features:</h3>
<p>Advanced call routing, voicemail-to-email, and integration with popular business tools.</p>
<p><strong>Business Package:</strong> Includes setup, training, and dedicated account management.</p>',
            'excerpt' => 'Professional global communications from AT&Tea with VoIP systems and international connectivity.',
            'price' => 'From $45/user/month',
            'duration' => '1 week setup'
        )
    ),
    
    // INSURANCE COVERAGE
    'insurance' => array(
        array(
            'title' => 'Cigna Global Health Insurance',
            'content' => '<h2>Cigna Global - Worldwide Health Protection</h2>
<p>Cigna Global provides comprehensive international health insurance for expatriates and their families.</p>
<h3>Coverage Includes:</h3>
<ul>
<li>Worldwide medical coverage</li>
<li>Emergency medical evacuation</li>
<li>Prescription drug coverage</li>
<li>Maternity and newborn care</li>
<li>Mental health and wellness</li>
<li>Annual health check-ups</li>
</ul>
<h3>Global Network:</h3>
<p>Access to over 1.65 million healthcare providers worldwide, including direct billing arrangements.</p>
<p><strong>Family Discount:</strong> Save up to 10% when covering your entire family.</p>',
            'excerpt' => 'Comprehensive global health insurance from Cigna with worldwide coverage and extensive provider network.',
            'price' => 'From $165/month',
            'duration' => '1 week enrollment'
        ),
        array(
            'title' => 'AXA Global Expat Protection',
            'content' => '<h2>AXA Global - Complete Expat Insurance</h2>
<p>AXA Global offers specialized insurance packages designed specifically for expatriate lifestyles.</p>
<h3>Protection Package:</h3>
<ul>
<li>International life insurance</li>
<li>Disability income protection</li>
<li>Personal liability coverage</li>
<li>Home contents insurance</li>
<li>Travel and evacuation insurance</li>
<li>Legal expense coverage</li>
</ul>
<h3>Expat Benefits:</h3>
<p>Multi-currency policies, worldwide coverage, and claims processing in multiple languages.</p>
<p><strong>Complete Package:</strong> Bundle all insurances for 15% savings and simplified management.</p>',
            'excerpt' => 'Specialized expat insurance from AXA Global including life, disability, and liability protection.',
            'price' => 'From $120/month',
            'duration' => '1-2 weeks setup'
        )
    ),
    
    // REALTOR LOCATOR
    'realtor' => array(
        array(
            'title' => 'Coldwell Banker Global Relocation',
            'content' => '<h2>Coldwell Banker - Premier International Real Estate</h2>
<p>Coldwell Banker Global specializes in luxury international real estate and corporate relocations.</p>
<h3>Services Include:</h3>
<ul>
<li>Virtual property tours and consultations</li>
<li>Neighborhood analysis and school reports</li>
<li>Lease negotiation and contract review</li>
<li>Property management coordination</li>
<li>Temporary accommodation arrangements</li>
<li>Home buying and selling assistance</li>
</ul>
<h3>Global Reach:</h3>
<p>Offices in 40+ countries with certified international real estate specialists.</p>
<p><strong>Relocation Package:</strong> Includes 3 months of post-move support and local orientation.</p>',
            'excerpt' => 'Premier international real estate services from Coldwell Banker with virtual tours and global expertise.',
            'price' => 'From $299 consultation',
            'duration' => '2-4 weeks'
        ),
        array(
            'title' => 'RE/MAX Worldwide Corporate Housing',
            'content' => '<h2>RE/MAX Worldwide - Corporate Housing Solutions</h2>
<p>RE/MAX Worldwide provides fully furnished corporate housing for business relocations and extended stays.</p>
<h3>Corporate Features:</h3>
<ul>
<li>Fully furnished executive apartments</li>
<li>Flexible lease terms (1 month to 2 years)</li>
<li>All utilities and internet included</li>
<li>Housekeeping services available</li>
<li>Concierge and maintenance support</li>
<li>Corporate billing and expense reporting</li>
</ul>
<h3>Locations:</h3>
<p>Premium properties in major business districts, close to international schools and transportation.</p>
<p><strong>Corporate Rate:</strong> Volume discounts available for companies with multiple relocations.</p>',
            'excerpt' => 'Fully furnished corporate housing from RE/MAX Worldwide with flexible terms and premium locations.',
            'price' => 'From $2,500/month',
            'duration' => '1 week setup'
        )
    ),
    
    // VEHICLES
    'vehicles' => array(
        array(
            'title' => 'Schumacher International Auto Import',
            'content' => '<h2>Schumacher International - Vehicle Import Specialists</h2>
<p>Schumacher International handles all aspects of importing your vehicle to your new country.</p>
<h3>Import Services:</h3>
<ul>
<li>Import eligibility assessment</li>
<li>Customs documentation and clearance</li>
<li>International shipping coordination</li>
<li>Compliance modifications and inspection</li>
<li>Registration and licensing assistance</li>
<li>Insurance setup and coverage</li>
</ul>
<h3>Supported Routes:</h3>
<p>USA ↔ Europe, Australia ↔ Asia, and all major international shipping routes.</p>
<p><strong>Complete Package:</strong> Door-to-door service including pickup and delivery.</p>',
            'excerpt' => 'Professional vehicle import services from Schumacher International with door-to-door shipping.',
            'price' => 'From $2,200',
            'duration' => '6-10 weeks'
        ),
        array(
            'title' => 'CarGurus Global Auto Purchase',
            'content' => '<h2>CarGurus Global - International Vehicle Solutions</h2>
<p>CarGurus Global helps you find and purchase the perfect vehicle in your new country.</p>
<h3>Purchase Services:</h3>
<ul>
<li>Local market analysis and recommendations</li>
<li>Dealer network access and negotiations</li>
<li>Financing and lease arrangement assistance</li>
<li>Pre-purchase inspection services</li>
<li>Insurance and registration coordination</li>
<li>Warranty and service plan setup</li>
</ul>
<h3>Vehicle Selection:</h3>
<p>New and certified pre-owned vehicles from trusted dealers in 25+ countries.</p>
<p><strong>Expat Advantage:</strong> Special financing rates and extended warranties for international buyers.</p>',
            'excerpt' => 'Complete vehicle purchase assistance from CarGurus Global with dealer access and financing support.',
            'price' => 'From $399 service fee',
            'duration' => '2-3 weeks'
        )
    ),
    
    // VISAS & IMMIGRATION
    'visas-immigration' => array(
        array(
            'title' => 'Immigration Lawyers United',
            'content' => '<h2>Immigration Lawyers United - Visa Expertise</h2>
<p>Immigration Lawyers United provides comprehensive visa and immigration services with licensed attorneys.</p>
<h3>Visa Services:</h3>
<ul>
<li>Work visa applications and renewals</li>
<li>Family reunification visas</li>
<li>Student visa assistance</li>
<li>Investment and business visas</li>
<li>Permanent residency applications</li>
<li>Citizenship and naturalization</li>
</ul>
<h3>Legal Support:</h3>
<p>Licensed immigration attorneys in 15+ countries with success rates above 95%.</p>
<p><strong>Consultation Package:</strong> Initial assessment and personalized immigration strategy.</p>',
            'excerpt' => 'Professional immigration services from licensed attorneys with 95%+ success rates.',
            'price' => 'From $500 consultation',
            'duration' => '3-12 months'
        ),
        array(
            'title' => 'Global Visa Express',
            'content' => '<h2>Global Visa Express - Fast-Track Immigration</h2>
<p>Global Visa Express specializes in expedited visa processing and immigration document preparation.</p>
<h3>Express Services:</h3>
<ul>
<li>Expedited visa application processing</li>
<li>Document translation and apostille</li>
<li>Embassy appointment scheduling</li>
<li>Interview preparation and coaching</li>
<li>Emergency visa assistance</li>
<li>Visa renewal and extension services</li>
</ul>
<h3>Fast-Track Options:</h3>
<p>Priority processing available for urgent travel and business needs.</p>
<p><strong>Express Guarantee:</strong> Expedited processing or your money back.</p>',
            'excerpt' => 'Fast-track visa processing from Global Visa Express with expedited services and guarantees.',
            'price' => 'From $299 + gov fees',
            'duration' => '1-4 weeks'
        )
    ),
    
    // PET RELOCATION
    'pet-relocation' => array(
        array(
            'title' => 'PetRelocation International',
            'content' => '<h2>PetRelocation International - Safe Pet Transport</h2>
<p>PetRelocation International provides comprehensive pet relocation services with veterinary partnerships worldwide.</p>
<h3>Pet Services:</h3>
<ul>
<li>Health certificates and vaccinations</li>
<li>Import/export permit assistance</li>
<li>IATA-compliant travel crates</li>
<li>Door-to-door pet transport</li>
<li>Quarantine facility arrangements</li>
<li>24/7 pet tracking and updates</li>
</ul>
<h3>Animal Types:</h3>
<p>Dogs, cats, birds, and other domestic pets with specialized care for each species.</p>
<p><strong>Peace of Mind:</strong> Full insurance coverage and veterinary support throughout the journey.</p>',
            'excerpt' => 'Comprehensive pet relocation services with veterinary partnerships and 24/7 tracking.',
            'price' => 'From $1,200',
            'duration' => '4-8 weeks'
        ),
        array(
            'title' => 'WorldPet Transport Services',
            'content' => '<h2>WorldPet Transport - Global Pet Moving</h2>
<p>WorldPet Transport specializes in stress-free international pet relocations with personalized care.</p>
<h3>Transport Features:</h3>
<ul>
<li>Pre-travel veterinary consultation</li>
<li>Custom travel itinerary planning</li>
<li>Climate-controlled transportation</li>
<li>Professional pet handlers</li>
<li>Destination country compliance</li>
<li>Post-arrival wellness check</li>
</ul>
<h3>Special Services:</h3>
<p>Elderly pet care, medication administration, and emotional support during transport.</p>
<p><strong>Family Package:</strong> Multiple pet discounts and family reunion coordination.</p>',
            'excerpt' => 'Stress-free pet transport from WorldPet with personalized care and professional handlers.',
            'price' => 'From $950',
            'duration' => '3-6 weeks'
        )
    ),
    
    // SCHOOL SEARCH
    'school-search' => array(
        array(
            'title' => 'International Schools Network',
            'content' => '<h2>International Schools Network - Educational Excellence</h2>
<p>International Schools Network connects families with top international schools worldwide.</p>
<h3>School Services:</h3>
<ul>
<li>Comprehensive school research and matching</li>
<li>Application assistance and deadlines</li>
<li>Entrance exam preparation</li>
<li>Interview coaching for students and parents</li>
<li>Scholarship and financial aid guidance</li>
<li>School visit coordination</li>
</ul>
<h3>School Types:</h3>
<p>International Baccalaureate, American curriculum, British system, and local schools with English programs.</p>
<p><strong>Success Guarantee:</strong> Placement in preferred school or full refund.</p>',
            'excerpt' => 'Comprehensive school search and placement services with guaranteed results.',
            'price' => 'From $599',
            'duration' => '2-6 months'
        ),
        array(
            'title' => 'EduConsult Global',
            'content' => '<h2>EduConsult Global - Education Advisory</h2>
<p>EduConsult Global provides personalized education consulting for international families.</p>
<h3>Consulting Services:</h3>
<ul>
<li>Educational system orientation</li>
<li>School district analysis and recommendations</li>
<li>Private vs. public school guidance</li>
<li>Special needs education support</li>
<li>University preparation planning</li>
<li>Language support program identification</li>
</ul>
<h3>Expert Team:</h3>
<p>Former school administrators and education professionals from 20+ countries.</p>
<p><strong>Comprehensive Package:</strong> Complete education planning from kindergarten through university.</p>',
            'excerpt' => 'Personalized education consulting from former school administrators and education experts.',
            'price' => 'From $399',
            'duration' => '1-3 months'
        )
    ),
    
    // BUSINESS SETUP
    'business-setup' => array(
        array(
            'title' => 'GlobalCorp Formation Services',
            'content' => '<h2>GlobalCorp - International Business Formation</h2>
<p>GlobalCorp specializes in company formation and business setup services across multiple jurisdictions.</p>
<h3>Formation Services:</h3>
<ul>
<li>Company incorporation and registration</li>
<li>Business license and permit acquisition</li>
<li>Tax registration and compliance setup</li>
<li>Corporate banking account opening</li>
<li>Registered office and virtual address</li>
<li>Legal structure optimization</li>
</ul>
<h3>Supported Jurisdictions:</h3>
<p>USA (LLC, Corp), UK (Ltd), EU entities, Singapore, Hong Kong, and other major business hubs.</p>
<p><strong>Complete Package:</strong> Everything needed to start operating legally in your chosen country.</p>',
            'excerpt' => 'Professional company formation services across multiple international jurisdictions.',
            'price' => 'From $899',
            'duration' => '2-4 weeks'
        ),
        array(
            'title' => 'BizSetup International',
            'content' => '<h2>BizSetup International - Business Launch Support</h2>
<p>BizSetup International provides comprehensive business setup and operational support for international entrepreneurs.</p>
<h3>Setup Services:</h3>
<ul>
<li>Business plan development and review</li>
<li>Market entry strategy consultation</li>
<li>Regulatory compliance guidance</li>
<li>Accounting and bookkeeping setup</li>
<li>HR and payroll system implementation</li>
<li>Insurance and risk management</li>
</ul>
<h3>Ongoing Support:</h3>
<p>Monthly business reviews, compliance monitoring, and growth strategy consultation.</p>
<p><strong>Entrepreneur Package:</strong> First year of business support and mentoring included.</p>',
            'excerpt' => 'Comprehensive business launch support with ongoing consultation and compliance monitoring.',
            'price' => 'From $1,299',
            'duration' => '4-6 weeks'
        )
    ),
    
    // TAX & LEGAL SERVICES
    'tax-legal' => array(
        array(
            'title' => 'TaxMasters International',
            'content' => '<h2>TaxMasters International - Expat Tax Specialists</h2>
<p>TaxMasters International provides specialized tax services for expatriates and international businesses.</p>
<h3>Tax Services:</h3>
<ul>
<li>International tax planning and compliance</li>
<li>Expat tax return preparation (US, UK, AU)</li>
<li>Foreign income exclusion optimization</li>
<li>Tax treaty benefits maximization</li>
<li>Double taxation avoidance strategies</li>
<li>IRS and tax authority representation</li>
</ul>
<h3>Expertise:</h3>
<p>Certified international tax professionals with 15+ years of expat tax experience.</p>
<p><strong>Annual Package:</strong> Complete tax compliance and planning for individuals and businesses.</p>',
            'excerpt' => 'Specialized expat tax services from certified international tax professionals.',
            'price' => 'From $450',
            'duration' => '2-4 weeks'
        ),
        array(
            'title' => 'Global Legal Partners',
            'content' => '<h2>Global Legal Partners - International Legal Services</h2>
<p>Global Legal Partners provides comprehensive legal services for international relocations and business operations.</p>
<h3>Legal Services:</h3>
<ul>
<li>Contract review and negotiation</li>
<li>Employment law and work permits</li>
<li>Property law and real estate transactions</li>
<li>Family law and international custody</li>
<li>Immigration law and visa appeals</li>
<li>International arbitration and disputes</li>
</ul>
<h3>Global Network:</h3>
<p>Licensed attorneys in 30+ countries with expertise in international law.</p>
<p><strong>Retainer Package:</strong> Ongoing legal support with priority access to attorneys.</p>',
            'excerpt' => 'Comprehensive international legal services from licensed attorneys in 30+ countries.',
            'price' => 'From $300/hour',
            'duration' => '1-8 weeks'
        )
    ),
    
    // UTILITIES & SERVICES
    'utilities-services' => array(
        array(
            'title' => 'UtilityConnect International',
            'content' => '<h2>UtilityConnect International - Essential Services Setup</h2>
<p>UtilityConnect International handles all essential utility connections for your new home or office.</p>
<h3>Utility Services:</h3>
<ul>
<li>Electricity connection and provider selection</li>
<li>Natural gas and heating setup</li>
<li>Water and sewage service activation</li>
<li>High-speed internet and cable TV</li>
<li>Waste management and recycling</li>
<li>Home security system installation</li>
</ul>
<h3>Service Areas:</h3>
<p>Major cities in USA, Canada, UK, Australia, and EU countries with English-speaking support.</p>
<p><strong>Move-in Package:</strong> All utilities connected and ready before your arrival.</p>',
            'excerpt' => 'Complete utility connection services ensuring everything is ready before your arrival.',
            'price' => 'From $199',
            'duration' => '1-2 weeks'
        ),
        array(
            'title' => 'HomeServices Global',
            'content' => '<h2>HomeServices Global - Complete Home Setup</h2>
<p>HomeServices Global provides comprehensive home and office setup services for international relocations.</p>
<h3>Home Services:</h3>
<ul>
<li>Internet and telecommunications setup</li>
<li>Streaming and entertainment services</li>
<li>Home maintenance and repair contacts</li>
<li>Cleaning and housekeeping services</li>
<li>Gardening and landscaping connections</li>
<li>Local service provider recommendations</li>
</ul>
<h3>Concierge Support:</h3>
<p>Personal concierge to handle all setup calls and appointments on your behalf.</p>
<p><strong>Premium Package:</strong> White-glove service with personal concierge and priority scheduling.</p>',
            'excerpt' => 'Complete home setup services with personal concierge and local service connections.',
            'price' => 'From $299',
            'duration' => '1 week'
        )
    )
);

// Function to create services
function create_all_services($services_data) {
    $created_services = array();
    $errors = array();
    
    foreach ($services_data as $service_type_slug => $services) {
        // Check if service type exists
        $term = get_term_by('slug', $service_type_slug, 'service_type');
        
        if (!$term) {
            $errors[] = "Service type '$service_type_slug' not found. Please create it first.";
            continue;
        }
        
        foreach ($services as $service_data) {
            // Create the service post
            $post_data = array(
                'post_title'    => $service_data['title'],
                'post_content'  => $service_data['content'],
                'post_excerpt'  => $service_data['excerpt'],
                'post_status'   => 'publish',
                'post_type'     => 'service',
                'post_author'   => get_current_user_id()
            );
            
            $post_id = wp_insert_post($post_data);
            
            if (is_wp_error($post_id)) {
                $errors[] = "Failed to create service: " . $service_data['title'] . " - " . $post_id->get_error_message();
                continue;
            }
            
            // Assign to service type
            wp_set_post_terms($post_id, array($term->term_id), 'service_type');
            
            // Add custom meta
            update_post_meta($post_id, '_service_price', $service_data['price']);
            update_post_meta($post_id, '_service_duration', $service_data['duration']);
            
            $created_services[] = array(
                'id' => $post_id,
                'title' => $service_data['title'],
                'type' => $service_type_slug
            );
        }
    }
    
    return array(
        'created' => $created_services,
        'errors' => $errors
    );
}

// Only run if accessed directly
if (basename($_SERVER['PHP_SELF']) == 'create-all-services.php') {
    echo "<h1>Creating Services for ALL 12 Service Types...</h1>";
    
    // First update service type descriptions
    echo "<h2>Updating Service Type Descriptions...</h2>";
    $updated_descriptions = update_service_type_descriptions();
    if (!empty($updated_descriptions)) {
        echo "<p>Updated descriptions for: " . implode(', ', $updated_descriptions) . "</p>";
    } else {
        echo "<p>All service type descriptions are already set.</p>";
    }
    
    // Create services
    $result = create_all_services($services_data);
    
    echo "<h2>Service Creation Results:</h2>";
    echo "<p><strong>Successfully created " . count($result['created']) . " services!</strong></p>";
    
    // Group by service type for better display
    $services_by_type = array();
    foreach ($result['created'] as $service) {
        $services_by_type[$service['type']][] = $service;
    }
    
    foreach ($services_by_type as $type => $services) {
        echo "<h3>" . ucwords(str_replace('-', ' ', $type)) . " (" . count($services) . " services)</h3>";
        echo "<ul>";
        foreach ($services as $service) {
            echo "<li><strong>{$service['title']}</strong> (ID: {$service['id']})</li>";
        }
        echo "</ul>";
    }
    
    if (!empty($result['errors'])) {
        echo "<h3 style='color: red;'>Errors:</h3>";
        echo "<ul>";
        foreach ($result['errors'] as $error) {
            echo "<li style='color: red;'>$error</li>";
        }
        echo "</ul>";
    }
    
    echo "<h2>🎉 What's Been Created:</h2>";
    echo "<ul>";
    echo "<li><strong>24 Professional Services</strong> - 2 for each of your 12 service types</li>";
    echo "<li><strong>Creative Company Names</strong> - Real companies with comedic twists (Pursue Bank, Wells Fartgo, etc.)</li>";
    echo "<li><strong>Realistic Content</strong> - Full service descriptions with features and benefits</li>";
    echo "<li><strong>Pricing & Duration</strong> - Professional pricing and realistic timelines</li>";
    echo "<li><strong>Service Type Descriptions</strong> - Added missing descriptions for better SEO</li>";
    echo "</ul>";
    
    echo "<h2>Next Steps:</h2>";
    echo "<ol>";
    echo "<li><a href='/wp-admin/edit.php?post_type=service' target='_blank'>View all services in WordPress admin</a></li>";
    echo "<li><a href='/services' target='_blank'>Check your services page</a> - all service types should now show (2) in count</li>";
    echo "<li><a href='/wp-admin/edit-tags.php?taxonomy=service_type&post_type=service' target='_blank'>View service types</a> - descriptions should be populated</li>";
    echo "<li>Test the Quick View functionality for each service type</li>";
    echo "</ol>";
    
    echo "<p><em>🗑️ You can safely delete this file after running it.</em></p>";
}
?> 